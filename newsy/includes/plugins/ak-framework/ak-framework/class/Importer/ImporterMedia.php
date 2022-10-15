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
 * Class ImporterMedia handle to add new media.
 */
class ImporterMedia extends ImporterAbstract {

	private static $type_id = 'media';

	public static function create( $params ) {
		parent::check_params(
			__CLASS__, __FUNCTION__, $params, array(
				'the_ID' => 'Param is required!',
				'file'   => 'Param is required!',
			)
		);

		$media_url     = $params['file'];
		$file_basename = basename( $media_url );

		try {

			defined( 'ALLOW_UNFILTERED_UPLOADS' ) or define( 'ALLOW_UNFILTERED_UPLOADS', true );
			// some functions need such as media_handle_sideload() exists in this files
			if ( ! function_exists( 'media_handle_sideload' ) ) {
				require_once ABSPATH . 'wp-admin/includes/file.php';
				require_once ABSPATH . 'wp-admin/includes/media.php';
				require_once ABSPATH . 'wp-admin/includes/image.php';
			}

			// download image and save in /tmp folder
			$temp_file = download_url( $media_url );
			if ( is_wp_error( $temp_file ) ) {
				// return true;
				return $temp_file;
			}

			if ( isset( $params['wp_importer_file'] ) ) {
				ob_start();
				if ( isset( $GLOBALS['wp_import'] ) ) {
					$GLOBALS['wp_import']->import( $media_url );
				}
				$x = ob_get_clean();
				return true;
			}

			if ( isset( $params['rev_slider_file'] ) && $params['rev_slider_file'] ) {
				if ( class_exists( 'RevSliderSlider' ) ) {
					$slider   = new \RevSliderSlider();
					$response = $slider->importSliderFromPost( true, true, $temp_file );

					if ( is_array( $response ) && $response['success'] ) {
						return array(
							'rev_slider' => true,
							'sliderID'   => $response['sliderID'],
						);
					}
				}

				return true;
			}

			$args = wp_parse_args(
				$params, array(
					'post_id'     => null,
					'description' => null,
					'file_name'   => $file_basename,
				)
			);

			// prepare a variable similar to $_FILES to pass media_handle_sideload() function
			$file_data = array(
				'name'     => $args['file_name'],
				'tmp_name' => $temp_file,
			);

			// disable generate thumbnails by empty list of image sizes
			if ( isset( $args['resize'] ) && ! $args['resize'] ) {
				add_filter( 'intermediate_image_sizes', '__return_empty_array', 9999 );
			}

			$maybe_attachment_id = media_handle_sideload( $file_data, $args['post_id'], $args['description'] );

			if ( is_wp_error( $maybe_attachment_id ) ) {
				return $maybe_attachment_id;
			}

			if ( isset( $args['resize'] ) && ! $args['resize'] ) {
				remove_filter( 'intermediate_image_sizes', '__return_empty_array', 9999 );
			}

			//code...
		} catch ( \Throwable $th ) {
			$maybe_attachment_id = 0;
		}
		$attachment_id = &$maybe_attachment_id;

		do_action( 'ak_framework_demo_import_after_media_create', $attachment_id, $args );

		return $attachment_id;
	}

	public static function remove( $media ) {
		if ( is_array( $media ) ) {
			if ( isset( $media['rev_slider'] ) && class_exists( 'RevSliderSlider' ) ) {
				$slider  = new \RevSliderSlider();
				$_slider = $slider->init_by_id( intval( $media['sliderID'] ) );

				if ( ! is_wp_error( $_slider ) ) {
					$slider->delete_slider();
				}
			}

			return true;
		}

		return (bool) wp_delete_attachment( intval( $media ), true );
	}
}
