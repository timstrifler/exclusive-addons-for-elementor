<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Google_Reviews extends Widget_Base {

    protected $google_place_url = "https://maps.googleapis.com/maps/api/place/";

    public function get_name() {
        return 'exad-google-reviews';
    }
    public function get_title() {
        return esc_html__( 'Google Reviews', 'exclusive-addons-elementor' );
    }
    public function get_icon() {
        return 'exad exad-logo exad-google-map';
    }
    public function get_categories() {
        return [ 'exclusive-addons-elementor' ];
    }
    public function get_keywords() {
        return [ 'google reviews', 'reviews', 'google' ];
    }
	public function get_style_depends() {
		return [ 'font-awesome' ];
	}
    public function get_script_depends() {
		return [ 'exad-google-map-api', 'exad-gmap3', 'swiper' ];
	} 

    protected function register_controls() {

		$api_key     = get_option('exad_google_map_api_option');
		$admin_link = admin_url( 'admin.php?page=exad-settings' );
        $exad_primary_color = get_option( 'exad_primary_color_option', '#7a56ff' );

        /**
  		 * Google Reviews Settings
  		 */
  		$this->start_controls_section(
            'exad_section_google_reviews_access',
            [
                'label' => esc_html__( 'Access Credentials', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'exad_google_place_id',
            [
                'label'       => esc_html__( 'Place ID', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Google Place ID', 'exclusive-addons-elementor' ),
                'description' => sprintf( __( 'Click %1s HERE %2s to find place ID  ', 'exclusive-addons-elementor' ), '<a href="https://developers-dot-devsite-v2-prod.appspot.com/maps/documentation/javascript/examples/full/places-placeid-finder" target="_blank">', '</a>' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

		
        if( empty( $api_key ) ) {
		    $this->start_controls_section(
			    'exad_panel_notice',
			    [
				    'label' => __('Notice!', 'exclusive-addons-elementor'),
			    ]
		    );

			$this->add_control(
				'exad_google_reviews_map_api_key',
				[
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => sprintf( __( 'To display Google Reviews without an issue, you need to configure Google Map API key. Please configure API key from the "API Keys" tab <a href="%s" target="_blank" rel="noopener">here</a>.', 'exclusive-addons-elementor' ), $admin_link ),
					'content_classes' => 'elementor-control-raw-html exad-panel-notice'
				]
			);
  		
            $this->end_controls_section();
            
		    return;
        }

		$this->start_controls_section(
			'exad_google_review_language_section',
			[
				'label' => esc_html__( 'Language', 'exclusive-addons-elementor' ),
			]
		);

		$languageArr = array(
            ''=>'Language disable',
            'ar'=> 'Arabic',
            'bg'=> 'Bulgarian',
            'bn'=> 'Bengali',
            'ca'=> 'Catalan',
            'cs'=> 'Czech',
            'da'=> 'Danish',
            'de'=> 'German',
            'el'=> 'Greek',
            'en'=> 'English',
            'es'=> 'Spanish',
            'custom'=> 'Custom',
        );

        $languageArr = apply_filters( 'exad_google_reviews_language', $languageArr );

        $this->add_control(
            'exad_google_review_language',
            [
                'label'   => esc_html__( 'Filter Reviews language', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => $languageArr,
            ]
        );

        $this->add_control(
			'exad_google_review_language_custom',
			[
				'label'       => esc_html__( 'Custom Language', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => __( 'Your Language', 'exclusive-addons-elementor' ),
				'description' => sprintf(__('Please write your Language code here. It supports only language code. For the language code,  please look <a href="%s" target="_blank">here</a>
					 Please delete your transient if not works. You can simply delete transient from Layout ( Cache Reviews ) by on/off.'), 'http://www.lingoes.net/en/translator/langcode.htm'),
				'condition'	  => [
					'exad_google_review_language' => 'custom'
				]
			]
		);

		$this->end_controls_section();

		
        /**
  		* Layout Setting Content Tab
  		*/
        $this->start_controls_section(
            'exad_section_layout',
            [
                'label' => esc_html__( 'Reviews Content', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'exad_reload_reviews',
            [
				'label'   => esc_html__( 'Load Reviews', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'exad-day',
				'options' => [
					'exad-day'      => esc_html__( 'Day', 'exclusive-addons-elementor' ),
					'exad-hour'     => esc_html__( 'Hour', 'exclusive-addons-elementor' ),
					'exad-week'     => esc_html__( 'Week', 'exclusive-addons-elementor' ),
					'exad-month'    => esc_html__( 'Month', 'exclusive-addons-elementor' ),
					'exad-year'     => esc_html__( 'Year', 'exclusive-addons-elementor' )
				]
            ]
		);

		$this->add_control(
			'exad_load_reviews_by_rating_yes',
			[
				'label' => __('Review Display By Rating?', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$rating_base_reviews = range( 1, 5 );
		$rating_base_reviews = array_combine( $rating_base_reviews, $rating_base_reviews );

		$this->add_control(
			'exad_reload_reviews_by_rating',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Load Reviews by Ratings', 'exclusive-addons-elementor' ),
				'options' => $rating_base_reviews,
				'default' => '3',
				'condition' => [
					'exad_load_reviews_by_rating_yes' => 'yes'
				]
			]
		);

        $this->add_control(
			'exad_google_reviews_clear_cache',
			[
				'label' => __('Clear Cache', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
				'separator' => 'after',
			]
		);

        $this->add_control(
			'exad_google_reviews_show_user_image',
			[
				'label' => __('Reviewer image', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'exad_google_reviews_show_name',
			[
				'label' => __('Reviewer Name', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'exad_google_reviews_show_date',
			[
				'label' => __('Review Date', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'exad_google_reviews_show_rating',
			[
				'label'   => esc_html__( 'Reviewer Rating', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'exad_google_reviews_rating_icon',
			[
				'label' => __( 'Rating Icon', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => false,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'skin' => 'inline',
				'exclude_inline_options' => ['svg'],
				'condition' => [
					'exad_google_reviews_show_rating' => 'yes'
				]
			]
		);
		
		$this->add_control(
            'exad_google_reviews_rating_layout',
            [
				'label'   => esc_html__( 'Rating Show', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'below-author-name',
				'options' => [
					'below-author-name'     => esc_html__( 'Below Author Name', 'exclusive-addons-elementor' ),
					'above-description'     => esc_html__( 'Above Description', 'exclusive-addons-elementor' ),
					'below-description'     => esc_html__( 'Below Description', 'exclusive-addons-elementor' ),
				]
            ]
		);

		$this->add_control(
			'exad_google_reviews_show_excerpt',
			[
				'label'   => esc_html__( 'Show Reviewer Content', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
				'default' => 'yes',
			]
        );

		$this->add_control(
			'exad_google_reviews_excerpt_limit',
			[
				'label'     => esc_html__( 'Reviewer Content Limit', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 75,
				'condition' => [
					'exad_google_reviews_show_excerpt' => 'yes',
				],
			]
		);

        $this->end_controls_section();

		/**
  		* Carousel Setting Content Tab
  		*/
        $this->start_controls_section(
			'exad_section_carousel_settings',
			[
				'label' => esc_html__( 'Carousel Settings', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$slides_per_view = range( 1, 6 );
		$slides_per_view = array_combine( $slides_per_view, $slides_per_view );

		$this->add_control(
            'exad_google_reviews_carousel_nav',
            [
                'label'   => esc_html__( 'Navigation Style', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'arrows',
                'options' => [
					'arrows'   => esc_html__( 'Arrows', 'exclusive-addons-elementor' ),
					'nav-dots' => esc_html__( 'Dots', 'exclusive-addons-elementor' ),
					'dynamic-dots' => esc_html__( 'Dynamic Bullets', 'exclusive-addons-elementor' ),
					'both'     => esc_html__( 'Arrows and Dots', 'exclusive-addons-elementor' ),
					'none'     => esc_html__( 'None', 'exclusive-addons-elementor' )                    
                ]
            ]
        );

		$this->add_responsive_control(
			'slider_per_view',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Columns', 'exclusive-addons-elementor' ),
				'options' => $slides_per_view,
				'default' => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
			]
		);

		$this->add_responsive_control(
			'exad_google_reviews_column_space',
			[
				'label' => __( 'Column Space', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 30,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				]
			]
		);

		$this->add_control(
			'exad_google_reviews_slides_to_scroll',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Items to Scroll', 'exclusive-addons-elementor' ),
				'options' => $slides_per_view,
				'default'        => 1,
				'tablet_default' => 1,
				'mobile_default' => 1,
			]
		);

		$this->add_control(
			'exad_google_reviews_slides_per_column',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Slides Per Column', 'exclusive-addons-elementor' ),
				'options'   => $slides_per_view,
				'default'   => '1',
			]
		);
		
		$this->add_control(
			'exad_google_reviews_transition_duration',
			[
				'label'   => esc_html__( 'Transition Duration', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 1000
			]
		);

		$this->add_control(
			'exad_google_reviews_autoheight',
			[
				'label'     => esc_html__( 'Auto Height', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes'
			]
		);

		$this->add_control(
			'exad_google_reviews_autoplay',
			[
				'label'     => esc_html__( 'Autoplay', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes'
			]
		);

		$this->add_control(
			'exad_google_reviews_autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'exad_google_reviews_autoplay' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_google_reviews_loop',
			[
				'label'   => esc_html__( 'Infinite Loop', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);

		$this->add_control(
			'exad_google_reviews_pause',
			[
				'label'     => esc_html__( 'Pause on Hover', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'exad_google_reviews_autoplay' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_google_reviews_slide_centered',
			[
				'label'       => esc_html__( 'Centered Mode Slide', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SWITCHER,
				'default'   => 'no',
			]
		);
		
		$this->add_control(
			'exad_google_reviews_grab_cursor',
			[
				'label'       => esc_html__( 'Grab Cursor', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SWITCHER,
				'default'   => 'no',
			]
		);

		$this->add_control(
			'exad_google_reviews_observer',
			[
				'label'       => esc_html__( 'Observer', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SWITCHER,
				'default'   => 'no',
			]
		);

		$this->end_controls_section();

		/*
		* Google Reviews Carousel container Styling Section
		*/
		$this->start_controls_section(
			'exad_section_google_reviews_container_style',
			[
				'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_google_reviews_carousel_layout',
			[
				'label' => __( 'Layout', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Layout 1', 'exclusive-addons-elementor' ),
					'layout-2' => __( 'Layout 2', 'exclusive-addons-elementor' ),
				],
			]
		);

		$this->add_control(
			'exad_google_reviews_carousel_container_alignment',
			[
				'label'   => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'default' => 'exad-google-reviews-align-left',
				'options' => [
					'exad-google-reviews-align-left'   => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-arrow-left'
					],
					'exad-google-reviews-align-center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-arrow-up'
					],
					'exad-google-reviews-align-right'  => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-arrow-right'
					],
					'exad-google-reviews-align-bottom' => [
						'title' => __( 'Bottom', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-arrow-down'
					]
				]
			]
		);

		$this->add_responsive_control(
			'exad_google_reviews_carousel_container_margin_top',
			[
				'label' => __( 'Top Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'separator'  => 'before',
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-google-reviews-wrapper' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'exad_google_review_carousel_container_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-google-reviews-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_google_review_carousel_container_radius',
			[
				'label'      => __( 'Border radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'after',
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10',
					'isLinked' => true
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-google-reviews-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'exad_google_review_carousel_container_tabs' );

			$this->start_controls_tab( 'exad_google_review_carousel_container_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'exad_google_review_carousel_container_background',
					'types'    => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .exad-google-reviews-wrapper'
				]
			);
	
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'            => 'exad_google_review_carousel_container_border',
					'fields_options'  => [
						'border'      => [
							'default' => 'solid'
						],
						'width'          => [
							'default'    => [
								'top'    => '1',
								'right'  => '1',
								'bottom' => '1',
								'left'   => '1',
								'isLinked' => true
							]
						],
						'color'       => [
							'default' => '#e3e3e3'
						]
					],
					'selector'        => '{{WRAPPER}} .exad-google-reviews-wrapper'
				]
			);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_google_review_carousel_container_box_shadow',
				'selector' => '{{WRAPPER}} .exad-google-reviews-wrapper'
			]
		);

		$this->end_controls_tab();
	
		$this->start_controls_tab( 'exad_google_review_carousel_container_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'exad_google_review_carousel_container_background_hover',
				'types'     => [ 'classic' ],
				'selector'  => '{{WRAPPER}} .exad-google-reviews-wrapper:hover'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'            => 'exad_google_review_carousel_container_border_hover',
				'fields_options'  => [
					'border'      => [
						'default' => 'solid'
					],
					'width'          => [
						'default'    => [
							'top'    => '1',
							'right'  => '1',
							'bottom' => '1',
							'left'   => '1'
						]
					],
					'color'       => [
						'default' => '#e3e3e3'
					]
				],
				'selector'        => '{{WRAPPER}} .exad-google-reviews-wrapper:hover'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_google_review_carousel_container_box_shadow_hover',
				'selector' => '{{WRAPPER}} .exad-google-reviews-wrapper:hover'
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();	

		$this->add_control(
			'exad_google_review_carousel_container_transition_top',
            [
				'label'        => __( 'Transition Top', 'exclusive-addons-elementor' ),
				'type'         =>  Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Hide', 'exclusive-addons-elementor' ),
				'separator'   => 'before',
				'return_value' => 'yes',
				'default'      => 'yes'
			]
        );

		$this->end_controls_section();

		/**
		 * Google Reviews Carousel Description Style Section
		 */
		$this->start_controls_section(
			'exad_google_reviews_carousel_description_style',
			[
				'label' => esc_html__( 'Reviewer Content', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_google_reviews_carousel_description_bg_color',
			[
				'label' => __( 'Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .exad-google-reviews-content-wrapper' => 'background: {{VALUE}};',
					'{{WRAPPER}} .exad-google-reviews-content-wrapper-arrow::before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'exad_google_reviews_carousel_description_color',
			[
				'label' => __( 'Text Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-google-reviews-description p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_google_reviews_carousel_description_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-google-reviews-description p',
			]
		);

		$this->add_responsive_control(
			'exad_google_reviews_carousel_description_spacing_top',
			[
				'label' => __( 'Top Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-google-reviews-content-wrapper' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'exad_google_reviews_carousel_description_spacing_bottom',
			[
				'label' => __( 'Bottom Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-google-reviews-content-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'exad_google_reviews_carousel_description_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-google-reviews-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'exad_google_reviews_carousel_description_radius',
			[
				'label' => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-google-reviews-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_google_reviews_carousel_description_box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-google-reviews-content-wrapper',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'exad_google_reviews_carousel_description_border',
				'selector'  => '{{WRAPPER}} .exad-google-reviews-content-wrapper',
			]
		);
		
		$this-> end_controls_section();

		/**
		 * Google Reviews Carousel Rating Style
		 */

		$this->start_controls_section(
			'exad_google_reviews_carousel_rating_style',
			[
				'label' => esc_html__( 'Rating', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'exad_google_reviews_carousel_rating_size',
			[
				'label' => __( 'Icon Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-google-reviews-carousel-ratings ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'exad_google_reviews_carousel_rating_icon_margin',
			[
				'label' => __( 'Icon Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 30,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-google-reviews-carousel-ratings ul li:not(:last-child) i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'exad_google_reviews_carousel_rating_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-google-reviews-carousel-ratings' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'exad_google_reviews_carousel_rating_tabs' );

			// normal state rating
			$this->start_controls_tab( 'exad_google_reviews_carousel_rating_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_google_reviews_carousel_rating_normal_color',
					[
						'label' => __( 'Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#222222',
						'selectors' => [
							'{{WRAPPER}} .exad-google-reviews-carousel-ratings ul li i' => 'color: {{VALUE}};',
						],
					]
				);

			$this->end_controls_tab();

			// hover state rating
			$this->start_controls_tab( 'exad_google_reviews_carousel_rating_active', [ 'label' => esc_html__( 'Active', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_google_reviews_carousel_rating_active_color',
					[
						'label' => __( 'Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#ff5b84',
						'selectors' => [
							'{{WRAPPER}} .exad-google-reviews-carousel-ratings ul li.exad-google-reviews-ratings-active i' => 'color: {{VALUE}};',
						],
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this-> end_controls_section();
		
		/**
		 * Google Reviews Carousel Image Style Section
		 */
		$this->start_controls_section(
			'exad_google_review_carousel_image_style',
			[
				'label' => esc_html__( 'Reviewer Image', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'exad_google_review_carousel_image_height',
			[
				'label'       => __( 'Height', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 80
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-google-reviews-thumb'=> 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'exad_google_review_carousel_image_width',
			[
				'label'       => __( 'Width', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'separator'   => 'after',
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 80
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-google-reviews-thumb'=> 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-google-reviews-image-align-left .exad-google-reviews-thumb, {{WRAPPER}} .exad-google-reviews-image-align-right .exad-google-reviews-thumb'=> 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-google-reviews-image-align-left .exad-google-reviews-reviewer, {{WRAPPER}} .exad-google-reviews-image-align-right .exad-google-reviews-reviewer'=> 'width: calc( 100% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .exad-google-reviews-wrapper.exad-google-reviews-align-left .exad-google-reviews-content-wrapper-arrow::before'=> 'left: calc( {{SIZE}}{{UNIT}} / 2 );',
					'{{WRAPPER}} .exad-google-reviews-wrapper.exad-google-reviews-align-right .exad-google-reviews-content-wrapper-arrow::before'=> 'right: calc(( {{SIZE}}{{UNIT}} / 2) - 10px);'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'exad_google_review_carousel_image_box_border',
				'selector'  => '{{WRAPPER}} .exad-google-reviews-thumb',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_google_review_carousel_image_shadow',
				'selector' => '{{WRAPPER}} .exad-google-reviews-thumb'
			]
		);

		$this->add_responsive_control(
			'exad_google_review_carousel_image_box_margin_bottom',
			[
				'label'       => __( 'Bottom Spacing', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => -500,
						'max' => 500
					],
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 0
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-google-reviews-thumb'=> 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
				'condition'   => [
					'exad_google_reviews_carousel_container_alignment' => 'exad-google-reviews-align-bottom'
				]
			]
		);

		$this-> end_controls_section();

		/**
		 * Google Reviews Style Section
		 */
		$this->start_controls_section(
			'exad_google_reviews_carousel_reviewer_style',
			[
				'label' => esc_html__( 'Rivewer', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'exad_google_reviews_carousel_reviewer_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-google-reviews-reviewer-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'exad_google_reviews_carousel_reviewer_spacing',
			[
				'label' => __( 'Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-google-reviews-wrapper.exad-google-reviews-align-left .exad-google-reviews-reviewer-wrapper .exad-google-reviews-reviewer' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-google-reviews-wrapper.exad-google-reviews-align-right .exad-google-reviews-reviewer-wrapper .exad-google-reviews-reviewer' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'exad_google_reviews_carousel_container_alignment' => ['exad-google-reviews-align-left', 'exad-google-reviews-align-right'],
				]
			]
		);

		/**
		 * Google Reviews Title Style Section
		 */

		$this->add_control(
			'exad_google_reviews_carousel_title_style',
			[
				'label' => __( 'Reviewer Title', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_google_reviews_carousel_title_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-author-name a',
			]
		);

		$this->add_control(
			'exad_google_reviews_carousel_title_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-author-name a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'exad_google_reviews_carousel_title_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-author-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		/**
		 * Google Reviews Designation Style Section
		 */

		$this->add_control(
			'exad_google_reviews_carousel_designation_style',
			[
				'label' => __( 'Reviewer Date', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_google_reviews_carousel_date',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-google-reviews-date',
			]
		);

		$this->add_control(
			'exad_google_reviews_carousel_designation_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-google-reviews-date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'exad_google_reviews_carousel_designation_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-google-reviews-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this-> end_controls_section();

		/**
		 * Arrows Style
		 */
		$this->start_controls_section(
            'exad_google_reviews_carousel_nav_arrow',
            [
                'label'     => esc_html__( 'Arrows', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_google_reviews_carousel_nav' => ['arrows', 'both'],
                ],
            ]
        );

        $this->add_responsive_control(
            'exad_google_reviews_carousel_nav_arrow_box_size',
            [
                'label'      => __( 'Box Size', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-prev' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'exad_google_reviews_carousel_nav_arrow_icon_size',
            [
                'label'      => __( 'Icon Size', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-prev i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-next i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'exad_google_reviews_carousel_prev_arrow_position',
            [
                'label'        => __( 'Previous Arrow Position', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __( 'Default', 'exclusive-addons-elementor' ),
                'label_on'     => __( 'Custom', 'exclusive-addons-elementor' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        
        $this->start_popover();

            $this->add_responsive_control(
                'exad_google_reviews_carousel_prev_arrow_position_x_offset',
                [
                    'label'      => __( 'X Offset', 'exclusive-addons-elementor' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range'      => [
                        'px' => [
                            'min' => -3000,
                            'max' => 3000,
                        ],
                        '%'  => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default'    => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-prev' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'exad_google_reviews_carousel_prev_arrow_position_y_offset',
                [
                    'label'      => __( 'Y Offset', 'exclusive-addons-elementor' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range'      => [
                        'px' => [
                            'min' => -3000,
                            'max' => 3000,
                        ],
                        '%'  => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default'    => [
                        'unit' => '%',
                        'size' => 50,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-prev' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_popover();

        $this->add_control(
            'exad_google_reviews_carousel_next_arrow_position',
            [
                'label'        => __( 'Next Arrow Position', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __( 'Default', 'exclusive-addons-elementor' ),
                'label_on'     => __( 'Custom', 'exclusive-addons-elementor' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        
        $this->start_popover();

            $this->add_responsive_control(
                'exad_google_reviews_carousel_next_arrow_position_x_offset',
                [
                    'label'      => __( 'X Offset', 'exclusive-addons-elementor' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range'      => [
                        'px' => [
                            'min' => -3000,
                            'max' => 3000,
                        ],
                        '%'  => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default'    => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-next' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'exad_google_reviews_carousel_next_arrow_position_y_offset',
                [
                    'label'      => __( 'Y Offset', 'exclusive-addons-elementor' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range'      => [
                        'px' => [
                            'min' => -3000,
                            'max' => 3000,
                        ],
                        '%'  => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default'    => [
                        'unit' => '%',
                        'size' => 50,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-next' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_popover();

        $this->add_responsive_control(
            'exad_google_reviews_carousel_nav_arrow_radius',
            [
                'label'      => __( 'Border radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'      => '50',
                    'right'    => '50',
                    'bottom'   => '50',
                    'left'     => '50',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'exad_google_reviews_carousel_nav_arrow_tabs' );

			// normal state rating
			$this->start_controls_tab( 'exad_google_reviews_carousel_nav_arrow_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_google_reviews_carousel_arrow_normal_background',
                    [
                        'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   =>  $exad_primary_color,
                        'selectors' => [
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-prev' => 'background: {{VALUE}}',
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-next' => 'background: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'exad_google_reviews_carousel_arrow_normal_color',
                    [
                        'label'     => __( 'Icon Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-prev i' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-next i' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'exad_google_reviews_carousel_arrow_normal_border',
                        'label'    => __( 'Border', 'exclusive-addons-elementor' ),
                        'selector' => '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-prev, {{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-next',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'exad_google_reviews_carousel_arrow_normal_shadow',
                        'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
                        'selector' => '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-prev, {{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-next',
                    ]
                );

			$this->end_controls_tab();

			// hover state rating
			$this->start_controls_tab( 'exad_google_reviews_carousel_nav_arrow_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

                $this->add_control(
                    'exad_google_reviews_carousel_arrow_hover_background',
                    [
                        'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => $exad_primary_color,
                        'selectors' => [
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-prev:hover' => 'background: {{VALUE}}',
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-next:hover' => 'background: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'exad_google_reviews_carousel_arrow_hover_color',
                    [
                        'label'     => __( 'Icon Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-prev:hover i' => 'color: {{VALUE}}',
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-next:hover i' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'exad_google_reviews_carousel_arrow_hover_border',
                        'label'    => __( 'Border', 'exclusive-addons-elementor' ),
                        'selector' => '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-prev:hover, {{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-next:hover',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'exad_google_reviews_carousel_arrow_hover_shadow',
                        'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
                        'selector' => '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-prev:hover, {{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-carousel-nav-next:hover',
                    ]
                );

			$this->end_controls_tab();

        $this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Dots Style
		 */
		
		$this->start_controls_section(
            'exad_google_reviews_carousel_nav_dot',
            [
                'label'     => esc_html__( 'Dots', 'exclusive-addons-elementor' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'exad_google_reviews_carousel_nav' => ['nav-dots', 'both', 'dynamic-dots'],
                ],
            ]
        );

        $this->add_control(
            'exad_google_reviews_carousel_nav_dot_alignment',
            [
                'label'   => __( 'Alignment', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'exad-google-reviews-carousel-dots-left'   => [
                        'title' => __( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'exad-google-reviews-carousel-dots-center' => [
                        'title' => __( 'Center', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'exad-google-reviews-carousel-dots-right'  => [
                        'title' => __( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default' => 'exad-google-reviews-carousel-dots-center',
            ]
        );

        $this->add_responsive_control(
            'exad_google_reviews_carousel_dots_top_spacing',
            [
                'label'      => __( 'Top Spacing', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-swiper-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
			'exad_google_reviews_carousel_dots_spacing_btwn',
			[
				'label' => __( 'Dot Space', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-swiper-pagination .swiper-pagination-bullet:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				]
			]
		);

        $this->add_responsive_control(
            'exad_google_reviews_carousel_nav_dot_radius',
            [
                'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => true,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-swiper-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'exad_google_reviews_carousel_nav_dots_tabs' );

			// normal state rating
            $this->start_controls_tab( 'exad_google_reviews_carousel_nav_dots_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

                $this->add_responsive_control(
                    'exad_google_reviews_carousel_dots_normal_height',
                    [
                        'label'      => __( 'Height', 'exclusive-addons-elementor' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'range'      => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default'    => [
                            'unit' => 'px',
                            'size' => 10,
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-swiper-pagination .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

				$this->add_responsive_control(
                    'exad_google_reviews_carousel_dots_normal_width',
                    [
                        'label'      => __( 'Width', 'exclusive-addons-elementor' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'range'      => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default'    => [
                            'unit' => 'px',
                            'size' => 10,
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-swiper-pagination .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'exad_google_reviews_carousel_dots_normal_background',
                    [
                        'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#e5e5e5',
                        'selectors' => [
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-swiper-pagination .swiper-pagination-bullet' => 'background: {{VALUE}};',
                        ],
                    ]
                );
				
				$this->add_responsive_control(
                    'exad_google_reviews_carousel_dots_normal_opacity',
                    [
                        'label'     => __( 'Opacity', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::SLIDER,
                        'default' => [
							'size' => 1,
						],
						'range' => [
							'px' => [
								'max' => 1,
								'step' => 0.01,
							],
						],
                        'selectors' => [
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-swiper-pagination .swiper-pagination-bullet' => 'opacity: {{SIZE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'exad_google_reviews_carousel_dots_normal_border',
                        'label'    => __( 'Border', 'exclusive-addons-elementor' ),
                        'selector' => '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-swiper-pagination .swiper-pagination-bullet',
                    ]
                );

			$this->end_controls_tab();

			// hover state rating
            $this->start_controls_tab( 'exad_google_reviews_carousel_nav_dots_hover', [ 'label' => esc_html__( 'Hover/active', 'exclusive-addons-elementor' ) ] );
            
                $this->add_responsive_control(
                    'exad_google_reviews_carousel_dots_active_height',
                    [
                        'label'      => __( 'Height', 'exclusive-addons-elementor' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => ['px', '%'],
                        'range'      => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default'    => [
                            'unit' => 'px',
                            'size' => 10,
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-swiper-pagination .swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

				$this->add_responsive_control(
                    'exad_google_reviews_carousel_dots_active_width',
                    [
                        'label'      => __( 'Width', 'exclusive-addons-elementor' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => ['px', '%'],
                        'range'      => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default'    => [
                            'unit' => 'px',
                            'size' => 10,
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-swiper-pagination .swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'exad_google_reviews_carousel_dots_active_background',
                    [
                        'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => $exad_primary_color,
                        'selectors' => [
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-swiper-pagination .swiper-pagination-bullet-active' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-swiper-pagination .swiper-pagination-bullet:hover' => 'background: {{VALUE}};',
                        ],
                    ]
                );

				$this->add_responsive_control(
                    'exad_google_reviews_carousel_dots_hover_opacity',
                    [
                        'label'     => __( 'Opacity', 'exclusive-addons-elementor' ),
                        'type'      => Controls_Manager::SLIDER,
						'default' => [
							'size' => 1,
						],
						'range' => [
							'px' => [
								'max' => 1,
								'step' => 0.01,
							],
						],
                        'selectors' => [
							'{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-swiper-pagination .swiper-pagination-bullet-active' => 'opacity: {{SIZE}};',
                            '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-swiper-pagination .swiper-pagination-bullet:hover' => 'opacity: {{SIZE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'exad_google_reviews_carousel_dots_active_border',
                        'label'    => __( 'Border', 'exclusive-addons-elementor' ),
                        'selector' => '{{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-swiper-pagination .swiper-pagination-bullet-active, {{WRAPPER}} .exad-google-reviews-carousel-wrapper .exad-swiper-pagination .swiper-pagination-bullet:hover',
                    ]
                );

			$this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();



    }

    public function get_transient_expire( $settings ) {

        $expire_value = $settings['exad_reload_reviews'];
        $expire_time  = 24 * HOUR_IN_SECONDS;

        if ( 'exad-hour' === $expire_value ) {
            $expire_time = 60 * MINUTE_IN_SECONDS;
        } elseif ( 'exad-week' === $expire_value ) {
            $expire_time = 7 * DAY_IN_SECONDS;
        } elseif ( 'exad-month' === $expire_value ) {
            $expire_time = 30 * DAY_IN_SECONDS;
        } elseif ( 'exad-year' === $expire_value ) {
            $expire_time = 365 * DAY_IN_SECONDS;
        }

        return $expire_time;
    }

    public function get_transient_key( $place_id ){
        $place_id = strtolower( $place_id );
        $transient = 'google_reviews_data_' . $place_id;
        return $transient;
    }

    public function get_api_url( $api_key, $place_id, $language){
        $url = $this->google_place_url . 'details/json?placeid=' . $place_id . '&key=' . $api_key;

		if (strlen($language) > 0) {
            $url = $url . '&language=' . $language;
        }

        return $url;
    }

	public function get_cache_data( $place_id ){
		$settings   = $this->get_settings_for_display();
		
        $transient = $this->get_transient_key( $place_id );
        $data      = get_transient( $transient );

        if($settings['exad_google_reviews_clear_cache'] != 'yes'){
        	 delete_transient( $transient );
        }

        if(is_array( $data ) && count( $data ) > 0){
            if( $place_id == $data['place_id'] ){
                return $data;
            } else {
                delete_transient($transient);
            }
        }
        return false;
	}

    public function getReviews(){

        $settings   = $this->get_settings_for_display();
        $place_id = $settings['exad_google_place_id'];
        $api_key     = get_option('exad_google_map_api_option');

		$language = '';

    	if(isset($settings['exad_google_review_language'])){
    		if($settings['exad_google_review_language'] == 'custom'){
    			if(empty($settings['exad_google_review_language_custom'])){
    				$language = '';
    			}else{
    				$language = esc_html($settings['exad_google_review_language_custom']);
    			}
    		}else{
    			$language = esc_html($settings['exad_google_review_language']);
    		}
    	}else{
    		$language = '';
    	}

        if(!$place_id || !$api_key){
            return false;
        }

        $reviewData = $this->get_cache_data( $place_id );

        if( $reviewData ){
            return $reviewData;
        }else{
            $requestUrl = $this->get_api_url( $api_key, $place_id, $language );  

            $response = wp_remote_get( $requestUrl );

            if (is_wp_error( $response ) ) {
                return array( 'error_message'=>$response->get_error_message() );
            }
            $response   = json_decode( $response[ 'body' ],true );
            $result     = ( isset($response['result']) && is_array( $response['result'] ) )?$response['result']:'';

            if(is_array( $result )){

                if(isset( $result['error_message'] ) ){
                    return $result;
                }

                $transient = $this->get_transient_key( $place_id );
                $expireTime = $this->get_transient_expire( $settings );

                set_transient( $transient, $result, $expireTime );
                return $result;
            }
            return $response;
        }
    }

    /**
	 * Rating content.
	 */
	private function render_google_reviews_rating( $ratings, $client_rating ) {
		$settings = $this->get_settings_for_display();
		$rating_output = '';

		$rating_output .= '<div class="exad-google-reviews-carousel-ratings">';
			$rating_output .= '<ul class="exad-google-reviews-ratings">';
				for( $rating = 1; $rating <= 5; $rating++ ) {
					if( $client_rating >= $rating ) {
						$rating_output .= '<li class="exad-google-reviews-ratings-active"><i class="'.$settings['exad_google_reviews_rating_icon']['value'].'"></i></li>';
					}else {
						$rating_output .= '<li><i class="'.$settings['exad_google_reviews_rating_icon']['value'].'"></i></li>';
					}
				}
			$rating_output .= '</ul>';
		$rating_output .= '</div>';

		return $rating_output;
	}

	/**
	 * Reviewer Thumbnails.
	 * 
	 */
	private function render_google_reviews_thumb( $settings, $client_name, $client_url, $client_photoUrl ) {
		$settings = $this->get_settings_for_display();
		$thumb_output = '';

		$thumb_output .= '<div class="exad-google-reviews-thumb">';
			$thumb_output .= '<a href="' . esc_url( $client_url ) . '" target="_blank">';
				$thumb_output .= '<img src="' . esc_url($client_photoUrl) . '" alt="' . esc_html($client_name) . '">';
			$thumb_output .= '</a>';
		$thumb_output .= '</div>';

		return $thumb_output;
	}

	 /**
	 * Reviewer content.
	 * ( name, description, rating, review date ) etc.
	 */
	private function render_google_reviews_content( $settings, $client_name, $client_rating, $client_url, $client_photoUrl, $human_time ) {
		$settings = $this->get_settings_for_display();
		$content_output = '';

		$content_output .= '<div class="exad-google-reviews-reviewer">';
			if ( $settings['exad_google_reviews_show_name'] == 'yes' ) :
				$content_output .= '<h4 class="exad-author-name">';
					$content_output .= '<a href="'. esc_url( $client_url ) . '">' . esc_html( $client_name ) . '</a>';
				$content_output .= '</h4>';
			endif;
			if ( $settings['exad_google_reviews_show_date'] == 'yes' ) :
				$content_output .= '<div class="exad-google-reviews-date">' . esc_html( date("M d Y", strtotime( $human_time ) ) ) . '</div>';
			endif;
		if ( 'yes' === $settings['exad_google_reviews_show_rating'] && 'below-author-name' == $settings['exad_google_reviews_rating_layout']) :
			$content_output .=  $this->render_google_reviews_rating( $settings['exad_google_reviews_rating_icon'], $client_rating );
		endif;
		$content_output .= '</div>';

		if ( $settings['exad_google_reviews_show_user_image'] == 'yes' && 'exad-google-reviews-align-bottom' == $settings['exad_google_reviews_carousel_container_alignment'] ) :
		$content_output .= '<div class="exad-google-reviews-thumb">';
			$content_output .= '<a href="<?php echo esc_url( $client_url ); ?>" target="_blank">';
				$content_output .= '<img src="' . esc_url($client_photoUrl) .'" alt="' . esc_html($client_name) . '">';
			$content_output .= '</a>';
		$content_output .= '</div>';
		endif;
		
		return $content_output;
	}

    protected function render() {
        $settings = $this->get_settings_for_display();
		$transition_top = '';
		$carousel_id    = 'exad-google-reviews-carousel-' . $this->get_id();
        $direction 		= is_rtl() ? 'true' : 'false';
        $place_id  		= $settings['exad_google_place_id'];
        $api_key   		= get_option('exad_google_map_api_option');
        $reviewData  	= $this->getReviews();
        $GReviews 		= isset($reviewData['reviews']) ? $reviewData['reviews']: [];

		$elementor_viewport_lg = get_option( 'elementor_viewport_lg' );
		$elementor_viewport_md = get_option( 'elementor_viewport_md' );
		$exad_viewport_lg      = !empty($elementor_viewport_lg) ? $elementor_viewport_lg - 1 : 1023;
		$exad_viewport_md      = !empty($elementor_viewport_md) ? $elementor_viewport_md - 1 : 767;

        $this->add_render_attribute(
			'exad-google-reviews-wrapper',
			[	
				'id' => "exad-facebook-feed-wrapper",
				'class' => ""
			]
		);

		if ( !empty( $api_key ) ):

			$this->add_render_attribute( 
				'exad-google-reviews-carousel', 
				[ 
					'id' 				  => $carousel_id,
					'class'               => [ 'exad-google-reviews-carousel-wrapper exad-google-reviews-carousel exad-carousel-item' ],
				]
			);
	
			$carousel_data_settings = wp_json_encode(
				array_filter([
					"autoplay"           	=> $settings["exad_google_reviews_autoplay"] ? true : false,
					"delay" 				=> $settings["exad_google_reviews_autoplay_speed"] ? true : false,
					"loop"           		=> $settings["exad_google_reviews_loop"] ? true : false,
					"speed"       			=> $settings["exad_google_reviews_transition_duration"],
					"pauseOnHover"       	=> $settings["exad_google_reviews_pause"] ? true : false,
					"slidesPerView"         => isset($settings["slider_per_view_mobile"]) ? (int)$settings["slider_per_view_mobile"] : 1,
					"slidesPerColumn" 		=> ($settings["exad_google_reviews_slides_per_column"] > 1) ? $settings["exad_google_reviews_slides_per_column"] : false,
					"centeredSlides"        => $settings["exad_google_reviews_slide_centered"] ? false : true,
					"spaceBetween"   		=> $settings['exad_google_reviews_column_space']['size'],
					"grabCursor"  			=> ($settings["exad_google_reviews_grab_cursor"] === "yes") ? true : false,
					"observer"       		=> ($settings["exad_google_reviews_observer"]) ? true : false,
					"observeParents" 		=> ($settings["exad_google_reviews_observer"]) ? true : false,
					"breakpoints"     		=> [

						(int) $exad_viewport_md 	=> [
							"slidesPerView" 	=> isset($settings["slider_per_view_tablet"]) ? (int)$settings["slider_per_view_tablet"] : 2,
							"spaceBetween"  	=> $settings["exad_google_reviews_column_space"]["size"],
							
						],
						(int) $exad_viewport_lg 	=> [
							"slidesPerView" 	=> (int)$settings["slider_per_view"],
							"spaceBetween"  	=> $settings["exad_google_reviews_column_space"]["size"],
							
						]
					],
					"pagination" 			 	=>  [ 
						"el" 				=> "#". $carousel_id . " .exad-swiper-pagination ",
						"type"       		=> "bullets",
			      		"clickable"  		=> true,
						'dynamicBullets' 	=> ( $settings["exad_google_reviews_carousel_nav"] == "dynamic-dots") ? true : false,
					],
					"navigation" => [
						"nextEl" => "#". $carousel_id . " .exad-carousel-nav-next",
						"prevEl" => "#". $carousel_id . " .exad-carousel-nav-prev",
					],

				])
			);
			$this->add_render_attribute( 'exad-google-reviews-carousel', 'data-settings',  $carousel_data_settings );
			$this->add_render_attribute( 'exad-google-reviews-carousel', 'class', esc_attr( $settings['exad_google_reviews_carousel_nav_dot_alignment'] ) );
		endif;

		$this->add_render_attribute( 'exad_google_reviews_content_wrapper', 'class', 'exad-google_reviews-content-wrapper' );

		if ( 'yes' === $settings['exad_google_review_carousel_container_transition_top'] ){
			$transition_top = 'exad-google-review-transition-top-'.$settings['exad_google_review_carousel_container_transition_top'];
		}

        ?>

        <div <?php echo $this->get_render_attribute_string( 'exad-google-reviews-wrapper' ); ?>>
            <div class="exad-google-reviews-items">
				<div <?php echo $this->get_render_attribute_string( 'exad-google-reviews-carousel' ); ?>>
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php
								foreach( $GReviews as $review ){ 
									$client_name         = $review['author_name'];
									$client_url          = $review['author_url'];
									$client_photoUrl     = $review['profile_photo_url'];
									$human_time          = $review['relative_time_description'];
									$client_text         = $review['text'];
									$client_rating       = $review['rating'];


									$description = explode( ' ', $review['text'] );
									if ( !empty( $settings['exad_google_reviews_excerpt_limit'] ) && count( $description ) > $settings['exad_google_reviews_excerpt_limit'] ) {
										$description_shorten = array_slice( $description, 0, $settings['exad_google_reviews_excerpt_limit'] );
										$description = implode( ' ', $description_shorten ) . '...';
									} else {
										$description = $review['text'];
									}
								
									$load_rating       = $settings['exad_reload_reviews_by_rating'];

									if ( 'yes' === $settings['exad_load_reviews_by_rating_yes'] && isset( $settings["exad_reload_reviews_by_rating"] ) ) {
										if ( $client_rating >= $load_rating ) {
											?>
									
											<div class="swiper-slide exad-google-reviews-item exad-google-reviews-wrapper <?php echo esc_attr( $settings['exad_google_reviews_carousel_container_alignment'] ) .' '. $transition_top ;?>">
												<?php if( 'layout-2' === $settings['exad_google_reviews_carousel_layout'] ){ ?>
													<div class="exad-google-reviews-reviewer-wrapper">
														<?php if ( $settings['exad_google_reviews_show_user_image'] == 'yes' && 'exad-google-reviews-align-bottom' !== $settings['exad_google_reviews_carousel_container_alignment'] ) : ?>

															<?php echo $this->render_google_reviews_thumb( $settings, $client_name, $client_url, $client_photoUrl ); ?>

														<?php endif ?>

														<?php echo $this->render_google_reviews_content( $settings, $client_name, $client_rating, $client_url, $client_photoUrl, $human_time ); ?>

													</div>
												<?php }; ?>
												<?php if ( 'yes' === $settings['exad_google_reviews_show_rating'] && 'above-description' == $settings['exad_google_reviews_rating_layout']) : ?>
													<?php echo $this->render_google_reviews_rating( $settings['exad_google_reviews_rating_icon'], $client_rating ); ?>
												<?php endif;?>
												<div class="exad-google-reviews-wrapper-inner">
													<div class="exad-google-reviews-content-wrapper">
														<?php if ( 'yes' == $settings['exad_google_reviews_show_excerpt'] ) : ?>
															<div class="exad-google-reviews-description">
																<p><?php echo wp_kses_post($description); ?></p>
															</div>
														<?php endif; ?>
													</div>
													
													<?php if ( 'yes' === $settings['exad_google_reviews_show_rating'] && 'below-description' == $settings['exad_google_reviews_rating_layout']) : ?>
														<?php echo $this->render_google_reviews_rating( $settings['exad_google_reviews_rating_icon'], $client_rating ); ?>
													<?php endif;?>
													
													<?php if( 'layout-1' === $settings['exad_google_reviews_carousel_layout'] ){ ?>
														<div class="exad-google-reviews-reviewer-wrapper">
															<?php if ( $settings['exad_google_reviews_show_user_image'] == 'yes' && 'exad-google-reviews-align-bottom' !== $settings['exad_google_reviews_carousel_container_alignment'] ) : ?>

																<?php echo $this->render_google_reviews_thumb( $settings, $client_name, $client_url, $client_photoUrl ); ?>

															<?php endif ?>

															<?php echo $this->render_google_reviews_content( $settings, $client_name, $client_rating, $client_url, $client_photoUrl, $human_time ); ?>

														</div>
													<?php }; ?>
												</div>
											</div>
											<?php 
										}
									} else {
									
									?>

									<div class="swiper-slide exad-google-reviews-item exad-google-reviews-wrapper <?php echo esc_attr( $settings['exad_google_reviews_carousel_container_alignment'] ) .' '. $transition_top ;?>">
										<?php if( 'layout-2' === $settings['exad_google_reviews_carousel_layout'] ){ ?>
											<div class="exad-google-reviews-reviewer-wrapper">
												<?php if ( $settings['exad_google_reviews_show_user_image'] == 'yes' && 'exad-google-reviews-align-bottom' !== $settings['exad_google_reviews_carousel_container_alignment'] ) : ?>

													<?php echo $this->render_google_reviews_thumb( $settings, $client_name, $client_url, $client_photoUrl ); ?>

												<?php endif ?>

												<?php echo $this->render_google_reviews_content( $settings, $client_name, $client_rating, $client_url, $client_photoUrl, $human_time ); ?>

											</div>
										<?php }; ?>
										<?php if ( 'yes' === $settings['exad_google_reviews_show_rating'] && 'above-description' == $settings['exad_google_reviews_rating_layout']) : ?>
											<?php echo $this->render_google_reviews_rating( $settings['exad_google_reviews_rating_icon'], $client_rating ); ?>
										<?php endif;?>
										<div class="exad-google-reviews-wrapper-inner">
											<div class="exad-google-reviews-content-wrapper">
												<?php if ( 'yes' == $settings['exad_google_reviews_show_excerpt'] ) : ?>
													<div class="exad-google-reviews-description">
														<p><?php echo wp_kses_post($description); ?></p>
													</div>
												<?php endif; ?>
											</div>
											
											<?php if ( 'yes' === $settings['exad_google_reviews_show_rating'] && 'below-description' == $settings['exad_google_reviews_rating_layout']) : ?>
												<?php echo $this->render_google_reviews_rating( $settings['exad_google_reviews_rating_icon'], $client_rating ); ?>
											<?php endif;?>
											
											<?php if( 'layout-1' === $settings['exad_google_reviews_carousel_layout'] ){ ?>
												<div class="exad-google-reviews-reviewer-wrapper">
													<?php if ( $settings['exad_google_reviews_show_user_image'] == 'yes' && 'exad-google-reviews-align-bottom' !== $settings['exad_google_reviews_carousel_container_alignment'] ) : ?>

														<?php echo $this->render_google_reviews_thumb( $settings, $client_name, $client_url, $client_photoUrl ); ?>

													<?php endif ?>

													<?php echo $this->render_google_reviews_content( $settings, $client_name, $client_rating, $client_url, $client_photoUrl, $human_time ); ?>

												</div>
											<?php }; ?>
										</div>
									</div>

								<?php } } ;
							?>
						</div>
					</div>
					<?php if ( !empty( $api_key ) ):
						if( $settings['exad_google_reviews_carousel_nav'] == "arrows" || $settings['exad_google_reviews_carousel_nav'] == "both" ) : ?>
							<div class="exad-carousel-nav-next"><i class="fa fa-angle-right"></i></div>
							<div class="exad-carousel-nav-prev"><i class="fa fa-angle-left"></i></div>
						<?php endif; ?>
						<?php if( $settings['exad_google_reviews_carousel_nav'] == "nav-dots" || $settings['exad_google_reviews_carousel_nav'] == "both" || $settings["exad_google_reviews_carousel_nav"] == "dynamic-dots") : ?>
							<div class="exad-dots-container">
								<div class="exad-swiper-pagination"></div>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
            </div>
        </div>
		
    <?php 
    }
        

}
