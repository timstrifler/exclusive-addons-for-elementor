<?php
namespace Elementor;

class Exad_modal_popup extends Widget_Base {
	
	public function get_name() {
		return 'exad-modal-popup';
	}
	public function get_title() {
		return esc_html__( 'Modal Popup', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-eye';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	protected function _register_controls() {
		
	}
	protected function render() {

	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_modal_popup() );