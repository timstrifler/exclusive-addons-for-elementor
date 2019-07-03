<?php
namespace Elementor;

class Exad_Instagram_Feed extends Widget_Base {
	
	public function get_name() {
		return 'exad-instagram-feed';
	}
	public function get_title() {
		return esc_html__( 'Instagram Feed', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon fa fa-instagram';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
  }
  
  public function get_script_depends() {
		return [ 'exad-instagram' ];
	}


	protected function _register_controls() {
    /**
     * Instagram Feed Generel Option
     */
    $this->start_controls_section(
      'exad_instagram_gallery_content_section',
      [
        'label' => esc_html__('Generel Option', 'exclusive-addons-elementor'),
      ]
    );

    $this->add_control(
      'exad_instagram_gallery_access_token',
      [
        'label' => esc_html__('Access Token', 'exclusive-addons-elementor'),
        'type' => Controls_Manager::TEXT,
        'label_block' => true,
      ]
    );

    $this->add_control(
      'exad_instagram_gallery_user_id',
      [
        'label' => esc_html__('User ID', 'exclusive-addons-elementor'),
        'type' => Controls_Manager::TEXT,
        'label_block' => true,
      ]
    );
    $this->end_controls_section();
	}
	protected function render() {
        $settings = $this->get_settings_for_display();
        //4507625822.ba4c844.2608ae40c33d40fe97bffdc9bed8c9c7

    ?>
      <div class="exad-gallery five">
        <div class="exad-gallery-instagram instragram-overlay" id="instafeed" 
          data-limit="8" 
          data-user-id="<?php echo esc_attr( $settings['exad_instagram_gallery_user_id'] ); ?>"
          data-token="<?php echo esc_attr( $settings['exad_instagram_gallery_access_token'] ); ?>"
          data-template='
            <div class="exad-gallery-instagram-thumb">
              <a href="{{link}}" title="{{caption}}" target="_blank">
                <img src="{{image}}" alt="{{caption}}"/>
                <div class="instragram-overlay">
                  <div class="instragram-overlay-content">
                    <ul>
                      <li><i class="fa fa-search"></i></li>
                      <li><i class="fa fa-link"></i></li>
                    </ul>
                    <p>Cupidat non proident sunt.</p>
                  </div>
                </div>
              </a>
            </div>'>
        <div class="clearfix"></div>
        </div>
      </div>
    <?php
	}

	protected function _content_template() { ?>
    <?php 
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Instagram_Feed() );