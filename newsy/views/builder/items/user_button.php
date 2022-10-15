<div class="ak-bar-item ak-header-user ak-header-button ak-header-button-login">
	<?php
	if ( is_user_logged_in() ) {
		newsy_generate_user_icon();
	} else {
		newsy_generate_button(
			'header_login_button', array(
				'link'          => defined( 'AK_FRAMEWORK_PATH' ) ? '#userModal' : esc_url( wp_login_url() ),
				'text'          => newsy_get_translation( 'Login', 'newsy', 'login' ),
				'icon'          => 'fa-lock',
				'style'         => 'btn-none',
				'extra_classes' => 'menu-login-user-icon',
			)
		);
	}
	?>
</div>
