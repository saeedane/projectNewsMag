<?php if ( newsy_get_option( 'post_show_meta_comments' ) !== 'hide' && function_exists( 'newsy_get_post_comment_count' ) ) : ?>
<li class="amp-wp-post-comment">
	<span class="amp-wp-comment-count">
		<i class="fa fa-comment-o"></i>
		<?php
		$comments_number = newsy_get_post_comment_count( get_the_ID() );
		echo $comments_number;
		?>
	</span>
</li>
<?php endif; ?>
