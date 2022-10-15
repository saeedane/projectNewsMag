<?php
/**
 * tabbed-posts.php
 *---------------------------
 * Tabbed grid posts mega menu template.
 */
?>
<div class="ak-container">
	<?php
	$menu_meta = $item->menu_meta;
	$atts      = array(
		'pagination'     => 'next_prev',
		'count'          => 3,
		'block_width'    => 3,
		'header_style'   => 'style-1',
		'tabs'           => 'sub_cat_filter',
		'custom_enabled' => 'yes',
		'custom_parts'   => 'show_excerpt=hide&show_meta=hide',
		'tabs_more_menu' => 'no',
	);

	if ( 'category' == $item->object ) {
		$atts['category'] = $item->object_id;
	} elseif ( 'taxonomy' == $item->object ) {
		$atts['taxonomy'] = $item->object . ':' . $item->object_id;
	}

	if ( isset( $menu_meta['tabs'] ) && ! empty( $menu_meta['tabs'] ) ) {
		$tabs = $menu_meta['tabs'];

		if ( 'cat_filter' == $tabs && isset( $menu_meta['tabs_cat_filter'] ) && ! empty( $menu_meta['tabs_cat_filter'] ) ) {
			$atts['tabs_cat_filter'] = $menu_meta['tabs_cat_filter'];
		} elseif ( 'tax_filter' == $tabs && isset( $menu_meta['tabs_tax_filter'] ) && ! empty( $menu_meta['tabs_tax_filter'] ) ) {
			$atts['tabs_tax_filter'] = $menu_meta['tabs_tax_filter'];
		} elseif ( 'order_filter' == $tabs && isset( $menu_meta['tabs_order_by_filter'] ) && ! empty( $menu_meta['tabs_order_by_filter'] ) ) {
			$atts['tabs_order_by_filter'] = $menu_meta['tabs_order_by_filter'];
		}

		$atts['tabs'] = $tabs;
	}

	ak_do_shortcode( 'newsy_list_2', $atts );
	?>
</div>
<?php
unset( $tabs, $atts, $menu_meta );
