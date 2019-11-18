<?php
namespace Elementor;

class Exad_Testimonial_Carousel extends Widget_Base {

	private $lightbox_slide_index;
	private $slide_prints_count = 0;

	public function get_name() {
		return 'exad-testimonial-carousel';
	}

	public function get_title() {
		return esc_html__( 'Testimonial Carousel', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-testimonial-carousel';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_script_depends() {
		return [ 'jquery-slick' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_testimonial_carousel',
			[
				'label' => esc_html__( 'Contents', 'exclusive-addons-elementor' ),
			]
		);

		$testimonial_repeater = new Repeater();

		$testimonial_repeater->add_control(
			'exad_testimonial_carousel_name',
			[
				'label' => esc_html__( 'Name', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'John Doe', 'exclusive-addons-elementor' ),
			]
		);
		
		$testimonial_repeater->add_control(
			'exad_testimonial_carousel_designation',
			[
				'label' => esc_html__( 'Client Details', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'My Designation', 'exclusive-addons-elementor' ),
			]
		);
		
		$testimonial_repeater->add_control(
			'exad_testimonial_carousel_image',
			[
				'label' => __( 'Client Avatar', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$testimonial_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'exad_testimonial_carousel_image[url]!' => '',
				],
			]
		);

		$testimonial_repeater->add_control(
			'exad_testimonial_carousel_description',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
                    'active' => true,
                ],
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt labore et dolore magna aliqua. ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. duis aute irure dolor in reprehenderit in voluptate velit esse cillum.', 'exclusive-addons-elementor' ),
			]
		);

