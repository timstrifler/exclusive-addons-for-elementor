<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Exclusive_Tabs extends Widget_Base {

	public function get_name() {
		return 'exad-exclusive-tabs';
	}

	public function get_title() {
		return esc_html__( 'Tabs', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-tabs';
	}

   public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function _register_controls() {

  		/**
  		 * Exclusive Tabs Content Settings
  		 */
  		$this->start_controls_section(
  			'exad_section_exclusive_tabs_content_settings',
  			[
  				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
  			]
  		);
  		$this->add_control(
			'exad_exclusive_tabs',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'exad_exclusive_tab_title' => esc_html__( 'Tab Title 1', 'exclusive-addons-elementor' ) ],
					[ 'exad_exclusive_tab_title' => esc_html__( 'Tab Title 2', 'exclusive-addons-elementor' ) ],
					[ 'exad_exclusive_tab_title' => esc_html__( 'Tab Title 3', 'exclusive-addons-elementor' ) ],
				],
				'fields' => [
					[
						'name' => 'exad_exclusive_tab_show_as_default',
						'label' => __( 'Set as Default', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::SWITCHER,
						'return_value' => 'active',
				  	],
                    [
						'name'        => 'exad_exclusive_tabs_icon_type',
						'label'       => esc_html__( 'Icon Type', 'exclusive-addons-elementor' ),
                        'type'        => Controls_Manager::CHOOSE,
                        'label_block' => false,
                        'options'     => [
                            'none' => [
                                'title' => esc_html__( 'None', 'exclusive-addons-elementor' ),
                                'icon'  => 'fa fa-ban',
                            ],
                            'icon' => [
                                'title' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                                'icon'  => 'fa fa-gear',
                            ],
                            'image' => [
                                'title' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
                                'icon'  => 'fa fa-picture-o',
                            ],
                        ],
                        'default'       => 'icon',
					],
					[
						'name' => 'exad_exclusive_tab_title_icon',
						'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::ICON,
						'default' => 'fa fa-home',				
						'condition' => [
							'exad_exclusive_tabs_icon_type' => 'icon'
						]
					],
					[
						'name' => 'exad_exclusive_tab_title_image',
						'label' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'condition' => [
							'exad_exclusive_tabs_icon_type' => 'image'
						]
					],
					[
						'name' => 'exad_exclusive_tab_title',
						'label' => esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'Tab Title', 'exclusive-addons-elementor' ),
						'dynamic' => [ 'active' => true ]
					],
					[
						'name' => 'exad_exclusive_tab_content',
						'label' => esc_html__( 'Tab Content', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'exclusive-addons-elementor' ),
					],
				],
				'title_field' => '{{exad_exclusive_tab_title}}',
			]
		);
  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Tabs Generel Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_tabs_style_preset_settings',
			[
				'label' => esc_html__( 'General Styles', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
			$this->add_control(
				'exad_exclusive_tabs_preset',
				[
				 'label'       	=> esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				   'type' 			=> Controls_Manager::SELECT,
				   'default' 		=> 'two',
				   'label_block' 	=> false,
				   'options' 		=> [
					  'two' => esc_html__( 'Style 1', 'exclusive-addons-elementor' ),
					  'three' => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
					  'four' => esc_html__( 'Style 3', 'exclusive-addons-elementor' ),
					  'five' => esc_html__( 'Style 4', 'exclusive-addons-elementor' ),
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
		 * Tab Style Exclusive Tabs Heading Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_tabs_heading_style_settings',
			[
				'label' => esc_html__( 'Heading', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'exad_exclusive_tab_heading_typography',
				'selector' => '{{WRAPPER}} .exad-advance-tab .exad-tab-title',
			]
		);
		

		$this->start_controls_tabs( 'exad_exclusive_tabs_header_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'exad_exclusive_tabs_header_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );
				
			$this->add_control(
				'exad_exclusive_tab_text_color',
				[
					'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#8a8d91',
					'selectors' => [
						'{{WRAPPER}} .exad-advance-tab .exad-advance-tab-nav li span, {{WRAPPER}} .exad-advance-tab .exad-advance-tab-nav li i' => 'color: {{VALUE}};'
					],
				]
			);

			$this->add_control(
					'exad_exclusive_tab_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#FFF',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tab .exad-advance-tab-nav li' => 'background: {{VALUE}};'
						],
					]
				);
				
				$this->add_control(
					'exad_exclusive_tab_border_color',
					[
						'label' => esc_html__( 'Bottom Border Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#e5e5e5',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tab.two .exad-advance-tab-nav li' => 'border-bottom: 1px solid {{VALUE}};'
						],
						'condition' => [ 
							'exad_exclusive_tabs_preset' => 'two'
						]
					]
				);
				
				
			$this->end_controls_tab();
			
			// Active State Tab

			$this->start_controls_tab( 'exad_exclusive_tabs_header_active', [ 'label' => esc_html__( 'Active', 'exclusive-addons-elementor' ) ] );
				$this->add_control(
					'exad_exclusive_tab_text_color_active',
					[
						'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#0a1724',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tab .exad-advance-tab-nav li.active span, {{WRAPPER}} .exad-advance-tab .exad-advance-tab-nav li.active i' => 'color: {{VALUE}};'
						],
					]
				);	
				
				$this->add_control(
					'exad_exclusive_tab_bg_color_active',
					[
						'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#f9f9f9',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tab .exad-advance-tab-nav li.active, {{WRAPPER}} .exad-advance-tab.four .exad-advance-tab-nav li::before' => 'background: {{VALUE}};',
							'{{WRAPPER}} .exad-advance-tab.three .exad-advance-tab-nav li::before' => 'border-left-color: {{VALUE}};'
						],
					]
				);
				
				$this->add_control(
					'exad_exclusive_tab_border_color_active',
					[
						'label' => esc_html__( 'Bottom Border Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#704aff',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tab.two .exad-advance-tab-nav li.active' => 'border-bottom: 1px solid {{VALUE}};',
							'{{WRAPPER}} .exad-advance-tab.four .exad-advance-tab-nav li::after' => 'background: {{VALUE}};'
						],
						'condition' => [ 
							'exad_exclusive_tabs_preset' => 'two'
						]
					]
				);

				$this->add_control(
					'exad_exclusive_tab_border_left_color_active',
					[
						'label' => esc_html__( 'Bottom Left Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#704aff',
						'selectors' => [
							'{{WRAPPER}} .exad-advance-tab.four .exad-advance-tab-nav li::after' => 'background: {{VALUE}};'
						],
						'condition' => [ 
							'exad_exclusive_tabs_preset' => 'four'
						]
					]
				);
				
				
			$this->end_controls_tab();
		$this->end_controls_tabs();
  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Exclusive Tabs Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_exclusive_tabs_tab_content_style_settings',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exclusive_tabs_content_title_color',
			[
				'label' => esc_html__( 'Title Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#0a1724',
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tab .exad-advance-tab-content .exad-advance-tab-content-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_exclusive_tabs_content_title_typography',
				'label' => esc_html__( 'Title Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-advance-tab .exad-advance-tab-content-title',
			]
		);
		$this->add_control(
			'exclusive_tabs_content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f9f9f9',
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tab .exad-advance-tab-content ' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'exclusive_tabs_content_text_color',
			[
				'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .exad-advance-tab .exad-advance-tab-content ' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exad_exclusive_tabs_content_typography',
				'label' => esc_html__( 'Text Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-advance-tab .exad-advance-tab-content p',
			]
		);
		$this->add_control(
			'exad_exclusive_tabs_content_padding',
			[
				'label' => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => 40,
					'right' => 40,
					'bottom' => 40,
					'left' => 40,
					'isLinked' => true,
				],
				'selectors' => [
	 				'{{WRAPPER}} .exad-advance-tab .exad-advance-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		
	
  		$this->end_controls_section();

	}

	protected function render() {

   		$settings = $this->get_settings_for_display();
		
		$this->add_render_attribute(
			'exad_tab_wrapper',
			[
				'id'     => "exad-advance-tabs-{$this->get_id()}",
				'class'	 => [ 'exad-advance-tab', $settings['exad_exclusive_tabs_preset'] ],
			]
		);
		

	?>
		<div <?php echo $this->get_render_attribute_string('exad_tab_wrapper'); ?> data-tabs>
			
			<ul class="exad-advance-tab-nav">
			<?php foreach( $settings['exad_exclusive_tabs'] as $tab ) : ?>
				<li class="<?php echo esc_attr( $tab['exad_exclusive_tab_show_as_default'] ); ?>" data-tab>
				<?php if( $settings['exad_exclusive_tabs_icon_show'] === 'yes' ) : 
					if( $tab['exad_exclusive_tabs_icon_type'] === 'icon' ) : ?>
						<i class="<?php echo esc_attr( $tab['exad_exclusive_tab_title_icon'] ); ?>"></i>
					<?php elseif( $tab['exad_exclusive_tabs_icon_type'] === 'image' ) : ?>
						<img src="<?php echo esc_attr( $tab['exad_exclusive_tab_title_image']['url'] ); ?>">
					<?php endif; ?>
				<?php endif; ?> 
				<span class="exad-tab-title"><?php echo $tab['exad_exclusive_tab_title']; ?></span></li>
			<?php endforeach; ?>
			</ul>
			
			
			<?php foreach( $settings['exad_exclusive_tabs'] as $tab ) : $exad_find_default_tab[] = $tab['exad_exclusive_tab_show_as_default'];?>
				<div class="exad-advance-tab-content <?php echo esc_attr( $tab['exad_exclusive_tab_show_as_default'] ); ?>">
				<h3 class="exad-advance-tab-content-title"><?php echo $tab['exad_exclusive_tab_title']; ?></h3>
				<p><?php echo esc_html( $tab['exad_exclusive_tab_content'] ); ?></p>
				</div>
			<?php endforeach; ?>
			
		</div>
	<?php
	}

	protected function _content_template() {
		?>
		<div id="exad-advance-tabs" class="exad-advance-tab {{ settings.exad_exclusive_tabs_preset }}" data-tabs>
			
			<ul class="exad-advance-tab-nav">
				<# _.each( settings.exad_exclusive_tabs, function( tab, index ) { #>
					<li class="{{ tab.exad_exclusive_tab_show_as_default }}" data-tab>
					<# if( settings.exad_exclusive_tabs_icon_show === 'yes' ) { #>
						<# if( tab.exad_exclusive_tabs_icon_type === 'icon' ) { #>
							<i class="{{ tab.exad_exclusive_tab_title_icon }}"></i>
						<# } else if( tab.exad_exclusive_tabs_icon_type === 'image' ) { #>
							<img src="{{ tab.exad_exclusive_tab_title_image.url }}">
						<# } #>	
					<# } #>		
					<span class="exad-tab-title">{{{ tab.exad_exclusive_tab_title }}}</span></li>
				<# }); #>
			</ul>
			
			<# _.each( settings.exad_exclusive_tabs, function( tab, index ) { #>
				<div class="exad-advance-tab-content {{ tab.exad_exclusive_tab_show_as_default }}">
				<h3 class="exad-advance-tab-content-title">{{{ tab.exad_exclusive_tab_title }}}</h3>
				<p>{{{ tab.exad_exclusive_tab_content }}}</p>
				</div>
			<# }); #>
			
		</div>
		<?php
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Exclusive_Tabs() );