<?php
/**
 * Main Menu Metabox.
 */
$fields[] = array(
	'heading' => esc_html__( 'Mega & Sub Menu', 'newsy' ),
	'id'      => 'mega_menu',
	'type'    => 'section',
);

$fields[] = array(
	'id'      => 'mega_menu_settings_group_start',
	'type'    => 'group_start',
	'heading' => esc_html__( 'Mega & Sub Menu', 'newsy' ),
	'section' => 'mega_menu',
);

$fields[] = array(
	'id'               => 'mega_menu',
	'type'             => 'select',
	'heading'          => esc_html__( 'Mega Menu Type', 'newsy' ),
	'container_class'  => 'control-heading-full',
	'only_for_parent'  => true,
	'options_callback' => 'newsy_get_mega_menu_options',
	'section'          => 'mega_menu',
);

$fields[] = array(
	'id'              => 'tabs',
	'type'            => 'select',
	'heading'         => esc_html__( 'Tabs', 'newsy' ),
	'options'         => array(
		''             => esc_html__( 'Auto Detect - Sub Categories as Tab', 'newsy' ),
		'cat_filter'   => esc_html__( 'Categories as Tab', 'newsy' ),
		'tax_filter'   => esc_html__( 'Taxonomies as Tab', 'newsy' ),
		'order_filter' => esc_html__( 'Order by as Tab', 'newsy' ),
	),
	'container_class' => 'control-heading-full',
	'section'         => 'mega_menu',
	'dependency'      => array(
		'element' => 'mega_menu',
		'value'   => array( 'tabbed-posts' ),
	),
);

$fields[] = array(
	'type'             => 'select',
	'heading'          => esc_html__( 'Selected Categories as Tab', 'newsy' ),
	'input_desc'       => esc_html__( 'Select multiple categories. This will create multi tab header.', 'newsy' ),
	'id'               => 'tabs_cat_filter',
	'options_callback' => 'Ak\Form\FormCallback::get_categories',
	'multiple'         => 10,
	'container_class'  => 'control-heading-full',
	'section'          => 'mega_menu',
	'dependency'       => array(
		'element' => 'tabs',
		'value'   => array( 'cat_filter' ),
	),
);

$fields[] = array(
	'type'            => 'ajax_select',
	'heading'         => esc_html__( 'Taxonomies as tab', 'newsy' ),
	'input_desc'      => esc_html__( 'Enter here custom taxonomies with "taxonomy:term_name" pattern also you can add multiple taxonomies. ( ex: post_format:video,genre:books,writer:admin )', 'newsy' ),
	'id'              => 'tabs_tax_filter',
	'ajax_callback'   => 'Ak\Form\FormCallback::get_taxonomies',
	'container_class' => 'control-heading-full',
	'section'         => 'mega_menu',
	'dependency'      => array(
		'element' => 'tabs',
		'value'   => array( 'tax_filter' ),
	),
);

$fields[] = array(
	'type'             => 'select',
	'heading'          => esc_html__( 'Select order by options as Tab', 'newsy' ),
	'input_desc'       => esc_html__( 'Pick order by options you want see or leave empty for all options', 'newsy' ),
	'id'               => 'tabs_order_by_filter',
	'options_callback' => 'newsy_get_block_order_by_options',
	'container_class'  => 'control-heading-full',
	'multiple'         => 10,
	'section'          => 'mega_menu',
	'dependency'       => array(
		'element' => 'tabs',
		'value'   => array( 'order_filter' ),
	),
);
$fields[] = array(
	'type'             => 'select',
	'heading'          => esc_html__( 'Exclude Categories at Viral Menu Section', 'newsy' ),
	'id'               => 'viral_menu_exc',
	'options_callback' => 'Ak\Form\FormCallback::get_categories',
	'multiple'         => 10,
	'container_class'  => 'control-heading-full',
	'section'          => 'mega_menu',
	'dependency'       => array(
		'element' => 'mega_menu',
		'value'   => array( 'viral-menu' ),
	),
);
$fields[] = array(
	'type'               => 'ajax_select',
	'heading'            => esc_html__( 'Select Page Links at Viral Menu', 'newsy' ),
	'id'                 => 'viral_menu_pages',
	'ajax_callback'      => 'Ak\Form\FormCallback::get_posts',
	'ajax_callback_args' => array( 'post_type' => 'page' ),
	'max_items'          => 10,
	'container_class'    => 'control-heading-full',
	'section'            => 'mega_menu',
	'dependency'         => array(
		'element' => 'mega_menu',
		'value'   => array( 'viral-menu' ),
	),
);
$fields[] = array(
	'heading'         => esc_html__( 'Viral Menu Logo', 'newsy' ),
	'id'              => 'viral_menu_icon',
	'input_desc'      => esc_html__( 'By default, a logo is created using theme options. But you can also upload an image-based logo here.', 'newsy' ),
	'type'            => 'media_image',
	'media_title'     => esc_html__( 'Select or Upload Logo', 'newsy' ),
	'media_button'    => esc_html__( 'Select Image', 'newsy' ),
	'upload_label'    => esc_html__( 'Upload Logo', 'newsy' ),
	'remove_label'    => esc_html__( 'Remove', 'newsy' ),
	'container_class' => 'control-heading-full',
	'section'         => 'mega_menu',
	'dependency'      => array(
		'element' => 'mega_menu',
		'value'   => array( 'viral-menu' ),
	),
);
$fields[] = array(
	'type'               => 'ajax_select',
	'heading'            => esc_html__( 'Select Pages for Custom Menu', 'newsy' ),
	'id'                 => 'custom_mega_menu',
	'ajax_callback'      => 'Ak\Form\FormCallback::get_posts',
	'ajax_callback_args' => array( 'post_type' => 'page' ),
	'container_class'    => 'control-heading-full',
	'max_items'          => 1,
	'section'            => 'mega_menu',
	'dependency'         => array(
		'element' => 'mega_menu',
		'value'   => array( 'custom-menu' ),
	),
);

