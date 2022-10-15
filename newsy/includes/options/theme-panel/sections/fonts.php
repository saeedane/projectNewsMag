<?php
//General Typography Settings

$fields[] = array(
	'heading' => esc_html__( 'General', 'newsy' ),
	'id'      => 'general_fonts_group_start',
	'type'    => 'group_start',
	'section' => 'fonts',
);

$fields[] = array(
	'id'          => 'typo_body_font',
	'type'        => 'typography',
	'heading'     => esc_html__( 'Site Base Typography (Body)', 'newsy' ),
	'description' => esc_html__( 'Base typography for body that will affect all elements that haven\'t specified typography style.', 'newsy' ),
	'section'     => 'fonts',
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => 'body',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'id'      => 'heading_typo_header',
	'type'    => 'heading',
	'heading' => esc_html__( 'Heading', 'newsy' ),
	'section' => 'fonts',
);

$fields[] = array(
	'id'      => 'typo_heading',
	'type'    => 'typography',
	'heading' => esc_html__( 'General Heading Typography', 'newsy' ),
	'section' => 'fonts',
	'options' => array(
		'size'        => false,
		'line-height' => false,
		'align'       => false,
	),
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => 'h1, .h1, h2,.h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'id'      => 'typo_heading_h1',
	'type'    => 'typography',
	'heading' => esc_html__( 'H1 Font Size', 'newsy' ),
	'section' => 'fonts',
	'options' => array(
		'family'         => false,
		'letter-spacing' => false,
		'align'          => false,
		'transform'      => false,
		'color'          => false,
	),
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => 'h1, .h1',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'id'      => 'typo_heading_h2',
	'type'    => 'typography',
	'heading' => esc_html__( 'H2 Font Size', 'newsy' ),
	'section' => 'fonts',
	'options' => array(
		'family'         => false,
		'letter-spacing' => false,
		'align'          => false,
		'transform'      => false,
		'color'          => false,
	),
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => 'h2, .h2',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'id'      => 'typo_heading_h3',
	'type'    => 'typography',
	'heading' => esc_html__( 'H3 Font Size', 'newsy' ),
	'section' => 'fonts',
	'options' => array(
		'family'         => false,
		'letter-spacing' => false,
		'align'          => false,
		'transform'      => false,
		'color'          => false,
	),
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => 'h3, .h3',
			'property' => 'typography',
		),
	),
);
$fields[] = array(
	'id'      => 'typo_heading_h4',
	'type'    => 'typography',
	'heading' => esc_html__( 'H4 Font Size', 'newsy' ),
	'section' => 'fonts',
	'options' => array(
		'family'         => false,
		'letter-spacing' => false,
		'align'          => false,
		'transform'      => false,
		'color'          => false,
	),
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => 'h4, .h4',
			'property' => 'typography',
		),
	),
);
$fields[] = array(
	'id'      => 'typo_heading_h5',
	'type'    => 'typography',
	'heading' => esc_html__( 'H5 Font Size', 'newsy' ),
	'section' => 'fonts',
	'options' => array(
		'family'         => false,
		'letter-spacing' => false,
		'align'          => false,
		'transform'      => false,
		'color'          => false,
	),
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => 'h5, .h5',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'id'      => 'typo_heading_h6',
	'type'    => 'typography',
	'heading' => esc_html__( 'H6 Font Size', 'newsy' ),
	'section' => 'fonts',
	'options' => array(
		'family'         => false,
		'letter-spacing' => false,
		'align'          => false,
		'transform'      => false,
		'color'          => false,
	),
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => 'h6, .h6',
			'property' => 'typography',
		),
	),
);


$fields[] = array(
	'id'      => 'breadcrumb_typo_header',
	'type'    => 'heading',
	'heading' => esc_html__( 'Breadcrumb', 'newsy' ),
	'section' => 'fonts',
);

$fields[] = array(
	'id'      => 'typo_breadcrumb',
	'type'    => 'typography',
	'heading' => esc_html__( 'Breadcrumb Items', 'newsy' ),
	'section' => 'fonts',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-breadcrumb li',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'id'      => 'main_menu_typ_group_start',
	'type'    => 'group_start',
	'heading' => esc_html__( 'Main Menu', 'newsy' ),
	'section' => 'fonts',
);

