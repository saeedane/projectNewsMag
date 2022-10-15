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

class ProductCustomPanel extends ProductPanelAbstract {

	public $id = 'custom';

	public function render_content() {
		if ( isset( $this->page['config']['file'] ) && file_exists( $this->page['config']['file'] ) ) {
			include $this->page['config']['file'];
		}
	}

	public function ajax_request() {    }
}
