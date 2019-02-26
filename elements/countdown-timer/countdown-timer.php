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
		return [ 'exad-jquery-countdown' ];
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
			'exad_section_countdown_styles_general',
			[
				'label' => esc_html__( 'Countdown Timer Styles', 'exclusive-addons-elementor' ),
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
					'style-3' 	=> esc_html__( 'Style 3', 'exclusive-addons-elementor' ),
				],
			]
		);

		$this->add_control(
			'exad_countdown_background',
			[
				'label' => esc_html__( 'Box Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#552de9',
				'selectors' => [
					'{{WRAPPER}} .exad-countdown.style-1 .exad-countdown-container' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'exad_countdown_preset' => 'style-1',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .exad-countdown.style-1 .exad-countdown-container',
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

		// $this->add_control(
		// 	'exad_countdown_border_radius',
		// 	[
		// 		'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'default' => '',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .exad-countdown.style-1 .exad-countdown-container' => 'background-color: {{VALUE}};',
		// 		],
		// 		'condition' => [
		// 			'exad_countdown_preset' => 'style-1',
		// 		],
		// 	]
		// );

		$this->end_controls_section();
		
		// Count Styles

		$this->start_controls_section(
			'exad_section_countdown_styles_count',
			[
				'label' => esc_html__( 'Count Style', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
						'name' => 'count_typography',
						'selector' => '{{WRAPPER}} .exad-countdown-count',
				]
		);

		$this->add_control(
			'exad_progress_bar_count_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
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
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .exad-countdown-title' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();

		// /*
		// * Team Member Image Styling
		// */

		// $this->start_controls_section(
		// 	'exad_section_countdown_image_styles',
		// 	[
		// 		'label' => esc_html__( 'Team Member Image Style', 'exclusive-addons-elementor' ),
		// 		'tab' => Controls_Manager::TAB_STYLE
		// 	]
		// );		

		// $this->add_responsive_control(
		// 	'exad_countdown_image_width',
		// 	[
		// 		'label' => esc_html__( 'Image Width', 'exclusive-addons-elementor' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'default' => [
		// 			'size' => 100,
		// 			'unit' => '%',
		// 		],
		// 		'range' => [
		// 			'%' => [
		// 				'min' => 0,
		// 				'max' => 100,
		// 			],
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 1000,
		// 			],
		// 		],
		// 		'size_units' => [ '%', 'px' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .exad-team-item figure img' => 'width:{{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );


		// $this->add_responsive_control(
		// 	'exad_countdown_image_margin',
		// 	[
		// 		'label' => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
		// 		'type' => Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .exad-team-item figure img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

		// $this->add_responsive_control(
		// 	'exad_countdown_image_padding',
		// 	[
		// 		'label' => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
		// 		'type' => Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%', 'em' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .exad-team-item figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'exad_countdown_bg_svg',
		// 	[
		// 		'label' => esc_html__( 'Avatar Background Color', 'exclusive-addons-elementor' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'default' => 'rgba(255,255,255,0.8)',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .exad-team-image svg.exad-member-img-bg g' => 'fill: {{VALUE}};',
		// 		],
		// 		'condition' => [
		// 			'exad_countdown_preset' => 'style-1',
		// 		],
		// 	]
		// );
		
		// $this->add_group_control(
		// 	Group_Control_Border::get_type(),
		// 	[
		// 		'name' => 'exad_countdown_image_border',
		// 		'label' => esc_html__( 'Border', 'exclusive-addons-elementor' ),
		// 		'selector' => '{{WRAPPER}} .exad-team-item figure img',
		// 	]
		// );

		// $this->add_control(
		// 	'exad_countdown_image_rounded',
		// 	[
		// 		'label' => esc_html__( 'Rounded Avatar?', 'exclusive-addons-elementor' ),
		// 		'type' => Controls_Manager::SWITCHER,
		// 		'return_value' => 'team-avatar-rounded',
		// 		'default' => '',
		// 	]
		// );

		// $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div id="exad-countdown-timer-<?php echo esc_attr($this->get_id()); ?>" class="exad-countdown-content-container">
			<div class="exad-countdown <?php echo esc_attr( $settings['exad_countdown_preset'] ); ?>" data-day="Days" data-minutes="Minutes" data-hours="Hours" data-seconds="Seconds" data-countdown="<?php echo esc_attr( $settings['exad_countdown_time'] ); ?>"></div>
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
