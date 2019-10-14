<?php
namespace Elementor;

class Exad_Dual_Button extends Widget_Base {
	
	public function get_name() {
		return 'exad-dual-button';
	}
	public function get_title() {
		return esc_html__( 'Dual Button', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-button';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	protected function _register_controls() {

        /*
        * Exad Dual Button Content
        */
        $this->start_controls_section(
            'exad_content_section',
            [
                'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
            ]
        );

        $this->start_controls_tabs( 'exad_dual_button_content_tabs' );

            $this->start_controls_tab( 'exad_dual_button_primary_button_content', [ 'label' => esc_html__( 'Primary', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_dual_button_primary_button_text',
                    [
                        'label' => esc_html__( 'Text', 'exclusive-addons-elementor' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => esc_html__( 'Primary', 'exclusive-addons-elementor' ),
                    ]
                );

                $this->add_control(
                    'exad_dual_button_primary_button_url',
                    [
                        'label' => esc_html__( 'Link', 'exclusive-addons-elementor' ),
                        'type' => Controls_Manager::URL,
                        'label_block' => true,
                        'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
                        'show_external' => true,
                        'default' => [
                            'url' => '#',
                            'is_external' => true,
                            'nofollow' => true,
                        ],
                    ]
                );

                $this->add_control(
                    'exad_dual_button_primary_button_icon',
                    [
                        'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                        'type' => Controls_Manager::ICONS,
                    ]
                );

                $this->add_control(
                    'exad_dual_button_primary_button_icon_position',
                    [
                        'label' => __( 'Position', 'exclusive-addons-elementor' ),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            'exad-icon-pos-left' => [
                                'title' => __( 'Left', 'exclusive-addons-elementor' ),
                                'icon' => 'fa fa-angle-left',
                            ],
                            'exad-icon-pos-right' => [
                                'title' => __( 'Right', 'exclusive-addons-elementor' ),
                                'icon' => 'fa fa-angle-right',
                            ]
                        ],
                        'default' => 'exad-icon-pos-left',
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'exad_dual_button_connector_content', [ 'label' => esc_html__( 'Connector', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_dual_button_connector_switch',
                    [
                        'label' => esc_html__( 'Connector Show/Hide', 'exclusive-addons-elementor' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
                        'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
                        'return_value' => 'yes',
                        'default' => 'yes',
                    ]
                );

                $this->add_control(
                    'exad_dual_button_connector_type',
                    [
                        'label' => esc_html__( 'Type', 'exclusive-addons-elementor' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'text',
                        'options' => [
                            'text' => __( 'Text', 'exclusive-addons-elementor' ),
                            'icon' => __( 'Icon', 'exclusive-addons-elementor' ),
                        ],
                        'condition' => [
                            'exad_dual_button_connector_switch' => 'yes',
                        ]
                    ]
                );

                $this->add_control(
                    'exad_dual_button_connector_text',
                    [
                        'label' => esc_html__( 'Text', 'exclusive-addons-elementor' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'Or', 'exclusive-addons-elementor' ),
                        'condition' => [
                            'exad_dual_button_connector_switch' => 'yes',
                            'exad_dual_button_connector_type' => 'text',
                        ]
                    ]
                );

                $this->add_control(
                    'exad_dual_button_connector_icon',
                    [
                        'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                        'type' => Controls_Manager::ICONS,
                        'default' => [
                            'value' => 'fas fa-star',
                            'library' => 'solid',
                        ],
                        'condition' => [
                            'exad_dual_button_connector_switch' => 'yes',
                            'exad_dual_button_connector_type' => 'icon',
                        ]
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'exad_dual_button_secondary_button_content', [ 'label' => esc_html__( 'Secondary', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_dual_button_secondary_button_text',
                    [
                        'label' => esc_html__( 'Text', 'exclusive-addons-elementor' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => esc_html__( 'Secondary', 'exclusive-addons-elementor' ),
                    ]
                );

                $this->add_control(
                    'exad_dual_button_secondary_button_url',
                    [
                        'label' => esc_html__( 'Link', 'exclusive-addons-elementor' ),
                        'type' => Controls_Manager::URL,
                        'label_block' => true,
                        'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
                        'show_external' => true,
                        'default' => [
                            'url' => '#',
                            'is_external' => true,
                            'nofollow' => true,
                        ],
                    ]
                );

                $this->add_control(
                    'exad_dual_button_secondary_button_icon',
                    [
                        'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                        'type' => Controls_Manager::ICONS,
                    ]
                );

                $this->add_control(
                    'exad_dual_button_secondary_button_icon_position',
                    [
                        'label' => __( 'Position', 'exclusive-addons-elementor' ),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            'exad-icon-pos-left' => [
                                'title' => __( 'Left', 'exclusive-addons-elementor' ),
                                'icon' => 'fa fa-angle-left',
                            ],
                            'exad-icon-pos-right' => [
                                'title' => __( 'Right', 'exclusive-addons-elementor' ),
                                'icon' => 'fa fa-angle-right',
                            ]
                        ],
                        'default' => 'exad-icon-pos-left',
                    ]
                );

            $this->end_controls_tab();

	    $this->end_controls_tabs();

        $this->end_controls_section();

        /*
        * Exad Dual Button Container Style
        */
        $this->start_controls_section(
            'exad_container_style_section',
            [
                'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'exad_dual_button_container_alignment',
			[
				'label' => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'exad-dual-button-align-left' => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'exad-dual-button-align-center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'exad-dual-button-align-right' => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
                'default' => 'exad-dual-button-align-center',
			]
        );

        $this->add_control(
			'exad_dual_button_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default' => [
                    'top' => '20',
                    'right' => '30',
                    'bottom' => '20',
                    'left' => '30',
                    'unit' => 'px',
                ],
				'selectors' => [
					'{{WRAPPER}} .exad-dual-button-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        $this->add_control(
			'exad_dual_button_container_button_margin',
			[
				'label' => __( 'Space Between Buttons', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -3,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .exad-dual-button-primary' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-dual-button-secondary' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        /*
        * Exad Dual Button Primary Button Style
        */
        $this->start_controls_section(
            'exad_container_primary_button_style',
            [
                'label' => esc_html__( 'Primary Button', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        // $this->add_control(
        //     'exad_dual_button_primary_button_background',
        //     [
        //         'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
        //         'type' => Controls_Manager::COLOR,
        //         'default' => '#d6d6d6',
        //         'selectors' => [
        //             '{{WRAPPER}} .exad-dual-button-primary' => 'background: {{VALUE}};',
        //         ],
        //     ]
        // );
        
        $this->add_control(
			'exad_dual_button_primary_button_radius',
			[
				'label' => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                ],
				'selectors' => [
					'{{WRAPPER}} .exad-dual-button-primary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_control(
			'exad_dual_button_primary_button_icon_margin',
			[
				'label' => __( 'Icon Space', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .exad-dual-button-primary' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        /*
        * Exad Dual Button Connector Style
        */
        $this->start_controls_section(
            'exad_dual_button_connector_style',
            [
                'label' => esc_html__( 'Connector', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_dual_button_connector_switch' => 'yes',
                ]
            ]
        );

        $this->add_control(
			'exad_dual_button_connector_height',
			[
				'label' => __( 'Height', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 35,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-dual-button-connector' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
        );
        
        $this->add_control(
			'exad_dual_button_connector_width',
			[
				'label' => __( 'Width', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 35,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-dual-button-connector' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_dual_button_connector_typoghrphy',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
                'selector' => '{{WRAPPER}} .exad-dual-button-connector span',
                'condition' => [
                    'exad_dual_button_connector_type' => 'text',
                ]
			]
        );
        
        $this->add_control(
			'exad_dual_button_connector_icon_size',
			[
				'label' => __( 'Icon Size', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 40,
					],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-dual-button-connector span' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'exad_dual_button_connector_type' => 'icon',
                ]
			]
		);

        $this->add_control(
            'exad_dual_button_connector_background',
            [
                'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .exad-dual-button-connector' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'exad_dual_button_connector_color',
            [
                'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#d6d6d6',
                'selectors' => [
                    '{{WRAPPER}} .exad-dual-button-connector span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
			'exad_dual_button_connector_radius',
			[
				'label' => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                ],
				'selectors' => [
					'{{WRAPPER}} .exad-dual-button-connector' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_dual_button_connector_border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-dual-button-connector',
			]
        );
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_dual_button_connector_box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-dual-button-connector',
			]
		);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'exad_dual_button', 'class', 'exad-dual-button' );
        $this->add_render_attribute( 'exad_dual_button', 'class', $settings['exad_dual_button_container_alignment'] );

    ?>
        <div <?php echo $this->get_render_attribute_string( 'exad_dual_button' ); ?>>
          <div class="exad-dual-button-wrapper">
            <a href="<?php echo esc_attr( $settings['exad_dual_button_primary_button_url']['url'] ); ?>" class="exad-dual-button-primary exad-dual-button-action">
                <span>
                    <?php if ( $settings['exad_dual_button_primary_button_icon_position'] === 'exad-icon-pos-left' ) { ?>
                        <?php Icons_Manager::render_icon( $settings['exad_dual_button_primary_button_icon'] ); ?>
                        <?php echo esc_attr( $settings['exad_dual_button_primary_button_text'] ); ?>
                    <?php } ?>
                    <?php if ( $settings['exad_dual_button_primary_button_icon_position'] === 'exad-icon-pos-right' ) { ?>
                        <?php echo esc_attr( $settings['exad_dual_button_primary_button_text'] ); ?>
                        <?php Icons_Manager::render_icon( $settings['exad_dual_button_primary_button_icon'] ); ?>
                    <?php } ?>
                </span>
                <?php if ( $settings['exad_dual_button_connector_switch'] === 'yes' ) { ?>
                    <div class="exad-dual-button-connector">
                        <span>
                            <?php if ( $settings['exad_dual_button_connector_type'] === 'text' ) { ?>
                                <?php echo( $settings['exad_dual_button_connector_text'] ); ?>
                            <?php } ?>
                            <?php if ( $settings['exad_dual_button_connector_type'] === 'icon' ) { ?>
                                <?php Icons_Manager::render_icon( $settings['exad_dual_button_connector_icon'] ); ?>
                            <?php } ?>
                        </span>
                    </div>
                <?php } ?>
            </a>
            <a href="<?php echo esc_attr( $settings['exad_dual_button_secondary_button_url']['url'] ); ?>" class="exad-dual-button-secondary exad-dual-button-action">
                <span>
                    <?php if ( $settings['exad_dual_button_secondary_button_icon_position'] === 'exad-icon-pos-left' ) { ?>
                        <?php Icons_Manager::render_icon( $settings['exad_dual_button_secondary_button_icon'] ); ?>
                        <?php echo esc_attr( $settings['exad_dual_button_secondary_button_text'] ); ?>
                    <?php } ?>
                    <?php if ( $settings['exad_dual_button_secondary_button_icon_position'] === 'exad-icon-pos-right' ) { ?>
                        <?php echo esc_attr( $settings['exad_dual_button_secondary_button_text'] ); ?>
                        <?php Icons_Manager::render_icon( $settings['exad_dual_button_secondary_button_icon'] ); ?>
                    <?php } ?>
                </span>
            </a>
          </div>
        </div>
    <?php
	}
    /*protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'exad_dual_button', 'class', 'exad-dual-button' );
        $this->add_render_attribute( 'exad_dual_button', 'class', $settings['exad_dual_button_container_alignment'] );

    ?>
        <div <?php echo $this->get_render_attribute_string( 'exad_dual_button' ); ?>>
          <div class="exad-dual-button-wrapper">
            <a href="#" class="exad-dual-button-primary exad-dual-button-action">Get Now
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
            <div class="exad-dual-button-connector"><span>OR</span></div>
            <a href="#" class="exad-dual-button-secondary exad-dual-button-action">Pre Order</a>
          </div>
        </div>
    <?php
	}*/
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Dual_Button() );