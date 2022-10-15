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

namespace Ak\Customizer;

use Ak\Util\Arr;

class CustomizerActiveCallback {

	public static function get_value( $setting ) {
		return CustomizerManager::get_instance()->get_value( $setting );
	}

	/**
	 * Figure out whether the current object should be displayed or not.
	 *
	 * @param  array
	 *
	 * @return boolean
	 */
	public static function evaluate( $callbacks ) {
		// reset flag
		$is_active = true;

		foreach ( $callbacks as $callback ) {
			$current_setting = self::get_value( $callback['element'] );

			$is_active = $is_active && Arr::compare( $callback['value'], $current_setting, $callback['operator'] );
		}

		return $is_active;
	}

	/**
	 * evaluate by id.
	 *
	 * @param $id
	 *
	 * @return bool
	 */
	public static function evaluate_by_id( $id ) {
		$is_active = true;

		$field = CustomizerManager::get_instance()->get_field( $id );

		if ( $field && isset( $field['active_callback'] ) && is_array( $field['active_callback'] ) ) {
			foreach ( $field['active_callback'] as $active ) {
				$current_setting = self::get_value( $field['id'] );

				$is_active = $is_active && Arr::compare( $active['value'], $current_setting, $active['operator'] );
			}
		}

		return $is_active;
	}

		/**
	 * Figure out whether the current object should be displayed or not.
	 *
	 * @param  array
	 *
	 * @return boolean
	 */
	public static function create_callback( $callbacks ) {
		return function () use ( $callbacks ) {
			return self::evaluate( $callbacks );
		};
	}
}
