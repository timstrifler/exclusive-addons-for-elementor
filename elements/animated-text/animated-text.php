<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Exad_Animated_Text extends Widget_Base {

	public function get_name() {
		return 'exad-animated-text';
	}

	public function get_title() {
		return esc_html__( 'Animated Text', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-text';
	}

   	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}
	  
 	public function get_script_depends() {
		return [ 'animated-text' ];
	}

	protected function _register_controls() {
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
			'label' => esc_html__( 'Before Animated Text', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::TEXTAREA,
			'default'     => esc_html__( "This is ", 'exclusive-addons-elementor' ),
        ]
	);

	$this->add_control(
		'exad_animated_text_animated_heading',
		[
			'label'       => esc_html__( 'Animated Text', 'exclusive-addons-elementor' ),
			'type'        => Controls_Manager::TEXTAREA,
			'placeholder' => esc_html__( 'Enter your title', 'exclusive-addons-elementor' ),
			'description' => esc_html__( 'Write animated heading here with comma separated.', 'exclusive-addons-elementor' ),
			'default'     => esc_html__( "Animated,Morphing,Awesome", 'exclusive-addons-elementor' ),
			'dynamic'     => [ 'active' => true ],
		]
	);
	
	$this->add_control(
        'exad_animated_text_after_text',
        [
			'label' => esc_html__( 'After Animated Text', 'exclusive-addons-elementor' ),
			'type' => Controls_Manager::TEXTAREA,
			'default'     => esc_html__( "Heading", 'exclusive-addons-elementor' ),
        ]
	);

	$this->add_control(
		'exad_animated_text_animated_heading_tag',
		[
			'label'   => esc_html__( 'HTML Tag', 'exclusive-addons-elementor' ),
			'type'    => Controls_Manager::SELECT,
			'options' => element_pack_title_tags(),
			'default' => 'h2',
		]
	);

	$this->end_controls_section();
	
	/*
    * Animated Text Settings
    */
    $this->start_controls_section(
        'exad_section_animated_text_settings',
        [
            'label' => esc_html__( 'Settings', 'exclusive-addons-elementor' )
        ]
	);

	$this->end_controls_section();
	
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$id = $this->get_id();
		$type_heading = explode(",", esc_html($settings['exad_animated_text_animated_heading']) );

		// $header_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['exad_animated_text_animated_heading_tag'], $this->get_render_attribute_string( 'typed_animated_string' ) );

		$this->add_render_attribute( 'typed_animated_string', 'class', 'typed-strings' );

		$this->add_render_attribute( 'typed_animated_string', 'data-type_string', json_encode($type_heading) );	
		// var_dump($type_heading);
	?>

	<div class="exad-animated-text">
		<<?php echo ($settings['exad_animated_text_animated_heading_tag']); ?> <?php echo $this->get_render_attribute_string( 'typed_animated_string' ) ?> >
			<span class="exad-animated-text-pre-heading"><?php echo esc_attr( $settings['exad_animated_text_before_text'] ); ?></span>
				<span id="exad-animated-text-<?php echo $id; ?>" class="exad-animated-text-animated-heading"></span>
			<span class="bdt-post-heading"><?php echo esc_attr( $settings['exad_animated_text_after_text'] ); ?></span>
		</<?php echo ($settings['exad_animated_text_animated_heading_tag']); ?>>
	</div>
	<?php
	}

	/*protected function render() {

		$settings = $this->get_settings_for_display();
		$id = $this->get_id();
		$type_heading = explode(",", esc_html($settings['exad_animated_text_animated_heading']) );

		$this->add_render_attribute( 'typed_animated_string', 'class', 'typed-strings' );

		$this->add_render_attribute( 'typed_animated_string', 'data-type_string', json_encode($type_heading) );	
		// var_dump($type_heading);
	?>
	<div class="exad-animated-text">
		<div <?php echo $this->get_render_attribute_string( 'typed_animated_string' ) ?> >
			<?php echo esc_attr( $settings['exad_animated_text_before_text'] ); ?>
				<span id="typed-text"></span>
			<?php echo esc_attr( $settings['exad_animated_text_after_text'] ); ?>
		</div>
	</div>
	<?php
	}*/
}


Plugin::instance()->widgets_manager->register_widget_type( new Exad_Animated_Text() );