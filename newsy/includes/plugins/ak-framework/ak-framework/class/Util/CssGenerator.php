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
namespace Ak\Util;

use Ak\Support\Font;
use Ak\Form\FormSanitizer;
/**
 * Handle Base Custom CSS Functionality in Ak Framework
 */
class CssGenerator {

	/**
	 * Contain all css's that must be generated
	 *
	 * @var array
	 */
	protected static $outputs = array();


	/**
	 * Contain Fonts That Must Be Import In Top Of CSS
	 *
	 * @var array
	 */
	protected static $fonts = array();

	protected static $ln_char = '';

	protected static $tab_char = '';

	protected static $ln_close = ';';

	/**
	 */
	function __construct() {
		// Uncompressed in dev mode
		if ( ak_is( 'dev' ) ) {
			self::$ln_char  = "\r\n";
			self::$tab_char = "\t";
		}
	}

	/**
	 * Render all fields css
	 *
	 * @param $outputs
	 * @return string
	 */
	public static function init_outputs( $fields ) {
		$final_css = '';

		foreach ( (array) $fields as $outputs ) {
			$final_css .= self::render_css( $outputs );
		}

		return $final_css;
	}

	/**
	 * Render all fields css
	 *
	 * @param $outputs
	 * @return string
	 */
	public static function render_css( $outputs ) {
		$css = '';

		foreach ( (array) $outputs as $output ) {
			$css .= self::render_field_css( $output, $output['value'] );
		}

		return $css;
	}

	/**
	 * Render field css
	 *
	 * @param array $output
	 * @param mixed $value
	 *
	 * @return mixed
	 */
	public static function render_field_css( $output, $value ) {
		// Custom callbacks for generating CSS
		if ( isset( $output['callback'] ) && is_callable( $output['callback'] ) ) {
			return  call_user_func_array( $output['callback'], array( &$output, &$value ) );
		} else {
			return self::render_output( $output, $value );
		}
	}

	/**
	 * Get registered google fonts for generating font url.
	 *
	 * @param string $protocol custom protocol
	 *
	 * @return string
	 */
	public static function render_google_fonts() {
		/**
		 * @todo refactor
		 */
		if ( apply_filters( 'ak-framework/google-fonts/css2', true ) ) {
			return self::render_google_fonts_css2();
		}

		if ( ! isset( self::$fonts['google-font'] ) ) {
			return false;
		}

		$fonts   = array(); // Array of Fonts, Each inner element separately
		$subsets = array();
		// Create Each Font CSS
		foreach ( self::$fonts['google-font'] as $font_id => $font_information ) {
			$get_font = Font::get_instance()->get_google_font( $font_id );

			if ( empty( $get_font ) || empty( $font_information ) ) {
				continue;
			}

			$_fonts = str_replace( ' ', '+', $font_id );

			if ( in_array( 'italic', $font_information['variants'], true ) ) {
				unset( $font_information['variants'][ array_search( 'italic', $font_information['variants'] ) ] );
				$font_information['variants'][] = '400italic';
			}

			if ( implode( ',', $font_information['variants'] ) != '' ) {
				$_fonts .= ':' . trim( implode( ',', $font_information['variants'] ), ',' );
			}

			// Remove Latin Subset because default subset is latin!
			// and if font have other subset then we make separate @import.
			foreach ( $font_information['subsets'] as $key => $value ) {
				if ( 'latin' !== $value && ! empty( $value ) ) {
					$subsets[] = $value;
				}
			}

			$fonts[] = $_fonts;
		}

		$out_subsets = '';
		if ( ! empty( $subsets ) ) {
			$out_subsets = '&subset=' . trim( implode( ',', array_unique( $subsets ) ), ',' );
		}

		$final_fonts = '';
		if ( ! empty( $fonts ) ) {
			$final_fonts = 'https://fonts.googleapis.com/css?family=' . implode( '%7C', $fonts ) . $out_subsets . '&display=swap';
		}

		return $final_fonts;
	}

