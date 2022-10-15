<?php
/**
 * Page Metabox.
 */
$fields[] = array(
	'heading' => esc_html__( 'Page', 'newsy' ),
	'id'      => 'page',
	'type'    => 'section',
	'icon'    => 'fa-file-text',
);

$fields = array_merge( $fields, newsy_get_layout_fields( 'page', 'page', 'body.page' ) );

$fields[] = array(
	'id'        => 'page_show_title',
	'type'      => 'select',
	'selectize' => false,
	'heading'   => esc_html__( 'Show Page Title?', 'newsy' ),
	'options'   => array(
		''     => esc_html__( 'Default - From Theme Panel', 'newsy' ),
		'show' => esc_html__( 'Show', 'newsy' ),
		'hide' => esc_html__( 'Hide', 'newsy' ),
	),
	'section'   => 'page',
);

$fields[] = array(
	'id'        => 'page_show_breadcrumb',
	'type'      => 'select',
	'selectize' => false,
	'heading'   => esc_html__( 'Show Breadcrumb?', 'newsy' ),
	'options'   => array(
		''     => esc_html__( 'Default - From Theme Panel', 'newsy' ),
		'show' => esc_html__( 'Show', 'newsy' ),
		'hide' => esc_html__( 'Hide', 'newsy' ),
	),
	'section'   => 'page',
);

$fields[] = array(
	'heading'   => esc_html__( 'Show Featured Image?', 'newsy' ),
	'id'        => 'page_show_featured_image',
	'type'      => 'select',
	'selectize' => false,
	'options'   => array(
		''     => esc_html__( 'Default - From Theme Panel', 'newsy' ),
		'show' => esc_html__( 'Yes', 'newsy' ),
		'hide' => esc_html__( 'No', 'newsy' ),
	),
	'section'   => 'page',
);

$fields[] = array(
	'heading'     => esc_html__( 'Main Navigation Menu', 'newsy' ),
	'description' => esc_html__( 'Replace & change main menu for this page.', 'newsy' ),
	'id'          => 'page_main_nav_menu',
	'type'        => 'select',
	'options'     => array(
		''                 => esc_html__( '-- Default Main Navigation --', 'newsy' ),
		'options_callback' => 'Ak\Form\FormCallback::get_menus',
	),
	'section'     => 'page',
);
