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

		$this->start_controls_section(
			'exad_section_pricing_tables_styles_presets',
			[
				'label' => esc_html__( 'General Styles', 'exclusive-addons-elementor' ),
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
					'-one' => esc_html__( 'Style 1', 'exclusive-addons-elementor' ),
					'-two' => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
					'-three' => esc_html__( 'Style 3', 'exclusive-addons-elementor' ),
					'-five' => esc_html__( 'Style 5', 'exclusive-addons-elementor' ),
					'-six' => esc_html__( 'Style 6', 'exclusive-addons-elementor' ),
					'-seven' => esc_html__( 'Style 7', 'exclusive-addons-elementor' ),
					'-eight' => esc_html__( 'Style 8', 'exclusive-addons-elementor' ),
					'-nine' => esc_html__( 'Style 9', 'exclusive-addons-elementor' ),
					'-ten' => esc_html__( 'Style 10', 'exclusive-addons-elementor' ),
					// Going to change the name to four later (amendedment)
				],
			]
		);


		$this->add_control(
			'exad_pricing_table_box_bg',
			[
				'label' => esc_html__( 'Price Box Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#826EFF',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-one .exad-pricing-table-price svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'exad_pricing_table_preset' => ['-one'],
				]
			]
		);

		$this->start_controls_tabs( 'exad_svg_gradient_tabs' ,
			[
				'condition' => [
					'exad_pricing_table_preset' => ['-five'],
				]
			]
		);

			// First Color Tab
			$this->start_controls_tab( 'exad_pricing_table_svg_first', [ 'label' => esc_html__( 'First Color', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_pricing_table_svg_first_color',
				[
					'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .exad-pricing-table-five svg linearGradient .color-1' => 'stop-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			// Second Color Tab
			$this->start_controls_tab( 'exad_pricing_table_svg_second', [ 'label' => esc_html__( 'Second Color', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_pricing_table_svg_second_color',
				[
					'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .exad-pricing-table-five svg linearGradient .color-2' => 'stop-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();
		
		$this->add_control(
			'exad_pricing_table_two_top_line',
			[
				'label' => esc_html__( 'Top Line Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
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
				'seperator' => 'before',
				'type' => Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-wrapper' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .exad-pricing-table-eight .exad-pricing-table-header svg path' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'exad_pricing_table_preset' => ['-one', '-two', '-three', '-five', '-six', '-seven', '-eight', '-ten'],
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_nine_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'seperator' => 'before',
				'type' => Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-nine .exad-pricing-table-content' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_pricing_table_preset' => ['-nine'],
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_pricing_table_background_image',
				'label' => esc_html__( 'Background Image', 'exclusive-addons-elementor' ),
				'types' => [ 'classic'],
				'selector' => '{{WRAPPER}} .exad-pricing-table-nine::before',
				'condition' => [
					'exad_pricing_table_preset' => '-nine'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_header_bg_color',
			[
				'label' => esc_html__( 'Header Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-eight .exad-pricing-table-header::before' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_pricing_table_preset' => '-eight'
				]
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

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Sub Header)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_pricing_table_subheader_style_settings',
			[
				'label' => esc_html__( 'Sub Header', 'exclusive-addons-elementor' ),
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
			'exad_pricing_table_price_tag_heading',
			[
				'label' => esc_html__( 'Original Price', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_pricing_table_price_background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .exad-pricing-table-five .exad-pricing-table-price',
				'condition' => [
					'exad_pricing_table_preset' => '-five',
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_pricing_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFF',
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
			'exad_pricing_table_list_top_border_color',
			[
				'label' => esc_html__( 'Top Border Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#d8d8d8',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-features' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .exad-pricing-table-seven .exad-pricing-table-features::before' => 'background: {{VALUE}};',
					// '{{WRAPPER}} .exad-pricing-table-nine .exad-pricing-table-features' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'exad_pricing_table_preset' => ['-two', '-six', '-seven', '-nine', '-ten'],
				],
			]
		);

		$this->add_control(
			'exad_pricing_table_list_border_color',
			[
				'label' => esc_html__( 'Border Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e5e5e5',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-one .exad-pricing-table-features li:not(:last-child)' => 'border-bottom: 1px solid {{VALUE}};',
				],
				'condition' => [
					'exad_pricing_table_preset' => ['-one'],
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
					'{{WRAPPER}} .exad-pricing-table-badge i' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .exad-pricing-table-badge' => 'background: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action',
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

			$this->add_control(
				'exad_pricing_table_btn_normal_border_color',
				[
					'label' => esc_html__( 'Border Color', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#00C853',
					'selectors' => [
						'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action' => 'border-color: {{VALUE}};',
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

			$this->add_control(
				'exad_pricing_table_btn_hover_border_color',
				[
					'label' => esc_html__( 'Border Color', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#00C853',
					'selectors' => [
						'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action:hover' => 'border-color: {{VALUE}};',
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

		<?php if ( $pricing_preset == '-one' || $pricing_preset == '-two' || $pricing_preset == '-three' || $pricing_preset == '-five' || $pricing_preset == '-six' || $pricing_preset == '-ten' ) : ?>

		<div class="exad-pricing-table-wrapper exad-pricing-table<?php echo esc_attr( $pricing_preset ); ?>">
			<div class="exad-pricing-table-badge-wrapper">
			<?php if ( $settings['exad_pricing_table_featured'] == 'yes' ) : ?>
				<span class="exad-pricing-table-badge">
					<?php if( $pricing_preset == '-one' || $pricing_preset == '-two' || $pricing_preset == '-three' || $pricing_preset == '-five' || $pricing_preset == '-six' ) : ?>
						<?php echo $settings['exad_pricing_table_featured_tag_text'] ?>
					<?php endif; ?>
					<?php if( $pricing_preset == '-ten' ) : ?>
						<i class="fa fa-star"></i>
					<?php endif; ?>
				</span>
				<?php endif; ?>
				<?php if ( $pricing_preset === '-five' ) : ?>
					<svg xmlns="http://www.w3.org/2000/svg">
						<defs>
						<linearGradient id="a" x1="0%" x2="0%" y1="100%" y2="0%">
							<stop offset="1%" class="color-1" />
							<stop offset="100%" class="color-2" />
						</linearGradient>
						</defs>
						<path fill-rule="evenodd" opacity=".471" fill="#FFF"
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
						<path fill-rule="evenodd" opacity=".471" fill="#FFF"
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
						<path fill-rule="evenodd" opacity=".471" fill="#FFF"
						d="M0 0v153s87.864 58.803 186 73c98.862 14.303 208-1 208-1V0H0z" />
						<path fill="url(#c)" d="M0 0v153s87.864 58.803 186 73c98.862 14.303 208-1 208-1V0H0z" />
					</svg>
				<?php endif; ?>
				<h4 class="exad-pricing-table-title"><?php echo $settings['exad_pricing_table_title']; ?></h4>
				<?php if ( !empty( $settings['exad_pricing_table_subtitle'] ) ) : ?>
                    <p class="exad-pricing-table-subtitle"><?php echo esc_html( $settings['exad_pricing_table_subtitle'] ); ?></p>
                <?php endif; ?>
				<div class="exad-pricing-table-price">
					<?php if ( $pricing_preset === '-one' ) : ?>
						<svg xmlns="http://www.w3.org/2000/svg" width="186" height="186"><path fill-rule="evenodd" opacity=".659" d="M92.516.531c51.095 0 92.515 41.442 92.515 92.563s-41.42 92.562-92.515 92.562S0 144.215 0 93.094C0 41.973 41.421.531 92.516.531z"/></svg>
						<svg xmlns="http://www.w3.org/2000/svg" width="186" height="186"><path fill-rule="evenodd" opacity=".659" d="M92.516.531c51.095 0 92.515 41.442 92.515 92.563s-41.42 92.562-92.515 92.562S0 144.215 0 93.094C0 41.973 41.421.531 92.516.531z"/></svg>
						<svg xmlns="http://www.w3.org/2000/svg" width="186" height="186"><path fill-rule="evenodd" opacity=".659" d="M92.516.531c51.095 0 92.515 41.442 92.515 92.563s-41.42 92.562-92.515 92.562S0 144.215 0 93.094C0 41.973 41.421.531 92.516.531z"/></svg>
					<?php endif; ?>
					<p>
					<?php echo $settings['exad_pricing_table_price_cur'] ?><?php echo $settings['exad_pricing_table_price']; ?><span class="exad-price-period"><?php echo $settings['exad_pricing_table_period_separator']; ?><?php echo $settings['exad_pricing_table_price_by']; ?></span>
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
			<a href="<?php echo esc_url( $settings['exad_pricing_table_btn_link']['url'] ); ?>" class="exad-pricing-table-action">
			  <?php echo $settings['exad_pricing_table_btn']; ?>
			</a>
		</div>
		<?php endif; ?>

		<?php if ( $pricing_preset == '-eight' || $pricing_preset == '-seven' ) : ?>

		<div class="exad-pricing-table-wrapper exad-pricing-table<?php echo esc_attr( $pricing_preset ); ?>">
			<?php if ( $settings['exad_pricing_table_featured'] == 'yes' ) : ?>
				<span class="exad-pricing-table-badge">
					<?php if( $pricing_preset == '-seven' ) : ?>
						<?php echo $settings['exad_pricing_table_featured_tag_text'] ?>
					<?php endif; ?>
					<?php if( $pricing_preset == '-eight' ) : ?>
						<i class="fa fa-star"></i>
					<?php endif; ?>
				</span>
			<?php endif; ?>
			<div class="exad-pricing-table-header">
				<h4 class="exad-pricing-table-title"><?php echo $settings['exad_pricing_table_title']; ?></h4>
				<?php if ( !empty( $settings['exad_pricing_table_subtitle'] ) ) : ?>
                    <p class="exad-pricing-table-subtitle"><?php echo esc_html( $settings['exad_pricing_table_subtitle'] ); ?></p>
                <?php endif; ?>
				<div class="exad-pricing-table-price">
					<p>
					<?php echo $settings['exad_pricing_table_price_cur'] ?><?php echo $settings['exad_pricing_table_price']; ?><span class="exad-price-period"><?php echo $settings['exad_pricing_table_period_separator']; ?><?php echo $settings['exad_pricing_table_price_by']; ?></span>
					</p>
				</div>
				<a href="<?php echo esc_url( $settings['exad_pricing_table_btn_link']['url'] ); ?>" class="exad-pricing-table-action">
					<?php echo $settings['exad_pricing_table_btn']; ?>
				</a>
				<?php if( $pricing_preset == '-eight' ) : ?>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 370 20">
						<path class="st0" d="M0 20h185C70 20 0 0 0 0v20zM185 20h185V0s-70 20-185 20z" />
					</svg>
				<?php endif; ?>
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

		<?php if ( $pricing_preset == '-nine' ) : ?>

		<div class="exad-pricing-table-wrapper exad-pricing-table<?php echo esc_attr( $pricing_preset ); ?>">
			<div class="exad-pricing-table-content">
			<?php if ( $settings['exad_pricing_table_featured'] == 'yes' ) : ?>
				<span class="exad-pricing-table-badge">
					<?php if( $pricing_preset == '-nine' ) : ?>
						<?php echo $settings['exad_pricing_table_featured_tag_text'] ?>
					<?php endif; ?>
				</span>
				<?php endif; ?>
				<h4 class="exad-pricing-table-title"><?php echo $settings['exad_pricing_table_title']; ?></h4>
				<?php if ( !empty( $settings['exad_pricing_table_subtitle'] ) ) : ?>
                    <p class="exad-pricing-table-subtitle"><?php echo esc_html( $settings['exad_pricing_table_subtitle'] ); ?></p>
                <?php endif; ?>
				<div class="exad-pricing-table-price">
					<p>
					<?php echo $settings['exad_pricing_table_price_cur'] ?><?php echo $settings['exad_pricing_table_price']; ?><span class="exad-price-period"><?php echo $settings['exad_pricing_table_period_separator']; ?><?php echo $settings['exad_pricing_table_price_by']; ?></span>
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
				<a href="<?php echo esc_url( $settings['exad_pricing_table_btn_link']['url'] ); ?>" class="exad-pricing-table-action">
				  <?php echo $settings['exad_pricing_table_btn']; ?>
				</a>
			</div>
		</div>
		<?php endif; ?>
		
	<?php
	}

	protected function _content_template() {
		?>

		<# if ( settings.exad_pricing_table_preset == '-one' || settings.exad_pricing_table_preset == '-two' || settings.exad_pricing_table_preset == '-three' || settings.exad_pricing_table_preset == '-five' || settings.exad_pricing_table_preset == '-six' || settings.exad_pricing_table_preset == '-ten' ) { #>
		<div class="exad-pricing-table-wrapper exad-pricing-table{{ settings.exad_pricing_table_preset }}">
			<div class="exad-pricing-table-badge-wrapper">
			<# if ( settings.exad_pricing_table_featured == 'yes' ) { #>
				<span class="exad-pricing-table-badge">
					<# if( settings.exad_pricing_table_preset == '-one' || settings.exad_pricing_table_preset == '-two' || settings.exad_pricing_table_preset == '-three' || settings.exad_pricing_table_preset == '-five' || settings.exad_pricing_table_preset == '-six' ) { #>
						{{{ settings.exad_pricing_table_featured_tag_text }}}
					<# } #>
					<# if( settings.exad_pricing_table_preset == '-ten' ) { #>
						<i class="fa fa-star"></i>
					<# } #>
				</span>
			<# } #>
				<# if ( settings.exad_pricing_table_preset === '-five' ) { #>
					<svg xmlns="http://www.w3.org/2000/svg">
						<defs>
						<linearGradient id="a" x1="0%" x2="0%" y1="100%" y2="0%">
							<stop offset="1%" class="color-1" />
							<stop offset="100%" class="color-2" />
						</linearGradient>
						</defs>
						<path fill-rule="evenodd" opacity=".471" fill="#FFF"
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
						<path fill-rule="evenodd" opacity=".471" fill="#FFF"
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
						<path fill-rule="evenodd" opacity=".471" fill="#FFF"
						d="M0 0v153s87.864 58.803 186 73c98.862 14.303 208-1 208-1V0H0z" />
						<path fill="url(#c)" d="M0 0v153s87.864 58.803 186 73c98.862 14.303 208-1 208-1V0H0z" />
					</svg>
				<# } #>
				<h4 class="exad-pricing-table-title">{{{ settings.exad_pricing_table_title }}}</h4>
				<# if (  settings.exad_pricing_table_subtitle != '' ) { #>
                    <p class="exad-pricing-table-subtitle">{{{ settings.exad_pricing_table_subtitle }}}</p>
                <# } #>
				<div class="exad-pricing-table-price">
					<# if ( settings.exad_pricing_table_preset == '-one' ) { #>
						<svg xmlns="http://www.w3.org/2000/svg" width="186" height="186"><path fill-rule="evenodd" opacity=".659" d="M92.516.531c51.095 0 92.515 41.442 92.515 92.563s-41.42 92.562-92.515 92.562S0 144.215 0 93.094C0 41.973 41.421.531 92.516.531z"/></svg>
						<svg xmlns="http://www.w3.org/2000/svg" width="186" height="186"><path fill-rule="evenodd" opacity=".659" d="M92.516.531c51.095 0 92.515 41.442 92.515 92.563s-41.42 92.562-92.515 92.562S0 144.215 0 93.094C0 41.973 41.421.531 92.516.531z"/></svg>
						<svg xmlns="http://www.w3.org/2000/svg" width="186" height="186"><path fill-rule="evenodd" opacity=".659" d="M92.516.531c51.095 0 92.515 41.442 92.515 92.563s-41.42 92.562-92.515 92.562S0 144.215 0 93.094C0 41.973 41.421.531 92.516.531z"/></svg>
					<# } #>
					<p>
					{{{ settings.exad_pricing_table_price_cur }}}{{{ settings.exad_pricing_table_price }}}<span class="exad-price-period">{{{ settings.exad_pricing_table_period_separator }}}{{{ settings.exad_pricing_table_price_by }}}</span>
					</p>
				</div>
				<ul class="exad-pricing-table-features">
					<# _.each( settings.exad_pricing_table_items, function( features, index ) { 
						var active = ( 'yes' !== features.exad_pricing_table_icon_mood ) ? 'exad-pricing-table-features-disable' : ''
					#>
					<li class="{{ active }}">
						<span class="exad-pricing-li-icon"><i class="{{ features.exad_pricing_table_list_icon }}"></i></span>
						{{{ features.exad_pricing_table_item }}}
					</li>
				<# }); #>
				</ul>
			</div>
          	<a href="{{ settings.exad_pricing_table_btn_link.url }}" class="exad-pricing-table-action">{{{ settings.exad_pricing_table_btn }}}</a>
		</div>
		<# } #>

		<# if ( settings.exad_pricing_table_preset == '-seven' || settings.exad_pricing_table_preset == '-eight' ) { #>

		<div class="exad-pricing-table-wrapper exad-pricing-table{{ settings.exad_pricing_table_preset }}">
			<# if ( settings.exad_pricing_table_featured == 'yes' ) { #>
				<span class="exad-pricing-table-badge">
					<# if( settings.exad_pricing_table_preset == '-seven' ) { #>
						{{{ settings.exad_pricing_table_featured_tag_text }}}
					<# } #>
					<# if( settings.exad_pricing_table_preset == '-eight' ) { #>
						<i class="fa fa-star"></i>
					<# } #>
				</span>
			<# } #>
			<div class="exad-pricing-table-header">
				<h4 class="exad-pricing-table-title">{{{ settings.exad_pricing_table_title }}}</h4>
				<# if (  settings.exad_pricing_table_subtitle != '' ) { #>
                    <p class="exad-pricing-table-subtitle">{{{ settings.exad_pricing_table_subtitle }}}</p>
                <# } #>
				<div class="exad-pricing-table-price">
					<p>
					{{{ settings.exad_pricing_table_price_cur }}}{{{ settings.exad_pricing_table_price }}}<span class="exad-price-period">{{{ settings.exad_pricing_table_period_separator }}}{{{ settings.exad_pricing_table_price_by }}}</span>
					</p>
				</div>
				<a href="{{ settings.exad_pricing_table_btn_link.url }}" class="exad-pricing-table-action">{{{ settings.exad_pricing_table_btn }}}</a>
				<# if( settings.exad_pricing_table_preset == '-eight' ) { #>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 370 20">
						<path class="st0" d="M0 20h185C70 20 0 0 0 0v20zM185 20h185V0s-70 20-185 20z" />
					</svg>
				<# } #>
			</div>
			<ul class="exad-pricing-table-features">
				<# _.each( settings.exad_pricing_table_items, function( features, index ) { 
					var active = ( 'yes' !== features.exad_pricing_table_icon_mood ) ? 'exad-pricing-table-features-disable' : ''
				#>
				<li class="{{ active }}">
					<span class="exad-pricing-li-icon"><i class="{{ features.exad_pricing_table_list_icon }}"></i></span>
					{{{ features.exad_pricing_table_item }}}
				</li>
				<# }); #>
			</ul>
		</div>
		<# } #>

		<# if ( settings.exad_pricing_table_preset == '-nine' ) { #>
		<div class="exad-pricing-table-wrapper exad-pricing-table{{ settings.exad_pricing_table_preset }}">
			<div class="exad-pricing-table-content">
			<# if ( settings.exad_pricing_table_featured == 'yes' ) { #>
				<span class="exad-pricing-table-badge">
					<# if( settings.exad_pricing_table_preset == '-nine' ) { #>
						{{{ settings.exad_pricing_table_featured_tag_text }}}
					<# } #>
				</span>
			<# } #>
				<h4 class="exad-pricing-table-title">{{{ settings.exad_pricing_table_title }}}</h4>
				<# if (  settings.exad_pricing_table_subtitle != '' ) { #>
                    <p class="exad-pricing-table-subtitle">{{{ settings.exad_pricing_table_subtitle }}}</p>
                <# } #>
				<div class="exad-pricing-table-price">
					<p>
					{{{ settings.exad_pricing_table_price_cur }}}{{{ settings.exad_pricing_table_price }}}<span class="exad-price-period">{{{ settings.exad_pricing_table_period_separator }}}{{{ settings.exad_pricing_table_price_by }}}</span>
					</p>
				</div>
				<ul class="exad-pricing-table-features">
					<# _.each( settings.exad_pricing_table_items, function( features, index ) { 
						var active = ( 'yes' !== features.exad_pricing_table_icon_mood ) ? 'exad-pricing-table-features-disable' : ''
					#>
					<li class="{{ active }}">
						<span class="exad-pricing-li-icon"><i class="{{ features.exad_pricing_table_list_icon }}"></i></span>
						{{{ features.exad_pricing_table_item }}}
					</li>
				<# }); #>
				</ul>
				<a href="{{ settings.exad_pricing_table_btn_link.url }}" class="exad-pricing-table-action">{{{ settings.exad_pricing_table_btn }}}</a>
			</div>
		</div>
		<# } #>
		
	<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Pricing_Table() );