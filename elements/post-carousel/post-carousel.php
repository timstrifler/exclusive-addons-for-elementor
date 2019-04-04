<?php
namespace Elementor;

class Exad_Post_Carousel extends Widget_Base {

	private $lightbox_slide_index;
	private $slide_prints_count = 0;

	public function get_name() {
		return 'exad-post-carousel';
	}

	public function get_title() {
		return esc_html__( 'Ex Post Carousel', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-post';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_script_depends() {
		return [ 'jquery-slick' ];
	}

	protected function _register_controls() {

    $this->start_controls_section(
			'section_post_carousel',
			[
				'label' => esc_html__( 'Contents', 'exclusive-addons-elementor' ),
			]
    );

    $post_repeater = new Repeater();

    /*
		* Post Image
		*/
		$post_repeater->add_control(
			'exad_post_carousel_image',
			[
				'label' => __( 'Image', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
    );
    $post_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'exad_post_carousel_image[url]!' => '',
				],
			]
    );
    $post_repeater->add_control(
			'exad_post_carousel_name',
			[
				'label' => esc_html__( 'Name', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'John Doe', 'exclusive-addons-elementor' ),
			]
    );
    $post_repeater->add_control(
			'exad_post_carousel_designation',
			[
				'label' => esc_html__( 'Designation', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'My Designation', 'exclusive-addons-elementor' ),
			]
		);
		
		$post_repeater->add_control(
			'exad_post_carousel_description',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Add post member details here', 'exclusive-addons-elementor' ),
			]
    );

    $this->add_control(
			'post_carousel_repeater',
			[
				'label' => esc_html__( 'post Carousel', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $post_repeater->get_controls(),
				'title_field' => '{{{ exad_post_carousel_name }}}',
				'default' => [
						[
							'exad_post_carousel_name' => __( 'Post #1', 'exclusive-addons-elementor' ),
							'exad_post_carousel_description' => __( 'Add Post details here', 'exclusive-addons-elementor' ),
						],
						[
							'exad_post_carousel_name' => __( 'Post #2', 'exclusive-addons-elementor' ),
							'exad_post_carousel_description' => __( 'Add Post details here', 'exclusive-addons-elementor' ),
						],
						[
							'exad_post_carousel_name' => __( 'Post #3', 'exclusive-addons-elementor' ),
							'exad_post_carousel_description' => __( 'Add Post details here', 'exclusive-addons-elementor' ),
						],
						[
							'exad_post_carousel_name' => __( 'Post #4', 'exclusive-addons-elementor' ),
							'exad_post_carousel_description' => __( 'Add Post details here', 'exclusive-addons-elementor' ),
						],
				]	
			]
		);



		$slides_per_view = range( 1, 10 );
		$slides_per_view = array_combine( $slides_per_view, $slides_per_view );

		$this->add_responsive_control(
			'exad_post_per_view',
			[
				'type'           => Controls_Manager::SELECT,
				'label'          => esc_html__( 'Post Each Row', 'exclusive-addons-elementor' ),
				'label_block'    => true,
				'options'        => $slides_per_view,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
			]
		);

		$this->add_control(
			'exad_Post_slides_to_scroll',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Post to Scroll', 'exclusive-addons-elementor' ),
				'label_block'    => true,
				'options'   => $slides_per_view,
				'default'   => '1',
			]
		);
    
    $this->end_controls_section();

		/*
		* Post carousel Styling Section
		*/
		$this->start_controls_section(
			'exad_section_team_carousel_styles_preset',
			[
				'label' => esc_html__( 'Presets', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
    );
    
    $this->end_controls_section();
	}


	protected function render() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Post_Carousel() );