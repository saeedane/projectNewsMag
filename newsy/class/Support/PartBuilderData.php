<?php

namespace Newsy\Support;

class PartBuilderData {

	public static function get_builder_data() {
		return array(
			'builder_header_desktop' => array(
				'name'     => esc_html__( 'Header Bars', 'newsy' ),
				'elements' => self::desktop_elements(),
			),
			'builder_header_sticky'  => array(
				'name'     => esc_html__( 'Sticky Bar', 'newsy' ),
				'elements' => self::desktop_sticky_elements(),
			),
			'builder_post_sticky'    => array(
				'name'     => esc_html__( 'Post Sticky Bar', 'newsy' ),
				'elements' => self::desktop_post_sticky_elements(),
			),
			'builder_header_mobile'  => array(
				'name'     => esc_html__( 'Mobile Bar', 'newsy' ),
				'elements' => self::mobile_elements(),
			),
			'builder_drawer'         => array(
				'name'     => esc_html__( 'Side Bar', 'newsy' ),
				'elements' => self::drawer_elements(),
			),
			'builder_footer'         => array(
				'name'     => esc_html__( 'Footer Bars', 'newsy' ),
				'elements' => self::footer_elements(),
			),
			'part_defaults'          => array(
				'builder_header_desktop' => self::builder_header_desktop_defaults(),
				'builder_header_sticky'  => self::builder_header_sticky_defaults(),
				'builder_header_mobile'  => self::builder_header_mobile_defaults(),
				'builder_drawer'         => self::builder_drawer_defaults(),
				'builder_footer'         => self::builder_footer_defaults(),
				'builder_post_sticky'    => self::builder_post_sticky_defaults(),
			),
		);

	}

	public static function get_header_desktop_fields() {
		return array(
			array(
				'id'              => 'order',
				'type'            => 'select',
				'heading'         => esc_html__( 'Order', 'newsy' ),
				'container_class' => 'control-heading-full',
				'multiple'        => 3,
				'return_string'   => false,
				'options'         => array(
					'top'    => esc_html__( 'Top', 'newsy' ),
					'mid'    => esc_html__( 'Mid', 'newsy' ),
					'bottom' => esc_html__( 'Bottom', 'newsy' ),
				),
			),
			array(
				'id'              => 'top',
				'type'            => 'mix_fields',
				'heading'         => esc_html__( 'Top Row', 'newsy' ),
				'container_class' => 'control-heading-full',
				'fields'          => self::get_row_fields( 'builder_header_desktop', 'top' ),
			),
			array(
				'id'              => 'mid',
				'type'            => 'mix_fields',
				'heading'         => esc_html__( 'Mid Row', 'newsy' ),
				'container_class' => 'control-heading-full',
				'fields'          => self::get_row_fields( 'builder_header_desktop', 'mid' ),
			),

			array(
				'id'              => 'bottom',
				'type'            => 'mix_fields',
				'heading'         => esc_html__( 'Bottom Row', 'newsy' ),
				'container_class' => 'control-heading-full',
				'fields'          => self::get_row_fields( 'builder_header_desktop', 'bottom' ),
			),
		);
	}


	public static function get_header_sticky_fields() {
		return array(
			array(
				'id'              => 'order',
				'type'            => 'select',
				'heading'         => esc_html__( 'Order', 'newsy' ),
				'container_class' => 'control-heading-full',
				'multiple'        => 3,
				'return_string'   => false,
				'options'         => array(
					'sticky' => esc_html__( 'Sticky Row', 'newsy' ),
				),
			),
			array(
				'id'              => 'sticky',
				'type'            => 'mix_fields',
				'heading'         => esc_html__( 'Sticky Row', 'newsy' ),
				'container_class' => 'control-heading-full',
				'fields'          => self::get_row_fields( 'builder_header_sticky', 'sticky' ),
			),
		);
	}

