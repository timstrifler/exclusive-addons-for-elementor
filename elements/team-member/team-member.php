<?php
namespace Elementor;

class Exad_Team_Member extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-team-member';
	}
	public function get_title() {
		return esc_html__( 'DC Team Member', 'exclusive-addons' );
	}
	public function get_icon() {
		return 'fa fa-user-circle';
	}
	public function get_categories() {
		return [ 'exclusive-addons' ];
	}
	protected function _register_controls() {
		/*
		* Team Member Image
		*/
		$this->start_controls_section(
			'exad_section_team_member_image',
			[
				'label' => esc_html__( 'Team Member Image', 'exclusive-addons' )
			]
		);
		
		$this->add_control(
			'exad_team_member_image',
			[
				'label' => __( 'Team Member Avatar', 'exclusive-addons' ),
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
					'exad_team_member_image[url]!' => '',
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
				'label' => esc_html__( 'Team Member Information', 'exclusive-addons' ),
			]
		);
		
		$this->add_control(
			'exad_team_member_name',
			[
				'label' => esc_html__( 'Name', 'exclusive-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'John Doe', 'exclusive-addons' ),
			]
		);
		
		$this->add_control(
			'exad_team_member_designation',
			[
				'label' => esc_html__( 'Designation', 'exclusive-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'My Designation', 'exclusive-addons' ),
			]
		);
		
		$this->add_control(
			'exad_team_member_description',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Add team member details here', 'exclusive-addons' ),
			]
		);
		$this->end_controls_section();
		/*
		* Team member Social profiles section
		*/
		
		$this->start_controls_section(
			'exad_section_team_member_social_profiles',
			[
				'label' => esc_html__( 'Social Profiles', 'exclusive-addons' )
			]
		);
		$this->add_control(
			'exad_team_member_enable_social_profiles',
			[
				'label' => esc_html__( 'Display Social Profiles?', 'exclusive-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
		
		$this->add_control(
			'exad_team_member_social_profile_links',
			[
				'type' => Controls_Manager::REPEATER,
				'condition' => [
					'exad_team_member_enable_social_profiles!' => '',
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
						'label' => esc_html__( 'Icon', 'exclusive-addons' ),
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
						'label' => esc_html__( 'Link', 'exclusive-addons' ),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'default' => [
							'url' => '',
							'is_external' => 'true',
						],
						'placeholder' => esc_html__( 'Place URL here', 'exclusive-addons' ),
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
			'exad_section_team_members_styles_general',
			[
				'label' => esc_html__( 'Team Member Styles', 'exclusive-addons' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'exad_team_members_preset',
			[
				'label' => esc_html__( 'Style Preset', 'exclusive-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '-basic',
				'options' => [
					'-basic' => esc_html__( 'Basic', 'exclusive-addons' ),
					'-circle' => esc_html__( 'Circle Gradient', 'exclusive-addons' ),
					'-social-left' => esc_html__( 'Social Left on Hover', 'exclusive-addons' ),
					'-rounded' => esc_html__( 'Rounded', 'exclusive-addons' ),
					'-content-hover' => esc_html__( 'Content on Hover', 'exclusive-addons' ),
				],
			]
		);
		$this->add_control(
			'exad_team_members_overlay_background',
			[
				'label' => esc_html__( 'Overlay Color', 'exclusive-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(255,255,255,0.8)',
				'selectors' => [
					'{{WRAPPER}} .exad-team-members-circle .exad-team-content' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'exad_team_members_preset' => '-basic',
				],
			]
		);
		$this->add_control(
			'exad_team_members_background',
			[
				'label' => esc_html__( 'Content Background Color', 'exclusive-addons' ),
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
			'exad_section_team_members_image_styles',
			[
				'label' => esc_html__( 'Team Member Image Style', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		/*$this->add_responsive_control(
			'exad_team_members_image_width',
			[
				'label' => esc_html__( 'Image Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-one .exad-team-member-one-thumb figure img' => 'width:{{SIZE}}{{UNIT}};',
				],
			]
		); */
		$this->add_responsive_control(
			'exad_team_members_image_margin',
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
			'exad_team_members_image_padding',
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
			'exad_team_members_avatar_bg',
			[
				'label' => esc_html__( 'Avatar Background Color', 'exclusive-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(255,255,255,0.8)',
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-circle-thumb svg.team-avatar-bg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'exad_team_members_preset' => '-circle',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_team_members_image_border',
				'label' => esc_html__( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-member-one .exad-team-member-one-thumb figure img',
			]
		);
		$this->add_control(
			'exad_team_members_image_rounded',
			[
				'label' => esc_html__( 'Rounded Avatar?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'circled',
				'default' => 'circled',
			]
		);
		$this->add_control(
			'exad_team_members_image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-one .exad-team-member-one-thumb figure img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'condition' => [
					'exad_team_members_image_rounded!' => '-circled',
				],
			]
		);
		$this->end_controls_section();
		
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$team_member_image = $this->get_settings_for_display( 'exad_team_member_image' );
			$team_member_image_url = Group_Control_Image_Size::get_attachment_image_src( $team_member_image['id'], 'thumbnail', $settings );
		if( empty( $team_member_image_url ) ) : $team_member_image_url = $team_member_image['url']; else: $team_member_image_url = $team_member_image_url; endif;
		$team_member_classes = $this->get_settings_for_display('exad_team_members_image_rounded');
	
		?>
		<div id="exad-team-member-<?php echo esc_attr($this->get_id()); ?>" class="exad-team-item <?php echo $team_member_classes; ?>">
			<div class="exad-team-member<?php echo $settings['exad_team_members_preset']; ?>">
				<div class="exad-team-member<?php echo $settings['exad_team_members_preset']; ?>-thumb rounded">
					<?php if( $settings['exad_team_members_preset'] == '-circle' ) : ?>
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
					
						<img src="<?php echo esc_url($team_member_image_url);?>" class="<?php echo $team_member_classes; ?>" alt="<?php echo $settings['exad_team_member_name'];?>">
					
				</div>
				<div class="exad-team-member<?php echo $settings['exad_team_members_preset']; ?>-content">
					<h2 class="exad-team-member<?php echo $settings['exad_team_members_preset']; ?>-name"><?php echo $settings['exad_team_member_name']; ?></h2>
					<span class="exad-team-member<?php echo $settings['exad_team_members_preset']; ?>-designation"><?php echo $settings['exad_team_member_designation']; ?></span>
					<p class="exad-team-member<?php echo $settings['exad_team_members_preset']; ?>-about">
						<?php echo $settings['exad_team_member_description']; ?>
					</p>
					<?php if ( ! empty( $settings['exad_team_member_enable_social_profiles'] ) ): ?>
						<ul class="list-inline exad-team-member<?php echo $settings['exad_team_members_preset']; ?>-social">
							<?php foreach ( $settings['exad_team_member_social_profile_links'] as $item ) : ?>
							<?php if ( ! empty( $item['social'] ) ) : ?>
							<?php $target = $item['link']['is_external'] ? ' target="_blank"' : ''; ?>
							<li>
								<a href="<?php echo esc_attr( $item['link']['url'] ); ?>"<?php echo $target; ?>><i class="<?php echo esc_attr($item['social'] ); ?>"></i></a>
							</li>
							<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Team_Member() );