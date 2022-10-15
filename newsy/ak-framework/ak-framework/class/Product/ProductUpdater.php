<?php
/***
 * The Ak Framework
 *
 * Ak Framework is framework for WordPress themes and plugins.
 *
 * Copyright © 2020 akbilisim
 * www.akbilisim.com
 *
 * Envato Profile: https://themeforest.net/user/akbilisim
 */
namespace Ak\Product;

/**
 * Class Product Updater handles that all registered products updates.
 *
 * @package  ak-framework
 */
class ProductUpdater {

	/**
	 * @var ProductUpdater
	 */
	private static $instance;

	public static $plugins_file = array();

	public $available_updates = array();

	/**
	 * Store Authentication params - array {.
	 *
	 * @type string|int $item_id       the item id in envato marketplace
	 * @type string     $purchase_code envato purchase code
	 *                  }
	 *
	 * @var array
	 */
	protected $products = array();


	/**
	 * @return ProductUpdater
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	public function __construct() {
		add_action( 'init', array( $this, 'register_schedule' ) );

		$this->available_updates = $this->check_updates();

		if ( ! empty( $this->available_updates ) ) {
			add_filter( 'pre_set_site_transient_update_themes', array( $this, 'update_themes' ) );
			add_filter( 'pre_set_transient_update_themes', array( $this, 'update_themes' ) );

			add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'update_plugins' ) );
			add_filter( 'pre_set_transient_update_plugins', array( $this, 'update_plugins' ) );

			add_filter( 'site_transient_update_themes', array( $this, 'fetch_theme_download_link' ) );
			add_filter( 'site_transient_update_plugins', array( $this, 'fetch_theme_download_link' ) );

			// @todo envato market plugin fix
			add_action( 'upgrader_package_options', array( $this, 'update_deferred_download' ), 99 );

			if ( class_exists( 'Envato_Market_Admin' ) ) {
				remove_action( 'upgrader_package_options', array( \Envato_Market_Admin::instance(), 'maybe_deferred_download' ), 9 );
			}
		}
	}

	public function register_schedule() {
		if ( ! wp_next_scheduled( 'ak-framework/product/check-updates' ) ) {
			wp_schedule_event( time(), 'daily', 'ak-framework/product/check-updates' );
		}
	}

	/**
	 * Check all products update.
	 */
	public function scheduled_check_updates() {
		$products = Product::get_instance()->get_products();
		foreach ( $products as $product_id => $product ) {
			if ( isset( $product['product-item-id'] ) && isset( $product['product-version'] ) ) {
				$response = $this->update_request(
					'check-update', array(
						'item_id'       => $product['product-item-id'],
						'item_version'  => $product['product-version'],
						'purchase_code' => ProductLicense::get_instance()->get_product_purchase_info( $product['product-item-id'] ),
						'access_code'   => ProductLicense::get_instance()->get_access_code_info( $product['product-item-id'] ),
					)
				);
			}
		}
	}

