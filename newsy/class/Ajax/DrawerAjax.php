<?php

namespace Newsy\Ajax;

/**
 * Class DrawerAjax.
 */
class DrawerAjax {

	/**
	 * Handle drawer ajax request.
	 *
	 * @return void
	 */
	public static function handle_load() {
		$required_keys = array(
			'nonce' => '',
		);

		// checking for valid ajax params
		if ( array_diff_key( $required_keys, $_POST ) ) {
			wp_send_json(
				array(
					'success' => 0,
					'message' => 'Invalid Request!',
				)
			);
		}

		if ( empty( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'newsy_nonce' ) ) {
			wp_send_json(
				array(
					'success'       => 0,
					'refresh_nonce' => 1,
					'message'       => 'Invalid Token!',
				)
			);
		}

		ob_start();

		get_template_part( 'views/builder/drawer-builder' );

		wp_send_json(
			array(
				'success' => 1,
				'html'    => ob_get_clean(),
			)
		);
	}
}
