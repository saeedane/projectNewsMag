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

namespace Ak\Taxonomy;

use Ak\Util\Arr;
use Ak\Form\FormManager;

/**
 * Manage all functionality for generating fields and retrieving fields data from them.
 */
class TaxonomyMeta {

	/**
	 * Contain all options that retrieved from ak-framework/taxonomy/options and used for generating forms.
	 *
	 * @var array
	 */
	public static $metaboxes = array();

	/**
	 * Contains all sections.
	 *
	 * @var array
	 */
	public static $fields = array();

	/**
	 * Contains all sections.
	 *
	 * @var array
	 */
	public static $term_tax = false;

	/**
	 * Contains all sections.
	 *
	 * @var array
	 */
	public static $term_id = 0;

	/**
	 * Contains all sections.
	 *
	 * @var array
	 */
	public $panel_wrap = array();

	/**
	 * @var TaxonomyMeta
	 */
	private static $instance;

	/**
	 * @return TaxonomyMeta
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 *
	 */
	public function __construct() {
		if ( empty( $this->get_taxonomy_meta() ) ) {
			return;
		}

		add_action( 'admin_init', array( $this, 'register' ) );
	}

	/**
	 * Register taxonomy fields.
	 */
	public function get_taxonomy_meta() {
		if ( empty( self::$metaboxes ) ) {
			self::$metaboxes = apply_filters( 'ak-framework/taxonomy/meta', array() );
		}

		return self::$metaboxes;
	}


	/**
	 * Register taxonomy fields.
	 */
	public function register() {
		foreach ( self::$metaboxes as $metabox ) {
			$term_tax = &$metabox['taxonomy'];

			if ( is_array( $term_tax ) ) {
				foreach ( $term_tax as $_term_tax ) {
					$this->register_taxonomy_hooks( $_term_tax );
				}
			} else {
				$this->register_taxonomy_hooks( $term_tax );
			}
		}

		add_action( 'delete_term', array( $this, 'delete' ), 10, 2 );
	}

	/**
	 * Register taxonomy fields.
	 */
	public function register_taxonomy_hooks( $term_tax ) {
		add_action( "{$term_tax}_add_form_fields", array( $this, 'render' ), 10, 2 );
		add_action( "{$term_tax}_edit_form", array( $this, 'render' ), 10, 2 );

		add_action( "create_{$term_tax}", array( $this, 'save' ) );
		add_action( "edited_{$term_tax}", array( $this, 'save' ) );
	}

	/**
		 * Adds fields to add and edit form in Taxonomy admin form.
		 *
		 * @param null
		 * @param mixed|null $term
		 */
	public function render( $term = null ) {
		if ( is_object( $term ) ) {
			$term_id  = $term->term_id;
			$term_tax = $term->taxonomy;
		} else {
			$term_id  = false;
			$term_tax = $term;
		}

		$metaboxes = ak_array_find_all_by_value( self::$metaboxes, 'taxonomy', $term_tax );

		$output = '';
		foreach ( (array) $metaboxes as $metabox_id => $metabox ) {
			$manager_instance = new FormManager(
				array(
					'option_type'  => 'taxonomy',
					'option_id'    => $term_id,
					'prepare'      => true,
					'input_prefix' => $metabox_id,
					'file'         => ! empty( $metabox['file'] ) ? $metabox['file'] : '',
					'fields'       => ! empty( $metabox['fields'] ) ? $metabox['fields'] : '',
					'panel_class'  => 'ak-taxonomy-options ak-panel-menu-top',
				)
			);

			if ( $manager_instance->has_fields() ) {
				$output .= $manager_instance->render_form();
			}
		}

		ak_sanitize_echo( $output );
	}

	/**
	 * Save taxonomy custom options as an option.
	 *
	 * @param $term_id
	 */
	public function save( $term_id ) {
		do_action( 'ak-framework/taxonomy/save/before', $term_id );

		foreach ( (array) self::$metaboxes as $metabox_id => $metabox ) {
			if ( ! isset( $_POST[ $metabox_id ] ) ) {
				continue;
			}

			$metabox_value = &$_POST[ $metabox_id ];

			$manager = new FormManager(
				array(
					'prepare' => false,
					'file'    => ! empty( $metabox['file'] ) ? $metabox['file'] : '',
					'fields'  => ! empty( $metabox['fields'] ) ? $metabox['fields'] : '',
				)
			);

			$fields = $manager->get_fields();

			do_action( 'ak-framework/taxonomy/metabox/save/before', $metabox, $metabox_id, $metabox_value, $term_id, $fields );

			if ( ! empty( $fields ) ) {
				foreach ( (array) $fields as $field ) {
					if ( ! isset( $field['id'] ) || ! isset( $field['section'] ) ) {
						continue;
					}
					$id = &$field['id'];

					// value not passed
					if ( ! isset( $metabox_value[ $id ] ) ) {
						continue;
					}

					$field_value = &$metabox_value[ $id ];

					if ( is_array( $field_value ) ) {
						$field_value = ak_array_filter_empty_fields( $field_value );
					}

					$is_in = ! empty( $field['default'] ) && Arr::compare( $field['default'], $field_value, 'in' );

					if ( empty( $field_value ) || $is_in ) {
						ak_delete_term_meta( $id, $term_id );
					} elseif ( ! empty( $field_value ) ) {
						ak_update_term_meta( $id, $term_id, $field_value );
					}
				}
			}

			do_action( 'ak-framework/taxonomy/metabox/save/after', $metabox, $metabox_id, $metabox_value, $term_id, $fields );
		}

		do_action( 'ak-framework/taxonomy/save/after', $term_id );
	}

	/**
	 * Delete taxonomy option from option table.
	 *
	 * @param $term
	 * @param $term_id
	 */
	public static function delete( $term, $term_id ) {
		$all_meta = get_term_meta( '', $term_id );
		if ( $all_meta ) {
			foreach ( $all_meta as $meta_key => $meta_value ) {
				delete_term_meta( $term_id, $meta_key );
			}
		}
	}

	/**
	 * Get Product Pages by Global Css if exist.
	 *
	 * @return array
	 */
	public function get_global_css_panels() {
		$taxonomy_metaboxes = $this->get_taxonomy_meta();

		return ak_array_find_all_by_value( $taxonomy_metaboxes, 'global_css', true );
	}
}
