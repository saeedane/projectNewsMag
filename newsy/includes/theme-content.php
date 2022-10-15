<?php

if ( ! function_exists( 'newsy_get_ad' ) ) {
	/**
	 * Returns the ad
	 *
	 * @return mixed
	 */
	function newsy_get_ad( $id, $block_width = null, $defaults = array() ) {
		$atts = newsy_get_option( $id, $defaults );
		$args = array( 'classes' => 'ak-ad-' . $id );

		if ( $block_width ) {
			$args['block_width'] = $block_width;
		}

		ak_do_shortcode( 'newsy_ad', wp_parse_args( $atts, $args ) );
	}
}

if ( ! function_exists( 'newsy_get_loader' ) ) {
	/**
	 * Returns the content loader.
	 *
	 * @return string
	 */
	function newsy_get_loader() {
		$loader_style = newsy_get_option( 'block_loader_type', 'dot' );
		$loader_html  = '';

		switch ( $loader_style ) {
			case 'circle':
				$loader_html = '<div class="ak-loading-circle"><div class="ak-loading-circle-inner"></div></div>';
				break;

			case 'square':
				$loader_html = '<div class="ak-loading-square"><div class="ak-loading-square-inner"></div></div>';
				break;

			case 'cube':
				$loader_html = '<div class="ak-loading-cube"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>';
				break;

			case 'dot':
				$loader_html = '<div class="ak-loading-dot"><span></span><span></span><span></span></div>';
				break;
		}

		$loader_html = apply_filters( 'newsy_loader_html', $loader_html, $loader_style );

		return '<div class="ak-loading-wrap clearfix">' . $loader_html . '</div>';
	}

	add_filter( 'newsy_block_loader_html', 'newsy_get_loader' );
}

if ( ! function_exists( 'newsy_get_readable_date' ) ) {
	/**
	 * Used to get readable time.
	 *
	 * @param null $date
	 *
	 * @return string
	 */
	function newsy_get_readable_date( $date = null ) {
		return sprintf( ak_get_translation( '%s ago', 'newsy', 'readable_time_ago' ), human_time_diff( $date, current_time( 'timestamp' ) ) );
	}
}

if ( ! function_exists( 'newsy_get_post_comment_count' ) ) {
	function newsy_get_post_comment_count( $post_id, $force = false ) {
		return Newsy\Support\Comment::get_instance()->get_total( $post_id, $force );
	}
}


function newsy_get_post_content_embed_url( $post = null ) {
	$post = get_post( $post );

	if ( ! $post ) {
		return false;
	}

	$url     = '';
	$content = $post->post_content;

	$blocks = parse_blocks( $content );

	foreach ( $blocks as $block ) {
		if ( 'core/embed' === $block['blockName'] ) {
			$url = isset( $block['attrs']['url'] ) ? $block['attrs']['url'] : '';
			break;
		}
		if ( 'core/video' === $block['blockName'] ) {
			$url = isset( $block['attrs']['id'] ) ? wp_get_attachment_url( $block['attrs']['id'] ) : '';
			break;
		}
	}

	if ( empty( $url ) ) {
		$content = preg_replace( '/<!--(.|\s)*?-->/', '', $content );

		$content = preg_replace( '/<iframe[^>]+>.*<\/iframe>/isU', '', $content );

		if ( preg_match( '/https?:\/\/[^\n"\'<]+/i', $content, $matches ) ) {
			$url = $matches[0];
		}
	}

	if ( ! empty( $url ) ) {
		return trim( esc_url_raw( $url ) );
	}

	return false;
}


