<?php

namespace Newsy\Single;

use Newsy\TemplateAbstract;

/**
 * Single Page template class.
 */
class SinglePage extends TemplateAbstract {

	public $template_id = 'page';

	public $post;

	public $title_attribute;

	public $title;

	public $href;

	protected $post_thumb_id = null;

	/**
	 * @return SinglePage
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}
		return static::$instance;
	}

	/**
	 * @var SinglePage
	 */
	private static $instance;

	public function __construct() {
		parent::__construct();

		$this->init();
	}

	public function init() {
		$this->post = get_post();
		$this->id   = $this->post->ID;

		$this->title           = get_the_title( $this->id );
		$this->title_attribute = esc_attr( strip_tags( $this->title ) );
		$this->href            = esc_url( get_permalink( $this->id ) );

		if ( has_post_thumbnail( $this->id ) ) {
			$tmp_get_post_thumbnail_id = get_post_thumbnail_id( $this->id );
			if ( ! empty( $tmp_get_post_thumbnail_id ) ) {
				// if we have a wrong id, leave the post_thumb_id NULL
				$this->post_thumb_id = $tmp_get_post_thumbnail_id;
			}
		}
	}

	/**
	 * Get the post title.
	 */
	public function get_title() {
		if ( $this->get_option( 'show_title', '', false ) === 'hide' ) {
			return '';
		}

		the_title( '<h1 class="ak-post-title">', '</h1>' );
	}

	/**
	 * Get the featured post media.
	 *
	 * @param string $image_size
	 * @param boolean $inline
	 * @param boolean $auto_wrap
	 *
	 * @return string
	 */
	public function get_featured_image( $image_size = 'newsy_750x0', $inline = false, $auto_wrap = true ) {
		if ( $this->get_option( 'show_featured_image' ) === 'hide' || null === $this->post_thumb_id ) {
			return '';
		}

		$post_image = ak_get_post_image( $this->post->ID, $image_size, $inline, $auto_wrap );

		$output  = '<div class="ak-post-featured"><div class="ak-featured-cover">';
		$output .= $post_image;

		if ( ! $inline ) {
			$post_featured_image_credit = $this->get_option( 'featured_image_credit', '', false );

			if ( ! empty( $post_featured_image_credit ) ) {
				$output .= '<span class="ak-post-featured-credit">' . $post_featured_image_credit . '</span>';
			} else {
				$image_caption = wp_get_attachment_caption( $this->post_thumb_id );
				if ( ! empty( $image_caption ) ) {
					$output .= '<span class="ak-post-featured-credit">' . $image_caption . '</span>';
				}
			}
		}

		$output .= '</div></div>';

		newsy_sanitize_echo( $output );
	}
}
