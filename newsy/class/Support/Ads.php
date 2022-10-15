<?php

namespace Newsy\Support;

/**
 * Newsy Ads Class.
 */
class Ads {

	/**
	 * @var Ads
	 */
	private static $instance;

	/**
	 * @return Ads
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
			static::$instance->init();
		}

		return static::$instance;
	}

	/**
	 * Fire up hooks.
	 */
	private function init() {
		add_action( 'newsy_main_before', array( $this, 'background_ads' ) );
		add_action( 'newsy_header_before', array( $this, 'header_top_ad' ), 15 );
		add_action( 'newsy_header_after', array( $this, 'header_bottom_ad' ), 15 );
		add_action( 'newsy_content_after', array( $this, 'footer_top_ad' ) );
		add_action( 'newsy_archive_content_before', array( $this, 'archive_grid_before' ), 19 );
		add_action( 'newsy_archive_content_before', array( $this, 'archive_grid_after' ), 21 );
		add_action( 'newsy_single_before', array( $this, 'single_post_before_ad' ) );
		add_action( 'newsy_single_post_content_before', array( $this, 'single_post_article_before_ad' ) );
		add_action( 'newsy_single_post_content_after', array( $this, 'single_post_article_after_ad' ) );
		add_filter( 'the_content', array( $this, 'single_post_article_content_ad' ), 999 );
	}

	public function background_ads() {
		$url    = esc_url( newsy_get_option( 'background_ads_url' ) );
		$output = '';

		if ( ! empty( $url ) ) {
			$new_tab = newsy_get_option( 'background_ads_open_tab' ) !== 'no' ? '_blank' : '';
			$output  = "<div class=\"bgads\"><a href=\"$url\" target='{$new_tab}'></a></div>";
		}
		newsy_sanitize_echo( $output );
	}

	public function header_top_ad() {
		newsy_get_ad( 'header_top_ad', 3 );
	}

	public function header_bottom_ad() {
		newsy_get_ad( 'header_bottom_ad', 3 );
	}

	public function footer_top_ad() {
		newsy_get_ad( 'footer_top_ad', 3 );
	}

	public function archive_grid_before() {
		newsy_get_ad( 'archive_grid_before_ad', 3 );
	}

	public function archive_grid_after() {
		newsy_get_ad( 'archive_grid_after_ad', 3 );
	}

	public function check_post_ad_override() {
		static $override;

		if ( is_bool( $override ) ) {
			return $override;
		}

		$override = ak_get_post_meta( 'enable_ad_override', get_the_ID() ) === 'on' ? true : false;

		return $override;
	}


	public function newsy_get_post_ad( $id, $block_width = null ) {
		if ( $this->check_post_ad_override() ) {
			$atts = ak_get_post_meta( $id, get_the_ID() );
			newsy_get_ad( $id . '_', $block_width, $atts );
		} else {
			newsy_get_ad( $id, $block_width );
		}
	}

	public function single_post_before_ad() {
		$this->newsy_get_post_ad( 'single_post_top_ad', 3 );
	}

	public function single_post_article_before_ad() {
		$this->newsy_get_post_ad( 'single_post_article_top_ad', 2 );
	}

	public function single_post_article_after_ad() {
		$this->newsy_get_post_ad( 'single_post_article_bottom_ad', 2 );
	}

	public function single_post_article_content_ad( $content ) {
		if ( function_exists( 'amp_is_request' ) && amp_is_request() ) {
			return $content;
		}

		if ( is_single() && ! is_admin() && get_post_type() === 'post' ) {
			if ( $this->check_post_ad_override() ) {
				$ads = ak_get_post_meta( 'single_post_article_content_ad', get_the_ID() );
			} else {
				$ads = newsy_get_option( 'single_post_article_content_ad' );
			}

			if ( ! empty( $ads ) && is_array( $ads ) ) {
				$par_count = $this->get_paragraph_count( $content );

				foreach ( $ads as  $ad ) {
					if ( empty( $ad['type'] ) || empty( $ad['ad_position'] ) ) {
						continue;
					}

					$ad_position = absint( $ad['ad_position'] );

					if ( $ad_position > ( $par_count - 2 ) ) {
						// continue;
					}

					$ad_align = ! empty( $ad['ad_align'] ) ? $ad['ad_align'] : 'center';

					$ad_instance = ak_get_shortcode( 'newsy_ad' );

					$ad_code = $ad_instance->render_shortcode(
						array_merge(
							$ad,
							array(
								'block_width' => 'center' === $ad_align ? 2 : 1,
								'classes'     => 'ak-ad-article ad-position-' . $ad_position . ' align' . $ad_align,
							)
						), null
					);

					$content = $this->prefix_insert_after_paragraph( $ad_code, $ad_position, $content );
				}
			}
		}

		return $content;
	}

	public function get_paragraph_count( $content ) {
		$paragraphs = explode( '<p>', $content );
		$count      = 0;
		if ( is_array( $paragraphs ) ) {
			foreach ( $paragraphs as $paragraph ) {
				if ( strlen( $paragraph ) > 1 ) {
					$count++;
				}
			}
		}
		return $count;
	}

	public function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
		$opening_p  = '<p>';
		$closing_p  = '</p>';
		$paragraphs = explode( $opening_p, $content );

		foreach ( $paragraphs as $index => $paragraph ) {
			if ( $paragraph_id === $index ) {
				$_par = explode( $closing_p, $paragraph );

				if ( trim( $_par[0] ) ) {
					$paragraph = $_par[0] . $closing_p . $insertion;
					unset( $_par[0] );
					$paragraph .= implode( '', $_par );
				}
			}

			if ( trim( $paragraph ) ) {
				$paragraphs[ $index ] = $opening_p . $paragraph;
			}
		}

		return implode( '', $paragraphs );
	}
}
