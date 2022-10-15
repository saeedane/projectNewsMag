<?php
$the_post = Newsy\Single\SinglePost::get_instance();
?>
<div class="ak-content">
	<div class="container">

		<?php do_action( 'newsy_single_before' ); ?>

		<div class="row">

			<div class="<?php echo esc_attr( $the_post->get_content_class() ); ?> content-column">

				<?php get_template_part( 'views/post/post-article-1' ); ?>

			</div><!-- .content-column -->

			<?php $the_post->get_sidebar(); ?>

		</div>

		<?php do_action( 'newsy_single_after' ); ?>

	</div>
</div>
