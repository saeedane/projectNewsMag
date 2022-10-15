<?php
$demo_id         = 'gamer';
$demo_import_url = newsy_get_demo_media_url( $demo_id );
$demo_path       = NEWSY_THEME_PATH . 'includes/demos/' . $demo_id . '/';

$demo['plugin'] = array( 'js_composer', 'newsy-elements', 'newsy-social-share', 'newsy-reaction', 'newsy-social-counter', 'newsy-view-counter', 'newsy-voting' );

$demo['media'] = array(
	array(
		'the_ID'       => 'ak-newsy-logo',
		'file'         => $demo_import_url . $demo_id . '-logo.png',
		'resize'       => false,
		'force_import' => true,
	),
	array(
		'the_ID'       => 'ak-newsy-logo2x',
		'file'         => $demo_import_url . $demo_id . '-logo@2x.png',
		'resize'       => false,
		'force_import' => true,
	),
	array(
		'the_ID'       => 'ak-newsy-logo-dark',
		'file'         => $demo_import_url . $demo_id . '-logo-dark.png',
		'resize'       => false,
		'force_import' => true,
	),
	array(
		'the_ID'       => 'ak-newsy-logo-dark2x',
		'file'         => $demo_import_url . $demo_id . '-logo-dark@2x.png',
		'resize'       => false,
		'force_import' => true,
	),
	array(
		'the_ID' => 'ak-media-favicon',
		'file'   => $demo_import_url . 'favicon.png',
	),
	array(
		'the_ID'       => 'ak-ad-300X250',
		'file'         => $demo_import_url . 'ads/300X250.png',
		'resize'       => false,
		'force_import' => true,
	),
	array(
		'the_ID'       => 'ak-ad-300X600',
		'file'         => $demo_import_url . 'ads/300X600.png',
		'resize'       => false,
		'force_import' => true,
	),
	array(
		'the_ID'       => 'ak-ad-350X300',
		'file'         => $demo_import_url . 'ads/350X300.png',
		'resize'       => false,
		'force_import' => true,
	),
	array(
		'the_ID'       => 'ak-ad-728X90',
		'file'         => $demo_import_url . 'ads/728X90.png',
		'resize'       => false,
		'force_import' => true,
	),
	array(
		'the_ID'       => 'ak-ad-970X90',
		'file'         => $demo_import_url . 'ads/970X90.png',
		'resize'       => false,
		'force_import' => true,
	),
	array(
		'the_ID'       => 'ak-ad-970X150',
		'file'         => $demo_import_url . 'ads/970X150.png',
		'resize'       => false,
		'force_import' => true,
	),
	array(
		'the_ID'       => 'ak-ad-970X250',
		'file'         => $demo_import_url . 'ads/970X250.png',
		'resize'       => false,
		'force_import' => true,
	),
	array(
		'the_ID' => 'ak-media-1',
		'file'   => $demo_import_url . 'posts/post-1.jpg',
	),
	array(
		'the_ID' => 'ak-media-2',
		'file'   => $demo_import_url . 'posts/post-2.jpg',
	),
	array(
		'the_ID' => 'ak-media-3',
		'file'   => $demo_import_url . 'posts/post-3.jpg',
	),
	array(
		'the_ID' => 'ak-media-4',
		'file'   => $demo_import_url . 'posts/post-4.jpg',
	),
	array(
		'the_ID' => 'ak-media-5',
		'file'   => $demo_import_url . 'posts/post-5.jpg',
	),
	array(
		'the_ID' => 'ak-media-6',
		'file'   => $demo_import_url . 'posts/post-6.jpg',
	),
	array(
		'the_ID' => 'ak-media-7',
		'file'   => $demo_import_url . 'posts/post-7.jpg',
	),
	array(
		'the_ID' => 'ak-media-8',
		'file'   => $demo_import_url . 'posts/post-8.jpg',
	),
	array(
		'the_ID' => 'ak-media-9',
		'file'   => $demo_import_url . 'posts/post-9.jpg',
	),
	array(
		'the_ID' => 'ak-media-10',
		'file'   => $demo_import_url . 'posts/post-10.jpg',
	),
	array(
		'the_ID' => 'ak-media-11',
		'file'   => $demo_import_url . 'posts/post-11.jpg',
	),
	array(
		'the_ID' => 'ak-media-12',
		'file'   => $demo_import_url . 'posts/post-12.jpg',
	),
	array(
		'the_ID' => 'ak-media-13',
		'file'   => $demo_import_url . 'posts/post-13.jpg',
	),
	array(
		'the_ID' => 'ak-media-14',
		'file'   => $demo_import_url . 'posts/post-14.jpg',
	),
	array(
		'the_ID' => 'ak-media-15',
		'file'   => $demo_import_url . 'posts/post-15.jpg',
	),
	array(
		'the_ID' => 'ak-media-16',
		'file'   => $demo_import_url . 'posts/post-16.jpg',
	),
	array(
		'the_ID' => 'ak-media-17',
		'file'   => $demo_import_url . 'posts/post-17.jpg',
	),
	array(
		'the_ID' => 'ak-media-18',
		'file'   => $demo_import_url . 'posts/post-18.jpg',
	),
	array(
		'the_ID' => 'ak-media-19',
		'file'   => $demo_import_url . 'posts/post-19.jpg',
	),
	array(
		'the_ID' => 'ak-media-20',
		'file'   => $demo_import_url . 'posts/post-20.jpg',
	),
	array(
		'the_ID' => 'ak-media-21',
		'file'   => $demo_import_url . 'posts/post-21.jpg',
	),
	array(
		'the_ID' => 'ak-media-22',
		'file'   => $demo_import_url . 'posts/post-22.jpg',
	),

	array(
		'the_ID' => 'ak-media-23',
		'file'   => $demo_import_url . 'posts/post-23.jpg',
	),

	array(
		'the_ID' => 'ak-media-24',
		'file'   => $demo_import_url . 'posts/post-24.jpg',
	),
	array(
		'the_ID' => 'ak-media-25',
		'file'   => $demo_import_url . 'posts/post-25.jpg',
	),
	array(
		'the_ID' => 'ak-media-26',
		'file'   => $demo_import_url . 'posts/post-26.jpg',
	),
	array(
		'the_ID' => 'ak-media-27',
		'file'   => $demo_import_url . 'posts/post-27.jpg',
	),
	array(
		'the_ID' => 'ak-media-28',
		'file'   => $demo_import_url . 'posts/post-28.jpg',
	),
	array(
		'the_ID' => 'ak-media-29',
		'file'   => $demo_import_url . 'posts/post-29.jpg',
	),
	array(
		'the_ID' => 'ak-media-30',
		'file'   => $demo_import_url . 'posts/post-30.jpg',
	),
	array(
		'the_ID' => 'ak-media-31',
		'file'   => $demo_import_url . 'posts/post-31.jpg',
	),

	array(
		'the_ID' => 'ak-media-32',
		'file'   => $demo_import_url . 'posts/post-32.jpg',
	),
	array(
		'the_ID' => 'ak-media-33',
		'file'   => $demo_import_url . 'posts/post-33.jpg',
	),

	array(
		'the_ID' => 'ak-media-34',
		'file'   => $demo_import_url . 'posts/post-34.jpg',
	),
	array(
		'the_ID' => 'ak-media-35',
		'file'   => $demo_import_url . 'posts/post-35.jpg',
	),
	array(
		'the_ID' => 'ak-media-36',
		'file'   => $demo_import_url . 'posts/post-36.jpg',
	),
	array(
		'the_ID' => 'ak-media-37',
		'file'   => $demo_import_url . 'posts/post-37.jpg',
	),
	array(
		'the_ID' => 'ak-media-38',
		'file'   => $demo_import_url . 'posts/post-38.jpg',
	),
	array(
		'the_ID' => 'ak-media-39',
		'file'   => $demo_import_url . 'posts/post-39.jpg',
	),
	array(
		'the_ID' => 'ak-media-40',
		'file'   => $demo_import_url . 'posts/post-40.jpg',
	),
	array(
		'the_ID' => 'ak-media-41',
		'file'   => $demo_import_url . 'posts/post-41.jpg',
	),
	array(
		'the_ID' => 'ak-media-42',
		'file'   => $demo_import_url . 'posts/post-42.jpg',
	),
	array(
		'the_ID' => 'ak-media-43',
		'file'   => $demo_import_url . 'posts/post-43.jpg',
	),
	array(
		'the_ID' => 'ak-media-44',
		'file'   => $demo_import_url . 'posts/post-44.jpg',
	),
	array(
		'the_ID' => 'ak-media-post-content-1',
		'file'   => $demo_import_url . 'post-content/content-1.jpg',
	),
	array(
		'the_ID' => 'ak-media-post-content-2',
		'file'   => $demo_import_url . 'post-content/content-2.jpg',
	),
	array(
		'the_ID' => 'ak-media-post-content-3',
		'file'   => $demo_import_url . 'post-content/content-3.jpg',
	),
	array(
		'the_ID' => 'ak-media-post-content-4',
		'file'   => $demo_import_url . 'post-content/content-4.jpg',
	),
	array(
		'the_ID' => 'ak-media-post-content-5',
		'file'   => $demo_import_url . 'post-content/content-5.jpg',
	),
	array(
		'the_ID' => 'ak-media-post-content-6',
		'file'   => $demo_import_url . 'post-content/content-6.jpg',
	),
	array(
		'the_ID' => 'ak-media-post-content-7',
		'file'   => $demo_import_url . 'post-content/content-7.jpg',
	),
	// reactions
	array(
		'the_ID' => 'ak-media-reaction-clap',
		'file'   => $demo_import_url . 'reactions/clap.svg',
	),
	array(
		'the_ID' => 'ak-media-reaction-approved',
		'file'   => $demo_import_url . 'reactions/approved.svg',
	),
	array(
		'the_ID' => 'ak-media-reaction-not-approved',
		'file'   => $demo_import_url . 'reactions/not-approved.svg',
	),
	array(
		'the_ID' => 'ak-media-reaction-shocked',
		'file'   => $demo_import_url . 'reactions/shocked.svg',
	),
	array(
		'the_ID' => 'ak-media-reaction-unhappy',
		'file'   => $demo_import_url . 'reactions/unhappy.svg',
	),
	array(
		'the_ID' => 'ak-media-reaction-liked',
		'file'   => $demo_import_url . 'reactions/liked.svg',
	),
	array(
		'the_ID' => 'ak-media-reaction-hahaha',
		'file'   => $demo_import_url . 'reactions/hahaha.svg',
	),
	array(
		'the_ID' => 'ak-media-reaction-angry',
		'file'   => $demo_import_url . 'reactions/angry.svg',
	),
	array(
		'the_ID' => 'ak-media-xbox-header',
		'file'   => $demo_import_url . 'xbox-header.jpg',
		'resize' => false,
	),
	array(
		'the_ID' => 'ak-media-ps4-header',
		'file'   => $demo_import_url . 'ps4-header.jpg',
		'resize' => false,
	),
	array(
		'the_ID'       => 'ak-media-main-bg',
		'file'         => $demo_import_url . 'main-bg.jpg',
		'resize'       => false,
		'force_import' => true,
	),
);


