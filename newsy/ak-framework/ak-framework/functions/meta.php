<?php

if ( ! function_exists( 'ak_meta_key' ) ) {
	/**
	 * Used to add ak_ prefix to meta field key.
	 *
	 * @param string $meta_key
	 * @param bool $wp_field
	 *
	 * @return string
	 */
	function ak_meta_key( $key, $wp_field ) {
		if ( ! $wp_field ) {
			return 'ak_' . $key;
		}
		return $key;
	}

	add_filter( 'ak-framework/meta/key', 'ak_meta_key', 10, 2 );
}

if ( ! function_exists( 'ak_get_post_meta' ) ) {
	/**
	 * Used to get post meta field value.
	 *
	 * @param string $meta_key
	 * @param integer $post_id
	 * @param bool $force_default
	 * @param bool $wp_field
	 * @param bool $single
	 *
	 * @return mixed
	 */
	function ak_get_post_meta( $meta_key = null, $post_id = null, $force_default = null, $wp_field = false, $single = true ) {
		if ( is_null( $post_id ) ) {
			global $post;
			$post_id = isset( $post->ID ) ? $post->ID : 0;
		}
		$field_prefix = apply_filters( 'ak-framework/meta/key', $meta_key, $wp_field );

		$meta = get_post_meta( $post_id, $field_prefix, $single );

		// If Meta check for default value
		if ( '' === $meta && ! is_null( $force_default ) ) {
			return $force_default;
		}

		if ( '' !== $meta ) {
			return $meta;
		}

		return '';
	}
}

if ( ! function_exists( 'ak_echo_post_meta' ) ) {
	/**
	 * Used to echo post meta field value.
	 *
	 * @param string $meta_key
	 * @param integer $post_id
	 * @param bool $force_default
	 * @param bool $wp_field
	 * @param bool $single
	 *
	 * @return string
	 */
	function ak_echo_post_meta( $meta_key, $post_id = null, $force_default = null, $wp_field = false, $single = true ) {
		echo ak_get_post_meta( $meta_key, $post_id, $force_default, $wp_field, $single ); // escaped before
	}
}

if ( ! function_exists( 'ak_update_post_meta' ) ) {
	/**
	 * Used to update post meta field value.
	 *
	 * @param string $meta_key
	 * @param integer $post_id
	 * @param mixed $meta_value
	 * @param bool $wp_field
	 *
	 * @return void
	 */
	function ak_update_post_meta( $meta_key, $post_id, $meta_value, $wp_field = false ) {
		$field_prefix = apply_filters( 'ak-framework/meta/key', $meta_key, $wp_field );
		update_post_meta( $post_id, $field_prefix, $meta_value ); // escaped before
	}
}

if ( ! function_exists( 'ak_delete_post_meta' ) ) {
	/**
	 * Used to delete post meta field value.
	 *
	 * @param string $meta_key
	 * @param integer $post_id
	 * @param bool $wp_field
	 *
	 * @return void
	 */
	function ak_delete_post_meta( $meta_key, $post_id, $wp_field = false ) {
		$field_prefix = apply_filters( 'ak-framework/meta/key', $meta_key, $wp_field );
		delete_post_meta( $post_id, $field_prefix ); // escaped before
	}
}

if ( ! function_exists( 'ak_get_term_meta' ) ) {
	/**
	 * Used to get taxonomy meta field value.
	 *
	 * @param string $meta_key
	 * @param mixed $term_id
	 * @param bool $force_default
	 * @param bool $wp_field
	 * @param bool $single
	 *
	 * @return mixed
	 */
	function ak_get_term_meta( $meta_key, $term_id = null, $force_default = null, $wp_field = false, $single = true ) {
		if ( is_null( $term_id ) ) {
			// If its category or tag archive get that term ID
			if ( is_category() || is_tag() || is_tax() ) {
				$queried_object = get_queried_object();
				$term_id        = isset( $queried_object->term_id ) ? $queried_object->term_id : 0;
			} else {
				return $force_default;
			}
		}

		// Extract ID from term object if passed
		if ( is_object( $term_id ) ) {
			if ( isset( $term_id->term_id ) ) {
				$term_id = $term_id->term_id;
			} else {
				return $force_default;
			}
		}

		if ( $term_id ) {
			$field_prefix = apply_filters( 'ak-framework/meta/key', $meta_key, $wp_field );
			$meta_value   = get_term_meta( $term_id, $field_prefix, $single );

			if ( is_null( $meta_value ) || '' === $meta_value ) {
				if ( ! is_null( $force_default ) ) {
					$meta_value = $force_default;
				}
			}
		} else {
			$meta_value = $force_default;
		}

		return $meta_value;
	}
}


