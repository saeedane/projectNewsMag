<?php
/**
 * 4-columns-posts.php
 *---------------------------
 * Grid posts mega menu template.
 */

// Query Args
$atts = array(
	'pagination'            => 'next_prev',
	'show_label'            => true,
	'order_by'              => 'date',
	'count'                 => 4,
	'block_width'           => 4,
	'show_pagination_label' => 'hide',
	'custom_enabled'        => 'yes',
	'custom_parts'          => 'show_excerpt=hide&show_meta=hide',
);

if ( 'category' === $item->object ) {
	$atts['category'] = $item->object_id;
} elseif ( 'taxonomy' === $item->object ) {
	$atts['taxonomy'] = $item->object . ':' . $item->object_id;
}
?>
<div class="ak-container">
	<?php
		ak_do_shortcode( 'newsy_list_2', $atts );
	?>
</div>
<?php
unset( $atts );
