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
 * Class ImporterTaxonomy handle to add new taxonomy.
 */
class ImporterTaxonomy extends ImporterAbstract {

	private static $type_id = 'taxonomy';

	public static function create( $params ) {
		parent::check_params(
			__CLASS__, __FUNCTION__, $params, array(
				'the_ID'   => 'Param is required!',
				'name'     => 'Param is required!',
				'taxonomy' => 'Taxonomy is required!',
			)
		);

		$term_params = array(
			'parent' => 0,
		);

		if ( ! empty( $params['parent'] ) ) {
			$term_params['parent'] = parent::_filter_required_id( self::$type_id, $params['parent'] );
		}
		if ( ! empty( $params['slug'] ) ) {
			$term_params['slug'] = sanitize_title( $params['slug'] );
		}
		if ( ! empty( $params['description'] ) ) {
			$term_params['description'] = $params['description'];
		}

		if ( ! taxonomy_exists( $params['taxonomy'] ) ) {
			return new \WP_Error( 'ImporterTaxonomy:', sprintf( 'invalid taxonomy: %s', $params['taxonomy'] ) );
		}

		$term = term_exists( $params['name'], $params['taxonomy'], $term_params['parent'] );
		if ( $term ) {
			$term_params['taxonomy'] = $params['taxonomy'];
			$term_params['slug']     = wp_unique_term_slug( $params['name'], (object) $term_params );
			$params['name']          = str_replace( '-', ' ', $term_params['slug'] );
		}

		$new_term = wp_insert_term( $params['name'], $params['taxonomy'], $term_params );

		if ( is_wp_error( $new_term ) ) {
			return $new_term;
		}

		$new_term_id = isset( $new_term['term_id'] ) ? $new_term['term_id'] : 0;

		if ( isset( $params['taxonomy_meta'] ) && is_array( $params['taxonomy_meta'] ) ) {
			foreach ( $params['taxonomy_meta'] as $term_meta ) {
				$meta_prefix = 'ak_';
				if ( isset( $term_meta['wp_meta'] ) && $term_meta['wp_meta'] ) {
					$meta_prefix = '';
				}

				if ( isset( $term_meta['key'] ) && isset( $term_meta['value'] ) ) {
					$tax_meta_value = parent::_filter_required_id( 'global', $term_meta['value'] );
					update_term_meta( $new_term_id, $meta_prefix . $term_meta['key'], $tax_meta_value );
				}
			}
		}

		do_action( 'ak-framework/demo/import/taxonomy/after', $new_term_id );

		return $new_term_id;
	}

	public static function remove( $taxonomy_id ) {
		return wp_delete_term( intval( $taxonomy_id ), self::get_taxonomy_by_term_id( intval( $taxonomy_id ) ) );
	}

	/**
	 * get term taxonomy by term ID.
	 *
	 * @param $term_id
	 *
	 * @global wpdb $wpdb WordPress database object
	 *
	 * @return bool|string not a empty string on success empty string or false otherwise.
	 */
	protected static function get_taxonomy_by_term_id( $term_id ) {
		global $wpdb;

		$taxonomy = ak_get_cache( $term_id, 'term-id-taxonomy' );

		if ( false === $taxonomy ) {
			$term     = get_term( $term_id );
			$taxonomy = $term->taxonomy;
			ak_set_cache( $term_id, $taxonomy, 'term-id-taxonomy' );
		}

		return $taxonomy;
	}
}