	public static function get_post_sticky_fields() {
		return array(
			array(
				'id'              => 'order',
				'type'            => 'select',
				'heading'         => esc_html__( 'Order', 'newsy' ),
				'container_class' => 'control-heading-full',
				'multiple'        => 3,
				'return_string'   => false,
				'options'         => array(
					'sticky' => esc_html__( 'Post Sticky Row', 'newsy' ),
				),
			),
			array(
				'id'              => 'sticky',
				'type'            => 'mix_fields',
				'heading'         => esc_html__( 'Post Sticky Row', 'newsy' ),
				'container_class' => 'control-heading-full',
				'fields'          => self::get_row_fields( 'builder_post_sticky', 'sticky' ),
			),
		);
	}

	public static function get_header_mobile_fields() {
		return array(
			array(
				'id'              => 'order',
				'type'            => 'select',
				'heading'         => esc_html__( 'Order', 'newsy' ),
				'container_class' => 'control-heading-full',
				'multiple'        => 3,
				'return_string'   => false,
				'options'         => array(
					'mobile'      => esc_html__( 'Mobile Row', 'newsy' ),
					'mobile_menu' => esc_html__( 'Mobile Menu Row', 'newsy' ),
				),
			),
			array(
				'id'              => 'mobile',
				'type'            => 'mix_fields',
				'heading'         => esc_html__( 'Mobile Row', 'newsy' ),
				'container_class' => 'control-heading-full',
				'fields'          => self::get_row_fields( 'builder_header_mobile', 'mobile' ),
			),
			array(
				'id'              => 'mobile_menu',
				'type'            => 'mix_fields',
				'heading'         => esc_html__( 'Mobile Menu Row', 'newsy' ),
				'container_class' => 'control-heading-full',
				'fields'          => self::get_row_fields( 'builder_header_mobile', 'mobile_menu' ),
			),
		);
	}

	public static function get_drawer_fields() {
		return array(
			array(
				'id'              => 'order',
				'type'            => 'select',
				'heading'         => esc_html__( 'Order', 'newsy' ),
				'container_class' => 'control-heading-full',
				'multiple'        => 3,
				'return_string'   => false,
				'options'         => array(
					'drawer' => esc_html__( 'Drawer Row', 'newsy' ),
				),
			),
			array(
				'id'              => 'drawer',
				'type'            => 'mix_fields',
				'heading'         => esc_html__( 'Drawer Row', 'newsy' ),
				'container_class' => 'control-heading-full',
				'fields'          => self::get_row_fields( 'builder_drawer', 'drawer' ),
			),
		);
	}

	public static function get_footer_fields() {
		return array(
			array(
				'id'              => 'order',
				'type'            => 'select',
				'heading'         => esc_html__( 'Order', 'newsy' ),
				'container_class' => 'control-heading-full',
				'multiple'        => 3,
				'return_string'   => false,
				'options'         => array(
					'top'    => esc_html__( 'Top', 'newsy' ),
					'mid'    => esc_html__( 'Mid', 'newsy' ),
					'bottom' => esc_html__( 'Bottom', 'newsy' ),
				),
			),
			array(
				'id'              => 'top',
				'type'            => 'mix_fields',
				'heading'         => esc_html__( 'Top Row', 'newsy' ),
				'container_class' => 'control-heading-full',
				'fields'          => self::get_row_fields( 'builder_footer', 'top' ),
			),
			array(
				'id'              => 'mid',
				'type'            => 'mix_fields',
				'heading'         => esc_html__( 'Mid Row', 'newsy' ),
				'container_class' => 'control-heading-full',
				'fields'          => self::get_row_fields( 'builder_footer', 'mid' ),
			),

			array(
				'id'              => 'bottom',
				'type'            => 'mix_fields',
				'heading'         => esc_html__( 'Bottom Row', 'newsy' ),
				'container_class' => 'control-heading-full',
				'fields'          => self::get_row_fields( 'builder_footer', 'bottom' ),
			),
		);
	}

