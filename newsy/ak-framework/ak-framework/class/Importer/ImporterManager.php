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
 * Class ImporterManager.
 */
class ImporterManager {

	/**
	 * Import Id.
	 *
	 * @var string
	 */
	public $id;

	/**
	 * Import group.
	 *
	 * @var string
	 */
	public $group;

	/**
	 * Allowed import data types.
	 *
	 * @return string
	 */
	public $data_key = 'ak_demo_importer_data';

	/**
	 * Allowed import data types.
	 *
	 * @return array
	 */
	public $import_types = array(
		'plugin',
		'media',
		'taxonomy',
		'post',
		'menu',
		'widget',
		'option',
	);

	/**
	 * @var ImporterManager
	 */
	private static $instance;

	/**
	 * @return ImporterManager
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Set import group.
	 */
	public function set_import_group( $group ) {
		$this->group = $group;
	}

	/**
	 * Set import id.
	 */
	public function set_import_id( $id ) {
		$this->id = $id;
	}

	/**
	 * Get group data.
	 *
	 * @return array
	 */
	public function get_group_data( $group = '' ) {
		if ( empty( $group ) ) {
			$group = $this->group;
		}

		return get_option( sprintf( 'ak_import_data_%s', $group ), array() );
	}

	/**
	 * Set group data.
	 */
	public function set_group_data( $data, $group = '' ) {
		if ( empty( $group ) ) {
			$group = $this->group;
		}

		return update_option( sprintf( 'ak_import_data_%s', $group ), $data, 'no' );
	}

	/**
	 * Get import data.
	 */
	public function get_import_data( $id ) {
		$group_data = $this->get_group_data();

		if ( ! empty( $group_data ) && isset( $group_data[ $id ] ) && is_array( $group_data[ $id ] ) ) {
			return $group_data[ $id ];
		}

		return array();
	}

	/**
	 * Delete import data.
	 */
	public function delete_import_data( $id ) {
		$group_data = $this->get_group_data();

		if ( ! empty( $group_data ) && isset( $group_data[ $id ] ) && is_array( $group_data[ $id ] ) ) {
			unset( $group_data[ $id ] );

			$this->set_group_data( $group_data );
		}
	}

	/**
	 *
	 */
	public function get_current_import_data() {
		return $this->get_import_data( $this->id );
	}

	/**
	 *
	 */
	public function delete_current_import_data() {
		$this->delete_import_data( $this->id );
	}

	/**
	 *  Set data.
	 */
	public function set_data( $type, $the_id, $new_term_id ) {

		$group_data = $this->get_group_data();

		if ( ! isset( $group_data[ $this->id ] ) ) {
			$group_data[ $this->id ] = array();
		}

		if ( ! isset( $group_data[ $this->id ][ $type ] ) ) {
			$group_data[ $this->id ][ $type ] = array();
		}

		$group_data[ $this->id ][ $type ][ $the_id ] = $new_term_id;

		$this->set_group_data( $group_data );
	}

	/**
	 * Delete given data.
	 */
	public function delete_data( $type, $the_id ) {
		$group_data = $this->get_group_data();

		if ( ! empty( $group_data ) && isset( $group_data[ $this->id ][ $type ][ $the_id ] ) ) {
			unset( $group_data[ $this->id ][ $type ][ $the_id ] );

			$this->set_group_data( $group_data );
		}
	}


	public function set_without_content_data( $import_data ) {
		// force import types
		$allowed_types = array( 'plugin', 'option', 'widget' );

		foreach ( $import_data as $import_type => $imports ) {
			// skip if allowed import type
			if ( in_array( $import_type, $allowed_types, true ) ) {
				continue;
			}

			foreach ( $imports as $import_key => $import_data_item ) {
				if ( ! isset( $import_data_item['force_import'] ) ) {
					unset( $import_data[ $import_type ][ $import_key ] );
					continue;
				}
			}

			// remove type if no items
			if ( empty( $import_data[ $import_type ] ) ) {
				$key = array_search( $import_type, $this->import_types, true );
				if ( false !== $key ) {
					unset( $this->import_types[ $key ] );
				}
			}
		}

		return $import_data;
	}

