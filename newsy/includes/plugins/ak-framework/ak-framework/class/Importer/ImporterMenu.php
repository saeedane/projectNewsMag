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
namespace Ak\Importer;
/**
 * Class ImporterMenu handle to add new menu.
 */
class ImporterMenu extends  ImporterAbstract {

	private static $type_id = 'menu';

	public static $menu_id = 0;

	static function create( $params ) {

		parent::check_params(
			__CLASS__, __FUNCTION__, $params, array(
				'the_ID' => 'Param is required!',
				'name'   => 'Param is required!',
				'items'  => 'Param is required!',
			)
		);

		$location = isset( $params['location'] ) ? $params['location'] : '';

		$created_menu = self::create_menu( $params['name'], $location );

		list( $menu_id, $menu_exists ) = $created_menu;

		if ( isset( $params['items'] ) ) {
			self::create_items( $params['items'] );
		}

		return $menu_id;
	}

	static function create_menu( $menu_name, $menu_location = '', $unique = true ) {

		if ( $unique ) {
			$original_name = $menu_name;
			$suffix        = 2;
			while ( $menu_object = self::get_menu( $menu_name ) ) {
				$menu_name = $original_name . ' ' . $suffix;
				$suffix ++;
			}
		} else {
			$menu_object = self::get_menu( $menu_name );
		}

		if ( ! is_object( $menu_object ) || ! isset( $menu_object->term_id ) ) {

			$maybe_menu_id = wp_create_nav_menu( $menu_name );

			if ( is_wp_error( $maybe_menu_id ) ) {
				return $maybe_menu_id;
			}
			$menu_id = &$maybe_menu_id;
			$exists  = false;

		} else {

			$exists  = true;
			$menu_id = &$menu_object->term_id;
		}

		if ( ! empty( $menu_location ) ) {

			$menu_locations = get_theme_mod( 'nav_menu_locations' );

			// activate the menu only if it's not already active
			if ( is_array( $menu_location ) ) {
				foreach ( $menu_location as $loc ) {
					if ( empty( $menu_locations[ $loc ] ) || $menu_locations[ $loc ] != $menu_id ) {
						$menu_locations[ $loc ] = $menu_id;
					}
				}
			} else {
				if ( empty( $menu_locations[ $menu_location ] ) || $menu_locations[ $menu_location ] != $menu_id ) {
					$menu_locations[ $menu_location ] = $menu_id;
				}
			}

			set_theme_mod( 'nav_menu_locations', $menu_locations );
		}

		self::$menu_id = $menu_id;

		return array( $menu_id, $exists );
	}

	/**
	 * Get nav menu object
	 *
	 * @param string|int|object $menu Menu ID, slug, or name - or the menu object.
	 *
	 * @return object|bool menu object on success or false on error;
	 */
	protected static function get_menu( $menu ) {
		$menu_object = wp_get_nav_menu_object( $menu );
		if ( is_object( $menu_object ) && isset( $menu_object->term_id ) ) {
			return $menu_object;
		}

		return false;
	}

	/**
	 * @param array $menu_params The menu item's data.
	 *
	 * @see wp_update_nav_menu_item() $menu_item_data parameter
	 *
	 * @return int|WP_Error WP_ERROR on failure or item ID on success.
	 */
	static function create_items( $menu_items, $parent_id = false ) {

		if ( is_array( $menu_items ) ) {

			foreach ( $menu_items as $params ) {

				if ( ! isset( $params['item_type'] ) ) {
					continue;
				}

				if ( false !== $parent_id ) {
					$params['parent-id'] = $parent_id;
				}

				$item_id = 0;
				switch ( $params['item_type'] ) {

					case 'custom':
						$item_id = self::append_link( $params );
						break;

					case 'post':
						$item_id = self::append_post_link( $params );
						break;

					case 'taxonomy':
						$item_id = self::append_taxonomy_link( $params );
						break;
				}

				if ( $item_id ) {

					// add menu post meta
					if ( isset( $params['item_meta'] ) && is_array( $params['item_meta'] ) ) {
						$menu_meta = array();
						foreach ( $params['item_meta'] as $meta ) {
							if ( isset( $meta['key'] ) && isset( $meta['value'] ) ) {
								$menu_meta[ $meta['key'] ] = parent::_filter_required_id( 'global', $meta['value'] );
							}
						}

						ak_update_post_meta( 'menu_item_menu_meta', $item_id, $menu_meta );
					}

					// create sub menus
					if ( isset( $params['items'] ) ) {
						self::create_items( $params['items'], $item_id );
					}
				}
			}
		}

	} // create_link


