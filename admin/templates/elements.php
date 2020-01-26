<div id="elements" class="exad-dashboard-tab">
    <div class="exad-row">
        <div class="exad-full-width">
            <div class="exad-elements-dashboard-title">
                <img src="<?php echo EXAD_ADMIN_URL . 'assets/img/elements-dashboard.svg'; ?>">
                <h4 class="exad-dashboard-section-title"><?php _e( 'Deactivate elements for better performance', 'exclusive-addons-elementor' ); ?></h4>
                <p class="exad-dashboard-section-title-p-tag"><?php _e( 'You can deactivate those elements that you do not intend to use to avoid loading scripts and files related to those elements.', 'exclusive-addons-elementor' ); ?></p>
            </div>
            <div class="exad-dashboard-checkbox-container">
                
                <?php foreach( \ExclusiveAddons\Elementor\Base::$registered_elements as $widget ) : ?>
                    <?php if ( isset( $widget ) ) : ?>        
                        <div class="exad-dashboard-checkbox">
                            <div class="exad-dashboard-checkbox-text">
                                <p class="exad-el-title"><?php echo esc_html( ucwords( str_replace( "-", " ", $widget ) ) ); ?></p>
                            </div>
                            <div class="exad-dashboard-checkbox-label">
                                <input type="checkbox" id="<?php echo esc_attr( $widget ); ?>" name="<?php echo esc_attr( $widget ); ?>" <?php checked( 1, $this->exad_get_settings[$widget], true ); ?> >
                                <label for="<?php echo esc_attr( $widget ); ?>"></label>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div><!--./checkbox-container-->
        </div>
        
    </div>
</div>