	/**
	 * Get registered google fonts for generating css2 font url.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public static function render_google_fonts_css2() {
		if ( ! isset( self::$fonts['google-font'] ) ) {
			return false;
		}

		$fonts   = array(); // Array of Fonts, Each inner element separately
		$subsets = array();
		// Create Each Font CSS
		foreach ( self::$fonts['google-font'] as $font_id => $font_information ) {
			$get_font = Font::get_instance()->get_google_font( $font_id );

			if ( empty( $get_font ) || empty( $font_information ) ) {
				continue;
			}

			$_fonts = str_replace( ' ', '+', $font_id );

			$ital_variants = array();
			$wght_variants = array();
			foreach ( $font_information['variants'] as $variant ) {
				if ( strpos( $variant, 'italic' ) !== false ) {
					$variant         = str_replace( 'italic', '', $variant );
					$ital_variants[] = ! empty( $variant ) ? intval( $variant ) : 400;
				} elseif ( $variant ) {
					$wght_variants[] = intval( $variant );
				}
			}

			$has_ital = ! empty( $ital_variants );
			$has_wght = ! empty( $wght_variants );

			if ( $has_ital || $has_wght ) {
				$_fonts .= ':';

				if ( $has_ital ) {
					$_fonts .= 'ital';

					if ( $has_wght ) {
						$_fonts .= ',';
					}
				}

				if ( $has_wght ) {
					$_fonts .= 'wght';
				}

				$_fonts .= '@';
			}

			if ( $has_ital ) {
				usort(
					$ital_variants, function( $a, $b ) {
						return $a - $b;
					}
				);
				$start = $has_wght ? '0,' : '';
				foreach ( array_unique( $ital_variants ) as $variant ) {
					if ( $variant ) {
						$_fonts .= $start . $variant . ';';
					}
				}
			}

			if ( $has_wght ) {
				usort(
					$wght_variants, function( $a, $b ) {
						return $a - $b;
					}
				);

				$start = $has_ital ? '1,' : '';
				foreach ( array_unique( $wght_variants ) as $variant ) {
					if ( $variant ) {
						$_fonts .= $start . $variant . ';';
					}
				}
			}

			$_fonts = rtrim( $_fonts, ';' );

			// Remove Latin Subset because default subset is latin!
			// and if font have other subset then we make separate @import.
			foreach ( $font_information['subsets'] as $value ) {
				if ( 'latin' !== $value && ! empty( $value ) ) {
					$subsets[] = $value;
				}
			}

			$fonts[] = $_fonts;
		}

		$out_subsets = '';
		if ( ! empty( $subsets ) ) {
			$out_subsets = '&subset=' . trim( implode( ',', array_unique( $subsets ) ), ',' );
		}

		$final_fonts = '';
		if ( ! empty( $fonts ) ) {
			$final_fonts = 'https://fonts.googleapis.com/css2?family=' . implode( '&family=', $fonts ) . $out_subsets . '&display=swap';
		}

		return $final_fonts;
	}

	/**
	 * Get registered custom to use for generating fonts.
	 *
	 * @param string $type
	 *
	 * @param string $protocol custom protocol
	 *
	 * @return array|string
	 */
	public static function render_custom_fonts() {
		if ( ! isset( self::$fonts['custom-font'] ) ) {
			return false;
		}

		$output = ''; // Final Out Put CSS

		// Create Each Font CSS
		foreach ( self::$fonts['custom-font'] as $font_id => $font ) {

			$the_font = Font::get_instance()->get_custom_font( $font_id );

			if ( empty( $the_font ) ) {
				continue;
			}
			$main_src_printed = false;
			$output          .= "
@font-face {
    font-family: '" . $font_id . "';";

			// .EOT
			if ( ! empty( $the_font['eot'] ) ) {
				$eot = FormSanitizer::sanitize_url( $the_font['eot'] );

				$output .= "
                src: url('" . $eot . "'); /* IE9 Compat Modes */
    			src: url('" . $eot . "?#iefix') format('embedded-opentype') /* IE6-IE8 */";

				$main_src_printed = true;
			}

			// .WOFF
			if ( ! empty( $the_font['woff'] ) ) {
				$woff = FormSanitizer::sanitize_url( $the_font['woff'] );

				if ( $main_src_printed ) {
					$output .= " , url('" . $woff . "') format('woff') /* Pretty Modern Browsers */";
				} else {
					$main_src_printed = true;

					$output .= "src: url('" . $woff . "') format('woff') /* Pretty Modern Browsers */";
				}
			}

			// .TTF
			if ( ! empty( $the_font['ttf'] ) ) {
				$ttf = FormSanitizer::sanitize_url( $the_font['ttf'] );

				if ( $main_src_printed ) {
					$output .= ", url('" . $ttf . "') format('truetype') /* Safari, Android, iOS */";
				} else {
					$main_src_printed = true;

					$output .= "src: url('" . $ttf . "') format('truetype') /* Safari, Android, iOS */";
				}
			}

			// .SVG
			if ( ! empty( $the_font['svg'] ) ) {
				$svg = FormSanitizer::sanitize_url( $the_font['svg'] );

				if ( $main_src_printed ) {
					$output .= ", url('" . $svg . '#' . $font_id . "') format('svg') /* Legacy iOS */";
				} else {
					$output .= "src: url('" . $svg . '#' . $font_id . "') format('svg') /* Legacy iOS */";
				}
			}

			$output .= ';
    font-weight: normal;
    font-style: normal;
	font-display: swap;
}';

		}

		return $output;
	}