if ( ! function_exists( 'newsy_get_post_featured_video' ) ) {
	/**
	 * Returns post video if there is any.
	 *
	 * @return mixed
	 */
	function newsy_get_post_featured_video( $post_id, $autoplay = false ) {
		$video = get_post_meta( (int) $post_id, 'ak_featured_video', true );

		if ( empty( $video ) || empty( $video['type'] ) ) {
			return '';
		}

		$video_type = ! empty( $video['type'] ) ? $video['type'] : '';
		$video_url  = ! empty( $video['url'] ) ? $video['url'] : '';
		$autoplay   = $autoplay ? 'true' : 'false';

		if ( 'auto' === $video_type || 'url' === $video_type ) {
			if ( 'auto' === $video_type ) {
				$video_url = newsy_get_post_content_embed_url( $post_id );
			}

			if ( empty( $video_url ) ) {
				return '';
			}

			$video_type = Newsy\Support\VideoThumbnail::get_instance()->get_video_provider( $video_url );
		}

		if ( 'youtube' === $video_type ) {
			$output =
			'<div data-src="' . esc_url( $video_url ) . '" data-type="youtube" data-repeat="false" data-autoplay="' . $autoplay . '" class="ak-video-player ak-youtube-player clearfix">
                    <div class="ak-video-container"></div>
                </div>';
		} elseif ( 'vimeo' === $video_type ) {
			$output =
			'<div data-src="' . esc_url( $video_url ) . '" data-repeat="false" data-autoplay="' . $autoplay . '" data-type="vimeo" class="ak-video-player ak-vimeo-player clearfix">
                    <div class="ak-video-container"></div>
                </div>';
		} elseif ( 'mp4' === $video_type || 'webm' === $video_type ) {
			$featured_img = get_the_post_thumbnail_url( $post_id, 'newsy_750x0' );
			$output       =
				'<div data-mp4="' . esc_url( $video_url ) . '" data-webm="' . esc_url( $video_url ) . '" data-cover="' . esc_url( $featured_img ) . '"
				    data-controls="yes" data-repeat="false" data-autoplay="' . $autoplay . '" data-type="video" class="ak-video-player ak-mp4-player clearfix"></div>';
		} elseif ( 'upload' === $video_type ) {
			$featured_img   = get_the_post_thumbnail_url( $post_id, 'newsy_750x0' );
			$video_mp4      = ! empty( $video['mp4'] ) ? $video['mp4'] : '';
			$video_webm     = ! empty( $video['webm'] ) ? $video['webm'] : '';
			$video_gif      = ! empty( $video['gif'] ) ? $video['gif'] : '';
			$video_controls = ! empty( $video['controls'] ) ? $video['controls'] : '';
			$video_length   = ! empty( $video['length'] ) ? $video['length'] : '';

			$output =
				'<div data-mp4="' . esc_url( $video_mp4 ) . '" data-webm="' . esc_url( $video_webm ) . '" data-cover="' . esc_url( $featured_img ) . '"
                data-is-gif="' . esc_attr( $video_gif ) . '" data-controls="' . esc_attr( $video_controls ) . '" data-length="' . esc_attr( $video_length ) . '"  data-repeat="false"
                data-autoplay="' . $autoplay . '" data-type="video" class="ak-video-player ak-mp4-player clearfix">
                </div>';
		} else {
			$output = '<div class="ak-embed-container">' . wp_oembed_get( $video_url ) . '</div>';
		}

		$output = apply_filters( 'newsy_post_featured_video_html', $output, $video_type, $video_url, $video, $autoplay );

		return "<div class=\"ak-featured-media\">{$output}</div>";
	}
}

if ( ! function_exists( 'newsy_generate_user_icon' ) ) {
	/**
	 * Generate user icon with dropdown menu.
	 *
	 * @return string
	 */
	function newsy_generate_user_icon() {
		$current_user = wp_get_current_user();

		$dropdown            = array();
		$dropdown['profile'] = array(
			'text' => esc_html( $current_user->display_name ),
			'url'  => get_author_posts_url( $current_user->ID ),
		);

		if ( has_nav_menu( 'member-menu' ) ) {
			$locations  = get_nav_menu_locations();
			$object     = wp_get_nav_menu_object( $locations['member-menu'] );
			$menu_items = wp_get_nav_menu_items( $object->name );

			if ( ! empty( $menu_items ) ) {
				foreach ( $menu_items as $menu_item ) {
					$dropdown[ $menu_item->ID ] = array(
						'text' => $menu_item->title,
						'url'  => $menu_item->url,
					);
				}
			}
		} else {
			$dropdown = apply_filters( 'newsy_user_default_dropdown', $dropdown );
		}

		$dropdown = apply_filters( 'newsy_user_dropdown', $dropdown );

		$dropdown['logout'] = array(
			'text' => newsy_get_translation( 'Logout', 'newsy', 'logout' ),
			'url'  => wp_logout_url( home_url() ),
		);
		?>
		<ul class="ak-menu ak-menu-wide ak-user-menu">
			<li class="menu-item menu-animation-FadeIn">
				<a href="<?php echo get_author_posts_url( $current_user->ID ); ?>" class="user-avatar">
					<?php echo get_avatar( $current_user->ID, 32 ); ?>
				</a>
				<ul class="sub-menu">
					<?php
					foreach ( $dropdown as $key => $value ) {
						printf(
							'<li><a href="%s" class="user-menu-item-%s">%s</a></li>',
							esc_url( $value['url'] ),
							$key,
							$value['text']
						);
					}
					?>
				</ul>
			</li>
		</ul>
		<?php
	}
}

