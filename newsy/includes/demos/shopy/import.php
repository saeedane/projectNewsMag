<?php
$demo_id         = 'shopy';
$demo_import_url = newsy_get_demo_media_url( $demo_id );
$demo_path       = NEWSY_THEME_PATH . 'includes/demos/' . $demo_id . '/';

$demo['plugin'] = array( 'js_composer', 'newsy-elements', 'newsy-social-share', 'newsy-social-counter', 'newsy-view-counter', 'woocommerce' );

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
		'the_ID' => 'ak-cat-logo-electronics',
		'file'   => $demo_import_url . 'electronics.webp',
		'resize' => false,
	),
	array(
		'the_ID' => 'ak-cat-logo-fashion',
		'file'   => $demo_import_url . 'fashion.webp',
		'resize' => false,
	),
	array(
		'the_ID' => 'ak-cat-logo-health',
		'file'   => $demo_import_url . 'health.webp',
		'resize' => false,
	),
	array(
		'the_ID' => 'ak-cat-logo-home-kitchen',
		'file'   => $demo_import_url . 'home-kitchen.webp',
		'resize' => false,
	),
	array(
		'the_ID' => 'ak-cat-logo-toys-games',
		'file'   => $demo_import_url . 'games.webp',
		'resize' => false,
	),
	array(
		'the_ID' => 'ak-cat-logo-books',
		'file'   => $demo_import_url . 'book.webp',
		'resize' => false,
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
);

