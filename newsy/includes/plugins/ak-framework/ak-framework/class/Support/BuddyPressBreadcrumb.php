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
 * Extends the Breadcrumb_Trail class for buddyPress.  Only use this if buddyPress is in use.  This should
 * serve as an example for other plugin developers to build custom breadcrumb items.
 *
 * @since  0.6.0
 * @access public
 */
class BuddyPressBreadcrumb extends Breadcrumb {
	/**
	 * Iterates over a multi dimensional array and finds the array item that has a slug name which matches item name
	 *
	 * @param mixed  $collection array of nav items.
	 * @param string $item_name slug name to match against.
	 *
	 * @return array|boolean
	 */
	protected function buddy_find_nav_details( $collection, $item_name ) {

		if ( $collection ) {
			foreach ( $collection as $nav_item ) {
				if ( $nav_item['slug'] == $item_name ) {

					// let us manipulate the link.
					if ( bp_loggedin_user_domain() ) {
						$nav_item['link'] = str_replace( bp_loggedin_user_domain(), bp_displayed_user_domain(), $nav_item['link'] );
					}

					return $nav_item;

				}
			}
		}

		return false;
	}

	/**
	 * Find the subnav array
	 * @param string $component  component name groups etc.
	 * @param string $action which action eg. admin/forums etc.
	 *
	 * @return mixed array of sub nav item details
	 */
	protected function buddy_find_subnav_details( $component, $action ) {
		global $bp;

		$main_nav = $bp->bp_options_nav[ $component ];

		return $this->buddy_find_nav_details( $main_nav, $action );
	}

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

		if ( bp_is_user() ) {
			$this->add_user_trail_items();
		} elseif ( bp_is_group() ) {
			$this->add_group_trails();
		}

