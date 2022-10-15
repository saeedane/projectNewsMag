<?php

namespace Ak\Form\Control;

class VisualSelect extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'visual_select';

	/**
	 * Maximum number of options the user will be able to select.
	 * Set to 1 for single-select.
	 *
	 * @var int
	 */
	public $switcher = false;

	public $vertical = false;

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'ak-form-control-visual-select', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-visual-select.js', array( 'ak-form-control' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() {
		$field_class = '';

		if ( $this->switcher ) {
			$field_class .= ' vertical switcher';

			if ( isset( $this->field['switch_to_enable'] ) ) {
				$field_class .= ' vselect-switch-to-enable';
			}
		} elseif ( $this->vertical ) {
			$field_class .= ' vertical';
		} else {
			$field_class .= ' horizontal';
		} ?>
		<div class="ak-visual-select-field <?php echo esc_attr( $field_class ); ?>">
			<ul>
				<?php
				foreach ( (array) $this->options as $val => $name ) {
					$is_checked = ( $val == $this->value ) ? 'selected' : '';

					echo '<li class="' . $is_checked . '" data-value="' . $val . '">' . $name . '</li>';
				}
				?>
			</ul>
			<input type="hidden" value="<?php echo esc_attr( $this->value ); ?>" <?php $this->get_input_attrs(); ?> />
		</div>
		<?php
	}
}
