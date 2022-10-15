<?php
/**
 * Top Menu Metabox.
 */
$fields[] = array(
	'heading' => esc_html__( 'Top Menu', 'newsy' ),
	'id'      => 'top_menu',
	'type'    => 'section',
);

$fields[] = array(
	'heading' => esc_html__( 'Sub Menu', 'newsy' ),
	'type'    => 'group_start',
	'section' => 'top_menu',
);

$fields[] = array(
	'heading'           => esc_html__( 'Sub Menu Type', 'newsy' ),
	'id'                => 'select',
	'type'              => 'select',
	'default_text'      => 'Chose one',
	'section_class'     => 'ak-section-full',
	'only_for_sub_item' => true,
	'options'           => array(
		''              => esc_html__( 'No Column', 'newsy' ),
		'link-2-column' => esc_html__( '2 Column links', 'newsy' ),
		'link-3-column' => esc_html__( '3 Column links', 'newsy' ),
		'link-4-column' => esc_html__( '4 Column links', 'newsy' ),
	),
	'section'           => 'top_menu',
);

$fields[] = array(
	'heading'       => esc_html__( 'Animation', 'newsy' ),
	'id'            => 'drop_menu_anim',
	'type'          => 'select',
	'section_class' => 'ak-section-full',
	//'only_for_parent'  => TRUE,
	'options'       => ak_get_animation_styles(),
	'section'       => 'top_menu',
);

$fields[] = array(
	'heading' => esc_html__( 'Menu Icon', 'newsy' ),
	'type'    => 'group_start',
	'section' => 'top_menu',
);

$fields[] = array(
	'heading'       => esc_html__( 'Icon', 'newsy' ),
	'id'            => 'menu_icon',
	'type'          => 'icon_select',
	'section_class' => 'ak-section-full',
	'default_text'  => esc_html__( 'Chose an Icon', 'newsy' ),
	'section'       => 'top_menu',
);

$fields[] = array(
	'heading'       => esc_html__( 'Show Only Icon?', 'newsy' ),
	'id'            => 'hide_menu_title',
	'type'          => 'visual_select',
	'section_class' => 'ak-section-full',
	'default_text'  => esc_html__( 'Chose an Icon', 'newsy' ),
	'vertical'      => true,
	'options'       => array(
		''     => esc_html__( 'No', 'newsy' ),
		'hide' => esc_html__( 'Yes', 'newsy' ),
	),
	'section'       => 'top_menu',
);

$fields[] = array(
	'heading' => esc_html__( 'Menu Badge', 'newsy' ),
	'type'    => 'group_start',
	'section' => 'top_menu',
);

$fields[] = array(
	'heading'       => esc_html__( 'Badge Label', 'newsy' ),
	'id'            => 'badge_label',
	'section_class' => 'ak-section-full',
	'type'          => 'text',
	'section'       => 'top_menu',
);
