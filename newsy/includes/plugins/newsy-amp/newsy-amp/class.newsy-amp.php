<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main functions for Newsy AMP
 */
class Newsy_AMP {

	/**
	 * @var Newsy_AMP
	 */
	private static $instance;

	/**
	 * @var array
	 */
	protected $amp_ads = array();

	/**
	 * @var string
	 */
	protected $amp_ads_client_id = '';

	/**
	 * @return Newsy_AMP
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}
		return static::$instance;
	}

	/**
	 * Newsy_AMP constructor
	 */
	private function __construct() {
		$this->setup_init();
		$this->setup_hook();
	}

	/**
	 * Setup hook
	 */
	protected function setup_hook() {
		// amp content sanitizers
		add_filter( 'amp_content_sanitizers', array( $this, 'content_sanitizers' ) );

		// amp
		add_filter( 'amp_post_template_dir', array( $this, 'add_template_folder' ) );
		add_filter( 'amp_post_template_data', array( $this, 'add_googlefont' ) );
		add_filter( 'amp_post_template_data', array( $this, 'add_body_class' ) );

		add_action( 'amp_post_template_head', array( $this, 'add_script' ) );
		// favicon
		add_action( 'amp_post_template_head', array( $this, 'add_favicon' ) );

		// main share button
		add_action( 'newsy_amp_share_top', array( $this, 'share_top' ) );
		add_action( 'newsy_amp_share_bottom', array( $this, 'share_top' ) );

		// AMP
		add_filter( 'amp_post_template_metadata', array( $this, 'meta_data' ), null, 2 );

		// ads
		add_action( 'newsy_amp_before_header', array( $this, 'google_auto_ads' ) );
		add_action( 'newsy_amp_before_header', array( $this, 'above_header_ads' ) );
		add_action( 'newsy_amp_before_article', array( $this, 'above_article_ads' ) );
		add_action( 'newsy_amp_after_article', array( $this, 'below_article_ads' ) );
		add_action( 'newsy_amp_before_content', array( $this, 'above_content_ads' ) );
		add_action( 'newsy_amp_after_content', array( $this, 'below_content_ads' ) );
	}

	/**
	 * Sanitize AMP Tag
	 */
	public function content_sanitizers( $sanitize_array ) {
		unset( $sanitize_array['AMP_Video_Sanitizer'] );
		unset( $sanitize_array['AMP_Audio_Sanitizer'] );

		require_once 'class.newsy-amp-sanitize-audio.php';
		require_once 'class.newsy-amp-sanitize-video.php';

		$sanitize_array['Newsy_AMP_Sanitize_Audio'] = array();
		$sanitize_array['Newsy_AMP_Sanitize_Video'] = array();

		return $sanitize_array;
	}

	/**
	 * Load amp template folder
	 */
	public function add_template_folder() {
		return NEWSY_AMP_PATH . 'template';
	}


	public function add_favicon() {
		if ( has_site_icon() ) {
			wp_site_icon();
		}
	}

	public function meta_data( $metadata, $post ) {
		unset( $metadata['image'] );

		// Type
		$metadata['@type'] = newsy_amp_get_option( 'article_schema_type', 'article' );

		// URL
		$metadata['url'] = get_the_permalink( $post );

		// Thumbnail URL
		if ( has_post_thumbnail( $post ) ) {
			$post_thumbnail_id = get_post_thumbnail_id( $post );
			$thumbnail         = wp_get_attachment_image_src( $post_thumbnail_id, 'newsy_120x86' );
			$fullimage         = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );

			$metadata['thumbnailUrl'] = $thumbnail[0];
			$metadata['image']        = $fullimage[0];
		}

		// Category
		$categories = get_the_category( $post->ID );
		if ( ! empty( $categories ) ) {
			$metadata['articleSection'] = array();
			foreach ( $categories as $category ) {
				$metadata['articleSection'][] = $category->name;
			}
		}

		// Newsy
		$logo = newsy_get_option( 'mobile_logo_image' );
		if ( ! empty( $logo ) ) {
			$metadata['newsy']['logo'] = array(
				'@type' => 'ImageObject',
				'url'   => $logo,
			);
		}