	/**
	 * Used For Adding New Font To Fonts Queue
	 *
	 * @param string $family
	 * @param string $variant
	 * @param string $subset
	 */
	private static function set_fonts( $type = '', $family = '', $variant = '', $subset = '' ) {
		if ( ! isset( self::$fonts[ $type ] ) ) {
			self::$fonts[ $type ] = array();
		}

		// Add New Variant Or Subset
		if ( isset( self::$fonts[ $type ][ $family ] ) ) {

			if ( ! in_array( $variant, self::$fonts[ $type ][ $family ]['variants'] ) ) {
				self::$fonts[ $type ][ $family ]['variants'][] = $variant;
			}

			if ( ! in_array( $subset, self::$fonts[ $type ][ $family ]['subsets'] ) ) {
				self::$fonts[ $type ][ $family ]['subsets'][] = $subset;
			}
		} else {
			self::$fonts[ $type ][ $family ] = array(
				'variants' => array( $variant ),
				'subsets'  => array( $subset ),
			);
		}
	}

	/**
	 * Used For Adding New Font To Fonts Queue
	 *
	 * @param string $family
	 * @param string $variant
	 * @param string $subset
	 */
	public static function get_fonts() {
		return self::$fonts;
	}

	/**
	 * Handle the css output.
	 *
	 * @param array $output
	 * @param mixed $value
	 * @return string
	 */
	public static function render_output( $output, $value ) {
		if ( empty( $output ) || ! isset( $output['property'] ) || empty( $value ) ) {
			return '';
		}

		$property = &$output['property'];
		$_css     = '';

		if ( isset( $output['important'] ) && $output['important'] ) {
			self::$ln_close = '!important;';
		} else {
			self::$ln_close = ';';
		}

		switch ( $property ) {

			case 'comment':
				$_css .= '/* ' . $value . ' */' . "\r\n";
				break;

			case 'typography':
				$value = FormSanitizer::sanitize_typography( $value );
				$_css .= self::_typography( $value );
				break;

			case 'css-editor':
			case 'css_editor':
				$value = FormSanitizer::sanitize_css_editor( $value );
				if ( ! empty( $value['width'] ) ) {
					$_css .= self::_width( $value['width'] );
				}
				if ( ! empty( $value['height'] ) ) {
					$_css .= self::_height( $value['height'] );
				}

				if ( ! empty( $value['margin'] ) ) {
					$_css .= self::_margin( $value['margin'] );
				}

				if ( ! empty( $value['padding'] ) ) {
					$_css .= self::_padding( $value['padding'] );
				}

				if ( ! empty( $value['border'] ) ) {
					$_css .= self::_border( $value['border'] );
				}

				if ( ! empty( $value['border-radius'] ) ) {
					$_css .= self::_border_radius( $value['border-radius'] );
				}

				if ( ! empty( $value['background'] ) ) {
					$_css .= self::_background( $value['background'] );
				}

				break;

			case 'background-image':
				$_css .= self::_background_image( $value );

				break;

			case 'border':
				$_css .= self::_border( $value );

				break;

			case 'border-radius':
				$_css .= self::_border_radius( $value );

				break;

			case 'margin':
				$_css .= self::_margin( $value );

				break;

			case 'padding':
				$_css .= self::_padding( $value );

				break;

			case 'custom':
				if ( isset( $output['css'] ) ) {
					if ( is_array( $output['css'] ) ) {
						foreach ( $output['css'] as $key => $val ) {
							$_css .= self::$tab_char . $key . ':' . str_replace( '%%value%%', $value, $val ) . self::$ln_close . self::$ln_char;
						}
					} else {
						$_css .= str_replace( '%%value%%', $value, $output['css'] ) . self::$ln_close . self::$ln_char;
					}
				}

				break;

			default:
				$_css .= self::generate_property( $output, $value );

				break;
		}

		if ( empty( $_css ) ) {
			return '';
		}

		// Remove last ';'
		$_css = rtrim( $_css, ';' );

		$final = '';

		if ( isset( $output['media'] ) ) {
			$final .= self::$ln_char . '@media (' . str_replace( '%%value%%', $value, $output['media'] ) . '){' . self::$tab_char;
		}

		//open css classes
		if ( isset( $output['element'] ) ) {
			if ( is_array( $output['element'] ) ) {
				$output['element'] = implode( ',' . self::$ln_char, $output['element'] );
			}

			$final .= self::$ln_char . $output['element'] . ' {' . self::$ln_char;
		}

		$final .= $_css;

		//close css classes
		if ( isset( $output['element'] ) ) {
			$final .= '}' . self::$ln_char;
		}
		if ( isset( $output['media'] ) ) {
			$final .= '}' . self::$ln_char;
		}

		return $final;
	}

