<?php
$the_shop = new Newsy\Page\Shop();
get_header();
the_post();
?>
	<div class="ak-content-wrap <?php echo esc_attr( $the_shop->get_wrap_class() ); ?>">
		<div class="ak-container">
		<?php $the_shop->get_breadcrumb( true ); ?>

			<?php do_action( 'newsy_content_before' ); ?>

			<div class="ak-content">
				<div class="container">

					<div class="row">

						<div class="<?php echo esc_attr( $the_shop->get_content_class() ); ?> content-column">

							<?php $the_shop->get_title(); ?>

							<?php the_content(); ?>

						</div><!-- .content-column -->

						<?php $the_shop->get_sidebar(); ?>

					</div>

				</div>
			</div>

			<?php do_action( 'newsy_content_after' ); ?>

		</div>
	</div>
<?php get_footer(); ?>