		$testimonial_repeater->add_control(
			'exad_testimonial_carousel_enable_rating',
			[
				'label' => esc_html__( 'Display Rating?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);


		$testimonial_repeater->add_control(
		  'exad_testimonial_rating_number',
		  [
		     'label'       => __( 'Rating Number', 'exclusive-addons-elementor' ),
		     'type' => Controls_Manager::SELECT,
		     'default' => 5,
		     'options' => [
		     	1 => __( '1', 'exclusive-addons-elementor' ),
		     	2 => __( '2', 'exclusive-addons-elementor' ),
		     	3 => __( '3', 'exclusive-addons-elementor' ),
		     	4 => __( '4', 'exclusive-addons-elementor' ),
		     	5 => __( '5', 'exclusive-addons-elementor' ),
		     ],
			'condition' => [
				'exad_testimonial_carousel_enable_rating' => 'yes',
			],
		  ]
		);

		
		$this->add_control(
			'testimonial_carousel_repeater',
			[
				'label' => esc_html__( 'Testimonial Carousel', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $testimonial_repeater->get_controls(),
				'title_field' => '{{{ exad_testimonial_carousel_name }}}',
				'default' => [
					[
						'exad_testimonial_carousel_name' => __( 'Testimonial #1', 'exclusive-addons-elementor' ),
						'exad_testimonial_carousel_description' => __( 'Neque enim omnis et quidem temporibus quo in. Tenetur quaerat repellendus. Veniam quisquam aut saepe inventore incidunt et rerum….', 'exclusive-addons-elementor' ),
					],
					[
						'exad_testimonial_carousel_name' => __( 'Testimonial #2', 'exclusive-addons-elementor' ),
						'exad_testimonial_carousel_description' => __( 'Neque enim omnis et quidem temporibus quo in. Tenetur quaerat repellendus. Veniam quisquam aut saepe inventore incidunt et rerum….', 'exclusive-addons-elementor' ),
					],
					[
						'exad_testimonial_carousel_name' => __( 'Testimonial #3', 'exclusive-addons-elementor' ),
						'exad_testimonial_carousel_description' => __( 'Neque enim omnis et quidem temporibus quo in. Tenetur quaerat repellendus. Veniam quisquam aut saepe inventore incidunt et rerum….', 'exclusive-addons-elementor' ),
					],
					[
						'exad_testimonial_carousel_name' => __( 'Testimonial #4', 'exclusive-addons-elementor' ),
						'exad_testimonial_carousel_description' => __( 'Neque enim omnis et quidem temporibus quo in. Tenetur quaerat repellendus. Veniam quisquam aut saepe inventore incidunt et rerum….', 'exclusive-addons-elementor' ),
					]
			]	
			]
		);

		$this->end_controls_section();
		

		$this->start_controls_section(
			'section_test_carousel_settings',
			[
				'label' => esc_html__( 'Carousel Settings', 'exclusive-addons-elementor' ),
			]
		);

		$slides_per_view = range( 1, 6 );
		$slides_per_view = array_combine( $slides_per_view, $slides_per_view );

		$this->add_control(
			'exad_testimonial_per_view',
			[
				'type'           => Controls_Manager::SELECT,
				'label'          => esc_html__( 'Columns', 'exclusive-addons-elementor' ),
				'options'        => $slides_per_view,
				'default'        => '3',
			]
		);

		$this->add_control(
			'exad_testimonial_slides_to_scroll',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Items to Scroll', 'exclusive-addons-elementor' ),
				'options'   => $slides_per_view,
				'default'   => '1',
				'separator' => 'after',
			]
		);

		$this->add_control(
            'exad_testimonial_carousel_nav',
            [
                'label'   => esc_html__( 'Navigation Style', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'arrows',
                'options' => [
                    'arrows' => esc_html__( 'Arrows', 'exclusive-addons-elementor' ),
                    'nav-dots'   => esc_html__( 'Dots', 'exclusive-addons-elementor' ),
                    'both'   => esc_html__( 'Arrows and Dots', 'exclusive-addons-elementor' ),
                    'none'   => esc_html__( 'None', 'exclusive-addons-elementor' )
                    
                ],
            ]
        );



		$this->add_control(
			'exad_testimonial_transition_duration',
			[
				'label'   => esc_html__( 'Transition Duration', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->add_control(
			'exad_testimonial_autoplay',
			[
				'label'     => esc_html__( 'Autoplay', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes'
			]
		);

		$this->add_control(
			'exad_testimonial_autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'exad_testimonial_autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_loop',
			[
				'label'   => esc_html__( 'Infinite Loop', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'exad_testimonial_pause',
			[
				'label'     => esc_html__( 'Pause on Hover', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'exad_testimonial_autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_center_mode',
			[
				'label'     => esc_html__( 'Center Mode', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
			]
		);

		$this->end_controls_section();

		/*
		* Testimonial Carousel container Styling Section
		*/
		$this->start_controls_section(
			'exad_section_testimonial_carousel_styles_presets',
			[
				'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_container_alignment',
			[
				'label'   => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'exad-testimonial-align-left' => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-angle-left'
					],
					'exad-testimonial-align-center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-angle-up'
					],
					'exad-testimonial-align-right' => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-angle-right'
					],
					'exad-testimonial-align-bottom' => [
						'title' => __( 'Bottom', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-angle-down'
					]
				],
				'default' => 'exad-testimonial-align-left'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_testimonial_carousel_container_background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .exad-testimonial-wrapper',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_testimonial_carousel_container_border',
				'label' => __( 'Border', 'xclusive-addons-elementor' ),
				'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                        ],
                    ],
                    'color' => [
                        'default' => '#e3e3e3',
                    ],
				],
				'selector' => '{{WRAPPER}} .exad-testimonial-wrapper',
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_container_radius',
			[
				'label' => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_container_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '20',
					'right' => '20',
					'bottom' => '20',
					'left' => '20',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_container_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_testimonial_carousel_container_box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-testimonial-wrapper',
			]
		);

		$this->end_controls_section();

		/**
		 * Testimonial Carousel Image Style Section
		 */
		$this->start_controls_section(
			'exad_testimonial_carousel_image_style',
			[
				'label' => esc_html__( 'Reviewer Image', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_image_box',
			[
				'label' => __( 'Image Box', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off' => __( 'OFF', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_image_box_height',
			[
				'label' => __( 'Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-thumb'=> 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_testimonial_carousel_image_box' => 'yes'
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_image_box_width',
			[
				'label' => __( 'Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'separator' => 'after',
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-thumb'=> 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-testimonial-image-align-left .exad-testimonial-thumb, {{WRAPPER}} .exad-testimonial-image-align-right .exad-testimonial-thumb'=> 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-testimonial-image-align-left .exad-testimonial-reviewer, {{WRAPPER}} .exad-testimonial-image-align-right .exad-testimonial-reviewer'=> 'width: calc( 100% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .exad-testimonial-wrapper.exad-testimonial-align-left .exad-testimonial-content-wrapper-arrow::before'=> 'left: calc( {{SIZE}}{{UNIT}} / 2 );',
					'{{WRAPPER}} .exad-testimonial-wrapper.exad-testimonial-align-right .exad-testimonial-content-wrapper-arrow::before'=> 'right: calc(( {{SIZE}}{{UNIT}} / 2) - 10px);',
				],
				'condition' => [
					'exad_testimonial_carousel_image_box' => 'yes'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_testimonial_carousel_image_box_border',
				'label' => __( 'Border', 'xclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-testimonial-thumb',
				'condition' => [
					'exad_testimonial_carousel_image_box' => 'yes'
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_image_box_radius',
			[
				'label' => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator' => 'after',
				'default' => [
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50',
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .exad-testimonial-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_testimonial_carousel_image_box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-testimonial-thumb',
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_image_box_margin_bottom',
			[
				'label' => __( 'Margin Bottom', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-thumb'=> 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_testimonial_carousel_container_alignment' => 'exad-testimonial-align-bottom'
				],
			]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Carousel Rating Style
		 */

		$this->start_controls_section(
			'exad_testimonial_carousel_rating_style',
			[
				'label' => esc_html__( 'Rating', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_rating_size',
			[
				'label' => __( 'Icon Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-carousel-ratings li i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_rating_icon_margin',
			[
				'label' => __( 'Icon Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 30,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-carousel-ratings li:not(:last-child) i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_rating_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-carousel-ratings' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'exad_testimonial_carousel_rating_tabs' );

			// normal state rating
			$this->start_controls_tab( 'exad_testimonial_carousel_rating_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_testimonial_carousel_rating_normal_color',
					[
						'label' => __( 'Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#222222',
						'selectors' => [
							'{{WRAPPER}} .exad-testimonial-carousel-ratings li i' => 'color: {{VALUE}};',
						],
					]
				);

			$this->end_controls_tab();

			// hover state rating
			$this->start_controls_tab( 'exad_testimonial_carousel_rating_active', [ 'label' => esc_html__( 'Active', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_testimonial_carousel_rating_active_color',
					[
						'label' => __( 'Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#ff5b84',
						'selectors' => [
							'{{WRAPPER}} .exad-testimonial-carousel-ratings li.exad-testimonial-carousel-ratings-active i' => 'color: {{VALUE}};',
						],
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this-> end_controls_section();

		/**
		 * Testimonial Carousel Navigation Style
		 */

		$this->start_controls_section(
            'section_testimonial_carousel_navigation_section',
            [
                'label' => __('Navigation', 'exclusive-addons-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_testimonial_carousel_nav!' => 'none',
				],
            ]
		);
		/**
		 * Testimonial Carousel Navigation Arrows Style
		 */
		$this->add_control(
			'exad_testimonial_carousel_nav_arrows_style',
			[
				'label' => __( 'Arrows', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'separator' => 'after',
				'condition' => [
					'exad_testimonial_carousel_nav' => [ 'both', 'arrows' ],
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_nav_arrows_radius',
			[
				'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-carousel-prev, {{WRAPPER}} .exad-testimonial-carousel-next' => 'border-Radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'exad_testimonial_carousel_nav' => ['both','arrows'],
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_nav_arrows_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-carousel-prev i, {{WRAPPER}} .exad-testimonial-carousel-next i' => 'font-size: {{SIZE}}px;',
				],
				'condition' => [
					'exad_testimonial_carousel_nav' => ['both','arrows'],
				],
			]
		);

		$this->start_controls_tabs( 'exad_testimonial_carousel_navigation_arrows_tabs' ,['condition' => ['exad_testimonial_carousel_nav' => ['both','arrows'],]]);
		$this->start_controls_tab( 'exad_testimonial_carousel_navigation_arrows_control', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_testimonial_carousel_arrow_background_color',
				[
					'label' => esc_html__( 'Arrow Background', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#b8bfc7',
					'selectors' => [
						'{{WRAPPER}} .exad-testimonial-carousel-prev, {{WRAPPER}} .exad-testimonial-carousel-next' => 'background: {{VALUE}};',
					],
					'condition' => [
						'exad_testimonial_carousel_nav' => ['both','arrows'],
					],
				]
			);

			$this->add_control(
				'exad_testimonial_carousel_arrow_color',
				[
					'label' => esc_html__( 'Arrow Color', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .exad-testimonial-carousel-prev, {{WRAPPER}} .exad-testimonial-carousel-next' => 'color: {{VALUE}};',
					],
					'condition' => [
						'exad_testimonial_carousel_nav' => ['both','arrows'],
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'exad_testimonial_carousel_arrow_box_shadow_normal',
					'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
					'separator' => 'after',
					'selector' => '{{WRAPPER}} .exad-testimonial-carousel-prev, {{WRAPPER}} .exad-testimonial-carousel-next',
					'condition' => [
						'exad_testimonial_carousel_nav' => ['both','arrows'],
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'exad_testimonial_carousel_nav_border_normal',
					'label' => __( 'Border', 'exclusive-addons-elementor' ),
					'selector' => '{{WRAPPER}} .exad-testimonial-carousel-prev, {{WRAPPER}} .exad-testimonial-carousel-next',
					'condition' => [
						'exad_testimonial_carousel_nav' => ['both','arrows']
					],
				]
			);
			
			$this->end_controls_tab();

		$this->start_controls_tab( 'exad_testimonial_carousel_arrow_hover_control', [ 'label' => esc_html__( 'Active/Hover', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_testimonial_carousel_arrow_hover_background_color',
				[
					'label' => esc_html__( 'Arrow Background', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#917cff',
					'selectors' => [
						'{{WRAPPER}} .exad-testimonial-carousel-prev:hover, {{WRAPPER}} .exad-testimonial-carousel-next:hover' => 'background: {{VALUE}};',
					],
					'condition' => [
						'exad_testimonial_carousel_nav' => ['both','arrows'],
					],
				]
			);

			$this->add_control(
				'exad_testimonial_carousel_arrow_hover_color',
				[
					'label' => esc_html__( 'Arrow Color', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .exad-testimonial-carousel-prev:hover, {{WRAPPER}} .exad-testimonial-carousel-next:hover' => 'color: {{VALUE}};',
					],
					'condition' => [
						'exad_testimonial_carousel_nav' => ['both','arrows'],
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'exad_testimonial_carousel_arrow_box_shadow_hover',
					'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
					'separator' => 'after',
					'selector' => '{{WRAPPER}} .exad-testimonial-carousel-prev:hover, {{WRAPPER}} .exad-testimonial-carousel-next:hover',
					'condition' => [
						'exad_testimonial_carousel_nav' => ['both','arrows'],
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'exad_testimonial_carousel_arrow_border_hover',
					'label' => __( 'Border', 'exclusive-addons-elementor' ),
					'selector' => '{{WRAPPER}} .exad-testimonial-carousel-prev:hover, {{WRAPPER}} .exad-testimonial-carousel-next:hover',
					'condition' => [
						'exad_testimonial_carousel_nav' => ['both','arrows']
					],
				]
			);
			
			$this->end_controls_tab();
		
		$this->end_controls_tabs();


		/**
		 * Testimonial Carousel Navigation Dots Style
		 */

		$this->add_control(
			'exad_testimonial_carousel_nav_dots_style',
			[
				'label' => __( 'Dots', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => [
					'exad_testimonial_carousel_nav' => [ 'nav-dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_nav_dots_height',
			[
				'label' => esc_html__( 'Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-carousel .slick-dots li button' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_testimonial_carousel_nav' => [ 'nav-dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_nav_dots_width',
			[
				'label' => esc_html__( 'Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-carousel .slick-dots li button' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_testimonial_carousel_nav' => [ 'nav-dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_nav_dots_radius',
			[
				'label' => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-carousel .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'exad_testimonial_carousel_nav' => [ 'nav-dots', 'both' ],
				],
			]
		);
	

		$this->start_controls_tabs( 'exad_testimonial_carousel_navigation_dots_tabs' ,
			[
				'condition' => [
					'exad_testimonial_carousel_nav' => [ 'nav-dots', 'both' ],
				]
			]
		);

		$this->start_controls_tab( 'exad_testimonial_carousel_navigation_dots_control_normal', [ 
			'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' )
		] );

		$this->add_control(
			'exad_testimonial_carousel_dot_color_normal',
			[
				'label' => esc_html__( 'Dot Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-carousel .slick-dots li button' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'exad_testimonial_carousel_nav' => [ 'nav-dots', 'both' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_testimonial_carousel_dot_border_normal',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-testimonial-carousel .slick-dots li button',
				'condition' => [
					'exad_testimonial_carousel_nav' => [ 'nav-dots', 'both' ],
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab( 'exad_testimonial_carousel_navigation_dots_control_hover', [ 'label' => esc_html__( 'Active/Hover', 'exclusive-addons-elementor' ) ] );

		$this->add_control(
			'exad_testimonial_carousel_dot_hover_color',
			[
				'label' => esc_html__( 'Dot Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#917cff',
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-carousel .slick-dots li.slick-active button, {{WRAPPER}} .exad-testimonial-carousel .slick-dots li button:hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_testimonial_carousel_nav' => [ 'nav-dots', 'both' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_testimonial_carousel_nav_border_hover',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-testimonial-carousel .slick-dots li button:hover, {{WRAPPER}} .exad-testimonial-carousel .slick-dots li.slick-active button',
				'condition' => [
					'exad_testimonial_carousel_nav' => [ 'nav-dots', 'both' ],
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();

        /**
		 * Testimonial Carousel Description Style Section
		 */
		$this->start_controls_section(
			'exad_testimonial_carousel_description_style',
			[
				'label' => esc_html__( 'Testimonial', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_description_bg_color',
			[
				'label' => __( 'Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-content-wrapper' => 'background: {{VALUE}};',
					'{{WRAPPER}} .exad-testimonial-content-wrapper-arrow::before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_testimonial_carousel_description_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-testimonial-description',
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_description_color',
			[
				'label' => __( 'Text Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_description_radius',
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
					'{{WRAPPER}} .exad-testimonial-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_description_spacing_bottom',
			[
				'label' => __( 'Bottom Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-content-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_description_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_testimonial_carousel_description_box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-testimonial-content-wrapper',
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_description_arrow_enable',
			[
				'label' => __( 'Show Arrow', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off' => __( 'OFF', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
				'separator' => 'before',
			]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Riviewer Style Section
		 */
		$this->start_controls_section(
			'exad_testimonial_carousel_reviewer_style',
			[
				'label' => esc_html__( 'Rivewer', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_reviewer_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-reviewer-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_reviewer_spacing',
			[
				'label' => __( 'Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-wrapper.exad-testimonial-align-left .exad-testimonial-reviewer-wrapper .exad-testimonial-reviewer' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-testimonial-wrapper.exad-testimonial-align-right .exad-testimonial-reviewer-wrapper .exad-testimonial-reviewer' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_testimonial_carousel_container_alignment' => ['exad-testimonial-align-left', 'exad-testimonial-align-right'],
				]
			]
		);

		/**
		 * Testimonial Title Style Section
		 */

		$this->add_control(
			'exad_testimonial_carousel_title_style',
			[
				'label' => __( 'Reviewer Title', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_testimonial_carousel_title_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-testimonial-name',
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_title_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_title_margin',
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
					'{{WRAPPER}} .exad-testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		/**
		 * Testimonial Designation Style Section
		 */

		$this->add_control(
			'exad_testimonial_carousel_designation_style',
			[
				'label' => __( 'Reviewer Designation', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_testimonial_carousel_designation_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-testimonial-designation',
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_designation_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-designation' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_carousel_designation_margin',
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
					'{{WRAPPER}} .exad-testimonial-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Carousel other style Style Section
		 */
		$this->start_controls_section(
			'exad_testimonial_carousel_other_style',
			[
				'label' => esc_html__( 'Advanced Option', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'exad_testimonial_carousel_other_tabs' );

			// normal state rating
			$this->start_controls_tab( 'exad_testimonial_carousel_other_style_inactive', [ 'label' => esc_html__( 'Inactive', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_testimonial_carousel_slide_opacity_inactive',
					[
						'label' => __( 'Inactive Item Opacity', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::NUMBER,
						'min' => 0,
						'max' => 1,
						'selectors' => [
							'{{WRAPPER}} .exad-testimonial-wrapper.slick-slide' => 'opacity: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_testimonial_carousel_slide_item_scale_inactive',
					[
						'label' => __( 'Scale', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::NUMBER,
						'min' => 0,
						'max' => 5,
						'selectors' => [
							'{{WRAPPER}} .exad-testimonial-wrapper.slick-slide' => 'transform: scale( {{VALUE}} );',
						],
					]
				);

			$this->end_controls_tab();

			// hover state rating
			$this->start_controls_tab( 'exad_testimonial_carousel_other_style_active', [ 'label' => esc_html__( 'Active', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_testimonial_carousel_slide_opacity_active',
					[
						'label' => __( 'Active Item Opacity', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::NUMBER,
						'min' => 0,
						'max' => 1,
						'default' => '1',
						'selectors' => [
							'{{WRAPPER}} .exad-testimonial-wrapper.slick-slide.slick-current.slick-active' => 'opacity: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_testimonial_carousel_slide_item_scale_active',
					[
						'label' => __( 'Scale', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::NUMBER,
						'min' => 0,
						'max' => 5,
						'default' => '1',
						'selectors' => [
							'{{WRAPPER}} .exad-testimonial-wrapper.slick-slide.slick-current.slick-active' => 'transform: scale( {{VALUE}} );',
						],
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this-> end_controls_section();

	}


	protected function render_testimonial_carousel_rating( $rating, $testimonial ) {
		?>
		<ul class="exad-testimonial-carousel-ratings">
          
        <?php 
          	for( $i = 1; $i <= 5; $i++ ) {
          		if( $testimonial['exad_testimonial_rating_number'] >= $i ) {
          			$rating_active_class = 'class="exad-testimonial-carousel-ratings-active"';
          		} else {
          			$rating_active_class = '';
          		}
          		echo '<li ' . $rating_active_class . '><i class="fa fa-star-o"></i></li>';
          	}
        ?>
          
        </ul>

    <?php    
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
    
        $this->add_render_attribute( 
			'exad-testimonial-carousel', 
			[ 
				'class' => [ 'exad-testimonial-carousel-wrapper', 'exad-testimonial-carousel' ],
				'data-carousel-nav' => $settings['exad_testimonial_carousel_nav'],
	    		'data-speed' => $settings['exad_testimonial_transition_duration'],
	    		'data-slidestoscroll' => $settings['exad_testimonial_slides_to_scroll'],
			]
		);

		$this->add_render_attribute( 'exad-testimonial-carousel', 'data-slidestoshow', $settings['exad_testimonial_per_view'] );

		if ( $settings['exad_testimonial_pause'] == 'yes' ) {
            $this->add_render_attribute( 'exad-testimonial-carousel', 'data-pauseonhover', "true");
        }


		if ( $settings['exad_testimonial_autoplay'] == 'yes' ) {
            $this->add_render_attribute( 'exad-testimonial-carousel', 'data-autoplay', "true");
            $this->add_render_attribute( 'exad-testimonial-carousel', 'data-autoplayspeed', $settings['exad_testimonial_autoplay_speed'] );
		}

		if ( $settings['exad_testimonial_center_mode'] == 'yes' ) {
			$this->add_render_attribute( 'exad-testimonial-carousel', 'data-centermode', "true");
		}


		if ( $settings['exad_testimonial_loop'] == 'yes' ) {
            $this->add_render_attribute( 'exad-testimonial-carousel', 'data-loop', "true");
		}
		
		$this->add_render_attribute( 'exad_testimonial_content_wrapper', 'class', 'exad-testimonial-content-wrapper' );

		if ($settings['exad_testimonial_carousel_description_arrow_enable'] === 'yes'){
			$this->add_render_attribute( 'exad_testimonial_content_wrapper', 'class', 'exad-testimonial-content-wrapper-arrow' );
		}

        ?>

		<div <?php echo $this->get_render_attribute_string( 'exad-testimonial-carousel' ); ?>>
			<?php

			foreach ( $settings['testimonial_carousel_repeater'] as $testimonial ) : 

			$testimonial_carousel_image = $testimonial['exad_testimonial_carousel_image'];
			$testimonial_carousel_image_url = Group_Control_Image_Size::get_attachment_image_src( $testimonial_carousel_image['id'], 'thumbnail', $testimonial );

			if( empty( $testimonial_carousel_image_url ) ) : $testimonial_carousel_image_url = $testimonial_carousel_image['url']; else: $testimonial_carousel_image_url = $testimonial_carousel_image_url; endif;
			
			?>
				<div class="exad-testimonial-wrapper <?php echo esc_attr( $settings['exad_testimonial_carousel_container_alignment'] ); ?>">
					<div class="exad-testimonial-wrapper-inner">
						<div <?php echo $this->get_render_attribute_string( 'exad_testimonial_content_wrapper' ); ?> >
							<?php if ( !empty( $testimonial['exad_testimonial_carousel_description'] ) ) { ?>
								<p class="exad-testimonial-description" ><?php echo esc_html( $testimonial['exad_testimonial_carousel_description'] ) ?></p>
							<?php } ?>
							<?php if ( $testimonial['exad_testimonial_carousel_enable_rating'] === 'yes' ) { ?>
								<?php $this->render_testimonial_carousel_rating( $ratings, $testimonial ); ?>
							<?php } ?>
						</div>
						<div class="exad-testimonial-reviewer-wrapper">
							<?php if( $settings['exad_testimonial_carousel_container_alignment'] === 'exad-testimonial-align-left' || $settings['exad_testimonial_carousel_container_alignment'] === 'exad-testimonial-align-center' || $settings['exad_testimonial_carousel_container_alignment'] === 'exad-testimonial-align-right' ) { ?>
								<?php if ( !empty( $testimonial_carousel_image_url ) ) { ?>
									<div class="exad-testimonial-thumb">
										<img src="<?php echo esc_url($testimonial_carousel_image_url); ?>" alt="<?php echo esc_attr( $testimonial['exad_testimonial_carousel_name'] ); ?>">
									</div>
								<?php } ?>
								<div class="exad-testimonial-reviewer">
									<?php if ( !empty( $testimonial['exad_testimonial_carousel_name'] ) ) { ?>
										<h4 class="exad-testimonial-name" ><?php echo esc_html( $testimonial['exad_testimonial_carousel_name'] ) ?></h4>
									<?php } ?>
									<?php if ( !empty( $testimonial['exad_testimonial_carousel_designation'] ) ) { ?>
										<span class="exad-testimonial-designation" ><?php echo esc_html( $testimonial['exad_testimonial_carousel_designation'] ) ?></span>
									<?php } ?>
								</div>
							<?php } ?>
							<?php if( $settings['exad_testimonial_carousel_container_alignment'] === 'exad-testimonial-align-bottom' ) { ?>
								<div class="exad-testimonial-reviewer">
									<?php if ( !empty( $testimonial['exad_testimonial_carousel_name'] ) ) { ?>
										<h4 class="exad-testimonial-name" ><?php echo esc_html( $testimonial['exad_testimonial_carousel_name'] ) ?></h4>
									<?php } ?>
									<?php if ( !empty( $testimonial['exad_testimonial_carousel_designation'] ) ) { ?>
										<span class="exad-testimonial-designation" ><?php echo esc_html( $testimonial['exad_testimonial_carousel_designation'] ) ?></span>
									<?php } ?>
								</div>
								<?php if ( !empty( $testimonial_carousel_image_url ) ) { ?>
									<div class="exad-testimonial-thumb">
										<img src="<?php echo esc_url($testimonial_carousel_image_url); ?>" alt="<?php echo esc_attr( $testimonial['exad_testimonial_carousel_name'] ); ?>">
									</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
				</div>

			<?php endforeach; ?>
		</div>	
	<?php	
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Testimonial_Carousel() );