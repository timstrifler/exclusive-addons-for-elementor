<?php
namespace ExclusiveAddons\Elementor\Dashboard;

/**
 * Dashboard Settings Page
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \ExclusiveAddons\Elementor\Addons_Manager;
use \ExclusiveAddons\Elementor\Base;

class Admin_Settings {

	/**
	 * Defaults Settings
	 * @var array
	 * @since 1.0
	 */
	private $exad_default_settings;

	/**
	 * User selected Settings Value
	 * @var array
	 * @since 1.0
	 */
	private $save_dashboard_settings;

	/**
	 * Settings values from database
	 * @var array
	 * @since 1.0
	 */
	private $get_dashboard_settings;

	/**
	 * Constructor of the class
	 * @param
	 * @return void
	 * @since 1.0.1
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'create_admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		add_action( 'wp_ajax_exad_ajax_save_elements_setting', array( $this, 'ajax_save_elements_setting_function' ) );
	}
	

	/**
	 * Loading required scripts
	 * @param
	 * @return void
	 * @since 1.0.1
	 */	
	public function enqueue_admin_scripts( $hook ) {

        wp_enqueue_style( 'exad-notice-css', EXAD_ADMIN_URL . 'assets/css/exad-notice.min.css' );
		if( isset( $hook ) && $hook == 'toplevel_page_exad-settings' ) {
			wp_enqueue_style( 'exad-admin-css', EXAD_ADMIN_URL . 'assets/css/exad-admin.min.css' );
			wp_enqueue_script( 'exad-admin-js', EXAD_ADMIN_URL . 'assets/js/exad-admin.min.js', array( 'jquery', 'wp-color-picker' ), EXAD_PLUGIN_VERSION, true );
		}
	}

	/**
	 * Create an admin menu.
	 * @param
	 * @return void
	 * @since 1.0.1
	 */
	public function create_admin_menu() {

		$title = __( 'Exclusive Addons', 'exclusive-addons-elementor' );
		add_menu_page( $title, $title, 'manage_options', 'exad-settings', array( $this, 'admin_settings_page' ), EXAD_ADMIN_URL . 'assets/img/exad-dashboard-sidebar-icon.svg', 59 );
		
	}


	/**
	 * Create settings page.
	 * @param
	 * @return void
	 * @since 1.0.1
	 */
	public function admin_settings_page() {

		$js_info = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'ajax_nonce' => wp_create_nonce( 'exad_settings_nonce_action' )
		);
		wp_localize_script( 'exad-admin-js', 'js_exad_settings', $js_info );
		
		
		$this->get_dashboard_settings = get_option( 'exad_save_settings', Addons_Manager::$all_feature_settings );
	    $exad_new_settings = array_diff_key( Addons_Manager::$all_feature_settings, $this->get_dashboard_settings );

	    if( ! empty( $exad_new_settings ) ) {
			$exad_updated_settings = array_merge( $this->get_dashboard_settings, $exad_new_settings );
			update_option( 'exad_save_settings', $exad_updated_settings );
		}

		$this->get_dashboard_settings = get_option( 'exad_save_settings', Addons_Manager::$all_feature_settings );
        
        ?>
        <div class="exad-elements-dashboard-wrapper">
            <form action="" method="POST" id="exad-elements-settings" name="exad-elements-settings">

                <?php wp_nonce_field( 'save_dashboard_settings_nonce_action' ); ?>
                
                <div class="exad-dashboard-header-wrapper">
                    <div class="exad-dashboard-header-left">
                        <div class="exad-admin-logo-inline">
                            <img src="<?php echo EXAD_ADMIN_URL . 'assets/img/exad-admin-logo.svg'; ?>">
                        </div>
                        <h2 class="title">
                            <?php _e( 'Exclusive Addons Settings', 'exclusive-addons-elementor' ); ?>
                        </h2>
                    </div>
                    <div class="exad-dashboard-header-right">
                        <button type="submit" class="exad-btn exad-js-element-save-setting">
                            <?php _e('Save Settings', 'exclusive-addons-elementor'); ?>
                        </button>
                    </div>
                </div>

                <div class="exad-dashboard-tabs-wrapper">
                    <ul class="exad-dashboard-tabs">
                        <li class="exad-tab-btn">
							<a href="#general" class="active">
								<img class="exad-tab-image-normal" src="<?php echo EXAD_ADMIN_URL . 'assets/img/general-normal.svg'; ?>">
								<img class="exad-tab-image-active" src="<?php echo EXAD_ADMIN_URL . 'assets/img/general-active.svg'; ?>">
								<span><?php _e( 'General', 'exclusive-addons-elementor' ); ?></span>
							</a>
						</li>
                        <li class="exad-tab-btn">
							<a href="#elements">
								<img class="exad-tab-image-normal" src="<?php echo EXAD_ADMIN_URL . 'assets/img/elements-normal.svg'; ?>">
								<img class="exad-tab-image-active" src="<?php echo EXAD_ADMIN_URL . 'assets/img/elements-active.svg'; ?>">
								<span><?php _e( 'Elements', 'exclusive-addons-elementor' ); ?></span>
							</a>
						</li>
                        <li class="exad-tab-btn">
							<a href="#extensions">
								<img class="exad-tab-image-normal" src="<?php echo EXAD_ADMIN_URL . 'assets/img/ex-extensions-normal.svg'; ?>">
								<img class="exad-tab-image-active" src="<?php echo EXAD_ADMIN_URL . 'assets/img/ex-extensions-active.svg'; ?>">
								<span><?php _e( 'Extensions', 'exclusive-addons-elementor' ); ?></span>
							</a>
						</li>
						<li class="exad-tab-btn">
							<a href="#style-settings">
								<img class="exad-tab-image-normal" src="<?php echo EXAD_ADMIN_URL . 'assets/img/style-normal.svg'; ?>">
								<img class="exad-tab-image-active" src="<?php echo EXAD_ADMIN_URL . 'assets/img/style-active.svg'; ?>">
								<span><?php _e( 'Style', 'exclusive-addons-elementor' ); ?></span>
							</a>
						</li>
                        <li class="exad-tab-btn">
							<a href="#apikeys">
								<img class="exad-tab-image-normal" src="<?php echo EXAD_ADMIN_URL . 'assets/img/api-normal.svg'; ?>">
								<img class="exad-tab-image-active" src="<?php echo EXAD_ADMIN_URL . 'assets/img/api-active.svg'; ?>">
								<span><?php _e( 'API Keys', 'exclusive-addons-elementor' ); ?></span>
							</a>
						</li>
						<?php if ( !Base::$is_pro_active ) : ?>
						<li class="exad-get-pro">
							<a href="https://exclusiveaddons.com/pricing/" target="_blank">
								<img src="<?php echo EXAD_ADMIN_URL . 'assets/img/get-pro-icon.svg'; ?>">
								<span><?php _e( 'Get Pro', 'exclusive-addons-elementor' ); ?></span>
							</a>
						</li>
						<?php endif; ?>
						<div class="active-switcher"></div>
                    </ul>
                    <?php include_once EXAD_ADMIN . 'templates/general.php'; ?>
                    <?php include_once EXAD_ADMIN . 'templates/elements.php'; ?>
                    <?php include_once EXAD_ADMIN . 'templates/extensions.php'; ?>
					<?php include_once EXAD_ADMIN . 'templates/style-settings.php'; ?>
                    <?php include_once EXAD_ADMIN . 'templates/api-keys.php'; ?>
					<?php if ( !Base::$is_pro_active ) : ?>
						<div class="exad-dashboard-popup-message">
							<div class="exad-dashboard-popup-message-img">
								<img src="<?php echo EXAD_ADMIN_URL . 'assets/img/download-popup.svg'; ?>">
							</div>
							<h1 class="exad-dashboard-popup-message-title">
								<?php _e( 'Your contribution to our enormous effort means a lot', 'exclusive-addons-elementor' ); ?>
							</h1>
							<p class="exad-dashboard-popup-message-discription">
								<?php _e( 'We\'re working real hard to deliver the smoothest Elementor page building experience for you. <br> Consider this as a contribution to the team to keep up the pace.', 'exclusive-addons-elementor' ); ?>
							</p>
							<a href="https://exclusiveaddons.com/pricing/" target="_blank" class="exad-dashboard-popup-message-action"><?php _e( 'Upgrade to Pro', 'exclusive-addons-elementor'); ?></a>
						</div>
						<div class="exad-dashboard-popup-overlay"></div>
					<?php endif; ?>
                </div>
            </form> <!-- Form End -->
        </div>
    <?php

	}

	/**
	 * All the Pro Features array
	 * @param
	 * @return  array
	 * @since 2.4.01
	 */
	public function all_pro_feature_keys() {
		$widget_pro_keys = array_keys( Addons_Manager::widget_map_pro() );
		$extension_pro_keys = array_keys( Addons_Manager::extensions_map_pro() );

		return array_merge( $widget_pro_keys, $extension_pro_keys );

	}

	/**
	 * Saving widgets status with ajax request
	 * @param
	 * @return  array
	 * @since 1.0.1
	 */
	public function ajax_save_elements_setting_function() {

		check_ajax_referer( 'exad_settings_nonce_action', 'security' );

		if( isset( $_POST['fields'] ) ) {
			parse_str( $_POST['fields'], $settings );
		} else {
			return;
		}

		$this->save_dashboard_settings = [];

		if ( !Base::$is_pro_active ) {
			foreach( $this->all_pro_feature_keys() as $value ) {
				$settings[$value] = 'on';
			}
		}

		foreach( Addons_Manager::$all_feature_array as $value ) {
			if ( array_key_exists( $value, $settings ) ) {
				$this->save_dashboard_settings[ $value ] = 1;
			} else {
				$this->save_dashboard_settings[ $value ] = 0;
			}
		}

        update_option( 'exad_save_settings', $this->save_dashboard_settings );        
        update_option( 'exad_google_map_api_option', $settings['google_map_api_key'] );
        update_option( 'exad_save_mailchimp_api', $settings['mailchimp_api_key'] );
        update_option( 'exad_primary_color_option', $settings['exad_primary_color'] );
        update_option( 'exad_secondary_color_option', $settings['exad_secondary_color'] );
        
		wp_die();
			
	}

}

new Admin_Settings();