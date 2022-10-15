<?php
namespace Ak\Customizer\Control;

class Repeater extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $_type = 'repeater';

	/**
	 * Maximum number of options the user will be able to select.
	 * Set to 1 for single-select.
	 *
	 * @var int
	 */
	public $sorter = true;

	public $repeat_heading = '';

	public $add_button_name = '';

	public $max_items = 100;

	public $fields = array();

	public $fields_callback = '';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 */
	public function to_field() {
		parent::to_field();
		$this->_field['sorter']          = $this->sorter;
		$this->_field['repeat_heading']  = $this->repeat_heading;
		$this->_field['add_button_name'] = $this->add_button_name;
		$this->_field['max_items']       = $this->max_items;
		$this->_field['fields']          = $this->fields;
		$this->_field['fields_callback'] = $this->fields_callback;
	}

}
