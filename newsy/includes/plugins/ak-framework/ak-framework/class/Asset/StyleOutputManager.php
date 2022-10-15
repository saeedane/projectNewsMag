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

use Ak\Util\Arr;

/**
 * Class Handles Base Custom CSS Functionality.
 *
 * @package  ak-framework
 */
class StyleOutputManager {

	/**
	 * @var StyleOutputManager
	 */
	private static $instance;

	/**
	 * Contain all css's that must be generated.
	 *
	 * @var array
	 */
	protected $outputs = array();

	/**
	 * @return StyleOutputManager
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}



	/**
	 * Get all active outputs.
	 *
	 * @return array
	 */
	public function get_active_outputs( $require_global_flag = false ) {
		$outputs = array();

		foreach ( $this->outputs as $id => $output ) {
			$value        = $output['value'];
			$default      = $output['default'];
			$field_active = $output['field_active'];

			// do not add default value output
			if ( Arr::compare( $value, $default, 'equal' )
			|| ! $field_active
			) {
				continue;
			}

			foreach ( $output as $it => $item ) {
				if ( ! isset( $item['type'] ) || 'css' !== $item['type']
				|| $require_global_flag && isset( $item['global_output'] ) && $item['global_output']
				) {
					unset( $output[ $it ] );
					continue;
				}

				if ( ! isset( $item['value'] ) ) {
					$output[ $it ]['value'] = $value;
				}
			}

			if ( ! empty( $output ) ) {
				$outputs[ $id ] = $output;
			}
		}

		return $outputs;
	}
}
