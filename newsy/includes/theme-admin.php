<?php
/**
 * Newsy theme admin functionality.
 */

if ( ! function_exists( 'newsy_get_supported_post_classes' ) ) {
	/**
	 *  Get the supported post wrapper classes.
	 *
	 * @return array
	 */
	function newsy_get_supported_post_classes() {
		return apply_filters(
			'newsy_post_supported_classes', array(
				'ak-post-boxed'  => 'ak-post-boxed',
				'ak-post-shadow' => 'ak-post-shadow',
			)
		);
	}
}

if ( ! function_exists( 'newsy_get_supported_ad_options' ) ) {
	/**
	 * Get the all ad places.
	 *
	 * @return array
	 */
	function newsy_get_supported_ad_options( $ads = array() ) {
		$ads['header_top_ad'] = array(
			'name' => esc_html__( 'Header Top', 'newsy' ),
		);

		$ads['header_bottom_ad'] = array(
			'name' => esc_html__( 'Header Bottom', 'newsy' ),
		);

		$ads['footer_top_ad'] = array(
			'name' => esc_html__( 'Footer Top', 'newsy' ),
		);

		$ads['archive_grid_before_ad'] = array(
			'name' => esc_html__( 'Archive Grid Top', 'newsy' ),
		);

		$ads['archive_grid_after_ad'] = array(
			'name' => esc_html__( 'Archive Grid Bottom', 'newsy' ),
		);

		$ads['single_post_top_ad'] = array(
			'name' => esc_html__( 'Post Top', 'newsy' ),
		);

		$ads['single_post_article_top_ad'] = array(
			'name' => esc_html__( 'Post Content Top', 'newsy' ),
		);

		$ads['single_post_article_content_ad'] = array(
			'name' => esc_html__( 'Post Content', 'newsy' ),
		);

		$ads['single_post_article_bottom_ad'] = array(
			'name' => esc_html__( 'Post Content Bottom', 'newsy' ),
		);

		return apply_filters( 'newsy_supported_ad_options', $ads );
	}
}

