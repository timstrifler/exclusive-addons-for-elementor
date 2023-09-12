<?php
namespace ExclusiveAddons\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \WP_Error;
use \ExclusiveAddons\Elementor\Helper;

/**
 * Dashboard Notice 
 */

class Exad_Plugin_Notice {

    public function __construct() {
        
        add_action( 'wp_ajax_exad_install_plugin', array( $this, 'ajax_install_plugin' ) );
        add_action( 'wp_ajax_exad_upgrade_plugin', array( $this, 'ajax_upgrade_plugin' ) );
        add_action( 'wp_ajax_exad_activate_plugin', array( $this, 'ajax_activate_plugin' ) );
        add_action( 'wp_ajax_exad_notice_dismiss', array( $this, 'exad_notice_dismiss' ) );

    }

    /**
     * get_remote_plugin_data
     *
     * @param  mixed $slug
     * @return mixed array|WP_Error
     */
    public function get_remote_plugin_data($slug = '') {
        if (empty($slug)) {
            return new WP_Error('empty_arg', __('Argument should not be empty.'));
        }

        $response = wp_remote_post(
            'http://api.wordpress.org/plugins/info/1.0/',
            [
                'body' => [
                    'action' => 'plugin_information',
                    'request' => serialize((object) [
                        'slug' => $slug,
                        'fields' => [
                            'version' => false,
                        ],
                    ]),
                ],
            ]
        );

        if (is_wp_error($response)) {
            return $response;
        }

        return unserialize(wp_remote_retrieve_body($response));
    }

    /**
     * install_plugin
     *
     * @param  mixed $slug
     * @param  bool $active
     * @return mixed bool|WP_Error
     */
    public function install_plugin($slug = '', $active = true) {
        if (empty($slug)) {
            return new WP_Error('empty_arg', __('Argument should not be empty.'));
        }

        include_once ABSPATH . 'wp-admin/includes/file.php';
        include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
        include_once ABSPATH . 'wp-admin/includes/class-automatic-upgrader-skin.php';

        $plugin_data = $this->get_remote_plugin_data($slug);

        if (is_wp_error($plugin_data)) {
            return $plugin_data;
        }

        $upgrader = new \Plugin_Upgrader(new \Automatic_Upgrader_Skin());

        // install plugin
        $install = $upgrader->install($plugin_data->download_link);

        if (is_wp_error($install)) {
            return $install;
        }

        // activate plugin
        if ($install === true && $active) {
            $active = activate_plugin($upgrader->plugin_info(), '', false, true);

            if (is_wp_error($active)) {
                return $active;
            }

            return $active === null;
        }

        return $install;
    }

    /**
     * upgrade_plugin
     *
     * @param  mixed $basename
     * @return mixed bool|WP_Error
     */
    public function upgrade_plugin($basename = '') {
        if (empty($slug)) {
            return new WP_Error('empty_arg', __('Argument should not be empty.'));
        }

        include_once ABSPATH . 'wp-admin/includes/file.php';
        include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
        include_once ABSPATH . 'wp-admin/includes/class-automatic-upgrader-skin.php';

        $upgrader = new \Plugin_Upgrader(new \Automatic_Upgrader_Skin());

        // upgrade plugin
        return $upgrader->upgrade($basename);
    }

    public function ajax_install_plugin() {
        check_ajax_referer('exad-addons-elementor', 'security');

        if(!current_user_can( 'install_plugins' )) {
            wp_send_json_error(__('you are not allowed to do this action', 'exclusive-addons-elementor'));
        }

	    $slug   = isset( $_POST['slug'] ) ? sanitize_text_field( $_POST['slug'] ) : '';
	    $result = $this->install_plugin( $slug );

	    if ( is_wp_error( $result ) ) {
		    wp_send_json_error( $result->get_error_message() );
	    }

        wp_send_json_success(__('Plugin is installed successfully!', 'exclusive-addons-elementor'));
    }

    public function ajax_upgrade_plugin() {
        check_ajax_referer('exad-addons-elementor', 'security');
        //check user capabilities
        if(!current_user_can( 'update_plugins' )) {
            wp_send_json_error(__('you are not allowed to do this action', 'exclusive-addons-elementor'));
        }

	    $basename = isset( $_POST['basename'] ) ? sanitize_text_field( $_POST['basename'] ) : '';
	    $result   = $this->upgrade_plugin( $basename );

        if (is_wp_error($result)) {
            wp_send_json_error($result->get_error_message());
        }

        wp_send_json_success(__('Plugin is updated successfully!', 'exclusive-addons-elementor'));
    }

    public function ajax_activate_plugin() {
        check_ajax_referer('exad-addons-elementor', 'security');

        //check user capabilities
        if(!current_user_can( 'activate_plugins' )) {
            wp_send_json_error(__('you are not allowed to do this action', 'exclusive-addons-elementor'));
        }

	    $basename = isset( $_POST['basename'] ) ? sanitize_text_field( $_POST['basename'] ) : '';
	    $result   = activate_plugin( $basename, '', false, true );

	    if ( is_wp_error( $result ) ) {
		    wp_send_json_error( $result->get_error_message() );
	    }

        if ($result === false) {
            wp_send_json_error(__("Plugin couldn't be activated.", 'exclusive-addons-elementor'));
        }
        wp_send_json_success(__('Plugin is activated successfully!', 'exclusive-addons-elementor'));
    }

    public function exad_notice_dismiss() {
		check_ajax_referer( 'exad-addons-elementor', 'security' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( __( 'You are not allowed to do this action', 'exclusive-addons-elementor' ) );
		}

		update_option( 'exad_blocks_notice_hide', true );
		wp_send_json_success();
	}
}
