<?php
use \ExclusiveAddons\Elementor\Base;
?>

<div id="elements" class="exad-dashboard-tab">
    <div class="exad-row">
        <div class="exad-full-width">
            <div class="exad-elements-dashboard-title">
                <img src="<?php echo EXAD_ADMIN_URL . 'assets/img/elements-dashboard.svg'; ?>">
                <h4 class="exad-dashboard-section-title"><?php _e( 'Deactivate elements for better performance', 'exclusive-addons-elementor' ); ?></h4>
                <p class="exad-dashboard-section-title-p-tag"><?php _e( 'You can deactivate those elements that you do not intend to use to avoid loading scripts and files related to those elements.', 'exclusive-addons-elementor' ); ?></p>
            </div>
            <div class="exad-dashboard-checkbox-container">
                
                <?php foreach( Base::$default_widgets as $key => $widget ) : ?>
                    <?php if ( isset( $key ) ) : ?>        
                        <div class="exad-dashboard-checkbox <?php echo esc_attr( $widget['tags'] ); ?>">
                            <div class="exad-dashboard-checkbox-text">
                                <p class="exad-el-title"><?php echo esc_html( $widget['title'] ); ?></p>
                            </div>
                            <div class="exad-dashboard-checkbox-label">
                                <input type="checkbox" id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" <?php checked( 1, $this->exad_get_settings[$key], true ); ?> >
                                <label for="<?php echo esc_attr( $key ); ?>"></label>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div><!--./checkbox-container-->
        </div>
        
    </div>
</div>