	public static function get_row_fields( $id, $row ) {
		$fields = array(
			array(
				'id'              => 'scheme',
				'type'            => 'select',
				'heading'         => esc_html__( 'Scheme', 'newsy' ),
				'options'         => array(
					''     => esc_html__( 'Light', 'newsy' ),
					'dark' => esc_html__( 'Dark', 'newsy' ),
				),
				'selectize'       => false,
				'container_class' => 'control-heading-full',
			),
			array(
				'id'              => 'layout',
				'type'            => 'select',
				'heading'         => esc_html__( 'Layout', 'newsy' ),
				'options'         => array(
					''          => esc_html__( 'Normal', 'newsy' ),
					'stretched' => esc_html__( 'Stretched', 'newsy' ),
					'boxed'     => esc_html__( 'Boxed', 'newsy' ),
				),
				'selectize'       => false,
				'container_class' => 'control-heading-full',
			),
			array(
				'id'              => 'left',
				'type'            => 'mix_fields',
				'heading'         => esc_html__( 'left', 'newsy' ),
				'container_class' => 'control-heading-full',
				'fields'          => self::get_row_column_fields( $id, $row, 'left' ),
			),
			array(
				'id'              => 'center',
				'type'            => 'mix_fields',
				'heading'         => esc_html__( 'center', 'newsy' ),
				'container_class' => 'control-heading-full',
				'fields'          => self::get_row_column_fields( $id, $row, 'center' ),
			),
			array(
				'id'              => 'right',
				'type'            => 'mix_fields',
				'heading'         => esc_html__( 'right', 'newsy' ),
				'container_class' => 'control-heading-full',
				'fields'          => self::get_row_column_fields( $id, $row, 'right' ),
			),
		);

		return apply_filters( 'newsy_builder_row_fields', $fields, $id );
	}

	public static function get_row_column_fields( $id, $row, $column ) {
		$elements = self::get_builder_data();

		$fields = array(
			array(
				'id'              => 'layout',
				'type'            => 'select',
				'heading'         => esc_html__( 'Layout', 'newsy' ),
				'container_class' => 'control-heading-full',
				'options'         => array(
					'grow'   => esc_html__( 'Grow', 'newsy' ),
					'normal' => esc_html__( 'Normal', 'newsy' ),
				),
				'default'         => 'center' === $column ? 'normal' : 'grow',
				'selectize'       => false,
				'field_col'       => 3,
			),
			array(
				'id'              => 'align',
				'type'            => 'select',
				'heading'         => esc_html__( 'align', 'newsy' ),
				'container_class' => 'control-heading-full',
				'options'         => array(
					'left'   => esc_html__( 'Left', 'newsy' ),
					'center' => esc_html__( 'Center', 'newsy' ),
					'right'  => esc_html__( 'Right', 'newsy' ),
				),
				'default'         => $column,
				'selectize'       => false,
				'field_col'       => 3,
			),
			array(
				'id'              => 'items',
				'type'            => 'select',
				'multiple'        => 100,
				'return_string'   => false,
				'options'         => $elements[ $id ]['elements'],
				'heading'         => esc_html__( 'Items', 'newsy' ),
				'container_class' => 'control-heading-full',
				'field_col'       => 3,
			),
		);

		return apply_filters( 'newsy_builder_row_column_fields', $fields, $row, $column, $id );
	}

