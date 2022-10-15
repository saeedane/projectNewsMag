<?php
namespace Ak\Customizer\Control;

/**
 * Adds a color & color-alpha control.
 *
 * @see https://github.com/23r9i0/ak-color-picker-alpha
 */
class Color extends ControlAbstract {
	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $_type = 'color';

	/**
	 * Colorpicker palette.
	 *
	 * @var bool
	 */
	public $palette = true;

	/**
	 * Colorpicker palette.
	 *
	 * @var bool
	 */
	public $alpha = true;

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 */
	public function to_json() {
		parent::to_json();

		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		} else {
			$this->json['default'] = $this->setting->default;
		}

		$this->json['palette'] = $this->palette;
		$this->json['alpha']   = $this->alpha;
	}

}
