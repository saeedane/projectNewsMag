<?php

if ( ! defined( 'NEWSY_ELEMENTS_PATH' ) ) {
	$fields[] = newsy_get_plugin_required_info_field( 'Newsy Elements', 'blocks' );
	return;
}

/**
 * -> Post & Page Typography
 */

$fields[] = array(
	'heading' => esc_html__( 'Block Header', 'newsy' ),
	'id'      => 'general_modules_style',
	'type'    => 'group_start',
	'state'   => 'open',
	'section' => 'blocks',
);
$fields[] = array(
	'id'               => 'block_header_style',
	'type'             => 'radio_image',
	'heading'          => esc_html__( 'Block Header Style', 'newsy' ),
	'description'      => esc_html__( 'Select a default block header style.', 'newsy' ),
	'options_callback' => 'newsy_get_block_header_styles',
	'default'          => 'style-1',
	'section'          => 'blocks',
);
$fields[] = array(
	'heading'          => esc_html__( 'Block Extra Classes', 'newsy' ),
	'description'      => esc_html__( 'Select block extra classes. Ex: You can set boxed style block or dark style block with these predefined classes or you can add custom CSS classes.', 'newsy' ),
	'id'               => 'block_classes',
	'type'             => 'text',
	'selectize'        => true,
	'delimiter'        => ' ',
	'options_callback' => 'newsy_get_block_supported_classes',
	'section'          => 'blocks',
);

$fields[] = array(
	'id'      => 'block_load_more_group_start',
	'type'    => 'group_start',
	'heading' => esc_html__( 'Block Pagination', 'newsy' ),
	'section' => 'blocks',
);

$fields[] = array(
	'heading'     => esc_html__( 'Block Loader Type', 'newsy' ),
	'description' => esc_html__( 'Select a block pagination loading style.', 'newsy' ),
	'id'          => 'block_loader_type',
	'type'        => 'visual_select',
	'options'     => array(
		''       => esc_html__( 'Dots', 'newsy' ),
		'circle' => esc_html__( 'Circle', 'newsy' ),
		'square' => esc_html__( 'Square', 'newsy' ),
		'cube'   => esc_html__( 'Cube', 'newsy' ),
	),
	'section'     => 'blocks',
);

$fields[] = array(
	'id'      => 'block_load_more_heading',
	'type'    => 'heading',
	'heading' => esc_html__( 'Load More Button', 'newsy' ),
	'section' => 'blocks',
);
$fields[] = array(
	'id'      => 'block_load_more_width',
	'type'    => 'slider',
	'heading' => esc_html__( 'Block Load More Button Width', 'newsy' ),
	'section' => 'blocks',
	'min'     => 30,
	'max'     => 100,
	'step'    => 5,
	'unit'    => '%',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block .ak-pagination.load_more .ak-pagination-btn, .ak-block .ak-pagination.infinity .ak-pagination-btn, .ak-block .ak-pagination.infinity_load_more .ak-pagination-btn',
			'property' => 'width',
			'units'    => '%',
		),
	),
);

$fields[] = array(
	'id'      => 'block_load_more_bg_color',
	'type'    => 'color',
	'heading' => esc_html__( 'Load More Button Background Color', 'newsy' ),
	'section' => 'blocks',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block .ak-pagination.load_more .ak-pagination-btn, .ak-block .ak-pagination.infinity .ak-pagination-btn, .ak-block .ak-pagination.infinity_load_more .ak-pagination-btn',
			'property' => 'background-color',
		),
	),
);

$fields[] = array(
	'id'      => 'block_load_more_text_color',
	'type'    => 'color',
	'heading' => esc_html__( 'Load More Button Text Color', 'newsy' ),
	'section' => 'blocks',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block .ak-pagination.load_more .ak-pagination-btn, .ak-block .ak-pagination.infinity .ak-pagination-btn, .ak-block .ak-pagination.infinity_load_more .ak-pagination-btn',
			'property' => 'color',
		),
	),
);

$fields[] = array(
	'id'      => 'block_load_more_border_color',
	'type'    => 'color',
	'heading' => esc_html__( 'Load More Button Border Color', 'newsy' ),
	'section' => 'blocks',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block .ak-pagination.load_more .ak-pagination-btn, .ak-block .ak-pagination.infinity .ak-pagination-btn, .ak-block .ak-pagination.infinity_load_more .ak-pagination-btn',
			'property' => 'border-color',
		),
	),
);

