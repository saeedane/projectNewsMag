<?php
$fields[] = array(
	'heading' => esc_html__( 'Post: Template ', 'newsy' ),
	'id'      => 'post_template_group_start',
	'type'    => 'group_start',
	'state'   => 'open',
	'section' => 'post',
);
$fields[] = array(
	'heading'          => esc_html__( 'Single post template', 'newsy' ),
	'description'      => esc_html__( 'Select default template for single posts. This option can be overridden on all posts.', 'newsy' ),
	'id'               => 'post_template',
	'type'             => 'radio_image',
	'options_callback' => 'newsy_get_single_template_options',
	'section'          => 'post',
);

$fields[] = array(
	'heading' => esc_html__( 'Show Breadcrumb?', 'newsy' ),
	'id'      => 'post_show_breadcrumb',
	'type'    => 'switcher',
	'options' => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section' => 'post',
);

$fields[] = array(
	'heading' => esc_html__( 'Show Categories?', 'newsy' ),
	'id'      => 'post_show_categories',
	'type'    => 'switcher',
	'options' => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section' => 'post',
);

$fields[] = array(
	'heading' => esc_html__( 'Show Featured Image/Video?', 'newsy' ),
	'id'      => 'post_show_featured_image',
	'type'    => 'switcher',
	'options' => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section' => 'post',
);
$fields[] = array(
	'id'          => 'post_thumbnail_size',
	'type'        => 'visual_select',
	'heading'     => esc_html__( 'Post Thumbnail Size', 'newsy' ),
	'description' => esc_html__( 'Choose image thumbnail size.', 'newsy' ),
	'options'     => array(
		'crop-500' => esc_html__( 'Crop 1/2 Dimension', 'newsy' ),
		'crop-715' => esc_html__( 'Crop Wide Height Dimension', 'newsy' ),
		'no-crop'  => esc_html__( 'No Crop (Auto Height)', 'newsy' ),
	),
	'default'     => 'crop-500',
	'section'     => 'post',
	'dependency'  => array(
		'element' => 'post_show_featured_image',
		'value'   => array( '' ),
	),
);

$fields[] = array(
	'heading' => esc_html__( 'Show Excerpt?', 'newsy' ),
	'id'      => 'post_show_excerpt',
	'type'    => 'switcher',
	'options' => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section' => 'post',
);
$fields[] = array(
	'heading' => esc_html__( 'Show Tags?', 'newsy' ),
	'id'      => 'post_show_tags',
	'type'    => 'switcher',
	'options' => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section' => 'post',
);
$fields[] = array(
	'heading' => esc_html__( 'Show Next/Prev Post Links?', 'newsy' ),
	'id'      => 'post_show_next_prev',
	'type'    => 'switcher',
	'options' => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section' => 'post',
);
$fields[] = array(
	'heading' => esc_html__( 'Show Author Box?', 'newsy' ),
	'id'      => 'post_show_author_box',
	'type'    => 'switcher',
	'options' => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section' => 'post',
);


$fields[] = array(
	'id'          => 'post_image_popup',
	'type'        => 'switcher',
	'heading'     => esc_html__( 'Post Image Popup Script', 'newsy' ),
	'description' => esc_html__( 'Turn on this option to use featured image with popup.', 'newsy' ),
	'options'     => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section'     => 'post',
);
$fields[] = array(
	'id'          => 'post_image_as_gallery',
	'type'        => 'switcher',
	'heading'     => esc_html__( 'Post Images as Gallery', 'newsy' ),
	'description' => esc_html__( 'Set images on a single post as one instance of gallery.', 'newsy' ),
	'options'     => array(
		'off' => 'hide',
		'on'  => '',
	),
	'dependency'  => array(
		'element' => 'post_image_popup',
		'value'   => array( '' ),
	),
	'section'     => 'post',
);
$fields[] = array(
	'heading'     => esc_html__( 'Post Video Sticky?', 'newsy' ),
	'id'          => 'post_featured_video_sticky',
	'description' => esc_html__( 'Enable floating video on the screen on scroll.', 'newsy' ),
	'type'        => 'switcher',
	'options'     => array(
		'off' => '',
		'on'  => 'yes',
	),
	'section'     => 'post',
);
$fields[] = array(
	'heading'     => esc_html__( 'Post Video Autoplay?', 'newsy' ),
	'id'          => 'post_featured_video_autoplay',
	'description' => esc_html__( 'Enable autoplay for video post format.', 'newsy' ),
	'type'        => 'switcher',
	'options'     => array(
		'off' => '',
		'on'  => 'yes',
	),
	'section'     => 'post',
);

