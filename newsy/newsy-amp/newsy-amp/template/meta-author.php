<?php $post_author = $this->get( 'post_author' ); ?>
<li class="amp-wp-byline">
	<?php if ( function_exists( 'get_avatar_url' ) ) : ?>
	<amp-img src="<?php echo esc_url( get_avatar_url( $post_author->user_email, array( 'size' => 42 ) ) ); ?>" width="42" height="42" layout="fixed"></amp-img>
	<?php endif; ?>
	<span class="amp-wp-author">
		<?php printf( ak_get_translation( 'By %s', 'newsy-amp', 'by' ), '<a href="' . esc_url_raw( get_author_posts_url( $post_author->ID ) ) . '">' . esc_html( $post_author->display_name ) . '</a>' ); ?>
	</span>
</li>
