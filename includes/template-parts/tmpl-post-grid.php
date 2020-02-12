<?php
use \ExclusiveAddons\Elementor\Helper;

$cat_position_over_image = 'default';
if ( 'yes' !== $settings['exad_post_grid_category_default_position'] ) :
    $cat_position_over_image = $settings['exad_post_grid_category_position_over_image'];
endif;

echo '<article class="exad-post-grid-three exad-col">';
    echo '<div class="exad-post-grid-container image-position-'.esc_attr( $settings['exad_post_grid_image_align'] ).'">';
        do_action('exad_post_grid_each_item_wrapper_before');
        if( 'yes' === $settings['exad_post_grid_show_image'] && has_post_thumbnail() ) :
            echo '<figure class="exad-post-grid-thumbnail">';
                echo '<a href="'.esc_url( get_permalink() ).'">';
                    the_post_thumbnail();
                echo '</a>';
                
                if( 'yes' === $settings['exad_post_grid_show_category'] && 'yes' !== $settings['exad_post_grid_category_default_position'] ) :
                    if('-top-right' === $settings['exad_post_grid_category_position_over_image']) :
                        echo '<ul class="exad-post-grid-category postion-top-right">';
                            Helper::exad_get_categories_for_post();
                        echo '</ul>';
                    endif;
                endif;
            echo '</figure>';
        endif;

        echo '<div class="exad-post-grid-body">';
            if( 'yes' === $settings['exad_post_grid_show_category'] && ( 'yes' === $settings['exad_post_grid_category_default_position'] || '-bottom-left' === $cat_position_over_image ) ) :
                echo '<ul class="exad-post-grid-category cat-pos'.esc_attr( $cat_position_over_image ).'">';
                    Helper::exad_get_categories_for_post();
                echo '</ul>';
            endif;

            if( 'post_data_middle' === $settings['exad_post_grid_post_data_position'] ) :
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
                                    echo '<a href="'.esc_url( get_permalink() ).'" class="exad-post-grid-author-date">'.get_the_date(apply_filters( 'exad_post_grid_date_format', 'jS M Y' ) ).'</a>
                                </span>';                           
                            echo '</li>'; 
                        endif;
                        do_action('exad_post_grid_meta_after');      
                    echo '</ul>'; 
                endif;
            endif;

            if('yes' === $settings['exad_post_grid_show_title']) :
                if('yes' === $settings['exad_post_grid_title_full']) :
                    echo '<h3>';
                        echo '<a href="'.esc_url( get_permalink() ).'" class="exad-post-grid-title">'.get_the_title().'</a>';
                    echo '</h3>';
                else :
                    echo '<h3>';
                        echo '<a href="'.esc_url( get_permalink() ).'" class="exad-post-grid-title">'.wp_trim_words( get_the_title(), $settings['exad_grid_title_length'], '...' ).'</a>';
                    echo '</h3>';
                endif;
            endif;

            if( 'yes' === $settings['exad_post_grid_show_read_time'] || 'yes' === $settings['exad_post_grid_show_comment'] ) : 
                echo '<ul class="exad-post-grid-time-comment">';
                    if( 'yes' === $settings['exad_post_grid_show_read_time'] ) :
                        echo '<li class="exad-post-grid-read-time">'.Helper::exad_reading_time( get_the_content() ).'</li>';
                    endif;

                    if( 'yes' === $settings['exad_post_grid_show_comment'] ) :
                    echo '<li>';
                        echo '<a class="exad-post-grid-comment" href="'.get_comments_link().'">'.get_comments_number().get_comments_number_text( ' comment', ' comment', ' comments' ).'</a>';
                    echo '</li>';
                    endif;
                echo '</ul>';
            endif;
            
            do_action('exad_post_grid_excerpt_wrapper_before');
            if('yes' === $settings['exad_post_grid_show_excerpt']):
                echo '<p class="exad-post-grid-description">'.Helper::exad_get_post_excerpt( get_the_ID(), wp_kses_post( $settings['exad_grid_excerpt_length'] ) ).'</p>';
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
                                    echo '<a href="'.esc_url( get_permalink() ).'" class="exad-post-grid-author-date">'.get_the_date(apply_filters( 'exad_post_grid_date_format', 'jS M Y' ) ).'</a>
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