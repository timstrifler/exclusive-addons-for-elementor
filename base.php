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
        $this->register_hooks();
        $this->exclusive_addons_appsero_init();
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
        include_once EXAD_PATH . 'includes/helper-class.php';
        include_once EXAD_PATH . 'includes/addons-manager-class.php';
        include_once EXAD_PATH . 'includes/assets-manager-class.php';
        if( is_admin() ) {
            include_once EXAD_PATH . 'admin/dashboard-settings.php';
        }
        if ( is_user_logged_in() ) {
            include_once EXAD_PATH . 'library/library-manager.class.php' ;
            include_once EXAD_PATH . 'library/library-source.class.php' ;   
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
        $settings['exad_post_grid_offset'] = (int)$_POST['offset'] + ( ( (int)$paged - 1 ) * (int)$_POST['posts_per_page'] );

        $post_args = array(
            'post_type'        => $_POST['post_type'],
            'posts_per_page'   => $_POST['posts_per_page'],
            'post_status'      => 'publish',
            'paged'            => $paged,
            'category__in'     => $_POST['category'],
            'tags__in'     => $_POST['tags'],
            'offset'           => (int)$_POST['offset'] + ( ( (int)$paged - 1 ) * (int)$_POST['posts_per_page'] )
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