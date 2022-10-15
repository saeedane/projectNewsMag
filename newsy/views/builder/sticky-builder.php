<?php

$sticky_rows = newsy_get_option( 'builder_header_sticky' );

if ( empty( $sticky_rows['sticky'] ) ) {
	$sticky_rows = Newsy\Support\PartBuilderData::builder_header_sticky_defaults();
}

if ( ! empty( $sticky_rows ) && ! empty( $sticky_rows['sticky'] ) ) {
	newsy_generate_bar( $sticky_rows['sticky'], 'sticky', 'header-sticky' );
}

unset( $sticky_rows );
