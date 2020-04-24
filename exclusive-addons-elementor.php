<?php
/**
 * Plugin Name: Exclusive Addons Elementor
 * Plugin URI: http://exclusiveaddons.com/
 * Description: Packed with a bunch of Exclusively designed widget for Elementor.
 * Version: 2.1.0
 * Author: DevsCred.com
 * Author URI: http://devscred.com/
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
if ( ! defined( 'EXAD_TEMPLATES' ) ) define( 'EXAD_TEMPLATES', EXAD_PATH . 'includes/template-parts/' );
if ( ! defined( 'EXAD_URL' ) ) define( 'EXAD_URL', plugins_url( '/', __FILE__ ) );
if ( ! defined( 'EXAD_ASSETS_URL' ) ) define( 'EXAD_ASSETS_URL', EXAD_URL . 'assets/' );
if ( ! defined( 'EXAD_PLUGIN_VERSION' ) ) define( 'EXAD_PLUGIN_VERSION', '2.1.0' );
if ( ! defined( 'MINIMUM_ELEMENTOR_VERSION' ) ) define( 'MINIMUM_ELEMENTOR_VERSION', '2.0.0' );
if ( ! defined( 'MINIMUM_PHP_VERSION' ) ) define( 'MINIMUM_PHP_VERSION', '5.4' );

include_once EXAD_PATH . DIRECTORY_SEPARATOR . 'autoloader.php';


/**
 * 
 * Initiate plugin Base class
 *   
 * @return void
 */	
function exad_initiate_plugin() {

	require_once EXAD_PATH . 'base.php';
	\ExclusiveAddons\Elementor\Base::instance();
} 
add_action( 'plugins_loaded', 'exad_initiate_plugin' );


/**
 * 
 * Plugin Redirect Option Added by register_activation_hook
 * 
 */
function exad_plugin_redirect_option() {
	add_option( 'exad_do_update_redirect', true );
}

register_activation_hook( __FILE__ , 'exad_plugin_redirect_option' );