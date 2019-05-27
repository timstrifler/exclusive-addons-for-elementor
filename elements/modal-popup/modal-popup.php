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
	protected function _register_controls() {

		$this->start_controls_section(
			'exad_modal_content_section',
			[
				'label' => __( 'Modal Popup Content', 'exclusive-addons-elementor' ),
			]
		);

			$this->add_control(
				'exad_modal_content',
				[
					'label'   => __( 'Type of Modal', 'exclusive-addons-elementor' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'image',
                    'options' => [
						'image'      => __( 'Image', 'exclusive-addons-elementor' ),
						'html_content'      => __( 'HTML Content', 'exclusive-addons-elementor' ),
						'video'      => __( 'Video Content', 'exclusive-addons-elementor' ),
					],
				]
			);

			$this->add_control(
				'exad_modal_image',
				[
					'label'     => __( 'Image', 'exclusive-addons-elementor' ),
					'type'      => Controls_Manager::MEDIA,
					'default'   => [
						'url' => Utils::get_placeholder_image_src(),
					],
					'dynamic'   => [
						'active' => true,
                    ],
                    'condition' => [
                        'exad_modal_content' => 'image',
                    ]
				]
            );
            $this->add_control(
                'exad_modal_video_type',
                [
                    'label' => __( 'Choose Video Type', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'youtube',
                    'options' => [
                        'youtube'      => __( 'Youtube', 'exclusive-addons-elementor' ),
						'vimeo'      => __( 'Vimeo', 'exclusive-addons-elementor' ),
                    ],
                    'condition' => [
                        'exad_modal_content' => 'video',
                    ]
                ]
            );

            $this->add_control(
                'exad_modal_youtube_video_url',
                [
                    'label' => __( 'Provide Youtube Video URL', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => 'https://www.youtube.com/embed/D7ovwGioN9E',
                    'placeholder' => __( 'Place Youtube Video URL', 'exclusive-addons-elementor' ),
                    'title' => __( 'Place Youtube Video URL', 'exclusive-addons-elementor' ),
                    'condition' => [
                        'exad_modal_content' => 'video',
                        'exad_modal_video_type' => 'youtube'
                    ],
                ]
            );
            $this->add_control(
                'exad_modal_vimeo_video_url',
                [
                    'label' => __( 'Provide Vimeo Video URL', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => 'https://player.vimeo.com/video/180565514?api=1&player_id=vimeoplayer',
                    'placeholder' => __( 'Place Vimeo Video URL', 'exclusive-addons-elementor' ),
                    'title' => __( 'Place Vimeo Video URL', 'exclusive-addons-elementor' ),
                    'condition' => [
                        'exad_modal_content' => 'video',
                        'exad_modal_video_type' => 'vimeo'
                    ],
                ]
            );
            $this->add_control(
                'exad_modal_video_width',
                [
                    'label' => __( 'Video Width', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 720,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .exad-modal-item .exad-modal-content .exad-modal-element iframe' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'exad_modal_content' => 'video',
                    ],
                ]
            );

            $this->add_control(
                'exad_modal_video_height',
                [
                    'label' => __( 'Video Height', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 400,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .exad-modal-item .exad-modal-content .exad-modal-element iframe' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'exad_modal_content' => 'video',
                    ],
                ]
            );



		$this->end_controls_section();

		$this->start_controls_section(
			'modal',
			[
				'label' => __( 'Display Settings', 'uael' ),
			]
		);

			$this->add_control(
				'modal_on',
				[
					'label'   => __( 'Display Modal On', 'uael' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'button',
					'options' => [
						'icon'      => __( 'Icon', 'uael' ),
						'photo'     => __( 'Image', 'uael' ),
						'text'      => __( 'Text', 'uael' ),
						'button'    => __( 'Button', 'uael' ),
						'custom'    => __( 'Custom Class', 'uael' ),
						'custom_id' => __( 'Custom ID', 'uael' ),
						'automatic' => __( 'Automatic', 'uael' ),
					],
				]
			);

			$this->add_control(
				'icon',
				[
					'label'     => __( 'Icon', 'uael' ),
					'type'      => Controls_Manager::ICON,
					'default'   => 'fa fa-home',
					'condition' => [
						'modal_on' => 'icon',
					],
				]
			);

			$this->add_control(
				'icon_size',
				[
					'label'     => __( 'Size', 'uael' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 60,
					],
					'range'     => [
						'px' => [
							'max' => 500,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .uael-modal-action i' => 'font-size: {{SIZE}}px;width: {{SIZE}}px;height: {{SIZE}}px;line-height: {{SIZE}}px;',
					],
					'condition' => [
						'modal_on' => 'icon',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label'     => __( 'Icon Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'scheme'    => [
						'type'  => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_3,
					],
					'selectors' => [
						'{{WRAPPER}} .uael-modal-action i' => 'color: {{VALUE}};',
					],
					'condition' => [
						'modal_on' => 'icon',
					],
				]
			);

			$this->add_control(
				'icon_hover_color',
				[
					'label'     => __( 'Icon Hover Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'scheme'    => [
						'type'  => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_3,
					],
					'selectors' => [
						'{{WRAPPER}} .uael-modal-action i:hover' => 'color: {{VALUE}};',
					],
					'condition' => [
						'modal_on' => 'icon',
					],
				]
			);

			$this->add_control(
				'photo',
				[
					'label'     => __( 'Image', 'uael' ),
					'type'      => Controls_Manager::MEDIA,
					'default'   => [
						'url' => Utils::get_placeholder_image_src(),
					],
					'dynamic'   => [
						'active' => true,
					],
					'condition' => [
						'modal_on' => 'photo',
					],
				]
			);

			$this->add_control(
				'img_size',
				[
					'label'     => __( 'Size', 'uael' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 60,
					],
					'range'     => [
						'px' => [
							'max' => 500,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .uael-modal-action img' => 'width: {{SIZE}}px;',
					],
					'condition' => [
						'modal_on' => 'photo',
					],
				]
			);

			$this->add_control(
				'modal_text',
				[
					'label'     => __( 'Text', 'uael' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => __( 'Click Here', 'uael' ),
					'dynamic'   => [
						'active' => true,
					],
					'condition' => [
						'modal_on' => 'text',
					],
				]
			);

			$this->add_control(
				'exad_modal_overlay',
				[
					'label' => __( 'Overlay', 'plugin-domain' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'your-plugin' ),
					'label_off' => __( 'Hide', 'your-plugin' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'modal_custom',
				[
					'label'       => __( 'Class', 'uael' ),
					'type'        => Controls_Manager::TEXT,
					'description' => __( 'Add your custom class without the dot. e.g: my-class', 'uael' ),
					'condition'   => [
						'modal_on' => 'custom',
					],
				]
			);

			$this->add_control(
				'modal_custom_id',
				[
					'label'       => __( 'Custom ID', 'uael' ),
					'type'        => Controls_Manager::TEXT,
					'description' => __( 'Add your custom id without the Pound key. e.g: my-id', 'uael' ),
					'condition'   => [
						'modal_on' => 'custom_id',
					],
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
						'modal_on' => 'automatic',
					],
					'selectors'    => [
						'.uamodal-{{ID}}' => '',
					],
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
						'modal_on' => 'automatic',
					],
					'selectors'    => [
						'.uamodal-{{ID}}' => '',
					],
				]
			);

			$this->add_control(
				'after_second_value',
				[
					'label'     => __( 'Load After Seconds', 'uael' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 1,
					],
					'condition' => [
						'after_second' => 'yes',
						'modal_on'     => 'automatic',
					],
					'selectors' => [
						'.uamodal-{{ID}}' => '',
					],
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
						'modal_on' => 'automatic',
					],
					'selectors'    => [
						'.uamodal-{{ID}}' => '',
					],
				]
			);

			$this->add_control(
				'close_cookie_days',
				[
					'label'     => __( 'Do Not Show After Closing (days)', 'uael' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 1,
					],
					'condition' => [
						'enable_cookies' => 'yes',
						'modal_on'       => 'automatic',
					],
					'selectors' => [
						'.uamodal-{{ID}}' => '',
					],
				]
			);

			$this->add_control(
				'btn_text',
				[
					'label'       => __( 'Button Text', 'uael' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => __( 'Click Me', 'uael' ),
					'placeholder' => __( 'Click Me', 'uael' ),
					'dynamic'     => [
						'active' => true,
					],
					'condition'   => [
						'modal_on' => 'button',
					],
				]
			);

			$this->add_responsive_control(
				'btn_align',
				[
					'label'     => __( 'Alignment', 'uael' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'left'    => [
							'title' => __( 'Left', 'uael' ),
							'icon'  => 'fa fa-align-left',
						],
						'center'  => [
							'title' => __( 'Center', 'uael' ),
							'icon'  => 'fa fa-align-center',
						],
						'right'   => [
							'title' => __( 'Right', 'uael' ),
							'icon'  => 'fa fa-align-right',
						],
						'justify' => [
							'title' => __( 'Justified', 'uael' ),
							'icon'  => 'fa fa-align-justify',
						],
					],
					'default'   => 'left',
					'condition' => [
						'modal_on' => 'button',
					],
					'toggle'    => false,
				]
			);

			$this->add_control(
				'btn_size',
				[
					'label'     => __( 'Size', 'uael' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'sm',
					'options'   => [
						'xs' => __( 'Extra Small', 'uael' ),
						'sm' => __( 'Small', 'uael' ),
						'md' => __( 'Medium', 'uael' ),
						'lg' => __( 'Large', 'uael' ),
						'xl' => __( 'Extra Large', 'uael' ),
					],
					'condition' => [
						'modal_on' => 'button',
					],
				]
			);

			$this->add_responsive_control(
				'btn_padding',
				[
					'label'      => __( 'Padding', 'uael' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .uael-modal-action-wrap a.elementor-button, {{WRAPPER}} .uael-modal-action-wrap .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'  => [
						'modal_on' => 'button',
					],
				]
			);

			$this->add_control(
				'btn_icon',
				[
					'label'       => __( 'Icon', 'uael' ),
					'type'        => Controls_Manager::ICON,
					'label_block' => true,
					'default'     => '',
					'condition'   => [
						'modal_on' => 'button',
					],
				]
			);

			$this->add_control(
				'btn_icon_align',
				[
					'label'     => __( 'Icon Position', 'uael' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'left',
					'options'   => [
						'left'  => __( 'Before', 'uael' ),
						'right' => __( 'After', 'uael' ),
					],
					'condition' => [
						'btn_icon!' => '',
						'modal_on'  => 'button',
					],
				]
			);

			$this->add_control(
				'btn_icon_indent',
				[
					'label'     => __( 'Icon Spacing', 'uael' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'max' => 50,
						],
					],
					'condition' => [
						'btn_icon!' => '',
						'modal_on'  => 'button',
					],
					'selectors' => [
						'{{WRAPPER}} .uael-modal-action-wrap .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .uael-modal-action-wrap .elementor-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'all_align',
				[
					'label'     => __( 'Alignment', 'uael' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'left'   => [
							'title' => __( 'Left', 'uael' ),
							'icon'  => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'uael' ),
							'icon'  => 'fa fa-align-center',
						],
						'right'  => [
							'title' => __( 'Right', 'uael' ),
							'icon'  => 'fa fa-align-right',
						],
					],
					'default'   => 'left',
					'condition' => [
						'modal_on' => array( 'icon', 'photo', 'text' ),
					],
					'selectors' => [
						'{{WRAPPER}} .uael-modal-action-wrap' => 'text-align: {{VALUE}};',
					],
					'toggle'    => false,
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
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );
        
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_modal_content_border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-modal-item .exad-modal-content .exad-modal-element',
			]
        );
        
		$this->end_controls_section();

		$this->start_controls_section(
			'exad_modal_animation_tab',
			[
				'label' => __( 'Animation', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'exad_modal_transition',
			[
				'label' => __( 'Animated Style', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'top-to-middle',
				'options' => [
					'top-to-middle'      => __( 'Top To Middle', 'exclusive-addons-elementor' ),
					'bottom-to-middle'     => __( 'Bottom To Middle', 'exclusive-addons-elementor' ),
					'right-to-middle'      => __( 'Right To Middle', 'exclusive-addons-elementor' ),
					'left-to-middle'    => __( 'Left To Middle', 'exclusive-addons-elementor' ),
					'zoom-in'    => __( 'Zoom In', 'exclusive-addons-elementor' ),
					'zoom-out' => __( 'Zoom Out', 'exclusive-addons-elementor' ),
				],
			]
		);
        $this->end_controls_section();
        
		$this->start_controls_section(
			'exad_modal_overlay_tab',
			[
				'label' => __( 'Overlay', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
					'exad_modal_overlay' => 'yes',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_modal_overlay_color',
                'label' => __( 'Color', 'exclusive-addons-elementor' ),
                'default' => 'rgba(0, 0, 0, .5)',
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .exad-modal-overlay',
			]
		);
		$this->end_controls_section();
		
	}

	protected function render() { 
		$settings = $this->get_settings_for_display();


		// $this->add_render_attribute( 'exad_modal_content', [
		// 	'id' => 'exad-modal-' . $this->get_id(),
		// 	'class' => 'exad-modal-item modal-vimeo zoom-in',	
		// ] );

		$this->add_render_attribute( 'exad_modal_action', [
			'class' => 'exad-modal-image-action image-modal',
			'data-exad-modal' => '#exad-modal-' . $this->get_id(),
			'data-exad-overlay' => $settings['exad_modal_overlay'],
		] );

	?>
		
		<div class="exad-modal one">
          	<div class="exad-modal-wrapper">
            	<div class="exad-modal-button">
              		<a href="#" <?php echo $this->get_render_attribute_string('exad_modal_action'); ?>>
                		<span><i class="fa fa-vimeo"></i>Button</span>
              		</a>
            	</div>
			
				<div id="exad-modal-<?php echo esc_attr($this->get_id()); ?>" class="exad-modal-item modal-vimeo <?php echo $settings['exad_modal_transition'] ?>">
             		<div class="exad-modal-content">
                		<div class="exad-modal-element">
                        <?php if ( $settings['exad_modal_content'] === 'image' ) { ?>
                  			<img src="<?php echo $settings['exad_modal_image']['url']; ?>" />
                        <?php } ?>
                        <?php if ( $settings['exad_modal_content'] === 'video' ) { ?>
                            <?php if ( $settings['exad_modal_video_type'] === 'youtube' ) { ?>
                                <iframe src="<?php echo esc_attr( $settings['exad_modal_youtube_video_url'] ); ?>" frameborder="0" allowfullscreen>
                                </iframe>
                            <?php } ?>
                            <?php if ( $settings['exad_modal_video_type'] === 'vimeo' ) { ?>
                                <iframe src="<?php echo esc_attr( $settings['exad_modal_vimeo_video_url'] ); ?>" frameborder="0" allowfullscreen>
                                </iframe>
                            <?php } ?>
                        <?php } ?>
							<div class="exad-close-btn">
								<span><i class="fa fa-times"></i></span>
							</div>
                		</div>
              		</div>
            	</div>
			</div>
			<div class="exad-modal-overlay"></div>
		</div>
		

	<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Modal_Popup() );