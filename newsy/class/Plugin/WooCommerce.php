<?php

namespace Newsy\Plugin;

/**
 * Newsy WooCommerce plugin compatibility handler.
 */
class WooCommerce {

	/**
	 * @var WooCommerce
	 */
	private static $instance;

	/**
	 * @return WooCommerce
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
			static::$instance->supports();
			static::$instance->hook();
		}

		return static::$instance;
	}


	public function supports() {
		// support woocommerce
		add_theme_support( 'woocommerce' );

		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	public function hook() {
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ), 99 );
		add_filter( 'newsy_user_default_dropdown', array( $this, 'user_dropdown_links' ), 15, 1 );
	}

	/**
	 * Custom woocommerce assets.
	*/
	public function register_scripts() {
		wp_enqueue_style( 'newsy-woocommerce', NEWSY_THEME_URI . '/assets/css/woocommerce.css', array(), NEWSY_THEME_VERSION );
		wp_style_add_data( 'newsy-woocommerce', 'rtl', 'replace' );
	}

	/**
	 * User nav links.
	 *
	 * @return array
	 */
	public function user_dropdown_links( $dropdown ) {
		$dropdown['order']        = array(
			'text' => newsy_get_translation( 'Order List', 'newsy', 'order_list' ),
			'url'  => wc_get_account_endpoint_url( 'orders' ),
		);
		$dropdown['edit-account'] = array(
			'text' => newsy_get_translation( 'Edit Account', 'newsy', 'edit_account' ),
			'url'  => wc_get_account_endpoint_url( 'edit-account' ),
		);

		return $dropdown;
	}

}
