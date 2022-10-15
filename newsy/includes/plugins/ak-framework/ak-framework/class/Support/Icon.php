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
 * Ak Framework Icon Manager.
 */
class Icon {

	/**
	 * Inner array of object instances and caches.
	 *
	 * @var array
	 */
	public static $icons = array();

	/**
	 * @var Icon
	 */
	private static $instance;

	/**
	 * @return Icon
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * @param string $icon_id
	 *
	 * @return array
	 */
	public static function get_icon( $icon_id = '' ) {
		return self::$icons[ $icon_id ];
	}

	/**
	 * @param string $icon_id
	 *
	 * @return array
	 */
	public static function get_icons_files() {

		$icons = array();

		$icons['font-awesome'] = array(
			'name'    => __( 'FontAwesome Icons', 'ak-framework' ),
			'search'  => 'fa-',
			'file'    => AK_FRAMEWORK_PATH . '/assets/css/fontawesome.min.css',
			'version' => '4.7.0',
		);

		return apply_filters( 'ak-framework/register/icons', $icons );
	}

	public static function init_icons_files() {
		$icons_files = self::get_icons_files();
		$icons       = ak_get_cache( 'ak_cache_icons' );

		if ( false === $icons ) {
			$icons = array();

			foreach ( $icons_files as $key => $value ) {
				$search = $value['search'];

				$pattern = '/\.(' . $search . '(?:\w+(?:-)?)+):before\s*{\s*content/';
				$subject = ak_get_local_file_content( $value['file'] );

				preg_match_all( $pattern, $subject, $matches, PREG_SET_ORDER );

				$icons[ $key ]['name'] = $value['name'];

				foreach ( $matches as $match ) {
					$icons[ $key ]['icons'][] = array(
						'value' => $match[1],
						'label' => $match[1],
					);
				}
			}
		}

		ak_set_cache( 'ak_cache_icons', $icons, '', 60 * 60 * 24 );

		return $icons;
	}

	public static function register_file_icons() {

		if ( empty( self::$icons ) ) {
			self::$icons = self::init_icons_files();
		}

		return apply_filters( 'ak-framework/icons', self::$icons );
	}

	public static function register_custom_icons() {
		$custom_icons = ak_get_option( 'ak_custom_icons', array() );
		$icons        = array();

		if ( ! empty( $custom_icons ) ) {
			foreach ( $custom_icons as $icon ) {
				$icons[] = array(
					'value' => $icon['value'],
					'label' => $icon['label'],
				);
			}
		}

		$icons = apply_filters( 'ak-framework/icons/custom', $icons );

		if ( ! empty( $icons ) ) {
			self::$icons['custom'] = array(
				'name'  => __( 'Custom Icons', 'ak-framework' ),
				'icons' => $icons,
			);
		}
	}

	public static function get_icons() {
		if ( ! empty( self::$icons ) ) {
			return self::$icons;
		}

		self::register_custom_icons();

		self::register_file_icons();

		return apply_filters( 'ak-framework/icons', self::$icons );
	}
}
