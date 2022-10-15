<?php
/**
 * footer.php
 * ---------------------------
 * The template for displaying the footer.
 */

$show_footer = apply_filters( 'newsy_show_footer', true );
if ( $show_footer ) {
	get_template_part( 'views/builder/footer-builder' );
}
?>
	</div><!-- .ak-main-wrap -->

	<span class="ak-back-top"><i class="fa fa-arrow-up"></i></span>

	<?php
	if ( 'enabled' === newsy_get_option( 'drawer_lazyload' ) && newsy_get_option( 'always_visible_drawer' ) !== 'active' ) {
		echo '<div id="ak_drawer_holder"></div>';
	} else {
		get_template_part( 'views/builder/drawer-builder' );
	}

	if ( ! is_user_logged_in() ) {
		get_template_part( 'views/account/account_modal' );
	}

	wp_footer();
	?>
</body>
</html>
