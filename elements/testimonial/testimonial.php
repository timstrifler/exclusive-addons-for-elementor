<?php
namespace Elementor;

class Exad_Testimonial extends Widget_Base { 

    public function get_name() {
		return 'exad-testimonial';
	}

	public function get_title() {
		return esc_html__( 'Testimonial', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-blockquote';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
		
	protected function _register_controls() {
		
	}
			
	protected function render() {
		$settings = $this->get_settings_for_display();
	?>
	
	<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Exad_Testimonial() );
