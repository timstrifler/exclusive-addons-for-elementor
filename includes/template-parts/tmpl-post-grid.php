<?php
use \ExclusiveAddons\Elementor\Helper;

$cat_position_over_image = 'default';
if ( 'yes' !== $settings['exad_post_grid_category_default_position'] ) :
    $cat_position_over_image = $settings['exad_post_grid_category_position_over_image'];
endif;

if( isset( $settings['exad_post_grid_equal_height'] ) ){
    $equalHeight = $settings['exad_post_grid_equal_height'];
} else {
    $equalHeight = ' ';
}
if( 'yes' != $settings['exad_post_grid_show_title_parmalink'] ){
    $parmalink = get_permalink();
    $style_par = '';
} else{
    $parmalink = '';
    $style_par = 'style= "pointer-events: none;"';
}
?>

<article class="exad-post-grid-three exad-col <?php echo ('exad-filterable-post' === $settings['template_type'] ) ? ' exad-filterable-item ' . esc_attr( Helper::exad_get_categories_name_for_class()) : ' ' ;?>">
    <div class="exad-post-grid-container image-position-<?php echo esc_attr( $settings['exad_post_grid_image_align'] ); ?> exad-post-grid-equal-height-<?php echo esc_attr($equalHeight); ?>">
        <?php do_action('exad_post_grid_each_item_wrapper_before');
        if( 'yes' === $settings['exad_post_grid_show_image'] && has_post_thumbnail() ) : ?>
            <figure class="exad-post-grid-thumbnail">
                <a href="<?php echo esc_url( $parmalink ); ?>" <?php echo $style_par; ?>>
                    <?php the_post_thumbnail( $settings['post_grid_image_size_size'] ); ?>
                </a>
                
                <?php
                if( 'yes' === $settings['exad_post_grid_show_category'] && 'yes' !== $settings['exad_post_grid_category_default_position'] ) :
                    if('-top-right' === $settings['exad_post_grid_category_position_over_image']) : ?>
                        <ul class="exad-post-grid-category postion-top-right">
                            <?php Helper::exad_get_categories_for_post(); ?>
                        </ul>
                    <?php    
                    endif;
                endif;
                ?>
            </figure>
        <?php endif; ?>

        <div class="exad-post-grid-body">
            <?php    
            if( 'yes' === $settings['exad_post_grid_show_category'] && ( 'yes' === $settings['exad_post_grid_category_default_position'] || '-bottom-left' === $cat_position_over_image ) ) : ?>
                <ul class="exad-post-grid-category cat-pos<?php echo esc_attr( $cat_position_over_image ); ?>">
                    <?php Helper::exad_get_categories_for_post(); ?>
                </ul>
            <?php endif;

            if( 'post_data_middle' === $settings['exad_post_grid_post_data_position'] ) :
                if( 'yes' === $settings['exad_post_grid_show_user_avatar'] || 'yes' === $settings['exad_post_grid_show_user_name'] || 'yes' === $settings['exad_post_grid_show_date'] ) : ?>
                    <ul class="exad-post-data show-avatar-<?php echo esc_attr( $settings['exad_post_grid_show_user_avatar'] ); ?>">
                        <?php do_action('exad_post_grid_meta_before'); ?>
                        <?php
                        if( 'yes' === $settings['exad_post_grid_show_user_avatar'] || 'yes' === $settings['exad_post_grid_show_user_name'] ) : ?>
                            <li class="exad-author-avatar">
                            <?php
                                if('yes' === $settings['exad_post_grid_show_user_avatar']) :
                                    echo get_avatar( get_the_author_meta('email'), '40' );
                                endif;

                                if('yes' === $settings['exad_post_grid_show_user_name']) : ?>
                                    <span class="exad-post-grid-author">
                                    <?php
                                    echo ('yes' === $settings['exad_post_grid_show_user_name_tag']) ? esc_html($settings['exad_post_grid_user_name_tag']) : ''; ?>
                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="exad-post-grid-author-name"><?php echo get_the_author(); ?></a>
                                    </span>
                                <?php endif; ?>
                            </li>
                        <?php
                        endif;

                        if('yes' === $settings['exad_post_grid_show_date']) : ?>
                            <li class="exad-post-date">
                                <span>
                                    <?php echo ( 'yes' === $settings['exad_post_grid_show_date_tag'] ) ? esc_html( $settings['exad_post_grid_date_tag'] ) : '' ; ?>
                                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="exad-post-grid-author-date"><?php echo get_the_date(apply_filters( 'exad_post_grid_date_format', get_option( 'date_format' ) ) ); ?></a>
                                </span>                          
                            </li> 
                        <?php
                        endif;
                        do_action('exad_post_grid_meta_after');
                        ?>   
                    </ul>
                <?php     
                endif;
            endif;

            if('yes' === $settings['exad_post_grid_show_title']) :
                if('yes' === $settings['exad_post_grid_title_full']) : ?>
                    <h3>
                        <a href="<?php echo esc_url( $parmalink ); ?>" <?php echo $style_par; ?> class="exad-post-grid-title"><?php echo get_the_title(); ?></a>
                    </h3>
                <?php else : ?>
                    <h3>
                        <a href="<?php echo esc_url( $parmalink ); ?>" <?php echo $style_par; ?> class="exad-post-grid-title"><?php echo wp_trim_words( get_the_title(), $settings['exad_grid_title_length'], '...' ); ?></a>
                    </h3>
                <?php
                endif;
            endif;

            if( 'yes' === $settings['exad_post_grid_show_read_time'] || 'yes' === $settings['exad_post_grid_show_comment'] ) : ?>
                <ul class="exad-post-grid-time-comment">
                <?php 
                    if( 'yes' === $settings['exad_post_grid_show_read_time'] ) : ?>
                        <li class="exad-post-grid-read-time"><?php echo Helper::exad_reading_time( get_the_content() ); ?></li>
                    <?php
                    endif;

                    if( 'yes' === $settings['exad_post_grid_show_comment'] ) : ?>
                    <li>
                        <a class="exad-post-grid-comment" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number().get_comments_number_text( ' comment', ' comment', ' comments' ); ?></a>
                    </li>
                    <?php endif; ?>
                </ul>
            <?php 
            endif;
            
            do_action('exad_post_grid_excerpt_wrapper_before');
            if('yes' === $settings['exad_post_grid_show_excerpt']) : ?>
                <div class="exad-post-grid-description">
                    <?php echo wp_trim_words( get_the_excerpt(), $settings['exad_grid_excerpt_length'], '...' ); ?>
                </div>
            <?php
            endif;
            do_action('exad_post_grid_excerpt_wrapper_after');

            if( ! empty( $settings['exad_post_grid_read_more_btn_text'] ) && 'yes' === $settings[ 'exad_post_grid_show_read_more_btn' ] ) : ?>
                <div class="exad-post-footer"><a href="<?php echo esc_url( get_the_permalink() ); ?>" class="read-more"><?php echo esc_html( $settings['exad_post_grid_read_more_btn_text'] ); ?></a></div>
            <?php
            endif;

            if( 'post_data_bottom' === $settings['exad_post_grid_post_data_position'] ) :
                if( 'yes' === $settings['exad_post_grid_show_user_avatar'] || 'yes' === $settings['exad_post_grid_show_user_name'] || 'yes' === $settings['exad_post_grid_show_date'] ) : ?>
                    <ul class="exad-post-data show-avatar-<?php echo esc_attr( $settings['exad_post_grid_show_user_avatar'] ); ?>">
                    <?php 
                        do_action('exad_post_grid_meta_before');
                        if( 'yes' === $settings['exad_post_grid_show_user_avatar'] || 'yes' === $settings['exad_post_grid_show_user_name'] ) : ?>
                            <li class="exad-author-avatar">
                            <?php 
                                if('yes' === $settings['exad_post_grid_show_user_avatar']) :
                                    echo get_avatar( get_the_author_meta('email'), '40' );
                                endif;

                                if('yes' === $settings['exad_post_grid_show_user_name']) : ?>
                                    <span class="exad-post-grid-author">
                                    <?php echo ('yes' === $settings['exad_post_grid_show_user_name_tag']) ? esc_html($settings['exad_post_grid_user_name_tag']) : '' ; ?>
                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="exad-post-grid-author-name"><?php echo get_the_author(); ?></a>
                                    </span>
                                <?php endif; ?>
                            </li>
                        <?php     
                        endif;

                        if('yes' === $settings['exad_post_grid_show_date']) : ?>
                            <li class="exad-post-date">
                                <span>
                                    <?php echo ( 'yes' === $settings['exad_post_grid_show_date_tag'] ) ? esc_html( $settings['exad_post_grid_date_tag'] ) : '' ; ?>
                                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="exad-post-grid-author-date"><?php echo get_the_date(apply_filters( 'exad_post_grid_date_format', get_option( 'date_format' ) ) ); ?></a>
                                </span>                          
                            </li>
                        <?php    
                        endif;
                        do_action('exad_post_grid_meta_after'); ?>   
                    </ul>
                <?php    
                endif;
            endif; 
            ?>

        </div>
        <?php do_action('exad_post_grid_each_item_wrapper_after'); ?>
    </div>
</article>