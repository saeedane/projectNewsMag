<?php
/**
 * BuddyPress - Users Notifications
 *
 * @since 3.0.0
 * @version 3.0.0
 */
?>
<div id="subnav-header">
	<div class="row">
		<div class="col-md-8">
		<nav class="<?php bp_nouveau_single_item_subnav_classes(); ?>" id="subnav" role="navigation" aria-label="<?php esc_attr_e( 'Notifications menu', 'buddypress' ); ?>">
			<ul class="subnav">

				<?php bp_get_template_part( 'members/single/parts/item-subnav' ); ?>

			</ul>
		</nav>
		</div>
		<div class="col-md-4">
		<?php bp_get_template_part( 'common/search-and-filters-bar' ); ?>

		</div>
	</div>
</div>

<?php
switch ( bp_current_action() ) :

	case 'unread':
	case 'read':
		?>


		<div id="notifications-user-list" class="notifications dir-list" data-bp-list="notifications">
			<div id="bp-ajax-loader"><?php bp_nouveau_user_feedback( 'member-notifications-loading' ); ?></div>
		</div><!-- #groups-dir-list -->

		<?php
		break;

	// Any other actions.
	default:
		bp_get_template_part( 'members/single/plugins' );
		break;
endswitch;
