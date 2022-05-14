<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Css_Filter;
use \ExclusiveAddons\Elementor\Helper;

class Post_Timeline extends Widget_Base {

	public function get_name() {
		return 'exad-post-timeline';
	}

	public function get_title() {
		return __( 'Post Timeline', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad exad-logo exad-post-timeline';
	}

	public function get_keywords() {
		return [ 'exclusive', 'blog', 'story' ];
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function register_controls() {
		$exad_primary_color = get_option( 'exad_primary_color_option', '#7a56ff' );

        $this->start_controls_section(
            'exad_section_post_timeline_filters',
            [
                'label' => __( 'Settings', 'exclusive-addons-elementor' )
            ]
        );
      
        $this->add_control(
            'exad_post_timeline_type',
            [
				'label'   => __( 'Post Type', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => Helper::exad_get_post_types(),
				'default' => 'post'

            ]
        );

        $this->add_control(
            'exad_post_timeline_per_page',
            [
				'label'   => __( 'Posts Per Page', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '4'
            ]
        );
		
        $this->add_control(
            'exad_post_timeline_offset',
            [
				'label'   => __( 'Offset', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '0'
            ]
        );

		$this->add_control(
        	'exad_post_timeline_exclude_post',
        	[
				'label'       => __( 'Exclude Post', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => [],
				'options'     => Helper::exad_get_all_posts(),
				'condition'   => [
					'exad_post_timeline_type' => 'post'
				]
            ]
        );

        $this->add_control(
        	'exad_post_timeline_authors',
        	[
				'label'       => __( 'Author', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => [],
				'options'     => Helper::exad_get_authors()
            ]
        );

        $this->add_control(
        	'exad_post_timeline_categories',
        	[
				'label'       => __( 'Categories', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => [],
				'options'     => Helper::exad_get_all_categories()
            ]
        );

        $this->add_control(
        	'exad_post_timeline_tags',
        	[
				'label'       => __( 'Tags', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => [],
				'options'     => Helper::exad_get_all_tags()
            ]
        );

        $this->add_control(
            'exad_post_timeline_order',
            [
				'label'    => __( 'Order', 'exclusive-addons-elementor' ),
				'type'     => Controls_Manager::SELECT,
				'options'  => [
					'asc'  => __( 'Ascending', 'exclusive-addons-elementor' ),
					'desc' => __( 'Descending', 'exclusive-addons-elementor' )
                ],
                'default'  => 'desc'

            ]
        );

		$this->add_control(
            'exad_post_timeline_order_by',
            [
				'label'    => __( 'Order By', 'exclusive-addons-elementor' ),
				'type'     => Controls_Manager::SELECT,
                'default'  => 'date',
				'options'  => [
					'ID'  => __( 'ID', 'exclusive-addons-elementor' ),
					'date'  => __( 'Date', 'exclusive-addons-elementor' ),
					'modified' => __( 'Modified', 'exclusive-addons-elementor' ),
					'author' => __( 'Author Name', 'exclusive-addons-elementor' ),
					'title' => __( 'Post Title', 'exclusive-addons-elementor' ),
					'name' => __( 'Post Name', 'exclusive-addons-elementor' ),
					'rand' => __( 'Random', 'exclusive-addons-elementor' ),
                ]
            ]
        );

        $this->add_control(
            'exad_timeline_excerpt_length',
            [
				'label'   => __( 'Excerpt Words', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '30'
            ]
        );

        $this->add_control(
			'exad_post_timeline_ignore_sticky',
			[
				'label'        => esc_html__( 'Ignore Sticky?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'exad_post_timeline_divider_icon',
			[
				'label'       => __( 'Divider Icon', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-bookmark',
					'library' => 'fa-solid'
				]
			]
		);

        $this->end_controls_section();

		
        $this->start_controls_section(
            'exad_section_post_timeline_post_container',
            [
				'label' => __( 'Container', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'exad_timeline_post_container_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-post-timeline-content'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'exad_post_timeline_post_container_border',
				'selector'  => '{{WRAPPER}} .exad-post-timeline-content'
			]
		);

		$this->add_responsive_control(
			'exad_post_timeline_post_container_border_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '5',
					'right'  => '5',
					'bottom' => '5',
					'left'   => '5'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-post-timeline-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_post_timeline_post_container_padding',
			[
				'label'      => __( 'Container Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .exad-post-timeline-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_post_timeline_post_content_padding',
			[
				'label'      => __( 'Content Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '25',
					'right'  => '30',
					'bottom' => '25',
					'left'   => '30'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-post-timeline .exad-post-timeline-item .exad-post-timeline-content-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'           => 'exad_post_timeline_post_container_shadow',
				'selector'       => '{{WRAPPER}} .exad-post-timeline-content',
				'fields_options' => [
		            'box_shadow_type' 	 => [
		                'default'        =>'yes'
		            ],
		            'box_shadow'  => [
		                'default' => [
		                    'horizontal' => 0,
		                    'vertical'   => 20,
		                    'blur'       => 49,
		                    'spread'     => 0,
		                    'color'      => 'rgba(24,27,33,0.1)'
		                ]
		            ]
	            ]
			]
		);
		
		$this->add_control(
			'exad_timeline_bullet_bg_color',
			[
				'label'     => __( 'Divider Icon Background', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => $exad_primary_color,
				'condition' => [
                    'exad_post_timeline_divider_icon[value]!' => ''
                ],
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-icon'    => 'background: {{VALUE}};'
				]
			]
		);

        $this->add_control(
			'exad_timeline_bullet_icon_color',
			[
				'label'     => __( 'Divider Icon Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#D1C1FF',
				'condition' => [
                    'exad_post_timeline_divider_icon[value]!' => ''
                ],
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-icon i'  => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_control(
			'exad_timeline_vertical_line_color',
			[
				'label'     => __( 'Vertical Line Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e3e5e8',
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-item::before' => 'background: {{VALUE}};'
				]

			]
		);

		$this->add_control(
			'exad_timeline_horizontal_sep_color',
			[
				'label'     => __( 'Horizontal Seprator Line Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e3e5e8',
				'condition' => [
                    'exad_post_timeline_divider_icon[value]!' => ''
                ],
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-icon::before, {{WRAPPER}} .exad-post-timeline-icon::after' => 'border: 1px dashed {{VALUE}};'
				]

			]
		);

		$this->end_controls_section();

		//image 
		// Image Styles
		$this->start_controls_section(
			'exad_section_timeline_post_image_style',
			[
				'label'     => __( 'Image', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'exad_section_timeline_post_image_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .exad-post-timeline-content a img'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_timeline_post_image_min_height',
			[
				'label'       => __( 'Image Min Height', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-post-timeline-content a img' => 'min-height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'exad_timeline_post_image_fixed_height',
			[
				'label'        => esc_html__( 'Fixed Height ?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'Yes', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'No', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_responsive_control(
			'exad_timeline_post_image_height',
			[
				'label'       => __( 'Image Height', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' , '%'],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .exad-post-timeline-content a img' => 'height: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'exad_timeline_post_image_fixed_height' => 'yes',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'exad_post_grid_image_css_filter',
				'selector' => '{{WRAPPER}} .exad-post-timeline-content a img',
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'exad_post_timeline_title',
            [
				'label' => __( 'Title', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'exad_timeline_title_color',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-content-text h4 a' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_timeline_title_alignment',
			[
				'label'     => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
				'options'   => [
					'left'      => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-content-text h4' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_timeline_title_typography',
				'selector' => '{{WRAPPER}} .exad-post-timeline-content-text h4 a'
			]
		);

		$this->add_responsive_control(
            'exad_timeline_title_margin',
            [
                'label'      => __('Margin', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '15',
					'left'   => '0'
				],
                'selectors'  => [
                    '{{WRAPPER}} .exad-post-timeline-content-text h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
            'exad_post_timeline_excerpt',
            [
				'label' => __( 'Excerpt', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'exad_timeline_excerpt_color',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-content-text p' => 'color: {{VALUE}};'
				]
			]
		);

        $this->add_responsive_control(
			'exad_timeline_excerpt_alignment',
			[
				'label'   => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'left'      => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-right'
					],
					'justify'   => [
						'title' => __( 'Justified', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-justify'
					]
				],
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-content-text p' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_timeline_excerpt_typography',
				'selector' => '{{WRAPPER}} .exad-post-timeline-content-text p'
			]
		);

		$this->end_controls_section();

		// Date Style
		$this->start_controls_section(
            'exad_post_timeline_date',
            [
				'label' => __( 'Date', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_control(
            'exad_post_timeline_date_container_style',
            [
				'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'type'  => Controls_Manager::HEADING
            ]
        );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'exad_timeline_date_container_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-post-timeline-date'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'exad_post_timeline_date_container_border',
				'selector'  => '{{WRAPPER}} .exad-post-timeline-date'
			]
		);

		$this->add_responsive_control(
			'exad_timeline_date_container_border_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '5',
					'right'  => '5',
					'bottom' => '5',
					'left'   => '5'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-post-timeline-date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_timeline_date_container_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '25',
					'right'  => '25',
					'bottom' => '25',
					'left'   => '25'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-post-timeline-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_post_timeline_date_container_shadow',
				'selector' => '{{WRAPPER}} .exad-post-timeline-date'
			]
		);

		$this->add_control(
            'exad_post_timeline_date_year_style',
            [
				'label'     => esc_html__( 'Year', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );

		$this->add_control(
			'exad_timeline_date_color',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#424242',
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-item .exad-post-timeline-date h4' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_timeline_date_typography',
				'selector' => '{{WRAPPER}} .exad-post-timeline-item .exad-post-timeline-date h4'
			]
		);

		$this->add_control(
            'exad_post_timeline_date_month_style',
            [
				'label'     => esc_html__( 'Month and Date', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );

		$this->add_control(
			'exad_timeline_date_month_color',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-item .exad-post-timeline-date p' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'timeline_date_typography',
				'selector' => '{{WRAPPER}} .exad-post-timeline-item .exad-post-timeline-date p'
			]
		);

		$this->end_controls_section();

	}


	protected function render( ) {
		$settings                  = $this->get_settings_for_display();		
		$settings['template_type'] = $this->get_name();
		$settings['post_args']     = Helper::exad_get_post_arguments($settings, 'exad_post_timeline');
		
		$this->add_render_attribute(
			'exad_post_timeline_wrapper',
			[
				'class'               => 'exad-post-timeline'
			]
		);

		$this->add_render_attribute(
			'exad_post_timeline',
			[
				'class'	=> 'exad-post-timeline'
			]
		);
		?>

		<div class="exad-post-timeline">
        	<?php echo Helper::exad_get_posts( $settings );?>
        </div>

	<?php
	}
}