		return $metadata;
	}

	/**
	 * Setup init
	 */
	protected function setup_init() {
		$locations = array( 'above_header', 'above_article', 'below_article', 'above_content', 'below_content' );

		foreach ( $locations as $location ) {
			$ad      = newsy_amp_get_option( 'amp_ads_' . $location );
			$ad_type = isset( $ad['type'] ) ? $ad['type'] : '';

			if ( '' !== $ad_type ) {
				$this->amp_ads[ $location ] = $ad;

				if ( 'google' === $ad_type && empty( $this->amp_ads_client_id ) && ! empty( $ad['google_client_id'] ) ) {
					$this->amp_ads_client_id = $ad['google_client_id'];
				}
			}
		}
	}

	/**
	 * Add google font
	 */
	public function add_googlefont( $amp_data ) {
		$feasset_instance = Ak\Asset\FrontendAsset::get_instance();
		$font_url         = $feasset_instance->get_font_url();

		if ( empty( $font_url ) ) {
			return $amp_data;
		}

		$amp_data['font_urls'] = array(
			'customizer-fonts' => $font_url,
		);

		return $amp_data;
	}

	/**
	 * Add Additional Body Class
	 */
	public function add_body_class( $amp_data ) {
		if ( is_rtl() ) {
			$amp_data['body_class'] .= ' rtl';
		}

		$amp_scheme = newsy_amp_get_option( 'amp_scheme' );

		if ( 'dark' === $amp_scheme ) {
			$amp_data['body_class'] .= ' dark';
		}

		return $amp_data;
	}

	/**
	 * Add script
	 */
	public function add_script( $amp_template ) {
		$scripts = array();
		$format  = get_post_format( get_the_ID() );

		if ( 'gallery' === $format ) {
			$scripts[] = array(
				'name'   => 'amp-carousel',
				'source' => 'https://cdn.ampproject.org/v0/amp-carousel-0.1.js',
			);
		}

		if ( 'video' === $format ) {
			$scripts[] = array(
				'name'   => 'amp-youtube',
				'source' => 'https://cdn.ampproject.org/v0/amp-youtube-0.1.js',
			);
			$scripts[] = array(
				'name'   => 'amp-vimeo',
				'source' => 'https://cdn.ampproject.org/v0/amp-vimeo-0.1.js',
			);
		}

		// sidebar
		$scripts[] = array(
			'name'   => 'amp-sidebar',
			'source' => 'https://cdn.ampproject.org/v0/amp-sidebar-0.1.js',
		);

		// form
		$scripts[] = array(
			'name'   => 'amp-form',
			'source' => 'https://cdn.ampproject.org/v0/amp-form-0.1.js',
		);

		if ( ! empty( $this->amp_ads ) ) {
			$scripts[] = array(
				'name'   => 'amp-ad',
				'source' => 'https://cdn.ampproject.org/v0/amp-ad-0.1.js',
			);
		}

		// Google Auto Ads
		if ( '' !== $this->amp_ads_client_id ) {
			$scripts[] = array(
				'name'   => 'amp-auto-ads',
				'source' => 'https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js',
			);
		}

		foreach ( $scripts as $script ) {
			$loaded_script = $amp_template->get( 'amp_component_scripts', array() );

			if ( ! empty( $script['name'] ) && ! array_key_exists( $script['name'], $loaded_script ) ) {
				?>
				<script custom-element="<?php echo esc_attr( $script['name'] ); ?>" src="<?php echo esc_url( $script['source'] ); ?>" async></script>
				<?php
			}
		}
	}

	/**
	 * Google Auto Ads
	 */
	public function google_auto_ads() {
		if ( '' !== $this->amp_ads_client_id ) {
			$html = "<amp-auto-ads type=\"adsense\" data-ad-client=\"{$this->amp_ads_client_id}\"></amp-auto-ads>";
			echo $html;
		}
	}

	/**
	 * Above header ads
	 */
	public function above_header_ads() {
		$location = 'above_header';

		if ( array_key_exists( $location, $this->amp_ads ) ) {
			$html = "<div class=\"amp_ad_wrapper newsy_amp_{$location}_ads\">" . $this->render_ads( $location ) . '</div>';

			echo $html;
		}
	}

	/**
	 * Above article ads
	 */
	public function above_article_ads() {
		$location = 'above_article';

		if ( array_key_exists( $location, $this->amp_ads ) ) {
			$html = "<div class=\"amp_ad_wrapper newsy_amp_{$location}_ads\">" . $this->render_ads( $location ) . '</div>';

			echo $html;
		}
	}

	/**
	 * Below article ads
	 */
	public function below_article_ads() {
		$location = 'below_article';

		if ( array_key_exists( $location, $this->amp_ads ) ) {
			$html = "<div class=\"amp_ad_wrapper newsy_amp_{$location}_ads\">" . $this->render_ads( $location ) . '</div>';

			echo $html;
		}
	}

	/**
	 * Above content ads
	 */
	public function above_content_ads() {
		$location = 'above_content';

		if ( array_key_exists( $location, $this->amp_ads ) ) {
			$html = "<div class=\"amp_ad_wrapper newsy_amp_{$location}_ads\">" . $this->render_ads( $location ) . '</div>';

			echo $html;
		}
	}

	/**
	 * Below content ads
	 */
	public function below_content_ads() {
		$location = 'below_content';

		if ( array_key_exists( $location, $this->amp_ads ) ) {
			$html = "<div class=\"amp_ad_wrapper newsy_amp_{$location}_ads\">" . $this->render_ads( $location ) . '</div>';

			echo $html;
		}
	}

	/**
	 * Render ads
	 *
	 * @param  string $location
	 *
	 * @return string
	 *
	 */
	protected function render_ads( $location ) {
		$ads_html = '';
		$ad       = $this->amp_ads[ $location ];

		if ( 'google' === $ad['type'] ) {
			$client_id = isset( $ad['google_client_id'] ) ? $ad['google_client_id'] : '';
			$slot_id   = isset( $ad['google_slot_id'] ) ? $ad['google_slot_id'] : '';

			if ( ! empty( $client_id ) && ! empty( $slot_id ) ) {
				$ad_size = isset( $ad['google_phone'] ) ? $ad['google_phone'] : 'auto';

				if ( 'auto' !== $ad_size ) {
					$ad_size = explode( 'x', $ad_size );
				} else {
					$ad_size = array( '320', '50' );
				}

				$client_id = str_replace( 'ca-', '', $client_id );

				$ads_html .=
					"<amp-ad
                        type=\"adsense\"
                        width={$ad_size[0]}
                        height={$ad_size[1]}
                        data-ad-client=\"ca-{$client_id}\"
                        data-ad-slot=\"{$slot_id}\">
                    </amp-ad>";
			}
		} elseif ( 'image' === $ad['type'] ) {
			$image         = isset( $ad['image'] ) ? $ad['image'] : '';
			$image_link    = isset( $ad['image_link'] ) ? $ad['image_link'] : '#';
			$image_alt     = isset( $ad['image_alt'] ) ? $ad['image_alt'] : '';
			$image_new_tab = isset( $ad['image_new_tab'] ) ? $ad['image_new_tab'] : 'yes';
			$tab           = ( 'no' === $image_new_tab ) ? '_self' : '_blank';

			$ads_html .=
					"<a href=\"{$image_link}\" target=\"{$tab}\">
						<amp-img
							src=\"{$image}\"
							alt=\"{$image_alt}\"
							width=\"320\"
							height=\"50\"
							layout=\"responsive\">
						</amp-img>
					</a>";

		} else {
			$ads_html = $ad['content'];
		}

		return $ads_html;
	}


	public function share_top( $post_id ) {
		$share_sites = newsy_amp_get_option( 'post_social_share_sites', 'facebook,twitter,pinterest' );

		if ( empty( $share_sites )
			|| newsy_amp_get_option( 'post_social_share_top' ) == 'hide'
			|| ! function_exists( 'newsy_get_share_buttons' ) ) {
			return;
		}

		$share = newsy_get_share_buttons( $share_sites, $post_id, 'style-1', 'total', 99 );

		echo $share;
	}
}
