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
 * Class Ak Framework Frontend Asset.
 *
 * @package  ak-framework
 */
class FrontendAsset {

	/**
	 * Framework generated frontend assets folder.
	 *
	 * @var string
	 */
	public $folder_name = 'ak_framework';

	/**
	 * Framework generated font option key.
	 *
	 * @var string
	 */
	public $fonts_option_key = 'ak_fonts_key';

	/**
	 * Framework generated style file key.
	 *
	 * @var string
	 */
	public $file_option_key = 'ak_style_key';

	/**
	 * Framework generated style file extension.
	 *
	 * @var string
	 */
	public $file_extension = 'css';

	/**
	 * @var FrontendAsset
	 */
	private static $instance;

	/**
	 * @return FrontendAsset
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Constructer
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'register_front_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_generated_font' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_generated_css' ), 9999 );
		add_action( 'wp_head', array( $this, 'register_dynamic_css' ) );
	}

	/**
	 * Register supported front scripts
	 */
	public function register_front_scripts() {
		wp_register_style( 'fontawesome', ak_get_uri( 'assets/css/fontawesome.min.css' ), array(), null );
		wp_register_style( 'sweetalert', ak_get_uri( 'assets/lib/sweetalert/sweetalert.min.css' ), array(), null );
		wp_register_style( 'selectize', ak_get_uri( 'assets/lib/selectize/selectize.min.css' ), array(), null );
		wp_register_style( 'ak-anim', ak_get_uri( 'assets/css/ak-anim.css' ), array(), AK_FRAMEWORK_VERSION );
		wp_style_add_data( 'ak-anim', 'rtl', 'replace' );
		wp_register_style( 'tiny-slider', ak_get_uri( 'assets/lib/tiny-slider/tiny-slider.min.css' ), array(), null );

		wp_register_script( 'sweetalert', ak_get_uri( 'assets/lib/sweetalert/sweetalert.min.js' ), null, AK_FRAMEWORK_VERSION, true );
		wp_register_script( 'selectize', ak_get_uri( '/assets/lib/selectize/selectize.min.js' ), null, AK_FRAMEWORK_VERSION, true );
		wp_register_script( 'tiny-slider', ak_get_uri( 'assets/lib/tiny-slider/tiny-slider.min.js' ), null, AK_FRAMEWORK_VERSION, true );
		wp_register_script( 'waypoint', ak_get_uri( 'assets/lib/jquery.waypoints.js' ), null, AK_FRAMEWORK_VERSION, true );

		//Main handler script ak pagination and tabs
		wp_register_script( 'ak-pagination', ak_get_uri( 'assets/js/ak-pagination.js' ), array( 'waypoint' ), AK_FRAMEWORK_VERSION, true );
		wp_register_script( 'ak-slider', ak_get_uri( 'assets/js/ak-slider.js' ), array( 'tiny-slider' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Enqueue generated front style file.
	 */
	public function enqueue_generated_css() {
		$url = $this->get_css_upload_url();
		if ( ! empty( $url ) ) {
			wp_enqueue_style( 'ak-generated-css', ak_sanitize_protocol( $url ), array(), null );
		}
	}

	/**
	 * Enqueue generated front style file.
	 */
	public function enqueue_generated_font() {
		$url = $this->get_font_url();
		if ( ! empty( $url ) ) {
			wp_enqueue_style( 'ak-generated-fonts', $url, array(), null );
		}
	}

	/**
	 * Enqueue dynamic front css.
	 */
	public function register_dynamic_css() {
		$css = $this->get_dynamic_css();
		if ( false !== $css ) {
			ak_register_css( $css );
		}
	}

	/**
	 * Get dynamic css for current screen.
	 */
	public function get_dynamic_css() {
		$type = false;

		//only for taxonomies
		if ( is_tax() || is_archive() || is_category() ) {
			$type = 'tax';
		} elseif ( is_page() || is_singular() ) {
			$type = 'post';
		} elseif ( is_author() ) {
			$type = 'user';
		}

		if ( ! $type ) {
			return false;
		}

		$id         = get_queried_object_id();
		$cached_css = get_transient( 'ak_' . $type . '_' . $id . '_css' );

		return $cached_css;
	}

	/**
	 * Generate framework css file uri.
	 */
	public function generate_url( $path ) {
		$file_key = $this->get_file_key();

		if ( ! empty( $file_key ) ) {
			return sprintf( '%s/%s/%s.%s', $path, $this->folder_name, $file_key, $this->file_extension );
		}

		return false;
	}

	/**
	 * Get WP upload uri.
	 */
	public function get_css_upload_url() {
		$wp_upload_dir = wp_upload_dir();

		return $this->generate_url( $wp_upload_dir['baseurl'] );
	}

	/**
	 * Get WP upload PATH.
	 */
	public function get_css_upload_path() {
		$wp_upload_dir = wp_upload_dir();

		return $this->generate_url( $wp_upload_dir['basedir'] );
	}

	/**
	 * Get framework css file key.
	 */
	public function get_file_key() {
		return ak_get_option( $this->file_option_key );
	}

	/**
	 * Get framework fonts url.
	 */
	public function get_font_url() {
		return ak_get_option( $this->fonts_option_key );
	}
}
