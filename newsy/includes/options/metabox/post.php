<?php
/**
 * Post Metabox.
 */
$fields[] = array(
	'heading' => esc_html__( 'Post', 'newsy' ),
	'id'      => 'post',
	'type'    => 'section',
	'icon'    => 'fa-file-text',
);
$fields[] = array(
	'heading'     => esc_html__( 'Post template', 'newsy' ),
	'description' => esc_html__( 'Override template for single post.', 'newsy' ),
	'id'          => 'post_template',
	'type'        => 'radio_image',
	'options'     => newsy_get_single_template_options( true ),
	'section'     => 'post',
);


$fields[] = array(
	'heading'     => esc_html__( 'Post Featured Video/Embed', 'newsy' ),
	'description' => esc_html__( 'Set featured post video or embed. Set post format as Video for this setting', 'newsy' ),
	'id'          => 'featured_video',
	'type'        => 'mix_fields',
	'fields'      => array(
		array(
			'id'              => 'type',
			'type'            => 'select',
			'selectize'       => false,
			'container_class' => 'control-heading-full',
			'options'         => array(
				''       => 'No video',
				'auto'   => 'Auto-detect the embed from the post content',
				'url'    => 'From the URL (Youtube, Vimeo, Tweet, Tiktok video, Facebook post, etc.)',
				'upload' => 'Upload',
			),
		),
		array(
			'heading'         => esc_html__( 'Video Url', 'newsy' ),
			'id'              => 'url',
			'type'            => 'text',
			'container_class' => 'control-heading-full',
			'dependency'      => array(
				'element' => 'type',
				'value'   => array( 'url' ),
			),
		),
		array(
			'heading'         => esc_html__( 'Mp4 Video', 'newsy' ),
			'id'              => 'mp4',
			'type'            => 'media',
			'media_type'      => 'video/mp4',
			'button_text'     => esc_html__( 'Upload .mp4', 'newsy' ),
			'media_title'     => esc_html__( 'Upload .mp4', 'newsy' ),
			'container_class' => 'control-heading-full',
			'dependency'      => array(
				'element' => 'type',
				'value'   => array( 'upload' ),
			),
		),
		array(
			'heading'         => esc_html__( 'Webm Video', 'newsy' ),
			'id'              => 'webm',
			'type'            => 'media',
			'media_type'      => 'video/webm',
			'button_text'     => esc_html__( 'Upload .webm', 'newsy' ),
			'media_title'     => esc_html__( 'Upload .webm', 'newsy' ),
			'container_class' => 'control-heading-full',
			'dependency'      => array(
				'element' => 'type',
				'value'   => array( 'upload' ),
			),
		),
		array(
			'heading'         => esc_html__( 'Video Length', 'newsy' ),
			'id'              => 'length',
			'type'            => 'text',
			'container_class' => 'control-heading-full',
			'dependency'      => array(
				'element' => 'type',
				'value'   => array( 'url', 'upload' ),
			),
		),
		array(
			'heading'         => esc_html__( 'Enable Full Player Controls?', 'newsy' ),
			'id'              => 'controls',
			'type'            => 'switcher',
			'container_class' => 'control-heading-full',
			'options'         => array(
				'on'  => 'yes',
				'off' => '',
			),
			'dependency'      => array(
				'element' => 'type',
				'value'   => array( 'upload' ),
			),
		),
		array(
			'heading'         => esc_html__( 'Play as GIF?', 'newsy' ),
			'id'              => 'gif',
			'type'            => 'switcher',
			'container_class' => 'control-heading-full',
			'options'         => array(
				'on'  => 'yes',
				'off' => '',
			),
			'dependency'      => array(
				'element' => 'type',
				'value'   => array( 'upload' ),
			),
		),
	),
	'section'     => 'post',
);
$fields[] = array(
	'heading'     => esc_html__( 'Post Primary Category', 'newsy' ),
	'description' => esc_html__( 'Set primary post category. This is used on block posts.', 'newsy' ),
	'id'          => 'post_primary_category',
	'type'        => 'select',
	'options'     => array(
		''                 => esc_html__( '-- Auto Select --', 'newsy' ),
		'options_callback' => 'Ak\Form\FormCallback::get_categories',
	),
	'section'     => 'post',
);

