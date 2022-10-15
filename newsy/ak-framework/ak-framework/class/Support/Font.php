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
 * AK Framework Font Manager.
 */
class Font {

	/**
	 * @var Font
	 */
	private static $instance;

	/**
	 * Inner array of object instances and caches.
	 *
	 * @var array
	 */
	public static $option_id = 'ak-fonts';

	/**
	 * Inner array of object instances and caches.
	 *
	 * @var array
	 */
	protected static $instances = array();

	/**
	 * Inner array of object instances and caches.
	 *
	 * @var array
	 */
	public static $all_fonts = array();

	/**
	 * Inner array of object instances and caches.
	 *
	 * @var array
	 */
	public static $google_font_list = array();

	/**
	 * Inner array of object instances and caches.
	 *
	 * @var array
	 */
	public static $custom_font_list = array();

	public static $custom_stack_list = array();

	/**
	 * @return Font
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * @param string $option_id
	 * @param mixed  $font_id
	 *
	 * @return array
	 */
	public static function get_font( $font_id = '' ) {
		$all_fonts = self::get_fonts();

		if ( isset( $all_fonts[ $font_id ] ) ) {
			return $all_fonts[ $font_id ];
		}

		return array();
	}

	public static function get_custom_font( $font_id = '' ) {
		self::get_custom_fonts();

		if ( isset( self::$custom_font_list[ $font_id ] ) ) {
			return self::$custom_font_list[ $font_id ];
		}

		return array();
	}

	public static function get_google_font( $font_id = '' ) {
		self::get_google_fonts();

		if ( isset( self::$google_font_list[ $font_id ] ) ) {
			return self::$google_font_list[ $font_id ];
		}

		return array();
	}

	/**
	 * @param string $option_id
	 *
	 * @return array
	 */
	public static function get_fonts() {
		self::get_custom_fonts();
		self::get_google_fonts();
		self::get_stack_fonts();

		return array_merge( self::$custom_font_list, self::$google_font_list, self::$custom_stack_list );
	}

	/**
	 */
	public static function get_custom_fonts() {
		if ( ! empty( self::$custom_font_list ) ) {
			return self::$custom_font_list;
		}

		$panel_fonts = ak_get_option( self::$option_id, 'ak_custom_fonts' );

		$get_all_fonts = array();
		if ( ! empty( $panel_fonts ) ) {
			foreach ( (array) $panel_fonts as $font ) {
				if ( ! empty( $font['eot'] ) || ! empty( $font['woff'] ) || ! empty( $font['ttf'] ) || ! empty( $font['svg'] ) ) {
					$get_all_fonts[ $font['name'] ] = array(
						'eot'      => isset( $font['eot'] ) ? $font['eot'] : '',
						'woff'     => isset( $font['woff'] ) ? $font['woff'] : '',
						'ttf'      => isset( $font['ttf'] ) ? $font['ttf'] : '',
						'svg'      => isset( $font['svg'] ) ? $font['svg'] : '',
						'type'     => 'custom-font',
						'variants' => self::get_custom_font_variants(),
						'subsets'  => self::get_custom_font_subsets(),
					);
				}
			}
		}
		self::$custom_font_list = $get_all_fonts;

		return self::$custom_font_list;
	}
	/**
	 */
	public static function get_stack_fonts() {
		if ( ! empty( self::$custom_stack_list ) ) {
			return self::$custom_stack_list;
		}

		$panel_fonts = ak_get_option( self::$option_id, 'ak_stack_fonts' );

		if ( empty( $panel_fonts ) ) {
			$panel_fonts = self::get_default_stack_fonts_option();
		}

		$get_all_fonts = array();
		if ( ! empty( $panel_fonts ) ) {
			foreach ( (array) $panel_fonts as $font ) {
				if ( ! isset( $font['name'] ) || ! isset( $font['family'] ) ) {
					continue;
				}

				$get_all_fonts[ $font['name'] ] = array(
					'type'     => 'stack-font',
					'family'   => $font['family'],
					'variants' => self::get_custom_font_variants(),
					'subsets'  => self::get_custom_font_subsets(),
				);
			}
		}
		self::$custom_stack_list = $get_all_fonts;

		return self::$custom_stack_list;
	}


