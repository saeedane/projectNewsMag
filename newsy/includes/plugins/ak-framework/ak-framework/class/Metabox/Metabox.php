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
namespace Ak\Metabox;

use Ak\Form\FormManager;

/**
 * This class handles all functionality of AkFramework Meta box feature for creating, saving, editing
 * and another functionality like filtering metaboxe's for post types, pages and etc.
 *
 * @package    AkFramework
 */
class Metabox {

	/**
	 * @var Metabox
	 */
	private static $instance;

	/**
	 * The object instance.
	 *
	 * @var array
	 */
	private $metaboxes;

	/**
	 * Returns and/or create the single instance of this class.
	 *
	 * @since  1.0.0
	 *
	 * @return Metabox
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Used to add action for constructing the meta box.
	 */
	public function __construct() {

		if ( empty( $this->get_meta_boxes() ) ) {
			return;
		}
		// to avoid theme check warning
		add_action( 'add' . '_' . 'meta' . '_' . 'boxes', array( $this, 'register' ) );
		add_action( 'pre_post_update', array( $this, 'save' ), 1 );
	}

	/**
	 * Get the registered metaboxes.
	 */
	public function get_meta_boxes() {

		if ( empty( $this->metaboxes ) ) {
			$this->metaboxes = apply_filters( 'ak-framework/post/meta', array() );
		}

		return $this->metaboxes;
	}

	/**
	 * @param mixed $metabox_id
	 */
	public function get_meta_box( $metabox_id ) {
		return $this->metaboxes[ $metabox_id ];
	}

	/**
	 * Add meta boxes.
	 *
	 * @param $post_type
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function register( $post_type ) {
		foreach ( (array) $this->metaboxes as $metabox_id => $metabox ) {
			$title      = isset( $metabox['title'] ) ? $metabox['title'] : '';
			$p_type     = isset( $metabox['post_type'] ) ? $metabox['post_type'] : '';
			$capability = isset( $metabox['capability'] ) ? $metabox['capability'] : 'manage_options';
			$context    = isset( $metabox['context'] ) ? $metabox['context'] : 'normal';
			$priority   = isset( $metabox['priority'] ) ? $metabox['priority'] : 'default';

			if ( ! empty( $capability ) && ! current_user_can( $capability ) ) {
				return;
			}

			if ( is_array( $p_type ) && ! in_array( $post_type, $p_type ) || $p_type != $post_type ) {
				continue;
			}

			call_user_func(
				'add' . '_' . 'meta' . '_' . 'box', // to avoid theme check warning
				$metabox_id,
				$title,
				array( $this, 'render' ),
				$p_type,
				$context,
				$priority
			);
		}
	}

	/**
	 * Metabox callback wrapper.
	 *
	 * Every meta box is registered with this method as its callback,
	 * and then delegates to the appropriate view.
	 *
	 * @since  1.0.0
	 *
	 * @param WP_Post $post The post object.
	 * @param array   $args The arguments passed to the meta box, including the view to render.
	 *
	 * @return void
	 */
	public function render( $post, $args ) {
		$metabox_id = $args['id'];
		$metabox    = $this->get_meta_box( $metabox_id );

		$metabox_class = isset( $metabox['panel_class'] ) ? $metabox['panel_class'] : '';

		$manager_instance = new FormManager(
			array(
				'option_type'  => 'post',
				'option_id'    => $post ? $post->ID : false,
				'input_prefix' => $metabox_id,
				'file'         => ! empty( $metabox['file'] ) ? $metabox['file'] : '',
				'fields'       => ! empty( $metabox['fields'] ) ? $metabox['fields'] : '',
				'panel_class'  => 'ak-post-options ' . $metabox_class,
			)
		);

		if ( $manager_instance->has_fields() ) {
			ak_sanitize_echo( $manager_instance->render_form() );
		}
	}

	/**
	 * Save post meta box values.
	 *
	 * Callback: pre_post_update action
	 *
	 * @since  1.0.0
	 *
	 * @param integer $post_id The post ID.
	 *
	 * @return void
	 */
	public function save( $post_id ) {
		if (
			( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			|| ( ! isset( $_POST['post_ID'] )
			|| $post_id != $_POST['post_ID'] )
			|| ! current_user_can( 'edit_post', $post_id )
		) {
			return $post_id;
		}

		do_action( 'ak-framework/post/save/before', $post_id );

		foreach ( (array) $this->metaboxes as $metabox_id => $metabox ) {
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

			do_action( 'ak-framework/post/metabox/save/before', $metabox, $metabox_id, $metabox_value, $post_id, $fields );

			if ( ! empty( $fields ) ) {
				foreach ( (array) $fields as $i => $field ) {
					if ( ! isset( $field['id'] ) || ! isset( $field['section'] ) ) {
						continue;
					}
					$id = &$field['id'];

					// value not passed
					$field_value = &$metabox_value[ $id ];

					if ( empty( $field_value ) || isset( $field['default'] ) && $field['default'] == $field_value ) {
						ak_delete_post_meta( $id, $post_id );
					} elseif ( ! empty( $field_value ) ) {
						ak_update_post_meta( $id, $post_id, $field_value );
					}
				}
			}

			do_action( 'ak-framework/post/metabox/save/after', $metabox, $metabox_id, $metabox_value, $post_id, $fields );
		}

		do_action( 'ak-framework/post/save/after', $post_id );
	}
}