	public static function desktop_elements() {
		$elements = array(
			'logo'          => esc_html__( 'Logo', 'newsy' ),
			'date'          => esc_html__( 'Date', 'newsy' ),
			'search'        => esc_html__( 'Search Icon', 'newsy' ),
			'shop'          => esc_html__( 'Shop Icon', 'newsy' ),
			'search_form'   => esc_html__( 'Search Form', 'newsy' ),
			'social_icons'  => esc_html__( 'Social Icons', 'newsy' ),
			'user'          => esc_html__( 'Login Icon', 'newsy' ),
			'user_button'   => esc_html__( 'Login Button', 'newsy' ),
			'bookmark'      => esc_html__( 'Bookmarks', 'newsy' ),
			'top_menu'      => esc_html__( 'Top Menu', 'newsy' ),
			'main_menu'     => esc_html__( 'Main Menu', 'newsy' ),
			'menu_handler'  => esc_html__( 'Menu Handler', 'newsy' ),
			'language'      => esc_html__( 'Language', 'newsy' ),
			'button_create' => esc_html__( 'Create Button', 'newsy' ),
			'button1'       => esc_html__( 'Button 1', 'newsy' ),
			'button2'       => esc_html__( 'Button 2', 'newsy' ),
			'button3'       => esc_html__( 'Button 3', 'newsy' ),
			'home_button'   => esc_html__( 'Home Button', 'newsy' ),
			'divider1'      => esc_html__( '|', 'newsy' ),
			'divider2'      => esc_html__( '|', 'newsy' ),
			'divider3'      => esc_html__( '|', 'newsy' ),
			'divider4'      => esc_html__( '|', 'newsy' ),
			'divider5'      => esc_html__( '|', 'newsy' ),
			'ad1'           => esc_html__( 'Header Ad 1', 'newsy' ),
			'ad2'           => esc_html__( 'Header Ad 2', 'newsy' ),
			'badge_menu'    => esc_html__( 'Badge Icons', 'newsy' ),
			'newsticker'    => esc_html__( 'Newsticker', 'newsy' ),
			'dark_mode'     => esc_html__( 'Dark Mode', 'newsy' ),
			'nsfw_toggle'   => esc_html__( 'NSFW Toggle', 'newsy' ),
			'custom_menu1'  => esc_html__( 'Custom Menu 1', 'newsy' ),
			'custom_menu2'  => esc_html__( 'Custom Menu 2', 'newsy' ),
			'custom_menu3'  => esc_html__( 'Custom Menu 3', 'newsy' ),
			'html1'         => esc_html__( 'HTML Element 1', 'newsy' ),
			'html2'         => esc_html__( 'HTML Element 2', 'newsy' ),
			'html3'         => esc_html__( 'HTML Element 3', 'newsy' ),
			'html4'         => esc_html__( 'HTML Element 4', 'newsy' ),
			'html5'         => esc_html__( 'HTML Element 5', 'newsy' ),
		);

		return apply_filters( 'newsy_builder_desktop_elements', $elements );
	}

	public static function desktop_sticky_elements() {
		$elements = array(
			'logo'          => esc_html__( 'Logo', 'newsy' ),
			'mobile_logo'   => esc_html__( 'Mobile Logo', 'newsy' ),
			'sticky_logo'   => esc_html__( 'Sticky Logo', 'newsy' ),
			'top_menu'      => esc_html__( 'Top Menu', 'newsy' ),
			'main_menu'     => esc_html__( 'Main Menu', 'newsy' ),
			'user'          => esc_html__( 'Login Icon', 'newsy' ),
			'user_button'   => esc_html__( 'Login Button', 'newsy' ),
			'menu_handler'  => esc_html__( 'Menu Handler', 'newsy' ),
			'search'        => esc_html__( 'Search Icon', 'newsy' ),
			'shop'          => esc_html__( 'Shop Icon', 'newsy' ),
			'search_form'   => esc_html__( 'Search Form', 'newsy' ),
			'social_icons'  => esc_html__( 'Social Icons', 'newsy' ),
			'button_create' => esc_html__( 'Create Button', 'newsy' ),
			'button1'       => esc_html__( 'Button 1', 'newsy' ),
			'button2'       => esc_html__( 'Button 2', 'newsy' ),
			'button3'       => esc_html__( 'Button 3', 'newsy' ),
			'home_button'   => esc_html__( 'Home Button', 'newsy' ),
			'custom_menu1'  => esc_html__( 'Custom Menu 1', 'newsy' ),
			'custom_menu2'  => esc_html__( 'Custom Menu 2', 'newsy' ),
			'custom_menu3'  => esc_html__( 'Custom Menu 3', 'newsy' ),
			'html1'         => esc_html__( 'HTML Element 1', 'newsy' ),
			'html2'         => esc_html__( 'HTML Element 2', 'newsy' ),
			'html3'         => esc_html__( 'HTML Element 3', 'newsy' ),
			'html4'         => esc_html__( 'HTML Element 4', 'newsy' ),
			'html5'         => esc_html__( 'HTML Element 5', 'newsy' ),
			'bookmark'      => esc_html__( 'Bookmarks', 'newsy' ),
			'badge_menu'    => esc_html__( 'Badge Icons', 'newsy' ),
			'dark_mode'     => esc_html__( 'Dark Mode', 'newsy' ),
			'nsfw_toggle'   => esc_html__( 'NSFW Toggle', 'newsy' ),
		);

		return apply_filters( 'newsy_builder_sticky_elements', $elements );
	}

