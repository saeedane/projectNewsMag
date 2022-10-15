<?php

namespace Newsy\Archive;

use Newsy\TemplateAbstract;

/**
 * Attachment template class.
 */
class Attachment extends TemplateAbstract {

	public $template_id = 'attachment';

	public function get_header() {

		$breadcrumb = $this->get_breadcrumb( false, false );

		echo "<div class=\"ak-archive-header style-1\">
                    <div class=\"container\">
                        {$breadcrumb}
                    </div>
                </div>";
	}
}
