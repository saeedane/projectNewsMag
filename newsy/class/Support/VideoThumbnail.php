<?php

namespace Newsy\Support;

/**
 * Class Newsy Video Thumbnail.
 */
class VideoThumbnail {

	/**
	 * @var VideoThumbnail
	 */
	private static $instance;

	/**
	 * @var string
	 */
	private $meta_name = 'newsy_video_thumbnail';

	/**
	 * VideoThumbnail constructor.
	 */
	private function __construct() {
		$this->setup_hook();
	}

	/**
	 * @return VideoThumbnail
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}
		return static::$instance;
	}

	/**
	 * Setup hook function.
	 */
	public function setup_hook() {
		add_action( 'wp_after_insert_post', array( $this, 'video_thumbnail' ), 999 );
	}

	/**
	 * Video Post Thumbnail.
	 *
	 * @param integer $post_id
	 */
	public function video_thumbnail( $post_id = '' ) {
		if ( ! empty( $post_id ) ) {
			$featured_video = ak_get_post_meta( 'featured_video', (int) $post_id );

			if ( ! defined( 'XMLRPC_REQUEST' )
				&& ! has_post_thumbnail( $post_id )
				&& get_post_format( $post_id ) === 'video'
				&& ! empty( $featured_video )
				&& ! empty( $featured_video['url'] )
			) {
				$video_url = $featured_video['url'];
				if ( get_post_meta( $post_id, $this->meta_name, true ) != $video_url ) {
					$video_id      = $this->get_video_id( $video_url );
					$video_type    = $this->get_video_provider( $video_url );
					$thumbnail_url = ( $video_id ) ? $this->get_thumbnail_url( $video_id, $video_type ) : '';

					if ( $thumbnail_url ) {
						$attach_id = $this->save_to_media_library( $post_id, $thumbnail_url );
						$this->set_featured_image( $post_id, $attach_id, $video_url );
					}
				}
			}
		}
	}

	/**
	 * Get video id.
	 *
	 * @param string $video_url
	 *
	 * @return string
	 */
	public function get_video_id( $video_url ) {
		$video_type = $this->get_video_provider( $video_url );
		$video_id   = '';

		if ( 'youtube' === $video_type ) {
			$regexes = array(
				'#(?:https?:)?//www\.youtube(?:\-nocookie|\.googleapis)?\.com/(?:v|e|embed)/([A-Za-z0-9\-_]+)#',
				// Comprehensive search for both iFrame and old school embeds
				'#(?:https?(?:a|vh?)?://)?(?:www\.)?youtube(?:\-nocookie)?\.com/watch\?.*v=([A-Za-z0-9\-_]+)#',
				// Any YouTube URL. After http(s) support a or v for Youtube Lyte and v or vh for Smart Youtube plugin
				'#(?:https?(?:a|vh?)?://)?youtu\.be/([A-Za-z0-9\-_]+)#',
				// Any shortened youtu.be URL. After http(s) a or v for Youtube Lyte and v or vh for Smart Youtube plugin
				'#<div class="lyte" id="([A-Za-z0-9\-_]+)"#',
				// YouTube Lyte
				'#data-youtube-id="([A-Za-z0-9\-_]+)"#',
				// LazyYT.js
			);

			foreach ( $regexes as $regex ) {
				if ( preg_match( $regex, $video_url, $matches ) ) {
					$video_id = $matches[1];
				}
			}
		}

		if ( 'vimeo' === $video_type ) {
			$regexes = array(
				'#<object[^>]+>.+?http://vimeo\.com/moogaloop.swf\?clip_id=([A-Za-z0-9\-_]+)&.+?</object>#s',
				// Standard Vimeo embed code
				'#(?:https?:)?//player\.vimeo\.com/video/([0-9]+)#',
				// Vimeo iframe player
				'#\[vimeo id=([A-Za-z0-9\-_]+)]#',
				// JR_embed shortcode
				'#\[vimeo clip_id="([A-Za-z0-9\-_]+)"[^>]*]#',
				// Another shortcode
				'#\[vimeo video_id="([A-Za-z0-9\-_]+)"[^>]*]#',
				// Yet another shortcode
				'#(?:https?://)?(?:www\.)?vimeo\.com/([0-9]+)#',
				// Vimeo URL
				'#(?:https?://)?(?:www\.)?vimeo\.com/channels/(?:[A-Za-z0-9]+)/([0-9]+)#',
				// Channel URL
			);

			foreach ( $regexes as $regex ) {
				if ( preg_match( $regex, $video_url, $matches ) ) {
					$video_id = $matches[1];
				}
			}
		}

		if ( 'dailymotion' === $video_type ) {
			$regexes = array(
				'#<object[^>]+>.+?http://www\.dailymotion\.com/swf/video/([A-Za-z0-9]+).+?</object>#s',
				// Dailymotion flash
				'#//www\.dailymotion\.com/embed/video/([A-Za-z0-9]+)#',
				// Dailymotion iframe
				'#(?:https?://)?(?:www\.)?dailymotion\.com/video/([A-Za-z0-9]+)#',
				// Dailymotion URL
				'#(?:https?://)?(?:www\.)?dai\.ly/([A-Za-z0-9]+)#',
			);

			foreach ( $regexes as $regex ) {
				if ( preg_match( $regex, $video_url, $matches ) ) {
					$video_id = $matches[1];
				}
			}
		}

		return $video_id;
	}

