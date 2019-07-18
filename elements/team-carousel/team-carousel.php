<?php
namespace Elementor;

class Exad_Team_Carousel extends Widget_Base {

	public function get_name() {
		return 'exad-team-carousel';
	}

	public function get_title() {
		return esc_html__( 'Team Carousel', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-person';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_script_depends() {
		return [ 'jquery-slick' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_team_carousel',
			[
				'label' => esc_html__( 'Contents', 'exclusive-addons-elementor' ),
			]
		);

		$team_repeater = new Repeater();

		/*
		* Team Member Image
		*/
		$team_repeater->add_control(
			'exad_team_carousel_image',
			[
				'label' => __( 'Image', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$team_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'exad_team_carousel_image[url]!' => '',
				],
			]
		);

		$team_repeater->add_control(
			'exad_team_carousel_name',
			[
				'label' => esc_html__( 'Name', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'John Doe', 'exclusive-addons-elementor' ),
			]
		);
		
		$team_repeater->add_control(
			'exad_team_carousel_designation',
			[
				'label' => esc_html__( 'Designation', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'My Designation', 'exclusive-addons-elementor' ),
			]
		);
		
		$team_repeater->add_control(
			'exad_team_carousel_description',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Add team member details here', 'exclusive-addons-elementor' ),
			]
		);

		$team_repeater->add_control(
			'exad_team_carousel_enable_social_profiles',
			[
				'label' => esc_html__( 'Display Social Profiles?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$team_repeater->add_control(
			'exad_team_carousel_facebook_link',
			[
				'label' => __( 'Facebook URL', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'exad_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		$team_repeater->add_control(
			'exad_team_carousel_twitter_link',
			[
				'label' => __( 'Twitter URL', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'exad_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		$team_repeater->add_control(
			'exad_team_carousel_instagram_link',
			[
				'label' => __( 'Instagram URL', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'exad_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		$team_repeater->add_control(
			'exad_team_carousel_linkedin_link',
			[
				'label' => __( 'Linkedin URL', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'exad_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		$team_repeater->add_control(
			'exad_team_carousel_dribbble_link',
			[
				'label' => __( 'Dribbble URL', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'exad_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		
		$this->add_control(
			'team_carousel_repeater',
			[
				'label' => esc_html__( 'Team Carousel', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $team_repeater->get_controls(),
				'title_field' => '{{{ exad_team_carousel_name }}}',
				'default' => [
						[
							'exad_team_carousel_name' => __( 'Member #1', 'exclusive-addons-elementor' ),
							'exad_team_carousel_description' => __( 'Add team member details here', 'exclusive-addons-elementor' ),
						],
						[
							'exad_team_carousel_name' => __( 'Member #2', 'exclusive-addons-elementor' ),
							'exad_team_carousel_description' => __( 'Add team member details here', 'exclusive-addons-elementor' ),
						],
						[
							'exad_team_carousel_name' => __( 'Member #3', 'exclusive-addons-elementor' ),
							'exad_team_carousel_description' => __( 'Add team member details here', 'exclusive-addons-elementor' ),
						],
						[
							'exad_team_carousel_name' => __( 'Member #4', 'exclusive-addons-elementor' ),
							'exad_team_carousel_description' => __( 'Add team member details here', 'exclusive-addons-elementor' ),
						],
				]	
			]
		);


		$this->end_controls_section();

		/*
		* Team Members Styling Section
		*/
		$this->start_controls_section(
			'exad_section_team_carousel_styles_preset',
			[
				'label' => esc_html__( 'General Styles', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'exad_team_carousel_preset',
			[
				'label' => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '-style-one',
				'options' => [
					'-style-one' => esc_html__( 'Style 1 (Pro)', 'exclusive-addons-elementor' ),
					'-style-two' => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
					'-style-three' => esc_html__( 'Style 3', 'exclusive-addons-elementor' ),
					'-style-four' => esc_html__( 'Style 4 (Pro)', 'exclusive-addons-elementor' ),
					'-style-five' => esc_html__( 'Style 5', 'exclusive-addons-elementor' ),
					'-style-six' => esc_html__( 'Style 6 (Pro)', 'exclusive-addons-elementor' ),
					'-style-seven' => esc_html__( 'Style 7 (Pro)', 'exclusive-addons-elementor' ),
					'-style-eight' => esc_html__( 'Style 8 (Pro)', 'exclusive-addons-elementor' ),
					'-style-nine' => esc_html__( 'Style 9 (Pro)', 'exclusive-addons-elementor' ),
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_avatar_bg',
			[
				'label' => esc_html__( 'Curved SVG Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#826EFF',
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-style-two .exad-team-member-thumb svg.team-avatar-bg,
					{{WRAPPER}} .exad-team-member-style-six .exad-team-member-content svg path' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_preset' => ['-style-two', '-style-six'],
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_bg',
			[
				'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f9f9f9',
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-basic, {{WRAPPER}} .exad-team-member-style-two, {{WRAPPER}} .exad-team-member-style-three,
					 {{WRAPPER}} .exad-team-member-rounded, {{WRAPPER}} .exad-team-carousel-style-four .exad-team-carousel-style-four-inner,
					 {{WRAPPER}} .exad-team-carousel-style-nine .exad-team-carousel-style-nine-inner .exad-team-member-content, {{WRAPPER}} .exad-team-carousel-style-one .exad-team-carousel-style-one-inner,
					 {{WRAPPER}} .exad-team-member-style-six, {{WRAPPER}} .exad-team-member-style-seven, {{WRAPPER}} .exad-team-member-style-eight' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/*
		* Team Carousel Common Styling
		*/
		$this->start_controls_section(
			'exad_section_team_carousel_common_style',
			[
				'label' => esc_html__( 'Border Style', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_team_carousel_preset!' => ['-style-two','-style-three', '-style-five', '-style-four', '-style-nine', '-style-one', '-style-seven'],
				],
			]
		);

		/**
		 * For style Ten
		 */

		$this->add_control(
			'exad_team_carousel_border_radius_ten',
			[
				'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-style-eight'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'exad_team_carousel_preset' => ['-style-eight'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_team_carousel_border_image',
				'label' => esc_html__( 'Image Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-member-style-eight .exad-team-member-thumb',
				'condition' => [
					'exad_team_carousel_preset' => ['-style-eight'],
				]
			]
		);

		$this->add_control(
			'exad_team_carousel_padding_ten',
			[
				'label' => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-style-eight'=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'exad_team_carousel_preset' => ['-style-eight'],
				],
			]
		);

		/**
		 * For style Eight
		 */

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_team_carousel_border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-member-style-six, {{WRAPPER}} .exad-team-member-style-six .exad-team-member-thumb',
				'condition' => [
					'exad_team_carousel_preset' => ['-style-six'],
				]
			]
		);

		$this->add_control(
			'exad_team_carousel_border_radius_eight',
			[
				'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-style-six'=> 'border-radius: calc( 2 * {{VALUE}}px );',
					'{{WRAPPER}} .exad-team-member-style-six .exad-team-member-content svg'=> 'border-radius: 0 0 {{VALUE}}px {{VALUE}}px;',
				],
				'condition' => [
					'exad_team_carousel_preset' => ['-style-six'],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
            'section_team_carousel_name',
            [
                'label' => __('Name', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'exad_title_color',
            [
                'label' => __('Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .exad-team-member-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .exad-team-member-name',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_team_member_designation',
            [
                'label' => __('Designation', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'exad_designation_color',
            [
                'label' => __('Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#8a8d91',
                'selectors' => [
                    '{{WRAPPER}} .exad-team-member-designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'designation_typography',
                'selector' => '{{WRAPPER}} .exad-team-member-designation',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_team_carousel_description',
            [
                'label' => __('Description', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'exad_description_color',
            [
                'label' => __('Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#8a8d91',
                'selectors' => [
                    '{{WRAPPER}} .exad-team-member-about' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'exad_description_typography',
                'selector' => '{{WRAPPER}} .exad-team-member-about',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_carousel_settings',
			[
				'label' => esc_html__( 'Carousel Settings', 'exclusive-addons-elementor' ),
			]
		);

		$slides_per_view = range( 1, 6 );
		$slides_per_view = array_combine( $slides_per_view, $slides_per_view );

		$this->add_control(
			'exad_team_per_view',
			[
				'type'           => Controls_Manager::SELECT,
				'label'          => esc_html__( 'Columns', 'exclusive-addons-elementor' ),
				'options'        => $slides_per_view,
				'default'        => '3',
			]
		);

		$this->add_control(
			'exad_team_slides_to_scroll',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Items to Scroll', 'exclusive-addons-elementor' ),
				'options'   => $slides_per_view,
				'default'   => '1',
			]
		);

		$this->add_control(
			'exad_team_carousel_nav',
			[
				'label' => esc_html__( 'Navigation Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'arrows',
				'separator' => 'before',
				'options' => [
					'arrows' => esc_html__( 'Arrows', 'exclusive-addons-elementor' ),
					'dots' => esc_html__( 'Dots', 'exclusive-addons-elementor' ),
					
				],
			]
		);


		$this->start_controls_tabs( 'exad_team_carousel_navigation_tabs' );

		$this->start_controls_tab( 'exad_team_carousel_navigation_control', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

		$this->add_control(
			'exad_team_carousel_arrow_background_color',
			[
				'label' => esc_html__( 'Arrow Background', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#b8bfc7',
				'selectors' => [
					'{{WRAPPER}} .exad-team-carousel-prev, {{WRAPPER}} .exad-team-carousel-next' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_nav' => 'arrows',
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_arrow_color',
			[
				'label' => esc_html__( 'Arrow color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-team-carousel-prev, {{WRAPPER}} .exad-team-carousel-next' => 'color: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_nav' => 'arrows',
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_dot_color',
			[
				'label' => esc_html__( 'Dot Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .exad-team-carousel-wrapper .slick-dots li button' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_nav' => 'dots',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab( 'exad_team_carousel_social_icon_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

		$this->add_control(
			'exad_team_carousel_arrow_hover_background_color',
			[
				'label' => esc_html__( 'Arrow Background Hover', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#917cff',
				'selectors' => [
					'{{WRAPPER}} .exad-team-carousel-prev:hover, {{WRAPPER}} .exad-team-carousel-next:hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_nav' => 'arrows',
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_arrow_hover_color',
			[
				'label' => esc_html__( 'Arrow Color Hover', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-team-carousel-prev:hover, {{WRAPPER}} .exad-team-carousel-next:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_nav' => 'arrows',
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_dot_hover_color',
			[
				'label' => esc_html__( 'Dot Hover', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .exad-team-carousel-wrapper .slick-dots li.slick-active button, {{WRAPPER}} .exad-team-carousel-wrapper .slick-dots li button:hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_nav' => 'dots',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->add_control(
			'exad_team_transition_duration',
			[
				'label'   => esc_html__( 'Transition Duration', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 1000,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'exad_team_autoplay',
			[
				'label'     => esc_html__( 'Autoplay', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
			]
		);

		$this->add_control(
			'exad_team_autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'exad_team_autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'exad_team_loop',
			[
				'label'   => esc_html__( 'Infinite Loop', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'exad_team_pause',
			[
				'label'     => esc_html__( 'Pause on Hover', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'exad_team_autoplay' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
            'exad_team_carousel_social_section',
            [
                'label' => __('Social', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->start_controls_tabs( 'exad_team_carousel_social_icons_style_tabs' );

		$this->start_controls_tab( 'exad_team_carousel_social_icon_control', 
			[ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] 
		);

		$this->add_control(
			'exad_team_carousel_social_color_1',
			[
				'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-style-three .exad-team-member-social li a,
					{{WRAPPER}} .exad-team-carousel-style-four .exad-team-carousel-style-four-inner .exad-team-member-style-four .exad-team-member-social li a,
					{{WRAPPER}} .exad-team-carousel-style-nine .exad-team-carousel-style-nine-inner .exad-team-member-content .exad-team-member-social li a,
					{{WRAPPER}} .exad-team-member-style-six .exad-team-member-content .exad-team-member-social li a,
					{{WRAPPER}} .exad-team-member-style-eight .exad-team-member-content .exad-team-member-social li a' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_preset' => ['-style-three', '-style-four','-style-nine', '-style-six', '-style-eight'],
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_social_color_icon',
			[
				'label' => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#a4a7aa',
				'selectors' => [
					'{{WRAPPER}} .exad-team-carousel-wrapper .exad-team-member-social li a i' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab( 'exad_team_carousel_social_icon_hover_control', 
			[ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] 
		);

		$this->add_control(
			'exad_team_carousel_social_hover_color_1',
			[
				'label' => esc_html__( 'Hover Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#917cff',
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-style-three .exad-team-member-social li a:hover,
					{{WRAPPER}} .exad-team-carousel-style-four .exad-team-carousel-style-four-inner .exad-team-member-style-four .exad-team-member-social li a:hover,
					{{WRAPPER}} .exad-team-carousel-style-nine .exad-team-carousel-style-nine-inner .exad-team-member-content .exad-team-member-social li a:hover,
					{{WRAPPER}} .exad-team-member-style-six .exad-team-member-content .exad-team-member-social li a:hover,
					{{WRAPPER}} .exad-team-member-style-eight .exad-team-member-content .exad-team-member-social li a:hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_preset' => ['-style-three', '-style-four', '-style-nine', '-style-six', '-style-eight']
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_social_hover_color_icon',
			[
				'label' => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .exad-team-carousel-wrapper .exad-team-member-social li a:hover i' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();

	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$team_preset = $settings['exad_team_carousel_preset']; 

		// $this->add_inline_editing_attributes( 'exad_team_carousel_name', 'none' );
		// $this->add_render_attribute( 'exad_team_carousel_name', 'class', 'exad-team-member-name' );

		// $this->add_inline_editing_attributes( 'exad_team_member_designation', 'none' );
		// $this->add_render_attribute( 'exad_team_member_designation', 'class', 'exad-team-member-designation' );

		// $this->add_inline_editing_attributes( 'exad_team_member_description', 'none' );
		// $this->add_render_attribute( 'exad_team_member_description', 'class', 'exad-team-member-about' );

		$this->add_render_attribute( 
			'exad-team-carousel', 
			[ 
				'class' => [ 'exad-team-carousel-wrapper', 'exad-team-carousel' . $team_preset ],
				'data-team-preset' => $team_preset,
				'data-carousel-nav' => $settings['exad_team_carousel_nav'],
				'data-slidestoshow' => $settings['exad_team_per_view'],
				'data-slidestoscroll' => $settings['exad_team_slides_to_scroll'],
	    		'data-speed' => $settings['exad_team_transition_duration'],
			]
		);

		if ( $settings['exad_team_autoplay'] == 'yes' ) {
			$this->add_render_attribute( 'exad-team-carousel', 'data-autoplay', "true");
			$this->add_render_attribute( 'exad-team-carousel', 'data-autoplayspeed', $settings['exad_team_autoplay_speed'] );
		}
		
		if ( $settings['exad_team_pause'] == 'yes' ) {
            $this->add_render_attribute( 'exad-team-carousel', 'data-pauseonhover', "true" );
        }

		if ( $settings['exad_team_loop'] == 'yes' ) {
            $this->add_render_attribute( 'exad-team-carousel', 'data-loop', "true");
        }

		

	?>	
		<div <?php echo $this->get_render_attribute_string( 'exad-team-carousel' ); ?>>

			<?php foreach ( $settings['team_carousel_repeater'] as $key => $member ) : 

			$this->add_inline_editing_attributes( 'exad_team_carousel_name-' . $key, 'none' );
			$this->add_render_attribute( 'exad_team_carousel_name-' . $key, 'class', 'exad-team-member-name' );

			$team_carousel_image = $member['exad_team_carousel_image'];
			$team_carousel_image_url = Group_Control_Image_Size::get_attachment_image_src( $team_carousel_image['id'], 'thumbnail', $member );
			if( empty( $team_carousel_image_url ) ) : $team_carousel_image_url = $team_carousel_image['url']; else: $team_carousel_image_url = $team_carousel_image_url; endif;
			?>
			
				<div class="exad-team-carousel<?php echo esc_attr( $team_preset ); ?>-inner">
	            	<div class="exad-team-member<?php echo esc_attr( $team_preset ); ?>">
	                	<div class="exad-team-member-thumb">
	                		<?php if( $team_preset == '-style-two' ) : ?>
								<svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
									<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
								</svg>
								<svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
									<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
								</svg>
								<svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
									<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
								</svg>
							<?php endif; ?>
	                  		<img src="<?php echo esc_url($team_carousel_image_url); ?>" class="circled" alt="<?php echo esc_attr( $member['exad_team_carousel_name'] ); ?>">
	                	</div>
	                	<div class="exad-team-member-content">
							<?php if( $team_preset == '-style-six' ) : ?>
								<svg viewBox="0 0 370 160">
									<path d="M370-.001s-114 120.999-370 73v140l370 .999V-.001z" />
								</svg>
							<?php endif; ?>
							<?php if ( !empty( $member['exad_team_carousel_name'] ) ) : ?>
								<h2 <?php echo $this->get_render_attribute_string( 'exad_team_carousel_name-' . $key ); ?>><?php echo esc_html( $member['exad_team_carousel_name'] ); ?></h2>
							<?php endif; ?>
							<?php if ( !empty( $member['exad_team_carousel_designation'] ) ) : ?>
								<span class="exad-team-member-designation"><?php echo esc_html( $member['exad_team_carousel_designation'] ); ?></span>
							<?php endif; ?>
							<?php if ( !empty( $member['exad_team_carousel_description'] ) ) : ?>
								<p class="exad-team-member-about"><?php echo esc_html( $member['exad_team_carousel_description'] ); ?></p>
							<?php endif; ?>
		                	<?php if ( $member['exad_team_carousel_enable_social_profiles'] == 'yes' ): ?>
								<ul class="list-inline exad-team-member-social">
									
									<?php if ( ! empty( $member['exad_team_carousel_facebook_link']['url'] ) ) : ?>
										<?php $target = $member['exad_team_carousel_facebook_link']['is_external'] ? ' target="_blank"' : ''; ?>
										<li>
											<a href="<?php echo esc_url( $member['exad_team_carousel_facebook_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-facebook"></i></a>
										</li>
									<?php endif; ?>

									<?php if ( ! empty( $member['exad_team_carousel_twitter_link']['url'] ) ) : ?>
										<?php $target = $member['exad_team_carousel_twitter_link']['is_external'] ? ' target="_blank"' : ''; ?>
										<li>
											<a href="<?php echo esc_url( $member['exad_team_carousel_twitter_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-twitter"></i></a>
										</li>
									<?php endif; ?>

									<?php if ( ! empty( $member['exad_team_carousel_instagram_link']['url'] ) ) : ?>
										<?php $target = $member['exad_team_carousel_instagram_link']['is_external'] ? ' target="_blank"' : ''; ?>
										<li>
											<a href="<?php echo esc_url( $member['exad_team_carousel_instagram_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-instagram"></i></a>
										</li>
									<?php endif; ?>

									<?php if ( ! empty( $member['exad_team_carousel_linkedin_link']['url'] ) ) : ?>
										<?php $target = $member['exad_team_carousel_linkedin_link']['is_external'] ? ' target="_blank"' : ''; ?>
										<li>
											<a href="<?php echo esc_url( $member['exad_team_carousel_linkedin_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-linkedin"></i></a>
										</li>
									<?php endif; ?>

									<?php if ( ! empty( $member['exad_team_carousel_dribbble_link']['url'] ) ) : ?>
										<?php $target = $member['exad_team_carousel_dribbble_link']['is_external'] ? ' target="_blank"' : ''; ?>
										<li>
											<a href="<?php echo esc_url( $member['exad_team_carousel_dribbble_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-dribbble"></i></a>
										</li>
									<?php endif; ?>

								</ul>
							<?php endif; ?>
						</div>
	              	</div>
	          	</div>
      		<?php endforeach; ?>
		</div>	
	<?php	
	}

	protected function _content_template() {
		
		?>
		<#
			view.addRenderAttribute( 
				'exad-team-carousel', 
				{
					'class' : [ 'exad-team-carousel-wrapper', 'exad-team-carousel' + settings.exad_team_carousel_preset ],
					'data-team-preset' : settings.exad_team_carousel_preset,
					'data-carousel-nav' : settings.exad_team_carousel_nav,
					'data-slidestoshow' : settings.exad_team_per_view,
					'data-slidestoscroll' : settings.exad_team_slides_to_scroll,
					'data-speed': settings.exad_team_transition_duration,
				}
			);

			if ( settings.exad_team_autoplay == 'yes' ) {
				view.addRenderAttribute( 'exad-team-carousel', 'data-autoplay', "true");
				view.addRenderAttribute( 'exad-team-carousel', 'data-autoplayspeed', settings.exad_team_autoplay_speed );
			}
			
			if (settings.exad_team_pause == 'yes' ) {
				view.addRenderAttribute( 'exad-team-carousel', 'data-pauseonhover', "true" );
			}

			if ( settings.exad_team_loop == 'yes' ) {
				view.addRenderAttribute( 'exad-team-carousel', 'data-loop', "true");
			}

		
		
		#>
		<div {{{ view.getRenderAttributeString( 'exad-team-carousel' ) }}} >

			<# _.each( settings.team_carousel_repeater, function( member, index ) { 
				<!-- view.addRenderAttribute( 'exad_team_carousel_name', 'class', 'exad-team-member-name' ); -->
				view.addInlineEditingAttributes( 'exad_team_carousel_name-' + index, 'none' );
				view.addRenderAttribute( 'exad_team_carousel_name-' + index, 'class', 'exad-team-member-name' );
				#>

				<div class="exad-team-carousel{{ settings.exad_team_carousel_preset }}-inner">
	            	<div class="exad-team-member{{ settings.exad_team_carousel_preset }}">
	                	<div class="exad-team-member-thumb">
	                		<# if( settings.exad_team_carousel_preset == '-style-two' ) { #>
								<svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
									<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
								</svg>
								<svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
									<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
								</svg>
								<svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
									<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
								</svg>
							<# } #>
	                  		<img src="{{ member.exad_team_carousel_image.url }}" class="circled" alt="{{ member.exad_team_carousel_name }}">
	                	</div>
	                	<div class="exad-team-member-content">
							<# if( settings.exad_team_carousel_preset == '-style-six' ) { #>
								<svg viewBox="0 0 370 160">
									<path d="M370-.001s-114 120.999-370 73v140l370 .999V-.001z" />
								</svg>
							<# } #>
							<# if ( member.exad_team_carousel_name != '' ) { #>
								<h2 {{{ view.getRenderAttributeString( 'exad_team_carousel_name-' + index ) }}}>{{{ member.exad_team_carousel_name }}}</h2>
							<# } #>
							<# if (  member.exad_team_carousel_designation != '' ) { #>
								<span class="exad-team-member-designation">{{{ member.exad_team_carousel_designation }}}</span>
							<# } #>
							<# if (  member.exad_team_carousel_description != '' ) { #>
								<p class="exad-team-member-about">{{{ member.exad_team_carousel_description }}}</p>
							<# } #>
		                	<# if ( member.exad_team_carousel_enable_social_profiles == 'yes' ) { #>
								<ul class="list-inline exad-team-member-social">
									
									<# if (  member.exad_team_carousel_facebook_link.url != '' ) { #>
										<!-- <# var target = member.exad_team_carousel_facebook_link.is_external ? ' target="_blank"' : '' #> -->
										<li>
											<a href="{{ member.exad_team_carousel_facebook_link.url }}"><i class="fa fa-facebook"></i></a>
										</li>
									<# } #>

									<# if (  member.exad_team_carousel_twitter_link.url != '' ) { #>
										<!-- <# var target = member.exad_team_carousel_twitter_link.is_external ? ' target="_blank"' : '' #> -->
										<li>
											<a href="{{ member.exad_team_carousel_twitter_link.url }}"><i class="fa fa-twitter"></i></a>
										</li>
									<# } #>

									<# if (  member.exad_team_carousel_instagram_link.url != '' ) { #>
										<!-- <# var target = member.exad_team_carousel_instagram_link.is_external ? ' target="_blank"' : '' #> -->
										<li>
											<a href="{{ member.exad_team_carousel_instagram_link.url }}"><i class="fa fa-instagram"></i></a>
										</li>
									<# } #>

									<# if (  member.exad_team_carousel_linkedin_link.url != '' ) { #>
										<!-- <# var target = member.exad_team_carousel_linkedin_link.is_external ? ' target="_blank"' : '' #> -->
										<li>
											<a href="{{ member.exad_team_carousel_linkedin_link.url }}"><i class="fa fa-linkedin"></i></a>
										</li>
									<# } #>

									<# if (  member.exad_team_carousel_dribbble_link.url != '' ) { #>
										<!-- <# var target = member.exad_team_carousel_dribbble_link.is_external ? ' target="_blank"' : '' #> -->
										<li>
											<a href="{{ member.exad_team_carousel_dribbble_link.url }}"><i class="fa fa-dribbble"></i></a>
										</li>
									<# } #>

								</ul>
							<# } #>
						</div>
	              	</div>
	          	</div>
			<# }); #>
		</div>	
	<?php	
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Team_Carousel() );