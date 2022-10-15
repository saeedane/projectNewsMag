<?php

namespace Newsy;

/**
 * Template abstract class.
 */
abstract class TemplateAbstract {

	/**
	 * The template id
	 *
	 * @var string
	 */
	public $template_id;

	/**
	 * The template object id
	 *
	 * @var string
	 */
	public $id;

	/**
	 * The template layout
	 *
	 * @var string
	 */
	public $layout;

	public function __construct() {
		add_filter( 'body_class', array( $this, 'add_body_class' ) );
		add_filter( 'newsy_main_menu_args', array( $this, 'main_menu_args' ) );
		add_filter( 'newsy_header_wrap_class', array( $this, 'header_wrap_class' ), 11 );

		$GLOBALS['content_width'] = apply_filters( 'content_width', 768 );
	}

	/**
	 * Template body classes
	 *
	 * @param array $classes
	 * @return array
	 */
	public function add_body_class( $classes ) {
		$classes[] = $this->get_layout_style();

		return apply_filters( 'newsy_template_body_class', $classes, $this->template_id, $this->id );
	}

	/**
	 * Template header wrapper classes
	 *
	 * @param array $classes
	 * @return array
	 */
	public function header_wrap_class( $classes ) {
		if ( 'yes' === $this->get_option( 'header_sticky_overlay' ) ) {
			$classes[] = 'header_sticky dark';
		}

		return $classes;
	}

	/**
	 * Get template wrapper classes
	 *
	 * @param array $classes
	 * @return string
	 */
	public function get_wrap_class( $classes = array() ) {
		$classes[] = 'ak-' . $this->template_id . '-wrap';

		$classes[] = 'ak-layout-' . $this->get_layout();

		$classes[] = 'clearfix';

		$class = apply_filters( 'newsy_content_wrap_class', $classes, $this->template_id, $this->id );

		return implode( ' ', $class );
	}

	/**
	 * Get template layout style.
	 *
	 * @return string
	 */
	public function get_layout_style() {
		return $this->get_option( 'layout_style', 'full-width', true );
	}

	/**
	 * Get template layout type.
	 *
	 * @return string
	 */
	public function get_layout() {
		return $this->get_option( 'layout', 'style-1', true );
	}

	/**
	 * Get template layout settings.
	 *
	 * @return array
	 */
	public function get_layout_setting() {
		$layout = $this->get_layout();

		$this->set_block_width( 2 );

		switch ( $layout ) {
			case 'style-1':
				$column = array(
					'content'   => 'ak_column_2 col-md-8',
					'primary'   => 'ak_column_1 col-md-4',
					'secondary' => false,
				);
				break;

			case 'style-2':
				$column = array(
					'content'   => 'ak_column_2 col-md-8 col-md-push-4',
					'primary'   => 'ak_column_1 col-md-4 col-md-pull-8',
					'secondary' => false,
				);
				break;

			case 'style-3':
				$this->set_block_width( 3 );

				$column = array(
					'content'   => 'ak_column_3 col-md-12',
					'primary'   => false,
					'secondary' => false,
				);
				break;

			case 'style-4':
				$column = array(
					'content'   => 'ak_column_2 col-md-7',
					'primary'   => 'ak_column_1 col-md-3',
					'secondary' => 'ak_column_1 col-md-2',
				);
				break;

			case 'style-5':
				$column = array(
					'content'   => 'ak_column_2 col-md-7',
					'primary'   => 'ak_column_1 col-md-3 col-md-push-2',
					'secondary' => 'ak_column_1 col-md-2 col-md-pull-3',
				);
				break;

			case 'style-6':
				$column = array(
					'content'   => 'ak_column_2 col-md-7 col-md-push-3',
					'primary'   => 'ak_column_1 col-md-3 col-md-pull-7',
					'secondary' => 'ak_column_1 col-md-2',
				);
				break;

			case 'style-7':
				$column = array(
					'content'   => 'ak_column_2 col-md-7 col-md-push-2',
					'primary'   => 'ak_column_1 col-md-3 col-md-push-2',
					'secondary' => 'ak_column_1 col-md-2 col-md-pull-10',
				);
				break;

			case 'style-8':
				$column = array(
					'content'   => 'ak_column_2 col-md-7 col-md-push-5',
					'primary'   => 'ak_column_1 col-md-3 col-md-pull-7',
					'secondary' => 'ak_column_1 col-md-2 col-md-pull-7',
				);
				break;

			case 'style-9':
				$column = array(
					'content'   => 'ak_column_2 col-md-7 col-md-push-5',
					'primary'   => 'ak_column_1 col-md-3 col-md-pull-5',
					'secondary' => 'ak_column_1 col-md-2 col-md-pull-10',
				);
				break;
			default:
				$column = array();
				break;
		}

		return apply_filters( 'newsy_layout_columns', $column, $layout );
	}

