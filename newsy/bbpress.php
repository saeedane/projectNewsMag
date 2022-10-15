<?php
/**
 * bbpress.php
 * ---------------------------
 * Used to display bbPress archive page
 */

$the_forum = new Newsy\Page\BbPress();
get_header();
the_post();
?>
	<div class="ak-content-wrap <?php echo esc_attr( $the_forum->get_wrap_class() ); ?>">
		<div class="ak-container">

			<?php do_action( 'newsy_content_before' ); ?>

			<div class="ak-content">
				<div class="container">
					<div class="row">

						<div class="<?php echo esc_attr( $the_forum->get_content_class() ); ?> content-column">

							<?php the_content(); ?>
							<?php wp_link_pages(); ?>

						</div><!-- .content-column -->

						<?php $the_forum->get_sidebar(); ?>
					</div>

				</div>
			</div>

			<?php do_action( 'newsy_content_after' ); ?>

		</div>
	</div>
<?php get_footer(); ?>
