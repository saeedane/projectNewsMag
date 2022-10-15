<?php
namespace Newsy\Page;

use Newsy\TemplateAbstract;
use Newsy\Archive\ArchiveAbstract;

/**
 * Shop template class.
 */
class Shop extends ArchiveAbstract {
	public $template_id = 'woocommerce';

	public $default_grid_style = 'hide';

	public $default_loop_style = 'hide';

	public function __construct() {
		if ( is_singular( 'product' ) ) {
			$this->template_id .= '_product';
		} elseif ( is_tax() ) {
			$this->template_id .= '_tax';
		}

		$this->hook();
		$this->setup();

		parent::__construct();
	}

	public function hook() {
		add_filter( 'woocommerce_show_page_title', '__return_false' );
		remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
	}

	public function setup() {
		if ( 'woocommerce_tax' === $this->template_id ) {
			$term = get_queried_object();

			if ( gettype( $term ) != 'object' ) {
				return;
			}

			$this->term = $term;
			$this->id   = $term->term_id;
		} else {
			$post = get_post();

			if ( $post ) {
				$this->id = $post->ID;
			}
		}
	}

	/**
	 * Get archive title.
	 *
	 * @param array $classes
	 * @return array
	 */
	public function get_archive_title() {
		return 'woocommerce_product' === $this->template_id ? '' : woocommerce_page_title( false );
	}



	public function get_title() {
		// If Term header is not Active
		if ( $this->get_option( 'show_title' ) === 'hide' ) {
			return;
		}

		echo '<h1 class="page-title">' . get_the_title( $this->id ) . '</h1>';
	}
}
