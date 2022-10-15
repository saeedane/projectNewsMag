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

namespace Ak\Customizer;

use Ak\Util\Arr;

/**
 * Customizer Manager Class.
 */
class CustomizerManager {
	/**
	 * An array containing customizer registers.
	 *
	 * @var array
	 */
	public $customizer = array();

	/**
	 * An array containing current config flag.
	 *
	 * @var array
	 */
	public $config = array();

	/**
	 * An array containing all panels.
	 *
	 * @var array
	 */
	public $configs = array();

	/**
	 * An array containing all panels.
	 *
	 * @var array
	 */
	public $panels = array();

	/**
	 * An array containing all sections.
	 *
	 * @var array
	 */
	public $sections = array();

	/**
	 * An array containing all fields.
	 *
	 * @var array
	 */
	public $fields = array();

	/**
	 * An array containing all post message.
	 *
	 * @var array
	 */
	public $js_vars = array();

	/**
	 * An array containing all style output.
	 *
	 * @var array
	 */
	public $outputs = array();

	/**
	 * An array containing all style output.
	 *
	 * @var array
	 */
	public $settings = array();

	/**
	 * An array containing active callback.
	 *
	 * @var array
	 */
	public $active_callbacks = array();

	/**
	 * @var CustomizerManager
	 */
	private static $instance;

	/**
	 * @return CustomizerManager
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Register all registered field.
	 */
	public function __construct() {
		$this->customizer = apply_filters( 'ak-framework/customizer', array() );

		if ( ! empty( $this->customizer ) ) {
			$this->register_customizer_fields();
		}
	}

	/**
	 * Register all registered field.
	 */
	private function register_customizer_fields() {
		foreach ( $this->customizer as $customizer_id => $customizer_args ) {
			if ( empty( $customizer_id ) ) {
				continue;
			}

			$this->add_config( $customizer_id, $customizer_args );

			$this->config = $customizer_args;

			if ( ! isset( $customizer_args['fields'] ) && ! isset( $customizer_args['file'] ) ) {
				continue;
			}

			$fields = array();

			if ( isset( $customizer_args['fields'] ) ) {
				$fields = &$customizer_args['fields'];
			} elseif ( isset( $customizer_args['file'] ) && is_file( $customizer_args['file'] ) && file_exists( $customizer_args['file'] ) ) {
				include $customizer_args['file'];
			}

			$fields = apply_filters( 'ak-framework/customizer/fields', $fields, $customizer_id );

			if ( ! is_array( $fields ) || empty( $fields ) ) {
				continue;
			}

			$this->register_fields_one( $fields );
		}
	}

	private function register_fields_one( $fields ) {
		foreach ( $fields as $field ) {
			if ( isset( $field['panel'] ) ) {
				// if panel field exits then add as section
				$this->add_section( $field );
			} elseif ( isset( $field['section'] ) ) {
				// if section field exits then add as field
				$this->add_field( $field );
			} else {
				$this->add_panel( $field );
			}
		}
	}

	private function register_fields_two( $fields ) {
		$group_started = '';
		foreach ( $fields as $field ) {
			if ( $field['type'] === 'section' ) {
				$this->add_panel( $field );
			} elseif ( $field['type'] === 'group_start' ) {
				// if panel variable exits then add as section
				$group_started = $field['id'];
				$this->add_section( $field );
			} elseif ( isset( $field['section'] ) ) {
				// if section variable exits then add as field
				$field['section'] = $group_started;
				$this->add_field( $field );
			} else {
				$this->add_panel( $field );
			}
		}
	}
	/**
	 * Register fields from the file we specified.
	 *
	 * @param string $file
	 * @return void
	 */
	private function register_fields_from_file( $args, $type ) {
		//add fields from file
		$fields = array();
		if ( is_file( $args['file'] ) && file_exists( $args['file'] ) ) {
			include $args['file'];
		}
		foreach ( $fields as $field_args ) {
			// assign panel if not exists
			if ( ! isset( $field_args['panel'] ) ) {
				$field_args['panel'] = $args['id'];
			}
			if ( 'panel' === $type ) {
				$this->add_section( $field_args );
			} else {
				$this->add_field( $field_args );
			}
		}
	}

