<div id="style-settings" class="exad-dashboard-tab">
    <div class="exad-row">
        <div class="exad-full-width">
            <div class="exad-dashboard-color-container">
            	<?php             		
            		$primaryColor = get_option( 'exad_primary_color_option' );
            		if( empty( $primaryColor ) ) {
            			$primaryColor = '#7a56ff';
            		}

            		$secondaryColor = get_option( 'exad_secondary_color_option' );
            		if( empty( $secondaryColor ) ) {
            			$secondaryColor = '#00d8d8';
            		}

				?>
				<div class="exad-dashboard-color-wrapper">
					<div class="exad-primary-color-field">
						<h4 class="exad-primary-color-text"><?php _e( 'Primary Color', 'exclusive-addons-elementor' ); ?></h4>
						<p class="exad-primary-color-description">
							<?php _e( 'Choose the primary color which will be applied as the default color for all the elements. Default: ', 'exclusive-addons-elementor' ); ?>#7a56ff <br/> 
							<?php _e( 'You might have to Regenerate the CSS from Elementor > Tools > Regenerate CSS for this to work.' ); ?>
						</p>
						<input type="text" class="color-picker exad-admin-color-picker" data-alpha="true" data-default-color="#7a56ff" name="exad_primary_color" value="<?php echo sanitize_text_field( esc_attr( $primaryColor ) ); ?>"/>
					</div>
					<div class="exad-secondary-color-field">
						<h4 class="exad-secondary-color-text"><?php _e( 'Secondary Color', 'exclusive-addons-elementor' ); ?></h4>
						<p class="exad-secondary-color-description">
							<?php _e( 'Choose the secondary color which will be applied as the default color for all the elements. Default: ', 'exclusive-addons-elementor' ); ?>#00d8d8 <br/> 
							<?php _e( 'You might have to Regenerate the CSS from Elementor > Tools > Regenerate CSS for this to work.', 'exclusive-addons-elementor' ); ?>
						</p>
						<input type="text" class="color-picker exad-admin-color-picker" data-alpha="true" data-default-color="#00d8d8" name="exad_secondary_color" value="<?php echo sanitize_text_field( esc_attr( $secondaryColor ) ); ?>"/>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>