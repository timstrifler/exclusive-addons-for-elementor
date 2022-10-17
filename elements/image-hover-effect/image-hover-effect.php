<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Widget_Base;
use \Elementor\Utils;
use \ExclusiveAddons\Elementor\Helper;


class Image_Hover_Effect extends Widget_Base {
  
    public function get_name() {
        return 'exad-image-hover-effect';
    }

    public function get_title() {
        return esc_html__( 'Image Hover Effect', 'exclusive-addons-elementor' );
    }

    public function get_icon() {
        return 'exad-logo icon-Image-Hover';
    }

    public function get_categories() {
        return [ 'exclusive-addons-elementor' ];
    }

    public function get_keywords() {
        return [ 'exclusive', 'image', 'hover' ];
    }

    protected function register_controls() {
        $exad_primary_color   = get_option( 'exad_primary_color_option', '#7a56ff' );
        $exad_secondary_color = get_option( 'exad_secondary_color_option', '#00d8d8' );
        
        /**
         * Image Hover Content Tab
         */
        $this->start_controls_section(
            'exad_ihe_content',
            [
              'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
			'exad_ihe_hover_style',
			[
				'label' => esc_html__( 'Hover Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => [
					'style_1'  => esc_html__( 'Style 1', 'exclusive-addons-elementor' ),
					'style_2'  => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
				],
			]
		);

        $this->add_control(
			'exad_ihe_effect',
			[
				'label' => esc_html__( 'Hover Effect', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'lily',
				'options' => [
					'lily'  => esc_html__( 'Lily', 'exclusive-addons-elementor' ),
					'sadie'  => esc_html__( 'Sadie', 'exclusive-addons-elementor' ),
					'honey'  => esc_html__( 'Honey', 'exclusive-addons-elementor' ),
					'layla'  => esc_html__( 'Layla', 'exclusive-addons-elementor' ),
					'zoe'  => esc_html__( 'Zoe', 'exclusive-addons-elementor' ),
					'oscar'  => esc_html__( 'Oscar', 'exclusive-addons-elementor' ),
					'marley'  => esc_html__( 'Marley', 'exclusive-addons-elementor' ),
					'ruby'  => esc_html__( 'Ruby', 'exclusive-addons-elementor' ),
					'roxy'  => esc_html__( 'Roxy', 'exclusive-addons-elementor' ),
					'bubba'  => esc_html__( 'Bubba', 'exclusive-addons-elementor' ),
					'romeo'  => esc_html__( 'Romeo', 'exclusive-addons-elementor' ),
					'dexter'  => esc_html__( 'Dexter', 'exclusive-addons-elementor' ),
					'sarah'  => esc_html__( 'Sarah', 'exclusive-addons-elementor' ),
					'chico'  => esc_html__( 'Chico', 'exclusive-addons-elementor' ),
					'milo'  => esc_html__( 'Milo', 'exclusive-addons-elementor' ),
					'julia'  => esc_html__( 'Julia', 'exclusive-addons-elementor' ),
					'goliath'  => esc_html__( 'Goliath', 'exclusive-addons-elementor' ),
					'hera'  => esc_html__( 'Hera', 'exclusive-addons-elementor' ),
					'winston'  => esc_html__( 'Winston', 'exclusive-addons-elementor' ),
					'selena'  => esc_html__( 'Selena', 'exclusive-addons-elementor' ),
					'terry'  => esc_html__( 'Terry', 'exclusive-addons-elementor' ),
					'phoebe'  => esc_html__( 'Phoebe', 'exclusive-addons-elementor' ),
					'apollo'  => esc_html__( 'Apollo', 'exclusive-addons-elementor' ),
					'kira'  => esc_html__( 'Kira', 'exclusive-addons-elementor' ),
					'steve'  => esc_html__( 'Steve', 'exclusive-addons-elementor' ),
					'moses'  => esc_html__( 'Moses', 'exclusive-addons-elementor' ),
					'jazz'  => esc_html__( 'Jazz', 'exclusive-addons-elementor' ),
					'lexi'  => esc_html__( 'Lexi', 'exclusive-addons-elementor' ),
					'duke'  => esc_html__( 'Duke', 'exclusive-addons-elementor' ),
				],
                'condition' => [
                    'exad_ihe_hover_style' => 'style_1'
                ]
			]
		);

        $this->add_control(
			'exad_ihe_hover_effect_2',
			[
				'label' => esc_html__( 'Hover Effect', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'imghvr-fade',
				'options' => [
					'imghvr-fade'  => esc_html__( 'Fade Effect', 'exclusive-addons-elementor' ),
					'imghvr-push-up'  => esc_html__( 'Push Up Effect', 'exclusive-addons-elementor' ),
					'imghvr-push-down'  => esc_html__( 'Push Down Effect', 'exclusive-addons-elementor' ),
					'imghvr-push-left'  => esc_html__( 'Push Left Effect', 'exclusive-addons-elementor' ),
					'imghvr-slide-up'  => esc_html__( 'Slide Up Effect', 'exclusive-addons-elementor' ),
					'imghvr-slide-down'  => esc_html__( 'Slide Down Effect', 'exclusive-addons-elementor' ),
					'imghvr-reveal-up'  => esc_html__( 'Reveal Up Effect', 'exclusive-addons-elementor' ),
					'imghvr-reveal-down'  => esc_html__( 'Reveal Down Effect', 'exclusive-addons-elementor' ),
					'imghvr-hinge-up'  => esc_html__( 'Hinge Up Effect', 'exclusive-addons-elementor' ),
					'imghvr-hinge-down'  => esc_html__( 'Hinge Down Effect', 'exclusive-addons-elementor' ),
					'imghvr-blur'  => esc_html__( 'Blur Effect', 'exclusive-addons-elementor' ),
					'imghvr-blur'  => esc_html__( 'Blur Effect', 'exclusive-addons-elementor' ),
				],
                'condition' => [
                    'exad_ihe_hover_style' => 'style_2'
                ]
			]
		);

        $this->add_control(
			'exad_ihe_image',
			[
				'label' => esc_html__( 'Choose Image', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
                'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'exad_ihe_image_size',
				'default'   => 'large',
			]
		);

        $this->add_control(
			'exad_ihe_title',
			[
				'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
                'label_block' => true,
				'default' => esc_html__( 'Exclusive Addons', 'exclusive-addons-elementor' ),
				'placeholder' => esc_html__( 'Type your title here', 'exclusive-addons-elementor' ),
                'dynamic' => [
					'active' => true,
				]
			]
		);

        $this->add_control(
            'exad_ihe_title_html_tag',
            [
                'label'   => __('Title HTML Tag', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SELECT,
                'options' => Helper::exad_title_tags(),
                'default' => 'h2',
            ]
		);

        $this->add_control(
			'exad_ihe_description',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Default description', 'exclusive-addons-elementor' ),
			]
		);

        $this->end_controls_section();

		/**
         * Image Hover Container Style
         */
        $this->start_controls_section(
            'exad_ihe_container_style',
            [
              'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
              'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_ihe_container_border',
				'label' => esc_html__( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-ihe-wrapper .exad-ihe-grid .exad-ihe-figure',
			]
		);

		$this->add_control(
			'exad_ihe_container_border_radius',
			[
				'label' => esc_html__( 'Border radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .exad-ihe-wrapper .exad-ihe-grid .exad-ihe-figure' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_ihe_container_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-ihe-wrapper .exad-ihe-grid .exad-ihe-figure',
			]
		);

		$this->add_control(
			'exad_ihe_container_heading',
			[
				'label' => esc_html__( 'Banckground Overlay', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_ihe_container_background_overlay',
				'label' => esc_html__( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .exad-ihe-wrapper .exad-ihe-grid figure.exad-ihe-figure, 
				{{WRAPPER}} .exad-ihe-wrapper .exad-ihe-grid figure.exad-ihe-figure figcaption.exad-ihe-figcaption',
			]
		);

        $this->end_controls_section();

        /**
         * Image Hover Title Style
         */
        $this->start_controls_section(
            'exad_ihe_title_style',
            [
              'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
              'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_ihe_title_typography',
				'selector' => '{{WRAPPER}} .exad-ihe-wrapper .exad-ihe-title',
			]
		);

        $this->add_control(
			'exad_ihe_title_color',
			[
				'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .exad-ihe-wrapper .exad-ihe-title' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'exad_ihe_title_margin',
			[
				'label' => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .exad-ihe-wrapper .exad-ihe-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        /**
         * Image Hover Description Style
         */
        $this->start_controls_section(
            'exad_ihe_description_style',
            [
              'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
              'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_ihe_description_typography',
				'selector' => '{{WRAPPER}} .exad-ihe-wrapper .exad-ihe-description',
			]
		);

        $this->add_control(
			'exad_ihe_description_color',
			[
				'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .exad-ihe-wrapper .exad-ihe-description' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'exad_ihe_description_margin',
			[
				'label' => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .exad-ihe-wrapper .exad-ihe-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		/**
         * Image Hover Image Style
         */
        $this->start_controls_section(
            'exad_ihe_image_style',
            [
              'label' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
              'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_control(
			'exad_ihe_image_height',
			[
				'label' => esc_html__( 'Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .exad-ihe-wrapper .exad-ihe-figure' => 'max-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
    }

    protected function render() {
        $settings     = $this->get_settings_for_display();

        ?>
        <div class="exad-ihe-wrapper">
            <?php if( $settings['exad_ihe_hover_style'] === 'style_1' ){ ?>
            <div class="exad-ihe-grid">
                <figure class="exad-ihe-figure effect-<?php echo $settings['exad_ihe_effect']; ?>">
					<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'exad_ihe_image_size', 'exad_ihe_image' ); ?>
                    <figcaption class="exad-ihe-figcaption">
                        <<?php echo Utils::validate_html_tag( $settings['exad_ihe_title_html_tag'] ); ?> class="exad-ihe-title">
                            <?php echo wp_kses_post( $settings['exad_ihe_title'] ); ?>
                        </<?php echo Utils::validate_html_tag( $settings['exad_ihe_title_html_tag'] ); ?>>
                        <p class="exad-ihe-description"><?php echo wp_kses_post( $settings['exad_ihe_description']); ?></p>
                    </figcaption>
                </figure>
            </div>
            <?php } ?>
            <?php if( $settings['exad_ihe_hover_style'] === 'style_2' ){ ?>
                <div class="exad-ihe-grid">
                    <figure class="exad-ihe-figure <?php echo $settings['exad_ihe_hover_effect_2']; ?>">
                        <img src="<?php echo $settings['exad_ihe_image']['url'] ?>" alt="img01"/>
                        <figcaption class="exad-ihe-figcaption">
                            <<?php echo Utils::validate_html_tag( $settings['exad_ihe_title_html_tag'] ); ?> class="exad-ihe-title">
                                <?php echo wp_kses_post( $settings['exad_ihe_title'] ); ?>
                            </<?php echo Utils::validate_html_tag( $settings['exad_ihe_title_html_tag'] ); ?>>
                            <p class="exad-ihe-description"><?php echo wp_kses_post( $settings['exad_ihe_description']); ?></p>
                        </figcaption>
                    </figure>
                </div>
            <?php } ?>
        </div>
        <?php
    }

}