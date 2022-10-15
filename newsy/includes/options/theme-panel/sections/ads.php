<?php

/**
 * -> Post & Page Typography.
 */
$fields[] = array(
	'heading' => esc_html__( 'Background Ad', 'newsy' ),
	'id'      => 'bg_heading',
	'type'    => 'group_start',
	'section' => 'ads',
);
$fields[] = array(
	'heading'     => esc_html__( 'Tip', 'newsy' ),
	'description' => esc_html__( 'You should set Full Boxed layout style and add background image in "General" tab to use background ad.', 'newsy' ),
	'id'          => 'bg_ad_info',
	'type'        => 'info',
	'info_type'   => 'tip',
	'section'     => 'ads',
);
$fields[] = array(
	'id'      => 'background_ads_url',
	'heading' => esc_html__( 'Background Ad Url', 'newsy' ),
	'type'    => 'text',
	'section' => 'ads',
);

$fields[] = array(
	'id'      => 'background_ads_open_tab',
	'type'    => 'select',
	'heading' => esc_html__( 'Background Ad Open New Tab', 'newsy' ),
	'options' => array(
		''   => esc_html__( 'Open new tab', 'newsy' ),
		'no' => esc_html__( 'Current tab', 'newsy' ),
	),
	'section' => 'ads',
);


$ads = newsy_get_supported_ad_options();

foreach ( $ads as $ad_id => $ad ) {
	$fields = array_merge( $fields, newsy_get_ad_group_fields( $ad_id, $ad ) );
}