	/**
	 * @param array $menu_params The menu item's data.
	 *
	 * @see wp_update_nav_menu_item() $menu_item_data parameter
	 *
	 * @return int|WP_Error WP_ERROR on failure or item ID on success.
	 */
	static function create_link( $menu_params ) {

		$menu_item_data = wp_parse_args(
			$menu_params, array(
				'menu-item-object-id' => 0,
				'menu-item-object'    => '',
				'menu-item-title'     => '',
				'menu-item-url'       => '',
				'menu-item-type'      => 'custom',
				'menu-item-status'    => 'publish',
				'menu-item-parent-id' => 0,
			)
		);

		if ( ! $menu_item_data['menu-item-title'] && 'custom' == $menu_item_data['menu-item-type'] ) {
			return new \WP_Error( 'empty_menu_title', 'menu-item-title cannot be empty!' );
		}

		$menu_item_id = wp_update_nav_menu_item( self::$menu_id, 0, $menu_item_data );

		if ( is_wp_error( $menu_item_id ) ) {
			return $menu_item_id;
		}

		return $menu_item_id;
	} // create_link


	/**
	 * add "menu-item-" prefix to array indexes
	 *
	 * @param Array $params
	 */
	protected static function prepare_menu_params( &$params ) {

		$new_params = array();

		foreach ( $params as $key => $value ) {
			$new_params[ 'menu-item-' . $key ] = $value;
		}

		$params = $new_params;
	}
	/**
	 * append custom link to menu
	 * array {
	 * @type string $title menu title
	 * @type string $url   menu url
	 * }
	 *
	 * @see create_link()
	 *
	 * @param Array $params
	 *
	 * @return int|WP_Error WP_ERROR on failure or item ID on success.
	 */
	protected static function append_link( $params ) {

		self::prepare_menu_params( $params );

		return self::create_link( $params );
	}



	/**
	 * append custom post type link to menu
	 *
	 * @param integer    $post_id   Post ID in Database
	 * @param string $post_type Post Type
	 * @param array  $params
	 *
	 * @see create_link()
	 *
	 * @return int|WP_Error WP_ERROR on failure or item ID on success.
	 */
	protected static function append_post_link( $params = array() ) {

		if ( ! isset( $params['item_id'] ) ) {
			return false;
		}

		$post_id = parent::_filter_required_id( $params['item_type'], $params['item_id'] );

		$post = get_post( $post_id );

		if ( ! $post ) {
			return false;
		}

		$params = wp_parse_args(
			$params, array(
				'type'      => 'post_type',
				'object'    => $post->post_type,
				'object-id' => $post->ID,
				'url'       => esc_url( get_permalink( $post->ID ) ),
				'title'     => esc_html( $post->title ),
			)
		);

		self::prepare_menu_params( $params );

		return self::create_link( $params );
	}


	/**
	 * append taxonomy link to menu
	 *
	 * @param integer    $term_id  Term ID in Database
	 * @param string $taxonomy The taxonomy name to use
	 * @param array  $params
	 *
	 * @return int|bool|WP_Error WP_ERROR or false on failure or item ID on success.
	 */
	protected static function append_taxonomy_link( $params = array() ) {

		if ( ! isset( $params['item_id'] ) || ! isset( $params['taxonomy'] ) || ! taxonomy_exists( $params['taxonomy'] ) ) {
			return false;
		}

		$taxonomy = &$params['taxonomy'];
		$term_id  = parent::_filter_required_id( $params['item_type'], $params['item_id'] );

		settype( $term_id, 'int' );

		if ( ! term_exists( $term_id, $taxonomy ) ) {
			return false;
		}

		$params = wp_parse_args(
			$params, array(
				'object-id' => $term_id,
				'type'      => 'taxonomy',
				'object'    => $taxonomy,
				'url'       => get_term_link( $term_id, $taxonomy ),
			)
		);

		self::prepare_menu_params( $params );

		return self::create_link( $params );
	}

	static function remove( $menu_id ) {
		return wp_delete_nav_menu( intval( $menu_id ) );
	}
}
