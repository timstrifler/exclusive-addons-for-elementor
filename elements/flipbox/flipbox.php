<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Flip_Box extends Widget_Base {

	public function get_name() {
		return 'exad-flipbox';
	}

	public function get_title() {
		return esc_html__( 'Flip Box', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-flip-box';
	}

   	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
        return [ 'flipbox' ];
    }

	protected function _register_controls() {

  		$this->start_controls_section(
			'exad_section_side_a_content',
			[
				'label' => __( 'Front', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_flipbox_front_icon',
			[
				'label'   => __( 'Icon', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-heart',
					'library' => 'solid'
				]
			]
		);

		$this->add_control(
			'exad_flipbox_front_title',
			[
				'label'       => __( 'Title', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Heading Front', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Your Title', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_flipbox_front_description',
			[
				'label'       => __( 'Description', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor. Add some more test in here.', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Your Description', 'exclusive-addons-elementor' ),
				'title'       => __( 'Input image text here', 'exclusive-addons-elementor' )
			]
		);
	
		$this->end_controls_section();

		$this->start_controls_section(
			'exad_section_back_content',
			[
				'label' => __( 'Back', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_flipbox_back_icon',
			[
				'label'     => __( 'Icon', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'exad_flipbox_back_title',
			[
				'label'       => __( 'Title', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Heading Back', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Your Title', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_flipbox_back_description',
			[
				'label'       => __( 'Description', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Your Description', 'exclusive-addons-elementor' ),
				'title'       => __( 'Input image text here', 'exclusive-addons-elementor' ),
				'separator'   => 'none'
			]
		);

		$this->add_control(
			'exad_flipbox_button_text',
			[
				'label'     => __( 'Button Text', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => [ 'active' => true ],
				'default'   => __( 'Read More', 'exclusive-addons-elementor' ),
				'separator' => 'before'
			]
		);

		$this->add_control(
			'exad_flipbox_button_link',
			[
				'label'       => __( 'Link', 'exclusive-addons-elementor' ),
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
			'exad_section_flipbox_settings',
			[
				'label' => __( 'Flip Settings', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_flipbox_style',
			[
				'label'   => __( 'Flip Direction', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left-to-right',
				'options' => [
					'left-to-right'       => __( 'Left to Right', 'exclusive-addons-elementor' ),
					'right-to-left'       => __( 'Right to Left', 'exclusive-addons-elementor' ),
					'top-to-bottom'       => __( 'Top to Bottom', 'exclusive-addons-elementor' ),
					'bottom-to-top'       => __( 'Bottom to Top', 'exclusive-addons-elementor' ),
					'top-to-bottom-angle' => __( 'Diagonal (Top to Bottom)', 'exclusive-addons-elementor' ),
					'bottom-to-top-angle' => __( 'Diagonal (Bottom to Top)', 'exclusive-addons-elementor' ),
					'fade-in-out'         => __( 'Fade In Out', 'exclusive-addons-elementor' ),
					'three-d-flip'        => __( '3D Rotation', 'exclusive-addons-elementor' )
				]
				
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'exad_section_flipbox_container',
			[
				'label' => __( 'Container', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_flipbox_3d_height',
			[
				'label'      => __( 'Height', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px'      => [
						'min' => 0,
						'max' => 1000
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 300
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-inner .exad-flip-box-front,
					{{WRAPPER}} .exad-flip-box .exad-flip-box-inner .exad-flip-box-back' => 'min-height: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flipbox Front)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_front_end_style_section',
			[
				'label' => __( 'Front', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_flipbox_front_container',
			[
				'label'     => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'front_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-inner .exad-flip-box-front'
			]
		);

		$this->add_responsive_control(
			'exad_flipbox_front_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'exad_flipbox_front_container_border',
				'label'          => __( 'Border', 'exclusive-addons-elementor' ),
				'selector'       => '{{WRAPPER}} .exad-flip-box .exad-flip-box-front',
			  	'fields_options' => [
                    'border'         => [
                        'default'    => 'solid'
                    ],
                    'width'          => [
                        'default'    => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                 	'color' => [
                        'default' => '#7a56ff'
                    ]
                ]
			]
		);

		$this->add_responsive_control(
			'exad_flipbox_front_border_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_flipbox_front_box_shadow',
				'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-front'
			]
		);

		$this->add_responsive_control(
            'exad_flipbox_front_content_alignment',
            [
                'label'          => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
                'type'           => Controls_Manager::CHOOSE,
                'toggle'         => false,
                'options'        => [
                    'left'       => [
                        'title'  => __( 'Left', 'exclusive-addons-elementor' ),
                        'icon'   => 'eicon-h-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'exclusive-addons-elementor' ),
                        'icon'   => 'eicon-h-align-center'
                    ],
                    'right'      => [
                        'title'  => __( 'Right', 'exclusive-addons-elementor' ),
                        'icon'   => 'eicon-h-align-right'
                    ]
                ],
                // 'selectors'      => [
                //     '{{WRAPPER}} .exad-flip-box .exad-flip-box-front' => 'text-align: {{VALUE}};'
                // ],
                'default'        => 'center'
            ]
        ); 

		$this->add_control(
			'exad_flipbox_front_icon_style',
			[
				'label'     => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
                    'exad_flipbox_front_icon[value]!' => ''
                ]
			]
		);

		$this->add_control(
			'exad_flipbox_front_icon_box_height_width',
			[
				'label'       => __( 'Icon Box Size', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 200
					]
				],
				'default'     => [
                    'unit'    => 'px',
                    'size'    => 90
                ],
				'selectors'   => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-image' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_flipbox_front_icon_typography',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-image i',
			 	'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 50
		                ]
		            ]
	            ],
				'exclude'   => [ 'text_transform', 'font_family' ],
				'condition' => [
                    'exad_flipbox_front_icon[value]!' => ''
                ]
			]
		);

		$this->add_control(
			'exad_flipbox_front_icon_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#7a56ff',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-image i' => 'color: {{VALUE}};'
				],
				'condition' => [
                    'exad_flipbox_front_icon[value]!' => ''
                ]				
			]
		);

		$this->add_control(
			'exad_flipbox_front_icon_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-image' => 'background-color: {{VALUE}};'
				],
				'condition' => [
                    'exad_flipbox_front_icon[value]!' => ''
                ]				
			]
		);

		$this->add_control(
			'exad_flipbox_front_icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-inner .exad-flip-box-front .exad-flip-box-front-image i'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
                    'exad_flipbox_front_icon[value]!' => ''
                ]
			]
		);

		$this->add_control(
			'exad_flipbox_front_title_heading',
			[
				'label'     => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'exad_flipbox_front_title_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-title' => 'color: {{VALUE}};'
				]
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_flipbox_front_title_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ]
	            ],
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-title'
			]
		);

		$this->add_responsive_control(
            'exad_flipbox_front_title_margin',
            [
				'label'      => __('Margin', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
                    'top'      => '20',
                    'right'    => '0',
                    'bottom'   => '10',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
                    '{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_control(
			'exad_flipbox_content_heading',
			[
				'label'     => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'exad_flipbox_front_content_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#817e7e',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-description' => 'color: {{VALUE}};'
				]
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_flipbox_front_content_typography',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-description'				
			]
		);

		$this->add_responsive_control(
            'exad_flipbox_front_content_margin',
            [
				'label'      => __('Margin', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
                    '{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flipbox Back)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_back_end_style_section',
			[
				'label' => __( 'Back', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_flipbox_back_container_heading',
			[
				'label'     => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'exad_flipbox_back_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-inner .exad-flip-box-back',
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#7a56ff'
					]
				]
			]
		);

		$this->add_responsive_control(
			'exad_flipbox_back_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
                    'top'      => '30',
                    'right'    => '20',
                    'bottom'   => '30',
                    'left'     => '20',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'exad_flipbox_back_container_border',
				'label'    => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back'
			]
		);

		$this->add_responsive_control(
			'exad_flipbox_back_border_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_flipbox_back_box_shadow',
				'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back'
			]
		);

		$this->add_responsive_control(
            'exad_flipbox_back_content_alignment',
            [
                'label'          => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
                'type'           => Controls_Manager::CHOOSE,
                'toggle'         => false,
                'options'        => [
                    'left'       => [
                        'title'  => __( 'Left', 'exclusive-addons-elementor' ),
                        'icon'   => 'eicon-h-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'exclusive-addons-elementor' ),
                        'icon'   => 'eicon-h-align-center'
                    ],
                    'right'      => [
                        'title'  => __( 'Right', 'exclusive-addons-elementor' ),
                        'icon'   => 'eicon-h-align-right'
                    ]
                ],
                // 'selectors'      => [
                //     '{{WRAPPER}} .exad-flip-box .exad-flip-box-back' => 'text-align: {{VALUE}};'
                // ],
                'default'        => 'center'
            ]
        ); 

		$this->add_control(
			'exad_flipbox_back_icon_style',
			[
				'label'     => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
                    'exad_flipbox_back_icon[value]!' => ''
                ] 
			]
		);

		$this->add_control(
			'exad_flipbox_back_icon_box_height_width',
			[
				'label'       => __( 'Icon Box Size', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 200
					]
				],
				'default'     => [
                    'unit'    => 'px',
                    'size'    => 90
                ],
				'selectors'   => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-image' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'exad_flipbox_back_icon_typography',
				'selector'  => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back i',
				'exclude'   => [ 'text_transform', 'font_family' ],
				'condition' => [
                    'exad_flipbox_back_icon[value]!' => ''
                ]
			]
		);

		$this->add_control(
			'exad_flipbox_back_icon_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back i' => 'color: {{VALUE}};'
				],
				'condition' => [
                    'exad_flipbox_back_icon[value]!' => ''
                ]				
			]
		);

		$this->add_control(
			'exad_flipbox_back_icon_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-image' => 'background-color: {{VALUE}};'
				],
				'condition' => [
                    'exad_flipbox_back_icon[value]!' => ''
                ]
				
			]
		);

		$this->add_control(
			'exad_flipbox_back_icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back i'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
                    'exad_flipbox_back_icon[value]!' => ''
                ]
			]
		);

		$this->add_control(
			'exad_flipbox_back_title_heading',
			[
				'label'     => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);		

		$this->add_control(
			'exad_flipbox_back_title_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-title' => 'color: {{VALUE}};'
				]
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_flipbox_back_title_typography',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-title'
			]
		);

		$this->add_responsive_control(
            'exad_flipbox_back_title_margin',
            [
				'label'      => __('Margin', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
                    'top'      => '6',
                    'right'    => '0',
                    'bottom'   => '20',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
                    '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_control(
			'exad_flipbox_back_details_heading',
			[
				'label'     => esc_html__( 'Details', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'exad_flipbox_back_details_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-description' => 'color: {{VALUE}};'
				]				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_flipbox_back_details_typography',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-description'
				
			]
		);

		$this->add_responsive_control(
            'exad_flipbox_back_details_margin',
            [
				'label'      => __('Margin', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
                    'top'      => '6',
                    'right'    => '0',
                    'bottom'   => '20',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
                    '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_control(
			'exad_flipbox_back_button',
			[
				'label'     => esc_html__( 'Button', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_flipbox_button_typography',
				'label'    => __( 'Typography', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action',
			 	'fields_options'  => [
		            'font_weight' => [
		                'default' => '400'
		            ]
	            ]
			]
		);

		$this->add_control(
			'exad_flipbox_button_padding',
			[
                'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'      => '6',
                    'right'    => '20',
                    'bottom'   => '6',
                    'left'     => '20',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

		$this->add_control(
			'exad_flipbox_button_margin',
			[
                'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
          'exad_flipbox_button_border_radious',
            [
                'label'      => esc_html__( 'Border Radious', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top'    => '4',
                    'right'  => '4',
                    'bottom' => '4',
                    'left'   => '4'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'exad_flipbox_button_box_shadow',
                'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
                'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action'
            ]
        );

		$this->start_controls_tabs( 'exad_cta_button_tabs' );

			// Normal State Tab
			$this->start_controls_tab( 'exad_flipbox_btn_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_flipbox_btn_normal_text_color',
					[
						'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'exad_flipbox_btn_normal_bg_color',
					[
						'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'            => 'exad_flipbox_btn_normal_border',
                        'label'           => __( 'Border', 'exclusive-addons-elementor' ),
                        'fields_options'  => [
		                    'border'      => [
		                        'default' => 'solid'
		                    ],
		                    'width'          => [
		                        'default'    => [
		                            'top'    => '1',
		                            'right'  => '1',
		                            'bottom' => '1',
		                            'left'   => '1'
		                        ]
		                    ],
		                    'color'       => [
		                        'default' => '#ffffff'
		                    ]
		                ],
                        'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action'
                    ]
                );
			
			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'exad_flipbox_btn_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_flipbox_btn_hover_text_color',
					[
						'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#000000',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'exad_flipbox_btn_hover_bg_color',
					[
						'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action:hover' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'exad_flipbox_btn_hover_border',
                        'label'    => __( 'Border', 'exclusive-addons-elementor' ),
                        'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action:hover'
                    ]
                );

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {

		$settings    = $this->get_settings_for_display();
		$front_title = $settings['exad_flipbox_front_title'];
		$front_desc  = $settings['exad_flipbox_front_description'];
		$back_title  = $settings['exad_flipbox_back_title'];
		$back_desc   = $settings['exad_flipbox_back_description'];
	   
	    $this->add_render_attribute(
		   'exad_flipbox_attribute', 
		    [
			   'class' => [ 
			   		'exad-flip-box-inner',
			   		$settings['exad_flipbox_style'] 
			   	]
		    ]   
	    );
	    $this->add_render_attribute( 'exad-flipbox-anchor-params', 'class', 'exad-flip-box-back-action' );

		if( $settings['exad_flipbox_button_link']['url'] ) {
            $this->add_render_attribute( 'exad-flipbox-anchor-params', 'href', esc_url( $settings['exad_flipbox_button_link']['url'] ) );
        }
        if( $settings['exad_flipbox_button_link']['is_external'] ) {
            $this->add_render_attribute( 'exad-flipbox-anchor-params', 'target', '_blank' );
        }
        if( $settings['exad_flipbox_button_link']['nofollow'] ) {
            $this->add_render_attribute( 'exad-flipbox-anchor-params', 'rel', 'nofollow' );
        }

		echo '<div class="exad-flip-box">';
	      	echo '<div '.$this->get_render_attribute_string( 'exad_flipbox_attribute' ).'>';
	        	echo '<div class="exad-flip-box-front '.esc_attr( $settings['exad_flipbox_front_content_alignment'] ).'">';
	        		echo '<div class="exad-flip-box-front-content">';
	        			do_action('exad_flipbox_frontend_content_wrapper_before');

		        		if ( !empty( $settings['exad_flipbox_front_icon']['value'] ) ) {
			          		echo '<div class="exad-flip-box-front-image">';
		          				Icons_Manager::render_icon( $settings['exad_flipbox_front_icon'] );
			        		echo '</div>';
			        	}
				        $front_title ? printf('<h2 class="exad-flip-box-front-title">%s</h2>', esc_html( $front_title ) ) : '';
				        $front_desc ? printf('<p class="exad-flip-box-front-description">%s</p>', wp_kses_post( $front_desc ) ) : '';

				        do_action('exad_flipbox_frontend_content_wrapper_after');
	        		echo '</div>';
	        	echo '</div>';

		        echo '<div class="exad-flip-box-back '.esc_attr( $settings['exad_flipbox_back_content_alignment'] ).'">';
		        	echo '<div class="exad-flip-box-back-content">';
			        	do_action('exad_flipbox_backend_content_wrapper_before');

			        	if ( !empty( $settings['exad_flipbox_back_icon']['value'] ) ) {
			        		echo '<div class="exad-flip-box-back-image">';
		          				Icons_Manager::render_icon( $settings['exad_flipbox_back_icon'] );
		          			echo '</div>';
			        	}
				        $back_title ? printf('<h2 class="exad-flip-box-back-title">%s</h2>', esc_html( $back_title) ) : '';
				        $back_desc ? printf('<div class="exad-flip-box-back-description">%s</div>', wp_kses_post( $back_desc ) ) : '';

				        do_action('exad_flipbox_backend_content_wrapper_after');

				        echo '<a '.$this->get_render_attribute_string( 'exad-flipbox-anchor-params' ).'>';
				        	echo esc_html( $settings['exad_flipbox_button_text'] );
			        	echo '</a>';
			        echo '</div>';
		        echo '</div>';
	      	echo '</div>';
	    echo '</div>';
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Flip_Box() );