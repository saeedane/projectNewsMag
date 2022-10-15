<?php

if ( ! function_exists( 'ak_generate_uniqid' ) ) {
	/**
	 * Return an unique identifier.
	 *
	 * @return string
	 */
	function ak_generate_uniqid() {
		static $uniqid;
		static $unique_counter = 0;

		if ( empty( $uniqid ) ) {
			$uniqid = uniqid();
		}
		$unique_counter++;

		return $uniqid . '_' . $unique_counter;
	}
}

if ( ! function_exists( 'ak_random_string' ) ) {
	/**
	 * Return random string.
	 *
	 * @param integer $length
	 *
	 * @return string
	 */
	function ak_random_string( $length = 10 ) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$len        = strlen( $characters );
		$str        = '';
		for ( $i = 0; $i < $length; $i++ ) {
			$str .= $characters[ rand( 0, $len - 1 ) ];
		}

		return $str;
	}
}

if ( ! function_exists( 'ak_merge_args' ) ) {
	/**
	 * Merge two array args.
	 *
	 * @param array $array
	 * @param array $defaults
	 *
	 * @return string
	 */
	function ak_merge_args( &$array, $defaults ) {
		$a      = (array) $array;
		$b      = (array) $defaults;
		$result = $b;
		foreach ( $a as $k => &$v ) {
			if ( is_array( $v ) && isset( $result[ $k ] ) ) {
				$result[ $k ] = ak_merge_args( $v, $result[ $k ] );
			} else {
				$result[ $k ] = $v;
			}
		}

		return $result;
	}
}

if ( ! function_exists( 'ak_array_filter_empty_fields' ) ) {
	/**
	 * Helper function to remove empty fields from an array.
	 *
	 * @param array $array
	 *
	 * @return array
	 */
	function ak_array_filter_empty_fields( &$array ) {
		if ( is_array( $array ) ) {
			foreach ( $array as $key => $value ) {
				if ( is_null( $value ) ) {
					unset( $array[ $key ] );
				}
				if ( is_string( $value ) && empty( $value ) ) {
					unset( $array[ $key ] );
				}
				if ( is_array( $value ) ) {
					$array[ $key ] = ak_array_filter_empty_fields( $value );
				}
				if ( isset( $array[ $key ] ) && is_array( $array[ $key ] ) && count( $array[ $key ] ) == 0 ) {
					unset( $array[ $key ] );
				}
			}
		}

		return $array;
	}
}

if ( ! function_exists( 'ak_array_find_by_value' ) ) {
	/**
	 * Helper function to find params by array value.
	 *
	 * @param array $array
	 * @param mixed $key
	 * @param mixed $value
	 *
	 * @return mixed
	 */
	function ak_array_find_by_value( $array, $key, $value ) {
		foreach ( $array as $params ) {
			if ( is_array( $params ) ) {
				if ( isset( $params[ $key ] ) && $params[ $key ] == $value ) {
					return $params;
				}
			}
		}

		return false;
	}
}

if ( ! function_exists( 'ak_array_find_all_by_value' ) ) {
	function ak_array_find_all_by_value( $array, $key, $value ) {
		$final_array = array();

		foreach ( $array as $id => $params ) {
			if ( is_array( $params ) && isset( $params[ $key ] ) ) {
				if ( is_array( $params[ $key ] ) && in_array( $value, $params[ $key ], true )
					|| $params[ $key ] === $value
				) {
					$final_array[ $id ] = $params;
				}
			}
		}

		return $final_array;
	}
}


if ( ! function_exists( 'ak_is_crawler' ) ) {
	/**
	 * Detect crawler.
	 *
	 * Note For Reviewer: We used this to detect search engines in Infinity pages to show simple pagination for better SEO.
	 *
	 * @return bool
	 */
	function ak_is_crawler( $user_agent = '' ) {
		static $is_crawler;

		if ( ! is_null( $is_crawler ) ) {
			return $is_crawler;
		}

		if ( empty( $_SERVER['HTTP_USER_AGENT'] ) ) {
			$is_crawler = false;
			return $is_crawler;
		}

		if ( empty( $user_agent ) ) {
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
		}

		$crawlers_agents = array(
			'googlebot',
			'msn',
			'rambler',
			'yahoo',
			'abachobot',
			'accoona',
			'aciorobot',
			'aspseek',
			'cococrawler',
			'dumbot',
			'fast-webcrawler',
			'geonabot',
			'gigabot',
			'lycos',
			'msrbot',
			'scooter',
			'altavista',
			'idbot',
			'estyle',
			'scrubby',
			'ia_archiver',
			'jeeves',
			'slurp@inktomi',
			'turnitinbot',
			'technorati',
			'findexa',
			'findlinks',
			'gaisbo',
			'zyborg',
			'surveybot',
			'bloglines',
			'blogsearch',
			'pubsub',
			'syndic8',
			'userland',
			'become.com',
			'baiduspider',
			'360spider',
			'spider',
			'sosospider',
			'yandex',
		);

		foreach ( $crawlers_agents as $crawler ) {
			if ( strpos( strtolower( $user_agent ), $crawler ) ) {
				$is_crawler = true;
				return  $is_crawler;
			}
		}
		$is_crawler = false;
		return  $is_crawler;
	}
}

