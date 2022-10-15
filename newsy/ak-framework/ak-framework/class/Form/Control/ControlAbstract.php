<?php
/***
 * The Ak Framework
 *
 * Ak Framework is framework for WordPress themes and plugins.
 *
 * Copyright © 2020 akbilisim
 * www.akbilisim.com
 *
 * Envato Profile: https://themeforest.net/user/akbilisim
 */

namespace Ak\Form\Control;

/**
 * The parent class for all Ak Framework controls.
 * Other controls should extend this object.
 */
abstract class ControlAbstract {

	/**
	 * Order in which this instance was created in relation to other instances.
	 *
	 * @var int
	 */
	public $instance_number;

	/**
	 * Label for the control.
	 *
	 * @var string
	 */
	public $heading = '';

	/**
	 * Description for the control.
	 *
	 * @var string
	 */
	public $description = '';

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
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'text';

	/**
	 * Control's Default Value.
	 *
	 * @var string
	 */
	public $default = '';

	/**
	 * Control's Value.
	 *
	 * @var string|array
	 */
	public $value = '';

	/**
	 * List of options for 'radio' or 'select' type controls, where values are the keys, and labels are the values.
	 *
	 * @var array
	 */
	public $options = array();

	/**
	 * Use callback for option when render.
	 *
	 * @var array
	 */
	public $options_callback;

	/**
	 * Dependency Callback.
	 *
	 * @var string|array
	 */
	public $dependency = array();

	/**
	 * Dependency Callback.
	 *
	 * @var string|array
	 */
	public $presets = array();

	/**
	 * List of custom input attributes for control output, where attribute names are the keys and values are the values.
	 *
	 * @var array
	 */
	public $control_attrs = array();

	/**
	 * List of custom input attributes for control output, where attribute names are the keys and values are the values.
	 *
	 * @var array
	 */
	public $input_attrs = array();

	/**
	 * List of custom input attributes for control output, where attribute names are the keys and values are the values.
	 *
	 * @var array
	 */
	public $input_desc = '';

	/**
	 * Wrapper Class.
	 *
	 * @var String
	 */
	public $container_class = '';

	/**
	 * Capability required to use this control.
	 *
	 * Normally this is empty and the capability is derived from the capabilities
	 * of the associated `$settings`.
	 *
	 * @var string
	 */
	public $capability;

	/**
	 * Data type.
	 *
	 * @var string
	 */
	public $option_type = 'option';

	/**
	 * Group of control.
	 *
	 * @var string
	 */
	public $section = '';

	/**
	 * Control's Active.
	 *
	 * @var string
	 */
	public $is_active = true;

	/**
	 * Control's Active.
	 *
	 * @var string
	 */
	public $vc_field = false;

	/**
	 * Used for enqueued controls.
	 *
	 * @static
	 *
	 * @var array
	 */
	protected static $enqueued = array();

	/**
	 * Incremented with each new class instantiation, then stored in $instance_number.
	 *
	 * Used when sorting two instances whose priorities are equal.
	 *
	 * @static
	 *
	 * @var int
	 */
	protected static $instance_count = 0;

	/**
	 * Constructor.
	 *
	 * Supplied `$args` override class property defaults.
	 */
	public function __construct( $args = array() ) {
		if ( ! isset( $args['id'] ) ) {
			return;
		}

		$this->id              = $args['id'];
		self::$instance_count += 1;
		$this->instance_number = self::$instance_count;

		$keys = array_keys( get_object_vars( $this ) );
		foreach ( $keys as $key ) {
			if ( isset( $args[ $key ] ) ) {
				$this->$key = $args[ $key ];
			}
		}

		if ( empty( $this->value ) && ! empty( $this->default ) ) {
			$this->value = $this->default;
		}

		if ( ! empty( $this->value ) ) {
			$this->value = maybe_unserialize( $this->value );
		}

		if ( ! empty( $this->options_callback ) ) {
			$this->options = ak_fields_callback( $this->options_callback );
		}

		$this->input_attrs['name']   = esc_attr( $this->id );
		$this->input_attrs['class']  = isset( $this->input_attrs['class'] ) ? $this->input_attrs['class'] : '';
		$this->input_attrs['class'] .= ' ak-form-field-main-input ';
		$this->input_attrs['class'] .= 'ak-form-field-' . $this->param_name;

		// enqueue control assets
		add_action( 'admin_footer', array( $this, 'enqueue_scripts' ), 9999 );
	}

