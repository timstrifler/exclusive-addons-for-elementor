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
		  'exad_tooltip_content_tag',
		  	[
		   		'label'       	=> esc_html__( 'Content Tag', 'exclusive-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'span',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'h1'  	=> esc_html__( 'H1', 'exclusive-addons-elementor' ),
		     		'h2'  	=> esc_html__( 'H2', 'exclusive-addons-elementor' ),
		     		'h3'  	=> esc_html__( 'H3', 'exclusive-addons-elementor' ),
		     		'h4'  	=> esc_html__( 'H4', 'exclusive-addons-elementor' ),
		     		'h5'  	=> esc_html__( 'H5', 'exclusive-addons-elementor' ),
		     		'h6'  	=> esc_html__( 'H6', 'exclusive-addons-elementor' ),
		     		'div'  	=> esc_html__( 'DIV', 'exclusive-addons-elementor' ),
		     		'span'  => esc_html__( 'SPAN', 'exclusive-addons-elementor' ),
		     		'p'  	=> esc_html__( 'P', 'exclusive-addons-elementor' ),
		     	],
		     	'condition' => [
		     		'exad_tooltip_type' => 'text'
		     	]
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
                'show_link',
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
                'button_link',
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
                'tooltip_text',
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

        $this->add_control(
            'exad_tooltip_presets',
              [
                  'label'         => esc_html__( 'Presets', 'exclusive-addons-elementor' ),
                  'type'          => Controls_Manager::SELECT,
                  'default'       => 'one',
                  'label_block'   => false,
                  'options'       => [
                      'one'     => esc_html__( 'One', 'exclusive-addons-elementor' ),
                      'two'     => esc_html__( 'Two', 'exclusive-addons-elementor' ),
                  ],
              ]
          );

            $this->add_responsive_control(
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
                    'default' => 'left',
				    'prefix_class' => 'exad-tooltip-align-',
                ]
            );

            $this->add_responsive_control(
                'tooltip_style_section_padding',
                [
                    'label' => __( 'Padding', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmega-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'tooltip_style_section_margin',
                [
                    'label' => __( 'Margin', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmega-tooltip' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );
            
        $this->end_controls_section();

        // Button Style tab section
        $this->start_controls_section(
            'tooltip_button_section',
            [
                'label' => __( 'Button', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->start_controls_tabs('button_style_tabs');

                $this->start_controls_tab(
                    'button_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'exclusive-addons-elementor' ),
                    ]
                );
                    $this->add_control(
                        'button_color',
                        [
                            'label' => __( 'Color', 'exclusive-addons-elementor' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .htmega-tooltip span' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .htmega-tooltip span a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography',
                            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .htmega-tooltip span',
                            'condition'=>[
                                'tooltip_type'=>'text',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_icon_fontsize',
                        [
                            'label' => __( 'Icon Size', 'exclusive-addons-elementor' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 20,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmega-tooltip span i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                            'condition'=>[
                                'tooltip_type'=>'icon',
                                'tooltip_button_icon!'=>'',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'label' => __( 'Background', 'exclusive-addons-elementor' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmega-tooltip span',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'label' => __( 'Border', 'exclusive-addons-elementor' ),
                            'selector' => '{{WRAPPER}} .htmega-tooltip span',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmega-tooltip span' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'button_margin',
                        [
                            'label' => __( 'Margin', 'exclusive-addons-elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmega-tooltip span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => __( 'Padding', 'exclusive-addons-elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmega-tooltip span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                $this->end_controls_tab(); // Normal tab end

                // Hover Tab start
                $this->start_controls_tab(
                    'button_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'exclusive-addons-elementor' ),
                    ]
                );
                    $this->add_control(
                        'button_hover_color',
                        [
                            'label' => __( 'Color', 'exclusive-addons-elementor' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .htmega-tooltip span:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_hover_background',
                            'label' => __( 'Background', 'exclusive-addons-elementor' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmega-tooltip span:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_hover_border',
                            'label' => __( 'Border', 'exclusive-addons-elementor' ),
                            'selector' => '{{WRAPPER}} .htmega-tooltip span:hover',
                        ]
                    );

                $this->end_controls_tab();// Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Button Style tab section
        $this->start_controls_section(
            'hover_tooltip_style_section',
            [
                'label' => __( 'Tooltip', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs('hover_popover_style_tabs');

                $this->start_controls_tab(
                    'hover_tooltip_content_tab',
                    [
                        'label' => __( 'Content', 'exclusive-addons-elementor' ),
                    ]
                );
                    $this->add_control(
                        'hover_tooltip_content_color',
                        [
                            'label' => __( 'Color', 'exclusive-addons-elementor' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .tooltip-inner' => 'color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'hover_tooltip_content_typography',
                            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .tooltip-inner',
                        ]
                    );

                    $this->add_responsive_control(
                        'hover_tooltip_content_padding',
                        [
                            'label' => __( 'Padding', 'exclusive-addons-elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .tooltip-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                            'selector' => '{{WRAPPER}} .tooltip-inner',
                        ]
                    );

                    $this->add_responsive_control(
                        'hover_tooltip_content_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .tooltip-inner' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px !important;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Arrow Tab End

                // Arrow Tab Start
                $this->start_controls_tab(
                    'hover_tooltip_arrow_tab',
                    [
                        'label' => __( 'Arrow', 'exclusive-addons-elementor' ),
                    ]
                );
                    $this->add_control(
                        'hover_tooltip_arrow_color',
                        [
                            'label' => __( 'Arrow Color', 'exclusive-addons-elementor' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => '#404040',
                            'selectors' => [
                                '{{WRAPPER}} .bs-tooltip-auto[x-placement^=top] .arrow::before' => 'border-top-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .bs-tooltip-top .arrow::before' => 'border-top-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .bs-tooltip-auto[x-placement^=bottom] .arrow::before' => 'border-bottom-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .bs-tooltip-bottom .arrow::before' => 'border-bottom-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .bs-tooltip-auto[x-placement^=left] .arrow::before' => 'border-left-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .bs-tooltip-left .arrow::before' => 'border-left-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .bs-tooltip-auto[x-placement^=right] .arrow::before' => 'border-right-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .bs-tooltip-right .arrow::before' => 'border-right-color: {{VALUE}} !important;',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $this->add_render_attribute( 'exad_tooltip_wrapper', [
            'class' => [ 'exad-tooltip',  esc_attr( $settings['exad_tooltip_presets'] ), esc_attr( $settings['tooltip_style_section_align'] ) ],
            ]
        );
       
        ?>

        <div <?php echo $this->get_render_attribute_string( 'exad_tooltip_wrapper' ); ?>>
            <div class="exad-tooltip-item <?php echo esc_attr( $settings['exad_tooltip_direction'] ); ?> tooltip-direction blue">
                <div class="exad-tooltip-content">
                    <?php if( $settings['exad_tooltip_type'] === 'text' ) : ?>
                    <<?php echo esc_attr( $settings['exad_tooltip_content_tag'] ); ?> class="exad-tooltip-content"><?php if( $settings['exad_tooltip_enable_link'] === 'yes' ) : ?><a href="<?php echo esc_url( $settings['exad_tooltip_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> ><?php endif; ?><?php echo esc_html__( $settings['exad_tooltip_content'], 'exclusive-addons-elementor' ); ?><?php if( $settings['exad_tooltip_enable_link'] === 'yes' ) : ?></a><?php endif; ?></<?php echo esc_attr( $settings['exad_tooltip_content_tag'] ); ?>>
                    <span class="exad-tooltip-text exad-tooltip-<?php echo esc_attr( $settings['exad_tooltip_hover_dir'] ) ?>"><?php echo __( $settings['exad_tooltip_hover_content'] ); ?></span>
                    <?php elseif( $settings['exad_tooltip_type'] === 'icon' ) : ?>
                        <span class="exad-tooltip-content"><?php if( $settings['exad_tooltip_enable_link'] === 'yes' ) : ?><a href="<?php echo esc_url( $settings['exad_tooltip_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> ><?php endif; ?><i class="<?php echo esc_attr( $settings['exad_tooltip_icon_content'] ); ?>"></i><?php if( $settings['exad_tooltip_enable_link'] === 'yes' ) : ?></a><?php endif; ?></span>
                        <span class="exad-tooltip-text exad-tooltip-<?php echo esc_attr( $settings['exad_tooltip_hover_dir'] ) ?>"><?php echo __( $settings['exad_tooltip_hover_content'] ); ?></span>
                    <?php elseif( $settings['exad_tooltip_type'] === 'image' ) : ?>
                        <span class="exad-tooltip-content"><?php if( $settings['exad_tooltip_enable_link'] === 'yes' ) : ?><a href="<?php echo esc_url( $settings['exad_tooltip_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> ><?php endif; ?><img src="<?php echo esc_url( $settings['exad_tooltip_img_content']['url'] ); ?>" alt="<?php echo esc_attr( $settings['exad_tooltip_hover_content'] ); ?>"><?php if( $settings['exad_tooltip_enable_link'] === 'yes' ) : ?></a><?php endif; ?></span>
                        <span class="exad-tooltip-text exad-tooltip-<?php echo esc_attr( $settings['exad_tooltip_hover_dir'] ) ?>"><?php echo __( $settings['exad_tooltip_hover_content'] ); ?></span>
                    <?php endif; ?>
                </div>
                <div class="exad-tooltip-text">
                    Location: Africa<br>
                    Luis cent 2018 LA<br>
                    South Africa.
                </div>
            </div>
        </div>

        <?php

    }

}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Tooltip() );
