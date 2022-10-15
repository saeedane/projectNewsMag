<?php
namespace Ak\Form\Control;

class Heading extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'heading';


	/**
	 * Wrap the input in a section.
	 *
	 * This class is for setting options
	 *
	 * @return string
	 */
	public function render() {      ?>
		<div <?php $this->get_control_attrs(); ?>>
			<div class="ak-form-control-content">
				<?php $this->render_content(); ?>
			</div>
		</div>
			<?php
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 * @access protected
	 */
	public function render_content() {
		?>
		<div class="ak-heading-field ak-clearfix">
			<div class="ak-heading-title ak-clearfix">
				<h3><?php echo esc_html( $this->heading ); ?></h3>
			</div>
			<?php if ( ! empty( $this->description ) ) { ?>
				<div class="ak-heading-desc ak-clearfix"><?php echo esc_html( $this->description ); ?></div>
			<?php } ?>
			<input type="hidden" <?php $this->get_input_attrs(); ?> />
		</div>
		<?php
	}
}
