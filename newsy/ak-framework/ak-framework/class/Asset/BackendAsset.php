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

/**
 * Class Ak Framework Bankend Asset.
 *
 * @package  ak-framework
 */
class BackendAsset {

	/**
	 * @var BackendAsset
	 */
	private static $instance;

	/**
	 * @return BackendAsset
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * BackendAsset constructor.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_backend_styles' ), 998 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_backend_scripts' ), 999 );

		add_action( 'upload_mimes', array( $this, 'allow_upload_mimes' ) );
	}

	/**
	 * Backend Styles
	 *
	 * @return void
	 */
	public function enqueue_backend_styles() {
		wp_register_style( 'fontawesome', AK_FRAMEWORK_URL . '/assets/css/fontawesome.min.css', array(), null );
		wp_register_style( 'sweetalert', AK_FRAMEWORK_URL . '/assets/lib/sweetalert/sweetalert.min.css', array(), null );
		wp_register_style( 'selectize', AK_FRAMEWORK_URL . '/assets/lib/selectize/selectize.min.css', array(), null );
		wp_register_style( 'ak-anim', ak_get_uri( 'assets/css/ak-anim.css' ), array(), AK_FRAMEWORK_VERSION );
		wp_style_add_data( 'ak-anim', 'rtl', 'replace' );

		// Ak Framework Admin styles
		wp_enqueue_style( 'ak-admin-style', AK_FRAMEWORK_URL . '/assets/css/admin-style.css', array( 'fontawesome' ), AK_FRAMEWORK_VERSION );
		wp_style_add_data( 'ak-admin-style', 'rtl', 'replace' );

		wp_enqueue_style( 'ak-form-control', AK_FRAMEWORK_URL . '/assets/css/ak-form.css', array( 'fontawesome', 'ak-anim', 'sweetalert', 'selectize' ), AK_FRAMEWORK_VERSION );
		wp_style_add_data( 'ak-form-control', 'rtl', 'replace' );
	}

	/**
	 * Backend scripts
	 */
	public function enqueue_backend_scripts() {
		$this->register_admin_scripts();
		$this->register_form_scripts();
		$this->enqueue_admin_scripts();

		do_action( 'ak-framework/enqueue/backend' );
	}

	/**
	 * Enqueue admin scripts
	 */
	public function enqueue_admin_scripts() {
		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		// Ak Framework Admin scripts
		wp_enqueue_script( 'ak-admin-script', AK_FRAMEWORK_URL . '/assets/js/admin-scripts.js', array( 'jquery', 'bootstrap-tooltip' ), AK_FRAMEWORK_VERSION, true );

		$ak_framework_loc = array(
			'ajax_url' => admin_url( 'admin-ajax.php', 'relative' ),
			'nonce'    => wp_create_nonce( 'ak_nonce' ),
			'type'     => ak_get_current_page_type(),
			'lang'     => ak_get_current_lang(),
			'is_ssl'   => is_ssl() ? 1 : 0,
		);
		$ak_framework_loc = ak_cookie_path( $ak_framework_loc );

		wp_localize_script( 'ak-admin-script', 'ak_framework_loc', apply_filters( 'ak-framework/admin/script/loc', $ak_framework_loc ) );
	}

	/**
	 * Register admin scripts
	 */
	public function register_admin_scripts() {
		wp_register_script( 'bootstrap-tooltip', AK_FRAMEWORK_URL . '/assets/lib/bootstrap-tooltip.js', array( 'jquery' ), AK_FRAMEWORK_VERSION, true );
		wp_register_script( 'sweetalert', AK_FRAMEWORK_URL . '/assets/lib/sweetalert/sweetalert.min.js', array( 'jquery' ), AK_FRAMEWORK_VERSION, true );
		wp_register_script( 'impression', AK_FRAMEWORK_URL . '/assets/lib/impression.js', array(), AK_FRAMEWORK_VERSION, true );
		wp_register_script( 'fuse-search', AK_FRAMEWORK_URL . '/assets/lib/fuse-search.min.js', array(), AK_FRAMEWORK_VERSION, true );
		wp_register_script( 'jquery-cookie', AK_FRAMEWORK_URL . '/assets/lib/jquery.cookie.min.js', array( 'jquery' ), AK_FRAMEWORK_VERSION, true );
		wp_register_script( 'jquery-custom-scrollbar', AK_FRAMEWORK_URL . '/assets/lib/jquery.custom-scrollbar.min.js', array( 'jquery' ), AK_FRAMEWORK_VERSION, true );
		wp_register_script( 'jquery-mousewheel', AK_FRAMEWORK_URL . '/assets/lib/jquery.mousewheel.min.js', array( 'jquery' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Register form scripts
	 */
	public function register_form_scripts() {
		wp_register_script( 'webfontloader', AK_FRAMEWORK_URL . '/assets/lib/webfontloader.min.js', array(), AK_FRAMEWORK_VERSION, true );
		wp_register_script( 'selectize', AK_FRAMEWORK_URL . '/assets/lib/selectize/selectize.min.js', array( 'jquery' ), AK_FRAMEWORK_VERSION, true );
		wp_register_script( 'ak-form-control', AK_FRAMEWORK_URL . '/assets/js/form/ak-form-manager.js', array( 'jquery' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Callback: Used for adding fonts mimes to WordPress uploader.
	 *
	 * Filter: upload_mimes
	 *
	 * @param array $mimes
	 *
	 * @return array
	 */
	public function allow_upload_mimes( $mimes ) {
		return array_merge(
			$mimes, array(
				'webm'  => 'video/webm',
				'webp'  => 'image/webp',
				'svg'   => 'image/svg+xml',
				'ico'   => 'image/vnd.microsoft.icon',
				'ttf'   => 'application/x-font-ttf',
				'otf'   => 'application/octet-stream',
				'woff'  => 'application/x-font-woff',
				'woff2' => 'application/x-font-woff2',
				'eot'   => 'application/vnd.ms-fontobject',
				'ogg'   => 'audio/ogg',
				'ogv'   => 'video/ogg',
			)
		);
	}
}
