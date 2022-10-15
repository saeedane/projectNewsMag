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

use Ak\Support\Options;

class MultiLang {

	/**
	 * @var MultiLang
	 */
	private static $instance;

	/**
	 * @var string
	 */
	public $active_plugin;

	/**
	 * @var string
	 */
	public $current_lang;

	/**
	 * @return MultiLang
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
			static::$instance->init();
		}

		return static::$instance;
	}

	private function init() {
		if ( ! $this->get_active_plugin() ) {

			return;
		}

		add_filter( 'ak-framework/current-language', array( $this, 'set_current_language' ) );
		add_filter( 'ak-framework/options/option_id', array( $this, 'set_option_id' ), 99, 2 );
		add_filter( 'ak-framework/options/std', array( $this, 'set_option_defaults' ), 99, 2 );
		add_filter( 'ak-framework/cache/cache_id', array( $this, 'set_cache_id' ) );
		add_action( 'ak-framework/product-panel/page-info', array( $this, 'add_language_info' ), 11, 2 );

		// do not use customizer fields on multilang setup.
		add_filter( 'ak-framework/customizer', '__return_empty_array', 999 );
	}

	/**
	 * Set option key for current language.
	 */
	public function set_option_id( $option_id, $wp_field = false ) {
		if ( $wp_field ) {
			return $option_id;
		}

		$language = $this->get_current_lang();

		if ( ! empty( $language ) ) {
			return $option_id . '_' . $language;
		}

		return $option_id;
	}

	/**
	 * Set default values for current language.
	 *
	 * @todo WIP
	 *
	 * @param $defaults
	 * @param $option_id
	 *
	 * @return mixed
	 */
	public function set_option_defaults( $defaults, $option_id ) {
		if ( empty( $defaults ) ) {
			// remove filtered language from option_id
			$option_id = str_replace( '_' . $this->get_current_lang(), '', $option_id );

			// get default values from default language options
			$default_language = $this->get_default_language();

			if ( ! empty( $default_language ) ) {
				$default_language = $option_id . '_' . $default_language;
				$defaults         = Options::get( $default_language, '', '', false );
			}

			// fallback to no language options
			if ( empty( $defaults ) || ! $defaults ) {
				$defaults = Options::get( $option_id, '', '', false );
			}
		}

		return $defaults;
	}

	/**
	 * Set current language.
	 *
	 * @return string
	 */
	public function set_current_language( $lang ) {
		return $this->get_current_lang();
	}

	/**
	 * Set option key for current language.
	 */
	public function set_cache_id( $cache_id ) {
		$language = $this->get_current_lang();

		if ( ! empty( $language ) ) {
			return $cache_id . '_' . $language;
		}

		return $cache_id;
	}

	/**
	 * @return string|false
	 */
	public function get_active_plugin() {
		// Polylang : https://wordpress.org/plugins/polylang/
		if ( function_exists( 'pll_languages_list' ) ) {
			return 'Polylang';
		}
		// WPML : https://wpml.org/
		if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
			return 'WPML';
		}
		// WPGlobe : http://www.wpglobus.com/
		if ( class_exists( 'WPGlobus' ) ) {
			return 'WPGlobus';
		}

