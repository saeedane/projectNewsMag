<?php
/**
 * BuddyPress - Members Home
 *
 * @since   1.0.0
 * @version 3.0.0
 */
?>


<?php if ( get_the_author_meta( 'description', bp_displayed_user_id() ) ) : ?>
<div class="member-description">
	<?php bp_nouveau_member_description( bp_displayed_user_id() ); ?>

	<?php
	if ( bp_is_my_profile() ) :

		bp_nouveau_member_description_edit_link();

	endif;
	?>
</div><!-- .member-description -->
<?php endif; ?>



<?php do_action( 'newsy_bp_members_user_sidebar_before' ); ?>

<?php
if ( function_exists( 'bp_get_follower_ids' ) ) {

	// logged-in user isn't following anyone, so stop!
	$followers = bp_get_follower_ids( array( 'user_id' => bp_displayed_user_id() ) );

	// show the users the logged-in user is following
	if ( bp_has_members(
		array(
			'include'         => $followers,
			'max'             => 15,
			'populate_extras' => false,
		)
	) ) {
		?>
	<div class="bp-userlist">
		<div class="sidebar-item-header"><?php newsy_echo_translation( 'Followers', 'newsy', 'followers' ); ?></div>
		<div class="sidebar-item-content">
			<ul class="user-list">
				<?php
				while ( bp_members() ) :
					bp_the_member();
					?>
					<li>
					<a href="<?php bp_member_permalink(); ?>" title="<?php bp_member_name(); ?>">
						<?php
						bp_member_avatar(
							array(
								'width'  => 40,
								'height' => 40,
							)
						);
						?>
					</a>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
		<?php
	}

	// logged-in user isn't following anyone, so stop!
	$following = bp_get_following_ids( array( 'user_id' => bp_displayed_user_id() ) );

	// show the users the logged-in user is following
	if ( bp_has_members(
		array(
			'include'         => $following,
			'max'             => 15,
			'populate_extras' => false,
		)
	) ) {
		?>
	<div class="bp-userlist">
		<div class="sidebar-item-header"><?php newsy_echo_translation( 'Following', 'newsy', 'following' ); ?></div>
		<div class="sidebar-item-content">
			<ul class="user-list">
				<?php
				while ( bp_members() ) :
					bp_the_member();
					?>
					<li>
					<a href="<?php bp_member_permalink(); ?>" title="<?php bp_member_name(); ?>">
						<?php
						bp_member_avatar(
							array(
								'width'  => 40,
								'height' => 40,
							)
						);
						?>
					</a>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
		<?php
	}
}
?>

<?php do_action( 'newsy_bp_members_user_sidebar_after' ); ?>
