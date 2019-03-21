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
                'options' => Exad_Helper::exad_get_post_types(),
                'default' => 'post',

            ]
        );

        $this->add_control(
            'exad_post_timeline_per_page',
            [
                'label' => __( 'Posts Per Page', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '4'
            ]
        );
		
        $this->add_control(
            'exad_post_timeline_offset',
            [
                'label' => __( 'Offset', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '0'
            ]
        );

        $this->add_control(
        	'exad_post_timeline_authors',
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
        	'exad_post_timeline_categories',
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
        	'exad_post_timeline_tags',
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
            'exad_post_timeline_order',
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

		
        $this->start_controls_section(
            'exad_section_post_timeline_general',
            [
                'label' => __( 'General Styles', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'exad_timeline_post_bg_color',
			[
				'label' => __( 'Post Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-content' => 'background: {{VALUE}};',
				]

			]
		);
		
		$this->add_control(
			'exad_timeline_bullet_bg_color',
			[
				'label' => __( 'Bullet Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#A282FF',
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-icon' => 'background: {{VALUE}};',
				]

			]
		);

        $this->add_control(
			'exad_timeline_bullet_icon_color',
			[
				'label' => __( 'Bullet Icon Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#D1C1FF',
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-icon i' => 'color: {{VALUE}};',
				]

			]
		);


        $this->add_control(
			'exad_timeline_vertical_line_color',
			[
				'label' => __( 'Vertical Line Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#e3e5e8',
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-item::before' => 'background: {{VALUE}};',
				]

			]
		);

		$this->add_control(
			'exad_timeline_horizontal_sep_color',
			[
				'label' => __( 'Horizontal Seprator Line Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#e3e5e8',
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-icon::before, {{WRAPPER}} .exad-post-timeline-icon::after' => 'border: 1px dashed {{VALUE}};',
				]

			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'exad_post_timeline_title',
            [
                'label' => __( 'Title', 'exclusive-addons-elementor' ),
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
				'default'=> '#132c47',
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-content-text h4 a' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .exad-post-timeline-content-text h4' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_timeline_title_typography',
				'label' => __( 'Typography', 'exclusive-addons-elementor' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .exad-post-timeline-content-text h4 a',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
            'exad_post_timeline_excerpt',
            [
                'label' => __( 'Excerpt', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'exad_timeline_excerpt_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-content-text p' => 'color: {{VALUE}};',
				]
			]
		);

        $this->add_responsive_control(
			'exad_timeline_excerpt_alignment',
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
					'{{WRAPPER}} .exad-post-timeline-content-text p' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		// Date Style
		$this->start_controls_section(
            'exad_post_timeline_date',
            [
                'label' => __( 'Date', 'exclusive-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_control(
			'exad_timeline_date_bg_color',
			[
				'label' => __( 'Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-date' => 'background: {{VALUE}};',
				]

			]
		);

		$this->add_control(
			'exad_timeline_date_color',
			[
				'label' => __( 'Year Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '',
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-item .exad-post-timeline-date h4' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'exad_timeline_date_month_color',
			[
				'label' => __( 'Month Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '',
				'selectors' => [
					'{{WRAPPER}} .exad-post-timeline-item .exad-post-timeline-date p' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
					'name' => 'timeline_date_typography',
					'selector' => '{{WRAPPER}} .exad-post-timeline-item .exad-post-timeline-date h4',
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

        $settings['post_args'] = Exad_Helper::exad_get_post_arguments($settings, 'exad_post_timeline');
		
		$this->add_render_attribute(
			'exad_post_timeline_wrapper',
			[
				'id'		=> "exad-post-timeline-{$this->get_id()}",
				'class'		=> 'exad-post-timeline',
				'data-timeline_id'	=> $this->get_id(),
				
				'data-post_type'	=> $settings['exad_post_timeline_type'],
				'data-posts_per_page'	=> $settings['exad_post_timeline_per_page'] ? $settings['exad_post_timeline_per_page'] : 4,
				'data-post_order'		=> $settings['exad_post_timeline_order'],
				'data-post_offset'		=> intval( $settings['exad_post_timeline_offset'] ),
				'data-tax_query'		=> json_encode( ! empty( $tax_query ) ? $tax_query : [] ),
				'data-exclude_posts'	=> json_encode( ! empty( $settings['post__not_in'] ) ? $settings['post__not_in'] : [] ),
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

          	<?php Exad_Helper::exad_get_posts( $settings ); ?>

        </div>  
		<?php
	}

	protected function content_template() {}
}
Plugin::instance()->widgets_manager->register_widget_type( new Exad_Post_Timeline() );