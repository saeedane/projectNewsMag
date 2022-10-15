<?php
/**
 * Default Menu Metabox.
 */
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
