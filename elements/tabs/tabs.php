<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Tabs extends Widget_Base {

	public function get_name() {
		return 'exad-exclusive-tabs';
	}

	public function get_title() {
		return esc_html__( 'Tabs', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-tabs';
	}

	public function get_keywords() {
		return [ 'tabs', 'accordion', 'toggle' ];
	}

   	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function _register_controls() {

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
			'exad_exclusive_tabs',
			[
				'type'      => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default'   => [
					[ 'exad_exclusive_tab_title' => esc_html__( 'Tab Title 1', 'exclusive-addons-elementor' ) ],
					[ 
						'exad_exclusive_tab_title'   => esc_html__( 'Tab Title 2', 'exclusive-addons-elementor' ),
						'exad_exclusive_tab_content' => esc_html__( 'A quick brown fox jumps over the lazy dog. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'exclusive-addons-elementor' )
					],
					[ 'exad_exclusive_tab_title' => esc_html__( 'Tab Title 3', 'exclusive-addons-elementor' ) ]
				],
				'fields'    => [
					[
						'name'         => 'exad_exclusive_tab_show_as_default',
						'label'        => __( 'Active as Default', 'exclusive-addons-elementor' ),
						'type'         => Controls_Manager::SWITCHER,
						'return_value' => 'active'
				  	],
                    [
						'name'        => 'exad_exclusive_tabs_icon_type',
						'label'       => esc_html__( 'Icon Type', 'exclusive-addons-elementor' ),
                        'type'        => Controls_Manager::CHOOSE,
                        'toggle'      => false,
                        'label_block' => false,
                        'options'     => [
                            'none'      => [
                                'title' => esc_html__( 'None', 'exclusive-addons-elementor' ),
                                'icon'  => 'fa fa-ban'
                            ],
                            'icon'      => [
                                'title' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                                'icon'  => 'fa fa-gear'
                            ],
                            'image'     => [
                                'title' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
                                'icon'  => 'fa fa-picture-o'
                            ]
                        ],
                        'default'       => 'none'
					],
					[
						'name'      => 'exad_exclusive_tab_title_icon',
						'label'     => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::ICONS,
						'default'   => [
		                    'value'   => 'fas fa-home',
		                    'library' => 'fa-solid'
		                ],			
						'condition' => [
							'exad_exclusive_tabs_icon_type' => 'icon'
						]
					],
					[
						'name'    => 'exad_exclusive_tab_title_image',
						'label'   => esc_html__( 'Image', 'exclusive-addons-elementor' ),
						'type'    => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src()
						],
						'condition' => [
							'exad_exclusive_tabs_icon_type' => 'image'
						]
					],
					[
						'name'    => 'exad_exclusive_tab_title',
						'label'   => esc_html__( 'Title', 'exclusive-addons-elementor' ),
						'type'    => Controls_Manager::TEXT,
						'default' => esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
						'dynamic' => [ 'active' => true ]
					],
					[
						'name'    => 'exad_exclusive_tab_content',
						'label'   => esc_html__( 'Content', 'exclusive-addons-elementor' ),
						'type'    => Controls_Manager::WYSIWYG,
						'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'exclusive-addons-elementor' )
					],
					[
						'name'         => 'exad_exclusive_tab_detail_btn_switcher',
						'label'        => __( 'Details Button?', 'exclusive-addons-elementor' ),
						'type'         => Controls_Manager::SWITCHER,
						'default'      => 'yes',
						'return_value' => 'yes'
					],
					[
						'name'      => 'exad_exclusive_tab_detail_btn',
						'label'     => __( 'Details Button Text', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::TEXT,
						'default'   => esc_html__( 'Read More', 'exclusive-addons-elementor' ),
						'condition' => [
							'exad_exclusive_tab_detail_btn_switcher' => 'yes'
						]
					],
					[
						'name'    => 'exad_exclusive_tab_detail_btn_link',
						'label'   => __( 'Details Button Link', 'exclusive-addons-elementor' ),
						'type'    => Controls_Manager::URL,
						'default' => [
							'url'         => '#',
							'is_external' => ''
						],
						'show_external' => true,
						'condition' => [
							'exad_exclusive_tab_detail_btn_switcher' => 'yes'
						]
					],
					[
						'name'  => 'exad_exclusive_tab_image',
						'label' => esc_html__( 'Choose Image', 'exclusive-addons-elementor' ),
						'type'  => Controls_Manager::MEDIA
					]
				],
				'title_field' => '{{exad_exclusive_tab_title}}'
			]
		);

  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Tabs Navigation Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_tabs_navigation_style_settings',
			[
				'label' => esc_html__( 'Tab Navigation', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_exclusive_tabs_oriantation',
			[
				'label'   => esc_html__( 'Tab Oriantation', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'exad-tab-horizontal-full-width',
				'options' => [
					'exad-tab-horizontal'            => esc_html__( 'Horizontal', 'exclusive-addons-elementor' ),
					'exad-tab-horizontal-full-width' => esc_html__( 'Horizontal Full Width', 'exclusive-addons-elementor' ),
					'exad-tab-vertical'              => esc_html__( 'Vertical', 'exclusive-addons-elementor' )
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_exclusive_tab_navigation_typography',
				'selector' => '{{WRAPPER}} .exad-advance-tab-nav li span.exad-tab-title',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 16
		                ]
		            ]
	            ]
			]
		);

		$this->add_control(
			'exad_exclusive_tabs_navigation_bg',
			[
				'label'     => esc_html__( 'Navigation Container Background', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .exad-advance-tab-nav' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'exad_exclusive_tabs_navigation_alignment',
			[
				'label'   => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'default' => 'exad-tab-align-center',
				'options' => [
					'exad-tab-align-left'   => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-left'
					],
					'exad-tab-align-center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-center'
					],
					'exad-tab-align-right'  => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-right'
					]
				],
				'condition' => [
					'exad_exclusive_tabs_oriantation!' => 'exad-tab-vertical'
				]
			]
		);

		$this->add_responsive_control(
			'exad_exclusive_tabs_navigation_list_padding',
			[
				'label'        => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '16',
					'right'    => '24',
					'bottom'   => '16',
					'left'     => '24',
					'isLinked' => false
				], 
				'selectors'    => [
					'{{WRAPPER}} .exad-advance-tab-nav li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_exclusive_tabs_navigation_list_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				], 
				'selectors'  => [
					'{{WRAPPER}} .exad-advance-tab-nav li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_exclusive_tabs_navigation_list_width',
			[
				'label'       => __( 'List Item Width', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					],
					'%'       => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 200
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-tab-vertical .exad-advance-tab-nav li' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition'   => [
					'exad_exclusive_tabs_oriantation' => 'exad-tab-vertical'
				]
			]
		);

		$this->add_responsive_control(
			'exad_exclusive_tabs_navigation_list_border_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				], 
				'selectors'  => [
					'{{WRAPPER}} .exad-advance-tab-nav li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'exad_exclusive_tabs_navigation_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'exad_exclusive_tabs_navigation_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );
				
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'     => 'exad_exclusive_tabs_navigation_list_normal_background',
						'label'    => __( 'Background', 'exclusive-addons-elementor' ),
						'types'    => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .exad-advance-tab-nav li'
					]
				);

				$this->add_control(
					'exad_exclusive_tabs_navigation_list_normal_text_color',
					[
						'label'     => __( 'Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#8a8d91',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tab-nav li' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'            => 'exad_exclusive_tabs_navigation_list_normal_border',
						'label'           => __( 'Border', 'exclusive-addons-elementor' ),
						'fields_options'  => [
							'border'      => [
								'default' => 'solid'
							],
							'width'       => [
								'default' => [
									'top'    => '0',
									'right'  => '0',
									'bottom' => '1',
									'left'   => '0'
								]
							],
							'color'       => [
								'default' => '#e5e5e5'
							]
						],
						'selector'        => '{{WRAPPER}} .exad-advance-tab-nav li'
					]
				);

				$this->add_group_control(
	                Group_Control_Box_Shadow::get_type(),
	                [
						'name'     => 'exad_exclusive_tabs_navigation_list_box_shadow',
						'selector' => '{{WRAPPER}} .exad-advance-tab-nav li'
	                ]
	            );
				
			$this->end_controls_tab();
			
			// Active State Tab
			$this->start_controls_tab( 'exad_exclusive_tabs_navigation_active', [ 'label' => esc_html__( 'Active/Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'     => 'exad_exclusive_tabs_navigation_list_active_background',
						'label'    => __( 'Background', 'exclusive-addons-elementor' ),
						'types'    => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .exad-advance-tab-nav li.active, {{WRAPPER}} .exad-advance-tab-nav li:hover, {{WRAPPER}} .exad-tab-triangle-right.active::before, {{WRAPPER}} .exad-tab-triangle-bottom.active::before'
					]
				);

				$this->add_control(
					'exad_exclusive_tabs_navigation_list_hover_text_color',
					[
						'label'     => __( 'Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#0a1724',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tab-nav li.active, {{WRAPPER}} .exad-advance-tab-nav li:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'exad_exclusive_tabs_navigation_list_active_border',
						'label'    => __( 'Border', 'exclusive-addons-elementor' ),
						'fields_options'  => [
							'border'      => [
								'default' => 'solid'
							],
							'width'       => [
								'default' => [
									'top'    => '0',
									'right'  => '0',
									'bottom' => '1',
									'left'   => '0'
								]
							],
							'color'       => [
								'default' => '#7a56ff'
							]
						],
						'selector' => '{{WRAPPER}} .exad-advance-tab-nav li.active, {{WRAPPER}} .exad-advance-tab-nav li:hover'
					]
				);

				$this->add_group_control(
	                Group_Control_Box_Shadow::get_type(),
	                [
						'name'     => 'exad_exclusive_tabs_navigation_list_active_box_shadow',
						'selector' => '{{WRAPPER}} .exad-advance-tab-nav li.active, {{WRAPPER}} .exad-advance-tab-nav li:hover'
	                ]
	            );

			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'exad_exclusive_tabs_list_trangle',
			[
				'label'        => esc_html__( 'Enable Arrow( in active tab )', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'separator'    => 'before',
				'return_value' => 'yes'
			]
		);

		$this->add_control(
			'exad_exclusive_tabs_list_triangle_position',
			[
				'label'   => esc_html__( 'Arrow Position', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'default' => 'exad-tab-triangle-bottom',
				'options' => [
                    'exad-tab-triangle-right'  => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-angle-right'
                    ],
                    'exad-tab-triangle-bottom' => [
						'title' => esc_html__( 'Bottom', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-angle-down'
                    ]
                ],
				'return_value' => 'yes',
				'condition'    => [
					'exad_exclusive_tabs_list_trangle' => 'yes'
				]
			]
		);

  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Tabs Icon Style Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_tabs_tab_icon_style_settings',
			[
				'label' => esc_html__( 'Navigation Icon/Image', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_exclusive_tabs_navigation_image_style',
			[
				'label'     => esc_html__( 'Image', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING
			]
		);

		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
				'name'    => 'exad_tab_navigation_image_size',
				'default' => 'medium_large'
            ]
		);
		
		$this->add_control(
			'exad_exclusive_tabs_navigation_icon_style',
			[
				'label'     => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'exad_exclusive_tabs_icon_box_show',
			[
				'label'        => esc_html__( 'Icon Box', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);

		$this->add_responsive_control(
			'exad_exclusive_tabs_icon_box_height',
			[
				'label'     => esc_html__( 'Icon Box Height', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tab-nav li' => 'height: {{VALUE}}px;'
				],
				'condition' => [
					'exad_exclusive_tabs_icon_box_show' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_exclusive_tabs_icon_box_width',
			[
				'label'     => esc_html__( 'Icon Box Width', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tab-nav li' => 'width: {{VALUE}}px;'
				],
				'condition' => [
					'exad_exclusive_tabs_icon_box_show' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_exclusive_tabs_icon_box_line_height',
			[
				'label'     => esc_html__( 'Icon Line Height', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '50',
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tab-nav li i' => 'line-height: {{VALUE}}px;'
				],
				'condition' => [
					'exad_exclusive_tabs_icon_box_show' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exclusive_tabs_navigation_icon_size',
			[
				'label'      => __( 'Icon Size', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' 	   => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1
					],
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 24
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-advance-tab-nav li i' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_exclusive_tabs_icon_margin',
			[
				'label'       => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => [ 'px', '%', 'em' ],
				'default'     => [
					'top'      => '0',
					'right'    => '10',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				], 
				'selectors'    => [
					'{{WRAPPER}} .exad-advance-tab-nav li i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'exad_exclusive_tabs_icon_style_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'exad_exclusive_tabs_icon_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exclusive_tabs_navigation_icon_normal_color',
					[
						'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#0a1724',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tab-nav li i' => 'color: {{VALUE}};'
						]
					]
				);
				
			$this->end_controls_tab();
			
			// Active State Tab

			$this->start_controls_tab( 'exad_exclusive_tabs_icon_active', [ 'label' => esc_html__( 'Active', 'exclusive-addons-elementor' ) ] );
				
				$this->add_control(
					'exclusive_tabs_navigation_icon_active_color',
					[
						'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#0a1724',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tab-nav li.active i, {{WRAPPER}} .exad-advance-tab-nav li:hover i' => 'color: {{VALUE}};'
						]
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
				'label' => esc_html__( 'Content Area', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exclusive_tabs_content_description_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0a1724',
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tab-content-description' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_tabs_content_description_typography',
				'label'    => esc_html__( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-advance-tab-content-description'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'exad_tab_content_background',
				'label'    => __( 'Background', 'exclusive-addons-elementor' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-advance-tab-content'
			]
		);

		$this->add_responsive_control(
			'exad_tab_content_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '30',
					'right'  => '30',
					'bottom' => '30',
					'left'   => '30'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-advance-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_exclusive_tabs_description_margin',
			[
				'label'        => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				], 
				'selectors'    => [
					'{{WRAPPER}} .exad-advance-tab-content-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'exad_tab_content_border',
				'label'    => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-advance-tab-content'
			]
		);

		$this->add_responsive_control(
			'exad_tab_content_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-advance-tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();
		  
		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Tabs Image Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_tabs_tab_image_style_settings',
			[
				'label' => esc_html__( 'Content Image', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
				'name'    => 'exad_tab_image_size',
				'label'   => esc_html__( 'Image Type', 'exclusive-addons-elementor' ),
				'default' => 'medium'
            ]
		);
		
		$this->add_control(
            'exad_tab_image_align',
            [
				'label'   => esc_html__( 'Image Position', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
                    'exad-tab-image-left' => [
                        'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-angle-left'
                    ],
                    'exad-tab-image-right' => [
                        'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-angle-right'
                    ]
                ],
                'default' => 'exad-tab-image-right'
            ]
        );
		
		$this->end_controls_section();
		  
		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Tabs Button Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_tabs_tab_btn_style_settings',
			[
				'label' => esc_html__( 'Content Button', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'exad_tab_details_btn_typography',
				'selector' => '{{WRAPPER}} .exad-tab-btn'
            ]
		);

		$this->add_responsive_control(
			'exad_tab_details_btn_padding',
			[
				'label'        => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '12',
					'right'    => '35',
					'bottom'   => '12',
					'left'     => '35',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-tab-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_tab_details_btn_margin',
			[
				'label'        => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'selectors'    => [
					'{{WRAPPER}} .exad-tab-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_tab_details_btn_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '50',
					'right'  => '50',
					'bottom' => '50',
					'left'   => '50'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-tab-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		
		$this->start_controls_tabs( 'exad_tab_details_btn_tabs' );

            // normal state tab
            $this->start_controls_tab( 'exad_tab_details_btn_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_tab_details_btn_normal_text_color',
                [
                    'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#7a56ff',
                    'selectors' => [
                        '{{WRAPPER}} .exad-tab-btn' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_tab_details_btn_normal_bg',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .exad-tab-btn' => 'background: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
            Group_Control_Border::get_type(),
                [
					'name'            => 'exad_tab_details_btn_normal_border',
					'label'           => esc_html__( 'Border', 'exclusive-addons-elementor' ),
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
							'default' => '#7a56ff'
						]
					],
                    'selector'        => '{{WRAPPER}} .exad-tab-btn'
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
					'name'     => 'exad_tab_details_btn_normal_box_shadow',
					'selector' => '{{WRAPPER}} .exad-tab-btn'
                ]
            );

            $this->end_controls_tab();

            // hover state tab
            $this->start_controls_tab( 'exad_tab_details_btn_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_tab_details_btn_hover_text_color',
                [
					'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => [
                        '{{WRAPPER}} .exad-tab-btn:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_tab_details_btn_hover_bg',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#7a56ff',
                    'selectors' => [
                        '{{WRAPPER}} .exad-tab-btn:hover' => 'background: {{VALUE}};'
                    ]
                ]
			);
			
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'exad_tab_details_btn_hover_border',
					'label'    => esc_html__( 'Border', 'exclusive-addons-elementor' ),
					'selector' => '{{WRAPPER}} .exad-tab-btn:hover'
				]
			);

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
					'name'     => 'exad_tab_details_btn_hover_box_shadow',
					'selector' => '{{WRAPPER}} .exad-tab-btn:hover'
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

		
  		$this->end_controls_section();

	}

	private function exad_tab_content_render_image( $tab, $settings ) {
        $image_id   = $tab['exad_exclusive_tab_image']['id'];
		$image_size = $settings['exad_tab_image_size_size'];
        if ( 'custom' === $image_size ) {
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'exad_tab_image_size', $settings );
        } else {
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        }

        return sprintf( '<img src="%s" alt="'.Control_Media::get_image_alt( $tab['exad_exclusive_tab_image'] ).'" />', esc_url( $image_src ) );
    }

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$this->add_render_attribute(
			'exad_tab_wrapper',
			[
				'id'     => "exad-advance-tabs-{$this->get_id()}",
				'class'	 => [ 
					'exad-advance-tab', 
					esc_attr( $settings['exad_exclusive_tabs_oriantation'] ),
					esc_attr( $settings['exad_exclusive_tabs_navigation_alignment'] )
				]
			]
		);
	?>
		<div <?php echo $this->get_render_attribute_string('exad_tab_wrapper'); ?> data-tabs>
			
			<ul class="exad-advance-tab-nav">
				<?php foreach( $settings['exad_exclusive_tabs'] as $tab ) : ?>
					<li class="<?php echo esc_attr( $tab['exad_exclusive_tab_show_as_default'] ); ?> <?php echo esc_attr( $settings['exad_exclusive_tabs_list_triangle_position'] ); ?>" data-tab>
						<?php 
							if( 'icon' === $tab['exad_exclusive_tabs_icon_type'] &&  !empty( $tab['exad_exclusive_tab_title_icon']['value'] ) ) :
								Icons_Manager::render_icon( $tab['exad_exclusive_tab_title_icon'] );
							elseif( $tab['exad_exclusive_tabs_icon_type'] === 'image' ) :
								$tab_title_img         = $tab['exad_exclusive_tab_title_image'];
								$tab_title_img_src_url = Group_Control_Image_Size::get_attachment_image_src( $tab_title_img['id'], 'exad_tab_navigation_image_size', $settings );

								if( empty( $tab_title_img_src_url ) ) {
								    $tab_title_img_url = $tab_title_img['url']; 
								} else { 
								    $tab_title_img_url = $tab_title_img_src_url;
								}
								echo '<img class="exad-magnify-small" src="'.esc_url( $tab_title_img_url ).'" alt="'.Control_Media::get_image_alt( $tab['exad_exclusive_tab_title_image'] ).'">';
							endif; 
						?>
						<span class="exad-tab-title"><?php echo esc_html( $tab['exad_exclusive_tab_title'] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
			
			<?php foreach( $settings['exad_exclusive_tabs'] as $key => $tab ) : 
				$exad_find_default_tab[] = $tab['exad_exclusive_tab_show_as_default'];
				$has_image = !empty( $tab['exad_exclusive_tab_image']['url'] ) ? 'yes' : 'no';
				$link_key  = 'link_' . $key;

				$exad_tab_btn_link = $tab['exad_exclusive_tab_detail_btn_link']['url'];
				$this->add_render_attribute( $link_key, 'class', 'exad-tab-btn' );
				if( $exad_tab_btn_link ) {
		            $this->add_render_attribute( $link_key, 'href', esc_url( $exad_tab_btn_link ) );
					if( $tab['exad_exclusive_tab_detail_btn_link']['is_external'] ) {
					    $this->add_render_attribute( $link_key, 'target', '_blank' );
					}
					if( $tab['exad_exclusive_tab_detail_btn_link']['nofollow'] ) {
					    $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
					}
		        }
			?>
				<div class="exad-advance-tab-content exad-tab-image-has-<?php echo esc_attr($has_image); ?> <?php echo esc_attr( $tab['exad_exclusive_tab_show_as_default'] ); ?> <?php echo esc_attr( $settings['exad_tab_image_align'] ); ?>">
					<div class="exad-advance-tab-content-element">
						<div class="exad-advance-tab-content-description"><?php echo wp_kses_post( $tab['exad_exclusive_tab_content'] ); ?></div>
						<?php 
							if ( 'yes' === $tab['exad_exclusive_tab_detail_btn_switcher'] ) {
								echo '<a '.$this->get_render_attribute_string( $link_key ).'>';
									echo esc_html( $tab['exad_exclusive_tab_detail_btn'] );
								echo '</a>';
							} 
						?>
					</div>
					<?php if ( ! empty( $tab['exad_exclusive_tab_image']['url'] ) ) { ?>
						<div class="exad-advance-tab-content-thumb">
                            <?php echo $this->exad_tab_content_render_image( $tab, $settings ); ?>
						</div>
					<?php } ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php
	}
}