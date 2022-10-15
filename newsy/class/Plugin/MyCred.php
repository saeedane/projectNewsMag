<?php

namespace Newsy\Plugin;

/**
 * Newsy MyCred plugin compatibility handler.
 */
class MyCred {

	/**
	 * @var MyCred
	 */
	private static $instance;

	/**
	 * @return MyCred
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		add_action( 'mycred_init', array( $this, 'mycred_init' ), 99 );
		add_filter( 'ak-framework/product/demos', array( $this, 'mycred_register_demos' ) );
		add_filter( 'mycred_front_enqueue', array( $this, 'deregister_style' ), 99 );
		add_filter( 'mycred_remove_widget_css', '__return_true' );
		add_filter( 'newsy_import_data_panel_active', '__return_true' );
	}

	/**
	 * Add myCred import data to panel
	 */
	public function mycred_register_demos( $demos ) {
		$demos['mycred'] = array(
			'product'     => 'newsy-imports',
			'path'        => NEWSY_THEME_PATH . 'includes/imports/mycred/',
			'thumbnail'   => NEWSY_THEME_URI . '/includes/imports/mycred/thumbnail.png',
			'name'        => esc_html__( 'myCred Ranks & Badgets', 'newsy' ),
			'clear_group' => false,
		);

		return $demos;
	}

	/**
	 * Get Mycred Badges slug.
	 */
	public function mycred_init() {
		$ranks_module = mycred_get_module( 'ranks' );
		$badge_module = mycred_get_module( 'badges' );

		if ( $ranks_module ) {
			remove_action( 'bp_before_member_header_meta', array( $ranks_module, 'insert_rank_header' ) );
			add_filter( 'mycred_ranking_row', array( $this, 'leader_board_widget_row' ), 10, 5 );

			// author box
			add_action( 'newsy_author_box_avatar_after', array( $this, 'display_user_rank_image' ) );
			add_action( 'newsy_author_box_counters', array( $this, 'add_author_box_point_counter' ), 11 );

			// buddypress
			add_filter( 'newsy/buddypress/user-totals', array( $this, 'bp_header_meta_render_points_count' ), 10, 1 );
			add_action( 'newsy_bp_members_avatar_after', array( $this, 'display_user_rank_image' ) );
		}

		if ( $badge_module ) {
			remove_shortcode( 'mycred_badges' );
			remove_shortcode( 'mycred_my_badges' );
			remove_action( 'bp_before_member_header_meta', array( $badge_module, 'insert_into_buddypress' ) );
			remove_action( 'bp_before_member_header_meta', array( $badge_module, 'show_balance' ) );
			call_user_func( 'add' . '_' . 'shortcode', 'mycred_badges', array( $this, 'render_badge_list' ) );
			call_user_func( 'add' . '_' . 'shortcode', 'mycred_my_badges', array( $this, 'render_my_badge_list' ) );
			add_action( 'newsy_author_box_extras', array( $this, 'author_box_badges' ), 11 );
			add_action( 'newsy_bp_members_after_user_name', array( $this, 'author_box_badges' ) );
			add_action( 'bp_setup_nav', array( $this, 'add_mycred_badges_tab' ), 1 );
		}
	}

	/**
	 * Get Mycred Badges slug.
	 */
	public function badges_slug() {
		return apply_filters( 'newsy_mycred_badges_slug', 'badges' );
	}

	/**
	 * Leader Board Widget.
	 */
	public function leader_board_widget_row( $layout, $template, $user, $position, $data ) {
		$author_id   = $user['ID'];
		$author_url  = get_author_posts_url( $author_id );
		$author_name = get_the_author_meta( 'display_name', $author_id );
		$avatar      = get_avatar( $author_id, 90, null, $author_name );
		$points      = newsy_get_number_format( $user['cred'] );
		$rank_img    = $this->display_user_rank_image( $author_id, false );

		$points = sprintf(
			'<div class="ak-leaderboard-points-item">
            <span class="item-count">%s</span>
            <span class="item-label">%s</span>
        </div>', newsy_get_number_format( $points ), newsy_get_translation( 'Points', 'newsy', 'points' )
		);

		$layout = '<li class="ak-leaderboard-item">
						<div class="ak-leaderboard-position"> ' . $position . '</div>
						<div class="ak-leaderboard-avatar"><a class="ak-leaderboard-item-link" href="' . $author_url . '">' . $avatar . $rank_img . '</a></div>
						<div class="ak-leaderboard-content">
							<div class="ak-leaderboard-username"><a class="ak-leaderboard-item-link" href="' . $author_url . '">' . $author_name . '</a></div>
							<div class="ak-leaderboard-points">' . $points . '</div>
						</div>
					</li>';

		return $layout;
	}

