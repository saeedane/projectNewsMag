<?php
/**
* Template Name: Page Builder & Header Overlay Template
*/

add_filter( 'newsy_header_rows', 'newsy_set_header_rows_dark_scheme', 11 );
Newsy\Single\SinglePage::get_instance();

get_header();
the_post();
?>
	<div class="ak-content-wrap">
		<div class="ak-container">

			<div class="vc-content">

				<?php the_content(); ?>

			</div>

		</div>
	</div><!-- .ak-content-wrap -->
<?php get_footer(); ?>
