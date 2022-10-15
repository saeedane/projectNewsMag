<?php
/**
 * BuddyPress - Users Friends
 *
 * @since 3.0.0
 * @version 3.0.0
 */
?>
<div id="subnav-header">
	<div class="row">
		<div class="col-md-8">
		<nav class="<?php bp_nouveau_single_item_subnav_classes(); ?>" id="subnav" role="navigation" aria-label="<?php esc_attr_e( 'Friends menu', 'buddypress' ); ?>">
			<ul class="subnav">
				<?php if ( bp_is_my_profile() ) : ?>

					<?php bp_get_template_part( 'members/single/parts/item-subnav' ); ?>

				<?php endif; ?>
			</ul>
		</nav><!-- .bp-navs -->
		</div>
		<div class="col-md-4">
		<?php bp_get_template_part( 'common/search-and-filters-bar' ); ?>

		</div>
	</div>
</div>

<?php
switch ( bp_current_action() ) :

	// Home/My Friends
	case 'my-friends':
		bp_nouveau_member_hook( 'before', 'friends_content' );
		?>

		<div class="members friends" data-bp-list="members">

			<div id="bp-ajax-loader"><?php bp_nouveau_user_feedback( 'member-friends-loading' ); ?></div>

		</div><!-- .members.friends -->

		<?php
		bp_nouveau_member_hook( 'after', 'friends_content' );
		break;

	case 'requests':
		bp_get_template_part( 'members/single/friends/requests' );
		break;

	// Any other
	default:
		bp_get_template_part( 'members/single/plugins' );
		break;
endswitch;
