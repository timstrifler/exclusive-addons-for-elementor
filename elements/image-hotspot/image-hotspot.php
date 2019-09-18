<?php
namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Image Hotspots Widget
 */
class Exad_Image_Hotspot extends Widget_Base
{

    /**
     * Retrieve image hotspots widget name.
     */
    public function get_name()
    {
        return 'exad-image-hotspot';
    }

    /**
     * Retrieve image hotspots widget title.
     */
    public function get_title()
    {
        return __('Image Hotspot', 'exclusive-addons-elementor');
    }

    /**
     * Retrieve the list of categories the image hotspots widget belongs to.
     */
    public function get_categories()
    {
        return ['exclusive-addons-elementor'];
    }

    /**
     * Retrieve image hotspots widget icon.
     */
    public function get_icon()
    {
        return 'exad-element-icon eicon-image-hotspot';
    }


    /**
     * Register image hotspots widget controls.
     */
    protected function _register_controls()
    {

        /*-----------------------------------------------------------------------------------*/
        /*	CONTENT TAB
        /*-----------------------------------------------------------------------------------*/

        /**
         * Content Tab: Image
         */
        $this->start_controls_section(
            'section_image',
            [
                'label'                 => __('Image', 'exclusive-addons-elementor'),
            ]
        );

        $this->add_control(
            'exad_hotspot_image',
            [
                'label'                 => __('Image', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::MEDIA,
                'default'               => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'                  => 'image',
                'label'                 => __('Image Size', 'exclusive-addons-elementor'),
                'default'               => 'full',
            ]
        );

        $this->end_controls_section();

        /**
         * Content Tab: Hotspots
         */
        $this->start_controls_section(
            'section_hotspots',
            [
                'label' => __('Hotspots', 'exclusive-addons-elementor'),
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs('hot_spots_tabs');

        $repeater->start_controls_tab('tab_content', ['label' => __('Content', 'exclusive-addons-elementor')]);

        $repeater->add_control(
            'exad_hotspot_type',
            [
                'label'           => __('Type', 'exclusive-addons-elementor'),
                'type'            => Controls_Manager::SELECT,
                'default'         => 'icon',
                'options'         => [
                    'icon'  => __('Icon', 'exclusive-addons-elementor'),
                    'text'  => __('Text', 'exclusive-addons-elementor'),
                ],
            ]
        );

        $repeater->add_control(
            'exad_hotspot_icon',
            [
                'label'           => __('Icon', 'exclusive-addons-elementor'),
                'type'            => Controls_Manager::ICON,
                'default'         => 'fa fa-plus',
                'condition'       => [
                    'exad_hotspot_type'   => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'exad_hotspot_text',
            [
                'label'           => __('Text', 'exclusive-addons-elementor'),
                'type'            => Controls_Manager::TEXT,
                'label_block'     => true,
                'default'         => '#',
                'condition'       => [
                    'exad_hotspot_type'   => 'text',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab('tab_position', ['label' => __('Position', 'exclusive-addons-elementor')]);

        $repeater->add_control(
            'exad_left_position',
            [
                'label'         => __('Left Position', 'exclusive-addons-elementor'),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'     => [
                        'min'     => 0,
                        'max'     => 100,
                        'step'    => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => '50'
                ],
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_control(
            'exad_top_position',
            [
                'label'         => __('Top Position', 'exclusive-addons-elementor'),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'     => [
                        'min'     => 0,
                        'max'     => 100,
                        'step'    => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => '50'
                ],
                'selectors'     => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab('tab_tooltip', ['label' => __('Tooltip', 'exclusive-addons-elementor')]);

        $repeater->add_control(
            'exad_tooltip',
            [
                'label'           => __('Tooltip', 'exclusive-addons-elementor'),
                'type'            => Controls_Manager::SWITCHER,
                'default'         => '',
                'label_on'        => __('Show', 'exclusive-addons-elementor'),
                'label_off'       => __('Hide', 'exclusive-addons-elementor'),
                'return_value'    => 'yes',
            ]
        );


        $repeater->add_control(
            'exad_tooltip_content',
            [
                'label'           => __('Tooltip Content', 'exclusive-addons-elementor'),
                'type'            => Controls_Manager::TEXTAREA,
                'default'         => __('Tooltip Content', 'exclusive-addons-elementor'),
                'condition'       => [
                    'exad_tooltip'   => 'yes',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'exad_hotspots',
            [
                'label'                 => '',
                'type'                  => Controls_Manager::REPEATER,
                'default'               => [
                    [
                        'feature_text'    => __('Hotspot #1', 'exclusive-addons-elementor'),
                        'feature_icon'    => 'fa fa-plus',
                        'left_position'   => '20%',
                        'top_position'    => '30%',
                    ],
                ],
                'fields'                => array_values($repeater->get_controls()),
                'title_field'           => '{{{ exad_hotspot_text }}}',
            ]
        );

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*	STYLE TAB
        /*-----------------------------------------------------------------------------------*/
        /**
         * Style Tab: Hotspot
         */
        $this->start_controls_section(
            'section_hotspots_style',
            [
                'label'                 => __('Hotspot', 'exclusive-addons-elementor'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'hotspot_icon_size',
            [
                'label'                 => __('Size', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => ['size' => '14'],
                'range'                 => [
                    'px' => [
                        'min'   => 6,
                        'max'   => 40,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => ['px'],
                'selectors'             => [
                    '{{WRAPPER}} .exad-hotspot-item .exad-hotspot-dot .exad-hotspot-dot-icon i,
                    {{WRAPPER}} .exad-hotspot-item .exad-hotspot-dot .exad-hotspot-dot-icon span' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'exad_hotspot_height',
            [
                'label'                 => __('Height', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
                'selectors'             => [
                    '{{WRAPPER}} .exad-hotspot .exad-hotspot-item .exad-hotspot-dot-icon' => 'height: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->add_control(
            'exad_hotspot_width',
            [
                'label'                 => __('Width', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
                'selectors'             => [
                    '{{WRAPPER}} .exad-hotspot .exad-hotspot-item .exad-hotspot-dot-icon' => 'width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'exad_hotspot_color_normal',
            [
                'label'                 => __('Color', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#FFF',
                'selectors'             => [
                    '{{WRAPPER}} .exad-hotspot .exad-hotspot-item .exad-hotspot-dot-icon i, 
                    {{WRAPPER}} .exad-hotspot .exad-hotspot-item .exad-hotspot-dot-icon span' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'exad_hotspot_bg_color_normal',
            [
                'label'                 => __('Background Color', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#704AFF',
                'selectors'             => [
                    '{{WRAPPER}} .exad-hotspot .exad-hotspot-dot-icon' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .exad-hotspot.exad-hotspot-glowing-border .exad-hotspot-dot-icon::before' => 'border: .5px solid {{VALUE}}',
                    '{{WRAPPER}} .exad-hotspot.exad-hotspot-glowing-border .exad-hotspot-dot-icon::after' => 'border: 1px solid {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
			'exad_hotspot_border_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'separator'  => 'before',
                'default'    => [
                    'top'   => '50',
                    'right' => '50',
                    'bottom' => '50',
                    'left'  => '50',
                    'unit' => '%'
                ],
				'selectors'             => [
					'{{WRAPPER}} .exad-hotspot .exad-hotspot-item .exad-hotspot-dot-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_hotspot_box_shadow',
				'label' => __( 'Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .exad-hotspot .exad-hotspot-item .exad-hotspot-dot-icon',
			]
        );

        $this->add_control(
			'exad_hotspot_animation_type',
			[
				'label' => __( 'Animation Type', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => 'None',
                    'exad-hotspot-moving-animation' => 'Moving Animation',
                    'exad-hotspot-glow-animation' => 'Glowing Animation',
                    'exad-hotspot-glowing-border' => 'Glowing Border',
                    'exad-hotspot-hover-scale' => 'Hover Scale',
                ]
			]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'                 => __('Padding', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', '%'],
                'selectors'             => [
                    '{{WRAPPER}} .exad-hotspot .exad-hotspot-dot-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Tooltip
         */
        $this->start_controls_section(
            'section_tooltips_style',
            [
                'label'                 => __('Tooltip', 'exclusive-addons-elementor'),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'exad_hotspot_tooltip_bg_color',
            [
                'label'                 => __('Background Color', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#fff',
                'selectors'             => [
                    '{{WRAPPER}} .exad-hotspot-item .exad-hotspot-dot .exad-hotspot-tooltip' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .exad-hotspot-item .exad-hotspot-dot .exad-hotspot-tooltip::before' => 'border-color: {{VALUE}} transparent transparent transparent;',
                ],
            ]
        );

        $this->add_control(
            'exad_hotspot_tooltip_text_color',
            [
                'label'                 => __('Text Color', 'exclusive-addons-elementor'),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#222222',
                'selectors'             => [
                    '{{WRAPPER}} .exad-hotspot-item .exad-hotspot-tooltip h6' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'exad_hotspot_tooltip_text_distance',
            [
                'label' => __('Distance', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 65,
				],
                'selectors'             => [
                    '{{WRAPPER}} .exad-hotspot-tooltip' => 'bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'exad_tooltip_width',
            [
                'label'         => __('Width', 'exclusive-addons-elementor'),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'     => [
                        'min'     => 50,
                        'max'     => 400,
                        'step'    => 1,
                    ],
                ],
                'size_units'            => ['px'],
                'selectors'             => [
                    '{{WRAPPER}} .exad-hotspot-item .exad-hotspot-dot .exad-hotspot-tooltip h6' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'exad_hotspot_tooltip_text_typography',
                'label'                 => __('Typography', 'exclusive-addons-elementor'),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .exad-hotspot-item .exad-hotspot-tooltip h6',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        ?>
        <div class="exad-hotspot <?php echo esc_attr( $settings['exad_hotspot_animation_type'] ); ?>" >
            <img src="<?php echo esc_url( $settings['exad_hotspot_image']['url'] ); ?>">

            <?php foreach( $settings['exad_hotspots'] as $item ) { 
                $this->add_render_attribute( 'exad_hotspot', 'class', 'exad-hotspot-dot elementor-repeater-item-' . esc_attr( $item['_id'] ) );    
            ?>

                <div class="exad-hotspot-item">
                    <div <?php echo $this->get_render_attribute_string( 'exad_hotspot' ); ?>>
                        <?php
                            if ( $item['exad_hotspot_type'] == 'icon' ) {
                                printf( '<div class="exad-hotspot-dot-icon"><i class="%1$s"></i></div>', esc_attr( $item['exad_hotspot_icon'] ) );
                            }
                        ?>
                        <?php
                            if ( $item['exad_hotspot_type'] == 'text' ) {
                                printf( '<div class="exad-hotspot-dot-icon"><span>%1$s</span></div>', esc_attr( $item['exad_hotspot_text'] ) );
                            }
                        ?>
                        <?php if ( $item['exad_tooltip'] == 'yes' ) { ?>
                            <div class="exad-hotspot-tooltip">
                                <h6><?php echo esc_html( $item['exad_tooltip_content'] ); ?></h6>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            <?php } ?>

        </div>

        <?php
    }

    /**
     * Render image hotspots widget output in the editor.
     */
    protected function _content_template(){}

}

Plugin::instance()->widgets_manager->register_widget_type(new Exad_Image_Hotspot());
