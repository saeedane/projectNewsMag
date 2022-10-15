<?php
namespace Ak\Elementor\Control;

class IconSelect extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'ak-icon_select';

	public function render_content() {  ?>
		<div class="ak-icon-select-manager ak-form-control-placeholder ak-field-suffix">
			<div class="ak-icon-selected-name">
				<# if ( data.controlValue ) { #>
					{{ data.controlValue }}
				<# } else { #>
					<?php echo __( 'Select an Icon', 'ak-framework' ); ?>
				<# } #>
			</div>
			<input id="<?php echo esc_attr( $this->get_control_uid() ); ?>" class="ak-form-field-main-input" type="hidden" data-setting="{{ data.name }}" />
			<span class="ak-span-suffix"><i class="fa fa-search"></i></span>
		</div>
		<?php
	}
}
