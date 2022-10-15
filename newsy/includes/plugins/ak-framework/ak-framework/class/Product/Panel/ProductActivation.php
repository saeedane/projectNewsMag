<?php
/***
 * The Ak Framework
 *
 * Ak Framework is framework for WordPress themes and plugins.
 *
 * Copyright © 2020 akbilisim
 * www.akbilisim.com
 *
 * Envato Profile: https://themeforest.net/user/akbilisim
 */
namespace Ak\Product\Panel;

use Ak\Product\ProductLicense;

class ProductActivation extends ProductPanelAbstract {

	public $id = 'product-activation';

	public function enqueue() {
		wp_enqueue_style( 'ak-product-activation-styles', AK_FRAMEWORK_URL . '/assets/css/panel/ak-product-activation.css', array(), AK_FRAMEWORK_VERSION );
		wp_style_add_data( 'ak-product-activation-styles', 'rtl', 'replace' );

		wp_enqueue_script( 'ak-product-activation-scripts', AK_FRAMEWORK_URL . '/assets/js/panel/ak-product-activation.js', array( 'jquery', 'sweetalert' ), AK_FRAMEWORK_VERSION, true );
	}

	public function render_content() {
		$item_id = &$this->product['product-item-id'];
		if ( empty( $item_id ) ) {
			echo 'Invalid item';

			return;
		}
		$registered_purchase = ProductLicense::get_instance()->get_product_purchase_info( $item_id );
		if ( $registered_purchase ) {
			$registered_access = ProductLicense::get_instance()->get_access_code_info( $item_id );
			?>
			<div class="ak-activate-page-wrap">
				<div class="ak-activate-wrap">
					<form action="" id="ak-activate-form" onsubmit="return false">
						<input type="hidden" name="item_id" value="<?php echo esc_attr( $item_id ); ?>">
						<div class="ak-input-title"><?php esc_html_e( 'Activated purchase code:', 'ak-framework' ); ?></div>
						<input type="text" readonly name="purchase_code" id="purchase_code" value="<?php echo esc_attr( $registered_purchase ); ?>">
						<input type="hidden" name="access_code" id="access_code" value="<?php echo esc_attr( $registered_access ); ?>"><br/><br/>
						<button class="ak-btn ak-primary-btn ak-deactivate-button">
							<?php
							echo esc_html(
								sprintf(
									/* translators: %1$s is replaced with "string" */
									__( 'Deactivate %s', 'ak-framework' ), $this->product['product-name']
								)
							);
							?>
						</button>
					</form>
				</div>
			</div>
			<?php
		} else {
			$purchase = '';
			if ( isset( $_GET['purchase'] ) ) :
				$purchase = $_GET['purchase'];

				if ( isset( $_GET['purchase_error'] ) ) :
					$error = $_GET['purchase_error'];
					?>
				<script>
				$("document").ready(function() {
					setTimeout(function() {
						swal('Error', "<?php echo esc_html( $error ); ?>", 'error');
					},10);
				});
			</script>
					<?php else : ?>
			<script>
				$("document").ready(function() {
					setTimeout(function() {
						$(".ak-activate-button").trigger('click');
					},10);
				});
			</script>
				<?php endif; ?>
				<?php endif; ?>
		<div class="ak-activate-page-wrap">
			<div class="ak-activate-wrap">

				<form action="" id="ak-activate-form" onsubmit="return false">
					<div class="ak-input-title"><?php esc_html_e( 'Activate with purchase code:', 'ak-framework' ); ?></div>
					<input type="hidden" name="item_id" value="<?php echo esc_attr( $item_id ); ?>">
					<input type="text" name="purchase_code" id="purchase_code" class="ak-purchase-code" placeholder="Envato purchase code"
					value="<?php echo esc_attr( $purchase ); ?>">
					<button class="ak-btn  ak-primary-btn ak-activate-button"><?php esc_html_e( 'Activate', 'ak-framework' ); ?></button>
				</form>
				<p>
				<?php esc_html_e( 'In order to use all the included features you need to verify your account in support center.', 'ak-framework' ); ?>
				</p>
				<a href="<?php echo isset( $this->product['activation-link'] ) ? $this->product['activation-link'] : 'https://bit.ly/3Av1DNf'; ?>" target="_blank">
					<?php
					printf(
						/* translators: %1$s is replaced with "string" */
						__( 'How to activate %s', 'ak-framework' ), $this->product['product-name']
					);
					?>
				</a>
			</div>
		</div>
				<?php
		}
	}

	public function ajax_request() {
		if ( ! isset( $_POST['page_action'] ) || ! isset( $_REQUEST['data'] ) ) {
			return false;
		}

		$response = false;

		try {
			$args = ak_parse_str( ltrim( rtrim( stripslashes( $_REQUEST['data'] ), '&' ), '&' ) );

			if ( ! isset( $args['purchase_code'] ) || ! isset( $args['item_id'] ) ) {
				return new \WP_Error( 'error', __( 'Please add valid purchase code!', 'ak-framework' ) );
			}

			switch ( $_POST['page_action'] ) {
				case 'activate':
					$response = ProductLicense::get_instance()->handle_activation( 'register-purchase', $args );
					break;
				case 'deactivate':
					$response = ProductLicense::get_instance()->handle_activation( 'deregister-purchase', $args );
					break;
			}
		} catch ( \Exception $e ) {
			$response = new \WP_Error( $e->getCode(), $e->getMessage() );
		}

		return $response;
	}
}
