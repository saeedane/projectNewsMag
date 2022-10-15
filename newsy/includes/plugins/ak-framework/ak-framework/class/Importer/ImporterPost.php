<?php
/***
 * The Ak Framework
 *
 * Ak Framework is framework for WordPress themes and plugins.
 *
 * Copyright © 2020 akbilisim
 * www.akbilisim.com
 *
 * Envato Profile: https://themeforest.net/user/akbilisim
 */
namespace Ak\Importer;

/**
 * Class ImporterPost handle to add new post.
 */
class ImporterPost extends ImporterAbstract {

	private static $type_id = 'post';

	public static function create( $params, $date_index = 1 ) {
		parent::check_params(
			__CLASS__, __FUNCTION__, $params, array(
				'the_ID' => 'Param is requiered!',
			)
		);

		$post_params = ak_merge_args(
			$params, array(
				'post_title'        => '',
				'post_type'         => 'post',
				'post_status'       => 'publish',
				'post_format'       => '',
				'post_content_file' => '',
				'post_excerpt_file' => '',
				'post_content'      => '',
				'post_excerpt'      => '',
				'post_parent'       => '',
				'post_author'       => 'random',
				'post_terms'        => '',
				'thumbnail_id'      => '',
			)
		);

		try {
			//validate post terms
			$post_terms = array();
			if ( $post_params['post_terms'] && is_array( $post_params['post_terms'] ) ) {
				foreach ( (array) $post_params['post_terms'] as $taxonomy => $terms ) {
					if ( taxonomy_exists( $taxonomy ) ) {
						$terms = parent::_filter_required_id( 'taxonomy', $terms );

						$post_terms[ $taxonomy ] = array_map( 'intval', explode( ',', $terms ) );
					}
				}
			}

			if ( ! empty( $post_params['post_title'] ) ) {
				$post_params['post_title'] = wp_kses(
					$post_params['post_title'], array(
						'em'     => array(),
						'strong' => array(),
					)
				);
			}

			if ( ! empty( $post_params['post_content'] ) ) {
				$post_params['post_content'] = parent::_filter_required_id( 'global', $post_params['post_content'] );
			}

			if ( ! empty( $post_params['post_content_file'] ) ) {
				$post_content                = ak_get_local_file_content( $post_params['post_content_file'] );
				$post_params['post_content'] = parent::_filter_required_id( 'global', $post_content );
				unset( $post_params['post_content_file'] );
			}

			// read excerpt from file
			if ( ! empty( $post_params['post_excerpt_file'] ) ) {
				$post_excerpt                = ak_get_local_file_content( $post_params['post_excerpt_file'] );
				$post_params['post_excerpt'] = parent::_filter_required_id( 'global', $post_excerpt );
				unset( $post_params['post_excerpt_file'] );
			}

			// read excerpt from file
			if ( ! empty( $post_params['post_parent'] ) ) {
				$post_params['post_parent'] = parent::_filter_required_id( 'global', $post_params['post_parent'] );
			}

			// read excerpt from file
			if ( 'random' === $post_params['post_author'] ) {
				$post_params['post_author'] = self::get_random_user_id();
			}

			if ( ! empty( $post_params['post_date'] ) ) {
				$post_params['post_date'] = gmdate( 'Y-m-d H:i:s', strtotime( $post_params['post_date'] ) );
			} else {
				$date_index = self::get_date_index();
				$now        = strtotime( '-1 months' );
				$interval   = (int) $date_index * DAY_IN_SECONDS;
				$post_date  = gmdate( 'Y-m-d H:i:s', ( $now - $interval ) );

				$post_params['post_date']     = $post_date;
				$post_params['post_date_gmt'] = $post_date;
			}

			$post_id = wp_insert_post( $post_params );

			if ( is_wp_error( $post_id ) ) {
				return $post_id;
			}

			if ( ! empty( $post_terms ) ) {
				foreach ( $post_terms as $taxonomy => $terms_id ) {
					wp_set_post_terms( $post_id, $terms_id, $taxonomy );
				}
			}

			if ( ! empty( $post_params['thumbnail_id'] ) ) {
				$thumbnail_id = parent::_filter_required_id( 'media', $post_params['thumbnail_id'] );
				set_post_thumbnail( $post_id, $thumbnail_id );
			}

			if ( ! empty( $post_params['post_format'] ) ) {
				set_post_format( $post_id, $post_params['post_format'] );
			}

			// Regenerates VC styles again because VC can not generate!
			if ( isset( $post_params['prepare_vc_css'] ) && $post_params['prepare_vc_css'] && ! empty( $post_params['post_content'] ) ) {
				// match all shortcodes
				preg_match_all( '/ css=\"([^\"]*)\"/', $post_params['post_content'], $shortcodes );

				$final_css = '';

				foreach ( $shortcodes[1] as $css ) {
					$final_css .= $css;
				}

				update_post_meta( $post_id, '_wpb_shortcodes_custom_css', $final_css );
			}

			// add post meta tags
			if ( isset( $post_params['post_meta'] ) && is_array( $post_params['post_meta'] ) ) {
				foreach ( (array) $post_params['post_meta'] as $post_meta ) {
					if ( isset( $post_meta['key'] ) ) {

						$meta_prefix = 'ak_';
						if ( isset( $post_meta['wp_meta'] ) && $post_meta['wp_meta'] ) {
							$meta_prefix = '';
						}
						if ( isset( $post_meta['value_file'] ) ) {
							$file_value = ak_get_local_file_content( $post_meta['value_file'] );
							$file_value = parent::_filter_required_id( 'global', $file_value );

							// decode json value
							if ( isset( $post_meta['json_decode'] ) ) {
								$file_value = ak_is_json( $file_value, true );
							}

							update_post_meta( $post_id, $meta_prefix . $post_meta['key'], $file_value );
						} elseif ( isset( $post_meta['value'] ) ) {
							$post_meta_value = parent::_filter_required_id( 'global', $post_meta['value'] );

							update_post_meta( $post_id, $meta_prefix . $post_meta['key'], $post_meta_value );
						}
					}
				}
			}

			do_action( 'ak-framework/demo/import/post/after', $post_id );

			return $post_id;
		} catch ( \Exception $e ) {
			return new \WP_Error( 'DemoImporterPosts:', $e->getMessage() );
		}
	}

	public static function remove( $post_id ) {
		return (bool) wp_delete_post( intval( $post_id ), true );
	}

	public static function get_random_user_id() {

		$users     = get_users(
			array(
				'number' => 50,
			)
		);
		$user_info = get_userdata( $users[ array_rand( $users ) ]->ID );
		return $user_info->ID;
	}

	public static function get_date_index() {
		$data_ids = ImporterManager::get_instance()->get_current_import_data();

		// get saved post counts
		return isset( $data_ids[ self::$type_id ] ) ? count( $data_ids[ self::$type_id ] ) : 1;
	}
}
