<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Pricing_Table extends Widget_Base {
	
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


		/**
		 * Condition: 'exad_pricing_table_style' => [ 'style-3', 'style-4' ], 'exad_pricing_table_featured' => 'yes'
		 */

  		$this->add_control(
			'exad_pricing_table_title',
			[
				'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( 'Standard', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_pricing_table_subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( 'Best for Small individual', 'exclusive-addons-elementor' )
			]
		);

		/**
		 * Condition: 'exad_pricing_table_style' => 'style-2'
		 */
		$this->add_control(
			'exad_pricing_table_style_2_icon',
			[
				'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-home',
			]
		);

		$this->add_control(
			'exad_pricing_table_featured',
			[
				'label' => esc_html__( 'Featured?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'exad_pricing_table_featured_type',
			[
				'label' => esc_html__( 'Featured Type', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'text-badge' => __( 'Text Badge', 'exclusive-addons-elementor' ),
					'icon-badge' => __( 'Icon Badge', 'exclusive-addons-elementor' ),
				],
				'default' => 'text-badge',
				'condition' => [
					'exad_pricing_table_featured' => 'yes',
				],
			]
		);

		$this->add_control(
			'exad_pricing_table_featured_tag_text',
			[
				'label' => esc_html__( 'Featured Text', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( 'Featured', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_pricing_table_featured_type' => 'text-badge'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_header_type',
			[
				'label' => esc_html__( 'Header Type', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __( 'None', 'exclusive-addons-elementor' ),
					'curved-header' => __( 'Curved Header', 'exclusive-addons-elementor' ),
					'svg-header' => __( 'SVG Header', 'exclusive-addons-elementor' ),
				],
			]
		);

  		$this->end_controls_section();


  		/**
  		 * Pricing Table Price
  		 */
  		$this->start_controls_section(
  			'exad_section_pricing_table_price',
  			[
  				'label' => esc_html__( 'Price', 'exclusive-addons-elementor' )
  			]
		);
		  
		$this->add_control(
			'exad_pricing_table_price_box',
			[
				'label' => esc_html__( 'Price Box', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off' => __( 'OFF', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'exad_pricing_table_price',
			[
				'label' => esc_html__( 'Price', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '50', 'exclusive-addons-elementor' )
			]
		);
		
  		$this->add_control(
			'exad_pricing_table_price_cur',
			[
				'label' => esc_html__( 'Price Currency', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '$', 'exclusive-addons-elementor' ),
			]
		);


		$this->add_control(
			'exad_pricing_table_price_by',
			[
				'label' => esc_html__( 'Price By', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( 'month', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_pricing_table_period_separator',
			[
				'label' => esc_html__( 'Separated By', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '/', 'exclusive-addons-elementor' )
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
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'exad_pricing_table_item' => 'Responsive Live' ],
					[ 'exad_pricing_table_item' => 'Adaptive Bitrate' ],
					[ 'exad_pricing_table_item' => 'Analytics' ],
					[ 'exad_pricing_table_item' => 'Creative Layouts' ],
					[ 'exad_pricing_table_item' => 'Free Support' ]
				],
				'fields' => [
					[
						'name' => 'exad_pricing_table_item',
						'label' => esc_html__( 'List Item', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( 'Pricing table list item', 'exclusive-addons-elementor' )
					],
					[
						'name' => 'exad_pricing_table_list_icon',
						'label' => esc_html__( 'List Icon', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::ICON,
						'label_block' => false,
						'default' => 'fa fa-check',
					],
					[
						'name'			=> 'exad_pricing_table_icon_mood',
						'label'			=> esc_html__( 'Item Active?', 'exclusive-addons-elementor' ),
						'type'			=> Controls_Manager::SWITCHER,
						'return_value'	=> 'yes',
						'default'		=> 'yes'
					],
				],	
				'title_field' => '{{exad_pricing_table_item}}',
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
				'label' => esc_html__( 'Button Middle or Bottom', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'middle' => __( 'Middle', 'exclusive-addons-elementor' ),
					'bottom' => __( 'Bottom', 'exclusive-addons-elementor' ),
				],
				'default' => 'bottom',
			]
		);

		$this->add_control(
			'exad_pricing_table_btn',
			[
				'label' => esc_html__( 'Button Text', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Choose Plan', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_pricing_table_btn_link',
			[
				'label' => esc_html__( 'Button Link', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
        			'url' => '#',
        			'is_external' => '',
     			],
     			'show_external' => true,
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
				'label' => esc_html__( 'General Styles', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
				
		$this->add_control(
			'exad_pricing_table_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'seperator' => 'before',
				'type' => Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-wrapper' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .exad-pricing-table-header .exad-pricing-table-header-curved svg path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'exad_pricing_table_content_padding',
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
					'{{WRAPPER}} .exad-pricing-table-badge-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_pricing_table_content_border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper',
			]
		);

		$this->add_control(
			'exad_pricing_table_content_border_radius',
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
					'{{WRAPPER}} .exad-pricing-table-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .exad-pricing-table-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .exad-pricing-table-header .exad-pricing-table-header-svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_pricing_table_content_box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper',
			]
		);

		$this->add_control(
			'exad_pricing_table_content_alignment',
			[
				'label' => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					]
				],
				'default' => 'center',
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
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_pricing_table_header_type' => ['curved-header', 'svg-header'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_pricing_table_header_background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-pricing-table-header',
				'condition' => [
					'exad_pricing_table_header_type' => 'curved-header',
				],
			]
		);

		$this->start_controls_tabs( 'exad_pricing_table_header_svg_gradient',
			[
				'label' => esc_html__( 'Gradient Color', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_pricing_table_header_type' => 'svg-header',
				]
			]
		);

			// First Color Tab
			$this->start_controls_tab( 'exad_pricing_table_header_svg_first', [ 'label' => esc_html__( 'First Color', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_pricing_table_header_svg_first_color',
					[
						'label' => esc_html__( 'COLOR', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .exad-pricing-table-header .exad-pricing-table-header-svg svg linearGradient .color-1' => 'stop-color: {{VALUE}};',
						],
						'condition' => [
							'exad_pricing_table_header_type' => 'svg-header',
						]
					]
				);

			$this->end_controls_tab();

			// Second Color Tab
			$this->start_controls_tab( 'exad_pricing_table_header_svg_second', [ 'label' => esc_html__( 'Second Color', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_pricing_table_header_svg_second_color',
					[
						'label' => esc_html__( 'COLOR', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .exad-pricing-table-header .exad-pricing-table-header-svg svg linearGradient .color-2' => 'stop-color: {{VALUE}};',
						],
						'condition' => [
							'exad_pricing_table_header_type' => 'svg-header',
						]
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'exad_pricing_table_header_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '30',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_pricing_table_header_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '50',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_pricing_table_title_heading',
			[
				'label' => esc_html__( 'Title Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'exad_pricing_table_title_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-title' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'exad_pricing_table_title_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-table-title',
			]
		);

		$this->add_control(
			'exad_pricing_table_title_margin',
			[
				'label' => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_pricing_table_title_subheading',
			[
				'label' => esc_html__( 'Subtitle Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'exad_pricing_table_subtitle_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-subtitle' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'exad_pricing_table_subtitle_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-table-subtitle',
			]
		);

		$this->add_control(
			'exad_pricing_table_subtitle_margin',
			[
				'label' => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '10',
					'left' => '0',
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_pricing_table_price_box_height',
			[
				'label' => __( 'Box Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '100',
				'selectors' => [
					'{{WRAPPER}} .price-box' => 'height: {{VALUE}}px',
				],
				'condition' => [
					'exad_pricing_table_price_box' => 'yes',
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_price_box_width',
			[
				'label' => __( 'Box Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '100',
				'selectors' => [
					'{{WRAPPER}} .price-box' => 'width: {{VALUE}}px'
				],
				'condition' => [
					'exad_pricing_table_price_box' => 'yes',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_pricing_table_price_box_background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .price-box',
				'condition' => [
					'exad_pricing_table_price_box' => 'yes',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_pricing_table_price_box_border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .price-box',
				'condition' => [
					'exad_pricing_table_price_box' => 'yes',
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_price_box_radius',
			[
				'label' => __( 'Box Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50',
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .price-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'exad_pricing_table_price_box' => 'yes',
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_price_tag_heading',
			[
				'label' => esc_html__( 'Original Price', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'exad_pricing_table_pricing_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-price' => 'color: {{VALUE}};',
					'{{WRAPPER}} .exad-pricing-table-five .exad-pricing-table-price p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'exad_pricing_table_price_tag_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-price',
							'{{WRAPPER}} .exad-pricing-table-five .exad-pricing-table-price p',
			]
		);

		$this->add_control(
			'exad_pricing_table_pricing_period_heading',
			[
				'label' => esc_html__( 'Pricing By', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'exad_pricing_table_pricing_period_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-price-period' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'exad_pricing_table_price_preiod_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-price-period',
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
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_pricing_table_featured_list_font_size',
			[
				'label' => esc_html__( 'Icon Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 12
				],
				'range' => [
					'px' => [
						'max' => 24,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-li-icon' => 'font-size: {{SIZE}}px;',
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_list_item_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-features li' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'exad_pricing_table_list_padding',
			[
				'label' => __( 'List Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '10',
					'right' => '0',
					'bottom' => '10',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-features li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_pricing_table_list_border_bottom',
			[
				'label' => __( 'List Border Bottom', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'exad_pricing_table_list_border_bottom_style',
			[
				'label' => __( 'List Border Bottom Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'defailt' => '#e5e5e5',
				'selectors' => [
					'{{WRAPPER}} .list-border-bottom li:not(:last-child)' => 'border-bottom:1px solid {{VALUE}};',
				],
				'condition' => [
					'exad_pricing_table_list_border_bottom' => 'yes',
				],
			]
		);

		$this->add_control(
			'exad_pricing_table_feature_padding',
			[
				'label' => __( 'Feature Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '30',
					'right' => '0',
					'bottom' => '30',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-features' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_pricing_table_feature_margin',
			[
				'label' => __( 'Feature margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-features' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_pricing_table_feature_list_border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-pricing-table-features',
			]
		);

		$this->add_control(
			'exad_pricing_table_list_disable_item_color',
			[
				'label' => esc_html__( 'Disable item color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#a6a9ad',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-features li.exad-pricing-table-features-disable' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'exad_pricing_table_list_item_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-table-features li',
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
				'label' => esc_html__( 'Featured Badge', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_pricing_table_featured' => 'yes'
				],
			]
		);

		$this->add_control(
			'exad_pricing_table_featured_tag_font_size',
			[
				'label' => esc_html__( 'Font Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 12
				],
				'range' => [
					'px' => [
						'max' => 40,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .text-badge' => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .icon-badge i' => 'font-size: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'exad_pricing_table_featured_tag_text_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .text-badge' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-badge i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_pricing_table_featured_text_badge_background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .text-badge',
				'condition' => [
					'exad_pricing_table_featured_type' => 'text-badge'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_pricing_table_featured_icon_badge_background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .icon-badge',
				'condition' => [
					'exad_pricing_table_featured_type' => 'icon-badge'
				],
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Transition)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_pricing_table_transition_settings',
			[
				'label' => esc_html__( 'Transition', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_pricing_table_transition_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper:hover',
			]
		);

		$this->add_control(
			'exad_pricing_table_transition_type',
			[
				'label' => __( 'Transition Type', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'transition_top' =>  __( 'Transition Top', 'exclusive-addons-elementor' ),
					'transition_bottom' => __( 'Transition Bottom', 'exclusive-addons-elementor' ),
					'transition_zoom' => __( 'Transition Zoom', 'exclusive-addons-elementor' ),
				],
				'default' => 'transition_top',
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
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
	         'name' => 'exad_pricing_table_btn_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action',
			]
		);

		$this->add_control(
			'exad_pricing_table_button_border_radius',
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
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_pricing_table_button_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '10',
					'right' => '30',
					'bottom' => '10',
					'left' => '30',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'exad_cta_button_tabs' );

			// Normal State Tab
			$this->start_controls_tab( 'exad_pricing_table_btn_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_pricing_table_btn_normal_text_color',
				[
					'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'exad_pricing_table_btn_normal_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#00C853',
					'selectors' => [
						'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'exad_pricing_table_btn_normal_border_color',
					'label' => __( 'Border', 'exclusive-addons-elementor' ),
					'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action',
				]
			);

			
			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'exad_pricing_table_btn_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_pricing_table_btn_hover_text_color',
				[
					'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#00C853',
					'selectors' => [
						'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'exad_pricing_table_btn_hover_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#FFFFFF',
					'selectors' => [
						'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action:hover' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'exad_pricing_table_btn_hover_border_color',
					'label' => __( 'Border', 'exclusive-addons-elementor' ),
					'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action:hover',
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
	
	?>
	<div class="exad-pricing-table-wrapper exad-pricing-table <?php echo esc_attr($settings['exad_pricing_table_content_alignment']); ?> <?php echo esc_attr($settings['exad_pricing_table_transition_type']); ?>">
		<div class="exad-pricing-table-badge-wrapper">
			<?php if ( $settings['exad_pricing_table_featured'] == 'yes' ) { ?>
				<span class="exad-pricing-table-badge <?php echo esc_attr($settings['exad_pricing_table_featured_type']); ?>">
					<?php if( $settings['exad_pricing_table_featured_type'] == 'text-badge' ) { ?>
						<?php echo $settings['exad_pricing_table_featured_tag_text'] ?>
					<?php } ?>
					<?php if( $settings['exad_pricing_table_featured_type'] == 'icon-badge' ) { ?>
						<i class="fa fa-star"></i>
					<?php } ?>
				</span>
			<?php } ?>
			<div class="exad-pricing-table-header">
				<h4 class="exad-pricing-table-title"><?php echo $settings['exad_pricing_table_title']; ?></h4>
				<?php if ( !empty( $settings['exad_pricing_table_subtitle'] ) ) : ?>
                    <p class="exad-pricing-table-subtitle"><?php echo esc_html( $settings['exad_pricing_table_subtitle'] ); ?></p>
                <?php endif; ?>
				<div <?php echo $this->get_render_attribute_string( 'exad_pricing_table_box_value' ); ?> >
					<p>
					<?php echo $settings['exad_pricing_table_price_cur'] ?><?php echo $settings['exad_pricing_table_price']; ?><span class="exad-price-period"><?php echo $settings['exad_pricing_table_period_separator']; ?><?php echo $settings['exad_pricing_table_price_by']; ?></span>
					</p>
				</div>
				<?php if( $settings['exad_pricing_table_header_type'] === 'curved-header' ) { ?>
					<div class="exad-pricing-table-header-curved">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 370 20">
							<path class="st0" d="M0 20h185C70 20 0 0 0 0v20zM185 20h185V0s-70 20-185 20z" />
						</svg>
					</div>
				<?php } ?>
				<?php if( $settings['exad_pricing_table_header_type'] === 'svg-header' ) { ?>
					<div class="exad-pricing-table-header-svg">
						<svg xmlns="http://www.w3.org/2000/svg">
							<defs>
							<linearGradient id="a" x1="0%" x2="0%" y1="100%" y2="0%">
								<stop offset="1%" class="color-1" />
								<stop offset="100%" class="color-2" />
							</linearGradient>
							</defs>
							<path fill-rule="evenodd" opacity=".471"
							d="M0 0v107s87.864 104.803 186 119c98.862 14.303 208-41 208-41V0H0z" />
							<path fill="url(#a)" d="M0 0v107s87.864 104.803 186 119c98.862 14.303 208-41 208-41V0H0z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg">
							<defs>
							<linearGradient id="b" x1="0%" x2="0%" y1="100%" y2="0%">
								<stop offset="1%" class="color-1" />
								<stop offset="100%" class="color-2" />
							</linearGradient>
							</defs>
							<path fill-rule="evenodd" opacity=".471"
							d="M0 0v130s87.864 81.803 186 96c98.862 14.303 208-21 208-21V0H0z" />
							<path fill="url(#b)" d="M0 0v130s87.864 81.803 186 96c98.862 14.303 208-21 208-21V0H0z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg">
							<defs>
							<linearGradient id="c" x1="0%" x2="0%" y1="100%" y2="0%">
								<stop offset="1%" class="color-1" />
								<stop offset="100%" class="color-2" />
							</linearGradient>
							</defs>
							<path fill-rule="evenodd" opacity=".471"
							d="M0 0v153s87.864 58.803 186 73c98.862 14.303 208-1 208-1V0H0z" />
							<path fill="url(#c)" d="M0 0v153s87.864 58.803 186 73c98.862 14.303 208-1 208-1V0H0z" />
						</svg>
					</div>
				<?php } ?>
			</div>
			<?php if($settings['exad_pricing_table_btn_position'] === 'middle') { ?>
			<a href="<?php echo esc_url( $settings['exad_pricing_table_btn_link']['url'] ); ?>" class="exad-pricing-table-action">
				<?php echo $settings['exad_pricing_table_btn']; ?>
			</a>
			<?php } ?>
			<ul <?php echo $this->get_render_attribute_string( 'exad_pricing_table_features' ); ?>>
				<?php foreach( $settings['exad_pricing_table_items'] as $item ) : ?>
					<li class="<?php echo ( 'yes' !== $item['exad_pricing_table_icon_mood'] ) ? 'exad-pricing-table-features-disable' : ''; ?>">
						<span class="exad-pricing-li-icon"><i class="<?php echo esc_attr( $item['exad_pricing_table_list_icon'] ); ?>"></i></span>
						<?php echo $item['exad_pricing_table_item']; ?>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php if($settings['exad_pricing_table_btn_position'] === 'bottom') { ?>
			<a href="<?php echo esc_url( $settings['exad_pricing_table_btn_link']['url'] ); ?>" class="exad-pricing-table-action">
				<?php echo $settings['exad_pricing_table_btn']; ?>
			</a>
			<?php } ?>
		</div>
	</div>
		
	<?php
	}


	protected function _content_template() {
	?>
	<#
		view.addRenderAttribute( 'exad_pricing_table_box_value', 'class', 'exad-pricing-table-price' );

		if( settings.exad_pricing_table_price_box === 'yes' ){
			view.addRenderAttribute( 'exad_pricing_table_box_value', 'class', 'price-box' );
		}

		view.addRenderAttribute( 'exad_pricing_table_features', 'class', 'exad-pricing-table-features' );

		if( settings.exad_pricing_table_list_border_bottom === 'yes' ){
			view.addRenderAttribute( 'exad_pricing_table_features', 'class', 'list-border-bottom' );
		}
	#>
	
	<div class="exad-pricing-table-wrapper exad-pricing-table {{ settings.exad_pricing_table_content_alignment }} {{ settings.exad_pricing_table_transition_type }}">
		<div class="exad-pricing-table-badge-wrapper">
			<# if ( settings.exad_pricing_table_featured === 'yes' ) { #>
			<span class="exad-pricing-table-badge {{ settings.exad_pricing_table_featured_type }}">
					<# if( settings.exad_pricing_table_featured_type == 'text-badge' ) { #>
						{{{ settings.exad_pricing_table_featured_tag_text }}}
					<# } #>
					<# if( settings.exad_pricing_table_featured_type == 'icon-badge' ) { #>
						<i class="fa fa-star"></i>
					<# } #>
				</span>
			<# } #>
			<div class="exad-pricing-table-header">
				<h4 class="exad-pricing-table-title">{{{ settings.exad_pricing_table_title }}}</h4>
				<# if ( settings.exad_pricing_table_subtitle != '' ) { #>
                    <p class="exad-pricing-table-subtitle">{{{ settings.exad_pricing_table_subtitle }}}</p>
                <# } #>
				<div {{{ view.getRenderAttributeString( 'exad_pricing_table_box_value' ) }}} >
					<p>
					{{{ settings.exad_pricing_table_price_cur }}} {{{ settings.exad_pricing_table_price }}}<span class="exad-price-period">{{{ settings.exad_pricing_table_period_separator }}} {{{ settings.exad_pricing_table_price_by }}}</span>
					</p>
				</div>
				<# if( settings.exad_pricing_table_header_type === 'curved-header' ) { #>
					<div class="exad-pricing-table-header-curved">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 370 20">
							<path class="st0" d="M0 20h185C70 20 0 0 0 0v20zM185 20h185V0s-70 20-185 20z" />
						</svg>
					</div>
				<# } #>
				<# if( settings.exad_pricing_table_header_type === 'svg-header' ) { #>
					<div class="exad-pricing-table-header-svg">
						<svg xmlns="http://www.w3.org/2000/svg">
							<defs>
							<linearGradient id="a" x1="0%" x2="0%" y1="100%" y2="0%">
								<stop offset="1%" class="color-1" />
								<stop offset="100%" class="color-2" />
							</linearGradient>
							</defs>
							<path fill-rule="evenodd" opacity=".471"
							d="M0 0v107s87.864 104.803 186 119c98.862 14.303 208-41 208-41V0H0z" />
							<path fill="url(#a)" d="M0 0v107s87.864 104.803 186 119c98.862 14.303 208-41 208-41V0H0z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg">
							<defs>
							<linearGradient id="b" x1="0%" x2="0%" y1="100%" y2="0%">
								<stop offset="1%" class="color-1" />
								<stop offset="100%" class="color-2" />
							</linearGradient>
							</defs>
							<path fill-rule="evenodd" opacity=".471"
							d="M0 0v130s87.864 81.803 186 96c98.862 14.303 208-21 208-21V0H0z" />
							<path fill="url(#b)" d="M0 0v130s87.864 81.803 186 96c98.862 14.303 208-21 208-21V0H0z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg">
							<defs>
							<linearGradient id="c" x1="0%" x2="0%" y1="100%" y2="0%">
								<stop offset="1%" class="color-1" />
								<stop offset="100%" class="color-2" />
							</linearGradient>
							</defs>
							<path fill-rule="evenodd" opacity=".471"
							d="M0 0v153s87.864 58.803 186 73c98.862 14.303 208-1 208-1V0H0z" />
							<path fill="url(#c)" d="M0 0v153s87.864 58.803 186 73c98.862 14.303 208-1 208-1V0H0z" />
						</svg>
					</div>
				<# } #>
			</div>
			<# if( settings.exad_pricing_table_btn_position === 'middle') { #>
			<a href="{{ settings.exad_pricing_table_btn_link.url }}" class="exad-pricing-table-action">
				{{{ settings.exad_pricing_table_btn }}}
			</a>
			<# } #>
			<ul {{{ view.getRenderAttributeString( 'exad_pricing_table_features' ) }}} >
				<# _.each( settings.exad_pricing_table_items, function( features, index ) {
					var active = ( 'yes' !== features.exad_pricing_table_icon_mood ) ? 'exad-pricing-table-features-disable' : ''
				#>
					<li class="{{ active }}">
						<span class="exad-pricing-li-icon"><i class="{{ features.exad_pricing_table_list_icon }}"></i></span>
						{{{ features.exad_pricing_table_item }}}
					</li>
				<# }) #>
			</ul>
			<# if( settings.exad_pricing_table_btn_position === 'bottom') { #>
			<a href="{{{ settings.exad_pricing_table_btn_link.url }}}" class="exad-pricing-table-action">
				{{{ settings.exad_pricing_table_btn }}}
			</a>
			<# } #>
		</div>
	</div>

	<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Pricing_Table() );