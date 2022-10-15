<?php
/**
 * The AkFramework.
 *
 * AkFramework is framework for themes and plugins for WordPress.
 *
 *  Copyright © 2020 akbilisim
 *  www.akbilisim.com
 *
 *
 *  Envato Profile: https://themeforest.net/user/akbilisim
 */

namespace Ak\Support;

/**
 * Class Post Query Manager.
 */
class PostQuery {

	private static function filter( &$atts ) {
		$accepted = array(
			'pagination',
			'post_type',
			'post_status',
			'order_by',
			'count',
			'offset',
			'time_filter',

			'paged',

			'category',
			'post',
			'author',
			'taxonomy',
			'taxonomy_relation',

			'tax_query',
			'meta_query',
		);

		foreach ( $atts as $key => $value ) {
			if ( ! in_array( $key, $accepted ) || empty( $value ) ) {
				unset( $atts[ $key ] );
			}
		}

		return $atts;
	}

	private static function prepare( &$atts ) {
		$atts = self::filter( $atts );

		$args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'order_by'            => 'latest',
			'ignore_sticky_posts' => 1,
			'paged'               => 1,
			'no_found_rows'       => true,
			'tax_query'           => array(),
		);

		if ( ! empty( $atts['pagination'] ) ) {
			$args['no_found_rows'] = false;

			// simple pagination
			if ( 'simple' === $atts['pagination'] ) {
				$atts['paged'] = ak_get_query_var_paged();
			}
		}

		// Custom post types
		if ( ! empty( $atts['post_type'] ) ) {
			$args['post_type'] = explode( ',', $atts['post_type'] );
		}

		// Custom post types
		if ( ! empty( $atts['post_status'] ) ) {
			$args['post_status'] = explode( ',', $atts['post_status'] );
		}

		// posts per page
		if ( ! empty( $atts['count'] ) && absint( $atts['count'] ) > 0 ) {
			$args['posts_per_page'] = absint( $atts['count'] );
		} else {
			$args['posts_per_page'] = get_option( 'posts_per_page' );
		}

		// paged
		$paged = 1;
		if ( ! empty( $atts['paged'] ) ) {
			$paged         = $atts['paged'];
			$args['paged'] = $paged;
		}

		// offset
		if ( ! empty( $atts['offset'] ) ) {
			if ( $paged > 1 ) {
				$args['offset'] = absint( $atts['offset'] ) + ( ( $paged - 1 ) * $args['posts_per_page'] );
			} else {
				$args['offset'] = absint( $atts['offset'] );
			}
		}

		// orderby
		if ( ! empty( $atts['order_by'] ) ) {
			switch ( $atts['order_by'] ) {
				case 'latest':
					$args['orderby'] = 'date';
					$args['order']   = 'DESC';
					break;
				case 'oldest':
					$args['orderby'] = 'date';
					$args['order']   = 'ASC';
					break;
				case 'alphabet_asc':
					$args['orderby'] = 'title';
					$args['order']   = 'DESC';
					break;
				case 'alphabet_desc':
					$args['orderby'] = 'title';
					$args['order']   = 'ASC';
					break;
					break;
				case 'comment_count':
					$args['orderby'] = 'comment_count';
					$args['order']   = 'DESC';
					break;
					break;
				case 'random':
					$args['orderby'] = 'rand';
					break;
			}
		}

		// Time filter
		if ( ! empty( $atts['time_filter'] ) ) {
			switch ( $atts['time_filter'] ) {
				// Today posts
				case 'today':
					$args['date_query'] = array(
						array(
							'after' => '1 day ago',
						),
					);
					break;
				// Today + Yesterday posts
				case 'yesterday':
					$args['date_query'] = array(
						array(
							'after' => '2 day ago',
						),
					);
					break;
				// Week posts
				case 'week':
					$args['date_query'] = array(
						array(
							'after' => '1 week ago',
						),
					);
					break;
				// Month posts
				case 'month':
					$args['date_query'] = array(
						array(
							'after' => '1 month ago',
						),
					);
					break;
				// Year posts
				case 'year':
					$args['date_query'] = array(
						array(
							'after' => '1 year ago',
						),
					);
					break;
			}
		}

		if ( ! empty( $atts['author'] ) ) {
			$args['author'] = $atts['author'];
		}

