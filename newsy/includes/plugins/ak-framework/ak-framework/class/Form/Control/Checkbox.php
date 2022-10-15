<?php
namespace Ak\Form\Control;
class Checkbox extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'checkbox';


	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 * @access protected
	 */
	public function render_content() {

		?>
		<div>
			<?php
			foreach ( (array) $this->options as $value => $label ) {
				if ( empty( $label ) ) {
					continue;
				}

				$is_checked = is_array( $this->value ) && in_array( $value, $this->value ) ? 'checked' : '';
				?>

				<label for=""><?php echo esc_html( $label ); ?>
				<input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php $this->get_input_attrs(); ?> <?php echo esc_attr( $is_checked ); ?>/>
				</label>
				<?php
			}
			?>
		</div>
		<?php
	}
}
