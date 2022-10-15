<?php
/**
 * Homepage
 */
$fields[] = array(
	'heading'     => esc_html__( 'Important Note', 'newsy' ),
	'description' => esc_html__( 'Following options doesn\'t work if you selected static page for front page in WP > Settings > Reading', 'newsy' ),
	'id'          => 'homepage_info',
	'type'        => 'info',
	'section'     => 'home',
);
$fields[] = array(
	'heading' => esc_html__( 'Home: Layout', 'newsy' ),
	'id'      => 'home_layout_heading',
	'type'    => 'group_start',
	'section' => 'home',
);
$fields   = array_merge( $fields, newsy_get_layout_fields( 'home', 'home', 'body.home' ) );

$fields[] = array(
	'heading' => esc_html__( 'Home: Grid', 'newsy' ),
	'id'      => 'home_grid_heading',
	'type'    => 'group_start',
	'section' => 'home',
);
$fields   = array_merge( $fields, newsy_get_grid_fields( 'home', 'home' ) );

$fields[] = array(
	'heading' => esc_html__( 'Home: Listing', 'newsy' ),
	'id'      => 'home_listing_heading',
	'type'    => 'group_start',
	'section' => 'home',
);

$fields = array_merge( $fields, newsy_get_list_fields( 'home', 'home' ) );
