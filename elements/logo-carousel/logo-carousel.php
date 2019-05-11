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
		$this->add_control(
			'exad_logo_carousel_image',
			[
				'label' => esc_html__( 'Logo Carousel', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
						'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

    $this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();

		// $this->add_render_attribute( 
		// 	'exad-team-carousel', 
		// 	[ 
		// 		'class' => [ 'exad-team-carousel-wrapper', 'exad-team-carousel' . $team_preset ],
		// 		'data-team-preset' => $team_preset,
		// 		'data-carousel-nav' => $settings['exad_team_carousel_nav'],
		// 		'data-slidestoshow' => $settings['exad_team_per_view'],
		// 		'data-slidestoscroll' => $settings['exad_team_slides_to_scroll'],
	  //   		'data-speed' => $settings['exad_team_transition_duration'],
		// 	]
		// );
		
		$logo_image = $this->get_settings_for_display( 'exad_logo_carousel_image' );
		$logo_image_url = Group_Control_Image_Size::get_attachment_image_src( $logo_image['id'], 'thumbnail', $settings );

		if ( empty( $logo_image_url ) ) {
			$logo_image_url = $logo_image['url'];
		}  else {
			$logo_image_url = $logo_image_url;
    }

    ?>
        <div id="exad-logo-<?php echo esc_attr($this->get_id()); ?>" class="exad-logo-carousel-wrapper">
					<div class="exad-logo-carousel-item">
						<?php if( ! empty( $settings['exad_logo_carousel_image'] ) ) { ?>
							<img src="<?php echo esc_url( $logo_image_url ); ?>">
						<?php } ?>
					</div>
					<div class="exad-logo-carousel-item">
						<?php if( ! empty( $settings['exad_logo_carousel_image'] ) ) { ?>
							<img src="<?php echo esc_url( $logo_image_url ); ?>">
						<?php } ?>
					</div>
					<div class="exad-logo-carousel-item">
						<?php if( ! empty( $settings['exad_logo_carousel_image'] ) ) { ?>
							<img src="<?php echo esc_url( $logo_image_url ); ?>">
						<?php } ?>
					</div>
					<div class="exad-logo-carousel-item">
						<?php if( ! empty( $settings['exad_logo_carousel_image'] ) ) { ?>
							<img src="<?php echo esc_url( $logo_image_url ); ?>">
						<?php } ?>
					</div>
        </div>

    <?php
	}

	protected function _content_template() {
  }
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Logo_Carousel() );