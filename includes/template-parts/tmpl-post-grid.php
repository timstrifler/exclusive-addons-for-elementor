<article class="exad-post-grid-three exad-col">
    <div class="exad-post-grid-container image-position-<?php echo esc_attr($settings['exad_post_grid_image_align']); ?>">
        <?php 
            if( 'yes' == $settings['exad_post_grid_show_image'] && has_post_thumbnail() ) :
                echo '<figure class="exad-post-grid-thumbnail">';
                    echo '<a href="'.esc_url( get_permalink() ).'">';
                        the_post_thumbnail();
                    echo '</a>';
                    if( 'yes' == $settings['exad_post_grid_show_category'] && 'yes' != $settings['exad_post_grid_category_default_position'] ) :
                        echo '<ul class="exad-post-grid-category postion'.esc_attr($settings['exad_post_grid_category_position_over_image']).'">';
                            Elementor\Exad_Helper::exad_get_categories_for_post();
                        echo '</ul>';
                    endif;
                echo '</figure>';
            endif;
        ?>
        <div class="exad-post-grid-body"> 
            <?php
                if( 'yes' == $settings['exad_post_grid_show_category'] && 'yes' == $settings['exad_post_grid_category_default_position'] ) :
                    echo '<ul class="exad-post-grid-category">';
                        Elementor\Exad_Helper::exad_get_categories_for_post();
                    echo '</ul>';
                endif;
            ?>
            <ul class="exad-post-data">
                <?php 
                    echo '<li class="exad-author-avatar">';
                        if('yes' == $settings['exad_post_grid_show_user_avatar']) :
                            echo get_avatar( get_the_author_meta('email'), '40' );
                        endif;

                        echo '<span class="exad-post-grid-author">'.__('By: ', 'exclusive-addons-elementor' ).'<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" class="exad-post-grid-author-name">'.get_the_author().'</a></span>';
                    echo '</li>';
                ?>
                <li class="exad-post-date">
                    <span><?php echo __('Date: ', 'exclusive-addons-elementor'); ?><a href="<?php echo esc_url( get_permalink() ); ?>" class="exad-post-grid-author-date"><?php echo get_the_date('jS M Y'); ?></a></span>
                </li>                
            </ul>
            <h3>
                <a href="<?php echo esc_url( get_permalink() ); ?>" class="exad-post-grid-title"><?php the_title(); ?></a>
            </h3>
            <ul class="exad-post-grid-time-comment">
                <?php
                    if( 'yes' == $settings['exad_post_grid_show_read_time'] ) :
                        echo '<li class="exad-post-grid-read-time">'.Elementor\Exad_Helper::exad_reading_time( get_the_content() ).'</li>';
                    endif;
                    if( 'yes' == $settings['exad_post_grid_show_comment'] ) :
                    echo '<li>';
                        echo '<a href="'.get_comments_link().'">'.get_comments_number().get_comments_number_text( ' comment', ' comment', ' comments' ).'</a>';
                    echo '</li>';
                    endif;
                ?>
            </ul>
            <p class="exad-post-grid-description"><?php echo Elementor\Exad_Helper::exad_get_post_excerpt( get_the_ID(), $settings['exad_grid_excerpt_length'] ); ?></p>
            <?php
                if( !empty($settings['exad_post_grid_read_more_btn_text']) && $settings['exad_post_grid_show_read_more_btn'] == 'yes' ) :
                    echo '<div class="exad-post-footer"><a href="'. esc_url( get_the_permalink() ) .'" class="read-more">'.esc_html( $settings['exad_post_grid_read_more_btn_text'] ).'</a></div>';
                endif;
            ?>            
        </div>
    </div>    
</article>