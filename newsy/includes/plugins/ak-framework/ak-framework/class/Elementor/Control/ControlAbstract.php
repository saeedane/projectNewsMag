<?php

namespace Ak\Elementor\Control;

use \Elementor\Base_Data_Control;
use Ak\Form\FormManager;

/**
 * The parent class for all Ak Framework controls.
 * Other controls should extend this object.
 */
abstract class ControlAbstract extends Base_Data_Control {
		/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = '';

	public function get_type() {
		return $this->type;
	}

	public function get_ak_form_type() {
		return str_replace( 'ak-', '', $this->type );
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		FormManager::enqueue_control( $this->get_ak_form_type() );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see parent::render_content()
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field ak-elementor-control-field" data-param_type="<?php echo esc_attr( $this->get_ak_form_type() ); ?>" data-param_name="{{ data.name }}">
			<label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
			<?php $this->render_content(); ?>
			</div>
		</div>
		<# if ( data.description ) { #>
			<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<script>
			(function($){
				window.ak_init_control($('#<?php echo esc_attr( $control_uid ); ?>'));
			})(jQuery);
		</script>
		<?php
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see ControlAbstract::render_content()
	 */
	public function render_content() {}
}
