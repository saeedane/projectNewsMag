<?php

namespace Newsy\Single;

use Newsy\Support\Comment;
use Newsy\TemplateAbstract;

/**
 * Single Post template class.
 */
class SinglePost extends TemplateAbstract {

	/**
	 * @var string
	 */
	public $template_id = 'post';

	/**
	 * @var WP_Post
	 */
	public $post;

	public $title_attribute;

	public $title;

	public $href;

	public $post_format;

	protected $post_thumb_id = null;

	/**
	 * @var SinglePost
	 */
	private static $instance;

	/**
	 * @return SinglePost
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}
		return static::$instance;
	}

	/**
	 * Init the post for the class.
	 *
	 * @return bool
	 */
	public function init( $post = null ) {
		if ( empty( $this->post ) ) {
			$this->post = get_post( $post );
		}

		if ( ! $this->post ) {
			return false;
		}

		$this->id              = $this->post->ID;
		$this->title           = get_the_title( $this->post );
		$this->title_attribute = esc_attr( strip_tags( $this->title ) );
		$this->href            = esc_url( get_permalink( $this->post ) );
		$this->post_format     = get_post_format( $this->post );

		if ( has_post_thumbnail( $this->post ) ) {
			$tmp_get_post_thumbnail_id = get_post_thumbnail_id( $this->post );
			if ( ! empty( $tmp_get_post_thumbnail_id ) ) {
				$this->post_thumb_id = $tmp_get_post_thumbnail_id;
			}
		}

		$this->hook();

		return true;
	}

	public function hook() {
		add_filter( 'body_class', array( $this, 'post_body_class' ) );
		add_filter( 'newsy_content_wrap_class', array( $this, 'post_wrap_classes' ), 15, 2 );

		add_action( 'newsy_single_post_after', array( $this, 'get_author_box' ), 20 );
		add_action( 'newsy_single_post_after', array( $this, 'get_newsletter' ), 30 );
		add_action( 'newsy_single_post_after', array( $this, 'get_reaction_voting_box' ), 40 );

		$is_infinity = newsy_get_option( 'post_related_loop_pagination' ) === 'infinity';
		$related_pos = newsy_get_option( 'post_related_position' ) === 'end' ? 'newsy_single_after' : 'newsy_single_post_after';
		add_action( $related_pos, array( $this, 'get_related_posts' ), $is_infinity ? 60 : 50 );
		add_action( 'newsy_single_post_after', array( $this, 'get_comments_form' ), $is_infinity ? 50 : 60 );
	}

	/**
	 * Returns the body classes for single post.
	 *
	 * @return array
	 */
	public function post_body_class( $classes ) {
		if ( 'enabled' === newsy_get_option( 'post_autoload' ) ) {
			$classes[] = 'ak-post-autoload';
		}

		if ( 'style-11' === $this->get_template() ) {
			add_filter( 'newsy_header_rows', 'newsy_set_header_rows_dark_scheme', 11 );
			$classes[] = 'page-template-page-builder-overlay';
		}

		return $classes;
	}

	/**
	 * Returns the wrapper classes for single post.
	 *
	 * @return array
	 */
	public function post_wrap_classes( $classes, $type ) {
		$template = $this->get_template();
		$layout   = $this->get_layout();

		$classes[] = 'ak-post-' . $template;

		if ( 'style-9' === $template || 'style-10' === $template || 'style-3' === $layout ) {
			$classes[] = 'ak-post-full-width';
		}

		$classes[] = 'clearfix';

		return apply_filters( 'newsy_post_wrap_class', $classes, $this->id );
	}

