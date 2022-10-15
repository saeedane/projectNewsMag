<?php
/**
 * @author : akbilisim
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Ak\Menu\Menu;
use Ak\Menu\MenuMeta;
use Ak\Support\Image;
use Ak\User\UserMeta;
use Ak\Metabox\Metabox;
use Ak\Ajax\BackendAjax;
use Ak\Ajax\FrontendAjax;
use Ak\Asset\BackendAsset;
use Ak\Asset\StyleManager;
use Ak\Asset\FrontendAsset;
use Ak\Product\ProductMenu;
use Ak\Product\ProductPanel;
use Ak\Support\AdminNotices;
use Ak\Support\CacheManager;
use Ak\Widget\WidgetManager;
use Ak\Customizer\Customizer;
use Ak\Taxonomy\TaxonomyMeta;
use Ak\Translation\MultiLang;
use Ak\Product\ProductPlugins;
use Ak\Product\ProductUpdater;
use Ak\Elementor\ElementorManager;
use Ak\Shortcode\ShortcodeManager;
use Ak\Widget\WidgetSidebarManager;
use Ak\Translation\TranslationManager;

// Autoload Function
// Ak Core Functionality That Used in Front End and Back End
Image::get_instance();

MultiLang::get_instance();

Menu::get_instance();

if ( ! is_admin() ) {
	FrontendAsset::get_instance();
	FrontendAjax::get_instance();
}

ShortcodeManager::get_instance();

WidgetManager::get_instance();

if ( defined( 'ELEMENTOR_VERSION' ) ) {
	ElementorManager::get_instance();
}

if ( is_customize_preview() ) {
	Customizer::get_instance();
}

// Ak Core Functionality That Used in Back End
if ( is_admin() ) {
	CacheManager::get_instance();

	AdminNotices::get_instance();

	TranslationManager::get_instance();

	BackendAsset::get_instance();

	BackendAjax::get_instance();

	StyleManager::get_instance();

	ProductMenu::get_instance();

	ProductPlugins::get_instance();

	ProductPanel::get_instance();

	ProductUpdater::get_instance();

	MenuMeta::get_instance();

	TaxonomyMeta::get_instance();

	Metabox::get_instance();

	UserMeta::get_instance();

	WidgetSidebarManager::get_instance();
}
