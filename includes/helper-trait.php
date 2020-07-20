<?php
namespace ExclusiveAddons\Elementor\Traits;

use \ExclusiveAddons\Elementor\Helper;
use \Elementor\Controls_Manager;

trait HelperFunc {
    
    protected function get_post_grid_controls() {
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
				'options' => Helper::exad_get_post_types(),
				'default' => 'post'

            ]
        );

        $this->add_control(
            'exad_post_grid_per_page',
            [
				'label'   => __( 'Posts Per Page', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '6'
            ]
		);

		$this->add_control(
            'exad_post_grid_column_no',
            [
				'label'   => __( 'Columns', 'exclusive-addons-elementor' ),
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
				'options'     => Helper::exad_get_authors()
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
				'options'     => Helper::exad_get_all_categories(),
				'condition'   => [
					'exad_post_grid_type' => 'post'
				]
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
				'options'     => Helper::exad_get_all_tags(),
				'condition'   => [
					'exad_post_grid_type' => 'post'
				]
            ]
        );

        $this->add_control(
            'exad_post_grid_order',
            [
				'label'    => __( 'Order', 'exclusive-addons-elementor' ),
				'type'     => Controls_Manager::SELECT,
                'default'  => 'desc',
				'options'  => [
					'asc'  => __( 'Ascending', 'exclusive-addons-elementor' ),
					'desc' => __( 'Descending', 'exclusive-addons-elementor' )
                ]
            ]
        );

        $this->add_control(
			'exad_post_grid_ignore_sticky',
			[
				'label'        => esc_html__( 'Ignore Sticky?', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
            'exad_post_grid_show_excerpt',
            [
                'label'        => esc_html__( 'Enable Excerpt.', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'	   => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
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
				'label'        => esc_html__( 'Enable Image', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
			'exad_post_grid_show_title',
			[
				'label'        => esc_html__( 'Enable Title', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'exad_post_grid_title_full',
			[
				'label'        => esc_html__( 'Enable Title Length (Full or Short)', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'Full', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Short', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
            'exad_grid_title_length',
            [
				'label'     => __( 'Title Words Length', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '10',
				'condition' => [
					'exad_post_grid_title_full!' => 'yes'
				]
            ]
        );

        $this->add_control(
            'exad_post_grid_show_read_more_btn',
            [
                'label'        => esc_html__( 'Enable Details Button', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'	   => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
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

        $this->add_control(
            'exad_post_grid_enable_pagination',
            [
                'label'        => esc_html__( 'Enable Pagination', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'	   => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'exad_post_grid_pagination_mid_size',
            [
				'label'   => __( 'Mid Size', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '2',
				'description' => __( 'How many numbers to either side of the current pages'. 'exclusive-addons-elementor' ),
				'condition'     => [
                    '.exad_post_grid_enable_pagination' => 'yes'
                ]
            ]
		);

		$this->add_control(
            'exad_post_grid_pagination_previous_text',
            [   
                'label'         => esc_html__( 'Previous Page Text.', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Previous', 'exclusive-addons-elementor'),
                'default'       => esc_html__('Previous', 'exclusive-addons-elementor' ),
                'condition'     => [
                    '.exad_post_grid_enable_pagination' => 'yes'
                ]
            ]
        );

		$this->add_control(
            'exad_post_grid_pagination_next_text',
            [   
                'label'         => esc_html__( 'Next Page Text.', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Next', 'exclusive-addons-elementor'),
                'default'       => esc_html__('Next', 'exclusive-addons-elementor' ),
                'condition'     => [
                    '.exad_post_grid_enable_pagination' => 'yes'
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
				'label'        => esc_html__( 'Enable Category.', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'exad_post_grid_post_data_position',
			[
				'label' => __( 'Post Data Position', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'post_data_middle',
				'options' => [
					'post_data_middle'  => __( 'Middle', 'exclusive-addons-elementor' ),
					'post_data_bottom'  => __( 'Bottom', 'exclusive-addons-elementor' ),
				],
			]
		);

        $this->add_control(
			'exad_post_grid_show_user_avatar',
			[
				'label'        => esc_html__( 'Enable Avatar.', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

        $this->add_control(
			'exad_post_grid_show_user_name',
			[
				'label'        => esc_html__( 'Enable Author Name.', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
			'exad_post_grid_show_user_name_tag',
			[
				'label'        => esc_html__( 'Enable Author Name Tag.', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
                'condition'     => [
                    '.exad_post_grid_show_user_name' => 'yes'
                ]
			]
		);

        $this->add_control(
            'exad_post_grid_user_name_tag',
            [   
                'label'         => esc_html__( 'Author Name Tag', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => esc_html__('By: ', 'exclusive-addons-elementor' ),
                'condition'     => [
					'.exad_post_grid_show_user_name_tag' => 'yes',
					'.exad_post_grid_show_user_name'     => 'yes'
                ]
            ]
        );

        $this->add_control(
			'exad_post_grid_show_date',
			[
				'label'        => esc_html__( 'Enable Date.', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
			'exad_post_grid_show_date_tag',
			[
				'label'        => esc_html__( 'Enable Date Tag.', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
                'condition'     => [
                    'exad_post_grid_show_date' => 'yes'
                ]
			]
		);

        $this->add_control(
            'exad_post_grid_date_tag',
            [   
                'label'         => esc_html__( 'Date Tag', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => esc_html__('Date: ', 'exclusive-addons-elementor' ),
                'condition'     => [
					'exad_post_grid_show_date_tag' => 'yes',
					'exad_post_grid_show_date'     => 'yes'
                ]
            ]
        );

        $this->add_control(
			'exad_post_grid_show_read_time',
			[
				'label'        => esc_html__( 'Enable Reading Time.', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

        $this->add_control(
			'exad_post_grid_show_comment',
			[
				'label'        => esc_html__( 'Enable Comment.', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'	   => __( 'On', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'Off', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->end_controls_section();
    }

    public function exad_ajax_pagination( $settings ){

        $paged = $_POST['page'];
        $post_settings = $this->get_settings_for_display();
        $post_settings['post_args'] = Helper::exad_get_post_arguments( $settings, 'exad_post_grid' );

        $post_args = array(
            'post_type'        => 'post',
            'posts_per_page'        => 3,
            'paged'            => $paged,
        );

        $posts = new \WP_Query( $post_args );

        $html = '';

        while( $posts->have_posts() ) : $posts->the_post(); 

            $html .= '<li>'.get_the_title().'</li>';
            $html .= include EXAD_TEMPLATES . 'tmpl-post-grid.php';

        endwhile;
        wp_reset_postdata();

        echo $html;
        // var_dump( $html );
        die();
    }

}