$fields[] = array(
	'heading'          => esc_html__( 'Article Extra Classes', 'newsy' ),
	'description'      => esc_html__( 'Choose post wrapper classes. You can add your own classes or choose from predefined classes.', 'newsy' ),
	'id'               => 'post_article_classes',
	'type'             => 'text',
	'selectize'        => true,
	'delimiter'        => ' ',
	'options_callback' => 'newsy_get_supported_post_classes',
	'section'          => 'post',
);

$fields[] = array(
	'id'          => 'post_next_or_number',
	'type'        => 'visual_select',
	'heading'     => esc_html__( 'Post Pagination Style', 'newsy' ),
	'description' => esc_html__( 'Choose paginated posts style. You use next button or simple page numbers.', 'newsy' ),
	'options'     => array(
		'number'    => esc_html__( 'Numbers', 'newsy' ),
		'next_only' => esc_html__( 'Only Next Button', 'newsy' ),
		'next'      => esc_html__( 'Next & Prev Button', 'newsy' ),
	),
	'default'     => 'number',
	'section'     => 'post',
);

$fields[] = array(
	'heading' => esc_html__( 'Post: Sticky Header', 'newsy' ),
	'id'      => 'post_sticky_group_start',
	'type'    => 'group_start',
	'section' => 'post',
);
$fields[] = array(
	'id'          => 'post_sticky_enabled',
	'type'        => 'switcher',
	'heading'     => esc_html__( 'Post Sticky Enabled?', 'newsy' ),
	'description' => esc_html__( 'Enable or disable  sticky bar for post pages.', 'newsy' ),
	'section'     => 'post',
	'options'     => array(
		'off' => '',
		'on'  => 'yes',
	),
);
$fields[] = array(
	'heading'         => esc_html__( 'Post Sticky Custom Template', 'newsy' ),
	'id'              => 'builder_post_sticky_part_builder',
	'type'            => 'part_builder',
	'container_class' => 'control-heading-hide',
	'section'         => 'post',
	'dependency'      => array(
		'element' => 'post_sticky_enabled',
		'value'   => array( 'yes' ),
	),
);

$fields[] = array(
	'id'                => 'builder_post_sticky',
	'type'              => 'mix_fields',
	'heading'           => esc_html__( 'Post Sticky Parts', 'newsy' ),
	'container_class'   => 'hidden',
	'fields'            => Newsy\Support\PartBuilderData::get_post_sticky_fields(),
	'default'           => Newsy\Support\PartBuilderData::builder_post_sticky_defaults(),
	'filter_default'    => false,
	'defaults_on_empty' => true,
	'section'           => 'post',
);

$fields[] = array(
	'heading'    => esc_html__( 'Post Sticky Bar Style', 'newsy' ),
	'id'         => 'post_sticky-style_heading',
	'type'       => 'heading',
	'section'    => 'post',
	'dependency' => array(
		'element' => 'post_sticky_enabled',
		'value'   => array( 'yes' ),
	),
);

$fields[] = array(
	'id'          => 'post_sticky_bar_style',
	'type'        => 'css_editor',
	'heading'     => esc_html__( 'Row Style', 'newsy' ),
	'description' => esc_html__( 'Base typography for body that will affect all elements that haven\'t specified typography style.', 'newsy' ),
	'section'     => 'post',
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => array(
				'.ak-post-sticky-wrap .ak-post-sticky-bar.full-width',
				'.ak-post-sticky-wrap .ak-post-sticky-bar.boxed .ak-bar-inner',
			),
			'property' => 'css-editor',
		),
	),
	'dependency'  => array(
		'element' => 'post_sticky_enabled',
		'value'   => array( 'yes' ),
	),
);
$fields[] = array(
	'id'         => 'post_sticky_height',
	'type'       => 'slider',
	'heading'    => esc_html__( 'Row Height', 'newsy' ),
	'section'    => 'post',
	'default'    => 60,
	'min'        => 20,
	'max'        => 300,
	'step'       => 1,
	'unit'       => 'px',
	'output'     => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-post-sticky-wrap .ak-post-sticky-bar',
			'property' => 'height',
			'units'    => 'px',
		),
		array(
			'type'     => 'css',
			'element'  => '.ak-post-sticky-wrap .ak-post-sticky-title',
			'property' => 'line-height',
			'units'    => 'px',
		),
	),
	'dependency' => array(
		'element' => 'post_sticky_enabled',
		'value'   => array( 'yes' ),
	),
);
$fields[] = array(
	'id'         => 'post_sticky_progress_color',
	'type'       => 'color',
	'heading'    => esc_html__( 'Post Progress Bar Color', 'newsy' ),
	'section'    => 'post',
	'output'     => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-post-sticky-wrap .ak-post-progress-bar .progress-bar',
			'property' => 'background-color',
		),
	),
	'dependency' => array(
		'element' => 'post_sticky_enabled',
		'value'   => array( 'yes' ),
	),
);