if ( ! function_exists( 'newsy_generate_button' ) ) {
	/**
	 * Generate a button from option.
	 *
	 * @param string $value Button vale option key
	 *
	 * @return string
	 */
	function newsy_generate_button( $value, $defaults = array() ) {
		$button = newsy_get_option( $value );

		if ( ! empty( $defaults ) ) {
			$button = wp_parse_args( $button, $defaults );
		}

		$button_text   = ! empty( $button['text'] ) ? $button['text'] : 'Your text';
		$button_style  = ! empty( $button['style'] ) ? $button['style'] : '';
		$button_link   = ! empty( $button['link'] ) ? $button['link'] : '#';
		$button_target = ! empty( $button['target'] ) ? $button['target'] : '_blank';
		$button_icon   = ! empty( $button['icon'] ) ? ak_get_icon( $button['icon'] ) : '';
		$button_link   = strpos( 'http', $button_link ) !== -1 ? $button_link : home_url( '/' . ltrim( $button_link, '/' ) );

		if ( ! empty( $button['login'] ) && 'yes' === $button['login'] ) {
			$button_style .= ' ak_require_login_button';
		}

		if ( ! empty( $button['extra_classes'] ) ) {
			$button_style .= ' ' . $button['extra_classes'];
		}

		printf(
			'<a href="%s" class="btn %s" target="%s">%s%s</a>',
			esc_url( $button_link ),
			esc_attr( $button_style ),
			esc_attr( $button_target ),
			$button_icon,
			esc_html( $button_text )
		);
	}
}

if ( ! function_exists( 'newsy_generate_logo' ) ) {
	/**
	 * Generate a Logo from option
	 *
	 * @param string $place
	 *
	 * @return string
	 */
	function newsy_generate_logo( $place = '' ) {
		$_place     = $place ? $place . '_' : '';
		$_place_s   = $place ? $place : 'site';
		$logo_type  = newsy_get_option( $_place . 'logo_type', 'image' );
		$logo_text  = newsy_get_option( $_place . 'logo_text' );
		$force_dark = apply_filters( 'newsy_is_bar_dark_scheme', false );

		if ( empty( $logo_text ) ) {
			$logo_text = newsy_get_option( 'logo_text', get_bloginfo( 'name' ) );
		}

		if ( 'image' === $logo_type ) {
			$logo       = newsy_get_option( $_place . 'logo_image', newsy_get_option( 'logo_image', NEWSY_THEME_URI . '/assets/images/logo.png' ) );
			$logo2x     = newsy_get_option( $_place . 'logo2x_image', newsy_get_option( 'logo2x_image', NEWSY_THEME_URI . '/assets/images/logo@2x.png' ) );
			$logodark   = newsy_get_option( $_place . 'logo_dark_image', newsy_get_option( 'logo_dark_image', NEWSY_THEME_URI . '/assets/images/logo-dark.png' ) );
			$logodark2x = newsy_get_option( $_place . 'logo2x_dark_image', newsy_get_option( 'logo2x_dark_image', NEWSY_THEME_URI . '/assets/images/logo-dark@2x.png' ) );
			$logowidth  = newsy_get_option( $_place . 'main_logo_width', newsy_get_option( 'main_logo_width' ) );
			$logoheight = newsy_get_option( $_place . 'logo_height', newsy_get_option( 'logo_height' ) );

			$datasrclight    = 'data-light-src="' . esc_url( $logo ) . '" ';
			$datasrcsetlight = 'data-light-srcset="' . esc_url( $logo ) . ' 1x, ' . esc_url( $logo2x ) . ' 2x" ';
			$datasrcdark     = 'data-dark-src="' . esc_url( $logodark ) . '" ';
			$datasrcsetdark  = 'data-dark-srcset="' . esc_url( $logodark ) . ' 1x, ' . esc_url( $logodark2x ) . ' 2x"';

			$src    = 'src="' . esc_url( $logo ) . '" ';
			$srcset = 'srcset="' . esc_url( $logo ) . ' 1x, ' . esc_url( $logo2x ) . ' 2x"';

			if ( $force_dark || newsy_is_dark_mode() ) {
				$src    = 'src="' . esc_url( $logodark ) . '" ';
				$srcset = 'srcset="' . esc_url( $logodark ) . ' 1x, ' . esc_url( $logodark2x ) . ' 2x"';
			}

			$size = '';
			if ( $logowidth && $logoheight ) {
				$size = ' width="' . esc_attr( $logowidth ) . '"';

				if ( $logoheight ) {
					$size .= ' height="' . esc_attr( $logoheight ) . '"';
				}
			}

			if ( $logo ) {
				$logo_text = '<img class="' . $_place_s . '-logo" ' . $src . $srcset . ' alt="' . esc_attr( $logo_text ) . '" ' . $datasrclight . $datasrcsetlight . $datasrcdark . $datasrcsetdark . $size . '>';
			}
		}

		return $logo_text;
	}
}

