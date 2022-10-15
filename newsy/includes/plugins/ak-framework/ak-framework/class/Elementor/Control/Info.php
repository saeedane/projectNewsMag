<?php
namespace Ak\Elementor\Control;

class Info extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'ak-info';

	protected function get_default_settings() {
		return array(
			'info_type' => 'note',
			'state'     => 'open',
		);
	}

	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<div id="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-input-wrapper">
				<div class="ak-info-field {{ data.info_type }} {{ data.state }}">
					<div class="ak-info-field-title ak-clearfix">
						<#
						var icon = 'fa-info';
						if ( 'note' == data.info_type ) {
							icon = 'fa-thumb-tack';
						} else if ( 'info' == data.info_type ) {
							icon = 'fa-info-circle';
						} else if ( 'tip' == data.info_type ) {
							icon = 'fa-flash';
						} else if ( 'warning' == data.info_type ) {
							icon = 'fa-times-circle';
						}
						#>
						<i class="ak-icon fa {{ icon }}"></i>
						<strong>{{{ data.label }}}</strong>
					</div>
					<# if ( data.description ) { #>
						<div class="ak-info-field-desc  ak-clearfix">
							{{{ data.description }}}
						</div>
					<# } #>
				</div>
			</div>
		</div>
		<?php
	}
}
