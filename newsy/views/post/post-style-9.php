<?php

if ( have_posts() ) :
	the_post();
	$the_post = Newsy\Single\SinglePost::get_instance();
	?>
<article id="post-<?php echo esc_attr( $the_post->post->ID ); ?>" <?php $the_post->get_article_attrs(); ?>>

	<div class="ak-content ak_column_2">
		<?php $the_post->get_breadcrumb( true ); ?>

		<header class="ak-post-header">
			<div class="container">
				<?php
				$the_post->get_category();

				$the_post->get_title();

				$the_post->get_excerpt();

				$the_post->get_meta();

				$the_post->get_social_share_top();
				?>

			</div>
		</header>



		<?php do_action( 'newsy_single_post_content_before', $the_post->post->ID ); ?>

		<div class="ak-post-content">
			<div class="alignwide">
			<?php $the_post->get_featured_image( 'newsy_1140x570' ); ?>
			</div>
			<?php the_content(); ?>
			<?php $the_post->get_pagination(); ?>
		</div>

		<?php do_action( 'newsy_single_post_content_after', $the_post->post->ID ); ?>

		<footer class="ak-post-footer">
			<div class="container">
				<?php $the_post->get_tags(); ?>

				<?php $the_post->get_social_share_bottom(); ?>

				<?php $the_post->get_next_prev_posts(); ?>

				<?php do_action( 'newsy_single_post_after' ); ?>
			</div>
		</footer>
	</div>
</article>
	<?php
endif;
