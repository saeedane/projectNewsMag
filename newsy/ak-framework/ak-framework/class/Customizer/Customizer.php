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

use Ak\Form\FormSanitizer;
use Ak\Util\CssGenerator;
use Ak\Asset\StyleManager;

/**
 * Ak Framework Customizer Class.
 */
class Customizer {
	/**
	 * Holds All Controls with class path.
	 *
	 * @since  1.0
	 *
	 * @var array
	 */
	private $controls = array();

	/**
	 * Holds default supported controls.
	 *
	 * @since  1.0
	 *
	 * @var array
	 */
	public $available_controls = array(
		'ajax_select',
		'info',
		'color',
		'text',
		'heading',
		'number',
		'media',
		'media_image',
		'background_image',
		'radio_button',
		'radio_image',
		'radio_icon',
		'select',
		'slider',
		'slider_unit',
		'icon_select',
		'switcher',
		'textarea',
		'typography',
		'css_editor',
		'visual_checkbox',
		'visual_select',
		'repeater',
		'mix_fields',
	);

	/**
	 * An array containing all panels.
	 *
	 * @var object
	 */
	private $customizer;

	/**
	 * An array containing all panels.
	 *
	 * @var CustomizerManager
	 */
	private $customizer_manager;

	/**
	 * @var Customizer
	 */
	private static $instance;

	/**
	 * @return Customizer
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Customizer Constructor.
	 */
	public function __construct() {
		$this->customizer_manager = CustomizerManager::get_instance();

		if ( ! $this->customizer_manager ) {
			return;
		}

		$this->register_helper();
		$this->register_hook();
	}


	public function register_helper() {
		CustomizerRedirect::get_instance();
	}

	/**
	 * register_hook.
	 */
	public function register_hook() {
		add_action( 'customize_preview_init', array( $this, 'preview_init' ), 99 );
		add_action( 'customize_controls_print_styles', array( $this, 'customizer_styles' ), 99 );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_script' ) );

		add_action( 'customize_register', array( $this, 'init_customizer' ) );

		add_action( 'wp_head', array( $this, 'print_output' ), 999 );
	}

	/**
	 * preview init.
	 */
	public function preview_init() {
		add_action( 'wp_enqueue_scripts', array( $this, 'load_script' ), 99999 );
	}

	/**
	 * load script at Customizer Preview.
	 */
	public function load_script() {
		wp_deregister_style( 'ak-generated' );

		wp_enqueue_script( 'ak-customizer-output', AK_FRAMEWORK_URL . '/assets/js/customizer/customizer-style-output.js', array( 'jquery', 'customize-preview' ), AK_FRAMEWORK_VERSION, true );
		wp_localize_script( 'ak-customizer-output', 'ak_customizer_outputs', $this->customizer_manager->get_outputs() );
	}

	/**
	 * Load css on Customizer Panel.
	 */
	public function customizer_styles() {
		wp_enqueue_style( 'ak-customizer-css', AK_FRAMEWORK_URL . '/assets/css/customizer.css', AK_FRAMEWORK_VERSION );
		wp_style_add_data( 'ak-customizer-css', 'rtl', 'replace' );
	}

	/**
	 * load script on Customizer Panel.
	 */
	public function enqueue_control_script() {
		// late initialization functionality for control
		wp_enqueue_script( 'ak-customizer-scripts', AK_FRAMEWORK_URL . '/assets/js/customizer/customizer-scripts.js', array( 'jquery', 'ak-form-control' ), AK_FRAMEWORK_VERSION, true );

		// active callback test
		wp_enqueue_script( 'ak-customizer-active-callback', AK_FRAMEWORK_URL . '/assets/js/customizer/customizer-active-callback.js', array( 'jquery' ), AK_FRAMEWORK_VERSION, true );
		wp_localize_script( 'ak-customizer-active-callback', 'ak_active_callbacks', $this->customizer_manager->get_active_callbacks() );

		// resizable customizer
		wp_enqueue_script( 'jquery-ui-resizable', null, array( 'jquery', 'jquery-ui-core' ), null, true );
	}

	/**
	 * load script at Customizer Preview.
	 */
	public function print_output() {
		$fields = StyleManager::get_instance()->get_css();

		if ( empty( $fields ) ) {
			return;
		}
		$custom_fonts = get_transient( 'ak_font_manager_custom_font_css' );

		echo "<style id='ak-customizer-postmessage_custom_fonts'>" . $custom_fonts . "</style>\n";

		$css_generator = new CssGenerator;

		foreach ( $fields as $id => $outputs ) {
			$new_style = '';
			foreach ( $outputs as $output ) {
				$new_style .= $css_generator->render_field_css( $output, $output['value'] );
			}

			if ( ! empty( $new_style ) ) {
				$id = str_replace( array( '[', ']' ), array( '-', '' ), $id );

				echo "<style id='ak-customizer-postmessage_{$id}'>" . $new_style . "</style>\n";
			}
		}
	}

	public function init_customizer() {
		global $wp_customize;

		$this->customizer = $wp_customize;

		$this->register_control_types();
		$this->register_panel_types();

		$this->register_panels();
		$this->register_sections();
		$this->register_fields();
	}

	/**
	 * Get control instances.
	 */
	public function get_controls() {
		if ( empty( $this->controls ) ) {
			$controls = array();

			foreach ( $this->available_controls as $type ) {
				$class_name = str_replace( '_', ' ', $type );
				$class_name = ucwords( $class_name );
				$class_name = str_replace( ' ', '', $class_name );

				$controls[ $type ] = 'Ak\\Customizer\\Control\\' . $class_name;
			}

			// Register additional controls
			$this->controls = apply_filters( 'ak-framework/customizer/controls', $controls );
		}

		return $this->controls;
	}