$fields[] = array(
	'id'      => 'block_load_more_hover_bg_color',
	'type'    => 'color',
	'heading' => esc_html__( 'Load More Button Hover Background Color', 'newsy' ),
	'section' => 'blocks',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block .ak-pagination.load_more .ak-pagination-btn:hover, .ak-block .ak-pagination.infinity .ak-pagination-btn:hover, .ak-block .ak-pagination.infinity_load_more .ak-pagination-btn:hover',
			'property' => 'background-color',
		),
	),
);

$fields[] = array(
	'id'      => 'block_load_more_hover_text_color',
	'type'    => 'color',
	'heading' => esc_html__( 'Load More Button Hover Text Color', 'newsy' ),
	'section' => 'blocks',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block .ak-pagination.load_more .ak-pagination-btn:hover, .ak-block .ak-pagination.infinity .ak-pagination-btn:hover, .ak-block .ak-pagination.infinity_load_more .ak-pagination-btn:hover',
			'property' => 'color',
		),
	),
);

$fields[] = array(
	'id'      => 'block_load_more_hover_border_color',
	'type'    => 'color',
	'heading' => esc_html__( 'Load More Button Hover Border Color', 'newsy' ),
	'section' => 'blocks',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block .ak-pagination.load_more .ak-pagination-btn:hover, .ak-block .ak-pagination.infinity .ak-pagination-btn:hover, .ak-block .ak-pagination.infinity_load_more .ak-pagination-btn:hover',
			'property' => 'border-color',
		),
	),
);

$fields[] = array(
	'id'      => 'heading_block_next_prev',
	'type'    => 'heading',
	'heading' => esc_html__( 'Next-Prev Button', 'newsy' ),
	'section' => 'blocks',
);

$fields[] = array(
	'id'      => 'block_next_prev_bg_color',
	'type'    => 'color',
	'heading' => esc_html__( 'Next Prev Button Background Color', 'newsy' ),
	'section' => 'blocks',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block .ak-pagination.next_prev .ak-pagination-btn',
			'property' => 'background-color',
		),
	),
);
$fields[] = array(
	'id'      => 'block_next_prev_hover_bg_color',
	'type'    => 'color',
	'heading' => esc_html__( 'Next Prev Button Hover Background Color', 'newsy' ),
	'section' => 'blocks',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block .ak-pagination.next_prev .ak-pagination-btn:hover',
			'property' => 'background-color',
		),
	),
);
$fields[] = array(
	'id'      => 'block_next_prev_border_color',
	'type'    => 'color',
	'heading' => esc_html__( 'Next Prev Button Border Color', 'newsy' ),
	'section' => 'blocks',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block .ak-pagination.next_prev .ak-pagination-btn',
			'property' => 'border-color',
		),
	),
);

$fields[] = array(
	'id'      => 'block_next_prev_hover_border_color',
	'type'    => 'color',
	'heading' => esc_html__( 'Next Prev Button Hover Border Color', 'newsy' ),
	'section' => 'blocks',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block .ak-pagination.next_prev .ak-pagination-btn:hover',
			'property' => 'border-color',
		),
	),
);

$fields[] = array(
	'id'      => 'block_next_prev_text_color',
	'type'    => 'color',
	'heading' => esc_html__( 'Next Prev Button Text Color', 'newsy' ),
	'section' => 'blocks',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block .ak-pagination.next_prev .ak-pagination-btn',
			'property' => 'color',
		),
	),
);

$fields[] = array(
	'id'      => 'block_next_prev_hover_text_color',
	'type'    => 'color',
	'heading' => esc_html__( 'Next Prev Button Hover Text Color', 'newsy' ),
	'section' => 'blocks',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block .ak-pagination.next_prev .ak-pagination-btn:hover',
			'property' => 'color',
		),
	),
);


$fields[] = array(
	'heading' => esc_html__( 'Block Parts Style', 'newsy' ),
	'id'      => 'category_badges_group_start',
	'type'    => 'group_start',
	'section' => 'blocks',
);
$fields[] = array(
	'id'          => 'cat_badge_style',
	'type'        => 'css_editor',
	'heading'     => esc_html__( 'Category Badge Style', 'newsy' ),
	'description' => esc_html__( 'Override category badges styles on blocks.', 'newsy' ),
	'section'     => 'blocks',
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => array(
				'.ak-module .ak-module-terms.badge > a',
				'.ak-module .ak-module-terms.badge > a:hover',
				'.ak-module:hover .ak-module-terms.badge > a',
			),
			'property' => 'css-editor',
		),
	),
);

