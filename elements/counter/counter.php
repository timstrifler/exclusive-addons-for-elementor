<?php
namespace Elementor;

class Exad_Counter extends Widget_Base {
	
	public function get_name() {
		return 'exad-counter';
	}
	public function get_title() {
		return esc_html__( 'Ex Counter', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-counter';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	protected function _register_controls() {

		/*
		* Number Count
		*/
    $this->start_controls_section(
			'exad_section_counter_number',
			[
				'label' => esc_html__( 'Number', 'exclusive-addons-elementor' )
			]
    );

    $this->add_control(
			'exad_counter_number',
			[
				'label' => esc_html__( 'Count Number', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 50
			]
		);
    
		$this->end_controls_section();

		// Title
		$this->start_controls_section(
			'exad_section_counter_title',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
			]
    );

    $this->add_control(
			'exad_counter_title',
			[
				'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Counter Title', 'exclusive-addons-elementor' ),
			]
		);
    
		$this->end_controls_section();
		
		// icon
		$this->start_controls_section(
			'exad_section_counter_icon',
			[
				'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' )
			]
		);
		
		$this->add_control(
			'exad_counter_icon_show',
			[
					'label' => esc_html__( 'Enable Icon', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'return_value' => 'yes',
			]
			);

    $this->add_control(
			'exad_counter_icon',
			[
				'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-tag',
			]
		);
    
    $this->end_controls_section();
		/*
		* settings
		*/
		$this->start_controls_section(
			'exad_section_counter_settings',
			[
				'label' => esc_html__( 'Setting', 'exclusive-addons-elementor' )
			]
        );


		$this->add_control(
			'exad_counter_speed',
			[
				'label'     => esc_html__( 'Counting Speed', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'description' => __( 'In Miliseconds', 'exclusive-addons-elementor' ),
				'default'   => 2000,
			]
		);
    
		$this->end_controls_section();
				
		/*
		* Counter Styling Section
		*/
		$this->start_controls_section(
			'exad_section_counter_preset',
			[
				'label' => esc_html__( 'General Styles', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'exad_counter_alignment',
			[
				'label' => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'exad-counter-left' => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'exad-counter-center' => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'exad-counter-right' => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'exad-counter-center'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_counter_background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .exad-counter-item',
			]
		);

		$this->end_controls_section();

		/**
		* Style Tab: Icon
		*/
		$this->start_controls_section(
			'exad_section_counter_icon_style',
			[
				'label' => esc_html__( 'Icon Style', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_counter_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 50,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_counter_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_counter_icon_background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .exad-counter-item .exad-counter-icon',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_counter_icon_border',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-counter-item .exad-counter-icon',
			]
		);

		$this->add_control(
			'exad_counter_number_icon_padding',
			[
				'label'  => __( 'Paddind', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_counter_number_icon_border_radius',
			[
				'label'  => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		* Style Tab: Counter Number
		*/
		$this->start_controls_section(
			'exad_counter_number_style',
			[
				'label'                 => __( 'Counter Number Style', 'exclusive-addons-elementor' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_counter_number_color',
			[
				'label'                 => __( 'Color', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
						'{{WRAPPER}} .exad-counter-item .exad-counter-data' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'exad_counter_number_typography',
				'label'                 => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector'              => '{{WRAPPER}} .exad-counter-item .exad-counter-data ',
			]
		);

		$this->add_control(
			'exad_counter_number_margin',
			[
				'label'  => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-data' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();

		/**
		* Style Tab: Suffix
		*/
		$this->start_controls_section(
			'exad_counter_suffix_style',
			[
				'label'                 => __( 'Suffix Style', 'exclusive-addons-elementor' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_counter_suffix',
			[
				'label'                 => __( 'Suffix', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'exad_counter_suffix_color',
			[
				'label'                 => __( 'Color', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
						'{{WRAPPER}} .exad-counter-item .exad-counter-data .exad-counter-suffix' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'exad_counter_suffix_typography',
				'label'                 => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector'              => '{{WRAPPER}} .exad-counter-item .exad-counter-data .exad-counter-suffix',
			]
		);
		
		$this->end_controls_section();

		/**
		* Style Tab: Counter Title
		*/
		$this->start_controls_section(
			'exad_counter_title_style',
			[
				'label'                 => __( 'Counter Title', 'exclusive-addons-elementor' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_counter_title_color',
			[
				'label'                 => __( 'Color', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
						'{{WRAPPER}} .exad-counter-item .exad-counter-content h4' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'exad_counter_title_typography',
				'label'                 => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector'              => '{{WRAPPER}} .exad-counter-item .exad-counter-content h4',
			]
		);

		$this->add_control(
			'exad_counter_title_margin',
			[
				'label'  => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

    ?>
      <div id="exad-counter-<?php echo esc_attr($this->get_id()); ?>" class="exad-counter">
        <div class="exad-counter-item <?php echo esc_attr( $settings['exad_counter_alignment'] ); ?> ">
					<?php if ( $settings['exad_counter_icon_show'] == 'yes' ) : ?>
						<span class="exad-counter-icon">
							<i class="<?php echo esc_attr( $settings['exad_counter_icon'] ); ?>"></i>
						</span>
					<?php endif; ?>
          <div class="exad-counter-data">
						<span class="counter"  data-exad_counter_time="<?php echo esc_attr( $settings['exad_counter_speed'] ); ?>">
							<?php echo esc_html( $settings['exad_counter_number'] ); ?>
						</span>
						<span class="exad-counter-suffix"><?php echo esc_html( $settings['exad_counter_suffix'] ); ?></span>
					</div>
					<div class="exad-counter-content">
            <h4><?php echo $settings['exad_counter_title']; ?></h4>
          </div>
        </div>
      </div>
    <?php
	}

	protected function _content_template() {
		?>
      <div id="exad-counter" class="exad-counter">
        <div class="exad-counter-item {{ settings.exad_counter_alignment }} ">
					<# if ( settings.exad_counter_icon_show == 'yes' ) { #>
						<span class="exad-counter-icon">
							<i class="{{ settings.exad_counter_icon }}"></i>
						</span>
					<# } #>
          <div class="exad-counter-data">
						<span class="counter"  data-exad_counter_time="{{ settings.exad_counter_speed }}">
							{{{ settings.exad_counter_number }}}
						</span>
						<span class="exad-counter-suffix">{{{ settings.exad_counter_suffix }}}</span>
					</div>
					<div class="exad-counter-content">
            <h4>{{{ settings.exad_counter_title }}}</h4>
          </div>
        </div>
      </div>
    <?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Counter() );