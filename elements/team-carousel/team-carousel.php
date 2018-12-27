<?php
namespace Elementor;

/*use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Embed;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Utils; 
use Elementor\Repeater;*/

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
		return 'fa fa-user-circle';
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
				'label' => __( 'Team Member Avatar', 'exclusive-addons-elementor' ),
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
				'default' => esc_html__( 'John Doe', 'exclusive-addons-elementor' ),
			]
		);
		
		$team_repeater->add_control(
			'exad_team_carousel_designation',
			[
				'label' => esc_html__( 'Designation', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
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
				//'default' => $this->get_repeater_defaults(),
			]
		);



		$slides_per_view = range( 1, 10 );
		$slides_per_view = array_combine( $slides_per_view, $slides_per_view );

		$this->add_responsive_control(
			'team_carousel_per_view',
			[
				'type'           => Controls_Manager::SELECT,
				'label'          => esc_html__( 'Members Per Row', 'exclusive-addons-elementor' ),
				'options'        => $slides_per_view,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
			]
		);

		$this->add_control(
			'slides_per_column',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Members Per Column', 'exclusive-addons-elementor' ),
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
				'label' => esc_html__( 'Team Carousel Styles', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'exad_team_carousel_preset',
			[
				'label' => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '-basic',
				'options' => [
					'-basic' => esc_html__( 'Basic', 'exclusive-addons-elementor' ),
					'-circle' => esc_html__( 'Circle Gradient', 'exclusive-addons-elementor' ),
					'-social-left' => esc_html__( 'Social Left on Hover', 'exclusive-addons-elementor' ),
					'-rounded' => esc_html__( 'Rounded', 'exclusive-addons-elementor' ),
					'-content-hover' => esc_html__( 'Content on Hover', 'exclusive-addons-elementor' ),
				],
			]
		);

		$this->add_control(
			'exad_team_carousel_avatar_bg',
			[
				'label' => esc_html__( 'Avatar Background Color', 'exclusive-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(255,255,255,0.8)',
				'selectors' => [
					'{{WRAPPER}} .exad-team-member-circle-thumb svg.team-avatar-bg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'exad_team_carousel_preset' => '-circle',
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
			'exad_team_carousel_image_rounded',
			[
				'label' => esc_html__( 'Rounded Avatar?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'circled',
				'default' => 'circled',
			]
		);
		$this->add_control(
			'exad_team_carousel_image_border_radius',
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

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => esc_html__( 'Transition Duration', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'     => esc_html__( 'Autoplay', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label'   => esc_html__( 'Infinite Loop', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'pause_on_interaction',
			[
				'label'     => esc_html__( 'Pause on Interaction', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->end_controls_section();

	}

	

	protected function render_script() {
		$settings = $this->get_settings_for_display();

		?>
		<script>
			jQuery(document).ready(function($) {
			    "use strict";

			    // Team Carousel Two
			    $(".exad-team-carousel<?php echo $settings['exad_team_carousel_preset']; ?>").slick({
			    	autoplay: true,
			     	infinite: true,
			     	slidesToShow: <?php echo $settings['team_carousel_per_view']; ?>,
			     	slidesToScroll: 3,
			      	arrows: false,
			      	dots: true,
			      	//prevArrow: "<div class='exad-team-carousel-four-prev'><i class='fa fa-angle-left'></i></div>",
      				//nextArrow: "<div class='exad-team-carousel-four-next'><i class='fa fa-angle-right'></i></div>"
			    });
			    
			});
		</script>
		<?php 
	}

	

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$team_carousel_classes = $this->get_settings_for_display('exad_team_carousel_image_rounded');
		$team_preset = $settings['exad_team_carousel_preset'];
	?>	
		<div class="exad-team-carousel<?php echo $team_preset; ?>">
			<?php foreach ( $settings['team_carousel_repeater'] as $key => $member ) : 

			$team_carousel_image = $member['exad_team_carousel_image'];
			$team_carousel_image_url = Group_Control_Image_Size::get_attachment_image_src( $team_carousel_image['id'], 'thumbnail', $member );
			if( empty( $team_carousel_image_url ) ) : $team_carousel_image_url = $team_carousel_image['url']; else: $team_carousel_image_url = $team_carousel_image_url; endif;

				?>	
				<div class="exad-team-carousel<?php echo $team_preset; ?>-inner">
	            	<div class="exad-team-member<?php echo $team_preset; ?>">
	                	<div class="exad-team-member<?php echo $team_preset; ?>-thumb">
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
	                  		<img src="<?php echo esc_url($team_carousel_image_url);?>" class="<?php echo $team_carousel_classes; ?>" alt="team-image">
	                	</div>
	                	<div class="exad-team-member<?php echo $team_preset; ?>-content">
		                	<h2 class="exad-team-member<?php echo $team_preset; ?>-name"><?php echo $member['exad_team_carousel_name']; ?></h2>
		                	<span class="exad-team-member<?php echo $team_preset; ?>-designation"><?php echo $member['exad_team_carousel_designation']; ?></span>
		                	<?php if ( ! empty( $member['exad_team_carousel_enable_social_profiles'] ) ): ?>
							<ul class="list-inline exad-team-member<?php echo $team_preset; ?>-social">
								
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
	$this->render_script();	
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Team_Carousel() );