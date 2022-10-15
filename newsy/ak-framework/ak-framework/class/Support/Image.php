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

namespace Ak\Support;

/**
 * Class Ak Framework Image.
 */
class Image {

	/**
	 * @var Image
	 */
	private static $instance;

	/**
	 * The user defined image sizes.
	 *
	 * @var array
	 */
	private $sizes = array();

	private $expand_range = 700;

	/**
	 * @return Image
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	private function __construct() {
		$this->register_image_size();
		$this->register_hooks();
	}

	/**
	 * Get the registered image sizes.
	 */
	public function get_sizes() {
		if ( empty( $this->sizes ) ) {
			$this->sizes = apply_filters( 'ak-framework/image-sizes', array() );
		}

		return $this->sizes;
	}

	/**
	 * Register theme image sizes.
	 *
	 * @return void
	 */
	public function register_image_size() {
		$sizes = $this->get_sizes();
		foreach ( $sizes as $id => $image ) {
			add_image_size( $id, $image['width'], $image['height'], $image['crop'] );
		}

		add_filter( 'image_size_names_choose', array( $this, 'add_size_names_choose' ) );

		add_theme_support( 'post-thumbnails' );
	}

	/**
	 * Register theme image sizes.
	 *
	 * @return void
	 */
	public function register_hooks() {
		add_filter( 'ak_thumbnail_image', array( $this, 'thumbnail_image' ), 11, 4 );
		add_filter( 'ak_background_image', array( $this, 'background_image' ), 11, 3 );
		add_filter( 'ak_single_image', array( $this, 'single_image' ), 11, 4 );
		add_filter( 'ak_single_thumbnail', array( $this, 'single_thumbnail' ), 11, 3 );
	}

	/**
	 * Return the defined images sizes.
	 *
	 * @return array
	 */
	public function get_image_size( $size ) {
		return ! empty( $this->sizes[ $size ] ) ? $this->sizes[ $size ] : false;
	}

	/**
	 * Filter media size drop down options. Add user custom image sizes.
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	public function add_size_names_choose( $options ) {
		foreach ( $this->sizes as $slug => $props ) {
			if ( ! isset( $options[ $slug ] ) ) {
				$options[ $slug ] = isset( $props['label'] ) ? $props['label'] : $slug;
			}
		}

		return $options;
	}

	/**
	 * Check if image is a GIF file.
	 *
	 * @param $image_src
	 *
	 * @return bool
	 */
	public function is_gif_file( $image_src ) {
		$filetype = wp_check_filetype( $image_src );

		return 'gif' === $filetype['ext'];
	}

	/**
	 * @param $image_id
	 * @param $size
	 *
	 * @return string
	 */
	public function get_image_url( $image_id, $size ) {
		$image = wp_get_attachment_image_src( $image_id, $size );

		if ( $this->is_gif_file( $image[0] ) ) {
			$image = wp_get_attachment_image_src( $image_id, 'full' );

			return $image[0];
		}

		return $image[0];
	}

	public function alt_text( $id ) {
		$image = get_post( $id );

		if ( $image ) {
			$image_alt = get_post_meta( $image->ID, '_wp_attachment_image_alt', true );

			if ( empty( $image_alt ) && ! empty( $image->post_parent ) ) {
				$image_alt = wp_strip_all_tags( get_the_title( $image->post_parent ) );
			}

			return 'title="' . $image_alt . '"';
		}

		return '';
	}

	/**
	 * @param $post_id
	 * @param $size
	 *
	 * @return string
	 */
	public function thumbnail_image( $output, $post_id, $size, $auto_wrap = false ) {
		add_filter( 'wp_get_attachment_image_attributes', array( $this, 'filter_image_attributes' ), 10, 2 );

		$style            = '';
		$additional_class = '';
		$has_thumbnail    = has_post_thumbnail( $post_id );
		$image_size       = $this->get_image_size( $size );

		if ( ! $has_thumbnail ) {
			$additional_class .= ' no_thumbnail';
		}

		if ( ! $image_size ) {
			$auto_wrap = true;
			$size      = 'post-thumbnail';
		}

		if ( $has_thumbnail && $auto_wrap ) {
			$post_thumbnail_id = get_post_thumbnail_id( $post_id );
			$attachment_size   = wp_get_attachment_image_src( $post_thumbnail_id, $size );

			if ( $attachment_size ) {
				$percentage = round( $attachment_size[2] / $attachment_size[1] * 100, 3 );

				$style             = ' style="padding-bottom:' . $percentage . '%"';
				$additional_class .= ' size-auto';
			} else {
				$additional_class .= ' no_thumbnail';
			}
		} else {
			$dimension = $image_size ? $image_size['dimension'] : '500';

			$additional_class .= ' size-' . $dimension;
		}

		$output .= "<div class=\"ak-featured-thumb lazy-thumb{$additional_class}\" {$style}>";
		if ( $has_thumbnail ) {
			$output .= get_the_post_thumbnail( $post_id, $size );
		}
		$output .= '</div>';

		ak_remove_filters( 'wp_get_attachment_image_attributes', array( $this, 'filter_image_attributes' ), 10 );

		return $output;
	}

