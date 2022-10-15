<?php

namespace Ak\Form\Control;

/**
 * Switch control (modified checkbox).
 */
class Switcher extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'switcher';

	public function __construct( $args = array() ) {
		parent::__construct( $args );

		if ( empty( $this->options ) || ! is_array( $this->options ) ) {
			$this->options = array(
				'on'  => true,
				'off' => false,
			);
		}
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'ak-form-control-switcher', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-switcher.js', array( 'ak-form-control' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() {

		$checked = ( is_bool( $this->value ) && $this->value || $this->options['on'] === $this->value );
		?>
		<div class="ak-switcher-field <?php echo esc_attr( $checked ? 'checked' : '' ); ?> ">
			<input type="hidden" value="<?php echo esc_attr( $this->value ); ?>" <?php $this->get_input_attrs(); ?> />
			<div class="switch-wrap">
				<span class="switch-off" data-value="<?php echo esc_attr( $this->options['off'] ); ?>"><?php echo esc_html( $this->options['off'] ); ?></span>
				<span class="switch-on" data-value="<?php echo esc_attr( $this->options['on'] ); ?>"><?php echo esc_html( $this->options['on'] ); ?></span>
			</div>
		</div>
		<?php
	}
}
