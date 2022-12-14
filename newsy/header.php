<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=yes' />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<div class="ak-main-bg-wrap"></div>
	<?php do_action( 'newsy_main_before' ); ?>

	<!-- The Main Wrapper
	============================================= -->
	<div class="ak-main-wrap">

		<?php do_action( 'newsy_header_before' ); ?>

		<?php get_template_part( 'views/header' ); ?>

		<?php do_action( 'newsy_header_after' ); ?>
