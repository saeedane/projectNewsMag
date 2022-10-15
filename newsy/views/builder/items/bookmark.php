<?php
if ( 'no' !== newsy_get_option( 'header_bookmark_show_user' ) && ! is_user_logged_in() || ! defined( 'NEWSY_BOOKMARK_PATH' ) ) {
	return;
}
?>
<div class="ak-bar-item ak-header-bookmark">
	<a href="#" class="ak-header-icon-btn ak-dropdown-button ak-bookmark-dropdown-button">
		<?php echo ak_get_icon( newsy_get_option( 'header_bookmark_icon', 'fa-bookmark-o' ) ); ?>
	</a>
	<div class="ak-dropdown clearfix" data-event="click">
		<div class="ak-dropdown-inner">
			<?php echo newsy_get_loader(); ?>
		</div>
	</div>
</div>
