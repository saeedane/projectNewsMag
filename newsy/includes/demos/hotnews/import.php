<?php
$demo_id         = 'hotnews';
$demo_import_url = newsy_get_demo_media_url( $demo_id );
$demo_path       = NEWSY_THEME_PATH . 'includes/demos/' . $demo_id . '/';

$demo['plugin'] = array( 'js_composer', 'newsy-elements', 'newsy-social-share', 'newsy-social-counter', 'simple-membership', 'newsy-membership', 'newsy-view-counter', 'newsy-reaction', 'newsy-bookmark', 'newsy-voting' );

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
		'the_ID' => 'ak-post-1-img-1',
		'file'   => $demo_import_url . 'post-content-1/img-1.jpeg',
	),
	array(
		'the_ID' => 'ak-post-1-img-2',
		'file'   => $demo_import_url . 'post-content-1/img-2.jpeg',
	),
	array(
		'the_ID' => 'ak-post-1-img-3',
		'file'   => $demo_import_url . 'post-content-1/img-3.jpeg',
	),
	array(
		'the_ID' => 'ak-media-1',
		'file'   => $demo_import_url . 'posts/post-1.jpeg',
	),
	array(
		'the_ID' => 'ak-media-2',
		'file'   => $demo_import_url . 'posts/post-2.jpeg',
	),
	array(
		'the_ID' => 'ak-media-3',
		'file'   => $demo_import_url . 'posts/post-3.jpeg',
	),
	array(
		'the_ID' => 'ak-media-4',
		'file'   => $demo_import_url . 'posts/post-4.jpeg',
	),
	array(
		'the_ID' => 'ak-media-5',
		'file'   => $demo_import_url . 'posts/post-5.jpeg',
	),
	array(
		'the_ID' => 'ak-media-6',
		'file'   => $demo_import_url . 'posts/post-6.jpeg',
	),
	array(
		'the_ID' => 'ak-media-7',
		'file'   => $demo_import_url . 'posts/post-7.jpeg',
	),
	array(
		'the_ID' => 'ak-media-8',
		'file'   => $demo_import_url . 'posts/post-8.jpeg',
	),
	array(
		'the_ID' => 'ak-media-9',
		'file'   => $demo_import_url . 'posts/post-9.jpeg',
	),
	array(
		'the_ID' => 'ak-media-10',
		'file'   => $demo_import_url . 'posts/post-10.jpeg',
	),
	array(
		'the_ID' => 'ak-media-11',
		'file'   => $demo_import_url . 'posts/post-11.jpeg',
	),
	array(
		'the_ID' => 'ak-media-12',
		'file'   => $demo_import_url . 'posts/post-12.jpeg',
	),
	array(
		'the_ID' => 'ak-media-13',
		'file'   => $demo_import_url . 'posts/post-13.jpeg',
	),
	array(
		'the_ID' => 'ak-media-14',
		'file'   => $demo_import_url . 'posts/post-14.jpeg',
	),
	array(
		'the_ID' => 'ak-media-15',
		'file'   => $demo_import_url . 'posts/post-15.jpeg',
	),
	array(
		'the_ID' => 'ak-media-16',
		'file'   => $demo_import_url . 'posts/post-16.jpeg',
	),
	array(
		'the_ID' => 'ak-media-17',
		'file'   => $demo_import_url . 'posts/post-17.jpeg',
	),
	array(
		'the_ID' => 'ak-media-18',
		'file'   => $demo_import_url . 'posts/post-18.jpeg',
	),
	array(
		'the_ID' => 'ak-media-19',
		'file'   => $demo_import_url . 'posts/post-19.jpeg',
	),
	array(
		'the_ID' => 'ak-media-20',
		'file'   => $demo_import_url . 'posts/post-20.jpeg',
	),
	array(
		'the_ID' => 'ak-media-21',
		'file'   => $demo_import_url . 'posts/post-21.jpeg',
	),
	array(
		'the_ID' => 'ak-media-22',
		'file'   => $demo_import_url . 'posts/post-22.jpeg',
	),
	array(
		'the_ID' => 'ak-media-23',
		'file'   => $demo_import_url . 'posts/post-23.jpeg',
	),
	array(
		'the_ID' => 'ak-media-24',
		'file'   => $demo_import_url . 'posts/post-24.jpeg',
	),
	array(
		'the_ID' => 'ak-media-25',
		'file'   => $demo_import_url . 'posts/post-25.jpeg',
	),
	array(
		'the_ID' => 'ak-media-26',
		'file'   => $demo_import_url . 'posts/post-26.jpeg',
	),
	array(
		'the_ID' => 'ak-media-27',
		'file'   => $demo_import_url . 'posts/post-27.jpeg',
	),
	array(
		'the_ID' => 'ak-media-28',
		'file'   => $demo_import_url . 'posts/post-28.jpeg',
	),
	array(
		'the_ID' => 'ak-media-29',
		'file'   => $demo_import_url . 'posts/post-29.jpeg',
	),
	array(
		'the_ID' => 'ak-media-30',
		'file'   => $demo_import_url . 'posts/post-30.jpeg',
	),
	array(
		'the_ID' => 'ak-media-reaction-angry',
		'file'   => $demo_import_url . 'reactions/angry.png',
	),
	array(
		'the_ID' => 'ak-media-reaction-cool',
		'file'   => $demo_import_url . 'reactions/cool.png',
	),
	array(
		'the_ID' => 'ak-media-reaction-crying',
		'file'   => $demo_import_url . 'reactions/crying.png',
	),
	array(
		'the_ID' => 'ak-media-reaction-dislike',
		'file'   => $demo_import_url . 'reactions/dislike.png',
	),
	array(
		'the_ID' => 'ak-media-reaction-laughing',
		'file'   => $demo_import_url . 'reactions/laughing.png',
	),
	array(
		'the_ID' => 'ak-media-reaction-loved',
		'file'   => $demo_import_url . 'reactions/loved.png',
	),
	array(
		'the_ID' => 'ak-media-reaction-surprised',
		'file'   => $demo_import_url . 'reactions/surprised.png',
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
		'the_ID'        => 'ak-news',
		'name'          => 'World News',
		'description'   => 'Stay updated with the latest news from the world and what your favourite celebrities are upto.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#ff0036',
			),
		),
	),
	array(
		'the_ID'        => 'ak-us-news',
		'name'          => 'US News',
		'description'   => 'Stay updated with the latest news from the world and what your favourite celebrities are upto.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#333333',
			),
		),
	),
	array(
		'the_ID'        => 'ak-business',
		'name'          => 'Business',
		'description'   => 'Stay updated with the latest news from the world and what your favourite celebrities are upto.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#2481e3',
			),
		),
	),
	array(
		'the_ID'        => 'ak-entertainment',
		'name'          => 'Entertainment',
		'description'   => 'Stay updated with the latest news from the world and what your favourite celebrities are upto.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#ee8522',
			),
		),
	),
	array(
		'the_ID'        => 'ak-tech-science',
		'name'          => 'Tech & Science',
		'description'   => 'Stay updated with the latest news from the world and what your favourite celebrities are upto.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#2481e3',
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
			array(
				'key'   => 'term_badge_type',
				'value' => 'text',
			),
			array(
				'key'   => 'term_badge_text',
				'value' => 'LIFE',
			),
			array(
				'key'   => 'term_badge_color',
				'value' => '#ffffff',
			),
			array(
				'key'   => 'term_badge_bg_color',
				'value' => '#0d0eca',
			),
		),
	),
	array(
		'the_ID'        => 'ak-sports',
		'name'          => 'Sports',
		'description'   => 'Stay updated with the latest news from the world and what your favourite celebrities are upto.',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_color',
				'value' => '#67cc0c',
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
			array(
				'key'   => 'term_loop',
				'value' => 'newsy_list_2_wide',
			),
			array(
				'key'   => 'term_header_custom_logo',
				'value' => '%attachment_url%ak-media-newsyvidos-logo%attachment_url%',
			),
			array(
				'key'   => 'term_custom_term_name',
				'value' => 'Viral Videos',
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
	array(
		'the_ID'        => 'ak-tag-politics',
		'name'          => 'Politics',
		'taxonomy'      => 'post_tag',
		'taxonomy_meta' => array(),
	),
	array(
		'the_ID'        => 'ak-tag-technology',
		'name'          => 'Technology',
		'taxonomy'      => 'post_tag',
		'taxonomy_meta' => array(),
	),
	array(
		'the_ID'        => 'ak-tag-breaking',
		'name'          => 'Breaking',
		'taxonomy'      => 'post_tag',
		'taxonomy_meta' => array(),
	),
	array(
		'the_ID'        => 'ak-tag-election',
		'name'          => 'Election',
		'taxonomy'      => 'post_tag',
		'taxonomy_meta' => array(),
	),
	array(
		'the_ID'        => 'ak-tag-world-news',
		'name'          => 'World News',
		'taxonomy'      => 'post_tag',
		'taxonomy_meta' => array(),
	),
	// reactions
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
			array(
				'key'   => 'term_header_custom_logo',
				'value' => '%attachment_url%ak-media-reaction-angry%attachment_url%',
			),
		),
	),
	array(
		'the_ID'        => 'ak-reaction-cool',
		'name'          => 'Cool',
		'taxonomy'      => 'reaction',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_badge_type',
				'value' => 'icon',
			),
			array(
				'key'   => 'term_badge_icon',
				'value' => '%attachment_url%ak-media-reaction-cool%attachment_url%',
			),
			array(
				'key'   => 'term_header_custom_logo',
				'value' => '%attachment_url%ak-media-reaction-cool%attachment_url%',
			),
		),
	),
	array(
		'the_ID'        => 'ak-reaction-dislike',
		'name'          => 'Dislike',
		'taxonomy'      => 'reaction',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_badge_type',
				'value' => 'icon',
			),
			array(
				'key'   => 'term_badge_icon',
				'value' => '%attachment_url%ak-media-reaction-dislike%attachment_url%',
			),
			array(
				'key'   => 'term_header_custom_logo',
				'value' => '%attachment_url%ak-media-reaction-dislike%attachment_url%',
			),
		),
	),
	array(
		'the_ID'        => 'ak-reaction-crying',
		'name'          => 'Crying',
		'taxonomy'      => 'reaction',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_badge_type',
				'value' => 'icon',
			),
			array(
				'key'   => 'term_badge_icon',
				'value' => '%attachment_url%ak-media-reaction-crying%attachment_url%',
			),
			array(
				'key'   => 'term_header_custom_logo',
				'value' => '%attachment_url%ak-media-reaction-crying%attachment_url%',
			),
		),
	),
	array(
		'the_ID'        => 'ak-reaction-laugh',
		'name'          => 'Laugh',
		'taxonomy'      => 'reaction',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_badge_type',
				'value' => 'icon',
			),
			array(
				'key'   => 'term_badge_icon',
				'value' => '%attachment_url%ak-media-reaction-laughing%attachment_url%',
			),
			array(
				'key'   => 'term_header_custom_logo',
				'value' => '%attachment_url%ak-media-reaction-laughing%attachment_url%',
			),
		),
	),
	array(
		'the_ID'        => 'ak-reaction-loved',
		'name'          => 'Loved',
		'taxonomy'      => 'reaction',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_badge_type',
				'value' => 'icon',
			),
			array(
				'key'   => 'term_badge_icon',
				'value' => '%attachment_url%ak-media-reaction-loved%attachment_url%',
			),
			array(
				'key'   => 'term_header_custom_logo',
				'value' => '%attachment_url%ak-media-reaction-loved%attachment_url%',
			),
		),
	),
	array(
		'the_ID'        => 'ak-reaction-surprised',
		'name'          => 'Surprised',
		'taxonomy'      => 'reaction',
		'taxonomy_meta' => array(
			array(
				'key'   => 'term_badge_type',
				'value' => 'icon',
			),
			array(
				'key'   => 'term_badge_icon',
				'value' => '%attachment_url%ak-media-reaction-surprised%attachment_url%',
			),
			array(
				'key'   => 'term_header_custom_logo',
				'value' => '%attachment_url%ak-media-reaction-surprised%attachment_url%',
			),
		),
	),
);

