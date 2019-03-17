<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exclusive_Accordion extends Widget_Base {

	public function get_name() {
		return 'exad-exclusive-accordion';
	}

	public function get_title() {
		return esc_html__( 'Exclusive Accordion', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'eicon-accordion';
	}


   public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function _register_controls() {
		
  		/**
  		 * Exclusive Accordion Content Settings
  		 */
  		$this->start_controls_section(
  			'eael_section_adv_accordion_content_settings',
  			[
  				'label' => esc_html__( 'Content Settings', 'exclusive-addons-elementor' )
  			]
  		);
  		$this->add_control(
			'exad_exclusive_accordion_tab',
			[
				'type'		=> Controls_Manager::REPEATER,
				'seperator'	=> 'before',
				'default'	=> [
					[ 'exad_exclusive_accordion_title' => esc_html__( 'Accordion Tab Title 1', 'exclusive-addons-elementor' ) ],
					[ 'exad_exclusive_accordion_title' => esc_html__( 'Accordion Tab Title 2', 'exclusive-addons-elementor' ) ],
					[ 'exad_exclusive_accordion_title' => esc_html__( 'Accordion Tab Title 3', 'exclusive-addons-elementor' ) ],
				],
				'fields' => [
					[
						'name'		=> 'exad_exclusive_accordion_default_active',
						'label'		=> esc_html__( 'Active as Default', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::SWITCHER,
						'default'	=> 'no',
						'return_value' => 'yes',
					],
					[
						'name'		=> 'exad_exclusive_accordion_icon_show',
						'label'		=> esc_html__( 'Enable Icon', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::SWITCHER,
						'default'	=> 'yes',
						'return_value' => 'yes',
					],
					[
						'name'		=> 'exad_exclusive_accordion_title_icon',
						'label'		=> esc_html__( 'Icon', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::ICON,
						'default'	=> 'fa fa-plus',
						'condition' => [
							'exad_exclusive_accordion_icon_show' => 'yes'
						]
					],
					[
						'name'		=> 'exad_exclusive_accordion_title',
						'label'		=> esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::TEXT,
						'default'	=> esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
						'dynamic'	=> [ 'active' => true ]
					],
				  	[
						'name'		=> 'exad_exclusive_accordion_content',
						'label'		=> esc_html__( 'Tab Content', 'exclusive-addons-elementor' ),
						'type'		=> Controls_Manager::TEXTAREA,
						'default'	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'exclusive-addons-elementor' ),
						'dynamic'	=> [ 'active' => true ],
					],
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
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
			$this->add_control(
				'exad_exclusive_accordion_preset',
				[
				 'label'       	=> esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				   'type' 			=> Controls_Manager::SELECT,
				   'default' 		=> 'six',
				   'label_block' 	=> false,
				   'options' 		=> [
						'one' => esc_html__( 'Style 1', 'exclusive-addons-elementor' ),
					  	'two' => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
					  	'three' => esc_html__( 'Style 3', 'exclusive-addons-elementor' ),
					  	'six' => esc_html__( 'Style 4', 'exclusive-addons-elementor' ),
				   ],
				]
		  	);
		  	$this->add_control(
			  	'exad_exclusive_tabs_icon_show',
			  	[
				  	'label' => esc_html__( 'Enable Icon', 'exclusive-addons-elementor' ),
				  	'type' => Controls_Manager::SWITCHER,
				  	'default' => 'yes',
				  	'return_value' => 'yes',
			  	]
		  	);
		  
  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Accordion Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'eael_section_adv_accordions_tab_style_settings',
			[
				'label'	=> esc_html__( 'Tab Style', 'exclusive-addons-elementor' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name'		=> 'exad_exclusive_accordion_title_typography',
				'selector'	=> '{{WRAPPER}} .exad-accordion-title h3',
			]
		);

		$this->start_controls_tabs( 'exad_exclusive_accordion_header_tabs' );
			# Normal State Tab
			$this->start_controls_tab( 'exad_exclusive_accordion_header_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );
				$this->add_control(
					'exad_exclusive_accordion_tab_color',
					[
						'label'	=> esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type'	=> Controls_Manager::COLOR,
						'default'	=> '#FFF',
						'selectors' => [
							'{{WRAPPER}} .exad-accordion-title' => 'background: {{VALUE}};',
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
							'{{WRAPPER}} .exad-accordion-title' => 'color: {{VALUE}};',
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
							'{{WRAPPER}} .exad-accordion-title span i' => 'color: {{VALUE}};',
						],
						'condition' => [
							'eael_adv_tabs_icon_show' => 'yes'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'		=> 'exad_exclusive_accordion_tab_border',
						'label'		=> esc_html__( 'Border', 'exclusive-addons-elementor' ),
						'selector'	=> '{{WRAPPER}} .exad-accordion-title',
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
							'{{WRAPPER}} .exad-accordion-title:hover' => 'background-color: {{VALUE}};',
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
							'{{WRAPPER}} .exad-accordion-title:hover' => 'color: {{VALUE}};',
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
							'{{WRAPPER}} .exad-accordion-title:hover .exad-accordion-title span i' => 'color: {{VALUE}};',
						],
						'condition'	=> [
							'exad_exclusive_accordion_toggle_icon_show' => 'yes'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'		=> 'exad_exclusive_accordion_tab_border_hover',
						'label'		=> esc_html__( 'Border', 'exclusive-addons-elementor' ),
						'selector'	=> '{{WRAPPER}} .exad-exclusive-accordion .eael-accordion-list .eael-accordion-header.active',
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
			'eael_section_adv_accordion_tab_content_style_settings',
			[
				'label'	=> esc_html__( 'Content Style', 'exclusive-addons-elementor' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'adv_accordion_content_bg_color',
			[
				'label'		=> esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .exad-accordion-content-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'adv_accordion_content_text_color',
			[
				'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '#333',
				'selectors' => [
					'{{WRAPPER}} .exad-accordion-content-wrapper' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name'		=> 'exad_exclusive_accordion_content_typography',
				'selector'	=> '{{WRAPPER}} .exad-accordion-content-wrapper p',
			]
		);
		
  		$this->end_controls_section();

	}

	protected function render() {

		$settings	= $this->get_settings_for_display();
		
		$this->add_render_attribute( 'exad-exclusive-accordion', 'class', 'exad-exclusive-accordion' );
		$this->add_render_attribute( 'exad-exclusive-accordion', 'id', 'exad-exclusive-accordion-'.esc_attr( $this->get_id() ));
	?>
	
		<div class="exad-accordion <?php echo esc_attr( $settings['exad_exclusive_accordion_preset'] ); ?>">
			<?php 
				foreach( $settings['exad_exclusive_accordion_tab'] as $key => $accordion ) : 
					
					$accordion_item_setting_key = $this->get_repeater_setting_key('exad_exclusive_accordion_title', 'exad_exclusive_accordion_tab', $key);

					$accordion_class = ['exad-accordion-title'];

					if ( $accordion['exad_exclusive_accordion_default_active'] == 'yes' ) {
						$accordion_class[] = 'active-default';
					}

					$this->add_render_attribute( $accordion_item_setting_key, [
						'class'		=> $accordion_class,
						
					]);

				?>
				<div class="exad-accordion-<?php echo esc_attr( $settings['exad_exclusive_accordion_preset'] ); ?>">
					<div <?php echo $this->get_render_attribute_string($accordion_item_setting_key); ?>>
						<?php if ( isset( $accordion['exad_exclusive_accordion_icon_show'] ) && $accordion['exad_exclusive_accordion_icon_show'] == 'yes' ) : ?>
							<span><i class="<?php echo esc_attr( $accordion['exad_exclusive_accordion_title_icon'] ); ?>"></i></span>
						<?php endif; ?>
						<h3><?php echo $accordion['exad_exclusive_accordion_title']; ?></h3>
					</div>
					<div class="exad-accordion-content">
						<div class="exad-accordion-content-wrapper">
							<p><?php echo $accordion['exad_exclusive_accordion_content']; ?></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
    	</div>
	
	<?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Exclusive_Accordion() );