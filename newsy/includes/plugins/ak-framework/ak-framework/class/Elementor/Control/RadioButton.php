<?php
namespace Ak\Elementor\Control;

class RadioButton extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'ak-radio_button';

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see parent::render_content()
	 * @access protected
	 */
	public function render_content() {
		$control_uid = $this->get_control_uid( '{{value}}' );
		?>
		<div class="ak-radio-button-field">
			<# _.each( data.options, function( label, value ) { #>
			<input id="<?php echo esc_attr( $control_uid ); ?>" class="switch-input" type="radio" name="elementor-choose-{{ data.name }}-{{ data._cid }}" value="{{ value }}">
			<label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-choices-label switch-label switch-label-{{ data.controlValue === value ? 'on' : 'off' }}">
				{{{ label }}}
			</label>
			<# } ); #>
		</div>
		<?php
	}
}
