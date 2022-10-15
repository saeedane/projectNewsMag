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

namespace Ak\Support;

/**
 * Panels Options Handler.
 */
class Options {

	/**
	 * Contains all values.
	 *
	 * @var array
	 */
	public static $options = array();

	/**
	 * Get option or options.
	 *
	 * @param string $option_id
	 * @param string $option_key
	 * @param string $option_default
	 *
	 * @return mixed
	 */
	public static function get( $option_id, $option_key = '', $option_default = '', $read_defaults = true ) {
		// get saved value
		self::read( $option_id, $read_defaults );

		// return saved value
		if ( ! empty( $option_key ) && isset( self::$options[ $option_id ][ $option_key ] ) ) {
			return self::$options[ $option_id ][ $option_key ];
		} elseif ( empty( $option_key ) && isset( self::$options[ $option_id ] ) ) {
			return self::$options[ $option_id ];
		}

		// fall to default value
		return $option_default;
	}

	/**
	 * Update options.
	 *
	 * @param string $option_id
	 * @param string $option_key
	 * @param string $autoload
	 *
	 * @return bool
	 */
	public static function update( $option_id, $option_value, $autoload = 'yes' ) {
		// if the parameters are not defined stop the process.
		if ( null === $option_id || null === $option_value ) {
			return false;
		}

		self::$options[ $option_id ] = $option_value;

		update_option( $option_id, $option_value, $autoload );

		return true;
	}

	/**
	 * Delete options.
	 *
	 * @param string $option_id
	 * @param string $option_key
	 *
	 * @return void
	 */
	public static function delete( $option_id, $option_key = '' ) {
		if ( null === $option_id ) {
			return false;
		}

		if ( ! empty( $option_key ) && ! empty( self::$options[ $option_id ][ $option_key ] ) ) {
			unset( self::$options[ $option_id ][ $option_key ] );
		} elseif ( empty( $option_key ) ) {
			delete_option( $option_id );
			unset( self::$options[ $option_id ] );
		}

		return true;
	}

	/**
	 * Read options from db.
	 *
	 * @param string $option_id
	 *
	 * @return void
	 */
	private static function read( $option_id, $read_defaults = true ) {
		if ( null === $option_id ) {
			return;
		}

		// if the options are defined stop the process.
		if ( isset( self::$options[ $option_id ] ) && ! is_customize_preview() ) {
			return;
		}

		self::$options[ $option_id ] = get_option( $option_id );

		if ( $read_defaults && empty( self::$options[ $option_id ] ) ) {
			self::read_defaults( $option_id );
		}
	}

	/**
	 * Get std fields if any.
	 *
	 * @param string $option_id
	 *
	 * @return void
	 */
	private static function read_defaults( $option_id ) {
		$defaults = apply_filters( 'ak-framework/options/std', array(), $option_id );

		if ( $defaults ) {
			self::$options[ $option_id ] = $defaults;
		}
	}
}
