<?php
$builder_header_mobile = newsy_get_option( 'builder_header_mobile' );
$mobile_header_scheme  = isset( $builder_header_mobile['mobile']['scheme'] ) ? $builder_header_mobile['mobile']['scheme'] : newsy_amp_get_option( 'amp_scheme' );
?>
<header id="#top" class="amp-wp-header <?php echo esc_attr( $mobile_header_scheme ); ?>">
	<div>
		<button on="tap:sidebar.toggle" class="toggle_btn">
			<i class="fa fa-bars"></i>
		</button>
		<a class="ak-amp-logo" href="<?php echo esc_url( $this->get( 'home_url' ) ); ?>"></a>
		<a class="ak-amp-search-icon" href="<?php echo esc_url( $this->get( 'home_url' ) . '?s=' ); ?>">
			<i class="fa fa-search"></i>
		</a>
	</div>
</header>
