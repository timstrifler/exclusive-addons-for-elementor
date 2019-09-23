<?php
namespace Elementor;

class Exad_Testimonial extends Widget_Base { 

    public function get_name() {
		return 'exad-testimonial';
	}

	public function get_title() {
		return esc_html__( 'Testimonial', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-blockquote';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
		
	protected function _register_controls() {

		/**
		 * Testimonial Content Section
		 */

		$this->start_controls_section(
			'exad_testimonial_section',
			[
				'label' => esc_html__( 'Contents', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_testimonial_image',
			[
				'label' => __( 'Image', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'exad_testimonial_description',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore odio sint harum quasi maiores nobis dignissimos illo doloremque blanditiis illum!', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_testimonial_name',
			[
				'label' => esc_html__( 'Name', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'John Doe', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_testimonial_designation',
			[
				'label' => esc_html__( 'Designation', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Co-Founder', 'exclusive-addons-elementor' ),
			]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Container Style Section
		 */
		$this->start_controls_section(
			'exad_testimonial_container_section_style',
			[
				'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_testimonial_design',
			[
				'label' => __( 'Design', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default', 'exclusive-addons-elementor' ),
					'image-with-reviewer'  => __( 'Image With Reviewer', 'exclusive-addons-elementor' ),
				],
			]
		);

		$this->add_control(
			'exad_testimonial_container_alignment',
			[
				'label' => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'exad-testimonial-align-left' => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'exad-testimonial-align-center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'exad-testimonial-align-right' => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					]
				],
				'default' => 'exad-testimonial-align-center',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_testimonial_container_background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-testimonial-wrapper',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_testimonial_container_border',
				'label' => __( 'Border', 'xclusive-addons-elementor' ),
				'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                        ],
                    ],
                    'color' => [
                        'default' => '#e3e3e3',
                    ],
				],
				'selector' => '{{WRAPPER}} .exad-testimonial-wrapper',
			]
		);

		$this->add_control(
			'exad_testimonial_container_radius',
			[
				'label' => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_container_padding',
			[
				'label' => __( 'Pading', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_testimonial_container_box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-testimonial-wrapper',
			]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Image Style Section
		 */
		$this->start_controls_section(
			'exad_testimonial_image_style',
			[
				'label' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_testimonial_image_position',
			[
				'label' => __( 'Position', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'exad-testimonial-image-pos-left' => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-angle-left',
					],
					'exad-testimonial-image-pos-center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-angle-up',
					],
					'exad-testimonial-image-pos-right' => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-angle-right',
					]
				],
				'default' => 'exad-testimonial-image-pos-center',
				'condition' => [
					'exad_testimonial_design' => 'default',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_reviewer_image_position',
			[
				'label' => __( 'Position', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'exad-testimonial-reviewer-image-pos-up' => [
						'title' => __( 'Up', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-angle-up',
					],
					'exad-testimonial-reviewer-image-pos-left' => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-angle-left',
					],
					'exad-testimonial-reviewer-image-pos-bottom' => [
						'title' => __( 'Bottom', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-angle-down',
					],
				],
				'default' => 'exad-testimonial-reviewer-image-pos-up',
				'condition' => [
					'exad_testimonial_design' => 'image-with-reviewer',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_image_box',
			[
				'label' => __( 'Image Box', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'exad_testimonial_image_box_height',
			[
				'label' => __( 'Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-thumb'=> 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_testimonial_image_box' => 'yes'
				],
			]
		);

		$this->add_control(
			'exad_testimonial_image_box_width',
			[
				'label' => __( 'Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'separator' => 'after',
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-thumb'=> 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-testimonial-reviewer-image-pos-left .exad-testimonial-thumb'=> 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-testimonial-reviewer-image-pos-left .exad-testimonial-reviewer'=> 'width: calc( 100% - {{SIZE}}{{UNIT}} );',
				],
				'condition' => [
					'exad_testimonial_image_box' => 'yes'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_testimonial_image_box_border',
				'label' => __( 'Border', 'xclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-testimonial-thumb',
				'condition' => [
					'exad_testimonial_image_box' => 'yes'
				],
			]
		);

		$this->add_control(
			'exad_testimonial_image_box_radius',
			[
				'label' => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator' => 'after',
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .exad-testimonial-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_image_box_margin_top',
			[
				'label' => __( 'Margin Top', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-thumb'=> 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_testimonial_image_box' => 'yes'
				],
			]
		);

		$this->add_control(
			'exad_testimonial_image_box_margin_bottom',
			[
				'label' => __( 'Margin Bottom', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-thumb'=> 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_testimonial_image_box' => 'yes'
				],
			]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Riviewer Style Section
		 */
		$this->start_controls_section(
			'exad_testimonial_reviewer_style',
			[
				'label' => esc_html__( 'Rivewer', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_testimonial_design' => 'image-with-reviewer',
				]
			]
		);

		$this->add_control(
			'exad_testimonial_reviewer_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-reviewer-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_reviewer_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-reviewer-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Content Style Section
		 */
		$this->start_controls_section(
			'exad_testimonial_content_style',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_testimonial_design' => 'default',
				]
			]
		);

		$this->add_control(
			'exad_testimonial_content_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '30',
					'right' => '30',
					'bottom' => '30',
					'left' => '30',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_content_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Description Style Section
		 */
		$this->start_controls_section(
			'exad_testimonial_description_style',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_testimonial_description_arrow_enable',
			[
				'label' => __( 'Show Arrow', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'exad_testimonial_design' => 'image-with-reviewer',
				]
			]
		);

		$this->add_control(
			'exad_testimonial_description_arrow_position',
			[
				'label' => __( 'position (Left to right) ', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-content-wrapper-arrow::before' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_testimonial_description_arrow_enable' => 'yes',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_testimonial_description_background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-testimonial-content-wrapper, {{WRAPPER}} .exad-testimonial-content-wrapper-arrow::before',
				'condition' => [
					'exad_testimonial_design' => 'image-with-reviewer',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_testimonial_description_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-testimonial-description',
			]
		);

		$this->add_control(
			'exad_testimonial_description_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_description_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_description_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'exad_testimonial_design' => 'image-with-reviewer',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_testimonial_description_border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-testimonial-content-wrapper',
				'condition' => [
					'exad_testimonial_design' => 'image-with-reviewer',
				]
			]
		);

		$this->add_control(
			'exad_testimonial_description_radius',
			[
				'label' => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'exad_testimonial_design' => 'image-with-reviewer',
				]
			]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Title Style Section
		 */
		$this->start_controls_section(
			'exad_testimonial_title_style',
			[
				'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_testimonial_title_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-testimonial-name',
			]
		);

		$this->add_control(
			'exad_testimonial_title_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_title_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Designation Style Section
		 */
		$this->start_controls_section(
			'exad_testimonial_designation_style',
			[
				'label' => esc_html__( 'Designation', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_testimonial_designation_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-testimonial-designation',
			]
		);

		$this->add_control(
			'exad_testimonial_designation_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-designation' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'exad_testimonial_designation_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this-> end_controls_section();
	}
			
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'exad_testimonial_content_wrapper', 'class', 'exad-testimonial-content-wrapper' );

		if ($settings['exad_testimonial_description_arrow_enable'] === 'yes'){
			$this->add_render_attribute( 'exad_testimonial_content_wrapper', 'class', 'exad-testimonial-content-wrapper-arrow' );
		}
	?>

	<?php if( $settings['exad_testimonial_design'] === 'default' ) { ?>
		<div class="exad-testimonial-wrapper <?php echo esc_attr( $settings['exad_testimonial_container_alignment'] ); ?>">
			<div class="exad-testimonial-wrapper-inner <?php echo esc_attr( $settings['exad_testimonial_image_position'] ); ?>">
				<div class="exad-testimonial-thumb">
					<img src="<?php echo esc_url( $settings['exad_testimonial_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['exad_testimonial_name'] ) ?>">
				</div>
				<div class="exad-testimonial-content-wrapper">
					<p class="exad-testimonial-description"><?php echo esc_html( $settings['exad_testimonial_description'] ) ?></p>
					<h4 class="exad-testimonial-name"><?php echo esc_html( $settings['exad_testimonial_name'] ) ?></h4>
					<span class="exad-testimonial-designation"><?php echo esc_html( $settings['exad_testimonial_designation'] ) ?></span>
				</div>
			</div>
		</div>
	<?php } ?>
	<?php if( $settings['exad_testimonial_design'] === 'image-with-reviewer' ) { ?>
		<div class="exad-testimonial-wrapper <?php echo esc_attr( $settings['exad_testimonial_container_alignment'] ); ?>">
			<div class="exad-testimonial-wrapper-inner">
				<div <?php echo $this->get_render_attribute_string( 'exad_testimonial_content_wrapper' ); ?> >
					<p class="exad-testimonial-description"><?php echo esc_html( $settings['exad_testimonial_description'] ) ?></p>
				</div>
				<div class="exad-testimonial-reviewer-wrapper <?php echo esc_attr( $settings['exad_testimonial_reviewer_image_position'] ); ?>">
					<?php if( $settings['exad_testimonial_reviewer_image_position'] === 'exad-testimonial-reviewer-image-pos-up' || $settings['exad_testimonial_reviewer_image_position'] === 'exad-testimonial-reviewer-image-pos-left' ) { ?>
						<div class="exad-testimonial-thumb">
							<img src="<?php echo esc_url( $settings['exad_testimonial_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['exad_testimonial_name'] ) ?>">
						</div>
						<div class="exad-testimonial-reviewer">
							<h4 class="exad-testimonial-name"><?php echo esc_html( $settings['exad_testimonial_name'] ) ?></h4>
							<span class="exad-testimonial-designation"><?php echo esc_html( $settings['exad_testimonial_designation'] ) ?></span>
						</div>
					<?php } ?>

					<?php if( $settings['exad_testimonial_reviewer_image_position'] === 'exad-testimonial-reviewer-image-pos-bottom' ) { ?>
						<div class="exad-testimonial-reviewer">
							<h4 class="exad-testimonial-name"><?php echo esc_html( $settings['exad_testimonial_name'] ) ?></h4>
							<span class="exad-testimonial-designation"><?php echo esc_html( $settings['exad_testimonial_designation'] ) ?></span>
						</div>
						<div class="exad-testimonial-thumb">
							<img src="<?php echo esc_url( $settings['exad_testimonial_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['exad_testimonial_name'] ) ?>">
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php } ?>

	<?php
	}

	protected function _content_template() {
	?>
	<#
		view.addInlineEditingAttributes( 'exad_testimonial_content_wrapper', 'class', 'exad-testimonial-content-wrapper' );

		if ( settings.exad_testimonial_description_arrow_enable === 'yes'){
			view.addInlineEditingAttributes( 'exad_testimonial_content_wrapper', 'class', 'exad-testimonial-content-wrapper-arrow' );
		}
	#>

	<# if( settings.exad_testimonial_design === 'default' ) { #>
		<div class="exad-testimonial-wrapper {{ settings.exad_testimonial_container_alignment }}">
			<div class="exad-testimonial-wrapper-inner {{ settings.exad_testimonial_image_position }}">
				<div class="exad-testimonial-thumb">
					<img src="{{ settings.exad_testimonial_image.url }}" alt="{{ settings.exad_testimonial_name }}">
				</div>
				<div class="exad-testimonial-content-wrapper">
					<p class="exad-testimonial-description">{{{ settings.exad_testimonial_description }}}</p>
					<h4 class="exad-testimonial-name">{{{ settings.exad_testimonial_name }}}</h4>
					<span class="exad-testimonial-designation">{{{ settings.exad_testimonial_designation }}}</span>
				</div>
			</div>
		</div>
	<# } #>

	<# if( settings.exad_testimonial_design === 'image-with-reviewer' ) { #>
		<div class="exad-testimonial-wrapper {{ settings.exad_testimonial_container_alignment }}">
			<div class="exad-testimonial-wrapper-inner">
				<div {{{view.getRenderAttributeString( 'exad_testimonial_content_wrapper' ) }}} >
					<p class="exad-testimonial-description">{{{ settings.exad_testimonial_description }}}</p>
				</div>
				<div class="exad-testimonial-reviewer-wrapper {{ settings.exad_testimonial_reviewer_image_position }}">
					<# if( settings.exad_testimonial_reviewer_image_position === 'exad-testimonial-reviewer-image-pos-up' || settings.exad_testimonial_reviewer_image_position === 'exad-testimonial-reviewer-image-pos-left' ) { #>
						<div class="exad-testimonial-thumb">
							<img src="{{ settings.exad_testimonial_image.url }}" alt="{{ settings.exad_testimonial_name }}">
						</div>
						<div class="exad-testimonial-reviewer">
							<h4 class="exad-testimonial-name">{{{ settings.exad_testimonial_name }}}</h4>
							<span class="exad-testimonial-designation">{{{ settings.exad_testimonial_designation }}}</span>
						</div>
					<# } #>

					<# if( settings.exad_testimonial_reviewer_image_position === 'exad-testimonial-reviewer-image-pos-bottom' ) { #>
						<div class="exad-testimonial-reviewer">
							<h4 class="exad-testimonial-name">{{{ settings.exad_testimonial_name }}}</h4>
							<span class="exad-testimonial-designation">{{{ settings.exad_testimonial_designation }}}</span>
						</div>
						<div class="exad-testimonial-thumb">
							<img src="{{ settings.exad_testimonial_image.url }}" alt="{{ settings.exad_testimonial_name }}">
						</div>
					<# } #>
				</div>
			</div>
		</div>
	<# } #>

	<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Exad_Testimonial() );
