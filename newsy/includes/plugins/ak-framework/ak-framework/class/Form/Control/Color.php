<?php
namespace Ak\Form\Control;

class Color extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'color';

	/**
	 * Colorpicker palette
	 *
	 * @access public
	 * @var bool
	 */
	public $palette = true;

	/**
	 * Colorpicker palette
	 *
	 * @access public
	 * @var bool
	 */
	public $alpha = true;

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker-alpha', AK_FRAMEWORK_URL . '/assets/lib/wp-color-picker-alpha.js', array( 'wp-color-picker' ), AK_FRAMEWORK_VERSION, true );

		$color_picker_strings = array(
			'clear'            => __( 'Clear', 'ak-framework' ),
			'clearAriaLabel'   => __( 'Clear color', 'ak-framework' ),
			'defaultString'    => __( 'Default', 'ak-framework' ),
			'defaultAriaLabel' => __( 'Select default color', 'ak-framework' ),
			'pick'             => __( 'Select Color', 'ak-framework' ),
			'defaultLabel'     => __( 'Color value', 'ak-framework' ),
		);
		wp_localize_script( 'wp-color-picker-alpha', 'wpColorPickerL10n', $color_picker_strings );

		wp_enqueue_script( 'ak-form-control-color', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-color.js', array( 'ak-form-control', 'wp-color-picker-alpha' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 * @access public
	 */
	public function render_content() {
		?>
		<div class="ak-color-field">
			<input type="text" data-palette="<?php echo esc_attr( $this->palette ); ?>" data-alpha-enabled="<?php echo esc_attr( $this->alpha ); ?>"  data-default-color="<?php echo esc_attr( $this->default ); ?>"
			value="<?php echo esc_attr( $this->value ); ?>" <?php $this->get_input_attrs(); ?> />
		</div>
		<?php
	}
}