	/**
	 * Get video/embed provider from the url.
	 *
	 * @param string $video_url
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public function get_video_provider( $video_url ) {
		if ( strpos( $video_url, 'youtube' ) > 0 ) {
			$provider = 'youtube';
		} elseif ( strpos( $video_url, 'youtu.be' ) > 0 ) {
			$provider = 'youtube';
		} elseif ( strpos( $video_url, 'vimeo' ) > 0 ) {
			$provider = 'vimeo';
		} elseif ( strpos( $video_url, 'dailymotion' ) > 0 ) {
			$provider = 'dailymotion';
		} else {
			$provider = strtolower( pathinfo( $video_url, PATHINFO_EXTENSION ) );
		}

		return apply_filters( 'newsy_video_provider', $provider, $video_url );
	}

	/**
	 * Get thumbnail url.
	 *
	 * @param string $video_id
	 * @param string $video_type
	 *
	 * @return string
	 */
	public function get_thumbnail_url( $video_id, $video_type ) {
		$thumbnail_url = '';

		if ( 'youtube' === $video_type ) {
			$response = wp_remote_get( 'http://img.youtube.com/vi/' . $video_id . '/maxresdefault.jpg' );

			if ( ! is_wp_error( $response ) && '200' == $response['response']['code'] ) {
				$thumbnail_url = 'http://img.youtube.com/vi/' . $video_id . '/maxresdefault.jpg';
			} else {
				$thumbnail_url = 'http://img.youtube.com/vi/' . $video_id . '/0.jpg';
			}
		}

		if ( 'vimeo' === $video_type ) {
			$response = wp_remote_get( 'http://vimeo.com/api/v2/video/' . $video_id . '.json' );

			if ( ! is_wp_error( $response ) && '200' == $response['response']['code'] ) {
				$thumbnail_url = json_decode( $response['body'] );
				$thumbnail_url = ( is_object( $thumbnail_url[0] ) ) ? $thumbnail_url[0]->thumbnail_large : '';
			}
		}

		return $thumbnail_url;
	}

	/**
	 * Save video thumbnail into media library.
	 *
	 * @param integer $post_id
	 * @param string $thumbnail_url
	 *
	 * @return int thumbnail id
	 */
	public function save_to_media_library( $post_id, $thumbnail_url ) {
		$response = wp_remote_get( $thumbnail_url );

		if ( ! is_wp_error( $response ) && '200' == $response['response']['code'] ) {
			$image_content = $response['body'];
			$image_type    = wp_remote_retrieve_header( $response, 'content-type' );

			// Translate MIME type into an extension
			if ( 'image/jpeg' == $image_type ) {
				$image_extension = '.jpg';
			} elseif ( 'image/png' == $image_type ) {
				$image_extension = '.png';
			} elseif ( 'image/gif' == $image_type ) {
				$image_extension = '.gif';
			} else {
				return false;
			}

			$filename = $this->construct_filename( $post_id ) . $image_extension;
			$upload   = wp_upload_bits( $filename, null, $image_content );

			if ( ! $upload['error'] ) {
				$wp_filetype = wp_check_filetype( basename( $upload['file'] ), null );

				$upload = apply_filters(
					'wp_handle_upload', array(
						'file' => $upload['file'],
						'url'  => $upload['url'],
						'type' => $wp_filetype['type'],
					), 'sideload'
				);

				// Contstruct the attachment array
				$attachment = array(
					'post_mime_type' => $upload['type'],
					'post_title'     => get_the_title( $post_id ),
					'post_content'   => '',
					'post_status'    => 'inherit',
				);

				// Insert the attachment
				$attach_id = wp_insert_attachment( $attachment, $upload['file'], $post_id );
				require_once ABSPATH . 'wp-admin/includes/image.php';
				$attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
				wp_update_attachment_metadata( $attach_id, $attach_data );

				return $attach_id;
			}
		}
	}

	/**
	 * Set post thumbnail.
	 *
	 * @param integer    $post_id
	 * @param integer    $attach_id
	 * @param string $video_url
	 */
	public function set_featured_image( $post_id, $attach_id, $video_url ) {
		if ( ! ctype_digit( get_post_thumbnail_id( $post_id ) ) ) {
			set_post_thumbnail( $post_id, $attach_id );
			update_post_meta( $post_id, $this->meta_name, $video_url );
		}
	}

	/**
	 * Create filename for image thumbnail.
	 *
	 * @param integer $post_id
	 *
	 * @return string
	 */
	public function construct_filename( $post_id ) {
		$filename = get_the_title( $post_id );
		$filename = sanitize_title( $filename, $post_id );
		$filename = urldecode( $filename );
		$filename = preg_replace( '/[^a-zA-Z0-9\-]/', '', $filename );
		$filename = trim( $filename, '-' );
		$filename = ( '' == $filename ) ? (string) $post_id : $filename;

		return $filename;
	}
}