$fields[] = array(
	'id'      => 'typ_header_menu',
	'type'    => 'typography',
	'heading' => esc_html__( 'Main Menu Typography', 'newsy' ),
	'section' => 'fonts',
	'options' => array(
		'align' => false,
		'color' => false,
	),
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-header-main-menu > .ak-menu > li > a',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'id'      => 'header_sub_menu_header',
	'type'    => 'heading',
	'heading' => esc_html__( 'Submenu', 'newsy' ),
	'section' => 'fonts',
);

$fields[] = array(
	'id'      => 'typ_header_sub_menu',
	'type'    => 'typography',
	'heading' => esc_html__( 'Sub Menu Typography', 'newsy' ),
	'section' => 'fonts',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.sub-menu > li a',
			'property' => 'typography',
		),
	),
);


$fields[] = array(
	'id'      => 'top_menu_typ_group_start',
	'type'    => 'group_start',
	'heading' => esc_html__( 'Top Menu', 'newsy' ),
	'section' => 'fonts',
);

$fields[] = array(
	'heading' => esc_html__( 'Top Menu Typography', 'newsy' ),
	'id'      => 'typ_top_bar_menu',
	'type'    => 'typography',
	'section' => 'fonts',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-top-menu>li>a',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'heading' => esc_html__( 'Top Bar Menu Hover Text Color', 'newsy' ),
	'id'      => 'top_bar_menu_a_hover_color',
	'type'    => 'color',
	'section' => 'fonts',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-top-menu > li:hover > a',
			'property' => 'color',
		),
	),
);

$fields[] = array(
	'id'      => 'mobile_menu_typ_group_start',
	'type'    => 'group_start',
	'heading' => esc_html__( 'Mobile Menu', 'newsy' ),
	'section' => 'fonts',
);

$fields[] = array(
	'heading' => esc_html__( 'Mobile Menu Typography', 'newsy' ),
	'id'      => 'typo_mobile_bar_menu',
	'type'    => 'typography',
	'section' => 'fonts',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-mobile-menu>li>a',
			'property' => 'typography',
		),
	),
);

/**
 *  Footer Menu
**/
$fields[] = array(
	'heading' => esc_html__( 'Footer Menu', 'newsy' ),
	'id'      => 'footer_menu_typo_group_start',
	'type'    => 'group_start',
	'section' => 'fonts',
);

$fields[] = array(
	'id'      => 'footer_menu_typo',
	'type'    => 'typography',
	'heading' => esc_html__( 'Footer Menu Typography', 'newsy' ),
	'section' => 'fonts',
	'options' => array(
		'align' => false,
	),
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-footer-wrap .ak-footer-menu > li > a',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'id'      => 'footer_menu_a_hover_color',
	'type'    => 'color',
	'heading' => esc_html__( 'Footer Menu Hover Text Color', 'newsy' ),
	'section' => 'fonts',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-footer-wrap .ak-footer-menu > li:hover > a',
			'property' => 'color',
		),
	),
);

$fields[] = array(
	'id'      => 'footer_menu_a_hover_bg_color',
	'type'    => 'color',
	'heading' => esc_html__( 'Footer Menu Hover Background Color', 'newsy' ),
	'section' => 'fonts',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => array(
				'.ak-footer-wrap .ak-footer-menu > li:hover > a',
			),
			'property' => 'background-color',
		),
	),
);

$fields[] = array(
	'id'      => 'footer_menu_a_active_color',
	'type'    => 'color',
	'heading' => esc_html__( 'Footer Menu Active Text Color', 'newsy' ),
	'section' => 'fonts',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => array(
				'.ak-footer-wrap .ak-footer-menu > li.current-menu-item > a',
				'.ak-footer-wrap .ak-footer-menu > li.current-menu-item:hover > a',
				'.ak-footer-wrap .ak-footer-menu > li.current-menu-parent > a',
				'.ak-footer-wrap .ak-footer-menu > li.current-menu-parent:hover > a',
			),
			'property' => 'color',
		),
	),
);

