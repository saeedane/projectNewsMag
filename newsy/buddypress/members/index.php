<?php
/**
 * BuddyPress Members Directory
 *
 * @version 3.0.0
 */

?>

<div class="container">
	<?php bp_nouveau_before_members_directory_content(); ?>

	<div class="bp-page-header">

		<div class="bp-nav clearfix">
			<?php if ( ! bp_nouveau_is_object_nav_in_sidebar() ) : ?>

				<?php bp_get_template_part( 'common/nav/directory-nav' ); ?>

			<?php endif; ?>
		</div>

		<?php bp_get_template_part( 'common/search-and-filters-bar' ); ?>

	</div><!-- // .screen-content -->


	<div class="screen-content">

		<div id="members-dir-list" class="members dir-list" data-bp-list="members">
			<div id="bp-ajax-loader"><?php bp_nouveau_user_feedback( 'directory-members-loading' ); ?></div>
		</div><!-- #members-dir-list -->

		<?php bp_nouveau_after_members_directory_content(); ?>
	</div><!-- // .screen-content -->
</div><!-- // .container -->
