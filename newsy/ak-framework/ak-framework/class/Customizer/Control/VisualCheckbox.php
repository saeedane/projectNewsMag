<?php
namespace Ak\Customizer\Control;
/**
 * VisualCheckbox control.
 */
class VisualCheckbox extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $_type = 'visual_checkbox';

	/**
	 * Maximum number of options the user will be able to select.
	 * Set to 1 for single-select.
	 *
	 * @var int
	 */
	public $vertical = false;

	public $sorter = false;

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 */
	public function to_field() {
		parent::to_field();

		$this->_field['vertical'] = $this->vertical;
		$this->_field['sorter']   = $this->sorter;
	}
}
