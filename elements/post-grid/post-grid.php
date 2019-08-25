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
                'label' => __( 'Settings', 'exclusive-addons-elementor' ),
            ]
        );
        
      
        $this->add_control(
            'exad_post_grid_type',
            [
                'label' => __( 'Post Type', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => Exad_Helper::exad_get_post_types(),
                'default' => 'post',

            ]
        );

        $this->add_control(
            'exad_post_grid_per_page',
            [
                'label' => __( 'Posts Per Page', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '4'
            ]
		);

		$this->add_control(
            'exad_post_grid_column_no',
            [
                'label' => __( 'Number of Columns', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'1' => esc_html__( '1', 'exclusive-addons-elementor' ),
					'2' => esc_html__( '2', 'exclusive-addons-elementor' ),
					'3' => esc_html__( '3', 'exclusive-addons-elementor' ),
					'4' => esc_html__( '4', 'exclusive-addons-elementor' ),
					'5' => esc_html__( '5', 'exclusive-addons-elementor' ),
					'6' => esc_html__( '6', 'exclusive-addons-elementor' ),
				],
            ]
		);
		
		
        $this->add_control(
            'exad_post_grid_offset',
            [
                'label' => __( 'Offset', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '0'
            ]
        );

        $this->add_control(
        	'exad_post_grid_authors',
        	[
                'label' => __( 'Author', 'exclusive-addons-elementor' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => [],
                'options' => Exad_Helper::exad_get_authors(),
            ]
        );

        $this->add_control(
        	'exad_post_grid_categories',
        	[
                'label' => __( 'Categories', 'exclusive-addons-elementor' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => [],
                'options' => Exad_Helper::exad_get_all_categories(),
            ]
        );

        $this->add_control(
        	'exad_post_grid_tags',
        	[
                'label' => __( 'Tags', 'exclusive-addons-elementor' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => [],
                'options' => Exad_Helper::exad_get_all_tags(),
            ]
        );

        $this->add_control(
            'exad_post_grid_order',
            [
                'label' => __( 'Order', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending'
                ],
                'default' => 'desc',

            ]
        );

        $this->add_control(
            'exad_grid_excerpt_length',
            [
                'label' => __( 'Excerpt Words', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '20',
            ]
        );

        $this->add_control(
			'exad_post_grid_ignore_sticky',
			[
				'label' => esc_html__( 'Ignore Sticky?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
            'exad_section_post_grid_container',
            [
                'label' => __( 'Container Styles', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
		);
		
		$this->add_control(
			'exad_grid_post_bg_color',
			[
				'label' => __( 'Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#f5f7fa',
				'selectors' => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-container' => 'background: {{VALUE}};',
				]

			]
		);

		$this->add_control(
			'exad_post_grid_radius',
			[
				'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-container'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_post_grid_box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-row-wrapper .exad-post-grid-container',
			]
		);

		$this->add_control(
			'exad_grid_comment_hover_bg_color',
			[
				'label' => __( 'Comment Hover Background', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#ff704e',
				'selectors' => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-one .exad-post-grid-author-action li a:hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_post_grid_preset' => '-one'
				]
			]
		);

		$this->end_controls_section();


        $this->start_controls_section(
            'exad_section_post_grid_presets',
            [
                'label' => __( 'General Styles', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'exad_post_grid_preset',
			[
				'label' => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '-one',
				'options' => [
					'-one' => esc_html__( 'Style 1', 'exclusive-addons-elementor' ),
					'-three' => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
				],
			]
		);

        

		$this->end_controls_section();

        $this->start_controls_section(
            'exad_post_grid_title',
            [
                'label' => __( 'Title', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_control(
			'exad_post_grid_title_style',
			[
				'label' => __( 'Title Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->start_controls_tabs( 'exad_post_grid_title_tabs' );

			$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_grid_title_color',
				[
					'label' => __( 'Text Color', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default'=> '#0a1724',
					'selectors' => [
						'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-body .exad-post-grid-title' => 'color: {{VALUE}};',
					]
	
				]
			);

			$this->end_controls_tab();
			
			$this->start_controls_tab( 'hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

			$this->add_control(
				'exad_grid_title_hover_color',
				[
					'label' => __( 'Hover Color', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default'=> '#0A1724',
					'selectors' => [
						'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-body .exad-post-grid-title:hover' => 'color: {{VALUE}};',
					]
	
				]
			);

			$this->end_controls_tab();
		
		$this->end_controls_tabs();


		$this->add_responsive_control(
			'exad_grid_title_alignment',
			[
				'label' => __( 'Title Alignment', 'exclusive-addons-elementor' ),
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
					]
				],
				'selectors' => [
					'{{WRAPPER}} .exad-post-grid-body .exad-post-grid-title' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_grid_title_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .exad-row-wrapper .exad-post-grid-body .exad-post-grid-title',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
            'exad_post_grid_excerpt_style',
            [
                'label' => __( 'Excerpt', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'exad_grid_excerpt_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#848484',
				'selectors' => [
					'{{WRAPPER}} .exad-post-grid-body .exad-post-grid-description' => 'color: {{VALUE}};',
				]
			]
		);

        $this->add_responsive_control(
			'exad_grid_excerpt_alignment',
			[
				'label' => __( 'Alignment', 'exclusive-addons-elementor' ),
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
					'justify' => [
						'title' => __( 'Justified', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .exad-post-grid-body .exad-post-grid-description' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
            'exad_post_grid_category_style',
            [
                'label' => __( 'Category', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
		$this->add_control(
			'exad_grid_category_style',
			[
				'label' => __( 'Category Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
			'exad_grid_category_color',
			[
				'label' => __( 'Text Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#848484',
				'selectors' => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-body .exad-post-grid-category li a' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'exad_grid_category_bg_odd_color',
			[
				'label' => __( 'Background Color (Odd)', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#3ac772',
				'selectors' => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-three .exad-post-grid-body .exad-post-grid-category li:nth-child(2n-1)' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_post_grid_preset' => '-three'
				]
			]
		);

		$this->add_control(
			'exad_grid_category_bg_even_color',
			[
				'label' => __( 'Background Color (Even)', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#8774ff',
				'selectors' => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-three .exad-post-grid-body .exad-post-grid-category li:nth-child(2n)' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_post_grid_preset' => '-three'
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
            'exad_post_grid_author_date_style',
            [
                'label' => __( 'Author & Date', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
		$this->add_control(
			'exad_grid_author_style',
			[
				'label' => __( 'Author Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
			'exad_grid_author_text_color',
			[
				'label' => __( 'Text Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#0a1724',
				'selectors' => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-author-name' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'exad_grid_date_style',
			[
				'label' => __( 'Date Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
			'exad_grid_date_text_color',
			[
				'label' => __( 'Text Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#0a1724',
				'selectors' => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-author-date' => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_section();
		

	}


	protected function render() {
        $settings = $this->get_settings_for_display();

        $settings['template_type'] = $this->get_name();
        $settings['post_args'] = Exad_Helper::exad_get_post_arguments($settings, 'exad_post_grid');
		
		$this->add_render_attribute(
			'exad_post_grid_wrapper',
			[
				'id'		=> "exad-post-grid-{$this->get_id()}",
				'class'		=> "exad-row-wrapper exad-col-{$settings['exad_post_grid_column_no']}",
				'data-grid_id'	=> $this->get_id(),
				'data-post_type'	=> $settings['exad_post_grid_type'],
				'data-posts_per_page'	=> $settings['exad_post_grid_per_page'] ? $settings['exad_post_grid_per_page'] : 4,
				'data-post_order'		=> $settings['exad_post_grid_order'],
				'data-post_offset'		=> intval( $settings['exad_post_grid_offset'] ),
				'data-excerpt_length'	=> $settings['exad_grid_excerpt_length'],

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