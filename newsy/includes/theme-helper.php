<?php
/**
 * Newsy Theme Helpers.
 */

if ( ! function_exists( 'newsy_get_option' ) ) {
	/**
	 * Get the option.
	 *
	 * @param string $key
	 * @param string $default_value
	 * @param string $array_name
	 * @return mixed
	 */
	function newsy_get_option( $key, $default_value = '' ) {
		return ak_get_option( NEWSY_THEME_OPTIONS, $key, $default_value );
	}
}

if ( ! function_exists( 'newsy_echo_option' ) ) {
	/**
	 * Echo the option.
	 */
	function newsy_echo_option( $key, $default_value = '' ) {
		echo newsy_get_option( $key, $default_value );
	}
}

if ( ! function_exists( 'newsy_get_translation' ) ) {
	/**
	 * Get the translation value.
	 *
	 * @param string $string Translation value.
	 * @param string $domain Theme language domain.
	 * @param string $key Key for the translation value.
	 * @param boolean $escape
	 * @return mixed
	 */
	function newsy_get_translation( $string, $domain, $key, $escape = true ) {
		return ak_get_translation( $string, $domain, $key, $escape );
	}
}

if ( ! function_exists( 'newsy_echo_translation' ) ) {
	/**
	 * Echo the translation value.
	 */
	function newsy_echo_translation( $string, $domain, $key, $escape = true ) {
		echo newsy_get_translation( $string, $domain, $key, $escape );
	}
}

if ( ! function_exists( 'newsy_get_template_option' ) ) {
	/**
	 * Get the template option.
	 *
	 * @param string $key
	 * @param string $default_value
	 * @param string $template_id
	 * @param string $object_id
	 * @param string $global_option
	 * @return mixed
	 */
	function newsy_get_template_option( $key, $default_value = '', $template_id = '', $object_id = '', $global_option = false ) {
		$term_value = null;

		// get template option
		if ( ! empty( $template_id ) && ! empty( $object_id ) && defined( 'AK_FRAMEWORK_PATH' ) ) {
			switch ( $template_id ) {
				case 'category':
				case 'tag':
				case 'reaction':
				case 'taxonomy':
				case 'woocommerce_tax':
					$term_value = ak_get_term_meta( 'term_' . $key, $object_id );
					break;

				case 'author':
					$term_value = ak_get_user_meta( 'term_' . $key, $object_id );
					break;

				case 'post':
				case 'woocommerce_product':
					$term_value = ak_get_post_meta( 'post_' . $key, $object_id );
					break;

				case 'page':
				case 'bbpress':
				case 'buddypress':
				case 'woocommerce':
					$term_value = ak_get_post_meta( 'page_' . $key, $object_id );
					break;
			}
		}

		// get template option
		if ( empty( $term_value ) && ! empty( $template_id ) ) {
			$term_value = newsy_get_option( $template_id . '_' . $key );
		}

		// get global option
		if ( empty( $term_value ) && $global_option ) {
			$term_value = newsy_get_option( 'site_' . $key );
		}

		// fall to default
		if ( empty( $term_value ) && ! empty( $default_value ) ) {
			return $default_value;
		}

		return $term_value;
	}
}

if ( ! function_exists( 'newsy_sanitize_by_pass' ) ) {
	function newsy_sanitize_by_pass( $value ) {
		return $value;
	}
}

if ( ! function_exists( 'newsy_sanitize_echo' ) ) {
	function newsy_sanitize_echo( $value ) {
		echo newsy_sanitize_by_pass( $value );
	}
}

if ( ! function_exists( 'newsy_is_dark_mode' ) ) {
	function newsy_is_dark_mode() {
		$dark = false;

		if ( 'dark' === newsy_get_option( 'site_scheme' ) ) {
			$dark = true;
		}

		if ( isset( $_COOKIE['darkmode'] ) ) {
			$cookie = sanitize_text_field( wp_unslash( $_COOKIE['darkmode'] ) );
			if ( 'true' === $cookie ) {
				$dark = true;
			} elseif ( 'false' === $cookie ) {
				$dark = false;
			}
		}

		return $dark;
	}
}
