<?php
$the_post = Newsy\Single\SinglePage::get_instance();

get_header();
the_post();
?>
<div class="ak-content-wrap <?php echo esc_attr( $the_post->get_wrap_class() ); ?>">
	<div class="ak-container">
		<?php $the_post->get_breadcrumb( true ); ?>

		<?php do_action( 'newsy_content_before' ); ?>

		<div class="ak-content">

			<div class="container">

				<div class="row">

					<div class="<?php echo esc_attr( $the_post->get_content_class() ); ?> content-column">

						<?php $the_post->get_title(); ?>

						<?php $the_post->get_featured_image( 'newsy_750x536' ); ?>

						<div class="ak-post-content">
							<?php the_content(); ?>
							<?php wp_link_pages(); ?>
						</div>

						<?php
						if ( comments_open() ) {
							comments_template();
						}
						?>

					</div><!-- .content-column -->

					<?php $the_post->get_sidebar(); ?>
				</div>
			</div>
		</div>

		<?php do_action( 'newsy_content_after' ); ?>
	</div>
</div>
<?php get_footer(); ?>
