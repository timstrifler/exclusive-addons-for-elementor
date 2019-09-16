<?php
    $cat_position_over_image = 'default';
    if ( 'yes' != $settings['exad_post_carousel_category_default_position'] ) {
        $cat_position_over_image = $settings['exad_post_carousel_category_position_over_image'];
    }
    echo '<article class="exad-post-grid-three">';
        echo '<div class="exad-post-grid-container image-position-'.esc_attr($settings['exad_post_carousel_image_align']).'">';
            if( 'yes' == $settings['exad_post_carousel_show_image'] && has_post_thumbnail() ) :
                echo '<figure class="exad-post-grid-thumbnail">';
                    echo '<a href="'.esc_url( get_permalink() ).'">';
                        the_post_thumbnail();
                    echo '</a>';
                    
                    if( 'yes' == $settings['exad_post_carousel_show_category'] && 'yes' != $settings['exad_post_carousel_category_default_position'] ) :
                        if('-top-right' == $settings['exad_post_carousel_category_position_over_image']):
                            echo '<ul class="exad-post-grid-category postion-top-right">';
                                Elementor\Exad_Helper::exad_get_categories_for_post();
                            echo '</ul>';
                        endif;
                    endif;
                echo '</figure>';
            endif;

            echo '<div class="exad-post-grid-body">';
                if('yes' == $settings['exad_post_carousel_show_category'] && ('yes' == $settings['exad_post_carousel_category_default_position'] || '-bottom-left' == $cat_position_over_image )) :
                    echo '<ul class="exad-post-grid-category cat-pos'.esc_attr($cat_position_over_image).'">';
                        Elementor\Exad_Helper::exad_get_categories_for_post();
                    echo '</ul>';
                endif;

                if( 'yes' == $settings['exad_post_carousel_show_user_avatar'] || 'yes' == $settings['exad_post_carousel_show_user_name'] || 'yes' == $settings['exad_post_carousel_show_date'] ) : 
                    echo '<ul class="exad-post-data show-avatar-'.esc_attr($settings['exad_post_carousel_show_user_avatar']).'">';
                            if( 'yes' == $settings['exad_post_carousel_show_user_avatar'] || 'yes' == $settings['exad_post_carousel_show_user_name'] ) : 
                                echo '<li class="exad-author-avatar">';
                                    if('yes' == $settings['exad_post_carousel_show_user_avatar']) :
                                        echo get_avatar( get_the_author_meta('email'), '40' );
                                    endif;

                                    if('yes' == $settings['exad_post_carousel_show_user_name']) :
                                        echo '<span class="exad-post-grid-author">';
                                        echo ('yes' == $settings['exad_post_carousel_show_user_name_tag']) ? esc_html($settings['exad_post_grid_user_name_tag']) : '' ;
                                            echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" class="exad-post-grid-author-name">'.get_the_author().'</a>';
                                            echo '</span>';
                                    endif;
                                echo '</li>';
                            endif;

                            if('yes' == $settings['exad_post_carousel_show_date']) :
                                echo '<li class="exad-post-date">';
                                    echo '<span>';
                                        echo ('yes' == $settings['exad_post_carousel_show_date_tag']) ? esc_html($settings['exad_post_grid_user_name_tag']) : '' ;
                                        echo '<a href="'.esc_url( get_permalink() ).'" class="exad-post-grid-author-date">'.get_the_date('jS M Y').'</a>
                                    </span>';                           
                                echo '</li>'; 
                            endif;       
                    echo '</ul>'; 
                endif;

                if('yes' == $settings['exad_post_carousel_show_title']):
                    echo '<h3>';
                        echo '<a href="'.esc_url( get_permalink() ).'" class="exad-post-grid-title">'.get_the_title().'</a>';
                    echo '</h3>';
                endif;

                if( 'yes' == $settings['exad_post_carousel_show_read_time'] || 'yes' == $settings['exad_post_carousel_show_comment'] ) : 
                    echo '<ul class="exad-post-grid-time-comment">';
                        if( 'yes' == $settings['exad_post_carousel_show_read_time'] ) :
                            echo '<li class="exad-post-grid-read-time">'.Elementor\Exad_Helper::exad_reading_time( get_the_content() ).'</li>';
                        endif;

                        if( 'yes' == $settings['exad_post_carousel_show_comment'] ) :
                        echo '<li>';
                            echo '<a class="exad-post-grid-comment" href="'.get_comments_link().'">'.get_comments_number().get_comments_number_text( ' comment', ' comment', ' comments' ).'</a>';
                        echo '</li>';
                        endif;
                    echo '</ul>';
                endif;
                
                if('yes' == $settings['exad_post_carousel_show_excerpt']):
                    echo '<p class="exad-post-grid-description">'.Elementor\Exad_Helper::exad_get_post_excerpt( get_the_ID(), wp_kses_post( $settings['exad_carousel_excerpt_length'] ) ).'</p>';
                endif;

                if( !empty($settings['exad_post_carousel_read_more_btn_text']) && $settings['exad_post_carousel_show_read_more_btn'] == 'yes' ) :
                    echo '<div class="exad-post-footer"><a href="'. esc_url( get_the_permalink() ) .'" class="read-more">'.esc_html( $settings['exad_post_carousel_read_more_btn_text'] ).'</a></div>';
                endif;
            echo '</div>';
        echo '</div>';    
    echo '</article>';