	/**
	 * Returns the item attributes for single post.
	 *
	 * @return string
	 */
	public function get_article_attrs() {
		$paged = get_query_var( 'page' ) ? get_query_var( 'page' ) . '/' : '';

		$class = $this->get_option( 'article_classes' );

		// Separates classes with a single space, collates classes for post DIV
		$attr = 'class="' . esc_attr( implode( ' ', get_post_class( $class, $this->id ) ) ) . ' ak-article clearfix"';

		$attr .= ' data-type="post" data-id="' . $this->id . '" data-url="' . $this->href . $paged . '" data-title="' . $this->title_attribute . '"';

		$autoload = newsy_get_option( 'post_autoload' );

		if ( 'enabled' === $autoload ) {
			$content = newsy_get_option( 'post_autoload_content' );

			if ( 'category' === $content ) {
				$prev_post = get_previous_post( true, null, 'category' );
			} elseif ( 'tag' === $content ) {
				$prev_post = get_previous_post( true, null, 'post_tag' );
			} else {
				$prev_post = get_previous_post();
			}
			if ( $prev_post ) {
				$attr .= ' data-autoload="' . esc_attr( $prev_post->ID ) . '" data-template="' . esc_attr( $this->get_template() ) . '"';
			}
		}

		newsy_sanitize_echo( $attr );
	}

	public function get_template() {
		return $this->get_option( 'template', defined( 'NEWSY_SOCIAL_SHARE_PATH' ) ? 'style-1' : 'style-3' );
	}

	/**
	 * Get the post title.
	 */
	public function get_title() {
		if ( is_single() ) {
			the_title( '<h1 class="ak-post-title">', '</h1>' );
		} else {
			the_title( '<h2 class="ak-post-title"><a href="' . $this->href . '" title="' . $this->title_attribute . '" rel="bookmark">', '</a></h2>' );
		}
	}

	/**
	 * Get the post pagination.
	 */
	public function get_pagination() {
		$next_or_number = newsy_get_option( 'post_next_or_number', 'number' );

		wp_link_pages(
			array(
				'before'           => '<div class="post-nav-links post-nav-' . esc_attr( $next_or_number ) . '">',
				'after'            => '</div>',
				'next_or_number'   => 'number' === $next_or_number ? 'number' : 'next',
				'nextpagelink'     => newsy_get_translation( 'Next', 'newsy', 'post_page_next' ),
				'previouspagelink' => newsy_get_translation( 'Previous', 'newsy', 'post_page_prev' ),
			)
		);
	}

	/**
	 * Get the featured post video.
	 *
	 * @return string
	 */
	public function get_featured_video() {
		$output       = '';
		$autoplay     = newsy_get_option( 'post_featured_video_autoplay' ) === 'yes';
		$video_output = newsy_get_post_featured_video( $this->id, $autoplay );

		if ( '' !== $video_output ) {
			$video_output = apply_filters( 'newsy_single_featured_after', $video_output, $this->post );
			$output       = "<div class=\"ak-post-featured\"><div class=\"ak-featured-cover\">{$video_output}</div></div>";
		}

		return $output;
	}

	/**
	 * Get the featured post image.
	 *
	 * @param string $image_size
	 * @param boolean $inline
	 * @param boolean $auto_wrap
	 *
	 * @return string
	 */
	public function get_featured_image( $image_size = 'newsy_750x0', $inline = false, $auto_wrap = true, $crop = true ) {
		if ( $this->get_option( 'show_featured_image' ) === 'hide' ) {
			return;
		}

		$ignored_templates = in_array( $this->get_template(), array( 'style-5', 'style-10', 'style-11' ), true );
		if ( 'video' === $this->post_format && ! $ignored_templates ) {
			$video = $this->get_featured_video();
			if ( ! empty( $video ) ) {
				newsy_sanitize_echo( $video );
				return;
			}
		}

		if ( null === $this->post_thumb_id ) {
			return;
		}

		if ( $crop ) {
			$req_size = $this->get_option( 'thumbnail_size', 'crop-500' );

			if ( 'no-crop' === $req_size ) {
				$image_size = 'newsy_1140x570' === $image_size ? 'newsy_1140x0' : 'newsy_750x0';
			} elseif ( 'crop-715' === $req_size ) {
				$image_size = 'newsy_750x536';
			} elseif ( 'crop-500' === $req_size ) {
				$image_size = 'newsy_750x375';
			}
		}

		$post_image = ak_get_post_image( $this->post->ID, $image_size, $inline, $auto_wrap );
		$popup      = newsy_get_option( 'post_image_popup', 'yes' );

		$output = '<div class="ak-post-featured"><div class="ak-featured-cover">';
		if ( 'yes' === $popup ) {
			$image   = wp_get_attachment_image_src( $this->post_thumb_id, 'full' );
			$output .= "<a href=\"{$image[0]}\">{$post_image}</a>";
		} else {
			$output .= $post_image;
		}

		if ( ! $ignored_templates ) {
			$output .= apply_filters( 'newsy_single_featured_after', '', $this->post );
		}

		if ( ! $inline ) {
			$post_featured_image_credit = $this->get_option( 'featured_image_credit', '', false );

			if ( ! empty( $post_featured_image_credit ) ) {
				$output .= '<span class="ak-post-featured-credit">' . esc_html( $post_featured_image_credit ) . '</span>';
			} else {
				$image_caption = wp_get_attachment_caption( $this->post_thumb_id );
				if ( ! empty( $image_caption ) ) {
					$output .= '<span class="ak-post-featured-credit">' . $image_caption . '</span>';
				}
			}
		}

		$output .= '</div></div>';

		newsy_sanitize_echo( $output );
	}

