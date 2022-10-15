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
 * Class Product License manager.
 *
 * @package  ak-framework
 */
class ProductLicense {

	const VERSION = '1.0.0';

	/**
	 * @var ProductLicense
	 */
	private static $instance;

	/**
	 * Akbilisim API URI.
	 *
	 * @var string
	 */
	private $api_url = 'https://support.akbilisim.com/api/v1/%action%';

	/**
	 * @return ProductLicense
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Handle Check Purchase.
	 *
	 * @throws Exception
	 *
	 * @return array|false|object array or object on success, false|Exception on failure
	 */
	public function handle_check_purchase( $item_id ) {
		$response = false;

		if ( ! empty( $item_id ) ) {
			$data = array(
				'item_id'       => $item_id,
				'purchase_code' => $this->get_product_purchase_info( $item_id ),
				'access_code'   => $this->get_access_code_info( $item_id ),
			);

			$response = $this->handle_activation( 'check-purchase', $data );
		}

		return $response;
	}

	/**
	 * Handle API Activation Request.
	 *
	 * @return array|false|object array or object on success, false|Exception on failure
	 */
	public function handle_activation( $action, $args, $assoc = true ) {
		$response = false;

		if ( ! isset( $args['purchase_code'] ) || ! $this->validate_purchase_code_format( $args['purchase_code'] ) ) {
			$this->delete_product_purchase_info( $args['item_id'] );
			$this->delete_access_code_info( $args['item_id'] );
			return new \WP_Error( 'error', __( 'Please add valid purchase code!', 'ak-framework' ) );
		}
		$request = $this->handle_request( $action, $args, $assoc );

		if ( $request ) {
			if ( 'error' === $request['status'] ) {
				$this->delete_product_purchase_info( $args['item_id'] );

				return new \WP_Error( 'error', 'Api Error: ' . $request['message'] );
			} elseif ( 'auth' === $request['status'] ) {
				$response = $request;
			} elseif ( 'success' === $request['status'] ) {
				if ( 'register-purchase' === $action ) {
					$this->register_product_purchase_info( $args['item_id'], $args['purchase_code'] );
					if ( isset( $request['data']['access_code'] ) ) {
						$this->register_access_code_info( $args['item_id'], $request['data']['access_code'] );
					}
				} elseif ( 'deregister-purchase' === $action ) {
					$this->delete_product_purchase_info( $args['item_id'] );
					$this->delete_access_code_info( $args['item_id'] );
				}
				$response = $request;
			}
		}

		return $response;
	}

	/**
	 * Handle API Request.
	 *
	 * @return array|false|object array or object on success, false|Exception on failure
	 */
	public function handle_request( $action, $args, $assoc = true ) {
		$received = $this->fetch_data( $this->get_api_url( $action ), $args );
		if ( $received ) {
			return json_decode( $received, $assoc );
		}

		return false;
	}

	/**
	 * Fetch a API url.
	 *
	 * @param string $url
	 * @param array  $args wp_remote_get() $args
	 *
	 * @throws Exception
	 *
	 * @return string|false string on success or false|Exception on failure.
	 */
	public function fetch_data( $url, $args = array() ) {
		global $wp_version;

		$args = $this->get_api_args( $args );

		// FIX SSL SNI
		$filter_add = true;
		if ( function_exists( 'curl_version' ) ) {
			$version = curl_version();
			if ( version_compare( $version['version'], '7.18', '>=' ) ) {
				$filter_add = false;
			}
		}
		if ( $filter_add ) {
			add_filter( 'https_ssl_verify', '__return_false' );
		}

		$data = array(
			'timeout'    => 30,
			'user-agent' => 'AkApi Domain: ' . $this->get_site_url() .
				'; WordPress/' . $wp_version . '; AkApiFramework/' . self::VERSION . ';',
			'body'       => $args,
		);

		$raw_response = wp_remote_get( $url, $data );

		if ( $filter_add ) {
			remove_filter( 'https_ssl_verify', '__return_false' );
		}

		if ( is_wp_error( $raw_response ) ) {
			$error_message = $raw_response->get_error_message();

			if ( preg_match( '/^\s*cURL\s*error\s*(\d+)\s*\:?\s*$/i', $error_message, $match ) && function_exists( 'curl_strerror' ) ) {
				$error_message .= curl_strerror( $match[1] );
			}

			return new \WP_Error( 'no_credentials', $error_message, $raw_response->get_error_code() );
		}

		$response_code = wp_remote_retrieve_response_code( $raw_response );

		if ( 200 !== $response_code ) {
			$parse_url = parse_url( $url );

			return new \WP_Error( 'no_credentials', sprintf( 'Server cannot connect to %s. Please contact with Support ', $parse_url['host'] ), $response_code );
		}

		return wp_remote_retrieve_body( $raw_response );
	}

	/**
	 * Check if license key format is valid.
	 *
	 * license key is version 4 UUID, that have form xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx
	 * where x is any hexadecimal digit and y is one of 8, 9, A, or B.
	 *
	 * @param string $purchase_code
	 *
	 * @return boolean
	 */
	public function validate_purchase_code_format( $purchase_code ) {
		$purchase_code = str_replace( ' ', '', esc_html( $purchase_code ) );
		$pattern       = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';

		return (bool) preg_match( $pattern, $purchase_code );
	}

	public function get_api_url( $action ) {
		$api_url = apply_filters( 'ak-framework/product/license/api-url', $this->api_url );
		$url     = str_replace( '%action%', $action, $api_url );

		return $url;
	}

	public function get_activation_page_url() {
		global $wp;
		return home_url( $wp->request );
	}

	public function get_site_url() {
		return network_site_url();
	}

	public function get_api_args( $args = array() ) {
		return array_merge(
			$args, array(
				'url'        => $this->get_site_url(),
				'key'        => rawurlencode( $this->get_site_url() ),
				'active_url' => $this->get_activation_page_url(),
			)
		);
	}

	/**
	 * Get is product purchase code valid.
	 */
	public function is_product_purchase_valid( $item_id ) {
		$info_key = $this->get_product_purchase_info( $item_id );

		if ( ! $info_key || empty( $info_key ) ) {
			return false;
		}

		return $this->validate_purchase_code_format( $info_key );
	}

	/**
	 * Get product purchase code.
	 */
	public function get_product_purchase_info( $item_id ) {
		$info_key = sprintf( 'envato_purchase_code_%s', $item_id );

		return get_site_option( $info_key );
	}

	/**
	 * Register product purchase code.
	 */
	public function register_product_purchase_info( $item_id, $key ) {
		$info_key = sprintf( 'envato_purchase_code_%s', $item_id );

		update_site_option( $info_key, $key );
	}

	/**
	 * Delete product purchase code.
	 */
	public function delete_product_purchase_info( $item_id ) {
		$info_key = sprintf( 'envato_purchase_code_%s', $item_id );

		delete_site_option( $info_key );
	}

	/**
	 * Retrieve product registration information.
	 */
	public function register_access_code_info( $item_id, $key ) {
		$info_key = sprintf( 'ak_product_access_code_%s', $item_id );

		update_site_option( $info_key, $key );
	}

	/**
	 * Get product purchase code.
	 */
	public function get_access_code_info( $item_id ) {
		$info_key = sprintf( 'ak_product_access_code_%s', $item_id );

		return get_site_option( $info_key );
	}

	/**
	 * Delete product purchase code.
	 */
	public function delete_access_code_info( $item_id ) {
		$info_key = sprintf( 'ak_product_access_code_%s', $item_id );

		delete_site_option( $info_key );
	}
}
