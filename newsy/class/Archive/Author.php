<?php

namespace Newsy\Archive;

/**
 * Author template class.
 */
class Author extends ArchiveAbstract {

	public $template_id = 'author';

	public $term = '';

	public $default_grid_style = 'hide';

	public function __construct() {
		$this->init();
		$this->hook();

		parent::__construct();
	}

	public function init() {
		$this->id = get_the_author_meta( 'ID' );
	}

	public function hook() {
		add_filter( 'newsy_archive_loop_args', array( $this, 'author_loop_args' ), 15, 3 );
	}

	public function render_header() {
		if ( ! defined( 'NEWSY_ELEMENTS_PATH' ) ) {
			return parent::render_header();
		}

		$archive_header_style = $this->get_option( 'header_style', 'style-1' );

		$breadcrumb = $this->get_breadcrumb( false, false );

		$output = ak_do_shortcode(
			'newsy_author_box', array(
				'author'      => $this->id,
				'block_width' => 3,
				'show_cover'  => 'hide',
				'show_extras' => 'hide',
			),
			false
		);

		echo "<div class=\"ak-archive-header {$archive_header_style}\">
                    <div class=\"container\">
                        {$breadcrumb}
                        {$output}
                    </div>
                </div>";
	}

	public function author_loop_args( $args ) {
		//set query for ajax loadings
		$args['author'] = strval( $this->id );

		return $args;
	}
}