	/**
	 * Get the category of the single post / single post type.
	 *
	 * @return string - the html of the spot
	 */
	public function get_category() {
		if ( $this->get_option( 'show_categories' ) === 'hide' ) {
			return;
		}

		$output  = '<div class="ak-post-terms-wrapper">';
		$output .= '<div class="ak-post-terms">';
		if ( function_exists( 'newsy_get_post_categories' ) ) {
			$categories = newsy_get_post_categories( $this->id, 10 );
			foreach ( $categories as $cat_name => $cat_params ) {
				if ( 'hide' !== $cat_params['hide_on_post'] ) {
					$output .= '<a class="term-' . esc_attr( $cat_params['term_id'] ) . '" href="' . esc_url( $cat_params['link'] ) . '">' . esc_html( $cat_name ) . '</a>';
				}
			}
		} else {
			$categories = wp_get_post_terms( $this->id, 'category' );
			foreach ( $categories as $category ) {
				$output .= '<a class="term-' . esc_attr( $category->id ) . '" href="' . esc_url( get_term_link( $category, 'category' ) ) . '">' . esc_html( $category->name ) . '</a>';
			}
		}
		$output .= '</div>';
		$output .= $this->get_badge_icon();
		$output .= '</div>';

		newsy_sanitize_echo( $output );
	}

	/**
	 * Get the post badge icon.
	 */
	public function get_badge_icon() {
		if ( 'hide' === $this->get_option( 'show_badge_icon' ) ) {
			return;
		}

		$output = apply_filters( 'newsy_post_badge_icons', '', $this->id, 2, true );

		$_output = "<div class=\"ak-post-badges\">{$output}</div>";

		newsy_sanitize_echo( $_output );
	}

	/**
	 * Get the meta spot of the single post.
	 */
	public function get_meta( $style = 'style-1' ) {
		$meta_style = $this->get_option( 'meta', $style );

		if ( 'hide' === $meta_style ) {
			return;
		}

		get_template_part( 'views/post/meta', $meta_style );
	}

	/**
	 * Get the author avatar meta spot of the single post.
	 */
	public function get_meta_author_avatar( $avatar_size = 42 ) {
		if ( $this->get_option( 'show_meta_author_avatar' ) === 'hide' ) {
			return;
		}

		$avatar = get_avatar( $this->post->post_author, $avatar_size );

		$output = "<div class=\"ak-post-meta-author-avatar\">{$avatar}</div>";

		newsy_sanitize_echo( $output );
	}

	/**
	 * Get the author meta spot of the single post.
	 */
	public function get_meta_author() {
		if ( $this->get_option( 'show_meta_author' ) === 'hide' ) {
			return;
		}

		$post_author_url  = get_author_posts_url( $this->post->post_author );
		$post_author_name = get_the_author_meta( 'display_name', $this->post->post_author );

		$output = "<div class=\"ak-post-meta-author\"><a href=\"{$post_author_url}\">{$post_author_name}</a></div>";

		newsy_sanitize_echo( $output );
	}

