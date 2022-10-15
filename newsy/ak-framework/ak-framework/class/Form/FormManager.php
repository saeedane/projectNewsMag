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

use Ak\Util\Arr;

/**
 * Class Form Manager.
 *
 * @package  ak-framework
 */
class FormManager {

	/**
	 * Holds All Controls with class path.
	 *
	 * @since  1.0
	 *
	 * @var array
	 */
	private static $controls = array();

	/**
	 * Holds default supported controls.
	 *
	 * @since  1.0
	 *
	 * @var array
	 */
	public static $available_controls = array(
		'text',
		'number',
		'textarea',
		'wp_editor',
		'code',
		'color',
		'date',
		'slider',
		'slider_unit',
		'radio',
		'radio_image',
		'radio_button',
		'radio_icon',
		'switcher',
		'sorter',
		'repeater',
		'checkbox',
		'select',
		'visual_checkbox',
		'visual_select',
		'icon_select',
		'ajax_select',
		'media',
		'media_image',
		'background_image',
		'mix_fields',
		'typography',
		'css_editor',
		'custom_field',
		'heading',
		'info',
		'group_start',
		'group_end',
	);

	/**
	 * Holds all supported sections.
	 *
	 * @since  1.0
	 *
	 * @var array
	 */
	public $available_sections = array(
		'section_link',
		'section_separator',
		'section',
	);

	/**
	 * Holds all form args.
	 *
	 * @since  1.0
	 *
	 * @var array
	 */
	protected $args = array();

	/**
	 * Holds all form fields.
	 *
	 * @since  1.0
	 *
	 * @var array
	 */
	protected $fields = array();

	/**
	 * Holds all form sections.
	 *
	 * @since  1.0
	 *
	 * @var array
	 */
	protected $sections = array();

	/**
	 * Holds all form css outputs.
	 *
	 * @since  1.0
	 *
	 * @var array
	 */
	protected $outputs = array();

	/**
	 * @param array $args
	 */
	public function __construct( $args = array() ) {
		$defaults = array(
			'option_type'    => 'option',
			'option_id'      => false,
			'input_prefix'   => '',
			'prepare'        => true,
			'prepare_output' => false,
			'get_value'      => true,
			'values'         => array(),
			'defaults'       => array(),
			'fields'         => array(),
			'file'           => '', // fields file
			'panel_id'       => '',
			'panel_class'    => '',
		);

		$this->args = apply_filters( 'ak-framework/form/args', wp_parse_args( $args, $defaults ) );

		$this->register_fields();

		if ( $this->args['prepare'] ) {
			$this->prepare_fields();
		}
	}

	/**
	 * Get form args.
	 *
	 * @return array $args
	 */
	public function get_args() {
		return $this->args;
	}

	/**
	 * loads and returns form fields.
	 *
	 * @return void
	 */
	public function register_fields() {
		if ( ! empty( $this->fields ) ) {
			return;
		}

		$fields = ak_resolve_form_fields( $this->args );

		foreach ( (array) $fields as $f_args ) {
			// if panel field exits then add as section
			if (
			isset( $f_args['type'] )
			&& 'section' === $f_args['type']
			&& isset( $f_args['file'] )
			&& file_exists( $f_args['file'] )
			) {
				include $f_args['file'];
			}
		}

		$this->fields = $fields;
	}

