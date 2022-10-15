<?php

namespace Newsy\Support;

use Ak\Util\CssGenerator;

/**
 * Newsy Gutenberg compatibility handler.
 */
class Gutenberg {

	/**
	 * @var Gutenberg
	 */
	private static $instance;

	/**
	 * @var array
	 */
	protected $output;

	/**
	 * @return Gutenberg
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}
		return static::$instance;
	}

	private function __construct() {
		if ( defined( 'AK_FRAMEWORK_PATH' ) ) {
			$this->setup_hook();
		}
	}

	protected function setup_hook() {
		add_action( 'enqueue_block_editor_assets', array( $this, 'load_style' ), 999 );
	}

	/**
	 * Inıt gutenberg outputs
	 *
	 * @return void
	 */
	private function init_outputs() {
		if ( ! empty( $this->output ) ) {
			return $this->output;
		}

		$outputs = apply_filters(
			'newsy/gutenberg/css/outputs', array(
				array(
					'type'     => 'css',
					'element'  => '.editor-styles-wrapper',
					'property' => '--ak-highlight-color',
					'value'    => newsy_get_option( 'site_highlight_color' ),
				),
				array(
					'type'     => 'css',
					'element'  => '.editor-styles-wrapper',
					'property' => '--ak-accent-color',
					'value'    => newsy_get_option( 'site_accent_color' ),
				),
				array(
					'type'     => 'css',
					'element'  => '.editor-styles-wrapper, .editor-styles-wrapper p',
					'property' => 'typography',
					'value'    => wp_parse_args(
						newsy_get_option(
							'typo_single_post_content',
							newsy_get_option( 'typo_body' )
						),
						array(
							'size'        => '14px',
							'line-height' => '1.6em',
							'variant'     => '400',
						)
					),
				),
				array(
					'type'      => 'css',
					'element'   => '.wp-block',
					'property'  => 'max-width',
					'value'     => '768px',
					'important' => true,
				),
				array(
					'type'      => 'css',
					'element'   => '.wp-block[data-align="wide"]',
					'property'  => 'max-width',
					'value'     => '1200px',
					'important' => true,
				),
				array(
					'type'     => 'css',
					'element'  => '.edit-post-visual-editor__post-title-wrapper .editor-post-title',
					'property' => 'typography',
					'value'    => wp_parse_args(
						newsy_get_option(
							'typo_single_post_title'
						), array(
							'size'        => '2.7em',
							'line-height' => '1.2em',
							'variant'     => '700',
						)
					),
				),
				array(
					'type'     => 'css',
					'element'  => array(
						'.editor-styles-wrapper .wp-block-cover p',
					),
					'property' => 'typography',
					'value'    => newsy_get_option(
						'typo_single_post_block_cover',
						newsy_get_option( 'typo_single_post_title', array() )
					),
				),
				array(
					'type'     => 'css',
					'element'  => array(
						'.editor-styles-wrapper .wp-block-quote p',
						'.editor-styles-wrapper .wp-block-pullquote blockquote p',
					),
					'property' => 'typography',
					'value'    => newsy_get_option( 'typo_single_post_block_quote', array() ),
				),
				array(
					'type'     => 'css',
					'element'  => array(
						'.editor-styles-wrapper .wp-block-quote cite',
						'.editor-styles-wrapper .wp-block-pullquote blockquote cite',
					),
					'property' => 'typography',
					'value'    => newsy_get_option( 'typo_single_post_block_quote_cite', array() ),
				),
				array(
					'type'     => 'css',
					'element'  => '.editor-styles-wrapper h1, .editor-styles-wrapper .h1, .editor-styles-wrapper h2, .editor-styles-wrapper .h2, .editor-styles-wrapper h3, .editor-styles-wrapper .h3, .editor-styles-wrapper h4, .editor-styles-wrapper .h4, .editor-styles-wrapper h5, .editor-styles-wrapper .h5, .editor-styles-wrapper h6, .editor-styles-wrapper .h6',
					'property' => 'typography',
					'value'    => wp_parse_args(
						newsy_get_option(
							'typo_heading'
						), array(
							'line-height' => '1.4em',
							'variant'     => '700',
						)
					),
				),
				array(
					'type'     => 'css',
					'element'  => '.editor-styles-wrapper h1, .editor-styles-wrapper .h1',
					'property' => 'typography',
					'value'    => wp_parse_args(
						newsy_get_option(
							'typo_heading_h1'
						), array(
							'size' => '2.44em',
						)
					),
				),
				array(
					'type'     => 'css',
					'element'  => '.editor-styles-wrapper h2, .editor-styles-wrapper .h2',
					'property' => 'typography',
					'value'    => wp_parse_args(
						newsy_get_option(
							'typo_heading_h2'
						), array(
							'size' => '1.95em',
						)
					),
				),
				array(
					'type'     => 'css',
					'element'  => '.editor-styles-wrapper h3, .editor-styles-wrapper .h3',
					'property' => 'typography',
					'value'    => wp_parse_args(
						newsy_get_option(
							'typo_heading_h3'
						), array(
							'size' => '1.56em',
						)
					),
				),
				array(
					'type'     => 'css',
					'element'  => '.editor-styles-wrapper h4, .editor-styles-wrapper .h4',
					'property' => 'typography',
					'value'    => wp_parse_args(
						newsy_get_option(
							'typo_heading_h4'
						), array(
							'size' => '1.25em',
						)
					),
				),
				array(
					'type'     => 'css',
					'element'  => '.editor-styles-wrapper h5, .editor-styles-wrapper .h5',
					'property' => 'typography',
					'value'    => wp_parse_args(
						newsy_get_option(
							'typo_heading_h5'
						), array(
							'size' => '1em',
						)
					),
				),
				array(
					'type'     => 'css',
					'element'  => '.editor-styles-wrapper h6, .editor-styles-wrapper .h6',
					'property' => 'typography',
					'value'    => wp_parse_args(
						newsy_get_option(
							'typo_heading_h6'
						), array(
							'size' => '0.8em',
						)
					),
				),
			)
		);

		$css_generator = new CssGenerator;
		$css           = $css_generator->render_css( $outputs );
		$custom_fonts  = $css_generator->render_custom_fonts();
		$google_fonts  = $css_generator->render_google_fonts();

		$this->output = array(
			'css'          => $css,
			'custom_fonts' => $custom_fonts,
			'google_fonts' => $google_fonts,
		);

		return $this->output;
	}

	public function load_style() {
		$output = $this->init_outputs();

		wp_enqueue_style( 'newsy-editor-styles', NEWSY_THEME_URI . '/style-editor.css', false, NEWSY_THEME_VERSION, 'all' );

		if ( ! empty( $output['google_fonts'] ) ) {
			wp_enqueue_style( 'newsy-editor-fonts', $output['google_fonts'], array(), null );
		}

		if ( ! empty( $output['custom_fonts'] ) ) {
			wp_add_inline_style( 'wp-edit-blocks', $output['custom_fonts'] );
		}

		if ( ! empty( $output['css'] ) ) {
			wp_add_inline_style( 'wp-edit-blocks', $output['css'] );
		}
	}
}
