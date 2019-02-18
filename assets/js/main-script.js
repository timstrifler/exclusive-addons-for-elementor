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

	var ProgressBar = function ($scope, $){
        var $progressBarWrapper = $scope.find('[data-progress-bar]').eq(0);
		$progressBarWrapper.waypoint(function () {
			console.log(this.element);
			var element = $(this.element);
			var id = element.data('id');
			var type = element.data('type');
			var value = element.data('progress-bar-value');
			var duration = element.data('progress-duration');
			var strokeWidth = element.data('progress-bar-stroke-width');
			var strokeTrailWidth = element.data('progress-bar-stroke-trail-width');
			var color = element.data('stroke-color');
			var trailColor = element.data('stroke-trail-color');
			console.log(id, type, value, strokeWidth, strokeTrailWidth, color, trailColor, duration);
			animatedProgressbar(id, type, value, duration, color, trailColor, strokeWidth, strokeTrailWidth);
			this.destroy();
		}, {
			offset: 'bottom-in-view'
		});
    }
    
    function animatedProgressbar(id, type, value, duration, strokeColor, trailColor, strokeWidth, strokeTrailWidth){
        var triggerClass = '.exad-progress-bar-'+id;
        if("line" == type){
            console.log(triggerClass);
            new ldBar(triggerClass, {
                "type"              : 'stroke',
                "path"              : 'M0 10L100 10',
                "aspect-ratio"      : 'none',
                "stroke"			: strokeColor,
                "stroke-trail"	    : trailColor,
                "stroke-width"      : strokeWidth,
                "stroke-trail-width": strokeTrailWidth
            }).set(value);
        }
        if("line-bubble" == type){
            console.log(triggerClass);
            new ldBar(triggerClass, {
                "type"              : 'stroke',
                "path"              : 'M0 10L100 10',
                "aspect-ratio"      : 'none',
                "stroke"			: strokeColor,
                "stroke-trail"		: trailColor,
                "stroke-width"      : strokeWidth,
                "stroke-trail-width": strokeTrailWidth
            }).set(value);
            $($('.exad-progress-bar-'+id).find('.ldBar-label')).animate({
                left: value + '%'
            }, 1000, 'swing');
        }
        if("circle" == type){
            new ldBar(triggerClass, {
                "type"				: 'stroke',
                "path"			    : 'M50 10A40 40 0 0 1 50 90A40 40 0 0 1 50 10',
                "stroke-dir"		: 'normal',
                "stroke"		    : strokeColor,
                "stroke-trail"	    : trailColor,
                "stroke-width"	    : strokeWidth,
                "stroke-trail-width": strokeTrailWidth,
            }).set(value);
        }
        if("fan" == type){
            new ldBar(triggerClass, {
                "type": 'stroke',
                "path": 'M10 90A40 40 0 0 1 90 90',
                "stroke": strokeColor,
                "stroke-trail": trailColor,
                "stroke-width": strokeWidth,
                "stroke-trail-width": strokeTrailWidth,
            }).set(value);
        }
    }
	
	// Accordion one script
	var ExclusiveAccordion = function($scope, $) {
		var $accordionWrapper = $scope.find('.exad-accordion-six'),
			$accordionTitle = $scope.find('.exad-accordion-title');

		if (typeof $accordionWrapper !== 'undefined' && $accordionWrapper !== null) {	

			// Open default actived tab
            $accordionTitle.each(function(){
                if($(this).hasClass('active-default')){
					$(this).addClass('active');
                    $(this).next('.exad-accordion-content').slideDown();
                }
			})
			
			// Remove multiple click event for nested accordion
			$accordionTitle.unbind("click");

			//$accordionWrapper.children('.exad-accordion-content').first().show();
			$accordionTitle.click(function(e){
				e.preventDefault();
				if ($(this).hasClass("active")) {
					$(this).removeClass('active');
					$(this).next().slideUp(400);
				} else {
					$(this).parent().parent().find(".exad-accordion-title").removeClass("active");
                    $(this).parent().parent().find(".exad-accordion-content").slideUp(400);
                    $(this).toggleClass("active");
                    $(this).next().slideToggle(400);
				}	
			});	
		}	
	};

    


	$(window).on('elementor/frontend/init', function () {
        if(elementorFrontend.isEditMode()) {
            editMode = true;
        }
        
        elementorFrontend.hooks.addAction('frontend/element_ready/exad-team-carousel.default', TeamCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/exad-testimonial-carousel.default', TestimonialCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/exad-progress-bar.default', ProgressBar);
		elementorFrontend.hooks.addAction('frontend/element_ready/exad-countdown-timer.default', CountdownTimer);
		elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-accordion.default', ExclusiveAccordion);
        
    });

}(jQuery));
