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
 * Class Ak Framework Importer.
 *
 * @package  ak-framework
 */
abstract class ImporterAbstract {

	/**
	 * Pattern of custom functions in strings that supports params.
	 *
	 * note: this should follow $id_pattern and should change it's inner value
	 *
	 * @var string
	 */
	public static $media_pattern = '/%media%(.*?)%media%/';

	/**
	 * Pattern of custom functions in strings that supports params.
	 *
	 * note: this should follow $id_pattern and should change it's inner value
	 *
	 * @var string
	 */
	public static $attachment_url_pattern = '/%attachment_url%(.*?)%attachment_url%/';

	/**
	 * Get importer saved ids
	 *
	 * @return mixed
	 */
	protected static function get_required_id( $type, $_the_id ) {
		$data_ids = ImporterManager::get_instance()->get_current_import_data();

		if ( 'global' === $type ) {
			foreach ( $data_ids as $types ) {
				foreach ( $types as $the_id => $id ) {
					if ( $_the_id == $the_id ) {
						return $id;
					}
				}
			}
		}

		if ( isset( $data_ids[ $type ][ $_the_id ] ) ) {
			return $data_ids[ $type ][ $_the_id ];
		}

		return false;
	}

	/**
	 *
	 */
	protected static function _filter_required_id( $type, $value ) {
		if ( is_array( $value ) ) {
			// search all array
			foreach ( $value as $id => $_val ) {
				$value[ $id ] = self::_filter_required_id( $type, $_val );
			}
		} else {
			$value = self::_filter_string( $type, $value );
		}

		return $value;
	}

	/**
	 *
	 */
	protected static function _filter_string( $type, $string ) {
		preg_match_all( '/%%(.*?)%%/', $string, $matched );
		if ( isset( $matched ) && ! empty( $matched[1] ) ) {
			foreach ( $matched[1] as $the_id ) {
				$filtered_id = self::get_required_id( $type, $the_id );

				if ( false !== $filtered_id ) {
					$string = str_replace( '%%' . $the_id . '%%', $filtered_id, $string );
				} else {
					$string = str_replace( '%%' . $the_id . '%%', '', $string );
				}
			}
		}

		preg_match_all( self::$attachment_url_pattern, $string, $matched2 );
		if ( isset( $matched2 ) && ! empty( $matched2[1] ) ) {
			foreach ( $matched2[1] as $the_id ) {
				$media_id = self::get_required_id( $type, $the_id );
				if ( $media_id ) {
					$media_id = wp_get_attachment_url( $media_id );
					// @todo check why we need this?
					// we need to use wp_get_attachment_image_src
					$string = str_replace( '%attachment_url%' . $the_id . '%attachment_url%', ak_sanitize_protocol( $media_id ), $string );
				} else {
					$string = str_replace( '%attachment_url%' . $the_id . '%attachment_url%', '', $string );
				}
			}
		}

		// get from database
		preg_match_all( '/\{{(.*?)\}}/', $string, $matched3 );
		if ( isset( $matched3 ) && ! empty( $matched3[1] ) ) {
			foreach ( $matched3[1] as $content ) {
				$string = self::convert_tag( trim( $content, '{}' ) );
			}
		}

		return $string;
	}


	/**
	 * If one of the $requiered_keys is missing from the $received_array we will kill the execution.
	 *
	 * @param $class - the calling __CLASS__
	 * @param $function - the calling __FUNCTION__
	 * @param $received_array - the array of parameter_key => 'value' received from the caller
	 * @param $requiered_keys - the expected array of parameter_key => 'error_string'
	 */
	protected static function check_params( $class, $function, $received_array, $requiered_keys ) {
		foreach ( $requiered_keys as $requiered_key => $requiered_msg ) {
			if ( empty( $received_array[ $requiered_key ] ) ) {
				return self::kill( $class, $function, $requiered_key . ' - ' . $requiered_msg, $received_array );
			}
		}
	}

	/**
	 * kill the execution and show an error message.
	 *
	 * @param $class
	 * @param $function
	 * @param $msg
	 * @param string $additional_info
	 */
	protected static function kill( $class, $function, $msg, $additional_info = '' ) {
		$err = PHP_EOL . 'ERROR - ' . $class . '::' . $function . ' - ' . $msg;

		if ( ! empty( $additional_info ) ) {
			if ( is_array( $additional_info ) ) {
				$err .= PHP_EOL . 'More info:' . PHP_EOL;
				foreach ( $additional_info as $key => $value ) {
					$err .= $key . ' - ' . $value . PHP_EOL;
				}
			}
		}

		return new \WP_Error( $msg, $err );
	}

