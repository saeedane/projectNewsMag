<?php
/**
 * big-small-posts.php
 *---------------------------
 * Grid posts mega menu template.
 */

// Query Args
$atts = array(
	'order_by'    => 'date',
	'block_width' => 3,
);

if ( 'category' === $item->object ) {
	$atts['category'] = $item->object_id;
} elseif ( 'taxonomy' === $item->object ) {
	$atts['taxonomy'] = $item->object . ':' . $item->object_id;
}
?>
<div class="ak-container">
	<?php
		ak_do_shortcode( 'newsy_block_5', $atts );
	?>
</div>
<?php
unset( $atts );
