<?php
namespace ExclusiveAddons\Elementor;
use WPML_Elementor_Module_With_Items;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Class WPML_Exad_Accordion
 */
class WPML_Exad_Accordion extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return [ 'exad_exclusive_accordion_tab' ];
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return [ 'exad_exclusive_accordion_title', 'exad_exclusive_accordion_content', 'exad_accordion_read_more_btn_text', 'exad_accordion_read_more_btn_url' ];
	}
	
	/**
	 * @param string $field
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {

			case 'exad_exclusive_accordion_title':
				return esc_html__( 'Title', 'exclusive-addons-elementor' );
				
			case 'exad_exclusive_accordion_content':
				return esc_html__( 'Content', 'exclusive-addons-elementor' );

			case 'exad_accordion_read_more_btn_text':
				return esc_html__( 'Button Text', 'exclusive-addons-elementor' );

			case 'exad_accordion_read_more_btn_url':
				return esc_html__( 'Button URL', 'exclusive-addons-elementor' );

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
			case 'exad_exclusive_accordion_title':
				return 'LINE';

			case 'exad_exclusive_accordion_content':
				return 'VISUAL';

			case 'exad_accordion_read_more_btn_text':
				return 'LINE';

			case 'exad_accordion_read_more_btn_url':
				return 'LINK';

			default:
				return '';
		}
	}

}
