<?php
namespace Elementor;

class Exad_Tooltip extends Widget_Base {

    public function get_name() {
        return 'exad-tooltip';
    }
    
    public function get_title() {
        return __( 'Tooltip', 'exclusive-addons-elementor' );
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
                'label' => __( 'Content Settings', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
			'exad_tooltip_type',
			[
                'label'       => esc_html__( 'Content Type', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => true,
                'options'     => [
					'icon'      => [
						'title' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-info'
					],
					'text'      => [
						'title' => esc_html__( 'Text', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-text-width'
					],
					'image'     => [
						'title' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-image'
					]
				],
				'default'     => 'icon'
			]
		);

  		$this->add_control(
			'exad_tooltip_content',
			[
                'label'       => esc_html__( 'Content', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => esc_html__( 'Hover Me!', 'exclusive-addons-elementor' ),
                'condition'   => [
					'exad_tooltip_type' => [ 'text' ]
				]
			]
        );
		
		$this->add_control(
			'exad_tooltip_icon_content',
			[
                'label'       => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fab fa-linux',
                    'library' => 'fa-brands'
                ],
                'condition'   => [
					'exad_tooltip_type' => [ 'icon' ]
				]
			]
		);

		$this->add_control(
			'exad_tooltip_img_content',
			[
                'label'     => esc_html__( 'Image', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
					'url'   => Utils::get_placeholder_image_src()
				],
				'condition' => [
					'exad_tooltip_type' => [ 'image' ]
				]
			]
		);

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'exad_tooltip_image_size',
                'label'     => __('Image Size', 'exclusive-addons-elementor'),
                'default'   => 'full',
                'condition' => [
                    'exad_tooltip_type'              => [ 'image' ],
                    'exad_tooltip_img_content[url]!' => ''
                ]
            ]
        );

        $this->add_control(
            'tooltip_style_section_align',
            [
                'label'   => __( 'Alignment', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'      => [
                        'title' => __( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-left'
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-center'
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-right'
                    ]
                ],
                'default'       => 'center',
                'prefix_class'  => 'exad-tooltip-align-'
            ]
        );

        $this->add_control(
            'exad_tooltip_enable_link',
            [
                'label'        => __( 'Show Link', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $this->add_control(
            'exad_tooltip_link',
            [
                'label'           => __( 'Link', 'exclusive-addons-elementor' ),
                'type'            => Controls_Manager::URL,
                'placeholder'     => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
                'show_external'   => true,
                'default'         => [
                    'url'         => '',
                    'is_external' => true
                ],
                'condition'       => [
                    'exad_tooltip_enable_link'=>'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tooltip_options',
            [
                'label' => __( 'Tooltip Options', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_tooltip_text',
            [
                'label'       => esc_html__( 'Tooltip Text', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => esc_html__( 'These are some dummy tooltip contents.', 'exclusive-addons-elementor' ),
                'dynamic'     => [ 'active' => true ]
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
                    'tooltip-left'   => esc_html__( 'Left', 'exclusive-addons-elementor' ),
                    'tooltip-right'  => esc_html__( 'Right', 'exclusive-addons-elementor' ),
                    'tooltip-top'    => esc_html__( 'Top', 'exclusive-addons-elementor' ),
                    'tooltip-bottom' => esc_html__( 'Bottom', 'exclusive-addons-elementor' )
                ]
            ]
        );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'tooltip_style_section',
            [
                'label' => __( 'General Styles', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_tooltip_content_typography',
                'selector' => '{{WRAPPER}} .exad-tooltip .exad-tooltip-content'
            ]
        );

		$this->add_responsive_control(
			'exad_tooltip_content_width',
		    [
                'label' => __( 'Content Width', 'exclusive-addons-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
		            'px'       => [
		                'min'  => 0,
		                'max'  => 1000,
		                'step' => 5
		            ],
		            '%'        => [
		                'min'  => 0,
		                'max'  => 100,
                        'step' => 1
		            ]
                ],
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 150
                ],
		        'selectors'  => [
		            '{{WRAPPER}} .exad-tooltip .exad-tooltip-content' => 'width: {{SIZE}}{{UNIT}};'
		        ]
		    ]
		);

		$this->add_responsive_control(
			'exad_tooltip_content_padding',
			[
                'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top'    => 20,
                    'right'  => 20,
                    'bottom' => 20,
                    'left'   => 20
                ],
				'selectors'  => [
	 				'{{WRAPPER}} .exad-tooltip .exad-tooltip-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
	 			]
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_tooltip_hover_border',
                'label'    => esc_html__( 'Border', 'exclusive-addons-elementor' ),
                'selector' => '{{WRAPPER}} .exad-tooltip .exad-tooltip-content'
            ]
        );

    
        $this->add_responsive_control(
            'exad_tooltip_content_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top'    => 4,
                    'right'  => 4,
                    'bottom' => 4,
                    'left'   => 4
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
		
		$this->start_controls_tabs( 'exad_tooltip_content_style_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'exad_tooltip_content_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );
                
				$this->add_control(
					'exad_tooltip_content_color',
					[
                        'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#826EFF',
                        'condition' => [
                            'exad_tooltip_type!' => [ 'image' ]
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .exad-tooltip .exad-tooltip-content, {{WRAPPER}} .exad-tooltip .exad-tooltip-content a' => 'color: {{VALUE}};'
						]
					]
                );

				$this->add_control(
					'exad_tooltip_content_bg_color',
					[
                        'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#f9f9f9',
                        'selectors' => [
							'{{WRAPPER}} .exad-tooltip .exad-tooltip-content' => 'background-color: {{VALUE}};'
						]
					]
				);

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'exad_tooltip_content_shadow',
                        'selector' => '{{WRAPPER}} .exad-tooltip .exad-tooltip-content'
                    ]
                );

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'exad_tooltip_content_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_tooltip_content_hover_color',
					[
                        'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'condition' => [
                            'exad_tooltip_type!' => [ 'image' ]
                        ],
                        'default'   => '#212121',
                        'selectors' => [
                            '{{WRAPPER}} .exad-tooltip .exad-tooltip-content:hover'   => 'color: {{VALUE}};',
                            '{{WRAPPER}} .exad-tooltip .exad-tooltip-content a:hover' => 'color: {{VALUE}};'
						]
					]
                );

				$this->add_control(
					'exad_tooltip_content_hover_bg_color',
					[
                        'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#f9f9f9',
                        'selectors' => [
							'{{WRAPPER}} .exad-tooltip .exad-tooltip-content:hover' => 'background-color: {{VALUE}};'
						]
					]
				);
                
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'exad_tooltip_hover_shadow',
                        'selector' => '{{WRAPPER}} .exad-tooltip .exad-tooltip-content:hover'
                    ]
                );
				
			$this->end_controls_tab();

        $this->end_controls_tabs();
                
        $this->end_controls_section();

        // Tooltip Style tab section
        $this->start_controls_section(
            'exad_tooltip_style_section',
            [
                'label' => __( 'Tooltip Styles', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hover_tooltip_content_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .exad-tooltip .exad-tooltip-text'
            ]
        );

        $this->add_responsive_control(
			'exad_tooltip_text_width',
		    [
                'label' => __( 'Tooltip Width', 'exclusive-addons-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
		            'px'       => [
		                'min'  => 0,
		                'max'  => 1000,
		                'step' => 5
		            ],
		            '%'        => [
		                'min'  => 0,
		                'max'  => 100
		            ]
		        ],
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 200
                ],
		        'selectors'    => [
		            '{{WRAPPER}} .exad-tooltip .exad-tooltip-text' => 'width: {{SIZE}}{{UNIT}};'
		        ]
		    ]
		);

        $this->add_control(
            'exad_tooltip_style_color',
            [
                'label'     => __( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-item .exad-tooltip-text' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'hover_tooltip_content_background',
                'label'    => __( 'Background', 'exclusive-addons-elementor' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .exad-tooltip .exad-tooltip-text'
            ]
        );

        $this->add_responsive_control(
            'exad_tooltip_text_padding',
            [
                'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => 10,
                    'right'  => 10,
                    'bottom' => 10,
                    'left'   => 10
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator'  =>'before'
            ]
        );

        $this->add_responsive_control(
            'exad_tooltip_content_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top'    => 4,
                    'right'  => 4,
                    'bottom' => 4,
                    'left'   => 4
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-text' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px !important;'
                ]
            ]
        );
    
        $this->add_control(
            'exad_tooltip_arrow_color',
            [
                'label'     => __( 'Arrow Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#826EFF',
                'selectors' => [
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-item.tooltip-top .exad-tooltip-text:after' => 'border-color: {{VALUE}} transparent transparent transparent;',
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-item.tooltip-left .exad-tooltip-text:after' => 'border-color: transparent transparent transparent {{VALUE}};',
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-item.tooltip-bottom .exad-tooltip-text:after' => 'border-color: transparent transparent {{VALUE}} transparent;',
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-item.tooltip-right .exad-tooltip-text:after' => 'border-color: transparent {{VALUE}} transparent transparent;'
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings          = $this->get_settings_for_display();
        $exad_tooltip_link = $settings['exad_tooltip_link']['url'];        
        $tooltip_img       = $this->get_settings_for_display( 'exad_tooltip_img_content' );
        $tooltip_img_url   = Group_Control_Image_Size::get_attachment_image_src( $tooltip_img['id'], 'exad_tooltip_image_size', $settings );
        if ( empty( $tooltip_img_url ) ) {
            $tooltip_img_url = $tooltip_img['url'];
        }  else {
            $tooltip_img_url = $tooltip_img_url;
        }

        if( $exad_tooltip_link ) {
            $this->add_render_attribute( 'exad-tooltip-anchor-atts', 'href', esc_url( $exad_tooltip_link ) );
        }
        if( $settings['exad_tooltip_link']['is_external'] ) {
            $this->add_render_attribute( 'exad-tooltip-anchor-atts', 'target', '_blank' );
        }
        if( $settings['exad_tooltip_link']['nofollow'] ) {
            $this->add_render_attribute( 'exad-tooltip-anchor-atts', 'rel', 'nofollow' );
        }
       
        $this->add_render_attribute( 'exad_tooltip_wrapper', 'class', 'exad-tooltip' );
        echo '<div '.$this->get_render_attribute_string( 'exad_tooltip_wrapper' ).'>';
            echo '<div class="exad-tooltip-item '.esc_attr( $settings['exad_tooltip_direction'] ).'">';
                echo '<div class="exad-tooltip-content">';

                    if( 'text' === $settings['exad_tooltip_type'] ) :
                        if( 'yes' === $settings['exad_tooltip_enable_link'] && !empty( $exad_tooltip_link ) ) :
                            echo '<a '.$this->get_render_attribute_string( 'exad-tooltip-anchor-atts' ).'>';
                        endif;
                        echo wp_kses_post( $settings['exad_tooltip_content'] );
                        if( 'yes' === $settings['exad_tooltip_enable_link'] && !empty( $exad_tooltip_link ) ) :
                            echo '</a>';
                        endif;

                    elseif( 'icon' === $settings['exad_tooltip_type'] ) :
                        if( 'yes' === $settings['exad_tooltip_enable_link'] && !empty( $exad_tooltip_link ) ) :
                            echo '<a '.$this->get_render_attribute_string( 'exad-tooltip-anchor-atts' ).'>';
                        endif;

                        if ( !empty( $settings['exad_tooltip_icon_content']['value'] ) ) :
                            Icons_Manager::render_icon( $settings['exad_tooltip_icon_content'] );
                        endif;

                        if( 'yes' === $settings['exad_tooltip_enable_link'] && !empty( $exad_tooltip_link ) ) :
                            echo '</a>';    
                        endif;

                    elseif( 'image' === $settings['exad_tooltip_type'] ) :
                        if( 'yes' === $settings['exad_tooltip_enable_link'] && !empty( $exad_tooltip_link ) ) :
                            echo '<a '.$this->get_render_attribute_string( 'exad-tooltip-anchor-atts' ).'>';
                        endif;
                        echo '<img src="'.esc_url( $tooltip_img_url ).'" alt="'.Control_Media::get_image_alt( $settings['exad_tooltip_img_content'] ).'">';
                        if( 'yes' === $settings['exad_tooltip_enable_link'] && !empty( $exad_tooltip_link ) ) :
                            echo '</a>';
                        endif;

                    endif;
                echo '</div>';

                echo '<div class="exad-tooltip-text">'.wp_kses_post( $settings['exad_tooltip_text'] ).'</div>';
            echo '</div>';
        echo '</div>';
    }

}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Tooltip() );