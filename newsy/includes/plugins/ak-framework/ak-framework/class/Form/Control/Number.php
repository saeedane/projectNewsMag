<?php

namespace Ak\Form\Control;

class Number extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'number';

	public $min = 0;

	public $max = 9999;

	public $step = 1;

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'ak-form-number-control', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-number.js', array( 'ak-form-control', 'jquery-ui-spinner' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() {      ?>
		<div class="ak-number-field">
			<input type="number" value="<?php echo esc_attr( $this->value ); ?>" data-min="<?php echo esc_attr( $this->min ); ?>"
			data-max="<?php echo esc_attr( $this->max ); ?>" data-step="<?php echo esc_attr( $this->step ); ?>" <?php $this->get_input_attrs(); ?> />
		</div>
		<?php
	}
}
