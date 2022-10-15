<?php
namespace Ak\Elementor\Control;

class MediaImage extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'ak-media_image';

	/**
	 * Get select2 control default settings.
	 *
	 * Retrieve the default settings of the select2 control. Used to return the
	 * default settings while initializing the select2 control.
	 *
	 * @since 1.8.0
	 * @access protected
	 *
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return array(
			'media_title'     => __( 'Upload', 'ak-framework' ),
			'button_text'     => __( 'Select', 'ak-framework' ),
			'remove_text'     => __( 'Remove', 'ak-framework' ),
			'media_size'      => 'full',
			'media_data_type' => 'url',
		);
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see parent::render_content()
	 * @access protected
	 */
	public function render_content() {
		?>
		<div class="ak-media-image-field">
			<a class="ak-btn ak-primary-btn ak-media-image-upload-btn" data-media-data-type="{{ data.media_data_type }}" data-media-size="{{ data.media_size }}"
			data-media-title="{{ data.media_title }}" data-media-button-text="{{ data.button_text }}"><i class="fa fa-upload"></i> {{ data.button_text }}</a>
			<a class="ak-btn ak-media-image-remove-btn {{ (data.controlValue === '') ? 'ak-hidden' : '' }}"><i class="fa fa-remove"></i> {{ data.remove_text }}</a>

			<div class="ak-media-image-preview {{ (data.controlValue === '') ? 'ak-hidden' : '' }}">
				<img src="{{ data.controlValue }}" />
			</div>
			<input id="<?php echo esc_attr( $this->get_control_uid() ); ?>" class="ak-form-field-main-input" type="hidden" data-setting="{{ data.name }}" >
		</div>
		<?php
	}
}
