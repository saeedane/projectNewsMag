<?php
/**
 * Forums Loop
 *
 * @package    bbPress
 * @subpackage newsy
 */

?>

<?php do_action( 'bbp_template_before_forums_loop' ); ?>

	<ul id="forums-list-<?php bbp_forum_id(); ?>" class="bbp-forums">

		<li class="bbp-body">
			<?php
			while ( bbp_forums() ) :
				bbp_the_forum();
				?>

				<?php if ( bbp_is_forum_category() && ! bbp_get_forum_parent_id() ) { ?>

					<div class="category-forum">
						<ul>
							<li class="bbp-header">
								<ul class="forum-titles">
									<li class="bbp-forum-info"><a
											href="<?php echo bbp_get_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a>
									</li>
									<li class="bbp-forum-topic-reply-count"><?php newsy_echo_translation( 'Topics', 'newsy', 'bbp_topics' ); ?>
										/
										<?php
										bbp_show_lead_topic() ? newsy_echo_translation( 'Replies', 'newsy', 'bbp_replies' ) : newsy_echo_translation( 'Posts', 'newsy', 'bbp_posts' );
										?>
										</li>
									<li class="bbp-forum-freshness"><?php newsy_echo_translation( 'Last Activate', 'newsy', 'bbp_last_activate' ); ?></li>
								</ul>
							</li>
						</ul>
					</div>

					<?php

					$main_query = clone bbpress()->forum_query;

					bbp_has_forums(
						array(
							'post_parent' => bbp_get_forum_id(),
						)
					);

					while ( bbp_forums() ) {

						bbp_the_forum();
						bbp_get_template_part( 'loop', 'single-forum' );

					}

					bbpress()->forum_query = $main_query;

				} else {

					bbp_get_template_part( 'loop', 'single-forum' );

				}

			endwhile;
			?>
		</li>
	</ul>
<?php do_action( 'bbp_template_after_forums_loop' ); ?>
