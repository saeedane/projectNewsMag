<?php

namespace Ak\Form\Control;

class RadioIcon extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'radio_icon';

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'ak-form-control-radio-icon', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-radio-icon.js', array( 'ak-form-control' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() {
		$field_class = 'cols-' . count( $this->options );

		?>
		<div class="ak-radio-icon-field ">
			<ul  class="ak-choose ak-choose-condensed <?php echo esc_attr( $field_class ); ?>">
				<?php
				foreach ( (array) $this->options as $val => $option ) {
					$is_checked = ( $val == $this->value ) ? 'ak-active' : '';
					$icon       = ! empty( $option['icon'] ) ? $option['icon'] : 'fa fa-check';
					$label      = ! empty( $option['label'] ) ? $option['label'] : $val;

					$out  = '<li class="' . esc_attr( $is_checked ) . '" data-value="' . esc_attr( $val ) . '" data-title="' . esc_attr( $label ) . '">';
					$out .= '<i class="ak-icon ak-fa ' . esc_attr( $icon ) . '" aria-hidden="true"></i>';
					$out .= '</li>';

					ak_sanitize_echo( $out );
				}
				?>
			</ul>
			<input type="hidden" value="<?php echo esc_attr( $this->value ); ?>" <?php $this->get_input_attrs(); ?> />
		</div>
		<?php
	}
}
