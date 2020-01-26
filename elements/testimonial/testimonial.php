<?php
namespace ExclusiveAddons\Elements;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Testimonial extends Widget_Base { 

    public function get_name() {
		return 'exad-testimonial';
	}

	public function get_title() {
		return esc_html__( 'Testimonial', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-blockquote';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
        return [ 'review', 'feedback' ];
    }
		
	protected function _register_controls() {

		/**
		 * Testimonial Content Section
		 */

		$this->start_controls_section(
			'exad_testimonial_section',
			[
				'label' => esc_html__( 'Contents', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_testimonial_image',
			[
				'label'   => __( 'Image', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				]
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'testimonial_thumbnail',
				'default'   => 'thumbnail',
				'condition' => [
					'exad_testimonial_image[url]!' => ''
				],
			]
		);

		$this->add_control(
			'exad_testimonial_description',
			[
				'label'   => esc_html__( 'Testimonial', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_testimonial_name',
			[
				'label'   => esc_html__( 'Name', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'John Doe', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_testimonial_designation',
			[
				'label'   => esc_html__( 'Designation', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Co-Founder', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_testimonial_enable_rating',
			[
				'label'   => esc_html__( 'Display Rating?', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);

		$rating_number = range( 1, 5 );
        $rating_number = array_combine( $rating_number, $rating_number );

		$this->add_control(
		  	'exad_testimonial_rating_number',
		  	[
				'label'   => __( 'Rating Number', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 5,
				'options' => $rating_number,
				'condition' => [
					'exad_testimonial_enable_rating' => 'yes'
				]
		  	]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Container Style Section
		 */

		$this->start_controls_section(
			'exad_testimonial_container_section_style',
			[
				'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_testimonial_container_alignment',
			[
				'label'   => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'default' => 'exad-testimonial-align-left',
				'options' => [
					'exad-testimonial-align-left'   => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-arrow-left'
					],
					'exad-testimonial-align-center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-arrow-up'
					],
					'exad-testimonial-align-right'  => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-arrow-right'
					],
					'exad-testimonial-align-bottom' => [
						'title' => __( 'Bottom', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-arrow-down'
					]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'exad_testimonial_container_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .exad-testimonial-wrapper'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'            => 'exad_testimonial_container_border',
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
                        'default' => '#e3e3e3'
                    ]
				],
				'selector'        => '{{WRAPPER}} .exad-testimonial-wrapper'
			]
		);

		$this->add_responsive_control(
			'exad_testimonial_container_radius',
			[
				'label'      => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'before',
				'default'    => [
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-testimonial-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_testimonial_container_padding',
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
					'{{WRAPPER}} .exad-testimonial-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_testimonial_container_box_shadow',
				'selector' => '{{WRAPPER}} .exad-testimonial-wrapper'
			]
		);

		$this-> end_controls_section();

		/**
		 * testimonial Review Image style
		 */
		$this->start_controls_section(
			'exad_testimonial_image_style',
			[
				'label' => esc_html__( 'Reviewer Image', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_testimonial_image_box',
			[
				'label'        => __( 'Image Box', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'OFF', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_responsive_control(
			'exad_testimonial_image_box_height',
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
				'default'     => [
					'unit'    => 'px',
					'size'    => 80
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-testimonial-thumb'=> 'height: {{SIZE}}{{UNIT}};'
				],
				'condition'   => [
					'exad_testimonial_image_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_testimonial_image_box_width',
			[
				'label'       => __( 'Width', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'separator'   => 'after',
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 80
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-testimonial-thumb'=> 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-testimonial-image-align-left .exad-testimonial-thumb, {{WRAPPER}} .exad-testimonial-image-align-right .exad-testimonial-thumb'=> 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-testimonial-image-align-left .exad-testimonial-reviewer, {{WRAPPER}} .exad-testimonial-image-align-right .exad-testimonial-reviewer'=> 'width: calc( 100% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .exad-testimonial-wrapper.exad-testimonial-align-left .exad-testimonial-content-wrapper-arrow::before'=> 'left: calc( {{SIZE}}{{UNIT}} / 2 );',
					'{{WRAPPER}} .exad-testimonial-wrapper.exad-testimonial-align-right .exad-testimonial-content-wrapper-arrow::before'=> 'right: calc(( {{SIZE}}{{UNIT}} / 2) - 10px);'
				],
				'condition'   => [
					'exad_testimonial_image_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'exad_testimonial_image_box_border',
				'selector'  => '{{WRAPPER}} .exad-testimonial-thumb',
				'condition' => [
					'exad_testimonial_image_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_testimonial_image_box_radius',
			[
				'label'      => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '50',
					'right'  => '50',
					'bottom' => '50',
					'left'   => '50',
					'unit'   => '%'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-testimonial-thumb'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .exad-testimonial-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_testimonial_image_box_shadow',
				'selector' => '{{WRAPPER}} .exad-testimonial-thumb'
			]
		);

		$this->add_responsive_control(
			'exad_testimonial_image_box_margin_bottom',
			[
				'label'       => __( 'Bottom Spaing', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => -500,
						'max' => 500
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 0
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-testimonial-thumb'=> 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
				'condition'   => [
					'exad_testimonial_container_alignment' => 'exad-testimonial-align-bottom'
				]
			]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Testimonial Style Section
		 */
		$this->start_controls_section(
			'exad_testimonial_description_style',
			[
				'label' => esc_html__( 'Testimonial', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_testimonial_description_typography',
				'selector' => '{{WRAPPER}} .exad-testimonial-description'
			]
		);

		$this->add_control(
			'exad_testimonial_description_color',
			[
				'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-description' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'exad_testimonial_description_bg_color',
			[
				'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-content-wrapper'               => 'background: {{VALUE}};',
					'{{WRAPPER}} .exad-testimonial-content-wrapper-arrow::before' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_testimonial_description_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-testimonial-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_testimonial_description_spacing_bottom',
			[
				'label'       => __( 'Bottom Spacing', 'exclusive-addons-elementor' ),
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
					'{{WRAPPER}} .exad-testimonial-content-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_testimonial_description_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-testimonial-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_testimonial_description_box_shadow',
				'selector' => '{{WRAPPER}} .exad-testimonial-content-wrapper'
			]
		);

		$this->add_control(
			'exad_testimonial_description_arrow_enable',
			[
				'label'        => __( 'Show Arrow', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'OFF', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before'
			]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Rating Style Section
		 */
		$this->start_controls_section(
			'exad_testimonial_rating_style',
			[
				'label'     => esc_html__( 'Rating', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_testimonial_enable_rating' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_testimonial_rating_size',
			[
				'label'       => __( 'Icon Size', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 50
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 20
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-testimonial-ratings li i' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_testimonial_rating_icon_margin',
			[
				'label'       => __( 'Icon Margin', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 30
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 5
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-testimonial-ratings li:not(:last-child) i' => 'margin-right: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_testimonial_rating_margin',
			[
				'label'        => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '20',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-testimonial-ratings' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		

		$this->start_controls_tabs( 'exad_testimonial_rating_tabs' );

			// normal state rating
			$this->start_controls_tab( 'exad_testimonial_rating_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_testimonial_rating_normal_color',
					[
						'label'     => __( 'Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222222',
						'selectors' => [
							'{{WRAPPER}} .exad-testimonial-ratings li i' => 'color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();

			// hover state rating
			$this->start_controls_tab( 'exad_testimonial_rating_active', [ 'label' => esc_html__( 'Active', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_testimonial_rating_active_color',
					[
						'label'     => __( 'Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ff5b84',
						'selectors' => [
							'{{WRAPPER}} .exad-testimonial-ratings li.exad-testimonial-ratings-active i' => 'color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this-> end_controls_section();

		/**
		 * Testimonial Riviewer Style Section
		 */
		$this->start_controls_section(
			'exad_testimonial_reviewer_style',
			[
				'label' => esc_html__( 'Reviewer', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'exad_testimonial_reviewer_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-testimonial-reviewer-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_testimonial_reviewer_spacing',
			[
				'label'       => __( 'Spacing', 'exclusive-addons-elementor' ),
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
					'{{WRAPPER}} .exad-testimonial-wrapper.exad-testimonial-align-left .exad-testimonial-reviewer-wrapper .exad-testimonial-reviewer' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-testimonial-wrapper.exad-testimonial-align-right .exad-testimonial-reviewer-wrapper .exad-testimonial-reviewer' => 'padding-right: {{SIZE}}{{UNIT}};'
				],
				'condition'   => [
					'exad_testimonial_container_alignment' => ['exad-testimonial-align-left', 'exad-testimonial-align-right']
				]
			]
		);

		/**
		 * Testimonial Title Style Section
		 */
		$this->add_control(
			'exad_testimonial_title_style',
			[
				'label'     => __( 'Reviewer Title', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'             => 'exad_testimonial_title_typography',
				'selector'         => '{{WRAPPER}} .exad-testimonial-name',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 22
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ]
			]
		);

		$this->add_control(
			'exad_testimonial_title_color',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-name' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_testimonial_title_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		// Testimonial Designation Style Section
		$this->add_control(
			'exad_testimonial_designation_style',
			[
				'label'     => __( 'Reviewer Designation', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'             => 'exad_testimonial_designation_typography',
				'selector'         => '{{WRAPPER}} .exad-testimonial-designation',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 14
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ]
			]
		);

		$this->add_control(
			'exad_testimonial_designation_color',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-designation' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_testimonial_designation_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-testimonial-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this-> end_controls_section();
	}

	private function render_testimonial_rating( $ratings ) {
		for( $i = 1; $i <= 5; $i++ ) {
			if( $ratings >= $i ) {
				$rating_active_class = '<li class="exad-testimonial-ratings-active"><i class="eicon-star-o"></i></li>';
			} else {
				$rating_active_class = '<li><i class="eicon-star-o"></i></li>';
			}
			echo $rating_active_class;
		}
	}

	private function render_testimonial_image( $image_url, $reviewer_name ) {
		$output = '';
		if ( !empty( $image_url ) ) :
			$output .= '<div class="exad-testimonial-thumb">';
				$output .= '<img src="'.esc_url( $image_url ).'" alt="'.Control_Media::get_image_alt( $reviewer_name ).'">';
			$output .= '</div>';
		endif;
		return $output;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$testimonial_image = $this->get_settings_for_display( 'exad_testimonial_image' );
		$testimonial_image_url_src = Group_Control_Image_Size::get_attachment_image_src( $testimonial_image['id'], 'testimonial_thumbnail', $settings );

		if( empty( $testimonial_image_url_src ) ) {
			$testimonial_image_url = $testimonial_image['url']; 
		} else { 
			$testimonial_image_url = $testimonial_image_url_src;
		}

		$this->add_inline_editing_attributes( 'exad_testimonial_description' );
		$this->add_render_attribute( 'exad_testimonial_description', 'class', 'exad-testimonial-description' );

		$this->add_inline_editing_attributes( 'exad_testimonial_name', 'none' );
		$this->add_render_attribute( 'exad_testimonial_name', 'class', 'exad-testimonial-name' );

		$this->add_inline_editing_attributes( 'exad_testimonial_designation', 'none' );
		$this->add_render_attribute( 'exad_testimonial_designation', 'class', 'exad-testimonial-designation' );

		$this->add_render_attribute( 'exad_testimonial_content_wrapper', 'class', 'exad-testimonial-content-wrapper' );

		if ( 'yes' === $settings['exad_testimonial_description_arrow_enable'] ){
			$this->add_render_attribute( 'exad_testimonial_content_wrapper', 'class', 'exad-testimonial-content-wrapper-arrow' );
		}

		echo '<div class="exad-testimonial-wrapper '.esc_attr( $settings['exad_testimonial_container_alignment'] ).'">';
			echo '<div class="exad-testimonial-wrapper-inner">';
				echo '<div '.$this->get_render_attribute_string( 'exad_testimonial_content_wrapper' ).'>';
					if ( !empty( $settings['exad_testimonial_description'] ) ) :
						echo '<p '.$this->get_render_attribute_string( 'exad_testimonial_description' ).'>'.wp_kses_post( $settings['exad_testimonial_description'] ).'</p>';
						if ( 'yes' === $settings['exad_testimonial_enable_rating'] ) :
							echo '<ul class="exad-testimonial-ratings">';
								$this->render_testimonial_rating( $settings['exad_testimonial_rating_number'] );
							echo '</ul>';
						endif;
					endif;
				echo '</div>';
				echo '<div class="exad-testimonial-reviewer-wrapper">';
					if( 'exad-testimonial-align-bottom' !== $settings['exad_testimonial_container_alignment'] ) :
						echo $this->render_testimonial_image( $testimonial_image_url, $settings['exad_testimonial_image'] );
					endif;

					echo '<div class="exad-testimonial-reviewer">';
						if ( !empty( $settings['exad_testimonial_name'] ) ) :
							echo '<h4 '.$this->get_render_attribute_string( 'exad_testimonial_name' ).'>'.esc_html( $settings['exad_testimonial_name'] ).'</h4>';
						endif;
						if ( !empty( $settings['exad_testimonial_designation'] ) ) :
							echo '<span '.$this->get_render_attribute_string( 'exad_testimonial_designation' ).'>'.esc_html( $settings['exad_testimonial_designation'] ).'</span>';
						endif;
					echo '</div>';					

					if( 'exad-testimonial-align-bottom' === $settings['exad_testimonial_container_alignment'] ) :
						echo $this->render_testimonial_image( $testimonial_image_url, $settings['exad_testimonial_image'] );
					endif;
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}

	/**
     * Render testimonial widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
	protected function _content_template() {
		?>
		<#
			view.addRenderAttribute( 'exad_testimonial_content_wrapper', 'class', 'exad-testimonial-content-wrapper' );
			if ( 'yes' === settings.exad_testimonial_description_arrow_enable ) {
	        	view.addRenderAttribute( 'exad_testimonial_content_wrapper', 'class', 'exad-testimonial-content-wrapper-arrow' );
	      	}

	      	view.addInlineEditingAttributes( 'exad_testimonial_name', 'none' );
	      	view.addRenderAttribute( 'exad_testimonial_name', 'class', 'exad-testimonial-name' );

	      	view.addInlineEditingAttributes( 'exad_testimonial_designation', 'none' );
			view.addRenderAttribute( 'exad_testimonial_designation', 'class', 'exad-testimonial-designation' );

	      	view.addInlineEditingAttributes( 'exad_testimonial_description' );
	      	view.addRenderAttribute( 'exad_testimonial_description', 'class', 'exad-testimonial-description' );

	      	if ( settings.exad_testimonial_image.url || settings.exad_testimonial_image.id ) {
				var image = {
					id: settings.exad_testimonial_image.id,
					url: settings.exad_testimonial_image.url,
					size: settings.testimonial_thumbnail_size,
					dimension: settings.testimonial_thumbnail_custom_dimension,
					model: view.getEditModel()
				};

				var imageURL = elementor.imagesManager.getImageUrl( image );
			}
		#>

		<div class="exad-testimonial-wrapper {{ settings.exad_testimonial_container_alignment }}">
	        <div class="exad-testimonial-wrapper-inner">
	            <div {{{ view.getRenderAttributeString( 'exad_testimonial_content_wrapper' ) }}}>
	          		<# if ( settings.exad_testimonial_description ) { #>
                      	<p {{{ view.getRenderAttributeString( 'exad_testimonial_description' ) }}}>
                          	{{{ settings.exad_testimonial_description }}}
                      	</p>
                      	<# if ( 'yes' === settings.exad_testimonial_enable_rating ) { #>
							
							<ul class="exad-testimonial-ratings">
							 	<#
							       	var $ratings = settings.exad_testimonial_rating_number;
							      	var $rating_active_class = '';
							      	for( var $i = 1; $i <= 5; $i++ ) {
								        if( $ratings >= $i ) { #>
								          <li class="exad-testimonial-ratings-active"><i class="eicon-star-o"></i></li>
								        <# } else { #>
								          <li><i class="eicon-star-o"></i></li>
								        <# }
							      	}
						    	#>
					        </ul>

						<# } #>
                  	<# } #>
	            </div>

	            <div class="exad-testimonial-reviewer-wrapper">
					<# if( 'exad-testimonial-align-bottom' !== settings.exad_testimonial_container_alignment ) { #>	
						<# if ( imageURL ) { #>
					    	<div class="exad-testimonial-thumb">
								<img src="{{{ imageURL }}}">
							</div>
						<# } #>
					<# } #>

					<div class="exad-testimonial-reviewer">
						<# if ( settings.exad_testimonial_name ) { #>
							<h4 {{{ view.getRenderAttributeString( 'exad_testimonial_name' ) }}}>
								{{{ settings.exad_testimonial_name }}}
							</h4>
						<# } #>
						<# if ( settings.exad_testimonial_designation ) { #>
							<span  {{{ view.getRenderAttributeString( 'exad_testimonial_designation' ) }}}>
								{{{ settings.exad_testimonial_designation }}}
							</span>
						<# } #>
					</div>

					<# if( 'exad-testimonial-align-bottom' === settings.exad_testimonial_container_alignment ) { #>
						<# if ( imageURL ) { #>
					    	<div class="exad-testimonial-thumb">
								<img src="{{{ imageURL }}}">
							</div>
						<# } #>
					<# } #>					
	        	</div>
	        </div>
	    </div>
		<?php
	}
}