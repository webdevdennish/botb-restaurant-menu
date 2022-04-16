<?php
/**
 * Elementor currency control.
 *
 * A control for displaying a select field with the ability to choose currencies.
 *
 * @since 1.0.0
 */
class Elementor_Currency_Control extends \Elementor\Base_Data_Control {

	/**
	 * Get currency control type.
	 *
	 * Retrieve the control type, in this case `currency`.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Control type.
	 */
	public function get_type() {
		return 'currency';
	}

	/**
	 * Get currencies.
	 *
	 * Retrieve all the available currencies.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return array Available currencies.
	 */
	public static function get_currencies() {
		// return [
		// 	'USD' => 'USD ($)',
		// 	'EUR' => 'EUR (€)',
		// 	'GBP' => 'GBP (£)',
		// 	'JPY' => 'JPY (¥)',
		// 	'ILS' => 'ILS (₪)',
		// ];
        return [
			'$' => 'USD ($)',
			'€' => 'EUR (€)',
			'£' => 'GBP (£)',
			'¥' => 'JPY (¥)',
			''    => 'NONE',
		];
	}

	/**
	 * Get currency control default settings.
	 *
	 * Retrieve the default settings of the currency control. Used to return
	 * the default settings while initializing the currency control.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return array Currency control default settings.
	 */
	protected function get_default_settings() {
		return [
			'currencies' => self::get_currencies()
		];
	}

	/**
	 * Get currency control default value.
	 *
	 * Retrieve the default value of the currency control. Used to return the
	 * default value while initializing the control.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Currency control default value.
	 */
	public function get_default_value() {
		//return 'EUR';
		return '$';
	}

	/**
	 * Render currency control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">

			<# if ( data.label ) {#>
			<label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<# } #>

			<div class="elementor-control-input-wrapper">
				<select id="<?php echo $control_uid; ?>" data-setting="{{ data.name }}">
					<option value=""><?php echo esc_html__( 'Select currency', 'elementor-currency-control' ); ?></option>
					<# _.each( data.currencies, function( currency_label, currency_value ) { #>
					<option value="{{ currency_value }}">{{{ currency_label }}}</option>
					<# } ); #>
				</select>
			</div>

		</div>

		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}

}