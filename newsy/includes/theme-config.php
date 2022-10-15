<?php

add_filter( 'ak-framework/products', 'newsy_register_product' );

if ( ! function_exists( 'newsy_register_product' ) ) {
	/**
	 * Register the Newsy Product to framework.
	 *
	 * @return array
	 */
	function newsy_register_product( $pages ) {
		// generate the theme panel
		$pages['newsy'] = array(
			'product-name'             => NEWSY_THEME_NAME,
			'product-version'          => NEWSY_THEME_VERSION,
			'product-icon'             => NEWSY_THEME_URI . '/assets/images/admin/newsy_logo.png',
			'product-type'             => 'theme',
			'product-item-id'          => 34626838,
			'product-header-buttons'   => array(
				'docs' => array(
					'name'       => '<i class="fa fa-book"></i> Docs',
					'url'        => 'https://support.akbilisim.com/docs',
					'new_window' => true,
				),
			),
			'product-panel-body-class' => 'newsy-theme-panel',
			'menu-icon'                => NEWSY_THEME_URI . '/assets/images/admin/newsy_icon.png',
			'menu-slug'                => 'newsy-theme-dashboard',
			'custom-fonts'             => true,
			'translations'             => true,
		);

		return $pages;
	}
}

add_filter( 'ak-framework/product/pages', 'newsy_register_product_pages' );

if ( ! function_exists( 'newsy_register_product_pages' ) ) {
	/**
	 * Register the Newsy Product Pages to framework.
	 *
	 * @return array
	 */
	function newsy_register_product_pages( $pages ) {
		$pages['newsy-theme-dashboard']    = array(
			'product'    => 'newsy',
			'page_title' => esc_html__( 'Welcome', 'newsy' ),
			'module'     => 'custom',
			'position'   => 29,
			'config'     => array(
				'file'        => NEWSY_THEME_PATH . 'includes/options/theme-panel/pages/welcome.php',
				'panel_title' => esc_html__( 'Welcome to Newsy', 'newsy' ),
				'panel_desc'  => esc_html__( 'Congratulations! You are about to use most powerful viral theme ever - The theme with advanced Frontend and Backend options by akbilisim.', 'newsy' ),
			),
		);
		$pages['newsy-theme-plugins']      = array(
			'product'    => 'newsy',
			'page_title' => esc_html__( 'Install Plugins', 'newsy' ),
			'module'     => 'install-plugin',
			'capability' => 'activate_plugins',
			'position'   => 30,
			'config'     => array(
				'panel_title' => esc_html__( 'Premium and Included Plugins', 'newsy' ),
				'panel_desc'  => esc_html__( 'Install the included plugins with ease using this panel. All the plugins are well tested to work with the theme and we keep them up to date. The themes comes packed with the following plugins:', 'newsy' ),
			),
		);
		$pages['newsy-theme-install-demo'] = array(
			'product'    => 'newsy',
			'page_title' => esc_html__( 'Install Demos', 'newsy' ),
			'module'     => 'install-demo',
			'position'   => 40,
			'config'     => array(
				'panel_title' => esc_html__( 'Newsy demos', 'newsy' ),
				'panel_desc'  => esc_html__( 'Newsy brings you a number of unique designs for your website. Our demos were carefully tested so you don&#x2019;t have to create everything from scratch. With the theme demos you know exactly which predefined template is perfectly designed to start building upon. Each demo is fully customizable and has a unique look.', 'newsy' ),
			),
		);
		$pages['newsy-theme-options']      = array(
			'product'    => 'newsy',
			'page_title' => esc_html__( 'Theme Options', 'newsy' ),
			'capability' => 'manage_options',
			'module'     => 'option-panel',
			'global_css' => true,
			'position'   => 50,
			'config'     => array(
				'panel_title'   => esc_html__( 'Theme Options', 'newsy' ),
				'panel_options' => array(
					'option_id' => NEWSY_THEME_OPTIONS,
					'file'      => NEWSY_THEME_PATH . 'includes/options/theme-panel/theme-options.php',
				),
			),
		);
		$pages['newsy-system-report']      = array(
			'product'    => 'newsy',
			'page_title' => esc_html__( 'System Report', 'newsy' ),
			'module'     => 'report',
			'position'   => 90,
			'config'     => array(
				'file'        => NEWSY_THEME_PATH . 'includes/options/theme-panel/system-report.php',
				'panel_title' => esc_html__( 'Newsy System Status', 'newsy' ),
				'panel_desc'  => esc_html__( 'Here you can check the system status. Yellow status means that the site will work as expected on the front end but it may cause problems in wp-admin. Memory notice: - the theme is well tested with a limit of 40MB/request but plugins may require more, for example woocommerce requires 64MB.', 'newsy' ),
			),
		);
		$pages['newsy-support']            = array(
			'product'    => 'newsy',
			'page_title' => esc_html__( 'Support', 'newsy' ),
			'module'     => 'custom',
			'position'   => 100,
			'config'     => array(
				'panel_title' => esc_html__( 'Newsy Support', 'newsy' ),
				'panel_desc'  => esc_html__( 'We know what it&#x2019;s like to need support. This is the reason why our customers are the top priority and we treat every issue with the utmost seriousness. The team is working hard to help every customer, to keep the theme&#x2019;s documentation up to date, to produce video tutorials and to develop new ways to make everything easier.<br><br>You can count on us, we are here for you!', 'newsy' ),
				'file'        => NEWSY_THEME_PATH . 'includes/options/theme-panel/pages/support.php',
			),
		);

		if ( apply_filters( 'newsy_import_data_panel_active', false ) ) {
			$pages['newsy-import-data'] = array(
				'product'    => 'newsy',
				'page_title' => esc_html__( 'Import Data', 'newsy' ),
				'module'     => 'install-demo',
				'hide_tab'   => true,
				'position'   => 999,
				'config'     => array(
					'panel_title'       => esc_html__( 'Import Data', 'newsy' ),
					'panel_desc'        => esc_html__( 'Import contents.', 'newsy' ),
					'filter_by_product' => 'newsy-imports',
				),
			);
		}

		return $pages;
	}
}

