$(window).on('elementor/frontend/init', function () {
    if( elementorFrontend.isEditMode() ) {
        editMode = true;
    }
    
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-team-carousel.default', TeamCarousel);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-testimonial-carousel.default', TestimonialCarousel);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-progress-bar.default', ProgressBar);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-countdown-timer.default', CountdownTimer);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-accordion.default', ExclusiveAccordion);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-tabs.default', ExclusiveTabs);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-button.default', ExclusiveButton);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-post-carousel.default', PostCarousel);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-google-maps.default', GoogleMaps);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-image-comparison.default', ImageComparison);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-counter.default', CounterUp);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-logo-carousel.default', LogoCarousel);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-modal-popup.default', ModalPopup);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-filterable-gallery.default', FilterableGallery);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-alert.default', ExclusiveAlert);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-instagram-feed.default', InstagramGallery);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-news-ticker.default', ExadNewsTicker );
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-animated-text.default', AnimatedText);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-image-hotspot.default', ImageHotspot);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-image-magnifier.default', ImageMagnifier);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-slider.default', ExadSlider);
});	

}(jQuery));