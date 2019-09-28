<?php
namespace Elementor;

class Exad_Image_Magnifier extends Widget_Base {
	
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
            'label' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Image_Size::get_type(),
        [
            'name' => 'thumbnail',
            'default' => 'full',
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
            'tab' => Controls_Manager::TAB_STYLE
        ]
    );

    $this->add_control(
        'exa_image_magnefic_container_image_width',
        [
            'label' => __( 'Width', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'selectors' => [
                '{{WRAPPER}} .exad-magnify-small' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'exa_image_magnefic_container_image_border',
            'label' => __( 'Border', 'exclusive-addons-elementor' ),
            'selector' => '{{WRAPPER}} .exad-magnify-small',
        ]
    );

    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'exa_image_magnefic_container_image_box_shadow',
            'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
            'selector' => '{{WRAPPER}} .exad-magnify-small',
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
            'tab' => Controls_Manager::TAB_STYLE
        ]
    );

    $this->add_control(
        'exad_image_magnefic_glass_height',
        [
            'label' => __( 'Height', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 175,
            ],
            'selectors' => [
                '{{WRAPPER}} .exad-magnify-large' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'exad_image_magnefic_glass_width',
        [
            'label' => __( 'Width', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 175,
            ],
            'selectors' => [
                '{{WRAPPER}} .exad-magnify-large' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'exad_image_magnefic_glass_border',
            'label' => __( 'Border', 'exclusive-addons-elementor' ),
            'selector' => '{{WRAPPER}} .exad-magnify-large',
        ]
    );

    $this->add_control(
        'exad_image_magnefic_glass_radius',
        [
            'label' => __( 'Border Radius', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'default' => [
                'top' => '0',
                'right' => '0',
                'bottom' => '0',
                'left' => '0',
            ],
            'selectors' => [
                '{{WRAPPER}} .exad-magnify-large' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'exad_image_magnefic_glass_box_shadow',
            'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
            'selector' => '{{WRAPPER}} .exad-magnify-large',
        ]
    );
    
    $this->end_controls_section();

    }
    

	protected function render() {

    $settings = $this->get_settings_for_display();
    $magnify_image = $this->get_settings_for_display( 'exad_magnify_image' );
	$magnify_image_src_url = Group_Control_Image_Size::get_attachment_image_src( $magnify_image['id'], 'thumbnail', $settings );

		if( empty( $magnify_image_src_url ) ) {
			$magnify_image_url = $magnify_image['url']; 
		} else { 
			$magnify_image_url = $magnify_image_src_url;
		}
		
		$this->add_render_attribute( 'exad_image_magnifier_wrapper', [
            'class' => [ 'exad-image-magnifier', $settings['exad_image_magnifier_slider_handle'] ],
			'data-exad-before_label' => esc_attr( $settings['exad_before_label']),
			'data-exad-after_label'	=> esc_attr($settings['exad_after_label']),
            'data-exad-default_offset_pct' => esc_attr( $settings['exad_default_offset_pct'] ),
            'data-exad-oriantation' => esc_attr( $settings['exad_image_magnifier_handle_type'] ),
			'data-exad-no_overlay' => $settings['exad_no_overlay']
        ]);
        

    ?>
    
    <!-- Lets make a simple image magnifier -->
    <div class="exad-image-magnify">
        <div class="exad-magnify-large"></div>
        <img class="exad-magnify-small" src="<?php echo esc_url( $magnify_image_url ); ?>" />
    </div>

    <?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Image_Magnifier() );