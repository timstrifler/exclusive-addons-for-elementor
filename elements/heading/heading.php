<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Icons_Manager;
use \Elementor\Widget_Base;
use \Elementor\Utils;
use \ExclusiveAddons\Elementor\Helper;


class Heading extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-exclusive-heading';
	}

	public function get_title() {
		return esc_html__( 'Heading', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad exad-logo exad-heading';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
        return [ 'exclusive', 'title' ];
    }
    
	protected function register_controls() {
		$exad_secondary_color = get_option( 'exad_secondary_color_option', '#00d8d8' );
		
		/**
		* Heading Content Section
		*/
		$this->start_controls_section(
			'exad_heading_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_heading_title',
			[
				'label'       => esc_html__( 'Heading', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'separator'   => 'before',
				'default'     => esc_html__( 'Heading Title', 'exclusive-addons-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'exad_heading_title_link',
			[
				'label'       => __( 'Heading URL', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'label_block' => true
			]
		);

		
		$this->add_control(
			'exad_heading_subheading',
			[
				'label'   => esc_html__( 'Sub Heading', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore odio sint harum quasi maiores nobis dignissimos illo doloremque blanditiis illum! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore odio sint harum quasi maiores nobis digniss.', 'exclusive-addons-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
            'exad_heading_icon_show',
            [
				'label'        => esc_html__( 'Enable Icon', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
				'default'      => 'yes',
				'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_heading_icon',
            [
                'label'       => __( 'Icon', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
                    'value'   => 'fab fa-wordpress-simple',
                    'library' => 'fa-brands'
                ],
				'condition'   => [
					'exad_heading_icon_show' => 'yes'
                ]
            ]
        );

		$this->add_control(
            'exad_heading_divider',
            [
				'label'        => esc_html__( 'Enable Divider', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
				'default'      => 'yes',
				'return_value' => 'yes'
            ]
		);


		
        $this->add_control(
            'exad_heading_title_html_tag',
            [
                'label'   => __('Title HTML Tag', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SELECT,
				'separator' => 'after',
                'options' => Helper::exad_title_tags(),
                'default' => 'h1',
            ]
		);

		$this->end_controls_section();
		

		/*
		* Heading Styling Section
		*/
		$this->start_controls_section(
			'exad_section_heading_general_style',
			[
				'label' => esc_html__( 'General', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

        $this->add_responsive_control(
			'exad_heading_title_alignment',
			[
				'label'       => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => false,
				'options'     => [
					'exad-heading-left'   => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-left'
					],
					'exad-heading-center' => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-center'
					],
					'exad-heading-right'  => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'selectors_dictionary' => [
					'exad-heading-left' => 'text-align: left; margin-right: auto; margin-left: unset;',
					'exad-heading-center' => 'text-align: center; margin-left: auto; margin-right: auto;',
					'exad-heading-right' => 'text-align: right; margin-left: auto; margin-right: unset',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-exclusive-heading' => '{{VALUE}};',
					'{{WRAPPER}} .exad-exclusive-heading .exad-heading-separator' => '{{VALUE}};',
					'{{WRAPPER}} .exad-exclusive-heading .exad-heading-icon' => '{{VALUE}};',
					'{{WRAPPER}} .exad-exclusive-heading .exad-heading-icon-box-yes .exad-heading-icon' => '{{VALUE}};',
				],
				'default'     => 'exad-heading-center'
			]
		);

		$this->end_controls_section();

		/*
		* Icon Style
		*/
		$this->start_controls_section(
			'exad_section_heading_icon_style',
			[
				'label'     => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_heading_icon_show'    => 'yes',
					'exad_heading_icon[value]!' => ''
				]
			]
		);

		$this->add_control(
            'exad_heading_icon_box',
            [
				'label'        => esc_html__( 'Icon Box', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes'
            ]
		);
		
		$this->add_responsive_control(
			'exad_heading_icob_box_height',
			[
				'label'     => esc_html__( 'Height', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .exad-heading-icon' => 'height: {{VALUE}}px;'
				],
				'condition' => [
					'exad_heading_icon_box' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'exad_heading_icon_box_width',
			[
				'label'     => esc_html__( 'Width', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .exad-heading-icon' => 'width: {{VALUE}}px;'
				],
				'condition' => [
					'exad_heading_icon_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'            => 'exad_heading_icon_box_background',
				'types'           => [ 'classic', 'gradient' ],
				'selector'        => '{{WRAPPER}} .exad-heading-icon',
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => $exad_secondary_color
					]
				]
			]
		);

		$this->add_responsive_control(
			'exad_heading_icon_box_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
                    'top'      => '20',
                    'right'    => '20',
                    'bottom'   => '15',
                    'left'     => '20',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-heading-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_heading_icon_box_radius',
			[
				'label'        => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '100',
					'right'    => '100',
					'bottom'   => '100',
					'left'     => '100',
					'unit'     => '%'
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-heading-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'exad_heading_icon_box_border',
				'selector'  => '{{WRAPPER}} .exad-heading-icon'
			]
		);

		$this->add_control(
			'exad_heading_icon_color',
			[
				'label'     => __('Icon Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-heading-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .exad-heading-icon svg path' => 'fill: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_heading_icon_size',
			[
				'label'      => __( 'Icon Size', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 30
				],
				'selectors' => [
					'{{WRAPPER}} .exad-heading-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-heading-icon svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}'
				]
			]
		);

		$this->add_responsive_control(
			'exad_heading_icon_margin_bottom',
			[
				'label'      => __( 'Bottom Spacing', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 100
					]
                ],
                'default'    => [
					'unit'   => 'px',
					'size'   => 20
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-heading-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};'
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
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
            'exad_heading_type',
            [
				'label'   => esc_html__( 'Heading Type', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'exad-heading-simple',
				'options' => [
					'exad-heading-simple'          => esc_html__( 'Simple', 'exclusive-addons-elementor' ),
					'exad-heading-text-background' => esc_html__( 'Text Background', 'exclusive-addons-elementor' ),
					'exad-heading-image-gradient'  => esc_html__( 'Image/Gradient', 'exclusive-addons-elementor' )
				]
            ]
		);

		$this->add_control(
			'exad_heading_outline_enable',
			[
				'label' => __( 'Enable Text Outline', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'exad_heading_outline_width',
			[
				'label'      => __( 'Outline Width', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 5
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 1
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-exclusive-heading-title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'exad_heading_outline_enable' => 'yes',
				]
			]
		);

		$this->add_control(
			'exad_heading_outline_color',
			[
				'label'     => __('Outline Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-exclusive-heading-title' => '-webkit-text-stroke-color: {{VALUE}};'
				],
				'condition' => [
					'exad_heading_outline_enable' => 'yes',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'exad_heading_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .exad-heading-image-gradient .exad-exclusive-heading-title',
				'condition' => [
					'exad_heading_type' => 'exad-heading-image-gradient'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_heading_typography',
				'selector' => '{{WRAPPER}} .exad-exclusive-heading-title'
			]
		);

		$this->add_control(
			'exad_heading_color',
			[
				'label'     => __('Text Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-exclusive-heading-title, {{WRAPPER}} a .exad-exclusive-heading-title' => 'color: {{VALUE}};'
				],
				'condition' => [
					'exad_heading_type' => ['exad-heading-simple', 'exad-heading-text-background']
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'exad_heading_text_shadow',
				'label' => __( 'Text Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-exclusive-heading-title',
			]
		);

		$this->add_responsive_control(
			'exad_heading_heading_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .exad-exclusive-heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Text Background Style
		 */

		$this->start_controls_section(
			'exad_section_heading_text_background_style',
			[
				'label'     => esc_html__( 'Text Background', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_heading_type' => 'exad-heading-text-background'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_heading_text_background_typography',
				'selector' => '{{WRAPPER}} .exad-heading-text-background .exad-exclusive-heading-title::after'
			]
		);

		$this->add_control(
			'exad_heading_text_background_color',
			[
				'label'     => __('Text Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#eaeff3',
				'selectors' => [
					'{{WRAPPER}} .exad-heading-text-background .exad-exclusive-heading-title::after' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'exad_heading_text_background_outline_enable',
			[
				'label' => __( 'Enable Text Outline', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'exad_heading_text_background_outline_width',
			[
				'label'      => __( 'Outline Width', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 5
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 1
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-heading-text-background .exad-exclusive-heading-title::after' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'exad_heading_text_background_outline_enable' => 'yes',
				]
			]
		);

		$this->add_control(
			'exad_heading_text_background_outline_color',
			[
				'label'     => __('Outline Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-heading-text-background .exad-exclusive-heading-title::after' => '-webkit-text-stroke-color: {{VALUE}};'
				],
				'condition' => [
					'exad_heading_text_background_outline_enable' => 'yes',
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Separator Style
		 */

		$this->start_controls_section(
			'exad_section_heading_style_separator',
			[
				'label'     => esc_html__( 'Divider', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_heading_divider' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'exad_heading_divider_height',
			[
				'label'     => esc_html__( 'Height', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '2',
				'selectors' => [
					'{{WRAPPER}} .exad-heading-separator' => 'height: {{VALUE}}px;'
				]
				
			]
		);
		
		$this->add_responsive_control(
			'exad_heading_divider_width',
			[
				'label'     => esc_html__( 'Width', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .exad-heading-separator' => 'width: {{VALUE}}px;'
				]
			]
		);
		$this->add_control(
			'exad_heading_divider_background',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .exad-heading-separator' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_heading_divider_margin_top',
			[
				'label'      => __( 'Top Spacing', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 12
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-heading-separator' => 'margin-top: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_heading_divider_margin_bottom',
			[
				'label'      => __( 'Bottom Spacing', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 20
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-heading-separator' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Subheading Style
		 */
		$this->start_controls_section(
			'exad_section_heading_styles_subheading',
			[
				'label' => esc_html__( 'Sub Heading', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_heading_description_color',
			[
				'label'     => __('Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .exad-exclusive-heading-description' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
					'name'     => 'exad_heading_subheading_typography',
					'selector' => '{{WRAPPER}} .exad-exclusive-heading-description'
			]
		);

		$this->add_responsive_control(
			'exad_heading_subheading_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .exad-exclusive-heading-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();
		
	}
	
	protected function render() {
		$settings          = $this->get_settings_for_display();

		$this->add_render_attribute( 
			'exad_exclusive_heading_wrapper', 
			[ 
				'class' => [ 
					'exad-exclusive-heading-wrapper', 
					esc_attr( $settings['exad_heading_title_alignment'] ), 
					esc_attr( $settings['exad_heading_type'] ) 
				]
			]
		);

		$this->add_render_attribute( 
			'exad_heading_title', 
			[ 
				'data-content' => esc_attr( $settings['exad_heading_title'] ),
				'class'        => 'exad-exclusive-heading-title'
			]
		);

		if( 'yes' === $settings['exad_heading_icon_box'] ){
			$this->add_render_attribute( 'exad_exclusive_heading_wrapper', 'class', 'exad-heading-icon-box-yes');
		}

		if( $settings['exad_heading_title_link']['url'] ) {
            $this->add_render_attribute( 'exad_heading_title_link', 'href', esc_url( $settings['exad_heading_title_link']['url'] ) );
	        if( $settings['exad_heading_title_link']['is_external'] ) {
	            $this->add_render_attribute( 'exad_heading_title_link', 'target', '_blank' );
	        }
	        if( $settings['exad_heading_title_link']['nofollow'] ) {
	            $this->add_render_attribute( 'exad_heading_title_link', 'rel', 'nofollow' );
	        }
        }

		$this->add_inline_editing_attributes( 'exad_heading_title', 'basic' );

		$this->add_render_attribute( 'exad_heading_subheading', 'class', 'exad-exclusive-heading-description' );
		$this->add_inline_editing_attributes( 'exad_heading_subheading', 'basic' );
		?>

        <div class="exad-exclusive-heading">
            <div <?php echo $this->get_render_attribute_string( 'exad_exclusive_heading_wrapper' ); ?>>
			<?php
				if ( 'yes' === $settings['exad_heading_icon_show'] && !empty( $settings['exad_heading_icon']['value'] ) ) : ?>
          			<span class="exad-heading-icon">
          				<?php Icons_Manager::render_icon( $settings['exad_heading_icon'] ); ?>
          			</span>
				<?php 	  
				endif;

            	if( !empty( $settings['exad_heading_title_link']['url'] ) ) : ?>
            		<a <?php echo $this->get_render_attribute_string( 'exad_heading_title_link' ); ?>>
				<?php endif; ?>

                <<?php echo Utils::validate_html_tag( $settings['exad_heading_title_html_tag'] ); ?> <?php echo $this->get_render_attribute_string( 'exad_heading_title' ); ?>>
					<?php echo wp_kses_post( $settings['exad_heading_title'] ); ?>
				</<?php echo Utils::validate_html_tag( $settings['exad_heading_title_html_tag'] ); ?>>
	
                <?php if( !empty( $settings['exad_heading_title_link']['url'] ) ) { ?>
                    </a>
				<?php 
				}

				if ( 'yes' === $settings['exad_heading_divider'] ) : ?>
					<div class="exad-heading-separator"></div>
				<?php 	
				endif;
                
                if ( !empty( $settings['exad_heading_subheading'] ) ) : ?>
                    <p <?php echo $this->get_render_attribute_string( 'exad_heading_subheading' ); ?>>
						<?php echo wp_kses_post( $settings['exad_heading_subheading'] ); ?>
                    </p>
				<?php endif; ?>

            </div>
        </div>
	<?php 	
	}

	/**
     * Render heading widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
	protected function content_template() {
		?>
		<#
			var iconHTML = elementor.helpers.renderIcon( view, settings.exad_heading_icon, { 'aria-hidden': true }, 'i' , 'object' );

			view.addRenderAttribute( 'exad_exclusive_heading_wrapper', {
				'class': [ 
					'exad-exclusive-heading-wrapper', 
					settings.exad_heading_title_alignment,
					settings.exad_heading_type
				]
			} );

			view.addRenderAttribute( 'exad_heading_title', {
				'data-content': settings.exad_heading_title,
				'class': 'exad-exclusive-heading-title'
			} );

			if ( 'yes' === settings.exad_heading_icon_box ) {
				view.addRenderAttribute( 'exad_exclusive_heading_wrapper', 'class', 'exad-heading-icon-box-yes' );
			}

			view.addInlineEditingAttributes( 'exad_heading_title', 'basic' );

			view.addRenderAttribute( 'exad_heading_subheading', 'class', 'exad-exclusive-heading-description' );
            view.addInlineEditingAttributes( 'exad_heading_subheading', 'basic' );

            var target = settings.exad_heading_title_link.is_external ? ' target="_blank"' : '';
            var nofollow = settings.exad_heading_title_link.nofollow ? ' rel="nofollow"' : '';
			var titleHTMLTag = elementor.helpers.validateHTMLTag( settings.exad_heading_title_html_tag );
		#>
		<div class="exad-exclusive-heading">
			<div {{{ view.getRenderAttributeString( 'exad_exclusive_heading_wrapper' ) }}}>

				<# if ( 'yes' === settings.exad_heading_icon_show && iconHTML.value ) { #>
                    <span class="exad-heading-icon">
                        {{{ iconHTML.value }}}
                    </span>
                <# } #>

                <# if ( settings.exad_heading_title_link ) { #>
                    <a href="{{{ settings.exad_heading_title_link.url }}}"{{{ target }}}{{{ nofollow }}}>
                <# } #>

                <{{{ titleHTMLTag }}} {{{ view.getRenderAttributeString( 'exad_heading_title' ) }}}>
                	{{{ settings.exad_heading_title }}}
                </{{{ titleHTMLTag }}}>

                <# if ( settings.exad_heading_title_link ) { #>
                    </a>
                <# } #>

                <# if ( 'yes' === settings.exad_heading_divider ) { #>
                    <div class="exad-heading-separator"></div>
                <# } #>

				<# if ( settings.exad_heading_subheading ) { #>
                    <p {{{ view.getRenderAttributeString( 'exad_heading_subheading' ) }}}>
                        {{{ settings.exad_heading_subheading }}}
                    </p>
                <# } #>

			</div>
		</div>
		<?php
	}
}