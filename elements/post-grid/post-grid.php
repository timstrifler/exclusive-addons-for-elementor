<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Exad_Post_Grid extends Widget_Base {


	public function get_name() {
		return 'exad-post-grid';
	}

	public function get_title() {
		return __( 'DC Post Grid', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'eicon-post-list';
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
					'1' => esc_html__( 'One', 'exclusive-addons-elementor' ),
					'2' => esc_html__( 'Two', 'exclusive-addons-elementor' ),
					'3' => esc_html__( 'Three', 'exclusive-addons-elementor' ),
					'4' => esc_html__( 'Four', 'exclusive-addons-elementor' ),
					'5' => esc_html__( 'Five', 'exclusive-addons-elementor' ),
					'6' => esc_html__( 'Six', 'exclusive-addons-elementor' ),
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
                'label' => __( 'Excerpt Words', 'essential-addons-elementor' ),
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
            'exad_section_post_grid_style',
            [
                'label' => __( 'Post Grid Styles', 'exclusive-addons-elementor' ),
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

        $this->add_control(
			'exad_grid_post_bg_color',
			[
				'label' => __( 'Post Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#f5f7fa',
				'selectors' => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-container' => 'background: {{VALUE}};',
				]

			]
		);


		$this->add_control(
			'exad_grid_date_bg_color',
			[
				'label' => __( 'Date Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .exad-post-grid-date' => 'background: {{VALUE}};',
				]

			]
		);
		

		$this->add_control(
			'exad_grid_bullet_bg_color',
			[
				'label' => __( 'Bullet Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#A282FF',
				'selectors' => [
					'{{WRAPPER}} .exad-post-grid-icon' => 'background: {{VALUE}};',
				]

			]
		);

        $this->add_control(
			'exad_grid_bullet_icon_color',
			[
				'label' => __( 'Bullet Icon Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#D1C1FF',
				'selectors' => [
					'{{WRAPPER}} .exad-post-grid-icon i' => 'color: {{VALUE}};',
				]

			]
		);


        $this->add_control(
			'exad_grid_vertical_line_color',
			[
				'label' => __( 'Vertical Line Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#e3e5e8',
				'selectors' => [
					'{{WRAPPER}} .exad-post-grid-item::before' => 'background: {{VALUE}};',
				]

			]
		);

		$this->add_control(
			'exad_grid_horizontal_sep_color',
			[
				'label' => __( 'Horizontal Seprator Line Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#e3e5e8',
				'selectors' => [
					'{{WRAPPER}} .exad-post-grid-icon::before, {{WRAPPER}} .exad-post-grid-icon::after' => 'border: 1px dashed {{VALUE}};',
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
			'exad_grid_title_style',
			[
				'label' => __( 'Title Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
			'exad_grid_title_color',
			[
				'label' => __( 'Title Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'=> '#0a1724',
				'selectors' => [
					'{{WRAPPER}} .exad-row-wrapper .exad-post-grid-body .exad-post-grid-title' => 'color: {{VALUE}};',
				]

			]
		);

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

		$this->add_control(
			'exad_grid_excerpt_style',
			[
				'label' => __( 'Excerpt Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
			'exad_grid_excerpt_color',
			[
				'label' => __( 'Excerpt Color', 'exclusive-addons-elementor' ),
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
					'{{WRAPPER}} .exad-post-grid-body .exad-post-grid-description' => 'text-align: {{VALUE}};',
				],
			]
		);

		


		$this->end_controls_section();
		/**
		 * Load More Button Style Controls!
		 */
		//$this->load_more_button_style();

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
				//'data-total_posts'	=> $total_post,
				'data-grid_id'	=> $this->get_id(),
				
				'data-post_type'	=> $settings['exad_post_grid_type'],
				'data-posts_per_page'	=> $settings['exad_post_grid_per_page'] ? $settings['exad_post_grid_per_page'] : 4,
				'data-post_order'		=> $settings['exad_post_grid_order'],
				//'data-post_orderby'		=> $settings['exad_post_grid_orderby'],
				'data-post_offset'		=> intval( $settings['exad_post_grid_offset'] ),

				//'data-show_images'	=> $settings['exad_show_image'],
				//'data-image_size'	=> $settings['image_size'],
				//'data-show_title'	=> $settings['exad_show_title'],

				//'data-show_excerpt'	=> $settings['exad_show_excerpt'],
				'data-excerpt_length'	=> $settings['exad_grid_excerpt_length'],

				//'data-btn_text'			=> $settings['show_load_more_text'],

				//'data-tax_query'		=> json_encode( ! empty( $tax_query ) ? $tax_query : [] ),
				//'data-exclude_posts'	=> json_encode( ! empty( $settings['post__not_in'] ) ? $settings['post__not_in'] : [] ),
				//'data-post__in'	=> json_encode( ! empty( $settings['post__in'] ) ? $settings['post__in'] : [] ),
			]
		);

        ?>

		<!-- Load More Button -->
		<div <?php echo $this->get_render_attribute_string( 'exad_post_grid_wrapper' ); ?>>
        	<?php Exad_Helper::exad_get_posts( $settings ); ?>
    	</div>


		<?php
	}

	protected function content_template() {}
}
Plugin::instance()->widgets_manager->register_widget_type( new Exad_Post_Grid() );