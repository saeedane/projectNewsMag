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

namespace Ak\User;

use Ak\Form\FormManager;

/**
 * Manage all functionality for generating fields and retrieving fields data from them.
 */
class UserMeta {

	/**
	 * Contain all options that retrieved from ak-framework/user/meta and used for generating forms.
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
	 * @var UserMeta
	 */
	private static $instance;

	/**
	 * @return UserMeta
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	public function __construct() {
		self::$metaboxes = apply_filters( 'ak-framework/user/meta', array() );

		if ( empty( self::$metaboxes ) ) {
			return;
		}

		// Add options form
		add_action( 'show_user_profile', array( $this, 'register_metaboxes' ) );
		add_action( 'edit_user_profile', array( $this, 'register_metaboxes' ) );

		add_action( 'edit_user_profile_update', array( $this, 'save' ), 1 );
		add_action( 'personal_options_update', array( $this, 'save' ), 1 );
	}

	/**
	 * Register taxonomy fields.
	 *
	 * @param mixed $user
	 */
	public function register_metaboxes( $user ) {
		$output = '';

		foreach ( (array) self::$metaboxes as $metabox_id => $metabox ) {
			$manager_instance = new FormManager(
				array(
					'option_type'  => 'user',
					'option_id'    => $user ? $user->ID : false,
					'input_prefix' => $metabox_id,
					'file'         => ! empty( $metabox['file'] ) ? $metabox['file'] : '',
					'fields'       => ! empty( $metabox['fields'] ) ? $metabox['fields'] : '',
					'panel_class'  => 'ak-user-options ak-panel-menu-top',
				)
			);

			if ( $manager_instance ) {
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
		do_action( 'ak-framework/user/save/before', $term_id );

		foreach ( (array) self::$metaboxes as $metabox_id => $metabox ) {
			if ( ! isset( $_POST[ $metabox_id ] ) ) {
				continue;
			}

			$meta_value = &$_POST[ $metabox_id ];

			$manager = new FormManager(
				array(
					'prepare' => false,
					'file'    => ! empty( $metabox['file'] ) ? $metabox['file'] : '',
					'fields'  => ! empty( $metabox['fields'] ) ? $metabox['fields'] : '',
				)
			);

			$fields = $manager->get_fields();

			if ( ! empty( $fields ) ) {
				foreach ( (array) $fields as $field ) {
					if ( ! isset( $field['section'] ) ) {
						continue;
					}

					$id = &$field['id'];

					// value not passed
					if ( ! isset( $meta_value[ $id ] ) ) {
						continue;
					}

					$field_value = &$meta_value[ $id ];

					if ( empty( $field_value ) || isset( $field['default'] ) && $field['default'] == $field_value ) {
						ak_delete_user_meta( $id, $term_id );
					} elseif ( ! empty( $field_value ) ) {
						ak_update_user_meta( $id, $term_id, $field_value );
					}
				}
			}
		}

		do_action( 'ak-framework/user/save/after', $term_id );
	}
}
