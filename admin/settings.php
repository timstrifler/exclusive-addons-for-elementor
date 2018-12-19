<?php
/**
 * Admin Settings Page
 */

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

class Exad_Admin_Settings {

	/**
	 * Contains Default Component keys
	 * @var array
	 * @since 2.3.0
	 */
	public $exad_default_keys = [ 'contact-form-7', 'count-down', 'creative-btn', 'fancy-text', 'post-grid', 'post-timeline', 'product-grid', 'team-members', 'testimonials', 'weforms', 'call-to-action', 'flip-box', 'info-box', 'dual-header', 'price-table', 'ninja-form', 'gravity-form', 'caldera-form', 'wpforms', 'twitter-feed', 'facebook-feed', 'data-table', 'filter-gallery', 'image-accordion', 'content-ticker', 'tooltip', 'adv-accordion', 'adv-tabs', 'progress-bar' ];

	/**
	 * Will Contain All Components Default Values
	 * @var array
	 * @since 2.3.0
	 */
	private $exad_default_settings;

	/**
	 * Will Contain User End Settings Value
	 * @var array
	 * @since 2.3.0
	 */
	private $exad_settings;

	/**
	 * Will Contains Settings Values Fetched From DB
	 * @var array
	 * @since 2.3.0
	 */
	private $exad_get_settings;

