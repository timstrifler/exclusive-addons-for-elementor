(function ($) {
    "use strict";

    var editMode = false;

	var TeamCarousel = function ($scope, $) {
		var $teamCarouselWrapper = $scope.find('.exad-team-carousel-wrapper').eq(0),
		$carousel_nav = $teamCarouselWrapper.data("carousel-nav"),
		$loop = ($teamCarouselWrapper.data("loop") !== undefined) ? $teamCarouselWrapper.data("loop") : false,
		$slidesToShow = $teamCarouselWrapper.data("slidestoshow"),
		$slidesToScroll = $teamCarouselWrapper.data("slidestoscroll"),
		$autoPlay = ($teamCarouselWrapper.data("autoplay") !== undefined) ? $teamCarouselWrapper.data("autoplay") : false,
		$autoplaySpeed = ($teamCarouselWrapper.data("autoplayspeed") !== undefined) ? $teamCarouselWrapper.data("autoplayspeed") : false,
		$transitionSpeed = $teamCarouselWrapper.data("speed"),
		$pauseOnHover = ($teamCarouselWrapper.data("pauseOnHover") !== undefined) ? $teamCarouselWrapper.data("pauseOnHover") : false;

		// Team Carousel 
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
			responsive: [
				{
				  breakpoint: 1024,
				  settings: {
					slidesToShow: 2,
				  }
				},
				{
				  breakpoint: 576,
				  settings: {
					slidesToShow: 1,
				  }
				}
			],
	    });

		
	};

	// Testimonial Carousel
	var TestimonialCarousel = function ($scope, $) {
		var $testimonialCarouselWrapper = $scope.find('.exad-testimonial-carousel-wrapper').eq(0),
		$loop = ($testimonialCarouselWrapper.data("loop") !== undefined) ? $testimonialCarouselWrapper.data("loop") : false,
		$responsiveTestimonial =  ( $testimonialCarouselWrapper.data("testimonial-preset") == '-circle' ) ? 2 : 1,
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
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: $responsiveTestimonial,
					},
				},	
				{
					breakpoint: 576,
					settings: {
						slidesToShow: 1,
					}
				}
			],
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
			var element = $(this.element);
			var id = element.data('id');
			var type = element.data('type');
			var value = element.data('progress-bar-value');
			var strokeWidth = element.data('progress-bar-stroke-width');
			var strokeTrailWidth = element.data('progress-bar-stroke-trail-width');
			var color = element.data('stroke-color');
			var trailColor = element.data('stroke-trail-color');
			animatedProgressbar(id, type, value, color, trailColor, strokeWidth, strokeTrailWidth);
			this.destroy();
		}, {
			offset: 'bottom-in-view'
		});
    }
    
    function animatedProgressbar(id, type, value, strokeColor, trailColor, strokeWidth, strokeTrailWidth){
        var triggerClass = '.exad-progress-bar-'+id;
        if("line" == type) {
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
        if("line-bubble" == type) {
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
		var $accordionTitle = $scope.find('.exad-accordion-title');

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
			
	};

	// Exclusive Tabs 
	var ExclusiveTabs = function($scope, $) {
		// Advance tab script
		var $tabsWrapper = $scope.find('[data-tabs]').eq(0);
		$tabsWrapper.each( function() {
			var tab = $(this);
			var isTabActive = false;
			var isContentActive = false;
			tab.find('[data-tab]').each( function (){
				if($(this).hasClass('active')){
					isTabActive = true;
				}
			});
			tab.find('.exad-advance-tab-content').each( function (){
				if($(this).hasClass('active')){
					isContentActive = true;
				}
			});
			if(!isContentActive){
				tab.find('.exad-advance-tab-content').eq(0).addClass('active');
			}
			if(!isTabActive){
				tab.find('[data-tab]').eq(0).addClass('active');
			}
			tab.find('[data-tab]').click(function() {
				tab.find('[data-tab]').removeClass('active');
				tab.find('.exad-advance-tab-content').removeClass('active');
				$(this).addClass('active');
				tab.find('.exad-advance-tab-content').eq($(this).index()).addClass('active');
			});
		});
	};

	// Exclusive Button 
	var ExclusiveButton = function($scope, $) {
		// position on hover a button in button style seven
		var $mouseHoverEffect8 = $scope.find('.effect-8.mouse-hover-effect').eq(0);
		
		$mouseHoverEffect8.on('mouseenter', function (e) {
		  	var parentOffset = $(this).offset(),
			relX = e.pageX - parentOffset.left,
			relY = e.pageY - parentOffset.top;
		  	$(this).find('.effect-8-position').css({ top: relY, left: relX })
		});
		$mouseHoverEffect8.on('mouseout', function (e) {
		  	var parentOffset = $(this).offset(),
			relX = e.pageX - parentOffset.left,
			relY = e.pageY - parentOffset.top;
		  	$(this).find('.effect-8-position').css({ top: relY, left: relX })
		});
	  	// position on hover a button in button style seven
	};

	// Post Carousel 
	var PostCarousel = function($scope, $) {
		var $postCarouselWrapper = $scope.find('.exad-post-carousel.one').eq(0),
			$postCarouselColumn = $postCarouselWrapper.data("carousel-column");
		// post Carousel one
		$($postCarouselWrapper).slick({
			infinite: true,
			slidesToShow: $postCarouselColumn,
			arrows: true,
			prevArrow: "<div class='exad-post-carousel-prev'><i class='fa fa-long-arrow-left'></i></div>",
			nextArrow: "<div class='exad-post-carousel-next'><i class='fa fa-long-arrow-right'></i></div>"
		  });
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
		elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-tabs.default', ExclusiveTabs);
		elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-button.default', ExclusiveButton);
		elementorFrontend.hooks.addAction('frontend/element_ready/exad-post-carousel.default', PostCarousel);
        
    });

}(jQuery));
