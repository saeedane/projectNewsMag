<?php

namespace Ak\Customizer\Control;

use Ak\Form\FormBuilder;

class Info extends ControlAbstract {
	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $_type = 'info';

	public $info_type = 'note';

	public $state = 'open';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 */
	public function to_field() {
		parent::to_field();
		$this->_field['info_type'] = $this->info_type;
		$this->_field['state']     = $this->state;
	}

		/**
	 * Render the control's content.
	 *
	 * @see WP_Customize_Control::render_content()
	 */
	protected function render_content() {
		$this->to_field();

		echo FormBuilder::render_field( $this->_field, true );
	}
}

