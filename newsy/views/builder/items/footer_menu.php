<div class="ak-bar-item ak-footer-menu-container ">
	<?php
	ak_nav_menu(
		array(
			'theme_location' => 'footer-menu',
			'menu_class'     => 'ak-menu-wide ak-menu-' . newsy_get_option( 'footer_menu_style', 'style-6' ),
			'echo'           => true,
		)
	);
	?>
</div>
