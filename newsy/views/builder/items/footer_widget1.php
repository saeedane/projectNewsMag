<?php
// if widget are not active
if ( ! is_active_sidebar( 'footer-1' ) ) {
	return;
}
add_filter(
	'newsy_block_width', function() {
		return 1;
	}
);
?>
<div class="ak-bar-item ak-footer-widgets">
	<div class="sidebar sidebar-footer-1">
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</div>
</div>
