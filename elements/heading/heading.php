<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Heading extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-exclusive-heading';
	}

	public function get_title() {
		return esc_html__( 'Heading', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-heading';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
        return [ 'header', 'title' ];
    }
    
	protected function _register_controls() {
		
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
				'default'     => esc_html__( 'Heading Title', 'exclusive-addons-elementor' )
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
				'default' => esc_html__( 'Basic description about the Heading', 'exclusive-addons-elementor' )
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
				'label_block' => true,
				'options'     => [
					'exad-heading-left'   => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-left'
					],
					'exad-heading-center' => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-center'
					],
					'exad-heading-right'  => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-right'
					]
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
					'exad_heading_icon_show' => 'yes'
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
		
		$this->add_control(
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
		$this->add_control(
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
				'name'      => 'exad_heading_icon_box_background',
				'label'     => __( 'Background', 'exclusive-addons-elementor' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .exad-heading-icon',
				'condition' => [
					'exad_heading_icon_box' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_heading_icon_box_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => ''
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-heading-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'exad_heading_icon_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'exad_heading_icon_box_border',
				'label'     => __( 'Border', 'exclusive-addons-elementor' ),
				'selector'  => '{{WRAPPER}} .exad-heading-icon',
				'condition' => [
					'exad_heading_icon_box' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_heading_icon_color',
			[
				'label'     => __('Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-heading-icon i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'exad_heading_icon_size',
			[
				'label'      => __( 'Icon Size', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 100,
						'step' => 5
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 50
				],
				'selectors' => [
					'{{WRAPPER}} .exad-heading-icon i' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
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

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'exad_heading_background',
				'label'     => __( 'Background', 'exclusive-addons-elementor' ),
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
				'label'    => __( 'Typography', 'exclusive-addons-elementor' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .exad-exclusive-heading-title a'
			]
		);

		$this->add_control(
			'exad_heading_color',
			[
				'label'     => __('Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-exclusive-heading-title a' => 'color: {{VALUE}};'
				],
				'condition' => [
					'exad_heading_type' => ['exad-heading-simple', 'exad-heading-text-background']
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
				'label'    => __( 'Typography', 'exclusive-addons-elementor' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .exad-heading-text-background .exad-exclusive-heading-title::after'
			]
		);

		$this->add_control(
			'exad_heading_text_background_color',
			[
				'label'     => __('Color', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#eaeff3',
				'selectors' => [
					'{{WRAPPER}} .exad-heading-text-background .exad-exclusive-heading-title::after' => 'color: {{VALUE}};'
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

		$this->add_control(
			'exad_heading_divider_height',
			[
				'label'     => esc_html__( 'Height', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '6',
				'selectors' => [
					'{{WRAPPER}} .exad-heading-separator' => 'height: {{VALUE}}px;'
				]
				
			]
		);
		$this->add_control(
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

		$this->add_control(
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
					'size'   => 20
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-heading-separator' => 'margin-top: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
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
		$this->add_control(
			'exad_heading_subheading_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => ''
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-exclusive-heading-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();

		
	}
	protected function render() {
		$settings          = $this->get_settings_for_display();
		$exad_heading_link = $settings['exad_heading_title_link']['url'];

		$this->add_render_attribute( 
			'exad_heading_attribute', 
			[ 
				'class' => 'exad-exclusive-heading',
				'id'    => 'exad-heading'
			]
		);

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

		if( 'yes' === $settings['exad_heading_icon_box'] ){
			$this->add_render_attribute( 'exad_exclusive_heading_wrapper', 'class', 'exad-heading-icon-box-yes');
		}

		if( $exad_heading_link ) {
            $this->add_render_attribute( 'exad-heading-anchor-atts', 'href', esc_url( $exad_heading_link ) );
        }
        if( $settings['exad_heading_title_link']['is_external'] ) {
            $this->add_render_attribute( 'exad-heading-anchor-atts', 'target', '_blank' );
        }
        if( $settings['exad_heading_title_link']['nofollow'] ) {
            $this->add_render_attribute( 'exad-heading-anchor-atts', 'rel', 'nofollow' );
        }

		$this->add_render_attribute( 'exad_heading_title_attr', 'class', 'exad-exclusive-heading-title' );
		$this->add_render_attribute( 'exad_heading_subheading_attr', 'class', 'exad-exclusive-heading-description' );

        echo '<div '.$this->get_render_attribute_string( 'exad_heading_attribute' ).'>';
            echo '<div '.$this->get_render_attribute_string( 'exad_exclusive_heading_wrapper' ).'>';

				if ( 'yes' == $settings['exad_heading_icon_show'] && !empty( $settings['exad_heading_icon']['value'] ) ) :
          			echo '<span class="exad-heading-icon">';
          				Icons_Manager::render_icon( $settings['exad_heading_icon'] );
          			echo '</span>';
				endif;

                echo '<h1 data-content="'.esc_attr( $settings['exad_heading_title'] ).'" '.$this->get_render_attribute_string( 'exad_heading_title_attr' ).'>';
                	if(!empty($exad_heading_link)) {
                        echo '<a '.$this->get_render_attribute_string( 'exad-heading-anchor-atts' ).'>';
                    }
                    echo esc_html( $settings['exad_heading_title'] );

                    if(!empty($exad_heading_link)) {
                        echo '</a>';
                    }
				echo '</h1>';

				if ( 'yes' == $settings['exad_heading_divider'] ) :
					echo '<div class="exad-heading-separator"></div>';
				endif;
                
                if ( !empty( $settings['exad_heading_subheading'] ) ) :
                    echo '<p '.$this->get_render_attribute_string( 'exad_heading_subheading_attr' ).'>';
                    	echo wp_kses_post( $settings['exad_heading_subheading'] );
                    echo '</p>';
                endif;

            echo '</div>';
        echo '</div>';
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Heading() );