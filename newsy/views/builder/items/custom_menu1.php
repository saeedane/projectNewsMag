<?php
$menu = newsy_get_option( 'custom_menu1_nav_menu' );
if ( ! $menu ) {
	return;
}

$menu_args = apply_filters(
	'newsy_custom_menu1_args', array(
		'menu'       => $menu,
		'menu_class' => newsy_get_option( 'custom_menu1_nav_menu_vertical' ) !== 'yes' ? 'ak-menu-wide' : '',
		'echo'       => true,
	)
);
?>
<div class="ak-bar-item ak-custom-menu ak-header-custom-menu1">
	<?php ak_nav_menu( $menu_args ); ?>
</div>
<?php
unset( $menu_args );
