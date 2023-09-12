<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \ExclusiveAddons\Elementor\Helper;

/**
 * Contact Form 7 Element
 */
class Contact_Form_7 extends Widget_Base {
    
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
        return __( 'Contact Form 7', 'exclusive-addons-elementor' );
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

    public function get_keywords() {
        return [ 'exclusive', 'cf7' ];
    }

    /**
	 * Retrieve contact form 7 widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
    public function get_icon() {
        return 'exad exad-logo exad-contact-form-7';
    }

    /**
	 * Register contact form 7 widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
    protected function register_controls() {
        $exad_primary_color = get_option( 'exad_primary_color_option', '#7a56ff' );

        if( ! class_exists( 'WPCF7_ContactForm' ) ) {
            $this->start_controls_section(
                'exad_contact_from_panel_notice',
                [
                    'label' => __('Notice!', 'exclusive-addons-elementor'),
                ]
            );

            $this->add_control(
                'exad_contact_from_panel_notice_text',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => __('<strong>contact Form 7</strong> is not installed/activated on your site. Please install and activate <a href="plugin-install.php?s=contact+form+7&tab=search&type=term" target="_blank">Contact Form 7</a> first.',
                        'exclusive-addons-elementor'),
                    'content_classes' => 'exad-panel-notice',
                ]
            );

            $this->end_controls_section();
            return;
        }
        
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
                'label'       => esc_html__( 'Select Form', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'options'     => Helper::exad_retrive_contact_form(),
                'default'     => '0'
			]
		);
        
		$this->add_control(
			'exad_contact_form_title_text',
			[
                'label'       => esc_html__( 'Title', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => [
					'active' => true,
				]
			]
		);

        $this->add_control(
            'exad_contact_form_title_tag',
            [
                'label'   => __('Title HTML Tag', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SELECT,
                'options' => Helper::exad_title_tags(),
                'default' => 'h3',
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
                'label'   => __( 'Errors', 'exclusive-addons-elementor' )
            ]
        );
        
        $this->add_control(
            'exad_error_messages',
            [
                'label'   => __( 'Error Messages', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'show',
                'options' => [
                    'show' => __( 'Show', 'exclusive-addons-elementor' ),
                    'hide' => __( 'Hide', 'exclusive-addons-elementor' )
                ],
                'selectors_dictionary'  => [
                    'show' => 'block',
                    'hide' => 'none'
                ],
                'selectors' => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-not-valid-tip' => 'display: {{VALUE}} !important;'
                ]
            ]
        );

        $this->add_control(
            'exad_validation_errors',
            [
                'label'   => __( 'Validation Errors', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'show',
                'options' => [
                    'show' => __( 'Show', 'exclusive-addons-elementor' ),
                    'hide' => __( 'Hide', 'exclusive-addons-elementor' )
                ],
                'selectors_dictionary'  => [
                    'show' => 'block',
                    'hide' => 'none'
                ],
                'selectors' => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-validation-errors' => 'display: {{VALUE}} !important;'
                ]
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
                'label' => __( 'Form Container', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'exad_contact_form_background',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .exad-contact-form'
            ]
        );

  		$this->add_responsive_control(
  			'exad_contact_form_width',
  			[
                'label'      => esc_html__( 'Form Width', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px'      => [
						'min' => 10,
						'max' => 1500
					],
					'em'      => [
						'min' => 1,
						'max' => 80
					]
				],
				'default'    => [
				        'unit' => '%',
                        'size' => '100'
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-contact-form' => 'width: {{SIZE}}{{UNIT}};'
				]
  			]
  		);
		
		$this->add_responsive_control(
			'exad_contact_form_padding',
			[
                'label'      => esc_html__( 'Form Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
					'{{WRAPPER}} .exad-contact-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
                'default'    => [
                    'top'    => 40,
                    'right'  => 40,
                    'bottom' => 40,
                    'left'   => 40,
                    'unit'   => 'px'
                ]
			]
        );

        $this->add_responsive_control(
			'exad_cf7_container_margin',
			[
                'label'      => esc_html__( 'Form Margin', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'separator'  => 'after',
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
					'{{WRAPPER}} .exad-contact-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px'
                ]
			]
        );
        
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'name'     => 'exad_cf7_container_border',
                'selector' => '{{WRAPPER}} .exad-contact-form'
			]
		);

		$this->add_responsive_control(
			'exad_cf7_container_border_radius',
			[
                'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => '0',
                    'right'  => '0',
                    'bottom' => '0',
                    'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-contact-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
                'name'     => 'exad_cf7_container_shadow',
                'selector' => '{{WRAPPER}} .exad-contact-form'
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
                'label' => __( 'Title', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'title_text_color',
            [
                'label'     => __( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exad-contact-form-7 .exad-contact-form-7-title' => 'color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_responsive_control(
            'exad_contact_heading_alignment',
            [
                'label'   => __( 'Alignment', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::CHOOSE,
                'toggle'  => false,
                'options' => [
                    'left'      => [
                        'title' => __( 'Left', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'    => [
                        'title' => __( 'Center', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'     => [
                        'title' => __( 'Right', 'exclusive-addons-elementor' ),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .exad-contact-form-7 .exad-contact-form-7-title' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_contact_title_typography',
                'selector' => '{{WRAPPER}} .exad-contact-form-7 .exad-contact-form-7-title'
            ]
        ); 

        $this->add_responsive_control(
			'exad_contact_title_margin',
			[
                'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .exad-contact-form-7 .exad-contact-form-7-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
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
                'label' => __( 'Input & Textarea', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'exad_contact_field_bg',
            [
                'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EDEDED',
                'selectors' => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'exad_contact_field_text_color',
            [
                'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'exad_contact_field_placeholder_color',
            [
                'label'     => __( 'Placeholher Text Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exad-contact-form-7 input[type="text"]::placeholder,
                        {{WRAPPER}} .exad-contact-form-7 input[type="email"]::placeholder,
                        {{WRAPPER}} .exad-contact-form-7 input[type="url"]::placeholder,
                        {{WRAPPER}} .exad-contact-form-7 input[type="password"]::placeholder,
                        {{WRAPPER}} .exad-contact-form-7 input[type="search"]::placeholder,
                        {{WRAPPER}} .exad-contact-form-7 input[type="number"]::placeholder,
                        {{WRAPPER}} .exad-contact-form-7 input[type="tel"]::placeholder,
                        {{WRAPPER}} .exad-contact-form-7 input[type="range"]::placeholder,
                        {{WRAPPER}} .exad-contact-form-7 input[type="date"]::placeholder,
                        {{WRAPPER}} .exad-contact-form-7 input[type="month"]::placeholder,
                        {{WRAPPER}} .exad-contact-form-7 input[type="week"]::placeholder,
                        {{WRAPPER}} .exad-contact-form-7 input[type="time"]::placeholder,
                        {{WRAPPER}} .exad-contact-form-7 input[type="datetime"]::placeholder,
                        {{WRAPPER}} .exad-contact-form-7 input[type="datetime-local"]::placeholder,
                        {{WRAPPER}} .exad-contact-form-7 input[type="color"]::placeholder,
                        {{WRAPPER}} .exad-contact-form-7 textarea::placeholder' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_contact_field_typography',
                'selector' => '{{WRAPPER}} .exad-contact-form-7 input[type="text"],
                        {{WRAPPER}} .exad-contact-form-7 input[type="email"],
                        {{WRAPPER}} .exad-contact-form-7 input[type="url"],
                        {{WRAPPER}} .exad-contact-form-7 input[type="password"],
                        {{WRAPPER}} .exad-contact-form-7 input[type="search"],
                        {{WRAPPER}} .exad-contact-form-7 input[type="number"],
                        {{WRAPPER}} .exad-contact-form-7 input[type="tel"],
                        {{WRAPPER}} .exad-contact-form-7 input[type="range"],
                        {{WRAPPER}} .exad-contact-form-7 input[type="date"],
                        {{WRAPPER}} .exad-contact-form-7 input[type="month"],
                        {{WRAPPER}} .exad-contact-form-7 input[type="week"],
                        {{WRAPPER}} .exad-contact-form-7 input[type="time"],
                        {{WRAPPER}} .exad-contact-form-7 input[type="datetime"],
                        {{WRAPPER}} .exad-contact-form-7 input[type="datetime-local"],
                        {{WRAPPER}} .exad-contact-form-7 input[type="color"],
                        {{WRAPPER}} .exad-contact-form-7 textarea'
            ]
        );
        
        $this->add_responsive_control(
            'exad_contact_input_field_height',
            [
                'label'        => esc_html__( 'Input Field Height', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 150,
                        'step' => 1
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 50
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-contact-form-7 input[type="text"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="email"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="url"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="password"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="search"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="number"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="tel"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="range"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="date"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="month"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="week"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="time"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="datetime"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="datetime-local"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="color"]' => 'height: {{SIZE}}px;'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_contact_textarea_field_height',
            [
                'label'        => esc_html__( 'Textarea Height', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 150
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-contact-form-7 textarea' => 'height: {{SIZE}}px;'
                ]
            ]
        );

		$this->add_responsive_control(
			'exad_contact_field_padding',
			[
                'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'unit'   => 'px',
					'size'   => 15
                ],
				'selectors'  => [
					'{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

        $this->add_responsive_control(
            'exad_contact_field_margin',
            [
                'label'      => __( 'Margin', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-contact-form-7 input, {{WRAPPER}} .exad-contact-form-7 textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'default'    => [
                    'top'    => 10,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_contact_field_width',
            [
                'label'         => __( 'Field Width', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 1200,
                        'step'  => 1
                    ]
                ],
                'size_units'    => [ 'px', 'em', '%' ],
                'default'       => [
                    'unit'      => '%',
					'size'      => 100
                ],
                'selectors'     => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'width: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_contact_input_field_bottom_spacing',
            [
                'label'        => esc_html__( 'Field Bottom Spacing', 'exclusive-addons-elementor' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 20
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-contact-form-7 input[type="text"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="email"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="url"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="password"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="search"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="number"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="tel"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="range"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="date"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="month"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="week"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="time"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="datetime"],
                    {{WRAPPER}} .exad-contact-form-7 input[type="datetime-local"],
                    {{WRAPPER}} .exad-contact-form-7 textarea,
                    {{WRAPPER}} .exad-contact-form-7 input[type="color"]' => 'margin-bottom: {{SIZE}}px;'
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'name'        => 'exad_contact_field_border',
                'selector'    => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-select'
			]
		);

		$this->add_responsive_control(
			'exad_contact_field_radius',
			[
                'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
					'{{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .exad-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Label Section
         */
        $this->start_controls_section(
            'exad_contact_section_label_style',
            [
                'label' => __( 'Labels', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'text_color_label',
            [
                'label'     => __( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form label' => 'color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_contact_typography_label',
                'selector' => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form label'
            ]
        );
        
        $this->end_controls_section();

        /**
         * Style Tab: Submit Button
         */
        $this->start_controls_section(
            'exad_contact_section_submit_button_style',
            [
                'label' => __( 'Submit Button', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'exad_contact_section_submit_button_alignment',
            [
                'label'   => __( 'Alignment', 'exclusive-addons-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
					'left'  => __( 'Button Left', 'exclusive-addons-elementor' ),
					'center'  => __( 'Button Center', 'exclusive-addons-elementor' ),
					'right'  => __( 'Button Right', 'exclusive-addons-elementor' ),
					'justify'  => __( 'Button Justify', 'exclusive-addons-elementor' ),
				],
				'desktop_default' => 'center',
				'tablet_default' => 'center',
				'mobile_default' => 'center',
				'selectors_dictionary' => [
					'left' => 'margin-right: auto;',
					'center' => 'margin-left: auto; margin-right: auto;',
					'right' => 'margin-left: auto;',
					'justify' => 'width: 100%; justify-content: center;',
				],
                'selectors'     => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]' => '{{VALUE}};'
                ]
            ]
        );
    
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'exad_contact_button_typography',
                'label'    => __( 'Button Typography', 'exclusive-addons-elementor' ),
                'selector' => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]'
            ]
        );

