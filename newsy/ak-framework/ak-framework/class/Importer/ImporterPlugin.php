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
namespace Ak\Importer;

/**
 * Class ImporterPlugin handle to add new plugin.
 */
class ImporterPlugin {

	/**
	 * @var \TGM_Plugin_Activation
	 */
	private $tgm_instance;

	public function __construct() {
		do_action( 'tgmpa_register' );

		$this->tgm_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}

	public function create( $import_id ) {
		if ( $this->tgm_instance->is_plugin_active( $import_id ) ) {
			return true;
		}

		if ( $this->tgm_instance->is_plugin_installed( $import_id ) ) {
			return $this->activate_plugins( $import_id );
		}

		$install = $this->install( $import_id );

		if ( $install ) {
			return $this->activate_plugins( $import_id );
		}

		return false;
	}

	public function install( $slug, $action = 'install' ) {
		$slug   = $this->tgm_instance->sanitize_key( urldecode( $slug ) );
		$plugin = $this->tgm_instance->plugins[ $slug ];

		if ( ! $plugin ) {
			return false;
		}

		$extra         = array();
		$extra['slug'] = $slug;
		$source        = $this->tgm_instance->get_download_url( $slug );
		$api           = ( 'repo' === $plugin['source_type'] ) ? $this->tgm_instance->get_plugin_api( $slug ) : null;
		$api           = ( false !== $api ) ? $api : null;

		$url = add_query_arg(
			array(
				'action' => $action . '-plugin',
				'plugin' => urlencode( $slug ),
			),
			'update.php'
		);

		if ( ! class_exists( 'Plugin_Upgrader', false ) ) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		}

		$skin_args = array(
			'type'   => ( 'bundled' !== $plugin['source_type'] ) ? 'web' : 'upload',
			'title'  => $plugin['name'],
			'url'    => esc_url_raw( $url ),
			'nonce'  => $action . '-plugin_' . $slug,
			'plugin' => '',
			'api'    => $api,
			'extra'  => $extra,
		);

		if ( 'update' === $action ) {
			$skin_args['plugin'] = $plugin['file_path'];
			$skin                = new \Plugin_Upgrader_Skin( $skin_args );
		} else {
			$skin = new \Plugin_Installer_Skin( $skin_args );
		}

		$upgrader = new \Plugin_Upgrader( $skin );

		add_filter( 'upgrader_source_selection', array( $this->tgm_instance, 'maybe_adjust_source_dir' ), 1, 3 );

		set_time_limit( MINUTE_IN_SECONDS * 60 );
		// hack for removing vc redirect

		if ( 'update' === $action ) {
			$to_inject                    = array( $slug => $plugin );
			$to_inject[ $slug ]['source'] = $source;
			$this->tgm_instance->inject_update_info( $to_inject );

			$upgrader->upgrade( $plugin['file_path'] );
		} else {
			$upgrader->install( $source );
		}

		remove_filter( 'upgrader_source_selection', array( $this->tgm_instance, 'maybe_adjust_source_dir' ), 1 );

		$this->tgm_instance->populate_file_path( $slug );

		return true;
	}

	public function activate_plugins( $slug, $redirect = '', $network_wide = false, $silent = false ) {
		$slug        = $this->tgm_instance->sanitize_key( urldecode( $slug ) );
		$import_path = $this->tgm_instance->plugins[ $slug ]['file_path'];

		return activate_plugins( $import_path, $redirect, $network_wide, $silent );
	}

	public function deactivate_plugins( $slug, $silent = false, $network_wide = null ) {
		$slug        = $this->tgm_instance->sanitize_key( urldecode( $slug ) );
		$import_path = $this->tgm_instance->plugins[ $slug ]['file_path'];

		deactivate_plugins( $import_path, $silent, $network_wide );

		return true;
	}

	public static function remove( $id ) {
		return true;
	}
}
