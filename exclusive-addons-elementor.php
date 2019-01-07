<?php
/**
 * Plugin Name: Exclusive Addons for Elementor
 * Plugin URI: http://devscred.com
 * Description: Packed with a bunch of Exclusively designed widget for Elementor.
 * Version: 1.0.0
 * Author: DevsCred
 * Author URI: http://devscred.com
 * Text Domain: exclusive-addons
 * Domain Path: /languages
 * License: GPL3
 */

namespace DevsCred;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Exclusive_Addons_Elementor' ) ) {
    /**
     * Exclusive Addons core class.
     *
     * Register plugin and make instances of core classes
     *
     * @package ShopMagic
     * @version 1.0.0
     * @since   1.0.0
     */
    class Exclusive_Addons_Elementor {

        /**
         * Holds class instance
         *
         * @access private
         *
         * @var ExclusiveAddons
         */
        private static $instance;

    	/**
         * Default constructor.
         *
         * Initialize plugin core and build environment
         *
         * @since   1.0.0
         */
        public function __construct() {
            $this->define_constants();
            $this->includes();
            $this->add_actions();

        }

        /**
         * Get class instance
         *
         * @return ExclusiveAddons
         */
        public static function get_instance(){
            if( null === self::$instance ){
                self::$instance = new self();
            }
            return self::$instance;
        }


        /**
         * Throw error on object clone
         *
         * The whole idea of the singleton design pattern is that there is a single
         * object therefore, we don't want the object to be cloned.
         */
        public function __clone()
        {
            // Cloning instances of the class is forbidden
            _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'exclusive-addons-elementor' ), '1.0' );
        }
        
        /**
         * Disable unserializing of the class
         *
         */
        public function __wakeup()
        {
            // Unserializing instances of the class is forbidden
            _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'exclusive-addons-elementor' ), '1.0' );
        }

        /**
         * Definition wrapper.
         *
         * Creates some useful def's in environment to handle
         * plugin paths
         *
         * @since   1.0.0
         */
        public function define_constants() {

            // Some Constants for ease of use
            if ( ! defined( 'EXAD_VER' ) )
    			define( 'EXAD_VER', '1.0.0' );
    		if ( ! defined( 'EXAD_PNAME' ) )
    			define( 'EXAD_PNAME', basename( dirname( __FILE__ ) ) );
    		if ( ! defined( 'EXAD_PBNAME' ) )
    		define( 'EXAD_PBNAME', plugin_basename(__FILE__) );
    		if ( ! defined( 'EXAD_PATH' ) )
    			define( 'EXAD_PATH', plugin_dir_path( __FILE__ ) );
            if ( ! defined( 'EXAD_ELEMENTS' ) )
                define( 'EXAD_ELEMENTS', plugin_dir_path( __FILE__ ) . 'elements/' );
    		if ( ! defined( 'EXAD_URL' ) )
    		define( 'EXAD_URL', plugins_url( '/', __FILE__ ) );
    		if ( ! defined( 'EXAD_ASSETS_URL' ) )
    			define( 'EXAD_ASSETS_URL', EXAD_URL . 'assets/' );
        }

        /**
         *
         * Includes 
         *
         */
        public function includes() {
            require_once EXAD_PATH . 'admin/dashboard-settings.php';
        }


        /**
         * Adds action hooks.
         *
         * @since   1.0.0
         */
        private function add_actions() {
            // Enqueue Styles and Scripts
            add_action( 'wp_enqueue_scripts', array( $this, 'exad_enqueue_scripts' ) );
            // Registering Elementor Widget Category
            add_action( 'elementor/elements/categories_registered', array( $this, 'exad_register_category' ) );
        	// Registering custom widgets
            add_action( 'elementor/widgets/widgets_registered', array( $this, 'exad_add_elements' ) );
            // Plugin Loaded Action
            add_action( 'plugins_loaded', array( $this, 'exad_element_pack_load_plugin' ) );
            // Add Body Class 
            add_filter( 'body_class', array( $this, 'exad_add_body_classes' ) );

        }

        /*
        *
        * Add Body Class exclusive-addons-elmentor
        */
        public function exad_add_body_classes( $classes ) {
            $classes[] = 'exclusive-addons-elementor';

            return $classes;
        }

        

        /**
         * Plugin load here correctly
         * Also loaded the language file from here
         */
        public function exad_element_pack_load_plugin() {
            load_plugin_textdomain( 'exclusive-addons-elementor', false, basename( dirname( __FILE__ ) ) . '/languages' );

            if ( ! did_action( 'elementor/loaded' ) ) {
                add_action( 'admin_notices', array( $this, 'exad_element_pack_fail_load' ) );
                return;
            }
            
        }

        /**
        * Enqueue Plugin Styles and Scripts
        *
        */
        public function exad_enqueue_scripts() {
            //wp_enqueue_style( 'exad-bootstrap', EXAD_URL . 'assets/css/bootstrap.min.css' );
            wp_enqueue_style( 'exad-main-style', EXAD_URL . 'assets/css/main-style.css' );

            wp_enqueue_script( 'exad-main-script', EXAD_URL . 'assets/js/main-script.js', array( 'jquery' ), 192882, true );
        }

        /**
        * Register Exclusive Elementor Addons category
        *
        */
        public function exad_register_category( $elements_manager ) {

            $elements_manager->add_category(
                'exclusive-addons-elementor',
                [
                    'title' => __( 'Exclusive Addons', 'exclusive-addons-elementor' ),
                    'icon' => 'fa fa-plug',
                ]
            );

        }

        /**
         * Check Elementor installed and activated correctly
         */
        function exad_element_pack_fail_load() {
            $screen = get_current_screen();
            if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
                return;
            }

            $plugin = 'elementor/elementor.php';

            if ( $this->_is_elementor_installed() ) {
                if ( ! current_user_can( 'activate_plugins' ) ) { return; }
                $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
                $admin_message = '<p>' . esc_html__( 'Opps! Exclusive Addons requires Elementor Plugin to be activated first.', 'exclusive-addons-elementor' ) . '</p>';
                $admin_message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__( 'Activate Elementor Now', 'exclusive-addons-elementor' ) ) . '</p>';
            } else {
                if ( ! current_user_can( 'install_plugins' ) ) { return; }
                $install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
                $admin_message = '<p>' . esc_html__( 'Opps! Exclusive Addons not working because you need to install the Elementor plugin', 'exclusive-addons-elementor' ) . '</p>';
                $admin_message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Install Elementor Now', 'exclusive-addons-elementor' ) ) . '</p>';
            }

            echo '<div class="error">' . $admin_message . '</div>';
        }

        /**
        * Include Addons
        *
        */
        public function exad_add_elements() {

        	require_once EXAD_ELEMENTS . 'team-member/team-member.php';
            require_once EXAD_ELEMENTS . 'team-carousel/team-carousel.php';
            require_once EXAD_ELEMENTS . 'testimonial-carousel/testimonial-carousel.php';
            require_once EXAD_ELEMENTS . 'progress-bar/progress-bar.php';
            require_once EXAD_ELEMENTS . 'card/card.php';
            require_once EXAD_ELEMENTS . 'countdown-timer/countdown-timer.php';
            
        }

        /**
        * Check the elementor installed or not
        */
        public function _is_elementor_installed() {
            $file_path = 'elementor/elementor.php';
            $installed_plugins = get_plugins();

            return isset( $installed_plugins[ $file_path ] );
        }


    }

// Instance of the Exclusive_Addons_Core class
\DevsCred\Exclusive_Addons_Elementor::get_instance();

}