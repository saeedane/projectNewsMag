<?php

if ( ! function_exists( 'ak_get_dir' ) ) {
	/**
	 * Get AkFramework directory path.
	 *
	 * @param string $append
	 *
	 * @return string
	 */
	function ak_get_dir( $append = '' ) {
		return AK_FRAMEWORK_PATH . $append;
	}
}

if ( ! function_exists( 'ak_get_uri' ) ) {
	/**
	 * Get AkFramework directory URI (URL).
	 *
	 * @param string $append
	 *
	 * @return string
	 */
	function ak_get_uri( $append = '' ) {
		return AK_FRAMEWORK_URL . $append;
	}
}

if ( ! function_exists( 'ak_require' ) ) {
	/**
	 * Used to require file inside AkFramework.
	 *
	 * @param string $append
	 *
	 * @return string
	 */
	function ak_require( $append = '' ) {
		require AK_FRAMEWORK_PATH . $append;
	}
}

if ( ! function_exists( 'ak_require_once' ) ) {
	/**
	 * Used to require_once file inside AkFramework.
	 *
	 * @param string $append
	 *
	 * @return string
	 */
	function ak_require_once( $append = '' ) {
		require_once AK_FRAMEWORK_PATH . $append;
	}
}

if ( ! function_exists( 'ak_cookie_path' ) ) {
	/**
	 * Cookies checker
	 *
	 * @param array $option
	 * @return array
	 */
	function ak_cookie_path( $option ) {
		$option['site_domain'] = $_SERVER['SERVER_NAME'];

		if ( is_multisite() ) {
			$blog_details        = get_blog_details( get_current_blog_id() );
			$option['site_slug'] = $blog_details->path;

			return $option;
		}

		$option['site_slug'] = '/';

		if ( ! is_main_site() ) {
			$path = explode( '/', $_SERVER['REQUEST_URI'] );

			$option['site_slug'] = '/' . $path[1] . '/';
		}

		return $option;
	}
}
