<?php

$fields[] = array(
	'heading'     => esc_html__( 'Tip', 'newsy' ),
	'description' => esc_html__( 'You can override this settings for per category in category edit pages', 'newsy' ),
	'id'          => 'cat_info',
	'type'        => 'info',
	'info_type'   => 'tip',
	'section'     => 'categories',
);

$fields[] = array(
	'heading' => esc_html__( 'Category: Header', 'newsy' ),
	'id'      => 'category_header_style_group_start',
	'type'    => 'group_start',
	'state'   => 'open',
	'section' => 'categories',
);

$default = array(
	'background' => array(
		'type'  => '',
		'color' => newsy_get_option( 'category_header_bg_color' ),
		'image' => newsy_get_option( 'category_header_bg_image' ),
	),
	'padding'    => array(
		'top'    => newsy_get_option( 'category_header_padding_top' ),
		'bottom' => newsy_get_option( 'category_header_padding_bottom' ),
	),
);

$fields = array_merge( $fields, newsy_get_archive_header_fields( 'category', 'categories', 'body.category', true, $default ) );

$fields[] = array(
	'heading' => esc_html__( 'Show Subcategories?', 'newsy' ),
	'id'      => 'category_show_subcategories',
	'type'    => 'switcher',
	'options' => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section' => 'categories',
);

$fields[] = array(
	'heading' => esc_html__( 'Category: Layout ', 'newsy' ),
	'id'      => 'category_layout_group_start',
	'type'    => 'group_start',
	'section' => 'categories',
);
$fields   = array_merge( $fields, newsy_get_layout_fields( 'category', 'categories', 'body.category' ) );

$fields[] = array(
	'heading' => esc_html__( 'Category: Grid', 'newsy' ),
	'id'      => 'category_grid_group_start',
	'type'    => 'group_start',
	'section' => 'categories',
);

$fields = array_merge( $fields, newsy_get_grid_fields( 'category', 'categories' ) );

$fields[] = array(
	'heading' => esc_html__( 'Category: Listing ', 'newsy' ),
	'id'      => 'category_listing_group_start',
	'type'    => 'group_start',
	'section' => 'categories',
);

$fields = array_merge( $fields, newsy_get_list_fields( 'category', 'categories' ) );

