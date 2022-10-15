<?php

$fields[] = array(
	'heading'         => esc_html__( 'footer Custom Template', 'newsy' ),
	'id'              => 'builder_footer_part_builder',
	'type'            => 'part_builder',
	'container_class' => 'control-heading-hide',
	'section'         => 'footer',
);

$fields[] = array(
	'id'                => 'builder_footer',
	'type'              => 'mix_fields',
	'heading'           => esc_html__( 'Footer Parts', 'newsy' ),
	'container_class'   => 'hidden',
	'fields'            => Newsy\Support\PartBuilderData::get_footer_fields(),
	'default'           => Newsy\Support\PartBuilderData::builder_footer_defaults(),
	'filter_default'    => false,
	'defaults_on_empty' => true,
	'section'           => 'footer',
);

/**
 *  Header Presets
 **/
$fields[] = array(
	'heading' => esc_html__( 'Footer Presets', 'newsy' ),
	'id'      => 'footer_preset_group_start',
	'type'    => 'group_start',
	'status'  => 'open',
	'section' => 'footer',
);
$fields[] = array(
	'heading'     => esc_html__( 'Warning', 'newsy' ),
	'description' => esc_html__( 'This option will reset your settings in footer', 'newsy' ),
	'id'          => 'footer_preset_info',
	'type'        => 'info',
	'info_type'   => 'warning',
	'section'     => 'footer',
);
$fields[] = array(
	'heading'          => esc_html__( 'Footer Presets', 'newsy' ),
	'description'      => esc_html__( 'Choose a predefined preset for your layout.', 'newsy' ),
	'id'               => 'footer_style',
	'type'             => 'radio_image',
	'options_callback' => 'newsy_get_footer_style_options',
	'exclude_value'    => true,
	'section'          => 'footer',
	'presets'          => array(
		'style-1' => array_merge(
			Newsy\Support\PartBuilderData::builder_footer_default_preset(),
			array(
				'builder_footer[order]'                => array( 'top', 'mid', 'bottom' ),
				'builder_footer[mid][left][layout]'    => 'normal',
				'builder_footer[mid][center][layout]'  => 'grow',
				'builder_footer[mid][right][layout]'   => 'normal',
				'builder_footer[mid][center][items]'   => array( 'footer_widgets' ),
				'builder_footer[bottom][left][layout]' => 'normal',
				'builder_footer[bottom][left][items]'  => array( 'footer_logo' ),
				'builder_footer[bottom][right][items]' => array( 'footer_menu' ),
				'footer_mid_height'                    => '500',
				'footer_bottom_height'                 => '70',
			)
		),
		'style-2' => array_merge(
			Newsy\Support\PartBuilderData::builder_footer_default_preset(),
			array(
				'builder_footer[order]'                 => array( 'top', 'mid', 'bottom' ),
				'builder_footer[mid][left][layout]'     => 'normal',
				'builder_footer[mid][center][layout]'   => 'grow',
				'builder_footer[mid][right][layout]'    => 'normal',
				'builder_footer[mid][center][items]'    => array( 'footer_widgets' ),
				'builder_footer[bottom][left][items]'   => array( 'footer_copyright' ),
				'builder_footer[bottom][center][items]' => array( 'footer_logo' ),
				'builder_footer[bottom][right][items]'  => array( 'footer_menu' ),
				'footer_mid_height'                     => '500',
				'footer_bottom_height'                  => '70',
			)
		),
		'style-3' => array_merge(
			Newsy\Support\PartBuilderData::builder_footer_default_preset(),
			array(
				'builder_footer[order]'                => array( 'top', 'mid', 'bottom' ),
				'builder_footer[mid][left][items]'     => array( 'footer_logo' ),
				'builder_footer[mid][right][items]'    => array( 'footer_social_icons' ),
				'builder_footer[bottom][left][items]'  => array( 'footer_copyright' ),
				'builder_footer[bottom][right][items]' => array( 'footer_menu' ),
				'footer_mid_height'                    => '70',
			)
		),
		'style-4' => array_merge(
			Newsy\Support\PartBuilderData::builder_footer_default_preset(),
			array(
				'builder_footer[order]'                 => array( 'top', 'mid', 'bottom' ),
				'builder_footer[mid][center][items]'    => array( 'footer_logo' ),
				'builder_footer[bottom][center][items]' => array( 'footer_menu' ),
				'footer_mid_height'                     => '70',
			)
		),
		'style-5' => array_merge(
			Newsy\Support\PartBuilderData::builder_footer_default_preset(),
			array(
				'builder_footer[order]'                 => array( 'top', 'mid', 'bottom' ),
				'builder_footer[mid][left][items]'      => array( 'footer_copyright' ),
				'builder_footer[mid][center][items]'    => array( 'footer_logo' ),
				'builder_footer[mid][right][items]'     => array( 'footer_social_icons' ),
				'builder_footer[bottom][center][items]' => array( 'footer_menu' ),
				'footer_mid_height'                     => '70',
			)
		),
	),
);
/**
 *  footer Rows
 **/
