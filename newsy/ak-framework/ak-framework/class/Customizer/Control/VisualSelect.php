<?php
namespace Ak\Customizer\Control;

class VisualSelect extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $_type = 'visual_select';

	/**
	 * Maximum number of options the user will be able to select.
	 * Set to 1 for single-select.
	 *
	 * @var int
	 */
	public $switcher = false;

	public $vertical = false;

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 */
	public function to_field() {
		parent::to_field();

		$this->_field['vertical'] = $this->vertical;
		$this->_field['switcher'] = $this->switcher;
	}
}
