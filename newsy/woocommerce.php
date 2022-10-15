<?php
/**
 * woocommerce.php
 *---------------------------
 * The template for displaying WooCommerce pages
 */

$the_shop = new Newsy\Page\Shop();
get_header();

?>
	<div class="ak-content-wrap <?php echo esc_attr( $the_shop->get_wrap_class() ); ?>">
		<div class="ak-container">

			<?php do_action( 'newsy_archive_content_before', $the_shop ); ?>

			<div class="ak-content">
				<div class="container">
					<div class="row">

						<div class="<?php echo esc_attr( $the_shop->get_content_class() ); ?> content-column">

							<?php do_action( 'newsy_archive_content_loop_before', $the_shop ); ?>

							<?php woocommerce_content(); ?>

							<?php do_action( 'newsy_archive_content_loop_after', $the_shop ); ?>

						</div><!-- .content-column -->

						<?php $the_shop->get_sidebar(); ?>

					</div>
				</div>
			</div>

			<?php do_action( 'newsy_archive_content_after', $the_shop ); ?>

		</div>
	</div>
<?php get_footer(); ?>
