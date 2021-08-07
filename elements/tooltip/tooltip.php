<?php
namespace ExclusiveAddons\Elements;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Control_Media;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Tooltip extends Widget_Base {

    public function get_name() {
        return 'exad-tooltip';
    }
    
    public function get_title() {
        return __( 'Tooltip', 'exclusive-addons-elementor' );
    }

    public function get_icon() {
        return 'exad exad-logo exad-tooltip';
    }

    public function get_keywords() {
        return [ 'exclusive', 'hover', 'title' ];
    }

    public function get_categories() {
        return [ 'exclusive-addons-elementor' ];
    }

    protected function register_controls() {
        $exad_primary_color = get_option( 'exad_primary_color_option', '#7a56ff' );

        $this->start_controls_section(
            'tooltip_button_content',
            [
                'label' => __( 'Content Settings', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
			'exad_tooltip_type',
			[
                'label'       => esc_html__( 'Content Type', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::CHOOSE,
                'toggle'      => false,
                'label_block' => true,
                'options'     => [
					'icon'      => [
						'title' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-info-circle'
					],
					'text'      => [
						'title' => esc_html__( 'Text', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-area'
					],
					'image'     => [
						'title' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-image-bold'
					]
				],
				'default'     => 'icon'
			]
		);

  		$this->add_control(
			'exad_tooltip_content',
			[
                'label'       => esc_html__( 'Content', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => esc_html__( 'Hover Me!', 'exclusive-addons-elementor' ),
                'condition'   => [
					'exad_tooltip_type' => [ 'text' ]
				]
			]
        );
		
		$this->add_control(
			'exad_tooltip_icon_content',
			[
                'label'       => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fab fa-linux',
                    'library' => 'fa-brands'
                ],
                'condition'   => [
					'exad_tooltip_type' => [ 'icon' ]
				]
			]
		);

		$this->add_control(
			'exad_tooltip_img_content',
			[
                'label'     => esc_html__( 'Image', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
					'url'   => Utils::get_placeholder_image_src()
				],
				'condition' => [
					'exad_tooltip_type' => [ 'image' ]
				]
			]
		);

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'exad_tooltip_image_size',
                'default'   => 'thumbnail',
                'condition' => [
                    'exad_tooltip_type'              => [ 'image' ],
                    'exad_tooltip_img_content[url]!' => ''
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'exad_tooltip_image_css_filter',
                'selector' => '{{WRAPPER}} .exad-tooltip .exad-tooltip-content img',
                'condition' => [
                    'exad_tooltip_type' => [ 'image' ],
                    'exad_tooltip_img_content[url]!' => ''
				]
			]
		);

        $this->add_control(
            'tooltip_style_section_align',
            [
                'label'   => __( 'Alignment', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'toggle'  => false,
                'options' => [
                    'left'      => [
                        'title' => __( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'default'       => 'center',
                'prefix_class'  => 'exad-tooltip-align-'
            ]
        );

        $this->add_control(
            'exad_tooltip_enable_link',
            [
                'label'        => __( 'Show Link', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $this->add_control(
            'exad_tooltip_link',
            [
                'label'           => __( 'Link', 'exclusive-addons-elementor' ),
                'type'            => Controls_Manager::URL,
                'placeholder'     => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
                'show_external'   => true,
                'default'         => [
                    'url'         => '',
                    'is_external' => true
                ],
                'condition'       => [
                    'exad_tooltip_enable_link'=>'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tooltip_options',
            [
                'label' => __( 'Tooltip Options', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_tooltip_text',
            [
                'label'       => esc_html__( 'Tooltip Text', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => esc_html__( 'These are some dummy tooltip contents.', 'exclusive-addons-elementor' ),
                'dynamic'     => [ 'active' => true ]
            ]
        );

        $this->add_control(
          'exad_tooltip_direction',
            [
                'label'         => esc_html__( 'Direction', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'tooltip-right',
                'label_block'   => false,
                'options'       => [
                    'tooltip-left'   => esc_html__( 'Left', 'exclusive-addons-elementor' ),
                    'tooltip-right'  => esc_html__( 'Right', 'exclusive-addons-elementor' ),
                    'tooltip-top'    => esc_html__( 'Top', 'exclusive-addons-elementor' ),
                    'tooltip-bottom' => esc_html__( 'Bottom', 'exclusive-addons-elementor' )
                ]
            ]
        );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'tooltip_style_section',
            [
                'label' => __( 'General Styles', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'     => __( 'Text Typography', 'exclusive-addons-elementor' ),
                'name'      => 'exad_tooltip_button_text_typography',
                'selector'  => '{{WRAPPER}} .exad-tooltip .exad-tooltip-content',
                'condition' => [
                    'exad_tooltip_type' => [ 'text' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_tooltip_button_icon_size',
            [
                'label'        => __( 'Icon Size', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 18
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-content i' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'exad_tooltip_type' => [ 'icon' ]
                ]
            ]
        );

		$this->add_responsive_control(
			'exad_tooltip_content_width',
		    [
                'label' => __( 'Content Width', 'exclusive-addons-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
		            'px'       => [
		                'min'  => 0,
		                'max'  => 1000,
		                'step' => 5
		            ],
		            '%'        => [
		                'min'  => 0,
		                'max'  => 100,
                        'step' => 1
		            ]
                ],
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 150
                ],
		        'selectors'  => [
		            '{{WRAPPER}} .exad-tooltip .exad-tooltip-content' => 'width: {{SIZE}}{{UNIT}};'
		        ]
		    ]
		);

		$this->add_responsive_control(
			'exad_tooltip_content_padding',
			[
                'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top'    => 20,
                    'right'  => 20,
                    'bottom' => 20,
                    'left'   => 20
                ],
				'selectors'  => [
	 				'{{WRAPPER}} .exad-tooltip .exad-tooltip-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
	 			]
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_tooltip_hover_border',
                'selector' => '{{WRAPPER}} .exad-tooltip .exad-tooltip-content'
            ]
        );

    
        $this->add_responsive_control(
            'exad_tooltip_content_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top'    => 4,
                    'right'  => 4,
                    'bottom' => 4,
                    'left'   => 4
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
		
		$this->start_controls_tabs( 'exad_tooltip_content_style_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'exad_tooltip_content_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );
                
				$this->add_control(
					'exad_tooltip_content_color',
					[
                        'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => $exad_primary_color,
                        'condition' => [
                            'exad_tooltip_type!' => [ 'image' ]
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .exad-tooltip .exad-tooltip-content, {{WRAPPER}} .exad-tooltip .exad-tooltip-content a' => 'color: {{VALUE}};'
						]
					]
                );

				$this->add_control(
					'exad_tooltip_content_bg_color',
					[
                        'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#f9f9f9',
                        'selectors' => [
							'{{WRAPPER}} .exad-tooltip .exad-tooltip-content' => 'background-color: {{VALUE}};'
						]
					]
				);

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'exad_tooltip_content_shadow',
                        'selector' => '{{WRAPPER}} .exad-tooltip .exad-tooltip-content'
                    ]
                );

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'exad_tooltip_content_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_tooltip_content_hover_color',
					[
                        'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'condition' => [
                            'exad_tooltip_type!' => [ 'image' ]
                        ],
                        'default'   => '#212121',
                        'selectors' => [
                            '{{WRAPPER}} .exad-tooltip .exad-tooltip-content:hover'   => 'color: {{VALUE}};',
                            '{{WRAPPER}} .exad-tooltip .exad-tooltip-content a:hover' => 'color: {{VALUE}};'
						]
					]
                );

				$this->add_control(
					'exad_tooltip_content_hover_bg_color',
					[
                        'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#f9f9f9',
                        'selectors' => [
							'{{WRAPPER}} .exad-tooltip .exad-tooltip-content:hover' => 'background-color: {{VALUE}};'
						]
					]
				);
                
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'exad_tooltip_hover_shadow',
                        'selector' => '{{WRAPPER}} .exad-tooltip .exad-tooltip-content:hover'
                    ]
                );
				
			$this->end_controls_tab();

        $this->end_controls_tabs();
                
        $this->end_controls_section();

        // Tooltip Style tab section
        $this->start_controls_section(
            'exad_tooltip_style_section',
            [
                'label' => __( 'Tooltip Styles', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hover_tooltip_content_typography',
                'selector' => '{{WRAPPER}} .exad-tooltip .exad-tooltip-text'
            ]
        );

        $this->add_control(
            'exad_tooltip_style_color',
            [
                'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-item .exad-tooltip-text' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'hover_tooltip_content_background',
                'types'    => [ 'classic', 'gradient' ],
                'fields_options'  => [
                    'background'  => [
                        'default' => 'classic'
                    ],
                    'color'       => [
                        'default' => $exad_primary_color
                    ]
                ],
                'selector' => '{{WRAPPER}} .exad-tooltip .exad-tooltip-text'
            ]
        );

        $this->add_responsive_control(
			'exad_tooltip_text_width',
		    [
                'label' => __( 'Tooltip Width', 'exclusive-addons-elementor' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
		            'px'       => [
		                'min'  => 0,
		                'max'  => 1000,
		                'step' => 5
		            ],
		            '%'        => [
		                'min'  => 0,
		                'max'  => 100
		            ]
		        ],
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 200
                ],
		        'selectors'    => [
		            '{{WRAPPER}} .exad-tooltip .exad-tooltip-text' => 'width: {{SIZE}}{{UNIT}};'
		        ]
		    ]
		);

        $this->add_responsive_control(
            'exad_tooltip_text_padding',
            [
                'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => 10,
                    'right'  => 10,
                    'bottom' => 10,
                    'left'   => 10
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator'  =>'before'
            ]
        );

        $this->add_responsive_control(
            'exad_tooltip_content_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top'    => 4,
                    'right'  => 4,
                    'bottom' => 4,
                    'left'   => 4
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-text' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px !important;'
                ]
            ]
        );
    
        $this->add_control(
            'exad_tooltip_arrow_color',
            [
                'label'     => __( 'Arrow Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => $exad_primary_color,
                'selectors' => [
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-item.tooltip-top .exad-tooltip-text:after' => 'border-color: {{VALUE}} transparent transparent transparent;',
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-item.tooltip-left .exad-tooltip-text:after' => 'border-color: transparent transparent transparent {{VALUE}};',
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-item.tooltip-bottom .exad-tooltip-text:after' => 'border-color: transparent transparent {{VALUE}} transparent;',
                    '{{WRAPPER}} .exad-tooltip .exad-tooltip-item.tooltip-right .exad-tooltip-text:after' => 'border-color: transparent {{VALUE}} transparent transparent;'
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings        = $this->get_settings_for_display();

        $this->add_render_attribute( 'exad_tooltip_wrapper', 'class', 'exad-tooltip' );

        if( isset( $settings['exad_tooltip_link']['url'] ) ) {
            $this->add_render_attribute( 'exad_tooltip_link', 'href', esc_url( $settings['exad_tooltip_link']['url'] ) );
            if( $settings['exad_tooltip_link']['is_external'] ) {
                $this->add_render_attribute( 'exad_tooltip_link', 'target', '_blank' );
            }
            if( $settings['exad_tooltip_link']['nofollow'] ) {
                $this->add_render_attribute( 'exad_tooltip_link', 'rel', 'nofollow' );
            }
        }

        $this->add_inline_editing_attributes( 'exad_tooltip_content', 'basic' );

        ?>
       
        <div <?php echo $this->get_render_attribute_string( 'exad_tooltip_wrapper' ); ?>>
            <div class="exad-tooltip-item <?php echo esc_attr( $settings['exad_tooltip_direction'] ); ?>">
                <div class="exad-tooltip-content">

                    <?php if( 'yes' === $settings['exad_tooltip_enable_link'] && !empty( $settings['exad_tooltip_link']['url'] ) ) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'exad_tooltip_link' ); ?>>
                    <?php endif; ?>

                    <?php if( 'text' === $settings['exad_tooltip_type'] && !empty( $settings['exad_tooltip_content'] ) ) : ?>
                        <span <?php echo $this->get_render_attribute_string( 'exad_tooltip_content' ); ?>><?php echo wp_kses_post( $settings['exad_tooltip_content'] ); ?></span>';

                    <?php elseif( 'icon' === $settings['exad_tooltip_type'] && !empty( $settings['exad_tooltip_icon_content']['value'] ) ) : ?>
                        <?php Icons_Manager::render_icon( $settings['exad_tooltip_icon_content'] ); ?>

                    <?php elseif( 'image' === $settings['exad_tooltip_type'] && !empty( $settings['exad_tooltip_img_content']['url'] ) ) : ?>
                        <?php if ( $settings['exad_tooltip_img_content']['url'] || $settings['exad_tooltip_img_content']['id'] ) { ?>
                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'exad_tooltip_image_size', 'exad_tooltip_img_content' ); ?>
                        <?php } ?>
                    <?php endif; ?>

                    <?php if( 'yes' === $settings['exad_tooltip_enable_link'] && !empty( $settings['exad_tooltip_link']['url'] ) ) : ?>
                        </a>
                    <?php endif; ?>

                </div>

                <?php $settings['exad_tooltip_text'] ? printf( '<div class="exad-tooltip-text">%s</div>', wp_kses_post( $settings['exad_tooltip_text'] ) ) : ''; ?>
            </div>
        </div>
        <?php
    }

    /**
     * Render tooltip widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
        ?>
        <#
            view.addRenderAttribute( 'exad_tooltip_wrapper', 'class', 'exad-tooltip' );
            
            var target = settings.exad_tooltip_link.is_external ? ' target="_blank"' : '';
            var nofollow = settings.exad_tooltip_link.nofollow ? ' rel="nofollow"' : '';

            view.addInlineEditingAttributes( 'exad_tooltip_content', 'basic' );

            var iconHTML = elementor.helpers.renderIcon( view, settings.exad_tooltip_icon_content, { 'aria-hidden': true }, 'i' , 'object' );

            if ( settings.exad_tooltip_img_content.url || settings.exad_tooltip_img_content.id ) {
                var image = {
                    id: settings.exad_tooltip_img_content.id,
                    url: settings.exad_tooltip_img_content.url,
                    size: settings.exad_tooltip_image_size_size,
                    dimension: settings.exad_tooltip_image_size_custom_dimension,
                    model: view.getEditModel()
                };

                var imageURL = elementor.imagesManager.getImageUrl( image );
            }
        #>

        <div {{{ view.getRenderAttributeString( 'exad_tooltip_wrapper' ) }}}>
            <div class="exad-tooltip-item {{{ settings.exad_tooltip_direction }}}">
                <div class="exad-tooltip-content">
                    <# if ( 'yes' === settings.exad_tooltip_enable_link && settings.exad_tooltip_link.url ) { #>
                        <a href="{{ settings.exad_tooltip_link.url }}"{{ target }}{{ nofollow }}>
                    <# } #>

                    <# if ( 'text' === settings.exad_tooltip_type && settings.exad_tooltip_content ) { #>
                        <span {{{ view.getRenderAttributeString( 'exad_tooltip_content' ) }}}>
                            {{{ settings.exad_tooltip_content }}}
                        </span>
                    <# } #>

                    <# if ( 'icon' === settings.exad_tooltip_type && iconHTML.value ) { #>
                        {{{ iconHTML.value }}}
                    <# } #>

                    <# if ( 'image' === settings.exad_tooltip_type && settings.exad_tooltip_img_content.url ) { #>
                        <img src="{{{ imageURL }}}">
                    <# } #>

                    <# if ( 'yes' === settings.exad_tooltip_enable_link && settings.exad_tooltip_link.url ) { #>
                        </a>
                    <# } #>           
                </div>
                <# if ( settings.exad_tooltip_text ) { #>
                    <div class="exad-tooltip-text">
                        {{{ settings.exad_tooltip_text }}}
                    </div>
                <# } #>
            </div>
        </div>

        <?php
    }
}