	/**
	 * Get the date spot of the single post.
	 */
	public function get_meta_date() {
		if ( $this->get_option( 'show_meta_date' ) === 'hide' ) {
			return;
		}

		$format = $this->get_option( 'show_meta_date_format' );

		if ( 'custom' === $format ) {
			$post_time = get_the_time( $this->get_option( 'show_meta_date_format_custom', get_option( 'date_format' ) ), $this->id );
		} elseif ( 'ago' === $format ) {
			$post_time = sprintf( newsy_get_translation( '%s ago', 'newsy', 'readable_time_ago' ), ak_ago_time( get_the_time( 'U', $this->id ) ) );
		} else {
			$post_time = get_the_time( get_option( 'date_format' ), $this->id );
		}

		$output = "<div class=\"ak-post-meta-date\">
                    <a href=\"{$this->href}\">
                    {$post_time}
                    </a>
				</div>";

		newsy_sanitize_echo( $output );
	}

	/**
	 * Get the comments count spot of the single post.
	 */
	public function get_meta_comments() {
		if ( $this->get_option( 'show_meta_comments' ) === 'hide' ) {
			return;
		}

		$comments_link   = get_comments_link( $this->id );
		$comments_number = Comment::get_instance()->get_total( $this->id );

		$output = "<div class=\"ak-post-meta-comment\">
                    <a href=\"{$comments_link}\">
                        <i class=\"ak-icon fa fa-comment-o\"></i>
                        <span class=\"count\">{$comments_number}</span>
                    </a>
				</div>";

		newsy_sanitize_echo( $output );
	}

	/**
	 * Get the views count spot of the single post.
	 */
	public function get_meta_views() {
		if ( $this->get_option( 'show_meta_views' ) === 'hide' || ! function_exists( 'newsy_get_post_view_count' ) ) {
			return;
		}

		$post_views = newsy_get_post_view_count( $this->post->ID );

		$post_views = apply_filters( 'newsy_view_count_format', $post_views );

		$output = "<div class=\"ak-post-meta-views\">
                    {$post_views}
				</div>";

		newsy_sanitize_echo( $output );
	}

	/**
	 * Get the top social share spot of the single post.
	 */
	public function get_social_share_top() {
		if ( ! function_exists( 'newsy_get_share_buttons' ) ) {
			return;
		}

		$share_sites = newsy_get_option( 'post_social_share_sites', 'facebook,twitter,pinterest' );

		if ( empty( $share_sites ) || $this->get_option( 'social_share_top' ) === 'hide' ) {
			return;
		}

		$share_style      = $this->get_option( 'social_share_style', 'style-1' );
		$share_count_type = newsy_get_option( 'post_social_share_count', 'each' );
		$share_show_count = newsy_get_option( 'post_social_share_show_count', 3 );

		$share_output = newsy_get_share_buttons( $share_sites, $this->id, $share_style, $share_count_type, $share_show_count );

		$share_right = apply_filters( 'newsy_single_post_social_share_top', '', $this->id );

		if ( '' !== $share_right ) {
			$share_right = '<div class="ak-column ak-column-normal"><div class="ak-share-right">' . $share_right . '</div></div>';
		}

		$output = '<div class="ak-post-share ak-post-share-top clearfix">
					<div class="ak-row">
						<div class="ak-column ak-column-grow">' . $share_output . '</div>
						' . $share_right . '
					</div>
				</div>';

		newsy_sanitize_echo( $output );
	}

