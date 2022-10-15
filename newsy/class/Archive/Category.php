<?php
namespace Newsy\Archive;
/**
 * Category template class.
 */
class Category extends ArchiveAbstract {

	public $template_id = 'category';

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
		add_filter( 'newsy_archive_grid_args', array( $this, 'category_grid_args' ), 11, 3 );
		add_filter( 'newsy_archive_loop_args', array( $this, 'category_loop_args' ), 11, 3 );
	}

	/**
	 * Get archive title.
	 *
	 * @param array $classes
	 * @return array
	 */
	public function get_archive_title() {
		return $this->term->name;
	}

	public function get_header_bottom() {
		//Term Subcategories
		if ( $this->get_option( 'show_subcategories' ) === 'hide' || ! function_exists( 'ak_get_child_categories' ) ) {
			return;
		}

		$sub_categories = ak_get_child_categories( $this->id, 10, false );

		$output = '';
		if ( count( $sub_categories ) !== 0 ) {
			$output .= '<div class="ak-archive-sub-cats term-badges clearfix">';
			$output .= '<a class="term-' . $this->id . ' active" href="#">' . newsy_get_translation( 'All', 'newsy', 'all' ) . '</a>';
			foreach ( $sub_categories as $term ) {
				$output .= '<a class="term-' . $term->term_id . '" href="' . get_term_link( $term ) . '">' . $term->name . '</a>';
			}
			$output .= '</div>';
		}

		return $output;
	}


	public function category_grid_args( $args, $template_id, $object_id ) {
		$args['category'] = $object_id;

		return $args;
	}


	public function category_loop_args( $args, $template_id, $object_id ) {
		$args['category'] = $object_id;

		return $args;
	}
}
