<?php
use \ExclusiveAddons\Elementor\Addons_Manager;
use \ExclusiveAddons\Elementor\Base;
?>

<div id="elements" class="exad-dashboard-tab">
    <div class="exad-row">
        <div class="exad-full-width">
            <div class="exad-element-filter">
                <div class="exad-element-filter-btn">
                    <ul>
                        <li>
                            <a href="" class="exad-element-enable"><?php echo __('Enable All', 'exclusive-addons-elementor') ?></a>
                        </li>
                        <li>
                            <a href="" class="exad-element-disable"><?php echo __('Disable All', 'exclusive-addons-elementor') ?></a>
                        </li>
                    </ul>
                </div>
                <div class="exad-element-filter-text">
                    <div class="exed-element-filter-dropdown">
                        <span class="exed-element-filter-dropdown-shape">
                            <svg width="18" height="9" viewBox="0 0 18 9" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.5 8a.5.5 0 010 1h-7a.5.5 0 010-1h7zm3-4a.5.5 0 010 1h-13a.5.5 0 010-1h13zm2-4a.5.5 0 010 1H.5a.5.5 0 010-1h17z" fill="#D4D9E6" fill-rule="evenodd"/>
                            </svg>
                        </span>
                        <select id="exed-element-filter-dropdown-option">
                            <option value="all"><?php echo __('All Widgets', 'exclusive-addons-elementor') ?></option>
                            <option value="free"><?php echo __('Free', 'exclusive-addons-elementor') ?></option>
                            <option value="pro"><?php echo __('Pro', 'exclusive-addons-elementor') ?></option>
                        </select>
                    </div>
                    <div class="exad-element-filter-search">
                        <input id="exad-element-filter-search-input" type="text" placeholder="<?php echo __('Search Widget', 'exclusive-addons-elementor') ?>">
                        <div class="exad-element-filter-search-icon">
                            <svg width="19" height="19" viewBox="0 0 19 19" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.075 3.075a7.5 7.5 0 0110.95 10.241l3.9 3.902a.5.5 0 01-.707.707l-3.9-3.901A7.5 7.5 0 013.074 3.075zm.707.707a6.5 6.5 0 109.193 9.193 6.5 6.5 0 00-9.193-9.193z" fill="#46D39A" fill-rule="nonzero"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="exad-dashboard-checkbox-container">
                <?php ksort( Addons_Manager::$default_widgets ); ?>
                <?php foreach( Addons_Manager::$default_widgets as $key => $widget ) : ?>
                
                    <?php if ( isset( $key ) ) : ?>
                        <div class="exad-dashboard-checkbox <?php echo esc_attr( $widget['tags'] ); ?><?php echo ( $widget['is_pro'] && !Base::$is_pro_active ) ? ' inactive' : ' active'; ?>" 
                        data-tag="<?php echo esc_attr( $widget['tags'] ); ?>">
                            <?php if( true === $widget['is_pro'] ) { ?>
                                <div class="exad-dashboard-item-label">
                                    <span class="exad-el-label"><?php echo esc_html( $widget['tags'] ); ?></span>
                                </div>
                            <?php } ?>
                            <div class="exad-dashboard-checkbox-text">
                                <p class="exad-el-title"><?php echo esc_html( $widget['title'] ); ?></p>
                                <a href="<?php echo ( isset( $widget['demo_link'] ) ? esc_url( $widget['demo_link'] ) : '#' ); ?>" class="exad-element-demo-link" target="_blank">
                                    <span class="exad-element-demo">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="9.389" height="9.889" viewBox="0 0 9.389 9.889">
                                            <path d="M0 8.475L6.475 2H1.389V0h8v8h-2V3.914L1.414 9.889z" fill="#6636f6"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            <div class="exad-dashboard-checkbox-label">
                                <input class="exad-dashboard-input" type="checkbox" <?php echo ( $widget['is_pro'] && !Base::$is_pro_active ) ? 'disabled="disabled"' : ''; ?> 
                                id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" 
                                <?php ( $widget['is_pro'] && !Base::$is_pro_active ? '' : checked( 1, $this->get_dashboard_settings[$key], true ) ); ?>>
                                <label for="<?php echo esc_attr( $key ); ?>"></label>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div><!--./checkbox-container-->
        </div>
        
    </div>
</div>