<div class="ak-post-next-prev clearfix">
	<?php
	$prev_post = get_previous_post();
	if ( ! empty( $prev_post ) ) :
		?>
		<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="post prev-post">
			<i class="fa fa-chevron-left"></i>
			<span class="caption"><?php newsy_echo_translation( 'Previous Article', 'newsy', 'post_prev_article' ); ?></span>
			<h3 class="post-title"><?php echo wp_kses_post( $prev_post->post_title ); ?></h3>
		</a>
	<?php endif; ?>

	<?php
	$next_post = get_next_post();
	if ( ! empty( $next_post ) ) :
		?>
		<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="post next-post">
			<i class="fa fa-chevron-right"></i>
			<span class="caption"><?php newsy_echo_translation( 'Next Article', 'newsy', 'post_next_article' ); ?></span>
			<h3 class="post-title"><?php echo wp_kses_post( $next_post->post_title ); ?></h3>
		</a>
	<?php endif; ?>
</div>
