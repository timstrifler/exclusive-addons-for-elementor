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
        return esc_html__('Filterable Gallery', 'exclusive-addons-elementor');
    }

    public function get_icon()
    {
        return 'exad-element-icon eicon-gallery-grid';
    }

    public function get_categories()
    {
        return ['exclusive-addons-elementor'];
    }

    public function get_script_depends()
    {
        return [ 'exad-gallery-isotope' ];
    }

    protected function _register_controls()
    {
        /**
         * Filter Gallery Settings
         */
        $this->start_controls_section(
            'exad_section_fg_settings',
            [
                'label' => esc_html__('Filterable Gallery Settings', 'exclusive-addons-elementor')
            ]
        );

        $this->add_control(
            'exad_fg_columns',
            [
                'label'   => esc_html__('Number of Columns', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'exad-col-3',
                'options' => [
                    'exad-col-1' => esc_html__('Single Column', 'exclusive-addons-elementor'),
                    'exad-col-2' => esc_html__('Two Columns',   'exclusive-addons-elementor'),
                    'exad-col-3' => esc_html__('Three Columns', 'exclusive-addons-elementor'),
                    'exad-col-4' => esc_html__('Four Columns',  'exclusive-addons-elementor'),
                    'exad-col-5' => esc_html__('Five Columns',  'exclusive-addons-elementor')
                ]
            ]
        );

        $this->add_control(
            'exad_fg_grid_hover_style',
            [
                'label'   => esc_html__('Hover Style', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'exad-zoom-in',
                'options' => [
                    'exad-zoom-in'      => esc_html__('Zoom In', 'exclusive-addons-elementor'),
                    'exad-slide-left'   => esc_html__('Slide In Left',   'exclusive-addons-elementor'),
                    'exad-slide-right'  => esc_html__('Slide In Right', 'exclusive-addons-elementor'),
                    'exad-slide-top'    => esc_html__('Slide In Top', 'exclusive-addons-elementor'),
                    'exad-slide-bottom' => esc_html__('Slide In Bottom', 'exclusive-addons-elementor')
                ],
                'condition' => [
                    'exad_fg_preset' => 'one'
                ]
            ]
        );

        $this->add_control(
            'exad_section_fg_zoom_icon',
            [
                'label'   => esc_html__('Zoom Icon', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::ICON,
                'default' => 'fa fa-search-plus'
            ]
        );

        $this->add_control(
            'exad_section_fg_link_icon',
            [
                'label'   => esc_html__('Link Icon', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::ICON,
                'default' => 'fa fa-link'
            ]
        );

        $this->add_control(
            'exad_gallery_show_all_items_text',
            [
                'label'        => __('Show All Items?', 'exclusive-addons-elementor'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_gallery_all_items_text',
            [
                'label'     => esc_html__('Text for All Item', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'All',
                'condition' => [
                    'exad_gallery_show_all_items_text' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Filter Gallery Grid Settings
         */
        $this->start_controls_section(
            'exad_section_fg_grid_settings',
            [
                'label' => esc_html__('Gallery Item Settings', 'exclusive-addons-elementor')
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
                    ['exad_fg_gallery_item_name' => 'Gallery Item Name']
                ],
                'fields' => [
                    [
                        'name'        => 'exad_fg_gallery_item_name',
                        'label'       => esc_html__('Item Name', 'exclusive-addons-elementor'),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => esc_html__('Gallery item name', 'exclusive-addons-elementor')
                    ],
                    [
                        'name'        => 'exad_fg_gallery_item_content',
                        'label'       => esc_html__('Item Content', 'exclusive-addons-elementor'),
                        'type'        => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                        'default'     => esc_html__('Lorem ipsum dolor sit amet.', 'exclusive-addons-elementor')
                    ],
                    [
                        'name'        => 'exad_fg_gallery_control_name',
                        'label'       => esc_html__('Control Name', 'exclusive-addons-elementor'),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true
                    ],
                    [
                        'name'    => 'exad_fg_gallery_img',
                        'label'   => esc_html__('Image', 'exclusive-addons-elementor'),
                        'type'    => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src()
                        ]
                    ],
                    [
                        'name'         => 'exad_fg_gallery_link',
                        'label'        => __('Gallery Link?', 'exclusive-addons-elementor'),
                        'type'         => Controls_Manager::SWITCHER,
                        'default'      => 'true',
                        'label_on'     => esc_html__('Yes', 'exclusive-addons-elementor'),
                        'label_off'    => esc_html__('No', 'exclusive-addons-elementor'),
                        'return_value' => 'true'
                    ],
                    [
                        'name'        => 'exad_fg_gallery_img_link',
                        'type'        => Controls_Manager::URL,
                        'label_block' => true,
                        'default'     => [
                            'url'         => '#',
                            'is_external' => ''
                        ],
                        'show_external' => true,
                        'condition'   => [
                            'exad_fg_gallery_link' => 'true'
                        ]
                    ]
                ],
                'title_field' => '{{exad_fg_gallery_item_name}}'
            ]
        );

        $this->end_controls_section();

        /**
         * Filter Gallery Grid Settings
         */
        $this->start_controls_section(
            'exad_section_fg_popup_settings',
            [
                'label' => esc_html__('Popup Settings', 'exclusive-addons-elementor')
            ]
        );

        $this->add_control(
            'exad_fg_show_popup',
            [
                'label'        => __('Show Popup', 'exclusive-addons-elementor'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'true',
                'label_on'     => esc_html__('Yes', 'exclusive-addons-elementor'),
                'label_off'    => esc_html__('No', 'exclusive-addons-elementor'),
                'return_value' => 'true'
            ]
        );

        $this->add_control(
            'exad_fg_show_popup_gallery',
            [
                'label'        => __('Show Popup Gallery', 'exclusive-addons-elementor'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'true',
                'label_on'     => esc_html__('Yes', 'exclusive-addons-elementor'),
                'label_off'    => esc_html__('No', 'exclusive-addons-elementor'),
                'return_value' => 'true',
                'condition'    => [
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
                'label' => esc_html__('General Style', 'exclusive-addons-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_fg_preset',
            [
                'label'   => esc_html__('Preset', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'one'   => __( 'One', 'exclusive-addons-elementor' ),
                    'two'   => __( 'Two', 'exclusive-addons-elementor' ),
                    'three' => __( 'Three', 'exclusive-addons-elementor' )
				],
                'default' => 'one'
            ]
        );

        $this->add_control(
            'exad_fg_bg_color',
            [
                'label'     => esc_html__('Background Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-wrapper' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_fg_container_padding',
            [
                'label'      => esc_html__('Padding', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-filter-gallery-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_fg_container_margin',
            [
                'label'      => esc_html__('Margin', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-filter-gallery-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_fg_border',
                'label'    => esc_html__('Border', 'exclusive-addons-elementor'),
                'selector' => '{{WRAPPER}} .exad-filter-gallery-wrapper'
            ]
        );

        $this->add_control(
            'exad_fg_border_radius',
            [
                'label'   => esc_html__('Border Radius', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0
                ],
                'range'   => [
                    'px'  => [
                        'max' => 500
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-wrapper' => 'border-radius: {{SIZE}}px;'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'exad_fg_shadow',
                'selector' => '{{WRAPPER}} .exad-filter-gallery-wrapper'
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
                'label' => esc_html__('Control Style', 'exclusive-addons-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_responsive_control(
            'exad_fg_control_padding',
            [
                'label'      => esc_html__('Padding', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-gallery-menu .filter-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_fg_control_typography',
                'selector' => '{{WRAPPER}} .exad-gallery-menu .filter-item'
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'exad_fg_control_shadow',
                'selector'  => '{{WRAPPER}} .exad-gallery-menu',
                'separator' => 'before'
            ]
        );
        // Tabs
        $this->start_controls_tabs('exad_fg_control_tabs');

        // Normal State Tab
        $this->start_controls_tab('exad_fg_control_normal', ['label' => esc_html__('Normal', 'exclusive-addons-elementor')]);

        $this->add_control(
            'exad_fg_control_normal_text_color',
            [
                'label'     => esc_html__('Text Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#444',
                'selectors' => [
                    '{{WRAPPER}} .exad-gallery-menu .filter-item' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'exad_fg_control_normal_bg_color',
            [
                'label'     => esc_html__('Background Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .exad-gallery-menu .filter-item' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_fg_control_normal_border',
                'label'    => esc_html__('Border', 'exclusive-addons-elementor'),
                'selector' => '{{WRAPPER}} .exad-gallery-menu .filter-item'
            ]
        );

        $this->add_control(
            'exad_fg_control_normal_border_radius',
            [
                'label'   => esc_html__('Border Radius', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 20
                ],
                'range'  => [
                    'px' => [
                        'max' => 30
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .exad-gallery-menu .filter-item' => 'border-radius: {{SIZE}}px;'
                ]
            ]
        );

        $this->end_controls_tab();

        // Active State Tab
        $this->start_controls_tab('exad_cta_btn_hover', ['label' => esc_html__('Active', 'exclusive-addons-elementor')]);

        $this->add_control(
            'exad_fg_control_active_text_color',
            [
                'label'     => esc_html__('Text Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .exad-gallery-menu .filter-item.is-checked' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .exad-gallery-menu .filter-item:hover'      => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'exad_fg_control_active_bg_color',
            [
                'label'     => esc_html__('Background Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#3F51B5',
                'selectors' => [
                    '{{WRAPPER}} .exad-gallery-menu .filter-item.is-checked' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .exad-gallery-menu .filter-item:hover'      => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_fg_control_active_border',
                'label'    => esc_html__('Border', 'exclusive-addons-elementor'),
                'selector' => '{{WRAPPER}} .exad-gallery-menu .filter-item.is-checked'
            ]
        );

        $this->add_control(
            'exad_fg_control_active_border_radius',
            [
                'label'   => esc_html__('Border Radius', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 20
                ],
                'range'  => [
                    'px' => [
                        'max' => 30
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .exad-gallery-menu .filter-item.is-checked' => 'border-radius: {{SIZE}}px;'
                ]
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
                'label' => esc_html__('Item Style', 'exclusive-addons-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'exad_fg_item_container_padding',
            [
                'label'      => esc_html__('Padding', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-gallery-element .exad-gallery-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .exad-gallery-element .exad-gallery-item .exad-gallery-item-overlay' => 'top: {{TOP}}{{UNIT}}; right: {{TOP}}{{UNIT}}; bottom: {{TOP}}{{UNIT}}; left: {{TOP}}{{UNIT}};'
                ],
                'condition' => [
                    'exad_fg_preset!' => 'two'
                ]
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
                'label' => esc_html__('Item Caption Style', 'exclusive-addons-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_fg_item_overlay_color',
            [
                'label'     => esc_html__('Overlay Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(0,0,0,0.7)',
                'selectors' => [
                    '{{WRAPPER}} .exad-gallery-element .exad-gallery-item .exad-gallery-item-overlay' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'exad_fg_item_caption_description',
            [
                'label'     => esc_html__('Description Style', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'exad_fg_item_caption_hover_icon',
            [
                'label'     => esc_html__('Icon Style', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        // Tabs
        $this->start_controls_tabs('exad_fg_item_icon_tabs');

            // Normal icon Tab
            $this->start_controls_tab('exad_fg_item_icon_normal', ['label' => esc_html__('Normal', 'exclusive-addons-elementor')]);

                $this->add_control(
                    'exad_fg_item_icon_normal_bg_color',
                    [
                        'label'     => esc_html__('Background Color', 'exclusive-addons-elementor'),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-gallery-item .exad-gallery-item-overlay .exad-gallery-item-overlay-content a' => 'background: {{VALUE}};'
                        ]
                    ]
                );
        
                $this->add_control(
                    'exad_fg_item_icon_normal_color',
                    [
                        'label'     => esc_html__('Color', 'exclusive-addons-elementor'),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#222222',
                        'selectors' => [
                            '{{WRAPPER}} .exad-gallery-item .exad-gallery-item-overlay .exad-gallery-item-overlay-content a i' => 'color: {{VALUE}};'
                        ]
                    ]
                );

            $this->end_controls_tab();

            // Hover icon Tab
            $this->start_controls_tab('exad_fg_item_icon_hover', ['label' => esc_html__('Hover', 'exclusive-addons-elementor')]);

                $this->add_control(
                    'exad_fg_item_icon_hover_bg_color',
                    [
                        'label'     => esc_html__('Background Color', 'exclusive-addons-elementor'),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#222222',
                        'selectors' => [
                            '{{WRAPPER}} .exad-gallery-item .exad-gallery-item-overlay .exad-gallery-item-overlay-content a:hover' => 'background: {{VALUE}};'
                        ]
                    ]
                );
        
                $this->add_control(
                    'exad_fg_item_icon_hover_color',
                    [
                        'label'     => esc_html__('Color', 'exclusive-addons-elementor'),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#fff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-gallery-item .exad-gallery-item-overlay .exad-gallery-item-overlay-content a:hover i' => 'color: {{VALUE}};'
                        ]
                    ]
                );
            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Filterable Gallery Item Content Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'exad_section_fg_item_content_style_settings',
            [
                'label' => esc_html__('Item Content Style', 'exclusive-addons-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_fg_item_content_bg_color',
            [
                'label'     => esc_html__('Background Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f2f2f2',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_fg_item_content_container_padding',
            [
                'label'      => esc_html__('Padding', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_fg_item_content_border',
                'label'    => esc_html__('Border', 'exclusive-addons-elementor'),
                'selector' => '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'exad_fg_item_content_shadow',
                'selector' => '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content'
            ]
        );

        $this->add_control(
            'exad_fg_item_content_title_typography_settings',
            [
                'label'     => esc_html__('Title Typography', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'exad_fg_item_content_title_color',
            [
                'label'     => esc_html__('Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#F56A6A',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content .title a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'exad_fg_item_content_title_hover_color',
            [
                'label'     => esc_html__('Hover Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#3F51B5',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content .title a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_fg_item_content_title_typography',
                'selector' => '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content .title a'
            ]
        );

        $this->add_control(
            'exad_fg_item_content_text_typography_settings',
            [
                'label'     => esc_html__('Content Typography', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'exad_fg_item_content_text_color',
            [
                'label'     => esc_html__('Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#444',
                'selectors' => [
                    '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content p' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_fg_item_content_text_typography',
                'selector' => '{{WRAPPER}} .exad-filter-gallery-container.exad-cards .item-content p'
            ]
        );

        $this->add_responsive_control(
            'exad_fg_item_content_alignment',
            [
                'label'       => esc_html__('Content Alignment', 'exclusive-addons-elementor'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => true,
                'separator'   => 'before',
                'options'     => [
                    'left'    => [
                        'title' => esc_html__('Left', 'exclusive-addons-elementor'),
                        'icon'  => 'fa fa-align-left'
                    ],
                    'center'  => [
                        'title' => esc_html__('Center', 'exclusive-addons-elementor'),
                        'icon'  => 'fa fa-align-center'
                    ],
                    'right'   => [
                        'title' => esc_html__('Right', 'exclusive-addons-elementor'),
                        'icon'  => 'fa fa-align-right'
                    ]
                ],
                'default' => 'left',
                'prefix_class' => 'exad-fg-content-align-'
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        echo '<div class="exad-gallery '.esc_attr( $settings['exad_fg_preset'] ).'">';
            echo '<div id="exad-gallery-one">';
                echo '<div id="filters" class="exad-gallery-menu">';
                    if(('yes' == $settings['exad_gallery_show_all_items_text']) && !empty($settings['exad_gallery_all_items_text'])):
                        echo '<button class="filter-item is-checked" data-filter="*">'.esc_html($settings['exad_gallery_all_items_text']);
                    endif;
                    $exad_gallerycontrols                  = array_column($settings['exad_fg_gallery_items'], 'exad_fg_gallery_control_name');
                    $exad_gallery_controls_comma_separated = implode(', ', $exad_gallerycontrols);
                    $exad_gallery_controls_array           = explode(",",$exad_gallery_controls_comma_separated);
                    $exad_gallery_controls_lowercase       = array_map('strtolower', $exad_gallery_controls_array);
                    $exad_gallery_controls_remove_space    = array_filter(array_map('trim', $exad_gallery_controls_lowercase));
                    $exad_gallery_controls_items           = array_unique($exad_gallery_controls_remove_space);

                    foreach( $exad_gallery_controls_items as $control ) :
                        $control_attribute = preg_replace('#[ -]+#', '-', $control);
                        echo '<button class="filter-item" data-filter=".'.esc_attr($control_attribute).'">'.esc_attr($control).'</button>';
                    endforeach;
                echo '</div>';

                echo '<div class="exad-gallery-element">';
                    foreach( $settings['exad_fg_gallery_items'] as $gallery ) :
                        $exad_controls       = $gallery['exad_fg_gallery_control_name'];
                        $exad_controls_to_array       = explode(",",$exad_controls);
                        $exad_controls_to_lowercase = array_map('strtolower', $exad_controls_to_array);
                        $exad_controls_remove_space       = array_filter(array_map('trim', $exad_controls_to_lowercase));
                        $exad_controls_space_replaced    = array_map(function($val) { return str_replace(' ', '-', $val); }, $exad_controls_remove_space);
                        $exad_control       = implode (" ", $exad_controls_space_replaced);

                        echo '<div class="exad-gallery-item '.esc_attr($exad_control). ' '.esc_attr( $settings['exad_fg_columns'] ).'">';
                            echo '<img src="'.esc_url( $gallery['exad_fg_gallery_img']['url'] ).'" alt="Gallery-1">';
                            echo '<div class="exad-gallery-item-overlay '.esc_attr( $settings['exad_fg_grid_hover_style'] ).'">';
                                echo '<div class="exad-gallery-item-overlay-content">';

                                    if($settings['exad_fg_show_popup'] === 'true' ) :
                                        echo '<a href="'.esc_url( $gallery['exad_fg_gallery_img']['url'] ).'" class="image-view-one">';
                                            echo '<i class="'.esc_attr( $settings['exad_section_fg_zoom_icon'] ).'"></i>';
                                        echo '</a>';
                                    else :
                                        echo '<a href="" class="image-view-one">';
                                            echo '<i class="'.esc_attr( $settings['exad_section_fg_zoom_icon'] ).'"></i>';
                                        echo '</a>';
                                    endif; 

                                    echo '<a href="#"><i class="'.esc_attr( $settings['exad_section_fg_link_icon'] ).'"></i></a>';
                                    echo '<div class="exad-gallery-item-description">';
                                        echo '<p>'.wp_kses_post( $gallery['exad_fg_gallery_item_content']).'</p>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    endforeach;

                echo '</div>';
            echo '</div>';
        echo '</div>';

}

protected function content_template() {}

}


Plugin::instance()->widgets_manager->register_widget_type(new Exad_Filterable_Gallery());
