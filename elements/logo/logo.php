<?php
namespace Elementor;

class Exad_Logo extends Widget_Base {
	
	public function get_name() {
		return 'exad-logo';
	}
	public function get_title() {
		return esc_html__( 'Ex Logo Box', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-logo';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	protected function _register_controls() {
    /*
		* Logo Image
		*/
		$this->start_controls_section(
			'exad_section_logo_image',
			[
				'label' => esc_html__( 'Image', 'exclusive-addons-elementor' )
			]
    );
    
    $this->add_control(
			'exad_logo_img_or_icon',
			[
				'label' => esc_html__( 'Image or Icon', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'none' => [
						'title' => esc_html__( 'None', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-ban',
					],
					'icon' => [
						'title' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-info-circle',
					],
					'img' => [
						'title' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-picture-o',
					]
				],
				'default' => 'img',
			]
    );

    $this->add_control(
			'exad_logo_icon',
			[
				'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-tag',
				'condition' => [
					'exad_logo_img_or_icon' => 'icon'
				]
			]
		);
    
    $this->add_control(
			'exad_logo_image',
			[
				'label' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'exad_logo_img_or_icon' => 'img'
				]
			]
    );
    
    $this->end_controls_section();

    /*
		* Logo Style
    */
    
		$this->start_controls_section(
			'exad_section_logo_style',
			[
        'label' => esc_html__( 'Style', 'exclusive-addons-elementor' ),
        'tab' => Controls_Manager::TAB_STYLE
			]
    );
    $this->start_controls_tabs( 'exad_logo_tabs' );

		/*
		* Normal tab
    */
    $this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

    $this->add_control(
			'exad_logo_background',
			[
        'label' => __( 'Background Style', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::HEADING
			]
    );
    $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .exad-logo .exad-logo-item',
				'default' => '#FFFFFF',
			]
    );

    $this->add_control(
			'exad_logo_border',
			[
        'label' => __( 'Border Style', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::HEADING
			]
    );
    $this->add_group_control(
      Group_Control_Border::get_type(),
      [
        'name' => 'border',
        'label' => __('Border', 'exclusive-addons-elementor'),
        'selector' => '{{WRAPPER}} .exad-logo .exad-logo-item',
      ]
    );
    $this->add_control(
			'exad_logo_border_radius',
			[
				'label'                 => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
        'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .exad-logo .exad-logo-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
    );
    $this->add_control(
			'exad_logo_opacity_style',
			[
        'label' => __( 'Opacity', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::HEADING
			]
    );
    $this->add_control(
      'exad_logo_opacity',
      [
        'label' => __('Opacity', 'exclusive-addons-elementor'),
        'type' => Controls_Manager::NUMBER,
				'range' => [
          'min' => 0,
          'max' => 1
				],
        'selectors' => [
            '{{WRAPPER}} .exad-logo .exad-logo-item img' => 'opacity: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
			'exad_logo_shadow_style',
			[
        'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::HEADING
			]
    );
    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      [
        'name' => 'box_shadow',
        'label' => __('Box shadow', 'exclusive-addons-elementor'),
        'selector' => '{{WRAPPER}} .exad-logo .exad-logo-item'
      ]
    );

    $this->end_controls_tab();

		/*
		* Hover tab
    */
    $this->start_controls_tab( 'exad_exclusive_button_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );
    $this->add_control(
			'exad_logo_hover_background',
			[
        'label' => __( 'Background Style', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::HEADING
			]
    );
    $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_hover',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .exad-logo .exad-logo-item:hover',
				'default' => '#FFFFFF',
			]
    );

    $this->add_control(
			'exad_logo_hover_border',
			[
        'label' => __( 'Border Style', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::HEADING
			]
    );
    $this->add_group_control(
      Group_Control_Border::get_type(),
      [
        'name' => 'border_hover',
        'label' => __('Border', 'exclusive-addons-elementor'),
        'selector' => '{{WRAPPER}} .exad-logo .exad-logo-item:hover',
      ]
    );
    $this->add_control(
			'exad_logo_opacity_hover_style',
			[
        'label' => __( 'Opacity', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::HEADING
			]
    );
    $this->add_control(
      'exad_logo_hover_opacity',
      [
        'label' => __('Opacity', 'exclusive-addons-elementor'),
        'type' => Controls_Manager::NUMBER,
				'range' => [
          'min' => 0,
          'max' => 1
				],
        'selectors' => [
            '{{WRAPPER}} .exad-logo .exad-logo-item:hover img' => 'opacity: {{VALUE}};',
        ],
      ]
		);
		
		$this->add_control(
			'exad_logo_shadow_hover_style',
			[
        'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
        'type' => Controls_Manager::HEADING
			]
    );
    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      [
        'name' => 'box_hover_shadow',
        'label' => __('Box shadow', 'exclusive-addons-elementor'),
        'selector' => '{{WRAPPER}} .exad-logo .exad-logo-item:hover'
      ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();
	}
	protected function render() {
    $settings = $this->get_settings_for_display();
		
		$logo_image = $this->get_settings_for_display( 'exad_logo_image' );
		$logo_image_url = Group_Control_Image_Size::get_attachment_image_src( $logo_image['id'], 'thumbnail', $settings );

		if ( empty( $logo_image_url ) ) {
			$logo_image_url = $logo_image['url'];
		}  else {
			$logo_image_url = $logo_image_url;
		} 

    ?>
    
    <div id="exad-logo-<?php echo esc_attr($this->get_id()); ?>" class="exad-logo one">
      <div class="exad-logo-item">
        <?php if( 'img' == $settings['exad_logo_img_or_icon'] ) : ?>
          <img src="<?php echo esc_url( $logo_image_url ); ?>" alt="logo Image">
        <?php endif; ?>
        <?php if( 'icon' == $settings['exad_logo_img_or_icon'] ) : ?>
          <i class="<?php echo esc_attr( $settings['exad_logo_icon'] ); ?>"></i>
        <?php endif; ?>
      </div>
    </div>

    <?php
	}

	protected function _content_template() {
		?>
    
    <!-- <div id="exad-logo" class="exad-logo one">
      <div class="exad-logo-item">
        <# if( 'img' == settings.exad_logo_img_or_icon ) { #>
          <img src="{{{ settings.url }}}" alt="logo Image">
        <# } #>
        <# if( 'icon' == settings.exad_logo_img_or_icon ) { #>
          <i class="{{ settings.exad_logo_icon }}"></i>
        <# } #>
      </div>
    </div> -->

    <?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Logo() );