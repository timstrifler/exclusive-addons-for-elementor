<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Infobox extends Widget_Base {
	
	public function get_name() {
		return 'exad-infobox';
	}

	public function get_title() {
		return esc_html__( 'Info Box', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-info-box';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
		return [ 'information', 'service', 'infobox' ];
	}

	protected function _register_controls() {
		/*
		* Infobox Image
		*/
		$this->start_controls_section(
			'exad_section_infobox_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
			]
		);
		
		$this->add_control(
			'exad_infobox_img_or_icon',
			[
				'label'       => esc_html__( 'Image or Icon', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => true,
				'options'     => [
					'none'      => [
						'title' => esc_html__( 'None', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-ban'
					],
					'icon'      => [
						'title' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-info-circle'
					],
					'img'       => [
						'title' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-image-bold'
					]
				],
				'default'       => 'icon'
			]
		);
		
		$this->add_control(
			'exad_infobox_image',
			[
				'label'     => esc_html__( 'Image', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url'   => Utils::get_placeholder_image_src()
				],
				'condition' => [
					'exad_infobox_img_or_icon' => 'img'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'thumbnail',
				'condition' => [
					'exad_infobox_img_or_icon' => 'img'
				]
			]
		);

		$this->add_control(
			'exad_infobox_icon',
			[
				'label'       => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-tag',
					'library' => 'fa-solid'
				],
				'condition'   => [
					'exad_infobox_img_or_icon' => 'icon'
				]
			]
		);

		
		$this->add_control(
			'exad_infobox_title',
			[
				'label'       => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Infobox Title', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_infobox_title_link',
			[
				'label'       => __( 'Title URL', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'label_block' => true
			]
		);
		
		$this->add_control(
			'exad_infobox_description',
			[
				'label'   => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Put your information in the box. Anything you\'d like. Please don\'t keep it empty.', 'exclusive-addons-elementor' )
			]
		);

		$this->end_controls_section();
		

		/*
		* Infobox Styling Section
		*/
		$this->start_controls_section(
			'exad_section_infobox_styles_preset',
			[
				'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_infobox_alignment',
            [
				'label'   => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'exad-infobox-align-left'   => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-left'
					],
					'exad-infobox-align-center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-center'
					],
					'exad-infobox-align-right'  => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default' => 'exad-infobox-align-center'
			]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'background',
				'label'     => __( 'Background', 'exclusive-addons-elementor' ),
				'types'     => [ 'classic', 'gradient' ],
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .exad-infobox .exad-infobox-item',
				'default'   => '#FFFFFF'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'exad_infobox_border',
				'label'    => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-infobox-item'
			]
		);

		$this->add_responsive_control(
			'exad_infobox_border_radius',
			[
				'label'      => esc_html__( 'Border Radious', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
			  	'selectors'  => [
				  	'{{WRAPPER}} .exad-infobox-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
			  	]
			]
		);

		$this->add_responsive_control(
			'exad_infobox_padding',
			[
				'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '30',
					'right'  => '30',
					'bottom' => '30',
					'left'   => '30'
				],
			  	'selectors'  => [
			  		'{{WRAPPER}} .exad-infobox-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
			  	]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_infobox_box_shadow',
				'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-infobox-item'
			]
		);

		
		$this->end_controls_section();

		// transition style

		$this->start_controls_section(
            'section_infobox_transition_style',
            [
				'label' => __('Transition', 'exclusive-addons-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_control(
			'exad_infobox_transition_top',
            [
				'label'        => __( 'Transition Top', 'exclusive-addons-elementor' ),
				'type'         =>  Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
        );
		$this->add_control(
			'exad_infobox_transition_zoom',
            [
				'label'        => __( 'Transition Zoom', 'exclusive-addons-elementor' ),
				'type'         =>  Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'exad_infobox_transition_zoom_background',
				'label'     => __( 'Background', 'exclusive-addons-elementor' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .zoom-transition::before',
				'condition' => [
					'exad_infobox_transition_zoom' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'exad_infobox_transition_zoom_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '100',
				'selectors' => [
				  	'{{WRAPPER}} .exad-infobox-item:hover .exad-infobox-content-title' => 'color: {{VALUE}};'
			  	],
			  	'condition' => [
					'exad_infobox_transition_zoom' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_infobox_transition_zoom_description_color',
			[
				'label'     => esc_html__( 'Description Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '100',
				'selectors' => [
				  	'{{WRAPPER}} .exad-infobox-item:hover .exad-infobox-content-description' => 'color: {{VALUE}};'
		  		],
		  		'condition' => [
					'exad_infobox_transition_zoom' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		//icon style
		$this->start_controls_section(
            'section_infobox_icon',
            [
				'label' => __('Icon/Image', 'exclusive-addons-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_control(
			'exad_infobox_icon_position',
			[
				'label'   => __( 'Position', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'exad-infobox-icon-position-left'   => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-arrow-left'
					],
					'exad-infobox-icon-position-center' => [
						'title' => __( 'Top', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-arrow-up'
					],
					'exad-infobox-icon-position-right'  => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-arrow-right'
					]
				],
				'default' => 'exad-infobox-icon-position-center'
			]
		);

		$this->add_responsive_control(
			'exad_infobox_icon_height',
			[
				'label'       => esc_html__( 'Height', 'exclusive-addons-elementor' ),
				'type'    	  => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 80
			  	],
			  	'range'       => [
				  	'px'      => [
					  	'max' => 250
				  	]
			 	],
			  	'selectors'   => [
				  	'{{WRAPPER}} .exad-infobox-item .exad-infobox-icon' => 'height: {{SIZE}}px;'
			  	]
			]
		);

		$this->add_responsive_control(
			'exad_infobox_icon_width',
			[
				'label'       => esc_html__( 'Width', 'exclusive-addons-elementor' ),
				'type'    	  => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 80
			  	],
			  	'range'       => [
				  	'px'      => [
					  	'max' => 250
				  	]
			 	],
			  	'selectors'   => [
				  	'{{WRAPPER}} .exad-infobox-item .exad-infobox-icon' => 'width: {{SIZE}}px;'
			  	]
			]
		);

		$this->add_responsive_control(
			'exad_infobox_icon_font_size',
			[
				'label'       => esc_html__( 'Icon Size', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 35
			  	],
			  	'range'       => [
				  	'px'      => [
					  	'max' => 100
				  	]
			 	],
			  	'selectors'   => [
				  	'{{WRAPPER}} .exad-infobox-item .exad-infobox-icon i' => 'font-size: {{SIZE}}px;'
			  	],
				'condition'   => [
					'exad_infobox_img_or_icon'  => 'icon',
					'exad_infobox_icon[value]!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'exad_infobox_icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radious', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-infobox-item .exad-infobox-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_infobox_icon_box_shadow',
				'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-infobox-item .exad-infobox-icon'
			]
		);

		$this->add_responsive_control(
			'exad_infobox_icon_margin_top',
			[
				'label'       => esc_html__( 'Top Spacing', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
                ],
                'default'     => [
					'unit'    => 'px',
					'size'    => 0
				],
				'selectors'   => [
				  	'{{WRAPPER}} .exad-infobox-item .exad-infobox-icon' => 'margin-top: {{SIZE}}{{UNIT}};'
			  	]
			]
		);

		$this->add_responsive_control(
			'exad_infobox_icon_margin_bottom',
			[
				'label'       => esc_html__( 'Margin Bottom', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
                ],
                'default'     => [
					'unit'    => 'px',
					'size'    => 20
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-infobox-item .exad-infobox-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};'
			  	]
			]
		);

		$this->start_controls_tabs( 'exad_infobox_icon_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'exad_infobox_icon_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_infobox_icon_background_color_normal',
					[
						'label'     => esc_html__( 'Background', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#7a56ff',
						'selectors' => [
							'{{WRAPPER}} .exad-infobox-item .exad-infobox-icon' => 'background: {{VALUE}}'
						]
					]
				);

				$this->add_control(
					'exad_infobox_icon_color_normal',
					[
						'label'     => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .exad-infobox-item .exad-infobox-icon i' => 'color: {{VALUE}}'
						],
						'condition' => [
							'exad_infobox_img_or_icon'  => 'icon',
							'exad_infobox_icon[value]!' => ''
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'exad_infobox_icon_border_normal',
						'label'    => __( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-infobox-item .exad-infobox-icon'
					]
				);

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'exad_infobox_icon_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_infobox_icon_background_color_hover',
					[
						'label'     => esc_html__( 'Background', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .exad-infobox-item:hover .exad-infobox-icon' => 'background: {{VALUE}}'
						]
					]
				);

				$this->add_control(
					'exad_infobox_icon_color_hover',
					[
						'label'     => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#7a56ff',
						'selectors' => [
							'{{WRAPPER}} .exad-infobox-item:hover .exad-infobox-icon i' => 'color: {{VALUE}}'
						],
						'condition' => [
							'exad_infobox_img_or_icon'  => 'icon',
							'exad_infobox_icon[value]!' => ''
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'exad_infobox_icon_border_hover',
						'label'    => __( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-infobox-item:hover .exad-infobox-icon'
					]
				);
				
			$this->end_controls_tab();
        $this->end_controls_tabs();
		
		$this->end_controls_section();

		// Title , Description Font Color and Typography

		$this->start_controls_section(
            'section_infobox_title',
            [
				'label' => __('Title', 'exclusive-addons-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_title_color',
            [
				'label'     => __('Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
                    '{{WRAPPER}} .exad-infobox-content-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'infobox_title_typography',
				'selector' => '{{WRAPPER}} .exad-infobox-content-title',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ]
            ]
		);
		
		$this->add_responsive_control(
			'exad_infobox_title_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'default'    => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '10',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-infobox-content-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_infobox_description',
            [
				'label' => __('Description', 'exclusive-addons-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_description_color',
            [
				'label'     => __('Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#797c80',
				'selectors' => [
                    '{{WRAPPER}} .exad-infobox-content-description' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'exad_description_typography',
				'selector' => '{{WRAPPER}} .exad-infobox-content-description'
            ]
		);
		
		$this->add_responsive_control(
			'exad_infobox_description_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'default'    => [
                    'top'      => '10',
                    'right'    => '0',
                    'bottom'   => '10',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-infobox-content-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->end_controls_section();
		
	}
	protected function render() {
		$settings                  = $this->get_settings_for_display();		
		$infobox_image             = $this->get_settings_for_display( 'exad_infobox_image' );
		$infobox_image_url         = Group_Control_Image_Size::get_attachment_image_src( $infobox_image['id'], 'thumbnail', $settings );
		$title                     = $settings['exad_infobox_title'];
		$details                   = $settings['exad_infobox_description'];

		$this->add_render_attribute( 'exad_infobox_transition',[
			'class' => [
				'exad-infobox-item', 
				esc_attr( $settings['exad_infobox_alignment'] ), 
				esc_attr( $settings['exad_infobox_icon_position'] ) 
			]
		]);

		if( 'yes' === $settings['exad_infobox_transition_top'] ){
			$this->add_render_attribute( 'exad_infobox_transition', 'class', 'simple-transition' );
		}

		if( 'yes' === $settings['exad_infobox_transition_zoom'] ){
			$this->add_render_attribute( 'exad_infobox_transition', 'class', 'zoom-transition' );
		}

		if ( empty( $infobox_image_url ) ) {
			$infobox_image_url = $infobox_image['url'];
		}  else {
			$infobox_image_url = $infobox_image_url;
		} 

		if( $settings['exad_infobox_title_link']['url'] ) {
            $this->add_render_attribute( 'exad_infobox_title_link', 'href', esc_url( $settings['exad_infobox_title_link']['url'] ) );
		    if( $settings['exad_infobox_title_link']['is_external'] ) {
		        $this->add_render_attribute( 'exad_infobox_title_link', 'target', '_blank' );
		    }
		    if( $settings['exad_infobox_title_link']['nofollow'] ) {
		        $this->add_render_attribute( 'exad_infobox_title_link', 'rel', 'nofollow' );
		    }
        }

        $this->add_render_attribute( 'exad_infobox_title', 'class', 'exad-infobox-content-title' );
		$this->add_inline_editing_attributes( 'exad_infobox_title', 'none' );

        $this->add_render_attribute( 'exad_infobox_description', 'class', 'exad-infobox-content-description' );
		$this->add_inline_editing_attributes( 'exad_infobox_description' );

		echo '<div class="exad-infobox">';
			echo '<div '.$this->get_render_attribute_string( 'exad_infobox_transition' ).'>';
			  	if( 'none' !== $settings['exad_infobox_img_or_icon'] ) {
		            echo '<div class="exad-infobox-icon">';
		            	if( 'icon' === $settings['exad_infobox_img_or_icon'] && $settings['exad_infobox_icon']['value'] ) :
		            		Icons_Manager::render_icon( $settings['exad_infobox_icon'], [ 'aria-hidden' => 'true' ] );
						endif;

		            	if( 'img' == $settings['exad_infobox_img_or_icon'] ) :
							echo '<img src="'.esc_url( $infobox_image_url ).'" alt="'.Control_Media::get_image_alt( $settings['exad_infobox_image'] ).'">';
						endif;			
		            echo '</div>';
			  	}
	            echo '<div class="exad-infobox-content">';
	            	if( !empty( $settings['exad_infobox_title_link']['url'] ) ) {
                        echo '<a '.$this->get_render_attribute_string( 'exad_infobox_title_link' ).'>';
                    }
	            	$title ? printf( '<h3 '.$this->get_render_attribute_string( 'exad_infobox_title' ).'>%s</h3>', esc_html( $title ) ) : '';
	            	if( !empty( $settings['exad_infobox_title_link']['url'] ) ) {
                        echo '</a>';
                    }

	            	$details ? printf( '<div '.$this->get_render_attribute_string( 'exad_infobox_description' ).'>%s</div>', wp_kses_post( $details ) ) : '';
	            echo '</div>';
          	echo '</div>';
        echo '</div>';
	}

	protected function _content_template() {
		?>
		<#
			view.addRenderAttribute( 'exad_infobox_transition', {
				'class': [ 
					'exad-infobox-item', 
					settings.exad_infobox_alignment,
					settings.exad_infobox_icon_position
				]
			} );

			if ( settings.exad_infobox_image.url || settings.exad_infobox_image.id ) {
				var image = {
					id: settings.exad_infobox_image.id,
					url: settings.exad_infobox_image.url,
					size: settings.thumbnail_size,
					dimension: settings.thumbnail_custom_dimension,
					class: 'exad-infobox-img',
					model: view.getEditModel()
				};

				var image_url = elementor.imagesManager.getImageUrl( image );
			}

			if ( 'yes' === settings.exad_infobox_transition_top ){
				view.addRenderAttribute( 'exad_infobox_transition', 'class', 'simple-transition' );
			}

			if ( 'yes' === settings.exad_infobox_transition_zoom ){
				view.addRenderAttribute( 'exad_infobox_transition', 'class', 'zoom-transition' );
			}

			var iconHTML     = elementor.helpers.renderIcon( view, settings.exad_infobox_icon, { 'aria-hidden': true }, 'i' , 'object' );

			view.addRenderAttribute( 'exad_infobox_title', 'class', 'exad-infobox-content-title' );
			view.addInlineEditingAttributes( 'exad_infobox_title', 'none' );

	        view.addRenderAttribute( 'exad_infobox_description', 'class', 'exad-infobox-content-description' );
			view.addInlineEditingAttributes( 'exad_infobox_description' );

		#>
		<div class="exad-infobox">
			<div {{{ view.getRenderAttributeString( 'exad_infobox_transition' ) }}}>
				<# if( 'none' !== settings.exad_infobox_img_or_icon ) { #>
					<div class="exad-infobox-icon">
						<# if ( 'icon' === settings.exad_infobox_img_or_icon && iconHTML.value ) { #>
							<div class="exad-flip-box-front-image">
								{{{ iconHTML.value }}}
							</div>
						<# } #>

						<# if ( 'img' === settings.exad_infobox_img_or_icon && image_url ) { #>
							<img src="{{{ image_url }}}">
						<# } #>
					</div>
				<# } #>

				<div class="exad-infobox-content">
					<# if(  settings.exad_infobox_title_link.url ) { #>
						<a href="{{{ settings.exad_infobox_title_link.url }}}" {{{ view.getRenderAttributeString( 'exad_infobox_title_link' ) }}}>
					<# } #>

					<# if ( settings.exad_infobox_title ) { #>
			        	<h3 {{{ view.getRenderAttributeString( 'exad_infobox_title' ) }}}>
			        		{{{ settings.exad_infobox_title }}}
			        	</h3>
			    	<# } #>

					<# if ( settings.exad_infobox_description ) { #>
			        	<div {{{ view.getRenderAttributeString( 'exad_infobox_description' ) }}}>
			        		{{{ settings.exad_infobox_description }}}
			        	</div>
			    	<# } #>

					<# if(  settings.exad_infobox_title_link.url ) { #>
						</a>
					<# } #>

				</div>
			</div>
		</div>
		<?php
	}
}