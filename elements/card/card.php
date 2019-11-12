<?php
namespace Elementor;

class Exad_Card extends Widget_Base {
	
	public function get_name() {
		return 'exad-exclusive-card';
	}

	public function get_title() {
		return esc_html__( 'Card', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-image-box';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
        return [ 'blurb', 'infobox', 'content', 'block', 'box' ];
    }

	protected function _register_controls() {
		
		/**
		* Card Content Section
		*/
		$this->start_controls_section(
			'exad_card_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
			]
		);
		
		$this->add_control(
			'exad_card_image',
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
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
					'exad_card_image[url]!' => ''
				]
			]
		);

		$this->add_control(
			'exad_card_title',
			[
				'label'       => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'separator'   => 'before',
				'default'     => esc_html__( 'Card Title', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_card_title_link',
			[
				'label'       => __( 'Title URL', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true
				]
			]
		);
		
		$this->add_control(
			'exad_card_tag',
			[
				'label'       => esc_html__( 'Tag', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Card Tag', 'exclusive-addons-elementor' )
			]
		);
		
		$this->add_control(
			'exad_card_description',
			[
				'label'   => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Basic description about the Card', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_card_action_button_content',
			[
				'label'     => __( 'Action Button ', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'exad_card_action_text',
			[
				'label'       => esc_html__( 'Text', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Details', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_card_action_link',
			[
				'label'       => __( 'URL', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => true
				]
			]
		);

		$this->add_control(
			'exad_card_action_link_icon',
			[
				'label'       => __( 'Icon', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true
			]
		);

		$this->add_control(
			'exad_card_action_link_icon_position',
			[
				'label'     => __( 'Icon Position', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'icon_pos_left'  => [
						'title'      => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'       => 'fa fa-angle-left'
					],
					'icon_pos_right' => [
						'title'      => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'       => 'fa fa-angle-right'
					]
				],
				'default'   => 'icon_pos_right',
				'toggle'    => false,
				'condition' => [
                    'exad_card_action_link_icon[value]!' => ''
                ]
			]
		);

		$this->end_controls_section();

		/**
		* Card Layout Section
		*/
		$this->start_controls_section(
			'exad_card_layout',
			[
				'label' => esc_html__( 'Layout', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_card_layout_type',
			[
				'label'   => __( 'Layout', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'       => __( 'Default', 'exclusive-addons-elementor' ),
					'text_on_image' => __( 'Text On Image', 'exclusive-addons-elementor' )
				]
			]
		);

		$this->end_controls_section();

		/*
		* Card Styling Section
		*/
		$this->start_controls_section(
			'exad_section_card_styles_preset',
			[
				'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'exad_card_background',
				'label'    => __( 'Background', 'exclusive-addons-elementor' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-card'
			]
		);

		$this->add_responsive_control(
			'exad_card_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'               => 'exad_card_border',
				'label'              => __( 'Border', 'exclusive-addons-elementor' ),
				'fields_options'     => [
                    'border'         => [
                        'default'    => 'solid',
                    ],
                    'width'          => [
                        'default'    => [
							'top'    => '1',
							'right'  => '1',
							'bottom' => '1',
							'left'   => '1'
                        ]
                    ],
                    'color'          => [
                        'default'    => '#e5e5e5'
                    ]
                ],
				'selector'           => '{{WRAPPER}} .exad-card'
			]
		);

		$this->add_responsive_control(
			'exad_card_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'exad_card_layout_type' => 'default'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_card_box_shadow',
				'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-card'
			]
		);

		$this->add_control(
			'exad_title_color_schema',
			[
				'label'     => __('Color Scheme', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff4a4a',
				'selectors' => [
					'{{WRAPPER}} .exad-card.text_on_image .exad-card-body .exad-card-title::before,
					{{WRAPPER}} .exad-card.default .exad-card-body .exad-card-title::before,
					{{WRAPPER}} .exad-card.text_on_image::before' => 'background: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();

		/*
		* Card Image Styling Section
		*/
		$this->start_controls_section(
			'exad_section_card_styles_image',
			[
				'label' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_responsive_control(
			'exad_card_image_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-card-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'exad_card_layout_type' => 'default'
				]
			]
		);

		$this->add_control(
			'exad_card_image_animation_heading',
			[
				'label'     => __( 'Animation', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'exad_card_image_zoom_animation',
			[
				'label'        => __( 'Zoom Animation', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'OFF', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->end_controls_section();

		/*
		* Card content Styling Section
		*/
		$this->start_controls_section(
			'exad_section_card_styles_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_card_content_alignment',
			[
				'label'     => __( 'Icon Position', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'      => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-left'
					],
					'center'    => [
						'title' => __( 'center', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-center'
					],
					'right'     => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-right'
					]
				],
				'default'   => 'left',
				'toggle'    => false				
			]
		);

		$this->add_control(
			'exad_card_content_background',
			[
				'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .exad-card-body' => 'background-color: {{VALUE}};'
				]
			]
		);
		
		$this->add_responsive_control(
			'exad_card_content_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '30',
					'right'  => '30',
					'bottom' => '30',
					'left'   => '30',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();


		/*
		* Card Content Styling Section
		*/
		$this->start_controls_section(
			'exad_section_card_styles_title',
			[
				'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'exad_title_color',
			[
				'label'     => __('Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .exad-card-body .exad-card-title' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'card_title_typography',
				'selector' => '{{WRAPPER}} .exad-card-body .exad-card-title'
			]
		);

		$this->add_responsive_control(
			'exad_card_title_margin',
			[
				'label'        => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-card-body .exad-card-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Exad Card tag Style
		 */
		$this->start_controls_section(
			'exad_section_card_styles_tag',
			[
				'label' => esc_html__( 'Tag', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'exad_tag_color',
			[
				'label'     => __('Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .exad-card-body .exad-card-tag' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'card_tag_typography',
				'selector' => '{{WRAPPER}} .exad-card-body .exad-card-tag'
			]
		);

		$this->add_responsive_control(
			'exad_card_tag_margin',
			[
				'label'        => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-card-body .exad-card-tag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		// description style
		$this->start_controls_section(
			'exad_section_card_styles_description',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'exad_description_color',
			[
				'label'     => __('Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .exad-card-body .exad-card-description' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'card_description_typography',
				'selector' => '{{WRAPPER}} .exad-card-body .exad-card-description'
			]
		);

		$this->add_responsive_control(
			'exad_card_description_margin',
			[
				'label'        => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-card-body .exad-card-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Exad Card Button Style 
		 */

		$this->start_controls_section(
			'exad_section_card_styles_button',
			[
				'label' => esc_html__( 'Button', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'exad_card_button_icon_spacing',
			[
				'label'       => __( 'Icon Spacing', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 50
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 10
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-card-body .exad-card-action .icon_pos_right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-card-body .exad-card-action .icon_pos_left'  => 'margin-right: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_card_button_typography',
				'selector' => '{{WRAPPER}} .exad-card-body .exad-card-action'
			]
		);

		$this->add_responsive_control(
			'exad_card_button_padding',
			[
				'label'        => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px' ],
				'default'      => [
					'top'      => '15',
					'right'    => '35',
					'bottom'   => '15',
					'left'     => '35',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-card-body .exad-card-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_card_button_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-card-body .exad-card-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_card_button_offset',
			[
				'label'       => __( 'Offset', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 200
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 0
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-card-body .exad-card-action' => 'margin-bottom: -{{SIZE}}{{UNIT}};'
				],
				'condition'   => [
					'exad_card_layout_type' => 'default'
				]
			]
		);

		$this->start_controls_tabs( 'exad_card_button_tabs' );

			$this->start_controls_tab( 'exad_card_button_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_card_button_normal_color',
					[
						'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222222',
						'selectors' => [
							'{{WRAPPER}} .exad-card-body .exad-card-action' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'exad_card_button_normal_bg',
					[
						'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .exad-card-body .exad-card-action' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'exad_card_button_normal_border',
						'label'    => __( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-card-body .exad-card-action'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'exad_card_button_normal_box_shadow',
						'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
						 'fields_options'     => [
				            'box_shadow_type' => [
				                'default'     =>'yes'
				            ],
				            'box_shadow'         => [
				                'default'        => [
				                    'horizontal' => 0,
				                    'vertical'   => 0,
				                    'blur'       => 10,
				                    'spread'     => 0,
				                    'color'      => 'rgba(9,24,33,0.1)'
				                ]
				            ]
			            ],
						'selector' => '{{WRAPPER}} .exad-card-body .exad-card-action'
					]
				);
		
			$this->end_controls_tab();

			$this->start_controls_tab( 'exad_card_button_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_card_button_hover_color',
					[
						'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .exad-card-body .exad-card-action:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'exad_card_button_hover_bg',
					[
						'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222222',
						'selectors' => [
							'{{WRAPPER}} .exad-card-body .exad-card-action:hover' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'exad_card_button_hover_border',
						'label'    => __( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-card-body .exad-card-action:hover'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'exad_card_button_hover_box_shadow',
						'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-card-body .exad-card-action:hover'
					]
				);

			$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings           = $this->get_settings_for_display();
		$card_image         = $this->get_settings_for_display( 'exad_card_image' );
		$card_image_url_src = Group_Control_Image_Size::get_attachment_image_src( $card_image['id'], 'thumbnail', $settings );
		if( empty( $card_image_url_src ) ) {
			$card_image_url = $card_image['url'];
		} else {
			$card_image_url = $card_image_url_src;
		}

		$this->add_render_attribute( 
			'exad_card', 
			[ 
				'class' => [ 
					'exad-card', 
					esc_attr( $settings['exad_card_content_alignment'] ), 
					esc_attr( $settings['exad_card_layout_type'] ), 
					esc_attr( $settings['exad_card_image_zoom_animation'] )
				]
			]
		);

		$this->add_inline_editing_attributes( 'exad_card_title', 'none' );

		$this->add_inline_editing_attributes( 'exad_card_tag', 'none' );
		$this->add_render_attribute( 'exad_card_tag', 'class', 'exad-card-tag' );

		$this->add_inline_editing_attributes( 'exad_card_description' );
		$this->add_render_attribute( 'exad_card_description', 'class', 'exad-card-description' );

		$this->add_render_attribute( 'exad_card_title_link', 'class', 'exad-card-title' );
		if( $settings['exad_card_title_link']['url'] ) {
            $this->add_render_attribute( 'exad_card_title_link', 'href', esc_url( $settings['exad_card_title_link']['url'] ) );
        }
        if( $settings['exad_card_title_link']['is_external'] ) {
            $this->add_render_attribute( 'exad_card_title_link', 'target', '_blank' );
        }
        if( $settings['exad_card_title_link']['nofollow'] ) {
            $this->add_render_attribute( 'exad_card_title_link', 'rel', 'nofollow' );
        }

		$this->add_render_attribute( 'exad-card-action-anchor-params', 'class', 'exad-card-action' );
		if( $settings['exad_card_action_link']['url'] ) {
            $this->add_render_attribute( 'exad-card-action-anchor-params', 'href', esc_url( $settings['exad_card_action_link']['url'] ) );
        }
        if( $settings['exad_card_action_link']['is_external'] ) {
            $this->add_render_attribute( 'exad-card-action-anchor-params', 'target', '_blank' );
        }
        if( $settings['exad_card_action_link']['nofollow'] ) {
            $this->add_render_attribute( 'exad-card-action-anchor-params', 'rel', 'nofollow' );
        }

		echo '<div '.$this->get_render_attribute_string( 'exad_card' ).'>';
			// if( !empty( $card_image_url ) ) :
	  //       	echo '<div class="exad-card-thumb">';
	  //           	echo '<img src="'.esc_url($card_image_url).'" alt="'.Control_Media::get_image_alt( $settings['exad_card_image'] ).'">';
	  //         	echo '</div>';
			// endif;
          	echo '<div class="exad-card-body">';
          		if( $settings['exad_card_title'] ) {
	          		echo '<a '.$this->get_render_attribute_string( 'exad_card_title_link' ).'>';
	            		echo '<span '.$this->get_render_attribute_string( 'exad_card_title' ).'>'.esc_html( $settings['exad_card_title'] ).'</span>';
	        		echo '</a>';          			
          		}
        		$settings['exad_card_tag'] ? printf( '<p '.$this->get_render_attribute_string( 'exad_card_tag' ).'>%s</p>', esc_html( $settings['exad_card_tag'] ) ) : '';
        		$settings['exad_card_description'] ? printf( '<p '.$this->get_render_attribute_string( 'exad_card_description' ).'>%s</p>', wp_kses_post( $settings['exad_card_description'] ) ) : '';
				echo '<a '.$this->get_render_attribute_string( 'exad-card-action-anchor-params' ).'>';
					if( 'icon_pos_left' === $settings['exad_card_action_link_icon_position'] &&  !empty( $settings['exad_card_action_link_icon']['value'] ) ) {
						echo '<span class="'.esc_attr( $settings['exad_card_action_link_icon_position'] ).'">';
							Icons_Manager::render_icon( $settings['exad_card_action_link_icon'] );
						echo '</span>';
					}
					echo esc_html( $settings['exad_card_action_text'] );
					if( 'icon_pos_right' === $settings['exad_card_action_link_icon_position'] &&  !empty( $settings['exad_card_action_link_icon']['value'] ) ) {
						echo '<span class="'.esc_attr( $settings['exad_card_action_link_icon_position'] ).'">';
							Icons_Manager::render_icon( $settings['exad_card_action_link_icon'] );
						echo '</span>';
					}
            	echo '</a>';
          	echo '</div>';
        echo '</div>';
	}

	protected function _content_template() {
		?>
<!-- 		<#
			view.addRenderAttribute( 'exad_card', {
				'class': [ 
					'exad-card', 
					settings.exad_card_content_alignment,
					settings.exad_card_layout_type,
					settings.exad_card_image_zoom_animation
				]
			} );
		#>
		<div {{{ view.getRenderAttributeString( 'exad_card' ) }}}>

		</div> -->
		<?php	
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Card() );