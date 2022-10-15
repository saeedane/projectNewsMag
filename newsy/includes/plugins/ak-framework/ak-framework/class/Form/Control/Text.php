<?php

namespace Ak\Form\Control;

class Text extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'text';

	/**
	 * Text Field Prefix.
	 *
	 * @var string
	 */
	public $prefix = '';

	/**
	 * Text Field Suffix.
	 *
	 * @var string
	 */
	public $suffix = '';

	public $selectize = false;

	public $maxitems = 100;

	public $delimiter = ',';

	public function __construct( $args = array() ) {
		parent::__construct( $args );

		if ( $this->selectize ) {
			$this->input_attrs['data-selectize'] = $this->selectize;
			$this->input_attrs['data-maxitems']  = $this->maxitems;
			$this->input_attrs['data-delimiter'] = $this->delimiter;

			$this->input_attrs['data-options'] = json_encode( $this->options );
		}
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_style( 'selectize' );
		wp_enqueue_script( 'ak-form-control-text', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-text.js', array( 'jquery', 'ak-form-control', 'selectize' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() {
		$field_classes   = array();
		$field_classes[] = 'ak-text-field';

		if ( ! empty( $this->prefix ) ) {
			$field_classes[] = 'ak-field-prefix';
		}
		if ( ! empty( $this->suffix ) ) {
			$field_classes[] = 'ak-field-suffix';
		} ?>
		<div class="<?php echo implode( ' ', $field_classes ); ?>">
			<input type="text" value="<?php echo esc_html( $this->value ); ?>" <?php $this->get_input_attrs(); ?> />
			<?php
			if ( ! empty( $this->prefix ) ) {
				?>
				<span class="ak-span-prefix"><?php ak_sanitize_echo( $this->prefix ); ?></span>
				<?php
			}
			if ( ! empty( $this->suffix ) ) {
				?>
				<span class="ak-span-suffix"><?php ak_sanitize_echo( $this->suffix ); ?></span>
				<?php
			}
			?>
		</div>
		<?php
	}
}
