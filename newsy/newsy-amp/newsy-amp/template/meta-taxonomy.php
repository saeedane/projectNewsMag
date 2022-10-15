<?php $tags = get_the_tag_list( '', ' ' ); ?>
<?php if ( $tags && ! is_wp_error( $tags ) ) : ?>
	<li class="amp-wp-tax-tag">
		<span class="screen-reader-text"><?php ak_echo_translation( 'Tags:', 'newsy-amp', 'tags' ); ?></span>
		<?php echo $tags; ?>
	</li>
<?php endif; ?>
