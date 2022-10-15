<?php
/**
 * comments.php
 *---------------------------
 * The template for displaying comments.
 *
 * Content of each comment will be output with the type of comment.
 * You can view and/or edit the comment file in "views/comments"
 *
 */
global $post;

if ( post_password_required() ) {
	return;
}

$comment_load_type = newsy_get_option( 'post_comments_load_type' );

$classes  = 'ak-block comment-wrapper ';
$classes .= newsy_get_option( 'post_comments_block_classes' );

echo '<div id="comments" class=" ' . esc_attr( $classes ) . '"  data-id="' . esc_html( $post->ID ) . '">';

if ( 'button' === $comment_load_type || wp_doing_ajax() ) {
	?>
	<div class="ajax_comment_button">
		<span class="button">
			<?php
			if ( get_comments_number( $post->ID ) ) {
				newsy_echo_translation( 'Read All Comment', 'newsy', 'comment_read_button' );
			} else {
				newsy_echo_translation( 'Leave Comment', 'newsy', 'comment_leave_button' );
			}
			?>
		</span>
		<span class="loading-comment">
			<?php echo newsy_get_loader(); ?>
		</span>
	</div>
	<?php
} else {
	get_template_part( 'views/comments/comments' );
}

echo '</div>';
