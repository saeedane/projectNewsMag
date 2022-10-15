<?php
namespace Ak\Form\Control;

class IconSelect extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'icon_select';

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		wp_enqueue_style( 'fontawesome' );

		wp_enqueue_script(
			'ak-form-control-icon-select',
			AK_FRAMEWORK_URL . '/assets/js/form/controls/control-icon-select.js',
			array( 'ak-form-control', 'sweetalert', 'fuse-search' ),
			AK_FRAMEWORK_VERSION,
			true
		);

		wp_localize_script(
			'ak-form-control-icon-select',
			'ak_icon_manager_loc',
			apply_filters(
				'ak-framework/ak_icon_select_manager_loc',
				array(
					'title'              => __( 'Icons', 'ak-framework' ),
					'select_icon'        => __( 'Select an Icon', 'ak-framework' ),
					'remove_icon'        => __( 'Remove Icon', 'ak-framework' ),
					'custom_icon_select' => __( 'Select Image Icon', 'ak-framework' ),
					'search_icon'        => __( 'Search Icon', 'ak-framework' ),
				)
			)
		);
	}

	/**
	 * Template for this control's content (but not its container).
	 *
	 * @see Ak_Form_Control::render_content()
	 */
	public function render_content() {      ?>
		<div class="ak-icon-select-manager ak-form-control-placeholder ak-field-suffix">
			<div class="ak-icon-selected-name">
				<?php
				if ( '' !== $this->value ) {
					echo ak_get_icon( $this->value );
					ak_sanitize_echo( $this->value );
				} else {
					esc_html_e( 'Select an Icon', 'ak-framework' );
				}
				?>
			</div>
			<input type="hidden" value="<?php echo esc_attr( $this->value ); ?>" <?php $this->get_input_attrs(); ?> />
			<span class="ak-span-suffix"><i class="fa fa-search"></i></span>
		</div>
		<?php
	}
}
