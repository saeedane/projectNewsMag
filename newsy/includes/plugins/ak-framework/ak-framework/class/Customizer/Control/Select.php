<?php
namespace Ak\Customizer\Control;

/**
 * Select control.
 */
class Select extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $_type = 'select';

	/**
	 * Maximum number of options the user will be able to select.
	 * Set to 1 for single-select.
	 *
	 * @var int
	 */
	public $multiple = false;

	public $selectize = false;

	public $exculable = false;

	public $return_string = true;

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 */
	public function to_field() {
		parent::to_field();
		$this->_field['multiple']      = $this->multiple;
		$this->_field['selectize']     = $this->selectize;
		$this->_field['exculable']     = $this->exculable;
		$this->_field['return_string'] = $this->return_string;
	}

}
