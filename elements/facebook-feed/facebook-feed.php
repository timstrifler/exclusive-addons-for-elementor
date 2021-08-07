<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Background;

class Facebook_Feed extends Widget_Base {

    public function get_name() {
		return 'exad-facebook-feed';
	}

	public function get_title() {
		return __('Facebook Feed', 'exclusive-addons-elementor');
	}

	public function get_icon() {
		return 'exad exad-logo exad-facebook-feed';
	}

	public function get_keywords() {
		return ['social', 'media', 'sharing'];
    }
    
    public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}


	/**
	 * Register controls
	 */
	protected function register_controls() {
		$exad_primary_color   = get_option( 'exad_primary_color_option', '#7a56ff' );
		$this->start_controls_section(
			'exad_facebook_feed_wrapper',
			[
				'label' => __( 'Facebook Feed Content', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'exad_facebook_page_id',
			[
				'label' => esc_html__('Page ID', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '228776804732213',
				'label_block' => true,
				'description' => '<a href="https://lookup-id.com/" target="_blank">Find Page ID</a>',
			]
		);

		$this->add_control(
			'exad_facebook_access_token',
			[
				'label' => esc_html__('Access Token', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'EAAkn4TitXBIBALh0uMIsK6ZAnQywN62Izkw9nh5G3BRH3uKQJwfVoaZCZA4ZBKcCV00KLrFRZCgGrM4lpHytJGhhcj2jqZChcMbx5KqIL5xarn6EkPiZAwrR5tFtTWw6YZAo35OuzwPtyW5DceYJmAsrwf2v9R3skZCBClIHXjCQ5b42Xa0GV5xMG',
				'label_block' => true,
				'description' => '<a href="https://developers.facebook.com/apps/" target="_blank">Get Access Token.</a>',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'exad_facebook_settings',
			[
				'label' => __('Settings', 'exclusive-addons-elementor'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'exad_facebook_sort_by',
			[
				'label' => __( 'Sort By', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'recent-posts',
				'options' => [
					'recent-posts' => __( 'Recent Posts', 'exclusive-addons-elementor' ),
					'old-posts' => __( 'Old Posts', 'exclusive-addons-elementor' ),
					'like_count' => __( 'Like', 'exclusive-addons-elementor' ),
					'comment_count' => __( 'Comment', 'exclusive-addons-elementor' ),
				],
			]
		);

		$this->add_control(
			'post_limit',
			[
				'label' => __( 'Number of Posts to show', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 800,
				'step' => 1,
				'default' => 6,
				'style_transfer' => true,
			]
		);

		$this->add_control(
            'exad_facebook_feed_layout',
            [
				'label'   => __( 'Layout', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => esc_html__( 'Layout 1', 'exclusive-addons-elementor' ),
					'layout-2' => esc_html__( 'Layout 2', 'exclusive-addons-elementor' ),
					'layout-3' => esc_html__( 'Layout 3', 'exclusive-addons-elementor' )
				],
            ]
		);

		$this->add_responsive_control(
            'exad_facebook_feed_column',
            [
				'label'   => __( 'Columns', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'desktop_default' => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options' => [
					'1' => esc_html__( '1', 'exclusive-addons-elementor' ),
					'2' => esc_html__( '2', 'exclusive-addons-elementor' ),
					'3' => esc_html__( '3', 'exclusive-addons-elementor' ),
					'4' => esc_html__( '4', 'exclusive-addons-elementor' ),
					'5' => esc_html__( '5', 'exclusive-addons-elementor' ),
					'6' => esc_html__( '6', 'exclusive-addons-elementor' )
				],
				'selectors_dictionary' => [
					'1' => 'grid-template-columns: repeat(1, 1fr);',
					'2' => 'grid-template-columns: repeat(2, 1fr);',
					'3' => 'grid-template-columns: repeat(3, 1fr);',
					'4' => 'grid-template-columns: repeat(4, 1fr);',
					'5' => 'grid-template-columns: repeat(5, 1fr);',
					'6' => 'grid-template-columns: repeat(6, 1fr);',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-feed-wrapper' => '{{VALUE}};'
				]
            ]
		);

		$this->add_responsive_control(
			'exad_facebook_feed_column_gap',
			[
				'label' => __( 'Column Gap', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-feed-wrapper' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'clear_cache',
			[
				'label' => __('Clear Cache', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
				'separator' => 'after',
			]
		);

		$this->add_control(
			'exad_facebook_show_feature_image',
			[
				'label' => __('Show Feature Image', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'show_user_image',
			[
				'label' => __('Show Profile image', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_name',
			[
				'label' => __('Show Name', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_date',
			[
				'label' => __('Show Date', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_likes',
			[
				'label' => __('Show Likes Count', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'exad_facebook_show_likes_text',
			[
				'label' => __('Show Likes Text', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'style_transfer' => true,
				'condition' => [
					'show_likes' => 'yes'
				]
			]
		);

		$this->add_control(
			'exad_facebook_show_share',
			[
				'label' => __('Show Share Count', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'exad_facebook_show_share_text',
			[
				'label' => __('Show Share Text', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'style_transfer' => true,
				'condition' => [
					'exad_facebook_show_share' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_comments',
			[
				'label' => __('Show Comments Count', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'exad_facebook_show_comment_text',
			[
				'label' => __('Show Comments Text', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'style_transfer' => true,
				'condition' => [
					'show_comments' => 'yes'
				]
			]
		);

		$this->add_control(
			'read_more',
			[
				'label' => __('Read More', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'read_more_text',
			[
				'label' => __('Read More Text', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::TEXT,
				'default' => 'See More',
				'condition' => [
					'read_more' => 'yes',
				],
			]
		);

		$this->add_control(
			'description_word_count',
			[
				'label' => __( 'Description Word Count', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'step' => 1,
				'max' => 500,
				'default' => 15,
			]
		);

		$this->add_control(
			'load_more',
			[
				'label' => __('Load More Button', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'load_more_text',
			[
				'label' => __('Load More Text', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Load More',
				'condition' => [
					'load_more' => 'yes',
				],
			]
		);

		$this->end_controls_section();


	/**
	 * Register styles related controls
	 */
		$this->start_controls_section(
			'exad_facebook_item_style',
			[
				'label' => __( 'Post Item', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_facebook_item_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '60',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-feed-wrapper .exad-facebook-feed-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_facebook_item_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-facebook-feed-wrapper .exad-facebook-feed-item',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_facebook_item_border',
				'fields_options'  => [
                    'border' 	  => [
                        'default' => 'solid'
                    ],
                    'width'  	  => [
                        'default' 	 => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                    'color' 	  => [
                        'default' => '#e5e5e5'
                    ]
                ],
				'selector' => '{{WRAPPER}} .exad-facebook-feed-wrapper .exad-facebook-feed-item',
			]
		);

		$this->add_responsive_control(
			'exad_facebook_item_border_radius',
			[
				'label' => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-feed-wrapper .exad-facebook-feed-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_facebook_item_shadow',
				'selector' => '{{WRAPPER}} .exad-facebook-feed-wrapper .exad-facebook-feed-item'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'exad_facebook_feature_image_style',
			[
				'label' => __('Feed Image', 'exclusive-addons-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_facebook_show_feature_image' => 'yes',
				],
			]
		);

		$this->add_control(
			'feature_image_position',
			[
				'label' => __( 'Feature Image Position', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'exclusive-addons-elementor' ),
						'icon' => 'eicon-arrow-up',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'exclusive-addons-elementor' ),
						'icon' => 'eicon-arrow-down',
					],
				],
				'default' => 'top',
				'toggle' => false,
				'prefix_class' => 'exad-facebook-user-',
				'selectors_dictionary' => [
					'top' => 'flex-direction: column; justify-content: flex-start;',
					'bottom' => 'flex-direction: column-reverse; justify-content: flex-end;',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-feed-wrapper.exad-layout-1 .exad-facebook-feed-item' => '{{VALUE}};'
				],
				'condition' => [
					'exad_facebook_feed_layout' => 'layout-1'
				]
			]
		);

		$this->add_responsive_control(
			'feature_image_height',
			[
				'label' => __( 'Image Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 400,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 220,
				],
				'condition' => [
					'exad_facebook_show_feature_image' => 'yes',
					'exad_facebook_feed_layout' => 'layout-1'
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-feed-feature-image img' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'feature_image_width',
			[
				'label' => __( 'Image Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 400,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 150,
				],
				'condition' => [
					'exad_facebook_show_feature_image' => 'yes',
					'exad_facebook_feed_layout' => [ 'layout-2', 'layout-3' ]
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-feed-feature-image' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-facebook-inner-wrapper' => 'width: calc( 100% - {{SIZE}}{{UNIT}} );'
				],
			]
		);

		$this->add_responsive_control(
			'feature_image_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'condition' => [
					'exad_facebook_show_feature_image' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-feed-feature-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'feature_image_border_radius',
			[
				'label' => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => true,
				],
				'condition' => [
					'exad_facebook_show_feature_image' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-feed-feature-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'feature_image_border',
				'condition' => [
					'exad_facebook_show_feature_image' => 'yes'
				],
				'selector' => '{{WRAPPER}} .exad-facebook-feed-feature-image img',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'feature_image_box_shadow',
				'condition' => [
					'exad_facebook_show_feature_image' => 'yes'
				],
				'selector' => '{{WRAPPER}} .exad-facebook-feed-feature-image img'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_facebook_user_info',
			[
				'label' => __( 'User Information', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'user_info_spacing',
			[
				'label' => __( 'Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '20',
					'right' => '20',
					'bottom' => '20',
					'left' => '20',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'profile_image_heading',
			[
				'label' => __( 'Profile Image', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'profile_image_note',
			[
				'label' => false,
				'type' => Controls_Manager::RAW_HTML,
				'condition' => [
					'show_user_image' => ''
				],
				'raw' => __( 'Profile Image is hidden from <strong>Facebook Feed Settings</strong> section.', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_responsive_control(
			'profile_image_size',
			[
				'label' => __( 'Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'show_user_image' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-avatar' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'profile_image_spacing',
			[
				'label' => __( 'Right Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'condition' => [
					'show_user_image' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}}.exad-facebook-left .exad-facebook-avatar' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.exad-facebook-center .exad-facebook-avatar' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.exad-facebook-right .exad-facebook-avatar' => 'margin-left: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'profile_image_border',
				'selector' => '{{WRAPPER}} .exad-facebook-avatar',
				'condition' => [
					'show_user_image' => 'yes'
				],
			]
		);

		$this->add_control(
			'profile_image_border_radius',
			[
				'label' => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'profile_image_box_shadow',
				'selector' => '{{WRAPPER}} .exad-facebook-avatar',
				'condition' => [
					'show_user_image' => 'yes'
				],
			]
		);

		$this->add_control(
			'name_heading',
			[
				'label' => __( 'User Name', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'name_note',
			[
				'label' => false,
				'type' => Controls_Manager::RAW_HTML,
				'condition' => [
					'show_name' => '',
				],
				'raw' => __( 'Name is hidden from <strong>Facebook Feed Settings</strong> section.', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'label' => __( 'Name Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-facebook-author-name',
				'condition' => [
					'show_name' => 'yes'
				],
			]
		);

		$this->add_responsive_control(
			'exad_facebook_name__bottom_spacing',
			[
				'label' => __( 'Bottom Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-author-name' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->start_controls_tabs(
			'_tabs_name_username',
			[
				'condition' => [ 'show_name' => 'yes' ],
			]
		);
		$this->start_controls_tab(
			'_tab_name_normal',
			[
				'label' => __( 'Normal', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Name Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'show_name' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-author-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => __( 'Hover', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'name_hover_color',
			[
				'label' => __( 'Name Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'show_name' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-author-name:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'date_heading',
			[
				'label' => __( 'Post Date', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_date' => 'yes'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-facebook-date',
				'condition' => [
					'show_date' => 'yes'
				],
			]
		);

		$this->add_control(
			'date_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#5B5B5B',
				'condition' => [
					'show_date' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-date' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_facebook_content',
			[
				'label' => __('Post Content', 'exclusive-addons-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'exad_facebook_content_alignment',
			[
				'label' => __( 'Content Alignment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'toggle' => false,
				'prefix_class' => 'exad-facebook-',
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-content' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '0',
					'right' => '20',
					'bottom' => '0',
					'left' => '20',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'description_heading',
			[
				'label' => __( 'Description', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'description_spacing',
			[
				'label' => __( 'Bottom Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-facebook-content p',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#5B5B5B',
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-content p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'read_more_heading',
			[
				'label' => __( 'Read More', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'read_more' => 'yes'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'read_more_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-facebook-content p a',
				'condition' => [
					'read_more' => 'yes'
				],
			]
		);

		$this->add_control(
			'read_more_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'read_more' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-content p a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'read_more_hover_color',
			[
				'label' => __( 'Hover Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'read_more' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-content p a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_facebook_footer_button',
			[
				'label' => __( 'Footer', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'like_comment_position',
			[
				'label' => __( 'Footer Alignment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'prefix_class' => 'exad-facebook-user-',
				'selectors_dictionary' => [
					'left' => 'justify-content: flex-start',
					'center' => 'justify-content: space-between',
					'right' => 'justify-content: flex-end',
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-meta' => '{{VALUE}};'
				]
			]
		);

		$this->add_control(
            'footer_padding',
            [
                'label' => __( 'Padding', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '20',
					'right' => '20',
					'bottom' => '20',
					'left' => '20',
					'unit' => 'px',
					'isLinked' => false,
				],
                'selectors' => [
                    '{{WRAPPER}} .exad-facebook-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'footer_meta_border',
				'fields_options'  => [
                    'border' 	  => [
                        'default' => 'solid'
                    ],
                    'width'  	  => [
                        'default' 	 => [
                            'top'    => '1',
                            'right'  => '0',
                            'bottom' => '0',
                            'left'   => '0'
                        ]
                    ],
                    'color' 	  => [
                        'default' => '#e5e5e5'
                    ]
                ],
                'selector' => '{{WRAPPER}} .exad-facebook-footer',
            ]
        );

		$this->add_control(
			'like_comment_note',
			[
				'label' => false,
				'type' => Controls_Manager::RAW_HTML,
				'condition' => [
					'show_likes' => ''
				],
				'raw' => __( 'Like & Comment both are hidden from <strong>Facebook Feed Settings</strong> section.', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'like_comment_heading',
			[
				'label' => __( 'Like, Share & Comment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING
			]
		);

		$this->add_responsive_control(
			'like_comment_icon_size',
			[
				'label' => __( 'Icon Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'show_likes' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-likes i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-facebook-comments i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-facebook-share i' => 'font-size: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'like_comment_number_size',
			[
				'label' => __( 'Number Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'show_likes' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-likes' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-facebook-comments' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .exad-facebook-share' => 'font-size: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'like_comment_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#5B5B5B',
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-likes' => 'color: {{VALUE}}',
					'{{WRAPPER}} .exad-facebook-comments' => 'color: {{VALUE}}',
					'{{WRAPPER}} .exad-facebook-share' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'like_comment_icon_color',
			[
				'label' => __( 'Icon Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-likes i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .exad-facebook-comments i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .exad-facebook-share i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Load More Button Style
		 */

		$this->start_controls_section(
			'exad_facebook_load_button',
			[
				'label' => __( 'Load More Button', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'load_more' => 'yes'
				],
			]
		);

		$this->add_responsive_control(
			'button_alignment',
			[
				'label' => __( 'Button Alignment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => false,
				'condition' => [
					'load_more' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-load-more-wrapper' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_facebook_load_button_padding',
			[
				'label' => __( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
					'unit'     => 'px',
					'isLinked' => true
				],
				'condition' => [
					'load_more' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-load-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'exad_facebook_load_button_margin',
			[
				'label'      => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'      => '15',
					'right'    => '15',
					'bottom'   => '15',
					'left'     => '15',
					'unit'     => 'px',
					'isLinked' => true
				],
				'condition' => [
					'load_more' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-load-more-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_facebook_load_button_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-facebook-load-more',
				'condition' => [
					'load_more' => 'yes'
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'condition' => [
					'load_more' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .exad-facebook-load-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->start_controls_tabs(
			'_tabs_button',
			[
				'condition' => [
					'load_more' => 'yes'
				],
			]
		);
			$this->start_controls_tab(
				'_tab_button_normal',
				[
					'label' => __( 'Normal', 'exclusive-addons-elementor' ),
				]
			);

				$this->add_control(
					'button_background_color',
					[
						'label' => __( 'Background Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => $exad_primary_color,
						'selectors' => [
							'{{WRAPPER}} .exad-facebook-load-more' => 'background-color: {{VALUE}};'
						],
					]
				);

				$this->add_control(
					'button_text_color',
					[
						'label' => __( 'Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .exad-facebook-load-more' => 'color: {{VALUE}};'
						],
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'exad_facebook_button_border',
						'label' => __( 'Border', 'exclusive-addons-elementor' ),
						'fields_options'  => [
							'border' 	  => [
								'default' => 'solid'
							],
							'width'  	  => [
								'default' 	 => [
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1'
								]
							],
							'color' 	  => [
								'default' => $exad_primary_color
							]
						],
						'selector' => '{{WRAPPER}} .exad-facebook-load-more',
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'button_box_shadow',
						'selector' => '{{WRAPPER}} .exad-facebook-load-more'
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'_tab_button_hover',
				[
					'label' => __( 'Hover', 'exclusive-addons-elementor' ),
				]
			);

				$this->add_control(
					'button_background_color_hover',
					[
						'label' => __('Background Color', 'exclusive-addons-elementor'),
						'type' => Controls_Manager::COLOR,
						'default' => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .exad-facebook-load-more:hover' => 'background-color: {{VALUE}};'
						],
					]
				);

				$this->add_control(
					'button_color_hover',
					[
						'label' => __('Color', 'exclusive-addons-elementor'),
						'type' => Controls_Manager::COLOR,
						'default' => $exad_primary_color,
						'selectors' => [
							'{{WRAPPER}} .exad-facebook-load-more:hover' => 'color: {{VALUE}};'
						],
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'exad_facebook_button_border_hover',
						'label' => __( 'Border', 'exclusive-addons-elementor' ),
						'fields_options'  => [
							'border' 	  => [
								'default' => 'solid'
							],
							'width'  	  => [
								'default' 	 => [
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1'
								]
							],
							'color' 	  => [
								'default' => $exad_primary_color
							]
						],
						'selector' => '{{WRAPPER}} .exad-facebook-load-more:hover',
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'button_box_shadow_hover',
						'selector' => '{{WRAPPER}} .exad-facebook-load-more:hover'
					]
				);

			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$this->facebook_feed_render($this->get_id(), $settings); ?>
	
		<?php
	}

	protected function facebook_feed_render( $id, $settings ) {
		$page_id = trim($settings['exad_facebook_page_id']);
		$access_token = $settings['exad_facebook_access_token'];
		if ( empty( $page_id ) || empty( $access_token ) ) {
			return;
		}

		$this->add_render_attribute(
			'exad_facebook_feed_wrapper',
			[	
				'id' => "exad-facebook-feed-wrapper",
				'class' => "exad-facebook-feed-wrapper exad-col-{$settings['exad_facebook_feed_column']} exad-{$settings['exad_facebook_feed_layout']}"
			]
		);

		$exad_facebook_feed_cache = '_' . $id . '_facebook_cache';
		$transient_key = $page_id . $exad_facebook_feed_cache;
		$facebook_feed_data = get_transient($transient_key);
		$messages = [];

		if ( false === $facebook_feed_data ) {
			$url_queries = 'fields=status_type,created_time,shares,from,message,story,full_picture,permalink_url,attachments.limit(1){type,media_type,title,description,unshimmed_url},comments.summary(total_count),reactions.summary(total_count)';
			$url = "https://graph.facebook.com/{$page_id}/posts?{$url_queries}&access_token={$access_token}";
			$data = wp_remote_get( $url ); 
			$facebook_feed_data = json_decode( wp_remote_retrieve_body( $data ), true );

			set_transient( $transient_key, $facebook_feed_data, 0 );
		}
		if ( $settings['clear_cache'] == 'yes' ) {
			delete_transient( $transient_key );
		}


		if ( !empty( $facebook_feed_data ) && array_key_exists( 'error', $facebook_feed_data ) ) {
			$messages['error'] = $facebook_feed_data['error']['message'];
		}

		if ( !empty( $messages ) ) {
			foreach ($messages as $key => $message) {
				printf('<div class="exad-facebook-error-message">%1$s</div>', esc_html( $message ) );
			}
			return;
		}


		$query_settings = [
			'widget_id' 		=> $id,
			'page_id' 			=> $page_id,
			'access_token' 		=> $access_token,
			'clear_cache' 		=> $settings['clear_cache'],
			'exad_facebook_sort_by' => $settings['exad_facebook_sort_by'],
			'post_limit' 		=> $settings['post_limit'],
			'exad_facebook_show_feature_image' => $settings['exad_facebook_show_feature_image'],
			'show_user_image' 	=> $settings['show_user_image'],
			'show_name' 				=> $settings['show_name'],
			'show_date' 				=> $settings['show_date'],
			'show_likes' 				=> $settings['show_likes'],
			'show_comments' 			=> $settings['show_comments'],
			'exad_facebook_show_share' 			=> $settings['exad_facebook_show_share'],
			'exad_facebook_show_likes_text' => $settings['exad_facebook_show_likes_text'],
			'exad_facebook_show_comment_text' => $settings['exad_facebook_show_comment_text'],
			'exad_facebook_show_share_text' => $settings['exad_facebook_show_share_text'],
			'description_word_count'	=> $settings['description_word_count'],
			'read_more'	=> $settings['read_more'],
			'read_more_text'	=> $settings['read_more_text']
		];
		$query_settings = json_encode($query_settings, true);

		switch ($settings['exad_facebook_sort_by']) {
			case 'old-posts':
				usort($facebook_feed_data['data'], function ($a,$b) {
					if ( strtotime($a['created_time']) == strtotime($b['created_time']) ) return 0;
					return ( strtotime($a['created_time']) < strtotime($b['created_time']) ? -1 : 1 );
				});
				break;
			case 'like_count':
				usort($facebook_feed_data['data'], function ($a,$b){
					if ($a['reactions']['summary'] == $b['reactions']['summary']) return 0;
					return ($a['reactions']['summary'] > $b['reactions']['summary']) ? -1 : 1 ;
				});
				break;
			case 'comment_count':
				usort($facebook_feed_data['data'], function ($a,$b){
					if ($a['comments']['summary'] == $b['comments']['summary']) return 0;
					return ($a['comments']['summary'] > $b['comments']['summary']) ? -1 : 1 ;
				});
				break;
			default:
				$facebook_feed_data;
		}

		if ( !empty( $settings['post_limit'] ) && count( $facebook_feed_data['data'] ) > $settings['post_limit'] ) {
			$items = array_splice($facebook_feed_data['data'], 0, $settings['post_limit'] );
		}
		if ( empty( $settings['post_limit'] ) ) {
			$items = $facebook_feed_data['data'];
		}

		?>

		<div <?php echo $this->get_render_attribute_string( 'exad_facebook_feed_wrapper' ); ?>>
			<?php foreach ( $items as $item ) :
				$page_url = "https://facebook.com/{$item['from']['id']}";
				$avatar_url = "https://graph.facebook.com/{{$item['from']['id']}/picture";

				$description = explode( ' ', $item['message'] );
				if ( !empty( $settings['description_word_count'] ) && count( $description ) > $settings['description_word_count'] ) {
					$description_shorten = array_slice( $description, 0, $settings['description_word_count'] );
					$description = implode( ' ', $description_shorten ) . '...';
				} else {
					$description = $item['message'];
				}
				?>
				<div class="exad-facebook-feed-item exad-col">

					<?php if ( $settings['exad_facebook_show_feature_image'] == 'yes' && !empty( $item['full_picture'] ) ) : ?>
						<div class="exad-facebook-feed-feature-image">
							<a href="<?php echo esc_url( $item['permalink_url'] ); ?>" target="_blank">
								<img src="<?php echo esc_url( $item['full_picture'] ); ?>" alt="<?php esc_url( $item['from']['name'] ); ?>">
							</a>
						</div>
					<?php endif ?>

					<div class="exad-facebook-inner-wrapper">

						<div class="exad-facebook-author">
							<?php if ( $settings['show_user_image'] == 'yes' ) : ?>
								<a href="<?php echo esc_url( $page_url ); ?>">
									<img class="exad-facebook-avatar" src="<?php echo esc_url( $avatar_url ); ?>" alt="<?php echo esc_attr( $item['from']['name'] ); ?>" >
								</a>
							<?php endif; ?>

							<div class="exad-facebook-user">
								<?php if ( $settings['show_name'] == 'yes' ) : ?>
									<a href="<?php echo esc_url( $page_url ); ?>" class="exad-facebook-author-name">
										<?php echo esc_html( $item['from']['name'] ); ?>
									</a>
								<?php endif; ?>

								<?php if ( $settings['show_date'] == 'yes' ) : ?>
									<div class="exad-facebook-date">
										<?php echo esc_html( date("M d Y", strtotime( $item['created_time'] ) ) ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>

						<div class="exad-facebook-content">
							<p>
								<?php
								echo esc_html( $description );
								if ( $settings['read_more'] == 'yes' ) :
								?>
									<a href="<?php echo esc_url( $item['permalink_url'] ); ?>" target="_blank">
										<?php echo esc_html( $settings['read_more_text'] ); ?>
									</a>
								<?php endif; ?>
							</p>
						</div>

					</div>

					<?php if ( $settings['show_likes'] == 'yes' || $settings['show_comments'] == 'yes' ) : ?>
						<div class="exad-facebook-footer-wrapper">
							<div class="exad-facebook-footer">

								<div class="exad-facebook-meta">
									<?php if ( $settings['show_likes'] == 'yes' ) : ?>
										<div class="exad-facebook-likes">
											<?php echo esc_html( $item['reactions']['summary']['total_count'] ); ?>
											<i class="far fa-thumbs-up"></i>
											<?php if( 'yes' === $settings['exad_facebook_show_likes_text'] ) { ?>
												<?php _e( 'Like', 'exclusive-addons-elementor' ); ?>
											<?php } ?>
										</div>
									<?php endif; ?>

									<?php if ( $settings['exad_facebook_show_share'] == 'yes' ) : ?>
										<div class="exad-facebook-share">
											<?php if( isset( $item['shares']['count'] ) && ( $item['shares']['count'] != '' ) ){ 
												echo esc_html( $item['shares']['count'] );
											} else {
												_e( '0', 'exclusive-addons-elementor' );
											} ?>
											<i class="far fa-share-square"></i>
											<?php if( 'yes' === $settings['exad_facebook_show_share_text'] ) { ?>
												<?php _e( 'Share', 'exclusive-addons-elementor' ); ?>
											<?php } ?>
										</div>
									<?php endif; ?>


									<?php if ( $settings['show_comments'] == 'yes' ) : ?>
										<div class="exad-facebook-comments">
											<?php echo esc_html( $item['comments']['summary']['total_count'] ); ?>
											<i class="far fa-comment"></i>
											<?php if( 'yes' === $settings['exad_facebook_show_comment_text'] ) { ?>
												<?php _e( 'Comment', 'exclusive-addons-elementor' ); ?>
											<?php } ?>
										</div>
									<?php endif; ?>
								</div>

							</div>
						</div>
					<?php endif; ?>

				</div>
			<?php endforeach; ?>
		</div>

		<?php if ( $settings['load_more'] == 'yes' ) : ?>
			<div class="exad-facebook-load-more-wrapper">
				<button class="exad-facebook-load-more" data-settings="<?php echo esc_attr( $query_settings ); ?>" data-total="<?php echo esc_attr( count( $facebook_feed_data['data'] ) ); ?>">
					<?php echo esc_html( $settings['load_more_text'] ); ?>
				</button>
			</div>
		<?php endif;

	}

}