	/**
	 * Get uninstall steps.
	 *
	 * @return array
	 */
	public function get_uninstall_steps( $id, $data ) {

		$steps = array();

		$steps[] = array(
			'import_action' => 'uninstall',
			'import_id'     => $id,
			'import_group'  => $this->group,
			'import_type'   => 'start',
		);

		foreach ( $this->import_types as $type ) {
			if ( 'plugin' == $type || ! isset( $data[ $type ] ) ) {
				continue;
			}

			$steps[] = array(
				'import_action' => 'uninstall',
				'import_id'     => $id,
				'import_group'  => $this->group,
				'import_type'   => $type,
			);
		}

		$steps[] = array(
			'import_action' => 'uninstall',
			'import_id'     => $id,
			'import_group'  => $this->group,
			'import_type'   => 'finish',
		);

		return $steps;
	}

	/**
	 * Get importer steps.
	 *
	 * @return array
	 */
	public function get_steps( $params, $import_data = array() ) {
		$status         = &$params['import_status'];
		$clear_old_data = isset( $params['import_clear'] ) ? $params['import_clear'] : true;

		$steps = array();

		// cut here if status is only uninstall
		if ( 'uninstall' === $status ) {
			$data  = $this->get_current_import_data();
			$steps = $this->get_uninstall_steps( $this->id, $data );

			return array(
				'steps' => $steps,
			);
		}

		// add install data
		if ( empty( $import_data ) ) {
			return new \WP_Error( 'empty_import_data', 'No Import Data!' );
		}

		// clear previus group data before install
		if ( $clear_old_data ) {
			$group_data = $this->get_group_data();

			if ( $group_data && is_array( $group_data ) ) {
				foreach ( $group_data as $id => $data ) {
					$_steps = $this->get_uninstall_steps( $id, $data );

					$steps = array_merge( $steps, $_steps );
				}
			}
		}

		$steps[] = array(
			'import_action' => 'install',
			'import_id'     => $this->id,
			'import_group'  => $this->group,
			'import_type'   => 'start',
		);

		// only add option step if content import not enabled
		if ( isset( $params['import_content'] ) && 'no' === $params['import_content'] ) {
			$import_data = $this->set_without_content_data( $import_data );
		}

		foreach ( $this->import_types as $type ) {
			if ( ! isset( $import_data[ $type ] ) ) {
				continue;
			}
			$type_data = $import_data[ $type ];

			$chunk     = $this->get_chunk_size( $type );
			$type_data = array_chunk( $type_data, $chunk );

			foreach ( $type_data as $media_data ) {
				$steps[] = array(
					'import_action' => 'install',
					'import_id'     => $this->id,
					'import_group'  => $this->group,
					'import_type'   => $type,
					'import_data'   => $media_data,
				);
			}
		}

		$steps[] = array(
			'import_action' => 'install',
			'import_id'     => $this->id,
			'import_group'  => $this->group,
			'import_type'   => 'finish',
		);

		$response = array(
			'steps' => $steps,
		);

		return $response;
	}

	/**
	 * Create item by given params.
	 *
	 * @param $params
	 *
	 * @return bool
	 */
	public function install( $params ) {
		$type = &$params['import_type'];

		if ( '' === $this->group || '' === $this->id ) {
			return false;
		}

		// no timeout
		set_time_limit( 0 );

		if ( 'start' === $type ) {
			do_action( 'ak-framework/demo/install/before', $this->id );

			return true;
		} elseif ( 'finish' === $type ) {
			do_action( 'ak-framework/demo/install/after', $this->id );

			// add finish flag
			$this->set_data( 'finish', $this->id, 'true' );

			return true;
		}

		$import_data = &$params['import_data'];

		if ( isset( $import_data ) ) {
			foreach ( (array) $import_data as $i => $data ) {
				$response = $this->create_data_record( $type, $data );

				if ( is_wp_error( $response ) ) {
					return new \WP_Error( $response->get_error_code(), $response->get_error_message() . ' Data Info: [' . $type . ']' . ' the_ID:' . $data['the_ID'] );
				}

				if ( ! $response ) {
					return false;
				}
			}

			return true;
		}
	}