$demo['taxonomy'] = array(
	array(
		'the_ID'        => 'ak-blogs',
		'name'          => 'Blogs',
		'taxonomy'      => 'category',
		'taxonomy_meta' => array(),
	),
	array(
		'the_ID'        => 'ak-electronics',
		'name'          => 'Electronics',
		'description'   => 'Shop home entertainment, TVs, home audio, headphones, cameras, accessories and more',
		'taxonomy'      => 'product_cat',
		'taxonomy_meta' => array(
			array(
				'key'     => 'thumbnail_id',
				'value'   => '%%ak-cat-logo-electronics%%',
				'wp_meta' => true,
			),
			array(
				'key'   => 'term_header_style',
				'value' => 'style-5',
			),
			array(
				'key'   => 'term_header_css',
				'value' => array(
					'background' => array(
						'color' => '#8224e3',
						'image' => array(
							'img'  => '%attachment_url%ak-media-10%attachment_url%',
							'type' => 'parallax',
						),
					),
					'padding'    => array(
						'top'    => '80',
						'bottom' => '30',
					),
				),
			),
		),
	),
	array(
		'the_ID'        => 'ak-computers',
		'name'          => 'Computers',
		'description'   => 'Shop laptops, desktops, monitors, tablets, PC gaming, hard drives and storage, accessories and more',
		'taxonomy'      => 'product_cat',
		'parent'        => '%%ak-electronics%%',
		'taxonomy_meta' => array(),
	),
	array(
		'the_ID'        => 'ak-phones',
		'name'          => 'Phones',
		'description'   => 'Shop laptops, desktops, monitors, tablets, PC gaming, hard drives and storage, accessories and more',
		'taxonomy'      => 'product_cat',
		'parent'        => '%%ak-electronics%%',
		'taxonomy_meta' => array(),
	),
	array(
		'the_ID'        => 'ak-tablets',
		'name'          => 'Tablets',
		'description'   => 'Shop laptops, desktops, monitors, tablets, PC gaming, hard drives and storage, accessories and more',
		'taxonomy'      => 'product_cat',
		'parent'        => '%%ak-electronics%%',
		'taxonomy_meta' => array(),
	),
	array(
		'the_ID'        => 'ak-fashion',
		'name'          => 'Fashion',
		'description'   => 'International Shopping: Shop Computers that Ship Internationally',
		'taxonomy'      => 'product_cat',
		'taxonomy_meta' => array(
			array(
				'key'     => 'thumbnail_id',
				'value'   => '%%ak-cat-logo-fashion%%',
				'wp_meta' => true,
			),
			array(
				'key'   => 'term_header_style',
				'value' => 'style-5',
			),
			array(
				'key'   => 'term_color',
				'value' => 'rgb(130,36,227)',
			),
			array(
				'key'   => 'term_header_css',
				'value' => array(
					'background' => array(
						'color' => '#8224e3',
						'image' => array(
							'img'  => '%attachment_url%ak-media-6%attachment_url%',
							'type' => 'parallax',
						),
					),
					'padding'    => array(
						'top'    => '80',
						'bottom' => '30',
					),
				),
			),
		),
	),
	array(
		'the_ID'        => 'ak-health',
		'name'          => 'Health & Personal Care',
		'description'   => 'International Shopping: Shop Computers that Ship Internationally',
		'taxonomy'      => 'product_cat',
		'taxonomy_meta' => array(
			array(
				'key'     => 'thumbnail_id',
				'value'   => '%%ak-cat-logo-health%%',
				'wp_meta' => true,
			),
			array(
				'key'   => 'term_header_style',
				'value' => 'style-5',
			),
			array(
				'key'   => 'term_header_css',
				'value' => array(
					'background' => array(
						'color' => '#8224e3',
						'image' => array(
							'img'  => '%attachment_url%ak-media-18%attachment_url%',
							'type' => 'parallax',
						),
					),
					'padding'    => array(
						'top'    => '80',
						'bottom' => '30',
					),
				),
			),
		),
	),
	array(
		'the_ID'        => 'ak-home-kitchen',
		'name'          => 'Home & Kitchen',
		'description'   => 'International Shopping: Shop Computers that Ship Internationally',
		'taxonomy'      => 'product_cat',
		'taxonomy_meta' => array(
			array(
				'key'     => 'thumbnail_id',
				'value'   => '%%ak-cat-logo-home-kitchen%%',
				'wp_meta' => true,
			),
			array(
				'key'   => 'term_header_style',
				'value' => 'style-5',
			),
			array(
				'key'   => 'term_header_css',
				'value' => array(
					'background' => array(
						'color' => '#8224e3',
						'image' => array(
							'img'  => '%attachment_url%ak-media-14%attachment_url%',
							'type' => 'parallax',
						),
					),
					'padding'    => array(
						'top'    => '80',
						'bottom' => '30',
					),
				),
			),
		),
	),
	array(
		'the_ID'        => 'ak-books',
		'name'          => 'Books',
		'description'   => 'International Shopping: Shop Computers that Ship Internationally',
		'taxonomy'      => 'product_cat',
		'taxonomy_meta' => array(
			array(
				'key'     => 'thumbnail_id',
				'value'   => '%%ak-cat-logo-books%%',
				'wp_meta' => true,
			),
			array(
				'key'   => 'term_header_style',
				'value' => 'style-5',
			),
			array(
				'key'   => 'term_header_css',
				'value' => array(
					'background' => array(
						'color' => '#8224e3',
						'image' => array(
							'img'  => '%attachment_url%ak-media-10%attachment_url%',
							'type' => 'parallax',
						),
					),
					'padding'    => array(
						'top'    => '80',
						'bottom' => '30',
					),
				),
			),
		),
	),
	array(
		'the_ID'        => 'ak-toys-games',
		'name'          => 'Toys & Games',
		'description'   => 'Shop action figures, arts and crafts, dolls, puzzles, learning toys and more',
		'taxonomy'      => 'product_cat',
		'taxonomy_meta' => array(
			array(
				'key'     => 'thumbnail_id',
				'value'   => '%%ak-cat-logo-toys-games%%',
				'wp_meta' => true,
			),
			array(
				'key'   => 'term_header_style',
				'value' => 'style-5',
			),
			array(
				'key'   => 'term_header_css',
				'value' => array(
					'background' => array(
						'color' => '#8224e3',
						'image' => array(
							'img'  => '%attachment_url%ak-media-10%attachment_url%',
							'type' => 'parallax',
						),
					),
					'padding'    => array(
						'top'    => '80',
						'bottom' => '30',
					),
				),
			),
		),
	),
	array(
		'the_ID'        => 'ak-tag-best-seller',
		'name'          => 'Best Seller',
		'taxonomy'      => 'product_tag',
		'taxonomy_meta' => array(),
	),
	array(
		'the_ID'        => 'ak-tag-editors-pick',
		'name'          => 'Editor\'s Pick',
		'taxonomy'      => 'product_tag',
		'taxonomy_meta' => array(),
	),
	array(
		'the_ID'        => 'ak-tag-sale',
		'name'          => 'Sale',
		'taxonomy'      => 'product_tag',
		'taxonomy_meta' => array(),
	),
);