$fields[] = array(
	'heading' => esc_html__( 'Post: Layout', 'newsy' ),
	'id'      => 'post_layout_group_start',
	'type'    => 'group_start',
	'section' => 'post',
);

$fields = array_merge( $fields, newsy_get_layout_fields( 'post', 'post', 'body.single-post' ) );


$fields[] = array(
	'heading' => esc_html__( 'Post: Meta', 'newsy' ),
	'id'      => 'post_meta_group_start',
	'type'    => 'group_start',
	'section' => 'post',
);
$fields[] = array(
	'id'          => 'post_meta',
	'type'        => 'visual_select',
	'heading'     => esc_html__( 'Post Meta Type', 'newsy' ),
	'description' => esc_html__( 'Select a meta style type.', 'newsy' ),
	'section'     => 'post',
	'default'     => 'style-1',
	'options'     => array(
		'style-1' => sprintf( esc_html__( 'Style %s', 'newsy' ), '1' ),
		'style-2' => sprintf( esc_html__( 'Style %s', 'newsy' ), '2' ),
		'style-3' => sprintf( esc_html__( 'Style %s', 'newsy' ), '3' ),
		'hide'    => esc_html__( 'Hide', 'newsy' ),
	),
);
$fields[] = array(
	'heading'    => esc_html__( 'Show Post Author?', 'newsy' ),
	'id'         => 'post_show_meta_author',
	'type'       => 'switcher',
	'options'    => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section'    => 'post',
	'dependency' => array(
		'element' => 'post_meta',
		'value'   => array( 'style-1', 'style-2', 'style-3' ),
	),
);
$fields[] = array(
	'heading'    => esc_html__( 'Show Post Author Avatar?', 'newsy' ),
	'id'         => 'post_show_meta_author_avatar',
	'type'       => 'switcher',
	'options'    => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section'    => 'post',
	'dependency' => array(
		'element' => 'post_meta',
		'value'   => array( 'style-1', 'style-2', 'style-3' ),
	),
);
$fields[] = array(
	'heading'    => esc_html__( 'Show Post Date?', 'newsy' ),
	'id'         => 'post_show_meta_date',
	'type'       => 'switcher',
	'options'    => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section'    => 'post',
	'dependency' => array(
		'element' => 'post_meta',
		'value'   => array( 'style-1', 'style-2', 'style-3' ),
	),
);
$fields[] = array(
	'heading'    => esc_html__( 'Post Date Format?', 'newsy' ),
	'id'         => 'post_show_meta_date_format',
	'type'       => 'select',
	'options'    => array(
		''       => esc_html__( 'Default', 'newsy' ),
		'ago'    => esc_html__( 'Ago', 'newsy' ),
		'custom' => esc_html__( 'Custom Format', 'newsy' ),
	),
	'section'    => 'post',
	'dependency' => array(
		'element' => 'post_show_meta_date',
		'value'   => array( '' ),
	),
);
$fields[] = array(
	'heading'     => esc_html__( 'Post Date Custom Format?', 'newsy' ),
	'id'          => 'post_show_meta_date_format_custom',
	'type'        => 'text',
	'input_attrs' => array(
		'placeholder' => get_option( 'date_format' ),
	),
	'section'     => 'post',
	'dependency'  => array(
		'element' => 'post_show_meta_date_format',
		'value'   => array( 'custom' ),
	),
);
$fields[] = array(
	'heading'    => esc_html__( 'Show Post Comment Count?', 'newsy' ),
	'id'         => 'post_show_meta_comments',
	'type'       => 'switcher',
	'options'    => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section'    => 'post',
	'dependency' => array(
		'element' => 'post_meta',
		'value'   => array( 'style-1', 'style-2', 'style-3' ),
	),
);
$fields[] = array(
	'heading'    => esc_html__( 'Show Post View Count?', 'newsy' ),
	'id'         => 'post_show_meta_views',
	'type'       => 'switcher',
	'options'    => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section'    => 'post',
	'dependency' => array(
		'element' => 'post_meta',
		'value'   => array( 'style-1', 'style-2', 'style-3' ),
	),
);

