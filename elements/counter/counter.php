<?php
namespace Elementor;

class Exad_Counter extends Widget_Base {
	
	public function get_name() {
		return 'exad-counter';
	}
	public function get_title() {
		return esc_html__( 'Ex Counter', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-counter';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	protected function _register_controls() {

		/*
		* Number Count
		*/
    $this->start_controls_section(
			'exad_section_counter_number',
			[
				'label' => esc_html__( 'Number', 'exclusive-addons-elementor' )
			]
    );

    $this->add_control(
			'exad_counter_number',
			[
				'label' => esc_html__( 'Count Number', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 50
			]
		);
    
		$this->end_controls_section();

		// Title
		$this->start_controls_section(
			'exad_section_counter_title',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
			]
    );

    $this->add_control(
			'exad_counter_title',
			[
				'label' => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Counter Title', 'exclusive-addons-elementor' ),
			]
		);
    
		$this->end_controls_section();
		
		// icon
		$this->start_controls_section(
			'exad_section_counter_icon',
			[
				'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' )
			]
		);
		
		$this->add_control(
			'exad_counter_icon_show',
			[
					'label' => esc_html__( 'Enable Icon', 'exclusive-addons-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'return_value' => 'yes',
			]
			);

    $this->add_control(
			'exad_counter_icon',
			[
				'label' => esc_html__( 'Icon', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-tag',
			]
		);
    
    $this->end_controls_section();
		/*
		* settings
		*/
		$this->start_controls_section(
			'exad_section_counter_settings',
			[
				'label' => esc_html__( 'Setting', 'exclusive-addons-elementor' )
			]
        );


        $this->add_control(
            'exad_counter_speed',
            [
                'label'     => esc_html__( 'Counting Speed', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::NUMBER,
                'description' => __( 'In Miliseconds', 'exclusive-addons-elementor' ),
                'default'   => 2000,
            ]
        );
    
        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// $this->add_render_attribute( 'exad_counter_wrapper', [
		// 	'data-exad_counter_time' => esc_attr($settings['exad_counter_speed'])
		// ]);

    ?>
      <div id="exad-counter-<?php echo esc_attr($this->get_id()); ?>" class="exad-counter two">
        <div class="exad-counter-item">
					<?php if ( $settings['exad_counter_icon_show'] == 'yes' ) : ?>
						<span class="exad-counter-icon">
							<i class="<?php echo esc_attr( $settings['exad_counter_icon'] ); ?>"></i>
						</span>
					<?php endif; ?>
          <div class="exad-counter-data">
						<span class="counter"  data-exad_counter_time="<?php echo esc_attr( $settings['exad_counter_speed'] ); ?>">
							<?php echo $settings['exad_counter_number']; ?>
						</span>
					</div>
					<div class="exad-counter-content">
            <h4><?php echo $settings['exad_counter_title']; ?></h4>
          </div>
        </div>
      </div>
    <?php
	}

	protected function _content_template() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Counter() );