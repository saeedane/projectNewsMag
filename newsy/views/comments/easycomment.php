<?php
// easyComment

$current_user = wp_get_current_user();

$attrs = apply_filters(
	'newsy_easycomment_attrs', array(
		'data-type'        => 'easycomment',
		'data-url'         => esc_url( newsy_get_option( 'easycomment_url' ) ),
		'data-title'       => esc_attr( newsy_get_option( 'easycomment_title', newsy_get_translation( 'Comments', 'newsy', 'comments' ) ) ),
		'data-content-id'  => esc_attr( get_the_ID() ),
		'data-content-url' => esc_url( get_permalink( get_the_ID() ) ),
		'data-userid'      => $current_user ? $current_user->ID : '',
		'data-username'    => $current_user ? esc_html( $current_user->display_name ) : '',
		'data-usericon'    => $current_user ? get_avatar_url( $current_user->ID ) : '',
		'data-profillink'  => $current_user ? get_author_posts_url( $current_user->ID ) : '',
	)
);

$output = '';
foreach ( $attrs  as $attr => $value ) {
	$output .= $attr . '="' . $value . '" ';
}
?>
<div class="comment-section" <?php newsy_sanitize_echo( $output ); ?>>
<?php
if ( empty( $attrs['data-url'] ) ) {
	echo 'easyComment URL is not set. Please set it in Theme Options > Post Page > Post: Comments';
} else {
	echo '<div id="easyComment_Content"><div class="ak-loading-circle"><div class="ak-loading-circle-inner"></div></div></div>';
}
?>
</div>
