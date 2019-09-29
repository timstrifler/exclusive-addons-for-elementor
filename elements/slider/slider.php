<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class ExclusiveSliderItem extends Widget_Base {
	
	public function get_name() {
		return 'exad-exclusive-slider';
	}
	public function get_title() {
		return esc_html__( 'Slider', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-slideshow';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
	    return [ 'slides', 'carousel', 'image', 'slider', 'gallery' ];
	}

    public function get_script_depends() {
        return [ 'jquery-slick' ];
    }

    protected function _register_controls() {

		$this->start_controls_section(
			'exad_slider_items',
			[
				'label' => __( 'Slides', 'exclusive-addons-elementor' ),
			]
		);

 		$sliderItem = new Repeater();

        $sliderItem->start_controls_tabs( 'exad_slider_item' );

        $sliderItem->start_controls_tab( 'exad_slider_background', [ 'label' => __( 'Background', 'exclusive-addons-elementor' ) ] );

		$sliderItem->add_control(
			'exad_slider_bg',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#7448F6',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .exad-slide-bg' => 'background-color: {{VALUE}}'
				]
			]
		);

        $sliderItem->add_control(
            'exad_slider_img',
            [
                'label'         => __( 'Image', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::MEDIA,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .exad-slide-bg' => 'background-image: url({{URL}})'
				]
            ]
        );

        $sliderItem->end_controls_tab();

        $sliderItem->start_controls_tab( 'exad_slider_content', [ 'label' => __( 'Content', 'exclusive-addons-elementor' ) ] );

        $sliderItem->add_control(
            'exad_slider_title',
            [
                'label'         => __( 'Title', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'Exclusive Addon Slider Title...', 'exclusive-addons-elementor' )
            ]
        );

        $sliderItem->add_control(
            'exad_slider_details',
            [
                'label'         => __( 'Details', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum <br> has been the industry standard dummy text ever since the 1500s.', 'exclusive-addons-elementor' ),
            ]
        );

        $sliderItem->add_control(
            'exad_slider_button_text',
            [
                'label'         => __( 'Button Text', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'CLICK HERE', 'exclusive-addons-elementor' )
            ]
        );

        $sliderItem->add_control(
            'exad_slider_button_url',
            [
                'label'         => __( 'Link', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
                'show_external' => true,
                'placeholder'   => __( 'http://your-link.com', 'exclusive-addons-elementor' )
            ]
        );

        $sliderItem->end_controls_tab();

        $sliderItem->start_controls_tab( 'style', [ 'label' => __( 'Style', 'exclusive-addons-elementor' ) ] );

        // custom style for single slide item
        $sliderItem->add_control(
            'custom_style',
            [
                'label'         => __( 'Custom', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'Yes', 'exclusive-addons-elementor' ),
                'label_off'     => __( 'No', 'exclusive-addons-elementor' ),
                'return_value'  => 'yes',
                'description'   => __( 'Set custom style that will only affect this specific slide item.', 'exclusive-addons-elementor' )
            ]
        );

        $sliderItem->add_control(
            'mt_single_slider_content_vertical_position',
            [
                'label'         => __( 'Vertical Position', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::CHOOSE,
                'label_block'   => false,
                'default'       => 'middle',
                'options'       => [
                    'top'       => [
                        'title' => __( 'Top', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle'    => [
                        'title' => __( 'Middle', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom'    => [
                        'title' => __( 'Bottom', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .tt-slider-area {{CURRENT_ITEM}} .nivo-slide-inner' => 'vertical-align: {{VALUE}}',
                ],
                'conditions'    => [
                    'terms'     => [
                        [
                            'name'      => 'custom_style',
                            'operator'  => '==',
                            'value'     => 'yes',
                        ],
                    ],
                ]
            ]
        );

        // single slide item text align
        $sliderItem->add_control(
            'mt_single_slider_content_text_align',
            [
                'label'         => __( 'Text Align', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::CHOOSE,
                'label_block'   => false,
                'options'       => [
                    'left'      => [
                        'title' => __( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'       => 'center',
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .nivo-slide-inner' => 'text-align: {{VALUE}}',
                ],
                'conditions'    => [
                    'terms'     => [
                        [
                            'name'      => 'custom_style',
                            'operator'  => '==',
                            'value'     => 'yes',
                        ],
                    ],
                ],
            ]
        );

        // single slide item transition effect
        $sliderItem->add_control(
            'slider_effect',
            [
                'label'         => __( 'Transition Effect', 'exclusive-addons-elementor' ),
                'description'   => __( 'Select transition for this slide.', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    ''                   => __('None', 'exclusive-addons-elementor'),
                    'random'             => __('random', 'exclusive-addons-elementor'),
                    'sliceDown'          => __('sliceDown', 'exclusive-addons-elementor'),
                    'sliceDownLeft'      => __('sliceDownLeft', 'exclusive-addons-elementor'),
                    'sliceUp'            => __('sliceUp', 'exclusive-addons-elementor'),
                    'sliceUpLeft'        => __('sliceUpLeft', 'exclusive-addons-elementor'),
                    'sliceUpDown'        => __('sliceUpDown', 'exclusive-addons-elementor'),
                    'sliceUpDownLeft'    => __('sliceUpDownLeft', 'exclusive-addons-elementor'),
                    'fold'               => __('fold', 'exclusive-addons-elementor'),
                    'fade'               => __('fade', 'exclusive-addons-elementor'),
                    'slideInRight'       => __('slideInRight', 'exclusive-addons-elementor'),
                    'slideInLeft'        => __('slideInLeft', 'exclusive-addons-elementor'),
                    'boxRandom'          => __('boxRandom', 'exclusive-addons-elementor'),
                    'boxRain'            => __('boxRain', 'exclusive-addons-elementor'),
                    'boxRainReverse'     => __('boxRainReverse', 'exclusive-addons-elementor'),
                    'boxRainGrow'        => __('boxRainGrow', 'exclusive-addons-elementor'),
                    'boxRainGrowReverse' => __('boxRainGrowReverse', 'exclusive-addons-elementor')
                ],
                'conditions'    => [
                    'terms'     => [
                        [
                            'name'      => 'custom_style',
                            'operator'  => '==',
                            'value'     => 'yes',
                        ],
                    ],
                ],
            ]
        );

        // single slide item title atimation effect
        $sliderItem->add_control(
            'mt_single_slide_item_title_animation_effect',
            [
                'label'         => __( 'Title Animation', 'exclusive-addons-elementor' ),
                'description'   => __( 'Select title animation style for this slide only.', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'fadeInDown',
                'options'       => [
                    ''              => __('None', 'exclusive-addons-elementor'),
                    'fadeIn'        => __('fadeIn', 'exclusive-addons-elementor'),
                    'fadeInDown'    => __('fadeInDown', 'exclusive-addons-elementor'),
                    'fadeInLeft'    => __('fadeInLeft', 'exclusive-addons-elementor'),
                    'fadeInRight'   => __('fadeInRight', 'exclusive-addons-elementor'),
                    'fadeInUp'      => __('fadeInUp', 'exclusive-addons-elementor'),
                    'zoomIn'        => __('zoomIn', 'exclusive-addons-elementor'),
                    'zoomInDown'    => __('zoomInDown', 'exclusive-addons-elementor'),
                    'zoomInLeft'    => __('zoomInLeft', 'exclusive-addons-elementor'),
                    'zoomInRight'   => __('zoomInRight', 'exclusive-addons-elementor'),
                    'slideInUp'     => __('slideInUp', 'exclusive-addons-elementor'),
                    'slideInDown'   => __('slideInDown', 'exclusive-addons-elementor'),
                    'slideInLeft'   => __('slideInLeft', 'exclusive-addons-elementor'),
                    'slideInRight'  => __('slideInRight', 'exclusive-addons-elementor'),
                    'bounce'        => __('bounce', 'exclusive-addons-elementor'),
                    'bounceIn'      => __('bounceIn', 'exclusive-addons-elementor'),
                    'bounceInDown'  => __('bounceInDown', 'exclusive-addons-elementor'),
                    'bounceInLeft'  => __('bounceInLeft', 'exclusive-addons-elementor'),
                    'bounceInRight' => __('bounceInRight', 'exclusive-addons-elementor'),
                    'bounceInUp'    => __('bounceInUp', 'exclusive-addons-elementor'),
                    'rotateIn'      => __('rotateIn', 'exclusive-addons-elementor'),
                    'flip'          => __('flip', 'exclusive-addons-elementor'),
                    'flipInX'       => __('flipInX', 'exclusive-addons-elementor'),
                    'flipInY'       => __('flipInY', 'exclusive-addons-elementor'),
                    'pulse'         => __('pulse', 'exclusive-addons-elementor')
                ],
                'conditions'    => [
                    'terms'     => [
                        [
                            'name'      => 'custom_style',
                            'operator'  => '==',
                            'value'     => 'yes',
                        ],
                    ],
                ],
            ]
        );

        // single slide item details atimation effect
        $sliderItem->add_control(
            'mt_single_slide_item_details_animation_effect',
            [
                'label'         => __( 'Details Animation', 'exclusive-addons-elementor' ),
                'description'   => __( 'Select details animation style for this slide only.', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'fadeInDown',
                'options'       => [
                    ''              => __('None', 'exclusive-addons-elementor'),
                    'fadeIn'        => __('fadeIn', 'exclusive-addons-elementor'),
                    'fadeInDown'    => __('fadeInDown', 'exclusive-addons-elementor'),
                    'fadeInLeft'    => __('fadeInLeft', 'exclusive-addons-elementor'),
                    'fadeInRight'   => __('fadeInRight', 'exclusive-addons-elementor'),
                    'fadeInUp'      => __('fadeInUp', 'exclusive-addons-elementor'),
                    'zoomIn'        => __('zoomIn', 'exclusive-addons-elementor'),
                    'zoomInDown'    => __('zoomInDown', 'exclusive-addons-elementor'),
                    'zoomInLeft'    => __('zoomInLeft', 'exclusive-addons-elementor'),
                    'zoomInRight'   => __('zoomInRight', 'exclusive-addons-elementor'),
                    'slideInUp'     => __('slideInUp', 'exclusive-addons-elementor'),
                    'slideInDown'   => __('slideInDown', 'exclusive-addons-elementor'),
                    'slideInLeft'   => __('slideInLeft', 'exclusive-addons-elementor'),
                    'slideInRight'  => __('slideInRight', 'exclusive-addons-elementor'),
                    'bounce'        => __('bounce', 'exclusive-addons-elementor'),
                    'bounceIn'      => __('bounceIn', 'exclusive-addons-elementor'),
                    'bounceInDown'  => __('bounceInDown', 'exclusive-addons-elementor'),
                    'bounceInLeft'  => __('bounceInLeft', 'exclusive-addons-elementor'),
                    'bounceInRight' => __('bounceInRight', 'exclusive-addons-elementor'),
                    'bounceInUp'    => __('bounceInUp', 'exclusive-addons-elementor'),
                    'rotateIn'      => __('rotateIn', 'exclusive-addons-elementor'),
                    'flip'          => __('flip', 'exclusive-addons-elementor'),
                    'flipInX'       => __('flipInX', 'exclusive-addons-elementor'),
                    'flipInY'       => __('flipInY', 'exclusive-addons-elementor'),
                    'pulse'         => __('pulse', 'exclusive-addons-elementor')
                ],
                'conditions'    => [
                    'terms'     => [
                        [
                            'name'      => 'custom_style',
                            'operator'  => '==',
                            'value'     => 'yes',
                        ],
                    ],
                ],
            ]
        );


        // single slide item button atimation effect
        $sliderItem->add_control(
            'mt_single_slide_item_button_animation_effect',
            [
                'label'         => __( 'Button Animation', 'exclusive-addons-elementor' ),
                'description'   => __( 'Select button animation style for this slide only.', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'fadeInDown',
                'options'       => [
                    ''              => __('None', 'exclusive-addons-elementor'),
                    'fadeIn'        => __('fadeIn', 'exclusive-addons-elementor'),
                    'fadeInDown'    => __('fadeInDown', 'exclusive-addons-elementor'),
                    'fadeInLeft'    => __('fadeInLeft', 'exclusive-addons-elementor'),
                    'fadeInRight'   => __('fadeInRight', 'exclusive-addons-elementor'),
                    'fadeInUp'      => __('fadeInUp', 'exclusive-addons-elementor'),
                    'zoomIn'        => __('zoomIn', 'exclusive-addons-elementor'),
                    'zoomInDown'    => __('zoomInDown', 'exclusive-addons-elementor'),
                    'zoomInLeft'    => __('zoomInLeft', 'exclusive-addons-elementor'),
                    'zoomInRight'   => __('zoomInRight', 'exclusive-addons-elementor'),
                    'slideInUp'     => __('slideInUp', 'exclusive-addons-elementor'),
                    'slideInDown'   => __('slideInDown', 'exclusive-addons-elementor'),
                    'slideInLeft'   => __('slideInLeft', 'exclusive-addons-elementor'),
                    'slideInRight'  => __('slideInRight', 'exclusive-addons-elementor'),
                    'bounce'        => __('bounce', 'exclusive-addons-elementor'),
                    'bounceIn'      => __('bounceIn', 'exclusive-addons-elementor'),
                    'bounceInDown'  => __('bounceInDown', 'exclusive-addons-elementor'),
                    'bounceInLeft'  => __('bounceInLeft', 'exclusive-addons-elementor'),
                    'bounceInRight' => __('bounceInRight', 'exclusive-addons-elementor'),
                    'bounceInUp'    => __('bounceInUp', 'exclusive-addons-elementor'),
                    'rotateIn'      => __('rotateIn', 'exclusive-addons-elementor'),
                    'flip'          => __('flip', 'exclusive-addons-elementor'),
                    'flipInX'       => __('flipInX', 'exclusive-addons-elementor'),
                    'flipInY'       => __('flipInY', 'exclusive-addons-elementor'),
                    'pulse'         => __('pulse', 'exclusive-addons-elementor')
                ],
                'conditions'    => [
                    'terms'     => [
                        [
                            'name'      => 'custom_style',
                            'operator'  => '==',
                            'value'     => 'yes',
                        ],
                    ],
                ],
            ]
        );

        // single slide item heading color
        $sliderItem->add_control(
            'heading_color',
            [
                'label'         => __( 'Heading Color', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '#ffffff',
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .nivo-slide-inner h4' => 'color: {{VALUE}}',
                ],
                'conditions'    => [
                    'terms'     => [
                        [
                            'name'      => 'custom_style',
                            'operator'  => '==',
                            'value'     => 'yes',
                        ],
                    ],
                ],
            ]
        );

        // single slide item details color
        $sliderItem->add_control(
            'details_color',
            [
                'label'         => __( 'Details Color', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '#ffffff',
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .nivo-slide-inner p' => 'color: {{VALUE}}',
                ],
                'conditions'    => [
                    'terms'     => [
                        [
                            'name'      => 'custom_style',
                            'operator'  => '==',
                            'value'     => 'yes',
                        ],
                    ],
                ],
            ]
        );

        // single slide item button color
        $sliderItem->add_control(
            'mt_single_slide_button_text_color',
            [
                'label'         => __( 'Button Text Color', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '#ffffff',
                'selectors'     => [
                    '{{WRAPPER}} .tt-slider-area {{CURRENT_ITEM}} .slider-btn a' => 'color: {{VALUE}}',
                ],
                'conditions'    => [
                    'terms'     => [
                        [
                            'name'      => 'custom_style',
                            'operator'  => '==',
                            'value'     => 'yes',
                        ],
                    ],
                ],
            ]
        );

        // single slide item button background color
        $sliderItem->add_control(
            'mt_single_slide_button_background_color',
            [
                'label'         => __( 'Button Background Color', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .tt-slider-area {{CURRENT_ITEM}} .slider-btn a' => 'background-color: {{VALUE}}',
                ],
                'conditions'    => [
                    'terms'     => [
                        [
                            'name'      => 'custom_style',
                            'operator'  => '==',
                            'value'     => 'yes',
                        ],
                    ],
                ],
            ]
        );

        // single slide item button border color
        $sliderItem->add_control(
            'mt_single_slide_button_border_color',
            [
                'label'     => __( 'Button Border Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#766556',
                'selectors' => [
                    '{{WRAPPER}} .tt-slider-area {{CURRENT_ITEM}} .slider-btn a' => 'border-color: {{VALUE}};'
                ],
                'conditions'    => [
                    'terms'     => [
                        [
                            'name'      => 'custom_style',
                            'operator'  => '==',
                            'value'     => 'yes',
                        ],
                    ],
                ]                
            ]
        );

        // single slide item button hover color
        $sliderItem->add_control(
            'mt_single_slide_button_hover_text_color',
            [
                'label'         => __( 'Button Text Color(hover)', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '#ffffff',
                'selectors'     => [
                    '{{WRAPPER}} .tt-slider-area {{CURRENT_ITEM}} .slider-btn a:hover' => 'color: {{VALUE}};',
                ],
                'conditions'    => [
                    'terms'     => [
                        [
                            'name'      => 'custom_style',
                            'operator'  => '==',
                            'value'     => 'yes',
                        ],
                    ],
                ],
            ]
        );


        // single slide item button hover background color
        $sliderItem->add_control(
            'mt_single_slide_button_hover_background_color',
            [
                'label'         => __( 'Button Background Color(hover)', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '#766556',
                'selectors'     => [
                    '{{WRAPPER}} .tt-slider-area {{CURRENT_ITEM}} .slider-btn a:hover' => 'background-color: {{VALUE}};',
                ],
                'conditions'    => [
                    'terms'     => [
                        [
                            'name'      => 'custom_style',
                            'operator'  => '==',
                            'value'     => 'yes',
                        ],
                    ],
                ],
            ]
        );

        // single slide item button hover border color
        $sliderItem->add_control(
            'mt_single_slide_button_hover_border_color',
            [
                'label'     => __( 'Button Border Color(hover)', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#766556',
                'selectors' => [
                    '{{WRAPPER}} .tt-slider-area {{CURRENT_ITEM}} .slider-btn a:hover' => 'border-color: {{VALUE}};'
                ],
                'conditions'    => [
                    'terms'     => [
                        [
                            'name'      => 'custom_style',
                            'operator'  => '==',
                            'value'     => 'yes',
                        ],
                    ],
                ]
            ]
        );

        // single slide item heading typography
         $sliderItem->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label'         => __( 'Heading Typography', 'exclusive-addons-elementor' ),
                'name'          => 'slider_heading_typography',
                'scheme'        => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'default'       => '#ffffff', 
                'selector'      => '{{WRAPPER}} {{CURRENT_ITEM}} .nivo-slide-inner h4'
            ]
        );

        // single slide item content typography
         $sliderItem->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label'         => __( 'Details Typography', 'exclusive-addons-elementor' ),
                'name'          => 'slider_details_typography',
                'scheme'        => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'default'       => '#ffffff', 
                'selector'      => '{{WRAPPER}} {{CURRENT_ITEM}} .nivo-slide-inner p'
            ]
        );

        $sliderItem->end_controls_tab();

        $sliderItem->end_controls_tabs();

        $this->add_control(
            'exad_slides',
            [
                'label'         => __( 'Slides', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::REPEATER,
                'show_label'    => true,
                'default'       => [
                    [
						'exad_slider_title'   => __( 'Slider Title 1', 'exclusive-addons-elementor' )
                    ],
                    [
						'exad_slider_title'   => __( 'Slider Title 2', 'exclusive-addons-elementor' )
                    ],
                    [
						'exad_slider_title'   => __( 'Slider Title 3', 'exclusive-addons-elementor' )
                    ]
                ],
                'fields'            => array_values( $sliderItem->get_controls() ),
                'title_field'       => '{{{ exad_slider_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_slider_container_style',
            [
                'label' => __( 'Container', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_slider_full_screen_size',
            [
                'label'         => __( 'Height Full Screen?', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'		=> 'no',
                'return_value'  => 'yes',
                'description'   => __( 'Set your slider fullscreen.', 'exclusive-addons-elementor' )
            ]
        );

		$this->add_responsive_control(
			'exad_slider_height',
			[
				'label'  => __( 'Custom Height', 'exclusive-addons-elementor' ),
				'type'   => Controls_Manager::SLIDER,
				'range'  => [
					'px' => [
						'min' => 100,
						'max' => 1000
					],
					'vh' => [
						'min' => 10,
						'max' => 100
					]
				],
				'default'  => [
					'size' => 600,
					'unit' => 'px'
				],
				'size_units' => [ 'px', 'vh', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .exad-each-slider-item.slick-slide' => 'height: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'exad_slider_full_screen_size!' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'content_max_width',
			[
				'label' => __( 'Content Width', 'exclusive-addons-elementor' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px'    => [
						'min' => 0,
						'max' => 1000
					],
					'%' 	=> [
						'min' => 0,
						'max' => 100
					]
				],
				'size_units' => [ '%', 'px' ],
				'default'    => [
					'size' => '66',
					'unit' => '%'
				],
				'tablet_default' => [
					'unit' => '%'
				],
				'mobile_default' => [
					'unit' => '%'
				],
				'selectors' => [
					'{{WRAPPER}} .exad-slider-content' => 'max-width: {{SIZE}}{{UNIT}};'
				]
			]
		);

        $this->end_controls_section();

    }
  
    protected function render() {
		$settings             = $this->get_settings_for_display();
		$exadSliderControls   = ['exad-slider'];
		$exadSliderControls[] = $settings['exad_slider_full_screen_size'] == 'yes' ? 'fullscreen' : '';

		if(is_array($settings['exad_slides'])):
			echo '<div class="'.implode(" ",$exadSliderControls).'">';
				foreach($settings['exad_slides'] as $each_slide):
					echo '<div class="exad-each-slider-item elementor-repeater-item-'.esc_attr($each_slide['_id']).'">';
						echo '<div class="exad-slide-bg"></div>';
						echo '<div class="exad-slide-inner">';
							echo '<div class="exad-slide-content">';
								echo $each_slide['exad_slider_title'] ? '<h2>'.esc_html($each_slide['exad_slider_title']).'</h2>' : '';
								echo $each_slide['exad_slider_details'] ? wpautop(wp_kses_post($each_slide['exad_slider_details'])) : '';

								if ( ! empty( $each_slide['exad_slider_button_text'] ) ) :
								    if ( $each_slide['exad_slider_button_url']['url'] ) {
								        $href = 'href="'.esc_url($each_slide['exad_slider_button_url']['url']).'"';
								    } else {
								        $href = '';
								    }
								    if ( $each_slide['exad_slider_button_url']['is_external'] === 'on' ) {
								        $target = ' target= _blank';
								    } else {
								        $target = '';
								    }
								    if ( $each_slide['exad_slider_button_url']['nofollow'] === 'on' ) {
								        $target .= ' rel= nofollow ';
								    }
								    echo '<div class="exad-slider-btn">';
								        echo '<a '.$href.esc_attr($target).'>'.esc_html($each_slide['exad_slider_button_text']).'</a>';
								    echo '</div>';
								endif;

			    			echo '</div>';
		    			echo '</div>';
		    		echo '</div>';
				endforeach;
			echo '</div>';
		endif;



    }

}

Plugin::instance()->widgets_manager->register_widget_type( new ExclusiveSliderItem() );