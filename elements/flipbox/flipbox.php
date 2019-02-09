<?php
namespace Elementor;

use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Flip_Box extends Widget_Base {

	public function get_name() {
		return 'exad-flip-box';
	}

	public function get_title() {
		return esc_html__( 'DC Flip Box', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'eicon-flip-box';
	}

   	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function _register_controls() {

  		$this->start_controls_section(
			'exad_section_side_a_content',
			[
				'label' => __( 'Front', 'bdthemes-element-pack' ),
			]
		);


		$this->add_control(
			'exad_flipbox_front_icon',
			[
				'label'     => __( 'Icon', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-heart',
			]
		);

		$this->add_control(
			'exad_flipbox_front_title',
			[
				'label'       => __( 'Title', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Heading Front', 'bdthemes-element-pack' ),
				'placeholder' => __( 'Your Title', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'exad_flipbox_front_description',
			[
				'label'       => __( 'Description', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'bdthemes-element-pack' ),
				'placeholder' => __( 'Your Description', 'bdthemes-element-pack' ),
				'title'       => __( 'Input image text here', 'bdthemes-element-pack' ),
			]
		);

	
		$this->end_controls_section();

		$this->start_controls_section(
			'exad_section_back_content',
			[
				'label' => __( 'Back', 'bdthemes-element-pack' ),
			]
		);

		

		$this->add_control(
			'exad_flipbox_back_icon',
			[
				'label'     => __( 'Icon', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-heart',
			]
		);

		$this->add_control(
			'exad_flipbox_back_title',
			[
				'label'       => __( 'Title', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Heading Back', 'bdthemes-element-pack' ),
				'placeholder' => __( 'Your Title', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'exad_flipbox_back_description',
			[
				'label'       => __( 'Description', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'bdthemes-element-pack' ),
				'placeholder' => __( 'Your Description', 'bdthemes-element-pack' ),
				'title'       => __( 'Input image text here', 'bdthemes-element-pack' ),
				'separator'   => 'none',
			]
		);

		$this->add_control(
			'exad_flipbox_button_text',
			[
				'label'     => __( 'Button Text', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => [ 'active' => true ],
				'default'   => __( 'Click Here', 'bdthemes-element-pack' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'exad_flipbox_button_link',
			[
				'label'       => __( 'Link', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
        			'url' => '#',
        			'is_external' => '',
     			],
     			'show_external' => true,
			]
		);

		$this->add_control(
			'exad_flipbox_link_click',
			[
				'label'   => __( 'Apply Link On', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'box'    => __( 'Whole Box', 'bdthemes-element-pack' ),
					'button' => __( 'Button Only', 'bdthemes-element-pack' ),
				],
				'default'   => 'button',
				'condition' => [
					'link[url]!' => '',
				],
			]
		);

		$this->add_control(
			'exad_flipbox_button_size',
			[
				'label' => __( 'Size', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => [
					'xs' => __( 'Extra Small', 'bdthemes-element-pack' ),
					'sm' => __( 'Small', 'bdthemes-element-pack' ),
					'md' => __( 'Medium', 'bdthemes-element-pack' ),
					'lg' => __( 'Large', 'bdthemes-element-pack' ),
					'xl' => __( 'Extra Large', 'bdthemes-element-pack' ),
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'back_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .bdt-flip-box-back',
			]
		);

		$this->add_control(
			'back_background_overlay',
			[
				'label' => __( 'Background Overlay', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-flip-box-back .bdt-flip-box-layer-overlay' => 'background-color: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
					'back_background_image[id]!' => '',
				],
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'section_box_settings',
			[
				'label' => __( 'Settings', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'exad_flipbox_style',
			[
				'label'   => __( 'Flip Style', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left-to-right',
				'options' => [
					'left-to-right'  => __( 'Left to Right', 'bdthemes-element-pack' ),
					'right-to-left' => __( 'Right to Left', 'bdthemes-element-pack' ),
					'top-to-bottom'    => __( 'Top to Bottom', 'bdthemes-element-pack' ),
					'bottom-to-top'  => __( 'Bottom to Top', 'bdthemes-element-pack' ),
					'top-to-bottom-angle'  => __( 'Diagonal (Top to Bottom)', 'bdthemes-element-pack' ),
					'bottom-to-top-angle'  => __( 'Diagonal (Bottom to Top)', 'bdthemes-element-pack' ),
					'fade-in-out'  => __( 'Fade In Out', 'bdthemes-element-pack' ),
				],
				
			]
		);

		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Tab Style (Flipbox Front)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_front_end_style_section',
			[
				'label' => __( 'Front', 'bdthemes-element-pack' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		/**
		 * Title
		 */
		$this->add_control(
			'exad_flipbox_front_title_heading',
			[
				'label' => esc_html__( 'Icon Style', 'essential-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		/**
		 * 
		 */
		$this->add_control(
			'exad_flipbox_front_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-image i' => 'color: {{VALUE}};',
				],
				
			]
		);


		/**
		 * 
		 */
		$this->add_control(
			'exad_flipbox_front_icon_bg',
			[
				'label' => esc_html__( 'Icon Background', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#826EFF',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-inner .exad-flip-box-front .exad-flip-box-front-image' => 'background: {{VALUE}};',
				],
				
			]
		);

		/**
		 * Title
		 */
		$this->add_control(
			'exad_flipbox_front_title_heading',
			[
				'label' => esc_html__( 'Title Style', 'essential-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		/**
		 * Condition: 'exad_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_control(
			'exad_flipbox_front_title_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-title' => 'color: {{VALUE}};',
				],
				
			]
		);

		

		/**
		 * Condition: 'exad_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'exad_flipbox_front_title_typography',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-title',
			]
		);

		/**
		 * Content
		 */
		$this->add_control(
			'exad_flipbox_content_heading',
			[
				'label' => esc_html__( 'Content Style', 'essential-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		/**
		 * Condition: 'exad_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_control(
			'exad_flipbox_front_content_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#817e7e',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-description' => 'color: {{VALUE}};',
				],
				
			]
		);

		/**
		 * Condition: 'exad_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'exad_flipbox_front_content_typography',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-description',
				
			]
		);


		/**
		 * Front Background
		 */
		$this->add_control(
			'exad_flipbox_front_background',
			[
				'label' => esc_html__( 'Background', 'essential-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'front_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-inner .exad-flip-box-front',
			]
		);

		$this->end_controls_section();



		/**
		 * -------------------------------------------
		 * Tab Style (Flipbox Back)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_back_end_style_section',
			[
				'label' => __( 'Back', 'bdthemes-element-pack' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		/**
		 * Condition: 'exad_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_control(
			'exad_flipbox_back_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back i' => 'color: {{VALUE}};',
				],
				
			]
		);

		/**
		 * Title
		 */
		$this->add_control(
			'exad_flipbox_back_title_heading',
			[
				'label' => esc_html__( 'Title Style', 'essential-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		/**
		 * Condition: 'exad_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_control(
			'exad_flipbox_back_title_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-title' => 'color: {{VALUE}};',
				],
				
			]
		);

		/**
		 * Condition: 'exad_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'exad_flipbox_back_title_typography',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-title',
			]
		);

		

		/**
		 * Content
		 */
		$this->add_control(
			'exad_flipbox_back_content_heading',
			[
				'label' => esc_html__( 'Content Style', 'essential-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		/**
		 * Condition: 'exad_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_control(
			'exad_flipbox_back_content_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#817e7e',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-description' => 'color: {{VALUE}};',
				],
				
			]
		);

		
		/**
		 * Condition: 'exad_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'exad_flipbox_back_content_typography',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-description',
				
			]
		);

		/**
		 * Rear Background
		 */
		$this->add_control(
			'exad_flipbox_rear_background',
			[
				'label' => esc_html__( 'Background', 'essential-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'rear_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-inner .exad-flip-box-back',
			]
		);


		$this->start_controls_tabs( 'exad_cta_button_tabs' );

			// Normal State Tab
			$this->start_controls_tab( 'exad_flipbox_btn_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_flipbox_btn_normal_text_color',
					[
						'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#FFF',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_flipbox_btn_normal_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#FF7F97',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action' => 'background: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_flipbox_btn_normal_border_color',
					[
						'label' => esc_html__( 'Border Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => 'transparent',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action' => 'border-color: {{VALUE}};',
						],
					]

				);

			
			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'exad_flipbox_btn_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_flipbox_btn_hover_text_color',
					[
						'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#FFF',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action:hover' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_flipbox_btn_hover_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => 'transparent',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action:hover' => 'background: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_flipbox_btn_hover_border_color',
					[
						'label' => esc_html__( 'Border Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#FFF',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action:hover' => 'border-color: {{VALUE}};',
						],
					]

				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();



		/**
		 * -------------------------------------------
		 * Tab Style (Flip Box Image)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_flipbox_imgae_style_settings',
			[
				'label' => esc_html__( 'Image Style', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
		     		'exad_flipbox_img_or_icon' => 'img'
		     	]
			]
		);

		$this->add_control(
		  'exad_flipbox_img_type',
		  	[
		   	'label'       	=> esc_html__( 'Image Type', 'essential-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'default',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'circle'  	=> esc_html__( 'Circle', 'essential-addons-elementor' ),
		     		'radius' 	=> esc_html__( 'Radius', 'essential-addons-elementor' ),
		     		'default' 	=> esc_html__( 'Default', 'essential-addons-elementor' ),
		     	],
		     	'prefix_class' => 'exad-flipbox-img-',
		     	'condition' => [
		     		'exad_flipbox_img_or_icon' => 'img'
		     	]
		  	]
		);

		/**
		 * Condition: 'exad_flipbox_img_type' => 'radius'
		 */
		$this->add_control(
			'exad_filpbox_img_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .exad-elements-flip-box-icon-image img' => 'border-radius: {{SIZE}}px;',
					'{{WRAPPER}} .flipbox-back-image-icon img' => 'border-radius: {{SIZE}}px;',
				],
				'condition' => [
					'exad_flipbox_img_or_icon' => 'img',
					'exad_flipbox_img_type' => 'radius'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flip Box Icon Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_flipbox_icon_style_settings',
			[
				'label' => esc_html__( 'Icon Style', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
		     		'exad_flipbox_img_or_icon' => 'icon'
		     	]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'exad_flipbox_border',
					'label' => esc_html__( 'Border', 'essential-addons-elementor' ),
					'selector' => '{{WRAPPER}} .exad-elements-flip-box-icon-image',
					'condition' => [
						'exad_flipbox_img_or_icon' => 'icon'
					]
				]
		);

		$this->add_responsive_control(
			'exad_flipbox_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'essential-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
	 				'{{WRAPPER}} .exad-elements-flip-box-icon-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
	 			],
			]
		);

		$this->add_control(
			'exad_flipbox_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'min'	=> 0,
						'step'	=> 1,
						'max'	=> 500,
					],
					'%'	=> [
						'min'	=> 0,
						'step'	=> 3,
						'max'	=> 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .exad-elements-flip-box-icon-image'	=> 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_flipbox_img_or_icon' => 'icon'
				]
			]
		);
		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Tab Style (Flip Box Button Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_flipbox_button_style_settings',
			[
				'label' => esc_html__( 'Button Style', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'flipbox_link_type'	=> 'button'
				]
			]
		);

		$this->start_controls_tabs( 'flipbox_button_style_settings' );

			$this->start_controls_tab(
				'flipbox_button_normal_style',
				[
					'label'	=> __( 'Normal', 'essential-addons-elementor' )
				]
			);
				$this->add_responsive_control(
					'exad_flipbox_button_margin',
					[
						'label' => esc_html__( 'Margin', 'essential-addons-elementor' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em' ],
						'selectors' => [
			 				'{{WRAPPER}} .exad-elements-flip-box-container .flipbox-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
			 			],
					]
				);

				$this->add_responsive_control(
					'exad_flipbox_button_padding',
					[
						'label' => esc_html__( 'Padding', 'essential-addons-elementor' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em' ],
						'selectors' => [
			 				'{{WRAPPER}} .exad-elements-flip-box-container .flipbox-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
			 			],
					]
				);

				$this->add_control(
					'exad_flipbox_button_color',
					[
						'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .exad-elements-flip-box-container .flipbox-button' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_flipbox_button_bg_color',
					[
						'label' => esc_html__( 'Background', 'essential-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#000000',
						'selectors' => [
							'{{WRAPPER}} .exad-elements-flip-box-container .flipbox-button' => 'background: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_flipbox_button_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'essential-addons-elementor' ),
						'type' => Controls_Manager::SLIDER,
						'size_units'	=> [ 'px' ],
						'range' => [
							'px' => [
								'min'	=> 0,
								'step'	=> 1,
								'max'	=> 100,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .exad-elements-flip-box-container .flipbox-button'	=> 'border-radius: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
		            	'name'		=> 'exad_flipbox_button_typography',
						'selector'	=> '{{WRAPPER}} .exad-elements-flip-box-container .flipbox-button'
					]
				);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'flipbox_button_hover_style',
				[
					'label'	=> __( 'Hover', 'essential-addons-elementor' )
				]
			);
				$this->add_control(
					'exad_flipbox_button_hover_color',
					[
						'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .exad-elements-flip-box-container .flipbox-button:hover' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_flipbox_button_hover_bg_color',
					[
						'label' => esc_html__( 'Background', 'essential-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#000000',
						'selectors' => [
							'{{WRAPPER}} .exad-elements-flip-box-container .flipbox-button:hover' => 'background: {{VALUE}};',
						],
					]
				);
			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}


	protected function render() {

   		$settings = $this->get_settings_for_display();

	?>

	<div class="exad-flip-box">
      	<div class="exad-flip-box-inner <?php echo esc_attr( $settings['exad_flipbox_style'] ); ?>">
        	<div class="exad-flip-box-front">
          		<div class="exad-flip-box-front-image">
	            	<i class="<?php echo esc_attr( $settings['exad_flipbox_front_icon'] ); ?>"></i>
        		</div>
          		<h5 class="exad-flip-box-front-title"><?php echo $settings['exad_flipbox_front_title']; ?></h5>
		        <p class="exad-flip-box-front-description">
		            <?php echo $settings['exad_flipbox_front_description']; ?>
		        </p>
        	</div>
	        <div class="exad-flip-box-back">
	          	<i class="<?php echo esc_attr( $settings['exad_flipbox_back_icon'] ); ?>"></i>
	          	<h5 class="exad-flip-box-back-title"><?php echo $settings['exad_flipbox_back_title']; ?></h5>
		        <p class="exad-flip-box-back-description">
		            <?php echo $settings['exad_flipbox_back_description']; ?>
		        </p>
		        <a href="<?php echo esc_url( $settings['exad_flipbox_button_link']['url'] ); ?>" class="exad-flip-box-back-action"><?php echo $settings['exad_flipbox_button_text']; ?></a>
	        </div>
      	</div>
    </div>


	<?php
	}

	protected function content_template() { }
}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Flip_Box() );