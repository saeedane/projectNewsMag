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
<?php
ak_get_breadcrumb(
	array(
		'before' => '<div class="container">',
		'after'  => '</div>',
		'echo'   => true,
	),
	'buddypress'
);

$template = 'member-header';

if ( bp_displayed_user_use_cover_image_header() ) {
	$template = 'cover-image-header';
}

	/**
	 * Fires before the display of a member's header.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_before_member_header' );

	// Get the template part for the header
	bp_nouveau_member_get_template_part( $template );

	/**
	 * Fires after the display of a member's header.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_after_member_header' );

?>

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

					<?php bp_nouveau_member_template_part(); ?>

				</div><!-- #item-body -->
			</div>
		</div>
	</div>
</div><!-- // .bp-wrap -->

<?php bp_nouveau_member_hook( 'after', 'home_content' ); ?>