        $this->add_responsive_control(
            'exad_contact_button_border_radius',
            [
                'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px'
                ]
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'default'      => [
                    'top'      => 20,
                    'right'    => 50,
                    'bottom'   => 20,
                    'left'     => 50,
                    'unit'     => 'px',
                    'isLinked' => false
                ]
            ]
        );

        $this->add_responsive_control(
            'exad_contact_button_spacing',
            [
                'label'         => __( 'Top Spacing', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1
                    ]
                ],
                'size_units'    => [ 'px' ],
                'default'       => [
                    'unit'      => 'px',
					'size'      => 10
                ],
                'selectors'     => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'           => 'exad_cf7_button_shadow',
                'selector'       => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]',
                'fields_options' => [
                    'box_shadow_type' => [ 
                        'default'     =>'yes' 
                    ],
                    'box_shadow'  => [
                        'default' => [
                            'horizontal' => 0,
                            'vertical'   => 13,
                            'blur'       => 33,
                            'spread'     => 0,
                            'color'      => 'rgba(51, 77, 128, 0.2)'
                        ]
                    ]
                ]
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'exad_contact_tab_button_normal',
            [
                'label' => __( 'Normal', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_contact_button_text_color_normal',
            [
                'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'exad_contact_button_bg_color_normal',
            [
                'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => $exad_primary_color,
                'selectors' => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'               => 'exad_contact_button_border',
                'fields_options'     => [
                    'border'         => [
                        'default'    => 'solid'
                    ],
                    'width'          => [
                        'default'    => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                    'color'          => [
                        'default'    => $exad_primary_color
                    ]
                ],
                'selector'           => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'           => 'exad_contact_button_box_shadow_normal',
                'label'          => __( 'Box Shadow', 'exclusive-addons-elementor' ),
                'selector'       => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]',
                'fields_options' => [
                    'box_shadow_type' => [ 
                        'default'     =>'yes' 
                    ],
                    'box_shadow'  => [
                        'default' => [
                            'horizontal' => 0,
                            'vertical'   => 13,
                            'blur'       => 33,
                            'spread'     => 0,
                            'color'      => 'rgba(51, 77, 128, 0.2)'
                        ]
                    ]
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label'  => __( 'Hover', 'exclusive-addons-elementor' )
            ]
        );

        $this->add_control(
            'exad_contact_button_text_color_hover',
            [
                'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => $exad_primary_color,
                'selectors' => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'exad_contact_button_bg_color_hover',
            [
                'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'exad_contact_button_border_hover',
                'selector' => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]:hover'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'           => 'exad_contact_button_box_shadow_hover',
                'label'          => __( 'Box Shadow', 'exclusive-addons-elementor' ),
                'selector'       => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-form input[type="submit"]:hover'
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
                'label' => __( 'Errors', 'exclusive-addons-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );
        
        $this->add_control(
            'exad_contact_error_messages_heading',
            [
                'label'     => __( 'Error Messages', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
					'exad_error_messages' => 'show'
				]
            ]
        );

        $this->add_control(
            'exad_contact_error_alert_text_color',
            [
                'label'     => __( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-not-valid-tip' => 'color: {{VALUE}}'
                ],
				'condition' => [
					'exad_error_messages' => 'show'
				]
            ]
        );

        $this->add_control(
            'exad_contact_error_field_bg_color',
            [
                'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-not-valid-tip' => 'background: {{VALUE}}',
                ],
				'condition' => [
					'exad_error_messages' => 'show'
				]
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'name'        => 'exad_contact_error_field_border',
                'selector'    => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-not-valid-tip',
                'condition'   => [
					'exad_error_messages' => 'show'
				]
			]
		);
        
        $this->add_control(
            'exad_contact_validation_errors_heading',
            [
                'label'     => __( 'Validation Errors', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
					'exad_validation_errors' => 'show'
				]
            ]
        );

        $this->add_control(
            'exad_contact_validation_errors_color',
            [
                'label'     => __( 'Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-validation-errors' => 'color: {{VALUE}}'
                ],
                'condition' => [
                    'exad_validation_errors' => 'show'
                ]
            ]
        );

        $this->add_control(
            'exad_contact_validation_errors_bg_color',
            [
                'label'     => __( 'Background Color', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .exad-contact-form-7 .wpcf7-validation-errors' => 'background: {{VALUE}}'
                ],
				'condition' => [
					'exad_validation_errors' => 'show'
				]
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'name'        => 'validation_errors_border',
                'selector'    => '{{WRAPPER}} .exad-contact-form-7 .wpcf7-validation-errors',
                'condition'   => [
					'exad_validation_errors' => 'show'
				]
			]
		);
        
        $this->end_controls_section();

    }

    /**
	 * @access protected
	 */
    protected function render() {
        if( ! class_exists( 'WPCF7_ContactForm' ) ) {
            return;
        }        

        $settings = $this->get_settings_for_display();
        
        $this->add_render_attribute( 'exad-contact-form', 'class', [
				'exad-contact-form',
				'exad-contact-form-7',
                'exad-contact-form-'.esc_attr($this->get_id())
			]
		);
        
        if ( ! empty( $settings['exad_contact_form_list'] ) ) { ?>
            <div <?php echo $this->get_render_attribute_string( 'exad-contact-form' ); ?>>
                    
                <?php if ( '' != $settings['exad_contact_form_title_text'] ) { ?>
                    <<?php echo Utils::validate_html_tag( $settings['exad_contact_form_title_tag'] ); ?> class="exad-contact-form-title exad-contact-form-7-title">
                        <?php echo esc_html( $settings['exad_contact_form_title_text'] ); ?>
                    </<?php echo Utils::validate_html_tag( $settings['exad_contact_form_title_tag'] ); ?>>
                <?php } ?>
                        
                <?php echo do_shortcode( '[contact-form-7 id="' . $settings['exad_contact_form_list'] . '" ]' ); ?>
            </div>
            
            <?php
        }
        
    }
}