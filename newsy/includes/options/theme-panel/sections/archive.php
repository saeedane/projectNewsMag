<?php

/**
 * Page
 */
$fields[] = array(
	'heading' => esc_html__( 'Page', 'newsy' ),
	'id'      => 'page_group_start',
	'type'    => 'group_start',
	'section' => 'other_pages',
);
$fields[] = array(
	'heading' => esc_html__( 'Layout', 'newsy' ),
	'id'      => 'page_layout_heading',
	'type'    => 'heading',
	'section' => 'other_pages',
);
$fields   = array_merge( $fields, newsy_get_layout_fields( 'page', 'other_pages', 'body.single-page' ) );


/**
 * Other Archives
 */
$fields[] = array(
	'heading' => esc_html__( 'Archive Pages', 'newsy' ),
	'id'      => 'archives_group_start',
	'type'    => 'group_start',
	'section' => 'other_pages',
);

$fields[] = array(
	'heading' => esc_html__( 'Header', 'newsy' ),
	'id'      => 'archives_header_style_heading',
	'type'    => 'heading',
	'section' => 'other_pages',
);
$fields   = array_merge( $fields, newsy_get_archive_header_fields( 'archive', 'other_pages', 'body.archive:not(.category)' ) );

$fields[] = array(
	'heading' => esc_html__( 'Layout', 'newsy' ),
	'id'      => 'archives_layout_heading',
	'type'    => 'heading',
	'section' => 'other_pages',
);
$fields   = array_merge( $fields, newsy_get_layout_fields( 'archive', 'other_pages', 'body.archive:not(.category)' ) );

$fields[] = array(
	'heading' => esc_html__( 'Listing', 'newsy' ),
	'id'      => 'archives_listing_heading',
	'type'    => 'heading',
	'section' => 'other_pages',
);

$fields = array_merge( $fields, newsy_get_list_fields( 'archive', 'other_pages' ) );

/**
 * Taxonomies
 */
$fields[] = array(
	'heading' => esc_html__( 'Taxonomy Pages', 'newsy' ),
	'id'      => 'taxonomy_group_start',
	'type'    => 'group_start',
	'section' => 'other_pages',
);
$fields[] = array(
	'heading' => esc_html__( 'Header', 'newsy' ),
	'id'      => 'taxonomy_header_style_group_start',
	'type'    => 'heading',
	'section' => 'other_pages',
);
$fields   = array_merge( $fields, newsy_get_archive_header_fields( 'taxonomy', 'other_pages', 'body.taxonomy' ) );

$fields[] = array(
	'heading' => esc_html__( 'Layout', 'newsy' ),
	'id'      => 'taxonomy_layout_heading',
	'type'    => 'heading',
	'section' => 'other_pages',
);
$fields   = array_merge( $fields, newsy_get_layout_fields( 'taxonomy', 'other_pages', 'body.taxonomy' ) );

$fields[] = array(
	'heading' => esc_html__( 'Listing', 'newsy' ),
	'id'      => 'ataxonomy_listing_heading',
	'type'    => 'heading',
	'section' => 'other_pages',
);
$fields   = array_merge( $fields, newsy_get_list_fields( 'taxonomy', 'other_pages' ) );

/**
 * Tag
 */
$fields[] = array(
	'heading' => esc_html__( 'Tag', 'newsy' ),
	'id'      => 'tag_group_start',
	'type'    => 'group_start',
	'section' => 'other_pages',
);
$fields[] = array(
	'heading' => esc_html__( 'Header', 'newsy' ),
	'id'      => 'tag_header_style_group_start',
	'type'    => 'heading',
	'section' => 'other_pages',
);

$fields = array_merge( $fields, newsy_get_archive_header_fields( 'tag', 'other_pages', 'body.tag' ) );

$fields[] = array(
	'heading' => esc_html__( 'Layout', 'newsy' ),
	'id'      => 'tag_layout_heading',
	'type'    => 'heading',
	'section' => 'other_pages',
);
$fields   = array_merge( $fields, newsy_get_layout_fields( 'tag', 'other_pages', 'body.tag' ) );

