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

	protected function _register_controls() {
		/**
  		 * Google Map General Settings
  		 */
  		$this->start_controls_section(
  			'exad_section_google_map_settings',
  			[
  				'label' => esc_html__( 'General Settings', 'exclusive-addons-elementor' )
  			]
  		);
  		$this->add_control(
		  'exad_google_map_type',
		  	[
		   		'label'       	=> esc_html__( 'Google Map Type', 'exclusive-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'basic',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'basic'  	=> esc_html__( 'Basic', 'exclusive-addons-elementor' ),
		     		'marker'  	=> esc_html__( 'Multiple Marker', 'exclusive-addons-elementor' ),
		     		'static'  	=> esc_html__( 'Static', 'exclusive-addons-elementor' ),
		     		'polyline'  => esc_html__( 'Polyline', 'exclusive-addons-elementor' ),
		     		'polygon'  	=> esc_html__( 'Polygon', 'exclusive-addons-elementor' ),
		     		'overlay'  	=> esc_html__( 'Overlay', 'exclusive-addons-elementor' ),
		     		'routes'  	=> esc_html__( 'With Routes', 'exclusive-addons-elementor' ),
		     		'panorama'  => esc_html__( 'Panorama', 'exclusive-addons-elementor' ),
		     	]
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
				'default' => 'address',
				'condition' => [
					'exad_google_map_type' => ['basic']
				]
            ]
        );
         $this->add_control(
			'exad_google_map_addr',
			[
				'label' => esc_html__( 'Geo Address', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Paris, France', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_google_map_address_type' => ['address'],
					'exad_google_map_type' => ['basic']
				]
			]
		);
		$this->add_control(
			'exad_google_map_lat',
			[
				'label' => esc_html__( 'Latitude', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '1.2925005', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_google_map_type!' => ['routes'],
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
				'default' => esc_html__( '103.8665551', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_google_map_type!' => ['routes'],
					'exad_google_map_address_type' => ['coordinates']
				]
			]
		);
		// Only for static
		$this->add_control(
			'exad_google_map_static_lat',
			[
				'label' => esc_html__( 'Latitude', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '1.2925005', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_google_map_type' => ['static'],
				]
			]
		);
		$this->add_control(
			'exad_google_map_static_lng',
			[
				'label' => esc_html__( 'Longitude', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '103.8665551', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_google_map_type' => ['static'],
				]
			]
		);
		$this->add_control(
			'exad_google_map_resolution_title',
			[
				'label' => __( 'Map Image Resolution', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'exad_google_map_type' => 'static'
				]
			]
		);
		$this->add_control(
			'exad_google_map_static_width',
			[
				'label' => esc_html__( 'Static Image Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 610
				],
				'range' => [
					'px' => [
						'max' => 1400,
					],
				],
				'condition' => [
					'exad_google_map_type' => 'static'
				]
			]
		);
		$this->add_control(
			'exad_google_map_static_height',
			[
				'label' => esc_html__( 'Static Image Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 300
				],
				'range' => [
					'px' => [
						'max' => 700,
					],
				],
				'condition' => [
					'exad_google_map_type' => 'static'
				]
			]
		);
		// Only for Overlay
		$this->add_control(
			'exad_google_map_overlay_lat',
			[
				'label' => esc_html__( 'Latitude', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '1.2925005', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_google_map_type' => ['overlay'],
				]
			]
		);
		$this->add_control(
			'exad_google_map_overlay_lng',
			[
				'label' => esc_html__( 'Longitude', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '103.8665551', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_google_map_type' => ['overlay'],
				]
			]
		);
		// Only for panorama
		$this->add_control(
			'exad_google_map_panorama_lat',
			[
				'label' => esc_html__( 'Latitude', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '1.2925005', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_google_map_type' => ['panorama'],
				]
			]
		);
		$this->add_control(
			'exad_google_map_panorama_lng',
			[
				'label' => esc_html__( 'Longitude', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '103.8665551', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_google_map_type' => ['panorama'],
				]
			]
		);
		$this->add_control(
			'exad_google_map_overlay_content',
			[
				'label' => esc_html__( 'Overlay Content', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => True,
				'default' => esc_html__( 'Add your content here', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_google_map_type' => 'overlay'
				]
			]
		);
  		$this->end_controls_section();
  		/**
  		 * Map Settings (With Marker only for Basic)
  		 */
  		$this->start_controls_section(
  			'exad_section_google_map_basic_marker_settings',
  			[
  				'label' => esc_html__( 'Map Marker Settings', 'exclusive-addons-elementor' ),
  				'condition' => [
  					'exad_google_map_type' => ['basic']
  				]
  			]
  		);
  		$this->add_control(
			'exad_google_map_basic_marker_title',
			[
				'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Google Map Title', 'exclusive-addons-elementor' )
			]
		);
		$this->add_control(
			'exad_google_map_basic_marker_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__( 'Google map content', 'exclusive-addons-elementor' )
			]
		);
		$this->add_control(
			'exad_google_map_basic_marker_icon_enable',
			[
				'label' => __( 'Custom Marker Icon', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'exclusive-addons-elementor' ),
				'label_off' => __( 'No', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
			]
		);
  		$this->add_control(
			'exad_google_map_basic_marker_icon',
			[
				'label' => esc_html__( 'Marker Icon', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					// 'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'exad_google_map_basic_marker_icon_enable' => 'yes'
				]
			]
		);
		$this->add_control(
			'exad_google_map_basic_marker_icon_width',
			[
				'label' => esc_html__( 'Marker Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 32
				],
				'range' => [
					'px' => [
						'max' => 150,
					],
				],
				'condition' => [
					'exad_google_map_basic_marker_icon_enable' => 'yes'
				]
			]
		);
		$this->add_control(
			'exad_google_map_basic_marker_icon_height',
			[
				'label' => esc_html__( 'Marker Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 32
				],
				'range' => [
					'px' => [
						'max' => 150,
					],
				],
				'condition' => [
					'exad_google_map_basic_marker_icon_enable' => 'yes'
				]
			]
		);
		$this->end_controls_section();
  		/**
  		 * Map Settings (With Marker)
  		 */
  		$this->start_controls_section(
  			'exad_section_google_map_marker_settings',
  			[
  				'label' => esc_html__( 'Map Marker Settings', 'exclusive-addons-elementor' ),
  				'condition' => [
  					'exad_google_map_type' => ['marker', 'polyline', 'routes', 'static']
  				]
  			]
  		);
		$this->add_control(
			'exad_google_map_markers',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'exad_google_map_marker_title' => esc_html__( 'Map Marker 1', 'exclusive-addons-elementor' ) ],
				],
				'fields' => [
					[
						'name' => 'exad_google_map_marker_lat',
						'label' => esc_html__( 'Latitude', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( '1.2925005', 'exclusive-addons-elementor' ),
					],
					[
						'name' => 'exad_google_map_marker_lng',
						'label' => esc_html__( 'Longitude', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( '103.8665551', 'exclusive-addons-elementor' ),
					],
					[
						'name' => 'exad_google_map_marker_title',
						'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( 'Marker Title', 'exclusive-addons-elementor' ),
					],
					[
						'name' => 'exad_google_map_marker_content',
						'label' => esc_html__( 'Content', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::TEXTAREA,
						'label_block' => true,
						'default' => esc_html__( 'Marker Content. You can put html here.', 'exclusive-addons-elementor' ),
					],
					[
						'name' => 'exad_google_map_marker_icon_color',
						'label' => esc_html__( 'Default Icon Color', 'exclusive-addons-elementor' ),
						'description' => esc_html__( '(Works only on Static mode)', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#e23a47',
					],
					[
						'name' => 'exad_google_map_marker_icon_enable',
						'label' => __( 'Use Custom Icon', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'no',
						'label_on' => __( 'Yes', 'exclusive-addons-elementor' ),
						'label_off' => __( 'No', 'exclusive-addons-elementor' ),
						'return_value' => 'yes',
					],
					[
						'name' => 'exad_google_map_marker_icon',
						'label' => esc_html__( 'Custom Icon', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							// 'url' => Utils::get_placeholder_image_src(),
						],
						'condition' => [
							'exad_google_map_marker_icon_enable' => 'yes'
						]
					],
					[
						'name' => 'exad_google_map_marker_icon_width',
						'label' => esc_html__( 'Icon Width', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::NUMBER,
						'default' => esc_html__( '32', 'exclusive-addons-elementor' ),
						'condition' => [
							'exad_google_map_marker_icon_enable' => 'yes'
						]
					],
					[
						'name' => 'exad_google_map_marker_icon_height',
						'label' => esc_html__( 'Icon Height', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::NUMBER,
						'default' => esc_html__( '32', 'exclusive-addons-elementor' ),
						'condition' => [
							'exad_google_map_marker_icon_enable' => 'yes'
						]
					]
				],
				'title_field' => '{{exad_google_map_marker_title}}',
			]
		);
		$this->end_controls_section();


  		/**
  		 * Polyline Coordinates Settings (Polyline)
  		 */
  		$this->start_controls_section(
  			'exad_section_google_map_polyline_settings',
  			[
  				'label' => esc_html__( 'Coordinate Settings', 'exclusive-addons-elementor' ),
  				'condition' => [
  					'exad_google_map_type' => ['polyline', 'polygon']
  				]
  			]
  		);
		$this->add_control(
			'exad_google_map_polylines',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'exad_google_map_polyline_title' => esc_html__( '#1', 'exclusive-addons-elementor' ) ],
				],
				'fields' => [
					[
						'name' => 'exad_google_map_polyline_title',
						'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( '#', 'exclusive-addons-elementor' ),
					],
					[
						'name' => 'exad_google_map_polyline_lat',
						'label' => esc_html__( 'Latitude', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( '1.2925005', 'exclusive-addons-elementor' ),
					],
					[
						'name' => 'exad_google_map_polyline_lng',
						'label' => esc_html__( 'Longitude', 'exclusive-addons-elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => esc_html__( '103.8665551', 'exclusive-addons-elementor' ),
					],
				],
				'title_field' => '{{exad_google_map_polyline_title}}',
			]
		);
  		$this->end_controls_section();

  		/**
  		 * Routes Coordinates Settings (Routes)
  		 */
  		$this->start_controls_section(
  			'exad_section_google_map_routes_settings',
  			[
  				'label' => esc_html__( 'Routes Coordinate Settings', 'exclusive-addons-elementor' ),
  				'condition' => [
  					'exad_google_map_type' => ['routes']
  				]
  			]
  		);
  		$this->add_control(
			'exad_google_map_routes_origin',
			[
				'label' => esc_html__( 'Origin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
  		$this->add_control(
			'exad_google_map_routes_origin_lat',
			[
				'label' => esc_html__( 'Latitude', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '1.2925005', 'exclusive-addons-elementor' ),
			]
		);
		$this->add_control(
			'exad_google_map_routes_origin_lng',
			[
				'label' => esc_html__( 'Longitude', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '103.8665551', 'exclusive-addons-elementor' ),
			]
		);
		$this->add_control(
			'exad_google_map_routes_dest',
			[
				'label' => esc_html__( 'Destination', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
  		$this->add_control(
			'exad_google_map_routes_dest_lat',
			[
				'label' => esc_html__( 'Latitude', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '1.2833808', 'exclusive-addons-elementor' ),
			]
		);
		$this->add_control(
			'exad_google_map_routes_dest_lng',
			[
				'label' => esc_html__( 'Longitude', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '103.8585377', 'exclusive-addons-elementor' ),
			]
		);
		$this->add_control(
		  	'exad_google_map_routes_travel_mode',
		  	[
		   		'label'       	=> esc_html__( 'Travel Mode', 'exclusive-addons-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'walking',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'walking'  	=> esc_html__( 'Walking', 'exclusive-addons-elementor' ),
		     		'bicycling' => esc_html__( 'Bicycling', 'exclusive-addons-elementor' ),
		     		'driving' 	=> esc_html__( 'Driving', 'exclusive-addons-elementor' ),
		     	]
		  	]
		);
  		$this->end_controls_section();

		$this->start_controls_section(
			'section_map_controls',
			[
				'label'	=> esc_html__( 'Map Controls', 'exclusive-addons-elementor' )
			]
		);
		$this->add_control(
			'exad_google_map_zoom',
			[
				'label' => esc_html__( 'Zoom Level', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'label_block' => false,
				'default' => esc_html__( '14', 'exclusive-addons-elementor' ),
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
		$this->end_controls_section();
		  
		/**
  		 * Map Theme Settings
  		 */
  		$this->start_controls_section(
			'exad_section_google_map_theme_settings',
			[
				'label'		=> esc_html__( 'Map Theme', 'exclusive-addons-elementor' ),
				'condition' => [
					'exad_google_map_type!'	=> ['static', 'panorama']
				]
			]
		);
		$this->add_control(
            'exad_google_map_theme_source',
            [
                'label'		=> __( 'Theme Source', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::CHOOSE,
                'options' => [
					'gstandard' => [
						'title' => __( 'Google Standard', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-map',
					],
					'snazzymaps' => [
						'title' => __( 'Snazzy Maps', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-map-marker',
					],
					'custom' => [
						'title' => __( 'Custom', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-edit',
					],
				],
				'default'	=> 'gstandard'
            ]
		);
		$this->add_control(
			'exad_google_map_gstandards',
			[
				'label'                 => esc_html__( 'Google Themes', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'standard',
				'options'               => [
					'standard'     => __( 'Standard', 'exclusive-addons-elementor' ),
					'silver'       => __( 'Silver', 'exclusive-addons-elementor' ),
					'retro'        => __( 'Retro', 'exclusive-addons-elementor' ),
					'dark'         => __( 'Dark', 'exclusive-addons-elementor' ),
					'night'        => __( 'Night', 'exclusive-addons-elementor' ),
					'aubergine'    => __( 'Aubergine', 'exclusive-addons-elementor' )
				],
				'description'           => sprintf( '<a href="https://mapstyle.withgoogle.com/" target="_blank">%1$s</a> %2$s',__( 'Click here', 'exclusive-addons-elementor' ), __( 'to generate your own theme and use JSON within Custom style field.', 'exclusive-addons-elementor' ) ),
				'condition'	=> [
					'exad_google_map_theme_source'	=> 'gstandard'
				]
			]
		);
		$this->add_control(
			'exad_google_map_snazzymaps',
			[
				'label'                 => esc_html__( 'SnazzyMaps Themes', 'exclusive-addons-elementor' ),
				'type'                  => Controls_Manager::SELECT,
				'label_block'			=> true,
				'default'               => 'colorful',
				'options'               => [
					'default'		=> __( 'Default', 'exclusive-addons-elementor' ),
					'simple'		=> __( 'Simple', 'exclusive-addons-elementor' ),
					'colorful'		=> __( 'Colorful', 'exclusive-addons-elementor' ),
					'complex'		=> __( 'Complex', 'exclusive-addons-elementor' ),
					'dark'			=> __( 'Dark', 'exclusive-addons-elementor' ),
					'greyscale'		=> __( 'Greyscale', 'exclusive-addons-elementor' ),
					'light'			=> __( 'Light', 'exclusive-addons-elementor' ),
					'monochrome'	=> __( 'Monochrome', 'exclusive-addons-elementor' ),
					'nolabels'		=> __( 'No Labels', 'exclusive-addons-elementor' ),
					'twotone'		=> __( 'Two Tone', 'exclusive-addons-elementor' )
				],
				'description'           => sprintf( '<a href="https://snazzymaps.com/explore" target="_blank">%1$s</a> %2$s',__( 'Click here', 'exclusive-addons-elementor' ), __( 'to explore more themes and use JSON within custom style field.', 'exclusive-addons-elementor' ) ),
				'condition'	=> [
					'exad_google_map_theme_source'	=> 'snazzymaps'
				]
			]
		);
		$this->add_control(
			'exad_google_map_custom_style',
			[
				'label'                 => __( 'Custom Style', 'exclusive-addons-elementor' ),
				'description'           => sprintf( '<a href="https://mapstyle.withgoogle.com/" target="_blank">%1$s</a> %2$s',__( 'Click here', 'exclusive-addons-elementor' ), __( 'to get JSON style code to style your map', 'exclusive-addons-elementor' ) ),
				'type'                  => Controls_Manager::TEXTAREA,
                'condition'             => [
                    'exad_google_map_theme_source'     => 'custom',
                ],
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
				'label' => esc_html__( 'General Style', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'exad_google_map_max_width',
			[
				'label' => __( 'Max Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .exad-google-map' => 'max-width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'exad_google_map_max_height',
			[
				'label' => __( 'Max Height', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 400,
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
					'{{WRAPPER}} .exad-google-map' => 'height: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'exad_google_map_margin',
			[
				'label' => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .exad-google-map' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

  		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style Google Map Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_google_map_overlay_style_settings',
			[
				'label' => esc_html__( 'Overlay Style', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_google_map_type' => ['overlay']
				]
			]
		);
		$this->add_responsive_control(
			'exad_google_map_overlay_width',
			[
				'label' => __( 'Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 200,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1100,
						'step' => 10,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .exad-gmap-overlay' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'exad_google_map_overlay_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .exad-gmap-overlay' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'exad_google_mapoverlay_padding',
			[
				'label' => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .exad-gmap-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_responsive_control(
			'exad_google_map_overlay_margin',
			[
				'label' => esc_html__( 'Margin', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .exad-gmap-overlay' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'exad_google_map_overlay_border',
				'label' => esc_html__( 'Border', 'exclusive-addons-elementor' ),
				'selector' => '{{WRAPPER}} .exad-gmap-overlay',
			]
		);
		$this->add_responsive_control(
			'exad_google_map_overlay_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .exad-gmap-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'exad_google_map_overlay_box_shadow',
				'selector' => '{{WRAPPER}} .exad-gmap-overlay',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            	'name' => 'exad_google_map_overlay_typography',
				'selector' => '{{WRAPPER}} .exad-gmap-overlay',
			]
		);
		$this->add_control(
			'exad_google_map_overlay_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .exad-gmap-overlay' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Google Map Stroke Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'exad_section_google_map_stroke_style_settings',
			[
				'label' => esc_html__( 'Stroke Style', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_google_map_type' => ['polyline', 'polygon', 'routes']
				]
			]
		);
		$this->add_control(
			'exad_google_map_stroke_color',
			[
				'label' => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e23a47',
			]
		);
		$this->add_responsive_control(
			'exad_google_map_stroke_opacity',
			[
				'label' => __( 'Opacity', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.8,
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0.2,
						'max' => 1,
						'step' => 0.1,
					]
				],
			]
		);
		$this->add_responsive_control(
			'exad_google_map_stroke_weight',
			[
				'label' => __( 'Weight', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 4,
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
						'step' => 1,
					]
				],
			]
		);
		$this->add_control(
			'exad_google_map_stroke_fill_color',
			[
				'label' => esc_html__( 'Fill Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e23a47',
				'condition' => [
					'exad_google_map_type' => ['polygon']
				]
			]
		);
		$this->add_responsive_control(
			'exad_google_map_stroke_fill_opacity',
			[
				'label' => __( 'Fill Opacity', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.4,
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0.2,
						'max' => 1,
						'step' => 0.1,
					]
				],
				'condition' => [
					'exad_google_map_type' => ['polygon']
				]
			]
		);
		$this->end_controls_section();
	}

	protected function exad_get_map_theme($settings) {

		if($settings['exad_google_map_theme_source'] == 'custom') {
			return strip_tags($settings['exad_google_map_custom_style']);
		}else {
			$themes = include('advance-gmap-themes.php');
			if(isset($themes[$settings['exad_google_map_theme_source']][$settings['exad_google_map_gstandards']])) {
				return $themes[$settings['exad_google_map_theme_source']][$settings['exad_google_map_gstandards']];
			}elseif(isset($themes[$settings['exad_google_map_theme_source']][$settings['exad_google_map_snazzymaps']])) {
				return $themes[$settings['exad_google_map_theme_source']][$settings['exad_google_map_snazzymaps']];
			}else {
				return '';
			}
		}

	}

	protected function map_render_data_attributes( $settings ) {
		return [
			'data-map_type'				=> esc_attr($settings['exad_google_map_type']),
			'data-map_address_type'		=> esc_attr($settings['exad_google_map_address_type']),
			'data-map_lat'				=> esc_attr($settings['exad_google_map_lat']),
			'data-map_lng'				=> esc_attr($settings['exad_google_map_lng']),
			'data-map_addr'				=> esc_attr($settings['exad_google_map_addr']),
			'data-map_basic_marker_title'		=> esc_attr($settings['exad_google_map_basic_marker_title']),
			'data-map_basic_marker_content'		=> esc_attr($settings['exad_google_map_basic_marker_content']),
			'data-map_basic_marker_icon_enable'	=> esc_attr($settings['exad_google_map_basic_marker_icon_enable']),
			'data-map_basic_marker_icon'		=> esc_attr($settings['exad_google_map_basic_marker_icon']['url']),
			'data-map_basic_marker_icon_width'	=> esc_attr($settings['exad_google_map_basic_marker_icon_width']['size']),
			'data-map_basic_marker_icon_height'	=> esc_attr($settings['exad_google_map_basic_marker_icon_height']['size']),
			'data-map_marker_content'	=> isset($settings['exad_google_map_marker_content']) ? esc_attr($settings['exad_google_map_marker_content']) : '',
			'data-map_markers'				=> urlencode(json_encode($settings['exad_google_map_markers'])),
			'data-map_static_width'			=> esc_attr($settings['exad_google_map_static_width']['size']),
			'data-map_static_height'		=> esc_attr($settings['exad_google_map_static_height']['size']),
			'data-map_static_lat'			=> esc_attr($settings['exad_google_map_static_lat']),
			'data-map_static_lng'			=> esc_attr($settings['exad_google_map_static_lng']),
			'data-map_polylines'			=> urlencode(json_encode($settings['exad_google_map_polylines'])),
			'data-map_stroke_color'			=> esc_attr($settings['exad_google_map_stroke_color']),
			'data-map_stroke_opacity'		=> esc_attr($settings['exad_google_map_stroke_opacity']['size']),
			'data-map_stroke_weight'		=> esc_attr($settings['exad_google_map_stroke_weight']['size']),
			'data-map_stroke_fill_color'	=> esc_attr($settings['exad_google_map_stroke_fill_color']),
			'data-map_stroke_fill_opacity'	=> esc_attr($settings['exad_google_map_stroke_fill_opacity']['size']),
			'data-map_overlay_content'		=> esc_attr($settings['exad_google_map_overlay_content']),
			'data-map_routes_origin_lat'	=> esc_attr($settings['exad_google_map_routes_origin_lat']),
			'data-map_routes_origin_lng'	=> esc_attr($settings['exad_google_map_routes_origin_lng']),
			'data-map_routes_dest_lat'		=> esc_attr($settings['exad_google_map_routes_dest_lat']),
			'data-map_routes_dest_lng'		=> esc_attr($settings['exad_google_map_routes_dest_lng']),
			'data-map_routes_travel_mode'	=> esc_attr($settings['exad_google_map_routes_travel_mode']),
			'data-map_panorama_lat'			=> esc_attr($settings['exad_google_map_panorama_lat']),
			'data-map_panorama_lng'			=> esc_attr($settings['exad_google_map_panorama_lng']),
			'data-map_theme'				=> urlencode(json_encode($this->exad_get_map_theme($settings))),
			'data-map_streeview_control'	=> ($settings['exad_map_streeview_control'] ? 'true': 'false'),
			'data-map_type_control'			=> ($settings['exad_map_type_control'] ? 'true': 'false'),
			'data-map_zoom_control'			=> ($settings['exad_map_zoom_control'] ? 'true': 'false'),
			'data-map_fullscreen_control'	=> ($settings['exad_map_fullscreen_control'] ? 'true': 'false'),
			'data-map_scroll_zoom'			=> ($settings['exad_map_scroll_zoom'] ? 'true': 'false')
		];
	}

	protected function get_map_render_data_attribute_string($settings) {

		$data_attributes = $this->map_render_data_attributes($settings);
		$data_string = '';

		foreach( $data_attributes as $key => $value ) {
			if( isset($key) && ! empty($value)) {
				$data_string .= ' '.$key.'="'.$value.'"';
			}
		}

		return $data_string;
	}


	protected function render() {

		$settings = $this->get_settings_for_display();
		
		$this->add_render_attribute( 'exad_google_map_wrapper', [
			'class' => ['exad-google-maps'],
			'id'	=> 'exad-google-maps-'.esc_attr($this->get_id()),
			'data-id'	=> esc_attr($this->get_id()),
			'data-exad-address'	=> esc_attr($settings['exad_google_map_addr']),
			'data-exad-lat' => esc_attr( $settings['exad_google_map_lat'] ),
			'data-exad-lng' => esc_attr( $settings['exad_google_map_lng'] ),
			'data-exad-icon' => EXAD_URL . 'assets/img/pin-3.png',
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

	protected function content_template() {}
}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Google_Map() );