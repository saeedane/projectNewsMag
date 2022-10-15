<?php

namespace Ak\Form\Control;

class WpEditor extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'wp_editor';

	public $settings = array();

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() {      ?>
		<div class="ak-wp-editor-field">
			<?php
			if ( ! isset( $this->settings['textarea_name'] ) ) {
				$this->settings['textarea_name'] = $this->param_name;
			}

			wp_editor( $this->get_value(), $this->id, $this->settings );
			?>
		</div>
		<?php
	}
}
