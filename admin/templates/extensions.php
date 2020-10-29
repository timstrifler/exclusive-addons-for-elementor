<?php
use \ExclusiveAddons\Elementor\Addons_Manager;
use \ExclusiveAddons\Elementor\Base;

?>


<div id="extensions" class="exad-dashboard-tab">
    <div class="exad-row">
        <div class="exad-full-width">
            <div class="exad-dashboard-checkbox-container">
                
                <?php foreach( Addons_Manager::$default_extensions as $key => $extension ) : ?>
                
                    <?php if ( isset( $key ) ) : ?>
                        <div class="exad-dashboard-checkbox <?php echo esc_attr( $extension['tags'] ); ?><?php echo ( $extension['is_pro'] && !Base::$is_pro_active ) ? ' inactive' : ' active'; ?>" data-tag="<?php echo esc_attr( $extension['tags'] ); ?>">
                            <?php if( true === $extension['is_pro'] ) { ?>
                                <div class="exad-dashboard-item-label">
                                    <span class="exad-el-label"><?php echo esc_html( $extension['tags'] ); ?></span>
                                </div>
                            <?php } ?>
                            <div class="exad-dashboard-checkbox-text">
                                <p class="exad-el-title"><?php echo esc_html( $extension['title'] ); ?></p>
                                <a href="<?php echo ( isset( $extension['demo_link'] ) ? esc_url( $extension['demo_link'] ) : '#' ); ?>" class="exad-element-demo-link" target="_blank">
                                    <span class="exad-element-demo">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="9.389" height="9.889" viewBox="0 0 9.389 9.889">
                                            <path d="M0 8.475L6.475 2H1.389V0h8v8h-2V3.914L1.414 9.889z" fill="#6636f6"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            <div class="exad-dashboard-checkbox-label">
                                <input class="exad-dashboard-input" type="checkbox" <?php echo ( $extension['is_pro'] && !Base::$is_pro_active ) ? 'disabled="disabled"' : ''; ?> 
                                id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" 
                                <?php ( $extension['is_pro'] && !Base::$is_pro_active ? '' : checked( 1, $this->get_dashboard_settings[$key], true ) ); ?>>
                                <label for="<?php echo esc_attr( $key ); ?>"></label>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                <?php endforeach; ?>

            </div><!--./checkbox-container-->
        </div>
    </div>
</div>
