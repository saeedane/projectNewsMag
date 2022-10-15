<?php

namespace Ak\Form\Control;

use Ak\Support\Font;
use Ak\Form\FormBuilder;
use Ak\Form\FormManager;
/**
 * Typography control.
 */
class Typography extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'typography';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @param mixed $args
	 */
	public function __construct( $args = array() ) {
		parent::__construct( $args );

		$defaults = array(
			'family'         => '',
			'variant'        => '',
			'subset'         => '',
			'size'           => '',
			'line-height'    => '',
			'letter-spacing' => '',
			'align'          => '',
			'transform'      => '',
			'color'          => '',
		);

		$this->options = ak_merge_args( $this->options, $defaults );
		$this->default = ak_merge_args( $this->default, $defaults );
		$this->value   = ak_merge_args( $this->value, $this->default );

		$get_font       = Font::get_instance()->get_font( $this->value['family'] );
		$default_option = array( '' => 'Default' );

		if ( ! empty( $this->value['family'] ) ) {
			$this->options['family'] = $this->value['family'];
		}

		if ( false !== $this->options['variant'] ) {
			$this->options['variant'] = isset( $get_font['variants'] ) ? $default_option + $get_font['variants'] : $default_option;
		}

		if ( false !== $this->options['subset'] ) {
			$this->options['subset'] = isset( $get_font['subsets'] ) ? $default_option + $get_font['subsets'] : $default_option;
		}
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		FormManager::enqueue_control( 'mix_fields' );
		wp_enqueue_script( 'ak-form-control-typography', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-typography.js', array( 'ak-form-control', 'fuse-search', 'impression', 'webfontloader', 'sweetalert', 'wp-color-picker-alpha' ), AK_FRAMEWORK_VERSION, true );

		wp_localize_script(
			'ak-form-control-typography',
			'ak_font_manager_loc',
			apply_filters(
				'ak_font_manager_loc',
				array(
					'type'         => 'panel',
					'preview_text' => 'The face of the moon was in shadow',
				)
			)
		);
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() {

		$fields = array();

		if ( false !== $this->options['family'] ) {
			$fields[] = array(
				'id'              => 'family',
				'heading'         => __( 'Font Family', 'ak-framework' ),
				'container_class' => 'ak-font-select-manager',
				'type'            => 'text',
				'input_attrs'     => array(
					'placeholder' => __( 'Select a Font', 'ak-framework' ),
				),
				'suffix'          => '<i class="fa fa-search"></i>',
			);
			if ( false !== $this->options['variant'] ) {
				$fields[] = array(
					'id'              => 'variant',
					'heading'         => __( 'Font Variant', 'ak-framework' ),
					'type'            => 'select',
					'selectize'       => false,
					'container_class' => 'ak-section-typography-variants',
					'options'         => $this->options['variant'],
					'dependency'      => array(
						'element'   => 'family',
						'not_empty' => true,
					),
				);
			}
			if ( false !== $this->options['subset'] ) {
				$fields[] = array(
					'id'              => 'subset',
					'heading'         => __( 'Font Subsets', 'ak-framework' ),
					'type'            => 'select',
					'selectize'       => false,
					'container_class' => 'ak-section-typography-subsets',
					'options'         => $this->options['subset'],
					'dependency'      => array(
						'element'   => 'family',
						'not_empty' => true,
					),
				);
			}
		}

		if ( false !== $this->options['size'] ) {
			$fields[] = array(
				'id'      => 'size',
				'heading' => __( 'Font Size', 'ak-framework' ),
				'type'    => 'slider_unit',
				'max'     => 100,
			);
		}
		if ( false !== $this->options['line-height'] ) {
			$fields[] = array(
				'id'      => 'line-height',
				'heading' => __( 'Line Height', 'ak-framework' ),
				'type'    => 'slider_unit',
				'max'     => 100,
			);
		}
		if ( false !== $this->options['letter-spacing'] ) {
			$fields[] = array(
				'id'      => 'letter-spacing',
				'heading' => __( 'Letter Spacing', 'ak-framework' ),
				'type'    => 'slider_unit',
				'max'     => 100,
			);
		}
		if ( false !== $this->options['transform'] ) {
			$fields[] = array(
				'id'        => 'transform',
				'heading'   => __( 'Transform', 'ak-framework' ),
				'type'      => 'select',
				'selectize' => false,
				'options'   => array(
					''           => 'Default',
					'none'       => 'None',
					'capitalize' => 'Capitalize',
					'uppercase'  => 'Uppercase',
					'lowercase'  => 'Lowercase',
					'initial'    => 'Initial',
					'inherit'    => 'Inherit',
				),
			);
		}
		if ( false !== $this->options['align'] ) {
			$fields[] = array(
				'id'      => 'align',
				'heading' => __( 'Align', 'ak-framework' ),
				'type'    => 'radio',
				'options' => array(
					''        => '<span class="dashicons dashicons-image-rotate-left"></span>',
					'none'    => '<span class="dashicons dashicons-editor-removeformatting"></span>',
					'left'    => '<span class="dashicons dashicons-editor-alignleft"></span>',
					'center'  => '<span class="dashicons dashicons-editor-aligncenter"></span>',
					'right'   => '<span class="dashicons dashicons-editor-alignright"></span>',
					'justify' => '<span class="dashicons dashicons-editor-justify"></span>',
				),
			);
		}
		if ( false !== $this->options['color'] ) {
			$fields[] = array(
				'id'      => 'color',
				'heading' => __( 'Color', 'ak-framework' ),
				'type'    => 'color',
			);
		}

		$typography_field = array(
			'param_name' => $this->param_name,
			'id'         => $this->id,
			'value'      => $this->value,
			'type'       => 'mix_fields',
			'fields'     => $fields,
		);

		?>
		<div class="ak-typography-field">
			<?php echo FormBuilder::render_field( $typography_field, true ); ?>
		</div>
		<?php
	}
}
