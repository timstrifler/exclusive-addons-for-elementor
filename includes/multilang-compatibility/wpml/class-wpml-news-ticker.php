<?php

/**
 * Class WPML_Exad_News_Ticker
 */
class WPML_Exad_News_Ticker extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return [ 'exad_news_ticker_items' ];
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return [ 'exad_news_ticker_title' ];
	}
	
	/**
	 * @param string $field
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {

			case 'exad_news_ticker_title':
				return esc_html__( 'Content', 'exclusive-addons-elementor' );

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
			case 'exad_news_ticker_title':
				return 'AREA';

			default:
				return '';
		}
	}

}
