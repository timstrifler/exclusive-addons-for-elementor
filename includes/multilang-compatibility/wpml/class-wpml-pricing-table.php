<?php
namespace ExclusiveAddons\Elementor;

/**
 * Class WPML_Exad_Pricing_Table
 */
class WPML_Exad_Pricing_Table extends \WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return [ 'exad_pricing_table_items' ];
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return [ 'exad_pricing_table_item' ];
	}
	
	/**
	 * @param string $field
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {

			case 'exad_pricing_table_item':
				return esc_html__( 'List Item', 'exclusive-addons-elementor' );

			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch( $field ) {
			case 'exad_pricing_table_item':
				return 'LINE';

			default:
				return '';
		}
	}

}