$fields[] = array(
	'id'      => 'footer_menu_a_active_bg_color',
	'type'    => 'color',
	'heading' => esc_html__( 'Footer Menu Active Background Color', 'newsy' ),
	'section' => 'fonts',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => array(
				'.ak-footer-wrap .ak-footer-menu > li.current-menu-item > a',
			),
			'property' => 'background-color',
		),
	),
);

$fields[] = array(
	'id'      => 'custom_menu_typ_group_start',
	'type'    => 'group_start',
	'heading' => esc_html__( 'Custom Menus', 'newsy' ),
	'section' => 'fonts',
);

$fields[] = array(
	'heading' => esc_html__( 'Custom Menu 1 Typography', 'newsy' ),
	'id'      => 'typo_custom_menu1',
	'type'    => 'typography',
	'section' => 'fonts',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-header-custom-menu1>.ak-menu>li>a',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'heading' => esc_html__( 'Custom Menu 2 Typography', 'newsy' ),
	'id'      => 'typo_custom_menu2',
	'type'    => 'typography',
	'section' => 'fonts',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-header-custom-menu2>.ak-menu>li>a',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'heading' => esc_html__( 'Custom Menu 3 Typography', 'newsy' ),
	'id'      => 'typo_custom_menu3',
	'type'    => 'typography',
	'section' => 'fonts',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-header-custom-menu3>.ak-menu>li>a',
			'property' => 'typography',
		),
	),
);


$fields[] = array(
	'heading' => esc_html__( 'Archive', 'newsy' ),
	'id'      => 'archive_fonts_group_start',
	'type'    => 'group_start',
	'section' => 'fonts',
);

$fields[] = array(
	'heading' => esc_html__( 'Archive Name Typography', 'newsy' ),
	'id'      => 'archive_header_name',
	'type'    => 'typography',
	'section' => 'fonts',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-archive-header .ak-archive-name',
			'property' => 'typography',
		),
	),
);


/**
 * -> Post & Page Typography
 */

$fields[] = array(
	'heading' => esc_html__( 'Post', 'newsy' ),
	'id'      => 'posts_fonts_group_start',
	'type'    => 'group_start',
	'section' => 'fonts',
);

$fields[] = array(
	'heading'     => esc_html__( 'Post Title', 'newsy' ),
	'description' => esc_html__( 'Typography of post title in single post.', 'newsy' ),
	'id'          => 'typo_single_post_title',
	'type'        => 'typography',
	'section'     => 'fonts',
	'options'     => array(
		'align' => false,
	),
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-post-wrap .ak-post-title, body.page .ak-post-title',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'heading'     => esc_html__( 'Post Meta', 'newsy' ),
	'description' => esc_html__( 'Base typography for post meta in single post.', 'newsy' ),
	'id'          => 'typo_single_post_meta',
	'type'        => 'typography',
	'section'     => 'fonts',
	'options'     => array(
		'align' => false,
	),
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-post-meta',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'heading'     => esc_html__( 'Post Meta (Author Name)', 'newsy' ),
	'description' => esc_html__( 'Base typography for post author name  in single post.', 'newsy' ),
	'id'          => 'typo_single_post_meta_author',
	'type'        => 'typography',
	'section'     => 'fonts',
	'options'     => array(
		'align' => false,
	),
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-post-meta-author a, .ak-post-meta-author a:hover',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'heading'     => esc_html__( 'Post Summary', 'newsy' ),
	'description' => esc_html__( 'Base typography for post summary in single post.', 'newsy' ),
	'id'          => 'typo_single_post_summary',
	'type'        => 'typography',
	'section'     => 'fonts',
	'options'     => array(
		'align' => false,
	),
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-post-summary',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'heading'     => esc_html__( 'Post Content', 'newsy' ),
	'description' => esc_html__( 'Base typography for content of posts and static pages.', 'newsy' ),
	'id'          => 'typo_single_post_content',
	'type'        => 'typography',
	'section'     => 'fonts',
	'options'     => array(
		'align' => false,
	),
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-post-content',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'heading'     => esc_html__( 'Post Cover Block', 'newsy' ),
	'description' => esc_html__( 'Typography of post Gutenberg editor cover block.', 'newsy' ),
	'id'          => 'typo_single_post_block_cover',
	'type'        => 'typography',
	'section'     => 'fonts',
	'options'     => array(
		'align' => false,
	),
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-post-wrap .wp-block-cover p',
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'heading'     => esc_html__( 'Post Quote Block', 'newsy' ),
	'description' => esc_html__( 'Typography of post Gutenberg editor quote block.', 'newsy' ),
	'id'          => 'typo_single_post_block_quote',
	'type'        => 'typography',
	'section'     => 'fonts',
	'options'     => array(
		'align' => false,
	),
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => array(
				'.ak-post-wrap .wp-block-quote p',
				'.ak-post-wrap .wp-block-pullquote blockquote p',
			),
			'property' => 'typography',
		),
	),
);
$fields[] = array(
	'heading'     => esc_html__( 'Post Quote Block (Cite)', 'newsy' ),
	'description' => esc_html__( 'Typography of post Gutenberg editor quote block.', 'newsy' ),
	'id'          => 'typo_single_post_block_quote_cite',
	'type'        => 'typography',
	'section'     => 'fonts',
	'options'     => array(
		'align' => false,
	),
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => array(
				'.ak-post-wrap .wp-block-quote cite',
				'.ak-post-wrap .wp-block-pullquote blockquote cite',
			),
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'id'          => 'typo_single_post_pagination',
	'type'        => 'typography',
	'heading'     => esc_html__( 'Post Pagination Button', 'newsy' ),
	'description' => esc_html__( 'Base typography for paginated post buttons.', 'newsy' ),
	'section'     => 'fonts',
	'options'     => array(
		'align' => false,
		'color' => false,
	),
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => array(
				'.post-nav-links.post-nav-next_only .post-page-numbers',
				'.post-nav-links.post-nav-next .post-page-numbers',
			),
			'property' => 'typography',
		),
	),
);

