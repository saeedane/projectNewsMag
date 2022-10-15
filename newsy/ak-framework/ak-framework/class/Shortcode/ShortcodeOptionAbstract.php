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
abstract class ShortcodeOptionAbstract {
	/**
	 * Shortcode id.
	 *
	 * @var string
	 */
	public $id;

	/**
	 * contains options for shortcode.
	 *
	 * @var array
	 */
	public $params = array();

	/**
	 * Constructor.
	 *
	 * @param mixed $id
	 * @param array $params
	 */
	public function __construct( $id, $params ) {
		$this->id     = $id;
		$this->params = $params;
	}

	public function get_fields() {

		$fields   = $this->fields();
		$defaults = ShortcodeManager::get_instance()->get_shortcode_instance( $this->id )->defaults;

		if ( ! empty( $fields ) ) {
			foreach ( $fields as $i => $field ) {
				if ( ! isset( $field['id'] ) || ! isset( $field['section'] ) ) {
					unset( $fields[ $i ] );
					continue;
				}

				$id = $field['id'];

				if ( ! isset( $field['default'] ) && isset( $defaults[ $id ] ) ) {
					$fields[ $i ]['default'] = $defaults[ $id ];
				}
			}
		}

		return $fields;
	}

	/**
	 * Registers Visual Composer Add-on.
	 *
	 * Must override in child classes
	 *
	 * @return array|bool
	 */
	public function fields() {
		return array();
	}
}
