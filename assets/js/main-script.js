(function ($) {
    "use strict";

    var editMode = false;

	var TeamCarousel = function ($scope, $) {
		var $teamCarouselWrapper = $scope.find('.exad-team-carousel-wrapper').eq(0),
		//$team_carousel_id = $teamCarouselWrapper.data("team-carousel-id"),
		$team_preset = $teamCarouselWrapper.data("team-preset"),
		$carousel_nav = $teamCarouselWrapper.data("carousel-nav"),
		$loop = ($teamCarouselWrapper.data("loop") !== undefined) ? $teamCarouselWrapper.data("loop") : false,
		$slidesToShow = $teamCarouselWrapper.data("slidestoshow"),
		$slidesToScroll = $teamCarouselWrapper.data("slidestoscroll"),
		$autoPlay = ($teamCarouselWrapper.data("autoplay") !== undefined) ? $teamCarouselWrapper.data("autoplay") : false,
		$autoplaySpeed = ($teamCarouselWrapper.data("autoplayspeed") !== undefined) ? $teamCarouselWrapper.data("autoplayspeed") : false,
		$transitionSpeed = $teamCarouselWrapper.data("speed"),
		$pauseOnHover = ($teamCarouselWrapper.data("pauseOnHover") !== undefined) ? $teamCarouselWrapper.data("pauseOnHover") : false;


		// Team Carousel 

		//var $teamCarousel = $("#exad-team-carousel-" + $team_carousel_id);

		if ($carousel_nav == "arrows" ) {
			var arrows = true;
			var dots = false;
		} else {
			var arrows = false;
			var dots = true;
		}

		$teamCarouselWrapper.slick({
			infinite: $loop,
			slidesToShow : $slidesToShow,
			slidesToScroll: $slidesToScroll,
			autoplay: $autoPlay,
			autoplaySpeed: $autoplaySpeed,
			speed: $transitionSpeed,
			pauseOnHover: $pauseOnHover,
	      	dots: dots,
	      	arrows: arrows,
	      	prevArrow: "<div class='exad-team-carousel-prev'><i class='fa fa-angle-left'></i></div>",
			nextArrow: "<div class='exad-team-carousel-next'><i class='fa fa-angle-right'></i></div>",
			rows: 0,
			//lazyLoad: "ondemand",
			//swipe: true,
	    });

		
	};

	// Testimonial Carousel
	var TestimonialCarousel = function ($scope, $) {
		var $testimonialCarouselWrapper = $scope.find('.exad-testimonial-carousel-wrapper').eq(0),
		$testimonial_preset = $testimonialCarouselWrapper.data("testimonial-preset"),
		//$carousel_nav = $testimonialCarouselWrapper.data("carousel-nav"),
		$loop = ($testimonialCarouselWrapper.data("loop") !== undefined) ? $testimonialCarouselWrapper.data("loop") : false,
		$slidesToShow = ($testimonialCarouselWrapper.data("slidestoshow") !== undefined) ? $testimonialCarouselWrapper.data("slidestoshow") : 1,
		$slidesToScroll = ($testimonialCarouselWrapper.data("slidestoscroll") !== undefined) ? $testimonialCarouselWrapper.data("slidestoscroll") : 1,
		$autoPlay = ($testimonialCarouselWrapper.data("autoplay") !== undefined) ? $testimonialCarouselWrapper.data("autoplay") : false,
		$autoplaySpeed = ($testimonialCarouselWrapper.data("autoplayspeed") !== undefined) ? $testimonialCarouselWrapper.data("autoplayspeed") : false,
		$transitionSpeed = $testimonialCarouselWrapper.data("speed"),
		$dots = ($testimonialCarouselWrapper.data("carousel-dot") !== undefined) ? $testimonialCarouselWrapper.data("carousel-dot") : false,
		$pauseOnHover = ($testimonialCarouselWrapper.data("pauseOnHover") !== undefined) ? $testimonialCarouselWrapper.data("pauseOnHover") : false;


		$testimonialCarouselWrapper.slick({
			infinite: $loop,
			slidesToShow: $slidesToShow,
			slidesToScroll: $slidesToScroll,
			autoplay: $autoPlay,
			autoplaySpeed: $autoplaySpeed,
			speed: $transitionSpeed,
			pauseOnHover: $pauseOnHover,
			dots: $dots,
	      	prevArrow: "<div class='exad-testimonial-carousel-prev'><i class='fa fa-angle-left'></i></div>",
	      	nextArrow: "<div class='exad-testimonial-carousel-next'><i class='fa fa-angle-right'></i></div>",
	      	customPaging: function (slider, i) {
	        	var image = $(slider.$slides[i]).data('image');
	        	return '<a><img src="'+ image +'"></a>';
	      	},
			rows: 0,
			//lazyLoad: "ondemand",
			//swipe: true,
	    });	
	};


	$(window).on('elementor/frontend/init', function () {
        if(elementorFrontend.isEditMode()) {
            editMode = true;
        }
        
        elementorFrontend.hooks.addAction('frontend/element_ready/exad-team-carousel.default', TeamCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/exad-testimonial-carousel.default', TestimonialCarousel);
        
    });

}(jQuery));