/**
 * -> Block Typography
 */
$fields[] = array(
	'heading' => esc_html__( 'Block', 'newsy' ),
	'id'      => 'general_block_typo',
	'type'    => 'group_start',
	'section' => 'fonts',
);
$fields[] = array(
	'id'          => 'typo_general_block_header_title',
	'type'        => 'typography',
	'heading'     => esc_html__( 'Block Title', 'newsy' ),
	'description' => esc_html__( 'Base typography for content of block header titles.', 'newsy' ),
	'section'     => 'fonts',
	'options'     => array(
		'align' => false,
		'color' => false,
	),
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block-header .ak-block-title',
			'property' => 'typography',
		),
	),
);
$fields[] = array(
	'id'      => 'general_block_header_title_color',
	'type'    => 'color',
	'heading' => esc_html__( ' Block Title Color', 'newsy' ),
	'section' => 'fonts',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block-header',
			'property' => '--ak-block-title-text-color',
		),
	),
);

$fields[] = array(
	'id'          => 'typo_general_block_header_subtitle',
	'type'        => 'typography',
	'heading'     => esc_html__( 'Block Second Title', 'newsy' ),
	'description' => esc_html__( 'Base typography for content of block header titles.', 'newsy' ),
	'section'     => 'fonts',
	'options'     => array(
		'align' => false,
		'color' => false,
	),
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block-header .ak-block-title .subtitle-text',
			'property' => 'typography',
		),
	),
);
$fields[] = array(
	'id'      => 'general_block_header_subtitle_color',
	'type'    => 'color',
	'heading' => esc_html__( ' Block Second Title Color', 'newsy' ),
	'section' => 'fonts',
	'output'  => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block-header',
			'property' => '--ak-block-subtitle-text-color',
		),
	),
);
$fields[] = array(
	'id'          => 'typo_general_block_header_tabs',
	'type'        => 'typography',
	'heading'     => esc_html__( 'Block Tabs', 'newsy' ),
	'description' => esc_html__( 'Base typography for content of block header tabs.', 'newsy' ),
	'section'     => 'fonts',
	'options'     => array(
		'align' => false,
	),
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-block-header .ak-block-tabs a',
			'property' => 'typography',
		),
	),
);


$fields[] = array(
	'id'      => 'modules_cat_header',
	'type'    => 'heading',
	'heading' => esc_html__( 'Module Category', 'newsy' ),
	'section' => 'fonts',
);


