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
namespace Ak\Importer;

/**
 * Class ImporterOption handle to add new option.
 */
class ImporterOption extends ImporterAbstract {

	public static function create( $params ) {
		parent::check_params(
			__CLASS__, __FUNCTION__, $params, array(
				'the_ID' => 'Param is required!',
				'type'   => 'Param is required!',
			)
		);

		if ( isset( $params['option_value_file'] ) && is_readable( $params['option_value_file'] ) ) {
			$file_value = ak_get_local_file_content( $params['option_value_file'] );
			$file_value = parent::_filter_required_id( 'global', $file_value );
			// decode json value
			$json_decode = ak_is_json( $file_value, true );
			if ( $json_decode ) {
				$file_value = $json_decode;
			}

			$params['option_value'] = $file_value;
		} elseif ( is_array( $params['option_value'] ) ) {
			foreach ( $params['option_value'] as $key => $val ) {
				$params['option_value'][ $key ] = parent::_filter_required_id( 'global', $val );
			}
		} else {
			$params['option_value'] = parent::_filter_required_id( 'global', $params['option_value'] );
		}

		switch ( $params['type'] ) {
			case 'option':
				ak_update_option( $params['option_name'], $params['option_value'] );
				break;

			case 'wp_option':
				update_option( $params['option_name'], $params['option_value'] );
				break;
		}

		return $params['option_name'];
	}

	public static function remove( $option_name ) {
		return ak_delete_option( $option_name );
	}
}
