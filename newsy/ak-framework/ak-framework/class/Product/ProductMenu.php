<?php
/***
 * The Ak Framework
 *
 * Ak Framework is framework for WordPress themes and plugins.
 *
 * Copyright © 2020 akbilisim
 * www.akbilisim.com
 *
 * Envato Profile: https://themeforest.net/user/akbilisim
 */
namespace Ak\Product;

use Ak\Support\Font;
use Ak\Translation\Translation;

/**
 * Class Product Menu.
 *
 * @package  ak-framework
 */
class ProductMenu {

	/**
	 * @var ProductMenu
	 */
	private static $instance;

	/**
	 * Get Instance.
	 *
	 * @return ProductMenu
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Initialize menus.
	 */
	public function __construct() {
		add_filter( 'ak-framework/product/pages', array( $this, 'register_framework_product_pages' ), 999 );
		add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
		add_action( 'admin' . '_' . 'bar' . '_' . 'menu', array( $this, 'register_admin_menu_bar' ), 99 );
	}

	/**
	 * Hook register menus to WordPress.
	 *
	 * Register product menus for admin bar menu
	 *
	 * @params WP_Admin_Bar $wp_admin_bar.
	 *
	 * @return void
	 */
	public function register_admin_menu_bar( &$wp_admin_bar ) {

		// if there is no menu
		$products = Product::get_instance()->get_products();

		if ( ! empty( $products ) ) {
			foreach ( $products as $product_id => $product ) {
				$capability = isset( $product['capability'] ) ? $product['capability'] : 'edit_theme_options';

				if ( ! current_user_can( $capability ) ) {
					continue;
				}

				$pages = Product::get_instance()->get_pages_by_product( $product_id );

				if ( empty( $pages ) ) {
					continue;
				}

				$first_page = key( $pages );

				$wp_admin_bar->add_node(
					array(
						'id'     => $product_id,
						'title'  => $product['product-name'],
						'href'   => admin_url( 'admin.php?page=' . $first_page ),
						'meta'   => isset( $product['meta'] ) ? $product['meta'] : array(),
						'parent' => false,
					)
				);

				foreach ( $pages as $page_id => $page ) {
					$capability = isset( $page['capability'] ) ? $page['capability'] : 'edit_theme_options';

					if ( ! current_user_can( $capability ) ) {
						continue;
					}

					$wp_admin_bar->add_node(
						array(
							'id'     => $page_id,
							'title'  => isset( $page['menu_title'] ) ? $page['menu_title'] : $page['page_title'],
							'href'   => admin_url( 'admin.php?page=' . $page_id ),
							'meta'   => isset( $page['meta'] ) ? $page['meta'] : array(),
							'parent' => $product_id,
						)
					);
				}
			}
		}

	}

	/**
	 * Hook register menus to WordPress.
	 * Register product menus for admin menu.
	 *
	 * @return void
	 */
	public function register_admin_menu() {
		// if there is no menu
		$products = Product::get_instance()->get_products();

		if ( ! empty( $products ) ) {
			foreach ( $products as $product_id => $product ) {
				$pages = Product::get_instance()->get_pages_by_product( $product_id );

				if ( empty( $pages ) ) {
					continue;
				}
				array_multisort( array_column( $pages, 'position' ), SORT_ASC, $pages );

				$first_page = key( $pages );

				$capability = isset( $product['capability'] ) ? $product['capability'] : 'edit_theme_options';
				$icon       = isset( $product['menu-icon'] ) ? $product['menu-icon'] : '';
				$position   = isset( $product['position'] ) ? $product['position'] : 3.001;

				call_user_func_array(
					'add_menu_page', array(
						$product['product-name'],
						$product['product-name'],
						$capability,
						$first_page,
						null,
						$icon,
						$position,
					)
				);

				foreach ( $pages as $page_id => $page ) {
					$page_title = $page['page_title'];
					$menu_title = isset( $page['menu_title'] ) ? $page['menu_title'] : $page_title;
					$capability = isset( $page['capability'] ) ? $page['capability'] : 'edit_theme_options';
					$position   = isset( $page['position'] ) ? $page['position'] : null;

					call_user_func_array(
						'add_submenu_page', array(
							$first_page,
							$page_title,
							$menu_title,
							$capability,
							$page_id,
							array( &$this, 'menu_callback' ),
							$position,
						)
					);
				}
			}
		}

	}

