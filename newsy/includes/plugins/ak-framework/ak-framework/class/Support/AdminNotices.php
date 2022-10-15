<?php
/**
 * The AkFramework.
 *
 * AkFramework is framework for themes and plugins for WordPress.
 *
 *  Copyright © 2020 akbilisim
 *  www.akbilisim.com
 *
 *
 *  Envato Profile: https://themeforest.net/user/akbilisim
 */

namespace Ak\Support;

/**
 * Dismissible Notices Handler.
 *
 * This library is designed to handle dismissible admin notices.
 *
 *
 * @package   Dismissible Notices Handler
 *
 * @author    Julien Liabeuf <julien@liabeuf.fr>
 *
 * @version   1.0
 *
 * @license   GPL-2.0+
 *
 * @link      https://julienliabeuf.com
 *
 * @copyright 2016 Julien Liabeuf
 */

class AdminNotices {

	/**
	 * @var AdminNotices
	 */
	private static $instance;

	/**
	 * @var array Holds all our registered notices
	 *
	 * @since 1.0
	 */
	private $notices;

	/**
	 * Initialize the Ak_Admin_Notices_Manager.
	 */
	public function __construct() {
		add_action( 'ak-framework/setup/after', array( $this, 'init' ), 19 );
	}

	/**
	 * @return AdminNotices
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Initialize the Ak_Admin_Notices_Manager.
	 */
	public function init() {
		add_action( 'admin_notices', array( $this, 'display_notices' ) );
		add_action( 'wp_ajax_ak_dismiss_notice', array( $this, 'dismiss_notice_ajax' ) );
	}

	/**
	 * Display all the registered notices.
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	public function display_notices() {
		if ( is_null( $this->notices ) || empty( $this->notices ) ) {
			return;
		}

		foreach ( $this->notices as $id => $notice ) {
			$id = $this->get_id( $id );

			// Check if the notice was dismissed
			if ( $this->is_dismissed( $id ) ) {
				continue;
			}

			// Check if the current user has required capability
			if ( ! empty( $notice['cap'] ) && ! current_user_can( $notice['cap'] ) ) {
				continue;
			}

			$class = array(
				'notice',
				$notice['type'],
				$notice['dismissible'],
				$notice['class'],
			);

			printf( '<div id="%4$s" class="%1$s"><h3>%2$s</h3><p>%3$s</p></div>', trim( implode( ' ', $class ) ), $notice['title'], $notice['content'], "ak-notice-$id" );
		}
	}

	/**
	 * Sanitize a notice ID and return it.
	 *
	 * @since 1.0
	 *
	 * @param string $id
	 *
	 * @return string
	 */
	public function get_id( $id ) {
		return sanitize_key( $id );
	}

	/**
	 * Get available notice types.
	 *
	 * @since 1.0
	 *
	 * @return array
	 */
	public function get_types() {
		$types = array(
			'error',
			'updated',
		);

		return apply_filters( 'ak_framework_admin_notice_types', $types );
	}

	/**
	 * Register a new notice.
	 *
	 * @since 1.0
	 *
	 * @param string $id      Notice ID, used to identify it
	 * @param string $type    Type of notice to display
	 * @param string $title   Notice title
	 * @param string $content Notice content
	 * @param array  $args    Additional parameters
	 *
	 * @return bool
	 */
	public function register_notice( $id, $type, $content, $title = '', $args = array() ) {
		if ( is_null( $this->notices ) ) {
			$this->notices = array();
		}
		if ( isset( $this->notices[ $id ] ) ) {
			return;
		}

		$id      = $this->get_id( $id );
		$t       = sanitize_text_field( $type );
		$type    = in_array( $t, $this->get_types() ) ? $t : 'updated';
		$content = wp_kses_post( $content );
		$title   = wp_kses_post( $title );
		$args    = wp_parse_args( $args, $this->default_args() );

		if ( array_key_exists( $id, $this->notices ) ) {
			$this->spit_error(
				sprintf(
					// translators: %s: required php version
					esc_html__( 'A notice with the ID %s has already been registered.', 'ak-framework' ),
					"<code>$id</code>"
				)
			);

			return false;
		}

		$notice = array(
			'type'    => $type,
			'title'   => $title,
			'content' => $content,
		);

		$notice = array_merge( $notice, $args );

		$this->notices[ $id ] = $notice;

		return true;
	}

