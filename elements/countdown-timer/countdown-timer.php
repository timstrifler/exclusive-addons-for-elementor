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
		 * Team member Social profiles section 
		 */
		
		$this->start_controls_section(
  			'exad_section_countdown_social_profiles',
  			[
  				'label' => esc_html__( 'Social Profiles', 'exclusive-addons-elementor' )
  			]
  		);

		$this->add_control(
			'exad_countdown_enable_social_profiles',
			[
				'label' => esc_html__( 'Display Social Profiles?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
		
		

		$this->end_controls_section();


		/*
		 * Team Members Styling Section
		 */

		$this->start_controls_section(
			'exad_section_countdown_styles_general',
			[
				'label' => esc_html__( 'Team Member Styles', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_countdown_preset',
			[
				'label' => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'exad-team-members-simple',
				'options' => [
					'exad-team-members-simple' 		=> esc_html__( 'Simple Style', 		'exclusive-addons-elementor' ),
					'exad-team-members-overlay' 	=> esc_html__( 'Overlay Style', 	'exclusive-addons-elementor' ),
					'exad-team-members-social-left-hover' 	=> esc_html__( 'Centered Style', 	'exclusive-addons-elementor' ),
					'exad-team-members-rounded' 		=> esc_html__( 'Circle Style', 	'exclusive-addons-elementor' ),
					'exad-team-members-pro-style-5' => esc_html__( 'Social on Bottom', 	'exclusive-addons-elementor' ),
				],
			]
		);

		$this->add_control(
			'exad_countdown_overlay_background',
			[
				'label' => esc_html__( 'Overlay Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(255,255,255,0.8)',
				'selectors' => [
					'{{WRAPPER}} .exad-team-members-overlay .exad-team-content' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'exad_countdown_preset' => 'exad-team-members-overlay',
				],
			]
		);

		$this->add_control(
			'exad_countdown_background',
			[
				'label' => esc_html__( 'Content Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .exad-team-item .exad-team-content' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/*
		* Team Member Image Styling
		*/

		$this->start_controls_section(
			'exad_section_countdown_image_styles',
			[
				'label' => esc_html__( 'Team Member Image Style', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);		

		$this->add_responsive_control(
			'exad_countdown_image_width',
			[
				'label' => esc_html__( 'Image Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .exad-team-item figure img' => 'width:{{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'exad_countdown_image_margin',
			[
				'label' => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .exad-team-item figure img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'exad_countdown_image_padding',
			[
				'label' => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .exad-team-item figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_countdown_bg_svg',
			[
				'label' => esc_html__( 'Avatar Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(255,255,255,0.8)',
				'selectors' => [
					'{{WRAPPER}} .exad-team-image svg.exad-member-img-bg g' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'exad_countdown_preset' => 'exad-team-members-rounded',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_countdown_image_border',
				'label' => esc_html__( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-item figure img',
			]
		);

		$this->add_control(
			'exad_countdown_image_rounded',
			[
				'label' => esc_html__( 'Rounded Avatar?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'team-avatar-rounded',
				'default' => '',
			]
		);


		$this->add_control(
			'exad_countdown_image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .exad-team-item figure img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'condition' => [
					'exad_countdown_image_rounded!' => 'team-avatar-rounded',
				],
			]
		);

		$this->end_controls_section();

		 

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
	
	?>

	<div class="exad-countdown-content-container">
        <div class="exad-countdown two" data-day="Days" data-minutes="Minutes" data-hours="Hours" data-seconds="Seconds" data-countdown="<?php echo esc_attr( $settings['exad_countdown_time'] ); ?>"></div>
    </div>

<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Countdown_Timer() );