add_filter( 'ak-framework/product/demos', 'newsy_register_demos' );

if ( ! function_exists( 'newsy_register_demos' ) ) {
	/**
	 * Register the Newsy Demos to framework.
	 *
	 * @return array
	 */
	function newsy_register_demos( $demos ) {
		$demos['default']   = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/default/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/default/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'Default',
			'preview_url' => 'http://demo.akbilisim.com/newsy/default/',
		);
		$demos['newsyfeed'] = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/newsyfeed/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/newsyfeed/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'NewsyFeed',
			'preview_url' => 'http://demo.akbilisim.com/newsy/newsyfeed/',
		);
		$demos['viralbuzz'] = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/viralbuzz/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/viralbuzz/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'ViralBuzz',
			'preview_url' => 'http://demo.akbilisim.com/newsy/viralbuzz/',
		);
		$demos['buzzblog']  = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/buzzblog/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/buzzblog/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'BuzzBlog',
			'preview_url' => 'http://demo.akbilisim.com/newsy/buzzblog/',
		);
		$demos['newsmag']   = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/newsmag/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/newsmag/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'NewsMag',
			'preview_url' => 'http://demo.akbilisim.com/newsy/newsmag/',
		);
		$demos['buzzmag']   = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/buzzmag/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/buzzmag/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'BuzzMag',
			'preview_url' => 'http://demo.akbilisim.com/newsy/buzzmag/',
		);
		$demos['trendy']    = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/trendy/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/trendy/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'Trendy',
			'preview_url' => 'http://demo.akbilisim.com/newsy/trendy/',
		);
		$demos['buzzer']    = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/buzzer/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/buzzer/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'Buzzer',
			'preview_url' => 'http://demo.akbilisim.com/newsy/buzzer/',
		);
		$demos['buzzlink']  = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/buzzlink/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/buzzlink/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'BuzzLink',
			'preview_url' => 'http://demo.akbilisim.com/newsy/buzzlink/',
		);
		$demos['hotnews']   = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/hotnews/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/hotnews/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'Hot News',
			'preview_url' => 'http://demo.akbilisim.com/newsy/hotnews/',
		);
		$demos['shopy']     = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/shopy/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/shopy/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'Shopy',
			'preview_url' => 'http://demo.akbilisim.com/newsy/shopy/',
		);
		$demos['newstoday'] = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/newstoday/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/newstoday/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'News Today',
			'preview_url' => 'http://demo.akbilisim.com/newsy/newstoday/',
		);
		$demos['funworld']  = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/funworld/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/funworld/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'FunWorld',
			'preview_url' => 'http://demo.akbilisim.com/newsy/funworld/',
		);
		$demos['viralgag']  = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/viralgag/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/viralgag/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'Viral Gag',
			'preview_url' => 'http://demo.akbilisim.com/newsy/viralgag/',
		);
		$demos['buzzlife']  = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/buzzlife/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/buzzlife/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'BuzzLife',
			'preview_url' => 'http://demo.akbilisim.com/newsy/buzzlife/',
		);
		$demos['gamer']     = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/gamer/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/gamer/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'Gamer',
			'preview_url' => 'http://demo.akbilisim.com/newsy/gamer/',
		);
		$demos['magazine']  = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/magazine/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/magazine/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'Magazine',
			'preview_url' => 'http://demo.akbilisim.com/newsy/magazine/',
		);
		$demos['videotube'] = array(
			'product'     => 'newsy',
			'path'        => NEWSY_THEME_PATH . 'includes/demos/videotube/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/demos/videotube/thumbnail.png?v=' . NEWSY_THEME_VERSION,
			'name'        => 'VideoTube',
			'preview_url' => 'http://demo.akbilisim.com/newsy/videotube/',
		);
		return $demos;
	}
}

