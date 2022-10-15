<?php
/**
 * Archive Metabox.
 */

$fields[] = array(
	'heading' => esc_html__( 'Header', 'newsy' ),
	'id'      => 'header',
	'type'    => 'section',
	'icon'    => 'fa-window-maximize',
);

$fields = array_merge( $fields, newsy_get_archive_header_fields( 'term', 'header', 'body.archive .ak-archive-wrap' ) );

$fields[] = array(
	'heading'      => esc_html__( 'Header Logo', 'newsy' ),
	'description'  => esc_html__( 'Choose a logo for your archive header.', 'newsy' ),
	'id'           => 'term_header_custom_logo',
	'type'         => 'media_image',
	'media_title'  => esc_html__( 'Select or Upload Category Logo', 'newsy' ),
	'media_button' => esc_html__( 'Select Logo', 'newsy' ),
	'upload_label' => esc_html__( 'Upload Logo', 'newsy' ),
	'remove_label' => esc_html__( 'Remove', 'newsy' ),
	'section'      => 'header',
);

$fields[] = array(
	'heading'     => esc_html__( 'Show Header Name?', 'newsy' ),
	'description' => esc_html__( 'Hide or show category name from archive header. This may useful if you have background image styled header.', 'newsy' ),
	'id'          => 'term_show_term_name',
	'type'        => 'switcher',
	'options'     => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section'     => 'header',
);
$fields[] = array(
	'heading'     => esc_html__( 'Custom Header Name', 'newsy' ),
	'description' => esc_html__( 'Customize category title in archive page without renaming title of category.', 'newsy' ),
	'id'          => 'term_custom_term_name',
	'type'        => 'text',
	'dependency'  => array(
		'element' => 'term_show_term_name',
		'value'   => array( '' ),
	),
	'section'     => 'header',
);
/**
 * Cat Style.
 */
$fields[] = array(
	'heading' => esc_html__( 'Style', 'newsy' ),
	'id'      => 'style',
	'type'    => 'section',
	'icon'    => 'fa-paint-brush',
);

$fields[] = array(
	'heading'     => esc_html__( 'Highlight Color', 'newsy' ),
	'description' => esc_html__( 'This color will be used in several areas such as navigation and loop blocks to emphasize archive page.', 'newsy' ),
	'id'          => 'term_color',
	'type'        => 'color',
	'section'     => 'style',
	'output'      => array(
		array(
			'global_output' => true,
			'type'          => 'css',
			'element'       => array(
				'.ak-module .ak-module-terms.badge a.term-%%term_id%%',
				'.ak-module .ak-module-terms.badge a.term-%%term_id%%:hover',
				'.ak-module .ak-module-terms.inline_badge a.term-%%term_id%%',
				'.ak-module .ak-module-terms.inline_badge a.term-%%term_id%%:hover',
				'.ak-post-terms a.term-%%term_id%%:hover',
				'.ak-post-featured-wrap .ak-post-terms-wrapper .ak-post-terms a.term-%%term_id%%:hover',
			),
			'property'      => 'background-color',
		),
		array(
			'global_output' => true,
			'type'          => 'css',
			'element'       => array(
				'.ak-module .ak-module-terms.inline a.term-%%term_id%%',
				'.ak-module .ak-module-terms.inline a.term-%%term_id%%:hover',
			),
			'property'      => 'color',
		),
	),
);

// Slider
$fields[] = array(
	'heading' => esc_html__( 'Grids', 'newsy' ),
	'id'      => 'grids',
	'type'    => 'section',
	'icon'    => 'fa-columns',
);
$fields   = array_merge( $fields, newsy_get_grid_fields( 'term', 'grids' ) );


// Header Options
$fields[] = array(
	'heading' => esc_html__( 'Others', 'newsy' ),
	'id'      => 'others',
	'type'    => 'section',
	'icon'    => 'fa-gears',
);

$fields = array_merge( $fields, newsy_get_layout_fields( 'term', 'others', 'body' ) );

$fields[] = array(
	'heading'     => esc_html__( 'Page Main Navigation', 'newsy' ),
	'description' => esc_html__( 'Replace & change main menu for this page.', 'newsy' ),
	'id'          => 'term_main_nav_menu',
	'type'        => 'select',
	'options'     => array(
		''                 => esc_html__( '-- Default Main Navigation --', 'newsy' ),
		'options_callback' => 'Ak\Form\FormCallback::get_menus',
	),
	'section'     => 'others',
);
