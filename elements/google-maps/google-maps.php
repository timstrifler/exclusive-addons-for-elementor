<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Google_Map extends Widget_Base {

	public function get_name() {
		return 'exad-google-maps';
	}

	public function get_title() {
		return esc_html__( 'Ex Google Maps', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-google-maps';
	}

   	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_script_depends() {
		return [ 'exad-google-map-api', 'exad-gmap3' ];
	}

	protected function _register_controls() {
		/**
  		 * Google Map General Settings
  		 */
  		$this->start_controls_section(
  			'exad_section_google_map_settings',
  			[
  				'label' => esc_html__( 'Map Settings', 'exclusive-addons-elementor' )
  			]
		);
		 
		$admin_link = admin_url( 'admin.php?page=exad-settings' );
		$this->add_control(
			'exad_map_api_key',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf( __( 'To display Google Map without an issue, you need to configure Google Map API key. Please configure API key from the "API KEYS" tab <a href="%s" target="_blank" rel="noopener">here</a>.', 'exclusive-addons-elementor' ), $admin_link ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);
  		
		$this->add_control(
            'exad_google_map_address_type',
            [
                'label' => __( 'Address Type', 'exclusive-addons-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
					'address' => [
						'title' => __( 'Address', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-map',
					],
					'coordinates' => [
						'title' => __( 'Coordinates', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-map-marker',
					],
				],
				'default' => 'coordinates',
            ]
		);

        $this->add_control(
			'exad_google_map_addr',
			[
				'label' => __( 'Geo Address', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'Paris, France', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_google_map_address_type' => ['address'],
				]
			]
		);
		$this->add_control(
			'exad_google_map_lat',
			[
				'label' => esc_html__( 'Latitude', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '51.4934', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_google_map_address_type' => ['coordinates']
				]
			]
		);
		$this->add_control(
			'exad_google_map_lng',
			[
				'label' => esc_html__( 'Longitude', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '0.0098', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_google_map_address_type' => ['coordinates']
				]
			]
		);

		$this->add_control(
			'exad_google_map_zoom',
			[
				'label' => esc_html__( 'Zoom Level', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'label_block' => false,
				'separator' => 'before',
				'default' => esc_html__( '14', 'exclusive-addons-elementor' ),
			]
		);
		$this->add_control(
			'exad_map_scroll_zoom',
			[
				'label'                 => esc_html__( 'Scroll Wheel Zoom', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'             => __( 'Off', 'exclusive-addons-elementor' ),
                'return_value'          => 'yes',
			]
		);
		$this->add_control(
			'exad_map_zoom_control',
			[
				'label'                 => esc_html__( 'Zoom Control', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'             => __( 'Off', 'exclusive-addons-elementor' ),
                'return_value'          => 'yes',
			]
		);
		$this->add_control(
			'exad_map_fullscreen_control',
			[
				'label'                 => esc_html__( 'Fullscreen Control', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'             => __( 'Off', 'exclusive-addons-elementor' ),
                'return_value'          => 'yes',
			]
		);
		$this->add_control(
			'exad_map_streeview_control',
			[
				'label'                 => esc_html__( 'Street View Controls', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'true',
                'label_on'              => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'             => __( 'Off', 'exclusive-addons-elementor' ),
                'return_value'          => 'true',
			]
		);
		$this->add_control(
			'exad_map_type_control',
			[
				'label'                 => esc_html__( 'Map Type Control', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __( 'On', 'exclusive-addons-elementor' ),
                'label_off'             => __( 'Off', 'exclusive-addons-elementor' ),
                'return_value'          => 'yes',
			]
		);
		
  		$this->end_controls_section();
  		
		
  		/**
		 * -------------------------------------------
		 * Tab Style Google Map Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_google_map_style_settings',
			[
				'label' => esc_html__( 'General Styles', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'exad_google_map_themes',
			[
				'label'         => esc_html__( 'Map Preset', 'exclusive-addons-elementor' ),
				'type'          => Controls_Manager::SELECT,
				'description'   => __( 'Default Map Themes from Google', 'exclusive-addons-elementor' ),     
 				'default'       => 'standard',
				'options'       => [
					'standard'     => __( 'Standard', 'exclusive-addons-elementor' ),
					'silver'       => __( 'Silver', 'exclusive-addons-elementor' ),
					'retro'        => __( 'Retro', 'exclusive-addons-elementor' ),
					'dark'         => __( 'Dark', 'exclusive-addons-elementor' ),
					'night'        => __( 'Night', 'exclusive-addons-elementor' ),
					'aubergine'    => __( 'Aubergine', 'exclusive-addons-elementor' ),
				]
			]
		);

		$this->add_control(
			'exad_google_map_max_width',
			[
				'label' => __( 'Max Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'separator' => 'before',
				'default' => [
					'size' => 1140,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1400,
						'step' => 10,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .exad-google-maps' => 'max-width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'exad_google_map_max_height',
			[
				'label' => __( 'Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 450,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1400,
						'step' => 10,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .exad-google-maps' => 'height: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		
		$this->add_render_attribute( 'exad_google_map_wrapper', [
			'class' => ['exad-google-maps'],
			'id'	=> 'exad-google-maps-'.esc_attr($this->get_id()),
			'data-exad-address-type' => esc_attr($settings['exad_google_map_address_type']),
			'data-exad-theme' => esc_attr( $settings['exad_google_map_themes']),
			'data-exad-address'	=> esc_attr($settings['exad_google_map_addr']),
			'data-exad-lat' => esc_attr( $settings['exad_google_map_lat'] ),
			'data-exad-lng' => esc_attr( $settings['exad_google_map_lng'] ),
			'data-exad-zoom' => esc_attr($settings['exad_google_map_zoom']),
			'data-exad-streeview-control'	=> ($settings['exad_map_streeview_control'] ? 'true': 'false'),
			'data-exad-type-control'	=> ($settings['exad_map_type_control'] ? 'true': 'false'),
			'data-exad-zoom-control'	=> ($settings['exad_map_zoom_control'] ? 'true': 'false'),
			'data-exad-fullscreen-control'	=> ($settings['exad_map_fullscreen_control'] ? 'true': 'false'),
			'data-exad-scroll-zoom'	=> ($settings['exad_map_scroll_zoom'] ? 'true': 'false')
		]);
	?>

		<div <?php echo $this->get_render_attribute_string('exad_google_map_wrapper'); ?>>
		</div>

	<?php
	}

	protected function _content_template() {
		?>

		<div class="exad-google-maps" data-exad-address-type="{{ settings.exad_google_map_address_type }}" data-exad-theme="{{ settings.exad_google_map_themes }}" 
		data-exad-address="{{ settings.exad_google_map_addr }}" data-exad-lat="{{ settings.exad_google_map_lat }}" data-exad-lng="{{ settings.exad_google_map_lng }}" 
		data-exad-zoom="{{ settings.exad_google_map_zoom }}" data-exad-streeview-control="{{ settings.exad_map_streeview_control }}" 
		data-exad-type-control="{{ settings.exad_map_type_control }}" data-exad-zoom-control="{{ settings.exad_map_zoom_control }}" 
		data-exad-zoom-control="{{ settings.exad_map_zoom_control }}" data-exad-fullscreen-control="{{ settings.exad_map_fullscreen_control }}"
		data-exad-scroll-zoom="{{ settings.exad_map_scroll_zoom }}">
		</div>

	<?php	
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Google_Map() );