if ( ! function_exists( 'ak_echo_term_meta' ) ) {
	/**
	 * Used to echo taxonomy meta field value.
	 *
	 * @param string $meta_key
	 * @param mixed $term_id
	 * @param bool $force_default
	 * @param bool $wp_field
	 * @param bool $single
	 *
	 * @return mixed
	 */
	function ak_echo_term_meta( $meta_key, $term_id = null, $force_default = null, $wp_field = false, $single = true ) {
		echo ak_get_term_meta( $meta_key, $term_id, $force_default, $wp_field, $single ); // escaped before
	}
}

if ( ! function_exists( 'ak_update_term_meta' ) ) {
	/**
	 * Used to update taxonomy meta field value.
	 *
	 * @param string $meta_key
	 * @param mixed $term_id
	 * @param mixed $meta_value
	 * @param bool $wp_field
	 *
	 * @return void
	 */
	function ak_update_term_meta( $meta_key, $term_id, $meta_value, $wp_field = false ) {
		$field_prefix = apply_filters( 'ak-framework/meta/key', $meta_key, $wp_field );
		update_term_meta( $term_id, $field_prefix, $meta_value ); // escaped before
	}
}

if ( ! function_exists( 'ak_delete_term_meta' ) ) {
	/**
	 * Delete taxonomy option.
	 *
	 * @param string $meta_key
	 * @param mixed $term_id
	 * @param bool $wp_field
	 *
	 * @return void
	 */
	function ak_delete_term_meta( $meta_key, $term_id, $wp_field = false ) {
		$field_prefix = apply_filters( 'ak-framework/meta/key', $meta_key, $wp_field );
		delete_term_meta( $term_id, $field_prefix ); // escaped before
	}
}

if ( ! function_exists( 'ak_get_user_meta' ) ) {
	/**
	 * Used for finding user meta field value.
	 *
	 * @param string         $field_key     User field ID
	 * @param string|WP_User $user          User ID or object
	 * @param null|string    $force_default Default value (Optional)
	 * @param bool           $wp_field
	 * @param bool           $single
	 *
	 * @return mixed
	 */
	function ak_get_user_meta( $field_key, $user = null, $force_default = null, $wp_field = false, $single = true ) {
		if ( is_null( $user ) ) {
			// Get current post author id
			if ( is_singular() ) {
				$user = get_the_author_meta( 'ID' );
			} elseif ( is_author() ) { // Get current archive user
				global $author;

				$user = $author;
			} else { // Return default value
				return $force_default;
			}
		}

		// Get user id from object
		if ( is_object( $user ) ) {
			$user = $user->ID;
		}

		$field_prefix = $wp_field ? '' : 'ak_';

		// get value if saved in DB
		$value = get_user_meta( $user, $field_prefix . $field_key, $single );

		if ( false !== $value ) {
			return $value;
		} elseif ( ! is_null( $force_default ) ) { // Or return force default value
			return $force_default;
		}

		return false;
	}
}

if ( ! function_exists( 'ak_echo_user_meta' ) ) {
	/**
	 * Used to echo user meta field value.
	 *
	 * @param string         $field_key     User field ID
	 * @param string|WP_User $user          User ID or object
	 * @param null           $force_default Default value (Optional)
	 *
	 * @return mixed
	 */
	function ak_echo_user_meta( $field_key, $user = null, $force_default = null, $wp_field = false, $single = true ) {
		echo ak_get_user_meta( $field_key, $user, $force_default, $wp_field, $single );
	}
}

if ( ! function_exists( 'ak_update_user_meta' ) ) {
	/**
	 * Used to echo user meta field value.
	 *
	 * @param string         $meta_key     User field ID
	 * @param string|WP_User $user          User ID or object
	 * @param mixed          $meta_value
	 * @param bool           $wp_field
	 *
	 * @return mixed
	 */
	function ak_update_user_meta( $meta_key, $user_id, $meta_value, $wp_field = false ) {
		$field_prefix = $wp_field ? '' : 'ak_';
		update_user_meta( $user_id, $field_prefix . $meta_key, $meta_value ); // escaped before
	}
}

if ( ! function_exists( 'ak_delete_user_meta' ) ) {
	/**
	 * Used to echo user meta field value.
	 *
	 * @param string        $meta_key     User field ID
	 * @param mixed         $user_id      User ID
	 * @param bool          $wp_field
	 *
	 * @return mixed
	 */
	function ak_delete_user_meta( $meta_key, $user_id, $wp_field = false ) {
		$field_prefix = $wp_field ? '' : 'ak_';
		delete_user_meta( $user_id, $field_prefix . $meta_key ); // escaped before
	}
}
