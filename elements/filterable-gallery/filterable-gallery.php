<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class Exad_Filterable_Gallery extends Widget_Base
{

    public function get_name(){
        return 'exad-filterable-gallery';
    }

    public function get_title(){
        return esc_html__('Filterable Gallery', 'exclusive-addons-elementor');
    }

    public function get_icon(){
        return 'exad-element-icon eicon-gallery-grid';
    }

    public function get_categories(){
        return ['exclusive-addons-elementor'];
    }

    public function get_script_depends(){
        return [ 'exad-gallery-isotope' ];
    }

    public function get_keywords() {
        return [ 'gallery', 'filter', 'masonry', 'portfolio', 'filterable', 'grid' ];
    }

    protected function _register_controls()
    {
        /**
         * Filter Gallery Settings
         */
        $this->start_controls_section(
            'exad_section_fg_settings',
            [
                'label' => esc_html__('Settings', 'exclusive-addons-elementor')
            ]
        );

        $this->add_control(
            'exad_fg_columns',
            [
                'label'   => esc_html__('Columns', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'exad-col-2',
                'options' => [
                    'exad-col-1' => esc_html__('1', 'exclusive-addons-elementor'),
                    'exad-col-2' => esc_html__('2',   'exclusive-addons-elementor'),
                    'exad-col-3' => esc_html__('3', 'exclusive-addons-elementor'),
                    'exad-col-4' => esc_html__('4',  'exclusive-addons-elementor')
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
                ]
            ]
        );

        $this->add_control(
            'exad_fg_show_icons',
            [
                'label'   => __('Show Icons', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'both',
                'options' => [
                    'popup' => 'PopUp',
                    'link'  => 'Link',
                    'both'  => 'PopUp and Link',
                    'none'  => 'None'
                ]
            ]
        );

        $this->add_control(
            'exad_section_fg_zoom_icon',
            [
                'label'   => esc_html__('PopUp Icon', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-search',
                    'library' => 'solid'
                ],
                'condition' => [
                    'exad_fg_show_icons' => [ 'popup', 'both']
                ]
            ]
        );

        $this->add_control(
            'exad_section_fg_link_icon',
            [
                'label'   => esc_html__('Link Icon', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-link',
                    'library' => 'solid'
                ],
                'condition' => [
                    'exad_fg_show_icons' => [ 'link', 'both']
                ]
            ]
        );

        $this->add_control(
            'exad_fg_show_constrols',
            [
                'label'        => __('Show Controls?', 'exclusive-addons-elementor'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_fg_all_items_text',
            [
                'label'     => esc_html__('Text for All Item', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::TEXT,
                'default'   => __('All', 'exclusive-addons-elementor'),
                'condition' => [
                    'exad_fg_show_constrols' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'exad_fg_show_title',
            [
                'label'        => __('Enable Title.', 'exclusive-addons-elementor'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_fg_show_details',
            [
                'label'        => __('Enable Details.', 'exclusive-addons-elementor'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->end_controls_section();

        /**
         * Filter Gallery Grid Settings
         */
        $this->start_controls_section(
            'exad_section_fg_grid_settings',
            [
                'label' => esc_html__('Items', 'exclusive-addons-elementor')
            ]
        );

        $this->add_control(
            'exad_fg_gallery_items',
            [
                'type'      => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'default' => [
                    ['exad_fg_gallery_control_name' => 'Design, Branding'],
                    ['exad_fg_gallery_control_name' => 'Interior'],
                    ['exad_fg_gallery_control_name' => 'Development'],
                    ['exad_fg_gallery_control_name' => 'Design, Interior'],
                    ['exad_fg_gallery_control_name' => 'Branding, Development'],
                    ['exad_fg_gallery_control_name' => 'Design, Development']
                ],
                'fields' => [
                    [
                        'name'        => 'exad_fg_gallery_item_title',
                        'label'       => esc_html__('Title', 'exclusive-addons-elementor'),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => esc_html__('Gallery item title', 'exclusive-addons-elementor')
                    ],
                    [
                        'name'        => 'exad_fg_gallery_item_content',
                        'label'       => esc_html__('Details', 'exclusive-addons-elementor'),
                        'type'        => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                        'default'     => esc_html__('Lorem ipsum dolor sit amet.', 'exclusive-addons-elementor')
                    ],
                    [
                        'name'        => 'exad_fg_gallery_control_name',
                        'label'       => esc_html__('Control Name', 'exclusive-addons-elementor'),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'description' => __( '<b>Comma separate gallery controls. Example: Design, Branding</b>', 'exclusive-addons-elementor' )
                    ],
                    [
                        'name'        => 'exad_fg_gallery_img',
                        'label'       => esc_html__('Image', 'exclusive-addons-elementor'),
                        'type'        => Controls_Manager::MEDIA,
                        'default'     => [
                            'url'     => Utils::get_placeholder_image_src()
                        ]
                    ],
                    [
                        'name'        => 'exad_fg_gallery_img_link',
                        'type'        => Controls_Manager::URL,
                        'label_block' => true,
                        'default'     => [
                            'url'     => '#'
                        ]
                    ]
                ],
                'title_field' => '{{exad_fg_gallery_item_title}}'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_fg_item_container_style',
            [
                'label' => esc_html__('Container', 'exclusive-addons-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'           => 'exad_fg_container_shadow',
                'selector'       => '{{WRAPPER}} .exad-gallery-content-wrapper'
            ]
        );

        $this->add_responsive_control(
            'exad_fg_container_padding',
            [
                'label'      => esc_html__('Padding', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-gallery-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
                    '{{WRAPPER}} .exad-gallery-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_section_fg_control_style_settings',
            [
                'label' => esc_html__('Control', 'exclusive-addons-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_fg_control_item_container_style',
            [
                'label'     => esc_html__('Control Container', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::HEADING
            ]
        );

        $this->add_responsive_control(
            'exad_fg_control_container_padding',
            [
                'label'      => esc_html__('Padding', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'    => 0,
                    'right'  => 30,
                    'bottom' => 0,
                    'left'   => 30,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-gallery-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_fg_control_container_margin',
            [
                'label'      => esc_html__('Margin', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 50,
                    'left'   => 30,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-gallery-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'           => 'exad_fg_control_shadow',
                'selector'       => '{{WRAPPER}} .exad-gallery-menu',
                'fields_options' => [
                    'box_shadow_type' => [ 
                        'default' =>'yes' 
                    ],
                    'box_shadow'  => [
                        'default' => [
                            'horizontal' => 0,
                            'vertical'   => 10,
                            'blur'       => 33,
                            'spread'     => 0,
                            'color'      => 'rgba(51, 77, 128, 0.1)'
                        ]
                    ]
                ]
            ]
        );

        $this->add_control(
            'exad_fg_control_item_style',
            [
                'label'     => esc_html__('Control Items', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'exad_fg_control_item_padding',
            [
                'label'      => esc_html__('Padding', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'    => 20,
                    'right'  => 20,
                    'bottom' => 20,
                    'left'   => 20,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-gallery-menu .filter-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_fg_control_typography',
                'selector' => '{{WRAPPER}} .exad-gallery-menu .filter-item',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'fields_options'  => [
                    'text_transform' => [
                        'default' => 'capitalize'
                    ]
                ]
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
                'default'   => '#444444',
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
                'name'           => 'exad_fg_control_normal_border',
                'label'          => esc_html__('Border', 'exclusive-addons-elementor'),
                'fields_options' => [
                    'border' => [
                        'default' => 'solid'
                    ],
                    'width'  => [
                        'default' => [
                            'top'    => '0',
                            'right'  => '0',
                            'bottom' => '2',
                            'left'   => '0'
                        ]
                    ],
                    'color' => [
                        'default' => 'rgba(255,255,255,0)'
                    ]
                ],
                'selector' => '{{WRAPPER}} .exad-gallery-menu .filter-item'
            ]
        );

        $this->add_control(
            'exad_fg_control_normal_border_radius',
            [
                'label'   => esc_html__('Border Radius', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SLIDER,
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

        // Hover State Tab
        $this->start_controls_tab('exad_fg_control_btn_hover', ['label' => esc_html__('Hover', 'exclusive-addons-elementor')]);

        $this->add_control(
            'exad_fg_control_hover_text_color',
            [
                'label'     => esc_html__('Text Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FC6373',
                'selectors' => [
                    '{{WRAPPER}} .exad-gallery-menu .filter-item:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'exad_fg_control_hover_bg_color',
            [
                'label'     => esc_html__('Background Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exad-gallery-menu .filter-item:hover'      => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_fg_control_hover_border',
                'label'    => esc_html__('Border', 'exclusive-addons-elementor'),
                'selector' => '{{WRAPPER}} .exad-gallery-menu .filter-item:hover'
            ]
        );

        $this->add_control(
            'exad_fg_control_hover_border_radius',
            [
                'label' => esc_html__('Border Radius', 'exclusive-addons-elementor'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 30
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .exad-gallery-menu .filter-item:hover' => 'border-radius: {{SIZE}}px;'
                ]
            ]
        );

        $this->end_controls_tab();

        // Active State Tab
        $this->start_controls_tab('exad_fg_control_btn_active', ['label' => esc_html__('Active', 'exclusive-addons-elementor')]);

        $this->add_control(
            'exad_fg_control_active_text_color',
            [
                'label'     => esc_html__('Text Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FC6373',
                'selectors' => [
                    '{{WRAPPER}} .exad-gallery-menu .filter-item.is-checked' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'exad_fg_control_active_bg_color',
            [
                'label'     => esc_html__('Background Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exad-gallery-menu .filter-item.is-checked' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'exad_fg_control_active_border',
                'label'          => esc_html__('Border', 'exclusive-addons-elementor'),
                'fields_options' => [
                    'border' => [
                        'default' => 'solid'
                    ],
                    'width'  => [
                        'default' => [
                            'top'    => '0',
                            'right'  => '0',
                            'bottom' => '2',
                            'left'   => '0'
                        ]
                    ],
                    'color'  => [
                        'default' => '#FC6373'
                    ]
                ],
                'selector' => '{{WRAPPER}} .exad-gallery-menu .filter-item.is-checked'
            ]
        );

        $this->add_control(
            'exad_fg_control_active_border_radius',
            [
                'label' => esc_html__('Border Radius', 'exclusive-addons-elementor'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
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
                'label'     => esc_html__('Icon', 'exclusive-addons-elementor'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_fg_show_icons!' => 'none'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_fg_item_icon_size',
            [
                'label'      => esc_html__('Size', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default'    => [
                    'size' => 60,
                    'unit' => 'px'
                ],
                'tablet_default' => [
                    'size' => 50,
                    'unit' => 'px'
                ],
                'mobile_default' => [
                    'size' => 40,
                    'unit' => 'px'
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 80
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .exad-gallery-item .exad-gallery-item-overlay .exad-gallery-item-overlay-content a' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
                ] 
            ]
        );   

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_fg_item_icon_typography',
                'selector' => '{{WRAPPER}} .exad-gallery-item .exad-gallery-item-overlay .exad-gallery-item-overlay-content a i',                
                'exclude'  => [
                    'text_transform', 'font_family'
                ]
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
                        'default'   => '#ffffff',
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
                'label' => esc_html__('Content', 'exclusive-addons-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_fg_grid_content_position',
            [
                'label'   => esc_html__('Content Position', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'over-image',
                'options' => [
                    'over-image'  => esc_html__('Over Image(when hover)', 'exclusive-addons-elementor'),
                    'below-image' => esc_html__('Below Image',   'exclusive-addons-elementor')
                ]
            ]
        );

        $this->add_control(
            'exad_fg_content_area_style',
            [
                'label'     => esc_html__('Content Area', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::HEADING
            ]
        );

        $this->add_control(
            'exad_fg_item_content_bg_color',
            [
                'label'     => esc_html__('Background Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exad-gallery-items .exad-gallery-item-content' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_fg_content_padding',
            [
                'label'      => esc_html__('Padding', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'    => 0,
                    'right'  => 20,
                    'bottom' => 15,
                    'left'   => 20,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-gallery-item .exad-gallery-item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_fg_item_content_alignment',
            [
                'label'       => esc_html__('Content Alignment', 'exclusive-addons-elementor'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => true,
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
                'selectors' => [
                    '{{WRAPPER}} .exad-gallery-items .exad-gallery-item-content' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'exad_fg_item_content_title_typography_settings',
            [
                'label'     => esc_html__('Title', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'exad_fg_show_title' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'exad_fg_item_content_title_color',
            [
                'label'     => esc_html__('Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#F56A6A',
                'selectors' => [
                    '{{WRAPPER}} .exad-gallery-items .exad-gallery-item-content h2' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'exad_fg_show_title' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'exad_fg_item_content_title_typography',
                'selector'  => '{{WRAPPER}} .exad-gallery-items .exad-gallery-item-content h2',
                'fields_options'  => [
                    'font_size'   => [
                        'default' => [
                            'unit' => 'px',
                            'size' => 20
                        ]
                    ]
                ],
                'condition' => [
                    'exad_fg_show_title' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_fg_item_content_title_margin',
            [
                'label'      => esc_html__('Margin', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'    => 10,
                    'right'  => 0,
                    'bottom' => 10,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-gallery-items .exad-gallery-item-content h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'exad_fg_show_title' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'exad_fg_item_details_text_typography_settings',
            [
                'label'     => esc_html__('Details', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'exad_fg_show_details' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'exad_fg_item_details_text_color',
            [
                'label'     => esc_html__('Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#F56A6A',
                'selectors' => [
                    '{{WRAPPER}} .exad-gallery-items .exad-gallery-item-content p' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'exad_fg_show_details' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'exad_fg_item_details_text_typography',
                'selector'  => '{{WRAPPER}} .exad-gallery-items .exad-gallery-item-content p',
                'condition' => [
                    'exad_fg_show_details' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_fg_item_details_title_margin',
            [
                'label'      => esc_html__('Margin', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'    => 10,
                    'right'  => 0,
                    'bottom' => 10,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-gallery-items .exad-gallery-item-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'  => [
                    'exad_fg_show_details' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'exad_fg_hover_overlay_style',
            [
                'label'     => esc_html__('Hover Overlay', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
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

        $this->end_controls_section();
    }

    protected function render() {
        
        $settings     = $this->get_settings_for_display();
        $show_title   = $settings['exad_fg_show_title'];
        $show_details = $settings['exad_fg_show_details'];

        do_action('exad_fg_wrapper_before');
        echo '<div class="exad-gallery-items">';
            echo '<div id="exad-gallery-one">';
                if( 'yes' == $settings['exad_fg_show_constrols'] ):
                    echo '<div id="filters" class="exad-gallery-menu">';
                        do_action('exad_fg_controls_wrapper_before');
                        if(!empty($settings['exad_fg_all_items_text'])):
                            echo '<button class="filter-item is-checked" data-filter="*">'.esc_html($settings['exad_fg_all_items_text']);
                        endif;
                        $exad_gallerycontrols                  = array_column($settings['exad_fg_gallery_items'], 'exad_fg_gallery_control_name');
                        $exad_fg_controls_comma_separated = implode(', ', $exad_gallerycontrols);
                        $exad_fg_controls_array           = explode(",",$exad_fg_controls_comma_separated);
                        $exad_fg_controls_lowercase       = array_map('strtolower', $exad_fg_controls_array);
                        $exad_fg_controls_remove_space    = array_filter(array_map('trim', $exad_fg_controls_lowercase));
                        $exad_fg_controls_items           = array_unique($exad_fg_controls_remove_space);

                        foreach( $exad_fg_controls_items as $control ) :
                            $control_attribute = preg_replace('#[ -]+#', '-', $control);
                            echo '<button class="filter-item" data-filter=".'.esc_attr($control_attribute).'">'.esc_attr($control).'</button>';
                        endforeach;
                        do_action('exad_fg_controls_wrapper_after');
                    echo '</div>';
                endif;

                echo '<div class="exad-gallery-element">';
                    foreach( $settings['exad_fg_gallery_items'] as $index => $gallery ) :
                        $exad_controls                = $gallery['exad_fg_gallery_control_name'];
                        $exad_controls_to_array       = explode(",",$exad_controls);
                        $exad_controls_to_lowercase   = array_map('strtolower', $exad_controls_to_array);
                        $exad_controls_remove_space   = array_filter(array_map('trim', $exad_controls_to_lowercase));
                        $exad_controls_space_replaced = array_map(function($val) { return str_replace(' ', '-', $val); }, $exad_controls_remove_space);
                        $exad_control                 = implode (" ", $exad_controls_space_replaced);

                        do_action('exad_fg_item_wrapper_before');
                        echo '<div class="exad-gallery-item '.esc_attr($exad_control). ' '.esc_attr( $settings['exad_fg_columns'] ).'">';
                            echo '<div class="exad-gallery-content-wrapper">';
                                echo '<div class="exad-gallery-image">';
                                    echo '<img src="'.esc_url( $gallery['exad_fg_gallery_img']['url'] ).'" alt="'.Control_Media::get_image_alt( $gallery['exad_fg_gallery_img'] ).'">';
                                    echo '<div class="exad-gallery-item-overlay '.esc_attr( $settings['exad_fg_grid_hover_style'] ).'">';
                                        echo '<div class="exad-gallery-item-overlay-content">';

                                            if( 'none' != $settings['exad_fg_show_icons'] ) :
                                                echo '<div class="exad-fg-icons">';
                                                    if( ( 'popup' == $settings['exad_fg_show_icons'] || 'both' == $settings['exad_fg_show_icons'] ) && !empty($settings['exad_section_fg_zoom_icon']) ) :

                                                        $link_key = 'link_' . $index;
                                                        $this->add_render_attribute( $link_key, [
                                                            'href' => esc_url( $gallery['exad_fg_gallery_img']['url'] ),
                                                            'data-elementor-open-lightbox' => 'default',
                                                            'data-elementor-lightbox-slideshow' => $this->get_id(),
                                                            'data-elementor-lightbox-index' => $index
                                                        ] );
                                                        if ( Plugin::$instance->editor->is_edit_mode() ) {
                                                            $this->add_render_attribute( $link_key, [
                                                                'class' => 'elementor-clickable'
                                                            ] );
                                                        }

                                                        echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                                                            Icons_Manager::render_icon( $settings['exad_section_fg_zoom_icon'], [ 'aria-hidden' => 'true' ] );
                                                        echo '</a>';
                                                    endif; 

                                                    if( ( 'link' == $settings['exad_fg_show_icons'] || 'both' == $settings['exad_fg_show_icons'] )  && !empty($settings['exad_section_fg_link_icon']) ) :
                                                        if ( $gallery['exad_fg_gallery_img_link']['url'] ) {
                                                            $href = 'href="'.esc_url($gallery['exad_fg_gallery_img_link']['url']).'"';
                                                        } else {
                                                            $href = '';
                                                        }
                                                        if ( $gallery['exad_fg_gallery_img_link']['is_external'] === 'on' ) {
                                                            $target = ' target= _blank';
                                                        } else {
                                                            $target = '';
                                                        }
                                                        if ( $gallery['exad_fg_gallery_img_link']['nofollow'] === 'on' ) {
                                                            $target .= ' rel= nofollow ';
                                                        }
                                                        echo '<a '.$href.esc_attr($target).'>';
                                                            Icons_Manager::render_icon( $settings['exad_section_fg_link_icon'], [ 'aria-hidden' => 'true' ] );
                                                        echo '</a>';
                                                    endif;
                                                echo '</div>'; 
                                            endif; 

                                            if('over-image' == $settings['exad_fg_grid_content_position'] && ('yes' == $show_title || 'yes' == $show_details)):
                                                echo '<div class="exad-gallery-item-content">';
                                                    do_action('exad_fg_content_wrapper_before');
                                                    if( 'yes' == $show_title && !empty( $gallery['exad_fg_gallery_item_title'] ) ):
                                                        echo '<h2>'.esc_html($gallery['exad_fg_gallery_item_title']).'</h2>';
                                                    endif;
                                                    if( 'yes' == $show_details && !empty( $gallery['exad_fg_gallery_item_content'] ) ):
                                                        echo '<p>'.wp_kses_post( $gallery['exad_fg_gallery_item_content']).'</p>';
                                                    endif;
                                                    do_action('exad_fg_content_wrapper_after');
                                                echo '</div>';
                                            endif;
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';

                                if('below-image' == $settings['exad_fg_grid_content_position'] && ('yes' == $show_title || 'yes' == $show_details)):
                                    echo '<div class="exad-gallery-item-content below-image">';
                                        do_action('exad_fg_content_wrapper_before');
                                        if( 'yes' == $show_title && !empty( $gallery['exad_fg_gallery_item_title'] ) ):
                                            echo '<h2>'.esc_html($gallery['exad_fg_gallery_item_title']).'</h2>';
                                        endif;
                                        if( 'yes' == $show_details && !empty( $gallery['exad_fg_gallery_item_content'] ) ):
                                            echo '<p>'.wp_kses_post( $gallery['exad_fg_gallery_item_content']).'</p>';
                                        endif;
                                        do_action('exad_fg_content_wrapper_after');
                                    echo '</div>';
                                endif;
                            echo '</div>';
                        echo '</div>';
                        do_action('exad_fg_item_wrapper_after');
                    endforeach;

                echo '</div>';
            echo '</div>';
        echo '</div>';
        do_action('exad_fg_wrapper_after');

    }

    protected function content_template() {}

}


Plugin::instance()->widgets_manager->register_widget_type(new Exad_Filterable_Gallery());