	/**
	 * register control type.
	 */
	public function register_control_types() {
		$controls = $this->get_controls();
		foreach ( $controls as $control ) {
			$this->customizer->register_control_type( $control );
		}
	}

	public function register_panel_types() {
		$this->customizer->register_panel_type( 'Ak\Customizer\Panel\InfoPanel' );
		$this->customizer->remove_panel( 'themes' );
	}

	/**
	 * register registered panel.
	 */
	public function register_panels() {
		$panels = $this->customizer_manager->get_panels();

		if ( ! empty( $panels ) ) {
			foreach ( $panels as $panel ) {
				switch ( $panel['type'] ) {
					case 'ak-info':
						$panel_class = 'Ak\Customizer\Section\InfoPanel';
						break;
					default:
						$panel_class = 'WP_Customize_Panel';
						break;
				}

				$this->customizer->add_panel( new $panel_class( $this->customizer, $panel['id'], $panel ) );
			}
		}
	}

	/**
	 * register registered section.
	 */
	public function register_sections() {
		$sections = $this->customizer_manager->get_sections();

		if ( ! empty( $sections ) ) {
			foreach ( $sections as $section ) {
				switch ( $section['type'] ) {
					case 'lazy':
						$section_class = 'Ak\Customizer\Section\LazySection';
						break;
					default:
						$section_class = 'Ak\Customizer\Section\DefaultSection';
						break;
				}

				$this->customizer->add_section( new $section_class( $this->customizer, $section['id'], $section ) );
			}
		}
	}

	/**
	 * register all registered field.
	 */
	public function register_fields() {
		$fields = $this->customizer_manager->get_fields();

		if ( ! empty( $fields ) ) {
			foreach ( $fields as $field ) {
				$this->register_control_setting( $field );
				$this->register_control( $field );

				if ( isset( $field['partial_refresh'] ) ) {
					$this->register_control_partial_refresh( $field['partial_refresh'] );
				}
			}
		}
	}

	/**
	 * @param $field array
	 *
	 * Add WordPress setting
	 */
	public function register_control( $field ) {
		$type     = $field['type'];
		$controls = $this->get_controls();

		if ( array_key_exists( $type, $controls ) ) {
			$class_name    = $controls[ $type ];
			$field['type'] = 'ak_' . $type;
		} elseif ( 'image' === $type ) {
			$class_name = 'WP_Customize_Image_Control';
		} elseif ( 'cropped_image' === $type ) {
			$class_name = 'WP_Customize_Cropped_Image_Control';
		} elseif ( 'upload' === $type ) {
			$class_name = 'WP_Customize_Upload_Control';
		} else {
			// fallback to WP Control, checkbox, radio, select, textarea, dropdown-pages
			$class_name = 'WP_Customize_Control';
		}

		if ( ! empty( $field['active_callback'] ) ) {
			$field['active_callback'] = CustomizerActiveCallback::create_callback( $field['active_callback'] );
		} else {
			$field['active_callback'] = '__return_true';
		}

		$this->customizer->add_control( new $class_name( $this->customizer, $field['id'], $field ) );
	}

	/**
	 * @param $field array
	 *
	 * Add WordPress setting
	 */
	public function register_control_setting( $field ) {
		switch ( $field['type'] ) {
			case 'mix_fields':
			case 'repeater':
			case 'css_editor':
			case 'typography':
			case 'background_image':
				$setting_name = 'Ak\Customizer\Setting\MixFieldsSetting';
				break;

			default:
				$setting_name = 'Ak\Customizer\Setting\DefaultSetting';
				break;
		}

		$this->customizer->add_setting(
			new $setting_name(
				$this->customizer, $field['id'], array(
					'type'              => isset( $field['option_type'] ) ? $field['option_type'] : 'theme_mod',
					'default'           => isset( $field['default'] ) ? $field['default'] : '',
					'capability'        => isset( $field['capability'] ) ? $field['capability'] : 'edit_theme_options',
					'transport'         => isset( $field['transport'] ) ? $field['transport'] : 'postMessage',
					'sanitize_callback' => isset( $field['sanitize_callback'] ) ? $field['sanitize_callback'] : FormSanitizer::get_instance()->sanitize_handler( $field['type'] ),
				)
			)
		);
	}

	/**
	 * do_add_partial_refresh.
	 */
	public function register_control_partial_refresh( $partial_refresh ) {
		if ( ! $partial_refresh || ! isset( $this->customizer->selective_refresh ) ) {
			return;
		}

		// Start going through each item in the array of partial refreshes.
		foreach ( $partial_refresh as $partial_id => $partial_args ) {
			// If we have all we need, create the selective refresh call.
			if ( isset( $partial_args['render_callback'] ) && isset( $partial_args['selector'] ) ) {
				$this->customizer->selective_refresh->add_partial(
					$partial_id, array(
						'selector'            => $partial_args['selector'],
						'settings'            => array( $partial_id ),
						'render_callback'     => is_array( $partial_args['render_callback'] ) ? $this->render_callback( $partial_args['render_callback'] ) : $partial_args['render_callback'],
						'container_inclusive' => isset( $partial_args['container_inclusive'] ) ? $partial_args['container_inclusive'] : false,
						'fallback_refresh'    => false,
					)
				);
			}
		}
	}

	private function render_callback( $callback ) {
		return function() use ( $callback ) {
			return ak_fields_callback( $callback );
		};
	}
}
