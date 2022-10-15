<?php

namespace Newsy\Ajax;

use Newsy\Single\SinglePost;
use Newsy\Support\Comment;

/**
 * Class PostAjax.
 */
class PostAjax {

	/**
	 * Handle post ajax request.
	 *
	 * @return void
	 */
	public static function handle_autoload() {
		self::handle_check_post(
			array(
				'nonce'    => '',
				'post_id'  => '',
				'template' => '',
			)
		);
		self::handle_check_nonce();

		$post_id = sanitize_text_field( wp_unslash( $_POST['post_id'] ) );

		global $wp_query;
		$wp_query = ak_do_query(
			array(
				'count' => 1,
				'post'  => $post_id,
			)
		);

		if ( $wp_query->have_posts() ) {
			$the_post = SinglePost::get_instance();
			$the_post->init( $wp_query->post );

			$inline           = false;
			$inline_enabled   = newsy_get_option( 'post_autoload_inline' );
			$inline_templates = array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-13' );
			$prev_template    = sanitize_text_field( wp_unslash( $_POST['template'] ) );

			ob_start();
			if ( 'enabled' === $inline_enabled && in_array( $prev_template, $inline_templates, true ) ) {
				$inline = true;
				get_template_part( 'views/post/post-' . str_replace( 'style', 'article', $prev_template ) );
			} else {
				get_template_part( 'single', 'autoload' );
			}

			wp_send_json(
				array(
					'success' => 1,
					'inline'  => $inline,
					'html'    => ob_get_clean(),
				)
			);
		}

		wp_send_json(
			array(
				'success' => 0,
				'message' => '',
			)
		);
	}

	/**
	 * Handle ajax post count.
	 *
	 * @return mixed
	 */
	public static function handle_counter() {
		self::handle_check_post(
			array(
				'nonce'   => '',
				'post_id' => '',
			)
		);
		self::handle_check_nonce();

		$post_id = sanitize_text_field( wp_unslash( $_POST['post_id'] ) );

		$total_comment = Comment::get_instance()->get_total( $post_id, true );

		if ( function_exists( 'newsy_get_share_counts' ) ) {
			$total_share = newsy_get_share_counts( $post_id );
			$total_share = $total_share['total'];
		} else {
			$total_share = 0;
		}

		if ( function_exists( 'newsy_get_post_view_count' ) ) {
			$total_view = newsy_get_post_view_count( $post_id, true );
		} else {
			$total_view = 0;
		}

		$counter = apply_filters(
			'newsy_post_ajax_counter', array(
				'total_view'    => apply_filters( 'newsy_number_format', $total_view ),
				'total_share'   => apply_filters( 'newsy_number_format', $total_share ),
				'total_comment' => $total_comment,
			), $post_id
		);

		wp_send_json(
			array(
				'success' => 1,
				'counter' => $counter,
			)
		);
	}

	/**
	 * Handle ajax post comment form.
	 *
	 * @return mixed
	 */
	public static function handle_comments() {
		self::handle_check_post(
			array(
				'nonce'   => '',
				'post_id' => '',
			)
		);
		self::handle_check_nonce();

		if ( empty( $_POST['post_id'] ) ) {
			wp_send_json(
				array(
					'success' => 0,
					'message' => 'Invalid Request!',
				)
			);
		}

		$post_id = sanitize_text_field( wp_unslash( $_POST['post_id'] ) );

		// ajax comment
		query_posts(
			array(
				'p'            => $post_id,
				'withcomments' => 1,
				'feed'         => 1,
			)
		);

		while ( have_posts() ) :
			the_post();
			global $post;
			setup_postdata( $post );
			get_template_part( 'views/comments/comments' );
		endwhile;

		wp_reset_query();
	}

	private static function handle_check_nonce() {
		$nonce = sanitize_text_field( wp_unslash( $_POST['nonce'] ) );

		if ( empty( $nonce ) || ! wp_verify_nonce( $nonce, 'newsy_nonce' ) ) {
			wp_send_json(
				array(
					'success'       => 0,
					'refresh_nonce' => 1,
					'message'       => 'Invalid Token!',
				)
			);
		}
	}

	private static function handle_check_post( $required_keys ) {
		// checking for valid ajax params
		if ( array_diff_key( $required_keys, $_POST ) ) {
			wp_send_json(
				array(
					'success' => 0,
					'message' => 'Invalid Request!',
				)
			);
		}
	}
}
