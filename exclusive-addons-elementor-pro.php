<?php
/**
 * Plugin Name: Exclusive Addons Elementor - Pro
 * Plugin URI: http://exclusiveaddons.com/
 * Description: Packed with a bunch of Exclusively designed widget for Elementor.
 * Version: 1.0
 * Author: DevsCred
 * Author URI: http://devscred.com/
 * Text Domain: exclusive-addons-elementor
 * Domain Path: /languages
 * License: GPL3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Initialize the tracker
 *
 * @return void
 */
function appsero_init_tracker_appsero_test() {

    if ( ! class_exists( 'Appsero\Client' ) ) {
      require_once __DIR__ . '/appsero/src/Client.php';
    }

    $client = new Appsero\Client( '90188a4c-1afe-4efd-9f12-caf0970eb5ba', 'Exclusive Addons Elementor', __FILE__ );

    // Active insights
    $client->insights()->init();

    // Active automatic updater
    $client->updater();

    // Active license page and checker
    $args = array(
        'type'       => 'options',
        'menu_title' => 'Exclusive Addons Elementor',
        'page_title' => 'Exclusive Addons Elementor License Settings',
        'menu_slug'  => 'exad-settings',
    );
    $client->license()->add_settings_page( $args );
}

appsero_init_tracker_appsero_test();

