<?php
namespace Ak\Form\Control;

class CustomField extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'custom_field';


	public $html = '';

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		// incase custom field has an input
		wp_enqueue_script( 'ak-form-control-custom-field', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-custom-field.js', array( 'ak-form-control' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 * @access protected
	 */
	public function render_content() {
		?>
		<div class="ak-custom-field">
			<?php ak_sanitize_echo( $this->html ); ?>
		</div>
		<?php
	}
}
