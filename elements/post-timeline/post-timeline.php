<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Exad_Post_Timeline extends Widget_Base {


	public function get_name() {
		return 'exad-post-timeline';
	}

	public function get_title() {
		return __( 'DC Post Timeline', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function _register_controls() {

		
        $this->start_controls_section(
            'exad_section_post_timeline_filters',
            [
                'label' => __( 'Settings', 'exclusive-addons-elementor' ),
            ]
        );
        
      
        $this->add_control(
            'exad_post_timeline_type',
            [
                'label' => __( 'Post Type', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => exad_get_post_types(),
                'default' => 'post',

            ]
        );

        $this->add_control(
            'exad_posts_per_page',
            [
                'label' => __( 'Posts Per Page', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '4'
            ]
        );
		
        $this->add_control(
            'exad_offset',
            [
                'label' => __( 'Offset', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '0'
            ]
        );

        $this->add_control(
        	'exad_get_timeline_authors',
        	[
                'label' => __( 'Author', 'exclusive-addons-elementor' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => [],
                'options' => exad_get_authors(),
            ]
        );

        $this->add_control(
        	'exad_get_timeline_categories',
        	[
                'label' => __( 'Categories', 'exclusive-addons-elementor' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => [],
                'options' => exad_get_all_categories(),
            ]
        );

        $this->add_control(
        	'exad_get_timeline_tags',
        	[
                'label' => __( 'Tags', 'exclusive-addons-elementor' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => [],
                'options' => exad_get_all_tags(),
            ]
        );

        $this->add_control(
            'exad_order',
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
            'exad_timeline_excerpt_length',
            [
                'label' => __( 'Excerpt Words', 'essential-addons-elementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '20',
            ]
        );

        $this->add_control(
			'exad_post_timeline_ignore_sticky',
			[
				'label' => esc_html__( 'Ignore Sticky?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->end_controls_section();

		//$this->layout_controls();

        $this->start_controls_section(
            'exad_section_post_timeline_style',
            [
                'label' => __( 'Timeline Style', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'exad_timeline_overlay_color',
			[
				'label' => __( 'Overlay Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'description' => __('Leave blank or Clear to use default gradient overlay', 'exclusive-addons-elementor'),
				'default' => 'linear-gradient(45deg, #3f3f46 0%, #05abe0 100%) repeat scroll 0 0 rgba(0, 0, 0, 0)',
				'selectors' => [
					'{{WRAPPER}} .exad-timeline-post-inner' => 'background: {{VALUE}}',
				]

			]
		);

        $this->add_control(
			'exad_timeline_bullet_color',
			[
				'label' => __( 'Timeline Bullet Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#9fa9af',
				'selectors' => [
					'{{WRAPPER}} .exad-timeline-bullet' => 'background-color: {{VALUE}};',
				]

			]
		);

        $this->add_control(
			'exad_timeline_bullet_border_color',
			[
				'label' => __( 'Timeline Bullet Border Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#fff',
				'selectors' => [
					'{{WRAPPER}} .exad-timeline-bullet' => 'border-color: {{VALUE}};',
				]

			]
		);

        $this->add_control(
			'exad_timeline_vertical_line_color',
			[
				'label' => __( 'Timeline Vertical Line Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> 'rgba(83, 85, 86, .2)',
				'selectors' => [
					'{{WRAPPER}} .exad-timeline-post:after' => 'background-color: {{VALUE}};',
				]

			]
		);

        $this->add_control(
			'exad_timeline_border_color',
			[
				'label' => __( 'Border & Arrow Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#e5eaed',
				'selectors' => [
					'{{WRAPPER}} .exad-timeline-post-inner' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .exad-timeline-post-inner::after' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .exad-timeline-post:nth-child(2n) .exad-timeline-post-inner::after' => 'border-right-color: {{VALUE}};',
				]

			]
		);

        $this->add_control(
			'exad_timeline_date_background_color',
			[
				'label' => __( 'Date Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> 'rgba(0, 0, 0, 0.7)',
				'selectors' => [
					'{{WRAPPER}} .exad-timeline-post time' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .exad-timeline-post time::before' => 'border-bottom-color: {{VALUE}};',
				]

			]
		);

        $this->add_control(
			'exad_timeline_date_color',
			[
				'label' => __( 'Date Text Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#fff',
				'selectors' => [
					'{{WRAPPER}} .exad-timeline-post time' => 'color: {{VALUE}};',
				]

			]
		);


		$this->end_controls_section();

        $this->start_controls_section(
            'exad_section_typography',
            [
                'label' => __( 'Typography', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_control(
			'exad_timeline_title_style',
			[
				'label' => __( 'Title Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
			'exad_timeline_title_color',
			[
				'label' => __( 'Title Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#fff',
				'selectors' => [
					'{{WRAPPER}} .exad-timeline-post-title h2' => 'color: {{VALUE}};',
				]

			]
		);

		$this->add_responsive_control(
			'exad_timeline_title_alignment',
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
					'{{WRAPPER}} .exad-timeline-post-title h2' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_timeline_title_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .exad-timeline-post-title h2',
			]
		);

		$this->add_control(
			'exad_timeline_excerpt_style',
			[
				'label' => __( 'Excerpt Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
			'exad_timeline_excerpt_color',
			[
				'label' => __( 'Excerpt Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-timeline-post-excerpt p' => 'color: {{VALUE}};',
				]
			]
		);

        $this->add_responsive_control(
			'exad_timeline_excerpt_alignment',
			[
				'label' => __( 'Excerpt Alignment', 'exclusive-addons-elementor' ),
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
					'{{WRAPPER}} .exad-timeline-post-excerpt p' => 'text-align: {{VALUE}};',
				],
			]
		);

		


		$this->end_controls_section();
		/**
		 * Load More Button Style Controls!
		 */
		//$this->load_more_button_style();

	}


	protected function render( ) {
        $settings = $this->get_settings_for_display();

        $settings['template_type'] = $this->get_name();
		
		$this->add_render_attribute(
			'exad_post_timeline_wrapper',
			[
				'id'		=> "exad-post-timeline-{$this->get_id()}",
				'class'		=> 'exad-post-timeline',
				'data-total_posts'	=> $total_post,
				'data-timeline_id'	=> $this->get_id(),
				
				'data-post_type'	=> $settings['post_type'],
				'data-posts_per_page'	=> $settings['posts_per_page'] ? $settings['posts_per_page'] : 4,
				'data-post_order'		=> $settings['order'],
				'data-post_orderby'		=> $settings['orderby'],
				'data-post_offset'		=> intval( $settings['offset'] ),

				'data-show_images'	=> $settings['exad_show_image'],
				'data-image_size'	=> $settings['image_size'],
				'data-show_title'	=> $settings['exad_show_title'],

				'data-show_excerpt'	=> $settings['exad_show_excerpt'],
				'data-excerpt_length'	=> $settings['exad_excerpt_length'],

				'data-btn_text'			=> $settings['show_load_more_text'],

				'data-tax_query'		=> json_encode( ! empty( $tax_query ) ? $tax_query : [] ),
				'data-exclude_posts'	=> json_encode( ! empty( $settings['post__not_in'] ) ? $settings['post__not_in'] : [] ),
				'data-post__in'	=> json_encode( ! empty( $settings['post__in'] ) ? $settings['post__in'] : [] ),
			]
		);

		$this->add_render_attribute(
			'exad_post_timeline',
			[
				'class'	=> [ 'exad-post-timeline', "exad-post-appender-{$this->get_id()}" ]
			]
		);

        ?>

		<!-- Load More Button -->
		<div class="exad-post-timeline one">

          	<?php exad_get_posts( $settings ); ?>

        </div>  
		<?php
	}

	protected function content_template() {}
}
Plugin::instance()->widgets_manager->register_widget_type( new Exad_Post_Timeline() );