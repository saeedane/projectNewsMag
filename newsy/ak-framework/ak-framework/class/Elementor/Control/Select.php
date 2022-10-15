<?php
namespace Ak\Elementor\Control;

class Select extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'ak-select';

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
			'options'       => array(),
			'selectize'     => false,
			'multiple'      => false,
			'exculable'     => false,
			'return_string' => true,
		);
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see parent::render_content()
	 */
	public function render_content() { ?>
		<div class="ak-select-field">
		<# if( data.multiple && data.multiple > 1 ) {
			var value = data.controlValue;

			if ( typeof value == 'string' ) {
				value = value.split(',');
			}
			#>
			<# if( data.return_string ) { #>
				<input id="<?php echo esc_attr( $this->get_control_uid() ); ?>" class="ak-form-field-main-input {{  data.exculable ? 'ak-exculable-field' : '' }}" type="text" data-setting="{{ data.name }}" data-return-string="1" data-selectize="1"
				data-multiple="{{ data.multiple }}" data-exculable="{{ data.exculable }}" data-options="{{ JSON.stringify(data.options) }}"  data-values="{{ JSON.stringify(value) }}">
			<# } else { #>
				<select id="<?php echo esc_attr( $this->get_control_uid() ); ?>" class="ak-form-field-main-input {{  data.exculable ? 'ak-exculable-field' : '' }}" data-setting="{{ data.name }}" data-selectize="1" data-multiple="{{ data.multiple }}"
				data-exculable="{{ data.exculable }}" data-options="{{ JSON.stringify(data.options) }}" data-values="{{ JSON.stringify(value) }}">
				<# _.each( value, function( option ) {
					var option_value = ( data.options[option] ) ? data.options[option] : '';
					#>
					<option value="{{ option }}" selected>{{ option_value }}</option>
					<# } ); #>
				</select>
			<# } #>
		<# } else { #>
			<select id="<?php echo esc_attr( $this->get_control_uid() ); ?>" class="ak-form-field-main-input" data-setting="{{ data.name }}" data-selectize="{{ data.selectize }}" >
				<# _.each( data.options, function( option, option_value ) {
					if ( typeof option == 'string' ) {
						#>
						<option value="{{ option_value }}">{{ option }}</option>
						<#
					}else{
						#>
						<optgroup label="{{ option.label }}">{{ option.label }}
						<#

						_.each( option.options, function( _option, _option_value ) {
							#>
							<option value="{{ _option_value }}">{{ _option }}</option>
							<#
						} );

						#>
						</optgroup>
						<#
					}
				} ); #>
			</select>
		<# } #>
		</div>
		<?php
	}

}
