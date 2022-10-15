<?php
/**
 * 404.php
 *---------------------------
 * The template for displaying 404 pages (not found)
 */

$the_404 = new Newsy\Page\Simple();
$the_404->set_template_id( '404' );
get_header();
?>
	<div class="ak-content-wrap content-404 <?php echo esc_attr( $the_404->get_wrap_class() ); ?>">
		<div class="ak-container">

			<?php do_action( 'newsy_content_before' ); ?>

			<div class="ak-content ">
				<div class="container">

					<div class="ak-page-not-found">

						<div class="ak-404-title-image">
							<img src="<?php echo esc_url( newsy_get_option( '404_image', NEWSY_THEME_URI . '/assets/images/404.png' ) ); ?>" alt="404">
						</div>

						<h1 class="ak-404-title"><?php newsy_echo_translation( 'Page Not Found!', 'newsy', '404_not_found' ); ?></h1>

						<p class="ak-404-text">
						<?php
						newsy_echo_translation(
							"We're sorry, but we can't find the page you were looking for. It's probably some thing we've done wrong but now we know about it and we'll try to fix it. In the meantime, try to go homepage:", 'newsy', '404_not_found_message'
						);
						?>
						</p>
						<div class="row action-links">
							<div class="ak-flex-column-center">
								<a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">
									<?php newsy_echo_translation( 'Back to Homepage', 'newsy', '404_go_homepage' ); ?>
								</a>
							</div>
						</div>
					</div>

				</div>
			</div>

			<?php do_action( 'newsy_content_after' ); ?>

		</div>
	</div>
<?php get_footer(); ?>
