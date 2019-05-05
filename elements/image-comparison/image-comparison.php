<?php
namespace Elementor;

class Exad_image_comparison extends Widget_Base {
	
	public function get_name() {
		return 'exad-image-comparison';
	}
	public function get_title() {
		return esc_html__( 'Image Comparison', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-image';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	protected function _register_controls() {
    /*
		* image Comparison
		*/
		$this->start_controls_section(
      'exad_section_comparison_image',
			[
				'label' => esc_html__( 'Image', 'exclusive-addons-elementor' )
			]
    );
    $this->add_control(
			'exad_comparison_image_one',
			[
				'label' => esc_html__( 'Image One', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
    );
    $this->add_control(
			'exad_comparison_image_two',
			[
				'label' => esc_html__( 'Image Two', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
    );
    $this->end_controls_section();

    /*
		* image Comparison Style
		*/
		$this->start_controls_section(
			'exad_section_image_comparision_styles_presets',
			[
				'label' => esc_html__( 'General Styles', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'exad_image_comparison_preset',
			[
				'label' => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'two',
				'options' => [
					'one' => esc_html__( 'Style 1', 'exclusive-addons-elementor' ),
					'two' => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
					'three' => esc_html__( 'Style 3', 'exclusive-addons-elementor' ),
				],
			]
		);
		$this->end_controls_section();
		/*
		* image Comparison Option Style
		*/
    $this->start_controls_section(
			'exad_section_image_comparision_style',
			[
        'label' => esc_html__( 'Comparison Option', 'exclusive-addons-elementor' ),
        'tab' => Controls_Manager::TAB_STYLE
			]
    );

    $this->add_control(
			'exad_no_overlay',
			[
				'label'                 => esc_html__( 'Image Comparison No Overlay', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::SWITCHER,
        'default'               => 'yes',
        'label_on'              => __( 'On', 'exclusive-addons-elementor' ),
        'label_off'             => __( 'Off', 'exclusive-addons-elementor' ),
        'return_value'          => 'yes',
			]
    );

    $this->add_control(
			'exad_oriantation',
			[
				'label'   => esc_html__( 'Image Comparison Overlay', 'exclusive-addons-elementor' ),
        'type'    => Controls_Manager::SELECT,
        'default' => 'horizontal',
        'options' => [
					'vertical'  => __( 'Vertical', 'exclusive-addons-elementor' ),
					'horizontal' => __( 'Horizontal', 'exclusive-addons-elementor' )
				],
			]
    );
    $this->add_control(
			'exad_default_offset_pct',
			[
				'label'                 => esc_html__( 'Image Comparison Overlay', 'exclusive-addons-elementor' ),
        'type'                  => Controls_Manager::SELECT,
        'default'                  => '0.5',
        'options' => [
          '0.1'  => __( '0.1', 'exclusive-addons-elementor' ),
					'0.2' => __( '0.2', 'exclusive-addons-elementor' ),
					'0.3' => __( '0.3', 'exclusive-addons-elementor' ),
					'0.4' => __( '0.4', 'exclusive-addons-elementor' ),
					'0.5' => __( '0.5', 'exclusive-addons-elementor' ),
					'0.6' => __( '0.6', 'exclusive-addons-elementor' ),
					'0.7' => __( '0.7', 'exclusive-addons-elementor' ),
					'0.8' => __( '0.8', 'exclusive-addons-elementor' ),
					'0.9' => __( '0.9', 'exclusive-addons-elementor' ),
					'1.0' => __( '1.0', 'exclusive-addons-elementor' ),
        ]
			]
		);
		
		$this->add_control(
			'exad_before_label',
			[
				'label'                 => esc_html__( 'Before Label Text', 'exclusive-addons-elementor' ),
        'type'                  => Controls_Manager::TEXT
			]
		);
		
		$this->add_control(
			'exad_after_label',
			[
				'label'                 => esc_html__( 'After Label Text', 'exclusive-addons-elementor' ),
        'type'                  => Controls_Manager::TEXT
			]
    );
    
    $this->end_controls_section();
	}
	protected function render() {

    $settings = $this->get_settings_for_display();
    $comparison_image_one = $this->get_settings_for_display( 'exad_comparison_image_one' );
    $comparison_image_two = $this->get_settings_for_display( 'exad_comparison_image_two' );
		$comparison_image_url_one_src = Group_Control_Image_Size::get_attachment_image_src( $comparison_image_one['id'], 'thumbnail', $settings );
		$comparison_image_url_two_src = Group_Control_Image_Size::get_attachment_image_src( $comparison_image_two['id'], 'thumbnail', $settings );
		$comparison_image_preset = $settings['exad_image_comparision_styles_preset'];

		if( empty( $comparison_image_url_one_src ) ) {
			$comparison_image_url_one = $comparison_image_one['url']; 
		} else { 
			$comparison_image_url_one = $comparison_image_url_one_src;
		}

		if( empty( $comparison_image_url_two_src ) ) {
			$comparison_image_url_two = $comparison_image_two['url']; 
		} else { 
			$comparison_image_url_two = $comparison_image_url_two_src;
		}
		
		$this->add_render_attribute( 'exad_image_comparison_wrapper', [
			'data-exad-oriantation' => esc_attr($settings['exad_oriantation']),
			'data-exad-before_label' => esc_attr( $settings['exad_before_label']),
			'data-exad-after_label'	=> esc_attr($settings['exad_after_label']),
			'data-exad-default_offset_pct' => esc_attr( $settings['exad_default_offset_pct'] ),
			'data-exad-no_overlay' => ( $settings['exad_no_overlay'] ? 'true': 'false')
		]);

    ?>
    <div id="exad-image-comparision-<?php echo esc_attr($this->get_id()); ?>" class="exad-image-comparision <?php echo esc_attr($settings['exad_image_comparison_preset']); ?>">
      <div class="exad-image-comparision-element" <?php echo $this->get_render_attribute_string('exad_image_comparison_wrapper'); ?> >
        <img src="<?php echo esc_url( $comparison_image_url_one ); ?>">
        <img src="<?php echo esc_url( $comparison_image_url_two ); ?>">
      </div>
    </div>
    <?php
	}

	protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_image_comparison() );