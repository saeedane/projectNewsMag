<?php
namespace Ak\Util;

class Arr {

	/**
	 * Compares the 2 values given the condition.
	 *
	 * @param mixed  $value1   The 1st value in the comparison.
	 * @param mixed  $value2   The 2nd value in the comparison.
	 * @param string $operator The operator we'll use for the comparison.
	 *
	 * @return bool whether The comparison has succeded (true) or failed (false).
	 */
	public static function compare( $value1, $value2, $operator ) {
		switch ( $operator ) {
			case '===':
				$show = ( $value1 === $value2 ) ? true : false;
				break;
			case '!==':
				$show = ( $value1 !== $value2 ) ? true : false;
				break;
			case '==':
			case '=':
			case 'equals':
			case 'equal':
				$show = self::equal( $value1, $value2 ) ? true : false;
				break;
			case '!=':
			case 'not equal':
				$show = self::equal( $value1, $value2 ) ? false : true;
				break;
			case 'contains':
			case 'in':
				$show = self::in( $value1, $value2 ) ? true : false;
				break;
			case 'not_contains':
			case 'not_in':
				$show = self::in( $value1, $value2 ) ? false : true;
				break;
			case '>=':
			case 'greater or equal':
			case 'equal or greater':
				$show = ( $value1 >= $value2 ) ? true : false;
				break;
			case '<=':
			case 'smaller or equal':
			case 'equal or smaller':
				$show = ( $value1 <= $value2 ) ? true : false;
				break;
			case '>':
			case 'greater':
				$show = ( $value1 > $value2 ) ? true : false;
				break;
			case '<':
			case 'smaller':
				$show = ( $value1 < $value2 ) ? true : false;
				break;
			default:
				$show = ( $value1 == $value2 ) ? true : false;
		}

		if ( isset( $show ) ) {
			return $show;
		}

		return true;
	}

	/**
	 * Compares 2 arrays recursively.
	 *
	 * @param array $array1 The 1st array to compare.
	 * @param array $array2 The 2nd array to compare.
	 *
	 * @return bool whether the 2 arrays are equal or not.
	 */
	public static function equal( $actual, $expected ) {
		if ( ! is_array( $expected ) || ! is_array( $actual ) ) {
			return $actual == $expected;
		}
		foreach ( $expected as $key => $value ) {
			$a = ! empty( $actual[ $key ] ) ? $actual[ $key ] : '';
			$b = ! empty( $expected[ $key ] ) ? $expected[ $key ] : '';
			if ( ! self::equal( $a, $b ) ) {
				return false;
			}
		}
		foreach ( $actual as $key => $value ) {
			$a = ! empty( $actual[ $key ] ) ? $actual[ $key ] : '';
			$b = ! empty( $expected[ $key ] ) ? $expected[ $key ] : '';
			if ( ! self::equal( $a, $b ) ) {
				return false;
			}
		}
		return true;
	}

	/**
	 * Returns the value of a given key in an array.
	 *
	 * @param array  $value1 The array to search for.
	 * @param string $value2 The key to search in.
	 *
	 * @return bool whether the 2 values are equal or not.
	 */
	public static function in( $value1, $value2 ) {
		$show = false;

		if ( is_array( $value1 ) && ! is_array( $value2 ) ) {
			$array  = $value1;
			$string = $value2;
		} elseif ( is_array( $value2 ) && ! is_array( $value1 ) ) {
			$array  = $value2;
			$string = $value1;
		}

		if ( isset( $array ) && isset( $string ) ) {
			if ( in_array( $string, $array ) ) {
				$show = true;
			}
		} else {
			if ( is_string( $value1 ) && is_string( $value2 ) && false !== strpos( $value2, $value1 ) ) {
				$show = true;
			} else {
				$show = ( $value1 == $value2 ) ? true : false;
			}
		}

		return $show;
	}

	/**
	 * Computes the difference of arrays recursively.
	 *
	 * @param array $arr1
	 * @param array $arr2
	 *
	 * @return array array diff.
	 */
	public static function diff( $arr1, $arr2 ) {
		$output_diff = array();

		foreach ( $arr1 as $key => $value ) {
			if ( array_key_exists( $key, $arr2 ) ) {
				if ( is_array( $value ) ) {
					$recursive_diff = self::diff( $value, $arr2[ $key ] );
					if ( count( $recursive_diff ) ) {
						$output_diff[ $key ] = $recursive_diff;
					}
				} else {
					if ( $value != $arr2[ $key ] ) {
						$output_diff[ $key ] = $value;
					}
				}
			} else {
				$output_diff[ $key ] = $value;
			}
		}

		return $output_diff;
	}

	/**
	 * Flatten a multi-dimensional array into a single level.
	 *
	 * @param  iterable  $array
	 * @param  int  $depth
	 * @return array
	 */
	public static function flatten( $array, $depth = INF ) {
		$result = array();

		foreach ( $array as $item ) {
			if ( ! is_array( $item ) ) {
				$result[] = $item;
			} else {
				$values = ( 1 === $depth ) ? array_values( $item )
					: static::flatten( $item, $depth - 1 );

				foreach ( $values as $value ) {
					$result[] = $value;
				}
			}
		}

		return $result;
	}

	/**
	 * If the given value is not an array and not null, wrap it in one.
	 *
	 * @param  mixed  $value
	 * @return array
	 */
	public static function wrap( $value ) {
		if ( is_null( $value ) ) {
			return array();
		}

		return is_array( $value ) ? $value : array( $value );
	}
}
