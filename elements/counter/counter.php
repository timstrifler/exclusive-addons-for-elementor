<?php
namespace Elementor;

class Exad_Counter extends Widget_Base {
	
	public function get_name() {
		return 'exad-counter';
	}
	public function get_title() {
		return esc_html__( 'Counter', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-counter';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_script_depends() {
		return [ 'exad-waypoints', 'exad-counter' ];
	}

	public function get_keywords() {
        return [ 'up', 'increase', 'counter up', 'count up' ];
    }

	protected function _register_controls() {

		/*
		* Number Content
		*/
	    $this->start_controls_section(
			'exad_section_counter_number',
			[
				'label' => esc_html__( 'Contents', 'exclusive-addons-elementor' )
			]
	    );

	    $this->add_control(
	        'exad_counter_img_or_icon',
	        [
				'label'       => esc_html__( 'Image or Icon', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => true,
				'default'     => 'icon',
				'options'     => [
	                'none'      => [
	                    'title' => esc_html__( 'None', 'exclusive-addons-elementor' ),
	                    'icon'  => 'fa fa-ban'
	                ],
	                'icon'      => [
	                    'title' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
	                    'icon'  => 'fa fa-info-circle'
	                ],
	                'img'       => [
	                    'title' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
	                    'icon'   => 'fa fa-picture-o'
	                ]
	            ]
	        ]
	    );

	  	$this->add_control(
	        'exad_counter_icon',
	        [
				'label'       => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
	                'value'   => 'fas fa-spinner',
	                'library' => 'solid'
	            ],
		      	'condition'   => [
	                'exad_counter_img_or_icon' => 'icon'
	            ]
	        ]
	    );

	    $this->add_control(
	        'exad_counter_image',
	        [
				'label'     => esc_html__( 'Image', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
	                'url'   => Utils::get_placeholder_image_src()
	            ],
	            'condition' => [
	                'exad_counter_img_or_icon' => 'img'
	            ]
	        ]
	    );

	    $this->add_control(
			'exad_counter_number',
			[
				'label'     => esc_html__( 'Count Number', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'separator' => 'before',
				'default'   => 50
			]
		);

		$this->add_control(
			'exad_counter_title',
			[
				'label'   => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Counter Title', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_counter_suffix',
			[
				'label'   => __( 'Suffix', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => "+"
			]
		);

		$this->add_control(
			'exad_counter_speed',
			[
				'label'       => esc_html__( 'Counting Speed', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::NUMBER,
				'description' => __( 'In Miliseconds', 'exclusive-addons-elementor' ),
				'default'     => 2000
			]
		);

		$this->add_control(
			'exad_counter_layout',
			[
				'label'   => esc_html__( 'Counter Layout', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Layout 1', 'exclusive-addons-elementor' ),
					'layout-2' => __( 'Layout 2', 'exclusive-addons-elementor' )
				]
			]
		);
	    
		$this->end_controls_section();

				
		/*
		* Counter Styling Section
		*/
		$this->start_controls_section(
			'exad_section_counter_container',
			[
				'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'exad_counter_background',
				'label'    => __( 'Background', 'exclusive-addons-elementor' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-counter-item'
			]
		);

		$this->add_control(
			'exad_counter_alignment',
			[
				'label'     => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'separator' => 'after',
				'options'   => [
					'exad-counter-left'   => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-left'
					],
					'exad-counter-center' => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-center'
					],
					'exad-counter-right'  => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'fa fa-align-right'
					]
				],
				'default'   => 'exad-counter-center'
			]
        );
        
        $this->add_control(
			'exad_counter_wrapper_padding',
			[
				'label'        => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => 20,
					'right'    => 20,
					'bottom'   => 20,
					'left'     => 20,
					'isLinked' => true
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-counter-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'exad_counter_container_margin',
			[
				'label'        => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'separator'    => 'after',
				'size_units'   => [ 'px', 'em' ],
				'default'      => [
					'top'      => 0,
					'right'    => 0,
					'bottom'   => 0,
					'left'     => 0,
					'isLinked' => true
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-counter-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'exad_counter_container_border',
				'label'    => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-counter-item'
			]
		);
        
        $this->add_control(
			'exad_counter_radius',
			[
				'label'        => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', 'em', '%' ],
				'default'      => [
					'top'      => 5,
					'right'    => 5,
					'bottom'   => 5,
					'left'     => 5,
					'isLinked' => true
				],
				'selectors'    => [
					'{{WRAPPER}} .exad-counter-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_counter_container_shadow',
				'label'    => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-counter-item'
			]
		);

		$this->end_controls_section();

		/**
		* Style Tab: Icon
		**/
		$this->start_controls_section(
			'exad_counter_icon_style',
			[
				'label'     => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
	                'exad_counter_img_or_icon' => 'icon'
	            ]
			]
		);

		$this->add_control(
			'exad_counter_icon_size',
			[
				'label'      => esc_html__( 'Size', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px'       => [
						'min'  => 10,
						'max'  => 50,
						'step' => 5
					]
				],
				'default'   => [
					'unit'  => 'px',
					'size'  => 24
				],
				'selectors' => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-icon' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'exad_counter_icon_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-icon' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'exad_counter_icon_background',
				'label'    => __( 'Background', 'exclusive-addons-elementor' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-counter-item .exad-counter-icon'
			]
		);

		$this->add_control(
			'exad_counter_icon_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'separator'  => 'before',
				'default'    => [
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'exad_counter_icon_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'separator'  => 'after',
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'exad_counter_icon_border',
				'label'    => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-counter-item .exad-counter-icon'
			]
		);

		$this->add_control(
			'exad_counter_icon_border_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '50',
					'right'  => '50',
					'bottom' => '50',
					'left'   => '50',
					'unit'   => '%'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		* Style Tab: Image
		**/
		$this->start_controls_section(
			'exad_counter_image_style',
			[
				'label'     => esc_html__( 'Image', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
	                'exad_counter_img_or_icon' => 'img'
	            ]
			]
		);

		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
				'name'    => 'exad_counter_image_size',
				'default' => 'thumbnail'
            ]
        );

		$this->add_control(
			'exad_counter_image_padding',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'separator'  => 'before',
				'default'    => [
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-icon img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'exad_counter_image_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'separator'  => 'after',
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-icon img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'exad_counter_image_border',
				'label'    => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-counter-item .exad-counter-icon img'
			]
		);

		$this->add_control(
			'exad_counter_image_border_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		* Style Tab: Counter Number
		**/
		$this->start_controls_section(
			'exad_counter_number_style',
			[
				'label' => __( 'Number', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_counter_number_color',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-data' => 'color: {{VALUE}};'
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_counter_number_typography',
				'label'    => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-counter-item .exad-counter-data '
			]
		);
		

		$this->add_control(
			'exad_counter_number_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => 10,
					'right'    => 10,
					'bottom'   => 10,
					'left'     => 10,
					'isLinked' => true
				],
				'selectors' => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-data' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		
		$this->end_controls_section();

		/**
		* Style Tab: Suffix
		**/
		$this->start_controls_section(
			'exad_counter_suffix_style',
			[
				'label' => __( 'Suffix', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_counter_suffix_color',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-data .exad-counter-suffix' => 'color: {{VALUE}};'
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_counter_suffix_typography',
				'label'    => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-counter-item .exad-counter-data .exad-counter-suffix'
			]
		);
		
		$this->add_control(
			'exad_counter_suffix_spacing',
			[
				'label'      => __( 'Spacing', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'default'    => [
                    'size'   => 1,
                    'unit'   => 'px'
                ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 25
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-data .exad-counter-suffix' => 'margin-left: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		* Style Tab: Counter Title
		**/
		$this->start_controls_section(
			'exad_counter_title_style',
			[
				'label' => __( 'Title', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_counter_title_color',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
						'{{WRAPPER}} .exad-counter-item .exad-counter-content h4' => 'color: {{VALUE}};'
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_counter_title_typography',
				'label'    => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-counter-item .exad-counter-content h4'
			]
		);

		$this->add_control(
			'exad_counter_title_margin',
			[
				'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings          = $this->get_settings_for_display();
		$counter_image     = $this->get_settings_for_display( 'exad_counter_image' );
		$counter_layout    = $this->get_settings_for_display( 'exad_counter_layout' );

		do_action('exad_counter_wrapper_before');
	    echo '<div id="exad-counter-'.esc_attr($this->get_id()).'" class="exad-counter-wrapper">';
	        echo '<div class="exad-counter-item '.esc_attr( $settings['exad_counter_alignment'] ).'">';

				if ( 'img' == $settings['exad_counter_img_or_icon'] && !empty( $settings['exad_counter_image']['url'] ) ) {
				    echo '<span class="exad-counter-icon">';
				        echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'exad_counter_image_size', 'exad_counter_image' );
				    echo '</span>';
				}

		        if ( 'icon' == $settings['exad_counter_img_or_icon'] && ! empty( $settings['exad_counter_icon']['value'] ) ) :
		          	echo '<span class="exad-counter-icon">';
		    			Icons_Manager::render_icon( $settings['exad_counter_icon'], [ 'aria-hidden' => 'true' ] );
		          	echo '</span>';
		        endif;

		        do_action('exad_counter_content_before');

				if ( $counter_layout == 'layout-1' ) : ?>
					<div class="exad-counter-data">
						<span class="exad-counter" data-counter-speed="<?php echo esc_attr( $settings['exad_counter_speed'] ); ?>">
							<?php echo esc_html( $settings['exad_counter_number'] ); ?>
						</span>
						<?php if( !empty( $settings['exad_counter_suffix'] ) ) : ?>
							<span class="exad-counter-suffix"><?php echo esc_html( $settings['exad_counter_suffix'] ); ?></span>
						<?php endif; ?>
					</div>
					<div class="exad-counter-content">
						<h4><?php echo esc_html( $settings['exad_counter_title'] ); ?></h4>
					</div>
				<?php endif; ?>
				<?php if ( $counter_layout == 'layout-2') : ?>
					<div class="exad-counter-content">
						<h4><?php echo esc_html( $settings['exad_counter_title'] ); ?></h4>
					</div>
					<div class="exad-counter-data">
						<span class="exad-counter" data-counter-speed="<?php echo esc_attr( $settings['exad_counter_speed'] ); ?>"><?php echo esc_html( $settings['exad_counter_number'] ); ?></span><span class="exad-counter-suffix"><?php echo esc_html( $settings['exad_counter_suffix'] ); ?></span>
					</div>
				<?php endif;
				do_action('exad_counter_content_after');

	        echo '</div>';
	    echo '</div>';
	    do_action('exad_counter_wrapper_after');
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Counter() );