if ( ! function_exists( 'newsy_generate_bar' ) ) {
	/**
	 * Generate header bar from option.
	 *
	 * @param array $rows Bar rows to generate.
	 * @param string $row Row name.
	 * @param string $place Bar place.
	 *
	 * @return mixed
	 */
	function newsy_generate_bar( $rows, $row, $place = 'header' ) {
		$row_scheme = ! empty( $rows['scheme'] ) ? $rows['scheme'] : '';
		$row_layout = ! empty( $rows['layout'] ) ? $rows['layout'] : 'full-width';

		newsy_set_bar_dark_scheme( $row_scheme );

		if ( 'stretched' === $row_layout ) {
			$row_layout = 'full-width stretched';
		}

		if ( 'dark' === $row_scheme ) {
			$row_scheme = 'ak-bar-dark';

			if ( 'header' !== $place ) {
				$row_scheme .= ' dark';
			}
		}

		$row_responsive = '';
		if ( 'footer' === $place ) {
			$row_responsive = ' ak-row-responsive';
		}

		if ( ! empty( $rows['left']['items'] ) || ! empty( $rows['center']['items'] ) || ! empty( $rows['right']['items'] ) ) {
			?>
		<div class="ak-bar ak-<?php echo esc_attr( $place ); ?>-bar ak-<?php echo esc_attr( $row ); ?>-bar <?php echo esc_attr( $row_scheme ); ?> <?php echo esc_attr( $row_layout ); ?> clearfix">
			<div class="container">
				<div class="ak-bar-inner">
				<div class="ak-row ak-row-items-middle<?php echo esc_attr( $row_responsive ); ?>">
					<?php if ( ! empty( $rows['left']['items'] ) ) : ?>
					<div class="ak-column ak-column-left ak-column-<?php echo isset( $rows['left']['layout'] ) ? esc_attr( $rows['left']['layout'] ) : 'grow'; ?>">
						<div class="ak-inner-row ak-row-items-middle ak-justify-content-<?php echo isset( $rows['left']['align'] ) ? $rows['left']['align'] : 'left'; ?>">
							<?php
							foreach ( (array) $rows['left']['items'] as $part ) {
								newsy_generate_bar_item( $part );
							}
							?>
						</div>
					</div>
						<?php
					endif;
					if ( ! empty( $rows['center']['items'] ) ) :
						?>
					<div class="ak-column ak-column-center ak-column-<?php echo isset( $rows['center']['layout'] ) ? esc_attr( $rows['center']['layout'] ) : 'normal'; ?>">
						<div class="ak-inner-row ak-row-items-middle ak-justify-content-<?php echo isset( $rows['center']['align'] ) ? esc_attr( $rows['center']['align'] ) : 'center'; ?>">
							<?php
							foreach ( (array) $rows['center']['items'] as $part ) {
								newsy_generate_bar_item( $part );
							}
							?>
						</div>
					</div>
						<?php
					endif;
					if ( ! empty( $rows['right']['items'] ) ) :
						?>
					<div class="ak-column ak-column-right ak-column-<?php echo isset( $rows['right']['layout'] ) ? esc_attr( $rows['right']['layout'] ) : 'grow'; ?>">
						<div class="ak-inner-row ak-row-items-middle ak-justify-content-<?php echo isset( $rows['right']['align'] ) ? esc_attr( $rows['right']['align'] ) : 'right'; ?>">
							<?php
							foreach ( (array) $rows['right']['items'] as $part ) {
								newsy_generate_bar_item( $part );
							}
							?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
			</div>
		</div>
			<?php
		}
		newsy_unset_bar_dark_scheme();
	}
}

