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

	// animate number function
	$.fn.animateNumbers = function (stop, commas, duration, ease) {
		return this.each(function () {
			var $this = $(this);
			var start = parseInt($this.text().replace(/,/g, ""), 10);
			commas = (commas === undefined) ? true : commas;
			$({
				value: start
			}).animate({
				value: stop
			}, {
				duration: duration == undefined ? 500 : duration,
				easing: ease == undefined ? "swing" : ease,
				step: function () {
					$this.text(Math.floor(this.value));
					if (commas) {
						$this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
					}
				},
				complete: function () {
					if (parseInt($this.text(), 10) !== stop) {
						$this.text(stop);
						if (commas) {
							$this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
						}
					}
				}
			});
		});
	};


	// width progress function
	function widthProgress($id) {
		function widthAnim() {
			$($id).find('.number-percentage').each(function () {
				$(this).animateNumbers($(this).data("value"), true, parseInt($(this).data("animation-duration"), 10));
				var value = $(this).data("value");
				var duration = $(this).data("animation-duration");
				$(this).closest('.exad-single-progress-bar-wrapper').find('.exad-progress-bar-track').animate({
					width: value + '%'
				}, 2000);
			});
		}
		$($id).waypoint(function () {
			widthAnim(); // Number from 0.0 to 1.0
		}, {
			offset: "50%"
		})
	}

	// height progress function
	function heightProgress($id) {
		function heightAnim() {
			$($id).find('.number-percentage').each(function () {
				$(this).animateNumbers($(this).data("value"), true, parseInt($(this).data("animation-duration"), 10));
				var value = $(this).data("value");
				var duration = $(this).data("animation-duration");
				$(this).closest('.exad-single-progress-bar-wraper').find('.exad-progress-bar-track').animate({
					height: value + '%'
				}, 3500);
			});
		}
		$($id).waypoint(function () {
			heightAnim(); // Number from 0.0 to 1.0
		}, {
			offset: "50%"
		})
	}


	// semi circle progress funciton
	function semiCircleProgress($id) {
		var duration = $($id).data('animation-duration'),
			strokeWidth = $($id).data('strokewidth'),
			trailWidth = $($id).data('trailwidth'),
			datavalue = $($id).data('value');

		var bar = new ProgressBar.SemiCircle($id, {
			easing: 'easeInOut',
			duration: duration,
			strokeWidth: strokeWidth,
			trailWidth: trailWidth,
			step: function (state, circle) {
				var value = Math.round(circle.value() * 100);
				if (value === 0) {
					circle.setText('');
				} else {
					circle.setText(value);
				}
			}
		});
		$($id).waypoint(function () {
			bar.animate(datavalue); // Number from 0.0 to 1.0
		}, {
			offset: "50%"
		})
	}

	// circle progress funciton
	function circleProgress($id) {
		var duration = $($id).data('animation-duration'),
			strokeWidth = $($id).data('strokewidth'),
			trailWidth = $($id).data('trailwidth'),
			datavalue = $($id).data('value');

		var bar = new ProgressBar.Circle($id, {
			easing: 'easeInOut',
			duration: duration,
			strokeWidth: strokeWidth,
			trailWidth: trailWidth,
			step: function (state, circle) {
				var value = Math.round(circle.value() * 100);
				if (value === 0) {
					circle.setText('');
				} else {
					circle.setText(value);
				}
			}
		});
		$($id).waypoint(function () {
			bar.animate(datavalue); // Number from 0.0 to 1.0
		}, {
			offset: "50%"
		})
	}


	// ProgressBar
	var ProgressBar = function ($scope, $) {
		//var $progressBarWrapper = $scope.find('.exad-single-progress').eq(0),
		//$progress_bar_preset = $progressBarWrapper.data("progress-preset");
		
		widthProgress('#progress-style-one-1');
		widthProgress('#progress-style-one-2');

	};


	$(window).on('elementor/frontend/init', function () {
        if(elementorFrontend.isEditMode()) {
            editMode = true;
        }
        
        elementorFrontend.hooks.addAction('frontend/element_ready/exad-team-carousel.default', TeamCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/exad-testimonial-carousel.default', TestimonialCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/exad-progress-bar.default', ProgressBar);
        
    });

}(jQuery));
