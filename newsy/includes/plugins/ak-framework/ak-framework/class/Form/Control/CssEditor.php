<?php

namespace Ak\Form\Control;

use Ak\Form\FormBuilder;
use Ak\Form\FormManager;
/**
 * Typography control.
 */
class CssEditor extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'css_editor';

	public $disable;

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 */
	public function __construct( $args = array() ) {
		parent::__construct( $args );
		$default = array(
			'background'    => array(
				'type'     => '',
				'color'    => '',
				'image'    => array(
					'img'  => '',
					'type' => '',
				),
				'gradient' => array(
					'color'     => '',
					'sec_color' => '',
					'location'  => '',
					'angle'     => '',
				),
			),
			'margin'        => array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			),
			'padding'       => array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			),
			'border'        => array(
				'top'    => array(
					'width' => '',
					'style' => '',
					'color' => '',
				),
				'right'  => array(
					'width' => '',
					'style' => '',
					'color' => '',
				),
				'bottom' => array(
					'width' => '',
					'style' => '',
					'color' => '',
				),
				'left'   => array(
					'width' => '',
					'style' => '',
					'color' => '',
				),
			),
			'border-radius' => array(
				'top-left'     => '',
				'top-right'    => '',
				'bottom-left'  => '',
				'bottom-right' => '',
			),
		);

		if ( is_array( $this->default ) ) {
			$this->default = ak_merge_args( $this->default, $default );
		}

		$disable = array(
			'background'    => false,
			'margin'        => false,
			'padding'       => false,
			'border'        => false,
			'border-radius' => false,
		);

		if ( is_array( $this->disable ) ) {
			$this->disable = ak_merge_args( $this->disable, $disable );
		} else {
			$this->disable = $disable;
		}
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		FormManager::enqueue_control( 'mix_fields' );
		wp_enqueue_script( 'ak-form-control-css-editor', AK_FRAMEWORK_URL . '/assets/js/form/controls/control-css-editor.js', array( 'ak-form-control' ), AK_FRAMEWORK_VERSION, true );
	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding
	 *
	 * @see WP_Customize_Control::print_template()
	 */
	public function render_content() {
		$fields = array();

		$fields[] = array(
			'id'              => 'background',
			'heading'         => 'Background',
			'container_class' => 'ak-css-editor-background ak-workspace-section ak-workspace-section-background control-heading-full',
			'type'            => 'mix_fields',
			'fields'          => $this->get_background_fields(),
		);

		$fields[] = array(
			'id'              => 'margin',
			'heading'         => 'Margin',
			'container_class' => 'ak-css-editor-margin ak-workspace-section ak-workspace-section-margin control-heading-full',
			'type'            => 'mix_fields',
			'fields'          => $this->get_space_fields( 'margin' ),
		);

		$fields[] = array(
			'id'              => 'padding',
			'heading'         => 'Padding',
			'container_class' => 'ak-css-editor-padding ak-workspace-section ak-workspace-section-padding control-heading-full',
			'type'            => 'mix_fields',
			'fields'          => $this->get_space_fields( 'padding' ),
		);

		$fields[] = array(
			'id'              => 'border',
			'heading'         => 'Border',
			'container_class' => 'ak-css-editor-border ak-workspace-section ak-workspace-section-border control-heading-full',
			'type'            => 'mix_fields',
			'fields'          => array(
				array(
					'id'      => 'border_linked',
					'heading' => esc_html__( 'Linked', 'ak-framework' ),
					'type'    => 'custom_field',
					'html'    => $this->get_linked_html(),
				),
				array(
					'id'              => 'borders_side',
					'heading'         => 'Side',
					'type'            => 'custom_field',
					'html'            => $this->get_borders_html(),
					'container_class' => 'ak-css-border-side-wrapper',
				),
				array(
					'id'              => 'top',
					'type'            => 'mix_fields',
					'fields'          => $this->get_border_fields(),
					'container_class' => 'ak-css-editor-border-side ak-css-editor-border-top',
				),
				array(
					'id'              => 'right',
					'type'            => 'mix_fields',
					'fields'          => $this->get_border_fields(),
					'container_class' => 'ak-css-editor-border-side ak-css-editor-border-right',
				),
				array(
					'id'              => 'bottom',
					'type'            => 'mix_fields',
					'fields'          => $this->get_border_fields(),
					'container_class' => 'ak-css-editor-border-side ak-css-editor-border-bottom',
				),
				array(
					'id'              => 'left',
					'type'            => 'mix_fields',
					'fields'          => $this->get_border_fields(),
					'container_class' => 'ak-css-editor-border-side ak-css-editor-border-left',
				),
			),
		);

		$fields[] = array(
			'id'              => 'border-radius',
			'heading'         => 'Border Radius',
			'container_class' => 'ak-css-editor-border-radius ak-workspace-section ak-workspace-section-border-radius control-heading-full',
			'type'            => 'mix_fields',
			'fields'          => $this->get_radius_fields(),
		);

		$editor_field = array(
			'param_name' => $this->param_name,
			'id'         => $this->id,
			'value'      => $this->value,
			'type'       => 'mix_fields',
			'fields'     => $fields,
		);
		?>
		<div class="ak-css-editor-field">

			<div class="ak-workspace-wrapper">

				<div class="ak-workspace-actions">
					<?php if ( true !== $this->disable['background'] ) { ?>
					<a class="ak-workspace-action-item ak-action-background" data-section="background"  data-title="<?php esc_html_e( 'Background', 'ak-framework' ); ?>">
						<span class="ak-workspace-action-item-icon"><i class="ak-icon ak-fa fa fa-paint-brush"></i></span>
						<span class="ak-workspace-action-item-name"><?php esc_html_e( 'Background', 'ak-framework' ); ?></span>
					</a>
						<?php
					}
					if ( true !== $this->disable['margin'] ) {
						?>
					<a  class="ak-workspace-action-item ak-action-margin" data-section="margin" data-title="<?php esc_html_e( 'Margin', 'ak-framework' ); ?>">
						<span class="ak-workspace-action-item-icon"><i class="ak-icon ak-fa fa fa-dedent"></i></span>
						<span class="ak-workspace-action-item-name"><?php esc_html_e( 'Margin', 'ak-framework' ); ?></span>
					</a>
						<?php
					}
					if ( true !== $this->disable['padding'] ) {
						?>
					<a class="ak-workspace-action-item ak-action-padding" data-section="padding" data-title="<?php esc_html_e( 'Padding', 'ak-framework' ); ?>">
						<span class="ak-workspace-action-item-icon"><i class="ak-icon ak-fa fa fa-indent"></i></span>
						<span class="ak-workspace-action-item-name"><?php esc_html_e( 'Padding', 'ak-framework' ); ?></span>
					</a>
						<?php
					}
					if ( true !== $this->disable['border'] ) {
						?>
					<a class="ak-workspace-action-item ak-action-border" data-section="border" data-title="<?php esc_html_e( 'Border', 'ak-framework' ); ?>">
						<span class="ak-workspace-action-item-icon"><i class="ak-icon ak-fa fa fa-square-o"></i></span>
						<span class="ak-workspace-action-item-name"><?php esc_html_e( 'Border', 'ak-framework' ); ?></span>
					</a>
						<?php
					}
					if ( true !== $this->disable['border-radius'] ) {
						?>
					<a class="ak-workspace-action-item ak-action-border-radius" data-section="border-radius" data-title="<?php esc_html_e( 'Radius', 'ak-framework' ); ?>">
						<span class="ak-workspace-action-item-icon"><i class="ak-icon ak-fa fa fa-object-group"></i></span>
						<span class="ak-workspace-action-item-name"><?php esc_html_e( 'Radius', 'ak-framework' ); ?></span>
					</a>
						<?php
					}
					?>
				</div>

				<div class="ak-workspace-section-wrapper">

				<?php echo FormBuilder::render_field( $editor_field, true ); ?>

				</div>
			</div>
		</div>
		<?php
	}

	public function get_space_fields( $space = 'margin' ) {
		return array(
			array(
				'id'      => $space . '_linked',
				'heading' => esc_html__( 'Linked', 'ak-framework' ),
				'type'    => 'custom_field',
				'html'    => $this->get_linked_html(),
			),
			array(
				'id'            => 'top',
				'heading'       => 'Top',
				'type'          => 'slider_unit',
				'max'           => 100,
				'unit'          => 'px',
				'control_attrs' => array(
					'data-linked' => 'ak-space-linked',
				),
			),
			array(
				'id'            => 'right',
				'heading'       => 'Right',
				'type'          => 'slider_unit',
				'max'           => 100,
				'unit'          => 'px',
				'control_attrs' => array(
					'data-linked' => 'ak-space-linked',
				),
			),
			array(
				'id'            => 'bottom',
				'heading'       => 'Bottom',
				'type'          => 'slider_unit',
				'max'           => 100,
				'unit'          => 'px',
				'control_attrs' => array(
					'data-linked' => 'ak-space-linked',
				),
			),
			array(
				'id'            => 'left',
				'heading'       => 'Left',
				'type'          => 'slider_unit',
				'max'           => 100,
				'unit'          => 'px',
				'control_attrs' => array(
					'data-linked' => 'ak-space-linked',
				),
			),
		);

	}

	public function get_border_fields() {
		return array(
			array(
				'id'            => 'style',
				'heading'       => esc_html__( 'Style', 'ak-framework' ),
				'type'          => 'select',
				'options'       => $this->get_border_styles(),
				'selectize'     => false,
				'control_attrs' => array(
					'data-linked' => 'ak-space-style-linked',
				),
			),
			array(
				'id'            => 'width',
				'heading'       => 'Width',
				'type'          => 'slider_unit',
				'max'           => 100,
				'unit'          => 'px',
				'dependency'    => array(
					'element'   => 'style',
					'not_empty' => true,
				),
				'control_attrs' => array(
					'data-linked' => 'ak-space-width-linked',
				),
			),
			array(
				'id'            => 'color',
				'heading'       => esc_html__( 'Color', 'ak-framework' ),
				'type'          => 'color',
				'dependency'    => array(
					'element'   => 'style',
					'not_empty' => true,
				),
				'control_attrs' => array(
					'data-linked' => 'ak-space-color-linked',
				),
			),
		);

	}

	public function get_radius_fields() {
		return array(
			array(
				'id'      => 'space_linked_html',
				'heading' => esc_html__( 'Linked', 'ak-framework' ),
				'type'    => 'custom_field',
				'html'    => $this->get_linked_html(),
			),
			array(
				'id'            => 'top-left',
				'heading'       => 'Top Left',
				'type'          => 'slider_unit',
				'max'           => 100,
				'unit'          => 'px',
				'control_attrs' => array(
					'data-linked' => 'ak-radius-linked',
				),
			),
			array(
				'id'            => 'top-right',
				'heading'       => 'Top Right',
				'type'          => 'slider_unit',
				'max'           => 100,
				'unit'          => 'px',
				'control_attrs' => array(
					'data-linked' => 'ak-radius-linked',
				),
			),
			array(
				'id'            => 'bottom-left',
				'heading'       => 'Bottom Left',
				'type'          => 'slider_unit',
				'max'           => 100,
				'unit'          => 'px',
				'control_attrs' => array(
					'data-linked' => 'ak-radius-linked',
				),
			),
			array(
				'id'            => 'bottom-right',
				'heading'       => 'Bottom Right',
				'type'          => 'slider_unit',
				'max'           => 100,
				'unit'          => 'px',
				'control_attrs' => array(
					'data-linked' => 'ak-radius-linked',
				),
			),
		);
	}


	public function get_background_fields() {
		return array(
			array(
				'id'      => 'type',
				'heading' => esc_html__( 'Type', 'ak-framework' ),
				'type'    => 'radio_icon',
				'options' => array(
					''         => array(
						'label' => esc_html__( 'Single', 'ak-framework' ),
						'icon'  => 'ak-fa fa fa-paint-brush',
					),
					'gradient' => array(
						'label' => esc_html__( 'Gradient', 'ak-framework' ),
						'icon'  => 'ak-fa fa fa-barcode',
					),
				),
			),
			array(
				'id'              => 'gradient',
				'heading'         => esc_html__( 'Gradient Color', 'ak-framework' ),
				'type'            => 'mix_fields',
				'container_class' => 'control-heading-hide',
				'fields'          => array(
					array(
						'id'      => 'color',
						'heading' => esc_html__( 'First Color', 'ak-framework' ),
						'type'    => 'color',
					),
					array(
						'id'      => 'sec_color',
						'heading' => esc_html__( 'Second Color', 'ak-framework' ),
						'type'    => 'color',
					),
					array(
						'id'      => 'location',
						'heading' => esc_html__( 'Location', 'ak-framework' ),
						'type'    => 'slider',
						'max'     => 100,
					),
					array(
						'id'      => 'angle',
						'heading' => esc_html__( 'Angle', 'ak-framework' ),
						'type'    => 'slider',
						'max'     => 360,
					),
				),
				'dependency'      => array(
					'element' => 'type',
					'value'   => array( 'gradient' ),
				),
			),
			array(
				'id'         => 'color',
				'heading'    => esc_html__( 'Color', 'ak-framework' ),
				'type'       => 'color',
				'dependency' => array(
					'element' => 'type',
					'value'   => array( '' ),
				),
			),
			array(
				'id'      => 'image',
				'heading' => esc_html__( 'Image', 'ak-framework' ),
				'type'    => 'background_image',
			),
		);
	}


	public function get_linked_html() {

		return '<ul class="ak-linked-action-item ak-choose ak-choose-condensed cols-2">
        <li class="ak-active" data-linked="false">
			<i class="ak-icon ak-fa fa fa-unlink" aria-hidden="true"></i>
        </li>
        <li data-linked="true">
			<i class="ak-icon ak-fa fa fa-link" aria-hidden="true"></i>
        </li>
    </ul>';

	}


	public function get_borders_html() {
		return '<ul class="ak-css-border-side-select ak-choose ak-choose-condensed  cols-4">
				<li class="ak-css-border-side-top" data-border="top" data-title="' . esc_html__( 'Top', 'ak-framework' ) . '">
				</li>
				<li class="ak-css-border-side-right" data-border="right" data-title="' . esc_html__( 'Right', 'ak-framework' ) . '">
				</li>
				<li class="ak-css-border-side-bottom" data-border="bottom" data-title="' . esc_html__( 'Bottom', 'ak-framework' ) . '">
				</li>
				<li class="ak-css-border-side-left" data-border="left"  data-title="' . esc_html__( 'Left', 'ak-framework' ) . '">
				</li>
            </ul>';

	}

	public function get_border_styles() {

		return array(
			''        => esc_html__( 'Default', 'ak-framework' ),
			'solid'   => 'solid',
			'dotted'  => 'dotted',
			'dashed'  => 'dashed',
			'none'    => 'none',
			'hidden'  => 'hidden',
			'double'  => 'double',
			'groove'  => 'groove',
			'ridge'   => 'ridge',
			'inset'   => 'inset',
			'outset'  => 'outset',
			'initial' => 'initial',
			'inherit' => 'inherit',
		);
	}
}
