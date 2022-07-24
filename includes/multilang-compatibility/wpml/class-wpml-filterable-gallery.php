<?php
namespace ExclusiveAddons\Elementor;
use WPML_Elementor_Module_With_Items;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Class WPML_Exad_Filterable_Gallery
 */
class WPML_Exad_Filterable_Gallery extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return [ 'exad_fg_gallery_items' ];
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return [ 'exad_fg_gallery_item_title', 'exad_fg_gallery_item_content', 'exad_fg_gallery_control_name', 'exad_fg_gallery_img_link' ];
	}
	
	/**
	 * @param string $field
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {

			case 'exad_fg_gallery_item_title':
				return esc_html__( 'Title', 'exclusive-addons-elementor' );

			case 'exad_fg_gallery_item_content':
				return esc_html__( 'Details', 'exclusive-addons-elementor' );

            case 'exad_fg_gallery_control_name':
				return esc_html__( 'Control Name', 'exclusive-addons-elementor' );

			case 'exad_fg_gallery_img_link':
				return esc_html__( 'Iamge Link URL', 'exclusive-addons-elementor' );

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
			case 'exad_fg_gallery_item_title':
				return 'LINE';

			case 'exad_fg_gallery_item_content':
				return 'AREA';

            case 'exad_fg_gallery_control_name':
				return 'LINE';

			case 'exad_fg_gallery_img_link':
				return 'LINK';

			default:
				return '';
		}
	}

}
