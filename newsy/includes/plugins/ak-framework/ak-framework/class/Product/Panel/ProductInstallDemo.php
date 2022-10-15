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
namespace Ak\Product\Panel;

use Ak\Importer\ImporterManager;

/**
 * Class ProductInstallDemo.
 */
class ProductInstallDemo extends ProductPanelAbstract {

	/**
	 * Page id.
	 *
	 * @var string
	 */
	public $id = 'install-demo';

	public function enqueue() {
		wp_enqueue_style( 'ak-install-demo-styles', AK_FRAMEWORK_URL . '/assets/css/panel/ak-install-demo.css', array(), AK_FRAMEWORK_VERSION );
		wp_style_add_data( 'ak-install-demo-styles', 'rtl', 'replace' );

		wp_enqueue_script( 'ak-install-demo-scripts', AK_FRAMEWORK_URL . '/assets/js/panel/ak-install-demo.js', array( 'jquery', 'sweetalert' ), AK_FRAMEWORK_VERSION, true );

		wp_localize_script(
			'ak-install-demo-scripts', 'ak_install_demo_loc', array(
				'with_content'      => __( 'Import Content', 'ak-framework' ),
				'installing'        => __( 'Installing', 'ak-framework' ),
				'uninstalling'      => __( 'Uninstalling', 'ak-framework' ),
				'donotclose'        => __( 'Don\'t refresh page while processing', 'ak-framework' ),
				'display_error'     => __( 'Error:', 'ak-framework' ),
				'install'           => array(
					'title'             => __( 'Are you sure to install demo?', 'ak-framework' ),
					'text'              => __(
						'<p>This will import our predefined settings for the demo (plugins, media, posts, taxonomies, widgets, menus, options etc...) and our sample content.</p>
				<p>The demo can be fully uninstalled via the uninstall button. Please backup your settings to be sure that you don\'t lose them by accident.</p>
				', 'ak-framework'
					),
					'confirmButtonText' => __( 'Yes, Install', 'ak-framework' ),
					'cancelButtonText'  => __( 'Cancel', 'ak-framework' ),
				),
				'uninstall'         => array(
					'title'             => __( 'Are your sure to uninstall this demo?', 'ak-framework' ),
					'text'              => __( 'By uninstalling demo all configurations from media, widgets, options, menus, taxonomies and other settings that was comes from our demo content will be removed and your settings will be rollback to before demo installation.', 'ak-framework' ),
					'confirmButtonText' => __( 'Yes, Uninstall', 'ak-framework' ),
					'cancelButtonText'  => __( 'No, do not', 'ak-framework' ),
				),
				'install_error'     => array(
					'title'             => __( 'An error occurred while installing demo', 'ak-framework' ),
					'text'              => __( 'Please try again several minutes later or contact support.', 'ak-framework' ),
					'confirmButtonText' => __( 'Ok', 'ak-framework' ),
				),
				'uninstall_error'   => array(
					'title'             => __( 'An error occurred while uninstalling demo', 'ak-framework' ),
					'text'              => __( 'Please try again several minutes later or contact support.', 'ak-framework' ),
					'confirmButtonText' => __( 'Ok', 'ak-framework' ),
				),
				'install_success'   => array(
					'title'             => __( 'Demo successfully installed.', 'ak-framework' ),
					'text'              => __( 'Demo installing process finished.', 'ak-framework' ),
					'confirmButtonText' => __( 'Ok', 'ak-framework' ),
				),
				'uninstall_success' => array(
					'title'             => __( 'Demo successfully uninstalled', 'ak-framework' ),
					'text'              => __( 'Demo uninstalling process finished.', 'ak-framework' ),
					'confirmButtonText' => __( 'Ok', 'ak-framework' ),
				),
			)
		);
	}

	/**
	 * HTML output to display admin user.
	 *
	 * @param $options
	 */
	public function render_content() {
		$filter_by_product  = isset( $this->page['config']['filter_by_product'] ) ? $this->page['config']['filter_by_product'] : $this->product_id;
		$order_by_installed = isset( $this->page['config']['order_by_installed'] ) ? $this->page['config']['order_by_installed'] : true;
		$demos              = $this->get_demos( $filter_by_product, $order_by_installed );

		$registered = $this->is_product_registered();

		if ( $demos ) :
			?>
			<div class="ak-install-demo-page-container ak-columns-3 ak-columns-gap-2x ak-clearfix">

				<?php
				foreach ( $demos as $demo_data ) :
					?>
				<div class="ak-install-demo-page-item ak-column <?php echo esc_attr( $demo_data['installed'] ? 'installed' : '' ); ?>" data-group="<?php echo esc_attr( $demo_data['group'] ); ?>" data-id="<?php echo esc_attr( $demo_data['id'] ); ?>" data-clear="<?php echo esc_attr( $demo_data['clear_group'] ); ?>">
					<div class="ak-demo-item">
						<figure>
							<img class="ak-demo-thumbnail" src="<?php echo esc_url( $demo_data['thumbnail'] ); ?>">
						</figure>

						<div class="ak-demo-info ak-clearfix">
							<div class="ak-demo-title">
								<?php echo esc_html( $demo_data['name'] ); ?>
							</div>

							<div class="ak-demo-buttons">
								<?php if ( $registered ) : ?>
								<a href="#" class="ak-btn ak-primary-btn ak-install-demo"><?php esc_html_e( 'Install', 'ak-framework' ); ?></a>
									<?php if ( ! empty( $demo_data['preview_url'] ) ) : ?>
								<a href="<?php echo esc_url( $demo_data['preview_url'] ); ?>" target="_blank" class="ak-btn ak-preview-demo"><?php esc_html_e( 'Preview', 'ak-framework' ); ?></a>
								<?php endif; ?>
								<a href="#" class="ak-btn ak-uninstall-demo"><?php esc_html_e( 'Uninstall', 'ak-framework' ); ?></a>
								<?php else : ?>
								<a href="<?php echo admin_url( 'admin.php?page=' . $this->product_id . '-activation' ); ?>" class="ak-btn ak-danger-btn" data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e( 'Activate product to install demos', 'ak-framework' ); ?>">
									<?php esc_html_e( 'Activate', 'ak-framework' ); ?>
								</a>
								<?php endif; ?>
							</div>

						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			<?php

		else :
			echo 'no demo registered';
		endif;
	}

