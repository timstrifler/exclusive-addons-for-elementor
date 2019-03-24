<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Contact Form 7 Element
 */
class Exad_Contact_Form extends Widget_Base {
    
    /**
	 * Retrieve contact form 7 widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'exad-contact-form-7';
    }

    /**
	 * Retrieve contact form 7 widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
    public function get_title() {
        return __( 'Ex Contact Form 7', 'exclusive-addons-elementor' );
    }

    /**
	 * Retrieve the list of categories the contact form 7 widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
    public function get_categories() {
        return [ 'exclusive-addons-elementor' ];
    }

    /**
	 * Retrieve contact form 7 widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
    public function get_icon() {
        return 'eicon-mail';
    }

    /**
	 * Register contact form 7 widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
    protected function _register_controls() {
        
        /**
         * Content Tab: Contact Form
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'exad_section_contact_intro',
            [
                'label'  => __( 'Contact Form', 'exclusive-addons-elementor' ),
            ]
        );
		
		$this->add_control(
			'exad_contact_form_list',
			[
				'label'                 => esc_html__( 'Select Form', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::SELECT,
				'label_block'           => true,
				'options'               => Exad_Helper::exad_retrive_contact_form(),
                'default'               => '0',
			]
		);
        
		
		$this->add_control(
			'exad_contact_form_title_text',
			[
				'label'                 => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::TEXT,
				'label_block'           => true,
                'default'               => '',
			]
		);
        
        
        $this->end_controls_section();


        /**
         * Content Tab: Errors
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'exad_section_errors',
            [
                'label'                 => __( 'Errors', 'exclusive-addons-elementor' ),
            ]
        );
        
        $this->add_control(
            'exad_error_messages',
            [
                'label'                 => __( 'Error Messages', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'show',
                'options'               => [
                    'show'          => __( 'Show', 'exclusive-addons-elementor' ),
                    'hide'          => __( 'Hide', 'exclusive-addons-elementor' ),
                ],
                'selectors_dictionary'  => [
                    'show'          => 'block',
                    'hide'          => 'none',
                ],
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-not-valid-tip' => 'display: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'exad_validation_errors',
            [
                'label'                 => __( 'Validation Errors', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'show',
                'options'               => [
                    'show'          => __( 'Show', 'exclusive-addons-elementor' ),
                    'hide'          => __( 'Hide', 'exclusive-addons-elementor' ),
                ],
                'selectors_dictionary'  => [
                    'show'          => 'block',
                    'hide'          => 'none',
                ],
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-validation-errors' => 'display: {{VALUE}} !important;',
                ],
            ]
        );
        
        $this->end_controls_section();


        /**
         * Style Tab: Form Container
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'exad_section_container_style',
            [
                'label'                 => __( 'Form Container', 'exclusive-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'exad_contact_form_background',
                'label'     => __( 'Background', 'exclusive-addons-elementor' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .exad-contact-form',
            ]
        );
		
        $this->add_control(
            'exad_contact_container_border_top',
            [
                'label'                 => __( 'Border Top Color', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#724cff',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form::before' => 'background: {{VALUE}}',
                ],
            ]
        );

  		$this->add_responsive_control(
  			'exad_contact_form_width',
  			[
  				'label' => esc_html__( 'Form Width', 'exclusive-addons-elementor' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'default'   => [
				        'unit'  => '%',
                        'size'  => '100'
                ],
				'selectors' => [
					'{{WRAPPER}} .exad-contact-form' => 'width: {{SIZE}}{{UNIT}};',
				],
  			]
  		);
		
		
		$this->add_responsive_control(
			'exad_contact_form_padding',
			[
				'label' => esc_html__( 'Form Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .exad-contact-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'default' => [
                    'top' => 40,
                    'right' => 40,
                    'bottom' => 40,
                    'left' => 40,
                    'unit' => 'px'
                    ]
			]
		);
		

        $this->end_controls_section();

        /**
         * Style Tab: Title & Description
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'exad_contact_section_title',
            [
                'label'                 => __( 'Title', 'exclusive-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_text_color',
            [
                'label'                 => __( 'Color', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .exad-contact-form-7-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'heading_alignment',
            [
                'label'                 => __( 'Alignment', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::CHOOSE,
                'options'               => [
                    'left'      => [
                        'title' => __( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .exad-contact-form-7-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'exad_contact_title_typography',
                'label'                 => __( 'Typography', 'exclusive-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .exad-contact-form-7 .exad-contact-form-7-title',
            ]
        );
        
        
        $this->end_controls_section();
        
        /**
         * Style Tab: Input & Textarea
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_fields_style',
            [
                'label'                 => __( 'Input & Textarea', 'exclusive-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'field_bg',
            [
                'label'                 => __( 'Background Color', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'field_text_color',
            [
                'label'                 => __( 'Text Color', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        

		$this->add_responsive_control(
			'field_padding',
			[
				'label'                 => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'default' => [
                    'unit' => 'px',
					'size' => 15,
                ],
				'selectors'             => [
					'{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
        $this->add_responsive_control(
            'exad_contact_field_width',
            [
                'label'                 => __( 'Field Width', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 1200,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'default' => [
                    'unit' => '%',
					'size' => 100,
                ],
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'field_border',
				'label'                 => __( 'Border', 'exclusive-addons-elementor' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-select',
				'separator'             => 'before',
			]
		);

		$this->add_control(
			'exad_contact_field_radius',
			[
				'label'                 => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        $this->end_controls_section();

        // Placeholder style
        $this->start_controls_section(
            'exad_contact_section_placeholder_style',
            [
                'label'                 => __( 'Placeholder', 'exclusive-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'exad_contact_placeholder_color',
            [
                'label'                 => __( 'Color', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 label input::placeholder' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .exad-contact-form-7 label textarea::placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'exad_contact_placeholder_typography',
                'label'                 => __( 'Typography', 'exclusive-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .exad-contact-form-7 label input::placeholder,{{WRAPPER}} .exad-contact-form-7 label textarea::placeholder',
            ]
        );

        
        $this->end_controls_section();

        /**
         * Style Tab: Label Section
         */
        $this->start_controls_section(
            'exad_contact_section_label_style',
            [
                'label'                 => __( 'Labels', 'exclusive-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color_label',
            [
                'label'                 => __( 'Color', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form label' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'exad_contact_typography_label',
                'label'                 => __( 'Typography', 'exclusive-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form label',
            ]
        );
        
        $this->end_controls_section();


        /**
         * Style Tab: Submit Button
         */
        $this->start_controls_section(
            'section_submit_button_style',
            [
                'label' => __( 'Submit Button', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
    
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'exad_contact_button_typography',
                'label'                 => __( 'Button Typography', 'exclusive-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]',
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'exclusive-addons-elementor' ),
            ]
        );

        $this->add_control(
            'button_bg_color_normal',
            [
                'label'                 => __( 'Background Color', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#724cff',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_normal',
            [
                'label'                 => __( 'Text Color', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#FFF',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'exad_contact_button_border_color_normal',
            [
                'label'                 => __( 'Border Color', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => 'transparent',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        
    
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label'                 => __( 'Hover', 'exclusive-addons-elementor' ),
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label'                 => __( 'Background Color', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#FFF',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label'                 => __( 'Text Color', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#724cff',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#724cff',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_control(
			'exad_contact_button_border_radius',
			[
				'label'                 => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'separator'             => 'before',
				'selectors'             => [
					'{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px'
                    ]
			]
		);

		$this->add_control(
			'button_padding',
			[
				'label'                 => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'default' => [
                    'top' => 20,
                    'right' => 50,
                    'bottom' => 20,
                    'left' => 50,
                    'unit' => 'px'
                ]
			]
		);
        
        $this->end_controls_section();

        /**
         * Style Tab: Errors
         */
        $this->start_controls_section(
            'exad_section_error_style',
            [
                'label'                 => __( 'Errors', 'exclusive-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'error_messages_heading',
            [
                'label'                 => __( 'Error Messages', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::HEADING,
				'condition'             => [
					'exad_error_messages' => 'show',
				],
            ]
        );


        $this->add_control(
            'error_alert_text_color',
            [
                'label'                 => __( 'Text Color', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-not-valid-tip' => 'color: {{VALUE}}',
                ],
				'condition'             => [
					'exad_error_messages' => 'show',
				],
            ]
        );
        

        $this->add_control(
            'error_field_bg_color',
            [
                'label'                 => __( 'Background Color', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-not-valid-tip' => 'background: {{VALUE}}',
                ],
				'condition'             => [
					'exad_error_messages' => 'show',
				],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'error_field_border',
				'label'                 => __( 'Border', 'exclusive-addons-elementor' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-not-valid-tip',
				'separator'             => 'before',
				'condition'             => [
					'exad_error_messages' => 'show',
				],
			]
		);

        
        $this->add_control(
            'validation_errors_heading',
            [
                'label'                 => __( 'Validation Errors', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
				'condition'             => [
					'exad_validation_errors' => 'show',
				],
            ]
        );

        $this->add_control(
            'validation_errors_bg_color',
            [
                'label'                 => __( 'Background Color', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-validation-errors' => 'background: {{VALUE}}',
                ],
				'condition'             => [
					'exad_validation_errors' => 'show',
				],
            ]
        );

        $this->add_control(
            'validation_errors_color',
            [
                'label'                 => __( 'Text Color', 'exclusive-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-validation-errors' => 'color: {{VALUE}}',
                ],
				'condition'             => [
					'exad_validation_errors' => 'show',
				],
            ]
        );
        

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'validation_errors_border',
				'label'                 => __( 'Border', 'exclusive-addons-elementor' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-validation-errors',
				'separator'             => 'before',
				'condition'             => [
					'exad_validation_errors' => 'show',
				],
			]
		);
        
        $this->end_controls_section();

    }

    /**
	 * @access protected
	 */
    protected function render() {
        $settings = $this->get_settings();
        
        $this->add_render_attribute( 'exad-contact-form', 'class', [
				'exad-contact-form',
				'exad-contact-form-7',
                'exad-contact-form-'.esc_attr($this->get_id())
			]
		);
        
        if ( function_exists( 'wpcf7' ) ) {
            if ( ! empty( $settings['exad_contact_form_list'] ) ) { ?>
                <div <?php echo $this->get_render_attribute_string( 'exad-contact-form' ); ?>>
                        
                    <?php if ( $settings['exad_contact_form_title_text'] != '' ) { ?>
                        <h3 class="exad-contact-form-title exad-contact-form-7-title">
                            <?php echo esc_attr( $settings['exad_contact_form_title_text'] ); ?>
                        </h3>
                    <?php } ?>
                            
                    <?php echo do_shortcode( '[contact-form-7 id="' . $settings['exad_contact_form_list'] . '" ]' ); ?>
                </div>
                
                <?php
            }
        }
    }

    /**
	 * @access protected
	 */
    protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Contact_Form() );