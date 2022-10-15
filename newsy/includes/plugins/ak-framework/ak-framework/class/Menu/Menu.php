<?php
/***
 * The Ak Framework
 *
 * Ak Framework is framework for WordPress themes and plugins.
 *
 * Copyright © 2020 akbilisim
 * www.akbilisim.com
 *
 * Envato Profile: https://themeforest.net/user/akbilisim
 */
namespace Ak\Menu;

/**
 * Class Menu handle to register nav menus.
 */
class Menu {

	/**
	 * @var Menu
	 */
	private static $instance;

	private $menus = array();

	private $mega_menus = array();

	/**
	 * Menu constructor.
	 */
	public function __construct() {
		$this->init();
		$this->hook();
	}

	/**
	 * @return Menu
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	public function init() {
		register_nav_menus( $this->get_menus() );
	}

	public function hook() {
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'setup_nav_menu_item' ), 11 );
		add_filter( 'nav_menu_item_args', array( $this, 'setup_nav_menu_item_args' ), 11, 3 );
		add_filter( 'walker_nav_menu_start_el', array( $this, 'setup_nav_mega_menu' ), 11, 4 );
		add_filter( 'nav_menu_submenu_css_class', array( $this, 'setup_nav_menu_submenu_class' ), 15, 4 );
	}

	public function get_menus() {
		if ( empty( $this->menus ) ) {
			$this->menus = apply_filters( 'ak-framework/menus', array() );
		}

		return $this->menus;
	}

	public function get_mega_menus() {
		if ( empty( $this->mega_menus ) ) {
			$this->mega_menus = apply_filters( 'ak-framework/menu/mega-menu', array() );
		}

		return $this->mega_menus;
	}

	public function get_mega_menu( $mage_menu ) {
		$mega_menus = $this->get_mega_menus();

		if ( isset( $mega_menus[ $mage_menu ] ) ) {
			return $mega_menus[ $mage_menu ];
		}

		return false;
	}

	public function setup_nav_menu_item( $item ) {
		$item->menu_meta = ak_get_post_meta( 'menu_item_menu_meta', $item->ID );

		if ( isset( $item->menu_meta['mega_menu'] ) && '' != $item->menu_meta['mega_menu'] ) {
			$item->mega_menu = $item->menu_meta['mega_menu'];
		} else {
			$item->mega_menu = false;
		}

		return $item;
	}

	public function setup_nav_menu_item_args( $args, $item, $depth ) {
		$args->menu_meta = ak_get_post_meta( 'menu_item_menu_meta', $item->ID );

		return $args;
	}

	public function setup_nav_mega_menu( $item_output, $item, $depth, $args ) {

		if ( 0 == $depth && $item->mega_menu ) {
			$mega_args = $this->get_mega_menu( $item->mega_menu );

			// Menu Animations
			$menu_anim = isset( $args->menu_meta['drop_menu_anim'] ) ? $args->menu_meta['drop_menu_anim'] : '';
			if ( ! empty( $menu_anim ) && '' !== $menu_anim ) {
				$anim = 'none' !== $menu_anim ? 'ak-anim ak-anim-' . $menu_anim : '';
			} else {
				$anim = 0 == $depth ? 'ak-anim ak-anim-slide-in-down' : 'ak-anim ak-anim-slide-in-left';
			}

			if ( $mega_args && file_exists( $mega_args['file'] ) ) {
				$item_output .= '<div class="ak-mega-menu ak-mega-' . $item->mega_menu . ' ' . $anim . '">';
				ob_start();
				include $mega_args['file'];
				$item_output .= ob_get_clean();
				$item_output .= '</div>';
			}
		}

		unset( $mega_args );
		return $item_output;
	}


	public function setup_nav_menu_submenu_class( $classes, $args, $depth ) {
		$classes[] = 'ak-sub-menu';

		// Prepare params for mega menu
		if ( isset( $args->menu_meta['sub_menu'] ) && '' !== $args->menu_meta['sub_menu'] ) {
			$classes[] = 'sub-menu-' . $args->menu_meta['sub_menu'];
		}

		// Menu Animations
		$menu_anim = isset( $args->menu_meta['drop_menu_anim'] ) ? $args->menu_meta['drop_menu_anim'] : '';
		if ( ! empty( $menu_anim ) && '' !== $menu_anim ) {
			$classes[] = 'none' !== $menu_anim ? 'ak-anim ak-anim-' . $menu_anim : '';
		} else {
			$classes[] = 0 == $depth ? 'ak-anim ak-anim-fade-in' : 'ak-anim ak-anim-slide-in-left';
		}

		return $classes;
	}
}