		/**
		 * Start Handle Query Conditions.
		 */
		if ( ! empty( $atts['category'] ) ) {
			$terms_id_include = array();
			$terms_id_exclude = array();

			foreach ( explode( ',', $atts['category'] ) as $term_id ) {

				if ( '-' === $term_id[0] ) {
					$terms_id_exclude[] = substr( $term_id, 1 );
				} else {
					$terms_id_include[] = $term_id;
				}
			}
			if ( $terms_id_include ) {
				$args['tax_query'][] = array(
					'terms'            => ak_get_term_childs( $terms_id_include, $terms_id_exclude ),
					'taxonomy'         => 'category',
					'field'            => 'term_id',
					'operator'         => isset( $atts['cats-condition'] ) ? strtoupper( $atts['cats-condition'] ) : 'IN',
					'include_children' => false,
				);
			}
			if ( $terms_id_exclude ) {
				$args['tax_query'][] = array(
					'taxonomy'         => 'category',
					'field'            => 'term_id',
					'terms'            => $terms_id_exclude,
					'operator'         => 'NOT IN',
					'include_children' => false,
				);
			}
		}

		// Post id filters
		if ( ! empty( $atts['post'] ) ) {
			$post_ids = is_array( $atts['post'] ) ? $atts['post'] : explode( ',', $atts['post'] );
			$posts    = array();

			foreach ( $post_ids as $idx ) {
				$section = substr( $idx, 0, 1 ) === '-' ? 'exclude' : 'include';

				$posts[ $section ][] = absint( trim( $idx ) );
			}

			if ( ! empty( $posts['include'] ) ) {
				$args['post__in'] = $posts['include'];
				$args['orderby']  = 'post__in';
			} elseif ( ! empty( $posts['exclude'] ) ) {
				$args['post__not_in'] = $posts['exclude'];
			}
			unset( $posts );
		}

		// taxonomy query
		if ( ! empty( $atts['taxonomy'] ) ) {
			$tax_terms = array();

			if ( preg_match_all( '/  ([^:]+) : ([^,]+) \s* \,? /isx', $atts['taxonomy'], $matches ) ) {
				foreach ( $matches[1] as $idx => $taxonomy ) {
					$section         = '-' === $taxonomy[0] ? 'exclude' : 'include';
					$taxonomy        = trim( ltrim( $taxonomy, '-' ) );
					$term_id_or_slug = trim( $matches[2][ $idx ] );

					if ( absint( $term_id_or_slug ) > 0 ) {
						$tax_terms[ $taxonomy ][ $section ][] = absint( $term_id_or_slug );
					} else {
						$_term = term_exists( $term_id_or_slug, $taxonomy );
						if ( $_term ) {
							$tax_terms[ $taxonomy ][ $section ][] = absint( $_term['term_id'] );
						}
					}
				}

				unset( $matches );
			}

			if ( ! empty( $tax_terms ) ) {
				foreach ( $tax_terms as $taxonomy => $term ) {
					$terms_id_include = isset( $term['include'] ) ? $term['include'] : array();
					$terms_id_exclude = isset( $term['exclude'] ) ? $term['exclude'] : array();

					if ( $terms_id_include ) {
						$args['tax_query'][] = array(
							'terms'            => ak_get_term_childs( $terms_id_include, $terms_id_exclude, $taxonomy ),
							'taxonomy'         => $taxonomy,
							'include_children' => false,
						);
					}

					if ( $terms_id_exclude ) {
						$args['tax_query'][] = array(
							'taxonomy'         => $taxonomy,
							'field'            => 'term_id',
							'terms'            => $terms_id_exclude,
							'operator'         => 'NOT IN',
							'include_children' => false,
						);
					}
				}
			}
			unset( $tax_terms );
		}

		if ( empty( $args['tax_query'] ) ) {
			unset( $args['tax_query'] );
		} else {
			$args['tax_query']['relation'] = isset( $atts['taxonomy_relation'] ) ? $atts['taxonomy_relation'] : 'AND';
		}

		// meta_query
		if ( ! empty( $atts['meta_query'] ) ) {
			$args['meta_query'] = $atts['meta_query'];
		}

		// END Handle Query Conditions
		return apply_filters( 'ak-framework/post-query-args', $args, $atts );
	}


	public static function do_query( $atts ) {
		$args = self::prepare( $atts );

		$query_hash = 'ak_query_hash_' . md5( serialize( $args ) );

		$query = ak_get_cache( $query_hash, 'ak_query' );

		if ( ! $query ) {
			$query = new \WP_Query( $args );

			ak_set_cache( $query_hash, $query, 'ak_query' );

			wp_reset_postdata();
		}

		return $query;
	}

	/**
	 * Add ability to receive Paging Parameter and Tag Parameter
	 *
	 * @param $instance
	 * @param $attr
	 * @return array
	 */
	public static function do_pagination_query( $atts, $current_page = 1 ) {
		$atts['paged'] = $current_page;

		$query = self::do_query( $atts );

		$result = array();
		foreach ( $query->posts as $post ) {
			$result[] = $post;
		}

		$total        = ak_get_query_total_pages( $query );
		$current_page = $query->get( 'paged' );

		return array(
			'result'       => $result,
			'total_page'   => $total,
			'current_page' => absint( $current_page ),
			'have_next'    => $total > $current_page,
			'have_prev'    => $current_page > 1,
		);
	}
}
