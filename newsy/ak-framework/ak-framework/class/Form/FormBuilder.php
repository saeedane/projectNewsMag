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
namespace Ak\Form;

/**
 * Class Form Builder.
 *
 * @todo refactor this class.
 *
 * @package  ak-framework
 */
class FormBuilder {

	/**
	 * FormManager.
	 *
	 * @var FormManager
	 */
	protected $manager;

	/**
	 * Used for generating start tag of sections.
	 *
	 * @since  1.0
	 *
	 * @var boolean
	 */
	private $section_started = false;

	/**
	 * Used for generating start tag of fields group.
	 *
	 * @since  1.0
	 *
	 * @var boolean
	 */
	private $group_started = false;

	/**
	 * @param mixed $manager FormManager
	 */
	public function render( $manager ) {
		$this->manager = $manager;

		$args        = $this->manager->get_args();
		$panel_class = $args['panel_class'];
		$panel_id    = $args['panel_id'];

		$id_attr = ! empty( $panel_id ) ? 'id="' . esc_attr( $panel_id ) . '"' : '';

		$buffy  = '<div ' . $id_attr . ' class="ak-panel-main ' . esc_attr( $panel_class ) . ' ak-clearfix">';
		$buffy .= '<div class="ak-panel-menu ak-clearfix">';
		$buffy .= $this->generate_sections();
		$buffy .= '</div>';
		$buffy .= '<div class="ak-panel-content">';
		$buffy .= $this->generate_fields();
		$buffy .= '</div>';
		$buffy .= '</div>';

		return $buffy;
	}

		/**
	 * @param mixed $manager FormManager
	 */
	public function render_for_mix_fields( $manager ) {
		$this->manager = $manager;

		return $this->generate_mix_fields();
	}


	/**
	 * Return The HTML Output of sections.
	 *
	 * @return string
	 */
	public function generate_sections() {
		$out      = '';
		$sections = $this->manager->get_sections();

		$out .= '<ul>';

		foreach ( $sections as $section_id => $section ) {
			$type = &$section['type'];

			switch ( $type ) {
				case 'section_separator':
					$out .= '<li class="ak-panel-menu-separator">' . esc_html( $section['heading'] ) . '</li>';
					break;

				case 'section_link':
					$out .= '<li>';
					$out .= '<a href="' . esc_url( $section['href'] ) . '">';
					if ( isset( $section['icon'] ) ) {
						$out .= ak_get_icon( $section['icon'] );
					}
					$out .= $section['heading'];
					$out .= '</a>';
					$out .= '</li>';

					break;

				case 'section':
					$class = 'ak-menu-section ak-menu-section-' . $section_id;

					if ( isset( $section['ajax-section'] ) && $section['ajax-section'] ) {
						$class .= ' ak-menu-ajax-section';
					}

					$out .= '<li class="' . esc_attr( $class ) . '" data-section="' . esc_attr( $section_id ) . '">';
					$out .= '<a href="javascript:;">';

					if ( isset( $section['icon'] ) && '' !== $section['icon'] ) {
						$out .= ak_get_icon( $section['icon'] );
					}

					$out .= '<span>' . $section['heading'] . '</span>';

					if ( isset( $section['badge'] ) && isset( $section['badge']['text'] ) ) {
						$badge_style = '';

						if ( isset( $section['badge']['color'] ) ) {
							$badge_style = "style='background-color:{$section['badge']['color']};border-color:{$section['badge']['color']}'";
						}

						$out .= "<span class='ak-menu-section-badge' {$badge_style}>{$section['badge']['text']}</span>";
					}

					$out .= '</a>';

					$out .= '</li>';

					break;
			}
		}

		$out .= '</ul>';

		return $out;
	}

	/**
	 * Return The HTML output of section fields.
	 *
	 * @return string
	 */
	public function generate_fields() {
		$output = '';
		foreach ( $this->manager->get_sections() as $id => $section ) {
			if ( ! isset( $section['id'] ) ) {
				continue;
			}
			$section_id = &$section['id'];

			//open the section
			$output .= $this->render_section_start( $id );

			// filter section fields from fields array
			$section_fields = $this->manager->get_section_fields( $id );

			foreach ( $section_fields as $field ) {
				switch ( $field['type'] ) {
					case 'group_start':
							$output .= $this->render_group_start( $field );
						break;

					case 'group_end':
						$output .= $this->render_group_end();
						break;

					default:
						$output .= $this->render_field( $field );
						break;
				}
			}

			unset( $section_id, $section );
		}

		// close last section
		$output .= $this->render_section_end();

		return $output;
	}

