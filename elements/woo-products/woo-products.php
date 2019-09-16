<?php
namespace Elementor;

class Exad_Woo_Products extends Widget_Base {

	public function get_name() {
		return 'exad-woo-products';
	}

	public function get_title() {
		return esc_html__( 'Woo Products', 'exclusive-addons-elementor' );
	}

	public function get_icon() {
		return 'exad-element-icon eicon-person';
	}

	public function get_categories() {
		return [ 'exclusive-addons-elementor' ];
	}

	public function get_script_depends() {
		return [ 'jquery-slick' ];
	}

    public function exad_get_product_categories( $post_type ) {

        $options = array();
        $taxonomy = 'product_cat';

        if ( ! empty( $taxonomy ) ) {
            // Get categories for post type.
            $terms = get_terms(
                array(
                    'taxonomy'   => $taxonomy,
                    'hide_empty' => false,
                )
            );
            if ( ! empty( $terms ) ) {
                $options = ['' => ''];
                foreach ( $terms as $term ) {
                    if ( isset( $term ) ) {
                        if ( isset( $term->term_id ) && isset( $term->name ) ) {
                            $options[ $term->term_id ] = $term->name;
                        }
                    }
                }
            }
        }

        return $options;
    }

	protected function _register_controls() {

		$this->start_controls_section(
			'exad_woo_product_content_section',
			[
				'label' => esc_html__( 'Contents', 'exclusive-addons-elementor' ),
			]
		);

        $this->add_control(
            'exad_woo_product_skin_type',
            [
                'label'     => esc_html__( 'Skin Type',  'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'one',
                'options'   => [
                    'one'   => esc_html__( 'Style 1', 'exclusive-addons-elementor' ),
                    'two'   => esc_html__( 'Style 2', 'exclusive-addons-elementor' ),
                    'three' => esc_html__( 'Style 3', 'exclusive-addons-elementor' ),
                    'four'  => esc_html__( 'Style 4', 'exclusive-addons-elementor' ),
                    'five'  => esc_html__( 'Style 5', 'exclusive-addons-elementor' ),
                    'six'   => esc_html__( 'Style 6', 'exclusive-addons-elementor' )
                ]
            ]
        );

        $this->add_control(
            'exad_woo_product_content_type',
            [
                'label'     => esc_html__( 'Content Type', 'exclusive-addons-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'grid',
                'options'   => [
                    'grid'   => esc_html__( 'Grid',    'exclusive-addons-elementor' ),
                    'slider' => esc_html__( 'Slider',    'exclusive-addons-elementor' )
                ]
            ]
        );

        $this->add_control(
            'exad_woo_product_excerpt_length',
            [
                'label'         => esc_html__('Excerpt Length', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 10,
                'condition'     => [
                    '.exad_woo_product_skin_type' => 'six'
                ]
            ]
        ); 

        $this->add_control(
            'exad_woo_product_categories',
            [
                'label'         => esc_html__( 'Product Category', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SELECT2,
                'options'       => $this->exad_get_product_categories( 'product' ),
                'multiple'      => true
            ]
        );

        $this->add_control(
            'exad_woo_order_by',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => esc_html__( 'Order by', 'exclusive-addons-elementor' ),
                'default' => 'name',
                'options' => [
                    'name'          => esc_html__('Name', 'exclusive-addons-elementor' ),
                    'id'            => esc_html__('ID', 'exclusive-addons-elementor' ),
                    'count'         => esc_html__('Count', 'exclusive-addons-elementor' ),
                    'slug'          => esc_html__('Slug', 'exclusive-addons-elementor' ),
                    'term_group'    => esc_html__('Term Group', 'exclusive-addons-elementor' ),
                    'none'          => esc_html__('None', 'exclusive-addons-elementor' )
                ]
            ]
        );

        // order
        $this->add_control(
            'exad_woo_order',
            [
                'type'          => Controls_Manager::SELECT,
                'label'         => esc_html__( 'Order', 'exclusive-addons-elementor' ),
                'default'       => 'DESC',
                'options'       => [
                    'ASC'       => esc_html__( 'Ascending', 'exclusive-addons-elementor' ),
                    'DESC'      => esc_html__( 'Descending', 'exclusive-addons-elementor' )
                ]
            ]
        );

        // number of products
        $this->add_control(
            'product_per_page',
            [
                'label'         => esc_html__('Number of products to show', 'exclusive-addons-elementor'),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 8
            ]
        ); 

        // selected id to show post
        $this->add_control(
            'product_in_ids',
            [
                'label'         => esc_html__('Product Include', 'exclusive-addons-elementor' ),
                'description'   => esc_html__('Provide a comma separated list of Product IDs to display spacific Product.', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::TEXT
            ]
        );

        // specific id to exclude post
        $this->add_control(
            'product_not_in_ids',
            [   
                'label'         => esc_html__( 'Product Exclude', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::TEXT,
                'description'   => esc_html__('Provide a comma separated list of Product IDs to exclude specific Product.', 'exclusive-addons-elementor' )
            ]
        );   

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'          => 'image_size',
                'default'       => 'medium'
            ]
        );

        // show feature image?
        $this->add_control(
            'only_post_has_image',
            [
                'label'         => esc_html__( 'Show only Product has feature image. Default: Yes.', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'no',
                'return_value'  => 'yes'
            ]
        );

        $this->add_control(
            'exad_woo_product_star_rating',
            [
                'label'         => esc_html__( 'Product Star Rating?', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'return_value'  => 'yes',
                'condition'     => [
                    'exad_woo_product_skin_type' => ['two', 'three', 'six']
                ]        
            ]
        );

        $this->add_control(
            'exad_woo_product_sell_in_percentage',
            [
                'label'         => esc_html__( 'Product Sale in Percentage?', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'return_value'  => 'yes',
                'condition'     => [
                    'exad_woo_product_skin_type' => ['one', 'two', 'three', 'four']
                ]        
            ]
        );

        $this->add_control(
            'exad_woo_product_featured_label',
            [
                'label'         => esc_html__( 'Product Feature Label?', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'return_value'  => 'yes',
                'condition'     => [
                    'exad_woo_product_skin_type' => ['one', 'two', 'three', 'four']
                ]    
            ]
        );

        $this->add_control(
            'exad_woo_product_sold_out_label',
            [
                'label'         => esc_html__( 'Product Out Of Stock Label?', 'exclusive-addons-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'yes',
                'return_value'  => 'yes',
                'condition'     => [
                    'exad_woo_product_skin_type' => ['one', 'two', 'three', 'four']
                ]       
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_carousel_settings',
            [
                'label' => esc_html__( 'Carousel Settings', 'exclusive-addons-elementor' ),                        
                'condition' => [
                    'exad_woo_product_content_type' => 'slider',
                ]
            ]
        );

		$slides_per_view = range( 1, 6 );
		$slides_per_view = array_combine( $slides_per_view, $slides_per_view );

		$this->add_control(
			'exad_team_per_view',
			[
				'type'           => Controls_Manager::SELECT,
				'label'          => esc_html__( 'Columns', 'exclusive-addons-elementor' ),
				'options'        => $slides_per_view,
				'default'        => '4',
			]
		);

		$this->add_control(
			'exad_team_slides_to_scroll',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Items to Scroll', 'exclusive-addons-elementor' ),
				'options'   => $slides_per_view,
				'default'   => '1',
			]
		);

		$this->add_control(
			'exad_team_carousel_nav',
			[
				'label' => esc_html__( 'Navigation Style', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'arrows',
				'separator' => 'before',
				'options' => [
					'arrows' => esc_html__( 'Arrows', 'exclusive-addons-elementor' ),
					'dots' => esc_html__( 'Dots', 'exclusive-addons-elementor' ),
					
				],
			]
		);

		$this->add_control(
			'exad_team_transition_duration',
			[
				'label'   => esc_html__( 'Transition Duration', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 1000,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'exad_team_autoplay',
			[
				'label'     => esc_html__( 'Autoplay', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
			]
		);

		$this->add_control(
			'exad_team_autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
                'condition' => [
                    'exad_team_autoplay' => 'yes',
                ]
			]
		);

		$this->add_control(
			'exad_team_loop',
			[
				'label'   => esc_html__( 'Infinite Loop', 'exclusive-addons-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'exad_team_pause',
			[
				'label'     => esc_html__( 'Pause on Hover', 'exclusive-addons-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'exad_team_autoplay' => 'yes',
				],
			]
		);


		$this->end_controls_section();

	}

    private function render_image( $image_id, $settings ) {
        $image_size = $settings['image_size_size'];
        if ( 'custom' === $image_size ) {
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'image_size', $settings );
        } else {
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        }

        return sprintf( '<img class="exad-woo-product-content-image" src="%s" alt="%s" />', esc_url($image_src), esc_html( get_post_meta( $image_id, '_wp_attachment_image_alt', true) ) );
    }

	private function exad_woo_product_label() {
		$settings = $this->get_settings_for_display();

	    global $product, $post;
	    $out_of_stock = false;
	    if (!$product->is_in_stock() && !is_product()) {
	        $out_of_stock = true;
	    }
	    echo '<ul class="exad-woo-product-content-badge">';
	        /* Sale label */
	        if ($product->is_on_sale() && !$out_of_stock) {

	            $percentage = '';

	            if ($product->get_type() == 'variable') {

	                $available_variations = $product->get_variation_prices();
	                $max_percentage = 0;

	                foreach ($available_variations['regular_price'] as $key => $regular_price) {
	                    $sale_price = $available_variations['sale_price'][$key];

	                    if ($sale_price < $regular_price) {
	                        $percentage = round((($regular_price - $sale_price) / $regular_price) * 100);

	                        if ($percentage > $max_percentage) {
	                            $max_percentage = $percentage;
	                        }
	                    }
	                }

	                $percentage = $max_percentage;
	            } elseif ($product->get_type() == 'simple' || $product->get_type() == 'external') {
	                $percentage = round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100);
	            }

                if( 'one' == $settings['exad_woo_product_skin_type'] || 'two' == $settings['exad_woo_product_skin_type'] ) :
    	            if ($percentage && ($settings['exad_woo_product_sell_in_percentage'] == 'yes')) {
    	                echo '<li class="onsale percent">-' . $percentage . '%' . '</li>';
    	            } else {
    	                echo '<li class="onsale">' . esc_html__('Sale', 'exclusive-addons-elementor') . '</li>';
    	            }
                endif;

	        }

            if( 'one' == $settings['exad_woo_product_skin_type'] || 'two' == $settings['exad_woo_product_skin_type'] ) :
    	        //Hot label
    	        if ($product->is_featured() && !$out_of_stock && ($settings['exad_woo_product_featured_label'] == 'yes')) {
    	            echo '<li class="featured">' . esc_html__('Hot', 'exclusive-addons-elementor') . '</li>';
    	        }

    	        // Out of stock
    	        if ($out_of_stock && ($settings['exad_woo_product_sold_out_label'] == 'yes')) {
    	            echo '<li class="out-of-stock">' . esc_html__('Sold out', 'exclusive-addons-elementor') . '</li>';
    	        }
            endif;
	    echo '</ul>';
	}

    /**
     * product price
     */
    protected function exad_woo_product_price() {

        if ( ! function_exists( 'wc_get_product' ) ) {
            return null;
        }
        $product  = wc_get_product( get_the_ID() );
        echo '<span class="exad-woo-product-content-price">';
            $price = $product->get_price_html();
            if ( ! empty( $price ) ) {
                echo wp_kses(
                    $price, array(
                        'span' => array(
                            'class' => array(),
                        ),
                        'del'  => array(),
                    )
                );
            }
        echo '</span>';
    }

	protected function render() {
		$settings = $this->get_settings_for_display();
		$skinType = $settings['exad_woo_product_skin_type'];
        $contentType = $settings['exad_woo_product_content_type'];
        $excerptLength = $settings['exad_woo_product_excerpt_length'];
		$starRating = $settings['exad_woo_product_star_rating'];
        $orderby   = $settings['exad_woo_order_by'];
        $order     = $settings['exad_woo_order'];
        $product_per_page  = $settings['product_per_page'];   
        $product_in_ids     = $settings['product_in_ids'] ? explode( ',', $settings['product_in_ids'] ) : null;
        $product_not_in_ids = $settings['product_not_in_ids'] ? explode( ',', $settings['product_not_in_ids'] ) : null; 

        $this->add_render_attribute( 
            'exad-woo-product-wrapper', 
            [ 
                'class' => [ 'exad-woo-product-wrapper', 'content-type-'.$contentType ]
            ]
        );

        if ( 'slider' == $settings['exad_woo_product_content_type'] ):
    		$this->add_render_attribute( 
    			'exad-woo-product-wrapper', 
    			[ 
    				'data-carousel-nav' => $settings['exad_team_carousel_nav'],
    				'data-slidestoshow' => $settings['exad_team_per_view'],
    				'data-slidestoscroll' => $settings['exad_team_slides_to_scroll'],
    	    		'data-speed' => $settings['exad_team_transition_duration']
    			]
    		);
    		if ( 'yes' == $settings['exad_team_autoplay'] ) :
    			$this->add_render_attribute( 'exad-woo-product-wrapper', 'data-autoplay', "true");
    			$this->add_render_attribute( 'exad-woo-product-wrapper', 'data-autoplayspeed', $settings['exad_team_autoplay_speed'] );
    		endif;
    		
    		if ( 'yes' == $settings['exad_team_pause'] ):
                $this->add_render_attribute( 'exad-woo-product-wrapper', 'data-pauseonhover', "true" );
            endif;

    		if ( 'yes' == $settings['exad_team_loop'] ):
                $this->add_render_attribute( 'exad-woo-product-wrapper', 'data-loop', "true");
            endif;
        endif;

        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => $product_per_page,
            'orderby'        => $orderby,
            'order'          => $order,
            'post__in'       => $product_in_ids,
            'post__not_in'   => $product_not_in_ids
        );

        // show only post has feature image
        if( $settings['only_post_has_image'] == 'yes' ){
            $args['meta_query'][] = array( 'key' => '_thumbnail_id');
        }

        // display products in category.
        if ( ! empty( $settings['exad_woo_product_categories'] ) ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $settings['exad_woo_product_categories']
                )
            );
        }

        $wp_query = new \WP_Query( $args );
        if ( $wp_query->have_posts() ) : 
        echo '<div class="exad-woo-product '.esc_attr($skinType).'">';
	?>
	<ul <?php echo $this->get_render_attribute_string( 'exad-woo-product-wrapper' ); ?>>

	<?php
                while ( $wp_query->have_posts() ) : $wp_query->the_post();
                	global $product, $post;
                    $average = $product->get_average_rating();
					?>
					<li <?php post_class( 'exad-woo-product-item' ); ?>>
					<?php
						if('one' == $skinType || 'two' == $skinType) :
				            echo '<div class="exad-woo-product-content">';
								$this->exad_woo_product_label();
				                echo $this->render_image( get_post_thumbnail_id( get_the_id() ), $settings );
				                echo '<h3 class="exad-woo-product-content-name">'.get_the_title().'</h3>';

				                if('two' == $skinType && 'yes' == $starRating):
		                            echo '<ul class="exad-woo-product-content-rating">';
		                                echo '<div class="exad-woo-product-star-rating" title="'. sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $average) .'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>';
		                            echo '</ul>';
								endif;                       
				                echo $this->exad_woo_product_price();
				                // echo '<a href="'.get_permalink().'" class="exad-woo-product-content-action">';
				                    // echo '<svg width="16" height="15">';
				                    //     echo '<path fill-rule="evenodd" d="M14.972 8.337h-.522l-.999 5.501c-.125.648-.703 1.162-1.304 1.162H3.646c-.601 0-1.179-.514-1.304-1.162L1.35 8.34h-.322A1.04 1.04 0 0 1 0 7.289V6.124C0 5.543.432 5 1 5h14c.568 0 .997.543 1 1.12v1.166a1.04 1.04 0 0 1-1.028 1.051zM6 10V9c0-.355-.44-1.014-.999-1.014C4.476 7.986 4 8.623 4 9v3c0 .354.443 1.001 1.001 1.001.526 0 .999-.624.999-1.001v-2zm3 0V9c0-.284-.448-1.011-.988-1.011C7.473 7.989 7 8.698 7 9v3c0 .283.439 1.001 1.012 1.001.54 0 .988-.7.988-1.001v-2zm3 1V9c0-.377-.447-1.014-.986-1.014C10.474 7.986 10 8.645 10 9v3c0 .377.474 1.001 1.014 1.001.573 0 .986-.647.986-1.001v-1zM9.522.932a.624.624 0 0 1 .217-.846.595.595 0 0 1 .828.221l2.079 3.647h-1.402L9.522.932zM4.763 3.958H3.36L5.439.307a.598.598 0 0 1 .828-.221.626.626 0 0 1 .217.846L4.763 3.958z"></path>';
				                    // echo '</svg>';

				                	woocommerce_template_loop_add_to_cart();
				                    // echo 'Buy It';
				                // echo '</a>';
			            	echo '</div>';
						elseif('six' == $skinType) :
							echo '<div class="exad-woo-product-thumb">';
							    echo $this->render_image( get_post_thumbnail_id( get_the_id() ), $settings );
							echo '</div>';
							echo '<div class="exad-woo-product-content">';
							    echo $this->exad_woo_product_price();
                                 if ('yes' == $starRating) {
		             				echo '<ul class="exad-woo-product-content-rating">';
		                                echo '<div class="exad-woo-product-star-rating" title="'. sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $average) .'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>';
		                            echo '</ul>';
                                }
							    echo '<h3 class="exad-woo-product-content-name">'.get_the_title().'</h3>';
echo '<p class="exad-woo-product-content-description">'.wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $excerptLength ) ).'</p>';
// echo '<p class="exad-woo-product-content-description">Lorem ipsum dolor sit amet consectetur, adipisicingelit. Non, at!</p>';
							    woocommerce_template_loop_add_to_cart();
							echo '</div>';
			            endif;
			        echo '</li>';
                endwhile;
    		echo '</ul>';
		echo '</div>';

        endif;
        wp_reset_postdata();

	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Exad_Woo_Products() );