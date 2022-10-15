<form role="search" method="get" class="ak_search_form clearfix" action="<?php echo esc_url( home_url() ); ?>" target="_top">
	<input type="text" class="search-field" placeholder="<?php newsy_echo_translation( 'Search...', 'newsy', 'search_input_text' ); ?>" value="<?php echo esc_html( get_search_query() ); ?>" name="s" autocomplete="off">
	<button type="submit" class="btn search-submit"><i class="fa fa-search"></i></button>
</form><!-- .search-form -->
