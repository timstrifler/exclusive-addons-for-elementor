<?php
if( 'yes' != $settings['exad_post_grid_show_title_parmalink'] ){
    $parmalink = get_permalink();
    $style_par = '';
} else{
    $parmalink = '';
    $style_par = 'style= "pointer-events: none;"';
}

echo '<article class="exad-post-grid-three exad-col">';
    echo '<div class="exad-post-grid-container image-position-'.esc_attr( $settings['exad_post_grid_image_align'] ).' exad-post-grid-equal-height-'.esc_attr($settings['exad_post_grid_equal_height']).'">';
        do_action('exad_post_grid_each_item_wrapper_before');
        
            echo '<figure class="exad-post-grid-thumbnail">';
                echo '<a href="'.esc_url( $parmalink ).'" '.$style_par.'>';
                    the_post_thumbnail();
                echo '</a>';
                
                
                    echo '<ul class="exad-post-grid-category postion-top-right">';
                            Helper::exad_get_categories_for_post();
                    echo '</ul>';
                   
            echo '</figure>';
      

        echo '<div class="exad-post-grid-body">';
            
                echo '<ul class="exad-post-grid-category cat-pos">';
                    Helper::exad_get_categories_for_post();
                echo '</ul>';
        
                    echo '<ul class="exad-post-data show-avatar-'.esc_attr( $settings['exad_post_grid_show_user_avatar'] ).'">';
                        do_action('exad_post_grid_meta_before');
                       
                            echo '<li class="exad-author-avatar">';
                                
                                    echo get_avatar( get_the_author_meta('email'), '40' );
                                
                                    echo '<span class="exad-post-grid-author">';
                                    echo ('yes' === $settings['exad_post_grid_show_user_name_tag']) ? esc_html($settings['exad_post_grid_user_name_tag']) : '' ;
                                        echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" class="exad-post-grid-author-name">'.get_the_author().'</a>';
                                        echo '</span>';
                                
                            echo '</li>';
                            
                            echo '<li class="exad-post-date">';
                                echo '<span>';
                                    echo ( 'yes' === $settings['exad_post_grid_show_date_tag'] ) ? esc_html( $settings['exad_post_grid_date_tag'] ) : '' ;
                                    echo '<a href="'.esc_url( get_permalink() ).'" class="exad-post-grid-author-date">'.get_the_date(apply_filters( 'exad_post_grid_date_format', get_option( 'date_format' ) ) ).'</a>
                                </span>';                           
                            echo '</li>'; 
                       
                        do_action('exad_post_grid_meta_after');      
                    echo '</ul>'; 

                    echo '<h3>';
                        echo '<a href="'.esc_url( $parmalink ).'" '.$style_par.' class="exad-post-grid-title">'.get_the_title().'</a>';
                    echo '</h3>';
                
                    echo '<h3>';
                        echo '<a href="'.esc_url( $parmalink ).'" '.$style_par.' class="exad-post-grid-title">'.wp_trim_words( get_the_title(), $settings['exad_grid_title_length'], '...' ).'</a>';
                    echo '</h3>';
                
                echo '<ul class="exad-post-grid-time-comment">';
                    
                        echo '<li class="exad-post-grid-read-time">'.Helper::exad_reading_time( get_the_content() ).'</li>';
                    
                    echo '<li>';
                        echo '<a class="exad-post-grid-comment" href="'.get_comments_link().'">'.get_comments_number().get_comments_number_text( ' comment', ' comment', ' comments' ).'</a>';
                    echo '</li>';
                    
                echo '</ul>';
            
            
            do_action('exad_post_grid_excerpt_wrapper_before');
            if('yes' === $settings['exad_post_grid_show_excerpt']):
                echo '<div class="exad-post-grid-description">';
                    echo wp_trim_words( get_the_excerpt(), $settings['exad_grid_excerpt_length'], '...' );
                echo '</div>';
            endif;
            do_action('exad_post_grid_excerpt_wrapper_after');

            if( !empty($settings['exad_post_grid_read_more_btn_text']) && 'yes' === $settings['exad_post_grid_show_read_more_btn'] ) :
                echo '<div class="exad-post-footer"><a href="'.esc_url( get_the_permalink() ).'" class="read-more">'.esc_html( $settings['exad_post_grid_read_more_btn_text'] ).'</a></div>';
            endif;

            if( 'post_data_bottom' === $settings['exad_post_grid_post_data_position'] ) :
                if( 'yes' === $settings['exad_post_grid_show_user_avatar'] || 'yes' === $settings['exad_post_grid_show_user_name'] || 'yes' === $settings['exad_post_grid_show_date'] ) : 
                    echo '<ul class="exad-post-data show-avatar-'.esc_attr( $settings['exad_post_grid_show_user_avatar'] ).'">';
                        do_action('exad_post_grid_meta_before');
                        if( 'yes' === $settings['exad_post_grid_show_user_avatar'] || 'yes' === $settings['exad_post_grid_show_user_name'] ) : 
                            echo '<li class="exad-author-avatar">';
                                if('yes' === $settings['exad_post_grid_show_user_avatar']) :
                                    echo get_avatar( get_the_author_meta('email'), '40' );
                                endif;

                                if('yes' === $settings['exad_post_grid_show_user_name']) :
                                    echo '<span class="exad-post-grid-author">';
                                    echo ('yes' === $settings['exad_post_grid_show_user_name_tag']) ? esc_html($settings['exad_post_grid_user_name_tag']) : '' ;
                                        echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" class="exad-post-grid-author-name">'.get_the_author().'</a>';
                                        echo '</span>';
                                endif;
                            echo '</li>';
                        endif;

                        if('yes' === $settings['exad_post_grid_show_date']) :
                            echo '<li class="exad-post-date">';
                                echo '<span>';
                                    echo ( 'yes' === $settings['exad_post_grid_show_date_tag'] ) ? esc_html( $settings['exad_post_grid_date_tag'] ) : '' ;
                                    echo '<a href="'.esc_url( get_permalink() ).'" class="exad-post-grid-author-date">'.get_the_date(apply_filters( 'exad_post_grid_date_format', get_option( 'date_format' ) ) ).'</a>
                                </span>';                           
                            echo '</li>'; 
                        endif;
                        do_action('exad_post_grid_meta_after');      
                    echo '</ul>'; 
                endif;
            endif;

        echo '</div>';
        do_action('exad_post_grid_each_item_wrapper_after');
    echo '</div>';    
echo '</article>';