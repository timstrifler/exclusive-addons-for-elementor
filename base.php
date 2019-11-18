<?php
/**
 * 
 * Plugin Main Class
 * 
 * @package Exclusive Addons
 */

namespace ExclusiveAddons\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Exclusive Addons for Elementor Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Base {

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     *
     * @var Base The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Appsero 
     * 
     */
    public $appsero = null;

    /**
     * 
     * Static property that consists all the default widget names
     * 
     * @access public
     * @static
     * 
     * @return array
     */
    public $exad_default_widgets = array(); 

    /**
     * 
     * Static property to add all the Free and Pro widgets
     * 
     * @access public
     * @static
     * 
     * 
     */
    public static $registered_elements;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     *
     * @access public
     * @static
     *
     * @return Base An instance of the class.
     */
    public static function instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function __construct() {
        $this->exad_initiate_elements();
        $this->includes();
        $this->exclusive_addons_appsero_init();

        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'admin_init', [ $this, 'plugin_redirect_hook' ] );
        // Placeholder image replacement
        add_filter( 'elementor/utils/get_placeholder_image_src', array( $this, 'exad_set_placeholder_image' ), 30 );
        // Plugin Settings URL
        add_filter( 'plugin_action_links_'.EXAD_PBNAME, array( $this, 'exad_plugin_settings_action' ) );
        // Registering Elementor Widget Category
        add_action( 'elementor/elements/categories_registered', array( $this, 'exad_register_category' ) );
        // Enqueue Styles and Scripts
        add_action( 'elementor/frontend/after_register_scripts', array( $this, 'exad_enqueue_scripts' ), 20 );
        // Load Main script
        add_action( 'elementor/frontend/after_enqueue_scripts', array( $this, 'exad_main_script_enqueue' ) );
        // Elementor Editor Styles
        add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'exad_editor_scripts' ) );
        // Add Elementor Widgets
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'exad_init_widgets' ) );
        // Add Body Class 
        add_filter( 'body_class', array( $this, 'add_body_classes' ) );
        
        self::$registered_elements = apply_filters( 'exad/registered_elements', $this->exad_default_widgets );
        sort( self::$registered_elements );
    }


    /**
     * 
     * Including necessary assets
     * @since 1.0.2
     */
    public function includes() {
        // Helper Class
        include_once EXAD_PATH . 'includes/helper-class.php';
        // Admin Dashboard
        include_once EXAD_PATH . 'admin/dashboard-settings.php';
    }

    public function i18n() {
        // Load Plugin textdomain
        load_plugin_textdomain( 'exclusive-addons-elementor' );
    }

    /**
     * 
     * Register Exclusive Elementor Addons category
     *
     */
    public function exad_register_category( $elements_manager ) {

        $elements_manager->add_category(
            'exclusive-addons-elementor',
            [
                'title' => __( 'Exclusve Addons', 'exclusive-addons-elementor' ),
                'icon' => 'font',
            ]
        );
    }

    /**
     * 
     * Initiate Elements name from folder created inside elements
     * 
     * @since 1.2.2
     */
    public function exad_initiate_elements() {

        $dir = new \RecursiveDirectoryIterator( EXAD_PATH . 'elements/' );
        $child_dir = new \RecursiveIteratorIterator($dir);
        $files = new \RegexIterator( $child_dir, '/^.+\.php$/i' );
        
        foreach( $files as $file ) {
            $filename = basename( $file, '.php' );
            $this->exad_default_widgets[] = $filename;
        }
    }

    /**
     * Initialize the tracker
     *
     * @return void
     */
    protected function exclusive_addons_appsero_init() {

        if ( ! class_exists( '\Appsero\Client' ) ) {
            require_once __DIR__ . '/vendor/appsero/src/Client.php';
        }

        $client = new \Appsero\Client( '74b80636-5fd5-4e65-a526-935acc9f260e', 'Exclusive Addons Elementor - Pro', __FILE__ );

        // Active insights
        $client->insights()->init();

        // Active automatic updater
        $client->updater();

    }


    /**
     * 
     * Add Plugin Action link for settings page
     */
    public function exad_plugin_settings_action( $links ) {
        $settings_link = sprintf( '<a href="admin.php?page=exad-settings">' . __( 'Settings', 'exclusive-addons-elementor' ) . '</a>' );
        array_push( $links, $settings_link );
        return $links;
    }

    /**
     * 
     * Placeholder Image
     */
    public function exad_set_placeholder_image() {
        return EXAD_ASSETS_URL . 'img/placeholder.jpg';
    }

    /**
     * 
     * Enqueue Elementor Editor Styles
     * 
     */
    public function exad_editor_scripts() {
        wp_enqueue_style( 'exad-frontend-editor', EXAD_ASSETS_URL . 'css/exad-frontend-editor.css' );
        wp_enqueue_script( 'exad-editor-script', EXAD_ASSETS_URL . 'js/exad-editor-script.js', array( 'elementor-editor' ), '1.0', true );
        wp_enqueue_script( 'exad-main-script', EXAD_ASSETS_URL . 'js/exad-scripts.js', array(), '1.0', true );
    }

    /**
    * Enqueue Plugin Styles and Scripts
    *
    */
    public function exad_enqueue_scripts() {

        $is_activated_widget = $this->activated_widgets();

        // Main Styles
        wp_enqueue_style( 'exad-main-style', EXAD_ASSETS_URL . 'css/exad-styles.css' );
        
        if ( $is_activated_widget['progress-bar'] ) {
            // Progress Bar Js
            wp_register_script( 'exad-progress-bar', EXAD_ASSETS_URL . 'js/vendor/loading-bar.js', array( 'jquery' ), '1.0', true );
            // Waypoints Js
            wp_register_script( 'exad-waypoints', EXAD_ASSETS_URL . 'js/vendor/jquery.waypoints.min.js', array( 'jquery' ), '1.0', true );
            wp_register_script( 'exad-wow-js', EXAD_ASSETS_URL . 'js/vendor/wow.min.js', array( 'jquery' ), '1.1.3', true );
        }
        if ( $is_activated_widget['google-maps'] ) {
            if ( '' != get_option('exad_google_map_api_option') ) {
                wp_register_script( 'exad-google-map-api', 'https://maps.googleapis.com/maps/api/js?key='.get_option('exad_google_map_api_option'), array(), '1.8', false );
            }
            // Gmap 3 Js
            wp_register_script( 'exad-gmap3', EXAD_ASSETS_URL . 'js/vendor/gmap3.js', array( 'jquery' ), '1.0', true );
            
        }	
        
        if ( $is_activated_widget['countdown-timer'] ) {
            // jQuery Countdown Js
            wp_register_script( 'exad-countdown', EXAD_ASSETS_URL . 'js/vendor/jquery.countdown.min.js', array( 'jquery' ), '1.0', true );
        }

        if ( $is_activated_widget['image-comparison'] ) {
            // jQuery image-comparison twentytwenty Js
            wp_register_script( 'exad-image-comparison', EXAD_ASSETS_URL . 'js/vendor/jquery.twentytwenty.js', array( 'jquery' ), '1.0', true );
            wp_register_script( 'exad-image-comparison-event', EXAD_ASSETS_URL . 'js/vendor/jquery.event.move.js', array( 'jquery' ), '1.0', true );
        }

        if ( $is_activated_widget['counter'] ) {
            // jQuery CounterUp Js
            wp_register_script( 'exad-counter', EXAD_ASSETS_URL . 'js/vendor/jquery.counterup.min.js', array( 'jquery' ), '1.0', true );
        }

        if ( $is_activated_widget['filterable-gallery'] ) {
            // Filterable Gallery
            wp_register_script( 'exad-gallery-isotope', EXAD_ASSETS_URL . 'js/vendor/isotop.min.js', array( 'jquery' ), '1.0', true );
        }

        if ( $is_activated_widget['instagram-feed'] ) {
            // Instagram Gallery
            wp_register_script( 'exad-instagram', EXAD_ASSETS_URL . 'js/vendor/instafeed.js', array( 'jquery' ), '1.0', true );
        }
        if ( $is_activated_widget['news-ticker'] ) {
        // news ticker
            wp_register_script( 'exad-news-ticker', EXAD_ASSETS_URL . 'js/vendor/exad-news-ticker.min.js', array( 'jquery' ), '1.0', true );
        }	
        if ( $is_activated_widget['animated-text'] ) {
            // Instagram Gallery
            wp_register_script( 'exad-animated-text', EXAD_ASSETS_URL . 'js/vendor/typed.min.js', array( 'jquery' ), '1.0', true );
        }	
        if ( $is_activated_widget['slider'] ) {
            // slick slider slick animation
            wp_register_script( 'exad-slick-animation', EXAD_ASSETS_URL . 'js/vendor/slick-animation.min.js', array( 'jquery' ), '1.0', true );
        }
        
    }


    /**
     * Front end main script
     * 
     */
    public function exad_main_script_enqueue() {
        wp_enqueue_script( 'exad-main-script', EXAD_ASSETS_URL . 'js/exad-scripts.js', array(), '1.0', true );
    }

    /*
    *
    * Add Body Class exclusive-addons-elmentor
    */
    public function add_body_classes( $classes ) {
        $classes[] = 'exclusive-addons-elementor';

        return $classes;
    }
    
    /**
     * Check to see if Elementor is Activated
     * 
     * @since 1.0.2
     */
    public function is_elementor_activated( $plugin_path = 'elementor/elementor.php' ){
        $installed_plugins_list = get_plugins();
        return isset( $installed_plugins_list[ $plugin_path ] );
    }

    /**
     * This function returns true for all activated modules
     *
    * @since  1.0
    */
    public static function activated_widgets() {
        
        $exad_default_settings  = array_fill_keys( self::$registered_elements, true );
        $exad_get_settings      = get_option( 'exad_save_settings', $exad_default_settings );
        $exad_new_settings      = array_diff_key( $exad_default_settings, $exad_get_settings );

        if( ! empty( $exad_new_settings ) ) {
            $exad_updated_settings = array_merge( $exad_get_settings, $exad_new_settings );
            update_option( 'exad_save_settings', $exad_updated_settings );
        }

        return $exad_get_settings = get_option( 'exad_save_settings', $exad_default_settings );

    }

    /**
     * Init Widgets
     *
     * Include widgets files and register them
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function exad_init_widgets() {
        
        $activated_widgets = $this->activated_widgets();
        foreach( self::$registered_elements as $widget ) {
            if ( $activated_widgets[$widget] == true ) {
                
                if ( $widget == 'contact-form-7' ) {
                    if ( ! function_exists( 'wpcf7' ) ) {
                        continue;
                    }	
                } 

                include_once EXAD_ELEMENTS . $widget . '/' .$widget . '.php';
            }
        }

    }

    /**
     * Plugin Redirect Hook
     * 
     */
    public function plugin_redirect_hook() {
        if ( get_option( 'exad_do_update_redirect', false ) ) {
            delete_option( 'exad_do_update_redirect' );
            if ( !isset($_GET['activate-multi'] ) && $this->is_elementor_activated() ) {
                wp_redirect( 'admin.php?page=exad-settings' );
                exit;
            }
        }
    }

}


