<?php
namespace Ak\Form\Control;

class Radio extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'radio';


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

				if ( is_array( $this->value ) ) {
					$is_checked = in_array( $value, $this->value ) ? 'checked' : '';
				} else {
					$is_checked = ( $value == $this->value ) ? 'checked' : '';
				}

				?>
				<label>
					<input type="radio" value="<?php echo esc_attr( $value ); ?>" <?php $this->get_input_attrs(); ?> <?php echo esc_attr( $is_checked ); ?>/>
					<?php ak_sanitize_echo( $label ); ?>
				</label>
				<?php
			}
			?>
		</div>
		<?php
	}
}