	/**
	 * Initializing all default hooks and functions
	 * @param
	 * @return void
	 * @since 1.1.2
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'create_exad_admin_menu' ), 550 );
		add_action( 'init', array( $this, 'enqueue_exad_admin_scripts' ) );
		add_action( 'wp_ajax_save_settings_with_ajax', array( $this, 'exad_save_settings_with_ajax' ) );

	}

	/**
	 * Loading all essential scripts
	 * @param
	 * @return void
	 * @since 1.1.2
	 */
	public function enqueue_exad_admin_scripts() {

		wp_enqueue_style( 'exad-notice-css', plugins_url( '/', __FILE__ ).'assets/css/exad-notice.css' );
		if( isset( $_GET['page'] ) && $_GET['page'] == 'exad-settings' ) {
			wp_enqueue_style( 'exad-admin-css', plugins_url( '/', __FILE__ ).'assets/css/admin.css' );
			wp_enqueue_style( 'exad-sweetalert2-css', plugins_url( '/', __FILE__ ).'assets/vendor/sweetalert2/css/sweetalert2.min.css' );
			wp_enqueue_script( 'exad-admin-js', plugins_url( '/', __FILE__ ).'assets/js/admin.js', array( 'jquery'), '1.0', true );
			wp_enqueue_script( 'exclusive_addons_core-js', plugins_url( '/', __FILE__ ).'assets/vendor/sweetalert2/js/core.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_script( 'exclusive_addons_sweetalert2-js', plugins_url( '/', __FILE__ ).'assets/vendor/sweetalert2/js/sweetalert2.min.js', array( 'jquery', 'exclusive_addons_core-js' ), '1.0', true );
		}

	}

	/**
	 * Create an admin menu.
	 * @param
	 * @return void
	 * @since 1.1.2
	 */
	public function create_exad_admin_menu() {

		add_submenu_page(
			'elementor',
			'Exclusive Addons',
			'Exclusive Addons',
			'manage_options',
			'exad-settings',
			array( $this, 'exad_admin_settings_page' )
		);

	}

	/**
	 * Create settings page.
	 * @param
	 * @return void
	 * @since 1.1.2
	 */
	public function exad_admin_settings_page() {

		$js_info = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'ajax_nonce' => wp_create_nonce( 'exad_settings_nonce_action' )
		);
		wp_localize_script( 'exad-admin-js', 'js_exad_settings', $js_info );

	   /**
	    * This section will handle the "exad_save_settings" array. If any new settings options is added
	    * then it will matches with the older array and then if it founds anything new then it will update the entire array.
	    */
	   $this->exad_default_settings = array_fill_keys( $this->exad_default_keys, true );
	   $this->exad_get_settings = get_option( 'exad_save_settings', $this->exad_default_settings );
	   $exad_new_settings = array_diff_key( $this->exad_default_settings, $this->exad_get_settings );

	   if( ! empty( $exad_new_settings ) ) {
			$exad_updated_settings = array_merge( $this->exad_get_settings, $exad_new_settings );
			update_option( 'exad_save_settings', $exad_updated_settings );
	   }
	   $this->exad_get_settings = get_option( 'exad_save_settings', $this->exad_default_settings );
	?>
<div class="exad-settings-wrap">
    <form action="" method="POST" id="exad-settings" name="exad-settings">
        <?php wp_nonce_field( 'exad_settings_nonce_action' ); ?>
        <div class="exad-header-bar">
            <div class="exad-header-left">
                <div class="exad-admin-logo-inline">
                    <img src="<?php echo plugins_url( '/', __FILE__ ).'assets/images/ea-logo.svg'; ?>">
                </div>
                <h2 class="title">
                    <?php _e( 'Exclusive Addons Settings', 'exclusive-addons-elementor' ); ?>
                </h2>
            </div>
            <div class="exad-header-right">
                <button type="submit" class="button exad-btn js-exad-settings-save">
                    <?php _e('Save settings', 'exclusive-addons-elementor'); ?></button>
            </div>
            <div class="exad-save-notification">Working</div>
        </div>
        <div class="exad-settings-tabs">
            <ul class="exad-tabs">
                <li><a href="#general" class="active"><img src="<?php echo plugins_url( '/', __FILE__ ).'assets/img/Setting, Preferences, User, Interface, Ui, Gear.png'; ?>"><span>General</span></a></li>
                <li><a href="#elements"><img src="<?php echo plugins_url( '/', __FILE__ ).'assets/img/Layer, Stack, Data, Layers, Tool.png'; ?>"><span>Elements</span></a></li>
                <li><a href="#go-pro"><img src="<?php echo plugins_url( '/', __FILE__ ).'assets/img/Tag, Label, Card, Badge, Award, Ecommerce.png'; ?>"><span>Go Premium</span></a></li>
            </ul>
            <div id="general" class="exad-settings-tab active">
                <div class="row exad-admin-general-wrapper">
                    <div class="row exad-admin-block-banner">
                        <a class="exad-admin-block-banner-full" href="https://essential-addons.com/elementor/" target="_blank">
                            <img class="exad-preview-img" src="<?php echo plugins_url( '/', __FILE__ ).'assets/img/settings-banner-bg.png'; ?>">
                            <div class="exad-admin-block-banner-content">
                                <h1>Exclusive Addons<br> for Elementor</h1>
                            </div>
                            <div class="exad-admin-block-banner-content-button">
                                <button>Upgrade to Pro</button>
                            </div>
                        </a>


                    </div>
                    <!--preview image end-->
                    <div class="exad-admin-general-inner">
                        <div class="exad-admin-block-wrapper">

                            <div class="exad-admin-block exad-admin-block-banner">
                                <!--
                                <a href="https://essential-addons.com/elementor/" target="_blank">
                                    <img class="exad-preview-img" src="<?php echo plugins_url( '/', __FILE__ ).'assets/images/exad-featured.png'; ?>">
                                </a>
-->
                                <header class="exad-admin-block-header">
                                    <div class="exad-admin-block-header-icon">
                                        <!--
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46 45.69">
                                            <defs>
                                                <style>.flexia-icon-bug{fill:#9b59b6;}</style>
                                            </defs>
                                            <title>Bugs</title>
                                            <g id="Layer_2" data-name="Layer 2">
                                                <g id="Layer_1-2" data-name="Layer 1">
                                                    <path class="flexia-icon-bug" d="M18.87,28.37,9.16,38.08A8.66,8.66,0,0,0,14.49,40h4.38a9.55,9.55,0,0,0,2.28-.38v5.14a1,1,0,0,0,1.9,0v-5.9A4.83,4.83,0,0,0,25,37.31l.76-.76a.92.92,0,0,0,0-1.33Z" />
                                                    <path class="flexia-icon-bug" d="M11.64,21.13c-.19-.19-.57-.38-.76-.19H9c-.38,0-.57,0-.76.38L7.07,23H1.17a1,1,0,1,0,0,1.9H6.31a9.56,9.56,0,0,0-.38,2.28V31.6a8.66,8.66,0,0,0,1.9,5.33l9.71-9.71Z" />
                                                    <path class="flexia-icon-bug" d="M24.39,14.47c.19.19.38.19.76.19a.7.7,0,0,0,.57-.19.92.92,0,0,0,.38-1.14,11.08,11.08,0,0,1-1-3,.87.87,0,0,0-1-.76H22.3a1,1,0,0,0-.76.38,1.14,1.14,0,0,0-.19.76,2.35,2.35,0,0,0,.76,1.52Z" />
                                                    <path class="flexia-icon-bug" d="M35.81,28.56h3.43a1,1,0,0,0,0-1.9H33.91L20.77,13.52A5.2,5.2,0,0,1,19.25,9.9V6.66a.9.9,0,0,0-1-1h-.19A13.52,13.52,0,0,0,16.21,3,9.12,9.12,0,0,0,9.54,0a9.71,9.71,0,0,0-5.9,2.09,1.44,1.44,0,0,0-.38.76,1,1,0,0,0,.38.76L9.54,7a5.39,5.39,0,0,1-2.86,4.19l-5.14-3a.85.85,0,0,0-1,0c-.38.19-.57.38-.57.76a8.9,8.9,0,0,0,2.67,7,9.53,9.53,0,0,0,6.85,3,4.1,4.1,0,0,0,2.09-.38L26.87,33.89,37.15,44.17a5.2,5.2,0,0,0,3.62,1.52,5,5,0,0,0,4.95-4.95,5.2,5.2,0,0,0-1.52-3.62Z" />
                                                    <path class="flexia-icon-bug" d="M34.86,24.75c.19.19.38.19.76.19H36a1,1,0,0,0,.57-1V21.51c0-.38-.38-1-.76-1a7,7,0,0,1-3.43-.76.92.92,0,0,0-1.14.38c-.19.38-.19,1,.19,1.14Z" />
                                                    <path class="flexia-icon-bug" d="M45.71,9.9c-1.52-1.52-5.14-.38-7,.57L35.81,7.62c.76-2.09,1.9-5.71.57-7a.92.92,0,0,0-1.33,0,.92.92,0,0,0,0,1.33c.38.38,0,2.67-1,5.14L28,8a.87.87,0,0,0-.76,1C26.87,14.28,31.63,19,37.34,19c.38,0,1-.38,1-.76l1-6.09c2.47-1,4.76-1.33,5.14-1A.94.94,0,1,0,45.71,9.9Z" />
                                                </g>
                                            </g>

                                            <head xmlns="" />
                                        </svg>
-->

                                        <svg width="13px" height="14px" viewBox="0 0 13 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g id="Setting-main-Page-" transform="translate(-331.000000, -451.000000)" fill="#FFFFFF">
                                                    <g id="Group-10" transform="translate(307.000000, 428.000000)">
                                                        <g id="Plus,-Add,-Inset,-Append,-Circle,-Attach" transform="translate(11.000000, 10.000000)">
                                                            <g id="svg3771">
                                                                <g id="layer1" transform="translate(0.000000, 0.637800)">
                                                                    <g id="g4069">
                                                                        <path d="M18.5022403,14.0198542 L18.5062403,18.5120542 L14.0121003,18.5120542 C13.6514882,18.5077268 13.3164756,18.6978847 13.1353244,19.0097245 C12.9541732,19.3215643 12.9549437,19.7067822 13.1373408,20.0178949 C13.3197379,20.3290077 13.6555084,20.5178239 14.0161003,20.5120542 L18.5102403,20.5120542 L18.5142403,25.0062542 C18.5112745,25.3666961 18.7024992,25.7008476 19.0147681,25.8808903 C19.3270369,26.060933 19.7120309,26.059008 20.0224838,25.8758517 C20.3329366,25.6926954 20.5208104,25.3566485 20.5142403,24.9962542 L20.5102403,20.5059542 L25.0024303,20.5059542 C25.3630629,20.510681 25.6983054,20.3208671 25.8797923,20.009193 C26.0612791,19.697519 26.0608939,19.3122701 25.878784,19.0009596 C25.6966742,18.6896492 25.3610527,18.5005062 25.0004303,18.5059542 L20.5062903,18.5059542 L20.5022903,14.0118542 C20.5054674,13.7415488 20.3990858,13.4814699 20.2073848,13.2908766 C20.0156838,13.1002833 19.7549927,12.9954107 19.4847103,13.0001542 C18.9331486,13.0139379 18.4936064,13.468325 18.5022403,14.0198542 Z" id="path5702-9"></path>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>

                                    </div>
                                    <h4 class="exad-admin-title">Contribute to Exclusive Addons</h4>
                                </header>
                                <div class="exad-admin-block-content">
                                    <p>You can contribute to make Exclusive Addons better reporting bugs, creating issues, pull requests at <a href="https://github.com/rupok/essential-addons-elementor-lite/" target="_blank">Github.</a></p>
                                    <a href="https://github.com/rupok/essential-addons-elementor-lite/issues/new" class="button button-primary" target="_blank">Report a bug</a>
                                </div>

                            </div>
                            <!--preview image end-->
                            <div class="exad-admin-block exad-admin-block-docs">
                                <header class="exad-admin-block-header">
                                    <div class="exad-admin-block-header-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46 46">
                                            <defs>
                                                <style>.cls-1{fill:#1abc9c;}</style>
                                            </defs>
                                            <title>Documentation</title>
                                            <g id="Layer_2" data-name="Layer 2">
                                                <g id="Layer_1-2" data-name="Layer 1">
                                                    <rect class="cls-1" x="15.84" y="17.13" width="14.32" height="1.59" />
                                                    <rect class="cls-1" x="15.84" y="24.19" width="14.32" height="1.59" />
                                                    <rect class="cls-1" x="15.84" y="20.66" width="14.32" height="1.59" />
                                                    <path class="cls-1" d="M23,0A23,23,0,1,0,46,23,23,23,0,0,0,23,0Zm5.47,9.9,4.83,4.4H28.47Zm-2.29,23v3.2H15.49a2.79,2.79,0,0,1-2.79-2.79V12.69A2.79,2.79,0,0,1,15.49,9.9H27.28v5.59h6V27.72H15.84v1.59H29.78v1.94H15.84v1.59H26.19Zm11.29,2.52H33.88V39H31.37V35.42H27.78V32.9h3.59V29.31h2.52V32.9h3.59Z" />
                                                </g>
                                            </g>

                                            <head xmlns="" />
                                        </svg>
                                    </div>
                                    <h4 class="exad-admin-title">Documentation</h4>
                                </header>
                                <div class="exad-admin-block-content">
                                    <p>Get started by spending some time with the documentation to get familiar with Exclusive Addons. Build awesome websites for you or your clients with ease.</a></p>
                                    <a href="https://essential-addons.com/elementor/docs/" class="button button-primary" target="_blank">Get Support</a>
                                </div>
                            </div>
                            <div class="exad-admin-block exad-admin-block-contribution">
                                <header class="exad-admin-block-header">
                                    <div class="exad-admin-block-header-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46 45.69">
                                            <defs>
                                                <style>.flexia-icon-bug{fill:#9b59b6;}</style>
                                            </defs>
                                            <title>Bugs</title>
                                            <g id="Layer_2" data-name="Layer 2">
                                                <g id="Layer_1-2" data-name="Layer 1">
                                                    <path class="flexia-icon-bug" d="M18.87,28.37,9.16,38.08A8.66,8.66,0,0,0,14.49,40h4.38a9.55,9.55,0,0,0,2.28-.38v5.14a1,1,0,0,0,1.9,0v-5.9A4.83,4.83,0,0,0,25,37.31l.76-.76a.92.92,0,0,0,0-1.33Z" />
                                                    <path class="flexia-icon-bug" d="M11.64,21.13c-.19-.19-.57-.38-.76-.19H9c-.38,0-.57,0-.76.38L7.07,23H1.17a1,1,0,1,0,0,1.9H6.31a9.56,9.56,0,0,0-.38,2.28V31.6a8.66,8.66,0,0,0,1.9,5.33l9.71-9.71Z" />
                                                    <path class="flexia-icon-bug" d="M24.39,14.47c.19.19.38.19.76.19a.7.7,0,0,0,.57-.19.92.92,0,0,0,.38-1.14,11.08,11.08,0,0,1-1-3,.87.87,0,0,0-1-.76H22.3a1,1,0,0,0-.76.38,1.14,1.14,0,0,0-.19.76,2.35,2.35,0,0,0,.76,1.52Z" />
                                                    <path class="flexia-icon-bug" d="M35.81,28.56h3.43a1,1,0,0,0,0-1.9H33.91L20.77,13.52A5.2,5.2,0,0,1,19.25,9.9V6.66a.9.9,0,0,0-1-1h-.19A13.52,13.52,0,0,0,16.21,3,9.12,9.12,0,0,0,9.54,0a9.71,9.71,0,0,0-5.9,2.09,1.44,1.44,0,0,0-.38.76,1,1,0,0,0,.38.76L9.54,7a5.39,5.39,0,0,1-2.86,4.19l-5.14-3a.85.85,0,0,0-1,0c-.38.19-.57.38-.57.76a8.9,8.9,0,0,0,2.67,7,9.53,9.53,0,0,0,6.85,3,4.1,4.1,0,0,0,2.09-.38L26.87,33.89,37.15,44.17a5.2,5.2,0,0,0,3.62,1.52,5,5,0,0,0,4.95-4.95,5.2,5.2,0,0,0-1.52-3.62Z" />
                                                    <path class="flexia-icon-bug" d="M34.86,24.75c.19.19.38.19.76.19H36a1,1,0,0,0,.57-1V21.51c0-.38-.38-1-.76-1a7,7,0,0,1-3.43-.76.92.92,0,0,0-1.14.38c-.19.38-.19,1,.19,1.14Z" />
                                                    <path class="flexia-icon-bug" d="M45.71,9.9c-1.52-1.52-5.14-.38-7,.57L35.81,7.62c.76-2.09,1.9-5.71.57-7a.92.92,0,0,0-1.33,0,.92.92,0,0,0,0,1.33c.38.38,0,2.67-1,5.14L28,8a.87.87,0,0,0-.76,1C26.87,14.28,31.63,19,37.34,19c.38,0,1-.38,1-.76l1-6.09c2.47-1,4.76-1.33,5.14-1A.94.94,0,1,0,45.71,9.9Z" />
                                                </g>
                                            </g>

                                            <head xmlns="" />
                                        </svg>
                                    </div>
                                    <h4 class="exad-admin-title">Contribute to Exclusive Addons</h4>
                                </header>
                                <div class="exad-admin-block-content">
                                    <p>You can contribute to make Exclusive Addons better reporting bugs, creating issues, pull requests at <a href="https://github.com/rupok/essential-addons-elementor-lite/" target="_blank">Github.</a></p>
                                    <a href="https://github.com/rupok/essential-addons-elementor-lite/issues/new" class="button button-primary" target="_blank">Report a bug</a>
                                </div>
                            </div>
                            <div class="exad-admin-block exad-admin-block-support">
                                <header class="exad-admin-block-header">
                                    <div class="exad-admin-block-header-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.22 42.58">
                                            <defs>
                                                <style>.flexia-icon-support{fill:#6c75ff;}</style>
                                            </defs>
                                            <title>Flexia Support</title>
                                            <g id="Layer_2" data-name="Layer 2">
                                                <g id="Layer_1-2" data-name="Layer 1">
                                                    <path class="flexia-icon-support" d="M6.36,29.34l1.09-1.09h8l-5.08-9.18-3.76.76a2.64,2.64,0,0,0-2,1.91L.09,36.31a2.64,2.64,0,0,0,2.55,3.31H6.36V29.34Z" />
                                                    <path class="flexia-icon-support" d="M32.13,36.31,27.67,21.75a2.64,2.64,0,0,0-2.06-1.92l-3.74-.71-5.06,9.13h8.56l1.09,1.09V39.62h3.12a2.64,2.64,0,0,0,2.55-3.31Z" />
                                                    <polygon class="flexia-icon-support" points="8.54 39.62 8.24 39.62 8.24 39.62 23.98 39.62 23.98 39.62 24.28 39.62 24.28 30.43 8.54 30.43 8.54 39.62" />
                                                    <rect class="flexia-icon-support" x="4.19" y="40.61" width="23.83" height="1.97" />
                                                    <path class="flexia-icon-support" d="M7.62,12.65c0,.09.1.22.15.36a3.58,3.58,0,0,0,.68,1.22c1.21,3.94,4.33,6.68,7.64,6.67s6.38-2.77,7.55-6.72A3.61,3.61,0,0,0,24.31,13c.06-.14.11-.27.15-.36a2,2,0,0,0-.33-2.41V10.1C24.12,5.2,23.48,0,16,0S7.92,5,7.94,10.15c0,0,0,.06,0,.09A2,2,0,0,0,7.62,12.65Zm1-1.58h0A.55.55,0,0,0,9,10.83l1.3.2a.28.28,0,0,0,.3-.16L11.39,9a35.31,35.31,0,0,0,7.2,1,7.76,7.76,0,0,0,2.11-.25L21.23,11a.27.27,0,0,0,.25.17h.07l1.51-.43a.56.56,0,0,0,.31.3h0c.23.11.3.6.06,1.09-.06.12-.12.27-.18.43a4.18,4.18,0,0,1-.4.82.55.55,0,0,0-.26.33c-1,3.58-3.68,6.08-6.54,6.09s-5.6-2.48-6.63-6a.55.55,0,0,0-.26-.33,4.3,4.3,0,0,1-.41-.82c-.06-.15-.13-.3-.18-.42C8.37,11.68,8.44,11.19,8.67,11.08Z" />
                                                </g>
                                            </g>

                                            <head xmlns="" />
                                        </svg>
                                    </div>
                                    <h4 class="exad-admin-title">Need Help?</h4>
                                </header>
                                <div class="exad-admin-block-content">
                                    <p>Stuck with something? Get help from the community on <a href="https://community.wpdeveloper.net/" target="_blank">WPDeveloper Forum</a> or <a href="https://www.facebook.com/groups/essentialaddons/" target="_blank">Facebook Community.</a> In case of emergency, initiate a live chat at <a href="https://essential-addons.com/elementor/" target="_blank">Exclusive Addons website.</a></p>
                                    <a href="https://community.wpdeveloper.net/support-forum/forum/essential-addons-for-elementor/" class="button button-primary" target="_blank">Get Community Support</a>
                                </div>
                            </div>
                            <!--
                            <div class="exad-admin-block exad-admin-block-review">
                                <header class="exad-admin-block-header">
                                    <div class="exad-admin-block-header-icon">
                                        <svg style="enable-background:new 0 0 48 48;" version="1.1" viewBox="0 0 48 48" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="Icons">
                                                <g>
                                                    <g id="Icons_7_">
                                                        <g>
                                                            <path d="M35.72935,25.74662l0.8357-0.8271c1.611-1.611,2.4122-3.7475,2.4122-5.8668      c0-2.1279-0.8012-4.2558-2.4122-5.8668c-3.2221-3.2221-8.5031-3.2221-11.7337,0l-0.8271,0.8356l-0.8356-0.8356      c-3.222-3.2221-8.5031-3.2221-11.7251,0c-1.6196,1.611-2.4208,3.7389-2.4208,5.8668c0,2.1193,0.8012,4.2558,2.4208,5.8668      l0.8271,0.8271l11.3076,11.3077c0.2353,0.2352,0.6167,0.2351,0.8519-0.0002L35.72935,25.74662" style="fill:#EF4B53;" />
                                                        </g>
                                                    </g>
                                                    <path d="M17.80325,12.24382c0,0-6.9318-0.5491-7.6524,7.3092c0,0,1.4413-5.765,7.8583-5.4905    c0,0,1.5941,0.1605,1.5901-0.8317C19.59495,12.14722,17.80325,12.24382,17.80325,12.24382z" style="fill:#F47682;" />
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <h4 class="exad-admin-title">Show your Love</h4>
                                </header>
                                <div class="exad-admin-block-content">
                                    <p>We love to have you in Exclusive Addons family. We are making it more awesome everyday. Take your 2 minutes to review the plugin and spread the love to encourage us to keep it going.</p>

                                    <a href="https://wpdeveloper.net/review-essential-addons-elementor" class="review-flexia button button-primary" target="_blank">Leave a Review</a>
                                </div>
                            </div>
                            -->
                        </div>
                        <!--admin block-wrapper end-->
                    </div>

                </div>
                <!--Row end-->
            </div>
            <div id="elements" class="exad-settings-tab">
                <div class="row">
                    <div class="col-full">
                        <p class="exad-elements-control-notice">You can disable the elements you are not using on your site. That will disable all associated assets of those widgets to improve your site loading.</p>
                        <div class="premium-elements-title">
                            <img src="<?php echo plugins_url( '/', __FILE__ ).'assets/img/Plus, Add, Inset, Append, Circle, Attach.png'; ?>">
                            <h4 class="section-title">Deactivate elements for better performance</h4>
                            <p>You can deactivate those elements that you do not intend to use to avoid loading scripts and files related to those elements.</p>
                        </div>
                        <div class="exad-checkbox-container">
                            <div class="exad-checkbox">
                                <!--changed-->
                                <div class="exad-checkbox-text">
                                    <p class="exad-el-title">
                                        <?php _e( 'Contact Form 7', 'exclusive-addons-elementor' ); ?>
                                    </p>
                                    <p class="exad-el-title-small">
                                        <?php _e( 'Contact Form 7', 'exclusive-addons-elementor' ); ?>
                                    </p>
                                </div>
                                <div class="exad-checkbox-label">
                                    <input type="checkbox" id="contact-form-7" name="contact-form-7" <?php checked( 1, $this->exad_get_settings['contact-form-7'], true ); ?> >
                                    <label for="contact-form-7"></label>
                                </div>

                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="count-down" name="count-down" <?php checked( 1, $this->exad_get_settings['count-down'], true ); ?> >
                                <label for="count-down"></label>

                                <p class="exad-el-title">
                                    <?php _e( 'Count Down', 'exclusive-addons-elementor' ); ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="creative-btn" name="creative-btn" <?php checked( 1, $this->exad_get_settings['creative-btn'], true ); ?> >
                                <label for="creative-btn"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Creative Button', 'exclusive-addons-elementor' ); ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="fancy-text" name="fancy-text" <?php checked( 1, $this->exad_get_settings['fancy-text'], true ); ?> >
                                <label for="fancy-text"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Fancy Text', 'exclusive-addons-elementor' ); ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="post-grid" name="post-grid" <?php checked( 1, $this->exad_get_settings['post-grid'], true ); ?> >
                                <label for="post-grid"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Post Grid', 'exclusive-addons-elementor' ); ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="post-timeline" name="post-timeline" <?php checked( 1, $this->exad_get_settings['post-timeline'], true ); ?> >
                                <label for="post-timeline"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Post Timeline', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="product-grid" name="product-grid" <?php checked( 1, $this->exad_get_settings['product-grid'], true ); ?> >
                                <label for="product-grid"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Product Grid', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="team-members" name="team-members" <?php checked( 1, $this->exad_get_settings['team-members'], true ); ?> >
                                <label for="team-members"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Team Member', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="testimonials" name="testimonials" <?php checked( 1, $this->exad_get_settings['testimonials'], true ); ?> >
                                <label for="testimonials"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Testimonials', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="weforms" name="weforms" <?php checked( 1, $this->exad_get_settings['weforms'], true ); ?> >
                                <label for="weforms"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'weForms', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="call-to-action" name="call-to-action" <?php checked( 1, $this->exad_get_settings['call-to-action'], true ); ?> >
                                <label for="call-to-action"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Call To Action', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="flip-box" name="flip-box" <?php checked( 1, $this->exad_get_settings['flip-box'], true ); ?> >
                                <label for="flip-box"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Flip Box', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="info-box" name="info-box" <?php checked( 1, $this->exad_get_settings['info-box'], true ); ?> >
                                <label for="info-box"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Info Box', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="dual-header" name="dual-header" <?php checked( 1, $this->exad_get_settings['dual-header'], true ); ?> >
                                <label for="dual-header"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Dual Color Header', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="price-table" name="price-table" <?php checked( 1, $this->exad_get_settings['price-table'], true ); ?> >
                                <label for="price-table"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Pricing Table', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="ninja-form" name="ninja-form" <?php checked( 1, $this->exad_get_settings['ninja-form'], true ); ?> >
                                <label for="ninja-form"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Ninja Form', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="gravity-form" name="gravity-form" <?php checked( 1, $this->exad_get_settings['gravity-form'], true ); ?> >
                                <label for="gravity-form"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Gravity Form', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="caldera-form" name="caldera-form" <?php checked( 1, $this->exad_get_settings['caldera-form'], true ); ?> >
                                <label for="caldera-form"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Caldera Form', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="wpforms" name="wpforms" <?php checked( 1, $this->exad_get_settings['wpforms'], true ); ?> >
                                <label for="wpforms"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'WPForms', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="twitter-feed" name="twitter-feed" <?php checked( 1, $this->exad_get_settings['twitter-feed'], true ); ?> >
                                <label for="twitter-feed"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Twitter Feed', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="facebook-feed" name="facebook-feed" <?php checked( 1, $this->exad_get_settings['facebook-feed'], true ); ?> >
                                <label for="facebook-feed"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Facebook Feed', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="filter-gallery" name="filter-gallery" <?php checked( 1, $this->exad_get_settings['filter-gallery'], true ); ?> >
                                <label for="filter-gallery"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Filterable Gallery', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="data-table" name="data-table" <?php checked( 1, $this->exad_get_settings['data-table'], true ); ?> >
                                <label for="data-table"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Data Table', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="image-accordion" name="image-accordion" <?php checked( 1, $this->exad_get_settings['image-accordion'], true ); ?> >
                                <label for="image-accordion"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Image Accordion', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="content-ticker" name="content-ticker" <?php checked( 1, $this->exad_get_settings['content-ticker'], true ); ?> >
                                <label for="content-ticker"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Content Ticker', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="tooltip" name="tooltip" <?php checked( 1, $this->exad_get_settings['tooltip'], true ); ?> >
                                <label for="tooltip"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Tooltip', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="adv-accordion" name="adv-accordion" <?php checked( 1, $this->exad_get_settings['adv-accordion'], true ); ?> >
                                <label for="adv-accordion"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Advanced Accordion', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="adv-tabs" name="adv-tabs" <?php checked( 1, $this->exad_get_settings['adv-tabs'], true ); ?> >
                                <label for="adv-tabs"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Advanced Tabs', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="progress-bar" name="progress-bar" <?php checked( 1, $this->exad_get_settings['progress-bar'], true ); ?> >
                                <label for="progress-bar"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Progress Bar', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                        </div>
                        <!--./checkbox-container-->
                    </div>
                    <div class="col-full">
                        <div class="premium-elements-title">
                            <img src="<?php echo plugins_url( '/', __FILE__ ).'assets/img/Plus, Add, Inset, Append, Circle, Attach Copy.png'; ?>">
                            <h4 class="section-title">Premium Elements</h4>
                            <p>You can deactivate those elements that you do not intend to use to avoid loading scripts and files related to those elements.</p>
                        </div>
                        <div class="exad-checkbox-container">
                            <div class="exad-checkbox">
                                <input type="checkbox" id="img-comparison" name="img-comparison" disabled>
                                <label for="img-comparison" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Image Comparison', 'exclusive-addons-elementor' ); ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="instagram-gallery" name="instagram-gallery" disabled>
                                <label for="instagram-gallery" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Instagram Gallery', 'exclusive-addons-elementor' ); ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="interactive-promo" name="interactive-promo" disabled>
                                <label for="interactive-promo" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Interactive Promo', 'exclusive-addons-elementor' ); ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="lightbox" name="lightbox" disabled>
                                <label for="lightbox" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Lightbox', 'exclusive-addons-elementor' ); ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="post-block" name="post-block" disabled>
                                <label for="post-block" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Post Block', 'exclusive-addons-elementor' ); ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="testimonial-slider" name="testimonial-slider" disabled>
                                <label for="testimonial-slider" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Testimonial Slider', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="static-product" name="static-product" disabled>
                                <label for="static-product" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Static Product', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="flip-carousel" name="flip-carousel" disabled>
                                <label for="flip-carousel" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Flip Carousel', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="interactive-cards" name="interactive-cards" disabled>
                                <label for="interactive-cards" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Interactive Cards', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="content-timeline" name="content-timeline" disabled>
                                <label for="content-timeline" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Content Timeline', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="twitter-feed-carousel" name="twitter-feed-carousel" disabled>
                                <label for="twitter-feed-carousel" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Twitter Feed Carousel', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="facebook-feed-carousel" name="facebook-feed-carousel" disabled>
                                <label for="facebook-feed-carousel" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Facebook Feed Carousel', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="dynamic-filter-gallery" name="dynamic-filter-gallery" disabled>
                                <label for="dynamic-filter-gallery" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Dynamic Filter Gallery', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="post-list" name="post-list" disabled>
                                <label for="post-list" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Smart Post List', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="adv-google-map" name="adv-google-map" disabled>
                                <label for="adv-google-map" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Advanced Google Map', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="toggle" name="toggle" disabled>
                                <label for="toggle" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Content Toggle', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="mailchimp" name="mailchimp" disabled>
                                <label for="mailchimp" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Mailchimp', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="divider" name="divider" disabled>
                                <label for="divider" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Divider', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="price-menu" name="price-menu" disabled>
                                <label for="price-menu" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Price Menu', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="image-hotspots" name="image-hotspots" disabled>
                                <label for="image-hotspots" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Image Hotspots', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="one-page-navigation" name="one-page-navigation" disabled>
                                <label for="one-page-navigation" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'One Page Navigation', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="counter" name="counter" disabled>
                                <label for="counter" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Counter', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="post-carousel" name="post-carousel" disabled>
                                <label for="post-carousel" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Post Carousel', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="team-member-carousel" name="team-member-carousel" disabled>
                                <label for="team-member-carousel" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Team Member Carousel', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="logo-carousel" name="logo-carousel" disabled>
                                <label for="logo-carousel" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Logo Carousel', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="protected-content" name="protected-content" disabled>
                                <label for="protected-content" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Protected Content', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                            <div class="exad-checkbox">
                                <input type="checkbox" id="offcanvas" name="offcanvas" disabled>
                                <label for="offcanvas" class="<?php if( (bool) $this->is_pro === false ) : echo 'exad-get-pro'; endif; ?>"></label>
                                <p class="exad-el-title">
                                    <?php _e( 'Offcanvas Content', 'exclusive-addons-elementor' ) ?>
                                </p>
                            </div>
                        </div>
                        <!--./checkbox-container-->
                        <div class="exad-save-btn-wrap">
                            <button type="submit" class="button exad-btn js-exad-settings-save">
                                <?php _e('Save settings', 'exclusive-addons-elementor'); ?></button>
                        </div>
                        <div class="exad-save-notification"></div>
                    </div>
                </div>
            </div>
            <div id="go-pro" class="exad-settings-tab">
                <div class="row go-premium">
                    <div class="col-half">
                        <h4>Why upgrade to Premium Version?</h4>
                        <p>The premium version helps us to continue development of the product incorporating even more features and enhancements.</p>

                        <p>You will also get world class support from our dedicated team, 24/7.</p>

                        <a href="https://wpdeveloper.net/in/upgrade-essential-addons-elementor" target="_blank" class="button exad-btn exad-license-btn">Get Premium Version</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php

	}

	/**
	 * Saving data with ajax request
	 * @param
	 * @return  array
	 * @since 1.1.2
	 */
	public function exad_save_settings_with_ajax() {

		check_ajax_referer( 'exad_settings_nonce_action', 'security' );

		if( isset( $_POST['fields'] ) ) {
			parse_str( $_POST['fields'], $settings );
		} else {
			return;
		}

		$this->exad_settings = [];

		foreach( $this->exad_default_keys as $key ){
			if( isset( $settings[ $key ] ) ) {
				$this->exad_settings[ $key ] = 1;
			} else {
				$this->exad_settings[ $key ] = 0;
			}
		}
		update_option( 'exad_save_settings', $this->exad_settings );
		return true;
		die();
			
			
	}

}

new Exad_Admin_Settings();