$demo['taxonomy'] = array(
	array(
		'the_ID'        => 'ak-featured',
		'name'          => 'Featured',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(),
	),
	array(
		'the_ID'        => 'ak-news',
		'name'          => 'News',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#612a31',
			),
		),
	),
	array(
		'the_ID'        => 'ak-reviews',
		'name'          => 'Reviews',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#e2a900',
			),
		),
	),
	array(
		'the_ID'        => 'ak-ps4',
		'name'          => 'PlayStation',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#0072ce',
			),
			array(
				'key'   => 'term_header_style',
				'value' => 'style-7',
			),
			array(
				'key'   => 'term_header_css',
				'value' => array(
					'background' => array(
						'image' => array(
							'img' => '%attachment_url%ak-media-ps4-header%attachment_url%',
						),
					),
					'padding'    => array(
						'top'    => '70',
						'bottom' => '70',
					),
				),
			),
			array(
				'key'   => 'term_show_term_name',
				'value' => 'hide',
			),
			array(
				'key'   => 'term_show_breadcrumb',
				'value' => 'hide',
			),
			array(
				'key'   => 'term_show_description',
				'value' => 'hide',
			),
			array(
				'key'   => 'term_show_subcategories',
				'value' => 'hide',
			),
		),
	),
	array(
		'the_ID'        => 'ak-xbox',
		'name'          => 'Xbox One',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#50b710',
			),
			array(
				'key'   => 'term_header_style',
				'value' => 'style-7',
			),
			array(
				'key'   => 'term_header_css',
				'value' => array(
					'background' => array(
						'image' => array(
							'img' => '%attachment_url%ak-media-xbox-header%attachment_url%',
						),
					),
					'padding'    => array(
						'top'    => '70',
						'bottom' => '70',
					),
				),
			),
			array(
				'key'   => 'term_show_term_name',
				'value' => 'hide',
			),
			array(
				'key'   => 'term_show_breadcrumb',
				'value' => 'hide',
			),
			array(
				'key'   => 'term_show_description',
				'value' => 'hide',
			),
			array(
				'key'   => 'term_show_subcategories',
				'value' => 'hide',
			),
		),
	),
	array(
		'the_ID'        => 'ak-pc',
		'name'          => 'Pc',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#8d6dc4',
			),
		),
	),
	array(
		'the_ID'        => 'ak-switch',
		'name'          => 'Switch',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#e60012',
			),
		),
	),
	array(
		'the_ID'        => 'ak-video',
		'name'          => 'Video',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#333333',
			),
		),
	),
	// reactions

	array(
		'the_ID'        => 'ak-reaction-clap',
		'name'          => 'Clap',
		'taxonomy'      => 'reaction',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_badge_type',
				'value' => 'icon',
			),
			array(
				'key'   => 'term_badge_icon',
				'value' => '%attachment_url%ak-media-reaction-clap%attachment_url%',
			),
		),
	),
	array(
		'the_ID'        => 'ak-reaction-approved',
		'name'          => 'Approved',
		'taxonomy'      => 'reaction',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_badge_type',
				'value' => 'icon',
			),
			array(
				'key'   => 'term_badge_icon',
				'value' => '%attachment_url%ak-media-reaction-approved%attachment_url%',
			),
		),
	),
	array(
		'the_ID'        => 'ak-reaction-not-approved',
		'name'          => 'Not approved',
		'taxonomy'      => 'reaction',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_badge_type',
				'value' => 'icon',
			),
			array(
				'key'   => 'term_badge_icon',
				'value' => '%attachment_url%ak-media-reaction-not-approved%attachment_url%',
			),
		),
	),
	array(
		'the_ID'        => 'ak-reaction-shocked',
		'name'          => 'Shocked',
		'taxonomy'      => 'reaction',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_badge_type',
				'value' => 'icon',
			),
			array(
				'key'   => 'term_badge_icon',
				'value' => '%attachment_url%ak-media-reaction-shocked%attachment_url%',
			),
		),
	),
	array(
		'the_ID'        => 'ak-reaction-unhappy',
		'name'          => 'Unhappy',
		'taxonomy'      => 'reaction',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_badge_type',
				'value' => 'icon',
			),
			array(
				'key'   => 'term_badge_icon',
				'value' => '%attachment_url%ak-media-reaction-unhappy%attachment_url%',
			),
		),
	),
	array(
		'the_ID'        => 'ak-reaction-liked',
		'name'          => 'Liked',
		'taxonomy'      => 'reaction',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_badge_type',
				'value' => 'icon',
			),
			array(
				'key'   => 'term_badge_icon',
				'value' => '%attachment_url%ak-media-reaction-liked%attachment_url%',
			),
		),
	),
	array(
		'the_ID'        => 'ak-reaction-hahaha',
		'name'          => 'Hahaha',
		'taxonomy'      => 'reaction',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_badge_type',
				'value' => 'icon',
			),
			array(
				'key'   => 'term_badge_icon',
				'value' => '%attachment_url%ak-media-reaction-hahaha%attachment_url%',
			),
		),
	),
	array(
		'the_ID'        => 'ak-reaction-angry',
		'name'          => 'Angry',
		'taxonomy'      => 'reaction',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_badge_type',
				'value' => 'icon',
			),
			array(
				'key'   => 'term_badge_icon',
				'value' => '%attachment_url%ak-media-reaction-angry%attachment_url%',
			),
		),
	),
);


