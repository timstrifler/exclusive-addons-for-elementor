<?php

namespace ExclusiveAddons\Elementor;

use Elementor\Controls_Manager;
use Elementor\Utils;

class GlassEffect {

    public static function init() {
        
        add_action( 'elementor/element/section/section_background/before_section_end', array( __CLASS__, 'register_controls' ), 10 );
        add_action( 'elementor/element/column/section_style/before_section_end', array( __CLASS__, 'register_controls' ), 10 );
        add_action( 'elementor/element/common/_section_background/before_section_end', array( __CLASS__, 'register_controls' ), 10 );
    }

    public static function register_controls( $section ) {

        $section->add_control(
			'exad_glassmorphism_heading',
			[
				'label' => __( 'Exclusive Glassmorphism Effect', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $section->add_control(
            'exad_glassmorphism_panel_notice_text',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => __('Glassmorphism will not work in Mozila Firefox until they provide support for the CSS property that enables it', 'exclusive-addons-elementor'),
                'content_classes' => 'exad-panel-notice',
            ]
        );

        $section->add_control(
            'exad_enable_glass_effect',
            [
				'label'        => __( 'Enable Glassmorphism', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
                'return_value' => 'yes',
                'render_type'  => 'template',
				'label_on'     => __( 'Enable', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Disable', 'exclusive-addons-elementor' ),
                'prefix_class' => 'exad-glass-effect-',
            ]
        );

        $section->add_control(
			'exad_glass_effect_blur_value',
			[
				'label' => __( 'Blur Value', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
                'default' => 20,
                'selectors' => [
					'{{WRAPPER}}.exad-glass-effect-yes.elementor-section' => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px);',
					'{{WRAPPER}}.exad-glass-effect-yes > .elementor-column-wrap' => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px);',
					'{{WRAPPER}}.exad-glass-effect-yes > .elementor-widget-container' => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px);',
				],
                'condition' => [
                    'exad_enable_glass_effect' => 'yes'
                ],
            ]
        );
    }

}

GlassEffect::init();
