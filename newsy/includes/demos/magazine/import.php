<?php
$demo_id         = 'magazine';
$demo_import_url = newsy_get_demo_media_url( $demo_id );
$demo_path       = NEWSY_THEME_PATH . 'includes/demos/' . $demo_id . '/';

$demo['plugin'] = array( 'js_composer', 'newsy-elements', 'newsy-social-share', 'newsy-social-counter', 'newsy-view-counter', 'newsy-voting' );

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
		'the_ID' => 'ak-media-45',
		'file'   => $demo_import_url . 'posts/post-45.jpg',
	),
	array(
		'the_ID' => 'ak-media-46',
		'file'   => $demo_import_url . 'posts/post-46.jpg',
	),
	array(
		'the_ID' => 'ak-media-47',
		'file'   => $demo_import_url . 'posts/post-47.jpg',
	),
	array(
		'the_ID' => 'ak-media-48',
		'file'   => $demo_import_url . 'posts/post-48.jpg',
	),
	array(
		'the_ID' => 'ak-media-49',
		'file'   => $demo_import_url . 'posts/post-49.jpg',
	),
	array(
		'the_ID' => 'ak-media-50',
		'file'   => $demo_import_url . 'posts/post-50.jpg',
	),
	array(
		'the_ID' => 'ak-media-51',
		'file'   => $demo_import_url . 'posts/post-51.jpg',
	),
	array(
		'the_ID' => 'ak-media-52',
		'file'   => $demo_import_url . 'posts/post-52.jpg',
	),
	array(
		'the_ID' => 'ak-media-53',
		'file'   => $demo_import_url . 'posts/post-53.jpg',
	),
	array(
		'the_ID' => 'ak-media-54',
		'file'   => $demo_import_url . 'posts/post-54.jpg',
	),
	array(
		'the_ID' => 'ak-media-55',
		'file'   => $demo_import_url . 'posts/post-55.jpg',
	),
	array(
		'the_ID' => 'ak-media-56',
		'file'   => $demo_import_url . 'posts/post-56.jpg',
	),
	array(
		'the_ID' => 'ak-media-57',
		'file'   => $demo_import_url . 'posts/post-57.jpg',
	),
	array(
		'the_ID' => 'ak-media-58',
		'file'   => $demo_import_url . 'posts/post-58.jpg',
	),
	array(
		'the_ID' => 'ak-media-59',
		'file'   => $demo_import_url . 'posts/post-59.jpg',
	),
	array(
		'the_ID' => 'ak-media-60',
		'file'   => $demo_import_url . 'posts/post-60.jpg',
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
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
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
				'value' => '#6b0d0d',
			),
		),
	),
	array(
		'the_ID'        => 'ak-style-beauty',
		'name'          => 'Style & Beauty',
		'description'   => 'All the latest trends in fashion and beauty, with diverse and attainable looks, expert tips and honest product reviews.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#9a4557',
			),
		),
	),
	array(
		'the_ID'        => 'ak-astrology',
		'name'          => 'Astrology',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#8224e3',
			),
		),
	),
	array(
		'the_ID'        => 'ak-wellness',
		'name'          => 'Wellness',
		'description'   => 'Your guide to taking care of your mind and body so you can take on the world.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#46a700',
			),

		),
	),
	array(
		'the_ID'        => 'ak-food-drink',
		'name'          => 'Food & Drink',
		'description'   => 'Recipes that are worth your time, useful kitchen how-tos and all the food facts you need to feed your body and mind.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#9fa500',
			),
		),
	),
	array(
		'the_ID'        => 'ak-work-life',
		'name'          => 'Work & Life',
		'description'   => 'Catch up on the latest news, photos, videos, and more on Work/Life.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#0d0eca',
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
		),
	),
	array(
		'the_ID'        => 'ak-video',
		'name'          => 'Videos',
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
		'post_title'        => 'Why Do So Many Women Say They\'ve Been Yelled At During Birth?',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-1%%',
		'post_terms'        => array(
			'category' => '%%ak-style-beauty%%,%%ak-astrology%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-2',
		'post_title'        => 'Is Sunscreen More Effective If You Apply It Before Or After Moisturizer?',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-2%%',
		'post_terms'        => array(
			'category' => '%%ak-style-beauty%%,%%ak-astrology%%,%%ak-featured%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-featured%%',
			),
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-3',
		'post_title'        => 'Perfect Zodiac Gifts For Astrology Lovers That Any Sign Will Appreciate',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-3%%',
		'post_terms'        => array(
			'category' => '%%ak-astrology%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-4',
		'post_title'        => 'What Your Zodiac Sign Says About Your Love Life',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-4%%',
		'post_terms'        => array(
			'category' => '%%ak-astrology%%,%%ak-work-life%%,%%ak-entertainment%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-5',
		'post_title'        => '19 Baby Gender Reveals That Are Actually Pretty Amazing',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-5%%',
		'post_terms'        => array(
			'category' => '%%ak-wellness%%,%%ak-featured%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-featured%%',
			),
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-6',
		'post_title'        => '19 Life-Saving Tips That Everyone Should Know',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-6%%',
		'post_terms'        => array(
			'category' => '%%ak-travel%%,%%ak-astrology%%,%%ak-work-life%%,%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-work-life%%',
			),
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-7',
		'post_title'        => 'Do We Really Need To Wear Hair Products That Contain Sunscreen?',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-7%%',
		'post_terms'        => array(
			'category' => '%%ak-style-beauty%%,%%ak-travel%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_views_count',
				'value' => '2375',
			),
			array(
				'key'   => 'post_view_7days_last_day',
				'value' => '2375',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-8',
		'post_title'        => 'The One Side Effect Of Trauma We Rarely Talk About',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-8%%',
		'post_terms'        => array(
			'category' => '%%ak-wellness%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-9',
		'post_title'        => 'Here\'s What An Astrologer Wants You To Know About Horoscopes',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-9%%',
		'post_terms'        => array(
			'category' => '%%ak-astrology%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-10',
		'post_title'        => '9 Times Fashion Runways Paid Homage To The LGBTQ Community',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-10%%',
		'post_terms'        => array(
			'category' => '%%ak-style-beauty%%,%%ak-entertainment%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-11',
		'post_title'        => '15 Stunning One-Piece Swimsuits On Sale At Nordstrom Right Now',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-11%%',
		'post_terms'        => array(
			'category' => '%%ak-style-beauty%%,%%ak-entertainment%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-12',
		'post_title'        => 'The Best Memorial Day 2021 Clothing Sales Online',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-12%%',
		'post_terms'        => array(
			'category' => '%%ak-style-beauty%%,%%ak-entertainment%%,%%ak-work-life%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-style-beauty%%',
			),
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-13',
		'post_title'        => '15 Fashionable Women\'s Wide-Width Shoes For Problem Feet',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-13%%',
		'post_terms'        => array(
			'category' => '%%ak-style-beauty%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-14',
		'post_title'        => 'The Best Fourth Of July Party Foods',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-14%%',
		'post_terms'        => array(
			'category' => '%%ak-food-drink%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-15',
		'post_title'        => '19 People Confess the Most Embarrassing Things They\'ve Ever Done',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-15%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-16',
		'post_title'        => 'Summer Beauty Products Under $20 You Can Score At Walmart',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-16%%',
		'post_terms'        => array(
			'category' => '%%ak-style-beauty%%,%%ak-entertainment%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-17',
		'post_title'        => 'These 7 ‘Touristy’ Activities Are Actually A Ton Of Fun',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-17%%',
		'post_terms'        => array(
			'category' => '%%ak-travel%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-18',
		'post_title'        => '19 Brilliant Hacks for Your Next Family Camping Trip',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-18%%',
		'post_terms'        => array(
			'category' => '%%ak-travel%%,%%ak-entertainment%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-19',
		'post_title'        => 'Here\'s How You Can Book A Trip For Just $1',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-19%%',
		'post_terms'        => array(
			'category' => '%%ak-travel%%,%%ak-style-beauty%%,%%ak-featured%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-featured%%',
			),
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-20',
		'post_title'        => 'Is January Really The Best Month To Book Cheap Flights?',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-20%%',
		'post_terms'        => array(
			'category' => '%%ak-travel%%,%%ak-style-beauty%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-21',
		'post_title'        => 'The Best Hotels In The World In 2021, According To Travelers',
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
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-22',
		'post_title'        => '15 Classic Princess Fairytales That Are Way More Hardcore Than Their Disney Counterparts',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-22%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-travel%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-23',
		'post_title'        => 'Going Part Time Can Be A Cruel Trap For Women, But There\'s A Way To Do It Right',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-23%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-entertainment%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-work-life%%',
			),
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-24',
		'post_title'        => 'Consumer Reports Best Sunscreen For 2021 Is Cheapest At This Retailer',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-24%%',
		'post_terms'        => array(
			'category' => '%%ak-wellness%%,%%ak-travel%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-25',
		'post_title'        => 'Study Suggests It\'s OK To Drink 25 Cups Of Coffee A Day. It\'s Not.',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-25%%',
		'post_terms'        => array(
			'category' => '%%ak-wellness%%,%%ak-work-life%%,%%ak-entertainment%%,%%ak-featured%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-featured%%',
			),
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-26',
		'post_title'        => 'How To Make Drinking Just A Tiny Bit Better For You',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-26%%',
		'post_terms'        => array(
			'category' => '%%ak-wellness%%,%%ak-travel%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-27',
		'post_title'        => 'How To Pack Like A Pro, According To Flight Attendants',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-27%%',
		'post_terms'        => array(
			'category' => '%%ak-travel%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-28',
		'post_title'        => '4 Ways To Tell If There Are Hidden Cameras In Your Airbnb',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-28%%',
		'post_terms'        => array(
			'category' => '%%ak-travel%%,%%ak-video%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-29',
		'post_title'        => '20 Ridiculously Funny Memes That Are Almost Too Spot On',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-29%%',
		'post_terms'        => array(
			'category' => '%%ak-wellness%%,%%ak-style-beauty%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-30',
		'post_title'        => 'This Is When Taking A Job Pay Cut Can Actually Be Worth It',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-30%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-wellness%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-31',
		'post_title'        => 'An Instagram With No "Likes" Could Have A Big Impact On Mental Health',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-31%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-wellness%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-32',
		'post_title'        => 'Here\'s How To Find And Track Your Medical History',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-32%%',
		'post_terms'        => array(
			'category' => '%%ak-wellness%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-33',
		'post_title'        => '11 Unexpected Ways You Can Relieve Headaches',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-33%%',
		'post_terms'        => array(
			'category' => '%%ak-wellness%%,%%ak-entertainment%%,%%ak-featured%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-34',
		'post_title'        => '33 Award-Winning Wedding Photos That Are Totally Eye-Catching',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-34%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-style-beauty%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-35',
		'post_title'        => 'How To Know If You Have A Plus-One At A Wedding',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-35%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-entertainment%%,%%ak-featured%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-featured%%',
			),
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-36',
		'post_title'        => 'What You Actually Need To Change A Bad Habit',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-36%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-entertainment%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-37',
		'post_title'        => 'Meet The People Who Make Major Career Decisions Based On Astrology',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-37%%',
		'post_terms'        => array(
			'category' => '%%ak-astrology%%',
		),
		'post_format'       => 'post',
	),
	// update below
	array(
		'the_ID'            => 'ak-post-38',
		'post_title'        => '\'Hangry\' is officially a word in the Oxford English Dictionary',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-38%%',
		'post_terms'        => array(
			'category' => '%%ak-food-drink%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-39',
		'post_title'        => '"Eat What You Want Day" Is A Crock(Pot) Of Baloney',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-39%%',
		'post_terms'        => array(
			'category' => '%%ak-food-drink%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-40',
		'post_title'        => 'How To Make Sweet Tea Like A Southerner',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-40%%',
		'post_terms'        => array(
			'category' => '%%ak-food-drink%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-41',
		'post_title'        => '5 Breathtaking Hot Springs You Need To Visit',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-41%%',
		'post_terms'        => array(
			'category' => '%%ak-travel%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=iJkTauC4sv8',
					'time' => '05:36',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-42',
		'post_title'        => 'Taste Test: The Best Store-Bought Hot Dogs, According To Pros Who Know',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-42%%',
		'post_terms'        => array(
			'category' => '%%ak-food-drink%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-43',
		'post_title'        => '21 Better Veggie Burgers That’ll Make You A Believer',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-43%%',
		'post_terms'        => array(
			'category' => '%%ak-food-drink%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-44',
		'post_title'        => 'The Best Southern Cakes, From Lane Cake To Coca-Cola Cake',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-44%%',
		'post_terms'        => array(
			'category' => '%%ak-food-drink%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-45',
		'post_title'        => 'We Tried To Make Desserts From Each Other\'s Countries',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-45%%',
		'post_terms'        => array(
			'category' => '%%ak-food-drink%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=s2-8pLLVvDs',
					'time' => '06:46',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-46',
		'post_title'        => 'What Makes The Best Potato Salad? Four Chefs Debate.',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-46%%',
		'post_terms'        => array(
			'category' => '%%ak-food-drink%%,%%ak-wellnees%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-47',
		'post_title'        => 'How To Decorate A Beautiful Cake, Even If You Have Zero Artistic Ability',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-47%%',
		'post_terms'        => array(
			'category' => '%%ak-food-drink%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-48',
		'post_title'        => 'The Dangers Of Dieting Like A Wellness Influencer',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-48%%',
		'post_terms'        => array(
			'category' => '%%ak-food-drink%%,%%ak-wellnees%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-49',
		'post_title'        => 'The Best Boxed Baking Mixes, According To Pastry Chefs',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-49%%',
		'post_terms'        => array(
			'category' => '%%ak-food-drink%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-50',
		'post_title'        => 'When To Use A Blender vs. A Food Processor',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-50%%',
		'post_terms'        => array(
			'category' => '%%ak-food-drink%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-51',
		'post_title'        => 'Your Pasta Sauce Needs Way More Olive Oil, According To Real Italians',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-51%%',
		'post_terms'        => array(
			'category' => '%%ak-food-drink%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-52',
		'post_title'        => 'Hotel Horror Stories That Will Make You Glad You\'re Not Traveling',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-52%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=zG3UBii_Dq8',
					'time' => '07:47',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-53',
		'post_title'        => '14 Places Vegans Should Put On Their Bucket Lists',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-53%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=v2kj4-KuWz4',
					'time' => '13:38',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-54',
		'post_title'        => 'Enjoy This Footage Of Amsterdam Without Any Of The Tourists',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-54%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-entertainment%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=QlReK_NlZWM',
					'time' => '04:28',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-55',
		'post_title'        => 'Women Try Threading Their Own Eyebrows For The First Time',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-55%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-work-life%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=8YXRljpiG5A',
					'time' => '06:24',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-56',
		'post_title'        => 'An American Tries Working In A British Fish & Chip Shop',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-56%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-work-life%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=6YlVcvFbm3k',
					'time' => '10:04',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-57',
		'post_title'        => 'The Most Ridiculous Ads for Fall Television',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-57%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-work-life%%,%%ak-welness%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=eQ9kVUVddkQ',
					'time' => '10:21',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-58',
		'post_title'        => 'As Tech Employees Party, Contract Workers Get Left Out',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-58%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-work-life%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-59',
		'post_title'        => 'Would You Rather • New Year’s Edition',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-59%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-entertainment%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=hKETTfMdvQc',
					'time' => '05:57',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-60',
		'post_title'        => '19 Jokes Millennials Won\'t Know Whether To Laugh Or Cry At',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-60%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-entertainment%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=eB-hyQJn9oA',
					'time' => '07:16',
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
				'item_id'   => '%%ak-entertainment%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-style-beauty%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-wellness%%',
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
				'item_id'   => '%%ak-food-drink%%',
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
				'item_id'   => '%%ak-work-life%%',
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
				'item_id'   => '%%ak-entertainment%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-style-beauty%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-wellness%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
			),
			array(
				'item_id'   => '%%ak-food-drink%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
			),
			array(
				'item_id'   => '%%ak-work-life%%',
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
