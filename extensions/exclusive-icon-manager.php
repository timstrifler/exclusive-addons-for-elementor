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
            'url' => EXAD_ASSETS_URL . 'fonts/style.css',
            'enqueue' => [ EXAD_ASSETS_URL . 'fonts/style.css' ],
            'prefix' => 'icon-',
            'displayPrefix' => 'feather',
            'labelIcon' => 'exad exad-logo feather icon-feather exad-font-manager',
            'ver' => EXAD_PLUGIN_VERSION,
            'fetchJson' => EXAD_ASSETS_URL . 'fonts/exclusive-icons.js?v=' . EXAD_PLUGIN_VERSION,
            'native' => false,
        ];

        $tabs['remix-icons'] = [
            'name' => 'remix-icons',
            'label' => __( 'Remix Icons', 'exclusive-addons-elementor' ),
            'url' => EXAD_ASSETS_URL . 'fonts/remixicon.css',
            'enqueue' => [ EXAD_ASSETS_URL . 'fonts/remixicon.css' ],
            'prefix' => 'ri-',
            'displayPrefix' => 'remixicon',
            'labelIcon' => 'exad exad-logo remixicon ri-remixicon-fill exad-font-manager',
            'ver' => EXAD_PLUGIN_VERSION,
            'fetchJson' => EXAD_ASSETS_URL . 'fonts/remix-icon.js?v=' . EXAD_PLUGIN_VERSION,
            'native' => false,
        ];

        $tabs['teeny-icons'] = [
            'name' => 'teeny-icons',
            'label' => __( 'Teeny Icons', 'exclusive-addons-elementor' ),
            'url' => EXAD_ASSETS_URL . 'fonts/teeny-icon-style.css',
            'enqueue' => [ EXAD_ASSETS_URL . 'fonts/teeny-icon-style.css' ],
            'prefix' => 'ti-',
            'displayPrefix' => 'teenyicon',
            'labelIcon' => 'exad exad-logo teenyicon ti-mood-laugh exad-font-manager',
            'ver' => EXAD_PLUGIN_VERSION,
            'fetchJson' => EXAD_ASSETS_URL . 'fonts/teeny-icon.js?v=' . EXAD_PLUGIN_VERSION,
            'native' => false,
        ];
        return $tabs;
    }

    /**
     * Get a list of happy icons
     *
     * @return array
     */
    public static function get_exclusive_icons() {
        return [
            'exad exad-alarm-clock' => 'alarm-clock',
            'exad exad-atomic' => 'atomic',
            'exad exad-bar-chart' => 'bar-chart',
            'exad exad-battery' => 'battery',
            'exad exad-battery-1' => 'battery-1',
            'exad exad-bell' => 'bell',
            'exad exad-bluetooth' => 'bluetooth',
            'exad exad-book' => 'book',
        ];
    }

}

Icons_Manager::init();
