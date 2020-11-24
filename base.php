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
        if ( !self::$is_pro_active ) {
            add_action( 'admin_notices', [ $this, 'exad_admin_notice_pro_release' ] );
        }
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
     * Admin notice
     * Admin Notice for Pro Release
     *
     * @since 1.0.0
     *
     * @access public
     */
    function exad_admin_notice_pro_release() {

        $message = sprintf(
            __( '<span style="float:left; margin-right: 20px;"><svg xmlns="http://www.w3.org/2000/svg" width="130" viewBox="0 0 816.74 247.33"><defs><style>.cls-1{fill:#6555ff;}.cls-2{fill:#8c9093;}.cls-3{fill:#fff;}</style></defs><title>main logo</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g id="Logo_Color_normal" data-name="Logo Color normal"><rect class="cls-1" width="247.33" height="247.33" rx="123.67" ry="123.67"/><path class="cls-1" d="M299.63,64.57V83.25H323.3v11H299.63V114h26.74v11H285.24V53.55h41.13v11Z"/><path class="cls-1" d="M377.09,89.37,399.33,125H383.11l-14.7-23.47L354.74,125H338.51l22.35-35.62L338.51,53.76h16.23l14.69,23.47,13.78-23.47h16.12Z"/><path class="cls-1" d="M465.21,58.65a32.51,32.51,0,0,1,12.91,16.64H460.88q-4.8-9.39-16.33-9.39a22.29,22.29,0,0,0-11.38,2.86,19.67,19.67,0,0,0-7.71,8.16,26.17,26.17,0,0,0-2.75,12.25,26.17,26.17,0,0,0,2.75,12.25,20,20,0,0,0,7.71,8.21,22,22,0,0,0,11.38,2.91q11.42,0,16.33-9.39h17.24a32.26,32.26,0,0,1-12.91,16.59,39,39,0,0,1-39,1.22A34.36,34.36,0,0,1,413,108a36.73,36.73,0,0,1-4.85-18.83A36.54,36.54,0,0,1,413,70.44a34.7,34.7,0,0,1,13.22-13,38.72,38.72,0,0,1,39,1.22Z"/><path class="cls-1" d="M505,114.07h22.86V125H490.57V53.76H505Z"/><path class="cls-1" d="M551.7,53.76V97.64q0,7.35,3.73,11.12t10.66,3.78q6.95,0,10.72-3.78t3.78-11.12V53.76h14.28V97.64q0,9.09-4,15.41a25.47,25.47,0,0,1-10.61,9.49,32.89,32.89,0,0,1-14.44,3.17,32,32,0,0,1-14.24-3.17,24.66,24.66,0,0,1-10.36-9.49q-3.88-6.33-3.88-15.41V53.76Z"/><path class="cls-1" d="M656.67,114.89a22.44,22.44,0,0,1-8.88,7.86,29.06,29.06,0,0,1-13.42,3q-11.75,0-18.88-5.46t-7.15-15.36h15.31a10.13,10.13,0,0,0,3.11,7c1.81,1.6,4.34,2.4,7.61,2.4a11.21,11.21,0,0,0,7.75-2.56,8.46,8.46,0,0,0,2.86-6.63,7.28,7.28,0,0,0-2-5.31,13.59,13.59,0,0,0-4.9-3.16q-2.91-1.12-8.21-2.55a78.29,78.29,0,0,1-11.13-3.57,18.63,18.63,0,0,1-7.35-5.77q-3.06-3.93-3.06-10.66a20,20,0,0,1,3.22-11.28,20.7,20.7,0,0,1,8.93-7.45,30.86,30.86,0,0,1,13-2.6q11.12,0,17.86,5t7.35,15.36H642.94a9.66,9.66,0,0,0-3.06-6.48,9.81,9.81,0,0,0-6.84-2.4A10.9,10.9,0,0,0,626,66.46c-1.81,1.47-2.71,3.69-2.71,6.69a7.64,7.64,0,0,0,2,5.46,13.27,13.27,0,0,0,4.95,3.21,77.89,77.89,0,0,0,8.17,2.45,78.53,78.53,0,0,1,11.12,3.57,18.14,18.14,0,0,1,7.3,5.77q3,3.93,3,10.66A19.49,19.49,0,0,1,656.67,114.89Z"/><path class="cls-1" d="M688,53.76V125H673.56V53.76Z"/><path class="cls-1" d="M712.23,53.76l19.5,56.84,19.49-56.84h15.31L740.4,125H723.05L697,53.76Z"/><path class="cls-1" d="M790,64.57V83.25h23.68v11H790V114h26.74v11H775.61V53.55h41.13v11Z"/><path class="cls-2" d="M308.24,187.15H293.69l-2.5,7.1h-5.95l12.45-34.8h6.6l12.45,34.8h-6Zm-1.55-4.45L301,166.35l-5.75,16.35Z"/><path class="cls-2" d="M414.66,186.2a14.92,14.92,0,0,1-6.45,6,21.47,21.47,0,0,1-9.72,2.08H387.14V159.5h11.35a21.22,21.22,0,0,1,9.72,2.12,15.15,15.15,0,0,1,6.45,6.1,18.34,18.34,0,0,1,2.28,9.28A17.91,17.91,0,0,1,414.66,186.2Zm-6.85.25q3.29-3.45,3.28-9.45t-3.28-9.48q-3.27-3.42-9.32-3.42h-5.65v25.8h5.65Q404.54,189.9,407.81,186.45Z"/><path class="cls-2" d="M515.11,186.2a14.92,14.92,0,0,1-6.45,6,21.47,21.47,0,0,1-9.72,2.08H487.59V159.5h11.35a21.22,21.22,0,0,1,9.72,2.12,15.15,15.15,0,0,1,6.45,6.1,18.34,18.34,0,0,1,2.28,9.28A17.91,17.91,0,0,1,515.11,186.2Zm-6.85.25q3.28-3.45,3.28-9.45t-3.28-9.48q-3.27-3.42-9.32-3.42h-5.65v25.8h5.65Q505,189.9,508.26,186.45Z"/><path class="cls-2" d="M612.86,161.32a16.78,16.78,0,0,1,6.43,6.33,19,19,0,0,1,0,18.32,16.62,16.62,0,0,1-6.43,6.35,18.71,18.71,0,0,1-17.9,0,16.88,16.88,0,0,1-6.45-6.35,18.89,18.89,0,0,1,0-18.32,17,17,0,0,1,6.45-6.33,18.78,18.78,0,0,1,17.9,0Zm-15.12,4.48a10.87,10.87,0,0,0-4.23,4.4,15.13,15.13,0,0,0,0,13.22,11,11,0,0,0,4.23,4.45,12.76,12.76,0,0,0,12.3,0,10.92,10.92,0,0,0,4.22-4.45,15,15,0,0,0,0-13.22,10.79,10.79,0,0,0-4.22-4.4,13,13,0,0,0-12.3,0Z"/><path class="cls-2" d="M720.79,194.25h-5.7L697.94,168.3v25.95h-5.7v-34.8h5.7l17.15,25.9v-25.9h5.7Z"/><path class="cls-2" d="M815.31,189.35a10.49,10.49,0,0,1-4.17,3.8,13.64,13.64,0,0,1-6.45,1.45,14.17,14.17,0,0,1-8.75-2.55,8.31,8.31,0,0,1-3.4-7.05h6.1a5.32,5.32,0,0,0,1.7,3.65,6.3,6.3,0,0,0,4.35,1.35,6.67,6.67,0,0,0,4.62-1.5,4.92,4.92,0,0,0,1.68-3.85,4,4,0,0,0-1-2.93,6.86,6.86,0,0,0-2.57-1.65,39.71,39.71,0,0,0-4.25-1.22,35,35,0,0,1-5.5-1.68,8.75,8.75,0,0,1-3.6-2.8,8.27,8.27,0,0,1-1.5-5.22,9.48,9.48,0,0,1,1.5-5.3,9.78,9.78,0,0,1,4.2-3.55,14.63,14.63,0,0,1,6.2-1.25,13.12,13.12,0,0,1,8.22,2.4,9.19,9.19,0,0,1,3.48,7h-6.3a5.07,5.07,0,0,0-1.7-3.35,5.77,5.77,0,0,0-4-1.35,6.41,6.41,0,0,0-4.2,1.3,4.66,4.66,0,0,0-1.6,3.85,4.25,4.25,0,0,0,1,3,6.44,6.44,0,0,0,2.58,1.7,35.58,35.58,0,0,0,4.3,1.23,36.89,36.89,0,0,1,5.45,1.67,8.83,8.83,0,0,1,3.57,2.75,8.14,8.14,0,0,1,1.48,5.18A9.49,9.49,0,0,1,815.31,189.35Z"/><path class="cls-3" d="M36.69,126.74l9.59,9.59a4.33,4.33,0,0,0,6.14,0L121,67.76a3.75,3.75,0,0,1,5.33,0L179.58,121a3.77,3.77,0,0,1,0,5.33l-53.25,53.25a3.77,3.77,0,0,1-5.33,0l-4.31-4.32a3.75,3.75,0,0,1,0-5.33L160,126.6a4.33,4.33,0,0,0,0-6.14L125.85,86.29a4.35,4.35,0,0,0-6.14,0L61,145a4.36,4.36,0,0,0,0,6.15l59.55,59.55a4.36,4.36,0,0,0,6.15,0l83.91-83.91a4.36,4.36,0,0,0,0-6.15l-83.91-83.9a4.35,4.35,0,0,0-6.15,0l-83.9,83.9A4.35,4.35,0,0,0,36.69,126.74Zm55,19.07,28.89-28.89a3.13,3.13,0,0,1,4.44,0l5.28,5.28a3.13,3.13,0,0,1,0,4.44l-28.89,28.89a3.15,3.15,0,0,1-4.44,0l-5.28-5.28A3.13,3.13,0,0,1,91.67,145.81Z"/></g></g></g></svg></span>
            <span>We have released the Pro version of <b>Exclusive Addons for Elementor!</b> As of this occasion we are giving away <b>FLAT 50 Percent discount</b> on all of our packages for you. <br/> P.S. The offer will be valid till November 15th, 2020. %1$s</span>', 'exclusive-addons-elementor' ),
            '<a href="https://exclusiveaddons.com/pricing" target="_blank">' . __( 'Grab the offer before it ends.', 'exclusive-addons-elementor' ) . '</a>'
        );

        printf( '<div class="notice notice-success is-dismissible"><p style="padding: 5px 0">%1$s</p></div>', $message );

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