	public static function mobile_elements() {
		$elements = array(
			'logo'             => esc_html__( 'Logo', 'newsy' ),
			'mobile_logo'      => esc_html__( 'Mobile Logo', 'newsy' ),
			'mobile_menu_wide' => esc_html__( 'Mobile Menu', 'newsy' ),
			'user'             => esc_html__( 'Login Icon', 'newsy' ),
			'menu_handler'     => esc_html__( 'Menu Handler', 'newsy' ),
			'search'           => esc_html__( 'Search Icon', 'newsy' ),
			'shop'             => esc_html__( 'Shop Icon', 'newsy' ),
			'language'         => esc_html__( 'Language', 'newsy' ),
			'social_icons'     => esc_html__( 'Social Icons', 'newsy' ),
			'button_create'    => esc_html__( 'Create Button', 'newsy' ),
			'button1'          => esc_html__( 'Button 1', 'newsy' ),
			'button2'          => esc_html__( 'Button 2', 'newsy' ),
			'button3'          => esc_html__( 'Button 3', 'newsy' ),
			'home_button'      => esc_html__( 'Home Button', 'newsy' ),
			'html1'            => esc_html__( 'HTML Element 1', 'newsy' ),
			'html2'            => esc_html__( 'HTML Element 2', 'newsy' ),
			'html3'            => esc_html__( 'HTML Element 3', 'newsy' ),
			'html4'            => esc_html__( 'HTML Element 4', 'newsy' ),
			'html5'            => esc_html__( 'HTML Element 5', 'newsy' ),
			'custom_menu1'     => esc_html__( 'Custom Menu 1', 'newsy' ),
			'custom_menu2'     => esc_html__( 'Custom Menu 2', 'newsy' ),
			'custom_menu3'     => esc_html__( 'Custom Menu 3', 'newsy' ),
			'bookmark'         => esc_html__( 'Bookmarks', 'newsy' ),
			'dark_mode'        => esc_html__( 'Dark Mode', 'newsy' ),
			'nsfw_toggle'      => esc_html__( 'NSFW Toggle', 'newsy' ),
		);

		return apply_filters( 'newsy_builder_mobile_elements', $elements );
	}

	public static function drawer_elements() {
		$elements = array(
			'logo'             => esc_html__( 'Logo', 'newsy' ),
			'mobile_logo'      => esc_html__( 'Mobile Logo', 'newsy' ),
			'mobile_menu'      => esc_html__( 'Mobile Menu', 'newsy' ),
			'search_form'      => esc_html__( 'Search Form', 'newsy' ),
			'social_icons'     => esc_html__( 'Social Icons', 'newsy' ),
			'language'         => esc_html__( 'Language', 'newsy' ),
			'badge_menu'       => esc_html__( 'Badge Icons', 'newsy' ),
			'button_create'    => esc_html__( 'Create Button', 'newsy' ),
			'button1'          => esc_html__( 'Button 1', 'newsy' ),
			'button2'          => esc_html__( 'Button 2', 'newsy' ),
			'button3'          => esc_html__( 'Button 3', 'newsy' ),
			'top_menu'         => esc_html__( 'Top Menu', 'newsy' ),
			'custom_menu1'     => esc_html__( 'Custom Menu 1', 'newsy' ),
			'custom_menu2'     => esc_html__( 'Custom Menu 2', 'newsy' ),
			'custom_menu3'     => esc_html__( 'Custom Menu 3', 'newsy' ),
			'html1'            => esc_html__( 'HTML Element 1', 'newsy' ),
			'html2'            => esc_html__( 'HTML Element 2', 'newsy' ),
			'html3'            => esc_html__( 'HTML Element 3', 'newsy' ),
			'html4'            => esc_html__( 'HTML Element 4', 'newsy' ),
			'html5'            => esc_html__( 'HTML Element 5', 'newsy' ),
			'footer_copyright' => esc_html__( 'Footer Copyright', 'newsy' ),
			'dark_mode'        => esc_html__( 'Dark Mode', 'newsy' ),
			'nsfw_toggle'      => esc_html__( 'NSFW Toggle', 'newsy' ),
		);

		return apply_filters( 'newsy_builder_drawer_elements', $elements );
	}

