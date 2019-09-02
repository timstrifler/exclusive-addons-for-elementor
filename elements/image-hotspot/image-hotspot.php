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
            'exad_hotspot_type',
            [
                'label'           => __('Type', 'exclusive-addons-elementor'),
                'type'            => Controls_Manager::SELECT,
                'default'         => 'icon',
                'options'         => [
                    'icon'  => __('Icon', 'exclusive-addons-elementor'),
                    'text'  => __('Text', 'exclusive-addons-elementor'),
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
                    'exad_hotspot_type'   => 'icon',
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
                    'exad_hotspot_type'   => 'text',
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
                'default' => [
                    'unit' => '%',
                    'size' => '50'
                ],
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
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
                'default' => [
                    'unit' => '%',
                    'size' => '50'
                ],
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab('tab_tooltip', ['label' => __('Tooltip', 'exclusive-addons-elementor')]);

        $repeater->add_control(
            'exad_tooltip',
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
            'exad_tooltip_content',
            [
                'label'           => __('Tooltip Content', 'exclusive-addons-elementor'),
                'type'            => Controls_Manager::TEXTAREA,
                'default'         => __('Tooltip Content', 'exclusive-addons-elementor'),
                'condition'       => [
                    'exad_tooltip'   => 'yes',
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
                        'left_position'   => '20%',
                        'top_position'    => '30%',
                    ],
                ],
                'fields'                => array_values($repeater->get_controls()),
                'title_field'           => '{{{ exad_hotspot_text }}}',
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
            'exad_section_general_styles',
            [
                'label'                 => __('General Styles', 'exclusive-addons-elementor'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'exad_hotspot_preset',
			[
				'label' => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'one',
				'options' => [
					'one' => esc_html__( 'Style 1', 'exclusive-addons-elementor' ),
					'two' => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
					'three' => esc_html__( 'Style 3', 'exclusive-addons-elementor' ),
					'four' => esc_html__( 'Style 4', 'exclusive-addons-elementor' ),
				],
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
                    '{{WRAPPER}} .exad-hotspot-item .exad-hotspot-dot .exad-hotspot-dot-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'exad_hotspot_color_normal',
            [
                'label'                 => __('Color', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#FFF',
                'selectors'             => [
                    '{{WRAPPER}} .exad-hotspot .exad-hotspot-item .exad-hotspot-dot' => 'color: {{VALUE}}',
                ],
                'description' => __( 'Applies to Style 1 & Style 2', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_hotspot_bg_color_normal',
            [
                'label'                 => __('Background Color', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#704AFF',
                'selectors'             => [
                    '{{WRAPPER}} .exad-hotspot.one .exad-hotspot-dot, {{WRAPPER}} .exad-hotspot.two .exad-hotspot-dot, {{WRAPPER}} .exad-hotspot.three .exad-hotspot-dot, {{WRAPPER}} .exad-hotspot.three .exad-hotspot-dot::before, {{WRAPPER}} .exad-hotspot.three .exad-hotspot-dot::before' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .exad-hotspot.two .exad-hotspot-dot::before' => 'border: .5px solid {{VALUE}}',
                    '{{WRAPPER}} .exad-hotspot.two .exad-hotspot-dot::after' => 'border: 1px solid {{VALUE}}',
                ],
                'description' => __( 'Applies to Style 1, Style 2 & Style 3', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
			'exad_hotspot_border_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'unit' => '%',
                    'size' => '50'
                ],
				'selectors'             => [
					'{{WRAPPER}} .exad-hotspot .exad-hotspot-item .exad-hotspot-dot-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_hotspot_box_shadow',
				'label' => __( 'Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .exad-hotspot .exad-hotspot-item .exad-hotspot-dot-icon',
			]
        );
        

        $this->add_control(
			'exad_hotspot_moving_animation',
			[
				'label' => __( 'Moving Animation', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'your-plugin' ),
				'label_off' => __( 'Off', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
        );
        
        $this->add_control(
			'exad_hotspot_glow_animation',
			[
				'label' => __( 'Glowing Animation', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'your-plugin' ),
				'label_off' => __( 'Off', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
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
            'exad_hotspot_tooltip_bg_color',
            [
                'label'                 => __('Background Color', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#fff',
                'selectors'             => [
                    '{{WRAPPER}} .exad-hotspot-item .exad-hotspot-dot .exad-hotspot-tooltip' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .exad-hotspot-item .exad-hotspot-dot .exad-hotspot-tooltip::before' => 'border-color: {{VALUE}} transparent transparent transparent;',
                ],
                'condition'       => [
                    'exad_hotspot_preset'   => 'one',
                ],
            ]
        );
        $this->add_control(
            'exad_hotspot_tooltip_bg_color_two',
            [
                'label'                 => __('Background Color', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#fff',
                'selectors'             => [
                    '{{WRAPPER}} .exad-hotspot-item .exad-hotspot-dot .exad-hotspot-tooltip h6' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .exad-hotspot-item .exad-hotspot-dot .exad-hotspot-tooltip h6::before' => 'border-color: {{VALUE}} transparent transparent transparent;',
                    '{{WRAPPER}} .exad-hotspot.two .exad-hotspot-item .exad-hotspot-dot .exad-hotspot-tooltip h6::before' => 'border-color: transparent transparent transparent {{VALUE}};',
                ],
                'condition'       => [
                    'exad_hotspot_preset!'   => 'one',
                ],
            ]
        );

        $this->add_control(
            'exad_hotspot_tooltip_text_color',
            [
                'label'                 => __('Text Color', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#222222',
                'selectors'             => [
                    '{{WRAPPER}} .exad-hotspot-item .exad-hotspot-tooltip h6' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'exad_hotspot_width',
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
                'size_units'            => ['px'],
                'selectors'             => [
                    '{{WRAPPER}} .exad-hotspot-item .exad-hotspot-dot .exad-hotspot-tooltip h6' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'exad_hotspot_tooltip_text_typography',
                'label'                 => __('Typography', 'exclusive-addons-elementor'),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .exad-hotspot-item .exad-hotspot-tooltip h6',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $this->add_render_attribute( 'exad_hotspot_attribute', [
			'class'	=> [ 'exad-hotspot', $settings[ 'exad_hotspot_preset' ] ],
		]);

        
        if ( 'yes' == $settings['exad_hotspot_moving_animation'] ) {
			$this->add_render_attribute( 'exad_hotspot_attribute', 'class', 'exad-hotspot-moving-animation' );
        }  

        if ( 'yes' == $settings['exad_hotspot_glow_animation'] ) {
			$this->add_render_attribute( 'exad_hotspot_attribute', 'class', 'exad-hotspot-glow-animation' );
        }  
    

        ?>

        <div <?php echo $this->get_render_attribute_string( 'exad_hotspot_attribute' ); ?>">
            <img src="<?php echo esc_url( $settings['exad_hotspot_image']['url'] ); ?>">

            <?php foreach( $settings['exad_hotspots'] as $item ) { 
                $this->add_render_attribute( 'exad_hotspot', 'class', 'exad-hotspot-dot elementor-repeater-item-' . esc_attr( $item['_id'] ) );    
            ?>

                <div class="exad-hotspot-item">
                    <div <?php echo $this->get_render_attribute_string( 'exad_hotspot' ); ?>>
                        <?php
                            if ( $item['exad_hotspot_type'] == 'icon' ) {
                                if ( $settings['exad_hotspot_preset'] == "one" || $settings['exad_hotspot_preset'] == "four" ) {
                                    printf( '<div class="exad-hotspot-dot-icon"><i class="%1$s"></i></div>', esc_attr( $item['exad_hotspot_icon'] ) );
                                }
                            }
                        ?>
                        <div class="exad-hotspot-tooltip">
                            <h6><?php echo esc_html( $item['exad_tooltip_content'] ); ?></h6>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>

        <?php
    }

    /**
     * Render image hotspots widget output in the editor.
     */
    protected function _content_template(){}

}

Plugin::instance()->widgets_manager->register_widget_type(new Exad_Image_Hotspot());