	/**
	 * Check and compare current version with latest version.
	 */
	public function check_updates() {
		$available_updates = array();
		$products          = Product::get_instance()->get_products();

		foreach ( $products as $product_id => $product ) {
			if ( isset( $product['product-item-id'] ) ) {
				$item_id                = $product['product-item-id'];
				$item_version           = $product['product-version'];
				$update_data            = $this->get_product_update_info( $item_id );
				$purchase               = ProductLicense::get_instance()->is_product_purchase_valid( $item_id );
				$update_available       = false;
				$theme_update_available = false;
				$changelog              = false;

				if ( ! $update_data ) {
					continue;
				}

				foreach ( $update_data as $data ) {
					switch ( $data['type'] ) {
						case 'theme':
							if ( version_compare( $item_version, $data['version'], '<' ) ) {
								if ( isset( $data['changelog'] ) ) {
									$changelog = $data['changelog'];
								}

								if ( $purchase ) {
									$available_updates['theme'] = $data;
								}
								$update_available       = true;
								$theme_update_available = true;
							}

							break;
						case 'plugin':
							$p_file = self::get_plugin_info_by_slug( $data['slug'] );

							if ( $p_file ) {
								$plugin_file    = $p_file['file'];
								$plugin_version = $p_file['version'];

								if ( version_compare( $plugin_version, $data['version'], '<' ) ) {
									if ( $purchase ) {
										$available_updates['plugins'][ $plugin_file ] = $data;
									}
									$update_available = true;
								}
							}
							break;
					}
				}

				if ( $update_available ) {
					$alert_title = sprintf(
					/* translators: s: theme name */
						__( 'There is a new version of %s available.', 'ak-framework' ), $product['product-name']
					);

					if ( ! $purchase ) {
						ak_register_notice( $item_id . $item_version . '-update', 'error', __( 'Please activate your licence to get updates', 'ak-framework' ), $alert_title );
					} else {
						if ( $theme_update_available ) {
							// $url = wp_nonce_url( admin_url( 'update.php?action=upgrade-theme&amp;theme=' . urlencode( $product_id ) ), 'upgrade-theme_' . $product_id );
							$url = admin_url( 'update-core.php' );

							$alert_content = sprintf(
							/* translators: 1 is replaced with "url" */
								__( '<a href="%s">Click here</a> to update your theme and get new features and bug fixes now.', 'ak-framework' ), $url
							);
						} else {
							$alert_content = sprintf(
							/* translators: 1 is replaced with "url" */
								__( '<a href="%s">Click here</a> to update your plugins.', 'ak-framework' ), admin_url( 'update-core.php' )
							);
						}
						if ( $changelog ) {
							$alert_content .= ' ' . sprintf(
							/* translators: 1 is replaced with "url" */
								__( '<a href="%s">Click here</a> to view changelog.', 'ak-framework' ), $changelog
							);
						}
						ak_register_notice( $item_id . $item_version . '-update', 'error', $alert_content, $alert_title );
					}
				}
			}
		}

		return $available_updates;
	}

	public function deferred_download_url( $package ) {
		if ( isset( $package['deferred_download'] ) ) {
			return add_query_arg( $package, esc_url( self_admin_url() ) );
		}

		return $package;
	}

	public function update_themes( $transient ) {
		if ( isset( $transient->checked ) ) {
			if ( isset( $this->available_updates['theme'] ) ) {
				$theme = $this->available_updates['theme'];
				$slug  = $theme['slug'];

				$transient->response[ $slug ] = array(
					'theme'       => $slug,
					'new_version' => $theme['version'],
					'url'         => $theme['url'],
					'package'     => $this->deferred_download_url( $theme['package'] ),
					'changelog'   => isset( $theme['changelog'] ) ? $theme['changelog'] : '',
				);
			}
		}

		return $transient;
	}

	public function update_plugins( $transient ) {
		if ( isset( $transient->checked ) ) {
			if ( isset( $this->available_updates['plugins'] ) ) {
				foreach ( $this->available_updates['plugins'] as $plugin_slug => $plugin_data ) {
					if ( empty( $transient->response[ $plugin_slug ] ) ) {
						$transient->response[ $plugin_slug ] = new \stdClass();
					}

					$transient->response[ $plugin_slug ]->slug        = $plugin_data['slug'];
					$transient->response[ $plugin_slug ]->plugin      = $plugin_slug;
					$transient->response[ $plugin_slug ]->new_version = $plugin_data['version'];
					$transient->response[ $plugin_slug ]->package     = $this->deferred_download_url( $plugin_data['package'] );
					if ( empty( $transient->response[ $plugin_slug ]->url ) && ! empty( $plugin_data['url'] ) ) {
						$transient->response[ $plugin_slug ]->url = $plugin_data['url'];
					}
				}
			}
		}

		return $transient;
	}

	/**
	 * Connect Ak Framework API and Retrieve Data From Server.
	 *
	 * @param string $action {@see handle_request}
	 * @param array  $args   {
	 *
	 * @type bool $use_wp_error use wp_error object on failure or always return false
	 *            }
	 *
	 * @return bool|WP_Error|array|object bool|WP_Error on failure.
	 */
	public function update_request( $action, $args = array() ) {
		try {
			$product_license = ProductLicense::get_instance();
			$response        = $product_license->handle_request( $action, $args );

			if ( isset( $response['status'] ) ) {
				if ( 'success' === $response['status'] ) {
					$this->register_product_update_info( $args['item_id'], $response['data'] );
					return $response['data'];
				} elseif ( 'error' === $response['status'] ) {
					$product_license->delete_product_purchase_info( $args['item_id'] );
				}
			}

			return false;
		} catch ( \Exception $e ) {
			return false;
		}
	}

