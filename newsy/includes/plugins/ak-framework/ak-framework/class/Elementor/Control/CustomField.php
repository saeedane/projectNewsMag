<?php
namespace Ak\Elementor\Control;

class CustomField extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'ak-custom_field';


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
			'html' => '',
		);
	}

	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<div id="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-input-wrapper">
				<div class="ak-custom-field ak-clearfix">
					{{{ data.html }}}
				</div>
			</div>
		</div>
		<?php
	}
}
