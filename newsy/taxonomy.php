<?php
/**
 * taxonomy.php
 *---------------------------
 * Used to display taxonomy archive page.
 */

$the_tax = new \Newsy\Archive\Taxonomy();
get_header();
?>
	<div class="ak-content-wrap <?php echo esc_attr( $the_tax->get_wrap_class() ); ?>">
		<div class="ak-container">

			<?php do_action( 'newsy_archive_content_before', $the_tax ); ?>

			<div class="ak-content">
				<div class="container">
					<div class="row">

						<div class="<?php echo esc_attr( $the_tax->get_content_class() ); ?> content-column">

							<?php do_action( 'newsy_archive_content_loop_before', $the_tax ); ?>

							<?php $the_tax->render_loop(); ?>

							<?php do_action( 'newsy_archive_content_loop_after', $the_tax ); ?>

						</div><!-- .content-column -->

						<?php $the_tax->get_sidebar(); ?>

					</div><!-- .row -->
				</div>
			</div><!-- .ak-content -->

			<?php do_action( 'newsy_archive_content_after', $the_tax ); ?>

		</div>
	</div><!-- .ak-content-wrap -->
<?php get_footer(); ?>
