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

use AK\Widget\WidgetManager;
/**
 * Class ImporterWidget handle to add new widget.
 */
class ImporterWidget extends ImporterAbstract {

	public static $widgets_number = array();

	private static $type_id = 'widget';

	public static function create( $params ) {

		if ( isset( $params['widgets_file'] ) ) {

			$file_value = ak_get_local_file_content( $params['widgets_file'] );
			$file_value = parent::_filter_required_id( 'global', $file_value );
			// decode json value
			$data = ak_is_json( $file_value, true );

			if ( $data ) {

				self::reset_sidebar_widgets( $data );

				self::register_sidebars( $data );

				self::register_widgets( $data );
			}

			//save all info we need
			return 'all';
		}

		// single widget append to sidebar
		parent::check_params(
			__CLASS__, __FUNCTION__, $params, array(
				'the_ID'  => 'Param is required!',
				'widget'  => 'Param is required!',
				'sidebar' => 'Param is required!',
				'options' => 'Param is required!',
			)
		);

		if ( ! self::is_registered_sidebar( $params['sidebar'] ) ) {
			return false;
		}

		//save all info we need
		return self::register( $params['sidebar'], $params['widget'], $params['options'] );
	}

	public static function remove( $widget_data ) {

		if ( 'all' === $widget_data ) {
			self::reset_sidebar_widgets();
			return true;
		}

		$widget_id_base = &$widget_data['widget'];
		$widget_number  = &$widget_data['widget_number'];
		$sidebar_id     = &$widget_data['sidebar'];

		$sidebars = get_option( 'sidebars_widgets' );

		if ( ! isset( $sidebars[ $sidebar_id ] ) ) {
			return false;
		}

		$_widget_id_base = $widget_id_base . '-' . $widget_number;
		$settings        = get_option( 'widget_' . $widget_id_base, array() );

		foreach ( $sidebars[ $sidebar_id ] as $index => $widget ) {
			if ( $_widget_id_base === $widget ) {
				unset( $sidebars[ $sidebar_id ][ $index ], $settings[ $widget_number ] );
			}
		}

		update_option( 'sidebars_widgets', $sidebars );
		update_option( 'widget_' . $widget_id_base, $settings );

		return true;
	}

	/**
	 * Empty widget content
	 */
	public static function register_widgets( $data ) {
		// available widget
		foreach ( $data as $sidebar_id => $widgets ) {

			// Skip inactive widgets (should not be in export file)
			if ( 'wp_inactive_widgets' === $sidebar_id ) {
				continue;
			}

			// Check if sidebar is available on this site
			// Otherwise add widgets to inactive, and say so
			$_sidebar_id = self::is_registered_sidebar( $sidebar_id ) ? $sidebar_id : 'wp_inactive_widgets';

			// Loop widgets
			foreach ( $widgets as $widget_id => $options ) {

				// Get id_base (remove -# from end) and instance ID number
				$widget_id_base = preg_replace( '/-[0-9]+$/', '', $widget_id );

				self::register( $_sidebar_id, $widget_id_base, $options );
			}
		}
	}

	/**
	 * Empty widget content
	 */
	public static function register( $widget_sidebar, $widget_id_base, $options ) {

		// Does site support this widget?
		if ( ! self::is_registered_widget( $widget_id_base ) ) {
			// single widget append to sidebar
			return parent::kill(
				__CLASS__, __FUNCTION__, $widget_id_base . ' widget not found!'
			);
		}

		$widget_number = self::generate_widget_id_number( $widget_id_base );
		$widget_id     = $widget_id_base . '-' . $widget_number;

		$sidebars_widgets = get_option( 'sidebars_widgets' );

		$sidebars_widgets[ $widget_sidebar ][] = $widget_id;

		update_option( 'sidebars_widgets', $sidebars_widgets );

		// add  options to widget
		$settings = get_option( 'widget_' . $widget_id_base, array() );

		if ( ! is_array( $settings ) ) {
			$settings = array();
		}

		// add menu post meta
		foreach ( $options as $o_key => $option ) {
			$options[ $o_key ] = parent::_filter_required_id( 'global', $option );
		}

		$settings[ $widget_number ] = $options;

		update_option( 'widget_' . $widget_id_base, $settings );

		//save all info we need
		return array(
			'widget'        => $widget_id_base,
			'widget_number' => $widget_number,
			'sidebar'       => $widget_sidebar,
		);
	}


	/**
	 * Empty widget content
	 */
	public static function register_sidebars( $data = array() ) {

		$w_manager = WidgetManager::get_instance();
		$sidebars  = array();

		foreach ( $data as $sidebar_id => $widgets ) {

			// Skip inactive widgets
			if ( 'wp_inactive_widgets' === $sidebar_id ) {
				continue;
			}

			// if ( ! self::is_registered_sidebar( $sidebar_id ) ) {
				$sidebars[ $sidebar_id ] = ucwords( str_replace( '-', ' ', sanitize_title( $sidebar_id ) ) );
			//}
		}

		$w_manager->update_additional_sidebars( $sidebars );

		// need to register sidebar to instance
		$w_manager->init_sidebars();
	}

	/**
	 * Empty widget content
	 */
	public static function reset_sidebar_widgets( $sidebars = array() ) {
		$sidebars_widgets = get_option( 'sidebars_widgets' );

		foreach ( $sidebars_widgets as $sidebar_id => $sidebar_value ) {
			if ( isset( $sidebars[ $sidebar_id ] ) || empty( $sidebars ) ) {
				unset( $sidebars_widgets[ $sidebar_id ] );
				$sidebars_widgets[ $sidebar_id ] = array();
			}
		}

		update_option( 'sidebars_widgets', $sidebars_widgets );
	}

	protected static function is_registered_sidebar( $sidebar_id ) {
		global $wp_registered_sidebars;

		// is_registered_sidebar() functoon become avaiable since WordPress 4.4.0
		if ( function_exists( 'is_registered_sidebar' ) ) {
			return is_registered_sidebar( $sidebar_id );
		}

		return isset( $wp_registered_sidebars[ $sidebar_id ] );
	}

	/**
	 * @return array
	 *
	 * return all available registred widget
	 */
	public static function is_registered_widget( $widget_id_base ) {
		global $wp_registered_widget_controls;

		foreach ( $wp_registered_widget_controls as $widget ) {
			if ( ! empty( $widget['id_base'] ) && $widget['id_base'] == $widget_id_base ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * generate unique widget number to save widget option on unique array index number.
	 *
	 * @param string $widget_id_base
	 *
	 * @return int widget id number
	 */
	protected static function generate_widget_id_number( $widget_id_base ) {
		if ( ! function_exists( 'next_widget_id_number' ) ) {
			require_once ABSPATH . '/wp-admin/includes/widgets.php';// for next_widget_id_number()
		}

		if ( ! isset( self::$widgets_number[ $widget_id_base ] ) ) {
			self::$widgets_number[ $widget_id_base ] = next_widget_id_number( $widget_id_base );
		} else {
			self::$widgets_number[ $widget_id_base ]++;
		}

		return self::$widgets_number[ $widget_id_base ];
	}
}
