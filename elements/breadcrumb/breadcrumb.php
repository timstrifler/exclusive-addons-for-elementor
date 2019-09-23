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
                'default'       => 'no',
                'return_value'  => 'yes'
            ]
        );

		$this->add_control(
			'exad_breadcrumbs_home_icon',
			[
				'label'     => __( 'Home Icon', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-home',
				'condition' => [
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
				'condition' => [
                    'exad_breadcrumbs_with_icon' => 'yes'
                ]
			]
		);

        $this->add_control(
            'exad_breadcrumbs_separate_with_arrow',
            [
                'label'         => esc_html__( 'Separate With Arrow', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'return_value'  => 'yes'
            ]
        ); 
	
		$this->end_controls_section();

        $this->start_controls_section(
            'exad_breadcrumbs_container_style',
            [
                'label'         => esc_html__( 'Container', 'exclusive-addons-elementor' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );	

        $this->add_group_control(
        Group_Control_Border::get_type(),
            [
                'name'      => 'exad_breadcrumbs_container',
                'label'     => esc_html__( 'Container', 'exclusive-addons-elementor' ),
                'selector'  => '{{WRAPPER}} .exad-breadcrumb-items'
            ]
        );

		$this->add_control(
			'exad_breadcrumbs_container_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} ul.exad-breadcrumb-items'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'exad_breadcrumbs_item_style',
            [
                'label'         => esc_html__( 'Item', 'exclusive-addons-elementor' ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'exad_breadcrumbs_item_padding',
            [
				'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,            
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'    => '10',
					'right'  => '15',
					'bottom' => '10',
					'left'   => '15'
				],
                'selectors'   => [
                        '{{WRAPPER}} ul.exad-breadcrumb-items li.exad-breadcrumb-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->add_responsive_control(
            'exad_breadcrumbs_item_margin',
            [
				'label'      => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,            
				'size_units' => [ 'px', 'em', '%' ],
                'selectors'   => [
                        '{{WRAPPER}} ul.exad-breadcrumb-items li.exad-breadcrumb-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->start_controls_tabs( 'exad_breadcrumbs_item_style_tabs' );

            // normal state tab
            $this->start_controls_tab( 'exad_breadcrumbs_first_item', [ 'label' => esc_html__( 'First Item', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_breadcrumbs_first_item_text_color',
                [
                    'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#797c80',
                    'selectors' => [
                        '{{WRAPPER}} ul.exad-breadcrumb-items li.exad-breadcrumb-item.first-item a' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_breadcrumbs_first_item_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} ul.exad-breadcrumb-items li.exad-breadcrumb-item.first-item' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

	 		$this->add_group_control(
	        Group_Control_Border::get_type(),
	            [
	                'name'      => 'exad_breadcrumbs_first_item_border',
	                'label'     => esc_html__( 'Border', 'exclusive-addons-elementor' ),
	                'selector'  => '{{WRAPPER}} ul.exad-breadcrumb-items li.exad-breadcrumb-item.first-item'
	            ]
	        );

			$this->add_control(
				'exad_breadcrumbs_first_item_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors'  => [
						'{{WRAPPER}} ul.exad-breadcrumb-items li.exad-breadcrumb-item.first-item'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

            $this->end_controls_tab();

            // hover state tab
            $this->start_controls_tab( 'exad_breadcrumbs_inner_items', [ 'label' => esc_html__( 'Inner Items', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_breadcrumbs_inner_items_text_color',
                [
                    'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#797c80',
                    'selectors' => [
                        '{{WRAPPER}} ul.exad-breadcrumb-items li.exad-breadcrumb-item.inner-items a' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_breadcrumbs_inner_items_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ul.exad-breadcrumb-items li.exad-breadcrumb-item.inner-items' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

	 		$this->add_group_control(
	        Group_Control_Border::get_type(),
	            [
	                'name'      => 'exad_breadcrumbs_inner_items_border',
	                'label'     => esc_html__( 'Border', 'exclusive-addons-elementor' ),
	                'selector'  => '{{WRAPPER}} ul.exad-breadcrumb-items li.exad-breadcrumb-item.inner-items'
	            ]
	        );

			$this->add_control(
				'exad_breadcrumbs_inner_items_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors'  => [
						'{{WRAPPER}} ul.exad-breadcrumb-items li.exad-breadcrumb-item.inner-items'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

            $this->end_controls_tab();

            // active state tab
            $this->start_controls_tab( 'exad_breadcrumbs_item_active', [ 'label' => esc_html__( 'Active Item', 'exclusive-addons-elementor' ) ] );

            $this->add_control(
                'exad_breadcrumbs_item_active_color',
                [
                    'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'	=> '#fc6277',
                    'selectors' => [
                        '{{WRAPPER}} ul.exad-breadcrumb-items li.exad-breadcrumb-item.active' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'exad_breadcrumbs_item_active_bg_color',
                [
                    'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ul.exad-breadcrumb-items li.exad-breadcrumb-item.active' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

	 		$this->add_group_control(
	        Group_Control_Border::get_type(),
	            [
	                'name'      => 'exad_breadcrumbs_item_active_border',
	                'label'     => esc_html__( 'Border', 'exclusive-addons-elementor' ),
	                'selector'  => '{{WRAPPER}} ul.exad-breadcrumb-items li.exad-breadcrumb-item.active'
	            ]
	        );

			$this->add_control(
				'exad_breadcrumbs_item_active_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px'],
					'selectors'  => [
						'{{WRAPPER}} ul.exad-breadcrumb-items li.exad-breadcrumb-item.active'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

            $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->add_control(
			'exad_breadcrumbs_item_arrow_separator_style',
			[
				'label'     => __( 'Arrow Separator', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
                	'exad_breadcrumbs_separate_with_arrow' => 'yes'
                ]
			]
		);

        $this->add_control(
			'exad_breadcrumbs_item_color_arrow_separator_color',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.exad-breadcrumb-items li.exad-breadcrumb-item.arrow-yes' => 'color: {{VALUE}};'
				],
				'condition' => [
                	'exad_breadcrumbs_separate_with_arrow' => 'yes'
                ]
			]
		);

		$this->end_controls_section();
	}

   	public function exadBreadcrumbs($hometext, $withIcon, $homeIcon, $otherIcon, $arrow_separate) {
  
		$delimiter = '&raquo;';
		$name = esc_html($hometext); //text for the 'Home' link

		if($withIcon == 'yes'){
			$homeIcon = '<i class="'.esc_attr($homeIcon).'"></i>';
			$otherIcon = '<i class="'.esc_attr($otherIcon).'"></i>';
		} else {			
			$homeIcon = '';
			$otherIcon = '';
		}

		$currentBefore = '<li class="exad-breadcrumb-item last-item active">'.$otherIcon;
		$currentAfter = '</li>';

		if ( !is_home() && !is_front_page() || is_paged() ) {
		  
		    echo '<ul class="exad-breadcrumb-items">';		  
			    global $post;
			    $home = get_bloginfo('url');
			    echo '<li class="exad-breadcrumb-item first-item arrow-'.esc_attr($arrow_separate).'"><a href="' . $home . '">'.$homeIcon. $name . '</a></li>';

				if ( Plugin::$instance->editor->is_edit_mode() || is_page() || is_single() ) {
					if ( !$post->post_parent ) {
						echo $currentBefore;
						the_title();
						echo $currentAfter;
				  
					} elseif ( $post->post_parent ) {
						$parent_id  = $post->post_parent;
						$breadcrumbs = array();
						while ($parent_id) {
							$page = get_page($parent_id);
							$breadcrumbs[] = '<li class="exad-breadcrumb-item inner-items arrow-'.esc_attr($arrow_separate).'"><a href="' . get_permalink($page->ID) . '">'.$otherIcon . get_the_title($page->ID) . '</a></li>';
							$parent_id  = $page->post_parent;
						}
						$breadcrumbs = array_reverse($breadcrumbs);
						foreach ($breadcrumbs as $crumb) echo $crumb;
						echo $currentBefore;
						the_title();
						echo $currentAfter;
				  
					}
				}
		  
	    	echo '</ul>';
  
  		}
	}

	protected function render() {

		$settings  = $this->get_settings_for_display();
		$homeText  = $settings['exad_breadcrumbs_home_text'];
		$withIcon  = $settings['exad_breadcrumbs_with_icon'];
		$homeIcon  = '';
		$otherIcon = '';
		$arrow_separate = '';
		if('yes' == $settings['exad_breadcrumbs_separate_with_arrow']){
			$arrow_separate = 'yes';
		}
		if( 'yes' == $withIcon){
			$homeIcon = $settings['exad_breadcrumbs_home_icon'];
   			$otherIcon = $settings['exad_breadcrumbs_other_icon'];
		}  

 		$this->exadBreadcrumbs($homeText, $withIcon, $homeIcon, $otherIcon, $arrow_separate);

	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Breadcrumbs() );