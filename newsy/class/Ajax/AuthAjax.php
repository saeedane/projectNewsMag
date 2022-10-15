<?php

namespace Newsy\Ajax;

/**
 * Class AuthAjax.
 */
class AuthAjax {

	/**
	 * @var AuthAjax
	 */
	private static $instance;

	/**
	 * @return AuthAjax
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * @return mixed WP_User on success or WP_Error on failure
	 */
	public function handle( $action ) {
		$nonce = sanitize_text_field( wp_unslash( $_POST['nonce'] ) );

		if ( empty( $nonce ) || ! wp_verify_nonce( $nonce, 'newsy_nonce' ) ) {
			wp_send_json(
				array(
					'success'       => 0,
					'refresh_nonce' => 1,
					'message'       => 'Invalid Token!',
				)
			);
		}

		try {
			$validation_error = new \WP_Error();

			if ( $validation_error->get_error_code() ) {
				throw new \Exception( $validation_error->get_error_message() );
			}

			if ( ! $this->handle_recaptcha_check() ) {
				throw new \Exception( newsy_get_translation( 'Invalid Recaptcha!', 'newsy', 'invalid_recaptcha' ) );
			}

			if ( method_exists( __CLASS__, $action ) ) {
				$this->$action();
			}
		} catch ( \Exception $e ) {
			wp_send_json(
				array(
					'success' => 0,
					'message' => $e->getMessage(),
				)
			);
		}

		exit;
	}

	/**
	 * Handle recaptcha check.
	 *
	 * @return bool
	 */
	private function handle_recaptcha_check() {
		$recaptcha = true;

		if ( newsy_get_option( 'enable_recaptcha' ) === 'yes' ) {
			$recaptcha_site_key   = newsy_get_option( 'recaptcha_site_key' );
			$recaptcha_secret_key = newsy_get_option( 'recaptcha_secret_key' );

			if ( ! empty( $recaptcha_site_key ) && ! empty( $recaptcha_secret_key ) ) {
				$grecaptcha_response = trim( $_POST['g-recaptcha-response'] );
				$recaptcha           = false;
				$post_data           = array(
					'secret'   => $recaptcha_secret_key,
					'response' => $grecaptcha_response,
					'remoteip' => ak_get_ip_address(),
				);

				$verify = wp_remote_post(
					'https://www.google.com/recaptcha/api/siteverify',
					array(
						'header' => array( 'Content-Type' => 'application/x-www-form-urlencoded' ),
						'body'   => $post_data,
						'method' => 'POST',
					)
				);

				if ( ! is_wp_error( $verify ) && '200' == $verify['response']['code'] ) {
					$verify = json_decode( $verify['body'] );
					if ( isset( $verify->success ) ) {
						$recaptcha = $verify->success;
					}
				}
			}
		}

		return $recaptcha;
	}

	/**
	 * Handle ajax login.
	 *
	 * @return mixed WP_User on success or WP_Error on failure
	 */
	public function ajax_login() {
		if ( empty( $_POST['username'] ) || empty( $_POST['password'] ) ) {
			throw new \Exception( newsy_get_translation( 'All fields are required!', 'newsy', 'fields_required' ) );
		}

		$user_login = sanitize_user( wp_unslash( $_POST['username'] ) );
		$user_pass  = $_POST['password'];
		$remember   = sanitize_text_field( $_POST['remember'] );

		$creds = array();

		if ( is_email( $user_login ) ) {
			$user = get_user_by( 'email', $user_login );

			if ( isset( $user->user_login ) ) {
				$creds['user_login'] = $user->user_login;
			} else {
				throw new \Exception( newsy_get_translation( 'A user could not be found with this email address.', 'newsy', 'email_incorrect' ) );
			}
		} else {
			$creds['user_login'] = $user_login;
		}

		$creds['user_password'] = $user_pass;
		$creds['remember']      = is_bool( $remember ) && $remember;
		$secure_cookie          = is_ssl() ? true : false;
		$user                   = wp_signon( $creds, $secure_cookie );

		if ( is_wp_error( $user ) ) {
			throw new \Exception( $user->get_error_message() );
		}
		// refresh
		wp_send_json(
			array(
				'success' => 1,
				'refresh' => 1,
				'message' => newsy_get_translation( 'Login successful. Please wait while you are being redirected.', 'newsy', 'login_success_wait_redirecting' ),
			)
		);
	}