	/**
	 * Get the bottom social share spot of the single post.
	 */
	public function get_social_share_bottom() {
		if ( ! function_exists( 'newsy_get_share_buttons' ) ) {
			return;
		}

		$share_sites = newsy_get_option( 'post_social_share_sites' );

		if ( empty( $share_sites ) || $this->get_option( 'social_share_bottom' ) === 'hide' ) {
			return;
		}

		$share_style      = newsy_get_option( 'post_social_share_style', 'style-1' );
		$share_count_type = newsy_get_option( 'post_social_share_count' );
		$share_show_count = newsy_get_option( 'post_social_share_show_count', 3 );

		$share_output = newsy_get_share_buttons( $share_sites, $this->id, $share_style, $share_count_type, $share_show_count );

		$share_right = apply_filters( 'newsy_single_post_social_share_bottom', '', $this->id );

		if ( '' !== $share_right ) {
			$share_right = '<div class="ak-column ak-column-normal"><div class="ak-share-right">' . $share_right . '</div></div>';
		}

		$output = '<div class="ak-post-share ak-post-share-bottom clearfix">
					<div class="ak-row">
						<div class="ak-column ak-column-grow">' . $share_output . '</div>
						' . $share_right . '
					</div>
				</div>';

		newsy_sanitize_echo( $output );
	}

	/**
	 * Get the excerpt spot of the single post.
	 */
	public function get_excerpt( $length = 0 ) {
		if ( $this->get_option( 'show_excerpt' ) === 'hide' ) {
			return;
		}

		$text = $this->post->post_excerpt;

		$text = preg_replace( '/\[caption(.*)\[\/caption\]/i', '', $text );
		$text = preg_replace( '/\[[^\]]*\]/', '', $text );
		$text = wp_kses( $text, 'strip' );

		// get plaintext excerpt trimmed to right length
		if ( $length > 0 ) {
			$excerpt = ak_html_limit_words( $text, $length, '&hellip;' );
		} else {
			$excerpt = $text;
		}
		$excerpt = str_replace( '&nbsp;', ' ', $excerpt );

		$output = '';

		if ( '' !== $excerpt ) {
			$output .= '<div class="ak-post-summary">';
			// fix extra spaces
			$output .= $excerpt;

			$output .= '</div>';
		}

		newsy_sanitize_echo( $output );
	}

	/**
	 * Get the tags spot of the single post.
	 *
	 * @return string
	 */
	public function get_tags() {
		if ( $this->get_option( 'show_tags' ) === 'hide' ) {
			return;
		}

		$output = '';

		$newsy_post_tags = get_the_tags( $this->id );

		if ( ! empty( $newsy_post_tags ) ) {
			$tags_spot_text = newsy_get_translation( 'Tags:', 'newsy', 'tags' );

			$output .= '<div class="ak-post-tags clearfix">';
			$output .= '<span>' . $tags_spot_text . '</span>';

			foreach ( $newsy_post_tags as $tag ) {
				$tag_url = get_tag_link( $tag->term_id );

				$output .= '<a href="' . $tag_url . '">' . $tag->name . '</a>';
			}
			$output .= '</div>';
		}

		newsy_sanitize_echo( $output );
	}

	/**
	 * Get the next and previous links on single posts.
	 *
	 * @return string
	 */
	public function get_next_prev_posts() {
		if ( $this->get_option( 'show_next_prev' ) === 'hide' ) {
			return;
		}

		get_template_part( 'views/post/next-prev-post' );
	}

	/**
	 * Gets the author on single posts.
	 */
	public function get_author_box() {
		if ( ! defined( 'NEWSY_ELEMENTS_PATH' ) ) {
			return;
		}
		$output = '';

		// add the author as hidden for google and return if the author box is set to disabled
		if ( $this->get_option( 'show_author_box' ) === 'hide' ) {
			$output  = '<div class="ak-author-name vcard author hidden"><span class="fn">';
			$output .= '<a href="' . get_author_posts_url( $this->post->post_author ) . '">' . get_the_author_meta( 'display_name', $this->post->post_author ) . '</a>';
			$output .= '</span></div>';
			newsy_sanitize_echo( $output );
		} else {
			ak_do_shortcode(
				'newsy_author_box', array(
					'author'      => $this->post->post_author,
					'show_cover'  => 'hide',
					'show_extras' => 'hide',
					'block_width' => 2,
				)
			);
		}
	}

