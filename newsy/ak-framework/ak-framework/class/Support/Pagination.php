<?php
/***
 * The AkFramework
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
 * Class Pagination Manager.
 */
class Pagination {


	/**
	 * Arguments used to build the breadcrumb trail.
	 *
	 * @var array
	 */
	public $args = array();

	/**
	 * Arguments used to build the pagination block.
	 *
	 * @var array
	 */
	public $atts = array();

	/**
	 * Pagination type.
	 *
	 * @var string
	 */
	public $type = '';

	/**
	 * Array of text labels.
	 *
	 * @var array
	 */
	public $labels = array();

	/**
	 * Prefix for js variables.
	 *
	 * @var int
	 */
	public $data_prefix;

	/**
	 * Number of total pages.
	 *
	 * @var int
	 */
	public $total_page;

	/**
	 * Number of current page.
	 *
	 * @var int
	 */
	public $current_page;

	/**
	 * List of supported pagination types.
	 *
	 * @var array
	 */
	public $pagination_types = array(
		'next_prev',
		'load_more',
		'infinity',
		'infinity_load_more',
		'slider',
		'simple',
	);

	/**
	 * Arguments used to build the slider pagination.
	 *
	 * @var array
	 */
	public $slider_args = array(
		'slider_nav',
		'slider_dots',
		'slider_loop',
		'slider_items',
		'slider_scroll_items',
		'slider_speed',
		'slider_autoplay',
		'slider_autoplay_speed',
		'slider_autoplay_timeout',
		'slider_item_margin',
		'slider_stage_padding',
		'slider_center',
		'slider_axis',
		'slide_count_desktop',
		'slide_count_notebook',
		'slide_count_tablet',
		'slide_count_mobile',
	);

	/**
	 * @var Pagination
	 */
	private static $instance;

