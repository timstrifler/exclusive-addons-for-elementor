<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exclusive_Accordion extends Widget_Base {

	public function get_name() {
		return 'exad-exclusive-accordion';
	}

	public function get_title() {
		return esc_html__( 'Exclusive Accordion', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'eicon-accordion';
	}

	public function get_script_depends() {
        return [
            'eael-scripts'
        ];
    }

   public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function _register_controls() {
		/**
  		 * Exclusive Accordion Settings
  		 */
  		$this->start_controls_section(
  			'eael_section_adv-accordion_settings',
  			[
  				'label' => esc_html__( 'General Settings', 'exclusive-addons-elementor' )
  			]
  		);
  		$this->add_control(
		  'exad_exclusive_accordion_type',
		  	[
		   	'label'       		=> esc_html__( 'Accordion Type', 'exclusive-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'accordion',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'accordion' 	=> esc_html__( 'Accordion', 'exclusive-addons-elementor' ),
		     		'toggle' 		=> esc_html__( 'Toggle', 'exclusive-addons-elementor' ),
		     	],
		  	]
		);
		$this->add_control(
			'exad_exclusive_accordion_icon_show',
			[
				'label' 		=> esc_html__( 'Enable Toggle Icon', 'exclusive-addons-elementor' ),
				'type'			=> Controls_Manager::SWITCHER,
				'default'		=> 'yes',
				'return_value'	=> 'yes',
			]
		);
		$this->add_control(
			'exad_exclusive_accordion_icon',
			[
				'label'		=> esc_html__( 'Toggle Icon', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::ICON,
				'default'	=> 'fa fa-angle-right',
				'include'	=> [
					'fa fa-angle-right',
					'fa fa-angle-double-right',
					'fa fa-chevron-right',
					'fa fa-chevron-circle-right',
					'fa fa-arrow-right',
					'fa fa-long-arrow-right',
				],
				'condition' => [
					'exad_exclusive_accordion_icon_show' => 'yes'
				]
			]
		);
		$this->add_control(
			'exad_exclusive_accordion_toggle_speed',
			[
				'label'			=> esc_html__( 'Toggle Speed (ms)', 'exclusive-addons-elementor' ),
				'type'			=> Controls_Manager::NUMBER,
				'label_block'	=> false,
				'default'		=> 300,
			]
		);
		$this->end_controls_section();
		
  		/**
  		 * Exclusive Accordion Content Settings
  		 */
  		$this->start_controls_section(
  			'eael_section_adv_accordion_content_settings',
  			[
  				'label' => esc_html__( 'Content Settings', 'exclusive-addons-elementor' )
  			]
  		);
  		$this->add_control(
			'exad_exclusive_accordion_tab',
			[
				'type'		=> Controls_Manager::REPEATER,
				'seperator'	=> 'before',
				'default'	=> [
					[ 'exad_exclusive_accordion_tab_title' => esc_html__( 'Accordion Tab Title 1', 'exclusive-addons-elementor' ) ],
					[ 'exad_exclusive_accordion_tab_title' => esc_html__( 'Accordion Tab Title 2', 'exclusive-addons-elementor' ) ],
					[ 'exad_exclusive_accordion_tab_title' => esc_html__( 'Accordion Tab Title 3', 'exclusive-addons-elementor' ) ],
				],
				'fields' => [
					[
						'name'		=> 'exad_exclusive_accordion_tab_default_active',
						'label'		=> esc_html__( 'Active as Default', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::SWITCHER,
						'default'	=> 'no',
						'return_value' => 'yes',
					],
					[
						'name'		=> 'exad_exclusive_accordion_tab_icon_show',
						'label'		=> esc_html__( 'Enable Tab Icon', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::SWITCHER,
						'default'	=> 'yes',
						'return_value' => 'yes',
					],
					[
						'name'		=> 'exad_exclusive_accordion_tab_title_icon',
						'label'		=> esc_html__( 'Icon', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::ICON,
						'default'	=> 'fa fa-plus',
						'condition' => [
							'exad_exclusive_accordion_tab_icon_show' => 'yes'
						]
					],
					[
						'name'		=> 'exad_exclusive_accordion_tab_title',
						'label'		=> esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::TEXT,
						'default'	=> esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
						'dynamic'	=> [ 'active' => true ]
					],
				  	[
						'name'		=> 'exad_exclusive_accordion_tab_content',
						'label'		=> esc_html__( 'Tab Content', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::TEXTAREA,
						'default'	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'exclusive-addons-elementor' ),
						'dynamic'	=> [ 'active' => true ],
					],
				],
				'title_field' => '{{exad_exclusive_accordion_tab_title}}',
			]
		);
  		$this->end_controls_section();
  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Accordion Generel Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'eael_section_adv_accordion_style_settings',
			[
				'label'	=> esc_html__( 'General Style', 'exclusive-addons-elementor' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_accordion_padding',
			[
				'label'	=> esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type'	=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'em', '%' ],
				'selectors'		=> [
	 					'{{WRAPPER}} .exad-exclusive-accordion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_accordion_margin',
			[
				'label'	=> esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type'	=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'em', '%' ],
				'selectors'		=> [
	 					'{{WRAPPER}} .exad-exclusive-accordion' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'		=> 'exad_exclusive_accordion_border',
				'label'		=> esc_html__( 'Border', 'exclusive-addons-elementor' ),
				'selector'	=> '{{WRAPPER}} .exad-exclusive-accordion',
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_accordion_border_radius',
			[
				'label'			=> esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'em', '%' ],
				'selectors'		=> [
	 					'{{WRAPPER}} .exad-exclusive-accordion' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'		=> 'exad_exclusive_accordion_box_shadow',
				'selector'	=> '{{WRAPPER}} .exad-exclusive-accordion',
			]
		);
  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Accordion Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'eael_section_adv_accordions_tab_style_settings',
			[
				'label'	=> esc_html__( 'Tab Style', 'exclusive-addons-elementor' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name'		=> 'exad_exclusive_accordion_tab_title_typography',
				'selector'	=> '{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header',
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_accordion_tab_icon_size',
			[
				'label'		=> __( 'Icon Size', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::SLIDER,
				'default'	=> [
					'size'	=> 16,
					'unit'	=> 'px',
				],
				'size_units'	=> [ 'px' ],
				'range'			=> [
					'px'		=> [
						'min'	=> 0,
						'max'	=> 100,
						'step'	=> 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header .fa' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_accordion_tab_icon_gap',
			[
				'label'		=> __( 'Icon Gap', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::SLIDER,
				'default'	=> [
					'size'	=> 10,
					'unit'	=> 'px',
				],
				'size_units'	=> [ 'px' ],
				'range'			=> [
					'px'	=> [
						'min'	=> 0,
						'max'	=> 100,
						'step'	=> 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header .fa' => 'margin-right: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_accordion_tab_padding',
			[
				'label'	=> esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type'	=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'em', '%' ],
				'selectors'		=> [
	 					'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_accordion_tab_margin',
			[
				'label'	=> esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type'	=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'em', '%' ],
				'selectors'		=> [
	 					'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->start_controls_tabs( 'exad_exclusive_accordion_header_tabs' );
			# Normal State Tab
			$this->start_controls_tab( 'exad_exclusive_accordion_header_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );
				$this->add_control(
					'exad_exclusive_accordion_tab_color',
					[
						'label'	=> esc_html__( 'Tab Background Color', 'exclusive-addons-elementor' ),
						'type'	=> Controls_Manager::COLOR,
						'default'	=> '#f1f1f1',
						'selectors' => [
							'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_exclusive_accordion_tab_text_color',
					[
						'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '#333',
						'selectors'	=> [
							'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_exclusive_accordion_tab_icon_color',
					[
						'label'		=> esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '#333',
						'selectors'	=> [
							'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header .fa' => 'color: {{VALUE}};',
						],
						'condition' => [
							'eael_adv_tabs_icon_show' => 'yes'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'		=> 'exad_exclusive_accordion_tab_border',
						'label'		=> esc_html__( 'Border', 'exclusive-addons-elementor' ),
						'selector'	=> '{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header',
					]
				);
				$this->add_responsive_control(
					'exad_exclusive_accordion_tab_border_radius',
					[
						'label'			=> esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
						'type'			=> Controls_Manager::DIMENSIONS,
						'size_units'	=> [ 'px', 'em', '%' ],
						'selectors'		=> [
			 					'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			 			],
					]
				);
			$this->end_controls_tab();

			# Hover State Tab
			$this->start_controls_tab(
				'exad_exclusive_accordion_header_hover',
				[
					'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' )
				]
			);

				$this->add_control(
					'exad_exclusive_accordion_tab_color_hover',
					[
						'label'		=> esc_html__( 'Tab Background Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '#414141',
						'selectors'	=> [
							'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header:hover' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_exclusive_accordion_tab_text_color_hover',
					[
						'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '#fff',
						'selectors'	=> [
							'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header:hover' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_exclusive_accordion_tab_icon_color_hover',
					[
						'label'		=> esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '#fff',
						'selectors'	=> [
							'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header:hover .fa' => 'color: {{VALUE}};',
						],
						'condition' => [
							'exad_exclusive_accordion_toggle_icon_show' => 'yes'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'		=> 'exad_exclusive_accordion_tab_border_hover',
						'label'		=> esc_html__( 'Border', 'exclusive-addons-elementor' ),
						'selector'	=> '{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header:hover',
					]
				);
				$this->add_responsive_control(
					'exad_exclusive_accordion_tab_border_radius_hover',
					[
						'label'			=> esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
						'type'			=> Controls_Manager::DIMENSIONS,
						'size_units'	=> [ 'px', 'em', '%' ],
						'selectors'		=> [
			 					'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			 			],
					]
				);
			$this->end_controls_tab();

			#Active State Tab
			$this->start_controls_tab(
				'exad_exclusive_accordion_header_active',
				[
					'label' => esc_html__( 'Active', 'exclusive-addons-elementor' )
				]
			);

				$this->add_control(
					'exad_exclusive_accordion_tab_color_active',
					[
						'label'		=> esc_html__( 'Tab Background Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '#444',
						'selectors' => [
							'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header.active' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_exclusive_accordion_tab_text_color_active',
					[
						'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '#fff',
						'selectors'	=> [
							'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header.active' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_exclusive_accordion_tab_icon_color_active',
					[
						'label'		=> esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '#fff',
						'selectors'	=> [
							'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header.active .fa' => 'color: {{VALUE}};',
						],
						'condition'	=> [
							'exad_exclusive_accordion_toggle_icon_show' => 'yes'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'		=> 'exad_exclusive_accordion_tab_border_active',
						'label'		=> esc_html__( 'Border', 'exclusive-addons-elementor' ),
						'selector'	=> '{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header.active',
					]
				);
				$this->add_responsive_control(
					'exad_exclusive_accordion_tab_border_radius_active',
					[
						'label'			=> esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
						'type'			=> Controls_Manager::DIMENSIONS,
						'size_units'	=> [ 'px', 'em', '%' ],
						'selectors'		=> [
			 					'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			 			],
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
			'eael_section_adv_accordion_tab_content_style_settings',
			[
				'label'	=> esc_html__( 'Content Style', 'exclusive-addons-elementor' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'adv_accordion_content_bg_color',
			[
				'label'		=> esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-content' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'adv_accordion_content_text_color',
			[
				'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '#333',
				'selectors' => [
					'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-content' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name'		=> 'exad_exclusive_accordion_content_typography',
				'selector'	=> '{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-content',
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_accordion_content_padding',
			[
				'label'			=> esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'em', '%' ],
				'selectors'		=> [
	 					'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_responsive_control(
			'exad_exclusive_accordion_content_margin',
			[
				'label'			=> esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'em', '%' ],
				'selectors'		=> [
	 					'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'		=> 'exad_exclusive_accordion_content_border',
				'label'		=> esc_html__( 'Border', 'exclusive-addons-elementor' ),
				'selector'	=> '{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-content',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'		=> 'exad_exclusive_accordion_content_shadow',
				'selector'	=> '{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-content',
				'separator'	=> 'before'
			]
		);
  		$this->end_controls_section();

  		/**
  		 * Exclusive Accordion Caret Settings
  		 */
  		$this->start_controls_section(
  			'eael_section_adv_accordion_caret_settings',
  			[
  				'label'	=> esc_html__( 'Toggle Caret Style', 'exclusive-addons-elementor' ),
  				'tab'	=> Controls_Manager::TAB_STYLE,
  			]
  		);

		$this->add_responsive_control(
			'exad_exclusive_accordion_tab_toggle_icon_size',
			[
				'label'	=> __( 'Icon Size', 'exclusive-addons-elementor' ),
				'type'	=> Controls_Manager::SLIDER,
				'default'	=> [
					'size'	=> 16,
					'unit'	=> 'px',
				],
				'size_units'	=> [ 'px' ],
				'range'	=> [
					'px'	=> [
						'min'	=> 0,
						'max'	=> 100,
						'step'	=> 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header .fa-toggle' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_exclusive_accordion_icon_show' => 'yes'
				]
			]
		);
		$this->add_control(
			'eael_adv_tabs_tab_toggle_color',
			[
				'label'		=> esc_html__( 'Caret Color', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '#444',
				'selectors'	=> [
					'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header .fa-toggle' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'exad_exclusive_accordion_icon_show' => 'yes'
				]
			]
		);
		$this->add_control(
			'eael_adv_tabs_tab_toggle_active_color',
			[
				'label'		=> esc_html__( 'Caret Color (Active)', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '#fff',
				'selectors'	=> [
					'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header.active .fa-toggle' => 'color: {{VALUE}};',
					'{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list:hover .eael-accordion-header .fa-toggle' => 'color: {{VALUE}};',
				],
				'condition' => [
					'exad_exclusive_accordion_icon_show' => 'yes'
				]
			]
		);
  		$this->end_controls_section();
	}

	protected function render() {

		$settings	= $this->get_settings_for_display();
		$id_int		= substr( $this->get_id_int(), 0, 3 );
		
		$this->add_render_attribute( 'exad-exclusive-accordion', 'class', 'exad-exclusive-accordion' );
		$this->add_render_attribute( 'exad-exclusive-accordion', 'id', 'exad-exclusive-accordion-'.esc_attr( $this->get_id() ));
	?>
	
		<div class="exad-accordion six">
			<?php 
				foreach( $settings['exad_exclusive_accordion_tab'] as $key => $accordion ) : 
					
					$accordion_item_setting_key = $this->get_repeater_setting_key('exad_exclusive_accordion_tab_title', 'exad_exclusive_accordion_tab', $key);

					$accordion_class = ['exad-accordion-title'];

					if ( $accordion['exad_exclusive_accordion_tab_default_active'] == 'yes' ) {
						$accordion_class[] = 'active-default';
					}

					$this->add_render_attribute( $accordion_item_setting_key, [
						'class'		=> $accordion_class,
						
					]);

				?>
				<div class="exad-accordion-six">
					<div <?php echo $this->get_render_attribute_string($accordion_item_setting_key); ?>>
						<?php if ( isset( $accordion['exad_exclusive_accordion_icon_show'] ) && $accordion['exad_exclusive_accordion_icon_show'] == 'yes' ) : ?>
							<span><i class="<?php echo esc_attr( $accordion['exad_exclusive_accordion_icon'] ); ?>"></i></span>
						<?php endif; ?>
						<h3><?php echo $accordion['exad_exclusive_accordion_tab_title']; ?></h3>
					</div>
					<div class="exad-accordion-content">
						<div class="exad-accordion-content-wrapper">
							<p><?php echo $accordion['exad_exclusive_accordion_tab_content']; ?></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
    	</div>
	
	<?php
	}

	protected function _content_template() {  }
}


Plugin::instance()->widgets_manager->register_widget_type( new Exclusive_Accordion() );