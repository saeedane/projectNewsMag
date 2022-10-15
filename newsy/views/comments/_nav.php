<?php

// Nav texts with RTL support
if ( is_rtl() ) {
	$prev = newsy_get_translation( 'Next', 'newsy', 'comment_next' ) . ' <i class="fa fa-angle-double-right"></i>';
	$next = '<i class="fa fa-angle-double-left"></i> ' . newsy_get_translation( 'Prev', 'newsy', 'comment_previous' );
} else {
	$next = '<i class="fa fa-angle-double-left"></i> ' . newsy_get_translation( 'Next', 'newsy', 'comment_next' );
	$prev = newsy_get_translation( 'Prev', 'newsy', 'comment_previous' ) . ' <i class="fa fa-angle-double-right"></i>';
}

// Check for paged comments.
if ( get_option( 'page_comments' ) && 1 < get_comment_pages_count() ) : ?>

	<div class="comments-nav">
		<div class="comments-nav-wrap clearfix">

			<?php next_comments_link( $next ); ?>

			<span class="page-numbers"><?php printf( newsy_get_translation( 'Comments %s', 'newsy', 'comment_page_numbers' ), get_query_var( 'cpage' ) ? absint( get_query_var( 'cpage' ) ) : 1, get_comment_pages_count() ); ?></span>

			<?php previous_comments_link( $prev ); ?>

		</div><!-- .comments-nav-wrap -->
	</div><!-- .comments-nav -->

<?php endif; ?>
