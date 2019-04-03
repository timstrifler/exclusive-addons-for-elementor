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
			'exad_heading_title',
			[
				'label' => esc_html__( 'Heading', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'default' => esc_html__( 'Heading Title', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_heading_title_link',
			[
				'label' => __( 'Heading URL', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'default' => [
					'url' => '#',
					'is_external' => true,
				],
			]
		);

		
		$this->add_control(
			'exad_heading_subheading',
			[
				'label' => esc_html__( 'Sub Heading', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Basic description about the Heading', 'exclusive-addons-elementor' ),
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
			'exad_heading_styles_preset',
			[
				'label' => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'parallax',
				'options' => [
					'parallax' => esc_html__( 'Image/Gradient', 'exclusive-addons-elementor' ),
					'separator' => esc_html__( 'With Separator', 'exclusive-addons-elementor' ),
                    'text-as-bg' => esc_html__( 'Text Background', 'exclusive-addons-elementor' ),
				],
			]
        );
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Title Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .exad-exclusive-heading.parallax .exad-exclusive-heading-wrapper .exad-exclusive-heading-title',
                'condition' => [
                    'exad_heading_styles_preset' => 'parallax'
                ]
			]
		);

        $this->add_responsive_control(
			'exad_heading_title_alignment',
			[
				'label' => esc_html__( 'Alignment', 'essential-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'essential-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'essential-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'essential-addons-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'selectors'             => [
                    '{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper .exad-exclusive-heading-title' => 'text-align: {{VALUE}};',
                ]
			]
		);

		$this->end_controls_section();


		/*
		* Heading Content Styling Section
		*/
		$this->start_controls_section(
			'exad_section_heading_styles_heading',
			[
				'label' => esc_html__( 'Heading', 'exclusive-addons-elementor' ),
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
							'{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper .exad-exclusive-heading-title a' => 'color: {{VALUE}};',
					],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
					'name' => 'heading_title_typography',
					'selector' => '{{WRAPPER}} .exad-exclusive-heading .exad-exclusive-heading-wrapper .exad-exclusive-heading-title',
			]
		);

		$this->end_controls_section();

		// description style
		$this->start_controls_section(
			'exad_section_heading_styles_subheading',
			[
				'label' => esc_html__( 'Sub Heading', 'exclusive-addons-elementor' ),
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
					'name' => 'heading_subheading_typography',
					'selector' => '{{WRAPPER}} .exad-heading-body .exad-heading-description',
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

        <div id="exad-heading-<?php echo esc_attr($this->get_id()); ?>" class="exad-exclusive-heading <?php echo esc_attr( $settings['exad_heading_styles_preset'] ); ?>">
          <div class="exad-exclusive-heading-wrapper">
            <h1 data-content="<?php echo esc_attr( $settings['exad_heading_title'] ); ?>" class="exad-exclusive-heading-title">
                <a href="<?php echo esc_url( $settings['exad_heading_title_link']['url'] ); ?>"><?php echo esc_html( $settings['exad_heading_title'] ); ?></a>
            </h1>
            <p class="exad-exclusive-heading-description"><?php echo esc_html( $settings['exad_heading_subheading'] ); ?></p>
          </div>
        </div>


	<?php
	}

	protected function _content_template() {
		?>
		<div id="exad-heading" class="exad-exclusive-heading {{ settings.exad_heading_styles_preset }}">
          <div class="exad-exclusive-heading-wrapper">
            <h1 class="exad-exclusive-heading-title">
                <a href="{{ settings.exad_heading_title_link.url }}">{{{ settings.exad_heading_title }}}</a>
            </h1>
            <p class="exad-exclusive-heading-description">{{{ settings.exad_heading_subheading }}}</p>
          </div>
        </div>
		<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Heading() );