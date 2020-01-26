<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Widget_Base;

class Iconbox extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-iconbox';
	}

	public function get_title() {
		return esc_html__( 'Icon Box', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-icon-box';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
        return [ 'icon', 'box' ];
    }

	protected function _register_controls() {

        /**
  		 * Icon Box Content
  		 */
  		$this->start_controls_section(
            'exad_section_icon_box_content',
            [
                'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_icon_box_icon',
            [
                'label'       => __( 'Icon', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
                    'value'   => 'fab fa-wordpress-simple',
                    'library' => 'fa-brands'
                ],
            ]
        );
        
        $this->add_control(
			'exad_icon_box_title',
			[
				'label'       => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Icon Box Title', 'exclusive-addons-elementor' )
			]
        );
        
        $this->add_control(
			'exad_icon_box_description',
			[
				'label'       => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default'     => esc_html__( 'Icon Box Description', 'exclusive-addons-elementor' )
			]
        );
        
        $this->add_control(
			'exad_icon_box_url',
			[
				'label'       => __( 'URL', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'label_block' => true
			]
		);

        $this->end_controls_section();
        
        /**
  		 * Icon Box Container Style
  		 */
  		$this->start_controls_section(
            'exad_section_icon_box_container',
            [
                'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'exad_iconbox_alignment',
			[
				'label'       => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'options'     => [
					'exad-iconbox-left'   => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-left'
					],
					'exad-iconbox-center' => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-center'
					],
					'exad-iconbox-right'  => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default'     => 'exad-iconbox-center'
			]
        );

        $this->add_control(
			'exad_iconbox_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .exad-iconbox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
        
        $this->add_control(
			'exad_iconbox_radius',
			[
				'label' => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .exad-iconbox' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);
        
        $this->start_controls_tabs( 'exad_iconbox_container_tab' );
			// Normal State Tab
			$this->start_controls_tab( 'exad_iconbox_container_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );
                
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'            => 'exad_iconbox_container_background_normal',
                        'types'           => [ 'classic', 'gradient' ],
                        'selector'        => '{{WRAPPER}} .exad-iconbox',
                    ]
                );

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'exad_iconbox_container_border_normal',
                        'selector' => '{{WRAPPER}} .exad-iconbox',
					]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'exad_iconbox_container_shadow_normal',
                        'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
                        'selector' => '{{WRAPPER}} .exad-iconbox',
                    ]
                );

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'exad_iconbox_container_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'            => 'exad_iconbox_container_background_hover',
                        'types'           => [ 'classic', 'gradient' ],
                        'selector'        => '{{WRAPPER}} .exad-iconbox:hover',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'exad_iconbox_container_border_hover',
                        'selector' => '{{WRAPPER}} .exad-iconbox:hover',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'exad_iconbox_container_shadow_hover',
                        'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
                        'selector' => '{{WRAPPER}} .exad-iconbox:hover',
                    ]
                );
				
			$this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        
        /**
  		 * Icon Box icon Style
  		 */
  		$this->start_controls_section(
            'exad_section_icon_box_icon',
            [
                'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'exad_iconbox_enable',
            [
				'label'        => esc_html__( 'Icon Box Enable', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes'
            ]
		);
		
		$this->add_responsive_control(
			'exad_iconbox_height',
			[
				'label'     => esc_html__( 'Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-iconbox-icon.yes' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_iconbox_enable' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'exad_iconbox_width',
			[
				'label'     => esc_html__( 'Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-iconbox-icon.yes' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_iconbox_enable' => 'yes'
				]
			]
		);

        $this->add_control(
			'exad_icon_box_icon_size',
			[
				'label' => __( 'Size', 'exclusive-addons-elementor' ),
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
					'size' => 30,
				],
				'selectors' => [
                    '{{WRAPPER}} .exad-iconbox-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exad-iconbox-icon svg' => 'height: {{SIZE}}px; width: {{SIZE}}px;'
				],
			]
        );

        $this->add_control(
			'exad_icon_box_icon_radius',
			[
				'label' => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .exad-iconbox-icon.yes' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
					'exad_iconbox_enable' => 'yes'
				]
			]
		);

        $this->start_controls_tabs( 'exad_iconbox_icon_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'exad_iconbox_icon_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );
                
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'            => 'exad_iconbox_icon_background_normal',
                        'types'           => [ 'classic', 'gradient' ],
                        'selector'        => '{{WRAPPER}} .exad-iconbox-icon.yes',
                        'condition' => [
                            'exad_iconbox_enable' => 'yes'
                        ]
                    ]
                );

				$this->add_control(
					'exad_iconbox_icon_color_normal',
					[
						'label'     => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#000000',
						'selectors' => [
							'{{WRAPPER}} .exad-iconbox-icon i' => 'color: {{VALUE}}',
							'{{WRAPPER}} .exad-iconbox-icon svg path' => 'fill: {{VALUE}}'
						],
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'exad_iconbox_icon_border_normal',
                        'selector' => '{{WRAPPER}} .exad-iconbox-icon.yes',
                        'condition' => [
                            'exad_iconbox_enable' => 'yes'
                        ]
					]
				);

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'exad_iconbox_icon_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'            => 'exad_iconbox_icon_background_hover',
                        'types'           => [ 'classic', 'gradient' ],
                        'selector'        => '{{WRAPPER}} .exad-iconbox:hover .exad-iconbox-icon.yes',
                        'condition' => [
                            'exad_iconbox_enable' => 'yes'
                        ]
                    ]
                );

                $this->add_control(
                    'exad_iconbox_icon_color_hover',
                    [
                        'label'     => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-iconbox:hover .exad-iconbox-icon i' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .exad-iconbox:hover .exad-iconbox-icon svg path' => 'fill: {{VALUE}}'
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'exad_iconbox_icon_border_hover',
                        'selector' => '{{WRAPPER}} .exad-iconbox:hover .exad-iconbox-icon.yes',
                        'condition' => [
                            'exad_iconbox_enable' => 'yes'
                        ]
                    ]
                );
				
			$this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        
        /**
  		 * Icon Box Title Style
  		 */
  		$this->start_controls_section(
            'exad_section_iconbox_title',
            [
                'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_iconbox_title_typography',
				'selector' => '{{WRAPPER}} .exad-iconbox-title'
			]
		);

        $this->add_control(
			'exad_iconbox_title_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .exad-iconbox-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

        $this->start_controls_tabs( 'exad_iconbox_title_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'exad_iconbox_title_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_iconbox_title_normal_color',
					[
						'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#000000',
						'selectors' => [
							'{{WRAPPER}} .exad-iconbox-title' => 'color: {{VALUE}}'
						],
					]
				);

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'exad_iconbox_title_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_iconbox_title_hover_color',
                    [
                        'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-iconbox:hover .exad-iconbox-title' => 'color: {{VALUE}}'
                        ],
                    ]
                );
				
			$this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        
        /**
  		 * Icon Box Discription Style
  		 */
  		$this->start_controls_section(
            'exad_section_iconbox_description',
            [
                'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_iconbox_description_typography',
				'selector' => '{{WRAPPER}} .exad-iconbox-description'
			]
		);

        $this->add_control(
			'exad_iconbox_description_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .exad-iconbox-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

        $this->start_controls_tabs( 'exad_iconbox_description_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'exad_iconbox_description_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_iconbox_description_normal_color',
					[
						'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#000000',
						'selectors' => [
							'{{WRAPPER}} .exad-iconbox-description' => 'color: {{VALUE}}'
						],
					]
				);

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'exad_iconbox_description_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_iconbox_description_hover_color',
                    [
                        'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-iconbox:hover .exad-iconbox-description' => 'color: {{VALUE}}'
                        ],
                    ]
                );
				
			$this->end_controls_tab();
        $this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
        $settings      = $this->get_settings_for_display();

        if( $settings['exad_icon_box_url']['url'] ) {
            $this->add_render_attribute( 'exad_icon_box_url', 'href', esc_url( $settings['exad_icon_box_url']['url'] ) );
	        if( $settings['exad_icon_box_url']['is_external'] ) {
	            $this->add_render_attribute( 'exad_icon_box_url', 'target', '_blank' );
	        }
	        if( $settings['exad_icon_box_url']['nofollow'] ) {
	            $this->add_render_attribute( 'exad_icon_box_url', 'rel', 'nofollow' );
	        }
        }

        $this->add_render_attribute( 'exad_icon_box_url', 'class', 'exad-iconbox-wrapper' );

        echo '<div class="exad-iconbox '.$settings['exad_iconbox_alignment'].'">';
            if( !empty( $settings['exad_icon_box_url']['url'] ) ) {
                echo '<a '.$this->get_render_attribute_string( 'exad_icon_box_url' ).'>';
            }
                echo '<span class="exad-iconbox-icon '.$settings['exad_iconbox_enable'].'">';
                    Icons_Manager::render_icon( $settings['exad_icon_box_icon'], [ 'aria-hidden' => 'true' ] );
                echo '</span>';
                if( !empty( $settings['exad_icon_box_title']) ) {
                    echo '<h1 class="exad-iconbox-title">';
                        echo wp_kses_post( $settings['exad_icon_box_title'] );
                    echo '</h1>';
                }
                if( !empty( $settings['exad_icon_box_description']) ) {
                    echo '<p class="exad-iconbox-description">';
                        echo wp_kses_post( $settings['exad_icon_box_description'] );
                    echo '</p>';
                }
            if( !empty( $settings['exad_icon_box_url']['url'] ) ) {
                echo '</a>';
            }
        echo '</div>';
	}
    
}