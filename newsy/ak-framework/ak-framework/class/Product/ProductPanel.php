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

use Ak\Product\Panel\ProductActivation;
use Ak\Product\Panel\ProductCustomPanel;
use Ak\Product\Panel\ProductInstallDemo;
use Ak\Product\Panel\ProductOptionPanel;
use Ak\Product\Panel\ProductSystemReport;
use Ak\Product\Panel\ProductInstallPlugin;

/**
 * Class ProductPanel.
 *
 * @package  ak-framework
 */
class ProductPanel {

	/**
	 * @var ProductPanel
	 */
	private static $instance;

	/**
	 * Contains current page params.
	 *
	 * @var array
	 */
	private $current_page = array();

	/**
	 * Contains current products params.
	 *
	 * @var array
	 */
	private $current_product = array();

	/**
	 * Contains current page output.
	 *
	 * @var string
	 */
	private $output = '';

	/**
	 * Get Instance.
	 *
	 * @return ProductPanel
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
		add_action( 'admin_init', array( $this, 'admin_page_init' ) );
	}

	/**
	 * Hook Init admin page output.
	 *
	 * @return void
	 */
	public function admin_page_init() {
		$current_page = $this->get_current_page();

		if ( ! $current_page && ! isset( $current_page['module'] ) ) {
			return false;
		}

		$instance = $this->get_current_page_manager( $current_page['module'] );

		if ( $instance && is_callable( array( $instance, 'render' ) ) ) {
			ob_start();
			$instance->render();
			$this->output = ob_get_clean();
		}
	}

	/**
	 * Callback function for menus & sub menus.
	 *
	 * @return string
	 */
	public function render_panel() {
		ak_sanitize_echo( $this->output );
	}

	/**
	 * Return products panel module instance.
	 *
	 * @param mixed $module
	 *
	 * @return mixed
	 */
	public function get_current_page_manager( $module ) {
		if ( class_exists( $module ) && is_subclass_of( $module, 'Ak\Product\Panel\ProductPanelAbstract' ) ) {
			return new $module;
		}

		$instance = false;
		switch ( $module ) {
			case ( 'custom' ):
				$instance = new ProductCustomPanel;
				break;

			case ( 'install-plugin' ):
				$instance = new ProductInstallPlugin;
				break;

			case ( 'install-demo' ):
				$instance = new ProductInstallDemo;
				break;

			case ( 'option-panel' ):
				$instance = new ProductOptionPanel;
				break;

			case ( 'report' ):
				$instance = new ProductSystemReport;
				break;

			case ( 'product-activation' ):
				$instance = new ProductActivation;
				break;
		}

		return $instance;
	}

	/**
	 * Get current page
	 * Return current page id.
	 *
	 * @return mixed
	 */
	public function get_page_ajax( $module ) {
		return $this->get_current_page_manager( $module )->ajax_request();
	}

	/**
	 * Get current page
	 * Return current page id.
	 *
	 * @return mixed
	 */
	public function get_current_product() {
		if ( empty( $this->current_product ) ) {
			$current_page = $this->get_current_page();

			if ( ! $current_page ) {
				return false;
			}

			$this->current_product = Product::get_instance()->get_product_by_id( $current_page['product'] );
		}

		return $this->current_product;
	}

	/**
	 * Get current page
	 * Return current page params by id.
	 *
	 * @return mixed
	 */
	public function get_current_page() {
		if ( empty( $this->current_page ) ) {
			$this->current_page = Product::get_instance()->get_page_by_id( $this->get_current_page_id() );
		}

		return $this->current_page;
	}

	/**
	 * Get current page
	 * Return current page id.
	 *
	 * @return mixed
	 */
	public function get_current_page_id() {
		global $pagenow;

		if ( 'admin.php' === $pagenow && ! empty( $_GET['page'] ) ) {
			return $_GET['page'];
		}

		return false;
	}

	/**
	 * @param $error_message
	 */
	public function error( $error_message ) {
		printf( '<div class="update-nag">%s</div>', $error_message );
	}
}
