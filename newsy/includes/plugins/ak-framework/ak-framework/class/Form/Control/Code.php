<?php
namespace Ak\Form\Control;

class Code extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'code';

	public $mode = 'htmlmixed';

	public $min_lines = 10;

	public $max_lines = 15;

	public function __construct( $args = array() ) {
		parent::__construct( $args );

		$this->input_attrs['data-min-lines'] = $this->min_lines;
		$this->input_attrs['data-max-lines'] = $this->max_lines;
		$this->input_attrs['data-mode']      = $this->mode;
	}


	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_code_editor(
			array(
				'codemirror' => array(
					'mode' => $this->mode,
				),
			)
		);

		wp_enqueue_script( 'ak-form-control-code', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-code.js', array( 'ak-form-control' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 * @access protected
	 */
	public function render_content() {
		?>
		<div class="ak-code-field">
			<textarea <?php $this->get_input_attrs(); ?>><?php ak_sanitize_echo( $this->get_value() ); ?></textarea>
		</div>
		<?php
	}
}
