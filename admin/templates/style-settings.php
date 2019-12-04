<div id="style-settings" class="exad-dashboard-tab">
    <div class="exad-row">
        <div class="exad-full-width">
            <div class="exad-dashboard-text-container">
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
            	<table class="form-table">
            		<tbody>
	            		<tr>
	            			<th>
								<label for="exad-primary-color-field">Primary Color</label>
							</th>
							<td>
				  				<input type="text" class="color-picker exad-admin-color-picker" data-alpha="true" data-default-color="#7a56ff" name="exad_primary_color" value="<?php echo sanitize_text_field( esc_attr( $primaryColor ) ); ?>"/>
				  				<p class="description">Choose the primary color which will be applied as the default color for all the elements. Default: #7a56ff <br/> You might have to Regenerate the CSS from Elementor > Tools > Regenerate CSS for this to work.</p>
				  			</td>
	            		</tr>

	            		<tr>
	            			<th>
								<label for="exad-secondary-color-field">Secondary Color</label>
							</th>
							<td>
								<input type="text" class="color-picker exad-admin-color-picker" data-alpha="true" data-default-color="#00d8d8" name="exad_secondary_color" value="<?php echo sanitize_text_field( esc_attr( $secondaryColor ) ); ?>"/>
				  				<p class="description">Choose the secondary color which will be applied as the default color for all the elements. Default: #00d8d8 <br/> You might have to Regenerate the CSS from Elementor > Tools > Regenerate CSS for this to work.</p>
				  			</td>
	            		</tr>
	  				</tbody>
  				</table>
            </div>
        </div>
    </div>
</div>