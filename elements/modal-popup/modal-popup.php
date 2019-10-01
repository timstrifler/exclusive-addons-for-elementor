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
						'image_gallery' => __( 'Image Gallery', 'exclusive-addons-elementor' ),
						'html_content'  => __( 'HTML Content', 'exclusive-addons-elementor' ),
						'video'         => __( 'Video Content Or External page', 'exclusive-addons-elementor' )
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
			/**
			 * Modal Popup image gallery
			 */
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
						'exad_modal_content' => 'image_gallery'
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
                'exad_modal_video_type',
                [
					'label'   => __( 'Choose Video Type', 'exclusive-addons-elementor' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'youtube',
					'options' => [
						'youtube'       => __( 'Youtube', 'exclusive-addons-elementor' ),
						'vimeo'         => __( 'Vimeo', 'exclusive-addons-elementor' ),
						'external_page' => __( 'External Page', 'exclusive-addons-elementor' )
                    ],
                    'condition' => [
                        'exad_modal_content' => 'video'
                    ]
                ]
            );

            $this->add_control(
                'exad_modal_youtube_video_url',
                [
					'label'       => __( 'Provide Youtube Video URL', 'exclusive-addons-elementor' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => 'https://www.youtube.com/embed/D7ovwGioN9E',
					'placeholder' => __( 'Place Youtube Video URL', 'exclusive-addons-elementor' ),
					'title'       => __( 'Place Youtube Video URL', 'exclusive-addons-elementor' ),
					'condition'   => [
						'exad_modal_content'    => 'video',
						'exad_modal_video_type' => 'youtube'
                    ]
                ]
            );
            $this->add_control(
                'exad_modal_vimeo_video_url',
                [
					'label'       => __( 'Provide Vimeo Video URL', 'exclusive-addons-elementor' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => 'https://player.vimeo.com/video/180565514?api=1&player_id=vimeoplayer',
					'placeholder' => __( 'Place Vimeo Video URL', 'exclusive-addons-elementor' ),
					'title'       => __( 'Place Vimeo Video URL', 'exclusive-addons-elementor' ),
					'condition'   => [
						'exad_modal_content'    => 'video',
						'exad_modal_video_type' => 'vimeo'
                    ]
                ]
            );
            $this->add_control(
                'exad_modal_external_page_url',
                [
					'label'       => __( 'Provide External Page URL', 'exclusive-addons-elementor' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => 'http://exclusiveaddons.com/',
					'placeholder' => __( 'Place External Page URL', 'exclusive-addons-elementor' ),
					'title'       => __( 'Place External Page URL', 'exclusive-addons-elementor' ),
					'condition'   => [
						'exad_modal_content'    => 'video',
						'exad_modal_video_type' => 'external_page'
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
                        '{{WRAPPER}} .exad-modal-item .exad-modal-content .exad-modal-element iframe' => 'width: {{SIZE}}{{UNIT}};'
                    ],
                    'condition' => [
                        'exad_modal_content' => 'video'
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
                        'exad_modal_content' => 'video'
                    ]
                ]
            );



		$this->end_controls_section();

		$this->start_controls_section(
			'modal',
			[
				'label' => __( 'Display Settings', 'uael' )
			]
		);

			$this->add_control(
				'modal_on',
				[
					'label'   => __( 'Display Modal On', 'exclusive-addons-elementor' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'button',
					'options' => [
						'icon'      => __( 'Icon', 'exclusive-addons-elementor' ),
						'photo'     => __( 'Image', 'exclusive-addons-elementor' ),
						'text'      => __( 'Text', 'exclusive-addons-elementor' ),
						'button'    => __( 'Button', 'exclusive-addons-elementor' ),
						'automatic' => __( 'Automatic', 'exclusive-addons-elementor' )
					]
				]
			);

			$this->add_control(
				'icon',
				[
					'label'     => __( 'Icon', 'uael' ),
					'type'      => Controls_Manager::ICON,
					'default'   => 'fa fa-home',
					'condition' => [
						'modal_on' => 'icon'
					]
				]
			);

			$this->add_control(
				'icon_size',
				[
					'label'     => __( 'Size', 'uael' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size'  => 60
					],
					'range'     => [
						'px' => [
							'max' => 500
						]
					],
					'selectors' => [
						'{{WRAPPER}} .uael-modal-action i' => 'font-size: {{SIZE}}px;width: {{SIZE}}px;height: {{SIZE}}px;line-height: {{SIZE}}px;'
					],
					'condition' => [
						'modal_on' => 'icon'
					]
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label'     => __( 'Icon Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'scheme'    => [
						'type'  => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_3
					],
					'selectors' => [
						'{{WRAPPER}} .uael-modal-action i' => 'color: {{VALUE}};'
					],
					'condition' => [
						'modal_on' => 'icon'
					]
				]
			);

			$this->add_control(
				'icon_hover_color',
				[
					'label'     => __( 'Icon Hover Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'scheme'    => [
						'type'  => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_3
					],
					'selectors' => [
						'{{WRAPPER}} .uael-modal-action i:hover' => 'color: {{VALUE}};'
					],
					'condition' => [
						'modal_on' => 'icon'
					]
				]
			);

			$this->add_control(
				'photo',
				[
					'label'     => __( 'Image', 'uael' ),
					'type'      => Controls_Manager::MEDIA,
					'default'   => [
						'url'   => Utils::get_placeholder_image_src()
					],
					'dynamic'   => [
						'active' => true
					],
					'condition' => [
						'modal_on' => 'photo'
					]
				]
			);

			$this->add_control(
				'img_size',
				[
					'label'     => __( 'Size', 'uael' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size'  => 60
					],
					'range'     => [
						'px'    => [
							'max' => 500
						]
					],
					'selectors' => [
						'{{WRAPPER}} .uael-modal-action img' => 'width: {{SIZE}}px;'
					],
					'condition' => [
						'modal_on' => 'photo'
					]
				]
			);

			$this->add_control(
				'modal_text',
				[
					'label'     => __( 'Text', 'uael' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => __( 'Click Here', 'uael' ),
					'dynamic'   => [
						'active' => true
					],
					'condition' => [
						'modal_on' => 'text'
					]
				]
			);

			$this->add_control(
				'exad_modal_overlay',
				[
					'label'        => __( 'Overlay', 'plugin-domain' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Show', 'your-plugin' ),
					'label_off'    => __( 'Hide', 'your-plugin' ),
					'return_value' => 'yes',
					'default'      => 'yes'
				]
			);

			$this->add_control(
				'modal_custom',
				[
					'label'       => __( 'Class', 'uael' ),
					'type'        => Controls_Manager::TEXT,
					'description' => __( 'Add your custom class without the dot. e.g: my-class', 'uael' ),
					'condition'   => [
						'modal_on' => 'custom'
					]
				]
			);

			$this->add_control(
				'modal_custom_id',
				[
					'label'       => __( 'Custom ID', 'uael' ),
					'type'        => Controls_Manager::TEXT,
					'description' => __( 'Add your custom id without the Pound key. e.g: my-id', 'uael' ),
					'condition'   => [
						'modal_on' => 'custom_id'
					]
				]
			);

			$this->add_control(
				'exit_intent',
				[
					'label'        => __( 'Exit Intent', 'uael' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'no',
					'return_value' => 'yes',
					'label_off'    => __( 'No', 'uael' ),
					'label_on'     => __( 'Yes', 'uael' ),
					'condition'    => [
						'modal_on' => 'automatic'
					],
					'selectors'    => [
						'.uamodal-{{ID}}' => ''
					]
				]
			);

			$this->add_control(
				'after_second',
				[
					'label'        => __( 'After Few Seconds', 'uael' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'no',
					'return_value' => 'yes',
					'label_off'    => __( 'No', 'uael' ),
					'label_on'     => __( 'Yes', 'uael' ),
					'condition'    => [
						'modal_on' => 'automatic'
					],
					'selectors'    => [
						'.uamodal-{{ID}}' => ''
					]
				]
			);

			$this->add_control(
				'after_second_value',
				[
					'label'     => __( 'Load After Seconds', 'uael' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 1
					],
					'condition' => [
						'after_second' => 'yes',
						'modal_on'     => 'automatic'
					],
					'selectors' => [
						'.uamodal-{{ID}}' => ''
					]
				]
			);

			$this->add_control(
				'enable_cookies',
				[
					'label'        => __( 'Enable Cookies', 'uael' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'no',
					'return_value' => 'yes',
					'label_off'    => __( 'No', 'uael' ),
					'label_on'     => __( 'Yes', 'uael' ),
					'condition'    => [
						'modal_on' => 'automatic'
					],
					'selectors'    => [
						'.uamodal-{{ID}}' => ''
					]
				]
			);

			$this->add_control(
				'close_cookie_days',
				[
					'label'     => __( 'Do Not Show After Closing (days)', 'uael' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 1
					],
					'condition' => [
						'enable_cookies' => 'yes',
						'modal_on'       => 'automatic'
					],
					'selectors' => [
						'.uamodal-{{ID}}' => ''
					]
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
					'condition'   => [
						'modal_on' => 'button'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'exad_modal_btn_typhography',
					'label'     => __( 'Button Typography', 'exclusive-addons-elementor' ),
					'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
					'selector'  => '{{WRAPPER}} .exad-modal-button .exad-modal-image-action span',
					'condition' => [
						'modal_on' => 'button'
					]
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
							'condition'   => [
								'modal_on' => 'button'
							]
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'      => 'exad_modal_btn_background_normal',
							'label'     => __( 'Button Background', 'exclusive-addons-elementor' ),
							'types'     => [ 'classic', 'gradient' ],
							'selector'  => '{{WRAPPER}} .exad-modal-button .exad-modal-image-action',
							'condition' => [
								'modal_on' => 'button'
							]
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'exad_modal_btn_border_normal',
							'label'    => __( 'Border', 'exclusive-addons-elementor' ),
							'selector' => '{{WRAPPER}} .exad-modal-button .exad-modal-image-action'
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab( 'exad_modal_btn_typhography_color_hover_tab', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

					$this->add_control(
						'exad_modal_btn_typhography_color_hover',
						[
							'label'     => __( 'Button Text Color', 'exclusive-addons-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#23a455',
							'selectors' => [
								'{{WRAPPER}} .exad-modal-button .exad-modal-image-action:hover span' => 'color: {{VALUE}};'
							],
							'condition'   => [
								'modal_on' => 'button'
							]
						]
					);

					$this->add_control(
						'exad_modal_btn_background_hover',
						[
							'label'     => __( 'Background', 'exclusive-addons-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#ffffff',
							'selectors' => [
								'{{WRAPPER}} .exad-modal-button .exad-modal-image-action:hover::before' => 'background: {{VALUE}};'
							],
							'condition'   => [
								'modal_on' => 'button'
							]
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
						],
						'justify' => [
							'title' => __( 'Justified', 'exclusive-addons-elementor' ),
							'icon'  => 'fa fa-align-justify'
						]
					],
					'default'   => 'center',
					'selectors' => [
						'{{WRAPPER}} .exad-modal-button' => 'text-align: {{VALUE}};'
					],
					'condition' => [
						'modal_on' => 'button'
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
					'default'     => 'fa fa-vimeo',
					'condition'   => [
						'modal_on' => 'button'
					]
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
					'condition' => [
						'exad_modal_btn_icon!' => '',
						'modal_on'  => 'button'
					]
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
					'condition' => [
						'exad_modal_btn_icon!' => '',
						'modal_on'  => 'button'
					],
					'selectors' => [
						'{{WRAPPER}} .exad-modal-button .exad-modal-image-action span .exad-modal-action-left-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .exad-modal-button .exad-modal-image-action span .exad-modal-action-right-icon' => 'margin-left: {{SIZE}}{{UNIT}};'
					]
				]
			);

			$this->add_responsive_control(
				'all_align',
				[
					'label'     => __( 'Alignment', 'uael' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'left'  => [
							'title' => __( 'Left', 'uael' ),
							'icon'  => 'fa fa-align-left'
						],
						'center' => [
							'title' => __( 'Center', 'uael' ),
							'icon'  => 'fa fa-align-center'
						],
						'right'  => [
							'title' => __( 'Right', 'uael' ),
							'icon'  => 'fa fa-align-right'
						]
					],
					'default'   => 'left',
					'condition' => [
						'modal_on' => array( 'icon', 'photo', 'text' )
					],
					'selectors' => [
						'{{WRAPPER}} .uael-modal-action-wrap' => 'text-align: {{VALUE}};'
					],
					'toggle'    => false
				]
			);

        $this->end_controls_section();
        
		/**
		 * Modal Popup style section
		 */
		$this->start_controls_section(
			'exad_modal_style_section',
			[
				'label' => __( 'Style', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
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
					'zoom-out'         => __( 'Zoom Out', 'exclusive-addons-elementor' )
				]
			]
		);
        $this->end_controls_section();
        
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
				'selector' => [
					'{{WRAPPER}} .exad-modal-content .exad-modal-element .exad-close-btn span'  => 'color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_section();
		
	}

	protected function render() { 
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'exad_modal_action', [
			'class'             => 'exad-modal-image-action image-modal',
			'data-exad-modal'   => '#exad-modal-' . $this->get_id(),
			'data-exad-overlay' => $settings['exad_modal_overlay']
		] );

		echo '<div class="exad-modal">';
          	echo '<div class="exad-modal-wrapper">';
            	echo '<div class="exad-modal-button">';
					$this->add_render_attribute( 'link', [
						'class'                        => 'exad-modal-image-action image-modal',
						//'data-elementor-open-lightbox' => 'default'
					] );

					if ( Plugin::$instance->editor->is_edit_mode() ) :
						$this->add_render_attribute( 'link', [
							'class' => 'elementor-clickable',
						] );
					endif;

					if( 'image' == $settings['exad_modal_content'] ):	
						if ( empty( $settings['exad_modal_image']['url'] ) ) {
							return;
						}		
						$link = $settings['exad_modal_image']['url'];
						if ( $link ) :
							$this->add_render_attribute( 'link', [
								'href' => esc_url($settings['exad_modal_image']['url'])
							] );
						endif;
						echo '<a '.$this->get_render_attribute_string( 'link' ).'>';

					elseif( 'video' == $settings['exad_modal_content'] ) :
						$link = '';
						if('youtube' == $settings['exad_modal_video_type']){
							if(!empty($settings['exad_modal_youtube_video_url'])){
								$link = $settings['exad_modal_youtube_video_url'];
							}
						}
						if('vimeo' == $settings['exad_modal_video_type']){
							if(!empty($settings['exad_modal_vimeo_video_url'])){
								$link = $settings['exad_modal_vimeo_video_url'];
							}
						}
						if('external_page' == $settings['exad_modal_video_type']){
							if(!empty($settings['exad_modal_external_page_url'])){
								$link = $settings['exad_modal_external_page_url'];
							}
						}

						if ( $link ) :
							$this->add_render_attribute( 'link', [
								'href' => esc_url($link)								
							] );
						endif;
						echo '<a '.$this->get_render_attribute_string( 'link' ).'>';

					else :
						echo '<a '.$this->get_render_attribute_string( 'link' ).'>';
					endif;

					// if( $settings['exad_modal_btn_icon_align'] === 'left' ) {
                	// 	echo '<span>';
					// 		echo '<i class="exad-modal-action-left-icon '.esc_attr( $settings['exad_modal_btn_icon'] ).'"></i>';
					// 			echo esc_html( $settings['exad_modal_btn_text'] );
					// 	echo '</span>';
					// }
					// if( $settings['exad_modal_btn_icon_align'] === 'right' ) {
                	// 	echo '<span>';
					// 		echo esc_html( $settings['exad_modal_btn_text'] );
					// 		echo '<i class="exad-modal-action-right-icon '.esc_attr( $settings['exad_modal_btn_icon'] ).'"></i>';
					// 	echo '</span>';
					// } 
              		echo '</a>';
              		
            	echo '</div>';
			echo '</div>';
			echo '<div class="exad-modal-overlay"></div>';
		echo '</div>';
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Modal_Popup() );