	public static function footer_elements() {
		$elements = array(
			'logo'                => esc_html__( 'Logo', 'newsy' ),
			'footer_logo'         => esc_html__( 'Footer Logo', 'newsy' ),
			'footer_menu'         => esc_html__( 'Footer Menu', 'newsy' ),
			'footer_copyright'    => esc_html__( 'Footer Copyright', 'newsy' ),
			'footer_social_icons' => esc_html__( 'Social Icons', 'newsy' ),
			'footer_widgets'      => esc_html__( 'Footer Widgets', 'newsy' ),
			'footer_widget1'      => esc_html__( 'Footer Widget 1', 'newsy' ),
			'footer_widget2'      => esc_html__( 'Footer Widget 2', 'newsy' ),
			'footer_widget3'      => esc_html__( 'Footer Widget 3', 'newsy' ),
			'footer_button1'      => esc_html__( 'Button 1', 'newsy' ),
			'footer_button2'      => esc_html__( 'Button 2', 'newsy' ),
			'footer_ad1'          => esc_html__( 'Footer Ad 1', 'newsy' ),
			'footer_ad2'          => esc_html__( 'Footer Ad 2', 'newsy' ),
			'divider1'            => esc_html__( '|', 'newsy' ),
			'divider2'            => esc_html__( '|', 'newsy' ),
			'divider3'            => esc_html__( '|', 'newsy' ),
			'footer_html1'        => esc_html__( 'HTML Element 1', 'newsy' ),
			'footer_html2'        => esc_html__( 'HTML Element 2', 'newsy' ),
			'footer_html3'        => esc_html__( 'HTML Element 3', 'newsy' ),
			'language'            => esc_html__( 'Language', 'newsy' ),
		);

		return apply_filters( 'newsy_builder_footer_elements', $elements );
	}

	public static function desktop_post_sticky_elements() {
		$elements = array(
			'post_title'   => esc_html__( 'Post Title', 'newsy' ),
			'post_share'   => esc_html__( 'Post Share Icons', 'newsy' ),
			'post_badges'  => esc_html__( 'Post Badges', 'newsy' ),
			'logo'         => esc_html__( 'Logo', 'newsy' ),
			'mobile_logo'  => esc_html__( 'Mobile Logo', 'newsy' ),
			'menu_handler' => esc_html__( 'Menu Handler', 'newsy' ),
			'search'       => esc_html__( 'Search Icon', 'newsy' ),
			'shop'         => esc_html__( 'Shop Icon', 'newsy' ),
			'button1'      => esc_html__( 'Button 1', 'newsy' ),
			'button2'      => esc_html__( 'Button 2', 'newsy' ),
			'button3'      => esc_html__( 'Button 3', 'newsy' ),
			'home_button'  => esc_html__( 'Home Button', 'newsy' ),
			'divider1'     => esc_html__( '|', 'newsy' ),
			'divider2'     => esc_html__( '|', 'newsy' ),
			'divider3'     => esc_html__( '|', 'newsy' ),
		);

		return apply_filters( 'newsy_builder_post_sticky_elements', $elements );
	}

	public static function builder_row_defaults() {
		return array(
			'scheme' => '',
			'layout' => '',
			'left'   => array(
				'items'  => array(),
				'align'  => 'left',
				'layout' => 'grow',
			),
			'center' => array(
				'items'  => array(),
				'align'  => 'center',
				'layout' => 'normal',
			),
			'right'  => array(
				'items'  => array(),
				'align'  => 'right',
				'layout' => 'grow',
			),
		);
	}

	public static function builder_header_desktop_defaults() {
		return  array(
			'order'  => array( 'top', 'mid', 'bottom' ),
			'top'    => self::builder_row_defaults(),
			'mid'    => array(
				'scheme' => '',
				'layout' => '',
				'left'   => array(
					'items'  => array( 'logo' ),
					'align'  => 'left',
					'layout' => 'normal',
				),
				'center' => array(
					'items'  => array( 'main_menu' ),
					'align'  => 'left',
					'layout' => 'grow',
				),
				'right'  => array(
					'items'  => array( 'dark_mode', 'search', 'shop', 'user' ),
					'align'  => 'right',
					'layout' => 'normal',
				),
			),
			'bottom' => self::builder_row_defaults(),
		);
	}

