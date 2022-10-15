<?php
namespace Ak\Form\Control;

class Info extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'info';

	public $info_type = 'note';

	public $state = 'open';

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
				<?php
				$this->render_content();
				if ( ! empty( $this->input_desc ) ) {
					?>
				<div class="input-desc"><?php ak_sanitize_echo( $this->input_desc ); ?></div>
					<?php
				}
				?>
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
		$icon = 'fa-info';
		if ( 'note' === $this->info_type ) {
			$icon = 'fa-thumb-tack';
		} elseif ( 'info' === $this->info_type ) {
			$icon = 'fa-info-circle';
		} elseif ( 'tip' === $this->info_type ) {
			$icon = 'fa-flash';
		} elseif ( 'warning' === $this->info_type ) {
			$icon = 'fa-times-circle';
		}
		?>
		<div class="ak-info-field <?php echo esc_attr( $this->info_type ) . ' ' . esc_attr( $this->state ); ?>">

			<div class="ak-info-field-title ak-clearfix">
				<i class="ak-icon fa <?php echo esc_html( $icon ); ?>"></i>
				<?php echo esc_html( $this->heading ); ?>
			</div>
			<?php if ( ! empty( $this->description ) ) { ?>
				<div class="ak-info-field-desc  ak-clearfix">
					<?php ak_sanitize_echo( $this->description ); ?>
				</div>
				<?php
			}
			?>
			<input type="hidden" <?php $this->get_input_attrs(); ?> />
		</div>
		<?php
	}
}
