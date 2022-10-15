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

use Ak\Product\Product;
use Ak\Form\FormManager;

/**
 * Class AK_Option_Panel.
 */
class ProductOptionPanel extends ProductPanelAbstract {

	/**
	 * Page ID.
	 */
	public $id = 'option-panel';

	/**
	 * Sections of panels.
	 *
	 * @var null
	 */
	public $fields = array();

	public function __construct() {
		parent::__construct();

		// Hook admin assets enqueue
		add_filter( 'ak-framework/option-panel/save/options', array( $this, 'prepare_save_options' ), 11, 2 );
	}

	public function enqueue() {
		wp_enqueue_script( 'jquery-fileupload', AK_FRAMEWORK_URL . '/assets/lib/jquery.fileupload.js', array( 'jquery', 'jquery-ui-widget' ) );
		wp_enqueue_script( 'ak-panel-scripts', AK_FRAMEWORK_URL . '/assets/js/panel/ak-panel.js', array( 'jquery', 'jquery-fileupload', 'sweetalert' ), AK_FRAMEWORK_VERSION, true );

		wp_localize_script(
			'ak-panel-scripts',
			'ak_option_panel_loc',
			apply_filters(
				'ak_option_panel_loc',
				array(
					'error'   => array(
						'title'             => __( 'An error occurred while installing demo', 'ak-framework' ),
						'text'              => __( 'Please try again several minutes later or contact support.', 'ak-framework' ),
						'confirmButtonText' => __( 'Ok', 'ak-framework' ),
					),
					'success' => array(
						'title'             => __( 'Options successfully saved.', 'ak-framework' ),
						'text'              => __( 'All options saved.', 'ak-framework' ),
						'confirmButtonText' => __( 'Ok', 'ak-framework' ),
					),
				)
			)
		);
		$custom_font_css = get_transient( 'ak_font_manager_custom_font_css' );
		if ( $custom_font_css ) {
			ak_register_admin_css( $custom_font_css, true );
		}
	}

	/**
	 * Render Theme panel content.
	 *
	 * @param $module_config
	 */
	public function render_content() {
		$panel_options = ! empty( $this->page['config']['panel_options'] ) ? $this->page['config']['panel_options'] : array();
		$option_id     = ! empty( $panel_options['option_id'] ) ? $panel_options['option_id'] : '';
		$panel_class   = ! empty( $panel_options['panel_class'] ) ? $panel_options['panel_class'] : '';

		if ( empty( $option_id ) ) {
			echo 'Missing Configuration';
			return;
		}

		$manager = new FormManager(
			array_merge(
				array(
					'option_type' => 'option',
					'option_id'   => $option_id,
					'prepare'     => true,
					'get_value'   => true,
					'panel_class' => 'ak-panel-options ' . $panel_class . ' ak-panel-' . esc_attr( $option_id ),
				), $panel_options
			)
		);

		$output = '';
		if ( $manager->has_fields() ) {
			$output .= '<div class="ak-option-panel-container ak-clearfix">';
			$output .= '<form id="ak_panel_form" action="" method="post" onsubmit="return false">';
			$output .= $manager->render_form();
			$output .= '</form>';

			$save_btn           = ! empty( $this->page['config']['save-btn-text'] ) ? $this->page['config']['save-btn-text'] : __( 'Save Changes', 'ak-framework' );
			$reset_confirm_btn  = ! empty( $this->page['config']['reset-confirm-text'] ) ? $this->page['config']['reset-confirm-text'] : __( 'Are your sure? Your setting will be lost!', 'ak-framework' );
			$import_confirm_btn = ! empty( $this->page['config']['import-confirm-text'] ) ? $this->page['config']['import-confirm-text'] : __( 'Are your sure? Your setting will be lost!', 'ak-framework' );
			$reset_btn          = ! empty( $this->page['config']['reset-btn-text'] ) ? $this->page['config']['reset-btn-text'] : __( 'Reset', 'ak-framework' );
			$export_btn         = ! empty( $this->page['config']['export-btn-text'] ) ? $this->page['config']['export-btn-text'] : __( 'Export', 'ak-framework' );
			$import_btn         = ! empty( $this->page['config']['import-btn-text'] ) ? $this->page['config']['import-btn-text'] : __( 'Import', 'ak-framework' );

			$output .= '<div class="ak-panel-save-container ak-clearfix">
							<div class="ak-panel-save-sticky">
								<a href="javascript:void();" class="ak-btn ak-primary-btn ak-save-button">
									<i class="fa fa-save"></i> ' . esc_html( $save_btn ) . '
								</a>

								<div class="ak_import_button ak-import-form" data-option-id="' . esc_attr( $option_id ) . '" data-confirm="' . esc_attr( $import_confirm_btn ) . '">
									<input type="file" name="ak-import-file-input" id="ak-import-file-input" class="ak-import-file-input" />
									<label class="ak-btn" for="ak-import-file-input"><i class="fa fa-upload"></i> ' . esc_html( $import_btn ) . '</label>
								</div>
								<a href="javascript:void();" class="ak-btn ak_download_export" data-file-name="' . esc_attr( $option_id ) . '" data-option-id="' . esc_attr( $option_id ) . '">
									<i class="fa fa-download"></i> ' . esc_html( $export_btn ) . '
								</a>
								<a href="javascript:void();" class="ak-btn ak-reset-button" data-confirm="' . esc_attr( $reset_confirm_btn ) . '">
									<i class="fa fa-repeat"></i>' . esc_html( $reset_btn ) . '
								</a>
								<input type="hidden" id="ak-panel-id" value="' . esc_attr( $option_id ) . '"/>
							</div>
						</div>';
			$output .= '</div>';
		}

		ak_sanitize_echo( $output );
	}

