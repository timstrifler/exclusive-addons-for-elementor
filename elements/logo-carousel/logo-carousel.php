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

	$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 
			'exad_logo_carousel', 
			[ 
				'data-carousel-nav' => $settings['exad_logo_carousel_nav'],
				'data-slidestoshow' => esc_attr( $settings['exad_logo_slide_to_show']),
				// 'data-slidestoscroll' => $settings['exad_team_slides_to_scroll'],
	    		// 'data-speed' => $settings['exad_team_transition_duration'],
			]
		);
		
		

	?>
		<div id="exad-logo-carousel<?php echo esc_attr($this->get_id()); ?>" class="exad-logo-carousel six">
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