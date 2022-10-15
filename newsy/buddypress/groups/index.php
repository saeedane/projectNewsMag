<?php
/**
 * BP Nouveau - Groups Directory
 *
 * @since 3.0.0
 * @version 3.0.0
 */
?>
<div class="container">
	<?php bp_nouveau_before_groups_directory_content(); ?>

	<div class="bp-page-header">

		<div class="bp-nav clearfix">
			<?php if ( ! bp_nouveau_is_object_nav_in_sidebar() ) : ?>

				<?php bp_get_template_part( 'common/nav/directory-nav' ); ?>

			<?php endif; ?>
		</div>

		<?php bp_get_template_part( 'common/search-and-filters-bar' ); ?>

	</div><!-- // .screen-content -->

	<div class="screen-content">

		<div id="groups-dir-list" class="groups dir-list" data-bp-list="groups">
			<div id="bp-ajax-loader"><?php bp_nouveau_user_feedback( 'directory-groups-loading' ); ?></div>
		</div><!-- #groups-dir-list -->

		<?php bp_nouveau_after_groups_directory_content(); ?>
	</div><!-- // .screen-content -->
</div><!-- // .container -->
