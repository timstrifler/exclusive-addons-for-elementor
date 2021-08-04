<?php
namespace ExclusiveAddons\Elementor;

use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Group_Control_Background;
use \ExclusiveAddons\Elementor\Helper;

class Reading_Progress {

    private static $_instance = null;
    public $extensions_data = [];

    public function __construct() {
        add_action( 'elementor/documents/register_controls', array( $this, 'exad_reading_progress_register_controls' ), 10);
        add_action( 'elementor/editor/after_save', array( $this, 'save_global_values'), 10, 2 );
        add_action( 'wp_footer', array( $this, 'exad_reading_progress_render_html') );
       
    }

    public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

    public function exad_reading_progress_register_controls($element) {

        $global_settings = get_option('exad_global_settings');

        $element->start_controls_section(
            'exad_reading_progress_section',
            [
                'label' => __('<i class="eaicon-logo"></i> Reading Progress Bar', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'exad_reading_progress',
            [
                'label' => __('Enable Reading Progress Bar', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', 'exclusive-addons-elementor'),
                'label_off' => __('No', 'exclusive-addons-elementor'),
                'return_value' => 'yes',
            ]
        );

        $element->add_control(
            'exad_reading_progress_has_global',
            [
                'label' => __('Enabled Globally?', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::HIDDEN,
                'default' => (isset($global_settings['reading_progress']['enabled']) ? $global_settings['reading_progress']['enabled'] : false),
            ]
        );

        if (isset($global_settings['reading_progress']['enabled']) && ($global_settings['reading_progress']['enabled'] == true) && get_the_ID() != $global_settings['reading_progress']['post_id'] && get_post_status($global_settings['reading_progress']['post_id']) == 'publish') {
            $element->add_control(
                'exad_global_warning_text',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => __('You can modify the Global Reading Progress Bar by <strong><a href="' . get_bloginfo('url') . '/wp-admin/post.php?post=' . $global_settings['reading_progress']['post_id'] . '&action=elementor">Clicking Here</a></strong>', 'exclusive-addons-elementor'),
                    'content_classes' => 'exad-warning',
                    'separator' => 'before',
                    'condition' => [
                        'exad_reading_progress' => 'yes',
                    ],
                ]
            );
        } else {
            $element->add_control(
                'exad_reading_progress_global',
                [
                    'label' => __('Enable Reading Progress Bar Globally', 'exclusive-addons-elementor'),
                    'description' => __('Enabling this option will effect on entire site.', 'exclusive-addons-elementor'),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'label_on' => __('Yes', 'exclusive-addons-elementor'),
                    'label_off' => __('No', 'exclusive-addons-elementor'),
                    'return_value' => 'yes',
                    'separator' => 'before',
                    'condition' => [
                        'exad_reading_progress' => 'yes',
                    ],
                ]
            );

            $element->add_control(
                'exad_reading_progress_global_display_condition',
                [
                    'label' => __('Display On', 'exclusive-addons-elementor'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'all',
                    'options' => [
                        'posts' => __('All Posts', 'exclusive-addons-elementor'),
                        'pages' => __('All Pages', 'exclusive-addons-elementor'),
                        'all' => __('All Posts & Pages', 'exclusive-addons-elementor'),
                    ],
                    'condition' => [
                        'exad_reading_progress' => 'yes',
                        'exad_reading_progress_global' => 'yes',
                    ],
                    'separator' => 'before',
                ]
            );
        }

        $element->add_control(
        	'exad_reading_progress_page_select',
        	[
				'label'       => __( 'Selected Pages', 'exclusive-addons-elementor' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => [],
				'options'     => Helper::exad_get_page_title_for_readingProgress(),
                'condition' => [
                    'exad_reading_progress' => 'yes',
                    'exad_reading_progress_global' => 'yes',
                    'exad_reading_progress_global_display_condition' => 'pages',
                ],
            ]
        );

        $element->add_control(
            'exad_reading_progress_position',
            [
                'label' => esc_html__('Position', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'top',
                'label_block' => false,
                'options' => [
                    'top' => esc_html__('Top', 'exclusive-addons-elementor'),
                    'bottom' => esc_html__('Bottom', 'exclusive-addons-elementor'),
                ],
                'separator' => 'before',
                'condition' => [
                    'exad_reading_progress' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'exad_reading_progress_height',
            [
                'label' => __('Height', 'exclusive-addons-elementor'),
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
                    '.exad-reading-progress-wrap .exad-reading-progress' => 'height: {{SIZE}}{{UNIT}} !important',
                    '.exad-reading-progress-wrap .exad-reading-progress .exad-reading-progress-fill' => 'height: {{SIZE}}{{UNIT}} !important',
                ],
                'separator' => 'before',
                'condition' => [
                    'exad_reading_progress' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'exad_reading_progress_bg_color',
            [
                'label' => __('Background Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#00D8D8',
                'selectors' => [
                    '.exad-reading-progress' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before',
                'condition' => [
                    'exad_reading_progress' => 'yes',
                ],
            ]
        );

        $element->add_control(
            'exad_reading_progress_fill_color',
            [
                'label' => __('Fill Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7A56FF',
                'selectors' => [
                    '.exad-reading-progress-fill' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before',
                'condition' => [
                    'exad_reading_progress' => 'yes',
                ],
            ]
        );

        // $element->add_group_control(
		// 	Group_Control_Background::get_type(),
		// 	[
		// 		'name' => 'exad_reading_progress_fill_color',
		// 		'label' => __( 'Fill Color', 'exclusive-addons-elementor' ),
		// 		'types' => [ 'classic', 'gradient' ],
        //         'default' => '#7A56FF',
		// 		'selector' => '.exad-reading-progress .exad-reading-progress-fill',
        //         'separator' => 'before',
        //         'condition' => [
        //             'exad_reading_progress' => 'yes',
        //         ],
		// 	]
		// );

        $element->add_control(
            'exad_reading_progress_animation_speed',
            [
                'label' => __('Animation Speed', 'exclusive-addons-elementor'),
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
                    '.exad-reading-progress-wrap .exad-reading-progress .exad-reading-progress-fill' => 'transition: width {{SIZE}}ms ease;',
                ],
                'separator' => 'before',
                'condition' => [
                    'exad_reading_progress' => 'yes',
                ],
            ]
        );

        $element->end_controls_section();
        // $element->end_controls_section();
    }

     /**
     * Inject global extension html.
     *
     * @since v3.1.4
     */
    public function exad_reading_progress_render_html( $section ) {
        $post_id = get_the_ID();
        $html = '';
        $global_settings = $setting_data = $document = [];
        
        
        $html = '';
        
        $global_settings = get_option('exad_global_settings');
        $document = Plugin::$instance->documents->get($post_id, false);
        
        $html .= '<pre>' . print_r($global_settings) .'</pre>';
       
        if (is_object($document)) {
            $settings_data = $document->get_settings();
        }
        

        // Reading Progress Bar
      
            $reading_progress_status = $global_reading_progress = false;
           
            if (isset($settings_data['exad_reading_progress']) && $settings_data['exad_reading_progress'] == 'yes') {
                $reading_progress_status = true;
            } elseif (isset($global_settings['reading_progress']['enabled']) && $global_settings['reading_progress']['enabled']) {
                $reading_progress_status = true;
                $global_reading_progress = true;
                $settings_data = $global_settings['reading_progress'];
                $exad_reading_progress_page_select = $this->get_extensions_value('exad_reading_progress_page_select');
            }

            if ($reading_progress_status ) {
                $this->extensions_data = $settings_data;
                $progress_height = !empty($settings_data['exad_reading_progress_height']['size']) ? $settings_data['exad_reading_progress_height']['size'] : '';
                $animation_speed = !empty($settings_data['exad_reading_progress_animation_speed']['size']) ? $settings_data['exad_reading_progress_animation_speed']['size'] : '';
                $reading_progress_html = '';
                $reading_progress_html .= '<div class="masum exad-reading-progress-wrap exad-reading-progress-wrap-' . ($this->get_extensions_value('exad_reading_progress') == 'yes' ? 'local' : 'global') . '">';

                if ($global_reading_progress) {
                    $reading_progress_html .= '<div class="exad-reading-progress exad-reading-progress-global exad-reading-progress-' . $this->get_extensions_value('exad_reading_progress_position') . '" style=" z-index: 999999; height: ' . $progress_height . 'px;background-color: ' . $this->get_extensions_value('exad_reading_progress_bg_color') . '">
                        <div class="exad-reading-progress-fill" style="height: ' . $progress_height . 'px;background-color: ' . $this->get_extensions_value('exad_reading_progress_fill_color') . ';transition: width ' . $animation_speed . 'ms ease;"></div>
                    </div>';
                } else {
                    $reading_progress_html .= '<div class="exad-reading-progress exad-reading-progress-local exad-reading-progress-' .$this->get_extensions_value('exad_reading_progress_position') . '" style="z-index: 999999;">
                        <div class="exad-reading-progress-fill" style="height: ' . $progress_height . 'px;background-color: ' . $this->get_extensions_value('exad_reading_progress_fill_color') . ';transition: width ' . $animation_speed . 'ms ease;"></div>
                    </div>';
                }

                $reading_progress_html .= '</div>';

                if ($this->get_extensions_value('exad_reading_progress') != 'yes') {
                    $display_condition = $this->get_extensions_value('exad_reading_progress_global_display_condition');
                    if (get_post_status($this->get_extensions_value('post_id')) != 'publish') {
                        $reading_progress_html = '';
                    } else if ($display_condition == 'pages' && !is_page()) {
                        $reading_progress_html = '';
                    } else if ($display_condition == 'posts' && !is_single()) {
                        $reading_progress_html = '';
                    }
                }

                if (!empty($reading_progress_html)) {
                    //$html .= var_dump($this->get_extensions_value('exad_reading_progress_animation_speed'));
                    wp_enqueue_script('exad-reading-progress');
                    wp_enqueue_style('exad-reading-progress');
                    
                    $html .= $reading_progress_html;
                }
            }
        
           
        echo $html;
    }

    public function get_extensions_value($key = '') {
        return isset($this->extensions_data[$key]) ? $this->extensions_data[$key] : '';
    }

   /**
     * Save default values to db
     *
     * @since v3.0.0
     */
    public function save_global_values($post_id, $editor_data) {
        if (wp_doing_cron()) {
            return;
        }

        $document = Plugin::$instance->documents->get($post_id, false);
        $global_settings = get_option('exad_global_settings');

        if ($document->get_settings('exad_reading_progress_global') == 'yes' && $document->get_settings('exad_reading_progress') == 'yes') {
            $global_settings['reading_progress'] = [
                'post_id' => $post_id,
                'enabled' => true,
                'exad_reading_progress_global_display_condition' => $document->get_settings('exad_reading_progress_global_display_condition'),
                'exad_reading_progress_page_select' => $document->get_settings('exad_reading_progress_page_select'),
                'exad_reading_progress_position' => $document->get_settings('exad_reading_progress_position'),
                'exad_reading_progress_height' => $document->get_settings('exad_reading_progress_height'),
                'exad_reading_progress_bg_color' => $document->get_settings('exad_reading_progress_bg_color'),
                'exad_reading_progress_fill_color' => $document->get_settings('exad_reading_progress_fill_color'),
                'exad_reading_progress_animation_speed' => $document->get_settings('exad_reading_progress_animation_speed'),
            ];
        } else {
            if (isset($global_settings['reading_progress']['post_id']) && $global_settings['reading_progress']['post_id'] == $post_id) {
                $global_settings['reading_progress'] = [
                    'post_id' => null,
                    'enabled' => false,
                ];
            }
        }
        // set editor time
        update_option('exad_editor_updated_at', strtotime('now'));

        // update options
        update_option('exad_global_settings', $global_settings);
    }

}
Reading_Progress::instance();