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


	// Countdown Timer
	var CountdownTimer = function ($scope, $) {
		var $countdownTimerWrapper = $scope.find('[data-countdown]').eq(0);

		if (typeof $countdownTimerWrapper !== 'undefined' && $countdownTimerWrapper !== null) {		
			var $this = $countdownTimerWrapper,
				finalDate = $this.data('countdown'),
				day = $this.data('day'),
				hours = $this.data('hours'),
				minutes = $this.data('minutes'),
				seconds = $this.data('seconds');

			$this.countdown(finalDate, function (event) {
				$(this).html(event.strftime(' ' +
					'<div class="exad-countdown-container"><span class="exad-countdown-count">%-D </span><span class="exad-countdown-title">' + day + '</span></div>' +
					'<div class="exad-countdown-container"><span class="exad-countdown-count">%H </span><span class="exad-countdown-title">' + hours + '</span></div>' +
					'<div class="exad-countdown-container"><span class="exad-countdown-count">%M </span><span class="exad-countdown-title">' + minutes + '</span></div>' +
					'<div class="exad-countdown-container"><span class="exad-countdown-count">%S </span><span class="exad-countdown-title">' + seconds + '</span></div>'));
			}).on('finish.countdown', function (event) {
				$(this).html("<p class='message'>Hurrey! This is event day</p>");
			});
		}	

	};

	
	// Accordion one script
	var ExclusiveAccordion = function($scope, $) {
		var $accordionWrapper = $scope.find('.exad-accordion-one'),
			$accordionTitle = $scope.find('.exad-accordion-title');

		if (typeof $accordionWrapper !== 'undefined' && $accordionWrapper !== null) {	
			// Remove multiple click event for nested accordion
			$accordionTitle.unbind("click");

			$accordionWrapper.children('.exad-accordion-content').first().show();
			$accordionTitle.click(function(){
				$(this).next('.exad-accordion-content').slideToggle(200);
				$(this).parent().toggleClass('active');
				$(this).parent().siblings().children('.exad-accordion-content').slideUp();
				$(this).parent().siblings().removeClass('active');
			});	
		}	
	};

    


	$(window).on('elementor/frontend/init', function () {
        if(elementorFrontend.isEditMode()) {
            editMode = true;
        }
        
        elementorFrontend.hooks.addAction('frontend/element_ready/exad-team-carousel.default', TeamCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/exad-testimonial-carousel.default', TestimonialCarousel);
        //elementorFrontend.hooks.addAction('frontend/element_ready/exad-progress-bar.default', ProgressBar);
		elementorFrontend.hooks.addAction('frontend/element_ready/exad-countdown-timer.default', CountdownTimer);
		elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-accordion.default', ExclusiveAccordion);
        
    });

}(jQuery));
