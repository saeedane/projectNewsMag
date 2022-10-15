<?php
/**
 * header-style-2.php
 *---------------------------
 * Header style 2 template.
 */

$header_style = newsy_get_option( 'header_style', 'style-1' );

$classes   = array();
$classes[] = 'ak-header-wrap';

if ( 'active' == newsy_get_option( 'header_wrap_shadow' ) || empty( get_option( 'newsy_current_theme_style' ) ) ) {
	$classes[] = 'ak-header-bottom-shadow';
}

?>
<div class="<?php echo implode( ' ', apply_filters( 'newsy_header_wrap_class', $classes, $header_style ) ); ?>">
	<div class="ak-container">
	<?php get_template_part( 'views/builder/header-builder' ); ?>
	</div>
</div>

<div class="ak-header-mobile-wrap">
	<div class="ak-container">
	<?php get_template_part( 'views/builder/mobile-builder' ); ?>
	</div>
</div>

<?php

if ( newsy_get_option( 'post_sticky_enabled' ) === 'yes' && is_singular( 'post' ) ) {
	echo '<div class="ak-post-sticky-wrap sticky-simple"><div class="ak-container">';
	get_template_part( 'views/builder/post-sticky-builder' );
	echo '</div></div>';
} else {
	$sticky_type = newsy_get_option( 'header_sticky_type', 'hide' );

	if ( 'hide' !== $sticky_type ) {
		echo '<div class="ak-header-sticky-wrap sticky-' . esc_attr( $sticky_type ) . '"><div class="ak-container">';
		get_template_part( 'views/builder/sticky-builder' );
		echo '</div></div>';
	}
}
