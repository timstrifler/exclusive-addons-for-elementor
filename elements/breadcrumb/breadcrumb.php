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