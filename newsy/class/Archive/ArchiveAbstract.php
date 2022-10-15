<?php

namespace Newsy\Archive;

use Newsy\TemplateAbstract;

/**
 * Archive template abstract class.
 */
abstract class ArchiveAbstract extends TemplateAbstract {

	public $header_style;

	public $default_grid_style = 'newsy_grid_1';

	public $default_loop_style = 'newsy_list_1_medium';

	public $offset = 0;

	public function __construct() {
		parent::__construct();

		if ( 'style-3' === $this->get_archive_header_style() || 'style-4' === $this->get_archive_header_style() ) {
			add_action( 'newsy_archive_content_loop_before', array( $this, 'render_header' ), 10 );
		} else {
			add_action( 'newsy_archive_content_before', array( $this, 'render_header' ), 10 );
		}

		add_action( 'newsy_archive_content_before', array( $this, 'render_grid' ), 20 );

		add_filter( 'newsy_content_wrap_class', array( $this, 'add_archive_wrap_class' ), 11, 2 );

		add_filter( 'body_class', array( $this, 'add_archive_body_class' ) );
	}

	/**
	 * Get archive title.
	 *
	 * @param array $classes
	 * @return array
	 */
	public function get_archive_title() {
		return get_the_archive_title();
	}

	/**
	 * Get archive header style
	 *
	 * @param array $classes
	 * @return array
	 */
	public function get_archive_header_style() {
		if ( empty( $this->header_style ) ) {
			$this->header_style = $this->get_option( 'header_style', 'style-1' );
		}

		return $this->header_style;
	}

	/**
	 * Archive template wrapper classes
	 *
	 * @param array $classes
	 * @return array
	 */
	public function add_archive_wrap_class( $classes ) {
		$classes[] = 'ak-archive-wrap';

		if ( $this->get_option( 'grid_full' ) === 'on' ) {
			$classes[] = 'ak-archive-grid-full';
		}

		return $classes;
	}

	/**
	 * Archive template body classes
	 *
	 * @param array $classes
	 * @return array
	 */
	public function add_archive_body_class( $classes ) {
		if ( 'style-9' === $this->header_style || 'style-10' === $this->header_style ) {
			add_filter( 'newsy_header_rows', 'newsy_set_header_rows_dark_scheme', 11 );
			$classes[] = 'page-template-page-builder-overlay';
		}

		return $classes;
	}

	/**
	 * Render archive template header.
	 *
	 * @return string
	 */
	public function render_header() {
		// If Term header is not Active
		if ( $this->get_option( 'hide_term_header' ) === 'hide' ) {
			return '';
		}

		// Term Header Name
		$term_title = $this->get_option( 'custom_term_name', $this->get_archive_title() );

		// Term Header Logo
		$custom_header_logo = $this->get_option( 'header_custom_logo' );
		if ( ! empty( $custom_header_logo ) ) {
			$custom_header_logo = '<img class="ak-archive-logo" src="' . $custom_header_logo . '" alt="' . $term_title . '" />';
		}

		$term_name_hidden = 'hide' === $this->get_option( 'show_term_name' ) ? ' hidden' : '';

		$term_name = '<h1 class="ak-archive-name' . $term_name_hidden . '"><span class="archive-name-text">' . $term_title . '</span></h1>';

		// Term Header Description
		$show_description = $this->get_option( 'show_description' );
		$description      = '';
		if ( 'hide' !== $show_description && ! empty( $this->term->description ) ) {
			$description = '<div class="ak-archive-desc">' . $this->term->description . '</div>';
		}

		$breadcrumb    = $this->get_breadcrumb( false, false );
		$header_bottom = $this->get_header_bottom();

		// Term Bg image
		if ( in_array( $this->header_style, array( 'style-5', 'style-6', 'style-7', 'style-8', 'style-9', 'style-10' ), true ) ) {
			$this->header_style .= ' archive-header-has-bg dark';
		}

		echo "<div class=\"ak-archive-header {$this->header_style}\">
                    <div class=\"container\">
                        {$breadcrumb}
                        <div class=\"ak-archive-header-inner\">
                            <div class=\"ak-archive-head clearfix\">
                                 {$custom_header_logo}
                                <div class=\"ak-archive-head-inner\">
                                      {$term_name}
                                      {$description}
                                </div>
                            </div>
                            {$header_bottom}
                        </div>
                    </div>
                </div>";
	}

	/**
	 * This function must override in child's for displaying header bottom.
	 *
	 * @return string
	 */
	public function get_header_bottom() {
		return '';
	}

	/**
	 * Render archive template grid.
	 *
	 * @return string
	 */
	public function render_grid() {
		$slider = $this->get_option( 'grid', $this->default_grid_style, 'hide' !== $this->default_grid_style );

		// if term header is not active
		if ( 'hide' === $slider || ! function_exists( 'ak_get_shortcode' ) ) {
			return;
		}

		$block = '';

		$grid_instance = ak_get_shortcode( $slider );
		if ( $grid_instance ) {
			$slider_args = array(
				'gradient'            => $this->get_option( 'grid_gradient' ),
				'item_margin'         => $this->get_option( 'grid_item_margin' ),
				'grid_height'         => $this->get_option( 'grid_height' ),
				'block_accent_color'  => $this->get_option( 'color' ),
				'block_width'         => 3,
				'block_extra_classes' => $this->get_option( 'grid_block_classes' ),
				'show_no_result'      => false,
			);
			$slider_args = apply_filters( 'newsy_archive_grid_args', $slider_args, $this->template_id, $this->id );

			$block        = $grid_instance->render_shortcode( $slider_args, null );
			$this->offset = $grid_instance->get_post_count();

			if ( $this->offset ) {
				echo "<div class=\"ak-archive-grid\">
					<div class=\"container\">
						{$block}
					</div>
				</div>";
			}
		}
	}

	/**
	 * Render archive template posts.
	 *
	 * @return string
	 */
	public function render_loop() {
		if ( ! defined( 'NEWSY_ELEMENTS_PATH' ) ) {
			get_template_part( 'views/post/simple-loop' );
			return;
		}

		$term_loop = $this->get_option( 'loop', $this->default_loop_style );

		$posts_per_page = get_query_var( 'posts_per_page' );

		$term_loop_count = $this->get_option( 'loop_posts_count', $posts_per_page );

		$default_width = $this->get_layout() === 'style-3' ? 3 : 2;

		$args = array(
			'count'               => $term_loop_count ? $term_loop_count : $posts_per_page,
			'offset'              => $this->offset,
			'block_accent_color'  => $this->get_option( 'color' ),
			'pagination'          => $this->get_option( 'loop_pagination', 'simple' ),
			'custom_enabled'      => $this->get_option( 'loop_custom_enabled' ),
			'custom_parts'        => $this->get_option( 'loop_custom_parts' ),
			'item_margin'         => $this->get_option( 'loop_item_margin' ),
			'block_width'         => $this->get_option( 'block_width', $default_width ),
			'block_extra_classes' => $this->get_option( 'block_classes' ),
		);

		if ( 'yes' === $this->get_option( 'show_loop_title' ) ) {
			$args['title'] = $this->get_option( 'loop_custom_title', $this->get_archive_title() );
		}

		// if no ofset then render with wp_query
		if ( 0 === $this->offset && $term_loop_count === $posts_per_page && 'simple' === $args['pagination'] ) {
			$args['wp_query'] = true;
		}

		$args = apply_filters( 'newsy_archive_loop_args', $args, $this->template_id, $this->id );

		ak_do_shortcode( $term_loop, $args );
	}
}
