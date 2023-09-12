<?php
namespace ExclusiveAddons\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WPML Compatibility Elementor Elements.
 *
 * @package     Exclusive Addons
 * @author      DevsCred.com
 * @link        https://exclusiveaddons.com/
 * @since       1.4.4
 */

class Exad_WPML_Element_Free_Compatibility {

    /**
	 * A reference to an instance of this class.
	 * @since 1.4.4
	 * @var   object
	 */
	private static $instance = null;

	/**
	 * Constructor for the class
	 */
	public function init() {

		// WPML String Translation plugin exist check
		if ( defined( 'WPML_ST_VERSION' ) ) {

			if ( class_exists( 'WPML_Elementor_Module_With_Items' ) ) {
				$this->load_wpml_free_widgets();
			}

			add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'exad_add_translatable_free_widgets' ] );
		}

	}

    /**
	 * Load wpml required repeater class files.
	 * @return void
	 */
	public function load_wpml_free_widgets() {
		require_once( EXAD_PATH . 'includes/multilang-compatibility/wpml/class-wpml-accordion.php' );
		require_once( EXAD_PATH . 'includes/multilang-compatibility/wpml/class-wpml-filterable-gallery.php' );
		require_once( EXAD_PATH . 'includes/multilang-compatibility/wpml/class-wpml-modal-popup.php' );
		require_once( EXAD_PATH . 'includes/multilang-compatibility/wpml/class-wpml-list-group.php' );
		require_once( EXAD_PATH . 'includes/multilang-compatibility/wpml/class-wpml-news-ticker.php' );
		require_once( EXAD_PATH . 'includes/multilang-compatibility/wpml/class-wpml-pricing-menu.php' );
		require_once( EXAD_PATH . 'includes/multilang-compatibility/wpml/class-wpml-pricing-table.php' );
		require_once( EXAD_PATH . 'includes/multilang-compatibility/wpml/class-wpml-tabs.php' );
	
    }

    /**
	 * Add element translation widgets
	 * @param array $widgets
	 * @return array
	 */
	public function exad_add_translatable_free_widgets( $widgets ) {

		$widgets[ 'exad-exclusive-alert' ] = [
			'conditions' => [ 'widgetType' => 'exad-exclusive-alert' ],
			'fields'     => [
				[
					'field'       => 'exad_alert_content_title',
					'type'        => esc_html__( 'Title', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				],	
				[
					'field'       => 'exad_alert_content_description',
					'type'        => esc_html__( 'Description', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				],	
				[
					'field'       => 'exad_alert_close_primary_button',
					'type'        => esc_html__( 'Primary Button', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_alert_close_secondary_button',
					'type'        => esc_html__( 'Secondary Button', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	

        
		$widgets[ 'exad-animated-text' ] = [
			'conditions' => [ 'widgetType' => 'exad-animated-text' ],
			'fields'     => [
				[
					'field'       => 'exad_animated_text_before_text',
					'type'        => esc_html__( 'Before Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				],
				[
					'field'       => 'exad_animated_text_animated_heading',
					'type'        => esc_html__( 'Animated Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				],	
                [
					'field'       => 'exad_animated_text_after_text',
					'type'        => esc_html__( 'After Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				],
			],
		];	

        $widgets[ 'exad-exclusive-button' ] = [
			'conditions' => [ 'widgetType' => 'exad-exclusive-button' ],
			'fields'     => [
				[
					'field'       => 'exclusive_button_text',
					'type'        => esc_html__( 'Button Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	  

        $widgets[ 'exad-call-to-action' ] = [
			'conditions' => [ 'widgetType' => 'exad-call-to-action' ],
			'fields'     => [
				[
					'field'       => 'exad_cta_heading',
					'type'        => esc_html__( 'Heading', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_cta_primary_btn',
					'type'        => esc_html__( 'Button Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_cta_secondary_btn',
					'type'        => esc_html__( 'Button Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	

        $widgets[ 'exad-exclusive-card' ] = [
			'conditions' => [ 'widgetType' => 'exad-exclusive-card' ],
			'fields'     => [
				[
					'field'       => 'exad_card_badge',
					'type'        => esc_html__( 'Badge Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],	
                [
					'field'       => 'exad_card_title',
					'type'        => esc_html__( 'Title', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],   
                [
					'field'       => 'exad_card_tag',
					'type'        => esc_html__( 'Tag', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],    
                [
					'field'       => 'exad_card_description',
					'type'        => esc_html__( 'Description', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				],    
                [
					'field'       => 'exad_card_action_text',
					'type'        => esc_html__( 'Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	  

        $widgets[ 'exad-contact-form-7' ] = [
			'conditions' => [ 'widgetType' => 'exad-contact-form-7' ],
			'fields'     => [
				[
					'field'       => 'exad_contact_form_title_text',
					'type'        => esc_html__( 'Title', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	 

        $widgets[ 'exad-countdown-timer' ] = [
			'conditions' => [ 'widgetType' => 'exad-countdown-timer' ],
			'fields'     => [
				[
					'field'       => 'exad_countdown_expired_text',
					'type'        => esc_html__( 'Countdown Expired Title', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	  

        $widgets[ 'exad-covid-19' ] = [
			'conditions' => [ 'widgetType' => 'exad-covid-19' ],
			'fields'     => [
				[
					'field'       => 'exad_corona_update_text',
					'type'        => esc_html__( 'Updated Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_corona_enable_search_filter_text',
					'type'        => esc_html__( 'Search Filter Placeholder Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	   

        $widgets[ 'exad-dual-button' ] = [
			'conditions' => [ 'widgetType' => 'exad-dual-button' ],
			'fields'     => [
				[
					'field'       => 'exad_dual_button_primary_button_text',
					'type'        => esc_html__( 'Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_dual_button_connector_text',
					'type'        => esc_html__( 'Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				], 
                [
					'field'       => 'exad_dual_button_secondary_button_text',
					'type'        => esc_html__( 'Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	  

        $widgets[ 'exad-exclusive-dual-heading' ] = [
			'conditions' => [ 'widgetType' => 'exad-exclusive-dual-heading' ],
			'fields'     => [
				[
					'field'       => 'exad_dual_first_heading',
					'type'        => esc_html__( 'First Heading', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_dual_second_heading',
					'type'        => esc_html__( 'Second Heading', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				], 
                [
					'field'       => 'exad_dual_heading_description',
					'type'        => esc_html__( 'Sub Heading', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				],
			],
		];	

        $widgets[ 'exad-facebook-feed' ] = [
			'conditions' => [ 'widgetType' => 'exad-facebook-feed' ],
			'fields'     => [
				[
					'field'       => 'exad_facebook_page_id',
					'type'        => esc_html__( 'Page ID', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_facebook_access_token',
					'type'        => esc_html__( 'Access Token', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],  
                [
					'field'       => 'read_more_text',
					'type'        => esc_html__( 'Read More Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				], 
                [
					'field'       => 'load_more_text',
					'type'        => esc_html__( 'Load More Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	  

        $widgets[ 'exad-filterable-post' ] = [
			'conditions' => [ 'widgetType' => 'exad-filterable-post' ],
			'fields'     => [
				[
					'field'       => 'exad_post_grid_read_more_btn_text',
					'type'        => esc_html__( 'Button Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_post_grid_all_item_text',
					'type'        => esc_html__( 'Text for All Item', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],  
                [
					'field'       => 'exad_post_grid_user_name_tag',
					'type'        => esc_html__( 'Author Name Tag', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				], 
                [
					'field'       => 'exad_post_grid_date_tag',
					'type'        => esc_html__( 'Date Tag', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	 

        $widgets[ 'exad-flipbox' ] = [
			'conditions' => [ 'widgetType' => 'exad-flipbox' ],
			'fields'     => [
				[
					'field'       => 'exad_flipbox_front_title',
					'type'        => esc_html__( 'Title', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_flipbox_front_description',
					'type'        => esc_html__( 'Description', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				],  
                [
					'field'       => 'exad_flipbox_back_title',
					'type'        => esc_html__( 'Title', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				], 
                [
					'field'       => 'exad_flipbox_back_description',
					'type'        => esc_html__( 'Description', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				], 
                [
					'field'       => 'exad_flipbox_button_text',
					'type'        => esc_html__( 'Button Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	  

        $widgets[ 'exad-google-maps' ] = [
			'conditions' => [ 'widgetType' => 'exad-google-maps' ],
			'fields'     => [
				[
					'field'       => 'exad_google_map_lat',
					'type'        => esc_html__( 'Latitude', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_google_map_lng',
					'type'        => esc_html__( 'Longitude', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				],
			],
		];	  

        $widgets[ 'exad-google-reviews' ] = [
			'conditions' => [ 'widgetType' => 'exad-google-reviews' ],
			'fields'     => [
				[
					'field'       => 'exad_google_place_id',
					'type'        => esc_html__( 'Place ID', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
				[
					'field'       => 'exad_google_review_language_custom',
					'type'        => esc_html__( 'Custom Language', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	    

        $widgets[ 'exad-exclusive-heading' ] = [
			'conditions' => [ 'widgetType' => 'exad-exclusive-heading' ],
			'fields'     => [
				[
					'field'       => 'exad_heading_title',
					'type'        => esc_html__( 'Heading', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_heading_subheading',
					'type'        => esc_html__( 'Sub Heading', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	  

        $widgets[ 'exad-image-comparison' ] = [
			'conditions' => [ 'widgetType' => 'exad-image-comparison' ],
			'fields'     => [
				[
					'field'       => 'exad_before_label',
					'type'        => esc_html__( 'Overlay Before Text(On Hover)', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_after_label',
					'type'        => esc_html__( 'Overlay After Text(On Hover)', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	    

        $widgets[ 'exad-image-comparison' ] = [
			'conditions' => [ 'widgetType' => 'exad-image-comparison' ],
			'fields'     => [
				[
					'field'       => 'exad_before_label',
					'type'        => esc_html__( 'Overlay Before Text(On Hover)', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_after_label',
					'type'        => esc_html__( 'Overlay After Text(On Hover)', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	  

        $widgets[ 'exad-infobox' ] = [
			'conditions' => [ 'widgetType' => 'exad-infobox' ],
			'fields'     => [
				[
					'field'       => 'exad_infobox_title',
					'type'        => esc_html__( 'Title', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_infobox_description',
					'type'        => esc_html__( 'Description', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				],
			],
		];	  

        $widgets[ 'exad-list-group' ] = [
			'conditions' => [ 'widgetType' => 'exad-list-group' ],
			'fields'     => [
				[
					'field'       => 'exad_list_icon_number',
					'type'        => esc_html__( 'Number', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_list_text',
					'type'        => esc_html__( 'Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	  

        $widgets[ 'exad-post-grid' ] = [
			'conditions' => [ 'widgetType' => 'exad-post-grid' ],
			'fields'     => [
				[
					'field'       => 'exad_post_grid_read_more_btn_text',
					'type'        => esc_html__( 'Button Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_post_grid_enable_load_more_btn_text',
					'type'        => esc_html__( 'Load More Button text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_post_grid_user_name_tag',
					'type'        => esc_html__( 'Author Name Tag', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				], 
                [
					'field'       => 'exad_post_grid_date_tag',
					'type'        => esc_html__( 'Date Tag', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	  

        $widgets[ 'exad-progress-bar' ] = [
			'conditions' => [ 'widgetType' => 'exad-progress-bar' ],
			'fields'     => [
				[
					'field'       => 'exad_progress_bar_title',
					'type'        => esc_html__( 'Title', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	  

        $widgets[ 'exad-testimonial' ] = [
			'conditions' => [ 'widgetType' => 'exad-testimonial' ],
			'fields'     => [
				[
					'field'       => 'exad_testimonial_description',
					'type'        => esc_html__( 'Testimonial', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				],
                [
					'field'       => 'exad_testimonial_name',
					'type'        => esc_html__( 'Name', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],   
                [
					'field'       => 'exad_testimonial_designation',
					'type'        => esc_html__( 'Designation', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	   

        $widgets[ 'exad-progress-bar' ] = [
			'conditions' => [ 'widgetType' => 'exad-progress-bar' ],
			'fields'     => [
				[
					'field'       => 'exad_progress_bar_title',
					'type'        => esc_html__( 'Title', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	  

        $widgets[ 'exad-team-member' ] = [
			'conditions' => [ 'widgetType' => 'exad-team-member' ],
			'fields'     => [
				[
					'field'       => 'exad_team_member_name',
					'type'        => esc_html__( 'Name', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_team_member_designation',
					'type'        => esc_html__( 'Designation', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_team_member_description',
					'type'        => esc_html__( 'Description', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				],
                [
					'field'       => 'exad_team_members_cta_btn_text',
					'type'        => esc_html__( 'Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
			],
		];	  

        $widgets[ 'exad-tooltip' ] = [
			'conditions' => [ 'widgetType' => 'exad-tooltip' ],
			'fields'     => [
				[
					'field'       => 'exad_tooltip_content',
					'type'        => esc_html__( 'Content', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				],
                [
					'field'       => 'exad_tooltip_text',
					'type'        => esc_html__( 'Tooltip Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				],
			],
		];	  

        //Widgets Where use Repeater Controller

        $widgets[ 'exad-exclusive-accordion' ] = [
            'conditions' => [ 'widgetType' => 'exad-exclusive-accordion' ],
            'fields'     => [],
            'integration-class' => 'WPML_Exad_Accordion',
        ];

        $widgets[ 'exad-filterable-gallery' ] = [
            'conditions' => [ 'widgetType' => 'exad-filterable-gallery' ],
            'fields'     => [
                [
					'field'       => 'exad_fg_all_items_text',
					'type'        => esc_html__( 'Text for All Item', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
            ],
            'integration-class' => 'WPML_Exad_Filterable_Gallery',
        ];

        $widgets[ 'exad-modal-popup' ] = [
            'conditions' => [ 'widgetType' => 'exad-modal-popup' ],
            'fields'     => [
                [
					'field'       => 'exad_modal_youtube_video_url',
					'type'        => esc_html__( 'Provide Youtube Video URL', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],  
                [
					'field'       => 'exad_modal_vimeo_video_url',
					'type'        => esc_html__( 'Provide Vimeo Video URL', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				], 
                [
					'field'       => 'exad_modal_external_page_url',
					'type'        => esc_html__( 'Provide External URL', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],  
                [
					'field'       => 'exad_modal_shortcode',
					'type'        => esc_html__( 'Enter your shortcode', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				], 
                [
					'field'       => 'exad_modal_btn_text',
					'type'        => esc_html__( 'Button Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
            ],
            'integration-class' => 'WPML_Exad_Modal_Popup',
        ];

        $widgets[ 'exad-list-group' ] = [
            'conditions' => [ 'widgetType' => 'exad-list-group' ],
            'fields'     => [],
            'integration-class' => 'WPML_Exad_List_group',
        ];

        $widgets[ 'exad-news-ticker' ] = [
            'conditions' => [ 'widgetType' => 'exad-news-ticker' ],
            'fields'     => [
                [
					'field'       => 'exad_news_ticker_label',
					'type'        => esc_html__( 'Label', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
            ],
            'integration-class' => 'WPML_Exad_News_Ticker',
        ];

        $widgets[ 'exad-pricing-menu' ] = [
            'conditions' => [ 'widgetType' => 'exad-pricing-menu' ],
            'fields'     => [],
            'integration-class' => 'WPML_Exad_Pricing_Menu',
        ];

        $widgets[ 'exad-pricing-table' ] = [
            'conditions' => [ 'widgetType' => 'exad-pricing-table' ],
            'fields'     => [
                [
					'field'       => 'exad_pricing_table_promo_title',
					'type'        => esc_html__( 'Title', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_pricing_table_title',
					'type'        => esc_html__( 'Title', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_pricing_table_subtitle',
					'type'        => esc_html__( 'Subtitle', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				],
                [
					'field'       => 'exad_pricing_table_featured_tag_text',
					'type'        => esc_html__( 'Featured Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_pricing_table_price',
					'type'        => esc_html__( 'Price', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_pricing_table_price_cur',
					'type'        => esc_html__( 'Price Currency', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_pricing_table_price_by',
					'type'        => esc_html__( 'Price By', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_pricing_table_period_separator',
					'type'        => esc_html__( 'Separated By', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_pricing_table_regular_price',
					'type'        => esc_html__( 'Ragular Price', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_pricing_table_regular_price_cur',
					'type'        => esc_html__( 'Regular Price Currency', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
                [
					'field'       => 'exad_pricing_table_price_subtitle',
					'type'        => esc_html__( 'Price Subtitle', 'exclusive-addons-elementor' ),
					'editor_type' => 'AREA',
				],
                [
					'field'       => 'exad_pricing_table_btn',
					'type'        => esc_html__( 'Text', 'exclusive-addons-elementor' ),
					'editor_type' => 'LINE',
				],
            ],
            'integration-class' => 'WPML_Exad_Pricing_Table',
        ];

        $widgets[ 'exad-exclusive-tabs' ] = [
            'conditions' => [ 'widgetType' => 'exad-exclusive-tabs' ],
            'fields'     => [],
            'integration-class' => 'WPML_Exad_Tabs',
        ];
        
        return $widgets;
    }

	/**
	 * Returns the instance.
	 * @since  1.4.4
	 * @return object
	 */
	
    public static function get_instance() {
		if ( ! isset( self::$instance ) ) :
			self::$instance = new self();
		endif;

		return self::$instance;
	}


}
