<?php
namespace Elementor;

class Exad_Infobox extends Widget_Base {
	
	public function get_name() {
		return 'exad-infobox';
	}
	public function get_title() {
		return esc_html__( 'Info Box', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-info-box';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	protected function _register_controls() {
		/*
		* Infobox Image
		*/
		$this->start_controls_section(
			'exad_section_infobox_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
			]
		);
		
		$this->add_control(
			'exad_infobox_img_or_icon',
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
			'exad_infobox_image',
			[
				'label' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'exad_infobox_img_or_icon' => 'img'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'exad_infobox_img_or_icon' => 'img'
				]
			]
		);

		$this->add_control(
			'exad_infobox_icon',
			[
				'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-tag',
				'condition' => [
					'exad_infobox_img_or_icon' => 'icon'
				]
			]
		);

		
		$this->add_control(
			'exad_infobox_title',
			[
				'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Infobox Title', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_infobox_title_link',
			[
				'label' => __( 'Title URL', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);
		
		$this->add_control(
			'exad_infobox_description',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Basic description about the Infobox', 'exclusive-addons-elementor' ),
			]
		);

		$this->end_controls_section();
		

		/*
		* Infobox Styling Section
		*/
		$this->start_controls_section(
			'exad_section_infobox_styles_preset',
			[
				'label' => esc_html__( 'Container', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_infobox_alignment',
            [
				'label' => __( 'Alignment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'exad-infobox-align-left' => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'exad-infobox-align-center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'exad-infobox-align-right' => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'exad-infobox-align-center',
			]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .exad-infobox .exad-infobox-item',
				'default' => '#FFFFFF',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_infobox_border',
				'label' => __( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-infobox-item',
			]
		);

		$this->add_control(
			'exad_infobox_border_radius',
			[
			  'label' => esc_html__( 'Border Radious', 'exclusive-addons-elementor' ),
			  'type' => Controls_Manager::DIMENSIONS,
			  'size_units' => [ 'px', '%' ],
			  'default' => [
				'top' => '0',
				'right' => '0',
				'bottom' => '0',
				'left' => '0',
				],
			  'selectors' => [
				  '{{WRAPPER}} .exad-infobox-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			  ],
			]
		);

		$this->add_control(
			'exad_infobox_padding',
			[
			  'label' => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
			  'type' => Controls_Manager::DIMENSIONS,
			  'size_units' => [ 'px', '%' ],
			  'default' => [
				'top' => '30',
				'right' => '30',
				'bottom' => '30',
				'left' => '30',
				],
			  'selectors' => [
				  '{{WRAPPER}} .exad-infobox-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			  ],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_infobox_box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-infobox-item',
			]
		);

		
		$this->end_controls_section();

		// transition style

		$this->start_controls_section(
            'section_infobox_transition_style',
            [
                'label' => __('Transition', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_control(
			'exad_infobox_transition_top',
            [
				'label' => __( 'Transition Top', 'exclusive-addons-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
		$this->add_control(
			'exad_infobox_transition_zoom',
            [
				'label' => __( 'Transition Zoom', 'exclusive-addons-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'exad_infobox_transition_zoom_background',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .zoom-transition::before',
				'condition' => [
					'exad_infobox_transition_zoom' => 'yes',
				]
			]
		);
		
		$this->add_control(
			'exad_infobox_transition_zoom_title_color',
			[
			  'label' => esc_html__( 'Title Color', 'exclusive-addons-elementor' ),
			  'type' => Controls_Manager::COLOR,
			  'default' => '100',
			  'selectors' => [
				  '{{WRAPPER}} .exad-infobox-item:hover .exad-infobox-content-title' => 'color: {{VALUE}};',
			  ],
			  'condition' => [
				'exad_infobox_transition_zoom' => 'yes',
			]
			]
		);

		$this->add_control(
			'exad_infobox_transition_zoom_description_color',
			[
			  'label' => esc_html__( 'Description Color', 'exclusive-addons-elementor' ),
			  'type' => Controls_Manager::COLOR,
			  'default' => '100',
			  'selectors' => [
				  '{{WRAPPER}} .exad-infobox-item:hover .exad-infobox-content-description' => 'color: {{VALUE}};',
			  ],
			  'condition' => [
				'exad_infobox_transition_zoom' => 'yes',
			]
			]
		);

		$this->end_controls_section();

		//icon style

		$this->start_controls_section(
            'section_infobox_icon',
            [
                'label' => __('Icon/Image', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_control(
			'exad_infobox_icon_position',
			[
				'label' => __( 'Position', 'plugin-domain' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'exad-infobox-icon-position-left' => [
						'title' => __( 'Left', 'plugin-domain' ),
						'icon' => 'fa fa-angle-left',
					],
					'exad-infobox-icon-position-center' => [
						'title' => __( 'Center', 'plugin-domain' ),
						'icon' => 'fa fa-angle-up',
					],
					'exad-infobox-icon-position-right' => [
						'title' => __( 'Right', 'plugin-domain' ),
						'icon' => 'fa fa-angle-right',
					],
				],
				'default' => 'exad-infobox-icon-position-center',
			]
		);

		$this->add_control(
			'exad_infobox_icon_height',
			[
			  'label' => esc_html__( 'Height', 'exclusive-addons-elementor' ),
			  'type' => Controls_Manager::NUMBER,
			  'default' => '100',
			  'selectors' => [
				  '{{WRAPPER}} .exad-infobox-item .exad-infobox-icon' => 'height: {{VALUE}}px;',
			  ],
			]
		);
		$this->add_control(
			'exad_infobox_icon_width',
			[
			  'label' => esc_html__( 'Width', 'exclusive-addons-elementor' ),
			  'type' => Controls_Manager::NUMBER,
			  'default' => '100',
			  'selectors' => [
				  '{{WRAPPER}} .exad-infobox-item .exad-infobox-icon' => 'width: {{VALUE}}px;',
			  ],
			]
		);
		$this->add_control(
			'exad_infobox_icon_font_size',
			[
			  'label' => esc_html__( 'Icon Size', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
				  'size' => 50,
			  ],
			  'range' => [
				  'px' => [
					  'max' => 100,
				  ],
			  ],
			  'selectors' => [
				  '{{WRAPPER}} .exad-infobox-item .exad-infobox-icon i' => 'font-size: {{SIZE}}px;',
			  ],
			]
		);

		$this->add_control(
			'exad_infobox_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radious', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .exad-infobox-item .exad-infobox-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_infobox_icon_box_shadow',
				'label' => __( 'Box Shadow', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-infobox-item .exad-infobox-icon',
			]
		);

		$this->add_control(
			'exad_infobox_icon_margin_top',
			[
			  'label' => esc_html__( 'Margin Top', 'exclusive-addons-elementor' ),
			  'type' => Controls_Manager::NUMBER,
			  'default' => '0',
			  'selectors' => [
				  '{{WRAPPER}} .exad-infobox-item .exad-infobox-icon' => 'margin-top: {{VALUE}}px;',
			  ],
			]
		);

		$this->add_control(
			'exad_infobox_icon_margin_bottom',
			[
			  'label' => esc_html__( 'Margin Bottom', 'exclusive-addons-elementor' ),
			  'type' => Controls_Manager::NUMBER,
			  'default' => '20',
			  'selectors' => [
				  '{{WRAPPER}} .exad-infobox-item .exad-infobox-icon' => 'margin-bottom: {{VALUE}}px;',
			  ],
			]
		);

		$this->start_controls_tabs( 'exad_infobox_icon_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'exad_infobox_icon_normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_infobox_icon_background_color_normal',
					[
						'label' => esc_html__( 'Background', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#5480ff',
						'selectors' => [
							'{{WRAPPER}} .exad-infobox-item .exad-infobox-icon' => 'background: {{VALUE}}',
						]
					]
				);

				$this->add_control(
					'exad_infobox_icon_color_normal',
					[
						'label' => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .exad-infobox-item .exad-infobox-icon i' => 'color: {{VALUE}}',
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'exad_infobox_icon_border_normal',
						'label' => __( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-infobox-item .exad-infobox-icon',
					]
				);

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'exad_infobox_icon_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

				$this->add_control(
					'exad_infobox_icon_background_color_hover',
					[
						'label' => esc_html__( 'Background', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .exad-infobox-item:hover .exad-infobox-icon' => 'background: {{VALUE}}',
						]
					]
				);

				$this->add_control(
					'exad_infobox_icon_color_hover',
					[
						'label' => esc_html__( 'Icon Color', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#5480ff',
						'selectors' => [
							'{{WRAPPER}} .exad-infobox-item:hover .exad-infobox-icon i' => 'color: {{VALUE}}',
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'exad_infobox_icon_border_hover',
						'label' => __( 'Border', 'exclusive-addons-elementor' ),
						'selector' => '{{WRAPPER}} .exad-infobox-item:hover .exad-infobox-icon',
					]
				);
				
			$this->end_controls_tab();
        $this->end_controls_tabs();
		
		$this->end_controls_section();

		// Title , Description Font Color and Typography

		$this->start_controls_section(
            'section_infobox_title',
            [
                'label' => __('Title', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'exad_title_color',
            [
                'label' => __('Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#132c47',
                'selectors' => [
                    '{{WRAPPER}} .exad-infobox-content-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'infobox_title_typography',
                'selector' => '{{WRAPPER}} .exad-infobox-content-title',
            ]
		);
		
		$this->add_control(
			'exad_infobox_title_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .exad-infobox-content-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();


        $this->start_controls_section(
            'section_infobox_description',
            [
                'label' => __('Description', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'exad_description_color',
            [
                'label' => __('Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#797c80',
                'selectors' => [
                    '{{WRAPPER}} .exad-infobox-content-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'exad_description_typography',
                'selector' => '{{WRAPPER}} .exad-infobox-content-description',
            ]
		);
		
		$this->add_control(
			'exad_infobox_description_margin',
			[
				'label' => __( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .exad-infobox-content-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
		
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$infobox_image = $this->get_settings_for_display ( 'exad_infobox_image' );
		$infobox_image_url = Group_Control_Image_Size::get_attachment_image_src( $infobox_image['id'], 'thumbnail', $settings );

		$this->add_render_attribute( 'exad_infobox_transition',[
			'class' => ['exad-infobox-item', esc_attr($settings['exad_infobox_alignment']), esc_attr($settings['exad_infobox_icon_position']) ],
		]);
		if( $settings['exad_infobox_transition_top'] === 'yes' ){
			$this->add_render_attribute( 'exad_infobox_transition', 'class', 'simple-transition' );
		}

		if( $settings['exad_infobox_transition_zoom'] === 'yes' ){
			$this->add_render_attribute( 'exad_infobox_transition', 'class', 'zoom-transition' );
		}

		if ( empty( $infobox_image_url ) ) {
			$infobox_image_url = $infobox_image['url'];
		}  else {
			$infobox_image_url = $infobox_image_url;
		} 

		?>

		<div id="exad-infobox-<?php echo esc_attr($this->get_id()); ?>" class="exad-infobox">
			  <div <?php echo $this->get_render_attribute_string( 'exad_infobox_transition' ); ?> >
	            <div class="exad-infobox-icon">

	            	<?php if( 'icon' == $settings['exad_infobox_img_or_icon'] ) : ?>
						<i class="<?php echo esc_attr( $settings['exad_infobox_icon'] ); ?>"></i>
					<?php endif; ?>

	            	<?php if( 'img' == $settings['exad_infobox_img_or_icon'] ) : ?>
						<img src="<?php echo esc_url( $infobox_image_url ); ?>" alt="Icon Image">
					<?php endif; ?>
					
	            </div>
	            <div class="exad-infobox-content">
	            	<h3 class="exad-infobox-content-title"><?php echo $settings['exad_infobox_title']; ?></h3>
	              	<p class="exad-infobox-content-description">
	   					<?php echo $settings['exad_infobox_description']; ?>
	              	</p>
	            </div>
          	</div>
        </div>

	<?php
	}

	protected function _content_template() {
		?>
		<#
		view.addRenderAttribute( 'exad_infobox_transition','class' , [ 'exad-infobox-item', settings.exad_infobox_alignment, settings.exad_infobox_icon_position ]);
		<!-- view.addRenderAttribute( 'exad_exclusive_button', 'class', [ 'exad-button-wrapper', settings.exclusive_button_effect ] ); -->

		if( settings.exad_infobox_transition_top === 'yes' ){
			view.addRenderAttribute( 'exad_infobox_transition', 'class', 'simple-transition' );
		}

		if( settings.exad_infobox_transition_zoom === 'yes' ){
			view.addRenderAttribute( 'exad_infobox_transition', 'class', 'zoom-transition' );
		}

		#>
		<div id="exad-infobox" class="exad-infobox {{ settings.exad_infobox_preset }}">
          	<div {{{ view.getRenderAttributeString( 'exad_infobox_transition' ) }}} >
	            <div class="exad-infobox-icon">

	            	<# if( 'icon' == settings.exad_infobox_img_or_icon ) { #>
						<i class="{{{ settings.exad_infobox_icon }}}"></i>
					<# } #>

	            	<# if( 'img' == settings.exad_infobox_img_or_icon ) { #>
						<img src="{{{ settings.exad_infobox_image.url }}}" alt="Icon Image">
					<# } #>
					
	            </div>
	            <div class="exad-infobox-content">
	            	<h3 class="exad-infobox-content-title">{{{ settings.exad_infobox_title }}}</h3>
	              	<p class="exad-infobox-content-description">{{{ settings.exad_infobox_description }}}
	              	</p>
	            </div>
          	</div>
        </div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Infobox() );