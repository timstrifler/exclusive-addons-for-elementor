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
			
            $taxonomies = get_object_taxonomies($post->post_type);
            if( ! empty( $taxonomies ) && is_array( $taxonomies ) ) {
                foreach( $taxonomies as $taxonomy ) {
                    $post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ) );
                    wp_set_object_terms( $duplicated_id, $post_terms, $taxonomy, false );
                }
            }

            $post_meta = get_post_meta( $post_id );
			
            if( ! empty( $post_meta ) && is_array( $post_meta ) ){

                foreach( $post_meta as $meta_key => $meta_value ) {
					
					update_post_meta( $duplicated_id, $meta_key, maybe_unserialize( $meta_value ) );
                }
            } 
			
			
			update_post_meta( $duplicated_id, '_wp_page_template', 'elementor_canvas' );

			update_post_meta( $duplicated_id, '_elementor_edit_mode', 'builder' );

			update_post_meta( $duplicated_id, '_elementor_template_type', 'wp-page');
			update_post_meta( $duplicated_id, '_elementor_version', ELEMENTOR_VERSION);
			
			if ( defined( 'ELEMENTOR_PRO_VERSION' ) ) {
				
				update_post_meta( $duplicated_id, '_elementor_pro_version', ELEMENTOR_PRO_VERSION );
			}
			
			update_post_meta( $duplicated_id, '_elementor_css', '' );
			
			$settings = get_post_meta( $post_id, '_elementor_page_settings', true );
			$data = json_decode(get_post_meta( $post_id, '_elementor_data', true), true );
			$assets = get_post_meta( $post_id, '_elementor_page_assets', true );
			$controls = get_post_meta( $post_id, '_elementor_controls_usage', true );
			
			update_post_meta( $duplicated_id, '_elementor_page_settings', $settings );
			update_post_meta( $duplicated_id, '_elementor_data', $data );
			update_post_meta( $duplicated_id, '_elementor_page_assets', $assets );
			update_post_meta( $duplicated_id, '_elementor_controls_usage', $controls );
			
            $user_id = $current_user->ID;
            $now  = time();
            $lock = "$now:$user_id";
			
            update_post_meta( $duplicated_id, '_edit_lock', $lock );
        }
        $redirect_url = admin_url( 'edit.php?post_type=' . $post->post_type );
        wp_safe_redirect( $redirect_url );
    }

}
Post_Duplicator::init();