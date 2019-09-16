<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Breadcrumbs extends Widget_Base {

	public function get_name() {
		return 'exad-breadcrumbs';
	}

	public function get_title() {
		return esc_html__( 'Breadcrumbs', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-flip-box';
	}

   	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function _register_controls() {

  		$this->start_controls_section(
			'exad_section_side_a_content',
			[
				'label' => __( 'Front', 'exclusive-addons-elementor' ),
			]
		);

        $this->add_control(
            'exad_breadcrumbs_skin_type',
            [
                'label'     => esc_html__( 'Skin Type', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'one',
                'options'   => [
                    'one'        => esc_html__( 'Skin 1',   'exclusive-addons-elementor' ),
                    'two'        => esc_html__( 'Skin 2', 'exclusive-addons-elementor' ),
                    'three'      => esc_html__( 'Skin 3', 'exclusive-addons-elementor' ),
                    'four'       => esc_html__( 'Skin 4', 'exclusive-addons-elementor' ),
                    'five'       => esc_html__( 'Skin 5', 'exclusive-addons-elementor' )
                ]
            ]
        );

		$this->add_control(
			'exad_breadcrumbs_home_text',
			[
				'label'       => __( 'Text For Home', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Home', 'exclusive-addons-elementor' )
			]
		);

        $this->add_control(
            'exad_breadcrumbs_with_icon',
            [
                'label'         => esc_html__( 'Show With Icon', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'return_value'  => 'yes'
            ]
        ); 

		$this->add_control(
			'exad_breadcrumbs_home_icon',
			[
				'label'     => __( 'Home Icon', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-home',
                'condition'     => [
                    'exad_breadcrumbs_with_icon' => 'yes'
                ]
			]
		);

		$this->add_control(
			'exad_breadcrumbs_other_icon',
			[
				'label'     => __( 'Icon For Others', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-file-text-o',
                'condition'     => [
                    'exad_breadcrumbs_with_icon' => 'yes'
                ]
			]
		);

		$this->add_control(
			'exad_flipbox_front_icon',
			[
				'label'     => __( 'Icon', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-heart',
			]
		);

		$this->add_control(
			'exad_flipbox_front_title',
			[
				'label'       => __( 'Title', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Heading Front', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Your Title', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_flipbox_front_description',
			[
				'label'       => __( 'Description', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Your Description', 'exclusive-addons-elementor' ),
				'title'       => __( 'Input image text here', 'exclusive-addons-elementor' ),
			]
		);

	
		$this->end_controls_section();

		$this->start_controls_section(
			'exad_section_back_content',
			[
				'label' => __( 'Back', 'exclusive-addons-elementor' ),
			]
		);

		

		$this->add_control(
			'exad_flipbox_back_icon',
			[
				'label'     => __( 'Icon', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-heart',
			]
		);

		$this->add_control(
			'exad_flipbox_back_title',
			[
				'label'       => __( 'Title', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Heading Back', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Your Title', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_flipbox_back_description',
			[
				'label'       => __( 'Description', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Your Description', 'exclusive-addons-elementor' ),
				'title'       => __( 'Input image text here', 'exclusive-addons-elementor' ),
				'separator'   => 'none',
			]
		);

		$this->add_control(
			'exad_flipbox_button_text',
			[
				'label'     => __( 'Button Text', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => [ 'active' => true ],
				'default'   => __( 'Click Here', 'exclusive-addons-elementor' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'exad_flipbox_button_link',
			[
				'label'       => __( 'Link', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
        			'url' => '#',
        			'is_external' => '',
     			],
     			'show_external' => true,
			]
		);

		$this->add_control(
			'exad_flipbox_link_click',
			[
				'label'   => __( 'Apply Link On', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'box'    => __( 'Whole Box', 'exclusive-addons-elementor' ),
					'button' => __( 'Button Only', 'exclusive-addons-elementor' ),
				],
				'default'   => 'button',
				'condition' => [
					'link[url]!' => '',
				],
			]
		);

		$this->add_control(
			'exad_flipbox_button_size',
			[
				'label' => __( 'Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => [
					'xs' => __( 'Extra Small', 'exclusive-addons-elementor' ),
					'sm' => __( 'Small', 'exclusive-addons-elementor' ),
					'md' => __( 'Medium', 'exclusive-addons-elementor' ),
					'lg' => __( 'Large', 'exclusive-addons-elementor' ),
					'xl' => __( 'Extra Large', 'exclusive-addons-elementor' ),
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'back_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .bdt-flip-box-back',
			]
		);

		$this->add_control(
			'back_background_overlay',
			[
				'label' => __( 'Background Overlay', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-flip-box-back .bdt-flip-box-layer-overlay' => 'background-color: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
					'back_background_image[id]!' => '',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'exad_section_flipbox_settings',
			[
				'label' => __( 'General Styles', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_flipbox_style',
			[
				'label'   => __( 'Flip Style', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left-to-right',
				'options' => [
					'left-to-right'  => __( 'Left to Right', 'exclusive-addons-elementor' ),
					'right-to-left' => __( 'Right to Left', 'exclusive-addons-elementor' ),
					'top-to-bottom'    => __( 'Top to Bottom', 'exclusive-addons-elementor' ),
					'bottom-to-top'  => __( 'Bottom to Top', 'exclusive-addons-elementor' ),
					'top-to-bottom-angle'  => __( 'Diagonal (Top to Bottom)', 'exclusive-addons-elementor' ),
					'bottom-to-top-angle'  => __( 'Diagonal (Bottom to Top)', 'exclusive-addons-elementor' ),
					'fade-in-out'  => __( 'Fade In Out', 'exclusive-addons-elementor' ),
				],
				
			]
		);

		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Tab Style (Flipbox Front)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_front_end_style_section',
			[
				'label' => __( 'Front', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		/**
		 * Title
		 */
		$this->add_control(
			'exad_flipbox_front_icon_style',
			[
				'label' => esc_html__( 'Icon Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		/**
		 * 
		 */
		$this->add_control(
			'exad_flipbox_front_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-image i' => 'color: {{VALUE}};',
				],
				
			]
		);


		/**
		 * 
		 */
		$this->add_control(
			'exad_flipbox_front_icon_bg',
			[
				'label' => esc_html__( 'Icon Background', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#826EFF',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-inner .exad-flip-box-front .exad-flip-box-front-image' => 'background: {{VALUE}};',
				],
				
			]
		);

		/**
		 * Title
		 */
		$this->add_control(
			'exad_flipbox_front_title_heading',
			[
				'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		/**
		 * Condition: 'exad_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_control(
			'exad_flipbox_front_title_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-title' => 'color: {{VALUE}};',
				],
				
			]
		);

		

		/**
		 * Condition: 'exad_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'exad_flipbox_front_title_typography',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-title',
			]
		);

		/**
		 * Content
		 */
		$this->add_control(
			'exad_flipbox_content_heading',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		/**
		 * Condition: 'exad_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_control(
			'exad_flipbox_front_content_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#817e7e',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-description' => 'color: {{VALUE}};',
				],
				
			]
		);

		/**
		 * Condition: 'exad_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'exad_flipbox_front_content_typography',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-front .exad-flip-box-front-description',
				
			]
		);


		/**
		 * Front Background
		 */
		$this->add_control(
			'exad_flipbox_front_background',
			[
				'label' => esc_html__( 'Background', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'front_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-inner .exad-flip-box-front',
			]
		);

		$this->end_controls_section();



		/**
		 * -------------------------------------------
		 * Tab Style (Flipbox Back)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_back_end_style_section',
			[
				'label' => __( 'Back', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		/**
		 * Condition: 'exad_flipbox_front_back_content_toggler' => 'front'
		 */
		$this->add_control(
			'exad_flipbox_back_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back i' => 'color: {{VALUE}};',
				],
				
			]
		);

		/**
		 * Title
		 */
		$this->add_control(
			'exad_flipbox_back_title_heading',
			[
				'label' => esc_html__( 'Title Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		/**
		 * 
		 */
		$this->add_control(
			'exad_flipbox_back_title_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-title' => 'color: {{VALUE}};',
				],
				
			]
		);

		/**
		 * 
		 */
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'exad_flipbox_back_title_typography',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-title',
			]
		);

		

		/**
		 * Content
		 */
		$this->add_control(
			'exad_flipbox_back_content_heading',
			[
				'label' => esc_html__( 'Content Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		/**
		 * 
		 */
		$this->add_control(
			'exad_flipbox_back_content_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-description' => 'color: {{VALUE}};',
				],
				
			]
		);

		
		/**
		 * 
		 */
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'exad_flipbox_back_content_typography',
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-description',
				
			]
		);

		/**
		 * Rear Background
		 */
		$this->add_control(
			'exad_flipbox_rear_background',
			[
				'label' => esc_html__( 'Background', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'rear_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-flip-box .exad-flip-box-inner .exad-flip-box-back',
			]
		);

		/**
		 * Title
		 */
		$this->add_control(
			'exad_flipbox_back_button',
			[
				'label' => esc_html__( 'Button', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		$this->start_controls_tabs( 'exad_cta_button_tabs' );

			// Normal State Tab
			$this->start_controls_tab( 'exad_flipbox_btn_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_flipbox_btn_normal_text_color',
					[
						'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#FF7F97',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_flipbox_btn_normal_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#FFF',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action' => 'background: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_flipbox_btn_normal_border_color',
					[
						'label' => esc_html__( 'Border Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action' => 'border-color: {{VALUE}};',
						],
					]

				);

			
			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'exad_flipbox_btn_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_flipbox_btn_hover_text_color',
					[
						'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#FFF',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action:hover' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_flipbox_btn_hover_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#FF7F97',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action:hover' => 'background: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'exad_flipbox_btn_hover_border_color',
					[
						'label' => esc_html__( 'Border Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#FFF',
						'selectors' => [
							'{{WRAPPER}} .exad-flip-box .exad-flip-box-back .exad-flip-box-back-action:hover' => 'border-color: {{VALUE}};',
						],
					]

				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

   	public function exad_breadcrumbs($hometext, $skinType, $withIcon, $homeIcon, $otherIcon) {
  
		$delimiter = '&raquo;';
		$name = esc_html($hometext); //text for the 'Home' link

		if($withIcon == 'yes'){
			$homeIcon = '<i class="'.esc_attr($homeIcon).'"></i>';
			$otherIcon = '<i class="'.esc_attr($otherIcon).'"></i>';
		} else {			
			$homeIcon = '';
			$otherIcon = '';
		}

		$currentBefore = '<li class="exad-breadcrumb-item active">'.$otherIcon;
		$currentAfter = '</li>';

		if ( !is_home() && !is_front_page() || is_paged() ) {
		  
		    echo '<ul class="exad-breadcrumb-'.esc_attr($skinType).'">';		  
			    global $post;
			    $home = get_bloginfo('url');
			    echo '<li class="exad-breadcrumb-item"><a href="' . $home . '">'.$homeIcon. $name . '</a></li>';
			  
			    if ( is_category() ) {
					global $wp_query;
					$cat_obj = $wp_query->get_queried_object();
					$thisCat = $cat_obj->term_id;
					$thisCat = get_category($thisCat);
					$parentCat = get_category($thisCat->parent);
					if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE));
					echo $currentBefore . 'Archive by category &#39;';
					single_cat_title();
					echo '&#39;' . $currentAfter;
			  
			    } elseif ( is_day() ) {
			      	echo '<li class="exad-breadcrumb-item"><a href="' . get_year_link(get_the_time('Y')) . '">'.$otherIcon. get_the_time('Y') . '</a></li>';
			      	echo '<li class="exad-breadcrumb-item"><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">'.$otherIcon . get_the_time('F') . '</a></li>';
			      	echo $currentBefore . get_the_time('d') . $currentAfter;
			  
			    } elseif ( is_month() ) {
			      	echo '<li class="exad-breadcrumb-item"><a href="' . get_year_link(get_the_time('Y')) . '">'.$otherIcon . get_the_time('Y') . '</a></li>';
			      	echo $currentBefore . get_the_time('F') . $currentAfter;
			  
			    } elseif ( is_year() ) {
			      	echo $currentBefore . get_the_time('Y') . $currentAfter;
			  
			    } 

			    // elseif ( is_single() && !is_attachment() ) {
			    //   $cat = get_the_category(); $cat = $cat[0];
			    //   echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			    //   echo $currentBefore;
			    //   the_title();
			    //   echo $currentAfter;
			  
			    // } 

			    elseif ( is_attachment() ) {
					$parent = get_post($post->post_parent);
					$cat = get_the_category($parent->ID); $cat = $cat[0];
					echo get_category_parents($cat, TRUE);
					echo '<li class="exad-breadcrumb-item"><a href="' . get_permalink($parent) . '">'.$otherIcon . $parent->post_title . '</a></li>';
					echo $currentBefore;
					the_title();
					echo $currentAfter;
			  
			    } elseif ( is_page() && !$post->post_parent ) {
					echo $currentBefore;
					the_title();
					echo $currentAfter;
			  
			    } elseif ( is_page() && $post->post_parent ) {
			      	$parent_id  = $post->post_parent;
			      	$breadcrumbs = array();
			      	while ($parent_id) {
				        $page = get_page($parent_id);
				        $breadcrumbs[] = '<li class="exad-breadcrumb-item"><a href="' . get_permalink($page->ID) . '">'.$otherIcon . get_the_title($page->ID) . '</a></li>';
				        $parent_id  = $page->post_parent;
			      	}
					$breadcrumbs = array_reverse($breadcrumbs);
					foreach ($breadcrumbs as $crumb) echo $crumb;
					echo $currentBefore;
					the_title();
					echo $currentAfter;
			  
			    } elseif ( is_search() ) {
			      	echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;
			  
			    } elseif ( is_tag() ) {
			     	echo $currentBefore . 'Posts tagged &#39;';
			     	single_tag_title();
			     	echo '&#39;' . $currentAfter;
			  
			    } elseif ( is_author() ) {
			       	global $author;
			      	$userdata = get_userdata($author);
			      	echo $currentBefore . __('Articles posted by ', 'exclusive-addons-elementor' ) . $userdata->display_name . $currentAfter;
			  
			    } elseif ( is_404() ) {
			      	echo $currentBefore . __('Error 404', 'exclusive-addons-elementor' ) . $currentAfter;
			    }
			  
			    if ( get_query_var('paged') ) {
			      	if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			      	echo __('Page') . ' ' . get_query_var('paged');
			      	if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
			    }
		  
	    	echo '</ul>';
  
  		}
	}

	protected function render() {

   		$settings = $this->get_settings_for_display();
   		$homeText = $settings['exad_breadcrumbs_home_text'];
   		$skinType = $settings['exad_breadcrumbs_skin_type'];
   		$withIcon = $settings['exad_breadcrumbs_with_icon'];
		$homeIcon = '';
		$otherIcon = '';
		if($withIcon == 'yes'){
			$homeIcon = $settings['exad_breadcrumbs_home_icon'];
   			$otherIcon = $settings['exad_breadcrumbs_other_icon'];
		}  

 		$this->exad_breadcrumbs($homeText, $skinType, $withIcon, $homeIcon, $otherIcon);

	}

	protected function _content_template() {
		
 		$this->exad_breadcrumbs($homeText, $skinType, $withIcon, $homeIcon, $otherIcon);
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Breadcrumbs() );