	/**
	 * @param $post_id
	 * @param $size
	 *
	 * @return string
	 */
	public function background_image( $output, $post_id, $size ) {
		$image_size        = $this->get_image_size( $size );
		$additional_class  = '';
		$image             = '';
		$post_thumbnail_id = '';

		if ( ! $image_size ) {
			$size = 'full';
		}

		if ( ! has_post_thumbnail( $post_id ) ) {
			$additional_class = 'no_thumbnail';
		} else {
			$post_thumbnail_id = get_post_thumbnail_id( $post_id );
			$image             = $this->get_image_url( $post_thumbnail_id, $size );
		}

		if ( $image_size ) {
			$additional_class .= ' size-' . $image_size['dimension'];
		}

		$output .= "<div class=\"ak-featured-thumb lazy-thumb background-thumb {$additional_class}\">
                        <div class=\"lazyload\" {$this->alt_text($post_thumbnail_id)} data-bgset=\"$image 800w\" ></div>
                      </div>";

		return $output;
	}

	/**
	 * @param $post_id
	 * @param $size
	 * @return string
	*/
	public function single_image( $output, $id, $size, $caption = true ) {
		add_filter( 'wp_get_attachment_image_attributes', array( $this, 'filter_image_attributes' ), 10, 2 );

		$image_size = wp_get_attachment_image_src( $id, $size );
		$image      = get_post( $id );
		$percentage = $image_size ? round( $image_size[2] / $image_size[1] * 100, 3 ) : 71.5;

		$output .= '<div class="ak-featured-thumb lazy-thumb" style="padding-bottom:' . $percentage . '%">';
		$output .= wp_get_attachment_image( $id, $size );
		$output .= '</div>';

		if ( $caption && ! empty( $image->post_excerpt ) ) {
			$output .= '<p class="wp-caption-text">' . $image->post_excerpt . '</p>';
		}

		ak_remove_filters( 'wp_get_attachment_image_attributes', array( $this, 'filter_image_attributes' ), 10 );

		return $output;
	}

	/**
	 * @param $id
	 * @param $size
	 * @return string
	*/
	public function single_thumbnail( $output, $id, $size ) {
		$image_size = $this->get_image_size( $size );
		$dimension  = $image_size ? $image_size['dimension'] : '500';

		add_filter( 'wp_get_attachment_image_attributes', array( $this, 'filter_thumbnail_attributes' ), 10, 2 );

		$output .= '<div class="ak-featured-thumb lazy-thumb size-' . $dimension . '">';
		$output .= wp_get_attachment_image( $id, $size );
		$output .= '</div>';

		ak_remove_filters( 'wp_get_attachment_image_attributes', array( $this, 'filter_thumbnail_attributes' ), 10 );

		return $output;
	}

	/**
	 * @param $attr
	 * @param $image
	 *
	 * @return mixed
	 */
	public function filter_image_attributes( $attr, $image ) {
		$attr['class']       = $attr['class'] . ' lazyload';
		$attr['data-src']    = $attr['src'];
		$attr['data-sizes']  = 'auto';
		$attr['data-srcset'] = isset( $attr['srcset'] ) ? $attr['srcset'] : '';
		$attr['data-expand'] = $this->expand_range;
		$attr['src']         = $this->get_empty_image();

		if ( empty( $attr['alt'] ) && ! empty( $image->post_parent ) ) {
			$attr['alt'] = wp_strip_all_tags( get_the_title( $image->post_parent ) );
		}

		unset( $attr['srcset'], $attr['sizes'] );

		return $attr;
	}

	/**
	 * @param $attr
	 * @param $image
	 *
	 * @return mixed
	 */
	public function filter_thumbnail_attributes( $attr, $image ) {
		$attr['class']    = $attr['class'] . ' lazyload';
		$attr['data-src'] = $attr['src'];
		$attr['src']      = $this->get_empty_image();

		if ( empty( $attr['alt'] ) && ! empty( $image->post_parent ) ) {
			$attr['alt'] = wp_strip_all_tags( get_the_title( $image->post_parent ) );
		}

		unset( $attr['srcset'], $attr['sizes'] );

		return $attr;
	}

	public function get_empty_image() {
		return 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
	}
}
