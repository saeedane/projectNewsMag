<?php
/**
 * category.php
 * ---------------------------
 * Used to display category archive page.
 */

$the_category = new \Newsy\Archive\Category();
get_header();
?>
	<div class="ak-content-wrap <?php echo esc_attr( $the_category->get_wrap_class() ); ?>">
		<div class="ak-container">

			<?php do_action( 'newsy_archive_content_before', $the_category ); ?>

			<div class="ak-content">
				<div class="container">
					<div class="row">

						<div class="<?php echo esc_attr( $the_category->get_content_class() ); ?> content-column">

							<?php do_action( 'newsy_archive_content_loop_before', $the_category ); ?>

							<?php $the_category->render_loop(); ?>

							<?php do_action( 'newsy_archive_content_loop_after', $the_category ); ?>

						</div><!-- .content-column -->

						<?php $the_category->get_sidebar(); ?>

					</div><!-- .row -->
				</div>
			</div><!-- .ak-content -->

			<?php do_action( 'newsy_archive_content_after', $the_category ); ?>

		</div>
	</div><!-- .ak-content-wrap -->
<?php get_footer(); ?>
