<?php

namespace ExclusiveAddons\Elementor;

use Elementor\Controls_Manager;
use Elementor\Utils;

class Sticky {

    public static function init() {
        
        add_action( 'elementor/frontend/column/before_render', array( __CLASS__, 'before_render' ) );
        
        add_action( 'elementor/element/section/section_advanced/after_section_end', array( __CLASS__, 'register_controls' ), 10 );
        add_action( 'elementor/element/column/section_advanced/after_section_end', array( __CLASS__, 'register_controls' ), 10 );
        add_action( 'elementor/element/common/_section_style/after_section_end', array( __CLASS__, 'register_controls' ), 10 );
	}

    public static function register_controls( $section ) {

        $section->start_controls_section(
            'exad_sticky_section',
            [
                'label' => 'Exclusive Sticky <i class="exad-extention-logo exad exad-logo"></i>',
                'tab'   => Controls_Manager::TAB_ADVANCED
            ]
        );
        
        $section->add_control(
            'exad_sticky_panal_notice',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => __('<strong>Sticky Extention</strong> Does not work in Editor page.', 'exclusive-addons-elementor'),
                'content_classes' => 'exad-panel-notice',
            ]
        );
		
		$section->add_control(
            'exad_enable_section_sticky',
            [
				'label'        => __( 'Enable', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
                'return_value' => 'yes',
                'render_type'  => 'template',
				'label_on'     => __( 'Enable', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Disable', 'exclusive-addons-elementor' ),
                'prefix_class' => 'exad-sticky-section-',
            ]
        );
        
        $section->add_control(
			'exad_sticky_top_spacing',
			[
				'label' => __( 'Top Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 500,
				'step' => 1,
                'default' => 20,
                'condition' => [
                    'exad_enable_section_sticky' => 'yes'
                ],
                'render_type' => 'none',
				'frontend_available' => true,
            ]
        );

        $section->end_controls_section();

	}

    public static function before_render( $section ) {

        $settings = $section->get_settings();
        $data     = $section->get_data();
        $type     = isset( $data['elType'] ) ? $data['elType'] : 'column';

        if ( 'column' !== $type ) {
            return false;
        }

        if ( isset( $settings['exad_enable_section_sticky'] ) ) {

            if ( filter_var( $settings['exad_enable_section_sticky'], FILTER_VALIDATE_BOOLEAN ) ) {

                $section->add_render_attribute( '_wrapper', array(
                    'class'         => 'exad-column-sticky',
                    'data-type' => $type,
                    'data-top_spacing' => $settings['exad_sticky_top_spacing'],
                ) );

                $section->sticky_columns[] = $data['id'];
            }
        }
    }

}

Sticky::init();