	public static function builder_header_desktop_default_preset() {
		return  array(
			'builder_header_desktop[order]'                => array( 'top', 'mid', 'bottom' ),
			'builder_header_desktop[top][left][items]'     => array(),
			'builder_header_desktop[top][center][items]'   => array(),
			'builder_header_desktop[top][right][items]'    => array(),
			'builder_header_desktop[mid][left][items]'     => array(),
			'builder_header_desktop[mid][center][items]'   => array(),
			'builder_header_desktop[mid][right][items]'    => array(),
			'builder_header_desktop[bottom][left][items]'  => array(),
			'builder_header_desktop[bottom][center][items]' => array(),
			'builder_header_desktop[bottom][right][items]' => array(),

			'builder_header_desktop[top][left][align]'     => 'left',
			'builder_header_desktop[top][center][align]'   => 'center',
			'builder_header_desktop[top][right][align]'    => 'right',
			'builder_header_desktop[mid][left][align]'     => 'left',
			'builder_header_desktop[mid][center][align]'   => 'center',
			'builder_header_desktop[mid][right][align]'    => 'right',
			'builder_header_desktop[bottom][left][align]'  => 'left',
			'builder_header_desktop[bottom][center][align]' => 'center',
			'builder_header_desktop[bottom][right][align]' => 'right',

			'builder_header_desktop[top][left][layout]'    => 'grow',
			'builder_header_desktop[top][center][layout]'  => 'normal',
			'builder_header_desktop[top][right][layout]'   => 'grow',
			'builder_header_desktop[mid][left][layout]'    => 'grow',
			'builder_header_desktop[mid][center][layout]'  => 'normal',
			'builder_header_desktop[mid][right][layout]'   => 'grow',
			'builder_header_desktop[bottom][left][layout]' => 'grow',
			'builder_header_desktop[bottom][center][layout]' => 'normal',
			'builder_header_desktop[bottom][right][layout]' => 'grow',

			'builder_header_desktop[top][scheme]'          => '',
			'builder_header_desktop[mig][scheme]'          => '',
			'builder_header_desktop[bottom][scheme]'       => '',

			'builder_header_desktop[top][layout]'          => '',
			'builder_header_desktop[mig][layout]'          => '',
			'builder_header_desktop[bottom][layout]'       => '',
		);
	}

	public static function builder_header_sticky_defaults() {
		return array(
			'order'  => array( 'sticky' ),
			'sticky' => array(
				'scheme' => '',
				'layout' => '',
				'left'   => array(
					'items'  => array( 'logo' ),
					'align'  => 'left',
					'layout' => 'grow',
				),
				'center' => array(
					'items'  => array( 'main_menu' ),
					'align'  => 'left',
					'layout' => 'normal',
				),
				'right'  => array(
					'items'  => array( 'search', 'user' ),
					'align'  => 'right',
					'layout' => 'grow',
				),
			),
		);
	}

	public static function builder_header_mobile_defaults() {
		return array(
			'order'       => array( 'mobile', 'mobile_menu' ),
			'mobile'      => array(
				'scheme' => '',
				'layout' => '',
				'left'   => array(
					'items'  => array( 'menu_handler' ),
					'align'  => 'left',
					'layout' => 'grow',
				),
				'center' => array(
					'items'  => array( 'mobile_logo' ),
					'align'  => 'center',
					'layout' => 'normal',
				),
				'right'  => array(
					'items'  => array( 'search' ),
					'align'  => 'right',
					'layout' => 'grow',
				),
			),
			'mobile_menu' => self::builder_row_defaults(),
		);
	}

