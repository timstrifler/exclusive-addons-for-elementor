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
        return __( 'DC Contact Form 7', 'essential-addons-elementor' );
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
        return [ 'essential-addons-elementor' ];
    }

    /**
	 * Retrieve contact form 7 widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
    public function get_icon() {
        return 'fa fa-envelope-o';
    }

    /**
	 * Register contact form 7 widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
    protected function _register_controls() {

        /*-----------------------------------------------------------------------------------*/
        /*	CONTENT TAB
        /*-----------------------------------------------------------------------------------*/
        
        /**
         * Content Tab: Contact Form
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'exad_section_contact_intro',
            [
                'label'  => __( 'Contact Form', 'essential-addons-elementor' ),
            ]
        );
		
		$this->add_control(
			'exad_contact_form_list',
			[
				'label'                 => esc_html__( 'Select Form', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::SELECT,
				'label_block'           => true,
				'options'               => Exad_Helper::exad_retrive_contact_form(),
                'default'               => '0',
			]
		);
        
        $this->add_control(
            'exad_contact_form_title',
            [
                'label'                 => __( 'Form Title', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SWITCHER,
                'label_on'              => __( 'On', 'essential-addons-elementor' ),
                'label_off'             => __( 'Off', 'essential-addons-elementor' ),
                'return_value'          => 'yes',
            ]
        );
		
		$this->add_control(
			'exad_contact_form_title_text',
			[
				'label'                 => esc_html__( 'Title', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::TEXT,
				'label_block'           => true,
                'default'               => '',
                'condition'             => [
                    'exad_contact_form_title'   => 'yes',
                ],
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
                'label'                 => __( 'Errors', 'essential-addons-elementor' ),
            ]
        );
        
        $this->add_control(
            'exad_error_messages',
            [
                'label'                 => __( 'Error Messages', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'show',
                'options'               => [
                    'show'          => __( 'Show', 'essential-addons-elementor' ),
                    'hide'          => __( 'Hide', 'essential-addons-elementor' ),
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
                'label'                 => __( 'Validation Errors', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'show',
                'options'               => [
                    'show'          => __( 'Show', 'essential-addons-elementor' ),
                    'hide'          => __( 'Hide', 'essential-addons-elementor' ),
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


        /*-----------------------------------------------------------------------------------*/
        /*	STYLE TAB
        /*-----------------------------------------------------------------------------------*/


        /**
         * Style Tab: Form Container
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'exad_section_container_style',
            [
                'label'                 => __( 'Form Container', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'exad_contact_form_background',
                'label'     => __( 'Background', 'plugin-domain' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .exad-contact-form',
            ]
        );
		
        $this->add_control(
            'exad_contact_container_border_top',
            [
                'label'                 => __( 'Border Top Color', 'essential-addons-elementor' ),
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
  				'label' => esc_html__( 'Form Width', 'essential-addons-elementor' ),
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
				'label' => esc_html__( 'Form Padding', 'essential-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .exad-contact-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'default' => [
                    'top' => 60,
                    'right' => 40,
                    'bottom' => 60,
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
            'section_fields_title_description',
            [
                'label'                 => __( 'Title', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'heading_alignment',
            [
                'label'                 => __( 'Alignment', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::CHOOSE,
                'options'               => [
                    'left'      => [
                        'title' => __( 'Left', 'essential-addons-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'essential-addons-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'essential-addons-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .exad-contact-form-7-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'title_heading',
            [
                'label'                 => __( 'Title', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'title_text_color',
            [
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 label' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'title_typography',
                'label'                 => __( 'Typography', 'essential-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .exad-contact-form-7 label',
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
                'label'                 => __( 'Input & Textarea', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        

        $this->add_control(
            'field_bg',
            [
                'label'                 => __( 'Background Color', 'essential-addons-elementor' ),
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
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'color: {{VALUE}}',
                ],
				'separator'         => 'before',
            ]
        );
        
        

		$this->add_responsive_control(
			'field_padding',
			[
				'label'                 => __( 'Padding', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
        $this->add_responsive_control(
            'textarea_width',
            [
                'label'                 => __( 'Textarea Width', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 1200,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'field_border',
				'label'                 => __( 'Border', 'essential-addons-elementor' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-select',
				'separator'             => 'before',
			]
		);

		$this->add_control(
			'field_radius',
			[
				'label'                 => __( 'Border Radius', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        // Placeholder style
        $this->add_control(
            'placeholder_heading',
            [
                'label'                 => __( 'Placeholder', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'placeholder_color',
            [
                'label'                 => __( 'Placeholder Color', 'essential-addons-elementor' ),
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
                'name'                  => 'placeholder_typography',
                'label'                 => __( 'Typography', 'essential-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .exad-contact-form-7 label input::placeholder,{{WRAPPER}} .exad-contact-form-7 label textarea::placeholder',
            ]
        );

        
        $this->end_controls_section();

        /**
         * Style Tab: Label Section
         */
        $this->start_controls_section(
            'section_label_style',
            [
                'label'                 => __( 'Labels', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
                'condition'             => [
                    'labels_switch'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'text_color_label',
            [
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form label' => 'color: {{VALUE}}',
                ],
                'condition'             => [
                    'labels_switch'   => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'label_spacing',
            [
                'label'                 => __( 'Spacing', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form label' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'labels_switch'   => 'yes',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'typography_label',
                'label'                 => __( 'Typography', 'essential-addons-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form label',
                'condition'             => [
                    'labels_switch'   => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();


        /**
         * Style Tab: Submit Button
         */
        $this->start_controls_section(
            'section_submit_button_style',
            [
                'label' => __( 'Submit Button', 'essential-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
    
    

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'essential-addons-elementor' ),
            ]
        );

        $this->add_control(
            'button_bg_color_normal',
            [
                'label'                 => __( 'Background Color', 'essential-addons-elementor' ),
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
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#FFF',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'button_border_color_normal',
            [
                'label'                 => __( 'Border Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => 'transparent',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]' => 'border-color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
			'button_border_radius',
			[
				'label'                 => __( 'Border Radius', 'essential-addons-elementor' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
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
				'label'                 => __( 'Padding', 'essential-addons-elementor' ),
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
        
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label'                 => __( 'Hover', 'essential-addons-elementor' ),
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label'                 => __( 'Background Color', 'essential-addons-elementor' ),
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
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
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
                'label'                 => __( 'Border Color', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '#724cff',
                'selectors'             => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

        /**
         * Style Tab: Errors
         */
        $this->start_controls_section(
            'exad_section_error_style',
            [
                'label'                 => __( 'Errors', 'essential-addons-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'error_messages_heading',
            [
                'label'                 => __( 'Error Messages', 'essential-addons-elementor' ),
                'type'                  => Controls_Manager::HEADING,
				'condition'             => [
					'exad_error_messages' => 'show',
				],
            ]
        );


        $this->add_control(
            'error_alert_text_color',
            [
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
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
                'label'                 => __( 'Background Color', 'essential-addons-elementor' ),
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
				'label'                 => __( 'Border', 'essential-addons-elementor' ),
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
                'label'                 => __( 'Validation Errors', 'essential-addons-elementor' ),
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
                'label'                 => __( 'Background Color', 'essential-addons-elementor' ),
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
                'label'                 => __( 'Text Color', 'essential-addons-elementor' ),
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
				'label'                 => __( 'Border', 'essential-addons-elementor' ),
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
                        
                    <?php if ( $settings['exad_contact_form_title'] == 'yes' && $settings['exad_contact_form_title_text'] != '' ) { ?>
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