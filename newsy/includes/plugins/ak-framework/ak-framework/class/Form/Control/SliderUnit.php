<?php

namespace Ak\Form\Control;

class SliderUnit extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'slider_unit';

	public $min = 0;

	public $max = 1000;

	public $step = 1;

	public $default_unit = 'px';

	public $units = array(
		'px',
		'em',
		'rem',
		'vh',
		'vw',
		'%',
	);

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'ak-form-control-slider-unit', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-slider-unit.js', array( 'ak-form-control', 'jquery-ui-slider' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() { ?>
		<div class="ak-slider-field">
			<div class="ak-slider-spinner"></div>
			<div class="ak-slider-input">
				<input type="hidden" data-min="<?php echo esc_attr( $this->min ); ?>" data-max="<?php echo esc_attr( $this->max ); ?>" data-step="<?php echo esc_attr( $this->step ); ?>"
				value="<?php echo esc_attr( $this->get_value() ); ?>" <?php $this->get_input_attrs(); ?> />
				<input type="text" placeholder="-" class="ak-slider-unit-input" />
				<div class="ak-slider-unit-input-selection">
					<span class="ak-unit-input-unit"><?php echo esc_html( $this->default_unit ); ?></span>
					<ul class="ak-unit-input-choices">
					<?php
					foreach ( $this->units as $unit ) {
						echo " <li data-unit=\"{$unit}\">{$unit}</li>";
					}
					?>
					</ul>
				</div>
			</div>
		</div>
		<?php
	}
}
