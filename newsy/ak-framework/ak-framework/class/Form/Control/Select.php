<?php
namespace Ak\Form\Control;

class Select extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'select';

	/**
	 * Maximum number of options the user will be able to select.
	 * Set to 1 for single-select.
	 *
	 * @var int|bool
	 */
	public $multiple = false;

	public $selectize = false;

	public $exculable = false;

	public $return_string = true;

	public function __construct( $args = array() ) {
		parent::__construct( $args );

		// inner options_callback
		if ( isset( $this->options['options_callback'] ) ) {
			$callback_options = ak_fields_callback( $this->options['options_callback'] );
			unset( $this->options['options_callback'] );
			$this->options = ak_merge_args( $this->options, $callback_options );
		}

		$this->input_attrs['data-selectize'] = $this->selectize;

		$this->input_attrs['data-multiple'] = $this->multiple;

		// force string in vc field
		if ( $this->vc_field ) {
			$this->return_string = true;
		}

		if ( false !== $this->multiple && $this->multiple > 1 ) {
			if ( is_string( $this->value ) ) {
				$this->value = explode( ',', $this->value );
			}

			if ( $this->return_string ) {
				// force selectize on multi
				$this->input_attrs['data-return-string'] = true;
			} else {
				$this->input_attrs['multiple'] = 'multiple';
			}

			$this->input_attrs['data-selectize'] = true; // force selectize for multiple
			$this->input_attrs['data-options']   = json_encode( $this->options );
			$this->input_attrs['data-values']    = json_encode( $this->value );

			if ( $this->exculable ) {
				$this->input_attrs['class']         .= ' ak-exculable-field';
				$this->input_attrs['data-exculable'] = true;
			}
		}
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_style( 'selectize' );
		wp_enqueue_script( 'ak-form-control-select', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-select.js', array( 'ak-form-control', 'selectize' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() { ?>
		<div class='ak-select-field'>
		<?php
		if ( $this->multiple && $this->multiple > 1 ) {

			if ( $this->return_string ) {
				?>
				<input type="text" <?php $this->get_input_attrs(); ?>>
				<?php
			} else {
				?>
				<select <?php $this->get_input_attrs(); ?>>
				<?php

				foreach ( $this->value as  $val ) {
					?>
					<option value="<?php echo esc_attr( $val ); ?>"  selected="selected"><?php echo esc_html( $this->get_option_name( $val ) ); ?></option>
					<?php
				}
				?>
				</select>
				<?php

			}
		} else {
			?>
			<select <?php $this->get_input_attrs(); ?>>
			<?php
			foreach ( $this->options as $key => $val ) {
				if ( isset( $val['label'] ) ) {
					echo "<optgroup label=\"{$val['label']}\">{$val['label']}";
					foreach ( $val['options'] as $o_key => $o_val ) {
						?>
							<option value="<?php echo esc_attr( $o_key ); ?>" <?php ak_sanitize_echo( $this->compare_select( $o_key ) ? 'selected="selected"' : '' ); ?>><?php echo esc_html( $o_val ); ?></option>
						<?php
					}
					echo '</optgroup>';
				} else {
					?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php ak_sanitize_echo( $this->compare_select( $key ) ? 'selected="selected"' : '' ); ?>><?php echo esc_html( $val ); ?></option>
					<?php
				}
			}
			?>
			</select>
			<?php
		}
		?>
		</div>
		<?php
	}

	public function compare_select( $key ) {

		if ( $this->multiple && $this->multiple > 1 ) {
			if ( is_array( $this->value ) ) {
				return in_array( $key, $this->value );
			}
		}

		return $key == $this->value;
	}

	public function get_option_name( $_key ) {

		foreach ( $this->options as $key => $val ) {
			if ( isset( $val['options'] ) && isset( $val['options'][ $_key ] ) ) {
				return $val['options'][ $_key ];
			} elseif ( $key === $_key ) {
				return $val;
			}
		}

		return '';
	}
}
