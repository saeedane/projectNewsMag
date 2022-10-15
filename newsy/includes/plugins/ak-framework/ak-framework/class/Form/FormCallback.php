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

namespace Ak\Form;

/**
 * Contain General callbacks that used in Ak Framework Ajax Select control.
 */
class FormCallback {

	/**
	 * Used for finding post name from ID.
	 *
	 * @param $id
	 *
	 * @return string
	 */
	public static function post_name( $id ) {
		return get_the_title( $id );
	}

	/**
	 * Used to retrieving posts from an keyword.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_posts( $args = array() ) {
		if ( isset( $args['search'] ) ) {
			$search = sanitize_text_field( wp_unslash( $args['search'] ) );

			add_filter(
				'posts_where', function ( $where ) use ( $search ) {
					global $wpdb;
					$where .= $wpdb->prepare(
						" AND {$wpdb->posts}.post_title LIKE '%%%s%%'",
						$search
					);

					return $where;
				}
			);
			unset( $args['search'] );
		}

		$defaults = array(
			'post_type'      => 'any',
			'post_status'    => 'publish',
			'posts_per_page' => 10,
			'orderby'        => 'date',
			'order'          => 'DESC',
		);

		$args = wp_parse_args( $args, $defaults );

		$q = new \WP_Query( $args );

		$results = array();
		while ( $q->have_posts() ) {
			$q->the_post();

			$results[ get_the_ID() ] = get_the_title();
		}

		wp_reset_postdata();

		return $results;
	}

	/**
	 * Used to retrieving posts from an keyword.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_posts_by_values( $values = array() ) {
		if ( is_string( $values ) ) {
			$values = explode( ',', $values );
		}

		$results = array();
		foreach ( $values as $val ) {
			if ( false !== get_post_status( absint( $val ) ) ) {
				$results[ $val ] = self::post_name( absint( $val ) );
			}
		}

		return $results;
	}

	/**
	 * Used for finding Category Name from ID.
	 *
	 * @param $id
	 *
	 * @return string
	 */
	public static function get_term_name_by_id( $id, $tax ) {
		$term = get_term( $id, $tax );

		if ( ! $term ) {
			return false;
		}

		return $term->name;
	}

	/**
	 * Used for finding Term Slug from ID.
	 *
	 * @param $id
	 *
	 * @return string
	 */
	public static function get_term_slug_by_id( $id, $tax ) {
		$term = get_term( $id, $tax );

		if ( ! $term ) {
			return false;
		}

		return $term->slug;
	}

	/**
	 * Used for finding Term Name from slug.
	 *
	 * @param $id
	 *
	 * @return string
	 */
	public static function get_term_name_by_slug( $slug, $tax ) {
		$term = get_term_by( 'slug', $slug, $tax );

		if ( ! $term ) {
			return false;
		}

		return $term->name;
	}

