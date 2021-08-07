<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Control_Media;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Image_Comparison extends Widget_Base {
	
	public function get_name() {
		return 'exad-image-comparison';
    }
    
	public function get_title() {
		return esc_html__( 'Image Comparison', 'exclusive-addons-elementor' );
    }
    
	public function get_icon() {
		return 'exad exad-logo exad-image-comparison';
    }
    
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
    }

    public function get_keywords() {
        return [ 'exclusive', 'compare', 'multiple' ];
    }

    public function get_script_depends() {
		return [ 'exad-image-comparison' ];
	}
    
	protected function register_controls() {
        /*
        * image Comparison
        */
        $this->start_controls_section(
          'exad_section_comparison_image',
            [
                'label' => esc_html__( 'Contents', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_comparison_image_one',
            [
                'label'   => esc_html__( 'Image One', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src()
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'full',
                'condition' => [
                    'exad_comparison_image_one[url]!' => ''
                ]
            ]
        );
        

        $this->add_control(
            'exad_comparison_image_two',
            [
                'label'   => esc_html__( 'Image Two', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url'     => Utils::get_placeholder_image_src()
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail_two',
                'default'   => 'full',
                'condition' => [
                    'exad_comparison_image_two[url]!' => ''
                ]
            ]
        );


        $this->end_controls_section();

        /*
        * image Comparison Settings
        */
        $this->start_controls_section(
            'exad_section_comparison_image_setting',
            [
                'label' => esc_html__( 'Settings', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_image_comparison_handle_type',
            [
                'label'   => esc_html__( 'Handle Bar Type', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'vertical',
                'options' => [
                    'vertical'   => esc_html__( 'Horizontal', 'exclusive-addons-elementor' ),
                    'horizontal' => esc_html__( 'Vertical', 'exclusive-addons-elementor' )
                ]
            ]
        );

        $this->add_control(
    		'exad_overlay_enable',
    		[
                'label'        => esc_html__( 'Enable Overlay On Hover', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'off',
                'label_on'     => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
                'return_value' => 'on'
    		]
        );

        $this->add_control(
            'exad_overlay_color',
            [
                'label'     => esc_html__( 'Overlay Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(0,0,0,0.5)',
                'condition' => [
                    'exad_overlay_enable' => 'on'
                ],
                'selectors' => [
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-overlay:hover' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'exad_before_label',
            [
                'label'     => esc_html__( 'Overlay Before Text(On Hover)', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('Before'),
                'condition' => [
                    'exad_overlay_enable' => 'on'
                ]
            ]
        );

        $this->add_control(
            'exad_after_label',
            [
                'label'     => esc_html__( 'Overlay After Text(On Hover)', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('After'),
                'condition' => [
                    'exad_overlay_enable' => 'on'
                ]
            ]
        );
        
        $this->add_control(
    		'exad_default_offset_pct',
            [
                'label'   => esc_html__( 'Handle Bar Position', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0.5',
                'options' => [
                    '0.0' => __( '0', 'exclusive-addons-elementor' ),
                    '0.1' => __( '1', 'exclusive-addons-elementor' ),
    				'0.2' => __( '2', 'exclusive-addons-elementor' ),
    				'0.3' => __( '3', 'exclusive-addons-elementor' ),
    				'0.4' => __( '4', 'exclusive-addons-elementor' ),
    				'0.5' => __( '5', 'exclusive-addons-elementor' ),
    				'0.6' => __( '6', 'exclusive-addons-elementor' ),
    				'0.7' => __( '7', 'exclusive-addons-elementor' ),
    				'0.8' => __( '8', 'exclusive-addons-elementor' ),
    				'0.9' => __( '9', 'exclusive-addons-elementor' ),
    				'1.0' => __( '10', 'exclusive-addons-elementor' )
                ]
    		]
        );
        
        $this->add_control(
			'exad_move_slider',
			[
				'label' => __( 'Move Slider', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'move_with_handle_only',
				'options' => [
					'move_slider_on_hover'  => __( 'Move Slider On Hover', 'exclusive-addons-elementor' ),
					'move_with_handle_only' => __( 'Move With Handle Only', 'exclusive-addons-elementor' ),
					'click_to_move' => __( 'Click To Move', 'exclusive-addons-elementor' ),
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
                'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_img_comparison_border',
                'selector' => '{{WRAPPER}} .exad-image-comparision .exad-image-comparision-element'
            ]
        );


        $this->add_responsive_control(
            'exad_img_comparison_border_radius',
            [
                'label'        => __( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'isLinked' => true
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-image-comparision .exad-image-comparision-element' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'exad_image_comparison_box_shadow',
                'selector' => '{{WRAPPER}} .exad-image-comparision .exad-image-comparision-element'
            ]
        );
        
        $this->end_controls_section();

        /*
        * image Comparison Handle Style
        */
        $this->start_controls_section(
            'exad_image_comparison_handler',
            [
                'label' => esc_html__( 'Handler', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'exad_image_comparison_handler_width',
			[
				'label' => __( 'Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 38,
				],
				'selectors' => [
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-handle' => 'width: {{SIZE}}{{UNIT}}; margin-left: calc( -{{SIZE}}{{UNIT}} / 2 - {{exad_image_comparison_handler_border.size}}{{exad_image_comparison_handler_border.unit}} )',
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-vertical .twentytwenty-handle:before' => 'margin-left: calc( {{SIZE}}{{UNIT}} / 2 + {{exad_image_comparison_handler_border.size}}{{exad_image_comparison_handler_border.unit}} );',
					'{{WRAPPER}} .exad-image-comparision .twentytwenty-vertical .twentytwenty-handle:after' => 'margin-right: calc( {{SIZE}}{{UNIT}} / 2 + {{exad_image_comparison_handler_border.size}}{{exad_image_comparison_handler_border.unit}} );',
				],
			]
        );
        
        $this->add_control(
			'exad_image_comparison_handler_height',
			[
				'label' => __( 'Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 38,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-image-comparision .twentytwenty-handle' => 'height: {{SIZE}}{{UNIT}}; margin-top: calc( -{{SIZE}}{{UNIT}} / 2 - {{exad_image_comparison_handler_border.size}}{{exad_image_comparison_handler_border.unit}} );',
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-horizontal .twentytwenty-handle:before' => 'margin-bottom: calc( {{SIZE}}{{UNIT}} / 2 + {{exad_image_comparison_handler_border.size}}{{exad_image_comparison_handler_border.unit}} );',
					'{{WRAPPER}} .exad-image-comparision .twentytwenty-horizontal .twentytwenty-handle:after' => 'margin-top: calc( {{SIZE}}{{UNIT}} / 2 + {{exad_image_comparison_handler_border.size}}{{exad_image_comparison_handler_border.unit}} );',
				],
			]
        );
        
        $this->add_control(
			'exad_image_comparison_handler_background',
			[
				'label' => __( 'Handler Background', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .exad-image-comparision .twentytwenty-handle' => 'background: {{VALUE}}',
				],
			]
        );
        
        $this->add_control(
			'exad_image_comparison_handler_bar_color',
			[
				'label' => __( 'Handler Bar Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-handle:before,{{WRAPPER}} .twentytwenty-handle:after' => 'background: {{VALUE}}',
				],
			]
        );

        $this->add_control(
			'exad_image_comparison_handler_border_color',
			[
				'label' => __( 'Handler Border Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-handle' => 'border-color: {{VALUE}}',
				],
			]
        );

        $this->add_control(
			'exad_image_comparison_handler_icon_color',
			[
				'label' => __( 'Handler Icon Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-vertical .twentytwenty-up-arrow' => 'border-bottom-color: {{VALUE}}',
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-horizontal .twentytwenty-right-arrow' => 'border-left-color: {{VALUE}}',
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-vertical .twentytwenty-down-arrow' => 'border-top-color: {{VALUE}}',
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-horizontal .twentytwenty-left-arrow' => 'border-right-color: {{VALUE}}'
				],
			]
        );

        $this->add_control(
			'exad_image_comparison_handler_border',
			[
				'label' => __( 'Handler Border', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-image-comparision .twentytwenty-handle' => 'border-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-vertical .twentytwenty-handle:before, 
                    {{WRAPPER}} .exad-image-comparision .twentytwenty-vertical .twentytwenty-handle:after' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-image-comparision .twentytwenty-horizontal .twentytwenty-handle:before, 
                    {{WRAPPER}} .exad-image-comparision .twentytwenty-horizontal .twentytwenty-handle:after' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
        );
        
        $this->add_control(
			'exad_image_comparison_handler_radius',
			[
				'label' => __( 'Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .exad-image-comparision .twentytwenty-handle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        /*
        * image Comparison Label Style
        */
        $this->start_controls_section(
            'exad_image_comparison_label',
            [
                'label' => esc_html__( 'Label', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_overlay_enable' => 'on'
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_image_comparison_label_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-image-comparision .twentytwenty-before-label:before, {{WRAPPER}} .exad-image-comparision .twentytwenty-after-label:before',
			]
		);

        $this->add_control(
			'exad_image_comparison_label_background',
			[
				'label' => __( 'Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-before-label:before,
                    {{WRAPPER}} .exad-image-comparision .twentytwenty-after-label:before' => 'background: {{VALUE}}',
				],
			]
        );

        $this->add_control(
			'exad_image_comparison_label_text_color',
			[
				'label' => __( 'Text Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-before-label:before,
                    {{WRAPPER}} .exad-image-comparision .twentytwenty-after-label:before' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_control(
			'exad_image_comparison_label_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-before-label:before,
                    {{WRAPPER}} .exad-image-comparision .twentytwenty-after-label:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_control(
			'exad_image_comparison_label_x_position',
			[
				'label' => __( 'X Offset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
                    ],
                    '%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .exad-image-comparision .twentytwenty-horizontal .twentytwenty-before-label:before' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-image-comparision .twentytwenty-horizontal .twentytwenty-after-label:before' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-image-comparision .twentytwenty-vertical .twentytwenty-before-label:before' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-image-comparision .twentytwenty-vertical .twentytwenty-after-label:before' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_control(
			'exad_image_comparison_label_y_position',
			[
				'label' => __( 'Y Offset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
                    ],
                    '%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .exad-image-comparision .twentytwenty-horizontal .twentytwenty-before-label:before' => 'top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-horizontal .twentytwenty-after-label:before' => 'top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-vertical .twentytwenty-before-label:before' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-image-comparision .twentytwenty-vertical .twentytwenty-after-label:before' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_image_comparison_label_border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-image-comparision .twentytwenty-before-label:before, {{WRAPPER}} .exad-image-comparision .twentytwenty-after-label:before',
			]
		);

        $this->add_control(
			'exad_image_comparison_label_border_radius',
			[
				'label' => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
                    '{{WRAPPER}} .exad-image-comparision .twentytwenty-before-label:before,
                    {{WRAPPER}} .exad-image-comparision .twentytwenty-after-label:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings_for_display();
		
		$this->add_render_attribute( 'exad_image_comparison_wrapper', [
            'class' => [ 
                'exad-image-comparision-element'
            ],
            'data-exad-before_label'       => esc_attr( $settings['exad_before_label'] ),
            'data-exad-after_label'        => esc_attr( $settings['exad_after_label'] ),
            'data-exad-default_offset_pct' => esc_attr( $settings['exad_default_offset_pct'] ),
            'data-exad-oriantation'        => esc_attr( $settings['exad_image_comparison_handle_type'] )
        ]);

        if( 'on' !== $settings['exad_overlay_enable'] ) {
            $this->add_render_attribute( 'exad_image_comparison_wrapper', 'data-exad-no_overlay', true );
        }
        if( 'move_slider_on_hover' == $settings['exad_move_slider'] ) {
            $this->add_render_attribute( 'exad_image_comparison_wrapper', 'data-exad-move_slider_on_hover', true );
        }
        if( 'move_with_handle_only' == $settings['exad_move_slider'] ) {
            $this->add_render_attribute( 'exad_image_comparison_wrapper', 'data-exad-move_with_handle_only', true );
        }
        if( 'click_to_move' == $settings['exad_move_slider'] ) {
            $this->add_render_attribute( 'exad_image_comparison_wrapper', 'data-exad-click_to_move', true );
        }
        ?>

        <div class="exad-image-comparision">
            <div <?php echo $this->get_render_attribute_string('exad_image_comparison_wrapper'); ?>>
                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'exad_comparison_image_one' ); ?>
                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_two', 'exad_comparison_image_two' ); ?>
            </div>
        </div>

    <?php    
	}

    /**
     * Render image comparison widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
        ?>
        <#
            if ( settings.exad_comparison_image_one.url || settings.exad_comparison_image_one.id ) {
                var image = {
                    id: settings.exad_comparison_image_one.id,
                    url: settings.exad_comparison_image_one.url,
                    size: settings.thumbnail_size,
                    dimension: settings.thumbnail_custom_dimension,
                    model: view.getEditModel()
                };

                var imageOneURL = elementor.imagesManager.getImageUrl( image );
            }

            if ( settings.exad_comparison_image_two.url || settings.exad_comparison_image_two.id ) {
                var image = {
                    id: settings.exad_comparison_image_two.id,
                    url: settings.exad_comparison_image_two.url,
                    size: settings.thumbnail_two_size,
                    dimension: settings.thumbnail_two_custom_dimension,
                    model: view.getEditModel()
                };

                var imageTwoURL = elementor.imagesManager.getImageUrl( image );
            }

            view.addRenderAttribute( 'exad_image_comparison_wrapper', {
                'class'                       : [ 'exad-image-comparision-element' ],
                'data-exad-before_label'      : settings.exad_before_label,
                'data-exad-after_label'       : settings.exad_after_label,
                'data-exad-default_offset_pct': settings.exad_default_offset_pct,
                'data-exad-oriantation'       : settings.exad_image_comparison_handle_type
            } );

            if ( 'on' !== settings.exad_overlay_enable ) {
                view.addRenderAttribute( 'exad_image_comparison_wrapper', 'data-exad-no_overlay', true );
            }
            if( 'move_slider_on_hover' == settings.exad_move_slider ) {
                view.addRenderAttribute( 'exad_image_comparison_wrapper', 'data-exad-move_slider_on_hover', true );
            }
            if( 'move_with_handle_only' == settings.exad_move_slider ) {
                view.addRenderAttribute( 'exad_image_comparison_wrapper', 'data-exad-move_with_handle_only', true );
            }
            if( 'click_to_move' == settings.exad_move_slider ) {
                view.addRenderAttribute( 'exad_image_comparison_wrapper', 'data-exad-click_to_move', true );
            }
        #>

        <div class="exad-image-comparision">
            <div {{{ view.getRenderAttributeString( 'exad_image_comparison_wrapper' ) }}}>
                <# if ( settings.exad_comparison_image_one.url ) { #>
                    <img src="{{{ imageOneURL }}}">
                <# } #>
                <# if ( settings.exad_comparison_image_two.url ) { #>
                    <img src="{{{ imageTwoURL }}}">
                <# } #>
            </div>
        </div>

        <?php
    }
    
}