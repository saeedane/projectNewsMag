<div class="ak-bar-item ak-header-user">
	<?php
	if ( is_user_logged_in() ) {
		newsy_generate_user_icon();
	} else {
		if ( defined( 'AK_FRAMEWORK_PATH' ) ) {
			?>
			<a class="ak-header-icon-btn menu-login-user-icon" href="#userModal">
				<?php echo ak_get_icon( newsy_get_option( 'header_login_icon', 'akfi-account_circle' ) ); ?>
			</a>
			<?php
		} else {
			?>
			<a class="ak-header-icon-btn" href="<?php echo esc_url( wp_login_url() ); ?>">
				<i class="ak-icon akfi-account_circle"></i>
			</a>
			<?php
		}
	}
	?>
</div>
