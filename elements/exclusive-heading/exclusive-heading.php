<?php
namespace Elementor;

class Exad_Heading extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-exclusive-heading';
	}
	public function get_title() {
		return esc_html__( 'Exclusive Heading', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-image-box';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	protected function _register_controls() {
		
		/**
		* Heading Content Section
		*/
		$this->start_controls_section(
			'exad_heading_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
			]
		);
		
		$this->add_control(
			'exad_heading_image',
			[
				'label' => __( 'Image', 'exclusive-addons-elementor' ),
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
					'exad_heading_image[url]!' => '',
				],
			]
		);

		$this->add_control(
			'exad_heading_title',
			[
				'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'default' => esc_html__( 'Heading Title', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_heading_title_link',
			[
				'label' => __( 'Title URL', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);
		
		$this->add_control(
			'exad_heading_tag',
			[
				'label' => esc_html__( 'Tag', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Heading Tag', 'exclusive-addons-elementor' ),
			]
		);
		
		$this->add_control(
			'exad_heading_description',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Basic description about the Heading', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_heading_action_text',
			[
				'label' => esc_html__( 'Action Text', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'default' => esc_html__( 'Details', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_heading_action_link',
			[
				'label' => __( 'Action URL', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		$this->end_controls_section();
		

		/*
		* Heading Styling Section
		*/
		$this->start_controls_section(
			'exad_section_heading_styles_preset',
			[
				'label' => esc_html__( 'Presets', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'exad_heading_preset',
			[
				'label' => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'one',
				'options' => [
					'one' => esc_html__( 'Style 1', 'exclusive-addons-elementor' ),
					'two' => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
					'three' => esc_html__( 'Style 3', 'exclusive-addons-elementor' ),
				],
			]
		);

		$this->add_control(
            'exad_heading_color_scheme',
            [
                'label' => __('Color Scheme', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#9059ff',
                'selectors' => [
                    '{{WRAPPER}} .exad-heading.two .exad-heading-action:hover, {{WRAPPER}} .exad-heading.two .exad-heading-title::before, {{WRAPPER}} .exad-heading.one .exad-heading-action:hover,
                    {{WRAPPER}} .exad-heading.one .exad-heading-title::before, {{WRAPPER}} .exad-heading.three .exad-heading-action:hover, {{WRAPPER}} .exad-heading.three .exad-heading-tag::before, {{WRAPPER}} .exad-heading.three::before' => 'background-color: {{VALUE}};',
                    
                ],
            ]
        );

		$this->add_control(
			'exad_heading_background',
			[
				'label' => esc_html__( 'Content Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .exad-heading-body' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


		/*
		* Heading Content Styling Section
		*/
		$this->start_controls_section(
			'exad_section_heading_styles_title',
			[
				'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'exad_title_color',
			[
					'label' => __('Color', 'exclusive-addons-elementor'),
					'type' => Controls_Manager::COLOR,
					'default' => '#132c47',
					'selectors' => [
							'{{WRAPPER}} .exad-heading-body .exad-heading-title' => 'color: {{VALUE}};',
					],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
					'name' => 'heading_title_typography',
					'selector' => '{{WRAPPER}} .exad-heading-body .exad-heading-title',
			]
		);

		$this->end_controls_section();

		// description style
		$this->start_controls_section(
			'exad_section_heading_styles_description',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'exad_description_color',
			[
					'label' => __('Color', 'exclusive-addons-elementor'),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
							'{{WRAPPER}} .exad-heading-body .exad-heading-description' => 'color: {{VALUE}};',
					],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
					'name' => 'heading_description_typography',
					'selector' => '{{WRAPPER}} .exad-heading-body .exad-heading-description',
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'exad_section_heading_styles_tag',
			[
				'label' => esc_html__( 'Tag', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'exad_heading_tag_color',
			[
					'label' => __('Color', 'exclusive-addons-elementor'),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
							'{{WRAPPER}} .exad-heading-body .exad-heading-tag' => 'color: {{VALUE}};',
					],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
					'name' => 'heading_tag_typography',
					'selector' => '{{WRAPPER}} .exad-heading-body .exad-heading-tag',
			]
		);

		$this->end_controls_section();

		
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$heading_image = $this->get_settings_for_display( 'exad_heading_image' );
		$heading_image_url_src = Group_Control_Image_Size::get_attachment_image_src( $heading_image['id'], 'thumbnail', $settings );
		if( empty( $heading_image_url_src ) ) {
			$heading_image_url = $heading_image['url'];
		} else {
			$heading_image_url = $heading_image_url_src;
		}	
	
		?>

        <div id="exad-heading-<?php echo esc_attr($this->get_id()); ?>" class="exad-exclusive-heading one">
          <div class="exad-exclusive-heading-wrapper">
            <h1 class="exad-exclusive-heading-title"><a href="<?php echo esc_url( $settings['exad_heading_title_link']['url'] ); ?>"><?php echo esc_html( $settings['exad_heading_title'] ); ?></a></h1>
            <p class="exad-exclusive-heading-description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Hic aut dolor error veritatis nulla impedit
              culpa officia ipsam temporibus ea adipisci voluptates asperiores minus dolorem, corrupti eum tenetur vero
              vitae harum amet. Excepturi praesentium rem nostrum dicta voluptas recusandae laborum harum? Modi
            </p>
          </div>
        </div>


	<?php
	}

	protected function _content_template() {
		?>
		<div id="exad-heading" class="exad-exclusive-heading one">
          <div class="exad-exclusive-heading-wrapper">
            <h1 class="exad-exclusive-heading-title"><a href="{{ settings.exad_heading_title_link.url }}">{{{ settings.exad_heading_title }}}</a></h1>
            <p class="exad-exclusive-heading-description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Hic aut dolor error veritatis nulla impedit
              culpa officia ipsam temporibus ea adipisci voluptates asperiores minus dolorem, corrupti eum tenetur vero
              vitae harum amet. Excepturi praesentium rem nostrum dicta voluptas recusandae laborum harum? Modi
            </p>
          </div>
        </div>
		<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Heading() );