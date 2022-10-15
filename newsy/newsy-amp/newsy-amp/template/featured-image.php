<?php
$format         = get_post_format( get_the_ID() );
$featured_image = $this->get( 'featured_image' );

if ( 'gallery' === $format ) {
	$images        = get_post_meta( get_the_ID(), '_format_gallery_images', true );
	$carousel_html = '';

	foreach ( $images as $image_id ) {
		list( $url, $width, $height ) = wp_get_attachment_image_src( $image_id, 'newsy_750x0', true );
		if ( ! $url ) {
			continue;
		}
		$carousel_html .= "<amp-img src=\"{$url}\" width=\"{$width}\" height=\"{$height}\" layout=\"responsive\"></amp-img>";
	}
	?>
	<amp-carousel width="600" height="480" type="slides" layout="responsive">
		<?php echo $carousel_html; ?>
	</amp-carousel>
	<?php
} elseif ( 'video' === $format ) {
	$video = ak_get_post_meta( 'featured_video', get_the_ID() );

	if ( ! empty( $video ) && ! empty( $video['type'] ) ) {
		$video_url = ! empty( $video['url'] ) ? $video['url'] : '';

		if ( 'upload' === $video['type'] ) {
			$video_type = 'mp4';
			$video_url  = ! empty( $video['mp4'] ) ? $video['mp4'] : '';
			$video_url  = ak_remove_protocol( $video_url );
		} else {
			$video_provider = Newsy\Support\VideoThumbnail::get_instance();
			$video_type     = $video_provider->get_video_provider( $video_url );
			$video_url      = $video_provider->get_video_id( $video_url );
		}

		if ( 'youtube' === $video_type ) {
			?>
			<p><amp-youtube data-videoid="<?php echo esc_attr( $video_url ); ?>" layout="responsive" width="600" height="338"></amp-youtube></p>
			<?php
		} elseif ( 'vimeo' === $video_type ) {
			?>
			<p><amp-vimeo data-videoid="<?php echo esc_attr( $video_url ); ?>" layout="responsive" width="600" height="338"></amp-vimeo></p>
			<?php
		} elseif ( 'mp4' === $video_type ) {
			?>
			<div class="wp-video">
				<!--[if lt IE 9]><script>document.createElement('video');</script><![endif]-->
				<amp-video class="wp-video-shortcode amp-wp-enforced-sizes" width="640" height="360" controls="" sizes="(min-width: 600px) 600px, 100vw"><source type="video/mp4" src="<?php echo esc_url( $video_url ); ?>"/></amp-video>
			</div>
			<?php
		}
	}
} else {
	if ( empty( $featured_image ) ) {
		return;
	}
	$amp_html = $featured_image['amp_html'];
	$caption  = $featured_image['caption'];
	?>
	<figure class="amp-wp-article-featured-image wp-caption">
		<?php echo $amp_html; // amphtml content; no kses ?>
		<?php if ( $caption ) : ?>
			<p class="wp-caption-text">
				<?php echo wp_kses_data( $caption ); ?>
			</p>
		<?php endif; ?>
	</figure>
	<?php
}
