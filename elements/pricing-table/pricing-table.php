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
use \Elementor\Repeater;
use \Elementor\Utils;
use \ExclusiveAddons\Elementor\Helper;

class Pricing_Table extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-pricing-table';
	}

	public function get_title() {
		return esc_html__( 'Pricing Table', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad exad-logo exad-pricing-table';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
        return [ 'exclusive', 'price', 'package', 'product', 'plan' ];
    }

	protected function register_controls() {
		$exad_secondary_color = get_option( 'exad_secondary_color_option', '#00d8d8' );

		/**
  		 * Pricing Table Feature
  		 */
  		$this->start_controls_section(
  			'exad_section_pricing_table_feature',
  			[
  				'label' => esc_html__( 'Features', 'exclusive-addons-elementor' )
  			]
		);
		  
		$pricing_repeater = new Repeater();

		$pricing_repeater->add_control(
			'exad_pricing_table_item',
			[
				'name'        => 'exad_pricing_table_item',
				'label'       => esc_html__( 'List Item', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Pricing table list item', 'exclusive-addons-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);
		
		$pricing_repeater->add_control(
			'exad_pricing_table_list_icon',
			[
				'name'        => 'exad_pricing_table_list_icon',
				'label'       => esc_html__( 'List Icon', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-check',
					'library' => 'fa-solid'
				]
			]
		);
		
		$pricing_repeater->add_control(
			'exad_pricing_table_icon_mood',
			[
				'name'         => 'exad_pricing_table_icon_mood',
				'label'        => esc_html__( 'Item Active?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
        );

  		$this->add_control(
			'exad_pricing_table_items',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'  => $pricing_repeater->get_controls(),
				'seperator'   => 'before',
				'default'     => [
					[ 'exad_pricing_table_item' => esc_html__( 'Responsive Live', 'exclusive-addons-elementor' ) ],
					[ 'exad_pricing_table_item' => esc_html__( 'Adaptive Bitrate', 'exclusive-addons-elementor' ) ],
					[ 'exad_pricing_table_item' => esc_html__( 'Analytics', 'exclusive-addons-elementor' ) ],
					[ 	
						'exad_pricing_table_item'      => esc_html__( 'Creative Layouts', 'exclusive-addons-elementor' ),
						'exad_pricing_table_icon_mood' => 'no'
					],
					[ 
						'exad_pricing_table_item'      => esc_html__( 'Free Support', 'exclusive-addons-elementor' ),
						'exad_pricing_table_icon_mood' => 'no'
					]
				],	
				'title_field' => '{{exad_pricing_table_item}}'
			]	
		);

		$this->end_controls_section();
		  
		/**
  		 * Pricing Table Promo label
  		 */
  		$this->start_controls_section(
			'exad_section_pricing_table_promo_section',
			[
				'label' => esc_html__( 'Promo Label', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_pricing_table_promo_enable',
			[
				'label'        => esc_html__( 'Promo Label?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'exad_pricing_table_promo_title',
			[
				'label'       => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'Recommended', 'exclusive-addons-elementor' ),
				'condition'   => [
					'exad_pricing_table_promo_enable' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_promo_position',
			[
				'label'        => __( 'Position', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'promo_top',
				'options'      => [
					'promo_top'    => __( 'Top', 'exclusive-addons-elementor' ),
					'promo_bottom' => __( 'Bottom', 'exclusive-addons-elementor' ),
				],
				'condition'    => [
					'exad_pricing_table_promo_enable' => 'yes'
				]
			]
		);

		$this->end_controls_section();

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
				'default'     => esc_html__( 'STANDARD', 'exclusive-addons-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
            'exad_pricing_table_title_tag',
            [
                'label'   => __('Title HTML Tag', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SELECT,
                'options' => Helper::exad_title_tags(),
                'default' => 'h3',
            ]
		);

		$this->add_control(
			'exad_pricing_table_subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				]
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
				'label'     => esc_html__( 'Badge Type', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'text-badge',
				'options'   => [
					'text-badge' => __( 'Text Badge', 'exclusive-addons-elementor' ),
					'icon-badge' => __( 'Icon Badge', 'exclusive-addons-elementor' )
				],
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

		$this->add_control(
			'exad_pricing_table_discount_price',
			[
				'label' => __( 'Show Discount Price', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'exad_pricing_table_regular_price',
			[
				'label'       => esc_html__( 'Ragular Price', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '50', 'exclusive-addons-elementor' ),
				'condition'   => [
					'exad_pricing_table_discount_price' => 'yes'
				]
			]
		);
		
  		$this->add_control(
			'exad_pricing_table_regular_price_cur',
			[
				'label'       => esc_html__( 'Regular Price Currency', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '$', 'exclusive-addons-elementor' ),
				'condition'   => [
					'exad_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_price_subtitle',
			[
				'label'       => esc_html__( 'Price Subtitle', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
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
				'default' => 'bottom',
				'options' => [
					'middle' => __( 'Middle', 'exclusive-addons-elementor' ),
					'bottom' => __( 'Bottom', 'exclusive-addons-elementor' )
				]
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
  		 * Pricing Table Note
  		 */
  		$this->start_controls_section(
			'exad_section_pricing_table_note',
			[
				'label' => esc_html__( 'Note', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_pricing_table_note_text',
			[
				'label' => __( 'Text', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 5,
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

		$this->add_responsive_control(
			'exad_section_pricing_tables_min_height',
			[
				'label'       => esc_html__( 'Min Height', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 2000,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-pricing-table-badge-wrapper' => 'min-height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_pricing_table_bg_color_simple',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#ffffff'
					]
				],
				'selector' => '{{WRAPPER}} .exad-pricing-table-badge-wrapper',
				'condition' => [
					'exad_pricing_table_header_type' => 'simple'
				]
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
					'{{WRAPPER}} .exad-pricing-table-badge-wrapper' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .exad-pricing-table-header .exad-pricing-table-header-curved svg path' => 'fill: {{VALUE}};'
				],
				'condition' => [
					'exad_pricing_table_header_type' => 'curved-header'
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
					'{{WRAPPER}} .exad-pricing-table-badge-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'exad_pricing_table_content_border',
				'selector' => '{{WRAPPER}} .exad-pricing-table-badge-wrapper'
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
					'{{WRAPPER}} .exad-pricing-table-badge-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .exad-pricing-table-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .exad-pricing-table-header .exad-pricing-table-header-svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_pricing_table_content_box_shadow',
				'selector' => '{{WRAPPER}} .exad-pricing-table-badge-wrapper',
				'fields_options'         => [
		            'box_shadow_type'    => [
		                'default'        =>'yes'
		            ],
		            'box_shadow'         => [
		                'default'        => [
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

		$content_align = is_rtl() ? 'right' : 'left';

		$this->add_control(
			'exad_pricing_table_content_alignment',
			[
				'label'         => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'separator'     => 'after',
				'default'       => $content_align,
				'options'       => [
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
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_pricing_table_transition_shadow',
				'label'    => __( 'Hover Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper:hover .exad-pricing-table-badge-wrapper',
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
		 * Style (Promo label)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_pricing_table_promo_style',
			[
				'label'     => esc_html__( 'Promo Label', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_pricing_table_promo_enable' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_promo_alignment',
			[
				'label'     => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
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
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-promo-label' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'exad_pricing_table_promo_background',
				'types'     => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#ffffff'
					]
				],
				'selector'  => '{{WRAPPER}} .exad-pricing-table-promo-label',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_pricing_table_promo_typography',
				'label'    => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-pricing-table-promo-label',
			]
		);

		$this->add_control(
			'exad_pricing_table_promo_text-color',
			[
				'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-promo-label' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_promo_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-promo-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_promo_radius',
			[
				'label'      => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-promo-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .exad-pricing-table-header',
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

		$this->add_responsive_control(
			'exad_pricing_table_header_border_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'exad_pricing_table_header_border',
				'selector'  => '{{WRAPPER}} .exad-pricing-table-header',
				'condition' => [
					'exad_pricing_table_header_type' => 'simple'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_pricing_table_header_shadow',
				'selector' => '{{WRAPPER}} .exad-pricing-table-header',
				'condition' => [
					'exad_pricing_table_header_type' => 'simple'
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
				'label' => esc_html__( 'Header Title', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_section_pricing_table_title_heading',
			[
				'label'     => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'exad_pricing_table_title_color',
			[
				'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
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
				'label'      => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		/**
		 * -------------------------------------------
		 * Style (Sub Title)
		 * -------------------------------------------
		 */

		$this->add_control(
			'exad_section_pricing_table_subtitletitle_heading',
			[
				'label'     => esc_html__( 'Sub Title', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before'
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
				'condition'   => [
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
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-price p.exad-pricing-table-new-price'  => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_pricing_table_price_tag_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-price p.exad-pricing-table-new-price',
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
		              'letter_spacing' => [
		                'default'      => [
		                    'unit'     => 'px',
		                    'size'     => -3.2
		                ]
		            ]
	            ]
			]
		);

		$this->add_control(
			'exad_pricing_table_regular_price_heading',
			[
				'label'     => esc_html__( 'Regular Price', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before',
				'condition' => [
					'exad_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_pricing_table_regular_price_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-table-price.exad-discount-price-yes p.exad-pricing-table-regular-price',
				'condition' => [
					'exad_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_regular_price_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-price.exad-discount-price-yes p.exad-pricing-table-regular-price' => 'color: {{VALUE}};'
				],
				'condition' => [
					'exad_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_regular_price_right_spacing',
			[
				'label'       => esc_html__( 'Regular Price Right Spacing', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 10
				],
				'range'       => [
					'px'      => [
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-pricing-table-price.exad-discount-price-yes p.exad-pricing-table-regular-price' => 'margin-right: {{SIZE}}px;'
				],
				'condition' => [
					'exad_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_pricing_curency_heading',
			[
				'label'     => esc_html__( 'Pricing Curency', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'exad_pricing_table_pricing_curency_spacing',
			[
				'label' => __( 'Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', 'exclusive-addons-elementor' ),
				'label_on' => __( 'Custom', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->start_popover();

			$this->add_responsive_control(
				'exad_pricing_table_pricing_curency_bottom_spacing',
				[
					'label'      => esc_html__( 'Bottom Spacing', 'exclusive-addons-elementor' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px'     => [
							'min'  => -100,
							'max'  => 100,
							'step' => 1
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-price span.exad-pricing-table-currency' => 'top: {{SIZE}}{{UNIT}};'
					],
				]
			);

            $this->add_responsive_control(
				'exad_pricing_table_pricing_curency_right_spacing',
				[
					'label'      => esc_html__( 'Right Spacing', 'exclusive-addons-elementor' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px'     => [
							'min'  => 0,
							'max'  => 200,
							'step' => 1
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-price span.exad-pricing-table-currency' => 'margin-right: {{SIZE}}{{UNIT}};'
					],
				]
			);

        $this->end_popover();

		$this->add_control(
			'exad_pricing_table_pricing_curency_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-price span.exad-pricing-table-currency' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_pricing_table_price_curency_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-price span.exad-pricing-table-currency',
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
		              'letter_spacing' => [
		                'default'      => [
		                    'unit'     => 'px',
		                    'size'     => 0
		                ]
		            ]
	            ]
			]
		);

		$this->add_control(
			'exad_pricing_table_price_subtitle_heading',
			[
				'label'     => esc_html__( 'Price Subtitle', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'exad_pricing_table_price_subtitle_color',
			[
				'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-price-subtitle' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_pricing_table_price_subtitle_typography',
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-price-subtitle',
			]
		);

		$this->add_responsive_control(
			'exad_pricing_table_price_subtitle_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
					'unit'   => 'px',
					'islinked' => true
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-price-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
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

		$icon_gap = is_rtl() ? 'left' : 'right';

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
					'{{WRAPPER}} .exad-pricing-table-features li .exad-pricing-li-icon' => 'margin-'.$icon_gap.': {{SIZE}}px;'
				]
			]
		);

		$this->add_control(
			'exad_pricing_table_list_item_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => $exad_secondary_color,
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
					'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
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
					'default'   => $exad_secondary_color,
					'selectors' => [
						'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'            => 'exad_pricing_table_btn_normal_border',
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
	                        'default' => $exad_secondary_color
	                    ]
	                ],
					'selector'        => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action'
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'exad_pricing_table_btn_box_shadow',
					'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action'
				]
			);

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'exad_pricing_table_btn_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_pricing_table_btn_hover_text_color',
				[
					'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => $exad_secondary_color,
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
	                        'default' => $exad_secondary_color
	                    ]
	                ],
					'selector'        => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action:hover'
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'exad_pricing_table_btn_box_shadow_hover',
					'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-action:hover'
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Note Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_pricing_table_note_style',
			[
				'label' => esc_html__( 'Note', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_pricing_table_note_alignment',
			[
				'label'         => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'default'		=> 'center',
				'options'       => [
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
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-note' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_section_pricing_table_note_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '10',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-note' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_section_pricing_table_note_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-note' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_section_pricing_table_note_background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-note',
			]
		);

		$this->add_control(
			'exad_section_pricing_table_note_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-note' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_section_pricing_table_note_text_typography',
				'label'    => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-note',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'exad_section_pricing_table_note_border',
				'selector' => '{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-note'
			]
		);

		$this->add_responsive_control(
			'exad_section_pricing_table_note_border_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-pricing-table-wrapper .exad-pricing-table-note' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

	}

	private function pricing_table_currency( $currency ) {
		return $currency ? '<span '.$this->get_render_attribute_string( 'exad_pricing_table_price_cur' ).'>'.esc_html( $currency ).'</span>' : '';
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$title         = $settings['exad_pricing_table_title'];
		$sub_title     = $settings['exad_pricing_table_subtitle'];
		$price         = $settings['exad_pricing_table_price'];
		$separator     = $settings['exad_pricing_table_period_separator'];
		$price_by      = $settings['exad_pricing_table_price_by'];
		$featured_text = $settings['exad_pricing_table_featured_tag_text'];

		$this->add_render_attribute( 
			'exad_pricing_table_wrapper', 
			[ 
				'class' => [ 
					'exad-pricing-table-wrapper', 
					'exad-pricing-table', 
					esc_attr( $settings['exad_pricing_table_content_alignment'] ), 
					esc_attr( $settings['exad_pricing_table_transition_type'] )
				]
			]
		);
	
		$this->add_render_attribute( 'exad_pricing_table_featured_tag_text', 'class', 'exad-pricing-featured-tag-text' );
		$this->add_inline_editing_attributes( 'exad_pricing_table_featured_tag_text', 'basic' );

		$this->add_render_attribute( 'exad_pricing_table_promo_title', 'class', 'exad-pricing-table-promo-label' );
		$this->add_inline_editing_attributes( 'exad_pricing_table_promo_title', 'basic' );

		$this->add_render_attribute( 'exad_pricing_table_title', 'class', 'exad-pricing-table-title' );
		$this->add_inline_editing_attributes( 'exad_pricing_table_title', 'basic' );

		$this->add_render_attribute( 'exad_pricing_table_subtitle', 'class', 'exad-pricing-table-subtitle' );
		$this->add_inline_editing_attributes( 'exad_pricing_table_subtitle', 'basic' );

		$this->add_render_attribute( 'exad_pricing_table_box_value', 'class', [ 'exad-pricing-table-price', 'exad-discount-price-'.$settings['exad_pricing_table_discount_price'] ] );

		if( 'yes' === $settings['exad_pricing_table_price_box'] ){
			$this->add_render_attribute( 'exad_pricing_table_box_value', 'class', 'price-box' );
		}

		$this->add_render_attribute( 'exad_pricing_table_price_cur', 'class', 'exad-pricing-table-currency' );
		$this->add_inline_editing_attributes( 'exad_pricing_table_price_cur', 'basic' );

		$this->add_render_attribute( 'exad_pricing_table_period_separator', 'class', 'exad-pricing-table-currency-separator' );
		$this->add_inline_editing_attributes( 'exad_pricing_table_period_separator', 'none' );

		$this->add_render_attribute( 'exad_pricing_table_price_by', 'class', 'exad-pricing-table-price-by' );
		$this->add_inline_editing_attributes( 'exad_pricing_table_price_by', 'basic' );

		$this->add_render_attribute( 'exad_pricing_table_price', 'class', 'exad-pricing-table-price' );
		$this->add_inline_editing_attributes( 'exad_pricing_table_price', 'basic' );

		$this->add_render_attribute( 'exad_pricing_table_features', 'class', 'exad-pricing-table-features' );
		if( 'yes' === $settings['exad_pricing_table_list_border_bottom'] ){
			$this->add_render_attribute( 'exad_pricing_table_features', 'class', 'list-border-bottom' );
		}

        $this->add_render_attribute( 'exad_pricing_table_btn_link', 'class', 'exad-pricing-table-action' );
		if( $settings['exad_pricing_table_btn_link']['url'] ) {
            $this->add_render_attribute( 'exad_pricing_table_btn_link', 'href', esc_url( $settings['exad_pricing_table_btn_link']['url'] ) );
	        if( $settings['exad_pricing_table_btn_link']['is_external'] ) {
	            $this->add_render_attribute( 'exad_pricing_table_btn_link', 'target', '_blank' );
	        }
	        if( $settings['exad_pricing_table_btn_link']['nofollow'] ) {
	            $this->add_render_attribute( 'exad_pricing_table_btn_link', 'rel', 'nofollow' );
	        }
        }

        $this->add_inline_editing_attributes( 'exad_pricing_table_btn', 'none' );

		?>

		<div <?php echo $this->get_render_attribute_string( 'exad_pricing_table_wrapper' ); ?>>
			<?php if( 'promo_top' === $settings['exad_pricing_table_promo_position'] ) { 
				if( 'yes' === $settings['exad_pricing_table_promo_enable'] ) { ?>
					<span <?php echo $this->get_render_attribute_string( 'exad_pricing_table_promo_title' ); ?>><?php echo wp_kses_post( $settings['exad_pricing_table_promo_title'] ); ?></span>
				<?php } ?>
			<?php } ?>
			<div class="exad-pricing-table-badge-wrapper">

				<?php if ( 'yes' === $settings['exad_pricing_table_featured'] ) { ?>
					<span class="exad-pricing-table-badge <?php echo esc_attr( $settings['exad_pricing_table_featured_type'] ); ?>">
						<?php if( 'text-badge' === $settings['exad_pricing_table_featured_type'] && !empty( $featured_text ) ) { ?>
							<span <?php echo $this->get_render_attribute_string( 'exad_pricing_table_featured_tag_text' ); ?>>
								<?php echo esc_html( $featured_text ); ?>
							</span>
						<?php } ?>
						<?php if( 'icon-badge' === $settings['exad_pricing_table_featured_type'] ) { ?>
							<i class="demo-icon eicon-star"></i>
						<?php } ?>
					</span>
				<?php } ?>

				<div class="exad-pricing-table-header">
					<?php do_action( 'exad_pricing_table_header_wrapper_before' ); ?>

					<?php $title ? printf( '<'.Utils::validate_html_tag( $settings['exad_pricing_table_title_tag'] ).' ' .$this->get_render_attribute_string( 'exad_pricing_table_title' ).'>%s</'.Utils::validate_html_tag( $settings['exad_pricing_table_title_tag'] ).'>', wp_kses_post( $title ) ) : '';
					$sub_title ? printf( '<div '.$this->get_render_attribute_string( 'exad_pricing_table_subtitle' ).'>%s</div>', wp_kses_post( $sub_title ) ) : ''; ?>

					<div <?php echo $this->get_render_attribute_string( 'exad_pricing_table_box_value' ); ?>>
						<?php if( 'yes' === $settings['exad_pricing_table_discount_price'] ) { ?>
							<p class="exad-pricing-table-regular-price">				
								<span class="exad-pricing-table-regular-price-cur"><?php echo $settings['exad_pricing_table_regular_price_cur']; ?></span>
								<span class="exad-pricing-table-regular-price-text"><?php echo $settings['exad_pricing_table_regular_price']; ?></span>
							</p>
						<?php } ?>
						<p class="exad-pricing-table-new-price">							
							<?php if( 'exad-pricing-cur-left' === $settings['exad_pricing_table_price_cur_position'] ) : ?>
								<?php echo $this->pricing_table_currency( $settings['exad_pricing_table_price_cur'] ); ?>
							<?php endif; ?>

							<?php $price ? printf( '<span '.$this->get_render_attribute_string( 'exad_pricing_table_price' ).'>%s</span>', esc_html( $price ) ) : ''; ?>

							<?php if( 'exad-pricing-cur-right' === $settings['exad_pricing_table_price_cur_position'] ) : ?>
								<?php echo $this->pricing_table_currency( $settings['exad_pricing_table_price_cur'] ); ?>
							<?php endif; ?>

							<?php if( $separator || $price_by ) : ?>
								<span class="exad-price-period">
									<?php $separator ? printf( '<span '.$this->get_render_attribute_string( 'exad_pricing_table_period_separator' ).'>%s</span>', esc_html( $separator ) ) : ''; ?>
									<?php $price_by ? printf( '<span '.$this->get_render_attribute_string( 'exad_pricing_table_price_by' ).'>%s</span>', esc_html( $price_by ) ) : ''; ?>
								</span>
							<?php endif; ?>
						</p>
					</div>

					<?php if( !empty( $settings['exad_pricing_table_price_subtitle'] ) ){ ?>
						<span class="exad-pricing-table-price-subtitle"><?php echo $settings['exad_pricing_table_price_subtitle']; ?></span>
					<?php } ?>

					<?php if ( 'yes' === $settings['exad_pricing_table_price_box_separator'] ) : ?>
						<div class="exad-price-bottom-separator"></div>
					<?php endif; ?>

					<?php if( 'curved-header' === $settings['exad_pricing_table_header_type'] ) { ?>
						<div class="exad-pricing-table-header-curved">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 370 20">
								<path class="st0" d="M0 20h185C70 20 0 0 0 0v20zM185 20h185V0s-70 20-185 20z" />
							</svg>
						</div>
					<?php } ?>

					<?php do_action( 'exad_pricing_table_header_wrapper_after' ); ?>
				</div>
				
				 <?php if( 'middle' === $settings['exad_pricing_table_btn_position'] && !empty( $settings['exad_pricing_table_btn'] ) ) {
					$this->pricing_table_btn();
				}

				do_action( 'exad_pricing_table_content_wrapper_before' ); ?>

				<?php if ( is_array( $settings['exad_pricing_table_items'] ) ) : ?>
					<ul <?php echo $this->get_render_attribute_string( 'exad_pricing_table_features' ); ?>>
						<?php foreach( $settings['exad_pricing_table_items'] as $index => $item ) : ?> 

							<?php $each_pricing_item = 'link_' . $index;
							$icon_mod = 'yes' !== $item['exad_pricing_table_icon_mood'] ? 'exad-pricing-table-features-disable' : 'exad-pricing-table-features-enable';
							$this->add_render_attribute( $each_pricing_item, 'class', [
								esc_attr( $icon_mod ),
								'elementor-repeater-item-'.esc_attr( $item['_id'] )
							] );

							$pricing_item = $this->get_repeater_setting_key( 'exad_pricing_table_item', 'exad_pricing_table_items', $index );
							$this->add_render_attribute( $pricing_item, 'class', 'exad-pricing-item' );
							$this->add_inline_editing_attributes( $pricing_item, 'basic' );
							$price = $item['exad_pricing_table_item']; ?>

							<li <?php echo $this->get_render_attribute_string( $each_pricing_item ); ?>>
								<?php if ( !empty( $item['exad_pricing_table_list_icon']['value'] ) ) { ?>
									<span class="exad-pricing-li-icon">
										<?php Icons_Manager::render_icon( $item['exad_pricing_table_list_icon'] ); ?>
									</span>
								<?php } ?>
								<?php $price ? printf( '<span '.$this->get_render_attribute_string( $pricing_item ).'>%s</span>', wp_kses_post( $price ) ) : ''; ?>
							</li>

						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<?php do_action( 'exad_pricing_table_content_wrapper_after' ); ?>

				<?php if( 'bottom' === $settings['exad_pricing_table_btn_position'] && !empty( $settings['exad_pricing_table_btn'] ) ) { ?>
					<?php $this->pricing_table_btn(); ?>
				<?php } ?> 
				<?php if( !empty( $settings['exad_pricing_table_note_text'] ) ){ ?>
					<div class="exad-pricing-table-note"><?php echo $settings['exad_pricing_table_note_text']; ?></div>
				<?php } ?>
			</div>
			<?php if( 'promo_bottom' === $settings['exad_pricing_table_promo_position'] ) {
				if( 'yes' === $settings['exad_pricing_table_promo_enable'] ) { ?>
					<span <?php echo $this->get_render_attribute_string( 'exad_pricing_table_promo_title' ); ?>><?php echo $settings['exad_pricing_table_promo_title']; ?></span>
				<?php } ?>
			<?php } ?>
		</div>
		<?php
	}

	/**
     * Render pricing table widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
    	?>
    	<#
			view.addRenderAttribute( 'exad_pricing_table_wrapper', {
				'class': [ 
					'exad-pricing-table-wrapper', 
					'exad-pricing-table', 
					settings.exad_pricing_table_content_alignment, 
					settings.exad_pricing_table_transition_type
				]
			} );
		
			view.addRenderAttribute( 'exad_pricing_table_featured_tag_text', 'class', 'exad-pricing-featured-tag-text' );
			view.addInlineEditingAttributes( 'exad_pricing_table_featured_tag_text', 'basic' );

			view.addRenderAttribute( 'exad_pricing_table_title', 'class', 'exad-pricing-table-title' );
			view.addInlineEditingAttributes( 'exad_pricing_table_title', 'basic' );

			view.addRenderAttribute( 'exad_pricing_table_subtitle', 'class', 'exad-pricing-table-subtitle' );
			view.addInlineEditingAttributes( 'exad_pricing_table_subtitle', 'basic' );

			view.addRenderAttribute( 'exad_pricing_table_box_value', {
				'class': [ 
					'exad-pricing-table-price', 
					'exad-pricing-table-'+settings.exad_pricing_table_discount_price, 
				]
			} );

			if( 'yes' === settings.exad_pricing_table_price_box ) {
				view.addRenderAttribute( 'exad_pricing_table_box_value', 'class', 'price-box' );
			}

			view.addRenderAttribute( 'exad_pricing_table_price_cur', 'class', 'exad-pricing-table-currency' );
			view.addInlineEditingAttributes( 'exad_pricing_table_price_cur', 'basic' );

			view.addRenderAttribute( 'exad_pricing_table_period_separator', 'class', 'exad-pricing-table-currency-separator' );
			view.addInlineEditingAttributes( 'exad_pricing_table_period_separator', 'none' );

			view.addRenderAttribute( 'exad_pricing_table_price_by', 'class', 'exad-pricing-table-price-by' );
			view.addInlineEditingAttributes( 'exad_pricing_table_price_by', 'basic' );

			view.addRenderAttribute( 'exad_pricing_table_price', 'class', 'exad-pricing-table-price' );
			view.addInlineEditingAttributes( 'exad_pricing_table_price', 'basic' );

			view.addRenderAttribute( 'exad_pricing_table_features', 'class', 'exad-pricing-table-features' );
			if( 'yes' === settings.exad_pricing_table_list_border_bottom ){
				view.addRenderAttribute( 'exad_pricing_table_features', 'class', 'list-border-bottom' );
			}

			view.addRenderAttribute( 'exad_pricing_table_btn_link', 'class', 'exad-pricing-table-action' );
	        view.addInlineEditingAttributes( 'exad_pricing_table_btn', 'none' );

	        var target = settings.exad_pricing_table_btn_link.is_external ? ' target="_blank"' : '';
            var nofollow = settings.exad_pricing_table_btn_link.nofollow ? ' rel="nofollow"' : '';

			var pricingTitleHTMLTag = elementor.helpers.validateHTMLTag( settings.exad_pricing_table_title_tag );
    	#>

    	<div {{{ view.getRenderAttributeString( 'exad_pricing_table_wrapper' ) }}}>
			<# if( 'promo_top' === settings.exad_pricing_table_promo_position ) { #>
				<# if( 'yes' === settings.exad_pricing_table_promo_enable ) { #>
					<span class="exad-pricing-table-promo-label">{{{ settings.exad_pricing_table_promo_title }}}</span>
				<# } #>
			<# } #>
    		<div class="exad-pricing-table-badge-wrapper">
				<# if ( 'yes' === settings.exad_pricing_table_featured ) { #>
					<span class="exad-pricing-table-badge {{{ settings.exad_pricing_table_featured_type }}}">
						<# if( 'text-badge' === settings.exad_pricing_table_featured_type && settings.exad_pricing_table_featured_tag_text ) { #>
							<span {{{ view.getRenderAttributeString( 'exad_pricing_table_featured_tag_text' ) }}}>
								{{{ settings.exad_pricing_table_featured_tag_text }}}
							</span>
						<# } #>
						<# if( 'icon-badge' === settings.exad_pricing_table_featured_type ) { #>
							<i class="demo-icon eicon-star"></i>
						<# } #>
					</span>
				<# } #>	

				<div class="exad-pricing-table-header">
					<# if ( settings.exad_pricing_table_title ) { #>
			    		<{{{ pricingTitleHTMLTag }}} {{{ view.getRenderAttributeString( 'exad_pricing_table_title' ) }}}>
			    			{{{ settings.exad_pricing_table_title }}}
			    		</{{{ pricingTitleHTMLTag }}}>
			    	<# } #>

					<# if ( settings.exad_pricing_table_subtitle ) { #>
			    		<div {{{ view.getRenderAttributeString( 'exad_pricing_table_subtitle' ) }}}>
			    			{{{ settings.exad_pricing_table_subtitle }}}
			    		</div>
			    	<# } #>

			    	<div {{{ view.getRenderAttributeString( 'exad_pricing_table_box_value' ) }}}>
						<# if( 'yes' === settings.exad_pricing_table_discount_price ) { #>
							<p class="exad-pricing-table-regular-price">					
								<span class="exad-pricing-table-regular-price-cur">{{{ settings.exad_pricing_table_regular_price_cur }}}</span>
								<span class="exad-pricing-table-regular-price-text">{{{ settings.exad_pricing_table_regular_price }}}</span>
							</p>
						<# } #>
			    		<p class="exad-pricing-table-new-price">	
			    			<# if ( 'exad-pricing-cur-left' === settings.exad_pricing_table_price_cur_position && settings.exad_pricing_table_price_cur ) { #>
			    				<span {{{ view.getRenderAttributeString( 'exad_pricing_table_price_cur' ) }}}>
			    					{{{ settings.exad_pricing_table_price_cur }}}
			    				</span>
							<# } #>

							<# if ( settings.exad_pricing_table_price ) { #>
					    		<span {{{ view.getRenderAttributeString( 'exad_pricing_table_price' ) }}}>
					    			{{{ settings.exad_pricing_table_price }}}
					    		</span>
					    	<# } #>

					    	<# if ( 'exad-pricing-cur-right' === settings.exad_pricing_table_price_cur_position && settings.exad_pricing_table_price_cur ) { #>	
			    				<span {{{ view.getRenderAttributeString( 'exad_pricing_table_price_cur' ) }}}>
			    					{{{ settings.exad_pricing_table_price_cur }}}
			    				</span>
							<# } #>
							<# if ( settings.exad_pricing_table_period_separator || settings.exad_pricing_table_price_by ) { #>
								<span class="exad-price-period">
									<# if ( settings.exad_pricing_table_period_separator ) { #>
										<span {{{ view.getRenderAttributeString( 'exad_pricing_table_period_separator' ) }}}>
											{{{ settings.exad_pricing_table_period_separator }}}
										</span>
									<# } #>
									<# if ( settings.exad_pricing_table_price_by ) { #>
										<span {{{ view.getRenderAttributeString( 'exad_pricing_table_price_by' ) }}}>
											{{{ settings.exad_pricing_table_price_by }}}
										</span>
									<# } #>
								</span>
							<# } #>
						</p>	
					</div>

					<# if( settings.exad_pricing_table_price_subtitle ){ #>
						<span class="exad-pricing-table-price-subtitle">{{{ settings.exad_pricing_table_price_subtitle }}}</span>
					<# } #>

					<# if ( 'yes' === settings.exad_pricing_table_price_box_separator ) { #>
						<div class="exad-price-bottom-separator"></div>
					<# } #>
					<# if ( 'curved-header' === settings.exad_pricing_table_header_type ) { #>
						<div class="exad-pricing-table-header-curved">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 370 20">
								<path class="st0" d="M0 20h185C70 20 0 0 0 0v20zM185 20h185V0s-70 20-185 20z" />
							</svg>
						</div>
					<# } #>
				</div>

				<# if ( 'middle' === settings.exad_pricing_table_btn_position && settings.exad_pricing_table_btn ) { #>
					<a href="{{{ settings.exad_pricing_table_btn_link.url }}}" {{{ view.getRenderAttributeString( 'exad_pricing_table_btn_link' ) }}}{{{ target }}}{{{ nofollow }}}>
						<span {{{ view.getRenderAttributeString( 'exad_pricing_table_btn' ) }}}>
							{{{ settings.exad_pricing_table_btn }}}
						</span>
					</a>
				<# } #>

				<# if ( settings.exad_pricing_table_items.length ) { #>
					<ul {{{ view.getRenderAttributeString( 'exad_pricing_table_features' ) }}}>
						<# _.each( settings.exad_pricing_table_items, function( item, index ) {
						    var pricingItem = view.getRepeaterSettingKey( 'exad_pricing_table_item', 'exad_pricing_table_items', index );
						    view.addRenderAttribute( pricingItem, 'class', 'exad-pricing-item' );
						    view.addInlineEditingAttributes( pricingItem, 'basic' );

						    var eachPricingItem = 'link_' + index;
						    var iconMod = 'yes' !== item.exad_pricing_table_icon_mood ? 'exad-pricing-table-features-disable' : 'exad-pricing-table-features-enable';
						    view.addRenderAttribute( eachPricingItem, {
								'class': [ 
									iconMod,
									'elementor-repeater-item-' + item._id 
								]
							} );

							var iconHTML = elementor.helpers.renderIcon( view, item.exad_pricing_table_list_icon, { 'aria-hidden': true }, 'i' , 'object' );
						#>
	                   		<li {{{ view.getRenderAttributeString( eachPricingItem ) }}}>
	                   			<# if ( iconHTML.value ) { #>
	                                <span class="exad-pricing-li-icon">
	                                    {{{ iconHTML.value }}}
	                                </span>
	                            <# } #>
	     						<# if ( item.exad_pricing_table_item ) { #>
	                                <span {{{ view.getRenderAttributeString( pricingItem ) }}}>
	                                    {{{ item.exad_pricing_table_item }}}
	                                </span>
	                            <# } #>
							</li>
	                    <# } ); #>
					</ul>
				<# } #>

				<# if ( 'bottom' === settings.exad_pricing_table_btn_position && settings.exad_pricing_table_btn ) { #>
					<a href="{{{ settings.exad_pricing_table_btn_link.url }}}" {{{ view.getRenderAttributeString( 'exad_pricing_table_btn_link' ) }}}{{{ target }}}{{{ nofollow }}}>
						<span {{{ view.getRenderAttributeString( 'exad_pricing_table_btn' ) }}}>
							{{{ settings.exad_pricing_table_btn }}}
						</span>
					</a>
				<# } #>
				<div class="exad-pricing-table-note">{{{ settings.exad_pricing_table_note_text }}}</div>
    		
    		</div>
			<# if( 'promo_bottom' === settings.exad_pricing_table_promo_position ) { #>
				<# if( 'yes' === settings.exad_pricing_table_promo_enable ) { #>
					<span class="exad-pricing-table-promo-label">{{{ settings.exad_pricing_table_promo_title }}}</span>
				<# } #>
			<# } #>
    	</div>
    	<?php
    }

    private function pricing_table_btn() {
		?>
		<a <?php echo $this->get_render_attribute_string( 'exad_pricing_table_btn_link' ); ?>>
			<span <?php echo $this->get_render_attribute_string( 'exad_pricing_table_btn' ); ?>>
				<?php echo esc_html( $this->get_settings_for_display( 'exad_pricing_table_btn' ) ); ?>
			</span>
		</a>
		<?php
	}
}