if ( ! function_exists( 'ak_limit_words' ) ) {
	/**
	 * Truncates string to the word closest to a certain number of characters.
	 *
	 * @param        $string
	 * @param integer    $width
	 * @param string $append
	 *
	 * @return string
	 */
	function ak_limit_words( $string, $width = 100, $append = '&hellip;' ) {
		if ( $width < 1 ) {
			return $string;
		}

		// do nothing if length is smaller or equal filter!
		if ( strlen( $string ) <= $width ) {
			return $string;
		}
		$string = esc_attr( strip_tags( $string ) );

		$parts       = preg_split( '/([\s\n\r]+)/u', $string, null, PREG_SPLIT_DELIM_CAPTURE );
		$parts_count = count( $parts );

		$length    = 0;
		$last_part = 0;
		for ( ; $last_part < $parts_count; ++$last_part ) {
			$length += mb_strlen( $parts[ $last_part ] );

			if ( $length > $width ) {
				break;
			}
		}

		if ( $length > $width ) {
			return trim( implode( array_slice( $parts, 0, $last_part ) ) ) . $append;
		}

		return implode( array_slice( $parts, 0, $last_part ) );
	}
}

if ( ! function_exists( 'ak_html_limit_words' ) ) {
	/**
	 * Truncates string to the word closest to a certain number of characters.
	 *
	 * @param string $html
	 * @param integer    $width
	 * @param string $append
	 *
	 * @return string
	 */
	function ak_html_limit_words( $html, $width = 100, $append = '&hellip;' ) {
		if ( $width < 1 ) {
			return $html;
		}
		$html = preg_replace( '/\s+/', ' ', $html );

		if ( ( preg_match_all( '/( [^\<]* ) (<)? (?(2)	 (\/?) ([^\>]+ ) > )/isx', $html, $match ) ) && array_filter( $match[2] ) ) {
			// do nothing if length is smaller or equal filter!
			if ( strlen( $html ) <= $width ) {
				return $html;
			}

			$break = false;
			$texts = &$match[1];
			$tags  = &$match[4];

			$length         = 0;
			$result         = '';
			$open_tags_list = array();

			foreach ( $texts as $index => $text ) {
				$slice_size = $width - $length;
				if ( $slice_size < 1 ) {
					$break = true;
					break;
				}

				$sliced_text = ak_limit_words( $text, $slice_size, '' );
				$length     += mb_strlen( $text );
				$result     .= $sliced_text;

				if ( $sliced_text !== $text ) {
					$break = true;
					break;
				}

				$tag_data = $tags[ $index ];
				$tag_data = explode( ' ', $tag_data, 2 );

				$tag  = &$tag_data[0];
				$atts = isset( $tag_data[1] ) ? ' ' . $tag_data[1] : '';

				$is_open_tag = empty( $match[3][ $index ] );

				if ( $is_open_tag ) {
					$open_tags_list[] = $tag;

					if ( $tag ) {
						$result .= '<' . $tag . $atts . '>';
					}
				} else {
					do {
						$last_open_tag = array_pop( $open_tags_list );

						$result .= '</' . $last_open_tag . '>';
					} while ( $last_open_tag && $last_open_tag !== $tag );
				}
			}

			do {
				$last_open_tag = array_pop( $open_tags_list );
				if ( $last_open_tag ) {
					$result .= '</' . $last_open_tag . '>';
				}
			} while ( $last_open_tag );

			if ( $break ) {
				$result .= $append;
			}

			/* remove empty tags
			 $result = preg_replace('/\s*<([^\s\>]+).*?>\s*(?:<\s*\/\\1\s*>)?/i', '', $result); */

			return $result;
		}

		return ak_limit_words( $html, $width, $append );
	}
}

if ( ! function_exists( 'ak_object_to_array' ) ) {
	/**
	 * Converts object to array recursively.
	 *
	 * @param $object
	 *
	 * @return array
	 */
	function ak_object_to_array( $object ) {
		if ( is_object( $object ) ) {
			$object = (array) $object;
		} // cast to array

		// cast childs to array recursively
		if ( is_array( $object ) ) {
			$new_object = array();
			foreach ( $object as $key => $val ) {
				$new_object[ $key ] = ak_object_to_array( $val ); // recursive
			}
		} else {
			$new_object = $object;
		}

		return $new_object;
	}
}

if ( ! function_exists( 'ak_array_replace_recursive' ) ) {
	/**
	 * Replaces elements from passed arrays into the first array recursively.
	 *
	 * @param array $array
	 * @param array $array1
	 *
	 * @return bool True if the value is changeable at runtime. False otherwise.
	 */
	function ak_array_replace_recursive( $array, $array1 ) {
		$args = func_get_args();

		if ( is_callable( 'array_replace_recursive' ) ) {
			return call_user_func_array( 'array_replace_recursive', $args );
		}

		// handle the arguments, merge one by one
		$array = $args[0];
		if ( ! is_array( $array ) ) {
			return $array;
		}

		for ( $i = 1; $i < func_num_args(); $i++ ) {
			if ( is_array( $args[ $i ] ) ) {
				$array = _ak_array_replace_recursive( $array, $args[ $i ] );
			}
		}

		return $array;
	}

	if ( ! function_exists( 'array_replace_recursive' ) ) {
		function _ak_array_replace_recursive( $array, $array1 ) {
			foreach ( $array1 as $key => $value ) {
				// create new key in $array, if it is empty or not an array
				if ( ! isset( $array[ $key ] ) || ( isset( $array[ $key ] ) && ! is_array( $array[ $key ] ) ) ) {
					$array[ $key ] = array();
				}

				// overwrite the value in the base array
				if ( is_array( $value ) ) {
					$value = _ak_array_replace_recursive( $array[ $key ], $value );
				}
				$array[ $key ] = $value;
			}

			return $array;
		}
	}
}
