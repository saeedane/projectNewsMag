<?php
/**
 * BuddyPress - Groups Activity
 *
 * @since 3.0.0
 * @version 3.1.0
 */

?>


<?php bp_nouveau_groups_activity_post_form(); ?>

<div class="subnav-filters filters clearfix">

	<ul>

		<li class="group-act-search"><?php bp_nouveau_search_form(); ?></li>

	</ul>

	<?php bp_get_template_part( 'common/filters/groups-screens-filters' ); ?>
</div><!-- // .subnav-filters -->

<?php bp_nouveau_group_hook( 'before', 'activity_content' ); ?>

<div id="activity-stream" class="activity single-group" data-bp-list="activity">

	<div id="bp-ajax-loader"><?php bp_nouveau_user_feedback( 'group-activity-loading' ); ?></div>

	<ul  class="<?php bp_nouveau_loop_classes(); ?>" >

	</ul>

</div><!-- .activity -->


<?php
bp_nouveau_group_hook( 'after', 'activity_content' );
