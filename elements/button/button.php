<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Widget_Base;

class Button extends Widget_Base {

	public function get_name() {
		return 'exad-exclusive-button';
	}

	public function get_title() {
		return esc_html__( 'Button', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad exad-logo exad-button';
	}

	public function get_keywords() {
        return [ 'exclusive', 'btn', 'link', 'cta' ];
    }

    public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	protected function register_controls() {
		$exad_primary_color = get_option( 'exad_primary_color_option', '#7a56ff' );

		// Content Controls
		$this->start_controls_section(
			'exad_section_exclusive_button_content',
			[
				'label' => esc_html__( 'Contents', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exclusive_button_text',
			[
				'label'       => __( 'Button Text', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Download!', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Enter button text', 'exclusive-addons-elementor' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'exad_exclusive_button_icon',
			[
				'label'   => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
                    'value'   => 'fas fa-download',
                    'library' => 'fa-solid'
                ]
			]
		);

		$this->add_control(
			'exad_exclusive_button_icon_position',
			[
				'label'   => esc_html__( 'Button Icon Position', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'exad-button-incon-before-text',
				'options' => [
					'exad-button-incon-before-text' 	=> esc_html__( 'Before Text', 	'exclusive-addons-elementor' ),
					'exad-button-incon-after-text' 	=> esc_html__( 'After Text', 	'exclusive-addons-elementor' )
				]
			]
		);

		$this->add_control(
			'exclusive_button_link_url',
			[
				'label'       => esc_html__( 'Link URL', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
        			'url'         => '#',
        			'is_external' => ''
     			],
     			'show_external' => true
			]
		);

		$this->end_controls_section();
		
  		// Style Controls
		$this->start_controls_section(
			'exad_section_exclusive_button_settings',
			[
				'label' => esc_html__( 'Styles & Effects', 'exclusive-addons-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exclusive_button_effect',
			[
				'label'   => esc_html__( 'Button Effect', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'effect-2',
				'options' => [
					'effect-1' 	=> esc_html__( 'Effect 1', 	'exclusive-addons-elementor' ),
					'effect-2' 	=> esc_html__( 'Effect 2', 	'exclusive-addons-elementor' ),
					'effect-3' 	=> esc_html__( 'Effect 3', 	'exclusive-addons-elementor' ),
					'effect-4' 	=> esc_html__( 'Effect 4', 	'exclusive-addons-elementor' ),
					'effect-5' 	=> esc_html__( 'Effect 5', 	'exclusive-addons-elementor' ),
					'effect-6' 	=> esc_html__( 'Effect 6', 	'exclusive-addons-elementor' ),
					'effect-7' 	=> esc_html__( 'Effect 7', 	'exclusive-addons-elementor' ),
					'effect-8' 	=> esc_html__( 'Effect 8', 	'exclusive-addons-elementor' ),
					'effect-9' 	=> esc_html__( 'Effect 9', 	'exclusive-addons-elementor' ),
					'effect-10' => esc_html__( 'Effect 10', 'exclusive-addons-elementor' ),
					'effect-11' => esc_html__( 'Effect 11', 'exclusive-addons-elementor' ),
					'effect-12' => esc_html__( 'Effect 12', 'exclusive-addons-elementor' )
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'exad_exclusive_button_typography',
				'selector' => '{{WRAPPER}} .exad-button-wrapper .exad-button-action'
			]
		);

		$this->add_control(
			'exad_exclusive_button_enable_fixed_width',
			[
				'label' => __( 'Enable Fixed Height & Width?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'exclusive-addons-elementor' ),
				'label_off' => __( 'Hide', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'exad_button_fixed_width_height',
			[
				'label' => __( 'Fixed Height & Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', 'exclusive-addons-elementor' ),
				'label_on' => __( 'Custom', 'exclusive-addons-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'exad_exclusive_button_enable_fixed_width' => 'yes'
				]
			]
        );
        
        $this->start_popover();

			$this->add_responsive_control(
				'exad_exclusive_button_fixed_width',
				[
					'label'      => esc_html__( 'Width', 'exclusive-addons-elementor' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px'     => [
							'min'  => 0,
							'max'  => 500,
							'step' => 1
						],
						'%'        => [
							'min'  => 0,
							'max'  => 100
						]
					],
					'default'    => [
						'unit'   => 'px',
						'size'   => 100
					],
					'selectors'  => [
						'{{WRAPPER}} .exad-button-wrapper .exad-button-action' => 'width: {{SIZE}}{{UNIT}};'
					],
					'condition' => [
						'exad_exclusive_button_enable_fixed_width' => 'yes'
					]
				]
			);

            $this->add_responsive_control(
				'exad_exclusive_button_fixed_height',
				[
					'label'      => esc_html__( 'Height', 'exclusive-addons-elementor' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px'     => [
							'min'  => 0,
							'max'  => 500,
							'step' => 1
						],
						'%'        => [
							'min'  => 0,
							'max'  => 100
						]
					],
					'default'    => [
						'unit'   => 'px',
						'size'   => 100
					],
					'selectors'  => [
						'{{WRAPPER}} .exad-button-wrapper .exad-button-action' => 'height: {{SIZE}}{{UNIT}};'
					],
					'condition' => [
						'exad_exclusive_button_enable_fixed_width' => 'yes'
					]
				]
			);

        $this->end_popover();

		$this->add_responsive_control(
			'exad_exclusive_button_width',
			[
				'label'      => esc_html__( 'Width', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'default'    => [
					'unit'   => '%',
					'size'   => 80
				],
				'selectors'  => [
					'{{WRAPPER}} .exad-button-wrapper .exad-button-action' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'exad_exclusive_button_enable_fixed_width!' => 'yes'
				]
			]
		);

		// $icon_gap = is_rtl() ? 'left' : 'right';

		$this->add_responsive_control(
			'exad_exclusive_button_icon_space',
			[
                'label'       => __( 'Icon Space', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 50
					]
				],
                'default'     => [
                    'unit'    => 'px',
                    'size'    => 10
                ],
				'selectors'   => [
                    '{{WRAPPER}} .exad-button-wrapper.exad-button-incon-before-text .exad-button-action i'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .exad-button-wrapper.exad-button-incon-after-text .exad-button-action i'  => 'margin-left: {{SIZE}}{{UNIT}};'
				],
                'condition'   => [
                    'exad_exclusive_button_icon[value]!' => ''
                ]
			]
        );
		
		$this->add_responsive_control(
			'exad_exclusive_button_alignment',
			[
				'label'       => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => true,
				'toggle'      => false,
				'options'     => [
					'left'      => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'desktop_default' => 'center',
				'tablet_default' => 'center',
				'mobile_default' => 'center',
				'selectors_dictionary' => [
					'left' => 'justify-content: flex-start;',
					'center' => 'justify-content: center;',
					'right' => 'justify-content: flex-end;',
				],
				'selectors'     => [
					'{{WRAPPER}} .exad-button-wrapper' => '{{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_exclusive_button_padding',
			[
				'label'      => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'      => 15,
					'right'    => 15,
					'bottom'   => 15,
					'left'     => 15,
					'unit'     => 'px',
					'isLinked' => true
				],
				'selectors' => [
					'{{WRAPPER}} .exad-button-wrapper .exad-button-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'exad_exclusive_button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .exad-button-wrapper .exad-button-action, {{WRAPPER}} .exad-button-wrapper.effect-1 .exad-button-action::before'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'exad_button_separator',
			[
				'type'  => Controls_Manager::DIVIDER,
				'style' => 'default'
			]
		);

		$this->start_controls_tabs( 'exad_exclusive_button_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

		$this->add_control(
			'exad_exclusive_button_text_color',
			[
				'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> $exad_primary_color,
				'selectors'	=> [
					'{{WRAPPER}} .exad-button-wrapper .exad-button-action'                     => 'color: {{VALUE}};',
					'{{WRAPPER}} .exad-exclusive-button.exad-exclusive-button--tamaya::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .exad-exclusive-button.exad-exclusive-button--tamaya::after'  => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'exad_exclusive_button_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-button-wrapper .exad-button-action'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'            => 'exad_exclusive_button_border',
				'fields_options'  => [
                    'border' 	  => [
                        'default' => 'solid'
                    ],
                    'width'  	  => [
                        'default' 	 => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                    'color' 	  => [
                        'default' => $exad_primary_color
                    ]
                ],
				'selector'        => '{{WRAPPER}} .exad-button-wrapper .exad-button-action'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_exclusive_button_box_shadow',
				'selector' => '{{WRAPPER}} .exad-button-wrapper .exad-button-action'
			]
		);

		$this->end_controls_tab();
		
		$this->start_controls_tab( 'exad_exclusive_button_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

		$this->add_control(
			'exad_exclusive_button_hover_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-button-wrapper .exad-button-action:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'exad_exclusive_button_hover_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-button-wrapper.effect-1 .exad-button-action::before, {{WRAPPER}} .exad-button-wrapper.effect-2 .exad-button-action:before, {{WRAPPER}} .exad-button-wrapper.effect-2 .exad-button-action:after, {{WRAPPER}} .exad-button-wrapper.effect-3 .exad-button-action::before, {{WRAPPER}} .exad-button-wrapper.effect-4 .exad-button-action::after, {{WRAPPER}} .exad-button-wrapper.effect-5 .exad-button-action::before, {{WRAPPER}} .exad-button-wrapper.effect-7 .exad-button-action::before, {{WRAPPER}} .exad-button-wrapper.effect-8 .exad-button-action span.effect-8-position, {{WRAPPER}} .exad-button-wrapper.effect-10 .exad-button-action::before, {{WRAPPER}} .exad-button-wrapper.effect-11 .exad-button-action:hover, {{WRAPPER}} .exad-button-wrapper.effect-12 .exad-button-action:hover',
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => $exad_primary_color
					]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'            => 'exad_exclusive_button_border_hover',
				'selector'        => '{{WRAPPER}} .exad-button-wrapper .exad-button-action:hover'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'exad_exclusive_button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .exad-button-wrapper .exad-button-action:hover'
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();	
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$this->add_render_attribute( 
			'exad_exclusive_button', 
			[
				'class'	=> [ 
					'exad-button-wrapper', 
					esc_attr( $settings['exclusive_button_effect'] ) ,
					esc_attr( $settings['exad_exclusive_button_icon_position'] ),
					'exad-button-fixed-height-'.esc_attr( $settings['exad_exclusive_button_enable_fixed_width'] )
				]
			]
		);

		if ( 'effect-8' === $settings['exclusive_button_effect'] ) {
			$this->add_render_attribute( 'exad_exclusive_button', 'class', 'mouse-hover-effect' );
		}

		$this->add_inline_editing_attributes( 'exclusive_button_text', 'none' );
		$this->add_render_attribute( 'exclusive_button_link_url', 'class', 'exad-button-action' );

		if( $settings['exclusive_button_link_url']['url'] ) {
			$this->add_render_attribute( 'exclusive_button_link_url', 'href', esc_url( $settings['exclusive_button_link_url']['url'] ) );
			if( $settings['exclusive_button_link_url']['is_external'] ) {
				$this->add_render_attribute( 'exclusive_button_link_url', 'target', '_blank' );
			}
			if( $settings['exclusive_button_link_url']['nofollow'] ) {
				$this->add_render_attribute( 'exclusive_button_link_url', 'rel', 'nofollow' );
			}
		}
		?>

		<div <?php echo $this->get_render_attribute_string( 'exad_exclusive_button' ); ?>>

			<?php do_action( 'exad_button_wrapper_before' ); ?>

			<a <?php echo $this->get_render_attribute_string( 'exclusive_button_link_url' ); ?>>
				<?php do_action( 'exad_button_begin_anchor_tag' );

				if ( ! empty( $settings['exad_exclusive_button_icon']['value'] ) ) :
					if( 'exad-button-incon-before-text' === $settings['exad_exclusive_button_icon_position'] ) : ?>
						<span>
							<?php Icons_Manager::render_icon( $settings['exad_exclusive_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</span>
					<?php	
					endif;
				endif;
				?>

				<span <?php echo $this->get_render_attribute_string( 'exclusive_button_text' ); ?>>
					<?php echo esc_html( $settings['exclusive_button_text'] ); ?>
				</span>

				<?php
				if ( ! empty( $settings['exad_exclusive_button_icon']['value'] ) ) :
					if( 'exad-button-incon-after-text' === $settings['exad_exclusive_button_icon_position'] ) : ?>
						<span>
							<?php Icons_Manager::render_icon( $settings['exad_exclusive_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</span>
					<?php	
					endif;
				endif;

				if ( 'effect-8' === $settings['exclusive_button_effect'] ) {
					echo '<span class="effect-8-position"></span>';
				}

				do_action( 'exad_button_end_anchor_tag' ); ?>
			</a>

			<?php do_action( 'exad_button_wrapper_after' ); ?>
		</div>
		<?php	
	}

	/**
     * Render button widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
	protected function content_template() {
		?>
		<#

			view.addRenderAttribute( 'exad_exclusive_button', {
				'class': [ 
					'exad-button-wrapper', 
					settings.exclusive_button_effect,
					settings.exad_exclusive_button_icon_position,
					'exad-button-fixed-height-'+settings.exad_exclusive_button_enable_fixed_width
				]
			} );

			if ( 'effect-8' === settings.exclusive_button_effect ) {
				view.addRenderAttribute( 'exad_exclusive_button', 'class', 'mouse-hover-effect' );
			}

			view.addInlineEditingAttributes( 'exclusive_button_text', 'none' );
			view.addRenderAttribute( 'exclusive_button_link_url', 'class', 'exad-button-action' );

			var target = settings.exclusive_button_link_url.is_external ? ' target="_blank"' : '';
            var nofollow = settings.exclusive_button_link_url.nofollow ? ' rel="nofollow"' : '';

			var iconHTML = elementor.helpers.renderIcon( view, settings.exad_exclusive_button_icon, { 'aria-hidden': true }, 'i' , 'object' );
		#>

			<div {{{ view.getRenderAttributeString( 'exad_exclusive_button' ) }}}>
				<a href="{{{ settings.exclusive_button_link_url.url }}}" {{{ view.getRenderAttributeString( 'exclusive_button_link_url' ) }}}{{{ target }}}{{{ nofollow }}}>
					<# if ( iconHTML.value ) { #>
						<# if( 'exad-button-incon-before-text' === settings.exad_exclusive_button_icon_position ) { #>
							<span>
								{{{ iconHTML.value }}}
							</span>
						<# } #>
					<# } #>

					<span {{{ view.getRenderAttributeString( 'exclusive_button_text' ) }}}>
						{{{ settings.exclusive_button_text }}}
					</span>

					<# if ( iconHTML.value ) { #>
						<# if( 'exad-button-incon-after-text' === settings.exad_exclusive_button_icon_position ) { #>
							<span>
								{{{ iconHTML.value }}}
							</span>
						<# } #>
					<# } #>

					<# if ( 'effect-8' === settings.exclusive_button_effect ) { #>
						<span class="effect-8-position"></span>
					<# } #>
				</a>
			</div>
		<?php
	}
}