if ( ! function_exists( 'newsy_get_ad_group_fields' ) ) {
	/**
	 * Get the ad group fields.
	 *
	 * @return array
	 */
	function newsy_get_ad_group_fields( $ad_id, $ad ) {
		$fields = array();

		if ( ! defined( 'NEWSY_ELEMENTS_PATH' ) ) {
			$fields[] = newsy_get_plugin_required_info_field( 'Newsy Elements', 'blocks' );
			return $fields;
		}

		$fields[] = array(
			'heading' => $ad['name'],
			'id'      => $ad_id . '_heading',
			'type'    => 'group_start',
			'section' => 'ads',
		);

		if ( 'single_post_article_content_ad' === $ad_id ) {
			$fields[] = array(
				'heading'     => esc_html__( 'Tip', 'newsy' ),
				'description' => esc_html__( 'These ads will be displayed in the single article content area. You can add as many ad slots as you want in your preferred order.', 'newsy' ),
				'id'          => $ad_id . '_info',
				'type'        => 'info',
				'info_type'   => 'tip',
				'section'     => 'ads',
			);

			$fields[] = array(
				'id'                 => $ad_id,
				'heading'            => $ad['name'],
				'type'               => 'repeater',
				'container_class'    => 'ak-mix-fields-full control-heading-hide',
				'repeat_title_field' => 'ad_position',
				'fields'             => array_merge(
					array(
						array(
							'id'          => 'ad_position',
							'heading'     => esc_html__( 'Ad Position', 'newsy' ),
							'description' => esc_html__( 'Here you can choose the position of the paragraph.', 'newsy' ),
							'input_desc'  => esc_html__( 'Show this ad after # paragraph.', 'newsy' ),
							'type'        => 'slider',
							'default'     => 2,
							'min'         => 1,
							'max'         => 100,
						),
						array(
							'id'          => 'ad_align',
							'heading'     => esc_html__( 'Ad Align', 'newsy' ),
							'description' => esc_html__( 'Here you can choose the alignment of the ad within the post content.', 'newsy' ),
							'type'        => 'radio_button',
							'default'     => 'center',
							'options'     => array(
								'left'   => esc_html__( 'Left', 'newsy' ),
								'center' => esc_html__( 'Center', 'newsy' ),
								'right'  => esc_html__( 'Right', 'newsy' ),
							),
						),
					),
					newsy_get_ad_fields( $ad )
				),
				'section'            => 'ads',
			);
		} else {
			$fields[] = array(
				'id'              => $ad_id,
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

		return apply_filters( 'newsy_ad_group_fields', $fields );
	}
}

if ( ! function_exists( 'newsy_get_suppored_comment_options' ) ) {
	/**
	 * Get the supported comments options.
	 *
	 * @return array
	 */
	function newsy_get_suppored_comment_options() {
		$comments = apply_filters( 'newsy_suppored_comments', array() );

		$result = array();
		foreach ( $comments as $id => $comment ) {
			$result[ $id ] = isset( $comment['label'] ) ? $comment['label'] : $comment['name'];
		}

		return $result;
	}
}

if ( ! function_exists( 'newsy_get_logo_fields' ) ) {
	/**
	 * Get the logo field options.
	 *
	 * @return array
	 */
	function newsy_get_logo_fields( $place = '', $section = '', $selector = '' ) {
		$_place = $place ? $place . '_' : '';

		$fields = array(
			array(
				'heading'     => esc_html__( 'Logo Type', 'newsy' ),
				'id'          => $_place . 'logo_type',
				'description' => esc_html__( 'Choose logo type.', 'newsy' ),
				'type'        => 'visual_select',
				'options'     => array(
					'text'  => esc_html__( 'Text', 'newsy' ),
					'image' => esc_html__( 'Image', 'newsy' ),
				),
				'default'     => 'image',
				'section'     => $section,
			),
			array(
				'heading'     => esc_html__( 'Logo Image', 'newsy' ),
				'id'          => $_place . 'logo_image',
				'description' => esc_html__( 'By default, a text-based logo is created using your site title. But you can also upload an image-based logo here.', 'newsy' ),
				'type'        => 'media_image',
				'section'     => $section,
				'default'     => empty( $place ) ? NEWSY_THEME_URI . '/assets/images/logo.png' : newsy_get_option( 'logo_image', NEWSY_THEME_URI . '/assets/images/logo.png' ),
				'dependency'  => array(
					'element' => $_place . 'logo_type',
					'value'   => array( 'image' ),
				),
			),
			array(
				'heading'     => esc_html__( 'Logo 2x Image', 'newsy' ),
				'id'          => $_place . 'logo2x_image',
				'description' => esc_html__( 'By default, a text-based logo is created using your site title. But you can also upload an image-based logo here.', 'newsy' ),
				'type'        => 'media_image',
				'section'     => $section,
				'default'     => empty( $place ) ? NEWSY_THEME_URI . '/assets/images/logo@2x.png' : newsy_get_option( 'logo2x_image', NEWSY_THEME_URI . '/assets/images/logo@2x.png' ),
				'dependency'  => array(
					'element' => $_place . 'logo_type',
					'value'   => array( 'image' ),
				),
			),
			array(
				'heading'     => esc_html__( 'Logo Dark Image', 'newsy' ),
				'id'          => $_place . 'logo_dark_image',
				'description' => esc_html__( 'By default, a text-based logo is created using your site title. But you can also upload an image-based logo here.', 'newsy' ),
				'type'        => 'media_image',
				'section'     => $section,
				'default'     => empty( $place ) ? NEWSY_THEME_URI . '/assets/images/logo-dark.png' : newsy_get_option( 'logo_dark_image', NEWSY_THEME_URI . '/assets/images/logo-dark.png' ),
				'dependency'  => array(
					'element' => $_place . 'logo_type',
					'value'   => array( 'image' ),
				),
			),
			array(
				'heading'     => esc_html__( 'Logo Dark 2x Image', 'newsy' ),
				'id'          => $_place . 'logo2x_dark_image',
				'description' => esc_html__( 'By default, a text-based logo is created using your site title. But you can also upload an image-based logo here.', 'newsy' ),
				'type'        => 'media_image',
				'section'     => $section,
				'default'     => empty( $place ) ? NEWSY_THEME_URI . '/assets/images/logo-dark@2x.png' : newsy_get_option( 'logo2x_dark_image', NEWSY_THEME_URI . '/assets/images/logo-dark@2x.png' ),
				'dependency'  => array(
					'element' => $_place . 'logo_type',
					'value'   => array( 'image' ),
				),
			),
			array(
				'heading'     => esc_html__( 'Text Logo', 'newsy' ),
				'id'          => $_place . 'logo_text',
				'description' => esc_html__( 'Enter your site name here for logo text.<br> <code>Tip:</code> Enter site tagline here to add this to logo alt attribute.', 'newsy' ),
				'type'        => 'text',
				'section'     => $section,
				'input_attrs' => array(
					'placeholder' => empty( $place ) ? get_bloginfo( 'name' ) : newsy_get_option( 'logo_text', get_bloginfo( 'name' ) ),
				),
				'dependency'  => array(
					'element' => $_place . 'logo_type',
					'value'   => array( 'text' ),
				),
			),
		);

		$fields[] = array(
			'heading'    => esc_html__( 'Logo Width', 'newsy' ),
			'id'         => $_place . 'main_logo_width', // backward compatible
			'type'       => 'slider',
			'min'        => 50,
			'max'        => 500,
			'step'       => 1,
			'unit'       => 'px',
			'output'     => array(
				array(
					'type'     => 'css',
					'element'  => array(
						$selector . ' .ak-logo-image img',
					),
					'property' => 'width',
					'units'    => 'px',
				),
			),
			'dependency' => array(
				'element' => $_place . 'logo_type',
				'value'   => array( 'image' ),
			),
			'section'    => $section,
		);

		$fields[] = array(
			'heading'    => esc_html__( 'Logo Height', 'newsy' ),
			'id'         => $_place . 'logo_height',
			'type'       => 'slider',
			'min'        => 10,
			'max'        => 500,
			'step'       => 1,
			'unit'       => 'px',
			'output'     => array(
				array(
					'type'     => 'css',
					'element'  => array(
						$selector . ' .ak-logo-image img',
					),
					'property' => 'height',
					'units'    => 'px',
				),
			),
			'dependency' => array(
				'element' => $_place . 'logo_type',
				'value'   => array( 'image' ),
			),
			'section'    => $section,
		);

		$fields[] = array(
			'heading'         => esc_html__( 'Text Logo Typography', 'newsy' ),
			'id'              => $_place . 'typ_header_logo',
			'type'            => 'typography',
			'has_hover_color' => true,
			'section'         => $section,
			'output'          => array(
				array(
					'type'     => 'css',
					'element'  => array(
						$selector . ' .ak-logo-text a',
					),
					'property' => 'typography',
					'units'    => 'px',
				),
			),
			'dependency'      => array(
				'element' => $_place . 'logo_type',
				'value'   => array( 'text' ),
			),
		);

		return apply_filters( 'newsy_logo_fields', $fields );
	}
}

if ( ! function_exists( 'newsy_get_layout_options' ) ) {
	/**
	 * Get the layout style field options.
	 *
	 * @return array
	 */
	function newsy_get_layout_options( $default = false ) {
		$options = array(
			'full-width'    => esc_html__( 'Full Width', 'newsy' ),
			'boxed'         => esc_html__( 'Full Boxed', 'newsy' ),
			'content-boxed' => esc_html__( 'Boxed Content', 'newsy' ),
		);

		if ( $default ) {
			$options = array_merge(
				array(
					'' => esc_html__( 'Default', 'newsy' ),
				), $options
			);
		}

		return apply_filters( 'newsy_layout_options', $options );
	}
}

if ( ! function_exists( 'newsy_get_layout_fields' ) ) {
	/**
	 * Get the layout field options.
	 *
	 * @return array
	 */
	function newsy_get_layout_fields( $template = '', $section = '', $body_class = '', $default = true ) {
		if ( ! empty( $template ) ) {
			$template .= '_';
		}

		$fields         = array();
		$default_layout = $default ? '' : 'style-1';
		$container_min  = is_customize_preview() && ! ak_is( 'doing_ajax' ) ? 'min-width:1100px' : 'min-width:1200px';

		$fields[] = array(
			'heading'          => esc_html__( 'Layout', 'newsy' ),
			'description'      => esc_html__( 'Select the layout you want, whether a single column or a 2 column one. It affects every page and the whole layout. This option can be overridden on all sections.', 'newsy' ),
			'id'               => $template . 'layout',
			'type'             => 'radio_image',
			'default'          => $default_layout,
			'options_callback' => array(
				'function' => 'newsy_get_layout_style_options',
				'args'     => array( $default ),
			),
			'section'          => $section,
		);

		$fields[] = array(
			'heading'          => esc_html__( 'Primary Sidebar', 'newsy' ),
			'description'      => esc_html__( 'Pick a sidebar for Primary Sidebar.', 'newsy' ),
			'id'               => $template . 'primary_sidebar',
			'type'             => 'select',
			'options_callback' => 'newsy_get_sidebar_options',
			'section'          => $section,
			'default'          => $default ? '' : 'primary-sidebar',
			'dependency'       => array(
				'element' => $template . 'layout',
				'value'   => array( 'style-1', 'style-2', 'style-4', 'style-5', 'style-6', 'style-7', 'style-8', 'style-9' ),
			),
		);

		$fields[] = array(
			'heading'          => esc_html__( 'Secondary Sidebar', 'newsy' ),
			'description'      => esc_html__( 'Pick a sidebar for Secondary Sidebar.', 'newsy' ),
			'id'               => $template . 'secondary_sidebar',
			'type'             => 'select',
			'options_callback' => 'newsy_get_sidebar_options',
			'section'          => $section,
			'default'          => $default ? '' : 'secondary-sidebar',
			'dependency'       => array(
				'element' => $template . 'layout',
				'value'   => array( 'style-4', 'style-5', 'style-6', 'style-7', 'style-8', 'style-9' ),
			),
		);

		$fields[] = array(
			'id'          => $template . 'sidebar_content_gap',
			'type'        => 'slider',
			'heading'     => esc_html__( 'Primary Sidebar Content Gap', 'newsy' ),
			'description' => esc_html__( 'Gap between content and primary sidebar.', 'newsy' ),
			'default'     => 40,
			'max'         => 200,
			'unit'        => 'px',
			'output'      => array(
				array(
					'type'     => 'css',
					'element'  => array(
						$body_class . ' .ak-layout-style-1 .sidebar-column-primary',
					),
					'property' => 'padding-left',
					'units'    => 'px',
					'media'    => $container_min,
				),
				array(
					'type'     => 'css',
					'element'  => array(
						$body_class . ' .ak-layout-style-2 .sidebar-column-primary',
					),
					'property' => 'padding-right',
					'units'    => 'px',
					'media'    => $container_min,
				),
			),
			'section'     => $section,
			'dependency'  => array(
				'element' => $template . 'layout',
				'value'   => array( 'style-1', 'style-2' ),
			),
		);

		$is_default = $default ? '' : 'full-width';

		$fields[] = array(
			'id'               => $template . 'layout_style',
			'heading'          => esc_html__( 'Layout Style', 'newsy' ),
			'description'      => esc_html__( 'Select whether you want a boxed or a full width layout.', 'newsy' ),
			'type'             => 'visual_select',
			'default'          => $is_default,
			'options_callback' => array(
				'function' => 'newsy_get_layout_options',
				'args'     => array( $default ),
			),
			'section'          => $section,
		);

		$fields[] = array(
			'id'          => $template . 'width',
			'type'        => 'slider_unit',
			'heading'     => esc_html__( 'Site Container Width', 'newsy' ),
			'description' => esc_html__( 'Set cointainer width for site.', 'newsy' ),
			'default'     => '1170px',
			'min'         => 1000,
			'max'         => 1900,
			'step'        => 5,
			'units'       => array(
				'px',
				'%',
			),
			'section'     => $section,
			'output'      => array(
				array(
					'type'     => 'css',
					'element'  => array(
						$body_class . ' .container',
						$body_class . ' .vc-content > .vc_row',
						$body_class . ' .vc-content > .vc_element > .vc_row',
						$body_class . ' .vc-content > .vc_row[data-vc-full-width=true]>.ak_vc_container',
						$body_class . ' .vc-content > .vc_element > .vc_row[data-vc-full-width=true]>.ak_vc_container',
					),
					'property' => 'max-width',
					// hack for small screens
					'media'    => $container_min,
				),
				array(
					'type'     => 'css',
					'element'  => array(
						$body_class . '.ak-post-full-width .ak-post-content .alignwide',
					),
					'property' => 'max-width',
				),
			),
			'dependency'  => array(
				'element' => $template . 'layout_style',
				'value'   => array( 'full-width', 'boxed', 'content-boxed' ),
			),
		);

		$fields[] = array(
			'id'          => $template . 'boxed_inner_width',
			'type'        => 'slider_unit',
			'heading'     => esc_html__( 'Site Boxed Container Width', 'newsy' ),
			'description' => esc_html__( 'Set inner width for boxed style container.', 'newsy' ),
			'default'     => '1200px',
			'min'         => 1000,
			'max'         => 1900,
			'step'        => 1,
			'units'       => array(
				'px',
				'%',
			),
			'output'      => array(
				array(
					'type'     => 'css',
					'element'  => array(
						$body_class . '.boxed .ak-main-wrap',
						$body_class . '.content-boxed .ak-content-wrap .ak-container',
					),
					'property' => 'max-width',
					// hack for small screens
					'media'    => $container_min,
				),
			),
			'dependency'  => array(
				'element' => $template . 'layout_style',
				'value'   => array( 'boxed', 'content-boxed' ),
			),
			'section'     => $section,
		);

		$fields[] = array(
			'id'          => $template . 'bg_color',
			'type'        => 'color',
			'heading'     => esc_html__( 'Site Background Color', 'newsy' ),
			'description' => esc_html__( 'Set a body background color.', 'newsy' ),
			'section'     => $section,
			'output'      => array(
				array(
					'type'     => 'css',
					'element'  => $body_class . ':not(.dark)',
					'property' => 'background-color',
				),
			),
			'dependency'  => array(
				'element' => $template . 'layout_style',
				'value'   => array( 'full-width', 'boxed', 'content-boxed' ),
			),
		);

		$fields[] = array(
			'id'          => $template . 'inner_bg_color',
			'type'        => 'color',
			'heading'     => esc_html__( 'Site Boxed Background Color', 'newsy' ),
			'description' => esc_html__( 'Set a inner container background color for boxed styles.', 'newsy' ),
			'section'     => $section,
			'output'      => array(
				array(
					'type'     => 'css',
					'element'  => array(
						$body_class . '.boxed:not(.dark) .ak-main-wrap .ak-container',
						$body_class . '.content-boxed:not(.dark) .ak-content-wrap .ak-container',
					),
					'property' => 'background-color',
				),
			),
			'dependency'  => array(
				'element' => $template . 'layout_style',
				'value'   => array( 'boxed', 'content-boxed' ),
			),
		);

		$fields[] = array(
			'id'           => $template . 'bg_image',
			'type'         => 'background_image',
			'heading'      => esc_html__( 'Site Background Image', 'newsy' ),
			'description'  => esc_html__( 'Set a background image. For patterns, use a repeating background. Use photo to fully cover the background with an image. Note that it will override the background color option.', 'newsy' ),
			'upload_label' => esc_html__( 'Upload Image', 'newsy' ),
			'section'      => $section,
			'output'       => array(
				array(
					'type'     => 'css',
					'element'  => $body_class . ' .ak-main-bg-wrap',
					'property' => 'background-image',
					'prefix'   => 'url("',
					'suffix'   => '")',
				),
			),
			'dependency'   => array(
				'element' => $template . 'layout_style',
				'value'   => array( 'full-width', 'boxed', 'content-boxed' ),
			),
		);

		return apply_filters( 'newsy_layout_fields', $fields, $template, $body_class, $default );
	}
}

if ( ! function_exists( 'newsy_get_layout_style_options' ) ) {
	/**
	 * Get the layout styles field options.
	 *
	 * @return array
	 */
	function newsy_get_layout_style_options( $default = false ) {
		$options = array(
			'style-1' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/layouts/style-1.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '1' ),
			),
			'style-2' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/layouts/style-2.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '2' ),
			),
			'style-3' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/layouts/style-3.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '3' ),
			),
			'style-4' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/layouts/style-4.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '4' ),
			),
			'style-5' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/layouts/style-5.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '5' ),
			),
			'style-6' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/layouts/style-6.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '6' ),
			),
			'style-7' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/layouts/style-7.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '7' ),
			),
			'style-8' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/layouts/style-8.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '8' ),
			),
			'style-9' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/layouts/style-9.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '9' ),
			),
		);

		if ( $default ) {
			$options = array_merge(
				array(
					'' => array(
						'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/layouts/default.png',
						'value' => '',
					),
				), $options
			);
		}

		return apply_filters( 'newsy_layout_style_options', $options );
	}
}

