<?php

if ( have_posts() ) {
	while ( have_posts() ) :
		the_post();
		$the_id              = get_the_ID();
		$the_title           = get_the_title( $the_id );
		$the_title_attribute = strip_tags( $the_title );
		?>
		<article id="post-<?php echo esc_attr( $the_id ); ?>" class="<?php echo esc_attr( implode( ' ', get_post_class( array( 'ak-module-default clearfix' ), $the_id ) ) ); ?>">
			<div class="ak-module-default-inner">
				<div class="ak-module-default-image">
					<?php echo ak_get_post_image( $the_id, 'full' ); ?>
				</div>
				<header class="ak-post-header">
					<?php
					the_title( '<h2 class="ak-module-default-title"><a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" title="' . esc_attr( $the_title_attribute ) . '" rel="bookmark">', '</a></h2>' );
					?>
					<div class="ak-module-default-summary">
					<?php the_excerpt(); ?>
					</div>
					<div class="ak-module-default-meta">
						<?php get_template_part( 'views/post/meta', 'style-3' ); ?>
					</div>
				</header>
			</div>
		</article>
		<?php
	endwhile;

	global $wp_query;
	$big = 999999999; // need an unlikely integer
	echo '<div class="ak-module-pagination-default pagination simple clearfix">';
	echo paginate_links(
		array(
			'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'  => '?paged=%#%',
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total'   => $wp_query->max_num_pages,
		)
	);
	echo '</div>';
} else {
	?>
	<div class="no-results ak-no-posts">
		<?php newsy_echo_translation( 'No Content Available', 'newsy', 'no_content' ); ?>
	</div>
	<?php
}
