<?php

namespace Ak\Form\Control;

class Slider extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'slider';

	public $max = 1000;

	public $min = 0;

	public $step = 1;

	public $unit = '';

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'ak-form-control-slider', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-slider.js', array( 'ak-form-control', 'jquery-ui-slider' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() {      ?>
		<div class="ak-slider-field">
			<div class="ak-slider-spinner"></div>
			<div class="ak-slider-input">
				<input type="number" data-min="<?php echo esc_attr( $this->min ); ?>" data-max="<?php echo esc_attr( $this->max ); ?>" data-step="<?php echo esc_attr( $this->step ); ?>"
				value="<?php echo esc_attr( $this->get_value() ); ?>" placeholder="-" <?php $this->get_input_attrs(); ?> />
				<?php
				if ( $this->unit ) {
					?>
					<div class="ak-slider-unit-input-selection">
						<span class="ak-unit-input-unit">
						<?php echo esc_html( $this->unit ); ?>
						</span>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
}
