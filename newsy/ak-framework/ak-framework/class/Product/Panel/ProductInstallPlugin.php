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

use Ak\Product\ProductPanel;
use Ak\Importer\ImporterPlugin;
use TGM_Plugin_Activation;

/**
 * Class ProductInstallPlugin.
 */
class ProductInstallPlugin extends ProductPanelAbstract {

	/**
	 * Page id.
	 *
	 * @var string
	 */
	public $id = 'install-plugin';

	/**
	 * @var \TGM_Plugin_Activation
	 */
	private $tgm_instance;

	/**
	 * Page id.
	 *
	 * @var string
	 */
	public static $import_data = array();

	/**
	 * @return array
	 */
	public static $import_data_types = array(
		'taxonomy',
		'media',
		'post',
		'option',
		'widget',
		'menu',
	);

	public function __construct() {
		parent::__construct();

		$this->register_tgmpa();
	}


	public function enqueue() {
		wp_enqueue_style( 'ak-install-plugin-styles', AK_FRAMEWORK_URL . '/assets/css/panel/ak-install-plugin.css', array(), null );
		wp_style_add_data( 'ak-install-plugin-styles', 'rtl', 'replace' );

		wp_enqueue_script( 'ak-install-plugin-scripts', AK_FRAMEWORK_URL . '/assets/js/panel/ak-install-plugin.js', array( 'jquery', 'sweetalert' ), AK_FRAMEWORK_VERSION, true );

		wp_localize_script(
			'ak-install-plugin-scripts', 'ak_install_plugin_loc', array(
				'display_error' => __( 'Error:', 'ak-framework' ),
				'pop_title'     => array(
					/* translators: %1$s is replaced with "string" */
					'activate'   => __( 'Activating: %s', 'ak-framework' ),
					/* translators: %1$s is replaced with "string" */
					'deactivate' => __( 'Deactivating: %s', 'ak-framework' ),
					/* translators: %1$s is replaced with "string" */
					'install'    => __( 'Installing: %s', 'ak-framework' ),
					/* translators: %1$s is replaced with "string" */
					'update'     => __( 'Updating: %s', 'ak-framework' ),
				),
			)
		);
	}

	/**
	 * @param string $demo_id
	 *
	 * @return array
	 */
	public function get_plugins() {
		return apply_filters( 'ak-framework/product/plugins', array() );
	}

	/**
	 * @param string $demo_id
	 *
	 * @return array
	 */
	public function get_product_plugins() {
		return ak_array_find_all_by_value( $this->get_plugins(), 'product', $this->product_id );
	}

	public function register_tgmpa() {
		do_action( 'tgmpa_register' );

		$this->tgm_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}

	/**
	 * HTML output to display admin user.
	 *
	 * @param $options
	 */
	public function before_render() {
		if ( current_user_can( 'activate_plugins' ) ) {
			// deactivate a plugin from tgm
			if ( isset( $_GET['type'] ) ) {
				$action       = $_GET['type'];
				$current_page = ProductPanel::get_instance()->get_current_page_id();

				if ( empty( $_GET['ak_plugin_token'] ) || wp_verify_nonce( $_GET['ak_plugin_token'], 'ak_plugins_nonce' ) === false ) {
					echo 'Permission denied';
					die;
				}
				$ak_plugin_slug = $_GET['ak_plugin_slug'];
				if ( ! empty( $ak_plugin_slug ) ) {
					$plugins = TGM_Plugin_Activation::$instance->plugins;

					foreach ( $plugins as $plugin ) {
						if ( $plugin['slug'] == $ak_plugin_slug ) {
							if ( 'activate' == $action ) {
								activate_plugins( $plugin['file_path'] );
							} elseif ( 'deactivate' == $action ) {
								deactivate_plugins( $plugin['file_path'] );
							} ?>
						<script type="text/javascript">
							window.location = "<?php echo admin_url( 'admin.php?page=' . $current_page ); ?>";
						</script>
							<?php
						}
					}
				}
			}
		}
	}

