<?php
namespace Newsy\Archive;

/**
 * Home template class.
 */
class Home extends ArchiveAbstract {

	public $template_id = 'home';

	public function render_header() {
		return; // no header
	}
}