	/**
	 * Sets the configuration options.
	 *
	 * @param $args array
	 */
	public function add_config( $id, $args ) {
		if ( ! isset( $id ) || isset( $this->configs[ $id ] ) ) {
			return;
		}

		$args['id']          = esc_attr( $id );
		$args['capability']  = isset( $args['capability'] ) ? $args['capability'] : 'edit_theme_options';
		$args['option_type'] = ( isset( $args['option_type'] ) ) ? $args['option_type'] : 'theme_mod';
		$args['option_name'] = ( isset( $args['option_name'] ) ) ? $args['option_name'] : '';

		$this->configs[ $id ] = $args;
	}

	/**
	 * Get all configs.
	 *
	 * @return array
	 */
	public function get_configs() {
		return $this->configs;
	}

	/**
	 * Get the config.
	 *
	 * @return array|bool
	 */
	public function get_config( $id ) {
		if ( ! isset( $this->configs[ $id ] ) ) {
			return false;
		}

		return $this->configs[ $id ];
	}

	/**
	 * Add panel.
	 *
	 * @param $args array
	 */
	public function add_panel( $args ) {
		$args = apply_filters( 'ak-framework/customizer/panel/before', $args );

		if ( ! isset( $args['id'] ) || isset( $this->panels[ $args['id'] ] ) ) {
			return;
		}
		$id                  = esc_attr( $args['id'] );
		$args['id']          = $id;
		$heading             = isset( $args['heading'] ) ? $args['heading'] : '';
		$args['title']       = isset( $args['title'] ) ? $args['title'] : $heading;
		$args['description'] = isset( $args['description'] ) ? $args['description'] : '';
		$args['priority']    = isset( $args['priority'] ) ? absint( $args['priority'] ) : 10;
		$args['type']        = isset( $args['type'] ) ? $args['type'] : '';
		//refactor active_callback
		$args['active_callback'] = $this->add_active_callback( $args );

		$this->panels[ $id ] = $args;

		// add fields from file
		if ( isset( $args['file'] ) ) {
			$this->register_fields_from_file( $args, 'panel' );
		}
	}

	/**
	 * Get all panels.
	 *
	 * @return array
	 */
	public function get_panels() {
		return apply_filters( 'ak-framework/customizer/panels/registered', $this->panels );
	}

	/**
	 * Get the panel.
	 *
	 * @return array|bool
	 */
	public function get_panel( $id ) {
		$panels = $this->get_panels();
		if ( array_key_exists( $id, $panels ) ) {
			return $panels[ $id ];
		}

		return false;
	}

	/**
	 * Add Section.
	 *
	 * @param $args array
	 */
	public function add_section( $args ) {
		$args = apply_filters( 'ak-framework/customizer/section/before', $args );

		if ( ! isset( $args['id'] ) || isset( $this->sections[ $args['id'] ] ) ) {
			return;
		}

		$id                      = esc_attr( $args['id'] );
		$args['id']              = $id;
		$heading                 = isset( $args['heading'] ) ? $args['heading'] : '';
		$args['title']           = isset( $args['title'] ) ? $args['title'] : $heading;
		$args['panel']           = ( isset( $args['panel'] ) ) ? esc_attr( $args['panel'] ) : '';
		$args['description']     = ( isset( $args['description'] ) ) ? $args['description'] : '';
		$args['priority']        = ( isset( $args['priority'] ) ) ? absint( $args['priority'] ) : 10;
		$args['type']            = ( isset( $args['section_type'] ) ) ? $args['section_type'] : '';
		$args['active_callback'] = $this->add_active_callback( $args );

		$this->sections[ $id ] = $args;

		// add fields from file
		if ( isset( $args['file'] ) ) {
			$this->register_fields_from_file( $args, 'section' );
		}
	}

