<?php

$content = '';

if( 'yes' != $settings['exad_post_grid_show_title_parmalink'] ){
    $parmalink = get_permalink();
    $style_par = '';
} else{
    $parmalink = '';
    $style_par = 'style="pointer-events: none;"';
}

if( 'yes' == $settings['exad_post_grid_show_read_more_btn_new_tab'] ){
    $target = "_blank";
} else{
    $target = "_self";
}

$content .= '<article class="exad-post-grid-three exad-col">';
    $content .= '<div class="exad-post-grid-container image-position-'.esc_attr( $settings['exad_post_grid_image_align'] ).' exad-post-grid-equal-height-'.esc_attr($settings['exad_post_grid_equal_height']).'">';
        do_action('exad_post_grid_each_item_wrapper_before');
        
            $content .= '<figure class="exad-post-grid-thumbnail">';
                $content .= '<a href="'.esc_url( $parmalink ).'" '.$style_par.'>';
                    the_post_thumbnail();
                $content .= '</a>';
                
                
                    $content .= '<ul class="exad-post-grid-category postion-top-right">';
                            Helper::exad_get_categories_for_post();
                    $content .= '</ul>';
                   
            $content .= '</figure>';
      

        $content .= '<div class="exad-post-grid-body">';
            
                $content .= '<ul class="exad-post-grid-category cat-pos">';
                    Helper::exad_get_categories_for_post();
                $content .= '</ul>';
        
                    $content .= '<ul class="exad-post-data show-avatar-'.esc_attr( $settings['exad_post_grid_show_user_avatar'] ).'">';
                        do_action('exad_post_grid_meta_before');
                       
                            $content .= '<li class="exad-author-avatar">';
                                
                                    $content .= get_avatar( get_the_author_meta('email'), '40' );
                                
                                    $content .= '<span class="exad-post-grid-author">';
                                    $content .= ('yes' === $settings['exad_post_grid_show_user_name_tag']) ? esc_html($settings['exad_post_grid_user_name_tag']) : '' ;
                                        $content .= '<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" class="exad-post-grid-author-name">'.get_the_author().'</a>';
                                        $content .= '</span>';
                                
                            $content .= '</li>';
                            
                            $content .= '<li class="exad-post-date">';
                                $content .= '<span>';
                                    $content .= ( 'yes' === $settings['exad_post_grid_show_date_tag'] ) ? esc_html( $settings['exad_post_grid_date_tag'] ) : '' ;
                                    $content .= '<a href="'.esc_url( get_permalink() ).'" class="exad-post-grid-author-date">'.get_the_date(apply_filters( 'exad_post_grid_date_format', get_option( 'date_format' ) ) ).'</a>
                                </span>';                           
                            $content .= '</li>'; 
                       
                        do_action('exad_post_grid_meta_after');      
                    $content .= '</ul>'; 

                    $content .= '<'.esc_attr( $settings['exad_post_grid_title_tag'] ).'>';
                        $content .= '<a href="'.esc_url( $parmalink ).'" '.$style_par.' class="exad-post-grid-title">'.get_the_title().'</a>';
                    $content .= '</'.esc_attr( $settings['exad_post_grid_title_tag'] ).'>';
                
                    $content .= '<'.esc_attr( $settings['exad_post_grid_title_tag'] ).'>';
                        $content .= '<a href="'.esc_url( $parmalink ).'" '.$style_par.' class="exad-post-grid-title">'.wp_trim_words( get_the_title(), $settings['exad_grid_title_length'], '...' ).'</a>';
                    $content .= '</'.esc_attr( $settings['exad_post_grid_title_tag'] ).'>';
                
                $content .= '<ul class="exad-post-grid-time-comment">';
                    
                        $content .= '<li class="exad-post-grid-read-time">'.Helper::exad_reading_time( get_the_content() ).'</li>';
                    
                    $content .= '<li>';
                        $content .= '<a class="exad-post-grid-comment" href="'.get_comments_link().'">'.get_comments_number().get_comments_number_text( ' comment', ' comment', ' comments' ).'</a>';
                    $content .= '</li>';
                    
                $content .= '</ul>';
            
            
            do_action('exad_post_grid_excerpt_wrapper_before');
            if('yes' === $settings['exad_post_grid_show_excerpt']):
                $content .= '<div class="exad-post-grid-description">';
                    $content .= wp_trim_words( get_the_excerpt(), $settings['exad_grid_excerpt_length'], '...' );
                $content .= '</div>';
            endif;
            do_action('exad_post_grid_excerpt_wrapper_after');

            if( !empty($settings['exad_post_grid_read_more_btn_text']) && 'yes' === $settings['exad_post_grid_show_read_more_btn'] ) :
                $content .= '<div class="exad-post-footer"><a href="'.esc_url( get_the_permalink() ).'" target='. $target .' class="read-more">'.esc_html( $settings['exad_post_grid_read_more_btn_text'] ).'</a></div>';
            endif;

            if( 'post_data_bottom' === $settings['exad_post_grid_post_data_position'] ) :
                if( 'yes' === $settings['exad_post_grid_show_user_avatar'] || 'yes' === $settings['exad_post_grid_show_user_name'] || 'yes' === $settings['exad_post_grid_show_date'] ) : 
                    $content .= '<ul class="exad-post-data show-avatar-'.esc_attr( $settings['exad_post_grid_show_user_avatar'] ).'">';
                        do_action('exad_post_grid_meta_before');
                        if( 'yes' === $settings['exad_post_grid_show_user_avatar'] || 'yes' === $settings['exad_post_grid_show_user_name'] ) : 
                            $content .= '<li class="exad-author-avatar">';
                                if('yes' === $settings['exad_post_grid_show_user_avatar']) :
                                    $content .= get_avatar( get_the_author_meta('email'), '40' );
                                endif;

                                if('yes' === $settings['exad_post_grid_show_user_name']) :
                                    $content .= '<span class="exad-post-grid-author">';
                                    $content .= ('yes' === $settings['exad_post_grid_show_user_name_tag']) ? esc_html($settings['exad_post_grid_user_name_tag']) : '' ;
                                        $content .= '<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" class="exad-post-grid-author-name">'.get_the_author().'</a>';
                                        $content .= '</span>';
                                endif;
                            $content .= '</li>';
                        endif;

                        if('yes' === $settings['exad_post_grid_show_date']) :
                            $content .= '<li class="exad-post-date">';
                                $content .= '<span>';
                                    $content .= ( 'yes' === $settings['exad_post_grid_show_date_tag'] ) ? esc_html( $settings['exad_post_grid_date_tag'] ) : '' ;
                                    $content .= '<a href="'.esc_url( get_permalink() ).'" class="exad-post-grid-author-date">'.get_the_date(apply_filters( 'exad_post_grid_date_format', get_option( 'date_format' ) ) ).'</a>
                                </span>';                           
                            $content .= '</li>'; 
                        endif;
                        do_action('exad_post_grid_meta_after');      
                    $content .= '</ul>'; 
                endif;
            endif;

        $content .= '</div>';
        do_action('exad_post_grid_each_item_wrapper_after');
    $content .= '</div>';    
$content .= '</article>';

print wp_kses_post( $content );