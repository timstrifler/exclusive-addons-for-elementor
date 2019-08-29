<?php
namespace Elementor;

class Exad_Alert extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-exclusive-alert';
	}
	public function get_title() {
		return esc_html__( 'Alert', 'exclusive-addons-elementor' );
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

    $this->add_control(
      'exad_alert_close_button',
      [
        'label'     => __( 'Close Icon Or Button', 'exclusive-addons-elementor' ),
        'type'      => Controls_Manager::SELECT,
        'default' => 'icon',
        'options' => [
          'icon' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
          'button' => esc_html__( 'Button', 'exclusive-addons-elementor' ),
        ]
      ]
    );
    $this->add_control(
      'exad_alert_close_primary_button',
      [
        'label'     => __( 'Primary Button', 'exclusive-addons-elementor' ),
        'type'      => Controls_Manager::TEXT,
        'default' => "Done",
        'condition' => [
          'exad_alert_close_button' => ['button'],
        ]
      ]
    );
    $this->add_control(
      'exad_alert_close_secondary_button',
      [
        'label'     => __( 'Secondary Button', 'exclusive-addons-elementor' ),
        'type'      => Controls_Manager::TEXT,
        'default' => "Cancle",
        'condition' => [
          'exad_alert_close_button' => ['button'],
        ]
      ]
    );
    
    $this->end_controls_section();

    /**
     * Alert Content style Tab
     */
    $this->start_controls_section(
			'exad_alert_style',
			[
        'label' => esc_html__( 'Container Style', 'exclusive-addons-elementor' ),
        'tab' => Controls_Manager::TAB_STYLE,
			]
    );

    $this->add_control(
      'exad_alert_background_style',
      [
        'label' => esc_html__( 'Background', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::COLOR,
        'default' => '#ECF9FD',
        'selectors' => [
          '{{WRAPPER}} .exad-alert-wrapper' => 'background: {{VALUE}};'
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
                'max' => 60,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .exad-alert-wrapper' => 'border-radius: {{SIZE}}px;',
        ],
      ]
    );

    $this->add_control(
      'exad_alert_margin_content',
      [
        'label' => esc_html__( 'Margin Between Content & Icon', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::SLIDER,
        'default' => [
            'size' => 0,
        ],
        'range' => [
            'px' => [
                'max' => 50,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .exad-alert-element .exad-alert-element-content' => 'margin-left: {{SIZE}}px;',
        ],
      ]
    );

    $this->add_control(
      'exad_alert_padding',
      [
        'label' => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'default' => [
          'top' => '20',
          'right' => '20',
          'bottom' => '20',
          'left' => '20',
        ],
				'selectors' => [
					'{{WRAPPER}} .exad-alert-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
      ]
    );

    $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_alert_border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-alert-wrapper',
			]
    );
    
    $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_alert_box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-alert-wrapper',
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
              'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .exad-alert-element .exad-alert-element-icon span' => 'font-size: {{SIZE}}px;',
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
          '{{WRAPPER}} .exad-alert-element .exad-alert-element-icon span' => 'color: {{VALUE}};',
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
        'label' => esc_html__( 'Dismiss Button Style', 'exclusive-addons-elementor' ),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'exad_alert_dismiss_icon_color',
      [
        'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::COLOR,
        'default' => '#A1A5B5',
        'selectors' => [
          '{{WRAPPER}} .exad-alert-element .exad-alert-element-dismiss-icon svg path' => 'fill: {{VALUE}};',
        ],
        'condition' => [
          'exad_alert_close_button' => 'icon',
        ]
      ]
    );

    $this->start_controls_tabs( 'exad_alert_dismiss_button', 
      [
        'condition' => ['exad_alert_close_button' => 'button'],
      ] );

      $this->start_controls_tab( 'exad_alert_dismiss_primary_button', [ 'label' => esc_html__( 'Primary Button', 'exclusive-addons-elementor' ) ] );

      $this->add_control(
        'exad_alert_dismiss_primary_button_background',
        [
          'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
          'type' => Controls_Manager::COLOR,
          'default' => '#A1A5B5',
          'selectors' => [
            '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-done' => 'background: {{VALUE}};',
          ]
        ]
      );
      $this->add_control(
        'exad_alert_dismiss_primary_button_text_color',
        [
          'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
          'type' => Controls_Manager::COLOR,
          'default' => '#A1A5B5',
          'selectors' => [
            '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-done' => 'color: {{VALUE}};',
          ],
        ]
      );

      $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
          'name' => 'exad_alert_dismiss_primary_button_text',
          'label' => __( 'Typography', 'exclusive-addons-elementor' ),
          'scheme' => Scheme_Typography::TYPOGRAPHY_1,
          'selector' => '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-done',
        ]
      );

      $this->add_group_control(
        Group_Control_Border::get_type(),
        [
          'name' => 'exad_alert_dismiss_primary_button_border',
          'label' => __( 'Border', 'exclusive-addons-elementor' ),
          'selector' => '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-done',
        ]
      );

      $this->add_control(
        'exad_alert_dismiss_primary_button_padding',
        [
          'label' => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%', 'em' ],
          'selectors' => [
            '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-done' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
        ]
      );

      $this->add_control(
        'exad_alert_dismiss_primary_button_radious',
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
              '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-done' => 'border-radius: {{SIZE}}px;',
          ],
        ]
      );

      $this->end_controls_tab();
		

      $this->start_controls_tab( 'exad_alert_dismiss_secondary_button', [ 'label' => esc_html__( 'Secondary Button', 'exclusive-addons-elementor' ) ] );
      
      $this->add_control(
        'exad_alert_dismiss_secondary_button_background',
        [
          'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
          'type' => Controls_Manager::COLOR,
          'default' => '#A1A5B5',
          'selectors' => [
            '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-cancel' => 'background: {{VALUE}};',
          ],
          'condition' => [
            'exad_alert_close_button' => 'button',
          ]
        ]
      );

      $this->add_control(
        'exad_alert_dismiss_secondary_button_text_color',
        [
          'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
          'type' => Controls_Manager::COLOR,
          'default' => '#A1A5B5',
          'selectors' => [
            '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-cancel' => 'color: {{VALUE}};',
          ],
        ]
      );

      $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
          'name' => 'exad_alert_dismiss_secondary_button_text',
          'label' => __( 'Typography', 'exclusive-addons-elementor' ),
          'scheme' => Scheme_Typography::TYPOGRAPHY_1,
          'selector' => '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-cancel',
        ]
      );

      $this->add_group_control(
        Group_Control_Border::get_type(),
        [
          'name' => 'exad_alert_dismiss_secondary_button_border',
          'label' => __( 'Border', 'plugin-domain' ),
          'selector' => '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-cancel',
        ]
      );

      $this->add_control(
        'exad_alert_dismiss_secondary_button_padding',
        [
          'label' => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%', 'em' ],
          'selectors' => [
            '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-cancel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
        ]
      );

      $this->add_control(
        'exad_alert_dismiss_secondary_button_radious',
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
              '{{WRAPPER}} .exad-alert-element-dismiss-button .exad-alert-element-dismiss-cancel' => 'border-radius: {{SIZE}}px;',
          ],
        ]
      );

      $this->end_controls_tab();
		
		$this->end_controls_tabs();

    $this->end_controls_section();
	}
	protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
      <div class="exad-alert">
        <div class="exad-alert-wrapper" data-alert>
          <div class="exad-alert-element">
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
            <?php if($settings['exad_alert_close_button'] === 'icon') { ?>
            <div class="exad-alert-element-dismiss-icon">
              <svg>
                <path fill-rule="evenodd" d="M2.343 15.071L.929 13.656 6.586 8 .929 2.343 2.343.929 8 6.585 13.657.929l1.414 1.414L9.414 8l5.657 5.656-1.414 1.415L8 9.414l-5.657 5.657z"/>
              </svg>
            </div>
            <?php } ?>
          </div>
          <?php if($settings['exad_alert_close_button'] === 'button') { ?>
          <div class="exad-alert-element-dismiss-button">
            <a href="#" class="exad-alert-element-dismiss-done"><?php echo esc_html( $settings['exad_alert_close_primary_button'] ); ?></a>
            <a href="#" class="exad-alert-element-dismiss-cancel"><?php echo esc_html( $settings['exad_alert_close_secondary_button'] ); ?></a>
          </div>
          <?php } ?>
        </div>
      </div>
    <?php 
	}

	protected function _content_template() {
    ?>
    <div class="exad-alert">
        <div class="exad-alert-wrapper" data-alert>
          <div class="exad-alert-element">
            <# if ( settings.exad_alert_content_icon_show === 'yes' ) { #>
              <div class="exad-alert-element-icon">
                <span><i class="{{ settings.exad_alert_content_icon }}"></i></span>
              </div>
            <# } #>
            <div class="exad-alert-element-content">
              <# if ( settings.exad_alert_content_title_show === 'yes' ) { #>
                <h5>{{{ settings.exad_alert_content_title }}}</h5>
              <# } #>
              <p>{{{ settings.exad_alert_content_description }}}</p>
            </div>
            <# if( settings.exad_alert_close_button  === 'icon') { #>
            <div class="exad-alert-element-dismiss-icon">
              <svg>
                <path fill-rule="evenodd" d="M2.343 15.071L.929 13.656 6.586 8 .929 2.343 2.343.929 8 6.585 13.657.929l1.414 1.414L9.414 8l5.657 5.656-1.414 1.415L8 9.414l-5.657 5.657z"/>
              </svg>
            </div>
            <# } #>
          </div>
          <# if( settings.exad_alert_close_button  === 'button') { #>
          <div class="exad-alert-element-dismiss-button">
            <a href="#" class="exad-alert-element-dismiss-done">{{{ settings.exad_alert_close_primary_button }}}</a>
            <a href="#" class="exad-alert-element-dismiss-cancel">{{{ settings.exad_alert_close_secondary_button }}}</a>
          </div>
          <# } #>
        </div>
      </div>
      <?php
  }
  
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Alert() );