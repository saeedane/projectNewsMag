<li class="amp-wp-posted-on">
	<time datetime="<?php echo esc_attr( date( 'c', $this->get( 'post_publish_timestamp' ) ) ); ?>">
		<?php
		echo esc_html(
			sprintf( ak_get_translation( '%s ago', 'newsy-amp', 'readable_time_ago' ), ak_ago_time( get_the_time( 'U', get_the_ID() ) ) )
		);
		?>
	</time>
</li>
