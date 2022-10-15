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
namespace Ak\Asset;

use Ak\Customizer\CustomizerManager;
use Ak\Form\FormManager;
use Ak\Product\Product;
use Ak\Util\CssGenerator;
use Ak\Taxonomy\TaxonomyMeta;

/**
 * Class Handles Base Custom CSS Functionality.
 *
 * @package  ak-framework
 */
class StyleManager {

	/**
	 * @var StyleManager
	 */
	private static $instance;

	/**
	 * Contain all css's that must be generated.
	 *
	 * @var array
	 */
	protected static $outputs = array();

	/**
	 * Contain custom fonts css that must be generated.
	 *
	 * Used to get custom fonts for backend font manager
	 *
	 * @var array
	 */
	public static $font_css_key = 'ak_font_manager_custom_font_css';

	/**
	 * @return StyleManager
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * StyleManager Constructer
	 */
	public function __construct() {
		// add all outputs from option panels, customizer and taxonomy global options
		add_filter( 'ak-framework/css/outputs', array( $this, 'add_option_panel_output' ) );
		//add_filter( 'ak-framework/css/outputs', array( $this, 'add_customizer_output' ), 15 );
		add_filter( 'ak-framework/css/outputs', array( $this, 'add_taxonomy_global_output' ), 20 );

		// generate global css
		add_action( 'customize_save_after', array( $this, 'do_global_css' ), 999 );
		add_action( 'ak-framework/option-panel/save/after', array( $this, 'do_global_css' ), 999 );
		add_action( 'ak-framework/taxonomy/save/after', array( $this, 'do_global_css' ), 999 );
		add_action( 'ak-framework/demo/install/after', array( $this, 'do_global_css' ), 999 );

		// remove and do global css again
		// we don't use reset_global_css method because uninstalling post pack will cause no style!
		add_action( 'ak-framework/demo/uninstall/after', array( $this, 'do_global_css' ), 999 );

		// generate post css
		add_action( 'ak-framework/post/save/after', array( $this, 'do_post_css' ), 11 );
		add_action( 'ak-framework/demo/import/post/after', array( $this, 'do_post_css' ), 11 );

		// generate taxonomy css
		add_action( 'ak-framework/taxonomy/save/after', array( $this, 'do_taxonomy_css' ), 11 );
		add_action( 'ak-framework/demo/import/taxonomy/after', array( $this, 'do_taxonomy_css' ), 11 );
	}

	/**
	 * Get all registered outputs.
	 *
	 * @return array
	 */
	public static function get_css() {
		if ( empty( self::$outputs ) ) {
			self::$outputs = apply_filters( 'ak-framework/css/outputs', array() );
		}

		return self::$outputs;
	}

	/**
	 * Add all active outputs from option panels.
	 *
	 * @param array $final_output Global outputs
	 *
	 * @return array
	 */
	public static function add_option_panel_output( $final_output ) {
		$global_css_panels = Product::get_instance()->get_global_css_panels();

		if ( ! empty( $global_css_panels ) ) {
			foreach ( $global_css_panels as $params ) {
				$panel_options = ! empty( $params['config']['panel_options'] ) ? $params['config']['panel_options'] : array();

				$manager = new FormManager(
					array_merge(
						array(
							'option_type'    => 'option',
							'prepare_output' => true,
							'input_prefix'   => $panel_options['option_id'],
						),
						$panel_options // option_id etc
					)
				);

				$outputs = $manager->get_active_outputs();

				if ( ! empty( $outputs ) ) {
					$final_output = array_merge( $final_output, $outputs );
				}
			}
		}

		return $final_output;
	}

	/**
	 * Add all active outputs from customizer panels.
	 *
	 * @param array $final_output Global outputs
	 *
	 * @return array
	 */
	public static function add_customizer_output( $final_output ) {
		$outputs = CustomizerManager::get_instance()->get_active_outputs();

		if ( ! empty( $outputs ) ) {
			$final_output = array_merge( $final_output, $outputs );
		}

		return $final_output;
	}

