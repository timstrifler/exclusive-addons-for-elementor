<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Pricing_Menu extends Widget_Base {
    
    //use ElementsCommonFunctions;
    public function get_name() {
        return 'exad-pricing-menu';
    }

    public function get_title() {
        return esc_html__( 'Pricing Menu', 'exclusive-addons-elementor' );
    }

    public function get_icon() {
        return 'exad-element-icon eicon-price-list';
    }

    public function get_categories() {
        return [ 'exclusive-addons-elementor' ];
    }

    public function get_keywords() {
        return [ 'pricing', 'list', 'product', 'image', 'menu', 'price' ];
    }

    protected function _register_controls() {
        /**
         * Pricing Menu Content
         */
        $this->start_controls_section(
            'exad_section_pricing_menu_content',
            [
                'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
            ]
        );

        $price_menu_repeater = new Repeater();

        $price_menu_repeater->add_control(
            'exad_pricing_menu_image',
            [
                'label'   => esc_html__( 'Image', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src()
                ]
            ]
        );

        $price_menu_repeater->add_control(
            'exad_pricing_menu_title',
            [
                'label'   => esc_html__('Title', 'exclusive-addons-elementor'),
                'type'    => Controls_manager::TEXT,
                'default' => esc_html__( 'Name The Product', 'exclusive-addons-elementor' )
            ]
        );

        $price_menu_repeater->add_control(
            'exad_pricing_menu_description',
            [
                'label'   => esc_html__('Description', 'exclusive-addons-elementor'),
                'type'    => Controls_manager::TEXTAREA,
                'default' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'exclusive-addons-elementor' )
            ]
        );

        $price_menu_repeater->add_control(
            'exad_pricing_menu_enable_link',
            [
                'label'        => __( 'Enable Order Button', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $price_menu_repeater->add_control(
            'exad_pricing_menu_action_text',
            [
                'label'     => esc_html__('Order Action', 'exclusive-addons-elementor'),
                'type'      => Controls_manager::TEXT,
                'default'   => 'Order Now',
                'condition' => [
                    'exad_pricing_menu_enable_link' => 'yes'
                ]
            ]
        );

        $price_menu_repeater->add_control(
            'exad_pricing_menu_btn_link',
            [
                'label'       => esc_html__( 'Link', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url'         => '#',
                    'is_external' => ''
                ],
                'condition'   => [
                    'exad_pricing_menu_enable_link' => 'yes'
                ]
            ]
        );

        $price_menu_repeater->add_control(
            'exad_pricing_menu_price',
            [
                'label'   => __( 'Price', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '$14'
            ]
        );

        $this->add_control(
            'pricing_menu_repeater',
            [
                'label'       => esc_html__( 'Pricing List', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $price_menu_repeater->get_controls(),
                'title_field' => '{{exad_pricing_menu_title}}',
                'default'     => [
                    [ 'exad_pricing_menu_title' => __( 'List #1', 'exclusive-addons-elementor' ) ],
                    [ 'exad_pricing_menu_title' => __( 'List #2', 'exclusive-addons-elementor' ) ],
                    [ 'exad_pricing_menu_title' => __( 'List #3', 'exclusive-addons-elementor' ) ],
                    [ 'exad_pricing_menu_title' => __( 'List #4', 'exclusive-addons-elementor' ) ]
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Pricing Menu Container
         */
        $this->start_controls_section(
            'exad_section_pricing_menu_container',
            [
                'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_pricing_menu_image_align',
            [
                'label'   => __( 'Alignment', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'flex-start',
                'options' => [
                    'flex-start' => __( 'Top', 'exclusive-addons-elementor' ),
                    'center'     => __( 'Center', 'exclusive-addons-elementor' )
                ],
                'selectors' => [
                    '{{WRAPPER}} .exad-pricing-list-item' => 'align-items: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'exad_price_list_container_bg',
                'label'    => __( 'Background', 'exclusive-addons-elementor' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .exad-pricing-list .exad-pricing-list-wrapper'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_pricing_menu_container_border',
                'selector' => '{{WRAPPER}} .exad-pricing-list .exad-pricing-list-wrapper'
            ]
        );

        $this->add_responsive_control(
            'exad_pricing_menu_con_border_radius',
            [
                'label'        => __( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => ''
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-pricing-list .exad-pricing-list-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_pricing_menu_con_padding',
            [
                'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => 15,
                    'right'  => 15,
                    'bottom' => 15,
                    'left'   => 15,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-pricing-list .exad-pricing-list-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'exad_pricing_menu_con_shadow',
                'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
                'selector' => '{{WRAPPER}} .exad-pricing-list .exad-pricing-list-wrapper'
            ]
        );

        $this->end_controls_section();

        /**
         * Pricing menu List Item style
         */

        $this->start_controls_section(
            'exad_pricing_menu_list_item',
            [
                'label' => esc_html__( 'List Item', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'exad_pricing_menu_list_item_background',
                'label'    => __( 'Background', 'exclusive-addons-elementor' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .exad-pricing-list-item'
            ]
        );

        $this->add_responsive_control(
            'exad_pricing_menu_list_item_padding',
            [
                'label'        => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'top'      => 20,
                    'right'    => 0,
                    'bottom'   => 20,
                    'left'     => 0,
                    'unit'     => 'px'
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-pricing-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_pricing_menu_list_item_margin',
            [
                'label'      => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-pricing-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'exad_pricing_menu_list_item_border',
                'selector'  => '{{WRAPPER}} .exad-pricing-list-item',
                'separator' => 'before'
            ]
        );
        
        $this->add_control(
            'exad_pricing_menu_list_item_border_bottom',
            [
                'label'        => __( 'Disable Border Bottom(Last Item)', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
                'return_value' => 'border_bottom',
                'default'      => 'yes'
            ]
        );

        $this->add_responsive_control(
            'exad_pricing_menu_list_item_radius',
            [
                'label'      => esc_html__( 'Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px'
                ],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .exad-pricing-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'exad_pricing_menu_list_item_shadow',
                'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
                'selector' => '{{WRAPPER}} .exad-pricing-list-item'
            ]
        );

        $this->end_controls_section();


        /**
         * Pricing menu List Image style
         */

        $this->start_controls_section(
            'exad_pricing_menu_image_style',
            [
                'label' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'exad_pricing_menu_img_size',
                'default'   => 'thumbnail'
            ]
        );

        $this->add_responsive_control(
            'exad_pricing_menu_image_width',
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
                'default'  => [
                    'unit' => 'px',
                    'size' => 120
                ],
                'selectors' => [
                    '{{WRAPPER}} .exad-pricing-list-item.yes .exad-pricing-list-item-thumbnail' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exad-pricing-list-item.yes .exad-pricing-list-item-content'   => 'width: calc( 100% - {{SIZE}}{{UNIT}} );'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_pricing_menu_image_height',
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
                    'size'    => 120
                ],
                'selectors'   => [
                    '{{WRAPPER}} .exad-pricing-list-item.yes .exad-pricing-list-item-thumbnail' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_pricing_menu_image_padding',
            [
                'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-pricing-list-item-thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_pricing_menu_image_margin',
            [
                'label'      => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => 0,
                    'right'  => 15,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-pricing-list-item-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_pricing_menu_image_border',
                'selector' => '{{WRAPPER}} .exad-pricing-list-item-thumbnail'
            ]
        );

        $this->add_responsive_control(
            'exad_pricing_menu_image_radius',
            [
                'label'      => esc_html__( 'Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-pricing-list-item-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'exad_pricing_menu_image_shadow',
                'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
                'selector' => '{{WRAPPER}} .exad-pricing-list-item-thumbnail'
            ]
        );

        $this->end_controls_section();


        /**
         * Pricing menu Title style
         */
        $this->start_controls_section(
            'exad_pricing_menu_title',
            [
                'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_pricing_menu_title_connector',
            [
                'label'        => __( 'Enable Connector', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $this->add_control(
            'exad_pricing_menu_title_connector_color',
            [
                'label'     => __( 'Connector Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#e5e5e5',
                'selectors' => [
                    '{{WRAPPER}} .exad-pricing-list-item-content-conntector' => 'border-bottom-color: {{VALUE}};'
                ],
                'condition' => [
                    'exad_pricing_menu_title_connector' => 'yes'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_pricing_menu_title_typography',
                'label'    => __( 'Typography', 'exclusive-addons-elementor' ),
                'selector' => '{{WRAPPER}} .exad-pricing-list-item-content-title'
            ]
        );

        $this->add_responsive_control(
            'exad_pricing_menu_title_margin',
            [
                'label'        => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'top'      => 0,
                    'right'    => 0,
                    'bottom'   => 0,
                    'left'     => 0,
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-pricing-list-item-content-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->start_controls_tabs( 'exad_pricing_menu_title_color' );

            $this->start_controls_tab( 'exad_pricing_menu_title_color_control', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_pricing_menu_title_color_normal',
                    [
                        'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#0A1724',
                        'selectors' => [
                            '{{WRAPPER}} .exad-pricing-list-item-content-title' => 'color: {{VALUE}};'
                        ]
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'exad_pricing_menu_title_color_hover_control', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );
                $this->add_control(
                    'exad_pricing_menu_title_color_hover',
                    [
                        'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#f43d6b',
                        'selectors' => [
                            '{{WRAPPER}} .exad-pricing-list-item-content-title:hover' => 'color: {{VALUE}};'
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->end_controls_section();
        /**
         * Pricing menu Description style
         */
        $this->start_controls_section(
            'exad_pricing_menu_description',
            [
                'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_pricing_menu_description_color',
            [
                'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#8b8e93',
                'selectors' => [
                    '{{WRAPPER}} .exad-pricing-list-item .exad-pricing-list-item-content .exad-pricing-list-item-content-description' => 'color: {{VALUE}};'
                ]
            ]
        );
            
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_pricing_menu_description_typography',
                'label'    => __( 'Typography', 'exclusive-addons-elementor' ),
                'selector' => '{{WRAPPER}} .exad-pricing-list-item-content-description'
            ]
        );
        
        $this->add_responsive_control(
            'exad_pricing_menu_description_margin',
            [
                'label'        => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'top'      => 20,
                    'right'    => 0,
                    'bottom'   => 10,
                    'left'     => 0,
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-pricing-list-item-content-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();

        /**
         * Pricing menu Price style
         */
        $this->start_controls_section(
            'exad_pricing_menu_price_style',
          [
            'label' => esc_html__( 'Price', 'exclusive-addons-elementor' ),
            'tab'   => Controls_Manager::TAB_STYLE
          ]
        );
        
        $this->add_control(
            'exad_pricing_menu_price_position',
            [
                'label'   => __( 'Position', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'price_pos_down' => [
                        'title' => __( 'Bottom', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-angle-down'
                    ],
                    'price_pos_right' => [
                        'title' => __( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-angle-right'
                    ],
                ],
                'default' => 'price_pos_right'
            ]
        );

        $this->add_control(
            'exad_pricing_menu_price_color',
            [
                'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f43d6b',
                'selectors' => [
                    '{{WRAPPER}} .exad-pricing-list-item .exad-pricing-list-item-price' => 'color: {{VALUE}};'
                ]
            ]
        );
            
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'             => 'exad_pricing_menu_price_typography',
                'label'            => __( 'Typography', 'exclusive-addons-elementor' ),
                'fields_options'   => [
                    'font_size'    => [
                        'default'  => [
                            'unit' => 'px',
                            'size' => 20
                        ]
                    ],
                    'line_height'  => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => 20
                        ]
                    ]
                ],
                'selector'         => '{{WRAPPER}} .exad-pricing-list-item-price span'
            ]
        );
        
        $this->add_responsive_control(
            'exad_pricing_menu_price_margin',
            [
                'label'        => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'top'      => 0,
                    'right'    => 0,
                    'bottom'   => 0,
                    'left'     => 0,
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-pricing-list-item-price span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'    => [
                    'exad_pricing_menu_price_position' => 'price_pos_down'
                ]
            ]
        );

        $this->end_controls_section();
        
        /**
         * Pricing menu Price style
         */
        $this->start_controls_section(
            'exad_pricing_menu_order_btn_style',
          [
            'label' => esc_html__( 'Order Button', 'exclusive-addons-elementor' ),
            'tab'   => Controls_Manager::TAB_STYLE
          ]
        );
            
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_pricing_menu_order_btn_typography',
                'label'    => __( 'Typography', 'exclusive-addons-elementor' ),
                'selector' => '{{WRAPPER}} .exad-pricing-list-item-content-action'
            ]
        );

        $this->add_responsive_control(
            'exad_pricing_menu_order_btn_padding',
            [
                'label'        => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'top'      => 8,
                    'right'    => 20,
                    'bottom'   => 8,
                    'left'     => 20,
                    'unit'     => 'px'
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-pricing-list-item-content-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        
        $this->add_responsive_control(
            'exad_pricing_menu_order_btn_radius',
            [
                'label'      => esc_html__( 'Border radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-pricing-list-item-content-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'exad_pricing_menu_order_btn_tabs' );

            $this->start_controls_tab( 'exad_pricing_menu_order_btn_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );
            
                $this->add_control(
                    'exad_pricing_menu_order_btn_normal_background',
                    [
                        'label'     => esc_html__( 'Background', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#0A1724',
                        'selectors' => [
                            '{{WRAPPER}} .exad-pricing-list-item-content-action' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'exad_pricing_menu_order_btn_normal_color',
                    [
                        'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-pricing-list-item-content-action' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'exad_pricing_menu_order_btn_normal_border',
                        'selector' => '{{WRAPPER}} .exad-pricing-list-item-content-action'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'exad_pricing_menu_order_btn_normal_shadow',
                        'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
                        'selector' => '{{WRAPPER}} .exad-pricing-list-item-content-action'
                    ]
                );
                
            $this->end_controls_tab();

            $this->start_controls_tab( 'exad_pricing_menu_order_btn_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );
            
                $this->add_control(
                    'exad_pricing_menu_order_btn_hover_background',
                    [
                        'label'     => esc_html__( 'Background', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#0A1724',
                        'selectors' => [
                            '{{WRAPPER}} .exad-pricing-list-item-content-action:hover' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'exad_pricing_menu_order_btn_hover_color',
                    [
                        'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-pricing-list-item-content-action:hover' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'exad_pricing_menu_order_btn_hover_border',
                        'selector' => '{{WRAPPER}} .exad-pricing-list-item-content-action:hover'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'exad_pricing_menu_order_btn_hover_shadow',
                        'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
                        'selector' => '{{WRAPPER}} .exad-pricing-list-item-content-action:hover'
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->end_controls_section();
    }

    private function pricing( $param ) {
        $price = '<div class="exad-pricing-list-item-price">';
            $price .= '<span>'.esc_html( $param ).'</span>';
        $price .= '</div>';
        return $price;
    }

    protected function render() {
        
        $settings = $this->get_settings_for_display();
        $pricing_menu_preset = $settings['exad_pricing_menu_preset'];

        echo '<div class="exad-pricing-list '.esc_attr( $pricing_menu_preset ).'">';
            echo '<div class="exad-pricing-list-wrapper '.esc_attr( $settings['exad_pricing_menu_list_item_border_bottom'] ).'">';
                foreach ( $settings['pricing_menu_repeater'] as $index => $list ) : 
                    $fg_image         = $list['exad_pricing_menu_image'];
                    $fg_image_src_url = Group_Control_Image_Size::get_attachment_image_src( $fg_image['id'], 'exad_pricing_menu_img_size', $settings );

                    if( empty( $fg_image_src_url ) ) {
                        $fg_image_url = $fg_image['url']; 
                    } else { 
                        $fg_image_url = $fg_image_src_url;
                    }
                    $img_url = $fg_image_url ? ' yes' : '';
                    echo '<div class="exad-pricing-list-item'.esc_attr( $img_url ).'">';

                        if( !empty( $fg_image_url ) ) {
                            echo '<div class="exad-pricing-list-item-thumbnail">';
                                echo '<img src="'.esc_url( $fg_image_url ).'" alt="'.Control_Media::get_image_alt( $list['exad_pricing_menu_image'] ).'">';
                            echo '</div>';
                        }

                        echo '<div class="exad-pricing-list-item-content '.esc_attr( $settings['exad_pricing_menu_price_position'] ).'">';
                            echo '<div class="exad-pricing-list-item-content-inner">';
                                echo '<div class="exad-pricing-title">';
                                    echo '<h5 class="exad-pricing-list-item-content-title">';
                                        echo esc_html( $list['exad_pricing_menu_title'] );
                                    echo '</h5>';
                                    if( 'yes' === $settings['exad_pricing_menu_title_connector'] ) {
                                        echo '<span class="exad-pricing-list-item-content-conntector"></span>';
                                    }

                                    if( 'price_pos_right' === $settings['exad_pricing_menu_price_position'] ) {
                                        echo $this->pricing( $list['exad_pricing_menu_price'] );
                                    }
                                echo '</div>';

                                echo '<p class="exad-pricing-list-item-content-description">';
                                    echo wp_kses_post( $list['exad_pricing_menu_description'] );
                                echo '</p>';
                                
                                if( 'yes' === $list['exad_pricing_menu_enable_link'] && !empty( $list['exad_pricing_menu_action_text'] ) ) {
                                    $link_key = 'link_' . $index;
                                    $exad_heading_link = $list['exad_pricing_menu_btn_link']['url'];
                                    if( $exad_heading_link ) {
                                        $this->add_render_attribute( $link_key, 'href', esc_url( $exad_heading_link ) );
                                        if( $list['exad_pricing_menu_btn_link']['is_external'] ) {
                                            $this->add_render_attribute( $link_key, 'target', '_blank' );
                                        }
                                        if( $list['exad_pricing_menu_btn_link']['nofollow'] ) {
                                            $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
                                        }
                                    }

                                    echo '<a class="exad-pricing-list-item-content-action" '.$this->get_render_attribute_string( $link_key ).'>';
                                        echo esc_html( $list['exad_pricing_menu_action_text'] );
                                    echo '</a>';
                                }
                            echo '</div>';
                            
                            if( 'price_pos_down' === $settings['exad_pricing_menu_price_position'] ) {
                                echo $this->pricing( $list['exad_pricing_menu_price'] );
                            }
                        echo '</div>';
                    echo '</div>';
                endforeach;
            echo '</div>';
        echo '</div>';
    }

    protected function _content_template() {
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Pricing_Menu() );