		/* Return the bbPress breadcrumb trail items. */
		$this->items = apply_filters( 'ak-framework/breadcrumb/buddypress/items', $this->items, $this->args );
	}

	/**
	 * Add BuddyPress User specific trail item depending on the current page
	 *
	 * @return void
	 */
	public function add_user_trail_items() {
		$bp = buddypress();

		// current action.
		$action           = bp_current_action();
		$component        = bp_current_component();
		$action_variables = bp_action_variables();

		$displayed_user_id = bp_displayed_user_id();

		// add Members Page as Link.
		$this->items[] = '<a href="' . get_permalink( $bp->pages->members->id ) . '">' . get_the_title( $bp->pages->members->id ) . '</a>';

		// if we are here, we are most probably on a component screen of user.
		$this->items[] = bp_core_get_userlink( $displayed_user_id );

		// get details of current main nav(component).
		$nav_details = $this->get_user_component_details( $component );
		if ( empty( $nav_details['name'] ) ) {
			return;
		}

		// let us keep the name of current nav menu as end point.
		$trail_end = strip_tags( $nav_details['name'] );

		// are we doing some action for the component.
		if ( ! empty( $action ) ) {
			// yes, then let us link to the parent component on user.
			$this->items[]  = '<a href="' . $nav_details['link'] . '">' . $nav_details['name'] . '</a>';
			$subnav_details = $this->get_user_action_details( $component, $action );
			// let us keep that sub nav action name as the end point.
			$trail_end = ! empty( $subnav_details['name'] ) ? strip_tags( $subnav_details['name'] ) : null;
		}

		if ( ! empty( $action_variables ) ) {
			// is some action_variable set.
			// if yes, let us append the parent action link to the breadcrumb.
			$this->items[] = '<a href="' . $subnav_details['link'] . '">' . $subnav_details['name'] . '</a>';
			$trail_end     = array_pop( $action_variables );

			foreach ( $action_variables as $action_name ) {
				$this->items[] = ucwords( str_replace( '-', ' ', $action_name ) );
			}

			$trail_end = ucwords( str_replace( '-', ' ', $trail_end ) );
		}

		if ( ! empty( $trail_end ) ) {
			$this->items[] = $trail_end;
		}
	}

	/**
	 * Add group specific trail items
	 *
	 * @return void
	 */
	public function add_group_trails() {
		$bp = buddypress();

		// let us append the group directory page as link.
		$this->items[] = '<a href="' . get_permalink( $bp->pages->groups->id ) . '">' . get_the_title( $bp->pages->groups->id ) . '</a>';

		// get the current group details.
		$group            = groups_get_current_group();
		$action           = bp_current_action();
		$action_variables = bp_action_variables();
		$trail_end        = '';

		// if no action is set, we are on group home page.
		if ( empty( $action ) ) {
			$this->items[] = bp_get_group_name( $group );
		} else {
			// we are on any of group internal page.
			$this->items[]  = '<a href="' . bp_get_group_permalink( $group ) . '">' . bp_get_group_name( $group ) . '</a>';
			$subnav_details = $this->get_group_action_details( $group->slug, $action );

			$trail_end = $subnav_details['name'];

			if ( ! empty( $action_variables ) ) {
				$this->items[] = '<a href="' . $subnav_details['link'] . '">' . $subnav_details['name'] . '</a>';
				$trail_end     = array_pop( $action_variables );

				foreach ( $action_variables as $action_name ) {
					$this->items[] = ucwords( str_replace( '-', ' ', $action_name ) );
				}

				$trail_end = ucwords( str_replace( '-', ' ', $trail_end ) );
			}
		}

		if ( ! empty( $trail_end ) ) {
			$this->items[] = $trail_end;
		}
	}

	/**
	 * Get an array containing the details of current action(sub nav ietm details
	 *
	 * @param string $component component.
	 * @param string $action action.
	 *
	 * @return array (
	 *  'name' => '',
	 *  'link'  => '',
	 *  'slug'  => ''
	 * )
	 */
	public function get_user_action_details( $component, $action ) {

		$items = $this->get_user_subnav_items( $component );
		if ( is_array( $items ) ) {
			foreach ( $items as $item ) {
				if ( $item['slug'] == $action ) {
					return $item;
				}
			}
		}
		return array();
	}

	/**
	 * Get the array containing component nav details
	 *
	 * @param string $component component.
	 *
	 * @return array
	 */
	private function get_user_component_details( $component ) {

		$nav_items = $this->get_user_nav_items();
		if ( is_array( $nav_items ) ) {
			foreach ( $nav_items as $nav_item ) {
				if ( $nav_item['slug'] == $component ) {
					return $nav_item;
				}
			}
		}

		return array();
	}

	/**
	 * Get user nav items.
	 *
	 * @return array
	 */
	private function get_user_nav_items() {

		if ( class_exists( 'BP_Core_Nav' ) ) {
			$nav_items = buddypress()->members->nav->get_primary();
		} else {
			$nav_items = buddypress()->bp_options_nav;
		}

		return $nav_items;
	}

	/**
	 * Get secondary nav.
	 *
	 * @param string $component component.
	 *
	 * @return array
	 */
	private function get_user_subnav_items( $component ) {

		if ( class_exists( 'BP_Core_Nav' ) ) {
			$nav_items = buddypress()->members->nav->get_secondary( array( 'parent_slug' => $component ) );
		} else {
			$nav_items = buddypress()->bp_options_nav;
		}

		return $nav_items;
	}

	/**
	 * Get an array containing current group, current action details
	 *
	 * @param string $group_slug group slug.
	 * @param string $action action.
	 *
	 * @return array
	 */
	public function get_group_action_details( $group_slug, $action ) {

		$nav_items = $this->get_group_nav_items( $group_slug );

		foreach ( $nav_items as $nav_item ) {
			if ( $nav_item['slug'] == $action ) {
				return $nav_item;
			}
		}

		return array();
	}

	/**
	 * Get nav items array for the current group
	 *
	 * @param string $group_slug group slug.
	 *
	 * @return array
	 */
	private function get_group_nav_items( $group_slug = '' ) {

		if ( class_exists( 'BP_Core_Nav' ) ) {
			$nav_items = buddypress()->groups->nav->get_secondary( array( 'parent_slug' => $group_slug ) );
		} else {
			$nav_items = buddypress()->bp_options_nav;
		}

		return $nav_items;
	}
}
