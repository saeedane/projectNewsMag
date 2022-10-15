<?php
/**
 * BuddyPress - Groups Header item-actions.
 *
 * @since 3.0.0
 * @version 3.1.0
 */
?>
<div id="item-actions" class="group-item-actions">

	<?php if ( bp_current_user_can( 'groups_access_group' ) ) : ?>

		<dl class="moderators-lists">
			<dt class="moderators-title"><?php newsy_echo_translation( 'Group Administrators', 'newsy', 'group_admins' ); ?></dt>
			<dd class="user-list admins"><?php bp_group_list_admins(); ?>
				<?php bp_nouveau_group_hook( 'after', 'menu_admins' ); ?>
			</dd>
		</dl>

		<?php
		if ( bp_group_has_moderators() ) :
			bp_nouveau_group_hook( 'before', 'menu_mods' );
			?>

			<dl class="moderators-lists">
				<dt class="moderators-title"><?php newsy_echo_translation( 'Group Mods', 'newsy', 'group_mods' ); ?></dt>
				<dd class="user-list moderators">
					<?php
					bp_group_list_mods();
					bp_nouveau_group_hook( 'after', 'menu_mods' );
					?>
				</dd>
			</dl>

		<?php endif; ?>

		<?php
		if ( bp_group_has_members( 'max=15' ) ) :
			?>
			<dl  class="item-list">
				<dt class="members-title"><?php newsy_echo_translation( 'Group Members', 'newsy', 'group_members' ); ?></dt>
				<dd class="user-list members">
					<ul>
						<?php
						while ( bp_group_members() ) :
							bp_group_the_member();
							?>
							<li>
							<a href="<?php echo bp_get_group_member_url(); ?>">
								<?php bp_group_member_avatar_mini( 40, 40 ); ?>
							</a>
							</li>
						<?php endwhile; ?>
					</ul>
				<dd>
			</dl>
		<?php endif; ?>

	<?php endif; ?>

</div><!-- .item-actions -->
