<?php

if ( ! function_exists( 'ak_register_js' ) ) {
	/**
	 * Used for adding inline js to front end.
	 *
	 * @param string $code
	 * @param bool   $to_top
	 * @param bool   $force
	 */
	function ak_register_js( $code = '', $to_top = false ) {
		Ak\Asset\DynamicAsset::get_instance()->add_js( $code, $to_top );
	}
}

if ( ! function_exists( 'ak_register_css' ) ) {
	/**
	 * Used for adding inline css to front end.
	 *
	 * @param string $code
	 * @param bool   $to_top
	 * @param bool   $force
	 */
	function ak_register_css( $code = '', $to_top = true ) {
		Ak\Asset\DynamicAsset::get_instance()->add_css( $code, $to_top );
	}
}

if ( ! function_exists( 'ak_register_admin_js' ) ) {
	/**
	 * Used for adding inline js to back end.
	 *
	 * @param string $code
	 * @param bool   $to_top
	 * @param bool   $force
	 */
	function ak_register_admin_js( $code = '', $to_top = false ) {
		Ak\Asset\DynamicAsset::get_instance()->add_admin_js( $code, $to_top );
	}
}

if ( ! function_exists( 'ak_register_admin_css' ) ) {
	/**
	 * Used for adding inline css to back end.
	 *
	 * @param string $code
	 * @param bool   $to_top
	 * @param bool   $force
	 */
	function ak_register_admin_css( $code = '', $to_top = false ) {
		Ak\Asset\DynamicAsset::get_instance()->add_admin_css( $code, $to_top );
	}
}