	/**
	 * Add All outputs from taxonomy global options.
	 *
	 * @param array $final_output Global outputs
	 *
	 * @return array
	 */
	public static function add_taxonomy_global_output( $final_output ) {
		$metaboxes = TaxonomyMeta::get_instance()->get_global_css_panels();

		if ( ! empty( $metaboxes ) ) {
			foreach ( (array) $metaboxes as $metabox_id => $metabox ) {
				if ( ! isset( $metabox['taxonomy'] ) ) {
					continue;
				}
				$terms = get_terms(
					array(
						'taxonomy'   => $metabox['taxonomy'],
						'hide_empty' => false,
					)
				);

				foreach ( $terms as $term ) {
					if ( ! isset( $term->term_id ) ) {
						continue;
					}

					$manager = new FormManager(
						array(
							'option_type'    => 'taxonomy',
							'option_id'      => $term->term_id,
							'prepare_output' => true,
							'input_prefix'   => $metabox_id . '_' . $term->term_id,
							'file'           => ! empty( $metabox['file'] ) ? $metabox['file'] : '',
							'fields'         => ! empty( $metabox['fields'] ) ? $metabox['fields'] : '',
						)
					);

					$outputs = $manager->get_active_outputs();

					if ( empty( $outputs ) ) {
						continue;
					}

					foreach ( $outputs as $i => $output ) {
						foreach ( $output as $it => $item ) {
							if ( isset( $item['global_output'] ) && $item['global_output'] ) {
								if ( is_array( $item['element'] ) ) {
									foreach ( $item['element'] as $iel => $el ) {
										$outputs[ $i ][ $it ]['element'][ $iel ] = self::filter_output_taxonomy_term( $el, $term );
									};
								} else {
									$outputs[ $i ][ $it ]['element'] = self::filter_output_taxonomy_term( $item['element'], $term );
								}
							} else {
								unset( $outputs[ $i ][ $it ] );
							}
						}

						if ( empty( $outputs[ $i ] ) ) {
							unset( $outputs[ $i ] );
						}
					}

					if ( ! empty( $outputs ) ) {
						$final_output = array_merge( $final_output, $outputs );
					}
				}
			}
		}

		return $final_output;
	}

	private static function filter_output_taxonomy_term( $el, $term ) {
		return str_replace(
			array( '%%term_taxonomy%%', '%%term_id%%', '%%term_slug%%' ),
			array( $term->taxonomy, $term->term_id, $term->slug ),
			$el
		);
	}

	/**
	 * Remove all generated global styles.
	 *
	 * @return void
	 */
	public static function reset_global_css() {
		$front_asset = FrontendAsset::get_instance();

		self::remove_css_file();
		ak_delete_option( $front_asset->file_option_key );
		ak_delete_option( $front_asset->fonts_option_key );
		delete_transient( self::$font_css_key );
	}

