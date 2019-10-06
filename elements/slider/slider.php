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
        return [ 'jquery-slick', 'exad-slick-animation' ];
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


        $sliderItem->add_control(
            'exad_slider_bg_overlay',
            [
                'label'        => __( 'Background Overlay', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        $sliderItem->add_control(
            'exad_slider_bg_overlay_color',
            [
                'label'      => __( 'Color', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::COLOR,
                'default'    => 'rgba(0,0,0,0.5)',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'exad_slider_bg_overlay',
                            'value' => 'yes'
                        ]
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .exad-slider-bg-overlay' => 'background-color: {{VALUE}}'
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
                'label_block'   => true,
                'default'       => __( 'Exclusive Addon Slider Title...', 'exclusive-addons-elementor' )
            ]
        );

        $sliderItem->add_control(
            'exad_slider_details',
            [
                'label'         => __( 'Details', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::TEXTAREA,
                'default'       => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'exclusive-addons-elementor' ),
            ]
        );

        $sliderItem->add_control(
            'exad_slider_button_text',
            [
                'label'         => __( 'Button Text', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'READ MORE', 'exclusive-addons-elementor' )
            ]
        );

        $sliderItem->add_control(
            'exad_slider_button_url',
            [
                'label'         => __( 'Link', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
                'show_external' => true,
				'default' 		=> [
					'url'         => '#',
					'is_external' => true
				],
                'placeholder'   => __( 'http://your-link.com', 'exclusive-addons-elementor' )
            ]
        );

        $sliderItem->end_controls_tab();

        $sliderItem->start_controls_tab( 'style', [ 'label' => __( 'Style', 'exclusive-addons-elementor' ) ] );

        // custom style for single slide item
        $sliderItem->add_control(
            'exad_single_slider_custom_style',
            [
                'label'         => __( 'Custom', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'return_value'  => 'yes',
                'description'   => __( 'Set custom style that will only affect this specific slide item.', 'exclusive-addons-elementor' )
            ]
        );
		

        $sliderItem->add_control(
            'exad_single_slider_title_position',
            [
                'label'     => esc_html__( 'Position', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'exad_single_slider_custom_style' => 'yes'
                ]
            ]
        );

		$sliderItem->add_control(
	        'exad_single_slider_horizontal_position',
	        [
	            'label'       => __( 'Horizontal Position', 'exclusive-addons-elementor' ),
	            'type'        => Controls_Manager::CHOOSE,
	            'label_block' => false,
	            'options'     => [
	                'flex-start' => [
	                    'title'  => __( 'Left', 'exclusive-addons-elementor' ),
	                    'icon'   => 'eicon-h-align-left'
	                ],
	                'center'     => [
	                    'title'  => __( 'Center', 'exclusive-addons-elementor' ),
	                    'icon'   => 'eicon-h-align-center'
	                ],
	                'flex-end'   => [
	                    'title'  => __( 'Right', 'exclusive-addons-elementor' ),
	                    'icon'   => 'eicon-h-align-right'
	                ]
	            ],
	            'selectors'      => [
	                '{{WRAPPER}} .exad-slider {{CURRENT_ITEM}} .exad-slide-inner' => 'justify-content: {{VALUE}}; -webkit-justify-content: {{VALUE}};'
	            ],
	            'condition'     => [
	                'exad_single_slider_custom_style' => 'yes'
	            ]
	        ]
	    );

        $sliderItem->add_control(
         	'exad_single_slider_vertical_position',
         	[
             	'label'       => __( 'Vertical Position', 'exclusive-addons-elementor' ),
             	'type'        => Controls_Manager::CHOOSE,
             	'label_block' => false,
             	'options'     => [
	                'flex-start' => [
	                    'title'  => __( 'Top', 'exclusive-addons-elementor' ),
	                    'icon'   => 'eicon-v-align-top'
	                ],
	                'center'    => [
	                    'title' => __( 'Middle', 'exclusive-addons-elementor' ),
	                    'icon'  => 'eicon-v-align-middle'
	                ],
	                'flex-end'  => [
	                    'title' => __( 'Bottom', 'exclusive-addons-elementor' ),
	                    'icon'  => 'eicon-v-align-bottom'
	                ]
	            ],
	            'selectors'     => [
	                '{{WRAPPER}} .exad-slider {{CURRENT_ITEM}} .exad-slide-inner' => 'align-items: {{VALUE}}; -webkit-align-items: {{VALUE}};'
	            ],
	            'condition'     => [
	                'exad_single_slider_custom_style' => 'yes'
	            ]
	        ]
        );

		$sliderItem->add_control(
			'exad_single_slider_text_align',
			[
				'label'       => __( 'Text Align', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
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
				'selectors'     => [
					'{{WRAPPER}} .exad-slider {{CURRENT_ITEM}} .exad-slide-inner' => 'text-align: {{VALUE}}'
				],
	            'condition'     => [
	                'exad_single_slider_custom_style' => 'yes'
	            ]
			]
		);

        $sliderItem->add_control(
            'exad_single_slider_animation',
            [
                'label'     => esc_html__( 'Animation', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'exad_single_slider_custom_style' => 'yes'
                ]
            ]
        );

  		$sliderItem->add_control(
            'exad_single_slider_title_animation',
            [
                'label'         => __( 'Title', 'nivo-slider-elementor' ),
                'description'   => __( 'Select title animation style for this slide only.', 'nivo-slider-elementor' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'slideInDown',
                'options'       => [
                    ''              => __('None', 'nivo-slider-elementor'),
                    'slideInUp'     => __('slideInUp', 'nivo-slider-elementor'),
                    'slideInDown'   => __('slideInDown', 'nivo-slider-elementor'),
                    'slideInLeft'   => __('slideInLeft', 'nivo-slider-elementor'),
                    'slideInRight'  => __('slideInRight', 'nivo-slider-elementor')
                ],
                'condition'    => [
                    'exad_single_slider_custom_style' => 'yes'
                ]
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
						'exad_slider_title' => __( 'Slider Title 1', 'exclusive-addons-elementor' ),
						'exad_slider_bg'    => '#7448F6'
                    ],
                    [
						'exad_slider_title' => __( 'Slider Title 2', 'exclusive-addons-elementor' ),
						'exad_slider_bg'    => '#673AB7'
                    ],
                    [
						'exad_slider_title' => __( 'Slider Title 3', 'exclusive-addons-elementor' ),
						'exad_slider_bg'    => '#3F51B5'
                    ]
                ],
                'fields'            => array_values( $sliderItem->get_controls() ),
                'title_field'       => '{{{ exad_slider_title }}}',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'exad_slider_settings',
			[
				'label' => __( 'Settings', 'exclusive-addons-elementor' ),
			]
		);

        $this->add_control(
            'exad_slider_nav',
            [
                'label'   => esc_html__( 'Navigation', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'both',
                'options' => [
                    'arrows' => esc_html__( 'Arrows', 'exclusive-addons-elementor' ),
                    'dots'   => esc_html__( 'Dots', 'exclusive-addons-elementor' ),
                    'both'   => esc_html__( 'Arrows and Dots', 'exclusive-addons-elementor' ),
                    'none'   => esc_html__( 'None', 'exclusive-addons-elementor' )
                    
                ]
            ]
        );

        $this->add_control(
            'exad_slider_dots_type',
            [
                'label'   => esc_html__( 'Dots Type', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'dot-bullet',
                'options' => [
                    'dot-bullet' => esc_html__( 'Bullet', 'exclusive-addons-elementor' ),
                    'dot-image'  => esc_html__( 'Image', 'exclusive-addons-elementor' )
                    
                ],
                'condition' => [
                    'exad_slider_nav' => [ 'both', 'dots']
                ]
            ]
        );

        $this->add_control(
            'exad_slider_autoplay',
            [
                'label'     => esc_html__( 'Autoplay', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes'
            ]
        );

        $this->add_control(
            'exad_slider_pause_on_hover',
            [
				'label'        => esc_html__( 'Pause on Hover', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
                'condition' => [
                    'exad_slider_autoplay' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'exad_slider_loop',
            [
                'label'   => esc_html__( 'Infinite Loop', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'exad_slider_enable_fade',
            [
				'label'        => esc_html__( 'Enable Fade?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_slider_slide_vertically',
            [
				'label'        => esc_html__( 'Enable Vertical Slide Mode?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__( 'Default sliders are slide horizontally. By enabling this feature, the slider will be slide vertically.', 'exclusive-addons-elementor' ),
				'default'      => 'no',
				'return_value' => 'yes',
				'condition'	   => [
					'exad_slider_enable_fade!' => 'yes'
				]
            ]
        );

        $this->add_control(
            'exad_slider_enable_center_mode',
            [
				'label'        => esc_html__( 'Enable Center Mode?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__( 'Enables centered view with partial prev/next slides. Use with odd numbered slidesToShow counts.', 'exclusive-addons-elementor' ),
				'default'      => 'no',
				'return_value' => 'yes',
				'condition'	   => [
					'exad_slider_enable_fade!' => 'yes'
				]
            ]
        );

        $this->add_control(
            'exad_slider_progress_bar',
            [
                'type'          => Controls_Manager::SWITCHER,
                'label'         => __( 'Slider Progress Bar?', 'exclusive-addons-elementor' ),
                'default'       => 'no',
                'return_value'  => 'yes',
                'description'   => __('Progress bar in slider.', 'exclusive-addons-elementor')
            ]
        );

        $this->add_control(
            'exad_slider_autoplay_speed',
            [
                'label'     => esc_html__( 'Autoplay Speed(ms)', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5000,
				'selectors'  => [
					'{{WRAPPER}} .slick-active.slick-current .exad-slider-progressbar-active' => 'animation: exadSliderProgressbar {{SIZE}}ms ease-in-out;-moz-animation: exadSliderProgressbar {{SIZE}}ms ease-in-out;-ms-animation: exadSliderProgressbar {{SIZE}}ms ease-in-out;-webkit-animation: exadSliderProgressbar {{SIZE}}ms ease-in-out;'
				],
                'condition' => [
                    'exad_slider_autoplay' => 'yes'
                ]
            ]
        );

		$this->add_control(
            'exad_slider_transition_speed',
            [
                'label'   => esc_html__( 'Transition Speed(ms)', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 1000,
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
					'{{WRAPPER}} .slick-slide .exad-each-slider-item' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exad-each-slider-item.slick-slide' => 'height: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'exad_slider_full_screen_size!' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_slider_content_max_width',
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
					'size' => '65',
					'unit' => '%'
				],
				'tablet_default' => [
					'unit' => '%'
				],
				'mobile_default' => [
					'unit' => '%'
				],
				'selectors' => [
					'{{WRAPPER}} .exad-slide-content' => 'max-width: {{SIZE}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
            'exad_slider_content_padding',
            [
                'label'         => __( 'Padding', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'default'       => [
                    'top'       => 70,
                    'right'     => 55,
                    'bottom'    => 70,
                    'left'      => 55
                ],                
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                        '{{WRAPPER}} .exad-slide-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_responsive_control(
			'exad_slider_padding_in_centermode',
			[
				'label' => __( 'Center Mode Padding', 'exclusive-addons-elementor' ),
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
				'size_units' => ['px', '%' ],
				'default'    => [
					'size'   => '150',
					'unit'   => 'px'
				],
				'condition'  => [
					'exad_slider_enable_center_mode' => 'yes',
					'exad_slider_enable_fade!' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_slider_horizontal_position',
			[
				'label'       => __( 'Horizontal Position', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default'     => 'center',
				'options'     => [
					'flex-start'   => [
						'title'  => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'   => 'eicon-h-align-left'
					],
					'center' => [
						'title'  => __( 'Center', 'exclusive-addons-elementor' ),
						'icon'   => 'eicon-h-align-center'
					],
					'flex-end'  => [
						'title'  => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'   => 'eicon-h-align-right'
					]
				],
				'selectors'     => [
					'{{WRAPPER}} .exad-slider .exad-slide-inner' => 'justify-content: {{VALUE}}; -webkit-justify-content: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'exad_slider_vertical_position',
			[
				'label'       => __( 'Vertical Position', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default'     => 'center',
				'options'     => [
					'flex-start'    => [
						'title'  => __( 'Top', 'exclusive-addons-elementor' ),
						'icon'   => 'eicon-v-align-top'
					],
					'center' => [
						'title'  => __( 'Middle', 'exclusive-addons-elementor' ),
						'icon'   => 'eicon-v-align-middle'
					],
					'flex-end' => [
						'title'  => __( 'Bottom', 'exclusive-addons-elementor' ),
						'icon'   => 'eicon-v-align-bottom'
					]
				],
				'selectors'     => [
					'{{WRAPPER}} .exad-slider .exad-slide-inner' => 'align-items: {{VALUE}}; -webkit-align-items: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'exad_slider_text_align',
			[
				'label'       => __( 'Text Align', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default'     => 'center',
				'options'     => [
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
				'selectors'     => [
					'{{WRAPPER}} .exad-slide-inner' => 'text-align: {{VALUE}}'
				]
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_slider_content_style',
            [
                'label' => __( 'Content', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_slider_title_style',
            [
				'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'  => Controls_Manager::HEADING
            ]
        );

  		$this->add_control(
            'exad_slider_title_animation',
            [
                'label'         => __( 'Animation', 'nivo-slider-elementor' ),
                'description'   => __( 'Select title animation style for this slide only.', 'nivo-slider-elementor' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'slideInDown',
                'options'       => [
                    ''              => __('None', 'nivo-slider-elementor'),
                    'slideInUp'     => __('slideInUp', 'nivo-slider-elementor'),
                    'slideInDown'   => __('slideInDown', 'nivo-slider-elementor'),
                    'slideInLeft'   => __('slideInLeft', 'nivo-slider-elementor'),
                    'slideInRight'  => __('slideInRight', 'nivo-slider-elementor')
                ]
            ]
        );

		$this->add_control(
		    'exad_slider_title_color',
		    [
		        'label'     => __( 'Color', 'exclusive-addons-elementor' ),
		        'type'      => Controls_Manager::COLOR,
		        'default'	=> '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .exad-slide-content h2' => 'color: {{VALUE}};'
		        ]
		    ]
		);

		$this->add_control(
		    'exad_slider_title_bg_color',
		    [
		        'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .exad-slide-content h2' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name'		=> 'exad_slider_title_typography',
				'selector'	=> '{{WRAPPER}} .exad-slide-content h2'
			]
		);

        $this->add_responsive_control(
            'exad_slider_title_padding',
            [
				'label'      => __('Padding', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
                    '{{WRAPPER}} .exad-slide-content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_slider_title_margin',
            [
				'label'      => __('Margin', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
              	'default'       => [
                    'top'       => 0,
                    'right'     => 0,
                    'bottom'    => 20,
                    'left'      => 0
                ], 
                'selectors'             => [
                    '{{WRAPPER}} .exad-slide-content h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_group_control(
        	Group_Control_Border::get_type(),
            [
                'name'      => 'exad_slider_title_border',
                'label'     => esc_html__( 'Border', 'exclusive-addons-elementor' ),
                'selector'  => '{{WRAPPER}} .exad-slide-content h2'
            ]
        );

		$this->add_control(
			'exad_slider_title_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .exad-slide-content h2'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_slider_title_box_shadow',
				'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-slide-content h2'
			]
		);

        $this->add_control(
            'exad_slider_details_style',
            [
				'label'     => esc_html__( 'Details', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );

		$this->add_control(
		    'exad_slider_details_color',
		    [
		        'label'     => __( 'Color', 'exclusive-addons-elementor' ),
		        'type'      => Controls_Manager::COLOR,
		        'default'	=> '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .exad-slide-content p' => 'color: {{VALUE}};'
		        ]
		    ]
		);

		$this->add_control(
		    'exad_slider_details_bg_color',
		    [
		        'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .exad-slide-content p' => 'background-color: {{VALUE}};'
		        ]
		    ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name'		=> 'exad_slider_details_typography',
				'selector'	=> '{{WRAPPER}} .exad-slide-content p'
			]
		);

        $this->add_responsive_control(
            'exad_slider_details_padding',
            [
                'label'                 => __('Padding', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', '%'],
                'selectors'             => [
                    '{{WRAPPER}} .exad-slide-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_slider_details_margin',
            [
                'label'                 => __('Margin', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', '%'],
                'selectors'             => [
                    '{{WRAPPER}} .exad-slide-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_group_control(
        	Group_Control_Border::get_type(),
            [
                'name'      => 'exad_slider_details_border',
                'label'     => esc_html__( 'Border', 'exclusive-addons-elementor' ),
                'selector'  => '{{WRAPPER}} .exad-slide-content p'
            ]
        );

		$this->add_control(
			'exad_slider_details_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .exad-slide-content p'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_slider_details_box_shadow',
				'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-slide-content p'
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
            'exad_slider_btn_style_section',
            [
                'label'         => esc_html__( 'Button', 'exclusive-addons-elementor' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'exad_slider_btn_padding',
            [
                'label'         => __( 'Padding', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'default'       => [
                    'top'       => 12,
                    'right'     => 30,
                    'bottom'    => 12,
                    'left'      => 30
                ],                
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                        '{{WRAPPER}} .exad-slide-content a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_slider_btn_margin',
            [
                'label'         => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],                 
                'selectors'     => [
                        '{{WRAPPER}} .exad-slide-content a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'exad_slider_btn_typography',
                'selector'      => '{{WRAPPER}} .exad-slide-content a'
            ]
        );

        $this->start_controls_tabs( 'exad_slider_button_style_tabs' );

            // normal state tab
            $this->start_controls_tab( 'exad_slider_btn_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_slider_btn_normal_text_color',
                [
                    'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .exad-slide-content a' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_slider_btn_normal_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .exad-slide-content a' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

	       	$this->add_group_control(
	            Group_Control_Border::get_type(),
	            [
	                'name'            => 'exad_slider_btn_border',
	                'label'           => esc_html__( 'Border', 'exclusive-addons-elementor' ),
	                'selector'        => '{{WRAPPER}} .exad-slide-content a',
	                'fields_options'  => [
	                    'border' 	  => [
	                        'default' => 'solid'
	                    ],
	                    'width'  		 => [
	                        'default' 	 => [
	                            'top'    => '2',
	                            'right'  => '2',
	                            'bottom' => '2',
	                            'left'   => '2'
	                        ]
	                    ],
	                    'color' => [
	                        'default' => '#ffffff'
	                    ]
	                ]
	            ]
	        );

			$this->add_control(
				'exad_slider_button_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors'  => [
						'{{WRAPPER}} .exad-slide-content a'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'exad_slider_button_shadow',
                    'selector'  => '{{WRAPPER}} .exad-slide-content a',
                    'separator' => 'before'
                ]
            );

            $this->end_controls_tab();

            // hover state tab
            $this->start_controls_tab( 'exad_slider_btn_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_slider_btn_hover_text_color',
                [
                    'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .exad-slide-content a:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_slider_btn_hover_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .exad-slide-content a:hover' => 'background: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'exad_slider_btn_hover_border',
                    'label'    => esc_html__( 'Border', 'exclusive-addons-elementor' ),
                    'selector' => '{{WRAPPER}} .exad-slide-content a:hover'
                ]
            );

			$this->add_control(
				'exad_slider_button_border_radius_hover',
				[
					'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors'  => [
						'{{WRAPPER}} .exad-slide-content a:hover'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'exad_slider_button_hover_shadow',
                    'selector'  => '{{WRAPPER}} .exad-slide-content a:hover'
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section(); 

        $this->start_controls_section(
            'exad_slider_progressbar_style_section',
            [
                'label'     => __('Progressbar', 'exclusive-addons-elementor'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'terms'     => [
                        [
                            'name'      => 'exad_slider_progress_bar',
                            'operator'  => '==',
                            'value'     => 'yes'
                        ]
                    ]
                ]                
            ]
        );

        $this->add_control(
            'exad_slider_progressbar_color',
            [
                'label'         => __( 'Color', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::COLOR,
                'default'       => 'rgba(255, 255, 255, .7)',
                'selectors'     => [
                    '{{WRAPPER}} .slick-active.slick-current .exad-slider-progressbar-active' => 'background-color: {{VALUE}}'
                ]

            ]
        ); 

        $this->add_control(
            'exad_slider_progressbar_height',
            [
                'label'         => __( 'Height', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 7,
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 20,
                        'step'  => 1
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .slick-active.slick-current .exad-slider-progressbar-active' => 'height: {{SIZE}}{{UNIT}};',
                ],  
                'description'   => __( 'Default: 7px.', 'exclusive-addons-elementor' )            
            ]
        ); 

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_slider_arrow_controls_style_section',
            [
                'label'     => __('Arrow Controls', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_slider_nav'       => ['arrows', 'both']
                ]               
            ]
        );

        $this->add_control(
            'exad_slider_arrows_style',
            [
				'label'      => esc_html__( 'Arrows', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::HEADING
            ]
        );

        $this->add_control(
            'exad_slider_arrows_size',
            [
                'label'         => __( 'Size', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 35,
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 70,
                        'step'  => 1
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .exad-slider .slick-next:before,{{WRAPPER}} .exad-slider .slick-prev:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'exad_slider_arrow_width',
            [
                'label'         => __( 'Width', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 55,
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 200,
                        'step'  => 1
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .exad-slider .slick-next,{{WRAPPER}} .exad-slider .slick-prev' => 'width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'exad_slider_arrow_height',
            [
                'label'         => __( 'Height', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 95,
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 200,
                        'step'  => 1
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .exad-slider .slick-next,{{WRAPPER}} .exad-slider .slick-prev' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

		$this->start_controls_tabs( 'exad_slider_arrows_style_tabs' );

        	// normal state tab
        	$this->start_controls_tab( 'exad_slider_arrow_normal_style', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

		        $this->add_control(
		            'exad_slider_arrows_color',
		            [
		                'label'         => __( 'Color', 'exclusive-addons-elementor' ),
		                'type'          => Controls_Manager::COLOR,
		                'default'       => '#ffffff',
		                'selectors'     => [
		                    '{{WRAPPER}} .exad-slider .slick-next:before,{{WRAPPER}} .exad-slider .slick-prev:before' => 'color: {{VALUE}}'
		                ]          
		            ]
		        );

		        $this->add_control(
		            'exad_slider_arrows_bg_color',
		            [
		                'label'         => __( 'Background Color', 'exclusive-addons-elementor' ),
		                'type'          => Controls_Manager::COLOR,
		                'default'       => 'rgba(255, 255, 255, .3)',
		                'selectors'     => [
		                    '{{WRAPPER}} .exad-slider .slick-next,{{WRAPPER}} .exad-slider .slick-prev' => 'background-color: {{VALUE}}'
		                ]            
		            ]
		        );

		        $this->add_group_control(
		        	Group_Control_Border::get_type(),
		            [
		                'name'      => 'exad_slider_arrows_border',
		                'label'     => esc_html__( 'Border', 'exclusive-addons-elementor' ),
		                'selector'  => '{{WRAPPER}} .exad-slider .slick-next,{{WRAPPER}} .exad-slider .slick-prev'
		            ]
		        );

				$this->add_control(
					'exad_slider_arrows_border_radius',
					[
						'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px'],
						'selectors'  => [
							'{{WRAPPER}} .exad-slider .slick-next,{{WRAPPER}} .exad-slider .slick-prev'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						],
                        'default'       => [
                            'top'       => 0,
                            'right'     => 0,
                            'bottom'    => 0,
                            'left'      => 0
                        ] 
					]
				);

			$this->end_controls_tab();


        	// hover state tab
        	$this->start_controls_tab( 'exad_slider_arrow_hover_style', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

		        $this->add_control(
		            'exad_slider_arrows_hover_color',
		            [
		                'label'         => __( 'Color', 'exclusive-addons-elementor' ),
		                'type'          => Controls_Manager::COLOR,
		                'selectors'     => [
		                    '{{WRAPPER}} .exad-slider .slick-next:hover:before,{{WRAPPER}} .exad-slider .slick-prev:hover:before' => 'color: {{VALUE}}'
		                ]          
		            ]
		        );

		        $this->add_control(
		            'exad_slider_arrows_hover_bg_color',
		            [
		                'label'         => __( 'Background Color', 'exclusive-addons-elementor' ),
		                'type'          => Controls_Manager::COLOR,
		                'selectors'     => [
		                    '{{WRAPPER}} .exad-slider .slick-next:hover,{{WRAPPER}} .exad-slider .slick-prev:hover' => 'background-color: {{VALUE}}'
		                ]          
		            ]
		        );

		        $this->add_group_control(
		        	Group_Control_Border::get_type(),
		            [
		                'name'      => 'exad_slider_arrows_hover_border',
		                'label'     => esc_html__( 'Border', 'exclusive-addons-elementor' ),
		                'selector'  => '{{WRAPPER}} .exad-slider .slick-next:hover,{{WRAPPER}} .exad-slider .slick-prev:hover'
		            ]
		        );


				$this->add_control(
					'exad_slider_arrows_hover_border_radius',
					[
						'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px'],
						'selectors'  => [
							'{{WRAPPER}} .exad-slider .slick-next:hover,{{WRAPPER}} .exad-slider .slick-prev:hover'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);

			$this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_slider_dot_image_controls_style_section',
            [
                'label'     => __('Dots Thumbnail', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_slider_nav'       => ['dots', 'both'],
                    'exad_slider_dots_type' => 'dot-image'
                ]                
            ]
        );

        $this->add_responsive_control(
            'exad_slider_dot_image_padding',
            [
                'label'      => __('Padding', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-slider.dot-image ul.slick-dots li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_slider_dot_image_margin',
            [
                'label'      => __('Margin', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'       => [
                    'top'       => 10,
                    'right'     => 10,
                    'bottom'    => 0,
                    'left'      => 10
                ], 
                'selectors'             => [
                    '{{WRAPPER}} .exad-slider.dot-image ul.slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_slider_dot_image_height',
            [
                'label'  => __( 'Height', 'exclusive-addons-elementor' ),
                'type'   => Controls_Manager::SLIDER,
                'range'  => [
                    'px' => [
                        'min' => 50,
                        'max' => 5000
                    ]
                ],
                'default'  => [
                    'size' => 100,
                    'unit' => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-slider .slick-dots li a' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_slider_dot_image_width',
            [
                'label'  => __( 'Width', 'exclusive-addons-elementor' ),
                'type'   => Controls_Manager::SLIDER,
                'range'  => [
                    'px' => [
                        'min' => 50,
                        'max' => 5000
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-slider .slick-dots li a' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'exad_slider_dot_image_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-slider .slick-dots li a img'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_slider_dot_bullet_controls_style_section',
            [
                'label'     => __('Dots Bullet', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_slider_nav'       => ['dots', 'both'],
                    'exad_slider_dots_type' => 'dot-bullet'
                ]                
            ]
        );

        $this->add_responsive_control(
            'exad_slider_dot_bullet_margin',
            [
                'label'      => __('Margin', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'       => [
                    'top'       => 0,
                    'right'     => 10,
                    'bottom'    => 0,
                    'left'      => 0
                ], 
                'selectors'             => [
                    '{{WRAPPER}} .exad-slider.dot-bullet ul.slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->start_controls_tabs( 'exad_slider_dot_bullet_style_tabs' );

        // normal state tab
        $this->start_controls_tab( 'exad_slider_dot_bullet_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

            $this->add_responsive_control(
                'exad_slider_dot_bullet_size',
                [
                    'label'  => __( 'Size', 'exclusive-addons-elementor' ),
                    'type'   => Controls_Manager::SLIDER,
                    'range'  => [
                        'px' => [
                            'min' => 10,
                            'max' => 100
                        ]
                    ],
                    'default'  => [
                        'size' => 10,
                        'unit' => 'px'
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .exad-slider.dot-bullet ul.slick-dots li' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_slider_dot_bullet_color',
                [
                    'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => 'rgba(255, 255, 255, .3)',
                    'selectors' => [
                        '{{WRAPPER}} .exad-slider.dot-bullet ul.slick-dots li' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'            => 'exad_slider_dot_bullet_border',
                    'label'           => esc_html__( 'Border', 'exclusive-addons-elementor' ),
                    'selector'        => '{{WRAPPER}} .exad-slider.dot-bullet ul.slick-dots li',
                ]
            );

            $this->add_control(
                'exad_slider_dot_bullet_border_radius',
                [
                    'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'default'    => [
                        'top'    => 100,
                        'right'  => 100,
                        'bottom' => 100,
                        'left'   => 100,
                        'unit'   => '%'
                    ],                
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .exad-slider.dot-bullet ul.slick-dots li'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->end_controls_tab();

            // active state tab
            $this->start_controls_tab( 'exad_slider_dot_bullet_active', [ 'label' => esc_html__( 'Active', 'exclusive-addons-elementor' ) ] );

            $this->add_responsive_control(
                'exad_slider_dot_bullet_active_size',
                [
                    'label'  => __( 'Size', 'exclusive-addons-elementor' ),
                    'type'   => Controls_Manager::SLIDER,
                    'range'  => [
                        'px' => [
                            'min' => 10,
                            'max' => 100
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .exad-slider.dot-bullet ul.slick-dots li.slick-active' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_slider_dot_bullet_active_color',
                [
                    'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => 'rgba(255, 255, 255, 1)',
                    'selectors' => [
                        '{{WRAPPER}} .exad-slider.dot-bullet ul.slick-dots li.slick-active' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'            => 'exad_slider_dot_bullet_active_border',
                    'label'           => esc_html__( 'Border', 'exclusive-addons-elementor' ),
                    'selector'        => '{{WRAPPER}} .exad-slider.dot-bullet ul.slick-dots li.slick-active',
                ]
            );

            $this->add_control(
                'exad_slider_dot_bullet_active_border_radius',
                [
                    'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'default'    => [
                        'top'    => 100,
                        'right'  => 100,
                        'bottom' => 100,
                        'left'   => 100,
                        'unit'   => '%'
                    ],                
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .exad-slider.dot-bullet ul.slick-dots li.slick-active'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }
  
    protected function render() {
		$settings              = $this->get_settings_for_display();
		$exadSliderProgressbar = $settings['exad_slider_progress_bar'];
		$pauseOnHover          = $settings['exad_slider_pause_on_hover'];

		$exadSliderControls    = ['exad-slider'];
		$exadSliderControls[]  = $settings['exad_slider_full_screen_size'] == 'yes' ? 'fullscreen' : '';

		$title_animation   = $settings['exad_slider_title_animation'];

		$bar   = ( $exadSliderProgressbar == 'yes' ) ? 'active' : 'inactive';

        if ( ( 'both' || 'dots' ) == $settings['exad_slider_nav'] ) {
            $exadSliderControls[] = $settings['exad_slider_dots_type'];
        } else {
            $exadSliderControls[] = 'dot-hide';
        }

        $this->add_render_attribute(
            'exad_slider_controls',
            [
				'id'                => "exad-slider-{$this->get_id()}",
				'class'             => $exadSliderControls,
				'data-slider-nav'   => $settings['exad_slider_nav'],
				'data-slider-speed' => $settings['exad_slider_transition_speed']
            ]
        );

        if ( 'yes' == $settings['exad_slider_autoplay'] ) {
            $this->add_render_attribute( 'exad_slider_controls', 'data-autoplay', "true" );
            $this->add_render_attribute( 'exad_slider_controls', 'data-autoplayspeed', $settings['exad_slider_autoplay_speed'] );
	        if ( 'yes' == $settings['exad_slider_pause_on_hover'] ) {
	            $this->add_render_attribute( 'exad_slider_controls', 'data-pauseonhover', "true" );
	        }
        }
        if ( 'yes' == $settings['exad_slider_loop'] ) {
            $this->add_render_attribute( 'exad_slider_controls', 'data-loop', "true" );
        }
        if ( 'yes' == $settings['exad_slider_enable_fade'] ) {
            $this->add_render_attribute( 'exad_slider_controls', 'data-enable-fade', "true" );
        } else {
	        if ( 'yes' == $settings['exad_slider_slide_vertically'] ) {
	            $this->add_render_attribute( 'exad_slider_controls', 'data-slide-vertically', "true" );
	        } 
	        if ( 'yes' == $settings['exad_slider_enable_center_mode'] ) {
	            $this->add_render_attribute( 'exad_slider_controls', 'data-centermode', "true" );
	            $centerModePadding = $settings['exad_slider_padding_in_centermode']['size'];
	            $centerModePadding .= $settings['exad_slider_padding_in_centermode']['unit'];
	            $this->add_render_attribute( 'exad_slider_controls', 'data-centermode-padding', $centerModePadding );
	        }        	
        }

        if ( ( 'dots' == $settings['exad_slider_nav'] ) || ( 'both' == $settings['exad_slider_nav'] ) ) {
            $this->add_render_attribute( 'exad_slider_controls', 'data-dots-type', $settings['exad_slider_dots_type'] );
        }

		if(is_array($settings['exad_slides'])):
			echo '<div '.$this->get_render_attribute_string( 'exad_slider_controls' ).'">';
				foreach($settings['exad_slides'] as $each_slide):
                    $each_title_animation = $each_slide['exad_single_slider_title_animation'];
                    if( empty($each_title_animation) ){
                        $each_title_animation = $title_animation;
                    }
					echo '<div class="exad-each-slider-item elementor-repeater-item-'.esc_attr($each_slide['_id']).'" data-image="'.esc_url($each_slide['exad_slider_img']['url']).'">';
						echo '<div class="exad-slider-progressbar-'.esc_attr($bar).'"></div>';
                        if ( 'yes' === $each_slide['exad_slider_bg_overlay'] ) {
                            echo '<div class="exad-slider-bg-overlay"></div>';
                        }
						echo '<div class="exad-slide-bg"></div>';
						echo '<div class="exad-slide-inner">';
							echo '<div class="exad-slide-content">';
								// echo $each_slide['exad_slider_title'] ? '<h2 class="wow animated '.esc_attr($each_title_animation).'" data-wow-duration=".5s" data-wow-delay=".5s">'.esc_html($each_slide['exad_slider_title']).'</h2>' : '';

// echo $each_slide['exad_slider_title'] ? '<h2 data-animation-in="fadeIn" data-delay-in="1" data-duration-in="1" data-animation-out="fadeInDown" data-delay-out="1" data-duration-out="1">'.esc_html($each_slide['exad_slider_title']).'</h2>' : '';
?>
                            <h2 data-animation-in="fadeInDown" data-delay-in=".4" data-duration-in=".4" data-animation-out="fadeOutUp" data-delay-out="3" data-duration-out=".5">Registration</h2>
                                <?php
								// echo $each_slide['exad_slider_details'] ? '<p class="wow animated slideInUp" data-wow-duration="1s" data-wow-delay=".5s">'.wp_kses_post($each_slide['exad_slider_details']).'</p>' : '';

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
								        // echo '<a class="animated slideInUp" data-wow-duration="1.5s" data-wow-delay=".5s" '.$href.esc_attr($target).'>'.esc_html($each_slide['exad_slider_button_text']).'</a>';
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