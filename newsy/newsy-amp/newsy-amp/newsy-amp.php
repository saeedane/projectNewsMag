<?php
/*
Plugin Name:    Newsy - AMP Extender
Plugin URI:     http://themeforest.net/user/akbilisim
Description:    Extend WordPress AMP to fit with Newsy Style
Author:         akbilisim
Version:        2.0.0
Author URI:     http://akbilisim.com
Text Domain:    newsy-amp
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

defined( 'NEWSY_AMP_VERSION' ) or define( 'NEWSY_AMP_VERSION', '2.0.0' );
defined( 'NEWSY_AMP' ) or define( 'NEWSY_AMP', 'newsy-amp' );
defined( 'NEWSY_AMP_URI' ) or define( 'NEWSY_AMP_URI', plugins_url( NEWSY_AMP ) );
defined( 'NEWSY_AMP_PATH' ) or define( 'NEWSY_AMP_PATH', plugin_dir_path( __FILE__ ) );
defined( 'NEWSY_AMP_OPTIONS' ) or define( 'NEWSY_AMP_OPTIONS', 'newsy-amp-options' );

add_action( 'ak-framework/setup/after', 'newsy_amp_load', 19 );

if ( ! function_exists( 'newsy_amp_load' ) ) {
	/**
	 * Load Plugin Class
	 */
	function newsy_amp_load() {
		require_once 'class.newsy-amp.php';
		Newsy_AMP::get_instance();
	}
}


add_filter( 'ak-framework/product/pages', 'newsy_amp_register_product_page', 16 );

if ( ! function_exists( 'newsy_amp_register_product_page' ) ) {
	function newsy_amp_register_product_page( $pages ) {
		$pages['newsy-amp'] = array(
			'product'    => 'newsy',
			'page_title' => __( 'AMP Options', 'newsy-amp' ),
			'parent'     => 'newsy-theme-dashboard',
			'capability' => 'manage_options',
			'module'     => 'option-panel',
			'hide_tab'   => true,
			'position'   => 152,
			'config'     => array(
				'panel_title'   => __( 'Newsy AMP Options', 'newsy-amp' ),
				'panel_options' => array(
					'file'        => NEWSY_AMP_PATH . 'options/panel.php', //conf
					'panel_class' => 'ak-panel-menu-top ', //conf
					'option_id'   => NEWSY_AMP_OPTIONS,
				),
			),
		);

		return $pages;
	}
}

add_filter( 'ak-framework/register/translation', 'newsy_amp_register_translation_fields', 21 );

if ( ! function_exists( 'newsy_amp_register_translation_fields' ) ) {
	/**
	 * Register the Newsy translations to framework.
	 *
	 * @return array
	 */
	function newsy_amp_register_translation_fields( $fields ) {
		$fields['newsy-amp'] = array(
			'name' => __( 'Newsy Amp', 'newsy-amp' ),
			'file' => NEWSY_AMP_PATH . 'options/translation.php',
		);

		return $fields;
	}
}

if ( ! function_exists( 'newsy_get_option' ) ) {
	/**
	 * Used for retrieving options
	 *
	 * @param $option_key
	 *
	 * @return mixed|null
	 */
	function newsy_get_option( $option_key, $default_value = '' ) {
		return ak_get_option( 'newsy-theme-options', $option_key, $default_value );
	}
}

if ( ! function_exists( 'newsy_amp_get_option' ) ) {
	/**
	 * Used for retrieving options
	 *
	 * @param $option_key
	 *
	 * @return mixed|null
	 */
	function newsy_amp_get_option( $option_key, $default_value = '' ) {
		return ak_get_option( NEWSY_AMP_OPTIONS, $option_key, $default_value );
	}
}

/**
 * Load Text Domain
 */
function newsy_amp_load_textdomain() {
	load_plugin_textdomain( 'newsy-amp', false, basename( __DIR__ ) . '/languages/' );
}

newsy_amp_load_textdomain();
