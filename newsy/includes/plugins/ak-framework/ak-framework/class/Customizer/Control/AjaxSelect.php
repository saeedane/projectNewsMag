<?php
namespace Ak\Customizer\Control;

class AjaxSelect extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $_type = 'ajax_select';

	/**
	 * Maximum number of options the user will be able to select.
	 * Set to 1 for single-select.
	 *
	 * @access public
	 * @var int|bool
	 */
	public $max_items = 1000;

	public $ajax_callback = '';

	public $ajax_callback_args;

	public $exculable = false;

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 */
	public function to_field() {
		parent::to_field();

		$this->_field['max_items']          = $this->max_items;
		$this->_field['ajax_callback']      = $this->ajax_callback;
		$this->_field['ajax_callback_args'] = $this->ajax_callback_args;
		$this->_field['exculable']          = $this->exculable;
	}
}
