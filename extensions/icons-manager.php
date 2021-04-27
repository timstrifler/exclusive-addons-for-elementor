<?php
namespace Exclusive_Addons\Elementor\Extensions;

defined( 'ABSPATH' ) || die();

class Icons_Manager {

    public static function init() {
        add_filter( 'elementor/icons_manager/additional_tabs', [ __CLASS__, 'add_exclusive_icons_tab' ] );
    }

    public static function add_exclusive_icons_tab( $tabs ) {
        $tabs['feather-icons'] = [
            'name' => 'feather-icons',
            'label' => __( 'Feather Icons', 'exclusive-addons-elementor' ),
            'url' => EXAD_ASSETS_URL . 'fonts/feather-icon/feather-icon-style.min.css',
            'enqueue' => [ EXAD_ASSETS_URL . 'fonts/feather-icon/feather-icon-style.min.css' ],
            'prefix' => 'icon-',
            'displayPrefix' => 'feather',
            'labelIcon' => 'exad exad-logo feather icon-feather exad-font-manager',
            'ver' => EXAD_PLUGIN_VERSION,
            'fetchJson' => EXAD_ASSETS_URL . 'fonts/feather-icon/exclusive-icons.js?v=' . EXAD_PLUGIN_VERSION,
            'native' => false,
        ];

        $tabs['remix-icons'] = [
            'name' => 'remix-icons',
            'label' => __( 'Remix Icons', 'exclusive-addons-elementor' ),
            'url' => EXAD_ASSETS_URL . 'fonts/remix-icon/remixicon.min.css',
            'enqueue' => [ EXAD_ASSETS_URL . 'fonts/remix-icon/remixicon.min.css' ],
            'prefix' => 'ri-',
            'displayPrefix' => 'remixicon',
            'labelIcon' => 'exad exad-logo remixicon ri-remixicon-fill exad-font-manager',
            'ver' => EXAD_PLUGIN_VERSION,
            'fetchJson' => EXAD_ASSETS_URL . 'fonts/remix-icon/remix-icon.js?v=' . EXAD_PLUGIN_VERSION,
            'native' => false,
        ];

        $tabs['teeny-icons'] = [
            'name' => 'teeny-icons',
            'label' => __( 'Teeny Icons', 'exclusive-addons-elementor' ),
            'url' => EXAD_ASSETS_URL . 'fonts/teeny-icon/teeny-icon-style.min.css',
            'enqueue' => [ EXAD_ASSETS_URL . 'fonts/teeny-icon/teeny-icon-style.min.css' ],
            'prefix' => 'ti-',
            'displayPrefix' => 'teenyicon',
            'labelIcon' => 'exad exad-logo teenyicon ti-mood-laugh exad-font-manager',
            'ver' => EXAD_PLUGIN_VERSION,
            'fetchJson' => EXAD_ASSETS_URL . 'fonts/teeny-icon/teeny-icon.js?v=' . EXAD_PLUGIN_VERSION,
            'native' => false,
        ];
        return $tabs;
    }

}

Icons_Manager::init();
