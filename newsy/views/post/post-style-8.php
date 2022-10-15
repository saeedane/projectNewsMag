<?php

if ( have_posts() ) :
	the_post();
	$the_post = Newsy\Single\SinglePost::get_instance();
	?>
<article id="post-<?php echo esc_attr( $the_post->post->ID ); ?>" <?php $the_post->get_article_attrs(); ?>>

	<div class="ak-content">
		<div class="container">
			<?php do_action( 'newsy_single_before' ); ?>

			<?php $the_post->get_breadcrumb(); ?>

			<header class="entry-header ak-post-header">
				<?php
				$the_post->get_category();

				$the_post->get_title();

				$the_post->get_meta();

				$the_post->get_featured_image( 'newsy_1140x570' );
				?>
			</header>

			<div class="row">

				<div class="<?php echo esc_attr( $the_post->get_content_class() ); ?> content-column">

					<div class="ak-article-inner">
						<?php $the_post->get_social_share_top(); ?>

						<?php do_action( 'newsy_single_post_content_before', $the_post->post->ID ); ?>

						<div class="ak-post-content">
							<?php $the_post->get_excerpt(); ?>

							<?php the_content(); ?>
							<?php $the_post->get_pagination(); ?>
						</div>

						<?php do_action( 'newsy_single_post_content_after', $the_post->post->ID ); ?>

						<footer class="ak-post-footer">
							<?php $the_post->get_tags(); ?>

							<?php $the_post->get_social_share_bottom(); ?>

							<?php $the_post->get_next_prev_posts(); ?>

						</footer>
					</div>

					<?php do_action( 'newsy_single_post_after' ); ?>

				</div><!-- .content-column -->

				<?php $the_post->get_sidebar(); ?>

			</div>

			<?php do_action( 'newsy_single_after' ); ?>
		</div>
	</div>
</article>
	<?php
endif;
