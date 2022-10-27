<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Control_Media;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Widget_Base;
use \Elementor\Utils;
use \ExclusiveAddons\Elementor\Helper;

class Accordion extends Widget_Base {

	public function get_name() {
		return 'exad-exclusive-accordion';
	}

	public function get_title() {
		return esc_html__( 'Accordion', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad exad-logo exad-accordion';
	}


	public function get_keywords() {
		return [ 'exclusive', 'toggle' ];
	}

   public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function register_controls() {
		
  		/**
  		 * Exclusive Accordion Content Settings
  		 */
  		$this->start_controls_section(
  			'exad_section_exclusive_accordion_content_settings',
  			[
  				'label' => esc_html__( 'Contents', 'exclusive-addons-elementor' )
  			]
  		);

		$this->add_control(
            'exad_accordion_title_html_tag',
            [
                'label'   => __('Title HTML Tag', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SELECT,
				'separator' => 'after',
                'options' => Helper::exad_title_tags(),
                'default' => 'h3',
            ]
		);

  		$repeater = new Repeater();

        $repeater->start_controls_tabs('exad_accordion_item_tabs');

        $repeater->start_controls_tab('exad_accordion_item_content_tab', ['label' => __('Content', 'exclusive-addons-elementor')]);

        $repeater->add_control(
			'exad_exclusive_accordion_default_active', [
				'label'        => esc_html__( 'Active as Default', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);

        $repeater->add_control(
			'exad_exclusive_accordion_icon_show', [
				'label'        => esc_html__( 'Enable Title Icon', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);
		
		$repeater->add_control(
			'exad_exclusive_accordion_title_icon',
			[
				'label'       => __( 'Icon', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => [
					'value'   => 'far fa-user',
					'library' => 'fa-regular'
				],
				'condition'   => [
					'exad_exclusive_accordion_icon_show' => 'yes'
				]
			]
		);

        $repeater->add_control(
			'exad_exclusive_accordion_title', [
				'label'   => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Accordion Title', 'exclusive-addons-elementor' ),
				'dynamic' => [ 'active' => true ]
			]
		);
		
        $repeater->add_control(
			'exad_exclusive_accordion_content', [
				'label'   => esc_html__( 'Content', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'exclusive-addons-elementor' )
			]
		);

        $repeater->add_control(
            'exad_accordion_show_read_more_btn',
            [
                'label'        => esc_html__( 'Enable Button.', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'	   => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'separator'	   => 'before'
            ]
        );  

        $repeater->add_control(
            'exad_accordion_read_more_btn_text',
            [   
				'label'       => esc_html__( 'Button Text', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__('See Details', 'exclusive-addons-elementor'),
				'default'     => esc_html__('See Details', 'exclusive-addons-elementor' ),
				'condition'   => [
                    '.exad_accordion_show_read_more_btn' => 'yes'
                ],
				'dynamic' => [
					'active' => true,
				]
            ]
        );

        $repeater->add_control(
            'exad_accordion_read_more_btn_url',
            [   
                'label'         => esc_html__( 'Button Link', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::URL,
                'default'       => [
                    'url'           => '#',
                    'is_external'   => ''
                ],
                'show_external'     => true,
                'placeholder'       => __( 'http://your-link.com', 'exclusive-addons-elementor' ),
                'condition'     => [
                    '.exad_accordion_show_read_more_btn' => 'yes'
                ]
            ]
        );

        $repeater->end_controls_tab();

   		$repeater->start_controls_tab('exad_accordion_item_image_tab', ['label' => __('Image', 'exclusive-addons-elementor')]);

        $repeater->add_control(
			'exad_accordion_image', [
				'label' => esc_html__( 'Choose Image', 'exclusive-addons-elementor' ),
				'type'  => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				]
			]
		);

        $repeater->end_controls_tab();

   		$repeater->start_controls_tab('exad_accordion_item_style_tab', ['label' => __('Style', 'exclusive-addons-elementor')]);

        $repeater->add_control(
            'exad_accordion_each_item_container_style',
            [
				'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'type'  => Controls_Manager::HEADING
            ]
        );

		$repeater->add_control(
		    'exad_accordion_each_item_container_bg_color',
		    [
		        'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.exad-accordion-single-item' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

        $repeater->add_control(
            'exad_accordion_each_item_title_style',
            [
				'label'     => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );

		$repeater->add_control(
		    'exad_accordion_each_item_title_color',
		    [
		        'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.exad-accordion-single-item .exad-accordion-title .exad-accordion-heading' => 'color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'exad_accordion_each_item_title_bg_color',
		    [
		        'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.exad-accordion-single-item .exad-accordion-title' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'exad_accordion_each_item_title_hover_color',
		    [
		        'label'     => __( 'Hover Color', 'exclusive-addons-elementor' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.exad-accordion-single-item .exad-accordion-title:hover .exad-accordion-heading' => 'color: {{VALUE}};'
		        ]
		    ]
		);

		$repeater->add_control(
		    'exad_accordion_each_item_title_hover_bg_color',
		    [
		        'label'     => __( 'Hover Background Color', 'exclusive-addons-elementor' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.exad-accordion-single-item .exad-accordion-title:hover' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

        $repeater->add_control(
            'exad_accordion_each_item_content_style',
            [
				'label'     => esc_html__( 'Content', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );

		$repeater->add_group_control(
		    Group_Control_Border::get_type(),
		    [
				'name'     => 'exad_accordion_each_item_container_border',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.exad-accordion-single-item'
		    ]
		);

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

  		$this->add_control(
			'exad_exclusive_accordion_tab',
			[
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default'	=> [
					[ 
						'exad_exclusive_accordion_title'          => esc_html__( 'Accordion Title 1', 'exclusive-addons-elementor' ),
						'exad_exclusive_accordion_default_active' => 'yes'
					],
					[ 'exad_exclusive_accordion_title' => esc_html__( 'Accordion Title 2', 'exclusive-addons-elementor' ) ],
					[ 'exad_exclusive_accordion_title' => esc_html__( 'Accordion Title 3', 'exclusive-addons-elementor' ) ]
				],
				'title_field' => '{{exad_exclusive_accordion_title}}'
			]
		);

        $this->add_control(
			'exad_exclusive_accordion_tab_title_show_active_inactive_icon',
			[
				'label'        => esc_html__( 'Show Active/Inactive Icon?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'	   => 'before' 
			]
		);

		$this->add_control(
			'exad_exclusive_accordion_tab_title_active_icon',
			[
				'label'       => __( 'Active Icon', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-angle-up',
					'library' => 'fa-solid'
				],
				'condition'   => [
					'exad_exclusive_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_exclusive_accordion_tab_title_inactive_icon',
			[
				'label'       => __( 'Inactive Icon', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-angle-down',
					'library' => 'fa-solid'
				],
				'condition'   => [
					'exad_exclusive_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);

  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Accordion Container Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_accordions_container_style',
			[
				'label'	=> esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);		

		$this->add_control(
			'exad_accordion_container_background_color',
			[
				'label'		=> esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item' => 'background-color: {{VALUE}};'
				]
			]
		);

        $this->add_responsive_control(
            'exad_exclusive_accordion_container_padding',
            [
				'label'      => __('Padding', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
                    '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_exclusive_accordion_container_margin',
            [
				'label'        => __('Margin', 'exclusive-addons-elementor'),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => ['px', '%'],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
                'selectors'    => [
                    '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
        	Group_Control_Border::get_type(),
            [
				'name'     => 'exad_exclusive_accordion_container_border',
				'selector' => '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item'
            ]
		);
		
		$this->add_responsive_control(
            'exad_exclusive_accordion_container_border_radius',
            [
				'label'      => __('Border Radius', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
                'selectors'  => [
                    '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_accordion_container_box_shadow',
				'selector' => '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'exad_section_exclusive_accordions_tab_style',
			[
				'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'            => 'exad_exclusive_accordion_title_typography',
				'selector'        => '{{WRAPPER}} .exad-accordion-single-item .exad-accordion-heading',
                'fields_options'  => [
                    'font_weight' => [
                        'default' => '600'
                    ]
                ]
			]
		);

        $this->add_responsive_control(
            'exad_exclusive_accordion_title_padding',
            [
				'label'      => __('Padding', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20'
				],
                'selectors'  => [
                    '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_exclusive_accordion_title_margin',
            [
				'label'      => __('Margin', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
                'selectors'  => [
                    '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title .exad-accordion-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
        	Group_Control_Border::get_type(),
            [
				'name'               => 'exad_exclusive_accordion_title_border',
				'fields_options'     => [
                    'border' 	     => [
                        'default'    => 'solid'
                    ],
                    'width'  	     => [
                        'default' 	 => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                    'color' 	     => [
                        'default'    => '#000000'
                    ]
                ],
                'selector'           => '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title'
            ]
        );

		$this->add_responsive_control(
			'exad_accordion_title_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_accordion_title_box_shadow',
				'selector' => '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title'
			]
		);

		$this->start_controls_tabs( 'exad_exclusive_accordion_header_tabs' );

			# Normal State Tab
			$this->start_controls_tab( 'exad_exclusive_accordion_header_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );
				$this->add_control(
					'exad_exclusive_accordion_tab_text_color',
					[
						'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '#000000',
						'selectors'	=> [
							'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-heading' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'exad_exclusive_accordion_tab_color',
					[
						'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title' => 'background-color: {{VALUE}};'
						]
					]
				);
				
			$this->end_controls_tab();

			#Hover State Tab
			$this->start_controls_tab( 'exad_exclusive_accordion_header_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );
				$this->add_control(
					'exad_exclusive_accordion_tab_text_color_hover',
					[
						'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors'	=> [
							'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title:hover .exad-accordion-heading' => 'color: {{VALUE}};',
							'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title.active:hover .exad-accordion-heading' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'exad_exclusive_accordion_tab_color_bg_hover',
					[
						'label'		=> esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title:hover' => 'background-color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();

			#Active State Tab
			$this->start_controls_tab( 'exad_exclusive_accordion_header_active', [ 'label' => esc_html__( 'Active', 'exclusive-addons-elementor' ) ] );
				$this->add_control(
					'exad_exclusive_accordion_tab_text_color_active',
					[
						'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors'	=> [
							'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title.active .exad-accordion-heading' => 'color: {{VALUE}} !important;'
						]
					]
				);

				$this->add_control(
					'exad_exclusive_accordion_tab_color_bg_active',
					[
						'label'		=> esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title.active' => 'background-color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'exad_accordion_tab_title_icon_style',
			[
				'label'	=> esc_html__( 'Title Icon', 'exclusive-addons-elementor' ),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
            'exad_accordion_title_icon_size',
            [
                'label'        => __( 'Size', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 10,
                        'max'  => 150,
                        'step' => 2
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 20
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title span.exad-tab-title-icon i' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );   

	    $this->add_responsive_control(
      		'exad_accordion_title_icon_width',
      		[
				'label'    => esc_html__( 'Width', 'exclusive-addons-elementor' ),
				'type'     => Controls_Manager::SLIDER,
				'default'  => [
		      		'size' => 70
		    	],
		        'range'    => [
		          	'px'   => [
		              	'max' => 100
		          	]
		        ],
		        'selectors' => [
		          	'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title span.exad-tab-title-icon' => 'width: {{SIZE}}px;'
		        ]
	      	]
	    );

        $this->add_group_control(
        	Group_Control_Border::get_type(),
            [
				'name'     => 'exad_accordion_title_icon_border',
				'selector' => '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title span.exad-tab-title-icon'
            ]
        );

        $this->add_responsive_control(
            'exad_accordion_title_icon_padding',
            [
				'label'      => __('Padding', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
                    '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title span.exad-tab-title-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_accordion_title_icon_margin',
            [
				'label'      => __('Margin', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
                    '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title span.exad-tab-title-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'exad_accordion_title_icon_style_tabs' );

        	// normal state tab
        	$this->start_controls_tab( 'exad_accordion_title_icon_general_style', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_accordion_tab_title_icon_color',
				[
					'label'		=> esc_html__( 'Color', 'exclusive-addons-elementor' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title span.exad-tab-title-icon' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'exad_accordion_tab_title_icon_bg_color',
				[
					'label'		=> esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title span.exad-tab-title-icon' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->end_controls_tab();

			// active state tab
        	$this->start_controls_tab( 'exad_accordion_title_icon_active_style', [ 'label' => esc_html__( 'Active', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_accordion_title_icon_active_color',
				[
					'label'		=> esc_html__( 'Color', 'exclusive-addons-elementor' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title.active span.exad-tab-title-icon i' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'exad_accordion_title_icon_active_bg_color',
				[
					'label'		=> esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title.active span.exad-tab-title-icon' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->end_controls_section();

		$this->start_controls_section(
			'exad_accordion_active_inactive_icon_style',
			[
				'label'     => esc_html__( 'Active/Inactive Icon', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_exclusive_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);

	    $this->add_responsive_control(
      		'exad_accordion_active_inactive_icon_size',
      		[
				'label'        => esc_html__( 'Size', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 10,
                        'max'  => 150,
                        'step' => 2
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 20
                ],
				'selectors'    => [
		          	'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title .exad-active-inactive-icon i' => 'font-size: {{SIZE}}px;'
		        ]
	      	]
	    );

	    $this->add_responsive_control(
      		'exad_accordion_active_inactive_icon_width',
      		[
				'label'       => esc_html__( 'Width', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
		      		'size'    => 70
		    	],
		        'range'       => [
		          	'px'      => [
		              	'max' => 100
		          	]
		        ],
		        'selectors'   => [
		          	'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title .exad-active-inactive-icon' => 'width: {{SIZE}}px;'
		        ]
	      	]
	    );

        $this->add_group_control(
        	Group_Control_Border::get_type(),
            [
				'name'     => 'exad_accordion_active_inactive_icon_border',
				'selector' => '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title .exad-active-inactive-icon'
            ]
        );

        $this->start_controls_tabs( 'exad_accordion_active_inactive_icon_style_tabs' );

        	// normal state tab
        	$this->start_controls_tab( 'exad_accordion_general_style', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_accordion_general_icon_color',
				[
					'label'		=> esc_html__( 'Color', 'exclusive-addons-elementor' ),
					'type'		=> Controls_Manager::COLOR,
					'default'	=> '#000000',
					'selectors'	=> [
						'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title .exad-active-inactive-icon i' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'exad_accordion_general_icon_bg_color',
				[
					'label'		=> esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title .exad-active-inactive-icon' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->end_controls_tab();

			// active state tab
        	$this->start_controls_tab( 'exad_accordion_active_style', [ 'label' => esc_html__( 'Active', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_accordion_active_icon_color',
				[
					'label'		=> esc_html__( 'Color', 'exclusive-addons-elementor' ),
					'type'		=> Controls_Manager::COLOR,
					'default'	=> '#000000',
					'selectors'	=> [
						'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title.active .exad-active-inactive-icon i' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'exad_accordion_active_icon_bg_color',
				[
					'label'		=> esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
					'type'		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-title.active .exad-active-inactive-icon' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		
  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Accordion Content Style
		 * -------------------------------------------
		 */

		$this->start_controls_section(
			'exad_section_accordion_tab_content_style_settings',
			[
				'label'	=> esc_html__( 'Content', 'exclusive-addons-elementor' ),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_exclusive_accordion_content_typography',
				'selector' => '{{WRAPPER}} .exad-accordion-single-item .exad-accordion-text'
			]
		);

		$this->add_control(
			'exad_accordion_content_bg_color',
			[
				'label'		=> esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-content .exad-accordion-content-wrapper' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'exad_accordion_content_text_color',
			[
				'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '#000000',
				'selectors' => [
					'{{WRAPPER}} .exad-accordion-single-item .exad-accordion-text' => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_responsive_control(
            'exad_accordion_content_padding',
            [
				'label'      => __('Padding', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20'
				],
                'selectors'  => [
                    '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-content .exad-accordion-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_accordion_content_margin',
            [
				'label'      => __('Margin', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
                'selectors'  => [
                    '{{WRAPPER}} .exad-accordion-single-item .exad-accordion-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
        	Group_Control_Border::get_type(),
            [
				'name'                 => 'exad_exclusive_accordion_content_border',
				'fields_options'       => [
                    'border' 	       => [
                        'default'      => 'solid'
                    ],
                    'width'  		   => [
                        'default' 	   => [
							'top'      => '0',
							'right'    => '1',
							'bottom'   => '1',
							'left'     => '1',
							'isLinked' => false
                        ]
                    ],
                    'color' 		   => [
                        'default' 	   => '#000000'
                    ]
                ],
                'selector'             => '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-content .exad-accordion-content-wrapper'
            ]
		);
		
		$this->add_responsive_control(
            'exad_accordion_content_border_radius',
            [
				'label'      => __('Border Radius', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
                'selectors'  => [
                    '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-content .exad-accordion-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

  		$this->end_controls_section();

		$this->start_controls_section(
			'exad_section_accordion_tab_image_style',
			[
				'label'	=> esc_html__( 'Image', 'exclusive-addons-elementor' ),
				'tab'	=> Controls_Manager::TAB_STYLE

			]
		);

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
				'name'    => 'exad_accordion_image_size',
				'label'   => esc_html__( 'Image Type', 'exclusive-addons-elementor' ),
				'default' => 'medium'
            ]
        );

        $this->add_control(
            'exad_accordion_image_align',
            [
                'label'         => esc_html__( 'Image Position', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::CHOOSE,
                'toggle'        => false,
                'options'       => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-angle-left'
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-angle-right'
                    ]
                ],
                'default'       => 'right'
            ]
        );

        $this->add_responsive_control(
            'exad_accordion_image_padding',
            [
				'label'      => __('Padding', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
                    'top'    => '20',
                    'right'  => '20',
                    'bottom' => '20',
                    'left'   => '20'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_accordion_image_margin',
            [
				'label'      => __('Margin', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
                    '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
		);
		
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'exad_accordion_image_css_filter',
				'selector' => '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-image img',
			]
		);

  		$this->end_controls_section();

		$this->start_controls_section(
            'exad_accordion_details_btn_style_section',
            [
				'label' => esc_html__( 'Button', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'exad_accordion_details_btn_typography',
				'selector' => '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-button a'
            ]
        );

        $this->add_responsive_control(
            'exad_accordion_details_btn_padding',
            [
				'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,           
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'    => '15',
					'right'  => '40',
					'bottom' => '15',
					'left'   => '40'
				],
                'selectors'  => [
                    '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_accordion_details_btn_margin',
            [
				'label'      => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],   
				'default'    => [
					'top'    => '30',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],              
                'selectors'  => [
                    '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'exad_accordion_details_button_style_tabs' );

            // normal state tab
            $this->start_controls_tab( 'exad_accordion_details_btn_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_accordion_details_btn_normal_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-button a' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_accordion_details_btn_normal_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#000000',
                    'selectors' => [
                        '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-button a' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
            	Group_Control_Border::get_type(),
                [
					'name'               => 'exad_accordion_details_btn_border',
					'fields_options'     => [
	                    'border' 	     => [
	                        'default'    => 'solid'
	                    ],
	                    'width'  	     => [
	                        'default'    => [
	                            'top'    => '1',
	                            'right'  => '1',
	                            'bottom' => '1',
	                            'left'   => '1'
	                        ]
	                    ],
	                    'color' 	     => [
	                        'default'    => '#000000'
	                    ]
	                ],
                    'selector'           => '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-button a'
                ]
            );

			$this->add_responsive_control(
				'exad_accordion_details_button_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors'  => [
						'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-button a'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'exad_accordion_details_button_shadow',
                    'selector'  => '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-button a'
                ]
            );

            $this->end_controls_tab();

            // hover state tab
            $this->start_controls_tab( 'exad_accordion_details_btn_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_accordion_details_btn_hover_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#000000',
                    'selectors' => [
                        '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-button a:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_accordion_details_btn_hover_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-button a:hover' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

			$this->add_group_control(
            	Group_Control_Border::get_type(),
                [
					'name'     => 'exad_accordion_details_btn_hover_border',
					'selector' => '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-button a:hover'
                ]
            );

			$this->add_responsive_control(
				'exad_accordion_details_button_border_radius_hover',
				[
					'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors'  => [
						'{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-button a:hover'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'exad_accordion_details_button_hover_shadow',
                    'selector'  => '{{WRAPPER}} .exad-accordion-items .exad-accordion-single-item .exad-accordion-button a:hover'
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();  		

	}

    private function render_image( $accordion, $settings ) {
        $image_id   = $accordion['exad_accordion_image']['id'];
        $image_size = $settings['exad_accordion_image_size_size'];
        if ( 'custom' === $image_size ) {
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'exad_accordion_image_size', $settings );
        } else {
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        }

        return sprintf( '<img src="%s" alt="'.Control_Media::get_image_alt( $accordion['exad_accordion_image'] ).'" />', esc_url($image_src) );
    }

	protected function render() {

        $settings   = $this->get_settings_for_display();
        
        $this->add_render_attribute( 'exad_accordion_heading', 'class', 'exad-accordion-heading' );
        $this->add_render_attribute( 'exad_accordion_details', 'class', 'exad-accordion-text' );
        $this->add_render_attribute( 'exad_accordion_button', 'class', 'exad-accordion-button' );

		?>
    
        <div class="exad-accordion-items">
        	<?php do_action('exad_accordion_wrapper_before');
            foreach( $settings['exad_exclusive_accordion_tab'] as $key => $accordion ) :
            	do_action('exad_accordion_each_item_wrapper_before');
                
                $accordion_item_setting_key = $this->get_repeater_setting_key('exad_exclusive_accordion_title', 'exad_exclusive_accordion_tab', $key);

                $accordion_class = ['exad-accordion-title'];

                if ( $accordion['exad_exclusive_accordion_default_active'] === 'yes' ) {
                    $accordion_class[] = 'active-default';
                } 

                $this->add_render_attribute( $accordion_item_setting_key, 'class', $accordion_class );

				$has_image = !empty( $accordion['exad_accordion_image']['url'] ) ? 'yes' : 'no';
				$link_key  = 'link_' . $key;

				?>

                <div class="exad-accordion-single-item elementor-repeater-item-<?php echo esc_attr($accordion['_id']); ?>">
                    <div <?php echo $this->get_render_attribute_string($accordion_item_setting_key); ?>>

						<?php if ( ! empty( $accordion['exad_exclusive_accordion_title_icon']['value'] ) && 'yes' === $accordion['exad_exclusive_accordion_icon_show'] ) : ?>
							<span class="exad-tab-title-icon">
								<?php Icons_Manager::render_icon( $accordion['exad_exclusive_accordion_title_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php endif; ?>

                        <<?php echo Utils::validate_html_tag( $settings['exad_accordion_title_html_tag'] ); ?>  <?php echo $this->get_render_attribute_string( 'exad_accordion_heading' ); ?>>
							<?php echo Helper::exad_wp_kses($accordion['exad_exclusive_accordion_title']); ?>
						</<?php echo Utils::validate_html_tag( $settings['exad_accordion_title_html_tag'] ); ?> >

                        <?php if( 'yes' === $settings['exad_exclusive_accordion_tab_title_show_active_inactive_icon']) : ?>
                            <div class="exad-active-inactive-icon">
                                <?php if( !empty( $settings['exad_exclusive_accordion_tab_title_active_icon']['value'])) { ?>
                                    <span class="exad-active-icon">
                                        <?php Icons_Manager::render_icon( $settings['exad_exclusive_accordion_tab_title_active_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </span>                            
                                <?php } ?>
                                <?php if( !empty( $settings['exad_exclusive_accordion_tab_title_inactive_icon']['value'] ) ) { ?>
                                    <span class="exad-inactive-icon">
                                        <?php Icons_Manager::render_icon( $settings['exad_exclusive_accordion_tab_title_inactive_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </span>
                                <?php } ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="exad-accordion-content">
                        <div class="exad-accordion-content-wrapper has-image-<?php echo esc_attr($has_image); ?> image-position-<?php echo esc_attr( $settings['exad_accordion_image_align'] ); ?>">
                            <div <?php echo $this->get_render_attribute_string( 'exad_accordion_details' ); ?>>
                                <div> <?php echo wp_kses_post( $accordion['exad_exclusive_accordion_content'] ); ?></div>
                                <?php if( 'yes' === $accordion['exad_accordion_show_read_more_btn'] ) : ?>
									<?php if( $accordion['exad_accordion_read_more_btn_url']['url'] ) { ?>
									    <?php $this->add_render_attribute( $link_key, 'href', esc_url( $accordion['exad_accordion_read_more_btn_url']['url'] ) ); ?>
									    <?php if( $accordion['exad_accordion_read_more_btn_url']['is_external'] ) { ?>
									        <?php $this->add_render_attribute( $link_key, 'target', '_blank' ); ?>
									    <?php } ?>
									    <?php if( $accordion['exad_accordion_read_more_btn_url']['nofollow'] ) { ?>
									        <?php $this->add_render_attribute( $link_key, 'rel', 'nofollow' ); ?>
									    <?php } ?>
									<?php } ?>
                                    <?php if ( ! empty( $accordion['exad_accordion_read_more_btn_text'] ) ) : ?>
                                        <div <?php echo $this->get_render_attribute_string( 'exad_accordion_button' ); ?>>
                                            <a <?php echo $this->get_render_attribute_string( $link_key ); ?>>
                                            	<?php echo esc_html( $accordion['exad_accordion_read_more_btn_text'] ); ?>
                                            </a>
                                        </div> 
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>

                            <?php if ( ! empty( $accordion['exad_accordion_image']['url'] ) ) { ?>
                                <div class="exad-accordion-image">
                                    <?php echo $this->render_image( $accordion, $settings ); ?>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <?php do_action('exad_accordion_each_item_wrapper_after'); ?>
            <?php endforeach; ?>
            <?php do_action('exad_accordion_wrapper_after'); ?>
        </div>
	<?php
    }
}