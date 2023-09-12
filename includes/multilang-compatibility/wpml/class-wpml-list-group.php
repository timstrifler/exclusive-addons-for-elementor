<?php
namespace ExclusiveAddons\Elementor;
use WPML_Elementor_Module_With_Items;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Class WPML_Exad_List_group
 */
class WPML_Exad_List_group extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return [ 'exad_list_group' ];
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return [ 'exad_list_icon_number', 'exad_list_text' ];
	}
	
	/**
	 * @param string $field
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {

            case 'exad_list_icon_number':
				return esc_html__( 'Number', 'exclusive-addons-elementor' );

			case 'exad_list_text':
				return esc_html__( 'Text', 'exclusive-addons-elementor' );

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
            case 'exad_list_icon_number':
				return 'LINE';

			case 'exad_list_text':
				return 'LINE';

			default:
				return '';
		}
	}

}
