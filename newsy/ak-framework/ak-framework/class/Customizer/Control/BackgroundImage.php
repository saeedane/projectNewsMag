<?php
namespace Ak\Customizer\Control;

class BackgroundImage extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $_type = 'background_image';

	public $button_text;

	public $remove_text;

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 */
	public function to_field() {
		parent::to_field();
		if ( $this->button_text ) {
			$this->_field['button_text'] = $this->button_text;
		}
		if ( $this->remove_text ) {
			$this->_field['remove_text'] = $this->remove_text;
		}
	}
}