	/**
	 * @return Pagination
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	public function __construct() {
		$defaults = array(
			'id'           => '',
			'type'         => '',
			'atts'         => array(),
			'query'        => array(),
			'total_page'   => 1,
			'current_page' => 1,
			'container'    => 'div',
			'data_prefix'  => 'ak_pagination_data_',
			'labels'       => array(),
			'echo'         => true,
		);
		// Parse the arguments with the defaults.
		$this->args = apply_filters( 'ak_pagination_args', $defaults );
	}

	public function set_args( $args ) {
		$this->args = wp_parse_args( $args, $this->args );
		$this->id   = esc_html( $this->args['id'] );
		$this->type = esc_html( $this->args['type'] );

		$this->data_prefix = $this->args['data_prefix'];
		$this->set_atts();
		$this->set_query();
		$this->set_labels();
	}

	public function set_atts() {
		if ( 'slider' === $this->type ) {
			$this->atts = array_intersect_key( $this->args['atts'], array_flip( (array) $this->slider_args ) );
		} else {
			$this->atts = array_diff_key( $this->args['atts'], array_flip( (array) $this->slider_args ) );
		}
		unset( $this->args['atts'] );
	}

	public function set_query() {
		$query = $this->args['query'];

		$this->total_page   = ak_get_query_total_pages( $query );
		$this->current_page = $query->get( 'paged' );
		unset( $query, $this->args['query'] );
	}

	public function set_labels() {
		$defaults = array(
			'load_more' => esc_html__( 'Load More', 'ak-framework' ),
			'loading'   => esc_html__( 'Loading...', 'ak-framework' ),
			'no_more'   => esc_html__( 'No More.', 'ak-framework' ),
			'next'      => esc_html__( 'Next', 'ak-framework' ),
			'prev'      => esc_html__( 'Previous', 'ak-framework' ),
			/* translators: 1: current page, 2: total page */
			'paged_of'  => esc_html__( '%1$s of %2$s', 'ak-framework' ),
		);
		// Parse the arguments with the defaults.
		$this->labels = apply_filters( 'ak_pagination_labels', wp_parse_args( $this->args['labels'], $defaults ) );
		unset( $this->args['labels'] );
	}

	/**
	 * Generate & echo pagination html output.
	 */
	public function render_pagination( $args = array() ) {
		$this->set_args( $args );

		if ( ! empty( $this->type ) && ! in_array( $this->type, $this->pagination_types, true ) ) {
			return '';
		}

		$output = '';

		switch ( $this->type ) {
			case 'next_prev':
				$output .= $this->get_pagination_js();
				$output .= $this->render_next_prev();
				break;

			case 'load_more':
			case 'infinity':
			case 'infinity_load_more':
				$output .= $this->get_pagination_js();
				$output .= $this->render_load_more();
				break;

			case 'simple':
				$output .= $this->render_simple();
				break;

			case 'slider':
				return $this->get_slider_js();
				break;
			// create js anyways
			default:
				return $this->get_pagination_js();
				break;
		}

		if ( $this->total_page < 2 ) {
			return $output;
		}

		return "<div class=\"ak-pagination {$this->type} clearfix\">{$output}</div>";
	}

	/**
	 * Render Pagination script.
	 *
	 * @return string
	 */
	public function get_pagination_js() {
		$data = array(
			'atts'  => $this->atts,
			'id'    => $this->id,
			'token' => substr( wp_hash( $this->id, 'nonce' ), 1, 11 ),
		);

		$out = 'var ' . $this->args['data_prefix'] . $this->id . ' = ' . json_encode( $data ) . ';';

		return "<script>{$out}</script>";
	}

	/**
	 * Render Slider script.
	 *
	 * @return string
	 */
	public function get_slider_js() {
		$data = array(
			'atts' => $this->atts,
			'id'   => $this->id,
		);

		$out = 'var ak_slider_data_' . $this->id . ' = ' . json_encode( $data ) . ';';

		return "<script>{$out}</script>";
	}

	/**
	 * Generate & echo pagination html output.
	 *
	 * @return string
	 */
	public function render_next_prev() {
		if ( $this->total_page < 2 ) {
			return '';
		}

		$prev_text = esc_attr( $this->labels['prev'] );
		$next_text = esc_attr( $this->labels['next'] );

		$buffy  = '';
		$buffy .= '<a href="#" class="ak-pagination-btn prev disabled" data-action="prev" data-block-id="' . esc_attr( $this->id ) . '" title="' . $prev_text . '" rel="nofollow">';
		$buffy .= is_rtl() ? '<i class="fa fa-caret-right" aria-hidden="true"></i>' : '<i class="fa fa-caret-left" aria-hidden="true"></i>';
		$buffy .= $prev_text;
		$buffy .= '</a>';

		$buffy .= '<a href="#" class="ak-pagination-btn next" data-action="next" data-block-id="' . esc_attr( $this->id ) . '" title="' . $next_text . '" rel="nofollow">';
		$buffy .= $next_text;
		$buffy .= is_rtl() ? '<i class="fa fa-caret-left" aria-hidden="true"></i>' : '<i class="fa fa-caret-right" aria-hidden="true"></i>';
		$buffy .= '</a>';

		if ( 'hide' !== $this->atts['show_pagination_label'] ) {
			$buffy .= '<span class="ak-pagination-label">';
			$page_c = sprintf( '<span class="current">%s</span>', number_format_i18n( $this->current_page ) );
			$page_t = sprintf( '<span class="total">%s</span>', number_format_i18n( $this->total_page ) );
			$buffy .= sprintf(
				$this->labels['paged_of'],
				$page_c,
				$page_t
			);
			$buffy .= '</span>';
		}

		return $buffy;
	}

	/**
	 * Generate & echo pagination html output.
	 *
	 * @return string
	 */
	public function render_load_more() {
		if ( $this->total_page < 2 ) {
			return '';
		}

		$buffy  = '';
		$buffy .= '<a href="#" class="ak-pagination-btn" data-action="next" data-block-id="' . $this->id . '" title="' . esc_attr( $this->labels['load_more'] ) . '" rel="nofollow">';
		$buffy .= '<span class="ak-pagination-btn-load-more"><i class="fa fa-caret-down" aria-hidden="true"></i> <span class="txt">' . esc_attr( $this->labels['load_more'] ) . '</span></span>';
		$buffy .= '<span class="ak-pagination-btn-loading"><i class="fa fa-circle-o-notch fa-spin fa-fw"></i> <span class="txt">' . esc_attr( $this->labels['loading'] ) . '</span></span>';
		$buffy .= '<span class="ak-pagination-btn-no-more">' . esc_attr( $this->labels['no_more'] ) . '</span>';
		$buffy .= '</a>';

		return $buffy;
	}

	/**
	 * Generate & echo pagination html output.
	 *
	 * @return mixed
	 */
	public function render_simple() {
		if ( $this->total_page < 2 ) {
			return '';
		}

		$big = 999999999; // need an unlikely integer

		return paginate_links(
			array(
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => '?paged=%#%',
				'type'      => 'list',
				'show_all'  => false,
				'prev_text' => esc_attr( $this->labels['prev'] ),
				'next_text' => esc_attr( $this->labels['next'] ),
				'current'   => max( 1, $this->current_page ),
				'total'     => $this->total_page,
			)
		);
	}
}
