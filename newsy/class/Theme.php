<?php

namespace Newsy;

use Newsy\Plugin\WSL;
use Newsy\Support\Ads;
use Newsy\Plugin\MyCred;
use Newsy\Support\Embed;
use Newsy\Plugin\BbPress;
use Newsy\Plugin\BuddyPress;
use Newsy\Support\Gutenberg;
use Newsy\Plugin\WooCommerce;
use Newsy\Support\VideoThumbnail;

/**
 * Newsy Theme Class.
 * The Theme class that handles main functionality of Newsy theme.
 */
class Theme {

	/**
	 * @var Theme
	 */
	private static $instance;

	/**
	 * @return Theme
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
			static::$instance->init();
		}

		return static::$instance;
	}

	/**
	 * Fire up newsy.
	 */
	private function init() {
		$this->register_textdomain();
		$this->register_includes();
		$this->register_hook();
	}

	/**
	 * Initialize language.
	 */
	public function register_textdomain() {
		load_theme_textdomain( 'newsy', get_parent_theme_file_path( 'languages' ) );
	}

	/**
	 * Initialize functions.
	 */
	public function register_includes() {
		if ( ! defined( 'AK_FRAMEWORK_PATH' ) ) {
			require_once NEWSY_THEME_PATH . 'includes/framework-fallbacks.php';
		}

		require_once NEWSY_THEME_PATH . 'includes/theme-config.php';
		require_once NEWSY_THEME_PATH . 'includes/theme-helper.php';
		require_once NEWSY_THEME_PATH . 'includes/theme-filter.php';
		require_once NEWSY_THEME_PATH . 'includes/theme-content.php';

		if ( is_admin() || ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) || is_customize_preview() ) {
			require_once NEWSY_THEME_PATH . 'includes/theme-admin.php';
		}
	}

	/**
	 * Initialize setup hook.
	 */
	public function register_hook() {
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
	}

	/**
	 * Initialize theme.
	 */
	public function theme_setup() {
		$this->theme_support();
		$this->theme_hook();
		$this->theme_plugin();
		$this->theme_functionality();
	}

	/**
	 * Theme Supports
	 */
	public function theme_support() {
		// gutenberg
		add_theme_support( 'editor-styles' );
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'responsive-embeds' );

		// This feature enables post and comment RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Switch default core markup to valid HTML5 output.
		add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );

		// Add theme title tag support
		add_theme_support( 'title-tag' );

		// Featured images settings
		add_theme_support( 'post-thumbnails' );

		// Post formats
		add_theme_support( 'post-formats', array( 'video', 'gallery' ) );

		// use old widgets
		remove_theme_support( 'widgets-block-editor' );
	}

	/**
	 * Initialize theme.
	 */
	public function theme_hook() {
		// enqueue in header
		add_action( 'wp_head', array( $this, 'wp_head' ) );

		// enqueue in footer
		add_action( 'wp_footer', array( $this, 'wp_footer' ) );

		// Enqueue assets (css, js)
		add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ), 98 );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_demo_styles' ), 998 );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ), 99 );

		// Enqueue admin scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_assets' ), 999 );

		add_filter( 'body_class', array( $this, 'add_body_class' ) );
	}

	/**
	 * Initialize theme.
	 */
	public function theme_plugin() {
		if ( defined( 'WC_VERSION' ) ) {
			WooCommerce::get_instance();
		}

		if ( class_exists( 'bbPress' ) ) {
			BbPress::get_instance();
		}

		if ( class_exists( 'buddypress' ) ) {
			BuddyPress::get_instance();
		}

		if ( class_exists( 'myCRED_Core' ) ) {
			MyCred::get_instance();
		}

		if ( defined( 'WORDPRESS_SOCIAL_LOGIN_ABS_PATH' ) ) {
			WSL::get_instance();
		}
	}

	/**
	 * Theme functionalities.
	 */
	public function theme_functionality() {
		if ( function_exists( 'register_block_type' ) ) {
			// Handle editor style
			Gutenberg::get_instance();
		}

		// Handle theme ads
		if ( defined( 'NEWSY_ELEMENTS_PATH' ) ) {
			Ads::get_instance();
		}

		// Handle video post thumbnail
		VideoThumbnail::get_instance();

		// Handle embed
		Embed::get_instance();
	}


	/**
	 * Enqueue theme css files.
	 *
	 * Action Callback: wp_enqueue_scripts
	 */
	public function register_styles() {
		$asset_url = NEWSY_THEME_URI . '/assets/';

		wp_enqueue_style( 'ak-anim' );
		wp_enqueue_style( 'fontawesome' );
		wp_enqueue_style( 'magnific-popup', $asset_url . 'css/magnific-popup.css', null, NEWSY_THEME_VERSION );
		wp_enqueue_style( 'newsy-akfi', $asset_url . 'css/akfi.css', null, NEWSY_THEME_VERSION );
		wp_enqueue_style( 'newsy-frontend', $asset_url . 'css/style.css', null, NEWSY_THEME_VERSION );
		wp_style_add_data( 'newsy-frontend', 'rtl', 'replace' );
	}

	/**
	 * Enqueue demo css files.
	 *
	 * Action Callback: wp_enqueue_scripts
	 */
	public function register_demo_styles() {
		$current_theme = get_option( 'newsy_current_theme_style' );
		if ( $current_theme ) {
			wp_enqueue_style( 'newsy-demo-style', NEWSY_THEME_URI . '/includes/demos/' . $current_theme . '/style.css', null, NEWSY_THEME_VERSION );
		}
	}

	/**
	 * Enqueue css and js files.
	 *
	 * Action Callback: wp_enqueue_scripts
	 */
	public function register_scripts() {
		$asset_url = NEWSY_THEME_URI . '/assets/';

		// Theme libraries
		wp_enqueue_script( 'magnific-popup', $asset_url . 'js/jquery.magnific-popup.js', null, NEWSY_THEME_VERSION, true );
		wp_enqueue_script( 'ResizeSensor', $asset_url . 'js/ResizeSensor.js', null, NEWSY_THEME_VERSION, true );
		wp_enqueue_script( 'theia-sticky-sidebar', $asset_url . 'js/theia-sticky-sidebar.js', null, NEWSY_THEME_VERSION, true );
		wp_enqueue_script( 'superfish', $asset_url . 'js/superfish.js', null, NEWSY_THEME_VERSION, true );
		// Theme Scripts
		wp_enqueue_script( 'newsy-frontend', $asset_url . 'js/theme.min.js', array( 'jquery' ), NEWSY_THEME_VERSION, true );
		wp_localize_script( 'newsy-frontend', 'newsy_loc', $this->localize_script() );

		// HTML5 support for older IE
		wp_enqueue_script( 'html5shiv', $asset_url . 'js/html5shiv.min.js', null, NEWSY_THEME_VERSION, true );
		wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

		if ( is_singular() && comments_open() ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Callback: delete cache and temp data after theme disabled
	 * action  : switch_theme.
	 */
	public function localize_script() {
		$localize = array(
			'ajax_url'         => admin_url( 'admin-ajax.php' ),
			'nonce'            => wp_create_nonce( 'newsy_nonce' ),
			'rtl'              => is_rtl() ? 1 : 0,
			'is_login'         => is_user_logged_in() ? 1 : 0,
			'is_ssl'           => is_ssl() ? 1 : 0,
			'lang'             => get_locale(),
			'loader_html'      => newsy_get_loader(),
			'image_popup'      => newsy_get_option( 'post_image_popup', 'yes' ),
			'video_sticky'     => newsy_get_option( 'post_featured_video_sticky' ) === 'yes',
			'gallery_popup'    => newsy_get_option( 'post_image_as_gallery', 'yes' ),
			'back_to_top'      => newsy_get_option( 'back_to_top' ) !== 'hide',
			'enable_recaptcha' => newsy_get_option( 'enable_recaptcha' ) === 'yes',
		);

		if ( function_exists( 'ak_cookie_path' ) ) {
			$localize = ak_cookie_path( $localize );
		}

		return apply_filters( 'newsy_loc', $localize );
	}

	/**
	 * Callback: delete cache and temp data after theme disabled
	 * action  : switch_theme.
	 */
	public function register_admin_assets() {
		wp_enqueue_style( 'newsy-akfi', NEWSY_THEME_URI . '/assets/css/akfi.css', null, NEWSY_THEME_VERSION );
		wp_enqueue_style( 'newsy-admin', NEWSY_THEME_URI . '/assets/admin/admin-style.css', null, NEWSY_THEME_VERSION );
		wp_enqueue_script( 'newsy-admin', NEWSY_THEME_URI . '/assets/admin/theme-admin.js', null, NEWSY_THEME_VERSION );
	}

	/**
	 *  Enqueue anything in header.
	 */
	public function wp_head() {
		// Header Custom Code
		newsy_echo_option( '_custom_header_code' ); // escaped before
	}

	/**
	 * Callback: Enqueue anything in footer.
	 *
	 * Action: wp_footer
	 */
	public function wp_footer() {
		// Footer Custom Code
		newsy_echo_option( '_custom_footer_code' ); // escaped before
	}

	public function add_body_class( $classes ) {
		if ( is_rtl() ) {
			$classes[] = 'rtl';
		}

		// activates sticky sidebar
		if ( newsy_get_option( 'sticky_sidebar' ) !== 'disabled' ) {
			$classes[] = 'sticky-sidebars-active';
		}

		if ( newsy_get_option( 'always_visible_drawer' ) === 'active' ) {
			$classes[] = 'ak-drawer-always-visible';
		}

		// add dark mode class
		if ( newsy_is_dark_mode() ) {
			$classes[] = 'dark';
		} else {
			if ( in_array( 'dark', $classes, true ) ) {
				unset( $classes[ array_search( 'dark', $classes, true ) ] );
			}
		}

		return $classes;
	}
}
