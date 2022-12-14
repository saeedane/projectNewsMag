<?php
/**
 * Search Loop - Single Topic
 *
 * @package    bbPress
 * @subpackage newsy
 */

?>
<ul id="bbp-topic-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>

	<li class="bbp-topic-freshness">

		<p class="bbp-topic-meta bbp-topic-avatars-meta">
			<?php do_action( 'bbp_theme_before_topic_freshness_author' ); ?>

			<span class="bbp-topic-author">
			<?php
			bbp_topic_author_link(
				array(
					'type' => 'avatar',
					'size' => 60,
				)
			);
			?>
			</span>

			<?php if ( bbp_get_topic_post_count() > 1 ) { ?>
				<span class="bbp-topic-freshness-author">
				<?php
				bbp_author_link(
					array(
						'type'    => 'avatar',
						'post_id' => bbp_get_topic_last_active_id(),
						'size'    => 30,
					)
				);
				?>
															</span>
				<?php
			}

			do_action( 'bbp_theme_after_topic_freshness_author' );
			?>
		</p>

	</li>

	<li class="bbp-topic-title">

		<?php if ( bbp_is_user_home() ) : ?>

			<?php if ( bbp_is_favorites() ) : ?>

				<span class="bbp-row-actions">

					<?php do_action( 'bbp_theme_before_topic_favorites_action' ); ?>

					<?php
					bbp_topic_favorite_link(
						array(
							'before'    => '',
							'favorite'  => '+',
							'favorited' => '&times;',
						)
					);
					?>

					<?php do_action( 'bbp_theme_after_topic_favorites_action' ); ?>

				</span>

			<?php elseif ( bbp_is_subscriptions() ) : ?>

				<span class="bbp-row-actions">

					<?php do_action( 'bbp_theme_before_topic_subscription_action' ); ?>

					<?php
					bbp_topic_subscription_link(
						array(
							'before'      => '',
							'subscribe'   => '+',
							'unsubscribe' => '&times;',
						)
					);
					?>

					<?php do_action( 'bbp_theme_after_topic_subscription_action' ); ?>

				</span>

			<?php endif; ?>

		<?php endif; ?>

		<?php do_action( 'bbp_theme_before_topic_title' ); ?>

		<span class="bbp-topic-title"><a class="bbp-topic-permalink" href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a></span>

		<?php do_action( 'bbp_theme_after_topic_title' ); ?>

		<?php bbp_topic_pagination(); ?>

		<?php do_action( 'bbp_theme_before_topic_meta' ); ?>

		<p class="bbp-topic-meta">

			<?php do_action( 'bbp_theme_before_topic_started_by' ); ?>

			<span
				class="bbp-topic-started-by"><?php printf( _x( 'Started by: %1$s', 'bbpress', 'newsy' ), bbp_get_topic_author_link( array( 'type' => 'name' ) ) ); ?></span>

			<?php do_action( 'bbp_theme_after_topic_started_by' ); ?>

			<?php if ( ! bbp_is_single_forum() || ( bbp_get_topic_forum_id() !== bbp_get_forum_id() ) ) : ?>

				<?php do_action( 'bbp_theme_before_topic_started_in' ); ?>

				<span class="bbp-topic-started-in"><?php printf( _x( 'in: <a href="%1$s">%2$s</a>', 'bbpress', 'newsy' ), bbp_get_forum_permalink( bbp_get_topic_forum_id() ), bbp_get_forum_title( bbp_get_topic_forum_id() ) ); ?></span>

				<?php do_action( 'bbp_theme_after_topic_started_in' ); ?>

			<?php endif; ?>


			<span class="last-post">
				<?php _ex( 'Last post:', 'bbpress', 'newsy' ); ?> <?php
				bbp_author_link(
					array(
						'post_id' => bbp_get_topic_last_active_id(),
						'type'    => 'name',
					)
				);
				?>

				&mdash;

				<?php do_action( 'bbp_theme_before_topic_freshness_link' ); ?>

				<span class="freshness_link"><?php bbp_topic_freshness_link(); ?></span>

				<?php do_action( 'bbp_theme_after_topic_freshness_link' ); ?>
			</span>

		</p>

		<?php do_action( 'bbp_theme_after_topic_meta' ); ?>

		<?php bbp_topic_row_actions(); ?>

	</li>


	<li class="bbp-topic-reply-posts-count">
		<span class="count"><strong><?php bbp_topic_voice_count(); ?></strong> <?php newsy_echo_translation( 'Voices', 'newsy', 'bbp_voices' ); ?></span>
		<?php echo bbp_show_lead_topic() ? '<span class="count"><strong>' . bbp_get_topic_reply_count() . '</strong> ' . newsy_get_translation( 'Replies', 'newsy', 'bbp_replies' ) . '</span> ' : '<span class="count"><strong>' . bbp_get_topic_reply_count_hidden() . '</strong> ' . newsy_get_translation( 'Posts', 'newsy', 'bbp_posts' ) . '</span> '; ?>
	</li>


</ul><!-- #bbp-topic-<?php bbp_topic_id(); ?> -->