$fields[] = array(
	'id'          => 'typo_cat_badge',
	'type'        => 'typography',
	'heading'     => esc_html__( 'Category Badge Typography', 'newsy' ),
	'description' => esc_html__( 'Base typography for badge type category items in all blocks.', 'newsy' ),
	'section'     => 'fonts',
	'options'     => array(
		'align' => false,
	),
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => array(
				'.ak-module-terms.badge > a',
				'.ak-module-terms.inline_badge > a',
			),
			'property' => 'typography',
		),
	),
);

$fields[] = array(
	'id'          => 'typo_meta_category',
	'type'        => 'typography',
	'heading'     => esc_html__( 'Inline Category Typography', 'newsy' ),
	'description' => esc_html__( 'Base typography for inline type category items in all blocks. Inline type is just a category name without box.', 'newsy' ),
	'section'     => 'fonts',
	'options'     => array(
		'align' => false,
	),
	'output'      => array(
		array(
			'type'     => 'css',
			'element'  => '.ak-module-terms.inline',
			'property' => 'typography',
		),
	),
);

/**
 * -> BuddyPress Typography
 */
$fields[] = array(
	'heading' => esc_html__( 'BuddyPress Page', 'newsy' ),
	'id'      => 'buddypress_page_typo',
	'type'    => 'group_start',
	'section' => 'fonts',
);
if ( ! class_exists( 'buddypress' ) ) {
	$fields[] = newsy_get_plugin_required_info_field( 'BuddyPress', 'fonts' );
} else {
	$fields[] = array(
		'heading' => esc_html__( 'Member Page', 'newsy' ),
		'id'      => 'buddypress_member_typo',
		'type'    => 'heading',
		'section' => 'fonts',
	);
	$fields[] = array(
		'id'      => 'typo_bp_member_name',
		'type'    => 'typography',
		'heading' => esc_html__( 'Member Name', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => 'body.bp-user #buddypress.buddypress-wrap .item-header-title',
				'property' => 'typography',
			),
		),
	);
	$fields[] = array(
		'id'      => 'typo_bp_member_username',
		'type'    => 'typography',
		'heading' => esc_html__( 'Member Username', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => 'body.bp-user #buddypress.buddypress-wrap .item-user-nicename',
				'property' => 'typography',
			),
		),
	);
	$fields[] = array(
		'id'      => 'typo_bp_member_description',
		'type'    => 'typography',
		'heading' => esc_html__( 'Member Description', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => 'body.bp-user #buddypress.buddypress-wrap .member-description',
				'property' => 'typography',
			),
		),
	);
	$fields[] = array(
		'id'      => 'typo_bp_member_menu',
		'type'    => 'typography',
		'heading' => esc_html__( 'Member Navigation', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => 'body.bp-user #buddypress.buddypress-wrap .ak-buddypress-nav > ul > li > a',
				'property' => 'typography',
			),
		),
	);
	$fields[] = array(
		'id'      => 'typo_bp_member_sub_menu',
		'type'    => 'typography',
		'heading' => esc_html__( 'Member Sub Navigation', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => 'body.bp-user #buddypress.buddypress-wrap .bp-subnavs li a',
				'property' => 'typography',
			),
		),
	);

	$fields[] = array(
		'heading' => esc_html__( 'Group Page', 'newsy' ),
		'id'      => 'buddypress_group_typo',
		'type'    => 'heading',
		'section' => 'fonts',
	);
	$fields[] = array(
		'id'      => 'typo_bp_group_name',
		'type'    => 'typography',
		'heading' => esc_html__( 'Group Name', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => 'body.groups #buddypress.buddypress-wrap .item-header-title',
				'property' => 'typography',
			),
		),
	);
	$fields[] = array(
		'id'      => 'typo_bp_group_description',
		'type'    => 'typography',
		'heading' => esc_html__( 'Group Description', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => 'body.groups #buddypress.buddypress-wrap .group-description',
				'property' => 'typography',
			),
		),
	);
	$fields[] = array(
		'id'      => 'typo_bp_group_menu',
		'type'    => 'typography',
		'heading' => esc_html__( 'Group Menu', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => 'body.groups #buddypress.buddypress-wrap .ak-buddypress-nav > ul > li > a',
				'property' => 'typography',
			),
		),
	);

	$fields[] = array(
		'heading' => esc_html__( 'Activity', 'newsy' ),
		'id'      => 'buddypress_activity_typo',
		'type'    => 'heading',
		'section' => 'fonts',
	);

	$fields[] = array(
		'id'      => 'typo_bp_activity_text',
		'type'    => 'typography',
		'heading' => esc_html__( 'Activity Content', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#buddypress.buddypress-wrap .activity-list .activity-item .activity-inner p',
				'property' => 'typography',
			),
		),
	);

	$fields[] = array(
		'id'      => 'typo_bp_activity_text',
		'type'    => 'typography',
		'heading' => esc_html__( 'Activity Content', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#buddypress.buddypress-wrap .activity-list .activity-item .activity-inner p',
				'property' => 'typography',
			),
		),
	);
	$fields[] = array(
		'id'      => 'typo_bp_activity_header',
		'type'    => 'typography',
		'heading' => esc_html__( 'Activity Header', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#buddypress.buddypress-wrap .activity-list .activity-item .activity-content .activity-header, #buddypress.buddypress-wrap .activity-list .activity-item .activity-content .comment-header',
				'property' => 'typography',
			),
		),
	);
	$fields[] = array(
		'id'      => 'typo_bp_activity_member_name',
		'type'    => 'typography',
		'heading' => esc_html__( 'Activity Header Member Name', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#buddypress.buddypress-wrap .activity-list .activity-item .activity-header a:first-child',
				'property' => 'typography',
			),
		),
	);
}


