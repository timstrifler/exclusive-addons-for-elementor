<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Color;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Blob_Maker extends Widget_Base {
	
	public function get_name() {
		return 'exad-blob-maker';
	}

	public function get_title() {
		return esc_html__( 'Blob Maker', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-image-box';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
        return [ 'blob shape', 'shape' ];
    }

	protected function _register_controls() {
		
		/**
		* Blob_Maker Content Section
		*/
		$this->start_controls_section(
			'exad_blob_maker_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_blob_shape',
			[
				'label' => __( 'SVG Shape', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'shape1',
				'options' => [
					'shape1'  => __( 'Shape 1', 'exclusive-addons-elementor' ),
					'shape2'  => __( 'Shape 2', 'exclusive-addons-elementor' ),
					'shape3'  => __( 'Shape 3', 'exclusive-addons-elementor' ),
					'shape4'  => __( 'Shape 4', 'exclusive-addons-elementor' ),
					'shape5'  => __( 'Shape 5', 'exclusive-addons-elementor' ),
					'shape6'  => __( 'Shape 6', 'exclusive-addons-elementor' ),
					'shape7'  => __( 'Shape 7', 'exclusive-addons-elementor' ),
					'shape8'  => __( 'Shape 8', 'exclusive-addons-elementor' ),
					'shape9'  => __( 'Shape 9', 'exclusive-addons-elementor' ),
					'shape10'  => __( 'Shape 10', 'exclusive-addons-elementor' ),
					'shape11'  => __( 'Shape 11', 'exclusive-addons-elementor' ),
					'shape12'  => __( 'Shape 12', 'exclusive-addons-elementor' ),
				],
			]
		);

		$this->end_controls_section();

		/**
		* Blob_Maker Style Section
		*/
		$this->start_controls_section(
			'exad_blob_maker_style',
			[
				'label' => esc_html__( 'Style', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_blob_maker_color',
			[
				'label' => __( 'Shape Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
                ],
				'default' => '#FFB4BC',
				'selectors' => [
					'{{WRAPPER}} .exad-blob-maker svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'exad_blob_maker_svg_size',
			[
				'label' => __( 'SVG Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 400,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-blob-maker svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'exad_blob_maker_svg_opacity',
			[
				'label'     => __('Opacity', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::NUMBER,
				'range'     => [
					'min'   => 0,
					'max'   => 1
				],
				'selectors' => [
					'{{WRAPPER}} .exad-blob-maker svg' => 'opacity: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'exad_blob_maker_background_enable',
			[
				'label' => __( 'Enable as a background', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'exad_blob_maker_top_offset',
			[
				'label' => __( 'Top Offset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-blob-maker.yes' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_blob_maker_background_enable' => 'yes'
				],
			]
		);

		$this->add_responsive_control(
			'exad_blob_maker_left_offset',
			[
				'label' => __( 'Left Offset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-blob-maker.yes' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_blob_maker_background_enable' => 'yes'
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        
    ?>

    <div class="exad-blob-maker <?php echo $settings['exad_blob_maker_background_enable'] ?>">
		<?php if( $settings['exad_blob_shape'] === 'shape1' ) { ?>
			<svg viewBox="0 0 600 600">
				<path d="M429.9 375c-43.3 75-216.5 75-259.8 0-43.3-75 43.3-225 129.9-225 86.6 0 173.2 150 129.9 225z"/>
			</svg>
		<?php } ?>

		<?php if( $settings['exad_blob_shape'] === 'shape2' ) { ?>
			<svg viewBox="0 0 600 600">
				<path d="M404.7 222.8c31.2 32.8 56.8 76.4 58.2 132 1.4 55.7-21.5 123.4-71.1 154.4-49.6 31.1-125.8 25.4-188.9-5.7-63.1-31.1-113.2-87.6-122.2-147.6-9-59.9 23.1-123.4 66.5-159 43.3-35.5 98.1-43.2 143.8-36 45.7 7.1 82.5 29.2 113.7 61.9z"/>
			</svg>
		<?php } ?>

		<?php if( $settings['exad_blob_shape'] === 'shape3' ) { ?>
			<svg viewBox="0 0 600 600">
				<path d="M479.8 159.1c47.5 57 76.2 131.4 54.4 181.2-21.9 49.9-94.2 75.1-157 96.2-62.9 21.2-116.2 38.3-170.3 24.6-54-13.7-108.6-58.1-128.2-117.9-19.5-59.9-3.9-135.1 38.9-191 42.7-55.9 112.6-92.6 180.6-91.1 68 1.4 134.2 41 181.6 98z"/>
			</svg>
		<?php } ?>

		<?php if( $settings['exad_blob_shape'] === 'shape4' ) { ?>
			<svg viewBox="0 0 600 600">
				<path d="M454.9 188.3c31.3 27.5 32.3 91.1 12.2 138.1-20.1 47-61.3 77.4-107.5 101-46.1 23.7-97.3 40.5-143.5 26.2s-87.4-59.7-92-106c-4.6-46.2 27.4-93.4 62.8-121.8 35.4-28.4 74.3-38.1 124.6-47.2 50.3-9.2 112-17.8 143.4 9.7z"/>
			</svg>
		<?php } ?>

		<?php if( $settings['exad_blob_shape'] === 'shape5' ) { ?>
			<svg viewBox="0 0 600 600">
				<path d="M437 195.3c44.2 50.9 86.2 108.1 79.8 161.4-6.5 53.3-61.3 102.8-116.3 115.3-55.1 12.4-110.3-12.2-162.7-38.9-52.4-26.8-101.8-55.6-110.1-93.4-8.3-37.8 24.5-84.6 60.1-133.5 35.6-49 73.9-100.1 116.2-103.3 42.4-3.2 88.8 41.4 133 92.4z"/>
			</svg>
		<?php } ?>

		<?php if( $settings['exad_blob_shape'] === 'shape6' ) { ?>
			<svg viewBox="0 0 600 600">
				<path d="M465.3 141.5c21.9 54.2-5.9 121.4-23.2 188.4-17.3 67-24.2 133.9-62.3 162.5-38.1 28.6-107.6 19-173.4-8.6-65.8-27.7-127.9-73.4-131.8-123-3.9-49.6 50.6-103.2 97.8-163.2 47.3-59.9 87.5-126.3 143.4-138.8 55.9-12.6 127.5 28.6 149.5 82.7z"/>
			</svg>
		<?php } ?>

		<?php if( $settings['exad_blob_shape'] === 'shape7' ) { ?>
			<svg viewBox="0 0 600 600">
				<path d="M433.9 186.2c23.4 36.4 14.9 91.1 4.9 149.6-10.1 58.5-21.7 120.8-57.8 141.9-36.2 21.1-96.8 1-145.5-28.4-48.8-29.3-85.7-68-112-125.5-26.2-57.5-41.7-133.8-10.5-172 31.2-38.1 109.1-37.9 175.7-28.9 66.5 9 121.8 27 145.2 63.3z"/>
			</svg>
		<?php } ?>

		<?php if( $settings['exad_blob_shape'] === 'shape8' ) { ?>
			<svg viewBox="0 0 600 600">
				<path d="M425.3 191.9c39.3 57.5 75 109.7 66 152.8-9 43.2-62.6 77.2-111 87.1-48.5 10-91.7-4.2-125-25.4s-56.7-49.6-64.8-82.2c-8.1-32.6-.9-69.6 19.9-122.8 20.8-53.3 55.2-122.8 93.9-126.3 38.7-3.4 81.7 59.3 121 116.8z"/>
			</svg>
		<?php } ?>

		<?php if( $settings['exad_blob_shape'] === 'shape9' ) { ?>
			<svg viewBox="0 0 600 600">
				<path d="M400.9 201.4c28 53.2 47.4 95 48.3 149.4.9 54.3-16.7 121.1-53.7 133.7-37.1 12.5-93.6-29.2-153.2-59.8-59.7-30.5-122.4-49.9-129.3-81.6-6.9-31.7 42-75.8 82.4-131.8 40.5-56.1 72.5-124.2 106.8-126 34.3-1.7 70.8 62.8 98.7 116.1z"/>
			</svg>
		<?php } ?>

		<?php if( $settings['exad_blob_shape'] === 'shape10' ) { ?>
			<svg viewBox="0 0 600 600">
				<path d="M392.4 141.3c18.2 26.6 17.5 67.7 18.7 99.4 1.3 31.8 4.5 54.1 9.1 82.1 4.6 28.1 10.6 61.9 3.7 103-6.9 41.2-26.7 89.6-56.2 92.9-29.6 3.3-68.9-38.6-115.6-53.4-46.7-14.7-100.7-2.2-114.7-22.3-14-20 11.9-72.5 11.1-117.6-.8-45-28.3-82.6-20.9-106.3 7.5-23.7 49.9-33.7 84.5-52.7 34.6-19.1 61.2-47.2 93.1-55.4 31.9-8.1 69 3.8 87.2 30.3z"/>
			</svg>
		<?php } ?>

		<?php if( $settings['exad_blob_shape'] === 'shape11' ) { ?>
			<svg viewBox="0 0 600 600">
				<path d="M391.2 168c31.6 10.5 65.3 27.8 79.9 55.2 14.7 27.4 10.4 64.8 3.4 100.7-7 35.9-16.7 70.2-33.7 108.5-17.1 38.2-41.5 80.5-74.9 89-33.5 8.6-76-16.7-121.8-30.4-45.7-13.8-94.7-15.9-118.6-41.1-23.8-25.3-22.7-73.5-31.7-121.6-9.1-48.1-28.3-96.2-12.1-126.5 16.1-30.4 67.7-43.1 110-48.7 42.3-5.7 75.3-4.4 106.7-1.9 31.3 2.5 61.1 6.3 92.8 16.8z"/>
			</svg>
		<?php } ?>

		<?php if( $settings['exad_blob_shape'] === 'shape12' ) { ?>
			<svg viewBox="0 0 600 600">
				<path d="M401 141.2c18.8 13.8 15.3 60.5 28.9 97.4 13.6 36.9 44.3 63.9 59.4 101.8 15.1 38 14.5 86.9-10.9 111.7-25.4 24.8-75.7 25.6-117.9 24.7-42.3-.9-76.5-3.5-113-9.1-36.6-5.6-75.6-14.3-95.1-38.7-19.5-24.5-19.6-64.7-26.3-104.6-6.8-39.9-20.1-79.5-10.1-111.3 10.1-31.8 43.5-55.7 78.1-62.3 34.5-6.5 70.2 4.3 108.6.1 38.4-4.2 79.5-23.4 98.3-9.7z"/>
			</svg>
		<?php } ?>
    </div>

    <?php    
	}

}