	/**
	 * Return The HTML output of section fields.
	 *
	 * @return string
	 */
	public function generate_mix_fields() {
		$output = '';

		//open the section

		// filter section fields from fields array
		$field_count = 0;
		foreach ( $this->manager->get_fields() as $field ) {
			switch ( $field['type'] ) {
				case 'group_start':
					$output .= $this->render_group_start( $field );
					break;

				case 'group_end':
					$output .= $this->render_group_end();
					break;

				default:
					$field_count++;

					if ( ! empty( $field['field_col'] ) ) {
						$field_col = $field['field_col'];
					} else {
						$field_col = 1;
					}

					if ( 1 === $field_count ) {
						$output .= '<div class="ak-section-row">';
					}
					if ( isset( $field['container_class'] ) ) {
						$field['container_class'] = $field['container_class'] . ' ak-section-column-' . $field_col;
					} else {
						$field['container_class'] = 'ak-section-column-' . $field_col;
					}

					$output .= $this->render_field( $field );

					if ( $field_count === $field_col ) {
						$output     .= '</div>';
						$field_count = 0;
					}
					break;
			}
		}
		if ( $field_count > 0 ) {
			$output .= '</div>';
		}

		return $output;
	}

	/**
	 * Render the control.
	 *
	 * @param array     $field      Given field params
	 * @param boolean   $only_field Do not include field container
	 *
	 * @return string
	 */
	public static function render_field( $field, $only_field = false ) {
		$control_instance = FormManager::get_field_control_instance( $field );

		if ( ! $control_instance ) {
			return ak_is( 'dev' ) ? 'error:' . $field['type'] : null;
		}

		ob_start();
		if ( $only_field ) {
			$control_instance->render_content();
		} else {
			$control_instance->render();
		}

		return ob_get_clean();
	}

	/**
	 * Used for generating start tag of fields group.
	 *
	 * @param mixed $section_id
	 *
	 * @return string
	 */
	private function render_section_start( $section_id ) {
		$output = '';

		if ( $this->group_started ) {
			$output .= $this->render_group_end();
		}
		if ( $this->section_started ) {
			$output .= $this->render_section_end();
		}

		$this->section_started = true;

		$output .= "<section class='ak-panel-section ak-panel-section-{$section_id}' data-section='{$section_id}'>";

		return $output;
	}

	/**
	 * Used for generating start tag of fields group.
	 *
	 * @return string
	 */
	private function render_section_end() {
		$this->section_started = false;

		return  '</section>';
	}

	/**
	 * Used for generating start tag of fields group.
	 *
	 * @param array $group  Group params
	 *
	 * @return string
	 */
	private function render_group_start( $group ) {
		$output = '';

		if ( $this->group_started ) {
			$output .= $this->render_group_end();
		}

		$this->group_started = true;

		$group_container_class = 'ak-fields-group ak-clearfix';
		if ( isset( $group['container-class'] ) ) {
			$group_container_class .= ' ' . $group['container-class'];
		}

		$group_title_class = 'ak-fields-group-title-container';
		if ( isset( $group['title-class'] ) ) {
			$group_title_class .= ' ' . $group['title-class'];
		}

		if ( ! isset( $group['id'] ) ) {
			$group['id'] = time();
		}

		if ( isset( $group['color'] ) ) {
			$color = $group['color'];
		} else {
			$color = '';
		}

		// Collapsible feature
		if ( isset( $group['state'] ) && 'open' === $group['state'] ) {
			$state = 'open';
		} else {
			$state = 'close';
		}

		if ( 'close' === $state ) {
			$group_container_class .= ' collapsible close';
			$collapse_button        = '<span class="collapse-button"><i class="fa fa-chevron-down"></i></span>';
		} elseif ( 'open' === $state ) {
			$group_container_class .= ' collapsible open';
			$collapse_button        = '<span class="collapse-button"><i class="fa fa-chevron-up"></i></span>';
		} else {
			$group_container_class .= ' not-collapsible';
			$collapse_button        = '';
		}

		// Desc
		if ( ! empty( $group['desc'] ) ) {
			$desc = "<div class='ak-group-desc'>{$group['desc']}</div>";
		} else {
			$desc = '';
		}

		$output .= "<div class='{$group_container_class} {$color}' id='{$group['id']}'>";

		$output .= "<div class='{$group_title_class}'><span class='ak-fields-group-title'>{$group['heading']}</span>{$collapse_button}</div>";
		$output .= "<div class='ak-fields-group-content ak-clearfix' style='" . ( 'close' === $state ? 'display:none;' : '' ) . "'>$desc";

		return $output;
	}

	/**
	 * Used for generating close tag of fields group.
	 *
	 * @param $group
	 *
	 * @return string
	 */
	private function render_group_end() {
		$this->group_started = false;

		return '</div></div>';
	}
}
