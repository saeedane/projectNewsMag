<?php
/**
 * Custom Fonts.
 */
$fields[] = array(
	'heading' => __( 'Custom Fonts', 'ak-framework' ),
	'id'      => 'custom_fonts',
	'type'    => 'section',
	'icon'    => 'fa-font',
);
$fields[] = array(
	'heading'            => __( 'Custom Font', 'ak-framework' ),
	'id'                 => 'ak_custom_fonts',
	'container_class'    => 'control-heading-hide',
	'type'               => 'repeater',
	'repeat_title_field' => 'name',
	'fields'             => array(
		array(
			'heading'         => __( 'Font Name', 'ak-framework' ),
			'input_attrs'     => array(
				'placeholder' => 'MyFont',
			),
			'id'              => 'name',
			'type'            => 'text',
			'container_class' => 'control-heading-full',
			'field_col'       => 1,
		),
		array(
			'heading'         => __( 'Font .woff', 'ak-framework' ),
			'id'              => 'woff',
			'media_type'      => 'application/x-font-woff',
			'button_text'     => __( 'Upload .woff', 'ak-framework' ),
			'media_title'     => __( 'Upload .woff', 'ak-framework' ),
			'type'            => 'media',
			'container_class' => 'control-heading-full',
			'field_col'       => 2,
		),
		array(
			'heading'         => __( 'Font .ttf', 'ak-framework' ),
			'id'              => 'ttf',
			'media_type'      => 'application/x-font-ttf',
			'button_text'     => __( 'Upload .ttf', 'ak-framework' ),
			'media_title'     => __( 'Upload .ttf', 'ak-framework' ),
			'type'            => 'media',
			'container_class' => 'control-heading-full',
			'field_col'       => 2,
		),
		array(
			'heading'         => __( 'Font .svg', 'ak-framework' ),
			'id'              => 'svg',
			'media_type'      => 'image/svg+xml',
			'button_text'     => __( 'Upload .svg', 'ak-framework' ),
			'media_title'     => __( 'Upload .svg', 'ak-framework' ),
			'type'            => 'media',
			'container_class' => 'control-heading-full',
			'field_col'       => 2,
		),
		array(
			'heading'         => __( 'Font .eot', 'ak-framework' ),
			'id'              => 'eot',
			'media_type'      => 'application/vnd.ms-fontobject',
			'button_text'     => __( 'Upload .eot', 'ak-framework' ),
			'media_title'     => __( 'Upload .eot', 'ak-framework' ),
			'type'            => 'media',
			'container_class' => 'control-heading-full',
			'field_col'       => 2,
		),
	),
	'section'            => 'custom_fonts',
);

$fields[] = array(
	'heading' => __( 'Fonts Stacks', 'ak-framework' ),
	'id'      => 'fonts_stacks',
	'type'    => 'section',
	'icon'    => 'fa-font',
);

$fields[] = array(
	'heading'         => __( 'Font Stack', 'ak-framework' ),
	'id'              => 'ak_stack_fonts',
	'container_class' => 'control-heading-hide',
	'type'            => 'repeater',
	'default'         => Ak\Support\Font::get_default_stack_fonts_option(),
	'fields'          => array(
		array(
			'heading'         => __( 'Font Name', 'ak-framework' ),
			'input_attrs'     => array(
				'placeholder' => 'MyFont',
			),
			'id'              => 'name',
			'type'            => 'text',
			'container_class' => 'control-heading-full',
			'field_col'       => 2,
		),
		array(
			'heading'         => __( 'Font Family', 'ak-framework' ),
			'id'              => 'family',
			'type'            => 'text',
			'container_class' => 'control-heading-full',
			'field_col'       => 2,
		),
	),
	'section'         => 'fonts_stacks',
);
