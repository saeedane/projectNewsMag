<!-- Login Popup Content -->
<?php
$show_register      = get_option( 'users_can_register' );
$recaptcha_site_key = newsy_get_option( 'recaptcha_site_key' );

if ( newsy_get_option( 'enable_recaptcha' ) === 'yes' ) {
	if ( ! empty( $recaptcha_site_key ) && ! empty( newsy_get_option( 'recaptcha_secret_key' ) ) ) {
		?>
		<script src="https://www.google.com/recaptcha/api.js?render=explicit" async defer></script>
		<?php
	}
}
?>
<div class="modal ak-auth-modal mfp-with-anim mfp-hide" id="userModal">

	<input type="hidden" name="redirect_to" id="redirect_to" value="<?php echo apply_filters( 'newsy_login_redirect', '' ); ?>"/>

	<div class="modal-step-container login-wrap">
		<div class="ak-loading-box"></div>
		<div class="modal-message"></div>

		<div class="modal-step-page modal-login-page modal-current-step">

			<div class="login-header">
				<h3><?php newsy_echo_translation( 'Login', 'newsy', 'login_title' ); ?></h3>
				<p><?php newsy_echo_translation( 'Welcome, Login to your account.', 'newsy', 'login_message' ); ?></p>
			</div>

			<?php do_action( 'newsy_login_form_before' ); ?>

			<form action="#" data-type="login" method="post" accept-charset="utf-8">
				<?php do_action( 'newsy_login_form_fields_before' ); ?>

				<div class="login-field login-username">
					<input type="text" name="username"  value="" placeholder="<?php newsy_echo_translation( 'Username or Email...', 'newsy', 'login_username_email' ); ?>" required/>
				</div>

				<div class="login-field login-password">
					<input type="password" name="password" value="" placeholder="<?php newsy_echo_translation( 'Password...', 'newsy', 'login_password' ); ?>" required/>
				</div>

				<div class="login-field login-reset">
					<span class="login-remember">
						<input class="remember-checkbox" name="remember" type="checkbox" value="1" checked="checked" />
						<label class="remember-label"><?php echo esc_html( newsy_get_translation( 'Remember me', 'newsy', 'login_remember' ) ); ?></label>
					</span>
					<a href="#" class="go-modal-step reset-link" data-modal-step="modal-reset-page"><?php newsy_echo_translation( 'Forget password?', 'newsy', 'login_forget_pass_btn' ); ?></a>
				</div>
				<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $recaptcha_site_key ); ?>"></div>
				<div class="login-field login-submit">
					<input type="hidden" name="action" value="ajax_login">
					<input type="submit" name="wp-submit" class="btn btn-primary login-btn login-button" value="<?php echo esc_attr( newsy_get_translation( 'Log In', 'newsy', 'login_button' ) ); ?>" />
				</div>
			</form>
			<?php
			do_action( 'newsy_login_form_after' );
			if ( $show_register ) {
				?>
				<div class="login-field login-buttom-text login-signup">
					<span>
						<?php newsy_echo_translation( 'You don\'t have an account?', 'newsy', 'login_no_account' ); ?>
						<a href="#" class="go-modal-step" data-modal-step="modal-register-page"><?php newsy_echo_translation( 'Register', 'newsy', 'login_signup' ); ?></a>
					</span>
				</div>
				<?php
			}
			?>

		</div>

		<div class="modal-step-page modal-register-page">

			<div class="login-header">
				<h3><?php newsy_echo_translation( 'Register', 'newsy', 'register_title' ); ?></h3>
				<p><?php newsy_echo_translation( 'Welcome, Create your new account', 'newsy', 'register_message' ); ?></p>
			</div>

			<?php do_action( 'newsy_register_form_before' ); ?>

			<form action="#" data-type="register" method="post" accept-charset="utf-8">
				<?php do_action( 'newsy_register_form_fields_before' ); ?>

				<?php if ( newsy_get_option( 'enable_register_full_name' ) === 'yes' ) : ?>
				<div class="login-field login-first-name">
					<input type="text" name="first_name" placeholder="<?php newsy_echo_translation( 'First Name', 'newsy', 'register_first_name' ); ?>" required/>
				</div>

				<div class="login-field login-username">
					<input type="text" name="last_name" placeholder="<?php newsy_echo_translation( 'Last Name', 'newsy', 'register_last_name' ); ?>" required/>
				</div>
				<?php endif; ?>

				<div class="login-field login-username">
					<input type="text" name="username" placeholder="<?php newsy_echo_translation( 'Username', 'newsy', 'register_username' ); ?>" required/>
				</div>

				<div class="login-field login-username">
					<input type="text" name="email" placeholder="<?php newsy_echo_translation( 'Email', 'newsy', 'register_email' ); ?>" required/>
				</div>

				<div class="login-field login-password">
					<input type="password" name="password" placeholder="<?php newsy_echo_translation( 'Password', 'newsy', 'register_password' ); ?>" required/>
				</div>
				<?php if ( newsy_get_option( 'enable_register_password_confirm' ) === 'yes' ) : ?>
				<div class="login-field login-password">
					<input type="password" name="password_confirm" placeholder="<?php newsy_echo_translation( 'Password Confirm', 'newsy', 'register_password_confirm' ); ?>" required/>
				</div>
					<?php
				endif;
				$terms_url = newsy_get_option( 'enable_register_term_and_condition' );
				if ( ! empty( $terms_url ) ) :
					?>
				<div class="login-field login-reset">
					<span class="login-remember">
						<input class="remember-checkbox" name="terms" type="checkbox" value="1" />
						<label class="remember-label"></label>
						<?php
						echo wp_kses(
							sprintf(
								newsy_get_translation( 'I have read and agree to the <a href="%s">Terms & Conditions</a>.', 'newsy', 'register_term_condition', false ),
								$terms_url
							),
							ak_trans_allowed_html()
						);
						?>
					</span>
				</div>
				<?php endif; ?>

				<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $recaptcha_site_key ); ?>"></div>
				<div class="login-field login-submit">
					<input type="hidden" name="action" value="ajax_register">
					<input type="submit" name="wp-submit" class="btn btn-primary login-btn register-button" value="<?php newsy_echo_translation( 'Sign Up', 'newsy', 'register_button' ); ?>" />
				</div>
			</form>

			<?php do_action( 'newsy_register_form_after' ); ?>

			<div class="login-field login-buttom-text login-signin">
				<span>
					<?php newsy_echo_translation( 'You have an account?', 'newsy', 'register_no_account' ); ?>
					<a href="#"  class="go-modal-step" data-modal-step="modal-login-page"><?php newsy_echo_translation( 'Go to Sign In', 'newsy', 'login_back_text' ); ?></a>
				</span>
			</div>
		</div>

		<div class="modal-step-page modal-reset-page">

			<div class="login-header">
				<span class="login-icon fa fa-lock"></span>
				<h3><?php newsy_echo_translation( 'Recover your password.', 'newsy', 'login_reset_title' ); ?></h3>
				<p><?php newsy_echo_translation( 'A password will be e-mailed to you.', 'newsy', 'login_reset_message' ); ?></p>
			</div>

			<?php do_action( 'newsy_password_reset_form_after' ); ?>

			<form action="#" data-type="password_reset" method="post" accept-charset="utf-8">
				<div class="login-field reset-username">
					<input type="text" name="user_login" value="" placeholder="<?php newsy_echo_translation( 'Username or Email', 'newsy', 'login_reset_username' ); ?>" required/>
				</div>
				<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $recaptcha_site_key ); ?>"></div>
				<div class="login-field reset-submit">
					<input type="hidden" name="action" value="ajax_recover_password">
					<input type="submit" class="login-btn" value="<?php newsy_echo_translation( 'Send My Password', 'newsy', 'login_reset_send' ); ?>" />
				</div>
			</form>

			<div class="login-field reset-submit">
				<a href="#" class="go-modal-step go-modal-login-page" data-modal-step="modal-login-page">
					<i class="fa fa-angle-left"></i>
					<?php newsy_echo_translation( 'Sign In', 'newsy', 'login_back_text' ); ?>
				</a>
			</div>
		</div>
	</div>

</div>

