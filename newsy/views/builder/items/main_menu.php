<?php

$menu_classes = array();
if ( newsy_get_option( 'main_menu_more_enabled' ) === 'active' ) {
	$menu_classes[] = 'ak-menu-more-enabled';
}
if ( newsy_get_option( 'main_menu_fit_menu' ) === 'active' ) {
	$menu_classes[] = 'ak-menu-fit';
}

$menu_args = apply_filters(
	'newsy_main_menu_args',
	array(
		'theme_location' => 'main-menu',
		'menu_class'     => 'ak-main-menu ak-menu-wide ak-menu-' . newsy_get_option( 'main_menu_style', 'style-1' ),
		'echo'           => true,
	)
);
?>
<div class="ak-bar-item ak-header-main-menu <?php echo esc_attr( implode( ' ', $menu_classes ) ); ?>">
	<?php ak_nav_menu( $menu_args ); ?>
</div>