	/**
	 * Get all sections.
	 *
	 * @return array
	 */
	public function get_sections() {
		return apply_filters( 'ak-framework/customizer/sections/registered', $this->sections );
	}

	/**
	 * Get the section.
	 *
	 * @param integer $id Section ID
	 * @return array|bool
	 */
	public function get_section( $id ) {
		$sections = $this->get_sections();
		if ( array_key_exists( $id, $sections ) ) {
			return $sections[ $id ];
		}

		return false;
	}

	/**
	 * Add field.
	 *
	 * @param $args
	 * @return void
	 */
	public function add_field( $args ) {
		$args = apply_filters( 'ak-framework/customizer/field/before', $args );

		if ( ! isset( $args['id'] ) || ! isset( $args['type'] ) || ! isset( $args['section'] ) ) {
			return;
		}

		$args['param_name'] = $args['id'];

		$id   = $this->refactor_id( esc_attr( $args['id'] ) );
		$type = isset( $this->config['option_type'] ) ? $this->config['option_type'] : 'theme_mod';

		$args['id'] = $id;

		$args['default'] = isset( $args['default'] ) ? $args['default'] : '';

		$args['option_type'] = $type;

		if ( ! empty( $args['js_vars'] ) ) {
			$this->js_vars[ $id ] = $args['js_vars'];
		}

		if ( ! empty( $args['output'] ) ) {
			$this->outputs[ $id ] = $args['output'];
		}

		//refactor active_callback
		$args['active_callback'] = $this->add_active_callback( $args );

		//refactor partial_refresh
		if ( ! empty( $args['partial_refresh'] ) ) {
			$partial_refresh = array();

			foreach ( $args['partial_refresh'] as $partial_id => $partial_args ) {
				$partial_id = $this->refactor_id( $partial_id );

				$partial_refresh[ $partial_id ] = $partial_args;
			}

			$args['partial_refresh'] = $partial_refresh;
		}

		//refactor presets
		if ( isset( $args['presets'] ) ) {
			$presets = array();

			foreach ( $args['presets'] as $preset_id => $preset_args ) {
				foreach ( $preset_args as $pr_id => $pr_args ) {
					$pr_id                           = $this->refactor_id( $pr_id );
					$presets[ $preset_id ][ $pr_id ] = $pr_args;
				}
			}

			$args['presets'] = $presets;
		}

		$heading                 = isset( $args['heading'] ) ? $args['heading'] : '';
		$args['label']           = isset( $args['label'] ) ? $args['label'] : $heading;
		$args['description']     = isset( $args['description'] ) ? $args['description'] : '';
		$args['container_class'] = isset( $args['container_class'] ) ? $args['container_class'] : '';

		if ( 'group_start' === $args['type'] ) {
			$args['type'] = 'heading';
		}

		$this->fields[ $id ] = $args;
	}

	/**
	 * Add the active callback.
	 *
	 * @return string
	 */
	public function add_active_callback( $field_args ) {
		$callbacks = array();
		$id        = $field_args['id'];

		if ( isset( $field_args['active_callback'] ) ) {
			$callbacks = $field_args['active_callback'];
		} elseif ( isset( $field_args['dependency'] ) ) { //theme options compatibility
			$dependency = $field_args['dependency'];

			if ( isset( $dependency['element'] ) ) { // if single
				$callbacks[] = array(
					'element'  => $dependency['element'],
					'value'    => $dependency['value'],
					'operator' => isset( $dependency['operator'] ) ? $dependency['operator'] : 'in',
				);
			} else { // if multiple
				foreach ( $dependency as $_dependency ) {
					$callbacks[] = array(
						'element'  => $_dependency['element'],
						'value'    => $_dependency['value'],
						'operator' => isset( $_dependency['operator'] ) ? $_dependency['operator'] : 'in',
					);
				}
			}
		}

		if ( empty( $callbacks ) ) {
			return '';
		}

		foreach ( $callbacks as $i => $callback ) {
			$callbacks[ $i ]['element'] = $this->refactor_id( $callback['element'] );
		}

		$this->active_callbacks[ $id ] = $callbacks;

		return $callbacks;
	}

