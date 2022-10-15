<?php

namespace Ak\Elementor\Control;

class SliderUnit extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'ak-slider_unit';

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
			'min'          => 0,
			'max'          => 1000,
			'step'         => 1,
			'default_unit' => 'px',
			'units'        => array(
				'px',
				'em',
				'rem',
				'vh',
				'vw',
				'%',
			),
		);
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() {
		?>
		<div class="ak-slider-field {{ data.prefix }}">
			<div class="ak-slider-spinner"></div>
			<div class="ak-slider-input">
				<input id="<?php echo esc_attr( $this->get_control_uid() ); ?>"
				class="ak-form-field-main-input"
				type="hidden"
				value="{{ data.controlValue }}"
				data-min="{{ data.min }}"
				data-max="{{ data.max }}" data-step="{{ data.step }}" data-setting="{{ data.name }}" />
				<input type="text" placeholder="-" class="ak-slider-unit-input" />
				<div class="ak-slider-unit-input-selection">
					<span class="ak-unit-input-unit">{{ data.default_unit }}</span>
					<ul class="ak-unit-input-choices">
					<# _.each( data.units, function( unit ) { #>
						<li data-unit="{{ unit }}">{{ unit }}</li>
					<# } ); #>
					</ul>
				</div>
			</div>
		</div>
		<?php
	}
}
