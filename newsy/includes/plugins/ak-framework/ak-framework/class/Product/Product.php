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

/**
 * This class handles all product registarion.
 *
 * @package    AkFramework
 */
class Product {

	/**
	 * @var Product
	 */
	private static $instance;

	/**
	 * Contains list of all active products.
	 *
	 * @var array
	 */
	private $products = array();

	/**
	 * Contains list of all active products pages.
	 *
	 * @var array
	 */
	private $product_pages = array();

	/**
	 * Get Instance.
	 *
	 * @return Product
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Get all Products.
	 *
	 * @return array
	 */
	public function get_products() {
		if ( empty( $this->products ) ) {
			$this->products = apply_filters( 'ak-framework/products', array() );
		}

		return $this->products;
	}

	/**
	 * Get all Product Pages.
	 *
	 * @return array
	 */
	public function get_product_pages() {
		if ( empty( $this->product_pages ) ) {
			$this->product_pages = apply_filters( 'ak-framework/product/pages', array() );
		}

		return $this->product_pages;
	}

	/**
	 * Get a Product.
	 *
	 * @return array|bool
	 */
	public function get_product_by_id( $id ) {
		$products = $this->get_products();

		if ( isset( $products[ $id ] ) ) {
			return $products[ $id ];
		}

		return false;
	}

	/**
	 * Get a Product Page.
	 *
	 * @return array|bool
	 */
	public function get_page_by_id( $id ) {
		$product_pages = $this->get_product_pages();

		if ( isset( $product_pages[ $id ] ) ) {
			return $product_pages[ $id ];
		}

		return false;
	}

	/**
	 * Get Product Pages by Product ID.
	 *
	 * @return array
	 */
	public function get_pages_by_product( $id ) {
		$products = $this->get_product_pages();

		return ak_array_find_all_by_value( $products, 'product', $id );
	}

	/**
	 * Get Product Pages by Module type.
	 *
	 * @return array
	 */
	public function get_pages_by_module( $module ) {
		$product_pages = $this->get_product_pages();

		return ak_array_find_all_by_value( $product_pages, 'module', $module );
	}

	/**
	 * Get Product Pages by Global Css if exist.
	 *
	 * @return array
	 */
	public function get_global_css_panels() {
		$product_pages = $this->get_product_pages();

		return ak_array_find_all_by_value( $product_pages, 'global_css', true );
	}

	/**
	 * Get Product Pages by Global Css if exist.
	 *
	 * @return array
	 */
	public function get_page_by_option_id( $option_id ) {
		$product_pages = $this->get_product_pages();

		foreach ( $product_pages as $params ) {
			if ( isset( $params['config']['panel_options']['option_id'] ) && $params['config']['panel_options']['option_id'] === $option_id ) {
				return $params;
			}
		}

		return false;
	}

}
