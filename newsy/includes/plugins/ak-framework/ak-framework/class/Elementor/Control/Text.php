<?php

namespace Ak\Elementor\Control;

class Text extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'ak-text';

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see parent::render_content()
	 */
	public function render_content() {
		?>
		<div class="ak-text-field {{ data.prefix }}">
			<input id="<?php echo esc_attr( $this->get_control_uid() ); ?>" class="ak-form-field-main-input" type="text" data-selectize="1"
			data-maxitems="{{ data.maxitems ? data.maxitems : 1000 }}"  data-delimiter="{{ data.delimiter ? data.delimiter : ' ' }}"
			data-options="{{ JSON.stringify(data.options) }}" data-setting="{{ data.name }}" />
		</div>
		<?php
	}
}
