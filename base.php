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
    public $default_widgets = array(); 

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

        do_action( 'exad/before_init' );
        $this->initiate_elements();
        $this->includes();
        $this->register_hooks();
        $this->exclusive_addons_appsero_init();
        
        self::$registered_elements = apply_filters( 'exad/registered_elements', $this->default_widgets );
        sort( self::$registered_elements );
    }

    // register hooks
    public function register_hooks() {

        if ( is_admin() ) {
            // Check if Elementor installed and activated
            if ( ! did_action( 'elementor/loaded' ) ) {
                add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
                return;
            }

            // Check for required Elementor version
            if ( ! version_compare( ELEMENTOR_VERSION, MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
                add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
                return;
            }

            // Check for required PHP version
            if ( version_compare( PHP_VERSION, MINIMUM_PHP_VERSION, '<' ) ) {
                add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
                return;
            }

            add_action( 'admin_init', [ $this, 'plugin_redirect_hook' ] );

            // Plugin Settings URL
            add_filter( 'plugin_action_links_'.EXAD_PBNAME, array( $this, 'plugin_settings_action' ) );

        }

        add_action( 'init', [ $this, 'i18n' ] );
        // Placeholder image replacement
        add_filter( 'elementor/utils/get_placeholder_image_src', [ $this, 'set_placeholder_image' ], 30 );
        // Registering Elementor Widget Category
        add_action( 'elementor/elements/categories_registered', [ $this, 'register_category' ] );
        // Enqueue Styles and Scripts
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'enqueue_scripts' ], 20 );
        // Load Main script
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'core_files_enqueue' ] );
        // Elementor Editor Styles
        add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );
        // Add Elementor Widgets
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'initiate_widgets' ] );
        // Add Body Class 
        add_filter( 'body_class', [ $this, 'add_body_classes' ] );

    }


    /**
     * 
     * Including necessary assets
     * @since 1.0.2
     */
    public function includes() {
        // Helper Class
        include_once EXAD_PATH . 'includes/helper-class.php';
        if( is_admin() ) {
            include_once EXAD_PATH . 'admin/dashboard-settings.php';
        }
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
    public function register_category( $elements_manager ) {

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
    public function initiate_elements() {

        $dir = new \RecursiveDirectoryIterator( EXAD_ELEMENTS );
        $child_dir = new \RecursiveIteratorIterator($dir);
        $files = new \RegexIterator( $child_dir, '/^.+\.php$/i' );
        
        foreach( $files as $file ) {
            $filename = basename( $file, '.php' );
            $this->default_widgets[] = $filename;
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

        $client = new \Appsero\Client( '74b80636-5fd5-4e65-a526-935acc9f260e', 'Exclusive Addons Elementor', __FILE__ );

        // Active insights
        $client->insights()->init();

        // Active automatic updater
        $client->updater();

    }


    /**
     * 
     * Add Plugin Action link for settings page
     */
    public function plugin_settings_action( $links ) {
        $settings_link = sprintf( '<a href="admin.php?page=exad-settings">' . __( 'Settings', 'exclusive-addons-elementor' ) . '</a>' );
        array_push( $links, $settings_link );
        return $links;
    }

    /**
     * 
     * Placeholder Image
     */
    public function set_placeholder_image() {
        return EXAD_ASSETS_URL . 'img/placeholder.png';
    }

    /**
     * 
     * Enqueue Elementor Editor Styles
     * 
     */
    public function editor_scripts() {
        wp_enqueue_style( 'exad-frontend-editor', EXAD_ASSETS_URL . 'css/exad-frontend-editor.css' );
    }

    /**
    * Enqueue Plugin Styles and Scripts
    *
    */
    public function enqueue_scripts() {

        $is_activated_widget = $this->activated_widgets();

        if ( $is_activated_widget['progress-bar'] ) {
            // Loading Bar JS
            wp_register_script( 'exad-progress-bar', EXAD_ASSETS_URL . 'vendor/js/exad-progress-bar-vendor.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
            
            // Waypoints JS
            wp_register_script( 'exad-waypoints', EXAD_ASSETS_URL . 'vendor/js/jquery.waypoints.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }
        // Google Map js
        if ( $is_activated_widget['google-maps'] ) {
            if ( '' != get_option('exad_google_map_api_option') ) {
                wp_register_script( 'exad-google-map-api', 'https://maps.googleapis.com/maps/api/js?key='.get_option('exad_google_map_api_option'), array(), EXAD_PLUGIN_VERSION, false );
            }
            // Gmap 3 Js
            wp_register_script( 'exad-gmap3', EXAD_ASSETS_URL . 'vendor/js/gmap3.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );            
        }	
        
        if ( $is_activated_widget['countdown-timer'] ) {
            // jQuery Countdown Js
            wp_register_script( 'exad-countdown', EXAD_ASSETS_URL . 'vendor/js/jquery.countdown.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }

        if ( $is_activated_widget['image-comparison'] ) {
            // jQuery image-comparison twentytwenty Js
            wp_register_script( 'exad-image-comparison', EXAD_ASSETS_URL . 'vendor/js/exad-comparison-vendor.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }

        if ( $is_activated_widget['filterable-gallery'] ) {
            // Filterable Gallery
            wp_register_script( 'exad-gallery-isotope', EXAD_ASSETS_URL . 'vendor/js/isotop.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }

        if ( $is_activated_widget['news-ticker'] ) {
            // News ticker
            wp_register_script( 'exad-news-ticker', EXAD_ASSETS_URL . 'vendor/js/exad-news-ticker.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }
        
        if ( $is_activated_widget['animated-text'] ) {
            // Animated Text
            wp_register_script( 'exad-animated-text', EXAD_ASSETS_URL . 'vendor/js/typed.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }	
        
    }


    /**
     * Front end main script
     * 
     */
    public function core_files_enqueue() {
        // Main Plugin Styles
        wp_enqueue_style( 'exad-main-style', EXAD_ASSETS_URL . 'css/exad-styles.min.css' );

        if( is_rtl() ) {
            // Main Plugin RTL Styles
            wp_enqueue_style( 'exad-rtl-style', EXAD_ASSETS_URL . 'css/exad-rtl-styles.css' );            
        }

        // Main Plugin Scripts
        wp_enqueue_script( 'exad-main-script', EXAD_ASSETS_URL . 'js/exad-scripts.min.js', array('jquery'), EXAD_PLUGIN_VERSION, true );
    }

    /**
     * Admin notice
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_missing_main_plugin() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $elementor_path = 'elementor/elementor.php';

        if ( $this->is_elementor_activated() ) {
            if( ! current_user_can( 'activate_plugins' ) ) {
                return;
            }
            $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $elementor_path . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor_path );
            $message = __( '<strong>Exclusive Addons for Elementor</strong> won\'t work without the help of <strong>Elementor</strong> plugin. Please activate Elementor.', 'exclusive-addons-elementor' );
            $button_text = __( 'Activate Elementor', 'exclusive-addons-elementor' );
            } else {
            if( ! current_user_can( 'install_plugins' ) ) {
                return;
            }
            $activation_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
            $message = sprintf( __( '<strong>Exclusive Addons for Elementor</strong> won\'t work without the help of <strong>Elementor</strong> plugin. Please install Elementor.', 'exclusive-addons-elementor' ), '<strong>', '</strong>' );
            $button_text = __( 'Install Elementor', 'exclusive-addons-elementor' );
            }

        $button = '<p><a href="' . $activation_url . '" class="button-primary">' . $button_text . '</a></p>';
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p>%2$s</div>', __( $message ), $button );

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required Elementor version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_elementor_version() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'exclusive-addons-elementor' ),
            '<strong>' . esc_html__( 'Exclusive Addons Elementor', 'exclusive-addons-elementor' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'exclusive-addons-elementor' ) . '</strong>',
            MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_php_version() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'exclusive-addons-elementor' ),
            '<strong>' . esc_html__( 'Exclusive Addons Elementor', 'exclusive-addons-elementor' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'exclusive-addons-elementor' ) . '</strong>',
            MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

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

    /**
     * Check to see if Elementor is Activated
     * 
     * @since 1.0.2
     */
    public function is_elementor_activated( $plugin_path = 'elementor/elementor.php' ){
        $installed_plugins_list = get_plugins();
        return isset( $installed_plugins_list[ $plugin_path ] );
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
     * This function returns true for all activated modules
     *
    * @since  1.0
    */
    public function activated_widgets() {
        
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
    public function initiate_widgets() {
        
        $activated_widgets = $this->activated_widgets();
        foreach( self::$registered_elements as $widget ) {
            if ( $activated_widgets[$widget] == true ) {
                
                if ( $widget == 'contact-form-7' ) {
                    if ( ! function_exists( 'wpcf7' ) ) {
                        continue;
                    }	
                } 

                $widget_name = str_replace( '-', '_', $widget );
                $widget_class = '\ExclusiveAddons\Elements\\' . ucwords( $widget_name, '_' );
                if ( class_exists( $widget_class ) ) {
                    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $widget_class );
                }
            }
        }

    }
}