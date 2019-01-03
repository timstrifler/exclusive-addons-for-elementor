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
				'default' => esc_html__( 'Add team member details here', 'exclusive-addons-elementor' ),
			]
		);

		$testimonial_repeater->add_control(
			'exad_testimonial_enable_rating',
			[
				'label' => esc_html__( 'Display Rating?', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);


		$testimonial_repeater->add_control(
		  'exad_testimonial_rating_number',
		  [
		     'label'       => __( 'Rating Number', 'essential-addons-elementor' ),
		     'type' => Controls_Manager::SELECT,
		     'default' => 5,
		     'options' => [
		     	1 => __( '1', 'essential-addons-elementor' ),
		     	2 => __( '2', 'essential-addons-elementor' ),
		     	3 => __( '3', 'essential-addons-elementor' ),
		     	4 => __( '4', 'essential-addons-elementor' ),
		     	5 => __( '5', 'essential-addons-elementor' ),
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
				'default' => '-one',
				'options' => [
					'-one' => esc_html__( 'Basic', 'exclusive-addons-elementor' ),
					'-circle' => esc_html__( 'Circle Gradient', 'exclusive-addons-elementor' ),
					'-social-left' => esc_html__( 'Social Left on Hover', 'exclusive-addons-elementor' ),
					'-content-hover' => esc_html__( 'Content on Hover', 'exclusive-addons-elementor' ),
				],
			]
		);

		$this->add_control(
			'exad_testimonial_color_scheme',
			[
				'label' => esc_html__( 'Color Scheme', 'exclusive-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#38dae8',
				'selectors' => [
					'{{WRAPPER}} .exad-testimonial-carousel-one-ratings li.exad-testimonial-carousel-one-ratings-active i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .exad-testimonial-carousel-one-prev:hover, .exad-testimonial-carousel-one-next:hover' => 'background-color: {{VALUE}}; box-shadow: 0px 19px 27px 0px {{VALUE}}40;',
				]
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'section_testimonials_text',
            [
                'label' => __('Author Testimonial', 'livemesh-el-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Color', 'livemesh-el-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#8a8d91',
                'selectors' => [
                    '{{WRAPPER}} .exad-testimonial-carousel-one-quote' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .exad-testimonial-carousel-one-quote',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_testimonials_author_name',
            [
                'label' => __('Author Name', 'livemesh-el-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'livemesh-el-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => __('H1', 'livemesh-el-addons'),
                    'h2' => __('H2', 'livemesh-el-addons'),
                    'h3' => __('H3', 'livemesh-el-addons'),
                    'h4' => __('H4', 'livemesh-el-addons'),
                    'h5' => __('H5', 'livemesh-el-addons'),
                    'h6' => __('H6', 'livemesh-el-addons'),
                    'div' => __('div', 'livemesh-el-addons'),
                ],
                'default' => 'h4',
            ]
        );

        $this->add_control(
            'exad_title_color',
            [
                'label' => __('Color', 'livemesh-el-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .exad-testimonial-carousel-one-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .exad-testimonial-carousel-one-name',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_testimonials_author_credentials',
            [
                'label' => __('Author Designation', 'livemesh-el-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'credential_color',
            [
                'label' => __('Color', 'livemesh-el-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#8a8d91',
                'selectors' => [
                    '{{WRAPPER}} .exad-testimonial-carousel-one-designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'credential_typography',
                'selector' => '{{WRAPPER}} .exad-testimonial-carousel-one-designation',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_quote_icon_styling',
            [
                'label' => __('Quote Icon', 'livemesh-el-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'exad_quote_icon_size',
            [
                'label' => __('Icon size in pixels', 'livemesh-el-addons'),
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
                    '{{WRAPPER}} .exad-testimonial-carousel-one::before' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'exad_quote_icon_color',
            [
                'label' => __('Icon Color', 'livemesh-el-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f3f3f4',
                'selectors' => [
                    '{{WRAPPER}} .exad-testimonial-carousel-one::before' => 'color: {{VALUE}};',
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

			    // Testimonial Carousel One
			    $('.exad-testimonial-carousel<?php echo $settings['exad_testimonial_carousel_preset']; ?>').slick({
			    	infinite: true,
			      	prevArrow: "<div class='exad-testimonial-carousel-one-prev'><i class='fa fa-angle-left'></i></div>",
			      	nextArrow: "<div class='exad-testimonial-carousel-one-next'><i class='fa fa-angle-right'></i></div>",
			      	dots: true,
			      	customPaging: function (slider, i) {
			        	var image = $(slider.$slides[i]).data('image');
			        	return '<a><img src="'+ image +'"></a>';
			      	}
			    });
			    
			});
		</script>
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

		<div class="exad-testimonial-carousel<?php echo $testimonial_preset; ?>">

			<?php foreach ( $settings['testimonial_carousel_repeater'] as $testimonial ) : 

			$testimonial_carousel_image = $testimonial['exad_testimonial_carousel_image'];
			$testimonial_carousel_image_url = Group_Control_Image_Size::get_attachment_image_src( $testimonial_carousel_image['id'], 'thumbnail', $testimonial );
			if( empty( $testimonial_carousel_image_url ) ) : $testimonial_carousel_image_url = $testimonial_carousel_image['url']; else: $testimonial_carousel_image_url = $testimonial_carousel_image_url; endif;

				?>	

				<div class="exad-testimonial-carousel-one-inner" data-image="<?php echo esc_url( $testimonial_carousel_image_url ); ?>">
	                <h5 class="exad-testimonial-carousel-one-name"><?php echo $testimonial['exad_testimonial_carousel_name']; ?></h5>
	                <span class="exad-testimonial-carousel-one-designation"><?php echo $testimonial['exad_testimonial_carousel_designation']; ?></span>
	                <div class="exad-testimonial-carousel-one-quote">
	                  <?php echo $this->parse_text_editor($testimonial['exad_testimonial_carousel_description']); ?>
	                </div>
	                <ul class="exad-testimonial-carousel-one-ratings">
	                  
	                  <?php 
	                  	for( $i = 1; $i <= 5; $i++ ) {
	                  		if( $testimonial['exad_testimonial_rating_number'] >= $i ) {
	                  			$rating_active_class = 'class="exad-testimonial-carousel-one-ratings-active"';
	                  		} else {
	                  			$rating_active_class = '';
	                  		}
	                  		echo '<li ' . $rating_active_class . '><i class="fa fa-star"></i></li>';
	                  	}
	                  ?>
	                  
	                </ul>
	            </div>

      		<?php endforeach; ?>
		</div>	
	<?php	
	$this->render_script();	
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Testimonial_Carousel() );