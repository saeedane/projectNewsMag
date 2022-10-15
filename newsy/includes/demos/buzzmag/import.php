<?php
$demo_id         = 'buzzmag';
$demo_import_url = newsy_get_demo_media_url( $demo_id );
$demo_path       = NEWSY_THEME_PATH . 'includes/demos/' . $demo_id . '/';

$demo['plugin'] = array( 'js_composer', 'newsy-elements', 'newsy-social-share', 'newsy-social-counter', 'newsy-view-counter' );

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
		'resize' => false,
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
);

$demo['taxonomy'] = array(
	array(
		'the_ID'        => 'ak-featured',
		'name'          => 'Featured',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
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
		'the_ID'        => 'ak-fashion',
		'name'          => 'Fashion',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_loop',
				'value' => 'newsy_list_1_large',
			),
		),
	),

	array(
		'the_ID'        => 'ak-entertainment',
		'name'          => 'Entertainment',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(),
	),
	array(
		'the_ID'        => 'ak-events',
		'name'          => 'Events',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(),
	),
	array(
		'the_ID'        => 'ak-lifestyle',
		'name'          => 'Lifestyle',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(),
	),
	array(
		'the_ID'        => 'ak-art',
		'name'          => 'Art & Photography',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(),
	),
	array(
		'the_ID'        => 'ak-celebs',
		'name'          => 'Celebs ',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_grid',
				'value' => 'newsy_grid_5',
			),
			array(
				'key'   => 'term_layout',
				'value' => 'style-3',
			),
			array(
				'key'   => 'term_loop',
				'value' => 'newsy_list_2',
			),
			array(
				'key'   => 'term_loop_posts_count',
				'value' => '9',
			),
			array(
				'key'   => 'term_loop_item_margin',
				'value' => '30',
			),
		),
	),
	array(
		'the_ID'        => 'ak-beauty',
		'name'          => 'Beauty ',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_loop',
				'value' => 'newsy_list_1_large',
			),
		),
	),
	array(
		'the_ID'        => 'ak-video',
		'name'          => 'Videos',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_loop',
				'value' => 'newsy_list_2',
			),
			array(
				'key'   => 'term_loop_posts_count',
				'value' => '10',
			),
			array(
				'key'   => 'term_loop_item_margin',
				'value' => '30',
			),
		),

	),
);

