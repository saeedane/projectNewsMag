<?php
$the_post = Newsy\Single\SinglePost::get_instance();
?>
<div class="ak-post-meta meta-style-3">
		<?php $the_post->get_meta_author_avatar( 24 ); ?>

		<div class="ak-post-meta-left">
		<?php $the_post->get_meta_author(); ?>

		<?php $the_post->get_meta_date(); ?>

		<?php do_action( 'newsy_single_post_meta_right_before', $the_post->id ); ?>
		<?php $the_post->get_meta_comments(); ?>
		<?php $the_post->get_meta_views(); ?>
		<?php do_action( 'newsy_single_post_meta_right_after', $the_post->id ); ?>
		</div>
</div>
