<?php

// Comments Number
$comments_number = get_comments_number();

if ( comments_open() || $comments_number ) {
	echo '<div class="comment-section" data-type="wp">';

	if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) {

		echo "<span class='comment-login'>" . sprintf( newsy_get_translation( "Please <a href='%s' class='%s'>login</a> to join discussion", 'newsy', 'please_login_join_discussion', false ), '#userModal', 'menu-login-user-icon' ) . '</span>';

	} else {

		// Prepare comment text
		if ( 0 == $comments_number ) {
			$comments_text = newsy_get_translation( 'Comments', 'newsy', 'no_comment_title' );
		} elseif ( 1 < $comments_number ) {
			$comments_text = str_replace( '%s', number_format_i18n( $comments_number ), newsy_get_translation( '%s Comments', 'newsy', 'comments_count_title' ) );
		} else {
			$comments_text = newsy_get_translation( '1 Comment', 'newsy', 'comments_1_comment' );
		}

		$header_style = newsy_get_option( 'post_comments_block_header_style', newsy_get_option( 'block_header_style', 'style-1' ) );

		$classes = ( 0 == $comments_number ) ? 'no-comment ' : '';

		?>
		<div id="comments-template-<?php the_ID(); ?>" class="comments-template <?php echo esc_attr( $classes ); ?> clearfix">
		<?php
		if ( have_comments() ) {
			?>
			<div class="ak-block-header ak-block-header-<?php echo esc_attr( $header_style ); ?>">
				<h4 class="ak-block-title">
					<span class="title-text"> <?php echo esc_attr( $comments_text ); ?></span>
				</h4>
			</div>
			<?php } ?>
			<div class="ak-block-inner">
				<?php
				if ( have_comments() ) {
					?>
					<div class="ak_commentlist_container">
						<ol class="commentlist">
							<?php
							wp_list_comments(
								array(
									'avatar_size' => 50,
									'short_ping'  => true,
									'walker'      => new \Newsy\Support\CommentWalker,
								)
							);
							?>
						</ol>
					</div>
					<?php
					get_template_part( 'views/comments/_nav' );
				}

				comment_form(
					array(
						'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
						'title_reply_after'  => '</h4>',
						'title_reply'        => newsy_get_translation( 'Leave A Reply', 'newsy', 'comments_leave_reply' ),
						'cancel_reply_link'  => newsy_get_translation( 'Cancel Reply', 'newsy', 'comments_cancel_reply' ),
						'comments_reply_to'  => newsy_get_translation( 'Reply To %s', 'newsy', 'comments_reply_to' ),
						'label_submit'       => newsy_get_translation( 'Post Comment', 'newsy', 'comments_post_comment' ),
					)
				);
		?>
			</div>
		</div>
			<?php
	}

	echo '</div>';
}
