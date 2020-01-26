jQuery(document).ready(function($) {
	'use strict';

	// Dashboard Color Picker 
	$('.exad-dashboard-tab .exad-admin-color-picker').wpColorPicker();

	// Dashboard Tabs
	$( '.exad-dashboard-tabs li a' ).on( 'click', function(e) {
		e.preventDefault();
		$( '.exad-dashboard-tabs li a' ).removeClass( 'active' );
		$(this).addClass( 'active' );
		var tab = $(this).attr( 'href' );
		$( '.exad-dashboard-tab' ).removeClass( 'active' );
		$( '.exad-dashboard-tabs-wrapper' ).find( tab ).addClass( 'active' );
	});

	// Save Button reacting on any changes
	var saveHeaderAction = $( '.exad-dashboard-header-wrapper .exad-btn' );
	$('.exad-dashboard-tab input, .exad-dashboard-tab button').on( 'click', function() {
		saveHeaderAction.addClass( 'exad-save-now' );
		saveHeaderAction.removeAttr('disabled').css('cursor', 'pointer');
	} );

	// Saving Data With Ajax Request
	$( '.exad-js-element-save-setting' ).on( 'click', function(e) {
		e.preventDefault();
		var $this = $(this);
		if( $(this).hasClass('exad-save-now') ) {
			$.ajax( {
				url: js_exad_settings.ajaxurl,
				type: 'post',
				data: {
					action: 'exad_ajax_save_elements_setting',
					security: js_exad_settings.ajax_nonce,
					fields: $( '#exad-elements-settings' ).serialize(),
				},
				beforeSend: function() {
					$this.html('<svg id="exad-spinner" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="4" r="4" fill="#fff"/><circle cx="12.19" cy="7.86" r="3.7" fill="#fffbf2"/><circle cx="5.02" cy="17.68" r="3.4" fill="#fef7e4"/><circle cx="5.02" cy="30.32" r="3.1" fill="#fef3d7"/><circle cx="12.19" cy="40.14" r="2.8" fill="#feefc9"/><circle cx="24" cy="44" r="2.5" fill="#feebbc"/><circle cx="35.81" cy="40.14" r="2.2" fill="#fde7af"/><circle cx="42.98" cy="30.32" r="1.9" fill="#fde3a1"/><circle cx="42.98" cy="17.68" r="1.6" fill="#fddf94"/><circle cx="35.81" cy="7.86" r="1.3" fill="#fcdb86"/></svg><span>Saving Data..</span>');
				},
				success: function( response ) {
					
					$this.html('Save Settings');
					$('.exad-dashboard-header-right').prepend('<span class="exad-settings-saved">Settings Saved</span>').fadeIn('slow');
					
					saveHeaderAction.removeClass( 'exad-save-now' );
					
					setTimeout(function(){
						$('.exad-settings-saved').fadeOut('slow');
					}, 2000);

				},
				error: function() {
					
				}
			} );
		} else {
			$(this).attr('disabled', 'true').css('cursor', 'not-allowed');
		}
	} );

});
