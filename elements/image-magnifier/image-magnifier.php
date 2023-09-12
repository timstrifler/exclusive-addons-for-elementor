<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Control_Media;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Image_Magnifier extends Widget_Base {
	
	public function get_name() {
		return 'exad-image-magnifier';
    }
    
	public function get_title() {
		return esc_html__( 'Image Magnifier', 'exclusive-addons-elementor' );
    }
    
	public function get_icon() {
		return 'exad exad-logo exad-image-magnifier';
    }
    
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
    }

    public function get_keywords() {
		return [ 'exclusive', 'magnify', 'zoom' ];
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
        'exad_magnify_image',
        [
            'label'   => esc_html__( 'Image', 'exclusive-addons-elementor' ),
            'type'    => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src()
            ],
            'dynamic' => [
                'active' => true,
            ]
        ]
    );

    $this->add_group_control(
        Group_Control_Image_Size::get_type(),
        [
            'name'    => 'magnify_image_size',
            'default' => 'full'
        ]
    );

    $this->add_group_control(
        Group_Control_Css_Filter::get_type(),
        [
            'name' => 'magnify_image_css_filter',
            'selector' => '{{WRAPPER}} .exad-magnify-small',
        ]
    );

    $this->end_controls_section();

    /*
    * image Comparison Style
    */
    $this->start_controls_section(
        'exad_section_image_magnefic_container',
        [
            'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
            'tab'   => Controls_Manager::TAB_STYLE
        ]
    );

    $this->add_responsive_control(
        'exa_image_magnefic_container_image_width',
        [
            'label'       => __( 'Width', 'exclusive-addons-elementor' ),
            'type'        => Controls_Manager::SLIDER,
            'size_units'  => [ 'px', '%' ],
            'range'       => [
                'px'      => [
                    'min' => 0,
                    'max' => 1000
                ],
                '%'       => [
                    'min' => 0,
                    'max' => 100
                ]
            ],
            'default'     => [
                'unit'    => '%',
                'size'    => 100
            ],
            'selectors'   => [
                '{{WRAPPER}} .exad-magnify-small' => 'width: {{SIZE}}{{UNIT}};'
            ]
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name'     => 'exa_image_magnefic_container_image_border',
            'selector' => '{{WRAPPER}} .exad-magnify-small'
        ]
    );

    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name'     => 'exa_image_magnefic_container_image_box_shadow',
            'selector' => '{{WRAPPER}} .exad-magnify-small'
        ]
    );
    
    $this->end_controls_section();

    /*
    * image Comparison Style
    */
    $this->start_controls_section(
        'exad_section_image_magnefic_glass_style',
        [
            'label' => esc_html__( 'Magnific Glass', 'exclusive-addons-elementor' ),
            'tab'   => Controls_Manager::TAB_STYLE
        ]
    );

    $this->add_responsive_control(
        'exad_image_magnefic_glass_height',
        [
            'label'       => __( 'Height', 'exclusive-addons-elementor' ),
            'type'        => Controls_Manager::SLIDER,
            'size_units'  => [ 'px' ],
            'range'       => [
                'px'      => [
                    'min' => 0,
                    'max' => 1000
                ]
            ],
            'default'     => [
                'unit'    => 'px',
                'size'    => 150
            ],
            'selectors'   => [
                '{{WRAPPER}} .exad-magnify-large' => 'height: {{SIZE}}{{UNIT}};'
            ]
        ]
    );

    $this->add_responsive_control(
        'exad_image_magnefic_glass_width',
        [
            'label'       => __( 'Width', 'exclusive-addons-elementor' ),
            'type'        => Controls_Manager::SLIDER,
            'size_units'  => [ 'px' ],
            'range'       => [
                'px'      => [
                    'min' => 0,
                    'max' => 1000
                ]
            ],
            'default'     => [
                'unit'    => 'px',
                'size'    => 150
            ],
            'selectors'   => [
                '{{WRAPPER}} .exad-magnify-large' => 'width: {{SIZE}}{{UNIT}};'
            ]
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name'               => 'exad_image_magnefic_glass_border',
            'fields_options'     => [
                'border'         => [
                    'default'    => 'solid'
                ],
                'width'          => [
                    'default'    => [
                        'top'    => '1',
                        'right'  => '1',
                        'bottom' => '1',
                        'left'   => '1'
                    ]
                ],
                'color'          => [
                    'default'    => '#cccccc'
                ]
            ],
            'selector'           => '{{WRAPPER}} .exad-magnify-large'
        ]
    );

    $this->add_responsive_control(
        'exad_image_magnefic_glass_radius',
        [
            'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'default'    => [
                'top'    => '50',
                'right'  => '50',
                'bottom' => '50',
                'left'   => '50',
                'unit'   => '%'
            ],
            'selectors'  => [
                '{{WRAPPER}} .exad-magnify-large' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ]
        ]
    );

    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name'     => 'exad_image_magnefic_glass_box_shadow',
            'selector' => '{{WRAPPER}} .exad-magnify-large'
        ]
    );
    
    $this->end_controls_section();

    }
    
	protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="exad-image-magnify">
            <div class="exad-magnify-large"></div>
            <div class="exad-magnify-small">
                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'magnify_image_size', 'exad_magnify_image' ); ?>
            </div>
        </div>
        
    <?php
	}

    /**
     * Render image magnifier widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
        ?>
        <#
            if ( settings.exad_magnify_image.url || settings.exad_magnify_image.id ) {
                var image = {
                    id: settings.exad_magnify_image.id,
                    url: settings.exad_magnify_image.url,
                    size: settings.magnify_image_size_size,
                    dimension: settings.magnify_image_size_custom_dimension,
                    model: view.getEditModel()
                };

                var imageURL = elementor.imagesManager.getImageUrl( image );
            }
        #>

        <# if ( imageURL ) { #>
            <div class="exad-image-magnify">
                <div class="exad-magnify-large"></div>
                <div class="exad-magnify-small">
                    <img class="exad-magnify-small" src="{{{ imageURL }}}">
                </div>
            </div>
        <# } #>

        <?php
    }

}