	/**
	 * Handle ajax register.
	 *
	 * @_POST $username
	 * @_POST $password
	 * @_POST $email
	 *
	 * @return mixed WP_Error on failure or user id on success
	 */
	public function ajax_register() {
		// try to create a new user if registration is open on wp-admin/settings,
		if ( get_option( 'users_can_register' ) === false ) {
			throw new \Exception( newsy_get_translation( 'Register disabled!', 'newsy', 'register_disabled' ) );
		}

		if ( empty( $_POST['username'] ) || empty( $_POST['email'] ) || empty( $_POST['password'] ) ) {
			throw new \Exception( newsy_get_translation( 'All fields are required!', 'newsy', 'fields_required' ) );
		}

		$user_login = sanitize_user( wp_unslash( $_POST['username'] ) );
		$user_email = sanitize_user( wp_unslash( $_POST['email'] ) );
		$user_pass  = sanitize_text_field( $_POST['password'] );
		$first_name = sanitize_text_field( $_POST['first_name'] );
		$last_name  = sanitize_text_field( $_POST['last_name'] );

		if ( newsy_get_option( 'enable_register_full_name' ) === 'yes' ) {
			if ( empty( $first_name ) ) {
				throw new \Exception( newsy_get_translation( 'Full name is required!', 'newsy', 'register_first_name_required' ) );
			}
			if ( empty( $last_name ) ) {
				throw new \Exception( newsy_get_translation( 'Last name is required!', 'newsy', 'register_last_name_required' ) );
			}
		}

		if ( username_exists( $user_login ) ) {
			throw new \Exception( newsy_get_translation( 'Username is already taken', 'newsy', 'register_username_exists' ) );
		}

		if ( ! validate_username( $user_login ) ) {
			throw new \Exception( newsy_get_translation( 'Invalid username', 'newsy', 'invalid_username' ) );
		}

		if ( ! is_email( $user_email ) ) {
			throw new \Exception( newsy_get_translation( 'Invalid email', 'newsy', 'invalid_email' ) );
		}

		if ( email_exists( $user_email ) ) {
			throw new \Exception( newsy_get_translation( 'Email is already registered', 'newsy', 'register_email_exists' ) );
		}

		if ( newsy_get_option( 'enable_register_password_confirm' ) === 'yes' ) {
			$user_pass_confirm = $_POST['password_confirm'];
			if ( $user_pass !== $user_pass_confirm ) {
				throw new \Exception( newsy_get_translation( 'Passwords do not match', 'newsy', 'register_passwords_dont_match' ) );
			}
		}

		if ( ! empty( newsy_get_option( 'enable_register_term_and_condition' ) ) ) {
			$terms = sanitize_text_field( $_POST['terms'] );

			if ( empty( $terms ) ) {
				throw new \Exception( newsy_get_translation( 'You must accept the terms & conditions', 'newsy', 'register_accept_terms_condition' ) );
			}
		}

		if ( newsy_get_option( 'enable_bp_signup' ) === 'yes' && function_exists( 'bp_core_signup_user' ) ) {
			$new_user = bp_core_signup_user( $user_login, $user_pass, $user_email, array() );
		} else {
			$new_user = wp_insert_user(
				array(
					'first_name' => $first_name,
					'last_name'  => $last_name,
					'user_login' => $user_login,
					'user_pass'  => $user_pass,
					'user_email' => $user_email,
				)
			);
		}

		if ( is_wp_error( $new_user ) ) {
			throw new \Exception( $new_user->get_error_message() );
		}

		if ( newsy_get_option( 'enable_register_send_notification' ) === 'yes' ) {
			// send an email to the admin alerting them of the registration
			wp_new_user_notification( $new_user, null, 'admin' );
		}

		$user = get_user_by( 'id', $new_user );

		if ( 2 === intval( $user->user_status ) ) {
			wp_send_json(
				array(
					'success' => 1,
					'refresh' => 0,
					'message' => newsy_get_translation( 'You have successfully created your account! To begin using this site you will need to activate your account via the email we have just sent to your address.', 'newsy', 'register_verify_email' ),
				)
			);
		}

		if ( newsy_get_option( 'enable_register_auto_login' ) === 'yes' ) {
			$creds                  = array();
			$creds['user_login']    = $user_login;
			$creds['user_password'] = $user_pass;
			$creds['remember']      = true;
			$secure_cookie          = is_ssl() ? true : false;
			$user                   = wp_signon( $creds, $secure_cookie );

			if ( is_wp_error( $user ) ) {
				throw new \Exception( $user->get_error_message() );
			}
		}

		wp_send_json(
			array(
				'success' => 1,
				'refresh' => 1,
				'message' => newsy_get_translation( 'Register successful. Please wait while you are being redirected.', 'newsy', 'register_done_send_email' ),
			)
		);
	}

