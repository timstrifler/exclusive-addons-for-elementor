<?php
namespace Elementor;

class Exad_Progress_Bar extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-progress-bar';
	}
	public function get_title() {
		return esc_html__( 'Ex. Progress Bar', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'eicon-skill-bar';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_script_depends() {
		return [ 'elementor-waypoints', 'exad-progress-bar' ];
	}

	protected function _register_controls() {


		// Progressbar Content Section
		$this->start_controls_section(
			'exad_progress_bar_section_content',
			[
				'label' => __('Content', 'exclusive-addons-elementor'),
			]
		);
					
		$this->add_control(
			'exad_progress_bar_title',
			[
				'label' => __('Title', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Progress Bar', 'exclusive-addons-elementor'),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'exad_progress_bar_value',
			[
				'label' => __( 'Value', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 60,
			]
		);
			
		$this->end_controls_section();
				

		// Progressbar Style Section
		$this->start_controls_section(
			'exad_section_progress_bar_styles_preset',
			[
				'label' => __('Presets', 'exclusive-addons-elementor'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_progress_bar_preset',
			[
				'label' => __('Style Presets', 'exclusive-addons-elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'line' => __('Line', 'exclusive-addons-elementor'),
					'line-bubble' => __('Line Bubble', 'exclusive-addons-elementor'),
					'circle' => __('Circle', 'exclusive-addons-elementor'),
					'fan' => __('Fan', 'exclusive-addons-elementor')
				],
				'default' => 'line',
			]
		);

		$this->add_control(
			'exad_progress_bar_bubble_color',
			[
				'label' => __( 'Bubble Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ff704e',
				'selectors' => [
					'{{WRAPPER}} [class*="exad-progress-bar-"].line-bubble .ldBar-label' => 'background: {{VALUE}};',
				],
				'condition' => [
					'exad_progress_bar_preset' => 'line-bubble'
				]

			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'exad_progress_bar_title_styles',
			[
				'label' => __('Title', 'exclusive-addons-elementor'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_progress_bar_title_color',
			[
				'label' => __( 'Title Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .exad-progress-bar-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .exad-progress-bar-title',
				]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'exad_progress_bar_front_style',
			[
				'label' => __('Front Bar', 'exclusive-addons-elementor'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_progress_bar_stroke_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4054b2'
			]
		);

		$this->add_control(
			'exad_progress_bar_stroke_width',
			[
				'label' => __( 'Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 2,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'exad_progress_bar_back_style',
			[
				'label' => __('Back Bar', 'exclusive-addons-elementor'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_progress_bar_trail_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ddd'
			]
		);

		$this->add_control(
			'exad_progress_bar_trail_width',
			[
				'label' => __( 'Width', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 2,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'exad_progress_bar_value_styles',
			[
				'label' => __('Value', 'exclusive-addons-elementor'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'exad_progress_bar_value_color',
			[
				'label' => __( 'Color', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} [class*="exad-progress-bar-"] .ldBar-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
						'name' => 'value_typography',
						'selector' => '{{WRAPPER}} .ldBar-label',
				]
		);


		$this->end_controls_section();

	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$this->add_render_attribute( 
			'exad-progress-bar', 
			[ 
				'class' => [ $settings['exad_progress_bar_preset'], 'exad-progress-bar-'. $this->get_id() ],
				'data-id' => $this->get_id(),
				'data-type' => $settings['exad_progress_bar_preset'],
				'data-progress-bar-value' => $settings['exad_progress_bar_value'],
				'data-stroke-color' => $settings['exad_progress_bar_stroke_color'],
				'data-progress-bar-stroke-width' => $settings['exad_progress_bar_stroke_width'],
				'data-stroke-trail-color' => $settings['exad_progress_bar_trail_color'],
				'data-progress-bar-stroke-trail-width' => $settings['exad_progress_bar_trail_width']
			]
		);

		if ($settings['exad_progress_bar_preset'] == 'line' || $settings['exad_progress_bar_preset'] == 'line-bubble') {
			$this->add_render_attribute(
				'exad-progress-bar',
				[
					'data-preset' => 'line',
					'style' => 'width: 100%; height: 50px'
				]
			);
		}

		if ($settings['exad_progress_bar_preset'] == 'circle') {
			$this->add_render_attribute(
				'exad-progress-bar',
				[
					'data-preset' => 'circle',
					'style' => 'width: 100%; height: 100%'
				]
			);
		}

		if ($settings['exad_progress_bar_preset'] == 'fan') {
			$this->add_render_attribute(
				'exad-progress-bar',
				[
					'data-preset' => 'fan',
					'style' => 'width: 100%; height: 100%'
				]
			);
		}

		?>		
		
		<div <?php echo $this->get_render_attribute_string('exad-progress-bar') ?> data-progress-bar data-progress-duration="2">
			<h6 class="exad-progress-bar-title">
		  		<?php echo $settings['exad_progress_bar_title'] ?>
		  	</h6>
		</div>

	<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Progress_Bar() );