	/**
	 * Used to retrieving Categories from an keyword.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_categories( $args = array() ) {
		$defaults = array(
			'taxonomy'   => 'category',
			'orderby'    => 'name',
			'hide_empty' => false,
			'number'     => 100,
			'by_slug'    => false,
		);
		$args     = wp_parse_args( $args, $defaults );

		$results = array();
		$terms   = get_terms( $args );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				if ( $args['by_slug'] ) {
					$_term = self::get_term_slug_by_id( $term->term_id, $args['taxonomy'] );
				} else {
					$_term = $term->term_id;
				}

				$results[ $_term ] = $term->name;
			}
		}

		return $results;
	}

	/**
	 * Used to retrieving categories from values.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_categories_by_values( $values = array() ) {
		if ( is_string( $values ) ) {
			$values = explode( ',', $values );
		}

		$results = array();
		foreach ( $values as $val ) {
			if ( is_numeric( $val ) ) {
				$_term_name = self::get_term_name_by_id( absint( $val ), 'category' );
			} else {
				$_term_name = self::get_term_name_by_slug( $val, 'category' );
			}

			if ( $_term_name ) {
				$results[ $val ] = $_term_name;
			}
		}

		return $results;
	}

	/**
	 * Used to retrieving Tags from an keyword.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_tags( $args = array() ) {
		$defaults = array(
			'taxonomy'   => 'post_tag',
			'hide_empty' => false,
			'number'     => 10,
			'by_slug'    => false,
		);
		$args     = wp_parse_args( $args, $defaults );

		$results = array();
		$terms   = get_terms( $args );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				if ( $args['by_slug'] ) {
					$_term = self::get_term_slug_by_id( $term->term_id, 'post_tag' );
				} else {
					$_term = $term->term_id;
				}

				$results[ $_term ] = $term->name;
			}
		}

		return $results;
	}

	/**
	 * Used to retrieving posts from values.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_tags_by_values( $values = array() ) {
		if ( is_string( $values ) ) {
			$values = explode( ',', $values );
		}

		$results = array();
		foreach ( $values as $val ) {

			if ( is_numeric( $val ) ) {
				$_term_name = self::get_term_name_by_id( absint( $val ), 'post_tag' );
			} else {
				$_term_name = self::get_term_name_by_slug( $val, 'post_tag' );
			}

			if ( $_term_name ) {
				$results[ $val ] = $_term_name;
			}
		}

		return $results;
	}

	/**
	 * Used to retrieving Tags from an keyword.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_taxonomies( $args = array() ) {
		$defaults = array(
			'hide_empty' => false,
			'number'     => 10,
			'by_slug'    => false,
		);
		$args     = wp_parse_args( $args, $defaults );

		$results = array();
		$terms   = get_terms( $args );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				if ( $args['by_slug'] ) {
					$_term = self::get_term_slug_by_id( $term->term_id, $term->taxonomy );
				} else {
					$_term = $term->term_id;
				}

				$results[ $term->taxonomy . ':' . $_term ] = $term->taxonomy . ' | ' . $term->name;
			}
		}

		return $results;
	}

	/**
	 * Used to retrieving taxonomies from values.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_taxonomies_by_values( $values = array() ) {
		if ( is_string( $values ) ) {
			$values = explode( ',', $values );
		}

		$results = array();
		foreach ( $values as $val ) {
			$val      = explode( ':', $val );
			$taxonomy = trim( $val[0] );
			$term     = trim( $val[1] );

			if ( is_numeric( $term ) ) {
				$_term_name = self::get_term_name_by_id( absint( $term ), $taxonomy );
			} else {
				$_term_name = self::get_term_name_by_slug( $term, $taxonomy );
			}

			if ( $_term_name ) {
				$results[ $taxonomy . ':' . $term ] = $taxonomy . ' | ' . $_term_name;
			}
		}

		return $results;
	}

	/**
	 * Used for finding Category Name from ID.
	 *
	 * @param $id
	 *
	 * @return string
	 */
	public static function user_name( $id ) {
		$user_info = get_userdata( absint( $id ) );

		return  $user_info->user_nicename . ' (' . $user_info->display_name . ')';
	}

