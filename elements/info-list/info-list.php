<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH') ) exit; //If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Control_Media;
use Elementor\Icons_Manager;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
USE \Elementor\Icon_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Widget_Base;

class Infolist extends Widget_Base {
 
    public function get_name() {
        return 'exad-infolist';
    }

    public function get_title() {
        return esc_html__( 'Info List', 'exclusive-addons-elementor' );
    }

    public function get_icon() {
        return 'exad-element-icon eicon-bullet-list';
    }

    public function get_categories() {
        return ['exclusive-addons-elementor'];
    }

    public function get_keywords() {
        return ['exclusive', 'information', 'info list', 'list icon'];
    }

    protected function _register_controls(){
        $exad_primary_color = get_option('exad_primary_color_option', '#7a56ff');
       
        /**
        * InfoList Image
        *
        */
        $this->start_controls_section(
            'exad_section_infolist_content_list_item',
            [
                'label' => esc_html__('List Item', 'exclusive-addons-elementor'),
            ]
        );

        $repeater = new Repeater();

        $repeater-> add_control(
            'exad_infolist_img_or_icon',
            [
                'label' => esc_html__('Image Or Icon', 'exclusive-addons-elementor'),
                'type' => Controls_manager::CHOOSE,
                'toggle' => false,
                'label_block' => false,
                'default' => 'icon',
                'options' => [
                    'none' => [
                        'title' => esc_html__( 'None','exclusive-addons-elementor' ),
                        'icon' => 'eicon-ban'
                    ],
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                        'icon' => 'eicon-info-circle'
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
                        'icon' => 'eicon-image-bold'
                    ],
                    'text' => [
                        'title' => esc_html__( 'Text', 'exclusive-addons-elementor' ),
                        'icon' => 'fa fa-font'
                    ]
                ]
            ]
            
        );

