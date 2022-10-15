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
namespace Ak\Shortcode;

use Ak\Form\FormVcExtender;

/**
 * Manage all shortcode element registration.
 */
class ShortcodeManager {

	/**
	 * @var ShortcodeManager
	 */
	private static $instance;

	/**
	 * Store shortcode class instances.
	 *
	 * @var array
	 */
	private $shortcode_instances = array();

	/**
	 * Store shortcode option class instances.
	 *
	 * @var array
	 */
	private $option_instances = array();

	/**
	 * Store all registered shortcodes.
	 *
	 * @var array
	 */
	private $shortcodes = array();

	/**
	 * @return ShortcodeManager
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Initialize active shortcodes.
	 */
	public function __construct() {
		// register all theme shortcode classes after the framework setup
		add_action( 'ak-framework/setup/after', array( $this, 'register_shortcodes' ), 19 );
	}

	/**
	 * Register and get shortcodes.
	 */
	public function get_shortcodes() {
		if ( empty( $this->shortcodes ) ) {
			$this->shortcodes = apply_filters( 'ak-framework/shortcode', array() );
		}

		return $this->shortcodes;
	}

	/**
	 * Initialize active shortcodes.
	 */
	public function get_widgets() {
		$shortcodes = $this->get_shortcodes();

		return ak_array_find_all_by_value( $shortcodes, 'have_widget', true );
	}

	/**
	 * Initialize active shortcodes.
	 *
	 * @param mixed $id
	 */
	public function get_params( $id ) {
		$shortcodes = $this->get_shortcodes();

		return isset( $shortcodes[ $id ] ) ? $shortcodes[ $id ] : false;
	}

	/**
	 * Initialize active shortcodes.
	 *
	 * @param mixed $id
	 */
	public function get_option_class( $id ) {
		$shortcode = $this->get_params( $id );

		if ( isset( $shortcode['option_class'] ) ) {
			$instance = $this->get_option_instance( $id );
		} else {
			$instance = $this->get_shortcode_instance( $id );
		}

		return $instance;
	}

	/**
	 * Get option fields.
	 *
	 * @param mixed $id
	 */
	public function get_options( $id ) {
		$instance = $this->get_option_class( $id );

		if ( $instance && is_callable( array( $instance, 'get_fields' ) ) ) {
			return $instance->get_fields();
		}

		return array();
	}

	/**
	 * Initialize active shortcodes.
	 */
	public function register_shortcodes() {
		$shortcodes = $this->get_shortcodes();

		if ( empty( $shortcodes ) ) {
			return;
		}

		$init_options = $this->can_init_vc_options();

		// init here to register vc control types
		if ( $init_options ) {
			FormVcExtender::get_instance();
		}

		foreach ( $shortcodes as $id => $params ) {
			if ( '' == $id || empty( $params['class'] ) ) {
				continue;
			}

			// lazy load shortcode instance
			call_user_func( 'add' . '_' . 'shortcode', $id, 'ak_load_shortcode' );

			if ( $init_options ) {
				$this->register_vc_map( $id, $params );
			}
		}
	}

	/**
	 * Get the shortcode view instances.
	 *
	 * @param string $id Shortcode ID.
	 * @return mixed
	 */
	public function get_shortcode_instance( $id ) {
		if ( ! empty( $this->shortcode_instances[ $id ] ) ) {
			return $this->shortcode_instances[ $id ];
		}

		$params = $this->get_params( $id );

		if ( $params ) {
			if ( isset( $params['file'] ) && file_exists( $params['file'] ) ) {
				require_once $params['file'];
			}

			if ( isset( $params['class'] ) && class_exists( $params['class'] ) ) {
				$view_class = $params['class'];

				$this->shortcode_instances[ $id ] = new $view_class( $id, $params );
				return $this->shortcode_instances[ $id ];
			}
		}

		return false;
	}

	/**
	 * Get the shortcode options instances.
	 *
	 * @param string $id Shortcode ID.
	 * @return mixed
	 */
	public function get_option_instance( $id ) {
		if ( ! empty( $this->option_instances[ $id ] ) ) {
			return $this->option_instances[ $id ];
		}

		$params = $this->get_params( $id );

		if ( isset( $params['option_file'] ) && file_exists( $params['option_file'] ) ) {
			require_once $params['option_file'];
		}

		if ( isset( $params['option_class'] ) && class_exists( $params['option_class'] ) ) {
			$option_class = &$params['option_class'];

			$this->option_instances[ $id ] = new $option_class( $id, $params );
			return $this->option_instances[ $id ];
		}

		return false;
	}

	/**
	 * Registers Visual Composer Add-on options for shortcode.
	 *
	 * @param mixed $id
	 * @param mixed $params
	 *
	 * @return mixed
	 */
	public function register_vc_map( $id, $params ) {
		if ( ! isset( $params['have_map_for_vc'] ) || ! $params['have_map_for_vc'] ) {
			return;
		}
		$fields = $this->get_options( $id );

		if ( empty( $fields ) ) {
			return;
		}

		/**
		 * Refactor fields for Visual Composer Add-on.
		 *
		 * @param array $fields Fields for Visual Composer
		 * @param mixed $id     The Shortcode Id
		 */
		$fields = apply_filters( 'ak-framework/vc-fields', $fields, $id );

		if ( ! empty( $fields ) ) {
			vc_map(
				array(
					'name'           => $params['name'],
					'base'           => $id,
					'description'    => isset( $params['desc'] ) ? $params['desc'] : '',
					'icon'           => isset( $params['icon'] ) ? $params['icon'] : '',
					'weight'         => isset( $params['weight'] ) ? $params['weight'] : 10,
					'wrapper_height' => 'full',
					'category'       => $params['category'],
					'params'         => $fields,
				)
			);
		}
	}

	/**
	 * Check if we can register visual composer options.
	 *
	 * @return bool
	 */
	public function can_init_vc_options() {
		if ( ! is_user_logged_in() || ! defined( 'WPB_VC_VERSION' ) ) {
			return false;
		}

		$register = false;

		if ( is_admin() ) {
			$register = ak_is_doing_ajax( 'vc_edit_form' ) || ! ak_is_doing_ajax();
		} elseif ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) { // Fix for vc inline editor
			$register = true;
		}

		return $register;
	}
}