if ( ! function_exists( 'newsy_get_header_style_options' ) ) {
	/**
	 * Get the header styles field options.
	 *
	 * @return array
	 */
	function newsy_get_header_style_options( $default = false ) {
		$options = array(
			'style-1' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/headers/style-1.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '1' ),
			),
			'style-2' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/headers/style-2.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '2' ),
			),
			'style-3' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/headers/style-3.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '3' ),
			),
			'style-4' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/headers/style-4.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '4' ),
			),
			'style-5' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/headers/style-5.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '5' ),
			),
			'style-6' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/headers/style-6.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '6' ),
			),
		);

		return apply_filters( 'newsy_header_style_options', $options );
	}
}

if ( ! function_exists( 'newsy_get_footer_style_options' ) ) {
	/**
	 * Get the footer styles field options.
	 *
	 * @return array
	 */
	function newsy_get_footer_style_options( $default = false ) {
		$options = array(
			'style-1' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/footers/style-1.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '1' ),
			),
			'style-2' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/footers/style-2.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '2' ),
			),
			'style-3' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/footers/style-3.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '3' ),
			),
			'style-4' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/footers/style-4.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '4' ),
			),
			'style-5' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/footers/style-5.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '5' ),
			),
		);

		return apply_filters( 'newsy_footer_style_options', $options );
	}
}

