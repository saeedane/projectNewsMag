<?php
/**
 * single-autoload.php
 *---------------------------
 * The template for displaying posts
 *
 */
$the_post = Newsy\Single\SinglePost::get_instance();

?>
<div class="ak-content-wrap <?php echo esc_attr( $the_post->get_wrap_class() ); ?>">
	<div class="ak-container">
		<?php do_action( 'newsy_before_after' ); ?>

		<?php get_template_part( 'views/post/post-' . $the_post->get_template() ); ?>

		<?php do_action( 'newsy_content_after' ); ?>
	</div>
</div><!-- .ak-content-wrap -->