	/**
	 * HTML output to display admin user.
	 *
	 * @param $options
	 */
	public function render_content() {
		$plugins_list = $this->get_product_plugins();

		if ( $plugins_list ) :
			echo '<div class="ak-install-plugin-page-container">';
			echo '<div class="ak-install-plugins-group ak-columns-3 ak-columns-gap-2x ak-clearfix">';

			foreach ( $plugins_list as $plugin_id => $plugin ) {

				if ( isset( $plugin_data['hide'] ) ) {
					continue;
				}

				if ( isset( $plugin['pre_heading'] ) ) {
					echo '</div>';
					echo '<div class="ak-plugins-group-header ak-clearfix"><h3>' . $plugin['pre_heading'] . '</h3></div>';
					echo '<div class="ak-install-plugin-items ak-clearfix">';
				}

				$this->render_item( $plugin );

			}

			echo '</div>';
			echo '</div>';
		else :
			esc_html_e( 'No plugin registered', 'ak-framework' );
		endif;
	}

	/**
	 * HTML output to display admin user.
	 *
	 * @param $options
	 */
	public function render_item( $plugin ) {

		$plugin_id        = &$plugin['slug'];
		$plugin_version   = &$plugin['version'];
		$plugin_instance  = $this->tgm_instance->plugins[ $plugin_id ];
		$plugin_activated = $this->tgm_instance->is_plugin_active( $plugin_id );
		$plugin_installed = $this->tgm_instance->is_plugin_installed( $plugin_id );
		$plugin_author    = '';
		$require_update   = false;
		$current_version  = $this->tgm_instance->get_installed_version( $plugin_id );
		$plugin_class     = 'not-installed';

		if ( $plugin_installed ) {
			$plugin_class   = 'installed';
			$plugin_author  = $this->tgm_instance->get_plugin_author( $plugin_id );
			$require_update = $this->tgm_instance->does_plugin_require_update( $plugin_id );

			if ( $plugin_activated ) {
				$plugin_class = 'activated';
			}

			if ( $require_update ) {
				$plugin_class = 'need-update';
			}
		}

		if ( ! empty( $plugin_author ) ) {
			$plugin_author =
				'<div class="ak-plugin-author">
                    ' . esc_html__( 'by', 'ak-framework' ) . '
                    <strong>
                        ' . esc_html( $plugin_author ) . '
                    </strong>
                </div>';
		}
		?>
		<div class="ak-install-plugin-page-item <?php echo esc_attr( $plugin_class ); ?>" data-id="<?php echo esc_attr( $plugin_id ); ?>">
			<div class="ak-plugin-item ">
				<div class="ak-flex-row ak-flex-row-responsive ">
					<?php if ( ! empty( $plugin['thumbnail'] ) ) : ?>
						<figure class="ak-flex-column ak-flex-column-normal ">
							<img class="ak-plugin-thumbnail" src="<?php echo esc_url( $plugin['thumbnail'] ); ?>">
						</figure>
					<?php endif; ?>
					<div class="ak-plugin-info ak-flex-column ak-flex-column-grow ak-flex-justify-content-center">
						<div class="ak-plugin-title">
							<?php echo esc_html( $plugin['name'] ); ?>
						</div>
						<div class="ak-plugin-desc">
							<?php echo esc_html( $plugin['description'] ); ?>
						</div>
						<?php ak_sanitize_echo( $plugin_author ); ?>
						<div class="ak-plugin-version">
							<?php ak_sanitize_echo( $this->get_plugin_versions( $plugin_id ) ); ?>
						</div>
					</div>
					<div class="ak-plugin-buttons ak-flex-column ak-flex-column-normal ak-flex-justify-content-center">
						<a href="<?php echo esc_url( $this->get_plugin_action_url( $plugin_id, 'install' ) ); ?>" class="ak-btn ak-primary-btn ak-install-plugin ak_plugin_action_btn">
							<i class="fa fa-download"></i> <?php esc_html_e( 'Install', 'ak-framework' ); ?>
						</a>
						<!-- @TODO try to find what is the issue our updater -->
						<a href="<?php echo esc_url( $this->get_plugin_action_url( $plugin_id, 'update' ) ); ?>" class="ak-btn ak-success-btn ak-update-plugin ak_plugin_action_btn" style="display:none!important">
							<?php esc_html_e( 'Update', 'ak-framework' ); ?>
						</a>
						<a href="<?php echo esc_url( admin_url( 'themes.php?page=ak-install-plugins&plugin_status=update' ) ); ?>" class="ak-btn ak-success-btn ak-update-plugin">
							<?php esc_html_e( 'Update', 'ak-framework' ); ?>
						</a>
						<a href="<?php echo esc_url( $this->get_plugin_action_url( $plugin_id, 'activate' ) ); ?>" class="ak-btn ak-primary-btn ak-activate-plugin ak_plugin_action_btn">
							<?php esc_html_e( 'Activate', 'ak-framework' ); ?>
						</a>
						<?php if ( ! $plugin_instance['required'] ) : ?>
						<a href="<?php echo esc_url( $this->get_plugin_action_url( $plugin_id, 'deactivate' ) ); ?>" class="ak-btn ak-deactivate-plugin ak_plugin_action_btn">
							<?php esc_html_e( 'Deactivate', 'ak-framework' ); ?>
						</a>
						<?php else : ?>
						<div class="plugin-action-info">
							<i class="ak-icon fa fa-info-circle"></i>
							<?php esc_html_e( 'This Plugin Required by Theme', 'ak-framework' ); ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	public function get_plugin_versions( $plugin_id ) {
		$installed_version = $this->tgm_instance->get_installed_version( $plugin_id );
		$minimum_version   = $this->tgm_instance->plugins[ $plugin_id ]['version'];

		if ( ! empty( $installed_version ) ) {
			$installed_version =
				'<li>
                    ' . esc_html__( 'Installed Version :', 'ak-framework' ) . '
                    <strong class="installed-version">
                        ' . esc_html( $installed_version ) . '
                    </strong>
                </li>';
		}

		if ( ! empty( $minimum_version ) ) {
			$minimum_version =
				'<li class="required-version">
                    ' . esc_html__( 'Required Version :', 'ak-framework' ) . '
                    <strong>
                        ' . esc_html( $minimum_version ) . '
                    </strong>
                </li>';
		}

		if ( empty( $installed_version ) && empty( $minimum_version ) ) {
			return '';
		}

		return '<ul>' . $installed_version . $minimum_version . '</ul>';
	}


	public function get_plugin_action_url( $slug, $install_type ) {

		$url = wp_nonce_url(
			add_query_arg(
				array(
					'plugin'                 => urlencode( $slug ),
					'tgmpa-' . $install_type => $install_type . '-plugin',
				),
				$this->tgm_instance->get_tgmpa_url()
			),
			'tgmpa-' . $install_type,
			'tgmpa-nonce'
		);

		if ( 'deactivate' === $install_type || 'activate' === $install_type ) {
			$url = $url . '#' . $slug;
		}

		return $url;
	}

	/**
	 * ajax handler for demo install/unInstall demo requests.
	 *
	 * @param array $params
	 *
	 * @return bool true on success or false on failure.
	 */
	public function ajax_request() {
		if ( ! isset( $_POST ) || ! isset( $_POST['import_id'] ) || ! isset( $_POST['import_action'] ) ) {
			return false;
		}

		$params = $_POST;

		$import_action = &$params['import_action'];
		$import_id     = &$params['import_id'];
		$importer      = new ImporterPlugin;

		$response = array();
		try {
			switch ( $import_action ) {
				case 'install':
				case 'update':
					$response = $importer->create( $import_id );

					return array(
						'success'      => 1,
						'version_html' => $this->get_plugin_versions( $import_id ),
					);
					break;

				// Delete all installed data for demo
				case 'activate':
					$response = $importer->activate_plugins( $import_id );
					break;

				// Force to delete all installed data for demo
				case 'deactivate':
					$response = $importer->deactivate_plugins( $import_id );
					break;
			}
		} catch ( \Exception $e ) {
			$response = new \WP_Error( $e->getCode(), $e->getMessage() );
		}

		return $response;
	}

}
