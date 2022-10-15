<?php

if ( ! function_exists( 'ak_do_query' ) ) {
	/**
	 * Do post query.
	 *
	 * @param array $args
	 *
	 * @return mixed
	 */
	function ak_do_query( $args ) {
		return Ak\Support\PostQuery::do_query( $args );
	}
}

if ( ! function_exists( 'ak_do_pagination_query' ) ) {
	/**
	 * Do post query.
	 *
	 * @param array $args
	 *
	 * @return string
	 */
	function ak_do_pagination_query( $args, $current_page = 1 ) {
		return Ak\Support\PostQuery::do_pagination_query( $args, $current_page );
	}
}

if ( ! function_exists( 'ak_get_query_total_pages' ) ) {
	/**
	 * Calculates query total pages with support of offset and custom posts per page.
	 *
	 * @param WP_Query $wp_query
	 * @param integer      $offset
	 * @param integer      $posts_per_page
	 * @param bool     $use_query_offset
	 *
	 * @return float|int
	 */
	function ak_get_query_total_pages( &$wp_query, $paged = 0, $offset = 0, $posts_per_page = 0 ) {
		$offset         = intval( $offset );
		$paged          = intval( $paged );
		$posts_per_page = intval( $posts_per_page );

		if ( $posts_per_page <= 0 ) {
			$posts_per_page = $wp_query->get( 'posts_per_page' );
		}

		// use the query offset if it was set
		if ( $paged <= 0 ) {
			$paged = intval( $wp_query->get( 'paged' ) );
		}

		// use the query offset if it was set
		if ( $offset <= 0 ) {
			$offset = intval( $wp_query->get( 'offset' ) );
		}

		if ( $offset > 0 ) {
			$total = ceil( max( 0, $wp_query->found_posts - $offset ) / $posts_per_page ) + ( $paged - 1 );
		} else {
			$total = $wp_query->max_num_pages;
		}

		return $total;
	}
}

if ( ! function_exists( 'ak_get_pages' ) ) {
	/**
	 * Get Pages
	 *
	 * @param array $extra Extra Options.
	 *
	 * @since 2.3
	 *
	 * @return array
	 */
	function ak_get_pages( $extra = array() ) {

		/*
			Extra Usage:

			array(
				'sort_order'        =>  'ASC',
				'sort_column'       =>  'post_title',
				'hierarchical'      =>  1,
				'exclude'           =>  '',
				'include'           =>  '',
				'meta_key'          =>  '',
				'meta_value'        =>  '',
				'authors'           =>  '',
				'child_of'          =>  0,
				'parent'            =>  -1,
				'exclude_tree'      =>  '',
				'number'            =>  '',
				'offset'            =>  0,
				'post_type'         =>  'page',
				'post_status'       =>  'publish'
			)

		*/

		if ( ! empty( $extra['advanced-label'] ) ) {
			$advanced_label = true;
			unset( $extra['advanced-label'] );

			if ( 'page' == get_option( 'show_on_front' ) && get_option( 'page_on_front' ) ) {
				$front_page = get_option( 'page_on_front' );
			} else {
				$front_page = - 1;
			}
		} else {
			$advanced_label = false;
			$front_page     = - 1;
		}

		$output = array();

		$query = get_pages( $extra );

		foreach ( $query as $page ) {

			/** @var WP_Post $page */

			if ( $advanced_label ) {

				$append = '';

				if ( 'private' === $page->post_status ) {
					$append .= '(' . __( 'Private', 'ak-framework' ) . ')';
				} elseif ( 'draft' === $page->post_status ) {
					$append .= '(' . __( 'Draft', 'ak-framework' ) . ')';
				}

				if ( $page->ID == $front_page ) {
					$append .= '(' . __( 'Front Page', 'ak-framework' ) . ')';
				}

				if ( ! empty( $append ) ) {
					$output[ $page->ID ] = $page->post_title . ' - ' . $append;
				} else {
					$output[ $page->ID ] = $page->post_title;
				}
			} else {
				$output[ $page->ID ] = $page->post_title;
			}
		}

		return $output;

	}
}

if ( ! function_exists( 'ak_get_tags' ) ) {
	/**
	 * Get Tags
	 *
	 * @param array $extra Extra Options.
	 *
	 * @since 1.0
	 * @return mixed
	 */
	function ak_get_tags( $extra = array() ) {

		$output = array();
		$query  = get_tags( $extra );

		foreach ( $query as $tag ) {
			$output[ $tag->term_id ] = $tag->name;
		}

		return $output;

	}
}

