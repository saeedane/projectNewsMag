<?php

namespace Ak\Form\Control;

use Ak\Form\FormBuilder;
use Ak\Form\FormManager;

class Repeater extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'repeater';

	/**
	 * Maximum number of options the user will be able to select.
	 * Set to 1 for single-select.
	 *
	 * @var int
	 */
	public $sorter = true;

	public $repeat_heading = '';

	public $add_button_name = '';

	public $max_items = 1000;

	public $fields = array();

	public $fields_callback = '';

	public $repeat_title_field = 'name';

	public function __construct( $args = array() ) {
		parent::__construct( $args );

		// Process options_callback.
		if ( ! empty( $this->fields_callback ) ) {
			$this->fields = ak_fields_callback( $this->fields_callback );
		}

		if ( empty( $this->add_button_name ) ) {
			$this->add_button_name = __( 'Add More', 'ak-framework' );
		}

		if ( empty( $this->repeat_heading ) ) {
			$this->repeat_heading = ! empty( $this->heading ) ? $this->heading : __( 'Item', 'ak-framework' );
		}
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		FormManager::enqueue_control( 'mix_fields' );
		wp_enqueue_script( 'ak-form-control-repeater', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-repeater.js', array( 'ak-form-control' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() {
		$field_classes   = array();
		$field_classes[] = 'ak-repeater-field';

		if ( $this->sorter ) {
			$field_classes[] = 'ak-sorter-enabled';
		}
		?>
		<div class="<?php echo implode( ' ', $field_classes ); ?>" data-max="<?php echo esc_attr( $this->max_items ); ?>"  data-repeat-title-field="<?php echo esc_attr( $this->repeat_title_field ); ?>">
			<?php
			$output = '<div class="ak-mixed-group ak-repeater-group">';
			foreach ( (array) $this->value as $v_key => $v_field ) {
				$output .= '<div class="ak-repeater-group-container ak-close">';

				$output .= $this->get_repeater_header();

				$output .= '<div class="ak-repeater-row-content">';

				$repeat_fields = array(
					'param_name' => $this->id . "[{$v_key}]",
					'id'         => $this->id . "[{$v_key}]",
					'value'      => ! empty( $v_field ) ? $v_field : null,
					'type'       => 'mix_fields',
					'fields'     => $this->fields,
				);

				$output .= FormBuilder::render_field( $repeat_fields, true );

				$output .= '</div></div>';

				unset( $field );
			}

			$output .= '</div>';

			$output .= $this->get_repeater_noscript();

			ak_sanitize_echo( $output );
			?>
			<button class="ak-btn ak-secondary-btn ak-full-btn ak-field-repeater-button"><i class="ak-icon ak-fa fa fa-plus"></i> <?php echo esc_html( $this->add_button_name ); ?></button>
		</div>
		<?php
	}

	public function get_repeater_noscript() {

		$repeat_x = array(
			'param_name' => $this->id . '[%%v_key%%]',
			'id'         => $this->id . '[%%v_key%%]',
			'type'       => 'mix_fields',
			'fields'     => $this->fields,
		);

		$output  = '<div class="ak-repeater-group-container ak-close">';
		$output .= $this->get_repeater_header();
		$output .= '<div class="ak-repeater-row-content">';
		$output .= FormBuilder::render_field( $repeat_x, true );
		$output .= '</div></div>';

		return '<noscript>' . $output . '</noscript>';
	}

	public function get_repeater_header() {
		$output  = '<div class="ak-repeater-row-header">';
		$output .= '<div class="ak-repeater-row-header-label"><strong>' . $this->repeat_heading . '</strong><em class="ak-repeater-row-name"></em> <span>' . __( '(click to open)', 'ak-framework' ) . '</span></div>';

		$output .= '<div class="ak-repeater-row-header-controls">';
		if ( $this->sorter ) {
			$output .= '<button class="ak-btn ak-secondary-btn ak-field-sorter-button"><i class="ak-icon ak-fa fa fa-arrows-alt"></i></button>';
		}
		$output .= '<button class="ak-btn ak-secondary-btn ak-field-remove-button"><i class="ak-icon ak-fa fa fa-trash"></i></button>';

		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
}
