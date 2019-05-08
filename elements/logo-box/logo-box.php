<?php
namespace Elementor;

class Exad_Logo extends Widget_Base {
	
	public function get_name() {
		return 'exad-logo';
	}
	public function get_title() {
		return esc_html__( 'Logo Box', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-logo';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	protected function _register_controls() {
    /*
    * Logo Image
    */
    $this->start_controls_section(
        'exad_section_logo_image',
        [
            'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
        ]
    );
    
    $this->add_control(
        'exad_logo_image',
        [
            'label' => esc_html__( 'Logo Image', 'exclusive-addons-elementor' ),
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
                'exad_logo_image[url]!' => '',
            ],
        ]
    );

    $this->add_control(
        'exad_logo_box_enable_link',
        [
            'label' => __( 'Enable Link', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
            'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );

    $this->add_control(
        'exad_logo_box_link',
        [
            'label' => __( 'Link', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::URL,
            'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
            'show_external' => true,
            'default' => [
                'url' => '',
                'is_external' => true,
                'nofollow' => true,
            ],
            'condition'=>[
                'exad_logo_box_enable_link'=>'yes',
            ]
        ]
    );
    
    $this->end_controls_section();

    /*
    * Logo Style
    *
    */
	$this->start_controls_section(
		'exad_section_logo_style',
		[
            'label' => esc_html__( 'Style', 'exclusive-addons-elementor' ),
            'tab' => Controls_Manager::TAB_STYLE
		]
    );

    $this->start_controls_tabs( 'exad_logo_tabs' );

	/*
	* Normal tab
    */
    $this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

    $this->add_control(
		'exad_logo_background',
			[
            'label' => __( 'Background Style', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::HEADING
			]
    );
    $this->add_group_control(
		Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .exad-logo .exad-logo-item',
			]
    );

    
    $this->add_control(
		'exad_logo_opacity_style',
		[
            'label' => __( 'Opacity', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::HEADING
		]
    );
    $this->add_control(
        'exad_logo_opacity',
        [
            'label' => __('Opacity', 'exclusive-addons-elementor'),
            'type' => Controls_Manager::NUMBER,
		    'range' => [
            'min' => 0,
            'max' => 1
		],
            'selectors' => [
                '{{WRAPPER}} .exad-logo .exad-logo-item img' => 'opacity: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
			'exad_logo_shadow_style',
			[
        'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::HEADING
			]
    );
    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      [
        'name' => 'box_shadow',
        'label' => __('Box shadow', 'exclusive-addons-elementor'),
        'selector' => '{{WRAPPER}} .exad-logo .exad-logo-item'
      ]
    );

    $this->end_controls_tab();

	/*
	* Hover tab
    */
    $this->start_controls_tab( 'exad_exclusive_button_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );
    $this->add_control(
			'exad_logo_hover_background',
			[
                'label' => __( 'Background Style', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::HEADING
			]
    );
    $this->add_group_control(
        Group_Control_Background::get_type(),
        [
            'name' => 'background_hover',
            'label' => __( 'Background', 'exclusive-addons-elementor' ),
            'types' => [ 'classic', 'gradient' ],
            'separator' => 'before',
            'selector' => '{{WRAPPER}} .exad-logo .exad-logo-item:hover',
        ]
    );

    $this->add_control(
		'exad_logo_opacity_hover_style',
		[
            'label' => __( 'Opacity', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::HEADING
		]
    );

    $this->add_control(
        'exad_logo_hover_opacity',
        [
            'label' => __('Opacity', 'exclusive-addons-elementor'),
            'type' => Controls_Manager::NUMBER,
                'range' => [
                'min' => 0,
                'max' => 1
                ],
            'default' => __( 'From 0.1 to 1', 'exclusive-addons-elementor' ),
            'selectors' => [
                '{{WRAPPER}} .exad-logo .exad-logo-item:hover img' => 'opacity: {{VALUE}};',
            ],
        ]
    );
		
    $this->add_control(
        'exad_logo_shadow_hover_style',
        [
            'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::HEADING
        ]
    );

    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'box_hover_shadow',
            'label' => __('Box shadow', 'exclusive-addons-elementor'),
            'selector' => '{{WRAPPER}} .exad-logo .exad-logo-item:hover'
        ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();

    $this->add_control(
        'exad_logo_padding',
        [
            'label'          => __( 'Padding', 'exclusive-addons-elementor' ),
            'type'           => Controls_Manager::DIMENSIONS,
            'size_units'     => [ 'px', 'em', '%' ],
            'selectors'      => [
                '{{WRAPPER}} .exad-logo .exad-logo-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'separator' => 'before',
            'default' => [
                'top' => 20,
                'right' => 20,
                'bottom' => 20,
                'left' => 20,
                'unit' => 'px'
            ]
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'border',
            'label' => __('Border', 'exclusive-addons-elementor'),
            'selector' => '{{WRAPPER}} .exad-logo .exad-logo-item',
        ]
    );
    $this->add_control(
		'exad_logo_border_radius',
        [
            'label'         => __( 'Border Radius', 'exclusive-addons-elementor' ),
            'type'          => Controls_Manager::DIMENSIONS,
            'size_units'    => [ 'px', 'em', '%' ],
            'selectors'     => [
                '{{WRAPPER}} .exad-logo .exad-logo-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();
	}
	protected function render() {
        $settings = $this->get_settings_for_display();
		
		$logo_image = $this->get_settings_for_display( 'exad_logo_image' );
		$logo_image_url = Group_Control_Image_Size::get_attachment_image_src( $logo_image['id'], 'thumbnail', $settings );

		if ( empty( $logo_image_url ) ) {
			$logo_image_url = $logo_image['url'];
		}  else {
			$logo_image_url = $logo_image_url;
        }
        
        $target = $settings['exad_logo_box_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['exad_logo_box_link']['nofollow'] ? ' rel="nofollow"' : '';

    ?>
        <div id="exad-logo-<?php echo esc_attr($this->get_id()); ?>" class="exad-logo one">
            <div class="exad-logo-item">
                <?php if( ! empty( $settings['exad_logo_image'] ) ) { ?>
                    <?php if( $settings['exad_logo_box_enable_link'] === 'yes' ) { ?>
                        <a href="<?php echo esc_url( $settings['exad_logo_box_link']['url'] ); ?>" <?php echo $target . $nofollow ?> >
                    <?php } ?>
                        <img src="<?php echo esc_url( $logo_image_url ); ?>">
                    <?php if( $settings['exad_logo_box_enable_link'] === 'yes' ) { ?>
                        </a>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>

    <?php
	}

	protected function _content_template() { ?>
    
        <div id="exad-logo" class="exad-logo">
            <div class="exad-logo-item">
                <# if ( settings.exad_logo_image !== '' ) { #>
                    <# if( settings.exad_logo_box_enable_link === 'yes' ) { #>
                        <a href="{{{ settings.exad_logo_box_link.url }}}">
                    <# } #>
                        <img src="{{{ settings.exad_logo_image.url }}}">
                    <# if( settings.exad_logo_box_enable_link === 'yes' ) { #>
                        </a>
                    <# } #>    
                <# } #>
            </div>
        </div>

    <?php 
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Logo() );