$fields[] = array(
	'heading' => esc_html__( 'Footer Style', 'newsy' ),
	'id'      => 'footer_style_group_start',
	'type'    => 'group_start',
	'status'  => 'open',
	'section' => 'footer',
);

$fields[] = array(
	'heading'     => esc_html__( 'Footer Wrap Background Color', 'newsy' ),
	'description' => esc_html__( 'Select header wrapper color.', 'newsy' ),
	'id'          => 'footer_bg_color',
	'type'        => 'color',
	'section'     => 'footer',
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-footer-wrap',
			'property' => 'background-color',
		),
	),
);
$fields[] = array(
	'heading'      => esc_html__( 'Footer Background Image', 'newsy' ),
	'description'  => esc_html__( 'Use light patterns in non-boxed layout. For patterns, use a repeating background. Use photo to fully cover the background with an image. Note that it will override the background color option.', 'newsy' ),
	'id'           => 'footer_bg_image',
	'type'         => 'background_image',
	'upload_label' => esc_html__( 'Upload Image', 'newsy' ),
	'section'      => 'footer',
	'output'       => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-footer-wrap',
			'property' => 'background-image',
		),
	),
);

$fields[] = array(
	'id'      => 'top_bar_footer',
	'type'    => 'heading',
	'heading' => esc_html__( 'Top Bar', 'newsy' ),
	'section' => 'footer',
);
$fields[] = array(
	'id'          => 'footer_top_bar_style',
	'type'        => 'css_editor',
	'heading'     => esc_html__( 'Row Style', 'newsy' ),
	'description' => esc_html__( 'Base css style for the row. You can add specific colors and spaces for row.', 'newsy' ),
	'section'     => 'footer',
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => array(
				'.ak-footer-wrap .ak-top-bar.full-width',
				'.ak-footer-wrap .ak-top-bar.boxed .ak-bar-inner',
			),
			'property' => 'css-editor',
		),
	),
);
$fields[] = array(
	'id'      => 'footer_top_height',
	'type'    => 'slider',
	'heading' => esc_html__( 'Row Height', 'newsy' ),
	'section' => 'footer',
	'default' => 35,
	'min'     => 20,
	'max'     => 200,
	'step'    => 1,
	'unit'    => 'px',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-footer-wrap .ak-top-bar',
			'property' => 'min-height',
			'units'    => 'px',
		),
	),
);

$fields[] = array(
	'id'      => 'mid_bar_footer',
	'type'    => 'heading',
	'heading' => esc_html__( 'Mid Bar', 'newsy' ),
	'section' => 'footer',
);
$fields[] = array(
	'id'          => 'footer_mid_bar_style',
	'type'        => 'css_editor',
	'heading'     => esc_html__( 'Row Style', 'newsy' ),
	'description' => esc_html__( 'Base css style for the row. You can add specific colors and spaces for row.', 'newsy' ),
	'section'     => 'footer',
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => array(
				'.ak-footer-wrap .ak-mid-bar.full-width',
				'.ak-footer-wrap .ak-mid-bar.boxed .ak-bar-inner',
			),
			'property' => 'css-editor',
		),
	),
);
$fields[] = array(
	'id'      => 'footer_mid_height',
	'type'    => 'slider',
	'heading' => esc_html__( 'Row Height', 'newsy' ),
	'section' => 'footer',
	'default' => 120,
	'min'     => 20,
	'max'     => 300,
	'step'    => 1,
	'unit'    => 'px',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-footer-wrap .ak-mid-bar',
			'property' => 'min-height',
			'units'    => 'px',
		),
	),
);
$fields[] = array(
	'id'      => 'bottom_bar_footer',
	'type'    => 'heading',
	'heading' => esc_html__( 'Bottom Bar', 'newsy' ),
	'section' => 'footer',
);
$fields[] = array(
	'id'          => 'footer_bottom_bar_style',
	'type'        => 'css_editor',
	'heading'     => esc_html__( 'Row Style', 'newsy' ),
	'description' => esc_html__( 'Base css style for the row. You can add specific colors and spaces for row.', 'newsy' ),
	'section'     => 'footer',
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => array(
				'.ak-footer-wrap .ak-bottom-bar.full-width',
				'.ak-footer-wrap .ak-bottom-bar.boxed .ak-bar-inner',
			),
			'property' => 'css-editor',
		),
	),
);
$fields[] = array(
	'id'      => 'footer_bottom_height',
	'type'    => 'slider',
	'heading' => esc_html__( 'Row Height', 'newsy' ),
	'section' => 'footer',
	'default' => 50,
	'min'     => 20,
	'max'     => 300,
	'step'    => 1,
	'unit'    => 'px',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-footer-wrap .ak-bottom-bar',
			'property' => 'min-height',
			'units'    => 'px',
		),
	),
);