        $repeater->add_control(
            'exad_infolist_icon',
            [
                'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check-circle',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'exad_infolist_img_or_icon' => 'icon',
                ]
            ]
        );

        $repeater->add_control(
            'exad_infolist_image',
            [
                'label' => esc_html__( 'Image', 'exclusive-addons-elementor'),
                'type' =>Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'exad_infolist_img_or_icon' => 'image',
                ]
            ]
        );

        $repeater->add_control(
            'exad_infolist_icon_text',
            [
                'label' => esc_html__( 'Text as Icon', 'exclusive-addons-elementor' ),
                'type' =>Controls_Manager::TEXT,
                'default' => esc_html__( '1', 'exclusive-addons-elementor' ),
                'condition' =>[
                    'exad_infolist_img_or_icon' => 'text',
                ],
                'separator' => 'before',
            ]
        );
        
        $repeater->add_control(
            'exad_infolist_title',
            [
                'label' => esc_html__( 'Info Title', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::TEXT,
                'placcholder' => esc_html__( 'Info Title', 'exclusive-addons-elementor' ),
                'default' => esc_html__( 'Info Title', 'exclusive-addons-elementor' ),
                'dynamic' => [ 'active' => true ],
                'label_block' => true,

            ]
        );
        $repeater->add_control(
            'exad_title_url_switcher',
            [
                'label' => esc_html__( 'Title Link', 'exclusive-addons-elementor' ),
                'type' =>Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => esc_html__( 'Yes', 'exclusive-addons-elementor'),
                'label_off' => esc_html__( 'No', 'exclusive-addons-elementor'),
                'return_value' => 'yes',
            ]
        );
        $repeater->add_control(
            'exad_title_url',
            [
                'label'=> esc_html__( 'Title URL', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com','exclusive-addons-elementor' ),
                'condition' => [
                    'exad_title_url_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'exad_infolist_short_description',
            [   
                'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.','exclusive-addons-elementor' ),
                'label_block' => true,
                'separator' => 'before',
                
            ]
        );

        $this->add_control(
            'exad_exclusive_infolist_repeater',[
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'exad_infolist_title' => esc_html__( 'Info Title 1','exclusive-addons-elementor' ),
                    ],
                    [
                        'exad_infolist_title' => esc_html__( 'Info Title 2','exclusive-addons-elementor' ),
                    ],
                    [
                        'exad_infolist_title' => esc_html__( 'Info Title 3','exclusive-addons-elementor' ),
                    ]
                ],
                'title_field' => '{{exad_infolist_title}}',
            ]
            

        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'separator' => 'before',
            ]
            
        );
        $this->add_control(
            'exad_vertical_line_style_switcher',
            [
                'label'=> esc_html__( 'Line Style', 'exclusive-addons-elementor' ),
                'type' =>Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => esc_html__( 'Yes', 'exclusive-addons-elementor' ),
                'label_off' => esc_html__( 'No', 'exclusive-addons-elementor' ),
                'return_value' => 'yes',

            ]
        );
        $this->end_controls_section();

        /**
		 * -------------------------------------------
		 * Tab Style Exclusive Infolist Container Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_infolist_container_style',
			[
				'label'	=> esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);		

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'exad_infolist_container_background_color',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .exad-list-container'
            ]
        );

        $this->add_responsive_control(
            'exad_exclusive_infolist_container_padding',
            [
				'label'      => esc_html__('Padding', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
                    '{{WRAPPER}} .exad-list-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_exclusive_infolist_container_margin',
            [
				'label'        => esc_html__('Margin', 'exclusive-addons-elementor'),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => ['px', '%'],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
                'selectors'    => [
                    '{{WRAPPER}} .exad-list-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
        	Group_Control_Border::get_type(),
            [
				'name'     => 'exad_exclusive_infolist_container_border',
				'selector' => '{{WRAPPER}} .exad-list-container'
            ]
		);
		
		$this->add_responsive_control(
            'exad_exclusive_infolist_container_border_radius',
            [
				'label'      => esc_html__('Border Radius', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
                'selectors'  => [
                    '{{WRAPPER}} .exad-list-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_infolist_container_box_shadow',
				'selector' => '{{WRAPPER}} .exad-list-container'
			]
        );

		$this->end_controls_section();

        /**
		 * -------------------------------------------
		 * Tab Style Exclusive Infolist List Style
		 * -------------------------------------------
		 */
        $this->start_controls_section(
			'exad_section_exclusive_infolist_list_style',
			[
				'label'	=> esc_html__( 'List Style', 'exclusive-addons-elementor' ),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
        );		
        
        $this->add_responsive_control(
            'exad_section_exclusive_infolist_list_item_space',
            [
              'label'    => esc_html__( 'List Space', 'exclusive-addons-elementor' ),
              'type'     => Controls_Manager::SLIDER,
              'default'  => [
                    'size' => 10
              ],
              'range'    => [
                    'px'   => [
                        'max' => 50
                    ]
              ],
              'selectors' => [
                    '{{WRAPPER}} .exad-list-container .exad-info-list-items .exad-info-list-item' => 'margin-bottom: {{SIZE}}px;'
              ]
            ]
        );

        $this->add_responsive_control(
            'exad_exclusive_infolist_list_item_border_radius',
            [
				'label'      => esc_html__('Border Radius', 'exclusive-addons-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
                'selectors'  => [
                    '{{WRAPPER}} .exad-list-container .exad-info-list-items .exad-info-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_infolist_list_item_box_shadow',
				'selector' => '{{WRAPPER}} .exad-list-container .exad-info-list-items .exad-info-list-item'
			]
        );

        $this->add_control(
			'exad_infolist_icon_position',
			[
				'label'        => __( 'List Position', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::CHOOSE,
				'label_block'  => false,
				'toggle'       => false,
				'default'      => 'left',
				'options'      => [
					'left'  => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-h-align-left',
                    ],
					'top'   => [
						'title' => esc_html__( 'Top', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-v-align-top',
                    ],
					'right' => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-h-align-right',
                    ],
				],
				'prefix_class' => 'exad-info-list-icon-',
            ]
		);
        $this->end_controls_section();

        /**
		 * -------------------------------------------
		 * Tab Style Exclusive Infolist List Style
		 * -------------------------------------------
		 */
        $this->start_controls_section(
			'exad_section_exclusive_infolist_content_style',
			[
				'label'	=> esc_html__( 'Content Style', 'exclusive-addons-elementor' ),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
        );	

        $this->add_responsive_control(
			'exad_infolist_content_align',
			[
				'label'     => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'    => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-left',
                    ],
					'center'  => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-center',
                    ],
					'right'   => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-right',
                    ],
					'justify' => [
						'title' => esc_html__( 'Justified', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-justify',
                    ],
                ],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .exad-list-container .exad-info-list-items .exad-info-list-item .exad-info-list-item-content-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
		);

        $this->add_control(
			'exad_infolist_content_title_heading',
			[
				'label'     => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
        );
        $this->add_control(
			'exad_infolist_content_title_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .exad-list-container .exad-info-list-item-content-wrapper .infolist-title' => 'color: {{VALUE}};',
                ],
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_infolist_content_title_typography',
				'label'    => esc_html__( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-list-container .exad-info-list-item-content-wrapper .infolist-title',
            ]
        );
        
        $this->add_responsive_control(
            'exad_infolist_content_title_bottom_space',
            [
              'label'    => esc_html__( 'Space', 'exclusive-addons-elementor' ),
              'type'     => Controls_Manager::SLIDER,
              'default'  => [
                    'size' => 10
              ],
              'range'    => [
                    'px'   => [
                        'max' => 50
                    ]
              ],
              'selectors' => [
                    '{{WRAPPER}} .exad-list-container .exad-info-list-item-content-wrapper .infolist-title' => 'margin-bottom: {{SIZE}}px;'
              ]
            ]
        );
        
        $this->add_control(
			'exad_infolist_content_description_heading',
			[
				'label'     => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);

		$this->add_control(
			'exad_infolist_content_description_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .exad-list-container .exad-info-list-item-content-wrapper .infolist-description' => 'color: {{VALUE}};',
                ],
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_infolist_content_description_typography',
				'label'    => esc_html__( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-list-container .exad-info-list-item-content-wrapper .infolist-description',
            ]
		);

        $this->end_controls_section();
    }

    protected function render() {
        $settings =  $this->get_settings_for_display();
        $this->add_render_attribute('exad-info-list-container', 'class', 'exad-list-container');
        if ( $settings['exad_vertical_line_style_switcher'] == 'yes' ) {
			$this->add_render_attribute( 'exad-info-list-container', 'class', 'exad-info-list-connector' );
		}
        $this->add_render_attribute('exad-info-list-items', 'class', 'exad-info-list-items');
        $this->add_render_attribute('exad-info-list-item', 'class', 'exad-info-list-item');
        $this->add_render_attribute('exad-info-list-item-inner', 'class', 'exad-info-list-item-inner');
        //$this->add_render_attribute('exad-info-list-item-inner', 'class', 'exad-info-list-item-inner');
        $this->add_render_attribute('exad-info-list-item-icon-image-wrapper', 'class', 'exad-info-list-item-icon-image-wrapper');
        $this->add_render_attribute('exad-info-list-item-content-wrapper', 'class', 'exad-info-list-item-content-wrapper');

        if ( is_array( $settings['exad_exclusive_infolist_repeater'] ) ) :
            echo '<div '. $this->get_render_attribute_string( 'exad-info-list-container' ) .'>';
            echo '<ul ' .$this->get_render_attribute_string( 'exad-info-list-items' ). '>';
                foreach( $settings['exad_exclusive_infolist_repeater'] as $info_list ):
                    echo '<li '. $this->get_render_attribute_string( 'exad-info-list-item' ) .'>';
                    echo '<div '. $this->get_render_attribute_string( 'exad-info-list-item-inner' ) .'>';

                        echo '<div '. $this->get_render_attribute_string( 'exad-info-list-item-icon-image-wrapper' ) .'>';
                            if ( ! empty( $info_list['exad_infolist_icon'] ) && $info_list['exad_infolist_img_or_icon'] == 'icon') {
                                echo '<span class="infolist-has-icon">';
                                Icons_Manager::render_icon( $info_list['exad_infolist_icon'], [ 'aria-hidden' => 'true' ] );
                                echo '</span>';
                            }
                            if ( ! empty( $info_list['exad_infolist_image'] ) && $info_list['exad_infolist_img_or_icon'] == 'image'){
                                $image_url = Group_Control_Image_Size::get_attachment_image_src( $info_list['exad_infolist_image']['id'], 'thumbnail', $settings );
                                if ( $image_url ) {
                                    echo '<span class="infolist-has-image"><img src="'. esc_url( $image_url ) .'" alt="'. esc_attr( Control_Media::get_image_alt( $info_list['exad_infolist_image'] ) ) .'"></span>';
                                } else {
                                    echo '<img src="' . esc_url( $info_list['exad_infolist_image']['url'] ) . '">';
                                }
                            }
                            if ( ! empty( $info_list['exad_infolist_icon_text'] ) && $info_list['exad_infolist_img_or_icon'] == 'text'){
                                echo '<span class="infolist-has-icon-text">' .esc_html( $info_list['exad_infolist_icon_text'] )  . '</span>';
                            }
                        echo '</div>';

                        echo '<div '. $this->get_render_attribute_string( 'exad-info-list-item-content-wrapper' ) .'>';
                            echo '<h2 class="infolist-title">'. esc_html( $info_list['exad_infolist_title'] ) . '</h2>';
                            echo '<div class="infolist-description">'. esc_html( $info_list['exad_infolist_short_description'] ) . '</div>';
                        echo '</div>';
                    echo '</div>';
                    echo '</li>';
                endforeach;
            echo '</ul>';
            echo '</div>';
        endif;

    }
       
}