	/**
	 * Enqueue control related scripts/styles.
	 *
	 */
	public function enqueue_scripts() {
		if ( in_array( $this->type, self::$enqueued, true ) ) {
			return;
		}
		$this->enqueue();

		self::$enqueued[] = $this->type;
	}

	/**
	 * Enqueue control related scripts/styles.
	 *
	 */
	public function enqueue() {}

	/**
	 * Wrap the input in a section.
	 *
	 * This class is for setting options
	 *
	 * @return string
	 */
	public function render() {  ?>
	<div <?php $this->get_control_attrs(); ?>>
		<div class="ak-form-control-head">
			<span class="ak-form-control-title">
				<?php echo esc_html( $this->heading ); ?>
			</span>
			<?php
			if ( ! empty( $this->description ) ) {
				?>
			<span class="ak-form-control-description"><?php ak_sanitize_echo( $this->description ); ?></span>
				<?php
			}
			?>
		</div>
		<div class="ak-form-control-content">
			<?php $this->render_content(); ?>

			<?php
			if ( ! empty( $this->input_desc ) ) {
				?>
			<div class="input-desc">
				<?php ak_sanitize_echo( $this->input_desc ); ?>
			</div>
				<?php
			}
			?>
		</div>
	</div>
		<?php
	}

	/**
	 * Render the control's content.
	 */
	public function render_content() {  }

	/**
	 * Get the value.
	 *
	 * @return string|array
	 */
	public function get_value() {
		return $this->value;
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
	 * Get input's attributes.
	 *
	 * @return string
	 */
	public function get_control_attrs() {
		$t_id = $this->sanitize_id( $this->id );

		$id    = 'ak-form-control-' . $t_id;
		$class = 'ak-form-control ak-form-control-' . $this->type . ' ' . $this->container_class;

		if ( '' === $this->heading ) {
			$class .= ' control-heading-hide';
		}

		$this->control_attrs['id']                      = esc_attr( $id );
		$this->control_attrs['class']                   = esc_attr( $class );
		$this->control_attrs['data-control-id']         = esc_attr( $this->id );
		$this->control_attrs['data-control-param-name'] = esc_attr( $this->param_name );
		$this->control_attrs['data-control-type']       = esc_attr( $this->type );
		$this->control_attrs['data-control-section']    = esc_attr( $this->section );

		if ( ! empty( $this->dependency ) ) {
			// add data for js actions
			$this->control_attrs['data-dependency'] = esc_attr( json_encode( $this->dependency ) );
		}

		if ( ! empty( $this->presets ) ) {
			// add data for js actions
			$this->control_attrs['data-presets'] = esc_attr( json_encode( $this->presets ) );
		}

		if ( is_array( $this->default ) ) {
			// add data for js actions
			$this->control_attrs['data-default'] = esc_attr( json_encode( $this->default ) );
		} else {
			// add data for js actions
			$this->control_attrs['data-default'] = esc_attr( $this->default );
		}

		if ( ! $this->is_active ) {
			$this->control_attrs['style'] = 'display:none;';
		}

		$output = '';
		foreach ( $this->control_attrs as $attr => $value ) {
			$output .= $attr . '="' . $value . '" ';
		}

		ak_sanitize_echo( $output );
	}

	/**
	 * Get input's attributes.
	 *
	 * @return string
	 */
	public function get_input_attrs() {
		$output = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			$output .= $attr . '="' . esc_attr( $value ) . '" ';
		}
		ak_sanitize_echo( $output );
	}
}