	/**
	 * Check the upload folder that must be writable.
	 *
	 * @return bool
	 */
	public static function check_folder() {
		$wp_upload_dir   = wp_upload_dir();
		$css_folder_name = FrontendAsset::get_instance()->folder_name;

		if ( ! is_dir( $wp_upload_dir['basedir'] . '/' . $css_folder_name ) ) {
			if ( ! wp_mkdir_p( $wp_upload_dir['basedir'] . '/' . $css_folder_name ) ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Remove style file from upload folder.
	 *
	 * @return void
	 */
	public static function remove_css_file() {
		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';

			WP_Filesystem();
		}

		$file_path = FrontendAsset::get_instance()->get_css_upload_path();

		if ( $file_path && self::check_folder() ) {
			$wp_filesystem->delete( $file_path );
		}
	}

	/**
	 * Generate style file on upload folder.
	 *
	 * @param string $global_css Generated Css.
	 *
	 * @return bool
	 */
	public static function compile_css_file( $global_css ) {
		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';

			WP_Filesystem();
		}

		$file_path = FrontendAsset::get_instance()->get_css_upload_path();
		if ( $file_path && self::check_folder() ) {
			if ( $wp_filesystem->put_contents( $file_path, $global_css, 0777 ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Do global file.
	 *
	 * First reset the previus settings and generate css
	 * save generated css and fonts then compile the file.
	 *
	 * @return bool
	 */
	public static function do_global_css() {
		$outputs = self::get_css();

		if ( empty( $outputs ) ) {
			return false;
		}
		// delete current css file and fonts
		self::reset_global_css();

		$front_asset = FrontendAsset::get_instance();

		$css_generator = new CssGenerator;
		$final_css     = $css_generator->init_outputs( $outputs );
		$custom_fonts  = $css_generator->render_custom_fonts();
		$google_fonts  = $css_generator->render_google_fonts();

		if ( empty( $final_css ) ) {
			return false;
		}

		if ( $custom_fonts ) {
			//that used for backend font manager
			set_transient( self::$font_css_key, $custom_fonts );

			//merge custom font css with global css
			$final_css = $custom_fonts . $final_css;
		}

		if ( $google_fonts ) {
			ak_update_option( $front_asset->fonts_option_key, $google_fonts );
		}

		// generate new random key for new file
		ak_update_option( $front_asset->file_option_key, ak_random_string( 15 ) );

		return self::compile_css_file( $final_css );
	}

	/**
	 * Save generated page css to option.
	 *
	 * @param string $css_id Css ID for page.
	 * @param array $outputs Css outputs for page.
	 *
	 * @return bool
	 */
	public static function set_page_css( $css_id, $outputs ) {
		if ( empty( $outputs ) ) {
			delete_transient( 'ak_' . $css_id . '_css' );
			return false;
		}

		$css_generator = new CssGenerator;
		$final_css     = $css_generator->init_outputs( $outputs );

		if ( empty( $final_css ) ) {
			return false;
		}

		set_transient( 'ak_' . $css_id . '_css', $final_css );

		return true;
	}

	/**
	 * Do post css.
	 *
	 * Filter: ak-framework/post/meta
	 *
	 * @param integer $post_id Post ID.
	 *
	 * @return bool
	 */
	public static function do_post_css( $post_id ) {
		$final_output = array();
		$css_id       = 'post_' . $post_id;
		$post_type    = get_post_type( $post_id );

		$metaboxes = apply_filters( 'ak-framework/post/meta', array() );

		if ( ! empty( $metaboxes ) ) {
			foreach ( $metaboxes as $metabox ) {
				if ( is_array( $metabox['post_type'] ) && ! in_array( $post_type, $metabox['post_type'], true ) || $metabox['post_type'] != $post_type ) {
					continue;
				}

				$manager = new FormManager(
					array(
						'option_type'    => 'post',
						'option_id'      => $post_id,
						'prepare_output' => true,
						'file'           => ! empty( $metabox['file'] ) ? $metabox['file'] : '',
						'fields'         => ! empty( $metabox['fields'] ) ? $metabox['fields'] : '',
					)
				);

				$outputs = $manager->get_active_outputs( true );

				if ( empty( $outputs ) ) {
					continue;
				}

				$final_output = array_merge( $final_output, $outputs );
			}
		}

		return self::set_page_css( $css_id, $final_output );
	}

	/**
	 * Do taxonomy css.
	 *
	 * Filter: ak-framework/taxonomy/meta
	 *
	 * @param integer $term_id Taxonomy ID.
	 *
	 * @return bool
	 */
	public static function do_taxonomy_css( $term_id ) {
		$final_output = array();
		$css_id       = 'tax_' . $term_id;

		$metaboxes = TaxonomyMeta::get_instance()->get_taxonomy_meta();

		if ( ! empty( $metaboxes ) ) {
			foreach ( $metaboxes as $metabox ) {
				if ( ! isset( $metabox['taxonomy'] ) ) {
					continue;
				}
				$manager = new FormManager(
					array(
						'option_type'    => 'taxonomy',
						'prepare_output' => true,
						'option_id'      => $term_id,
						'file'           => ! empty( $metabox['file'] ) ? $metabox['file'] : '',
						'fields'         => ! empty( $metabox['fields'] ) ? $metabox['fields'] : '',
					)
				);

				$outputs = $manager->get_active_outputs( true );

				if ( empty( $outputs ) ) {
					continue;
				}

				$term = get_term( $term_id );

				if ( $term ) {
					foreach ( $outputs as $i => $output ) {
						foreach ( $output as $it => $item ) {
							if ( ! isset( $item['global_output'] ) || isset( $item['global_output'] ) && ! $item['global_output'] ) {
								if ( is_array( $item['element'] ) ) {
									foreach ( $item['element'] as $iel => $el ) {
										$outputs[ $i ][ $it ]['element'][ $iel ] = self::filter_output_taxonomy_term( $el, $term );
									};
								} else {
									$outputs[ $i ][ $it ]['element'] = self::filter_output_taxonomy_term( $item['element'], $term );
								}
							} else {
								unset( $outputs[ $i ][ $it ] );
							}
						}

						if ( empty( $outputs[ $i ] ) ) {
							unset( $outputs[ $i ] );
						}
					}
				}

				$final_output = array_merge( $final_output, $outputs );
			}
		}

		return self::set_page_css( $css_id, $final_output );
	}

	/**
	 * Do User css.
	 *
	 * Filter: ak-framework/user/meta.
	 *
	 * @param integer $user_id User ID.
	 *
	 * @return bool
	 */
	public static function do_user_css( $user_id ) {
		$final_output = array();
		$css_id       = 'user_' . $user_id;

		$css_panels = apply_filters( 'ak-framework/user/meta', array() );

		if ( ! empty( $css_panels ) ) {
			foreach ( $css_panels as $params ) {
				$manager = new FormManager(
					array(
						'option_type'    => 'user',
						'option_id'      => $user_id,
						'prepare_output' => true,
						'file'           => ! empty( $params['file'] ) ? $params['file'] : '',
						'fields'         => ! empty( $params['fields'] ) ? $params['fields'] : '',
					)
				);

				$outputs = $manager->get_active_outputs( true );

				if ( empty( $outputs ) ) {
					continue;
				}

				$final_output = array_merge( $final_output, $outputs );
			}
		}

		return self::set_page_css( $css_id, $final_output );
	}
}