	/**
	 * @param $string
	 *
	 * @return null|string
	 *
	 * convert every string with tag to corespondent tag
	 */
	public static function convert_tag( $string ) {
		$tag = explode( ':', $string );

		if ( sizeof( $tag ) > 1 ) {
			switch ( $tag[0] ) {
				case 'image':
					$result = self::image_tag( $tag );
					break;
				case 'category':
					$result = self::category_tag( $tag );
					break;
				case 'taxonomy':
					$result = self::taxonomy_tag( $tag );
					break;
				case 'post':
					$result = self::post_tag( $tag );
					break;
				default:
					$result = $string;
					break;
			}
		} else {
			$result = $string;
		}

		return apply_filters( 'ak-framework/importer/convert-tag', $result, $tag );
	}

	/**
	 * Get tag id by slug.
	 *
	 * @param $tag
	 * @param $slug
	 *
	 * @return null|int
	 */
	public static function get_tag_id_by_slug( $tag, $slug ) {
		$result = null;
		switch ( $tag ) {
			case 'image':
				$args    = array(
					'post_type'      => 'attachment',
					'name'           => sanitize_title( $slug ),
					'posts_per_page' => 1,
					'post_status'    => 'inherit',
				);
				$_header = get_posts( $args );
				$image   = $_header ? array_pop( $_header ) : null;
				if ( $image ) {
					$result = $image->ID;
				}
				break;
			case 'category':
			case 'taxonomy':
				$term = get_term_by( 'slug', $slug, $tag );
				if ( $term ) {
					$result = $term->term_id;
				}
				break;
			case 'post':
			case 'page':
				$post = get_page_by_path( $slug, \OBJECT, $tag );
				if ( $post ) {
					$result = $post->ID;
				}
				break;
			default:
				$result = null;
				break;
		}

		return apply_filters( 'ak-framework/importer/get-tag-data', $result, $tag, $slug );
	}

	/**
	 * @param $tag
	 *
	 * @return null
	 *
	 * convert image tag
	 * ex:
	 *  1. get ID of image : image:news01:id
	 *  2. get URL of image by size : image:news01:url:thumbnail
	 *  3. Retrieve the URL for an attachment : image:attach:src
	 */
	public static function image_tag( $tag ) {
		$media_id = self::get_tag_id_by_slug( 'media', $tag[1] );
		if ( ! empty( $media_id ) ) {
			$to = $tag[2];

			if ( 'id' === $to ) {
				return $media_id;
			} elseif ( 'url' === $to ) {
				$result = wp_get_attachment_image_src( $media_id, $tag[3] );

				return isset( $result[0] ) ? ak_sanitize_protocol( $result[0] ) : null;
			} else {
				$result = wp_get_attachment_url( $media_id );

				return $result ? ak_sanitize_protocol( $result ) : null;
			}
		}
		return null;
	}

	/**
	 * @param $tag
	 *
	 * @return null|string
	 *
	 * convert category tag
	 * ex:
	 *  1. get ID of category : category:slug:id
	 *  2. get URL of category : category:slug:url
	 */
	public static function category_tag( $tag ) {
		$category_id = self::get_tag_id_by_slug( 'category', $tag[1] );
		if ( ! empty( $category_id ) ) {
			$to = $tag[2];

			if ( 'id' === $to ) {
				return $category_id;
			} elseif ( 'url' === $to ) {
				return get_category_link( $category_id );
			}
		}

		return null;
	}

	/**
	 * @param $tag
	 *
	 * @return null|string
	 *
	 * convert taxonomy tag
	 * ex:
	 *  1. get ID of taxonomy : taxonomy:post_tag:slug:id
	 *  2. get URL of taxonomy : taxonomy:post_tag:slug:url
	 */
	public static function taxonomy_tag( $tag ) {
		$taxonomy    = $tag[1];
		$taxonomy_id = self::get_tag_id_by_slug( 'taxonomy', $tag[2] );

		if ( ! empty( $taxonomy_id ) ) {
			$to = $tag[3];

			if ( 'id' === $to ) {
				return $taxonomy_id;
			} elseif ( 'url' === $to ) {
				return get_term_link( $taxonomy_id, $taxonomy );
			}
		}

		return null;
	}

	/**
	 * @param $tag
	 *
	 * @return null|string
	 *
	 * convert post tag
	 * ex:
	 *  1. get ID of post : post:slug:id
	 *  2. get URL of post : post:slug:url
	 */
	public static function post_tag( $tag ) {
		$post_id = self::get_tag_id_by_slug( 'post', $tag[1] );

		if ( ! empty( $post_id ) ) {
			$to = $tag[2];

			if ( 'id' === $to ) {
				return $post_id;
			} elseif ( 'url' === $to ) {
				return get_permalink( $post_id );
			}
		}

		return null;
	}
}
