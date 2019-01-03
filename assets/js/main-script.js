(function ($) {
    "use strict";

    var editMode = false;

	var TeamCarousel = function ($scope, $) {
		var $teamCarouselWrapper = $scope.find('.exad-team-carousel-wrapper').eq(0),
		$team_carousel_id = $teamCarouselWrapper.data("team-carousel-id");


		// Team Carousel Two
		jQuery(document).ready(function($) {
			'use strict';
			var teamCarousel = $("#exad-team-carousel-" + $team_carousel_id);
	
			teamCarousel.slick({
		    	autoplay: false,
		     	infinite: true,
		     	slidesToShow: 3,
		     	slidesToScroll: 3,
		      	//dots: true,
		      	arrows: true,
		      	prevArrow: "<div class='exad-team-carousel-content-hover-prev'><i class='fa fa-angle-left'></i></div>",
				nextArrow: "<div class='exad-team-carousel-content-hover-next'><i class='fa fa-angle-right'></i></div>"
		    });

		});
	}


	$(window).on('elementor/frontend/init', function () {
        if(elementorFrontend.isEditMode()) {
            editMode = true;
        }
        
        elementorFrontend.hooks.addAction('frontend/element_ready/exad-team-carousel.default', TeamCarousel);
        
    });

}(jQuery));
