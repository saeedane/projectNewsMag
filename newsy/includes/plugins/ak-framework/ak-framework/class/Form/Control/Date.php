<?php
namespace Ak\Form\Control;

class Date extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'date';

	public $date_format = 'mm/dd/yy';

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_script( 'ak-form-date-control', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-date.js', array( 'ak-form-control' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 * @access protected
	 */
	public function render_content() {
		?>
		<div class="ak-date-field">
			<input type="text" value="<?php echo esc_attr( $this->value ); ?>" placeholder="<?php echo esc_attr( $this->date_format ); ?>" data-date-format="<?php echo esc_attr( $this->date_format ); ?>" <?php $this->get_input_attrs(); ?> />
		</div>
		<?php
	}
}
