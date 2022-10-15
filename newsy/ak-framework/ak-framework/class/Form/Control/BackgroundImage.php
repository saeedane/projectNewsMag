<?php
namespace Ak\Form\Control;

use Ak\Form\FormBuilder;
use Ak\Form\FormManager;

class BackgroundImage extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'background_image';

	public $button_text = 'Upload';

	public $remove_text = 'Remove';

	public function __construct( $args = array() ) {
		parent::__construct( $args );

		if ( empty( $this->value ) ) {
			$this->value = array(
				'img'  => '',
				'type' => '',
			);
		}
		$this->value['img']  = isset( $this->value['img'] ) ? $this->value['img'] : '';
		$this->value['type'] = isset( $this->value['type'] ) ? $this->value['type'] : '';
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		FormManager::enqueue_control( 'mix_fields' );
		wp_enqueue_script( 'ak-form-control-background-image', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-background-image.js', array( 'ak-form-control' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() {
		?>
		<div class="ak-background-field">
			<?php
				$bg_mix = array(
					'param_name'      => $this->param_name,
					'id'              => $this->id,
					'value'           => $this->value,
					'container_class' => 'control-heading-hide',
					'type'            => 'mix_fields',
					'fields'          => array(
						array(
							'id'          => 'img',
							'type'        => 'media_image',
							'button_text' => $this->button_text,
							'remove_text' => $this->remove_text,
						),
						array(
							'id'         => 'type',
							'type'       => 'select',
							'selectize'  => false,
							'options'    => $this->get_background_options(),
							'dependency' => array(
								'element'   => 'img',
								'not_empty' => true,
							),
						),
					),
				);

				echo FormBuilder::render_field( $bg_mix, true );
				?>
		</div>
		<?php
	}

	public function get_background_options() {
		$options = array(
			'' => 'Default',
			array(
				'label'   => 'Full Background Image',
				'options' => array(
					'cover'     => 'Full Cover',
					'fit-cover' => 'Fit Cover',
					'parallax'  => 'Parallax',
				),
			),
			array(
				'label'   => 'Repeated Background Image',
				'options' => array(
					'repeat'    => 'Repeat Horizontal and Vertical - Pattern',
					'repeat-y'  => 'Repeat Horizontal',
					'repeat-x'  => 'Repeat Vertical',
					'no-repeat' => 'No Repeat',
				),
			),
			array(
				'label'   => 'Static Background Image Position',
				'options' => array(
					'top-left'      => 'Top Right',
					'top-center'    => 'Top Center',
					'top-right'     => 'Top Right',
					'left-center'   => 'Left Center',
					'center-center' => 'Center Center',
					'right-center'  => 'Right Center',
					'bottom-left'   => 'Bottom Left',
					'bottom-center' => 'Bottom Center',
					'bottom-right'  => 'Bottom Right',
				),
			),
			array(
				'label'   => 'Repeated & Position',
				'options' => array(
					'top-repeat'    => 'Top Repeat',
					'bottom-repeat' => 'Bottom Repeat',
				),
			),
		);

		return apply_filters( 'ak-framework/background/options', $options );
	}
}
