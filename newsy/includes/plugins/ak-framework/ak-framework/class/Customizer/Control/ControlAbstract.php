<?php
namespace Ak\Customizer\Control;

use Ak\Form\FormBuilder;
use Ak\Form\FormManager;

/**
 * The parent class for all Ak Framework controls.
 * Other controls should extend this object.
 */
class ControlAbstract extends \WP_Customize_Control {
	/**
	 * Control ID.
	 *
	 * @var string
	 */
	public $id;

	/**
	 * Control Param Name.
	 *
	 * @var string
	 */
	public $param_name;

	/**
	 * Get the control type for our form manager.
	 *
	 * @var array
	 */
	public $_type = 'text';

	/**
	 * Get the control field params for our form manager.
	 *
	 * @var array
	 */
	public $_field = array();

	/**
	 * Used to automatically generate all CSS output.
	 *
	 * @var array
	 */
	public $output = array();

	/**
	 * Used to automatically generate control attributes.
	 *
	 * @var array
	 */
	public $control_attrs = array();

	/**
	 * Used to automatically generate all postMessage scripts.
	 *
	 * @var array
	 */
	public $js_vars = array();

	/**
	 * Used to automatically generate all postMessage scripts.
	 *
	 * @var array
	 */
	public $presets = array();

	/**
	 * Wrapper Class.
	 *
	 * @var String
	 */
	public $container_class;

	/**
	 * Control options.
	 *
	 * @var String
	 */
	public $options = array();

	/**
	 * Control options.
	 *
	 * @var string|array|bool
	 */
	public $options_callback = false;

	/**
	 * Enqueue control related scripts/styles from our manager.
	*/
	public function enqueue() {
		FormManager::enqueue_control( $this->_type );
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		} else {
			$this->json['default'] = $this->setting->default;
		}

		$this->json['js_vars'] = $this->js_vars;
		$this->json['value']   = $this->value();
		$this->json['link']    = $this->get_link();
		$this->json['id']      = $this->id;
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_field() {
		$this->_field = $this->json;

		$this->_field['id']               = $this->id;
		$this->_field['param_name']       = $this->param_name;
		$this->_field['heading']          = $this->label;
		$this->_field['description']      = $this->description;
		$this->_field['type']             = $this->_type;
		$this->_field['options']          = ! empty( $this->options ) ? $this->options : array();
		$this->_field['options_callback'] = $this->options_callback;
		$this->_field['value']            = $this->value();
		$this->_field['input_attrs']      = $this->input_attrs;

		if ( isset( $this->settings['default'] ) && $this->settings['default'] instanceof \WP_Customize_Setting ) {
			$this->_field['input_attrs']['data-customize-setting-link'] = esc_attr( $this->settings['default']->id );
		} else {
			$this->_field['input_attrs']['data-customize-setting-key-link'] = esc_attr( 'default' );
		}
	}

	/**
	 * Get input's attributes.
	 *
	 * @return string
	 */
	public function get_control_attrs() {
		$t_id = $this->sanitize_id( $this->id );

		$id    = 'customize-control-' . $t_id;
		$class = 'customize-control ak-customize-control customize-control-' . $this->type;

		if ( '' !== $this->container_class ) {
			$class .= ' ' . $this->container_class;
		}

		if ( '' === $this->label ) {
			$class .= ' control-heading-hide';
		}

		$this->control_attrs['id']                      = esc_attr( $id );
		$this->control_attrs['class']                   = esc_attr( $class );
		$this->control_attrs['data-control-id']         = esc_attr( $this->id );
		$this->control_attrs['data-control-type']       = esc_attr( $this->_type );
		$this->control_attrs['data-control-section']    = esc_attr( $this->section );
		$this->control_attrs['data-control-param-name'] = esc_attr( $this->param_name );

		if ( ! empty( $this->dependency ) ) {
			// add data for js actions
			$this->control_attrs['data-dependency'] = esc_attr( json_encode( $this->dependency ) );
		}

		if ( ! empty( $this->presets ) ) {
			// add data for js actions
			$this->control_attrs['data-presets'] = esc_attr( json_encode( $this->presets ) );
		}

		// if ( isset( $this->settings['default'] ) ) {
		// 	die( var_dump( $this->settings['default'] ) );
		// 	$this->control_attrs['data-default'] = esc_attr( $this->settings['default']->value );
		// }
		// if ( is_array( $this->default ) ) {
		// 	// add data for js actions
		// 	$this->control_attrs['data-default'] = esc_attr( json_encode( $this->default ) );
		// } else {
		// 	// add data for js actions
		// 	$this->control_attrs['data-default'] = esc_attr( $this->default );
		// }

		if ( ! empty( $this->output ) ) {
			// add data for style output actions
			$this->control_attrs['data-output'] = esc_attr( json_encode( $this->output ) );
		}

		$output = '';
		foreach ( $this->control_attrs as $attr => $value ) {
			$output .= $attr . '="' . $value . '" ';
		}

		ak_sanitize_echo( $output );
	}

	/**
	 * Renders the control wrapper and calls $this->render_content() for the internals.
	 */
	protected function render() {
		?>
		<li <?php $this->get_control_attrs(); ?>>
			<?php $this->render_content(); ?>
			<script type="text/javascript">
			(function($){
				$('#customize-control-<?php echo esc_attr( $this->sanitize_id( $this->id ) ); ?>').Ak_Form_Control();
			})(jQuery);
		</script>
		</li>
		<?php
	}

	/**
	 * Render the control's content.
	 *
	 * @see WP_Customize_Control::render_content()
	 */
	protected function render_content() {
		$this->to_field();

		if ( ! empty( $this->label ) ) :
			?>
			<label for="<?php echo esc_attr( $this->id ); ?>" class="customize-control-title"><?php echo esc_html( $this->label ); ?></label>
		<?php endif; ?>
		<?php if ( ! empty( $this->description ) ) : ?>
			<span id="<?php echo esc_attr( '_customize-description-' . $this->id ); ?>" class="description customize-control-description">
			<?php echo wp_kses( $this->description, wp_kses_allowed_html() ); ?>
			</span>
			<?php
		endif;

		echo FormBuilder::render_field( $this->_field, true );
	}


	/**
	 * Sanitize control id.
	 *
	 * @return string|array
	 */
	public function sanitize_id( $id ) {
		return str_replace( array( '[', ']' ), array( '-', '' ), $id );
	}

	/**
	 * Sanitize control type.
	 *
	 * @return string|array
	 */
	public function sanitize_type( $type ) {
		return str_replace( array( 'ak_', '-' ), array( '', '_' ), $type );
	}
}
