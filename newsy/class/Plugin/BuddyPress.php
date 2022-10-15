<?php

namespace Newsy\Plugin;

/**
 * Newsy BuddyPress plugin compatibility handler.
 */
class BuddyPress {

	/**
	 * @var BuddyPress
	 */
	private static $instance;

	/**
	 * BuddyPress constructor.
	 */
	public function __construct() {
		// Buddypress support
		add_theme_support( 'buddypress-use-nouveau' );

		$this->constants();
		$this->hook();
	}

	/**
	 * @return BuddyPress
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Callback: adds some code change to bbPress and other simple things.
	 *
	 * Filter: init
	 */
	public function constants() {
		if ( ! defined( 'BP_AVATAR_FULL_WIDTH' ) ) {
			define( 'BP_AVATAR_FULL_WIDTH', 200 );
		}
		if ( ! defined( 'BP_AVATAR_FULL_HEIGHT' ) ) {
			define( 'BP_AVATAR_FULL_HEIGHT', 200 );
		}

		if ( ! defined( 'BP_AVATAR_THUMB_WIDTH' ) ) {
			define( 'BP_AVATAR_THUMB_WIDTH', 60 );
		}
		if ( ! defined( 'BP_AVATAR_THUMB_HEIGHT' ) ) {
			define( 'BP_AVATAR_THUMB_HEIGHT', 60 );
		}
	}