if ( ! function_exists( 'newsy_get_sidebar_options' ) ) {
	/**
	 * Get the sidebars field options.
	 *
	 * @return array
	 */
	function newsy_get_sidebar_options( $default = false ) {
		return apply_filters( 'ak_get_sidebars', array() );
	}
}

if ( ! function_exists( 'newsy_get_mega_menu_options' ) ) {
	/**
	 * Get the mega menus field options.
	 *
	 * @return array
	 */
	function newsy_get_mega_menu_options() {
		$registred_menus = apply_filters( 'ak-framework/menu/mega-menu', array() );

		$options = array(
			'' => esc_html__( 'No Mega Menu', 'newsy' ),
		);

		foreach ( $registred_menus as $id => $menu ) {
			$options[ $id ] = $menu['name'];
		}

		return apply_filters( 'newsy_mega_menu_options', $options );
	}
}

if ( ! function_exists( 'newsy_get_single_template_options' ) ) {
	/**
	 * Get the single templates field options.
	 *
	 * @return array
	 */
	function newsy_get_single_template_options( $default = false ) {
		$options = array(
			'style-1'  => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/single_templates/style-1.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '1' ),
			),
			'style-2'  => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/single_templates/style-2.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '2' ),
			),
			'style-3'  => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/single_templates/style-3.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '3' ),
			),
			'style-4'  => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/single_templates/style-4.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '4' ),
			),
			'style-5'  => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/single_templates/style-5.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '5' ),
			),
			'style-6'  => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/single_templates/style-6.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '6' ),
			),
			'style-7'  => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/single_templates/style-7.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '7' ),
			),
			'style-8'  => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/single_templates/style-8.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '8' ),
			),
			'style-9'  => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/single_templates/style-9.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '9' ),
			),
			'style-10' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/single_templates/style-10.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '10' ),
			),
			'style-11' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/single_templates/style-11.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '11' ),
			),
			'style-12' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/single_templates/style-12.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '12' ),
			),
			'style-13' => array(
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/single_templates/style-13.png',
				'label' => sprintf( esc_html__( 'Style %s', 'newsy' ), '13' ),
			),
		);

		if ( $default ) {
			$options = array_merge(
				array(
					'' => array(
						'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/single_templates/default.png',
						'value' => '',
					),
				), $options
			);
		}

		return apply_filters( 'newsy_single_template_options', $options );
	}
}

