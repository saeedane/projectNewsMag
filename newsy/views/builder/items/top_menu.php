<?php
$menu_args = apply_filters(
	'newsy_top_menu_args', array(
		'theme_location' => 'top-menu',
		'menu_class'     => 'ak-menu-wide',
		'echo'           => true,
	)
);
?>
<div class="ak-bar-item ak-header-top-menu">
	<?php ak_nav_menu( $menu_args ); ?>
</div>
<?php
unset( $menu_args );
