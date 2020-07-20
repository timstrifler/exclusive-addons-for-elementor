<?php
namespace ExclusiveAddons\Elementor;

class Helper {
    public static function init() {
        add_action( 'wp_ajax_ajax_pagination', [ __CLASS__, 'exad_ajax_pagination' ] );
        add_action( 'wp_ajax_nopriv_ajax_pagination', [ __CLASS__, 'exad_ajax_pagination' ] );
    }
    /**
     *
     * Get list of Post Types
     * @return array
     */

    public static function exad_get_post_types() {
        $post_type_args = array(
            'public'            => true,
            'show_in_nav_menus' => true
        );

        $post_types = get_post_types($post_type_args, 'objects');
        $post_lists = array();
        foreach ($post_types as $post_type) {
            $post_lists[$post_type->name] = $post_type->labels->singular_name;
        }
        return $post_lists;
    }


    /**
     * Retrive the list of Contact Form 7 Forms [ if plugin activated ]
     */
    
    public static function exad_retrive_contact_form() {
        if ( function_exists( 'wpcf7' ) ) {
            $wpcf7_form_list = get_posts(array(
                'post_type' => 'wpcf7_contact_form',
                'showposts' => 999,
            ));
            $options = array();
            $options[0] = esc_html__( 'Select a Form', 'exclusive-addons-elementor' );
            if ( ! empty( $wpcf7_form_list ) && ! is_wp_error( $wpcf7_form_list ) ){
                foreach ( $wpcf7_form_list as $post ) {
                    $options[ $post->ID ] = $post->post_title;
                }
            } else {
                $options[0] = esc_html__( 'Create a Form First', 'exclusive-addons-elementor' );
            }
            return $options;
        }
    }

    /** 
     *
     * List all categories 
     * @return array
     */

    public static function exad_get_all_categories() {
        $cat_array = array();
        $categories = get_categories('orderby=name&hide_empty=0');
        foreach ($categories as $category):
            $cat_array[$category->term_id] = $category->name;
        endforeach;

        return $cat_array;
    }

    /** 
     *
     * List all Tags 
     * @return array
     */

    public static function exad_get_all_tags() {
        $tag_array = array();
        $tags = get_tags();
        foreach ( $tags as $tag ) {
            $tag_array[$tag->term_id] = $tag->name;
        }

        return $tag_array;
    } 


    /**
     * All Author with published post
     * @return array
     */
    public static function exad_get_authors() {
        $user_query = new \WP_User_Query(
            [
                'who' => 'authors',
                'has_published_posts' => true,
                'fields' => [
                    'ID',
                    'display_name',
                ],
            ]
        );

        $authors = array();

        foreach ( $user_query->get_results() as $result ) {
            $authors[ $result->ID ] = $result->display_name;
        }

        return $authors;
    }

    /**
     *
     * Post Excerpt based on ID and Excerpt Length
     * @param  int $post_id
     * @param  int $length
     * @return string
     *
     */
    public static function exad_get_post_excerpt( $post_id, $length ){
        $the_post = get_post($post_id);

        $the_excerpt = '';
        if ($the_post)
        {
            $the_excerpt = $the_post->post_excerpt ? $the_post->post_excerpt : $the_post->post_content;
        }

        $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
        $words = explode(' ', $the_excerpt, intval( $length ) + 1);

        if(count($words) > $length) :
            array_pop($words);
            array_push($words, '…');
            $the_excerpt = implode(' ', $words);
        endif;

        return $the_excerpt;
    }


    /**
     *
     * @return Array of Post arguments based on Post Style prefix
     *
     *
     */

    public static function exad_get_post_arguments( $settings, $prefix ) {

        $author_ids = implode( ", ", $settings[ $prefix . '_authors'] );

        if ( isset( $settings[ $prefix . '_categories'] ) ) {
            $category_ids = implode( ", ", $settings[ $prefix . '_categories'] );
        } else {
            $category_ids = [];
        }

        if ( 'yes' === $settings[ $prefix . '_ignore_sticky'] ) {
            $exad_ignore_sticky = true;
        } else {
            $exad_ignore_sticky = false;
        }

        $post_args = array(
            'post_type'        => $settings[ $prefix . '_type'],
            'posts_per_page'   => $settings[ $prefix .'_per_page'],
            'offset'           => $settings[ $prefix . '_offset'],
            'cat'              => $category_ids,
            'category_name'    => '',
            'ignore_sticky_posts' => $exad_ignore_sticky,
            'orderby'          => 'date',
            'order'            => $settings[ $prefix . '_order'],
            'include'          => '',
            'exclude'          => '',
            'meta_key'         => '',
            'meta_value'       => '',
            'post_mime_type'   => '',
            'post_parent'      => '',
            'author'           => $author_ids,
            'author_name'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => true,
            'tag__in'          => $settings[ $prefix . '_tags'],
            'post__not_in'     => '',
        );

        return $post_args;

    }

    /**
     *
     * Get the categories as list
     *
     */
    public static function exad_get_categories_for_post() {

        $categories = get_the_category();
        $separator = ' ';
        $output = '';
        if ( ! empty( $categories ) ) {
            foreach( $categories as $category ) {
                $output .= '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a></li>' . $separator;
            }
            echo trim( $output, $separator );
        }
    }

