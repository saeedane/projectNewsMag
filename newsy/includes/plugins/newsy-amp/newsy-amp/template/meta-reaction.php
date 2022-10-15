<?php
if ( 'hide' !== newsy_get_option( 'post_show_badge_icon' ) ) {

	$output = apply_filters( 'newsy_post_badge_icons', '', get_the_ID(), 1, false );
	if ( $output ) {
		echo "<div class=\"amp-wp-tax-reaction\">{$output}</div>";
	}
}
