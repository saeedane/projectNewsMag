<?php

namespace Newsy\Support;

class CommentWalker extends \Walker_Comment {

	/**
	 * Output a single comment.
	 *
	 * @since 3.6.0
	 * @see wp_list_comments()
	 *
	 * @param object $comment Comment to display.
	 * @param int    $depth   Depth of comment.
	 * @param array  $args    An array of arguments.
	 */
	protected function comment( $comment, $depth, $args ) {
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		} ?>
<<?php echo esc_attr( $tag ); ?> <?php comment_class( $this->has_children ? 'parent' : '' ); ?>
	id="comment-<?php comment_ID(); ?>">
		<?php if ( 'div' !== $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author vcard">
			<?php
			if ( 0 != $args['avatar_size'] ) {
				echo get_avatar( $comment, $args['avatar_size'] );
			}
			?>
			<?php
			echo wp_kses(
				sprintf(
					/* translators: %s: visibility level */
					__( '<cite class="fn">%s</cite> <span class="says">says:</span>', 'newsy' ),
					get_comment_author_link()
				),
				ak_trans_allowed_html()
			);
			?>
		</div>
		<?php if ( '0' == $comment->comment_approved ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'newsy' ); ?></em>
		<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata">
			<i class="fa fa-clock-o"></i>
			<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
				<?php echo newsy_get_readable_date( get_comment_date( 'U' ) ); ?>
			</a>
			<?php edit_comment_link( newsy_get_translation( 'Edit', 'newsy', 'comments_edit' ), '&nbsp;&nbsp;', '' ); ?>
		</div>

		<div class="comment-content">
			<?php
			comment_text(
				get_comment_ID(), array_merge(
					$args, array(
						'add_below' => $add_below,
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
					)
				)
			);
			?>
		</div>

		<?php
		comment_reply_link(
			array_merge(
				$args, array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				)
			)
		);
		?>

		<?php if ( 'div' !== $args['style'] ) : ?>
	</div>
	<?php endif; ?>
		<?php
	}
}
