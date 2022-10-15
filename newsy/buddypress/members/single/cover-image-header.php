<?php
/**
 * BuddyPress - Users Cover Image Header
 *
 * @since 3.0.0
 * @version 3.0.0
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

					<div id="item-header-avatar">
						<a href="<?php bp_displayed_user_link(); ?>">

						<?php

						bp_displayed_user_avatar( 'type=full' );

						do_action( 'newsy_bp_members_avatar_after', bp_displayed_user_id() );

						?>

						</a>
					</div>

				</div>

				<div class="col-md-9">

					<div class="item-header-body">
						<div class="item-header-body-main">
							<div class="item-header-top">
								<h1 class="item-header-title">
									<?php bp_displayed_user_fullname(); ?>
								</h1>
								<?php
								if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() ) :
									?>
									<span class="item-user-nicename">@<?php bp_displayed_user_mentionname(); ?></span>
									<?php
								endif;
								?>

								<?php do_action( 'newsy_bp_members_after_user_name', bp_displayed_user_id() ); ?>
							</div>

							<div class="item-header-bottom">

								<?php bp_nouveau_member_hook( 'before', 'header_meta' ); ?>

								<?php if ( bp_nouveau_member_has_meta() ) : ?>

									<?php bp_nouveau_member_meta(); ?>

								<?php endif; ?>

							</div>

						</div>
						<div class="item-header-body-side">

							<?php do_action( 'newsy_bp_members_header_side', bp_displayed_user_id() ); ?>

						</div>

						<div id="item-header-buttons" class="dark">
								<?php
								bp_nouveau_member_header_buttons(
									array(
										'container'      => 'div',
										'button_element' => 'a',
										'container_classes' => array( 'member-header-actions' ),
									)
								);
								?>
						</div><!-- #item-header-buttons -->

					</div>

				</div>

			</div><!-- .row -->

		</div><!-- .container -->

	</div><!-- .ak-bp-item-header -->

</div><!-- #cover-image-container -->

