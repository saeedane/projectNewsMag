<?php
/**
 * @author : akbilisim
 */
namespace Ak\Elementor;

use Ak\Shortcode\ShortcodeManager;
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

class ElementorWidget extends Widget_Base {
	public $shortcode_id = '';

	private $_options = array();

	private $_params = array();

	public function __construct( $data = array(), $args = null ) {
		if ( isset( $args['shortcode_id'] ) ) {
			$this->shortcode_id = $args['shortcode_id'];
		}

		parent::__construct( $data, $args );
	}

	/**
	 * Get shortcode option fields.
	 *
	 * @return array
	 */
	public function get_options() {
		if ( empty( $this->_options ) ) {
			$this->_options = ShortcodeManager::get_instance()->get_options( $this->shortcode_id );
		}

		return $this->_options;
	}

	/**
	 * Get shortcode params.
	 *
	 * @return array
	 */
	public function get_params() {
		if ( empty( $this->_params ) ) {
			$this->_params = ShortcodeManager::get_instance()->get_params( $this->shortcode_id );
		}

		return $this->_params;
	}

	public function get_params_key( $key ) {
		$params = $this->get_params( $key );

		return isset( $params[ $key ] ) ? $params[ $key ] : '';
	}

	public function get_name() {
		return $this->shortcode_id;
	}

	public function get_icon() {
		return $this->get_params_key( 'icon' );
	}

	public function get_title() {
		return $this->get_params_key( 'name' );
	}

	public function get_categories() {
		$category = $this->get_params_key( 'category' );

		if ( is_string( $category ) ) {
			$category = array( $category );
		}

		return ! empty( $category ) ? $category : array( 'basic' );
	}

	/**
	 * Prepage elementor control ections.
	 *
	 * @return array
	 */
	private function prepare_sections() {
		$options  = $this->get_options();
		$sections = array();

		foreach ( $options as $option ) {
			/**
			 * Refactor fields for Visual Composer Add-on.
			 *
			 * @since 1.0.0
			 *
			 * @param array $fields Fields for Visual Composer
			 * @param mixed $id     The Shortcode Id
			 */
			$_option = apply_filters( 'ak-framework/elementor-option', $option );

			if ( ! $_option ) {
				continue;
			}

			if ( isset( $option['section'] ) && strtolower( $option['section'] ) === 'design' ) {
				$sections['style'][] = $_option;
			} else {
				if ( isset( $option['group'] ) ) {
					$sections[ $option['group'] ][] = $_option;
				} elseif ( isset( $option['section'] ) ) {
					$sections[ $option['section'] ][] = $_option;
				} else {
					$sections['setting'][] = $_option;
				}
			}
		}

		return $sections;
	}

	/**
	 * Register Elementor controls
	 *
	 * @return void
	 */
	protected function register_controls() {
		if ( ! is_admin() ) {
			return;
		}
		$sections = $this->prepare_sections();

		foreach ( $sections as $group => $options ) {

			if ( ! $group ) {
				continue;
			}

			if ( 'style' === $group ) {
				$section = array(
					'label' => esc_html__( 'Style', 'ak-framework' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				);
			} elseif ( 'setting' === $group ) {
				$section = array(
					'label' => esc_html__( 'Setting', 'ak-framework' ),
					'tab'   => Controls_Manager::TAB_CONTENT,
				);
			} else {
				$section = array(
					'label' => esc_html( $group ),
					'tab'   => Controls_Manager::TAB_CONTENT,
				);
			}

			$this->start_controls_section(
				'section_' . str_replace( ' ', '-', $group ),
				$section
			);

			foreach ( $options as $option ) {
				if ( isset( $option['name'] ) ) {
					if ( 'ak-mix_fields' === $option['type'] ) {
						$this->add_group_control( $option['type'], $option );
					} else {
						$this->add_control( $option['name'], $option );
					}
				}
			}

			$this->end_controls_section();
		}
	}

	/**
	 * Render the elementor shortcode.
	 *
	 * @return void
	 */
	protected function render() {
		$settings = $this->get_settings();

		$settings = apply_filters( 'ak-framework/elementor/widget/settings', $settings );

		ak_do_shortcode( $this->shortcode_id, $settings );
	}
}
