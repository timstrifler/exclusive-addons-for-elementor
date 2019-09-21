<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class ExadNewsTicker extends Widget_Base {

    public function get_name() {
        return 'exad-news-ticker';
    }

    public function get_title() {
        return esc_html__( 'News Ticker', 'exclusive-addons-elementor' );
    }

    public function get_icon() {
        return 'eicon-document-file';
    }

    public function get_categories() {
        return [ 'exclusive-addons-elementor' ];
    }

    /**
     * Retrieve the list of scripts the counter widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return [ 'exad-news-ticker' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'exad_news_ticker_all_items',
            [
                'label' => esc_html__( 'Items', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_news_ticker_label',
            [   
                'label'         => esc_html__( 'Label', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __('Today\'s Hot News', 'exclusive-addons-elementor' )
            ]
        ); 

        $this->add_control(
            'exad_news_ticker_items',
            [
                'label'       => esc_html__( 'Items', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::REPEATER,
                'default'     => [
                    [ 'title' => esc_html__( 'Exad Elementor News item 1', 'exclusive-addons-elementor' ) ],
                    [ 'title' => esc_html__( 'Exad Elementor News item 2', 'exclusive-addons-elementor' ) ],
                    [ 'title' => esc_html__( 'Exad Elementor News item 3', 'exclusive-addons-elementor' ) ],
                    [ 'title' => esc_html__( 'Exad Elementor News item 4', 'exclusive-addons-elementor' ) ],
                    [ 'title' => esc_html__( 'Exad Elementor News item 5', 'exclusive-addons-elementor' ) ],
                    [ 'title' => esc_html__( 'Exad Elementor News item 6', 'exclusive-addons-elementor' ) ]
                ],
                'fields'      => [
                    [
                        'type'          => Controls_Manager::TEXTAREA,
                        'name'          => 'title',
                        'label_block'   => true,
                        'label'         => esc_html__( 'Content', 'exclusive-addons-elementor' ),
                        'default'       => esc_html__( 'News item description', 'exclusive-addons-elementor' )
                    ],
                    [
                        'type'          => Controls_Manager::URL,
                        'name'          => 'link',
                        'label'         => esc_html__( 'Link', 'exclusive-addons-elementor' ),
                        'placeholder'   => esc_html__( 'https://yoursite.com', 'exclusive-addons-elementor' )
                    ]                    
                ],
                'title_field' => '{{title}}'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_news_ticker_settings',
            [
                'label' => esc_html__( 'Settings', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_news_ticker_animation_direction',
            [
                'label'     => esc_html__( 'Direction', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'ltr',
                'options'   => [
                    'ltr'   => esc_html__( 'Left to Right', 'exclusive-addons-elementor' ),
                    'rtl'   => esc_html__( 'Right to Left', 'exclusive-addons-elementor' )
                ],
                'description'   => esc_html__('If you enable Right-to-left(RTL) in your website than by default it will be working in RTL and this option won\'t work.', 'exclusive-addons-elementor')

            ]
        ); 

        $this->add_control(
            'exad_news_ticker_animation_type',
            [
                'label'     => esc_html__( 'Animation Type', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'scroll',
                'options'   => [
                    'scroll'      => esc_html__( 'Scroll', 'exclusive-addons-elementor' ),
                    'slide'       => esc_html__( 'Slide', 'exclusive-addons-elementor' ),
                    'fade'        => esc_html__( 'Fade', 'exclusive-addons-elementor' ),
                    'slide-up'    => esc_html__( 'Slide Up', 'exclusive-addons-elementor' ),
                    'slide-down'  => esc_html__( 'Slide Down', 'exclusive-addons-elementor' ),
                    'slide-left'  => esc_html__( 'Slide Left', 'exclusive-addons-elementor' ),
                    'slide-right' => esc_html__( 'Slide Right', 'exclusive-addons-elementor' ),
                    'typography'  => esc_html__( 'Typography', 'exclusive-addons-elementor' )
                ]               
            ]
        );  

        $this->add_control(
            'exad_news_ticker_autoplay_interval',
            [   
                'label'         => esc_html__( 'Autoplay Interval', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => '4000',
                'condition'     => [
                    '.exad_news_ticker_animation_type!' => 'scroll'
                ]              
            ]
        ); 

        $this->add_control(
            'exad_news_ticker_animation_speed',
            [   
                'label'         => esc_html__( 'Animation Speed', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => '2',
                'condition'     => [
                    '.exad_news_ticker_animation_type' => 'scroll'
                ]                
            ]
        ); 

        $this->add_control(
            'exad_news_ticker_height',
            [   
                'label'         => esc_html__( 'Height', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => '70'
            ]
        ); 

        $this->add_control(
            'exad_news_ticker_autoplay',
            [
                'type'          => Controls_Manager::SWITCHER,
                'label'         => esc_html__( 'Autoplay?', 'exclusive-addons-elementor' ),
                'default'       => 'yes',
                'return_value'  => 'yes'
            ]
        );        

        $this->add_control(
            'exad_news_ticker_pause_on_hover',
            [
                'type'          => Controls_Manager::SWITCHER,
                'label'         => esc_html__( 'Pause On Hover?', 'exclusive-addons-elementor' ),
                'default'       => 'yes',
                'return_value'  => 'yes',
                'condition'     => [
                    '.exad_news_ticker_autoplay' => 'yes'
                ]                
            ]
        );

        $this->add_control(
            'exad_news_ticker_set_bottom_fixed',
            [
                'type'          => Controls_Manager::SWITCHER,
                'label'         => esc_html__( 'Set Bottom?', 'exclusive-addons-elementor' ),
                'default'       => 'no',
                'return_value'  => 'yes',
                'description'   => esc_html__('Stick the news ticker to the bottom of the page.', 'exclusive-addons-elementor')
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'exad_news_ticker_style_tab',
            [
                'label'         => esc_html__( 'Style', 'exclusive-addons-elementor' ),
                'tab'           => Controls_Manager::TAB_STYLE                    
            ]
        );

        $this->add_control(
            'exad_news_ticker_label_container_style',
            [
                'label'         => esc_html__( 'Container', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::HEADING
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'exad_news_ticker_container_border',
                'label'          => esc_html__( 'Border', 'exclusive-addons-elementor' ),
                'selector'       => '{{WRAPPER}} .exad-news-ticker',
                'fields_options' => [
                    'border' => [
                        'default' => 'solid'
                    ],
                    'width'  => [
                        'default' => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                    'color' => [
                        'default' => '#DADCEA'
                    ]
                ]
            ]
        );

        $this->add_control(
            'exad_news_ticker_border_radius',
            [
                'label'     => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::SLIDER,                 
                'range'     => [
                    'px'    => [
                        'max' => 50
                    ],
                ],               
                'selectors' => [
                    '{{WRAPPER}} .exad-news-ticker' => 'border-radius: {{SIZE}}px;'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'exad_news_ticker_container_box_shadow',
                'selector' => '{{WRAPPER}} .exad-news-ticker'
            ]
        );

        $this->add_control(
            'exad_news_ticker_items_style',
            [
                'label'         => esc_html__( 'Items', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before'
            ]
        );

        $this->add_control(
            'exad_news_ticker_color',
            [
                'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .exad-news-ticker li' => 'color: {{VALUE}};'
                ]                
            ]
        );

        $this->add_control(
            'exad_news_ticker_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#3878ff',
                'selectors' => [
                    '{{WRAPPER}} .exad-news-ticker li:hover, .exad-news-ticker li a:hover' => 'color: {{VALUE}};'
                ]                
            ]
        );

        $this->add_control(
            'exad_news_ticker_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .exad-news-ticker' => 'background-color: {{VALUE}};'
                ]               
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'exad_news_ticker_typography',
                'selector'      => '{{WRAPPER}} .exad-news-ticker ul li',
                'condition'     => [
                    '.exad_news_ticker_show_label' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'exad_news_ticker_each_item_padding',
            [
                'label'         => esc_html__( 'Padding Each Item(Left & Right)', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => [ 'px' ],
                'default'       => [
                    'size'      => 15
                ],
                'selectors'     => [
                    '{{WRAPPER}} .exad-news-ticker .exad-nt-news ul li' => 'padding: 0 {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'exad_news_ticker_label_style_heading',
            [
                'label'         => esc_html__( 'Label', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before'
            ]
        );

        $this->add_control(
            'exad_news_ticker_show_label',
            [
                'type'          => Controls_Manager::SWITCHER,
                'label'         => esc_html__( 'Show Label?', 'exclusive-addons-elementor' ),
                'default'       => 'yes',
                'return_value'  => 'yes'
            ]
        );  

        $this->add_control(
            'exad_news_ticker_label_color',
            [
                'label'     => esc_html__( 'Label Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .exad-news-ticker .bn-label' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    '.exad_news_ticker_show_label' => 'yes'
                ]                
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'exad_news_ticker_label_bg_color',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .exad-news-ticker .bn-label',
                'condition' => [
                    '.exad_news_ticker_show_label' => 'yes'
                ]                
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'exad_news_ticker_label_typography',
                'selector'      => '{{WRAPPER}} .exad-news-ticker .bn-label',
                'condition'     => [
                    '.exad_news_ticker_show_label' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'exad_news_ticker_label_padding',
            [
                'label'         => esc_html__( 'Padding(Left & Right)', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => [ 'px' ],
                'default'       => [
                    'size'      => 15
                ],
                'selectors'     => [
                    '{{WRAPPER}} .exad-news-ticker .bn-label' => 'padding: 0 {{SIZE}}{{UNIT}};'
                ],               
                'condition'     => [
                    '.exad_news_ticker_show_label' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'exad_news_ticker_controls_style_heading',
            [
                'label'         => esc_html__( 'Controls', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::HEADING,
                'separator'     => 'before'
            ]
        );

        $this->add_control(
            'exad_news_ticker_show_controls',
            [
                'type'          => Controls_Manager::SWITCHER,
                'label'         => esc_html__( 'Show Controls?', 'exclusive-addons-elementor' ),
                'default'       => 'yes',
                'return_value'  => 'yes'
            ]
        );  

        $this->add_control(
            'exad_news_ticker_controls_bg_color',
            [
                'label'     => esc_html__( 'Controls Background Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f6f6f6',
                'selectors' => [
                    '{{WRAPPER}} .exad-news-ticker .exad-nt-controls button' => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    '.exad_news_ticker_show_controls' => 'yes'
                ]                
            ]
        );

        $this->end_controls_section();

    }

    private function exad_news_ticker_data_attr_implode( $array ){
        
        foreach ($array as $key => $value) {

            if( isset($value) &&  $value != '' ){
                $output[] = $key . '=' . '"'. esc_attr( $value ) . '"' ;
            }
        }

        return implode( ' ', $output );
    }

    protected function render() {
        $settings       = $this->get_settings_for_display();
        $label          = $settings['exad_news_ticker_label'];
        $show_label     = $settings['exad_news_ticker_show_label'];
        $direction      = $settings['exad_news_ticker_animation_direction'];
        $ticker_height  = $settings['exad_news_ticker_height'];
        $autoplay       = $settings['exad_news_ticker_autoplay'];
        $bottom_fixed   = $settings['exad_news_ticker_set_bottom_fixed'];
        $animation_type = $settings['exad_news_ticker_animation_type'];

        ( $animation_type == 'scroll' ) ? $animation_speed = $settings['exad_news_ticker_animation_speed'] : $animation_speed = '';
        ( $animation_type != 'scroll' ) ? $autoplay_interval = $settings['exad_news_ticker_autoplay_interval'] : $autoplay_interval = '';
        ( $autoplay == 'yes' ) ? $pause_on_hover = $settings['exad_news_ticker_pause_on_hover'] : $pause_on_hover = '';

        $controls     = array('exad-news-ticker');
        $exad_nt_attr    = array(
            'data-autoplay'          => esc_attr( $autoplay == 'yes' ? 'true' : 'false' ),
            'data-bottom_fixed'      => esc_attr( $bottom_fixed == 'yes' ? 'fixed-bottom' : 'false' ),
            'data-pause_on_hover'    => esc_attr( $pause_on_hover == 'yes' ? 'true' : 'false' ),
            'data-autoplay_interval' => esc_attr( $autoplay_interval ),
            'data-direction'         => ( (is_rtl() || $direction == 'rtl') ? 'rtl' : 'ltr' ),
            'data-animation_speed'   => esc_attr( $animation_speed ),
            'data-ticker_height'     => esc_attr( $ticker_height ),
            'data-animation'         => esc_attr( $animation_type )
        );

        echo '<div class="'.esc_attr( implode(' ', $controls) ).'"'.$this->exad_news_ticker_data_attr_implode( $exad_nt_attr ).'>';
            ( $label && ($show_label == 'yes') ) ? printf('<div class="bn-label">%s</div>', esc_html($label)) : '';
            echo '<div class="exad-nt-news">';
                if( is_array( $settings['exad_news_ticker_items'] ) ) : 
                    echo '<ul>';
                        foreach ( $settings['exad_news_ticker_items'] as $list ) :
                            if ( $list['link']['url'] ) :
                                if ( $list['link']['is_external'] === 'on' ) {
                                    $target = 'target= _blank';
                                } else {
                                    $target = '';
                                }
                                if ( $list['link']['nofollow'] === 'on' ) {
                                    $target .= ' rel= nofollow ';
                                }      
                                echo '<li><a href="'. esc_url( $list['link']['url'] ) .'" '. esc_attr( $target ) .'>'. wp_kses_post( $list['title'] ) .'</a></li>';
                            else :
                                echo '<li>'.wp_kses_post( $list['title'] ) .'</li>';
                            endif;
                        endforeach; 
                    echo '</ul>';
                endif;
            echo '</div>';
            if ($settings['exad_news_ticker_show_controls'] == 'yes') :
                echo '<div class="exad-nt-controls">';
                    echo '<button><span class="bn-arrow bn-prev"></span></button>';
                    echo '<button><span class="bn-action"></span></button>';
                    echo '<button><span class="bn-arrow bn-next"></span></button>';
                echo '</div>';
            endif;
        echo '</div>';
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new ExadNewsTicker() );