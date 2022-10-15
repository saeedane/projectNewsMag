<?php
namespace Newsy\Page;

use Newsy\TemplateAbstract;

/**
 * BbPress template class.
 */
class BbPress extends TemplateAbstract {

	public $template_id = 'bbpress';

	public function __construct() {
		parent::__construct();

		$this->hook();
	}

	public function hook() {
		add_action( 'newsy_content_before', array( $this, 'get_header' ), 15 );
	}

	public function get_header() {
		$archive_header_style = $this->get_option( 'header_style', '1' );

		// Custom title
		$title = get_the_title();

		$archive_title = '<h1 class="ak-archive-name"><span class="ak-archive-name-text">' . $title . '</span></h1>';
		$breadcrumb    = $this->get_breadcrumb( false, false, 'bbpress' );

		echo "<div class=\"ak-archive-header ak-archive-header-style-{$archive_header_style}\">
                    <div class=\"container\">
                        {$breadcrumb}
                        <div class=\"ak-archive-header-inner\">
                            <div class=\"ak-archive-head clearfix\">
                                <div class=\"ak-archive-head-inner\">
                                      {$archive_title}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
	}
}
