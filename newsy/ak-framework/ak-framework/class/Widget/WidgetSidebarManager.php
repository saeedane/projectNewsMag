<?php
/**
 * @author : akbilisim
 */

namespace Ak\Widget;

use AK\Widget\WidgetManager;

class WidgetSidebarManager {

	/**
	 * @var Widget
	 */
	private static $instance;

	/**
	 * @return Widget
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	private function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_script' ) );
		add_action( 'widgets_admin_page', array( $this, 'additional_widget_button' ), 9 );
		add_action( 'sidebar_admin_page', array( $this, 'widget_overlay' ) );
		add_action( 'after_setup_theme', array( $this, 'save_widgetlist' ) );
	}

	public function is_widget_page() {
		return in_array( $GLOBALS['pagenow'], array( 'widgets.php' ) );
	}

	public function enqueue_script() {
		if ( $this->is_widget_page() ) {
			wp_enqueue_style( 'ak-widget-sidebar', AK_FRAMEWORK_URL . '/assets/css/widget-sidebar.css', null, AK_FRAMEWORK_VERSION );
			wp_style_add_data( 'ak-widget-sidebar', 'rtl', 'replace' );

			wp_enqueue_script( 'ak-widget-sidebar', AK_FRAMEWORK_URL . '/assets/js/widget-sidebar.js', array( 'jquery' ), AK_FRAMEWORK_VERSION, true );
		}
	}

	public function save_widgetlist() {
		if ( $this->is_widget_page() ) {
			if ( isset( $_POST['modifwidget'] ) ) {
				if ( isset( $_POST['widgetlist'] ) ) {
					update_option( WidgetManager::$sidebar_list, $_POST['widgetlist'] );
				} else {
					delete_option( WidgetManager::$sidebar_list );
				}
			}
		}
	}

	public function additional_widget_button() {
		if ( $this->is_widget_page() ) {
			echo wp_kses(
				"<h1><a class='sidebarwidget add-new-h2'>" . esc_html__( 'Add or Remove Widget Area', 'ak-framework' ) . "</a></h1><div class='clearfix'></div>",
				array(
					'a'   => array( 'class' => true ),
					'div' => array( 'class' => true ),
				)
			);
		}
	}

	public function populate_widget() {
		$widgetlist = WidgetManager::get_instance()->get_additional_sidebars();

		$html = '';
		if ( $widgetlist ) {
			foreach ( $widgetlist as $id => $widget ) {
				$html .= '<li><span>' . $widget . "</span><input type='hidden' name='widgetlist[" . $id . "]' value='" . $widget . "'><div class='remove fa fa-ban'></div></li>";
			}
		}

		return $html;
	}

	public function widget_overlay() {
		if ( $this->is_widget_page() ) {
			echo
				"<div class='widget-overlay'>
                    <form method='POST'>
                        <div class='widget-overlay-wrapper'>
                            <h3>" . esc_html__( 'Edit Widget Area', 'ak-framework' ) . "</h3>
                            <div class='close fa fa-times'></div>
                            <div class='widget-content-list'>
                                <div class='widget-content-wrapper'>
                                    <h4>" . esc_html__( 'Widget Area List :', 'ak-framework' ) . '</h4>
                                    <ul> ' . $this->populate_widget() . "</ul>
                                </div>
                                <div class='widget-confirm'>
                                    <input type='button' class='addwidget button-secondary' value='" . esc_html__( 'Create Widget Area', 'ak-framework' ) . "'>
                                    <input type='submit' class='savewidget button-primary' value='" . esc_html__( 'Save Widget', 'ak-framework' ) . "'>
                                </div>
                            </div>
                            <div class='widget-adding-content'>
                                <div class='widget-additional'>
                                    <h4>" . esc_html__( 'Create Widget Area', 'ak-framework' ) . "</h4>
                                    <input type='text' class='textwidgetconfirm' placeholder='" . esc_html__( 'Enter name of widget', 'ak-framework' ) . "'>
                                </div>
                                <div class='widget-confirm'>
                                    <input type='button' class='addwidgetconfirm button-primary' value='" . esc_html__( 'Add Widget', 'ak-framework' ) . "'>
                                </div>
                            </div>
                        </div>
                        <input type='hidden' name='modifwidget' value='1'/>
                        " . wp_nonce_field( 'edit-widgetlist' ) . '
                    </form>
                </div>';
		}
	}
}
