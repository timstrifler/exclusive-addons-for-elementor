<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Logo_Box extends Widget_Base {
	
	public function get_name() {
		return 'exad-logo';
	}

	public function get_title() {
		return esc_html__( 'Logo Box', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad exad-logo exad-logo-box';
    }
    
    public function get_keywords() {
		return [ 'exclusive', 'brand' ];
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function register_controls() {

        /*
        * Logo Image
        */
        $this->start_controls_section(
            'exad_section_logo_image',
            [
                'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
            ]
        );
        
        $this->add_control(
            'exad_logo_image',
            [
                'label'   => esc_html__( 'Logo Image', 'exclusive-addons-elementor' ),
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
                    'exad_logo_image[url]!' => ''
                ]
            ]
        );

        $this->add_control(
            'exad_logo_box_enable_link',
            [
                'label'        => __( 'Enable Link', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $this->add_control(
            'exad_logo_box_link',
            [
                'label'         => __( 'Link', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
                'show_external' => true,
                'default'       => [
                    'url'         => '#',
                    'is_external' => true
                ],
                'condition'     => [
                    'exad_logo_box_enable_link' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'exad_logo_box_max_height_enable',
            [
                'label'        => __( 'Minimum Height', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $this->add_control(
			'exad_logo_box_max_height',
			[
				'label' => __( 'Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 150,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-logo-item.exad-logo-item-max-height-yes' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'exad_logo_box_max_height_enable' => 'yes'
                ]
			]
		);
        
        $this->end_controls_section();

        /*
        * Logo Style
        *
        */
    	$this->start_controls_section(
    		'exad_section_logo_style',
    		[
                'label' => esc_html__( 'Style', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
    		]
        );

        $this->add_control(
			'exad_section_logo_alignment',
			[
				'label' => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'exad-logo-left' => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'exad-logo-center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'exad-logo-right' => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'exad-logo-center',
				'toggle' => true,
			]
		);

        $this->start_controls_tabs( 'exad_logo_tabs' );

    	# Normal tab
        $this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
        		'exad_logo_background_style',
        			[
                    'label' => __( 'Background Style', 'exclusive-addons-elementor' ),
                    'type'  => Controls_Manager::HEADING
        			]
            );

            $this->add_group_control(
        		Group_Control_Background::get_type(),
    			[
                    'name'      => 'exad_logo_background',
                    'types'     => [ 'classic', 'gradient' ],
                    'separator' => 'before',
                    'selector'  => '{{WRAPPER}} .exad-logo-box .exad-logo-item'
    			]
            );

            $this->add_control(
        		'exad_logo_opacity_style',
        		[
                    'label' => __( 'Opacity', 'exclusive-addons-elementor' ),
                    'type'  => Controls_Manager::HEADING
        		]
            );

            $this->add_control(
                'exad_logo_opacity',
                [
                    'label' => __('Opacity', 'exclusive-addons-elementor'),
                    'type'  => Controls_Manager::NUMBER,
                    'range' => [
                        'min'   => 0,
                        'max'   => 1
            		],
                    'selectors' => [
                        '{{WRAPPER}} .exad-logo-box .exad-logo-item img' => 'opacity: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
    			'exad_logo_shadow_style',
    			[
                    'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
                    'type'  => Controls_Manager::HEADING
    			]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'exad_logo_box_shadow',
                    'selector' => '{{WRAPPER}} .exad-logo-box .exad-logo-item'
                ]
            );

        $this->end_controls_tab();

    	# Hover tab
        $this->start_controls_tab( 'exad_exclusive_button_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
    			'exad_logo_hover_background',
    			[
                    'label' => __( 'Background Style', 'exclusive-addons-elementor' ),
                    'type'  => Controls_Manager::HEADING
    			]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'      => 'exad_logo_hover_background_hover',
                    'types'     => [ 'classic', 'gradient' ],
                    'separator' => 'before',
                    'selector'  => '{{WRAPPER}} .exad-logo-box .exad-logo-item:hover'
                ]
            );

            $this->add_control(
        		'exad_logo_opacity_hover_style',
        		[
                    'label' => __( 'Opacity', 'exclusive-addons-elementor' ),
                    'type'  => Controls_Manager::HEADING
        		]
            );

            $this->add_control(
                'exad_logo_hover_opacity',
                [
                    'label'     => __('Opacity', 'exclusive-addons-elementor'),
                    'type'      => Controls_Manager::NUMBER,
                    'range'     => [
                        'min'   => 0,
                        'max'   => 1
                    ],
                    'default'   => __( 'From 0.1 to 1', 'exclusive-addons-elementor' ),
                    'selectors' => [
                        '{{WRAPPER}} .exad-logo-box .exad-logo-item:hover img' => 'opacity: {{VALUE}};'
                    ]
                ]
            );
        		
            $this->add_control(
                'exad_logo_shadow_hover_style',
                [
                    'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
                    'type'  => Controls_Manager::HEADING
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'exad_logo_box_hover_shadow',
                    'selector' => '{{WRAPPER}} .exad-logo-box .exad-logo-item:hover'
                ]
            );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'exad_logo_padding',
            [
                'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'separator'  => 'before',
                'default'    => [
                    'top'    => 20,
                    'right'  => 20,
                    'bottom' => 20,
                    'left'   => 20,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-logo-box .exad-logo-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'border',
                'selector' => '{{WRAPPER}} .exad-logo-box .exad-logo-item'
            ]
        );
        $this->add_control(
    		'exad_logo_border_radius',
            [
                'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-logo-box .exad-logo-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
	}
	protected function render() {
        $settings       = $this->get_settings_for_display();
        $exad_logo_link = $settings['exad_logo_box_link'];

        if( 'yes' === $settings['exad_logo_box_enable_link'] && $exad_logo_link ) {
            $this->add_render_attribute( 'exad_logo_box_link', 'href', esc_url( $settings['exad_logo_box_link']['url'] ) );
            if( $settings['exad_logo_box_link']['is_external'] ) {
                $this->add_render_attribute( 'exad_logo_box_link', 'target', '_blank' );
            }
            if( $settings['exad_logo_box_link']['nofollow'] ) {
                $this->add_render_attribute( 'exad_logo_box_link', 'rel', 'nofollow' );
            }
        }
        ?>

        <div class="exad-logo-box one <?php echo $settings['exad_section_logo_alignment']; ?>">
            <div class="exad-logo-item exad-logo-item-max-height-<?php echo $settings['exad_logo_box_max_height_enable']; ?>">
            <?php
                if( ! empty( $settings['exad_logo_image'] ) ) :

                    if( !empty( $exad_logo_link ) && 'yes' === $settings['exad_logo_box_enable_link'] ) :
                        echo '<a '.$this->get_render_attribute_string( 'exad_logo_box_link' ).'>';
                    endif;
                    echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'exad_logo_image' );
                    if( !empty( $exad_logo_link ) && 'yes' === $settings['exad_logo_box_enable_link'] ) :
                        echo '</a>';
                    endif;
                endif;
            ?>    
            </div>
        </div>
    <?php    
	}

    /**
     * Render logo box widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
        ?>
        <#
            if ( settings.exad_logo_image.url || settings.exad_logo_image.id ) {
                var image = {
                    id: settings.exad_logo_image.id,
                    url: settings.exad_logo_image.url,
                    size: settings.thumbnail_size,
                    dimension: settings.thumbnail_custom_dimension,
                    class: 'exad-logo-box-img',
                    model: view.getEditModel()
                };

                var image_url = elementor.imagesManager.getImageUrl( image );
            }

            var target   = settings.exad_logo_box_link.is_external ? ' target="_blank"' : '';
            var nofollow = settings.exad_logo_box_link.nofollow ? ' rel="nofollow"' : '';
        #>
        <div class="exad-logo-box one {{ settings.exad_section_logo_alignment }}">
            <div class="exad-logo-item exad-logo-item-max-height-{{ settings.exad_logo_box_max_height_enable }}">
                <# if ( image_url ) { #>
                    <# if ( settings.exad_logo_box_link && 'yes' === settings.exad_logo_box_enable_link ) { #>
                        <a href="{{{ settings.exad_logo_box_link.url }}}"{{{ target }}}{{{ nofollow }}}>
                    <# } #>
                    <img src="{{{ image_url }}}">
                    <# if ( settings.exad_logo_box_link && 'yes' === settings.exad_logo_box_enable_link ) { #>
                        </a>
                    <# } #>
                <# } #>
            </div>
        </div>
        <?php
    }
}