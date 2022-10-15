<?php
/**
 * buddypress.php
 * ---------------------------
 * Used to display buddyPress archive page
 */

$the_bp = new Newsy\Page\BuddyPress();
get_header();
the_post();
?>
	<div class="ak-content-wrap <?php echo esc_attr( $the_bp->get_wrap_class() ); ?>">
		<div class="ak-container">

			<?php do_action( 'newsy_content_before' ); ?>

			<div class="ak-content buddypress-content">
				<?php if ( ! bp_is_user() && ! bp_is_group() ) { ?>
				<div class="container">
					<?php $the_bp->get_breadcrumb(); ?>

					<h1 class="page-title"><?php the_title(); ?></h1>

					<?php the_content(); ?>
				</div>
					<?php
				} else {
					the_content();
				}
				?>
			</div>

			<?php do_action( 'newsy_content_after' ); ?>

		</div>
	</div>
<?php get_footer(); ?>