	/**
	 * @param string $demo_id
	 *
	 * @return array|bool
	 */
	public function get_demos( $filter_by_product = '', $order_by_installed = false ) {
		$demo_list = apply_filters( 'ak-framework/product/demos', array() );
		$demos     = array();
		foreach ( $demo_list as $demo_id => $demo_data ) {
			$demo_product = isset( $demo_data['product'] ) ? $demo_data['product'] : '';

			if ( '' === $filter_by_product || $demo_product === $filter_by_product || is_array( $filter_by_product ) && in_array( $demo_product, $filter_by_product, true ) ) {
				$demo_data['id']          = isset( $demo_data['id'] ) ? $demo_data['id'] : $demo_id;
				$demo_data['group']       = isset( $demo_data['group'] ) ? $demo_data['group'] : $this->product_id . '_demos';
				$demo_data['clear_group'] = isset( $demo_data['clear_group'] ) ? $demo_data['clear_group'] : true;
				$demo_data['installed']   = self::is_installed_demo( $demo_id, $demo_data['group'] );
				array_push( $demos, $demo_data );
			}
		}

		if ( $order_by_installed ) {
			usort(
				$demos, function ( $left, $right ) {
					return $right['installed'] - $left['installed'];
				}
			);
		}

		return $demos;
	}

	/**
	 * @param string $demo_id
	 *
	 * @return array|bool
	 */
	public function get_demo_import_data( $demo_id ) {
		$demos  = $this->get_demos();
		$params = ak_array_find_by_value( $demos, 'id', $demo_id );
		$demo   = array();

		if ( $params ) {
			$file = rtrim( $params['path'], '/' );

			if ( file_exists( $file . '/import.json' ) ) {
				$json = ak_is_json( ak_get_local_file_content( $file . '/import.json' ), true );

				if ( $json ) {
					$demo = $json;
				}
			} elseif ( file_exists( $file . '/import.php' ) ) {
				require_once $file . '/import.php';
			}
		}

		return $demo;
	}

	/**
	 * Whether a demo is already installed.
	 *
	 * @param string $demo_id
	 *
	 * @return bool
	 */
	public static function is_installed_demo( $demo_id, $demo_group ) {
		$demo_group_data = ImporterManager::get_instance()->get_group_data( $demo_group );

		return $demo_group_data && is_array( $demo_group_data ) && isset( $demo_group_data[ $demo_id ]['finish'] );
	}

	/**
	 * ajax handler for demo install/unInstall demo requests.
	 *
	 * @param array $params
	 *
	 * @return mixed true on success or false on failure.
	 */
	public function ajax_request() {
		if ( ! isset( $_POST ) && ! isset( $_POST['import_id'] ) ) {
			return false;
		}

		$params = $_POST;

		$import_id    = &$params['import_id'];
		$import_group = &$params['import_group'];

		$importer = ImporterManager::get_instance();

		$importer->set_import_group( $import_group );
		$importer->set_import_id( $import_id );

		$response = array();
		try {
			switch ( $params['import_action'] ) {
				case 'get_steps':
					$demo_data      = array();
					$check_register = $this->is_product_registered();

					if ( ! $check_register || is_wp_error( $check_register ) ) {
						return false;
					}

					if ( 'install' === $params['import_status'] ) {
						$demo_data = $this->get_demo_import_data( $import_id );
					}

					$response = $importer->get_steps( $params, $demo_data );

					break;

				case 'install':
					$response = $importer->install( $params );

					break;

				// Delete all installed data for demo
				case 'uninstall':
					$response = $importer->uninstall( $params );

					break;

				// Force to delete all installed data for demo
				case 'force_uninstall':
					$response = $importer->force_uninstall();

					break;
			}
		} catch ( \Exception $e ) {
			$response = new \WP_Error( $e->getCode(), $e->getMessage() );
		}

		return $response;
	}
}