	/**
	 * Get template layout content classes.
	 *
	 * @return string
	 */
	public function get_content_class() {
		$this->layout = $this->get_layout_setting();

		return $this->layout['content'];
	}

	/**
	 * Handle template layout sidebar.
	 *
	 * @return mixed
	 */
	public function get_sidebar() {
		if ( $this->layout['primary'] ) {
			$this->render_sidebar( 'primary' );
		}
		if ( $this->layout['secondary'] ) {
			$this->render_sidebar( 'secondary' );
		}
	}

	/**
	 * Render template layout sidebar.
	 *
	 * @return mixed
	 */
	public function render_sidebar( $sidebar_id ) {
		$this->set_block_width( 1 );

		$sidebar = $this->get_option( $sidebar_id . '_sidebar', $sidebar_id . '-sidebar' ); ?>
		<div class="<?php echo esc_attr( $this->layout[ $sidebar_id ] ); ?> sidebar-column sidebar-column-<?php echo esc_attr( $sidebar_id ); ?> sticky-sidebar">
			<div class="sidebar <?php echo esc_attr( $sidebar ); ?>">
				<?php dynamic_sidebar( $sidebar ); ?>
			</div><!-- .<?php echo esc_attr( $sidebar ); ?>-section -->
		</div><!-- .<?php echo esc_attr( $sidebar_id ); ?>-section -->
		<?php
	}

	/**
	 * Render template breadcrumb.
	 *
	 * @return mixed
	 */
	public function get_breadcrumb( $container = false, $render = true, $page = null ) {
		if ( $this->get_option( 'show_breadcrumb' ) === 'hide' ) {
			return;
		}

		$args = array( 'echo' => false );

		if ( $container ) {
			$args = array(
				'before' => '<div class="container">',
				'after'  => '</div>',
				'echo'   => false,
			);
		}

		if ( ! function_exists( 'ak_get_breadcrumb' ) ) {
			return;
		}

		$breadcrumb = ak_get_breadcrumb( $args, $page );

		if ( ! $render ) {
			return $breadcrumb;
		}

		newsy_sanitize_echo( $breadcrumb );
	}

	/**
	 * Change main menu for template page.
	 *
	 * @param array $args main menu args
	 *
	 * @return array
	 */
	public function main_menu_args( $args ) {
		$main_menu = $this->get_option( 'main_nav_menu' );

		if ( ! empty( $main_menu ) ) {
			$args['menu'] = $main_menu;
		}

		return $args;
	}

	/**
	 * Get the template option.
	 *
	 * @param string $key Template item key.
	 * @param string $default_value Template item default value.
	 * @param boolean $global_option Specify if the option is global option.
	 *
	 * @return mixed
	 */
	protected function get_option( $key, $default_value = '', $global_option = true ) {
		return newsy_get_template_option( $key, $default_value, $this->template_id, $this->id, $global_option );
	}

	/**
	 * Set the current template id.
	 *
	 * @param string $template_id Template ID.
	 *
	 * @return void
	 */
	public function set_template_id( $template_id ) {
		$this->template_id = $template_id;
	}

	public function set_block_width( $width ) {
		add_filter(
			'newsy_block_width', function() use ( $width ) {
				return $width;
			}
		);
	}
}
