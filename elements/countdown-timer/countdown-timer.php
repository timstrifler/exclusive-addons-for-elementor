<?php
namespace Elementor;

class Exad_Countdown_Timer extends Widget_Base {
	
	//use ElementsCommonFunctions;

	public function get_name() {
		return 'exad-countdown-timer';
	}

	public function get_title() {
		return esc_html__( 'DC Countdown Timer', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'fa fa-user-circle';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_script_depends() {
		return [ 'exad-countdown' ];
	}

	protected function _register_controls() {

		/**
		 * Countdown Timer Settings
		 */
		$this->start_controls_section(
  			'exad_section_countdown_settings_general',
  			[
  				'label' => esc_html__( 'Timer Settings', 'exclusive-addons-elementor' )
  			]
  		);
		
		$this->add_control(
			'exad_countdown_time',
			[
				'label' => esc_html__( 'Countdown Date', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DATE_TIME,
				'default' => date("Y/m/d", strtotime("+ 1 week")),
				'description' => esc_html__( 'Set the date and time here', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_responsive_control(
			'exad_countdown_label_padding_left',
			[
				'label' => esc_html__( 'Left spacing for Labels', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'description' => esc_html__( 'Use when you select inline labels', 'exclusive-addons-elementor' ),
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .exad-countdown-label' => 'padding-left:{{SIZE}}px;',
				],
				'condition' => [
					'exad_countdown_label_view' => 'exad-countdown-label-inline',
				],
			]
		);


		$this->end_controls_section();


		/*
		 * Countdown Timer Styling Section
		 */

		$this->start_controls_section(
			'exad_section_countdown_styles_preset',
			[
				'label' => esc_html__( 'Presets', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_countdown_preset',
			[
				'label' => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1' 	=> esc_html__( 'Style 1', 'exclusive-addons-elementor' ),
					'style-2' 	=> esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
				],
			]
		);

		$this->add_control(
			'exad_countdown_divider_color',
			[
				'label' => __( 'Divider Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .exad-countdown.style-2 .exad-countdown-count::after' => 'color: {{VALUE}};',
				],
				'condition' => [
					'exad_countdown_preset' => 'style-2',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'exad_section_countdown_box_style',
			[
				'label' => esc_html__( 'Box Style', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_countdown_preset' => 'style-1',
				],
			]
		);



		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_countdown_background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-countdown.style-1 .exad-countdown-container',
				'condition' => [
					'exad_countdown_preset' => 'style-1',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-countdown-container',
				'condition' => [
					'exad_countdown_preset' => 'style-1',
				],
			]
		);

		$this->add_control(
			'exad_before_border',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thin',
				'condition' => [
					'exad_countdown_preset' => 'style-1',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-countdown.style-1 .exad-countdown-container',
				'condition' => [
					'exad_countdown_preset' => 'style-1',
				],
			]
		);

		$this->add_control(
			'exad_countdown_image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .exad-countdown.style-1 .exad-countdown-container' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'default' => [
					'top' => 4,
					'right' => 4,
					'bottom' => 4,
					'left' => 4,
					'unit' => 'px',
					'isLinked' => true,
				],
				'condition' => [
					'exad_countdown_preset' => 'style-1',
				],
			]
		);


		$this->end_controls_section();
		
		// Counter Styles

		$this->start_controls_section(
			'exad_section_countdown_styles_counter',
			[
				'label' => esc_html__( 'Counter Style', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
						'name' => 'counter_typography',
						'selector' => '{{WRAPPER}} .exad-countdown-count',
				]
		);

		$this->add_control(
			'exad_progress_bar_count_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .exad-countdown-count' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		// Title Styles

		$this->start_controls_section(
			'exad_section_countdown_styles_title',
			[
				'label' => esc_html__( 'Title Style', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
						'name' => 'title_typography',
						'selector' => '{{WRAPPER}} .exad-countdown-title',
				]
		);

		$this->add_control(
			'exad_progress_bar_title_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .exad-countdown-title' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'exad-countdown-timer-attribute',
			[
				'data-day'	=> 'Days',
				'data-minutes' => 'Minutes',
				'data-hours'	=> 'Hours',
				'data-seconds' => 'Seconds',
				'data-countdown' => esc_attr( $settings['exad_countdown_time'] )
			]
		);

		?>
		<div id="exad-countdown-timer-<?php echo esc_attr($this->get_id()); ?>" class="exad-countdown-content-container">
			<div class="exad-countdown <?php echo esc_attr( $settings['exad_countdown_preset'] ); ?>"				
			<?php echo $this->get_render_attribute_string('exad-countdown-timer-attribute') ?>></div>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<div id="exad-countdown-timer" class="exad-countdown-content-container">
			<div class="exad-countdown {{ settings.exad_countdown_preset }}" data-day="Days" data-minutes="Minutes" data-hours="Hours" data-seconds="Seconds" data-countdown="{{ settings.exad_countdown_time }}"></div>
		</div>
		<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Countdown_Timer() );
