<?php
/**
 * BuddyPress - Groups Cover Image Header.
 *
 * @since 3.0.0
 * @version 3.1.0
 */
?>

<div id="cover-image-container">
	<div id="header-cover-image"></div>

	<div id="item-header-cover-image"></div><!-- #item-header-cover-image -->

	<div class="ak-bp-item-header">
		<div class="ak-bp-item-header-bg"></div><!-- .ak-bp-item-header-bg -->
		<div class="container">

			<div class="row item-header-row">

				<div class="col-md-3">

					<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
					<div id="item-header-avatar">
						<a href="<?php echo esc_url( bp_get_group_permalink() ); ?>" title="<?php echo esc_attr( bp_get_group_name() ); ?>">

							<?php bp_group_avatar(); ?>

						</a>
					</div><!-- #item-header-avatar -->
				<?php endif; ?>

				</div>

				<div class="col-md-9">

					<div class="item-header-body">
						<div class="item-header-body-main">
							<div class="item-header-top">
								<h1 class="item-header-title">
									<?php bp_group_name(); ?>
									<?php do_action( 'newsy_buddypress_groups_after_group_name' ); ?>
								</h1>
							</div>
							<?php do_action( 'newsy_buddypress_members_after_title', bp_displayed_user_id() ); ?>

							<div class="item-header-bottom">
								<span class="highlight group-status"><strong><?php echo esc_html( bp_nouveau_the_group_meta( array( 'keys' => 'status' ) ) ); ?></strong></span>
								<span class="dot">-</span>
								<span class="activity" data-livestamp="<?php bp_core_iso8601_date( bp_get_group_last_active( 0, array( 'relative' => false ) ) ); ?>">
									<?php
									/* translators: %s = last activity timestamp (e.g. "active 1 hour ago") */
									printf( newsy_get_translation( 'active %s', 'newsy', 'active_s' ), bp_get_group_last_active() );
									?>
								</span>
							</div>

						</div>
						<div class="item-header-body-side">

							<div id="item-header-buttons" class="dark">
								<?php bp_nouveau_group_header_buttons(); ?>
							</div><!-- #item-header-buttons -->

						</div>

					</div>

				</div>

			</div><!-- .row -->

		</div><!-- .container -->

	</div><!-- .ak-bp-item-header -->

</div><!-- #cover-image-container -->

