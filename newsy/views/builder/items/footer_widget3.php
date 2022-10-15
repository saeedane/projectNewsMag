<?php
// if widget are not active
if ( ! is_active_sidebar( 'footer-3' ) ) {
	return;
}
add_filter(
	'newsy_block_width', function() {
		return 1;
	}
);
?>
<div class="ak-bar-item ak-footer-widgets">
	<div class="sidebar sidebar-footer-3">
		<?php dynamic_sidebar( 'footer-3' ); ?>
	</div>
</div>
