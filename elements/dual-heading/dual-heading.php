<?php
namespace Elementor;

class Exad_Dual_Heading extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-exclusive-dual-heading';
	}
	public function get_title() {
		return esc_html__( 'Ex Dual Heading', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-heading';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
  protected function _register_controls() {

		/**
		* Dual Heading Content Section
		*/
		$this->start_controls_section(
			'exad_dual_heading_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
			]
    );
    
    $this->add_control(
			'exad_dual_first_heading',
			[
				'label' => esc_html__( 'First Heading', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'default' => esc_html__( 'First Part', 'exclusive-addons-elementor' ),
			]
    );
    $this->add_control(
			'exad_dual_second_heading',
			[
				'label' => esc_html__( 'Second Heading', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'default' => esc_html__( 'Second Part', 'exclusive-addons-elementor' ),
			]
    );

    $this->add_control(
			'exad_dual_heading_description',
			[
				'label'       => __( 'Sub Heading', 'exclusive-addons-elementor' ),
        'type'        => Controls_Manager::TEXTAREA,
        'label_block' => true,
				'separator' => 'before',
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Welcome to WordPress. This is your first post. Edit or delete it, then start writing!', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Your Description', 'exclusive-addons-elementor' ),
			]
		);

    $this->add_control(
			'exad_dual_heading_icon',
			[
				'label'     => __( 'Icon', 'exclusive-addons-elementor' ),
        'type'      => Controls_Manager::ICON,
        'label_block' => true,
				'separator' => 'before',
				'default'   => 'fa fa-heart',
			]
    );

    $this->add_control(
      'exad_dual_heading_icon_show',
      [
        'label' => esc_html__( 'Enable Icon', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'return_value' => 'yes',
      ]
    );
    
    $this->add_responsive_control(
			'exad_dual_heading_alignment',
			[
				'label' => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
        'default' => 'center',
        'label_block' => true,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);
    
    $this->end_controls_section();
		

		/*
		* Dual Heading Styling Section
		*/
		$this->start_controls_section(
			'exad_dual_heading_styles_icon',
			[
				'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

    $this->add_control(
			'exad_dual_heading_icon_color',
			[
				'label'		=> esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#132C47',
				'selectors'	=> [
					'{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper .exad-exclusive-heading-icon' => 'color: {{VALUE}};',
				],
			]
    );

    $this->end_controls_section();

    /*
		* Dual Heading First Part Styling Section
		*/
    $this->start_controls_section(
			'exad_dual_first_heading_styles',
			[
				'label' => esc_html__( 'First Heading', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
    );

    $this->add_control(
			'exad_dual_heading_first_text_color',
			[
				'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#132C47',
				'selectors'	=> [
					'{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper .exad-exclusive-heading-title a .first-heading' => 'color: {{VALUE}};',
				],
			]
    );
    $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
			'name' => 'exad_dual_first_heading_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper .exad-exclusive-heading-title a .first-heading',
			]
    );
    
    $this->add_control(
			'exad_dual_heading_first_bg_color',
			[
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper .exad-exclusive-heading-title a .first-heading' => 'background-color: {{VALUE}};',
				],
			]
		);

    $this->end_controls_section();

    /*
		* Dual Heading Second Part Styling Section
		*/
    $this->start_controls_section(
			'exad_dual_second_heading_styles',
			[
				'label' => esc_html__( 'Second Heading', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
    );

    $this->add_control(
			'exad_dual_heading_second_text_color',
			[
				'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#132C47',
				'selectors'	=> [
					'{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper .exad-exclusive-heading-title a .second-heading' => 'color: {{VALUE}};',
				],
			]
    );
    $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
			'name' => 'exad_dual_second_heading_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper .exad-exclusive-heading-title a .second-heading',
			]
    );
    // $this->add_group_control(
		// 	Group_Control_Background::get_type(),
		// 	[
		// 		'name' => 'background',
		// 		'label' => __( 'Background', 'exclusive-addons-elementor' ),
		// 		'types' => [ 'classic', 'gradient' ],
		// 		'selector' => '{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper .exad-exclusive-heading-title a span',
		// 	]
    // );
    $this->add_control(
			'exad_dual_heading_second_bg_color',
			[
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper .exad-exclusive-heading-title a .second-heading' => 'background-color: {{VALUE}};',
				],
			]
		);
    

    $this->end_controls_section();

    /*
		* Dual Heading description Styling Section
    */
    $this->start_controls_section(
			'exad_dual_heading_description_styles',
			[
				'label' => esc_html__( 'Sub Heading', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
    );

    $this->add_control(
			'exad_dual_heading_description_text_color',
			[
				'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default' => '#989B9E',
				'selectors'	=> [
					'{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper .exad-exclusive-heading-description' => 'color: {{VALUE}};',
				],
			]
    );
    $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
			'name' => 'exad_dual_heading_description_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper .exad-exclusive-heading-description',
			]
    );

    $this->end_controls_section();
  }
  
  protected function render() {
		$settings = $this->get_settings_for_display();
		?>

    <div id="exad-heading-<?php echo esc_attr($this->get_id()); ?>" class="exad-exclusive-heading eight">
      <div class="exad-exclusive-heading-wrapper">
        <?php if ( $settings['exad_dual_heading_icon_show'] == 'yes' ) : ?>
          <span class="exad-exclusive-heading-icon"><i class="<?php echo esc_attr( $settings['exad_dual_heading_icon'] ); ?>"></i></span>
				<?php endif; ?>
        <h1 class="exad-exclusive-heading-title">
          <a href="<?php echo esc_url( $settings['exad_heading_title_link']['url'] ); ?>">
            <span class="first-heading"><?php echo esc_html( $settings['exad_dual_first_heading'] ); ?></span>
            <span class="second-heading"><?php echo esc_html( $settings['exad_dual_second_heading'] ); ?></span>
          </a>
        </h1>
        <p class="exad-exclusive-heading-description">
        <?php echo esc_html( $settings['exad_dual_heading_description'] ); ?>
        </p>
      </div>
    </div>
	<?php
  }

  protected function _content_template() {
    ?>
    <div id="exad-heading" class="exad-exclusive-heading eight">
      <div class="exad-exclusive-heading-wrapper">
        <# if ( settings.exad_dual_heading_icon_show == 'yes' ) { #>
          <span class="exad-exclusive-heading-icon"><i class="{{ settings.exad_dual_heading_icon }}"></i></span>
				<# } #>
        <h1 class="exad-exclusive-heading-title"><a href="{{{ settings.exad_heading_title_link }}}">
          <span class="first-heading">{{{ settings.exad_dual_first_heading }}}</span>
          <span class="second-heading">{{{ settings.exad_dual_second_heading }}}</span>
        </a></h1>
        <p class="exad-exclusive-heading-description">
        {{{ settings.exad_dual_heading_description }}}
        </p>
      </div>
    </div>
		<?php
	}
  
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Dual_Heading() );