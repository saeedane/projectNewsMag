<?php
namespace Ak\Customizer\Control;

class MediaImage extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $_type = 'media_image';

	public $media_type;

	public $media_title;

	public $button_text;

	public $remove_text;

	public $media_size;

	public $media_data_type;


	public function to_field() {
		parent::to_field();

		$this->_field['media_type']      = $this->media_type;
		$this->_field['media_title']     = $this->media_title;
		$this->_field['button_text']     = $this->button_text;
		$this->_field['remove_text']     = $this->remove_text;
		$this->_field['media_size']      = $this->media_size;
		$this->_field['media_data_type'] = $this->media_data_type;
	}
}
