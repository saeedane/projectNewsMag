<?php

namespace Newsy\Support;

/**
 * Class Newsy oEmbed.
 */
class Embed {

	/**
	 * @var Embed
	 */
	private static $instance;

	/**
	 * @return Embed
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
			static::$instance->setup_hook();
		}
		return static::$instance;
	}

	/**
	 * Setup hook function.
	 */
	public function setup_hook() {
		add_filter( 'oembed_providers', array( $this, 'add_facebook_support' ), 10 );
		add_filter( 'oembed_fetch_url', array( $this, 'append_facebook_token' ), 10 );
	}

	/**
	 * Add support for Facebook and Instragram oEmbed.
	 *
	 * @param array $providers      Providers.
	 *
	 * @return array
	 */
	public function add_facebook_support( $providers ) {
		$extra_providers = array(
			// Facebook.
			'#https?://www\.facebook\.com/.*/posts/.*#i'  => array( 'https://graph.facebook.com/v8.0/oembed_post', true ),
			'#https?://www\.facebook\.com/.*/activity/.*#i' => array( 'https://graph.facebook.com/v8.0/oembed_post', true ),
			'#https?://www\.facebook\.com/.*/photos/.*#i' => array( 'https://graph.facebook.com/v8.0/oembed_post', true ),
			'#https?://www\.facebook\.com/photo(s/|\.php).*#i' => array( 'https://graph.facebook.com/v8.0/oembed_post', true ),
			'#https?://www\.facebook\.com/permalink\.php.*#i' => array( 'https://graph.facebook.com/v8.0/oembed_post', true ),
			'#https?://www\.facebook\.com/media/.*#i'     => array( 'https://graph.facebook.com/v8.0/oembed_post', true ),
			'#https?://www\.facebook\.com/questions/.*#i' => array( 'https://graph.facebook.com/v8.0/oembed_post', true ),
			'#https?://www\.facebook\.com/notes/.*#i'     => array( 'https://graph.facebook.com/v8.0/oembed_post', true ),
			'#https?://www\.facebook\.com/.*/videos/.*#i' => array( 'https://graph.facebook.com/v8.0/oembed_video', true ),
			'#https?://www\.facebook\.com/video\.php.*#i' => array( 'https://graph.facebook.com/v8.0/oembed_video', true ),
			'#https?://www\.facebook\.com/watch/?\?v=\d+#i' => array( 'https://graph.facebook.com/v8.0/oembed_video', true ),

			// Instagram.
			'#https?://(www\.)?instagr(\.am|am\.com)/(p|tv)/.*#i' => array( 'https://graph.facebook.com/v8.0/instagram_oembed', true ),
			'#https?://(www\.)?instagr(\.am|am\.com)/p/.*#i' => array( 'https://graph.facebook.com/v8.0/instagram_oembed', true ),
		);

		$providers = array_merge( $providers, $extra_providers );

		return $providers;
	}

	/**
	 * Convert Facebook URLs to include a token
	 *
	 * @param string $provider_url          Provider URL.
	 *
	 * @return string
	 */
	public function append_facebook_token( $provider_url ) {
		if ( 0 !== strpos( $provider_url, 'https://graph.facebook.com/v8.0/' ) ) {
			return $provider_url;
		}

		$access_token = newsy_get_facebook_access_token();

		if ( ! empty( $access_token ) ) {
			return $provider_url;
		}

		return sprintf( '%s&access_token=%s', $provider_url, urlencode( $access_token ) );
	}
}
