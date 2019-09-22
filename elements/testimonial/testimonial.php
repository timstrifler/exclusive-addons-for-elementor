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
				'label' => __( 'Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .exad-testimonial-wrapper',
			]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Container Style Section
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

		$this-> end_controls_section();
	}
			
	protected function render() {
		$settings = $this->get_settings_for_display();
	?>
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
	<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Exad_Testimonial() );
