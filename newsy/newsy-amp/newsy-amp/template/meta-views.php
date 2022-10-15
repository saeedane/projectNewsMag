<?php if ( newsy_get_option( 'post_show_meta_views' ) !== 'hide' && function_exists( 'newsy_get_post_view_count' ) ) : ?>
<li class="amp-wp-post-view">
	<span class="amp-wp-views-count">
		<i class="fa fa-eye"></i>
		<?php
		$post_views = newsy_get_post_view_count( get_the_ID() );
		echo $post_views;
		?>
	</span>
</li>
<?php endif; ?>
