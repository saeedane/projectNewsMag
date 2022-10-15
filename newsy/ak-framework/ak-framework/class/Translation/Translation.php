<?php
/**
 * The AkFramework.
 *
 * AkFramework is framework for themes and plugins for WordPress.
 *
 *  Copyright © 2020 akbilisim
 *  www.akbilisim.com
 *
 *
 *  Envato Profile: https://themeforest.net/user/akbilisim
 */
namespace Ak\Translation;

class Translation {

	/**
	 * @var Translation
	 */
	private static $instance;

	/**
	 * Contain all translations.
	 *
	 * @var string
	 */
	public static $option_id = 'ak_translations';

	/**
	 * @return Translation
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	public function __construct() {
		add_filter( 'ak_get_translation', array( $this, 'get_main_translation' ), 10, 4 );
	}

	/**
	 * Register taxonomy fields.
	 */
	public function get( $string, $domain, $key, $escape = true ) {
		return apply_filters( 'ak_get_translation', $string, $domain, $key, $escape );
	}

	/**
	 * Register taxonomy fields.
	 */
	public  function get_main_translation( $string, $domain, $key, $escape = true ) {
		if ( ! empty( $key ) ) {
			$value = ak_get_option( static::$option_id, $domain );

			if ( ! empty( $value[ $key ] ) ) {
				return $value[ $key ];
			}
		}

		if ( $escape ) {
			return call_user_func_array( 'esc_html__', array( $string, $domain ) );
		} else {
			return call_user_func_array( '__', array( $string, $domain ) );
		}
	}
}
