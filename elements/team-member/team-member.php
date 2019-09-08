<?php
namespace Elementor;

class Exad_Team_Member extends Widget_Base {
	
	public function get_name() {
		return 'exad-team-member';
	}
	public function get_title() {
		return esc_html__( 'Team Member', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-lock-user';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	protected function _register_controls() {
		
		/**
		* Team Member Content Section
		*/
		$this->start_controls_section(
			'exad_team_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
			]
		);
		
		$this->add_control(
			'exad_team_member_image',
			[
				'label' => __( 'Image', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'exad_team_member_image[url]!' => '',
				],
			]
		);

		$this->add_control(
			'exad_team_member_name',
			[
				'label' => esc_html__( 'Name', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'John Doe', 'exclusive-addons-elementor' ),
			]
		);
		
		$this->add_control(
			'exad_team_member_designation',
			[
				'label' => esc_html__( 'Designation', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'My Designation', 'exclusive-addons-elementor' ),
			]
		);
		
		$this->add_control(
			'exad_team_member_description',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Add team member details here', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_section_team_members_top_background',
			[
				'label' => __( 'background Top', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off' => __( 'OFF', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'exad_section_team_members_cta_btn',
			[
				'label' => __( 'Call To Action', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off' => __( 'OFF', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'exad_team_members_cta_btn_text',
			[
				'label' => esc_html__( 'Text', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Read More', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_section_team_members_cta_btn' => 'yes',
				],
			]
		);

		$this->add_control(
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
					'exad_section_team_members_cta_btn' => 'yes',
				],
			]
		);


		$this->end_controls_section();
		/*
		* Team member Social profiles section
		*/
		
		$this->start_controls_section(
			'exad_section_team_member_social_profiles',
			[
				'label' => esc_html__( 'Social Profiles', 'exclusive-addons-elementor' )
			]
		);
		$this->add_control(
			'exad_team_member_enable_social_profiles',
			[
				'label' => esc_html__( 'Display Social Profiles?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
		
		$this->add_control(
			'exad_team_member_social_profile_links',
			[
				'type' => Controls_Manager::REPEATER,
				'condition' => [
					'exad_team_member_enable_social_profiles!' => '',
				],
				'default' => [
					[
						'social' => 'fa fa-facebook',
					],
					[
						'social' => 'fa fa-twitter',
					],
					[
						'social' => 'fa fa-google-plus',
					],
					[
						'social' => 'fa fa-linkedin',
					],
				],
				'fields' => [
					[
						'name' => 'social',
						'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::ICON,
						'label_block' => true,
						'default' => 'fa fa-wordpress',
						'include' => [
							'fa fa-apple',
							'fa fa-behance',
							'fa fa-bitbucket',
							'fa fa-codepen',
							'fa fa-delicious',
							'fa fa-digg',
							'fa fa-dribbble',
							'fa fa-envelope',
							'fa fa-facebook',
							'fa fa-flickr',
							'fa fa-foursquare',
							'fa fa-github',
							'fa fa-google-plus',
							'fa fa-houzz',
							'fa fa-instagram',
							'fa fa-jsfiddle',
							'fa fa-linkedin',
							'fa fa-medium',
							'fa fa-pinterest',
							'fa fa-product-hunt',
							'fa fa-reddit',
							'fa fa-shopping-cart',
							'fa fa-slideshare',
							'fa fa-snapchat',
							'fa fa-soundcloud',
							'fa fa-spotify',
							'fa fa-stack-overflow',
							'fa fa-tripadvisor',
							'fa fa-tumblr',
							'fa fa-twitch',
							'fa fa-twitter',
							'fa fa-vimeo',
							'fa fa-vk',
							'fa fa-whatsapp',
							'fa fa-wordpress',
							'fa fa-xing',
							'fa fa-yelp',
							'fa fa-youtube',
						],
					],
					[
						'name' => 'link',
						'label' => esc_html__( 'Link', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'default' => [
							'url' => '',
							'is_external' => 'true',
						],
						'placeholder' => esc_html__( 'Place URL here', 'exclusive-addons-elementor' ),
					],
				],
				'title_field' => '<i class="{{ social }}"></i> {{{ social.replace( \'fa fa-\', \'\' ).replace( \'-\', \' \' ).replace( /\b\w/g, function( letter ){ return letter.toUpperCase() } ) }}}',
			]
		);
		$this->end_controls_section();


		/*
		* Team Members Styling Section
		*/

		/*
		* Team Members Container Style
		*/
		$this->start_controls_section(
			'exad_section_team_members_styles_preset',
			[
				'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_team_member_content_alignment',
			[
				'label' => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				// 'separator' => 'after',
				'options' => [
					'exad-left' => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'exad-center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'exad-right' => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					]
				],
				'default' => 'exad-center',
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
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_team_members_bg',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-team-member',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_team_members_border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-member',
			]
		);
		
		$this->add_control(
			'exad_team_members_radius',
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
				'name' => 'exad_team_members_box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-member',
			]
		);

		$this->add_control(
			'exad_team_members_padding',
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
				// 'condition' => [
				// 	'exad_section_team_members_thumbnail_box' => 'yes'
				// ],
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
		 * Top Background Style
		 */

        $this->start_controls_section(
            'exad_team_member_top_background',
            [
                'label' => __('Top Background', 'exclusive-addons-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_section_team_members_top_background' => 'yes',
				],
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_team_member_top_background_color',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-top-background',
			]
		);

		$this->add_control(
			'exad_team_member_top_background_padding_top',
			[
				'label' => __( 'Padding Top', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '100',
				'selectors' => [
					'{{WRAPPER}} .exad-top-background' => 'padding-top: {{VALUE}}px;',
				],
			]
		);

		$this->add_control(
			'exad_team_member_top_background_radius',
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
					'{{WRAPPER}} .exad-top-background' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'condition' => [
					'exad_section_team_members_cta_btn' => 'yes',
				],
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
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
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

		// Name, Designation , About Font Color and Typography

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
			'exad_team_members_title_margin',
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
		 * Designation Style
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
			'exad_team_members_designation_margin',
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
		 * Description Style
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
			'exad_team_members_description_margin',
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
            'exad_team_member_social_section',
            [
                'label' => __('Social', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
		);
		
		$this->add_control(
			'exad_section_team_members_social_box_height',
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
			'exad_section_team_members_social_box_width',
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
			'exad_team_members_social_icon_size',
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
			'exad_team_members_social_box_radius',
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
			'exad_team_members_social_box_margin_right',
			[
				'label' => __( 'Margin Right', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-social li:not(:last-child) a' => 'margin-right: {{VALUE}}px;',
				],
			]
		);

		$this->start_controls_tabs( 'exad_team_members_social_icons_style_tabs' );

			$this->start_controls_tab( 'exad_team_members_social_icon_tab', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

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

		$this->add_inline_editing_attributes( 'exad_team_member_name', 'none' );
		$this->add_render_attribute( 'exad_team_member_name', 'class', 'exad-team-member-name' );

		$this->add_inline_editing_attributes( 'exad_team_member_designation', 'none' );
		$this->add_render_attribute( 'exad_team_member_designation', 'class', 'exad-team-member-designation' );

		$this->add_inline_editing_attributes( 'exad_team_member_description', 'none' );
		$this->add_render_attribute( 'exad_team_member_description', 'class', 'exad-team-member-about' );


		$this->add_render_attribute( 'exad_team_member_item', 'class', 'exad-team-item' );

		if( $settings['exad_section_team_members_top_background'] === 'yes' ){
			$this->add_render_attribute( 'exad_team_member_item', 'class', 'exad-top-background' );
		}

		$team_member_image = $this->get_settings_for_display( 'exad_team_member_image' );
		$team_member_image_url_src = Group_Control_Image_Size::get_attachment_image_src( $team_member_image['id'], 'thumbnail', $settings );
		if( empty( $team_member_image_url_src ) ) {
			$team_member_image_url = $team_member_image['url']; 
		} else { 
			$team_member_image_url = $team_member_image_url_src;
		}

		?>
		<div id="exad-team-member" <?php echo $this->get_render_attribute_string( 'exad_team_member_item' ); ?> >
			<div class="exad-team-member <?php echo esc_attr( $settings['exad_team_member_content_alignment'] ); ?> <?php echo esc_attr( $settings['exad_team_member_content_image_position'] ); ?>">
				<div class="exad-team-member-thumb">
					<img src="<?php echo esc_url($team_member_image_url); ?>" class="circled" alt="<?php echo esc_attr( $settings['exad_team_member_name'] ); ?>">
				</div>
				<div class="exad-team-member-content">
					<?php if ( !empty( $settings['exad_team_member_name'] ) ) : ?>
                        <h2 <?php echo $this->get_render_attribute_string( 'exad_team_member_name' ); ?>><?php echo esc_html( $settings['exad_team_member_name'] ); ?></h2>
					<?php endif; ?>
					<?php if ( !empty( $settings['exad_team_member_designation'] ) ) : ?>
                        <span <?php echo $this->get_render_attribute_string( 'exad_team_member_designation' ); ?>><?php echo esc_html( $settings['exad_team_member_designation'] ); ?></span>
					<?php endif; ?>
					<?php if ( !empty( $settings['exad_team_member_description'] ) ) : ?>
                        <p <?php echo $this->get_render_attribute_string( 'exad_team_member_description' ); ?>><?php echo esc_html( $settings['exad_team_member_description'] ); ?></p>
                    <?php endif; ?>
					<?php if ( $settings['exad_section_team_members_cta_btn'] === 'yes' ) : ?>
						<a href="<?php echo esc_url( $settings['exad_team_members_cta_btn_link']['url'] ); ?>" class="exad-team-member-cta">
							<?php echo $settings['exad_team_members_cta_btn_text']; ?>
						</a>
                    <?php endif; ?>
					<?php if ( $settings['exad_team_member_enable_social_profiles'] == 'yes' ): ?>
						<ul class="list-inline exad-team-member-social">
							<?php foreach ( $settings['exad_team_member_social_profile_links'] as $item ) : ?>
							
							<?php $target = $item['link']['is_external'] ? ' target="_blank"' : ''; ?>
							<li>
								<a href="<?php echo esc_url( $item['link']['url'] ); ?>"<?php echo $target; ?>><i class="<?php echo esc_attr($item['social'] ); ?>"></i></a>
							</li>
							
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php
	}

	protected function _content_template() {
		?>

		<# 
		view.addInlineEditingAttributes( 'exad_team_member_name', 'none' );
		view.addRenderAttribute( 'exad_team_member_name', 'class', 'exad-team-member-name' );

		view.addInlineEditingAttributes( 'exad_team_member_designation', 'none' );
		view.addRenderAttribute( 'exad_team_member_designation', 'class', 'exad-team-member-designation' );

		view.addInlineEditingAttributes( 'exad_team_member_description', 'none' );
		view.addRenderAttribute( 'exad_team_member_description', 'class', 'exad-team-member-about' );

		view.addRenderAttribute( 'exad_team_member_item', 'class', 'exad-team-item' );

		if( settings.exad_section_team_members_top_background === 'yes' ){
			view.addRenderAttribute( 'exad_team_member_item', 'class', 'exad-top-background' );
		}

		#>

		<div id="exad-team-member" {{{ view.getRenderAttributeString( 'exad_team_member_item' ) }}} >
			<div class="exad-team-member {{ settings.exad_team_member_content_alignment }} {{ settings.exad_team_member_content_image_position }}">
				<div class="exad-team-member-thumb">
					<img src="{{ settings.exad_team_member_image.url }}" class="circled" alt="{{ settings.exad_team_member_name }}">
				</div>
				<div class="exad-team-member-content">
					<# if ( settings.exad_team_member_name != '' ) { #>
						<h2 {{{ view.getRenderAttributeString( 'exad_team_member_name' ) }}}>{{{ settings.exad_team_member_name }}}</h2>
					<# } #>
					<# if ( settings.exad_team_member_designation != '' ) { #>
						<span {{{ view.getRenderAttributeString( 'exad_team_member_designation' ) }}}>{{{ settings.exad_team_member_designation }}}</span>
					<# } #>
					<# if ( settings.exad_team_member_description != '' ) { #>
						<p {{{ view.getRenderAttributeString( 'exad_team_member_description' ) }}}>{{{ settings.exad_team_member_description }}}</p>
					<# } #>
					<# if ( settings.exad_section_team_members_cta_btn === 'yes' ) { #>
						<a href="{{ settings.exad_team_members_cta_btn_link.url }}" class="exad-team-member-cta">
							{{{ settings.exad_team_members_cta_btn_text }}}
						</a>
                    <# } #>
					<# if ( 'yes' == settings.exad_team_member_enable_social_profiles ) { #>
						<ul class="list-inline exad-team-member-social">
							<# _.each( settings.exad_team_member_social_profile_links, function( item, index ) { #>
							
							<# var target = item.link.is_external ? ' target="_blank"' : '' #>
							<li>
								<a href="{{ item.link.url }}" {{{ target }}}><i class="{{ item.social }}"></i></a>
							</li>
							
							<# }); #>
						</ul>
					<# } #>
				</div>
			</div>
		</div>
		<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Team_Member() );