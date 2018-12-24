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
		return [ 'jquery-slick', 'slick-theme' ];
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
				'label'     => esc_html__( 'Slides Per Column', 'exclusive-addons-elementor' ),
				'options'   => $slides_per_view,
				'default'   => '1',
				'condition' => [
					'skin' => 'carousel',
				]
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'exad_team_carousel_social',
			[
				'label' => esc_html__( 'Social Profiles', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_team_carousel_enable_social_profiles',
			[
				'label' => esc_html__( 'Display Social Profiles?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
		
		$this->add_control(
			'exad_team_carousel_social_profile_links',
			[
				'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'condition' => [
					'exad_team_carousel_enable_social_profiles!' => '',
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
			     	infinite: true,
			     	slidesToShow: 3,
			     	slidesToScroll: 3,
			      	arrows: false,
			      	dots: true
			    });
			    
			});
		</script>
		<?php 
	}

	

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$team_carousel_classes = $this->get_settings_for_display('exad_team_members_image_rounded');
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
	                  		<img src="<?php echo esc_url($team_carousel_image_url);?>" alt="team-image">
	                	</div>
	                	<h2 class="exad-team-member<?php echo $team_preset; ?>-name"><?php echo $member['exad_team_carousel_name']; ?></h2>
	                	<span class="exad-team-member<?php echo $team_preset; ?>-designation"><?php echo $member['exad_team_carousel_designation']; ?></span>
	                	<?php if ( ! empty( $settings['exad_team_carousel_enable_social_profiles'] ) ): ?>
						<ul class="list-inline exad-team-member<?php echo $team_preset; ?>-social">
							<?php foreach ( $settings['exad_team_carousel_social_profile_links'] as $item ) : ?>
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
      		<?php endforeach; ?>
		</div>	
	<?php	
	$this->render_script();	
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Team_Carousel() );