	/**
	 * Get all fields.
	 *
	 * @return array
	 */
	public function get_fields() {
		return apply_filters( 'ak-framework/customizer/fields/registered', $this->fields );
	}

	/**
	 * Get the field
	 *
	 * @param integer $id Field ID
	 * @return array|bool
	 */
	public function get_field( $id ) {
		$fields = $this->get_fields();

		if ( array_key_exists( $id, $fields ) ) {
			return $fields[ $id ];
		}

		return false;
	}

	/**
	 * @return array
	 */
	public function get_js_vars() {
		return apply_filters( 'ak-framework/customizer/js_vars/registered', $this->js_vars );
	}

	/**
	 * @return array
	 */
	public function get_active_callbacks() {
		return apply_filters( 'ak-framework/customizer/active_callbacks/registered', $this->active_callbacks );
	}

	/**
	 * @return array|bool
	 */
	public function get_active_callback( $id ) {
		$active_callbacks = $this->get_active_callbacks();
		if ( ! isset( $active_callbacks[ $id ] ) ) {
			return false;
		}

		return $active_callbacks[ $id ];
	}

	/**
	 * @return array
	 */
	public function get_outputs() {
		return apply_filters( 'ak-framework/customizer/outputs/registered', $this->outputs );
	}

	/**
	 * @return array|bool
	 */
	public function get_output( $id ) {
		$outputs = $this->get_outputs();
		if ( array_key_exists( $id, $outputs ) ) {
			return $outputs[ $id ];
		}

		return false;
	}

	/**
	 * @return array
	 */
	public function get_active_outputs() {
		$outputs = array();

		foreach ( $this->get_outputs() as $id => $output ) {
			$field = $this->get_field( $id );
			if ( ! $field ) {
				continue;
			}

			$value   = $this->get_value( $id );
			$default = $field['default'];

			if ( Arr::compare( $value, $default, 'equals' )
			|| ! $this->is_field_active( $field )
			) {
				continue;
			}

			foreach ( $output as $it => $item ) {
				if ( ! isset( $item['type'] ) || 'css' !== $item['type'] ) {
					unset( $output[ $it ] );
					continue;
				}

				if ( ! isset( $item['value'] ) ) {
					$output[ $it ]['value'] = $value;
				}
			}

			$outputs[ $id ] = $output;
		}

		return $outputs;
	}

	/**
	 * @return array|bool
	 */
	public function is_field_active( $id ) {
		return CustomizerActiveCallback::evaluate_by_id( $id );
	}

	/**
	 * Get the field value.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function get_value( $id ) {
		$field = $this->get_field( $id );

		if ( ! $field ) {
			return '';
		}

		$type    = $field['option_type'];
		$default = $field['default'];

		if ( 'option' === $type ) {
			if ( strpos( $id, '[' ) !== false ) {
				$element = explode( '[', $id );

				$option      = $element[0];
				$option_name = rtrim( $element[1], ']' );

				$_value = ak_get_option( $option, $option_name, $default );

				if ( sizeof( $element ) === 3 ) {
					$option_key = rtrim( $element[2], ']' );

					return isset( $_value[ $option_key ] ) ? $_value[ $option_key ] : '';
				}

				return $_value;
			}

			return get_option( $id, $default );
		}

		return get_theme_mod( $id, $default );
	}

	/**
	 * Refactor field id for our usage.
	 *
	 * @return string
	 */
	public function refactor_id( $id ) {
		if ( ! isset( $this->config['option_name'] ) ) {
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

		return $this->config['option_name'] . $new_id;
	}

	/**
	 * @return string
	 */
	public function filter_id( $id ) {
		return str_replace( array( '[', ']' ), array( '-', '' ), $id );
	}


}
