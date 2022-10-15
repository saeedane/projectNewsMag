<?php

$footer_rows = newsy_get_option( 'builder_footer' );

if ( empty( $footer_rows['order'] ) ) {
	$footer_rows = Newsy\Support\PartBuilderData::builder_footer_defaults();
}

// render header elements
if ( ! empty( $footer_rows ) ) {
	?>
<div class="ak-footer-wrap">
	<div class="ak-container">
	<?php
	foreach ( (array) $footer_rows['order'] as $row ) {
		if ( ! empty( $footer_rows[ $row ] ) ) {
			newsy_generate_bar( $footer_rows[ $row ], $row, 'footer' );
		}
	}
	?>
	</div>
</div><!-- .ak-footer-wrap -->
	<?php
}
unset( $footer_rows );
