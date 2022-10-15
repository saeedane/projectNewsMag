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

namespace Ak\Form;

use Ak\Util\AriColor;

class FormSanitizer {

	/**
	 * @var FormSanitizer
	 */
	private static $instance;

	/**
	 * @return FormSanitize
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * @param $type
	 *
	 * @return array|string
	 */
	public function sanitize_handler( $type ) {
		switch ( $type ) {
			case 'text':
				$sanitize = array( $this, 'sanitize_input' );
				break;
			case 'number':
			case 'slider':
				$sanitize = array( $this, 'sanitize_number' );
				break;
			case 'textarea':
				$sanitize = array( $this, 'sanitize_textarea' );
				break;
			case 'sortable':
				$sanitize = array( $this, 'sanitize_sortable' );
				break;
			case 'checkbox':
			case 'switch':
				$sanitize = array( $this, 'sanitize_checkbox' );
				break;
			case 'cropped_image':
				$sanitize = array( $this, 'sanitize_image_id' );
				break;
			case 'image':
			case 'media':
				$sanitize = array( $this, 'sanitize_url' );
				break;
			case 'media_image':
				$sanitize = array( $this, 'sanitize_media_image' );
				break;
			case 'dropdown-pages':
				$sanitize = array( $this, 'sanitize_dropdown_pages' );
				break;
			case 'css_editor':
				$sanitize = array( $this, 'sanitize_css_editor' );
				break;
			case 'slider_unit':
				$sanitize = array( $this, 'sanitize_dimension' );
				break;
			case 'background_image':
				$sanitize = array( $this, 'sanitize_background_image' );
				break;
			case 'typography':
				$sanitize = array( $this, 'sanitize_typography' );
				break;
			case 'wp_editor':
				$sanitize = array( $this, 'sanitize_wp_editor' );
				break;
			case 'code':
				$sanitize = array( $this, 'sanitize_code' );
				break;
			case 'repeater':
			case 'mix_fields':
				$sanitize = array( $this, 'sanitize_mix_fields' );
				break;
			case 'custom_field':
				$sanitize = array( $this, 'by_pass' );
			default:
				$sanitize = array( $this, 'sanitize_input' );
				break;
		}

		return $sanitize;
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public static function sanitize_input( $value ) {
		if ( is_array( $value ) ) {
			return self::sanitize_array( $value );
		}

		return sanitize_text_field( $value );
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public static function sanitize_textarea( $value ) {
		return sanitize_textarea_field( $value );
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public static function sanitize_url( $value ) {
		return ak_sanitize_protocol( esc_url_raw( $value ) );
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public static function sanitize_media_image( $value ) {
		$media_id = self::sanitize_image_id( $value );
		if ( ! empty( $media_id ) ) {
			return $media_id;
		}

		return self::sanitize_url( $value );
	}

	/**
	 * @param $image_id
	 *
	 * @return bool
	 */
	public static function sanitize_image_id( $image_id ) {
		$image_id  = absint( $image_id );
		$image_url = wp_get_attachment_image_url( $image_id );

		if ( $image_url ) {
			return $image_id;
		}

		return '';
	}

	/**
	 * Sanitize sortable controls.
	 *
	 * @static
	 *
	 * @param string|array $value The value to be sanitized.
	 *
	 * @return string
	 */
	public static function sanitize_sortable( $value ) {
		if ( is_serialized( $value ) ) {
			return $value;
		}

		return serialize( $value );
	}

	/**
	 * Filters numeric values.
	 *
	 * @static
	 *
	 * @param string $value The value to be sanitized.
	 *
	 * @return int|float
	 */
	public static function sanitize_number( $value ) {
		return filter_var( $value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
	}

	/**
	 * Sanitize colors.
	 *
	 * @param string $value The value to be sanitized.
	 *
	 * @return string
	 */
	public static function sanitize_color( $value ) {
		// If the value is empty, then return empty.
		if ( '' === $value ) {
			return '';
		}
		// If transparent, then return 'transparent'.
		if ( is_string( $value ) && 'transparent' === trim( $value ) ) {
			return 'transparent';
		}
		// Instantiate the object.
		$color = AriColor::newColor( $value );
		// Return a CSS value, using the auto-detected mode.
		return $color->toCSS( $color->mode );
	}

	/**
	 * @param $value
	 *
	 * @return array
	 */
	public static function sanitize_array( $value ) {
		$value = ( ! is_array( $value ) ) ? explode( ',', $value ) : $value;

		return ( ! empty( $value ) ) ? array_map( 'sanitize_text_field', $value ) : array();
	}

	/**
	 * @param $value
	 *
	 * @return array
	 */
	public static function sanitize_multi_color( $value ) {
		$value = ( ! is_array( $value ) ) ? explode( ',', $value ) : $value;

		return ( ! empty( $value ) ) ? array_map( 'sanitize_hex_color', $value ) : array();
	}

	/**
	 * @param $value
	 *
	 * @return bool
	 */
	public static function sanitize_checkbox( $value ) {
		if ( is_null( $value ) ) {
			return false;
		}

		if ( 1 === $value || '1' === $value || true === $value || 'true' === $value || 'on' === $value ||
			0 === $value || '0' === $value || false === $value || 'false' === $value || 'off' === $value ) {
			return $value;
		}

		return false;
	}

	/**
	 * @param $value
	 * @param $hash
	 *
	 * @return null|string|void
	 */
	public static function sanitize_solid_color( $value, $hash = true ) {
		if ( $hash ) {
			return sanitize_hex_color( $value );
		}

		return sanitize_hex_color_no_hash( $value );
	}

	/**
	 * Drop-down Pages sanitization callback.
	 *
	 * - Sanitization: dropdown-pages
	 * - Control: dropdown-pages
	 *
	 * Sanitization callback for 'dropdown-pages' type controls. This callback sanitizes `$page_id`
	 * as an absolute integer, and then validates that $input is the ID of a published page.
	 *
	 * @see absint() https://developer.wordpress.org/reference/functions/absint/
	 * @see get_post_status() https://developer.wordpress.org/reference/functions/get_post_status/
	 *
	 * @param integer                  $page_id Page ID.
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return int|string Page ID if the page is published; otherwise, the setting default.
	 */
	public static function sanitize_dropdown_pages( $page_id, $setting ) {
		// Ensure $input is an absolute integer.
		$page_id = absint( $page_id );

		// If $page_id is an ID of a published page, return it; otherwise, return the default.
		return ( 'publish' === get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	/**
	 * @param $value
	 *
	 * @return array
	 */
	public static function sanitize_background_image( $value ) {
		if ( ! is_array( $value ) ) {
			return array();
		}

		if ( isset( $value['img'] ) && ! empty( $value['img'] ) ) {
			$value['img'] = self::sanitize_url( $value['img'] );
		}

		if ( isset( $value['type'] ) && ! empty( $value['type'] ) ) {
			$value['type'] = self::sanitize_input( $value['type'] );
		}

		return $value;
	}

	/**
	 * @param $value
	 *
	 * @return array
	 */
	public static function sanitize_css_editor( $value ) {
		if ( ! is_array( $value ) ) {
			return array();
		}

		if ( isset( $value['margin'] ) && is_array( $value['margin'] ) ) {
			foreach ( $value['margin'] as $i => $val ) {
				$value['margin'][ $i ] = self::sanitize_dimension( $val );
			}
		}

		if ( isset( $value['padding'] ) && is_array( $value['padding'] ) ) {
			foreach ( $value['padding'] as $i => $val ) {
				$value['padding'][ $i ] = self::sanitize_dimension( $val );
			}
		}

		if ( isset( $value['border'] ) && is_array( $value['border'] ) ) {
			foreach ( $value['border'] as $i => $val ) {
				if ( is_array( $val ) ) {
					foreach ( $value['border'][ $i ] as $i2 => $val2 ) {
						if ( 'color' === $i2 ) {
							$value['border'][ $i ][ $i2 ] = self::sanitize_color( $val2 );
						} elseif ( 'width' === $i2 ) {
							$value['border'][ $i ][ $i2 ] = self::sanitize_dimension( $val2 );
						} else {
							$value['border'][ $i ][ $i2 ] = self::sanitize_input( $val2 );
						}
					}
				}
			}
		}

		if ( isset( $value['border-radius'] ) && is_array( $value['border-radius'] ) ) {
			foreach ( $value['border-radius'] as $i => $val ) {
				$value['border-radius'][ $i ] = self::sanitize_dimension( $val );
			}
		}

		// Sanitize the color.
		if ( isset( $value['bg_color'] ) && ! empty( $value['bg_color'] ) ) {
			$value['bg_color'] = self::sanitize_color( $value['bg_color'] );
		}

		if ( isset( $value['bg_image'] ) && is_array( $value['bg_image'] ) ) {
			$value['bg_image'] = self::sanitize_background_image( $value['bg_image'] );
		}

		return $value;
	}

	/**
	 * Sanitizes typography controls.
	 *
	 * @param array $value The value.
	 *
	 * @return array
	 */
	public static function sanitize_typography( $value ) {
		if ( ! is_array( $value ) ) {
			return array();
		}

		// Make sure we're using a valid font.
		// @TODO add actual font-family validation.
		if ( isset( $value['family'] ) && ! empty( $value['family'] ) ) {
			$value['family'] = self::sanitize_input( $value['family'] );
		}

		// Make sure we're using a valid variant.
		// @TODO add variant validation.
		if ( isset( $value['variant'] ) && ! empty( $value['variant'] ) ) {
			$value['variant'] = self::sanitize_input( $value['variant'] );
		}

		// Make sure we're using a valid subset.
		// @TODO add subset validation.
		if ( isset( $value['subset'] ) && ! empty( $value['subset'] ) ) {
			$value['subset'] = self::sanitize_input( $value['subset'] );
		}

		// Sanitize the font-size.
		if ( isset( $value['size'] ) && ! empty( $value['size'] ) ) {
			$value['size'] = self::sanitize_dimension( $value['size'] );
		}

		// Sanitize the line-height.
		if ( isset( $value['line-height'] ) && ! empty( $value['line-height'] ) ) {
			$value['line-height'] = self::sanitize_dimension( $value['line-height'] );
		}

		// Sanitize the letter-spacing.
		if ( isset( $value['letter-spacing'] ) && ! empty( $value['letter-spacing'] ) ) {
			$value['letter-spacing'] = self::sanitize_dimension( $value['letter-spacing'] );
		}

		// Sanitize the text-align.
		if ( isset( $value['align'] ) && ! empty( $value['align'] ) ) {
			if ( ! in_array( $value['align'], array( 'inherit', 'left', 'center', 'right', 'justify' ), true ) ) {
				$value['align'] = '';
			}
		}

		// Sanitize the text-transform.
		if ( isset( $value['transform'] ) && ! empty( $value['transform'] ) ) {
			if ( ! in_array( $value['transform'], array( 'none', 'capitalize', 'uppercase', 'lowercase', 'initial', 'inherit' ), true ) ) {
				$value['transform'] = '';
			}
		}

		// Sanitize the color.
		if ( isset( $value['color'] ) && ! empty( $value['color'] ) ) {
			$value['color'] = self::sanitize_color( $value['color'] );
		}

		return $value;
	}

	/**
	 * Sanitizes css dimensions.
	 *
	 * @static
	 *
	 * @param string $value The value to be sanitized.
	 *
	 * @return string
	 */
	public static function sanitize_dimension( $value ) {
		// Trim it.
		$value = trim( $value );

		// If the value is round, then return 50%.
		if ( 'round' === $value ) {
			$value = '50%';
		}

		// If the value is empty, return empty.
		if ( '' === $value ) {
			return '';
		}

		// If auto, return auto.
		if ( 'auto' === $value ) {
			return 'auto';
		}

		// Return empty if there are no numbers in the value.
		if ( ! preg_match( '#[0-9]#', $value ) ) {
			return '';
		}

		// If we're using calc() then return the value.
		if ( false !== strpos( $value, 'calc(' ) ) {
			return $value;
		}

		// The raw value without the units.
		$raw_value = self::sanitize_number( $value );
		$unit_used = '';

		// An array of all valid CSS units. Their order was carefully chosen for this evaluation, don't mix it up!!!
		$units = array( 'rem', 'em', 'ex', '%', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ch', 'vh', 'vw', 'vmin', 'vmax' );
		foreach ( $units as $unit ) {
			if ( false !== strpos( $value, $unit ) ) {
				$unit_used = $unit;
			}
		}

		// Hack for rem values.
		if ( 'em' === $unit_used && false !== strpos( $value, 'rem' ) ) {
			$unit_used = 'rem';
		}

		// Fall in default value "px"
		if ( is_numeric( $value ) ) {
			$unit_used = 'px';
		}

		return $raw_value . $unit_used;
	}

	/**
	 * @todo improve this
	 * Sanitizes a mix_fields field.
	 *
	 * @param $value
	 *
	 * @return array
	 */
	public static function sanitize_mix_fields( $value ) {
		return ( ! empty( $value ) ) ? $value : array();
	}

	/**
	 * Sanitizes a repeater field.
	 *
	 * @static
	 *
	 * @param string $value The value to be sanitized.
	 *
	 * @return string
	 */
	public static function sanitize_repeater( $value ) {
		if ( ! is_array( $value ) ) {
			$value = json_decode( urldecode( $value ) );
		}
		$sanitized = ( empty( $value ) || ! is_array( $value ) ) ? array() : $value;

		// Make sure that every row is an array, not an object.
		foreach ( $sanitized as $key => $_value ) {
			if ( empty( $_value ) ) {
				unset( $sanitized[ $key ] );
			} else {
				$sanitized[ $key ] = (array) $_value;
			}
		}

		// Reindex array.
		$sanitized = array_values( $sanitized );

		return $sanitized;
	}

	/**
	 * Sanitizes html code.
	 *
	 * @static
	 *
	 * @param string $value The value to be sanitized.
	 *
	 * @return string
	 */
	public static function sanitize_code( $value ) {
		return htmlspecialchars( $value );
	}

	/**
	 * Sanitizes a wp editor.
	 *
	 * @static
	 *
	 * @param string $value The value to be sanitized.
	 *
	 * @return string
	 */
	public static function sanitize_wp_editor( $value ) {
		return wp_kses_post( $value );
	}

	/**
	 * @param $value
	 *
	 * @return mixed
	 */
	public static function by_pass( $value ) {
		return $value;
	}
}
