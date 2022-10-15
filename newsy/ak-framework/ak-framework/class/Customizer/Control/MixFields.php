<?php
namespace Ak\Customizer\Control;

class MixFields extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $_type = 'mix_fields';

	/**
	 * Maximum number of options the user will be able to select.
	 * Set to 1 for single-select.
	 *
	 * @var int
	 */
	public $return_string = false;

	/**
	 * Set defaults on empty value.
	 *
	 * @var bool
	 */
	public $defaults_on_empty = false;

	public $fields = array();

	public $fields_callback;

	/**
	 * Enqueue control related scripts/styles from our manager.
	*/
	public function enqueue() {
		parent::enqueue();

		wp_enqueue_script( 'ak-customizer-control-mix-fields', AK_FRAMEWORK_URL . '/assets/js/customizer/controls/control-mix-fields.js', array( 'jquery', 'customize-base' ), null, true );
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 */
	public function to_field() {
		parent::to_field();

		$this->_field['return_string']     = $this->return_string;
		$this->_field['defaults_on_empty'] = $this->defaults_on_empty;
		$this->_field['fields']            = $this->fields;
		$this->_field['fields_callback']   = $this->fields_callback;
	}
}
