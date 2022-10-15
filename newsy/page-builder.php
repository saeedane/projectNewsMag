<?php
/**
* Template Name: Page Builder Template
*/
Newsy\Single\SinglePage::get_instance();

get_header();
the_post();
?>
	<div class="ak-content-wrap">

		<div class="ak-container">

			<div class="ak-content vc-content">

				<?php the_content(); ?>

			</div>

		</div>
	</div><!-- .ak-content-wrap -->
<?php get_footer(); ?>
