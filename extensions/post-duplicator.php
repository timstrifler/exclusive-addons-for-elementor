<?php
namespace ExclusiveAddons\Elementor;

class Post_Duplicator {

    public static function init() {
		add_filter( 'admin_action_exad_duplicate', array( __CLASS__, 'duplicate_post' ) );
        add_filter( 'post_row_actions', array( __CLASS__, 'duplicate_actions' ), 10, 2 );
        add_filter( 'page_row_actions', array( __CLASS__, 'duplicate_actions' ), 10, 2 );
    }

    /**
     * "Ex Duplicator" added to the row action
     *
     * @param array $actions
     * @param WP_Post $post
     * @return array
     */
    public static function duplicate_actions( $actions, $post ) {

        if( current_user_can('edit_posts') ) {
            $duplicate_url = admin_url('admin.php?action=exad_duplicate&post=' . $post->ID );
            $duplicate_url = wp_nonce_url( $duplicate_url, 'exad_duplicator' );
            $actions['exad_duplicate'] = sprintf( '<a href="%s" title="%s">%s</a>', $duplicate_url,  __( $post->post_title, 'exclusive-addons-elementor'), __( 'Ex Duplicator', 'exclusive-addons-elementor') );
        }
        return $actions;
    }
    
    /**
     * Duplicate a post function
     * @return void
     */
    public static function duplicate_post() {

        $nonce = isset( $_REQUEST['_wpnonce'] ) && ! empty( $_REQUEST['_wpnonce'] ) ? $_REQUEST['_wpnonce'] : NULL;
        $post_id = isset( $_REQUEST['post'] ) && ! empty( $_REQUEST['post'] ) ? intval( $_REQUEST['post'] ) : NULL;
        $action = isset( $_REQUEST['action'] ) && ! empty( $_REQUEST['action'] ) ? trim( $_REQUEST['action'] ) : NULL;

        if( is_null( $nonce ) || is_null( $post_id ) || $action !== 'exad_duplicate' ) {
            return;
        }
        if( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'exad_duplicator' ) ) {
            return;
        }

    
        $post = sanitize_post( get_post( $post_id ), 'db' );

        if( is_null( $post ) ) {
            return;
        }

        $current_user = wp_get_current_user();
        $duplicate_post_args = array( 
            'post_author'    => $current_user->ID,
            'post_title'     => $post->post_title,
            'post_content'   => $post->post_content,
            'post_excerpt'   => $post->post_excerpt,
            'post_parent'    => $post->post_parent,
            'post_status'    => 'draft',
            'ping_status'    => $post->ping_status,
            'comment_status' => $post->comment_status,
            'post_password'  => $post->post_password,
            'post_type'      => $post->post_type,
            'to_ping'        => $post->to_ping,
            'menu_order'     => $post->menu_order,
        );
        $duplicated_id = wp_insert_post( $duplicate_post_args );

        if( ! is_wp_error( $duplicated_id ) ) {
            $taxonomies = get_object_taxonomies($post->post_type);
            if( ! empty( $taxonomies ) && is_array( $taxonomies ) ) {
                foreach( $taxonomies as $taxonomy ) {
                    $post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ) );
                    wp_set_object_terms( $duplicated_id, $post_terms, $taxonomy, false );
                }
            }

            global $wpdb;
            $post_meta = $wpdb->get_results( $wpdb->prepare( "SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id = $post_id" ) );
            
            if( ! empty( $post_meta ) && is_array( $post_meta ) ){
                $duplicate_insert_query = $wpdb->prepare( "INSERT INTO $wpdb->postmeta ( post_id, meta_key, meta_value ) VALUES " );
                $value_cells = array();

                foreach( $post_meta as $meta_info ){
                    $meta_key = sanitize_text_field( $meta_info->meta_key );
                    $meta_value = wp_slash( $meta_info->meta_value );
                    $value_cells[] = $wpdb->prepare( '$duplicated_id, %s, %s', $meta_key, $meta_value );
                }

                $duplicate_insert_query .= implode(', ', $value_cells) . ';';
                $wpdb->query( $duplicate_insert_query  );
            } 
        }
        $redirect_url = admin_url( 'edit.php?post_type=' . $post->post_type );
        wp_safe_redirect( $redirect_url );
    }

}
Post_Duplicator::init();