<?php

$fields[] = array(
	'heading' => esc_html__( 'Auth', 'newsy' ),
	'id'      => 'advanced_auth_group_start',
	'type'    => 'group_start',
	'section' => 'advanced',
);
$fields[] = array(
	'id'          => 'enable_register_auto_login',
	'heading'     => esc_html__( 'Register Auto Login', 'newsy' ),
	'description' => esc_html__( 'Enable this feature to automatically log in after registration.', 'newsy' ),
	'type'        => 'switcher',
	'options'     => array(
		'off' => '',
		'on'  => 'yes',
	),
	'section'     => 'advanced',
);
$fields[] = array(
	'id'          => 'enable_register_send_notification',
	'heading'     => esc_html__( 'Register Send New User Notification', 'newsy' ),
	'description' => esc_html__( 'Enable this feature to send an email to the admin alerting them of the registration.', 'newsy' ),
	'type'        => 'switcher',
	'options'     => array(
		'off' => '',
		'on'  => 'yes',
	),
	'section'     => 'advanced',
);
$fields[] = array(
	'id'          => 'enable_register_full_name',
	'heading'     => esc_html__( 'Enable Register Full Name Field', 'newsy' ),
	'description' => esc_html__( 'Enable this feature to require first & last name on register form.', 'newsy' ),
	'type'        => 'switcher',
	'options'     => array(
		'off' => '',
		'on'  => 'yes',
	),
	'section'     => 'advanced',
);
$fields[] = array(
	'id'          => 'enable_register_password_confirm',
	'heading'     => esc_html__( 'Enable Register Password Confirm Field', 'newsy' ),
	'description' => esc_html__( 'Enable this feature to require password confirm on register form.', 'newsy' ),
	'type'        => 'switcher',
	'options'     => array(
		'off' => '',
		'on'  => 'yes',
	),
	'section'     => 'advanced',
);
$fields[] = array(
	'id'          => 'enable_register_term_and_condition',
	'heading'     => esc_html__( 'Enable Register Term & Conditions Field', 'newsy' ),
	'description' => esc_html__( 'Enter your term of use page URL to require term of use confirmation on register form.', 'newsy' ),
	'type'        => 'text',
	'section'     => 'advanced',
);
$fields[] = array(
	'id'          => 'enable_bp_signup',
	'heading'     => esc_html__( 'Enable BuddyPress Registration', 'newsy' ),
	'description' => esc_html__( 'You may want to enable this option to use BuddyPress email verification features. If this is enabled, the popup user registration form will use the BuddyPress functionalities.', 'newsy' ),
	'type'        => 'switcher',
	'options'     => array(
		'off' => '',
		'on'  => 'yes',
	),
	'section'     => 'advanced',
);

$fields[] = array(
	'heading' => esc_html__( 'Recaptcha', 'newsy' ),
	'id'      => 'advanced_recaptcha_group_start',
	'type'    => 'group_start',
	'section' => 'advanced',
);

$fields[] = array(
	'id'          => 'enable_recaptcha',
	'heading'     => esc_html__( 'Enable Recaptcha', 'newsy' ),
	'description' => esc_html__( 'Enable this feature to use recaptcha on login, register section.', 'newsy' ),
	'type'        => 'switcher',
	'options'     => array(
		'off' => '',
		'on'  => 'yes',
	),
	'section'     => 'advanced',
);
$fields[] = array(
	'heading'     => esc_html__( 'Google Recaptcha Site Key', 'newsy' ),
	'description' => wp_kses(
		sprintf(
			__( 'Create your recaptcha v2 site key, <a href="%s">please go here</a>', 'newsy' ),
			'https://www.google.com/recaptcha/admin'
		), ak_trans_allowed_html()
	),
	'id'          => 'recaptcha_site_key',
	'type'        => 'text',
	'section'     => 'advanced',
	'dependency'  => array(
		'element' => 'enable_recaptcha',
		'value'   => array( 'yes' ),
	),
);
$fields[] = array(
	'heading'     => esc_html__( 'Google Recaptcha Secret Key', 'newsy' ),
	'description' => wp_kses(
		sprintf(
			__( 'Create your recaptcha v2 site key, <a href="%s">please go here</a>', 'newsy' ),
			'https://www.google.com/recaptcha/admin'
		), ak_trans_allowed_html()
),
	'id'          => 'recaptcha_secret_key',
	'type'        => 'text',
	'section'     => 'advanced',
	'dependency'  => array(
		'element' => 'enable_recaptcha',
		'value'   => array( 'yes' ),
	),
);