	/**
	 * Generate css property.
	 *
	 * @param array $output
	 * @param mixed $value
	 * @return string
	 */
	public static function generate_property( $output, $value ) {
		if ( ! is_array( $value ) ) {
			if ( ! isset( $output['property'] ) || empty( $output['property'] ) ) {
				$output['property'] = '';
			}

			if ( ! isset( $output['prefix'] ) || empty( $output['prefix'] ) ) {
				$output['prefix'] = '';
			}

			if ( ! isset( $output['units'] ) || empty( $output['units'] ) ) {
				$output['units'] = '';
			}

			if ( ! isset( $output['suffix'] ) || empty( $output['suffix'] ) ) {
				$output['suffix'] = '';
			}

			return self::$tab_char . $output['property'] . ': ' . $output['prefix'] . $value . $output['units'] . $output['suffix'] . self::$ln_close . self::$ln_char;
		}

		return '';
	}

	/**
	 * Render typography css output.
	 *
	 * @param mixed $value
	 * @return string
	 */
	public static function _typography( $value ) {

		$output        = '';
		$family        = '';
		$font_type     = '';
		$value_variant = isset( $value['variant'] ) ? $value['variant'] : '';
		$value_subset  = isset( $value['subset'] ) ? $value['subset'] : '';

		if ( ! empty( $value['family'] ) ) {

			$font = Font::get_instance()->get_font( $value['family'] );

			if ( empty( $font ) ) {
				return $output;
			}

			$family    = isset( $font['family'] ) ? $font['family'] : $value['family'];
			$font_type = isset( $font['type'] ) ? $font['type'] : '';

			if ( 'stack-font' === $font_type ) {
				$output .= self::$tab_char . 'font-family:' . $family . self::$ln_close . self::$ln_char;
			} else {
				$output .= self::$tab_char . "font-family:'" . $family . "'" . self::$ln_close . self::$ln_char;
			}

			if ( ! empty( $value_variant ) ) {

				if ( 'regular' === $value_variant ) {
					$value_variant = '400';
				} elseif ( 'italic' === $value_variant ) {
					$value_variant = '400italic';
				}

				if ( preg_match( '/\d{3}\w./i', $value_variant ) ) {
					$pretty_variant = preg_replace( '/(\d{3})/i', '${1} ', $value_variant );
					$pretty_variant = explode( ' ', $pretty_variant );
				} else {
					$pretty_variant = array( $value_variant );
				}

				if ( ! empty( $pretty_variant[0] ) ) {
					$output .= self::$tab_char . 'font-weight:' . $pretty_variant[0] . self::$ln_close . self::$ln_char;
				}

				if ( ! empty( $pretty_variant[1] ) ) {
					$output .= self::$tab_char . 'font-style:' . $pretty_variant[1] . self::$ln_close . self::$ln_char;
				}
			}

			// Add Font To Fonts Queue
			if ( ! empty( $family ) ) {
				self::set_fonts( $font_type, $family, $value_variant, $value_subset );
			}
		}

		// add
		if ( ! empty( $value['line-height'] ) ) {
			$output .= self::$tab_char . 'line-height:' . $value['line-height'] . self::$ln_close . self::$ln_char;
		}

		if ( ! empty( $value['size'] ) ) {
			$output .= self::$tab_char . 'font-size:' . $value['size'] . self::$ln_close . self::$ln_char;
		}

		if ( ! empty( $value['align'] ) ) {
			$output .= self::$tab_char . 'text-align:' . $value['align'] . self::$ln_close . self::$ln_char;
		}

		if ( ! empty( $value['letter-spacing'] ) ) {
			$output .= self::$tab_char . 'letter-spacing:' . $value['letter-spacing'] . self::$ln_close . self::$ln_char;
		}

		if ( ! empty( $value['transform'] ) ) {
			$output .= self::$tab_char . 'text-transform:' . $value['transform'] . self::$ln_close . self::$ln_char;
		}

		if ( ! empty( $value['color'] ) ) {
			$output .= self::$tab_char . 'color:' . $value['color'] . self::$ln_close . self::$ln_char;
		}

		return $output;
	}