$demo['post'] = array(
	array(
		'the_ID'            => 'ak-post-1',
		'post_title'        => '45 Ridiculous, Sneaky Ways Brands Have Fooled Consumers',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-1%%',
		'post_terms'        => array(
			'category' => '%%ak-events%%,%%ak-lifestyle%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-2',
		'post_title'        => '35 People Who Are Too Far Gone to Help',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-2%%',
		'post_terms'        => array(
			'category' => '%%ak-events%%,%%ak-lifestyle%%,%%ak-featured%%',
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
		'post_title'        => '19 Facts That Will Absolutely Demolish Everything You Thought You Knew',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-3%%',
		'post_terms'        => array(
			'category' => '%%ak-lifestyle%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-4',
		'post_title'        => '19 Brilliant Summer Travel Hacks You Need to Know Before You Jet Off on Vacation',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-4%%',
		'post_terms'        => array(
			'category' => '%%ak-lifestyle%%',
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
			'category' => '%%ak-art%%,%%ak-featured%%',
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
			'category' => '%%ak-lifestyle%%,%%ak-lifestyle%%,%%ak-beauty%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-beauty%%',
			),
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-7',
		'post_title'        => '19 of the Most Hilarious Parenting Tweets You\'ll Ever Read',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-7%%',
		'post_terms'        => array(
			'category' => '%%ak-events%%',
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
		'post_title'        => '20 People Who Posted \'Missed Connections\' and Actually Heard Back',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-8%%',
		'post_terms'        => array(
			'category' => '%%ak-art%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-9',
		'post_title'        => '19 Notes from Kids Who Might be Psychopaths',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-9%%',
		'post_terms'        => array(
			'category' => '%%ak-lifestyle%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-10',
		'post_title'        => '15 People Share the Dumbest Arguments They\'ve Ever Been a Part Of',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-10%%',
		'post_terms'        => array(
			'category' => '%%ak-events%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-11',
		'post_title'        => '35 Jokes You\'ll Only Get if You\'re a Woman',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-11%%',
		'post_terms'        => array(
			'category' => '%%ak-events%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-12',
		'post_title'        => '20 GIFs of Animals That Will Put a Smile on Your Face',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-12%%',
		'post_terms'        => array(
			'category' => '%%ak-events%%,',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-beauty%%',
			),
			array(
				'key'   => 'post_views_count',
				'value' => '152',
			),
			array(
				'key'   => 'post_view_7days_last_day',
				'value' => '125',
			),
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-13',
		'post_title'        => '19 DIY Book Projects That Will Make You Scream “WHY!”',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-13%%',
		'post_terms'        => array(
			'category' => '%%ak-events%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-14',
		'post_title'        => 'Just 19 Cat Pictures Because You Need Them Right Now',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-14%%',
		'post_terms'        => array(
			'category' => '%%ak-celebs%%,%%ak-events%%',
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
		'post_title'        => '19 People Share Their the Weirdest Moments in Job Interviews',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-16%%',
		'post_terms'        => array(
			'category' => '%%ak-events%%,%%ak-entertainment%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-17',
		'post_title'        => '25 Things a Child Can Be Trusted With That Adults Totally Can\'t',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-17%%',
		'post_terms'        => array(
			'category' => '%%ak-lifestyle%%',
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
			'category' => '%%ak-lifestyle%%,%%ak-lifestyle%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-19',
		'post_title'        => '19 Strange, Subconscious Things Every Human Does Without Realizing It',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-19%%',
		'post_terms'        => array(
			'category' => '%%ak-lifestyle%%,%%ak-events%%,%%ak-featured%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-featured%%',
			),
			array(
				'key'   => 'post_views_count',
				'value' => '1375',
			),
			array(
				'key'   => 'post_view_7days_last_day',
				'value' => '1375',
			),
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-20',
		'post_title'        => '19 Ridiculous Animal Memes That Prove We\'re the Lesser Species Once and for All',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-20%%',
		'post_terms'        => array(
			'category' => '%%ak-lifestyle%%,%%ak-events%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-21',
		'post_title'        => '19 Brilliant Money Tips That Will Have You Saving Cash in No Time',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-21%%',
		'post_terms'        => array(
			'category' => '%%ak-lifestyle%%,%%ak-featured%%',
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
			'category' => '%%ak-entertainment%%,%%ak-lifestyle%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-23',
		'post_title'        => '19 Brilliant Tweets That Prove Women Are the Funniest of the Sexes',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-23%%',
		'post_terms'        => array(
			'category' => '%%ak-lifestyle%%,%%ak-beauty%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-beauty%%',
			),
			array(
				'key'   => 'post_views_count',
				'value' => '875',
			),
			array(
				'key'   => 'post_view_7days_last_day',
				'value' => '875',
			),
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-24',
		'post_title'        => '19 People Who Are Honestly Using the Internet All Wrong',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-24%%',
		'post_terms'        => array(
			'category' => '%%ak-lifestyle%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-25',
		'post_title'        => 'The 30 Best Ways to Travel for Cheap This Summer',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-25%%',
		'post_terms'        => array(
			'category' => '%%ak-lifestyle%%,%%ak-lifestyle%%,%%ak-featured%%',
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
		'post_title'        => '19 Times Teens Were Beyond Extra on Social Media',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-26%%',
		'post_terms'        => array(
			'category' => '%%ak-art%%,%%ak-lifestyle%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-27',
		'post_title'        => '25 Photos of Incredible Places You\'ll Want to Visit ASAP',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-27%%',
		'post_terms'        => array(
			'category' => '%%ak-lifestyle%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-28',
		'post_title'        => 'We Found the 20 Best GIFs on the Whole Internet',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-28%%',
		'post_terms'        => array(
			'category' => '%%ak-celebs%%,%%ak-lifestyle%%,%%ak-fashion%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-29',
		'post_title'        => '20 Ridiculously Events Memes That Are Almost Too Spot On',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-29%%',
		'post_terms'        => array(
			'category' => '%%ak-art%%,%%ak-events%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-30',
		'post_title'        => '19 Times Women Were Total Bosses While Lifting Each Other Up',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-30%%',
		'post_terms'        => array(
			'category' => '%%ak-lifestyle%%,%%ak-lifestyle%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-31',
		'post_title'        => '19 Weird Pictures That Will Make You Giggle Despite Your Best Intentions',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-31%%',
		'post_terms'        => array(
			'category' => '%%ak-lifestyle%%,%%ak-lifestyle%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-32',
		'post_title'        => 'We Found the 19 Most Inaccurate Things You Always See in Movies',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-32%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-33',
		'post_title'        => 'We\'re Obsessed With the Man Who Photoshopped Himself Into 25 Movie Posters',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-33%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-events%%,%%ak-fashion%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-34',
		'post_title'        => '20 Amazing Pictures of Plate Art Made With Real Food',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-34%%',
		'post_terms'        => array(
			'category' => '%%ak-events%%,%%ak-lifestyle%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-35',
		'post_title'        => '20 Events Things Teens Always Do in TV But Never in Real Life',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-35%%',
		'post_terms'        => array(
			'category' => '%%ak-events%%,%%ak-lifestyle%%,%%ak-featured%%',
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
		'post_title'        => '19 Dumb Things People Have Done That Made Them Question Their Own Intelligence',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-36%%',
		'post_terms'        => array(
			'category' => '%%ak-lifestyle%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-37',
		'post_title'        => '20 Mind-Bending Realities That Will Shake \'90s Kids to Their Cores',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-37%%',
		'post_terms'        => array(
			'category' => '%%ak-lifestyle%%',
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
			'category' => '%%ak-celebs%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-39',
		'post_title'        => 'Salt Bae to open burger chain in LA and NYC: \'It won\'t just be for the wealthy\'',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-39%%',
		'post_terms'        => array(
			'category' => '%%ak-celebs%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-40',
		'post_title'        => 'Science or silence? My battle to question doomsayers about the Great Barrier Reef',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-40%%',
		'post_terms'        => array(
			'category' => '%%ak-celebs%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-41',
		'post_title'        => '5 Creative Crafts to Brighten Your Day',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-41%%',
		'post_terms'        => array(
			'category' => '%%ak-fashion%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'post_template',
				'value' => 'style-12',
			),
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=36C8qmLtDWw',
					'time' => '06:39',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-42',
		'post_title'        => 'Weird: Naked mole rats don\'t die of old age',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-42%%',
		'post_terms'        => array(
			'category' => '%%ak-celebs%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-43',
		'post_title'        => 'Egyptian archaeologists discover 4,400-year-old tomb near Cairo',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-43%%',
		'post_terms'        => array(
			'category' => '%%ak-celebs%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-44',
		'post_title'        => 'Get set for Super Mario movie: Nintendo fans go nuts',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-44%%',
		'post_terms'        => array(
			'category' => '%%ak-celebs%%',
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
			'category' => '%%ak-celebs%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'post_template',
				'value' => 'style-12',
			),
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
		'post_title'        => '\'Wonder Woman 2\' director teases what you definitely won\'t see in the sequel',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-46%%',
		'post_terms'        => array(
			'category' => '%%ak-celebs%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-47',
		'post_title'        => '\'Last Jedi\' fans furious after theater\'s audio malfunction',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-47%%',
		'post_terms'        => array(
			'category' => '%%ak-celebs%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-49',
		'post_title'        => 'Swimsuit company makes bikinis from garbage',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-49%%',
		'post_terms'        => array(
			'category' => '%%ak-celebs%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-50',
		'post_title'        => 'Barca win can kick-start crucial run for Madrid, reveals Bale',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-50%%',
		'post_terms'        => array(
			'category' => '%%ak-celebs%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-51',
		'post_title'        => 'Is cheerleading a sport or an activity?',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-51%%',
		'post_terms'        => array(
			'category' => '%%ak-fashion%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-52',
		'post_title'        => 'Trump\'s fight to open access to experimental drugs',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-52%%',
		'post_terms'        => array(
			'category' => '%%ak-fashion%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'post_template',
				'value' => 'style-12',
			),
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=mhLZ8JqcpRI',
					'time' => '12:30',
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
			'category' => '%%ak-lifestyle%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'post_template',
				'value' => 'style-12',
			),
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
		'post_title'        => 'The Most Ridiculous Ads for Fall Television',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-54%%',
		'post_terms'        => array(
			'category' => '%%ak-lifestyle%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'post_template',
				'value' => 'style-12',
			),
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
		'the_ID'            => 'ak-post-55',
		'post_title'        => 'Jeff Bezos Will Make 1 Million Dollars During This 7 Minute Video',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-55%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-celebs%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'post_template',
				'value' => 'style-12',
			),
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
		'the_ID'            => 'ak-post-56',
		'post_title'        => 'Watch Awesome Kate Middleton Go Skiing',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-56%%',
		'post_terms'        => array(
			'category' => '%%ak-fashion%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'post_template',
				'value' => 'style-12',
			),
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=6aAtKw8lPTU',
					'time' => '04:16',
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
			'category' => '%%ak-fashion%%,%%ak-events%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'post_template',
				'value' => 'style-12',
			),
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=36C8qmLtDWw',
					'time' => '06:39',
				),
			),

		),
	),
	array(
		'the_ID'            => 'ak-post-58',
		'post_title'        => 'Justin Bieber Wants to Get Another Monkey',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-58%%',
		'post_terms'        => array(
			'category' => '%%ak-fashion%%,%%ak-events%%,%%ak-video%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-59',
		'post_title'        => 'Would You Rather • New Year’s Edition            ',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-59%%',
		'post_terms'        => array(
			'category' => '%%ak-beauty%%,%%ak-events%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'post_template',
				'value' => 'style-12',
			),
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
			'category' => '%%ak-beauty%%,%%ak-events%%,%%ak-video%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'post_template',
				'value' => 'style-12',
			),
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
		'the_ID'       => 'ak-site-icon',
		'type'         => 'wp_option',
		'option_name'  => 'site_icon',
		'option_value' => '%%ak-media-favicon%%',
	),
	array(
		'the_ID'       => 'ak-posts_per_page',
		'type'         => 'wp_option',
		'option_name'  => 'posts_per_page',
		'option_value' => '10',
		'remove_off'   => true,
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
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'akfi-happy2',
					),
				),
			),
			array(
				'item_id'   => '%%ak-fashion%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'fa-diamond',
					),
				),
			),
			array(
				'item_id'   => '%%ak-events%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'fa-calendar',
					),
				),
			),
			array(
				'item_id'   => '%%ak-art%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'fa-camera-retro',
					),
				),
			),
			array(
				'item_id'   => '%%ak-celebs%%',
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
				'item_id'   => '%%ak-beauty%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'akfi-fire',
					),
				),
			),
			array(
				'item_id'   => '%%ak-lifestyle%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'fa-first-order',
					),
				),
			),
			array(
				'item_id'   => '%%ak-video%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => 'fa-youtube-play',
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
				'item_id'   => '%%ak-fashion%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'items'     => array(),
			),
			array(
				'item_id'   => '%%ak-entertainment%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-events%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-art%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
			),
			array(
				'item_id'   => '%%ak-celebs%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
			),
			array(
				'item_id'   => '%%ak-beauty%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-lifestyle%%',
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