	/**
	 * Gets the related posts ONLY on single posts. Does not run on custom post types because we don't know what taxonomy to choose and the
	 * blocks do not support custom taxonomies as of 15 july 2015.
	 *
	 * @return string
	 */
	public function get_related_posts() {
		if ( ! defined( 'NEWSY_ELEMENTS_PATH' ) ) {
			return;
		}
		$related_tax = $this->get_option( 'related_type', 'category' );

		if ( 'hide' === $related_tax || wp_doing_ajax() ) {
			return;
		}

		$taxs = array();

		if ( ! taxonomy_exists( $related_tax ) ) {
			$related_tax = 'category';
		}

		$result = get_the_terms( $this->id, $related_tax );

		if ( $result && count( $result ) > 0 ) {
			foreach ( $result as $tax ) {
				$taxs[] = $related_tax . ':' . $tax->term_id;
			}
		}

		$related_loop  = newsy_get_option( 'post_related_loop', 'newsy_list_2' );
		$related_width = $this->get_layout() === 'style-3' ? 3 : 2;

		$atts = array(
			'title'               => newsy_get_translation( 'Related Posts', 'newsy', 'related_heading' ),
			'post'                => '-' . $this->id, // exclade current post
			'taxonomy'            => implode( ',', $taxs ),
			'taxonomy_relation'   => 'OR',
			'order_by'            => newsy_get_option( 'post_related_loop_order_by', 'popular_week' ),
			'count'               => newsy_get_option( 'post_related_loop_posts_count' ),
			'item_margin'         => newsy_get_option( 'post_related_loop_item_margin' ),
			'custom_enabled'      => newsy_get_option( 'post_related_loop_custom_enabled' ),
			'custom_parts'        => newsy_get_option( 'post_related_loop_custom_parts' ),
			'pagination'          => newsy_get_option( 'post_related_loop_pagination', 'next_prev' ),
			'header_style'        => newsy_get_option( 'post_related_block_header_style' ),
			'block_width'         => newsy_get_option( 'post_related_block_width', $related_width ),
			'block_extra_classes' => newsy_get_option( 'post_related_block_classes', '' ) . ' ak-post-related-posts',
		);

		ak_do_shortcode( $related_loop, $atts );
	}

	/**
	 * Get the newsletter block spot of the single post.
	 *
	 * @return string
	 */
	public function get_newsletter() {
		if ( $this->get_option( 'show_newsletter', 'hide' ) === 'hide' ) {
			return;
		}

		$atts = newsy_get_option( 'post_newsletter' );

		if ( ! empty( $atts ) && ! empty( $atts['mailchimp_url'] ) ) {
			ak_do_shortcode( 'newsy_mailchimp', $atts );
		}
	}

	/**
	 * Get the reaction block spot of the single post.
	 *
	 * @return string
	 */
	public function get_reaction_voting_box() {
		if ( $this->get_option( 'show_reaction_box' ) === 'hide'
			|| ! function_exists( 'newsy_reaction_get_voting_box' )
		) {
			return;
		}

		$voting_box = newsy_reaction_get_voting_box( $this->id );

		if ( ! $voting_box ) {
			return;
		}

		$title = newsy_get_translation( 'What\'s your reaction?', 'newsy', 'reaction_block_heading' );

		$header_style = newsy_get_option( 'post_reaction_box_block_header_style', newsy_get_option( 'block_header_style', 'style-1' ) );
		$header_class = newsy_get_option( 'post_reaction_box_block_classes' );

		$output = '<div class="ak-block ak-post-reaction-box  ' . $header_class . '">';
		if ( ! empty( $title ) ) {
			$output .= '<div class="ak-block-header ak-block-header-' . $header_style . '">';
			$output .= '<h4 class="ak-block-title"> <span class="title-text">' . $title . '</span></h4>';
			$output .= '</div>';
		}
		$output .= '<div class="ak-block-inner clearfix">';
		$output .= $voting_box;
		$output .= '</div>';
		$output .= '</div>';

		newsy_sanitize_echo( $output );
	}

	/**
	 * Get the comment form spot of the single post.
	 *
	 * @return string
	 */
	public function get_comments_form() {
		if ( 'hide' === newsy_get_option( 'post_show_comments' ) ) {
			return;
		}

		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	}
}
