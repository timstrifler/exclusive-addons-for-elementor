<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Icons_Manager;
use \Elementor\Widget_Base;

class News_Ticker extends Widget_Base {

    public function get_name() {
        return 'exad-news-ticker';
    }

    public function get_title() {
        return esc_html__( 'News Ticker', 'exclusive-addons-elementor' );
    }

    public function get_icon() {
        return 'exad exad-logo exad-news-ticker';
    }

    public function get_categories() {
        return [ 'exclusive-addons-elementor' ];
    }

    public function get_keywords() {
        return [ 'exclusive', 'bar', 'horizontal' ];
    }
    
    public function get_script_depends() {
        return [ 'exad-news-ticker' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'exad_news_ticker_all_items',
            [
                'label' => esc_html__( 'Items', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_news_ticker_label',
            [   
                'label'         => esc_html__( 'Label', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __('Today\'s Hot News', 'exclusive-addons-elementor' ),
                'label_block'     => true,
                'dynamic' => [
					'active' => true,
				]
            ]
        ); 

        $news_ticker_repeater = new Repeater();
        
        $news_ticker_repeater->add_control(
            'exad_news_ticker_title',
            [
                'label'   => esc_html__( 'Content', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'News item description', 'exclusive-addons-elementor' ),
                'dynamic' => [
					'active' => true,
				]
            ]
        );

        $news_ticker_repeater->add_control(
            'exad_news_ticker_link',
            [
                'label'           => esc_html__( 'Link', 'exclusive-addons-elementor' ),
                'type'            => Controls_Manager::URL,
                'label_block'     => true,
                'default'         => [
                    'url'         => '#',
                    'is_external' => ''
                ],
                'show_external'   => true
            ]
        );

        $this->add_control(
            'exad_news_ticker_items',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $news_ticker_repeater->get_controls(),
                'title_field' => '{{{ exad_news_ticker_title }}}',
                'default'     => [
                    [ 'exad_news_ticker_title' => __( 'Exclusive Elementor News item 1', 'exclusive-addons-elementor' ) ],
                    [ 'exad_news_ticker_title' => __( 'Exclusive Elementor News item 2', 'exclusive-addons-elementor' ) ],
                    [ 'exad_news_ticker_title' => __( 'Exclusive Elementor News item 3', 'exclusive-addons-elementor' ) ],
                    [ 'exad_news_ticker_title' => __( 'Exclusive Elementor News item 4', 'exclusive-addons-elementor' ) ],
                    [ 'exad_news_ticker_title' => __( 'Exclusive Elementor News item 5', 'exclusive-addons-elementor' ) ],
                    [ 'exad_news_ticker_title' => __( 'Exclusive Elementor News item 6', 'exclusive-addons-elementor' ) ]
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_news_ticker_settings',
            [
                'label' => esc_html__( 'Settings', 'exclusive-addons-elementor' )
            ]
        ); 

        $this->add_control(
            'exad_news_ticker_animation_direction',
            [
                'label'     => esc_html__( 'Direction', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'ltr',
                'options'   => [
                    'ltr'   => esc_html__( 'Left to Right', 'exclusive-addons-elementor' ),
                    'rtl'   => esc_html__( 'Right to Left', 'exclusive-addons-elementor' )
                ],
                'description'   => esc_html__('If you enable Right-to-left(RTL) in your website than by default it will be working in RTL and this option won\'t work.', 'exclusive-addons-elementor')

            ]
        ); 

        $this->add_control(
            'exad_news_ticker_set_fixed_position',
            [
                'type'         => Controls_Manager::SELECT,
                'label'        => esc_html__( 'Set Position', 'exclusive-addons-elementor' ),
				'default' => 'none',
				'options' => [
					'none'  => __( 'None', 'exclusive-addons-elementor' ),
					'fixed-top'  => __( 'Fixed Top', 'exclusive-addons-elementor' ),
					'fixed-bottom'  => __( 'Fixed Bottom', 'exclusive-addons-elementor' ),
				],
                'description'  => esc_html__('Stick the news ticker to the top or bottom of the page.', 'exclusive-addons-elementor')
            ]
        );

        $this->add_control(
            'exad_news_ticker_animation_type',
            [
                'label'     => esc_html__( 'Animation Type', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'scroll',
                'options'   => [
                    'scroll'      => esc_html__( 'Scroll', 'exclusive-addons-elementor' ),
                    'slide'       => esc_html__( 'Slide', 'exclusive-addons-elementor' ),
                    'fade'        => esc_html__( 'Fade', 'exclusive-addons-elementor' ),
                    'slide-up'    => esc_html__( 'Slide Up', 'exclusive-addons-elementor' ),
                    'slide-down'  => esc_html__( 'Slide Down', 'exclusive-addons-elementor' ),
                    'slide-left'  => esc_html__( 'Slide Left', 'exclusive-addons-elementor' ),
                    'slide-right' => esc_html__( 'Slide Right', 'exclusive-addons-elementor' ),
                    'typography'  => esc_html__( 'Typography', 'exclusive-addons-elementor' )
                ]               
            ]
        );  

        $this->add_control(
            'exad_news_ticker_autoplay_interval',
            [   
                'label'         => esc_html__( 'Autoplay Interval', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => '4000',
                'condition'     => [
                    '.exad_news_ticker_animation_type!' => 'scroll'
                ]              
            ]
        ); 

        $this->add_control(
            'exad_news_ticker_animation_speed',
            [   
                'label'         => esc_html__( 'Animation Speed', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => '2',
                'condition'     => [
                    '.exad_news_ticker_animation_type' => 'scroll'
                ]                
            ]
        ); 

        $this->add_control(
            'exad_news_ticker_height',
            [   
                'label'         => esc_html__( 'Height', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 70
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 20,
                        'max'   => 100
                    ]
                ]
            ]
        ); 

        $this->add_control(
            'exad_news_ticker_autoplay',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Autoplay', 'exclusive-addons-elementor' ),
                'label_on'     => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );        

        $this->add_control(
            'exad_news_ticker_pause_on_hover',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Pause On Hover', 'exclusive-addons-elementor' ),
                'label_on'     => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
                'default'      => 'yes',
                'return_value' => 'yes',
                'condition'    => [
                    '.exad_news_ticker_autoplay' => 'yes'
                ]                
            ]
        );

        $this->add_control(
            'exad_news_ticker_show_label',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Enable Label', 'exclusive-addons-elementor' ),
                'label_on'     => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_news_ticker_show_label_arrow',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Enable Label Arrow', 'exclusive-addons-elementor' ),
                'label_on'     => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'condition'    => [
                    'exad_news_ticker_show_label' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'exad_news_ticker_show_label_icon',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Enable Label Icon', 'exclusive-addons-elementor' ),
                'label_on'     => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'condition'    => [
                    'exad_news_ticker_show_label' => 'yes'
                ]
            ]
        ); 

        $this->add_control(
            'exad_news_ticker_show_controls',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Controls', 'exclusive-addons-elementor' ),
                'label_on'     => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );  

        $this->add_control(
            'exad_news_ticker_show_pause_control',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Play/Pause Control', 'exclusive-addons-elementor' ),
                'label_on'     => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
                'default'      => 'yes',
                'return_value' => 'yes',
                'condition'    => [
                    'exad_news_ticker_show_controls' => 'yes'
                ]
            ]
        );         

        $this->add_control(
            'exad_news_ticker_label_icon',
            [
                'label'       => __( 'Label Icon', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-home',
                    'library' => 'fa-solid'
                ],
                'condition'   => [
                    'exad_news_ticker_show_label'      => 'yes',
                    'exad_news_ticker_show_label_icon' => 'yes'
                ]
            ]
        ); 

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_news_ticker_container_style',
            [
                'label'         => esc_html__( 'Container', 'exclusive-addons-elementor' ),
                'tab'           => Controls_Manager::TAB_STYLE                    
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'exad_news_ticker_container_bg_color',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .exad-news-ticker'            
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'exad_news_ticker_container_border',
                'selector'       => '{{WRAPPER}} .exad-news-ticker',
                'fields_options' => [
                    'border'      => [
                        'default' => 'solid'
                    ],
                    'width'       => [
                        'default' => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                    'color'       => [
                        'default' => '#DADCEA'
                    ]
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_news_ticker_container_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-news-ticker'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'exad_news_ticker_container_box_shadow',
                'selector' => '{{WRAPPER}} .exad-news-ticker'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_news_ticker_label_style',
            [
                'label'     => esc_html__( 'Label', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    '.exad_news_ticker_show_label' => 'yes'
                ]             
            ]
        ); 

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_news_ticker_label_typography',
                'selector' => '{{WRAPPER}} .exad-news-ticker .exad-bn-label'
            ]
        );

        $this->add_control(
            'exad_news_ticker_label_color',
            [
                'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .exad-news-ticker .exad-bn-label' => 'color: {{VALUE}};'
                ]              
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'exad_news_ticker_label_bg_color',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .exad-news-ticker .exad-bn-label, {{WRAPPER}} .exad-news-ticker .exad-bn-label.yes-small:after'            
            ]
        );

        $this->add_control(
            'exad_news_ticker_label_padding',
            [
                'label'         => esc_html__( 'Padding(Left & Right)', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => [ 'px' ],
                'default'       => [
                    'size'      => 15
                ],
                'selectors'     => [
                    '{{WRAPPER}} .exad-news-ticker .exad-bn-label' => 'padding: 0 {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'exad_news_ticker_label_border',
                'selector'       => '{{WRAPPER}} .exad-news-ticker .exad-bn-label',
                'fields_options' => [
                    'border'      => [
                        'default' => 'solid'
                    ],
                    'width'       => [
                        'default' => [
                            'top'    => '0',
                            'right'  => '1',
                            'bottom' => '0',
                            'left'   => '0'
                        ]
                    ],
                    'color'       => [
                        'default' => '#DADCEA'
                    ]
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_news_ticker_label_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-news-ticker .exad-bn-label'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'exad_news_ticker_label_icon_style',
            [
                'label'     => esc_html__( 'Label Icon', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'exad_news_ticker_show_label_icon'    => 'yes',
                    'exad_news_ticker_label_icon[value]!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_news_ticker_label_icon_size',
            [
                'label'        => esc_html__( 'Size', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 10,
                        'max'  => 50,
                        'step' => 2
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-news-ticker-icon i' => 'font-size: {{SIZE}}px;'
                ],
                'condition' => [
                    'exad_news_ticker_show_label_icon'    => 'yes',
                    'exad_news_ticker_label_icon[value]!' => ''
                ]
            ]
        );

        $this->add_control(
            'exad_news_ticker_label_icon_color',
            [
                'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exad-news-ticker-icon i' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'exad_news_ticker_show_label_icon'    => 'yes',
                    'exad_news_ticker_label_icon[value]!' => ''
                ]            
            ]
        );

        $this->add_responsive_control(
            'exad_news_ticker_label_icon_padding',
            [
                'label'        => __('Padding', 'exclusive-addons-elementor'),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => ['px', '%'],
                'default'      => [
                    'top'      => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'right'    => '10',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-news-ticker-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'    => [
                    'exad_news_ticker_show_label_icon'    => 'yes',
                    'exad_news_ticker_label_icon[value]!' => ''
                ]
            ]
        ); 

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_news_ticker_items_style',
            [
                'label' => esc_html__( 'Items', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE                    
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_news_ticker_typography',
                'selector' => '{{WRAPPER}} .exad-news-ticker ul li, {{WRAPPER}} .exad-news-ticker ul li a'
            ]
        );

        $this->add_control(
            'exad_news_ticker_color',
            [
                'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .exad-news-ticker li, {{WRAPPER}} .exad-news-ticker li a' => 'color: {{VALUE}};'
                ]                
            ]
        );

        $this->add_control(
            'exad_news_ticker_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#3878ff',
                'selectors' => [
                    '{{WRAPPER}} .exad-news-ticker li:hover, {{WRAPPER}} .exad-news-ticker li:hover a' => 'color: {{VALUE}};'
                ]                
            ]
        );

        $this->add_control(
            'exad_news_ticker_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .exad-news-ticker' => 'background-color: {{VALUE}};'
                ]               
            ]
        );

        $this->add_responsive_control(
            'exad_news_ticker_each_item_padding',
            [
                'label'      => esc_html__( 'Padding Each Item(Left & Right)', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'default'    => [
                    'size'   => 15
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-news-ticker .exad-nt-news ul li' => 'padding: 0 {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_news_ticker_items_border',
                'selector' => '{{WRAPPER}} .exad-news-ticker .exad-nt-news'
            ]
        );

        $this->add_responsive_control(
            'exad_news_ticker_items_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-news-ticker .exad-nt-news'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_news_ticker_control_style',
            [
                'label'     => esc_html__( 'Controls', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    '.exad_news_ticker_show_controls' => 'yes'
                ]             
            ]
        );

        $this->add_control(
			'exad_news_ticker_control_spacing',
			[
				'label' => __( 'Spacing (Left & Right)', 'exclusive-addons-elementor' ),
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
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-news-ticker .exad-nt-controls' => 'padding: 0 {{SIZE}}{{UNIT}} 0;',
				],
			]
		);

        $this->add_control(
            'exad_news_ticker_control_box_style',
            [
                'label' => esc_html__( 'Control Box', 'exclusive-addons-elementor' ),
                'type'  => Controls_Manager::HEADING
            ]
        );

        $this->add_control(
            'exad_news_ticker_control_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .exad-news-ticker .exad-nt-controls' => 'background-color: {{VALUE}};'
                ]               
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_news_ticker_controls_box_border',
                'selector' => '{{WRAPPER}} .exad-news-ticker .exad-nt-controls'
            ]
        );

        $this->add_responsive_control(
            'exad_news_ticker_controls_box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-news-ticker .exad-nt-controls' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'exad_news_ticker_control_box_item_style',
            [
                'label'     => esc_html__( 'Control Items', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'exad_news_ticker_controls_size',
            [
                'label'      => esc_html__( 'Size', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'default'    => [
                    'size'   => 30
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-news-ticker .exad-nt-controls button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
			'exad_news_ticker_control_item_spacing',
			[
				'label' => __( 'Control Item Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-news-ticker .exad-nt-controls button:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs( 'exad_news_ticker_controls_tabs' );

            # Normal State Tab
            $this->start_controls_tab( 'exad_news_ticker_controls_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );
                $this->add_control(
                    'exad_news_ticker_controls_color',
                    [
                        'label'     => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#999999',
                        'selectors' => [
                            '{{WRAPPER}} .exad-news-ticker .exad-nt-controls button .bn-arrow::before, {{WRAPPER}} .exad-news-ticker .exad-nt-controls button .bn-arrow::after' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .exad-news-ticker .exad-nt-controls button .bn-pause::before, {{WRAPPER}} .exad-news-ticker .exad-nt-controls button .bn-pause::after' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'exad_news_ticker_controls_bg_color',
                    [
                        'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => 'rgba(0,0,0,0)',
                        'selectors' => [
                            '{{WRAPPER}} .exad-news-ticker .exad-nt-controls button' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );
                
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'exad_news_ticker_control_items_border',
                        'selector' => '{{WRAPPER}} .exad-news-ticker .exad-nt-controls button'
                    ]
                );

                $this->add_responsive_control(
                    'exad_news_ticker_control_items_border_radius',
                    [
                        'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px'],
                        'selectors'  => [
                            '{{WRAPPER}} .exad-news-ticker .exad-nt-controls button'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ]
                    ]
                );


            $this->end_controls_tab();

            #Hover State Tab
            $this->start_controls_tab( 'exad_news_ticker_controls_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );
                $this->add_control(
                    'exad_news_ticker_controls_hover_color',
                    [
                        'label'     => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#999999',
                        'selectors' => [
                            '{{WRAPPER}} .exad-news-ticker .exad-nt-controls button:hover .bn-arrow::before, {{WRAPPER}} .exad-news-ticker .exad-nt-controls button:hover .bn-arrow::after' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .exad-news-ticker .exad-nt-controls button:hover .bn-pause::before, {{WRAPPER}} .exad-news-ticker .exad-nt-controls button:hover .bn-pause::after' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'exad_news_ticker_controls_bg_hover_color',
                    [
                        'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => 'rgba(0,0,0,0)',
                        'selectors' => [
                            '{{WRAPPER}} .exad-news-ticker .exad-nt-controls button:hover' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'exad_news_ticker_control_items_hover_border',
                        'selector' => '{{WRAPPER}} .exad-news-ticker .exad-nt-controls button:hover'
                    ]
                );

                $this->add_responsive_control(
                    'exad_news_ticker_control_items_hover_border_radius',
                    [
                        'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px'],
                        'selectors'  => [
                            '{{WRAPPER}} .exad-news-ticker .exad-nt-controls button:hover'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings       = $this->get_settings_for_display();
        $label          = $settings['exad_news_ticker_label'];
        $show_label     = $settings['exad_news_ticker_show_label'];
        $direction      = $settings['exad_news_ticker_animation_direction'];
        $ticker_height  = $settings['exad_news_ticker_height']['size'];
        $autoplay       = $settings['exad_news_ticker_autoplay'];
        $fixed_position   = $settings['exad_news_ticker_set_fixed_position'];
        $animation_type = $settings['exad_news_ticker_animation_type'];

        $arrow             = 'yes'    === $settings['exad_news_ticker_show_label_arrow'] ? ' yes-small' : ' no';
        $pause_on_hover    = 'yes'    === $autoplay ? $settings['exad_news_ticker_pause_on_hover'] : '';
        $animation_speed   = 'scroll' === $animation_type ? $settings['exad_news_ticker_animation_speed'] : '';
        $autoplay_interval = 'scroll' !== $animation_type ? $settings['exad_news_ticker_autoplay_interval'] : '';

        $this->add_render_attribute( 'exad-news-ticker-wrapper', 'class', 'exad-news-ticker' );

        $this->add_render_attribute( 
            'exad-news-ticker-wrapper', 
            [ 
                'data-autoplay'          => esc_attr( 'yes' === $autoplay ? 'true' : 'false' ),
                'data-fixed_position'      => esc_attr( $fixed_position ),
                'data-pause_on_hover'    => esc_attr( 'yes' === $pause_on_hover ? 'true' : 'false' ),
                'data-direction'         => 'rtl' === $direction || is_rtl() ? 'rtl' : 'ltr',
                'data-autoplay_interval' => esc_attr( $autoplay_interval ),
                'data-animation_speed'   => esc_attr( $animation_speed ),
                'data-ticker_height'     => esc_attr( $ticker_height ),
                'data-animation'         => esc_attr( $animation_type )
            ]
        );

        $this->add_inline_editing_attributes( 'exad_news_ticker_label', 'basic' );
        ?>
        <div <?php echo $this->get_render_attribute_string( 'exad-news-ticker-wrapper' );?>>
            <?php do_action( 'exad_news_ticker_wrapper_before' );
            if( 'yes' === $show_label ): ?>
                <div class="exad-bn-label <?php  echo esc_attr( $arrow ) ?>" >
                    <div class="exad-nt-label">
                    <?php if( 'yes' === $settings['exad_news_ticker_show_label_icon'] && !empty( $settings['exad_news_ticker_label_icon'] ) ){ ?>
                        <span class="exad-news-ticker-icon">
                            <?php Icons_Manager::render_icon( $settings['exad_news_ticker_label_icon'], [ 'aria-hidden' => 'true' ] );?>
                        </span>                               
                    <?php 
                    }
                    if( !empty( $label ) ) { ?>
                        <span <?php echo $this->get_render_attribute_string( 'exad_news_ticker_label' );?> ><?php echo wp_kses_post( $label ) ;?></span>
                    <?php } ?>
                    </div>
                </div>
            <?php endif;?>

            <div class="exad-nt-news">
                <?php if( is_array( $settings['exad_news_ticker_items'] ) ) : ?>
                    <ul>
                    <?php foreach ( $settings['exad_news_ticker_items'] as $key => $list ) :
                        $link_key  = 'link_' . $key;

                        $title = $this->get_repeater_setting_key( 'exad_news_ticker_title', 'exad_news_ticker_items', $key );
                        $this->add_inline_editing_attributes( $title, 'basic' );

                        if( $list['exad_news_ticker_link']['url'] ) :
                            $this->add_render_attribute( $link_key, 'href', esc_url( $list['exad_news_ticker_link']['url'] ) );
                            if( $list['exad_news_ticker_link']['is_external'] ) {
                                $this->add_render_attribute( $link_key, 'target', '_blank' );
                            }
                            if( $list['exad_news_ticker_link']['nofollow'] ) {
                                $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
                            } ?>
                            <li>
                                <a <?php echo $this->get_render_attribute_string( $link_key );?> >
                                    <span <?php echo $this->get_render_attribute_string( $title );?> ><?php echo wp_kses_post( $list['exad_news_ticker_title'] );?></span>
                                </a>
                            </li>
                        <?php else : ?>
                            <li>
                                <span <?php echo $this->get_render_attribute_string( $title );?>><?php echo wp_kses_post( $list['exad_news_ticker_title'] );?></span>
                            </li>
                        <?php endif;
                    endforeach ;?>
                    </ul>
                <?php endif;?>
            </div>

            <?php if ( 'yes' === $settings['exad_news_ticker_show_controls'] ) :?>
                <div class="exad-nt-controls">
                    <button><span class="bn-arrow bn-prev"></span></button>
                    <?php if( 'yes' === $settings['exad_news_ticker_show_pause_control'] ) :?>
                        <button><span class="bn-action"></span></button>
                    <?php endif;?>
                    <button><span class="bn-arrow bn-next"></span></button>
                </div>
            <?php endif;
            do_action( 'exad_news_ticker_wrapper_after' ); ?>
        </div>
    <?php 
    }

    /**
     * Render news ticker widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
        ?>
        <#
            var label         = settings.exad_news_ticker_label,
            show_label        = settings.exad_news_ticker_show_label,
            direction         = settings.exad_news_ticker_animation_direction,
            ticker_height     = settings.exad_news_ticker_height.size,
            autoplay          = settings.exad_news_ticker_autoplay,
            fixed_position      = settings.exad_news_ticker_set_fixed_position,
            animation_type    = settings.exad_news_ticker_animation_type,
            arrow             = 'yes' === settings.exad_news_ticker_show_label_arrow ? ' yes-small' : ' no',
            pause_on_hover    = 'yes' === autoplay ? settings.exad_news_ticker_pause_on_hover : '';
            animation_speed   = 'scroll' === animation_type ? settings.exad_news_ticker_animation_speed : '',
            autoplay_interval = 'scroll' !== animation_type ? settings.exad_news_ticker_autoplay_interval : '';

            var iconHTML = elementor.helpers.renderIcon( view, settings.exad_news_ticker_label_icon, { 'aria-hidden': true }, 'i' , 'object' );

            view.addRenderAttribute( 'exad-news-ticker-wrapper', 'class', 'exad-news-ticker' );

            view.addRenderAttribute( 
                'exad-news-ticker-wrapper', 
                {
                    'data-autoplay' : 'yes'       === autoplay ? 'true' : 'false',
                    'data-fixed_position' : fixed_position,
                    'data-pause_on_hover' : 'yes' === pause_on_hover ? 'true' : 'false',
                    'data-direction': 'rtl'       === direction || elementorCommon.config.isRTL ? 'rtl' : 'ltr',
                    'data-autoplay_interval': autoplay_interval,
                    'data-animation_speed': animation_speed,
                    'data-ticker_height': ticker_height,
                    'data-animation': animation_type
                }
            );

            view.addInlineEditingAttributes( 'exad_news_ticker_label', 'basic' );
            view.addInlineEditingAttributes( 'exad_news_ticker_title', 'basic' );

        #>
        <div {{{ view.getRenderAttributeString( 'exad-news-ticker-wrapper' ) }}}>
            <# if( 'yes' === show_label ) { #>
                <div class="exad-bn-label {{{ arrow }}}">
                    <div class="exad-nt-label">
                        <# if( 'yes' === settings.exad_news_ticker_show_label_icon && iconHTML.value ) { #>
                            <span class="exad-news-ticker-icon">
                                {{{ iconHTML.value }}}
                            </span>                             
                        <# } #>
                        <# if ( label ) { #>
                            <span {{{ view.getRenderAttributeString( 'exad_news_ticker_label' ) }}}>{{{ label }}}</span>
                        <# } #>
                    </div>
                </div>
            <# } #>

            <div class="exad-nt-news">
                <# if ( settings.exad_news_ticker_items.length ) { #>
                    <ul>
                        <# _.each( settings.exad_news_ticker_items, function( item, index ) {
                            var newsLink  = 'link_' + index;
                            var title = view.getRepeaterSettingKey( 'exad_news_ticker_title', 'exad_news_ticker_items', index );
                            view.addInlineEditingAttributes( title, 'basic' );

                            if( item.exad_news_ticker_link.url ) {
                                view.addRenderAttribute( newsLink, 'href', item.exad_news_ticker_link.url );
                                if( item.exad_news_ticker_link.is_external ) {
                                    view.addRenderAttribute( newsLink, 'target', '_blank' );
                                }
                                if( item.exad_news_ticker_link.nofollow ) {
                                    view.addRenderAttribute( newsLink, 'rel', 'nofollow' );
                                }
                            #>
                                <li><a {{{ view.getRenderAttributeString( newsLink ) }}}>
                                    <span {{{ view.getRenderAttributeString( title ) }}}>{{{ item.exad_news_ticker_title }}}</span>
                                </a></li>
                            <# } else { #>
                                <li><span {{{ view.getRenderAttributeString( title ) }}}>{{{ item.exad_news_ticker_title }}}</span></li>
                            <# } #>
                        <# } ); #>
                    </ul>
                <# } #>
            </div>

            <# if ( 'yes' === settings.exad_news_ticker_show_controls ) { #>
                <div class="exad-nt-controls">
                    <button><span class="bn-arrow bn-prev"></span></button>
                    <# if ( 'yes' === settings.exad_news_ticker_show_pause_control ) { #>
                        <button><span class="bn-action"></span></button>
                    <# } #>
                    <button><span class="bn-arrow bn-next"></span></button>
                </div>
            <# } #>

        </div>
        <?php
    }

}