$fields[] = array(
	'heading'   => esc_html__( 'Show Breadcrumb?', 'newsy' ),
	'id'        => 'post_breadcrumb',
	'type'      => 'select',
	'selectize' => false,
	'options'   => array(
		''     => esc_html__( 'Default - From Theme Panel', 'newsy' ),
		'show' => esc_html__( 'Yes', 'newsy' ),
		'hide' => esc_html__( 'No', 'newsy' ),
	),
	'section'   => 'post',
);

$fields[] = array(
	'heading' => esc_html__( 'Show Categories?', 'newsy' ),
	'id'      => 'post_show_categories',
	'type'    => 'select',
	'options' => array(
		''     => esc_html__( 'Default - From Theme Panel', 'newsy' ),
		'show' => esc_html__( 'Yes', 'newsy' ),
		'hide' => esc_html__( 'No', 'newsy' ),
	),
	'section' => 'post',
);

$fields[] = array(
	'heading'   => esc_html__( 'Show Featured Image/Video?', 'newsy' ),
	'id'        => 'post_show_featured_image',
	'type'      => 'select',
	'selectize' => false,
	'options'   => array(
		''     => esc_html__( 'Default - From Theme Panel', 'newsy' ),
		'show' => esc_html__( 'Yes', 'newsy' ),
		'hide' => esc_html__( 'No', 'newsy' ),
	),
	'section'   => 'post',
);

$fields[] = array(
	'id'          => 'post_thumbnail_size',
	'type'        => 'select',
	'heading'     => esc_html__( 'Post Thumbnail Size', 'newsy' ),
	'description' => esc_html__( 'Choose image thumbnail size.', 'newsy' ),
	'options'     => array(
		''         => esc_html__( 'Default - From Theme Panel', 'newsy' ),
		'crop-500' => esc_html__( 'Crop 1/2 Dimension', 'newsy' ),
		'crop-715' => esc_html__( 'Crop Wide Height Dimension', 'newsy' ),
		'no-crop'  => esc_html__( 'No Crop (Auto Height)', 'newsy' ),
	),
	'selectize'   => false,
	'section'     => 'post',
	'dependency'  => array(
		'element' => 'post_show_featured_image',
		'value'   => array( '', 'show' ),
	),
);
$fields[] = array(
	'heading'     => esc_html__( 'Post Featured Image Credit', 'newsy' ),
	'description' => esc_html__( 'By default, the attachment caption field will be used. With this field you can change the image caption for this post.', 'newsy' ),
	'id'          => 'post_featured_image_credit',
	'type'        => 'text',
	'section'     => 'post',
	'dependency'  => array(
		'element' => 'post_show_featured_image',
		'value'   => array( '', 'show' ),
	),
);

