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

namespace Ak\Asset;

/**
 * Class Handles enqueue scripts and styles for preventing conflict and also multiple version of assets in on page..
 *
 * @package  ak-framework
 */
class DynamicAsset {

	/**
	 * @var DynamicAsset
	 */
	private static $instance;

	/**
	 * Contains footer js codes.
	 *
	 * @var array
	 */
	private $footer_js = array();

	/**
	 * Contains head js codes.
	 *
	 * @var array
	 */
	private $head_js = array();

	/**
	 * Contains footer css codes.
	 *
	 * @var array
	 */
	private $footer_css = array();

	/**
	 * Contains head css codes.
	 *
	 * @var array
	 */
	private $head_css = array();

	/**
	 * Contains admin footer css codes.
	 *
	 * @var array
	 */
	private $admin_head_css = array();

	/**
	 * Contains admin footer css codes.
	 *
	 * @var array
	 */
	private $admin_footer_css = array();

	/**
	 * Contains admin footer js codes.
	 *
	 * @var array
	 */
	private $admin_head_js = array();

	/**
	 * Contains admin footer js codes.
	 *
	 * @var array
	 */
	private $admin_footer_js = array();

	/**
	 * @return DynamicAsset
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	public function __construct() {
		// Front End Inline Codes
		add_action( 'wp_head', array( $this, 'print_head' ), 99 );
		add_action( 'wp_footer', array( $this, 'print_footer' ), 99 );

		// Backend Inline Codes
		add_action( 'admin_head', array( $this, 'print_admin_head' ), 100 );
		add_action( 'admin_footer', array( $this, 'print_admin_footer' ), 100 );
	}

	/**
	 * Filter Callback: used for printing style and js codes in header.
	 */
	public function print_head() {
		// Print head CSS
		$this->_print( $this->head_css, 'style', 'Head Inline CSS' );
		$this->head_css = array();
		// Print head CSS
		$this->_print( $this->head_js, 'script', 'Head Inline JS' );
		$this->head_js = array();
	}

	/**
	 * Filter Callback: used for printing style and js codes in footer.
	 */
	public function print_footer() {
		// Print footer CSS
		$this->_print( $this->footer_css, 'style', 'Footer Inline CSS' );
		$this->footer_css = array();
		// Print footer JS
		$this->_print( $this->footer_js, 'script', 'Footer Inline JS' );
		$this->footer_js = array();
	}

	/**
	 * Filter Callback: used for printing style and js codes in admin header.
	 */
	public function print_admin_head() {
		// Print admin header CSS
		$this->_print( $this->admin_head_css, 'style', 'Admin Head Inline CSS' );
		$this->admin_head_css = array();
		// Print admin header JS
		$this->_print( $this->admin_head_js, 'style', 'Admin Head Inline JS' );
		$this->admin_head_js = array();
	}

	/**
	 * Filter Callback: used for printing style and js codes in admin footer.
	 */
	public function print_admin_footer() {
		// Print admin footer CSS
		$this->_print( $this->admin_footer_css, 'style', 'Admin Footer Inline CSS' );
		$this->admin_footer_css = array();
		// Print admin footer JS
		$this->_print( $this->admin_footer_js, 'style', 'Admin Footer Inline JS' );
		$this->admin_footer_js = array();
	}

	/**
	 * Used for adding inline js.
	 *
	 * @param string $code
	 * @param bool   $to_top
	 * @param bool   $force
	 */
	public function add_js( $code = '', $to_top = false ) {
		if ( $to_top ) {
			$this->head_js[] = $code;
		} else {
			$this->footer_js[] = $code;
		}
	}

	/**
	 * Used for adding inline css.
	 *
	 * @param string $code
	 * @param bool   $to_top
	 * @param bool   $force
	 */
	public function add_css( $code = '', $to_top = true ) {
		if ( $to_top ) {
			$this->head_css[] = $code;
		} else {
			$this->footer_css[] = $code;
		}
	}

	/**
	 * Used for adding inline css.
	 *
	 * @param string $code
	 * @param bool   $to_top
	 * @param bool   $force
	 */
	public function add_admin_css( $code = '', $to_top = false ) {
		if ( $to_top ) {
			$this->admin_head_css[] = $code;
		} else {
			$this->admin_footer_css[] = $code;
		}
	}

	/**
	 * Used for adding inline css.
	 *
	 * @param string $code
	 * @param bool   $to_top
	 * @param bool   $force
	 */
	public function add_admin_js( $code = '', $to_top = false ) {
		if ( $to_top ) {
			$this->admin_head_js[] = $code;
		} else {
			$this->admin_footer_js[] = $code;
		}
	}

	/**
	 * Print given code!
	 *
	 * @param array  $code
	 * @param string $type
	 * @param string $comment
	 * @param string $before
	 * @param string $after
	 */
	private function _print( $code = array(), $type = 'style', $comment = '', $before = '', $after = '' ) {
		$output = '';

		foreach ( (array) $code as $_code ) {
			$output .= $_code . "\n";
		}

		if ( $output ) {
			echo "\n<!-- {$comment} -->\n<{$type}>{$before}\n{$output}\n{$after}</{$type}>\n<!-- /{$comment}-->\n";
		}
	}
}
