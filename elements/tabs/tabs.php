<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Exclusive_Tabs extends Widget_Base {

	public function get_name() {
		return 'exad-exclusive-tabs';
	}

	public function get_title() {
		return esc_html__( 'Tabs', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-tabs';
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
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'exad_exclusive_tab_title' => esc_html__( 'Tab Title 1', 'exclusive-addons-elementor' ) ],
					[ 'exad_exclusive_tab_title' => esc_html__( 'Tab Title 2', 'exclusive-addons-elementor' ) ],
					[ 'exad_exclusive_tab_title' => esc_html__( 'Tab Title 3', 'exclusive-addons-elementor' ) ],
				],
				'fields' => [
					[
						'name' => 'exad_exclusive_tab_show_as_default',
						'label' => __( 'Set as Default', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::SWITCHER,
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
						'name' => 'exad_exclusive_tab_title_icon',
						'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::ICON,
						'default' => 'fa fa-home',				
						'condition' => [
							'exad_exclusive_tabs_icon_type' => 'icon'
						]
					],
					[
						'name' => 'exad_exclusive_tab_title_image',
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
						'name' => 'exad_exclusive_tab_title',
						'label' => esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
						'dynamic' => [ 'active' => true ]
					],
					[
						'name' => 'exad_exclusive_tab_content',
						'label' => esc_html__( 'Tab Content', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::WYSIWYG,
						'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'exclusive-addons-elementor' ),
					],
					[
						'name' => 'exad_exclusive_tab_detail_btn_switcher',
						'label' => __( 'Details Button?', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'no',
						'return_value' => 'yes',
					],
					[
						'name' => 'exad_exclusive_tab_detail_btn',
						'label' => __( 'Details Button Text', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'Read More', 'exclusive-addons-elementor' ),
						'condition' => [
							'exad_exclusive_tab_detail_btn_switcher' => 'yes',
						],
					],
					[
						'name' => 'exad_exclusive_tab_detail_btn_link',
						'label' => __( 'Details Button Link', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::URL,
						'default' => [
							'url' => '#',
							'is_external' => '',
						],
						'show_external' => true,
						'condition' => [
							'exad_exclusive_tab_detail_btn_switcher' => 'yes'
						],
					],
					[
						'name' => 'exad_exclusive_tab_image_show',
						'label' => __( 'Image Show', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'no',
						'return_value' => 'yes',
					],
					[
						'name' => 'exad_exclusive_tab_image',
						'label' => esc_html__( 'Choose Image', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::MEDIA,
						'condition' => [
							'exad_exclusive_tab_image_show' => 'yes'
						],
					],
				],
				'title_field' => '{{exad_exclusive_tab_title}}',
			]
		);


		// $repeater = new Repeater();

        // $repeater->start_controls_tabs('exad_accordion_item_tabs');

        // $repeater->start_controls_tab('exad_accordion_item_content_tab', ['label' => __('Content', 'exclusive-addons-elementor')]);

        // $repeater->add_control(
		// 	'exad_exclusive_accordion_default_active', [
		// 		'label'        => esc_html__( 'Active as Default', 'exclusive-addons-elementor' ),
		// 		'type'         => Controls_Manager::SWITCHER,
		// 		'default'      => 'no',
		// 		'return_value' => 'yes'
		// 	]
		// );

        // $repeater->add_control(
		// 	'exad_exclusive_accordion_icon_show', [
		// 		'label'        => esc_html__( 'Enable Title Icon', 'exclusive-addons-elementor' ),
		// 		'type'         => Controls_Manager::SWITCHER,
		// 		'default'      => 'yes',
		// 		'return_value' => 'yes'
		// 	]
		// );
		
        // $repeater->add_control(
		// 	'exad_exclusive_accordion_title_icon_updated', [
		// 		'label'            => esc_html__( 'Title Icon', 'exclusive-addons-elementor' ),
		// 		'fa4compatibility' => 'exad_exclusive_accordion_title_icon',
		// 		'type'             => Controls_Manager::ICONS,
		// 		'default' 		   => [
		// 			'value'   => 'far fa-user-o',
		// 			'library' => 'solid'
		// 		],
		// 		'condition' 	   => [
		// 			'exad_exclusive_accordion_icon_show' => 'yes'
		// 		]
		// 	]
		// );
		
        // $repeater->add_control(
		// 	'exad_exclusive_accordion_title', [
		// 		'label'            => esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
		// 		'fa4compatibility' => 'exad_exclusive_accordion_title_icon',
		// 		'type'             => Controls_Manager::TEXT,
		// 		'default'          => esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
		// 		'dynamic'          => [ 'active' => true ]
		// 	]
		// );
		
        // $repeater->add_control(
		// 	'exad_exclusive_accordion_content', [
		// 		'label'            => esc_html__( 'Tab Content', 'exclusive-addons-elementor' ),
		// 		'fa4compatibility' => 'exad_exclusive_accordion_title_icon',
		// 		'type'             => Controls_Manager::WYSIWYG,
		// 		'default'          => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'exclusive-addons-elementor' )
		// 	]
		// );

        // $repeater->add_control(
        //     'exad_accordion_show_read_more_btn',
        //     [
        //         'label'        => esc_html__( 'Details Button?', 'exclusive-addons-elementor' ),
        //         'type'         => Controls_Manager::SWITCHER,
        //         'default'      => 'no',
        //         'return_value' => 'yes',
        //         'separator'	   => 'before'
        //     ]
        // );  

        // $repeater->add_control(
        //     'exad_accordion_read_more_btn_text',
        //     [   
        //         'label'         => esc_html__( 'Button Text', 'exclusive-addons-elementor' ),
        //         'type'          => Controls_Manager::TEXT,
        //         'placeholder'   => esc_html__('See Details', 'exclusive-addons-elementor'),
        //         'default'       => esc_html__('See Details', 'exclusive-addons-elementor' ),
        //         'condition'     => [
        //             '.exad_accordion_show_read_more_btn' => 'yes'

        //         ]
        //     ]
        // );

        // $repeater->add_control(
        //     'exad_accordion_read_more_btn_url',
        //     [   
        //         'label'         => esc_html__( 'Button Link', 'exclusive-addons-elementor' ),
        //         'type'          => Controls_Manager::URL,
        //         'default'       => [
        //             'url'           => '#',
        //             'is_external'   => '',
        //         ],
        //         'show_external'     => true,
        //         'placeholder'       => esc_html__( 'http://your-link.com', 'exclusive-addons-elementor' ),
        //         'label_block'       => false,  
        //         'condition'     => [
        //             '.exad_accordion_show_read_more_btn' => 'yes'

        //         ]
        //     ]
        // );

        // $repeater->end_controls_tab();

   		// $repeater->start_controls_tab('exad_accordion_item_image_tab', ['label' => __('Image', 'exclusive-addons-elementor')]);

        // $repeater->add_control(
		// 	'exad_accordion_image', [
		// 		'label'            => esc_html__( 'Choose Image', 'exclusive-addons-elementor' ),
		// 		'type'             => Controls_Manager::MEDIA,
		// 	]
		// );

        // $repeater->end_controls_tab();

   		// $repeater->start_controls_tab('exad_accordion_item_style_tab', ['label' => __('Style', 'exclusive-addons-elementor')]);

        // $repeater->add_control(
        //     'exad_accordion_each_item_container_style',
        //     [
        //         'label'         => esc_html__( 'Container', 'exclusive-addons-elementor' ),
        //         'type'          => Controls_Manager::HEADING
        //     ]
        // );

		// $repeater->add_control(
		//     'exad_accordion_each_item_container_bg_color',
		//     [
		//         'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
		//         'type'      => Controls_Manager::COLOR,
		//         'selectors' => [
		//             '{{WRAPPER}} {{CURRENT_ITEM}}.exad-accordion-single-item' => 'background-color: {{VALUE}};'
		//         ]
		//     ]
		// );

        // $repeater->add_control(
        //     'exad_accordion_each_item_title_style',
        //     [
        //         'label'         => esc_html__( 'Title', 'exclusive-addons-elementor' ),
        //         'type'          => Controls_Manager::HEADING,
        //         'separator'	    => 'before'
        //     ]
        // );

		// $repeater->add_control(
		//     'exad_accordion_each_item_title_color',
		//     [
		//         'label'     => __( 'Color', 'exclusive-addons-elementor' ),
		//         'type'      => Controls_Manager::COLOR,
		//         'selectors' => [
		//             '{{WRAPPER}} {{CURRENT_ITEM}}.exad-accordion-single-item .exad-accordion-title h3' => 'color: {{VALUE}};'
		//         ]
		//     ]
		// );

		// $repeater->add_control(
		//     'exad_accordion_each_item_title_bg_color',
		//     [
		//         'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
		//         'type'      => Controls_Manager::COLOR,
		//         'selectors' => [
		//             '{{WRAPPER}} {{CURRENT_ITEM}}.exad-accordion-single-item .exad-accordion-title' => 'background-color: {{VALUE}};'
		//         ]
		//     ]
		// );

		// $repeater->add_control(
		//     'exad_accordion_each_item_title_hover_color',
		//     [
		//         'label'     => __( 'Hover Color', 'exclusive-addons-elementor' ),
		//         'type'      => Controls_Manager::COLOR,
		//         'selectors' => [
		//             '{{WRAPPER}} {{CURRENT_ITEM}}.exad-accordion-single-item .exad-accordion-title:hover h3' => 'color: {{VALUE}};'
		//         ]
		//     ]
		// );

		// $repeater->add_control(
		//     'exad_accordion_each_item_title_hover_bg_color',
		//     [
		//         'label'     => __( 'Hover Background Color', 'exclusive-addons-elementor' ),
		//         'type'      => Controls_Manager::COLOR,
		//         'selectors' => [
		//             '{{WRAPPER}} {{CURRENT_ITEM}}.exad-accordion-single-item .exad-accordion-title:hover' => 'background-color: {{VALUE}};'
		//         ]
		//     ]
		// );

        // $repeater->add_control(
        //     'exad_accordion_each_item_content_style',
        //     [
        //         'label'         => esc_html__( 'Content', 'exclusive-addons-elementor' ),
        //         'type'          => Controls_Manager::HEADING,
        //         'separator'	    => 'before'
        //     ]
        // );

		// $repeater->add_group_control(
		//     Group_Control_Border::get_type(),
		//     [
		//         'name'          => 'exad_accordion_each_item_container_border',
		//         'label'         => __( 'Border', 'exclusive-addons-elementor' ),
		//         'selector'      => '{{WRAPPER}} {{CURRENT_ITEM}}.exad-accordion-single-item'
		//     ]
		// );

        // $repeater->end_controls_tab();

        // $repeater->end_controls_tabs();

  		// $this->add_control(
		// 	'exad_exclusive_accordion_tab',
		// 	[
		// 		'type' 		=> Controls_Manager::REPEATER,
		// 		'fields' 	=> $repeater->get_controls(),
		// 		'default'	=> [
		// 			[ 'exad_exclusive_accordion_title' => esc_html__( 'Accordion Title 1', 'exclusive-addons-elementor' ) ],
		// 			[ 'exad_exclusive_accordion_title' => esc_html__( 'Accordion Title 2', 'exclusive-addons-elementor' ) ],
		// 			[ 'exad_exclusive_accordion_title' => esc_html__( 'Accordion Title 3', 'exclusive-addons-elementor' ) ]
		// 		],
		// 		'title_field' => '{{exad_exclusive_accordion_title}}'
		// 	]
		// );
  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Tabs Generel Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_tabs_style_preset_settings',
			[
				'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		// $this->add_control(
		// 	'exad_exclusive_tabs_preset',
		// 	[
		// 		'label'       	=> esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
		// 		'type' 			=> Controls_Manager::SELECT,
		// 		'default' 		=> 'two',
		// 		'label_block' 	=> false,
		// 		'options' 		=> [
		// 			'two' => esc_html__( 'Style 1', 'exclusive-addons-elementor' ),
		// 			'three' => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
		// 			'four' => esc_html__( 'Style 3', 'exclusive-addons-elementor' ),
		// 			'five' => esc_html__( 'Style 4', 'exclusive-addons-elementor' ),
		// 		],
		// 	]
		// );

		$this->add_control(
			'exad_exclusive_tabs_icon_show',
			[
				'label' => esc_html__( 'Enable Icon', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_tab_background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-advance-tab-content',
			]
		);

		$this->add_control(
			'exad_tab_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '30',
					'right' => '30',
					'bottom' => '30',
					'left' => '30',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		  
  		$this->end_controls_section();
  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Tabs Heading Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_tabs_navigation_style_settings',
			[
				'label' => esc_html__( 'Tab Navigation', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_exclusive_tabs_oriantation',
			[
				'label'       	=> esc_html__( 'Tab Oriantation', 'exclusive-addons-elementor' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'exad-tab-horizontal-full-width',
				'options' 		=> [
					'exad-tab-horizontal' => esc_html__( 'Horizontal', 'exclusive-addons-elementor' ),
					'exad-tab-horizontal-full-width' => esc_html__( 'Horizontal Full Width', 'exclusive-addons-elementor' ),
					'exad-tab-vertical' => esc_html__( 'Vertical', 'exclusive-addons-elementor' ),
				],
			]
		);

		$this->add_control(
			'exad_exclusive_tabs_navigation_alignment',
			[
				'label' => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'exad-tab-align-left' => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'exad-tab-align-center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'exad-tab-align-right' => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'exad-tab-align-center',
			]
		);

		// list style

		$this->add_control(
			'exad_exclusive_tabs_navigation_list_border_radius',
			[
				'label' => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				], 
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tab-nav li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_exclusive_tabs_navigation_list_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '15',
					'right' => '30',
					'bottom' => '15',
					'left' => '30',
				], 
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tab-nav li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_exclusive_tabs_navigation_list_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				], 
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tab-nav li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'exad_exclusive_tab_navigation_typography',
				'selector' => '{{WRAPPER}} .exad-advance-tab-nav li',
			]
		);

		$this->start_controls_tabs( 'exad_exclusive_tabs_navigation_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'exad_exclusive_tabs_navigation_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );
				
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'exad_exclusive_tabs_navigation_list_normal_background',
						'label' => __( 'Background', 'exclusive-addons-elementor' ),
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .exad-advance-tab-nav li',
					]
				);

				$this->add_control(
					'exad_exclusive_tabs_navigation_list_normal_text_color',
					[
						'label' => __( 'Text Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tab-nav li' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'exad_exclusive_tabs_navigation_list_normal_border',
						'label' => __( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-advance-tab-nav li',
					]
				);
				
			$this->end_controls_tab();
			
			// Active State Tab

			$this->start_controls_tab( 'exad_exclusive_tabs_navigation_active', [ 'label' => esc_html__( 'Active', 'exclusive-addons-elementor' ) ] );
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'exad_exclusive_tabs_navigation_list_active_background',
						'label' => __( 'Background', 'exclusive-addons-elementor' ),
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .exad-advance-tab-nav li.active, {{WRAPPER}} .exad-advance-tab-nav li:hover',
					]
				);

				$this->add_control(
					'exad_exclusive_tabs_navigation_list_hover_text_color',
					[
						'label' => __( 'Text Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tab-nav li.active, {{WRAPPER}} .exad-advance-tab-nav li:hover' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'exad_exclusive_tabs_navigation_list_active_border',
						'label' => __( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-advance-tab-nav li.active, {{WRAPPER}} .exad-advance-tab-nav li:hover',
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

		// $this->add_control(
		// 	'exclusive_tabs_content_title_color',
		// 	[
		// 		'label' => esc_html__( 'Title Color', 'exclusive-addons-elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'default' => '#0a1724',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .exad-advance-tab .exad-advance-tab-content .exad-advance-tab-content-title' => 'color: {{VALUE}};',
		// 		],
		// 	]
		// );
		// $this->add_group_control(
		// 	Group_Control_Typography::get_type(),
		// 	[
		// 		'name' => 'exad_exclusive_tabs_content_title_typography',
		// 		'label' => esc_html__( 'Title Typography', 'exclusive-addons-elementor' ),
		// 		'selector' => '{{WRAPPER}} .exad-advance-tab .exad-advance-tab-content-title',
		// 	]
		// );
		// $this->add_control(
		// 	'exclusive_tabs_content_bg_color',
		// 	[
		// 		'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'default' => '#f9f9f9',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .exad-advance-tab .exad-advance-tab-content ' => 'background-color: {{VALUE}};',
		// 		],
		// 	]
		// );
		// $this->add_control(
		// 	'exclusive_tabs_content_text_color',
		// 	[
		// 		'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'default' => '#333',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .exad-advance-tab .exad-advance-tab-content ' => 'color: {{VALUE}};',
		// 		],
		// 	]
		// );
		// $this->add_group_control(
		// 	Group_Control_Typography::get_type(),
		// 	[
		// 		'name' => 'exad_exclusive_tabs_content_typography',
		// 		'label' => esc_html__( 'Text Typography', 'exclusive-addons-elementor' ),
		// 		'selector' => '{{WRAPPER}} .exad-advance-tab .exad-advance-tab-content p',
		// 	]
		// );
		// $this->add_control(
		// 	'exad_exclusive_tabs_content_padding',
		// 	[
		// 		'label' => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
		// 		'type' => Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', 'em', '%' ],
		// 		'default' => [
		// 			'top' => 40,
		// 			'right' => 40,
		// 			'bottom' => 40,
		// 			'left' => 40,
		// 			'isLinked' => true,
		// 		],
		// 		'selectors' => [
	 	// 			'{{WRAPPER}} .exad-advance-tab .exad-advance-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 	// 		],
		// 	]
		// );
		
	
		  $this->end_controls_section();
		  
		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Tabs Image Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_tabs_tab_image_style_settings',
			[
				'label' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'          => 'exad_tab_image_size',
                'label'         => esc_html__( 'Image Type', 'exclusive-addons-elementor' ),
				'default'       => 'medium',
            ]
		);
		
		$this->add_control(
            'exad_tab_image_align',
            [
                'label'         => esc_html__( 'Image Position', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::CHOOSE,
                'options'       => [
                    'exad-tab-image-left'      => [
                        'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-angle-left'
                    ],
                    'exad-tab-image-right'     => [
                        'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-angle-right'
                    ]
                ],
                'default'       => 'exad-tab-image-right'
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
				'label' => esc_html__( 'Button', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'exad_tab_details_btn_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '10',
					'right' => '20',
					'bottom' => '10',
					'left' => '20',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-tab-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_tab_details_btn_radius',
			[
				'label' => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-tab-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'exad_tab_details_btn_typography',
                'selector'      => '{{WRAPPER}} .exad-tab-btn'
            ]
		);
		
		$this->start_controls_tabs( 'exad_tab_details_btn_tabs' );

            // normal state tab
            $this->start_controls_tab( 'exad_tab_details_btn_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_tab_details_btn_normal_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#000000',
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
                    'name'      => 'exad_tab_details_btn_normal_border',
                    'label'     => esc_html__( 'Border', 'exclusive-addons-elementor' ),
                    'selector'  => '{{WRAPPER}} .exad-tab-btn'
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'exad_tab_details_btn_normal_box_shadow',
                    'selector'  => '{{WRAPPER}} .exad-tab-btn',
                ]
            );

            $this->end_controls_tab();

            // hover state tab
            $this->start_controls_tab( 'exad_tab_details_btn_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_tab_details_btn_hover_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
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
                    'selectors' => [
                        '{{WRAPPER}} .exad-tab-btn:hover' => 'background: {{VALUE}};'
                    ]
                ]
			);
			
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'      => 'exad_tab_details_btn_hover_border',
					'label'     => esc_html__( 'Border', 'exclusive-addons-elementor' ),
					'selector'  => '{{WRAPPER}} .exad-tab-btn:hover'
				]
			);

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'exad_tab_details_btn_hover_box_shadow',
                    'selector'  => '{{WRAPPER}} .exad-tab-btn:hover',
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

		
  		$this->end_controls_section();

	}

	private function render_image( $tab, $settings ) {
        $image_id   = $tab['exad_exclusive_tab_image']['id'];
		$image_size = $settings['exad_exclusive_tab_image_size_size'];
        if ( 'custom' === $image_size ) {
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'exad_tab_image_size', $settings );
        } else {
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        }

        return sprintf( '<img src="%s" alt="%s" />', esc_url($image_src), esc_html($tab['exad_exclusive_tab_title']) );
    }

	protected function render() {

		$settings = $this->get_settings_for_display();
		
		$this->add_render_attribute(
			'exad_tab_wrapper',
			[
				'id'     => "exad-advance-tabs-{$this->get_id()}",
				'class'	 => [ 'exad-advance-tab', $settings['exad_exclusive_tabs_preset'], $settings['exad_exclusive_tabs_oriantation'],
					$settings['exad_exclusive_tabs_navigation_alignment']
				],
			]
		);

	?>
		<div <?php echo $this->get_render_attribute_string('exad_tab_wrapper'); ?> data-tabs>
			
			<ul class="exad-advance-tab-nav">
			<?php foreach( $settings['exad_exclusive_tabs'] as $tab ) : ?>
				<li class="<?php echo esc_attr( $tab['exad_exclusive_tab_show_as_default'] ); ?>" data-tab>
					<?php if( $settings['exad_exclusive_tabs_icon_show'] === 'yes' ) : 
						if( $tab['exad_exclusive_tabs_icon_type'] === 'icon' ) : ?>
							<i class="<?php echo esc_attr( $tab['exad_exclusive_tab_title_icon'] ); ?>"></i>
						<?php elseif( $tab['exad_exclusive_tabs_icon_type'] === 'image' ) : ?>
							<img src="<?php echo esc_attr( $tab['exad_exclusive_tab_title_image']['url'] ); ?>">
						<?php endif; ?>
					<?php endif; ?> 
					<span class="exad-tab-title"><?php echo $tab['exad_exclusive_tab_title']; ?></span>
				</li>
			<?php endforeach; ?>
			</ul>
			
			
			<?php foreach( $settings['exad_exclusive_tabs'] as $tab ) : $exad_find_default_tab[] = $tab['exad_exclusive_tab_show_as_default'];?>
				<div class="exad-advance-tab-content <?php echo esc_attr( $tab['exad_exclusive_tab_show_as_default'] ); ?> <?php echo esc_attr( $settings['exad_tab_image_align'] ); ?>">
					<div class="exad-advance-tab-content-element">
						<h3 class="exad-advance-tab-content-title"><?php echo $tab['exad_exclusive_tab_title']; ?></h3>
						<p><?php echo esc_html( $tab['exad_exclusive_tab_content'] ); ?></p>
						<?php if ( $tab['exad_exclusive_tab_detail_btn_switcher'] === 'yes' ) { ?>
							<a href="<?php echo esc_url( $tab['exad_exclusive_tab_detail_btn_link']['url'] ); ?>" class="exad-tab-btn">
								<?php echo $tab['exad_exclusive_tab_detail_btn']; ?>
							</a>
						<?php } ?>
					</div>
					<?php if ( $tab['exad_exclusive_tab_image_show'] === 'yes' ) { ?>
						<div class="exad-advance-tab-content-thumb">
                            <?php echo $this->render_image( $tab, $settings ); ?>
						</div>
					<?php } ?>
				</div>
			<?php endforeach; ?>
			
		</div>
	<?php
	}
	
	/*protected function _content_template() {
		<img src="<?php echo esc_attr( $tab['exad_exclusive_tab_image']['url'] ); ?>" alt="<?php echo esc_attr( $tab['exad_exclusive_tab_title'] ); ?>">
		?>
		<div id="exad-advance-tabs" class="exad-advance-tab {{ settings.exad_exclusive_tabs_preset }}" data-tabs>
			
			<ul class="exad-advance-tab-nav">
				<# _.each( settings.exad_exclusive_tabs, function( tab, index ) { #>
					<li class="{{ tab.exad_exclusive_tab_show_as_default }}" data-tab>
					<# if( settings.exad_exclusive_tabs_icon_show === 'yes' ) { #>
						<# if( tab.exad_exclusive_tabs_icon_type === 'icon' ) { #>
							<i class="{{ tab.exad_exclusive_tab_title_icon }}"></i>
						<# } else if( tab.exad_exclusive_tabs_icon_type === 'image' ) { #>
							<img src="{{ tab.exad_exclusive_tab_title_image.url }}">
						<# } #>	
					<# } #>		
					<span class="exad-tab-title">{{{ tab.exad_exclusive_tab_title }}}</span></li>
				<# }); #>
			</ul>
			
			<# _.each( settings.exad_exclusive_tabs, function( tab, index ) { #>
				<div class="exad-advance-tab-content {{ tab.exad_exclusive_tab_show_as_default }}">
				<h3 class="exad-advance-tab-content-title">{{{ tab.exad_exclusive_tab_title }}}</h3>
				<p>{{{ tab.exad_exclusive_tab_content }}}</p>
				</div>
			<# }); #>
			
		</div>
		<?php
	}*/
}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Exclusive_Tabs() );