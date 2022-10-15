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

// backward compatibility
$id = ! empty( $_GET['tag_ID'] ) ? $_GET['tag_ID'] : 0;
if ( empty( $id ) ) {
	$id = ! empty( $args['option_id'] ) ? $args['option_id'] : 0;
}

$default = $id ? array(
	'background' => array(
		'color' => ak_get_term_meta( 'term_header_bg_color', $id ),
		'image' => ak_get_term_meta( 'term_header_bg_image', $id ),
	),
	'padding'    => array(
		'top'    => ak_get_term_meta( 'term_header_padding_top', $id ),
		'bottom' => ak_get_term_meta( 'term_header_padding_bottom', $id ),
	),
) : array();

$fields = array_merge( $fields, newsy_get_archive_header_fields( 'term', 'header', 'body.archive .ak-archive-wrap', true, $default ) );

$fields[] = array(
	'heading'  => esc_html__( 'Show Subcategories', 'newsy' ),
	'id'       => 'term_show_subcategories',
	'type'     => 'radio_button',
	'vertical' => true,
	'options'  => array(
		''     => esc_html__( 'Default', 'newsy' ),
		'show' => esc_html__( 'Show', 'newsy' ),
		'hide' => esc_html__( 'Hide', 'newsy' ),
	),
	'section'  => 'header',
);

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

$fields[] = array(
	'heading'     => esc_html__( 'Icon Badge Type?', 'newsy' ),
	'description' => esc_html__( 'Check this option to enable badge on archive post.', 'newsy' ),
	'id'          => 'term_badge_type',
	'type'        => 'visual_select',
	'options'     => array(
		''     => 'No Badge',
		'icon' => 'Icon',
		'text' => 'Text',
	),
	'section'     => 'style',
);

$fields[] = array(
	'heading'    => esc_html__( 'Badge Icon', 'newsy' ),
	'type'       => 'icon_select',
	'id'         => 'term_badge_icon',
	'section'    => 'style',
	'dependency' => array(
		'element' => 'term_badge_type',
		'value'   => array( 'icon' ),
	),
);
$fields[] = array(
	'heading'       => esc_html__( 'Badge Text', 'newsy' ),
	'id'            => 'term_badge_text',
	'description'   => esc_html__( 'Short text for badge icon. Ex: It can be Quiz for Quizzess.', 'newsy' ),
	'type'          => 'text',
	'section_class' => 'ak-section-full',
	'section'       => 'style',
	'dependency'    => array(
		'element' => 'term_badge_type',
		'value'   => array( 'text' ),
	),
);
$fields[] = array(
	'heading'       => esc_html__( 'Badge Text Color', 'newsy' ),
	'id'            => 'term_badge_color',
	'description'   => esc_html__( 'Text color for badge icon.', 'newsy' ),
	'type'          => 'color',
	'section_class' => 'ak-section-full',
	'section'       => 'style',
	'dependency'    => array(
		'element' => 'term_badge_type',
		'value'   => array( 'icon', 'text' ),
	),
	'output'        => array(
		array(
			'global_output' => true,
			'type'          => 'css',
			'element'       => '.ak-badge-icon.term-%%term_id%%',
			'property'      => 'color',
		),
	),
);
$fields[] = array(
	'heading'       => esc_html__( 'Badge Background Color', 'newsy' ),
	'id'            => 'term_badge_bg_color',
	'type'          => 'color',
	'section_class' => 'ak-section-full',
	'section'       => 'style',
	'dependency'    => array(
		'element' => 'term_badge_type',
		'value'   => array( 'icon', 'text' ),
	),
	'output'        => array(
		array(
			'global_output' => true,
			'type'          => 'css',
			'element'       => '.ak-badge-icon.term-%%term_id%%',
			'property'      => 'background-color',
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

// Posts
$fields[] = array(
	'heading' => esc_html__( 'Posts', 'newsy' ),
	'id'      => 'posts',
	'type'    => 'section',
	'icon'    => 'fa-th-list',
);

$fields = array_merge( $fields, newsy_get_list_fields( 'term', 'posts' ) );

$fields[] = array(
	'heading'     => esc_html__( 'Show List Block Header?', 'newsy' ),
	'description' => esc_html__( 'Select show or hide block header.', 'newsy' ),
	'id'          => 'term_show_loop_title',
	'type'        => 'radio_button',
	'vertical'    => true,
	'options'     => array(
		''     => esc_html__( 'Default', 'newsy' ),
		'show' => esc_html__( 'Show', 'newsy' ),
		'hide' => esc_html__( 'Hide', 'newsy' ),
	),
	'section'     => 'posts',
);

$fields[] = array(
	'heading'     => esc_html__( 'List Block Header Custom Title', 'newsy' ),
	'description' => esc_html__( 'Customize block header title in archive page.', 'newsy' ),
	'id'          => 'term_loop_custom_title',
	'type'        => 'text',
	'dependency'  => array(
		'element' => 'term_show_loop_title',
		'value'   => array( '', 'show' ),
	),
	'section'     => 'posts',
);

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
