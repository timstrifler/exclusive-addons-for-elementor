<?php
namespace ExclusiveAddons\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use ExclusiveAddons\Elementor\Base;
use ExclusiveAddons\Elementor\Addons_Manager;

class Assets_Manager {

	/**
	 * Initialize
	 */
	public static function init() {
        // Register dependency scripts
        add_action( 'elementor/frontend/after_register_scripts', [ __CLASS__, 'register_dependency_scripts' ], 20 );
        // Load Main script
        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ] );
        // Elementor Editor Styles
        add_action( 'elementor/editor/after_enqueue_scripts', [ __CLASS__, 'editor_scripts' ] );
    }

    /**
     * 
     * Enqueue Elementor Editor Styles
     * 
     */
    public static function editor_scripts() {
        wp_enqueue_style( 'exad-frontend-editor', EXAD_ASSETS_URL . 'css/exad-frontend-editor.min.css' );
        wp_enqueue_style( 'exad-template-library-style', EXAD_ASSETS_URL . 'css/template-library.min.css', [ 'elementor-editor' ], EXAD_PLUGIN_VERSION );
        wp_enqueue_script( 'exad-template-library-script', EXAD_ASSETS_URL . 'js/template-library.min.js', [ 'elementor-editor', 'jquery-hover-intent' ], EXAD_PLUGIN_VERSION, true );
        wp_enqueue_script( 'exad-unlimited-nested-section', EXAD_ASSETS_URL .'js/unlimited-nested-section.min.js', [ 'elementor-editor'  ] , EXAD_PLUGIN_VERSION, true );

		$localized_data = [
            'exadProWidgets' => [],
			'isProActive' => Base::$is_pro_active,
			'i18n' => [
				'templatesEmptyTitle' => esc_html__( 'No Templates Found', 'exclusive-addons-elementor' ),
				'templatesEmptyMessage' => esc_html__( 'Try different category or sync for new templates.', 'exclusive-addons-elementor' ),
				'templatesNoResultsTitle' => esc_html__( 'No Results Found', 'exclusive-addons-elementor' ),
				'templatesNoResultsMessage' => esc_html__( 'Please make sure your search is spelled correctly or try a different word.', 'exclusive-addons-elementor' ),
			]
	
        ];
        
        if ( ! Base::$is_pro_active ) {
			$localized_data['exadProWidgets'] = Addons_Manager::widget_map_pro();
		}

        wp_localize_script( 'exad-template-library-script', 'ExclusiveAddonsEditor', $localized_data );
    }

    /**
    * Enqueue Plugin Styles and Scripts
    *
    */
    public static function register_dependency_scripts() {

        if ( Addons_Manager::$is_activated_feature['progress-bar'] ) {
            // Loading Bar JS
            wp_register_script( 'exad-progress-bar', EXAD_ASSETS_URL . 'vendor/js/exad-progress-bar-vendor.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
            // Waypoints JS
            wp_register_script( 'exad-waypoints', EXAD_ASSETS_URL . 'vendor/js/jquery.waypoints.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }
        // Google Map js
        if ( Addons_Manager::$is_activated_feature['google-maps'] || Addons_Manager::$is_activated_feature['google-reviews'] ) {
            if ( '' != get_option('exad_google_map_api_option') ) {
                wp_register_script( 'exad-google-map-api', 'https://maps.googleapis.com/maps/api/js?key='.get_option('exad_google_map_api_option'), array(), EXAD_PLUGIN_VERSION, false );
            }
            // Gmap 3 Js
            wp_register_script( 'exad-gmap3', EXAD_ASSETS_URL . 'vendor/js/gmap3.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );            
        }	
        
        if ( Addons_Manager::$is_activated_feature['countdown-timer'] ) {
            // jQuery Countdown Js
            wp_register_script( 'exad-countdown', EXAD_ASSETS_URL . 'vendor/js/jquery.countdown.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }

        if ( Addons_Manager::$is_activated_feature['logo-carousel'] ) {
            // jQuery Logo Carousel Js
            wp_register_script( 'exad-slick', EXAD_ASSETS_URL . 'vendor/js/slick.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }

        if ( Addons_Manager::$is_activated_feature['image-comparison'] ) {
            // jQuery image-comparison twentytwenty Js
            wp_register_script( 'exad-image-comparison', EXAD_ASSETS_URL . 'vendor/js/exad-comparison-vendor.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }

        if ( Addons_Manager::$is_activated_feature['filterable-gallery'] || Addons_Manager::$is_activated_feature['filterable-post'] ) {
            // Filterable Gallery, Filterable Post
            wp_register_script( 'exad-gallery-isotope', EXAD_ASSETS_URL . 'vendor/js/isotop.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }

        if ( Addons_Manager::$is_activated_feature['news-ticker'] ) {
            // News ticker
            wp_register_script( 'exad-news-ticker', EXAD_ASSETS_URL . 'vendor/js/exad-news-ticker.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }
        
        if ( Addons_Manager::$is_activated_feature['animated-text'] ) {
            // Animated Text
            wp_register_script( 'exad-animated-text', EXAD_ASSETS_URL . 'vendor/js/typed.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }	
        if ( Addons_Manager::$is_activated_feature['post-grid'] || Addons_Manager::$is_activated_feature['filterable-post'] ) {
            // Post grid, Filterable Post
            wp_register_script( 'exad-post-grid', EXAD_ASSETS_URL . 'vendor/js/jquery.matchHeight.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }	

        if ( Addons_Manager::$is_activated_feature['sticky'] ) {
            // Sticky Sidebar
            wp_enqueue_script( 'exad-sticky-jquery', EXAD_ASSETS_URL . 'vendor/js/jquery.sticky-sidebar.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }
        
    }


    /**
     * Front end main script
     * 
     */
    public static function enqueue_scripts() {
        // Main Plugin Styles
        wp_enqueue_style( 'exad-main-style', EXAD_ASSETS_URL . 'css/exad-styles.min.css' );

        if( is_rtl() ) {
            // Main Plugin RTL Styles
            wp_enqueue_style( 'exad-rtl-style', EXAD_ASSETS_URL . 'css/exad-rtl-styles.min.css' );            
        }

        // Main Plugin Scripts
        wp_enqueue_script( 'exad-main-script', EXAD_ASSETS_URL . 'js/exad-scripts.min.js', array('jquery'), EXAD_PLUGIN_VERSION, true );

        wp_localize_script( 'exad-main-script', 'exad_ajax_object', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce('exclusive_addons_nonce')
        ));
    }

}

Assets_Manager::init();
