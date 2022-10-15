<?php
namespace Ak\Customizer\Control;

class Media extends ControlAbstract {
	public $_type = 'media';

	public $media_type;

	public $media_title;

	public $button_text;

	public function to_field() {
		parent::to_field();

		$this->_field['media_type']  = $this->media_type;
		$this->_field['media_title'] = $this->media_title;
		$this->_field['button_text'] = $this->button_text;
	}
}
