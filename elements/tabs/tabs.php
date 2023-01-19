<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Control_Media;
use \Elementor\Icons_Manager;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Css_Filter;
use \ExclusiveAddons\Elementor\Helper;
use \Elementor\Plugin;
use \Elementor\Repeater;

class Tabs extends Widget_Base {

	public function get_name() {
		return 'exad-exclusive-tabs';
	}

	public function get_title() {
		return esc_html__( 'Tabs', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad exad-logo exad-tabs';
	}

	public function get_keywords() {
		return [ 'exclusive', 'toggle' ];
	}

   	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function register_controls() {
		$exad_primary_color = get_option( 'exad_primary_color_option', '#7a56ff' );

  		/**
  		 * Exclusive Tabs Content Settings
  		 */
  		$this->start_controls_section(
  			'exad_section_exclusive_tabs_content_settings',
  			[
  				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
  			]
  		);
  		$tabs_repeater = new Repeater();

		$tabs_repeater->add_control(
			'exad_exclusive_tab_show_as_default',
			[
				'label'        => __( 'Active as Default', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'active'
			]
		);
		
		$tabs_repeater->add_control(
			'exad_exclusive_tabs_icon_type',
			[
				'label'       => esc_html__( 'Icon Type', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => false,
				'options'     => [
					'none'      => [
						'title' => esc_html__( 'None', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-ban'
					],
					'icon'      => [
						'title' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-info-circle'
					],
					'image'     => [
						'title' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-image-bold'
					]
				],
				'default'       => 'none'
			]
		);

		$tabs_repeater->add_control(
			'exad_exclusive_tab_title_icon',
			[
				'label'     => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-home',
					'library' => 'fa-solid'
				],			
				'condition' => [
					'exad_exclusive_tabs_icon_type' => 'icon'
				]
			]
		);

		$tabs_repeater->add_control(
			'exad_exclusive_tab_title_image',
			[
				'label'   => esc_html__( 'Image', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				],
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'exad_exclusive_tabs_icon_type' => 'image'
				]
			]
		);

		$tabs_repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
				'name'    => 'exad_tab_navigation_image_size',
				'default' => 'medium_large'
            ]
		);

		$tabs_repeater->add_control(
			'exad_exclusive_tab_content_type',
			[
				'label'   => __( 'Content Type', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'content',
				'options' => [
					'content'       => __( 'Content', 'exclusive-addons-elementor' ),
					'save_template' => __( 'Save Template', 'exclusive-addons-elementor' ),
					'shortcode'     => __( 'ShortCode', 'exclusive-addons-elementor' )
				]
			]
		);

		$tabs_repeater->add_control(
			'exad_tab_content_save_template',
			[
				'label'     => __( 'Select Section', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_saved_template( 'section' ),
				'default'   => '-1',
				'condition' => [
					'exad_exclusive_tab_content_type' => 'save_template'
				]
			]
		);

		$tabs_repeater->add_control(
			'exad_tab_content_shortcode',
			[
				'label'       => __( 'Enter your shortcode', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( '[gallery]', 'exclusive-addons-elementor' ),
				'condition'   => [
					'exad_exclusive_tab_content_type' => 'shortcode'
				]
			]
		);

		$tabs_repeater->add_control(
			'exad_exclusive_tab_title',
			[
				'label'   => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$tabs_repeater->add_control(
			'exad_exclusive_tab_content',
			[
				'label'   => esc_html__( 'Content', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_exclusive_tab_content_type' => 'content'
				]
			]
		);

		$tabs_repeater->add_control(
			'exad_exclusive_tab_detail_btn_switcher',
			[
				'label'        => __( 'Details Button?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'condition' => [
					'exad_exclusive_tab_content_type' => 'content'
				]
			]
		);

		$tabs_repeater->add_control(
			'exad_exclusive_tab_detail_btn',
			[
				'label'     => __( 'Details Button Text', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Read More', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_exclusive_tab_detail_btn_switcher' => 'yes',
					'exad_exclusive_tab_content_type' => 'content'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$tabs_repeater->add_control(
			'exad_exclusive_tab_detail_btn_link',
			[
				'label'   => __( 'Details Button Link', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::URL,
				'default' => [
					'url'         => '#',
					'is_external' => ''
				],
				'show_external' => true,
				'condition' => [
					'exad_exclusive_tab_detail_btn_switcher' => 'yes',
					'exad_exclusive_tab_content_type' => 'content'
				]
			]
		);

		$tabs_repeater->add_control(
			'exad_exclusive_tab_image',
			[
				'label' => esc_html__( 'Choose Image', 'exclusive-addons-elementor' ),
				'type'  => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'exad_exclusive_tab_content_type' => 'content'
				]
			]
		);

		$tabs_repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
				'name'    => 'exad_tab_image_size',
				'label'   => esc_html__( 'Image Type', 'exclusive-addons-elementor' ),
				'default' => 'medium'
            ]
		);

  		$this->add_control(
			'exad_exclusive_tabs',
			[
				'label'   => esc_html__( 'Tabs', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::REPEATER,
				'fields'  => $tabs_repeater->get_controls(),
				'seperator' => 'before',
				'default'   => [
					[ 
						'exad_exclusive_tab_title' => esc_html__( 'Tab Title 1', 'exclusive-addons-elementor' ),
						'exad_exclusive_tab_show_as_default' => 'active' 
					],
					[ 
						'exad_exclusive_tab_title'   => esc_html__( 'Tab Title 2', 'exclusive-addons-elementor' ),
						'exad_exclusive_tab_content' => esc_html__( 'A quick brown fox jumps over the lazy dog. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'exclusive-addons-elementor' )
					],
					[ 'exad_exclusive_tab_title' => esc_html__( 'Tab Title 3', 'exclusive-addons-elementor' ) ]
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
				'selector' => '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li span.exad-tab-title',
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
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav' => 'background: {{VALUE}};'
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
						'icon'  => 'eicon-text-align-left'
					],
					'exad-tab-align-center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-center'
					],
					'exad-tab-align-right'  => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-right'
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
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-tab-vertical > .exad-advance-tab-nav li' => 'width: {{SIZE}}{{UNIT}};'
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
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'exad_exclusive_tabs_navigation_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'exad_exclusive_tabs_navigation_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_exclusive_tabs_navigation_list_normal_text_color',
					[
						'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#8a8d91',
						'selectors' => [
							'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li' => 'color: {{VALUE}};'
						]
					]
				);
				
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'     => 'exad_exclusive_tabs_navigation_list_normal_background',
						'types'    => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .exad-advance-tab-nav li'
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'                 => 'exad_exclusive_tabs_navigation_list_normal_border',
						'fields_options'       => [
							'border'           => [
								'default'      => 'solid'
							],
							'width'            => [
								'default'      => [
									'top'      => '0',
									'right'    => '0',
									'bottom'   => '1',
									'left'     => '0',
									'isLinked' => false
								]
							],
							'color'            => [
								'default'      => '#e5e5e5'
							]
						],
						'selector'             => '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li'
					]
				);

				$this->add_group_control(
	                Group_Control_Box_Shadow::get_type(),
	                [
						'name'     => 'exad_exclusive_tabs_navigation_list_box_shadow',
						'selector' => '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li'
	                ]
	            );
				
			$this->end_controls_tab();
			
			// Active State Tab
			$this->start_controls_tab( 'exad_exclusive_tabs_navigation_active', [ 'label' => esc_html__( 'Active/Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_exclusive_tabs_navigation_list_hover_text_color',
					[
						'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#0a1724',
						'selectors' => [
							'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li.active, {{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'     => 'exad_exclusive_tabs_navigation_list_active_background',
						'types'    => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li.active, {{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li:hover, {{WRAPPER}} .exad-tab-triangle-right.active::before, {{WRAPPER}} .exad-tab-triangle-bottom.active::before'
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'                 => 'exad_exclusive_tabs_navigation_list_active_border',
						'fields_options'       => [
							'border'           => [
								'default'      => 'solid'
							],
							'width'            => [
								'default'      => [
									'top'      => '0',
									'right'    => '0',
									'bottom'   => '1',
									'left'     => '0',
									'isLinked' => false
								]
							],
							'color'            => [
								'default'      => $exad_primary_color
							]
						],
						'selector'             => '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li.active, {{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li:hover'
					]
				);

				$this->add_group_control(
	                Group_Control_Box_Shadow::get_type(),
	                [
						'name'     => 'exad_exclusive_tabs_navigation_list_active_box_shadow',
						'selector' => '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li.active, {{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li:hover'
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
						'icon'  => 'eicon-arrow-right'
                    ],
                    'exad-tab-triangle-bottom' => [
						'title' => esc_html__( 'Bottom', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-arrow-down'
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
				'label'        => __( 'Icon Box Height', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px' ],
				'range'        => [
					'px' 	   => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1
					],
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 100
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li' => 'height: {{SIZE}}{{UNIT}};'
				],
				'condition'    => [
					'exad_exclusive_tabs_icon_box_show' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_exclusive_tabs_icon_box_width',
			[
				'label'        => __( 'Icon Box Width', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px' ],
				'range'        => [
					'px' 	   => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1
					],
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 100
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition'    => [
					'exad_exclusive_tabs_icon_box_show' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exclusive_tabs_navigation_icon_size',
			[
				'label'        => __( 'Icon Size', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px' ],
				'range'        => [
					'px' 	   => [
						'min'  => 10,
						'max'  => 100,
						'step' => 1
					],
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 24
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li i' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_exclusive_tabs_icon_box_line_height',
			[
				'label'        => __( 'Icon Line Height', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px' ],
				'range'        => [
					'px' 	   => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1
					],
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 50
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li i' => 'line-height: {{SIZE}}{{UNIT}};'
				],
				'condition'    => [
					'exad_exclusive_tabs_icon_box_show' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_exclusive_tabs_icon_margin',
			[
				'label'        => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '10',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				], 
				'selectors'    => [
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
							'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li i' => 'color: {{VALUE}};'
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
							'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li.active i, {{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-nav li:hover i' => 'color: {{VALUE}};'
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
				'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0a1724',
				'selectors' => [
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content .exad-advance-tab-content-description' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_tabs_content_description_typography',
				'selector' => '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content .exad-advance-tab-content-description'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'exad_tab_content_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content'
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
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content .exad-advance-tab-content-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'exad_tab_content_border',
				'selector' => '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content'
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
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
		
		$this->add_control(
            'exad_tab_image_align',
            [
				'label'   => esc_html__( 'Image Position', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
                    'exad-tab-image-left' => [
                        'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-arrow-left'
                    ],
                    'exad-tab-image-right' => [
                        'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-arrow-right'
                    ]
                ],
                'default' => 'exad-tab-image-right'
            ]
		);
		
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'exad_tab_image_css_filter',
				'selector' => '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content .exad-advance-tab-content-thumb img',
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
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content .exad-tab-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content .exad-tab-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
					'{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content .exad-tab-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
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
                    'default'   => $exad_primary_color,
                    'selectors' => [
                        '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content .exad-tab-btn' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_tab_details_btn_normal_bg',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content .exad-tab-btn' => 'background: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
            Group_Control_Border::get_type(),
                [
					'name'            => 'exad_tab_details_btn_normal_border',
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
							'default' => $exad_primary_color
						]
					],
                    'selector'        => '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content .exad-tab-btn'
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
					'name'     => 'exad_tab_details_btn_normal_box_shadow',
					'selector' => '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content .exad-tab-btn'
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
					'default'   => '#ffffff',
					'selectors' => [
                        '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content .exad-tab-btn:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_tab_details_btn_hover_bg',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => $exad_primary_color,
                    'selectors' => [
                        '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content .exad-tab-btn:hover' => 'background: {{VALUE}};'
                    ]
                ]
			);
			
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'exad_tab_details_btn_hover_border',
					'selector' => '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content .exad-tab-btn:hover'
				]
			);

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
					'name'     => 'exad_tab_details_btn_hover_box_shadow',
					'selector' => '{{WRAPPER}} .exad-tabs-{{ID}}.exad-advance-tab > .exad-advance-tab-content .exad-tab-btn:hover'
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

		
  		$this->end_controls_section();

	}

	/**
	 *  Get Saved Widgets
	 *
	 *  @param string $type Type.
	 *  @since 0.0.1
	 *  @return string
	 */
	public function get_saved_template( $type = 'page' ) {

		$saved_widgets = $this->get_post_template( $type );
		$options[-1]   = __( 'Select', 'exclusive-addons-elementor' );
		if ( count( $saved_widgets ) ) :
			foreach ( $saved_widgets as $saved_row ) :
				$options[ $saved_row['id'] ] = $saved_row['name'];
			endforeach;
		else :
			$options['no_template'] = __( 'No section template is added.', 'exclusive-addons-elementor' );
		endif;
		return $options;
	}

	/**
	 *  Get Templates based on category
	 *
	 *  @param string $type Type.
	 *  @since 0.0.1
	 *  @return string
	 */
	public function get_post_template( $type = 'page' ) {
		$posts = get_posts(
			array(
				'post_type'        => 'elementor_library',
				'orderby'          => 'title',
				'order'            => 'ASC',
				'posts_per_page'   => '-1',
				'tax_query'        => array(
					array(
						'taxonomy' => 'elementor_library_type',
						'field'    => 'slug',
						'terms'    => $type
					)
				)
			)
		);

		$templates = array();

		foreach ( $posts as $post ) :
			$templates[] = array(
				'id'   => $post->ID,
				'name' => $post->post_title
			);
		endforeach;

		return $templates;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$this->add_render_attribute(
			'exad_tab_wrapper',
			[
				'class'	 => [ 
					'exad-tabs-' . $this->get_id(),
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
								if ( $tab['exad_exclusive_tab_title_image']['url'] || $tab['exad_exclusive_tab_title_image']['id'] ) { ?>
									<?php echo Group_Control_Image_Size::get_attachment_image_html( $tab, 'exad_tab_navigation_image_size', 'exad_exclusive_tab_title_image' ); ?>
								<?php }
							endif; 
						?>
						<span class="exad-tab-title"><?php echo Helper::exad_wp_kses( $tab['exad_exclusive_tab_title'] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
			
			<?php foreach( $settings['exad_exclusive_tabs'] as $key => $tab ) : 
				$exad_find_default_tab[] = $tab['exad_exclusive_tab_show_as_default'];
				$has_image = !empty( $tab['exad_exclusive_tab_image']['url'] ) ? 'yes' : 'no';
				$link_key  = 'link_' . $key;

				if( 'content' === $tab['exad_exclusive_tab_content_type'] ) {
					$exad_tab_btn_link = $tab['exad_exclusive_tab_detail_btn_link']['url'];
				
					$this->add_render_attribute( $link_key, 'class', 'exad-tab-btn' );
					if( !empty( $exad_tab_btn_link ) ) {
						$this->add_render_attribute( $link_key, 'href', esc_url( $exad_tab_btn_link ) );
						if( $tab['exad_exclusive_tab_detail_btn_link']['is_external'] ) {
							$this->add_render_attribute( $link_key, 'target', '_blank' );
						}
						if( $tab['exad_exclusive_tab_detail_btn_link']['nofollow'] ) {
							$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
						}
					}
				}
			?>
				<div class="exad-advance-tab-content exad-tab-image-has-<?php echo esc_attr($has_image); ?> <?php echo esc_attr( $tab['exad_exclusive_tab_show_as_default'] ); ?> <?php echo esc_attr( $settings['exad_tab_image_align'] ); ?>">
					<?php if( 'save_template' === $tab['exad_exclusive_tab_content_type'] ) { ?>
						<div class="exad-advance-tab-content-element">
                        	<?php echo Plugin::$instance->frontend->get_builder_content_for_display( wp_kses_post( $tab['exad_tab_content_save_template'] ) ); ?>
						</div>
                    <?php } else if( 'shortcode' === $tab['exad_exclusive_tab_content_type'] ) { ?>
                        <?php echo do_shortcode( $tab['exad_tab_content_shortcode'] ); ?>
                    <?php } else { ?>
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
								<?php echo Group_Control_Image_Size::get_attachment_image_html( $tab, 'exad_tab_image_size', 'exad_exclusive_tab_image' ); ?>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php
	}
}