	/**
	 * Add Badges Tab.
	 */
	public function add_mycred_badges_tab() {
		bp_core_new_nav_item(
			array(
				'position'            => 100,
				'slug'                => $this->badges_slug(),
				'default_subnav_slug' => $this->badges_slug(),
				'name'                => newsy_get_translation( 'Badges', 'newsy', 'badges' ),
				'screen_function'     => array( $this, 'profile_mycred_badges_tab_screen' ),
			)
		);
	}

	/**
	 * Get Badges Tab Template.
	 */
	public function profile_mycred_badges_tab_screen() {
		// Call Posts Tab Content.
		add_action( 'bp_template_content', array( $this, 'profile_mycred_badges_page_content' ) );

		// Load Tab Template
		bp_core_load_template( 'buddypress/members/single/plugins' );
	}

	/**
	 * Get Badges Tab Template.
	 */
	public function profile_mycred_badges_page_content() {
		// Call Posts Tab Content.
		echo do_shortcode( '[mycred_my_badges show="all" user_id="' . bp_displayed_user_id() . '"]' );
	}

	/**
	 * Render visible points total in buddypress header meta.
	 *
	 * @param $content
	 *
	 * @return string
	 */
	public function bp_header_meta_render_points_count( $content ) {
		$user_id = bp_displayed_user_id();

		$types    = apply_filters( 'newsy/mycred/bp_member_header_display_point_types', mycred_get_types() );
		$treshold = apply_filters( 'newsy/buddypress/member_header_points_treshold', -1 );
		foreach ( $types as $type => $label ) {
			$total_balance = mycred_get_users_balance( $user_id, $type );
			if ( $total_balance > $treshold ) {
				/* translators: %s: total */
				$total_label = sprintf( newsy_get_translation( 'Total %s', 'newsy', 'total_s' ), $label );

				$content .= sprintf(
					'<li>
                    <span class="total-label">%s:</span>
                    <span class="total-count">%s</span>
                </li>', $total_label, newsy_get_number_format( $total_balance )
				);
			}
		}

		return $content;
	}

	/**
	 * Author Box - Display Badges.
	 */
	public function add_author_box_point_counter( $user_id = null ) {
		$count = esc_html( mycred_display_users_balance( $user_id ) );

		printf(
			'<div class="ak-counter-item">
            <div class="item-count">%s</div>
            <div class="item-label">%s</div>
        </div>', newsy_get_number_format( $count ), newsy_get_translation( 'Points', 'newsy', 'points' )
		);
	}

	/**
	 * Author Box - Display Badges.
	 */
	public function author_box_badges( $user_id = null ) {
		// Get badges visibility
		if ( 'hide' === newsy_get_option( 'show_author_box_mycred_badges' ) ) {
			return;
		}

		// Get Bages max number.
		$max_badges = newsy_get_option( 'author_box_mycred_badges_limit', 5 );

		$this->get_user_badges( $user_id, $max_badges, 'box', 40, 40 );
	}

	/**
	 * Members Directory - Display Badges.
	 */
	public function display_user_rank_image( $user_id, $echo = true ) {
		// Get badges visibility
		if ( 'hide' === newsy_get_option( 'show_author_box_mycred_rank' ) || ! function_exists( 'mycred_get_users_rank' ) ) {
			return;
		}

		$rank = mycred_get_users_rank( $user_id );
		if ( is_object( $rank ) && $rank->logo_url ) {
			$src   = $rank->logo_url;
			$title = $rank->title;
			$image = "<img src='$src' title='$title' class='author-image-rank' alt='$title'/>";
		} else {
			$rank_id = mycred_get_users_rank_id( $user_id );
			$image   = mycred_get_rank_logo( $rank_id, 'full', array( 'class' => 'author-image-rank' ) );
		}

		if ( ! $echo ) {
			return $image;
		}

		newsy_sanitize_echo( $image );
	}