$fields[] = array(
	'heading' => esc_html__( 'Post: Autoload', 'newsy' ),
	'id'      => 'post_autoload_group_start',
	'type'    => 'group_start',
	'section' => 'post',
);
$fields[] = array(
	'heading'     => esc_html__( 'Post Autoload', 'newsy' ),
	'description' => esc_html__( 'Enabling this will enable next post autoload.', 'newsy' ),
	'id'          => 'post_autoload',
	'type'        => 'switcher',
	'options'     => array(
		'off' => '',
		'on'  => 'enabled',
	),
	'section'     => 'post',
);
$fields[] = array(
	'id'          => 'post_autoload_inline',
	'type'        => 'switcher',
	'heading'     => esc_html__( 'Post Autoload Inline', 'newsy' ),
	'description' => esc_html__( 'Enabling this will use inline post autoload. This Option is only available for Post Template 1-2-3-4.', 'newsy' ),
	'options'     => array(
		'off' => '',
		'on'  => 'enabled',
	),
	'section'     => 'post',
	'dependency'  => array(
		'element' => 'post_autoload',
		'value'   => array( 'enabled' ),
	),
);

$fields[] = array(
	'id'          => 'post_autoload_content',
	'type'        => 'select',
	'heading'     => esc_html__( 'Autoload Content Filter', 'newsy' ),
	'description' => esc_html__( 'Choose which the most relevant content will autoload after current post.', 'newsy' ),
	'options'     => array(
		''         => esc_html__( 'By Sequence', 'newsy' ),
		'category' => esc_html__( 'By Category', 'newsy' ),
		'tag'      => esc_html__( 'By Tag', 'newsy' ),
	),
	'section'     => 'post',
	'dependency'  => array(
		'element' => 'post_autoload',
		'value'   => array( 'enabled' ),
	),
);


$fields[] = array(
	'heading' => esc_html__( 'Post: Share', 'newsy' ),
	'id'      => 'post_share_group_start',
	'type'    => 'group_start',
	'section' => 'post',
);
if ( ! defined( 'NEWSY_SOCIAL_SHARE_PATH' ) ) {
	$fields[] = newsy_get_plugin_required_info_field( 'Newsy Social Share', 'post' );
} else {
	$fields[] = array(
		'heading'          => esc_html__( 'Social Sites', 'newsy' ),
		'description'      => esc_html__( 'Select active social share links and sort them. For Facebook share counts, a valid Facebook App must be added in Advanced > Facebook App.', 'newsy' ),
		'id'               => 'post_social_share_sites',
		'type'             => 'visual_checkbox',
		'options_callback' => 'newsy_get_share_options',
		'sorter'           => true,
		'section'          => 'post',
	);

	$fields[] = array(
		'id'          => 'post_social_share_show_count',
		'type'        => 'slider',
		'heading'     => esc_html__( 'Social Share Threshold', 'newsy' ),
		'description' => esc_html__( 'Set the number of social share threshold. The total number of social share will be shown if it reaches more than this threshold.', 'newsy' ),
		'section'     => 'post',
		'default'     => 3,
		'min'         => 1,
		'max'         => 10,
		'step'        => 1,
		'unit'        => 'items',
	);
	$fields[] = array(
		'id'          => 'post_social_share_style',
		'type'        => 'visual_select',
		'heading'     => esc_html__( 'Social Icons Type', 'newsy' ),
		'description' => esc_html__( 'Set which social icons style that you want to use.', 'newsy' ),
		'section'     => 'post',
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
		'id'          => 'post_social_share_count',
		'type'        => 'visual_select',
		'default'     => 'each',
		'options'     => array(
			'each'       => esc_html__( 'Show only each site count', 'newsy' ),
			'total'      => esc_html__( 'Show only total count', 'newsy' ),
			'total-each' => esc_html__( 'Show total share count and each site count', 'newsy' ),
			'hide'       => esc_html__( 'No share count', 'newsy' ),
		),
		'section'     => 'post',
	);
	$fields[] = array(
		'heading'     => esc_html__( 'Show Top Share Buttons', 'newsy' ),
		'description' => esc_html__( 'Enabling this will adds share links in top of single post.', 'newsy' ),
		'id'          => 'post_social_share_top',
		'type'        => 'switcher',
		'options'     => array(
			'off' => 'hide',
			'on'  => '',
		),
		'section'     => 'post',
	);
	$fields[] = array(
		'heading'     => esc_html__( 'Show Bottom Share Buttons', 'newsy' ),
		'description' => esc_html__( 'Enabling this will adds share links in in bottom of single post', 'newsy' ),
		'id'          => 'post_social_share_bottom',
		'type'        => 'switcher',
		'options'     => array(
			'off' => 'hide',
			'on'  => '',
		),
		'section'     => 'post',
	);
	$fields[] = array(
		'heading'     => esc_html__( 'Share Count Check Interval Time', 'newsy' ),
		'description' => esc_html__( 'Here you can set the check interval time for share counts from providers. Default is 60 mins.', 'newsy' ),
		'id'          => 'share_cache_expired',
		'type'        => 'number',
		'default'     => '60',
		'section'     => 'post',
	);
}