$demo['post'] = array(
	array(
		'the_ID'            => 'ak-post-1',
		'post_title'        => 'The war in Ukraine: Meet the people resisting the Russian invasion',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-1%%',
		'post_terms'        => array(
			'category' => '%%ak-news%%,%%ak-video%%,%%ak-featured%%,%%ak-work-life%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
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
					'url'  => 'https://www.youtube.com/watch?v=rmzJr1oUjKg',
					'time' => '53:07',
				),
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-2',
		'post_title'        => 'How thinking about \'future you\' can build a happier life',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-2%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-tech-science%%,%%ak-featured%%,%%ak-sports%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-3',
		'post_title'        => 'Perfect Zodiac Gifts For Astrology Lovers That Any Sign Will Appreciate',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1-exclusive.txt',
		'thumbnail_id'      => '%%ak-media-3%%',
		'post_terms'        => array(
			'category' => '%%ak-tech-science%%,%%ak-us-news%%,%%ak-featured%%,%%ak-business%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-work-life%%',
			),
			array(
				'key'     => 'swpm_protect_post',
				'value'   => '2',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-4',
		'post_title'        => 'Binance\'s BNB cryptocurrency hit by massive $100 million hack',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-4%%',
		'post_terms'        => array(
			'category' => '%%ak-tech-science%%,%%ak-work-life%%,%%ak-entertainment%%,%%ak-business%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-5',
		'post_title'        => 'Robot companies pledge they\'re not going to let the robots kill you',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-5%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-featured%%,%%ak-news%%,%%ak-sports%%,%%ak-business%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
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
		'post_title'        => 'Everything you need to know about Amazon\'s Prime Early Access Sale next week',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1-exclusive.txt',
		'thumbnail_id'      => '%%ak-media-6%%',
		'post_terms'        => array(
			'category' => '%%ak-tech-science%%,%%ak-entertainment%%,%%ak-work-life%%,%%ak-news%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-sports%%',
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
			'category' => '%%ak-us-news%%,%%ak-work-life%%,%%ak-entertainment%%,%%ak-featured%%,%%ak-business%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-us-news%%',
			),
			array(
				'key'     => 'swpm_protect_post',
				'value'   => '2',
				'wp_meta' => true,
			),
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-8',
		'post_title'        => 'The One Side Effect Of Trauma We Rarely Talk About',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-8%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-sports%%,%%ak-business%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
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
			'category' => '%%ak-tech-science%%,%%ak-us-news%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
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
			'category' => '%%ak-work-life%%,%%ak-entertainment%%,%%ak-featured%%,%%ak-news%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
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
			'category' => '%%ak-work-life%%,%%ak-entertainment%%,%%ak-us-news%%,%%ak-business%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-12',
		'post_title'        => 'The Best Memorial Day 2021 Clothing Sales Online',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1-exclusive.txt',
		'thumbnail_id'      => '%%ak-media-12%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-entertainment%%,%%ak-tech-science%%,%%ak-sports%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_meta'         => array(
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-work-life%%',
			),
			array(
				'key'     => 'swpm_protect_post',
				'value'   => '2',
				'wp_meta' => true,
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
			'category' => '%%ak-work-life%%,%%ak-us-news%%,%%ak-featured%%,%%ak-business%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-14',
		'post_title'        => 'How to write like the best-selling author of all time',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-14%%',
		'post_terms'        => array(
			'category' => '%%ak-tech-science%%,%%ak-news%%,%%ak-sports%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=98pNh3LtV8c',
					'time' => '5:11',
				),
			),
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-video%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-15',
		'post_title'        => '19 People Confess the Most Embarrassing Things They\'ve Ever Done',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-15%%',
		'post_terms'        => array(
			'category' => '%%ak-business%%,%%ak-entertainment%%,%%ak-tech-science%%,%%ak-featured%%,%%ak-video%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=p7HKvqRI_Bo',
					'time' => '4:30',
				),
			),
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-business%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-16',
		'post_title'        => 'Summer Beauty Products Under $20 You Can Score At Walmart',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1-exclusive.txt',
		'thumbnail_id'      => '%%ak-media-16%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-entertainment%%,%%ak-featured%%,%%ak-sports%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'     => 'swpm_protect_post',
				'value'   => '2',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-17',
		'post_title'        => 'Can you guess what\'s wrong with these paintings?',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-17%%',
		'post_terms'        => array(
			'category' => '%%ak-video%%,%%ak-entertainment%%,%%ak-featured%%,%%ak-tech-science%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=T-fMSph7Iyo',
					'time' => '5:25',
				),
			),
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-video%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-18',
		'post_title'        => '19 Brilliant Hacks for Your Next Family Camping Trip',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-18%%',
		'post_terms'        => array(
			'category' => '%%ak-tech-science%%,%%ak-entertainment%%,%%ak-business%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
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
			'category' => '%%ak-entertainment%%,%%ak-work-life%%,%%ak-featured%%,%%ak-us-news%%,%%ak-sports%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
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
		'post_content_file' => $demo_path . 'pages/post-content-1-exclusive.txt',
		'thumbnail_id'      => '%%ak-media-20%%',
		'post_terms'        => array(
			'category' => '%%ak-us-news%%,%%ak-entertainment%%,%%ak-work-life%%,%%ak-news%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'     => 'swpm_protect_post',
				'value'   => '2',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-21',
		'post_title'        => 'The Best Hotels In The World In 2021, According To Travelers',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-21%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-featured%%,%%ak-sports%%,%%ak-business%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-22',
		'post_title'        => '15 Classic Princess Fairytales That Are Way More Hardcore Than Their Disney Counterparts',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1-exclusive.txt',
		'thumbnail_id'      => '%%ak-media-22%%',
		'post_terms'        => array(
			'category' => '%%ak-us-news%%,%%ak-entertainment%%,%%ak-us-news%%,%%ak-featured%%,%%ak-business%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'     => 'swpm_protect_post',
				'value'   => '2',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-23',
		'post_title'        => 'Going Part Time Can Be A Cruel Trap For Women, But There\'s A Way To Do It Right',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-23%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-entertainment%%,%%ak-featured%%,%%ak-news%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
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
			'category' => '%%ak-work-life%%,%%ak-entertainment%%,%%ak-sports%%,%%ak-business%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
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
			'category' => '%%ak-work-life%%,%%ak-tech-science%%,%%ak-entertainment%%%%ak-video%%,,%%ak-featured%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=2W6Hm-GJ6Mc',
					'time' => '5:59',
				),
			),
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-tech-science%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-26',
		'post_title'        => 'How To Make Drinking Just A Tiny Bit Better For You',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1-exclusive.txt',
		'thumbnail_id'      => '%%ak-media-26%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-entertainment%%,%%ak-business%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'post',
		'post_meta'         => array(
			array(
				'key'     => 'swpm_protect_post',
				'value'   => '2',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-27',
		'post_title'        => 'How To Pack Like A Pro, According To Flight Attendants',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-27%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-news%%,%%ak-sports%%,%%ak-video%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=bWpL_l3OhrY',
					'time' => '4:48',
				),
			),
			array(
				'key'   => 'post_primary_category',
				'value' => '%%ak-video%%',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-28',
		'post_title'        => '4 Ways To Tell If There Are Hidden Cameras In Your Airbnb',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-28%%',
		'post_terms'        => array(
			'category' => '%%ak-entertainment%%,%%ak-work-life%%,%%ak-us-news%%,%%ak-featured%%,%%ak-business%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
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
			'category' => '%%ak-work-life%%,%%ak-tech-science%%,%%ak-featured%%,%%ak-business%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=_T8cn2J13-4',
					'time' => '1:30',
				),

			),
			array(
				'key'   => 'post_template',
				'value' => 'style-12',
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-30',
		'post_title'        => 'This Is When Taking A Job Pay Cut Can Actually Be Worth It',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-30%%',
		'post_terms'        => array(
			'category' => '%%ak-work-life%%,%%ak-tech-science%%,%%ak-us-news%%,%%ak-business%%,%%ak-news%%,%%ak-sports%%',
			'post_tag' => '%%ak-tag-politics%%,%%ak-tag-technology%%,%%ak-tag-breaking%%,%%ak-tag-election%%,%%ak-tag-world-news%%',
		),
		'post_format'       => 'video',
		'post_meta'         => array(
			array(
				'key'   => 'featured_video',
				'value' => array(
					'type' => 'url',
					'url'  => 'https://www.youtube.com/watch?v=TwvgYbbilYc',
					'time' => '1:30',
				),

			),
			array(
				'key'   => 'post_template',
				'value' => 'style-12',
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
			array(
				'key'     => '_wpb_post_custom_css',
				'value'   => '.ak-content{background-color: #0000000d;}',
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
				'item_id'   => '%%ak-news%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-us-news%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-business%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-sports%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-entertainment%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-work-life%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-tech-science%%',
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
				'item_id'   => '%%ak-news%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-us-news%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-business%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-sports%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-entertainment%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-work-life%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'category',
				'item_meta' => array(),
			),
			array(
				'item_id'   => '%%ak-tech-science%%',
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
