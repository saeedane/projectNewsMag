<?php
/**
 * BuddyPress - Groups Home
 *
 * @since 3.0.0
 * @version 3.0.0
 */

if ( bp_has_groups() ) :
	while ( bp_groups() ) :
		bp_the_group();
		?>

		<?php bp_nouveau_group_hook( 'before', 'home_content' ); ?>

	<div id="item-header" role="complementary" data-bp-item-id="<?php bp_group_id(); ?>" data-bp-item-component="groups" class="groups-header single-headers">
		<?php
		ak_get_breadcrumb(
			array(
				'before' => '<div class="container">',
				'after'  => '</div>',
				'echo'   => true,
			),
			'buddypress'
		);
		?>
		<?php bp_nouveau_group_header_template_part(); ?>

	</div><!-- #item-header -->

	<div class="bp-nav">
		<div class="container">

			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-9">
				<?php if ( ! bp_nouveau_is_object_nav_in_sidebar() ) : ?>

						<?php bp_get_template_part( 'groups/single/parts/item-nav' ); ?>

					<?php endif; ?>
				</div>

			</div>
		</div>
	</div>

	<div class="bp-wrap">

		<div class="container">
			<div class="row">

				<div class="col-sm-3 bp-sidebar item-sidebar-info">
					<div id="item-sidebar" class="item-sidebar">

					<?php if ( ! bp_nouveau_groups_front_page_description() ) : ?>
						<?php if ( ! empty( bp_nouveau_the_group_meta( array( 'keys' => 'description' ) ) ) ) : ?>
								<div class="group-description">
									<?php echo bp_nouveau_the_group_meta( array( 'keys' => 'description' ) ); ?>
								</div><!-- //.group_description -->
						<?php endif; ?>
					<?php endif; ?>

					<?php echo bp_nouveau_the_group_meta( array( 'keys' => 'group_type_list' ) ); ?>

					<?php bp_nouveau_group_hook( 'before', 'header_meta' ); ?>

					<?php if ( bp_nouveau_group_has_meta_extra() ) : ?>
							<div class="item-meta">

								<?php echo bp_nouveau_the_group_meta( array( 'keys' => 'extra' ) ); ?>

							</div><!-- .item-meta -->
						<?php endif; ?>

					<?php bp_get_template_part( 'groups/single/parts/header-item-actions' ); ?>

					</div><!-- #item-header-info -->
				</div>
				<div class="col-sm-9  bp-body">
					<?php bp_nouveau_template_notices(); ?>

					<div id="item-body" class="item-body clearfix">

					<?php bp_nouveau_group_template_part(); ?>


					</div><!-- #item-body -->

				</div>

			</div><!-- .row -->
		</div><!-- .container -->

	</div><!-- // .bp-wrap -->

		<?php bp_nouveau_group_hook( 'after', 'home_content' ); ?>

	<?php endwhile; ?>

	<?php
endif;
