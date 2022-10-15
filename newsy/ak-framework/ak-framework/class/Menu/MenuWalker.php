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
 * Frontside Menu Walker.
 */
class MenuWalker extends \Walker_Nav_Menu {

	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 * @see Walker::start_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param integer    $depth  Depth of menu item. Used for padding.
	 * @param stdClass  $args   An array of arguments.
	 * @param integer    $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$_class      = array();
		$link_before = '';
		$link_after  = '';

		// add specific class for identical usages for categories
		if ( 'category' == $item->object ) {
			$_class[] = 'menu-term-' . $item->object_id;
		}

		// Delete item title when hiding title set
		if ( isset( $item->menu_meta['hide_menu_title'] ) && 'hide' == $item->menu_meta['hide_menu_title'] ) {
			$_class[]    = 'menu-title-hide';
			$item->title = '<span class="hidden">' . $item->title . '</span>';
		} else {
			$item->title = '<span>' . $item->title . '</span>';
		}

		// Menu Icons
		if ( isset( $item->menu_meta['menu_icon'] ) ) {
			if ( isset( $item->menu_meta['menu_icon_color'] ) ) {
				$link_before .= '<span style="color:' . esc_attr( $item->menu_meta['menu_icon_color'] ) . '">' . ak_get_icon( $item->menu_meta['menu_icon'] ) . '</span>';
			} else {
				$link_before .= ak_get_icon( $item->menu_meta['menu_icon'] );
			}

			$_class[] = 'menu-have-icon';
		}

		// Generate Badges html
		if ( isset( $item->menu_meta['badge_label'] ) ) {
			$badge_position = isset( $item->menu_meta['badge_position'] ) ? $item->menu_meta['badge_position'] : 'right';
			$badge_color    = isset( $item->menu_meta['badge_color'] ) ? 'style="background-color:' . $item->menu_meta['badge_position'] . ';border-color:' . $item->menu_meta['badge_position'] . '' : '';
			$_class[]       = 'menu-have-badge menu-badge-' . $badge_position;

			$link_after .= '<span class="menu-item-badge" ' . $badge_color . '>' . $item->menu_meta['badge_label'] . '</span>';
		}

		// Prepare params for mega menu
		if ( 0 == $depth && $item->mega_menu ) {
			$_class[] = 'menu-item-has-children menu-item-has-mega menu-item-mega-' . $item->mega_menu;
		}

		// Merge menu classes
		$item->classes = array_merge( (array) $item->classes, $_class );
		unset( $_class );

		$args->link_before = $link_before;
		$args->link_after  = $link_after;

		parent::start_el( $output, $item, $depth, $args, $id );
	}

}
