<?php
/**
 * search.php
 * ---------------------------
 * The template for displaying search result page.
 */

$the_search = new \Newsy\Archive\Search();
get_header();
?>
	<div class="ak-content-wrap <?php echo esc_attr( $the_search->get_wrap_class() ); ?>">
		<div class="ak-container">

			<?php do_action( 'newsy_archive_content_before' ); ?>

			<div class="ak-content">
				<div class="container">
					<div class="row">

						<div class="<?php echo esc_attr( $the_search->get_content_class() ); ?> content-column">

							<?php do_action( 'newsy_archive_content_loop_before' ); ?>

							<?php $the_search->render_loop(); ?>

							<?php do_action( 'newsy_archive_content_loop_after' ); ?>

						</div><!-- .content-column -->

						<?php $the_search->get_sidebar(); ?>


					</div><!-- .row -->
				</div>
			</div>

			<?php do_action( 'newsy_archive_content_after' ); ?>

		</div>
	</div><!-- .ak-content-wrap -->
<?php get_footer(); ?>