$fields[] = array(
	'heading'   => esc_html__( 'Show Excerpt?', 'newsy' ),
	'id'        => 'post_show_excerpt',
	'type'      => 'select',
	'selectize' => false,
	'options'   => array(
		''     => esc_html__( 'Default - From Theme Panel', 'newsy' ),
		'show' => esc_html__( 'Yes', 'newsy' ),
		'hide' => esc_html__( 'No', 'newsy' ),
	),
	'section'   => 'post',
);
$fields[] = array(
	'heading'   => esc_html__( 'Show Tags?', 'newsy' ),
	'id'        => 'post_show_tags',
	'type'      => 'select',
	'selectize' => false,
	'options'   => array(
		''     => esc_html__( 'Default - From Theme Panel', 'newsy' ),
		'show' => esc_html__( 'Yes', 'newsy' ),
		'hide' => esc_html__( 'No', 'newsy' ),
	),
	'section'   => 'post',
);
$fields[] = array(
	'heading'   => esc_html__( 'Show Next/Prev Post Links?', 'newsy' ),
	'id'        => 'post_show_next_prev',
	'type'      => 'select',
	'selectize' => false,
	'options'   => array(
		''     => esc_html__( 'Default - From Theme Panel', 'newsy' ),
		'show' => esc_html__( 'Yes', 'newsy' ),
		'hide' => esc_html__( 'No', 'newsy' ),
	),
	'section'   => 'post',
);
$fields[] = array(
	'heading'   => esc_html__( 'Show Author Box?', 'newsy' ),
	'id'        => 'post_show_author_box',
	'type'      => 'select',
	'selectize' => false,
	'options'   => array(
		''     => esc_html__( 'Default - From Theme Panel', 'newsy' ),
		'show' => esc_html__( 'Yes', 'newsy' ),
		'hide' => esc_html__( 'No', 'newsy' ),
	),
	'section'   => 'post',
);
$fields[] = array(
	'heading'   => esc_html__( 'Related Posts Type', 'newsy' ),
	'id'        => 'post_related_type',
	'type'      => 'select',
	'selectize' => false,
	'options'   => array(
		''         => esc_html__( 'Default - From Theme Panel', 'newsy' ),
		'category' => esc_html__( 'Related Posts by Category', 'newsy' ),
		'post_tag' => esc_html__( 'Related Posts by Tag', 'newsy' ),
		'hide'     => esc_html__( 'Hide Related Posts', 'newsy' ),
	),
	'section'   => 'post',
);
$fields[] = array(
	'id'          => 'post_meta',
	'type'        => 'select',
	'selectize'   => false,
	'heading'     => esc_html__( 'Post Meta Type', 'newsy' ),
	'description' => esc_html__( 'Select a meta style type.', 'newsy' ),
	'section'     => 'post',
	'options'     => array(
		''        => esc_html__( 'Default - From Theme Panel', 'newsy' ),
		'style-1' => sprintf( esc_html__( 'Style %s', 'newsy' ), '1' ),
		'style-2' => sprintf( esc_html__( 'Style %s', 'newsy' ), '2' ),
		'style-3' => sprintf( esc_html__( 'Style %s', 'newsy' ), '3' ),
		'hide'    => esc_html__( 'Hide', 'newsy' ),
	),
);
$fields[] = array(
	'id'          => 'post_social_share_style',
	'type'        => 'select',
	'selectize'   => false,
	'heading'     => esc_html__( 'Social Icons Type', 'newsy' ),
	'description' => esc_html__( 'Set which social icons style that you want to use.', 'newsy' ),
	'section'     => 'post',
	'options'     => array(
		''        => esc_html__( 'Default - From Theme Panel', 'newsy' ),
		'style-1' => sprintf( esc_html__( 'Style %s', 'newsy' ), '1' ),
		'style-2' => sprintf( esc_html__( 'Style %s', 'newsy' ), '2' ),
		'style-3' => sprintf( esc_html__( 'Style %s', 'newsy' ), '3' ),
		'style-4' => sprintf( esc_html__( 'Style %s', 'newsy' ), '4' ),
		'style-5' => sprintf( esc_html__( 'Style %s', 'newsy' ), '5' ),
		'style-6' => sprintf( esc_html__( 'Style %s', 'newsy' ), '6' ),
	),
);

// Layout Settings
$fields[] = array(
	'heading' => esc_html__( 'Layout', 'newsy' ),
	'id'      => 'others',
	'type'    => 'section',
	'icon'    => 'fa-gears',
);

$fields = array_merge( $fields, newsy_get_layout_fields( 'post', 'others', 'body.single-post' ) );

$fields[] = array(
	'heading'     => esc_html__( 'Main Navigation Menu', 'newsy' ),
	'description' => esc_html__( 'Replace & change main menu for this page.', 'newsy' ),
	'id'          => 'post_main_nav_menu',
	'type'        => 'select',
	'options'     => array(
		''                 => esc_html__( '-- Default Main Navigation --', 'newsy' ),
		'options_callback' => 'Ak\Form\FormCallback::get_menus',
	),
	'section'     => 'others',
);

$ads      = newsy_get_supported_ad_options();
$fields[] = array(
	'heading' => esc_html__( 'Ads', 'newsy' ),
	'id'      => 'ads',
	'type'    => 'section',
	'icon'    => 'fa-money',
);
$fields[] = array(
	'id'          => 'enable_ad_override',
	'type'        => 'switcher',
	'heading'     => esc_html__( 'Enable Override', 'newsy' ),
	'description' => esc_html__( 'Here you can enable override of ad places for this post.', 'newsy' ),
	'options'     => array(
		'off' => '',
		'on'  => 'on',
	),
	'section'     => 'ads',
);
foreach ( $ads as $ad_id => $ad ) {
	if ( substr( $ad_id, 0, 11 ) !== 'single_post' ) {
		continue;
	}
	$fields = array_merge( $fields, newsy_get_ad_group_fields( $ad_id, $ad ) );
}