/**
 *  Footer Menu
**/
$fields[] = array(
	'heading' => esc_html__( 'Footer: Menu', 'newsy' ),
	'id'      => 'footer_menu_group_start',
	'type'    => 'group_start',
	'section' => 'footer',
);

$fields[] = array(
	'heading'     => esc_html__( 'Footer Menu Style', 'newsy' ),
	'description' => esc_html__( 'Select style of footer menu.', 'newsy' ),
	'id'          => 'footer_menu_style',
	'type'        => 'radio_image',
	'options'     => array(
		'style-1' => array(
			'label' => esc_html__( 'Default Style', 'newsy' ),
			'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/menu_styles/style-1.png',
		),
		'style-2' => array(
			'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '2' ),
			'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/menu_styles/style-2.png',
		),
		'style-3' => array(
			'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '3' ),
			'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/menu_styles/style-3.png',
		),
		'style-4' => array(
			'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '4' ),
			'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/menu_styles/style-4.png',
		),
		'style-5' => array(
			'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '5' ),
			'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/menu_styles/style-5.png',
		),
		'style-6' => array(
			'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '6' ),
			'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/menu_styles/style-6.png',
		),
		'style-7' => array(
			'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '7' ),
			'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/menu_styles/style-7.png',
		),
	),
	'default'     => 'style-1',
	'section'     => 'footer',
);


/**
 *  Footer Logo
**/
$fields[] = array(
	'id'      => 'footer_logo_group_start',
	'type'    => 'group_start',
	'state'   => 'close',
	'heading' => esc_html__( 'Footer: Logo', 'newsy' ),
	'section' => 'footer',
);
$fields   = array_merge( $fields, newsy_get_logo_fields( 'footer', 'footer', '.ak-footer-logo' ) );

$fields[] = array(
	'heading' => esc_html__( 'Footer: Social Icons', 'newsy' ),
	'id'      => 'footer_social_icons_group_start',
	'type'    => 'group_start',
	'section' => 'footer',
);

$fields = array_merge( $fields, newsy_get_social_icons_fields( 'footer', 'footer' ) );

/**
 *  Footer Copyright
**/
$fields[] = array(
	'heading' => esc_html__( 'Footer: Copyright', 'newsy' ),
	'id'      => 'footer_copyright_group_start',
	'type'    => 'group_start',
	'section' => 'footer',
);
$fields[] = array(
	'heading'           => esc_html__( 'Copyright Text', 'newsy' ),
	'description'       => esc_html__( 'Enter the copy right text of footer. You can use following pattern to make replace them with real data: #year#: Will replace with current year, ex: 2015. #date#: Will replace with current year, ex: 2015. #sitename#: Will replace with site title. #title#: Will replace with site title. #siteurl#: Will replace with site homepage url.', 'newsy' ),
	'id'                => 'footer_copyright',
	'type'              => 'textarea',
	'defaukt'           => '\u00a9  <a href="#siteurl#" title="#title#">#sitename#</a> - #title#.',
	'section'           => 'footer',
	'sanitize_callback' => false,
);

//Create Button Settings

for ( $i = 1; $i <= 2; $i++ ) {
	$fields[] = array(
		'heading' => esc_html__( 'Footer: Button', 'newsy' ) . ' ' . $i,
		'id'      => 'footer_button' . $i . '_group_start',
		'type'    => 'group_start',
		'section' => 'footer',
	);
	$fields[] = array(
		'id'              => 'footer_button' . $i,
		'type'            => 'mix_fields',
		'container_class' => 'control-heading-hide',
		'heading'         => '',
		'section'         => 'footer',
		'fields_callback' => array(
			'function' => 'newsy_get_button_fields',
			'args'     => array( 'footer', '.ak-footer-button.ak-footer-button' . $i ),
		),
		'output'          => true,
	);
}

for ( $i = 1; $i <= 2; $i++ ) {
	$fields[] = array(
		'heading' => esc_html__( 'Footer: Ad', 'newsy' ) . ' ' . $i,
		'id'      => "footer_ad{$i}_group_start",
		'type'    => 'group_start',
		'section' => 'footer',
	);
	$fields[] = array(
		'id'              => "footer_ad{$i}",
		'type'            => 'mix_fields',
		'heading'         => esc_html__( 'Footer: Ad', 'newsy' ),
		'container_class' => 'control-heading-hide',
		'section'         => 'footer',
		'fields_callback' => 'newsy_get_ad_fields',
	);
}

for ( $i = 1; $i <= 3; $i++ ) {
	$fields[] = array(
		'heading' => esc_html__( 'Footer: HTML Element', 'newsy' ) . ' ' . $i,
		'id'      => 'footer_html' . $i . '_group_start',
		'type'    => 'group_start',
		'section' => 'footer',
	);

	$fields[] = array(
		'id'                => 'footer_html_' . $i,
		'type'              => 'textarea',
		'heading'           => esc_html__( 'HTML', 'newsy' ),
		'section'           => 'footer',
		'sanitize_callback' => false,
	);
}
