<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Image_Magnifier extends Widget_Base {
	
	public function get_name() {
		return 'exad-image-magnifier';
    }
    
	public function get_title() {
		return esc_html__( 'Image Magnifier', 'exclusive-addons-elementor' );
    }
    
	public function get_icon() {
		return 'exad-element-icon eicon-zoom-in';
    }
    
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
    }

    public function get_keywords() {
		return [ 'magnify', 'zoom', 'magnifier', 'image' ];
	}
    
	protected function _register_controls() {
    /*
    * image Comparison
    */
    $this->start_controls_section(
      'exad_section_comparison_image',
        [
            'label' => esc_html__( 'Contents', 'exclusive-addons-elementor' )
        ]
    );

    $this->add_control(
        'exad_magnify_image',
        [
            'label'   => esc_html__( 'Image', 'exclusive-addons-elementor' ),
            'type'    => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src()
            ]
        ]
    );

    $this->add_group_control(
        Group_Control_Image_Size::get_type(),
        [
            'name'    => 'magnify_image_size',
            'default' => 'full'
        ]
    );

    $this->end_controls_section();

    /*
    * image Comparison Style
    */
    $this->start_controls_section(
        'exad_section_image_magnefic_container',
        [
            'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
            'tab'   => Controls_Manager::TAB_STYLE
        ]
    );

    $this->add_responsive_control(
        'exa_image_magnefic_container_image_width',
        [
            'label'       => __( 'Width', 'exclusive-addons-elementor' ),
            'type'        => Controls_Manager::SLIDER,
            'size_units'  => [ 'px', '%' ],
            'range'       => [
                'px'      => [
                    'min' => 0,
                    'max' => 1000
                ],
                '%'       => [
                    'min' => 0,
                    'max' => 100
                ]
            ],
            'default'     => [
                'unit'    => '%',
                'size'    => 100
            ],
            'selectors'   => [
                '{{WRAPPER}} .exad-magnify-small' => 'width: {{SIZE}}{{UNIT}};'
            ]
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name'     => 'exa_image_magnefic_container_image_border',
            'label'    => __( 'Border', 'exclusive-addons-elementor' ),
            'selector' => '{{WRAPPER}} .exad-magnify-small'
        ]
    );

    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name'     => 'exa_image_magnefic_container_image_box_shadow',
            'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
            'selector' => '{{WRAPPER}} .exad-magnify-small'
        ]
    );
    
    $this->end_controls_section();

    /*
    * image Comparison Style
    */
    $this->start_controls_section(
        'exad_section_image_magnefic_glass_style',
        [
            'label' => esc_html__( 'Magnific Glass', 'exclusive-addons-elementor' ),
            'tab'   => Controls_Manager::TAB_STYLE
        ]
    );

    $this->add_responsive_control(
        'exad_image_magnefic_glass_height',
        [
            'label'       => __( 'Height', 'exclusive-addons-elementor' ),
            'type'        => Controls_Manager::SLIDER,
            'size_units'  => [ 'px' ],
            'range'       => [
                'px'      => [
                    'min' => 0,
                    'max' => 1000
                ]
            ],
            'default'     => [
                'unit'    => 'px',
                'size'    => 150
            ],
            'selectors'   => [
                '{{WRAPPER}} .exad-magnify-large' => 'height: {{SIZE}}{{UNIT}};'
            ]
        ]
    );

    $this->add_responsive_control(
        'exad_image_magnefic_glass_width',
        [
            'label'       => __( 'Width', 'exclusive-addons-elementor' ),
            'type'        => Controls_Manager::SLIDER,
            'size_units'  => [ 'px' ],
            'range'       => [
                'px'      => [
                    'min' => 0,
                    'max' => 1000
                ]
            ],
            'default'     => [
                'unit'    => 'px',
                'size'    => 150
            ],
            'selectors'   => [
                '{{WRAPPER}} .exad-magnify-large' => 'width: {{SIZE}}{{UNIT}};'
            ]
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name'            => 'exad_image_magnefic_glass_border',
            'label'           => __( 'Border', 'exclusive-addons-elementor' ),
            'fields_options'  => [
                'border'      => [
                    'default' => 'solid'
                ],
                'width'       => [
                    'default' => [
                        'top'    => '1',
                        'right'  => '1',
                        'bottom' => '1',
                        'left'   => '1'
                    ]
                ],
                'color'       => [
                    'default' => '#cccccc'
                ]
            ],
            'selector'        => '{{WRAPPER}} .exad-magnify-large'
        ]
    );

    $this->add_responsive_control(
        'exad_image_magnefic_glass_radius',
        [
            'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'default'    => [
                'top'    => '50',
                'right'  => '50',
                'bottom' => '50',
                'left'   => '50',
                'unit'   => '%'
            ],
            'selectors'  => [
                '{{WRAPPER}} .exad-magnify-large' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ]
        ]
    );

    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name'     => 'exad_image_magnefic_glass_box_shadow',
            'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
            'selector' => '{{WRAPPER}} .exad-magnify-large'
        ]
    );
    
    $this->end_controls_section();

    }
    
	protected function render() {

        $settings              = $this->get_settings_for_display();
        $magnify_image         = $this->get_settings_for_display( 'exad_magnify_image' );
        $magnify_image_src_url = Group_Control_Image_Size::get_attachment_image_src( $magnify_image['id'], 'magnify_image_size', $settings );

        if( empty( $magnify_image_src_url ) ) {
            $magnify_image_url = $magnify_image['url']; 
        } else { 
            $magnify_image_url = $magnify_image_src_url;
        }

        echo '<div class="exad-image-magnify">';
            echo '<div class="exad-magnify-large"></div>';
            echo '<img class="exad-magnify-small" src="'.esc_url( $magnify_image_url ).'" alt="'.Control_Media::get_image_alt( $settings['exad_magnify_image'] ).'">';
        echo '</div>';
	}
}