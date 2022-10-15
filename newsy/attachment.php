<?php
/**
 * attachment.php
 * ---------------------------
 * The template for displaying attachments content
 */

$the_attachment = new \Newsy\Archive\Attachment();
get_header();
the_post();
?>

<div class="ak-content-wrap <?php echo esc_attr( $the_attachment->get_wrap_class() ); ?>">
	<div class="ak-container">

		<?php $the_attachment->get_header(); ?>

		<div class="ak-content">
			<div class="container">
				<div class="row">

					<div class="<?php echo esc_attr( $the_attachment->get_content_class() ); ?> content-column">

						<h1 class="ak-post-title"><?php the_title(); ?></h1>

						<div class="ak-featured-cover">
						<?php
						if ( wp_attachment_is_image( get_the_ID() ) ) {
							$image_size = $the_attachment->get_layout() !== 'style-3' ? 'newsy_750x0' : 'newsy_1140x0';
							echo apply_filters( 'ak_single_image', '', get_the_ID(), $image_size );
						}
						?>
						</div>

						<div class="ak-post-content">
							<?php the_content(); ?>
						</div>

					</div><!-- .content-column -->

					<?php $the_attachment->get_sidebar(); ?>

				</div><!-- .row -->
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
