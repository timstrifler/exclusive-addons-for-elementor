<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Control_Media;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use \ExclusiveAddons\Elementor\Image_Mask_SVG_Control;
use \ExclusiveAddons\Elementor\Helper;

class Card extends Widget_Base {
	
	public function get_name() {
		return 'exad-exclusive-card';
	}

	public function get_title() {
		return esc_html__( 'Card', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad exad-logo exad-card';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
        return [ 'exclusive', 'info', 'content', 'block', 'box' ];
    }

	protected function register_controls() {
		
		/**
		* Card Content Section
		*/
		$this->start_controls_section(
			'exad_card_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
			]
		);
		
		$this->add_control(
			'exad_card_image',
			[
				'label'   => __( 'Image', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail', 
				'default'   => 'full',
				'condition' => [
					'exad_card_image[url]!' => ''
				]
			]
		);

		$this->add_control(
			'exad_card_enable_image_mask',
			[
				'label' => __( 'Enable Image Mask', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'exad_card_mask_shape_mask_shape',
			[
				'label'                => __( 'Mask Shape', 'exclusive-addons-elementor' ),
				'type'                 => Image_Mask_SVG_Control::SVGSELECTOR,
				'options'              => Helper::exad_masking_shape_list( 'list' ),
				'default'              => 'shape-1',
				'toggle'               => false,
				'label_block'          => true,
                'selectors_dictionary' => Helper::exad_masking_shape_list( 'url' ),
				'selectors'            => [
                    '{{WRAPPER}} .exad-card-thumb img' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});'
				],
				'condition' 		   => [
					'exad_card_enable_image_mask' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'exad_card_mask_shape_position',
			[
				'label'       => __( 'Position', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'center',
				'label_block' => true,
				'options'     => [
					'top'     => __( 'Top', 'exclusive-addons-elementor' ),
					'center'  => __( 'Center', 'exclusive-addons-elementor' ),
					'left'    => __( 'Left', 'exclusive-addons-elementor' ),
					'right'   => __( 'Right', 'exclusive-addons-elementor' ),
					'bottom'  => __( 'Bottom', 'exclusive-addons-elementor' ),
					'custom'  => __( 'Custom', 'exclusive-addons-elementor' )
                ],
                'selectors'   => [
					'{{WRAPPER}} .exad-card-thumb img' => '-webkit-mask-position: {{VALUE}};'
				],
				'condition' 		   => [
					'exad_card_enable_image_mask' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'exad_card_mask_shape_position_x_offset',
			[
				'label'       => __( 'X Offset', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					],
					'%'       => [
						'min' => 0,
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-card-thumb img' => '-webkit-mask-position-y: {{SIZE}}{{UNIT}};'
                ],
                'condition'   => [
					'exad_card_enable_image_mask' => 'yes',
                    'exad_card_mask_shape_position' => 'custom'
				]
			]
		);

		$this->add_control(
			'exad_card_mask_shape_position_y_offset',
			[
				'label'       => __( 'Y Offset', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					],
					'%'       => [
						'min' => 0,
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-card-thumb img' => '-webkit-mask-position-x: {{SIZE}}{{UNIT}};'
                ],
                'condition'   => [
					'exad_card_enable_image_mask' => 'yes',
                    'exad_card_mask_shape_position' => 'custom'
				]
			]
		);
        
        $this->add_control(
			'exad_card_mask_shape_size',
			[
				'label'       => __( 'Size', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'auto',
				'label_block' => true,
				'options'     => [
					'auto'    => __( 'Auto', 'exclusive-addons-elementor' ),
					'contain' => __( 'Contain', 'exclusive-addons-elementor' ),
					'cover'   => __( 'Cover', 'exclusive-addons-elementor' ),
					'custom'  => __( 'Custom', 'exclusive-addons-elementor' )
                ],
                'selectors'   => [
					'{{WRAPPER}} .exad-card-thumb img' => '-webkit-mask-size: {{VALUE}};'
				],
				'condition' 		   => [
					'exad_card_enable_image_mask' => 'yes'
				]
			]
        );

        $this->add_control(
			'exad_card_mask_shape_custome_size',
			[
				'label'       => __( 'Mask Size', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 600
					],
					'%'       => [
						'min' => 0,
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-card-thumb img' => '-webkit-mask-size: {{SIZE}}{{UNIT}};'
                ],
                'condition'   => [
					'exad_card_enable_image_mask' => 'yes',
                    'exad_card_mask_shape_size' => 'custom'
				]
			]
		);

        $this->add_control(
			'exad_card_mask_shape_repeat',
			[
				'label'         => __( 'Repeat', 'exclusive-addons-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'no-repeat',
				'label_block'   => true,
				'options'       => [
					'no-repeat' => __( 'No repeat', 'exclusive-addons-elementor' ),
					'repeat'    => __( 'Repeat', 'exclusive-addons-elementor' )
                ],
                'selectors'     => [
					'{{WRAPPER}} .exad-card-thumb img' => '-webkit-mask-repeat: {{VALUE}};'
				],
				'condition' 	=> [
					'exad_card_enable_image_mask' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_card_badge_switcher',
			[
				'label' => __( 'Enable Badge', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'exad_card_badge',
			[
				'label'       => esc_html__( 'Badge Text', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'separator'   => 'before',
				'default'     => esc_html__( 'Card Badge', 'exclusive-addons-elementor' ),
				'condition'   => [
					'exad_card_badge_switcher' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'exad_card_title',
			[
				'label'       => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'separator'   => 'before',
				'default'     => esc_html__( 'Card Title', 'exclusive-addons-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
            'exad_card_title_html_tag',
            [
                'label'   => __('Title HTML Tag', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SELECT,
				'separator' => 'after',
                'options' => Helper::exad_title_tags(),
                'default' => 'span',
            ]
		);

		$this->add_control(
			'exad_card_title_link',
			[
				'label'       => __( 'Title URL', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true
				]
			]
		);
		
		$this->add_control(
			'exad_card_tag',
			[
				'label'       => esc_html__( 'Tag', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Card Tag', 'exclusive-addons-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);
		
		$this->add_control(
			'exad_card_description',
			[
				'label'   => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Basic description about the Card', 'exclusive-addons-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'exad_card_action_button_content',
			[
				'label'     => __( 'Action Button ', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'exad_card_action_text',
			[
				'label'       => esc_html__( 'Text', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Details', 'exclusive-addons-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'exad_card_action_link',
			[
				'label'       => __( 'URL', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => true
				]
			]
		);

		$this->add_control(
			'exad_card_action_link_icon',
			[
				'label'       => __( 'Icon', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'condition'   => [
					'exad_card_action_text!' => ''
				]
			]
		);

		$this->add_control(
			'exad_card_action_link_icon_position',
			[
				'label'     => __( 'Icon Position', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'icon_pos_left'  => [
						'title'      => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'       => 'eicon-angle-left'
					],
					'icon_pos_right' => [
						'title'      => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'       => 'eicon-angle-right'
					]
				],
				'default'   => 'icon_pos_right',
				'toggle'    => false,
				'condition' => [
                    'exad_card_action_link_icon[value]!' => '',
                    'exad_card_action_text!' => ''
                ]
			]
		);

		$this->end_controls_section();

		/**
		* Card Layout Section
		*/
		$this->start_controls_section(
			'exad_card_layout',
			[
				'label' => esc_html__( 'Layout', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_card_layout_type',
			[
				'label'   => __( 'Layout', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'       => __( 'Default', 'exclusive-addons-elementor' ),
					'text_on_image' => __( 'Text On Image', 'exclusive-addons-elementor' )
				]
			]
		);

		$this->end_controls_section();

		/*
		* Card Styling Section
		*/
		$this->start_controls_section(
			'exad_section_card_styles_preset',
			[
				'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'exad_card_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-card'
			]
		);

		$this->add_responsive_control(
			'exad_card_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'               => 'exad_card_border',
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
                        'default'    => '#e5e5e5'
                    ]
                ],
				'selector'           => '{{WRAPPER}} .exad-card'
			]
		);

		$this->add_responsive_control(
			'exad_card_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'exad_card_layout_type' => 'default'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_card_box_shadow',
				'selector' => '{{WRAPPER}} .exad-card'
			]
		);

		$this->end_controls_section();

		/*
		* Card Image Styling Section
		*/
		$this->start_controls_section(
			'exad_section_card_styles_image',
			[
				'label'     => esc_html__( 'Image', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_card_image[url]!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'exad_section_card_image_height',
			[
				'label'       => __( 'Height', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-card-thumb' => 'height: {{SIZE}}{{UNIT}};'
				],
				'condition'   => [
					'exad_card_layout_type' => 'default'
				]
			]
		);

		$this->add_responsive_control(
			'exad_section_card_image_width',
			[
				'label'       => __( 'Width', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-card-thumb' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition'   => [
					'exad_card_layout_type' => 'default'
				]
			]
		);

		$this->add_responsive_control(
			'exad_card_image_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-card-thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'exad_card_layout_type' => 'default'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'exad_card_image_border',
				'selector'  => '{{WRAPPER}} .exad-card-thumb',
				'condition' => [
					'exad_card_layout_type' => 'default'
				]
			]
		);
		
		$this->add_responsive_control(
			'exad_card_image_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-card-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'exad_card_layout_type' => 'default'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'exad_card_image_box_shadow',
				'selector'  => '{{WRAPPER}} .exad-card-thumb',
				'condition' => [
					'exad_card_layout_type' => 'default'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'exad_card_image_filter',
				'selector' => '{{WRAPPER}} .exad-card-thumb img',
			]
		);

		$this->add_control(
			'exad_card_image_animation_heading',
			[
				'label'     => __( 'Animation', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'exad_card_image_zoom_animation',
			[
				'label'        => __( 'Zoom Animation', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'OFF', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->end_controls_section();

		/*
		* Card Badge Style Section
		*/
		$this->start_controls_section(
			'exad_section_card_badge_style',
			[
				'label' => esc_html__( 'Badge', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$badge_align = is_rtl() ? 'right' : 'left';

		$this->add_responsive_control(
			'exad_section_card_badge_left_offset',
			[
				'label'       => __( 'X-Offset', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					],
					'%'       => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'      => [
                    'unit'     => '%',
                    'size'     => 0
                ],
				'selectors'    => [
					'{{WRAPPER}} .exad-card-badge' => $badge_align.': {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_section_card_badge_top_offset',
			[
				'label'       => __( 'Y-Offset', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					],
					'%'       => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'     => [
                    'unit'    => '%',
                    'size'    => 0
                ],
				'selectors'   => [
					'{{WRAPPER}} .exad-card-badge' => 'top: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'exad_section_card_badge_background',
			[
				'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-card-badge' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'exad_section_card_badge_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .exad-card-badge' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_section_card_badge_typography',
				'selector' => '{{WRAPPER}} .exad-card-badge'
			]
		);

		$this->add_responsive_control(
			'exad_card_badge_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '10',
					'right'  => '15',
					'bottom' => '10',
					'left'   => '15',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-card-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'exad_card_badge_border',
				'selector' => '{{WRAPPER}} .exad-card-badge'
			]
		);

		$this->add_responsive_control(
			'exad_card_badge_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '30',
					'right'  => '30',
					'bottom' => '30',
					'left'   => '30',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-card-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_card_badge_box_shadow',
				'selector' => '{{WRAPPER}} .exad-card-badge'
			]
		);

		$this->end_controls_section();

		/*
		* Card content Styling Section
		*/
		$this->start_controls_section(
			'exad_section_card_styles_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$text_align = is_rtl() ? 'right' : 'left';

		$this->add_control(
			'exad_card_content_alignment',
			[
				'label'         => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left'      => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => __( 'center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default'       => $text_align,
				'toggle'        => false				
			]
		);
		
		$this->add_responsive_control(
			'exad_card_content_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '30',
					'right'  => '30',
					'bottom' => '30',
					'left'   => '30',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'exad_card_content_border',
				'selector' => '{{WRAPPER}} .exad-card-body'
			]
		);

		$this->add_responsive_control(
			'exad_card_content_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-card-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();


		/*
		* Card Content Styling Section
		*/
		$this->start_controls_section(
			'exad_section_card_styles_title',
			[
				'label'     => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_card_title!' => ''
				]
			]
		);
		$this->add_control(
			'exad_title_color',
			[
				'label'     => __('Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .exad-card-body .exad-card-title' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'card_title_typography',
				'selector' => '{{WRAPPER}} .exad-card-body .exad-card-title'
			]
		);

		$this->add_responsive_control(
			'exad_card_title_margin',
			[
				'label'        => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '15',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-card-body .exad-card-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Exad Card tag Style
		 */
		$this->start_controls_section(
			'exad_section_card_styles_tag',
			[
				'label'     => esc_html__( 'Tag', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_card_tag!' => ''
				]
			]
		);

		$this->add_control(
			'exad_tag_color',
			[
				'label'     => __('Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .exad-card-body .exad-card-tag' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'card_tag_typography',
				'selector' => '{{WRAPPER}} .exad-card-body .exad-card-tag'
			]
		);

		$this->add_responsive_control(
			'exad_card_tag_margin',
			[
				'label'        => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-card-body .exad-card-tag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		// description style
		$this->start_controls_section(
			'exad_section_card_styles_description',
			[
				'label'     => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_card_description!' => ''
				]
			]
		);
		$this->add_control(
			'exad_description_color',
			[
				'label'     => __('Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .exad-card-body .exad-card-description' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'card_description_typography',
				'selector' => '{{WRAPPER}} .exad-card-body .exad-card-description'
			]
		);

		$this->add_responsive_control(
			'exad_card_description_margin',
			[
				'label'        => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-card-body .exad-card-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Exad Card Button Style 
		 */

		$this->start_controls_section(
			'exad_section_card_styles_button',
			[
				'label'     => esc_html__( 'Button', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_card_action_text!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'exad_card_button_icon_spacing',
			[
				'label'       => __( 'Icon Spacing', 'exclusive-addons-elementor' ),
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
					'{{WRAPPER}} .exad-card-body .exad-card-action .icon_pos_right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-card-body .exad-card-action .icon_pos_left'  => 'margin-right: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_card_button_typography',
				'selector' => '{{WRAPPER}} .exad-card-body .exad-card-action'
			]
		);

		$this->add_responsive_control(
			'exad_card_button_padding',
			[
				'label'        => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px' ],
				'default'      => [
					'top'      => '15',
					'right'    => '35',
					'bottom'   => '15',
					'left'     => '35',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-card-body .exad-card-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_card_button_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-card-body .exad-card-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_card_button_offset',
			[
				'label'       => __( 'Offset', 'exclusive-addons-elementor' ),
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
					'size'    => 0
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-card-body .exad-card-action' => 'margin-bottom: -{{SIZE}}{{UNIT}};'
				],
				'condition'   => [
					'exad_card_layout_type' => 'default'
				]
			]
		);

		$this->start_controls_tabs( 'exad_card_button_tabs' );

			$this->start_controls_tab( 'exad_card_button_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_card_button_normal_color',
					[
						'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222222',
						'selectors' => [
							'{{WRAPPER}} .exad-card-body .exad-card-action' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'exad_card_button_normal_bg',
					[
						'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .exad-card-body .exad-card-action' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'               => 'exad_card_button_normal_border',
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
		                        'default'    => '#222222'
		                    ]
		                ],
						'selector'           => '{{WRAPPER}} .exad-card-body .exad-card-action'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'exad_card_button_normal_box_shadow',
						'selector' => '{{WRAPPER}} .exad-card-body .exad-card-action'
					]
				);
		
			$this->end_controls_tab();

			$this->start_controls_tab( 'exad_card_button_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_card_button_hover_color',
					[
						'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .exad-card-body .exad-card-action:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'exad_card_button_hover_bg',
					[
						'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222222',
						'selectors' => [
							'{{WRAPPER}} .exad-card-body .exad-card-action:hover' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'exad_card_button_hover_border',
						'selector' => '{{WRAPPER}} .exad-card-body .exad-card-action:hover'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'exad_card_button_hover_box_shadow',
						'selector' => '{{WRAPPER}} .exad-card-body .exad-card-action:hover'
					]
				);

			$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings           = $this->get_settings_for_display();

		$this->add_render_attribute( 
			'exad_card', 
			[ 
				'class' => [ 
					'exad-card', 
					esc_attr( $settings['exad_card_content_alignment'] ), 
					esc_attr( $settings['exad_card_layout_type'] ), 
					esc_attr( $settings['exad_card_image_zoom_animation'] )
				]
			]
		);

		$this->add_inline_editing_attributes( 'exad_card_title', 'basic' );

		$this->add_render_attribute( 'exad_card_tag', 'class', 'exad-card-tag' );
		$this->add_inline_editing_attributes( 'exad_card_tag', 'basic' );

		$this->add_render_attribute( 'exad_card_description', 'class', 'exad-card-description' );
		$this->add_inline_editing_attributes( 'exad_card_description', 'basic' );

		$this->add_render_attribute( 'exad_card_title_link', 'class', 'exad-card-title' );
		$this->add_inline_editing_attributes( 'exad_card_action_text', 'none' );

		if( $settings['exad_card_title_link']['url'] ) {
            $this->add_render_attribute( 'exad_card_title_link', 'href', esc_url( $settings['exad_card_title_link']['url'] ) );
	        if( $settings['exad_card_title_link']['is_external'] ) {
	            $this->add_render_attribute( 'exad_card_title_link', 'target', '_blank' );
	        }
	        if( $settings['exad_card_title_link']['nofollow'] ) {
	            $this->add_render_attribute( 'exad_card_title_link', 'rel', 'nofollow' );
	        }
        }

		$this->add_render_attribute( 'exad_card_action_link', 'class', 'exad-card-action' );
		if( $settings['exad_card_action_link']['url'] ) {
            $this->add_render_attribute( 'exad_card_action_link', 'href', esc_url( $settings['exad_card_action_link']['url'] ) );
	        if( $settings['exad_card_action_link']['is_external'] ) {
	            $this->add_render_attribute( 'exad_card_action_link', 'target', '_blank' );
	        }
	        if( $settings['exad_card_action_link']['nofollow'] ) {
	            $this->add_render_attribute( 'exad_card_action_link', 'rel', 'nofollow' );
	        }
        }
		?>

		<div <?php echo $this->get_render_attribute_string( 'exad_card' ); ?>>
			<?php if ( $settings['exad_card_image']['url'] || $settings['exad_card_image']['id'] ) : ?>
	        	<div class="exad-card-thumb">
					<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'exad_card_image' ); ?>
				</div>
			<?php	
			endif;

			if( $settings['exad_card_badge_switcher'] === 'yes' ) : ?>
				<div class="exad-card-badge">
					<?php echo $settings['exad_card_badge']; ?>
				</div>
				<?php
			endif;
			?>

          	<div class="exad-card-body">
			  	<?php if( $settings['exad_card_title'] ) { ?>
	          		<a <?php echo $this->get_render_attribute_string( 'exad_card_title_link' ); ?>>
	            		<<?php echo Utils::validate_html_tag( $settings['exad_card_title_html_tag'] );?> <?php echo $this->get_render_attribute_string( 'exad_card_title' ); ?>><?php echo Helper::exad_wp_kses( $settings['exad_card_title'] ); ?>
						</<?php echo Utils::validate_html_tag( $settings['exad_card_title_html_tag'] );?>>
	        		</a>
					<?php	          			
          		}

        		$settings['exad_card_tag'] ? printf( '<p '.$this->get_render_attribute_string( 'exad_card_tag' ).'>%s</p>', Helper::exad_wp_kses( $settings['exad_card_tag'] ) ) : '';

        		$settings['exad_card_description'] ? printf( '<div '.$this->get_render_attribute_string( 'exad_card_description' ).'>%s</div>', wp_kses_post( $settings['exad_card_description'] ) ) : '';

        		if ( !empty( $settings['exad_card_action_text'] ) ) : ?>
					<a <?php echo $this->get_render_attribute_string( 'exad_card_action_link' ); ?>>
						<?php if( 'icon_pos_left' === $settings['exad_card_action_link_icon_position'] &&  !empty( $settings['exad_card_action_link_icon']['value'] ) ) { ?>
							<span class="<?php echo esc_attr( $settings['exad_card_action_link_icon_position'] ); ?>">
								<?php Icons_Manager::render_icon( $settings['exad_card_action_link_icon'] ); ?>
							</span>
						<?php	
						}
						?>

						<span <?php echo $this->get_render_attribute_string( 'exad_card_action_text' ); ?>>
							<?php echo esc_html( $settings['exad_card_action_text'] ); ?>
						</span>

						<?php
						if( 'icon_pos_right' === $settings['exad_card_action_link_icon_position'] &&  !empty( $settings['exad_card_action_link_icon']['value'] ) ) { ?>
							<span class="<?php echo esc_attr( $settings['exad_card_action_link_icon_position'] ); ?>">
								<?php Icons_Manager::render_icon( $settings['exad_card_action_link_icon'] ); ?>
							</span>
						<?php } ?>
	            	</a>
				<?php endif; ?>
          	</div>
        </div>
	<?php	
	}

	/**
     * Render card widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
	protected function content_template() {
		?>
		<#
			view.addRenderAttribute( 'exad_card', {
				'class': [ 
					'exad-card', 
					settings.exad_card_content_alignment,
					settings.exad_card_layout_type,
					settings.exad_card_image_zoom_animation
				]
			} );

			if ( settings.exad_card_image.url || settings.exad_card_image.id ) {
				var image = {
					id: settings.exad_card_image.id,
					url: settings.exad_card_image.url,
					size: settings.thumbnail_size,
					dimension: settings.thumbnail_custom_dimension,
					class: 'exad-card-img',
					model: view.getEditModel()
				};

				var image_url = elementor.imagesManager.getImageUrl( image );
			}

			view.addRenderAttribute( 'exad_card_title_link', 'class', 'exad-card-title' );
			view.addInlineEditingAttributes( 'exad_card_title', 'basic' );

			view.addRenderAttribute( 'exad_card_tag', 'class', 'exad-card-tag' );
			view.addInlineEditingAttributes( 'exad_card_tag', 'basic' );

			view.addRenderAttribute( 'exad_card_description', 'class', 'exad-card-description' );
			view.addInlineEditingAttributes( 'exad_card_description', 'basic' );

			view.addRenderAttribute( 'exad_card_action_link', 'class', 'exad-card-action' );
			view.addInlineEditingAttributes( 'exad_card_action_text', 'none' );

			var target = settings.exad_card_action_link.is_external ? ' target="_blank"' : '';
            var nofollow = settings.exad_card_action_link.nofollow ? ' rel="nofollow"' : '';

			var iconHTML = elementor.helpers.renderIcon( view, settings.exad_card_action_link_icon, { 'aria-hidden': true }, 'i' , 'object' );

			var titleHTMLTag = elementor.helpers.validateHTMLTag( settings.exad_card_title_html_tag );
		#>
		<div {{{ view.getRenderAttributeString( 'exad_card' ) }}}>
			<# if ( image_url ) { #>
		    	<div class="exad-card-thumb">
					<img src="{{{ image_url }}}">
				</div>
			<# } #>

			<# if( settings.exad_card_badge_switcher === 'yes' ) { #>
				<div class="exad-card-badge">
					{{{ settings.exad_card_badge }}}
				</div>
			<# } #>

		    <div class="exad-card-body">
		    	<# if ( settings.exad_card_title ) { #>
			    	<a href="{{{ settings.exad_card_title_link.url }}}" {{{ view.getRenderAttributeString( 'exad_card_title_link' ) }}}>
			    		<{{{ titleHTMLTag }}} {{{ view.getRenderAttributeString( 'exad_card_title' ) }}}>
			    			{{{ settings.exad_card_title }}}
			    		</{{{ titleHTMLTag }}}>
		    		</a>
		    	<# } #>

		    	<# if ( settings.exad_card_tag ) { #>
		        	<p {{{ view.getRenderAttributeString( 'exad_card_tag' ) }}}>
		        		{{{ settings.exad_card_tag }}}
		        	</p>
		    	<# } #>

		    	<# if ( settings.exad_card_description ) { #>
		        	<p {{{ view.getRenderAttributeString( 'exad_card_description' ) }}}>
		        		{{{ settings.exad_card_description }}}
		        	</p>
		        <# } #>

		        <# if ( settings.exad_card_action_text ) { #>
		            <a href="{{{ settings.exad_card_action_link.url }}}" {{{ view.getRenderAttributeString( 'exad_card_action_link' ) }}}{{{ target }}}{{{ nofollow }}}>
		            	<# if ( 'icon_pos_left' === settings.exad_card_action_link_icon_position && iconHTML.value ) { #>
							<span class="{{{ settings.exad_card_action_link_icon_position }}}">
								{{{ iconHTML.value }}}
							</span>
						<# } #>
						<span {{{ view.getRenderAttributeString( 'exad_card_action_text' ) }}}>
							{{{ settings.exad_card_action_text }}}
						</span>
						<# if ( 'icon_pos_right' === settings.exad_card_action_link_icon_position && iconHTML.value ) { #>
							<span class="{{{ settings.exad_card_action_link_icon_position }}}">
								{{{ iconHTML.value }}}
							</span>
						<# } #>
					</a>
				<# } #>
		    </div>
		</div>
		<?php
	}
}