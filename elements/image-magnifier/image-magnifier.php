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

    public function get_script_depends() {
		return [ 'exad-image-magnifier' ];
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
        'exad_comparison_image_one',
        [
            'label' => esc_html__( 'Image One', 'exclusive-addons-elementor' ),
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
            'condition' => [
                'exad_comparison_image_one[url]!' => '',
            ],
        ]
    );
    

    $this->add_control(
        'exad_comparison_image_two',
        [
            'label' => esc_html__( 'Image Two', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
        ]
    );
    $this->add_group_control(
        Group_Control_Image_Size::get_type(),
        [
            'name' => 'thumbnail_two',
            'default' => 'full',
            'condition' => [
                'exad_comparison_image_two[url]!' => '',
            ],
        ]
    );


    $this->end_controls_section();

    /*
    * image Comparison Style
    */
    $this->start_controls_section(
        'exad_section_image_comparision_styles_presets',
        [
            'label' => esc_html__( 'General', 'exclusive-addons-elementor' ),
            'tab' => Controls_Manager::TAB_STYLE
        ]
    );
    

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'exad_img_comparison_border',
            'selector' => '{{WRAPPER}} .exad-image-comparision .exad-image-comparision-element',
        ]
    );


    $this->add_control(
        'exad_img_comparison_border_radius',
        [
            'label'       => __( 'Border Radius', 'exclusive-addons-elementor' ),
            'type'        => Controls_Manager::DIMENSIONS,
            'size_units'  => [ 'px', '%' ],
            'default'     => [
                'top' => '',
                'right' => '',
                'bottom' => '',
                'left' => '',
                'isLinked' => true,
            ],
            'selectors'   => [
                '{{WRAPPER}} .exad-image-comparision .exad-image-comparision-element' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    
    $this->add_control(
        'exad_image_magnifier_handle_type',
        [
            'label' => esc_html__( 'Handle Bar Type', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'vertical',
            'options' => [
                'vertical' => esc_html__( 'Horizontal', 'exclusive-addons-elementor' ),
                'horizontal' => esc_html__( 'Vertical', 'exclusive-addons-elementor' ),
            ],
        ]
    );

    $this->add_control(
        'exad_image_magnifier_slider_handle',
        [
            'label' => esc_html__( 'Handle Style', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'handle-style-1',
            'options' => [
                'handle-style-1' => esc_html__( 'Style 1', 'exclusive-addons-elementor' ),
                'handle-style-2' => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
            ],
        ]
    );

    $this->add_control(
		'exad_no_overlay',
		[
            'label'             => esc_html__( 'Disable Overlay', 'exclusive-addons-elementor' ),
            'type'              => Controls_Manager::SWITCHER,
            'default'           => 'true',
            'label_on'          => __( 'On', 'exclusive-addons-elementor' ),
            'label_off'         => __( 'Off', 'exclusive-addons-elementor' ),
            'return_value'      => 'true',
		]
    );

    $this->add_control(
        'exad_before_label',
        [
            'label' => esc_html__( 'Overlay Before Text', 'exclusive-addons-elementor' ),
            'type'  => Controls_Manager::TEXT,
            'condition' => [
                'exad_no_overlay' => ''
            ]
        ]
    );

    $this->add_control(
        'exad_after_label',
        [
            'label' => esc_html__( 'Overlay After Text', 'exclusive-addons-elementor' ),
            'type'  => Controls_Manager::TEXT,
            'condition' => [
                'exad_no_overlay' => ''
            ]
        ]
    );
    
    $this->add_control(
		'exad_default_offset_pct',
        [
			'label' => esc_html__( 'Handle Bar Position', 'exclusive-addons-elementor' ),
            'type'  => Controls_Manager::SELECT,
            'default' => '0.5',
            'options' => [
                    '0.0' => __( '0', 'exclusive-addons-elementor' ),
                    '0.1' => __( '1', 'exclusive-addons-elementor' ),
					'0.2' => __( '2', 'exclusive-addons-elementor' ),
					'0.3' => __( '3', 'exclusive-addons-elementor' ),
					'0.4' => __( '4', 'exclusive-addons-elementor' ),
					'0.5' => __( '5', 'exclusive-addons-elementor' ),
					'0.6' => __( '6', 'exclusive-addons-elementor' ),
					'0.7' => __( '7', 'exclusive-addons-elementor' ),
					'0.8' => __( '8', 'exclusive-addons-elementor' ),
					'0.9' => __( '9', 'exclusive-addons-elementor' ),
					'1.0' => __( '10', 'exclusive-addons-elementor' ),
                ]
			]
	);
    
    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name'     => 'exad_image_magnifier_box_shadow',
            'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
            'selector' => '{{WRAPPER}} .exad-image-comparision .exad-image-comparision-element'
        ]
    );
    
    $this->end_controls_section();

    }
    

	protected function render() {

    $settings = $this->get_settings_for_display();
    $comparison_image_one = $this->get_settings_for_display( 'exad_comparison_image_one' );
    $comparison_image_two = $this->get_settings_for_display( 'exad_comparison_image_two' );
	$comparison_image_url_one_src = Group_Control_Image_Size::get_attachment_image_src( $comparison_image_one['id'], 'thumbnail', $settings );
	$comparison_image_url_two_src = Group_Control_Image_Size::get_attachment_image_src( $comparison_image_two['id'], 'thumbnail_two', $settings );

		if( empty( $comparison_image_url_one_src ) ) {
			$comparison_image_url_one = $comparison_image_one['url']; 
		} else { 
			$comparison_image_url_one = $comparison_image_url_one_src;
		}

		if( empty( $comparison_image_url_two_src ) ) {
			$comparison_image_url_two = $comparison_image_two['url']; 
		} else { 
			$comparison_image_url_two = $comparison_image_url_two_src;
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
    <div class="magnify">
     
        <div class="large"></div>
         
         <img class="small" src="<?php echo esc_url( $comparison_image_url_one ); ?>"/>
        
    </div>


    <?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Image_Magnifier() );