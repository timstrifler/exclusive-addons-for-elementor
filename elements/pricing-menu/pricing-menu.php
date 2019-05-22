<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Pricing_Menu extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-pricing-menu';
	}
	public function get_title() {
		return esc_html__( 'Ex Pricing Menu', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-price-list';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function _register_controls() {
    /**
     * Pricing Menu Content
     */
    $this->start_controls_section(
      'exad_section_pricing_menu_content',
      [
        'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
      ]
    );

    $price_menu_repeater = new Repeater();

    $price_menu_repeater->add_control(
        'exad_pricing_menu_enable_image',
        [
            'label' => __( 'Enable Image', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
            'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );


    $price_menu_repeater->add_control(
      'exad_pricing_menu_image',
      [
          'label' => esc_html__( 'Image', 'exclusive-addons-elementor' ),
          'type' => Controls_Manager::MEDIA,
          'default' => [
              'url' => Utils::get_placeholder_image_src(),
          ],
      ]
    );
    $price_menu_repeater->add_group_control(
        Group_Control_Image_Size::get_type(),
        [
            'name' => 'thumbnail',
            'default' => 'full',
            'condition' => [
                'exad_pricing_menu_image[url]!' => '',
            ],
        ]
    );

    $price_menu_repeater->add_control(
      'exad_pricing_menu_title',
      [
        'label' => esc_html__('Title', 'exclusive-addons-elementor'),
        'type' => Controls_manager::TEXT,
        'default' => esc_html__( 'Name The Product', 'exclusive-addons-elementor' ),
      ]
    );
    $price_menu_repeater->add_control(
      'exad_pricing_menu_description',
      [
        'label' => esc_html__('Description', 'exclusive-addons-elementor'),
        'type' => Controls_manager::TEXTAREA,
        'default' => esc_html__( 'Asparagus, hens egg, toasted sunflower seeds, Spenwood cheese', 'exclusive-addons-elementor' ),
      ]
    );
    $price_menu_repeater->add_control(
        'exad_pricing_menu_enable_link',
        [
            'label' => __( 'Enable Order Button', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
            'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );
    $price_menu_repeater->add_control(
        'exad_pricing_menu_action_text',
        [
            'label' => esc_html__('Order Action', 'exclusive-addons-elementor'),
            'type' => Controls_manager::TEXT,
            'default' => 'Order Now',
            'condition' => [
                'exad_pricing_menu_enable_link' => 'yes',
            ],
        ]
    );
    $price_menu_repeater->add_control(
        'exad_pricing_menu_price',
        [
            'label' => __( 'Price', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::NUMBER,
            'default' => 14,
        ]
    );
    $this->add_control(
        'pricing_menu_repeater',
        [
            'label' => esc_html__( 'Pricing List', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::REPEATER,
            'fields' => $price_menu_repeater->get_controls(),
            'default' => [
                [
                    'exad_pricing_menu_title' => __( 'List #1', 'exclusive-addons-elementor' ),
                ],
                [
                    'exad_pricing_menu_title' => __( 'List #2', 'exclusive-addons-elementor' ),
                ],
                [
                    'exad_pricing_menu_title' => __( 'List #3', 'exclusive-addons-elementor' ),
                ],
                [
                    'exad_pricing_menu_title' => __( 'List #4', 'exclusive-addons-elementor' ),
                ],
            ]	
        ]
    );

    $this->end_controls_section();
    /**
     * Pricing menu style
     */
    $this->start_controls_section(
        'exad_section_pricing_menu_style',
      [
        'label' => esc_html__( 'Preset', 'exclusive-addons-elementor' ),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_control(
		'exad_pricing_menu_preset',
		[
			'label' => esc_html__( 'Presets', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'one',
			'separator' => 'before',
			'options' => [
				'one' => esc_html__( 'One', 'exclusive-addons-elementor' ),
				'two' => esc_html__( 'Two', 'exclusive-addons-elementor' ), 
				'three' => esc_html__( 'Three', 'exclusive-addons-elementor' ), 
				'four' => esc_html__( 'Four', 'exclusive-addons-elementor' ),
				'five' => esc_html__( 'Five', 'exclusive-addons-elementor' ),
				'six' => esc_html__( 'Six', 'exclusive-addons-elementor' ),
			]
		]
    );

    $this->add_group_control(
        Group_Control_Background::get_type(),
        [
            'name' => 'exad_price_list_background',
            'label' => __( 'Background', 'exclusive-addons-elementor' ),
            'types' => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} .exad-pricing-list-wrapper',
            'condition' => [
                'exad_pricing_menu_preset!' => 'five',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Background::get_type(),
        [
            'name' => 'exad_price_list_background_item',
            'label' => __( 'Background', 'exclusive-addons-elementor' ),
            'types' => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} .exad-pricing-list-wrapper .exad-pricing-list-item',
            'condition' => [
                'exad_pricing_menu_preset' => 'five',
            ],
        ]
    );
    $this->end_controls_section();
    /**
     * Pricing menu Title style
     */
    $this->start_controls_section(
        'exad_pricing_menu_title',
      [
        'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    $this->start_controls_tabs( 'exad_pricing_menu_title_color' );
        $this->start_controls_tab( 'exad_pricing_menu_title_color_control', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );
            $this->add_control(
                'exad_pricing_menu_title_color_normal',
                [
                    'label' => esc_html__( 'Title Color', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#0A1724',
                    'selectors' => [
                        '{{WRAPPER}} .exad-pricing-list-item .exad-pricing-list-item-content .exad-pricing-list-item-content-title' => 'color: {{VALUE}};',
                    ],
                ]
            );
        $this->end_controls_tab();
        $this->start_controls_tab( 'exad_pricing_menu_title_color_hover_control', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );
            $this->add_control(
                'exad_pricing_menu_title_color_hover',
                [
                    'label' => esc_html__( 'Title Color', 'exclusive-addons-elementor' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#dea728',
                    'selectors' => [
                        '{{WRAPPER}} .exad-pricing-list-item .exad-pricing-list-item-content .exad-pricing-list-item-content-title:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
        $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'exad_pricing_menu_title_typography',
            'label' => __( 'Title Typography', 'exclusive-addons-elementor' ),
            'selector' => '{{WRAPPER}} .exad-pricing-list-item .exad-pricing-list-item-content .exad-pricing-list-item-content-title',
        ]
    );
    $this->end_controls_section();
    /**
     * Pricing menu Description style
     */
    $this->start_controls_section(
        'exad_pricing_menu_description',
      [
        'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_control(
        'exad_pricing_menu_description_color',
        [
            'label' => esc_html__( 'Description Color', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#8b8e93',
            'selectors' => [
                '{{WRAPPER}} .exad-pricing-list-item .exad-pricing-list-item-content .exad-pricing-list-item-content-description' => 'color: {{VALUE}};',
            ],
        ]
    );
        
    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'exad_pricing_menu_description_typography',
            'label' => __( 'Description Typography', 'exclusive-addons-elementor' ),
            'selector' => '{{WRAPPER}} .exad-pricing-list-item .exad-pricing-list-item-content .exad-pricing-list-item-content-description',
        ]
    );
    $this->end_controls_section();

    /**
     * Pricing menu Price style
     */
    $this->start_controls_section(
        'exad_pricing_menu_price',
      [
        'label' => esc_html__( 'Price', 'exclusive-addons-elementor' ),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_control(
        'exad_pricing_menu_price_color',
        [
            'label' => esc_html__( 'Price Color', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#f43d6b',
            'selectors' => [
                '{{WRAPPER}} .exad-pricing-list-item .exad-pricing-list-item-price' => 'color: {{VALUE}};',
            ],
        ]
    );
        
    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'exad_pricing_menu_price_typography',
            'label' => __( 'Description Typography', 'exclusive-addons-elementor' ),
            'selector' => '{{WRAPPER}} .exad-pricing-list-item .exad-pricing-list-item-price',
        ]
    );
    $this->end_controls_section();

    /**
     * Pricing menu Saperator style
     */
    $this->start_controls_section(
        'exad_pricing_menu_separetor',
      [
        'label' => esc_html__( 'Seperator', 'exclusive-addons-elementor' ),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    $this->add_control(
        'exad_pricing_menu_seperator_color',
        [
            'label' => esc_html__( 'Seperator Color', 'exclusive-addons-elementor' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#e3e3e3',
            'selectors' => [
                '{{WRAPPER}} .exad-pricing-list-item' => 'border-bottom-color: {{VALUE}};'
            ],
        ]
    );
    $this->end_controls_section();
	}

	protected function render() {

        
        $settings = $this->get_settings_for_display();
        $pricing_menu_preset = $settings['exad_pricing_menu_preset'];

        ?>
            <div class="exad-pricing-list <?php echo $pricing_menu_preset ?>">
                <div class="exad-pricing-list-wrapper">
                <?php foreach ( $settings['pricing_menu_repeater'] as $list ) : 

                $exad_pricing_menu_image = $this->get_settings_for_display( 'exad_pricing_menu_image' );
                $exad_pricing_menu_image_url = Group_Control_Image_Size::get_attachment_image_src( $logo_image['id'], 'thumbnail', $settings );
                if( empty( $exad_pricing_menu_image_url ) ) : $exad_pricing_menu_image_url = $exad_pricing_menu_image['url']; else: $exad_pricing_menu_image_url = $exad_pricing_menu_image_url; endif;
                ?>
                    <div class="exad-pricing-list-item">
                        <?php if( $list['exad_pricing_menu_enable_image'] === 'yes' ) { ?>
                            <div class="exad-pricing-list-item-thumbnail">
                                <img src="<?php echo esc_url( $list['exad_pricing_menu_image']['url'] ); ?>" alt="<?php echo $list['exad_pricing_menu_title']; ?>">
                            </div>
                        <?php } ?>
                        <div class="exad-pricing-list-item-content">
                            <?php if( $settings['exad_pricing_menu_preset'] === 'six' ) { ?>
                                <div class="exad-pricing-list-item-content-element">
                                    <a href="#" class="exad-pricing-list-item-content-title">
                                        <?php echo $list['exad_pricing_menu_title'] ?>
                                    </a>
                                    <span class="exad-pricing-list-item-content-conntector"></span>
                                </div>
                            <?php } 
                            else { ?>
                                <a href="#" class="exad-pricing-list-item-content-title">
                                    <?php echo $list['exad_pricing_menu_title'] ?>
                                </a>
                            <?php } ?>
                            <p class="exad-pricing-list-item-content-description">
                                <?php echo $list['exad_pricing_menu_description'] ?>
                            </p>
                            <?php if( $list['exad_pricing_menu_enable_link'] === 'yes' ) { ?>
                                <a href="#" class="exad-pricing-list-item-content-action"><?php echo $list['exad_pricing_menu_action_text'] ?></a>
                            <?php } ?>
                        </div>
                        <div class="exad-pricing-list-item-price">
                            <span>$<?php echo $list['exad_pricing_menu_price'] ?></span>
                        </div>
                    </div>
                 <?php endforeach; ?>
                </div>
            </div>
    <?php
	}

	protected function _content_template() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Pricing_Menu() );