<?php

namespace Newsy\Plugin;

/**
 * Newsy WordPress Social Login plugin compatibility handler.
 */
class WSL {

	/**
	 * @var WSL
	 */
	private static $instance;

	/**
	 * @return WSL
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Newsy_bbPress constructor.
	 */
	public function __construct() {
		$this->hook();
	}

	/**
	 * Callback: adds some code change to bbPress and other simple things.
	 *
	 * Filter: init
	 */
	public function hook() {
		add_filter( 'wsl_render_auth_widget_alter_provider_icon_markup', array( $this, 'render_wsl_get_button' ), 10, 3 );

		add_action( 'newsy_login_form_before', array( $this, 'render_social_login_providers' ) );
	}


	/**
	 * Get social login providers urls.
	 *
	 * Supported plugins:
	 * http://miled.github.io/wordpress-social-login/
	 *
	 *
	 * @since 1.8.0
	 *
	 * @return array
	 */
	public function get_social_login_providers( $providers = array() ) {
		if ( ! defined( 'WORDPRESS_SOCIAL_LOGIN_ABS_PATH' ) ) {
			return $providers;
		}

		global $WORDPRESS_SOCIAL_LOGIN_PROVIDERS_CONFIG;

		if ( empty( $WORDPRESS_SOCIAL_LOGIN_PROVIDERS_CONFIG ) || ! is_array( $WORDPRESS_SOCIAL_LOGIN_PROVIDERS_CONFIG ) ) {
			return $providers;
		}

		$current_url = home_url( add_query_arg( false, false ) );

		$login_url = add_query_arg(
			array(
				'action'      => 'wordpress_social_authenticate',
				'mode'        => 'login',
				'redirect_to' => urlencode( $current_url ),
			),
			home_url( 'wp-login.php', 'login_post' )
		);

		$use_popup = function_exists( 'wp_is_mobile' ) && wp_is_mobile() ? 2 : get_option( 'wsl_settings_use_popup' );

		foreach ( $WORDPRESS_SOCIAL_LOGIN_PROVIDERS_CONFIG as $provider ) {
			$provider_id = isset( $provider['provider_id'] ) ? $provider['provider_id'] : '';
			$is_enable   = get_option( 'wsl_settings_' . $provider_id . '_enabled' );

			if ( ! $is_enable ) {
				continue;
			}

			$provider_url = add_query_arg( 'provider', $provider_id, $login_url );
			$provider_url = apply_filters( 'wsl_render_auth_widget_alter_authenticate_url', $provider_url, $provider_id, 'login', $current_url, $use_popup );

			$providers[ $provider_id ] = $provider_url;
		}

		return $providers;
	}

	/**
	 * Used to change codes of WSL plugin to make it high compatible with newsy.
	 *
	 * @param      $provider_id
	 * @param      $provider_name
	 * @param      $authenticate_url
	 * @param bool $full
	 */
	function render_wsl_get_button( $provider_id, $provider_name, $authenticate_url, $full = true ) {
		$icons = array(
			'foursquare'    => 'fa-foursquare',
			'reddit'        => 'fa-reddit-alien',
			'disqus'        => 'fa-disqus',
			'linkedin'      => 'fa-linkedin',
			'yahoo'         => 'fa-yahoo',
			'instagram'     => 'fa-instagram',
			'wordpress'     => 'fa-wordpress',
			'google'        => 'fa-google-plus',
			'twitter'       => 'fa-twitter',
			'facebook'      => 'fa-facebook',
			'lastfm'        => 'fa-lastfm',
			'tumblr'        => 'fa-tumblr',
			'stackoverflow' => 'fa-stack-overflow',
			'github'        => 'fa-github',
			'Dribbble'      => 'fa-dribbble',
			'500px'         => 'fa-500px',
			'steam'         => 'fa-steam',
			'twitchtv'      => 'fa-twitch',
			'vkontakte'     => 'fa-vk',
			'odnoklassniki' => 'fa-odnoklassniki',
			'aol'           => 'fa-odnoklassniki',
		);

		$provider_id_lower = strtolower( $provider_id );

		$icon = false;

		if ( isset( $icons[ $provider_id_lower ] ) ) {
			$icon = '<i class="ak-icon fa ' . $icons[ $provider_id_lower ] . '" ></i>';
		}
		?>
		<a rel="nofollow" href="<?php echo esc_url( $authenticate_url ); ?>"
			data-provider="<?php echo esc_attr( $provider_id ); ?>" class="ak-social-login-btn <?php echo esc_attr( $provider_id_lower ), ' ', ! empty( $icon ) ? 'with-icon' : ''; ?>">
				<?php
				echo wp_kses( $icon, ak_trans_allowed_html() );
				if ( $full ) {
					echo sprintf( newsy_get_translation( 'Login With %s', 'newsy', 'login_with' ), ucfirst( $provider_name ) );
				} else {
					echo esc_html( $provider_id );
				}
				?>
		</a>
		<?php
	}

	/**
	 * Get social login providers urls.
	 *
	 * Supported plugins:
	 * http://miled.github.io/wordpress-social-login/
	 *
	 *
	 * @since 1.8.0
	 *
	 * @return array
	 */
	public function render_social_login_providers() {

		$social_login = $this->get_social_login_providers();
		if ( $social_login ) {
			?>
			<div class="login-field social-login-buttons clearfix">
				<?php

				$counter = 1;
				$count   = count( $social_login );
				?>
				<ul class="items-count-<?php echo esc_attr( $count ); ?>">
					<?php

					foreach ( $social_login as $site_id => $url ) {
						$label = false;

						if ( 2 == $count || 1 == $count ) {
							$label = true;
						} elseif ( 1 == $counter ) {
							$label = true;
						}
						?>
						<li class="item-<?php echo esc_attr( $counter ); ?>">
							<?php $this->render_wsl_get_button( $site_id, $site_id, $url, $label ); ?>
						</li>
						<?php
						$counter++;
					}
					?>
				</ul>
				<div class="or-wrapper">
					<span class="or-text"><?php newsy_echo_translation( 'Or', 'newsy', 'login_or' ); ?></span>
				</div>
			</div>
			<?php
		}
	}

}
