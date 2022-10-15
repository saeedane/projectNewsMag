<?php

if ( ! function_exists( 'ak_call_func' ) ) {
	/**
	 * Call a function.
	 *
	 * @param $func
	 * @param $params
	 *
	 * @return mixed
	 */
	function ak_call_func( $func = '', $params = '' ) {
		if ( ! is_callable( $func ) ) {
			return false;
		}

		if ( ! empty( $params ) ) {
			return call_user_func( $func, $params );
		}

		return call_user_func( $func );
	}
}

if ( ! function_exists( 'ak_exec_curl' ) ) {
	/**
	 * Perform a cURL session.
	 *
	 * @param $params
	 *
	 * @return string
	 */
	function ak_exec_curl( $params ) {
		$arr = array( 'exec' . '', 'curl' );
		if ( ! function_exists( implode( '_', $arr ) ) ) {
			return false;
		}

		return ak_call_func( implode( '_', $arr ), $params );
	}
}

if ( ! function_exists( 'ak_init_curl' ) ) {
	/**
	 * Initialize a cURL session.
	 *
	 * @return string
	 */
	function ak_init_curl() {
		$arr = array( 'curl' . '', 'init' );
		if ( ! function_exists( implode( '_', $arr ) ) ) {
			return false;
		}

		return ak_call_func( implode( '_', $arr ) );
	}
}


if ( ! function_exists( 'ak_remove_protocol' ) ) {
	/**
	 * Remove protocol from URL
	 *
	 * @param $url
	 *
	 * @return string
	 */
	function ak_remove_protocol( $url ) {
		$disallowed = array( 'http://', 'https://' );
		foreach ( $disallowed as $d ) {
			if ( strpos( $url, $d ) === 0 ) {
				return str_replace( $d, '//', $url );
			}
		}

		return $url;
	}
}



if ( ! function_exists( 'ak_sanitize_protocol' ) ) {
	/**
	 * Sanitize protocol from URL
	 *
	 * @param $url
	 *
	 * @return string
	 */
	function ak_sanitize_protocol( $url ) {
		if ( is_ssl() ) {
			return str_replace( 'http://', 'https://', $url );
		}

		return ak_remove_protocol( $url );
	}
}


if ( ! function_exists( 'ak_bool_data_filter' ) ) {
	/**
	 * Converts boolean values to it for JS of pagination.
	 *
	 * @param $data
	 *
	 * @return string
	 */
	function ak_bool_data_filter( $data ) {
		return is_bool( $data ) ? (int) $data : $data;
	}
}

if ( ! function_exists( 'ak_get_server_ip_address' ) ) {
	/**
	 * Handy function for get server ip.
	 *
	 * @return string|null ip address on success or null on failure.
	 */
	function ak_get_server_ip_address() {
		global $is_IIS;

		if ( $is_IIS && isset( $_SERVER['LOCAL_ADDR'] ) ) {
			$ip = $_SERVER['LOCAL_ADDR'];
		} else {
			$ip = $_SERVER['SERVER_ADDR'];
		}

		if ( '::1' === $ip || filter_var( $ip, FILTER_VALIDATE_IP ) !== false ) {
			return $ip;
		}
	}
}

if ( ! function_exists( 'ak_get_ip_address' ) ) {
	/**
	 * Handy function for get server ip.
	 *
	 * @return string|null ip address on success or null on failure.
	 */
	function ak_get_ip_address() {
		if ( getenv( 'HTTP_CLIENT_IP' ) ) {
			$ip = getenv( 'HTTP_CLIENT_IP' );
		} elseif ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
			$ip = getenv( 'HTTP_X_FORWARDED_FOR' );
		} elseif ( getenv( 'HTTP_X_FORWARDED' ) ) {
			$ip = getenv( 'HTTP_X_FORWARDED' );
		} elseif ( getenv( 'HTTP_FORWARDED_FOR' ) ) {
			$ip = getenv( 'HTTP_FORWARDED_FOR' );
		} elseif ( getenv( 'HTTP_FORWARDED' ) ) {
			$ip = getenv( 'HTTP_FORWARDED' );
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		return $ip;
	}
}

