<?php
/**
 * BuddyPress Single Members item Navigation
 *
 * @since 3.0.0
 * @version 3.1.0
 */
?>

<nav class="ak-buddypress-nav ak-menu-more-enabled" id="object-nav" role="navigation" aria-label="<?php esc_attr_e( 'Member menu', 'newsy' ); ?>">
<?php if ( bp_nouveau_has_nav( array( 'type' => 'primary' ) ) ) : ?>

	<ul class="ak-menu ak-menu-wide ak-menu-style-1 ak-bp-menu">
		<?php
		while ( bp_nouveau_nav_items() ) :
			bp_nouveau_nav_item();
			?>

			<li id="<?php bp_nouveau_nav_id(); ?>" class="menu-item <?php bp_nouveau_nav_classes(); ?>">
				<a href="<?php bp_nouveau_nav_link(); ?>" id="<?php bp_nouveau_nav_link_id(); ?>">
					<?php bp_nouveau_nav_link_text(); ?>

					<?php if ( bp_nouveau_nav_has_count() ) : ?>
						<span class="menu-item-badge count"><?php bp_nouveau_nav_count(); ?></span>
					<?php endif; ?>
				</a>
			</li>

		<?php endwhile; ?>

		<?php bp_nouveau_member_hook( '', 'options_nav' ); ?>
	</ul>
<?php endif; ?>
</nav>

