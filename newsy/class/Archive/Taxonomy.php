<?php
namespace Newsy\Archive;

/**
 * Taxonomy template class.
 */
class Taxonomy extends ArchiveAbstract {

	public $template_id = 'taxonomy';

	public $default_grid_style = 'hide';

	/**
	 * @var \WP_Term
	 */
	public $term;

	public function __construct() {
		$this->init();
		$this->hook();

		parent::__construct();
	}

	public function init() {
		$term = get_queried_object();

		if ( gettype( $term ) != 'object' ) {
			return;
		}

		$this->term = $term;
		$this->id   = $term->term_id;
	}

	public function hook() {
		add_filter( 'newsy_archive_grid_args', array( $this, 'tax_grid_args' ), 11, 3 );
		add_filter( 'newsy_archive_loop_args', array( $this, 'tax_loop_args' ), 15, 3 );
	}

	public function tax_grid_args( $args ) {
		//set query for ajax loadings
		$args['taxonomy'] = $this->term->taxonomy . ':' . $this->term->term_id;

		return $args;
	}

	public function tax_loop_args( $args ) {
		//set query for ajax loadings
		$args['taxonomy'] = $this->term->taxonomy . ':' . $this->term->term_id;

		return $args;
	}
}