$fields[] = array(
	'heading' => esc_html__( 'Grid', 'newsy' ),
	'id'      => 'tag_grid_heading',
	'type'    => 'heading',
	'section' => 'other_pages',
);

$fields = array_merge( $fields, newsy_get_grid_fields( 'tag', 'other_pages' ) );

$fields[] = array(
	'heading' => esc_html__( 'Listing', 'newsy' ),
	'id'      => 'tag_listing_heading',
	'type'    => 'heading',
	'section' => 'other_pages',
);

$fields = array_merge( $fields, newsy_get_list_fields( 'tag', 'other_pages' ) );

/**
 * Search
 */
$fields[] = array(
	'heading' => esc_html__( 'Search Page', 'newsy' ),
	'id'      => 'search_group_start',
	'type'    => 'group_start',
	'section' => 'other_pages',
);
$fields[] = array(
	'heading' => esc_html__( 'Header', 'newsy' ),
	'id'      => 'search_header_style_group_start',
	'type'    => 'heading',
	'section' => 'other_pages',
);

$fields = array_merge( $fields, newsy_get_archive_header_fields( 'search', 'other_pages', 'body.search' ) );

$fields[] = array(
	'heading' => esc_html__( 'Layout', 'newsy' ),
	'id'      => 'search_layout_heading',
	'type'    => 'heading',
	'section' => 'other_pages',
);
$fields   = array_merge( $fields, newsy_get_layout_fields( 'search', 'other_pages', 'body.search' ) );

$fields[] = array(
	'heading' => esc_html__( 'Listing', 'newsy' ),
	'id'      => 'search_listing_heading',
	'type'    => 'heading',
	'section' => 'other_pages',
);
$fields   = array_merge( $fields, newsy_get_list_fields( 'search', 'other_pages' ) );

/**
 * Author
 */
$fields[] = array(
	'heading' => esc_html__( 'Author Page', 'newsy' ),
	'id'      => 'author_listing_group_start',
	'type'    => 'group_start',
	'section' => 'other_pages',
);
$fields[] = array(
	'heading' => esc_html__( 'Layout', 'newsy' ),
	'id'      => 'author_layout_heading',
	'type'    => 'heading',
	'section' => 'other_pages',
);
$fields   = array_merge( $fields, newsy_get_layout_fields( 'author', 'other_pages', 'body.author' ) );

$fields[] = array(
	'heading' => esc_html__( 'Listing', 'newsy' ),
	'id'      => 'author_listing_heading',
	'type'    => 'heading',
	'section' => 'other_pages',
);

$fields = array_merge( $fields, newsy_get_list_fields( 'author', 'other_pages' ) );

/**
 * 404
 */
$fields[] = array(
	'heading' => esc_html__( '404 Not Found Page', 'newsy' ),
	'id'      => '404_group_start',
	'type'    => 'group_start',
	'section' => 'other_pages',
);
$fields[] = array(
	'heading' => esc_html__( '404 Not Found Page', 'newsy' ),
	'id'      => '404_group_start',
	'type'    => 'group_start',
	'section' => 'other_pages',
);
$fields[] = array(
	'id'          => '404_image',
	'heading'     => esc_html__( '404 Page Image', 'newsy' ),
	'description' => esc_html__( 'Select custom 404 image for 404 page', 'newsy' ),
	'type'        => 'media_image',
	'default'     => NEWSY_THEME_URI . '/assets/images/404.png',
	'section'     => 'other_pages',
);

/**
 * bbPress
 */
$fields[] = array(
	'heading' => esc_html__( 'bbPress Page', 'newsy' ),
	'id'      => 'bbpress_group_start',
	'type'    => 'group_start',
	'section' => 'other_pages',
);

if ( ! function_exists( 'is_bbpress' ) ) {
	$fields[] = newsy_get_plugin_required_info_field( 'bbPress', 'other_pages' );
} else {
	$fields = array_merge( $fields, newsy_get_layout_fields( 'bbpress', 'other_pages', 'body.bbpress' ) );
}

/**
 * BuddyPress
 */
$fields[] = array(
	'heading' => esc_html__( 'BuddyPress Page', 'newsy' ),
	'id'      => 'buddypress_group_start',
	'type'    => 'group_start',
	'section' => 'other_pages',
);

