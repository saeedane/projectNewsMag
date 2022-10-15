<?php

add_filter( 'newsy_suppored_comments', 'newsy_register_suppored_comments' );

if ( ! function_exists( 'newsy_register_suppored_comments' ) ) {
	/**
	 * Register the supported comments forms.
	 *
	 * @return array
	 */
	function newsy_register_suppored_comments( $comments = array() ) {
		$comments['wp']          = array(
			'name'  => newsy_get_translation( 'Comments', 'newsy', 'comments' ),
			'label' => newsy_get_translation( 'Wordpress Comments', 'newsy', 'wordpress_comments' ),
			'icon'  => 'fa-comments',
			'file'  => NEWSY_THEME_PATH . 'views/comments/wordpress.php',
		);
		$comments['facebook']    = array(
			'name' => newsy_get_translation( 'Facebook Comments', 'newsy', 'facebook_comments' ),
			'icon' => 'fa-facebook-square',
			'file' => NEWSY_THEME_PATH . 'views/comments/facebook.php',
		);
		$comments['disqus']      = array(
			'name' => newsy_get_translation( 'Disqus Comments', 'newsy', 'disqus_comments' ),
			'icon' => 'fa-commenting-o',
			'file' => NEWSY_THEME_PATH . 'views/comments/disqus.php',
		);
		$comments['easycomment'] = array(
			'name' => newsy_get_translation( 'easyComment Comments', 'newsy', 'easy_comments' ),
			'icon' => 'fa-comments',
			'file' => NEWSY_THEME_PATH . 'views/comments/easycomment.php',
		);

		return $comments;
	}
}

add_filter( 'newsy_view_enable_weekly_views', 'newsy_get_enable_weekly_views' );

if ( ! function_exists( 'newsy_get_enable_weekly_views' ) ) {
	/**
	 * Check if weekly views are enabled.
	 *
	 * @return boolean
	 */
	function newsy_get_enable_weekly_views() {
		return newsy_get_option( 'enable_weekly_views' ) !== 'disable';
	}
}

add_filter( 'newsy_block_extra_classes', 'newsy_set_block_classes', 11 );

if ( ! function_exists( 'newsy_set_block_classes' ) ) {
	/**
	 * Filter set default module atts for Newsy Elements.
	 *
	 * @return array
	 */
	function newsy_set_block_classes() {
		return newsy_get_option( 'block_classes' );
	}
}


add_filter( 'newsy_block_module_atts', 'newsy_set_default_module_atts', 11, 2 );

if ( ! function_exists( 'newsy_set_default_module_atts' ) ) {
	/**
	 * Filter set default module atts for Newsy Elements.
	 *
	 * @return array
	 */
	function newsy_set_default_module_atts( $module_atts, $module_id ) {
		return newsy_get_option( $module_id . '_parts', $module_atts );
	}
}

add_filter( 'newsy_block_header_style', 'newsy_set_default_block_header_style' );

if ( ! function_exists( 'newsy_set_default_block_header_style' ) ) {
	/**
	 * Filter set default block header style for Newsy Elements.
	 *
	 * @return string
	 */
	function newsy_set_default_block_header_style( $style ) {
		return newsy_get_option( 'block_header_style', $style );
	}
}

add_filter( 'newsy_number_format', 'newsy_get_number_format', 11, 2 );

if ( ! function_exists( 'newsy_get_number_format' ) ) {
	/**
	 * Format number to human friendly style.
	 *
	 * @param $number
	 *
	 * @return string
	 */
	function newsy_get_number_format( $number, $k_number = 10000 ) {
		if ( ! is_numeric( $number ) ) {
			return $number;
		}

		if ( $number >= 1000000 ) {
			return sprintf( newsy_get_translation( '%sM', 'newsy', 'number_format_m' ), round( ( $number / 1000 ) / 1000, 1 ) );
		} elseif ( $number >= $k_number ) {
			return sprintf( newsy_get_translation( '%sk', 'newsy', 'number_format_k' ), round( ( $number / 1000 ), 0 ) );
		} else {
			return number_format( $number );
		}
	}
}

add_filter( 'newsy_view_count_format', 'newsy_get_view_count_format' );

if ( ! function_exists( 'newsy_get_view_count_format' ) ) {
	/**
	 * Get the formated view counts.
	 *
	 * @param $number
	 *
	 * @return string
	 */
	function newsy_get_view_count_format( $number ) {
		if ( ! is_numeric( $number ) ) {
			return $number;
		}

		$post_views = newsy_get_number_format( $number );

		$rankings = newsy_get_option( 'views_ranking', array() );

		if ( $rankings ) {
			$ordered_rankings = array_reverse( $rankings );

			foreach ( $ordered_rankings as $_value ) {
				if ( ! isset( $_value['view'] ) ) {
					continue;
				}
				$view = $_value['view'];

				if ( $number > $view ) {
					$icon = isset( $_value['icon'] ) ? ak_get_icon( $_value['icon'] ) : '$icon';

					if ( isset( $_value['color'] ) ) {
						$color = $_value['color'];
						return "<span style=\"color:{$color}\">{$icon}<span class=\"count\">{$post_views}</span></span>";
					} else {
						return "{$icon}<span class=\"count\">{$post_views}</span>";
					}
				}
			}
		}

		return ak_get_icon( 'fa-eye' ) . "<span class=\"count\">{$post_views}</span>";
	}
}

add_action( 'newsy_block_module_share', 'newsy_set_block_module_share', 11, 3 );

if ( ! function_exists( 'newsy_set_block_module_share' ) ) {
	/**
	 * Filter set block module share for Newsy Elements.
	 *
	 * @return string
	 */
	function newsy_set_block_module_share( $post_id, $items_on_more, $share_style ) {
		if ( ! function_exists( 'newsy_get_share_buttons' ) ) {
			return;
		}

		$sites            = newsy_get_option( 'module_social_share_sites', 'facebook,twitter,pinterest' );
		$share_style      = newsy_get_option( 'module_social_share_style', $share_style );
		$share_count_type = newsy_get_option( 'module_social_share_count', 'each' );
		$share_show_count = newsy_get_option( 'module_social_share_show_count', $items_on_more );

		echo newsy_get_share_buttons( $sites, $post_id, $share_style, $share_count_type, $share_show_count );
	}
}


add_filter( 'newsy_facebook_access_token', 'newsy_get_facebook_access_token' );

if ( ! function_exists( 'newsy_get_facebook_access_token' ) ) {
	/**
	 * Filter set facebook access token.
	 *
	 * @return string
	 */
	function newsy_get_facebook_access_token() {
		return newsy_get_option( 'facebook_access_token' );
	}
}