$fields[] = array(
	'heading' => esc_html__( 'Post: Voting', 'newsy' ),
	'id'      => 'post_voting_group_start',
	'type'    => 'group_start',
	'section' => 'post',
);
if ( ! defined( 'NEWSY_VOTING_PATH' ) ) {
	$fields[] = newsy_get_plugin_required_info_field( 'Newsy Voting', 'post' );
} else {
	$fields[] = array(
		'id'          => 'post_voting_position',
		'type'        => 'visual_select',
		'heading'     => esc_html__( 'Post Voting Position', 'newsy' ),
		'description' => esc_html__( 'Choose position of voting buttons on the single post.', 'newsy' ),
		'options'     => array(
			'meta_left'   => esc_html__( 'Post Meta Left', 'newsy' ),
			'meta_right'  => esc_html__( 'Post Meta Right', 'newsy' ),
			'share_right' => esc_html__( 'Post Share Right', 'newsy' ),
		),
		'default'     => 'meta_left',
		'section'     => 'post',
	);
	$fields[] = array(
		'id'          => 'post_voting_count_type',
		'type'        => 'visual_select',
		'heading'     => esc_html__( 'Post Voting Count Show Type', 'newsy' ),
		'description' => esc_html__( 'Choose counts reveal type for voting.', 'newsy' ),
		'options'     => array(
			'total'       => esc_html__( 'Show Only Avarage Count', 'newsy' ),
			'items_count' => esc_html__( 'Show Only Items Count', 'newsy' ),
		),
		'default'     => 'total',
		'section'     => 'post',
	);

	$fields[] = array(
		'id'          => 'post_voting_single',
		'type'        => 'switcher',
		'heading'     => esc_html__( 'Show Only Up/Like Voting Button ', 'newsy' ),
		'description' => esc_html__( 'Choose if you only want to show up/like button.', 'newsy' ),
		'options'     => array(
			'off' => '',
			'on'  => 'yes',
		),
		'section'     => 'post',
	);

	$fields[] = array(
		'heading' => esc_html__( 'Up/Like Voting Icon', 'newsy' ),
		'type'    => 'icon_select',
		'id'      => 'post_voting_up_icon',
		'default' => 'fa-thumbs-o-up',
		'section' => 'post',
	);

	$fields[] = array(
		'heading'    => esc_html__( 'Down/Dislike Voting Icon', 'newsy' ),
		'type'       => 'icon_select',
		'id'         => 'post_voting_down_icon',
		'default'    => 'fa-thumbs-o-down',
		'section'    => 'post',
		'dependency' => array(
			'element' => 'post_voting_single',
			'value'   => array( '' ),
		),
	);
	$fields[] = array(
		'id'          => 'post_voting_guest_is_enabled',
		'type'        => 'switcher',
		'heading'     => esc_html__( 'Guest voting is enabled?', 'newsy' ),
		'description' => esc_html__( 'Enabling this will activate guest post voting.', 'newsy' ),
		'options'     => array(
			'off' => '',
			'on'  => 'yes',
		),
		'section'     => 'post',
	);
}

$fields[] = array(
	'heading' => esc_html__( 'Post: View Counter', 'newsy' ),
	'id'      => 'post_view_group_start',
	'type'    => 'group_start',
	'section' => 'post',
);
if ( ! defined( 'NEWSY_VIEW_COUNTER_PATH' ) ) {
	$fields[] = newsy_get_plugin_required_info_field( 'Newsy View Counter', 'post' );
} else {
	$fields[] = array(
		'id'          => 'enable_weekly_views',
		'type'        => 'switcher',
		'heading'     => esc_html__( 'Enable 7 days Views?', 'newsy' ),
		'description' => esc_html__( 'This allows weekly most liked posts on post blocks filter tab.', 'newsy' ),
		'options'     => array(
			'off' => 'disable',
			'on'  => '',
		),
		'section'     => 'post',
	);
	$fields[] = array(
		'heading'     => esc_html__( 'Custom View Count Icons', 'newsy' ),
		'description' => esc_html__( 'This allows you to select custom icons for view counts on the post meta.', 'newsy' ),
		'id'          => 'views_ranking',
		'type'        => 'repeater',
		'sorter'      => false,
		'fields'      => array(
			array(
				'heading'         => esc_html__( 'Views more than', 'newsy' ),
				'id'              => 'view',
				'type'            => 'number',
				'container_class' => 'control-heading-full',
				'field_col'       => 3,
			),
			array(
				'heading'         => esc_html__( 'Icon', 'newsy' ),
				'id'              => 'icon',
				'type'            => 'icon_select',
				'container_class' => 'control-heading-full',
				'field_col'       => 3,
			),
			array(
				'heading'         => esc_html__( 'Color', 'newsy' ),
				'id'              => 'color',
				'type'            => 'color',
				'container_class' => 'control-heading-full',
				'field_col'       => 3,
			),
		),
		'section'     => 'post',
	);
}

