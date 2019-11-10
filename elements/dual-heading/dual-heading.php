<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Dual_Heading extends Widget_Base {
	
	public function get_name() {
		return 'exad-exclusive-dual-heading';
	}

	public function get_title() {
		return esc_html__( 'Dual Heading', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-archive-title';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

    public function get_keywords() {
        return [ 'header', 'multi heading', 'title', 'double' ];
    }

    protected function _register_controls() {

		/**
		* Dual Heading Content Section
		*/
		$this->start_controls_section(
			'exad_dual_heading_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
			]
        );
        
        $this->add_control(
            'exad_dual_first_heading',
            [
                'label'       => esc_html__( 'First Heading', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'First', 'exclusive-addons-elementor' )
            ]
        );
        $this->add_control(
            'exad_dual_second_heading',
            [
                'label'       => esc_html__( 'Second Heading', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Second', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_dual_heading_title_link',
            [
                'label'       => __( 'Heading URL', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
                'label_block' => true
            ]
        );

        $this->add_control(
            'exad_dual_heading_description',
            [
                'label'       => __( 'Sub Heading', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'dynamic'     => [ 'active' => true ],
                'default'     => __( 'Add your sub heading here.', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_dual_heading_icon_show',
            [
                'label'        => esc_html__( 'Enable Icon', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_dual_heading_icon',
            [
                'label'   => __( 'Icon', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fab fa-wordpress-simple',
                    'library' => 'fa-brands'
                ],
                'condition' => [
                    'exad_dual_heading_icon_show' => 'yes'
                ]
            ]
        );

        
        $this->end_controls_section();
            
        /*
        * Dual Heading Styling Section
        */
        $this->start_controls_section(
            'exad_dual_heading_styles_general',
            [
                'label' => esc_html__( 'General Styles', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'exad_dual_heading_alignment',
            [
                'label'       => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => true,
                'options'     => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-left'
                    ],
                    'center'    => [
                        'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-center'
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-right'
                    ]
                ],
                'default'       => 'center',
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'exad_dual_heading_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#132C47',
                'condition' => [
                    'exad_dual_heading_icon_show'    => 'yes',
                    'exad_dual_heading_icon[value]!' => ''
                ],
                'selectors' => [
                    '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-icon i' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'           => 'exad_dual_heading_icon_typography',
                'selector'       => '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-icon i',                
                'exclude'        => [ 'text_transform', 'font_family' ],
                'fields_options' => [
                    'font_size'    => [
                        'default'  => [
                            'unit' => 'px',
                            'size' => 36
                        ]
                    ]
                ],
                'condition' => [
                    'exad_dual_heading_icon_show'    => 'yes',
                    'exad_dual_heading_icon[value]!' => ''
                ]  
            ]
        );

        $this->add_responsive_control(
            'exad_dual_heading_icon_margin',
            [
                'label'      => __('Margin', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'    => '0',
                    'right'  => '0',
                    'bottom' => '15',
                    'left'   => '0'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'exad_dual_heading_icon_show'    => 'yes',
                    'exad_dual_heading_icon[value]!' => ''
                ]
            ]
        );

        $this->end_controls_section();

        /*
            * Dual Heading First Part Styling Section
            */
        $this->start_controls_section(
            'exad_dual_first_heading_styles',
            [
                'label' => esc_html__( 'First Heading', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_dual_heading_first_text_color',
            [
                'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title .first-heading, {{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title a .first-heading' => 'color: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_control(
			'exad_dual_heading_first_bg_color',
			[
                'label'     => __( 'Background', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fb4b15',
                'selectors' => [
					'{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title .first-heading, {{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title a .first-heading' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name'     => 'exad_dual_first_heading_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title .first-heading'
			]
        );

        $this->add_responsive_control(
            'exad_dual_first_heading_margin',
            [
                'label'      => __('Margin', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title .first-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_dual_first_heading_padding',
            [
                'label'      => __('Padding', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title .first-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        /*
		* Dual Heading Second Part Styling Section
		*/
        $this->start_controls_section(
                'exad_dual_second_heading_styles',
                [
                    'label' => esc_html__( 'Second Heading', 'exclusive-addons-elementor' ),
                    'tab'   => Controls_Manager::TAB_STYLE
                ]
        );

        $this->add_control(
                'exad_dual_heading_second_text_color',
                [
                    'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#132C47',
                    'selectors' => [
                        '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title .second-heading, {{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title a .second-heading' => 'color: {{VALUE}};'
                    ]
                ]
        );
        
        $this->add_control(
            'exad_dual_heading_second_bg_color',
            [
                'label'     => __( 'Background', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title .second-heading, {{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title a .second-heading' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_dual_second_heading_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title .second-heading'
            ]
        );

        $this->add_responsive_control(
            'exad_dual_second_heading_margin',
            [
                'label'      => __('Margin', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title .second-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_dual_second_heading_padding',
            [
                'label'      => __('Padding', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title .second-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        /*
            * Dual Heading description Styling Section
        */
        $this->start_controls_section(
            'exad_dual_heading_description_styles',
            [
                'label' => esc_html__( 'Sub Heading', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_dual_heading_description_text_color',
            [
                'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#989B9E',
                'selectors' => [
                    '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper p.exad-dual-heading-description' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_dual_heading_description_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper p.exad-dual-heading-description'
            ]
        );

        $this->add_responsive_control(
            'exad_dual_heading_description_margin',
            [
                'label'      => __('Margin', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper p.exad-dual-heading-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_dual_heading_description_padding',
            [
                'label'      => __('Padding', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper p.exad-dual-heading-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }
  
    protected function render() {
        $settings          = $this->get_settings_for_display();
        $dual_heading_link = $settings['exad_dual_heading_title_link']['url'];

        $this->add_render_attribute( 'exad-dual-heading-wrapper', 'class', 'exad-dual-heading' );
        $this->add_render_attribute( 'exad-dual-heading-wrapper', 'id', 'exad-heading-'.esc_attr( $this->get_id() ) );

        if( $dual_heading_link ) {
            $this->add_render_attribute( 'exad-dual-heading-anchor-params', 'href', esc_url( $dual_heading_link ) );
        }
        if( $settings['exad_dual_heading_title_link']['is_external'] ) {
            $this->add_render_attribute( 'exad-dual-heading-anchor-params', 'target', '_blank' );
        }
        if( $settings['exad_dual_heading_title_link']['nofollow'] ) {
            $this->add_render_attribute( 'exad-dual-heading-anchor-params', 'rel', 'nofollow' );
        }

        echo '<div '.$this->get_render_attribute_string( 'exad-dual-heading-wrapper' ).'>';
            echo '<div class="exad-dual-heading-wrapper">';

                if ( 'yes' == $settings['exad_dual_heading_icon_show'] && !empty( $settings['exad_dual_heading_icon']['value'] ) ) :
                    echo '<span class="exad-dual-heading-icon">';
                        Icons_Manager::render_icon( $settings['exad_dual_heading_icon'] );
                    echo '</span>';
                endif;

                echo '<h1 class="exad-dual-heading-title">';
                    // if(!empty($dual_heading_link)) {
                    //     echo '<a '.$this->get_render_attribute_string( 'exad-dual-heading-anchor-params' ).'>';
                    // }
                    echo '<span class="first-heading">'.esc_html( $settings['exad_dual_first_heading'] ).'</span>';
                    echo '<span class="second-heading">'.esc_html( $settings['exad_dual_second_heading'] ).'</span>';
                    // if(!empty($dual_heading_link)) {
                    //     echo '</a>';
                    // }
                echo '</h1>';

                if ( !empty($settings['exad_dual_heading_description'] ) ) :
                    echo '<p class="exad-dual-heading-description">'.wp_kses_post( $settings['exad_dual_heading_description'] ).'</p>';
                endif;  

            echo '</div>';
        echo '</div>';
    }

    protected function _content_template() {
        ?>
        <#
            view.addRenderAttribute(
                'exad-dual-heading-wrapper',
                {
                    'class': [ 'exad-dual-heading' ]
                }
            );

            var iconHTML = elementor.helpers.renderIcon( view, settings.exad_dual_heading_icon, { 'aria-hidden': true }, 'i' , 'object' );
            
            <!-- var dual_heading_link = settings.exad_dual_heading_title_link.url; -->
        #>
        <div {{{ view.getRenderAttributeString( 'exad-dual-heading-wrapper' ) }}}>
            <div class="exad-dual-heading-wrapper">
                <# if ( 'yes' === settings.exad_dual_heading_icon_show ) { #>
                    <span class="exad-dual-heading-icon">
                        {{{ iconHTML.value }}}
                    </span>
                <# } #>
                <h1 class="exad-dual-heading-title">
                    <span class="first-heading">{{{ settings.exad_dual_first_heading }}}</span>
                    <span class="second-heading">{{{ settings.exad_dual_second_heading }}}</span>.
                </h1>
                <p class="exad-dual-heading-description">{{{ settings.exad_dual_heading_description }}}</p>
            </div>
        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Dual_Heading() );