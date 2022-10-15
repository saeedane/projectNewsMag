<?php
namespace Ak\Form\Control;

class Media extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'media';

	public $media_title = 'Upload';

	public $button_text = 'Upload';

	public $media_type = 'image';

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		wp_enqueue_script( 'ak-form-control-media', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-media.js', array( 'ak-form-control' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 * @access protected
	 */
	public function render_content() {      ?>
		<div class="ak-media-field">
			<input type="text" value="<?php echo esc_attr( $this->get_value() ); ?>" <?php $this->get_input_attrs(); ?>/>
			<a class="ak-btn ak-primary-btn ak-media-upload-btn"  data-media-type="<?php echo esc_attr( $this->media_type ); ?>" data-media-title="<?php echo  esc_attr( $this->media_title ); ?>"
			data-media-button-text="<?php echo esc_attr( $this->button_text ); ?>"><i class="fa fa-upload"></i> <?php echo esc_attr( $this->button_text ); ?></a>
		</div>
		<?php
	}
}
