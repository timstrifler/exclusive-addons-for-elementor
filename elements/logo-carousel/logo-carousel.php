<?php
namespace Elementor;

class Exad_Logo_Carousel extends Widget_Base {
	
	public function get_name() {
		return 'exad-logo-carousel';
	}
	public function get_title() {
		return esc_html__( 'Logo Carousle', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-media-carousel';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	public function get_script_depends() {
		return [ 'jquery-slick' ];
	}
	protected function _register_controls() {
    /*
    * Logo carousel Image
    */
    $this->start_controls_section(
			'exad_logo_carousel_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
			]
		);

        $logo_repeater = new Repeater();

		$logo_repeater->add_control(
			'exad_logo_carousel_image',
			[
				'label' => __( 'Logo', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
        );
        
		$logo_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'exad_logo_carousel_image[url]!' => '',
				],
			]
		);
        
        $this->add_control(
			'exad_logo_carousel_repeater',
			[
				'label' => esc_html__( 'Logo Carousel', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $logo_repeater->get_controls(),
				//'title_field' => '{{{ exad_logo_carousel_image }}}',
				'default' => [
						[
							'exad_logo_carousel_image' => Utils::get_placeholder_image_src(),
						],
						[
							'exad_logo_carousel_image' => Utils::get_placeholder_image_src(),
						],
						[
							'exad_logo_carousel_image' => Utils::get_placeholder_image_src(),
							
						],
						[
							'exad_logo_carousel_image' => Utils::get_placeholder_image_src(),
						],
				]	
			]
		);


	$this->end_controls_section();
	
	$this->start_controls_section(
		'exad_logo_carousel_settings',
		[
			'label' => esc_html__( 'Carousel Settings', 'exclusive-addons-elementor' ),
		]
	);

	$this->add_control(
		'exad_logo_slide_to_show',
		[
			'label' => esc_html__( 'Columns', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::NUMBER,
			'default' => '3'
		]
	);

	$this->add_control(
		'exad_logo_slide_to_scroll',
		[
			'label' => esc_html__( 'Slide to Scroll', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::NUMBER,
			'default' => '1'
		]
	);

	// nav style
	$this->add_control(
		'exad_logo_carousel_nav',
		[
			'label' => esc_html__( 'Navigation Style', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'arrows',
			'separator' => 'before',
			'options' => [
				'arrows' => esc_html__( 'Arrows', 'exclusive-addons-elementor' ),
				'dots' => esc_html__( 'Dots', 'exclusive-addons-elementor' ),
				
			],
		]
	);

	$this->add_control(
		'exad_logo_autoplay',
		[
			'label'     => esc_html__( 'Autoplay', 'exclusive-addons-elementor' ),
			'type'      => Controls_Manager::SWITCHER,
			'separator' => 'before',
			'default'   => 'no',
		]
	);

	$this->add_control(
		'exad_logo_autoplay_speed',
		[
			'label'     => esc_html__( 'Autoplay Speed', 'exclusive-addons-elementor' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 5000,
			'condition' => [
				'exad_logo_autoplay' => 'yes',
			],
		]
	);

	$this->add_control(
		'exad_logo_loop',
		[
			'label'   => esc_html__( 'Infinite Loop', 'exclusive-addons-elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		]
	);

	$this->end_controls_section();

	/*
	* Logo Carousel Styling Section
	*/

	$this->start_controls_section(
		'exad_logo_carousel_style_background',
		[
			'label' => esc_html__( 'General Style', 'exclusive-addons-elementor' ),
			'tab' => Controls_Manager::TAB_STYLE
		]
	);

	$this->add_control(
		'exad_logo_carousel_item_radius',
		[
			'label' => esc_html__( 'Item Radius', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'default' => [
				'top' => '0',
				'right' => '0',
				'bottom' => '0',
				'left' => '0',
			],
			'selectors' => [
				'{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_control(
		'exad_logo_carousel_item_margin',
		[
			'label' => esc_html__( 'Item margin', 'exclusive-addons-elementor' ),
			'type'           => Controls_Manager::DIMENSIONS,
            'size_units'     => [ 'px'],
            'separator' => 'before',
			'selectors' => [
				'{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->start_controls_tabs( 'exad_logo_carousel_background_tabs' );

		$this->start_controls_tab( 'exad_logo_carousel_background_control', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_logo_carousel_background',
				[
					'label' => esc_html__( 'Background', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-item' => 'background: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'exad_logo_carousel_opacity_normal',
				[
					'label' => __('Opacity', 'exclusive-addons-elementor'),
					'type' => Controls_Manager::NUMBER,
					'range' => [
					'min' => 0,
					'max' => 1
				],
					'selectors' => [
						'{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item img' => 'opacity: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'exad_logo_carousel_border_normal',
					'label' => __( 'Border', 'exclusive-addons-elementor' ),
					'selector' => '{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item',
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'exad_logo_carousel_shadow_normal',
					'label' => __( 'Box Shadow', 'plugin-domain' ),
					'selector' => '{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item',
				]
			);

		$this->end_controls_tab();

		$this->start_controls_tab( 'exad_logo_carousel_background_hover_control', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_logo_carousel_background_hover',
				[
					'label' => esc_html__( 'Background Hover', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-item:hover' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'exad_logo_carousel_opacity_hover',
				[
					'label' => __('Opacity', 'exclusive-addons-elementor'),
					'type' => Controls_Manager::NUMBER,
					'range' => [
					'min' => 0,
					'max' => 1
				],
					'selectors' => [
						'{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item:hover img' => 'opacity: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'exad_logo_carousel_border_hover',
					'label' => __( 'Border', 'exclusive-addons-elementor' ),
					'selector' => '{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item:hover',
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'exad_logo_carousel_shadow_hover',
					'label' => __( 'Box Shadow', 'plugin-domain' ),
					'selector' => '{{WRAPPER}} .exad-logo-carousel .exad-logo-carousel-element .exad-logo-carousel-item:hover',
				]
			);

		$this->end_controls_tab();

	$this->end_controls_tabs();
	
	$this->end_controls_section();

	// nav tab style

	$this->start_controls_section(
		'exad_logo_carousel_nav_tab_style',
		[
			'label' => esc_html__( 'Navigation Style', 'exclusive-addons-elementor' ),
			'tab' => Controls_Manager::TAB_STYLE
		]
	);

	$this->add_control(
		'exad_logo_carousel_dots_height',
		[
			'label' => esc_html__( 'Dots Height', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::NUMBER,
			'default' => '10px',
			'selectors' => [
				'{{WRAPPER}} .exad-logo-carousel .slick-dots li button' => 'height: {{VALUE}}px;',
			],
			'condition' => [
				'exad_logo_carousel_nav' => 'dots',
			],
		]
	);
	$this->add_control(
		'exad_logo_carousel_dots_width',
		[
			'label' => esc_html__( 'Dots Width', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::NUMBER,
			'default' => '10px',
			'selectors' => [
				'{{WRAPPER}} .exad-logo-carousel .slick-dots li button' => 'width: {{VALUE}}px;',
			],
			'condition' => [
				'exad_logo_carousel_nav' => 'dots',
			],
		]
	);
	$this->add_control(
		'exad_logo_carousel_dots_border_radius',
		[
			'label' => esc_html__( 'Dots Border Radius', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'default' => [
				'top' => '0',
				'right' => '0',
				'bottom' => '0',
				'left' => '0',
			],
			'selectors' => [
				'{{WRAPPER}} .exad-logo-carousel .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition' => [
				'exad_logo_carousel_nav' => 'dots',
			],
		]
	);
	$this->add_control(
		'exad_logo_carousel_arrows_border_radius',
		[
			'label' => esc_html__( 'Arrows Border Radius', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::SLIDER,
			'default' => [
				'size' => 0,
			],
			'range' => [
				'px' => [
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev, {{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next' => 'border-Radius: {{SIZE}}px;',
			],
			'condition' => [
				'exad_logo_carousel_nav' => 'arrows',
			],
		]
	);

	$this->start_controls_tabs( 'exad_logo_carousel_navigation_tabs' );

		$this->start_controls_tab( 'exad_logo_carousel_navigation_control', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

		$this->add_control(
			'exad_logo_carousel_arrow_color',
			[
				'label' => esc_html__( 'Arrow Background', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#b8bfc7',
				'selectors' => [
					'{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev, {{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_logo_carousel_nav' => 'arrows',
				],
			]
		);

		$this->add_control(
			'exad_logo_carousel_arrow_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev i, 
					{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'exad_logo_carousel_nav' => 'arrows',
				],
			]
		);

		$this->add_control(
			'exad_logo_carousel_dot_color',
			[
				'label' => esc_html__( 'Dot Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .slick-dots li button' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'exad_logo_carousel_nav' => 'dots',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab( 'exad_team_carousel_social_icon_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

		$this->add_control(
			'exad_logo_carousel_arrow_hover_color',
			[
				'label' => esc_html__( 'Arrow Hover', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f4f4f4',
				'selectors' => [
					'{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev:hover, 
					{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next:hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_logo_carousel_nav' => 'arrows',
				],
			]
		);

		$this->add_control(
			'exad_logo_carousel_arrow_hover_icon_color',
			[
				'label' => esc_html__( 'Icon Hover Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-prev:hover i, 
					{{WRAPPER}} .exad-logo-carousel-element .exad-logo-carousel-next:hover i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'exad_logo_carousel_nav' => 'arrows',
				],
			]
		);

		$this->add_control(
			'exad_logo_carousel_dot_hover_color',
			[
				'label' => esc_html__( 'Dot Hover', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e5e5e5',
				'selectors' => [
					'{{WRAPPER}} .slick-dots li.slick-active button, {{WRAPPER}} .slick-dots li button:hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_logo_carousel_nav' => 'dots',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
	// nav style end

	$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 
			'exad_logo_carousel', 
			[ 
				'data-carousel-nav' => $settings['exad_logo_carousel_nav'],
				'data-slidestoshow' => esc_attr( $settings['exad_logo_slide_to_show']),
				'data-slidestoscroll' => esc_attr( $settings['exad_logo_slide_to_scroll']),
				// 'data-loop' => esc_attr( $settings['exad_logo_loop']),
	    		// 'data-speed' => $settings['exad_team_transition_duration'],
			]
		);
		if ( $settings['exad_logo_loop'] == 'yes' ) {
			$this->add_render_attribute( 'exad_logo_carousel', 'data-loop', "true");
		}
		if ( $settings['exad_logo_autoplay'] == 'yes' ) {
			$this->add_render_attribute( 'exad_logo_carousel', 'data-autoplay', "true");
			$this->add_render_attribute( 'exad_logo_carousel', 'data-autoplayspeed', $settings['exad_logo_autoplay_speed'] );
		}

	?>
		<div id="exad-logo-carousel<?php echo esc_attr($this->get_id()); ?>" class="exad-logo-carousel" >
			<div class="exad-logo-carousel-element" <?php echo $this->get_render_attribute_string('exad_logo_carousel'); ?> >

				<?php foreach ( $settings['exad_logo_carousel_repeater'] as $logo ) : ?>
					<?php
						$logo_image = $logo[ 'exad_logo_carousel_image' ];
						$logo_image_url_src = Group_Control_Image_Size::get_attachment_image_src( $logo_image['id'], 'thumbnail', $logo );
				
						if ( empty( $logo_image_url_src ) ) {
							$logo_image_url = $logo_image['url'];
						}  else {
							$logo_image_url = $logo_image_url_src;
						}
					
					?>

						<div class="exad-logo-carousel-item">
							<img src="<?php echo esc_url( $logo_image_url ); ?>" >
						</div>
						
				<?php endforeach; ?>    
				
			</div>
		</div>

    <?php
	}

	protected function _content_template() {
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Logo_Carousel() );