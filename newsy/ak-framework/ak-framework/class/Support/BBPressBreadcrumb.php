<?php
/***
 * The AkFramework
 *
 * AkFramework is framework for themes and plugins for WordPress.
 *
 * Copyright © 2020 akbilisim
 * www.akbilisim.com
 *
 *
 * Envato Profile: https://themeforest.net/user/akbilisim
 */
namespace Ak\Support;

/**
 * Extends the Breadcrumb_Trail class for bbPress.  Only use this if bbPress is in use.  This should
 * serve as an example for other plugin developers to build custom breadcrumb items.
 *
 * @since  0.6.0
 * @access public
 */
class BBPressBreadcrumb extends Breadcrumb {

	/**
	 * Runs through the various WordPress conditional tags to check the current page being viewed.  Once
	 * a condition is met, a specific method is launched to add items to the `$items` array.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	protected function add_items() {
		/* Add the network and site home links. */
		$this->add_network_home_link();
		$this->add_site_home_link();

		/* Get the forum post type object. */
		$post_type_object = get_post_type_object( bbp_get_forum_post_type() );

		/* If not viewing the forum root/archive page and a forum archive exists, add it. */
		if ( ! empty( $post_type_object->has_archive ) && ! bbp_is_forum_archive() ) {
			$this->items[] = '<a href="' . get_post_type_archive_link( bbp_get_forum_post_type() ) . '">' . bbp_get_forum_archive_title() . '</a>';
		}

		/* If viewing the forum root/archive. */
		if ( bbp_is_forum_archive() ) {

			if ( true === $this->args['show_title'] ) {
				$this->items[] = bbp_get_forum_archive_title();
			}
		}

		/* If viewing the topics archive. */
		elseif ( bbp_is_topic_archive() ) {

			if ( true === $this->args['show_title'] ) {
				$this->items[] = bbp_get_topic_archive_title();
			}
		}

		/* If viewing a topic tag archive. */
		elseif ( bbp_is_topic_tag() ) {

			if ( true === $this->args['show_title'] ) {
				$this->items[] = bbp_get_topic_tag_name();
			}
		}

		/* If viewing a topic tag edit page. */
		elseif ( bbp_is_topic_tag_edit() ) {
			$this->items[] = '<a href="' . bbp_get_topic_tag_link() . '">' . bbp_get_topic_tag_name() . '</a>';

			if ( true === $this->args['show_title'] ) {
				$this->items[] = ak_get_translation( 'Edit', 'ak-framework', 'bread_edit' );
			}
		}

		/* If viewing a "view" page. */
		elseif ( bbp_is_single_view() ) {

			if ( true === $this->args['show_title'] ) {
				$this->items[] = bbp_get_view_title();
			}
		}

		/* If viewing a single topic page. */
		elseif ( bbp_is_single_topic() ) {

			/* Get the queried topic. */
			$topic_id = get_queried_object_id();

			/* Get the parent items for the topic, which would be its forum (and possibly forum grandparents). */
			$this->add_post_parents( bbp_get_topic_forum_id( $topic_id ) );

			/* If viewing a split, merge, or edit topic page, show the link back to the topic.  Else, display topic title. */
			if ( bbp_is_topic_split() || bbp_is_topic_merge() || bbp_is_topic_edit() ) {
				$this->items[] = '<a href="' . bbp_get_topic_permalink( $topic_id ) . '">' . bbp_get_topic_title( $topic_id ) . '</a>';

			} elseif ( true === $this->args['show_title'] ) {
				$this->items[] = bbp_get_topic_title( $topic_id );
			}

			/* If viewing a topic split page. */
			if ( bbp_is_topic_split() && true === $this->args['show_title'] ) {
				$this->items[] = ak_get_translation( 'Split', 'ak-framework', 'bread_split' );
			}

			/* If viewing a topic merge page. */
			elseif ( bbp_is_topic_merge() && true === $this->args['show_title'] ) {
				$this->items[] = ak_get_translation( 'Merge', 'ak-framework', 'bread_merge' );
			}

			/* If viewing a topic edit page. */
			elseif ( bbp_is_topic_edit() && true === $this->args['show_title'] ) {
				$this->items[] = ak_get_translation( 'Edit', 'ak-framework', 'bread_edit' );
			}
		}

		/* If viewing a single reply page. */
		elseif ( bbp_is_single_reply() ) {

			/* Get the queried reply object ID. */
			$reply_id = get_queried_object_id();

			/* Get the parent items for the reply, which should be its topic. */
			$this->add_post_parents( bbp_get_reply_topic_id( $reply_id ) );

			/* If viewing a reply edit page, link back to the reply. Else, display the reply title. */
			if ( bbp_is_reply_edit() ) {
				$this->items[] = '<a href="' . bbp_get_reply_url( $reply_id ) . '">' . bbp_get_reply_title( $reply_id ) . '</a>';

				if ( true === $this->args['show_title'] ) {
					$this->items[] = ak_get_translation( 'Edit', 'ak-framework', 'bread_edit' );
				}
			} elseif ( true === $this->args['show_title'] ) {
				$this->items[] = bbp_get_reply_title( $reply_id );
			}
		}

		/* If viewing a single forum. */
		elseif ( bbp_is_single_forum() ) {

			/* Get the queried forum ID and its parent forum ID. */
			$forum_id        = get_queried_object_id();
			$forum_parent_id = bbp_get_forum_parent_id( $forum_id );

			/* If the forum has a parent forum, get its parent(s). */
			if ( 0 !== $forum_parent_id ) {
				$this->add_post_parents( $forum_parent_id );
			}

			/* Add the forum title to the end of the trail. */
			if ( true === $this->args['show_title'] ) {
				$this->items[] = bbp_get_forum_title( $forum_id );
			}
		}

		/* If viewing a user page or user edit page. */
		elseif ( bbp_is_single_user() || bbp_is_single_user_edit() ) {

			if ( bbp_is_single_user_edit() ) {
				$this->items[] = '<a href="' . bbp_get_user_profile_url() . '">' . bbp_get_displayed_user_field( 'display_name' ) . '</a>';

				if ( true === $this->args['show_title'] ) {
					$this->items[] = ak_get_translation( 'Edit', 'ak-framework', 'bread_edit' );
				}
			} elseif ( true === $this->args['show_title'] ) {
				$this->items[] = bbp_get_displayed_user_field( 'display_name' );
			}
		}

		/* Return the bbPress breadcrumb trail items. */
		$this->items = apply_filters( 'ak-framework/breadcrumb/bbpress/items', $this->items, $this->args );
	}
}