$demo['post'] = array(

	array(
		'the_ID'            => 'ak-post-1',
		'post_title'        => 'Fortnite: Battle Royale does microtransactions perfectly... with one big exception',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-1%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-2',
		'post_title'        => 'Detroit: Become Human\'s new Kara trailer, release date, and everything we know',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-2%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-3',
		'post_title'        => 'March is gonna be good: PlayStation Plus free games get Bloodborne and Ratchet & Clank',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-3%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=ERN1sg1JADI',
					'time' => '12:30',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-4',
		'post_title'        => 'Super Mario Odyssey\'s free balloon world update',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-4%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-switch%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-5',
		'post_title'        => 'It definitely sounds like there won\'t be a new Assassin\'s Creed game this year',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-5%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-6',
		'post_title'        => 'Biomutant: Everything we know so far',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-6%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-7',
		'post_title'        => 'People are already reviewing Red Dead Redemption 2 on Amazon, and they\'re hilarious',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-7%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%,%%ak-xbox%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-8',
		'post_title'        => 'Check out the fan-made Overwatch map that impressed Jeff Kaplan',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-8%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%,%%ak-xbox%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-9',
		'post_title'        => 'PlayerUnknown\'s Battlegrounds Xbox update improves frame rate, performance and weapons balance',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-9%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-xbox%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-10',
		'post_title'        => 'God of War won\'t stop with Norse mythology - prepare for ancient Egyptian and Mayan locations too',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-10%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-11',
		'post_title'        => 'Grab a PS4 Pro and two games, including Horizon Zero Dawn Complete Edition, for £297!',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-11%%',
		'post_terms'        => array(
			'category' => '%%ak-ps4%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-12',
		'post_title'        => 'Need for Speed Payback gets its first big update, adding a new mode, more cars, and "Smackables"',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-12%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%,%%ak-xbox%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-13',
		'post_title'        => 'FIFA 18 Ultimate Team’s best bargains, as chosen by developer EA',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-13%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%,%%ak-xbox%%,%%ak-pc%%,%%ak-switch%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-14',
		'post_title'        => 'Death Stranding gameplay, as explained by Kojima: "Death will never pull you out of the game"',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-14%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-15',
		'post_title'        => 'Still wishing for GTA 5’s story DLC? GTA: Online’s The Doomsday Heist is out now, and it\'s the next best thing',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-15%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-16',
		'post_title'        => 'Last of Us Part 2 is 50% done and God of War will be 25 hours long, say devs at PSX 2017',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-16%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=W2Wnvvj33Wo',
					'time' => '12:30',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-17',
		'post_title'        => 'New Tomb Raider confirmed, here\'s what the leaks already tell us',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-17%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-18',
		'post_title'        => 'Life is Strange: Before the Storm review: “Deeper and more human than the original series”',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-18%%',
		'post_terms'        => array(
			'category' => '%%ak-reviews%%,%%ak-ps4%%,%%ak-xbox%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-reviews%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-19',
		'post_title'        => 'Red Dead Redemption 2 gets (hopefully) one last delay and an official release date',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-19%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-20',
		'post_title'        => 'The upcoming PS4 games for 2018 and beyond',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-20%%',
		'post_terms'        => array(
			'category' => '%%ak-ps4%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-21',
		'post_title'        => 'Horizon: Zero Dawn, still can’t quite believe it wasn’t Game of the Year 2017',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-21%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%,%%ak-featured%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-22',
		'post_title'        => 'Here\'s where to find all of the Stone Circles in Assassin\'s Creed Origins',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-22%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%,%%ak-xbox%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-23',
		'post_title'        => 'Star Wars Battlefront 2 review: "Exceptionally polished and entertaining multiplayer, with an unfulfilling campaign tacked on"',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-23%%',
		'post_terms'        => array(
			'category' => '%%ak-reviews%%,%%ak-ps4%%,%%ak-xbox%%,%%ak-pc%%,%%ak-featured%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-reviews%%',
			),
		),

	),
	array(
		'the_ID'            => 'ak-post-24',
		'post_title'        => 'Football Manager 2018 review: “Changes for the sake of changes sours an otherwise engaging experience”',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-24%%',
		'post_terms'        => array(
			'category' => '%%ak-reviews%%,%%ak-pc%%,%%ak-featured%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-reviews%%',
			),
		),

	),
	array(
		'the_ID'            => 'ak-post-25',
		'post_title'        => 'Call of Duty WW2 review: "Getting rid of the gimmicks creates a much purer point and shoot experience"',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-25%%',
		'post_terms'        => array(
			'category' => '%%ak-reviews%%,%%ak-ps4%%,%%ak-xbox%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-reviews%%',
			),
		),

	),
	array(
		'the_ID'            => 'ak-post-26',
		'post_title'        => 'Super Mario Odyssey review: “A beautiful homage to Mario’s history, but also his future.”',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-26%%',
		'post_terms'        => array(
			'category' => '%%ak-reviews%%,%%ak-switch%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-reviews%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-27',
		'post_title'        => 'Assassin\'s Creed Origins review: “This Egyptian playground is finally everything you wanted the Creed to be”',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-27%%',
		'post_terms'        => array(
			'category' => '%%ak-reviews%%,%%ak-ps4%%,%%ak-xbox%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-reviews%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-28',
		'post_title'        => 'Rugby 18 review: “A woefully inadequate representation of one of the world’s most popular sports”',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-28%%',
		'post_terms'        => array(
			'category' => '%%ak-reviews%%,%%ak-ps4%%,%%ak-xbox%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-reviews%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-29',
		'post_title'        => 'PES 2018 review: “As close as we’ve gotten to Pro Evo perfection in a long, long time”',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-29%%',
		'post_terms'        => array(
			'category' => '%%ak-reviews%%,%%ak-ps4%%,%%ak-xbox%%,%%ak-pc%%,%%ak-featured%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-reviews%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-30',
		'post_title'        => 'Final Fantasy 14: Stormblood review: "FF14 at the top of its storytelling game"',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-30%%',
		'post_terms'        => array(
			'category' => '%%ak-reviews%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-reviews%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-31',
		'post_title'        => 'Dirt 4 review: "The series has always been unforgettable... until now"',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-31%%',
		'post_terms'        => array(
			'category' => '%%ak-reviews%%,%%ak-ps4%%,%%ak-xbox%%,%%ak-pc%%,%%ak-featured%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-reviews%%',
			),

		),
	),
	array(
		'the_ID'            => 'ak-post-32',
		'post_title'        => 'So far Far Cry 5 nails what makes the series great, just with added bears',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-32%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%,%%ak-xbox%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-33',
		'post_title'        => 'The best games of 2018 (so far)',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-33%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%,%%ak-xbox%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-34',
		'post_title'        => '160 video games that have snow in them',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-34%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%,%%ak-xbox%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-35',
		'post_title'        => 'Sea of Thieves \'fully embraces\' power levelling, according to the design director',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-35%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%,%%ak-xbox%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-36',
		'post_title'        => 'Fable 4 is happening, it’s story-focused, and everything else we know so far',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-36%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-xbox%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-37',
		'post_title'        => '9 things I wish I knew before playing Rainbow Six Siege Outbreak mode',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-37%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-38',
		'post_title'        => 'Destiny 2’s powerful new Raid perks are the right blueprint for the game’s future. Now Bungie just needs to set them free',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-38%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%,%%ak-xbox%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-39',
		'post_title'        => 'Monster Hunter World armor skills explained',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-39%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-ps4%%,%%ak-xbox%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-40',
		'post_title'        => '15 things I wish I knew before playing Sea of Thieves',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-40%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-xbox%%,%%ak-pc%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-news%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-41',
		'post_title'        => 'Top 10 Worst Heroes in Video Games',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-41%%',
		'post_terms'        => array(
			'category' => '%%ak-video%%',
		),
		'post_format'       => 'video',

		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=fs6mKkrX7vE',
					'time' => '1:30',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-42',
		'post_title'        => 'The 10 best PS4 games right now',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-42%%',
		'post_terms'        => array(
			'category' => '%%ak-video%%,%%ak-ps4%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-video%%',
			),
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=1Jlg-OK7HPY',
					'time' => '1:30',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-43',
		'post_title'        => 'The 10 best Xbox One games right now',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-43%%',
		'post_terms'        => array(
			'category' => '%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=6utMkqnyh7k',
					'time' => '11:30',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-44',
		'post_title'        => 'Another Top 10 Brutal Video Game Deaths',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-44%%',
		'post_terms'        => array(
			'category' => '%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=luTJHNau82Y',
					'time' => '11:30',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-front-page',
		'post_title'        => 'Front page',
		'post_content_file' => $demo_path . 'pages/front-page.txt',
		'post_type'         => 'page',
		'prepare_vc_css'    => true,
		'force_import'      => true,
		'post_meta'         => array(
			array(
				'key'     => '_wp_page_template',
				'value'   => 'page-builder.php',
				'wp_meta' => true,
			),
		),
	),
);

$demo['option'] = array(
	array(
		'the_ID'            => 'ak-newsy-options',
		'type'              => 'option',
		'option_name'       => NEWSY_THEME_OPTIONS,
		'option_value_file' => $demo_path . 'options.json',
		'prepare_css'       => true,
	),

	array(
		'the_ID'       => 'ak-current-theme',
		'type'         => 'option',
		'option_name'  => 'newsy_current_theme_style',
		'option_value' => $demo_id,
	),
	array(
		'the_ID'       => 'ak-show_on_front',
		'type'         => 'wp_option',
		'option_name'  => 'show_on_front',
		'option_value' => 'page',
		'remove_off'   => true,
	),
	array(
		'the_ID'       => 'ak-page_on_front',
		'type'         => 'wp_option',
		'option_name'  => 'page_on_front',
		'option_value' => '%%ak-front-page%%',
	),
	array(
		'the_ID'       => 'ak-posts_per_page',
		'type'         => 'wp_option',
		'option_name'  => 'posts_per_page',
		'option_value' => '10',
		'remove_off'   => true,
	),
	array(
		'the_ID'       => 'ak-site-icon',
		'type'         => 'wp_option',
		'option_name'  => 'site_icon',
		'option_value' => '%%ak-media-favicon%%',
	),
	array(
		'the_ID'       => 'ak-users_can_register',
		'type'         => 'wp_option',
		'option_name'  => 'users_can_register',
		'option_value' => true,
		'remove_off'   => true,
	),
);

$demo['menu'] = array(
	array(
		'the_ID'        => 'ak-main-menu',
		'name'          => 'Main Navigation',
		'location'      => 'main-menu',
		'recently-edit' => true,
		'items'         => array(
			array(
				'item_type' => 'custom',
				'title'     => 'Home',
				'url'       => home_url(),
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-news%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-reviews%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-ps4%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-xbox%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-pc%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-switch%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-video%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
		),
	),
	array(
		'the_ID'        => 'ak-mobile-menu',
		'name'          => 'Mobile Navigation',
		'location'      => 'mobile-menu',
		'recently-edit' => true,
		'items'         => array(
			array(
				'item_type' => 'custom',
				'title'     => 'Home',
				'url'       => home_url(),
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-news%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-reviews%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-ps4%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-xbox%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-pc%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-switch%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-video%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
		),
	),
	array(
		'the_ID'        => 'ak-top-menu',
		'name'          => 'Top Navigation',
		'location'      => 'top-menu',
		'recently-edit' => true,
		'items'         => array(
			array(
				'item_type' => 'custom',
				'title'     => 'Buy Now',
				'url'       => 'https://themeforest.net/item/newsy-viral-news-magazine-wordpress-theme/34626838&ref=akbilisim',
				'item_meta' => array(),
			),
			array(
				'item_type' => 'custom',
				'title'     => 'Documentation',
				'url'       => 'https://support.akbilisim.com/docs/newsy/introduction',
				'item_meta' => array(),
			),
			array(
				'item_type' => 'custom',
				'title'     => 'Support Center',
				'url'       => 'https://support.akbilisim.com/',
				'item_meta' => array(),
			),
			array(
				'item_type' => 'custom',
				'title'     => 'Contact Us',
				'url'       => 'https://themeforest.net/user/akbilisim?ref=akbilisim',
				'item_meta' => array(),
			),
		),
	),
	array(
		'the_ID'        => 'ak-footer-menu',
		'name'          => 'Footer Navigation',
		'location'      => 'footer-menu',
		'recently-edit' => true,
		'items'         => array(
			array(
				'item_type' => 'custom',
				'title'     => 'Buy Now',
				'url'       => 'https://themeforest.net/item/newsy-viral-news-magazine-wordpress-theme/34626838&ref=akbilisim',
				'item_meta' => array(),
			),
			array(
				'item_type' => 'custom',
				'title'     => 'Documentation',
				'url'       => 'https://support.akbilisim.com/docs/newsy/introduction',
				'item_meta' => array(),
			),
			array(
				'item_type' => 'custom',
				'title'     => 'Support Center',
				'url'       => 'https://support.akbilisim.com/',
				'item_meta' => array(),
			),
			array(
				'item_type' => 'custom',
				'title'     => 'Contact Us',
				'url'       => 'https://themeforest.net/user/akbilisim?ref=akbilisim',
				'item_meta' => array(),
			),
		),
	),
);

$demo['widget'] = array(
	array(
		'the_ID'       => 'ak-newsy-widgets',
		'widgets_file' => $demo_path . 'widgets.json',
	),
);
