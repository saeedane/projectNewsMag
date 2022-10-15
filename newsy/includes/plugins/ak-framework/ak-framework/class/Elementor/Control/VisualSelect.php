<?php

namespace Ak\Elementor\Control;

class VisualSelect extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'ak-visual_select';

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
			'options'  => array(),
			'switcher' => false,
			'vertical' => false,
		);
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see parent::render_content()
	 */
	public function render_content() {
		?>
		<div class="ak-visual-select-field {{  data.vertical ? 'vertical' : 'horizontal' }} {{  data.switcher ? 'vertical switcher' : '' }}">
			<ul>
			<# _.each( data.options, function( option, option_value ) {
				var selected = ( option_value === data.controlValue ) ? 'selected' : '';
				#>
				<li  class="{{ selected }}"  data-value="{{ option_value }}">{{{ option }}}</li>
				<# } ); #>
			</ul>
			<input id="<?php echo esc_attr( $this->get_control_uid() ); ?>" class="ak-form-field-main-input" type="hidden" data-setting="{{ data.name }}" >
		</div>
		<?php
	}
}
