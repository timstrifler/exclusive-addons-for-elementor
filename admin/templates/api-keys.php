<div id="apikeys" class="exad-dashboard-tab">
    <div class="exad-row">
        <div class="exad-full-width">
            <div class="exad-dashboard-text-container">

                <div class="exad-dashboard-text">
                    <div class="exad-dashboard-text-title">
                        <p class="exad-el-title"><?php esc_attr_e( 'Google Map API Key', 'exclusive-addons-elementor' ); ?></p>
                    </div>
                    <div class="exad-dashboard-text-label">
                        <input type="text" id="google-map-api-key" placeholder="<?php esc_attr_e( 'Google Map API Key', 'exclusive-addons-elementor' ); ?>" name="google_map_api_key" value="<?php echo ( !is_array( get_option('exad_google_map_api_option') ) ? esc_attr( get_option('exad_google_map_api_option') ) : '' ); ?>">
                        <label for="Map API Key"></label>
                    </div>
                    <div class="exad-dashboard-text-title">
                        <p class="exad-el-title"><?php esc_attr_e( 'MailChimp API Key', 'exclusive-addons-elementor' ); ?></p>
                    </div>
                    <div class="exad-dashboard-text-label">
                        <input type="text" id="mailchimp-api-key" placeholder="<?php esc_attr_e( 'MailChimp API Key', 'exclusive-addons-elementor' ); ?>" name="mailchimp_api_key" value="<?php echo ( !is_array( get_option('exad_save_mailchimp_api') ) ? esc_attr( get_option('exad_save_mailchimp_api') ) : '' ); ?>">
                        <label for="MailChimp API Key"></label>
                    </div>
                </div>
                
            </div>
            <!--./checkbox-container-->
        </div>
        
    </div>
</div>