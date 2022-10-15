<?php
/***
 * The Ak Framework
 *
 * Ak Framework is framework for WordPress themes and plugins.
 *
 * Copyright © 2020 akbilisim
 * www.akbilisim.com
 *
 * Envato Profile: https://themeforest.net/user/akbilisim
 */

namespace Ak\Customizer;

class CustomizerRedirect {

	/**
	 * @var CustomizerRedirect
	 */
	private static $instance;

	/**
	 * @var
	 */
	private $post_id;

	/**
	 * @var array
	 */
	private $redirects = array();

	/**
	 * construct.
	 */
	private function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'load_script' ), 999999 );
	}

	/**
	 * @return CustomizerRedirect
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * load ak-framework script.
	 */
	public function load_script() {
		global $wp_query;
		if ( $wp_query->post ) {
			$this->post_id = $wp_query->post->ID;
		}

		$this->setup_redirects();

		wp_enqueue_script( 'ak-customizer-redirect', AK_FRAMEWORK_URL . '/assets/js/customizer/customizer-redirect.js', array( 'jquery', 'customize-preview' ), null, true );
		wp_localize_script(
			'ak-customizer-redirect', 'ak_customizer_redirect_loc', array(
				'js_vars'   => CustomizerManager::get_instance()->get_js_vars(),
				'loc'       => array(
					'change_notice' => wp_kses( __( 'Change you made not showing on this page.<br/> Do you want to be redirected to the appropriate page to see change you just made?', 'ak-framework' ), wp_kses_allowed_html() ),
					'yes'           => esc_html__( 'Yes', 'ak-framework' ),
				),
				'redirects' => $this->redirects,
			)
		);
	}

	/**
	 * Setup redirect tag for customizer.
	 */
	public function setup_redirects() {
		$this->redirects['category'] = array(
			'url'  => $this->get_first_category_url(),
			'flag' => is_category(),
			'text' => esc_html__( 'Category Page', 'ak-framework' ),
		);

		$this->redirects['home'] = array(
			'url'  => site_url( '/' ),
			'flag' => is_front_page(),
			'text' => esc_html__( 'Home Page', 'ak-framework' ),
		);

		$this->redirects['post'] = array(
			'url'  => $this->get_random_single_post_url(),
			'flag' => is_single(),
			'text' => esc_html__( 'Single Post', 'ak-framework' ),
		);

		$this->redirects['page'] = array(
			'url'  => $this->get_random_single_page_url(),
			'flag' => is_single(),
			'text' => esc_html__( 'Single Page', 'ak-framework' ),
		);

		$this->redirects['search'] = array(
			'url'  => $this->get_search_url(),
			'flag' => is_search(),
			'text' => esc_html__( 'Search Post', 'ak-framework' ),
		);

		$this->redirects['archive'] = array(
			'url'  => $this->get_post_tag_url(),
			'flag' => is_archive(),
			'text' => esc_html__( 'Archive Page', 'ak-framework' ),
		);

		$this->redirects['tag'] = array(
			'url'  => $this->get_post_tag_url(),
			'flag' => is_archive(),
			'text' => esc_html__( 'Archive Page', 'ak-framework' ),
		);

		$this->redirects['author'] = array(
			'url'  => $this->get_author_url(),
			'flag' => is_author(),
			'text' => esc_html__( 'Author Page', 'ak-framework' ),
		);

		$this->redirects['attachment'] = array(
			'url'  => $this->get_attachment_url(),
			'flag' => is_attachment(),
			'text' => esc_html__( 'Attachment', 'ak-framework' ),
		);

		$this->redirects['404'] = array(
			'url'  => $this->get_404_url(),
			'flag' => is_404(),
			'text' => esc_html__( '404', 'ak-framework' ),
		);

		if ( function_exists( 'is_bbpress' ) ) {
			$this->redirects['bbpress'] = array(
				'url'  => $this->get_bbpress_url(),
				'flag' => is_bbpress(),
				'text' => esc_html__( 'BBPress', 'ak-framework' ),
			);
		}

		if ( function_exists( 'is_woocommerce' ) ) {
			$this->redirects['woocommerce']        = array(
				'url'  => $this->get_woo_archive_url(),
				'flag' => is_shop(),
				'text' => esc_html__( 'Archive WooCommerce', 'ak-framework' ),
			);
			$this->redirects['woocommerce_single'] = array(
				'url'  => $this->get_woo_single_url(),
				'flag' => is_product(),
				'text' => esc_html__( 'Single WooCommerce', 'ak-framework' ),
			);
		}

		$this->setup_redirect_category();
	}

	public function get_attachment_url() {
		$query = new \WP_Query(
			array(
				'post_type'   => 'attachment',
				'post_status' => 'inherit',
				'orderby'     => 'rand',
				'numberposts' => 1,
			)
		);

		$permalink = '';

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$permalink = get_the_permalink( get_the_ID() );
			}
		}

		wp_reset_postdata();

		return $permalink;
	}

	public function get_woo_archive_url() {
		return get_permalink( wc_get_page_id( 'shop' ) );
	}

	public function get_woo_single_url() {
		$permalink = null;
		$query     = new \WP_Query(
			array(
				'showposts' => 1,
				'post_type' => 'product',
			)
		);

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$permalink = get_the_permalink();
			}
		}
		wp_reset_postdata();

		return $permalink;
	}

	public function get_bbpress_url() {
		$page = bbp_get_page_by_path( bbp_get_root_slug() );
		if ( ! empty( $page ) ) {
			$root_url = get_permalink( $page->ID );

			// Use the root slug
		} else {
			$root_url = get_post_type_archive_link( bbp_get_forum_post_type() );
		}

		return $root_url;
	}

	public function get_404_url() {
		return home_url() . '/404';
	}

	public function get_search_url() {
		return home_url() . '/?s=';
	}

	public function get_author_url() {
		$user = wp_get_current_user();

		return get_author_posts_url( $user->ID );
	}

	public function setup_redirect_category() {
		$categories = get_categories(
			array(
				'hide_empty' => false,
			)
		);

		foreach ( $categories as $category ) {
			$redirect_name = 'category_' . $category->term_id;
			$redirect_url  = get_category_link( $category->term_id );
			$title_text    = esc_html__( 'Category : ', 'ak-framework' ) . $category->name;
			$is_category   = $this->check_on_category( $category );

			$this->redirects[ $redirect_name ] = array(
				'url'  => $redirect_url,
				'flag' => $is_category,
				'text' => $title_text,
			);
		}
	}

	public function check_on_category( $category ) {
		if ( is_category() ) {
			$term = get_queried_object();

			if ( $term->term_id === $category->term_id ) {
				return true;
			}
		}

		return false;
	}

	public function get_first_category_url() {
		$terms = get_terms(
			array(
				'taxonomy'   => 'category',
				'hide_empty' => false,
				'number'     => 1,
			)
		);

		if ( $terms ) {
			return get_term_link( $terms[0]->term_id );
		}

		return null;
	}

	public function get_post_tag_url() {
		$terms = get_terms(
			array(
				'taxonomy'   => 'post_tag',
				'hide_empty' => false,
				'number'     => 1,
			)
		);

		if ( $terms ) {
			return get_term_link( $terms[0]->term_id );
		}

		return get_year_link( '' );
	}

	public function get_random_single_post_url() {
		$posts = get_posts( 'post_type=post&orderby=rand&numberposts=1' );

		if ( $posts ) {
			return get_permalink( $posts[0]->ID );
		}

		return null;
	}

	public function get_random_single_page_url() {
		$posts = get_posts( 'post_type=page&orderby=rand&numberposts=1' );

		if ( $posts ) {
			return get_permalink( $posts[0]->ID );
		}

		return null;
	}
}
