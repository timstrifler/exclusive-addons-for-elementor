(function ($) {
    "use strict";

    var editMode = false;

	var TeamCarousel = function ($scope, $) {
		var $teamCarouselWrapper = $scope.find('.exad-team-carousel-wrapper').eq(0),
		$team_carousel_id = $teamCarouselWrapper.data("team-carousel-id"),
		$team_preset = $teamCarouselWrapper.data("team-preset"),
		$allow_dots = $teamCarouselWrapper.data("allow-dots"),
		$carousel_nav = $teamCarouselWrapper.data("carousel-nav");


		// Team Carousel Two
		jQuery(document).ready(function($) {
			'use strict';
			var teamCarousel = $("#exad-team-carousel-" + $team_carousel_id);

			if ($carousel_nav == "arrows" ) {
				var arrows = true;
				var dots = false;
			} else {
				var arrows = false;
				var dots = true;
			}
	
			teamCarousel.slick({
		    	autoplay: false,
		     	infinite: true,
		     	slidesToShow: 3,
		     	slidesToScroll: 3,
		      	dots: dots,
		      	arrows: arrows,
		      	prevArrow: "<div class='exad-team-carousel-prev'><i class='fa fa-angle-left'></i></div>",
				nextArrow: "<div class='exad-team-carousel-next'><i class='fa fa-angle-right'></i></div>"
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