		/**
	 * Render color css output.
	 *
	 * @param mixed $value
	 * @return string
	 */
	public static function _color( $value ) {
		return self::$tab_char . 'color:' . $value . ';' . self::$ln_char;
	}

		/**
	 * Render background css output.
	 *
	 * @param mixed $value
	 * @return string
	 */
	public static function _background( $value ) {
		$type = ( ! empty( $value['type'] ) ) ? $value['type'] : '';
		$_css = '';

		if ( ! empty( $value['image'] ) ) {
			$_css .= self::_background_image( $value['image'] );
		}

		if ( ! empty( $value['color'] ) ) {
			$_css .= self::_background_color( $value['color'] );
		}

		if ( 'gradient' === $type && ! empty( $value['gradient'] ) ) {
			$_css .= self::_background_gradient( $value['gradient'] );
		}

		return $_css;
	}

		/**
	 * Render bavkground color css output.
	 *
	 * @param mixed $value
	 * @return string
	 */
	public static function _background_color( $value ) {
		return self::$tab_char . 'background-color:' . $value . self::$ln_close . self::$ln_char;
	}

		/**
	 * Render background gradient output.
	 *
	 * @param mixed $value
	 * @return string
	 */
	public static function _background_gradient( $value ) {
		$color     = ( ! empty( $value['color'] ) ) ? $value['color'] : 'transparent';
		$sec_color = ( ! empty( $value['sec_color'] ) ) ? $value['sec_color'] : 'transparent';
		$location  = ( ! empty( $value['location'] ) ) ? $value['location'] : 100;
		$angle     = ( ! empty( $value['angle'] ) ) ? $value['angle'] : 90;

		return self::$tab_char . 'background-image:linear-gradient(' . $angle . 'deg, ' . $color . ' 0%, ' . $sec_color . ' ' . $location . '%);' . self::$ln_char;
	}

