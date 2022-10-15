<?php

if ( ! function_exists( 'ak_nav_menu' ) ) {
	/**
	 * Handy function to get select option for using this as deferred callback.
	 *
	 * @since 1.0.0
	 *
	 * @param bool   $default
	 * @param string $default_label
	 * @param string $menus_label
	 * @param mixed  $args
	 *
	 * @return string
	 */
	function ak_nav_menu( $args = array() ) {
		$menu_args = array(
			'walker'         => new Ak\Menu\MenuWalker,
			'menu'           => '',
			'theme_location' => '',
			'menu_class'     => '',
			'container'      => false,
			'fallback_cb'    => false,
			'echo'           => true,
		);

		$menu_args = wp_parse_args( $args, $menu_args );

		$echo          = $menu_args['echo'];
		$location      = $menu_args['theme_location'];
		$required_menu = $menu_args['menu'];

		$menu_args['menu_class'] = 'ak-menu ' . $menu_args['menu_class'];
		$menu_args['echo']       = false;

		if ( empty( $location ) && empty( $required_menu ) ) {
			return;
		}

		if ( empty( $location ) || ! empty( $required_menu ) ) {
			$menu = wp_nav_menu( $menu_args );
		} else {
			$menu_args['menu_class'] .= ' ak-' . $location;

			$menu_hash = 'ak_menu_cache_' . md5( serialize( $menu_args ) );

			$menu = ak_get_cache( $menu_hash, 'ak_menu' );

			if ( ! $menu ) {
				if ( has_nav_menu( $location ) ) {
					$menu = wp_nav_menu( $menu_args );
				} elseif ( current_user_can( 'manage_options' ) ) {
					$menus = Ak\Menu\Menu::get_instance()->get_menus();
					if ( isset( $menus[ $location ] ) ) {
						$menu_url      = admin_url( '/nav-menus.php?action=locations' );
						$location_name = sprintf(
							/* translators: %1$s is replaced with "string" */
							__( 'Select Menu for %s', 'ak-framework' ), $menus[ $location ]
						);

						$menu = sprintf( '<a href="%1$s" class="%2$s">%3$s</a>', $menu_url, 'ak-menu-select', $location_name );
					}
				}

				ak_set_cache( $menu_hash, $menu, 'ak_menu' );
			}
		}

		if ( $echo ) {
			ak_sanitize_echo( $menu );
		} else {
			return $menu;
		}
	}
}

if ( ! function_exists( 'ak_get_animation_styles' ) ) {
	function ak_get_animation_styles() {
		$styles = array(
			''        => __( 'Default', 'ak-framework' ),
			'none'    => __( 'No Animation', 'ak-framework' ),
			'fade-in' => __( 'Simple Fade', 'ak-framework' ),
			array(
				'label'   => 'Slide Entrances',
				'options' => array(
					'slide-in-down'  => 'slideInDown',
					'slide-in-left'  => 'slideInLeft',
					'slide-in-right' => 'slideInRight',
					'slide-in-up'    => 'slideInUp',
				),
			),
			array(
				'label'   => 'Attention Seekers',
				'options' => array(
					'bounce'  => 'Bounce',
					'flash'   => 'Flash',
					'pulse'   => 'Pulse',
					'shake'   => 'Shake',
					'swing'   => 'Swing',
					'tada'    => 'Tada',
					'zoom-in' => 'zoomIn',
				),
			),

			array(
				'label'   => 'Flippers',
				'options' => array(
					'flip-in-x' => 'flipInX',
					'flip-in-y' => 'flipInY',
				),
			),
		);

		return apply_filters( 'ak_animation_style_list', $styles );
	}
}
