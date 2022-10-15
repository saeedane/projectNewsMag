<?php

namespace Ak\Elementor\Control;

/**
 * VisualCheckbox control.
 */
class VisualCheckbox extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'ak-visual_checkbox';


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
			'vertical' => false,
			'sorter'   => false,
		);
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see parent::render_content()
	 */
	public function render_content() {
		?>
		<div class="ak-visual-checkbox-field">
			<ul class="ak-vcheckbox-fields {{ (data.vertical ) ? 'vertical' : 'horizontal' }} {{ (data.sorter ) ? 'sorter-enabled' : '' }}">
			<# _.each( data.options, function( label, option_value ) {
				var value = data.controlValue;
				if ( typeof value == 'string' ) {
					var selected = ( option_value === value ) ? 'checked' : '';
				} else if ( null !== value ) {
					var value = _.values( value );
					var selected = ( -1 !== value.indexOf( option_value ) ) ? 'checked' : '';
				}
				#>
				<li  class="{{ selected }}"  data-value="{{ option_value }}">
					<i class="ak-icon ak-fa fa fa-quote-left fa-pull-left fa-border ak-vcheckbox-checkbox" aria-hidden="true"></i>
					<span>{{{ label }}}</span>
					<# if ( data.sorter ) { #>
						<div class="ak-field-sorter-button"><i class="ak-icon ak-fa fa fa-arrows-alt"></i></div>
					<# } #>
				</li>
				<# } ); #>
			</ul>
			<input id="<?php echo esc_attr( $this->get_control_uid() ); ?>" class="ak-form-field-main-input" type="hidden" data-setting="{{ data.name }}" />
		</div>
		<?php
	}

}
