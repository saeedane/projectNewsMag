<?php
/**
 * tag.php
 *---------------------------
 * Used to display tags archive page.
 */

$the_tag = new Newsy\Archive\Tag();
get_header();
?>
	<div class="ak-content-wrap <?php echo esc_attr( $the_tag->get_wrap_class() ); ?>">
		<div class="ak-container">

			<?php do_action( 'newsy_archive_content_before', $the_tag ); ?>

			<div class="ak-content">
				<div class="container">
					<div class="row">

						<div class="<?php echo esc_attr( $the_tag->get_content_class() ); ?> content-column">

							<?php do_action( 'newsy_archive_content_loop_before', $the_tag ); ?>

							<?php $the_tag->render_loop(); ?>

							<?php do_action( 'newsy_archive_content_loop_after', $the_tag ); ?>

						</div><!-- .content-column -->

						<?php $the_tag->get_sidebar(); ?>

					</div><!-- .row -->
				</div>
			</div><!-- .ak-content -->

			<?php do_action( 'newsy_archive_content_after', $the_tag ); ?>

		</div>
	</div><!-- .ak-content-wrap -->
<?php get_footer(); ?>
