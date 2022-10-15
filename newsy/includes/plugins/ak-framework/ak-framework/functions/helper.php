<?php

if ( ! function_exists( 'ak_get_option' ) ) {
	/**
	 * Helper function to get options.
	 *
	 * @param string $option_id
	 * @param string $option_key
	 * @param string $option_default
	 *
	 * @return mixed
	 */
	function ak_get_option( $option_id, $option_name = '', $option_default = '' ) {
		$option_id = apply_filters( 'ak-framework/options/option_id', $option_id );

		return Ak\Support\Options::get( $option_id, $option_name, $option_default );
	}
}

if ( ! function_exists( 'ak_update_option' ) ) {
	/**
	 * Update options.
	 *
	 * @param string $option_id
	 * @param string $option_key
	 * @param string $autoload
	 *
	 * @return bool
	 */
	function ak_update_option( $option_id, $option_value, $autoload = \null ) {
		$option_id = apply_filters( 'ak-framework/options/option_id', $option_id );

		return Ak\Support\Options::update( $option_id, $option_value, $autoload );
	}
}

if ( ! function_exists( 'ak_delete_option' ) ) {
	/**
	 * Helper function to delete options.
	 *
	 * @return bool
	 */
	function ak_delete_option( $option_id, $option_key = '' ) {
		$option_id = apply_filters( 'ak-framework/options/option_id', $option_id );

		return Ak\Support\Options::delete( $option_id, $option_key );
	}
}

if ( ! function_exists( 'ak_get_cache' ) ) {
	/**
	 * Helper function to get cache.
	 *
	 * @param string    $cache_id
	 * @param string    $group
	 * @param bool      $force
	 * @param mixed     $found
	 *
	 * @return mixed
	 */
	function ak_get_cache( $cache_id, $group = '', $force = false, &$found = null ) {
		$cache_id = apply_filters( 'ak-framework/cache/cache_id', 'ak_' . $cache_id );

		return wp_cache_get( $cache_id, $group, $force, $found );
	}
}

if ( ! function_exists( 'ak_set_cache' ) ) {
	/**
	 * Helper function to srt cache.
	 *
	 * @param string $cache_id
	 * @param string $data
	 * @param string $group
	 * @param int $expire
	 *
	 * @return mixed
	 */
	function ak_set_cache( $cache_id, $data, $group = '', $expire = 0 ) {
		$cache_id = apply_filters( 'ak-framework/cache/cache_id', 'ak_' . $cache_id );

		return wp_cache_set( $cache_id, $data, $group, $expire );
	}
}

/** Return Translation */
if ( ! function_exists( 'ak_get_translation' ) ) {
	/**
	 * Helper function to get translation.
	 *
	 * @return mixed
	 */
	function ak_get_translation( $string, $domain, $key, $escape = true ) {
		return Ak\Translation\Translation::get_instance()->get( $string, $domain, $key, $escape );
	}
}

if ( ! function_exists( 'ak_echo_translation' ) ) {
	/**
	 * Helper function to echo translation.
	 *
	 * @return mixed
	 */
	function ak_echo_translation( $string, $domain, $key, $escape = true ) {
		echo ak_get_translation( $string, $domain, $key, $escape );
	}
}

if ( ! function_exists( 'ak_get_breadcrumb' ) ) {
	/**
	 * Shows a breadcrumb for all types of pages.  This is a wrapper function for the Breadcrumb_Trail class,
	 * which should be used in theme templates.
	 *
	 * @param array $args Arguments to pass to Breadcrumb_Trail.
	 *
	 * @return string
	 */
	function ak_get_breadcrumb( $args = array(), $page = null ) {
		if ( 'bbpress' === $page ) {
			$breadcrumb = new Ak\Support\BBPressBreadcrumb( $args );
		} elseif ( 'buddypress' === $page ) {
			$breadcrumb = new Ak\Support\BuddyPressBreadcrumb( $args );
		} else {
			$breadcrumb = new Ak\Support\Breadcrumb( $args );
		}

		return $breadcrumb->trail();
	}
}


if ( ! function_exists( 'ak_pagination' ) ) {
	/**
	 * Helper function to render pagination.
	 *
	 * @return mixed
	 */
	function ak_pagination( $args ) {
		return Ak\Support\Pagination::get_instance()->render_pagination( $args );
	}
}

if ( ! function_exists( 'ak_pagination_hash_generate' ) ) {
	/**
	 * Helper function to get unique pagination hash.
	 *
	 * @return mixed
	 */
	function ak_pagination_hash_generate( $block_id ) {
		return substr( wp_hash( $block_id, 'nonce' ), 1, 11 );
	}
}

if ( ! function_exists( 'ak_get_post_image' ) ) {
	/**
	 * Shows a breadcrumb for all types of pages.  This is a wrapper function for the Breadcrumb_Trail class,
	 * which should be used in theme templates.
	 *
	 * @since  0.1.0
	 *
	 * @param array $args Arguments to pass to Breadcrumb_Trail.
	 *
	 * @return string
	 */
	function ak_get_post_image( $post_id, $image_size, $is_bg = false, $auto_wrap = false ) {
		if ( $is_bg ) {
			$output = apply_filters( 'ak_background_image', '', $post_id, $image_size );
		} else {
			$output = apply_filters( 'ak_thumbnail_image', '', $post_id, $image_size, $auto_wrap );
		}

		return $output;
	}
}

