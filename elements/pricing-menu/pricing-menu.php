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
	}

	protected function render() {

        
        $settings = $this->get_settings_for_display();

        ?>
            <div class="exad-pricing-list one">
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
                            <a href="#" class="exad-pricing-list-item-content-title">
                                <?php echo $list['exad_pricing_menu_title'] ?>
                            </a>
                            <p class="exad-pricing-list-item-content-description">
                                <?php echo $list['exad_pricing_menu_description'] ?>
                            </p>
                        </div>
                        <div class="exad-pricing-list-item-price">
                            <span>$14.5</span>
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