	/**
	 * Used to retrieving Users from an keyword.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_users( $args = array() ) {

		$defaults = array(
			'orderby' => 'display_name',
			'order'   => 'DESC',
			'number'  => 30,
		);
		$args     = wp_parse_args( $args, $defaults );

		if ( isset( $args['search'] ) ) {
			$args['search']         = '*' . $args['search'] . '*';
			$args['search_columns'] = array( 'user_login', 'user_nicename', 'display_name' );
		}

		$query = new \WP_User_Query( $args );

		// Get the results
		$users = $query->get_results();

		$results = array();

		if ( ! empty( $users ) ) {
			foreach ( $users as $user ) {
				$results[ $user->data->ID ] = self::user_name( $user->data->ID );
			}
		}

		return $results;
	}

	/**
	 * Used to retrieving posts from values.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_users_by_values( $values = array() ) {
		if ( is_string( $values ) ) {
			$values = explode( ',', $values );
		}

		$results = array();
		foreach ( $values as $val ) {
			$results[ $val ] = self::user_name( $val );
		}

		return $results;
	}

	/**
	 * Used to retrieving posts types.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_post_types( $args = array() ) {

		if ( ! isset( $args['exclude'] ) || ! is_array( $args['exclude'] ) ) {
			$args['exclude'] = array();
		}

		// Add revisions, nave menu and attachment post types to excludes
		$args['exclude'] = array_merge( $args['exclude'], array( 'revision', 'nav_menu_item', 'attachment' ) );

		$query = get_post_types(
			array(
				'public' => true,
			)
		);

		$results = array();

		foreach ( $query as $key => $val ) {

			if ( in_array( $key, $args['exclude'] ) ) {
				continue;
			}

			$results[ $key ] = ucfirst( $val );
		}

		return $results;
	}

	/**
	 * Used to retrieving posts from values.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_post_types_by_values( $values = array() ) {
		if ( is_string( $values ) ) {
			$values = explode( ',', $values );
		}

		$results = array();
		foreach ( $values as $val ) {
			$results[ $val ] = ucfirst( $val );
		}

		return $results;
	}

	/**
	 * Used to retrieving page templates.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_page_templates( $args = array() ) {

		if ( ! isset( $args['exclude'] ) || ! is_array( $args['exclude'] ) ) {
			$args['exclude'] = array();
		}

		$query = wp_get_theme()->get_page_templates();

		$results = array();

		foreach ( $query as $key => $val ) {

			if ( in_array( $key, $args['exclude'] ) ) {
				continue;
			}

			$results[ $key ] = $val;
		}

		return $results;
	}


	/**
	 * Used to retrieving posts from values.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_page_templates_by_values( $values = array() ) {
		if ( is_string( $values ) ) {
			$values = explode( ',', $values );
		}
		$query = wp_get_theme()->get_page_templates();

		$results = array();
		foreach ( $values as $val ) {
			$results[ $val ] = isset( $query[ $val ] ) ? $query[ $val ] : $val;
		}

		return $results;
	}

	/**
	 * Used to retrieving roles.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_roles( $args = array() ) {

		global $wp_roles;

		if ( ! isset( $args['exclude'] ) || ! is_array( $args['exclude'] ) ) {
			$args['exclude'] = array();
		}

		$results = array();

		foreach ( $wp_roles->roles as $key => $val ) {
			if ( in_array( $key, $args['exclude'] ) ) {
				continue;
			}

			$results[ $key ] = $val['name'];
		}

		return $results;
	}

	/**
	 * Used to retrieving roles from values.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_roles_by_values( $values = array() ) {
		if ( is_string( $values ) ) {
			$values = explode( ',', $values );
		}
		global $wp_roles;

		$results = array();
		foreach ( $values as $val ) {
			$results[ $val ] = isset( $wp_roles->roles[ $val ]['name'] ) ? $wp_roles->roles[ $val ]['name'] : $val;
		}

		return $results;
	}

	/**
	 * Used to retrieving menus.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_menus( $args = array() ) {
		$defaults = array(
			'hide_empty' => false,
		);
		$args     = wp_parse_args( $args, $defaults );

		$menus = get_terms( 'nav_menu', $args );

		$results = array();
		foreach ( $menus as $menu ) {
			$results[ $menu->term_id ] = $menu->name;
		}

		return $results;
	}

	/**
	 * Used to retrieving menus from values.
	 *
	 * @param $args
	 *
	 * @return array
	 */
	public static function get_menus_by_values( $values = array() ) {
		if ( is_string( $values ) ) {
			$values = explode( ',', $values );
		}
		$menus = get_terms( 'nav_menu', $values );

		$results = array();
		foreach ( $values as $val ) {
			$results[ $val ] = isset( $menus[ $val ]['name'] ) ? $menus[ $val ]['name'] : $val;
		}

		return $results;
	}
}
