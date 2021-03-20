<?php
namespace ExclusiveAddons\Elements;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Scheme_Typography;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Background;

class Facebook_Reviews extends Widget_Base {

    public function get_name() {
		return 'exad-facebook-reviews';
	}

	public function get_title() {
		return __('Facebook Reviews', 'exclusive-addons-elementor');
	}

	public function get_icon() {
		return 'exad-logo eicon-facebook';
	}

	public function get_keywords() {
		return ['social', 'media', 'sharing'];
    }
    
    public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}


	/**
	 * Register controls
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'exad_facebook_feed_wrapper',
			[
				'label' => __( 'Facebook Feed', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'exad_facebook_page_id',
			[
				'label' => esc_html__('Page ID', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '228776804732213',
				'label_block' => true,
				'description' => '<a href="https://lookup-id.com/" target="_blank">Find Page ID</a>',
			]
		);

		$this->add_control(
			'exad_facebook_access_token',
			[
				'label' => esc_html__('Access Token', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'EAAkn4TitXBIBALh0uMIsK6ZAnQywN62Izkw9nh5G3BRH3uKQJwfVoaZCZA4ZBKcCV00KLrFRZCgGrM4lpHytJGhhcj2jqZChcMbx5KqIL5xarn6EkPiZAwrR5tFtTWw6YZAo35OuzwPtyW5DceYJmAsrwf2v9R3skZCBClIHXjCQ5b42Xa0GV5xMG',
				'label_block' => true,
				'description' => '<a href="https://developers.facebook.com/apps/" target="_blank">Get Access Token.</a>',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$this->facebook_feed_render($this->get_id(), $settings); ?>
	
		<?php
	}

	protected function facebook_feed_render( $id, $settings ) {
		$page_id = trim($settings['exad_facebook_page_id']);
		$access_token = $settings['exad_facebook_access_token'];
		if ( empty( $page_id ) || empty( $access_token ) ) {
			return;
		}

		$exad_facebook_feed_cash = '_' . $id . '_facebook_cash';
		$transient_key = $page_id . $exad_facebook_feed_cash;
		$facebook_feed_data = get_transient($transient_key);
		$messages = [];

		if ( false === $facebook_feed_data ) {
			$url = "https://graph.facebook.com/v8.0/{$page_id}/ratings?access_token={$access_token}";
			$url .= '&fields=reviewer{id,name,picture.width(200).height(200)},created_time,rating,recommendation_type,review_text,open_graph_story{id}&limit=9999';
			// $url .= '&fields=id';
			$data = wp_remote_get( $url );
			$facebook_feed_data = json_decode( wp_remote_retrieve_body( $data ), true );
			set_transient( $transient_key, $facebook_feed_data, 0 );
		}
		// if ( $settings['remove_cash'] == 'yes' ) {
			delete_transient( $transient_key );
		// }


		if ( !empty( $facebook_feed_data ) && array_key_exists( 'error', $facebook_feed_data ) ) {
			$messages['error'] = $facebook_feed_data['error']['message'];
		}

		if ( !empty( $messages ) ) {
			foreach ($messages as $key => $message) {
				printf('<div class="exad-facebook-error-message">%1$s</div>', esc_html( $message ) );
			}
			return;
		}

		'<pre>';
		
		// var_dump($facebook_feed_data);
		echo "<pre>",print_r($facebook_feed_data, true),"</pre>";
		'</pre>';

		?>

		<?php

	}

}