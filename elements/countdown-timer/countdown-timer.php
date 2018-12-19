<?php
namespace Elementor;

class Exad_Countdown_Timer extends Widget_Base {
	
	//use ElementsCommonFunctions;

	public function get_name() {
		return 'exad-countdown-timer';
	}

	public function get_title() {
		return esc_html__( 'DC Countdown Timer', 'exclusive-addons' );
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
				'default' => 'exad-team-members-simple',
				'options' => [
					'exad-team-members-simple' 		=> esc_html__( 'Simple Style', 		'exclusive-addons' ),
					'exad-team-members-overlay' 	=> esc_html__( 'Overlay Style', 	'exclusive-addons' ),
					'exad-team-members-social-left-hover' 	=> esc_html__( 'Centered Style', 	'exclusive-addons' ),
					'exad-team-members-rounded' 		=> esc_html__( 'Circle Style', 	'exclusive-addons' ),
					'exad-team-members-pro-style-5' => esc_html__( 'Social on Bottom', 	'exclusive-addons' ),
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
					'{{WRAPPER}} .exad-team-members-overlay .exad-team-content' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'exad_team_members_preset' => 'exad-team-members-overlay',
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

		$this->add_responsive_control(
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
					'{{WRAPPER}} .exad-team-item figure img' => 'width:{{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'exad_team_members_image_margin',
			[
				'label' => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .exad-team-item figure img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .exad-team-item figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_team_members_bg_svg',
			[
				'label' => esc_html__( 'Avatar Background Color', 'exclusive-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(255,255,255,0.8)',
				'selectors' => [
					'{{WRAPPER}} .exad-team-image svg.exad-member-img-bg g' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'exad_team_members_preset' => 'exad-team-members-rounded',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_team_members_image_border',
				'label' => esc_html__( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-team-item figure img',
			]
		);

		$this->add_control(
			'exad_team_members_image_rounded',
			[
				'label' => esc_html__( 'Rounded Avatar?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'team-avatar-rounded',
				'default' => '',
			]
		);


		$this->add_control(
			'exad_team_members_image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .exad-team-item figure img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'condition' => [
					'exad_team_members_image_rounded!' => 'team-avatar-rounded',
				],
			]
		);

		$this->end_controls_section();

		 

	}

	protected function render() {

		$settings = $this->get_settings();
      	$team_member_image = $this->get_settings( 'exad_team_member_image' );
	  	$team_member_image_url = Group_Control_Image_Size::get_attachment_image_src( $team_member_image['id'], 'thumbnail', $settings );	
	  	if( empty( $team_member_image_url ) ) : $team_member_image_url = $team_member_image['url']; else: $team_member_image_url = $team_member_image_url; endif;
	  	$team_member_classes = $this->get_settings('exad_team_members_preset') . " " . $this->get_settings('exad_team_members_image_rounded');
	
	?>


	<div id="exad-team-member-<?php echo esc_attr($this->get_id()); ?>" class="exad-team-item <?php echo $team_member_classes; ?>">
		<div class="exad-team-item-inner">
			<div class="exad-team-image">
				<svg class="exad-member-img-bg" width="112px" height="109px" viewBox="0 0 112 109" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" opacity="0.568475632">
				        <g id="Artboard" transform="translate(-625.000000, -92.000000)" fill="#000" fill-rule="nonzero">
				            <g id="Group" transform="translate(606.000000, 71.000000)">
				                <ellipse id="Oval-Copy-3" cx="75" cy="76" rx="56" ry="51"></ellipse>
				                <ellipse id="Oval-Copy-4" cx="75" cy="76" rx="45" ry="51"></ellipse>
				                <ellipse id="Oval-Copy-5" transform="translate(75.064373, 75.680657) rotate(-50.000000) translate(-75.064373, -75.680657) " cx="75.0643727" cy="75.6806569" rx="56" ry="51"></ellipse>
				            </g>
				        </g>
				    </g>
				</svg>
				<div class="exad-team-img-wrapper">
					<figure>
						<img src="<?php echo esc_url($team_member_image_url);?>" alt="<?php echo $settings['exad_team_member_name'];?>">
					</figure>
				</div>
			</div>

			<div class="exad-team-content">
				<h3 class="exad-team-member-name"><?php echo $settings['exad_team_member_name']; ?></h3>
				<p class="exad-team-member-designation"><?php echo $settings['exad_team_member_designation']; ?></p>

				<?php if ( ! empty( $settings['exad_team_member_enable_social_profiles'] ) ): ?>
				<ul class="exad-team-member-social-profiles">
					<?php foreach ( $settings['exad_team_member_social_profile_links'] as $item ) : ?>
						<?php if ( ! empty( $item['social'] ) ) : ?>
							<?php $target = $item['link']['is_external'] ? ' target="_blank"' : ''; ?>
							<li class="exad-team-member-social-link">
								<a href="<?php echo esc_attr( $item['link']['url'] ); ?>"<?php echo $target; ?>><i class="<?php echo esc_attr($item['social'] ); ?>"></i></a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>

				<!--<p class="exad-team-text"><?php echo $settings['exad_team_member_description']; ?></p>-->
			</div>
		</div>
	</div>

<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Countdown_Timer() );