	public static function prepare_google_font_variants( $variants ) {
		$font_variants    = array();
		$default_variants = self::get_custom_font_variants();

		foreach ( (array) $variants as $variant ) {
			if ( 'regular' === $variant ) {
				$variant = '400';
			} elseif ( 'bold' === $variant ) {
				$variant = '700';
			}

			$font_variants[ $variant ] = isset( $default_variants[ $variant ] ) ? $default_variants[ $variant ] : $variant;
		}

		return $font_variants;
	}

	public static function prepare_google_font_subsets( $subsets ) {
		$font_subsets = array();

		foreach ( (array) $subsets as $subset ) {
			$font_subsets[ $subset ] = $subset;
		}

		return $font_subsets;
	}

	public static function get_google_fonts() {
		if ( empty( self::$google_font_list ) ) {
			$google_font_list = include AK_FRAMEWORK_PATH . '/includes/data/google-fonts.php';

			$get_all_fonts = array();
			if ( $google_font_list ) {
				foreach ( (array) $google_font_list as $font ) {
					$get_all_fonts[ $font['family'] ] = array(
						'type'     => 'google-font',
						'category' => $font['category'],
						'variants' => self::prepare_google_font_variants( $font['variants'] ),
						'subsets'  => self::prepare_google_font_subsets( $font['subsets'] ),
					);
				}
			}

			self::$google_font_list = $get_all_fonts;
		}

		return self::$google_font_list;
	}

	public static function get_default_stack_fonts() {
		$font_stacks = array(
			'Arial'          => 'Arial,"Helvetica Neue",Helvetica,sans-serif',
			'Arial Black'    => '"Arial Black","Arial Bold",Gadget,sans-serif',
			'Verdana'        => 'Verdana, Geneva, sans-serif',
			'Tahoma'         => 'Tahoma, Verdana, Geneva',
			'Helvetica Neue' => '"Helvetica Neue", Helvetica, Arial, sans-serif',
			'Baskerville'    => 'Baskerville, "Times New Roman", Times, serif',
			'Garamond'       => 'Garamond, "Hoefler Text", "Times New Roman", Times, serif',
			'Geneva_Lucida'  => 'Geneva, "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", Verdana, sans-serif',
			'GillSans'       => 'GillSans, Calibri, Trebuchet, sans-serif',
			'Georgia'        => 'Georgia, Times, "Times New Roman", serif',
			'Palatino'       => 'Palatino, "Palatino Linotype", "Hoefler Text", Times, "Times New Roman", serif',
			'Trebuchet'      => 'Trebuchet, Tahoma, Arial, sans-serif',
		);

		return apply_filters( 'ak-framework/fonts/stack/defaults', $font_stacks );
	}

	public static function get_default_stack_fonts_option() {
		$stack_defaults = self::get_default_stack_fonts();

		$stack_options = array();
		foreach ( $stack_defaults as $key => $value ) {
			$stack_options[] = array(
				'name'   => $key,
				'family' => $value,
			);
		}
		return $stack_options;
	}

	public static function get_custom_font_variants() {
		$font_variant = array(
			''          => __( 'Default', 'ak-framework' ),
			'100'       => __( '100 - Ultra-Light', 'ak-framework' ),
			'300'       => __( '300 - Book', 'ak-framework' ),
			'400'       => __( '400 - Regular', 'ak-framework' ),
			'500'       => __( '500 - Medium', 'ak-framework' ),
			'700'       => __( '700 - Bold', 'ak-framework' ),
			'900'       => __( '900 - Ultra-Bold', 'ak-framework' ),
			'100italic' => __( 'Italic 100 - Ultra-Light', 'ak-framework' ),
			'300italic' => __( 'Italic 300 - Book', 'ak-framework' ),
			'400italic' => __( 'Italic 400 - Regular', 'ak-framework' ),
			'500italic' => __( 'Italic 500 - Medium', 'ak-framework' ),
			'700italic' => __( 'Italic 700 - Bold', 'ak-framework' ),
			'900italic' => __( 'Italic 900 - Ultra-Bold', 'ak-framework' ),
		);

		return $font_variant;
	}

	public static function get_custom_font_subsets() {
		$font_subset = array(
			'' => 'Default',
		);

		return $font_subset;
	}
}
