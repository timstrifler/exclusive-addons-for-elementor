<?php
namespace Elementor;

class Exad_Dual_Heading extends Widget_Base {
	
	public function get_name() {
		return 'exad-exclusive-dual-heading';
	}
	public function get_title() {
		return esc_html__( 'Ex Dual Heading', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-type-tool';
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
                    'default' => esc_html__( 'First', 'exclusive-addons-elementor' ),
                ]
        );
        $this->add_control(
                'exad_dual_second_heading',
                [
                    'label' => esc_html__( 'Second Heading', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__( 'Second', 'exclusive-addons-elementor' ),
                ]
        );

        $this->add_control(
            'exad_dual_heading_title_link',
            [
                'label' => __( 'Heading URL', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                ],
            ]
        );

        $this->add_control(
                'exad_dual_heading_description',
                [
                    'label'       => __( 'Sub Heading', 'exclusive-addons-elementor' ),
            'type'        => Controls_Manager::TEXTAREA,
            'label_block' => true,
                    'dynamic'     => [ 'active' => true ],
                    'default'     => __( 'Add your sub heading here.', 'exclusive-addons-elementor' ),
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

        $this->add_control(
            'exad_dual_heading_icon',
            [
            'label'     => __( 'Icon', 'exclusive-addons-elementor' ),
            'type'      => Controls_Manager::ICON,
            'default'   => 'fa fa-wordpress',
            'condition' => [
                'exad_dual_heading_icon_show' => 'yes'
            ]
            ]
        );

        
        $this->end_controls_section();
            

            /*
            * Dual Heading Styling Section
            */
            $this->start_controls_section(
                'exad_dual_heading_styles_general',
                [
                    'label' => esc_html__( 'General Styles', 'exclusive-addons-elementor' ),
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
                        '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-icon' => 'color: {{VALUE}};',
                    ],
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
                'selectors' => [
                    '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper' => 'text-align: {{VALUE}};',
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
                    'default' => '#ffffff',
                    'selectors'	=> [
                        '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title a .first-heading' => 'color: {{VALUE}};',
                    ],
                ]
        );
        
        $this->add_control(
			'exad_dual_heading_first_bg_color',
			[
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fb4b15',
				'selectors' => [
					'{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title a .first-heading' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
			'name' => 'exad_dual_first_heading_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title a .first-heading',
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
                        '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title a .second-heading' => 'color: {{VALUE}};',
                    ],
                ]
        );
        
        $this->add_control(
                'exad_dual_heading_second_bg_color',
                [
                    'label' => __( 'Background', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title a .second-heading' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
            'name' => 'exad_dual_second_heading_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title a .second-heading',
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
                        '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-description' => 'color: {{VALUE}};',
                    ],
                ]
        );
        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                'name' => 'exad_dual_heading_description_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-description',
                ]
        );

        $this->end_controls_section();
    }
  
    protected function render() {
	$settings = $this->get_settings_for_display();
    
    ?>

    <div id="exad-heading-<?php echo esc_attr($this->get_id()); ?>" class="exad-dual-heading">
      <div class="exad-dual-heading-wrapper">
        <?php if ( $settings['exad_dual_heading_icon_show'] == 'yes' ) : ?>
          <span class="exad-dual-heading-icon"><i class="<?php echo esc_attr( $settings['exad_dual_heading_icon'] ); ?>"></i></span>
				<?php endif; ?>
        <h1 class="exad-dual-heading-title">
          <a href="<?php echo esc_url( $settings['exad_dual_heading_title_link']['url'] ); ?>">
            <span class="first-heading"><?php echo esc_html( $settings['exad_dual_first_heading'] ); ?></span><span class="second-heading"><?php echo esc_html( $settings['exad_dual_second_heading'] ); ?></span>
          </a>
        </h1>
        <?php if ( $settings['exad_dual_heading_description'] != "" ) : ?>
            <p class="exad-dual-heading-description"><?php echo esc_html( $settings['exad_dual_heading_description'] ); ?></p>
        <?php endif; ?>    
      </div>
    </div>
	<?php
    }

    protected function _content_template() {
    ?>
        <div id="exad-heading" class="exad-dual-heading">
        <div class="exad-dual-heading-wrapper">
            <# if ( settings.exad_dual_heading_icon_show == 'yes' ) { #>
            <span class="exad-dual-heading-icon"><i class="{{ settings.exad_dual_heading_icon }}"></i></span>
                    <# } #>
            <h1 class="exad-dual-heading-title">
                <a href="{{{ settings.exad_dual_heading_title_link }}}">
                    <span class="first-heading">{{{ settings.exad_dual_first_heading }}}</span><span class="second-heading">{{{ settings.exad_dual_second_heading }}}</span>
                </a>
            </h1>
            <# if ( settings.exad_dual_heading_description != "" ) { #>
                <p class="exad-dual-heading-description">{{{ settings.exad_dual_heading_description }}}</p>
            <# } #>
        </div>
        </div>
	<?php
    }
  
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Dual_Heading() );