/**
 * -> bbPress Typography
 */
$fields[] = array(
	'heading' => esc_html__( 'bbPress Page', 'newsy' ),
	'id'      => 'bbpress_block_typo',
	'type'    => 'group_start',
	'section' => 'fonts',
);
if ( ! class_exists( 'bbPress' ) ) {
	$fields[] = newsy_get_plugin_required_info_field( 'bbPress', 'fonts' );
} else {
	$fields[] = array(
		'id'          => 'typo_bb_global',
		'type'        => 'typography',
		'heading'     => esc_html__( 'Forums Typography', 'newsy' ),
		'description' => esc_html__( 'Global typography settings for forum pages.', 'newsy' ),
		'section'     => 'fonts',
		'options'     => array(
			'align'          => false,
			'letter-spacing' => false,
			'transform'      => false,
			'color'          => false,
		),
		'output'      => array(
			array(
				'type'     => 'css',
				'element'  => '#bbpress-forums',
				'property' => 'typography',
			),
		),
	);
	$fields[] = array(
		'heading'     => esc_html__( 'Forums Highlight Color', 'newsy' ),
		'description' => esc_html__( 'It is the contrast color for the forum pages. Used in category header etc..', 'newsy' ),
		'id'          => 'bbpress_highlight_color',
		'type'        => 'color',
		'section'     => 'fonts',
		'output'      => array(
			array(
				'type'     => 'css',
				'element'  => '#bbpress-forums',
				'property' => '--ak-highlight-color',
			),
		),
	);
	$fields[] = array(
		'heading' => esc_html__( 'Index Page', 'newsy' ),
		'id'      => 'bbpress_home_typo',
		'type'    => 'heading',
		'section' => 'fonts',
	);
	$fields[] = array(
		'id'      => 'typo_bb_category_title',
		'type'    => 'typography',
		'heading' => esc_html__( 'Forum Header Title', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#bbpress-forums li.bbp-header .forum-titles .bbp-forum-info a',
				'property' => 'typography',
			),
		),
	);
	$fields[] = array(
		'id'      => 'typo_bb_forum_title',
		'type'    => 'typography',
		'heading' => esc_html__( 'Forum Title', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#bbpress-forums li.bbp-forum-info .bbp-forum-title',
				'property' => 'typography',
			),
		),
	);
	$fields[] = array(
		'id'      => 'typo_bb_forum_description',
		'type'    => 'typography',
		'heading' => esc_html__( 'Forum Description', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#bbpress-forums .bbp-forum-info .bbp-forum-content',
				'property' => 'typography',
			),
		),
	);
	$fields[] = array(
		'id'      => 'typo_bb_subforum_title',
		'type'    => 'typography',
		'heading' => esc_html__( 'Sub-Forum Title', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#bbpress-forums .bbp-forums-list .bbp-forum .bbp-forum-link',
				'property' => 'typography',
			),
		),
	);

	$fields[] = array(
		'heading' => esc_html__( 'Category/Forum Page', 'newsy' ),
		'id'      => 'bbpress_category_typo',
		'type'    => 'heading',
		'section' => 'fonts',
	);
	$fields[] = array(
		'id'      => 'typo_bb_category_header_title',
		'type'    => 'typography',
		'heading' => esc_html__( 'Category/Forum Title', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => 'body.bbpress .ak-archive-header .ak-archive-name .ak-archive-name-text',
				'property' => 'typography',
			),
		),
	);

	$fields[] = array(
		'id'      => 'typo_bb_category_header_description',
		'type'    => 'typography',
		'heading' => esc_html__( 'Category/Forum Description', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#bbpress-forums .forum-description',
				'property' => 'typography',
			),
		),
	);

	$fields[] = array(
		'id'      => 'typo_bb_topic_title',
		'type'    => 'typography',
		'heading' => esc_html__( 'Topic Title', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#bbpress-forums .bbp-topics .bbp-topic-title .bbp-topic-permalink',
				'property' => 'typography',
			),
		),
	);

	$fields[] = array(
		'id'      => 'typo_bb_topic_meta',
		'type'    => 'typography',
		'heading' => esc_html__( 'Topic Meta', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#bbpress-forums .bbp-topics p.bbp-topic-meta',
				'property' => 'typography',
			),
		),
	);

	$fields[] = array(
		'heading' => esc_html__( 'Replies Page', 'newsy' ),
		'id'      => 'bbpress_reply_typo',
		'type'    => 'heading',
		'section' => 'fonts',
	);
	$fields[] = array(
		'id'      => 'typo_bb_reply_content',
		'type'    => 'typography',
		'heading' => esc_html__( 'Reply Content', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#bbpress-forums div.bbp-reply-content p',
				'property' => 'typography',
			),
		),
	);


	$fields[] = array(
		'id'      => 'typo_bb_reply_meta',
		'type'    => 'typography',
		'heading' => esc_html__( 'Reply Meta', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#bbpress-forums div.bbp-reply-content .reply-meta, #bbpress-forums div.bbp-reply-content .reply-meta .bbp-reply-permalink, #bbpress-forums div.bbp-reply-content .reply-meta .bbp-reply-post-date',
				'property' => 'typography',
			),
		),
	);

	$fields[] = array(
		'id'      => 'typo_bb_reply_author',
		'type'    => 'typography',
		'heading' => esc_html__( 'Reply Meta Author Name', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#bbpress-forums div.bbp-reply-content .bbp-reply-post-author .bbp-author-link .bbp-author-name',
				'property' => 'typography',
			),
		),
	);

	$fields[] = array(
		'heading' => esc_html__( 'Form Elements', 'newsy' ),
		'id'      => 'bbpress_form_typo',
		'type'    => 'heading',
		'section' => 'fonts',
	);
	$fields[] = array(
		'id'      => 'typo_bb_form_global',
		'type'    => 'typography',
		'heading' => esc_html__( 'Reply Form Typography', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align'          => false,
			'letter-spacing' => false,
			'transform'      => false,
			'color'          => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#bbpress-forums fieldset.bbp-form',
				'property' => 'typography',
			),
		),
	);
	$fields[] = array(
		'id'      => 'typo_bb_form_legend',
		'type'    => 'typography',
		'heading' => esc_html__( 'Reply Form Heading', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#bbpress-forums fieldset.bbp-form legend',
				'property' => 'typography',
			),
		),
	);
	$fields[] = array(
		'id'      => 'typo_bb_form_label',
		'type'    => 'typography',
		'heading' => esc_html__( 'Reply Form Input Label', 'newsy' ),
		'section' => 'fonts',
		'options' => array(
			'align' => false,
		),
		'output'  => array(
			array(
				'type'     => 'css',
				'element'  => '#bbpress-forums fieldset.bbp-form label',
				'property' => 'typography',
			),
		),
	);
}
