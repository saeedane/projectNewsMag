<?php
/**
 * @author : akbilisim
 */
namespace Ak\Elementor;

use Ak\Asset\BackendAsset;
use Ak\Elementor\Section\DefaultSection;
use Ak\Elementor\Column\DefaultColumn;
use Ak\Shortcode\ShortcodeManager;
use Elementor\Controls_Manager;
use Elementor\Repeater;

/**
 * Initialize custom functionalities for Elementor.
 */
class ElementorManager {

	public $elementor_control_types = array(
		'info'            => 'Ak\Elementor\Control\Info',
		'heading'         => 'Ak\Elementor\Control\Heading',
		'text'            => 'Ak\Elementor\Control\Text',
		'radio_image'     => 'Ak\Elementor\Control\RadioImage',
		'radio_button'    => 'Ak\Elementor\Control\RadioButton',
		'select'          => 'Ak\Elementor\Control\Select',
		'ajax_select'     => 'Ak\Elementor\Control\AjaxSelect',
		'visual_select'   => 'Ak\Elementor\Control\VisualSelect',
		'visual_checkbox' => 'Ak\Elementor\Control\VisualCheckbox',
		'media_image'     => 'Ak\Elementor\Control\MediaImage',
		'icon_select'     => 'Ak\Elementor\Control\IconSelect',
		'slider_unit'     => 'Ak\Elementor\Control\SliderUnit',
		'mix_fields'      => 'Ak\Elementor\Control\MixFields',
		'custom_field'    => 'Ak\Elementor\Control\CustomField',
	);

	/**
	 * @var ElementorManager
	 */
	private static $instance;