	/**
	 * Prepare fields for final render.
	 *
	 * @return void
	 */
	public function prepare_fields() {
		if ( empty( $this->fields ) ) {
			return;
		}

		foreach ( $this->fields as $idx => $field ) {
			//detect missing conf
			if ( ! isset( $field['id'] ) || ! isset( $field['type'] ) ) {
				unset( $this->fields[ $idx ] );
				continue;
			}
			$id = $field['id'];

			if ( $this->is_control_exist( $field['type'] ) ) {
				$field['param_name'] = $id;
				$field['id']         = $this->refactor_id( $id );
				$field['_id']        = $this->serialize_id( $field['id'] );
				$field['default']    = $this->get_default( $field );
				$field['value']      = $this->get_sanitized_value( $field );

				if ( isset( $field['dependency'] ) ) {
					$field['dependency']['element'] = $this->refactor_id( $field['dependency']['element'] );
				}

				// refactor partial_refresh
				if ( isset( $field['presets'] ) ) {
					$presets = array();

					foreach ( $field['presets'] as $preset_id => $preset_args ) {
						foreach ( $preset_args as $pr_id => $pr_args ) {
							$pr_id = $this->refactor_id( $pr_id );

							$presets[ $preset_id ][ $pr_id ] = $pr_args;
						}
					}

					$field['presets'] = $presets;

					unset( $presets );
				}

				if ( $this->args['prepare_output'] ) {
					$this->add_output( $field );
				}

				$this->fields[ $field['id'] ] = $field;
			} elseif ( in_array( $field['type'], $this->available_sections, true ) ) {
				$this->sections[ $field['id'] ] = $field;
			}

			unset( $this->fields[ $idx ] );
		}

		//if there is no sections added then filter by group for vc fields
		if ( empty( $this->sections ) ) {
			foreach ( $this->fields as $field ) {
				if ( isset( $field['section'] ) ) {
					$group = $field['section'];

					if ( empty( $this->sections[ $group ] ) ) {
						$this->sections[ $group ] = array(
							'id'      => $group,
							'heading' => $group,
							'type'    => 'section',
						);
					}
				}
			}
		}
	}

	/**
	 * Get all sections that prepared.
	 *
	 * @return array
	 */
	public function get_sections() {
		return $this->sections;
	}

	/**
	 * Get Section's Params.
	 *
	 * @return array
	 */
	public function get_section( $id ) {
		if ( isset( $this->sections ) ) {
			return $this->sections[ $id ];
		}

		return false;
	}

	/**
	 * Filter section fields from fields array.
	 *
	 * @param $section_id
	 *
	 * @return array
	 */
	public function get_section_fields( $section_id ) {
		return ak_array_find_all_by_value( $this->fields, 'section', $section_id );
	}

	/**
	 * Get all fields that prepared.
	 *
	 * @return array
	 */
	public function get_fields() {
		return $this->fields;
	}

	/**
	 * Check the fields exits or not.
	 *
	 * @return bool
	 */
	public function has_fields() {
		return ! empty( $this->fields );
	}

	/**
	 * Get Field's Params.
	 *
	 * @param $id
	 *
	 * @return bool|mixed
	 */
	public function get_field( $id ) {
		if ( isset( $this->fields ) ) {
			return $this->fields[ $id ];
		}

		return false;
	}

	/**
	 * Get all outputs.
	 *
	 * @return array
	 */
	public function get_outputs() {
		return $this->outputs;
	}

	/**
	 * Get all outputs.
	 *
	 * @return array
	 */
	public function add_output( $field ) {
		if ( ! isset( $field['output'] ) ) {
			return;
		}

		if ( 'mix_fields' === $field['type'] ) {
			// Process options_callback.
			if ( ! empty( $field['fields_callback'] ) ) {
				$mix_fields = ak_fields_callback( $field['fields_callback'] );
			} else {
				$mix_fields = $field['fields'];
			}

			foreach ( $mix_fields as $mix_field ) {
				$id                   = $mix_field['id'];
				$mix_field['id']      = $field['id'] . '[' . $id . ']';
				$mix_field['value']   = isset( $field['value'][ $id ] ) ? $field['value'][ $id ] : '';
				$mix_field['default'] = isset( $field['default'][ $id ] ) ? $field['default'][ $id ] : '';
				$this->add_output( $mix_field );
			}
			return;
		}

		if ( Arr::compare( $field['value'], $field['default'], 'equals' ) || ! $this->is_field_active( $field ) ) {
			return;
		}

		$outputs = $field['output'];

		$outputs = array_filter(
			$outputs, function ( $output ) {
				return isset( $output['type'] ) && 'css' === $output['type'];
			}
		);

		array_walk(
			$outputs, function ( &$output ) use ( $field ) {
				$output['value']   = $field['value'];
				$output['default'] = $field['default'];
			}
		);

		if ( ! empty( $outputs ) ) {
			$this->outputs[ $field['id'] ] = $outputs;
		}
	}

