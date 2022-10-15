<?php
// if widget are not active
if ( ! is_active_sidebar( 'footer-2' ) ) {
	return;
}
add_filter(
	'newsy_block_width', function() {
		return 1;
	}
);
?>
<div class="ak-bar-item ak-footer-widgets">
	<div class="sidebar sidebar-footer-2">
		<?php dynamic_sidebar( 'footer-2' ); ?>
	</div>
</div>
