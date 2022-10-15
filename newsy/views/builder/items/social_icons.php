<div class="ak-bar-item ak-header-social-icons">
	<?php
	// Needs Social Counter plugin
	if ( function_exists( 'newsy_social_counter_render' ) ) {
		$icons = newsy_get_option( 'header_social_icons', 'facebook,twitter' );
		$style = newsy_get_option( 'header_social_icons_style', 'light' );

		echo newsy_social_counter_render( $icons, 'style-4', $style, true );
	}
	?>
</div>
