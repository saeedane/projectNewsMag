<?php
/***
 * The AkFramework
 *
 * AkFramework is framework for themes and plugins for WordPress.
 *
 *  Copyright © 2020 akbilisim
 *  www.akbilisim.com
 *
 *
 *  Envato Profile: https://themeforest.net/user/akbilisim
 */
namespace Ak\Product;

/**
 * Class Pagination.
 */
class ProductPlugins {

	/**
	 * @var ProductPlugins
	 */
	private static $instance;

	/**
	 * Contain all plugins.
	 *
	 * @var array
	 */
	public static $plugins = array();


	/**
	 * @return ProductPlugins
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
		$this->register_includes();
		$this->register_hook();
	}

	public function register_includes() {
		if ( ! function_exists( 'tgmpa' ) ) {
			ak_require_once( '/includes/lib/class-tgm-plugin-activation.php' );
		}
	}

	public function register_hook() {
		add_action( 'tgmpa_register', array( $this, 'tgmpa_register' ) );
	}

	/**
	 * Register taxonomy fields.
	 */
	public function get_plugins() {
		if ( empty( self::$plugins ) ) {
			self::$plugins = apply_filters( 'ak-framework/product/plugins', array() );
		}

		return self::$plugins;
	}

	/**
	* Array of configuration settings. Amend each line as needed.
	*
	* TGMPA will start providing localized text strings soon. If you already have translations of our standard
	* strings available, please help us make TGMPA even better by giving us access to these translations or by
	* sending in a pull-request with .po file(s) with the translations.
	*
	* Only uncomment the strings in the config array if you want to customize the strings.
	*
	* @return void
	*/
	public function tgmpa_register() {
		$plugins = $this->get_plugins();
		$config  = apply_filters(
			'ak-framework/product/plugins/tgmpa/config', array(
				'id'           => 'ak-plugins',         // Unique ID for hashing notices for multiple instances of TGMPA.
				'menu'         => 'ak-install-plugins', // Menu slug.
				'has_notices'  => true,                 // Show admin notices or not.
				'dismissable'  => true,                 // If false, a user cannot dismiss the nag message.
				'dismiss_msg'  => '',                   // If 'dismissable' is false, this message will be output at top of nag.
				'is_automatic' => true,                 // Automatically activate plugins after installation or not.
				'message'      => '',                   // Message to output right before the plugins table.
			)
		);

		tgmpa( $plugins, $config );
	}
}
