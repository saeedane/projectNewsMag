<?php
namespace Ak\Form\Control;

use Ak\Form\FormBuilder;
use Ak\Form\FormManager;

class MixFields extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'mix_fields';

	/**
	 * Maximum number of options the user will be able to select.
	 * Set to 1 for single-select.
	 *
	 * @var bool
	 */
	public $return_string = false;

	/**
	 * Set defaults on empty value.
	 *
	 * @var bool
	 */
	public $defaults_on_empty = false;

	public $fields = array();

	public $fields_callback;

	public function __construct( $args = array() ) {
		parent::__construct( $args );

		// Process options_callback.
		if ( ! empty( $this->fields_callback ) ) {
			$this->fields = ak_fields_callback( $this->fields_callback );
		}

		if ( $this->defaults_on_empty && ! empty( $this->value ) ) {
			$this->default = array();
		}
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'ak-form-control-mix-fields', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-mix-fields.js', array( 'ak-form-control' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() {
		$field_classes   = array();
		$field_classes[] = 'ak-mixed-field';

		if ( $this->return_string ) {
			$field_classes[] = 'ak-mixed-string-field';
		}
		?>
		<div class="<?php echo implode( ' ', $field_classes ); ?>">
			<div class="ak-mixed-group">
				<?php
				// refactor fields
				if ( ! empty( $this->fields ) ) {
					$value = $this->value;
					if ( is_string( $this->value ) ) {
						wp_parse_str( $this->value, $value );
					}

					$manager = new FormManager(
						array(
							'input_prefix' => $this->id,
							'fields'       => $this->fields,
							'values'       => ! empty( $value ) ? $value : array(),
							'defaults'     => ! empty( $this->default ) ? $this->default : array(),
						)
					);

					$builder = new FormBuilder;
					echo $builder->render_for_mix_fields( $manager );
				}
				?>
			</div>
		</div>
		<?php
		if ( $this->return_string ) {
			?>
			<input type='hidden' value="<?php echo esc_attr( $this->value ); ?>" <?php $this->get_input_attrs(); ?>>
			<?php
		}
		?>
		<?php
	}
}