$fields[] = array(
	'heading' => esc_html__( 'Post: Newsletter Box', 'newsy' ),
	'id'      => 'post_newsletter_form_group_start',
	'type'    => 'group_start',
	'section' => 'post',
);
if ( ! defined( 'NEWSY_ELEMENTS_PATH' ) ) {
	$fields[] = newsy_get_plugin_required_info_field( 'Newsy Elements', 'post' );
} else {
	$fields[] = array(
		'heading' => esc_html__( 'Show Newsletter?', 'newsy' ),
		'id'      => 'post_show_newsletter',
		'type'    => 'switcher',
		'options' => array(
			'off' => '',
			'on'  => 'show',
		),
		'section' => 'post',
	);
	$fields[] = array(
		'heading'         => esc_html__( 'Post: Newsletter Box', 'newsy' ),
		'id'              => 'post_newsletter',
		'type'            => 'mix_fields',
		'container_class' => 'control-heading-hide',
		'fields_callback' => 'NewsyElements\Shortcode\Element\Mailchimp::block_newsletter_options',
		'section'         => 'post',
		'dependency'      => array(
			'element' => 'post_show_newsletter',
			'value'   => array( 'show' ),
		),
	);
	$fields[] = array(
		'id'          => 'post_newsletter_block_style',
		'type'        => 'css_editor',
		'heading'     => esc_html__( 'Block Style', 'newsy' ),
		'description' => esc_html__( 'Here you can add additional style for newsletter box', 'newsy' ),
		'section'     => 'post',
		'output'      => array(
			array(
				'type'     => 'css',
				'element'  => array(
					'.ak-post-wrap .content-column .ak-block-newsletter',
				),
				'property' => 'css-editor',
			),
		),
		'dependency'  => array(
			'element' => 'post_show_newsletter',
			'value'   => array( 'show' ),
		),
	);
}

$fields[] = array(
	'heading' => esc_html__( 'Post: Reaction Box', 'newsy' ),
	'id'      => 'post_reaction_box_group_start',
	'type'    => 'group_start',
	'section' => 'post',
);
if ( ! defined( 'NEWSY_REACTION_PATH' ) ) {
	$fields[] = newsy_get_plugin_required_info_field( 'Newsy Reaction', 'post' );
} else {
	$fields[] = array(
		'id'      => 'post_show_reaction_box',
		'type'    => 'switcher',
		'heading' => esc_html__( 'Show Reaction Voting Box', 'newsy' ),
		'options' => array(
			'off' => 'hide',
			'on'  => '',
		),
		'section' => 'post',
	);
	$fields[] = array(
		'id'               => 'post_reaction_box_block_header_style',
		'type'             => 'radio_image',
		'heading'          => esc_html__( 'Block Header Style', 'newsy' ),
		'description'      => esc_html__( 'Default block header style.', 'newsy' ),
		'options_callback' => array(
			'function' => 'newsy_get_block_header_styles',
			'args'     => array( true ),
		),
		'section'          => 'post',
	);
	$fields[] = array(
		'heading'          => esc_html__( 'Block Extra Classes', 'newsy' ),
		'description'      => esc_html__( 'Override category loop.', 'newsy' ),
		'id'               => 'post_reaction_box_block_classes',
		'type'             => 'text',
		'selectize'        => true,
		'delimiter'        => ' ',
		'options_callback' => 'newsy_get_block_supported_classes',
		'section'          => 'post',
	);
}
$fields[] = array(
	'heading' => esc_html__( 'Post: Related Posts', 'newsy' ),
	'id'      => 'post_related_post_group_start',
	'type'    => 'group_start',
	'section' => 'post',
);


