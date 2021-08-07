<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

class Dual_Button extends Widget_Base {
	
	public function get_name() {
		return 'exad-dual-button';
	}

	public function get_title() {
		return esc_html__( 'Dual Button', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad exad-logo exad-dual-button';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

    public function get_keywords() {
        return [ 'exclusive', 'multiple', 'dual', 'anchor', 'link', 'btn', 'double' ];
    }

	protected function register_controls() {
        $exad_primary_color   = get_option( 'exad_primary_color_option', '#7a56ff' );
        $exad_secondary_color = get_option( 'exad_secondary_color_option', '#00d8d8' );

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
                        'label'       => esc_html__( 'Text', 'exclusive-addons-elementor' ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => esc_html__( 'Primary', 'exclusive-addons-elementor' ),
                        'dynamic' => [
                            'active' => true,
                        ]
                    ]
                );

                $this->add_control(
                    'exad_dual_button_primary_button_url',
                    [
                        'label'         => esc_html__( 'Link', 'exclusive-addons-elementor' ),
                        'type'          => Controls_Manager::URL,
                        'label_block'   => true,
                        'placeholder'   => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
                        'show_external' => true,
                        'default'       => [
                            'url'         => '#',
                            'is_external' => true
                        ]
                    ]
                );

                $this->add_control(
                    'exad_dual_button_primary_button_icon',
                    [
                        'label'   => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                        'type'    => Controls_Manager::ICONS,
                        'default' => [
                            'value'   => 'far fa-user',
                            'library' => 'fa-regular'
                        ]
                    ]
                );

                $this->add_control(
                    'exad_dual_button_primary_button_icon_position',
                    [
                        'label'     => __( 'Icon Position', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::CHOOSE,
                        'toggle'    => false,
                        'options'   => [
                            'exad-icon-pos-left'  => [
                                'title' => __( 'Left', 'exclusive-addons-elementor' ),
                                'icon'  => 'eicon-angle-left'
                            ],
                            'exad-icon-pos-right' => [
                                'title' => __( 'Right', 'exclusive-addons-elementor' ),
                                'icon'  => 'eicon-angle-right'
                            ]
                        ],
                        'default'   => 'exad-icon-pos-left',
                        'condition' => [
                            'exad_dual_button_primary_button_icon[value]!' => ''
                        ]
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'exad_dual_button_connector_content', [ 'label' => esc_html__( 'Connector', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_dual_button_connector_switch',
                    [
                        'label'        => esc_html__( 'Connector Show/Hide', 'exclusive-addons-elementor' ),
                        'type'         => Controls_Manager::SWITCHER,
                        'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
                        'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
                        'return_value' => 'yes',
                        'default'      => 'no'
                    ]
                );

                $this->add_control(
                    'exad_dual_button_connector_type',
                    [
                        'label'     => esc_html__( 'Type', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'icon',
                        'options'   => [
                            'icon'  => __( 'Icon', 'exclusive-addons-elementor' ),
                            'text'  => __( 'Text', 'exclusive-addons-elementor' )
                        ],
                        'condition' => [
                            'exad_dual_button_connector_switch' => 'yes'
                        ]
                    ]
                );

                $this->add_control(
                    'exad_dual_button_connector_text',
                    [
                        'label'     => esc_html__( 'Text', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::TEXT,
                        'default'   => esc_html__( 'OR', 'exclusive-addons-elementor' ),
                        'condition' => [
                            'exad_dual_button_connector_switch' => 'yes',
                            'exad_dual_button_connector_type'   => 'text'
                        ],
                        'dynamic' => [
                            'active' => true,
                        ]
                    ]
                );

                $this->add_control(
                    'exad_dual_button_connector_icon',
                    [
                        'label'       => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                        'type'        => Controls_Manager::ICONS,
                        'default'     => [
                            'value'   => 'fas fa-star',
                            'library' => 'fa-solid'
                        ],
                        'condition'   => [
                            'exad_dual_button_connector_switch' => 'yes',
                            'exad_dual_button_connector_type'   => 'icon'
                        ]
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'exad_dual_button_secondary_button_content', [ 'label' => esc_html__( 'Secondary', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_dual_button_secondary_button_text',
                    [
                        'label'       => esc_html__( 'Text', 'exclusive-addons-elementor' ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => esc_html__( 'Secondary', 'exclusive-addons-elementor' ),
                        'dynamic' => [
                            'active' => true,
                        ]
                    ]
                );

                $this->add_control(
                    'exad_dual_button_secondary_button_url',
                    [
                        'label'         => esc_html__( 'Link', 'exclusive-addons-elementor' ),
                        'type'          => Controls_Manager::URL,
                        'label_block'   => true,
                        'placeholder'   => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
                        'show_external' => true,
                        'default'       => [
                            'url'         => '#',
                            'is_external' => true
                        ]
                    ]
                );

                $this->add_control(
                    'exad_dual_button_secondary_button_icon',
                    [
                        'label'   => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                        'type'    => Controls_Manager::ICONS,
                        'default' => [
                            'value'   => 'fas fa-plane',
                            'library' => 'fa-solid'
                        ]
                    ]
                );

                $this->add_control(
                    'exad_dual_button_secondary_button_icon_position',
                    [
                        'label'     => __( 'Icon Position', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::CHOOSE,
                        'toggle'    => false,
                        'options'   => [
                            'exad-icon-pos-left'  => [
                                'title' => __( 'Left', 'exclusive-addons-elementor' ),
                                'icon'  => 'eicon-angle-left'
                            ],
                            'exad-icon-pos-right' => [
                                'title' => __( 'Right', 'exclusive-addons-elementor' ),
                                'icon'  => 'eicon-angle-right'
                            ]
                        ],
                        'default'   => 'exad-icon-pos-left',
                        'condition' => [
                            'exad_dual_button_secondary_button_icon[value]!' => ''
                        ]
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
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'exad_dual_button_container_alignment',
			[
                'label'   => __( 'Alignment', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'toggle'  => false,
                'options' => [
					'exad-dual-button-align-left'   => [
                        'title' => __( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-left'
					],
					'exad-dual-button-align-center' => [
                        'title' => __( 'Center', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-center'
					],
					'exad-dual-button-align-right'  => [
                        'title' => __( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-right'
					]
				],
                'default' => 'exad-dual-button-align-center'
			]
        );

        $this->add_responsive_control(
			'exad_dual_button_padding',
			[
                'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '12',
                    'right'    => '45',
                    'bottom'   => '12',
                    'left'     => '45',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-dual-button-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );
        
        $this->add_responsive_control(
			'exad_dual_button_container_button_margin',
			[
                'label'      => __( 'Space Between Buttons', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
					'px'     => [
						'min' => -3,
						'max' => 100
					]
                ],
                'default'  => [
					'unit' => 'px',
					'size' => 10
				],
				'selectors' => [
                    '{{WRAPPER}} .exad-dual-button-primary'                             => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exad-dual-button-primary .exad-dual-button-connector' => 'right: calc( 0px - {{SIZE}}{{UNIT}} );',
                    '{{WRAPPER}} .exad-dual-button-secondary'                           => 'margin-left: {{SIZE}}{{UNIT}};'
				]
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
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
			'exad_container_primary_button_padding',
			[
                'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-dual-button-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'exad_container_primary_button_margin',
			[
                'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-dual-button-primary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name'     => 'exad_container_primary_button_typography',
                'selector' => '{{WRAPPER}} .exad-dual-button-primary span'
			]
        );
        
        $this->add_responsive_control(
			'exad_dual_button_primary_button_radius',
			[
                'label'      => __( 'Border radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => '50',
                    'right'  => '50',
                    'bottom' => '50',
                    'left'   => '50',
                    'unit'   => 'px'
                ],
				'selectors'  => [
                    '{{WRAPPER}} .exad-dual-button-primary, 
                    {{WRAPPER}} .exad-dual-button-primary.effect-1::before,
                    {{WRAPPER}} .exad-dual-button-primary.effect-2::before,
                    {{WRAPPER}} .exad-dual-button-primary.effect-3::before,
                    {{WRAPPER}} .exad-dual-button-primary.effect-4::before,
                    {{WRAPPER}} .exad-dual-button-primary.effect-6::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'exad_dual_button_primary_button_icon_margin',
			[
                'label'       => __( 'Icon Space', 'exclusive-addons-elementor' ),
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
                    '{{WRAPPER}} .exad-dual-button-primary .exad-icon-pos-left i'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exad-dual-button-primary .exad-icon-pos-right i' => 'margin-left: {{SIZE}}{{UNIT}};'
				],
                'condition'   => [
                    'exad_dual_button_primary_button_icon[value]!' => ''
                ]
			]
        );
        
        $this->add_control(
            'exad_dual_button_primary_button_animation',
            [
                'label'   => esc_html__( 'Hover Effect', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'effect-5',
                'options' => [
                    'effect-1' => __( 'Effect 1', 'exclusive-addons-elementor' ),
                    'effect-2' => __( 'Effect 2', 'exclusive-addons-elementor' ),
                    'effect-3' => __( 'Effect 3', 'exclusive-addons-elementor' ),
                    'effect-4' => __( 'Effect 4', 'exclusive-addons-elementor' ),
                    'effect-5' => __( 'Effect 5', 'exclusive-addons-elementor' ),
                    'effect-6' => __( 'Effect 6', 'exclusive-addons-elementor' )
                ]
            ]
        );

        $this->start_controls_tabs( 'exad_dual_button_primary_button_tabs' );

            $this->start_controls_tab( 'exad_dual_button_primary_button_noemal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_dual_button_primary_button_normal_text_color',
                    [
                        'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-dual-button-primary' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'exad_dual_button_primary_button_normal_bg',
                    [
                        'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => $exad_primary_color,
                        'selectors' => [
                            '{{WRAPPER}} .exad-dual-button-primary.effect-1' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-primary.effect-2' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-primary.effect-3' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-primary.effect-4' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-primary.effect-5' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-primary.effect-6' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'exad_dual_button_primary_button_normal_border',
                        'selector' => '{{WRAPPER}} .exad-dual-button-primary'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'exad_dual_button_primary_button_normal_box_shadow',
                        'selector' => '{{WRAPPER}} .exad-dual-button-primary'
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'exad_dual_button_primary_button_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_dual_button_primary_button_hover_text_color',
                    [
                        'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-dual-button-primary:hover' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'exad_dual_button_primary_button_hover_bg',
                    [
                        'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#5543dc',
                        'selectors' => [
                            '{{WRAPPER}} .exad-dual-button-primary.effect-1::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-primary.effect-2::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-primary.effect-3::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-primary.effect-4::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-primary.effect-5:hover'   => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-primary.effect-6::before' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'exad_dual_button_primary_button_hover_border',
                        'selector' => '{{WRAPPER}} .exad-dual-button-primary:hover'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'exad_dual_button_primary_button_hover_box_shadow',
                        'selector' => '{{WRAPPER}} .exad-dual-button-primary:hover'
                    ]
                );

            $this->end_controls_tab();

	    $this->end_controls_tabs();

        $this->end_controls_section();

        /*
        * Exad Dual Button Connector Style
        */
        $this->start_controls_section(
            'exad_dual_button_connector_style',
            [
                'label'     => esc_html__( 'Connector', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_dual_button_connector_switch' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
			'exad_dual_button_connector_height',
			[
                'label'      => __( 'Height', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
                ],
                'default'  => [
					'unit' => 'px',
					'size' => 30
				],
				'selectors' => [
					'{{WRAPPER}} .exad-dual-button-connector' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
        );
        
        $this->add_responsive_control(
			'exad_dual_button_connector_width',
			[
                'label'      => __( 'Width', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
                ],
                'default'    => [
					'unit'   => 'px',
					'size'   => 30
				],
				'selectors' => [
					'{{WRAPPER}} .exad-dual-button-connector' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name'      => 'exad_dual_button_connector_typoghrphy',
                'selector'  => '{{WRAPPER}} .exad-dual-button-connector span',
                'condition' => [
                    'exad_dual_button_connector_type' => 'text'
                ]
			]
        );
        
        $this->add_responsive_control(
			'exad_dual_button_connector_icon_size',
			[
                'label'      => __( 'Icon Size', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
					'px'      => [
						'min' => 0,
						'max' => 40
					]
                ],
                'default'    => [
					'unit'   => 'px',
					'size'   => 14
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-dual-button-connector span' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'condition'  => [
                    'exad_dual_button_connector_type'         => 'icon',
                    'exad_dual_button_connector_icon[value]!' => ''
                ]
			]
		);

        $this->add_control(
            'exad_dual_button_connector_background',
            [
                'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .exad-dual-button-connector' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'exad_dual_button_connector_color',
            [
                'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .exad-dual-button-connector span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
			'exad_dual_button_connector_radius',
			[
                'label'      => __( 'Border radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => '50',
                    'right'  => '50',
                    'bottom' => '50',
                    'left'   => '50',
                    'unit'   => '%'
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-dual-button-connector' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'name'     => 'exad_dual_button_connector_border',
                'selector' => '{{WRAPPER}} .exad-dual-button-connector'
			]
        );
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
                'name'     => 'exad_dual_button_connector_box_shadow',
                'selector' => '{{WRAPPER}} .exad-dual-button-connector'
			]
		);

        $this->end_controls_section();

        /*
        * Exad Dual Button secondary Button Style
        */
        $this->start_controls_section(
            'exad_container_secondary_button_style',
            [
                'label' => esc_html__( 'Secondary Button', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
			'exad_container_secondary_button_padding',
			[
                'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-dual-button-secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'exad_container_secondary_button_margin',
			[
                'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-dual-button-secondary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name'     => 'exad_container_secondary_button_typography',
                'selector' => '{{WRAPPER}} .exad-dual-button-secondary span'
			]
        );
        
        $this->add_responsive_control(
			'exad_dual_button_secondary_button_radius',
			[
                'label'      => __( 'Border radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => '50',
                    'right'  => '50',
                    'bottom' => '50',
                    'left'   => '50',
                    'unit'   => 'px'
                ],
				'selectors'  => [
                    '{{WRAPPER}} .exad-dual-button-secondary, {{WRAPPER}} .exad-dual-button-secondary.effect-1::before, {{WRAPPER}} .exad-dual-button-secondary.effect-2::before, {{WRAPPER}} .exad-dual-button-secondary.effect-3::before, {{WRAPPER}} .exad-dual-button-secondary.effect-4::before, {{WRAPPER}} .exad-dual-button-secondary.effect-6::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
			'exad_dual_button_secondary_button_icon_margin',
			[
                'label'       => __( 'Icon Space', 'exclusive-addons-elementor' ),
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
                    '{{WRAPPER}} .exad-dual-button-secondary .exad-icon-pos-left i'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exad-dual-button-secondary .exad-icon-pos-right i' => 'margin-left: {{SIZE}}{{UNIT}};'
				],
                'condition'   => [
                    'exad_dual_button_secondary_button_icon[value]!' => ''
                ]
			]
        );
        
        $this->add_control(
            'exad_dual_button_secondary_button_animation',
            [
                'label'   => esc_html__( 'Hover Effect', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'effect-5',
                'options' => [
                    'effect-1' => __( 'Effect 1', 'exclusive-addons-elementor' ),
                    'effect-2' => __( 'Effect 2', 'exclusive-addons-elementor' ),
                    'effect-3' => __( 'Effect 3', 'exclusive-addons-elementor' ),
                    'effect-4' => __( 'Effect 4', 'exclusive-addons-elementor' ),
                    'effect-5' => __( 'Effect 5', 'exclusive-addons-elementor' ),
                    'effect-6' => __( 'Effect 6', 'exclusive-addons-elementor' )
                ]
            ]
        );

        $this->start_controls_tabs( 'exad_dual_button_secondary_button_tabs' );

            $this->start_controls_tab( 'exad_dual_button_secondary_button_noemal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_dual_button_secondary_button_normal_text_color',
                    [
                        'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-dual-button-secondary' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'exad_dual_button_secondary_button_normal_bg',
                    [
                        'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => $exad_secondary_color,
                        'selectors' => [
                            '{{WRAPPER}} .exad-dual-button-secondary.effect-1' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-secondary.effect-2' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-secondary.effect-3' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-secondary.effect-4' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-secondary.effect-5' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-secondary.effect-6' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'exad_dual_button_secondary_button_normal_border',
                        'selector' => '{{WRAPPER}} .exad-dual-button-secondary'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'exad_dual_button_secondary_button_normal_box_shadow',
                        'selector' => '{{WRAPPER}} .exad-dual-button-secondary'
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'exad_dual_button_secondary_button_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_dual_button_secondary_button_hover_text_color',
                    [
                        'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-dual-button-secondary:hover' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'exad_dual_button_secondary_button_hover_bg',
                    [
                        'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#04c1c1',
                        'selectors' => [
                            '{{WRAPPER}} .exad-dual-button-secondary.effect-1::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-secondary.effect-2::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-secondary.effect-3::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-secondary.effect-4::before' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-secondary.effect-5:hover'   => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-dual-button-secondary.effect-6::before' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'exad_dual_button_secondary_button_hover_border',
                        'selector' => '{{WRAPPER}} .exad-dual-button-secondary:hover'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'exad_dual_button_secondary_button_hover_box_shadow',
                        'selector' => '{{WRAPPER}} .exad-dual-button-secondary:hover'
                    ]
                );

            $this->end_controls_tab();

	    $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings                = $this->get_settings_for_display();
        $secondary_btn_icon_pos = $settings['exad_dual_button_secondary_button_icon_position'];
        $primary_btn_icon_pos   = $settings['exad_dual_button_primary_button_icon_position'];

        $this->add_render_attribute( 
            'exad_dual_button', 
            [
                'class' => [ 
                    'exad-dual-button', 
                    esc_attr( $settings['exad_dual_button_container_alignment'] ) 
                ]
            ]
        );

        $this->add_render_attribute( 
            'exad_dual_button_primary_button_url', 
            [
                'class' => [ 
                    'exad-dual-button-primary exad-dual-button-action', 
                    esc_attr( $settings['exad_dual_button_primary_button_animation'] ) 
                ]
            ]
        );
        
        $this->add_render_attribute( 
            'exad_dual_button_secondary_button_url', 
            [
                'class' => [ 
                    'exad-dual-button-secondary exad-dual-button-action', 
                    esc_attr( $settings['exad_dual_button_secondary_button_animation'] ) 
                ]
            ]
        );

        if( $settings['exad_dual_button_primary_button_url']['url'] ) {
            $this->add_render_attribute( 'exad_dual_button_primary_button_url', 'href', esc_url( $settings['exad_dual_button_primary_button_url']['url'] ) );
            if( $settings['exad_dual_button_primary_button_url']['is_external'] ) {
                $this->add_render_attribute( 'exad_dual_button_primary_button_url', 'target', '_blank' );
            }
            if( $settings['exad_dual_button_primary_button_url']['nofollow'] ) {
                $this->add_render_attribute( 'exad_dual_button_primary_button_url', 'rel', 'nofollow' );
            }
        }

        if( $settings['exad_dual_button_secondary_button_url']['url'] ) {
            $this->add_render_attribute( 'exad_dual_button_secondary_button_url', 'href', esc_url( $settings['exad_dual_button_secondary_button_url']['url'] ) );
            if( $settings['exad_dual_button_secondary_button_url']['is_external'] ) {
                $this->add_render_attribute( 'exad_dual_button_secondary_button_url', 'target', '_blank' );
            }
            if( $settings['exad_dual_button_secondary_button_url']['nofollow'] ) {
                $this->add_render_attribute( 'exad_dual_button_secondary_button_url', 'rel', 'nofollow' );
            }
        }

        $this->add_inline_editing_attributes( 'exad_dual_button_primary_button_text', 'none' );
        $this->add_inline_editing_attributes( 'exad_dual_button_connector_text', 'none' );
        $this->add_inline_editing_attributes( 'exad_dual_button_secondary_button_text', 'none' );
        ?>

        <div <?php echo $this->get_render_attribute_string( 'exad_dual_button' ); ?>>
            <div class="exad-dual-button-wrapper">
                <a <?php echo $this->get_render_attribute_string( 'exad_dual_button_primary_button_url' ); ?>>
                    <span class="<?php echo esc_attr( $primary_btn_icon_pos ); ?>">
                    <?php 
                        if ( 'exad-icon-pos-left' === $primary_btn_icon_pos && !empty( $settings['exad_dual_button_primary_button_icon']['value'] ) ) {
                            Icons_Manager::render_icon( $settings['exad_dual_button_primary_button_icon'] );
                        }
                    ?>
                        <span <?php echo $this->get_render_attribute_string( 'exad_dual_button_primary_button_text' ); ?>>
                            <?php echo esc_html( $settings['exad_dual_button_primary_button_text'] ); ?>
                        </span>
                        <?php 
                        if ( 'exad-icon-pos-right' === $primary_btn_icon_pos && !empty( $settings['exad_dual_button_primary_button_icon']['value'] ) ) {
                            Icons_Manager::render_icon( $settings['exad_dual_button_primary_button_icon'] );
                        }
                        ?>
                    </span>

                    <?php    
                    if ( 'yes' === $settings['exad_dual_button_connector_switch'] ) { ?>
                        <div class="exad-dual-button-connector">
                        <?php if ( 'text' === $settings['exad_dual_button_connector_type'] ) { ?>
                            <span <?php echo $this->get_render_attribute_string( 'exad_dual_button_connector_text' ); ?>>
                                <?php echo esc_html( $settings['exad_dual_button_connector_text'] ); ?>
                            </span>
                            <?php 
                            }
                            if ( 'icon' === $settings['exad_dual_button_connector_type'] && !empty( $settings['exad_dual_button_connector_icon']['value'] ) ) { ?>
                                <span>
                                    <?php Icons_Manager::render_icon( $settings['exad_dual_button_connector_icon'] ); ?>
                                </span>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </a>
                
                <a <?php echo $this->get_render_attribute_string( 'exad_dual_button_secondary_button_url' ); ?>>
                    <span class="<?php echo esc_attr( $secondary_btn_icon_pos ); ?>">
                    <?php 
                        if ( 'exad-icon-pos-left' === $secondary_btn_icon_pos && !empty( $settings['exad_dual_button_secondary_button_icon']['value'] ) ) {
                            Icons_Manager::render_icon( $settings['exad_dual_button_secondary_button_icon'] );
                        }
                        ?>
                        <span <?php echo $this->get_render_attribute_string( 'exad_dual_button_secondary_button_text' ); ?>>
                            <?php echo esc_html( $settings['exad_dual_button_secondary_button_text'] ); ?>
                        </span>
                        <?php 
                        if ( 'exad-icon-pos-right' === $secondary_btn_icon_pos && !empty( $settings['exad_dual_button_secondary_button_icon']['value'] ) ) {
                            Icons_Manager::render_icon( $settings['exad_dual_button_secondary_button_icon'] );
                        }
                        ?>
                    </span>
                </a>
            </div>
        </div>
        <?php 
    }

    /**
     * Render dual button widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
        ?>
        <#
            view.addRenderAttribute( 'exad_dual_button', {
                'class': [ 
                    'exad-dual-button', 
                    settings.exad_dual_button_container_alignment
                ]
            } );

            view.addRenderAttribute( 'exad_dual_button_primary_button_url', {
                'class': [ 
                    'exad-dual-button-primary exad-dual-button-action', 
                    settings.exad_dual_button_primary_button_animation
                ]
            } );
            
            view.addRenderAttribute( 'exad_dual_button_secondary_button_url', {
                'class': [ 
                    'exad-dual-button-secondary exad-dual-button-action', 
                    settings.exad_dual_button_secondary_button_animation
                ]
            } );

            view.addInlineEditingAttributes( 'exad_dual_button_primary_button_text', 'none' );
            view.addInlineEditingAttributes( 'exad_dual_button_connector_text', 'none' );
            view.addInlineEditingAttributes( 'exad_dual_button_secondary_button_text', 'none' );

            var primaryIcon   = elementor.helpers.renderIcon( view, settings.exad_dual_button_primary_button_icon, { 'aria-hidden': true }, 'i' , 'object' );
            var connectorIcon = elementor.helpers.renderIcon( view, settings.exad_dual_button_connector_icon, { 'aria-hidden': true }, 'i' , 'object' );
            var secondaryIcon = elementor.helpers.renderIcon( view, settings.exad_dual_button_secondary_button_icon, { 'aria-hidden': true }, 'i' , 'object' );

            var primaryBtnTarget = settings.exad_dual_button_primary_button_url.lis_external ? ' target="_blank"' : '';
            var primaryBtnNofollow = settings.exad_dual_button_primary_button_url.lnofollow ? ' rel="nofollow"' : '';

            var secondaryBtnTarget = settings.exad_dual_button_secondary_button_url.is_external ? ' target="_blank"' : '';
            var secondaryBtnNofollow = settings.exad_dual_button_secondary_button_url.nofollow ? ' rel="nofollow"' : '';

        #>
            <div {{{ view.getRenderAttributeString( 'exad_dual_button' ) }}}>
                <div class="exad-dual-button-wrapper">
                    <a href="{{{ settings.exad_dual_button_primary_button_url.url }}}" {{{ view.getRenderAttributeString( 'exad_dual_button_primary_button_url' ) }}}{{{ primaryBtnTarget }}}{{{ primaryBtnNofollow }}}>
                        <span class="{{{ settings.exad_dual_button_primary_button_icon_position }}}">
                            <# if ( 'exad-icon-pos-left' === settings.exad_dual_button_primary_button_icon_position && primaryIcon.value ) { #>
                                {{{ primaryIcon.value }}}
                            <# } #>

                            <span {{{ view.getRenderAttributeString( 'exad_dual_button_primary_button_text' ) }}}>
                                {{{ settings.exad_dual_button_primary_button_text }}}
                            </span>

                            <# if ( 'exad-icon-pos-right' === settings.exad_dual_button_primary_button_icon_position && primaryIcon.value ) { #>
                                {{{ primaryIcon.value }}}
                            <# } #>
                        </span>

                        <# if ( 'yes' === settings.exad_dual_button_connector_switch ) { #>
                            <div class="exad-dual-button-connector">
                                <# if ( 'text' === settings.exad_dual_button_connector_type ) { #>
                                    <span {{{ view.getRenderAttributeString( 'exad_dual_button_connector_text' ) }}}>
                                        {{{ settings.exad_dual_button_connector_text }}}
                                    </span>
                                <# } #>

                                <# if ( 'icon' === settings.exad_dual_button_connector_type && connectorIcon.value ) { #>
                                    <span>
                                        {{{ connectorIcon.value }}}
                                    </span>
                                <# } #>
                            </div>
                        <# } #>
                    </a>

                    <a href="{{{ settings.exad_dual_button_secondary_button_url.url }}}" {{{ view.getRenderAttributeString( 'exad_dual_button_secondary_button_url' ) }}}{{{ secondaryBtnTarget }}}{{{ secondaryBtnNofollow }}}>
                        <span class="{{{ settings.exad_dual_button_secondary_button_icon_position }}}">
                            <# if ( 'exad-icon-pos-left' === settings.exad_dual_button_secondary_button_icon_position && secondaryIcon.value ) { #>
                                {{{ secondaryIcon.value }}}
                            <# } #>

                            <span {{{ view.getRenderAttributeString( 'exad_dual_button_secondary_button_text' ) }}}>
                                {{{ settings.exad_dual_button_secondary_button_text }}}
                            </span>

                            <# if ( 'exad-icon-pos-right' === settings.exad_dual_button_secondary_button_icon_position && secondaryIcon.value ) { #>
                                {{{ secondaryIcon.value }}}
                            <# } #>
                        </span>
                    </a>

                </div>
            </div>
        <?php
    }
}