		/**
	 * Render background image css output.
	 *
	 * @param mixed $value
	 * @return string
	 */
	public static function _background_image( $value ) {
		$output = '';

		if ( ! isset( $value['img'] ) && empty( $value['img'] ) ) {
			return '';
		}
		if ( ! isset( $value['type'] ) && empty( $value['type'] ) ) {
			$value['type'] = 'cover';
		}
		$after_value = '';

		switch ( $value['type'] ) {
			// Full Cover Image
			case 'cover':
				$after_value .= self::$tab_char . 'background-repeat: no-repeat;  background-position: center center; -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;'
				. 'filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' . $value['img'] . '\', sizingMethod=\'scale\');
	-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' . $value['img'] . '\', sizingMethod=\'scale\')";'
				. self::$ln_char;
				break;
			// Fit Cover
			case 'fit-cover':
				$after_value .= self::$tab_char . 'background-repeat: no-repeat;background-position: center center; -webkit-background-size: contain; -moz-background-size: contain;-o-background-size: contain; background-size: contain;'
				. 'filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' . $value['img'] . '\', sizingMethod=\'scale\');
		-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' . $value['img'] . '\', sizingMethod=\'scale\')";'
				. self::$ln_char;
				break;
				// Parallax Image
			case 'parallax':
				$after_value .= self::$tab_char . 'background-repeat: no-repeat;background-attachment: fixed; background-position: center center; -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;'
				. 'filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' . $value['img'] . '\', sizingMethod=\'scale\');
			-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' . $value['img'] . '\', sizingMethod=\'scale\')";'
				. self::$ln_char;
				break;

			case 'no-repeat':
			case 'repeat':
			case 'repeat-y':
			case 'repeat-x':
				$after_value .= self::$tab_char . 'background-repeat:' . $value['type'] . self::$ln_close . self::$ln_char;
				break;

			case 'top-left':
			case 'top-center':
			case 'top-right':
			case 'left-center':
			case 'center-center':
			case 'right-center':
			case 'bottom-left':
			case 'bottom-center':
			case 'bottom-right':
				$after_value .= self::$tab_char . 'background-repeat: no-repeat;' . self::$ln_char;
				$after_value .= self::$tab_char . 'background-position: ' . str_replace( '-', ' ', $value['type'] ) . self::$ln_close . self::$ln_char;
				break;

			case 'top-repeat':
				$after_value .= self::$tab_char . 'background-repeat: repeat-x;' . self::$ln_char;
				$after_value .= self::$tab_char . 'background-position: top;' . self::$ln_char;
				break;

			case 'bottom-repeat':
				$after_value .= self::$tab_char . 'background-repeat: repeat-x;' . self::$ln_char;
				$after_value .= self::$tab_char . 'background-position: bottom;' . self::$ln_char;
				break;
		}

		$output .= 'background-image: url(' . $value['img'] . ')' . self::$ln_close . self::$ln_char . $after_value;
		return $output;
	}

		/**
	 * Render width output.
	 *
	 * @param mixed $value
	 * @return string
	 */
	public static function _width( $value ) {

		$output = '';
		if ( ! empty( $value['width'] ) ) {
			$output .= self::$tab_char . 'width:' . $value['width'] . self::$ln_close . self::$ln_char;
		}

		return $output;
	}
	/**
	 * Render height css output.
	 *
	 * @param mixed $value
	 * @return string
	 */
	public static function _height( $value ) {

		$output = '';
		if ( ! empty( $value['height'] ) ) {
			$output .= self::$tab_char . 'height:' . $value['height'] . self::$ln_close . self::$ln_char;
		}

		return $output;
	}

		/**
	 * Render margin css output.
	 *
	 * @param mixed $value
	 * @return string
	 */
	public static function _margin( $value ) {
		$output = '';
		if ( ! empty( $value['top'] ) ) {
			$output .= self::$tab_char . 'margin-top:' . $value['top'] . self::$ln_close . self::$ln_char;
		}
		if ( ! empty( $value['right'] ) ) {
			$output .= self::$tab_char . 'margin-right:' . $value['right'] . self::$ln_close . self::$ln_char;
		}
		if ( ! empty( $value['bottom'] ) ) {
			$output .= self::$tab_char . 'margin-bottom:' . $value['bottom'] . self::$ln_close . self::$ln_char;
		}
		if ( ! empty( $value['left'] ) ) {
			$output .= self::$tab_char . 'margin-left:' . $value['left'] . self::$ln_close . self::$ln_char;
		}

		return $output;
	}

		/**
	 * Render padding css output.
	 *
	 * @param mixed $value
	 * @return string
	 */
	public static function _padding( $value ) {
		$output = '';
		if ( ! empty( $value['top'] ) ) {
			$output .= self::$tab_char . 'padding-top:' . $value['top'] . self::$ln_close . self::$ln_char;
		}
		if ( ! empty( $value['right'] ) ) {
			$output .= self::$tab_char . 'padding-right:' . $value['right'] . self::$ln_close . self::$ln_char;
		}
		if ( ! empty( $value['bottom'] ) ) {
			$output .= self::$tab_char . 'padding-bottom:' . $value['bottom'] . self::$ln_close . self::$ln_char;
		}
		if ( ! empty( $value['left'] ) ) {
			$output .= self::$tab_char . 'padding-left:' . $value['left'] . self::$ln_close . self::$ln_char;
		}

		return $output;
	}