$fields[] = array(
	'heading'     => esc_html__( 'Related Posts Type', 'newsy' ),
	'description' => esc_html__( 'Choose which the most relevant content will be shown.', 'newsy' ),
	'id'          => 'post_related_type',
	'type'        => 'visual_select',
	'default'     => 'category',
	'options'     => array(
		'category' => esc_html__( 'Related Posts by Category', 'newsy' ),
		'post_tag' => esc_html__( 'Related Posts by Tag', 'newsy' ),
		'hide'     => esc_html__( 'Hide Related Posts', 'newsy' ),
	),
	'section'     => 'post',
);

$fields[] = array(
	'heading'     => esc_html__( 'Related Posts Position', 'newsy' ),
	'description' => esc_html__( 'Choose where the content will be shown.', 'newsy' ),
	'id'          => 'post_related_position',
	'type'        => 'visual_select',
	'options'     => array(
		''    => esc_html__( 'Article bottom', 'newsy' ),
		'end' => esc_html__( 'Page bottom (Full width)', 'newsy' ),
	),
	'section'     => 'post',
);

$fields[] = array(
	'type'             => 'select',
	'heading'          => esc_html__( 'Related Posts Order By', 'newsy' ),
	'id'               => 'post_related_loop_order_by',
	'options_callback' => 'newsy_get_block_order_by_options',
	'default'          => 'popular_week',
	'section'          => 'post',
);

$fields = array_merge( $fields, newsy_get_list_fields( 'post_related', 'post' ) );

$fields[] = array(
	'id'               => 'post_related_block_header_style',
	'type'             => 'radio_image',
	'heading'          => esc_html__( 'Block Header Style', 'newsy' ),
	'description'      => esc_html__( 'Default block header style.', 'newsy' ),
	'options_callback' => array(
		'function' => 'newsy_get_block_header_styles',
		'args'     => array( true ),
	),
	'section'          => 'post',
);

$fields[] = array(
	'heading' => esc_html__( 'Post: Comments', 'newsy' ),
	'id'      => 'post_comment_form_group_start',
	'type'    => 'group_start',
	'section' => 'post',
);
$fields[] = array(
	'id'      => 'post_show_comments',
	'type'    => 'switcher',
	'heading' => esc_html__( 'Show Comments', 'newsy' ),
	'options' => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section' => 'post',
);
$fields[] = array(
	'heading'          => esc_html__( 'Comments Tabs', 'newsy' ),
	'description'      => esc_html__( 'Select to show or hide comments in bottom of post content. Select multiple types to show as tab. You can order comments types.', 'newsy' ),
	'id'               => 'post_comments',
	'type'             => 'visual_checkbox',
	'default'          => 'wp',
	'options_callback' => 'newsy_get_suppored_comment_options',
	'sorter'           => true,
	'section'          => 'post',
);

$fields[] = array(
	'heading'     => esc_html__( 'Comments Load Type', 'newsy' ),
	'description' => esc_html__( 'Select comments load type in the post content.', 'newsy' ),
	'id'          => 'post_comments_load_type',
	'type'        => 'visual_select',
	'options'     => array(
		''       => esc_html__( 'Normal Load', 'newsy' ),
		'button' => esc_html__( 'Ajax Load Button', 'newsy' ),
	),
	'section'     => 'post',
);

$fields[] = array(
	'heading'    => esc_html__( 'WordPress Comments', 'newsy' ),
	'id'         => 'post_comment_wp_heading',
	'type'       => 'heading',
	'section'    => 'post',
	'dependency' => array(
		'element'  => 'post_comments',
		'value'    => 'wp',
		'operator' => 'contains',
	),
);

$fields[] = array(
	'heading'     => esc_html__( 'Remove URL Field from WP Comment Form', 'newsy' ),
	'description' => esc_html__( 'With enabling this URL will removed from comments form.', 'newsy' ),
	'id'          => 'post_comments_form_remove_url',
	'type'        => 'switcher',
	'options'     => array(
		'off' => '',
		'on'  => 'yes',
	),
	'section'     => 'post',
	'dependency'  => array(
		'element'  => 'post_comments',
		'value'    => 'wp',
		'operator' => 'contains',
	),
);

$fields[] = array(
	'heading'    => esc_html__( 'Facebook Comments', 'newsy' ),
	'id'         => 'post_comment_facebook_heading',
	'type'       => 'heading',
	'section'    => 'post',
	'dependency' => array(
		'element'  => 'post_comments',
		'value'    => 'facebook',
		'operator' => 'contains',
	),
);

$fields[] = array(
	'heading'     => esc_html__( 'Facebook Comment App ID', 'newsy' ),
	'description' => esc_html__( 'Insert your Facebook App id. Please note, this option will appear and work if you choose Facebook Comment on Comment Tabs option on above.', 'newsy' ),
	'id'          => 'facebook_comment_appid',
	'type'        => 'text',
	'section'     => 'post',
	'dependency'  => array(
		'element'  => 'post_comments',
		'value'    => 'facebook',
		'operator' => 'contains',
	),
);

