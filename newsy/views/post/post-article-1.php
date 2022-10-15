<?php
if ( have_posts() ) :
	the_post();
	$the_post = Newsy\Single\SinglePost::get_instance();
	?>
<article id="post-<?php echo esc_attr( $the_post->post->ID ); ?>" <?php $the_post->get_article_attrs(); ?>>
	<div class="ak-article-inner">
		<?php $the_post->get_breadcrumb(); ?>

		<div class="ak-post-share-side-container">
			<header class="ak-post-header">
				<?php
				$the_post->get_category();

				$the_post->get_title();

				$the_post->get_meta();

				$the_post->get_featured_image( 'newsy_750x375' );
				?>
			</header>

			<div class="ak-post-share-side sticky-column">
				<?php $the_post->get_social_share_top(); ?>
			</div>

			<div class="ak-post-inner">

				<?php do_action( 'newsy_single_post_content_before', $the_post->id ); ?>

				<?php $the_post->get_excerpt(); ?>

				<div class="ak-post-content">
					<?php the_content(); ?>
					<?php $the_post->get_pagination(); ?>
				</div>

				<?php do_action( 'newsy_single_post_content_after', $the_post->id ); ?>

			</div>
		</div>

		<footer class="ak-post-footer">
			<?php $the_post->get_tags(); ?>

			<?php $the_post->get_social_share_bottom(); ?>

			<?php $the_post->get_next_prev_posts(); ?>

		</footer>
	</div>
	<?php do_action( 'newsy_single_post_after', $the_post->id ); ?>
</article>
	<?php
endif;
