<?php
namespace Ak\Customizer\Control;

class Text extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $_type = 'text';

	/**
	 * Text Field Prefix.
	 *
	 * @var string
	 */
	public $prefix = '';

	/**
	 * Text Field Suffix.
	 *
	 * @var string
	 */
	public $suffix = '';

	public $selectize = false;

	public $maxitems = 100;

	public $delimiter = ',';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 */
	public function to_field() {
		parent::to_field();

		$this->_field['prefix']    = $this->prefix;
		$this->_field['suffix']    = $this->suffix;
		$this->_field['selectize'] = $this->selectize;
		$this->_field['maxitems']  = $this->maxitems;
		$this->_field['delimiter'] = $this->delimiter;
	}
}
