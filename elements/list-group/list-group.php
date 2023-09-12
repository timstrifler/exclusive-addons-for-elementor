<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Widget_Base;

class List_group extends Widget_Base {
	
	public function get_name() {
		return 'exad-list-group';
	}

	public function get_title() {
		return esc_html__( 'List Group', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad exad-logo exad-infobox';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
		return [ 'exclusive', 'information', 'group', 'list' ];
	}

	protected function register_controls() {
		
		/*
		* Icon List Content
		*/
		$this->start_controls_section(
			'exad_section_list_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
            'exad_list_icon_type',
            [
                'label' => __( 'Media Type', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'icon',
				'options' => [
					'icon' => [
						'title' => __( 'Icon', 'exclusive-addons-elementor' ),
						'icon' => 'eicon-star',
					],
					'number' => [
						'title' => __( 'Number', 'exclusive-addons-elementor' ),
						'icon' => 'eicon-number-field',
					],
					'image' => [
						'title' => __( 'Image', 'exclusive-addons-elementor' ),
						'icon' => 'eicon-image',
					],
				],
				'toggle' => false,
                'style_transfer' => true,
            ]
        );

		$repeater->add_control(
			'exad_list_icon',
			[
				'label'       => __( 'Icon', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'separator'   =>'after',
				'default'     => [
					'value'   => 'far fa-check-circle',
					'library' => 'fa-regular'
				],
				'condition' =>[
					'exad_list_icon_type' => 'icon'
				]
			]
		);

		$repeater->add_control(
			'exad_list_icon_number',
			[
				'label'   => esc_html__( 'Number', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( '1', 'exclusive-addons-elementor' ),
				'separator'   =>'after',
				'condition' =>[
					'exad_list_icon_type' => 'number'
				]
			]
		);

		$repeater->add_control(
			'exad_list_icon_number_image',
			[
				'label' => __( 'Choose Image', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'separator'   =>'after',
				'dynamic' => [
					'active' => true,
				],
				'condition' =>[
					'exad_list_icon_type' => 'image'
				]
			]
		);

        $repeater->add_control(
			'exad_list_text',
			[
				'label'   => esc_html__( 'Text', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'List Text', 'exclusive-addons-elementor' ),
				'dynamic' => [ 'active' => true ]
			]
		);

		$repeater->add_control(
			'exad_list_link',
			[
				'label' => __( 'List URL', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$this->add_control(
			'exad_list_group',
			[
				'label' => __( 'List Items', 'exclusive-addons-elementor' ),
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' => [
					[
						'exad_list_text' => __( 'List Item #1', 'exclusive-addons-elementor' ),
						'exad_list_icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
					],
					[
						'exad_list_text' => __( 'List Item #2', 'exclusive-addons-elementor' ),
						'exad_list_icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
					],
					[
						'exad_list_text' => __( 'List Item #3', 'exclusive-addons-elementor' ),
						'exad_list_icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
					],
				],
				'title_field' => '{{{ elementor.helpers.renderIcon( this, exad_list_icon, {}, "i", "panel" ) }}}{{{ exad_list_text }}}'
			]
		);

		$this->end_controls_section();

		/*
		* Icon List Content
		*/
		$this->start_controls_section(
			'exad_section_list_style',
			[
				'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_section_list_layout',
			[
				'label' => __( 'Layout', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'layout_1',
				'options' => [
					'layout_1' => __( 'Layout 1', 'exclusive-addons-elementor' ),
					'layout_2' => __( 'Layout 2', 'exclusive-addons-elementor' ),
					'layout_3' => __( 'Layout 3', 'exclusive-addons-elementor' ),
				],
			]
		);

		$this->add_responsive_control(
			'exad_section_list_alignment',
			[
				'label'       => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => false,
				'options'     => [
					'exad-list-group-left'   => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-left'
					],
					'exad-list-group-center' => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-center'
					],
					'exad-list-group-right'  => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'selectors_dictionary' => [
					'exad-list-group-left' => 'justify-content: flex-start; text-align: left;',
					'exad-list-group-center' => 'justify-content: center; text-align: center;',
					'exad-list-group-right' => 'justify-content: flex-end; text-align: right;',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper' => '{{VALUE}};',
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item' => '{{VALUE}};',
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item a' => '{{VALUE}};',
				],
				'default'     => 'exad-list-group-left',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'            => 'exad_section_list_group_background',
				'types'           => [ 'classic', 'gradient' ],
				'selector'        => '{{WRAPPER}} .exad-list-group',
			]
		);

		$this->add_responsive_control(
			'exad_section_list_group_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => true
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-list-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'exad_section_list_group_border',
				'selector'  => '{{WRAPPER}} .exad-list-group'
			]
		);

		$this->add_responsive_control(
			'exad_section_list_group_radius',
			[
				'label'        => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px'
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-list-group' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_section_list_group_shadow',
				'selector' => '{{WRAPPER}} .exad-list-group'
			]
		);

		$this->end_controls_section();

		/*
		* Icon List Content
		*/
		$this->start_controls_section(
			'exad_section_list_item_style',
			[
				'label' => esc_html__( 'List Item', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'exad_section_list_item_padding',
			[
				'label'        => __( 'Item Padding', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '10',
					'unit'     => 'px'
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'exad_section_list_item_separator',
            [
				'label'        => __( 'Item Separator', 'exclusive-addons-elementor' ),
				'type'         =>  Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'exad_section_list_layout!' => 'layout_3'
				]
			]
        );

		$this->add_responsive_control(
			'exad_section_list_item_separator_height',
			[
				'label' => __( 'Separator Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper.layout_1 .exad-list-group-item:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper.layout_2 .exad-list-group-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_section_list_item_separator' => 'yes',
					'exad_section_list_layout!' => 'layout_3'
				]
			]
		);

		$this->add_control(
			'exad_section_list_item_separator_color',
			[
				'label' => __( 'Separator Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e5e5e5',
				'selectors' => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper.layout_1 .exad-list-group-item:not(:last-child):after' => 'background: {{VALUE}}',
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper.layout_2 .exad-list-group-item:not(:last-child):after' => 'background: {{VALUE}}',
				],
				'condition' => [
					'exad_section_list_item_separator' => 'yes',
					'exad_section_list_layout!' => 'layout_3'
				]
			]
		);

		$this->add_responsive_control(
			'exad_list_item_spacing',
			[
				'label' => __( 'Item Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper.layout_3 .exad-list-group-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_section_list_layout' => 'layout_3'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'            => 'exad_list_item_background',
				'types'           => [ 'classic', 'gradient' ],
				'selector'        => '{{WRAPPER}} .exad-list-group .exad-list-group-wrapper.layout_3 .exad-list-group-item',
				'condition' => [
					'exad_section_list_layout' => 'layout_3'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'exad_list_item_border',
				'selector'  => '{{WRAPPER}} .exad-list-group .exad-list-group-wrapper.layout_3 .exad-list-group-item',
				'fields_options'  => [
                    'border' 	  => [
                        'default' => 'solid'
                    ],
                    'width'  	  => [
                        'default' 	 => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                    'color' 	  => [
                        'default' => '#e5e5e5',
                    ]
                ],
				'condition' => [
					'exad_section_list_layout' => 'layout_3'
				]
			]
		);

		$this->add_responsive_control(
			'exad_list_item_radius',
			[
				'label'        => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '10',
					'unit'     => 'px'
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper.layout_3 .exad-list-group-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
					'exad_section_list_layout' => 'layout_3'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_list_item_shadow',
				'selector' => '{{WRAPPER}} .exad-list-group .exad-list-group-wrapper.layout_3 .exad-list-group-item',
				'condition' => [
					'exad_section_list_layout' => 'layout_3'
				]
			]
		);

		$this->end_controls_section();

		/*
		* Icon List Icon Style
		*/
		$this->start_controls_section(
			'exad_section_list_icon_style',
			[
				'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'exad_list_icon_position',
			[
				'label'       => esc_html__( 'Icon Position', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => false,
				'options'     => [
					'exad-icon-left'   => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-h-align-left'
					],
					'exad-icon-center' => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-v-align-top'
					],
					'exad-icon-right'  => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-h-align-right'
					]
				],
				'default'     => 'exad-icon-left'
			]
		);

		$this->add_responsive_control(
			'exad_list_icon_alignment',
			[
				'label'       => esc_html__( 'Icon Vertical Alignment', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => false,
				'options'     => [
					'exad-icon-align-left'   => [
						'title' => esc_html__( 'Top', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-v-align-top'
					],
					'exad-icon-align-center' => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-v-align-middle'
					],
					'exad-icon-align-right'  => [
						'title' => esc_html__( 'Bottom', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-v-align-bottom'
					]
				],
				'default'     => 'exad-icon-align-left',
				'selectors_dictionary' => [
					'exad-icon-align-left' => 'align-items: flex-start;',
					'exad-icon-align-center' => 'align-items: center;',
					'exad-icon-align-right' => 'align-items: flex-end;',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item' => '{{VALUE}};',
				],
				'condition' => [
					'exad_list_icon_position!' => 'exad-icon-center'
				]
			]
		);

		$this->add_responsive_control(
			'exad_list_icon_top_alignment',
			[
				'label'       => esc_html__( 'Icon Alignment', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => false,
				'options'     => [
					'exad-icon-top-align-left'   => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-v-align-top'
					],
					'exad-icon-top-align-center' => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-v-align-middle'
					],
					'exad-icon-top-align-right'  => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-v-align-bottom'
					]
				],
				'default'     => 'exad-icon-left',
				'selectors_dictionary' => [
					'exad-icon-top-align-left' => 'text-align: left; margin-right: auto;',
					'exad-icon-top-align-center' => 'text-align: center; margin-left: auto; margin-right: auto;',
					'exad-icon-top-align-right' => 'text-align: right; margin-left: auto;',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-icon' => '{{VALUE}};',
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-icon .exad-list-group-icon-image' => '{{VALUE}};',
				],
				'condition' => [
					'exad_list_icon_position' => 'exad-icon-center'
				]
			]
		);

		$this->add_responsive_control(
			'exad_section_list_item_icon_spacing',
			[
				'label' => __( 'Icon Right Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-text' => 'padding-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_list_icon_position' => 'exad-icon-left'
				]
			]
		);
		$this->add_responsive_control(
			'exad_section_list_item_icon_left_spacing',
			[
				'label' => __( 'Icon Left Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_list_icon_position' => 'exad-icon-right'
				]
			]
		);
		$this->add_responsive_control(
			'exad_section_list_item_icon_bottom_spacing',
			[
				'label' => __( 'Icon Bottom Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_list_icon_position' => 'exad-icon-center'
				]
			]
		);

		$this->add_responsive_control(
			'exad_section_list_item_icon_size',
			[
				'label' => __( 'Icon Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-icon .exad-list-group-icon-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_section_list_item_icon_color',
			[
				'label' => __( 'Icon Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'exad_section_list_item_image_radius',
			[
				'label'        => __( 'Image Radius', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px'
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-icon .exad-list-group-icon-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'exad_list_item_icon_box_enable',
			[
				'label' => __( 'Enable Icon Box', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'exad_list_item_icon_box_width',
			[
				'label' => __( 'Icon Box Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-icon.yes' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper.layout_1 .exad-list-group-item .exad-list-group-text' => 'width: calc( 100% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper.layout_2 .exad-list-group-item .exad-list-group-text' => 'width: calc( 100% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper.layout_3 .exad-list-group-item .exad-list-group-text' => 'width: calc( 100% - {{SIZE}}{{UNIT}} );',
				],
				'condition' => [
					'exad_list_item_icon_box_enable' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_list_item_icon_box_height',
			[
				'label' => __( 'Icon Box Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-icon.yes' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_list_item_icon_box_enable' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'            => 'exad_list_item_icon_box_background',
				'types'           => [ 'classic', 'gradient' ],
				'selector'        => '{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-icon.yes',
				'condition' => [
					'exad_list_item_icon_box_enable' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'exad_list_item_icon_box_border',
				'selector'  => '{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-icon.yes',
				'condition' => [
					'exad_list_item_icon_box_enable' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_list_item_icon_box_radius',
			[
				'label'        => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px'
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-icon.yes' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
					'exad_list_item_icon_box_enable' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_list_item_icon_box_shadow',
				'selector' => '{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-icon.yes',
				'condition' => [
					'exad_list_item_icon_box_enable' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		/*
		* Icon List Text
		*/
		$this->start_controls_section(
			'exad_section_list_text_style',
			[
				'label' => esc_html__( 'Text', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'exad_section_list_text_alignment',
			[
				'label'       => esc_html__( 'Text Alignment', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => false,
				'options'     => [
					'exad-text-align-left'   => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-left'
					],
					'exad-text-align-center' => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-left'
					],
					'exad-text-align-right'  => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-left'
					]
				],
				'default'     => 'exad-text-align-left',
				'selectors_dictionary' => [
					'exad-text-align-left' => 'text-align: left;',
					'exad-text-align-center' => 'text-align: center;',
					'exad-text-align-right' => 'text-align: right;',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-text' => '{{VALUE}};',
				],
				'condition' => [
					'exad_list_icon_position' => 'exad-icon-center'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_section_list_text_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-text',
			]
		);

		$this->add_control(
			'exad_section_list_text_color',
			[
				'label' => __( 'Title Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .exad-list-group .exad-list-group-wrapper .exad-list-group-item .exad-list-group-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
		
	}
	protected function render() {
		$settings = $this->get_settings_for_display();

		?>
		<div class="exad-list-group">
			<ul class="exad-list-group-wrapper <?php echo $settings['exad_section_list_layout']; ?>">
				<?php foreach( $settings['exad_list_group'] as $list ) : ?>
				<?php
					$target = $list['exad_list_link']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $list['exad_list_link']['nofollow'] ? ' rel="nofollow"' : '';
				?>
					<li class="exad-list-group-item <?php echo $settings['exad_list_icon_position']?>">
						<?php if ( !empty( $list['exad_list_link']['url'] ) ) { ?>
						<a href="<?php echo $list['exad_list_link']['url']; ?>" <?php echo $target; ?> <?php echo $nofollow; ?> >
						<?php } ?>
							<span class="exad-list-group-icon <?php echo $settings['exad_list_item_icon_box_enable']; ?>">
								<?php if ( $list['exad_list_icon_type'] === 'icon' && !empty($list['exad_list_icon']) ){ ?>
									<?php Icons_Manager::render_icon( $list['exad_list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								<?php } ?>
								<?php if ( $list['exad_list_icon_type'] === 'number' && !empty($list['exad_list_icon_type']) ){ ?>
									<div class="exad-list-group-icon-number">
										<?php echo $list['exad_list_icon_number']; ?>
									</div>
								<?php } ?>
								<?php if ( $list['exad_list_icon_type'] === 'image' && !empty($list['exad_list_icon_type']) ){ ?>
									<div class="exad-list-group-icon-image">
										<img src="<?php echo $list['exad_list_icon_number_image']['url'] ?>" alt="<?php echo $list['exad_list_text']; ?>">
									</div>
								<?php } ?>
							</span>
							<?php if ( !empty( $list['exad_list_text'] ) ) { ?>
								<span class="exad-list-group-text">
									<?php echo $list['exad_list_text']; ?>
								</span>
							<?php } ?>
						<?php if ( !empty( $list['exad_list_link']['url'] ) ) { ?>
						</a>
						<?php } ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
	}

	/**
     * Render team member widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
	protected function content_template() {
		?>
		<div class="exad-list-group">
			<ul class="exad-list-group-wrapper {{ settings.exad_section_list_layout }}">
				<#
					_.each( settings.exad_list_group, function( list, index ) { 
						var target = list.exad_list_link.is_external ? ' target="_blank"' : '';
						var nofollow = list.exad_list_link.nofollow ? ' rel="nofollow"' : '';

						var iconHTML     = elementor.helpers.renderIcon( view, list.exad_list_icon, { 'aria-hidden': true }, 'i' , 'object' );
				#>
					<li class="exad-list-group-item {{ settings.exad_list_icon_position }}">
						<# if ( list.exad_list_link.url ){ #>
						<a href="{{ list.exad_list_link.url }}" {{{ target }}} {{{ nofollow }}} >
						<# } #>
							<span class="exad-list-group-icon {{ settings.exad_list_item_icon_box_enable }}">
								<# if ( list.exad_list_icon_type === 'icon' && list.exad_list_icon ){ #>
									{{{ iconHTML.value }}}
								<# } #>
								<# if ( list.exad_list_icon_type === 'number' && list.exad_list_icon_type ){ #>
									<div class="exad-list-group-icon-number">
										{{{ list.exad_list_icon_number }}}
									</div>
								<# } #>
								<# if ( list.exad_list_icon_type === 'image' && list.exad_list_icon_type ){ #>
									<div class="exad-list-group-icon-image">
										<img src="{{ list.exad_list_icon_number_image.url }}" alt="{{ list.exad_list_text }}">
									</div>
								<# } #>
							</span>
							<# if ( list.exad_list_text ) { #>
								<span class="exad-list-group-text">
									{{{ list.exad_list_text }}}
								</span>
							<# } #>
						<# if ( list.exad_list_link.url ){ #>
						</a>
						<# } #>
					</li>
				<# } ); #>
			</ul>
		</div>
		<?php
	}
}