add_filter( 'ak-framework/product/plugins', 'newsy_register_plugins' );

if ( ! function_exists( 'newsy_register_plugins' ) ) {
	/**
	 * Register the Newsy Plugins to framework.
	 *
	 * @return array
	 */
	function newsy_register_plugins( $plugins ) {
		$plugins['ak-framework']             = array(
			'product'            => 'newsy',
			'name'               => 'Ak Framework',
			'slug'               => 'ak-framework',
			'required'           => true,
			'description'        => esc_html__( 'Frontend & backend functionalities for Wordpress themes and plugins.', 'newsy' ),
			'thumbnail'          => NEWSY_THEME_URI . '/assets/images/admin/plugins/ak-framework.png',
			'source'             => NEWSY_THEME_PATH . 'includes/plugins/ak-framework.zip',
			'version'            => '2.0.0',
			'force_activation'   => false,
			'force_deactivation' => false,
			'pre_heading'        => esc_html__( 'Required Plugins', 'newsy' ),
		);
		$plugins['newsy-elements']           = array(
			'product'            => 'newsy',
			'name'               => 'Newsy Elements',
			'slug'               => 'newsy-elements',
			'required'           => true,
			'description'        => esc_html__( 'Newsy widgets and shortcodes for WPBakery Page Builder and Elementor.', 'newsy' ),
			'thumbnail'          => NEWSY_THEME_URI . '/assets/images/admin/plugins/newsy-elements.png',
			'source'             => NEWSY_THEME_PATH . 'includes/plugins/newsy-elements.zip',
			'version'            => '2.0.0',
			'force_activation'   => false,
			'force_deactivation' => false,
		);
		$plugins['buzzeditor']               = array(
			'product'          => 'newsy',
			'name'             => 'BuzzEditor',
			'slug'             => 'buzzeditor',
			'description'      => esc_html__( 'BuzzEditor is a frontend post submission tool that lets you and your users create amazing posts.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/buzzeditor.png',
			'source'           => NEWSY_THEME_PATH . 'includes/plugins/buzzeditor.zip',
			'version'          => '2.0.0',
			'required'         => false,
			'force_activation' => false,
			'pre_heading'      => esc_html__( 'Built-in Plugins', 'newsy' ),
		);
		$plugins['buzzeditor-post-importer'] = array(
			'product'          => 'newsy',
			'name'             => 'BuzzEditor Post Importer',
			'slug'             => 'buzzeditor-post-importer',
			'description'      => esc_html__( 'BuzzEditor Post Importer is a plugin that allows you to import trivia, personality, checklist quizzes, and polls from BuzzFeed.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/buzzeditor-post-importer.png',
			'source'           => NEWSY_THEME_PATH . 'includes/plugins/buzzeditor-post-importer.zip',
			'version'          => '2.0.0',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['newsy-reaction']           = array(
			'product'          => 'newsy',
			'name'             => 'Newsy Reactions',
			'slug'             => 'newsy-reaction',
			'description'      => esc_html__( 'Cool emoji style buttons to attract your audience to your posts.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/newsy-reaction.png',
			'source'           => NEWSY_THEME_PATH . 'includes/plugins/newsy-reaction.zip',
			'version'          => '2.0.0',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['newsy-voting']             = array(
			'product'          => 'newsy',
			'name'             => 'Newsy Voting',
			'slug'             => 'newsy-voting',
			'description'      => esc_html__( 'Receiving feedback is crucial as a content creator. Get more feedback from your audience with Up/Down buttons.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/newsy-voting.png',
			'source'           => NEWSY_THEME_PATH . 'includes/plugins/newsy-voting.zip',
			'version'          => '2.0.0',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['newsy-social-share']       = array(
			'product'          => 'newsy',
			'name'             => 'Newsy Social Share',
			'slug'             => 'newsy-social-share',
			'description'      => esc_html__( 'Social share for Newsy. Add functionality for showing share buttons and share counts.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/newsy-social-share.png',
			'source'           => NEWSY_THEME_PATH . 'includes/plugins/newsy-social-share.zip',
			'version'          => '2.0.0',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['newsy-social-counter']     = array(
			'product'          => 'newsy',
			'name'             => 'Newsy Social Counter',
			'slug'             => 'newsy-social-counter',
			'description'      => esc_html__( 'Social counter for Newsy. Add functionality for showing social pages and follower counts', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/newsy-social-counter.png',
			'source'           => NEWSY_THEME_PATH . 'includes/plugins/newsy-social-counter.zip',
			'version'          => '2.0.0',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['newsy-view-counter']       = array(
			'product'          => 'newsy',
			'name'             => 'Newsy View Counter',
			'slug'             => 'newsy-view-counter',
			'description'      => esc_html__( 'View counter for Newsy. Add functionality for showing top daily, weekly post.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/newsy-view-counter.png',
			'source'           => NEWSY_THEME_PATH . 'includes/plugins/newsy-view-counter.zip',
			'version'          => '2.0.0',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['newsy-fake-counter']       = array(
			'product'          => 'newsy',
			'name'             => 'Newsy Fake Counter',
			'slug'             => 'newsy-fake-counter',
			'description'      => esc_html__( 'Boost your views, share counts, like, reaction votes with Fake Counter.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/newsy-fake-counter.png',
			'source'           => NEWSY_THEME_PATH . 'includes/plugins/newsy-fake-counter.zip',
			'version'          => '2.0.0',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['newsy-bookmark']           = array(
			'product'          => 'newsy',
			'name'             => 'Newsy Bookmark',
			'slug'             => 'newsy-bookmark',
			'description'      => esc_html__( 'Easily add bookmark/favorite or wishlist functionality for your posts.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/newsy-bookmark.png',
			'source'           => NEWSY_THEME_PATH . 'includes/plugins/newsy-bookmark.zip',
			'version'          => '2.0.0',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['newsy-nsfw']               = array(
			'product'          => 'newsy',
			'name'             => 'Newsy NSFW',
			'slug'             => 'newsy-nsfw',
			'description'      => esc_html__( 'Easily add NSFW (Not Safe For Work) functionality to your post images/videos.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/newsy-nsfw.png',
			'source'           => NEWSY_THEME_PATH . 'includes/plugins/newsy-nsfw.zip',
			'version'          => '2.0.0',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['newsy-customizer']         = array(
			'product'          => 'newsy',
			'name'             => 'Newsy Customizer',
			'slug'             => 'newsy-customizer',
			'description'      => esc_html__( 'Newsy Customizer is a plugin that allows you to use theme options in WordPress Customizer.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/newsy-customizer.png',
			'source'           => NEWSY_THEME_PATH . 'includes/plugins/newsy-customizer.zip',
			'version'          => '2.0.0',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['newsy-jsonld']             = array(
			'product'          => 'newsy',
			'name'             => 'Newsy JSON-LD',
			'slug'             => 'newsy-jsonld',
			'description'      => esc_html__( 'Rich snippet for Newsy with JSON LD Form. JSON LD is newest version of Rich snippet. and becoming future of rich snippet.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/newsy-jsonld.png',
			'source'           => NEWSY_THEME_PATH . 'includes/plugins/newsy-jsonld.zip',
			'version'          => '2.0.0',
			'required'         => false,
			'force_activation' => false,
		);

		$plugins['js_composer']            = array(
			'product'          => 'newsy',
			'name'             => 'WPBakery Page Builder',
			'slug'             => 'js_composer',
			'pre_heading'      => esc_html__( 'Page Builder', 'newsy' ),
			'description'      => esc_html__( 'Drag and drop page builder for WordPress. Take full control over your WordPress site, build any layout you can imagine – no programming knowledge required.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/js_composer.png',
			'source'           => NEWSY_THEME_PATH . 'includes/plugins/js_composer.zip',
			'version'          => '6.9.0',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['elementor']              = array(
			'product'          => 'newsy',
			'name'             => 'Elementor Page Builder',
			'slug'             => 'elementor',
			'description'      => esc_html__( 'Elementor is the best FREE WordPress Website Builder, with over 5 million active installs. Create beautiful sites and pages using a drag and drop interface.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/elementor.png',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['amp']                    = array(
			'product'          => 'newsy',
			'name'             => 'WordPress AMP',
			'slug'             => 'amp',
			'pre_heading'      => esc_html__( 'Amp Support', 'newsy' ),
			'description'      => esc_html__( 'Add AMP support to your WordPress site.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/amp.png',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['newsy-amp']              = array(
			'product'          => 'newsy',
			'name'             => 'Newsy AMP',
			'slug'             => 'newsy-amp',
			'description'      => esc_html__( 'Extend WordPress AMP to fit with Newsy Style', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/newsy-amp.png',
			'source'           => NEWSY_THEME_PATH . 'includes/plugins/newsy-amp.zip',
			'version'          => '2.0.0',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['simple-membership']      = array(
			'product'          => 'newsy',
			'name'             => 'Simple WordPress Membership',
			'slug'             => 'simple-membership',
			'pre_heading'      => esc_html__( 'Restricted Content Support', 'newsy' ),
			'description'      => esc_html__( 'A flexible, well-supported, and easy-to-use WordPress membership plugin for offering free and premium content from your WordPress site.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/simple-membership.png',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['newsy-membership']       = array(
			'product'          => 'newsy',
			'name'             => 'Newsy Membership',
			'slug'             => 'newsy-membership',
			'description'      => esc_html__( 'Extend Simple WordPress Membership to fit with Newsy Style', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/newsy-membership.png',
			'source'           => NEWSY_THEME_PATH . 'includes/plugins/newsy-membership.zip',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['buddypress']             = array(
			'product'          => 'newsy',
			'name'             => 'BuddyPress',
			'slug'             => 'buddypress',
			'pre_heading'      => esc_html__( 'Supported Plugins', 'newsy' ),
			'description'      => esc_html__( 'BuddyPress helps site builders & developers add community features to their websites.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/buddypress.png',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['buddypress-followers']   = array(
			'product'          => 'newsy',
			'name'             => 'BuddyPress Follow',
			'slug'             => 'buddypress-followers',
			'description'      => esc_html__( 'Follow members on your BuddyPress site with this nifty plugin.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/buddypress-follow.png',
			'source'           => NEWSY_THEME_PATH . 'includes/plugins/buddypress-followers.zip',
			'version'          => '1.2.3',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['mycred']                 = array(
			'product'          => 'newsy',
			'name'             => 'myCred',
			'slug'             => 'mycred',
			'description'      => esc_html__( 'myCred is an intelligent and adaptive points management system that allows you to build and manage a broad range of digital rewards including points, ranks and, badges on your WordPress powered website.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/mycred.png',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['bbpress']                = array(
			'product'          => 'newsy',
			'name'             => 'bbPress',
			'slug'             => 'bbpress',
			'description'      => esc_html__( 'bbPress is forum software with a twist from the creators of WordPress.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/bbpress.png',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['woocommerce']            = array(
			'product'          => 'newsy',
			'name'             => 'WooCommerce',
			'slug'             => 'woocommerce',
			'description'      => esc_html__( 'WooCommerce is the world\'s most popular open-source eCommerce solution.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/woocommerce.png',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['loco-translate']         = array(
			'product'          => 'newsy',
			'name'             => 'Loco Translate',
			'slug'             => 'loco-translate',
			'pre_heading'      => esc_html__( 'Recommended Plugins', 'newsy' ),
			'description'      => esc_html__( 'Translate WordPress plugins and themes directly in your browser', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/loco-translate.png',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['polylang']               = array(
			'product'          => 'newsy',
			'name'             => 'Polylang',
			'slug'             => 'polylang',
			'description'      => esc_html__( 'Making WordPress multilingual', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/polylang.png',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['wordpress-social-login'] = array(
			'product'          => 'newsy',
			'name'             => 'WordPress Social Login',
			'slug'             => 'wordpress-social-login',
			'description'      => esc_html__( 'Allow your visitors to comment and login with social networks such as Twitter, Facebook, Google, Yahoo and more.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/wsl.png',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['contact-form-7']         = array(
			'product'          => 'newsy',
			'name'             => 'Contact Form 7',
			'slug'             => 'contact-form-7',
			'description'      => esc_html__( 'Just another contact form plugin. Simple but flexible.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/contact-form-7.png',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['wordpress-seo']          = array(
			'product'          => 'newsy',
			'name'             => 'Yoast SEO',
			'slug'             => 'wordpress-seo',
			'description'      => esc_html__( 'Improve your WordPress SEO: Write better content and have a fully optimized WordPress site using the Yoast SEO plugin.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/seo.png',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['wp-super-cache']         = array(
			'product'          => 'newsy',
			'name'             => 'WP Super Cache',
			'slug'             => 'wp-super-cache',
			'refresh'          => true,
			'description'      => esc_html__( 'Very fast caching plugin for WordPress.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/wp-super-cache.png',
			'required'         => false,
			'force_activation' => false,
		);
		$plugins['autoptimize']            = array(
			'product'          => 'newsy',
			'name'             => 'Autoptimize',
			'slug'             => 'autoptimize',
			'refresh'          => true,
			'description'      => esc_html__( 'Makes your site faster by optimizing CSS, JS, Images, Google fonts and more.', 'newsy' ),
			'thumbnail'        => NEWSY_THEME_URI . '/assets/images/admin/plugins/autoptimize.png',
			'required'         => false,
			'force_activation' => false,
		);

		return $plugins;
	}
}

add_filter( 'ak-framework/post/meta', 'newsy_register_post_meta' );

if ( ! function_exists( 'newsy_register_post_meta' ) ) {
	/**
	 * Register Post Metaboxes to framework.
	 *
	 * @return array
	 */
	function newsy_register_post_meta( $meta ) {
		$meta['newsy-post-meta'] = array(
			'title'     => esc_html__( 'Newsy Post Options', 'newsy' ),
			'post_type' => 'post',
			'context'   => 'normal',
			'prefix'    => false,
			'priority'  => 'high',
			'file'      => NEWSY_THEME_PATH . 'includes/options/metabox/post.php', //panel conf
		);

		$meta['newsy-page-meta'] = array(
			'title'     => esc_html__( 'Newsy Page Options', 'newsy' ),
			'post_type' => 'page',
			'context'   => 'normal',
			'prefix'    => false,
			'priority'  => 'high',
			'file'      => NEWSY_THEME_PATH . 'includes/options/metabox/page.php', //panel conf
		);

		return $meta;
	}
}

add_filter( 'ak-framework/taxonomy/meta', 'newsy_register_taxonomy_meta' );

if ( ! function_exists( 'newsy_register_taxonomy_meta' ) ) {
	/**
	 * Register Taxonomy Metaboxes to framework.
	 *
	 * @return array
	 */
	function newsy_register_taxonomy_meta( $meta ) {
		$meta['newsy-category-meta'] = array(
			'title'      => esc_html__( 'Newsy Category Options', 'newsy' ),
			'global_css' => true,
			'taxonomy'   => 'category',
			'file'       => NEWSY_THEME_PATH . 'includes/options/metabox/archive.php', //panel conf
		);

		$meta['newsy-tag-meta'] = array(
			'title'    => esc_html__( 'Newsy Tag Options', 'newsy' ),
			'taxonomy' => 'post_tag',
			'file'     => NEWSY_THEME_PATH . 'includes/options/metabox/archive.php', //same as category
		);

		$meta['newsy-reaction-meta'] = array(
			'title'      => esc_html__( 'Newsy reaction Options', 'newsy' ),
			'global_css' => true,
			'taxonomy'   => 'reaction',
			'file'       => NEWSY_THEME_PATH . 'includes/options/metabox/archive.php', //same as category
		);

		$meta['newsy-product-cat-meta'] = array(
			'title'      => esc_html__( 'Newsy Product Category Options', 'newsy' ),
			'global_css' => true,
			'taxonomy'   => 'product_cat',
			'file'       => NEWSY_THEME_PATH . 'includes/options/metabox/product_cat.php', //same as category
		);

		return $meta;
	}
}

add_filter( 'ak-framework/menus', 'newsy_register_menus' );

if ( ! function_exists( 'newsy_register_menus' ) ) {
	/**
	 * Register the Newsy Menus to framework.
	 *
	 * @return array
	 */
	function newsy_register_menus( $menus ) {
		$menus['main-menu']   = esc_html__( 'Main Navigation', 'newsy' );
		$menus['top-menu']    = esc_html__( 'Topbar Navigation', 'newsy' );
		$menus['footer-menu'] = esc_html__( 'Footer Navigation', 'newsy' );
		$menus['mobile-menu'] = esc_html__( 'Mobile Navigation', 'newsy' );
		$menus['member-menu'] = esc_html__( 'Member Navigation', 'newsy' );

		return $menus;
	}
}

add_filter( 'ak-framework/menu/meta', 'newsy_register_menu_meta' );

if ( ! function_exists( 'newsy_register_menu_meta' ) ) {
	/**
	 * Register the Newsy Menu Metaboxes to framework.
	 *
	 * @return array
	 */
	function newsy_register_menu_meta( $meta ) {
		$meta['main-menu']   = array(
			'title' => esc_html__( 'Newsy Main Menu Options', 'newsy' ),
			'file'  => NEWSY_THEME_PATH . 'includes/options/metabox/menu.php',
		);
		$meta['top-menu']    = array(
			'title' => esc_html__( 'Newsy Top Menu Options', 'newsy' ),
			'file'  => NEWSY_THEME_PATH . 'includes/options/metabox/top-menu.php',
		);
		$meta['mobile-menu'] = array(
			'title' => esc_html__( 'Newsy Mobile Menu Options', 'newsy' ),
			'file'  => NEWSY_THEME_PATH . 'includes/options/metabox/default-menu.php',
		);
		$meta['global']      = array(
			'title' => esc_html__( 'Newsy Menu Options', 'newsy' ),
			'file'  => NEWSY_THEME_PATH . 'includes/options/metabox/default-menu.php',
		);

		return $meta;
	}
}

add_filter( 'ak-framework/menu/mega-menu', 'newsy_register_mega_menu' );

if ( ! function_exists( 'newsy_register_mega_menu' ) ) {
	/**
	 * Register the Newsy Mega Menus to framework.
	 *
	 * @return array
	 */
	function newsy_register_mega_menu( $mega ) {
		$mega['tabbed-posts']    = array(
			'name' => esc_html__( 'Tabbed Posts', 'newsy' ),
			'file' => NEWSY_THEME_PATH . 'includes/menus/tabbed-posts.php',
		);
		$mega['4-columns-posts'] = array(
			'name' => esc_html__( '4 Columns Posts', 'newsy' ),
			'file' => NEWSY_THEME_PATH . 'includes/menus/4-columns-posts.php',
		);
		$mega['big-small-posts'] = array(
			'name' => esc_html__( 'Big & Small Posts', 'newsy' ),
			'file' => NEWSY_THEME_PATH . 'includes/menus/big-small-posts.php',
		);
		$mega['small-posts']     = array(
			'name' => esc_html__( 'Small Posts', 'newsy' ),
			'file' => NEWSY_THEME_PATH . 'includes/menus/small-posts.php',
		);
		$mega['viral-menu']      = array(
			'name' => esc_html__( 'Viral Menu', 'newsy' ),
			'file' => NEWSY_THEME_PATH . 'includes/menus/viral-menu.php',
		);
		$mega['custom-menu']     = array(
			'name' => esc_html__( 'Custom Menu', 'newsy' ),
			'file' => NEWSY_THEME_PATH . 'includes/menus/custom-menu.php',
		);

		return $mega;
	}
}

add_filter( 'ak-framework/image-sizes', 'newsy_register_image_sizes' );

if ( ! function_exists( 'newsy_register_image_sizes' ) ) {
	/**
	 * Register the Newsy Image sizes to framework.
	 *
	 * @return array
	 */
	function newsy_register_image_sizes( $image_sizes ) {
		// dimension : 0.5
		$image_sizes['newsy_360x180']  = array(
			'width'     => 360,
			'height'    => 180,
			'crop'      => true,
			'dimension' => 500,
		);
		$image_sizes['newsy_750x375']  = array(
			'width'     => 750,
			'height'    => 375,
			'crop'      => true,
			'dimension' => 500,
		);
		$image_sizes['newsy_1140x570'] = array(
			'width'     => 1140,
			'height'    => 570,
			'crop'      => true,
			'dimension' => 500,
		);

		// dimension : 0.715
		$image_sizes['newsy_120x86']  = array(
			'width'     => 120,
			'height'    => 86,
			'crop'      => true,
			'dimension' => 715,
		);
		$image_sizes['newsy_350x250'] = array(
			'width'     => 350,
			'height'    => 250,
			'crop'      => true,
			'dimension' => 715,
		);
		$image_sizes['newsy_750x536'] = array(
			'width'     => 750,
			'height'    => 536,
			'crop'      => true,
			'dimension' => 715,
		);

		// dimension 1
		$image_sizes['newsy_75x75']   = array(
			'width'     => 75,
			'height'    => 75,
			'crop'      => true,
			'dimension' => 1000,
		);
		$image_sizes['newsy_300x250'] = array(
			'width'     => 300,
			'height'    => 250,
			'crop'      => true,
			'dimension' => 1000,
		);

		// dimension 1.4
		$image_sizes['newsy_360x504'] = array(
			'width'     => 360,
			'height'    => 504,
			'crop'      => true,
			'dimension' => 1400,
		);

		// featured post
		$image_sizes['newsy_750x0']  = array(
			'width'     => 750,
			'height'    => 0,
			'crop'      => true,
			'dimension' => 1000,
		);
		$image_sizes['newsy_1140x0'] = array(
			'width'     => 1140,
			'height'    => 0,
			'crop'      => true,
			'dimension' => 1000,
		);

		return $image_sizes;
	}
}

add_filter( 'ak-framework/sidebar', 'newsy_register_sidebars' );

if ( ! function_exists( 'newsy_register_sidebars' ) ) {
	/**
	 * Register the Newsy sidebars to framework.
	 *
	 * @return array
	 */
	function newsy_register_sidebars( $sidebars ) {
		$sidebars['primary-sidebar']   = esc_html__( 'Primary Sidebar', 'newsy' );
		$sidebars['secondary-sidebar'] = esc_html__( 'Secondary Sidebar', 'newsy' );
		$sidebars['footer-1']          = esc_html__( 'Footer - Column 1', 'newsy' );
		$sidebars['footer-2']          = esc_html__( 'Footer - Column 2', 'newsy' );
		$sidebars['footer-3']          = esc_html__( 'Footer - Column 3', 'newsy' );

		return $sidebars;
	}
}

add_filter( 'ak-framework/sidebar/args', 'newsy_register_sidebar_args', 11 );

if ( ! function_exists( 'newsy_register_sidebar_args' ) ) {
	/**
	 * Register the Newsy sidebar arguments to framework.
	 *
	 * @return array
	 */
	function newsy_register_sidebar_args( $args ) {
		$header_style = newsy_get_option( 'block_header_style', 'style-1' );

		$args['before_widget'] = '<div id="%1$s" class="widget %2$s">';
		$args['after_widget']  = '</div>';
		$args['before_title']  = '<div class="ak-block-header ak-block-header-' . $header_style . '"><h4 class="widget-title ak-block-title"><span class="title-text">';
		$args['after_title']   = '</span></h4></div>';

		return $args;
	}
}

add_filter( 'ak-framework/register/translation', 'newsy_register_translation_fields', 11 );

if ( ! function_exists( 'newsy_register_translation_fields' ) ) {
	/**
	 * Register the Newsy translations to framework.
	 *
	 * @return array
	 */
	function newsy_register_translation_fields( $fields ) {
		$fields['newsy'] = array(
			'name' => esc_html__( 'Newsy Theme', 'newsy' ),
			'file' => NEWSY_THEME_PATH . 'includes/options/theme-panel/theme-translation.php',
		);

		return $fields;
	}
}

add_filter( 'ak-framework/register/icons', 'newsy_register_frontend_icons', 11 );

if ( ! function_exists( 'newsy_register_frontend_icons' ) ) {
	/**
	 * Register the Newsy frontend icons to framework.
	 *
	 * @return array
	 */
	function newsy_register_frontend_icons( $icons ) {
		$icons['akfi'] = array(
			'name'    => esc_html__( 'Newsy Icons', 'newsy' ),
			'search'  => 'akfi-',
			'file'    => NEWSY_THEME_PATH . 'assets/css/akfi.css',
			'version' => NEWSY_THEME_VERSION,
		);

		return $icons;
	}
}

add_filter( 'ak-framework/form/controls', 'newsy_custom_form_controls', 11 );

if ( ! function_exists( 'newsy_custom_form_controls' ) ) {
	/**
	 * Register the Newsy part builder fields to framework.
	 *
	 * @return array
	 */
	function newsy_custom_form_controls( $controls ) {
		$controls['part_builder'] = 'Newsy\Support\PartBuilder';

		return $controls;
	}
}

add_action( 'ak-framework/frontend/ajax', 'newsy_register_theme_ajax' );

if ( ! function_exists( 'newsy_register_theme_ajax' ) ) {
	/**
	 * Register the Newsy ajax handlers to framework.
	 *
	 * @return array
	 */
	function newsy_register_theme_ajax( $action ) {
		switch ( $action ) {
			case 'ajax_login':
			case 'ajax_register':
			case 'ajax_recover_password':
				$account = Newsy\Ajax\AuthAjax::get_instance();
				$account->handle( $action );
				break;

			case 'ajax_post_autoload':
				Newsy\Ajax\PostAjax::handle_autoload();
				break;

			case 'ajax_post_counter':
				Newsy\Ajax\PostAjax::handle_counter();
				break;

			case 'ajax_post_comments':
				Newsy\Ajax\PostAjax::handle_comments();
				break;

			case 'ajax_drawer_content':
				Newsy\Ajax\DrawerAjax::handle_load();
				break;

			case 'ajax_refresh_nonce':
				if ( isset( $_POST['refresh_nonce'] ) ) {
					$refresh_nonce = sanitize_text_field( $_POST['refresh_nonce'] );
					if ( ! empty( $refresh_nonce ) ) {
						wp_send_json(
							array(
								'nonce' => wp_create_nonce( $refresh_nonce ),
							)
						);
					}
				}
				break;
		}
	}
}