if ( ! function_exists( 'newsy_generate_bar_item' ) ) {
	/**
	 * Generate header bar item.
	 *
	 * @param string $item Bar Item.
	 *
	 * @return void
	 */
	function newsy_generate_bar_item( $item ) {
		locate_template( array( 'views/builder/items/' . $item . '.php' ), true, false );
	}
}

if ( ! function_exists( 'newsy_set_bar_dark_scheme' ) ) {
	function newsy_set_bar_dark_scheme( $scheme ) {
		call_user_func( 'add_filter', 'newsy_is_bar_dark_scheme', 'dark' === $scheme ? '__return_true' : '__return_false' );
	}
}

if ( ! function_exists( 'newsy_unset_bar_dark_scheme' ) ) {
	function newsy_unset_bar_dark_scheme() {
		call_user_func( 'remove_filter', 'newsy_is_bar_dark_scheme', '__return_false' );
	}
}

if ( ! function_exists( 'newsy_set_header_rows_dark_scheme' ) ) {
	/**
	 * Force set header rows to dark scheme.
	 *
	 * @return array
	 */
	function newsy_set_header_rows_dark_scheme( $bars ) {
		$bars['top']['scheme']    = 'dark';
		$bars['mid']['scheme']    = 'dark';
		$bars['bottom']['scheme'] = 'dark';

		return $bars;
	}
}

if ( ! function_exists( 'newsy_get_term_badge_icon' ) ) {
	/**
	 * Generate a badge icon from option.
	 *
	 * @param WP_Term $term.
	 * @param array $args.
	 *
	 * @return mixed
	 */
	function newsy_get_term_badge_icon( $term, $args = array() ) {

		$buffy = '';

		if ( ! is_wp_error( $term ) && gettype( $term ) == 'object' ) {
			$term_url        = get_term_link( $term, '' );
			$term_badge_type = get_term_meta( $term->term_id, 'ak_term_badge_type', true );

			if ( empty( $term_badge_type ) ) {
				return '';
			}

			$term_badge_icon = get_term_meta( $term->term_id, 'ak_term_badge_icon', true );
			$term_badge_text = get_term_meta( $term->term_id, 'ak_term_badge_text', true );

			$term_args = array(
				'only_icon'   => false,
				'url'         => $term_url,
				'icon'        => $term_badge_icon,
				'text'        => ! empty( $term_badge_text ) ? $term_badge_text : $term->name,
				'icon_width'  => 50,
				'icon_height' => 50,
			);

			$args = wp_parse_args( $args, $term_args );
			if ( ! $args['only_icon'] ) {
				$buffy .= '<a href="' . esc_url( $args['url'] ) . '" title="' . esc_attr( $args['text'] ) . '">';
			}

			$buffy .= '<span class="ak-badge-icon ak-badge-type-' . esc_attr( $term_badge_type ) . ' term-' . $term->term_id . '">';
			if ( 'text' === $term_badge_type ) {
				$buffy .= '<span class="ak-badge-icon-text">' . esc_html( $args['text'] ) . '</span>';
			} else {
				$buffy .= ak_get_icon( $args['icon'], 'ak-badge-icon-i', $args['text'] );
			}
			$buffy .= '</span>';

			if ( ! $args['only_icon'] ) {
				$buffy .= '</a>';
			}
		}

		return $buffy;
	}
}

if ( ! function_exists( 'newsy_get_copyright_text' ) ) {
	/**
	 * Generate copyright text from option.
	 *
	 * @return string
	 */
	function newsy_get_copyright_text() {
		$date     = date( 'Y' );
		$name     = get_bloginfo( 'name' );
		$title    = get_bloginfo( 'description' );
		$home_url = get_home_url();

		// Prepare copyright Text
		$copy_text = str_replace(
			array(
				'#year#',
				'%date#',
				'#title#',
				'#sitename#',
				'#siteurl#',
			),
			array(
				$date,
				$date,
				$title,
				$name,
				$home_url,
			),
			newsy_get_option( 'footer_copyright', 'Copyright © #year# <a href="#siteurl#" title="#title#">#sitename#</a> - #title#.' )
		);

		return $copy_text;
	}
}