$fields[] = array(
	'id'          => 'cat_badge_inline_style',
	'type'        => 'css_editor',
	'heading'     => esc_html__( 'Category Inline Badge Style', 'newsy' ),
	'description' => esc_html__( 'Override category badges styles on blocks.', 'newsy' ),
	'section'     => 'blocks',
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => array(
				'.ak-module .ak-module-terms.inline_badge > a',
				'.ak-module .ak-module-terms.inline_badge > a:hover',
				'.ak-module:hover .ak-module-terms.inline_badge > a',
			),
			'property' => 'css-editor',
		),
	),
);


$fields[] = array(
	'id'          => 'module_featured_meta_style',
	'type'        => 'css_editor',
	'heading'     => esc_html__( 'Module: Featured Meta Style', 'newsy' ),
	'description' => esc_html__( 'This option will set style meta wrapper on featured image in all listings.', 'newsy' ),
	'section'     => 'blocks',
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => array(
				'.ak-module .ak-module-featured-meta',
			),
			'property' => 'css-editor',
		),
	),
);

$fields[] = array(
	'heading' => esc_html__( 'Block Share Buttons', 'newsy' ),
	'id'      => 'module_share_group_start',
	'type'    => 'group_start',
	'section' => 'blocks',
);

if ( ! defined( 'NEWSY_SOCIAL_SHARE_PATH' ) ) {
	$fields[] = newsy_get_plugin_required_info_field( 'Newsy Social Share', 'blocks' );
} else {
	$fields[] = array(
		'heading'          => esc_html__( 'Social Sites', 'newsy' ),
		'description'      => esc_html__( 'Select active social share links and sort them.', 'newsy' ),
		'id'               => 'module_social_share_sites',
		'type'             => 'visual_checkbox',
		'options_callback' => 'newsy_get_share_options',
		'sorter'           => true,
		'default'          => 'facebook,twitter,pinterest',
		'section'          => 'blocks',
	);

	$fields[] = array(
		'id'          => 'module_social_share_show_count',
		'type'        => 'slider',
		'heading'     => esc_html__( 'Social Share Threshold', 'newsy' ),
		'description' => esc_html__( 'Set the number of social share threshold. The total number of social share will be shown if it reaches more than this threshold.', 'newsy' ),
		'section'     => 'blocks',
		'default'     => 2,
		'min'         => 1,
		'max'         => 10,
		'step'        => 1,
		'unit'        => 'items',
	);
	$fields[] = array(
		'id'          => 'module_social_share_style',
		'type'        => 'visual_select',
		'heading'     => esc_html__( 'Social Icons Type', 'newsy' ),
		'description' => esc_html__( 'Set which social icons style that you want to use. ', 'newsy' ),
		'section'     => 'blocks',
		'default'     => 'style-1',
		'options'     => array(
			'style-1' => sprintf( esc_html__( 'Style %s', 'newsy' ), '1' ),
			'style-2' => sprintf( esc_html__( 'Style %s', 'newsy' ), '2' ),
			'style-3' => sprintf( esc_html__( 'Style %s', 'newsy' ), '3' ),
			'style-4' => sprintf( esc_html__( 'Style %s', 'newsy' ), '4' ),
			'style-5' => sprintf( esc_html__( 'Style %s', 'newsy' ), '5' ),
			'style-6' => sprintf( esc_html__( 'Style %s', 'newsy' ), '6' ),
		),
	);
	$fields[] = array(
		'heading'     => esc_html__( 'Show Share Count?', 'newsy' ),
		'description' => esc_html__( 'Enabling this will show post share count in share box.', 'newsy' ),
		'id'          => 'module_social_share_count',
		'type'        => 'visual_select',
		'default'     => 'each',
		'options'     => array(
			'each'       => esc_html__( 'Show only each site count', 'newsy' ),
			'total'      => esc_html__( 'Show only total count', 'newsy' ),
			'total-each' => esc_html__( 'Show total share count and each site count', 'newsy' ),
			'hide'       => esc_html__( 'No share count', 'newsy' ),
		),
		'section'     => 'blocks',
	);
}
