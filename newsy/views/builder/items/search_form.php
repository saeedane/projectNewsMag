<?php
$style = newsy_get_option( 'header_search_form_style' );
?>
<div class="ak-bar-item ak-header-search-form">
	<div class="ak-search-form <?php echo esc_attr( $style ); ?> clearfix">
		<?php get_search_form(); ?>
	</div>
</div>
