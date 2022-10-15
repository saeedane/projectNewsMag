<?php
namespace Ak\Elementor\Control;

class AjaxSelect extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'ak-ajax_select';

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
			'max_items'          => 1000,
			'ajax_callback'      => '',
			'ajax_callback_args' => array(),
			'exculable'          => false,
		);
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see parent::render_content()
	 * @access protected
	 */
	public function render_content() {
		?>
		<div class='ak-ajax-select-field'>
			<input type="text" id="<?php echo esc_attr( $this->get_control_uid() ); ?>"
			class="ak-form-field-main-input {{  data.exculable ? 'ak-exculable-field' : '' }}"
			data-setting="{{ data.name }}"
			data-callback="{{ data.ajax_callback }}"
			data-callback-args="{{ data.ajax_callback_args ? JSON.stringify(data.ajax_callback_args) : '' }}"
			data-max-items="{{ data.max_items }}"
			data-exculable="{{ data.exculable }}"
			data-selectize-value="{{ data.controlValue }}">
		</div>
		<?php
	}
}
