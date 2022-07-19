<?php
namespace ExclusiveAddons\Elementor;
use WPML_Elementor_Module_With_Items;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Class WPML_Exad_Tabs
 */
class WPML_Exad_Tabs extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return [ 'exad_exclusive_tabs' ];
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return [ 'exad_tab_content_shortcode', 'exad_exclusive_tab_title', 'exad_exclusive_tab_detail_btn' ];
	}
	
	/**
	 * @param string $field
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {

			case 'exad_tab_content_shortcode':
				return esc_html__( 'Enter your shortcode', 'exclusive-addons-elementor' );

            case 'exad_exclusive_tab_title':
                return esc_html__( 'Title', 'exclusive-addons-elementor' );
            
            case 'exad_exclusive_tab_detail_btn':
                return esc_html__( 'Details Button Text', 'exclusive-addons-elementor' );

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
			case 'exad_tab_content_shortcode':
				return 'LINE';

            case 'exad_exclusive_tab_title':
                return 'LINE';
            
            case 'exad_exclusive_tab_detail_btn':
                return 'LINE';

			default:
				return '';
		}
	}

}
