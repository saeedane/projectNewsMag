<?php

namespace Newsy\Support;

use Ak\Form\Control\ControlAbstract;

class PartBuilder extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'part_builder';

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_style( 'newsy-part-builder', NEWSY_THEME_URI . '/assets/admin/form-control/part-builder.css', array(), NEWSY_THEME_VERSION );

		wp_enqueue_script( 'newsy-part-builder', NEWSY_THEME_URI . '/assets/admin/form-control/part-builder.js', array( 'jquery', 'ak-form-control' ), NEWSY_THEME_VERSION, true );

		wp_localize_script(
			'newsy-part-builder',
			'newsy_part_builder_loc',
			apply_filters(
				'newsy_part_builder_loc',
				PartBuilderData::get_builder_data()
			)
		);
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() {
		$current_part    = '';
		$current_buttons = '';

		switch ( $this->param_name ) {
			case 'builder_header_part_builder':
				$current_title    = esc_html__( 'Header Builder', 'newsy' );
				$current_part     = 'builder_header_desktop';
				$current_buttons  = '<div class="part-mode-builder_header_desktop" data-part="builder_header_desktop"><span>' . esc_html__( 'Desktop', 'newsy' ) . '</span></div>';
				$current_buttons .= '<div class="part-mode-builder_header_mobile" data-part="builder_header_mobile"><span>' . esc_html__( 'Mobile', 'newsy' ) . '</span></div>';
				$current_buttons .= '<div class="part-mode-builder_header_sticky" data-part="builder_header_sticky"><span>' . esc_html__( 'Sticky Bar', 'newsy' ) . '</span></div>';
				$current_buttons .= '<div class="part-mode-builder_drawer" data-part="builder_drawer"><span>' . esc_html__( 'Drawer Bar', 'newsy' ) . '</span></div>';
				break;

			case 'builder_post_sticky_part_builder':
				$current_title = esc_html__( 'Post Sticky Builder', 'newsy' );
				$current_part  = 'builder_post_sticky';
				break;

			case 'builder_footer_part_builder':
				$current_title = esc_html__( 'Footer Builder', 'newsy' );
				$current_part  = 'builder_footer';
				break;

			default:
				return;
				break;
		}

		?>
		<div class='ak-part-builder'>
		<div class="ak-builder-holder">
			<div class="part-builder" data-part="<?php echo esc_attr( $current_part ); ?>">
				<div class="part-builder-wrap">
					<div class="part-builder-header ak-flex-row">
						<div class="ak-flex-column ak-flex-column-normal part-builder-title"><?php echo esc_html( $current_title ); ?></div>
						<div class="ak-flex-column ak-flex-column-normal "></div>
						<div class="ak-flex-column-right part-actions-menu part-switcher">
								<?php newsy_sanitize_echo( $current_buttons ); ?>
						</div>
					</div>
					<div class="part-builder-body">
						<div class="part-builder-sections">
							<div class="part-builder-rows part-builder-wrapper"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
							<div class="part-builder-items part-builder-list part-builder-drop-zone"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<?php
	}
}
