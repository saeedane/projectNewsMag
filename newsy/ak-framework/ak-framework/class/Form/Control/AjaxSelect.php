<?php
namespace Ak\Form\Control;

class AjaxSelect extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'ajax_select';

	/**
	 * Maximum number of options the user will be able to select.
	 * Set to 1 for single-select.
	 *
	 * @access public
	 * @var int|bool
	 */
	public $max_items = 1000;

	public $ajax_callback = '';

	public $ajax_callback_args = array();

	public $exculable = false;

	public function __construct( $args = array() ) {
		parent::__construct( $args );

		if ( ! isset( $args['id'] ) ) {
			return;
		}

		$this->input_attrs['data-max-items'] = $this->max_items;

		if ( ! empty( $this->ajax_callback ) ) {
			$this->input_attrs['data-callback'] = $this->ajax_callback;
		}

		if ( ! empty( $this->ajax_callback_args ) && is_array( $this->ajax_callback_args ) ) {
			$this->ajax_callback_args = json_encode( $this->ajax_callback_args );

			$this->input_attrs['data-callback-args'] = $this->ajax_callback_args;
		}

		if ( ! empty( $this->get_value() ) ) {
			$this->input_attrs['data-selectize-value'] = $this->get_value();
		}

		$this->input_attrs['data-exculable'] = $this->exculable;
		if ( $this->exculable ) {
			$this->input_attrs['class'] .= ' ak-exculable-field';
		}
	}

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_script( 'ak-form-control-ajax-select', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-ajax-select.js', array( 'ak-form-control', 'selectize' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 * @access protected
	 */
	public function render_content() {
		?>
		<div class='ak-ajax-select-field'>
			<input type='text' value="<?php echo esc_attr( $this->value ); ?>" <?php $this->get_input_attrs(); ?> />
		</div>
		<?php
	}
}
