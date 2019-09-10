<?php
namespace Elementor;

class Exad_Heading extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-exclusive-heading';
	}
	public function get_title() {
		return esc_html__( 'Heading', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-heading';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	protected function _register_controls() {
		
		/**
		* Heading Content Section
		*/
		$this->start_controls_section(
			'exad_heading_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_heading_title',
			[
				'label' => esc_html__( 'Heading', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'default' => esc_html__( 'Heading Title', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_heading_title_link',
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
			'exad_heading_subheading',
			[
				'label' => esc_html__( 'Sub Heading', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Basic description about the Heading', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
            'exad_heading_icon_show',
            [
                'label' => esc_html__( 'Enable Icon', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'exad_heading_icon',
            [
                    'label'     => __( 'Icon', 'exclusive-addons-elementor' ),
            'type'      => Controls_Manager::ICON,
            'default'   => 'fa fa-wordpress',
            'condition' => [
                'exad_heading_icon_show' => 'yes'
                ]
            ]
        );

		$this->end_controls_section();
		

		/*
		* Heading Styling Section
		*/
		$this->start_controls_section(
			'exad_section_heading_styles_preset',
			[
				'label' => esc_html__( 'General Styles', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);


		// $this->add_control(
		// 	'exad_heading_styles_preset',
		// 	[
		// 		'label' => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
		// 		'type' => Controls_Manager::SELECT,
		// 		'default' => 'parallax',
		// 		'options' => [
		// 			'parallax' => esc_html__( 'Image/Gradient', 'exclusive-addons-elementor' ),
		// 			'separator' => esc_html__( 'With Separator', 'exclusive-addons-elementor' ),
        //             'text-as-bg' => esc_html__( 'Text Background', 'exclusive-addons-elementor' ),
		// 		],
		// 	]
		// );

		// $this->add_control(
        //     'exad_heading_enable_divider',
        //     [
        //         'label' => esc_html__( 'Enable Divider', 'exclusive-addons-elementor' ),
        //         'type' => Controls_Manager::SWITCHER,
        //         'default' => 'yes',
        //         'return_value' => 'yes',
        //     ]
		// );
		
		// $this->add_control(
		// 	'exad_heading_separator_color',
		// 	[
		// 			'label' => __('Divider Color', 'exclusive-addons-elementor'),
		// 			'type' => Controls_Manager::COLOR,
		// 			'default' => '#826EFF',
		// 			'selectors' => [
		// 					'{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-title::before' => 'background: {{VALUE}};',
        //             ],
        //             'condition' => [
        //                 'exad_heading_enable_divider' => 'yes'
        //             ]
		// 	]
		// );
				
        // $this->add_control(
        //     'exad_heading_icon_color',
        //     [
        //         'label'		=> esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
        //         'type'		=> Controls_Manager::COLOR,
        //         'default' => '#132C47',
        //         'selectors'	=> [
        //             '{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper .exad-heading-icon' => 'color: {{VALUE}};',
        //         ],
        //     ]
        // );

        $this->add_responsive_control(
			'exad_heading_title_alignment',
			[
				'label' => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'exad-heading-left' => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'exad-heading-center' => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'exad-heading-right' => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'exad-heading-center'
			]
		);

		$this->end_controls_section();


		/*
		* Heading Content Styling Section
		*/
		$this->start_controls_section(
			'exad_section_heading_styles_heading',
			[
				'label' => esc_html__( 'Heading', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'exad_heading_separator',
            [
                'label' => esc_html__( 'Separator Show', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'exad_section_heading_style_separator',
			[
				'label' => esc_html__( 'Separator', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_heading_separator' => 'yes',
				],
			]
		);

		$this->add_control(
			'exad_heading_separator_height',
			[
				'label' => esc_html__( 'Separator Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '2',
				'selectors' => [
					'{{WRAPPER}} .exad-heading-separator' => 'height: {{VALUE}}px;',
				],
				
			]
		);
		$this->add_control(
			'exad_heading_separator_width',
			[
				'label' => esc_html__( 'Separator Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '50',
				'selectors' => [
					'{{WRAPPER}} .exad-heading-separator' => 'width: {{VALUE}}px;',
				],
			]
		);
		$this->add_control(
			'exad_heading_separator_background',
			[
				'label' => esc_html__( 'Separator Background', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e3e3e3',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .exad-heading-separator' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'exad_heading_separator_margin_top',
			[
				'label' => __( 'Margin Top', 'plugin-domain' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .exad-heading-separator' => 'margin-top: {{VALUE}}px;',
				],
			]
		);
		// $this->add_control(
		// 	'exad_heading_color',
		// 	[
		// 			'label' => __('Color', 'exclusive-addons-elementor'),
		// 			'type' => Controls_Manager::COLOR,
		// 			'default' => '#132c47',
		// 			'selectors' => [
		// 					'{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper .exad-exclusive-heading-title a' => 'color: {{VALUE}};',
        //             ],
        //             'condition' => [
        //                 'exad_heading_styles_preset!' => 'parallax'
        //             ]
		// 	]
		// );

		// $this->add_control(
        //     'exad_heading_title_text_bg',
        //     [
        //         'label' => esc_html__( 'Text Background', 'exclusive-addons-elementor' ),
        //         'type' => Controls_Manager::SWITCHER,
        //         'default' => 'yes',
        //         'return_value' => 'yes',
        //     ]
		// );
		
		// $this->add_group_control(
		// 	Group_Control_Background::get_type(),
		// 	[
		// 		'name' => 'background',
		// 		'label' => __( 'Title Background', 'exclusive-addons-elementor' ),
		// 		'types' => [ 'classic', 'gradient' ],
		// 		'selector' => '{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-title',
		// 		'condition' => [
        //             'exad_heading_title_text_bg' => 'yes'
        //         ]
		// 	]
		// );

		// $this->add_group_control(
		// 	Group_Control_Typography::get_type(),
		// 	[
		// 			'name' => 'exad_heading_title_typography',
		// 			'selector' => '{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper .exad-exclusive-heading-title',
		// 	]
        // );

        
        
        // $this->add_control(
		// 	'exad_heading_background_font_size',
		// 	[
		// 		'label' => __( 'Background Font Size', 'exclusive-addons-elementor' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px' ],
		// 		'range' => [
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 200,
		// 				'step' => 5,
		// 			],
		// 		],
		// 		'default' => [
		// 			'unit' => 'px',
		// 			'size' => 60,
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .exad-exclusive-heading.text-as-bg .exad-exclusive-heading-wrapper .exad-exclusive-heading-title::before' => 'font-size: {{SIZE}}{{UNIT}};',
        //         ],
        //         'condition' => [
        //             'exad_heading_styles_preset' => 'text-as-bg'
        //         ]
		// 	]
		// );

		$this->end_controls_section();

		// description style
		$this->start_controls_section(
			'exad_section_heading_styles_subheading',
			[
				'label' => esc_html__( 'Sub Heading', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'exad_heading_description_color',
			[
					'label' => __('Color', 'exclusive-addons-elementor'),
					'type' => Controls_Manager::COLOR,
					'default' => '#8a8d91',
					'selectors' => [
							'{{WRAPPER}} .exad-exclusive-heading-description' => 'color: {{VALUE}};',
					],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
					'name' => 'exad_heading_subheading_typography',
					'selector' => '{{WRAPPER}} .exad-exclusive-heading-description',
			]
		);
		$this->add_control(
			'exad_heading_subheading_margin',
			[
				'label' => __( 'Margin', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-exclusive-heading-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		
	}
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 
			'exad_heading_attribute', 
			[ 
				'class' => [ 'exad-exclusive-heading', $settings['exad_heading_styles_preset'] ],
				'id' => 'exad-heading'
			]
		);

		if ( 'yes' === $settings['exad_heading_title_text_bg'] ) {
			$this->add_render_attribute( 'exad_heading_attribute', 'class', 'text-as-bg' );
		}

        ?>
        
        <div <?php echo $this->get_render_attribute_string( 'exad_heading_attribute' ); ?>>
            <div class="exad-exclusive-heading-wrapper <?php echo esc_attr( $settings['exad_heading_title_alignment'] ); ?>">
				<?php if ( $settings['exad_heading_icon_show'] == 'yes' ) : ?>
          			<span class="exad-heading-icon"><i class="<?php echo esc_attr( $settings['exad_heading_icon'] ); ?>"></i></span>
				<?php endif; ?>
				<!-- <div class="exad-heading-separator"></div> -->
                <h1 data-content="<?php echo esc_attr( $settings['exad_heading_title'] ); ?>" class="exad-exclusive-heading-title">
                    <a href="<?php echo esc_url( $settings['exad_heading_title_link']['url'] ); ?>"><?php echo esc_html( $settings['exad_heading_title'] ); ?></a>
				</h1>
				<?php if ( $settings['exad_heading_separator'] == 'yes' ) : ?>
					<div class="exad-heading-separator"></div>
				<?php endif; ?>
                <?php if ( $settings['exad_heading_subheading'] != "" ) : ?>
                    <p class="exad-exclusive-heading-description"><?php echo esc_html( $settings['exad_heading_subheading'] ); ?></p>
                <?php endif; ?>
            </div>
        </div>

	<?php
	}

	/*protected function _content_template() {
		?>
		<div id="exad-heading" class="exad-exclusive-heading {{ settings.exad_heading_styles_preset }}">
          <div class="exad-exclusive-heading-wrapper {{ settings.exad_heading_title_alignment }}">
				<# if ( settings.exad_heading_icon_show == 'yes' ) { #>
          		    <span class="exad-heading-icon"><i class="{{ settings.exad_heading_icon }}"></i></span>
				<# } #>
            <h1 data-content="{{ settings.exad_heading_title }}" class="exad-exclusive-heading-title">
                <a href="{{ settings.exad_heading_title_link.url }}">{{{ settings.exad_heading_title }}}</a>
            </h1>
            <# if ( settings.exad_heading_subheading != "" ) { #>
                <p class="exad-exclusive-heading-description">{{{ settings.exad_heading_subheading }}}</p>
            <# } #>
          </div>
        </div>
		<?php
	}*/

}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Heading() );