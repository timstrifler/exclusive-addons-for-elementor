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
			'exad_section_team_carousel_cta_btn',
			[
				'label' => __( 'Call To Action', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off' => __( 'OFF', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$team_repeater->add_control(
			'exad_team_members_cta_btn_text',
			[
				'label' => esc_html__( 'Text', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Read More', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_section_team_carousel_cta_btn' => 'yes',
				],
			]
		);

		$team_repeater->add_control(
			'exad_team_members_cta_btn_link',
			[
				'label' => esc_html__( 'Link', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
        			'url' => '#',
        			'is_external' => '',
     			],
				'show_external' => true,
				'condition' => [
					'exad_section_team_carousel_cta_btn' => 'yes',
				],
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

		// $this->add_control(
		// 	'exad_section_team_members_top_background',
		// 	[
		// 		'label' => __( 'background Top', 'exclusive-addons-elementor' ),
		// 		'type' => Controls_Manager::SWITCHER,
		// 		'label_on' => __( 'ON', 'exclusive-addons-elementor' ),
		// 		'label_off' => __( 'OFF', 'exclusive-addons-elementor' ),
		// 		'return_value' => 'yes',
		// 		'default' => 'no',
		// 	]
		// );

		$this->end_controls_section();

		/**
		 * carousel settings section
		 */

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

		/*
		* Team Members Styling Section
		*/
		$this->start_controls_section(
			'exad_section_team_carousel_styles_preset',
			[
				'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		// $this->add_control(
		// 	'exad_team_carousel_preset',
		// 	[
		// 		'label' => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
		// 		'type' => Controls_Manager::SELECT,
		// 		'default' => '-style-one',
		// 		'options' => [
		// 			'-style-one' => esc_html__( 'Style 1 (Pro)', 'exclusive-addons-elementor' ),
		// 			'-style-two' => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
		// 			'-style-three' => esc_html__( 'Style 3', 'exclusive-addons-elementor' ),
		// 			'-style-four' => esc_html__( 'Style 4 (Pro)', 'exclusive-addons-elementor' ),
		// 			'-style-five' => esc_html__( 'Style 5', 'exclusive-addons-elementor' ),
		// 			'-style-six' => esc_html__( 'Style 6 (Pro)', 'exclusive-addons-elementor' ),
		// 			'-style-seven' => esc_html__( 'Style 7 (Pro)', 'exclusive-addons-elementor' ),
		// 			'-style-eight' => esc_html__( 'Style 8 (Pro)', 'exclusive-addons-elementor' ),
		// 			'-style-nine' => esc_html__( 'Style 9 (Pro)', 'exclusive-addons-elementor' ),
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'exad_team_carousel_avatar_bg',
		// 	[
		// 		'label' => esc_html__( 'Curved SVG Color', 'exclusive-addons-elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'default' => '#826EFF',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .exad-team-member-style-two .exad-team-member-thumb svg.team-avatar-bg,
		// 			{{WRAPPER}} .exad-team-member-style-six .exad-team-member-content svg path' => 'fill: {{VALUE}};',
		// 		],
		// 		'condition' => [
		// 			'exad_team_carousel_preset' => ['-style-two', '-style-six'],
		// 		],
		// 	]
		// );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_team_carousel_bg',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-team-member',
			]
		);

		$this->add_control(
			'exad_team_carousel_content_alignment',
			[
				'label' => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'exad-team-carousel-left' => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'exad-team-carousel-center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'exad-team-carousel-right' => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					]
				],
				'default' => 'exad-team-carousel-center',
			]
		);

		$this->add_control(
			'exad_team_member_content_image_position',
			[
				'label' => __( 'Image Position', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'after',
				'options' => [
					'exad-position-top' => __( 'Top', 'exclusive-addons-elementor' ),
					'exad-position-left' => __( 'Left', 'exclusive-addons-elementor' ),
					'exad-position-right' => __( 'Right', 'exclusive-addons-elementor' ),
				],
				'default' => 'exad-position-top'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_team_carousel_border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-member',
			]
		);
		
		$this->add_control(
			'exad_team_carousel_radius',
			[
				'label' => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator' => 'after',
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-team-member' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_team_carousel_box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-member',
			]
		);

		$this->add_control(
			'exad_team_carousel_padding',
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
					'{{WRAPPER}} .exad-team-member' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '15',
					'bottom' => '0',
					'left' => '15',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-team-member' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * For Thumbnail style
		 */

		$this->start_controls_section(
			'exad_section_team_members_thumbnail_style',
			[
				'label' => esc_html__( 'Thumbnail', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_section_team_members_thumbnail_box',
			[
				'label' => __( 'Image Box', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'exad_section_team_members_thumbnail_box_height',
			[
				'label' => __( 'Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 100,
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-thumb'=> 'height: {{VALUE}}px;',
				],
				'condition' => [
					'exad_section_team_members_thumbnail_box' => 'yes'
				],
			]
		);

		$this->add_control(
			'exad_section_team_members_thumbnail_box_width',
			[
				'label' => __( 'Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'separator' => 'after',
				'default' => 100,
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-thumb'=> 'width: {{VALUE}}px;',
				],
				'condition' => [
					'exad_section_team_members_thumbnail_box' => 'yes'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_section_team_members_thumbnail_box_border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-member-thumb',
				'condition' => [
					'exad_section_team_members_thumbnail_box' => 'yes'
				],
			]
		);
		
		$this->add_control(
			'exad_section_team_members_thumbnail_box_radius',
			[
				'label' => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator' => 'after',
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .exad-team-member-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_section_team_members_thumbnail_box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-member-thumb',
				'condition' => [
					'exad_section_team_members_thumbnail_box' => 'yes'
				],
			]
		);

		$this->add_control(
			'exad_section_team_members_thumbnail_box_margin_top',
			[
				'label' => __( 'Margin Top', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-thumb' => 'margin-top: {{VALUE}}px;',
				],
				'condition' => [
					'exad_section_team_members_thumbnail_box' => 'yes'
				],
			]
		);

		$this->end_controls_section();

		/*
		* Team Members Content Style
		*/
		$this->start_controls_section(
			'exad_section_team_members_content_style',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_team_members_content_background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-team-member-content',
			]
		);

		$this->add_control(
			'exad_section_team_members_content_padding',
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
					'{{WRAPPER}} .exad-team-member-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_section_team_members_content_margin',
			[
				'label' => __( 'margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_content_radius',
			[
				'label' => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator' => 'after',
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_section_team_members_content_box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-member-content',
			]
		);
		
		$this->end_controls_section();

		/**
		 * Call to action Style
		 */

        $this->start_controls_section(
            'exad_team_member_cta_btn_style',
            [
                'label' => __('Call to action', 'exclusive-addons-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_team_member_cta_btn_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .exad-team-member-cta',
			]
		);
		
		$this->add_control(
			'exad_team_member_cta_btn_margin',
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
					'{{WRAPPER}} .exad-team-member-cta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_team_member_cta_btn_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '15',
					'right' => '30',
					'bottom' => '15',
					'left' => '30',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_team_member_cta_btn_radius',
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
					'{{WRAPPER}} .exad-team-member-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'exad_team_member_cta_btn_tabs' );

			$this->start_controls_tab( 'exad_team_member_cta_btn_tab_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_team_member_cta_btn_background_normal',
					[
						'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#d6d6d6',
						'selectors' => [
							'{{WRAPPER}} .exad-team-member-cta' => 'background: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_team_member_cta_btn_text_color_normal',
					[
						'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#222222',
						'selectors' => [
							'{{WRAPPER}} .exad-team-member-cta' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'exad_team_member_cta_btn_border_normal',
						'label' => __( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-team-member-cta',
					]
				);
		
			$this->end_controls_tab();

			$this->start_controls_tab( 'exad_team_member_cta_btn_tab_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_team_member_cta_btn_background_hover',
					[
						'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#222222',
						'selectors' => [
							'{{WRAPPER}} .exad-team-member-cta:hover' => 'background: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_team_member_cta_btn_text_color_hover',
					[
						'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#d6d6d6',
						'selectors' => [
							'{{WRAPPER}} .exad-team-member-cta:hover' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'exad_team_member_cta_btn_border_hover',
						'label' => __( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-team-member-cta:hover',
					]
				);

			$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * For Navigation Style
		 */

		$this->start_controls_section(
            'section_team_carousel_navigation_section',
            [
                'label' => __('Navigation', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
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

		$this->add_control(
			'exad_team_carousel_nav_dots_height',
			[
				'label' => esc_html__( 'Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '10',
				'selectors' => [
					'{{WRAPPER}} .exad-team-carousel-wrapper .slick-dots li button' => 'height: {{VALUE}}px;',
				],
				'condition' => [
					'exad_team_carousel_nav' => 'dots',
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_nav_dots_width',
			[
				'label' => esc_html__( 'Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '10',
				'selectors' => [
					'{{WRAPPER}} .exad-team-carousel-wrapper .slick-dots li button' => 'width: {{VALUE}}px;',
				],
				'condition' => [
					'exad_team_carousel_nav' => 'dots',
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_nav_dots_radius',
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
					'{{WRAPPER}} .exad-team-carousel-wrapper .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'exad_team_carousel_nav' => 'dots',
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_nav_arrows_radius',
			[
				'label' => esc_html__( 'Arrows Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-team-carousel-prev, {{WRAPPER}} .exad-team-carousel-next' => 'border-Radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'exad_team_carousel_nav' => 'arrows',
				],
			]
		);
	
		$this->add_control(
			'exad_team_carousel_nav_arrows_icon_size',
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
					'{{WRAPPER}} .exad-team-carousel-prev i, {{WRAPPER}} .exad-team-carousel-next i' => 'font-size: {{SIZE}}px;',
				],
				'condition' => [
					'exad_team_carousel_nav' => 'arrows',
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

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_team_carousel_arrow_box_shadow_normal',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-carousel-prev, {{WRAPPER}} .exad-team-carousel-next',
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

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_team_carousel_nav_border_normal',
				'label' => __( 'Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .exad-team-carousel-wrapper .slick-dots li button,{{WRAPPER}} .exad-team-carousel-prev, {{WRAPPER}} .exad-team-carousel-next',
				'condition' => [
					'exad_team_carousel_nav' => ['dots','arrows']
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

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_team_carousel_arrow_box_shadow_hover',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-carousel-prev:hover, {{WRAPPER}} .exad-team-carousel-next:hover',
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

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_team_carousel_nav_border_hover',
				'label' => __( 'Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .exad-team-carousel-wrapper .slick-dots li button:hover,{{WRAPPER}} .exad-team-carousel-prev:hover, {{WRAPPER}} .exad-team-carousel-next:hover',
				'condition' => [
					'exad_team_carousel_nav' => ['dots','arrows']
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * For Title style
		 */

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
		
		$this->add_control(
			'exad_team_member_title_margin',
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
					'{{WRAPPER}} .exad-team-member-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		/**
		 * For Designation style
		 */

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
		
		$this->add_control(
			'exad_team_member_designation_margin',
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
					'{{WRAPPER}} .exad-team-member-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		/**
		 * For Description style
		 */

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
		
		$this->add_control(
			'exad_team_member_ddescription_margin',
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
					'{{WRAPPER}} .exad-team-member-about' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		/**
		 * Social icon style
		 */

        $this->start_controls_section(
            'exad_team_carousel_social_section',
            [
                'label' => __('Social', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
		);
		
		$this->add_control(
			'exad_team_carousel_social_box_height',
			[
				'label' => __( 'Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 50,
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-social li a'=> 'height: {{VALUE}}px;',
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_social_box_width',
			[
				'label' => __( 'Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 50,
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-social li a'=> 'width: {{VALUE}}px;',
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_social_icon_size',
			[
				'label' => __( 'Icon Size', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-social li a i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_social_box_radius',
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
					'{{WRAPPER}} .exad-team-member-social li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_social_box_margin_right',
			[
				'label' => __( 'Margin Right', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-social li:not(:last-child) a' => 'margin-right: {{VALUE}}px;',
				],
			]
		);

		$this->start_controls_tabs( 'exad_team_carousel_social_icons_style_tabs' );

			$this->start_controls_tab( 'exad_team_carousel_social_icon_tab', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_team_carousel_social_bg_color_normal',
					[
						'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#FFF',
						'selectors' => [
							'{{WRAPPER}} .exad-team-member-social li a' => 'background: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_team_carousel_social_icon_color_normal',
					[
						'label' => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#a4a7aa',
						'selectors' => [
							'{{WRAPPER}} .exad-team-member-social li a i' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'exad_team_carousel_social_border_normal',
						'label' => __( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-team-member-social li a',
					]
				);
		
			$this->end_controls_tab();

			$this->start_controls_tab( 'exad_team_members_social_icon_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_team_carousel_social_bg_color_hover',
					[
						'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#917cff',
						'selectors' => [
							'{{WRAPPER}} .exad-team-member-social li a:hover' => 'background: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_team_carousel_social_icon_color_hover',
					[
						'label' => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#8a8d91',
						'selectors' => [
							'{{WRAPPER}} .exad-team-member-social li a:hover i' => 'color: {{VALUE}};',
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'exad_team_carousel_social_border_hover',
						'label' => __( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-team-member-social li a:hover',
					]
				);

			$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();

	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$team_preset = $settings['exad_team_carousel_preset']; 

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
		
		$this->add_render_attribute( 'exad_team_carousel_inner', 'class', 'exad-team-carousel-inner' );

	?>	
		<div <?php echo $this->get_render_attribute_string( 'exad-team-carousel' ); ?>>

			<?php foreach ( $settings['team_carousel_repeater'] as $key => $member ) : 

			$team_carousel_image = $member['exad_team_carousel_image'];
			$team_carousel_image_url = Group_Control_Image_Size::get_attachment_image_src( $team_carousel_image['id'], 'thumbnail', $member );
			if( empty( $team_carousel_image_url ) ) : $team_carousel_image_url = $team_carousel_image['url']; else: $team_carousel_image_url = $team_carousel_image_url; endif;
			?>
			
				<div <?php echo $this->get_render_attribute_string( 'exad_team_carousel_inner' ); ?> >
	            	<div class="exad-team-member <?php echo esc_attr( $settings['exad_team_carousel_content_alignment'] ); ?> <?php echo esc_attr( $settings['exad_team_member_content_image_position'] ); ?>">
	                	<div class="exad-team-member-thumb">
	                  		<img src="<?php echo esc_url($team_carousel_image_url); ?>" class="circled" alt="<?php echo esc_attr( $member['exad_team_carousel_name'] ); ?>">
	                	</div>
	                	<div class="exad-team-member-content">
							<?php if ( !empty( $member['exad_team_carousel_name'] ) ) : ?>
								<h2 class="exad-team-member-name"><?php echo esc_html( $member['exad_team_carousel_name'] ); ?></h2>
							<?php endif; ?>
							<?php if ( !empty( $member['exad_team_carousel_designation'] ) ) : ?>
								<span class="exad-team-member-designation"><?php echo esc_html( $member['exad_team_carousel_designation'] ); ?></span>
							<?php endif; ?>
							<?php if ( !empty( $member['exad_team_carousel_description'] ) ) : ?>
								<p class="exad-team-member-about"><?php echo esc_html( $member['exad_team_carousel_description'] ); ?></p>
							<?php endif; ?>
							<?php if ( $member['exad_section_team_carousel_cta_btn'] === 'yes' ) : ?>
								<a href="<?php echo esc_url( $member['exad_team_members_cta_btn_link']['url'] ); ?>" class="exad-team-member-cta">
									<?php echo $member['exad_team_members_cta_btn_text']; ?>
								</a>
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

			view.addRenderAttribute( 'exad_team_carousel_inner', 'class', 'exad-team-carousel-inner' );

		#>
		<div {{{ view.getRenderAttributeString( 'exad-team-carousel' ) }}} >

			<# _.each( settings.team_carousel_repeater, function( member, index ) { #>
			
				<div {{{ view.getRenderAttributeString( 'exad_team_carousel_inner' ) }}} >
	            	<div class="exad-team-member {{ settings.exad_team_carousel_content_alignment }} {{ settings.exad_team_member_content_image_position }}">
	                	<div class="exad-team-member-thumb">
						<img src="{{ member.exad_team_carousel_image.url }}" class="circled" alt="{{ member.exad_team_carousel_name }}">
	                	</div>
	                	<div class="exad-team-member-content">
							<# if ( member.exad_team_carousel_name != '' ) { #>
								<h2 class="exad-team-member-name">{{{ member.exad_team_carousel_name }}}</h2>
							<# } #>
							<# if (  member.exad_team_carousel_designation != '' ) { #>
								<span class="exad-team-member-designation">{{{ member.exad_team_carousel_designation }}}</span>
							<# } #>
							<# if (  member.exad_team_carousel_description != '' ) { #>
								<p class="exad-team-member-about">{{{ member.exad_team_carousel_description }}}</p>
							<# } #>
							<# if ( member.exad_section_team_carousel_cta_btn === 'yes' ) { #>
								<a href="{{ member.exad_team_members_cta_btn_link.url }}" class="exad-team-member-cta">
									{{{ member.exad_team_members_cta_btn_text }}}
								</a>
							<# } #>
		                	<# if ( member.exad_team_carousel_enable_social_profiles == 'yes' ) { #>
								<ul class="list-inline exad-team-member-social">
									
									<# if (  member.exad_team_carousel_facebook_link.url != '' ) { #>
										<# var target = member.exad_team_carousel_facebook_link.is_external ? ' target="_blank"' : '' #>
										<li>
											<a href="{{ member.exad_team_carousel_facebook_link.url }}" {{{ target }}}><i class="fa fa-facebook"></i></a>
										</li>
									<# } #>

									<# if (  member.exad_team_carousel_twitter_link.url != '' ) { #>
										<# var target = member.exad_team_carousel_twitter_link.is_external ? ' target="_blank"' : '' #>
										<li>
											<a href="{{ member.exad_team_carousel_twitter_link.url }}" {{{ target }}}><i class="fa fa-twitter"></i></a>
										</li>
									<# } #>

									<# if (  member.exad_team_carousel_instagram_link.url != '' ) { #>
										<# var target = member.exad_team_carousel_instagram_link.is_external ? ' target="_blank"' : '' #>
										<li>
											<a href="{{ member.exad_team_carousel_instagram_link.url }}" {{{ target }}}><i class="fa fa-instagram"></i></a>
										</li>
									<# } #>

									<# if (  member.exad_team_carousel_linkedin_link.url != '' ) { #>
										<# var target = member.exad_team_carousel_linkedin_link.is_external ? ' target="_blank"' : '' #>
										<li>
											<a href="{{ member.exad_team_carousel_linkedin_link.url }}" {{{ target }}}><i class="fa fa-linkedin"></i></a>
										</li>
									<# } #>

									<# if (  member.exad_team_carousel_dribbble_link.url != '' ) { #>
										<# var target = member.exad_team_carousel_dribbble_link.is_external ? ' target="_blank"' : '' #>
										<li>
											<a href="{{ member.exad_team_carousel_dribbble_link.url }}" {{{ target }}}><i class="fa fa-dribbble"></i></a>
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