<?php 
use \ExclusiveAddons\Elementor\Base;
?>
<div id="general" class="exad-dashboard-tab active">
    <div class="exad-row exad-admin-general-wrapper">
        <?php if ( !Base::$is_pro_active ) : ?>
            <div class="exad-row exad-admin-banner">
                <div class="exad-admin-block-banner-content">
                    <a class="exad-admin-block-banner-title" href="https://exclusiveaddons.com/" target="_blank">
                        <?php echo __( 'Exclusive Addons For Elementor', 'exclusive-addons-elementor' ); ?>
                    </a>
                </div>
                <div class="exad-admin-block-upgrade-button">
                    <a href="https://exclusiveaddons.com/pricing/" target="_blank">
                        <?php echo __( 'Upgrade To Pro', 'exclusive-addons-elementor' ); ?>
                    </a>
                </div>
            </div>
        <?php endif; ?>
        <!--preview image end-->
        
        <div class="exad-admin-general-inner">
            <?php do_action( 'exad/add_admin_license_page' ); ?>
            <div class="exad-admin-block-wrapper">

                <div class="exad-admin-block exad-admin-block-banner">
                    <div class="exad-admin-block-header-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25.016" height="25.015" viewBox="0 0 25.016 25.015">
                            <path d="M11.5 1.02v10.492H1.012a1 1 0 100 2H11.51v10.494a1 1 0 102-.01v-10.49H24a1 1 0 100-2H13.506V1.012a1 1 0 10-2 .008z" fill="#2caf98"/>
                        </svg>
                    </div>
                    <div class="exad-admin-block-header">
                        <h4 class="exad-admin-title"><?php _e( 'Contribute to Exclusive Addons', 'exclusive-addons-elementor' ); ?></h4>
                        <p><?php _e( 'Please feel free to report any issues in our Github repo about Exclusive Addons for Elementor. Send pull requests at', 'exclusive-addons-elementor' ); ?> <a href="https://github.com/mmaumio/exclusive-addons-for-elementor" target="_blank"><?php _e( 'Github.', 'exclusive-addons-elementor' ); ?></a></p>
                        <a href="https://github.com/mmaumio/exclusive-addons-for-elementor/issues/new" class="exad-admin-block-contribution-button" target="_blank"><?php _e( 'Report Bug', 'exclusive-addons-elementor' ); ?></a>
                    </div>
                </div>
                <!--preview image end-->
                <div class="exad-admin-block exad-admin-block-docs">

                    <div class="exad-admin-block-header-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="11.699" height="21.533" viewBox="0 0 11.699 21.533">
                            <path d="M5.366 21.533a1.483 1.483 0 111.482-1.482 1.484 1.484 0 01-1.482 1.482zm.875-6.2H4.377v-.556c.02-3.2 1.016-4.4 3.1-5.726a4.308 4.308 0 002.347-3.706 3.674 3.674 0 00-3.892-3.7 3.845 3.845 0 00-3.985 3.916H0A5.617 5.617 0 015.932 0 5.982 5.982 0 0110.1 1.536a5.292 5.292 0 011.6 3.891c0 2.011-.908 3.5-2.946 4.83a4.635 4.635 0 00-2.513 4.521v.555z" fill="#3b88b7"/>
                        </svg>
                    </div>
                    <div class="exad-admin-block-header">
                        <h4 class="exad-admin-title"><?php _e( 'Documentation', 'exclusive-addons-elementor' ); ?></h4>
                        <p><?php _e( 'Get yourself used to with the easy to read documentation we have till now. We\'re always working to make it easier for you.', 'exclusive-addons-elementor' ); ?></p>
                        <a href="https://exclusiveaddons.com/docs" class="exad-admin-block-docs-button" target="_blank"><?php _e( 'Documentation', 'exclusive-addons-elementor' ); ?></a>
                    </div>
                </div>
                <div class="exad-admin-block exad-admin-block-contribution">
                    <div class="exad-admin-block-header-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="13" viewBox="0 0 21 13">
                            <path data-name="Combined Shape" d="M1 13a1 1 0 110-2h10a1 1 0 010 2zm0-5a1 1 0 010-2h15a1 1 0 110 2zm0-6a1 1 0 010-2h19a1 1 0 110 2z" fill="#e96973"/>
                        </svg>
                    </div>
                    <div class="exad-admin-block-header">
                        <h4 class="exad-admin-title"><?php _e( 'Customer Support', 'exclusive-addons-elementor' ); ?></h4>
                        <p><?php _e( 'We are always here to listen your beautiful voice. A dedicated support team is on your way to the rescue, the moment you need us.', 'exclusive-addons-elementor' ); ?></p>
                        <a href="https://wordpress.org/support/plugin/exclusive-addons-for-elementor/" class="exad-admin-block-support-button" target="_blank"><?php _e( 'Get Support', 'exclusive-addons-elementor' ); ?></a>
                    </div>
                </div>
                <div class="exad-admin-block exad-admin-block-support">
                    <div class="exad-admin-block-header-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30.443" height="29.025" viewBox="0 0 30.443 29.025">
                            <path data-name="Combined Shape 2" d="M15.134 29.024l-10.6-9.84a14.1 14.1 0 01-4.22-7.194 9.028 9.028 0 01-.261-3.31C.5 3.65 4 0 8.382 0a7.7 7.7 0 013.839 1.029 8.427 8.427 0 012.922 2.861 8.537 8.537 0 013-2.848A8.012 8.012 0 0122.064 0c4.378 0 7.88 3.657 8.33 8.695a9.412 9.412 0 01-.262 3.3 14.084 14.084 0 01-4.219 7.194l-10.778 9.835zM1.6 8.864a8.053 8.053 0 00.229 2.772 12.565 12.565 0 003.749 6.387l9.564 8.869 9.725-8.87a12.551 12.551 0 003.748-6.386 8.243 8.243 0 00.245-2.684l-.008-.093c-.393-4.212-3.245-7.268-6.782-7.268A6.79 6.79 0 0015.859 5.9l-.718 1.74-.718-1.74a6.588 6.588 0 00-6.041-4.315c-3.563 0-6.415 3.061-6.782 7.279zm2.527 1.33a6.052 6.052 0 015.979-6.108.766.766 0 01.769.8.784.784 0 01-.775.787 4.477 4.477 0 00-4.423 4.522.775.775 0 11-1.55 0z" fill="#8a6cdb"/>
                        </svg>
                    </div>
                    <div class="exad-admin-block-header">
                        <h4 class="exad-admin-title"><?php _e( 'Show your Love', 'exclusive-addons-elementor' ); ?></h4>
                        <p><?php _e( 'We are continiously working to make "Exclusive Addons" better, everyday. Your kind feedback will surely encourage us to move forward with the development.', 'exclusive-addons-elementor' ); ?></p>
                        <a href="https://wordpress.org/plugins/exclusive-addons-for-elementor/#reviews" class="exad-admin-block-header-button" target="_blank"><?php _e( 'Leave a Review', 'exclusive-addons-elementor' ); ?></a>
                    </div>
                </div>
            </div>

            <?php if ( !Base::$is_pro_active ) : ?>
            <div class="exad-admin-footer-banner-wrapper">
                <div class="exad-admin-footer-banner">
                    <p class="exad-admin-footer-banner-content">
                    <?php echo __('The premium version helps us to continue development of the product</br> incorporating even more features and enhancements.</br></br>
                    You will also get world class support from our dedicated team, 24/7.','exclusive-addons-elementor' ); ?>
                    </p>
                    <a href="https://exclusiveaddons.com/pricing/" class="exad-admin-footer-banner-btn" target="_blank"><?php echo __('Upgrade To Pro','exclusive-addons-elementor'); ?></a>
                </div>
            </div>
            <?php endif; ?>

        </div>

    </div>
    <!--exad-row end-->
</div>