	/**
	 * Handle ajax password reset.
	 *
	 * @_POST $user_login
	 *
	 * @return mixed WP_Error on failure or user id on success
	 */
	public function ajax_recover_password() {
		if ( empty( $_POST['user_login'] ) ) {
			throw new \Exception( newsy_get_translation( 'All fields are required!', 'newsy', 'fields_required' ) );
		}

		$user_login = sanitize_user( wp_unslash( $_POST['user_login'] ) );

		$login     = trim( $user_login );
		$user_data = get_user_by( 'login', $login );

		// If no user found, check if it login is email and lookup user based on email.
		if ( ! $user_data && is_email( $login ) ) {
			$user_data = get_user_by( 'email', $login );
		}

		if ( ! $user_data || is_multisite() && ! is_user_member_of_blog( $user_data->ID, get_current_blog_id() ) ) {
			throw new \Exception( newsy_get_translation( 'Email or username is not registered into this site', 'newsy', 'email_username_not_registered' ) );
		}

		// redefining user_login ensures we return the right case in the email
		$user_login = $user_data->user_login;
		$key        = get_password_reset_key( $user_data );

		$message  = newsy_get_translation( 'Someone has requested a password reset for the following account:', 'newsy', 'someone_request_password_reset' ) . "\r\n\r\n";
		$message .= network_home_url( '/' ) . "\r\n\r\n";
		$message .= sprintf( newsy_get_translation( 'Username: %s', 'newsy', 'username_s' ), $user_login ) . "\r\n\r\n";
		$message .= newsy_get_translation( 'If this was a mistake, just ignore this email and nothing will happen.', 'newsy', 'ignore_mistake_email' ) . "\r\n\r\n";
		$message .= newsy_get_translation( 'To reset your password, visit the following address:', 'newsy', 'reset_password_visit_address' ) . "\r\n\r\n";
		$message .= '<' . network_home_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . ">\r\n";

		if ( is_multisite() ) {
			$blogname = $GLOBALS['current_site']->site_name;
		} else {
			// The blogname option is escaped with esc_html on the way into the database in sanitize_option
			// we want to reverse this for the plain text arena of emails.
			$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
		}

		$title = sprintf( newsy_get_translation( '[%s] Password Reset', 'newsy', 's_password_reset' ), $blogname );

		$title        = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );
		$message      = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );
		$send_message = ak_send_mail( $user_data->user_email, $title, $message );

		if ( $message && ! $send_message ) {
			wp_send_json(
				array(
					'success' => 0,
					'message' => newsy_get_translation( 'The e-mail could not be sent. Your host may have disabled the mail function...', 'newsy', 'email_not_sent_host_disable_mail_function' ),
				)
			);
		} else {
			wp_send_json(
				array(
					'success' => 1,
					'refresh' => 0,
					'message' => newsy_get_translation( 'Please check your e-mail for the confirmation link', 'newsy', 'check_email_confirmation_link' ),
				)
			);
		}
	}
}
