<?php
// if widgets are not active
if (
	! is_active_sidebar( 'footer-1' ) &&
	! is_active_sidebar( 'footer-2' ) &&
	! is_active_sidebar( 'footer-3' )
) {
	return;
}

$columns = newsy_get_option( 'footer_widgets', '3-column' );
if ( 'hide' !== $columns ) :
	?>
<div class="ak-footer-widgets">
	<div class="row">
		<?php

		switch ( $columns ) {

			case '3-column':
				add_filter(
					'newsy_block_width', function() {
						return 1;
					}
				);
				?>
				<div class="col-sm-4 ak-footer-column">
					<aside class="sidebar sidebar-footer-1">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</aside>
				</div>
				<div class="col-sm-4 ak-footer-column">
					<aside class="sidebar sidebar-footer-2">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</aside>
				</div>
				<div class="col-sm-4 ak-footer-column">
					<aside class="sidebar sidebar-footer-3">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</aside>
				</div>
				<?php
				break;

			case '2-column':
				add_filter(
					'newsy_block_width', function() {
						return 2;
					}
				);
				?>
				<div class="col-sm-6 ak-footer-column">
					<aside class="sidebar sidebar-footer-1">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</aside>
				</div>
				<div class="col-sm-6 ak-footer-column">
					<aside class="sidebar sidebar-footer-2">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</aside>
				</div>
				<?php
				break;

			case '1-column':
				add_filter(
					'newsy_block_width', function() {
						return 1;
					}
				);
				?>
				<div class="col-sm-12 ak-footer-column">
					<aside class="sidebar sidebar-footer-1">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</aside>
				</div>
				<?php
				break;

		}

		?>
	</div>
</div>
<?php endif; ?>
