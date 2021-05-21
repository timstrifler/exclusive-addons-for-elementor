<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Widget_Base;

class List_group extends Widget_Base {
	
	public function get_name() {
		return 'exad-list-group';
	}

	public function get_title() {
		return esc_html__( 'List Group', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad exad-logo exad-infobox';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
		return [ 'exclusive', 'information', 'group', 'list' ];
	}

	protected function register_controls() {
		
		/*
		* Icon List Content
		*/
		$this->start_controls_section(
			'exad_section_list_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'exad_list_icon',
			[
				'label'       => __( 'Icon', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => [
					'value'   => 'far fa-user',
					'library' => 'fa-regular'
				],
			]
		);

        $repeater->add_control(
			'exad_list_title',
			[
				'label'   => esc_html__( 'Title', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'List Title', 'exclusive-addons-elementor' ),
				'dynamic' => [ 'active' => true ]
			]
		);

		$this->add_control(
			'exad_list_group',
			[
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default'	=> [
					[ 'exad_list_title' => esc_html__( 'List Item 1', 'exclusive-addons-elementor' ), ],
					[ 'exad_list_title' => esc_html__( 'List Item 2', 'exclusive-addons-elementor' ) ],
					[ 'exad_list_title' => esc_html__( 'List Item 3', 'exclusive-addons-elementor' ) ]
				],
				'title_field' => '{{exad_list_title}}'
			]
		);

		$this->end_controls_section();
		
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="exad-list-group">
			<ul class="exad-list-group-wrapper">
				<?php foreach( $settings['exad_list_group'] as $list ) : ?>
					<li class="exad-list-group-item">
						<span class="exad-list-group-icon">
							<?php Icons_Manager::render_icon( $list['exad_list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</span>
						<span class="exad-list-group-icon">
							<?php echo $list['exad_list_title']; ?>
						</span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
	}
}