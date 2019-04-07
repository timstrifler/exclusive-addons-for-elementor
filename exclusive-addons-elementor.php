<?php
/**
 * Plugin Name: Exclusive Addons for Elementor
 * Plugin URI: http://exclusiveaddons.com/
 * Description: Packed with a bunch of Exclusively designed widget for Elementor.
 * Version: 1.1.1
 * Author: DevsCred
 * Author URI: http://devscred.com/
 * Text Domain: exclusive-addons-elementor
 * Domain Path: /languages
 * License: GPL3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( ! class_exists( 'Exclusive_Addons_Elementor') ) {
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
		const VERSION = '1.1.1';

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
		 * 
		 * Static property that consists all the default widget names
		 * 
		 * @access public
		 * @static
		 * 
		 * @return array
		 */
		public static $exad_default_widgets = [ 'exclusive-card', 'countdown-timer', 'exclusive-accordion', 'exclusive-tabs', 'exclusive-button', 'post-grid', 'post-timeline', 'team-member', 'team-carousel', 'testimonial-carousel', 'flipbox', 'infobox', 'pricing-table', 'progress-bar', 'exclusive-heading', 'dual-heading', 'post-carousel' ];

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
			$this->constants();
			$this->includes();
			add_action( 'init', [ $this, 'init' ] );
			add_action( 'admin_init', [ $this, 'plugin_redirect_hook' ] );
		}

		/**
		 * Define Constants
		 * @since 1.0.2
		 */
		public function constants() {
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
			

			// Add Plugin actions
			add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

			// Enqueue Styles and Scripts
			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ], 20 );

			// Elementor Editor Styles
			add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'exad_editor_styles' ] );
			
			// Registering Elementor Widget Category
			add_action( 'elementor/elements/categories_registered', [ $this, 'register_category' ] );

			// Add Body Class 
			add_filter( 'body_class', [ $this, 'add_body_classes' ] );

			load_plugin_textdomain( 'exclusive-addons-elementor' );

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
		 * 
		 * Enqueue Elementor Editor Styles
		 * 
		 */
		public function exad_editor_styles() {
			wp_enqueue_style( 'exad-frontend-editor', EXAD_URL . 'assets/css/exad-frontend-editor.css' );
		}

		/**
		* Enqueue Plugin Styles and Scripts
		*
		*/
		public function enqueue_scripts() {

			$is_activated_widget = $this->activated_widgets();
			wp_enqueue_style( 'exad-main-style', EXAD_URL . 'assets/css/exad-styles.css' );
			wp_enqueue_style( 'exad-fahim-style', EXAD_URL . 'assets/css/fahim-style.css' );
			if ( $is_activated_widget['progress-bar'] ) {
				// Progress Bar Js
				wp_enqueue_script( 'exad-progress-bar', EXAD_URL . 'assets/js/vendor/loading-bar.js', array( 'jquery' ), 1.0, true );
				// Waypoints js
				wp_enqueue_script( 'exad-waypoints', EXAD_URL . 'assets/js/vendor/jquery.waypoints.min.js', array( 'jquery' ), 1.0, true );
			}
			// jQuery Countdown js
			if ( $is_activated_widget['countdown-timer'] ) {
				wp_enqueue_script( 'exad-countdown', EXAD_URL . 'assets/js/vendor/jquery.countdown.min.js', array( 'jquery' ), 1.0, true );
			}
			wp_enqueue_script( 'exad-main-script', EXAD_URL . 'assets/js/exad-scripts.js', array( 'jquery' ), 1.0, true );
			
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
		 * This function will return true for all activated modules
		 *
		* @since  1.0
		*/
		public static function activated_widgets() {
			
			$exad_default_settings  = array_fill_keys( self::$exad_default_widgets, true );
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
		public function init_widgets() {
			
			$activated_widgets = $this->activated_widgets();

			if ( function_exists( 'wpcf7' ) ) {
				self::$exad_default_widgets[] = 'contact-form-7';
			}

			foreach( self::$exad_default_widgets as $widget ) {
				if ( $activated_widgets[$widget] == true ) {
					require_once EXAD_ELEMENTS . $widget . '/' .$widget . '.php';
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

	/**
	 * 
	 * Initilize Plugin Class
	 */
	function init_exclusive_addons() {
		return Exclusive_Addons_Elementor::instance();
	}
	add_action( 'plugins_loaded', 'init_exclusive_addons' );
	
}	

/**
 * Plugin Redirect Option Added by register_activation_hook
 * 
 */
function exad_plugin_redirect_option() {
	add_option( 'exad_do_update_redirect', true );
}
register_activation_hook( __FILE__ , 'exad_plugin_redirect_option' );
