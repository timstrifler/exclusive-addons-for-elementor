<?php
namespace Elementor;

class Exad_Card extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-card';
	}
	public function get_title() {
		return esc_html__( 'DC Card', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'fa fa-user-circle';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	protected function _register_controls() {
		
		/**
		* Card Content Section
		*/
		$this->start_controls_section(
			'exad_card_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
			]
		);
		
		$this->add_control(
			'exad_card_image',
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
				'name' => 'card_thumbnail',
				'default' => 'full',
				'condition' => [
					'exad_card_image[url]!' => '',
				],
			]
		);

		$this->add_control(
			'exad_card_title',
			[
				'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'default' => esc_html__( 'Card Title', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_card_title_link',
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
			'exad_card_tag',
			[
				'label' => esc_html__( 'Tag', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Card Tag', 'exclusive-addons-elementor' ),
			]
		);
		
		$this->add_control(
			'exad_card_description',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Basic description about the Card', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_card_action_text',
			[
				'label' => esc_html__( 'Action Text', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'default' => esc_html__( 'Details', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_card_action_link',
			[
				'label' => __( 'Action URL', 'plugin-domain' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		$this->end_controls_section();
		

		/*
		* Card Styling Section
		*/
		$this->start_controls_section(
			'exad_section_card_styles_preset',
			[
				'label' => esc_html__( 'Presets', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'exad_card_preset',
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

		$this->end_controls_section();
		
		/* 
		* Card Color Scheme
		*/
		$this->start_controls_section(
			'exad_section_card_color_schemes',
			[
				'label' => esc_html__( 'Color Scheme', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
            'exad_card_color_scheme',
            [
                'label' => __('Color Scheme', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#9059ff',
                'selectors' => [
                    '{{WRAPPER}} .exad-card.two .exad-card-action:hover, {{WRAPPER}} .exad-card.two .exad-card-title::before, {{WRAPPER}} .exad-card.one .exad-card-action:hover,
                    {{WRAPPER}} .exad-card.one .exad-card-title::before, {{WRAPPER}} .exad-card.three .exad-card-action:hover, {{WRAPPER}} .exad-card.three .exad-card-tag::before, {{WRAPPER}} .exad-card.three::before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .exad-card.three .exad-card-body .exad-card-tag' => 'color: {{VALUE}};'
                ],
            ]
        );

		$this->add_control(
			'exad_card_background',
			[
				'label' => esc_html__( 'Content Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .exad-card-item .exad-card-content' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$card_image = $this->get_settings_for_display( 'exad_card_image' );
		$card_image_url_src = Group_Control_Image_Size::get_attachment_image_src( $card_image['id'], 'full', $settings );
		if( empty( $card_image_url_src ) ) {
			$card_image_url = $card_image['url'];
		} else {
			$card_image_url = $card_image_url_src;
		}	
	
		?>

		<div id="exad-card-<?php echo esc_attr($this->get_id()); ?>" class="exad-card <?php echo esc_attr($settings['exad_card_preset']); ?>">
        	<div class="exad-card-thumb">
            	<img src="<?php echo esc_url($card_image_url); ?>" alt="<?php echo $settings['exad_card_title']; ?>">
          	</div>
          	<div class="exad-card-body">
            	<a href="<?php echo esc_url( $settings['exad_card_title_link']['url'] ); ?>" class="exad-card-title"><?php echo $settings['exad_card_title']; ?></a>
            	<p class="exad-card-tag"><?php echo $settings['exad_card_tag']; ?></p>
            	<p class="exad-card-description">
              		<?php echo $settings['exad_card_description']; ?>
            	</p>
            	<a href="<?php echo esc_url( $settings['exad_card_action_link']['url'] ); ?>" class="exad-card-action">
            		<?php if ( 'two' === $settings['exad_card_preset'] ) { ?>
            			<i class="fa fa-arrow-right" aria-hidden="true"></i>
            		<?php } else {
            			echo $settings['exad_card_action_text'];
            		}	
            		?>
            	</a>
          	</div>
        </div>

	<?php
	}

	protected function _content_template() {
		?>
		<div id="exad-card" class="exad-card {{ settings.exad_card_preset }}">
        	<div class="exad-card-thumb">
            	<img src="{{ settings.exad_card_image.url }}" >
          	</div>
          	<div class="exad-card-body">
            	<a href="{{ settings.exad_card_title_link.url }}" class="exad-card-title">{{{ settings.exad_card_title }}}</a>
            	<p class="exad-card-tag">{{{ settings.exad_card_tag }}}</p>
            	<p class="exad-card-description">{{{ settings.exad_card_description }}}</p>
            	<a href="{{ settings.exad_card_action_link.url ); ?>" class="exad-card-action">
            		<# if ( 'two' == settings.exad_card_preset ) {
						#><i class="fa fa-arrow-right" aria-hidden="true"></i>
            		<# } else { #>
            			{{{ settings.exad_card_action_text }}} <#
            		} #>
            	</a>
          	</div>
        </div>
		<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Card() );