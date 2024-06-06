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
			
            // Support WooCommerce Product
            if ( $post->post_type === 'product' 
                && has_action( 'admin_action_duplicate_product' ) ) {
				
                $duplicate_url = wp_nonce_url( admin_url( 'edit.php?post_type=product&action=duplicate_product&amp;post=' . $post->ID ), 'woocommerce-duplicate-product_' . $post->ID );
				
            }
			
            $actions['exad_duplicate'] = sprintf( '<a href="%s" title="%s">%s</a>', $duplicate_url,  __( $post->post_title, 'exclusive-addons-elementor'), __( 'Ex Duplicator', 'exclusive-addons-elementor') );
        }
        return $actions;
    }
    
    /**
     * Duplicate a post function
     * @return void
     */
    public static function duplicate_post() {
		
		if ( ! isset( $_REQUEST['_wpnonce'] ) && empty( $_REQUEST['_wpnonce'] ) ) {
		
			return;
		}
		
		$nonce = sanitize_text_field( wp_unslash( $_REQUEST['_wpnonce'] ) );

        if ( ! wp_verify_nonce( $nonce, 'exad_duplicator' ) ) {
            return;
        }
		
        $post_id = isset( $_REQUEST['post'] ) && ! empty( $_REQUEST['post'] ) ? intval( sanitize_text_field( wp_unslash( $_REQUEST['post'] ) ) ) : NULL;
		
        $action = isset( $_REQUEST['action'] ) && ! empty( $_REQUEST['action'] ) ? trim( sanitize_text_field( wp_unslash( $_REQUEST['action'] ) ) ) : NULL;

        if( is_null( $nonce ) || is_null( $post_id ) || $action !== 'exad_duplicate' ) {
            return;
        }

    
        $post = sanitize_post( get_post( $post_id ), 'db' );

        if( is_null( $post ) ) {
            return;
        }
		
        if ( ! current_user_can( 'edit_post', $post->ID ) ) {
			
            wp_die( esc_html__( 'Sorry, you are not allowed to duplicate this post.' ) );
        }

        $current_user = wp_get_current_user();
		
		/*
		 * new post data array
		 */
        $duplicate_post_args = array( 
            'post_author'    => $current_user->ID,
            'post_title'     => $post->post_title,
            'post_content'   => $post->post_content,
            'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
            'post_parent'    => $post->post_parent,
            'post_status'    => 'draft',
            'ping_status'    => $post->ping_status,
            'comment_status' => $post->comment_status,
            'post_password'  => $post->post_password,
            'post_type'      => $post->post_type,
            'menu_order'     => $post->menu_order,
            'post_content_filtered' => $post->post_content_filtered,
            'post_category'         => $post->post_category,
            'tags_input'            => $post->tags_input,
            'tax_input'             => $post->tax_input,
            'page_template'         => $post->page_template
        );
		
		/*
		 * insert the post by wp_insert_post() function
		 */
        $duplicated_id = wp_insert_post( $duplicate_post_args, true );

        if( is_wp_error( $duplicated_id ) || empty( $duplicated_id ) ) {
			
            add_settings_error(
                'exad_duplicate',
                'exad_duplicate',
                esc_html__( 'Unable to duplicate ' . $post->post_name . '.' ),
                'error'
            );
			
        } else {
			
            $format = get_post_format( $post->ID );
            set_post_format( $duplicated_id, $format );
			
            $taxonomies = get_object_taxonomies($post->post_type);
            if( ! empty( $taxonomies ) && is_array( $taxonomies ) ) {
                foreach( $taxonomies as $taxonomy ) {
                    $post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ) );
                    wp_set_object_terms( $duplicated_id, $post_terms, $taxonomy, false );
                }
            }
			
            self::duplicate_post_meta( $duplicated_id, $post->ID );	
        }
		
        $redirect_url = admin_url( 'edit.php?post_type=' . $post->post_type );
		
        wp_safe_redirect( $redirect_url );
    }
	
	
	protected static function duplicate_post_meta( $duplicated_id, $post_id ) {
		
		$post_custom_keys = get_post_custom_keys( $post_id );
		
		if ( empty( $post_custom_keys ) || !is_array( $post_custom_keys ) ) {
			
			return;
		}
		
		$avoid_keys = array(
			'_edit_lock',
			'_edit_last'
		);
		
		$meta_keys = array_diff( $post_custom_keys, $avoid_keys );
		
		foreach ( $meta_keys as $meta_key ) {
			
			$meta_values = get_post_custom_values( $meta_key, $post_id );
			
			delete_post_meta( $duplicated_id, $meta_key );
			
			foreach ( $meta_values as $meta_value ) {
				
				add_post_meta( $duplicated_id, $meta_key, maybe_unserialize( $meta_value ) );
			}
		}
	}
}
Post_Duplicator::init();