<?php
namespace Ak\Elementor\Control;

use \Elementor\Group_Control_Base;

class MixFields extends Group_Control_Base {

	/**
	 * Fields.
	 *
	 * Holds all the text shadow control fields.
	 *
	 * @since 1.6.0
	 * @access protected
	 * @static
	 *
	 * @var array Text shadow control fields.
	 */
	protected static $fields;

	/**
	 * Get text shadow control type.
	 *
	 * Retrieve the control type, in this case `text-shadow`.
	 *
	 * @since 1.6.0
	 * @access public
	 * @static
	 *
	 * @return string Control type.
	 */
	public static function get_type() {
		return 'ak-mix_fields';
	}

	/**
	 * Get controls prefix.
	 *
	 * Retrieve the prefix of the group control, which is `{{ControlName}}_`.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Control prefix.
	 */
	public function get_controls_prefix() {
		$args = $this->get_args();
		return $args['name'] . '_-_';
	}

	/**
	 * Init fields.
	 *
	 * Initialize text shadow control fields.
	 *
	 * @since 1.6.0
	 * @access protected
	 *
	 * @return array Control fields.
	 */
	protected function init_fields() {
		$args          = $this->get_args();
		$mixed_options = isset( $args['fields'] ) ? $args['fields'] : array();

		$_controls = array();
		foreach ( $mixed_options as $option ) {
			$id               = $option['id'];
			$option           = apply_filters( 'ak-framework/elementor-option', $option );
			$_controls[ $id ] = $option;
		}

		return $_controls;
	}

	/**
	 * Get default options.
	 *
	 * Retrieve the default options of the text shadow control. Used to return the
	 * default options while initializing the text shadow control.
	 *
	 * @since 1.9.0
	 * @access protected
	 *
	 * @return array Default text shadow control options.
	 */
	protected function get_default_options() {
		return array(
			'popover'         => false,
			'fields'          => array(),
			'fields_callback' => array(),
		);
	}
}
