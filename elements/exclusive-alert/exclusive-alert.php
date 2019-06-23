<?php
namespace Elementor;

class Exad_Alert extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-exclusive-alert';
	}
	public function get_title() {
		return esc_html__( 'Exclusive Alert', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-alert';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	protected function _register_controls() {
    /**
     * Alert Content Tab
     */
    $this->start_controls_section(
			'exad_alert_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
			]
    );

    // $this->add_control(
    //   'exad_alert_content_type',
    //   [
    //     'label' => esc_html__( 'Type', 'exclusive-addons-elementor' ),
    //     'type' => Controls_Manager::SELECT,
    //     'options' => [
    //       'primary' => esc_html__( 'Primary', 'exclusive-addons-elementor' ),
    //       'secondary' => esc_html__( 'Secondary', 'exclusive-addons-elementor' ),
    //       'success' => esc_html__( 'Success', 'exclusive-addons-elementor' ),
    //       'danger' => esc_html__( 'Danger', 'exclusive-addons-elementor' ),
    //       'warning' => esc_html__( 'Warning', 'exclusive-addons-elementor' ),
    //       'info' => esc_html__( 'Info', 'exclusive-addons-elementor' ),
    //     ],
    //     'default' => 'primary',
    //   ]
    // );

    $this->add_control(
      'exad_alert_content_icon_show',
      [
          'label' => esc_html__( 'Enable Icon', 'exclusive-addons-elementor' ),
          'type' => Controls_Manager::SWITCHER,
          'default' => 'yes',
          'return_value' => 'yes',
      ]
    );

    $this->add_control(
      'exad_alert_content_icon',
      [
        'label'     => __( 'Icon', 'exclusive-addons-elementor' ),
        'type'      => Controls_Manager::ICON,
        'default'   => 'fa fa-wordpress',
        'condition' => [
          'exad_alert_content_icon_show' => 'yes'
        ]
      ]
    );
    $this->add_control(
      'exad_alert_content_title_show',
      [
          'label' => esc_html__( 'Enable Title', 'exclusive-addons-elementor' ),
          'type' => Controls_Manager::SWITCHER,
          'default' => 'yes',
          'return_value' => 'yes',
      ]
    );
    $this->add_control(
      'exad_alert_content_title',
      [
        'label'     => __( 'Title', 'exclusive-addons-elementor' ),
        'type'      => Controls_Manager::TEXTAREA,
        'default'   => 'Well Done!',
        'condition' => [
          'exad_alert_content_title_show' => 'yes'
        ]
      ]
    );
    $this->add_control(
      'exad_alert_content_description',
      [
        'label'     => __( 'Description', 'exclusive-addons-elementor' ),
        'type'      => Controls_Manager::TEXTAREA,
        'default'   => 'A simple alert—check it out!',
      ]
    );
    
    $this->end_controls_section();

    /**
     * Alert Content style Tab
     */
    $this->start_controls_section(
			'exad_alert_style',
			[
        'label' => esc_html__( 'Alert Style', 'exclusive-addons-elementor' ),
        'tab' => Controls_Manager::TAB_STYLE,
			]
    );

    $this->add_control(
      'exad_alert_preset',
      [
        'label' => esc_html__( 'Preset', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::SELECT,
        'default' => 'one',
        'options' => [
          'one' => esc_html__( 'One', 'exclusive-addons-elementor' ),
          'five' => esc_html__( 'Two', 'exclusive-addons-elementor' ),
        ]
      ]
    );

    $this->add_control(
      'exad_alert_background_style',
      [
        'label' => esc_html__( 'Background', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::COLOR,
        'default' => '#ECF9FD',
        'selectors' => [
          '{{WRAPPER}} .exad-alert-element' => 'background: {{VALUE}};'
        ]
      ]
    );

    $this->add_control(
      'exad_alert_border_radious',
      [
        'label' => esc_html__( 'Border Radious', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::SLIDER,
        'default' => [
            'size' => 0,
        ],
        'range' => [
            'px' => [
                'max' => 40,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .exad-alert-element' => 'border-radius: {{SIZE}}px;',
        ],
      ]
    );

    $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_alert_border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-alert-element',
			]
    );
    
    $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_alert_box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-alert-element',
			]
		);

    $this->end_controls_section();

    /**
     * Alert Icon style
     */
    $this->start_controls_section(
      'exad_alert_icon_style',
      [
        'label' => esc_html__( 'Icon Style', 'exclusive-addons-elementor' ),
        'tab' => Controls_Manager::TAB_STYLE,
        'condition' => [
          'exad_alert_content_icon_show' => 'yes',
        ]
      ]
    );

    $this->add_control(
      'exad_alert_icon_size',
      [
        'label' => esc_html__( 'Size', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::SLIDER,
        'default' => [
          'size' => 24,
        ],
        'range' => [
          'px' => [
              'max' => 40,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .exad-alert.one .exad-alert-element .exad-alert-element-icon span' => 'font-size: {{SIZE}}px;',
        ],
      ]
    );

    $this->add_control(
      'exad_alert_icon_color',
      [
        'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::COLOR,
        'default' => '#272727',
        'selectors' => [
          '{{WRAPPER}} .exad-alert.one .exad-alert-element .exad-alert-element-icon span' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->end_controls_section();

    /**
     * Alert Content Title style Tab
     */
    $this->start_controls_section(
      'exad_alert_title_style',
      [
        'label' => esc_html__( 'Title Style', 'exclusive-addons-elementor' ),
        'tab' => Controls_Manager::TAB_STYLE,
        'condition' => [
          'exad_alert_content_title_show' => 'yes',
        ]
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
			[
				'name' => 'exad_alert_title_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .exad-alert-element .exad-alert-element-content h5',
			]
    );

    $this->add_control(
      'exad_alert_title_color',
      [
        'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::COLOR,
        'default' => '#272727',
        'selectors' => [
          '{{WRAPPER}} .exad-alert-element .exad-alert-element-content h5' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->end_controls_section();

    /**
     * Alert Content Description style Tab
     */
    $this->start_controls_section(
      'exad_alert_description_style',
      [
        'label' => esc_html__( 'Discription Style', 'exclusive-addons-elementor' ),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_group_control(
      Group_Control_Typography::get_type(),
			[
				'name' => 'exad_alert_description_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .exad-alert-element .exad-alert-element-content p',
			]
    );

    $this->add_control(
      'exad_alert_description_color',
      [
        'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::COLOR,
        // 'default' => '#272727',
        'selectors' => [
          '{{WRAPPER}} .exad-alert-element .exad-alert-element-content p' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->end_controls_section();

    /**
     * Alert Dismiss button style
     */
    $this->start_controls_section(
      'exad_alert_dismiss_style',
      [
        'label' => esc_html__( 'Dismiss Button', 'exclusive-addons-elementor' ),
        'tab' => Controls_Manager::TAB_STYLE,
        'condition' => [
          'exad_alert_preset' => 'one',
        ]
      ]
    );

    $this->add_control(
      'exad_alert_dismiss_button_color',
      [
        'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::COLOR,
        'default' => '#A1A5B5',
        'selectors' => [
          '{{WRAPPER}} .exad-alert-element .exad-alert-element-dismiss-icon svg path' => 'fill: {{VALUE}};',
        ],
      ]
    );

    $this->end_controls_section();
	}
	protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
    <?php if ( $settings['exad_alert_preset'] === 'one' ) { ?>
      <div class="exad-alert <?php echo esc_attr( $settings['exad_alert_preset'] ) ?>">
        <div class="exad-alert-element <?php echo esc_attr( $settings['exad_alert_content_type'] ); ?>" data-alert>
          <?php if ( $settings['exad_alert_content_icon_show'] === 'yes' ) { ?>
            <div class="exad-alert-element-icon">
              <span><i class="<?php echo esc_attr( $settings['exad_alert_content_icon'] ); ?>"></i></span>
            </div>
          <?php } ?>
          <div class="exad-alert-element-content">
            <?php if ( $settings['exad_alert_content_title_show'] === 'yes' ) { ?>
              <h5><?php echo esc_html( $settings['exad_alert_content_title'] ); ?></h5>
            <?php } ?>
            <p><?php echo esc_html( $settings['exad_alert_content_description'] ); ?></p>
          </div>
          <div class="exad-alert-element-dismiss-icon">
            <svg>
              <path fill-rule="evenodd" d="M2.343 15.071L.929 13.656 6.586 8 .929 2.343 2.343.929 8 6.585 13.657.929l1.414 1.414L9.414 8l5.657 5.656-1.414 1.415L8 9.414l-5.657 5.657z"/>
            </svg>
          </div>
        </div>
      </div>
    <?php } ?>

    <?php if ( $settings['exad_alert_preset'] === 'five' ) { ?>
      <div class="exad-alert <?php echo esc_attr( $settings['exad_alert_preset'] ) ?>">
        <div class="exad-alert-element <?php echo esc_attr( $settings['exad_alert_content_type'] ); ?>" data-alert>
          <?php if ( $settings['exad_alert_content_icon_show'] === 'yes' ) { ?>
            <div class="exad-alert-element-icon">
              <span><i class="<?php echo esc_attr( $settings['exad_alert_content_icon'] ); ?>"></i></span>
            </div>
          <?php } ?>
          <div class="exad-alert-element-content">
            <?php if ( $settings['exad_alert_content_title_show'] === 'yes' ) { ?>
              <h5><?php echo esc_html( $settings['exad_alert_content_title'] ); ?></h5>
            <?php } ?>
            <p><?php echo esc_html( $settings['exad_alert_content_description'] ); ?></p>
          </div>
          <div class="exad-alert-element-dismiss-icon">
            <a href="#" class="exad-alert-element-dismiss-done">Done</a>
            <a href="" class="exad-alert-element-dismiss-cancel">Cancel</a>
          </div>
        </div>
      </div>
    <?php } ?>

    <?php 
	}

	protected function _content_template() {
  }
  
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Alert() );