if ( ! function_exists( 'newsy_get_archive_header_fields' ) ) {
	/**
	 * Get the archive header field options.
	 *
	 * @return array
	 */
	function newsy_get_archive_header_fields( $template = '', $section = '', $body_class = '', $default = true, $default_style = '' ) {
		if ( ! empty( $template ) ) {
			$template .= '_';
		}

		$fields           = array();
		$default_template = $default ? '' : 'style-1';

		$fields[] = array(
			'heading'          => esc_html__( 'Header Template', 'newsy' ),
			'description'      => esc_html__( 'Select a page header style.', 'newsy' ),
			'id'               => $template . 'header_style',
			'type'             => 'radio_image',
			'options_callback' => array(
				'function' => 'newsy_get_archive_header_options',
				'args'     => array( $default ),
			),
			'default'          => $default_template,
			'section'          => $section,
		);

		$fields[] = array(
			'heading'     => esc_html__( 'Header Style', 'newsy' ),
			'description' => esc_html__( 'Set page header style.', 'newsy' ),
			'id'          => $template . 'header_css',
			'type'        => 'css_editor',
			'section'     => $section,
			'output'      => array(
				array(
					'type'     => 'css',
					'element'  => $body_class . ' .ak-archive-header',
					'property' => 'css-editor',
				),
			),
			'default'     => $default_style,
			'dependency'  => array(
				'element' => $template . 'header_style',
				'value'   => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6', 'style-7', 'style-8', 'style-9', 'style-10' ),
			),
		);

		$fields[] = array(
			'heading'  => esc_html__( 'Show Breadcrumb?', 'newsy' ),
			'id'       => $template . 'show_breadcrumb',
			'type'     => 'radio_button',
			'vertical' => true,
			'options'  => array(
				''     => esc_html__( 'Default', 'newsy' ),
				'show' => esc_html__( 'Show', 'newsy' ),
				'hide' => esc_html__( 'Hide', 'newsy' ),
			),
			'section'  => $section,
		);

		$fields[] = array(
			'heading'  => esc_html__( 'Show Description?', 'newsy' ),
			'id'       => $template . 'show_description',
			'type'     => 'radio_button',
			'vertical' => true,
			'options'  => array(
				''     => esc_html__( 'Default', 'newsy' ),
				'show' => esc_html__( 'Show', 'newsy' ),
				'hide' => esc_html__( 'Hide', 'newsy' ),
			),
			'section'  => $section,
		);

		return apply_filters( 'newsy_archive_header_fields', $fields, $template, $body_class, $default );
	}
}

if ( ! function_exists( 'newsy_get_archive_header_options' ) ) {
	/**
	 * Get the archive headers field options.
	 *
	 * @return array
	 */
	function newsy_get_archive_header_options( $default = false ) {
		$options = array(
			'style-1'  => array(
				'label' => 'Left Style',
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/archive_headers/style-1.png',
			),
			'style-2'  => array(
				'label' => 'Center Style',
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/archive_headers/style-2.png',
			),
			'style-3'  => array(
				'label' => 'Inline Style',
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/archive_headers/style-3.png',
			),
			'style-4'  => array(
				'label' => 'Inline Center Style',
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/archive_headers/style-4.png',
			),
			'style-5'  => array(
				'label' => 'Shadow Style',
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/archive_headers/style-5.png',
			),
			'style-6'  => array(
				'label' => 'Shadow Center Style',
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/archive_headers/style-6.png',
			),
			'style-7'  => array(
				'label' => 'Background Style',
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/archive_headers/style-7.png',
			),
			'style-8'  => array(
				'label' => 'Background Center Style',
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/archive_headers/style-8.png',
			),
			'style-9'  => array(
				'label' => 'Overlay Style',
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/archive_headers/style-9.png',
			),
			'style-10' => array(
				'label' => 'Overlay Center Style',
				'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/archive_headers/style-10.png',
			),
		);

		if ( $default ) {
			$options = array_merge(
				array(
					'' => array(
						'label' => 'Default',
						'img'   => NEWSY_THEME_URI . '/assets/images/admin/options/archive_headers/default.png',
					),
				), $options
			);
		}

		return apply_filters( 'newsy_archive_header_options', $options );
	}
}


if ( ! function_exists( 'newsy_get_plugin_required_info_field' ) ) {
	/**
	 * Get the required plugin info field.
	 *
	 * @return array
	 */
	function newsy_get_plugin_required_info_field( $plugin, $section = '' ) {
		return array(
			'heading'     => esc_html__( 'Plugin Required', 'newsy' ),
			'description' => sprintf( esc_html__( 'You should enable "%s" plugin to access these options.', 'newsy' ), $plugin ),
			'id'          => 'plugin-required-info-' . uniqid(),
			'type'        => 'info',
			'info_type'   => 'warning',
			'section'     => $section,
		);
	}
}

