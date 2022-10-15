<?php
$search_button_style = newsy_get_option( 'search_button_style' );
?>
<div class="ak-bar-item ak-header-search">
	<a href="#" class="ak-header-icon-btn ak-dropdown-button ak-search-btn">
	<?php echo ak_get_icon( newsy_get_option( 'header_search_icon', 'akfi-search' ) ); ?>
	</a>
	<div class="ak-dropdown ak-search-box <?php echo esc_attr( $search_button_style ); ?> clearfix" data-event="click">
		<?php get_search_form(); ?>
	</div>
</div>
