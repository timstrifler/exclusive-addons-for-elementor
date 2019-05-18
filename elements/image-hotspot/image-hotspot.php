<?php
namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Image Hotspots Widget
 */
class Exad_Image_Hotspot extends Widget_Base
{

    /**
     * Retrieve image hotspots widget name.
     */
    public function get_name()
    {
        return 'exad-image-hotspot';
    }

    /**
     * Retrieve image hotspots widget title.
     */
    public function get_title()
    {
        return __('Image Hotspot', 'exclusive-addons-elementor');
    }

    /**
     * Retrieve the list of categories the image hotspots widget belongs to.
     */
    public function get_categories()
    {
        return ['exclusive-addons-elementor'];
    }

    /**
     * Retrieve image hotspots widget icon.
     */
    public function get_icon()
    {
        return 'exad-element-icon eicon-image-hotspot';
    }


    /**
     * Register image hotspots widget controls.
     */
    protected function _register_controls()
    {

        /*-----------------------------------------------------------------------------------*/
        /*	CONTENT TAB
        /*-----------------------------------------------------------------------------------*/

        /**
         * Content Tab: Image
         */
        $this->start_controls_section(
            'section_image',
            [
                'label'                 => __('Image', 'exclusive-addons-elementor'),
            ]
        );

        $this->add_control(
            'exad_hotspot_image',
            [
                'label'                 => __('Image', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::MEDIA,
                'default'               => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'                  => 'image',
                'label'                 => __('Image Size', 'exclusive-addons-elementor'),
                'default'               => 'full',
            ]
        );

        $this->end_controls_section();

        /**
         * Content Tab: Hotspots
         */
        $this->start_controls_section(
            'section_hotspots',
            [
                'label' => __('Hotspots', 'exclusive-addons-elementor'),
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs('hot_spots_tabs');

        $repeater->start_controls_tab('tab_content', ['label' => __('Content', 'exclusive-addons-elementor')]);

        $repeater->add_control(
            'hotspot_type',
            [
                'label'           => __('Type', 'exclusive-addons-elementor'),
                'type'            => Controls_Manager::SELECT,
                'default'         => 'icon',
                'options'         => [
                    'icon'  => __('Icon', 'exclusive-addons-elementor'),
                    'text'  => __('Text', 'exclusive-addons-elementor'),
                    'blank' => __('Blank', 'exclusive-addons-elementor'),
                ],
            ]
        );

        $repeater->add_control(
            'exad_hotspot_icon',
            [
                'label'           => __('Icon', 'exclusive-addons-elementor'),
                'type'            => Controls_Manager::ICON,
                'default'         => 'fa fa-plus',
                'condition'       => [
                    'hotspot_type'   => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'exad_hotspot_text',
            [
                'label'           => __('Text', 'exclusive-addons-elementor'),
                'type'            => Controls_Manager::TEXT,
                'label_block'     => true,
                'default'         => '#',
                'condition'       => [
                    'hotspot_type'   => 'text',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab('tab_position', ['label' => __('Position', 'exclusive-addons-elementor')]);

        $repeater->add_control(
            'exad_left_position',
            [
                'label'         => __('Left Position', 'exclusive-addons-elementor'),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'     => [
                        'min'     => 0,
                        'max'     => 100,
                        'step'    => 0.1,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}%;',
                ],
            ]
        );

        $repeater->add_control(
            'exad_top_position',
            [
                'label'         => __('Top Position', 'exclusive-addons-elementor'),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'     => [
                        'min'     => 0,
                        'max'     => 100,
                        'step'    => 0.1,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}%;',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab('tab_tooltip', ['label' => __('Tooltip', 'exclusive-addons-elementor')]);

        $repeater->add_control(
            'tooltip',
            [
                'label'           => __('Tooltip', 'exclusive-addons-elementor'),
                'type'            => Controls_Manager::SWITCHER,
                'default'         => '',
                'label_on'        => __('Show', 'exclusive-addons-elementor'),
                'label_off'       => __('Hide', 'exclusive-addons-elementor'),
                'return_value'    => 'yes',
            ]
        );

        $repeater->add_control(
            'tooltip_position_local',
            [
                'label'                 => __('Tooltip Position', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'global',
                'options'               => [
                    'global'        => __('Global', 'exclusive-addons-elementor'),
                    'top'           => __('Top', 'exclusive-addons-elementor'),
                    'bottom'        => __('Bottom', 'exclusive-addons-elementor'),
                    'left'          => __('Left', 'exclusive-addons-elementor'),
                    'right'         => __('Right', 'exclusive-addons-elementor'),
                    'top-left'      => __('Top Left', 'exclusive-addons-elementor'),
                    'top-right'     => __('Top Right', 'exclusive-addons-elementor'),
                    'bottom-left'   => __('Bottom Left', 'exclusive-addons-elementor'),
                    'bottom-right'  => __('Bottom Right', 'exclusive-addons-elementor'),
                ],
                'condition'       => [
                    'tooltip'   => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'tooltip_content',
            [
                'label'           => __('Tooltip Content', 'exclusive-addons-elementor'),
                'type'            => Controls_Manager::WYSIWYG,
                'default'         => __('Tooltip Content', 'exclusive-addons-elementor'),
                'condition'       => [
                    'tooltip'   => 'yes',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'exad_hotspots',
            [
                'label'                 => '',
                'type'                  => Controls_Manager::REPEATER,
                'default'               => [
                    [
                        'feature_text'    => __('Hotspot #1', 'exclusive-addons-elementor'),
                        'feature_icon'    => 'fa fa-plus',
                        'left_position'   => 20,
                        'top_position'    => 30,
                    ],
                ],
                'fields'                => array_values($repeater->get_controls()),
                'title_field'           => '{{{ hotspot_text }}}',
            ]
        );

        $this->add_control(
            'hotspot_pulse',
            [
                'label'                 => __('Glow Effect', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __('Yes', 'exclusive-addons-elementor'),
                'label_off'             => __('No', 'exclusive-addons-elementor'),
                'return_value'          => 'yes',
            ]
        );

        $this->end_controls_section();

        /**
         * Content Tab: Tooltip Settings
         */
        $this->start_controls_section(
            'section_tooltip',
            [
                'label'                 => __('Tooltip Settings', 'exclusive-addons-elementor'),
            ]
        );

        $this->add_control(
            'tooltip_arrow',
            [
                'label'                 => __('Show Arrow', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __('Yes', 'exclusive-addons-elementor'),
                'label_off'             => __('No', 'exclusive-addons-elementor'),
                'return_value'          => 'yes',
            ]
        );

        $this->add_control(
            'tooltip_size',
            [
                'label'                 => __('Size', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'default',
                'options'               => [
                    'default'       => __('Default', 'exclusive-addons-elementor'),
                    'tiny'          => __('Tiny', 'exclusive-addons-elementor'),
                    'small'         => __('Small', 'exclusive-addons-elementor'),
                    'large'         => __('Large', 'exclusive-addons-elementor')
                ],
            ]
        );

        $this->add_control(
            'tooltip_position',
            [
                'label'                 => __('Global Position', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'top',
                'options'               => [
                    'top'           => __('Top', 'exclusive-addons-elementor'),
                    'bottom'        => __('Bottom', 'exclusive-addons-elementor'),
                    'left'          => __('Left', 'exclusive-addons-elementor'),
                    'right'         => __('Right', 'exclusive-addons-elementor'),
                    'top-left'      => __('Top Left', 'exclusive-addons-elementor'),
                    'top-right'     => __('Top Right', 'exclusive-addons-elementor'),
                    'bottom-left'   => __('Bottom Left', 'exclusive-addons-elementor'),
                    'bottom-right'  => __('Bottom Right', 'exclusive-addons-elementor'),
                ],
            ]
        );

        $this->add_control(
            'tooltip_animation_in',
            [
                'label'                 => __('Animation In', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::SELECT2,
                'default'               => '',
                'options'               => [
                    'bounce'            => __('Bounce', 'exclusive-addons-elementor'),
                    'flash'             => __('Flash', 'exclusive-addons-elementor'),
                    'pulse'             => __('Pulse', 'exclusive-addons-elementor'),
                    'rubberBand'        => __('rubberBand', 'exclusive-addons-elementor'),
                    'shake'             => __('Shake', 'exclusive-addons-elementor'),
                    'swing'             => __('Swing', 'exclusive-addons-elementor'),
                    'tada'              => __('Tada', 'exclusive-addons-elementor'),
                    'wobble'            => __('Wobble', 'exclusive-addons-elementor'),
                    'bounceIn'          => __('bounceIn', 'exclusive-addons-elementor'),
                    'bounceInDown'      => __('bounceInDown', 'exclusive-addons-elementor'),
                    'bounceInLeft'      => __('bounceInLeft', 'exclusive-addons-elementor'),
                    'bounceInRight'     => __('bounceInRight', 'exclusive-addons-elementor'),
                    'bounceInUp'        => __('bounceInUp', 'exclusive-addons-elementor'),
                    'bounceOut'         => __('bounceOut', 'exclusive-addons-elementor'),
                    'bounceOutDown'     => __('bounceOutDown', 'exclusive-addons-elementor'),
                    'bounceOutLeft'     => __('bounceOutLeft', 'exclusive-addons-elementor'),
                    'bounceOutRight'    => __('bounceOutRight', 'exclusive-addons-elementor'),
                    'bounceOutUp'       => __('bounceOutUp', 'exclusive-addons-elementor'),
                    'fadeIn'            => __('fadeIn', 'exclusive-addons-elementor'),
                    'fadeInDown'        => __('fadeInDown', 'exclusive-addons-elementor'),
                    'fadeInDownBig'     => __('fadeInDownBig', 'exclusive-addons-elementor'),
                    'fadeInLeft'        => __('fadeInLeft', 'exclusive-addons-elementor'),
                    'fadeInLeftBig'     => __('fadeInLeftBig', 'exclusive-addons-elementor'),
                    'fadeInRight'       => __('fadeInRight', 'exclusive-addons-elementor'),
                    'fadeInRightBig'    => __('fadeInRightBig', 'exclusive-addons-elementor'),
                    'fadeInUp'          => __('fadeInUp', 'exclusive-addons-elementor'),
                    'fadeInUpBig'       => __('fadeInUpBig', 'exclusive-addons-elementor'),
                    'fadeOut'           => __('fadeOut', 'exclusive-addons-elementor'),
                    'fadeOutDown'       => __('fadeOutDown', 'exclusive-addons-elementor'),
                    'fadeOutDownBig'    => __('fadeOutDownBig', 'exclusive-addons-elementor'),
                    'fadeOutLeft'       => __('fadeOutLeft', 'exclusive-addons-elementor'),
                    'fadeOutLeftBig'    => __('fadeOutLeftBig', 'exclusive-addons-elementor'),
                    'fadeOutRight'      => __('fadeOutRight', 'exclusive-addons-elementor'),
                    'fadeOutRightBig'   => __('fadeOutRightBig', 'exclusive-addons-elementor'),
                    'fadeOutUp'         => __('fadeOutUp', 'exclusive-addons-elementor'),
                    'fadeOutUpBig'      => __('fadeOutUpBig', 'exclusive-addons-elementor'),
                    'flip'              => __('flip', 'exclusive-addons-elementor'),
                    'flipInX'           => __('flipInX', 'exclusive-addons-elementor'),
                    'flipInY'           => __('flipInY', 'exclusive-addons-elementor'),
                    'flipOutX'          => __('flipOutX', 'exclusive-addons-elementor'),
                    'flipOutY'          => __('flipOutY', 'exclusive-addons-elementor'),
                    'lightSpeedIn'      => __('lightSpeedIn', 'exclusive-addons-elementor'),
                    'lightSpeedOut'     => __('lightSpeedOut', 'exclusive-addons-elementor'),
                    'rotateIn'          => __('rotateIn', 'exclusive-addons-elementor'),
                    'rotateInDownLeft'  => __('rotateInDownLeft', 'exclusive-addons-elementor'),
                    'rotateInDownLeft'  => __('rotateInDownRight', 'exclusive-addons-elementor'),
                    'rotateInUpLeft'    => __('rotateInUpLeft', 'exclusive-addons-elementor'),
                    'rotateInUpRight'   => __('rotateInUpRight', 'exclusive-addons-elementor'),
                    'rotateOut'         => __('rotateOut', 'exclusive-addons-elementor'),
                    'rotateOutDownLeft' => __('rotateOutDownLeft', 'exclusive-addons-elementor'),
                    'rotateOutDownLeft' => __('rotateOutDownRight', 'exclusive-addons-elementor'),
                    'rotateOutUpLeft'   => __('rotateOutUpLeft', 'exclusive-addons-elementor'),
                    'rotateOutUpRight'  => __('rotateOutUpRight', 'exclusive-addons-elementor'),
                    'hinge'             => __('Hinge', 'exclusive-addons-elementor'),
                    'rollIn'            => __('rollIn', 'exclusive-addons-elementor'),
                    'rollOut'           => __('rollOut', 'exclusive-addons-elementor'),
                    'zoomIn'            => __('zoomIn', 'exclusive-addons-elementor'),
                    'zoomInDown'        => __('zoomInDown', 'exclusive-addons-elementor'),
                    'zoomInLeft'        => __('zoomInLeft', 'exclusive-addons-elementor'),
                    'zoomInRight'       => __('zoomInRight', 'exclusive-addons-elementor'),
                    'zoomInUp'          => __('zoomInUp', 'exclusive-addons-elementor'),
                    'zoomOut'           => __('zoomOut', 'exclusive-addons-elementor'),
                    'zoomOutDown'       => __('zoomOutDown', 'exclusive-addons-elementor'),
                    'zoomOutLeft'       => __('zoomOutLeft', 'exclusive-addons-elementor'),
                    'zoomOutRight'      => __('zoomOutRight', 'exclusive-addons-elementor'),
                    'zoomOutUp'         => __('zoomOutUp', 'exclusive-addons-elementor'),
                ],
            ]
        );

        $this->add_control(
            'tooltip_animation_out',
            [
                'label'                 => __('Animation Out', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::SELECT2,
                'default'               => '',
                'options'               => [
                    'bounce'            => __('Bounce', 'exclusive-addons-elementor'),
                    'flash'             => __('Flash', 'exclusive-addons-elementor'),
                    'pulse'             => __('Pulse', 'exclusive-addons-elementor'),
                    'rubberBand'        => __('rubberBand', 'exclusive-addons-elementor'),
                    'shake'             => __('Shake', 'exclusive-addons-elementor'),
                    'swing'             => __('Swing', 'exclusive-addons-elementor'),
                    'tada'              => __('Tada', 'exclusive-addons-elementor'),
                    'wobble'            => __('Wobble', 'exclusive-addons-elementor'),
                    'bounceIn'          => __('bounceIn', 'exclusive-addons-elementor'),
                    'bounceInDown'      => __('bounceInDown', 'exclusive-addons-elementor'),
                    'bounceInLeft'      => __('bounceInLeft', 'exclusive-addons-elementor'),
                    'bounceInRight'     => __('bounceInRight', 'exclusive-addons-elementor'),
                    'bounceInUp'        => __('bounceInUp', 'exclusive-addons-elementor'),
                    'bounceOut'         => __('bounceOut', 'exclusive-addons-elementor'),
                    'bounceOutDown'     => __('bounceOutDown', 'exclusive-addons-elementor'),
                    'bounceOutLeft'     => __('bounceOutLeft', 'exclusive-addons-elementor'),
                    'bounceOutRight'    => __('bounceOutRight', 'exclusive-addons-elementor'),
                    'bounceOutUp'       => __('bounceOutUp', 'exclusive-addons-elementor'),
                    'fadeIn'            => __('fadeIn', 'exclusive-addons-elementor'),
                    'fadeInDown'        => __('fadeInDown', 'exclusive-addons-elementor'),
                    'fadeInDownBig'     => __('fadeInDownBig', 'exclusive-addons-elementor'),
                    'fadeInLeft'        => __('fadeInLeft', 'exclusive-addons-elementor'),
                    'fadeInLeftBig'     => __('fadeInLeftBig', 'exclusive-addons-elementor'),
                    'fadeInRight'       => __('fadeInRight', 'exclusive-addons-elementor'),
                    'fadeInRightBig'    => __('fadeInRightBig', 'exclusive-addons-elementor'),
                    'fadeInUp'          => __('fadeInUp', 'exclusive-addons-elementor'),
                    'fadeInUpBig'       => __('fadeInUpBig', 'exclusive-addons-elementor'),
                    'fadeOut'           => __('fadeOut', 'exclusive-addons-elementor'),
                    'fadeOutDown'       => __('fadeOutDown', 'exclusive-addons-elementor'),
                    'fadeOutDownBig'    => __('fadeOutDownBig', 'exclusive-addons-elementor'),
                    'fadeOutLeft'       => __('fadeOutLeft', 'exclusive-addons-elementor'),
                    'fadeOutLeftBig'    => __('fadeOutLeftBig', 'exclusive-addons-elementor'),
                    'fadeOutRight'      => __('fadeOutRight', 'exclusive-addons-elementor'),
                    'fadeOutRightBig'   => __('fadeOutRightBig', 'exclusive-addons-elementor'),
                    'fadeOutUp'         => __('fadeOutUp', 'exclusive-addons-elementor'),
                    'fadeOutUpBig'      => __('fadeOutUpBig', 'exclusive-addons-elementor'),
                    'flip'              => __('flip', 'exclusive-addons-elementor'),
                    'flipInX'           => __('flipInX', 'exclusive-addons-elementor'),
                    'flipInY'           => __('flipInY', 'exclusive-addons-elementor'),
                    'flipOutX'          => __('flipOutX', 'exclusive-addons-elementor'),
                    'flipOutY'          => __('flipOutY', 'exclusive-addons-elementor'),
                    'lightSpeedIn'      => __('lightSpeedIn', 'exclusive-addons-elementor'),
                    'lightSpeedOut'     => __('lightSpeedOut', 'exclusive-addons-elementor'),
                    'rotateIn'          => __('rotateIn', 'exclusive-addons-elementor'),
                    'rotateInDownLeft'  => __('rotateInDownLeft', 'exclusive-addons-elementor'),
                    'rotateInDownLeft'  => __('rotateInDownRight', 'exclusive-addons-elementor'),
                    'rotateInUpLeft'    => __('rotateInUpLeft', 'exclusive-addons-elementor'),
                    'rotateInUpRight'   => __('rotateInUpRight', 'exclusive-addons-elementor'),
                    'rotateOut'         => __('rotateOut', 'exclusive-addons-elementor'),
                    'rotateOutDownLeft' => __('rotateOutDownLeft', 'exclusive-addons-elementor'),
                    'rotateOutDownLeft' => __('rotateOutDownRight', 'exclusive-addons-elementor'),
                    'rotateOutUpLeft'   => __('rotateOutUpLeft', 'exclusive-addons-elementor'),
                    'rotateOutUpRight'  => __('rotateOutUpRight', 'exclusive-addons-elementor'),
                    'hinge'             => __('Hinge', 'exclusive-addons-elementor'),
                    'rollIn'            => __('rollIn', 'exclusive-addons-elementor'),
                    'rollOut'           => __('rollOut', 'exclusive-addons-elementor'),
                    'zoomIn'            => __('zoomIn', 'exclusive-addons-elementor'),
                    'zoomInDown'        => __('zoomInDown', 'exclusive-addons-elementor'),
                    'zoomInLeft'        => __('zoomInLeft', 'exclusive-addons-elementor'),
                    'zoomInRight'       => __('zoomInRight', 'exclusive-addons-elementor'),
                    'zoomInUp'          => __('zoomInUp', 'exclusive-addons-elementor'),
                    'zoomOut'           => __('zoomOut', 'exclusive-addons-elementor'),
                    'zoomOutDown'       => __('zoomOutDown', 'exclusive-addons-elementor'),
                    'zoomOutLeft'       => __('zoomOutLeft', 'exclusive-addons-elementor'),
                    'zoomOutRight'      => __('zoomOutRight', 'exclusive-addons-elementor'),
                    'zoomOutUp'         => __('zoomOutUp', 'exclusive-addons-elementor'),
                ],
            ]
        );

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*	STYLE TAB
        /*-----------------------------------------------------------------------------------*/

        /**
         * Style Tab: Image
         */
        $this->start_controls_section(
            'section_image_style',
            [
                'label'                 => __('Image', 'exclusive-addons-elementor'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label'                 => __('Width', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 1200,
                        'step'  => 1,
                    ],
                    '%' => [
                        'min'   => 1,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => ['px', '%'],
                'selectors'             => [
                    '{{WRAPPER}} .exad-hot-spot-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Hotspot
         */
        $this->start_controls_section(
            'section_hotspots_style',
            [
                'label'                 => __('Hotspot', 'exclusive-addons-elementor'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'hotspot_icon_size',
            [
                'label'                 => __('Size', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => ['size' => '14'],
                'range'                 => [
                    'px' => [
                        'min'   => 6,
                        'max'   => 40,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => ['px'],
                'selectors'             => [
                    '{{WRAPPER}} .exad-hot-spot-wrap' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color_normal',
            [
                'label'                 => __('Color', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#fff',
                'selectors'             => [
                    '{{WRAPPER}} .exad-hot-spot-wrap, {{WRAPPER}} .exad-hot-spot-inner, {{WRAPPER}} .exad-hot-spot-inner:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color_normal',
            [
                'label'                 => __('Background Color', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .exad-hot-spot-wrap, {{WRAPPER}} .exad-hot-spot-inner, {{WRAPPER}} .exad-hot-spot-inner:before, {{WRAPPER}} .exad-hotspot-icon-wrap' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'icon_border_normal',
                'label'                 => __('Border', 'exclusive-addons-elementor'),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .exad-hot-spot-wrap'
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label'                 => __('Border Radius', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', '%'],
                'selectors'             => [
                    '{{WRAPPER}} .exad-hot-spot-wrap, {{WRAPPER}} .exad-hot-spot-inner, {{WRAPPER}} .exad-hot-spot-inner:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'                 => __('Padding', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', '%'],
                'selectors'             => [
                    '{{WRAPPER}} .exad-hot-spot-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'                  => 'icon_box_shadow',
                'selector'              => '{{WRAPPER}} .exad-hot-spot-wrap',
                'separator'             => 'before',
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Tooltip
         */
        $this->start_controls_section(
            'section_tooltips_style',
            [
                'label'                 => __('Tooltip', 'exclusive-addons-elementor'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tooltip_bg_color',
            [
                'label'                 => __('Background Color', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
            ]
        );

        $this->add_control(
            'tooltip_color',
            [
                'label'                 => __('Text Color', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
            ]
        );

        $this->add_control(
            'tooltip_width',
            [
                'label'         => __('Width', 'exclusive-addons-elementor'),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'     => [
                        'min'     => 50,
                        'max'     => 400,
                        'step'    => 1,
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'tooltip_typography',
                'label'                 => __('Typography', 'exclusive-addons-elementor'),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '.exad-tooltip-{{ID}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();


        ?>

        <div class="exad-hotspot one">
            <img src="<?php echo esc_url( $settings['exad_hotspot_image']['url'] ); ?>">

            <?php foreach( $settings['exad_hotspots'] as $key => $item ) { ?>

                <div class="exad-hotspot-item">
                    <span class="exad-hotspot-dot dot-one" data-left="<?php esc_attr( $item['exad_left_position'] ); ?>" data-top="<?php esc_attr( $item['exad_top_position'] ); ?>">
                        <?php
                            if ( $item['exad_hotspot_type'] == 'icon' ) {
                                printf( '<span class="eael-hotspot-icon-wrap"><span class="eael-hotspot-icon tooltip %1$s"></span></span>', esc_attr( $item['hotspot_icon'] ) );
                            }
                            elseif ( $item['exad_hotspot_type'] == 'text' ) {
                                printf( '<span class="eael-hotspot-icon-wrap"><span class="eael-hotspot-text">%1$s</span></span>', esc_attr( $item['hotspot_text'] ) );
                            }
                        ?>
                        <div class="exad-hotspot-tooltip">
                            <h6>Hotel</h6>
                        </div>
                    </span>
                </div>

            <?php } ?>

            <div class="exad-hotspot-item">
                <span class="exad-hotspot-dot dot-two" data-top="58%" data-left="35%">
                    <svg viewBox="0 0 512.002 512.002">
                        <path d="M500.563 119.845L265.25 2.189a20.685 20.685 0 0 0-18.499 0L11.437 119.845a20.683 20.683 0 0 0 0 36.998L246.751 274.5a20.684 20.684 0 0 0 18.499 0l235.314-117.657a20.682 20.682 0 0 0-.001-36.998zM256.001 232.878L66.933 138.344 256 43.81l189.067 94.534-189.066 94.534zM509.814 364.409c-5.108-10.216-17.533-14.355-27.749-9.25L256.001 468.19 29.936 355.158c-10.216-5.107-22.64-.965-27.748 9.25-5.109 10.217-.967 22.64 9.249 27.749l235.314 117.657a20.684 20.684 0 0 0 18.5.001l235.314-117.657c10.216-5.11 14.357-17.533 9.249-27.749z" />
                        <path d="M509.814 246.751c-5.108-10.216-17.533-14.357-27.749-9.249L256.001 350.534 29.936 237.502c-10.216-5.108-22.64-.967-27.748 9.249-5.109 10.217-.967 22.64 9.249 27.749l235.314 117.657a20.684 20.684 0 0 0 18.5 0L500.564 274.5c10.217-5.109 14.358-17.533 9.25-27.749z" />
                    </svg>
                    <div class="exad-hotspot-tooltip">
                        <h6>Hotel</h6>
                    </div>
                </span>
            </div>
            <div class="exad-hotspot-item">
                <span class="exad-hotspot-dot dot-three" data-top="65%" data-left="53%">
                    <svg viewBox="0 0 512 512">
                        <path d="M511.906 254.048c-6.525-68.355-39.278-130.078-92.226-173.799-52.947-43.72-119.746-64.206-188.108-57.68-59.326 5.663-115.206 31.99-157.348 74.131S5.757 194.72.094 254.047a20.685 20.685 0 0 0 20.588 22.648h470.636a20.682 20.682 0 0 0 20.588-22.647zM44.65 235.33C63.4 143.439 140.44 72.82 235.503 63.746c57.358-5.471 113.411 11.713 157.839 48.399 38.497 31.788 64.272 74.92 74.03 123.185H44.65z" />
                        <path d="M384.355 385.078c-11.423 0-20.682 9.259-20.682 20.682 0 23.983-19.512 43.495-43.495 43.495-23.983 0-43.495-19.511-43.495-43.495V256.012c0-11.422-9.259-20.682-20.682-20.682-11.422 0-20.682 9.26-20.682 20.682v149.749c0 46.791 38.068 84.86 84.86 84.86s84.861-38.068 84.86-84.861c-.002-11.423-9.261-20.682-20.684-20.682z" />
                    </svg>
                    <div class="exad-hotspot-tooltip">
                        <h6>Hotel</h6>
                    </div>
                </span>
            </div>
            <div class="exad-hotspot-item">
                <span class="exad-hotspot-dot dot-four" data-top="56%" data-left="68%">
                    <svg viewBox="0 0 512 512">
                        <path d="M256 85.57c-93.975 0-170.43 76.454-170.43 170.43S162.024 426.43 256 426.43c93.976 0 170.43-76.454 170.43-170.43S349.975 85.57 256 85.57zm0 299.495c-71.167 0-129.065-57.898-129.065-129.065S184.834 126.934 256 126.934c71.167 0 129.065 57.899 129.065 129.065 0 71.168-57.898 129.066-129.065 129.066z" />
                        <path d="M302.713 273.464l-26.031-26.031v-55.61c0-11.422-9.259-20.682-20.682-20.682-11.422 0-20.682 9.26-20.682 20.682V256a20.682 20.682 0 0 0 6.058 14.625l32.089 32.089c4.038 4.039 9.332 6.058 14.625 6.058s10.587-2.019 14.625-6.058c8.074-8.078 8.074-21.173-.002-29.25zM354.362 349.853c-11.359-1.05-21.44 7.338-22.478 18.713l-7.49 81.955c-1.037 11.482-10.491 20.113-22.092 20.113h-92.807c-11.601.051-21.063-8.6-22.105-20.134l-7.487-81.934c-1.04-11.375-11.107-19.767-22.478-18.713-11.375 1.04-19.754 11.103-18.714 22.478l7.485 81.912a63.316 63.316 0 0 0 20.494 41.23C178.408 506.136 193.566 512 209.321 512l.257-.001h92.805a63.311 63.311 0 0 0 42.713-16.526c11.781-10.722 19.06-25.364 20.491-41.208l7.488-81.934c1.04-11.374-7.338-21.438-18.713-22.478zM373.504 139.667l-7.486-81.912a63.306 63.306 0 0 0-20.494-41.229C333.806 5.863 318.647 0 302.893 0H209.559a63.336 63.336 0 0 0-42.773 16.632 63.31 63.31 0 0 0-20.375 41.102l-7.488 81.933c-1.04 11.375 7.339 21.44 18.714 22.479 11.38 1.041 21.44-7.339 22.479-18.714l7.489-81.954c1.036-11.456 10.49-20.102 21.973-20.113H302.814c11.517 0 20.972 8.632 22.011 20.135l7.488 81.933c.981 10.736 9.998 18.802 20.572 18.802.63 0 1.267-.029 1.906-.087 11.375-1.041 19.753-11.106 18.713-22.481z" />
                    </svg>
                    <div class="exad-hotspot-tooltip">
                        <h6>Hotel</h6>
                    </div>
                </span>
            </div>
            <div class="exad-hotspot-item">
                <span class="exad-hotspot-dot dot-five" data-top="60%" data-left="85%">
                    <svg viewBox="0 0 512 512">
                        <path d="M406.766 62.449C366.495 22.178 312.951 0 256 0S145.505 22.178 105.234 62.449c-40.272 40.271-62.449 93.814-62.449 150.766 0 37.656 10.972 76.863 32.609 116.532 16.825 30.846 40.15 62.102 69.326 92.898 49.17 51.903 97.763 84.519 99.808 85.881A20.655 20.655 0 0 0 256 512c4 0 7.999-1.158 11.473-3.474 2.045-1.363 50.638-33.978 99.808-85.881 29.176-30.795 52.501-62.051 69.326-92.898 21.637-39.669 32.609-78.876 32.609-116.532-.001-56.952-22.178-110.495-62.45-150.766zM256.001 465.903C215.826 436.156 84.15 329.739 84.15 213.215c0-94.759 77.091-171.851 171.85-171.851s171.85 77.092 171.851 171.851c0 116.533-131.692 222.953-171.85 252.688z" />
                        <path d="M256 128.355c-46.791 0-84.86 38.068-84.86 84.86 0 46.791 38.068 84.86 84.86 84.86s84.861-38.068 84.86-84.86c0-46.792-38.069-84.86-84.86-84.86zm0 128.355c-23.983 0-43.495-19.512-43.495-43.495 0-23.983 19.512-43.495 43.495-43.495 23.984 0 43.495 19.512 43.495 43.495 0 23.983-19.511 43.495-43.495 43.495z" />
                    </svg>
                    <div class="exad-hotspot-tooltip">
                        <h6>Hotel</h6>
                    </div>
                </span>
            </div>
        </div>

        <?php
    }

    /**
     * Render image hotspots widget output in the editor.
     */
    protected function _content_template(){}

}

Plugin::instance()->widgets_manager->register_widget_type(new Exad_Image_Hotspot());
