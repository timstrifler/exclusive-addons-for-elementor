<?php
namespace Elementor;

class Exad_Tooltip extends Widget_Base {

    public function get_name() {
        return 'exad-tooltip';
    }
    
    public function get_title() {
        return __( 'Ex Tooltip', 'exclusive-addons-elementor' );
    }

    public function get_icon() {
        return 'exad-element-icon eicon-tools';
    }

    public function get_categories() {
        return [ 'exclusive-addons-elementor' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'tooltip_button_content',
            [
                'label' => __( 'Tooltip', 'exclusive-addons-elementor' ),
            ]
        );

        $this->add_responsive_control(
			'exad_tooltip_type',
			[
				'label' => esc_html__( 'Content Type', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'icon' => [
						'title' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-info',
					],
					'text' => [
						'title' => esc_html__( 'Text', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-text-width',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-image',
					],
				],
				'default' => 'icon',
			]
		);
  		$this->add_control(
			'exad_tooltip_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__( 'Hover Me!', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_tooltip_type' => [ 'text' ]
				],
				'dynamic' => [ 'active' => true ]
			]
        );
        
		$this->add_control(
            'tooltip_style_section_align',
            [
                'label' => __( 'Alignment', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'exclusive-addons-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'exclusive-addons-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'exclusive-addons-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'prefix_class' => 'exad-tooltip-align-',
            ]
        );
		
		$this->add_control(
			'exad_tooltip_icon_content',
			[
				'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-home',
				'condition' => [
					'exad_tooltip_type' => [ 'icon' ]
				]
			]
		);
		$this->add_control(
			'exad_tooltip_img_content',
			[
				'label' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'exad_tooltip_type' => [ 'image' ]
				]
			]
		);

            $this->add_control(
                'tooltip_button_img',
                [
                    'label' => __('Image','exclusive-addons-elementor'),
                    'type'=>Controls_Manager::MEDIA,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'tooltip_type' => [ 'image' ]
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'tooltip_button_imgsize',
                    'default' => 'large',
                    'separator' => 'none',
                    'condition' => [
                        'tooltip_type' => [ 'image' ]
                    ]
                ]
            );

