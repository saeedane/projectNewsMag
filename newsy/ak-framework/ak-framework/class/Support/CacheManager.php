<?php
/**
 * The AkFramework.
 *
 * AkFramework is framework for themes and plugins for WordPress.
 *
 * Copyright © 2020 akbilisim
 * www.akbilisim.com
 *
 *  Envato Profile: https://themeforest.net/user/akbilisim
 */
namespace Ak\Support;

/**
 * Cache Handler.
 *
 * @since 1.0.2
 */
class CacheManager {
	/**
	 * @var CacheManager
	 */
	private static $instance;

	/**
	 * @return CacheManager
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	public function __construct() {
		// generate global css
		add_action( 'customize_save_after', array( $this, 'reset_caches_handler' ), 9999 );
		add_action( 'ak-framework/option-panel/save/after', array( $this, 'reset_caches_handler' ), 9999 );
		add_action( 'ak-framework/taxonomy/save/after', array( $this, 'reset_caches_handler' ), 9999 );
		add_action( 'ak-framework/demo/install/after', array( $this, 'reset_caches_handler' ), 9999 );
		add_action( 'ak-framework/demo/uninstall/after', array( $this, 'reset_caches_handler' ), 9999 );
	}

	/**
	 * Handles resetting caches.
	 *
	 * @access public
	 * @since 1.0.2
	 */
	public function reset_caches_handler() {
		if ( is_multisite() && is_main_site() ) {
			$sites = get_sites();
			foreach ( $sites as $site ) {
				switch_to_blog( $site->blog_id );
				$this->reset_all_caches();
				restore_current_blog();
			}
			return;
		}

		$this->reset_all_caches();
	}

	/**
	 * Resets all caches.
	 *
	 * @since 1.0.2
	 * @access public
	 * @param array $delete_cache An array of caches to delete.
	 * @return void
	 */
	public function reset_all_caches( $delete_cache = array() ) {
		$all_caches = apply_filters(
			'ak-framework/cache/reset/caches',
			array(
				'compiled_assets'    => true,
				'transients'         => array(),
				'dynamic_transients' => array(),
				'third_party_caches' => true,
			)
		);

		$delete_cache = wp_parse_args(
			$delete_cache,
			$all_caches
		);

		if ( ! in_array( true, $delete_cache, true ) ) {
			// Early exit if all set to false.
			return;
		}

		if ( ! empty( $delete_cache['transients'] ) ) {
			// Cleanup other transients.
			$transients = $delete_cache['transients'];
			foreach ( $transients as $transient ) {
				delete_transient( $transient );
				delete_site_transient( $transient );
			}
		}

		if ( ! empty( $delete_cache['dynamic_transients'] ) ) {
			// Delete transients with dynamic names.
			$dynamic_transients = $delete_cache['dynamic_transients'];
			global $wpdb;
			foreach ( $dynamic_transients as $transient ) {
				$wpdb->query( // phpcs:ignore WordPress.DB.DirectDatabaseQuery
					$wpdb->prepare(
						"DELETE FROM $wpdb->options WHERE option_name LIKE %s",
						$transient
					)
				);
			}
		}

		if ( true === $delete_cache['third_party_caches'] ) {
			// Delete 3rd-party caches.
			$this->clear_third_party_caches();
		}

		do_action( 'ak-framework/cache/reset/after' );
	}

	/**
	 * Clear cache from:
	 *  - W3TC,
	 *  - WordPress Total Cache
	 *  - WPEngine
	 *  - Varnish
	 *  - Wp Fastest Cache
	 *  - Wp Fastest Cache
	 *  - Autoptimize
	 *  - LiteSpeed Cache
	 *
	 * @access protected
	 * @since 1.0.2
	 */
	protected function clear_third_party_caches() {
		global $wp_fastest_cache;

		try {
			// if W3 Total Cache is being used, clear the cache
			if ( function_exists( 'w3tc_pgcache_flush' ) ) {
				w3tc_pgcache_flush();
			}

			if ( function_exists( 'wp_cache_clean_cache' ) ) {
				global $file_prefix, $supercachedir;
				if ( empty( $supercachedir ) && function_exists( 'get_supercache_dir' ) ) {
					$supercachedir = get_supercache_dir();
				}
				wp_cache_clean_cache( $file_prefix );
			}

			// Clear caches on WPEngine-hosted sites.
			if ( class_exists( 'WpeCommon' ) ) {
				if ( method_exists( 'WpeCommon', 'purge_memcached' ) ) {
					\WpeCommon::purge_memcached();
				}
				if ( method_exists( 'WpeCommon', 'clear_maxcdn_cache' ) ) {
					\WpeCommon::clear_maxcdn_cache();
				}
				if ( method_exists( 'WpeCommon', 'purge_varnish_cache' ) ) {
					\WpeCommon::purge_varnish_cache();
				}
			}

			if ( method_exists( 'WpFastestCache', 'deleteCache' ) && ! empty( $wp_fastest_cache ) ) {
				$wp_fastest_cache->deleteCache();
			}

			// if Autoptimize Cache is being used, clear the cache.
			if ( class_exists( 'autoptimizeCache' ) && method_exists( 'autoptimizeCache', 'clearall' ) ) {
				// autoptimizeCache::clearall();
			}

			// if LiteSpeed Cache is being used, clear the cache.
			if ( class_exists( 'LiteSpeed_Cache_API' ) && method_exists( 'LiteSpeed_Cache_API', 'purge_all' ) ) {
				\LiteSpeed_Cache_API::purge_all();
			}

			// If SG CachePress is installed, reset its caches.
			if ( class_exists( 'SG_CachePress_Supercacher' ) ) {
				if ( method_exists( 'SG_CachePress_Supercacher', 'purge_cache' ) ) {
					\SG_CachePress_Supercacher::purge_cache();
				}
			}
		} catch ( \Exception $e ) {
			// do nothing.
		}
	}
}
