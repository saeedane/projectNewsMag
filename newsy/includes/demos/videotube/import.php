<?php
$demo_id         = 'videotube';
$demo_import_url = newsy_get_demo_media_url( $demo_id );
$demo_path       = NEWSY_THEME_PATH . 'includes/demos/' . $demo_id . '/';

$demo['plugin'] = array( 'js_composer', 'newsy-elements', 'newsy-social-share', 'newsy-social-counter', 'newsy-view-counter', 'newsy-voting', 'simple-membership', 'newsy-membership' );

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
		'the_ID'       => 'ak-newsy-mobile-logo',
		'file'         => $demo_import_url . $demo_id . '-mobile-logo.png',
		'resize'       => false,
		'force_import' => true,
	),
	array(
		'the_ID' => 'ak-media-favicon',
		'file'   => $demo_import_url . 'favicon.png',
	),
	array(
		'the_ID'       => 'ak-media-header-pattern',
		'file'         => $demo_import_url . 'header-pattern.png',
		'force_import' => true,
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
		'the_ID'       => 'ak-media-popular-bg',
		'file'         => $demo_import_url . 'popular-bg.png',
		'force_import' => true,
	),
	array(
		'the_ID'       => 'ak-media-trending-bg',
		'file'         => $demo_import_url . 'trending-bg.png',
		'force_import' => true,
	),
);

$demo['taxonomy'] = array(
	array(
		'the_ID'        => 'ak-featured',
		'name'          => 'Featured',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#ee3322',
			),
			array(
				'key'   => 'term_badge_type',
				'value' => 'icon',
			),
			array(
				'key'   => 'term_badge_icon',
				'value' => 'akfi-trending_up',
			),
			array(
				'key'   => 'term_badge_color',
				'value' => '#ffffff',
			),
			array(
				'key'   => 'term_badge_bg_color',
				'value' => '#ee3322',
			),
		),
	),
	array(
		'the_ID'        => 'ak-entertainment',
		'name'          => 'Entertainment',
		'description'   => 'Stay updated with the latest news from the entertainment world and what your favourite celebrities are upto.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#ee3322',
			),
			array(
				'key'   => 'term_header_style',
				'value' => 'style-7',
			),
			array(
				'key'   => 'term_header_css',
				'value' => array(
					'background' => array(
						'color' => '#ee3322',
					),
				),
			),
		),
	),
	array(
		'the_ID'        => 'ak-gaming',
		'name'          => 'Gaming',
		'description'   => 'What is “beauty,” exactly? The things that make you feel good, baby. If a parade of the best lipsticks, mascaras, and skincare products (donkey-milk sheet masks, anyone?) sounds like a party you want to be a part of, get in line and wave to the nice people — we’ve got everything to help you do you, no matter your budget.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#9a4557',
			),
			array(
				'key'   => 'term_header_style',
				'value' => 'style-7',
			),
			array(
				'key'   => 'term_header_css',
				'value' => array(
					'background' => array(
						'color' => '#9a4557',
					),
				),
			),
		),
	),
	array(
		'the_ID'        => 'ak-tech',
		'name'          => 'Tech',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#8224e3',
			),
			array(
				'key'   => 'term_header_style',
				'value' => 'style-7',
			),
			array(
				'key'   => 'term_header_css',
				'value' => array(
					'background' => array(
						'color' => '#8224e3',
					),
				),
			),
		),
	),
	array(
		'the_ID'        => 'ak-music',
		'name'          => 'Music',
		'description'   => 'Your guide to taking care of your mind and body so you can take on the world.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#46a700',
			),
			array(
				'key'   => 'term_header_style',
				'value' => 'style-7',
			),
			array(
				'key'   => 'term_header_css',
				'value' => array(
					'background' => array(
						'color' => '#46a700',
					),
				),
			),
		),
	),
	array(
		'the_ID'        => 'ak-cooking',
		'name'          => 'Cooking',
		'description'   => 'Recipes that are worth your time, useful kitchen how-tos and all the food facts you need to feed your body and mind.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#9fa500',
			),
			array(
				'key'   => 'term_header_style',
				'value' => 'style-7',
			),
			array(
				'key'   => 'term_header_css',
				'value' => array(
					'background' => array(
						'color' => '#9fa500',
					),
				),
			),
		),
	),
	array(
		'the_ID'        => 'ak-sport',
		'name'          => 'Sport',
		'description'   => 'Catch up on the latest news, photos, videos, and more on Work/Life.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#0d0eca',
			),
			array(
				'key'   => 'term_header_style',
				'value' => 'style-7',
			),
			array(
				'key'   => 'term_header_css',
				'value' => array(
					'background' => array(
						'color' => '#0d0eca',
					),
				),
			),
		),
	),
	array(
		'the_ID'        => 'ak-travel',
		'name'          => 'Travel',
		'description'   => 'How to vacation well — from planning your time off to finding flight deals and hotel hacks — on a real person\'s budget.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#712fcb',
			),
			array(
				'key'   => 'term_header_style',
				'value' => 'style-7',
			),
			array(
				'key'   => 'term_header_css',
				'value' => array(
					'background' => array(
						'color' => '#712fcb',
					),
				),
			),
		),
	),
	array(
		'the_ID'        => 'ak-news',
		'name'          => 'News',
		'description'   => 'Sometimes funny, sometimes serious, always shareable.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#000000',
			),
		),

	),
);