if ( ! function_exists( 'is_buddypress' ) ) {
	$fields[] = newsy_get_plugin_required_info_field( 'BuddyPress', 'other_pages' );
} else {
	$fields = array_merge( $fields, newsy_get_layout_fields( 'buddypress', 'other_pages', 'body.buddypress' ) );

	$fields[] = array(
		'heading'     => esc_html__( 'Dequeue BuddyPress Scripts from frontend?', 'newsy' ),
		'description' => esc_html__( 'We do not need BuddyPress scripts on frontend. You may dequeue BuddyPress scripts in order to gain some page speed. By default we don\'t touch anything. you may activate some buddypress plugins depends on this.', 'newsy' ),
		'id'          => 'dequeue_buddypress_on_frontend',
		'type'        => 'switcher',
		'options'     => array(
			'off' => '',
			'on'  => 'yes',
		),
		'section'     => 'other_pages',
	);

	$fields[] = array(
		'heading'     => esc_html__( 'Deregister BuddyPress Blocks?', 'newsy' ),
		'description' => esc_html__( 'You may deregister buddypress blocks in order to gain some page speed. By default BuddyPress does not have that option.', 'newsy' ),
		'id'          => 'deregister_buddypress_blocks',
		'type'        => 'switcher',
		'options'     => array(
			'off' => '',
			'on'  => 'yes',
		),
		'section'     => 'other_pages',
	);

	$fields[] = array(
		'heading' => esc_html__( 'Show Author Box Counters', 'newsy' ),
		'id'      => 'show_author_box_counters',
		'type'    => 'switcher',
		'options' => array(
			'off' => 'hide',
			'on'  => '',
		),
		'section' => 'other_pages',
	);
	$fields[] = array(
		'heading' => esc_html__( 'Show Author Box MyCred Badges', 'newsy' ),
		'id'      => 'show_author_box_mycred_badges',
		'type'    => 'switcher',
		'options' => array(
			'off' => 'hide',
			'on'  => '',
		),
		'section' => 'other_pages',
	);
	$fields[] = array(
		'heading' => esc_html__( 'Author Box MyCred Badges Limit', 'newsy' ),
		'id'      => 'author_box_mycred_badges_limit',
		'type'    => 'number',
		'defualt' => 5,
		'section' => 'other_pages',
	);
	$fields[] = array(
		'heading' => esc_html__( 'Show Author Box MyCred Rank', 'newsy' ),
		'id'      => 'show_author_box_mycred_rank',
		'type'    => 'switcher',
		'options' => array(
			'off' => 'hide',
			'on'  => '',
		),
		'section' => 'other_pages',
	);
}

/**
 * WooCommerce
 */
$fields[] = array(
	'heading' => esc_html__( 'WooCommerce Page', 'newsy' ),
	'id'      => 'woocommerce_group_start',
	'type'    => 'group_start',
	'section' => 'other_pages',
);
if ( ! function_exists( 'is_woocommerce' ) ) {
	$fields[] = newsy_get_plugin_required_info_field( 'WooCommerce', 'other_pages' );
} else {
	$fields[] = array(
		'heading' => esc_html__( 'Shop Home', 'newsy' ),
		'id'      => 'shophome_heading',
		'type'    => 'heading',
		'section' => 'other_pages',
	);
	$fields   = array_merge( $fields, newsy_get_layout_fields( 'woocommerce', 'other_pages', 'body.woocommerce.woocommerce-shop' ) );
	$fields[] = array(
		'heading' => esc_html__( 'Shop Category Page', 'newsy' ),
		'id'      => 'shoptax_heading',
		'type'    => 'heading',
		'section' => 'other_pages',
	);
	$fields   = array_merge( $fields, newsy_get_layout_fields( 'woocommerce_tax', 'other_pages', 'body.woocommerce.archive' ) );
	$fields[] = array(
		'heading' => esc_html__( 'Shop Product Page', 'newsy' ),
		'id'      => 'shopproduct_heading',
		'type'    => 'heading',
		'section' => 'other_pages',
	);
	$fields   = array_merge( $fields, newsy_get_layout_fields( 'woocommerce_product', 'other_pages', 'body.woocommerce.single' ) );
}