$fields[] = array(
	'heading'    => esc_html__( 'Disqus Comments', 'newsy' ),
	'id'         => 'post_comment_disqus_heading',
	'type'       => 'heading',
	'section'    => 'post',
	'dependency' => array(
		'element'  => 'post_comments',
		'value'    => 'disqus',
		'operator' => 'contains',
	),
);

$fields[] = array(
	'heading'     => esc_html__( 'Disqus Api Key', 'newsy' ),
	'description' => esc_html__( 'Insert your Disqus API key. Please note, this option will work if you choose Disqus Comment on Comment Tabs option on above.', 'newsy' ),
	'id'          => 'disqus_api_key',
	'type'        => 'text',
	'section'     => 'post',
	'dependency'  => array(
		'element'  => 'post_comments',
		'value'    => 'disqus',
		'operator' => 'contains',
	),
);

$fields[] = array(
	'heading'     => esc_html__( 'Disqus Comment Shortname', 'newsy' ),
	'description' => esc_html__( 'Insert your Disqus shortname. You can register your website and get Disqus shortname for your website here. Please note, this option will work if you choose Disqus Comment on Comment Tabs option on above.', 'newsy' ),
	'id'          => 'disqus_comment_shortname',
	'type'        => 'text',
	'section'     => 'post',
	'dependency'  => array(
		'element'  => 'post_comments',
		'value'    => 'disqus',
		'operator' => 'contains',
	),
);


$fields[] = array(
	'heading'    => esc_html__( 'easyComment Comments', 'newsy' ),
	'id'         => 'post_comment_easycomment_heading',
	'type'       => 'heading',
	'section'    => 'post',
	'dependency' => array(
		'element'  => 'post_comments',
		'value'    => 'easycomment',
		'operator' => 'contains',
	),
);

$fields[] = array(
	'heading'     => esc_html__( 'easyComment Comments', 'newsy' ),
	'description' => wp_kses(
		sprintf(
			__( '<a href="%s">easyComment</a> is a standalone php comment system like Facebook comments. You can use these options to easily use easyComment on your WordPress site. This additional feature requires easyComment installation. ', 'newsy' ),
			'https://codecanyon.net/item/easycomment-php-comment-script/12727003'
		), ak_trans_allowed_html()
	),
	'id'          => 'post_comment_easycomment_info',
	'type'        => 'info',
	'section'     => 'post',
	'dependency'  => array(
		'element'  => 'post_comments',
		'value'    => 'easycomment',
		'operator' => 'contains',
	),
);
$fields[] = array(
	'heading'     => esc_html__( 'easyComment Installation URL', 'newsy' ),
	'description' => esc_html__( 'Insert your easyComment installation URL. This address refers to the address where you installed the easyComment system. Examle: https://comments.youriste.com/public/', 'newsy' ),
	'id'          => 'easycomment_url',
	'type'        => 'text',
	'section'     => 'post',
	'dependency'  => array(
		'element'  => 'post_comments',
		'value'    => 'easycomment',
		'operator' => 'contains',
	),
);
$fields[] = array(
	'heading'     => esc_html__( 'easyComment Comments Title', 'newsy' ),
	'description' => esc_html__( 'Enter your easyComment comment section title. Leave empty for default.', 'newsy' ),
	'id'          => 'easycomment_title',
	'type'        => 'text',
	'section'     => 'post',
	'dependency'  => array(
		'element'  => 'post_comments',
		'value'    => 'easycomment',
		'operator' => 'contains',
	),
);

$fields[] = array(
	'heading' => esc_html__( 'Block Settings', 'newsy' ),
	'id'      => 'post_comment_block_settings_heading',
	'type'    => 'heading',
	'section' => 'post',
);
$fields[] = array(
	'id'               => 'post_comments_block_header_style',
	'type'             => 'radio_image',
	'heading'          => esc_html__( 'Block Header Style', 'newsy' ),
	'options_callback' => array(
		'function' => 'newsy_get_block_header_styles',
		'args'     => array( true ),
	),
	'section'          => 'post',
);
$fields[] = array(
	'heading'          => esc_html__( 'Block Extra Classes', 'newsy' ),
	'id'               => 'post_comments_block_classes',
	'type'             => 'text',
	'selectize'        => true,
	'delimiter'        => ' ',
	'options_callback' => 'newsy_get_block_supported_classes',
	'section'          => 'post',
);



