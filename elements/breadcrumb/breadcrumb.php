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

	}

   	public function exad_breadcrumbs($hometext, $withIcon, $homeIcon, $otherIcon) {
  
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
		  
		    echo '<ul class="exad-breadcrumb-items">';		  
			    global $post;
			    $home = get_bloginfo('url');
			    echo '<li class="exad-breadcrumb-item"><a href="' . $home . '">'.$homeIcon. $name . '</a></li>';

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
							$breadcrumbs[] = '<li class="exad-breadcrumb-item"><a href="' . get_permalink($page->ID) . '">'.$otherIcon . get_the_title($page->ID) . '</a></li>';
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

   		$settings = $this->get_settings_for_display();
   		$homeText = $settings['exad_breadcrumbs_home_text'];
   		$withIcon = $settings['exad_breadcrumbs_with_icon'];
		$homeIcon = '';
		$otherIcon = '';
		if($withIcon == 'yes'){
			$homeIcon = $settings['exad_breadcrumbs_home_icon'];
   			$otherIcon = $settings['exad_breadcrumbs_other_icon'];
		}  

 		$this->exad_breadcrumbs($homeText, $withIcon, $homeIcon, $otherIcon);

	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Breadcrumbs() );