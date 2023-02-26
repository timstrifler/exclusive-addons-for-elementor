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
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function exad_blocks_Plugins_install_notice() {

        if ( is_plugin_active( 'shopcred/shopcred.php' ) || get_option( 'exad_blocks_notice_hide' ) ) {
            return;
        }

        $screen           				= get_current_screen();
        $is_exclude       				= ! empty( $_GET['post_type'] ) && in_array( $_GET['post_type'], [ 'elementor_library', 'product' ] );
        $ajax_url         				= admin_url( 'admin-ajax.php' );
        $nonce            				= wp_create_nonce( 'exad-addons-elementor' );
        $spc_not_installed 				= Helper::exad_get_local_plugin_data( 'shopcred/shopcred.php' ) === false;
        $action_spc_block          		= $spc_not_installed ? 'install' : 'activate';
        $button_spc_block_title     	= $spc_not_installed ? esc_html__( 'Install ShopCred', 'exclusive-addons-elementor' ) : esc_html__( 'Activate', 'exclusive-addons-elementor' );

        ?>
            <style>
        
                .exad-notice-wrapper {
                    border-left-color: #6636f6;
                    padding-top: 0;
                    padding-bottom: 0;
                    padding-left: 0;
                }

                .exad-notice-wrapper a {
                    color: #2271b1;
                }

                .exad-notice-wrapper .wpnotice-content-wrapper {
                    display: flex;
                    flex-direction: column;
                }

                .exad-notice-wrapper .wpnotice-content-wrapper > div {
                    padding-top: 15px;
                }

                .exad-notice-wrapper .exad-notice-logo {
                    width: 100%;
                    padding: 15px;
    
                    text-align: left;
                    background: rgba(98, 0, 238, .1);
                }

                .exad-notice-wrapper .exad-notice-logo img {
                    width: 10%;
                }

                .exad-notice-wrapper .exad-notice-content {
                    padding-left: 10px;
                }

                .exad-notice-wrapper .exad-notice-content a.exad-plugin-installer {
                    background: #6636f6;
                    
                }
            </style>
        
        <div class="exad-notice-wrapper wpnotice-wrapper notice notice-info is-dismissible exad-blocks-promo-notice">
            <div class="wpnotice-content-wrapper">
                <div class="exad-notice-logo">
                    <img src="<?php echo esc_url( EXAD_ASSETS_URL . 'img/main-logo.svg' ); ?>" alt="Exclusive logo">
                </div>
                <div class="exad-notice-content">
                    <h3><?php esc_html_e( 'Try ShopCred WooCommerce Blocks collection for Gutenberg', 'exclusive-addons-elementor' ); ?></h3>
                    <p><?php _e( 'Howdy 👋 Seems like you are using Gutenberg Editor on your website. Do you know you can get access to a bunch of WooCommerce Blocks for Gutenberg as well?', 'exclusive-addons-elementor' ); ?></p>
                    <p><?php _e( 'Try <strong>ShopCred WooCommerce Blocks for Gutenberg</strong> to make your Ecommerce Store even more powerful 🚀 For more info, <a href="https://exclusiveblocks.com/plugins/shopcred/" target="_blank">check out the demo</a>.', 'exclusive-addons-elementor' ); ?></p>
                    <p>
                        <a href="#" class="button-primary exad-plugin-installer"
                        data-action="<?php echo esc_attr( $action_spc_block ); ?>" data-slug="<?php echo esc_attr( 'shopcred' );?>"><?php echo esc_html( $button_spc_block_title ); ?></a>
                    </p>
                </div>
            </div>
        </div>

        <script>
            // install/activate plugin
            (function ($) {
                $(document).on("click", ".exad-plugin-installer", function (e) {
                    e.preventDefault();

                    var button = $(this),
                        action = button.data("action");
                        slug = button.data("slug");

                    if ($.active && typeof action != "undefined") {
                        button.text("Waiting...").attr("disabled", true);

                        setInterval(function () {
                            if (!$.active) {
                                button.attr("disabled", false).trigger("click");
                            }
                        }, 1000);
                    }

                    if (action === "install" && !$.active) {
                        button.text("Installing...").attr("disabled", true);

                        $.ajax({
                            url: "<?php echo esc_html( $ajax_url ); ?>",
                            type: "POST",
                            data: {
                                action: "exad_install_plugin",
                                security: "<?php echo esc_html( $nonce ); ?>",
                                slug: slug,
                            },
                            success: function (response) {
                                if (response.success) {
                                    button.text("Activated");
                                    button.data("action", null);

                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    button.text("Install");
                                }

                                button.attr("disabled", false);
                            },
                            error: function (err) {
                                console.log(err.responseJSON);
                            },
                        });
                    } else if (action === "activate" && !$.active) {
                        button.text("Activating...").attr("disabled", true);

                        $.ajax({
                            url: "<?php echo esc_html( $ajax_url ); ?>",
                            type: "POST",
                            data: {
                                action: "exad_activate_plugin",
                                security: "<?php echo esc_html( $nonce ); ?>",
                                basename: "shopcred/shopcred.php",
                            },
                            success: function (response) {
                                if (response.success) {
                                    button.text("Activated");
                                    button.data("action", null);

                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    button.text("Activate");
                                }

                                button.attr("disabled", false);
                            },
                            error: function (err) {
                                console.log(err.responseJSON);
                            },
                        });
                    }
                }).on('click', '.exad-blocks-promo-notice button.notice-dismiss', function (e) {
                    e.preventDefault();

                    var $notice_wrapper = $(this).closest('.exad-blocks-promo-notice');

                    $.ajax({
                        url: "<?php echo esc_html( $ajax_url ); ?>",
                        type: "POST",
                        data: {
                            action: "exad_notice_dismiss",
                            security: "<?php echo esc_html( $nonce ); ?>",
                        },
                        success: function (response) {
                            if (response.success) {
                                $notice_wrapper.remove();
                            } else {
                                console.log(response.data);
                            }
                        },
                        error: function (err) {
                            console.log(err.responseText);
                        },
                    });
                });
            })(jQuery);
        </script>
        <?php

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
            wp_send_json_error(__('Plugin couldn\'t be activated.', 'exclusive-addons-elementor'));
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
