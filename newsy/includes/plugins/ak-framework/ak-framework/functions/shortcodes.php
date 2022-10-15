<?php

if ( ! function_exists( 'ak_get_shortcode' ) ) {
	/**
	 * Helper function to get shortcode instance.
	 *
	 * @param mixed $id
	 *
	 * @return mixed
	 */
	function ak_get_shortcode( $id ) {
		return Ak\Shortcode\ShortcodeManager::get_instance()->get_shortcode_instance( $id );
	}
}

if ( ! function_exists( 'ak_load_shortcode' ) ) {
	/**
	 * Helper function to get shortcode.
	 *
	 * @param mixed      $atts
	 * @param mixed|null $content
	 * @param mixed      $id
	 *
	 * @return mixed
	 */
	function ak_load_shortcode( $atts, $content = '', $id = '' ) {
		$instance = ak_get_shortcode( $id );

		if ( false !== $instance ) {
			return $instance->render_shortcode( $atts, $content );
		}

		return false;
	}
}

if ( ! function_exists( 'ak_do_shortcode' ) ) {
	/**
	 * Helper function to render shortcode.
	 *
	 * @param mixed      $id
	 * @param array      $atts
	 * @param bool      $echo
	 * @param mixed|null $content
	 *
	 * @return string
	 */
	function ak_do_shortcode( $id, $atts = array(), $echo = true, $content = null ) {
		$output = ak_load_shortcode( $atts, $content, $id );

		if ( ! $echo ) {
			return $output;
		}

		ak_sanitize_echo( $output );
	}
}
