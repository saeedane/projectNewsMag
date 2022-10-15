<?php

/**
 * General Settings Tab
 */
$fields[] = array(
	'heading' => esc_html__( 'General', 'newsy' ),
	'id'      => 'general',
	'type'    => 'section',
	'icon'    => 'fa-globe',
	'file'    => NEWSY_THEME_PATH . 'includes/options/theme-panel/sections/general.php',
);

/**
 * Header Settings Tab
 */
$fields[] = array(
	'heading' => esc_html__( 'Header', 'newsy' ),
	'id'      => 'header',
	'type'    => 'section',
	'icon'    => 'fa-window-maximize',
	'file'    => NEWSY_THEME_PATH . 'includes/options/theme-panel/sections/header.php',
);

/**
 * Footer Settings Tab
 */
$fields[] = array(
	'heading' => esc_html__( 'Footer', 'newsy' ),
	'id'      => 'footer',
	'type'    => 'section',
	'icon'    => 'fa-window-maximize fa-rotate-180',
	'file'    => NEWSY_THEME_PATH . 'includes/options/theme-panel/sections/footer.php',
);

$fields[] = array(
	'heading' => esc_html__( 'Page Settings', 'newsy' ),
	'id'      => 'page_separator',
	'type'    => 'section_separator',
);
$fields[] = array(
	'heading' => esc_html__( 'Homepage', 'newsy' ),
	'id'      => 'home',
	'type'    => 'section',
	'icon'    => 'fa-home',
	'file'    => NEWSY_THEME_PATH . 'includes/options/theme-panel/sections/home.php',
);

$fields[] = array(
	'heading' => esc_html__( 'Post Page', 'newsy' ),
	'id'      => 'post',
	'type'    => 'section',
	'icon'    => 'fa-pencil',
	'file'    => NEWSY_THEME_PATH . 'includes/options/theme-panel/sections/post.php',
);

$fields[] = array(
	'heading'  => esc_html__( 'Categories', 'newsy' ),
	'id'       => 'categories',
	'type'     => 'section',
	'ajax-tab' => true,
	'icon'     => 'fa-book',
	'file'     => NEWSY_THEME_PATH . 'includes/options/theme-panel/sections/categories.php',
);


$fields[] = array(
	'heading' => esc_html__( 'Other Pages', 'newsy' ),
	'id'      => 'other_pages',
	'type'    => 'section',
	'icon'    => 'fa-file-text',
	'file'    => NEWSY_THEME_PATH . 'includes/options/theme-panel/sections/archive.php',
);


$fields[] = array(
	'heading' => esc_html__( 'Style Settings', 'newsy' ),
	'id'      => 'style_separator',
	'type'    => 'section_separator',
);

/**
 * => Style Options
 */
$fields[] = array(
	'heading' => esc_html__( 'Colors', 'newsy' ),
	'id'      => 'colors',
	'type'    => 'section',
	'icon'    => 'fa-paint-brush',
	'file'    => NEWSY_THEME_PATH . 'includes/options/theme-panel/sections/colors.php',
);
$fields[] = array(
	'heading' => esc_html__( 'Typography', 'newsy' ),
	'id'      => 'fonts',
	'type'    => 'section',
	'icon'    => 'fa-font',
	'file'    => NEWSY_THEME_PATH . 'includes/options/theme-panel/sections/fonts.php',
);

$fields[] = array(
	'heading' => esc_html__( 'Blocks', 'newsy' ),
	'id'      => 'blocks',
	'type'    => 'section',
	'icon'    => 'fa-window-maximize',
	// 'badge'   => array(
	// 	'text'  => esc_html__( 'HOT', 'newsy' ),
	// 	'color' => '#f13838',
	// ),
	'file'    => NEWSY_THEME_PATH . 'includes/options/theme-panel/sections/blocks.php',
);
$fields[] = array(
	'heading' => esc_html__( 'Modules', 'newsy' ),
	'id'      => 'modules',
	'type'    => 'section',
	'icon'    => 'fa-window-restore',
	'file'    => NEWSY_THEME_PATH . 'includes/options/theme-panel/sections/modules.php',
);

$fields[] = array(
	'heading' => esc_html__( 'Other Settings', 'newsy' ),
	'id'      => 'other_separator',
	'type'    => 'section_separator',
);

$fields[] = array(
	'heading' => esc_html__( 'Ads', 'newsy' ),
	'id'      => 'ads',
	'type'    => 'section',
	'icon'    => 'fa-money',
	'file'    => NEWSY_THEME_PATH . 'includes/options/theme-panel/sections/ads.php',
);

$fields[] = array(
	'heading' => esc_html__( 'Advanced', 'newsy' ),
	'id'      => 'advanced',
	'type'    => 'section',
	'icon'    => 'fa-cog',
	'file'    => NEWSY_THEME_PATH . 'includes/options/theme-panel/sections/advanced.php',
);

$fields[] = array(
	'heading' => esc_html__( 'Custom Codes', 'newsy' ),
	'id'      => 'custom_codes',
	'type'    => 'section',
	'icon'    => 'fa-code',
	'file'    => NEWSY_THEME_PATH . 'includes/options/theme-panel/sections/custom_codes.php',
);
