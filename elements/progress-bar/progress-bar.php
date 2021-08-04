<?php
namespace ExclusiveAddons\Elements;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
use \ExclusiveAddons\Elementor\Helper;

class Progress_Bar extends Widget_Base {
	
	public function get_name() {
		return 'exad-progress-bar';
	}

	public function get_title() {
		return esc_html__( 'Progress Bar', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad exad-logo exad-progress-bar';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_script_depends() {
		return [ 'exad-waypoints', 'exad-progress-bar' ];
	}

	public function get_keywords() {
		return [ 'exclusive', 'skill', 'circle', 'bars' ];
	}

	private function hexToRGB($primaryColor){
		if ( strpos( $primaryColor, '#' ) === 0 ) {
            return $primaryColor;
        }
		$removeRGB = substr( $primaryColor, 5 ); 
		$rgbaData    = explode( ",", $removeRGB, 3 );
		$hashColor = sprintf( "#%02x%02x%02x", $rgbaData[0], $rgbaData[1], $rgbaData[2] );
		return $hashColor;
	}

	protected function register_controls() {
		$exad_primary_color = get_option( 'exad_primary_color_option', '#7a56ff' );

		$this->start_controls_section(
			'exad_progress_bar_section_content',
			[
				'label' => __('Content', 'exclusive-addons-elementor')
			]
		);
					
		$this->add_control(
			'exad_progress_bar_title',
			[
				'label'     => __('Title', 'exclusive-addons-elementor'),
				'type'      => Controls_Manager::TEXT,
				'default'   => __('Progress Bar', 'exclusive-addons-elementor'),
				'separator' => 'before',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'exad_progress_bar_value',
			[
				'label'   => __( 'Percentage Value', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'default' => 60
			]
		);
			
		$this->end_controls_section();
				
		$this->start_controls_section(
			'exad_section_progress_bar_styles_preset',
			[
				'label' => __('General Styles', 'exclusive-addons-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_progress_bar_preset',
			[
				'label'   => __('Style Presets', 'exclusive-addons-elementor'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'line'        => __('Line', 'exclusive-addons-elementor'),
					'line-bubble' => __('Line Bubble', 'exclusive-addons-elementor'),
					'circle'      => __('Circle', 'exclusive-addons-elementor'),
					'fan'         => __('Half Circle', 'exclusive-addons-elementor')
				],
				'default' => 'line'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'exad_progress_bar_title_styles',
			[
				'label' => __('Title', 'exclusive-addons-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_progress_bar_title_color',
			[
				'label'     => __( 'Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .exad-progress-bar-title' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name'     => 'exad_progress_bar_title_typography',
					'fields_options'   => [
			            'font_size'    => [
			                'default'  => [
			                    'unit' => 'px',
			                    'size' => 16
			                ]
			            ],
			            'font_weight'  => [
			                'default'  => '600'
			            ]
		            ],
					'selector' => '{{WRAPPER}} .exad-progress-bar-title'
				]
		);

		$this->add_responsive_control(
            'exad_progress_bar_title_margin',
            [
                'label'        => __('Margin', 'exclusive-addons-elementor'),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => ['px', '%'],
                'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '10',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .exad-progress-bar-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'exad_progress_bar_front_style',
			[
				'label' => __('Front Bar', 'exclusive-addons-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_progress_bar_stroke_color',
			[
				'label'   => __( 'Color', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::COLOR,
				'alpha'	  => false,
				'default' => $this->hexToRGB($exad_primary_color)
			]
		);

		$this->add_control(
			'exad_progress_bar_stroke_width',
			[
				'label'   => __( 'Width', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'default' => 15
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'exad_progress_bar_back_style',
			[
				'label' => __('Back Bar', 'exclusive-addons-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_progress_bar_trail_color',
			[
				'label'   => __( 'Color', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ddd'
			]
		);

		$this->add_control(
			'exad_progress_bar_trail_width',
			[
				'label'   => __( 'Width', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'default' => 15
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'exad_progress_bar_value_styles',
			[
				'label' => __('Percentage Value', 'exclusive-addons-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'exad_progress_bar_value_width',
			[
				'label'      => __( 'Width', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'       => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1
					]
				],
				'selectors'  => [
					'{{WRAPPER}} [class*="exad-progress-bar-"] .ldBar-label' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition'  => [
					'exad_progress_bar_preset' => [ 'line-bubble' ]
				]
			]
		);

		$this->add_responsive_control(
			'exad_progress_bar_value_height',
			[
				'label'      => __( 'height', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'       => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1
					]
				],
				'selectors'  => [
					'{{WRAPPER}} [class*="exad-progress-bar-"] .ldBar-label' => 'height: {{SIZE}}{{UNIT}};'
				],
				'condition'  => [
					'exad_progress_bar_preset' => [ 'line-bubble' ]
				]
			]
		);

		$this->add_responsive_control(
			'exad_progress_bar_value_position',
			[
				'label'      => __( 'Position', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range'      => [
					'px'       => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1
					]
				],
				'default'    => [
					'unit'   => '%',
					'size'   => 7
				],
				'selectors'  => [
					'{{WRAPPER}} [class*="exad-progress-bar-"].fan .ldBar-label' => 'bottom: {{SIZE}}{{UNIT}};'
				],
				'condition'  => [
					'exad_progress_bar_preset' => 'fan'
				]
			]
		);

		$this->add_responsive_control(
			'exad_progress_bar_value_position_top',
			[
				'label'      => __( 'Top Position', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'       => [
						'min'  => -200,
						'max'  => 200,
						'step' => 1
					]
				],
				'selectors'  => [
					'{{WRAPPER}} [class*="exad-progress-bar-"] .ldBar-label' => 'top: {{SIZE}}{{UNIT}};'
				],
				'condition'  => [
					'exad_progress_bar_preset' => [ 'line', 'line-bubble' ]
				]
			]
		);

		$this->add_control(
			'exad_progress_bar_value_color',
			[
				'label'     => __( 'Text Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .exad-progress-bar .ldBar-label' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name'     => 'exad_progress_bar_value_value_typography',
					'selector' => '{{WRAPPER}} .exad-progress-bar .ldBar-label'
				]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'exad_progress_bar_background',
				'types'    => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .exad-progress-bar .ldBar-label'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'exad_progress_bar_border',
				'selector' => '{{WRAPPER}} .exad-progress-bar .ldBar-label'
			]
		);

		$this->add_responsive_control(
			'exad_progress_bar_radius',
			[
				'label'      => __( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '50',
					'right'  => '50',
					'bottom' => '50',
					'left'   => '50',
					'unit'   => '%'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-progress-bar .ldBar-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_progress_bar_padding_style',
			[
				'label'      => __( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10'
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-progress-bar .ldBar-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_progress_bar_box_shadow',
				'selector' => '{{WRAPPER}} .exad-progress-bar .ldBar-label'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$title    = $settings['exad_progress_bar_title'];
		
		$this->add_render_attribute( 
			'exad-progress-bar', 
			[ 
				'class' => [ 
					esc_attr( $settings['exad_progress_bar_preset'] ), 
					'exad-progress-bar', 
					'exad-progress-bar-'.$this->get_id() 
				],
				'data-id'                              => $this->get_id(),
				'data-type'                            => esc_attr( $settings['exad_progress_bar_preset'] ),
				'data-progress-bar-value'              => esc_attr( $settings['exad_progress_bar_value'] ),
				'data-stroke-color'                    => esc_attr( $settings['exad_progress_bar_stroke_color'] ),
				'data-progress-bar-stroke-width'       => esc_attr( $settings['exad_progress_bar_stroke_width'] ),
				'data-stroke-trail-color'              => esc_attr( $settings['exad_progress_bar_trail_color'] ),
				'data-progress-bar-stroke-trail-width' => esc_attr( $settings['exad_progress_bar_trail_width'] ),
				'data-unit'							   => '%'
			]
		);

		$this->add_render_attribute( 'exad_progress_bar_title', 'class', 'exad-progress-bar-title' );
        $this->add_inline_editing_attributes( 'exad_progress_bar_title', 'basic' );

		if ( 'line' === $settings['exad_progress_bar_preset'] || 'line-bubble' === $settings['exad_progress_bar_preset'] ) {
			$this->add_render_attribute(
				'exad-progress-bar',
				[
					'data-preset' => 'line',
					'style'       => 'width: 100%; height: 100px'
				]
			);
		}

		if ( 'circle' === $settings['exad_progress_bar_preset'] ) {
			$this->add_render_attribute(
				'exad-progress-bar',
				[
					'data-preset' => 'circle',
					'style'       => 'width: 100%; height: 100%'
				]
			);
		}

		if ( 'fan' === $settings['exad_progress_bar_preset'] ) {
			$this->add_render_attribute(
				'exad-progress-bar',
				[
					'data-preset' => 'fan',
					'style'       => 'width: 100%; height: 100%'
				]
			);
		}

		?>
		
		<div <?php echo $this->get_render_attribute_string('exad-progress-bar'); ?> data-progress-bar>
			<?php echo $title ? '<h6 '.$this->get_render_attribute_string( 'exad_progress_bar_title' ).'>'.Helper::exad_wp_kses( $title ).'</h6>' : ''; ?>
		</div>
		<?php
	}
}