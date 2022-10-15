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
 * Initialize custom functionality to VC.
 *
 * @package  ak-framework
 */
class FormVcExtender {

	/**
	 * Holds All supportted controls for VC.
	 *
	 * @since  1.0
	 *
	 * @var array
	 */
	public $vc_control_types = array(
		'visual_checkbox',
		'visual_select',
		'radio_image',
		'radio_button',
		'radio_icon',
		'text',
		'number',
		'textarea',
		'select',
		'slider',
		'slider_unit',
		'switcher',
		'color',
		'icon_select',
		'ajax_select',
		'background_image',
		'media_image',
		'heading',
		'info',
		'mix_fields',
	);

	public $shortcode_add_func = 'vc_add' . '_' . 'shortcode' . '_' . 'param';

	/**
	 * @var FormVcExtender
	 */
	private static $instance;

	/**
	 * @return FormVcExtender
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	public function __construct() {
		// Check if Visual Composer is installed
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			return;
		}

		add_filter( 'ak-framework/vc-fields', array( $this, 'prepare_fields' ), 11, 2 );

		add_action( 'vc_before_init', array( $this, 'register_fields' ) );
		add_action( 'vc_backend_editor_enqueue_js_css', array( $this, 'enqueue' ) );
		add_action( 'vc_frontend_editor_enqueue_js_css', array( $this, 'enqueue' ) );
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		FormManager::enqueue_controls( $this->vc_control_types );
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function register_fields() {
		if ( ! function_exists( $this->shortcode_add_func ) ) {
			return;
		}

		foreach ( $this->vc_control_types as $type ) {
			call_user_func( $this->shortcode_add_func, 'ak_vc_' . $type, array( $this, 'load_field' ) );
		}
	}

	/**
	 * Convert VC Field option to an BF Field Option.
	 *
	 * @param $settings
	 * @param $value
	 *
	 * @return array
	 */
	private function prepare_field( $settings, $value ) {
		$settings['value']                = $value;
		$settings['id']                   = $settings['param_name'];
		$settings['input_attrs']['class'] = 'ak_vc_input wpb_vc_param_value wpb-' . esc_attr( $settings['type'] ) . ' ' . esc_attr( $settings['param_name'] ) . ' ' . esc_attr( $settings['param_name'] ) . '_field  ' . esc_attr( $settings['type'] );
		$settings['type']                 = str_replace( 'ak_vc_', '', $settings['type'] );

		if ( 'mix_fields' === $settings['type'] ) {
			$settings['return_string'] = true;
		}

		if ( ! empty( $settings['input_desc'] ) && empty( $settings['description'] ) ) {
			$settings['description'] = $settings['input_desc'];
		}

		$settings['vc_field'] = true;

		return apply_filters( 'ak-framework/vc-fields/field/args', $settings );
	}

	/**
	 * Adds fields to Visual Composer.
	 *
	 * @param $settings
	 * @param $value
	 *
	 * @return string
	 */
	public function load_field( $settings, $value ) {
		$settings = $this->prepare_field( $settings, $value );

		return FormBuilder::render_field( $settings, true );
	}

	/**
	 * Prepare all fields for Visual Composer.
	 *
	 * @param array $fields
	 *
	 * @return array
	 */
	public function prepare_fields( $fields = array() ) {
		if ( ! empty( $fields ) ) {
			foreach ( $fields as $i => $field ) {
				if ( ! isset( $field['type'] ) || ! in_array( $field['type'], $this->vc_control_types, true ) && 'css_editor' !== $field['type'] ) {
					unset( $fields[ $i ] );
					continue;
				}

				$type = &$field['type'];
				$id   = &$field['id'];

				$fields[ $i ]['param_name'] = $id;

				if ( 'css_editor' === $type ) {
					$fields[ $i ]['type'] = 'css_editor';
				} elseif ( 'group_start' === $type ) {
					$fields[ $i ]['type'] = 'heading';
				} else {
					$fields[ $i ]['type'] = 'ak_vc_' . $type;
				}

				$fields[ $i ]['group'] = $field['section'];

				if ( isset( $field['default'] ) ) {
					$fields[ $i ]['value'] = $field['default'];
				}

				unset( $fields[ $i ]['id'], $fields[ $i ]['default'], $fields[ $i ]['section'] );
			}
		}

		return $fields;
	}
}
