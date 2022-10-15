<?php
/***
 * The Ak Framework
 *
 * Ak Framework is framework for WordPress themes and plugins.
 *
 *  Copyright © 2020 akbilisim
 *  www.akbilisim.com
 *
 *  Envato Profile: https://themeforest.net/user/akbilisim
 */

namespace Ak\Ajax;

use Ak\Support\Font;
use Ak\Support\Icon;
use Ak\Product\ProductPanel;

/**
 * Class Ak Framework Backend Ajax.
 *
 * @package  ak-framework
 */
class BackendAjax {

	/**
	 * @var BackendAjax
	 */
	private static $instance;

	/**
	 * BackendAjax constructor.
	 */
	private function __construct() {
		add_action( 'wp_ajax_ak_admin_ajax', array( $this, 'ak_admin_ajax' ) );
	}

	/**
	 * @return BackendAjax
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Handle ajax requests.
	 */
	public function ak_admin_ajax() {
		try {
			$response = false;

			//validate request
			// Check Nonce
			if ( ! isset( $_POST['nonce'] ) || ! isset( $_POST['action_id'] ) ) {
				wp_send_json(
					array(
						'success' => 0,
						'result'  => array(
							'code'    => 'Security',
							'message' => 'Security Error!',
						),
					)
				);
			}
			// Check nonce value
			$_nonce = wp_verify_nonce( $_POST['nonce'], 'ak_nonce' );

			// Check Nonce
			if ( ! $_nonce ) {
				wp_send_json(
					array(
						'success' => 0,
						'result'  => array(
							'code'    => 'Security',
							'message' => 'Security(nonce) Error!',
						),
					)
				);
			}

			switch ( $_POST['action_id'] ) {
				case ( 'product-panel' ):
					if ( isset( $_POST['module_id'] ) ) {
						$response = ProductPanel::get_instance()->get_page_ajax( $_POST['module_id'] );
					}

					break;

				case ( 'ajax-icon-manager' ):
					$response = Icon::get_instance()->get_icons();

					break;

				case ( 'ajax-font-manager' ):
					$response = Font::get_instance()->get_fonts();

					break;

				case ( 'control-select-callback' ):
					$callback = $_POST['callback'];
					$response = ak_fields_callback( $callback );
					break;

				default:
					$response = false;
					break;
			}

			$response = apply_filters( 'ak-framework/backend/ajax', $response, $_POST );

			if ( is_wp_error( $response ) ) {
				wp_send_json(
					array(
						'success' => 0,
						'result'  => array(
							'code'    => $response->get_error_code(),
							'message' => $response->get_error_message(),
						),
					)
				);
			} elseif ( false === $response ) {
				wp_send_json(
					array(
						'success' => 0,
						'result'  => array(
							'code'    => 'Error',
							'message' => 'invalid request',
						),
					)
				);
			} elseif ( ak_is_json( $response ) ) {
				die( $response );
			} else {
				wp_send_json(
					array(
						'success' => 1,
						'result'  => $response,
					)
				);
			}
		} catch ( \Exception $e ) {
			wp_send_json(
				array(
					'success' => 0,
					'result'  => array(
						'code'    => 'Error',
						'message' => 'invalid request',
					),
				)
			);
		}

		exit;
	}
}
