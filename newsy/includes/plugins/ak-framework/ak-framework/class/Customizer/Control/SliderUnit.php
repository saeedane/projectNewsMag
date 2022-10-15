<?php
namespace Ak\Customizer\Control;

/**
 * Slider control (range).
 */
class SliderUnit extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $_type = 'slider_unit';

	public $max = 1000;

	public $min = 0;

	public $step = 1;

	public $default_unit = 'px';

	public $units = array(
		'px',
		'em',
		'rem',
		'vh',
		'vw',
		'%',
	);

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 */
	public function to_field() {
		parent::to_field();

		$this->_field['min']          = $this->min;
		$this->_field['max']          = $this->max;
		$this->_field['step']         = $this->step;
		$this->_field['default_unit'] = $this->default_unit;
		$this->_field['units']        = $this->units;
	}
}
