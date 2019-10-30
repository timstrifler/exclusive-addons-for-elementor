<?php
namespace Elementor;

class Exad_Business_Hours extends Widget_Base {
	
	public function get_name() {
		return 'exad-business-hours';
    }
    
	public function get_title() {
		return esc_html__( 'Business Hours', 'exclusive-addons-elementor' );
    }
    
	public function get_icon() {
		return 'exad-element-icon eicon-clock-o';
    }
    
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
    }

    public function get_keywords() {
		return [ 'business', 'hours', 'time', 'working time' ];
	}
    
    protected function _register_controls() {

		$this->start_controls_section(
			'exad_section_business_hours_layout',
			[
				'label' => esc_html__( 'Business Hours', 'exclusive-addons-elementor' ),
			]
        );

        $repeater = new Repeater();

		$repeater->add_control(
			'exad_enter_day',
			[
				'label'       => esc_html__( 'Enter Day', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Monday',
			]
		);

        $repeater->add_control(
			'exad_enter_time',
			[
				'label'       => esc_html__( 'Enter Time', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => '9:00 AM - 6:00 PM',
			]
		);

        $this->add_control(
			'exad_business_hours_repeater',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'      => array_values( $repeater->get_controls() ),
				'default'     => [
					[
						'exad_enter_day'  => esc_html__( 'Monday', 'exclusive-addons-elementor' ),
						'exad_enter_time' => esc_html__( '09:00 AM - 6:00 PM', 'exclusive-addons-elementor' ),
					],
					[
						'exad_enter_day'  => esc_html__( 'Tuesday', 'exclusive-addons-elementor' ),
						'exad_enter_time' => esc_html__( '09:00 AM - 6:00 PM', 'exclusive-addons-elementor' ),
					],
					[
						'exad_enter_day'  => esc_html__( 'Wednesday', 'exclusive-addons-elementor' ),
						'exad_enter_time' => esc_html__( '09:00 AM - 6:00 PM', 'exclusive-addons-elementor' ),
					],
					[
						'exad_enter_day'  => esc_html__( 'Thursday', 'exclusive-addons-elementor' ),
						'exad_enter_time' => esc_html__( '09:00 AM - 6:00 PM', 'exclusive-addons-elementor' ),
					],
					[
						'exad_enter_day'  => esc_html__( 'Friday', 'exclusive-addons-elementor' ),
						'exad_enter_time' => esc_html__( '09:00 AM - 6:00 PM', 'exclusive-addons-elementor' ),
					],
					[
						'exad_enter_day'      => esc_html__( 'Saturday', 'exclusive-addons-elementor' ),
						'exad_enter_time'     => esc_html__( '09:00 AM - 6:00 PM', 'exclusive-addons-elementor' ),
					],
					[
						'exad_enter_day'      => esc_html__( 'Sunday', 'exclusive-addons-elementor' ),
						'exad_enter_time'     => esc_html__( 'Closed', 'exclusive-addons-elementor' ),
					],
				],
				'title_field' => '{{{ exad_enter_day }}}',
			]
		);

		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'exad_section_businesshours_style',
			[
				'label' => esc_html__( 'General Style', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_businesshours_same_background_switcher',
			[
				'label'        => esc_html__('Same Backgrund Effect', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'exad_businesshours_same_background',
			[
				'label'     => esc_html__( 'Same Background Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .business-date' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_businesshours_same_background_switcher' => 'yes',
				],
			]
		);

		$this->add_control(
			'exad_businesshours_background_switcher',
			[
				'label'        => esc_html__( 'Striped Backgrund Effect', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'exad_businesshours_effect_odd',
			[
				'label'     => esc_html__( 'Odd Item Background', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .business-date:nth-child(odd)' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_businesshours_background_switcher' => 'yes',
				],
			]
		);

		$this->add_control(
			'exad_businesshours_effect_even_color',
			[
				'label'     => esc_html__( 'Even Item Background', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .business-date:nth-child(even)' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_businesshours_background_switcher' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'exad_section_businesshours_item_padding',
			[
				'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => ['top' => 5, 'right' => 5, 'bottom' => 5, 'left' => 5],
				'selectors'  => [
					'{{WRAPPER}} .business-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_business_item_border',
			[
				'label'        => esc_html__( 'Border', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_businesshours_item_border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .business-date',
				'condition' => [
					'exad_business_item_border' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'exad_section_business_day_style',
			[
				'label' => esc_html__( 'Day Style', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_day_color',
			[
				'label'     => esc_html__( 'Day Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f5f7fa',
				'selectors' => [
					'{{WRAPPER}} .single-business-date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Day Typography', 'exclusive-addons-elementor' ),
				'name'     => 'exad_business_day_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .single-business-date',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'exad_section_business_time_style',
			[
				'label' => esc_html__( 'Time Style', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_time_color',
			[
				'label'     => esc_html__( 'Time Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f5f7fa',
				'selectors' => [
					'{{WRAPPER}} .single-business-time' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Time Typography', 'exclusive-addons-elementor' ),
				'name'     => 'exad_business_time_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .single-business-time',
			]
		);


		$this->end_controls_section();
    }
    public function render() {
        $settings = $this->get_settings();
        ?>
        	<div class="exad-businesshours-container">
				<?php
				if ( count( $settings['exad_business_hours_repeater'] ) ) {
				$count = 0;
				?>
					<div class="exad-businesshours-container-inner">
						<?php
						foreach ( $settings['exad_business_hours_repeater'] as $item ) { ?>
						
								<div class="business-date">
									<span class="single-business-date"><?php echo esc_html($item['exad_enter_day']); ?></span>
									<span class="single-business-time"><?php echo esc_html($item['exad_enter_time']); ?></span>
								</div>

							<?php
							$count++;
						} ?>
					</div>
				<?php } ?>
			</div>
		<?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Exad_Business_Hours() );