<?php
$comments_link_url = $this->get( 'comments_link_url' );
if ( $comments_link_url ) : ?>
	<div class="amp-wp-meta amp-wp-comments-link">
		<a href="<?php echo esc_url( $comments_link_url ); ?>">
			<?php echo esc_html( ak_get_translation( 'Leave a Comment', 'newsy-amp', 'leave_comment' ) ); ?>
		</a>
	</div>
<?php endif; ?>
