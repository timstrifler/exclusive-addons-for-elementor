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
     * Check to See if Pro version is enabled
     */
    public static $is_pro_active;

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
        // Look for Pro Version
        self::$is_pro_active = apply_filters( 'exad/pro_activated', false );
        $this->includes();
        //$this->extensions_map_free();     
        //$this->activated_features(); 
        $this->register_hooks();
        $this->exclusive_addons_appsero_init();
        //$this->extention_manager();

        if ( is_user_logged_in() ) {
			Template_Library_Manager::init();
        }
        
    }

    // register hooks
    public function register_hooks() {

        if ( is_admin() ) {

            add_filter( 'plugin_action_links_' . EXAD_PBNAME, [ $this, 'insert_go_pro_url' ] );

            add_action( 'admin_init', [ $this, 'plugin_redirect_hook' ] );

        }

        // Exclusive Addons Elementor activated checking hook
        do_action( 'exad/exclusive_addons_active' );
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
        // Register controls
		add_action( 'elementor/controls/controls_registered', [ $this, 'register_controls' ] );
        // Add Body Class 
        add_filter( 'body_class', [ $this, 'add_body_classes' ] );

        // ajax load more hook
        add_action( 'wp_ajax_ajax_pagination', [ __CLASS__, 'exad_ajax_pagination' ] );
        add_action( 'wp_ajax_nopriv_ajax_pagination', [ __CLASS__, 'exad_ajax_pagination' ] );

    }


    /**
     * 
     * Including necessary assets
     * @since 1.0.2
     */
    public function includes() {
        include_once EXAD_PATH . 'includes/widgets-manager-class.php';
        include_once EXAD_PATH . 'includes/helper-class.php';
        if( is_admin() ) {
            include_once EXAD_PATH . 'admin/dashboard-settings.php';
        }
        if ( is_user_logged_in() ) {
            include_once EXAD_PATH . 'library/library_manager.class.php' ;
            include_once EXAD_PATH . 'library/library_source.class.php' ;   
        }
    }

    public function i18n() {
        // Load Plugin textdomain
        load_plugin_textdomain( 'exclusive-addons-elementor' );
    }

    /**
     * 
     * Register Exclusive Addons Elementor category
     *
     */
    public function register_category( $elements_manager ) {

        $elements_manager->add_category(
            'exclusive-addons-elementor',
            [
                'title' => __( 'Exclusive Addons', 'exclusive-addons-elementor' ),
                'icon' => 'font',
            ]
        );
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

        $client = new \Appsero\Client( 'c3e3c997-fabf-42ad-bbd9-15cba7ab18ca', 'Exclusive Addons for Elementor', __FILE__ );

        // Active insights
        $client->insights()->init();

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
        wp_enqueue_style( 'exad-frontend-editor', EXAD_ASSETS_URL . 'css/exad-frontend-editor.min.css' );
        wp_enqueue_style( 'exad-template-library-style', EXAD_ASSETS_URL . 'css/template-library.css', [ 'elementor-editor' ], EXAD_PLUGIN_VERSION );
        wp_enqueue_script( 'exad-template-library-script', EXAD_ASSETS_URL . 'js/template-library.js', [ 'elementor-editor', 'jquery-hover-intent' ], EXAD_PLUGIN_VERSION, true );

		$localized_data = [
			'i18n' => [
				'templatesEmptyTitle' => esc_html__( 'No Templates Found', 'exclusive-addons-elementor' ),
				'templatesEmptyMessage' => esc_html__( 'Try different category or sync for new templates.', 'exclusive-addons-elementor' ),
				'templatesNoResultsTitle' => esc_html__( 'No Results Found', 'exclusive-addons-elementor' ),
				'templatesNoResultsMessage' => esc_html__( 'Please make sure your search is spelled correctly or try a different word.', 'exclusive-addons-elementor' ),
			]
	
		];

        wp_localize_script( 'exad-template-library-script', 'ExclusiveAddonsEditor', $localized_data );
    }

    /**
    * Enqueue Plugin Styles and Scripts
    *
    */
    public function enqueue_scripts() {

        if ( $this->is_activated_feature['progress-bar'] ) {
            // Loading Bar JS
            wp_register_script( 'exad-progress-bar', EXAD_ASSETS_URL . 'vendor/js/exad-progress-bar-vendor.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
            
            // Waypoints JS
            wp_register_script( 'exad-waypoints', EXAD_ASSETS_URL . 'vendor/js/jquery.waypoints.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }
        // Google Map js
        if ( $this->is_activated_feature['google-maps'] ) {
            if ( '' != get_option('exad_google_map_api_option') ) {
                wp_register_script( 'exad-google-map-api', 'https://maps.googleapis.com/maps/api/js?key='.get_option('exad_google_map_api_option'), array(), EXAD_PLUGIN_VERSION, false );
            }
            // Gmap 3 Js
            wp_register_script( 'exad-gmap3', EXAD_ASSETS_URL . 'vendor/js/gmap3.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );            
        }	
        
        if ( $this->is_activated_feature['countdown-timer'] ) {
            // jQuery Countdown Js
            wp_register_script( 'exad-countdown', EXAD_ASSETS_URL . 'vendor/js/jquery.countdown.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }

        if ( $this->is_activated_feature['image-comparison'] ) {
            // jQuery image-comparison twentytwenty Js
            wp_register_script( 'exad-image-comparison', EXAD_ASSETS_URL . 'vendor/js/exad-comparison-vendor.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }

        if ( $this->is_activated_feature['filterable-gallery'] ) {
            // Filterable Gallery
            wp_register_script( 'exad-gallery-isotope', EXAD_ASSETS_URL . 'vendor/js/isotop.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }

        if ( $this->is_activated_feature['news-ticker'] ) {
            // News ticker
            wp_register_script( 'exad-news-ticker', EXAD_ASSETS_URL . 'vendor/js/exad-news-ticker.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }
        
        if ( $this->is_activated_feature['animated-text'] ) {
            // Animated Text
            wp_register_script( 'exad-animated-text', EXAD_ASSETS_URL . 'vendor/js/typed.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }	
        if ( $this->is_activated_feature['post-grid'] ) {
            // Post grid
            wp_register_script( 'exad-post-grid', EXAD_ASSETS_URL . 'vendor/js/jquery.matchHeight.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
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
            wp_enqueue_style( 'exad-rtl-style', EXAD_ASSETS_URL . 'css/exad-rtl-styles.min.css' );            
        }

        // Main Plugin Scripts
        wp_enqueue_script( 'exad-main-script', EXAD_ASSETS_URL . 'js/exad-scripts.min.js', array('jquery'), EXAD_PLUGIN_VERSION, true );

        wp_localize_script( 'exad-main-script', 'exad_ajax_object', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
        ));
    }

    // Ajax Load More For Post Grid
    public static function exad_ajax_pagination() {

        $paged = $_POST['paged'];

        $settings = [];
        $settings['exad_post_grid_category_default_position'] = $_POST['category_default_position'];
        $settings['exad_post_grid_category_position_over_image'] = $_POST['category_position_over_image'];
        $settings['exad_post_grid_image_align'] = $_POST['image_align'];
        $settings['exad_post_grid_equal_height'] = $_POST['equal_height'];
        $settings['exad_post_grid_show_image'] = $_POST['post_thumbnail'];
        $settings['exad_post_grid_show_category'] = $_POST['show_category'];
        $settings['exad_post_grid_show_user_avatar'] = $_POST['show_user_avatar'];
        $settings['exad_post_grid_show_user_name'] = $_POST['show_user_name'];
        $settings['exad_post_grid_show_user_name_tag'] = $_POST['show_user_name_tag'];
        $settings['exad_post_grid_user_name_tag'] = $_POST['user_name_tag'];
        $settings['exad_post_grid_show_date'] = $_POST['show_date'];
        $settings['exad_post_grid_show_date_tag'] = $_POST['show_date_tag'];
        $settings['exad_post_grid_date_tag'] = $_POST['date_tag'];
        $settings['exad_post_grid_show_title'] = $_POST['show_title'];
        $settings['exad_post_grid_title_full'] = $_POST['title_full'];
        $settings['exad_grid_title_length'] = $_POST['title_length'];
        $settings['exad_post_grid_show_read_time'] = $_POST['show_read_time'];
        $settings['exad_post_grid_show_comment'] = $_POST['show_comment'];
        $settings['exad_post_grid_show_excerpt'] = $_POST['show_excerpt'];
        $settings['exad_grid_excerpt_length'] = $_POST['excerpt_length'];
        $settings['exad_post_grid_read_more_btn_text'] = $_POST['details_btn_text'];
        $settings['exad_post_grid_show_read_more_btn'] = $_POST['enable_details_btn'];
        $settings['exad_post_grid_post_data_position'] = $_POST['post_data_position'];

        $post_args = array(
            'post_type'        => $_POST['post_type'],
            'posts_per_page'   => $_POST['posts_per_page'],
            'post_status'      => 'publish',
            'paged'            => $paged,
        );

        $posts = new \WP_Query( $post_args );

        $result = '';

        while( $posts->have_posts() ) : $posts->the_post(); 
            ob_start();

            include EXAD_TEMPLATES . 'tmpl-post-grid.php';
            $result .= ob_get_contents();
            ob_end_clean();

        endwhile;
        wp_reset_postdata();

        wp_send_json($result);
        wp_die();
    }

    


    /**
     * Extending plugin links
     *
     * @since 3.0.0
     */
    public function insert_go_pro_url( $links ) {
        // settings
        $links[] = sprintf('<a href="admin.php?page=exad-settings">' . __('Settings', 'exclusive-addons-elementor') . '</a>');

        // go pro
        if ( !self::$is_pro_active ) {
            $links[] = sprintf('<a href="https://exclusiveaddons.com/" class="exad-go-pro" target="_blank">' . __('Go Pro', 'exclusive-addons-elementor') . '</a>');
        }

        return $links;
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
     * 
     * Registering Custom Image Mask Control
     * 
     */
    public function register_controls() {

		$controls_manager = \Elementor\Plugin::$instance->controls_manager;
		$controls_manager->register_control( 'svg-selector', new Image_Mask_SVG_Control() );

	}


}