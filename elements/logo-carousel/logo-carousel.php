<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Control_Media;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Logo_Carousel extends Widget_Base {
	
	public function get_name() {
		return 'exad-logo-carousel';
	}

	public function get_title() {
		return esc_html__( 'Logo Carousel', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad exad-logo exad-logo-carousel';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_script_depends() {
		return [ 'exad-slick' ];
	}

	public function get_keywords() {
        return [ 'exclusive', 'image', 'slider', 'thumbnail', 'brand' ];
    }
	
	protected function register_controls() {
		$exad_primary_color   = get_option( 'exad_primary_color_option', '#7a56ff' );
		
	    /*
	    * Logo carousel Image
	    */
	    $this->start_controls_section(
			'exad_logo_carousel_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
			]
		);

        $logo_repeater = new Repeater();

		$logo_repeater->add_control(
			'exad_logo_carousel_image',
			[
				'label'   => __( 'Logo', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				]
			]
        );
        
		$logo_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'logo_image_size',
				'default'   => 'full',
				'condition' => [
					'exad_logo_carousel_image[url]!' => ''
				]
			]
		);
        
        $this->add_control(
			'exad_logo_carousel_repeater',
			[
				'label'   => esc_html__( 'Logo Carousel', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $logo_repeater->get_controls(),
				'default' => [
					[ 'exad_logo_carousel_image' => Utils::get_placeholder_image_src() ],
					[ 'exad_logo_carousel_image' => Utils::get_placeholder_image_src() ],
					[ 'exad_logo_carousel_image' => Utils::get_placeholder_image_src() ],
					[ 'exad_logo_carousel_image' => Utils::get_placeholder_image_src() ]
				]	
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'exad_logo_carousel_settings',
			[
				'label' => esc_html__( 'Carousel Settings', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_logo_slide_to_show',
			[
				'label'   => esc_html__( 'Columns', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '3'
			]
		);

		$this->add_control(
			'exad_logo_slide_to_scroll',
			[
				'label'   => esc_html__( 'Slide to Scroll', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '1'
			]
		);

		$this->add_control(
			'exad_logo_carousel_nav',
			[
				'label'     => esc_html__( 'Navigation', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'arrows',
				'separator' => 'before',
				'options' => [
                    'arrows' => esc_html__( 'Arrows', 'exclusive-addons-elementor' ),
                    'dots'   => esc_html__( 'Dots', 'exclusive-addons-elementor' ),
                    'both'   => esc_html__( 'Arrows and Dots', 'exclusive-addons-elementor' ),
                    'none'   => esc_html__( 'None', 'exclusive-addons-elementor' )
                    
                ]
			]
		);

		$this->add_control(
			'exad_logo_autoplay',
			[
				'label'     => esc_html__( 'Autoplay', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'default'   => 'no'
			]
		);

		$this->add_control(
			'exad_logo_autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'exad_logo_autoplay' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_logo_loop',
			[
				'label'   => esc_html__( 'Infinite Loop', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);

		$this->end_controls_section();

		/*
		* Logo Carousel Styling Section
		*/

		$this->start_controls_section(
			'exad_logo_carousel_style_background',
			[
				'label' => esc_html__( 'General Style', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
            'exad_logo_carousel_max_height_enable',
            [
                'label'        => __( 'Minimum Height', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $this->add_responsive_control(
			'exad_logo_carousel_max_height',
			[
				'label' => __( 'Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 150,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-logo-carousel-element.exad-logo-carousel-max-height-yes .exad-logo-carousel-item' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'exad_logo_carousel_max_height_enable' => 'yes'
                ]
			]
		);

		$this->add_control(
			'exad_logo_carousel_alignment',
			[
				'label'       => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => true,
				'options'     => [
					'exad-logo-carousel-left'   => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-left'
					],
					'exad-logo-carousel-center' => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-center'
					],
					'exad-logo-carousel-right'  => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default'     => 'exad-logo-carousel-center'
			]
		);

		$this->add_responsive_control(
			'exad_logo_carousel_item_radius',
			[
				'label'      => esc_html__( 'Item Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_logo_carousel_item_margin',
			[
				'label'      => esc_html__( 'Item margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default'    => [
					'top'    => '0',
					'right'  => '10',
					'bottom' => '20',
					'left'   => '10'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_logo_carousel_item_padding',
			[
				'label'      => esc_html__( 'Item Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'exad_logo_carousel_background_tabs' );

			$this->start_controls_tab( 'exad_logo_carousel_background_control', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_logo_carousel_background',
					[
						'label'     => esc_html__( 'Background', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-item' => 'background: {{VALUE}};'
						]
					]
				);
				$this->add_control(
					'exad_logo_carousel_opacity_normal',
					[
						'label'     => __('Opacity', 'exclusive-addons-elementor'),
						'type'      => Controls_Manager::NUMBER,
						'range'     => [
							'min'   => 0,
							'max'   => 1
						],
						'selectors' => [
							'{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item img' => 'opacity: {{VALUE}};'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'exad_logo_carousel_border_normal',
						'selector' => '{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'exad_logo_carousel_shadow_normal',
						'selector' => '{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item'
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab( 'exad_logo_carousel_background_hover_control', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_logo_carousel_background_hover',
					[
						'label'     => esc_html__( 'Background Hover', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-item:hover' => 'background: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'exad_logo_carousel_opacity_hover',
					[
						'label'     => __('Opacity', 'exclusive-addons-elementor'),
						'type'      => Controls_Manager::NUMBER,
						'range'     => [
							'min'   => 0,
							'max'   => 1
						],
						'selectors' => [
							'{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item:hover img' => 'opacity: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'exad_logo_carousel_border_hover',
						'selector' => '{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item:hover'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'exad_logo_carousel_shadow_hover',
						'selector' => '{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item:hover'
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();
		
		$this->end_controls_section();

		$this->start_controls_section(
            'exad_logo_carousel_arrow_controls_style_section',
            [
                'label'     => __('Arrow Controls', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_logo_carousel_nav' => ['arrows', 'both']
                ]               
            ]
        );

        $this->add_control(
            'exad_logo_carousel_arrows_style',
            [
				'label' => esc_html__( 'Arrows', 'exclusive-addons-elementor' ),
				'type'  => Controls_Manager::HEADING
            ]
        );

        $this->add_responsive_control(
            'exad_logo_carousel_arrows_size',
            [
                'label'         => __( 'Size', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 20
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 70,
                        'step'  => 1
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev i, {{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next i' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_logo_carousel_arrow_width',
            [
                'label'         => __( 'Width', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 60
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 200,
                        'step'  => 1
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next, {{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_logo_carousel_arrow_height',
            [
                'label'         => __( 'Height', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 60
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 200,
                        'step'  => 1
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next, {{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
                ]
            ]
		);
		
		$this->add_control(
			'exad_logo_carousel_prev_arrow_position',
			[
				'label' => __( 'Previous Arrow Position', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', 'exclusive-addons-elementor' ),
				'label_on' => __( 'Custom', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        $this->start_popover();

            $this->add_responsive_control(
                'exad_logo_carousel_prev_arrow_position_x_offset',
                [
                    'label' => __( 'X Offset', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'exad_logo_carousel_prev_arrow_position_y_offset',
                [
                    'label' => __( 'Y Offset', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_popover();

        $this->add_control(
			'exad_logo_carousel_next_arrow_position',
			[
				'label' => __( 'Next Arrow Position', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', 'exclusive-addons-elementor' ),
				'label_on' => __( 'Custom', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        $this->start_popover();

            $this->add_responsive_control(
                'exad_logo_carousel_next_arrow_position_x_offset',
                [
                    'label' => __( 'X Offset', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'exad_logo_carousel_next_arrow_position_y_offset',
                [
                    'label' => __( 'Y Offset', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

		$this->end_popover();
		
		$this->add_control(
			'exad_logo_carousel_arrows_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ '%'],
				'selectors'  => [
					'{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next,{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'default'    => [
					'top'    => 50,
					'right'  => 50,
					'bottom' => 50,
					'left'   => 50
				] 
			]
		);

		$this->start_controls_tabs( 'exad_logo_carousel_arrows_style_tabs' );

        	// normal state tab
        	$this->start_controls_tab( 'exad_logo_carousel_arrow_normal_style', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

		        $this->add_control(
		            'exad_logo_carousel_arrows_color',
		            [
		                'label'         => __( 'Color', 'exclusive-addons-elementor' ),
		                'type'          => Controls_Manager::COLOR,
		                'default'       => '#000000',
		                'selectors'     => [
		                    '{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next i, {{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev i' => 'color: {{VALUE}}'
		                ]          
		            ]
		        );

		        $this->add_control(
		            'exad_logo_carousel_arrows_bg_color',
		            [
		                'label'         => __( 'Background Color', 'exclusive-addons-elementor' ),
		                'type'          => Controls_Manager::COLOR,
		                'default'       => '#dddddd',
		                'selectors'     => [
		                    '{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next, {{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev' => 'background-color: {{VALUE}}'
		                ]            
		            ]
		        );

		        $this->add_group_control(
		        	Group_Control_Border::get_type(),
		            [
		                'name'      => 'exad_logo_carousel_arrows_border',
		                'selector'  => '{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next, {{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev'
		            ]
		        );

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'exad_logo_carousel_arrows_shadow',
						'selector' => '{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev, {{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next'
					]
				);

			$this->end_controls_tab();


        	// hover state tab
        	$this->start_controls_tab( 'exad_logo_carousel_arrow_hover_style', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

		        $this->add_control(
		            'exad_logo_carousel_arrows_hover_color',
		            [
		                'label'         => __( 'Color', 'exclusive-addons-elementor' ),
		                'type'          => Controls_Manager::COLOR,
		                'default'       => '#ffffff',
		                'selectors'     => [
		                    '{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next:hover i, {{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev:hover i' => 'color: {{VALUE}}'
		                ]          
		            ]
		        );

		        $this->add_control(
		            'exad_logo_carousel_arrows_hover_bg_color',
		            [
		                'label'         => __( 'Background Color', 'exclusive-addons-elementor' ),
		                'type'          => Controls_Manager::COLOR,
		                'default'       => $exad_primary_color,
		                'selectors'     => [
		                    '{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next:hover, {{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev:hover' => 'background-color: {{VALUE}}'
		                ]          
		            ]
		        );

		        $this->add_group_control(
		        	Group_Control_Border::get_type(),
		            [
		                'name'      => 'exad_logo_carousel_arrows_hover_border',
		                'selector'  => '{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next:hover, {{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev:hover'
		            ]
		        );

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'exad_logo_carousel_arrows_hover_shadow',
						'selector' => '{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev:hover, {{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next:hover'
					]
				);

			$this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_logo_carousel_dot_bullet_controls_style_section',
            [
                'label'     => __('Dots', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_logo_carousel_nav' => ['dots', 'both']
                ]                
            ]
        );

        $this->add_responsive_control(
            'exad_logo_carousel_dot_bullet_margin',
            [
                'label'      => __('Margin', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
					'top'    => 0,
					'right'  => 10,
					'bottom' => 0,
					'left'   => 0
                ], 
                'selectors'  => [
                    '{{WRAPPER}} .exad-logo-carousel .slick-dots li button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'exad_logo_carousel_dot_bullet_style_tabs' );

        // normal state tab
        $this->start_controls_tab( 'exad_logo_carousel_dot_bullet_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

            $this->add_responsive_control(
                'exad_logo_carousel_dot_bullet_height',
                [
                    'label'  => __( 'Height', 'exclusive-addons-elementor' ),
                    'type'   => Controls_Manager::SLIDER,
                    'range'  => [
                        'px' => [
                            'min' => 1,
                            'max' => 100
                        ]
                    ],
                    'default'  => [
                        'size' => 10,
                        'unit' => 'px'
                    ],
                    'selectors'=> [
                        '{{WRAPPER}} .exad-logo-carousel .slick-dots li button' => 'height: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_responsive_control(
                'exad_logo_carousel_dot_bullet_width',
                [
                    'label'  => __( 'Width', 'exclusive-addons-elementor' ),
                    'type'   => Controls_Manager::SLIDER,
                    'range'  => [
                        'px' => [
                            'min' => 1,
                            'max' => 100
                        ]
                    ],
                    'default'  => [
                        'size' => 10,
                        'unit' => 'px'
                    ],
                    'selectors'=> [
                        '{{WRAPPER}} .exad-logo-carousel .slick-dots li button' => 'width: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_logo_carousel_dot_bullet_color',
                [
                    'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#dadada',
                    'selectors' => [
                        '{{WRAPPER}} .exad-logo-carousel .slick-dots li button' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'            => 'exad_logo_carousel_dot_bullet_border',
                    'selector'        => '{{WRAPPER}} .exad-logo-carousel .slick-dots li button',
                ]
            );

            $this->add_responsive_control(
                'exad_logo_carousel_dot_bullet_border_radius',
                [
                    'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'default'    => [
                        'top'    => 100,
                        'right'  => 100,
                        'bottom' => 100,
                        'left'   => 100,
                        'unit'   => '%'
                    ],                
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .exad-logo-carousel .slick-dots li button'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->end_controls_tab();

            // active state tab
            $this->start_controls_tab( 'exad_logo_carousel_dot_bullet_active', [ 'label' => esc_html__( 'Active', 'exclusive-addons-elementor' ) ] );

            $this->add_responsive_control(
                'exad_logo_carousel_dot_bullet_active_height',
                [
                    'label'  => __( 'Height', 'exclusive-addons-elementor' ),
                    'type'   => Controls_Manager::SLIDER,
                    'range'  => [
                        'px' => [
                            'min' => 1,
                            'max' => 100
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .exad-logo-carousel .slick-dots li.slick-active button' => 'height: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_responsive_control(
                'exad_logo_carousel_dot_bullet_active_width',
                [
                    'label'  => __( 'Width', 'exclusive-addons-elementor' ),
                    'type'   => Controls_Manager::SLIDER,
                    'range'  => [
                        'px' => [
                            'min' => 1,
                            'max' => 100
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .exad-logo-carousel .slick-dots li.slick-active button' => 'width: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_logo_carousel_dot_bullet_active_color',
                [
                    'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => $exad_primary_color,
                    'selectors' => [
                        '{{WRAPPER}} .exad-logo-carousel .slick-dots li.slick-active button' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
					'name'     => 'exad_logo_carousel_dot_bullet_active_border',
					'selector' => '{{WRAPPER}} .exad-logo-carousel .slick-dots li.slick-active button'
                ]
            );

            $this->add_responsive_control(
                'exad_logo_carousel_dot_bullet_active_border_radius',
                [
                    'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                    'type'       => Controls_Manager::DIMENSIONS,         
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .exad-logo-carousel .slick-dots li.slick-active button'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


	}
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$direction = is_rtl() ? 'true' : 'false';

		$this->add_render_attribute( 
			'exad_logo_carousel', 
			[ 
				'class'               => ['exad-logo-carousel-element', 'exad-logo-carousel-max-height-'.esc_attr($settings['exad_logo_carousel_max_height_enable'])],
				'data-carousel-nav'   => esc_attr( $settings['exad_logo_carousel_nav'] ),
				'data-slidestoshow'   => esc_attr( $settings['exad_logo_slide_to_show'] ),
				'data-slidestoscroll' => esc_attr( $settings['exad_logo_slide_to_scroll'] ),
				'data-direction'      => esc_attr( $direction )
			]
		);

		if ( 'yes' === $settings['exad_logo_loop'] ) {
			$this->add_render_attribute( 'exad_logo_carousel', 'data-loop', 'true' );
		}
		if ( 'yes' === $settings['exad_logo_autoplay'] ) {
			$this->add_render_attribute( 'exad_logo_carousel', 'data-autoplay', 'true' );
			$this->add_render_attribute( 'exad_logo_carousel', 'data-autoplayspeed', esc_attr( $settings['exad_logo_autoplay_speed'] ) );
		}

		if ( is_array( $settings['exad_logo_carousel_repeater'] ) ) : ?>
			<div class="exad-logo-carousel">
				<div <?php echo $this->get_render_attribute_string('exad_logo_carousel') ;?> >
					<?php foreach ( $settings['exad_logo_carousel_repeater'] as $logo ) :?>
						<div class="exad-logo-carousel-item <?php echo esc_attr( $settings['exad_logo_carousel_alignment'] );?>">
							<?php echo Group_Control_Image_Size::get_attachment_image_html( $logo, 'logo_image_size', 'exad_logo_carousel_image' ); ?>
						</div>					
					<?php endforeach; ?>
				</div>
			</div>
		<?php
		endif;
	}
}