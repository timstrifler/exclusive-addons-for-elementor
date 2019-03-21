<?php
namespace Elementor;

class Exad_Infobox extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-infobox';
	}
	public function get_title() {
		return esc_html__( 'DC Info Box', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'fa fa-user-circle';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	protected function _register_controls() {
		/*
		* Infobox Image
		*/
		$this->start_controls_section(
			'exad_section_infobox_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
			]
		);
		
		$this->add_responsive_control(
			'exad_infobox_img_or_icon',
			[
				'label' => esc_html__( 'Image or Icon', 'essential-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'none' => [
						'title' => esc_html__( 'None', 'essential-addons-elementor' ),
						'icon' => 'fa fa-ban',
					],
					'icon' => [
						'title' => esc_html__( 'Icon', 'essential-addons-elementor' ),
						'icon' => 'fa fa-info-circle',
					],
					'img' => [
						'title' => esc_html__( 'Image', 'essential-addons-elementor' ),
						'icon' => 'fa fa-picture-o',
					]
				],
				'default' => 'icon',
			]
		);


		/**
		 * Condition: 'exad_infobox_img_or_icon' => 'img'
		 */
		$this->add_control(
			'exad_infobox_image',
			[
				'label' => esc_html__( 'Infobox Image', 'essential-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'exad_infobox_img_or_icon' => 'img'
				]
			]
		);


		/**
		 * Condition: 'exad_infobox_img_or_icon' => 'icon'
		 */
		$this->add_control(
			'exad_infobox_icon',
			[
				'label' => esc_html__( 'Icon', 'essential-addons-elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-tag',
				'condition' => [
					'exad_infobox_img_or_icon' => 'icon'
				]
			]
		);

		
		$this->add_control(
			'exad_infobox_title',
			[
				'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Infobox Title', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_infobox_title_link',
			[
				'label' => __( 'Title URL', 'plugin-domain' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);
		
		$this->add_control(
			'exad_infobox_description',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Basic description about the Infobox', 'exclusive-addons-elementor' ),
			]
		);

		$this->end_controls_section();
		

		/*
		* Infobox Styling Section
		*/
		$this->start_controls_section(
			'exad_section_infobox_styles_preset',
			[
				'label' => esc_html__( 'Presets', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'exad_infobox_preset',
			[
				'label' => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'one',
				'options' => [
					'one' => esc_html__( 'Style 1', 'exclusive-addons-elementor' ),
					'two' => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
					'three' => esc_html__( 'Style 3', 'exclusive-addons-elementor' ),
					'four' => esc_html__( 'Style 4', 'exclusive-addons-elementor' ),
					'five' => esc_html__( 'Style 5', 'exclusive-addons-elementor' ),
				],
			]
		);

		$this->add_control(
            'exad_infobox_color_scheme',
            [
                'label' => __('Icon Color Scheme', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#5480ff',
                'selectors' => [
                    '{{WRAPPER}} .exad-infobox.one .exad-infobox-icon::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .exad-infobox.one .exad-infobox-icon i, {{WRAPPER}} .exad-infobox.two .exad-infobox-item:hover .exad-infobox-icon i, {{WRAPPER}} .exad-infobox.three .exad-infobox-item .exad-infobox-icon i, {{WRAPPER}} .exad-infobox.four .exad-infobox-item:hover .exad-infobox-icon i, {{WRAPPER}} .exad-infobox.five .exad-infobox-item:hover .exad-infobox-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .exad-infobox.one .exad-infobox-item:hover .exad-infobox-icon i' => 'color: #FFF',
                    '{{WRAPPER}} .exad-infobox.two .exad-infobox-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .exad-infobox.two .exad-infobox-item:hover .exad-infobox-icon, {{WRAPPER}} .exad-infobox.four .exad-infobox-item:hover .exad-infobox-icon, {{WRAPPER}} .exad-infobox.five .exad-infobox-item:hover .exad-infobox-icon' => 'background: #FFF; border: 1px solid {{VALUE}};',
					'{{WRAPPER}} .exad-infobox.three .exad-infobox-item:hover .exad-infobox-icon i' => 'color: #FFF',  /*new added line */
                    '{{WRAPPER}} .exad-infobox.four .exad-infobox-icon, {{WRAPPER}} .exad-infobox.five .exad-infobox-icon' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .exad-infobox.five .exad-infobox-item' => 'border-bottom: 3px solid {{VALUE}};',

                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient' ],
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .exad-infobox .exad-infobox-item',
				'default' => '#FFFFFF',
			]
		);

		
		$this->end_controls_section();

		// Title , Description Font Color and Typography

		$this->start_controls_section(
            'section_infobox_title',
            [
                'label' => __('Title', 'exclusive-addons-elementor'),
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
                    '{{WRAPPER}} .exad-infobox-content-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'infobox_title_typography',
                'selector' => '{{WRAPPER}} .exad-infobox-content-title',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_infobox_description',
            [
                'label' => __('Description', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'exad_description_color',
            [
                'label' => __('Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#797c80',
                'selectors' => [
                    '{{WRAPPER}} .exad-infobox-content-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'exad_description_typography',
                'selector' => '{{WRAPPER}} .exad-infobox-content-description',
            ]
        );

        $this->end_controls_section();
		
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$infobox_image = $this->get_settings_for_display( 'exad_infobox_image' );
		$infobox_image_url = Group_Control_Image_Size::get_attachment_image_src( $infobox_image['id'], 'thumbnail', $settings );

		if ( empty( $infobox_image_url ) ) {
			$infobox_image_url = $infobox_image['url'];
		}  else {
			$infobox_image_url = $infobox_image_url;
		} 

		?>

		<div id="exad-infobox-<?php echo esc_attr($this->get_id()); ?>" class="exad-infobox <?php echo esc_attr($settings['exad_infobox_preset']); ?>">
          	<div class="exad-infobox-item">
	            <div class="exad-infobox-icon">

	            	<?php if( 'icon' == $settings['exad_infobox_img_or_icon'] ) : ?>
						<i class="<?php echo esc_attr( $settings['exad_infobox_icon'] ); ?>"></i>
					<?php endif; ?>

	            	<?php if( 'img' == $settings['exad_infobox_img_or_icon'] ) : ?>
						<img src="<?php echo esc_url( $infobox_image_url ); ?>" alt="Icon Image">
					<?php endif; ?>
					
	            </div>
	            <div class="exad-infobox-content">
	            	<h3 class="exad-infobox-content-title"><?php echo $settings['exad_infobox_title']; ?></h3>
	              	<p class="exad-infobox-content-description">
	   					<?php echo $settings['exad_infobox_description']; ?>
	              	</p>
	            </div>
          	</div>
        </div>

	<?php
	}

	protected function _content_template() {
		?>
		<div id="exad-infobox" class="exad-infobox {{ settings.exad_infobox_preset }}">
          	<div class="exad-infobox-item">
	            <div class="exad-infobox-icon">

	            	<# if( 'icon' == settings.exad_infobox_img_or_icon ) { #>
						<i class="{{{ settings.exad_infobox_icon }}}"></i>
					<# } #>

	            	<# if( 'img' == settings.exad_infobox_img_or_icon ) { #>
						<img src="{{{ settings.exad_infobox_image.url }}}" alt="Icon Image">
					<# } #>
					
	            </div>
	            <div class="exad-infobox-content">
	            	<h3 class="exad-infobox-content-title">{{{ settings.exad_infobox_title }}}</h3>
	              	<p class="exad-infobox-content-description">{{{ settings.exad_infobox_description }}}
	              	</p>
	            </div>
          	</div>
        </div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Infobox() );