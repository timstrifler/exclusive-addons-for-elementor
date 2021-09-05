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

        // Facebook Load More
        add_action( 'wp_ajax_exad_facebook_feed_action', [ $this, 'exad_facebook_feed_ajax' ] );
        add_action( 'wp_ajax_nopriv_exad_facebook_feed_action', [ $this, 'exad_facebook_feed_ajax' ] );

    }

    /**
     * Facebook Feed ajax call
     *
     * @return array
     */
    public function exad_facebook_feed_ajax() {

        $security = check_ajax_referer('exclusive_addons_nonce', 'security');

        if ( true == $security && isset( $_POST['query_settings'] ) ) :
            $settings = $_POST['query_settings'];
            $loaded_item = $_POST['loaded_item'];

            $exad_facebook_feed_cache = '_' . $settings['widget_id'] . '_facebook_cache';
            $transient_key = $settings['exad_facebook_page_id'] . $exad_facebook_feed_cache;
            $facebook_feed_data = get_transient($transient_key);

            if ( false === $facebook_feed_data ) {
                $url_queries = 'fields=status_type,created_time,from,message,story,full_picture,permalink_url,attachments.limit(1){type,media_type,title,description,unshimmed_url},comments.summary(total_count),reactions.summary(total_count)';
                $url = "https://graph.facebook.com/{$settings['page_id']}/posts?{$url_queries}&access_token={$settings['access_token']}";
                $data = wp_remote_get( $url );
                $facebook_feed_data = json_decode( wp_remote_retrieve_body( $data ), true );
                set_transient( $transient_key, $facebook_feed_data, 0 );
            }
            if ( $settings['clear_cache'] == 'yes' ) {
                delete_transient( $transient_key );
            }

            switch ($settings['exad_facebook_sort_by']) {
                case 'old-posts':
                    usort($facebook_feed_data['data'], function ($a,$b) {
                        if ( strtotime($a['created_time']) == strtotime($b['created_time']) ) return 0;
                        return ( strtotime($a['created_time']) < strtotime($b['created_time']) ? -1 : 1 );
                    });
                    break;
                case 'like_count':
                    usort($facebook_feed_data['data'], function ($a,$b){
                        if ($a['reactions']['summary'] == $b['reactions']['summary']) return 0;
                        return ($a['reactions']['summary'] > $b['reactions']['summary']) ? -1 : 1 ;
                    });
                    break;
                case 'comment_count':
                    usort($facebook_feed_data['data'], function ($a,$b){
                        if ($a['comments']['summary'] == $b['comments']['summary']) return 0;
                        return ($a['comments']['summary'] > $b['comments']['summary']) ? -1 : 1 ;
                    });
                    break;
                default:
                    $facebook_feed_data;
            }


            $items = array_splice($facebook_feed_data['data'], $loaded_item, $settings['post_limit'] );

            foreach ($items as $item) :

                $page_url = "https://facebook.com/{$item['from']['id']}";
                $avatar_url = "https://graph.facebook.com/{{$item['from']['id']}/picture";

                $description = explode( ' ', $item['message'] );
                if ( !empty( $settings['description_word_count'] ) && count( $description ) > $settings['description_word_count'] ) {
                    $description_shorten = array_slice( $description, 0, $settings['description_word_count'] );
                    $description = implode( ' ', $description_shorten ) . '...';
                } else {
                    $description = $item['message'];
                }
                ?>

                <div class="exad-facebook-feed-item exad-col">

                    <?php if ( $settings['exad_facebook_show_feature_image'] == 'yes' && !empty( $item['full_picture'] ) ) : ?>
                        <div class="exad-facebook-feed-feature-image">
                            <a href="<?php echo esc_url( $item['permalink_url'] ); ?>" target="_blank">
                                <img src="<?php echo esc_url( $item['full_picture'] ); ?>" alt="<?php esc_url( $item['from']['name'] ); ?>">
                            </a>
                        </div>
                    <?php endif ?>

                    <div class="exad-facebook-inner-wrapper">

                        <div class="exad-facebook-author">
                            <?php if ( $settings['show_user_image'] == 'yes' ) : ?>
                                <a href="<?php echo esc_url( $page_url ); ?>">
                                    <img
                                        src="<?php echo esc_url( $avatar_url ); ?>"
                                        alt="<?php echo esc_attr( $item['from']['name'] ); ?>"
                                        class="exad-facebook-avatar"
                                    >
                                </a>
                            <?php endif; ?>

                            <div class="exad-facebook-user">
                                <?php if ( $settings['show_name'] == 'yes' ) : ?>
                                    <a href="<?php echo esc_url( $page_url ); ?>" class="exad-facebook-author-name">
                                        <?php echo esc_html( $item['from']['name'] ); ?>
                                    </a>
                                <?php endif; ?>

                                <?php if ( $settings['show_date'] == 'yes' ) : ?>
                                    <div class="exad-facebook-date">
                                        <?php echo esc_html( date("M d Y", strtotime( $item['created_time'] ) ) ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="exad-facebook-content">
                            <p>
                                <?php
                                echo esc_html( $description );
                                if ( $settings['read_more'] == 'yes' ) :
                                    ?>
                                    <a href="<?php echo esc_url( $item['permalink_url'] ); ?>" target="_blank">
                                        <?php echo esc_html( $settings['read_more_text'] ); ?>
                                    </a>
                                <?php endif; ?>
                            </p>
                        </div>

                    </div>

                    <?php if ( $settings['show_likes'] == 'yes' || $settings['show_comments'] == 'yes' ) : ?>
                        <div class="exad-facebook-footer-wrapper">
                            <div class="exad-facebook-footer">

                                <div class="exad-facebook-meta">
                                    <?php if ( $settings['show_likes'] == 'yes' ) : ?>
                                        <div class="exad-facebook-likes">
                                            <?php echo esc_html( $item['reactions']['summary']['total_count'] ); ?>
                                            <i class="far fa-thumbs-up"></i>
                                            <?php if( $settings['exad_facebook_show_likes_text'] == 'yes' ) { ?>
												<?php _e( 'Like', 'exclusive-addons-elementor' ); ?>
											<?php } ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ( $settings['exad_facebook_show_share'] == 'yes' ) : ?>
										<div class="exad-facebook-comments">
											<?php if( isset( $item['shares']['count'] ) && ( $item['shares']['count'] != '' ) ){ 
												echo esc_html( $item['shares']['count'] );
											} else {
												_e( '0', 'exclusive-addons-elementor' );
											} ?>
											<i class="far fa-share-square"></i>
											<?php if( 'yes' === $settings['exad_facebook_show_share_text'] ) { ?>
												<?php _e( 'Share', 'exclusive-addons-elementor' ); ?>
											<?php } ?>
										</div>
									<?php endif; ?>

                                    <?php if ( $settings['show_comments'] == 'yes' ) : ?>
                                        <div class="exad-facebook-comments">
                                            <?php echo esc_html( $item['comments']['summary']['total_count'] ); ?>
                                            <i class="far fa-comment"></i>
                                            <?php if( $settings['exad_facebook_show_comment_text'] =='yes' ) { ?>
												<?php _e( 'Comment', 'exclusive-addons-elementor' ); ?>
											<?php } ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    <?php endif; ?>

                </div>

            <?php
            endforeach;

        endif;
        wp_die();
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

        include_once EXAD_PATH . 'extensions/icons-manager.php';

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
        $settings['post_grid_image_size_size'] = $_POST['post_thumb_size'];
        $settings['exad_post_grid_show_category'] = $_POST['show_category'];
        $settings['exad_post_grid_show_user_avatar'] = $_POST['show_user_avatar'];
        $settings['exad_post_grid_show_user_name'] = $_POST['show_user_name'];
        $settings['exad_post_grid_show_user_name_tag'] = $_POST['show_user_name_tag'];
        $settings['exad_post_grid_user_name_tag'] = $_POST['user_name_tag'];
        $settings['exad_post_grid_show_date'] = $_POST['show_date'];
        $settings['exad_post_grid_show_date_tag'] = $_POST['show_date_tag'];
        $settings['exad_post_grid_date_tag'] = $_POST['date_tag'];
        $settings['exad_post_grid_show_title'] = $_POST['show_title'];
        $settings['exad_post_grid_show_title_parmalink'] = $_POST['show_title_parmalink'];
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

        $cat_array = explode(" ", $_POST['category'] );
        $tags_array = explode(" ", $_POST['tags'] );
        $exclude_array = explode(" ", $_POST['exclude_post'] );

        $post_args = array(
            'post_type'        => $_POST['post_type'],
            'posts_per_page'   => $_POST['posts_per_page'],
            'post_status'      => 'publish',
            'paged'            => $paged,
            'cat'              => $cat_array,
            'tags__in'         => $tags_array,
            'post__not_in'     => $exclude_array,
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