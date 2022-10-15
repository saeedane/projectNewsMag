<?php
/**
 * single.php
 * ---------------------------
 * The template for displaying posts
 */
$the_post = Newsy\Single\SinglePost::get_instance();
$the_post->init();

get_header();
?>
<div class="ak-post-wrapper">
	<div class="ak-content-wrap <?php echo esc_attr( $the_post->get_wrap_class() ); ?>">
		<div class="ak-container">
			<?php do_action( 'newsy_content_before' ); ?>

			<?php get_template_part( 'views/post/post-' . $the_post->get_template() ); ?>

			<?php do_action( 'newsy_content_after' ); ?>
		</div>
	</div><!-- .ak-content-wrap -->
</div><!-- .ak-post-wrapper -->
<?php get_footer(); ?>
