<?php
namespace Elementor;

class Exad_Counter extends Widget_Base {
	
	public function get_name() {
		return 'exad-counter';
	}
	public function get_title() {
		return esc_html__( 'Ex Counter', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-counter';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_script_depends() {
		return [ 'exad-counter' ];
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
            'label' => esc_html__( 'Image or Icon', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::CHOOSE,
            'label_block' => true,
            'options' => [
                'none' => [
                    'title' => esc_html__( 'None', 'exclusive-addons-elementor' ),
                    'icon' => 'fa fa-ban',
                ],
                'icon' => [
                    'title' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
                    'icon' => 'fa fa-info-circle',
                ],
                'img' => [
                    'title' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
                    'icon' => 'fa fa-picture-o',
                ]
            ],
            'default' => 'icon',
        ]
    );

    $this->add_control(
        'exad_counter_icon',
        [
            'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::ICON,
            'default' => 'fa fa-spinner',
            'condition' => [
                'exad_counter_img_or_icon' => 'icon'
            ]
        ]
    );

    $this->add_control(
        'exad_counter_image',
        [
            'label' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
            'condition' => [
                'exad_counter_img_or_icon' => 'img'
            ]
        ]
    );

    $this->add_control(
		'exad_counter_number',
		[
			'label' => esc_html__( 'Count Number', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::NUMBER,
			'separator' => 'before',
			'default' => 50
		]
	);

	$this->add_control(
		'exad_counter_title',
		[
			'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::TEXT,
			'default' => esc_html__( 'Counter Title', 'exclusive-addons-elementor' ),
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
			'label'     => esc_html__( 'Counting Speed', 'exclusive-addons-elementor' ),
			'type'      => Controls_Manager::NUMBER,
			'description' => __( 'In Miliseconds', 'exclusive-addons-elementor' ),
			'default'   => 2000,
		]
	);

	$this->add_control(
		'exad_counter_layout',
		[
			'label'     => esc_html__( 'Counter Layout', 'exclusive-addons-elementor' ),
			'type'      => Controls_Manager::SELECT,
			'default'              => 'layout-1',
			'options'              => [
					'layout-1'     => __( 'Layout 1', 'exclusive-addons-elementor' ),
					'layout-2'     => __( 'Layout 2', 'exclusive-addons-elementor' )
			],
		]
	);
    
	$this->end_controls_section();

				
		/*
		* Counter Styling Section
		*/
		$this->start_controls_section(
			'exad_section_counter_container',
			[
				'label' => esc_html__( 'Container Styles', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_counter_alignment',
			[
				'label' => esc_html__( 'Counter Alignment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'exad-counter-left' => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'exad-counter-center' => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'exad-counter-right' => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'exad-counter-center'
			]
        );
        
        $this->add_control(
			'exad_counter_wrapper_padding',
			[
				'label'  => __( 'Paddind', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
					'top' => 20,
					'right' => 20,
					'bottom' => 20,
					'left' => 20,
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-counter-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        $this->add_control(
			'exad_counter_radius',
			[
				'label'                 => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'default' => [
					'top' => 5,
					'right' => 5,
					'bottom' => 5,
					'left' => 5,
					'isLinked' => true,
				],
				'selectors'             => [
					'{{WRAPPER}} .exad-counter-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_counter_background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-counter-item',
			]
		);

		$this->end_controls_section();

		/**
		* Style Tab: Icon
		**/
		$this->start_controls_section(
			'exad_section_counter_icon_style',
			[
				'label' => esc_html__( 'Icon Style', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_counter_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 50,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'exad_counter_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		* Style Tab: Counter Number
		**/
		$this->start_controls_section(
			'exad_counter_number_style',
			[
				'label'                 => __( 'Number Style', 'exclusive-addons-elementor' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_counter_number_color',
			[
				'label'                 => __( 'Color', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '#ffffff',
				'selectors'             => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-data' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'exad_counter_number_typography',
				'label'                 => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector'              => '{{WRAPPER}} .exad-counter-item .exad-counter-data ',
			]
		);

		$this->add_control(
			'exad_counter_number_margin',
			[
				'label'  => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 10,
					'right' => 10,
					'bottom' => 10,
					'left' => 10,
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-data' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();

		/**
		* Style Tab: Suffix
		**/
		$this->start_controls_section(
			'exad_counter_suffix_style',
			[
				'label'  => __( 'Suffix Style', 'exclusive-addons-elementor' ),
				'tab'    => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_counter_suffix_color',
			[
				'label'                 => __( 'Color', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '#ffffff',
				'selectors'             => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-data .exad-counter-suffix' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'exad_counter_suffix_typography',
				'label'                 => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector'              => '{{WRAPPER}} .exad-counter-item .exad-counter-data .exad-counter-suffix',
			]
		);
		
		$this->end_controls_section();

		/**
		* Style Tab: Counter Title
		**/
		$this->start_controls_section(
			'exad_counter_title_style',
			[
				'label'                 => __( 'Counter Title', 'exclusive-addons-elementor' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_counter_title_color',
			[
				'label'                 => __( 'Color', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '#ffffff',
				'selectors'             => [
						'{{WRAPPER}} .exad-counter-item .exad-counter-content h4' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'exad_counter_title_typography',
				'label'                 => __( 'Typography', 'exclusive-addons-elementor' ),
				'selector'              => '{{WRAPPER}} .exad-counter-item .exad-counter-content h4',
			]
		);

		$this->add_control(
			'exad_counter_title_margin',
			[
				'label'  => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .exad-counter-item .exad-counter-content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();

	}

	protected function render() {
        $settings = $this->get_settings_for_display();
				$counter_image = $this->get_settings_for_display( 'exad_counter_image' );
				$counter_layout = $this->get_settings_for_display( 'exad_counter_layout' );
				$counter_image_url = Group_Control_Image_Size::get_attachment_image_src( $counter_image['id'], 'thumbnail', $settings );

				if ( empty( $counter_image_url ) ) {
					$counter_image_url = $counter_image['url'];
				}  else {
					$counter_image_url = $counter_image_url;
				} 

    ?>
    <div id="exad-counter-<?php echo esc_attr($this->get_id()); ?>" class="exad-counter-wrapper">
        <div class="exad-counter-item <?php echo esc_attr( $settings['exad_counter_alignment'] ); ?> ">
			<?php if( 'img' == $settings['exad_counter_img_or_icon'] ) : ?>
				<span class="exad-counter-icon">
					<img src="<?php echo esc_url( $counter_image_url ); ?>">
				</span>
			<?php endif; ?>
			<?php if( 'icon' == $settings['exad_counter_img_or_icon'] ) : ?>
				<span class="exad-counter-icon">
					<i class="<?php echo esc_attr( $settings['exad_counter_icon'] ); ?>"></i>
				</span>
			<?php endif; ?>
			<?php if ( $counter_layout == 'layout-1') : ?>
				<div class="exad-counter-data">
						<span class="exad-counter"  data-counter-speed="<?php echo esc_attr( $settings['exad_counter_speed'] ); ?>">
								<?php echo esc_html( $settings['exad_counter_number'] ); ?>
						</span>
						<span class="exad-counter-suffix"><?php echo esc_html( $settings['exad_counter_suffix'] ); ?></span>
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
						<span class="exad-counter"  data-counter-speed="<?php echo esc_attr( $settings['exad_counter_speed'] ); ?>">
								<?php echo esc_html( $settings['exad_counter_number'] ); ?>
						</span>
						<span class="exad-counter-suffix"><?php echo esc_html( $settings['exad_counter_suffix'] ); ?></span>
				</div>
			<?php endif; ?>
        </div>
    </div>
    <?php
	}

	protected function _content_template() {
	?>
    <div id="exad-counter" class="exad-counter-wrapper">
			<div class="exad-counter-item {{ settings.exad_counter_alignment }} ">
				<# if( 'img' == settings.exad_counter_img_or_icon ) { #>
					<span class="exad-counter-icon">
						<img src="{{ settings.exad_counter_image.url }}">
					</span>
				<# } #>
				<# if( 'icon' == settings.exad_counter_img_or_icon ) { #>
					<span class="exad-counter-icon">
						<i class="{{ settings.exad_counter_icon }}"></i>
					</span>
				<# } #>
				<# if ( settings.exad_counter_layout == 'layout-1' ) { #>
					<div class="exad-counter-data">
						<span class="exad-counter"  data-counter-speed="{{ settings.exad_counter_speed }}">
							{{{ settings.exad_counter_number }}}
						</span>
						<span class="exad-counter-suffix">{{{ settings.exad_counter_suffix }}}</span>
					</div>
					<div class="exad-counter-content">
						<h4>{{{ settings.exad_counter_title }}}</h4>
					</div>
				<# } #>
				<# if ( settings.exad_counter_layout == 'layout-2' ) { #>
					<div class="exad-counter-content">
						<h4>{{{ settings.exad_counter_title }}}</h4>
					</div>
					<div class="exad-counter-data">
						<span class="exad-counter"  data-counter-speed="{{ settings.exad_counter_speed }}">
							{{{ settings.exad_counter_number }}}
						</span>
						<span class="exad-counter-suffix">{{{ settings.exad_counter_suffix }}}</span>
					</div>
				<# } #>
			</div>
    </div>
    <?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Counter() );