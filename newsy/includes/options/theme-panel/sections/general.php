<?php

$fields[] = array(
	'heading' => esc_html__( 'Site: Layout ', 'newsy' ),
	'id'      => 'general_layout_group_start',
	'type'    => 'group_start',
	'section' => 'general',
	'state'   => 'open',
);
$fields   = array_merge( $fields, newsy_get_layout_fields( 'site', 'general', 'body', false ) );

$fields[] = array(
	'heading' => esc_html__( 'Site: Grid', 'newsy' ),
	'id'      => 'general_grid_group_start',
	'type'    => 'group_start',
	'section' => 'general',
);

$fields = array_merge( $fields, newsy_get_grid_fields( 'site', 'general', false ) );

$fields[] = array(
	'heading' => esc_html__( 'Site: Listing ', 'newsy' ),
	'id'      => 'general_listing_group_start',
	'type'    => 'group_start',
	'section' => 'general',
);

$fields = array_merge( $fields, newsy_get_list_fields( 'site', 'general', false ) );
