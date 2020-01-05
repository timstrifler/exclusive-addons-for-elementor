<?php 
use \Elementor\Icons_Manager;
use \ExclusiveAddons\Elementor\Helper;

echo '<div class="exad-post-timeline-item">';
    if(!empty($settings['exad_post_timeline_divider_icon']['value'])){
        echo '<span class="exad-post-timeline-icon">';
            Icons_Manager::render_icon( $settings['exad_post_timeline_divider_icon'], [ 'aria-hidden' => 'true' ] );
        echo '</span>';                                 
    }

    echo '<div class="exad-post-timeline-content">';
        if( has_post_thumbnail() ) :
            echo '<a href="'.esc_url( get_permalink() ).'">';
                the_post_thumbnail();
            echo '</a>    ';
        endif;
        echo '<div class="exad-post-timeline-content-text">';
            echo '<h4><a href="'.esc_url( get_permalink() ).'">'.get_the_title().'</a></h4>';
            echo '<p>'.Helper::exad_get_post_excerpt( get_the_ID(), esc_html( $settings['exad_timeline_excerpt_length'] ) ).'</p>';
        echo '</div>';
    echo '</div>';

    echo '<div class="exad-post-timeline-date">';
        echo '<h4>'.get_the_date('Y').'</h4>';
        echo '<p>'.get_the_date('F d').'</p>';
    echo '</div>';
echo '</div>';