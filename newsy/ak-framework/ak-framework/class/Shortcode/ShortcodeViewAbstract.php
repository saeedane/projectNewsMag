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

/**
 * Base class for all shortcodes that have some general functionality for all of them.
 */
abstract class ShortcodeViewAbstract {

	/**
	 * Shortcode id.
	 *
	 * @var string
	 */
	public $id;

	/**
	 * Shortcode atts.
	 *
	 * @var array
	 */
	public $atts = array();

	/**
	 * Shortcode defaults.
	 *
	 * @var array
	 */
	public $defaults = array();

	/**
	 * the enclosed content (if the shortcode is used in its enclosing form).
	 *
	 * @var string
	 */
	public $content;

	/**
	 * contains options for shortcode.
	 *
	 * @var array
	 */
	public $params;

	/**
	 * Constructor.
	 *
	 * @param mixed $id
	 * @param array $params
	 */
	public function __construct( $id, $params ) {
		$this->id       = $id;
		$this->params   = $params;
		$this->defaults = apply_filters( 'ak-framework/shortcode/defaults', $this->defaults, $this->id );
	}

	/**
	 * Render shortcode.
	 *
	 * @param $atts
	 * @param $content
	 *
	 * @return string
	 */
	public function render_shortcode( $atts, $content = '' ) {
		// merge atts with default options
		$atts = shortcode_atts( $this->defaults, $atts );

		$atts = apply_filters( 'ak-framework/shortcode/atts', $atts, $this->id );

		$this->atts = $atts;

		return $this->render( $atts, $content );
	}

	/**
	 * This function must override in child's for displaying results.
	 *
	 * @param mixed $atts
	 * @param mixed $content
	 *
	 * @return string
	 */
	public function render( $atts, $content = '' ) {
		return '';
	}

	/**
	 * Method returns the completed shortcode as a string.
	 *
	 * @param mixed $atts
	 * @param mixed $content
	 * @param mixed $echo
	 */
	public function do_shortcode( $atts = array(), $content = '', $echo = false ) {
		// initializing
		$attr = '';

		foreach ( (array) $atts as $key => $value ) {
			$attr .= " $key='" . trim( $value ) . "'";
		}

		if ( ! empty( $this->content ) ) {
			$content = $this->content . "[/$this->id]";
		}

		ob_start();
		echo do_shortcode( "[$this->id $attr]$content" );
		$output = ob_get_clean();

		if ( $echo ) {
			ak_sanitize_echo( $output ); // escaped before
			return '';
		}

		return $output;
	}
}
