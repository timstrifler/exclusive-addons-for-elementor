<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

class Animated_Text extends Widget_Base {

	public function get_name() {
		return 'exad-animated-text';
	}

	public function get_title() {
		return esc_html__( 'Animated Text', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad exad-logo exad-animated-text';
	}

   	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	  
	public function get_keywords() {
        return [ 'exclusive', 'fancy', 'heading', 'animate', 'animation' ];
    } 
    
 	public function get_script_depends() {
		return [ 'exad-animated-text' ];
	}

	protected function register_controls() {
		$exad_secondary_color = get_option( 'exad_secondary_color_option', '#00d8d8' );
		
	    /*
	    * Animated Text Content
	    */
	    $this->start_controls_section(
	        'exad_section_animated_text_content',
	        [
	            'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
	        ]
		);
		
		$this->add_control(
	        'exad_animated_text_before_text',
	        [
				'label'   => esc_html__( 'Before Text', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'This is', 'exclusive-addons-elementor' ),
				'dynamic' => [
					'active' => true,
				]
	        ]
		);

		$this->add_control(
			'exad_animated_text_animated_heading',
			[
				'label'       => esc_html__( 'Animated Text', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your animated text with comma separated.', 'exclusive-addons-elementor' ),
				'description' => __( '<b>Write animated heading with comma separated. Example: Exclusive, Addons, Elementor</b>', 'exclusive-addons-elementor' ),
				'default'     => esc_html__( 'Exclusive, Addons, Elementor', 'exclusive-addons-elementor' ),
				'dynamic'     => [ 'active' => true ]
			]
		);
		
		$this->add_control(
	        'exad_animated_text_after_text',
	        [
				'label'   => esc_html__( 'After Text', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'For You.', 'exclusive-addons-elementor' ),
				'dynamic' => [
					'active' => true,
				]
	        ]
		);

		$this->add_control(
			'exad_animated_text_animated_heading_tag',
			[
				'label'   => esc_html__( 'HTML Tag', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'h3',
				'toggle'  => false,
				'options' => [
					'h1'  => [
						'title' => __( 'H1', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-editor-h1'
					],
					'h2'  => [
						'title' => __( 'H2', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-editor-h2'
					],
					'h3'  => [
						'title' => __( 'H3', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-editor-h3'
					],
					'h4'  => [
						'title' => __( 'H4', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-editor-h4'
					],
					'h5'  => [
						'title' => __( 'H5', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-editor-h5'
					],
					'h6'  => [
						'title' => __( 'H6', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-editor-h6'
					]
				]
			]
		);

		$this->add_control(
			'exad_animated_text_animated_heading_alignment',
			[
				'label'   => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'exad-animated-text-align-left'   => [
						'title' => __( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-left'
					],
					'exad-animated-text-align-center' => [
						'title' => __( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-center'
					],
					'exad-animated-text-align-right'  => [
						'title' => __( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default' => 'exad-animated-text-align-center'
			]
		);

		$this->end_controls_section();

		/*
	    * Animated Text Container Style
	    */
	    $this->start_controls_section(
	        'exad_section_animated_text_animation_tyle',
	        [
				'label' => esc_html__( 'Animation', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
	        ]
		);

		$this->add_control(
			'exad_animated_text_animated_heading_animated_type',
			[
				'label'   => esc_html__( 'Animation Type', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'exad-morphed-animation',
				'options' => [
					'exad-typed-animation'   => __( 'Typed', 'exclusive-addons-elementor' ),
					'exad-morphed-animation' => __( 'Animate', 'exclusive-addons-elementor' )
				]
			]
		);

		$this->add_control(
			'exad_animated_text_animated_heading_animation_style',
			[
				'label'   => esc_html__( 'Animation Style', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fadeIn',
				'options' => [
					'fadeIn'            => __( 'Fade In', 'exclusive-addons-elementor' ),
					'fadeInUp'          => __( 'Fade In Up', 'exclusive-addons-elementor' ),
					'fadeInDown'        => __( 'Fade In Down', 'exclusive-addons-elementor' ),
					'fadeInLeft'        => __( 'Fade In Left', 'exclusive-addons-elementor' ),
					'fadeInRight'       => __( 'Fade In Right', 'exclusive-addons-elementor' ),
					'zoomIn'            => __( 'Zoom In', 'exclusive-addons-elementor' ),
					'zoomInUp'          => __( 'Zoom In Up', 'exclusive-addons-elementor' ),
					'zoomInDown'        => __( 'Zoom In Down', 'exclusive-addons-elementor' ),
					'zoomInLeft'        => __( 'Zoom In Left', 'exclusive-addons-elementor' ),
					'zoomInRight'       => __( 'Zoom In Right', 'exclusive-addons-elementor' ),
					'slideInDown'       => __( 'Slide In Down', 'exclusive-addons-elementor' ),
					'slideInUp'         => __( 'Slide In Up', 'exclusive-addons-elementor' ),
					'slideInLeft'       => __( 'Slide In Left', 'exclusive-addons-elementor' ),
					'slideInRight'      => __( 'Slide In Right', 'exclusive-addons-elementor' ),
					'bounce'            => __( 'Bounce', 'exclusive-addons-elementor' ),
					'bounceIn'          => __( 'Bounce In', 'exclusive-addons-elementor' ),
					'bounceInUp'        => __( 'Bounce In Up', 'exclusive-addons-elementor' ),
					'bounceInDown'      => __( 'Bounce In Down', 'exclusive-addons-elementor' ),
					'bounceInLeft'      => __( 'Bounce In Left', 'exclusive-addons-elementor' ),
					'bounceInRight'     => __( 'Bounce In Right', 'exclusive-addons-elementor' ),
					'flash'             => __( 'Flash', 'exclusive-addons-elementor' ),
					'pulse'             => __( 'Pulse', 'exclusive-addons-elementor' ),
					'rotateIn'          => __( 'Rotate In', 'exclusive-addons-elementor' ),
					'rotateInDownLeft'  => __( 'Rotate In Down Left', 'exclusive-addons-elementor' ),
					'rotateInDownRight' => __( 'Rotate In Down Right', 'exclusive-addons-elementor' ),
					'rotateInUpRight'   => __( 'rotate In Up Right', 'exclusive-addons-elementor' ),
					'rotateIn'          => __( 'Rotate In', 'exclusive-addons-elementor' ),
					'rollIn'            => __( 'Roll In', 'exclusive-addons-elementor' ),
					'lightSpeedIn'      => __( 'Light Speed In', 'exclusive-addons-elementor' )
				],
				'condition' => [
					'exad_animated_text_animated_heading_animated_type' => 'exad-morphed-animation'
				]
			]
		);

		$this->end_controls_section();

		/*
	    * Animated Text Settings
	    */
	    $this->start_controls_section(
	        'exad_section_animated_text_settings',
	        [
				'label' => esc_html__( 'Settings', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
	        ]
		);

		$this->add_control(
			'exad_animated_text_animation_speed',
			[
				'label'     => __( 'Animation Speed', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 100,
				'max'       => 10000,
				'condition' => [
					'exad_animated_text_animated_heading_animated_type' => 'exad-morphed-animation'
				]
			]
		);

		$this->add_control(
			'exad_animated_text_type_speed',
			[
				'label'   => __( 'Type Speed', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 60,
				'min'     => 10,
				'max'     => 200,
				'step'    => 10,
				'condition' => [
					'exad_animated_text_animated_heading_animated_type' => 'exad-typed-animation'
				]
			]
		);

		$this->add_control(
			'exad_animated_text_start_delay',
			[
				'label'     => __( 'Start Delay', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 1000,
				'max'       => 10000,
				'condition' => [
					'exad_animated_text_animated_heading_animated_type' => 'exad-typed-animation'
				]
			]
		);

		$this->add_control(
			'exad_animated_text_back_type_speed',
			[
				'label'     => __( 'Back Type Speed', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 60,
				'min'       => 10,
				'max'       => 200,
				'step'      => 10,
				'condition' => [
					'exad_animated_text_animated_heading_animated_type' => 'exad-typed-animation'
				]
			]
		);

		$this->add_control(
			'exad_animated_text_back_delay',
			[
				'label'     => __( 'Back Delay', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 1000,
				'max'       => 10000,
				'condition' => [
					'exad_animated_text_animated_heading_animated_type' => 'exad-typed-animation'
				]
			]
		);

		$this->add_control(
			'exad_animated_text_loop',
			[
				'label'        => __( 'Loop', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'OFF', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'exad_animated_text_animated_heading_animated_type' => 'exad-typed-animation'
				]
			]
		);

		$this->add_control(
			'exad_animated_text_show_cursor',
			[
				'label'        => __( 'Show Cursor', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'OFF', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'exad_animated_text_animated_heading_animated_type' => 'exad-typed-animation'
				]
			]
		);

		$this->add_control(
			'exad_animated_text_fade_out',
			[
				'label'        => __( 'Fade Out', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'OFF', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'exad_animated_text_animated_heading_animated_type' => 'exad-typed-animation'
				]
			]
		);

		$this->add_control(
			'exad_animated_text_smart_backspace',
			[
				'label'        => __( 'Smart Backspace', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'exclusive-addons-elementor' ),
				'label_off'    => __( 'OFF', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'exad_animated_text_animated_heading_animated_type' => 'exad-typed-animation'
				]
			]
		);

		$this->end_controls_section();

		/*
	    * Animated Text pre animated Text Style
		*/
	    $this->start_controls_section(
	        'exad_pre_animated_text_style',
	        [
				'label'     => esc_html__( 'Pre Animated text', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_animated_text_before_text!' => ''
				]
	        ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_pre_animated_text_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ],
				'selector' => '{{WRAPPER}} .exad-animated-text-pre-heading',
			]
		);

		$this->add_control(
			'exad_pre_animated_text_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-animated-text-pre-heading' => 'color: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();

		/*
	    * Animated Text animated Text Style
	    */
	    $this->start_controls_section(
	        'exad_animated_text_style',
	        [
				'label' => esc_html__( 'Animated text', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
	        ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_animated_text_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ],
				'selector' => '{{WRAPPER}} .exad-animated-text-animated-heading, {{WRAPPER}} span.typed-cursor'
			]
		);

		$this->add_control(
			'exad_animated_text_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => $exad_secondary_color,
				'selectors' => [
					'{{WRAPPER}} .exad-animated-text-animated-heading, {{WRAPPER}} span.typed-cursor' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_responsive_control(
			'exad_animated_text_spacing',
			[
				'label'      => __( 'Spacing', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'default'    => [
                    'unit'   => 'px',
                    'size'   => 8
                ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 50
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-animated-text-animated-heading' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/*
	    * Animated Text post animated Text Style
	    */
	    $this->start_controls_section(
	        'exad_post_animated_text_style',
	        [
				'label'     => esc_html__( 'Post Animated text', 'exclusive-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exad_animated_text_after_text!' => ''
				]
	        ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_post_animated_text_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ],
				'selector' => '{{WRAPPER}} .exad-animated-text-post-heading'
			]
		);

		$this->add_control(
			'exad_post_animated_text_color',
			[
				'label'     => esc_html__( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .exad-animated-text-post-heading' => 'color: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();
	
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$id            = substr( $this->get_id_int(), 0, 3 );
		$type_heading  = explode( ',', $settings['exad_animated_text_animated_heading'] );
		$before_text   = $settings['exad_animated_text_before_text'];
		$heading_text  = $settings['exad_animated_text_animated_heading'];
		$after_text    = $settings['exad_animated_text_after_text'];
		$heading_tag   = $settings['exad_animated_text_animated_heading_tag'];
		$heading_align = $settings['exad_animated_text_animated_heading_alignment'];

		$this->add_render_attribute( 'exad_typed_animated_string', 'class', 'exad-typed-strings' );
		$this->add_render_attribute( 'exad_typed_animated_string',
			[
				'data-type_string'       => esc_attr(json_encode($type_heading)),
				'data-heading_animation' => esc_attr( $settings['exad_animated_text_animated_heading_animated_type'] )
			]
		);

		if($settings['exad_animated_text_animated_heading_animated_type'] === 'exad-typed-animation'){
			$this->add_render_attribute( 'exad_typed_animated_string',
				[
					'data-type_speed'      => esc_attr( $settings['exad_animated_text_type_speed'] ),
					'data-back_type_speed' => esc_attr( $settings['exad_animated_text_back_type_speed'] ),
					'data-loop'            => esc_attr( $settings['exad_animated_text_loop'] ),
					'data-show_cursor'     => esc_attr( $settings['exad_animated_text_show_cursor'] ),
					'data-fade_out'        => esc_attr( $settings['exad_animated_text_fade_out'] ),
					'data-smart_backspace' => esc_attr( $settings['exad_animated_text_smart_backspace'] ),
					'data-start_delay'     => esc_attr( $settings['exad_animated_text_start_delay'] ),
					'data-back_delay'      => esc_attr( $settings['exad_animated_text_back_delay'] )
				]
			);
		}

		if($settings['exad_animated_text_animated_heading_animated_type'] === 'exad-morphed-animation'){
			$this->add_render_attribute( 'exad_typed_animated_string',
				[
					'data-animation_style' => esc_attr( $settings['exad_animated_text_animated_heading_animation_style'] ),
					'data-animation_speed' => esc_attr( $settings['exad_animated_text_animation_speed'] )
				]
			);
		}

		$this->add_render_attribute( 'exad_animated_text_animated_heading',
			[
				'id'    => 'exad-animated-text-'.$id,
				'class' => 'exad-animated-text-animated-heading'
			]
		);

		$this->add_render_attribute( 'exad_animated_text_before_text', 'class', 'exad-animated-text-pre-heading' );
        $this->add_inline_editing_attributes( 'exad_animated_text_before_text', 'basic' );

		$this->add_render_attribute( 'exad_animated_text_after_text', 'class', 'exad-animated-text-post-heading' );
        $this->add_inline_editing_attributes( 'exad_animated_text_after_text', 'basic' );
		?>

		<div class="exad-animated-text <?php echo esc_attr($heading_align); ?>">

			<?php do_action( 'exad_animated_text_wrapper_before' ); ?>

			<<?php echo esc_attr($heading_tag).' '.$this->get_render_attribute_string( 'exad_typed_animated_string' );?>>

				<?php do_action( 'exad_animated_text_content_before' );

				$before_text ? printf( '<span '.$this->get_render_attribute_string( 'exad_animated_text_before_text' ).'>%s</span>', wp_kses_post($before_text) ) : '';

				if( 'exad-typed-animation' === $settings['exad_animated_text_animated_heading_animated_type'] ) {
					echo '<span id="exad-animated-text-'.esc_attr($id).'" class="exad-animated-text-animated-heading"></span>';
				}

				if( 'exad-morphed-animation' === $settings['exad_animated_text_animated_heading_animated_type'] ) {
					echo '<span '.$this->get_render_attribute_string( 'exad_animated_text_animated_heading' ).'>'.wp_kses_post($heading_text).'</span>';
				}

				$after_text ? printf( '<span '.$this->get_render_attribute_string( 'exad_animated_text_after_text' ).'>%s</span>', wp_kses_post($after_text) ) : '';

				do_action( 'exad_animated_text_content_after' );
			?>

			</<?php echo esc_attr($heading_tag);?>>

			<?php do_action( 'exad_animated_text_wrapper_after' ); ?>

		</div>
	<?php 	
	}
}