if ( ! function_exists( 'ak_get_child_categories' ) ) {
	/**
	 * Gets category child or siblings if enabled
	 *
	 * @param null $term        Term object or ID
	 * @param integer  $limit       Number of cats
	 * @param bool $or_siblings Return siblings if there is nor child
	 *
	 * @return array
	 */
	function ak_get_child_categories( $term = null, $limit = -1, $or_siblings = false ) {

		if ( ! $term ) {
			return array();
		} elseif ( ! is_object( $term ) ) {
			$term = get_term( $term, 'category' );
			if ( ! $term || is_wp_error( $term ) ) {
				return array();
			}
		} else {
			return array();
		}

		// fix limit number for get_categories
		if ( -1 === $limit ) {
			$limit = 0;
		}

		$cat_args = array(
			'parent'     => $term->term_id,
			'hide_empty' => 0,
			'number'     => -1 === $limit ? 0 : $limit,
		);

		// Get child categories
		$child_categories = get_categories( $cat_args );

		// Get sibling cats if there is no child category
		if ( count( $child_categories ) == 0 && $or_siblings ) {
			$cat_args['parent'] = $term->parent;
			$child_categories   = get_categories( $cat_args );
		}

		return $child_categories;

	}
}

if ( ! function_exists( 'ak_get_term_posts_count' ) ) {

	/**
	 * Returns count of all posts of category
	 *
	 * @param null  $term_id
	 * @param array $args
	 *
	 * @return int
	 */
	function ak_get_term_posts_count( $term_id = null, $args = array() ) {

		if ( is_null( $term_id ) ) {
			return 0;
		}

		$args = ak_merge_args(
			$args, array(
				'include_childs' => false,
				'post_type'      => 'post',
				'taxonomy'       => 'category',
				'term_field'     => 'term_id',
			)
		);

		// simple term posts count using get_term, this will work quicker because of WP Cache
		// but this is not real post count, because this wouldn't count sub terms posts count in hierarchical taxonomies
		if ( ! is_taxonomy_hierarchical( $args['taxonomy'] ) || ! $args['include_childs'] ) {

			$term = get_term( get_queried_object()->term_id, $args['taxonomy'] );

			if ( ! is_wp_error( $term ) ) {
				return $term->count;
			} else {
				return 0;
			}
		} else { // Real term posts count in hierarchical taxonomies

			$query = new WP_Query(
				array(
					'post_type'      => $args['post_type'],
					'tax_query'      => array(
						array(
							'taxonomy' => $args['taxonomy'],
							'field'    => $args['term_field'],
							'terms'    => $term_id,
						),
					),
					'posts_per_page' => 1,
					'fields'         => 'ids',
				)
			);

			return $query->found_posts;
		}

	}
}

if ( ! function_exists( 'ak_get_term_childs' ) ) {

	/**
	 * Retrieves children of terms as Term IDs - Except the excludes ones
	 *
	 * @param array  $include  List of term_id to include
	 * @param string $taxonomy Term taxonomy
	 * @param array  $exclude  List of term_id to exclude
	 *
	 * @return array
	 */
	function ak_get_term_childs( $include, $exclude = array(), $taxonomy = 'category' ) {

		$hierarchy_struct = _get_term_hierarchy( $taxonomy );
		$parents_id       = array_keys( $hierarchy_struct );

		$includes_list = array();

		if ( $include ) {
			_ak_get_term_childs( $include, $hierarchy_struct, $exclude, $includes_list );
		}

		$parents = array();
		do {

			$_parents = $parents;
			$parents  = array_intersect(
				$includes_list,
				$parents_id
			);
			_ak_get_term_childs( $parents, $hierarchy_struct, $exclude, $includes_list );

		} while ( sizeOf( $_parents ) !== sizeOf( $parents ) );

		return $includes_list;
	}


	function _ak_get_term_childs( $terms_id, $hierarchy_struct, $exclude, &$includes_list ) {

		foreach ( $terms_id as $maybe_parent ) {
			$includes_list[] = $maybe_parent;

			if ( isset( $hierarchy_struct[ $maybe_parent ] ) ) {

				$includes_list = array_merge( array_diff( $hierarchy_struct[ $maybe_parent ], $exclude ), $includes_list );
			}
		}

		$includes_list = array_unique( $includes_list );
	}
}


if ( ! function_exists( 'ak_taxonomy_supports_post_type' ) ) {
	/**
	 * Checks taxonomy to make sure that was added to a post type
	 *
	 * @param $taxonomy
	 * @param $post_type
	 *
	 * @return bool|mixed
	 */
	function ak_taxonomy_supports_post_type( $taxonomy, $post_type ) {

		static $supports;

		if ( is_null( $supports ) ) {
			$supports = array();
		}

		if ( isset( $supports[ $post_type ] ) ) {
			return $supports[ $post_type ];
		}

		global $wp_taxonomies;

		if ( empty( $wp_taxonomies[ $taxonomy ]->object_type ) ) {
			$supports[ $post_type ] = false;
		} else {
			$supports[ $post_type ] = in_array( $post_type, $wp_taxonomies[ $taxonomy ]->object_type, true );
		}

		return $supports[ $post_type ];
	}
}


