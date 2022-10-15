<?php
/**
 * custom-menu.php
 *---------------------------
 * Custom mega menu.
 */
?>
<div class="ak-mega-custom-menu-wrap">
	<?php
	if ( ! empty( $item->menu_meta['custom_mega_menu'] ) ) {
		$page_id = $item->menu_meta['custom_mega_menu'];
		if ( defined( 'ELEMENTOR_VERSION' ) && \Elementor\Plugin::$instance->documents->get( $page_id )->is_built_with_elementor() ) {
			$frontend = new \Elementor\Frontend();

			add_action( 'wp_enqueue_scripts', array( $frontend, 'enqueue_styles' ) );
			add_action( 'wp_head', array( $frontend, 'print_fonts_links' ) );
			add_action( 'wp_footer', array( $frontend, 'wp_footer' ) );

			add_action( 'wp_enqueue_scripts', array( $frontend, 'register_scripts' ), 5 );
			add_action( 'wp_enqueue_scripts', array( $frontend, 'register_styles' ), 5 );

			$html = $frontend->get_builder_content( $page_id );

			add_filter( 'get_the_excerpt', array( $frontend, 'start_excerpt_flag' ), 1 );
			add_filter( 'get_the_excerpt', array( $frontend, 'end_excerpt_flag' ), 20 );
		} else {
			$page = get_post( $page_id );
			$html = do_shortcode( $page->post_content );
		}

		newsy_sanitize_echo( $html );
	}
	?>
</div>
<?php
unset( $page );
