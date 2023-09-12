<?php
namespace ExclusiveAddons\Elementor;
use WPML_Elementor_Module_With_Items;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Class WPML_Exad_Pricing_Menu
 */
class WPML_Exad_Pricing_Menu extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return [ 'pricing_menu_repeater' ];
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return [ 'exad_pricing_menu_title', 'exad_pricing_menu_description', 'exad_pricing_menu_price', 'exad_pricing_menu_action_text' ];
	}
	
	/**
	 * @param string $field
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {

			case 'exad_pricing_menu_title':
				return esc_html__( 'Title', 'exclusive-addons-elementor' );

            case 'exad_pricing_menu_description':
                return esc_html__( 'Description', 'exclusive-addons-elementor' );

            case 'exad_pricing_menu_price':
                return esc_html__( 'Price', 'exclusive-addons-elementor' );
            
            case 'exad_pricing_menu_action_text':
                return esc_html__( 'Order Action', 'exclusive-addons-elementor' );

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
			case 'exad_pricing_menu_title':
				return 'LINE';

            case 'exad_pricing_menu_description':
                return 'AREA';
            
            case 'exad_pricing_menu_price':
                return 'LINE';

            case 'exad_pricing_menu_action_text':
                return 'LINE';

			default:
				return '';
		}
	}

}
