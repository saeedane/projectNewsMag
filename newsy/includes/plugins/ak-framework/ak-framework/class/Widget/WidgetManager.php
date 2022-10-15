<?php
namespace Ak\Widget;

use AK\Shortcode\ShortcodeManager;

class WidgetManager {

	/**
	 * @var String
	 */
	public static $sidebar_list = 'ak-widget-list';

	/**
	 * @var WidgetManager
	 */
	private static $instance;

	/**
	 * @return WidgetManager
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	private function __construct() {
		add_action( 'widgets_init', array( $this, 'init_sidebars' ) );
		add_action( 'widgets_init', array( $this, 'init_widgets' ) );
		add_filter( 'ak_get_sidebars', array( $this, 'get_sidebar_list' ) );
	}

	public function get_registered_sidebars() {
		return apply_filters( 'ak-framework/sidebar', array() );
	}

	public function get_additional_sidebars() {
		return get_option( self::$sidebar_list, array() );
	}

	public function update_additional_sidebars( $sidebars ) {
		return update_option( self::$sidebar_list, $sidebars );
	}

	public function get_all_sidebars() {
		$sidebars   = $this->get_registered_sidebars();
		$additional = $this->get_additional_sidebars();

		return array_merge( $sidebars, $additional );
	}

	public function init_sidebars() {
		$sidebars = $this->get_all_sidebars();

		$this->register_sidebars( $sidebars );
	}

	public function register_sidebars( $sidebars = array() ) {
		if ( $sidebars ) {
			foreach ( $sidebars as $id => $name ) {
				$args = array(
					'id'   => $id,
					'name' => $name,
				);

				$sidebar_args = apply_filters( 'ak-framework/sidebar/args', $args, $id );

				register_sidebar( $sidebar_args );
			}
		}
	}


	public function init_widgets() {
		$widgets = ShortcodeManager::get_instance()->get_widgets();

		$this->register_widgets( $widgets );
	}

	/**
	 * Initialize active shortcodes.
	 */
	public function register_widgets( $widgets ) {
		if ( $widgets ) {
			foreach ( $widgets as $id => $params ) {
				if ( isset( $params['widget_class'] ) && class_exists( $params['widget_class'] ) ) {
					$widget_class = $params['widget_class'];

					$class = new $widget_class( $id, $params );
				} else {
					$class = new Widget( $id, $params );
				}

				call_user_func( 'register_widget', $class );
			}
		}
	}

	public function get_sidebar_list() {
		$sidebars = $this->get_all_sidebars();

		$results = array(
			'' => esc_html__( 'Default Sidebar', 'ak-framework' ),
		);

		if ( ! empty( $sidebars ) ) {
			foreach ( $sidebars as $id => $widget ) {
				$results[ $id ] = $widget;
			}
		}

		return $results;
	}
}
