<?php

if ( have_posts() ) {

	while ( have_posts() ) :
		the_post();
		$the_post = Newsy\Single\SinglePost::get_instance();
		?>
		<article id="post-<?php echo esc_attr( $the_post->post->ID ); ?>" <?php $the_post->get_article_attrs(); ?>>
			<div class="ak-article-inner">
				<header class="ak-post-header">
					<?php $the_post->get_category(); ?>
					<?php $the_post->get_title(); ?>
					<?php $the_post->get_meta( 'style-2' ); ?>
				</header>
				<?php $the_post->get_featured_image( 'newsy_750x0' ); ?>

				<?php $the_post->get_excerpt(); ?>
			</div>
		</article>
		<?php
	endwhile;

	global $wp_query;
	$big = 999999999; // need an unlikely integer
	echo '<div class="pagination simple">';
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
