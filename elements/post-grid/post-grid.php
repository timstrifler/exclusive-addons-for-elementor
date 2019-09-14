<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Exad_Post_Grid extends Widget_Base {


	public function get_name() {
		return 'exad-post-grid';
	}

	public function get_title() {
		return __( 'Post Grid', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function _register_controls() {

		
        $this->start_controls_section(
            'exad_section_post_grid_filters',
            [
                'label' => __( 'Settings', 'exclusive-addons-elementor' )
            ]
        );
        
      
        $this->add_control(
            'exad_post_grid_type',
            [
				'label'   => __( 'Post Type', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => Exad_Helper::exad_get_post_types(),
				'default' => 'post'

            ]
        );

        $this->add_control(
            'exad_post_grid_per_page',
            [
				'label'   => __( 'Posts Per Page', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '4'
            ]
		);

		$this->add_control(
            'exad_post_grid_column_no',
            [
				'label'   => __( 'Number of Columns', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'1' => esc_html__( '1', 'exclusive-addons-elementor' ),
					'2' => esc_html__( '2', 'exclusive-addons-elementor' ),
					'3' => esc_html__( '3', 'exclusive-addons-elementor' ),
					'4' => esc_html__( '4', 'exclusive-addons-elementor' ),
					'5' => esc_html__( '5', 'exclusive-addons-elementor' ),
					'6' => esc_html__( '6', 'exclusive-addons-elementor' )
				]
            ]
		);
		
		
        $this->add_control(
            'exad_post_grid_offset',
            [
				'label'   => __( 'Offset', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '0'
            ]
        );

        $this->add_control(
        	'exad_post_grid_authors',
        	[
				'label'       => __( 'Author', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => [],
				'options'     => Exad_Helper::exad_get_authors()
            ]
        );

        $this->add_control(
        	'exad_post_grid_categories',
        	[
				'label'       => __( 'Categories', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => [],
				'options'     => Exad_Helper::exad_get_all_categories()
            ]
        );

        $this->add_control(
        	'exad_post_grid_tags',
        	[
				'label'       => __( 'Tags', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => [],
				'options'     => Exad_Helper::exad_get_all_tags()
            ]
        );

        $this->add_control(
            'exad_post_grid_order',
            [
				'label'   => __( 'Order', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
				'options' => [
					'asc'  => 'Ascending',
					'desc' => 'Descending'
                ]

            ]
        );

        $this->add_control(
			'exad_post_grid_ignore_sticky',
			[
				'label'        => esc_html__( 'Ignore Sticky?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
            'exad_post_grid_show_excerpt',
            [
                'label'        => esc_html__( 'Show Excerpt?', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );  

        $this->add_control(
            'exad_grid_excerpt_length',
            [
				'label'     => __( 'Excerpt Words', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '25',
				'condition' => [
					'exad_post_grid_show_excerpt' => 'yes'
				]
            ]
        );

        $this->add_control(
			'exad_post_grid_show_image',
			[
				'label'        => esc_html__( 'Show Image?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);


        $this->add_control(
			'exad_post_grid_show_title',
			[
				'label'        => esc_html__( 'Show Title?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
            'exad_post_grid_show_read_more_btn',
            [
                'label'        => esc_html__( 'Details Button?', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );  

        $this->add_control(
            'exad_post_grid_read_more_btn_text',
            [   
                'label'         => esc_html__( 'Button Text', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Read More', 'exclusive-addons-elementor'),
                'default'       => esc_html__('Read More', 'exclusive-addons-elementor' ),
                'condition'     => [
                    '.exad_post_grid_show_read_more_btn' => 'yes'

                ]
            ]
        );


		$this->end_controls_section();

        $this->start_controls_section(
            'exad_section_post_grid_meta_options',
            [
                'label' => __( 'Post Meta', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
			'exad_post_grid_show_category',
			[
				'label'        => esc_html__( 'Show Category?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
			'exad_post_grid_show_user_avatar',
			[
				'label'        => esc_html__( 'Show Avatar?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

        $this->add_control(
			'exad_post_grid_show_user_name',
			[
				'label'        => esc_html__( 'Show Author Name?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
			'exad_post_grid_show_date',
			[
				'label'        => esc_html__( 'Show Date?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
			'exad_post_grid_show_read_time',
			[
				'label'        => esc_html__( 'Show Reading Time?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
			'exad_post_grid_show_comment',
			[
				'label'        => esc_html__( 'Show Comment?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
            'exad_section_post_grid_container',
            [
				'label' => __( 'Container', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_control(
			'exad_grid_post_bg_color',
			[
				'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-container' => 'background: {{VALUE}};'
				]

			]
		);

		$this->add_control(
			'exad_post_grid_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-container'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-container .exad-post-grid-thumbnail'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_post_grid_box_shadow',
				'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-row-wrapper .exad-post-grid-container'
			]
		);

        $this->add_responsive_control(
            'exad_post_grid_container_margin',
            [
                'label'         => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'default'       => [
                    'bottom'    => 20
                ],                
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                        '{{WRAPPER}} .exad-post-grid-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->end_controls_section();

		// Image Styles
		$this->start_controls_section(
            'exad_section_post_grid_image_style',
            [
				'label'     => __( 'Image', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_post_grid_show_image' => 'yes'
				]
            ]
        );

		$this->add_control(
			'exad_section_post_grid_image_padding',
			[
				'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-container .exad-post-grid-thumbnail'=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'exad_section_post_grid_image_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .exad-post-grid-thumbnail img'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_control(
            'exad_post_grid_image_align',
            [
                'label'         => esc_html__( 'Image Position', 'exclusive-addons-elementor' ),
                'type'          => \Elementor\Controls_Manager::CHOOSE,
                'options'       => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-angle-left',
                    ],
                    'top'    	=> [
                        'title' => esc_html__( 'Top', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-angle-up',
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-angle-right',
                    ],
                ],
                'default'       => 'top',
            ]
        );

		$this->end_controls_section();


		// Content Styles
		$this->start_controls_section(
            'exad_post_grid_content_style',
            [
				'label' => __( 'Content', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_control(
			'exad_post_grid_content_bg_color',
			[
				'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f5f7fa',
				'selectors' => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-three .exad-post-grid-body' => 'background-color: {{VALUE}};'
				]

			]
		);

        $this->add_responsive_control(
            'exad_post_grid_content_margin',
            [
                'label'         => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                        '{{WRAPPER}} .exad-row-wrapper .exad-post-grid-three .exad-post-grid-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_control(
			'exad_post_grid_content_padding',
			[
				'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'default'    => [
					'top'      => '20',
					'right'    => '20',
					'bottom'   => '20',
					'left'     => '20'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-three .exad-post-grid-body'=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_group_control(
        	Group_Control_Border::get_type(),
            [
                'name'      => 'exad_post_grid_content_border',
                'label'     => esc_html__( 'Border', 'exclusive-addons-elementor' ),
                'selector'  => '{{WRAPPER}} .exad-row-wrapper .exad-post-grid-three .exad-post-grid-body'
            ]
        );

		$this->add_control(
			'exad_post_grid_content_box_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-three .exad-post-grid-body'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_post_grid_content_box_shadow',
				'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-row-wrapper .exad-post-grid-three .exad-post-grid-body'
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'exad_post_grid_title',
            [
				'label'     => __( 'Title', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_post_grid_show_title' => 'yes'
				]
            ]
        );

        $this->add_responsive_control(
            'exad_post_grid_title_margin',
            [
                'label'         => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],                 
                'selectors'     => [
                        '{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->start_controls_tabs( 'exad_post_grid_title_tabs' );

			$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_grid_title_color',
				[
					'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#1B1D26',
					'selectors' => [
						'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-body .exad-post-grid-title' => 'color: {{VALUE}};'
					]
	
				]
			);

			$this->end_controls_tab();
			
			$this->start_controls_tab( 'hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_grid_title_hover_color',
				[
					'label'     => __( 'Hover Color', 'exclusive-addons-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#0A1724',
					'selectors' => [
						'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-body .exad-post-grid-title:hover' => 'color: {{VALUE}};'
					]
	
				]
			);

			$this->end_controls_tab();
		
		$this->end_controls_tabs();


		$this->add_responsive_control(
			'exad_grid_title_alignment',
			[
				'label'   => __( 'Title Alignment', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'		=> [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-left'
					],
					'center' 	=> [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon' 	=> 'fa fa-align-center'
					],
					'right' 	=> [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-right'
					]
				],
				'selectors' => [
					'{{WRAPPER}} .exad-post-grid-body .exad-post-grid-title' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_grid_title_typography',
				'label'    => __( 'Typography', 'exclusive-addons-elementor' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .exad-row-wrapper .exad-post-grid-body .exad-post-grid-title'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
            'exad_post_grid_excerpt_style',
            [
				'label' => __( 'Excerpt', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_post_grid_show_excerpt' => 'yes'
				]
            ]
        );

        $this->add_control(
			'exad_grid_excerpt_color',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#848484',
				'selectors' => [
					'{{WRAPPER}} .exad-post-grid-body .exad-post-grid-description' => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_responsive_control(
			'exad_grid_excerpt_alignment',
			[
				'label'   => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' 		=> [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon' 	=> 'fa fa-align-left'
					],
					'center' 	=> [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon' 	=> 'fa fa-align-center'
					],
					'right' 	=> [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon' 	=> 'fa fa-align-right'
					],
					'justify' 	=> [
						'title' => __( 'Justified', 'exclusive-addons-elementor' ),
						'icon' 	=> 'fa fa-align-justify'
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .exad-post-grid-body .exad-post-grid-description' => 'text-align: {{VALUE}};'
				]
			]
		);

        $this->add_responsive_control(
            'exad_post_grid_excerpt_margin',
            [
                'label'         => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],                 
                'selectors'     => [
                        '{{WRAPPER}} .exad-row-wrapper .exad-post-grid-body .exad-post-grid-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
            'exad_post_grid_category_style',
            [
				'label' => __( 'Category', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_post_grid_show_category' => 'yes'
				]
            ]
        );
		$this->add_control(
			'exad_grid_category_style',
			[
				'label'     => __( 'Category Style', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

        $this->add_control(
			'exad_post_grid_category_default_position',
			[
				'label'        => esc_html__( 'Category Position Default?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
			'exad_post_grid_category_position_over_image',
			[
				'label'   => esc_html__( 'Category Position Over Image', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '-bottom-left',
				'options' => [
					'-bottom-left' 	=> esc_html__( 'Bottom Left Corner', 'exclusive-addons-elementor' ),
					'-top-right'   	=> esc_html__( 'Top Right Corner', 'exclusive-addons-elementor' )
				],
                'condition'     => [
                    '.exad_post_grid_category_default_position!' => 'yes'
                ]
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'          => 'exad_post_grid_category_typography',
                'selector'      => '{{WRAPPER}} .exad-post-grid-container ul.exad-post-grid-category li a'
            ]
        );

        $this->add_control(
			'exad_grid_category_color',
			[
				'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-post-grid-container ul.exad-post-grid-category li a' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'exad_grid_category_bg_odd_color',
			[
				'label'     => __( 'Background Color (Odd)', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#28CAD1',
				'selectors' => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-category li:nth-child(2n-1)' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'exad_grid_category_bg_even_color',
			[
				'label'     => __( 'Background Color (Even)', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#977FFF',
				'selectors' => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-category li:nth-child(2n)' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'exad_post_grid_category_padding',
			[
				'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'default'    => [
					'top'      => '1',
					'right'    => '10',
					'bottom'   => '1',
					'left'     => '10',
					'isLinked' => true
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-post-grid-container ul.exad-post-grid-category li a'=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
            'exad_post_grid_category_all_item_margin',
            [
                'label'         => esc_html__( 'Margin(Each Item)', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],                 
                'selectors'     => [
                        '{{WRAPPER}} .exad-post-grid-container ul.exad-post-grid-category li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_post_grid_category_each_item_margin',
            [
                'label'         => esc_html__( 'Margin(All Items)', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],                 
                'selectors'     => [
                        '{{WRAPPER}} .exad-post-grid-container ul.exad-post-grid-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
        	Group_Control_Border::get_type(),
            [
                'name'      => 'exad_post_grid_category_border',
                'label'     => esc_html__( 'Border', 'exclusive-addons-elementor' ),
                'selector'  => '{{WRAPPER}} .exad-post-grid-container ul.exad-post-grid-category li'
            ]
        );

		$this->add_control(
			'exad_post_grid_category_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .exad-post-grid-container ul.exad-post-grid-category li'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
            'exad_post_grid_author_date_style',
            [
				'label' => __( 'Author & Date', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'exad_post_grid_author_date_margin',
            [
                'label'         => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '0',
					'bottom' => '10',
					'left' => '0',
					'isLinked' => false
				],                 
                'selectors'     => [
                        '{{WRAPPER}} .exad-row-wrapper .exad-post-grid-body ul.show-avatar-no' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_control(
			'exad_grid_author_date_style',
			[
				'label'     => __( 'Meta', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

        $this->add_control(
			'exad_post_grid_show_meta',
			[
				'label'        => esc_html__( 'Show meta Text?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
			'exad_grid_author_date_color',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#848484',
				'selectors' => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-body .exad-post-data li span' => 'color: {{VALUE}};'
				],
                'condition'     => [
                    '.exad_post_grid_show_meta' => 'yes'

                ]
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'exad_grid_author_date_typography',
                'selector'      => '{{WRAPPER}} .exad-row-wrapper .exad-post-grid-body .exad-post-data li span',
                'condition'     => [
                    '.exad_post_grid_show_meta' => 'yes'

                ]
            ]
        );

		$this->add_control(
			'exad_grid_date_style',
			[
				'label'     => __( 'Meta Link', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

        $this->add_control(
			'exad_grid_author_date_link_color',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#848484',
				'selectors' => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-body .exad-post-data li span a' => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'exad_grid_author_date_link_typography',
                'selector'      => '{{WRAPPER}} .exad-row-wrapper .exad-post-grid-body .exad-post-data li span a'
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
            'exad_post_grid_reading_time_comment_style',
            [
				'label' => __( 'Reading Time & Comment', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'exad_post_grid_reading_time_comment_margin',
            [
                'label'         => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '0',
					'bottom' => '10',
					'left' => '0',
					'isLinked' => false
				],               
                'selectors'     => [
                        '{{WRAPPER}} .exad-row-wrapper .exad-post-grid-body ul.exad-post-grid-time-comment' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_control(
			'exad_post_grid_reading_time_style',
			[
				'label'     => __( 'Reading Time', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'exad_post_grid_show_read_time' => 'yes'
				]
			]
		);

        $this->add_control(
			'exad_post_grid_reading_time_color',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#90929C',
				'selectors' => [
					'{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body ul.exad-post-grid-time-comment li.exad-post-grid-read-time' => 'color: {{VALUE}};'
				],
				'condition' => [
					'exad_post_grid_show_read_time' => 'yes'
				]
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'exad_post_grid_reading_time_typography',
                'selector'      => '{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body ul.exad-post-grid-time-comment li.exad-post-grid-read-time',
				'condition' => [
					'exad_post_grid_show_read_time' => 'yes'
				]
            ]
        );

		$this->add_control(
			'exad_post_grid_comment_style',
			[
				'label'     => __( 'Comment', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'exad_post_grid_show_comment' => 'yes'
				]
			]
		);

        $this->add_control(
			'exad_post_grid_comment_color',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#90929C',
				'selectors' => [
					'{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body ul.exad-post-grid-time-comment li a.exad-post-grid-comment' => 'color: {{VALUE}};'
				],
				'condition' => [
					'exad_post_grid_show_comment' => 'yes'
				]
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'      => 'exad_post_grid_comment_typography',
				'selector'  => '{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body ul.exad-post-grid-time-comment li a.exad-post-grid-comment',
				'condition' => [
					'exad_post_grid_show_comment' => 'yes'
				]
            ]
        );
        
		$this->end_controls_section();
		
        /**
         * -------------------------------------------
         * button style
         * -------------------------------------------
         */
        $this->start_controls_section(
            'exad_post_grid_details_btn_style_section',
            [
                'label'         => esc_html__( 'Button Style', 'exclusive-addons-elementor' ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    '.exad_post_grid_show_read_more_btn' => 'yes'

                ]
            ]
        );

        $this->add_responsive_control(
            'exad_post_grid_details_btn_padding',
            [
                'label'         => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::DIMENSIONS,           
                'size_units'    => [ 'px', 'em', '%' ],
                'selectors'     => [
                        '{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body .exad-post-footer a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_post_grid_details_btn_margin',
            [
                'label'         => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'em', '%' ],                 
                'selectors'     => [
                        '{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body .exad-post-footer a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'exad_post_grid_details_btn_typography',
                'selector'      => '{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body .exad-post-footer a'
            ]
        );

        $this->start_controls_tabs( 'exad_post_grid_details_button_style_tabs' );

            // normal state tab
            $this->start_controls_tab( 'exad_post_grid_details_btn_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_post_grid_details_btn_normal_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#11B5BC',
                    'selectors' => [
                        '{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body .exad-post-footer a' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_post_grid_details_btn_normal_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => 'transparent',
                    'selectors' => [
                        '{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body .exad-post-footer a' => 'background: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
            Group_Control_Border::get_type(),
                [
                    'name'      => 'exad_post_grid_details_btn_border',
                    'label'     => esc_html__( 'Border', 'exclusive-addons-elementor' ),
                    'selector'  => '{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body .exad-post-footer a'
                ]
            );

			$this->add_control(
				'exad_post_grid_details_button_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors'  => [
						'{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body .exad-post-footer a'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'exad_post_grid_details_button_shadow',
                    'selector'  => '{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body .exad-post-footer a',
                    'separator' => 'before'
                ]
            );

            $this->end_controls_tab();

            // hover state tab
            $this->start_controls_tab( 'exad_post_grid_details_btn_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_post_grid_details_btn_hover_text_color',
                [
                    'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body .exad-post-footer a:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_post_grid_details_btn_hover_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body .exad-post-footer a:hover' => 'background: {{VALUE}};'
                    ]
                ]
            );

			$this->add_control(
				'exad_post_grid_details_button_border_radius_hover',
				[
					'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors'  => [
						'{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body .exad-post-footer a:hover'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'      => 'exad_post_grid_details_button_hover_shadow',
                    'selector'  => '{{WRAPPER}} .exad-post-grid-container .exad-post-grid-body .exad-post-footer a:hover',
                    'separator' => 'before'
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
	}

    public function render_image( $image_id, $settings ) {
        $image_size = $settings['image_size_size'];
        if ( 'custom' === $image_size ) {
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'image_size', $settings );
        } else {
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        }

        return sprintf( '<img src="%s" alt="%s" />', esc_url($image_src), esc_html( get_post_meta( $image_id, '_wp_attachment_image_alt', true) ) );
    }

	protected function render() {
		$settings                  = $this->get_settings_for_display();		
		$settings['template_type'] = $this->get_name();
		$settings['post_args']     = Exad_Helper::exad_get_post_arguments($settings, 'exad_post_grid');
		
		$this->add_render_attribute(
			'exad_post_grid_wrapper',
			[
				'id'                  => "exad-post-grid-{$this->get_id()}",
				'class'               => "exad-row-wrapper exad-col-{$settings['exad_post_grid_column_no']}",
				'data-grid_id'        => $this->get_id(),
				'data-post_type'      => $settings['exad_post_grid_type'],
				'data-posts_per_page' => $settings['exad_post_grid_per_page'] ? $settings['exad_post_grid_per_page'] : 4,
				'data-post_order'     => $settings['exad_post_grid_order'],
				'data-post_offset'    => intval( $settings['exad_post_grid_offset'] ),
				'data-excerpt_length' => $settings['exad_grid_excerpt_length']
			]
		);

    ?>

		<div <?php echo $this->get_render_attribute_string( 'exad_post_grid_wrapper' ); ?>>
        	<?php Exad_Helper::exad_get_posts( $settings ); ?>
    	</div>


		<?php
	}

	protected function content_template() {}
}
Plugin::instance()->widgets_manager->register_widget_type( new Exad_Post_Grid() );