if ( ! function_exists( 'newsy_get_social_icons_fields' ) ) {
	/**
	 * Get the social icons field options.
	 *
	 * @return array
	 */
	function newsy_get_social_icons_fields( $place = '', $section = '' ) {
		if ( ! defined( 'NEWSY_SOCIAL_COUNTER_PATH' ) ) {
			return array(
				newsy_get_plugin_required_info_field( 'Newsy Social Counter', $section ),
			);
		}

		$_place = $place ? $place . '_' : '';
		$fields = array(
			array(
				'id'               => $_place . 'social_icons',
				'type'             => 'visual_checkbox',
				'heading'          => esc_html__( 'Select Social Icons', 'newsy' ),
				'description'      => esc_html__( 'Select active social links and sort them.', 'newsy' ),
				'options_callback' => 'newsy_get_social_site_options',
				'sorter'           => true,
				'social_fields'    => true,
				'return_string'    => true,
				'section'          => $section,
			),
			array(
				'id'          => $_place . 'social_icons_style',
				'type'        => 'visual_select',
				'heading'     => esc_html__( 'Social Icons Style', 'newsy' ),
				'description' => esc_html__( 'Select whether you want a rounded or a light layout for social icons.', 'newsy' ),
				'section'     => $section,
				'default'     => 'light',
				'options'     => array(
					'colored'      => esc_html__( 'Colored Rounded', 'newsy' ),
					'light-square' => esc_html__( 'Colored Square', 'newsy' ),
					'light-circle' => esc_html__( 'Colored Circle', 'newsy' ),
					'light'        => esc_html__( 'Light', 'newsy' ),
					'light-box'    => esc_html__( 'Light Box', 'newsy' ),
					'dark'         => esc_html__( 'Dark', 'newsy' ),
				),
			),
			array(
				'heading'     => esc_html__( 'Social Icons Background Color', 'newsy' ),
				'description' => esc_html__( 'Override Icon Background Color.', 'newsy' ),
				'id'          => $_place . 'social_icons_bg_color',
				'type'        => 'color',
				'section'     => $section,
				'output'      => array(
					array(
						'type'     => 'css',
						'element'  => '.ak-' . $place . '-social-icons .ak-social-counter:not(.social-counter-light) .social-item > a > .item-icon',
						'property' => 'background',
					),
				),
			),
			array(
				'heading'     => esc_html__( 'Social Icons Color', 'newsy' ),
				'description' => esc_html__( 'Override Icon Color.', 'newsy' ),
				'id'          => $_place . 'social_icons_color',
				'type'        => 'color',
				'section'     => $section,
				'output'      => array(
					array(
						'type'     => 'css',
						'element'  => '.ak-' . $place . '-social-icons .ak-social-counter .social-item > a > .item-icon',
						'property' => 'color',
					),
				),
			),
		);

		return apply_filters( 'newsy_social_icons_fields', $fields );
	}
}

if ( ! function_exists( 'newsy_get_button_fields' ) ) {
	/**
	 * Get the button field options.
	 *
	 * @return array
	 */
	function newsy_get_button_fields( $place, $selector ) {
		$fields = array(
			array(
				'id'          => 'text',
				'type'        => 'text',
				'heading'     => esc_html__( 'Button Text', 'newsy' ),
				'input_attrs' => array(
					'placeholder' => 'Your text',
				),
			),
			array(
				'id'           => 'icon',
				'type'         => 'icon_select',
				'heading'      => esc_html__( 'Button Icon', 'newsy' ),
				'default_text' => esc_html__( 'Chose an Icon', 'newsy' ),
			),
			array(
				'id'          => 'link',
				'type'        => 'text',
				'heading'     => esc_html__( 'Button Link', 'newsy' ),
				'input_attrs' => array(
					'placeholder' => '#',
				),
			),
			array(
				'id'      => 'target',
				'type'    => 'radio_button',
				'heading' => esc_html__( 'Button Target', 'newsy' ),
				'options' => array(
					''        => esc_html__( 'Blank', 'newsy' ),
					'_self'   => esc_html__( 'Self', 'newsy' ),
					'_parent' => esc_html__( 'Parent', 'newsy' ),
				),
			),
			array(
				'id'          => 'style',
				'type'        => 'radio_button',
				'heading'     => esc_html__( 'Button Style', 'newsy' ),
				'description' => esc_html__( 'Choose button style.', 'newsy' ),
				'options'     => array(
					''        => esc_html__( 'Default', 'newsy' ),
					'round'   => esc_html__( 'Round', 'newsy' ),
					'rounded' => esc_html__( 'Rounded', 'newsy' ),
					'outline' => esc_html__( 'Outline', 'newsy' ),
				),
			),
			array(
				'id'      => 'bg_color',
				'type'    => 'color',
				'heading' => esc_html__( 'Background Color', 'newsy' ),
				'output'  => array(
					array(
						'type'     => 'css',
						'element'  => $selector . ' .btn',
						'property' => 'background-color',
					),
				),
			),
			array(
				'id'      => 'bg_hover_color',
				'type'    => 'color',
				'heading' => esc_html__( 'Background Hover Color', 'newsy' ),
				'output'  => array(
					array(
						'type'     => 'css',
						'element'  => $selector . ' .btn:hover, ' . $selector . ' .btn:focus',
						'property' => 'background-color',
					),
				),
			),
			array(
				'id'      => 'color',
				'type'    => 'color',
				'heading' => esc_html__( 'Text Color', 'newsy' ),
				'output'  => array(
					array(
						'type'     => 'css',
						'element'  => $selector . ' .btn',
						'property' => 'color',
					),
				),
			),
			array(
				'id'      => 'hover_color',
				'type'    => 'color',
				'heading' => esc_html__( 'Text Hover Color', 'newsy' ),
				'output'  => array(
					array(
						'type'     => 'css',
						'element'  => $selector . ' .btn:hover',
						'property' => 'color',
					),
				),
			),
			array(
				'id'      => 'border_color',
				'type'    => 'color',
				'heading' => esc_html__( 'Border Color', 'newsy' ),
				'output'  => array(
					array(
						'type'     => 'css',
						'element'  => $selector . ' .btn',
						'property' => 'border-color',
					),
				),
			),
			array(
				'id'      => 'border_hover_color',
				'type'    => 'color',
				'heading' => esc_html__( 'Border Hover Color', 'newsy' ),
				'output'  => array(
					array(
						'type'     => 'css',
						'element'  => $selector . ' .btn:hover',
						'property' => 'border-color',
					),
				),
			),
			array(
				'id'          => 'login',
				'type'        => 'switcher',
				'heading'     => esc_html__( 'Require Login?', 'newsy' ),
				'description' => esc_html__( 'Clicking this button will require user login.', 'newsy' ),
				'options'     => array(
					'off' => '',
					'on'  => 'yes',
				),
			),
		);

		return apply_filters( 'newsy_button_fields', $fields, $place, $selector );
	}
}

