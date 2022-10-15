<?php
namespace Ak\Form\Control;

class MediaImage extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'media_image';

	public $media_title = 'Upload';

	public $button_text = 'Select';

	public $remove_text = 'Remove';

	public $media_size = 'full';

	public $media_data_type = 'url';

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_script( 'ak-form-control-media-image', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-media-image.js', array( 'ak-form-control' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 * @access protected
	 */
	public function render_content() {
		if ( 'id' === $this->media_data_type && ! empty( $this->value ) ) {
			$value   = wp_get_attachment_image_src( $this->value, $this->media_size );
			$preview = ! empty( $value[0] ) ? $value[0] : '';
		} else {
			$preview = $this->value;
		}

		$hidden = empty( $this->value ) ? 'ak-hidden' : '';
		?>
		<div class="ak-media-image-field">
			<a class="ak-btn ak-primary-btn ak-media-image-upload-btn" data-media-data-type="<?php echo esc_attr( $this->media_data_type ); ?>" data-media-size="<?php echo esc_attr( $this->media_size ); ?>"
			data-media-title="<?php echo esc_attr( $this->media_title ); ?>" data-media-button-text="<?php echo esc_attr( $this->button_text ); ?>"><i class="fa fa-upload"></i> <?php echo esc_attr( $this->button_text ); ?></a>
			<a class="ak-btn ak-media-image-remove-btn <?php echo esc_attr( $hidden ); ?>"><i class="fa fa-remove"></i> <?php echo esc_attr( $this->remove_text ); ?></a>

			<div class="ak-media-image-preview <?php echo esc_attr( $hidden ); ?>">
				<img src="<?php echo esc_url( $preview ); ?>" class="" />
			</div>

			<input type="hidden" value="<?php echo esc_attr( $this->value ); ?>" <?php $this->get_input_attrs(); ?>/>
		</div>
		<?php
	}
}