if ( ! function_exists( 'ak_is_doing_ajax' ) ) {
	/**
	 * Handy function to detect WP doing ajax.
	 *
	 * @return bool
	 */
	function ak_is_doing_ajax( $ajax_action = '' ) {
		$is_ajax = defined( 'DOING_AJAX' ) && DOING_AJAX;

		if ( ! $is_ajax ) {
			return false;
		}

		if ( empty( $ajax_action ) ) {
			return $is_ajax;
		} elseif ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] === $ajax_action ) { // support for WP ajax action
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'ak_is_json' ) ) {
	/**
	 * Checks string for valid JSON.
	 *
	 * @param mixed $string
	 * @param bool  $assoc_array
	 *
	 * @return mixed false on failure null on $string is null otherwise decoded json data
	 */
	function ak_is_json( $string, $assoc_array = false ) {
		if ( ! is_string( $string ) ) {
			return false;
		}

		$decoded = json_decode( $string, $assoc_array );

		if ( ! is_null( $decoded ) ) {
			return $decoded;
		} elseif ( 'null' === $string ) {
			return $decoded;
		}

		return false;
	}
}

if ( ! function_exists( 'ak_get_local_file_content' ) ) {
	/**
	 * Used to get file content by path.
	 *
	 * @param string $path
	 *
	 * @return string
	 */
	function ak_get_local_file_content( $path ) {
		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem( false, false, true );
		}
		/** @var WP_Filesystem_Base $wp_filesystem */
		$output = '';
		if ( is_object( $wp_filesystem ) ) {
			$output = $wp_filesystem->get_contents( $path );
		}

		if ( ! $output ) {
			$output = call_user_func( 'file_get_contents', $path );
		}

		if ( ! $output && file_exists( $path ) ) {
			ob_start();
			include $path;
			$output = ob_get_contents();
			ob_end_clean();
		}

		return $output;
	}
}

if ( ! function_exists( 'ak_is' ) ) {
	/**
	 * Handy function for checking current BF state.
	 *
	 * @param string $id
	 *
	 * @return bool
	 */
	function ak_is( $id = '' ) {
		switch ( $id ) {
			// Doing Ajax
			case 'doing_ajax':
			case 'doing-ajax':
			case 'ajax':
				return defined( 'DOING_AJAX' ) && DOING_AJAX;
				break;

			// Development Mode
			case 'dev':
				return defined( 'AK_DEV_MODE' ) && AK_DEV_MODE;
				break;

			// Demo mode,
			case 'demo':
				return defined( 'AK_DEMO_MODE' ) && AK_DEMO_MODE;
				break;

			default:
				return false;
		}
	} // ak_is
}

if ( ! function_exists( 'ak_get_protocol' ) ) {
	function ak_get_protocol() {
		return is_ssl() ? 'https://' : 'http://';
	}
}

if ( ! function_exists( 'ak_get_query_var_paged' ) ) {
	/**
	 * Handy function used to find current page paged query var
	 * This is home page firendly.
	 *
	 * @since 2.0
	 *
	 * @param integer $default
	 *
	 * @return int|mixed
	 */
	function ak_get_query_var_paged( $default = 1 ) {
		return get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : $default );
	}
}


if ( ! function_exists( 'ak_get_icon' ) ) {
	/**
	 * Process 2 value and return best value!
	 *
	 * @param $icon
	 * @param $custom_class
	 *
	 * @return string
	 */
	function ak_get_icon( $icon, $custom_class = '', $img_alt = '' ) {
		if ( empty( $icon ) ) {
			return '';
		}
		// Fontawesome icon
		if ( substr( $icon, 0, 3 ) === 'fa-' ) {
			return '<i class="ak-icon ' . esc_attr( $custom_class ) . ' fa ' . esc_attr( $icon ) . '"></i>';
		} elseif ( substr( $icon, 0, 5 ) === 'akfi-' ) { // Ak framework Frontend Icon
			return '<i class="ak-icon ' . esc_attr( $custom_class ) . ' ak-fi ' . esc_attr( $icon ) . '"></i>';
		} elseif ( substr( $icon, 0, 10 ) === 'dashicons-' ) { // Dashicon
			return '<i class="ak-icon ' . esc_attr( $custom_class ) . ' dashicons ' . esc_attr( $icon ) . '"></i>';
		} elseif ( substr( $icon, 0, 5 ) === 'akai-' ) { // Ak framework Backend Icon
			return '<i class="ak-icon ' . esc_attr( $custom_class ) . ' ak-ai ' . esc_attr( $icon ) . '"></i>';
		} // Custom Icon -> as URL

		if ( is_admin() ) {
			$image = '<img src="' . esc_url( $icon ) . '" alt="' . esc_attr( $img_alt ) . '" />';
		} else {
			$image = '<img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . esc_url( $icon ) . '" alt="' . esc_attr( $img_alt ) . '" />';
		}

		return '<i class="ak-icon ak-custom-icon ak-custom-icon-url ' . esc_attr( $custom_class ) . '">' . $image . '</i>';
	}
}

if ( ! function_exists( 'ak_ago_time' ) ) {
	function ak_ago_time( $time ) {
		/**
		 * Helper function to get ago type time.
		 *
		 * @param mixed $time
		 *
		 * @return string
		 */
		return human_time_diff( $time, current_time( 'timestamp' ) );
	}
}

if ( ! function_exists( 'ak_sanitize_output' ) ) {
	function ak_sanitize_output( $value ) {
		return $value;
	}
}

if ( ! function_exists( 'ak_sanitize_echo' ) ) {
	function ak_sanitize_echo( $value ) {
		echo ak_sanitize_output( $value );
	}
}

/**
 * Remove filter
 */
if ( ! function_exists( 'ak_remove_filters' ) ) {
	function ak_remove_filters( $tag, $function_to_remove, $priority = 10 ) {
		call_user_func( 'remove_filter', $tag, $function_to_remove, $priority );
	}
}