	/**
	 * Connect Ak framework API and Retrieve Data From Server.
	 *
	 * @param string $action {@see handle_request}
	 * @param array  $args   {
	 *
	 * @type bool $use_wp_error use wp_error object on failure or always return false
	 *            }
	 *
	 * @return bool|\WP_Error|array|object bool|WP_Error on failure.
	 */
	public function get_download_url( $args ) {
		try {
			if ( isset( $args['item_id'] ) ) {
				$args = array_merge(
					$args, array(
						'purchase_code' => ProductLicense::get_instance()->get_product_purchase_info( $args['item_id'] ),
					)
				);
			}

			$api_url  = ProductLicense::get_instance()->get_api_url( 'get-update-download-url' );
			$api_args = ProductLicense::get_instance()->get_api_args( $args );

			return add_query_arg( $api_args, $api_url );
		} catch ( \Exception $e ) {
			return false;
		}
	}

	public function update_deferred_download( $options ) {
		$package = $options['package'];
		if ( false !== strrpos( $package, 'deferred_download' ) && false !== strrpos( $package, 'item_id' ) ) {
			parse_str( parse_url( $package, PHP_URL_QUERY ), $vars );
			$options['package'] = $this->get_download_url( $vars );
		}

		return $options;
	}

	public function fetch_theme_download_link( $value ) {
		global $pagenow;
		if ( isset( $_REQUEST['action'] ) &&
		in_array( $pagenow, array( 'admin-ajax.php', 'update.php', 'update-core.php' ), true ) &&
		in_array(
			$_REQUEST['action'], array(
				'upgrade-theme',
				'upgrade-plugin',
				'do-plugin-upgrade',
				'update-selected-themes',
				'update-selected-plugins',
				'update-selected',
				'update-theme',
				'update-plugin',
			),
			true
		)
		) {
			if ( ! empty( $value->response ) && is_array( $value->response ) ) {
				add_filter( 'http_request_args', 'ak_remove_reject_unsafe_urls', 99 );
			}
		}

		return $value;
	}

	/**
	 * Get plugin file path by plugin slug.
	 *
	 * Ex: get_plugin_info_by_slug('js_composer') ==> js_composer/js_composer.php
	 *
	 * @param string $slug plugin slug (plugin directory)
	 *
	 * @return array|bool plugin file path on success or false on error
	 */
	public static function get_plugin_info_by_slug( $slug ) {
		// Check if get_plugins() function exists. This is required on the front end of the
		// site, since it is in a file that is normally only loaded in the admin.
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		if ( empty( self::$plugins_file ) && function_exists( 'get_plugins' ) ) {
			foreach ( get_plugins() as $file => $info ) {
				self::$plugins_file[ dirname( $file ) ] = array(
					'file'    => $file,
					'version' => $info['Version'],
				);
			}
		}

		return isset( self::$plugins_file[ $slug ] ) ? self::$plugins_file[ $slug ] : false;
	}

	/**
	 * Retrieve product registration information.
	 */
	public function register_product_update_info( $item_id, $data ) {
		$info_key = sprintf( 'ak_product_update_info_%s', $item_id );

		if ( is_multisite() ) {
			return update_site_option( $info_key, $data );
		} else {
			return update_option( $info_key, $data, 'no' );
		}
	}

	public function get_product_update_info( $item_id ) {
		$info_key = sprintf( 'ak_product_update_info_%s', $item_id );

		if ( is_multisite() ) {
			return get_site_option( $info_key );
		} else {
			return get_option( $info_key );
		}
	}

	public function delete_product_update_info( $item_id ) {
		$info_key = sprintf( 'ak_product_update_info_%s', $item_id );

		if ( is_multisite() ) {
			delete_site_option( $info_key );
		} else {
			delete_option( $info_key );
		}
	}
}
