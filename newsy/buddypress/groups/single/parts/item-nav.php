<?php
/**
 * BuddyPress Single Groups item Navigation
 *
 * @since 3.0.0
 * @version 3.0.0
 */
?>

<nav class="ak-buddypress-nav ak-menu-more-enabled" id="object-nav" role="navigation" aria-label="<?php esc_attr_e( 'Group menu', 'buddypress' ); ?>">

	<?php if ( bp_nouveau_has_nav( array( 'object' => 'groups' ) ) ) : ?>

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

			<?php bp_nouveau_group_hook( '', 'options_nav' ); ?>

		</ul>

	<?php endif; ?>

</nav>
