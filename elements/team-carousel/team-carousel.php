<?php
namespace Elementor;

class Exad_Team_Carousel extends Widget_Base {

	private $lightbox_slide_index;
	private $slide_prints_count = 0;

	public function get_name() {
		return 'exad-team-carousel';
	}

	public function get_title() {
		return esc_html__( 'DC Team Carousel', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'fa fa-users';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_script_depends() {
		return [ 'jquery-slick' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_team_carousel',
			[
				'label' => esc_html__( 'Contents', 'exclusive-addons-elementor' ),
			]
		);

		$team_repeater = new Repeater();

		/*
		* Team Member Image
		*/
		$team_repeater->add_control(
			'exad_team_carousel_image',
			[
				'label' => __( 'Image', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$team_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'exad_team_carousel_image[url]!' => '',
				],
			]
		);

		$team_repeater->add_control(
			'exad_team_carousel_name',
			[
				'label' => esc_html__( 'Name', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'John Doe', 'exclusive-addons-elementor' ),
			]
		);
		
		$team_repeater->add_control(
			'exad_team_carousel_designation',
			[
				'label' => esc_html__( 'Designation', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'My Designation', 'exclusive-addons-elementor' ),
			]
		);
		
		$team_repeater->add_control(
			'exad_team_carousel_description',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Add team member details here', 'exclusive-addons-elementor' ),
			]
		);

		$team_repeater->add_control(
			'exad_team_carousel_enable_social_profiles',
			[
				'label' => esc_html__( 'Display Social Profiles?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$team_repeater->add_control(
			'exad_team_carousel_facebook_link',
			[
				'label' => __( 'Facebook URL', 'plugin-domain' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'exad_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		$team_repeater->add_control(
			'exad_team_carousel_twitter_link',
			[
				'label' => __( 'Twitter URL', 'plugin-domain' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'exad_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		$team_repeater->add_control(
			'exad_team_carousel_instagram_link',
			[
				'label' => __( 'Instagram URL', 'plugin-domain' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'exad_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		$team_repeater->add_control(
			'exad_team_carousel_linkedin_link',
			[
				'label' => __( 'Linkedin URL', 'plugin-domain' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'exad_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		$team_repeater->add_control(
			'exad_team_carousel_dribbble_link',
			[
				'label' => __( 'Dribbble URL', 'plugin-domain' ),
				'type' => Controls_Manager::URL,
				'condition' => [
					'exad_team_carousel_enable_social_profiles!' => '',
				],
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		
		$this->add_control(
			'team_carousel_repeater',
			[
				'label' => esc_html__( 'Team Carousel', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $team_repeater->get_controls(),
				'title_field' => '{{{ exad_team_carousel_name }}}',
				//'default' => $this->get_repeater_defaults(),
			]
		);



		$slides_per_view = range( 1, 10 );
		$slides_per_view = array_combine( $slides_per_view, $slides_per_view );

		$this->add_responsive_control(
			'exad_team_per_view',
			[
				'type'           => Controls_Manager::SELECT,
				'label'          => esc_html__( 'Members Each Row', 'exclusive-addons-elementor' ),
				'label_block'    => true,
				'options'        => $slides_per_view,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
			]
		);

		$this->add_control(
			'exad_team_slides_to_scroll',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Members to Scroll', 'exclusive-addons-elementor' ),
				'label_block'    => true,
				'options'   => $slides_per_view,
				'default'   => '1',
			]
		);


		$this->end_controls_section();

		/*
		* Team Members Styling Section
		*/
		$this->start_controls_section(
			'exad_section_team_carousel_styles_general',
			[
				'label' => esc_html__( 'General Styles', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'exad_team_carousel_preset',
			[
				'label' => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '-circle',
				'options' => [
					'-circle' => esc_html__( 'Circle Gradient', 'exclusive-addons-elementor' ),
					'-social-left' => esc_html__( 'Social Left on Hover', 'exclusive-addons-elementor' ),
					'-content-hover' => esc_html__( 'Content on Hover', 'exclusive-addons-elementor' ),
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_avatar_bg',
			[
				'label' => esc_html__( 'Avatar Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(255,255,255,0.8)',
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-circle .exad-team-member-thumb svg.team-avatar-bg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_preset' => '-circle',
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_nav',
			[
				'label' => esc_html__( 'Navigation Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'arrows',
				'options' => [
					'arrows' => esc_html__( 'Arrows', 'exclusive-addons-elementor' ),
					'dots' => esc_html__( 'Dots', 'exclusive-addons-elementor' ),
					
				],
			]
		);


		$this->start_controls_tabs( 'exad_team_carousel_navigation_tabs' );

		$this->start_controls_tab( 'exad_team_carousel_navigation_control', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

		$this->add_control(
			'exad_team_carousel_arrow_color',
			[
				'label' => esc_html__( 'Arrow Background', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#b8bfc7',
				'selectors' => [
					'{{WRAPPER}} .exad-team-carousel-prev, {{WRAPPER}} .exad-team-carousel-next' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_nav' => 'arrows',
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_dot_color',
			[
				'label' => esc_html__( 'Dot Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .exad-team-carousel-wrapper .slick-dots li button' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_nav' => 'dots',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab( 'exad_team_carousel_social_icon_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

		$this->add_control(
			'exad_team_carousel_arrow_hover_color',
			[
				'label' => esc_html__( 'Arrow Hover', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .exad-team-carousel-prev:hover, {{WRAPPER}} .exad-team-carousel-next:hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_nav' => 'arrows',
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_dot_hover_color',
			[
				'label' => esc_html__( 'Dot Hover', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .exad-team-carousel-wrapper .slick-dots li.slick-active button, {{WRAPPER}} .exad-team-carousel-wrapper .slick-dots li button:hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_nav' => 'dots',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
            'section_team_carousel_name',
            [
                'label' => __('Name', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'exad_title_color',
            [
                'label' => __('Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .exad-team-member-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .exad-team-member-name',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_team_member_designation',
            [
                'label' => __('Designation', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'exad_designation_color',
            [
                'label' => __('Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#8a8d91',
                'selectors' => [
                    '{{WRAPPER}} .exad-team-member-designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'designation_typography',
                'selector' => '{{WRAPPER}} .exad-team-member-designation',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_team_carousel_description',
            [
                'label' => __('Description', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'exad_description_color',
            [
                'label' => __('Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#8a8d91',
                'selectors' => [
                    '{{WRAPPER}} .exad-team-member-about' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'exad_description_typography',
                'selector' => '{{WRAPPER}} .exad-team-member-about',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_carousel_settings',
			[
				'label' => esc_html__( 'Carousel Settings', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_team_transition_duration',
			[
				'label'   => esc_html__( 'Transition Duration', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 1000,
			]
		);

		$this->add_control(
			'exad_team_autoplay',
			[
				'label'     => esc_html__( 'Autoplay', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'exad_team_autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'exad_team_autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'exad_team_loop',
			[
				'label'   => esc_html__( 'Infinite Loop', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
            'exad_team_carousel_social_section',
            [
                'label' => __('Social', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->start_controls_tabs( 'exad_team_carousel_social_icons_style_tabs' );

		$this->start_controls_tab( 'exad_team_carousel_social_icon_control', 
			[ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] 
		);

		$this->add_control(
			'exad_team_carousel_social_color_1',
			[
				'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-social-left .exad-team-member-social li a' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_preset' => '-social-left',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab( 'exad_team_carousel_social_icon_hover_control', 
			[ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] 
		);

		$this->add_control(
			'exad_team_carousel_social_hover_color_1',
			[
				'label' => esc_html__( 'Hover Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ff6d55',
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-social-left .exad-team-member-social li a:hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_preset' => '-social-left'
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();

	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$team_carousel_classes = $this->get_settings_for_display('exad_team_carousel_image_rounded');
		$team_preset = $settings['exad_team_carousel_preset']; 


		$this->add_render_attribute( 
			'exad-team-carousel', 
			[ 
				'class' => [ 'exad-team-carousel-wrapper', 'exad-team-carousel' . $team_preset ],
				'data-team-preset' => $team_preset,
				'data-carousel-nav' => $settings['exad_team_carousel_nav'],
				'data-slidestoshow' => $settings['exad_team_per_view'],
				'data-slidestoscroll' => $settings['exad_team_slides_to_scroll'],
	    		'data-speed' => $settings['exad_team_transition_duration'],
			]
		);

		if ( $settings['exad_team_autoplay_speed'] == 'yes' ) {
            $this->add_render_attribute( 'exad-team-carousel', 'data-autoplayspeed', "true");
        }

		if ( $settings['exad_team_autoplay'] == 'yes' ) {
            $this->add_render_attribute( 'exad-team-carousel', 'data-autoplay', "true");
        }

		if ( $settings['exad_team_loop'] == 'yes' ) {
            $this->add_render_attribute( 'exad-team-carousel', 'data-loop', "true");
        }

		
	?>	
		<div <?php echo $this->get_render_attribute_string( 'exad-team-carousel' ); ?>>

			<?php foreach ( $settings['team_carousel_repeater'] as $key => $member ) : 

			$team_carousel_image = $member['exad_team_carousel_image'];
			$team_carousel_image_url = Group_Control_Image_Size::get_attachment_image_src( $team_carousel_image['id'], 'thumbnail', $member );
			if( empty( $team_carousel_image_url ) ) : $team_carousel_image_url = $team_carousel_image['url']; else: $team_carousel_image_url = $team_carousel_image_url; endif;

				?>	
				<div class="exad-team-carousel<?php echo $team_preset; ?>-inner">
	            	<div class="exad-team-member<?php echo $team_preset; ?>">
	                	<div class="exad-team-member-thumb">
	                		<?php if( $team_preset == '-circle' ) : ?>
								<svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
									<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
								</svg>
								<svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
									<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
								</svg>
								<svg xmlns="http://www.w3.org/2000/svg" class="team-avatar-bg">
									<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
								</svg>
							<?php endif; ?>
	                  		<img src="<?php echo esc_url($team_carousel_image_url); ?>" class="circled" alt="<?php echo $member['exad_team_carousel_name']; ?>">
	                	</div>
	                	<div class="exad-team-member-content">
		                	<h2 class="exad-team-member-name"><?php echo $member['exad_team_carousel_name']; ?></h2>
		                	<span class="exad-team-member-designation"><?php echo $member['exad_team_carousel_designation']; ?></span>
		                	<p class="exad-team-member-about">
			                	<?php echo $member['exad_team_carousel_description']; ?>
			                </p>
		                	<?php if ( $member['exad_team_carousel_enable_social_profiles'] == 'yes' ): ?>
							<ul class="list-inline exad-team-member-social">
								
								<?php if ( ! empty( $member['exad_team_carousel_facebook_link']['url'] ) ) : ?>
									<?php $target = $member['exad_team_carousel_facebook_link']['is_external'] ? ' target="_blank"' : ''; ?>
									<li>
										<a href="<?php echo esc_url( $member['exad_team_carousel_facebook_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-facebook"></i></a>
									</li>
								<?php endif; ?>

								<?php if ( ! empty( $member['exad_team_carousel_twitter_link']['url'] ) ) : ?>
									<?php $target = $member['exad_team_carousel_twitter_link']['is_external'] ? ' target="_blank"' : ''; ?>
									<li>
										<a href="<?php echo esc_url( $member['exad_team_carousel_twitter_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-twitter"></i></a>
									</li>
								<?php endif; ?>

								<?php if ( ! empty( $member['exad_team_carousel_instagram_link']['url'] ) ) : ?>
									<?php $target = $member['exad_team_carousel_instagram_link']['is_external'] ? ' target="_blank"' : ''; ?>
									<li>
										<a href="<?php echo esc_url( $member['exad_team_carousel_instagram_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-instagram"></i></a>
									</li>
								<?php endif; ?>

								<?php if ( ! empty( $member['exad_team_carousel_linkedin_link']['url'] ) ) : ?>
									<?php $target = $member['exad_team_carousel_linkedin_link']['is_external'] ? ' target="_blank"' : ''; ?>
									<li>
										<a href="<?php echo esc_url( $member['exad_team_carousel_linkedin_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-linkedin"></i></a>
									</li>
								<?php endif; ?>

								<?php if ( ! empty( $member['exad_team_carousel_dribbble_link']['url'] ) ) : ?>
									<?php $target = $member['exad_team_carousel_dribbble_link']['is_external'] ? ' target="_blank"' : ''; ?>
									<li>
										<a href="<?php echo esc_url( $member['exad_team_carousel_dribbble_link']['url'] ); ?>"<?php echo $target; ?>><i class="fa fa-dribbble"></i></a>
									</li>
								<?php endif; ?>
								
							</ul>
							<?php endif; ?>
						</div>
	              	</div>
	          	</div>
      		<?php endforeach; ?>
		</div>	
	<?php	
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Team_Carousel() );