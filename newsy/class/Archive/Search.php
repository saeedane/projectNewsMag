<?php

namespace Newsy\Archive;

/**
 * Search template class.
 */
class Search extends ArchiveAbstract {

	public $template_id = 'search';

	public $default_grid_style = 'hide';

	public function __construct() {
		$this->hook();

		parent::__construct();
	}

	public function hook() {
		add_action( 'newsy_archive_content_loop_before', array( $this, 'render_search_form' ), 15 );
		add_filter( 'newsy_archive_loop_args', array( $this, 'search_loop_args' ), 11, 3 );
	}

	public function get_archive_title() {
		// Custom title
		global $wp_query;
		$result_count = $wp_query->found_posts;

		$title = sprintf(
			newsy_get_translation( 'Search Results for "%s" (%s)', 'newsy', 'search_page_title' ),
			'<i>' . get_search_query() . '</i>',
			'<span class="result-count">' . $result_count . '</span>'
		);

		return $title;
	}


	public function render_search_form() {
		$search_form = get_search_form( array( 'echo' => false ) );

		echo "<div class=\"ak-archive-search-form\">{$search_form}</div>";
	}

	public function render_grid() {}

	public function search_loop_args( $args ) {
		$args['title']      = '';
		$args['pagination'] = 'simple';
		$args['post_type']  = 'post';
		$args['wp_query']   = true;

		return $args;
	}
}
