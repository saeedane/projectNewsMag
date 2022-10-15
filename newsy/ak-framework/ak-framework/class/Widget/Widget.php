<?php
/**
 * The AkFramework.
 *
 * AkFramework is framework for themes and plugins for WordPress.
 *
 *  Copyright © 2020 akbilisim
 *  www.akbilisim.com
 *
 *
 *  Envato Profile: https://themeforest.net/user/akbilisim
 */
namespace Ak\Widget;

use Ak\Form\FormManager;
use AK\Shortcode\ShortcodeManager;

/**
 * Base class for widgets.
 */
class Widget extends \WP_Widget {

	public $widget_id = 0;

	/**
	 * Widget Position in wp-admin/widgets.php.
	 *
	 * @var int
	 */
	public $position = 30;

	/**
	 * Show widget title.
	 *
	 * @var bool
	 */
	public $with_title = true;

	/**
	 * Register widget with WordPress.
	 *
	 * @param bool  $widget_id
	 * @param mixed $widget_params
	 */
	public function __construct( $widget_id, $widget_params ) {
		$this->widget_id = $widget_id;
		$desc            = isset( $widget_params['desc'] ) ? $widget_params['desc'] : '';

		parent::__construct( $widget_id, $widget_params['name'], array( 'description' => $desc ) );
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$args = $this->filter_inner_atts( $args );

		ak_sanitize_echo( $args['before_widget'] );

		if ( isset( $args['_hide_wp_header'] ) && $args['_hide_wp_header'] ) {
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->widget_id );
			if ( ! empty( $title ) && $this->with_title ) {
				ak_sanitize_echo( $args['before_title'] . $title . $args['after_title'] );
			}
		}

		ak_do_shortcode( $this->widget_id, $instance, true );

		ak_sanitize_echo( $args['after_widget'] );
	}

	/**
	 * The widget update handler.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance The new instance of the widget.
	 * @param array $old_instance The old instance of the widget.
	 * @return array The updated instance of the widget.
	 */
	function update( $new_instance, $old_instance ) {
		return ak_array_filter_empty_fields( $new_instance );
	}

	/**
	 * Loads fields overwrite from child.
	 */
	public function filter_inner_atts( $args ) {
		return $args;
	}

	/**
	 * Child class fields.
	 */
	public function widget_fields() {
		return array();
	}

	/**
	 * Loads fields overwrite from child.
	 */
	public function get_shortcode_fields() {
		$fields = ShortcodeManager::get_instance()->get_options( $this->widget_id );

		if ( empty( $fields ) && ! is_array( $fields ) ) {
			return array();
		}

		//transform vc fields for our form builder
		foreach ( $fields as $i => $field ) {
			if ( 'css_editor' === $field['type'] ) {
				unset( $fields[ $i ] );
				continue;
			}

			if ( ! isset( $field['id'] ) ) {
				continue;
			}

			// turn field full-width
			if ( empty( $fields[ $i ]['container_class'] ) ) {
				$fields[ $i ]['container_class'] = 'control-heading-full';
			}

			// turn description to input-desc
			if ( ! empty( $field['description'] ) && 'info' !== $field['type'] ) {
				$fields[ $i ]['input_desc'] = $field['description'];
				unset( $fields[ $i ]['description'] );
			}
		}

		return $fields;
	}

	public function get_fields() {
		return array_merge(
			$this->widget_fields(),
			$this->get_shortcode_fields()
		);
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @return string|void
	 */
	public function form( $instance ) {
		$manager_instance = new FormManager(
			array(
				'input_prefix' => 'widget-' . $this->id_base . '[' . $this->number . ']',
				'fields'       => $this->get_fields(),
				'values'       => ! empty( $instance ) ? $instance : array(),
				'panel_id'     => 'ak_panel_' . $this->id,
				'panel_class'  => 'ak-widget-options ak-panel-menu-top',
			)
		);

		if ( $manager_instance->has_fields() ) {
			ak_sanitize_echo( $manager_instance->render_form() );
		}
	}
}
