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
						'video'       => __( 'Video', 'exclusive-addons-elementor' ),
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
                'exad_modal_video_type',
                [
                    'label' => __( 'Choose Video Type', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'youtube',
                    'options' => [
                        'youtube'      => __( 'Youtube', 'exclusive-addons-elementor' ),
						'vimeo'      => __( 'Vimeo', 'exclusive-addons-elementor' ),
						'external_page'      => __( 'External Page', 'exclusive-addons-elementor' ),
                    ],
                    'condition' => [
                        'exad_modal_content' => 'video',
                    ]
                ]
            );

            $this->add_control(
                'exad_modal_youtube_video_url',
                [
					'label'       => __( 'Provide Youtube Video URL', 'exclusive-addons-elementor' ),
					'type'        => Controls_Manager::URL,
					'label_block' => true,
					'default'     => 'https://www.youtube.com/embed/D7ovwGioN9E',
					'placeholder' => __( 'Place Youtube Video URL', 'exclusive-addons-elementor' ),
					'title'       => __( 'Place Youtube Video URL', 'exclusive-addons-elementor' ),
					'condition' => [
                        'exad_modal_video_type' => 'youtube'
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
                        'exad_modal_video_type' => 'youtube'
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
                        'exad_modal_video_type' => 'youtube'
                    ]
                ]
            );


		$this->end_controls_section();

		$this->start_controls_section(
			'exad_modal_display_settings',
			[
				'label' => __( 'Display Settings', 'exclusive-addons-elementor' )
			]
		);

			$this->add_control(
				'modal_on',
				[
					'label'   => __( 'Display Modal On', 'exclusive-addons-elementor' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'button',
					'options' => [
						// 'icon'      => __( 'Icon', 'exclusive-addons-elementor' ),
						'photo'     => __( 'Image', 'exclusive-addons-elementor' ),
						// 'text'      => __( 'Text', 'exclusive-addons-elementor' ),
						'button'    => __( 'Button', 'exclusive-addons-elementor' ),
						// 'automatic' => __( 'Automatic', 'exclusive-addons-elementor' )
					]
				]
			);

			$this->add_control(
				'exad_modal_overlay',
				[
					'label'        => __( 'Overlay', 'exclusive-addons-elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Show', 'your-plugin' ),
					'label_off'    => __( 'Hide', 'your-plugin' ),
					'return_value' => 'yes',
					'default'      => 'yes'
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
					'selector'  => '{{WRAPPER}} .exad-modal-button .exad-modal-image-action span',
					'condition' => [
						'modal_on' => 'button'
					]
				]
			);

			$this->add_control(
				'exad_modal_btn_radius',
				[
					'label' => __( 'Border Radius', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'default' => [
						'top' => '10',
						'right' => '10',
						'bottom' => '10',
						'left' => '10',
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .exad-modal-image-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'   => [
						'modal_on' => 'button'
					]
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
					'condition'   => [
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

					$this->add_control(
						'exad_modal_btn_background_normal',
						[
							'label'     => __( 'Background', 'exclusive-addons-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#23a455',
							'selectors' => [
								'{{WRAPPER}} .exad-modal-button .exad-modal-image-action' => 'background: {{VALUE}};'
							],
							'condition'   => [
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
								'{{WRAPPER}} .exad-modal-button .exad-modal-image-action:hover' => 'background: {{VALUE}};'
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
					'label'     => __( 'Alignment', 'exclusive-addons-elementor' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'left'  => [
							'title' => __( 'Left', 'exclusive-addons-elementor' ),
							'icon'  => 'fa fa-align-left'
						],
						'center' => [
							'title' => __( 'Center', 'exclusive-addons-elementor' ),
							'icon'  => 'fa fa-align-center'
						],
						'right'  => [
							'title' => __( 'Right', 'exclusive-addons-elementor' ),
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
					'zoom-out'         => __( 'Zoom Out', 'exclusive-addons-elementor' ),
					'left-rotate'         => __( 'Rotate Left', 'exclusive-addons-elementor' ),
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

	/*protected function render() { 

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'exad_modal_action', [
			'class' => 'exad-modal-trigger',
		] );

		if ( $settings['exad_modal_content'] == 'image' ) {
			$this->add_render_attribute( 'exad_modal_action', [
				'class' => 'mfp-image',
				'href'  => esc_url( $settings['exad_modal_image']['url'] )
			] );
		}

		if ( $settings['exad_modal_content'] == 'youtube' ) {
			$this->add_render_attribute( 'exad_modal_action', [
				'class' => 'mfp-iframe',
				'href'  => esc_url( $settings['exad_modal_youtube_video_url']['url'] )
			] );
		}
	?>

		<a <?php echo $this->get_render_attribute_string( 'exad_modal_action' ); ?>>Open Popup</a>

	<?php	
	}*/

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
				
				<!-- <div class="exad-modal-item modal-vimeo top-to-middle" id="modalOne">
					<div class="exad-modal-content">
						<div class="exad-modal-element">
							<iframe id="nofocusvideo" src="https://player.vimeo.com/video/180565514?api=1&player_id=vimeoplayer"
							name="vimeoplayer" width="700" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen
							allowfullscreen></iframe>
							<div class="close-btn">
								<span><i class="fa fa-times"></i></span>
							</div>
						</div>
					</div>
				</div> -->
			
				<div id="exad-modal-<?php echo esc_attr($this->get_id()); ?>" <?php echo $this->get_render_attribute_string('exad_modal_item'); ?>">
             		<div class="exad-modal-content">
                		<div class="exad-modal-element">
							<?php if ( $settings['exad_modal_content'] === 'image' ) { ?>
								<img src="<?php echo $settings['exad_modal_image']['url']; ?>" />
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
										<img src="<?php echo esc_url( $image_gallery_url ); ?>" >
										<div class="exad-modal-element-card-body">
											<p><?php echo esc_attr( $gallery['exad_modal_image_gallery_text'] ); ?></p>
										</div>
									</div>
								<?php endforeach; ?>
							<?php } ?>
							<?php if ( $settings['exad_modal_content'] === 'html_content' ) { ?>
								<div class="exad-modal-element-body">
									<p><?php echo esc_attr( $settings['exad_modal_html_content'] ); ?></p>
								</div>
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
								<?php if ( $settings['exad_modal_video_type'] === 'external_page' ) { ?>
									<iframe src="<?php echo esc_attr( $settings['exad_modal_external_page_url'] ); ?>">
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