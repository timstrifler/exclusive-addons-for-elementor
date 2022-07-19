<?php
namespace ExclusiveAddons\Elementor;
use WPML_Elementor_Module_With_Items;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Class WPML_Exad_Modal_Popup
 */
class WPML_Exad_Modal_Popup extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return [ 'exad_modal_image_gallery_repeater' ];
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return [ 'exad_modal_image_gallery_text' ];
	}
	
	/**
	 * @param string $field
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {

			case 'exad_modal_image_gallery_text':
				return esc_html__( 'Description', 'exclusive-addons-elementor' );

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
			case 'exad_modal_image_gallery_text':
				return 'AREA';

			default:
				return '';
		}
	}

}
