<footer class="amp-wp-footer">
	<div class="amp-wp-footer-inner">
		<a href="#top" class="back-to-top"><?php ak_echo_translation( 'Back to top', 'newsy-amp', 'back_to_top' ); ?></a>

		<p class="copyright">
			<?php
			if ( function_exists( 'newsy_get_copyright_text' ) ) {
				$copyright = newsy_get_copyright_text();
				echo wp_kses( do_shortcode( $copyright ), wp_kses_allowed_html() );
			}
			?>
		</p>

		<div class="amp-wp-social-footer">
			<?php
			if ( function_exists( 'newsy_social_counter_render' ) ) {
				$icons = newsy_get_option( 'footer_social_icons', 'facebook,twitter' );

				echo newsy_social_counter_render( $icons, 'style-4', 'colored', true );
			}
			?>
		</div>
	</div>
</footer>
