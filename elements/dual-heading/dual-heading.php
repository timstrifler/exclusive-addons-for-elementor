<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Widget_Base;
use \Elementor\Utils;
use \ExclusiveAddons\Elementor\Helper;

class Dual_Heading extends Widget_Base {
	
	public function get_name() {
		return 'exad-exclusive-dual-heading';
	}

	public function get_title() {
		return esc_html__( 'Dual Heading', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad exad-logo exad-dual-heading';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

    public function get_keywords() {
        return [ 'exclusive', 'multi', 'double' ];
    }

    protected function register_controls() {
        $exad_primary_color = get_option( 'exad_primary_color_option', '#7a56ff' );

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
                'default'     => esc_html__( 'First', 'exclusive-addons-elementor' ),
                'dynamic' => [
					'active' => true,
				]
            ]
        );
        $this->add_control(
            'exad_dual_second_heading',
            [
                'label'       => esc_html__( 'Second Heading', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Second', 'exclusive-addons-elementor' ),
                'dynamic' => [
					'active' => true,
				]
            ]
        );

        $this->add_control(
            'exad_heading_title_html_tag',
            [
                'label'   => __('Heading HTML Tag', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SELECT,
                'separator' => 'after',
                'options' => Helper::exad_title_tags(),
                'default' => 'h2',
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
                'default'     => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_dual_heading_icon_show',
            [
                'label'        => esc_html__( 'Enable Icon', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
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
                'toggle'      => false,
                'label_block' => true,
                'options'     => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'    => [
                        'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-right'
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

        $this->add_responsive_control(
            'exad_dual_heading_icon_size',
            [
                'label'        => __( 'Icon Size', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 10,
                        'max'  => 150,
                        'step' => 2
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 36
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-icon i' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'exad_dual_heading_icon_show'    => 'yes',
                    'exad_dual_heading_icon[value]!' => ''
                ]
            ]
        );        

        $this->add_responsive_control(
            'exad_dual_heading_icon_margin',
            [
                'label'      => __('Icon Margin', 'exclusive-addons-elementor'),
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

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'            => 'exad_dual_heading_first_bg_color',
                'types'           => [ 'classic', 'gradient' ],
                'selector'        => '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title .first-heading, {{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title a .first-heading',
                'fields_options'  => [
                    'background'  => [
                        'default' => 'classic'
                    ],
                    'color'       => [
                        'default' => $exad_primary_color
                    ]
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name'     => 'exad_dual_first_heading_typography',
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

        $this->add_responsive_control(
            'exad_dual_first_heading_radius',
            [
                'label'      => __('Border radius', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title .first-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_dual_first_heading_border',
                'selector' => '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title .first-heading'
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

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'exad_dual_heading_second_bg_color',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title .second-heading, {{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title a .second-heading'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_dual_second_heading_typography',
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

        $this->add_responsive_control(
            'exad_dual_second_heading_radius',
            [
                'label'      => __('Border radius', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title .second-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_dual_second_heading_border',
                'selector' => '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper .exad-dual-heading-title .second-heading'
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
                'name'            => 'exad_dual_heading_description_typography',
                'fields_options'  => [
                    'font_weight' => [
                        'default' => '400'
                    ]
                ],
                'selector'        => '{{WRAPPER}} .exad-dual-heading .exad-dual-heading-wrapper p.exad-dual-heading-description'
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

        $this->add_render_attribute( 'exad_dual_first_heading', 'class', 'first-heading' );
        $this->add_inline_editing_attributes( 'exad_dual_first_heading', 'basic' );

        $this->add_render_attribute( 'exad_dual_second_heading', 'class', 'second-heading' );
        $this->add_inline_editing_attributes( 'exad_dual_second_heading', 'basic' );

        $this->add_render_attribute( 'exad_dual_heading_description', 'class', 'exad-dual-heading-description' );
        $this->add_inline_editing_attributes( 'exad_dual_heading_description', 'basic' );

        if( $settings['exad_dual_heading_title_link']['url'] ) {
            $this->add_render_attribute( 'exad_dual_heading_title_link', 'href', esc_url( $settings['exad_dual_heading_title_link']['url'] ) );
            if( $settings['exad_dual_heading_title_link']['is_external'] ) {
                $this->add_render_attribute( 'exad_dual_heading_title_link', 'target', '_blank' );
            }
            if( $settings['exad_dual_heading_title_link']['nofollow'] ) {
                $this->add_render_attribute( 'exad_dual_heading_title_link', 'rel', 'nofollow' );
            }
        }
        ?>

        <div class="exad-dual-heading">
            <div class="exad-dual-heading-wrapper">
            <?php 
                if ( 'yes' === $settings['exad_dual_heading_icon_show'] && !empty( $settings['exad_dual_heading_icon']['value'] ) ) : ?>
                    <span class="exad-dual-heading-icon">
                        <?php Icons_Manager::render_icon( $settings['exad_dual_heading_icon'] ); ?>
                    </span>
                <?php endif; ?>

                <<?php echo Utils::validate_html_tag( $settings['exad_heading_title_html_tag'] ); ?> class="exad-dual-heading-title">
                <?php 
                    if( !empty( $settings['exad_dual_heading_title_link']['url'] ) ) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'exad_dual_heading_title_link' ); ?>>
                    <?php endif; ?>
                    <span <?php echo $this->get_render_attribute_string( 'exad_dual_first_heading' ); ?>><?php echo Helper::exad_wp_kses( $settings['exad_dual_first_heading'] ); ?></span>
                    <span <?php echo $this->get_render_attribute_string( 'exad_dual_second_heading' ); ?>><?php echo Helper::exad_wp_kses( $settings['exad_dual_second_heading'] ); ?></span>
                    <?php 
                    if( !empty( $settings['exad_dual_heading_title_link']['url'] ) ) { ?>
                        </a>
                    <?php } ?>
                </<?php echo Utils::validate_html_tag( $settings['exad_heading_title_html_tag'] ); ?>>

                <?php         
                if ( !empty($settings['exad_dual_heading_description'] ) ) : ?>
                    <p <?php echo $this->get_render_attribute_string( 'exad_dual_heading_description' ); ?>><?php echo wp_kses_post( $settings['exad_dual_heading_description'] ); ?></p>
                <?php endif; ?>  

            </div>
        </div>
        <?php
    }

    /**
     * Render dual heading widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
        ?>
        <#
            var iconHTML = elementor.helpers.renderIcon( view, settings.exad_dual_heading_icon, { 'aria-hidden': true }, 'i' , 'object' );

            view.addRenderAttribute( 'exad_dual_first_heading', 'class', 'first-heading' );
            view.addInlineEditingAttributes( 'exad_dual_first_heading', 'basic' );

            view.addRenderAttribute( 'exad_dual_second_heading', 'class', 'second-heading' );
            view.addInlineEditingAttributes( 'exad_dual_second_heading', 'basic' );

            view.addRenderAttribute( 'exad_dual_heading_description', 'class', 'exad-dual-heading-description' );
            view.addInlineEditingAttributes( 'exad_dual_heading_description', 'basic' );

            var target = settings.exad_dual_heading_title_link.is_external ? ' target="_blank"' : '';
            var nofollow = settings.exad_dual_heading_title_link.nofollow ? ' rel="nofollow"' : '';
            var headerSizeTag = elementor.helpers.validateHTMLTag( settings.exad_heading_title_html_tag );
        #>
        <div class="exad-dual-heading">
            <div class="exad-dual-heading-wrapper">
                <# if ( 'yes' === settings.exad_dual_heading_icon_show && iconHTML.value ) { #>
                    <span class="exad-dual-heading-icon">
                        {{{ iconHTML.value }}}
                    </span>
                <# } #>
                <{{{headerSizeTag}}} class="exad-dual-heading-title">
                    <# if ( settings.exad_dual_heading_title_link ) { #>
                        <a href="{{{ settings.exad_dual_heading_title_link.url }}}"{{{ target }}}{{{ nofollow }}}>
                    <# } #>
                    <# if ( settings.exad_dual_first_heading ) { #>
                        <span {{{ view.getRenderAttributeString( 'exad_dual_first_heading' ) }}}>
                            {{{ settings.exad_dual_first_heading }}}
                        </span>
                    <# } #>
                    <# if ( settings.exad_dual_second_heading ) { #>
                            <span {{{ view.getRenderAttributeString( 'exad_dual_second_heading' ) }}}>
                                {{{ settings.exad_dual_second_heading }}}
                            </span>
                    <# } #>
                    <# if ( settings.exad_dual_heading_title_link ) { #>
                        </a>
                    <# } #>
                </{{{headerSizeTag}}}>
                <# if ( settings.exad_dual_heading_description ) { #>
                    <p {{{ view.getRenderAttributeString( 'exad_dual_heading_description' ) }}}>
                        {{{ settings.exad_dual_heading_description }}}
                    </p>
                <# } #>
            </div>
        </div>
        <?php
    }
}