if ( ! class_exists( 'Exclusive_Addons_Elementor' ) ) {


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
		const VERSION = '1.0';

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
		public static $exad_default_widgets = array(); 

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
			$this->exad_initiate_elements();
			$this->includes();
			add_action( 'plugins_loaded', [ $this, 'init' ] );
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
		 * Initiate Elements name from folder created inside elements
		 * 
		 * @since 1.2.2
		 */
		public function exad_initiate_elements() {

			$dir = new RecursiveDirectoryIterator( EXAD_PATH . 'elements/' );
			$child_dir = new RecursiveIteratorIterator($dir);
			$files = new RegexIterator( $child_dir, '/^.+\.php$/i' );
			
			foreach( $files as $file ) {
				$filename = basename( $file, '.php' );
				self::$exad_default_widgets[] = $filename;
			}
			
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
				add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
				return;
			}

			// Check for required Elementor version
			if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
				return;
			}

			// Check for required PHP version
			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
				return;
			}
			
			// Placeholder image replacement
			add_filter( 'elementor/utils/get_placeholder_image_src', array( $this, 'exad_set_placeholder_image' ), 30 );
			
			add_filter( 'plugin_action_links_'.EXAD_PBNAME, array( $this, 'exad_plugin_settings_action' ) );
			// Registering Elementor Widget Category
			add_action( 'elementor/elements/categories_registered', array( $this, 'exad_register_category' ) );
			// Enqueue Styles and Scripts
			add_action( 'elementor/frontend/after_register_scripts', array( $this, 'exad_enqueue_scripts' ), 20 );
			// Elementor Editor Styles
			add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'exad_editor_scripts' ) );
			// Add Elementor Widgets
			add_action( 'elementor/widgets/widgets_registered', array( $this, 'exad_init_widgets' ) );
			// Add Body Class 
			add_filter( 'body_class', array( $this, 'add_body_classes' ) );
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
			wp_enqueue_style( 'exad-frontend-editor', EXAD_URL . 'assets/css/exad-frontend-editor.css' );
			wp_enqueue_script( 'exad-editor-script', EXAD_URL . 'assets/js/exad-editor-script.js', array( 'elementor-editor' ), '1.0', true );
		}

		/**
		* Enqueue Plugin Styles and Scripts
		*
		*/
		public function exad_enqueue_scripts() {

			$is_activated_widget = $this->activated_widgets();

			wp_enqueue_style( 'exad-magnific-popup-style', EXAD_URL . 'assets/css/magnific-popup.css' );

			// Main Styles
			wp_enqueue_style( 'exad-main-style', EXAD_URL . 'assets/css/exad-styles.css' );
			
			if ( $is_activated_widget['progress-bar'] ) {
				// Progress Bar Js
				wp_register_script( 'exad-progress-bar', EXAD_URL . 'assets/js/vendor/loading-bar.js', array( 'jquery' ), '1.0', true );
				// Waypoints Js
				wp_register_script( 'exad-waypoints', EXAD_URL . 'assets/js/vendor/jquery.waypoints.min.js', array( 'jquery' ), '1.0', true );
			}
			if ( $is_activated_widget['google-maps'] ) {
				wp_register_script( 'exad-google-map-api', 'https://maps.googleapis.com/maps/api/js?key='.get_option('exad_google_map_api_option'), array('jquery'),'1.8', false );
				// Gmap 3 Js
				wp_register_script( 'exad-gmap3', EXAD_URL . 'assets/js/vendor/gmap3.min.js', array( 'jquery' ), '1.0', true );
			}	
			
			if ( $is_activated_widget['countdown-timer'] ) {
				// jQuery Countdown Js
				wp_register_script( 'exad-countdown', EXAD_URL . 'assets/js/vendor/jquery.countdown.min.js', array( 'jquery' ), '1.0', true );
			}

			if ( $is_activated_widget['image-comparison'] ) {
				// jQuery image-comparison twentytwenty Js
				wp_register_script( 'exad-image-comparison', EXAD_URL . 'assets/js/vendor/jquery.twentytwenty.js', array( 'jquery' ), '1.0', true );
				wp_register_script( 'exad-image-comparison-event', EXAD_URL . 'assets/js/vendor/jquery.event.move.js', array( 'jquery' ), '1.0', true );
			}

			if ( $is_activated_widget['counter'] ) {
				// jQuery CounterUp Js
				wp_register_script( 'exad-counter', EXAD_URL . 'assets/js/vendor/jquery.counterup.min.js', array( 'jquery' ), '1.0', true );
			}

			if ( $is_activated_widget['filterable-gallery'] ) {
				// Filterable Gallery
				wp_register_script( 'exad-gallery-isotope', EXAD_URL . 'assets/js/vendor/isotop.min.js', array( 'jquery' ), '1.0', true );
			}

			if ( $is_activated_widget['modal-popup'] ) {
				// Modal Popup
				wp_register_script( 'exad-magnific-popup', EXAD_URL . 'assets/js/vendor/jquery.magnific-popup.min.js', array( 'jquery' ), '1.0', true );
			}

			if ( $is_activated_widget['instagram-feed'] ) {
				// Instagram Gallery
				wp_register_script( 'exad-instagram', EXAD_URL . 'assets/js/vendor/instagram.min.js', array( 'jquery' ), '1.0', true );
			}

			if ( $is_activated_widget['news-ticker'] ) {
				// news ticker
				wp_register_script( 'exad-news-ticker', EXAD_URL . 'assets/js/vendor/exad-news-ticker.min.js', array( 'jquery' ), '1.0', true );
			}
			
			wp_enqueue_script( 'exad-main-script', EXAD_URL . 'assets/js/exad-scripts.js', array( 'jquery' ), '1.0', true );
			
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
		 * This function returns true for all activated modules
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
		public function exad_init_widgets() {
			
			$activated_widgets = $this->activated_widgets();

			foreach( self::$exad_default_widgets as $widget ) {
				if ( $activated_widgets[$widget] == true ) {
					if ( $widget == 'contact-form-7' ) {
						if ( function_exists( 'wpcf7' ) ) {
							include_once EXAD_ELEMENTS . $widget . '/' .$widget . '.php';
						}	
					} else {
						include_once EXAD_ELEMENTS . $widget . '/' .$widget . '.php';
					}
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
	Exclusive_Addons_Elementor::instance();


	/**
	 * 
	 * Plugin Redirect Option Added by register_activation_hook
	 * 
	 */
	function exad_plugin_redirect_option() {
		add_option( 'exad_do_update_redirect', true );
	}

	register_activation_hook( __FILE__ , 'exad_plugin_redirect_option' );

}