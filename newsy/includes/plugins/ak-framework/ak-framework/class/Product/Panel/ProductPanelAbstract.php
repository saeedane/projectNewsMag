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
namespace Ak\Product\Panel;

use Ak\Product\Product;
use Ak\Product\ProductPanel;
use Ak\Product\ProductLicense;

abstract class ProductPanelAbstract {

	/**
	 * Holds Module Id.
	 */
	public $id;

	public $product_id;

	public $page_id;

	public $product;

	public $page;

	public function __construct() {
		$this->page = ProductPanel::get_instance()->get_current_page();
		if ( $this->page && ! empty( $this->page ) ) {
			$this->product_id = $this->page['product'];

			$this->page_id = ProductPanel::get_instance()->get_current_page_id();

			$this->product = ProductPanel::get_instance()->get_current_product();

			// Hook admin assets enqueue
			add_filter( 'admin_body_class', array( $this, 'product_panel_body_class' ), 999 );

			add_action( 'admin_enqueue_scripts', array( $this, 'product_panel_enqueue_scripts' ), 999 );

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ), 99 );
		}
	}

	public function product_panel_body_class( $classes ) {
		$classes .= ' ak-product-panel-body';

		if ( isset( $this->product['product-panel-body-class'] ) ) {
			$classes .= ' ' . $this->product['product-panel-body-class'];
		} else {
			$classes .= ' ' . $this->page['product'] . '-panel';
		}

		if ( isset( $this->page['slug'] ) ) {
			$classes .= ' ' . $this->page['slug'] . '-panel';
		}

		return $classes;
	}

	/**
	 * Styles and scripts used in Admin pages.
	 */
	public function product_panel_enqueue_scripts() {
		wp_enqueue_style( 'ak-product-panel-style', AK_FRAMEWORK_URL . '/assets/css/panel/ak-product-panel.css', array( 'fontawesome', 'sweetalert' ), AK_FRAMEWORK_VERSION );
		wp_style_add_data( 'ak-product-panel-style', 'rtl', 'replace' );

		do_action( 'ak-framework/product-panel/enqueue', $this->page_id, $this->product );
	}

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {     }

	/**
	 * Display module main content.
	 */
	public function render() {
		$this->before_render();

		echo '<div class="ak-product-panel">';

		$this->header();

		echo '<div class="ak-product-panel-inner ak-clearfix">';

		echo '<div class="ak-product-panel-page-info ak-clearfix">';

		$this->page_info();

		do_action( 'ak-framework/product-panel/page-info', $this->id, $this->page_id );

		echo '</div>';

		$this->render_content();

		echo '</div>';

		$this->footer();

		echo '</div>';

		$this->after_render();
	}

	public function before_render() {
		//must override in chill class
	}

	public function render_content() {
		//must override in chill class
	}

	public function after_render() {
		//must override in chill class
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function ajax_request() {
		return false;
	}

	protected function header() {
		$icon        = ! empty( $this->product['product-icon'] ) ? '<img src="' . $this->product['product-icon'] . '" width="50px"/>' : '';
		$version     = ! empty( $this->product['product-version'] ) ? '<span class="ak-page-top-header-version">v' . $this->product['product-version'] . '</span>' : '';
		$name        = ! empty( $this->product['product-name'] ) ? '<span class="ak-page-top-header-name">' . $this->product['product-name'] . $version . ' </span>' : '';
		$description = ! empty( $this->product['product-description'] ) ? '<span class="ak-page-top-header-desc">' . $this->product['product-description'] . '</span>' : '';
		$no_desc     = empty( $description ) ? 'header-info-no-desc' : ''; ?>
		<div class="ak-product-panel-header">
			<div class="ak-page-top-header">
				<div class="ak-page-top-header-left">
					<?php echo $icon; ?>
					<span class="ak-page-top-header-info <?php echo esc_attr( $no_desc ); ?>">
						<?php echo wp_kses( $name, ak_trans_allowed_html() ); ?>
						<?php echo wp_kses( $description, ak_trans_allowed_html() ); ?>
					</span>
				</div>
				<div class="ak-page-top-header-right">
					<?php $this->header_buttons(); ?>
				</div>
			</div>

			<div class="ak-page-top-wrapper">
				<?php $this->header_menu(); ?>
				<div class="clear"></div>
			</div>

		</div>
		<?php
	}

	protected function header_buttons() {
		$output  = '';
		$buttons = array();
		if ( isset( $this->product['product-header-buttons'] ) && is_array( $this->product['product-header-buttons'] ) ) {
			$buttons = $this->product['product-header-buttons'];
		}

		$buttons = apply_filters( 'ak-framework/product/panel/header-buttons', $buttons, $this->product_id, $this->page_id );

		foreach ( $buttons as $buttons ) {
			$target       = isset( $buttons['new_window'] ) && $buttons['new_window'] ? 'target=_blank' : '';
			$button_class = isset( $buttons['class'] ) ? $buttons['class'] : '';
			$button_url   = isset( $buttons['url'] ) ? $buttons['url'] : '#';
			$button_attr  = isset( $buttons['attr'] ) ? $buttons['attr'] : array();

			$attr = '';

			if ( is_array( $button_attr ) ) {
				foreach ( $button_attr as $key => $value ) {
					$attr .= $key . '=' . $value;
				}
			}

			$output .= '<a class="ak-btn ak-btn-primary ' . $button_class . '" href="' . $button_url . '" ' . $target . ' ' . $attr . '>' . $buttons['name'] . '</a>';
		}

		ak_sanitize_echo( $output );
	}

	protected function header_menu() {
		$output        = '';
		$product_pages = Product::get_instance()->get_pages_by_product( $this->product_id );
		array_multisort( array_column( $product_pages, 'position' ), SORT_ASC, $product_pages );

		if ( isset( $product_pages ) ) {
			foreach ( $product_pages as $id => $menu ) {
				if ( isset( $menu['hide_tab'] ) ) {
					continue;
				}

				$page_slug = isset( $menu['slug'] ) ? $menu['slug'] : $id;

				if ( isset( $menu['type'] ) && 'tab_link' === $menu['type'] ) {
					$url = isset( $menu['tab_link'] ) ? $menu['tab_link'] : '';
				} else {
					$url = admin_url( 'admin.php?page=' . $page_slug );
				}

				$page_title = isset( $menu['config']['tab_label_title'] ) ? $menu['config']['tab_label_title'] : $menu['page_title'];
				$active     = $page_slug === $this->page_id ? 'nav-tab-active' : '';

				$output .= '<a class="nav-tab ' . $active . '" href="' . $url . '" >' . $page_title . '</a>';
			}
		}

		ak_sanitize_echo( $output );
	}

	/**
	 * append hidden fields for ajax request.
	 */
	protected function footer() {   }

	protected function page_info() {
		if ( isset( $this->page['config']['panel_title'] ) ) {
			printf( '<h1 class="page-title">%s</h1>', $this->page['config']['panel_title'] );
		}
		if ( isset( $this->page['config']['panel_desc'] ) ) {
			printf( '<div class="page-text">%s</div>', $this->page['config']['panel_desc'] );
		}
	}

	protected function is_product_registered() {
		if ( ! isset( $this->product['product-item-id'] ) ) {
			return true;
		}

		return ProductLicense::get_instance()->is_product_purchase_valid( $this->product['product-item-id'] );
	}
}
