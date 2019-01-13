<?php
namespace Elementor;

class Exad_Testimonial_Carousel extends Widget_Base {

	private $lightbox_slide_index;
	private $slide_prints_count = 0;

	public function get_name() {
		return 'exad-testimonial-carousel';
	}

	public function get_title() {
		return esc_html__( 'DC Testimonial Carousel', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'fa fa-user-circle';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_script_depends() {
		return [ 'jquery-slick' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_testimonial_carousel',
			[
				'label' => esc_html__( 'Contents', 'exclusive-addons-elementor' ),
			]
		);

		$testimonial_repeater = new Repeater();

		

		$testimonial_repeater->add_control(
			'exad_testimonial_carousel_name',
			[
				'label' => esc_html__( 'Name', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'John Doe', 'exclusive-addons-elementor' ),
			]
		);
		
		$testimonial_repeater->add_control(
			'exad_testimonial_carousel_designation',
			[
				'label' => esc_html__( 'Client Details', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'My Designation', 'exclusive-addons-elementor' ),
			]
		);
		
		$testimonial_repeater->add_control(
			'exad_testimonial_carousel_image',
			[
				'label' => __( 'Client Avatar', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$testimonial_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'exad_testimonial_carousel_image[url]!' => '',
				],
			]
		);

		$testimonial_repeater->add_control(
			'exad_testimonial_carousel_description',
			[
				'label' => esc_html__( 'Description', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::WYSIWYG,
				'dynamic' => [
                    'active' => true,
                ],
				'default' => esc_html__( 'Add testimonial member details here', 'exclusive-addons-elementor' ),
			]
		);

		$testimonial_repeater->add_control(
			'exad_testimonial_enable_rating',
			[
				'label' => esc_html__( 'Display Rating?', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);


		$testimonial_repeater->add_control(
		  'exad_testimonial_rating_number',
		  [
		     'label'       => __( 'Rating Number', 'exclusive-addons-elementor' ),
		     'type' => Controls_Manager::SELECT,
		     'default' => 5,
		     'options' => [
		     	1 => __( '1', 'exclusive-addons-elementor' ),
		     	2 => __( '2', 'exclusive-addons-elementor' ),
		     	3 => __( '3', 'exclusive-addons-elementor' ),
		     	4 => __( '4', 'exclusive-addons-elementor' ),
		     	5 => __( '5', 'exclusive-addons-elementor' ),
		     ],
			'condition' => [
				'exad_testimonial_enable_rating' => 'yes',
			],
		  ]
		);

		
		$this->add_control(
			'testimonial_carousel_repeater',
			[
				'label' => esc_html__( 'Testimonial Carousel', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $testimonial_repeater->get_controls(),
				'title_field' => '{{{ exad_testimonial_carousel_name }}}',
				//'default' => $this->get_repeater_defaults(),
			]
		);

		$slides_per_view = range( 1, 10 );
		$slides_per_view = array_combine( $slides_per_view, $slides_per_view );

		$this->add_responsive_control(
			'exad_testimonial_per_view',
			[
				'type'           => Controls_Manager::SELECT,
				'label'          => esc_html__( 'Testimonials On Row', 'exclusive-addons-elementor' ),
				'label_block'    => true,
				'options'        => $slides_per_view,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
			]
		);

		$this->add_control(
			'exad_testimonial_slides_to_scroll',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Testimonials to Scroll', 'exclusive-addons-elementor' ),
				'label_block'    => true,
				'options'   => $slides_per_view,
				'default'   => '1',
			]
		);


		$this->end_controls_section();

		/*
		* Testimonial Members Styling Section
		*/
		$this->start_controls_section(
			'exad_section_testimonial_carousel_styles_general',
			[
				'label' => esc_html__( 'Testimonial Carousel Styles', 'exclusive-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'exad_testimonial_carousel_preset',
			[
				'label' => esc_html__( 'Style Preset', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '-basic',
				'options' => [
					'-basic' => esc_html__( 'Basic', 'exclusive-addons-elementor' ),
					'-circle' => esc_html__( 'Circle Gradient', 'exclusive-addons-elementor' ),
					'-single' => esc_html__( 'Single Full Width', 'exclusive-addons-elementor' ),
				],
			]
		);

		$this->add_control(
			'exad_testimonial_color_scheme',
			[
				'label' => esc_html__( 'Color Scheme', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#38dae8',
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-carousel-ratings li.exad-testimonial-carousel-ratings-active i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .exad-testimonial-carousel-prev:hover, .exad-testimonial-carousel-next:hover' => 'background-color: {{VALUE}}; box-shadow: 0px 19px 27px 0px {{VALUE}}40;',
				]
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'section_testimonials_text',
            [
                'label' => __('Author Testimonial', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#8a8d91',
                'selectors' => [
                    '{{WRAPPER}} .exad-testimonial-carousel-quote' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .exad-testimonial-carousel-quote',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_testimonials_author_name',
            [
                'label' => __('Author Name', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => __('H1', 'exclusive-addons-elementor'),
                    'h2' => __('H2', 'exclusive-addons-elementor'),
                    'h3' => __('H3', 'exclusive-addons-elementor'),
                    'h4' => __('H4', 'exclusive-addons-elementor'),
                    'h5' => __('H5', 'exclusive-addons-elementor'),
                    'h6' => __('H6', 'exclusive-addons-elementor'),
                    'div' => __('div', 'exclusive-addons-elementor'),
                ],
                'default' => 'h4',
            ]
        );

        $this->add_control(
            'exad_title_color',
            [
                'label' => __('Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .exad-testimonial-carousel-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .exad-testimonial-carousel-name',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_testimonials_author_credentials',
            [
                'label' => __('Author Designation', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'credential_color',
            [
                'label' => __('Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#8a8d91',
                'selectors' => [
                    '{{WRAPPER}} .exad-testimonial-carousel-designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'credential_typography',
                'selector' => '{{WRAPPER}} .exad-testimonial-carousel-designation',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_quote_icon_styling',
            [
                'label' => __('Quote Icon', 'exclusive-addons-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'exad_quote_icon_size',
            [
                'label' => __('Icon size in pixels', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'default' => [
					'size' => 400,
					'unit' => 'px',
				],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 600,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .exad-testimonial-carousel-basic::before' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'exad_quote_icon_color',
            [
                'label' => __('Icon Color', 'exclusive-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f3f3f4',
                'selectors' => [
                    '{{WRAPPER}} .exad-testimonial-carousel-basic::before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'exclusive-addons-elementor' ),
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => esc_html__( 'Transition Duration', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'     => esc_html__( 'Autoplay', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label'   => esc_html__( 'Infinite Loop', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'pause_on_interaction',
			[
				'label'     => esc_html__( 'Pause on Interaction', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->end_controls_section();

	}


	protected function render_script() {
		$settings = $this->get_settings_for_display();

		?>
		<script>
			jQuery(document).ready(function($) {
			    "use strict";

			    // Testimonial Carousel Basic
			    $('.exad-testimonial-carousel<?php echo $settings['exad_testimonial_carousel_preset']; ?>').slick({
			    	infinite: true,
			      	prevArrow: "<div class='exad-testimonial-carousel-prev'><i class='fa fa-angle-left'></i></div>",
			      	nextArrow: "<div class='exad-testimonial-carousel-next'><i class='fa fa-angle-right'></i></div>",
			      	dots: false,
			      	slidesToShow: 3,
			      	customPaging: function (slider, i) {
			        	var image = $(slider.$slides[i]).data('image');
			        	return '<a><img src="'+ image +'"></a>';
			      	}
			    });
			    
			});
		</script>
		<?php 
	}

	protected function render_testimonial_carousel_rating( $testimonial ) {
		?>
		<ul class="exad-testimonial-carousel-ratings">
          
        <?php 
          	for( $i = 1; $i <= 5; $i++ ) {
          		if( $testimonial['exad_testimonial_rating_number'] >= $i ) {
          			$rating_active_class = 'class="exad-testimonial-carousel-ratings-active"';
          		} else {
          			$rating_active_class = '';
          		}
          		echo '<li ' . $rating_active_class . '><i class="fa fa-star"></i></li>';
          	}
        ?>
          
        </ul>

    <?php    
	}

	protected function render_svg_for_circle() {
	?>	
		<svg xmlns="http://www.w3.org/2000/svg" class="violate">
        	<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
      	</svg>
      	<svg xmlns="http://www.w3.org/2000/svg" class="violate">
        	<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
      	</svg>
      	<svg xmlns="http://www.w3.org/2000/svg" class="violate">
        	<path fill-rule="evenodd" opacity=".659" d="M61.922 0C95.654 0 123 27.29 123 60.953c0 33.664-27.346 60.953-61.078 60.953-33.733 0-61.078-27.289-61.078-60.953C.844 27.29 28.189 0 61.922 0z"/>
      	</svg>
	<?php
	}

	protected function render_testimonial_carousel_quote( $testimonial ) {
	?>	
		<div class="exad-testimonial-carousel-quote">
          <?php echo $this->parse_text_editor($testimonial['exad_testimonial_carousel_description']); ?>
        </div>
	<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$testimonial_carousel_classes = $this->get_settings_for_display('exad_testimonial_carousel_image_rounded');
		$testimonial_preset = $settings['exad_testimonial_carousel_preset'];
	?>	

		<svg width="0" height="0">
          	<defs>
            	<clipPath id="mask_testimonial">
              		<path d="M100.450,8.770 C127.510,20.597 112.050,83.754 92.321,99.399 C71.540,115.877 2.874,108.553 0.037,47.063 C-1.254,19.140 41.746,-16.889 100.450,8.770 Z"/>
            	</clipPath>
          </defs>
        </svg>
    <?php    
        $this->add_render_attribute( 
			'exad-testimonial-carousel', 
			[ 
				'class' => [ 'exad-testimonial-carousel-wrapper', 'exad-testimonial-carousel' . $testimonial_preset ],
				'data-testimonial-preset' => $testimonial_preset,
				'data-carousel-nav' => $settings['exad_testimonial_carousel_nav'],
				'data-slidestoshow' => $settings['exad_testimonial_per_view'],
				'data-slidestoscroll' => $settings['exad_testimonial_slides_to_scroll'],
	    		'data-speed' => $settings['exad_testimonial_transition_duration'],
			]
		);

		if ( $settings['exad_testimonial_pause'] == 'yes' ) {
            $this->add_render_attribute( 'exad-testimonial-carousel', 'data-pauseonhover', "true");
        }

		if ( $settings['exad_testimonial_autoplay_speed'] == 'yes' ) {
            $this->add_render_attribute( 'exad-testimonial-carousel', 'data-autoplayspeed', "true");
        }

		if ( $settings['exad_testimonial_autoplay'] == 'yes' ) {
            $this->add_render_attribute( 'exad-testimonial-carousel', 'data-autoplay', "true");
        }

		if ( $settings['exad_testimonial_loop'] == 'yes' ) {
            $this->add_render_attribute( 'exad-testimonial-carousel', 'data-loop', "true");
        }
        ?>

		<div <?php echo $this->get_render_attribute_string( 'exad-testimonial-carousel' ); ?>>
			<?php

			foreach ( $settings['testimonial_carousel_repeater'] as $testimonial ) : 

			$testimonial_carousel_image = $testimonial['exad_testimonial_carousel_image'];
			$testimonial_carousel_image_url = Group_Control_Image_Size::get_attachment_image_src( $testimonial_carousel_image['id'], 'thumbnail', $testimonial );

			if( empty( $testimonial_carousel_image_url ) ) : $testimonial_carousel_image_url = $testimonial_carousel_image['url']; else: $testimonial_carousel_image_url = $testimonial_carousel_image_url; endif;


			?>	
				<?php if ( $testimonial_preset == '-circle' ) { ?> 
				<div class="exad-testimonial-carousel-inner">
		            <div class="exad-testimonial-carousel-image">
		              <?php $this->render_svg_for_circle(); ?>
		              <img src="<?php echo esc_url( $testimonial_carousel_image_url ); ?>" class="circled" alt="<?php echo $testimonial['exad_testimonial_carousel_name']; ?>">
		            </div>
		            <?php $this->render_testimonial_carousel_rating( $testimonial ); ?>
		            <?php $this->render_testimonial_carousel_quote( $testimonial ); ?>
		            <h2 class="exad-testimonial-carousel-name"><?php echo $testimonial['exad_testimonial_carousel_name']; ?></h2>
		            <span class="exad-testimonial-carousel-designation"><?php echo $testimonial['exad_testimonial_carousel_designation']; ?></span>
		        </div>
		        <?php } elseif( $testimonial_preset == '-single' ) { ?>
		        	<div class="exad-testimonial-carousel-item">
			            <div class="exad-testimonial-carousel-inner">
			              <div class="exad-testimonial-carousel-inner-left">
			                <h2 class="exad-testimonial-carousel-name"><?php echo $testimonial['exad_testimonial_carousel_name']; ?></h2>
			                <span class="exad-testimonial-carousel-designation"><?php echo $testimonial['exad_testimonial_carousel_designation']; ?></span>
			                <?php $this->render_testimonial_carousel_quote( $testimonial ); ?>
			                <?php $this->render_testimonial_carousel_rating( $testimonial ); ?>
			              </div>
			              <div class="exad-testimonial-carousel-inner-right">
			                <div class="exad-testimonial-carousel-image">
			                  <img src="<?php echo esc_url( $testimonial_carousel_image_url ); ?>" class="circled" alt="<?php echo $testimonial['exad_testimonial_carousel_name']; ?>">
			                </div>
			              </div>
			            </div>
			          </div>
		    	<?php } else { ?>	                
		            <div class="exad-testimonial-carousel-inner" data-image= <?php echo ( $testimonial_preset == '-basic' ) ? esc_url( $testimonial_carousel_image_url ) : ''; ?>>
		            <h2 class="exad-testimonial-carousel-name"><?php echo $testimonial['exad_testimonial_carousel_name']; ?></h2>
		            <span class="exad-testimonial-carousel-designation"><?php echo $testimonial['exad_testimonial_carousel_designation']; ?></span>
		            <?php $this->render_testimonial_carousel_quote( $testimonial ); ?>
		            <?php $this->render_testimonial_carousel_rating( $testimonial ); ?>
		          </div>
		            
		        <?php } ?>    
      		<?php endforeach; ?>
		</div>	
	<?php		
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Testimonial_Carousel() );