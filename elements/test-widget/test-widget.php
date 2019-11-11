<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class MyTestWidget extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'exad-test-widget';
	}

	public function get_title() {
		return esc_html__( 'Test Widget', 'exclusive-addons-elementor' );
	}
	public function get_icon() {
		return 'exad-element-icon eicon-heading';
	}
	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_keywords() {
        return [ 'header', 'title' ];
    }
    
	protected function _register_controls() {
		
		/**
		* Heading Content Section
		*/
		$this->start_controls_section(
			'test_widget_content',
			[
				'label' => esc_html__( 'Content', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'title_text_catch',
			[
				'label'       => __( 'Title', 'exclusive-addons-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'This is the heading', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Enter your title', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'description_text_catch',
			[
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'exclusive-addons-elementor' ),
				'placeholder' => __( 'Enter your description', 'exclusive-addons-elementor' )
			]
		);

		$this->add_control(
			'exad_dual_heading_icon',
			[
				'label' => __( 'Icon', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid'
				]
			]
		);

		$this->add_control(
			'exad_bual_heading_buton_text',
			[
				'label' => __( 'Text', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Click here', 'elementor' ),
				'placeholder' => __( 'Click here', 'elementor' ),
			]
		);

		$this->add_control(
            'exad_dual_heading_btn_link',
            [
                'label'       => __( 'Heading URL', 'exclusive-addons-elementor' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'exclusive-addons-elementor' ),
                'label_block' => true
            ]
        );

        $repeater = new Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label'            => __( 'Icon', 'elementor' ),
				'type'             => Controls_Manager::ICONS,
				'label_block'      => true,
				'default'          => [
					'value'   => 'fab fa-wordpress',
					'library' => 'fa-brands'
				],
				'recommended' => [
					'fa-brands' => [
						'android',
						'apple',
						'behance',
						'bitbucket',
						'codepen',
						'delicious',
						'deviantart',
						'digg',
						'dribbble',
						'elementor',
						'facebook',
						'flickr',
						'google-plus',
						'instagram',
						'linkedin',
						'twitter',
						'youtube'
					],
					'fa-solid' => [
						'envelope',
						'link',
						'rss'
					]
				]
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => __( 'Link', 'elementor' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'is_external' => 'true'
				],
				'dynamic' => [
					'active' => true
				],
				'placeholder' => __( 'https://your-link.com', 'elementor' )
			]
		);

		$this->add_control(
			'social_icon_list',
			[
				'label' => __( 'Social Icons', 'elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'social_icon' => [
							'value' => 'fab fa-facebook',
							'library' => 'fa-brands'
						]
					],
					[
						'social_icon' => [
							'value' => 'fab fa-twitter',
							'library' => 'fa-brands'
						]
					],
					[
						'social_icon' => [
							'value' => 'fab fa-google-plus',
							'library' => 'fa-brands'
						]
					]
				],
				'title_field' => '{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icon, false, true, false, true ) }}}'
			]
		);

		
		$this->end_controls_section();
		
	}
	protected function render() {
		$settings          = $this->get_settings_for_display();		
	?>

		<?php
		if ( !empty( $settings['exad_dual_heading_icon']['value'] ) ) :
	        echo '<span class="exad-dual-heading-icon">';
	            Icons_Manager::render_icon( $settings['exad_dual_heading_icon'] );
	        echo '</span>';
	    endif;

	    ?>

		<?php 
		$this->add_render_attribute( 'title_text_catch', 'class', 'exad-title-class' );
		$this->add_inline_editing_attributes( 'title_text_catch', 'none' );

		if ( !empty( $settings['title_text_catch'] ) ) : ?>
			<h1 <?php echo $this->get_render_attribute_string( 'title_text_catch' ); ?>>
				<?php echo esc_html( $settings['title_text_catch'] ); ?>
			</h1>
		<?php endif; ?>


		<?php 

		$this->add_render_attribute( 'description_text_catch', 'class', 'exad-icon-box-description' );
		$this->add_inline_editing_attributes( 'description_text_catch' );

		if ( !empty( $settings['description_text_catch'] ) ) :
		?>
			<p <?php echo $this->get_render_attribute_string( 'description_text_catch' ); ?>><?php echo wp_kses_post( $settings['description_text_catch'] ); ?></p>
		<?php endif; ?>

		<?php 
			
			
			$this->add_render_attribute( 'exad_dual_heading_btn_link', 'class', 'exad-heading-button' );
			if ( ! empty( $settings['exad_dual_heading_btn_link']['url'] ) ) {
				$this->add_render_attribute( 'exad_dual_heading_btn_link', 'href', $settings['exad_dual_heading_btn_link']['url'] );

				if ( $settings['exad_dual_heading_btn_link']['is_external'] ) {
					$this->add_render_attribute( 'exad_dual_heading_btn_link', 'target', '_blank' );
				}

				if ( $settings['exad_dual_heading_btn_link']['nofollow'] ) {
					$this->add_render_attribute( 'exad_dual_heading_btn_link', 'rel', 'nofollow' );
				}
			}

	 	?>
	 	<?php if( $settings['exad_bual_heading_buton_text'] ) : ?>
			<a <?php echo $this->get_render_attribute_string( 'exad_dual_heading_btn_link' ); ?>>
				<?php $this->render_text(); ?>
			</a>
		<?php endif; ?>

		<div class="exad-social-icons-wrapper">
			<?php
			foreach ( $settings['social_icon_list'] as $index => $item ) {
				$social = '';

				if ( 'svg' !== $item['social_icon']['library'] ) {
					$social = explode( ' ', $item['social_icon']['value'], 2 );
					if ( empty( $social[1] ) ) {
						$social = '';
					} else {
						$social = str_replace( 'fa-', '', $social[1] );
					}
				}
				if ( 'svg' === $item['social_icon']['library'] ) {
					$social = '';
				}

				$link_key = 'link_' . $index;

				$this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

				$this->add_render_attribute( $link_key, 'class', [
					'exad-social-icon',
					'elementor-repeater-item-' . $item['_id'],
				] );

				if ( $item['link']['is_external'] ) {
					$this->add_render_attribute( $link_key, 'target', '_blank' );
				}

				if ( $item['link']['nofollow'] ) {
					$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
				}

				?>
				<a <?php echo $this->get_render_attribute_string( $link_key ); ?>>
					<?php
						Icons_Manager::render_icon( $item['social_icon'] );
					?>
				</a>
			<?php } ?>
		</div>


	<?php
	}

	protected function _content_template() {
		?>
		<# 
			var iconHTML = elementor.helpers.renderIcon( view, settings.exad_dual_heading_icon, { 'aria-hidden': true }, 'i' , 'object' );
			if ( iconHTML.value ) { #>
	            <span class="exad-dual-heading-icon">
	                {{{ iconHTML.value }}}
	            </span>
	        <# } 
        #>

		<# 
			view.addRenderAttribute( 'title_text_catch', 'class', 'exad-title-class' );
			view.addInlineEditingAttributes( 'title_text_catch', 'none' );
			if ( settings.title_text_catch ) { #>
				<h1 {{{ view.getRenderAttributeString( 'title_text_catch' ) }}}>
					{{{ settings.title_text_catch }}}

				</h1>
			<# } 
		#>

		<#  
			view.addRenderAttribute( 'description_text_catch', 'class', 'exad-icon-box-description' );
			view.addInlineEditingAttributes( 'description_text_catch' );
			if ( settings.description_text_catch ) { #>
				<p {{{ view.getRenderAttributeString( 'description_text_catch' ) }}}>{{{ settings.description_text_catch }}}</p>
			<# } 
		#>

		<#
			view.addRenderAttribute( 'exad_bual_heading_buton_text', 'class', 'elementor-button-text' );
			view.addInlineEditingAttributes( 'exad_bual_heading_buton_text', 'none' );
			if ( settings.exad_bual_heading_buton_text ) {
		#>

			<a href="{{ settings.exad_dual_heading_btn_link.url }}">
				<span class="elementor-button-content-wrapper">
					<span {{{ view.getRenderAttributeString( 'exad_bual_heading_buton_text' ) }}}>{{{ settings.exad_bual_heading_buton_text }}}</span>
				</span>
			</a>
			<# } 
		#>

		<# var iconsHTML = {}; #>
		<div class="exad-social-icons-wrapper">
			<# _.each( settings.social_icon_list, function( item, index ) {
				var link = item.link ? item.link.url : '';
			#>
				<a class="exad-social-icon elementor-repeater-item-{{item._id}}" href="{{ link }}">
					<# iconsHTML[ index ] = elementor.helpers.renderIcon( view, item.social_icon, {}, 'i', 'object' ); #>
					{{{ iconsHTML[ index ].value }}}
				</a>
			<# } ); #>
		</div>

		<?php
	}

	protected function render_text() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( [
			'content-wrapper' => [
				'class' => 'elementor-button-content-wrapper',
			],
			'exad_bual_heading_buton_text' => [
				'class' => 'elementor-button-text'
			]
		] );

		$this->add_inline_editing_attributes( 'exad_bual_heading_buton_text', 'none' );
		?>
		<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
			<span <?php echo $this->get_render_attribute_string( 'exad_bual_heading_buton_text' ); ?>><?php echo $settings['exad_bual_heading_buton_text']; ?></span>
		</span>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new MyTestWidget() );