	/**
	 * @return ElementorManager
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	public function __construct() {
		add_action( 'elementor/init', array( $this, 'init_element' ) );
		add_filter( 'ak-framework/elementor-option', array( $this, 'prepare_control_option_args' ), 11 );

		// load script & style editor
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'enqueue_backend_styles' ) );
		add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'enqueue_backend_scripts' ) );

		// elementor widgets_registered
		add_action( 'elementor/controls/controls_registered', array( $this, 'register_fields' ) );
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'register_widget_categories' ) );

		add_action( 'ak-framework/elementor/widget/settings', array( $this, 'parse_mix_fields_settings' ) );
	}

	public function init_element() {
		\Elementor\Plugin::$instance->elements_manager->register_element_type( new DefaultSection() );
		\Elementor\Plugin::$instance->elements_manager->register_element_type( new DefaultColumn() );
	}

	public function enqueue_backend_styles() {
		BackendAsset::get_instance()->enqueue_backend_styles(); // not working?
	}

	/**
	 * Backend scripts
	 *
	 * @return void
	 */
	public function enqueue_backend_scripts() {
		BackendAsset::get_instance()->enqueue_backend_scripts();
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function register_fields( $controls_manager ) {
		foreach ( $this->elementor_control_types as $type => $class ) {
			if ( class_exists( $class ) ) {
				if ( 'mix_fields' === $type ) {
					$controls_manager->add_group_control( 'ak-' . $type, new $class() );
				} else {
					$controls_manager->register_control( 'ak-' . $type, new $class() );
				}
			}
		}
	}

	/**
	 * Initialize active shortcodes.
	 */
	public function register_widgets() {
		$shortcodes = ShortcodeManager::get_instance()->get_shortcodes();

		if ( $shortcodes ) {
			foreach ( $shortcodes as $id => $params ) {

				if ( isset( $params['elementor_class'] ) && class_exists( $params['elementor_class'] ) ) {
					$elementor_class = $params['elementor_class'];

					$class = new $elementor_class();
				} else {
					$class = new ElementorWidget(
						array(), array(
							'shortcode_id' => $id,
						)
					);
				}

				// Register widget
				\Elementor\Plugin::instance()->widgets_manager->register( $class );
			}
		}
	}

	public function register_widget_categories( $elements_manager ) {
		$shortcodes = ShortcodeManager::get_instance()->get_shortcodes();
		$categories = array();

		foreach ( $shortcodes as $params ) {
			if ( isset( $params['category'] ) && is_array( $params['category'] ) ) {
				foreach ( $params['category'] as $category_name ) {
					$categories[ $category_name ] = $category_name;
				}
			}
		}

		foreach ( $categories as $category ) {
			$elements_manager->add_category(
				$category,
				array(
					'title' => $category,
					'icon'  => 'fa fa-plug',
				)
			);
		}
	}

	/**
	 * Prepare the control params
	 *
	 * @param array $option
	 * @return array
	 */
	public function prepare_control_option_args( $option ) {
		$_option                = array();
		$_option['name']        = ! empty( $option['id'] ) ? $option['id'] : '';
		$_option['label']       = ! empty( $option['heading'] ) ? $option['heading'] : '';
		$_option['default']     = ! empty( $option['default'] ) ? $option['default'] : '';
		$_option['label_block'] = ! empty( $option['label_block'] ) ? $option['label_block'] : true;
		$_option['condition']   = ! empty( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : '';
		$_option['description'] = ! empty( $option['description'] ) ? $option['description'] : '';

		if ( ! empty( $option['input_desc'] ) && empty( $_option['description'] ) ) {
			$_option['description'] = $option['input_desc'];
		}

		if ( ! empty( $option['options_callback'] ) ) {
			$_option['options'] = ak_fields_callback( $option['options_callback'] );
		} elseif ( ! empty( $option['options'] ) ) {
			$_option['options'] = $option['options'];
		}

		// inner options_callback
		if ( isset( $_option['options']['options_callback'] ) ) {
			$callback_options = ak_fields_callback( $_option['options']['options_callback'] );
			unset( $_option['options']['options_callback'] );
			$_option['options'] = ak_merge_args( $_option['options'], $callback_options );
		}

		// if we set special elementor options return with them.
		if ( ! empty( $_option['elementor_options'] ) ) {
			return ak_merge_args( $_option, $_option['elementor_options'] );
		}

		switch ( $option['type'] ) {
			case 'text':
			case 'textfield':
				if ( isset( $option['selectize'] ) ) {
					$_option['type'] = 'ak-text';
				} else {
					$_option['type'] = Controls_Manager::TEXT;
				}
				break;

			case 'textarea':
				$_option['type'] = Controls_Manager::TEXTAREA;
				break;

			case 'color':
				$_option['type']        = Controls_Manager::COLOR;
				$_option['label_block'] = false;
				break;

			case 'switcher':
				$_option['type'] = Controls_Manager::SWITCHER;

				if ( isset( $option['options'] ) ) {
					$_option['label_on']     = isset( $option['options']['on'] ) ? $option['options']['on'] : true;
					$_option['label_off']    = isset( $option['options']['off'] ) ? $option['options']['off'] : false;
					$_option['return_value'] = ! empty( $_option['label_on'] ) ? $_option['label_on'] : $_option['label_off'];
				}

				$_option['label_block'] = false;
				break;

			case 'select':
				$_option['type'] = 'ak-select';

				if ( isset( $option['selectize'] ) ) {
					$_option['selectize'] = $option['selectize'];
				}
				if ( isset( $option['multiple'] ) ) {
					$_option['multiple'] = $option['multiple'];
				}
				if ( isset( $option['return_string'] ) ) {
					$_option['return_string'] = $option['return_string'];
				}
				if ( isset( $option['exculable'] ) ) {
					$_option['exculable'] = $option['exculable'];
				}
				break;

			case 'ajax_select':
				$_option['type']               = 'ak-ajax_select';
				$_option['max_items']          = isset( $option['max_items'] ) ? $option['max_items'] : 1000;
				$_option['ajax_callback']      = isset( $option['ajax_callback'] ) ? $option['ajax_callback'] : '';
				$_option['ajax_callback_args'] = isset( $option['ajax_callback_args'] ) ? $option['ajax_callback_args'] : '';
				$_option['exculable']          = isset( $option['exculable'] ) ? $option['exculable'] : false;
				break;

			case 'radio_image':
				$_option['type'] = 'ak-radio_image';
				break;

			case 'radio_button':
				$_option['type'] = 'ak-radio_button';
				break;

			case 'visual_select':
				$_option['type'] = 'ak-visual_select';
				break;

			case 'visual_checkbox':
				$_option['type'] = 'ak-visual_checkbox';

				if ( isset( $option['vertical'] ) ) {
					$_option['vertical'] = $option['vertical'];
				}

				if ( isset( $option['sorter'] ) ) {
					$_option['sorter'] = $option['sorter'];
				}

				break;

			case 'media_image':
				$_option['type'] = 'ak-media_image';

				if ( isset( $option['media_title'] ) ) {
					$_option['media_title'] = $option['media_title'];
				}

				if ( isset( $option['button_text'] ) ) {
					$_option['button_text'] = $option['button_text'];
				}

				if ( isset( $option['remove_text'] ) ) {
					$_option['remove_text'] = $option['remove_text'];
				}

				if ( isset( $option['media_size'] ) ) {
					$_option['media_size'] = $option['media_size'];
				}

				if ( isset( $option['media_data_type'] ) ) {
					$_option['media_data_type'] = $option['media_data_type'];
				}

				break;

			case 'slider_unit':
				$_option['type'] = 'ak-slider_unit';

				if ( isset( $option['units'] ) ) {
					$_option['size_units'] = $option['units'];
				}
				if ( isset( $option['default_unit'] ) ) {
					$_option['default_unit'] = $option['default_unit'];
				}
				if ( isset( $option['min'] ) ) {
					$_option['min'] = $option['min'];
				}
				if ( isset( $option['max'] ) ) {
					$_option['max'] = $option['max'];
				}
				if ( isset( $option['step'] ) ) {
					$_option['step'] = $option['step'];
				}
				break;

			case 'slider':
			case 'number':
				$_option['type']        = Controls_Manager::NUMBER;
				$_option['min']         = isset( $option['min'] ) ? $option['min'] : 0;
				$_option['max']         = isset( $option['max'] ) ? $option['max'] : 100000;
				$_option['step']        = isset( $option['step'] ) ? $option['step'] : 1;
				$_option['label_block'] = false;
				break;

			case 'info':
				$_option['type'] = 'ak-info';

				if ( isset( $option['info_type'] ) ) {
					$_option['info_type'] = $option['info_type'];
				}

				if ( isset( $option['state'] ) ) {
					$_option['state'] = $option['state'];
				}

				break;

			case 'heading':
				$_option['type'] = 'ak-heading';
				break;

			case 'icon_select':
				$_option['type'] = 'ak-icon_select';
				break;

			case 'icon':
				$_option['type'] = Controls_Manager::ICON;
				break;

			case 'icons':
				$_option['type'] = Controls_Manager::ICONS;

				if ( empty( $option['default'] ) ) {
					$_option['default'] = array();
				}
				break;

			case 'attach_image':
				$_option['type']    = Controls_Manager::MEDIA;
				$_option['default'] = array(
					'url' => isset( $option['default'] ) ? $option['default'] : '',
				);
				break;

			case 'checkbox':
				$_option['type'] = Controls_Manager::CHOOSE;

				foreach ( $_option['options'] as $_id => $option ) {
					$_option['options'][ $_id ] = array(
						'title' => $option,
					);
				}
				break;

			case 'code':
				$_option['type']     = Controls_Manager::CODE;
				$_option['language'] = isset( $option['language'] ) ? $option['language'] : 'html';
				break;

			case 'repeater':
				$_option['type'] = Controls_Manager::REPEATER;
				if ( isset( $option['fields_callback'] ) ) {
					$_option['fields'] = ak_fields_callback( $option['fields_callback'] );
				} elseif ( isset( $option['fields'] ) ) {
					$_option['fields'] = $option['fields'];
				}
				$repeater = new Repeater();

				foreach ( $_option['fields'] as $_field ) {
					$repeater->add_control(
						$_field['id'],
						$this->prepare_control_option_args( $_field )
					);
				}

				$_option['fields'] = $repeater->get_controls();

				if ( empty( $option['default'] ) ) {
					$_option['default'] = array();
				}

				break;

			case 'css_editor':
				return false;
				break;

			case 'mix_fields':
				$_option['type'] = 'ak-mix_fields';
				if ( isset( $option['fields_callback'] ) ) {
					$_option['fields'] = ak_fields_callback( $option['fields_callback'] );
				} elseif ( isset( $option['fields'] ) ) {
					$_option['fields'] = $option['fields'];
				}
				break;

			case 'custom_field':
				$_option['type'] = 'ak-custom_field';

				if ( ! empty( $option['html'] ) ) {
					$_option['html'] = $option['html'];
				}
				break;

			default:
				$_option['type'] = Controls_Manager::TEXT;
				break;
		}

		return $_option;
	}

	public function parse_dependency_option( $value ) {
		$condition = '';

		if ( isset( $value['value'] ) ) {
			return array( $value['element'] => $value['value'] );
		}

		if ( isset( $value['not_empty'] ) && $value['not_empty'] ) {
			return array( $value['element'] . '!' => '' );
		}

		return array( $value['element'] => $condition );
	}

	public function parse_mix_fields_settings( $settings ) {
		$nested_array = array();
		foreach ( $settings as  $key => $setting ) {
			if ( is_string( $key ) && strpos( $key, '_-_' ) !== -1 ) {
				$temp = &$nested_array;

				foreach ( explode( '_-_', $key ) as $item ) {
					$temp = &$temp[ $item ];
				}

				$temp = $setting;
			}
		}

		return array_merge( $settings, $nested_array );
	}
}
