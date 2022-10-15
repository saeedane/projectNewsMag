<?php
/**
 * BuddyPress - Users Activity
 *
 * @since 3.0.0
 * @version 3.0.0
 */

?>
<div id="subnav-header">
	<div class="ak-row ak-row-responsive">
		<div class="ak-column ak-column-grow">
			<nav class=" <?php bp_nouveau_single_item_subnav_classes(); ?>" id="subnav" role="navigation" aria-label="<?php esc_attr_e( 'Activity menu', 'buddypress' ); ?>">
				<ul class="subnav">
					<?php bp_get_template_part( 'members/single/parts/item-subnav' ); ?>
				</ul>
			</nav><!-- .item-list-tabs#subnav -->
		</div>
		<div class="ak-column ak-column-normal">
			<div class="select-wrap">
				<select id="<?php bp_nouveau_filter_id(); ?>" data-bp-filter="<?php bp_nouveau_filter_component(); ?>">
					<?php bp_nouveau_filter_options(); ?>
				</select>
				<span class="select-arrow" aria-hidden="true"></span>
			</div>
		</div>
	</div>
</div>

<?php bp_nouveau_activity_member_post_form(); ?>

<?php bp_nouveau_member_hook( 'before', 'activity_content' ); ?>

<div id="activity-stream" class="activity single-user" data-bp-list="activity">

	<div id="bp-ajax-loader"><?php bp_nouveau_user_feedback( 'member-activity-loading' ); ?></div>

	<ul  class="<?php bp_nouveau_loop_classes(); ?>" ></ul>

</div><!-- .activity -->

<?php
bp_nouveau_member_hook( 'after', 'activity_content' );
