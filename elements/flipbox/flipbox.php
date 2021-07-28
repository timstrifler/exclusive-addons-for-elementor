<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use \ExclusiveAddons\Elementor\Helper;

class Flipbox extends Widget_Base {

	public function get_name() {
		return 'exad-flipbox';
	}

	public function get_title() {
		return esc_html__( 'Flip Box', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad exad-logo exad-flipbox';
	}

   	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
        return [ 'exclusive', 'info', 'flipbox' ];
    }

	protected function register_controls() {
		$exad_primary_color = get_option( 'exad_primary_color_option', '#7a56ff' );

  		$this->start_controls_section(
			'exad_section_side_a_content',
			[
				'label' => __( 'Front', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_flipbox_front_icon_image',
			[
				'label'         => esc_html__( 'Image or Icon', 'exclusive-addons-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'label_block'   => true,
				'default'       => 'icon',
				'options'       => [
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
				]
			]
		);

		$this->add_control(
			'exad_flipbox_front_icon',
			[
				'label'   => __( 'Icon', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::ICONS,
                'default' => [
					'value'   => 'fas fa-heart',
					'library' => 'fa-solid'
				],
				'condition' => [
					'exad_flipbox_front_icon_image' => 'icon'
				]
			]
		);

		$this->add_control(
			'exad_flipbox_front_image',
			[
				'label'     => esc_html__( 'Image', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url'   => Utils::get_placeholder_image_src()
				],
				'condition' => [
					'exad_flipbox_front_icon_image' => 'img'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'exad_flipbox_front_image_thumbnail',
				'default'   => 'medium_large',
				'condition' => [
					'exad_flipbox_front_icon_image' => 'img'
				]
			]
		);

		$this->add_control(
			'exad_flipbox_front_title',
			[
				'label'       => __( 'Title', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Heading Front', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Your Title', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_flipbox_front_description',
			[
				'label'       => __( 'Description', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor. Add some more test in here.', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Your Description', 'exclusive-addons-elementor' ),
				'title'       => __( 'Input image text here', 'exclusive-addons-elementor' )
			]
		);
	
		$this->end_controls_section();

		$this->start_controls_section(
			'exad_section_back_content',
			[
				'label' => __( 'Back', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_flipbox_back_icon_image',
			[
				'label'         => esc_html__( 'Image or Icon', 'exclusive-addons-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'label_block'   => true,
				'default'       => 'icon',
				'options'       => [
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
				]
			]
		);

		$this->add_control(
			'exad_flipbox_back_icon',
			[
				'label'     => __( 'Icon', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => [
					'exad_flipbox_back_icon_image' => 'icon'
				]
			]
		);

		$this->add_control(
			'exad_flipbox_back_image',
			[
				'label'     => esc_html__( 'Image', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url'   => Utils::get_placeholder_image_src()
				],
				'condition' => [
					'exad_flipbox_back_icon_image' => 'img'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'exad_flipbox_back_image_thumbnail',
				'default'   => 'medium_large',
				'condition' => [
					'exad_flipbox_back_icon_image' => 'img'
				]
			]
		);

		$this->add_control(
			'exad_flipbox_back_title',
			[
				'label'       => __( 'Title', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Heading Back', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Your Title', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_flipbox_back_description',
			[
				'label'       => __( 'Description', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Your Description', 'exclusive-addons-elementor' ),
				'title'       => __( 'Input image text here', 'exclusive-addons-elementor' ),
				'separator'   => 'none'
			]
		);

		$this->add_control(
			'exad_flipbox_back_button_enable',
			[
				'label' => __( 'Show Button', 'plugin-domain' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'exad_flipbox_button_text',
			[
				'label'     => __( 'Button Text', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => [ 'active' => true ],
				'default'   => __( 'Read More', 'exclusive-addons-elementor' ),
				'separator' => 'before',
				'condition' => [
					'exad_flipbox_back_button_enable' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_flipbox_button_link',
			[
				'label'       => __( 'Link', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => ''
     			],
				'show_external' => true,
				 'condition' => [
					'exad_flipbox_back_button_enable' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'exad_section_flipbox_settings',
			[
				'label' => __( 'Flip Settings', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_flipbox_style',
			[
				'label'   => __( 'Flip Direction', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left-to-right',
				'options' => [
					'left-to-right'       => __( 'Left to Right', 'exclusive-addons-elementor' ),
					'right-to-left'       => __( 'Right to Left', 'exclusive-addons-elementor' ),
					'top-to-bottom'       => __( 'Top to Bottom', 'exclusive-addons-elementor' ),
					'bottom-to-top'       => __( 'Bottom to Top', 'exclusive-addons-elementor' ),
					'top-to-bottom-angle' => __( 'Diagonal (Top to Bottom)', 'exclusive-addons-elementor' ),
					'bottom-to-top-angle' => __( 'Diagonal (Bottom to Top)', 'exclusive-addons-elementor' ),
					'fade-in-out'         => __( 'Fade In Out', 'exclusive-addons-elementor' ),
					'three-d-flip'        => __( '3D Rotation', 'exclusive-addons-elementor' ),
					'fade'        		  => __( 'Fade', 'exclusive-addons-elementor' ),
				]
				
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'exad_section_flipbox_container',
			[
				'label' => __( 'Container', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'exad_flipbox_3d_height',
			[
				'label'      => __( 'Height', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px'      => [
						'min' => 0,
						'max' => 1000
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 300
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-inner .exad-flip-box-front,
					{{WRAPPER}} .exad-flip-box .exad-flip-box-inner .exad-flip-box-back' => 'min-height: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flipbox Front)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_front_end_style_section',
			[
				'label' => __( 'Front', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_flipbox_front_container',
			[
				'label'     => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'front_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-inner .exad-flip-box-front'
			]
		);

		$this->add_control(
			'exad_flipbox_front_background_oberlay',
			[
				'label'     => esc_html__( 'Background Overlay', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box-front-overlay' => 'background: {{VALUE}};'
				]		
			]
		);

		$this->add_responsive_control(
			'exad_flipbox_front_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'               => 'exad_flipbox_front_container_border',
				'selector'           => '{{WRAPPER}} .exad-flip-box .exad-flip-box-front',
			  	'fields_options'     => [
                    'border'         => [
                        'default'    => 'solid'
                    ],
                    'width'          => [
                        'default'    => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                 	'color'          => [
                        'default'    => $exad_primary_color
                    ]
                ]
			]
		);

		$this->add_responsive_control(
			'exad_flipbox_front_border_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_flipbox_front_box_shadow',
				'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-front'
			]
		);

		$this->add_responsive_control(
            'exad_flipbox_front_content_alignment',
            [
                'label'          => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
                'type'           => Controls_Manager::CHOOSE,
                'toggle'         => false,
                'options'        => [
                    'left'       => [
                        'title'  => __( 'Left', 'exclusive-addons-elementor' ),
                        'icon'   => 'eicon-h-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'exclusive-addons-elementor' ),
                        'icon'   => 'eicon-h-align-center'
                    ],
                    'right'      => [
                        'title'  => __( 'Right', 'exclusive-addons-elementor' ),
                        'icon'   => 'eicon-h-align-right'
                    ]
                ],
                'default'        => 'center'
            ]
        ); 

		$this->add_control(
			'exad_flipbox_front_icon_style',
			[
				'label'     => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
                    'exad_flipbox_front_icon[value]!' => ''
                ]
			]
		);

		$this->add_responsive_control(
			'exad_flipbox_front_icon_box_height_width',
			[
				'label'       => __( 'Box Size/Image Size', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					]
				],
				'default'     => [
                    'unit'    => 'px',
                    'size'    => 90
                ],
				'selectors'   => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-image' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
                    'exad_flipbox_front_icon[value]!' => ''
                ]
			]
		);

		$this->add_responsive_control(
            'exad_flipbox_front_icon_size',
            [
                'label'        => esc_html__( 'Icon Size', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 10,
                        'max'  => 150,
                        'step' => 2
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 50
                ],
                'selectors'    => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-image i' => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-image svg' => 'height: {{SIZE}}px; width: {{SIZE}}px;'
                ],
                'condition' => [
                    'exad_flipbox_front_icon[value]!' => '',
					'exad_flipbox_front_icon_image' => 'icon'
                ]
            ]
        );

		$this->add_control(
			'exad_flipbox_front_icon_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => $exad_primary_color,
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-image i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-image svg path' => 'fill: {{VALUE}};'
				],
				'condition' => [
                    'exad_flipbox_front_icon[value]!' => ''
                ]				
			]
		);

		$this->add_control(
			'exad_flipbox_front_icon_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-image' => 'background-color: {{VALUE}};'
				],
				'condition' => [
                    'exad_flipbox_front_icon[value]!' => ''
                ]				
			]
		);

		$this->add_control(
			'exad_flipbox_front_icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-inner .exad-flip-box-front .exad-flip-box-front-image'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
                    'exad_flipbox_front_icon[value]!' => ''
                ]
			]
		);

		$this->add_control(
			'exad_flipbox_front_title_heading',
			[
				'label'     => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'exad_flipbox_front_title_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-title' => 'color: {{VALUE}};'
				]
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_flipbox_front_title_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ]
	            ],
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-title'
			]
		);

		$this->add_responsive_control(
            'exad_flipbox_front_title_margin',
            [
				'label'      => __('Margin', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
                    'top'      => '20',
                    'right'    => '0',
                    'bottom'   => '10',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
                    '{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_control(
			'exad_flipbox_content_heading',
			[
				'label'     => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'exad_flipbox_front_content_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#817e7e',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-description' => 'color: {{VALUE}};'
				]
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_flipbox_front_content_typography',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-description'				
			]
		);

		$this->add_responsive_control(
            'exad_flipbox_front_content_margin',
            [
				'label'      => __('Margin', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
                    '{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flipbox Back)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_back_end_style_section',
			[
				'label' => __( 'Back', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_flipbox_back_container_heading',
			[
				'label'     => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'exad_flipbox_back_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-inner .exad-flip-box-back',
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => $exad_primary_color
					]
				]
			]
		);

		$this->add_control(
			'exad_flipbox_back_background_oberlay',
			[
				'label'     => esc_html__( 'Background Overlay', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box-back-overlay' => 'background: {{VALUE}};'
				]		
			]
		);

		$this->add_responsive_control(
			'exad_flipbox_back_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
                    'top'      => '30',
                    'right'    => '20',
                    'bottom'   => '30',
                    'left'     => '20',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'exad_flipbox_back_container_border',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back'
			]
		);

		$this->add_responsive_control(
			'exad_flipbox_back_border_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_flipbox_back_box_shadow',
				'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back'
			]
		);

		$this->add_responsive_control(
            'exad_flipbox_back_content_alignment',
            [
                'label'          => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
                'type'           => Controls_Manager::CHOOSE,
                'toggle'         => false,
                'options'        => [
                    'left'       => [
                        'title'  => __( 'Left', 'exclusive-addons-elementor' ),
                        'icon'   => 'eicon-h-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'exclusive-addons-elementor' ),
                        'icon'   => 'eicon-h-align-center'
                    ],
                    'right'      => [
                        'title'  => __( 'Right', 'exclusive-addons-elementor' ),
                        'icon'   => 'eicon-h-align-right'
                    ]
                ],
                'default'        => 'center'
            ]
        ); 

		$this->add_control(
			'exad_flipbox_back_icon_style',
			[
				'label'     => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
                    'exad_flipbox_back_icon[value]!' => ''
                ] 
			]
		);

		$this->add_responsive_control(
			'exad_flipbox_back_icon_box_height_width',
			[
				'label'       => __( 'Box Size/Image Size', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 200
					]
				],
				'default'     => [
                    'unit'    => 'px',
                    'size'    => 90
                ],
				'selectors'   => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-image' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
                    'exad_flipbox_back_icon[value]!' => ''
                ]
			]
		);

		$this->add_responsive_control(
            'exad_flipbox_back_icon_size',
            [
                'label'        => esc_html__( 'Icon Size', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 10,
                        'max'  => 150,
                        'step' => 2
                    ]
                ],
                'selectors'    => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back i' => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back svg' => 'height: {{SIZE}}px; width: {{SIZE}}px;'
                ],
                'condition'    => [
                    'exad_flipbox_back_icon[value]!' => '',
                    'exad_flipbox_back_icon_image' => 'icon'
                ]
            ]
        );

		$this->add_control(
			'exad_flipbox_back_icon_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back svg path' => 'fill: {{VALUE}};'
				],
				'condition' => [
                    'exad_flipbox_back_icon[value]!' => ''
                ]				
			]
		);

		$this->add_control(
			'exad_flipbox_back_icon_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-image' => 'background-color: {{VALUE}};'
				],
				'condition' => [
                    'exad_flipbox_back_icon[value]!' => ''
                ]
				
			]
		);

		$this->add_control(
			'exad_flipbox_back_icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-image'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
                    'exad_flipbox_back_icon[value]!' => ''
                ]
			]
		);

		$this->add_control(
			'exad_flipbox_back_title_heading',
			[
				'label'     => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);		

		$this->add_control(
			'exad_flipbox_back_title_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-title' => 'color: {{VALUE}};'
				]
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_flipbox_back_title_typography',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-title'
			]
		);

		$this->add_responsive_control(
            'exad_flipbox_back_title_margin',
            [
				'label'      => __('Margin', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
                    'top'      => '6',
                    'right'    => '0',
                    'bottom'   => '20',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
                    '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_control(
			'exad_flipbox_back_details_heading',
			[
				'label'     => esc_html__( 'Details', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'exad_flipbox_back_details_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-description' => 'color: {{VALUE}};'
				]				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_flipbox_back_details_typography',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-description'
				
			]
		);

		$this->add_responsive_control(
            'exad_flipbox_back_details_margin',
            [
				'label'      => __('Margin', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
                    'top'      => '6',
                    'right'    => '0',
                    'bottom'   => '20',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
                    '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_control(
			'exad_flipbox_back_button',
			[
				'label'     => esc_html__( 'Button', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_flipbox_button_typography',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action',
			 	'fields_options'  => [
		            'font_weight' => [
		                'default' => '400'
		            ]
	            ]
			]
		);

		$this->add_control(
			'exad_flipbox_button_padding',
			[
                'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'      => '6',
                    'right'    => '20',
                    'bottom'   => '6',
                    'left'     => '20',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

		$this->add_control(
			'exad_flipbox_button_margin',
			[
                'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
          'exad_flipbox_button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top'    => '4',
                    'right'  => '4',
                    'bottom' => '4',
                    'left'   => '4'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'exad_flipbox_button_box_shadow',
                'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
                'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action'
            ]
        );

		$this->start_controls_tabs( 'exad_cta_button_tabs' );

			// Normal State Tab
			$this->start_controls_tab( 'exad_flipbox_btn_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_flipbox_btn_normal_text_color',
					[
						'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'exad_flipbox_btn_normal_bg_color',
					[
						'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'            => 'exad_flipbox_btn_normal_border',
                        'fields_options'  => [
		                    'border'      => [
		                        'default' => 'solid'
		                    ],
		                    'width'          => [
		                        'default'    => [
		                            'top'    => '1',
		                            'right'  => '1',
		                            'bottom' => '1',
		                            'left'   => '1'
		                        ]
		                    ],
		                    'color'       => [
		                        'default' => '#ffffff'
		                    ]
		                ],
                        'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action'
                    ]
                );
			
			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'exad_flipbox_btn_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_flipbox_btn_hover_text_color',
					[
						'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#000000',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'exad_flipbox_btn_hover_bg_color',
					[
						'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action:hover' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'exad_flipbox_btn_hover_border',
                        'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action:hover'
                    ]
                );

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {

		$settings    = $this->get_settings_for_display();
		$front_title = $settings['exad_flipbox_front_title'];
		$front_desc  = $settings['exad_flipbox_front_description'];
		$back_title  = $settings['exad_flipbox_back_title'];
		$back_desc   = $settings['exad_flipbox_back_description'];
	   
	    $this->add_render_attribute(
		   'exad_flipbox_attribute', 
		    [
			   'class' => [ 
			   		'exad-flip-box-inner',
			   		esc_attr( $settings['exad_flipbox_style'] ) 
			   	]
		    ]   
	    );

	    $this->add_render_attribute( 'exad_flipbox_front_title', 'class', 'exad-flip-box-front-title' );
		$this->add_inline_editing_attributes( 'exad_flipbox_front_title', 'none' );

	    $this->add_render_attribute( 'exad_flipbox_front_description', 'class', 'exad-flip-box-front-description' );
		$this->add_inline_editing_attributes( 'exad_flipbox_front_description' );


	    $this->add_render_attribute( 'exad_flipbox_back_title', 'class', 'exad-flip-box-back-title' );
		$this->add_inline_editing_attributes( 'exad_flipbox_back_title', 'none' );

	    $this->add_render_attribute( 'exad_flipbox_back_description', 'class', 'exad-flip-box-back-description' );
		$this->add_inline_editing_attributes( 'exad_flipbox_back_description' );

	    $this->add_render_attribute( 'exad_flipbox_button_link', 'class', 'exad-flip-box-back-action' );
		$this->add_inline_editing_attributes( 'exad_flipbox_button_text', 'none' );

		if( $settings['exad_flipbox_button_link']['url'] ) {
            $this->add_render_attribute( 'exad_flipbox_button_link', 'href', esc_url( $settings['exad_flipbox_button_link']['url'] ) );
        }
        if( $settings['exad_flipbox_button_link']['is_external'] ) {
            $this->add_render_attribute( 'exad_flipbox_button_link', 'target', '_blank' );
        }
        if( $settings['exad_flipbox_button_link']['nofollow'] ) {
            $this->add_render_attribute( 'exad_flipbox_button_link', 'rel', 'nofollow' );
        }
		?>

		<div class="exad-flip-box">
	      	<div <?php echo $this->get_render_attribute_string( 'exad_flipbox_attribute' ); ?>>
	        	<div class="exad-flip-box-front <?php echo esc_attr( $settings['exad_flipbox_front_content_alignment'] ); ?>">
					<div class="exad-flip-box-front-overlay"></div>
	        		<div class="exad-flip-box-front-content">
					<?php do_action('exad_flipbox_frontend_content_wrapper_before');

		        		if ( 'icon' === $settings['exad_flipbox_front_icon_image'] && !empty( $settings['exad_flipbox_front_icon']['value'] ) ) { ?>
			          		<div class="exad-flip-box-front-image">
							  <?php Icons_Manager::render_icon( $settings['exad_flipbox_front_icon'] ); ?>
			        		</div>
						<?php }
		        		if ( 'img' === $settings['exad_flipbox_front_icon_image'] ) { ?>
			          		<div class="exad-flip-box-front-image">
							  	<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'exad_flipbox_front_image_thumbnail', 'exad_flipbox_front_image' ); ?>
			        		</div>
						<?php }
				        $front_title ? printf('<h2 '.$this->get_render_attribute_string( 'exad_flipbox_front_title' ).'>%s</h2>', Helper::exad_wp_kses( $front_title ) ) : '';
				        $front_desc ? printf('<div '.$this->get_render_attribute_string( 'exad_flipbox_front_description' ).'>%s</div>', wp_kses_post( $front_desc ) ) : '';

				        do_action('exad_flipbox_frontend_content_wrapper_after'); ?>
	        		</div>
	        	</div>

		        <div class="exad-flip-box-back <?php echo esc_attr( $settings['exad_flipbox_back_content_alignment'] ); ?>">
					<div class="exad-flip-box-back-overlay"></div>
		        	<div class="exad-flip-box-back-content">
			        <?php 
						do_action('exad_flipbox_backend_content_wrapper_before');

			        	if ( 'icon' === $settings['exad_flipbox_back_icon_image'] && !empty( $settings['exad_flipbox_back_icon']['value'] ) ) { ?>
			        		<div class="exad-flip-box-back-image">
								<?php Icons_Manager::render_icon( $settings['exad_flipbox_back_icon'] ); ?>
		          			</div>
						<?php 	  
			        	}

						if ( 'img' === $settings['exad_flipbox_back_icon_image'] ) { ?>
							<div class="exad-flip-box-back-image">
								<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'exad_flipbox_back_image_thumbnail', 'exad_flipbox_back_image' ); ?>
							</div>
						<?php }

				        $back_title ? printf('<h2 '.$this->get_render_attribute_string( 'exad_flipbox_back_title' ).'>%s</h2>', Helper::exad_wp_kses( $back_title) ) : '';
				        $back_desc ? printf('<div '.$this->get_render_attribute_string( 'exad_flipbox_back_description' ).'>%s</div>', wp_kses_post( $back_desc ) ) : '';

				        do_action('exad_flipbox_backend_content_wrapper_after');

						if ( $settings['exad_flipbox_back_button_enable'] === 'yes' ) { ?>
							<a <?php echo $this->get_render_attribute_string( 'exad_flipbox_button_link' ); ?>>
								<span <?php echo $this->get_render_attribute_string( 'exad_flipbox_button_text' ); ?>><?php echo esc_html( $settings['exad_flipbox_button_text'] ); ?></span>
							</a>
						<?php } ?>
			        </div>
		        </div>
	      	</div>
	    </div>
	<?php 	
	}

	/**
     * Render flipbox widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
	protected function content_template() {
		?>
		<#
			view.addRenderAttribute( 'exad_flipbox_attribute', {
				'class': [ 
					'exad-flip-box-inner', 
					settings.exad_flipbox_style
				]
			} );

			var iconHTML     = elementor.helpers.renderIcon( view, settings.exad_flipbox_front_icon, { 'aria-hidden': true }, 'i' , 'object' );
			var backIconHTML = elementor.helpers.renderIcon( view, settings.exad_flipbox_back_icon, { 'aria-hidden': true }, 'i' , 'object' );

			view.addRenderAttribute( 'exad_flipbox_front_title', 'class', 'exad-flip-box-front-title' );
			view.addInlineEditingAttributes( 'exad_flipbox_front_title', 'none' );

			view.addRenderAttribute( 'exad_flipbox_front_description', 'class', 'exad-flip-box-front-description' );
			view.addInlineEditingAttributes( 'exad_flipbox_front_description' );

			view.addRenderAttribute( 'exad_flipbox_back_title', 'class', 'exad-flip-box-back-title' );
			view.addInlineEditingAttributes( 'exad_flipbox_back_title', 'none' );

			view.addRenderAttribute( 'exad_flipbox_back_description', 'class', 'exad-flip-box-back-description' );
			view.addInlineEditingAttributes( 'exad_flipbox_back_description' );

			view.addRenderAttribute( 'exad_flipbox_button_link', 'class', 'exad-flip-box-back-action' );
			view.addInlineEditingAttributes( 'exad_flipbox_button_text', 'none' );

			var target = settings.exad_flipbox_button_link.is_external ? ' target="_blank"' : '';
            var nofollow = settings.exad_flipbox_button_link.nofollow ? ' rel="nofollow"' : '';

			var front_image = {
				id: settings.exad_flipbox_front_image.id,
				url: settings.exad_flipbox_front_image.url,
				size: settings.exad_flipbox_front_image_thumbnail_size,
				dimension: settings.exad_flipbox_front_image_thumbnail_custom_dimension,
				model: view.getEditModel()
			};
			var front_image_url = elementor.imagesManager.getImageUrl( front_image );

			var back_image = {
				id: settings.exad_flipbox_back_image.id,
				url: settings.exad_flipbox_back_image.url,
				size: settings.exad_flipbox_back_image_thumbnail_size,
				dimension: settings.exad_flipbox_back_image_thumbnail_custom_dimension,
				model: view.getEditModel()
			};
			var back_image_url = elementor.imagesManager.getImageUrl( back_image );

		#>
		<div class="exad-flip-box">
			<div {{{ view.getRenderAttributeString( 'exad_flipbox_attribute' ) }}}>
				<div class="exad-flip-box-front {{{ settings.exad_flipbox_front_content_alignment }}}">
					<div class="exad-flip-box-front-overlay"></div>
					<div class="exad-flip-box-front-content">
						<# if ( 'icon' === settings.exad_flipbox_front_icon_image && iconHTML.value ) { #>
							<div class="exad-flip-box-front-image">
								{{{ iconHTML.value }}}
							</div>
						<# } #>

						<# if ( 'img' === settings.exad_flipbox_front_icon_image ) { #>
			          		<div class="exad-flip-box-front-image">
							  	<img src="{{{ front_image_url }}}" />
			        		</div>
						<# } #>

						<# if ( settings.exad_flipbox_front_title ) { #>
				        	<h2 {{{ view.getRenderAttributeString( 'exad_flipbox_front_title' ) }}}>
				        		{{{ settings.exad_flipbox_front_title }}}
				        	</h2>
				    	<# } #>

						<# if ( settings.exad_flipbox_front_description ) { #>
				        	<div {{{ view.getRenderAttributeString( 'exad_flipbox_front_description' ) }}}>
				        		{{{ settings.exad_flipbox_front_description }}}
				        	</div>
				    	<# } #>
					</div>
				</div>

				<div class="exad-flip-box-back {{{ settings.exad_flipbox_back_content_alignment }}}">
					<div class="exad-flip-box-back-overlay"></div>
					<div class="exad-flip-box-back-content">
						<# if ( 'icon' === settings.exad_flipbox_back_icon_image && backIconHTML.value ) { #>
							<div class="exad-flip-box-back-image">
								{{{ backIconHTML.value }}}
							</div>
						<# } #>

						<# if ( 'img' === settings.exad_flipbox_back_icon_image ) { #>
			          		<div class="exad-flip-box-back-image">
							  	<img src="{{{ back_image_url }}}" />
			        		</div>
						<# } #>

						<# if ( settings.exad_flipbox_back_title ) { #>
				        	<h2 {{{ view.getRenderAttributeString( 'exad_flipbox_back_title' ) }}}>
				        		{{{ settings.exad_flipbox_back_title }}}
				        	</h2>
				    	<# } #>

						<# if ( settings.exad_flipbox_back_description ) { #>
				        	<div {{{ view.getRenderAttributeString( 'exad_flipbox_back_description' ) }}}>
				        		{{{ settings.exad_flipbox_back_description }}}
				        	</div>
				    	<# } #>

						<# if ( settings.exad_flipbox_back_button_enable === 'yes' ) { #>
							<a href="{{{ settings.exad_flipbox_button_link.url }}}" {{{ view.getRenderAttributeString( 'exad_flipbox_button_link' ) }}}{{{ target }}}{{{ nofollow }}}>
								<span {{{ view.getRenderAttributeString( 'exad_flipbox_button_text' ) }}}>
									{{{ settings.exad_flipbox_button_text }}}
								</span>
							</a>
						<# } #>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}