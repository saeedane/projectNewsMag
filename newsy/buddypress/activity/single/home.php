<?php
/**
 * BuddyPress - Members Home
 *
 * @since   1.0.0
 * @version 3.0.0
 */
?>

<?php bp_nouveau_member_hook( 'before', 'home_content' ); ?>

<div id="item-header" role="complementary" data-bp-item-id="<?php echo esc_attr( bp_displayed_user_id() ); ?>" data-bp-item-component="members" class="users-header single-headers">

<?php bp_nouveau_member_header_template_part(); ?>

</div><!-- #item-header -->

<div class="bp-nav">
	<div class="container">

		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-9">
				<?php if ( ! bp_nouveau_is_object_nav_in_sidebar() ) : ?>

					<?php bp_get_template_part( 'members/single/parts/item-nav' ); ?>

				<?php endif; ?>
			</div>

		</div>
	</div>
</div>

<div class="bp-wrap">

	<div class="container">

		<div class="row">

			<div class="col-sm-3 bp-sidebar item-sidebar-info">
				<div id="item-sidebar" class="item-sidebar clearfix">
					<?php bp_get_template_part( 'members/single/parts/member-sidebar' ); ?>
				</div>
			</div>
			<div class="col-sm-9 bp-body">

				<?php bp_nouveau_template_notices(); ?>

				<div id="item-body" class="item-body clearfix">

					<div  id="activity-stream" class="activity single-user" data-bp-single="<?php echo esc_attr( bp_current_action() ); ?>" data-bp-list="activity">

						<ul class="activity-list item-list bp-list" >

							<li id="bp-ajax-loader"><?php bp_nouveau_user_feedback( 'single-activity-loading' ); ?></li>

						</ul>

					</div>

				</div><!-- #item-body -->

			</div>

		</div>
	</div>

</div><!-- // .bp-wrap -->

<?php bp_nouveau_member_hook( 'after', 'home_content' ); ?>
