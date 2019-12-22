<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Color;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Blob_Maker extends Widget_Base {
	
	public function get_name() {
		return 'exad-blob-maker';
	}

	public function get_title() {
		return esc_html__( 'Blob Maker', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-image-box';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
        return [ 'blob shape', 'shape' ];
    }

	protected function _register_controls() {
		
		/**
		* Blob_Maker Content Section
		*/
		$this->start_controls_section(
			'exad_blob_maker_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
			]
		);
		
		$this->add_control(
			'exad_blob_maker_color',
			[
				'label' => __( 'Title Color', 'plugin-domain' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
                ],
                'default' => '#FFB4BC'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        
    ?>

    <div class="exad-blob-maker">
        <svg
        width="600"
        height="600"
        viewBox="0 0 600 600"
        xmlns="http://www.w3.org/2000/svg"
        >
        <g transform="translate(300,300)">
            <path d="M129.9,75C86.6,150,-86.6,150,-129.9,75C-173.2,0,-86.6,-150,0,-150C86.6,-150,173.2,0,129.9,75Z" fill="<?php echo $settings['exad_blob_maker_color']; ?>" />
        </g>
        </svg>
  
    </div>

    <?php    
	}

}