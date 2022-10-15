<?php
$post_sticky_rows = newsy_get_option( 'builder_post_sticky' );

if ( empty( $post_sticky_rows['sticky'] ) ) {
	$post_sticky_rows = Newsy\Support\PartBuilderData::builder_post_sticky_defaults();
}

newsy_generate_bar( $post_sticky_rows['sticky'], 'sticky', 'post-sticky' );
unset( $post_sticky_rows );
