<?php
/**
 * Plugin Name: Exclusive Addons for Elementor
 * Plugin URI: http://devscred.com
 * Description: Packed with a bunch of Exclusively designed widget for Elementor.
 * Version: 1.0.0
 * Author: DevsCred
 * Author URI: http://devscred.com
 * Text Domain: exclusive-addons-elementor
 * Domain Path: /languages
 * License: GPL3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Exclusive Addons for Elementor Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Exclusive_Addons_Elementor {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '5.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Exclusive_Addons_Elementor The single instance of the class.
	 */
	private static $_instance = null;

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
	 * @return Exclusive_Addons_Elementor An instance of the class.
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

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {

		load_plugin_textdomain( 'exclusive-addons-elementor' );

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

        // Some Constants for ease of use
        if ( ! defined( 'EXAD_PNAME' ) )
            define( 'EXAD_PNAME', basename( dirname( __FILE__ ) ) );
        if ( ! defined( 'EXAD_PBNAME' ) )
        define( 'EXAD_PBNAME', plugin_basename(__FILE__) );
        if ( ! defined( 'EXAD_PATH' ) )
            define( 'EXAD_PATH', plugin_dir_path( __FILE__ ) );
        if ( ! defined( 'EXAD_ELEMENTS' ) )
            define( 'EXAD_ELEMENTS', plugin_dir_path( __FILE__ ) . 'elements/' );
        if ( ! defined( 'EXAD_TEMPLATES' ) )
            define( 'EXAD_TEMPLATES', plugin_dir_path( __FILE__ ) . 'includes/template-parts/' );
        if ( ! defined( 'EXAD_URL' ) )
        define( 'EXAD_URL', plugins_url( '/', __FILE__ ) );
        if ( ! defined( 'EXAD_ASSETS_URL' ) )
            define( 'EXAD_ASSETS_URL', EXAD_URL . 'assets/' );


		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		include_once EXAD_PATH . 'includes/helper-class.php';

        // Register Widget Scripts
		//add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

        // Enqueue Styles and Scripts
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
        
        // Registering Elementor Widget Category
        add_action( 'elementor/elements/categories_registered', [ $this, 'register_category' ] );

        // Add Body Class 
        add_filter( 'body_class', [ $this, 'add_body_classes' ] );

        include_once EXAD_PATH . 'admin/dashboard-settings.php';

    }
    
    /**
    * Register Exclusive Elementor Addons category
    *
    */
    public function register_category( $elements_manager ) {

        $elements_manager->add_category(
            'exclusive-addons-elementor',
            [
                'title' => __( 'Exclusive Addons', 'exclusive-addons-elementor' ),
                'icon' => 'fa fa-plug',
            ]
        );

    }

    /**
    * Enqueue Plugin Styles and Scripts
    *
    */
    public function enqueue_scripts() {
        
        wp_enqueue_style( 'exad-main-style', EXAD_URL . 'assets/css/main-style.css' );
		
		// Progress Bar Js
        wp_enqueue_script( 'exad-progress-bar', EXAD_URL . 'assets/js/vendor/progressbar.js', array( 'jquery' ), 1.0, true );
        // Waypoints js
        wp_enqueue_script( 'exad-waypoints', EXAD_URL . 'assets/js/vendor/jquery.waypoints.min.js', array( 'jquery' ), 1.0, true );
        // jQuery Cuntdown js
        wp_enqueue_script( 'exad-countdown', EXAD_URL . 'assets/js/vendor/jquery.countdown.min.js', array( 'jquery' ), 1.0, true );
		wp_enqueue_script( 'exad-main-script', EXAD_URL . 'assets/js/main-script.js', array( 'jquery', 'exad-countdown', 'exad-progress-bar', 'exad-waypoints' ), 1.0, true );
        
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
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'exclusive-addons-elementor' ),
			'<strong>' . esc_html__( 'Exclusive Addons Elementor', 'exclusive-addons-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'exclusive-addons-elementor' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

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
			 self::MINIMUM_ELEMENTOR_VERSION
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
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

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
	public function init_widgets() {

		// Include Widget files
		include_once EXAD_ELEMENTS . 'team-member/team-member.php';
        include_once EXAD_ELEMENTS . 'team-carousel/team-carousel.php';
        include_once EXAD_ELEMENTS . 'testimonial-carousel/testimonial-carousel.php';
        include_once EXAD_ELEMENTS . 'progress-bar/progress-bar.php';
        include_once EXAD_ELEMENTS . 'card/card.php';
        include_once EXAD_ELEMENTS . 'pricing-table/pricing-table.php';
        include_once EXAD_ELEMENTS . 'countdown-timer/countdown-timer.php';
        include_once EXAD_ELEMENTS . 'flipbox/flipbox.php';
        include_once EXAD_ELEMENTS . 'post-timeline/post-timeline.php';
		include_once EXAD_ELEMENTS . 'infobox/infobox.php';
		if ( function_exists( 'wpcf7' ) ) {
			include_once EXAD_ELEMENTS . 'contact-form-7/contact-form-7.php';
		}
		include_once EXAD_ELEMENTS . 'post-grid/post-grid.php';
		include_once EXAD_ELEMENTS . 'exclusive-button/exclusive-button.php';
		//include_once EXAD_ELEMENTS . 'exclusive-tabs/exclusive-tabs.php';
	}

}

Exclusive_Addons_Elementor::instance();