<?php
/**
 * viral-menu.php
 *---------------------------
 * Viral mega menu template.
 */
?>
<div class="ak-mega-viral-menu-rows">
	<div class="mega-viral-menu-row sec_cat1 clearfix">
		<div class="header-reaction-list">
			<?php
			if ( function_exists( 'newsy_reaction_get_badge_menu' ) ) {
				newsy_reaction_get_badge_menu();
			}
			?>
		</div>
	</div>
	<div class="mega-viral-menu-row sec_cat2 clearfix">
		<ul class="mega-links">
			<?php
			$terms = get_terms(
				array(
					'taxonomy'   => 'category',
					'hide_empty' => false,
					'exclude'    => isset( $item->menu_meta['viral_menu_exc'] ) ? implode( ',', $item->menu_meta['viral_menu_exc'] ) : array(),
				)
			);
			if ( count( $terms ) > 0 ) {
				foreach ( $terms as $term ) {
					$term_link = get_term_link( $term );
					echo "<li><a href=\"{$term_link}\">{$term->name}</a></li>";
				}
			}
			?>

		</ul>
	</div>
	<div class="mega-viral-menu-row sec_cat3 clearfix">
		<?php
		if ( isset( $item->menu_meta['viral_menu_icon'] ) ) {
			?>
		<img class="viral-footer-icon lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo esc_attr( $item->menu_meta['viral_menu_icon'] ); ?>" alt="<?php echo esc_attr( get_option( 'blogname' ) ); ?>">
			<?php
		}
		?>

		<div class="viral-footer-left">
			<?php
			ak_nav_menu(
				array(
					'menu_id'        => 'viral-footer-menu',
					'theme_location' => 'footer-menu',
					'menu_class'     => 'ak-menu-wide viral-footer-menu',
				)
			);
			?>
			<div class="viral-footer-copyright clearfix">
			<?php get_template_part( 'views/builder/items/footer_copyright' ); ?>
			</div>
		</div>
	</div>
</div>