	/**
	 * Get all active outputs.
	 *
	 * @return array
	 */
	public function get_active_outputs( $check_global_flag = false ) {
		foreach ( $this->outputs as $id => $outputs ) {
			if ( $check_global_flag ) {
				$outputs = array_filter(
					$outputs, function ( $output ) {
						return isset( $output['global_output'] ) && $output['global_output'];
					}
				);
			}

			if ( ! empty( $outputs ) ) {
				$this->outputs[ $id ] = $outputs;
			}
		}

		return $this->outputs;
	}

	/**
	 * Given field is active or not?
	 *
	 * @param array $field
	 *
	 * @return bool
	 */
	public function is_field_active( $field ) {
		$is_active = true;
		if ( isset( $field['dependency'] ) && isset( $field['dependency']['element'] ) ) {
			$dependency  = $field['dependency'];
			$element     = $dependency['element'];
			$element_val = $this->fields[ $element ]['value'];
			$operator    = isset( $dependency['operator'] ) ? $dependency['operator'] : 'in';

			$is_active = Arr::compare( $dependency['value'], $element_val, $operator );
		}

		return $is_active;
	}

	/**
	 * Return Panel.
	 *
	 * @return string
	 */
	public function render_form() {
		$builder = new FormBuilder;

		return $builder->render( $this );
	}

	/**
	 * Get all supported controls.
	 *
	 * Filter: ak-framework/form/controls Add additional control types.
	 *
	 * @return array
	 */
	public static function get_controls() {
		if ( empty( self::$controls ) ) {
			$controls = array();

			foreach ( self::$available_controls as $type ) {
				$class_name = str_replace( '_', ' ', $type );
				$class_name = ucwords( $class_name );
				$class_name = str_replace( ' ', '', $class_name );

				$controls[ $type ] = 'Ak\\Form\\Control\\' . $class_name;
			}

			// Register additional controls
			self::$controls = apply_filters( 'ak-framework/form/controls', $controls );
		}

		return self::$controls;
	}

	/**
	 * Get control.
	 *
	 * @return mixed
	 */
	public static function get_control( $type ) {
		$controls = self::get_controls();

		if ( isset( $controls[ $type ] ) ) {
			return $controls[ $type ];
		}

		return false;
	}

	/**
	 * Is controls exist.
	 *
	 * @return bool
	 */
	public static function is_control_exist( $type ) {
		$controls = self::get_controls();

		return array_key_exists( $type, $controls );
	}

	/**
	 * Get Control's instance.
	 *
	 * @return mixed
	 */
	public static function get_control_instance( $type, $args = array() ) {
		$control_class = self::get_control( $type );

		if ( $control_class && class_exists( $control_class ) ) {
			return new $control_class( $args );
		}

		return false;
	}

	/**
	 * Get Field's instance.
	 *
	 * @return mixed
	 */
	public static function get_field_control_instance( $field ) {
		return self::get_control_instance( $field['type'], $field );
	}

	/**
	 * Enqueue Control's assets.
	 *
	 * @return void
	 */
	public static function enqueue_control( $type ) {
		$control_instance = self::get_control_instance( $type );

		if ( $control_instance ) {
			$control_instance->enqueue_scripts();
		}
	}

	/**
	 * Enqueue Controls assets.
	 *
	 * @return void
	 */
	public static function enqueue_controls( $types = array() ) {
		if ( empty( $types ) ) {
			$types = array_keys( self::get_controls() );
		}

		foreach ( $types as $type ) {
			self::enqueue_control( $type );
		}
	}

	/**
	 * Get sanitized value of field.
	 *
	 * @param mixed $field         Field
	 *
	 * @return mixed
	 */
	public function get_sanitized_value( $field ) {
		$sanitizer = FormSanitizer::get_instance()->sanitize_handler( $field['type'] );

		// do not save value
		if ( isset( $field['exclude_value'] ) ) {
			return '';
		}

		$value = $this->get_value( $field['param_name'], isset( $field['wp_field'] ) );

		// custom sanitize or disable sanitize
		if ( isset( $field['sanitize_callback'] ) ) {
			if ( false === $field['sanitize_callback'] ) {
				return $value;
			}

			$sanitizer = $field['sanitize_callback'];
		}

		return ! empty( $value ) ? ak_call_func( $sanitizer, $value ) : $field['default'];
	}

