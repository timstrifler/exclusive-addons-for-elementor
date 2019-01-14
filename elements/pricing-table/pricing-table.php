<?php
namespace Elementor;

class Exad_Pricing_Table extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-pricing-table';
	}
	public function get_title() {
		return esc_html__( 'DC Pricing Table', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'fa fa-user-circle';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	protected function _register_controls() {
		/*
		* Team Member Image
		*/
		$this->start_controls_section(
			'exad_section_pricing_table_image',
			[
				'label' => esc_html__( 'Team Member Image', 'exclusive-addons-elementor' )
			]
		);
		
		$this->add_control(
			'exad_pricing_table_image',
			[
				'label' => __( 'Team Member Avatar', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'exad_pricing_table_image[url]!' => '',
				],
			]
		);
		$this->end_controls_section();
		/**
		* Team Member Content Section
		*/
		$this->start_controls_section(
			'exad_team_content',
			[
				'label' => esc_html__( 'Team Member Information', 'exclusive-addons-elementor' ),
			]
		);
		
		$this->add_control(
			'exad_pricing_table_name',
			[
				'label' => esc_html__( 'Name', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'John Doe', 'exclusive-addons-elementor' ),
			]
		);
		
		$this->add_control(
			'exad_pricing_table_designation',
			[
				'label' => esc_html__( 'Designation', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'My Designation', 'exclusive-addons-elementor' ),
			]
		);
		
		$this->add_control(
			'exad_pricing_table_description',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Add team member details here', 'exclusive-addons-elementor' ),
			]
		);
		$this->end_controls_section();
		/*
		* Team member Social profiles section
		*/
		
		$this->start_controls_section(
			'exad_section_pricing_table_social_profiles',
			[
				'label' => esc_html__( 'Social Profiles', 'exclusive-addons-elementor' )
			]
		);
		$this->add_control(
			'exad_pricing_table_enable_social_profiles',
			[
				'label' => esc_html__( 'Display Social Profiles?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
		
		$this->add_control(
			'exad_pricing_table_social_profile_links',
			[
				'type' => Controls_Manager::REPEATER,
				'condition' => [
					'exad_pricing_table_enable_social_profiles!' => '',
				],
				'default' => [
					[
						'social' => 'fa fa-facebook',
					],
					[
						'social' => 'fa fa-twitter',
					],
					[
						'social' => 'fa fa-google-plus',
					],
					[
						'social' => 'fa fa-linkedin',
					],
				],
				'fields' => [
					[
						'name' => 'social',
						'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::ICON,
						'label_block' => true,
						'default' => 'fa fa-wordpress',
						'include' => [
							'fa fa-apple',
							'fa fa-behance',
							'fa fa-bitbucket',
							'fa fa-codepen',
							'fa fa-delicious',
							'fa fa-digg',
							'fa fa-dribbble',
							'fa fa-envelope',
							'fa fa-facebook',
							'fa fa-flickr',
							'fa fa-foursquare',
							'fa fa-github',
							'fa fa-google-plus',
							'fa fa-houzz',
							'fa fa-instagram',
							'fa fa-jsfiddle',
							'fa fa-linkedin',
							'fa fa-medium',
							'fa fa-pinterest',
							'fa fa-product-hunt',
							'fa fa-reddit',
							'fa fa-shopping-cart',
							'fa fa-slideshare',
							'fa fa-snapchat',
							'fa fa-soundcloud',
							'fa fa-spotify',
							'fa fa-stack-overflow',
							'fa fa-tripadvisor',
							'fa fa-tumblr',
							'fa fa-twitch',
							'fa fa-twitter',
							'fa fa-vimeo',
							'fa fa-vk',
							'fa fa-whatsapp',
							'fa fa-wordpress',
							'fa fa-xing',
							'fa fa-yelp',
							'fa fa-youtube',
						],
					],
					[
						'name' => 'link',
						'label' => esc_html__( 'Link', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'default' => [
							'url' => '',
							'is_external' => 'true',
						],
						'placeholder' => esc_html__( 'Place URL here', 'exclusive-addons-elementor' ),
					],
				],
				'title_field' => '<i class="{{ social }}"></i> {{{ social.replace( \'fa fa-\', \'\' ).replace( \'-\', \' \' ).replace( /\b\w/g, function( letter ){ return letter.toUpperCase() } ) }}}',
			]
		);
		$this->end_controls_section();
		/*
		* Team Members Styling Section
		*/
		$this->start_controls_section(
			'exad_section_pricing_tables_styles_general',
			[
				'label' => esc_html__( 'Team Member Styles', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'exad_pricing_table_preset',
			[
				'label' => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '-one',
				'options' => [
					'-one' => esc_html__( 'Style 1', 'exclusive-addons-elementor' ),
					'-two' => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
					'-three' => esc_html__( 'Style 3', 'exclusive-addons-elementor' ),
					'-six' => esc_html__( 'Style 4', 'exclusive-addons-elementor' ),
				],
			]
		);
		$this->add_control(
			'exad_pricing_tables_overlay_background',
			[
				'label' => esc_html__( 'Overlay Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(255,255,255,0.8)',
				'selectors' => [
					'{{WRAPPER}} .exad-team-members-circle .exad-team-content' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'exad_pricing_table_preset' => '-basic',
				],
			]
		);
		$this->add_control(
			'exad_pricing_tables_background',
			[
				'label' => esc_html__( 'Content Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .exad-team-item .exad-team-content' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
		
		/*
		* Team Member Image Styling
		*/
		$this->start_controls_section(
			'exad_section_pricing_tables_image_styles',
			[
				'label' => esc_html__( 'Team Member Image Style', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_responsive_control(
			'exad_pricing_tables_image_margin',
			[
				'label' => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-one .exad-team-member-one-thumb figure img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'exad_pricing_tables_image_padding',
			[
				'label' => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-one .exad-team-member-one-thumb figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'exad_pricing_tables_avatar_bg',
			[
				'label' => esc_html__( 'Avatar Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(255,255,255,0.8)',
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-circle-thumb svg.team-avatar-bg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'exad_pricing_table_preset' => '-circle',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_pricing_tables_image_border',
				'label' => esc_html__( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-member-one .exad-team-member-one-thumb figure img',
			]
		);
		$this->add_control(
			'exad_pricing_tables_image_rounded',
			[
				'label' => esc_html__( 'Rounded Avatar?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'circled',
				'default' => 'circled',
			]
		);
		$this->add_control(
			'exad_pricing_tables_image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-one .exad-team-member-one-thumb figure img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'condition' => [
					'exad_pricing_tables_image_rounded!' => '-circled',
				],
			]
		);
		$this->end_controls_section();
		
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$pricing_preset = $settings['exad_pricing_table_preset'];
		$pricing_table_image = $this->get_settings_for_display( 'exad_pricing_table_image' );
			$pricing_table_image_url = Group_Control_Image_Size::get_attachment_image_src( $pricing_table_image['id'], 'thumbnail', $settings );
		if( empty( $pricing_table_image_url ) ) : $pricing_table_image_url = $pricing_table_image['url']; else: $pricing_table_image_url = $pricing_table_image_url; endif;
		$pricing_table_classes = $this->get_settings_for_display('exad_pricing_tables_image_rounded');
	
		?>

		<div class="exad-pricing-table<?php echo esc_attr( $pricing_preset ); ?> purple">
          	<h4 class="exad-pricing-table-title">Standard Plan</h4>
          	<div class="exad-pricing-table-price">
          		<?php if ( $pricing_preset == '-one' ) : ?>
		            <svg xmlns="http://www.w3.org/2000/svg" width="186" height="186"><path fill-rule="evenodd" opacity=".659" d="M92.516.531c51.095 0 92.515 41.442 92.515 92.563s-41.42 92.562-92.515 92.562S0 144.215 0 93.094C0 41.973 41.421.531 92.516.531z"/></svg>
		            <svg xmlns="http://www.w3.org/2000/svg" width="186" height="186"><path fill-rule="evenodd" opacity=".659" d="M92.516.531c51.095 0 92.515 41.442 92.515 92.563s-41.42 92.562-92.515 92.562S0 144.215 0 93.094C0 41.973 41.421.531 92.516.531z"/></svg>
		            <svg xmlns="http://www.w3.org/2000/svg" width="186" height="186"><path fill-rule="evenodd" opacity=".659" d="M92.516.531c51.095 0 92.515 41.442 92.515 92.563s-41.42 92.562-92.515 92.562S0 144.215 0 93.094C0 41.973 41.421.531 92.516.531z"/></svg>
		        <?php endif; ?>
	            <p>$20<span>/mo</span></p>
          	</div>
          	<ul class="exad-pricing-table-features">
            	<li>
              		<svg xmlns="http://www.w3.org/2000/svg" width="14" height="11"><path fill-rule="evenodd" d="M.799 4.489L0 5.328l5.107 5.67L14 .721l-.701-.719-8.192 6.493L.799 4.489z"/></svg>
              		Responsive Live
            	</li>
            	<li>
              		<svg xmlns="http://www.w3.org/2000/svg" width="14" height="11"><path fill-rule="evenodd" d="M.799 4.489L0 5.328l5.107 5.67L14 .721l-.701-.719-8.192 6.493L.799 4.489z"/></svg>
              		Adaptive Bitrate
            	</li>
            	<li>
              		<svg xmlns="http://www.w3.org/2000/svg" width="14" height="11"><path fill-rule="evenodd" d="M.799 4.489L0 5.328l5.107 5.67L14 .721l-.701-.719-8.192 6.493L.799 4.489z"/></svg>
              		Analytics
            	</li>
            	<li class="exad-pricing-table-features-disable">
              		<svg xmlns="http://www.w3.org/2000/svg" width="14" height="11"><path fill-rule="evenodd" d="M.799 4.489L0 5.328l5.107 5.67L14 .721l-.701-.719-8.192 6.493L.799 4.489z"/></svg>
              		Creative Layouts
            	</li>
            	<li class="exad-pricing-table-features-disable">
              		<svg xmlns="http://www.w3.org/2000/svg" width="14" height="11"><path fill-rule="evenodd" d="M.799 4.489L0 5.328l5.107 5.67L14 .721l-.701-.719-8.192 6.493L.799 4.489z"/></svg>
              		Free Support
            	</li>
          	</ul>
          	<a href="#" class="exad-pricing-table-action">Get Started</a>
        </div>
		
	<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Pricing_Table() );