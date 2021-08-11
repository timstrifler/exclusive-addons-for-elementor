<?php
namespace ExclusiveAddons\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use ExclusiveAddons\Elementor\Base;

class Addons_Manager {

    public $extensions_data = [];

    /**
     * 
     * Static property to hold all widget names in an array
     * 
     * @access public
     * @static
     * 
     * 
     */
    public static $all_feature_array;

    /**
     * 
     * Static property to hold default settings for the database
     * 
     * @access public
     * @static
     * 
     * 
     */
    public static $all_feature_settings;
    /**
     * 
     * Static property that consits all active widgets
     * 
     * @access public
     * @static
     * 
     * 
     */
    public static $is_activated_feature;

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
	 * Initialize
	 */
	public static function init() {
        self::widget_manager();
        self::extension_manager();
        self::activated_features();
        add_action( 'elementor/widgets/widgets_registered', [ __CLASS__, 'initiate_widgets' ] );
        self::initiate_extensions();
    }


    public static function widget_manager() {
        if ( Base::$is_pro_active ) {
            self::$default_widgets = apply_filters( 'exad_add_pro_widgets', self::widget_map_free() );
        } else {
            self::$default_widgets = array_merge( self::widget_map_free(), self::widget_map_pro() );
        }
    }

    /**
     * 
     * Including extention assets
     * @since 2.1.5
     */
    public static function extension_manager() {
        if ( Base::$is_pro_active ) {
            self::$default_extensions = apply_filters( 'exad_add_pro_extensions', self::extensions_map_free() );
        } else {
            self::$default_extensions = array_merge( self::extensions_map_free(), self::extensions_map_pro() );
        }
    }


