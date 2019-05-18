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
				'default' => '#b8bfc7',
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
				'default' => '#917cff',
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
				'default' => '#b8bfc7',
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
				'default' => '#8a8d91',
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
		'exad_section_logo_carousel_styles_preset',
		[
			'label' => esc_html__( 'General Styles', 'exclusive-addons-elementor' ),
			'tab' => Controls_Manager::TAB_STYLE
		]
	);

	$this->add_control(
		'exad_logo_carousel_preset',
		[
			'label' => esc_html__( 'Presets', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'one',
			'separator' => 'before',
			'options' => [
				'one' => esc_html__( 'One', 'exclusive-addons-elementor' ),
				'two' => esc_html__( 'Two', 'exclusive-addons-elementor' ), 
				'four' => esc_html__( 'Three', 'exclusive-addons-elementor' ),
				'five' => esc_html__( 'Four', 'exclusive-addons-elementor' ),
				'six' => esc_html__( 'Five', 'exclusive-addons-elementor' ),
			]
		]
	);
	$this->end_controls_section();
	$this->start_controls_section(
		'exad_logo_carousel_style_background',
		[
			'label' => esc_html__( 'Background Style', 'exclusive-addons-elementor' ),
			'tab' => Controls_Manager::TAB_STYLE
		]
	);

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
	$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$logo_carousel_preset = $settings['exad_logo_carousel_preset'];

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
		<div id="exad-logo-carousel<?php echo esc_attr($this->get_id()); ?>" class="exad-logo-carousel <?php echo $logo_carousel_preset ?>" >
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