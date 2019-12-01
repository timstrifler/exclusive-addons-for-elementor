<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Widget_Base;

class Pricing_Table extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-pricing-table';
	}

	public function get_title() {
		return esc_html__( 'Pricing Table', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-price-table';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
        return [ 'price', 'package', 'product', 'plan' ];
    }

	protected function _register_controls() {

  		/**
  		 * Pricing Table Settings
  		 */
  		$this->start_controls_section(
  			'exad_section_pricing_table_settings',
  			[
  				'label' => esc_html__( 'Header', 'exclusive-addons-elementor' )
  			]
  		);

  		$this->add_control(
			'exad_pricing_table_title',
			[
				'label'       => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'STANDARD', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_pricing_table_subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false
			]
		);

		$this->add_control(
			'exad_pricing_table_featured',
			[
				'label'        => esc_html__( 'Featured?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'exad_pricing_table_featured_type',
			[
				'label'   => esc_html__( 'Badge Type', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'text-badge' => __( 'Text Badge', 'exclusive-addons-elementor' ),
					'icon-badge' => __( 'Icon Badge', 'exclusive-addons-elementor' )
				],
				'default' => 'text-badge',
				'condition' => [
					'exad_pricing_table_featured' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_featured_tag_text',
			[
				'label'       => esc_html__( 'Featured Text', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'FEATURED', 'exclusive-addons-elementor' ),
				'condition'   => [
					'exad_pricing_table_featured'      => 'yes',
					'exad_pricing_table_featured_type' => 'text-badge'
				]
			]
		);

  		$this->end_controls_section();

  		$this->start_controls_section(
  			'exad_section_pricing_table_price',
  			[
  				'label' => esc_html__( 'Price', 'exclusive-addons-elementor' )
  			]
		);

		$this->add_control(
			'exad_pricing_table_price',
			[
				'label'       => esc_html__( 'Price', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '50', 'exclusive-addons-elementor' )
			]
		);
		
  		$this->add_control(
			'exad_pricing_table_price_cur',
			[
				'label'       => esc_html__( 'Price Currency', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '$', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_pricing_table_price_cur_position',
			[
				'label'       => esc_html__( 'Currency Position', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'	  => false,
				'label_block' => false,
				'default'     => 'exad-pricing-cur-left',
				'options'     => [
					'exad-pricing-cur-left' => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-angle-left'
					],
					'exad-pricing-cur-right' => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-angle-right'
					]
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_price_by',
			[
				'label'       => esc_html__( 'Price By', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'mo', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_pricing_table_period_separator',
			[
				'label'       => esc_html__( 'Separated By', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '/', 'exclusive-addons-elementor' )
			]
		);

  		$this->end_controls_section();

  		/**
  		 * Pricing Table Feature
  		 */
  		$this->start_controls_section(
  			'exad_section_pricing_table_feature',
  			[
  				'label' => esc_html__( 'Features', 'exclusive-addons-elementor' )
  			]
  		);

  		$this->add_control(
			'exad_pricing_table_items',
			[
				'type'      => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default'   => [
					[ 'exad_pricing_table_item' => 'Responsive Live' ],
					[ 'exad_pricing_table_item' => 'Adaptive Bitrate' ],
					[ 'exad_pricing_table_item' => 'Analytics' ],
					[ 	
						'exad_pricing_table_item'      => 'Creative Layouts',
						'exad_pricing_table_icon_mood' => 'no'
					],
					[ 
						'exad_pricing_table_item'      => 'Free Support',
						'exad_pricing_table_icon_mood' => 'no'
					]
				],
				'fields'    => [
					[
						'name'        => 'exad_pricing_table_item',
						'label'       => esc_html__( 'List Item', 'exclusive-addons-elementor' ),
						'type'        => Controls_Manager::TEXT,
						'label_block' => true,
						'default'     => esc_html__( 'Pricing table list item', 'exclusive-addons-elementor' )
					],
					[
						'name'        => 'exad_pricing_table_list_icon',
						'label'       => esc_html__( 'List Icon', 'exclusive-addons-elementor' ),
						'type'        => Controls_Manager::ICONS,
						'default'     => [
							'value'   => 'fas fa-check',
							'library' => 'fa-solid'
						]
					],
					[
						'name'         => 'exad_pricing_table_icon_mood',
						'label'        => esc_html__( 'Item Active?', 'exclusive-addons-elementor' ),
						'type'         => Controls_Manager::SWITCHER,
						'return_value' => 'yes',
						'default'      => 'yes'
					]
				],	
				'title_field' => '{{exad_pricing_table_item}}'
			]	
		);

  		$this->end_controls_section();

  		/**
  		 * Pricing Table Footer
  		 */
  		$this->start_controls_section(
  			'exad_section_pricing_table_button',
  			[
  				'label' => esc_html__( 'Button', 'exclusive-addons-elementor' )
  			]
		);
		  

		$this->add_control(
			'exad_pricing_table_btn_position',
			[
				'label'   => esc_html__( 'Position', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'middle' => __( 'Middle', 'exclusive-addons-elementor' ),
					'bottom' => __( 'Bottom', 'exclusive-addons-elementor' )
				],
				'default' => 'bottom'
			]
		);

		$this->add_control(
			'exad_pricing_table_btn',
			[
				'label'       => esc_html__( 'Text', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Choose Plan', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_pricing_table_btn_link',
			[
				'label'       => esc_html__( 'Link', 'exclusive-addons-elementor' ),
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

  	
		/**
		 * -------------------------------------------
		 * Tab Style (Pricing Table Style)
		 * -------------------------------------------
		 */

		$this->start_controls_section(
			'exad_section_pricing_tables_styles_presets',
			[
				'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
				
		$this->add_control(
			'exad_pricing_table_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'seperator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-wrapper' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .exad-pricing-table-header .exad-pricing-table-header-curved svg path' => 'fill: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_content_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '45',
					'right'    => '30',
					'bottom'   => '45',
					'left'     => '30',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-badge-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'exad_pricing_table_content_border',
				'label'    => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper'
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_content_border_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
                    'top'      => '10',
                    'right'    => '10',
                    'bottom'   => '10',
                    'left'     => '10',
                    'unit'     => 'px'
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .exad-pricing-table-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .exad-pricing-table-header .exad-pricing-table-header-svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_pricing_table_content_box_shadow',
				'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper',
				'fields_options'      => [
		            'box_shadow_type' => [
		                'default'     =>'yes'
		            ],
		            'box_shadow'  => [
		                'default' => [
		                    'horizontal' => 0,
		                    'vertical'   => 13,
		                    'blur'       => 33,
		                    'spread'     => 0,
		                    'color'      => 'rgba(51,77,128,0.08)'
		                ]
		            ]
	            ]
			]
		);

		$this->add_control(
			'exad_pricing_table_content_alignment',
			[
				'label'     => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
				'separator' => 'after',
				'options'   => [
					'left'      => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default' => 'left'
			]
		);

		/**
		 * -------------------------------------------
		 * Style (Hover)
		 * -------------------------------------------
		 */

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_pricing_table_transition_shadow',
				'label'    => __( 'Hover Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper:hover',
				'fields_options'      => [
		            'box_shadow_type' => [
		                'default'     =>'yes'
		            ],
		            'box_shadow'  => [
		                'default' => [
		                    'horizontal' => 0,
		                    'vertical'   => 20,
		                    'blur'       => 40,
		                    'spread'     => 0,
		                    'color'      => 'rgba(51,77,128,0.2)'
		                ]
		            ]
	            ]
			]
		);

		$this->add_control(
			'exad_pricing_table_transition_type',
			[
				'label'   => __( 'Hover Style', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'none'              =>  __( 'None', 'exclusive-addons-elementor' ),
					'transition_top'    =>  __( 'Transition Top', 'exclusive-addons-elementor' ),
					'transition_bottom' => __( 'Transition Bottom', 'exclusive-addons-elementor' ),
					'transition_zoom'   => __( 'Transition Zoom', 'exclusive-addons-elementor' )
				],
				'default' => 'none'
			]
		);

		
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Header)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_pricing_table_title_header_settings',
			[
				'label' => esc_html__( 'Header', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_pricing_table_header_type',
			[
				'label'   => esc_html__( 'Header Type', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'simple',
				'options' => [
					'simple'        => __( 'Simple', 'exclusive-addons-elementor' ),
					'curved-header' => __( 'Curved Header', 'exclusive-addons-elementor' )
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'exad_pricing_table_header_background',
				'label'     => __( 'Background', 'exclusive-addons-elementor' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .exad-pricing-table-header',
				'condition' => [
					'exad_pricing_table_header_type' => 'curved-header'
				]
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_header_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_header_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Title)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_pricing_table_title_style_settings',
			[
				'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_pricing_table_title_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-title' => 'color: {{VALUE}};'
				]
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_pricing_table_title_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-table-title',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 15
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '400'
		            ]
	            ]
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_title_margin',
			[
				'label'   => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::DIMENSIONS,
				'default' => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Sub Title)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_pricing_table_subheader_style_settings',
			[
				'label' => esc_html__( 'Sub Title', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_pricing_table_subtitle_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-subtitle' => 'color: {{VALUE}};'
				]
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_pricing_table_subtitle_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-table-subtitle'
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_subtitle_margin',
			[
				'label'   => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::DIMENSIONS,
				'default' => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '10',
					'left'     => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Pricing)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_pricing_table_price_style_settings',
			[
				'label' => esc_html__( 'Pricing', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_pricing_table_price_box_separator',
			[
				'label'        => esc_html__( 'Enable Separator', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'OFF', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_price_box_separator_height',
			[
				'label'     => esc_html__( 'Separator Height', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '1',
				'selectors' => [
					'{{WRAPPER}} .exad-price-bottom-separator' => 'height: {{VALUE}}px;'
				],
				'condition' => [
					'exad_pricing_table_price_box_separator' => 'yes'
				]
				
			]
		);

		$this->add_control(
			'exad_pricing_table_price_box_separator_color',
			[
				'label'     => esc_html__( 'Separator Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e5e5e5',
				'selectors' => [
					'{{WRAPPER}} .exad-price-bottom-separator'  => 'background-color: {{VALUE}};'
				],
				'condition' => [
					'exad_pricing_table_price_box_separator' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_price_box_separator_spacing',
			[
				'label'       => esc_html__( 'Separator Spacing', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 30
				],
				'range'       => [
					'px'      => [
						'max' => 50
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-price-bottom-separator' => 'margin: {{SIZE}}px 0;'
				],
				'condition' => [
					'exad_pricing_table_price_box_separator' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_price_box',
			[
				'label'        => esc_html__( 'Price Box', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'OFF', 'exclusive-addons-elementor' ),
				'separator'	   => 'before',
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_price_box_height',
			[
				'label'     => __( 'Box Height', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .price-box' => 'height: {{VALUE}}px'
				],
				'condition' => [
					'exad_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_price_box_width',
			[
				'label'     => __( 'Box Width', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .price-box' => 'width: {{VALUE}}px'
				],
				'condition' => [
					'exad_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'exad_pricing_table_price_box_background',
				'label'     => __( 'Background', 'exclusive-addons-elementor' ),
				'types'     => [ 'classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .price-box',
				'condition' => [
					'exad_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'exad_pricing_table_price_box_border',
				'label'     => __( 'Border', 'exclusive-addons-elementor' ),
				'selector'  => '{{WRAPPER}} .price-box',
				'condition' => [
					'exad_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_price_box_radius',
			[
				'label'      => __( 'Box Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '50',
					'right'  => '50',
					'bottom' => '50',
					'left'   => '50',
					'unit'   => '%'
				],
				'selectors'  => [
					'{{WRAPPER}} .price-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'exad_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_price_tag_heading',
			[
				'label'     => esc_html__( 'Original Price', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'exad_pricing_table_pricing_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-price p'  => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_pricing_table_price_tag_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-price p',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 48
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ],
		              'letter_spacing'   => [
		                'default'        => [
		                    'unit'       => 'px',
		                    'size'       => -3.2
		                ]
		            ]
	            ]
			]
		);

		$this->add_control(
			'exad_pricing_table_pricing_period_heading',
			[
				'label'     => esc_html__( 'Pricing By', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'exad_pricing_table_pricing_period_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-price span.exad-price-period' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_pricing_table_price_preiod_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-price-period',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 20
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ],
		              'letter_spacing'   => [
		                'default'        => [
		                    'unit'       => 'px',
		                    'size'       => 0
		                ]
		            ]
	            ]
			]
		);

		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Style (Feature List)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_pricing_table_style_featured_list_settings',
			[
				'label' => esc_html__( 'Feature List', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_pricing_table_list_item_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-table-features li'
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_featured_list_icon_size',
			[
				'label'       => esc_html__( 'Icon Size', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 12
				],
				'range'       => [
					'px'      => [
						'max' => 24
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-pricing-li-icon' => 'font-size: {{SIZE}}px;'
				]
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_featured_list_icon_space',
			[
				'label'       => esc_html__( 'Icon Space', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 7
				],
				'range'       => [
					'px'      => [
						'max' => 24
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-pricing-table-features li .exad-pricing-li-icon' => 'margin-right: {{SIZE}}px;'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_list_item_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#00d8d8',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-features li span.exad-pricing-li-icon' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_list_item_color',
			[
				'label'     => esc_html__( 'Item Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-features li' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_list_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '10',
					'right'    => '0',
					'bottom'   => '10',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-features li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_list_border_bottom',
			[
				'label'        => __( 'List Border Bottom', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'exad_pricing_table_list_border_bottom_style',
			[
				'label'     => __( 'List Border Bottom Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'defailt'   => '#e5e5e5',
				'selectors' => [
					'{{WRAPPER}} .list-border-bottom li:not(:last-child)' => 'border-bottom:1px solid {{VALUE}};'
				],
				'condition' => [
					'exad_pricing_table_list_border_bottom' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_list_disable_item_styling',
			[
				'label'     => esc_html__( 'Disable Items', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'exad_pricing_table_list_disable_item_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#a6a9ad',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-features li.exad-pricing-table-features-disable span.exad-pricing-li-icon' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_list_disable_item_color',
			[
				'label'     => esc_html__( 'Item color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#a6a9ad',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-features li.exad-pricing-table-features-disable' => 'color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Pricing Table Featured Tag Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_pricing_table_featured_tag_settings',
			[
				'label'     => esc_html__( 'Featured Badge', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_pricing_table_featured' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_featured_tag_font_size',
			[
				'label'       => esc_html__( 'Font Size', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 12
				],
				'range'       => [
					'px'      => [
						'max' => 40
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .text-badge'   => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .icon-badge i' => 'font-size: {{SIZE}}px;'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_featured_tag_text_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .text-badge'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-badge i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'exad_pricing_table_featured_text_badge_background',
				'label'     => __( 'Background', 'exclusive-addons-elementor' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .text-badge',
				'condition' => [
					'exad_pricing_table_featured_type' => 'text-badge'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'exad_pricing_table_featured_icon_badge_background',
				'label'     => __( 'Background', 'exclusive-addons-elementor' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .icon-badge',
				'condition' => [
					'exad_pricing_table_featured_type' => 'icon-badge'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Button Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_pricing_table_btn_style_settings',
			[
				'label' => esc_html__( 'Button', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_pricing_table_btn_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action'
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_button_border_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '4',
					'right'  => '4',
					'bottom' => '4',
					'left'   => '4'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_button_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '12',
					'right'    => '30',
					'bottom'   => '12',
					'left'     => '30',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_button_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '30',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'exad_pricing_table_button_tabs' );

			// Normal State Tab
			$this->start_controls_tab( 'exad_pricing_table_btn_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_pricing_table_btn_normal_text_color',
				[
					'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'exad_pricing_table_btn_normal_bg_color',
				[
					'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#00d8d8',
					'selectors' => [
						'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'            => 'exad_pricing_table_btn_normal_border',
					'label'           => __( 'Border', 'exclusive-addons-elementor' ),
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
	                        'default' => '#00d8d8'
	                    ]
	                ],
					'selector'        => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action'
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'exad_pricing_table_btn_box_shadow',
					'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
					'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action'
				]
			);

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'exad_pricing_table_btn_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_pricing_table_btn_hover_text_color',
				[
					'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#00d8d8',
					'selectors' => [
						'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action:hover' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'exad_pricing_table_btn_hover_bg_color',
				[
					'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action:hover' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'            => 'exad_pricing_table_btn_hover_border',
					'label'           => __( 'Border', 'exclusive-addons-elementor' ),
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
	                        'default' => '#00d8d8'
	                    ]
	                ],
					'selector'        => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action:hover'
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'exad_pricing_table_btn_box_shadow_hover',
					'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
					'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action:hover'
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'exad_pricing_table_box_value',[
			'class' => ['exad-pricing-table-price'],
		]);

		if( $settings['exad_pricing_table_price_box'] === 'yes' ){
			$this->add_render_attribute( 'exad_pricing_table_box_value', 'class', 'price-box' );
		}

		$this->add_render_attribute( 'exad_pricing_table_features',[
			'class' => ['exad-pricing-table-features'],
		]);

		if( $settings['exad_pricing_table_list_border_bottom'] === 'yes' ){
			$this->add_render_attribute( 'exad_pricing_table_features', 'class', 'list-border-bottom' );
		}

		$this->add_render_attribute( 'exad-pricing-table-anchor-params', 'class', 'exad-pricing-table-action' );
		if( $settings['exad_pricing_table_btn_link']['url'] ) {
            $this->add_render_attribute( 'exad-pricing-table-anchor-params', 'href', esc_url( $settings['exad_pricing_table_btn_link']['url'] ) );
        }
        if( $settings['exad_pricing_table_btn_link']['is_external'] ) {
            $this->add_render_attribute( 'exad-pricing-table-anchor-params', 'target', '_blank' );
        }
        if( $settings['exad_pricing_table_btn_link']['nofollow'] ) {
            $this->add_render_attribute( 'exad-pricing-table-anchor-params', 'rel', 'nofollow' );
        }
	
	?>
		<div class="exad-pricing-table-wrapper exad-pricing-table <?php echo esc_attr( $settings['exad_pricing_table_content_alignment'] ); ?> <?php echo esc_attr($settings['exad_pricing_table_transition_type']); ?>">
			<div class="exad-pricing-table-badge-wrapper">

				<?php if ( 'yes' == $settings['exad_pricing_table_featured'] ) { ?>
					<span class="exad-pricing-table-badge <?php echo esc_attr($settings['exad_pricing_table_featured_type']); ?>">
						<?php if( 'text-badge' == $settings['exad_pricing_table_featured_type'] ) { ?>
							<?php echo esc_html( $settings['exad_pricing_table_featured_tag_text'] ); ?>
						<?php } ?>
						<?php if( 'icon-badge' == $settings['exad_pricing_table_featured_type'] ) { ?>
							<i class="demo-icon eicon-star"></i>
						<?php } ?>
					</span>
				<?php } ?>

				<div class="exad-pricing-table-header">

					<?php do_action( 'exad_pricing_table_header_wrapper_before' ); ?>
					<h4 class="exad-pricing-table-title"><?php echo esc_html( $settings['exad_pricing_table_title'] ); ?></h4>
					<?php if ( !empty( $settings['exad_pricing_table_subtitle'] ) ) : ?>
	                    <p class="exad-pricing-table-subtitle"><?php echo esc_html( $settings['exad_pricing_table_subtitle'] ); ?></p>
	                <?php endif; ?>

					<div <?php echo $this->get_render_attribute_string( 'exad_pricing_table_box_value' ); ?> >
						<p>
							<?php
								if( 'exad-pricing-cur-left' == $settings['exad_pricing_table_price_cur_position'] ) :
									echo esc_html( $settings['exad_pricing_table_price_cur' ] );
								endif;

								echo esc_html( $settings['exad_pricing_table_price'] );

								if( 'exad-pricing-cur-right' == $settings['exad_pricing_table_price_cur_position'] ) :
									echo esc_html( $settings['exad_pricing_table_price_cur'] );
								endif;
							?>
							<span class="exad-price-period">
								<?php echo esc_html( $settings['exad_pricing_table_period_separator'] ); ?>
								<?php echo esc_html( $settings['exad_pricing_table_price_by'] ); ?>
							</span>
						</p>
					</div>

					<?php
						if ( 'yes' == $settings['exad_pricing_table_price_box_separator'] ) :
							echo '<div class="exad-price-bottom-separator"></div>';
						endif;
					?>

					<?php if( 'curved-header' === $settings['exad_pricing_table_header_type'] ) { ?>
						<div class="exad-pricing-table-header-curved">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 370 20">
								<path class="st0" d="M0 20h185C70 20 0 0 0 0v20zM185 20h185V0s-70 20-185 20z" />
							</svg>
						</div>
					<?php } ?>

					<?php do_action( 'exad_pricing_table_header_wrapper_after' ); ?>

				</div>

				<?php 
					if( 'middle' === $settings['exad_pricing_table_btn_position'] ) {
						echo '<a '.$this->get_render_attribute_string( 'exad-pricing-table-anchor-params' ).'>';
							echo esc_html( $settings['exad_pricing_table_btn'] );
						echo '</a>';
					} 

					do_action( 'exad_pricing_table_content_wrapper_before' );

					echo '<ul '.$this->get_render_attribute_string( 'exad_pricing_table_features' ).'>';
						foreach( $settings['exad_pricing_table_items'] as $item ) : 
							$icon_mod = 'yes' !== $item['exad_pricing_table_icon_mood'] ? 'exad-pricing-table-features-disable' : '';

							echo '<li class="'.esc_attr( $icon_mod ).'">';
								if ( !empty( $item['exad_pricing_table_list_icon']['value'] ) ) {
									echo '<span class="exad-pricing-li-icon">';
										Icons_Manager::render_icon( $item['exad_pricing_table_list_icon'] );
									echo '</span>									';
								}
								echo esc_html( $item['exad_pricing_table_item'] );
							echo '</li>';
						endforeach;
					echo '</ul>';

					do_action( 'exad_pricing_table_content_wrapper_after' );

					if( 'bottom' === $settings['exad_pricing_table_btn_position'] ) {
						echo '<a '.$this->get_render_attribute_string( 'exad-pricing-table-anchor-params' ).'>';
							echo esc_html( $settings['exad_pricing_table_btn'] );
						echo '</a>';
					} 
				?>
			</div>
		</div>
	<?php
	}
}