$fields[] = array(
	'heading' => esc_html__( 'Facebook App', 'newsy' ),
	'id'      => 'advanced_facebook_group_start',
	'type'    => 'group_start',
	'section' => 'advanced',
);
$fields[] = array(
	'heading'     => esc_html__( 'Facebook App ID', 'newsy' ),
	'description' => wp_kses( sprintf( __( 'You can create an application and get Facebook App ID <a href="%s" target="_blank">here</a>.', 'newsy' ), 'https://developers.facebook.com/docs/apps/register' ), ak_trans_allowed_html() ),
	'id'          => 'facebook_app_id',
	'type'        => 'text',
	'section'     => 'advanced',
);
$fields[] = array(
	'heading'     => esc_html__( 'Facebook Security Key', 'newsy' ),
	'description' => wp_kses( sprintf( __( 'You can create an application and get Facebook App Secret <a href="%s" target="_blank">here</a>.', 'newsy' ), 'https://developers.facebook.com/docs/apps/register' ), ak_trans_allowed_html() ),
	'id'          => 'facebook_security_key',
	'type'        => 'text',
	'section'     => 'advanced',
);
$fields[] = array(
	'heading'     => esc_html__( 'Facebook Access Token', 'newsy' ),
	'description' => wp_kses( sprintf( __( 'Get your Facebook Access Token by clicking this <a class="%1$s" href="%2$s" target="_blank">link</a>.', 'newsy' ), 'newsy_access_token facebook', '#' ), ak_trans_allowed_html() ),
	'id'          => 'facebook_access_token',
	'type'        => 'text',
	'section'     => 'advanced',
);

$fields[] = array(
	'heading' => esc_html__( 'Other Settings', 'newsy' ),
	'id'      => 'advanced_other_group_start',
	'type'    => 'group_start',
	'section' => 'advanced',
);
$fields[] = array(
	'heading'     => esc_html__( 'Sticky Sidebars Active?', 'newsy' ),
	'id'          => 'sticky_sidebar',
	'description' => esc_html__( 'This allows you to enable sticky widgets sidebars. Note: You have to add "sticky-column" class name to visual composer columns.', 'newsy' ),
	'type'        => 'switcher',
	'options'     => array(
		'off' => 'disabled',
		'on'  => '',
	),
	'section'     => 'advanced',
);

$fields[] = array(
	'heading'     => esc_html__( 'Enable Lazy Load Off-Canvas(Drawer) Menu?', 'newsy' ),
	'id'          => 'drawer_lazyload',
	'description' => esc_html__( 'This allows you to enable load off-canvas menu on demand. You can disable if you want to preload drawer menu but this will affect your page size.', 'newsy' ),
	'type'        => 'switcher',
	'options'     => array(
		'off' => '',
		'on'  => 'enabled',
	),
	'section'     => 'advanced',
);

$fields[] = array(
	'id'          => 'back_to_top',
	'type'        => 'switcher',
	'heading'     => esc_html__( 'Show Back to Top Button?', 'newsy' ),
	'description' => esc_html__( 'This button allows you to go page top quickly', 'newsy' ),
	'options'     => array(
		'off' => 'hide',
		'on'  => '',
	),
	'section'     => 'advanced',
);

