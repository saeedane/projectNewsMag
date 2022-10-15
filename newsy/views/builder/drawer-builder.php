<?php

$drawer_rows = newsy_get_option( 'builder_drawer' );

if ( empty( $drawer_rows['drawer'] ) ) {
	$drawer_rows = Newsy\Support\PartBuilderData::builder_drawer_defaults();
}

$row_scheme = ! empty( $drawer_rows['drawer']['scheme'] ) ? $drawer_rows['drawer']['scheme'] : '';

newsy_set_bar_dark_scheme( $row_scheme );
?>
<div id="ak_off_canvas" class="ak-off-canvas-wrap  <?php echo esc_attr( $row_scheme ); ?>">
	<div class="ak-off-canvas-overlay"></div>
	<a href="#" class="ak-off-canvas-close"><i class="fa fa-times"></i></a>
	<div class="ak-off-canvas-nav">
		<div class="ak-off-nav-wrap">
			<div class="ak-off-nav-top-row">
				<?php
				if ( ! empty( $drawer_rows['drawer']['left']['items'] ) ) {
					foreach ( (array) $drawer_rows['drawer']['left']['items'] as $part ) {
						newsy_generate_bar_item( $part );
					}
				}
				?>
			</div>
			<div class="ak-off-nav-mid-row">
				<?php
				if ( ! empty( $drawer_rows['drawer']['center']['items'] ) ) {
					foreach ( (array) $drawer_rows['drawer']['center']['items'] as $part ) {
						newsy_generate_bar_item( $part );
					}
				}
				?>
			</div>
			<div class="ak-off-nav-bottom-row">
				<?php
				if ( ! empty( $drawer_rows['drawer']['right']['items'] ) ) {
					foreach ( (array) $drawer_rows['drawer']['right']['items'] as $part ) {
						newsy_generate_bar_item( $part );
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php
newsy_unset_bar_dark_scheme();
?>
