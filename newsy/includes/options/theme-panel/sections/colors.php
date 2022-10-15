<?php
//General Typography Settings

$fields[] = array(
	'heading' => esc_html__( 'Color Scheme', 'newsy' ),
	'id'      => 'general_colors_group_start',
	'type'    => 'group_start',
	'state'   => 'open',
	'section' => 'colors',
);
$fields[] = array(
	'id'          => 'site_scheme',
	'type'        => 'visual_select',
	'heading'     => esc_html__( 'Site Color Scheme', 'newsy' ),
	'description' => esc_html__( 'Choose your site color scheme.', 'newsy' ),
	'section'     => 'colors',
	'options'     => array(
		''     => esc_html__( 'Light', 'newsy' ),
		'dark' => esc_html__( 'Dark', 'newsy' ),
	),
);
$fields[] = array(
	'heading'     => esc_html__( 'Site Highlight Color', 'newsy' ),
	'description' => esc_html__( 'It is the contrast color for the theme. It will be used for all links, menu, category overlays, blocks, main page and many contrasting elements.', 'newsy' ),
	'id'          => 'site_highlight_color',
	'default'     => '#4493e0',
	'type'        => 'color',
	'section'     => 'colors',
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => array(
				'.ak-slider-dots li.ak-slider-active > .slider-dots-btn',
				'.ak-slider-dots li > .slider-dots-btn:hover',
				'.ak-module:not(.ak-module-grid) .ak-module-terms.badge > a:hover',
				'.ak-module:not(.ak-module-grid) .ak-module-terms.inline_badge > a:hover',
				'.ak-module-grid:hover .ak-module-terms.badge > a',
				'.ak-module-grid:hover .ak-module-terms.inline_badge > a',
			),
			'property' => 'background-color',
		),
		array(
			'type'     => 'css',
			'element'  => array(
				':root',
			),
			'property' => '--ak-highlight-color',
		),
	),
);
$fields[] = array(
	'heading'     => esc_html__( 'Site Accent Color', 'newsy' ),
	'description' => esc_html__( 'Set general accent color.', 'newsy' ),
	'id'          => 'site_accent_color',
	'default'     => '#ff007a',
	'type'        => 'color',
	'section'     => 'colors',
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => array(
				':root',
			),
			'property' => '--ak-accent-color',
		),
	),
);
$fields[] = array(
	'id'          => 'site_block_color',
	'type'        => 'color',
	'heading'     => esc_html__( 'Site Block Color', 'newsy' ),
	'description' => esc_html__( 'It is the default color for the blocks. It will be used for all block items. You can override this option for each block.', 'newsy' ),
	'section'     => 'colors',
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => array(
				'.ak-block',
			),
			'property' => '--ak-block-accent-color',
		),
		array(
			'type'     => 'css',
			'element'  => array(
				'.ak-block-header',
			),
			'property' => 'custom',
			'css'      => array(
				'--ak-block-header-bg-color'   => '%%value%%',
				'--ak-block-header-line-color' => '%%value%%',
				'--ak-block-title-text-color'  => '%%value%%',
				'--ak-block-title-bg-color'    => '%%value%%',
			),
		),
	),
);