	/**
	 * Get User Badges.
	 */
	public function get_user_badges( $user_id = null, $max_badges = 5, $more_type = 'box', $width = MYCRED_BADGE_WIDTH, $height = MYCRED_BADGE_HEIGHT ) {
		if ( ! function_exists( 'mycred_get_users_badges' ) ) {
			return;
		}

		// Get User ID.
		$user_id = ! empty( $user_id ) ? $user_id : get_current_user_id();

		// Get Ballance
		$user_badges = mycred_get_users_badges( $user_id );

		// Get Badges total
		$badges_nbr = count( $user_badges );

		if ( ! $badges_nbr ) {
			return;
		}

		echo '<div class="ak-user-badges">';

		if ( ! empty( $user_badges ) ) {
			// Limit Bqdges Number
			$user_badges = array_slice( $user_badges, 0, $max_badges, true );

			foreach ( $user_badges as $badge_id => $level ) {
				$badge = mycred_get_badge( $badge_id, $level );

				if ( ! $badge ) {
					continue;
				}

				$badge->image_width  = $width;
				$badge->image_height = $height;

				if ( $badge->level_image ) {
					echo '<div class="ak-badge-item">';
					echo apply_filters( 'mycred_the_badge', $badge->get_image( $level ), $badge_id, $badge, $user_id );
					echo '</div>';
				}
			}

			if ( 'box' === $more_type ) {
				// $this->get_badges_more_button( $user_id, $badges_nbr, $max_badges, $more_type );
			}
		};

		echo '</div>';

		if ( 'text' === $more_type ) {
			$this->get_badges_more_button( $user_id, $badges_nbr, $max_badges, $more_type );
		}
	}

	/**
	 * Get Badges Widget More Button.
	 */
	public function get_badges_more_button( $user_id = null, $badges_nbr = null, $max_badges = null, $more_type = 'box' ) {
		if ( $badges_nbr > $max_badges ) :

			$more_nbr = $badges_nbr - $max_badges;
				/* translators: %s: badge count */
			$more_title = ( 'text' === $more_type ) ? sprintf( newsy_get_translation( 'Show All Badges ( %s )', 'newsy', 'show_all_badges' ), $badges_nbr ) : '+' . $more_nbr;
			?>
			<div class="ak-badge-item ak-badge-more-items ak-user-badges-more-<?php echo esc_attr( $more_type ); ?>">
				<a href="<?php echo bp_core_get_user_domain( $user_id ) . $this->badges_slug(); ?>"><?php echo esc_html( $more_title ); ?></a>
			</div>
			<?php
		endif;
	}

	/**
	 * Replacement for mycred_badges shortcode
	 */
	public function render_badge_list() {
		$all_badges = mycred_get_badge_ids();
		ob_start();
		?>
		<div class="ak-mycred-badges">
		<ul class="grid three item-list bp-list">
			<?php
			if ( ! empty( $all_badges ) ) {
				foreach ( $all_badges as $badge_id ) {
					$badge        = mycred_get_badge( $badge_id, 0 );
					$image        = preg_replace( '/width=\".*\"/U', '', $badge->level_image );
					$image        = preg_replace( '/height=\".*\"/U', '', $image );
					$requirements = mycred_display_badge_requirements( $badge_id );
					$requirements = preg_replace( '/\(.*\)/U', '', $requirements );
					$excerpt      = get_post_field( 'post_excerpt', $badge_id );
					$class        = '';
					/* translators: %s: level */
					$level_str = newsy_get_translation( 'Level %s', 'newsy', 'level_s' );
					$level_str = trim( str_replace( '%s', '', $level_str ) );

					if ( substr_count( $requirements, '<strong>' . $level_str ) < 2 ) {
						$class = 'badge-single-level';
					}
					?>
					<li class="<?php echo sanitize_html_class( $class ); ?>">
						<div class="ak-mycred-badge">
							<?php echo wp_kses_post( $image ); ?>
							<h4><?php echo esc_html( $badge->title ); ?></h4>
							<p><?php esc_html_e( 'Users with badge: ', 'newsy' ); ?><?php echo esc_html( $badge->earnedby ); ?></p>
							<div class="ak-badges-requirements">
								<?php
								if ( empty( $excerpt ) ) {
									newsy_sanitize_echo( $requirements );
								} else {
									newsy_sanitize_echo( $excerpt );
								}
								?>
							</div>
						</div>
					</li>
					<?php
				}
			}
			?>
		</ul>
		</div>
		<?php
		$output = ob_get_clean();
		return apply_filters( 'mycred_badges', $output );
	}

