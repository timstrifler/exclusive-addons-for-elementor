<?php
namespace Elementor;

use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Flip_Box extends Widget_Base {

	public function get_name() {
		return 'exad-flip-box';
	}

	public function get_title() {
		return esc_html__( 'DC Flip Box', 'essential-addons-elementor' );
	}

	public function get_icon() {
		return 'eicon-flip-box';
	}

   public function get_categories() {
		return [ 'essential-addons-elementor' ];
	}

	protected function _register_controls() {

  		/**
  		 * Flipbox Image Settings
  		 */
  		$this->start_controls_section(
  			'eael_section_flipbox_content_settings',
  			[
  				'label' => esc_html__( 'Flipbox Settings', 'essential-addons-elementor' )
  			]
  		);

  		$this->add_control(
		  'eael_flipbox_type',
		  	[
		   	'label'       	=> esc_html__( 'Flipbox Type', 'essential-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'animate-left',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'animate-left'  		=> esc_html__( 'Flip Left', 'essential-addons-elementor' ),
		     		'animate-right' 		=> esc_html__( 'Flip Right', 'essential-addons-elementor' ),
		     		'animate-up' 			=> esc_html__( 'Flip Top', 'essential-addons-elementor' ),
		     		'animate-down' 		=> esc_html__( 'Flip Bottom', 'essential-addons-elementor' ),
		     		'animate-zoom-in' 	=> esc_html__( 'Zoom In', 'essential-addons-elementor' ),
		     		'animate-zoom-out' 	=> esc_html__( 'Zoom Out', 'essential-addons-elementor' ),
		     	],
		  	]
		);

		$this->start_controls_tabs('icon_image_front_back');

			$this->start_controls_tab(
				'front',
				[
					'label'	=> __( 'Front', 'essential-addons-elementor' )
				]
			);

				$this->add_control(
					'eael_flipbox_img_or_icon',
					[
						'label' => esc_html__( 'Icon Type', 'essential-addons-elementor' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'none'	=> __( 'None', 'essential-addons-elementor' ),
							'img'	=> __( 'Image', 'esential-addons-elementor' ),
							'icon'	=> __( 'Icon', 'esential-addons-elementor' )
						],
						'default' => 'icon',
					]
				);

				$this->add_control(
					'eael_flipbox_image',
					[
						'label' => esc_html__( 'Flipbox Image', 'essential-addons-elementor' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'condition' => [
							'eael_flipbox_img_or_icon' => 'img'
						]
					]
				);

				$this->add_control(
					'eael_flipbox_icon',
					[
						'label' => esc_html__( 'Icon', 'essential-addons-elementor' ),
						'type' => Controls_Manager::ICON,
						'default' => 'fa fa-snowflake-o',
						'separator'	=> 'before',
						'condition' => [
							'eael_flipbox_img_or_icon' => 'icon'
						]
					]
				);

				$this->add_responsive_control(
					'eael_flipbox_image_resizer',
					[
						'label' => esc_html__( 'Image Resizer', 'essential-addons-elementor' ),
						'type' => Controls_Manager::SLIDER,
						'default' => [
							'size' => '100'
						],
						'range' => [
							'px' => [
								'max' => 500,
							],
						],
						'separator'	=> 'before',
						'selectors' => [
							'{{WRAPPER}} .eael-elements-flip-box-front-container .eael-elements-flip-box-icon-image > img' => 'width: {{SIZE}}px;'
						],
						'condition'	=> [
							'eael_flipbox_img_or_icon'	=> 'img'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Image_Size::get_type(),
					[
						'name' => 'thumbnail',
						'default' => 'full',
						'condition' => [
							'eael_flipbox_image[url]!' => '',
							'eael_flipbox_img_or_icon'	=> 'img'
						],
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'back',
				[
					'label'	=> __( 'Back', 'essential-addons-elementor' )
				]
			);

				$this->add_control(
					'eael_flipbox_img_or_icon_back',
					[
						'label' => esc_html__( 'Icon Type', 'essential-addons-elementor' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'none'	=> __( 'None', 'essential-addons-elementor' ),
							'img'	=> __( 'Image', 'esential-addons-elementor' ),
							'icon'	=> __( 'Icon', 'esential-addons-elementor' )
						],
						'default' => 'icon'
					]
				);

				$this->add_control(
					'eael_flipbox_image_back',
					[
						'label' => esc_html__( 'Flipbox Image', 'essential-addons-elementor' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'condition'	=> [
							'eael_flipbox_img_or_icon_back'	=> 'img'
						]
					]
				);

				$this->add_control(
					'eael_flipbox_icon_back',
					[
						'label' => esc_html__( 'Icon', 'essential-addons-elementor' ),
						'type' => Controls_Manager::ICON,
						'default' => 'fa fa-snowflake-o',
						'condition'	=> [
							'eael_flipbox_img_or_icon_back'	=> 'icon'
						]
					]
				);

				$this->add_responsive_control(
					'eael_flipbox_image_resizer_back',
					[
						'label' => esc_html__( 'Image Resizer', 'essential-addons-elementor' ),
						'type' => Controls_Manager::SLIDER,
						'default' => [
							'size' => '100'
						],
						'range' => [
							'px' => [
								'max' => 500,
							],
						],
						'separator'	=> 'before',
						'selectors' => [
							'{{WRAPPER}} .eael-elements-flip-box-rear-container .flipbox-back-image-icon > img' => 'width: {{SIZE}}px;'
						],
						'condition'	=> [
							'eael_flipbox_img_or_icon_back'	=> 'img'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Image_Size::get_type(),
					[
						'name' => 'thumbnail_back',
						'default' => 'full',
						'condition' => [
							'eael_flipbox_image[url]!' => '',
							'eael_flipbox_img_or_icon_back'	=> 'img'
						],
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Flipbox Content
		 */
		$this->start_controls_section(
			'eael_flipbox_content',
			[
				'label' => esc_html__( 'Flipbox Content', 'essential-addons-elementor' ),
			]
		);
		$this->add_responsive_control(
			'eael_flipbox_front_or_back_content',
			[
				'label' => esc_html__( 'Front or Back Content', 'essential-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'front' => [
						'title' => esc_html__( 'Front Content', 'essential-addons-elementor' ),
						'icon' => 'fa fa-reply',
					],
					'back' => [
						'title' => esc_html__( 'Back Content', 'essential-addons-elementor' ),
						'icon' => 'fa fa-share',
					],
				],
				'default' => 'front',
			]
		);
		/**
		 * Condition: 'eael_flipbox_front_or_back_content' => 'front'
		 */
		$this->add_control(
			'eael_flipbox_front_title',
			[
				'label' => esc_html__( 'Front Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Elementor Flipbox', 'essential-addons-elementor' ),
				'condition' => [
					'eael_flipbox_front_or_back_content' => 'front'
				]
			]
		);
		$this->add_control(
			'eael_flipbox_front_text',
			[
				'label' => esc_html__( 'Front Text', 'essential-addons-elementor' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => __( 'This is front-end content.', 'essential-addons-elementor' ),
				'condition' => [
					'eael_flipbox_front_or_back_content' => 'front'
				]
			]
		);
		/**
		 * Condition: 'eael_flipbox_front_or_back_content' => 'back'
		 */
		$this->add_control(
			'eael_flipbox_back_title',
			[
				'label' => esc_html__( 'Back Title', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Elementor Flipbox', 'essential-addons-elementor' ),
				'condition' => [
					'eael_flipbox_front_or_back_content' => 'back'
				]
			]
		);
		$this->add_control(
			'eael_flipbox_back_text',
			[
				'label' => esc_html__( 'Back Text', 'essential-addons-elementor' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => __( 'This is back-end content.', 'essential-addons-elementor' ),
				'condition' => [
					'eael_flipbox_front_or_back_content' => 'back'
				]
			]
		);
		$this->add_responsive_control(
			'eael_flipbox_content_alignment',
			[
				'label' => esc_html__( 'Content Alignment', 'essential-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'essential-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'essential-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'essential-addons-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'prefix_class' => 'eael-flipbox-content-align-',
			]
		);
		$this->end_controls_section();

		/**
		 * ----------------------------------------------
		 * Flipbox Link
		 * ----------------------------------------------
		 */
		$this->start_controls_section(
			'eael_flixbox_link_section',
			[
				'label' => esc_html__( 'Link', 'essential-addons-elementor' )
			]
		);

		$this->add_control(
            'flipbox_link_type',
            [
                'label'                 => __( 'Link Type', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'none',
                'options'               => [
                    'none'      => __( 'None', 'essential-addons-elementor' ),
                    'box'       => __( 'Box', 'essential-addons-elementor' ),
                    'title'     => __( 'Title', 'essential-addons-elementor' ),
                    'button'    => __( 'Button', 'essential-addons-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'flipbox_link',
            [
                'label'                 => __( 'Link', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::URL,
				'dynamic'               => [
					'active'        => true,
                    'categories'    => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY
                    ],
				],
                'placeholder'           => 'https://www.your-link.com',
                'default'               => [
                    'url' => '#',
                ],
                'condition'             => [
                    'flipbox_link_type!'   => 'none',
                ],
            ]
        );

        $this->add_control(
            'flipbox_button_text',
            [
                'label'                 => __( 'Button Text', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::TEXT,
				'dynamic'               => [
					'active'   => true,
				],
                'default'               => __( 'Get Started', 'essential-addons-elementor' ),
                'condition'             => [
                    'flipbox_link_type'   => 'button',
                ],
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label'                 => __( 'Button Icon', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::ICON,
                'default'               => '',
                'condition'             => [
                    'flipbox_link_type'   => 'button',
                ],
            ]
        );
        
        $this->add_control(
            'button_icon_position',
            [
                'label'                 => __( 'Icon Position', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'after',
                'options'               => [
                    'after'     => __( 'After', 'essential-addons-elementor' ),
                    'before'    => __( 'Before', 'essential-addons-elementor' ),
                ],
                'condition'             => [
                    'flipbox_link_type'     => 'button',
                    'button_icon!'  => '',
                ],
            ]
        );

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flipbox Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'eael_section_flipbox_style_settings',
			[
				'label' => esc_html__( 'Filp Box Style', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'eael_flipbox_front_bg_color',
			[
				'label' => esc_html__( 'Front Background Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#14bcc8',
				'selectors' => [
					'{{WRAPPER}} .eael-elements-flip-box-front-container' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'eael_flipbox_back_bg_color',
			[
				'label' => esc_html__( 'Back Background Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ff7e70',
				'selectors' => [
					'{{WRAPPER}} .eael-elements-flip-box-rear-container' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'eael_flipbox_front_back_padding',
			[
				'label' => esc_html__( 'Fornt / Back Content Padding', 'essential-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .eael-elements-flip-box-front-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 					'{{WRAPPER}} .eael-elements-flip-box-rear-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'eael_filbpox_border',
					'label' => esc_html__( 'Border Style', 'essential-addons-elementor' ),
					'selector' => '{{WRAPPER}} .eael-elements-flip-box-front-container, {{WRAPPER}} .eael-elements-flip-box-rear-container',
				]
		);

		$this->add_control(
			'eael_flipbox_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'min'	=> 0,
						'step'	=> 1,
						'max'	=> 500,
					],
					'%'	=> [
						'min'	=> 0,
						'step'	=> 3,
						'max'	=> 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .eael-elements-flip-box-front-container'	=> 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eael-elements-flip-box-rear-container'	=> 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'eael_flipbox_shadow',
				'selector' => '{{WRAPPER}} .eael-elements-flip-box-front-container, {{WRAPPER}} .eael-elements-flip-box-rear-container'
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flip Box Image)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'eael_section_flipbox_imgae_style_settings',
			[
				'label' => esc_html__( 'Image Style', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
		     		'eael_flipbox_img_or_icon' => 'img'
		     	]
			]
		);

		$this->add_control(
		  'eael_flipbox_img_type',
		  	[
		   	'label'       	=> esc_html__( 'Image Type', 'essential-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'default',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'circle'  	=> esc_html__( 'Circle', 'essential-addons-elementor' ),
		     		'radius' 	=> esc_html__( 'Radius', 'essential-addons-elementor' ),
		     		'default' 	=> esc_html__( 'Default', 'essential-addons-elementor' ),
		     	],
		     	'prefix_class' => 'eael-flipbox-img-',
		     	'condition' => [
		     		'eael_flipbox_img_or_icon' => 'img'
		     	]
		  	]
		);

		/**
		 * Condition: 'eael_flipbox_img_type' => 'radius'
		 */
		$this->add_control(
			'eael_filpbox_img_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eael-elements-flip-box-icon-image img' => 'border-radius: {{SIZE}}px;',
					'{{WRAPPER}} .flipbox-back-image-icon img' => 'border-radius: {{SIZE}}px;',
				],
				'condition' => [
					'eael_flipbox_img_or_icon' => 'img',
					'eael_flipbox_img_type' => 'radius'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flip Box Icon Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'eael_section_flipbox_icon_style_settings',
			[
				'label' => esc_html__( 'Icon Style', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
		     		'eael_flipbox_img_or_icon' => 'icon'
		     	]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'eael_flipbox_border',
					'label' => esc_html__( 'Border', 'essential-addons-elementor' ),
					'selector' => '{{WRAPPER}} .eael-elements-flip-box-icon-image',
					'condition' => [
						'eael_flipbox_img_or_icon' => 'icon'
					]
				]
		);

		$this->add_responsive_control(
			'eael_flipbox_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'essential-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
	 				'{{WRAPPER}} .eael-elements-flip-box-icon-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
	 			],
			]
		);

		$this->add_control(
			'eael_flipbox_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'min'	=> 0,
						'step'	=> 1,
						'max'	=> 500,
					],
					'%'	=> [
						'min'	=> 0,
						'step'	=> 3,
						'max'	=> 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .eael-elements-flip-box-icon-image'	=> 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'eael_flipbox_img_or_icon' => 'icon'
				]
			]
		);
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flip Box Title Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'eael_section_flipbox_title_style_settings',
			[
				'label' => esc_html__( 'Color &amp; Typography', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'eael_flipbox_front_back_content_toggler',
			[
				'label' => esc_html__( 'Front or Back Content', 'essential-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'front' => [
						'title' => esc_html__( 'Front Content', 'essential-addons-elementor' ),
						'icon' => 'fa fa-arrow-left',
					],
					'back' => [
						'title' => esc_html__( 'Back Content', 'essential-addons-elementor' ),
						'icon' => 'fa fa-arrow-right',
					],
				],
				'default' => 'front',
			]
		);

		/**
		 * Icon
		 */
		$this->add_control(
			'eael_flipbox_front_icon_heading',
			[
				'label' => esc_html__( 'Icon Style', 'essential-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		/**
		 * Condition: 'eael_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_control(
			'eael_flipbox_front_icon_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .eael-elements-flip-box-front-container .eael-elements-flip-box-icon-image i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'eael_flipbox_front_back_content_toggler' => 'front'
				]
			]
		);

		/**
		 * Condition: 'eael_flipbox_front_back_content_toggler' => 'back'
		 */
		$this->add_control(
			'eael_flipbox_back_icon_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .eael-elements-flip-box-rear-container .flipbox-back-image-icon i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'eael_flipbox_front_back_content_toggler' => 'back'
				]
			]
		);

		/**
		 * Condition: 'eael_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'eael_flipbox_front_icon_typography',
				'selector' => '{{WRAPPER}} .eael-elements-flip-box-front-container .eael-elements-flip-box-icon-image i',
				'condition' => [
					'eael_flipbox_front_back_content_toggler' => 'front'
				],
			]
		);

		/**
		 * Condition: 'eael_flipbox_front_back_content_toggler' => 'back'
		 */
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'eael_flipbox_back_icon_typography',
				'selector' => '{{WRAPPER}} .eael-elements-flip-box-rear-container .flipbox-back-image-icon i',
				'condition' => [
					'eael_flipbox_front_back_content_toggler' => 'back'
				],
			]
		);

		/**
		 * Title
		 */
		$this->add_control(
			'eael_flipbox_front_title_heading',
			[
				'label' => esc_html__( 'Title Style', 'essential-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		/**
		 * Condition: 'eael_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_control(
			'eael_flipbox_front_title_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .eael-elements-flip-box-front-container .eael-elements-flip-box-heading' => 'color: {{VALUE}};',
				],
				'condition' => [
					'eael_flipbox_front_back_content_toggler' => 'front'
				]
			]
		);

		/**
		 * Condition: 'eael_flipbox_front_back_content_toggler' => 'back'
		 */
		$this->add_control(
			'eael_flipbox_back_title_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .eael-elements-flip-box-rear-container .eael-elements-flip-box-heading' => 'color: {{VALUE}};',
				],
				'condition' => [
					'eael_flipbox_front_back_content_toggler' => 'back'
				]
			]
		);

		/**
		 * Condition: 'eael_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'eael_flipbox_front_title_typography',
				'selector' => '{{WRAPPER}} .eael-elements-flip-box-front-container .eael-elements-flip-box-heading',
				'condition' => [
					'eael_flipbox_front_back_content_toggler' => 'front'
				],
			]
		);

		/**
		 * Condition: 'eael_flipbox_front_back_content_toggler' => 'back'
		 */
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'eael_flipbox_back_title_typography',
				'selector' => '{{WRAPPER}} .eael-elements-flip-box-rear-container .eael-elements-flip-box-heading',
				'condition' => [
					'eael_flipbox_front_back_content_toggler' => 'back'
				],
			]
		);

		/**
		 * Content
		 */
		$this->add_control(
			'eael_flipbox_content_heading',
			[
				'label' => esc_html__( 'Content Style', 'essential-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		/**
		 * Condition: 'eael_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_control(
			'eael_flipbox_front_content_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .eael-elements-flip-box-front-container .eael-elements-flip-box-content' => 'color: {{VALUE}};',
				],
				'condition' => [
					'eael_flipbox_front_back_content_toggler' => 'front'
				]
			]
		);

		/**
		 * Condition: 'eael_flipbox_front_back_content_toggler' => 'back'
		 */
		$this->add_control(
			'eael_flipbox_back_content_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .eael-elements-flip-box-rear-container .eael-elements-flip-box-content' => 'color: {{VALUE}};',
				],
				'condition' => [
					'eael_flipbox_front_back_content_toggler' => 'back'
				]
			]
		);

		/**
		 * Condition: 'eael_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'eael_flipbox_front_content_typography',
				'selector' => '{{WRAPPER}} .eael-elements-flip-box-front-container .eael-elements-flip-box-content',
				'condition' => [
					'eael_flipbox_front_back_content_toggler' => 'front'
				]
			]
		);

		/**
		 * Condition: 'eael_flipbox_front_back_content_toggler' => 'back'
		 */
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'eael_flipbox_back_content_typography',
				'selector' => '{{WRAPPER}} .eael-elements-flip-box-rear-container .eael-elements-flip-box-content',
				'condition' => [
					'eael_flipbox_front_back_content_toggler' => 'back'
				]
			]
		);
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flip Box Button Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'eael_section_flipbox_button_style_settings',
			[
				'label' => esc_html__( 'Button Style', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'flipbox_link_type'	=> 'button'
				]
			]
		);

		$this->start_controls_tabs( 'flipbox_button_style_settings' );

			$this->start_controls_tab(
				'flipbox_button_normal_style',
				[
					'label'	=> __( 'Normal', 'essential-addons-elementor' )
				]
			);
				$this->add_responsive_control(
					'eael_flipbox_button_margin',
					[
						'label' => esc_html__( 'Margin', 'essential-addons-elementor' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em' ],
						'selectors' => [
			 				'{{WRAPPER}} .eael-elements-flip-box-container .flipbox-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
			 			],
					]
				);

				$this->add_responsive_control(
					'eael_flipbox_button_padding',
					[
						'label' => esc_html__( 'Padding', 'essential-addons-elementor' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em' ],
						'selectors' => [
			 				'{{WRAPPER}} .eael-elements-flip-box-container .flipbox-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
			 			],
					]
				);

				$this->add_control(
					'eael_flipbox_button_color',
					[
						'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .eael-elements-flip-box-container .flipbox-button' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'eael_flipbox_button_bg_color',
					[
						'label' => esc_html__( 'Background', 'essential-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#000000',
						'selectors' => [
							'{{WRAPPER}} .eael-elements-flip-box-container .flipbox-button' => 'background: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'eael_flipbox_button_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'essential-addons-elementor' ),
						'type' => Controls_Manager::SLIDER,
						'size_units'	=> [ 'px' ],
						'range' => [
							'px' => [
								'min'	=> 0,
								'step'	=> 1,
								'max'	=> 100,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .eael-elements-flip-box-container .flipbox-button'	=> 'border-radius: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
		            	'name'		=> 'eael_flipbox_button_typography',
						'selector'	=> '{{WRAPPER}} .eael-elements-flip-box-container .flipbox-button'
					]
				);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'flipbox_button_hover_style',
				[
					'label'	=> __( 'Hover', 'essential-addons-elementor' )
				]
			);
				$this->add_control(
					'eael_flipbox_button_hover_color',
					[
						'label' => esc_html__( 'Color', 'essential-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .eael-elements-flip-box-container .flipbox-button:hover' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'eael_flipbox_button_hover_bg_color',
					[
						'label' => esc_html__( 'Background', 'essential-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#000000',
						'selectors' => [
							'{{WRAPPER}} .eael-elements-flip-box-container .flipbox-button:hover' => 'background: {{VALUE}};',
						],
					]
				);
			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}


	protected function render() {

   		$settings = $this->get_settings_for_display();

	?>

	<div class="exad-flip-box one">
		<div class="exad-flip-box-inner">
			<div class="exad-flip-box-front">
				<h5 class="exad-flip-box-back-title">Flip Box Front End</h5>
				<p class="exad-flip-box-back-description">This is the flipbox front end</p>
				<a href="#" class="exad-flip-box-back-action">Front read</a>
			</div>
			<div class="exad-flip-box-back">
				<h5 class="exad-flip-box-back-title">Flip Box Back End</h5>
				<p class="exad-flip-box-back-description">The copy warned the little blind text,that where it came from
					it could have been rewritten a thousand times.
				</p>
				<a href="#" class="exad-flip-box-back-action">Back read</a>
			</div>
		</div>
	</div>

	<?php
	}

	protected function content_template() { }
}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Flip_Box() );