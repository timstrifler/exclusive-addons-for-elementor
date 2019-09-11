<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exclusive_Accordion extends Widget_Base {

	public function get_name() {
		return 'exad-exclusive-accordion';
	}

	public function get_title() {
		return esc_html__( 'Accordion', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-accordion';
	}


   public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function _register_controls() {
		
  		/**
  		 * Exclusive Accordion Content Settings
  		 */
  		$this->start_controls_section(
  			'exad_section_exclusive_accordion_content_settings',
  			[
  				'label' => esc_html__( 'Contents', 'exclusive-addons-elementor' )
  			]
  		);

  		$repeater = new Repeater();

        $repeater->start_controls_tabs('exad_accordion_item_tabs');

        $repeater->start_controls_tab('exad_accordion_item_content_tab', ['label' => __('Content', 'exclusive-addons-elementor')]);

        $repeater->add_control(
			'exad_exclusive_accordion_default_active', [
				'label'        => esc_html__( 'Active as Default', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);

        $repeater->add_control(
			'exad_exclusive_accordion_icon_show', [
				'label'        => esc_html__( 'Enable Title Icon', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes'
			]
		);
		
        $repeater->add_control(
			'exad_exclusive_accordion_title_icon_updated', [
				'label'            => esc_html__( 'Title Icon', 'exclusive-addons-elementor' ),
				'fa4compatibility' => 'exad_exclusive_accordion_title_icon',
				'type'             => Controls_Manager::ICONS,
				'default' 		   => [
					'value'   => 'fas fa-star',
					'library' => 'solid'
				],
				'condition' 	   => [
					'exad_exclusive_accordion_icon_show' => 'yes'
				]
			]
		);
		
        $repeater->add_control(
			'exad_exclusive_accordion_title', [
				'label'            => esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
				'fa4compatibility' => 'exad_exclusive_accordion_title_icon',
				'type'             => Controls_Manager::TEXT,
				'default'          => esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
				'dynamic'          => [ 'active' => true ]
			]
		);
		
        $repeater->add_control(
			'exad_exclusive_accordion_content', [
				'label'            => esc_html__( 'Tab Content', 'exclusive-addons-elementor' ),
				'fa4compatibility' => 'exad_exclusive_accordion_title_icon',
				'type'             => Controls_Manager::TEXTAREA,
				'default'          => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'exclusive-addons-elementor' ),
				'dynamic'          => [ 'active' => true ]
			]
		);

        $repeater->end_controls_tab();

   		$repeater->start_controls_tab('tab_content', ['label' => __('Style', 'exclusive-addons-elementor')]);

        $repeater->add_control(
            'color',
            [
				'label'     => __( 'Tab Title Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
	            'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.exad-accordion-single-item h3 ' => 'color: {{VALUE}};'
                ]
            ]
        );



        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

  		$this->add_control(
			'exad_exclusive_accordion_tab',
			[
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				// 'fields' 	=> $repeater->get_controls(),
				'fields' 	=> array_values( $repeater->get_controls() ) ,
				'default'	=> [
					[ 'exad_exclusive_accordion_title' => esc_html__( 'Accordion Tab Title 1', 'exclusive-addons-elementor' ) ],
					[ 'exad_exclusive_accordion_title' => esc_html__( 'Accordion Tab Title 2', 'exclusive-addons-elementor' ) ],
					[ 'exad_exclusive_accordion_title' => esc_html__( 'Accordion Tab Title 3', 'exclusive-addons-elementor' ) ],
				],
				'title_field' => '{{exad_exclusive_accordion_title}}',
			]
		);

  		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Tabs Generel Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_accordion_style_settings',
			[
				'label' => esc_html__( 'General Styles', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'exad_exclusive_accordion_preset',
			[
				'label'       => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'six',
				'label_block' => false,
			    'options' 	  => [
						'one'   => esc_html__( 'Style 1', 'exclusive-addons-elementor' ),
						'two'   => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
						'three' => esc_html__( 'Style 3', 'exclusive-addons-elementor' ),
						'six'   => esc_html__( 'Style 4', 'exclusive-addons-elementor' ),
			   ],
			]
	  	);
		  
  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Accordion Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_accordions_tab_style_settings',
			[
				'label'	=> esc_html__( 'Tab Style', 'exclusive-addons-elementor' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name'		=> 'exad_exclusive_accordion_title_typography',
				'selector'	=> '{{WRAPPER}} .exad-accordion .exad-accordion-title h3',
			]
		);

		$this->start_controls_tabs( 'exad_exclusive_accordion_header_tabs' );
			# Normal State Tab
			$this->start_controls_tab( 'exad_exclusive_accordion_header_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );
				$this->add_control(
					'exad_exclusive_accordion_tab_color',
					[
						'label'     => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#FFF',
						'selectors' => [
							'{{WRAPPER}} .exad-accordion .exad-accordion-title' => 'background: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_exclusive_accordion_tab_text_color',
					[
						'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '#000',
						'selectors'	=> [
							'{{WRAPPER}} .exad-accordion .exad-accordion-title, {{WRAPPER}} .exad-accordion .exad-accordion-title::after' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_exclusive_accordion_tab_icon_color',
					[
						'label'		=> esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '#000',
						'selectors'	=> [
							'{{WRAPPER}} .exad-accordion .exad-accordion-title span i' => 'color: {{VALUE}};',
						],
						'condition' => [
							'exad_adv_tabs_icon_show' => 'yes'
						]
					]
				);
				
				
			$this->end_controls_tab();

			#Hover State Tab
			$this->start_controls_tab(
				'exad_exclusive_accordion_header_active',
				[
					'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' )
				]
			);

				$this->add_control(
					'exad_exclusive_accordion_tab_color_hover',
					[
						'label'		=> esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '#FFF',
						'selectors' => [
							'{{WRAPPER}} .exad-accordion .exad-accordion-title:hover' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_exclusive_accordion_tab_text_color_hover',
					[
						'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '#333',
						'selectors'	=> [
							'{{WRAPPER}} .exad-accordion .exad-accordion-title:hover, .exad-accordion .exad-accordion-title::after' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'exad_exclusive_accordion_tab_icon_color_hover',
					[
						'label'		=> esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::COLOR,
						'default'	=> '#fff',
						'selectors'	=> [
							'{{WRAPPER}} .exad-accordion .exad-accordion-title:hover .exad-accordion-title span i' => 'color: {{VALUE}};',
						],
						'condition'	=> [
							'exad_exclusive_accordion_toggle_icon_show' => 'yes'
						]
					]
				);

			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Accordion Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_accordion_tab_content_style_settings',
			[
				'label'	=> esc_html__( 'Content Style', 'exclusive-addons-elementor' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_accordion_content_bg_color',
			[
				'label'		=> esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .exad-accordion .exad-accordion-content-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'exad_accordion_content_text_color',
			[
				'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '#333',
				'selectors' => [
					'{{WRAPPER}} .exad-accordion .exad-accordion-content-wrapper' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name'		=> 'exad_exclusive_accordion_content_typography',
				'selector'	=> '{{WRAPPER}} .exad-accordion .exad-accordion-content-wrapper p',
			]
		);
		
  		$this->end_controls_section();

	}

	protected function render() {

		$settings	= $this->get_settings_for_display();
		
		$this->add_render_attribute( 'exad-exclusive-accordion', 'class', 'exad-exclusive-accordion' );
		$this->add_render_attribute( 'exad-exclusive-accordion', 'id', 'exad-exclusive-accordion-'.esc_attr( $this->get_id() ));
	
		echo '<div class="exad-accordion-items">';
			foreach( $settings['exad_exclusive_accordion_tab'] as $key => $accordion ) : 
				
				$accordion_item_setting_key = $this->get_repeater_setting_key('exad_exclusive_accordion_title', 'exad_exclusive_accordion_tab', $key);

				$accordion_class = ['exad-accordion-title'];

				if ( $accordion['exad_exclusive_accordion_default_active'] == 'yes' ) {
					$accordion_class[] = 'active-default';
				}

				$this->add_render_attribute( $accordion_item_setting_key, [
					'class'		=> $accordion_class,
					
				]);

				echo '<div class="exad-accordion-single-item">';
					echo '<div '.$this->get_render_attribute_string($accordion_item_setting_key).'>';
						if ( isset( $accordion['exad_exclusive_accordion_icon_show'] ) && $accordion['exad_exclusive_accordion_icon_show'] == 'yes' ) :
							$migrated = isset( $accordion['__fa4_migrated']['exad_exclusive_accordion_title_icon_updated'] );
							$is_new   = empty( $accordion['exad_exclusive_accordion_title_icon'] );

							if ( $is_new || $migrated ) :
								echo '<span>';
									\Elementor\Icons_Manager::render_icon( $accordion['exad_exclusive_accordion_title_icon_updated'], [ 'aria-hidden' => 'true' ] );
								echo '</span>';
							else :
						 		echo '<span><i class="'.esc_attr($accordion['exad_exclusive_accordion_title_icon']).'" aria-hidden="true"></i></span>';
							endif;
						endif; 

						echo '<h3>'.esc_html($accordion['exad_exclusive_accordion_title']).'</h3>';
					echo '</div>';
					echo '<div class="exad-accordion-content">';
						echo '<div class="exad-accordion-content-wrapper">';
							echo '<p>'.wp_kses_post($accordion['exad_exclusive_accordion_content']).'</p>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			endforeach;
    	echo '</div>';
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Exclusive_Accordion() );