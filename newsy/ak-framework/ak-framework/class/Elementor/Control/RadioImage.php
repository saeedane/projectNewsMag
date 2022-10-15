<?php

namespace Ak\Elementor\Control;

class RadioImage extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'ak-radio_image';

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see parent::render_content()
	 */
	public function render_content() {
		?>
		<div class="ak-radio-image-field">
			<ul>
			<# _.each( data.options, function( option, option_value ) {
				var value = data.controlValue;
				if ( typeof value == 'string' ) {
					var selected = ( option_value === value ) ? 'selected' : '';
				} else if ( null !== value ) {
					var value = _.values( value );
					var selected = ( -1 !== value.indexOf( option_value ) ) ? 'selected' : '';
				}
				#>
				<li  class="{{ selected }}"  data-value="{{ option_value }}" data-toggle="tooltip" data-placement="bottom" title="{{ option.label }}"><img src="{{ option.img }}" /></li>
				<# } ); #>
			</ul>
			<input id="<?php echo esc_attr( $this->get_control_uid() ); ?>" class="ak-form-field-main-input" type="hidden" data-setting="{{ data.name }}" />
		</div>
		<?php
	}
}
