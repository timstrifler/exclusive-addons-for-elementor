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
     * 
     * Static property that consists all the default widget array
     * 
     * @access public
     * @static
     * 
     * @return array
     */
    public static $default_widgets = []; 


    /**
     * 
     * Static property that consists all the default extensions array
     * 
     * @access public
     * @static
     * 
     * @return array
     */
    public static $default_extensions = []; 

    /**
     * 
     * Static property to hold all widget names in an array
     * 
     * @access public
     * @static
     * 
     * 
     */
    public static $all_activated_features;

    /**
     * 
     * Static property to hold default settings for the database
     * 
     * @access public
     * @static
     * 
     * 
     */
    public static $widget_settings;
    /**
     * 
     * Static property that consits all active widgets
     * 
     * @access public
     * @static
     * 
     * 
     */
    public $is_activated_widget;

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
        $this->widget_map_free(); 
        $this->extensions_map_free();     
        $this->activated_features(); 
        $this->register_hooks();
        $this->exclusive_addons_appsero_init();

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
        // Add Elementor Widgets
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'initiate_widgets' ] );
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
        // Helper Class
        include_once EXAD_PATH . 'includes/helper-class.php';
        include_once EXAD_PATH . 'extensions/image-mask-svg-control.php';
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
     * 
     * Initiate Elements name from folder created inside elements
     * 
     * @since 1.2.2
     */
    public function widget_map_free() {

        $widget_lists = [
            'accordion'  => [
                'title'  => __( 'Accordion', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Accordion',
                'demo_link' => 'https://exclusiveaddons.com/accordion-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'alert'  => [
                'title'  => __( 'Alert', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Alert',
                'demo_link' => 'https://exclusiveaddons.com/alert-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'animated-text'  => [
                'title'  => __( 'Animated Text', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Animated_Text',
                'demo_link' => 'https://exclusiveaddons.com/animated-text-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'button'  => [
                'title'  => __( 'Button', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Button',
                'demo_link' => 'https://exclusiveaddons.com/button-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'call-to-action'  => [
                'title'  => __( 'Call To Action', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Call_To_Action',
                'demo_link' => 'https://exclusiveaddons.com/call-to-action-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'card'  => [
                'title'  => __( 'Card', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Card',
                'demo_link' => 'https://exclusiveaddons.com/card-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'contact-form-7'  => [
                'title'  => __( 'Contact Form 7', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Contact_Form_7',
                'demo_link' => 'https://exclusiveaddons.com/contact-form-7-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'countdown-timer'  => [
                'title'  => __( 'Countdown Timer', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Countdown_Timer',
                'demo_link' => 'https://exclusiveaddons.com/countdown-timer-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'covid-19-stats'  => [
                'title'  => __( 'Covid-19 Stats', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Covid_19_Stats',
                'demo_link' => 'https://exclusiveaddons.com/covid-19-stats-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'dual-button'  => [
                'title'  => __( 'Dual Button', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Dual_Button',
                'demo_link' => 'https://exclusiveaddons.com/dual-button-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'dual-heading'  => [
                'title'  => __( 'Dual Heading', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Dual_Heading',
                'demo_link' => 'https://exclusiveaddons.com/dual-heading-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'filterable-gallery'  => [
                'title'  => __( 'Filterable Gallery', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Filterable_Gallery',
                'demo_link' => 'https://exclusiveaddons.com/filterable-gallery-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'flipbox'  => [
                'title'  => __( 'Flip Box', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Flipbox',
                'demo_link' => 'https://exclusiveaddons.com/flipbox-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'google-maps'  => [
                'title'  => __( 'Google Maps', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Google_Maps',
                'demo_link' => 'https://exclusiveaddons.com/google-map-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'heading'  => [
                'title'  => __( 'Heading', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Heading',
                'demo_link' => 'https://exclusiveaddons.com/heading-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'image-comparison'  => [
                'title'  => __( 'Image Comparison', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Image_Comparison',
                'demo_link' => 'https://exclusiveaddons.com/image-comparison-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'image-magnifier'  => [
                'title'  => __( 'Image Magnifier', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Image_Magnifier',
                'demo_link' => 'https://exclusiveaddons.com/image-magnifier-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'infobox'  => [
                'title'  => __( 'Info Box', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Infobox',
                'demo_link' => 'https://exclusiveaddons.com/infobox-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'logo-box'  => [
                'title'  => __( 'Logo Box', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Logo_Box',
                'demo_link' => 'https://exclusiveaddons.com/logo-box-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'logo-carousel'  => [
                'title'  => __( 'Logo Carousel', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Logo_Carousel',
                'demo_link' => 'https://exclusiveaddons.com/logo-carousel-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'modal-popup'  => [
                'title'  => __( 'Modal Popup', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Modal_Popup',
                'demo_link' => 'https://exclusiveaddons.com/modal-popup-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'news-ticker'  => [
                'title'  => __( 'News Ticker', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\News_Ticker',
                'demo_link' => 'https://exclusiveaddons.com/news-ticker-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'post-grid'  => [
                'title'  => __( 'Post Grid', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Post_Grid',
                'demo_link' => 'https://exclusiveaddons.com/postgrid-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'post-timeline'  => [
                'title'  => __( 'Post Timeline', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Post_Timeline',
                'demo_link' => 'https://exclusiveaddons.com/post-timeline-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'pricing-menu'  => [
                'title'  => __( 'Pricing Menu', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Pricing_Menu',
                'demo_link' => 'https://exclusiveaddons.com/pricing-menu-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'pricing-table'  => [
                'title'  => __( 'Pricing Table', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Pricing_Table',
                'demo_link' => 'https://exclusiveaddons.com/pricing-table-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'progress-bar'  => [
                'title'  => __( 'Progress Bar', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Progress_Bar',
                'demo_link' => 'https://exclusiveaddons.com/progress-bar-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'tabs'  => [
                'title'  => __( 'Tabs', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Tabs',
                'demo_link' => 'https://exclusiveaddons.com/tabs-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'team-member'  => [
                'title'  => __( 'Team Member', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Team_Member',
                'demo_link' => 'https://exclusiveaddons.com/team-member-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'testimonial'  => [
                'title'  => __( 'Testimonial', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Testimonial',
                'demo_link' => 'https://exclusiveaddons.com/testimonial-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ],
            'tooltip'  => [
                'title'  => __( 'Tooltip', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Tooltip',
                'demo_link' => 'https://exclusiveaddons.com/tooltip-demo/',
                'tags'   => 'free',
                'is_pro' => false
            ]
                
        ];

        if ( self::$is_pro_active ) {
            self::$default_widgets = apply_filters( 'exad_add_pro_widgets', $widget_lists );
        } else {
            self::$default_widgets = array_merge( $widget_lists, $this->widget_map_pro() );
        }

    }

    public function widget_map_pro() {
        return [
            'animated-shape'  => [
                'title'  => __( 'Animated Shape', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Animated_Shape',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'blob-maker'  => [
                'title'  => __( 'Blob Maker', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Blob_Maker',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'breadcrumb'  => [
                'title'  => __( 'Breadcrumb', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Breadcrumb',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'business-hours'  => [
                'title'  => __( 'Business Hours', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Business_Hours',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'chart'  => [
                'title'  => __( 'Chart', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Chart',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'comparison-table'  => [
                'title'  => __( 'Comparison Table', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Comparison_Table',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'content-switcher'  => [
                'title'  => __( 'Content Switcher', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Content_Switcher',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'cookie-consent'  => [
                'title'  => __( 'Cookie Consent', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Cookie_Consent',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'counter'  => [
                'title'  => __( 'Counter', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Counter',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'gravity-form'  => [
                'title'  => __( 'Gravity Form', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Gravity_Form',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'iconbox'  => [
                'title'  => __( 'Iconbox', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Iconbox',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'image-carousel'  => [
                'title'  => __( 'Image Carousel', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Image_Carousel',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'image-hotspot'  => [
                'title'  => __( 'Image Hotspot', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Image_Hotspot',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'image-mask'  => [
                'title'  => __( 'Image Mask', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Image_Mask',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'instagram-feed'  => [
                'title'  => __( 'Instagram Feed', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Instagram_Feed',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'login-register'  => [
                'title'  => __( 'Login/Register Form', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Login_Register',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'mailchimp'  => [
                'title'  => __( 'MailChimp', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\MailChimp',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'navigation-menu'  => [
                'title'  => __( 'Navigation Menu', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Navigation_Menu',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'news-ticker-pro'  => [
                'title'  => __( 'News Ticker', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\News_Ticker_Pro',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'off-canvas'  => [
                'title'  => __( 'Off Canvas', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Off_Canvas',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'post-carousel'  => [
                'title'  => __( 'Post Carousel', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Post_Carousel',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'post-navigation'  => [
                'title'  => __( 'Post Navigation', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Post_Navigation',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'post-slider'  => [
                'title'  => __( 'Post Slider', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Post_Slider',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'promo-box'  => [
                'title'  => __( 'Promo Box', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Promo_Box',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'social-share'  => [
                'title'  => __( 'Social Share', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Social_Share',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'slider'  => [
                'title'  => __( 'Slider', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Slider',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'source-code'  => [
                'title'  => __( 'Source Code', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Source_Code',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'table'  => [
                'title'  => __( 'Table', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Table',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'team-carousel'  => [
                'title'  => __( 'Team Carousel', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Team_Carousel',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'testimonial-carousel'  => [
                'title'  => __( 'Testimonial Carousel', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Testimonial_Carousel',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'demo-previewer'  => [
                'title'  => __( 'Demo Previewer', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Demo_Previewer',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'woo-category'  => [
                'title'  => __( 'Woo category', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Woo_Category',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'woo-products'  => [
                'title'  => __( 'Woo Products', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Woo_Products',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
        ];
    }

    public function extensions_map_free() {
        $extensions = [];

        if ( self::$is_pro_active ) {
            self::$default_extensions = apply_filters( 'exad_add_pro_extensions', $extensions );
        } else {
            self::$default_extensions = array_merge( $extensions, $this->extensions_map_pro() );
        }

    }

    public function extensions_map_pro() {
        return [
            'section-particles'  => [
                'title'  => __( 'Section Particles', 'exclusive-addons-elementor' ),
                'class'  => '\Exclusive_Addons\Elementor\Extensions\Section_Particles',
                'tags'   => 'pro',
                'demo_link' => 'https://exclusiveaddons.com/accordion-demo/',
                'is_pro' => true
            ],
            'section-parallax'  => [
                'title'  => __( 'Section Parallax', 'exclusive-addons-elementor' ),
                'class'  => '\Exclusive_Addons\Elementor\Extensions\Section_Parallax',
                'tags'   => 'pro',
                'demo_link' => 'https://exclusiveaddons.com/alert-demo/',
                'is_pro' => true
            ],
            'gradient-animation'  => [
                'title'  => __( 'Gradient Animation', 'exclusive-addons-elementor' ),
                'class'  => '\Exclusive_Addons\Elementor\Extensions\Gradient_Animation',
                'tags'   => 'pro',
                'demo_link' => 'https://exclusiveaddons.com/animated-text-demo/',
                'is_pro' => true
            ] 
        ];
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

        if ( $this->is_activated_widget['progress-bar'] ) {
            // Loading Bar JS
            wp_register_script( 'exad-progress-bar', EXAD_ASSETS_URL . 'vendor/js/exad-progress-bar-vendor.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
            
            // Waypoints JS
            wp_register_script( 'exad-waypoints', EXAD_ASSETS_URL . 'vendor/js/jquery.waypoints.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }
        // Google Map js
        if ( $this->is_activated_widget['google-maps'] ) {
            if ( '' != get_option('exad_google_map_api_option') ) {
                wp_register_script( 'exad-google-map-api', 'https://maps.googleapis.com/maps/api/js?key='.get_option('exad_google_map_api_option'), array(), EXAD_PLUGIN_VERSION, false );
            }
            // Gmap 3 Js
            wp_register_script( 'exad-gmap3', EXAD_ASSETS_URL . 'vendor/js/gmap3.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );            
        }	
        
        if ( $this->is_activated_widget['countdown-timer'] ) {
            // jQuery Countdown Js
            wp_register_script( 'exad-countdown', EXAD_ASSETS_URL . 'vendor/js/jquery.countdown.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }

        if ( $this->is_activated_widget['image-comparison'] ) {
            // jQuery image-comparison twentytwenty Js
            wp_register_script( 'exad-image-comparison', EXAD_ASSETS_URL . 'vendor/js/exad-comparison-vendor.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }

        if ( $this->is_activated_widget['filterable-gallery'] ) {
            // Filterable Gallery
            wp_register_script( 'exad-gallery-isotope', EXAD_ASSETS_URL . 'vendor/js/isotop.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }

        if ( $this->is_activated_widget['news-ticker'] ) {
            // News ticker
            wp_register_script( 'exad-news-ticker', EXAD_ASSETS_URL . 'vendor/js/exad-news-ticker.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }
        
        if ( $this->is_activated_widget['animated-text'] ) {
            // Animated Text
            wp_register_script( 'exad-animated-text', EXAD_ASSETS_URL . 'vendor/js/typed.min.js', array( 'jquery' ), EXAD_PLUGIN_VERSION, true );
        }	
        if ( $this->is_activated_widget['post-grid'] ) {
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
     * This function returns true for all activated widgets
     *
    * @since  1.0
    */
    public function activated_features() {
        self::$all_activated_features = array_merge( array_keys( self::$default_widgets ), array_keys( self::$default_extensions ) );
        self::$widget_settings  = array_fill_keys( self::$all_activated_features, true );
        $this->is_activated_widget = get_option( 'exad_save_settings', self::$widget_settings );
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

        ksort( self::$default_widgets );
        foreach( self::$default_widgets as $key => $widget ) {
            if ( $this->is_activated_widget[$key] == true ) {

                $widget_file = EXAD_ELEMENTS . $key . '/'. $key .'.php';
                if ( file_exists( $widget_file ) ) {
                    require_once $widget_file;
                }

                if ( class_exists( $widget['class'] ) ) {
                    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $widget['class'] );
                }
            }
        }

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