    public static function initiate_extensions() {
        include_once EXAD_PATH . 'extensions/image-mask-svg-control.php';

        foreach( self::extensions_map_free() as $key => $extension ) {
            if ( isset( self::$is_activated_feature[$key] ) && self::$is_activated_feature[$key] == true ) {

                $extension_file = EXAD_EXTENSIONS . $key .'.php';
                if ( file_exists( $extension_file ) ) {
                    include_once $extension_file;
                }
            }
        }

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
    public static function initiate_widgets() {

        ksort( self::$default_widgets );
        foreach( self::$default_widgets as $key => $widget ) {
            if ( isset( self::$is_activated_feature[$key] ) && self::$is_activated_feature[$key] == true ) {

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
     * This function returns true for all activated widgets
     *
    * @since  1.0
    */
    public static function activated_features() {
        self::$all_feature_array = array_merge( array_keys( self::$default_widgets ), array_keys( self::$default_extensions ) );
        self::$all_feature_settings  = array_fill_keys( self::$all_feature_array, true );
        self::$is_activated_feature = get_option( 'exad_save_settings', self::$all_feature_settings );
    }


    /**
     * 
     * Initiate Elements name from folder created inside elements
     * 
     * @since 1.2.2
     */
    public static function widget_map_free() {

        return [
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
            'facebook-feed'  => [
                'title'  => __( 'Facebook Feed', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Facebook_Feed',
                'demo_link' => 'https://exclusiveaddons.com/facebook-feed/',
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
            'filterable-post'  => [
                'title'  => __( 'Filterable Post', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Filterable_Post',
                'demo_link' => 'https://exclusiveaddons.com/filterable-post-demo/',
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
            'google-reviews'  => [
                'title'  => __( 'Google Reviews', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Google_Reviews',
                'demo_link' => 'https://exclusiveaddons.com/google-reviews-demo/',
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
            'list-group'  => [
                'title'  => __( 'List Group', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\List_group',
                'demo_link' => 'https://exclusiveaddons.com/list-group/',
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

    }

    public static function widget_map_pro() {
        return [
            'animated-shape'  => [
                'title'  => __( 'Animated Shape', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Animated_Shape',
                'demo_link' => 'https://exclusiveaddons.com/animated-shape/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'author-box'  => [
                'title'  => __( 'Author Box', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Author_Box',
                'demo_link' => 'https://exclusiveaddons.com/author-box/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'floating-animation'  => [
                'title'  => __( 'Floating Animation', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Floating_Animation',
                'demo_link' => 'https://exclusiveaddons.com/floating-animation/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'breadcrumb'  => [
                'title'  => __( 'Breadcrumb', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Breadcrumb',
                'demo_link' => 'https://exclusiveaddons.com/exclusive-addons/breadcrumb/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'business-hours'  => [
                'title'  => __( 'Business Hours', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Business_Hours',
                'demo_link' => 'https://exclusiveaddons.com/business-hours/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'chart'  => [
                'title'  => __( 'Chart', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Chart',
                'demo_link' => 'https://exclusiveaddons.com/chart/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'comparison-table'  => [
                'title'  => __( 'Comparison Table', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Comparison_Table',
                'demo_link' => 'https://exclusiveaddons.com/comparison-table/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'content-switcher'  => [
                'title'  => __( 'Content Switcher', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Content_Switcher',
                'demo_link' => 'https://exclusiveaddons.com/content-switcher/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'cookie-consent'  => [
                'title'  => __( 'Cookie Consent', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Cookie_Consent',
                'demo_link' => 'https://exclusiveaddons.com/cookie-consent/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'counter'  => [
                'title'  => __( 'Counter', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Counter',
                'demo_link' => 'https://exclusiveaddons.com/counter/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'demo-previewer'  => [
                'title'  => __( 'Demo Previewer', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Demo_Previewer',
                'demo_link' => 'https://exclusiveaddons.com/demo-previewer/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'gravity-form'  => [
                'title'  => __( 'Gravity Form', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Gravity_Form',
                'demo_link' => 'https://exclusiveaddons.com/gravity-form/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'iconbox'  => [
                'title'  => __( 'Icon Box', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Iconbox',
                'demo_link' => 'https://exclusiveaddons.com/icon-box/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'image-carousel'  => [
                'title'  => __( 'Image Carousel', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Image_Carousel',
                'demo_link' => 'https://exclusiveaddons.com/image-carousel/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'image-hotspot'  => [
                'title'  => __( 'Image Hotspot', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Image_Hotspot',
                'demo_link' => 'https://exclusiveaddons.com/image-hotspot/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'image-mask'  => [
                'title'  => __( 'Image Mask', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Image_Mask',
                'demo_link' => 'https://exclusiveaddons.com/image-mask/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'instagram-feed'  => [
                'title'  => __( 'Instagram Feed', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Instagram_Feed',
                'demo_link' => 'https://exclusiveaddons.com/instagram-feed/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'login-register'  => [
                'title'  => __( 'Login Form', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Login_Register',
                'demo_link' => 'https://exclusiveaddons.com/login-register/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'lottie-animation'  => [
                'title'  => __( 'Lottie Animation', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Lottie_Animation',
                'demo_link' => 'https://exclusiveaddons.com/lottie-animation/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'mailchimp'  => [
                'title'  => __( 'MailChimp', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\MailChimp',
                'demo_link' => 'https://exclusiveaddons.com/mailchimp/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'mega-menu'  => [
                'title'  => __( 'Mega Menu', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Mega_Menu',
                'demo_link' => 'https://exclusiveaddons.com/mega-menu/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'navigation-menu'  => [
                'title'  => __( 'Navigation Menu', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Navigation_Menu',
                'demo_link' => 'https://exclusiveaddons.com/navigation-menu/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'news-ticker-pro'  => [
                'title'  => __( 'News Ticker', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\News_Ticker_Pro',
                'demo_link' => 'https://exclusiveaddons.com/news-tricker-pro/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'off-canvas'  => [
                'title'  => __( 'Off Canvas', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Off_Canvas',
                'demo_link' => 'https://exclusiveaddons.com/off-canvas/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'page-title'  => [
                'title'  => __( 'Page Title', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Page_Title',
                'demo_link' => 'https://exclusiveaddons.com/page-title/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'post-carousel'  => [
                'title'  => __( 'Post Carousel', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Post_Carousel',
                'demo_link' => 'https://exclusiveaddons.com/post-carousel/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'post-navigation'  => [
                'title'  => __( 'Post Navigation', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Post_Navigation',
                'demo_link' => 'https://exclusiveaddons.com/post-navigation/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'post-slider'  => [
                'title'  => __( 'Post Slider', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Post_Slider',
                'demo_link' => 'https://exclusiveaddons.com/post-slider/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'campaign'  => [
                'title'  => __( 'Campaign', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Campaign',
                'demo_link' => 'https://exclusiveaddons.com/campaign/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'search-form'  => [
                'title'  => __( 'Search Form', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Search_Form',
                'demo_link' => 'https://exclusiveaddons.com/search/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'site-logo'  => [
                'title'  => __( 'Site Logo', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Site_Logo',
                'demo_link' => 'https://exclusiveaddons.com/site-logo/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'site-title'  => [
                'title'  => __( 'Site Title', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Site_Title',
                'demo_link' => 'https://exclusiveaddons.com/site-title/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'site-title'  => [
                'title'  => __( 'Site Title', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Site_Title',
                'demo_link' => 'https://exclusiveaddons.com/site-title/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'site-tagline'  => [
                'title'  => __( 'Site Tagline', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Site_Tagline',
                'demo_link' => 'https://exclusiveaddons.com/site-tagline/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'social-share'  => [
                'title'  => __( 'Social Share', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Social_Share',
                'demo_link' => 'https://exclusiveaddons.com/social-share/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'slider'  => [
                'title'  => __( 'Slider', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Slider',
                'demo_link' => 'https://exclusiveaddons.com/slider/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'source-code'  => [
                'title'  => __( 'Source Code', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Source_Code',
                'demo_link' => 'https://exclusiveaddons.com/source-code/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'table'  => [
                'title'  => __( 'Table', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Table',
                'demo_link' => 'https://exclusiveaddons.com/table/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'team-carousel'  => [
                'title'  => __( 'Team Carousel', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Team_Carousel',
                'demo_link' => 'https://exclusiveaddons.com/team-carousel/',
                'tags'   => 'pro',
                'is_pro' => true
            ], 
            'template'  => [
                'title'  => __( 'Template', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Template',
                'demo_link' => 'https://exclusiveaddons.com/template/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'testimonial-carousel'  => [
                'title'  => __( 'Testimonial Carousel', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Testimonial_Carousel',
                'demo_link' => 'https://exclusiveaddons.com/testimonial-carousel/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'woo-my-account'  => [
                'title'  => __( 'Woo My Account', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\WC_My_Account',
                'demo_link' => 'https://exclusiveaddons.com/shop',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'woo-add-to-cart'  => [
                'title'  => __( 'Woo Mini Cart', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Woo_Mini_Cart',
                'demo_link' => 'https://exclusiveaddons.com/woo-add-to-cart',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'woo-cart'  => [
                'title'  => __( 'Woo Cart', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Woo_Cart',
                'demo_link' => 'https://exclusiveaddons.com/shop',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'woo-category'  => [
                'title'  => __( 'Woo Category', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Woo_Category',
                'demo_link' => 'https://exclusiveaddons.com/woo-category/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'woo-checkout'  => [
                'title'  => __( 'Woo Checkout', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Woo_Checkout',
                'demo_link' => 'https://exclusiveaddons.com/shop',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'woo-products'  => [
                'title'  => __( 'Woo Products', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Woo_Products',
                'demo_link' => 'https://exclusiveaddons.com/woo-product/',
                'tags'   => 'pro',
                'is_pro' => true
            ],
            'woo-products-carousel'  => [
                'title'  => __( 'Woo Product Carousel', 'exclusive-addons-elementor' ),
                'class'  => '\ExclusiveAddons\Elements\Woo_Product_Carousel',
                'demo_link' => 'https://exclusiveaddons.com/woo-products-carousel-demo',
                'tags'   => 'pro',
                'is_pro' => true
            ]
        ];
    }

    
    public static function extensions_map_free() {
        return [
            'glass-effect'  => [
                'title'  => __( 'Glassmorphism Effect', 'exclusive-addons-elementor' ),
                'class'  => '\Exclusive_Addons\Elementor\Extensions\GlassEffect',
                'tags'   => 'free',
                'demo_link' => 'https://exclusiveaddons.com/glassmorphism/',
                'is_pro' => false
            ],
            'post-duplicator'  => [
                'title'  => __( 'Post Duplicator', 'exclusive-addons-elementor' ),
                'class'  => '\Exclusive_Addons\Elementor\Extensions\Post_Duplicator',
                'tags'   => 'free',
                'demo_link' => 'https://exclusiveaddons.com/post-duplicator/',
                'is_pro' => false
            ],
            'sticky'  => [
                'title'  => __( 'Exclusive Sticky', 'exclusive-addons-elementor' ),
                'class'  => '\Exclusive_Addons\Elementor\Extensions\Sticky',
                'tags'   => 'free',
                'demo_link' => 'https://exclusiveaddons.com/section-parallax/',
                'is_pro' => false
            ],
            'link-anything' => [
				'title' => __( 'Link Anything', 'exclusive-addons-elementor' ),
                'class'  => '\Exclusive_Addons\Elementor\Extensions\Link_Anything',
				'tags'   => 'free',
                'demo_link' => 'https://exclusiveaddons.com/',
                'is_pro' => false
			],
        ];

    }

    public static function extensions_map_pro() {
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
            ],
            'cross-site-copy-paste'  => [
                'title'  => __( 'Cross Site Copy Paste', 'exclusive-addons-elementor' ),
                'class'  => '\Exclusive_Addons\Elementor\Extensions\Cross_Site_Copy_Paste',
                'tags'   => 'pro',
                'demo_link' => 'https://exclusiveaddons.com/cross-site-copy-paste',
                'is_pro' => true
            ]
        ];
    }

}

Addons_Manager::init();
