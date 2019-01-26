<?php


/**
 *
 * Get list of Post Types
 * @return array
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
 *
 * List all categories 
 * @return array
 */

function exad_get_all_categories() {
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

function exad_get_all_tags() {
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
 * Post Excerpt based on ID and Excerpt Length
 * @param  int $post_id
 * @param  int $length
 * @return string
 *
 */
function exad_get_post_excerpt( $post_id, $length ){
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
 * Return the Posts from Database
 *
 * @return string of an html markup with AJAX call.
 * @return array of content and found posts count without AJAX call.
 */

function exad_get_posts( $settings ) {

    $author_ids = implode( ", ", $settings['exad_get_timeline_authors'] );

    $category_ids = implode( ", ", $settings['exad_get_timeline_categories'] );

    if ( 'yes' === $settings['exad_post_timeline_ignore_sticky'] ) {
        $exad_ignore_sticky = true;
    } else {
        $exad_ignore_sticky = false;
    }

    $post_args = array(
            'post_type'        => $settings['exad_post_timeline_type'],
            'posts_per_page'   => $settings['exad_posts_per_page'],
            'offset'           => $settings['exad_offset'],
            'cat'              => $category_ids,
            'category_name'    => '',
            'ignore_sticky_posts' => $exad_ignore_sticky,
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
            'tag__in'          => $settings['exad_get_timeline_tags'],
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
    