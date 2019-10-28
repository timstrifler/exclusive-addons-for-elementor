<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_CTA extends Widget_Base {

	public function get_name() {
		return 'exad-call-to-action';
	}

	public function get_title() {
		return esc_html__( 'Call To Action', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-flip-box';
	}

   	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function _register_controls() {

  		$this->start_controls_section(
			'exad_section_side_a_content',
			[
				'label' => __( 'Content', 'exclusive-addons-elementor' )
			]
		);

        $this->add_control(
            'exad_cta_skin_type',
            [
                'label'     => esc_html__( 'Skin Type', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'horizontal',
                'options'   => [
                    'horizontal'  => esc_html__( 'Horizontal',   'exclusive-addons-elementor' ),
                    'vertical'    => esc_html__( 'Vertical', 'exclusive-addons-elementor' )
                ]
            ]
        );

		$this->add_control(
			'exad_cta_heading',
			[
				'label'       => __( 'Heading', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Designers & Developer with Great UX', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Your Heading', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_cta_description',
			[
				'label'       => __( 'Description', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => __( 'Exclusive addons is collaborative project of some professional developer, designer & tested user experience of using it on some of user’s websites.', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Your Description', 'exclusive-addons-elementor' )
			]
		);

        $this->add_control(
            'exad_cta_icon',
            [
                'label'   => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::ICONS
            ]
        );

       $this->add_control(
            'exad_cta_fixed_width_enable',
            [
                'label'         => esc_html__( 'Fixed Width', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'return_value'  => 'yes',
                'default'       => 'no'
            ]
        );   

        $this->add_responsive_control(
            'exad_cta_vertical_size',
            [
                'label'         => esc_html__( 'Size', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SLIDER, 
                'size_units'    => [ 'px', '%' ],
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 1500,
                        'step'  => 5
                    ],
                    '%'         => [
                        'min'   => 0,
                        'max'   => 100
                    ]
                ],                
                'default'       => [
                    'size'      => 760,
                    'unit'      => 'px'
                ],  
                'selectors'     => [
                    '{{WRAPPER}} .exad-call-to-action .exad-call-to-action-content' => 'max-width: {{SIZE}}{{UNIT}};'
                ],
                'condition'     => [
                    '.exad_cta_skin_type'          => 'vertical',
                    '.exad_cta_fixed_width_enable' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_cta_vertical_alignment',
            [
                'label'         => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-left'
                    ],
                    'center'    => [
                        'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-center'
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-right'
                    ]
                ],
                'default'       => 'left',
                'condition'     => [
                    '.exad_cta_skin_type'          => 'vertical',
                    '.exad_cta_fixed_width_enable' => 'yes'
                ]
            ]
        ); 

		$this->end_controls_section();

        $this->start_controls_section(
            'exad_cta_primary_button_section',
            [
                'label' => esc_html__( 'Primary Button', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_cta_primary_btn',
            [
                'label'       => esc_html__( 'Button Text', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Get Now', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_cta_primary_btn_link',
            [
                'label'       => esc_html__( 'Button Link', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url'         => '#',
                    'is_external' => ''
                ],
                'show_external' => true
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_cta_secondary_button_section',
            [
                'label'     => esc_html__( 'Secondary Button', 'exclusive-addons-elementor' ),
                'condition' => [
                    'exad_cta_skin_type' => 'vertical'
                ]  
            ]
        );

        $this->add_control(
            'exad_cta_secondary_btn',
            [
                'label'       => esc_html__( 'Button Text', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Try It Now', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_cta_secondary_btn_link',
            [
                'label'       => esc_html__( 'Button Link', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url'         => '#',
                    'is_external' => ''
                ],
                'show_external' => true
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'exad_cta_container_style_settings',
			[
                'label' => __( 'Container', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
			]
		);

        $this->add_responsive_control(
            'exad_cta_container_padding',
            [
                'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,            
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top'    => 60,
                    'right'  => 50,
                    'bottom' => 60,
                    'left'   => 50,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                        '{{WRAPPER}} .exad-call-to-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'exad_cta_container_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f5f7fa',
                'selectors' => [
                    '{{WRAPPER}} .exad-call-to-action' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_cta_container_border',
                'label'    => esc_html__( 'Border', 'exclusive-addons-elementor' ),
                'selector' => '{{WRAPPER}} .exad-call-to-action'
            ]
        );

        $this->add_control(
            'exad_cta_container_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-call-to-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'exad_cta_container_box_shadow',
                'selector' => '{{WRAPPER}} .exad-call-to-action'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_cta_content_style_settings',
            [
                'label' => __( 'Content', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_cta_style_heading',
            [
                'label' => esc_html__( 'Heading', 'exclusive-addons-elementor' ),
                'type'  => Controls_Manager::HEADING
            ]
        );
		
        $this->add_control(
            'exad_cta_heading_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                'default'   => '#132c47',                
                'selectors' => [
                    '{{WRAPPER}} h1.exad-call-to-action-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'           => 'exad_cta_heading_typography',
                'selector'       => '{{WRAPPER}} h1.exad-call-to-action-title',
                'fields_options' => [
                    'font_size'   => [
                        'default' => [
                            'unit' => 'px',
                            'size' => 40
                        ]
                    ],
                    'font_weight' => [
                        'default' => '600'
                    ]
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_cta_heading_margin',
            [
                'label'      => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],                
                'selectors'  => [
                    '{{WRAPPER}} h1.exad-call-to-action-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'exad_cta_style_description',
            [
                'label'     => esc_html__( 'Description', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'exad_cta_description_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                'default'   => '#8a8d91',                
                'selectors' => [
                    '{{WRAPPER}} .exad-call-to-action-header p' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_cta_description_typography',
                'selector' => '{{WRAPPER}} .exad-call-to-action-header p'
            ]
        );

        $this->add_responsive_control(
            'exad_cta_description_margin',
            [
                'label'      => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],                
                'selectors'  => [
                        '{{WRAPPER}} .exad-call-to-action-header p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'exad_cta_style_icon',
            [
                'label'     => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'exad_cta_icon[value]!' => ''
                ]                
            ]
        );

        $this->add_control(
            'exad_call_to_action_icon_color',
            [
                'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fb4b15',
                'selectors' => [
                    '{{WRAPPER}} .exad-call-to-action-icon i' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'exad_cta_icon[value]!' => ''
                ]       
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'           => 'exad_call_to_action_icon_typography',
                'selector'       => '{{WRAPPER}} .exad-call-to-action-icon i',                
                'exclude'        => [ 'text_transform', 'font_family' ],
                'fields_options' => [
                    'font_size'    => [
                        'default'  => [
                            'unit' => 'px',
                            'size' => 40
                        ]
                    ]
                ],
                'condition' => [
                    'exad_cta_icon[value]!' => ''
                ]  
            ]
        );

        $this->add_control(
            'exad_call_to_action_icon_padding',
            [
                'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 10,
                    'left'   => 0,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-call-to-action-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'exad_cta_icon[value]!' => ''
                ]            
            ]
        );        

		$this->end_controls_section();

        // primary button
        $this->start_controls_section(
            'exad_section_cta_primary_btn_style_settings',
            [
                'label' => esc_html__( 'Primary Button', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_cta_primary_btn_typography',
                'selector' => '{{WRAPPER}} a.exad-call-to-action-primary-btn'
            ]
        );

        $this->add_responsive_control(
            'exad_cta_primary_btn_padding',
            [
                'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,            
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top'    => 15,
                    'right'  => 50,
                    'bottom' => 15,
                    'left'   => 50,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} a.exad-call-to-action-primary-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_cta_primary_btn_margin',
            [
                'label'      => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,            
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} a.exad-call-to-action-primary-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'exad_cta_primary_btn_border',
                'label'          => esc_html__( 'Border', 'exclusive-addons-elementor' ),
                'fields_options' => [
                    'border'        => [
                        'default'   => 'solid'
                    ],
                    'width'       => [
                        'default' => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                    'color' => [
                        'default' => '#fb4b15'
                    ]
                ],
                'selector'  => '{{WRAPPER}} a.exad-call-to-action-primary-btn'
            ]
        );

        $this->add_control(
            'exad_cta_primary_btn_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} a.exad-call-to-action-primary-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'exad_cta_primary_btn_tabs' );

            // Normal State Tab
            $this->start_controls_tab( 'exad_cta_primary_btn_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_cta_primary_btn_normal_text_color',
                [
                    'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} a.exad-call-to-action-primary-btn' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_cta_primary_btn_normal_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#fb4b15',
                    'selectors' => [
                        '{{WRAPPER}} a.exad-call-to-action-primary-btn' => 'background: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'           => 'exad_cta_primary_btn_normal_box_shadow',
                    'selector'       => '{{WRAPPER}} a.exad-call-to-action-primary-btn'
                ]
            );
            
            $this->end_controls_tab();

            // Hover State Tab
            $this->start_controls_tab( 'exad_cta_primary_btn_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_cta_primary_btn_hover_text_color',
                [
                    'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} a.exad-call-to-action-primary-btn:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_cta_primary_btn_hover_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#fb4b15',
                    'selectors' => [
                        '{{WRAPPER}} a.exad-call-to-action-primary-btn:hover' => 'background: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'           => 'exad_cta_primary_btn_hover_box_shadow',
                    'selector'       => '{{WRAPPER}} a.exad-call-to-action-primary-btn:hover',
                    'fields_options' => [
                        'box_shadow_type' => [
                            'default'     =>'yes'
                        ],
                        'box_shadow'  => [
                            'default' => [
                                'horizontal' => 0,
                                'vertical'   => 13,
                                'blur'       => 33,
                                'spread'     => 0,
                                'color'      => 'rgba(51, 77, 128, 0.12)'
                            ]
                        ]
                    ]
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // secondary button
        $this->start_controls_section(
            'exad_section_cta_secondary_btn_style_settings',
            [
                'label'     => esc_html__( 'Secondary Button', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    '.exad_cta_skin_type' => 'vertical'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_cta_secondary_btn_typography',
                'selector' => '{{WRAPPER}} a.exad-call-to-action-secondary-btn'
            ]
        );

        $this->add_responsive_control(
            'exad_cta_secondary_btn_padding',
            [
                'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,            
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top'    => 15,
                    'right'  => 50,
                    'bottom' => 15,
                    'left'   => 50,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} a.exad-call-to-action-secondary-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_cta_secondary_btn_margin',
            [
                'label'      => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,            
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} a.exad-call-to-action-secondary-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'exad_cta_secondary_btn_border',
                'label'          => esc_html__( 'Border', 'exclusive-addons-elementor' ),
                'fields_options' => [
                    'border'        => [
                        'default'   => 'solid'
                    ],
                    'width'       => [
                        'default' => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                    'color' => [
                        'default' => '#7a56ff'
                    ]
                ],
                'selector'  => '{{WRAPPER}} a.exad-call-to-action-secondary-btn'
            ]
        );

        $this->add_control(
            'exad_cta_secondary_btn_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} a.exad-call-to-action-secondary-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'exad_cta_secondary_btn_tabs' );

            // Normal State Tab
            $this->start_controls_tab( 'exad_cta_secondary_btn_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_cta_secondary_btn_normal_text_color',
                [
                    'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#7a56ff',
                    'selectors' => [
                        '{{WRAPPER}} a.exad-call-to-action-secondary-btn' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_cta_secondary_btn_normal_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => 'rgba(0, 0, 0, 0)',
                    'selectors' => [
                        '{{WRAPPER}} a.exad-call-to-action-secondary-btn' => 'background: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'           => 'exad_cta_secondary_btn_normal_box_shadow',
                    'selector'       => '{{WRAPPER}} a.exad-call-to-action-secondary-btn'
                ]
            );

            $this->end_controls_tab();

            // Hover State Tab
            $this->start_controls_tab( 'exad_cta_secondary_btn_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_cta_secondary_btn_hover_text_color',
                [
                    'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} a.exad-call-to-action-secondary-btn:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_cta_secondary_btn_hover_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#7a56ff',
                    'selectors' => [
                        '{{WRAPPER}} a.exad-call-to-action-secondary-btn:hover' => 'background: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'           => 'exad_cta_secondary_btn_hover_box_shadow',
                    'selector'       => '{{WRAPPER}} a.exad-call-to-action-secondary-btn:hover',
                    'fields_options' => [
                        'box_shadow_type' => [
                            'default'     =>'yes'
                        ],
                        'box_shadow'  => [
                            'default' => [
                                'horizontal' => 0,
                                'vertical'   => 13,
                                'blur'       => 33,
                                'spread'     => 0,
                                'color'      => 'rgba(51, 77, 128, 0.12)'
                            ]
                        ]
                    ]
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();  
	}

   	

	protected function render() {

        $settings = $this->get_settings_for_display();
        $icon     = $settings['exad_cta_icon'];
        $heading  = $settings['exad_cta_heading'];
        $details  = $settings['exad_cta_description'];

        $this->add_inline_editing_attributes( 'exad_cta_heading', 'none' );
        $this->add_inline_editing_attributes( 'exad_cta_description', 'none' );

        $this->add_render_attribute( 'exad_cta_heading', 'class', 'exad-call-to-action-title' );
        $this->add_render_attribute( 'exad_cta_description', 'class', 'exad-call-to-action-subtitle' );
        $this->add_render_attribute( 'exad-call-to-action-wrapper', 'class', 'exad-call-to-action skin-'.$settings['exad_cta_skin_type'] );
        if ( 'yes' == $settings['exad_cta_fixed_width_enable'] ) {
            $this->add_render_attribute( 'exad-call-to-action-wrapper', 'class', 'fixed-width-'.$settings['exad_cta_vertical_alignment'] );
        }

        echo '<div '.$this->get_render_attribute_string( 'exad-call-to-action-wrapper' ).'>';
            do_action('exad_cta_wrapper_before');
		    echo '<div class="exad-call-to-action-content">';
			    echo '<div class="exad-call-to-action-header">';
                    if( !empty($settings['exad_cta_icon']['value'] ) ){
                        echo '<div class="exad-call-to-action-icon">';
                            Icons_Manager::render_icon( $settings['exad_cta_icon'], [ 'aria-hidden' => 'true' ] );
                        echo '</div>';
                    }
                    $heading ? printf('<h1 '.$this->get_render_attribute_string( 'exad_cta_heading' ).'>%s</h1>', wp_kses_post($heading)) : '';
			    	$details ? printf('<p '.$this->get_render_attribute_string( 'exad_cta_description' ).'>%s</p>', wp_kses_post($details)) : '';
			    echo '</div>';

			    echo '<div class="exad-call-to-action-footer">';
                    echo '<ul class="exad-call-to-action-buttons">';
                        if ( ! empty( $settings['exad_cta_primary_btn'] ) ) :
                            if (  'on' === $settings['exad_cta_primary_btn_link']['is_external'] ) {
                                $target = 'target = _blank';
                            } else {
                                $target = '';
                            }
                            if ( 'on' === $settings['exad_cta_primary_btn_link']['nofollow'] ) {
                                $target .= ' rel = nofollow ';
                            }
                            echo '<li>';
                                echo '<a class="exad-call-to-action-primary-btn" href="'.esc_url($settings['exad_cta_primary_btn_link']['url']).'" '.esc_attr($target).'>';
                                    echo esc_html($settings['exad_cta_primary_btn']);
                                echo '</a>';
                            echo '</li>';
                        endif;
                        if('vertical' == $settings['exad_cta_skin_type']) :
                            if ( 'on' === $settings['exad_cta_secondary_btn_link']['is_external'] ) {
                                $target = 'target= _blank';
                            } else {
                                $target = '';
                            }
                            if ( 'on' === $settings['exad_cta_secondary_btn_link']['nofollow'] ) {
                                $target .= ' rel= nofollow ';
                            } 
                            if ( ! empty( $settings['exad_cta_secondary_btn'] ) ) :
                                echo '<li>';
                                    echo '<a class="exad-call-to-action-secondary-btn" href="'.esc_url($settings['exad_cta_secondary_btn_link']['url']).'" '.esc_attr($target).'>';
                                        echo esc_html($settings['exad_cta_secondary_btn']);
                                    echo '</a>';
                                echo '</li>';
                            endif;
                        endif;
                    echo '</ul>';
			    echo '</div>';
		    echo '</div>';
            do_action('exad_cta_wrapper_after');
		echo '</div>';

	}

}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_CTA() );