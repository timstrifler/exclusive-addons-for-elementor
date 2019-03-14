<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Exclusive_Button extends Widget_Base {
	

	public function get_name() {
		return 'exad-exclusive-button';
	}

	public function get_title() {
		return esc_html__( 'DC Exclusive Button', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

   public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}


	protected function _register_controls() {

		// Content Controls
		$this->start_controls_section(
			'exad_section_exclusive_button_content',
			[
				'label' => esc_html__( 'Button Content', 'exclusive-addons-elementor' )
			]
		);


		$this->add_control(
			'exclusive_button_text',
			[
				'label' => __( 'Button Text', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Click Me!',
				'placeholder' => __( 'Enter button text', 'exclusive-addons-elementor' ),
				'title' => __( 'Enter button text here', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'exad_exclusive_button_icon',
			[
				'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-download'
			]
		);


		$this->add_control(
			'exclusive_button_link_url',
			[
				'label' => esc_html__( 'Link URL', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
        			'url' => '#',
        			'is_external' => '',
     			],
     			'show_external' => true,
			]
		);

		$this->end_controls_section();
		


  		// Style Controls
		$this->start_controls_section(
			'exad_section_exclusive_button_settings',
			[
				'label' => esc_html__( 'Button Effects &amp; Styles', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exclusive_button_effect',
			[
				'label' => esc_html__( 'Button Effect', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'effect-1',
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
					'effect-12' => esc_html__( 'Effect 12', 'exclusive-addons-elementor' ),
					
				],
			]
		);

		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
			'name' => 'exad_exclusive_button_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .exad-button .exad-button-wrapper .exad-button-action',
			]
		);

		$this->add_responsive_control(
			'exad_exclusive_button_width',
			[
				'label' => esc_html__( 'Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 240,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-button .exad-button-action' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'exad_exclusive_button_alignment',
			[
				'label' => esc_html__( 'Alignment', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'exclusive-addons-elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .exad-button .exad-button-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		
		$this->add_responsive_control(
			'exad_exclusive_button_padding',
			[
				'label' => esc_html__( 'Padding', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => 20,
					'right' => 20,
					'bottom' => 20,
					'left' => 20,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-button .exad-button-wrapper .exad-button-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
		
		$this->add_control(
			'exad_button_border_properties',
			[
				'label' => __( 'Border', 'plugin-name' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'		=> 'exad_exclusive_button_border',
				'selector'	=> '{{WRAPPER}} .exad-button .exad-button-action',
			]
		);

		$this->add_control(
			'exad_exclusive_button_border_radius',
			[
				'label'		=> esc_html__( 'Border Radius', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::SLIDER,
				'range'	=> [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .exad-button .exad-button-action' => 'border-radius: {{SIZE}}px;',
					'{{WRAPPER}} .exad-button .exad-button-wrapper.effect-1 .exad-button-action::before' => 'border-radius: {{SIZE}}px;'
				],
			]
		);

		$this->add_control(
			'exad_button_separator',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'default',
			]
		);


		$this->start_controls_tabs( 'exad_exclusive_button_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'exclusive-addons-elementor' ) ] );

		$this->add_control(
			'exad_exclusive_button_text_color',
			[
				'label'		=> esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '#ffffff',
				'selectors'	=> [
					'{{WRAPPER}} .exad-button .exad-button-wrapper .exad-button-action' => 'color: {{VALUE}};',
					'{{WRAPPER}} .exad-exclusive-button.exad-exclusive-button--tamaya::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .exad-exclusive-button.exad-exclusive-button--tamaya::after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .exad-button .exad-button-wrapper .exad-button-action',
			]
		);

	
		$this->end_controls_tab();
		

		$this->start_controls_tab( 'exad_exclusive_button_hover', [ 'label' => esc_html__( 'Hover', 'exclusive-addons-elementor' ) ] );

		$this->add_control(
			'exad_exclusive_button_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#8868fe',
				'selectors' => [
					'{{WRAPPER}} .exad-button .exad-button-wrapper .exad-button-action:hover' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'exad_exclusive_button_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .exad-button .exad-button-wrapper.effect-1 .exad-button-action::before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .exad-button .exad-button-wrapper.effect-2 .exad-button-action:before, {{WRAPPER}} .exad-button .exad-button-wrapper.effect-2 .exad-button-action:after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .exad-button .exad-button-wrapper.effect-3 .exad-button-action::before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .exad-button .exad-button-wrapper.effect-4 .exad-button-action::after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .exad-button .exad-button-wrapper.effect-5 .exad-button-action::before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .exad-button .exad-button-wrapper.effect-7 .exad-button-action::before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .exad-button .exad-button-wrapper.effect-8 .exad-button-action span.effect-8-position' => 'background: {{VALUE}};',
					//'{{WRAPPER}} .exad-button .exad-button-wrapper.effect-9 .exad-button-action:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .exad-button .exad-button-wrapper.effect-10 .exad-button-action::before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .exad-button .exad-button-wrapper.effect-11 .exad-button-action:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .exad-button .exad-button-wrapper.effect-12 .exad-button-action:hover' => 'background: {{VALUE}};',	
				],
			]
		);

		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		$this->add_control(
			'exad_box_shadow_heading',
			[
				'label' => __( 'Box Shadow', 'plugin-name' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .exad-button .exad-button-action',
			]
		);		
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
		
		$this->add_render_attribute( 'exad_exclusive_button', [
			'class'	=> [ 'exad-button-wrapper', esc_attr($settings['exclusive_button_effect'] ) ],
		]);

		if ( 'effect-8' == $settings['exclusive_button_effect'] ) {
			$this->add_render_attribute( 'exad_exclusive_button', 'class', 'mouse-hover-effect' );
		}

		if( $settings['exclusive_button_link_url']['is_external'] ) {
			$this->add_render_attribute( 'exad_exclusive_button', 'target', '_blank' );
		}
		
		if( $settings['exclusive_button_link_url']['nofollow'] ) {
			$this->add_render_attribute( 'exad_exclusive_button', 'rel', 'nofollow' );
		}

	?>
	<div class="exad-button">
		<div <?php echo $this->get_render_attribute_string( 'exad_exclusive_button' ); ?>>
			<a href="<?php echo esc_attr($settings['exclusive_button_link_url']['url'] ); ?>" class="exad-button-action">
				<?php if ( ! empty( $settings['exad_exclusive_button_icon'] ) ) : ?>
					<span><i class="<?php echo esc_attr($settings['exad_exclusive_button_icon'] ); ?>" aria-hidden="true"></i></span>
				<?php endif; ?>
				<?php echo  $settings['exclusive_button_text']; ?>
				<?php if ( 'effect-8' == $settings['exclusive_button_effect'] ) { ?>
					<span class="effect-8-position"></span>	
				<?php } ?>	
			</a>
		</div>
	
	<?php
	}

	protected function _content_template() {
	?>

	<# if ( 'effect-8' == settings.exclusive_button_effect ) {
		view.addRenderAttribute( 'exad_exclusive_button', 'class', 'mouse-hover-effect' );
	}
	#>	
	<#
		view.addRenderAttribute( 'exad_exclusive_button', 'class', [ 'exad-button-wrapper', settings.exclusive_button_effect ] );
	#>	

	<div class="exad-button">
		<div {{{ view.getRenderAttributeString( 'exad_exclusive_button' ) }}}>
			<a href="{{ settings.exclusive_button_link_url.url }}" class="exad-button-action">
				<span><i class="{{ settings.exad_exclusive_button_icon }}" aria-hidden="true"></i></span>
				{{{ settings.exclusive_button_text }}}
				<# if ( 'effect-8' == settings.exclusive_button_effect ) { #>
					<span class="effect-8-position"></span>	
				<# } #>
			</a>
		</div>
	</div>

	<?php	
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Exclusive_Button() );