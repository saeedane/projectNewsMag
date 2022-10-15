<?php
$related_tax = newsy_get_option( 'post_related_type', 'category' );

if ( 'hide' !== $related_tax ) {
	$taxs = array();

	if ( ! taxonomy_exists( $related_tax ) ) {
		$related_tax = 'category';
	}

	$result = get_the_terms( get_the_ID(), $related_tax );

	if ( $result && count( $result ) > 0 ) {
		foreach ( $result as $tax ) {
			$taxs[] = $related_tax . ':' . $tax->term_id;
		}
	}

	$post_per_page = newsy_amp_get_option( 'newsy_single_number_post_related', 6 );
	$related_amp   = '';

	$atts = array(
		'count'             => $post_per_page,
		'post'              => '-' . get_the_ID(), // exclade cuurent post
		'taxonomy'          => implode( ',', $taxs ),
		'taxonomy_relation' => 'OR',
	);

	$block_query = ak_do_query( $atts );

	if ( ! empty( $block_query->posts ) ) {
		$related_content = '';

		foreach ( $block_query->posts as $content ) {
			$author      = $content->post_author;
			$author_name = get_the_author_meta( 'display_name', $author );
			$date        = sprintf( ak_get_translation( '%s ago', 'newsy-amp', 'readable_time_ago' ), ak_ago_time( get_the_time( 'U', $content->ID ) ) );
			$image       = '';

			if ( has_post_thumbnail( $content->ID ) ) {
				$image = get_the_post_thumbnail_url( $content->ID, 'newsy_350x250' );
				$image = "<amp-img src='{$image}' width='120' height='86' layout='responsive' class='amp-related-image'></amp-img>";
			}

			$author           = sprintf( ak_get_translation( 'By %s', 'newsy-amp', 'by' ), '<span class="amp-related-author">' . $author_name . '</span>' );
			$related_content .=
				"<li class='amp-related-content'>
					{$image}
					<div class='amp-related-text'>
						<h3><a href='" . get_permalink( $content->ID ) . "'>{$content->post_title}</a></h3>
						<div class='amp-related-meta'>
							{$author}
							<span class='amp-related-date'>{$date}</span>
						</div>
					</div>
				</li>";
		}

		$related_amp =
			"<div class='amp-related-wrapper'>
				<h2>" . ak_get_translation( 'Related Content', 'newsy-amp', 'related_content' ) . "</h2>
				<ul class='amp-related-posts'>{$related_content}</ul>
			</div>";
	}

	echo $related_amp;
}