	public function prepare_save_options( $options, $option_id ) {

		$page_config   = Product::get_instance()->get_page_by_option_id( $option_id );
		$panel_options = ! empty( $page_config['config']['panel_options'] ) ? $page_config['config']['panel_options'] : array();

		$manager = new FormManager(
			array_merge(
				array(
					'option_type' => 'option',
					'option_id'   => $option_id,
					'prepare'     => true,
					'get_value'   => true,
				),
				$panel_options
			)
		);

		$options = $manager->prepare_form_fields_for_save( $options );

		return $options;
	}


	/**
	 * Option panel ajax requests.
	 *
	 * @param $params
	 */
	public function ajax_request() {
		if ( ! isset( $_POST ) || ! isset( $_POST['option_id'] ) ) {
			return false;
		}

		$params = &$_POST;

		/*
		 * Fires before ajax request
		 *
		 * @since 1.0
		 */
		do_action( 'ak-framework/option-panel/ajax/before', $params );

		$option_id = &$params['option_id'];

		$lang_prefix = isset( $_POST['lang'] ) && ! empty( $_POST['lang'] ) ? '_' . $_POST['lang'] : '';

		$response = false;
		try {
			switch ( $params['page_action'] ) {
				// Save Option Panel Settings
				case ( 'save_options' ):
					if ( isset( $params['data'] ) || ! empty( $params['data'] ) ) {

						$options = ak_parse_str( ltrim( rtrim( stripslashes( $params['data'] ), '&' ), '&' ) );

						// Fix for magic_quotes_gpc
						if ( function_exists( 'get_magic_quotes_gpc' ) && is_callable( 'get_magic_quotes_gpc' ) && get_magic_quotes_gpc() ) {
							$options = stripslashes_deep( $options );
						}

						// Add/Update options
						$response = $this->handle_option_save( $options, $option_id );
					}

					break;

				case ( 'reset_options' ):
						/**
						 * Fires before options reset
						 *
						 * @param string $params   contain options
						 */
						do_action( 'ak-framework/option-panel/reset/before', $option_id );

						// save empty
						ak_delete_option( $option_id );
						$this->handle_option_save( array(), $option_id );
						$response = true;
						/**
						 * Fires after options reset
						 *
						 * @param array  $response contains result of reset
						 */
						do_action( 'ak-framework/option-panel/reset/after', $option_id, $response );

					break;

				// Option Panel, Import Settings
				case ( 'import' ):
					$file = $_FILES['ak-import-file-input'];

					$data = ak_get_local_file_content( $file['tmp_name'] );

					$data = json_decode( $data, true );

					if ( empty( $data ) ) {
						return false;
					}

					// Add/Update options
					ak_delete_option( $option_id );
					$this->handle_option_save( $data, $option_id );

					$response = array(
						'refresh' => true,
					);
					break;

				// Option Panel, Export Settings
				case ( 'export' ):
					$options = ak_get_option( $option_id );

					$options = ak_array_filter_empty_fields( $options );

					/**
					 * Filter options before export.
					 *
					 * @since 1.0.0
					 *
					 * @param array  $options contains options
					 * @param string $option_id   contain option id
					 */
					$options = apply_filters( 'ak-framework/option-panel/export/options', $options, $option_id );

					/*
					 * Fires before options export
					 *
					 * @since 1.0.0
					 *
					 * @param string $options contains export data
					 */
					do_action( 'ak-framework/option-panel/export/options/before', $options );

					// Custom file name for each theme
					$file_name = ! empty( $_POST['file_name'] ) ? $_POST['file_name'] : 'backup-options';

					if ( ! empty( $lang_prefix ) ) {
						$file_name .= $lang_prefix;
					}

					$file_name .= '_' . gmdate( 'm-d-Y h:i:s a', time() );

					/**
					 * Filter export file name.
					 *
					 * @since 1.0.0
					 *
					 * @param string $filename contains current file name
					 * @param string $option_id   contain option id
					 */
					$file_name = apply_filters( 'ak-framework/export-options/file-name', $file_name, $option_id );

					$options = json_encode( $options );

					// No Cache
					header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
					header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
					header( 'Cache-Control: no-store, no-cache, must-revalidate' );
					header( 'Cache-Control: post-check=0, pre-check=0', false );
					header( 'Pragma: no-cache' );
					header( 'Content-Type: application/force-download' );
					//header( 'Content-Length: ' . strlen( $panel_data ) );
					header( 'Content-Disposition: attachment; filename="' . $file_name . '.json"' );

					die( $options );

				break;
			}
		} catch ( \Exception $e ) {
			$response = new \WP_Error( $e->getCode(), $e->getMessage() );
		}

		/*
		 * Fires after ajax request
		 *
		 * @since 1.0
		 */
		do_action( 'ak-framework/option-panel/ajax/after', $params, $response );

		return $response;
	}


	/**
	 * Reset All Options.
	 *
	 * @since 1.0
	 *
	 * @param $data
	 *
	 * @return void
	 */
	private function handle_option_save( $options, $option_id ) {

		/**
		 * Filter options before save.
		 *
		 * @since 1.4.0
		 *
		 * @param array  $result contains result of reset
		 * @param string $data   contain options
		 */
		$options = apply_filters( 'ak-framework/option-panel/save/options', $options, $option_id );

		// Add/Update options
		$response = ak_update_option( $option_id, $options );

		/**
		* Fires after options save
		*
		* @since 1.0
		*
		* @param string $options contains export data
		*/
		do_action( 'ak-framework/option-panel/save/after', $option_id, $options, $response );

		return $response;
	}

}
