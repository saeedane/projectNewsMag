<?php
namespace Ak\Customizer\Control;

/**
 * Create a simple number control.
 */
class Number extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $_type = 'number';

	public $min = 0;

	public $max = 9999;

	public $step = 1;

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 */
	public function to_field() {
		parent::to_field();

		$this->_field['min']  = $this->min;
		$this->_field['max']  = $this->max;
		$this->_field['step'] = $this->step;
	}
}
