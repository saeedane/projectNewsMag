<?php
namespace Ak\Form\Control;

class Textarea extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'textarea';

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() {      ?>
		<div class="ak-textarea-field">
			<textarea rows="4" cols="50" <?php $this->get_input_attrs(); ?>><?php echo esc_textarea( $this->get_value() ); ?></textarea>
		</div>
		<?php
	}
}
