<?php
$drawer_scheme = newsy_amp_get_option( 'drawer_scheme', '' );
$drawer_items  = array(
	'drawer' => array(
		'left'   => array(
			'items' => array( 'search_form', 'mobile_menu' ),
		),
		'center' => array(
			'items' => array(),
		),
		'right'  => array(
			'items' => array( 'footer_copyright' ),
		),
	),
	'order'  => array( 'drawer' ),
);
?>
<amp-sidebar id="sidebar" layout="nodisplay" side="left" class="<?php echo esc_attr( $drawer_scheme ); ?>">
<div class="ak-off-nav-wrap">
	<div class="ak-off-nav-top-row">
		<?php
		if ( ! empty( $drawer_items['drawer']['left']['items'] ) ) {
			foreach ( (array) $drawer_items['drawer']['left']['items'] as $part ) {
				get_template_part( 'views/builder/items/' . $part );
			}
		}
		?>
	</div>
	<div class="ak-off-nav-mid-row">
		<?php
		if ( ! empty( $drawer_items['drawer']['center']['items'] ) ) {
			foreach ( (array) $drawer_items['drawer']['center']['items'] as $part ) {
				get_template_part( 'views/builder/items/' . $part );
			}
		}
		?>
	</div>
	<div class="ak-off-nav-bottom-row">
		<?php
		if ( ! empty( $drawer_items['drawer']['right']['items'] ) ) {
			foreach ( (array) $drawer_items['drawer']['right']['items'] as $part ) {
				get_template_part( 'views/builder/items/' . $part );
			}
		}
		?>
	</div>
</div>
</amp-sidebar>
