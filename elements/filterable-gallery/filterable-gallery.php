<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class Exad_Filterable_Gallery extends Widget_Base
{

    public function get_name()
    {
        return 'exad-filterable-gallery';
    }

    public function get_title()
    {
        return esc_html__('Filterable Gallery', 'essential-addons-elementor');
    }

    public function get_icon()
    {
        return 'exad-element-icon eicon-gallery-grid';
    }

    public function get_categories()
    {
        return ['essential-addons-elementor'];
    }

    public function get_script_depends()
    {
        return [
            'exad-scripts'
        ];
    }

    protected function _register_controls()
    {
        /**
         * Filter Gallery Settings
         */
        $this->start_controls_section(
            'exad_section_fg_settings',
            [
                'label' => esc_html__('Filterable Gallery Settings', 'essential-addons-elementor')
            ]
        );

        $this->add_control(
            'exad_fg_filter_duration',
            [
                'label' => esc_html__('Animation Duration (ms)', 'essential-addons-elementor'),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => 500,
            ]
        );

        $this->add_control(
            'exad_fg_filter_animation_style',
            [
                'label' => esc_html__('Animation Style', 'essential-addons-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'essential-addons-elementor'),
                    'effect-in' => esc_html__('Fade In', 'essential-addons-elementor'),
                    'effect-out' => esc_html__('Fade Out', 'essential-addons-elementor'),
                ],
            ]
        );

        $this->add_control(
            'exad_fg_columns',
            [
                'label' => esc_html__('Number of Columns', 'essential-addons-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'exad-col-3',
                'options' => [
                    'exad-col-1' => esc_html__('Single Column', 'essential-addons-elementor'),
                    'exad-col-2' => esc_html__('Two Columns',   'essential-addons-elementor'),
                    'exad-col-3' => esc_html__('Three Columns', 'essential-addons-elementor'),
                    'exad-col-4' => esc_html__('Four Columns',  'essential-addons-elementor'),
                    'exad-col-5' => esc_html__('Five Columns',  'essential-addons-elementor'),
                ],
            ]
        );

        $this->add_control(
            'exad_fg_grid_style',
            [
                'label' => esc_html__('Grid Style', 'essential-addons-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'exad-hoverer',
                'options' => [
                    'exad-hoverer'     => esc_html__('Hoverer', 'essential-addons-elementor'),
                    'exad-tiles'     => esc_html__('Tiles',   'essential-addons-elementor'),
                    'exad-cards'     => esc_html__('Cards', 'essential-addons-elementor'),
                ],
            ]
        );

        $this->add_control(
            'exad_fg_grid_hover_style',
            [
                'label' => esc_html__('Hover Style', 'essential-addons-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'exad-zoom-in',
                'options' => [
                    'exad-zoom-in'         => esc_html__('Zoom In', 'essential-addons-elementor'),
                    'exad-slide-left'     => esc_html__('Slide In Left',   'essential-addons-elementor'),
                    'exad-slide-right'     => esc_html__('Slide In Right', 'essential-addons-elementor'),
                    'exad-slide-top'     => esc_html__('Slide In Top', 'essential-addons-elementor'),
                    'exad-slide-bottom' => esc_html__('Slide In Bottom', 'essential-addons-elementor'),
                ],
            ]
        );

        $this->add_control(
            'exad_section_fg_zoom_icon',
            [
                'label' => esc_html__('Zoom Icon', 'essential-addons-elementor'),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-search-plus',
            ]
        );

        $this->add_control(
            'exad_section_fg_link_icon',
            [
                'label' => esc_html__('Link Icon', 'essential-addons-elementor'),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-link',
            ]
        );

        $this->end_controls_section();

        /**
         * Filter Gallery Control Settings
         */
        $this->start_controls_section(
            'exad_section_fg_control_settings',
            [
                'label' => esc_html__('Gallery Control Settings', 'essential-addons-elementor')
            ]
        );

        $this->add_control(
            'exad_fg_all_label_text',
            [
                'label'        => esc_html__('Gallery All Label', 'essential-addons-elementor'),
                'type'        => Controls_Manager::TEXT,
                'default'    => 'All',
            ]
        );

        $this->add_control(
            'exad_fg_controls',
            [
                'type' => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'default' => [
                    ['exad_fg_control' => 'Item'],
                ],
                'fields' => [
                    [
                        'name' => 'exad_fg_control',
                        'label' => esc_html__('List Item', 'essential-addons-elementor'),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => esc_html__('Item', 'essential-addons-elementor')
                    ],
                ],
                'title_field' => '{{exad_fg_control}}',
            ]
        );

        $this->end_controls_section();

        /**
         * Filter Gallery Grid Settings
         */
        $this->start_controls_section(
            'exad_section_fg_grid_settings',
            [
                'label' => esc_html__('Gallery Item Settings', 'essential-addons-elementor')
            ]
        );

        $this->add_control(
            'exad_fg_gallery_items',
            [
                'type' => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'default' => [
                    ['exad_fg_gallery_item_name' => 'Gallery Item Name'],
                    ['exad_fg_gallery_item_name' => 'Gallery Item Name'],
                    ['exad_fg_gallery_item_name' => 'Gallery Item Name'],
                    ['exad_fg_gallery_item_name' => 'Gallery Item Name'],
                    ['exad_fg_gallery_item_name' => 'Gallery Item Name'],
                    ['exad_fg_gallery_item_name' => 'Gallery Item Name'],
                ],
                'fields' => [
                    [
                        'name' => 'exad_fg_gallery_item_name',
                        'label' => esc_html__('Item Name', 'essential-addons-elementor'),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => esc_html__('Gallery item name', 'essential-addons-elementor')
                    ],
                    [
                        'name' => 'exad_fg_gallery_item_content',
                        'label' => esc_html__('Item Content', 'essential-addons-elementor'),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                        'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, provident.', 'essential-addons-elementor'),
                    ],
                    [
                        'name' => 'exad_fg_gallery_control_name',
                        'label' => esc_html__('Control Name', 'essential-addons-elementor'),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'description' => esc_html__('User the gallery control name form Control Settings. use the exact name that matches with its associate name.', 'essential-addons-elementor')
                    ],
                    [
                        'name' => 'exad_fg_gallery_img',
                        'label' => esc_html__('Image', 'essential-addons-elementor'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => ESSENTIAL_ADDONS_EL_URL . 'assets/img/flexia-preview.jpg',
                        ],
                    ],
                    [
                        'name' => 'exad_fg_gallery_link',
                        'label' => __('Gallery Link?', 'essential-addons-elementor'),
                        'type' => Controls_Manager::SWITCHER,
                        'default' => 'true',
                        'label_on' => esc_html__('Yes', 'essential-addons-elementor'),
                        'label_off' => esc_html__('No', 'essential-addons-elementor'),
                        'return_value' => 'true',
                    ],
                    [
                        'name' => 'exad_fg_gallery_img_link',
                        'type' => Controls_Manager::URL,
                        'label_block' => true,
                        'default' => [
                            'url' => '#',
                            'is_external' => '',
                        ],
                        'show_external' => true,
                        'condition' => [
                            'exad_fg_gallery_link' => 'true'
                        ]
                    ]
                ],
                'title_field' => '{{exad_fg_gallery_item_name}}',
            ]
        );

        $this->end_controls_section();

        /**
         * Filter Gallery Grid Settings
         */
        $this->start_controls_section(
            'exad_section_fg_popup_settings',
            [
                'label' => esc_html__('Popup Settings', 'essential-addons-elementor')
            ]
        );

        $this->add_control(
            'exad_fg_show_popup',
            [
                'label' => __('Show Popup', 'essential-addons-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'true',
                'label_on' => esc_html__('Yes', 'essential-addons-elementor'),
                'label_off' => esc_html__('No', 'essential-addons-elementor'),
                'return_value' => 'true',
            ]
        );

        $this->add_control(
            'exad_fg_show_popup_gallery',
            [
                'label' => __('Show Popup Gallery', 'essential-addons-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'true',
                'label_on' => esc_html__('Yes', 'essential-addons-elementor'),
                'label_off' => esc_html__('No', 'essential-addons-elementor'),
                'return_value' => 'true',
                'condition' => [
                    'exad_fg_show_popup' => 'true'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Filterable Gallery Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'exad_section_fg_style_settings',
            [
                'label' => esc_html__('General Style', 'essential-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_fg_bg_color',
            [
                'label' => esc_html__('Background Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'exad_fg_container_padding',
            [
                'label' => esc_html__('Padding', 'essential-addons-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'exad_fg_container_margin',
            [
                'label' => esc_html__('Margin', 'essential-addons-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'exad_fg_border',
                'label' => esc_html__('Border', 'essential-addons-elementor'),
                'selector' => '{{WRAPPER}} .exad-filter-gallery-wrapper',
            ]
        );

        $this->add_control(
            'exad_fg_border_radius',
            [
                'label' => esc_html__('Border Radius', 'essential-addons-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-wrapper' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'exad_fg_shadow',
                'selector' => '{{WRAPPER}} .exad-filter-gallery-wrapper',
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Filterable Gallery Control Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'exad_section_fg_control_style_settings',
            [
                'label' => esc_html__('Control Style', 'essential-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
            'exad_fg_control_padding',
            [
                'label' => esc_html__('Padding', 'essential-addons-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-control ul li a.control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'exad_fg_control_margin',
            [
                'label' => esc_html__('Margin', 'essential-addons-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-control ul li a.control' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'exad_fg_control_typography',
                'selector' => '{{WRAPPER}} .exad-filter-gallery-control ul li a.control',
            ]
        );
        // Tabs
        $this->start_controls_tabs('exad_fg_control_tabs');

        // Normal State Tab
        $this->start_controls_tab('exad_fg_control_normal', ['label' => esc_html__('Normal', 'essential-addons-elementor')]);

        $this->add_control(
            'exad_fg_control_normal_text_color',
            [
                'label' => esc_html__('Text Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-control ul li a.control' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'exad_fg_control_normal_bg_color',
            [
                'label' => esc_html__('Background Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-control ul li a.control' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'exad_fg_control_normal_border',
                'label' => esc_html__('Border', 'essential-addons-elementor'),
                'selector' => '{{WRAPPER}} .exad-filter-gallery-control ul li > a.control',
            ]
        );

        $this->add_control(
            'exad_fg_control_normal_border_radius',
            [
                'label' => esc_html__('Border Radius', 'essential-addons-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 20
                ],
                'range' => [
                    'px' => [
                        'max' => 30,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-control ul li a.control' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'exad_fg_control_shadow',
                'selector' => '{{WRAPPER}} .exad-filter-gallery-control ul li a.control',
                'separator' => 'before'
            ]
        );

        $this->end_controls_tab();

        // Active State Tab
        $this->start_controls_tab('exad_cta_btn_hover', ['label' => esc_html__('Active', 'essential-addons-elementor')]);

        $this->add_control(
            'exad_fg_control_active_text_color',
            [
                'label' => esc_html__('Text Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-control ul li a.control.mixitup-control-active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'exad_fg_control_active_bg_color',
            [
                'label' => esc_html__('Background Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3F51B5',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-control ul li a.control.mixitup-control-active' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'exad_fg_control_active_border',
                'label' => esc_html__('Border', 'essential-addons-elementor'),
                'selector' => '{{WRAPPER}} .exad-filter-gallery-control ul li > a.control.mixitup-control-active',
            ]
        );

        $this->add_control(
            'exad_fg_control_active_border_radius',
            [
                'label' => esc_html__('Border Radius', 'essential-addons-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 20
                ],
                'range' => [
                    'px' => [
                        'max' => 30,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-control ul li a.control.mixitup-control-active' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'exad_fg_control_active_shadow',
                'selector' => '{{WRAPPER}} .exad-filter-gallery-control ul li a.control.mixitup-control-active',
                'separator' => 'before'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();



        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Filterable Gallery Item Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'exad_section_fg_item_style_settings',
            [
                'label' => esc_html__('Item Style', 'essential-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'exad_fg_item_container_padding',
            [
                'label' => esc_html__('Padding', 'essential-addons-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-container .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'exad_fg_item_container_margin',
            [
                'label' => esc_html__('Margin', 'essential-addons-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-container .item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'exad_fg_item_border',
                'label' => esc_html__('Border', 'essential-addons-elementor'),
                'selector' => '{{WRAPPER}} .exad-filter-gallery-container .item',
            ]
        );

        $this->add_control(
            'exad_fg_item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'essential-addons-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-container .item' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'exad_fg_item_shadow',
                'selector' => '{{WRAPPER}} .exad-filter-gallery-container .item',
            ]
        );

        $this->end_controls_section();
        /**
         * -------------------------------------------
         * Tab Style (Filterable Gallery Item Caption Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'exad_section_fg_item_cap_style_settings',
            [
                'label' => esc_html__('Item Caption Style', 'essential-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_fg_item_cap_bg_color',
            [
                'label' => esc_html__('Background Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.7)',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-container .item .caption' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'exad_fg_item_cap_container_padding',
            [
                'label' => esc_html__('Padding', 'essential-addons-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-container .item .caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'exad_fg_item_cap_border',
                'label' => esc_html__('Border', 'essential-addons-elementor'),
                'selector' => '{{WRAPPER}} .exad-filter-gallery-container .item .caption',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'exad_fg_item_cap_shadow',
                'selector' => '{{WRAPPER}} .exad-filter-gallery-container .item .caption',
            ]
        );

        $this->add_control(
            'exad_fg_item_caption_hover_icon',
            [
                'label' => esc_html__('Hover Icon', 'essential-addons-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'exad_fg_item_icon_bg_color',
            [
                'label' => esc_html__('Background Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff622a',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-container .item .caption a' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'exad_fg_item_icon_color',
            [
                'label' => esc_html__('Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-container .item .caption a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Filterable Gallery Item Content Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'exad_section_fg_item_content_style_settings',
            [
                'label' => esc_html__('Item Content Style', 'essential-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_fg_grid_style' => 'exad-cards'
                ]
            ]
        );

        $this->add_control(
            'exad_fg_item_content_bg_color',
            [
                'label' => esc_html__('Background Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f2f2f2',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'exad_fg_item_content_container_padding',
            [
                'label' => esc_html__('Padding', 'essential-addons-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'exad_fg_item_content_border',
                'label' => esc_html__('Border', 'essential-addons-elementor'),
                'selector' => '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'exad_fg_item_content_shadow',
                'selector' => '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content',
            ]
        );

        $this->add_control(
            'exad_fg_item_content_title_typography_settings',
            [
                'label' => esc_html__('Title Typography', 'essential-addons-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'exad_fg_item_content_title_color',
            [
                'label' => esc_html__('Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#F56A6A',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content .title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'exad_fg_item_content_title_hover_color',
            [
                'label' => esc_html__('Hover Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3F51B5',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content .title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'exad_fg_item_content_title_typography',
                'selector' => '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content .title a',
            ]
        );

        $this->add_control(
            'exad_fg_item_content_text_typography_settings',
            [
                'label' => esc_html__('Content Typography', 'essential-addons-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'exad_fg_item_content_text_color',
            [
                'label' => esc_html__('Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'exad_fg_item_content_text_typography',
                'selector' => '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content p',
            ]
        );

        $this->add_responsive_control(
            'exad_fg_item_content_alignment',
            [
                'label' => esc_html__('Content Alignment', 'essential-addons-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => true,
                'separator' => 'before',
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'essential-addons-elementor'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'essential-addons-elementor'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'essential-addons-elementor'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'prefix_class' => 'exad-fg-content-align-',
            ]
        );

        $this->end_controls_section();
    }

    public function sorter_class($string)
    {
        $sorter_class = strtolower($string);
        $sorter_class = preg_replace('/[^a-z0-9_\s-]/', "", $sorter_class);
        $sorter_class = preg_replace("/[\s-]+/", " ", $sorter_class);
        $sorter_class = preg_replace("/[\s_]/", "-", $sorter_class);

        return $sorter_class;
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if ($settings['exad_fg_filter_animation_style'] == 'default') {
            $fg_animation = 'fade translateZ(-100px)';
        } elseif ($settings['exad_fg_filter_animation_style'] == 'effect-in') {
            $fg_animation = 'fade translateY(-100%)';
        } elseif ($settings['exad_fg_filter_animation_style'] == 'effect-out') {
            $fg_animation = 'fade translateY(-100%)';
        }

        ?>
        <div class="exad-gallery one">
            <div id="exad-gallery-one">
                <div id="filters" class="exad-gallery-menu">
                    <button class="filter-item is-checked" data-filter="*">All</button>

                    <?php foreach( $settings['exad_fg_controls'] as $control ) { ?>
                        <button class="filter-item" data-filter=".<?php echo esc_attr( $control['exad_fg_control'] ); ?>"><?php echo esc_attr( $control['exad_fg_control'] ); ?></button>
                    <?php } ?>
                    
                </div>
                <div class="exad-gallery-element">

                    <?php foreach( $settings['exad_fg_gallery_items'] as $gallery ) { ?>
                        <div class="exad-gallery-item <?php echo esc_attr( $gallery['exad_fg_gallery_control_name'] ); ?>">
                            <img src="<?php echo esc_url( $gallery['exad_fg_gallery_img']['url'] ); ?>" alt="Gallery-1">
                            <div class="exad-gallery-item-overlay">
                                <div class="exad-gallery-item-overlay-content">
                                    <a href="<?php echo esc_url( $gallery['exad_fg_gallery_img']['url'] ); ?>" class="image-view-one">
                                        <i class="fa fa-search"></i>
                                    </a>
                                    <a href="#"><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>

<?php
}

protected function content_template() {}

}


Plugin::instance()->widgets_manager->register_widget_type(new Exad_Filterable_Gallery());