$fields[] = array(
	'heading'           => esc_html__( 'Sub Menu Type', 'newsy' ),
	'id'                => 'sub_menu',
	'type'              => 'select',
	'container_class'   => 'control-heading-full',
	'only_for_sub_item' => true,
	'options'           => array(
		''              => esc_html__( 'No Column', 'newsy' ),
		'link-2-column' => esc_html__( '2 Column links', 'newsy' ),
		'link-3-column' => esc_html__( '3 Column links', 'newsy' ),
		'link-4-column' => esc_html__( '4 Column links', 'newsy' ),
	),
	'section'           => 'mega_menu',
	'dependency'        => array(
		'element' => 'mega_menu',
		'value'   => array( '' ),
	),
);

$fields[] = array(
	'heading'          => esc_html__( 'Menu Animation', 'newsy' ),
	'id'               => 'drop_menu_anim',
	'type'             => 'select',
	'container_class'  => 'control-heading-full',
	//'only_for_parent'  => TRUE,
	'options_callback' => 'ak_get_animation_styles',
	'section'          => 'mega_menu',
);

$fields[] = array(
	'heading' => esc_html__( 'Menu Icon', 'newsy' ),
	'id'      => 'menu_icon_group_start',
	'type'    => 'group_start',
	'section' => 'mega_menu',
);

$fields[] = array(
	'heading'         => esc_html__( 'Icon', 'newsy' ),
	'id'              => 'menu_icon',
	'type'            => 'icon_select',
	'container_class' => 'control-heading-full',
	'default_text'    => esc_html__( 'Chose an Icon', 'newsy' ),
	'section'         => 'mega_menu',
);

$fields[] = array(
	'heading'         => esc_html__( 'Show Only Icon?', 'newsy' ),
	'id'              => 'hide_menu_title',
	'type'            => 'switcher',
	'container_class' => 'control-heading-full',
	'options'         => array(
		'on'  => 'hide',
		'off' => '',
	),
	'section'         => 'mega_menu',
);

$fields[] = array(
	'heading'         => esc_html__( 'Icon Color', 'newsy' ),
	'id'              => 'menu_icon_color',
	'type'            => 'color',
	'container_class' => 'control-heading-full',
	'section'         => 'mega_menu',
);
$fields[] = array(
	'heading' => esc_html__( 'Menu Badge', 'newsy' ),
	'id'      => 'menu_badge_group_start',
	'type'    => 'group_start',
	'section' => 'mega_menu',
);
$fields[] = array(
	'heading'         => esc_html__( 'Badge Label', 'newsy' ),
	'id'              => 'badge_label',
	'type'            => 'text',
	'container_class' => 'control-heading-full',
	'section'         => 'mega_menu',
);
$fields[] = array(
	'heading'         => esc_html__( 'Badge Color', 'newsy' ),
	'id'              => 'badge_color',
	'type'            => 'color',
	'container_class' => 'control-heading-full',
	'section'         => 'mega_menu',
);
