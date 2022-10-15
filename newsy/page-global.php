<?php
$the_post = Newsy\Single\SinglePage::get_instance();

get_header();
the_post();
?>
<div class="ak-content-wrap <?php echo esc_attr( $the_post->get_wrap_class() ); ?>">
		<div class="ak-container">
			<?php $the_post->get_breadcrumb( true ); ?>
			<div class="ak-content">
				<div class="container">
					<?php $the_post->get_title(); ?>

					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				</div>
			</div>
			<?php do_action( 'newsy_content_after' ); ?>
		</div>
	</div>
<?php get_footer(); ?>