            $this->add_control(
                'exad_tooltip_enable_link',
                [
                    'label' => __( 'Show Link', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
                    'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'exad_tooltip_link',
                [
                    'label' => __( 'Link', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'condition'=>[
                        'show_link'=>'yes',
                    ]
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'tooltip_options',
            [
                'label' => __( 'Tooltip Options', 'exclusive-addons-elementor' ),
            ]
        );
            $this->add_control(
                'exad_tooltip_text',
                [
                    'label' => esc_html__( 'Tooltip Text', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'default' => esc_html__( 'Tooltip content', 'exclusive-addons-elementor' ),
                    'dynamic' => [ 'active' => true ]
                ]
            );

            $this->add_control(
              'exad_tooltip_direction',
                [
                    'label'         => esc_html__( 'Direction', 'exclusive-addons-elementor' ),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'tooltip-right',
                    'label_block'   => false,
                    'options'       => [
                        'tooltip-left'      => esc_html__( 'Left', 'exclusive-addons-elementor' ),
                        'tooltip-right'     => esc_html__( 'Right', 'exclusive-addons-elementor' ),
                        'tooltip-top'       => esc_html__( 'Top', 'exclusive-addons-elementor' ),
                        'tooltip-bottom'    => esc_html__( 'Bottom', 'exclusive-addons-elementor' ),
                    ],
                ]
            );

            $this->add_control(
                'tooltip_space',
                [
                    'label' => __( 'Space With Button', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bs-tooltip-auto[x-placement^=top]' => 'top: -{{SIZE}}{{UNIT}} !important;',
                        '{{WRAPPER}} .bs-tooltip-top' => 'top: -{{SIZE}}{{UNIT}} !important;',
                        '{{WRAPPER}} .bs-tooltip-auto[x-placement^=bottom]' => 'top: {{SIZE}}{{UNIT}} !important;',
                        '{{WRAPPER}} .bs-tooltip-bottom' => 'top: {{SIZE}}{{UNIT}} !important;',
                        '{{WRAPPER}} .bs-tooltip-auto[x-placement^=right]' => 'left: {{SIZE}}{{UNIT}} !important;',
                        '{{WRAPPER}} .bs-tooltip-right' => 'left: {{SIZE}}{{UNIT}} !important;',
                        '{{WRAPPER}} .bs-tooltip-auto[x-placement^=left]' => 'left: {{SIZE}}{{UNIT}} !important;',
                        '{{WRAPPER}} .bs-tooltip-left' => 'left: -{{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'tooltip_style_section',
            [
                'label' => __( 'General Styles', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        
		$this->add_responsive_control(
			'exad_tooltip_max_width',
		    [
		        'label' => __( 'Content Max Width', 'essential-addons-elementor' ),
		        'type' => Controls_Manager::SLIDER,
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
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .exad-tooltip' => 'max-width: {{SIZE}}{{UNIT}};',
		        ]
		    ]
		);
		$this->add_responsive_control(
			'exad_tooltip_content_padding',
			[
				'label' => esc_html__( 'Padding', 'essential-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .exad-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		
		$this->start_controls_tabs( 'exad_tooltip_content_style_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'exad_tooltip_content_normal', [ 'label' => esc_html__( 'Normal', 'essential-addons-elementor' ) ] );
				$this->add_control(
					'exad_tooltip_content_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'essential-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .exad-tooltip' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_tooltip_content_color',
					[
						'label' => esc_html__( 'Text Color', 'essential-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .exad-tooltip-content a' => 'color: {{VALUE}};',
						],
					]
				);
			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'exad_tooltip_content_hover', [ 'label' => esc_html__( 'Hover', 'essential-addons-elementor' ) ] );
				$this->add_control(
					'exad_tooltip_content_hover_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'essential-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .exad-tooltip:hover' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_tooltip_content_hover_color',
					[
						'label' => esc_html__( 'Text Color', 'essential-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#212121',
						'selectors' => [
							'{{WRAPPER}} .exad-tooltip-content a:hover' => 'color: {{VALUE}};',
						],
					]
				);
				
			$this->end_controls_tab();
        $this->end_controls_tabs();
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'exad_tooltip_hover_shadow',
                'selector' => '{{WRAPPER}} .exad-tooltip',
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'exad_tooltip_hover_border',
                'label' => esc_html__( 'Border', 'essential-addons-elementor' ),
                'selector' => '{{WRAPPER}} .exad-tooltip .exad-tooltip-text',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'exad_tooltip_content_typography',
				'selector' => '{{WRAPPER}} .exad-tooltip .exad-tooltip-text',
			]
		);
		$this->add_responsive_control(
			'exad_tooltip_content_radius',
			[
				'label' => esc_html__( 'Border Radius', 'essential-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .exad-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

            
        $this->end_controls_section();

        
        // Tooltip Style tab section
        $this->start_controls_section(
            'exad_tooltip_style_section',
            [
                'label' => __( 'Tooltip', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'exad_tooltip_style_color',
            [
                'label' => __( 'Text Color', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selector' => [
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-item .exad-tooltip-text' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'hover_tooltip_content_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .exad-tooltip .exad-tooltip-item .exad-tooltip-text',
            ]
        );

        $this->add_responsive_control(
            'exad_tooltip_content_padding',
            [
                'label' => __( 'Padding', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-item .exad-tooltip-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hover_tooltip_content_background',
                'label' => __( 'Background', 'exclusive-addons-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .exad-tooltip .exad-tooltip-item .exad-tooltip-text',
            ]
        );

        $this->add_responsive_control(
            'exad_tooltip_content_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-item .exad-tooltip-text' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px !important;',
                ],
            ]
        );
    
        // Arrow Tab Start
        $this->add_control(
            'exad_tooltip_arrow_color',
            [
                'label' => __( 'Arrow Color', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#404040',
                'selector' => [
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-item .exad-tooltip-text:after' => 'border-color: {{VALUE}} transparent transparent transparent;',
                ],
            ]
        );

                

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'exad_tooltip_wrapper', [
            'class' => [ 'exad-tooltip',  esc_attr( $settings['exad_tooltip_presets'] ) ],
            ]
        );
       
        ?>

        <div <?php echo $this->get_render_attribute_string( 'exad_tooltip_wrapper' ); ?>>
            <div class="exad-tooltip-item <?php echo esc_attr( $settings['exad_tooltip_direction'] ); ?>">
                <div class="exad-tooltip-content">
                    <?php if( $settings['exad_tooltip_type'] === 'text' ) : ?>
                        <?php if( $settings['exad_tooltip_enable_link'] === 'yes' ) : ?>
                            <a href="<?php echo esc_url( $settings['exad_tooltip_link']['url'] ); ?>">
                        <?php endif; ?>

                        <p><?php echo esc_html__( $settings['exad_tooltip_content'], 'exclusive-addons-elementor' ); ?></p>

                        <?php if( $settings['exad_tooltip_enable_link'] === 'yes' ) : ?>
                            </a>
                        <?php endif; ?>

                    <span class="exad-tooltip-content-text exad-tooltip-<?php echo esc_attr( $settings['exad_tooltip_hover_dir'] ) ?>">
                        <?php echo __( $settings['exad_tooltip_hover_content'] ); ?>
                    </span>
                    <?php elseif( $settings['exad_tooltip_type'] === 'icon' ) : ?>
                        
                        <?php if( $settings['exad_tooltip_enable_link'] === 'yes' ) : ?>
                        <a href="<?php echo esc_url( $settings['exad_tooltip_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> >
                        <?php endif; ?>
                        <i class="<?php echo esc_attr( $settings['exad_tooltip_icon_content'] ); ?>"></i>
                        <?php if( $settings['exad_tooltip_enable_link'] === 'yes' ) : ?></a><?php endif; ?></span>
                        <?php echo __( $settings['exad_tooltip_hover_content'] ); ?>
                    <?php elseif( $settings['exad_tooltip_type'] === 'image' ) : ?>
                        
                        <?php if( $settings['exad_tooltip_enable_link'] === 'yes' ) : ?>
                            <a href="<?php echo esc_url( $settings['exad_tooltip_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> >
                        <?php endif; ?>
                            <img src="<?php echo esc_url( $settings['exad_tooltip_img_content']['url'] ); ?>" alt="<?php echo esc_attr( $settings['exad_tooltip_hover_content'] ); ?>">
                        <?php if( $settings['exad_tooltip_enable_link'] === 'yes' ) : ?>
                            </a>
                        <?php endif; ?>
                        <?php echo __( $settings['exad_tooltip_hover_content'] ); ?>
                    <?php endif; ?>
                </div>
                <div class="exad-tooltip-text"><?php echo esc_html( $settings['exad_tooltip_text'] ); ?></div>
            </div>
        </div>

        <?php

    }

}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Tooltip() );
