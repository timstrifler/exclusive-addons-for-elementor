$(window).on('elementor/frontend/init', function () {
    if( elementorFrontend.isEditMode() ) {
        editMode = true;
    }
    
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-exclusive-accordion.default', exclusiveAccordion );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-post-grid.default', exclusivePostGrid );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-exclusive-alert.default', exclusiveAlert );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-animated-text.default', exclusiveAnimatedText );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-exclusive-button.default', exclusiveButton );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-countdown-timer.default', exclusiveCountdownTimer );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-filterable-gallery.default', exclusiveFilterableGallery );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-google-maps.default', exclusiveGoogleMaps );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-image-comparison.default', exclusiveImageComparison );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-image-magnifier.default', exclusiveImageMagnifier );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-logo-carousel.default', exclusiveLogoCarousel );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-modal-popup.default', exclusiveModalPopup );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-news-ticker.default', exclusiveNewsTicker );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-progress-bar.default', exclusiveProgressBar );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-exclusive-tabs.default', exclusiveTabs );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-covid-19.default', exclusiveCorona );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-facebook-feed.default', exadFacebookFeed );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-google-reviews.default', exclusiveGoogleReviews );
    elementorFrontend.hooks.addAction( 'frontend/element_ready/exad-filterable-post.default', exclusiveFilterablePost);
    elementorFrontend.hooks.addAction( 'frontend/element_ready/section', exclusiveSticky);
});	

}(jQuery));