	/**
	 * Get required page config.
	 *
	 * @param $pages
	 *
	 * @return mixed
	 */
	public function register_framework_product_pages( $pages ) {
		$products = Product::get_instance()->get_products();

		if ( ! empty( $products ) ) {
			// register product sub pages
			foreach ( $products as $product_id => $product ) {
				// Add custom font panel if theme is activated it
				if ( isset( $product['custom-fonts'] ) && $product['custom-fonts'] ) {
					$pages[ $product_id . '-fonts' ] = array(
						'product'    => $product_id,
						'page_title' => __( 'Custom Fonts', 'ak-framework' ),
						'module'     => 'option-panel',
						'hide_tab'   => true,
						'position'   => apply_filters( 'ak-framework/custom-fonts/menu/position', 999 ),
						'config'     => array(
							'panel_title'   => __( 'Custom Fonts', 'ak-framework' ),
							'panel_options' => array(
								'file'      => AK_FRAMEWORK_PATH . '/includes/options/fonts_panel.php', // conf
								'option_id' => Font::$option_id,
							),
						),
					);
				}

				// Add translation panel to menu if theme is requires
				if ( isset( $product['translations'] ) && $product['translations'] ) {
					$title = 'theme' === $product['product-type'] ? __( 'Theme Translations', 'ak-framework' ) : __( ' Translations', 'ak-framework' );

					$pages[ $product_id . '-translations' ] = array(
						'product'    => $product_id,
						'page_title' => $title,
						'module'     => 'option-panel',
						// 'hide_tab'   => true,
						'position'   => apply_filters( 'ak-framework/translations/menu/position', 60 ),
						'config'     => array(
							'panel_title'   => $title,
							'panel_options' => array(
								'option_id'       => Translation::$option_id,
								'fields_callback' => 'ak_get_translation_fields',
							),
						),
					);
				}

				// Add Activation Panel to Product Panel
				if ( isset( $product['product-item-id'] ) ) {
					if ( ! ProductLicense::get_instance()->is_product_purchase_valid( $product['product-item-id'] ) ) {
						$title = sprintf(
							/* translators: %1$s is replaced with "string" */
							__( 'Activate %s', 'ak-framework' ), $product['product-name']
						);
						$btn         = sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=' . $product_id . '-activation' ), $title );
						$description = sprintf(
							/* translators: %1$s is replaced with "string" */
							_x( 'Please %s to enjoy the full benefits. We\'re sorry about this extra step but we built the activation system to prevent mass piracy of our products, this allows us to better serve our paying customers.', 'product name', 'ak-framework' ), $btn
						);

						$pages[ $product_id . '-activation' ] = array(
							'product'    => $product_id,
							'page_title' => '<font color="red"> ' . $title . '</font>',
							'module'     => 'product-activation',
							'position'   => 99999,
							'hide_tab'   => true,
							'config'     => array(
								'panel_title' => 'Activate ' . $product['product-name'],
								'panel_desc'  => $description,
							),
						);

						// add notification for activation
						ak_register_notice( $product_id . '-activation', 'error', $description, $title );
					} else {
						$title = sprintf( __( 'Deactivate %s', 'ak-framework' ), $product['product-name'] );

						$pages[ $product_id . '-deactivation' ] = array(
							'product'    => $product_id,
							'page_title' => $title,
							'module'     => 'product-activation',
							'position'   => 99999,
							'hide_tab'   => true,
							'config'     => array(
								'panel_title' => $title,
							),
						);
					}
				}
			}
		}

		return $pages;
	}

	/**
	 * Callback function for menus & sub menus.
	 */
	public function menu_callback() {
		echo ProductPanel::get_instance()->render_panel();
	}
}