$demo['post'] = array(
	array(
		'the_ID'            => 'ak-post-1',
		'post_title'        => 'Bluetooth Headphones Over Ear, Foldable Wireless Headphones with 52 Hrs Playtime',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-1%%',
		'post_terms'        => array(
			'product_cat' => '%%ak-electronics%%',
			'product_tag' => '%%ak-tag-best-seller%%,%%ak-tag-sale%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_regular_price',
				'value'   => '35.99',
				'wp_meta' => true,
			),
			array(
				'key'     => '_sale_price',
				'value'   => '15.99',
				'wp_meta' => true,
			),
			array(
				'key'     => '_price',
				'value'   => '25.99',
				'wp_meta' => true,
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
			'product_cat' => '%%ak-electronics%%,%%ak-toys-games%%',
			'product_tag' => '%%ak-tag-editors-pick%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '25.99',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-3',
		'post_title'        => 'Perfect Zodiac Gifts For Astrology Lovers That Any Sign Will Appreciate',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1-exclusive.txt',
		'thumbnail_id'      => '%%ak-media-3%%',
		'post_terms'        => array(
			'product_cat' => '%%ak-electronics%%',
			'product_tag' => '%%ak-tag-best-seller%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '25.99',
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
			'product_cat' => '%%ak-electronics%%',
			'product_tag' => '%%ak-tag-editors-pick%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '99.99',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-5',
		'post_title'        => 'Robot companies pledge they\'re not going to let the robots kill you',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-5%%',
		'post_terms'        => array(
			'product_cat' => '%%ak-electronics%%',
			'product_tag' => '%%ak-tag-best-seller%%',
		),
		'post_type'         => 'product',
	),
	array(
		'the_ID'            => 'ak-post-6',
		'post_title'        => 'Everything you need to know about Amazon\'s Prime Early Access Sale next week',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1-exclusive.txt',
		'thumbnail_id'      => '%%ak-media-6%%',
		'post_terms'        => array(
			'product_cat' => '%%ak-fashion%%',
			'product_tag' => '%%ak-tag-best-seller%%,%%ak-tag-sale%%',
		),
		'post_meta'         => array(
			array(
				'key'     => '_regular_price',
				'value'   => '99.99',
				'wp_meta' => true,
			),
			array(
				'key'     => '_sale_price',
				'value'   => '30',
				'wp_meta' => true,
			),
			array(
				'key'     => '_price',
				'value'   => '69.99',
				'wp_meta' => true,
			),
		),
		'post_type'         => 'product',
	),
	array(
		'the_ID'            => 'ak-post-7',
		'post_title'        => 'Do We Really Need To Wear Hair Products That Contain Sunscreen?',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-7%%',
		'post_terms'        => array(
			'product_cat' => '%%ak-fashion%%',
			'product_tag' => '%%ak-tag-best-seller%%,%%ak-tag-editors-pick%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '73.99',
				'wp_meta' => true,
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
			'product_cat' => '%%ak-fashion%%',
			'product_tag' => '%%ak-tag-best-seller%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '54.99',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-9',
		'post_title'        => 'Here\'s What An Astrologer Wants You To Know About Horoscopes',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-9%%',
		'post_terms'        => array(
			'product_cat' => '%%ak-fashion%%',
			'product_tag' => '%%ak-tag-best-seller%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '345.99',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-10',
		'post_title'        => '9 Times Fashion Runways Paid Homage To The LGBTQ Community',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-10%%',
		'post_terms'        => array(
			'product_cat' => '%%ak-electronics%%',
			'product_tag' => '%%ak-tag-editors-pick%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '234.99',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-11',
		'post_title'        => '15 Stunning One-Piece Swimsuits On Sale At Nordstrom Right Now',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-11%%',
		'post_terms'        => array(
			'product_cat' => '%%ak-home-kitchen%%',
			'product_tag' => '%%ak-tag-best-seller%%,%%ak-tag-sale%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_regular_price',
				'value'   => '39.99',
				'wp_meta' => true,
			),
			array(
				'key'     => '_sale_price',
				'value'   => '2',
				'wp_meta' => true,
			),
			array(
				'key'     => '_price',
				'value'   => '37.99',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-12',
		'post_title'        => 'The Best Memorial Day 2021 Clothing Sales Online',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1-exclusive.txt',
		'thumbnail_id'      => '%%ak-media-12%%',
		'post_terms'        => array(
			'product_cat' => '%%ak-home-kitchen%%',
			'product_tag' => '%%ak-tag-best-seller%%,%%ak-tag-editors-pick%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '10.99',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-13',
		'post_title'        => '15 Fashionable Women\'s Wide-Width Shoes For Problem Feet',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-13%%',
		'post_terms'        => array(
			'product_cat' => '%%ak-home-kitchen%%',
			'product_tag' => '%%ak-tag-best-seller%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '77.99',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-14',
		'post_title'        => 'How to write like the best-selling author of all time',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-14%%',
		'post_terms'        => array(
			'product_cat' => '%%ak-home-kitchen%%',
			'product_tag' => '%%ak-tag-best-seller%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '23.99',
				'wp_meta' => true,
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
			'product_cat' => '%%ak-home-kitchen%%',
			'product_tag' => '%%ak-tag-best-seller%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '45.99',
				'wp_meta' => true,
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
			'product_cat' => '%%ak-home-kitchen%%',
			'product_tag' => '%%ak-tag-best-seller%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '65.99',
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
			'product_cat' => '%%ak-fashion%%',
			'product_tag' => '%%ak-tag-best-seller%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '99.99',
				'wp_meta' => true,
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
			'product_cat' => '%%ak-health%%',
			'product_tag' => '%%ak-tag-editors-pick%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '72.99',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-19',
		'post_title'        => 'Here\'s How You Can Book A Trip For Just $1',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-19%%',
		'post_terms'        => array(
			'product_cat' => '%%ak-health%%',
			'product_tag' => '%%ak-tag-best-seller%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '45.99',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-20',
		'post_title'        => 'Is January Really The Best Month To Book Cheap Flights?',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1-exclusive.txt',
		'thumbnail_id'      => '%%ak-media-20%%',
		'post_terms'        => array(
			'product_cat' => '%%ak-health%%',
			'product_tag' => '%%ak-tag-best-seller%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '12.99',
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
			'product_cat' => '%%ak-health%%',
			'product_tag' => '%%ak-tag-best-seller%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '45.99',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-22',
		'post_title'        => '15 Classic Princess Fairytales That Are Way More Hardcore Than Their Disney Counterparts',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1-exclusive.txt',
		'thumbnail_id'      => '%%ak-media-22%%',
		'post_terms'        => array(
			'product_cat' => '%%ak-health%%',
			'product_tag' => '%%ak-tag-best-seller%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '45.99',
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
			'product_cat' => '%%ak-health%%',
			'product_tag' => '%%ak-tag-best-seller%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '45.99',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-24',
		'post_title'        => 'Consumer Reports Best Sunscreen For 2021 Is Cheapest At This Retailer',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-24%%',
		'post_terms'        => array(
			'product_cat' => '%%ak-health%%',
			'product_tag' => '%%ak-tag-best-seller%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '45.99',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-25',
		'post_title'        => 'Study Suggests It\'s OK To Drink 25 Cups Of Coffee A Day. It\'s Not.',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-25%%',
		'post_terms'        => array(
			'product_cat' => '%%ak-health%%',
			'product_tag' => '%%ak-tag-best-seller%%',
		),
		'post_type'         => 'product',
		'post_meta'         => array(
			array(
				'key'     => '_price',
				'value'   => '45.99',
				'wp_meta' => true,
			),
		),
	),
	array(
		'the_ID'            => 'ak-post-26',
		'post_title'        => 'The best laptop deals: Save up to $100 on MacBooks, plus more',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1-exclusive.txt',
		'thumbnail_id'      => '%%ak-media-26%%',
		'post_terms'        => array(
			'category' => '%%ak-blogs%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-27',
		'post_title'        => 'This Sony 65-inch TV is the ultimate and at its best price ever',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-27%%',
		'post_terms'        => array(
			'category' => '%%ak-blogs%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-28',
		'post_title'        => 'Today\'s top deals include a Ninja Foodi grill, and Amazon Echo bundle',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-28%%',
		'post_terms'        => array(
			'category' => '%%ak-blogs%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-29',
		'post_title'        => 'The best gifts for men: Creative ideas for every type of guy',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-29%%',
		'post_terms'        => array(
			'category' => '%%ak-blogs%%',
		),
		'post_format'       => 'post',
	),
	array(
		'the_ID'            => 'ak-post-30',
		'post_title'        => '5 on-sale space heaters that can keep you warm and reduce your bill this season',
		'post_excerpt_file' => $demo_path . 'pages/post-excerpt-1.txt',
		'post_content_file' => $demo_path . 'pages/post-content-1.txt',
		'thumbnail_id'      => '%%ak-media-30%%',
		'post_terms'        => array(
			'category' => '%%ak-blogs%%',
		),
		'post_format'       => 'post',
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
				'item_id'   => '%%ak-electronics%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'product_cat',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => '%attachment_url%ak-cat-logo-electronics%attachment_url%',
					),
				),
			),
			array(
				'item_id'   => '%%ak-fashion%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'product_cat',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => '%attachment_url%ak-cat-logo-fashion%attachment_url%',
					),
				),
			),
			array(
				'item_id'   => '%%ak-health%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'product_cat',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => '%attachment_url%ak-cat-logo-health%attachment_url%',
					),
				),
			),
			array(
				'item_id'   => '%%ak-home-kitchen%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'product_cat',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => '%attachment_url%ak-cat-logo-home-kitchen%attachment_url%',
					),
				),
			),
			array(
				'item_id'   => '%%ak-toys-games%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'product_cat',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => '%attachment_url%ak-cat-logo-toys-games%attachment_url%',
					),
				),
			),
			array(
				'item_id'   => '%%ak-books%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'product_cat',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => '%attachment_url%ak-cat-logo-books%attachment_url%',
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
				'item_id'   => '%%ak-electronics%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'product_cat',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => '%attachment_url%ak-cat-logo-electronics%attachment_url%',
					),
				),
				'items'     => array(
					array(
						'item_id'   => '%%ak-computers%%',
						'item_type' => 'taxonomy',
						'taxonomy'  => 'product_cat',
					),
					array(
						'item_id'   => '%%ak-phones%%',
						'item_type' => 'taxonomy',
						'taxonomy'  => 'product_cat',
					),
					array(
						'item_id'   => '%%ak-tablets%%',
						'item_type' => 'taxonomy',
						'taxonomy'  => 'product_cat',
					),
				),
			),
			array(
				'item_id'   => '%%ak-fashion%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'product_cat',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => '%attachment_url%ak-cat-logo-fashion%attachment_url%',
					),
				),
			),
			array(
				'item_id'   => '%%ak-health%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'product_cat',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => '%attachment_url%ak-cat-logo-health%attachment_url%',
					),
				),
			),
			array(
				'item_id'   => '%%ak-home-kitchen%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'product_cat',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => '%attachment_url%ak-cat-logo-home-kitchen%attachment_url%',
					),
				),
			),
			array(
				'item_id'   => '%%ak-toys-games%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'product_cat',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => '%attachment_url%ak-cat-logo-toys-games%attachment_url%',
					),
				),
			),
			array(
				'item_id'   => '%%ak-books%%',
				'item_type' => 'taxonomy',
				'taxonomy'  => 'product_cat',
				'item_meta' => array(
					array(
						'key'   => 'menu_icon',
						'value' => '%attachment_url%ak-cat-logo-books%attachment_url%',
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
