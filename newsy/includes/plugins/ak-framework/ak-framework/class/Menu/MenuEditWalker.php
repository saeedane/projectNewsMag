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
 * Walker for back-end adding and saving menus custom fields.
 */
class MenuEditWalker extends \Walker_Nav_Menu_Edit {
	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker_Nav_Menu::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string   $output Passed by reference.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   Not used.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker_Nav_Menu::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string   $output Passed by reference.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   Not used.
	 */
	public function end_lvl( &$output, $depth = 0, $args = null ) {}

	/**
	 * Used for appending admin fields.
	 *
	 * @param string   $output            Used to append additional content (passed by reference).
	 * @param WP_Post  $data_object       Menu item data object.
	 * @param int      $depth             Depth of menu item. Used for padding.
	 * @param stdClass $args              Not used.
	 * @param int      $current_object_id Optional. ID of the current menu item. Default 0.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $current_object_id = 0 ) {
		$item_output = '';
		parent::start_el( $item_output, $item, $depth, $args, $current_object_id );

		ob_start();
		do_action( 'ak_nav_menu_item_custom_fields', $item->ID, $item, $depth, $args );
		$buffy = ob_get_clean();

		$output .= preg_replace( '/(?=<div[^>]+class="[^"]*submitbox)/', $buffy, $item_output );
	}
}
