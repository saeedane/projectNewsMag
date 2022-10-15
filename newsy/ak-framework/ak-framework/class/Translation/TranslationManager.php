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
namespace Ak\Translation;

class TranslationManager {

	/**
	 * @var TranslationManager
	 */
	private static $instance;

	/**
	 * Contain all translations.
	 *
	 * @var array
	 */
	public static $translations = array();

	/**
	 * Contain all fields.
	 *
	 * @var array
	 */
	private $fields = array();

	/**
	 * @return TranslationManager
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
			static::$instance->hook();
		}

		return static::$instance;
	}

	/**
	 * Register taxonomy fields.
	 */
	public function hook() {
		add_filter( 'ak-framework/register/translation', array( $this, 'register_translation_fields' ), 150 );
	}

	/**
	 * Register taxonomy fields.
	 */
	public function get_translation_fields() {
		if ( empty( self::$translations ) ) {
			self::$translations = apply_filters( 'ak-framework/register/translation', array() );
		}

		return self::$translations;
	}

	/**
	 * Register taxonomy fields.
	 */
	public function prepare_fields() {
		foreach ( self::$translations as $domain => $translation ) {
			$fields = ak_resolve_form_fields( $translation );
			if ( empty( $fields ) ) {
				continue;
			}

			$this->fields[] = array(
				'heading' => $translation['name'],
				'id'      => $domain . '_section',
				'type'    => 'section',
			);
			$this->fields[] = array(
				'heading' => '',
				'type'    => 'mix_fields',
				'id'      => $domain,
				'section' => $domain . '_section',
				'fields'  => $fields,
			);
		}
	}

	/**
	 * Register tranlation fields.
	 */
	public function get_fields() {
		$this->get_translation_fields();

		if ( ! empty( self::$translations ) ) {
			$this->prepare_fields();
		}

		return $this->fields;
	}

	/**
	 * Register the framework translations.
	 *
	 * @return array
	 */
	public function register_translation_fields( $fields ) {
		$fields['ak-framework'] = array(
			'name' => esc_html__( 'Framework', 'ak-framework' ),
			'file' => AK_FRAMEWORK_PATH . '/includes/options/translation.php',
		);

		return $fields;
	}
}
