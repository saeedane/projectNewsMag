<?php

$header_rows = newsy_get_option( 'builder_header_desktop' );

if ( empty( $header_rows['order'] ) ) {
	$header_rows = Newsy\Support\PartBuilderData::builder_header_desktop_defaults();
}

$header_rows = apply_filters( 'newsy_header_rows', $header_rows );

// render header rows
if ( ! empty( $header_rows ) ) {
	foreach ( (array) $header_rows['order'] as $row ) {
		if ( ! empty( $header_rows[ $row ] ) ) {
			newsy_generate_bar( $header_rows[ $row ], $row );
		}
	}
}

unset( $header_rows );
