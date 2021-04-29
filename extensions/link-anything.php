<?php
namespace ExclusiveAddons\Elementor;

use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Utils;

class Link_Anything {

	public static function init() {
		add_action( 'elementor/element/column/section_advanced/after_section_end', [ __CLASS__, 'add_controls_section' ], 10 );
		add_action( 'elementor/element/section/section_advanced/after_section_end', [ __CLASS__, 'add_controls_section' ], 10 );
		add_action( 'elementor/element/common/_section_style/after_section_end', [ __CLASS__, 'add_controls_section' ], 10 );

		add_action( 'elementor/frontend/before_render', [ __CLASS__, 'before_section_render' ], 1 );
	}

	public static function add_controls_section( Element_Base $element) {
		$tabs = Controls_Manager::TAB_CONTENT;

		if ( 'section' === $element->get_name() || 'column' === $element->get_name() ) {
			$tabs = Controls_Manager::TAB_LAYOUT;
		}

		$element->start_controls_section(
			'exad_container_link_wrapper',
			[
				'label' => __( 'Link Anything <i class="exad-extention-logo exad exad-logo"></i>', 'exclusive-addons-elementor' ),
				'tab'   => $tabs,
			]
		);

		$element->add_control(
			'exad_container_link',
			[
				'label'       => __( 'URL', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => 'https://example.com',
			]
		);

		$element->start_controls_tabs( 'exad_container_link_wrapper_tabs' );

			$element->start_controls_tab( 'exad_container_link_wrapper_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$element->add_control(
					'exad_container_link_opacity',
					[
						'label' => __( 'Opacity', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'max' => 1,
								'min' => 0.10,
								'step' => 0.01,
							],
						],
						'selectors' => [
							'{{WRAPPER}}.exad-link-anything-wrapper' => 'opacity: {{SIZE}}; transition: all .3s ease;',
						],
					]
				);

			$element->end_controls_tab();
		
			$element->start_controls_tab( 'exad_container_link_wrapper_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

				$element->add_control(
					'exad_container_link_opacity_hover',
					[
						'label' => __( 'Opacity', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'max' => 1,
								'min' => 0.10,
								'step' => 0.01,
							],
						],
						'selectors' => [
							'{{WRAPPER}}.exad-link-anything-wrapper:hover' => 'opacity: {{SIZE}};',
						],
					]
				);
			
			$element->end_controls_tab();
		
		$element->end_controls_tabs();

		$element->end_controls_section();
	}

	public static function before_section_render( Element_Base $element ) {
		$data     = $element->get_data();
		$link_settings = $element->get_settings_for_display( 'exad_container_link' );

		if ( $link_settings && ! empty( $link_settings['url'] ) ) {
			$element->add_render_attribute(
				'_wrapper',
				[
					'class' => "exad-link-anything-wrapper",
					'data-exad-element-link' => json_encode( $link_settings ),
					'style' => 'cursor: pointer'
				]
			);
		}
	}
}

Link_Anything::init();
