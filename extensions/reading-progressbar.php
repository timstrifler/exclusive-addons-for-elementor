<?php
namespace ExclusiveAddons\Elementor;

if (!defined('ABSPATH')) {
    exit;
}

use \ExclusiveAddons\Elementor\Helper;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Group_Control_Background;

class Reading_Progress {

    public static $extensions_data = [];

    public static function init() {
        add_action( 'elementor/documents/register_controls', array( __CLASS__, 'register_controls' ), 10);
        add_action( 'wp_footer', array( __CLASS__, 'render_global_html') );
        add_action('elementor/editor/after_save', array( __CLASS__, 'save_global_values'), 10, 2 );
    }

    public static function register_controls($element) {

        $global_settings = get_option('eael_global_settings');

        $element->start_controls_section(
            'eael_ext_reading_progress_section',
            [
                'label' => __('Reading Progress Bar <i class="exad-extention-logo exad exad-logo"></i>', 'essential-addons-for-elementor-lite'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'eael_ext_reading_progress',
            [
                'label' => __('Enable Reading Progress Bar', 'essential-addons-for-elementor-lite'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', 'essential-addons-for-elementor-lite'),
                'label_off' => __('No', 'essential-addons-for-elementor-lite'),
                'return_value' => 'yes',
            ]
        );

        $element->add_control(
            'eael_ext_reading_progress_has_global',
            [
                'label' => __('Enabled Globally?', 'essential-addons-for-elementor-lite'),
                'type' => Controls_Manager::HIDDEN,
                'default' => (isset($global_settings['reading_progress']['enabled']) ? $global_settings['reading_progress']['enabled'] : false),
            ]
        );

        if (isset($global_settings['reading_progress']['enabled']) && ($global_settings['reading_progress']['enabled'] == true) && get_the_ID() != $global_settings['reading_progress']['post_id'] && get_post_status($global_settings['reading_progress']['post_id']) == 'publish') {
            $element->add_control(
                'eael_global_warning_text',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => __('You can modify the Global Reading Progress Bar by <strong><a href="' . get_bloginfo('url') . '/wp-admin/post.php?post=' . $global_settings['reading_progress']['post_id'] . '&action=elementor">Clicking Here</a></strong>', 'essential-addons-for-elementor-lite'),
                    'content_classes' => 'eael-warning',
                    'separator' => 'before',
                    'condition' => [
                        'eael_ext_reading_progress' => 'yes',
                    ],
                ]
            );
        } else {
            $element->add_control(
                'eael_ext_reading_progress_global',
                [
                    'label' => __('Enable Reading Progress Bar Globally', 'essential-addons-for-elementor-lite'),
                    'description' => __('Enabling this option will effect on entire site.', 'essential-addons-for-elementor-lite'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_on' => __('Yes', 'essential-addons-for-elementor-lite'),
                    'label_off' => __('No', 'essential-addons-for-elementor-lite'),
                    'return_value' => 'yes',
                    'separator' => 'before',
                    'condition' => [
                        'eael_ext_reading_progress' => 'yes',
                    ],
                ]
            );

            $element->add_control(
                'eael_ext_reading_progress_global_display_condition',
                [
                    'label' => __('Display On', 'essential-addons-for-elementor-lite'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'all',
                    'options' => [
                        'posts' => __('All Posts', 'essential-addons-for-elementor-lite'),
                        'pages' => __('All Pages', 'essential-addons-for-elementor-lite'),
                        'all' => __('All Posts & Pages', 'essential-addons-for-elementor-lite'),
                    ],
                    'condition' => [
                        'eael_ext_reading_progress' => 'yes',
                        'eael_ext_reading_progress_global' => 'yes',
                    ],
                    'separator' => 'before',
                ]
            );
        }

        $element->add_control(
            'eael_ext_reading_progress_position',
            [
                'label' => esc_html__('Position', 'essential-addons-for-elementor-lite'),
                'type' => Controls_Manager::SELECT,
                'default' => 'top',
                'label_block' => false,
                'options' => [
                    'top' => esc_html__('Top', 'essential-addons-for-elementor-lite'),
                    'bottom' => esc_html__('Bottom', 'essential-addons-for-elementor-lite'),
                ],
                'separator' => 'before',
                'condition' => [
                    'eael_ext_reading_progress' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'eael_ext_reading_progress_height',
            [
                'label' => __('Height', 'essential-addons-for-elementor-lite'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '.exad-reading-progress' => 'height: {{SIZE}}{{UNIT}} !important',
                    // '.eael-reading-progress-wrap .eael-reading-progress .eael-reading-progress-fill' => 'height: {{SIZE}}{{UNIT}} !important',
                ],
                'separator' => 'before',
                'condition' => [
                    'eael_ext_reading_progress' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'eael_ext_reading_progress_bg_color',
            [
                'label' => __('Bar Background Color', 'essential-addons-for-elementor-lite'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.exad-reading-progress' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before',
                'condition' => [
                    'eael_ext_reading_progress' => 'yes',
                ],
            ]
        );

        $element->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'eael_ext_reading_progress_fill_color',
				'label' => __( 'Background', 'exclusive-addons-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '.exad-reading-progress .exad-reading-progress-fill',
			]
		);

        // $element->add_control(
        //     'eael_ext_reading_progress_fill_color',
        //     [
        //         'label' => __('Fill Color', 'essential-addons-for-elementor-lite'),
        //         'type' => Controls_Manager::COLOR,
        //         'default' => '#1fd18e',
        //         'selectors' => [
        //             '.eael-reading-progress-wrap .eael-reading-progress .eael-reading-progress-fill' => 'background-color: {{VALUE}} !important',
        //         ],
        //         'separator' => 'before',
        //         'condition' => [
        //             'eael_ext_reading_progress' => 'yes',
        //         ],
        //     ]
        // );

        $element->add_control(
            'eael_ext_reading_progress_animation_speed',
            [
                'label' => __('Animation Speed', 'essential-addons-for-elementor-lite'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '.eael-reading-progress-wrap .eael-reading-progress .eael-reading-progress-fill' => 'transition: width {{SIZE}}ms ease;',
                ],
                'separator' => 'before',
                'condition' => [
                    'eael_ext_reading_progress' => 'yes',
                ],
            ]
        );

        $element->end_controls_section();
    }

     /**
     * Inject global extension html.
     *
     * @since v3.1.4
     */
    public static function render_global_html( $section ) {
        // if (!apply_filters('eael/is_plugin_active', 'elementor/elementor.php')) {
        //     return;
        // }

        if (!is_singular()) {
            return;
        }
        
        $global_settings = $setting_data = $document = [];

        // if ( $this->get_settings('reading-progressbar') ) {
            $post_id = get_the_ID();
            $html = '';
            $global_settings = get_option('eael_global_settings');
            $document = Plugin::$instance->documents->get($post_id, false);

            if (is_object($document)) {
                $settings_data = $document->get_settings();
            }
        // }

        if (isset($settings_data['eael_ext_reading_progress']) && $settings_data['eael_ext_reading_progress'] == 'yes') {
            $html = '<div class="exad-reading-progress">
                        <div class="exad-reading-progress-fill" id="myBar"></div>
                    </div>';

            // if (!empty($reading_progress_html)) {
                // wp_enqueue_script('exad-reading-progress');
                // wp_enqueue_style('eael-reading-progress');

                // $html .= $reading_progress_html;
                ?>
                <script>
                    (function ($) {

                        $( window ).scroll(function () { 
                            var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                            var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                            var scrolled = (winScroll / height) * 100;
                            document.getElementById("myBar").style.width = scrolled + "%";
                        });
                    
                    }(jQuery));
                </script>
                <?php
            // }
        }

        // Reading Progress Bar
        // if ($this->get_settings('reading-progressbar') == true) {
            // $reading_progress_status = $global_reading_progress = false;

            // if (isset($settings_data['eael_ext_reading_progress']) && $settings_data['eael_ext_reading_progress'] == 'yes') {
            //     $reading_progress_status = true;
            // } elseif (isset($global_settings['reading_progress']['enabled']) && $global_settings['reading_progress']['enabled']) {
            //     $reading_progress_status = true;
            //     $global_reading_progress = true;
            //     $settings_data = $global_settings['reading_progress'];
            // }

            // if ($reading_progress_status) {
            //     $this->extensions_data = $settings_data;
            //     $progress_height = !empty($settings_data['eael_ext_reading_progress_height']['size']) ? $settings_data['eael_ext_reading_progress_height']['size'] : '';
            //     $animation_speed = !empty($settings_data['eael_ext_reading_progress_animation_speed']['size']) ? $settings_data['eael_ext_reading_progress_animation_speed']['size'] : '';

            //     $reading_progress_html = '<div class="eael-reading-progress-wrap eael-reading-progress-wrap-' . ($this->get_extensions_value('eael_ext_reading_progress') == 'yes' ? 'local' : 'global') . '">';

            //     if ($global_reading_progress) {
            //         $reading_progress_html .= '<div class="eael-reading-progress eael-reading-progress-global eael-reading-progress-' . $this->get_extensions_value('eael_ext_reading_progress_position') . '" style="height: ' . $progress_height . 'px;background-color: ' . $this->get_extensions_value('eael_ext_reading_progress_bg_color') . ';">
            //             <div class="eael-reading-progress-fill" style="height: ' . $progress_height . 'px;background-color: ' . $this->get_extensions_value('eael_ext_reading_progress_fill_color') . ';transition: width ' . $animation_speed . 'ms ease;"></div>
            //         </div>';
            //     } else {
            //         $reading_progress_html .= '<div class="eael-reading-progress eael-reading-progress-local eael-reading-progress-' . $this->get_extensions_value('eael_ext_reading_progress_position') . '">
            //             <div class="eael-reading-progress-fill"></div>
            //         </div>';
            //     }
                
            //     $reading_progress_html .= '</div>';

            //     if ($this->get_extensions_value('eael_ext_reading_progress') != 'yes') {
            //         $display_condition = $this->get_extensions_value('eael_ext_reading_progress_global_display_condition');
            //         if (get_post_status($this->get_extensions_value('post_id')) != 'publish') {
            //             $reading_progress_html = '';
            //         } else if ($display_condition == 'pages' && !is_page()) {
            //             $reading_progress_html = '';
            //         } else if ($display_condition == 'posts' && !is_single()) {
            //             $reading_progress_html = '';
            //         }
            //     }

            //     if (!empty($reading_progress_html)) {
            //         wp_enqueue_script('exad-reading-progress');
            //         wp_enqueue_style('eael-reading-progress');

            //         $html .= $reading_progress_html;
            //     }
            // }
        // }

        echo $html;
    }

    public static function save_global_values( $post_id, $editor_data ){

        $document = Plugin::$instance->documents->get($post_id, false);
        $global_settings = get_option('eael_global_settings');

        if ($document->get_settings('eael_ext_reading_progress_global') == 'yes' && $document->get_settings('eael_ext_reading_progress') == 'yes') {
            $global_settings['reading_progress'] = [
                'post_id' => $post_id,
                'enabled' => true,
                'eael_ext_reading_progress_global_display_condition' => $document->get_settings('eael_ext_reading_progress_global_display_condition'),
                'eael_ext_reading_progress_position' => $document->get_settings('eael_ext_reading_progress_position'),
                'eael_ext_reading_progress_height' => $document->get_settings('eael_ext_reading_progress_height'),
                'eael_ext_reading_progress_bg_color' => $document->get_settings('eael_ext_reading_progress_bg_color'),
                'eael_ext_reading_progress_fill_color' => $document->get_settings('eael_ext_reading_progress_fill_color'),
                'eael_ext_reading_progress_animation_speed' => $document->get_settings('eael_ext_reading_progress_animation_speed'),
            ];
        } else {
            if (isset($global_settings['reading_progress']['post_id']) && $global_settings['reading_progress']['post_id'] == $post_id) {
                $global_settings['reading_progress'] = [
                    'post_id' => null,
                    'enabled' => false,
                ];
            }
        }

        update_option('eael_global_settings', $global_settings);
    }

    public static function get_extensions_value($key = '')
    {
        return isset($this->extensions_data[$key]) ? $this->extensions_data[$key] : '';
    }
}
Reading_Progress::init();