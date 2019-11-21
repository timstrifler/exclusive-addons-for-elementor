<?php
/**
 * Plugin Name: Exclusive Addons Elementor
 * Plugin URI: http://exclusiveaddons.com/
 * Description: Packed with a bunch of Exclusively designed widget for Elementor.
 * Version: 2.0
 * Author: DevsCred.com
 * Author URI: http://devscred.com/
 * Text Domain: exclusive-addons-elementor
 * Domain Path: /languages
 * License: GPL3
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( 'EXAD_PNAME' ) ) define( 'EXAD_PNAME', basename( dirname( __FILE__ ) ) );
if ( ! defined( 'EXAD_PBNAME' ) ) define( 'EXAD_PBNAME', plugin_basename(__FILE__) );
if ( ! defined( 'EXAD_PATH' ) ) define( 'EXAD_PATH', plugin_dir_path( __FILE__ ) );
if ( ! defined( 'EXAD_ADMIN' ) ) define( 'EXAD_ADMIN', plugin_dir_path( __FILE__ ) . 'admin/' );	
if ( ! defined( 'EXAD_ADMIN_URL' ) ) define( 'EXAD_ADMIN_URL', plugins_url( '/', __FILE__ ) . 'admin/' );	
if ( ! defined( 'EXAD_ELEMENTS' ) ) define( 'EXAD_ELEMENTS', plugin_dir_path( __FILE__ ) . 'elements/' );
if ( ! defined( 'EXAD_TEMPLATES' ) ) define( 'EXAD_TEMPLATES', plugin_dir_path( __FILE__ ) . 'includes/template-parts/' );
if ( ! defined( 'EXAD_URL' ) ) define( 'EXAD_URL', plugins_url( '/', __FILE__ ) );
if ( ! defined( 'EXAD_ASSETS_URL' ) ) define( 'EXAD_ASSETS_URL', EXAD_URL . 'assets/' );
if ( ! defined( 'EXAD_PLUGIN_VERSION' ) ) define( 'EXAD_PLUGIN_VERSION', '2.0' );
if ( ! defined( 'MINIMUM_ELEMENTOR_VERSION' ) ) define( 'MINIMUM_ELEMENTOR_VERSION', '2.0.0' );
if ( ! defined( 'MINIMUM_PHP_VERSION' ) ) define( 'MINIMUM_PHP_VERSION', '5.4' );


/**
 * 
 * Initiate plugin Base class
 *   
 * @return void
 */	
function exad_initiate_plugin() {

	// Check if Elementor installed and activated
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'admin_notice_missing_main_plugin' );
		return;
	}

	// Check for required Elementor version
	if ( ! version_compare( ELEMENTOR_VERSION, MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
		add_action( 'admin_notices', 'admin_notice_minimum_elementor_version' );
		return;
	}

	// Check for required PHP version
	if ( version_compare( PHP_VERSION, MINIMUM_PHP_VERSION, '<' ) ) {
		add_action( 'admin_notices', 'admin_notice_minimum_php_version' );
		return;
	}

	require_once EXAD_PATH . 'base.php';
	\ExclusiveAddons\Elementor\Base::instance();
} 
add_action( 'plugins_loaded', 'exad_initiate_plugin' );

/**
 * Admin notice
 * Warning when the site doesn't have Elementor installed or activated.
 *
 * @since 1.0.0
 *
 * @access public
 */
function admin_notice_missing_main_plugin() {

	if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

	$elementor_path = 'elementor/elementor.php';

	if ( is_elementor_activated() ) {
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
function admin_notice_minimum_elementor_version() {

	if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

	$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
		esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'exclusive-addons-elementor' ),
		'<strong>' . esc_html__( 'Exclusive Addons Elementor', 'exclusive-addons-elementor' ) . '</strong>',
		'<strong>' . esc_html__( 'Elementor', 'exclusive-addons-elementor' ) . '</strong>',
		MINIMUM_ELEMENTOR_VERSION
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
function admin_notice_minimum_php_version() {

	if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

	$message = sprintf(
		/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
		esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'exclusive-addons-elementor' ),
		'<strong>' . esc_html__( 'Exclusive Addons Elementor', 'exclusive-addons-elementor' ) . '</strong>',
		'<strong>' . esc_html__( 'PHP', 'exclusive-addons-elementor' ) . '</strong>',
		MINIMUM_PHP_VERSION
	);

	printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

}

/**
 * Check to see if Elementor is Activated
 * 
 * @since 1.0.2
 */
function is_elementor_activated( $plugin_path = 'elementor/elementor.php' ){
	$installed_plugins_list = get_plugins();
	return isset( $installed_plugins_list[ $plugin_path ] );
}

/**
 * Plugin Redirect Hook
 * 
 */
function plugin_redirect_hook() {
	if ( get_option( 'exad_do_update_redirect', false ) ) {
		delete_option( 'exad_do_update_redirect' );
		if ( !isset($_GET['activate-multi'] ) && is_elementor_activated() ) {
			wp_redirect( 'admin.php?page=exad-settings' );
			exit;
		}
	}
}
add_action( 'admin_init', 'plugin_redirect_hook' );

/**
 * 
 * Plugin Redirect Option Added by register_activation_hook
 * 
 */
function exad_plugin_redirect_option() {
	add_option( 'exad_do_update_redirect', true );
}

register_activation_hook( __FILE__ , 'exad_plugin_redirect_option' );