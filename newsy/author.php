<?php
/**
 * author.php
 * ---------------------------
 * The template for displaying author's content
 */

$the_author = new \Newsy\Archive\Author();
get_header();
?>

<div class="ak-content-wrap <?php echo esc_attr( $the_author->get_wrap_class() ); ?>">
	<div class="ak-container">

		<?php do_action( 'newsy_archive_content_before', $the_author ); ?>

		<div class="ak-content">
			<div class="container">
				<div class="row">

					<div class="<?php echo esc_attr( $the_author->get_content_class() ); ?> content-column">

						<?php do_action( 'newsy_archive_content_loop_before', $the_author ); ?>

						<?php $the_author->render_loop(); ?>

						<?php do_action( 'newsy_archive_content_loop_after', $the_author ); ?>

					</div><!-- .content-column -->

					<?php $the_author->get_sidebar(); ?>

				</div><!-- .row -->
			</div>
		</div><!-- .ak-content -->

		<?php do_action( 'newsy_archive_content_after', $the_author ); ?>

	</div>
</div>

<?php get_footer(); ?>
