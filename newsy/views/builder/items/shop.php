<?php
if ( class_exists( 'WooCommerce' ) ) :
	?>
<div class="ak-bar-item ak-header-cart cartdetail woocommerce">
	<a class="ak-header-icon-btn ak-dropdown-button cartlink" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_html_e( 'View your shopping cart', 'newsy' ); ?>">
		<i class="fa fa-shopping-cart item-icon"></i>
		<span class="count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
	</a>

	<div class="ak-dropdown ak-header-cart-content" data-event="hover">
		<div class="widget_shopping_cart_content">
			<?php woocommerce_mini_cart(); ?>
		</div>
	</div>
</div>
<?php endif ?>
