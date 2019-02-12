<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Exclusive_Tabs extends Widget_Base {

	public function get_name() {
		return 'exad-exclusive-tabs';
	}

	public function get_title() {
		return esc_html__( 'DC Exclusive Tabs', 'exclusive-addons-elementor' );
	}

	public function get_script_depends() {
        return [
            'exad-scripts'
        ];
    }

	public function get_icon() {
		return 'eicon-tabs';
	}

   public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function _register_controls() {
		/**
  		 * Exclusive Tabs Settings
  		 */
  		$this->start_controls_section(
  			'exad_section_exclusive_tabs_settings',
  			[
  				'label' => esc_html__( 'General Settings', 'exclusive-addons-elementor' )
  			]
  		);
		$this->add_control(
		  'exad_adv_tab_layout',
		  	[
		   	'label'       	=> esc_html__( 'Layout', 'exclusive-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'exad-tabs-horizontal',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'exad-tabs-horizontal' => esc_html__( 'Horizontal', 'exclusive-addons-elementor' ),
		     		'exad-tabs-vertical' => esc_html__( 'Vertical', 'exclusive-addons-elementor' ),
		     	],
		  	]
		);
		$this->add_control(
			'exad_exclusive_tabs_icon_show',
			[
				'label' => esc_html__( 'Enable Icon', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'return_value' => 'yes',
			]
		);
		$this->add_control(
		  'exad_adv_tab_icon_position',
		  	[
		   	'label'       	=> esc_html__( 'Icon Position', 'exclusive-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'exad-tab-inline-icon',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'exad-tab-top-icon' => esc_html__( 'Stacked', 'exclusive-addons-elementor' ),
		     		'exad-tab-inline-icon' => esc_html__( 'Inline', 'exclusive-addons-elementor' ),
		     	],
		     	'condition' => [
		     		'exad_exclusive_tabs_icon_show' => 'yes'
		     	]
		  	]
		);
  		$this->end_controls_section();

  		/**
  		 * Exclusive Tabs Content Settings
  		 */
  		$this->start_controls_section(
  			'exad_section_exclusive_tabs_content_settings',
  			[
  				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
  			]
  		);
  		$this->add_control(
			'exad_exclusive_tabs_tab',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'exad_exclusive_tabs_tab_title' => esc_html__( 'Tab Title 1', 'exclusive-addons-elementor' ) ],
					[ 'exad_exclusive_tabs_tab_title' => esc_html__( 'Tab Title 2', 'exclusive-addons-elementor' ) ],
					[ 'exad_exclusive_tabs_tab_title' => esc_html__( 'Tab Title 3', 'exclusive-addons-elementor' ) ],
				],
				'fields' => [
					[
						'name' => 'exad_exclusive_tabs_tab_show_as_default',
						'label' => __( 'Set as Default', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'inactive',
						'return_value' => 'active',
				  	],
                    [
						'name'        => 'exad_exclusive_tabs_icon_type',
						'label'       => esc_html__( 'Icon Type', 'exclusive-addons-elementor' ),
                        'type'        => Controls_Manager::CHOOSE,
                        'label_block' => false,
                        'options'     => [
                            'none' => [
                                'title' => esc_html__( 'None', 'exclusive-addons-elementor' ),
                                'icon'  => 'fa fa-ban',
                            ],
                            'icon' => [
                                'title' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                                'icon'  => 'fa fa-gear',
                            ],
                            'image' => [
                                'title' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
                                'icon'  => 'fa fa-picture-o',
                            ],
                        ],
                        'default'       => 'icon',
					],
					[
						'name' => 'exad_exclusive_tabs_tab_title_icon',
						'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::ICON,
						'default' => 'fa fa-home',				
						'condition' => [
							'exad_exclusive_tabs_icon_type' => 'icon'
						]
					],
					[
						'name' => 'exad_exclusive_tabs_tab_title_image',
						'label' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'condition' => [
							'exad_exclusive_tabs_icon_type' => 'image'
						]
					],
					[
						'name' => 'exad_exclusive_tabs_tab_title',
						'label' => esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
						'dynamic' => [ 'active' => true ]
					],
					[
		                'name'					=> 'exad_exclusive_tabs_text_type',
		                'label'                 => __( 'Content Type', 'exclusive-addons-elementor' ),
		                'type'                  => Controls_Manager::SELECT,
		                'options'               => [
		                    'content'       => __( 'Content', 'exclusive-addons-elementor' ),
		                    'template'      => __( 'Saved Templates', 'exclusive-addons-elementor' ),
		                ],
		                'default'               => 'content',
		            ],
		            [
		                'name'					=> 'exad_primary_templates',
		                'label'                 => __( 'Choose Template', 'exclusive-addons-elementor' ),
		                'type'                  => Controls_Manager::SELECT,
		                'options'               => exad_get_page_templates(),
						'condition'             => [
							'exad_exclusive_tabs_text_type'      => 'template',
						],
		            ],
				  	[
						'name' => 'exad_exclusive_tabs_tab_content',
						'label' => esc_html__( 'Tab Content', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::WYSIWYG,
						'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'exclusive-addons-elementor' ),
						'dynamic' => [ 'active' => true ],
						'condition'             => [
							'exad_exclusive_tabs_text_type'      => 'content',
						],
					],
				],
				'title_field' => '{{exad_exclusive_tabs_tab_title}}',
			]
		);
  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Tabs Generel Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_tabs_style_settings',
			[
				'label' => esc_html__( 'General', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_tabs_padding',
			[
				'label' => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .exad-advance-tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_tabs_margin',
			[
				'label' => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .exad-advance-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_exclusive_tabs_border',
				'label' => esc_html__( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-advance-tabs',
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_tabs_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .exad-advance-tabs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_exclusive_tabs_box_shadow',
				'selector' => '{{WRAPPER}} .exad-advance-tabs',
			]
		);
  		$this->end_controls_section();
  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Tabs Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_tabs_tab_style_settings',
			[
				'label' => esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'exad_exclusive_tabs_tab_title_typography',
				'selector' => '{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li',
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_tabs_title_width',
			[
				'label' => __( 'Title Min Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tabs.exad-tabs-vertical .exad-tabs-nav > ul' => 'min-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_adv_tab_layout' => 'exad-tabs-vertical'
				]
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_tabs_tab_icon_size',
			[
				'label' => __( 'Icon Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 16,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li img' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_tabs_tab_icon_gap',
			[
				'label' => __( 'Icon Gap', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .exad-tab-inline-icon li i, {{WRAPPER}} .exad-tab-inline-icon li img' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-tab-top-icon li i, {{WRAPPER}} .exad-tab-top-icon li img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_tabs_tab_padding',
			[
				'label' => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_tabs_tab_margin',
			[
				'label' => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->start_controls_tabs( 'exad_exclusive_tabs_header_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'exad_exclusive_tabs_header_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );
				$this->add_control(
					'exad_exclusive_tabs_tab_color',
					[
						'label' => esc_html__( 'Tab Background Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#f1f1f1',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_exclusive_tabs_tab_text_color',
					[
						'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#333',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_exclusive_tabs_tab_icon_color',
					[
						'label' => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#333',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li i' => 'color: {{VALUE}};',
						],
						'condition' => [
							'exad_exclusive_tabs_icon_show' => 'yes'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'exad_exclusive_tabs_tab_border',
						'label' => esc_html__( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li',
					]
				);
				$this->add_responsive_control(
					'exad_exclusive_tabs_tab_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
			 					'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			 			],
					]
				);
			$this->end_controls_tab();
			// Hover State Tab
			$this->start_controls_tab( 'exad_exclusive_tabs_header_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );
				$this->add_control(
					'exad_exclusive_tabs_tab_color_hover',
					[
						'label' => esc_html__( 'Tab Background Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#f1f1f1',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li:hover' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_exclusive_tabs_tab_text_color_hover',
					[
						'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#333',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li:hover' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_exclusive_tabs_tab_icon_color_hover',
					[
						'label' => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#333',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li:hover .fa' => 'color: {{VALUE}};',
						],
						'condition' => [
							'exad_exclusive_tabs_icon_show' => 'yes'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'exad_exclusive_tabs_tab_border_hover',
						'label' => esc_html__( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li:hover',
					]
				);
				$this->add_responsive_control(
					'exad_exclusive_tabs_tab_border_radius_hover',
					[
						'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
			 					'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			 			],
					]
				);
			$this->end_controls_tab();
			// Active State Tab
			$this->start_controls_tab( 'exad_exclusive_tabs_header_active', [ 'label' => esc_html__( 'Active', 'exclusive-addons-elementor' ) ] );
				$this->add_control(
					'exad_exclusive_tabs_tab_color_active',
					[
						'label' => esc_html__( 'Tab Background Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#444',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li.active' => 'background-color: {{VALUE}};',
							'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li.active-default' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_exclusive_tabs_tab_text_color_active',
					[
						'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#fff',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li.active' => 'color: {{VALUE}};',
							'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li.active-default' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_exclusive_tabs_tab_icon_color_active',
					[
						'label' => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#fff',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li.active .fa' => 'color: {{VALUE}};',
							'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li.active-default .fa' => 'color: {{VALUE}};',
						],
						'condition' => [
							'exad_exclusive_tabs_icon_show' => 'yes'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'exad_exclusive_tabs_tab_border_active',
						'label' => esc_html__( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li.active, {{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li.active-default',
					]
				);
				$this->add_responsive_control(
					'exad_exclusive_tabs_tab_border_radius_active',
					[
						'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
			 					'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			 					'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li.active-default' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			 			],
					]
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Tabs Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_tabs_tab_content_style_settings',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'exclusive_tabs_content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tabs .exad-tabs-content > div' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'exclusive_tabs_content_text_color',
			[
				'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tabs .exad-tabs-content > div' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'exad_exclusive_tabs_content_typography',
				'selector' => '{{WRAPPER}} .exad-advance-tabs .exad-tabs-content > div',
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_tabs_content_padding',
			[
				'label' => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .exad-advance-tabs .exad-tabs-content > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_tabs_content_margin',
			[
				'label' => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .exad-advance-tabs .exad-tabs-content > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_exclusive_tabs_content_border',
				'label' => esc_html__( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-advance-tabs .exad-tabs-content > div',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_exclusive_tabs_content_shadow',
				'selector' => '{{WRAPPER}} .exad-advance-tabs .exad-tabs-content > div',
				'separator' => 'before'
			]
		);
  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Tabs Caret Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_tabs_tab_caret_style_settings',
			[
				'label' => esc_html__( 'Caret', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'exad_exclusive_tabs_tab_caret_show',
			[
				'label' => esc_html__( 'Show Caret on Active Tab', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'return_value' => 'yes',
			]
		);
		$this->add_control(
			'exad_exclusive_tabs_tab_caret_size',
			[
				'label' => esc_html__( 'Caret Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10
				],
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li:after' => 'border-width: {{SIZE}}px; bottom: -{{SIZE}}px',
					'{{WRAPPER}} .exad-advance-tabs.exad-tabs-vertical .exad-tabs-nav > ul li:after' => 'right: -{{SIZE}}px; top: calc(50% - {{SIZE}}px) !important;',
				],
				'condition' => [
					'exad_exclusive_tabs_tab_caret_show' => 'yes'
				]
			]
		);
		$this->add_control(
			'exad_exclusive_tabs_tab_caret_color',
			[
				'label' => esc_html__( 'Caret Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#444',
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tabs .exad-tabs-nav > ul li:after' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .exad-advance-tabs.exad-tabs-vertical .exad-tabs-nav > ul li:after' => 'border-top-color: transparent; border-left-color: {{VALUE}};',
				],
				'condition' => [
					'exad_exclusive_tabs_tab_caret_show' => 'yes'
				]
			]
		);
  		$this->end_controls_section();
	}

	protected function render() {

   		$settings = $this->get_settings_for_display();
   		$exad_find_default_tab = array();
   		$exad_adv_tab_id = 1;
		$exad_adv_tab_content_id = 1;
		
		$this->add_render_attribute(
			'exad_tab_wrapper',
			[
				'id'				=> "exad-advance-tabs-{$this->get_id()}",
				'class'				=> [ 'exad-advance-tabs', $settings['exad_adv_tab_layout'] ],
				'data-tabid'		=> $this->get_id()
			]
		);
		if($settings['exad_exclusive_tabs_tab_caret_show'] != 'yes')
			$this->add_render_attribute('exad_tab_wrapper', 'class', 'active-caret-on');

		$this->add_render_attribute( 'exad_tab_icon_position', 'class', 'exad-advance-tab-nav' );

	?>
	<div <?php echo $this->get_render_attribute_string('exad_tab_wrapper'); ?>>
  		
        <ul <?php echo $this->get_render_attribute_string('exad_tab_icon_position'); ?>>
        <?php foreach( $settings['exad_exclusive_tabs_tab'] as $tab ) : ?>
            <li class="<?php echo esc_attr( $tab['exad_exclusive_tabs_tab_show_as_default'] ); ?>">
            <?php if( $settings['exad_exclusive_tabs_icon_show'] === 'yes' ) : 
                    if( $tab['exad_exclusive_tabs_icon_type'] === 'icon' ) : ?>
                        <i class="<?php echo esc_attr( $tab['exad_exclusive_tabs_tab_title_icon'] ); ?>"></i>
                    <?php elseif( $tab['exad_exclusive_tabs_icon_type'] === 'image' ) : ?>
                        <img src="<?php echo esc_attr( $tab['exad_exclusive_tabs_tab_title_image']['url'] ); ?>">
                    <?php endif; ?>
            <?php endif; ?> 
            <span class="exad-tab-title"><?php echo $tab['exad_exclusive_tabs_tab_title']; ?></span></li>
        <?php endforeach; ?>
        </ul>
  		
  		
        <?php foreach( $settings['exad_exclusive_tabs_tab'] as $tab ) : $exad_find_default_tab[] = $tab['exad_exclusive_tabs_tab_show_as_default'];?>
            <div class="exad-advance-tab-content <?php echo esc_attr( $tab['exad_exclusive_tabs_tab_show_as_default'] ); ?>">
            <h3 class="exad-advance-tab-content-title">1.Some Title Here</h3>
            <p><?php echo do_shortcode( $tab['exad_exclusive_tabs_tab_content'] ); ?></p>
            <a href="#" class="exad-advance-tab-content-action">Read More
              <i class="fa fa-long-arrow-right"></i>
            </a>
            </div>
        <?php endforeach; ?>
  		
	</div>
	<?php
	}

	protected function content_template() {}
}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Exclusive_Tabs() );