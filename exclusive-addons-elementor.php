<?php
/**
 * Plugin Name: Exclusive Addons Elementor
 * Plugin URI: https://exclusiveaddons.com/
 * Description: Packed with a bunch of Exclusively designed widgets for Elementor with all the customizations you ever imagined.
 * Version: 2.6.5
 * Author: DevsCred.com
 * Author URI: https://devscred.com/
 * Elementor tested up to: 3.13.2
 * Elementor Pro tested up to: 3.13.1
 * Text Domain: exclusive-addons-elementor
 * Domain Path: /languages
 * License: GPL3
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( 'EXAD_PBNAME' ) ) define( 'EXAD_PBNAME', plugin_basename(__FILE__) );
if ( ! defined( 'EXAD_PATH' ) ) define( 'EXAD_PATH', plugin_dir_path( __FILE__ ) );
if ( ! defined( 'EXAD_ADMIN' ) ) define( 'EXAD_ADMIN', EXAD_PATH . 'admin/' );	
if ( ! defined( 'EXAD_ADMIN_URL' ) ) define( 'EXAD_ADMIN_URL', plugins_url( '/', __FILE__ ) . 'admin/' );	
if ( ! defined( 'EXAD_ELEMENTS' ) ) define( 'EXAD_ELEMENTS', EXAD_PATH . 'elements/' );
if ( ! defined( 'EXAD_EXTENSIONS' ) ) define( 'EXAD_EXTENSIONS', plugin_dir_path( __FILE__ ) . 'extensions/' );
if ( ! defined( 'EXAD_TEMPLATES' ) ) define( 'EXAD_TEMPLATES', EXAD_PATH . 'includes/template-parts/' );
if ( ! defined( 'EXAD_URL' ) ) define( 'EXAD_URL', plugins_url( '/', __FILE__ ) );
if ( ! defined( 'EXAD_ASSETS_URL' ) ) define( 'EXAD_ASSETS_URL', EXAD_URL . 'assets/' );
if ( ! defined( 'EXAD_PLUGIN_VERSION' ) ) define( 'EXAD_PLUGIN_VERSION', '2.6.5' );
if ( ! defined( 'MINIMUM_ELEMENTOR_VERSION' ) ) define( 'MINIMUM_ELEMENTOR_VERSION', '2.0.0' );
if ( ! defined( 'MINIMUM_PHP_VERSION' ) ) define( 'MINIMUM_PHP_VERSION', '5.4' );

/**
 * 
 * Initiate plugin Base class
 *   
 * @return void
 */	
function exad_initiate_plugin() {

	// Exclusive Addons Elementor activated checking hook
	do_action( 'exad/exclusive_addons_active' );
	
	// Check if Elementor installed and activated
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'exad_admin_notice_missing_elementor' );
		return;
	}

	// Check for required Elementor version
	if ( ! version_compare( ELEMENTOR_VERSION, MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
		add_action( 'admin_notices', 'exad_admin_notice_minimum_elementor_version' );
		return;
	}

	// Check for required PHP version
	if ( version_compare( PHP_VERSION, MINIMUM_PHP_VERSION, '<' ) ) {
		add_action( 'admin_notices', 'exad_admin_notice_minimum_php_version' );
		return;
	}

	require_once EXAD_PATH . 'base.php';
	\ExclusiveAddons\Elementor\Base::instance();

	
	if ( is_admin() && ! class_exists( 'Classic_Editor' ) && ! class_exists( 'ShopCred\Base' ) && ( ! get_option( 'exad_blocks_notice_hide' ) ) ) {
		add_action( 'admin_notices', array( new \ExclusiveAddons\Elementor\Exad_Plugin_Notice, 'exad_blocks_Plugins_install_notice' ) );
	}
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
function exad_admin_notice_missing_elementor() {

	$message = sprintf(
        __( '%1$s requires %2$s to be installed and activated to function properly. %3$s', 'exclusive-addons-elementor' ),
        '<strong>' . __( 'Exclusive Addons Elementor', 'exclusive-addons-elementor' ) . '</strong>',
        '<strong>' . __( 'Elementor', 'exclusive-addons-elementor' ) . '</strong>',
        '<a href="' . esc_url( admin_url( 'plugin-install.php?s=Elementor&tab=search&type=term' ) ) . '">' . __( 'Please click here to install/activate Elementor', 'exclusive-addons-elementor' ) . '</a>'
    );

    printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 5px 0">%1$s</p></div>', $message );

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
function exad_admin_notice_minimum_elementor_version() {

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
function exad_admin_notice_minimum_php_version() {

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
 * Initialize the tracker
 *
 * @return void
 */
function exclusive_addons_appsero_init() {

	if ( ! class_exists( 'Exclusive_Addons\Appsero\Client' ) ) {
		require_once __DIR__ . '/vendor/appsero/src/Client.php';
	}

	$client = new \Exclusive_Addons\Appsero\Client( 'c3e3c997-fabf-42ad-bbd9-15cba7ab18ca', 'Exclusive Addons Elementor', __FILE__ );

	// Active insights
	$client->insights()->init();
	

}

exclusive_addons_appsero_init();

/**
 * 
 * Plugin Redirect Option Added by register_activation_hook
 * 
 */
function exad_plugin_redirect_option() {
	add_option( 'exad_do_update_redirect', true );
}

register_activation_hook( __FILE__ , 'exad_plugin_redirect_option' );