$demo['post'] = array(
	array(
		'the_ID'            => 'ak-post-1',
		'post_title'        => 'Free Energy Using Speaker Magnet Technology For 2021',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-1%%',
		'post_terms'        => array(
			'category' => '%%ak-gaming%%,%%ak-tech%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=T52cEofR8WI',
					'time' => '7:19',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-2',
		'post_title'        => 'Evolution of Open World Games 1981-2019',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-2%%',
		'post_terms'        => array(
			'category' => '%%ak-gaming%%,%%ak-tech%%,%%ak-featured%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-featured%%',
			),
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=OtHcmh4PydA',
					'time' => '13:50',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-3',
		'post_title'        => 'OLED vs LCD - This Test Ends All...',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-3%%',
		'post_terms'        => array(
			'category' => '%%ak-tech%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=vUfRBoeQ_84',
					'time' => '6:27',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-4',
		'post_title'        => 'All Sports Baseball Battle | Dude Perfect',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-4%%',
		'post_terms'        => array(
			'category' => '%%ak-sport%%,%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=dwV04XuiWq4',
					'time' => '11:57',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-5',
		'post_title'        => 'Taylor Swift - You Need To Calm Down',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-5%%',
		'post_terms'        => array(
			'category' => '%%ak-music%%,%%ak-featured%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-music%%',
			),
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=Dkk9gvTmCXY',
					'time' => '3:31',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-6',
		'post_title'        => '30 Travel Tips and Hints to Make Your Life Simpler',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-6%%',
		'post_terms'        => array(
			'category' => '%%ak-travel%%,%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-entertainment%%',
			),
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=CyPPi6T3D3s',
					'time' => '17:26',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-7',
		'post_title'        => 'Miley Cyrus - Mother\'s Daughter (Official Video)',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-7%%',
		'post_terms'        => array(
			'category' => '%%ak-music%%',
		),

		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=7T2RonyJ_Ts',
					'time' => '3:41',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-8',
		'post_title'        => 'My minecraft Dog is TRAPPED underwater',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-8%%',
		'post_terms'        => array(
			'category' => '%%ak-gaming%%,%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=WzC2f5PSIyw',
					'time' => '23:56',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-9',
		'post_title'        => 'The Most Shocking Mystery Tech Yet',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-9%%',
		'post_terms'        => array(
			'category' => '%%ak-tech%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=z1oydWSfO4o',
					'time' => '5:17',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-10',
		'post_title'        => 'Official VR Spider-Man Game Is Hilarious & Surreal!',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-10%%',
		'post_terms'        => array(
			'category' => '%%ak-gaming%%,%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=D990PJL_CqQ',
					'time' => '13:05',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-11',
		'post_title'        => 'Top 10 NEW Upcoming ZOMBIE Games of 2018 & Beyond | PS4, XBox One, PC',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-11%%',
		'post_terms'        => array(
			'category' => '%%ak-gaming%%,%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=gjeQxqFXnrU',
					'time' => '21:28',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-12',
		'post_title'        => '250,000 Dominoes - The Incredible Science Machine: GAME ON!',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-12%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=Q0jeohWnmAQ',
					'time' => '21:28',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-13',
		'post_title'        => '10 Best FREE iOS & Android Games of 2019',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-13%%',
		'post_terms'        => array(
			'category' => '%%ak-gaming%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=b4g3ssF6G4k',
					'time' => '10:37',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-14',
		'post_title'        => 'Fast Food Recipes You Can Make At Home ',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-14%%',
		'post_terms'        => array(
			'category' => '%%ak-cooking%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=V6Vd1E9OL-U',
					'time' => '5:46',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-15',
		'post_title'        => 'CS:GO in REAL LIFE!! (Counter Strike Airsoft)',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-15%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-gaming%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=nNVu9H7-c9U',
					'time' => '9:46',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-16',
		'post_title'        => 'Top 10 NEW Open World Games of 2019',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-16%%',
		'post_terms'        => array(
			'category' => '%%ak-gaming%%,%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=peRpJ4tqLsc',
					'time' => '12:37',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-17',
		'post_title'        => '10 Most Expensive Hotel Rooms In The World',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-17%%',
		'post_terms'        => array(
			'category' => '%%ak-travel%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=Viwfx0DtjHE',
					'time' => '12:30',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-18',
		'post_title'        => 'Yosemite National Park Vacation Travel Guide | Expedia',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-18%%',
		'post_terms'        => array(
			'category' => '%%ak-travel%%,%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=9fJEFi3ccwI',
					'time' => '9:21',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-19',
		'post_title'        => 'Traveling the World for 2 Years! Chris Rogers',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-19%%',
		'post_terms'        => array(
			'category' => '%%ak-travel%%,%%ak-featured%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-featured%%',
			),
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=CC0ywOEAsIE',
					'time' => '4:49',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-20',
		'post_title'        => 'Top 10 US Travel Destinations You Need to Visit in 2019 | MojoTravels',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-20%%',
		'post_terms'        => array(
			'category' => '%%ak-travel%%,%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=DzVki4f0qZc',
					'time' => '8:38',
				),
			),

		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-21',
		'post_title'        => 'Hawaii Travel Guide: The Island of Hawaii',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-21%%',
		'post_terms'        => array(
			'category' => '%%ak-travel%%,%%ak-featured%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-featured%%',
			),
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=snI9yyE0i3E',
					'time' => '6:03',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-22',
		'post_title'        => 'Neymar Jr - \'s Greatest Entertainment 2019',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-22%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-sport%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=H40Zc5DVo_k',
					'time' => '10:13',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-23',
		'post_title'        => 'Top 10 Most extreme sports',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-23%%',
		'post_terms'        => array(
			'category' => '%%ak-sport%%,%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-entertainment%%',
			),
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=fLJNjHtGLBs',
					'time' => '12:00',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-24',
		'post_title'        => 'Summer Mix 2019 - Chillout Lounge Relaxing Deep House Music ',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-24%%',
		'post_terms'        => array(
			'category' => '%%ak-music%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=8kVI621fZug',
					'time' => '2:59:58',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-25',
		'post_title'        => 'The Most Beautiful Places in the World 🚐',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-25%%',
		'post_terms'        => array(
			'category' => '%%ak-travel%%,%%ak-featured%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=SbeHjcLOkgs',
					'time' => '1:20:57',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-26',
		'post_title'        => 'Childish Gambino - This Is America (Official Video)',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-26%%',
		'post_terms'        => array(
			'category' => '%%ak-music%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=VYOjWnS4cMY',
					'time' => '4:05',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-27',
		'post_title'        => 'What\'s on my Tech: 2019!',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-27%%',
		'post_terms'        => array(
			'category' => '%%ak-tech%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=BSQe-yQ5B84',
					'time' => '18:30',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-28',
		'post_title'        => 'MASSIVE TECH UNBOXING!!',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-28%%',
		'post_terms'        => array(
			'category' => '%%ak-tech%%,%%ak-news%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=raKSq-hW47Y',
					'time' => '17:13',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-29',
		'post_title'        => 'Are Wireless Gaming Mice ACTUALLY Faster??',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-29%%',
		'post_terms'        => array(
			'category' => '%%ak-tech%%,%%ak-gaming%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=orhb7Njj3h8',
					'time' => '11:10',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-30',
		'post_title'        => 'GAMING on The First 8K TV!!!!',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-30%%',
		'post_terms'        => array(
			'category' => '%%ak-tech%%,%%ak-gaming%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=FwBBQhKKm4g',
					'time' => '13:40',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-31',
		'post_title'        => 'The BEST Upcoming Movies 2019 (Trailer)',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-31%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=Bn375-qFpdE',
					'time' => '1.02:59',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-32',
		'post_title'        => 'Justin Bieber Divorcing Hailey For Selena Gomez Rumor Explained | Hollywoodlife',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-32%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=NEwTmqx0Ok0',
					'time' => '1.02:59',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-33',
		'post_title'        => 'NASA’s space bound robot will fix satellites',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-33%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-tech%%,%%ak-featured%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=2JZoV3fHTCs',
					'time' => '0:53',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-34',
		'post_title'        => 'Best Funny Fails 2020',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-34%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-featured%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=0cCm-LP_VsQ',
					'time' => '10:07',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-35',
		'post_title'        => 'TRY NOT TO LAUGH',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-35%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-featured%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=-1InC3LR-j4',
					'time' => '10:07',
				),
			),
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-featured%%',
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-36',
		'post_title'        => '🤣 Funniest 🐶 Dogs And 😻Cats - Try Not To Laugh',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-36%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=bCVkOqSDywI',
					'time' => '10:07',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-37',
		'post_title'        => '111 BEST INVENTIONS AND DIY IDEAS!',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-37%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-tech%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=ZqUMEhXAIXg',
					'time' => '1:00:43',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-38',
		'post_title'        => '12 Amazing Watermelon Ideas And Pranks',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-38%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=JydTSJ7VrTc',
					'time' => '10:36',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-39',
		'post_title'        => 'Would You Rather Have $100,000 OR This Mystery Key?',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-39%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=_qAJMXfL6o0',
					'time' => '19:20',
				),
			),
		),
		'post_format'       => 'video',
	),
	array(
		'the_ID'            => 'ak-post-40',
		'post_title'        => 'I Built The World\'s Largest Lego Tower',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-40%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=59AYXzCa-Cs',
					'time' => '13:55',
				),
			),
		),
		'post_format'       => 'video',
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
	array(
		'the_ID'            => 'ak-trending-page',
		'post_title'        => 'Trending',
		'post_content_file' => $demo_path . 'pages/trending.txt',
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
	array(
		'the_ID'            => 'ak-popular-page',
		'post_title'        => 'Popular',
		'post_content_file' => $demo_path . 'pages/popular.txt',
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
				'title'     => 'Browse',
				'url'       => '#',
				'items'     => array(
					array(
						'item_id'   => '%%ak-entertainment%%',
						'item_type' => 'taxonomy',
						'taxonomy'  => 'category',
						'item_meta' => array(),
					),
					array(
						'item_id'   => '%%ak-gaming%%',
						'item_type' => 'taxonomy',
						'taxonomy'  => 'category',
						'item_meta' => array(),
					),
					array(
						'item_id'   => '%%ak-music%%',
						'item_type' => 'taxonomy',
						'taxonomy'  => 'category',
						'item_meta' => array(
							array(
								'key'   => 'mega_menu',
								'value' => '4-columns-posts',
							),
							array(
								'key'   => 'drop_menu_anim',
								'value' => 'slide-in-down',
							),
						),
					),
					array(
						'item_id'   => '%%ak-cooking%%',
						'item_type' => 'taxonomy',
						'taxonomy'  => 'category',
						'item_meta' => array(
							array(
								'key'   => 'mega_menu',
								'value' => '4-columns-posts',
							),
							array(
								'key'   => 'drop_menu_anim',
								'value' => 'fade-in',
							),
						),
					),
					array(
						'item_id'   => '%%ak-sport%%',
						'item_type' => 'taxonomy',
						'taxonomy'  => 'category',
						'item_meta' => array(),
					),
					array(
						'item_id'   => '%%ak-travel%%',
						'item_type' => 'taxonomy',
						'taxonomy'  => 'category',
						'item_meta' => array(),
					),
					array(
						'item_id'   => '%%ak-news%%',
						'item_type' => 'taxonomy',
						'taxonomy'  => 'category',
						'item_meta' => array(),
					),
				),
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
				'item_id'   => '%%ak-entertainment%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'fa-star',
					),
				),
			),
			array(
				'item_id'   => '%%ak-gaming%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'fa-gamepad',
					),
				),
			),
			array(
				'item_id'   => '%%ak-music%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'fa-headphones',
					),
				),
			),
			array(
				'item_id'   => '%%ak-cooking%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'fa-spoon',
					),
				),
			),
			array(
				'item_id'   => '%%ak-sport%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'fa-trophy',
					),
				),
			),
			array(
				'item_id'   => '%%ak-travel%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'fa-plane',
					),
				),
			),
			array(
				'item_id'   => '%%ak-news%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'fa-globe',
					),
				),
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
				'item_id'   => '%%ak-front-page%%',
				'item_type' => 'post',
				'title'     => 'Home',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'fa-home',
					),
				),
			),
			array(
				'item_id'   => '%%ak-trending-page%%',
				'item_type' => 'post',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'akfi-trending_up',
					),
				),
			),
			array(
				'item_type' => 'custom',
				'title'     => 'Premium',
				'url'       => '/subscription',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'fa-caret-square-o-right',
					),
				),
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
