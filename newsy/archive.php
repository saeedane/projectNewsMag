<?php
/**
 * archive.php
 * ---------------------------
 * Used to display archive-type pages if nothing more specific matches a query.
 */

$the_archive = new Newsy\Archive\Archive();
get_header();
?>
<div class="ak-content-wrap <?php echo esc_attr( $the_archive->get_wrap_class() ); ?>">
	<div class="ak-container">

		<?php do_action( 'newsy_archive_content_before', $the_archive ); ?>

		<div class="ak-content">
			<div class="container">
				<div class="row">

					<div class="<?php echo esc_attr( $the_archive->get_content_class() ); ?> content-column">

						<?php do_action( 'newsy_archive_content_loop_before', $the_archive ); ?>

						<?php $the_archive->render_loop(); ?>

						<?php do_action( 'newsy_archive_content_loop_after', $the_archive ); ?>

					</div><!-- .content-column -->

					<?php $the_archive->get_sidebar(); ?>

				</div><!-- .row -->
			</div>
		</div><!-- .ak-content -->

		<?php do_action( 'newsy_archive_content_after', $the_archive ); ?>

	</div>
</div><!-- .ak-content-wrap -->
<?php get_footer(); ?>
