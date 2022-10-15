<?php
namespace Newsy\Support;

/**
 * Newsy Comment Manager class.
 */
class Comment {

	/**
	 * @var Comment
	 */
	private static $instance;

	/**
	 * @var array
	 */
	public $comments;

	/**
	 * @var int
	 */
	private $comment_expired = 1;

	/**
	 * @var string
	 */
	private $comment_data_key = 'post_comments_data';

	/**
	 * @return Comment
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	public function __construct() {
		$this->comments = $this->get_comments();
	}

	public function get_suppored_comments( $comments = array() ) {
		return apply_filters( 'newsy_suppored_comments', $comments );
	}

	/**
	 * Return supported of post comments.
	 *
	 * @return array
	 */
	public function get_comments() {
		$suppored_comments = $this->get_suppored_comments();

		$comments = newsy_get_option( 'post_comments', 'wp' );

		if ( is_string( $comments ) ) {
			$comments = explode( ',', $comments );
		}

		$comments = apply_filters( 'newsy_post_comments', $comments );

		$results = array();
		foreach ( $comments as $comment ) {
			if ( isset( $suppored_comments[ $comment ] ) ) {
				$results[ $comment ] = $suppored_comments[ $comment ];
			}
		}

		return $results;
	}

	/**
	 * Render the tabs of post comments.
	 *
	 * @param integer $post_id
	 *
	 * @return string
	 */
	public function render_tabs( $post_id ) {
		$output = '<ul class="comment-tabs clearfix">';

		foreach ( $this->comments as $comment_type => $comment ) {
			$count = $this->get_number( $post_id, $comment_type );

			$output .= '<li class="tab-comment-button" data-type="' . $comment_type . '">';
			$output .= '<a href="#' . $comment_type . '-' . $post_id . '-comment-section">';
			$output .= ak_get_icon( $comment['icon'] );
			$output .= $comment['name'];
			if ( $count > 0 ) {
				$output .= '<span class="comments-count">' . $count . '</span>';
			}
			$output .= '</a>';
			$output .= '</li>';
		}

		$output .= '</ul>';

		newsy_sanitize_echo( $output );
	}

	/**
	 * Render the post comments.
	 *
	 * @param integer $post_id
	 *
	 * @return mixed
	 */
	public function render( $post_id ) {

		if ( count( $this->comments ) > 1 ) {
			$this->render_tabs( $post_id );
		}

		foreach ( $this->comments as $comment ) {
			if ( isset( $comment['file'] ) && file_exists( $comment['file'] ) ) {
				include $comment['file'];
			}
		}
	}

	/**
	 * Get the counts of post comments.
	 *
	 * @param integer $post_id
	 * @param string $comment_type
	 * @param boolean $force
	 *
	 * @return int
	 */
	public function get_number( $post_id, $comment_type, $force = false ) {
		if ( 'wp' === $comment_type ) {
			$comment_number = get_comments_number( $post_id );
		} else {
			$comment_number = $this->get_comments_count( $post_id, $comment_type, $force );
		}

		return (int) $comment_number;
	}

	/**
	 * Get the total counts of post comments.
	 *
	 * @param integer $post_id
	 * @param boolean $force
	 *
	 * @return int
	 */
	public function get_total( $post_id, $force = false ) {
		$count = 0;

		foreach ( $this->comments as $comment_type => $comment ) {
			$count += $this->get_number( $post_id, $comment_type, $force );
		}

		return $count;
	}

	/**
	 * Handle to get the counts of post comments.
	 *
	 * @param integer $post_id
	 * @param string $comment_type
	 * @param boolean $force_updated
	 *
	 * @return int
	 */
	protected function get_comments_count( $post_id = 0, $comment_type = 'wp', $force_updated = false ) {
		$post_id = $this->get_post_id( $post_id );

		$data_comment = ak_get_post_meta( $this->comment_data_key, $post_id );

		if ( $force_updated ) {
			// update works
			$comment_expired = (int) newsy_get_option( 'comments_cache_expired', $this->comment_expired ) * 60 * 60;
			$current_time    = current_time( 'timestamp' );

			if ( empty( $data_comment ) || ! empty( $data_comment ) && $data_comment['expired'] < ( $current_time - $comment_expired ) ) {
				// first or expired then update
				$data_comment = array(
					'expired' => $current_time,
				);
				foreach ( $this->comments as $_type => $_comment ) {
					$count = (int) $this->fetch_data( $post_id, $_type );
					if ( $count > 0 ) {
						$data_comment[ $_type ] = $this->fetch_data( $post_id, $_type );
					}
				}

				ak_update_post_meta( $this->comment_data_key, $post_id, $data_comment );
			}
		}

		return ! empty( $data_comment[ $comment_type ] ) ? $data_comment[ $comment_type ] : 0;
	}

	/**
	 * Fetch data of post comments.
	 *
	 * @param integer $post_id
	 * @param string $comment_type
	 *
	 * @return int
	 */
	protected function fetch_data( $post_id, $comment_type ) {
		$number = 0;

		if ( 'facebook' === $comment_type ) {
			$url    = 'https://graph.facebook.com/?id=' . get_permalink( $post_id );
			$result = $this->make_request( $url );

			if ( $result && ! empty( $result['share'] ) ) {
				$number = $result['share']['comment_count'];
			}
		}

		$disqus_api_key   = newsy_get_option( 'disqus_api_key', '' );
		$disqus_shortname = newsy_get_option( 'disqus_comment_shortname', '' );
		if ( 'disqus' === $comment_type && '' !== $disqus_api_key && '' !== $disqus_shortname ) {
			$url = 'https://disqus.com/api/3.0/threads/set.json?api_key=' . urlencode( $disqus_api_key ) . '&forum=' . urlencode( $disqus_shortname ) . '&thread:link=' . get_permalink( $post_id );

			$result = $this->make_request( $url );

			if ( $result && ! empty( $result['response'][0]['posts'] ) ) {
				$number = $result['response'][0]['posts'];
			}
		}

		return apply_filters( 'newsy_comments_fetch_count', $number, $post_id, $comment_type );
	}

	/**
	 * Make request.
	 *
	 * @param string $url
	 *
	 * @return bool|array (default:bool)
	 */
	protected function make_request( $url ) {
		$response = wp_remote_get( $url );

		if ( ! is_wp_error( $response ) && '200' == $response['response']['code'] ) {
			$result = json_decode( $response['body'], true );

			return $result;
		}

		return false;
	}

	/**
	 * Get post id.
	 *
	 * @param integer $post_id
	 *
	 * @return int
	 */
	protected function get_post_id( $post_id ) {
		$post = get_post( $post_id );

		if ( $post ) {
			$post_id = $post->ID;
		}

		return $post_id;
	}
}