		return false;
	}

	/**
	 * Returns multilingual language information.
	 *
	 * @since 1.0
	 *
	 * @param null $lang
	 *
	 * @return array
	 */
	public function get_language_data( $lang = null ) {
		$output = array(
			'id'     => '',
			'name'   => '',
			'flag'   => '',
			'locale' => '',
			'url'    => '',
		);

		if ( is_null( $lang ) ) {
			return $output;
		}

		$languages = $this->get_all_languages();

		if ( is_array( $languages ) ) {
			foreach ( $languages as $_language ) {
				if ( $_language['id'] == $lang ) {
					$output = $_language;
				}
			}
		}

		return $output;
	}

	/**
	 * Returns multilingual language information.
	 *
	 * @since 1.0
	 *
	 * @param null $lang
	 *
	 * @return array
	 */
	public function get_current_language_data() {
		$lang = $this->get_current_lang_raw();

		return $this->get_language_data( $lang );
	}


	/**
	 * Used for finding current language in multilingual.
	 *
	 * @since 1.0
	 *
	 * @return string
	 */
	public function get_current_lang_raw() {
		$active_plugin = $this->get_active_plugin();

		switch ( $active_plugin ) {
			case 'Polylang':
				$lang = pll_current_language();

				$langs_list = pll_languages_list();

				// Fix conditions Polylang is active but not setup
				if ( count( $langs_list ) == 0 ) {
					$lang = '';
				} elseif ( ! $lang ) {
					$lang = '';
				}
				break;
			case 'WPML':
				$lang = icl_get_current_language();

				// Fix conditions WPML is active but not setup
				if ( is_null( $lang ) ) {
					$lang = '';
				}
				break;
			case 'WPGlobus':
				// WPGlobe : http://www.wpglobus.com/
				// Tip for separating admin language when user selects specific locale
				if ( is_admin() ) {
					// get all xili active languages
					$languages = ak_get_all_languages();

					// get current locale
					$locale = get_locale();

					foreach ( (array) $languages as $_lang ) {
						if ( $_lang['locale'] == $locale ) {
							$lang = $_lang['id'];
						}
					}
				} else {
					$lang = WPGlobus::Config()->language;
				}
				break;
			default:
				$lang = 'none';
				break;
		}

		$this->current_lang = $lang;

		return $lang;
	}

	/**
	 * Used for finding current language in multilingual.
	 *
	 * @since 1.0
	 *
	 * @return string
	 */
	public function get_current_lang() {
		$lang = $this->get_current_lang_raw();

		// Default language is en!
		if ( 'en' === $lang || 'none' === $lang ) {
			$lang = '';
		}

		return $lang;
	}

	/**
	 * Returns all active multilingual languages.
	 *
	 * @since 1.0
	 *
	 * @return array
	 */
	public function get_all_languages() {
		$active_plugin = $this->get_active_plugin();

		$languages = array();

		switch ( $active_plugin ) {
			case 'Polylang':
				$_languages = pll_languages_list( array( 'fields' => 'locale' ) );

				foreach ( (array) $_languages as $_lang ) {
					//get_language
					global $polylang;

					$_raw_lang = $polylang->model->get_language( $_lang );

					$languages[] = array(
						'id'     => $_raw_lang->slug,
						'name'   => $_raw_lang->name, // english display name
						'flag'   => $_raw_lang->flag_url,
						'locale' => $_raw_lang->locale,
						'url'    => $_raw_lang->home_url,
					);
				}
				break;
			case 'WPML':
				global $sitepress;

				// get filtered active language informations
				$temp_lang = icl_get_languages( 'skip_missing=1' );

				foreach ( $temp_lang as $lang ) {
					// Get language raw data from DB
					$_lang = $sitepress->get_language_details( $lang['language_code'] );

					$languages[] = array(
						'id'     => $lang['language_code'],
						'name'   => $_lang['english_name'], // english display name
						'flag'   => $lang['country_flag_url'],
						'locale' => $lang['default_locale'],
						'url'    => $lang['url'],
					);
				}
				break;
			case 'WPGlobus':
				$_languages = WPGlobus::Config()->enabled_languages;

				foreach ( (array) $_languages as $lang ) {
					$languages[] = array(
						'id'     => $lang,
						'name'   => WPGlobus::Config()->en_language_name[ $lang ], // english display name
						'flag'   => WPGlobus::Config()->flags_url . WPGlobus::Config()->flag[ $lang ],
						'locale' => WPGlobus::Config()->locale[ $lang ],
						'url'    => WPGlobus_Utils::localize_current_url( $lang ),
					);
				}

				break;
		}

		return $languages;
	}

	/**
	 * Returns default language.
	 *
	 * @todo test this
	 *
	 * @since 1.0
	 *
	 * @return array
	 */
	public function get_default_language() {
		$active_plugin = $this->get_active_plugin();

		$lang = '';

		switch ( $active_plugin ) {
			case 'Polylang':
				$lang = pll_default_language();
				break;
			case 'WPML':
				global $sitepress;
				$lang = $sitepress->get_default_language();
				break;
			case 'WPGlobus':
				$lang = WPGlobus::Config()->default_language;
				break;
		}

		return $lang;
	}

	public function add_language_info( $panel_id, $page_id ) {
		if ( 'option-panel' === $panel_id ) {
			$language = $this->get_current_language_data();

			if ( $language ) {
				echo '<div class="ak-notice ak-notice-danger ak-panel-multi-language-info">';
				echo "<div class='title'>{$language['name']}</div>";
				echo '</div>';
			}
		}
	}
}