if ( ! function_exists( 'newsy_get_create_button_fields' ) ) {
	/**
	 * Get the create button field options.
	 *
	 * @return array
	 */
	function newsy_get_create_button_fields( $place, $selector ) {
		$fields          = newsy_get_button_fields( $place, $selector );
		$filtered_fields = array( 'link', 'login' );

		foreach ( $fields as $key => $field ) {
			if ( in_array( $field['id'], $filtered_fields, true ) ) {
				unset( $fields[ $key ] );
			}
		}

		return $fields;
	}
}

if ( ! function_exists( 'newsy_get_login_button_fields' ) ) {
	/**
	 * Get the login button field options.
	 *
	 * @return array
	 */
	function newsy_get_login_button_fields( $place, $selector ) {
		$fields          = newsy_get_button_fields( $place, $selector );
		$filtered_fields = array( 'link', 'target', 'login' );

		foreach ( $fields as $key => $field ) {
			if ( in_array( $field['id'], $filtered_fields, true ) ) {
				unset( $fields[ $key ] );
			}
		}

		return $fields;
	}
}


if ( ! function_exists( 'newsy_get_ad_fields' ) ) {
	/**
	 * Get the ad field options.
	 *
	 * @return array
	 */
	function newsy_get_ad_fields( $ad = '' ) {
		if ( ! function_exists( 'newsy_get_block_ad_fields' ) ) {
			return array(
				newsy_get_plugin_required_info_field( 'Newsy Elements' ),
			);
		}

		$fields = newsy_get_block_ad_fields( $ad );

		return apply_filters( 'newsy_ad_fields', $fields );
	}
}

if ( ! function_exists( 'newsy_get_grid_fields' ) ) {
	/**
	 * Get the grid field options.
	 *
	 * @return array
	 */
	function newsy_get_grid_fields( $template = '', $section = '', $default = true ) {
		if ( ! defined( 'NEWSY_ELEMENTS_PATH' ) ) {
			return array(
				newsy_get_plugin_required_info_field( 'Newsy Elements', $section ),
			);
		}

		if ( ! empty( $template ) ) {
			$template .= '_';
		}

		$default_grid = $default ? '' : 'newsy_grid_1';

		$fields = array(
			array(
				'heading'          => esc_html__( 'Grid Style', 'newsy' ),
				'description'      => esc_html__( 'Select grid style.', 'newsy' ),
				'id'               => $template . 'grid',
				'type'             => 'radio_image',
				'default'          => $default_grid,
				'options_callback' => array(
					'function' => 'newsy_get_archive_grid_options',
					'args'     => array( $default ),
				),
				'section'          => $section,
			),
			array(
				'heading'          => esc_html__( 'Grid Overlay Gradient', 'newsy' ),
				'description'      => esc_html__( 'Select grid overlay style.', 'newsy' ),
				'id'               => $template . 'grid_gradient',
				'type'             => 'select',
				'selectize'        => false,
				'options_callback' => 'newsy_get_grid_overlay_styles',
				'section'          => $section,
				'dependency'       => array(
					'element'  => $template . 'grid',
					'value'    => array( '', 'hide' ),
					'operator' => 'not_in',
				),
			),
			array(
				'heading'     => esc_html__( 'Grid Item Margin', 'newsy' ),
				'description' => esc_html__( 'Select grid items space size.', 'newsy' ),
				'id'          => $template . 'grid_item_margin',
				'type'        => 'slider',
				'max'         => 100,
				'section'     => $section,
				'dependency'  => array(
					'element'  => $template . 'grid',
					'value'    => array( '', 'hide' ),
					'operator' => 'not_in',
				),
			),
			array(
				'heading'     => esc_html__( 'Grid Height', 'newsy' ),
				'description' => esc_html__( 'Select grid height.', 'newsy' ),
				'id'          => $template . 'grid_height',
				'type'        => 'slider',
				'max'         => 1000,
				'section'     => $section,
				'dependency'  => array(
					'element'  => $template . 'grid',
					'value'    => array( '', 'hide' ),
					'operator' => 'not_in',
				),
			),
			array(
				'heading'     => esc_html__( 'Grid Full Width', 'newsy' ),
				'id'          => $template . 'grid_full',
				'description' => esc_html__( 'When possible grid will use full-width container.', 'newsy' ),
				'type'        => 'select',
				'selectize'   => false,
				'options'     => array(
					''    => esc_html__( 'Default', 'newsy' ),
					'on'  => esc_html__( 'Yes', 'newsy' ),
					'off' => esc_html__( 'No', 'newsy' ),
				),
				'section'     => $section,
				'dependency'  => array(
					'element'  => $template . 'grid',
					'value'    => array( '', 'hide' ),
					'operator' => 'not_in',
				),
			),
			array(
				'heading'          => esc_html__( 'Grid Block Extra Classes', 'newsy' ),
				'description'      => esc_html__( 'Select block extra classes. Ex: You can set boxed style block or dark style block with these predefined classes or you can add custom CSS classes.', 'newsy' ),
				'id'               => $template . 'grid_block_classes',
				'type'             => 'text',
				'selectize'        => true,
				'delimiter'        => ' ',
				'options_callback' => 'newsy_get_block_supported_classes',
				'section'          => $section,
				'dependency'       => array(
					'element'  => $template . 'grid',
					'value'    => array( '', 'hide' ),
					'operator' => 'not_in',
				),
			),

		);

		return apply_filters( 'newsy_grid_fields', $fields, $template, $section );
	}
}

