<?php
/**
 * Get Post Data
 * @param  array $args
 * @return array
 */
function exad_get_post_data( $args ) {
    $defaults = array(
        'posts_per_page'   => 5,
        'offset'           => 0,
        'category'         => '',
        'category_name'    => '',
        'orderby'          => 'date',
        'order'            => 'DESC',
        'include'          => '',
        'exclude'          => '',
        'meta_key'         => '',
        'meta_value'       => '',
        'post_type'        => 'post',
        'post_mime_type'   => '',
        'post_parent'      => '',
        'author'	       => '',
        'author_name'	   => '',
        'post_status'      => 'publish',
        'suppress_filters' => true,
        'tag__in'          => '',
        'post__not_in'     => '',
    );

    $atts = wp_parse_args( $args, $defaults );

    return get_posts( $atts );
}


/*
* Get list of Post Types
* 
*/
function exad_get_post_types() {
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
 * All Author with published post
 * @return array
 */
function exad_get_authors() {
    $user_query = new WP_User_Query(
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
 * Return the Posts from Database
 *
 * @return string of an html markup with AJAX call.
 * @return array of content and found posts count without AJAX call.
 */

function exad_get_posts( $settings ) {

    $author_ids = implode( ", " , $settings['exad_get_timeline_authors'] );

    $post_args = array(
            'post_type'        => $settings['exad_post_timeline_type'],
            'posts_per_page'   => $settings['exad_posts_per_page'],
            'offset'           => $settings['exad_offset'],
            'category'         => '',
            'category_name'    => '',
            'ignore_sticky_posts' => true,
            'orderby'          => 'date',
            'order'            => $settings['exad_order'],
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
            'tag__in'          => '',
            'post__not_in'     => '',
        );
    
    $posts = new WP_Query( $post_args );


    //ob_start();

    while( $posts->have_posts() ) : $posts->the_post(); 

        if ( $settings['template_type'] == 'exad-post-timeline' ) { 
            include EXAD_TEMPLATES . 'tmpl-post-timeline.php';
        } else {
            echo "No Contents Found";
        }


    endwhile;

    //$return['content'] = ob_get_clean();
    wp_reset_postdata();
}
    