<?php
/**
 * Dashboard Settings Page
 */

namespace ExclusiveAddons\Elementor\Dashboard;

if( ! defined( 'ABSPATH' ) ) {
    exit(); // Exit if accessed directly
}

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
	private $exad_settings;

	/**
	 * Settings values from database
	 * @var array
	 * @since 1.0
	 */
	private $exad_get_settings;

	/**
	 * Constructor of the class
	 * @param
	 * @return void
	 * @since 1.0.1
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'create_exad_admin_menu' ), 550 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_exad_admin_scripts' ) );
		add_action( 'wp_ajax_exad_ajax_save_elements_setting', array( $this, 'exad_ajax_save_elements_setting_function' ) );
    }

	/**
	 * Loading required scripts
	 * @param
	 * @return void
	 * @since 1.0.1
	 */
	public function enqueue_exad_admin_scripts( $hook ) {

        wp_enqueue_style( 'exad-notice-css', plugins_url( '/', __FILE__ ).'assets/css/exad-notice.css' );
		if( isset( $hook ) && $hook == 'elementor_page_exad-settings' ) {
			wp_enqueue_style( 'exad-admin-css', plugins_url( '/', __FILE__ ).'assets/css/exad-admin.css' );
			wp_enqueue_script( 'exad-admin-js', plugins_url( '/', __FILE__ ).'assets/js/exad-admin.js', array( 'jquery'), '1.0', true );
		}

	}

	/**
	 * Create an admin menu.
	 * @param
	 * @return void
	 * @since 1.0.1
	 */
	public function create_exad_admin_menu() {

		add_submenu_page( 'elementor', 'Exclusive Addons', 'Exclusive Addons', 'manage_options', 'exad-settings', array( $this, 'exad_admin_settings_page' ) );

	}

	/**
	 * Create settings page.
	 * @param
	 * @return void
	 * @since 1.0.1
	 */
	public function exad_admin_settings_page() {

		$js_info = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'ajax_nonce' => wp_create_nonce( 'exad_settings_nonce_action' )
		);
		wp_localize_script( 'exad-admin-js', 'js_exad_settings', $js_info );

	    $this->exad_default_settings = array_fill_keys( Base::$registered_elements, true );
	    $this->exad_get_settings = get_option( 'exad_save_settings', $this->exad_default_settings );
	    $exad_new_settings = array_diff_key( $this->exad_default_settings, $this->exad_get_settings );

	    if( ! empty( $exad_new_settings ) ) {
			$exad_updated_settings = array_merge( $this->exad_get_settings, $exad_new_settings );
			update_option( 'exad_save_settings', $exad_updated_settings );
        }
        
		$this->exad_get_settings = get_option( 'exad_save_settings', $this->exad_default_settings );
        
        ?>
        <div class="exad-elements-dashboard-wrapper">
            <form action="" method="POST" id="exad-elements-settings" name="exad-elements-settings">

                <?php wp_nonce_field( 'exad_settings_nonce_action' ); ?>
                
                <div class="exad-dashboard-header-wrapper">
                    <div class="exad-dashboard-header-left">
                        <div class="exad-admin-logo-inline">
                            <img src="<?php echo plugins_url( '/', __FILE__ ).'assets/img/ex-logo.png'; ?>">
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
                        <li><a href="#general" class="active"><img src="<?php echo plugins_url( '/', __FILE__ ).'assets/img/settings-icon.png'; ?>"><span>General</span></a></li>
                        <li><a href="#elements"><img src="<?php echo plugins_url( '/', __FILE__ ).'assets/img/elements-icon.png'; ?>"><span>Elements</span></a></li>
                        <li><a href="#apikeys"><img src="<?php echo plugins_url( '/', __FILE__ ).'assets/img/api-keys.svg'; ?>"><span>API Keys</span></a></li>
                    </ul>
                    <?php include_once EXAD_ADMIN . 'templates/general.php'; ?>
                    <div id="elements" class="exad-dashboard-tab">
                        <div class="exad-row">
                            <div class="exad-full-width">
                                <div class="exad-elements-dashboard-title">
                                    <img src="<?php echo EXAD_ADMIN_URL . 'assets/img/elements-dashboard.svg'; ?>">
                                    <h4 class="exad-dashboard-section-title">Deactivate elements for better performance</h4>
                                    <p class="exad-dashboard-section-title-p-tag">You can deactivate those elements that you do not intend to use to avoid loading scripts and files related to those elements.</p>
                                </div>
                                <div class="exad-dashboard-checkbox-container">

                                <?php foreach( Base::$registered_elements as $widget ) : ?>
                                    <?php if ( isset( $widget ) ) : ?>            
                                        <div class="exad-dashboard-checkbox">
                                            <div class="exad-dashboard-checkbox-text">
                                                <p class="exad-el-title"><?php echo esc_html( ucwords( str_replace( "-", " ", $widget ) ) ); ?></p>
                                            </div>
                                            <div class="exad-dashboard-checkbox-label">
                                                <input type="checkbox" id="<?php echo esc_attr( $widget ); ?>" name="<?php echo esc_attr( $widget ); ?>" <?php checked( 1, $this->exad_get_settings[$widget], true ); ?> >
                                                <label for="<?php echo esc_attr( $widget ); ?>"></label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                </div>
                                <!--./checkbox-container-->
                            </div>
                            
                        </div>
                    </div>
                    <?php include_once EXAD_ADMIN . 'templates/api-keys.php'; ?>
                </div>
            </form> <!-- Form End -->
        </div>
    <?php

	}

	/**
	 * Saving widgets status with ajax request
	 * @param
	 * @return  array
	 * @since 1.0.1
	 */
	public function exad_ajax_save_elements_setting_function() {

		check_ajax_referer( 'exad_settings_nonce_action', 'security' );

		if( isset( $_POST['fields'] ) ) {
			parse_str( $_POST['fields'], $settings );
		} else {
			return;
		}

		$this->exad_settings = [];

		foreach( Base::$registered_elements as $value ){
			if( isset( $settings[ $value ] ) ) {
				$this->exad_settings[ $value ] = 1;
			} else {
				$this->exad_settings[ $value ] = 0;
			}
		}
        update_option( 'exad_save_settings', $this->exad_settings );
        
        // Google Map API key 
        update_option( 'exad_google_map_api_option', $settings['google_map_api_key'] );
        
		return true;
		die();
			
	}

}

new \ExclusiveAddons\Elementor\Dashboard\Admin_Settings();
