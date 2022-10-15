<?php
/**
 * Archive Forum Content Part
 *
 * @package    bbPress
 * @subpackage newsy
 */

?>
<div id="bbpress-forums">
	<?php if ( bbp_allow_search() ) : ?>
			<?php bbp_get_template_part( 'form', 'search' ); ?>
		<?php
	endif;

	bbp_forum_subscription_link();

	do_action( 'bbp_template_before_forums_index' );

	if ( bbp_has_forums() ) {
		bbp_get_template_part( 'loop', 'forums' );
	} else {
		bbp_get_template_part( 'feedback', 'no-forums' );
	}

	do_action( 'bbp_template_after_forums_index' );
	?>
</div>
