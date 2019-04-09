<article class="exad-post-grid-<?php echo $settings['exad_post_carousel_preset']; ?>">
    <div class="exad-post-grid-container">
        <figure class="exad-post-grid-thumbnail">
            <a href="<?php echo esc_url( get_permalink() ); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
        </figure>
        <div class="exad-post-grid-body"> 
            <ul class="exad-post-grid-category">
                <?php Elementor\Exad_Helper::exad_get_categories_for_post(); ?>
            </ul>
            <h3>
                <a href="<?php echo esc_url( get_permalink() ); ?>" class="exad-post-grid-title"><?php the_title(); ?></a>
            </h3>
            <?php if ( 'three' === $settings['exad_post_carousel_preset'] ) : ?>
                <p class="exad-post-grid-author">by <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="exad-post-grid-author-name"><?php echo get_the_author(); ?></a> | on
                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="exad-post-grid-author-date"><?php echo get_the_date('M d, Y'); ?></a>
                </p>
            <?php endif; ?> 
            <p class="exad-post-grid-description"><?php echo Elementor\Exad_Helper::exad_get_post_excerpt( get_the_ID(), $settings['exad_carousel_excerpt_length'] ); ?></p>
            <?php if ( 'one' === $settings['exad_post_carousel_preset'] ) : ?>
                <div class="exad-post-grid-author">
                    <div class="exad-post-grid-author-image">
                        <img src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ), array( 'size' => '43' ) ); ?>" alt="">
                    </div>
                    <div class="exad-post-grid-author-info">
                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="exad-post-grid-author-name"><?php echo get_the_author(); ?></a>
                        <p class="exad-post-grid-author-date"><?php echo get_the_date('M d, Y'); ?></p>
                    </div>
                    <?php if( 'one' === $settings['exad_post_carousel_preset'] ) : ?>
                        <ul class="exad-post-grid-author-action">
                            <li>
                                <a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i></a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endif; ?>    
        </div>
    </div>    
</article>