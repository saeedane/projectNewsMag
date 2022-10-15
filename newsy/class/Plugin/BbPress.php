<?php

namespace Newsy\Plugin;

/**
 * Newsy bbPress plugin compatibility handler.
 */
class BbPress {

	/**
	 * @var BbPress
	 */
	private static $instance;

	/**
	 * Newsy_bbPress constructor.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * @return BbPress
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Callback: adds some code change to bbPress and other simple things.
	 *
	 * Filter: init
	 */
	public function init() {
		// BBPress support
		add_theme_support( 'bbpress' );

		add_filter( 'bbp_no_breadcrumb', '__return_true', 999 );
		add_action( 'bbp_after_get_user_favorites_link_parse_args', array( $this, 'get_user_favorites_link' ) );

		add_action( 'bbp_after_get_user_subscribe_link_parse_args', array( $this, 'get_user_subscribe_link' ) );

		add_action( 'bbp_after_get_topic_tag_list_parse_args', array( $this, 'get_topic_tag_list' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ), 99 );
	}

	/**
	 * Callback: Adding Icon to favorite.
	 *
	 * Action: bbp_after_get_user_favorites_link_parse_args
	 */
	public function get_user_favorites_link( $attr ) {
		$attr['favorite']  = '<i class="fa fa-heart-o"></i> ' . $attr['favorite'];
		$attr['favorited'] = '<i class="fa fa-heart"></i> ' . $attr['favorited'];

		return $attr;
	}

	/**
	 * Callback: Adding Icon to subscribe.
	 *
	 * Action: bbp_after_get_user_subscribe_link_parse_args
	 */
	public function get_user_subscribe_link( $attr ) {
		$attr['subscribe']   = '<i class="fa fa-star-o"></i> ' . $attr['subscribe'];
		$attr['unsubscribe'] = '<i class="fa fa-star"></i> ' . $attr['unsubscribe'];

		return $attr;
	}

	/**
	 * Callback: Adding Icon to tags.
	 *
	 * bbp_after_get_topic_tag_list_parse_args
	 */
	public function get_topic_tag_list( $attr ) {
		$attr['before'] = '<div class="bbp-topic-tags"><p><i class="fa fa-tags"></i> ' . newsy_get_translation( 'Tags', 'newsy', 'bbp_tagged' ) . '&nbsp;';

		return $attr;
	}

	/**
	 * Callback: Adding Icon to tags.
	 *
	 * bbp_after_get_topic_tag_list_parse_args
	 */
	public function register_scripts() {
		if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
			wp_enqueue_style( 'newsy-bbpress', NEWSY_THEME_URI . '/assets/css/bbpress.css', array(), NEWSY_THEME_VERSION );
			wp_style_add_data( 'newsy-bbpress', 'rtl', 'replace' );
		}
	}
}
