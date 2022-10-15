<?php
namespace Ak\Elementor\Control;

class Heading extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'ak-heading';

	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<div id="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-input-wrapper">
				<div class="ak-heading-field ak-clearfix">
					<div class="ak-heading-title ak-clearfix">
						<h3>{{{ data.label }}}</h3>
					</div>
					<# if ( data.description ) { #>
						<div class="ak-heading-desc  ak-clearfix">
							{{{ data.description }}}
						</div>
					<# } #>
				</div>
			</div>
		</div>
		<?php
	}
}
