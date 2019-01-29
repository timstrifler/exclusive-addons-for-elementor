<div class="exad-post-timeline-item">
    <span class="exad-post-timeline-icon"><i class="fa fa-bookmark"></i></span>
    <div class="exad-post-timeline-content">
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <?php the_post_thumbnail(); ?>
        </a>    
        <div class="exad-post-timeline-content-text">
            <h4><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h4>
            <p><?php echo exad_get_post_excerpt( get_the_ID(), $settings['exad_timeline_excerpt_length'] ); ?></p>
        </div>
    </div>
    <div class="exad-post-timeline-date">
        <h4><?php echo get_the_date('Y'); ?></h4>
        <p><?php echo get_the_date('F d'); ?></p>
    </div>
</div>