    /**
     * READING TIME
     *
     * Calculate an approximate reading-time for a post.
     *
     * @param  string $content The content to be measured.
     * @return  integer Reading-time in seconds.
     */
    public static function exad_reading_time( $content ) {
        
        $word_count = str_word_count( strip_tags( $content ) );
        $readingtime = ceil($word_count / 200);
    
        $timer = " min read";
        
        $totalreadingtime = $readingtime . $timer;
    
        return $totalreadingtime;
    }

    /**
     * 
     * Return the Posts from Database
     *
     * @return string of an html markup with AJAX call.
     * @return array of content and found posts count without AJAX call.
     */

    public static function exad_get_posts( $settings ) {
        
        $posts = new \WP_Query( $settings['post_args'] );

        while( $posts->have_posts() ) : $posts->the_post(); 

            if ( 'exad-post-timeline' === $settings['template_type'] ) { 
                include EXAD_TEMPLATES . 'tmpl-post-timeline.php';
            } elseif ( 'exad-post-grid' === $settings['template_type'] ) { 
                include EXAD_TEMPLATES . 'tmpl-post-grid.php';
            } else {
                _e( 'No Contents Found', 'exclusive-addons-elementor' );
            }

        endwhile;
        wp_reset_postdata();
    }

    public static function exad_ajax_pagination() {

        $paged = $_POST['page'];

        $settings = [];
        $settings['exad_post_grid_show_image'] = $_POST['thumbnail'];
        $settings['exad_post_grid_category_default_position'] = true;
        $settings['exad_post_grid_category_position_over_image'] = '-top-right';
        $settings['exad_post_grid_show_category'] = 'yes';
        $settings['exad_post_grid_category_default_position'] = 'no';
        $settings['exad_post_grid_show_user_avatar'] = 'yes';
        $settings['exad_post_grid_show_user_name'] = 'yes';
        $settings['exad_post_grid_show_date'] = 'yes';
        $settings['exad_post_grid_show_date'] = 'yes';
        $settings['exad_post_grid_show_title'] = 'yes';
        $settings['exad_post_grid_title_full'] = 'yes';
        $settings['exad_grid_title_length'] = 20;
        $settings['exad_post_grid_show_read_time'] = 'yes';
        $settings['exad_post_grid_show_comment'] = 'yes';
        $settings['exad_post_grid_show_excerpt'] = 'yes';
        $settings['exad_grid_excerpt_length'] = 20;



        $post_args = array(
            'post_type'        => 'post',
            'posts_per_page'   => 3,
            'paged'            => $paged,
        );

        $posts = new \WP_Query( $post_args );

        $html = '';

        while( $posts->have_posts() ) : $posts->the_post(); 

            $html .= include EXAD_TEMPLATES . 'tmpl-post-grid.php';

        endwhile;
        wp_reset_postdata();

        echo $html;
        // var_dump( $html );
        die();
    }
    

    // public static function exad_ajax_pagination( $settings ){
    // // public static function exad_ajax_pagination( $settings, $prefix ){
    
    //     // $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
    //     // $posts = new \WP_Query( $settings['post_args'] );
    //     $paged = $_POST['page'];

    //     $q = new \WP_Query( array(
    //         'posts_per_page' => 3,
    //         'post_type' => 'post',
    //         'paged' => $paged,
    //         'ignore_sticky_posts' => 0,
    //         // 'post_type'        => $settings[ $prefix . '_type'],
    //         // 'posts_per_page'   => $settings[ $prefix .'_per_page'],
    //         // 'offset'           => $settings[ $prefix . '_offset'],
    //         // 'cat'              => $category_ids,
    //         // 'category_name'    => '',
    //         // 'ignore_sticky_posts' => $exad_ignore_sticky,
    //         // 'orderby'          => 'date',
    //         // 'order'            => $settings[ $prefix . '_order'],
    //         // 'include'          => '',
    //         // 'exclude'          => '',
    //         // 'meta_key'         => '',
    //         // 'meta_value'       => '',
    //         // 'post_mime_type'   => '',
    //         // 'post_parent'      => '',
    //         // 'author'           => $author_ids,
    //         // 'author_name'      => '',
    //         // 'post_status'      => 'publish',
    //         // 'suppress_filters' => true,
    //         // 'tag__in'          => $settings[ $prefix . '_tags'],
    //         // 'post__not_in'     => '',
    //     ) );

    //     // $posts = new \WP_Query( $settings['post_args'] );

    //     $html = '';

    //     // $html .= Helper::exad_get_posts( $settings );

    //     if( $q->have_posts() ){
    //         $posts = new \WP_Query( $settings['post_args'] );

    //     while( $posts->have_posts() ) : $posts->the_post(); 

    //         if ( 'exad-post-timeline' === $settings['template_type'] ) { 
    //             include EXAD_TEMPLATES . 'tmpl-post-timeline.php';
    //         } elseif ( 'exad-post-grid' === $settings['template_type'] ) { 
    //             include EXAD_TEMPLATES . 'tmpl-post-grid.php';
    //         } else {
    //             _e( 'No Contents Found', 'exclusive-addons-elementor' );
    //         }

    //     endwhile;
    //         wp_reset_query();
    //     } else {
    //         echo "No post Found";
    //     }
    //     var_dump( $html );
    //     die();
    // }
}