		/**
	 * Render border css output.
	 *
	 * @param mixed $value
	 * @return string
	 */
	public static function _border( $value ) {

		$output = '';
		if ( ! empty( $value['left']['style'] ) ) {
			$output .= self::$tab_char . 'border-left-style:' . $value['left']['style'] . self::$ln_close . self::$ln_char;

			if ( ! empty( $value['left']['color'] ) ) {
				$output .= self::$tab_char . 'border-left-color:' . $value['left']['color'] . self::$ln_close . self::$ln_char;
			}

			if ( ! empty( $value['left']['width'] ) ) {
				$output .= self::$tab_char . 'border-left-width:' . $value['left']['width'] . self::$ln_close . self::$ln_char;
			}
		}

		if ( ! empty( $value['top']['style'] ) ) {
			$output .= self::$tab_char . 'border-top-style:' . $value['top']['style'] . self::$ln_close . self::$ln_char;

			if ( ! empty( $value['top']['color'] ) ) {
				$output .= self::$tab_char . 'border-top-color:' . $value['top']['color'] . self::$ln_close . self::$ln_char;
			}
			if ( empty( $value['top']['style'] ) ) {
				$value['top']['style'] = 'solid';
			}
			if ( ! empty( $value['top']['width'] ) ) {
				$output .= self::$tab_char . 'border-top-width:' . $value['top']['width'] . self::$ln_close . self::$ln_char;
			}
		}

		if ( ! empty( $value['right']['style'] ) ) {
			$output .= self::$tab_char . 'border-right-style:' . $value['right']['style'] . self::$ln_close . self::$ln_char;

			if ( ! empty( $value['right']['color'] ) ) {
				$output .= self::$tab_char . 'border-right-color:' . $value['right']['color'] . self::$ln_close . self::$ln_char;
			}
			if ( empty( $value['right']['style'] ) ) {
				$value['right']['style'] = 'solid';
			}
			if ( ! empty( $value['right']['width'] ) ) {
				$output .= self::$tab_char . 'border-right-width:' . $value['right']['width'] . self::$ln_close . self::$ln_char;
			}
		}

		if ( ! empty( $value['bottom']['style'] ) ) {
			$output .= self::$tab_char . 'border-bottom-style:' . $value['bottom']['style'] . self::$ln_close . self::$ln_char;

			if ( ! empty( $value['bottom']['color'] ) ) {
				$output .= self::$tab_char . 'border-bottom-color:' . $value['bottom']['color'] . self::$ln_close . self::$ln_char;
			}
			if ( empty( $value['bottom']['style'] ) ) {
				$value['bottom']['style'] = 'solid';
			}
			if ( ! empty( $value['bottom']['width'] ) ) {
				$output .= self::$tab_char . 'border-bottom-width:' . $value['bottom']['width'] . self::$ln_close . self::$ln_char;
			}
		}

		return $output;
	}

			/**
	 * Render border radius css output.
	 *
	 * @param mixed $value
	 * @return string
	 */
	public static function _border_radius( $value ) {

		$output = '';
		if ( ! empty( $value['top-left'] ) ) {
			$output .= self::$tab_char . 'border-top-left-radius:' . $value['top-left'] . self::$ln_close . self::$ln_char;
		}
		if ( ! empty( $value['top-right'] ) ) {
			$output .= self::$tab_char . 'border-top-right-radius:' . $value['top-right'] . self::$ln_close . self::$ln_char;
		}
		if ( ! empty( $value['bottom-left'] ) ) {
			$output .= self::$tab_char . 'border-bottom-left-radius:' . $value['bottom-left'] . self::$ln_close . self::$ln_char;
		}
		if ( ! empty( $value['bottom-right'] ) ) {
			$output .= self::$tab_char . 'border-bottom-right-radius:' . $value['bottom-right'] . self::$ln_close . self::$ln_char;
		}

		return $output;
	}
}