if ( ! function_exists( 'newsy_get_list_fields' ) ) {
	/**
	 * Get the loop field options.
	 *
	 * @return array
	 */
	function newsy_get_list_fields( $template = '', $section = '', $default = true ) {
		if ( ! defined( 'NEWSY_ELEMENTS_PATH' ) ) {
			return array(
				newsy_get_plugin_required_info_field( 'Newsy Elements', $section ),
			);
		}

		if ( ! empty( $template ) ) {
			$template .= '_';
		}

		$default_list = $default ? '' : 'newsy_list_1_medium';

		$fields = array(
			array(
				'heading'          => esc_html__( 'List Style', 'newsy' ),
				'description'      => esc_html__( 'Select list block style.', 'newsy' ),
				'id'               => $template . 'loop',
				'type'             => 'radio_image',
				'default'          => $default_list,
				'options_callback' => array(
					'function' => 'newsy_get_archive_list_options',
					'args'     => array( $default ),
				),
				'section'          => $section,
			),
			array(
				'heading'     => esc_html__( 'List Post Count', 'newsy' ),
				'description' => esc_html__( 'Override posts count. Default is value at Settings > Reading', 'newsy' ),
				'id'          => $template . 'loop_posts_count',
				'type'        => 'number',
				'section'     => $section,
				'input_attrs' => array(
					'placeholder' => ! empty( $template ) ? get_option( 'posts_per_page' ) : newsy_get_option( 'site_loop_posts_count' ),
				),
				'dependency'  => array(
					'element'  => $template . 'loop',
					'value'    => array( '' ),
					'operator' => 'not_in',
				),
			),
			array(
				'heading'     => esc_html__( 'List Pagination', 'newsy' ),
				'description' => esc_html__( 'Select pagination type for this template.', 'newsy' ),
				'id'          => $template . 'loop_pagination',
				'type'        => 'select',
				'selectize'   => false,
				'options'     => array(
					''          => esc_html__( 'Default', 'newsy' ),
					'simple'    => esc_html__( 'Simple Pagination', 'newsy' ),
					'load_more' => esc_html__( 'Ajax Load more', 'newsy' ),
					'infinity'  => esc_html__( 'Infinity loading', 'newsy' ),
					'next_prev' => esc_html__( 'Ajax Next Prev', 'newsy' ),
					'hide'      => esc_html__( 'No Pagination', 'newsy' ),
				),
				'section'     => $section,
				'dependency'  => array(
					'element'  => $template . 'loop',
					'value'    => array( '' ),
					'operator' => 'not_in',
				),
			),
			array(
				'heading'     => esc_html__( 'List Block Columns', 'newsy' ),
				'description' => esc_html__( 'Select block columns size for supported posts block.', 'newsy' ),
				'id'          => $template . 'block_width',
				'type'        => 'select',
				'selectize'   => false,
				'options'     => array(
					''  => esc_html__( 'Auto', 'newsy' ),
					'2' => esc_html__( '2 Column', 'newsy' ),
					'3' => esc_html__( '3 Column', 'newsy' ),
					'4' => esc_html__( '4 Column', 'newsy' ),
					'5' => esc_html__( '5 Column', 'newsy' ),
				),
				'section'     => $section,
				'dependency'  => array(
					'element'  => $template . 'loop',
					'value'    => array( '' ),
					'operator' => 'not_in',
				),
			),
			array(
				'heading'     => esc_html__( 'List Item Margin', 'newsy' ),
				'description' => esc_html__( 'Select loop block items space size.', 'newsy' ),
				'id'          => $template . 'loop_item_margin',
				'type'        => 'slider',
				'default'     => 30,
				'max'         => 50,
				'section'     => $section,
				'dependency'  => array(
					'element'  => $template . 'loop',
					'value'    => array( '' ),
					'operator' => 'not_in',
				),
			),
			array(
				'heading'          => esc_html__( 'List Block Extra Classes', 'newsy' ),
				'description'      => esc_html__( 'Select block extra classes. Ex: You can set boxed style block or dark style block with these predefined classes or you can add custom CSS classes.', 'newsy' ),
				'id'               => $template . 'block_classes',
				'type'             => 'text',
				'selectize'        => true,
				'delimiter'        => ' ',
				'options_callback' => 'newsy_get_block_supported_classes',
				'section'          => $section,
				'dependency'       => array(
					'element'  => $template . 'loop',
					'value'    => array( '' ),
					'operator' => 'not_in',
				),
			),
			array(
				'id'          => $template . 'loop_custom_enabled',
				'type'        => 'switcher',
				'heading'     => esc_html__( 'List Override Parts?', 'newsy' ),
				'description' => esc_html__( 'Override loop parts for selected loop style above. This option will override selected loop style on "Modules" tab.', 'newsy' ),
				'options'     => array(
					'off' => '',
					'on'  => 'yes',
				),
				'section'     => $section,
				'dependency'  => array(
					'element'  => $template . 'loop',
					'value'    => array( '' ),
					'operator' => 'not_in',
				),
			),
			array(
				'id'              => $template . 'loop_custom_parts',
				'type'            => 'mix_fields',
				'heading'         => 'Show Listing Parts',
				'fields_callback' => 'newsy_get_module_fields',
				'section'         => $section,
				'dependency'      => array(
					'element' => $template . 'loop_custom_enabled',
					'value'   => array( 'yes' ),
				),
			),
		);

		return apply_filters( 'newsy_list_fields', $fields, $template, $section );
	}
}

if ( ! function_exists( 'newsy_get_demo_images_url' ) ) {
	/**
	 * Used to get demo images url
	 *
	 * @param string $demo_id
	 *
	 * @return array
	 */
	function newsy_get_demo_media_url( $demo_id = '' ) {
		$demo_image_url = apply_filters( 'newsy_demo_import_url', 'https://cdn.akbilisim.com/products/newsy/demos/' );

		return $demo_image_url . $demo_id . '/import/';
	}
}

if ( ! function_exists( 'newsy_remove_vc_redirect' ) ) {
	function newsy_remove_vc_redirect() {
		set_transient( '_vc_page_welcome_redirect', 0, 30 );
	}
	add_action( 'vc_activation_hook', 'newsy_remove_vc_redirect', 999 );
}