	public static function builder_drawer_defaults() {
		return array(
			'order'  => array( 'drawer' ),
			'drawer' => array(
				'scheme' => '',
				'layout' => '',
				'left'   => array(
					'items'  => array( 'logo', 'mobile_menu' ),
					'align'  => 'left',
					'layout' => 'grow',
				),
				'center' => array(
					'items'  => array(),
					'align'  => 'center',
					'layout' => 'normal',
				),
				'right'  => array(
					'items'  => array( 'footer_copyright' ),
					'align'  => 'right',
					'layout' => 'grow',
				),
			),
		);
	}

	public static function builder_footer_defaults() {
		return array(
			'order'  => array( 'top', 'mid', 'bottom' ),
			'top'    => self::builder_row_defaults(),
			'mid'    => array(
				'scheme' => '',
				'layout' => '',
				'left'   => array(
					'items'  => array( 'footer_logo' ),
					'align'  => 'left',
					'layout' => 'grow',
				),
				'center' => array(
					'items'  => array(),
					'align'  => 'center',
					'layout' => 'normal',
				),
				'right'  => array(
					'items'  => array(),
					'align'  => 'right',
					'layout' => 'grow',
				),
			),
			'bottom' => array(
				'scheme' => '',
				'layout' => '',
				'left'   => array(
					'items'  => array( 'footer_copyright' ),
					'align'  => 'left',
					'layout' => 'grow',
				),
				'center' => array(
					'items'  => array(),
					'align'  => 'center',
					'layout' => 'normal',
				),
				'right'  => array(
					'items'  => array( 'footer_menu' ),
					'align'  => 'right',
					'layout' => 'grow',
				),
			),
		);
	}

	public static function builder_footer_default_preset() {
		return array(
			'builder_footer[order]'                  => array( 'top', 'mid', 'bottom' ),
			'builder_footer[top][left][items]'       => array(),
			'builder_footer[top][center][items]'     => array(),
			'builder_footer[top][right][items]'      => array(),
			'builder_footer[mid][left][items]'       => array(),
			'builder_footer[mid][center][items]'     => array(),
			'builder_footer[mid][right][items]'      => array(),
			'builder_footer[bottom][left][items]'    => array(),
			'builder_footer[bottom][center][items]'  => array(),
			'builder_footer[bottom][right][items]'   => array(),

			'builder_footer[top][left][align]'       => 'left',
			'builder_footer[top][center][align]'     => 'center',
			'builder_footer[top][right][align]'      => 'right',
			'builder_footer[mid][left][align]'       => 'left',
			'builder_footer[mid][center][align]'     => 'center',
			'builder_footer[mid][right][align]'      => 'right',
			'builder_footer[bottom][left][align]'    => 'left',
			'builder_footer[bottom][center][align]'  => 'center',
			'builder_footer[bottom][right][align]'   => 'right',

			'builder_footer[top][left][layout]'      => 'grow',
			'builder_footer[top][center][layout]'    => 'normal',
			'builder_footer[top][right][layout]'     => 'grow',
			'builder_footer[mid][left][layout]'      => 'grow',
			'builder_footer[mid][center][layout]'    => 'normal',
			'builder_footer[mid][right][layout]'     => 'grow',
			'builder_footer[bottom][left][layout]'   => 'grow',
			'builder_footer[bottom][center][layout]' => 'normal',
			'builder_footer[bottom][right][layout]'  => 'grow',

			'builder_footer[top][scheme]'            => '',
			'builder_footer[mig][scheme]'            => '',
			'builder_footer[bottom][scheme]'         => '',

			'builder_footer[top][layout]'            => '',
			'builder_footer[mig][layout]'            => '',
			'builder_footer[bottom][layout]'         => '',
		);
	}


	public static function builder_post_sticky_defaults() {
		return array(
			'order'  => array( 'sticky' ),
			'sticky' => array(
				'scheme' => '',
				'layout' => '',
				'left'   => array(
					'items'  => array( 'menu_handler', 'post_title' ),
					'align'  => 'left',
					'layout' => 'grow',
				),
				'center' => array(
					'items'  => array(),
					'align'  => 'center',
					'layout' => 'normal',
				),
				'right'  => array(
					'items'  => array( 'post_share' ),
					'align'  => 'right',
					'layout' => 'grow',
				),
			),
		);
	}
}
