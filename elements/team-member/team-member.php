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

	public function get_keywords() {
        return [ 'employee', 'staff' ];
    }

	protected function _register_controls() {
		
		/**
		* Team Member Content Section
		*/
		$this->start_controls_section(
			'exad_team_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
			]
		);
		
		$this->add_control(
			'exad_team_member_image',
			[
				'label'   => __( 'Image', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				]
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'team_member_image_size',
				'default'   => 'medium_large',
				'condition' => [
					'exad_team_member_image[url]!' => ''
				]
			]
		);

		$this->add_control(
			'exad_team_member_name',
			[
				'label'       => esc_html__( 'Name', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'John Doe', 'exclusive-addons-elementor' )
			]
		);
		
		$this->add_control(
			'exad_team_member_designation',
			[
				'label'       => esc_html__( 'Designation', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'My Designation', 'exclusive-addons-elementor' )
			]
		);
		
		$this->add_control(
			'exad_team_member_description',
			[
				'label'   => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Add team member details here', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_section_team_members_cta_btn',
			[
				'label'        => __( 'Call To Action', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'OFF', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'exad_team_members_cta_btn_text',
			[
				'label'       => esc_html__( 'Text', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Read More', 'exclusive-addons-elementor' ),
				'condition'   => [
					'exad_section_team_members_cta_btn' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_team_members_cta_btn_link',
			[
				'label'       => esc_html__( 'Link', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => ''
     			],
				'show_external' => true,
				'condition' => [
					'exad_section_team_members_cta_btn' => 'yes'
				]
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
				'label'   => esc_html__( 'Display Social Profiles?', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		
		$repeater = new Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label'            => __( 'Icon', 'exclusive-addons-elementor' ),
				'type'             => Controls_Manager::ICONS,
				'label_block'      => true,
				'default'          => [
					'value'        => 'fab fa-wordpress',
					'library'      => 'fa-brands'
				],
				'recommended'      => [
					'fa-brands'    => [
						'android',
						'apple',
						'behance',
						'bitbucket',
						'codepen',
						'delicious',
						'deviantart',
						'digg',
						'dribbble',
						'exclusive-addons-elementor',
						'facebook',
						'flickr',
						'foursquare',
						'free-code-camp',
						'github',
						'gitlab',
						'globe',
						'google-plus',
						'houzz',
						'instagram',
						'jsfiddle',
						'linkedin',
						'medium',
						'meetup',
						'mixcloud',
						'odnoklassniki',
						'pinterest',
						'product-hunt',
						'reddit',
						'shopping-cart',
						'skype',
						'slideshare',
						'snapchat',
						'soundcloud',
						'spotify',
						'stack-overflow',
						'steam',
						'stumbleupon',
						'telegram',
						'thumb-tack',
						'tripadvisor',
						'tumblr',
						'twitch',
						'twitter',
						'viber',
						'vimeo',
						'vk',
						'weibo',
						'weixin',
						'whatsapp',
						'wordpress',
						'xing',
						'yelp',
						'youtube',
						'500px'
					],
					'fa-solid' => [
						'envelope',
						'link',
						'rss'
					]
				]
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => __( 'Link', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => 'true'
				],
				'dynamic'     => [
					'active'  => true
				],
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_team_member_social_profile_links',
			[
				'label'       => __( 'Social Icons', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'condition'   => [
					'exad_team_member_enable_social_profiles!' => ''
				],
				'default'     => [
					[
						'social_icon' => [
							'value'   => 'fab fa-facebook-f',
							'library' => 'fa-brands'
						]
					],
					[
						'social_icon' => [
							'value'   => 'fab fa-twitter',
							'library' => 'fa-brands'
						]
					],
					[
						'social_icon' => [
							'value'   => 'fab fa-linkedin-in',
							'library' => 'fa-brands'
						],
					],
					[
						'social_icon' => [
							'value'   => 'fab fa-google-plus-g',
							'library' => 'fa-brands',
						]
					]
				],
				'title_field' => '{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icon, false, true, false, true ) }}}'
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
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'exad_team_members_bg',
				'label'    => __( 'Background', 'exclusive-addons-elementor' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-team-member'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'exad_team_members_border',
				'label'    => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-member'
			]
		);
		
		$this->add_responsive_control(
			'exad_team_members_radius',
			[
				'label'      => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-team-member' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_team_members_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-team-member' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_team_members_margin',
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
					'{{WRAPPER}} .exad-team-member' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_team_members_box_shadow',
				'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-member',
				'fields_options'      => [
		            'box_shadow_type' => [
		                'default'     =>'yes'
		            ],
		            'box_shadow'  => [
		                'default' => [
		                    'horizontal' => 0,
		                    'vertical'   => 20,
		                    'blur'       => 49,
		                    'spread'     => 0,
		                    'color'      => 'rgba(24, 27, 33, 0.1)'
		                ]
		            ]
	            ]
			]
		);

		$this->end_controls_section();

		/**
		 * For Thumbnail style
		 */

		$this->start_controls_section(
			'exad_section_team_members_image_style',
			[
				'label' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
            'exad_team_membe_image_position',
            [
                'label'         => esc_html__( 'Image Position', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::CHOOSE,
                'default'       => 'exad-position-top',
                'options'       => [
                    'exad-position-left'  => [
                        'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-angle-left',
                    ],
                    'exad-position-top'   => [
                        'title' => esc_html__( 'Top', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-angle-up',
                    ],
                    'exad-position-right' => [
                        'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-angle-right',
                    ]
                ]
            ]
        );

		$this->add_control(
			'exad_section_team_members_thumbnail_box',
			[
				'label'        => __( 'Image Box', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_responsive_control(
			'exad_section_team_members_thumbnail_box_height',
			[
				'label'     => __( 'Height', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 100,
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-thumb'=> 'height: {{VALUE}}px;'
				],
				'condition' => [
					'exad_section_team_members_thumbnail_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_section_team_members_thumbnail_box_width',
			[
				'label'     => __( 'Width', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'separator' => 'after',
				'default'   => 100,
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-thumb'=> 'width: {{VALUE}}px;'
				],
				'condition' => [
					'exad_section_team_members_thumbnail_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'exad_section_team_members_thumbnail_box_border',
				'label'     => __( 'Border', 'exclusive-addons-elementor' ),
				'selector'  => '{{WRAPPER}} .exad-team-member-thumb',
				'condition' => [
					'exad_section_team_members_thumbnail_box' => 'yes'
				]
			]
		);
		
		$this->add_responsive_control(
			'exad_section_team_members_thumbnail_box_radius',
			[
				'label'      => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'after',
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-team-member-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .exad-team-member-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_section_team_members_thumbnail_box_margin_top',
			[
				'label'      => __( 'Top Spacing', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'default'    => [
					'unit'   => 'px',
					'size'   => 0
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-team-member-thumb' => 'margin-top: {{SIZE}}{{UNIT}};'
				],
				'condition'  => [
					'exad_section_team_members_thumbnail_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'exad_section_team_members_thumbnail_box_shadow',
				'label'     => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector'  => '{{WRAPPER}} .exad-team-member-thumb',
				'condition' => [
					'exad_section_team_members_thumbnail_box' => 'yes'
				]
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
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_team_member_content_alignment',
			[
				'label'   => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'exad-left'   => [
						'title'   => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'    => 'fa fa-align-left'
					],
					'exad-center' => [
						'title'   => __( 'Center', 'exclusive-addons-elementor' ),
						'icon'    => 'fa fa-align-center'
					],
					'exad-right'  => [
						'title'   => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'    => 'fa fa-align-center'
					]
				],
				'default' => 'exad-center'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'exad_team_members_content_background',
				'label'    => __( 'Background', 'exclusive-addons-elementor' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-team-member-content'
			]
		);

		$this->add_responsive_control(
			'exad_section_team_members_content_padding',
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
					'{{WRAPPER}} .exad-team-member-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_section_team_members_content_margin',
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
					'{{WRAPPER}} .exad-team-member-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_team_member_content_border_radius',
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
					'{{WRAPPER}} .exad-team-member-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_section_team_members_content_box_shadow',
				'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-member-content'
			]
		);
		
		$this->end_controls_section();

		/**
		 * Call to action Style
		 */

        $this->start_controls_section(
            'exad_team_member_cta_btn_style',
            [
				'label'     => __('Call to action', 'exclusive-addons-elementor'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_section_team_members_cta_btn' => 'yes'
				]
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_team_member_cta_btn_typography',
				'label'    => __( 'Typography', 'exclusive-addons-elementor' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .exad-team-member-cta'
			]
		);
		
		$this->add_responsive_control(
			'exad_team_member_cta_btn_margin',
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
					'{{WRAPPER}} .exad-team-member-cta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_team_member_cta_btn_padding',
			[
				'label'        => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-team-member-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_team_member_cta_btn_radius',
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
					'{{WRAPPER}} .exad-team-member-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'exad_team_member_cta_btn_tabs' );

			$this->start_controls_tab( 'exad_team_member_cta_btn_tab_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_responsive_control(
					'exad_team_member_cta_btn_text_color_normal',
					[
						'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222222',
						'selectors' => [
							'{{WRAPPER}} .exad-team-member-cta' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_responsive_control(
					'exad_team_member_cta_btn_background_normal',
					[
						'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#d6d6d6',
						'selectors' => [
							'{{WRAPPER}} .exad-team-member-cta' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'exad_team_member_cta_btn_border_normal',
						'label'    => __( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-team-member-cta'
					]
				);
		
			$this->end_controls_tab();

			$this->start_controls_tab( 'exad_team_member_cta_btn_tab_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_responsive_control(
					'exad_team_member_cta_btn_text_color_hover',
					[
						'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#d6d6d6',
						'selectors' => [
							'{{WRAPPER}} .exad-team-member-cta:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_responsive_control(
					'exad_team_member_cta_btn_background_hover',
					[
						'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222222',
						'selectors' => [
							'{{WRAPPER}} .exad-team-member-cta:hover' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'exad_team_member_cta_btn_border_hover',
						'label'    => __( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-team-member-cta:hover'
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
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_title_color',
            [
				'label'     => __('Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
                    '{{WRAPPER}} .exad-team-member-name' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .exad-team-member-name'
            ]
		);
		
		$this->add_responsive_control(
			'exad_team_members_title_margin',
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
					'{{WRAPPER}} .exad-team-member-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
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
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_designation_color',
            [
				'label'     => __('Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8a8d91',
				'selectors' => [
                    '{{WRAPPER}} .exad-team-member-designation' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'designation_typography',
				'selector' => '{{WRAPPER}} .exad-team-member-designation'
            ]
		);
		
		$this->add_responsive_control(
			'exad_team_members_designation_margin',
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
					'{{WRAPPER}} .exad-team-member-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
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
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_description_color',
            [
				'label'     => __('Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8a8d91',
				'selectors' => [
                    '{{WRAPPER}} .exad-team-member-about' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'exad_description_typography',
				'selector' => '{{WRAPPER}} .exad-team-member-about'
            ]
		);
				
		$this->add_responsive_control(
			'exad_team_members_description_margin',
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
					'{{WRAPPER}} .exad-team-member-about' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();
		
		/**
		 * Social icon style
		 */

        $this->start_controls_section(
            'exad_team_member_social_section',
            [
				'label' => __('Social Icon', 'exclusive-addons-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
		);
		

		$this->add_responsive_control(
			'exad_team_members_social_icon_size',
			[
				'label'      => __( 'Size', 'plugin-domain' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'       => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 18
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-team-member-social li a i' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_team_member_social_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'after',
				'default'    => [
					'top'    => '15',
					'right'  => '15',
					'bottom' => '15',
					'left'   => '15'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-team-member-social li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_team_members_social_box_radius',
			[
				'label'      => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-team-member-social li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_team_member_social_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'after',
				'selectors'  => [
					'{{WRAPPER}} .exad-team-member-social li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'exad_team_members_social_icons_style_tabs' );

			$this->start_controls_tab( 'exad_team_members_social_icon_tab', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_team_carousel_social_icon_color_normal',
					[
						'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#a4a7aa',
						'selectors' => [
							'{{WRAPPER}} .exad-team-member-social li a i' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'exad_team_carousel_social_bg_color_normal',
					[
						'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#FFF',
						'selectors' => [
							'{{WRAPPER}} .exad-team-member-social li a' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'exad_team_carousel_social_border_normal',
						'label'    => __( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-team-member-social li a'
					]
				);
		
			$this->end_controls_tab();

			$this->start_controls_tab( 'exad_team_members_social_icon_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_team_carousel_social_icon_color_hover',
					[
						'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#8a8d91',
						'selectors' => [
							'{{WRAPPER}} .exad-team-member-social li a:hover i' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'exad_team_carousel_social_bg_color_hover',
					[
						'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .exad-team-member-social li a:hover' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'exad_team_carousel_social_border_hover',
						'label'    => __( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-team-member-social li a:hover'
					]
				);

			$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();

		
	}
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'exad_team_member_name', 'class', 'exad-team-member-name' );
		$this->add_inline_editing_attributes( 'exad_team_member_name', 'none' );

		$this->add_render_attribute( 'exad_team_member_designation', 'class', 'exad-team-member-designation' );
		$this->add_inline_editing_attributes( 'exad_team_member_designation', 'none' );

		$this->add_render_attribute( 'exad_team_member_description', 'class', 'exad-team-member-about' );
		$this->add_inline_editing_attributes( 'exad_team_member_description' );

		$this->add_render_attribute( 'exad_team_member_item', [
            'class' => [ 
                'exad-team-member', 
                esc_attr( $settings['exad_team_member_content_alignment'] ),
                esc_attr( $settings['exad_team_membe_image_position'] )
            ]
        ]);

		$team_member_image         = $settings['exad_team_member_image'];
		$team_member_image_url_src = Group_Control_Image_Size::get_attachment_image_src( $team_member_image['id'], 'team_member_image_size', $settings );
		if( empty( $team_member_image_url_src ) ) {
			$team_member_image_url = $team_member_image['url']; 
		} else { 
			$team_member_image_url = $team_member_image_url_src;
		}

		$this->add_render_attribute( 'exad_team_members_cta_btn_link', 'class', 'exad-team-member-cta' );
		if( $settings['exad_team_members_cta_btn_link']['url'] ) {
            $this->add_render_attribute( 'exad_team_members_cta_btn_link', 'href', esc_url( $settings['exad_team_members_cta_btn_link']['url'] ) );
	        if( $settings['exad_team_members_cta_btn_link']['is_external'] ) {
	            $this->add_render_attribute( 'exad_team_members_cta_btn_link', 'target', '_blank' );
	        }
	        if( $settings['exad_team_members_cta_btn_link']['nofollow'] ) {
	            $this->add_render_attribute( 'exad_team_members_cta_btn_link', 'rel', 'nofollow' );
	        }
        }

		echo '<div class="exad-team-item">';
			do_action('exad_team_member_wrapper_before');
			echo '<div '.$this->get_render_attribute_string( 'exad_team_member_item' ).'>';

				if( !empty( $team_member_image_url ) ) {
					echo '<div class="exad-team-member-thumb">';
						echo '<img src="'.esc_url($team_member_image_url).'" class="circled" alt="'.Control_Media::get_image_alt( $settings['exad_team_member_image'] ).'">';
					echo '</div>';
				}

				echo '<div class="exad-team-member-content">';
					do_action('exad_team_member_content_area_before');
					if ( !empty( $settings['exad_team_member_name'] ) ) :
                        echo '<h2 '.$this->get_render_attribute_string( 'exad_team_member_name' ).'>'.esc_html( $settings['exad_team_member_name'] ).'</h2>';
					endif;

					if ( !empty( $settings['exad_team_member_designation'] ) ) :
                        echo '<span '.$this->get_render_attribute_string( 'exad_team_member_designation' ).'>'.esc_html( $settings['exad_team_member_designation'] ).'</span>';
					endif;

					do_action('exad_team_member_description_before');
					if ( !empty( $settings['exad_team_member_description'] ) ) :
                        echo '<p '.$this->get_render_attribute_string( 'exad_team_member_description' ).'>'.wp_kses_post( $settings['exad_team_member_description'] ).'</p>';
                    endif;
                    do_action('exad_team_member_description_after');

					if ( 'yes' === $settings['exad_section_team_members_cta_btn'] && !empty( $settings['exad_team_members_cta_btn_text'] ) ) :
						echo '<a '.$this->get_render_attribute_string( 'exad_team_members_cta_btn_link' ).'>';
							$this->render_text();
						echo '</a>';
                    endif;

					if ( 'yes' === $settings['exad_team_member_enable_social_profiles'] ):
						echo '<ul class="list-inline exad-team-member-social">';
							foreach ( $settings['exad_team_member_social_profile_links'] as $index => $item ) :
								$social = '';

								if ( 'svg' !== $item['social_icon']['library'] ) {
									$social = explode( ' ', $item['social_icon']['value'], 2 );
									if ( empty( $social[1] ) ) {
										$social = '';
									} else {
										$social = str_replace( 'fa-', '', $social[1] );
									}
								}
								if ( 'svg' === $item['social_icon']['library'] ) {
									$social = '';
								}
								$link_key = 'link_' . $index;

								$exad_heading_link = $item['link']['url'];
								if( $item['link']['url'] ) {
						            $this->add_render_attribute( $link_key, 'href', esc_url( $item['link']['url'] ) );
							        if( $item['link']['is_external'] ) {
							            $this->add_render_attribute( $link_key, 'target', '_blank' );
							        }
							        if( $item['link']['nofollow'] ) {
							            $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
							        }
						        }

						        $this->add_render_attribute( $link_key, 'class', [
									'exad-social-icon',
									'elementor-repeater-item-' . $item['_id'],
								] );

								echo '<li>';
			                        echo '<a '.$this->get_render_attribute_string( $link_key ).'>';
										Icons_Manager::render_icon( $item['social_icon'], [ 'aria-hidden' => 'true' ] );
			                        echo '</a>';
								echo '</li>';
							endforeach;
						echo '</ul>';
					endif;

					do_action('exad_team_member_content_area_after');
				echo '</div>';
			echo '</div>';
			do_action('exad_team_member_wrapper_after');
		echo '</div>';
	}

	protected function _content_template() {

		?>
		<#
			view.addRenderAttribute( 'exad_team_member_name', 'class', 'exad-team-member-name' );
			view.addInlineEditingAttributes( 'exad_team_member_name', 'none' );

			view.addRenderAttribute( 'exad_team_member_designation', 'class', 'exad-team-member-designation' );
			view.addInlineEditingAttributes( 'exad_team_member_designation', 'none' );

			view.addRenderAttribute( 'exad_team_member_description', 'class', 'exad-team-member-about' );
			view.addInlineEditingAttributes( 'exad_team_member_description' );

			view.addRenderAttribute( 'exad_team_members_cta_btn_link', 'class', 'exad-team-member-cta' );
			view.addRenderAttribute( 'exad_team_members_cta_btn_text', 'class', 'exad-team-cta-button-text' );
			view.addInlineEditingAttributes( 'exad_team_members_cta_btn_text', 'none' );

			view.addRenderAttribute( 'exad_team_member_item', {
				'class': [ 
					'exad-team-member', 
					settings.exad_team_member_content_alignment,
					settings.exad_team_membe_image_position
				]
			} );

			if ( settings.exad_team_member_image.url || settings.exad_team_member_image.id ) {
				var image = {
					id: settings.exad_team_member_image.id,
					url: settings.exad_team_member_image.url,
					size: settings.team_member_image_size_size,
					dimension: settings.team_member_image_size_custom_dimension,
					class: 'circled',
					model: view.getEditModel()
				};

				var image_url = elementor.imagesManager.getImageUrl( image );
			}
		#>

		<div class="exad-team-item">
		    <div {{{ view.getRenderAttributeString( 'exad_team_member_item' ) }}}>
		    	<# if ( image_url ) { #>
			    	<div class="exad-team-member-thumb">
						<img src="{{{ image_url }}}">
					</div>
				<# } #>
		        <div class="exad-team-member-content">
		        	<# if ( settings.exad_team_member_name ) { #>
		            	<h2 {{{ view.getRenderAttributeString( 'exad_team_member_name' ) }}}>
		            		{{{ settings.exad_team_member_name }}}
		            	</h2>
		            <# } #>

		            <# if ( settings.exad_team_member_designation ) { #>
		            <span {{{ view.getRenderAttributeString( 'exad_team_member_designation' ) }}}>
		            	{{{ settings.exad_team_member_designation }}}
		            </span>
		            <# } #>

		            <# if ( settings.exad_team_member_description ) { #>
		            	<p {{{ view.getRenderAttributeString( 'exad_team_member_description' ) }}}>
			            	{{{ settings.exad_team_member_description }}}
			            </p>
		            <# } #>

		            <# if ( 'yes' === settings.exad_section_team_members_cta_btn && settings.exad_team_members_cta_btn_text ) { #>
			            <a href="{{{ settings.exad_team_members_cta_btn_link.url }}}" {{{ view.getRenderAttributeString( 'exad_team_members_cta_btn_link' ) }}}>
							<span {{{ view.getRenderAttributeString( 'exad_team_members_cta_btn_text' ) }}}>
								{{{ settings.exad_team_members_cta_btn_text }}}
							</span>
						</a>
					<# } #>

					<# if ( 'yes' === settings.exad_team_member_enable_social_profiles ) { #>
						<ul class="list-inline exad-team-member-social">
							<# 
								var iconsHTML = {};
								_.each( settings.exad_team_member_social_profile_links, function( item, index ) {
								var link = item.link ? item.link.url : '';
							#>
							<li>
								<a class="exad-social-icon elementor-repeater-item-{{item._id}}" href="{{ link }}">
									<# iconsHTML[ index ] = elementor.helpers.renderIcon( view, item.social_icon, {}, 'i', 'object' ); #>
									{{{ iconsHTML[ index ].value }}}
								</a>
							</li>
							<# } ); #>
						</ul>
					<# } #>
		        </div>
		    </div>
		</div>

		<?php
	}

	protected function render_text() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'exad_team_members_cta_btn_text', 'class', 'exad-team-cta-button-text' );
		$this->add_inline_editing_attributes( 'exad_team_members_cta_btn_text', 'none' );
		?>
		<span <?php echo $this->get_render_attribute_string( 'exad_team_members_cta_btn_text' ); ?>><?php echo $settings['exad_team_members_cta_btn_text']; ?></span>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Team_Member() );