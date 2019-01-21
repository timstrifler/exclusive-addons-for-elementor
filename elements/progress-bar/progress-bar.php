<?php
namespace Elementor;

class Exad_Progress_Bar extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-progress-bar';
	}
	public function get_title() {
		return esc_html__( 'DC Progress Bar', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'fa fa-user-circle';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_script_depends() {
		return [ 'elementor-waypoints' ];
	}

	protected function _register_controls() {
		/*-----------------------------------------------------------------------------------*/
		/*  CONTENT TAB
        /*-----------------------------------------------------------------------------------*/

		/**
		 * Content Tab: Layout
		 */
		$this->start_controls_section(
			'progress_bar_section_layout',
			[
				'label' => __('Layout', 'exclusive-addons-elementor'),
			]
		);

		$this->add_control(
			'exad_progress_bar_preset',
			[
				'label' => __('Layout', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'line-1' => __('Line Style 1', 'exclusive-addons-elementor'),
					'line-2' => __('Line Style 2 (Pro)', 'exclusive-addons-elementor'),
					'circle' => __('Circle Style', 'exclusive-addons-elementor'),
					'circle-fill' => __('Circle Fill Style', 'exclusive-addons-elementor'),
					'circle-half' => __('Half Circle Style', 'exclusive-addons-elementor'),
					'cylinder' => __('Cylinder Style', 'exclusive-addons-elementor'),
				],
				'default' => 'line-1',
			]
		);


        $this->add_control(
            'eael_pricing_table_style_pro_alert',
            [
                'label' => esc_html__( 'Only available in pro version!', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

		$this->add_control(
			'exad_progress_bar_title',
			[
				'label' => __('Title', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Progress Bar', 'exclusive-addons-elementor'),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'progress_bar_title_html_tag',
			[
				'label' => __('Title HTML Tag', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => __('H1', 'exclusive-addons-elementor'),
					'h2' => __('H2', 'exclusive-addons-elementor'),
					'h3' => __('H3', 'exclusive-addons-elementor'),
					'h4' => __('H4', 'exclusive-addons-elementor'),
					'h5' => __('H5', 'exclusive-addons-elementor'),
					'h6' => __('H6', 'exclusive-addons-elementor'),
					'div' => __('div', 'exclusive-addons-elementor'),
					'span' => __('span', 'exclusive-addons-elementor'),
					'p' => __('p', 'exclusive-addons-elementor'),
				],
				'default' => 'div',
			]
		);

		$this->add_control(
			'exad_progress_bar_value',
			[
				'label' => __('Counter Value', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .exad-progerss-bar-fill-line-1' => 'width: {{SIZE}}{{UNIT}}',
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'exad_progress_bar_show_count',
			[
				'label' => esc_html__('Display Count', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'progress_bar_animation_duration',
			[
				'label' => __('Animation Duration', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1000,
						'max' => 10000,
						'step' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1500,
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'progress_bar_prefix_label',
			[
				'label' => __('Prefix Label', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Prefix', 'exclusive-addons-elementor'),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'progress_bar_postfix_label',
			[
				'label' => __('Postfix Label', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Postfix', 'exclusive-addons-elementor'),
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eael_section_pro',
			[
				'label' => __('Go Premium for More Features', 'exclusive-addons-elementor'),
			]
		);

		$this->add_control(
			'eael_control_get_pro',
			[
				'label' => __('Unlock more possibilities', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'title' => __('', 'exclusive-addons-elementor'),
						'icon' => 'fa fa-unlock-alt',
					],
				],
				'default' => '1',
				'description' => '<span class="pro-feature"> Get the  <a href="https://essential-addons.com/elementor/buy.php" target="_blank">Pro version</a> for more stunning elements and customization options.</span>',
			]
		);

		$this->end_controls_section();

		/*-----------------------------------------------------------------------------------*/
		/*  STYLE TAB
        /*-----------------------------------------------------------------------------------*/

		/**
		 * Style Tab: General(Line)
		 */
		$this->start_controls_section(
			'progress_bar_section_style_general_line',
			[
				'label' => __('General', 'exclusive-addons-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		/*$this->add_control(
			'progress_bar_line_bg_color',
			[
				'label' => __('Background Color', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .exad-progerss-bar-bg-line-1' => 'background-color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		); */

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'progress_bar_line_fill_color',
				'label' => __('Fill Color', 'exclusive-addons-elementor'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .exad-progerss-bar-fill-line-1',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'progress_bar_line_bg_color',
			[
				'label' => __('Background Color', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .exad-progerss-bar-bg-line-1' => 'background-color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'progress_bar_line_height',
			[
				'label' => __('Height', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 12,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-progerss-bar-bg-line-1' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'exad_progress_bar_rounded',
			[
				'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .exad-progerss-bar-bg-line-1, {{WRAPPER}} .exad-progerss-bar-fill-line-1' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->add_control(
			'progress_bar_line_alignment',
			[
				'label' => __('Alignment', 'exclusive-addons-elementor'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'exclusive-addons-elementor'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'exclusive-addons-elementor'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'exclusive-addons-elementor'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Background
		 */
		$this->start_controls_section(
			'progress_bar_section_style_bg',
			[
				'label' => __('Background', 'exclusive-addons-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
				
			]
		);

		$this->add_control(
			'progress_bar_line_width',
			[
				'label' => __('Width', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1500,
						'step' => 1,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .eael-progressbar-line-container' => 'width: {{SIZE}}{{UNIT}}',
				],
				
			]
		);

		

		

		$this->end_controls_section();

		/**
		 * Style Tab: Fill
		 */
		$this->start_controls_section(
			'progress_bar_section_style_fill',
			[
				'label' => __('Fill', 'exclusive-addons-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'progress_bar_line_fill_height',
			[
				'label' => __('Height', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 12,
				],
				'selectors' => [
					'{{WRAPPER}} .eael-progressbar-line-fill' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		

		$this->add_control(
			'progress_bar_line_fill_stripe',
			[
				'label' => __('Show Stripe', 'exclusive-addons-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'progress_bar_line_fill_stripe_animate',
			[
				'label' => __('Stripe Animation', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'normal' => __('Left To Right', 'plugin-domain'),
					'reverse' => __('Right To Left', 'plugin-domain'),
					'none' => __('Disabled', 'plugin-domain'),
				],
				'default' => 'none',
				'condition' => [
					'progress_bar_line_fill_stripe' => 'yes',
				],
			]
		);

		$this->end_controls_section();

        /**
         * Style Tab: General(Circle)
         */
        $this->start_controls_section(
            'progress_bar_section_style_general_circle',
            [
                'label' => __('General', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );



        $this->add_control(
            'progress_bar_circle_alignment',
            [
                'label' => __('Alignment', 'exclusive-addons-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'exclusive-addons-elementor'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'exclusive-addons-elementor'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'exclusive-addons-elementor'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
            ]
        );

        $this->add_control(
            'progress_bar_circle_size',
            [
                'label' => __('Size', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eael-progressbar-circle' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eael-progressbar-half-circle' => 'width: {{SIZE}}{{UNIT}}; height: calc({{SIZE}} / 2 * 1{{UNIT}});',
                    '{{WRAPPER}} .eael-progressbar-half-circle-after' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eael-progressbar-circle-shadow' => 'width: calc({{SIZE}}{{UNIT}} + 20px); height: calc({{SIZE}}{{UNIT}} + 20px);',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'progress_bar_circle_bg_color',
            [
                'label' => __('Background Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eael-progressbar-circle-inner' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'progress_bar_circle_stroke_width',
            [
                'label' => __('Stroke Width', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 12,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eael-progressbar-circle-inner' => 'border-width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .eael-progressbar-circle-half' => 'border-width: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'progress_bar_circle_stroke_color',
            [
                'label' => __('Stroke Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#eee',
                'selectors' => [
                    '{{WRAPPER}} .eael-progressbar-circle-inner' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'progress_bar_circle_fill_color',
            [
                'label' => __('Fill Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .eael-progressbar-circle-half' => 'border-color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'progress_bar_circle_box_shadow',
                'label' => __('Box Shadow', 'exclusive-addons-elementor'),
                'selector' => '{{WRAPPER}} .eael-progressbar-circle-shadow',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

		/**
		 * Style Tab: Typography
		 */
		$this->start_controls_section(
			'progress_bar_section_style_typography',
			[
				'label' => __('Typography', 'exclusive-addons-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'progress_bar_title_typography',
				'label' => __('Title', 'exclusive-addons-elementor'),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .eael-progressbar-title',
			]
		);

		$this->add_control(
			'progress_bar_title_color',
			[
				'label' => __('Title Color', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eael-progressbar-title' => 'color: {{VALUE}}',
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'progress_bar_count_typography',
				'label' => __('Counter', 'exclusive-addons-elementor'),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .eael-progressbar-count-wrap',
			]
		);

		$this->add_control(
			'progress_bar_count_color',
			[
				'label' => __('Counter Color', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eael-progressbar-count-wrap' => 'color: {{VALUE}}',
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'progress_bar_after_typography',
				'label' => __('Prefix/Postfix', 'exclusive-addons-elementor'),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .eael-progressbar-half-circle-after span',
			]
		);

		$this->add_control(
			'progress_bar_after_color',
			[
				'label' => __('Prefix/Postfix Color', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eael-progressbar-half-circle-after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
		
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		
	
		?>

		<div class="exad-single-progress-bar-wrapper" id="progress-style-one-1">
            <div class="exad-progress-content">
                <p class="exad-progress-title">Design</p>
                <p class="exad-progress-count-container"><span class="number-percentage" data-value="60"
                                data-animation-duration="3500">0</span>%</p>
            </div>
            <div class="exad-progress-bar-outer">
                <div class="exad-progress-bar-track">
                	<?php if ( 'line-2' == $settings['exad_progress_bar_preset'] ) : ?>
                    <p class="exad-progress-count-container"><span class="number-percentage" data-value="60"
                            data-animation-duration=3500>0</span>%</p>
                    <?php endif; ?>        
                </div>
            </div><!-- .exad-progress-bar-outer END -->
        </div><!-- .exad-single-progress-bar-wraper two END -->
		
		
	<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Progress_Bar() );