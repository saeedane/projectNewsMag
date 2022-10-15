<?php

$sections['theme_version'] = array(
	'box-settings' => array(
		'header'   => esc_html__( 'Newsy Versions', 'newsy' ),
		'position' => 10,
	),
	'items'        => array(
		//display theme version
		array(
			'type'  => 'wp_theme.version',
			'label' => esc_html__( 'Version', 'newsy' ),
		),
		//display custom field
		array(
			'type'  => 'ak_pages.history',
			'label' => esc_html__( 'History', 'newsy' ),
			'value' => ' - ',
		),
	),
);

$sections['wordpress_env'] = array(

	'box-settings' => array(
		'header'   => esc_html__( 'WordPress Environment', 'newsy' ),
		'position' => 15,
		'icon'     => 'fa-wordpress',
	),
	'items'        => array(
		array(
			'type'  => 'bloginfo.url',
			'label' => 'Home URL:',
		),
		//display site url
		array(
			'type'  => 'bloginfo.wpurl',
			'label' => 'Site URL:',
		),
		//login url
		array(
			'type'  => 'wp.login_url',
			'label' => 'Login URL:',
		),
		// WP version
		array(
			'type'  => 'wp.version',
			'label' => 'WP Version:',
		),
		// WP Memory Limit
		array(
			'type'     => 'wp.memory_limit',
			'label'    => 'WP Memory Limit:',
			'settings' => array(
				'standard_value' => '128M',
				'minimum_value'  => '64M',
			),
		),
		// php Memory Limit
		array(
			'type'  => 'ini.memory_limit',
			'label' => 'PHP Memory Limit:',
		),
		// WP Debug Mode
		array(
			'type'  => 'wp.debug_mode',
			'label' => 'WP Debug Mode:',
		),
		// WP Language
		array(
			'type'  => 'func.get_locale',
			'label' => 'WP Language:',
		),
		// WP multisite check
		array(
			'type'     => 'func.is_multisite',
			'label'    => 'WP Multisite:',
			'settings' => array(
				'hide_mark' => true,
			),
		),
		// cache plugin checker
		array(
			'type'  => 'wp.cache_exists',
			'label' => esc_html__( 'Caching plugin:', 'newsy' ),
		),
	),
);

$sections['server_info'] = array(
	'box-settings' => array(
		'header'   => esc_html__( 'Server Environment', 'newsy' ),
		'position' => 20,
	),
	'items'        => array(
		//web server
		array(
			'type'  => 'server.web_server',
			'label' => 'Server Info:',
		),
		//php version
		array(
			'type'  => 'server.php_version',
			'label' => 'PHP Version:',
		),
		//mysql version
		array(
			'type'  => 'server.mysql_version',
			'label' => 'Mysql Version:',
		),
		//PHP Post Max Size
		array(
			'type'  => 'ini.post_max_size',
			'label' => 'PHP Post Max Size:',
			'help'  => 'Post Max Upload Size',
		),
		//PHP max upload size
		array(
			'type'  => 'wp.max_upload_size',
			'label' => 'Max Upload Size:',
		),
		//PHP execution time limit
		array(
			'type'              => 'ini.max_execution_time',
			'label'             => 'PHP Time Limit:',
			'after_description' => esc_html__( ' Second', 'newsy' ),
			'settings'          => array(
				'standard_value' => '20',
				'minimum_value'  => '10',
			),
		),
		//PHP max input vars
		array(
			'type'     => 'ini.max_input_vars',
			'label'    => 'PHP MAX Input Vars:',
			'settings' => array(
				'standard_value' => '1500',
				'minimum_value'  => '1000',
			),
		),
		//SUHOSIN checker
		array(
			'type'  => 'server.suhosin_installed',
			'label' => esc_html__( 'SUHOSIN Installed:', 'newsy' ),
			'help'  => esc_html__( 'check SUHOSIN Installed?', 'newsy' ),
		),
		//ZipArchive exists
		array(
			'type'  => 'server.zip_archive',
			'label' => 'ZipArchive:',
			'help'  => '',
		),
		//check remote_get
		array(
			'type'  => 'server.remote_get',
			'label' => 'WP Remote Get:',
			'help'  => '',
		),
		//check remote_post
		array(
			'type'  => 'server.remote_post',
			'label' => 'WP Remote Post:',
			'help'  => '',
		),
	),
);

$sections['active_plugins'] = array(
	'box-settings' => array(
		'header'    => esc_html__( 'Active Plugins (%%count%%)', 'newsy' ),
		'position'  => 55,
		'operation' => 'list-active-plugin',
	),
);

$sections['export'] = array(
	'box-settings' => array(
		'header'    => esc_html__( 'Get system report', 'newsy' ),
		'position'  => 5,
		'operation' => 'report-export',
	),
);