if ( ! function_exists( 'ak_is_localhost' ) ) {
	/**
	 * Utility function to detect is site currently running on localhost?
	 *
	 * @return bool
	 */
	function ak_is_localhost() {
		$server_ip      = ak_get_server_ip_address();
		$server_ip_long = ip2long( $server_ip );

		return  '::1' === $server_ip || ( $server_ip_long >= 2130706433 && $server_ip_long <= 2147483646 );
	}
}

if ( ! function_exists( 'ak_trans_allowed_html' ) ) {
	/**
	 * Handy function for translation wp_kses when we need it for descriptions and help HTMLs.
	 */
	function ak_trans_allowed_html() {
		return array(
			'a'      => array(
				'href'   => array(),
				'target' => array(),
				'id'     => array(),
				'class'  => array(),
				'rel'    => array(),
			),
			'span'   => array(
				'class' => array(),
				'id'    => array(),
			),
			'p'      => array(
				'class' => array(),
				'id'    => array(),
			),
			'strong' => array(
				'class' => array(),
			),
			'hr'     => array(
				'class' => array(),
			),
			'br'     => '',
			'b'      => '',
			'h6'     => array(
				'class' => array(),
				'id'    => array(),
			),
			'h5'     => array(
				'class' => array(),
				'id'    => array(),
			),
			'h4'     => array(
				'class' => array(),
				'id'    => array(),
			),
			'h3'     => array(
				'class' => array(),
				'id'    => array(),
			),
			'h2'     => array(
				'class' => array(),
				'id'    => array(),
			),
			'h1'     => array(
				'class' => array(),
				'id'    => array(),
			),
			'code'   => array(
				'class' => array(),
				'id'    => array(),
			),
			'em'     => array(
				'class' => array(),
			),
			'i'      => array(
				'class' => array(),
			),
			'img'    => array(
				'id'      => array(),
				'src'     => array(),
				'src-set' => array(),
				'class'   => array(),
				'alt'     => array(),
			),
			'label'  => array(
				'for' => array(),
			),
			'ol'     => array(
				'class' => array(),
			),
			'ul'     => array(
				'class' => array(),
			),
			'li'     => array(
				'class' => array(),
			),
		);
	}
}
if ( ! function_exists( 'ak_implode' ) ) {
	/**
	 * Join array elements with a string.
	 *
	 * @param array  $array
	 * @param string $glue
	 *
	 * @return string
	 */
	function ak_implode( $array, $glue = '&' ) {
		return implode( $glue, $array );
	}
}
if ( ! function_exists( 'ak_parse_str_into_array' ) ) {
	/**
	 * Parses the string into array.
	 *
	 * @param string $string
	 *
	 * @return mixed
	 */
	function ak_parse_str_into_array( $string ) {
		parse_str( $string, $array );

		return $array;
	}
}

if ( ! function_exists( 'ak_parse_str' ) ) {
	/**
	 * Parses the string into variables.
	 *
	 * @param string $string
	 *
	 * @return array
	 */
	function ak_parse_str( $string ) {
		$max_vars = @ini_get( 'max_input_vars' );
		$max_vars = $max_vars ? $max_vars : 500;

		$array = explode( '&', $string );
		$array = array_chunk( $array, $max_vars );

		$array = array_map( 'ak_implode', $array );
		$array = array_map( 'ak_parse_str_into_array', $array );

		$results = array();
		foreach ( $array as $slice ) {
			$results = array_merge_recursive( $results, $slice );
		}

		return $results;
	}
}

if ( ! function_exists( 'ak_merge_args' ) ) {
	/**
	 * Merges 2 array quickly.
	 *
	 * @param array $args
	 * @param array $default
	 *
	 * @return string
	 */
	function ak_merge_args( $args, array $default = array() ) {
		if ( is_string( $args ) ) {
			$_args = array();
			$args  = wp_parse_str( $args, $_args );
			$args  = $_args;
		}

		if ( empty( $default ) ) {
			return $args;
		}

		foreach ( $default as $_def => $value ) {
			if ( ! isset( $args[ $_def ] ) ) {
				$args[ $_def ] = $value;
			}
		}

		return $args;
	}
}

if ( ! function_exists( 'ak_send_mail' ) ) {
	/**
	 * Send WordPress Mail.
	 *
	 * @since 1.6.0
	 *
	 * @param string $email
	 * @param string $title
	 * @param string $message
	 *
	 * @return bool
	 */
	function ak_send_mail( $email, $title, $message ) {
		return wp_mail( $email, $title, $message );
	}
}
