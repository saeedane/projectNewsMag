<?php
/*
Plugin Name:    Ak Framework
Plugin URI:     http://themeforest.net/user/akbilisim
Description:    Ak Framework is framework for WordPress themes and plugins.
Author:         akbilisim
Version:        2.0.0
Author URI:     http://akbilisim.com
Text Domain:    ak-framework
*/

namespace Ak;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Framework Class.
 *
 * A WordPress framework by akbilisim
 *
 * @author    akbilisim
 * @copyright 2020 akbilisim
 *
 * @version   2.0.0
 *
 * @package   qk-framework
 *
 * @link      http://akbilisim.com
 */
final class Ak_Framework {

	/**
	 * The Ak Framework object instance.
	 *
	 * @var Ak_Framework
	 */
	private static $instance;

	/**
	 * Main Ak Framework Instance.
	 *
	 * Insures that only one instance of Ak_Framework exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since   1.0.0
	 * @static  var array $instance
	 *
	 * @uses    Ak_Framework::register_constants() Setup the constants needed.
	 * @uses    Ak_Framework::register_includes() Include the required files.
	 * @uses    Ak_Framework::register_textdomain() Include the textdomain.
	 * @uses    Ak_Framework::register_hooks() Include the hooks.
	 *
	 * @return Ak_Framework
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
			static::$instance->register_constants();
			static::$instance->register_includes();
			static::$instance->register_textdomain();
			static::$instance->register_hooks();
		}

		return static::$instance;
	}

	/**
	 * Setup plugin constants.
	 *
	 * @since   1.0.0
	 *
	 * @return void
	 */
	private function register_constants() {
		// Framework.
		defined( 'AK_FRAMEWORK' ) or define( 'AK_FRAMEWORK', 'ak-framework' );
		// Framework version.
		defined( 'AK_FRAMEWORK_VERSION' ) or define( 'AK_FRAMEWORK_VERSION', '2.0.0' );
		// Framework Folder Path.
		defined( 'AK_FRAMEWORK_PATH' ) or define( 'AK_FRAMEWORK_PATH', plugin_dir_path( __FILE__ ) );
		// Framework Folder URL.
		defined( 'AK_FRAMEWORK_URL' ) or define( 'AK_FRAMEWORK_URL', plugin_dir_url( __FILE__ ) );
		// Framework Class Path.
		defined( 'AK_CLASS_PATH' ) or define( 'AK_CLASS_PATH', AK_FRAMEWORK_PATH . '/class/' );
	}

	/**
	 * Setup plugin global functions.
	 *
	 * @since   1.0.0
	 *
	 * @return void
	 */
	private function register_includes() {
		array_map(
			function ( $file ) {
				require_once AK_FRAMEWORK_PATH . '/functions/' . $file . '.php';
			},
			array(
				'helper',
				'path',
				'query',
				'other',
				'meta',
				'multilingual',
				'util',
				'shortcodes',
				'menu',
				'enqueue',
				'admin',
			)
		);
	}

	/**
	 * Setup plugin textdomain.
	 *
	 * @since   1.0.0
	 *
	 * @return void
	 */
	public function register_textdomain() {
		load_theme_textdomain( 'ak-framework', AK_FRAMEWORK_PATH . '/languages/' );
	}

	/**
	 * Setup framework hook.
	 *
	 * @since   1.0.0
	 *
	 * @return void
	 */
	private function register_hooks() {
		//  include framework files after theme setup
		add_action( 'after_setup_theme', array( $this, 'setup_framework' ), 9 );
	}

	/**
	 * Throw error on object clone.
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since   1.0.0
	 *
	 * @return void
	 */
	public function setup_framework() {
		// Add config to the ak framework components
		do_action( 'ak-framework/setup/before' );

		ak_require_once( '/autoload.php' );
		ak_require_once( '/bootstrap.php' );

		// Do anything else after the Ak framework setup.
		do_action( 'ak-framework/setup/after' );
	}

	/**
	 * Throw error on object clone.
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since   1.0.0
	 *
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '1.0' );
	}

	/**
	 * Disable unserializing of the class.
	 *
	 * @since   1.0.0
	 *
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '1.0' );
	}
}

/**
 * The main function responsible for returning the Ak Framework instances.
 *
 * @return Ak_Framework
 */
function ak_framework() {
	return Ak_Framework::get_instance();
}

// Get Ak Framework Running.
ak_framework();
