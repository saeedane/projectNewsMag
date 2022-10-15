<?php

namespace Ak\Customizer\Control;

/**
 * Create a simple number control.
 */
class Heading extends ControlAbstract {
	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'ak_heading';

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'ak-customizer-control-heading', AK_FRAMEWORK_URL . '/assets/js/customizer/controls/control-heading.js', array( 'jquery', 'customize-base' ), null, true );
	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding
	 *
	 * @see WP_Customize_Control::print_template()
	 */
	protected function content_template() {  ?>
		<label>
			<# if ( data.label ) { #>
				<h2 class="customize-control-title" tabindex="">{{{ data.label }}}</h2>
			<# } #>
			<# if ( data.description ) { #>
				<em class="description customize-control-description">{{{ data.description }}}</em>
			<# } #>
		</label>
		<?php
	}

	protected function render() {}
	protected function render_content() {}
}
