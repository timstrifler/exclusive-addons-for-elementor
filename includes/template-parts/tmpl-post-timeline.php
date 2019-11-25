<div class="exad-post-timeline-item">
    <span class="exad-post-timeline-icon"><i class="fa fa-bookmark"></i></span>
    <div class="exad-post-timeline-content">
        <?php if( has_post_thumbnail() ) : ?>
            <a href="<?php echo esc_url( get_permalink() ); ?>">
                <?php the_post_thumbnail(); ?>
            </a>    
        <?php endif; ?>
        <div class="exad-post-timeline-content-text">
            <h4><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h4>
            <p><?php echo \ExclusiveAddons\Elementor\Helper::exad_get_post_excerpt( get_the_ID(), esc_html( $settings['exad_timeline_excerpt_length'] ) ); ?></p>
        </div>
    </div>
    <div class="exad-post-timeline-date">
        <h4><?php echo get_the_date('Y'); ?></h4>
        <p><?php echo get_the_date('F d'); ?></p>
    </div>
</div>