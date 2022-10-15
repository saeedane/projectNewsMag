<?php
/**
 * index.php
 * ---------------------------
 * The template for displaying latest posts
 */

$the_index = new \Newsy\Archive\Home();
get_header();
?>
	<div class="ak-content-wrap <?php echo esc_attr( $the_index->get_wrap_class() ); ?>">
		<div class="ak-container">

			<?php do_action( 'newsy_archive_content_before' ); ?>

			<div class="ak-content">
				<div class="container">
					<div class="row">

						<div class="<?php echo esc_attr( $the_index->get_content_class() ); ?> content-column">

							<?php do_action( 'newsy_content_loop_before' ); ?>

							<?php $the_index->render_loop(); ?>

							<?php do_action( 'newsy_content_loop_after' ); ?>

						</div><!-- .content-column -->

						<?php $the_index->get_sidebar(); ?>

					</div><!-- .row -->
				</div>
			</div><!-- .ak-content -->

			<?php do_action( 'newsy_archive_content_after' ); ?>
		</div>
	</div><!-- .ak-content-wrap -->
<?php get_footer(); ?>
