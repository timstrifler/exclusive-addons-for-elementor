<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;


class Alert extends Widget_Base {
  
    public function get_name() {
        return 'exad-exclusive-alert';
    }

    public function get_title() {
        return esc_html__( 'Alert', 'exclusive-addons-elementor' );
    }

    public function get_icon() {
        return 'exad exad-logo exad-alert';
    }

    public function get_categories() {
        return [ 'exclusive-addons-elementor' ];
    }

    public function get_keywords() {
        return [ 'exclusive', 'notice', 'message' ];
    }

    protected function register_controls() {
        $exad_primary_color   = get_option( 'exad_primary_color_option', '#7a56ff' );
        $exad_secondary_color = get_option( 'exad_secondary_color_option', '#00d8d8' );
        
        /**
         * Alert Content Tab
         */
        $this->start_controls_section(
            'exad_alert_content',
            [
              'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_alert_content_icon_show',
            [
                'label'        => esc_html__( 'Enable Icon', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_alert_content_icon',
              [
                'label'   => __( 'Icon', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fab fa-wordpress-simple',
                    'library' => 'fa-brands'
                ],
                'condition' => [
                    'exad_alert_content_icon_show' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'exad_alert_content_title_show',
            [
                'label'        => esc_html__( 'Enable Title', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_alert_content_title',
            [
                'label'     => __( 'Title', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::TEXTAREA,
                'default'   => 'Well Done!',
                'condition' => [
                    'exad_alert_content_title_show' => 'yes'
                ],
                'dynamic' => [
					'active' => true,
				]
            ]
        );

        $this->add_control(
          'exad_alert_content_description',
            [
                'label'   => __( 'Description', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'A simple alert—check it out!',
                'dynamic' => [
					'active' => true,
				]
            ]
        );

        $this->add_control(
            'exad_alert_close_button',
            [
                'label'   => __( 'Close Icon/Button', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'none'    => esc_html__( 'None', 'exclusive-addons-elementor' ),
                    'icon'    => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                    'button'  => esc_html__( 'Button', 'exclusive-addons-elementor' )
                ]
            ]
        );

        $this->add_control(
            'exad_alert_close_primary_button',
            [
                'label'     => __( 'Primary Button', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Done', 'exclusive-addons-elementor' ),
                'condition' => [
                    'exad_alert_close_button' => ['button']
                ],
                'dynamic' => [
					'active' => true,
				]
            ]
        );

        $this->add_control(
            'exad_alert_close_secondary_button',
            [
                'label'                   => __( 'Secondary Button', 'exclusive-addons-elementor' ),
                'type'                    => Controls_Manager::TEXT,
                'default'                 => __( 'Cancel', 'exclusive-addons-elementor' ),
                'condition'               => [
                    'exad_alert_close_button' => ['button']
                ],
                'dynamic' => [
					'active' => true,
				]
            ]
        );
        
        $this->end_controls_section();

        /**
         * Alert Content style Tab
         */
        $this->start_controls_section(
          'exad_alert_style',
            [
                'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_alert_background_style',
            [
                'label'     => esc_html__( 'Background', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ECF9FD',
                'selectors' => [
                    '{{WRAPPER}} .exad-alert-wrapper' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_alert_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .exad-alert-wrapper'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control(
            'exad_alert_padding',
            [
                'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => '20',
                    'right'  => '20',
                    'bottom' => '20',
                    'left'   => '20'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-alert-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_alert_border',
                'selector' => '{{WRAPPER}} .exad-alert-wrapper'
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'exad_alert_box_shadow',
                'selector' => '{{WRAPPER}} .exad-alert-wrapper'
            ]
        );

        $this->end_controls_section();

        /**
         * Alert Icon style
         */
        $this->start_controls_section(
            'exad_alert_icon_style',
            [
                'label'     => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_alert_content_icon_show' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_alert_icon_size',
            [
                'label'        => esc_html__( 'Size', 'exclusive-addons-elementor' ),
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
                    'size'     => 24
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-alert .exad-alert-element .exad-alert-element-icon i' => 'font-size: {{SIZE}}px;'
                ]
            ]
        );

        $this->add_responsive_control(
          'exad_alert_icon_width',
            [
                'label'       => esc_html__( 'Width', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px'],
                'default'     => [
                    'size'    => 50,
                    'unit'    => 'px'
                ],
                'range'       => [
                    'px'      => [
                        'max' => 200
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .exad-alert .exad-alert-element .exad-alert-element-icon' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exad-alert .exad-alert-element .exad-alert-element-content' => 'width: calc( 100% - {{SIZE}}{{UNIT}} );'
                ]
            ]
        );

        $this->add_control(
          'exad_alert_icon_color',
            [
                'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#272727',
                'selectors' => [
                    '{{WRAPPER}} .exad-alert-element .exad-alert-element-icon span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
          'exad_alert_icon_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exad-alert-element .exad-alert-element-icon span' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_alert_icon_padding',
            [
                'label'      => __('Padding', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [
                    '{{WRAPPER}} .exad-alert-element .exad-alert-element-icon span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_alert_icon_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-alert-element .exad-alert-element-icon span'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Alert Content Title style Tab
         */
        $this->start_controls_section(
            'exad_alert_title_style',
            [
                'label'     => esc_html__( 'Title', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_alert_content_title_show' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_alert_title_typography',
                'selector' => '{{WRAPPER}} .exad-alert-element .exad-alert-element-content h5'
            ]
        );

        $this->add_control(
          'exad_alert_title_color',
            [
                'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#272727',
                'selectors' => [
                    '{{WRAPPER}} .exad-alert-element .exad-alert-element-content h5' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_alert_title_margin',
            [
                'label'      => __('Margin', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-alert-element .exad-alert-element-content h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Alert Content Description style Tab
         */
        $this->start_controls_section(
            'exad_alert_description_style',
            [
                'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_alert_description_typography',
                'selector' => '{{WRAPPER}} .exad-alert-element .exad-alert-element-content .exad-alert-desc'
            ]
        );

        $this->add_control(
            'exad_alert_description_color',
            [
                'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exad-alert-element .exad-alert-element-content .exad-alert-desc' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_alert_description_margin',
            [
                'label'      => __('Margin', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}}  .exad-alert-element .exad-alert-element-content .exad-alert-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Alert Dismiss button style
         */
        $this->start_controls_section(
            'exad_alert_dismiss_style',
            [
                'label' => esc_html__( 'Dismiss Button', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'exad_alert_dismiss_icon_size',
            [
                'label'        => esc_html__( 'Size', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 60,
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 16
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-alert-element .exad-alert-element-dismiss-icon svg' => 'width: {{SIZE}}px; height: {{SIZE}}px;'
                ]
            ]
        );

        $this->add_control(
            'exad_alert_dismiss_icon_color',
            [
                'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#A1A5B5',
                'selectors' => [
                  '{{WRAPPER}} .exad-alert-element .exad-alert-element-dismiss-icon svg path' => 'fill: {{VALUE}};'
                ],
                'condition' => [
                    'exad_alert_close_button' => 'icon'
                ]
            ]
        );

        $dismiss_icon_spacing = is_rtl() ? 'left: {{SIZE}}{{UNIT}};' : 'right: {{SIZE}}{{UNIT}};';
        $this->add_responsive_control(
            'exad_alert_dismiss_icon_pos_right',
            [
                'label'      => esc_html__( 'Offset-X', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 0
                ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ],
                    '%'        => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-alert-element .exad-alert-element-dismiss-icon' => $dismiss_icon_spacing
                ],
                'condition'  => [
                  'exad_alert_close_button' => 'icon'
                ]
            ]
        );

        $this->add_responsive_control(
          'exad_alert_dismiss_icon_pos_top',
            [
                'label'      => esc_html__( 'Offset-Y', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 15
                ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ],
                    '%'        => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-alert-element .exad-alert-element-dismiss-icon' => 'top: {{SIZE}}{{UNIT}};'
                ],
                'condition'  => [
                    'exad_alert_close_button' => 'icon'
                ]
            ]
        );

        $this->start_controls_tabs( 
            'exad_alert_dismiss_button', 
            [
                'condition' => ['exad_alert_close_button' => 'button']
            ]
        );

            $this->start_controls_tab( 'exad_alert_dismiss_primary_button', [ 'label' => esc_html__( 'Primary Button', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_alert_dismiss_primary_button_background',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => $exad_primary_color,
                    'selectors' => [
                        '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-done' => 'background: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_alert_dismiss_primary_button_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-done' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'exad_alert_dismiss_primary_button_text',
                    'selector' => '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-done'
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'exad_alert_dismiss_primary_button_border',
                    'selector' => '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-done'
                ]
            );

            $this->add_responsive_control(
                'exad_alert_dismiss_primary_button_padding',
                [
                    'label'        => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
                    'type'         => Controls_Manager::DIMENSIONS,
                    'size_units'   => [ 'px', '%', 'em' ],
                    'default'      => [ 
                        'top'      => '10',
                        'right'    => '30',
                        'bottom'   => '10',
                        'left'     => '30',
                        'isLinked' => false
                    ],
                    'selectors'    => [
                        '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-done' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_responsive_control(
              'exad_alert_dismiss_primary_button_ border_radius',
                [
                    'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'default'    => [
                        'top'    => '5',
                        'right'  => '5',
                        'bottom' => '5',
                        'left'   => '5'
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-done'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->end_controls_tab();
            

            $this->start_controls_tab( 'exad_alert_dismiss_secondary_button', [ 'label' => esc_html__( 'Secondary Button', 'exclusive-addons-elementor' ) ] );
          
            $this->add_control(
                'exad_alert_dismiss_secondary_button_background',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => $exad_secondary_color,
                    'selectors' => [
                    '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-cancel' => 'background: {{VALUE}};'
                ],
                'condition' => [
                        'exad_alert_close_button' => 'button'
                    ]
                ]
            );

            $this->add_control(
                'exad_alert_dismiss_secondary_button_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-cancel' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'exad_alert_dismiss_secondary_button_text',
                    'selector' => '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-cancel'
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'exad_alert_dismiss_secondary_button_border',
                    'selector' => '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-cancel'
                ]
            );

            $this->add_responsive_control(
                'exad_alert_dismiss_secondary_button_padding',
                [
                    'label'        => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
                    'type'         => Controls_Manager::DIMENSIONS,
                    'size_units'   => [ 'px', '%', 'em' ],
                    'default'      => [
                        'top'      => '10',
                        'right'    => '30',
                        'bottom'   => '10',
                        'left'     => '30',
                        'isLinked' => false
                    ],
                    'selectors'    => [
                        '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-cancel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_responsive_control(
              'exad_alert_dismiss_secondary_button_radius',
                [
                    'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'default'    => [
                        'top'    => '5',
                        'right'  => '5',
                        'bottom' => '5',
                        'left'   => '5'
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-cancel'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->end_controls_tab();
    
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings     = $this->get_settings_for_display();
        $title        = $settings['exad_alert_content_title'];
        $description  = $settings['exad_alert_content_description'];
        $primary_btn  = $settings['exad_alert_close_primary_button'];
        $seconday_btn = $settings['exad_alert_close_secondary_button'];

        $this->add_render_attribute( 'exad_alert_content_title', 'class', 'exad-alert-title' );
        $this->add_inline_editing_attributes( 'exad_alert_content_title', 'basic' );

        $this->add_render_attribute( 'exad_alert_content_description', 'class', 'exad-alert-desc' );
        $this->add_inline_editing_attributes( 'exad_alert_content_description', 'basic' );

        $this->add_render_attribute( 'exad_alert_close_primary_button', 'class', 'exad-alert-element-dismiss-done' );
        $this->add_inline_editing_attributes( 'exad_alert_close_primary_button', 'none' );

        $this->add_render_attribute( 'exad_alert_close_secondary_button', 'class', 'exad-alert-element-dismiss-cancel' );
        $this->add_inline_editing_attributes( 'exad_alert_close_secondary_button', 'none' );

        do_action( 'exad_alert_wrapper_before' );
        ?>

        <div class="exad-alert">
            <div class="exad-alert-wrapper" data-alert>
                <div class="exad-alert-element">
                <?php
                    do_action( 'exad_alert_content_wrapper_before' );

                    if ( 'yes' === $settings['exad_alert_content_icon_show'] && !empty($settings['exad_alert_content_icon']['value']) ) {
                    ?>    
                        <div class="exad-alert-element-icon">
                            <span>
                                <?php Icons_Manager::render_icon( $settings['exad_alert_content_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                        </div>
                    <?php    
                    }
                    ?>

                    <div class="exad-alert-element-content">
                        <?php                    
                            if ( !empty( $title ) && 'yes' === $settings['exad_alert_content_title_show'] ) {
                                printf( '<h5 '.$this->get_render_attribute_string( 'exad_alert_content_title' ).'>%s</h5>', wp_kses_post( $title ) );
                            } 
                            $description ? printf( '<div '.$this->get_render_attribute_string( 'exad_alert_content_description' ).'>%s</div>', wp_kses_post( $description ) ) : '';
                        ?>    
                    </div>

                    <?php        
                    if( 'icon' === $settings['exad_alert_close_button'] ) { ?>    
                        <div class="exad-alert-element-dismiss-icon">
                            <svg viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2.343 15.071L.929 13.656 6.586 8 .929 2.343 2.343.929 8 6.585 13.657.929l1.414 1.414L9.414 8l5.657 5.656-1.414 1.415L8 9.414l-5.657 5.657z" />
                            </svg>
                        </div>
                    <?php    
                    }

                    do_action( 'exad_alert_content_wrapper_after' ); ?>
                </div>

                <?php    
                if( 'button' === $settings['exad_alert_close_button'] ) { ?>
                    <div class="exad-alert-element-dismiss-button">
                    <?php
                        $primary_btn ? printf( '<button '.$this->get_render_attribute_string( 'exad_alert_close_primary_button' ).'>%s</button>', esc_html( $primary_btn ) ) : '';
                        $seconday_btn ? printf( '<button '.$this->get_render_attribute_string( 'exad_alert_close_secondary_button' ).'>%s</button>', esc_html( $seconday_btn ) ) : '';
                    ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php do_action( 'exad_alert_wrapper_after' );
    }

    /**
     * Render alert widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
        ?>
        <#
            var iconHTML = elementor.helpers.renderIcon( view, settings.exad_alert_content_icon, { 'aria-hidden': true }, 'i' , 'object' );

            view.addRenderAttribute( 'exad_alert_content_title', 'class', 'exad-alert-title' );
            view.addInlineEditingAttributes( 'exad_alert_content_title', 'basic' );

            view.addRenderAttribute( 'exad_alert_content_description', 'class', 'exad-alert-desc' );
            view.addInlineEditingAttributes( 'exad_alert_content_description', 'basic' );

            view.addRenderAttribute( 'exad_alert_close_primary_button', 'class', 'exad-alert-element-dismiss-done' );
            view.addInlineEditingAttributes( 'exad_alert_close_primary_button', 'none' );

            view.addRenderAttribute( 'exad_alert_close_secondary_button', 'class', 'exad-alert-element-dismiss-cancel' );
            view.addInlineEditingAttributes( 'exad_alert_close_secondary_button', 'none' );
            
        #>
        <div class="exad-alert">
            <div class="exad-alert-wrapper" data-alert>
                <div class="exad-alert-element">
                    <# if ( 'yes' === settings.exad_alert_content_icon_show && iconHTML.value ) { #>
                        <div class="exad-alert-element-icon">
                            <span>
                                {{{ iconHTML.value }}}
                            </span>
                        </div>
                    <# } #>
                    <div class="exad-alert-element-content">
                        <# if ( settings.exad_alert_content_title && 'yes' === settings.exad_alert_content_title_show ) { #>
                            <h5 {{{ view.getRenderAttributeString( 'exad_alert_content_title' ) }}}>{{{ settings.exad_alert_content_title }}}</h5>
                        <# } #>

                        <# if ( settings.exad_alert_content_description ) { #>
                            <div {{{ view.getRenderAttributeString( 'exad_alert_content_description' ) }}}>{{{ settings.exad_alert_content_description }}}</div>
                        <# } #>
                    </div>
                    <# if( 'icon' === settings.exad_alert_close_button ) { #>
                        <div class="exad-alert-element-dismiss-icon"><svg viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.343 15.071L.929 13.656 6.586 8 .929 2.343 2.343.929 8 6.585 13.657.929l1.414 1.414L9.414 8l5.657 5.656-1.414 1.415L8 9.414l-5.657 5.657z"></path>
                            </svg>
                        </div>
                    <# } #>
                </div>
                <# if( 'button' === settings.exad_alert_close_button ) { #>
                    <div class="exad-alert-element-dismiss-button">
                        <# if( settings.exad_alert_close_primary_button ) { #>
                            <button {{{ view.getRenderAttributeString( 'exad_alert_close_primary_button' ) }}}>{{{ settings.exad_alert_close_primary_button }}}</button>
                        <# } #>
                        
                        <# if( settings.exad_alert_close_secondary_button ) { #>
                            <button {{{ view.getRenderAttributeString( 'exad_alert_close_secondary_button' ) }}}>{{{ settings.exad_alert_close_secondary_button }}}</button>
                        <# } #>
                    </div>
                <# } #>
            </div>
        </div>
        <?php
    }
}