	/**
	 * Get value of field.
	 *
	 * @param mixed $param_name Field param name
	 * @param bool $wp_field    Wp option
	 *
	 * @return mixed
	 */
	public function get_value( $param_name, $wp_field = false ) {
		// is get_value active?
		if ( ! $this->args['get_value'] ) {
			return '';
		}

		$value = '';

		if ( strpos( $param_name, '[' ) !== false ) {
			$element    = explode( '[', $param_name );
			$param_name = $element[0];
		}

		// already value specified
		if ( ! empty( $this->args['values'] ) && is_array( $this->args['values'] ) ) {
			$value = ! empty( $this->args['values'][ $param_name ] ) ? $this->args['values'][ $param_name ] : '';
		} else {
			$option_type = $this->args['option_type'];
			$option_id   = $this->args['option_id'];

			if ( ! empty( $option_type ) && ! empty( $option_id ) && false !== $option_id ) {
				switch ( $option_type ) {
					case ( 'option' ):
						$value = ak_get_option( $option_id, $param_name );
						break;
					case ( 'post' ):
						$value = ak_get_post_meta( $param_name, $option_id, null, $wp_field );
						break;
					case ( 'user' ):
						$value = ak_get_user_meta( $param_name, $option_id, null, $wp_field );
						break;
					case ( 'taxonomy' ):
						$value = ak_get_term_meta( $param_name, $option_id, null, $wp_field );
						break;
				}
			}
		}

		// @todo: is that needed?
		if ( strpos( $param_name, '[' ) !== false ) {
			if ( count( $element ) === 3 ) {
				$option_key   = rtrim( $element[1], ']' );
				$option_array = rtrim( $element[2], ']' );

				$value = isset( $value[ $option_key ][ $option_array ] ) ? $value[ $option_key ][ $option_array ] : '';
			} elseif ( count( $element ) === 2 ) {
				$option_key = rtrim( $element[1], ']' );

				$value = isset( $value[ $option_key ] ) ? $value[ $option_key ] : '';
			}
		}

		return $value;
	}

	/**
	 * Refactor default for form.
	 *
	 * @param $id
	 *
	 * @return string
	 */
	private function get_default( $field ) {
		$default = isset( $field['default'] ) ? $field['default'] : '';

		if ( ! empty( $default ) ) {
			return $default;
		}

		$param_name = $field['param_name'];

		return isset( $this->args['defaults'][ $param_name ] ) ? $this->args['defaults'][ $param_name ] : '';
	}

	/**
	 * Refactor id for form.
	 *
	 * @param $id
	 *
	 * @return string
	 */
	private function refactor_id( $id ) {
		if ( ! isset( $this->args['input_prefix'] ) || empty( $this->args['input_prefix'] ) ) {
			return $id;
		}

		if ( strpos( $id, '[' ) !== false ) {
			$element = explode( '[', $id );

			$element_first = '[' . $element[0] . ']';

			$element_rest = str_replace( $element[0], '', $id );

			$new_id = $element_first . $element_rest;
		} else {
			$new_id = '[' . $id . ']';
		}

		return $this->args['input_prefix'] . $new_id;
	}

	/**
	 * Serialize id for form.
	 *
	 * @param $id
	 *
	 * @return string
	 */
	private function serialize_id( $id ) {
		return trim( str_replace( array( '[', ']' ), array( '_', '' ), $id ), '_' );
	}

	/**
	 * Filter value if default
	 *
	 * @return array
	 */
	public function filter_default_value( $field ) {
		if ( empty( $field['value'] ) || empty( $field['default'] ) || isset( $field['filter_default'] ) && false === $field['filter_default'] ) {
			return $field['value'];
		}

		return Arr::equal( $field['value'], $field['default'] ) ? '' : $field['value'];
	}

	/**
	 * Get prepared options for save.
	 *
	 * @return array
	 */
	public function prepare_form_fields_for_save( $options ) {
		$fields = $this->get_fields();

		if ( ! empty( $fields ) ) {
			foreach ( $fields as $field ) {
				$param_name = $field['param_name'];

				// isset the value is exists on comming opttions
				if ( isset( $options[ $param_name ] ) ) {
					// set new value
					$field['value'] = $options[ $param_name ];
				}

				// remove options if value is default
				$options[ $param_name ] = $this->filter_default_value( $field );
			}
		}

		$options = ak_array_filter_empty_fields( $options );

		return $options;
	}
}
