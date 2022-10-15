<?php

$fields[] = array(
	'heading' => __( 'Settings', 'newsy-amp' ),
	'id'      => 'settings',
	'type'    => 'section',
	'icon'    => 'fa-cog',
);

$fields[] = array(
	'id'          => 'amp_scheme',
	'type'        => 'visual_select',
	'heading'     => __( 'Color Scheme', 'newsy-amp' ),
	'description' => esc_html__( 'Select color scheme for site.', 'newsy-amp' ),
	'section'     => 'settings',
	'options'     => array(
		''     => esc_attr__( 'Light', 'newsy-amp' ),
		'dark' => esc_attr__( 'Dark', 'newsy-amp' ),
	),
);

$fields[] = array(
	'id'      => 'amp_background_color',
	'type'    => 'color',
	'heading' => __( 'Body Backgroud Color', 'newsy-amp' ),
	'section' => 'settings',
);

$fields[] = array(
	'id'      => 'amp_body_color',
	'type'    => 'color',
	'heading' => __( 'Body Color', 'newsy-amp' ),
	'section' => 'settings',
);

$fields[] = array(
	'id'      => 'amp_highlight_color',
	'type'    => 'color',
	'heading' => __( 'Highlight Color', 'newsy-amp' ),
	'section' => 'settings',
);

$fields[] = array(
	'id'          => 'drawer_scheme',
	'type'        => 'visual_select',
	'heading'     => __( 'Drawer Color Scheme', 'newsy-amp' ),
	'description' => esc_html__( 'Select color scheme for drawer menu.', 'newsy-amp' ),
	'section'     => 'settings',
	'options'     => array(
		''     => esc_attr__( 'Light', 'newsy-amp' ),
		'dark' => esc_attr__( 'Dark', 'newsy-amp' ),
	),
	'dependency'  => array(
		'element' => 'amp_scheme',
		'value'   => array( '' ),
	),
);

$fields[] = array(
	'heading'          => __( 'Select Social Share Icons', 'newsy-amp' ),
	'description'      => __( 'Social Sites', 'newsy-amp' ),
	'id'               => 'post_social_share_sites',
	'type'             => 'visual_checkbox',
	'options_callback' => 'newsy_get_share_options',
	'sorter'           => true,
	'default'          => 'facebook,twitter,pinterest',
	'section'          => 'settings',
);

$fields[]  = array(
	'heading' => __( 'Ads', 'newsy-amp' ),
	'id'      => 'ads',
	'type'    => 'section',
	'icon'    => 'fa-cog',
);
$locations = array( 'above_header', 'above_article', 'below_article', 'above_content', 'below_content' );

$ads = array(
	'above_header'  => array(
		'name' => esc_html__( 'Above header', 'newsy-amp' ),
	),
	'above_article' => array(
		'name' => esc_html__( 'Above article', 'newsy-amp' ),
	),
	'below_article' => array(
		'name' => esc_html__( 'Below article', 'newsy-amp' ),
	),
	'above_content' => array(
		'name' => esc_html__( 'Above content', 'newsy-amp' ),
	),
	'below_content' => array(
		'name' => esc_html__( 'Below content', 'newsy-amp' ),
	),
);

foreach ( $ads as $ad_id => $ad ) {
	$fields[] = array(
		'heading' => $ad['name'],
		'id'      => $ad_id . '_heading',
		'type'    => 'group_start',
		'section' => 'ads',
	);

	$fields[] = array(
		'id'              => 'amp_ads_' . $ad_id,
		'heading'         => $ad['name'],
		'type'            => 'mix_fields',
		'container_class' => 'ak-mix-fields-full control-heading-hide',
		'fields_callback' => array(
			'function' => 'newsy_get_ad_fields',
			'args'     => array( $ad ),
		),
		'section'         => 'ads',
	);
}