	/**
	 * Callback: adds some code change to bbPress and other simple things.
	 *
	 * Filter: init
	 */
	public function hook() {
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ), 99 );

		add_filter( 'author_link', array( $this, 'author_link' ), 10, 3 );
		add_filter( 'author_bio', array( $this, 'author_bio' ), 10, 2 );

		add_filter( 'bp_get_last_activity', array( $this, 'last_activity' ), 10, 2 );
		add_filter( 'bp_get_add_friend_button', array( $this, 'add_button_class' ), 10, 1 );
		add_filter( 'bp_get_send_public_message_button', array( $this, 'add_button_class_box' ), 10, 1 );
		add_filter( 'bp_get_send_private_message_button', array( $this, 'add_button_class_box' ), 10, 1 );
		add_filter( 'bp_follow_get_add_follow_button', array( $this, 'add_button_class_box' ), 10, 1 );
		add_filter( 'bp_get_send_message_button_args', array( $this, 'add_button_class_box' ), 10, 1 );
		add_filter( 'bp_get_group_join_button', array( $this, 'add_button_class_box' ), 10, 1 );

		add_filter( 'bp_before_members_cover_image_settings_parse_args', array( $this, 'attach_theme_handle' ), 10, 1 );
		add_filter( 'bp_before_groups_cover_image_settings_parse_args', array( $this, 'attach_theme_handle' ), 10, 1 );

		add_action( 'newsy_bp_members_user_sidebar_after', array( $this, 'member_details_registered_since' ), 99 );

		add_action( 'bp_nouveau_get_container_classes', array( $this, 'container_classes' ), 10 );

		add_action( 'newsy_bp_members_user_sidebar_before', array( $this, 'member_details_total_counts' ), 15 ); // Enqueue theme CSS
		add_action( 'newsy_bp_members_user_sidebar_after', array( $this, 'member_social_links' ), 20 );

		add_filter( 'newsy_user_default_dropdown', array( $this, 'user_dropdown_links' ), 20, 1 );

		add_action( 'bp_member_header_actions', array( $this, 'handle_member_header_actions' ) );

		add_action( 'newsy_author_box_extras', array( $this, 'author_box_counters' ), 11 );
		add_action( 'newsy_author_box_actions', array( $this, 'author_box_follow_btn' ), 11 );

		add_action( 'newsy_author_box_counters', array( $this, 'add_author_box_post_count' ), 15 );
		add_action( 'newsy_author_box_counters', array( $this, 'add_author_box_friends_count' ), 20 );
		add_action( 'newsy_author_box_counters', array( $this, 'add_author_box_follower_count' ), 25 );

		add_filter( 'bp_disable_avatar_uploads', '__return_false', 25 );
		add_filter( 'bp_disable_cover_image_uploads', '__return_false', 25 );
		add_filter( 'bp_disable_group_avatar_uploads', '__return_false', 25 );
		add_action( 'bp_disable_group_cover_image_uploads', '__return_false', 25 );
		add_action( 'bp_blocks_init', array( $this, 'deregister_blocks' ), 9 );

		add_action( 'bp_core_activated_user', array( $this, 'autologin_on_activation' ), 40, 3 );

		add_filter( 'bp_nouveau_members_ajax_object_template_response', '__return_empty_array', 99, 2 );
	}

	/**
	 * Callback: Adding Icon to tags.
	*
	* bbp_after_get_topic_tag_list_parse_args
	*/
	public function register_scripts() {
		if ( is_buddypress() ) {
			wp_enqueue_style( 'newsy-buddypress', NEWSY_THEME_URI . '/assets/css/buddypress.css', array(), NEWSY_THEME_VERSION );
			wp_style_add_data( 'newsy-buddypress', 'rtl', 'replace' );
		}

		// the theme does not need buddypress scripts on frontend.
		// users may dequeue buddypress scripts in order to gain some page speed.
		// by default we don't touch anything. user may activate some buddypress plugins depends on this.
		if ( ! is_buddypress() && newsy_get_option( 'dequeue_buddypress_on_frontend' ) === 'yes' ) {
			wp_dequeue_style( 'bp-mentions' );
			wp_dequeue_style( 'bp-legacy' );
			wp_dequeue_style( 'bp-nouveau' );
			wp_dequeue_script( 'bp-confirm' );
			wp_dequeue_script( 'bp-widget-members' );
			wp_dequeue_script( 'bp-jquery-query' );
			wp_dequeue_script( 'bp-jquery-cookie' );
			wp_dequeue_script( 'bp-jquery-scroll-to' );
			wp_dequeue_script( 'bp-legacy' );
			wp_dequeue_script( 'bp-nouveau' );
			wp_dequeue_script( 'jquery-atwho' );
			wp_dequeue_script( 'bp-mentions' );
		}
	}

	/**
	 * Locate WordPress author post link to buddypress profile.
	 */
	public function author_link( $link, $author_id, $author_nicename ) {
		return bp_core_get_user_domain( $author_id );
	}

	/**
	 * Change profile description.
	 *
	 * @param $bio
	 * @param $user_id
	 *
	 * @return mixed
	 */
	public function author_bio( $bio, $user_id ) {
		$field_name        = apply_filters( 'bbp_bio_field_name', 'about' );
		$xprofile_field_id = xprofile_get_field_id_from_name( $field_name );
		if ( $xprofile_field_id ) {
			$xprofile_field_data = xprofile_get_field_data( $xprofile_field_id, $user_id );
			if ( $xprofile_field_data ) {
				return wpautop( $xprofile_field_data, false );
			}
		}

		return $bio;
	}

	/**
	 * Change profile description.
	 *
	 * @param $bio
	 * @param $user_id
	 *
	 * @return mixed
	 */
	public function last_activity( $bio, $user_id ) {
		if ( empty( $user_id ) ) {
			$user_id = bp_displayed_user_id();
		}

		return bp_core_get_last_activity( bp_get_user_last_activity( $user_id ), newsy_get_translation( 'active %s', 'newsy', 'active_s' ) );
	}


	/**
	 * Callback: Adding Icon to favorite.
	 *
	 * Action: bbp_after_get_user_favorites_link_parse_args
	 */
	public function container_classes( $classes ) {
		if ( ! bp_attachments_get_user_has_cover_image() ) {
			$classes .= ' no-item-image';
		}

		return $classes;
	}

	/**
	 * Author Box - Display Badges.
	 */
	public function author_box_counters( $user_id = null ) {
		if ( 'hide' !== newsy_get_option( 'show_author_box_counters' ) ) {
			?>
		<div class="ak-user-counters">
			<?php do_action( 'newsy_author_box_counters', $user_id ); ?>
		</div>
			<?php
		}

	}

	/**
	 * Author Box - Display Badges.
	 */
	public function author_box_follow_btn( $user_id = null ) {
		$follower_id = bp_loggedin_user_id();

		if ( function_exists( 'bp_follow_get_add_follow_button' ) && function_exists( 'bp_loggedin_user_id' ) && $user_id != $follower_id ) {
			/**
			 * Reference buddypress-followers/_inc/bp-follow-templatetags.php:116
			 * Tombolnya muncul hanya ketika login
			 * butuh fake id
			 */
			$counter     = false;
			$follower_id = $follower_id ? $follower_id : 999999999;

			$link_text    = newsy_get_translation( 'Follow', 'newsy', 'follow' );
			$is_following = bp_follow_is_following(
				array(
					'leader_id'   => $user_id,
					'follower_id' => $follower_id,
				)
			);

			if ( $is_following ) {
				$link_text = newsy_get_translation( 'Unfollow', 'newsy', 'unfollow' );
			}

			/**
			 * Show followers counter
			 */
			if ( $counter ) {
				$counts    = bp_follow_total_follow_counts( array( 'user_id' => $user_id ) );
				$link_text = sprintf( $link_text . '<span>%d</span>', $counts['followers'] );
			}

			$follow_button = bp_follow_get_add_follow_button(
				array(
					'leader_id'   => $user_id,
					'follower_id' => $follower_id,
					'link_text'   => $link_text,
					'link_class'  => '',
					'wrapper'     => '',
				)
			);

			if ( empty( $follow_button ) ) {
				$follow_button = '<a href="javascript:void(0);" class="ak_login_required follow btn btn-box rounded">' . $link_text . '</a>';
			}

			echo '<div class="follow-wrapper">' . $follow_button . '<div class="ak-spinner hidden"><i class="fa fa-spinner fa-pulse active"></i></div></div>';
		}
	}

	/**
	 * Author Box - Display Badges.
	 */
	public function add_author_box_post_count( $user_id = null ) {
		$count = count_user_posts( $user_id );

		printf(
			'<div class="ak-counter-item">
            <div class="item-count">%s</div>
            <div class="item-label">%s</div>
        </div>', number_format( floatval( $count ) ), newsy_get_translation( 'Posts', 'newsy', 'posts' )
		);
	}

	/**
	 * Author Box - Display Badges.
	 */
	public function add_author_box_friends_count( $user_id = null ) {
		if ( ! function_exists( 'bp_get_total_friend_count' ) ) {
			return;
		}

		$count = bp_get_total_friend_count( $user_id );

		printf(
			'<div class="ak-counter-item">
            <div class="item-count">%s</div>
            <div class="item-label">%s</div>
        </div>', number_format( floatval( $count ) ), newsy_get_translation( 'Friends', 'newsy', 'friends' )
		);
	}

	/**
	 * Author Box - Display Badges.
	 */
	public function add_author_box_follower_count( $user_id = null ) {

		if ( ! function_exists( 'bp_follow_get_followers' ) ) {
			return;
		}

		$args = array(
			'user_id' => $user_id,
		);

		$count = count( bp_follow_get_followers( $args ) );

		printf(
			'<div class="ak-counter-item">
            <div class="item-count">%s</div>
            <div class="item-label">%s</div>
        </div>', number_format( floatval( $count ) ), newsy_get_translation( 'Followers', 'newsy', 'followers' )
		);

	}

	/**
	 * Check is User Online.
	 */
	public function is_user_online( $user_id = null ) {
		// Get User ID.
		$user_id = ! empty( $user_id ) ? $user_id : bp_displayed_user_id();

		// Get User Last Activity.
		$last_user_activity = bp_get_user_last_activity( $user_id );

		// Check if the last activity is exist.
		if ( ! empty( $last_user_activity ) ) {
			// Calculate some times.
			$current_time  = bp_core_current_time( true, 'timestamp' );
			$last_activity = strtotime( $last_user_activity );
			$still_online  = strtotime( '+5 minutes', $last_activity );

			// Has the user been active recently ?
			if ( $current_time <= $still_online ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Get User Online Icon.
	 */
	public function add_user_online_status_icon( $username = null ) {
		// Get User status visibility.
		$status_visibility = newsy_get_option( 'enable_bp_user_status' );

		if ( 'off' === $status_visibility ) {
			return $username;
		}

		if ( $this->is_user_online() ) {
			$username .= "<span class='user-status user-online'>" . esc_html__( 'online', 'newsy' ) . '</span>';
		} else {
			$username .= "<span class='user-status user-offline'>" . esc_html__( 'offline', 'newsy' ) . '</span>';
		}

		return $username;
	}

	/**
	 * Hook into cover image to attach style handle for profile image.
	 *
	 * @param array $settings Current settings
	 *
	 * @return array
	 */
	public function attach_theme_handle( $settings = array() ) {
		$settings['width']  = 1920;
		$settings['height'] = 300;

		return apply_filters( 'newsy/buddypress/theme_default_settings', $settings );
	}

	/**
	 * Open wrapper for member/home templates.
	 */
	public function before_content() {
		$bbp_wrapper_classes = array( 'ak-container' );

		echo sprintf( '<div class="%s">', implode( ' ', $bbp_wrapper_classes ) );
	}

	/**
	 * Close wrapper for member/home templates.
	 */
	public function after_content() {
		newsy_sanitize_echo( '</div>' );
	}

	/**
	 * Hook into 'add friend' button args to modify required params.
	 *
	 * @param array <string,mixed> $button_args Current arguments
	 *
	 * @return array
	 */
	public function add_button_class( $button_args ) {
		$button_args['link_class'] = $button_args['link_class'] . ' btn rounded';
		$button_args['wrapper']    = 'li';

		return $button_args;
	}

	/**
	 * Hook into 'add friend' button args to modify required params.
	 *
	 * @param array <string,mixed> $button_args Current arguments
	 *
	 * @return array
	 */
	public function add_button_class_box( $button_args ) {
		$button_args['link_class'] = $button_args['link_class'] . ' btn btn-box rounded';

		return $button_args;
	}

	public function member_details() {
		$output  = '<div class="bp-user-details">';
		$output .= apply_filters( 'newsy/buddypress/user-details', '' );
		$output .= '</div>';

		newsy_sanitize_echo( $output );
	}

	/**
	 * render total views and total posts count.
	 */
	public function member_details_total_counts() {
		$user_id = bp_displayed_user_id();

		$total_posts = count_user_posts( $user_id, 'post', true );

		$output = '';

		$show_user_total_data = apply_filters( 'newsy/buddypress/show_user_total_data', user_can( $user_id, 'edit_posts' ) );

		if ( $show_user_total_data ) {
			$output .= sprintf(
				'
					<li>
                        <span class="total-label">%s:</span>
                        <span class="total-count">%s</span>
                    </li>
                    <li>
                        <span class="total-label">%s:</span>
                        <span class="total-count">%s</span>
                    </li>',
				newsy_get_translation( 'Total Reads', 'newsy', 'total_reads' ),
				newsy_get_number_format( floatval( ak_get_user_meta( 'total_posts_view_count', $user_id, 0 ) ) ),
				newsy_get_translation( 'Total Posts', 'newsy', 'total_posts' ),
				newsy_get_number_format( floatval( $total_posts ) )
			);
		}

		$output .= apply_filters( 'newsy/buddypress/user-totals', '' );

		if ( $output ) {
			echo '<div class="bp-user-total-counts"><ul class="bp-user-totals">' . $output . '</ul></div>';
		}
	}

	/**
	 * render total views and total posts count.
	 */
	public function member_details_registered_since() {
		$member = get_userdata( bp_displayed_user_id() );

		printf(
			'<div class="user-registered">%s %s</div>',
			newsy_get_translation( 'joined at', 'newsy', 'joined_at' ),
			apply_filters( 'newsy_user_registered_date', date_i18n( get_option( 'date_format' ), strtotime( $member->user_registered ) ), $member )
		);

	}

	/**
	 * Social Media Icons based on the profile user info.
	 */
	public function member_social_links( $user_id = false ) {
		if ( ! $user_id ) {
			$user_id = bp_displayed_user_id();
		}

		$output = '';
		if ( function_exists( 'newsy_get_author_contact_methods' ) ) {
			foreach ( newsy_get_author_contact_methods() as $social_id => $social_name ) {
				$author_meta = get_the_author_meta( $social_id, $user_id );
				if ( ! empty( $author_meta ) ) {
					//the theme can use the twitter id instead of the full url. This avoids problems with yoast plugin
					if ( 'twitter' == $social_id ) {
						if ( filter_var( $author_meta, FILTER_VALIDATE_URL ) ) {
						} else {
							$author_meta = str_replace( '@', '', $author_meta );
							$author_meta = 'https://twitter.com/' . $author_meta;
						}
					}

					$output .= '<a href="' . $author_meta . '" rel="nofollow" class="' . $social_id . '" title="' . $social_name . '"><i class="fa fa-' . $social_id . '"></i></a>';
				}
			}
		}

		if ( $output ) {
			echo '<div class="bp-user-socials clearfix">' . $output . '</div>';
		}
	}

	/**
	 * User nav links.
	 *
	 * @return array
	 */
	public function user_dropdown_links( $dropdown ) {
		$bp = buddypress();

		foreach ( $bp->members->nav->get_primary( array( 'show_for_displayed_user' => true ) ) as $user_nav_item ) {
			if ( empty( $user_nav_item->show_for_displayed_user ) ) {
				continue;
			}

			$dropdown[ $user_nav_item->css_id ] = array(
				'text' => $user_nav_item->name,
				'url'  => $user_nav_item->link,
			);
		}

		return $dropdown;
	}

	/**
	 * Remove unneded header action buttons
	 */
	public function handle_member_header_actions() {
		if ( function_exists( 'ak_remove_filters' ) ) {
			ak_remove_filters( 'bp_member_header_actions', 'bp_send_public_message_button', 20 );
		}
	}

	/**
	 * the theme does not need buddypress blocks on frontend.
	 * users may deregister buddypress blocks in order to gain some page speed.
	 * by default we don't touch anything. user may activate some buddypress plugins depends on this.
	 */
	public function deregister_blocks() {
		if ( newsy_get_option( 'deregister_buddypress_blocks' ) === 'yes' ) {
			add_filter( 'bp_core_register_blocks', '__return_empty_array' );
			add_filter( 'bp_messages_register_blocks', '__return_empty_array' );
			add_filter( 'bp_activity_register_blocks', '__return_empty_array' );
			add_filter( 'bp_friends_register_blocks', '__return_empty_array' );
			add_filter( 'bp_members_register_blocks', '__return_empty_array' );
			add_filter( 'bp_groups_register_blocks', '__return_empty_array' );
		}
	}

	public function autologin_on_activation( $user_id, $key = null, $user = null ) {
		if ( defined( 'DOING_AJAX' ) || is_admin() ) {
			return;
		}

		$bp = buddypress();

		//simulate Bp activation
		/* Check for an uploaded avatar and move that to the correct user folder, just do what bp does */
		if ( is_multisite() ) {
			$hashed_key = wp_hash( $key );
		} else {
			$hashed_key = wp_hash( $user_id );
		}
		/* Check if the avatar folder exists. If it does, move rename it, move it and delete the signup avatar dir */
		if ( file_exists( BP_AVATAR_UPLOAD_PATH . '/avatars/signups/' . $hashed_key ) ) {
			@rename( BP_AVATAR_UPLOAD_PATH . '/avatars/signups/' . $hashed_key, BP_AVATAR_UPLOAD_PATH . '/avatars/' . $user_id );
		}

		bp_core_add_message( newsy_get_translation( 'You have successfully activated your account!', 'newsy', 'register_activated' ) );

		$bp->activation_complete = true;
		//now login and redirect

		wp_set_auth_cookie( $user_id, true, false );

		bp_core_redirect( bp_core_get_user_domain( $user_id ) );
	}
}