	/**
	 * Uninstall item by given params.
	 *
	 * @param $type
	 *
	 * @return bool
	 */
	public function uninstall( $params ) {
		if ( '' === $this->group || '' === $this->id ) {
			return false;
		}

		$type = &$params['import_type'];

		if ( 'start' === $type ) {
			do_action( 'ak-framework/demo/uninstall/before', $this->id );

			return true;
		} elseif ( 'finish' === $type ) {
			do_action( 'ak-framework/demo/uninstall/after', $this->id );

			$this->delete_current_import_data();

			return true;
		}

		$data_ids = $this->get_current_import_data();

		if ( ! empty( $data_ids[ $type ] ) && is_array( $data_ids[ $type ] ) ) {
			foreach ( $data_ids[ $type ] as $the_id => $data ) {
				$response = $this->delete_data_record( $type, $the_id, $data );

				if ( is_wp_error( $response ) ) {
					return $response;
				}
			}
		}

		return true;
	}

	/**
	 * Force to remove all group.
	 *
	 * @param $type
	 *
	 * @return bool
	 */
	public function force_uninstall() {
		if ( '' === $this->group || '' === $this->id ) {
			return false;
		}

		$demo_ids = $this->get_current_import_data();

		if ( ! empty( $demo_ids ) ) {
			foreach ( $demo_ids as $type => $type_ids ) {
				if ( ! empty( $type_ids ) ) {
					foreach ( $demo_ids[ $type ] as $the_id => $data ) {
						// no response required, continue anyways
						$this->delete_data_record( $type, $the_id, $data );
					}
				}
			}
		}

		$this->delete_current_import_data();

		return true;
	}

	/**
	 * Create data.
	 *
	 * @param string $type
	 * @param string $data
	 * @param string $i
	 *
	 * @return mixed
	 */
	public function create_data_record( $type, $data ) {
		$response = true;

		$data = apply_filters( 'ak-framework/importer/create/data', $data, $type );

		switch ( $type ) {
			case 'plugin':
				$importer = new ImporterPlugin;
				return $importer->create( $data );
				break;

			case 'media':
				$response = ImporterMedia::create( $data );
				break;

			case 'taxonomy':
				$response = ImporterTaxonomy::create( $data );
				break;

			case 'post':
				$response = ImporterPost::create( $data );
				break;

			case 'option':
				$response = ImporterOption::create( $data );
				break;

			case 'widget':
				$response = ImporterWidget::create( $data );
				break;

			case 'menu':
				$response = ImporterMenu::create( $data );
				break;
		}

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		if ( ! isset( $data['clear_off'] ) ) {
			$this->set_data( $type, $data['the_ID'], $response );
		}

		return $response;
	}

	/**
	 * Delete the data.
	 *
	 * @param string $demo_id
	 *
	 * @return mixed
	 */
	public function delete_data_record( $type, $the_id, $data ) {
		$response = true;

		$data = apply_filters( 'ak-framework/importer/delete/data', $data, $type, $the_id );

		switch ( $type ) {
			case 'media':
				$response = ImporterMedia::remove( $data );
				break;

			case 'taxonomy':
				$response = ImporterTaxonomy::remove( $data );
				break;

			case 'post':
				$response = ImporterPost::remove( $data );
				break;

			case 'option':
				$response = ImporterOption::remove( $data );
				break;

			case 'widget':
				$response = ImporterWidget::remove( $data );
				break;

			case 'menu':
				$response = ImporterMenu::remove( $data );
				break;
		}

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		$this->delete_data( $type, $the_id );

		return $response;
	}

	/**
	 * Get the check size by import type.
	 *
	 * @param string $type
	 *
	 * @return int
	 */
	public function get_chunk_size( $type ) {
		$size = 1;
		if ( 'media' === $type ) {
			$size = 3;
		} elseif ( 'post' === $type || 'taxonomy' === $type ) {
			$size = 10;
		}

		return apply_filters( 'ak-framework/importer/chuck-size', $size, $type );
	}
}
