<?php
namespace Elementor;

class Exad_Modal_Popup extends Widget_Base {
	
	public function get_name() {
		return 'exad-modal-popup';
	}
	public function get_title() {
		return esc_html__( 'Modal Popup', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-eye';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	public function get_script_depends() {
		return [ 'exad-magnific-popup' ];
	}
	public function get_keywords() {
		return [ 'modal', 'lightbox', 'popup' ];
	}

	protected function _register_controls() {

		/**
		 * Modal Popup Content section
		 */
		$this->start_controls_section(
			'exad_modal_content_section',
			[
				'label' => __( 'Contents', 'exclusive-addons-elementor' )
			]
		);

			$this->add_control(
				'exad_modal_content',
				[
					'label'   => __( 'Type of Modal', 'exclusive-addons-elementor' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'image',
                    'options' => [
						'image'         => __( 'Image', 'exclusive-addons-elementor' ),
						'image-gallery' => __( 'Image Gallery', 'exclusive-addons-elementor' ),
						'html_content'  => __( 'HTML Content', 'exclusive-addons-elementor' ),
						'youtube'       => __( 'Youtube Video', 'exclusive-addons-elementor' ),
						'vimeo'       => __( 'Vimeo Video', 'exclusive-addons-elementor' ),
						'external-video'       => __( 'Self Hosted Video', 'exclusive-addons-elementor' ),
						'external_page'      => __( 'External Page', 'exclusive-addons-elementor' ),
					]
				]
			);

			/**
			 * Modal Popup image section
			 */
			$this->add_control(
				'exad_modal_image',
				[
					'label'     => __( 'Image', 'exclusive-addons-elementor' ),
					'type'      => Controls_Manager::MEDIA,
					'default'   => [
						'url' 	=> Utils::get_placeholder_image_src()
					],
					'dynamic'   => [
						'active' => true
                    ],
                    'condition' => [
                        'exad_modal_content' => 'image'
                    ]
				]
			);

			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' => 'thumbnail',
					'default' => 'full',
					'condition' => [
                        'exad_modal_content' => 'image'
                    ]
				]
			);
			/**
			 * Modal Popup image gallery
			 */

			$this->add_control(
				'exad_modal_image_gallery_column',
				[
					'label'   => __( 'Column', 'exclusive-addons-elementor' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'column-three',
                    'options' => [
						'column-one'         => __( 'Column 1', 'exclusive-addons-elementor' ),
						'column-two'         => __( 'Column 2', 'exclusive-addons-elementor' ),
						'column-three'         => __( 'Column 3', 'exclusive-addons-elementor' ),
						'column-four'         => __( 'Column 4', 'exclusive-addons-elementor' ),
						'column-five'         => __( 'Column 5', 'exclusive-addons-elementor' ),
						'column-six'         => __( 'Column 6', 'exclusive-addons-elementor' ),
					],
					'condition' => [
						'exad_modal_content' => 'image-gallery',
					]
				]
			);

			$image_repeater = new Repeater();

			$image_repeater->add_control(
				'exad_modal_image_gallery',
				[
					'label'   => __( 'Image', 'exclusive-addons-elementor' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src()
					]
				]
			);

			$image_repeater->add_control(
				'exad_modal_image_gallery_text',
				[
					'label' => __( 'Description', 'exclusive-addons-elementor' ),
					'type'  => Controls_Manager::TEXTAREA
				]
			);

			$this->add_control(
				'exad_modal_image_gallery_repeater',
				[
					'label'   => esc_html__( 'Image Gallery', 'exclusive-addons-elementor' ),
					'type'    => Controls_Manager::REPEATER,
					'fields'  => $image_repeater->get_controls(),
					'default' => [
						[
							'exad_modal_image_gallery' => Utils::get_placeholder_image_src()
						],
						[
							'exad_modal_image_gallery' => Utils::get_placeholder_image_src()
						],
						[
							'exad_modal_image_gallery' => Utils::get_placeholder_image_src()							
						]
					],
					'condition' => [
						'exad_modal_content' => 'image-gallery'
					]
				]
			);
			/**
			 * Modal Popup html content section
			 */
			$this->add_control(
				'exad_modal_html_content',
					[
						'label'   => __( 'Add your content here (HTML/Shortcode)', 'exclusive-addons-elementor' ),
						'type'    => Controls_Manager::WYSIWYG,
						'default' => __( 'Add your popup content here', 'exclusive-addons-elementor' ),
						'dynamic' => [ 'active' => true ],
						'condition' => [
						  	'exad_modal_content' => 'html_content'
					  	]
					]
			);

			/**
			 * Modal Popup video section
			 */

			$this->add_control(
                'exad_modal_youtube_video_url',
                [
                    'label' => __( 'Provide Youtube Video URL', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => 'https://www.youtube.com/watch?v=q9fL_nJJoZE',
                    'placeholder' => __( 'Place Youtube Video URL', 'exclusive-addons-elementor' ),
                    'title' => __( 'Place Youtube Video URL', 'exclusive-addons-elementor' ),
                    'condition' => [
                        'exad_modal_content' => 'youtube'
                    ],
                ]
            );

			
            $this->add_control(
                'exad_modal_vimeo_video_url',
                [
					'label'       => __( 'Provide Vimeo Video URL', 'exclusive-addons-elementor' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => 'https://vimeo.com/347565673',
					'placeholder' => __( 'Place Vimeo Video URL', 'exclusive-addons-elementor' ),
					'title'       => __( 'Place Vimeo Video URL', 'exclusive-addons-elementor' ),
					'condition' => [
                        'exad_modal_content' => 'vimeo'
                    ]
                ]
			);

			/**
			 * Modal Popup external video section
			 */
			$this->add_control(
				'exad_modal_external_video',
				[
					'label'     => __( 'External Video', 'exclusive-addons-elementor' ),
					'type'      => Controls_Manager::MEDIA,
					'media_type' => 'video',
                    'condition' => [
                        'exad_modal_content' => 'external-video'
                    ]
				]
			);
			
			$this->add_control(
                'exad_modal_external_page_url',
                [
					'label'       => __( 'Provide External URL', 'exclusive-addons-elementor' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default' => 'https://www.tutorialrepublic.com',
					'placeholder' => __( 'Place External Page URL', 'exclusive-addons-elementor' ),
					'condition' => [
                        'exad_modal_content' => 'external_page'
                    ]
                ]
            );
            
            $this->add_control(
                'exad_modal_video_width',
                [
					'label'      => __( 'Video Width', 'exclusive-addons-elementor' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
                        'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 5
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 720
                    ],
                    'selectors' => [
						'{{WRAPPER}} .exad-modal-item .exad-modal-content .exad-modal-element iframe,
						{{WRAPPER}} .exad-modal-item .exad-modal-content .exad-video-hosted' => 'width: {{SIZE}}{{UNIT}};'
                    ],
                    'condition' => [
                        'exad_modal_content' => [ 'youtube', 'vimeo', 'external_page', 'external-video' ]
                    ]
                ]
            );

            $this->add_control(
                'exad_modal_video_height',
                [
					'label'      => __( 'Video Height', 'exclusive-addons-elementor' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
                        'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 5
                        ],
                        '%' => [
							'min' => 0,
							'max' => 100
                        ]
                    ],
                    'default' => [
						'unit' => 'px',
						'size' => 400
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .exad-modal-item .exad-modal-content .exad-modal-element iframe' => 'height: {{SIZE}}{{UNIT}};'
                    ],
                    'condition' => [
                        'exad_modal_content' => [ 'youtube', 'vimeo', 'external_page' ]
                    ]
                ]
            );


		$this->end_controls_section();

		/**
		 * Modal Popup settings section
		 */
		$this->start_controls_section(
			'exad_modal_setting_section',
			[
				'label' => __( 'Settings', 'exclusive-addons-elementor' ),
			]
		);
		
		$this->add_control(
			'exad_modal_overlay',
			[
				'label'        => __( 'Overlay', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);
		
		$this->add_control(
			'exad_modal_overlay_click_close',
			[
				'label'        => __( 'Close While Clicked Outside', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'OFF', 'exclusive-addons-elementor' ),
				'default'      => 'yes',
				'condition' => [
					'exad_modal_overlay' => 'yes'
				]
			]
		);
        
		$this->end_controls_section();

		/**
		 * Modal Popup button style
		 */

		$this->start_controls_section(
			'exad_modal_display_settings',
			[
				'label' => __( 'Popup Button', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

			$this->add_control(
				'exad_modal_btn_width',
				[
					'label'      => esc_html__( 'Width', 'exclusive-addons-elementor' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min' => 0,
							'max' => 500,
							'step' => 1
						],
						'%' => [
							'min' => 0,
							'max' => 100
						]
					],
					'default' => [
						'unit' => '%',
						'size' => 50
					],
					'selectors' => [
						'{{WRAPPER}} .exad-modal-button .exad-modal-image-action' => 'width: {{SIZE}}{{UNIT}};'
					]
				]
			);

			$this->add_control(
				'exad_modal_btn_text',
				[
					'label'       => __( 'Button Text', 'exclusive-addons-elementor' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => __( 'Click Me', 'exclusive-addons-elementor' ),
					'dynamic'     => [
						'active'  => true
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'exad_modal_btn_typhography',
					'label'     => __( 'Button Typography', 'exclusive-addons-elementor' ),
					'selector'  => '{{WRAPPER}} .exad-modal-button .exad-modal-image-action span',
				]
			);

			$this->add_control(
				'exad_modal_btn_radius',
				[
					'label' => __( 'Border Radius', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'default' => [
						'top' => '6',
						'right' => '6',
						'bottom' => '6',
						'left' => '6',
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .exad-modal-image-action, {{WRAPPER}} .exad-modal-image-action::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'exad_modal_btn_padding',
				[
					'label' => __( 'Padding', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'default' => [
						'top' => '20',
						'right' => '0',
						'bottom' => '20',
						'left' => '0',
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .exad-modal-image-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			/**
			 * display settings for button normal and hover
			 */
			$this->start_controls_tabs( 'exad_modal_btn_typhography_color',[
				'separator' => 'before'
			] );

				$this->start_controls_tab( 'exad_modal_btn_typhography_color_normal_tab', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' )] );

					$this->add_control(
						'exad_modal_btn_typhography_color_normal',
						[
							'label'     => __( 'Button Text Color', 'exclusive-addons-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#ffffff',
							'selectors' => [
								'{{WRAPPER}} .exad-modal-button .exad-modal-image-action span' => 'color: {{VALUE}};'
							],
						]
					);

					$this->add_control(
						'exad_modal_btn_background_normal',
						[
							'label'     => __( 'Background', 'exclusive-addons-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#7448F6',
							'selectors' => [
								'{{WRAPPER}} .exad-modal-button .exad-modal-image-action' => 'background: {{VALUE}};'
							],
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'exad_modal_btn_border_normal',
							'label'    => __( 'Border', 'exclusive-addons-elementor' ),
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
									'default' => '#3655b3',
								],
							],
							'selector' => '{{WRAPPER}} .exad-modal-button .exad-modal-image-action',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab( 'exad_modal_btn_typhography_color_hover_tab', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

					$this->add_control(
						'exad_modal_btn_typhography_color_hover',
						[
							'label'     => __( 'Button Text Color', 'exclusive-addons-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#3655b3',
							'selectors' => [
								'{{WRAPPER}} .exad-modal-button .exad-modal-image-action:hover span' => 'color: {{VALUE}};'
							],
						]
					);

					$this->add_control(
						'exad_modal_btn_background_hover',
						[
							'label'     => __( 'Background', 'exclusive-addons-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#ffffff',
							'selectors' => [
								'{{WRAPPER}} .exad-modal-button .exad-modal-image-action:before' => 'background: {{VALUE}};'
							],
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'exad_modal_btn_border_hover',
							'label'    => __( 'Border', 'exclusive-addons-elementor' ),
							'selector' => '{{WRAPPER}} .exad-modal-button .exad-modal-image-action:hover'
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();

			/**
			 * display settings for button alignment
			 */
			$this->add_responsive_control(
				'exad_modal_btn_align',
				[
					'label'     => __( 'Alignment', 'exclusive-addons-elementor' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'left'  => [
							'title' => __( 'Left', 'exclusive-addons-elementor' ),
							'icon'  => 'fa fa-align-left'
						],
						'center'  => [
							'title' => __( 'Center', 'exclusive-addons-elementor' ),
							'icon'  => 'fa fa-align-center'
						],
						'right'   => [
							'title' => __( 'Right', 'exclusive-addons-elementor' ),
							'icon'  => 'fa fa-align-right'
						]
					],
					'default'   => 'center',
					'selectors' => [
						'{{WRAPPER}} .exad-modal-button' => 'text-align: {{VALUE}};'
					],
					'separator' => 'before',
					'toggle'    => false
				]
			);

			/**
			 * Display Settings icon 
			 */
			$this->add_control(
				'exad_modal_btn_icon',
				[
					'label'       => __( 'Icon', 'exclusive-addons-elementor' ),
					'type'        => Controls_Manager::ICON,
					'label_block' => true,
					'default'     => 'fa fa-wordpress',
				]
			);

			$this->add_control(
				'exad_modal_btn_icon_align',
				[
					'label'     => __( 'Icon Position', 'exclusive-addons-elementor' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'left',
					'options'   => [
						'left'  => __( 'Before', 'exclusive-addons-elementor' ),
						'right' => __( 'After', 'exclusive-addons-elementor' )
					],
				]
			);

			$this->add_control(
				'exad_modal_btn_icon_indent',
				[
					'label'     => __( 'Icon Spacing', 'exclusive-addons-elementor' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'max' => 50
						]
					],
					'selectors' => [
						'{{WRAPPER}} .exad-modal-button .exad-modal-image-action span .exad-modal-action-left-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .exad-modal-button .exad-modal-image-action span .exad-modal-action-right-icon' => 'margin-left: {{SIZE}}{{UNIT}};'
					]
				]
			);

        $this->end_controls_section();
        
		/**
		 * Modal Popup Container section
		 */
		$this->start_controls_section(
			'exad_modal_container_section',
			[
				'label' => __( 'Container', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_control(
			'exad_modal_content_align',
			[
				'label'     => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'  => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-left'
					],
					'center'  => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-center'
					],
					'right'   => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-right'
					]
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .exad-modal-item .exad-modal-content .exad-modal-element' => 'text-align: {{VALUE}};'
				],
				'condition' => [
					'exad_modal_content' => ['image-gallery', 'html_content'],
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_modal_image_gallery_description_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-modal-content .exad-modal-element .exad-modal-element-card .exad-modal-element-card-body p',
				'condition' => [
					'exad_modal_content' => [ 'image-gallery' ],
				]
			]
		);

		$this->add_control(
			'exad_modal_image_gallery_description_color',
			[
				'label'   => __( 'Description Color', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .exad-modal-content .exad-modal-element .exad-modal-element-card .exad-modal-element-card-body p'  => 'color: {{VALUE}};'
				],
				'condition' => [
					'exad_modal_content' => [ 'image-gallery' ],
				]
			]
		);
        
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'exad_modal_content_border',
				'label'    => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-modal-item .exad-modal-content .exad-modal-element'
			]
		);
		
		$this->add_control(
			'exad_modal_image_gallery_bg',
			[
				'label'   => __( 'Background Color', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-modal-item .exad-modal-content .exad-modal-element'  => 'background: {{VALUE}};'
				],
				'condition' => [
					'exad_modal_content' => ['image-gallery', 'html_content'],
				]
			]
		);

		$this->add_control(
			'exad_modal_image_gallery_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-modal-item .exad-modal-content .exad-modal-element .exad-modal-element-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .exad-modal-item .exad-modal-content .exad-modal-element' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'exad_modal_content' => ['image-gallery', 'html_content'],
				]
			]
		);
        
		$this->end_controls_section();

		$this->start_controls_section(
			'exad_modal_animation_tab',
			[
				'label' => __( 'Animation', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'exad_modal_transition',
			[
				'label'   => __( 'Animated Style', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top-to-middle',
				'options' => [
					'top-to-middle'    => __( 'Top To Middle', 'exclusive-addons-elementor' ),
					'bottom-to-middle' => __( 'Bottom To Middle', 'exclusive-addons-elementor' ),
					'right-to-middle'  => __( 'Right To Middle', 'exclusive-addons-elementor' ),
					'left-to-middle'   => __( 'Left To Middle', 'exclusive-addons-elementor' ),
					'zoom-in'          => __( 'Zoom In', 'exclusive-addons-elementor' ),
					'zoom-out'         => __( 'Zoom Out', 'exclusive-addons-elementor' ),
					'left-rotate'         => __( 'Rotatation', 'exclusive-addons-elementor' ),
				]
			]
		);
		$this->end_controls_section();
		
		/**
		 * Modal Popup overlay style
		 */
        
		$this->start_controls_section(
			'exad_modal_overlay_tab',
			[
				'label'     => __( 'Overlay', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_modal_overlay' => 'yes'
				]
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'exad_modal_overlay_color',
				'label'    => __( 'Color', 'exclusive-addons-elementor' ),
				'default'  => 'rgba(0, 0, 0, .5)',
				'types'    => [ 'classic' ],
				'selector' => '{{WRAPPER}} .exad-modal-overlay'
			]
		);
		$this->end_controls_section();

		/**
		 * Modal Popup Close button style
		 */

		$this->start_controls_section(
			'exad_modal_close_btn_style',
			[
				'label' => __( 'Close Button', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

        $this->add_control(
			'exad_modal_close_btn_color',
			[
				'label'    => __( 'Color', 'exclusive-addons-elementor' ),
				'type'     => Controls_Manager::COLOR,
				'default'  => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-modal-item.modal-vimeo .exad-modal-content .exad-close-btn span::before, {{WRAPPER}} .exad-modal-item.modal-vimeo .exad-modal-content .exad-close-btn span::after'  => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'exad_modal_close_btn_bg_color',
			[
				'label'    => __( 'Background Color', 'exclusive-addons-elementor' ),
				'type'     => Controls_Manager::COLOR,
				'default'  => 'transparent',
				'selectors' => [
					'{{WRAPPER}} .exad-modal-item.modal-vimeo .exad-modal-content .exad-close-btn'  => 'background: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();
		
	}

	protected function render() { 
		$settings = $this->get_settings_for_display();

		$modal_image = $this->get_settings_for_display( 'exad_modal_image' );
		$modal_image_url_src = Group_Control_Image_Size::get_attachment_image_src( $modal_image['id'], 'thumbnail', $settings );
		if( empty( $modal_image_url_src ) ) {
			$modal_image_url = $modal_image['url']; 
		} else { 
			$modal_image_url = $modal_image_url_src;
		}

		if($settings['exad_modal_content'] === 'youtube'){
			$url    = $settings['exad_modal_youtube_video_url'];
	
			preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches);
	
			$youtube_id = $matches[1];
		}

		if($settings['exad_modal_content'] === 'vimeo'){
			$vimeo_url    = $settings['exad_modal_vimeo_video_url'];

			$vimeo_id_select   = explode('/', $vimeo_url);
			$vidid      = explode( '&', str_replace('https://vimeo.com', '', end($vimeo_id_select) ) );
			$vimeo_id = $vidid[0];
		}

		$this->add_render_attribute( 'exad_modal_action', [
			'class' => 'exad-modal-image-action image-modal',
			'data-exad-modal' => '#exad-modal-' . $this->get_id(),
			'data-exad-overlay' => $settings['exad_modal_overlay'],
		] );

		$this->add_render_attribute( 'exad_modal_overlay', [
			'class' => 'exad-modal-overlay',
			'data-exad_overlay_click_close' => $settings['exad_modal_overlay_click_close'],
		] );

		$this->add_render_attribute( 'exad_modal_item', 'class', 'exad-modal-item' );
		$this->add_render_attribute( 'exad_modal_item', 'class', 'modal-vimeo' );
		$this->add_render_attribute( 'exad_modal_item', 'class', $settings['exad_modal_transition'] );
		$this->add_render_attribute( 'exad_modal_item', 'class', $settings['exad_modal_content'] );

	?>
		
		<div class="exad-modal">
          	<div class="exad-modal-wrapper">

            	<div class="exad-modal-button">
              		<a href="#" <?php echo $this->get_render_attribute_string('exad_modal_action'); ?>>
						<?php if( $settings['exad_modal_btn_icon_align'] === 'left' ) { ?>
							<span>
								<i class="exad-modal-action-left-icon <?php echo esc_attr( $settings['exad_modal_btn_icon'] ); ?>"></i>
								<?php echo esc_attr( $settings['exad_modal_btn_text'] ); ?>
							</span>
						<?php } ?>
						<?php if( $settings['exad_modal_btn_icon_align'] === 'right' ) { ?>
							<span>
								<?php echo esc_attr( $settings['exad_modal_btn_text'] ); ?>
								<i class="exad-modal-action-right-icon <?php echo esc_attr( $settings['exad_modal_btn_icon'] ); ?>"></i>
							</span>
						<?php } ?>
              		</a>
				</div>
			
				<div id="exad-modal-<?php echo esc_attr($this->get_id()); ?>" <?php echo $this->get_render_attribute_string('exad_modal_item'); ?>">
             		<div class="exad-modal-content">
                		<div class="exad-modal-element <?php echo ( $settings['exad_modal_image_gallery_column'] ); ?>">
							<?php if ( $settings['exad_modal_content'] === 'image' ) { ?>
								<img src="<?php echo esc_url($modal_image_url); ?>" />
							<?php } ?>
							<?php if ( $settings['exad_modal_content'] === 'image-gallery' ) { ?>
								<?php foreach ( $settings['exad_modal_image_gallery_repeater'] as $gallery ) : ?>
									<?php
										$image_gallery = $gallery[ 'exad_modal_image_gallery' ];
										$image_gallery_url = Group_Control_Image_Size::get_attachment_image_src( $image_gallery['id'], 'thumbnail', $gallery );
								
										if ( empty( $image_gallery_url ) ) {
											$image_gallery_url = $image_gallery['url'];
										} else {
											$image_gallery_url = $image_gallery_url;
										}
									?>
									<div class="exad-modal-element-card">
										<div class="exad-modal-element-card-thumb">
											<img src="<?php echo esc_url( $image_gallery_url ); ?>" >
										</div>
										<?php if ( !empty( $gallery['exad_modal_image_gallery_text'] ) ) { ?>
											<div class="exad-modal-element-card-body">
												<p><?php echo esc_attr( $gallery['exad_modal_image_gallery_text'] ); ?></p>
											</div>
										<?php } ?>
									</div>
								<?php endforeach; ?>
							<?php } ?>
							<?php if ( $settings['exad_modal_content'] === 'html_content' ) { ?>
								<div class="exad-modal-element-body">
									<?php echo wpautop(wp_kses_post($settings['exad_modal_html_content'])); ?>
								</div>
							<?php } ?>
							<?php if ( $settings['exad_modal_content'] === 'youtube' ) { ?>
								<iframe src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>" frameborder="0" allowfullscreen>
								</iframe>
							<?php } ?>
							<?php if ( $settings['exad_modal_content'] === 'vimeo' ) { ?>
								<iframe id="vimeo-video" src="https://player.vimeo.com/video/<?php echo $vimeo_id; ?>" frameborder="0" allowfullscreen >
								</iframe>
							<?php } ?>
							<?php if ( $settings['exad_modal_content'] === 'external-video' ) { ?>
								<video class="exad-video-hosted" src="<?php echo esc_attr( $settings['exad_modal_external_video']['url'] ); ?>" controls="" controlslist="nodownload"  >
								</video>
							<?php } ?>
							<?php if ( $settings['exad_modal_content'] === 'external_page' ) { ?>
								<iframe src="<?php echo esc_attr( $settings['exad_modal_external_page_url'] ); ?>" frameborder="0" allowfullscreen >
								</iframe>
							<?php } ?>
							<div class="exad-close-btn">
								<span></span>
							</div>
                		</div>
              		</div>
            	</div>
			</div>
			<div <?php echo $this->get_render_attribute_string('exad_modal_overlay'); ?>></div>
		</div>

	<?php
	}


}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Modal_Popup() );