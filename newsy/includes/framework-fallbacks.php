<?php

/**
 * Newsy framework fallbacks.
 * Shows default values until framework activated.
 */
if ( ! function_exists( 'tgmpa' ) ) {
	require_once NEWSY_THEME_PATH . 'includes/tgmpa/class-tgm-plugin-activation.php';
}

add_action( 'tgmpa_register', 'newsy_tgmpa_register_plugins' );

if ( ! function_exists( 'newsy_tgmpa_register_plugins' ) ) {
	function newsy_tgmpa_register_plugins() {
		$plugins = apply_filters( 'ak-framework/product/plugins', array() );

		$config = array(
			'id'           => 'ak-plugins',         // Unique ID for hashing notices for multiple instances of TGMPA.
			'menu'         => 'ak-install-plugins', // Menu slug.
			'has_notices'  => true,                 // Show admin notices or not.
			'dismissable'  => true,                 // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                   // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                 // Automatically activate plugins after installation or not.
			'message'      => '',                   // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}

add_action( 'widgets_init', 'newsy_init_sidebars' );

if ( ! function_exists( 'newsy_init_sidebars' ) ) {
	/**
	* @return void
	*/
	function newsy_init_sidebars() {
		$sidebars = apply_filters( 'ak-framework/sidebar', array() );

		if ( $sidebars ) {
			foreach ( $sidebars as $id => $name ) {
				$args = array(
					'id'   => $id,
					'name' => $name,
				);

				$sidebar_args = apply_filters( 'ak-framework/sidebar/args', $args, $id );

				$sidebar_args['before_title'] = '<div class="ak-block-header-default"><h4 class="widget-title"><span class="title-text">';

				register_sidebar( $sidebar_args );
			}
		}
	}
}


if ( ! function_exists( 'newsy_init_additional' ) ) {
	function newsy_init_additional() {
		$menus = apply_filters( 'ak-framework/menus', array() );

		register_nav_menus( $menus );

		$sizes = apply_filters( 'ak-framework/image-sizes', array() );

		foreach ( $sizes as $id => $image ) {
			add_image_size( $id, $image['width'], $image['height'], $image['crop'] );
		}
	}

	add_action( 'init', 'newsy_init_additional' );
}


if ( ! function_exists( 'ak_get_option' ) ) {
	/**
	 *  Get option or options.
	 *
	 * @return mixed
	 */
	function ak_get_option( $option_id, $option_name = '', $option_default = '' ) {
		$options = get_option( $option_id );

		if ( ! empty( $options[ $option_name ] ) ) {
			return $options[ $option_name ];
		}

		return $option_default;
	}
}

if ( ! function_exists( 'ak_get_translation' ) ) {
	/**
	 *  Helper function to get translation.
	 *
	 * @return mixed
	 */
	function ak_get_translation( $string, $domain, $key, $escape = true ) {
		if ( $escape ) {
			return call_user_func_array( 'esc_html__', array( $string, $domain ) );
		} else {
			return call_user_func_array( '__', array( $string, $domain ) );
		}
	}
}

if ( ! function_exists( 'ak_get_icon' ) ) {
	/**
	 *  Get the supported block classes.
	 *
	 * @return array
	 */
	function ak_get_icon( $icon, $custom_class = '', $img_alt = '' ) {
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

		return '<i class="ak-icon ak-custom-icon ak-custom-icon-url ' . esc_attr( $custom_class ) . '"><img src="' . esc_url( $icon ) . '" alt="' . esc_attr( $img_alt ) . '" /></i>';
	}
}

if ( ! function_exists( 'ak_get_post_image' ) ) {
	/**
	* @param $id
	* @param $size
	*
	* @return string
	*/
	function ak_get_post_image( $id, $size, $auto_wrap = false ) {
		$style            = '';
		$additional_class = '';
		$thumbnail        = '';

		if ( has_post_thumbnail( $id ) ) {
			$post_thumbnail_id = get_post_thumbnail_id( $id );
			$image_size        = wp_get_attachment_image_src( $post_thumbnail_id, $size );
			$percentage        = $image_size ? round( $image_size[2] / $image_size[1] * 100, 3 ) : 71.5;

			$style             = ' style="padding-bottom:' . $percentage . '%"';
			$additional_class .= ' size-auto';
			$thumbnail         = get_the_post_thumbnail( $id, $size, array( 'class' => 'lazyload' ) );
		} else {
			$additional_class .= ' no_thumbnail';
		}

		return "<div class=\"ak-featured-thumb lazy-thumb{$additional_class} \"{$style}>{$thumbnail}</div>";
	}
}

if ( ! function_exists( 'ak_do_shortcode' ) ) {
	/**
	* @param $id
	* @param $size
	*
	* @return string
	*/
	function ak_do_shortcode( $id, $atts = array(), $echo = true, $content = null ) {
		$attr = '';
		if ( ! empty( $atts ) ) {
			foreach ( (array) $atts as $key => $value ) {
				if ( is_string( $value ) ) {
					$attr .= " $key='" . trim( $value ) . "'";
				}
			}
		}

		if ( ! empty( $content ) ) {
			$content = $content . "[/$id]";
		}

		$output = do_shortcode( "[$id $attr]$content" );

		if ( ! $echo ) {
			return $output;
		}

		newsy_sanitize_echo( $output ); // escaped before
	}
}

if ( ! function_exists( 'ak_nav_menu' ) ) {
	/**
	 * Get the menu handler.
	 *
	 * @param array $args menu arguments.
	 * @return mixed
	 */
	function ak_nav_menu( $args ) {
		$theme_location = ! empty( $args['theme_location'] ) ? $args['theme_location'] : 'main-menu';
		if ( ! has_nav_menu( $theme_location ) && current_user_can( 'manage_options' ) ) {
			$menu_url      = admin_url( '/nav-menus.php?action=locations' );
			$location_name = sprintf( 'Admin Alert: Select Menu for %s', ucwords( $theme_location ) );
			echo sprintf( '<a href="%1$s" class="%2$s">%3$s</a>', $menu_url, 'ak-menu-select', $location_name );
			return;
		}

		$menu_class = ! empty( $args['menu_class'] ) ? $args['menu_class'] : '';

		return wp_nav_menu(
			array_merge(
				$args, array(
					'fallback_cb'    => false,
					'theme_location' => $theme_location,
					'menu_class'     => 'ak-menu ' . $menu_class,
				)
			)
		);
	}
}

if ( ! function_exists( 'ak_trans_allowed_html' ) ) {
	function ak_trans_allowed_html() {
		return wp_kses_allowed_html();
	}
}

function ak_wp_enqueue_scripts() {
	wp_register_style( 'fontawesome', NEWSY_THEME_URI . '/assets/css/fontawesome.min.css', array(), null );
}

add_action( 'wp_enqueue_scripts', 'ak_wp_enqueue_scripts' );
