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

use Ak\Form\FormManager;

/**
 * Ak Framework core menu manager.
 */
class MenuMeta {

	/**
	 * Registered Metaboxes.
	 *
	 * @var array
	 */
	public static $metaboxes = array();

	/**
	 * Active Fields.
	 *
	 * @var array
	 */
	public static $fields = array();

	/**
	 * BF Menu Field generator.
	 *
	 * @var
	 */
	public $field_generator;

	/**
	 * BF Menu Field generator.
	 *
	 * @var
	 */
	public $locations = array();

	/**
	 * @var MenuMeta
	 */
	private static $instance;

	/**
	 * @return MenuMeta
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}
	/**
	 * Menu constructor.
	 */
	public function __construct() {
		self::$metaboxes = apply_filters( 'ak-framework/menu/meta', array() );

		if ( empty( self::$metaboxes ) ) {
			return;
		}

		add_action( 'ak_nav_menu_item_custom_fields', array( $this, 'nav_menu_item_custom_fields' ), 10, 4 );
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'edit_nav_menu_walker' ), 999 );
		add_action( 'wp_update_nav_menu_item', array( $this, 'update_nav_menu_item' ), 10, 3 );
	}

	public function menu_locations() {
		if ( empty( $this->locations ) ) {
			$this->locations = array_flip( (array) get_nav_menu_locations() );
		}

		return $this->locations;
	}

	public function get_menu_location( $menu_id ) {
		$locations = $this->menu_locations();

		return isset( $locations[ $menu_id ] ) ? $locations[ $menu_id ] : false;
	}

	public function get_menu_location_by_item( $item_id ) {
		$menu = wp_get_post_terms( $item_id, 'nav_menu' );

		if ( ! isset( $menu[0] ) ) {
			return false;
		}

		$menu_id = $menu[0]->term_id;

		return $this->get_menu_location( $menu_id );
	}

	/**
	 * Setup custom walker for editing the menu.
	 */
	public function edit_nav_menu_walker( $walker, $menu_id = null ) {
		return 'Ak\Menu\MenuEditWalker';
	}

	/**
	 * Save menu custom fields.
	 *
	 * @global $wp_version WordPress version number
	 */
	public function nav_menu_item_custom_fields( $id, $item, $depth, $args ) {
		$menu_location = $this->get_menu_location_by_item( $item->ID );

		if ( ! $menu_location && isset( self::$metaboxes['global']['file'] ) ) {
			$menu_location = 'global';
		}

		if ( ! $menu_location || ! isset( self::$metaboxes[ $menu_location ]['file'] ) ) {
			return;
		}

		$manager_instance = new FormManager(
			array(
				'input_prefix' => "ak_menu[{$item->ID}]",
				'file'         => self::$metaboxes[ $menu_location ]['file'],
				'values'       => ! empty( $item->menu_meta ) ? $item->menu_meta : array(),
				'panel_class'  => 'ak-menu-options ak-panel-menu-top ak-panel-menu-hide',
			)
		);

		if ( $manager_instance->has_fields() ) {
			$output  = '<div class="clearfix"></div>';
			$output .= $manager_instance->render_form();

			ak_sanitize_echo( $output );
		}
	}

	/**
	 * Save menu custom fields.
	 *
	 * @global $wp_version WordPress version number
	 */
	public function update_nav_menu_item( $menu_id, $menu_item_db_id, $menu_item_data ) {
		if ( ! isset( $_POST['ak_menu'][ $menu_item_db_id ] ) ) {
			return;
		}

		$menu_location = $this->get_menu_location_by_item( $menu_item_db_id );

		if ( ! $menu_location && isset( self::$metaboxes['global']['file'] ) ) {
			$menu_location = 'global';
		}

		if ( ! $menu_location || ! isset( self::$metaboxes[ $menu_location ]['file'] ) ) {
			return;
		}

		$manager = new FormManager(
			array(
				'prepare' => false,
				'file'    => self::$metaboxes[ $menu_location ]['file'],
			)
		);

		$fields     = $manager->get_fields();
		$item_value = &$_POST['ak_menu'][ $menu_item_db_id ];

		if ( ! empty( $fields ) ) {
			foreach ( $fields as $field ) {
				if ( ! isset( $field['id'] ) && ! isset( $field['section'] ) ) {
					continue;
				}

				$id = &$field['id'];

				// check if saved value is empty or default one delete it no need to record
				if ( empty( $item_value[ $id ] ) || isset( $field['default'] ) && $field['default'] == $item_value ) {
					unset( $item_value[ $id ] );
				}
			}
		}

		// store all data in one record
		if ( empty( $item_value ) ) {
			ak_delete_post_meta( 'menu_item_menu_meta', $menu_item_db_id );
		} else {
			ak_update_post_meta( 'menu_item_menu_meta', $menu_item_db_id, $item_value );
		}
	}
}
