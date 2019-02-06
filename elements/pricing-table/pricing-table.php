<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Pricing_Table extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-pricing-table';
	}
	public function get_title() {
		return esc_html__( 'DC Pricing Table', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'fa fa-user-circle';
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

		/**
		 * Condition: 'exad_pricing_table_style' => 'style-2'
		 */
		$this->add_control(
			'exad_pricing_table_sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( 'Tagline for Pricing', 'exclusive-addons-elementor' ),
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
				'description' => __( 'Works with Style 3', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);


		/**
		 * Condition: 'exad_pricing_table_featured_styles' => [ 'ribbon-2', 'ribbon-3' ], 'exad_pricing_table_featured' => 'yes'
		 */
		$this->add_control(
			'exad_pricing_table_featured_tag_text',
			[
				'label' => esc_html__( 'Featured Text', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( 'Featured', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_pricing_table_featured' => 'yes'
				]
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
			'exad_pricing_table_price',
			[
				'label' => esc_html__( 'Price', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '50', 'exclusive-addons-elementor' )
			]
		);
		$this->add_control(
			'exad_pricing_table_onsale',
			[
				'label' => __( 'On Sale?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'exclusive-addons-elementor' ),
				'label_off' => __( 'No', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
			]
		);
		$this->add_control(
			'exad_pricing_table_onsale_price',
			[
				'label' => esc_html__( 'Sale Price', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '40', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_pricing_table_onsale' => 'yes'
				]
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

		/*
		* Pricing Table Styling Section
		*/
		$this->start_controls_section(
			'exad_section_pricing_tables_styles_general',
			[
				'label' => esc_html__( 'Styleset', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'exad_pricing_table_preset',
			[
				'label' => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '-one',
				'options' => [
					'-one' => esc_html__( 'Default', 'exclusive-addons-elementor' ),
					'-two' => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
					'-three' => esc_html__( 'Style 3', 'exclusive-addons-elementor' ),
					'-six' => esc_html__( 'Style 4', 'exclusive-addons-elementor' ),
					// Going to change the name to four later (amendedment)
				],
			]
		);


		$this->add_control(
			'exad_pricing_table_box_bg',
			[
				'label' => esc_html__( 'Price Box Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'description' => __( 'Only works with the default Style', 'exclusive-addons-elementor' ),
				'default' => '#826EFF',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-one .exad-pricing-table-price svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'exad_pricing_table_preset' => '-one'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_two_top_line',
			[
				'label' => esc_html__( 'Top Line Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'description' => __( 'Only works with the Style 2', 'exclusive-addons-elementor' ),
				'default' => '#826EFF',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-two' => 'border-top-color: {{VALUE}};',
				],
				'condition' => [
					'exad_pricing_table_preset' => '-two'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		


		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Header)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_pricing_table_header_style_settings',
			[
				'label' => esc_html__( 'Header', 'exclusive-addons-elementor' ),
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
			'exad_pricing_table_subtitle_heading',
			[
				'label' => esc_html__( 'Subtitle Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'exad_pricing_table_subtitle_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-item .header .subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             	'name' => 'exad_pricing_table_subtitle_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-item .header .subtitle',
			]

		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Pricing)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_pricing_table_title_style_settings',
			[
				'label' => esc_html__( 'Pricing', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_pricing_table_price_tag_onsale_heading',
			[
				'label' => esc_html__( 'Original Price', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'exad_pricing_table_pricing_onsale_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#999',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'exad_pricing_table_price_tag_onsale_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-item .muted-price',
			]
		);

		$this->add_control(
			'exad_pricing_table_price_tag_heading',
			[
				'label' => esc_html__( 'Sale Price', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'exad_pricing_table_pricing_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-item .price-tag' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'exad_pricing_table_price_tag_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-item .price-tag',
			]
		);


		$this->add_control(
			'exad_pricing_table_price_currency_heading',
			[
				'label' => esc_html__( 'Currency', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'exad_pricing_table_pricing_curr_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#00C853',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-item .price-tag .price-currency' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'exad_pricing_table_price_cur_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-item .price-currency',
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_price_cur_margin',
			[
				'label' => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .exad-pricing-item .price-currency' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
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
					'{{WRAPPER}} .exad-pricing-item .price-period' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'exad_pricing_table_price_preiod_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-item .price-period',
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
			'exad_section_pricing_table_style_3_featured_tag_settings',
			[
				'label' => esc_html__( 'Featured Badge', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_pricing_table_featured' => 'yes'
				],
			]
		);

		$this->add_control(
			'exad_pricing_table_style_1_featured_bar_color',
			[
				'label' => esc_html__( 'Line Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#00C853',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing.style-1 .exad-pricing-item.ribbon-1:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .exad-pricing.style-2 .exad-pricing-item.ribbon-1:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .exad-pricing.style-3 .exad-pricing-item.ribbon-1:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .exad-pricing.style-4 .exad-pricing-item.ribbon-1:before' => 'background: {{VALUE}};',
				],
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
					'size' => 11
				],
				'range' => [
					'px' => [
						'max' => 18,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-badge' => 'font-size: {{SIZE}}px;',
				],
				'condition' => [
					'exad_pricing_table_featured' => 'yes',
				],
			]
		);

		$this->add_control(
			'exad_pricing_table_featured_tag_text_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-badge' => 'color: {{VALUE}};',
				],
				'condition' => [
					'exad_pricing_table_featured' => 'yes',
				],
			]
		);

		$this->add_control(
			'exad_pricing_table_featured_tag_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-badge' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'exad_pricing_table_featured' => 'yes',
				],
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
				'selector' => '{{WRAPPER}} .exad-pricing .exad-pricing-button',
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
						'{{WRAPPER}} .exad-pricing-table-action' => 'color: {{VALUE}};',
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
						'{{WRAPPER}} .exad-pricing-table-action' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'exad_pricing_table_btn_normal_border_color',
				[
					'label' => esc_html__( 'Border Color', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#00C853',
					'selectors' => [
						'{{WRAPPER}} .exad-pricing-table-action' => 'border-color: {{VALUE}};',
					],
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
						'{{WRAPPER}} .exad-pricing-table-action:hover' => 'color: {{VALUE}};',
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
						'{{WRAPPER}} .exad-pricing-table-action:hover' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'exad_pricing_table_btn_hover_border_color',
				[
					'label' => esc_html__( 'Border Color', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#00C853',
					'selectors' => [
						'{{WRAPPER}} .exad-pricing-table-action:hover' => 'border-color: {{VALUE}};',
					],
				]

			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();	

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$pricing_preset = $settings['exad_pricing_table_preset'];
	
		?>

		<div class="exad-pricing-table-wrapper exad-pricing-table<?php echo esc_attr( $pricing_preset ); ?>">
			<?php if ( $settings['exad_pricing_table_featured'] == 'yes' ) : ?>
				<div class="exad-pricing-table-badge-wrapper">
					<span class="exad-pricing-table-badge">
	            		<?php echo $settings['exad_pricing_table_featured_tag_text'] ?>
	          		</span>
	          		<h4 class="exad-pricing-table-title"><?php echo $settings['exad_pricing_table_title']; ?></h4>
		          	<div class="exad-pricing-table-price">
		          		<?php if ( $pricing_preset === '-one' ) : ?>
				            <svg xmlns="http://www.w3.org/2000/svg" width="186" height="186"><path fill-rule="evenodd" opacity=".659" d="M92.516.531c51.095 0 92.515 41.442 92.515 92.563s-41.42 92.562-92.515 92.562S0 144.215 0 93.094C0 41.973 41.421.531 92.516.531z"/></svg>
				            <svg xmlns="http://www.w3.org/2000/svg" width="186" height="186"><path fill-rule="evenodd" opacity=".659" d="M92.516.531c51.095 0 92.515 41.442 92.515 92.563s-41.42 92.562-92.515 92.562S0 144.215 0 93.094C0 41.973 41.421.531 92.516.531z"/></svg>
				            <svg xmlns="http://www.w3.org/2000/svg" width="186" height="186"><path fill-rule="evenodd" opacity=".659" d="M92.516.531c51.095 0 92.515 41.442 92.515 92.563s-41.42 92.562-92.515 92.562S0 144.215 0 93.094C0 41.973 41.421.531 92.516.531z"/></svg>
				        <?php endif; ?>
			            <p>
			            <?php echo $settings['exad_pricing_table_price_cur'] ?><?php echo $settings['exad_pricing_table_price']; ?><span><?php echo $settings['exad_pricing_table_period_separator']; ?><?php echo $settings['exad_pricing_table_price_by']; ?></span>
			        	</p>
		          	</div>
		          	<ul class="exad-pricing-table-features">
		          		<?php foreach( $settings['exad_pricing_table_items'] as $item ) : ?>
			            	<li class="<?php echo ( 'yes' !== $item['exad_pricing_table_icon_mood'] ) ? 'exad-pricing-table-features-disable' : ''; ?>">
			              		<span class="exad-pricing-li-icon"><i class="<?php echo esc_attr( $item['exad_pricing_table_list_icon'] ); ?>"></i></span>
			              		<?php echo $item['exad_pricing_table_item']; ?>
			            	</li>
		            	<?php endforeach; ?>
		          	</ul>
	          	</div>
	        <?php endif; ?>
          	<a href="<?php echo esc_url( $settings['exad_pricing_table_btn_link']['url'] ); ?>" class="exad-pricing-table-action"><?php echo $settings['exad_pricing_table_btn']; ?></a>
        </div>
		
	<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Pricing_Table() );