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

	protected function _register_controls() {
    /*
    * Animated Text Content
    */
    $this->start_controls_section(
        'exad_section_animated_text_content',
        [
            'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
        ]
	);
	
	$this->add_control(
        'exad_animated_text_before_text',
        [
			'label' => esc_html__( 'Before Animated Text', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::TEXTAREA,
        ]
	);
	
	$this->add_control(
        'exad_first_string',
        [
			'label' => esc_html__( 'First Text', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::TEXT,
        ]
	);
	
	$this->add_control(
        'exad_second_string',
        [
			'label' => esc_html__( 'Second Text', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::TEXT,
        ]
	);
	
	$this->add_control(
        'exad_animated_text_after_text',
        [
			'label' => esc_html__( 'After Animated Text', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::TEXTAREA,
        ]
	);

    $this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
	?>
		<div id="typed-strings" data-first_string='<?php echo esc_attr( $settings['exad_first_string'] ); ?>' 
		data-second_string='<?php echo esc_attr( $settings['exad_second_string'] ); ?>' >
			<div>
				<?php echo esc_attr( $settings['exad_animated_text_before_text'] ); ?>
					<span id="typed"></span>
				<?php echo esc_attr( $settings['exad_animated_text_after_text'] ); ?>
			</div>
		</div>
	<?php
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Animated_Text() );