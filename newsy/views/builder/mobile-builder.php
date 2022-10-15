<?php

$mobile_rows = newsy_get_option( 'builder_header_mobile' );

if ( empty( $mobile_rows['mobile'] ) ) {
	$mobile_rows = Newsy\Support\PartBuilderData::builder_header_mobile_defaults();
}

$mobile_rows = apply_filters( 'newsy_header_mobile_rows', $mobile_rows );

// render mobile rows
if ( ! empty( $mobile_rows ) ) {
	// backward compatible
	$order = ! empty( $mobile_rows['order'] ) ? $mobile_rows['order'] : array( 'mobile', 'mobile_menu' );
	foreach ( (array) $order as $row ) {
		if ( ! empty( $mobile_rows[ $row ] ) ) {
			newsy_generate_bar( $mobile_rows[ $row ], $row, 'header-mobile' );
		}
	}
}

unset( $mobile_rows );
