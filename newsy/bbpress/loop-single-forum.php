<?php
/**
 * Forums Loop - Single Forum
 *
 * @package    bbPress
 * @subpackage newsy
 */

$class = array();
if ( bbpress()->forum_query->current_post + 1 == bbpress()->forum_query->post_count && bbpress()->forum_query->post_count > 0 ) {
	$class[] = 'last-forum';
}

?>
<ul id="bbp-forum-<?php bbp_forum_id(); ?>" <?php bbp_forum_class( 0, $class ); ?>>

	<li class="bbp-forum-info single-forum-info">

		<?php if ( bbp_is_user_home() && bbp_is_subscriptions() ) : ?>

			<span class="bbp-row-actions">

				<?php do_action( 'bbp_theme_before_forum_subscription_action' ); ?>

				<?php
				bbp_forum_subscription_link(
					array(
						'before'      => '',
						'subscribe'   => '+',
						'unsubscribe' => '&times;',
					)
				);
				?>

				<?php do_action( 'bbp_theme_after_forum_subscription_action' ); ?>

			</span>

		<?php endif; ?>

		<?php do_action( 'bbp_theme_before_forum_title' ); ?>

		<a class="bbp-forum-title" href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a>

		<?php do_action( 'bbp_theme_after_forum_title' ); ?>

		<?php do_action( 'bbp_theme_before_forum_description' ); ?>

		<div class="bbp-forum-content the-content"><?php bbp_forum_content(); ?></div>

		<?php do_action( 'bbp_theme_after_forum_description' ); ?>

		<?php do_action( 'bbp_theme_before_forum_sub_forums' ); ?>

		<?php bbp_list_forums(); ?>

		<?php do_action( 'bbp_theme_after_forum_sub_forums' ); ?>

		<?php bbp_forum_row_actions(); ?>

	</li>

	<li class="bbp-forum-topic-reply-count">
		<span class="count"><strong><?php bbp_forum_topic_count(); ?></strong> <?php newsy_echo_translation( 'Topics', 'newsy', 'bbp_topics' ); ?></span>
		<?php echo bbp_show_lead_topic() ? '<span class="count"><strong>' . bbp_get_forum_reply_count() . '</strong> ' . newsy_get_translation( 'Replies', 'newsy', 'bbp_replies' ) . '</span> ' : '<span class="count"><strong>' . bbp_get_forum_post_count() . '</strong> ' . newsy_get_translation( 'Posts', 'newsy', 'bbp_posts' ) . '</span> '; ?>
	</li>

	<li class="bbp-forum-freshness">

		<p class="bbp-topic-meta clearfix">

			<?php do_action( 'bbp_theme_before_topic_author' ); ?>

			<span class="bbp-topic-freshness-author">
			<?php
			echo bbp_get_author_link(
				array(
					'post_id' => bbp_get_forum_last_active_id(),
					'size'    => 60,
				)
			) ? newsy_get_translation( 'by', 'newsy', 'bbp_by' ) . ' ' . bbp_get_author_link(
				array(
					'post_id' => bbp_get_forum_last_active_id(),
					'size'    => 60,
				)
			) : '';
			?>
					</span>

			<?php do_action( 'bbp_theme_after_topic_author' ); ?>

			<?php do_action( 'bbp_theme_before_forum_freshness_link' ); ?>

			<span class="freshness_link"><?php bbp_forum_freshness_link(); ?></span>

			<?php do_action( 'bbp_theme_after_forum_freshness_link' ); ?>

		</p>
	</li>

</ul>