	/**
	 * Replacement for mycred_my_badges shortcode
	 */
	public function render_my_badge_list( $atts, $content = '' ) {
		$all_badges   = mycred_get_badge_ids();
		$atts         = shortcode_atts(
			array(
				'show'    => 'earned',
				'user_id' => 'current',
			), $atts
		);
		$user_id      = mycred_get_user_id( $atts['user_id'] );
		$users_badges = mycred_get_users_badges( $user_id );
		ob_start();
		?>
	<div class="ak-mycred-badges">
		<ul class="grid three item-list bp-list">
			<?php
			if ( ! empty( $all_badges ) ) {
				$earned = array();
				$locked = array();
				foreach ( $all_badges as $badge_id ) {
					if ( array_key_exists( $badge_id, $users_badges ) ) {
						$earned[] = $badge_id;
					} else {
						$locked[] = $badge_id;
					}
				}
				$all_badges = array_merge( $earned, $locked );
				foreach ( $all_badges as $badge_id ) {
					$level = false;
					if ( array_key_exists( $badge_id, $users_badges ) ) {
						$level = $users_badges[ $badge_id ];
					}
					$badge = mycred_get_badge( $badge_id, $level );
					if ( false !== $level ) {
						$image = preg_replace( '/width=\".*\"/U', '', $badge->level_image );
					} else {
						$image = preg_replace( '/width=\".*\"/U', '', $badge->main_image );
					}
					$image        = preg_replace( '/height=\".*\"/U', '', $image );
					$requirements = mycred_display_badge_requirements( $badge_id );
					$requirements = preg_replace( '/\(.*\)/U', '', $requirements );
					$excerpt      = get_post_field( 'post_excerpt', $badge_id );
					$class        = '';

						/* translators: %s: level */
					$level_str = newsy_get_translation( 'Level %s', 'newsy', 'level_s' );
					$level_str = trim( str_replace( '%s', '', $level_str ) );

					if ( substr_count( $requirements, '<strong>' . $level_str ) < 2 ) {
						$class = 'badge-single-level';
					}
					?>
					<li class="<?php echo sanitize_html_class( $class ); ?>">
						<div class="ak-mycred-badge">
							<?php echo wp_kses_post( $image ); ?>
							<h4><?php echo esc_html( $badge->title ); ?></h4>
							<?php
							if ( false !== $level ) {
								?>
								<p><?php newsy_echo_translation( 'Level:', 'newsy', 'level' ); ?><?php echo esc_html( $level + 1 ); ?></p>
								<?php
							} else {
								?>
								<p><?php newsy_echo_translation( 'Locked', 'newsy', 'locked' ); ?></p>
								<?php
							}
							?>
							<div class="ak-badges-requirements">
								<?php
								if ( get_current_user_id() === $user_id ) {
									newsy_sanitize_echo( $requirements );
								}
								?>
							</div>
						</div>
					</li>
					<?php
				}
			}
			?>
		</ul>
	</div>
		<?php
		$output = ob_get_clean();
		return apply_filters( 'mycred_my_badges', $output );
	}

	public function deregister_style() {
		if ( apply_filters( 'mycred_remove_widget_css', false ) ) {
			wp_deregister_style( 'mycred-social-share-icons' );
			wp_deregister_style( 'mycred-social-share-style' );
			wp_deregister_style( 'mycred-notifications' );
		}
	}
}
