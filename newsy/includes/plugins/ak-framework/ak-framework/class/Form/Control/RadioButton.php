<?php
namespace Ak\Form\Control;

class RadioButton extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'radio_button';

	public function __construct( $args = array() ) {
		parent::__construct( $args );

		// remove id attr.
		if ( ! empty( $this->input_attrs['id'] ) ) {
			unset( $this->input_attrs['id'] );
		}
	}

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_script( 'ak-form-control-radio-button', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-radio-button.js', array( 'ak-form-control' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 * @access protected
	 */
	public function render_content() {
		?>
		<div class="ak-radio-button-field">
			<?php
			foreach ( (array) $this->options as $key => $val ) {
				$is_checked = ( $key == $this->value );
				?>
					<input class="switch-input" type="radio" value="<?php echo esc_attr( $key ); ?>" <?php $this->get_input_attrs(); ?>  id="<?php echo esc_attr( $this->param_name . '_' . $key ); ?>" <?php ak_sanitize_echo( $is_checked ? 'checked="checked"' : '' ); ?> />
					<label class="switch-label switch-label-<?php echo esc_attr( $is_checked ? 'on' : 'off' ); ?>" for="<?php echo esc_attr( $this->param_name . '_' . $key ); ?>">
						<?php ak_sanitize_echo( $val ); ?>
					</label>
			<?php } ?>
		</div>
		<?php
	}
}