	/**
	 * Notice dismissal triggered by Ajax.
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	public function dismiss_notice_ajax() {
		if ( ! isset( $_POST['id'] ) ) {
			echo 0;
			exit;
		}

		if ( empty( $_POST['id'] ) || false === strpos( $_POST['id'], 'ak-notice-' ) ) {
			echo 0;
			exit;
		}

		$id = $this->get_id( str_replace( 'ak-notice-', '', $_POST['id'] ) );

		ak_sanitize_echo( $this->dismiss_notice( $id ) );
		exit;
	}

	/**
	 * Dismiss a notice.
	 *
	 * @since 1.0
	 *
	 * @param string $id ID of the notice to dismiss
	 *
	 * @return bool
	 */
	public function dismiss_notice( $id ) {
		$notice = $this->get_notice( $this->get_id( $id ) );

		if ( false === $notice ) {
			return false;
		}

		if ( $this->is_dismissed( $id ) ) {
			return false;
		}

		return $this->dismiss_global( $id );
	}

	/**
	 * Restore a dismissed notice.
	 *
	 * @since 1.0
	 *
	 * @param string $id ID of the notice to restore
	 *
	 * @return bool
	 */
	public function restore_notice( $id ) {
		$id     = $this->get_id( $id );
		$notice = $this->get_notice( $id );

		if ( false === $notice ) {
			return false;
		}

		return $this->restore_global( $id );
	}

	/**
	 * Get all dismissed notices.
	 *
	 * This includes notices dismissed globally or per user.
	 *
	 * @since 1.0
	 *
	 * @return array
	 */
	public function dismissed_notices() {
		$global = $this->dismissed_global();

		return $global;
	}

	/**
	 * Check if a notice has been dismissed.
	 *
	 * @since 1.0
	 *
	 * @param string $id Notice ID
	 *
	 * @return bool
	 */
	public function is_dismissed( $id ) {
		$dismissed = $this->dismissed_notices();

		if ( ! in_array( $this->get_id( $id ), $dismissed ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Get all the registered notices.
	 *
	 * @since 1.0
	 *
	 * @return array|null
	 */
	public function get_notices() {
		return $this->notices;
	}

	/**
	 * Return a specific notice.
	 *
	 * @since 1.0
	 *
	 * @param string $id Notice ID
	 *
	 * @return array|false
	 */
	public function get_notice( $id ) {
		$id = $this->get_id( $id );

		if ( ! is_array( $this->notices ) || ! array_key_exists( $id, $this->notices ) ) {
			return false;
		}

		return $this->notices[ $id ];
	}

	/**
	 * Spits an error message at the top of the admin screen.
	 *
	 * @since 1.0
	 *
	 * @param string $error Error message to spit
	 *
	 * @return void
	 */
	protected function spit_error( $error ) {
		printf(
			'<div style="margin: 20px; text-align: center;"><strong>%1$s</strong> %2$s</pre></div>',
			esc_html__( 'Dismissible Notices Handler Error:', 'ak-framework' ),
			wp_kses_post( $error )
		);
	}

	/**
	 * Get the default arguments for a notice.
	 *
	 * @since 1.0
	 *
	 * @return array
	 */
	private function default_args() {
		$args = array(
			'screen'      => '', // Coming soon
			'scope'       => 'global', // Scope of the dismissal. Either user or global
			'cap'         => 'manage_options', // Required user capability
			'dismissible' => 'is-dismissible', // Required user capability
			'class'       => 'ak-notice ak-notice-wrapper', // Additional class to add to the notice
		);

		return apply_filters( 'ak-framework/admin-notices/args', $args );
	}

	/**
	 * Dismiss notice globally on the site.
	 *
	 * @since 1.0
	 *
	 * @param string $id Notice ID
	 *
	 * @return bool
	 */
	private function dismiss_global( $id ) {
		$dismissed = $this->dismissed_global();

		if ( in_array( $id, $dismissed ) ) {
			return false;
		}

		array_push( $dismissed, $id );

		return update_option( 'ak_dismissed_notices', $dismissed );
	}

	/**
	 * Restore a notice dismissed globally.
	 *
	 * @since 1.0
	 *
	 * @param string $id ID of the notice to restore
	 *
	 * @return bool
	 */
	private function restore_global( $id ) {
		$id     = $this->get_id( $id );
		$notice = $this->get_notice( $id );

		if ( false === $notice ) {
			return false;
		}

		$dismissed = $this->dismissed_global();

		if ( ! in_array( $id, $dismissed ) ) {
			return false;
		}

		$flip = array_flip( $dismissed );
		$key  = $flip[ $id ];

		unset( $dismissed[ $key ] );

		return update_option( 'ak_dismissed_notices', $dismissed );
	}

	/**
	 * Get globally dismissed notices.
	 *
	 * @since 1.0
	 *
	 * @return array
	 */
	private function dismissed_global() {
		return get_option( 'ak_dismissed_notices', array() );
	}
}
