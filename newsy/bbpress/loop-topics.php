<?php
/**
 * Topics Loop
 *
 * @package    bbPress
 * @subpackage newsy
 */

do_action( 'bbp_template_before_topics_loop' );

?>
	<ul id="bbp-forum-<?php bbp_forum_id(); ?>" class="bbp-topics">

		<li class="bbp-body">

			<div class="category-forum">
				<ul>
					<li class="bbp-header">

						<ul class="forum-titles forum-topics-list">
							<li class="bbp-topic-title"><?php newsy_echo_translation( 'Topics', 'newsy', 'bbp_topics' ); ?></li>
							<li class="bbp-topic-reply-posts-count"><?php newsy_echo_translation( 'Voices', 'newsy', 'bbp_voices' ); ?>
								/ <?php bbp_show_lead_topic() ? newsy_echo_translation( 'Replies', 'newsy', 'bbp_replies' ) : newsy_echo_translation( 'Posts', 'newsy', 'bbp_posts' ); ?></li>
						</ul>

					</li>
				</ul>
			</div>
			<?php
			while ( bbp_topics() ) :
				bbp_the_topic();
				?>

				<?php bbp_get_template_part( 'loop', 'single-topic' ); ?>

			<?php endwhile; ?>

		</li>

	</ul>

<?php do_action( 'bbp_template_after_topics_loop' ); ?>
