<?php

if ( ! function_exists( 'ak_get_current_page_type' ) ) {
	/**
	 * Used for finding current page type.
	 *
	 * @return string
	 */
	function ak_get_current_page_type() {
		global $pagenow;

		switch ( $pagenow ) {
			case 'post-new.php':
			case 'post.php':
				$type = 'post';
				break;

			case 'term.php':
			case 'edit-tags.php':
				$type = 'taxonomy';
				break;

			case 'widgets.php':
				$type = 'widgets';
				break;

			case 'customize.php':
				$type = 'customizer';
				break;

			case 'nav-menus.php':
				$type = 'menus';
				break;

			case 'profile.php':
			case 'user-new.php':
			case 'user-edit.php':
				$type = 'users';
				break;

			case 'index.php':
				$type = 'dashboard';
				break;

			case 'admin.php':
				$type = 'panel';
				break;

			default:
				$type = false;
		}

		return $type;
	}
}

if ( ! function_exists( 'ak_scheduled_check_updates' ) ) {
	function ak_scheduled_check_updates() {
		Ak\Product\ProductUpdater::get_instance()->scheduled_check_updates();
	}
}
add_action( 'ak-framework/product/check-updates', 'ak_scheduled_check_updates' );


if ( ! function_exists( 'ak_remove_reject_unsafe_urls' ) ) {
	function ak_remove_reject_unsafe_urls( $args ) {
		$args['reject_unsafe_urls'] = false;

		return $args;
	}
}

if ( ! function_exists( 'ak_get_translation_fields' ) ) {
	function ak_get_translation_fields() {
		return Ak\Translation\TranslationManager::get_instance()->get_fields();
	}
}

if ( ! function_exists( 'ak_resolve_form_fields' ) ) {
	/**
	 * This function is used to resolve form fields.
	 *
	 * @param array $args   Field arguments.
	 *
	 * @return array
	 */
	function ak_resolve_form_fields( $args ) {
		$fields = array();

		if ( ! empty( $args['fields_callback'] ) ) {
			$fields = ak_fields_callback( $args['fields_callback'] );
		} elseif ( ! empty( $args['fields'] ) ) {
			$fields = $args['fields'];
		} elseif ( ! empty( $args['file'] ) && file_exists( $args['file'] ) ) {
			include $args['file'];
		}

		return $fields;
	}
}

if ( ! function_exists( 'ak_fields_callback' ) ) {
	function ak_safe_stripslashes( $function ) {
		return str_replace( '\\\\', '\\', $function );
	}

	/**
	 * This function is used to resolve form field callbacks.
	 *
	 * @param array $args   Callback arguments.
	 *
	 * @return array
	 */
	function ak_fields_callback( $callback ) {
		$fields = array();

		if ( is_string( $callback ) && is_callable( $callback ) ) {
			$fields = call_user_func( $callback );
		} else {
			$function = isset( $callback['function'] ) ? ak_safe_stripslashes( $callback['function'] ) : null;
			$args     = isset( $callback['args'] ) ? $callback['args'] : array();

			if ( ! empty( $function ) && ! empty( $args ) && is_callable( $function ) ) {
				if ( isset( $callback['call_array'] ) || is_array( $args ) && count( $args ) > 0 ) {
					$fields = call_user_func_array( $function, $args );
				} else {
					$fields = call_user_func( $function, $args );
				}
			}
		}

		return $fields;
	}
}

/**
 * Register a new notice.
 *
 * @since 1.0
 *
 * @param string $id      Notice ID, used to identify it
 * @param string $type    Type of notice to display
 * @param string $content Notice content
 * @param string $title   Notice title
 * @param array  $args    Additional parameters
 *
 * @return bool
 */
function ak_register_notice( $id, $type, $content, $title = '', $args = array() ) {
	return Ak\Support\AdminNotices::get_instance()->register_notice( $id, $type, $content, $title, $args );
}

/**
 * Restore a previously dismissed notice.
 *
 * @since 1.0
 *
 * @param string $id ID of the notice to restore
 *
 * @return bool
 */
function ak_restore_notice( $id ) {
	return Ak\Support\AdminNotices::get_instance()->restore_notice( $id );
}

/**
 * Check if a notice has been dismissed.
 *
 * @since 1.0
 *
 * @param string $id ID of the notice to check
 *
 * @return bool
 */
function ak_is_dismissed_notice( $id ) {
	return Ak\Support\AdminNotices::get_instance()->is_dismissed( $id );
}
