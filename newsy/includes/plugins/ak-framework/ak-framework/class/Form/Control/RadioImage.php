<?php

namespace Ak\Form\Control;

class RadioImage extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'radio_image';

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'ak-form-control-radio-image', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-radio-image.js', array( 'ak-form-control' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see ControlAbstract::render_content()
	 */
	public function render_content() {      ?>
		<div class="ak-radio-image-field">
			<ul>
				<?php
				foreach ( (array) $this->options as $key => $val ) {
					$is_checked = ( $key == $this->value ) ? 'selected' : '';
					?>
					<li class="<?php echo esc_attr( $is_checked ); ?>" data-value="<?php echo esc_attr( $key ); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo isset( $val['label'] ) ? esc_attr( $val['label'] ) : ''; ?>">
						<img src="<?php echo esc_url( $val['img'] ); ?>">
					</li>
					<?php
				}
				?>
			</ul>
			<input type="hidden" value="<?php echo esc_attr( $this->get_value() ); ?>" <?php $this->get_input_attrs(); ?> />
		</div>
		<?php
	}
}
