<?php
$atts = newsy_get_option(
	'header_newsticker', array(
		'order_by'    => 'date',
		'block_width' => 1,
	)
);
?>
<div class='ak-bar-item ak-header-newsticker'>
	<?php ak_do_shortcode( 'newsy_newsticker', $atts ); ?>
</div>
<?php
unset( $atts );
