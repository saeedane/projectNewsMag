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

namespace Ak\Ajax;

/**
 * Class Ak Framework Frontend Ajax.
 *
 * @package  ak-framework
 */
class FrontendAjax {

	/**
	 * @var FrontendAjax
	 */
	private static $instance;

	private $endpoint = 'ajax-request';

	/**
	 * @return FrontendAjax
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * FrontendAjax constructor.
	 */
	private function __construct() {
		add_action( 'wp_head', array( $this, 'frontend_ajax_script' ), 7 );

		add_action( 'parse_request', array( $this, 'ajax_parse_request' ) );
		add_filter( 'query_vars', array( $this, 'ajax_query_vars' ) );
	}

	/**
	 * Get the ak framework ajax url.
	 *
	 * @return void
	 */
	public function ajax_url() {
		return add_query_arg( array( $this->endpoint => 'ak' ), home_url( '/' ) );
	}

	/**
	 * Render the ajax url
	 *
	 * @return void
	 */
	public function frontend_ajax_script() {
		$script = '<script>
			var ak_ajax_url = "' . esc_url( $this->ajax_url() ) . '";
		</script>';

		ak_sanitize_echo( $script );
	}

	/**
	 * Add the query vars to ajax url.
	 *
	 * @param array $vars
	 * @return void
	 */
	public function ajax_query_vars( $vars ) {
		$vars[] = $this->endpoint;
		$vars[] = 'action';

		return $vars;
	}

	/**
	 * Parse the ak framework ajax request.
	 *
	 * @param object $wp
	 * @return void
	 */
	public function ajax_parse_request( $wp ) {
		if ( array_key_exists( $this->endpoint, $wp->query_vars ) ) {
			// this is ajax tell to wp
			add_filter( 'wp_doing_ajax', '__return_true' );

			if ( ! isset( $wp->query_vars['action'] ) ) {
				die();
			}

			$action = $wp->query_vars['action'];

			do_action( 'ak-framework/frontend/ajax', $action );

			exit;
		}
	}
}
