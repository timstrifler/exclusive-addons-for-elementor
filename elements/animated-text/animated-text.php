<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Animated_Text extends Widget_Base {

	public function get_name() {
		return 'exad-animated-text';
	}

	public function get_title() {
		return esc_html__( 'Animated Text', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-text';
	}

   	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	  
 	public function get_script_depends() {
		return [ 'animated-text' ];
	}

	protected function render() {
	?>
		<div id="typed-strings">
			<p>Typed.js is a <strong>JavaScript</strong> library.</p>
			<p>It <em>types</em> out sentences.</p>
		</div>
		<span id="typed"></span>

	<?php
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Animated_Text() );