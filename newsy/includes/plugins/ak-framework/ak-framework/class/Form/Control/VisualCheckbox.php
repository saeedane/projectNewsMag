<?php

namespace Ak\Form\Control;

/**
 * VisualCheckbox control.
 */
class VisualCheckbox extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'visual_checkbox';

	/**
	 * Maximum number of options the user will be able to select.
	 * Set to 1 for single-select.
	 *
	 * @var int
	 */
	public $vertical = false;

	public $sorter = false;

	public function __construct( $args = array() ) {
		parent::__construct( $args );

		if ( empty( $this->value ) ) {
			$this->value = array();
		} elseif ( is_string( $this->value ) ) {
			$this->value = explode( ',', $this->value );
		}
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'ak-form-control-visual-checkbox', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-visual-checkbox.js', array( 'ak-form-control' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() {
		$field_class = array();

		if ( $this->vertical ) {
			$field_class[] = 'vertical';
		} else {
			$field_class[] = 'horizontal';
		}

		if ( $this->sorter ) {
			$field_class[] = 'sorter-enabled';
		}

		?>
		<div class="ak-visual-checkbox-field">
			<ul class="ak-vcheckbox-fields <?php echo implode( ' ', $field_class ); ?>">
				<?php
				foreach ( (array) $this->options as $value => $label ) {
					if ( empty( $value ) || empty( $label ) ) {
						continue;
					}

					$is_checked = in_array( $value, $this->value ) ? 'checked' : '';
					?>
					<li class="<?php echo esc_attr( $is_checked ); ?>" data-value="<?php echo esc_attr( $value ); ?>">
						<i class="ak-icon ak-fa fa fa-quote-left fa-pull-left fa-border ak-vcheckbox-checkbox" aria-hidden="true"></i>
						<span><?php ak_sanitize_echo( $label ); ?></span>
						<?php
						if ( $this->sorter ) {
							echo '<div class="ak-field-sorter-button"><i class="ak-icon ak-fa fa fa-arrows-alt"></i></div>';
						}
						?>
					</li>
					<?php
				}
				?>
			</ul>
			<input type="hidden" value="<?php echo implode( ',', $this->value ); ?>" <?php $this->get_input_attrs(); ?> />
		</div>
		<?php
	}
}
